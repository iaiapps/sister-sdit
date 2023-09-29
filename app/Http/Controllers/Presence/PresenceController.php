<?php

namespace App\Http\Controllers\Presence;

use App\Models\Teacher;
use App\Models\Presence;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Exports\PresenceExport;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;

class PresenceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $date = Carbon::now()->format('Y-m');
        if ($request->date) {
            $date = $request->date;
        }
        $presences = $this->groupTeacherFilterMonth($date);
        // $lateCat = Presence::get()->late_cat
        return view('presence.index', compact('presences', 'date'));
    }

    // ini fungsi untuk grouping teacher dan
    // fungsi filter bulan
    // sebelum group gunakan method select()
    // gunakan DB::raw untuk pilih colum lain
    public function groupTeacherFilterMonth($date)
    {
        $year = Carbon::parse($date)->year;
        $month = Carbon::parse($date)->month;
        $presences = Presence::whereYear('created_at', $year)->whereMonth('created_at', $month)
            ->select(
                'teacher_id',
                DB::raw("COUNT(*) as total_data_presensi"),
                DB::raw("SUM(is_late = 1) as is_late"),
                // DB::raw("SUM(is_late = 1) as is_late_a"),
                // DB::raw("SUM(is_late = 2) as is_late_b"),
                // DB::raw("SUM(is_late = 3) as is_late_c"),
                DB::raw("SUM(note = 'Sakit') as total_sakit"),
                DB::raw("SUM(note = 'Ijin') as total_ijin"),
            )
            ->groupBy('teacher_id')->get();
        return $presences;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function show($id, Request $request)
    {
        $id = (int)$id;
        // dd($id);
        $date = $request->date;
        $start_date = $request->start_date;
        $end_date = $request->end_date;
        $teacher = Teacher::where('id', $id)->get()->first();
        if ($request->start_date || $request->end_date) {
            $presences = $this->betweenDate($id, $start_date, $end_date);
        } else {
            $presences  = $this->showDataByMonth($id, $date);
        }
        return view('presence.show', compact('presences', 'teacher'));
    }

    // fungsi show data by Month
    public function showDataByMonth($id, $date)
    {
        $year = Carbon::parse($date)->year;
        $month = Carbon::parse($date)->month;
        $presences = Presence::where('teacher_id', $id)
            ->whereYear('created_at', $year)
            ->whereMonth('created_at', $month)->get();
        return $presences;
    }

    // ini fungsi betweenDate ketika filter data show
    public function betweenDate($id, $start_date, $end_date)
    {
        $start_date = Carbon::parse($start_date)->toDateTimeString();
        $end_date = Carbon::parse($end_date)->addDay()->toDateTimeString();
        $presences = Presence::where('teacher_id', $id)->whereBetween('created_at', [$start_date, $end_date])->get();

        return $presences;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Presence $presence)
    {
        $date = $request->date;
        return view('presence.editjam', compact('presence', 'date'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Presence $presence)
    {
        $date = $request->date;
        $time_in = Carbon::parse($request->time_in)->format('H:i:s');
        $time_out = Carbon::parse($request->time_out)->format('H:i:s');
        $presence->update([
            'time_in' => $time_in,
            'time_out' => $time_out,
            'note' => $request->note,
            'description' => $request->description
        ]);

        return redirect()->route('presence.show', [$presence->teacher_id, 'date' => $date]);
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

        return view('presence.show', compact('presences', 'teacher'));
    }

    public function presenceexport(Request $request)
    {
        $date = $request->date;
        $month = Carbon::parse($request->date)->isoFormat('MMMM Y');
        // dd($month);
        return Excel::download(new PresenceExport($date),  'presensi' . '-' . $month . '.xlsx');
    }


    // add presensi
    public function addpresence()
    {
        $teachers = Teacher::all();
        return view('presence.create', compact('teachers'));
    }
    public function storepresence(Request $request)
    {
        $id = $request->teacher_id;
        $time_in = Carbon::createFromTimeString($request->time_in)->isoFormat('HH:mm:ss');
        $time_out = Carbon::createFromTimeString($request->time_out)->isoFormat('HH:mm:ss');
        $date = Carbon::createFromDate($request->date)->isoFormat('YYYY-MM-DD') . " " . $time_in;
        // dd($date);

        Presence::create([
            'teacher_id' => $id,
            'time_in' => $time_in,
            'time_out' => $time_out,
            'is_late' => $request->is_late,
            'note' => $request->note,
            'description' => $request->description,
            'created_at' => $date,
            'updated_at' => $date,
        ]);
        return redirect()->route('presence.index');
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
        // $teacher = Teacher::where('id', $id)->get()->first();

        // dd($teacher->id);

        if ($request->start_date || $request->end_date) {
            $presences = $this->betweenDate($teacher_id, $start_date, $end_date);
        } else {
            $presences  = $this->showDataByMonth($teacher_id, $date);
        }
        return view('presence.show', compact('presences', 'teacher'));
    }
}
