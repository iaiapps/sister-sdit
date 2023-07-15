<?php

namespace App\Http\Controllers\Api;

use App\Models\Salary;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use App\Models\SalaryBasic;

class SalaryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Salary::get();
        return response()->json([
            'pesan' => 'success',
            'data' => $data,
            'errors' => 'error'
        ], 200);
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($id, Request $request)
    {
        $month = Carbon::parse($request->date)->format('m');
        $year = Carbon::parse($request->date)->format('Y');

        $salary = Salary::whereYear('bulan', $year)->whereMonth('bulan', $month)->where('teacher_id', $id)->get()->first();
        $jabatan = SalaryBasic::where('id', $id)->get()->first();

        //tambah data ke array $salary
        $salary['jabatan'] = $jabatan->nama_jabatan;

        if ($salary->count() == null) {
            return response()->json(['pesan' => 'Data tidak ditemukan'], 404);
        }
        return response()->json([
            'pesan' => 'Data ditemukan',
            'data' => $salary,
        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Salary $salary)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Salary $salary)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Salary $salary)
    {
        //
    }
}
