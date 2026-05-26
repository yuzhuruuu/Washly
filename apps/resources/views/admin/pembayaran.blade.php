<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran Admin - Washly</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-[#F8FAFC] h-screen font-sans text-slate-800 flex overflow-hidden">

    {{-- SIDEBAR KONSISTEN (Anti-Nyasar Club) --}}
    <aside class="w-64 bg-white border-r border-gray-100 flex flex-col h-full shrink-0 relative z-20">
        {{-- Logo --}}
        <div class="p-6">
            <img src="{{ asset('images/w-a.svg') }}" alt="Washly Admin" class="h-8">
        </div>

        {{-- Profil Admin --}}
        <div class="px-6 flex items-center gap-3 mb-8">
            <div class="w-10 h-10 rounded-full border border-gray-100 overflow-hidden shadow-sm">
                <img src="https://ui-avatars.com/api/?name=Admin&background=00AEEF&color=fff" alt="Admin Profile" class="w-full h-full object-cover">
            </div>
            <div>
                <h3 class="font-bold text-sm text-gray-800 leading-tight">Admin</h3>
                <p class="text-[10px] text-gray-500 font-medium mt-0.5">Panel Kendali Utama</p>
            </div>
        </div>

        {{-- Menu Navigasi --}}
        <nav class="flex-1 px-4 space-y-1">
            <a href="{{ url('/dashboard/admin') }}" class="flex items-center gap-3 px-4 py-3 text-gray-500 hover:bg-gray-50 hover:text-[#0074A6] rounded-xl font-medium text-sm transition group">
                <i class="fas fa-th-large w-5 text-center text-gray-400 group-hover:text-[#0074A6] transition"></i> Dashboard
            </a>
            <a href="{{ url('/dashboard/admin/pesanan') }}" class="flex items-center gap-3 px-4 py-3 text-gray-500 hover:bg-gray-50 hover:text-[#0074A6] rounded-xl font-medium text-sm transition group">
                <i class="fas fa-clipboard-list w-5 text-center text-gray-400 group-hover:text-[#0074A6] transition"></i> Kelola Pesanan
            </a>
            
            {{-- MENU PEMBAYARAN (Sekarang Aktif/Biru) --}}
            <a href="{{ url('/dashboard/admin/pembayaran') }}" class="flex items-center gap-3 px-4 py-3 bg-blue-50 text-[#0074A6] rounded-xl font-bold text-sm transition">
                <i class="fas fa-wallet w-5 text-center"></i> Pembayaran
            </a>
            
            <a href="#" class="flex items-center gap-3 px-4 py-3 text-gray-500 hover:bg-gray-50 hover:text-[#0074A6] rounded-xl font-medium text-sm transition group">
                <i class="fas fa-motorcycle w-5 text-center text-gray-400 group-hover:text-[#0074A6] transition"></i> Kurir
            </a>
            <a href="#" class="flex items-center gap-3 px-4 py-3 text-gray-500 hover:bg-gray-50 hover:text-[#0074A6] rounded-xl font-medium text-sm transition group">
                <i class="fas fa-history w-5 text-center text-gray-400 group-hover:text-[#0074A6] transition"></i> Riwayat Admin
            </a>
            <a href="#" class="flex items-center gap-3 px-4 py-3 text-gray-500 hover:bg-gray-50 hover:text-[#0074A6] rounded-xl font-medium text-sm transition group">
                <i class="fas fa-cog w-5 text-center text-gray-400 group-hover:text-[#0074A6] transition"></i> Pengaturan
            </a>
        </nav>

        {{-- Tombol Tambah Layanan (Di bawah tetap rapi) --}}
        <div class="p-5 mt-auto">
            <button class="w-full bg-[#005B82] hover:bg-[#004B6D] text-white py-3 rounded-xl text-sm font-bold shadow-md transition active:scale-95 flex items-center justify-center gap-2">
                <i class="fas fa-plus"></i> Tambah Layanan
            </button>
        </div>
    </aside>

    {{-- KONTEN UTAMA --}}
    <main class="flex-1 p-10 overflow-y-auto relative z-10" x-data="{ filter: 'belum' }">
        {{-- Hiasan Background --}}
        <div class="absolute bottom-0 left-0 w-96 h-96 bg-cyan-100/30 rounded-full blur-[120px] pointer-events-none z-0"></div>

        <div class="max-w-5xl mx-auto relative z-10">
            
            {{-- Header --}}
            <div class="mb-8">
                <h1 class="text-2xl font-bold text-gray-800 mb-1">Konfirmasi Pembayaran</h1>
                <p class="text-sm text-gray-500 font-medium">Tinjau dan verifikasi bukti transfer dari pelanggan.</p>
            </div>

            {{-- Filter Tabs (Bisa diklik) --}}
            <div class="flex flex-wrap gap-3 mb-8">
                <button @click="filter = 'semua'" :class="filter === 'semua' ? 'bg-[#0074A6] text-white' : 'bg-gray-200 text-gray-600 hover:bg-gray-300'" class="px-5 py-2 rounded-full text-xs font-bold transition">Semua</button>
                <button @click="filter = 'belum'" :class="filter === 'belum' ? 'bg-[#0074A6] text-white shadow-md' : 'bg-gray-200 text-gray-600 hover:bg-gray-300'" class="px-5 py-2 rounded-full text-xs font-bold transition">Belum Dikonfirmasi</button>
                <button @click="filter = 'dikonfirmasi'" :class="filter === 'dikonfirmasi' ? 'bg-[#0074A6] text-white shadow-md' : 'bg-gray-200 text-gray-600 hover:bg-gray-300'" class="px-5 py-2 rounded-full text-xs font-bold transition">Dikonfirmasi</button>
                <button @click="filter = 'ditolak'" :class="filter === 'ditolak' ? 'bg-[#0074A6] text-white shadow-md' : 'bg-gray-200 text-gray-600 hover:bg-gray-300'" class="px-5 py-2 rounded-full text-xs font-bold transition">Ditolak</button>
            </div>

            {{-- List Pembayaran (Dipaksa Menyamping Kiri-Kanan) --}}
            <div class="space-y-4">
                
                {{-- Card 1: Angelina J --}}
                <div x-show="filter === 'semua' || filter === 'belum'" class="bg-white px-6 py-4 rounded-2xl shadow-sm border border-gray-100 flex items-center justify-between hover:shadow-md transition gap-4">
                    
                    {{-- Kiri: Profil --}}
                    <div class="flex items-center gap-4 w-[200px] shrink-0">
                        <div class="w-10 h-10 rounded-full bg-blue-100 text-[#0074A6] flex items-center justify-center text-lg font-bold shrink-0">A</div>
                        <div>
                            <h3 class="font-bold text-gray-800 text-sm whitespace-nowrap">Angelina J</h3>
                            <p class="text-[9px] font-bold text-gray-400 mt-0.5 uppercase tracking-wider whitespace-nowrap"># WS-2026-099</p>
                        </div>
                    </div>

                    {{-- Tengah: Info Kapsul --}}
                    <div class="flex-1 flex justify-center overflow-x-auto no-scrollbar">
                        <div class="bg-slate-50 border border-slate-100 rounded-full py-2 px-6 flex items-center justify-between gap-8 min-w-[300px]">
                            <div>
                                <p class="text-[9px] font-bold text-gray-400 uppercase tracking-wider mb-0.5">Nominal</p>
                                <p class="text-sm font-black text-[#0074A6] whitespace-nowrap">Rp 45.000</p>
                            </div>
                            <div>
                                <p class="text-[9px] font-bold text-gray-400 uppercase tracking-wider mb-0.5">Metode</p>
                                <div class="flex items-center gap-2 text-gray-700 font-semibold text-xs whitespace-nowrap">
                                    <i class="fas fa-university text-[#0074A6]"></i> Transfer BCA
                                </div>
                            </div>
                            <div class="w-9 h-9 bg-[#C5E1E1] rounded-lg flex items-center justify-center text-teal-800 cursor-pointer hover:opacity-80 transition shadow-sm shrink-0">
                                <i class="fas fa-file-invoice text-sm"></i>
                            </div>
                        </div>
                    </div>

                    {{-- Kanan: Aksi (Ditumpuk atas-bawah aja) --}}
                    <div class="flex flex-col gap-2 w-24 shrink-0">
                        <button class="w-full bg-[#0074A6] hover:bg-[#005B82] text-white py-1.5 rounded-full text-[11px] font-bold transition shadow-sm">Konfirmasi</button>
                        <button class="w-full bg-red-100 hover:bg-red-200 text-red-600 py-1.5 rounded-full text-[11px] font-bold transition">Tolak</button>
                    </div>
                </div>

                {{-- Card 2: Taylor Swift --}}
                <div x-show="filter === 'semua' || filter === 'belum'" class="bg-white px-6 py-4 rounded-2xl shadow-sm border border-gray-100 flex items-center justify-between hover:shadow-md transition gap-4">
                    
                    <div class="flex items-center gap-4 w-[200px] shrink-0">
                        <div class="w-10 h-10 rounded-full bg-cyan-100 text-cyan-600 flex items-center justify-center text-lg font-bold shrink-0">T</div>
                        <div>
                            <h3 class="font-bold text-gray-800 text-sm whitespace-nowrap">Taylor Swift</h3>
                            <p class="text-[9px] font-bold text-gray-400 mt-0.5 uppercase tracking-wider whitespace-nowrap"># WS-2026-098</p>
                        </div>
                    </div>

                    <div class="flex-1 flex justify-center overflow-x-auto no-scrollbar">
                        <div class="bg-slate-50 border border-slate-100 rounded-full py-2 px-6 flex items-center justify-between gap-8 min-w-[300px]">
                            <div>
                                <p class="text-[9px] font-bold text-gray-400 uppercase tracking-wider mb-0.5">Nominal</p>
                                <p class="text-sm font-black text-[#0074A6] whitespace-nowrap">Rp 85.000</p>
                            </div>
                            <div>
                                <p class="text-[9px] font-bold text-gray-400 uppercase tracking-wider mb-0.5">Metode</p>
                                <div class="flex items-center gap-2 text-gray-700 font-semibold text-xs whitespace-nowrap">
                                    <i class="fas fa-wallet text-[#0074A6]"></i> Gopay
                                </div>
                            </div>
                            <div class="w-9 h-9 bg-[#C5E1E1] rounded-lg flex items-center justify-center text-teal-800 cursor-pointer hover:opacity-80 transition shadow-sm shrink-0">
                                <i class="fas fa-file-invoice text-sm"></i>
                            </div>
                        </div>
                    </div>

                    <div class="flex flex-col gap-2 w-24 shrink-0">
                        <button class="w-full bg-[#0074A6] hover:bg-[#005B82] text-white py-1.5 rounded-full text-[11px] font-bold transition shadow-sm">Konfirmasi</button>
                        <button class="w-full bg-red-100 hover:bg-red-200 text-red-600 py-1.5 rounded-full text-[11px] font-bold transition">Tolak</button>
                    </div>
                </div>

            </div>

            </div>
        </div>
    </main>
</body>
</html>