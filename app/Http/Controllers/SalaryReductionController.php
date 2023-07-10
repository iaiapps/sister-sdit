<?php

namespace App\Http\Controllers;

use App\Models\SalaryReduction;
use Illuminate\Http\Request;

class SalaryReductionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $reductions = SalaryReduction::get()->all();
        return view('admin.salary.reduction.index', compact('reductions'));
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
            "nama_pengurangan" => "required",
            "besarnya" => "required"
        ]);
        SalaryReduction::create($validate);

        return redirect()->route('reduction.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(SalaryReduction $reduction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SalaryReduction $reduction)
    {
        return view('admin.salary.reduction.edit', compact('reduction'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SalaryReduction $reduction)
    {
        $reduction->update($request->all());
        return redirect()->route('reduction.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SalaryReduction $reduction)
    {
        $reduction->delete();
        return redirect()->route('reduction.index');
    }
}
