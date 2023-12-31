<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\School;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $base  = Auth::user();
        $id = $base->id;
        $user = $base->name;
        $role_id = $base->role_id;

        $nis = $base->nis;
        // dd($role_id);

        //get total user where role_id 2 atau 3
        $sumteacher = User::where('role_id', 2)->count();
        $sumstudent = User::where('role_id', 3)->count();

        //get user id
        $teacher = Teacher::where('user_id', $id)->first();
        $student = Student::where('user_id', $id)->first();

        //tampilkan foto profil
        if (!empty($teacher->id) || !empty($student->id)) {
            if (empty($nis)) {
                $picture = Document::where('type', 'foto_profil')->where('teacher_id', $teacher->id)->first();
            } else {
                $picture = Document::where('type', 'foto_profil')->where('student_id', $student->id)->first();
            }
        } else {
            $picture = null;
        }

        //get school data
        $schools = School::get()->all();

        // dd($role_id);
        switch ($role_id) {
            case '1':
                return view('admin.home', compact('user', 'sumteacher', 'sumstudent', 'schools'));
                break;

            case '2':
                return view('teacher.home', compact('teacher', 'schools', 'picture'));
                break;

            case '3':
                if (empty($student->id)) {
                    return redirect()->route('student.create');
                } else {
                    return view('student.home', compact('student', 'picture'));
                }
                break;

            default:
                return view('admin.home', compact('user', 'sumteacher', 'sumstudent', 'schools'));
        }
    }

    public function changePassword()
    {
        return view('auth.change');
    }

    public function storeChangePassword(Request $request)
    {
        # Validation
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|confirmed',
        ]);


        #Match The Old Password
        if (!Hash::check($request->old_password, auth()->user()->password)) {
            return back()->with("error", "Old Password Doesn't match!");
        }

        #Update the new Password
        User::whereId(auth()->user()->id)->update([
            'password' => Hash::make($request->new_password)
        ]);

        return back()->with("status", "Password changed successfully!");
    }
}
