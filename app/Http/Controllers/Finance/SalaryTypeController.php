<?php

namespace App\Http\Controllers\Finance;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\SalaryType;

class SalaryTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $types = SalaryType::get()->all();
        return view('finance.type.index', compact('types'));
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
        // dd($request->all());
        $validate = $request->validate([
            "type" => "required",
            "nama" => "required",
            "besarnya" => "required"
        ]);
        SalaryType::create($validate);

        return redirect()->route('type.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(SalaryType $type)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SalaryType $type)
    {
        return view('finance.type.edit', compact('type'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SalaryType $type)
    {
        $type->update($request->all());
        return redirect()->route('type.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SalaryType $type)
    {
        $type->delete();
        return redirect()->route('basic.index');
    }
}
