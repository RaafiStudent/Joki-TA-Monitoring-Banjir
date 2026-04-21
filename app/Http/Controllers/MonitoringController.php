<?php

namespace App\Http\Controllers;

use App\Models\SensorLog;
use Illuminate\Http\Request;

class MonitoringController extends Controller
{
    public function index()
    {
        // Ambil data terbaru dari sensor
        $latest = SensorLog::latest()->first();
        
        // Data dummy jika database masih kosong untuk testing awal
        if (!$latest) {
            $latest = (object) [
                'water_level' => 85,
                'water_flow' => 0.5,
                'is_raining' => false,
                'status' => 'Aman'
            ];
        }

        return view('dashboard', compact('latest'));
    }

    // Fungsi ini nanti dipanggil oleh ESP32 via API/MQTT
    public function storeData(Request $request) {
        $level = $request->water_level;
        
        // Logika Threshold sesuai proposal BPBD [cite: 576, 604]
        if ($level < 100) {
            $status = 'Aman';
        } elseif ($level <= 150) {
            $status = 'Siaga';
        } else {
            $status = 'Bahaya';
            // Di sini nanti pemicu WhatsApp Gateway [cite: 586, 608]
        }

        SensorLog::create([
            'water_level' => $level,
            'water_flow' => $request->water_flow,
            'is_raining' => $request->is_raining,
            'status' => $status
        ]);
        
        return response()->json(['message' => 'Data berhasil disimpan']);
    }
}
