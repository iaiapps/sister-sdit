<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class Role
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        //ambil data user
        $user = Auth::user();

        //looping roles
        foreach ($roles as $role) {
            //cek role
            if ($user->role->name == $role) {
                return $next($request);
            }
        }
        return abort('403');
    }
}
