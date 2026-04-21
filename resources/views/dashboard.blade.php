<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Monitoring Banjir Real-Time | BPBD Kota Tegal</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;800&display=swap" rel="stylesheet">
    <style>body { font-family: 'Plus Jakarta Sans', sans-serif; }</style>
</head>
<body class="transition-all duration-700 ease-in-out min-h-screen 
    {{ $latest->water_level > 150 ? 'bg-red-950 text-red-100' : ($latest->water_level >= 100 ? 'bg-orange-950 text-orange-100' : 'bg-slate-950 text-slate-100') }}">

    <nav class="flex justify-between items-center px-8 py-6 bg-black/20 backdrop-blur-md border-b border-white/10">
        <div class="flex items-center gap-3">
            <span class="text-2xl">🌊</span>
            <h1 class="font-bold text-xl tracking-tighter text-white">FLOOD-EWS</h1>
        </div>

        <div class="flex items-center gap-6">
            @if (Route::has('login'))
                @auth
                    <a href="{{ url('/dashboard') }}" class="px-5 py-2 bg-white/10 hover:bg-white/20 rounded-full text-sm font-semibold transition text-white">Panel Admin</a>
                @else
                    <a href="{{ route('login') }}" class="px-5 py-2 bg-white/10 hover:bg-white/20 rounded-full text-sm font-semibold transition text-white">Login Petugas</a>
                @endauth
            @endif
        </div>
    </nav>

    <main class="max-w-7xl mx-auto p-8">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-8">
            <div class="lg:col-span-1 p-10 rounded-[2.5rem] bg-white/5 border border-white/10 backdrop-blur-xl">
                <span class="text-[10px] font-bold opacity-50 uppercase tracking-[0.3em]">Status Terkini</span>
                <h2 class="text-7xl font-black mt-4 mb-4 tracking-tighter">{{ $latest->status }}</h2>
                <p class="text-sm opacity-60 leading-relaxed">Sistem mendeteksi kondisi air di Desa Kaligangsa dalam keadaan <strong>{{ $latest->status }}</strong>.</p>
            </div>

            <div class="lg:col-span-2 grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="p-10 rounded-[2.5rem] bg-gradient-to-br from-white/10 to-transparent border border-white/10">
                    <p class="text-[10px] font-bold opacity-50 uppercase tracking-[0.2em] mb-4">Level Ketinggian Air</p>
                    <div class="flex items-end gap-2">
                        <span class="text-9xl font-black tracking-tighter">{{ $latest->water_level }}</span>
                        <span class="text-2xl font-bold mb-4 opacity-40">CM</span>
                    </div>
                </div>

                <div class="flex flex-col gap-8">
                    <div class="p-8 rounded-[2rem] bg-white/5 border border-white/10 flex justify-between items-center">
                        <div>
                            <p class="text-[10px] opacity-50 uppercase font-bold mb-1">Kecepatan Arus</p>
                            <p class="text-3xl font-bold">{{ $latest->water_flow ?? '0.0' }} <span class="text-sm opacity-30">m/s</span></p>
                        </div>
                        <span class="text-4xl opacity-40">🌫️</span>
                    </div>
                    <div class="p-8 rounded-[2rem] bg-white/5 border border-white/10 flex justify-between items-center">
                        <div>
                            <p class="text-[10px] opacity-50 uppercase font-bold mb-1">Kondisi Cuaca</p>
                            <p class="text-3xl font-bold uppercase">{{ $latest->is_raining ? 'Hujan' : 'Cerah' }}</p>
                        </div>
                        <span class="text-4xl opacity-40">{{ $latest->is_raining ? '🌧️' : '☀️' }}</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="p-10 rounded-[3rem] bg-white/5 border border-white/10 backdrop-blur-md">
            <h3 class="font-bold text-lg mb-8 flex items-center gap-2">
                <span class="w-2 h-2 bg-red-500 rounded-full animate-pulse"></span>
                Tren Perubahan Air Real-Time
            </h3>
            <div class="h-[400px]">
                <canvas id="floodChart"></canvas>
            </div>
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
                labels: ['19:00', '19:15', '19:30', '19:45', '20:00', '20:15', 'Sekarang'],
                datasets: [{
                    data: [78, 82, 85, 83, 88, 86, {{ $latest->water_level }}],
                    borderColor: '#843b3b',
                    borderWidth: 4,
                    fill: true,
                    backgroundColor: gradient,
                    tension: 0.4,
                    pointRadius: 6,
                    pointBackgroundColor: '#ffffff'
                }]
            },
            options: {
                responsive: true, maintainAspectRatio: false,
                plugins: { legend: { display: false } },
                scales: {
                    y: { grid: { color: 'rgba(255, 255, 255, 0.05)' }, ticks: { color: 'rgba(255, 255, 255, 0.4)' } },
                    x: { grid: { display: false }, ticks: { color: 'rgba(255, 255, 255, 0.4)' } }
                }
            }
        });
    </script>
</body>
</html>