<?php

namespace App\Http\Controllers\Teacher;

use App\Models\Teacher;
use App\Models\Education;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;


class EducationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // return view('teacher.education.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        return view('teacher.education.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // $id = Teacher::where('email', Auth::user()->email)->first()->id;
        $id = Teacher::where('user_id', Auth::user()->id)->first()->id;

        // dd($id);
        $education = $request->all();
        $education['teacher_id'] = $id;
        Education::create($education);
        return redirect()->route('guru.profile')->withInput(['tab' => 'education']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Education $education)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Education $education)
    {
        return view('teacher.education.edit', compact('education'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Education $education)
    {
        // $id = $education->teacher_id;
        // dd($id);
        // dd($request->all());
        $education->update($request->all());
        return redirect()->route('guru.profile')->withInput(['tab' => 'education']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Education $education)
    {
        $education->delete();
        return redirect()->route('guru.profile')->withInput(['tab' => 'education']);
    }
}
