<x-app-layout>
    <div class="py-12 bg-slate-50 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <div class="mb-8 flex justify-between items-end">
                <div>
                    <h2 class="text-3xl font-black text-slate-900 tracking-tight">Panel Petugas BPBD</h2>
                    <p class="text-slate-500 mt-1 font-medium text-sm">Manajemen Data Riwayat Ketinggian Air Desa Kaligangsa</p>
                </div>
                <div class="flex gap-3">
                    <button class="px-4 py-2 bg-white border border-slate-200 text-slate-700 rounded-lg text-sm font-bold shadow-sm hover:bg-slate-50 transition-all flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                        Export Laporan PDF
                    </button>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm flex items-center gap-4">
                    <div class="w-12 h-12 rounded-full bg-cyan-100 text-cyan-600 flex items-center justify-center">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>
                    </div>
                    <div>
                        <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">Level Terkini</p>
                        <p class="text-2xl font-black text-slate-900">120 <span class="text-sm font-bold text-slate-500">cm</span></p>
                    </div>
                </div>
                <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm flex items-center gap-4">
                    <div class="w-12 h-12 rounded-full bg-amber-100 text-amber-600 flex items-center justify-center">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                    </div>
                    <div>
                        <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">Status</p>
                        <p class="text-2xl font-black text-amber-500 uppercase">Siaga</p>
                    </div>
                </div>
                <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm flex items-center gap-4">
                    <div class="w-12 h-12 rounded-full bg-emerald-100 text-emerald-600 flex items-center justify-center">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <div>
                        <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">Kondisi Alat</p>
                        <p class="text-2xl font-black text-emerald-500">Normal</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-[2rem] border border-slate-200 shadow-sm overflow-hidden">
                <div class="px-8 py-6 border-b border-slate-100 flex justify-between items-center bg-slate-50/50">
                    <h3 class="font-bold text-lg text-slate-800">Log Data Sensor Real-time</h3>
                    <span class="flex items-center gap-2 text-xs font-bold text-emerald-600 bg-emerald-100 px-3 py-1.5 rounded-full">
                        <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span> Live
                    </span>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-white text-xs text-slate-400 uppercase tracking-widest border-b border-slate-100">
                                <th class="px-8 py-5 font-bold">Waktu Rekam</th>
                                <th class="px-8 py-5 font-bold">Ketinggian Air (CM)</th>
                                <th class="px-8 py-5 font-bold">Status</th>
                                <th class="px-8 py-5 font-bold">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="text-sm font-medium text-slate-700 divide-y divide-slate-50">
                            <tr class="hover:bg-slate-50 transition-colors">
                                <td class="px-8 py-4 whitespace-nowrap">23 Apr 2026, 14:30:00</td>
                                <td class="px-8 py-4 text-slate-900 font-bold">120</td>
                                <td class="px-8 py-4">
                                    <span class="px-3 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider bg-amber-100 text-amber-600 border border-amber-200">Siaga</span>
                                </td>
                                <td class="px-8 py-4">
                                    <button class="text-blue-500 hover:text-blue-700 font-bold text-xs underline">Detail</button>
                                </td>
                            </tr>
                            <tr class="hover:bg-slate-50 transition-colors">
                                <td class="px-8 py-4 whitespace-nowrap">23 Apr 2026, 14:15:00</td>
                                <td class="px-8 py-4 text-slate-900 font-bold">95</td>
                                <td class="px-8 py-4">
                                    <span class="px-3 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider bg-emerald-100 text-emerald-600 border border-emerald-200">Aman</span>
                                </td>
                                <td class="px-8 py-4">
                                    <button class="text-blue-500 hover:text-blue-700 font-bold text-xs underline">Detail</button>
                                </td>
                            </tr>
                            <tr class="hover:bg-slate-50 transition-colors">
                                <td class="px-8 py-4 whitespace-nowrap">23 Apr 2026, 14:00:00</td>
                                <td class="px-8 py-4 text-slate-900 font-bold">155</td>
                                <td class="px-8 py-4">
                                    <span class="px-3 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider bg-rose-100 text-rose-600 border border-rose-200">Bahaya</span>
                                </td>
                                <td class="px-8 py-4">
                                    <button class="text-blue-500 hover:text-blue-700 font-bold text-xs underline">Detail</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                
                <div class="px-8 py-5 border-t border-slate-100 bg-slate-50/50 flex justify-between items-center text-xs text-slate-500">
                    <p>Menampilkan 1 hingga 3 dari 1,240 data</p>
                    <div class="flex gap-2">
                        <button class="px-3 py-1 bg-white border border-slate-200 rounded hover:bg-slate-100">Sebelumnya</button>
                        <button class="px-3 py-1 bg-white border border-slate-200 rounded hover:bg-slate-100">Selanjutnya</button>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>