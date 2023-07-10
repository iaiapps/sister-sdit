<?php

namespace App\Http\Controllers;

use App\Models\SalaryBasic;
use Illuminate\Http\Request;

class SalaryBasicController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $basics = SalaryBasic::get()->all();
        return view('admin.salary.basic.index', compact('basics'));
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
        $validate = $request->validate([
            "nama_jabatan" => "required",
            "gaji_pokok" => "required"
        ]);
        SalaryBasic::create($validate);

        return redirect()->route('basic.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(SalaryBasic $basic)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SalaryBasic $basic)
    {
        return view('admin.salary.basic.edit', compact('basic'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SalaryBasic $basic)
    {
        $basic->update($request->all());
        return redirect()->route('basic.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SalaryBasic $basic)
    {
        $basic->delete();
        return redirect()->route('basic.index');
    }
}
