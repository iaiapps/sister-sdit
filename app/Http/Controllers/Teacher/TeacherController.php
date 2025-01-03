<?php

namespace App\Http\Controllers\Teacher;

use App\Models\Teacher;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    //  handle dari admin
    public function index(Teacher $teacher)
    {
        // $this->authorize('teacher', $teacher);
        $guru = User::role('guru')->get();
        $tendik = User::role('tendik')->get();
        $users = $guru->merge($tendik);
        //dd($tendik);
        // $teachers = Teacher::all();
        return view('admin.teacher.index', compact('users'));
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
        // $this->authorize('teacher', $teacher);
        $id = Auth::user()->id;
        return view('admin.teacher.show', compact('teacher', 'id'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Teacher $teacher)
    {
        return view('admin.teacher.edit', compact('teacher'));
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

        // dd($request->all());
        // $teacher->where('id', $teacher->id)->update($validate);
        $id =  $teacher->id;
        $teacher->update($request->all());

        return redirect()->route('guru.teacher.show', $id);
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

    // edit teacher
    public function editTeacher(Teacher $teacher)
    {
        // dd($teacherid);
        return view('teacher.edit', compact('teacher'));
    }

    public function storeTeacher(Request $request, Teacher $teacher)
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

        // dd($request->all());
        // $teacher->where('id', $teacher->id)->update($validate);
        $id =  $teacher->id;
        $teacher->update($request->all());

        return redirect()->route('guru.profile', $id);
    }

    // .......................................//
    //handle tendik
    public function karyawan()
    {
        // ini jika ambil dari user->role lalu join dengan teacher
        // $tendiks = User::role('tendik')->join('teachers', 'users.id', '=', 'teachers.user_id')->get();

        $users = User::role('karyawan')->get();
        // $teachers = Teacher::all();
        return view('admin.teacher.karyawan', compact('users'));
    }
}
