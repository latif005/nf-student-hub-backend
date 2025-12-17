<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\PostinganController;
use App\Http\Controllers\Api\InteraksiController;
use App\Http\Controllers\Api\UktController;
// Jangan lupa import controller lain jika ada (Jadwal, Pengumuman)

// === PUBLIC ROUTES ===
Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);

// === PRIVATE ROUTES (HARUS LOGIN) ===
Route::middleware('auth:sanctum')->group(function () {
    
    // Fitur UKT (Keuangan)
    Route::get('/ukt/all', [UktController::class, 'all']);       // Admin
    Route::put('/ukt/{id}', [UktController::class, 'updateStatus']); // Admin
    Route::get('/ukt/my', [UktController::class, 'index']);      // Mahasiswa
    Route::post('/ukt', [UktController::class, 'store']);        // Buat Tagihan (Testing)

    // Fitur Sosmed & Lainnya (Yang sudah dibuat sebelumnya)
    Route::get('/postingans', [PostinganController::class, 'index']);
    Route::post('/postingans', [PostinganController::class, 'store']);
    Route::post('/postingans/{id}/like', [InteraksiController::class, 'toggleLike']);
    Route::post('/postingans/{id}/komentar', [InteraksiController::class, 'kirimKomentar']);
    Route::get('/postingans/{id}/komentar', [InteraksiController::class, 'getKomentar']);

    // 👇 TAMBAHAN ROUTE BARU
    Route::get('/user', function (Illuminate\Http\Request $request) {
        return $request->user();
    }); // Ambil data diri
    Route::put('/user/update', [AuthController::class, 'updateProfile']); // Update data diri
    
});