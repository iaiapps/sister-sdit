<?php

namespace App\Http\Controllers\Teacher;

use App\Models\Child;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class ChildController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('teacher.child.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $id = Teacher::where('user_id', Auth::user()->id)->first()->id;
        $child = $request->all();
        $child['teacher_id'] = $id;
        Child::create($child);
        // return redirect('profile#child');
        return redirect()->route('guru.profile')->withInput(['tab' => 'child']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Child $child)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Child $child)
    {
        return view('teacher.child.edit', compact('child'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Child $child)
    {
        $child->update($request->all());
        return redirect()->route('guru.profile')->withInput(['tab' => 'child']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Child $child)
    {
        $child->delete();
        return redirect()->route('guru.profile')->withInput(['tab' => 'child']);
    }
}
