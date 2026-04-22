<x-app-layout>
    <x-slot name="bodyClass">
        @php
            $lvl = $latest->water_level ?? 0;
            if($lvl > 150) echo 'bg-[#1a0505] text-red-100';
            elseif($lvl >= 100) echo 'bg-[#1a0f05] text-orange-100';
            else echo 'bg-[#020617] text-slate-100';
        @endphp
    </x-slot>

    <section class="relative min-h-[90vh] flex flex-col justify-center items-center px-6 text-center overflow-hidden">
        <div class="absolute top-1/4 -left-20 w-96 h-96 bg-blue-600/10 rounded-full blur-[120px] -z-10"></div>
        
        <div class="max-w-5xl">
            <span class="inline-block px-4 py-1.5 rounded-full bg-blue-500/10 border border-blue-500/20 text-[10px] font-black uppercase tracking-[0.3em] text-blue-400 mb-8">
                Integrated with WhatsApp Gateway
            </span>
            <h1 class="text-6xl md:text-8xl font-extrabold tracking-tighter leading-[0.9] mb-8 bg-clip-text text-transparent bg-gradient-to-b from-white to-white/40">
                SISTEM MONITORING <br> & PERINGATAN BANJIR
            </h1>
            <p class="text-lg md:text-xl opacity-60 max-w-2xl mx-auto mb-12 font-light leading-relaxed">
                Platform peringatan dini real-time untuk Desa Kaligangsa, Kec. Margadana, Kota Tegal, Jawa Tengah.
            </p>
            <a href="#monitoring" class="inline-flex items-center gap-3 px-10 py-5 rounded-full bg-white text-black font-extrabold hover:scale-105 transition shadow-2xl shadow-white/5">
                Lihat Dashboard <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
            </a>
        </div>
    </section>

    <section id="monitoring" class="py-24 px-6 max-w-7xl mx-auto">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-stretch">
            
            <div class="lg:col-span-5 p-12 rounded-[3.5rem] bg-white/5 border border-white/10 backdrop-blur-xl flex flex-col items-center justify-center text-center shadow-2xl transition-all duration-700
                {{ $lvl > 150 ? 'border-red-500/50 shadow-red-500/10' : ($lvl >= 100 ? 'border-orange-500/50 shadow-orange-500/10' : 'border-green-500/50 shadow-green-500/10') }}">
                
                <p class="text-[10px] font-black uppercase tracking-[0.5em] opacity-40 mb-12">Current Condition</p>
                <h3 class="text-9xl font-black tracking-tighter mb-4
                    {{ $lvl > 150 ? 'text-red-500' : ($lvl >= 100 ? 'text-orange-500' : 'text-green-500') }}">
                    {{ $latest->status ?? 'AMAN' }}
                </h3>
                <div class="h-1.5 w-16 bg-white/10 rounded-full mb-12"></div>
                <div class="flex items-baseline gap-2">
                    <span class="text-6xl font-black">{{ $lvl }}</span>
                    <span class="text-xl font-bold opacity-30 tracking-widest">CM</span>
                </div>
            </div>

            <div class="lg:col-span-7 p-10 rounded-[3.5rem] bg-white/5 border border-white/10 backdrop-blur-md h-full min-h-[450px]">
                <div class="flex justify-between items-center mb-10">
                    <h4 class="font-bold text-lg tracking-tight italic">Trend Analysis</h4>
                    <span class="text-[10px] font-bold opacity-40 tracking-[0.2em] uppercase px-3 py-1 bg-white/5 rounded-lg border border-white/10">Live Stream</span>
                </div>
                <div class="h-[320px]">
                    <canvas id="floodTrendChart"></canvas>
                </div>
            </div>
        </div>
    </section>

    <section class="py-24 px-6 max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-4 gap-8">
        @foreach([
            ['⚡', 'Real-time', 'Update data setiap detik.'],
            ['🎨', 'Adaptif', 'Warna berubah otomatis.'],
            ['💬', 'WhatsApp', 'Notifikasi cepat ke warga.'],
            ['🏛️', 'BPBD', 'Terintegrasi pusat data.']
        ] as [$icon, $title, $desc])
        <div class="p-10 rounded-[2.5rem] bg-white/5 border border-white/10 hover:bg-white/10 transition-all group">
            <div class="text-4xl mb-6 group-hover:scale-110 transition-transform">{{ $icon }}</div>
            <h5 class="font-bold text-lg mb-2">{{ $title }}</h5>
            <p class="text-xs opacity-40 leading-relaxed">{{ $desc }}</p>
        </div>
        @endforeach
    </section>

    <footer class="py-20 border-t border-white/5 text-center bg-black/20 backdrop-blur-3xl">
        <h6 class="text-xl font-black uppercase tracking-tighter mb-4 text-white">Flood.EWS</h6>
        <p class="text-xs opacity-40 max-w-md mx-auto mb-8 leading-relaxed">
            Desa Kaligangsa, Kec. Margadana, Kota Tegal, Jawa Tengah. <br> 
            © 2026 TA - Nida Nafila (23040103)
        </p>
        <div class="flex justify-center gap-6 opacity-30 text-[10px] font-bold tracking-[0.4em] uppercase">
            <span>Precision</span> <span>•</span> <span>Real-time</span> <span>•</span> <span>Safe</span>
        </div>
    </footer>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const ctx = document.getElementById('floodTrendChart').getContext('2d');
            const gradient = ctx.createLinearGradient(0, 0, 0, 320);
            gradient.addColorStop(0, 'rgba(59, 130, 246, 0.2)');
            gradient.addColorStop(1, 'rgba(59, 130, 246, 0)');

            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: ['18:00', '20:00', '22:00', '00:00', '02:00', 'Sekarang'],
                    datasets: [{
                        data: [45, 52, 60, 58, 65, {{ $lvl }}],
                        borderColor: '#3b82f6',
                        borderWidth: 5,
                        tension: 0.45,
                        fill: true,
                        backgroundColor: gradient,
                        pointRadius: 0
                    }]
                },
                options: {
                    responsive: true, maintainAspectRatio: false,
                    plugins: { legend: { display: false } },
                    scales: {
                        y: { grid: { color: 'rgba(255, 255, 255, 0.05)' }, ticks: { color: 'rgba(255, 255, 255, 0.3)', font: { size: 10 } } },
                        x: { grid: { display: false }, ticks: { color: 'rgba(255, 255, 255, 0.3)', font: { size: 10 } } }
                    }
                }
            });
        });
    </script>
</x-app-layout>