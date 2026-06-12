<?php

namespace App\Http\Controllers\Presence;

use App\Exports\PresenceExport;
use App\Http\Controllers\Controller;
use App\Models\Presence;
use App\Models\PresenceSetting;
use App\Models\Teacher;
use App\Models\User;
use App\Models\EntityOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

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
        return view('presence.admin.index', compact('presences', 'date'));
    }

    // ini fungsi untuk grouping teacher dan
    // fungsi filter bulan
    // sebelum group gunakan method select()
    // gunakan DB::raw untuk pilih colum lain
    public function groupTeacherFilterMonth($date)
    {
        $year = Carbon::parse($date)->year;
        $month = Carbon::parse($date)->month;
        $presences = Presence::whereYear('presences.created_at', $year)->whereMonth('presences.created_at', $month)
            ->join('teachers', 'presences.teacher_id', '=', 'teachers.id')
            ->join('users', 'teachers.user_id', '=', 'users.id')
            ->where('users.active', 1)
            ->select(
                'presences.teacher_id',
                DB::raw('COUNT(*) as total_data_presensi'),
                DB::raw('SUM(presences.is_late = 1) as is_late'),
                DB::raw("SUM(presences.note = 'Sakit') as total_sakit"),
                DB::raw("SUM(presences.note = 'Ijin') as total_ijin"),
                DB::raw("SUM(presences.note = 'Tugas kedinasan') as total_tugas_kedinasan"),
                DB::raw("SUM(presences.time_out = '-') as total_tidak_presensi_pulang"),
            )
            ->groupBy('presences.teacher_id')
            ->get();

        if ($presences->isEmpty()) {
            return collect();
        }

        $teacherIds = $presences->pluck('teacher_id');
        $teachers = Teacher::whereIn('id', $teacherIds)->get()->keyBy('id');
        $userIds = $teachers->pluck('user_id');
        $orders = EntityOrder::whereIn('role', ['guru', 'tendik'])
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
        $id = (int) $id;
        // dd($id);
        $date = $request->date;
        $start_date = $request->start_date;
        $end_date = $request->end_date;
        $teacher = Teacher::where('id', $id)->first();

        if (! $teacher) {
            abort(404);
        }

        // If logged in user is a teacher, ensure they only view their own data
        if (Auth::user()->hasAnyRole(['guru', 'tendik', 'karyawan'])) {
            $userTeacher = Teacher::where('user_id', Auth::id())->first();
            if (! $userTeacher || $userTeacher->id !== $teacher->id) {
                abort(403);
            }
        }

        // Fallback date to current month when not provided
        if (! $date) {
            $date = Carbon::now()->format('Y-m');
        }

        if ($start_date || $end_date) {
            $start_date = $start_date ?? $end_date;
            $end_date = $end_date ?? $start_date;
            $presences = $this->betweenDate($id, $start_date, $end_date);
        } else {
            $presences = $this->showDataByMonth($id, $date);
        }

        return view('presence.teacher.show', compact('presences', 'teacher'));
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
        $tgl = Carbon::parse($presence->created_at)->isoFormat('Y-MM-DD');
        // dd($presence);
        return view('presence.admin.edit', compact('presence', 'date', 'tgl'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Presence $presence)
    {
        $date = $request->date;

        $time_in = Carbon::parse($request->time_in)->format('H:i:s');
        $time_out = $request->time_out;

        if ($time_out != '-') {
            $time_out = Carbon::parse($request->time_out)->format('H:i:s');
        } else {
            $time_out = '-';
        }

        $note = $request->note;
        if ($note == 'Pulang awal') {
            $note = $presence->note.', '.$request->note;
        } else {
            $note = $request->note;
        }

        $data = [
            'time_in' => $time_in,
            'time_out' => $time_out,
            'note' => $note,
            'is_late' => $request->is_late,
            'description' => $request->description,
            'created_at' => $request->date.$request->time_in,
            'updated_at' => $request->date.$request->time_in,
        ];
        $presence->update($data);

        return redirect()->route('presence.show', [$presence->teacher_id, 'date' => $date]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Presence $presence)
    {
        $presence->delete();

        return redirect()->back();
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
            $presences = $this->showDataByMonth($id, $date);
        }

        return view('presence.admin.show', compact('presences', 'teacher'));
    }

    //export presence
    public function presenceexport(Request $request)
    {
        $date = $request->date;
        $month = Carbon::parse($request->date)->isoFormat('MMMM Y');
        // dd($month);
        return Excel::download(new PresenceExport($date), 'presensi'.'-'.$month.'.xlsx');
    }

    // add presensi
    public function addpresence()
    {
        $users = User::whereHas('entityOrder', function ($q) {
            $q->whereIn('role', ['guru', 'tendik']);
        })
            ->where('active', 1)
            ->with(['entityOrder', 'teacher'])
            ->get()
            ->sortBy('entityOrder.order');

        $tgl = Carbon::now()->isoFormat('Y-MM-DD');

        return view('presence.admin.create', compact('tgl', 'users'));
    }

    public function storepresence(Request $request)
    {
        $teacher_ids = $request->teacher_ids;
        $date = $request->date;
        $time_in = Carbon::parse($request->time_in)->format('H:i:s');
        $time_out = $request->time_out;
        $is_late = $request->is_late;
        $note = $request->note;
        $description = $request->description;

        foreach ($teacher_ids as $teacher_id) {
            $presence = Presence::where('teacher_id', $teacher_id)
                ->whereDate('created_at', $date)
                ->first();

            if ($presence) {
                $presence->update([
                    'time_in' => $time_in,
                    'time_out' => $time_out,
                    'is_late' => $is_late,
                    'note' => $note,
                    'description' => $description,
                ]);
            } else {
                $datetime = $date . ' ' . $time_in;
                Presence::create([
                    'teacher_id' => $teacher_id,
                    'time_in' => $time_in,
                    'time_out' => $time_out,
                    'is_late' => $is_late,
                    'note' => $note,
                    'description' => $description,
                    'created_at' => $datetime,
                    'updated_at' => $datetime,
                ]);
            }
        }

        return redirect()->route('presence.index');
    }

    // today
    public function todaypresence(Request $request)
    {
        $date = Carbon::now()->format('Y-m-d');
        $year = Carbon::parse($date)->year;
        $month = Carbon::parse($date)->month;
        $day = Carbon::parse($date)->day;
        $presences = Presence::whereYear('created_at', $year)->whereMonth('created_at', $month)->whereDay('created_at', $day)
            ->whereHas('teacher.user', function ($q) {
                $q->where('active', 1);
            })
            ->get();

        return view('presence.admin.today', compact('presences', 'date'));
    }

    public function bulkUpdate(Request $request)
    {
        $request->validate([
            'presences' => 'required|array',
        ]);

        $presences = $request->presences;
        $presenceIds = array_column($presences, 'id');

        $presencesModel = Presence::whereIn('id', $presenceIds)->get()->keyBy('id');

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
                'is_late' => $presenceData['is_late'] ?? 0,
                'note' => $presenceData['note'] ?? null,
                'description' => $presenceData['description'] ?? null,
            ]);
        }

        return redirect()->route('presence.today')->with('success', 'Data presensi berhasil diperbarui');
    }

    public function bulkAdd()
    {
        return view('presence.admin.bulk');
    }

    public function bulkPreview(Request $request)
    {
        $request->validate([
            'data' => 'required|string',
            'date' => 'required|date',
        ]);

        $rawData = $request->data;
        $date = $request->date;
        $rows = $this->parseBulkData($rawData, $date);

        return view('presence.admin.preview', compact('rows', 'rawData', 'date'));
    }

    public function bulkStore(Request $request)
    {
        $request->validate([
            'data' => 'required|string',
            'date' => 'required|date',
            'confirmed' => 'required|accepted',
        ]);

        $rows = $this->parseBulkData($request->data, $request->date);
        $success = 0;
        $errors = [];

        foreach ($rows as $row) {
            if ($row['status'] !== 'OK') {
                $errors[] = $row['status'] . ' (teacher_id: ' . $row['teacher_id'] . ')';
                continue;
            }

            $datetime = $row['date'] . ' ' . $row['time_in'];

            $presence = Presence::where('teacher_id', $row['teacher_id'])
                ->whereDate('created_at', $row['date'])
                ->first();

            if ($presence) {
                $presence->update([
                    'time_in' => $row['time_in'],
                    'time_out' => $row['time_out'],
                    'is_late' => $row['is_late'],
                    'note' => $row['note'],
                    'description' => $row['description'],
                    'updated_at' => $datetime,
                ]);
            } else {
                Presence::create([
                    'teacher_id' => $row['teacher_id'],
                    'time_in' => $row['time_in'],
                    'time_out' => $row['time_out'],
                    'is_late' => $row['is_late'],
                    'note' => $row['note'],
                    'description' => $row['description'],
                    'created_at' => $datetime,
                    'updated_at' => $datetime,
                ]);
            }

            $success++;
        }

        if ($errors) {
            $errorMsg = implode('<br>', array_slice($errors, 0, 20));
            if (count($errors) > 20) {
                $errorMsg .= '<br>... dan ' . (count($errors) - 20) . ' error lainnya';
            }
            $msg = "Berhasil: $success, Gagal: " . count($errors);
            if ($success > 0) {
                return redirect()->route('presence.index')->with('success', $msg)->with('warning', $errorMsg);
            }
            return redirect()->route('presence.bulk-add')->with('warning', $msg)->with('errorDetails', $errorMsg);
        }

        return redirect()->route('presence.index')
            ->with('success', "Berhasil menambahkan $success data presensi");
    }

    private function parseBulkData($rawData, $formDate)
    {
        $formDateParsed = Carbon::parse($formDate)->format('Y-m-d');
        $lines = explode("\n", trim($rawData));
        $rows = [];

        foreach ($lines as $line) {
            $line = trim($line);
            if (empty($line)) continue;

            $cols = explode("\t", $line);
            $cols = array_map('trim', $cols);

            $row = [
                'teacher_id' => $cols[0] ?? '',
                'teacher_name' => null,
                'date' => $formDateParsed,
                'time_in' => '',
                'time_out' => '-',
                'is_late' => '0',
                'note' => 'Tepat waktu',
                'description' => null,
                'status' => 'OK',
            ];

            if (count($cols) < 2) {
                $row['status'] = 'Baris tidak lengkap';
                $rows[] = $row;
                continue;
            }

            $secondCol = $cols[1];
            $isDate = preg_match('/[\-\/]/', $secondCol) && !preg_match('/^\d{1,2}:\d{2}/', $secondCol);

            if ($isDate) {
                $tanggal = $secondCol;
                $row['time_in'] = $cols[2] ?? '';
                $row['time_out'] = $cols[3] ?? '-';
                $row['is_late'] = $cols[4] ?? null;
                $row['note'] = $cols[5] ?? null;
                $row['description'] = $cols[6] ?? null;

                try {
                    $parsedDate = Carbon::createFromFormat('Y-m-d', $tanggal);
                } catch (\Exception $e) {
                    try {
                        $parsedDate = Carbon::createFromFormat('d/m/Y', $tanggal);
                    } catch (\Exception $e2) {
                        try {
                            $parsedDate = Carbon::parse($tanggal);
                        } catch (\Exception $e3) {
                            $row['status'] = "Tanggal invalid: $tanggal";
                            $rows[] = $row;
                            continue;
                        }
                    }
                }
                $row['date'] = $parsedDate->format('Y-m-d');
            } else {
                $row['time_in'] = $secondCol;
                $row['time_out'] = $cols[2] ?? '-';
                $row['is_late'] = $cols[3] ?? null;
                $row['note'] = $cols[4] ?? null;
                $row['description'] = null;
            }

            if (empty($row['time_in'])) {
                $row['status'] = 'time_in tidak ditemukan';
                $rows[] = $row;
                continue;
            }

            $teacher = Teacher::find($row['teacher_id']);
            if (!$teacher) {
                $row['status'] = 'Teacher ID tidak ditemukan';
                $rows[] = $row;
                continue;
            }
            $row['teacher_name'] = $teacher->full_name;

            try {
                $row['time_in'] = Carbon::parse($row['time_in'])->format('H:i:s');
            } catch (\Exception $e) {
                $row['status'] = 'Format time_in invalid';
                $rows[] = $row;
                continue;
            }

            if ($row['time_out'] !== '-' && $row['time_out'] !== '') {
                try {
                    $row['time_out'] = Carbon::parse($row['time_out'])->format('H:i:s');
                } catch (\Exception $e) {
                    $row['time_out'] = '-';
                }
            } else {
                $row['time_out'] = '-';
            }

            if ($row['note'] === null || $row['is_late'] === null) {
                $ontimeUntil = PresenceSetting::where('name', 'ontime_until')->value('value') ?? '07:16';
                $isLateAuto = $row['time_in'] > $ontimeUntil ? '1' : '0';
                $row['note'] = $row['note'] ?? ($isLateAuto === '1' ? 'Telat' : 'Tepat waktu');
                $row['is_late'] = $row['is_late'] ?? $isLateAuto;
            } elseif ($row['note'] === null) {
                $row['note'] = $row['is_late'] === '1' ? 'Telat' : 'Tepat waktu';
            } elseif ($row['is_late'] === null) {
                $row['is_late'] = in_array($row['note'], ['Telat', 'Pulang awal']) ? '1' : '0';
            }

            $rows[] = $row;
        }

        return $rows;
    }

    // filter presence
    public function filterpresence(Request $request)
    {
        $date = $request->date;
        $start_date = $request->start_date;
        $end_date = $request->end_date;
        // whereBetween('created_at', [$start_date, $end_date])
        $presences = Presence::whereBetween('presences.created_at', [$start_date, $end_date])
            ->join('teachers', 'presences.teacher_id', '=', 'teachers.id')
            ->join('users', 'teachers.user_id', '=', 'users.id')
            ->where('users.active', 1)
            ->select(
                'presences.teacher_id',
                DB::raw('COUNT(*) as total_data_presensi'),
                DB::raw('SUM(presences.is_late = 1) as is_late'),
                DB::raw("SUM(presences.note = 'Sakit') as total_sakit"),
                DB::raw("SUM(presences.note = 'Ijin') as total_ijin"),
                DB::raw("SUM(presences.note = 'Tugas kedinasan') as total_tugas_kedinasan"),
                DB::raw("SUM(presences.time_out = '-') as total_tidak_presensi_pulang"),
            )
            ->groupBy('presences.teacher_id')
            ->get();

        if ($presences->isNotEmpty()) {
            $teacherIds = $presences->pluck('teacher_id');
            $teachers = Teacher::whereIn('id', $teacherIds)->get()->keyBy('id');
            $userIds = $teachers->pluck('user_id');
            $orders = EntityOrder::whereIn('role', ['guru', 'tendik'])
                ->whereIn('user_id', $userIds)
                ->pluck('order', 'user_id');

            $presences = $presences->map(function($p) use ($teachers, $orders) {
                $teacher = $teachers->get($p->teacher_id);
                $p->order = $teacher ? $orders->get($teacher->user_id, 999) : 999;
                return $p;
            })->sortBy('order')->values();
        }

        return view('presence.admin.filter', compact('presences', 'date'));
    }

    // .......................................//
    //handle dari user
    //presence

    public function teacherPresence(Request $request)
    {
        $user_id = Auth::user()->id;
        $teacher = Teacher::where('user_id', $user_id)->get()->first();
        if (! $teacher) {
            abort(404);
        }

        $teacher_id = $teacher->id;

        $date = $request->date ?? Carbon::now()->format('Y-m');
        $start_date = $request->start_date;
        $end_date = $request->end_date;
        // $teacher = Teacher::where('id', $id)->get()->first();

        // dd($teacher->id);

        if ($start_date || $end_date) {
            $start_date = $start_date ?? $end_date;
            $end_date = $end_date ?? $start_date;
            $presences = $this->betweenDate($teacher_id, $start_date, $end_date);
        } else {
            $presences = $this->showDataByMonth($teacher_id, $date);
        }

        return view('presence.teacher.show', compact('presences', 'teacher'));
    }
}
