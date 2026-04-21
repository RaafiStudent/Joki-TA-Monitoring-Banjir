<?php

use App\Http\Controllers\MonitoringController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Pastikan halaman depan tetap dasbor monitoring kamu
Route::get('/', [MonitoringController::class, 'index'])->name('monitoring');

// Rute auth bawaan Breeze (biarkan saja)
Route::get('/dashboard', function () {
    return view('admin.dashboard'); // Nanti kita buat folder admin
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/auth.php';