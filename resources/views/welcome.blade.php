<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Monitoring Banjir Terintegrasi | BPBD Kota Tegal</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;600;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>
<body class="transition-all duration-700 ease-in-out min-h-screen 
    {{ $latest->water_level > 150 ? 'bg-red-950 text-red-100' : ($latest->water_level >= 100 ? 'bg-orange-950 text-orange-100' : 'bg-slate-950 text-slate-100') }}">

    <nav class="flex justify-between items-center px-8 py-6 bg-black/20 backdrop-blur-md border-b border-white/10">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 bg-white/10 rounded-xl flex items-center justify-center">
                <span class="text-2xl">🌊</span>
            </div>
            <div>
                <h1 class="font-bold text-xl tracking-tight">FLOOD-EWS</h1>
                <p class="text-[10px] opacity-60 uppercase tracking-widest">BPBD Integrated System</p>
            </div>
        </div>

        <div class="flex items-center gap-6">
            @if (Route::has('login'))
                @auth
                    <a href="{{ url('/dashboard') }}" class="px-5 py-2 bg-white/10 hover:bg-white/20 rounded-full text-sm font-semibold transition">Panel Petugas</a>
                @else
                    <a href="{{ route('login') }}" class="px-5 py-2 bg-white/10 hover:bg-white/20 rounded-full text-sm font-semibold transition">Login Admin</a>
                @endauth
            @endif
        </div>
    </nav>

    <main class="max-w-7xl mx-auto p-8">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-8">
            <div class="lg:col-span-1 p-8 rounded-[2rem] bg-white/5 border border-white/10 backdrop-blur-xl flex flex-col justify-between">
                <div>
                    <span class="text-xs font-bold opacity-50 uppercase tracking-[0.2em]">Kondisi Saat Ini</span>
                    <h2 class="text-7xl font-extrabold mt-4 mb-2">{{ $latest->status }}</h2>
                    <p class="text-sm opacity-70">Sistem mendeteksi status <strong>{{ $latest->status }}</strong> berdasarkan ambang batas ketinggian air.</p>
                </div>
                <div class="mt-12 pt-6 border-t border-white/10">
                    <p class="text-xs opacity-50 mb-1 font-bold">Terakhir Diperbarui</p>
                    <p class="text-sm font-mono">{{ now()->format('d M Y | H:i:s') }}</p>
                </div>
            </div>

            <div class="lg:col-span-2 grid grid-cols-1 md:grid-cols-2 gap-8 text-white">
                <div class="p-8 rounded-[2rem] bg-gradient-to-br from-white/10 to-transparent border border-white/10 relative overflow-hidden">
                    <p class="text-xs font-bold opacity-50 uppercase mb-4">Water Level</p>
                    <div class="flex items-end gap-3">
                        <span class="text-8xl font-black">{{ $latest->water_level }}</span>
                        <span class="text-2xl font-bold mb-3 opacity-50">CM</span>
                    </div>
                    <div class="absolute -right-4 -bottom-4 opacity-10 text-9xl">📈</div>
                </div>

                <div class="grid grid-rows-2 gap-8">
                    <div class="px-8 py-6 rounded-[1.5rem] bg-white/5 border border-white/10 flex items-center justify-between">
                        <div>
                            <p class="text-[10px] font-bold opacity-50 uppercase mb-1">Kecepatan Arus</p>
                            <p class="text-3xl font-bold">{{ $latest->water_flow ?? '0.0' }} <span class="text-sm opacity-40">m/s</span></p>
                        </div>
                        <span class="text-4xl">🌫️</span>
                    </div>
                    <div class="px-8 py-6 rounded-[1.5rem] bg-white/5 border border-white/10 flex items-center justify-between">
                        <div>
                            <p class="text-[10px] font-bold opacity-50 uppercase mb-1">Curah Hujan</p>
                            <p class="text-3xl font-bold">{{ $latest->is_raining ? 'HUJAN' : 'CERAH' }}</p>
                        </div>
                        <span class="text-4xl">{{ $latest->is_raining ? '🌧️' : '☀️' }}</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="p-8 rounded-[2rem] bg-white/5 border border-white/10 backdrop-blur-md">
            <div class="flex justify-between items-center mb-8">
                <h3 class="font-bold text-lg">Histori Ketinggian Air (Trend)</h3>
                <div class="flex gap-2">
                    <span class="px-3 py-1 bg-white/10 rounded-lg text-[10px] font-bold">LIVE UPDATE</span>
                </div>
            </div>
            <div class="h-[400px]">
                <canvas id="floodChart"></canvas>
            </div>
        </div>

        <footer class="mt-12 text-center opacity-40">
            <p class="text-xs uppercase tracking-[0.3em]">Universitas Harkat Negeri | Tugas Akhir - Nida Nafila</p>
        </div>
    </main>

    <script>
        const ctx = document.getElementById('floodChart').getContext('2d');
        const gradient = ctx.createLinearGradient(0, 0, 0, 400);
        gradient.addColorStop(0, 'rgba(255, 255, 255, 0.2)');
        gradient.addColorStop(1, 'rgba(255, 255, 255, 0)');

        new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['18:00', '18:15', '18:30', '18:45', '19:00', '19:15', '19:30'], // Dummy labels
                datasets: [{
                    label: 'Level Air (cm)',
                    data: [82, 85, 90, 88, 92, 105, {{ $latest->water_level }}], // Data dummy + terbaru
                    borderColor: '#ffffff',
                    borderWidth: 4,
                    fill: true,
                    backgroundColor: gradient,
                    tension: 0.4,
                    pointRadius: 5,
                    pointBackgroundColor: '#ffffff'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { display: false } },
                scales: {
                    y: { 
                        grid: { color: 'rgba(255, 255, 255, 0.1)' },
                        ticks: { color: 'rgba(255, 255, 255, 0.5)', font: { size: 10 } }
                    },
                    x: { 
                        grid: { display: false },
                        ticks: { color: 'rgba(255, 255, 255, 0.5)', font: { size: 10 } }
                    }
                }
            }
        });
    </script>
</body>
</html>