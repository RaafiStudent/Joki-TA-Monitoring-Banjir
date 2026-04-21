<?php

use App\Http\Controllers\MonitoringController;
use Illuminate\Support\Facades\Route;


Route::get('/', [MonitoringController::class, 'index']);
Route::post('/api/sensor', [MonitoringController::class, 'storeData']);