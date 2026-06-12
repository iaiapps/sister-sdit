<?php

namespace App\Http\Controllers\Presence;

use App\Models\PresenceSetting;
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
        $presences = $this->groupTeacherFilterMonth($date);
        return view('presencekar.index', compact('presences', 'date'));
    }

    // ini fungsi untuk grouping teacher dan
    // fungsi filter bulan
    // sebelum group gunakan method select()
    // gunakan DB::raw untuk pilih colum lain
    public function groupTeacherFilterMonth($date)
    {
        $year = Carbon::parse($date)->year;
        $month = Carbon::parse($date)->month;
        $presences = Presencekaryawan::whereYear('presencekaryawans.created_at', $year)
            ->whereMonth('presencekaryawans.created_at', $month)
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

    public function bulkAdd()
    {
        return view('presencekar.bulk');
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

        return view('presencekar.preview', compact('rows', 'rawData', 'date'));
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

            $presence = Presencekaryawan::where('teacher_id', $row['teacher_id'])
                ->whereDate('created_at', $row['date'])
                ->first();

            if ($presence) {
                $presence->update([
                    'time_in' => $row['time_in'],
                    'time_out' => $row['time_out'],
                    'is_late' => $row['is_late'],
                    'note' => $row['note'],
                    'updated_at' => $datetime,
                ]);
            } else {
                Presencekaryawan::create([
                    'teacher_id' => $row['teacher_id'],
                    'time_in' => $row['time_in'],
                    'time_out' => $row['time_out'],
                    'is_late' => $row['is_late'],
                    'note' => $row['note'],
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
                return redirect()->route('presencekaryawan.index')->with('success', $msg)->with('warning', $errorMsg);
            }
            return redirect()->route('presencekar.bulk-add')->with('warning', $msg)->with('errorDetails', $errorMsg);
        }

        return redirect()->route('presencekaryawan.index')
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
                $ontimeUntil = PresenceSetting::where('name', 'ontime_until:karyawan')->value('value') ?? '07:00';
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
