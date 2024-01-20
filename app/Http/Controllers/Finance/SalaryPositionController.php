<?php

namespace App\Http\Controllers\Finance;

use App\Models\Teacher;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\SalaryPosition;
use App\Models\SalaryType;

class SalaryPositionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $gaji_pokok = SalaryType::join('salary_positions', 'salary_types.id', '=', 'salary_positions.salary_type_id')->where('type', '=', 'pokok')->get();
        // $gaji_fungsional = SalaryType::join('salary_positions', 'salary_types.id', '=', 'salary_positions.salary_type_id')->where('type', '=', 'fungsional')->get();

        $datas = SalaryPosition::all();
        return view('finance.position.index', compact('datas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // $pokoks = SalaryType::where('type', 'pokok')->get();
        // $fungsionals = SalaryType::where('type', 'fungsional')->get();
        $pokoks = SalaryType::where('type', 'pokok')->get();
        $fungsionals = SalaryType::where('type', 'fungsional')->get();

        $teachers = Teacher::get(['id', 'full_name']);
        return view('finance.position.create', compact('teachers', 'pokoks', 'fungsionals'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // $validate = $request->validate([
        //     "type" => "required",
        //     "nama" => "required",
        //     "besarnya" => "required"
        // ]);
        SalaryPosition::create($request->all());

        return redirect()->route('position.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(SalaryPosition $position)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SalaryPosition $position)
    {
        $pokoks = SalaryType::where('type', 'pokok')->get();
        $fungsionals = SalaryType::where('type', 'fungsional')->get();

        return view('finance.position.edit', compact('position', 'pokoks', 'fungsionals'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SalaryPosition $position, Request $request)
    {
        // $data = [
        //     'salary_type_id' => $request->salary_type_id
        // ];
        $position->update($request->all());

        return redirect()->route('position.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SalaryPosition $position)
    {
        $position->delete();
        return redirect()->route('position.index');
    }
}
