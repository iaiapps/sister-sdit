<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentLoginController extends Controller
{
    public function indexLogin()
    {
        return view('student.login.login');
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'nis' => ['required'],
            'password' => ['required'],
        ]);

        // dd($credentials);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended('home');
        }

        return back()->withErrors([
            'nis' => 'Nis atau Password tidak sesuai!',
        ])->onlyInput('nis');
    }
}
