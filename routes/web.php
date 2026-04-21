<?php

use App\Http\Controllers\MonitoringController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// 1. Halaman Utama untuk MASYARAKAT UMUM (Tanpa Login)
Route::get('/', [MonitoringController::class, 'index'])->name('monitoring');

// 2. Halaman Khusus PETUGAS/ADMIN (Wajib Login)
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard_admin'); // Kita bedakan nama filenya nanti
    })->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    // ... rute profile lainnya ...
});

require __DIR__.'/auth.php';