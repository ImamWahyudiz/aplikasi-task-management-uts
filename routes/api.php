<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Tambahan route role-based
Route::middleware(['auth:sanctum', 'role:admin'])->get('/admin-only', function () {
    return response()->json(['message' => 'Admin']);
});

Route::middleware(['auth:sanctum', 'role:mahasiswa'])->get('/mahasiswa-dashboard', function () {
    return response()->json(['message' => 'Mahasiswa']);
});

Route::middleware(['auth:sanctum', 'role:dosen,admin'])->get('/dosen-or-admin', function () {
    return response()->json(['message' => 'Dosen']);
});

Route::post('/register', [RegisteredUserController::class, 'store']);
Route::post('/login', [AuthenticatedSessionController::class, 'store']);
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
