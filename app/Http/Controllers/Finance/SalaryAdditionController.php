<?php

namespace App\Http\Controllers\Finance;

use App\Models\SalaryAddition;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SalaryAdditionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $additions = SalaryAddition::get()->all();
        return view('admin.salary.addition.index', compact('additions'));
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
            "nama_penambahan" => "required",
            "besarnya" => "required"
        ]);
        SalaryAddition::create($validate);

        return redirect()->route('addition.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(SalaryAddition $addition)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SalaryAddition $addition)
    {
        return view('admin.salary.addition.edit', compact('addition'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SalaryAddition $addition)
    {
        $addition->update($request->all());
        return redirect()->route('addition.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SalaryAddition $addition)
    {
        $addition->delete();
        return redirect()->route('addition.index');
    }
}
