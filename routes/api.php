<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\PresenceController;

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
Route::post('/login', [AuthController::class, 'login']);

//Protecting Routes
Route::group(['middleware' => ['auth:sanctum']], function () {
    // Route::get('/user', function (Request $request) {
    //     return auth()->user();
    // });

    //akses data presensi
    Route::resource('presence', PresenceController::class);
    Route::get('jam', [PresenceController::class, 'jam']);
    //route logout
    Route::post('/logout', [AuthController::class, 'logout']);
});
