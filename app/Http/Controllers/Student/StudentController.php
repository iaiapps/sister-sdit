<?php

namespace App\Http\Controllers\Student;

use App\Models\User;
use App\Models\Student;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $students = Student::get()->all();
        return view('student.index', compact('students'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        // dd(Auth::user()->id);
        $id = Auth::user()->id;

        $data = User::where('id', $id)->get()->first();
        return view('student.create', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Student::create($request->all());
        return redirect()->route('home');
    }

    /**
     * Display the specified resource.
     */
    public function show(Student $student)
    {
        $id = Auth::user()->id;
        return view('student.show', compact('student', 'id'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Student $student)
    {
        return view('student.edit', compact('student'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Student $student)
    {
        $request->validate([
            'full_name' => 'required',
            'nik' => 'required',
            'gender' => 'required',
            'place_of_birth' => 'required',
            'date_of_birth' => 'required',

        ]);

        // $student->where('id', $student->id)->update($validate);
        $id =  $student->id;
        $student->update($request->all());
        return redirect()->route('student.show', $id);
        // return redirect('biodata');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Student $student)
    {
        //
    }

    //handle user student
    public function profile()
    {
        $id = Auth::user()->id;
        $student = Student::where('user_id', $id)->first();
        return view('student.show', compact('student', 'id'));
    }
}
