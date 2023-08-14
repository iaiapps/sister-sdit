<?php

namespace App\Http\Controllers\Finance;

use App\Models\SalaryBasic;
use App\Models\Teacher;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PositionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $teachers = Teacher::get()->all();
        // $positions = SalaryBasic::get()->all();
        return view('finance.position.index', compact('teachers'));
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
    public function edit(Teacher $position)
    {
        $jabatans = SalaryBasic::get()->all();
        return view('finance.position.edit', compact('position', 'jabatans'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Teacher $position, Request $request)
    {
        $position->update(['salary_basic_id' => $request->salary_basic_id]);

        return redirect()->route('position.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
