<?php

use App\Http\Controllers\Api\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Endpoint untuk cek user yang sedang login (butuh token Sanctum)
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// --- TAMBAHKAN ROUTE LOGIN DI SINI ---
Route::post('/login', [AuthController::class, 'login']);

// Loop untuk memuat file route lain jika ada
foreach (glob(__DIR__.'/api/*.php') ?: [] as $filename) {
    require $filename;
}