<?php

namespace App\Http\Controllers\Presence;

use App\Models\Teacher;
use App\Models\Presence;
use App\Models\User;
use App\Models\EntityOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Exports\PresenceExport;
use App\Models\Presencekaryawan;
use App\Exports\PresencekarExport;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class PresencekaryawanController extends Controller
{
    public function index(Request $request)
    {
        $date = Carbon::now()->format('Y-m');
        if ($request->date) {
            $date = $request->date;
        }
        $role = $request->role;
        $presences = $this->groupTeacherFilterMonth($date, $role);
        $roles = Presencekaryawan::whereNotNull('role')->distinct()->pluck('role');
        return view('presencekar.index', compact('presences', 'date', 'roles', 'role'));
    }

    // ini fungsi untuk grouping teacher dan
    // fungsi filter bulan
    // sebelum group gunakan method select()
    // gunakan DB::raw untuk pilih colum lain
    public function groupTeacherFilterMonth($date, $role = null)
    {
        $year = Carbon::parse($date)->year;
        $month = Carbon::parse($date)->month;
        $query = Presencekaryawan::whereYear('presencekaryawans.created_at', $year)
            ->whereMonth('presencekaryawans.created_at', $month);

        if ($role) {
            $query->where('presencekaryawans.role', $role);
        }

        $presences = $query
            ->join('teachers', 'presencekaryawans.teacher_id', '=', 'teachers.id')
            ->join('users', 'teachers.user_id', '=', 'users.id')
            ->where('users.active', 1)
            ->select(
                'presencekaryawans.teacher_id',
                DB::raw("COUNT(*) as total_data_presensi"),
            )
            ->groupBy('presencekaryawans.teacher_id')
            ->get();

        if ($presences->isEmpty()) {
            return collect();
        }

        $teacherIds = $presences->pluck('teacher_id');
        $teachers = Teacher::whereIn('id', $teacherIds)->get()->keyBy('id');
        $userIds = $teachers->pluck('user_id');
        $orders = EntityOrder::where('role', 'karyawan')
            ->whereIn('user_id', $userIds)
            ->pluck('order', 'user_id');

        $presences = $presences->map(function($p) use ($teachers, $orders) {
            $teacher = $teachers->get($p->teacher_id);
            $p->order = $teacher ? $orders->get($teacher->user_id, 999) : 999;
            return $p;
        })->sortBy('order')->values();

        return $presences;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function show($id, Request $request)
    {
        $id = (int)$id;
        $date = $request->date;
        // dd($date);
        $start_date = $request->start_date;
        $end_date = $request->end_date;
        $teacher = Teacher::where('id', $id)->get()->first();
        if ($request->start_date || $request->end_date) {
            $presences = $this->betweenDate($id, $start_date, $end_date);
        } else {
            $presences  = $this->showDataByMonth($id, $date);
        }
        return view('presencekar.show', compact('presences', 'teacher'));
    }

    // fungsi show data by Month
    public function showDataByMonth($id, $date)
    {
        $year = Carbon::parse($date)->year;
        $month = Carbon::parse($date)->month;
        $presences = Presencekaryawan::where('teacher_id', $id)
            ->whereYear('created_at', $year)
            ->whereMonth('created_at', $month)->get();
        return $presences;
    }

    // ini fungsi betweenDate ketika filter data show
    public function betweenDate($id, $start_date, $end_date)
    {
        $start_date = Carbon::parse($start_date)->toDateTimeString();
        $end_date = Carbon::parse($end_date)->addDay()->toDateTimeString();
        $presences = Presencekaryawan::where('teacher_id', $id)->whereBetween('created_at', [$start_date, $end_date])->get();

        return $presences;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Presencekaryawan $presencekaryawan)
    {
        $date = $request->date;
        $tgl = Carbon::parse($presencekaryawan->created_at)->isoFormat('Y-MM-DD');
        // dd($tgl);
        return view('presencekar.edit', compact('presencekaryawan', 'date', 'tgl'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Presencekaryawan $presencekaryawan)
    {
        $date = $request->date;
        $time_in = Carbon::parse($request->time_in)->format('H:i:s');
        $time_out = Carbon::parse($request->time_out)->format('H:i:s');
        $presencekaryawan->update([
            'time_in' => $time_in,
            'time_out' => $time_out,
            'created_at' => $request->date . $request->time_in,
            'updated_at' => $request->date . $request->time_in,
        ]);
        return redirect()->route('presencekaryawan.show', [$presencekaryawan->teacher_id, 'date' => $date]);
    }

    public function teacherShow(Request $request)
    {
        $id = $request->id;
        $date = $request->date;
        $start_date = $request->start_date;
        $end_date = $request->end_date;
        $teacher = Teacher::where('id', $id)->get()->first();

        if ($request->start_date || $request->end_date) {
            $presences = $this->betweenDate($id, $start_date, $end_date);
        } else {
            $presences  = $this->showDataByMonth($id, $date);
        }

        return view('presencekar.show', compact('presences', 'teacher'));
    }

    //export presence
    public function presenceexport(Request $request)
    {
        $date = $request->date;
        $month = Carbon::parse($request->date)->isoFormat('MMMM Y');
        // dd($month);
        return Excel::download(new PresencekarExport($date),  'presensikaryawan' . '-' . $month . '.xlsx');
    }


    // add presensi
    public function addpresence()
    {
        $users = User::whereHas('entityOrder', function($q) {
            $q->where('role', 'karyawan');
        })
        ->where('active', 1)
        ->with(['entityOrder', 'teacher'])
        ->get()
        ->sortBy('entityOrder.order');

        $tgl = Carbon::now()->isoFormat('Y-MM-DD');
        return view('presencekar.create', compact('users', 'tgl'));
    }
    public function storepresence(Request $request)
    {
        $teacher_ids = $request->teacher_ids;
        $date = $request->date;
        $time_in = Carbon::parse($request->time_in)->format('H:i:s');
        $time_out = $request->time_out;

        foreach ($teacher_ids as $teacher_id) {
            $presence = Presencekaryawan::where('teacher_id', $teacher_id)
                ->whereDate('created_at', $date)
                ->first();

            if ($presence) {
                $presence->update([
                    'time_in' => $time_in,
                    'time_out' => $time_out,
                ]);
            } else {
                $datetime = $date . ' ' . $time_in;
                Presencekaryawan::create([
                    'teacher_id' => $teacher_id,
                    'time_in' => $time_in,
                    'time_out' => $time_out,
                    'created_at' => $datetime,
                    'updated_at' => $datetime,
                ]);
            }
        }

        return redirect()->route('presencekaryawan.index');
    }

    // today
    public function todaypresencekar(Request $request)
    {
        $date = Carbon::now()->format('Y-m-d');
        $year = Carbon::parse($date)->year;
        $month = Carbon::parse($date)->month;
        $day = Carbon::parse($date)->day;
        $presences = Presencekaryawan::whereYear('created_at', $year)->whereMonth('created_at', $month)->whereDay('created_at', $day)
            ->whereHas('teacher.user', function ($q) {
                $q->where('active', 1);
            })
            ->get();
        return view('presencekar.today', compact('presences', 'date'));
    }

    // bulk update
    public function bulkUpdate(Request $request)
    {
        $presences = $request->presences;
        $presenceIds = array_column($presences, 'id');

        $presencesModel = Presencekaryawan::whereIn('id', $presenceIds)->get()->keyBy('id');

        foreach ($presences as $presenceData) {
            if (! isset($presenceData['id'])) {
                continue;
            }

            $presence = $presencesModel->get($presenceData['id']);
            if (! $presence) {
                continue;
            }

            $time_in = $presenceData['time_in'] ?? null;
            if ($time_in) {
                try {
                    $time_in = Carbon::parse($time_in)->format('H:i:s');
                } catch (\Exception $e) {
                    $time_in = $presence->time_in;
                }
            }

            $time_out = $presenceData['time_out'] ?? null;
            if ($time_out && $time_out !== '-') {
                try {
                    $time_out = Carbon::parse($time_out)->format('H:i:s');
                } catch (\Exception $e) {
                    $time_out = '-';
                }
            } else {
                $time_out = '-';
            }

            $presence->update([
                'time_in' => $time_in ?? $presence->time_in,
                'time_out' => $time_out,
                'is_late' => $presenceData['is_late'] ?? '0',
                'note' => $presenceData['note'] ?? null,
            ]);
        }

        return redirect()->route('presencekar.today')->with('success', 'Data presensi berhasil diperbarui');
    }

    // .......................................//
    //handle dari user
    //presence

    public function teacherPresence(Request $request)
    {
        $user_id = Auth::user()->id;
        $teacher = Teacher::where('user_id', $user_id)->get()->first();
        $teacher_id = $teacher->id;

        $date = Carbon::now();
        $start_date = $request->start_date;
        $end_date = $request->end_date;

        if ($request->start_date || $request->end_date) {
            $presences = $this->betweenDate($teacher_id, $start_date, $end_date);
        } else {
            $presences  = $this->showDataByMonth($teacher_id, $date);
        }
        return view('presencekar.show', compact('presences', 'teacher'));
    }
}
