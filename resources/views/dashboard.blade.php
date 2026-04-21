<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Monitoring Banjir</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="transition-colors duration-500 
    {{ $latest->water_level > 150 ? 'bg-red-600' : ($latest->water_level >= 100 ? 'bg-orange-500' : 'bg-green-500') }}">
    
    <div class="min-h-screen flex flex-col items-center justify-center text-white p-6">
        <h1 class="text-3xl font-bold mb-8 uppercase tracking-widest">Monitoring Banjir Real-Time</h1>
        
        <div class="bg-white/20 backdrop-blur-md rounded-3xl p-10 shadow-2xl text-center border border-white/30">
            <p class="text-lg font-medium mb-2">STATUS SAAT INI</p>
            <h2 class="text-6xl font-black mb-4 uppercase">{{ $latest->status }}</h2>
            
            <div class="flex gap-10 mt-8">
                <div>
                    <p class="text-sm opacity-80">KETINGGIAN AIR</p>
                    <p class="text-4xl font-bold">{{ $latest->water_level }} <span class="text-xl">cm</span></p>
                </div>
                <div class="border-l border-white/30 pl-10">
                    <p class="text-sm opacity-80">KONDISI CUACA</p>
                    <p class="text-4xl font-bold">{{ $latest->is_raining ? 'Hujan' : 'Cerah' }}</p>
                </div>
            </div>
        </div>

        <p class="mt-10 text-sm opacity-70 italic font-light">
            Sistem Terintegrasi dengan BPBD Kota Tegal [cite: 441, 608]
        </p>
    </div>
</body>
</html>