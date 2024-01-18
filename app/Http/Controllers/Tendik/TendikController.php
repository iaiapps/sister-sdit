<?php

namespace App\Http\Controllers\Tendik;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TendikController extends Controller
{
    public function index()
    {
        $users = User::role('tendik')->get();
        return view('admin.tendik.index', compact('users'));
    }
}
