<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
// use App\Http\Controllers\Api\SalaryController;
use App\Http\Controllers\Api\PresenceController;
use App\Http\Controllers\Api\PresencekaryawanController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

//route login
Route::get('/', function () {
    return view('api.app');
});

Route::post('/login', [AuthController::class, 'login']);

//Protecting Routes
Route::group(['middleware' => ['auth:sanctum']], function () {

    //akses data presensi
    Route::resource('presence', PresenceController::class);
    // Route::resource('salary', SalaryController::class);
    // Route::get('jam', [PresenceController::class, 'jam']);
    // Route::get('qrcode', [PresenceController::class, 'getQrCode']);

    //presence karyawan
    Route::resource('presencekaryawan', PresencekaryawanController::class);

    //route logout
    Route::post('/logout', [AuthController::class, 'logout']);
});
