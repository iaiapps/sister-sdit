<?php

namespace App\Http\Controllers\Finance;

use App\Models\SalaryFunctional;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SalaryFunctionalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $functionals = SalaryFunctional::get()->all();
        return view('admin.salary.functional.index', compact('functionals'));
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
            "nama_fungsional" => "required",
            "gaji_fungsional" => "required"
        ]);
        SalaryFunctional::create($validate);

        return redirect()->route('functional.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(SalaryFunctional $functional)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SalaryFunctional $functional)
    {
        return view('admin.salary.functional.edit', compact('functional'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SalaryFunctional $functional)
    {
        $functional->update($request->all());
        return redirect()->route('functional.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SalaryFunctional $functional)
    {
        $functional->delete();
        return redirect()->route('functional.index');
    }
}
