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
    public function index()
    {
        $now = Carbon::now();
        $year = Carbon::parse($now)->year;
        $month = Carbon::parse($now)->month;
        $bpis = Bpi::whereYear('date', $year)
            ->whereMonth('date', $month)
            ->select('teacher_id', DB::raw("COUNT(*) as total"),)
            ->groupBy('teacher_id')->get();
        return view('bpi.admin.index', compact('bpis', 'now'));
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
        return redirect()->route('admin.bpi.index');
    }

    /**
     * Display the specified resource.
     */
    public function show($id, Request $request)
    {
        $idt = $id;
        // dd($idi);
        $bpis = Bpi::where('teacher_id', $idt)->get();
        return view('bpi.admin.show', compact('bpis'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Bpi $bpi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Bpi $bpi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Bpi $bpi)
    {
        $bpi->delete();
        return redirect()->route('admin.bpi.index');
    }

    // ------------------------------------- //
    // handle dari user
    public function list()
    {
        $now = Carbon::now();
        // $year = Carbon::parse($now)->year;
        $month = Carbon::parse($now)->month;
        $uid = Auth::user()->id;
        $tid = Teacher::where('user_id', $uid)->first()->id;
        $bpis = Bpi::whereMonth('date', $month)
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
}
