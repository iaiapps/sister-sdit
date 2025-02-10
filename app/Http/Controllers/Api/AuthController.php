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

            // Hapus semua token lama
            $user->tokens()->delete();

            //create token
            $token = $user->createToken('auth_token')->plainTextToken;

            // get teacher_id
            $teacher_id = Teacher::where('user_id', $user->id)->first()->id;

            // get setting dari controller PresenceController
            $setting_presence = new PresenceController();
            $setting_presence_k = new PresencekaryawanController();

            // return hasil
            if ($user->hasRole(['guru', 'tendik'])) {
                return response()->json([
                    'access_token' => $token,
                    'data' => $user,
                    'token_type' => 'Bearer',
                    'teacher_id' => $teacher_id,
                    'qrcode' => $setting_presence->getQrCode(),
                    'latitude' => $setting_presence->getLatitude(),
                    'longitude' => $setting_presence->getLongitude(),
                    'radius' => $setting_presence->getRadius(),
                    'version' => $setting_presence->getVersion(),
                ]);
            } elseif ($user->hasRole('karyawan')) {
                return response()->json([
                    'access_token' => $token,
                    'data' => $user,
                    'token_type' => 'Bearer',
                    'teacher_id' => $teacher_id,
                    'qrcode' => $setting_presence->getQrCode(),
                    'latitude' => $setting_presence->getLatitude(),
                    'longitude' => $setting_presence->getLongitude(),
                    'radius' => $setting_presence->getRadius(),
                    'version' => $setting_presence_k->getVersionK(),
                ]);
            }
        } else {
            // jika salah return ini
            return response()->json(['message' => 'Email atau Password Salah!'], 401);
        }
    }

    // method for user logout and delete token
    public function logout()
    {
        // dd(auth()->user());
        auth()->user()->tokens()->delete();
        auth()->user()->currentAccessToken()->delete();
        return [
            'message' => 'You have successfully logged out and the token was successfully deleted'
        ];
    }

    public function verifyToken()
    {
        $user = Auth::guard('sanctum')->user();

        if (!$user) {
            return response()->json([
                'valid' => false,
                'message' => 'Token tidak valid atau sesi telah berakhir.',
            ], 403);
        }

        return response()->json([
            'valid' => true,
            'message' => 'Token valid.',
        ]);
    }
}
