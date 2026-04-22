<nav class="fixed w-full top-0 z-[100] bg-slate-900/80 backdrop-blur-lg border-b border-slate-800 transition-all">
    <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
        <div class="flex items-center gap-3">
            <a href="{{ route('monitoring') }}" class="flex items-center gap-3 group">
                <div class="w-9 h-9 rounded-xl bg-cyan-500 flex items-center justify-center shadow-lg shadow-cyan-500/40 group-hover:scale-110 transition-transform">
                    <svg class="w-5 h-5 text-slate-900" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                </div>
                <span class="font-bold text-xl tracking-tight text-white">Flood<span class="text-cyan-400">Monitor</span></span>
            </a>
        </div>
        
        <div class="hidden md:flex items-center gap-8 text-sm font-semibold text-slate-300">
            <a href="#home" class="hover:text-cyan-400 transition-colors">Beranda</a>
            <a href="#monitoring" class="hover:text-cyan-400 transition-colors">Dashboard</a>
            <a href="#info" class="hover:text-cyan-400 transition-colors">Informasi</a>
            <a href="#tentang" class="hover:text-cyan-400 transition-colors">Tentang</a>
        </div>

        <div>
            @auth
                <a href="{{ route('dashboard') }}" class="px-6 py-2.5 text-sm font-bold text-slate-900 bg-cyan-400 hover:bg-cyan-300 rounded-xl shadow-lg transition-all">Panel Admin</a>
            @else
                <a href="{{ route('login') }}" class="px-6 py-2.5 text-sm font-bold text-slate-900 bg-cyan-400 hover:bg-cyan-300 rounded-xl shadow-lg transition-all">Login Admin</a>
            @endauth
        </div>
    </div>
</nav>