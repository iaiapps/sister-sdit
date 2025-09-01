<?php

namespace App\Http\Controllers\Bpi;

use App\Models\Bpi;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class BpiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $date = Carbon::now()->isoFormat('Y-MM');
        if ($request->date) {
            $date = $request->date;
        }
        $year = Carbon::parse($date)->year;
        $month = Carbon::parse($date)->month;
        $bpis = Bpi::whereYear('date', $year)
            ->whereMonth('date', $month)
            ->select('teacher_id', DB::raw("COUNT(*) as total"),)
            ->groupBy('teacher_id')->get();
        return view('bpi.admin.index', compact('bpis', 'date'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $teachers = Teacher::all();
        return view('bpi.create', compact('teachers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();
        Bpi::create($data);
        return redirect()->route('bpi.index');
    }

    /**
     * Display the specified resource.
     */
    public function show($id, Request $request)
    {
        $year = Carbon::parse($request->date)->year;
        $month = Carbon::parse($request->date)->month;
        $idt = $id;
        $bpis = Bpi::where('teacher_id', $idt)->whereYear('created_at', $year)->whereMonth('created_at', $month)->get();
        return view('bpi.admin.show', compact('bpis'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Bpi $bpi)
    {
        return view('bpi.admin.edit', compact('bpi'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Bpi $bpi)
    {
        $id = $request->teacher_id;
        $data = $request->all();
        // dd($data);
        $bpi->update($data);
        return redirect()->route('bpi.show', $id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Bpi $bpi)
    {
        $bpi->delete();
        return redirect()->back();
    }

    // ------------------------------------- //
    // handle dari user
    public function list()
    {
        $now = Carbon::now();
        $year = Carbon::parse($now)->year;
        $month = Carbon::parse($now)->month;
        $uid = Auth::user()->id;
        $tid = Teacher::where('user_id', $uid)->first()->id;
        $bpis = Bpi::whereYear('date', $year)->whereMonth('date', $month)
            ->where('teacher_id', $tid)->get();

        return view('bpi.teacher.index', compact('now', 'bpis', 'tid'));
    }

    // public function bpiCreate()
    // {
    //     $uid = Auth::user()->id;
    //     $tid = Teacher::where('user_id', $uid)->first()->id;
    //     return view('bpi.teacher.create', compact('tid'));
    // }

    public function bpiStore(Request $request)
    {
        $data = $request->all();
        Bpi::create($data);
        return redirect()->route('guru.bpi.list');
    }
    public function bpiDestroy(Bpi $bpi)
    {
        $bpi->delete();
        return redirect()->back();
    }
}
