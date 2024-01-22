<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\School;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\Document;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
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
        /** @var \App\Models\User */
        $user  = Auth::user();
        $id = $user->id;
        $name = $user->name;

        $teacher = Teacher::where('user_id', $id)->first();

        // dd($id);
        // get foto profil
        if (!empty($teacher->id)) {
            $picture = Document::where('type', 'foto_profil')->where('teacher_id', $teacher->id)->first();
        } else {
            $picture = null;
        }

        //get school data
        $schools = School::get()->all();

        //get role names
        $role = $user->getRoleNames()->first();

        //get total user
        $sumguru = User::role('guru')->count();
        $sumtendik = User::role('tendik')->count();


        switch ($role) {
            case 'admin':
                return view('home.home', compact('name', 'sumguru', 'sumtendik', 'schools'));
                break;

            case 'guru' || 'tendik':
                return view('home.ghome', compact('teacher', 'schools', 'picture'));
                break;

            default:
                return view('home.nahome', compact('name'));
        }
    }

    // ganti password
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
