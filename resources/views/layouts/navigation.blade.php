<nav x-data="{ scrolled: false, open: false }" 
     @scroll.window="scrolled = (window.pageYOffset > 20) ? true : false"
     :class="scrolled ? 'bg-black/70 border-white/10 py-3 shadow-2xl' : 'bg-transparent border-transparent py-6'"
     class="fixed top-0 w-full z-[100] transition-all duration-500 border-b backdrop-blur-md">
    
    <div class="max-w-7xl mx-auto px-6">
        <div class="flex justify-between items-center">
            
            <div class="flex items-center gap-4">
                <a href="{{ route('monitoring') }}" class="group flex items-center gap-3">
                    <div class="w-10 h-10 bg-blue-600 rounded-xl flex items-center justify-center shadow-lg shadow-blue-600/40 group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                        </svg>
                    </div>
                    <div class="flex flex-col">
                        <span class="text-white text-xl font-black tracking-tighter leading-none uppercase">Flood.EWS</span>
                        <span class="text-[8px] text-blue-400 font-bold tracking-[0.3em] uppercase opacity-80">BPBD Integrated</span>
                    </div>
                </a>
            </div>

            <div class="hidden md:flex items-center gap-10">
                <a href="{{ route('monitoring') }}" 
                   class="text-[11px] font-bold uppercase tracking-[0.2em] transition-all duration-300 {{ request()->routeIs('monitoring') ? 'text-blue-500' : 'text-white/60 hover:text-white' }}">
                    Home
                </a>
                <a href="#dashboard" class="text-[11px] font-bold uppercase tracking-[0.2em] text-white/60 hover:text-white transition-all">
                    Dashboard
                </a>
                <a href="#tentang" class="text-[11px] font-bold uppercase tracking-[0.2em] text-white/60 hover:text-white transition-all">
                    Tentang
                </a>
                <a href="#kontak" class="text-[11px] font-bold uppercase tracking-[0.2em] text-white/60 hover:text-white transition-all">
                    Kontak
                </a>
            </div>

            <div class="flex items-center gap-4">
                @auth
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="flex items-center gap-3 px-4 py-2 rounded-xl bg-white/5 border border-white/10 hover:bg-white/10 transition-all group">
                                <div class="text-right hidden sm:block">
                                    <p class="text-[10px] font-black text-white leading-none uppercase">{{ Auth::user()->name }}</p>
                                    <p class="text-[8px] text-blue-400 font-bold uppercase tracking-widest mt-1">Petugas Aktif</p>
                                </div>
                                <div class="w-8 h-8 rounded-lg bg-blue-600/20 flex items-center justify-center text-blue-400 text-xs font-bold border border-blue-600/30">
                                    {{ substr(Auth::user()->name, 0, 1) }}
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <div class="px-4 py-2 border-b border-white/5 mb-1">
                                <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Administrator Menu</p>
                            </div>
                            <x-dropdown-link :href="route('dashboard')">{{ __('Panel Dashboard') }}</x-dropdown-link>
                            <x-dropdown-link :href="route('profile.edit')">{{ __('Pengaturan Profil') }}</x-dropdown-link>
                            <div class="border-t border-white/5 mt-1">
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();" class="text-red-400 font-bold">
                                        {{ __('Keluar Sistem') }}
                                    </x-dropdown-link>
                                </form>
                            </div>
                        </x-slot>
                    </x-dropdown>
                @else
                    <a href="{{ route('login') }}" 
                       class="relative group px-7 py-3 rounded-full overflow-hidden bg-blue-600 text-white shadow-lg shadow-blue-600/30 transition-all hover:scale-105 active:scale-95">
                        <span class="relative z-10 text-[10px] font-black uppercase tracking-widest">Login Petugas</span>
                        <div class="absolute inset-0 bg-gradient-to-r from-blue-400 to-blue-700 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    </a>
                @endauth

                <button @click="open = ! open" class="md:hidden p-2 rounded-xl bg-white/5 border border-white/10 text-white">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <div x-show="open" 
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 -translate-y-4"
         x-transition:enter-end="opacity-100 translate-y-0"
         class="md:hidden absolute w-full bg-[#020617]/95 backdrop-blur-2xl border-b border-white/10 px-6 py-8">
        <div class="flex flex-col gap-6">
            <a href="{{ route('monitoring') }}" class="text-lg font-bold text-white">Home</a>
            <a href="#dashboard" @click="open = false" class="text-lg font-bold text-white/60">Dashboard</a>
            <a href="#tentang" @click="open = false" class="text-lg font-bold text-white/60">Tentang</a>
            <a href="#kontak" @click="open = false" class="text-lg font-bold text-white/60">Kontak</a>
            @guest
                <a href="{{ route('login') }}" class="py-4 rounded-2xl bg-blue-600 text-center text-sm font-bold uppercase tracking-widest">Login Petugas</a>
            @endguest
        </div>
    </div>
</nav>