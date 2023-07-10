<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
// use App\Http\Controllers\EducationController;


class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    //  handle dari admin
    public function index()
    {
        $teachers = Teacher::get()->all();
        return view('teacher.index', compact('teachers'));
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
    public function show(Teacher $teacher)
    {
        $this->authorize('teacher', $teacher);
        $id = Auth::user()->id;
        return view('teacher.show', compact('teacher', 'id'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Teacher $teacher)
    {
        $this->authorize('teacher', $teacher);
        return view('teacher.edit', compact('teacher'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Teacher $teacher)
    {
        $request->validate([
            'full_name' => 'required',
            'gender' => 'required',
            'place_of_birth' => 'required',
            'date_of_birth' => 'required',
            'last_education' => 'required',
            'month_enter' => 'required',
            'year_enter' => 'required',
            'no_hp' => 'required',
        ]);

        // $teacher->where('id', $teacher->id)->update($validate);
        $id =  $teacher->id;
        $teacher->update($request->all());
        return redirect()->route('teacher.show', $id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Teacher $teacher)
    {
        //
    }

    // .......................................//
    //handle dari user
    //profile
    public function profile()
    {
        $teacher = Teacher::where('user_id', Auth::user()->id)->first();
        $id = Auth::user()->id;
        // dd($user);
        return view('teacher.show', compact('teacher', 'id'));
    }

    // public function editProfile(Teacher $teacher)
    // {
    //     return view('teacher.profile.edit', compact('teacher'));
    // }

    // public function updateProfile(Request $request, Teacher $teacher)
    // {
    //     $request->validate([
    //         'full_name' => 'required',
    //         'gender' => 'required',
    //         'place_of_birth' => 'required',
    //         'date_of_birth' => 'required',
    //         'last_education' => 'required',
    //         'month_enter' => 'required',
    //         'year_enter' => 'required',
    //         'no_hp' => 'required',
    //     ]);

    //     $teacher->update($request->all());
    //     return redirect('profile');
    // }

    //education

}
