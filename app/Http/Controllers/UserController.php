<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::where('id', '!=', 1)->get();
        $not_active = User::doesntHave('roles')->get();
        // dd($not_active);
        return view('admin.user.index', compact('users', 'not_active'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $role = Role::All();
        return view('admin.user.create', compact('role'));
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
            'active' => 'required',
            'role' => 'required',
        ]);
        //masukkan hash password
        $validate['password'] = Hash::make($validate['password']);

        //buat user baru
        $user = User::create($validate);

        //tetapkan role setelah user dibuat
        $user->assignRole($request->role);

        //ambil id dari user untuk dimasukkan ke user id
        $id = $user->id;

        //buat teacher baru bersadarkan user yang baru mendaftar
        Teacher::create([
            'user_id' => $id,
            'full_name' => $request->name,
            'email' => $request->email
        ]);
        // }

        return redirect()->route('admin.user.index');
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
        $role = Role::All();
        return view('admin.user.edit', compact('user', 'role'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        // validasi data masuk
        $validate = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'active' => 'required',
            'role' => 'required',
        ]);

        // update user
        $user->update($validate);

        //tetapkan role setelah user dibuat
        $user->syncRoles($request->role);

        // return ke halaman user
        return redirect()->route('admin.user.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('admin.user.index');
    }

    // helper
    public function resetpass(Request $request)
    {
        $id = $request->id;
        User::where('id', $id)->update(['password' => Hash::make('password')]);
        // dd($id);
        return redirect()->route('user.index');
    }
}
