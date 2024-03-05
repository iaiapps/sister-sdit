<?php

namespace App\Http\Controllers\Bpi;

use App\Models\Bpi;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class BpiControllerM extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $now = Carbon::now();
        // $year = Carbon::parse($now)->year;
        $month = Carbon::parse($now)->month;
        $uid = Auth::user()->id;
        $tid = Teacher::where('user_id', $uid)->first()->id;
        $bpis = Bpi::whereMonth('date', $month)
            ->where('teacher_id', $tid)->get();

        return view('bpi.mobile.index', compact('now', 'bpis', 'tid'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // 
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();
        Bpi::create($data);
        return redirect()->route('bpi-mobile.index');
    }

    /**
     * Display the specified resource.
     */
    public function show($id, Request $request)
    {
        // 
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
        // 
    }
}
