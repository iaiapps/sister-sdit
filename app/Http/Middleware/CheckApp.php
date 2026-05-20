<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class CheckApp
{
    public function handle(Request $request, Closure $next): Response
    {
        $version = $request->header('version');

        $row = DB::table('presence_settings')->where('name', 'version')->first();
        $requiredVersion = $row?->value;

        if (!$requiredVersion || version_compare($version, $requiredVersion, '<')) {
            return response()->json([
                'status' => 'error',
                'pesan' => 'Mohon update aplikasi untuk melanjutkan!',
            ], 426);
        }
        return $next($request);
    }
}
