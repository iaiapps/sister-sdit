<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Models\Teacher;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        // input dari user
        $credentials = $request->only('email', 'password');

        // cek login dengan attempt 
        if (Auth::attempt($credentials)) {
            // cek user dari email
            $user = User::where('email', $request['email'])->firstOrFail();
            //create token
            $token = $user->createToken('auth_token')->plainTextToken;
            // get teacher_id
            $teacher_id = Teacher::where('email', $user->email)->first()->id;
            // get qrcode dari controller PresenceController
            $qr = new PresenceController();
            // return hasil
            return response()->json([
                'access_token' => $token,
                'data' => $user,
                'token_type' => 'Bearer',
                'teacher_id' => $teacher_id,
                'qrcode' => $qr->getQrCode()
            ]);
        } else {
            // jika salah return ini
            return response()->json(['message' => 'Email atau Password Salah!'], 401);
        }
    }

    // method for user logout and delete token
    public function logout()
    {
        auth()->user()->tokens()->delete();
        return [
            'message' => 'You have successfully logged out and the token was successfully deleted'
        ];
    }
}
