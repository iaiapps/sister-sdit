<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use App\Models\Presence;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

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
        return view('admin.presence.index', compact('presences', 'date'));
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
                DB::raw("COUNT(*) as total_kehadiran"),
                DB::raw("SUM(is_late = 1) as is_late_a"),
                DB::raw("SUM(is_late = 2) as is_late_b"),
                DB::raw("SUM(is_late = 3) as is_late_c"),
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
        $date = $request->date;
        $start_date = $request->start_date;
        $end_date = $request->end_date;
        $teacher = Teacher::where('id', $id)->get()->first();
        if ($request->start_date || $request->end_date) {
            $presences = $this->betweenDate($id, $start_date, $end_date);
        } else {
            $presences  = $this->showDataByMonth($id, $date);
        }
        return view('admin.presence.show', compact('presences', 'teacher'));
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
        return view('admin.presence.editjam', compact('presence', 'date'));
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

        return view('admin.presence.show', compact('presences', 'teacher'));
    }
}
