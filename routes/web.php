<?php

use App\Http\Controllers\MonitoringController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// 1. Halaman Utama untuk MASYARAKAT UMUM (Landing Page Premium)
// Mengambil data real-time dari MonitoringController
Route::get('/', [MonitoringController::class, 'index'])->name('monitoring');

// 2. Halaman Khusus PETUGAS/ADMIN (Wajib Login)
// Dibungkus dengan middleware 'auth' agar tidak bisa diakses sembarang orang
Route::middleware(['auth', 'verified'])->group(function () {
    
    // Rute menuju Panel Admin (Tabel Riwayat Data)
    Route::get('/dashboard', function () {
        // Ini akan memanggil file: resources/views/admin/dashboard.blade.php
        return view('admin.dashboard'); 
    })->name('dashboard');

    // Rute bawaan Breeze untuk pengaturan akun petugas
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';