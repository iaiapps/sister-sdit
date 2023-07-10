<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use App\Models\SalaryFunctional;
use Illuminate\Http\Request;

class PfunctionalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $teachers = Teacher::get()->all();
        return view('admin.salary.pfunctional.index', compact('teachers'));
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
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Teacher $pfunctional)
    {
        $jabatans = SalaryFunctional::get()->all();
        return view('admin.salary.pfunctional.edit', compact('pfunctional', 'jabatans'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Teacher $pfunctional, Request $request)
    {
        $pfunctional->update(['salary_functional_id' => $request->salary_functional_id]);

        return redirect()->route('pfunctional.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
