<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Controllers\Api\PresencekaryawanController;

class CheckAppK
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $version = $request->header('version'); // Versi dari aplikasi frontend

        // Ambil versi minimum dari database
        // get setting dari controller PresenceController
        $setting_presence = new PresencekaryawanController();
        $requiredVersion = $setting_presence->getVersionK();

        if (!$requiredVersion || version_compare($version, $requiredVersion, '<')) {
            return response()->json([
                'status' => 'error',
                'pesan' => 'Mohon update aplikasi untuk melanjutkan!',
            ], 426); // 426: Upgrade Required
        }
        return $next($request);
    }
}
