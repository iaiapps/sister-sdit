<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::get()->all();
        return view('admin.user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.user.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // validasi data masuk
        $validate = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required|confirmed',
            'role_id' => 'required',
        ]);
        //masukkan hash password
        $validate['password'] = Hash::make($validate['password']);
        $validate['nis'] = $request->input('nis');

        //buat user baru
        //ambil id dari user untuk dimasukkan ke user id
        $id = User::create($validate)->id;

        $role = Role::where('id', $request->role_id)->first()->name;

        // dd($role);
        if ($role == 'Guru/Tendik') {
            //buat teacher baru bersadarkan user yang baru mendaftar
            Teacher::create([
                'user_id' => $id,
                'full_name' => $request->name,
                'email' => $request->email
            ]);
        }

        return redirect()->route('user.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return view('admin.user.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {

        $user->delete();
        return redirect('user');
    }
}
