<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\PersonalAccessToken;
use Symfony\Component\HttpFoundation\Response;

class AuthToken
{
    public function handle(Request $request, Closure $next): Response
    {
        $token = $request->query('token');

        if ($token) {
            session()->put('auth_token', $token);
        } else {
            $token = session()->get('auth_token');
        }

        if (!$token) {
            return response('Unauthorized. Silakan login terlebih dahulu.', 401);
        }

        $accessToken = PersonalAccessToken::findToken($token);

        if (!$accessToken || !$accessToken->tokenable) {
            session()->forget('auth_token');
            return response('Token tidak valid. Silakan login ulang.', 401);
        }

        Auth::login($accessToken->tokenable);

        return $next($request);
    }
}
