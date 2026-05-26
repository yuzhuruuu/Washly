<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Kurir - Washly</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-[#F8FAFC] h-screen font-sans text-slate-800 flex overflow-hidden">

    {{-- SIDEBAR KURIR --}}
    <aside class="w-64 bg-white border-r border-gray-100 flex flex-col h-full shrink-0 relative z-20">
        {{-- Logo --}}
        <div class="p-6">
            <img src="{{ asset('images/w-k.svg') }}" alt="Washly Kurir" class="h-8">
        </div>

        {{-- Profil Kurir --}}
        <div class="px-6 flex items-center gap-3 mb-8">
            <div class="w-10 h-10 rounded-full border border-gray-100 overflow-hidden shadow-sm">
                <img src="https://i.pravatar.cc/150?img=14" alt="Sal Priadi" class="w-full h-full object-cover">
            </div>
            <div>
                <h3 class="font-bold text-sm text-[#0074A6] leading-tight">Sal Priadi</h3>
                <p class="text-[10px] text-gray-500 font-medium mt-0.5">Kurir</p>
            </div>
        </div>

        {{-- Menu Navigasi --}}
        <nav class="flex-1 px-4 space-y-2">
            <a href="#" class="flex items-center gap-3 px-4 py-3 bg-blue-50 text-[#0074A6] rounded-xl font-bold text-sm transition shadow-sm border border-blue-100">
                <i class="fas fa-th-large w-5 text-center"></i> Daftar Tugas
            </a>
            <a href="#" class="flex items-center gap-3 px-4 py-3 text-gray-500 hover:bg-gray-50 hover:text-[#0074A6] rounded-xl font-medium text-sm transition group">
                <i class="far fa-user w-5 text-center text-gray-400 group-hover:text-[#0074A6] transition"></i> Profil
            </a>
            <a href="#" class="flex items-center gap-3 px-4 py-3 text-gray-500 hover:bg-gray-50 hover:text-[#0074A6] rounded-xl font-medium text-sm transition group">
                <i class="fas fa-history w-5 text-center text-gray-400 group-hover:text-[#0074A6] transition"></i> Riwayat Tugas
            </a>
            <a href="#" class="flex items-center gap-3 px-4 py-3 text-gray-500 hover:bg-gray-50 hover:text-[#0074A6] rounded-xl font-medium text-sm transition group">
                <i class="fas fa-cog w-5 text-center text-gray-400 group-hover:text-[#0074A6] transition"></i> Pengaturan
            </a>
        </nav>

        {{-- Tombol Keluar --}}
        <div class="p-6 mt-auto border-t border-gray-50">
            <button class="w-full bg-[#D9534F] hover:bg-[#C9302C] text-white py-3 rounded-xl text-sm font-bold shadow-md transition active:scale-95 flex items-center justify-center gap-2">
                <i class="fas fa-sign-out-alt"></i> Keluar
            </button>
        </div>
    </aside>

    {{-- KONTEN UTAMA --}}
    <main class="flex-1 overflow-y-auto relative z-10">
        <div class="p-8 max-w-6xl mx-auto">
            
            {{-- Header --}}
            <div class="flex justify-between items-center mb-8">
                <h1 class="text-2xl font-bold text-[#2C4B64]">Daftar Tugas Hari Ini</h1>
                <div class="flex gap-4 text-[#2C4B64]">
                    <button class="hover:text-blue-600 transition"><i class="far fa-bell text-lg"></i></button>
                    <button class="hover:text-blue-600 transition"><i class="far fa-question-circle text-lg"></i></button>
                </div>
            </div>

            {{-- Kartu Sapaan & Target --}}
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-10">
                
                {{-- Banner Biru (Semangat Ahmad/Sal) --}}
                <div class="lg:col-span-2 bg-[#2D6A9F] rounded-3xl p-8 text-white relative overflow-hidden shadow-md">
                    {{-- Hiasan Mesin Cuci Tipis di Kanan --}}
                    <i class="fas fa-washing-machine absolute -right-6 -bottom-6 text-9xl text-white opacity-10"></i>
                    
                    <div class="relative z-10">
                        <h2 class="text-3xl font-bold mb-2">Semangat, Ahmad!</h2>
                        <p class="text-blue-100 text-sm w-3/4 mb-8 leading-relaxed">Ada 12 tugas baru yang menunggu diselesaikan hari ini. Pastikan laundry pelanggan sampai dengan selamat.</p>
                        
                        <div class="flex gap-4">
                            <div class="bg-white/20 border border-white/30 backdrop-blur-sm rounded-xl px-5 py-3 text-center">
                                <h3 class="text-3xl font-black mb-1">08</h3>
                                <p class="text-[10px] font-bold tracking-widest uppercase">Pickup</p>
                            </div>
                            <div class="bg-white/20 border border-white/30 backdrop-blur-sm rounded-xl px-5 py-3 text-center">
                                <h3 class="text-3xl font-black mb-1">04</h3>
                                <p class="text-[10px] font-bold tracking-widest uppercase">Delivery</p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Target Hari Ini --}}
                <div class="bg-white rounded-3xl p-8 border border-gray-100 shadow-sm flex flex-col items-center justify-center text-center">
                    <div class="w-14 h-14 bg-blue-50 text-[#0074A6] rounded-full flex items-center justify-center text-2xl mb-4">
                        <i class="fas fa-trophy"></i>
                    </div>
                    <p class="text-xs font-bold text-gray-400 mb-1">Target Hari Ini</p>
                    <h3 class="text-2xl font-black text-gray-800 mb-4">85% Selesai</h3>
                    <div class="w-full bg-gray-100 rounded-full h-2.5 overflow-hidden">
                        <div class="bg-[#2D6A9F] h-2.5 rounded-full" style="width: 85%"></div>
                    </div>
                </div>
            </div>

            {{-- Judul Seksi Tugas --}}
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-lg font-bold text-gray-800">Tugas Mendatang</h3>
                <a href="#" class="text-sm font-bold text-[#0074A6] hover:underline flex items-center gap-1">Lihat Semua <i class="fas fa-arrow-right text-xs"></i></a>
            </div>

            {{-- Grid Tugas --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                
                {{-- Card 1: Pickup --}}
                <div class="bg-white p-6 rounded-3xl border border-gray-100 shadow-sm hover:shadow-md transition flex flex-col h-full">
                    <div class="flex justify-between items-center mb-4">
                        <span class="bg-blue-50 text-blue-600 px-3 py-1 rounded flex items-center gap-1.5 text-[10px] font-bold tracking-wide">
                            <i class="fas fa-shopping-basket"></i> PICKUP
                        </span>
                        <span class="text-xs font-bold text-gray-400 uppercase">WS-2026-089</span>
                    </div>
                    <h4 class="text-lg font-bold text-[#2C4B64] mb-2">Siti Rahmawati</h4>
                    <div class="flex items-start gap-2 text-sm text-gray-500 mb-6 flex-1">
                        <i class="fas fa-map-marker-alt text-[#2D6A9F] mt-1"></i>
                        <p class="leading-relaxed">Jl. Merdeka No. 45, Tebet, Jakarta Selatan</p>
                    </div>
                    <div class="bg-gray-50 p-3 rounded-2xl">
                        <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-2 px-1">Update Status:</p>
                        <div class="flex gap-2">
                            <button class="flex-1 bg-orange-100 text-orange-600 py-2.5 rounded-xl text-xs font-bold transition">Menunggu<br>Pickup</button>
                            <button class="flex-1 bg-green-50 text-green-500 py-2.5 rounded-xl text-xs font-bold transition hover:bg-green-100">Sudah<br>Dijemput</button>
                        </div>
                    </div>
                </div>

                {{-- Card 2: Delivery --}}
                <div class="bg-white p-6 rounded-3xl border border-gray-100 shadow-sm hover:shadow-md transition flex flex-col h-full">
                    <div class="flex justify-between items-center mb-4">
                        <span class="bg-red-50 text-red-500 px-3 py-1 rounded flex items-center gap-1.5 text-[10px] font-bold tracking-wide">
                            <i class="fas fa-truck"></i> DELIVERY
                        </span>
                        <span class="text-xs font-bold text-gray-400 uppercase">WS-2026-090</span>
                    </div>
                    <h4 class="text-lg font-bold text-[#2C4B64] mb-2">Bambang Susanto</h4>
                    <div class="flex items-start gap-2 text-sm text-gray-500 mb-6 flex-1">
                        <i class="fas fa-map-marker-alt text-[#2D6A9F] mt-1"></i>
                        <p class="leading-relaxed">Apartemen Bassura, Tower Dahlia, Unit 12B</p>
                    </div>
                    <div class="bg-gray-50 p-3 rounded-2xl">
                        <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-2 px-1">Update Status:</p>
                        <div class="flex gap-2">
                            <button class="flex-1 bg-orange-100 text-orange-600 py-2.5 rounded-xl text-xs font-bold transition">Dalam<br>Pengantaran</button>
                            <button class="flex-1 bg-green-50 text-green-500 py-2.5 rounded-xl text-xs font-bold transition hover:bg-green-100">Selesai</button>
                        </div>
                    </div>
                </div>

                {{-- Card 3: Pickup --}}
                <div class="bg-white p-6 rounded-3xl border border-gray-100 shadow-sm hover:shadow-md transition flex flex-col h-full">
                    <div class="flex justify-between items-center mb-4">
                        <span class="bg-blue-50 text-blue-600 px-3 py-1 rounded flex items-center gap-1.5 text-[10px] font-bold tracking-wide">
                            <i class="fas fa-shopping-basket"></i> PICKUP
                        </span>
                        <span class="text-xs font-bold text-gray-400 uppercase">WS-2026-091</span>
                    </div>
                    <h4 class="text-lg font-bold text-[#2C4B64] mb-2">Dewi Lestari</h4>
                    <div class="flex items-start gap-2 text-sm text-gray-500 mb-6 flex-1">
                        <i class="fas fa-map-marker-alt text-[#2D6A9F] mt-1"></i>
                        <p class="leading-relaxed">Perumahan Green Park, Blok C2, No. 10</p>
                    </div>
                    <div class="bg-gray-50 p-3 rounded-2xl">
                        <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-2 px-1">Update Status:</p>
                        <div class="flex gap-2">
                            <button class="flex-1 bg-orange-100 text-orange-600 py-2.5 rounded-xl text-xs font-bold transition">Menunggu<br>Pickup</button>
                            <button class="flex-1 bg-green-50 text-green-500 py-2.5 rounded-xl text-xs font-bold transition hover:bg-green-100">Sudah<br>Dijemput</button>
                        </div>
                    </div>
                </div>

                {{-- Card 4: Delivery --}}
                <div class="bg-white p-6 rounded-3xl border border-gray-100 shadow-sm hover:shadow-md transition flex flex-col h-full">
                    <div class="flex justify-between items-center mb-4">
                        <span class="bg-red-50 text-red-500 px-3 py-1 rounded flex items-center gap-1.5 text-[10px] font-bold tracking-wide">
                            <i class="fas fa-truck"></i> DELIVERY
                        </span>
                        <span class="text-xs font-bold text-gray-400 uppercase">WS-2026-092</span>
                    </div>
                    <h4 class="text-lg font-bold text-[#2C4B64] mb-2">Rian Pradana</h4>
                    <div class="flex items-start gap-2 text-sm text-gray-500 mb-6 flex-1">
                        <i class="fas fa-map-marker-alt text-[#2D6A9F] mt-1"></i>
                        <p class="leading-relaxed">Jl. Gatot Subroto No. 18, Jakarta Timur</p>
                    </div>
                    <div class="bg-gray-50 p-3 rounded-2xl">
                        <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-2 px-1">Update Status:</p>
                        <div class="flex gap-2">
                            <button class="flex-1 bg-orange-100 text-orange-600 py-2.5 rounded-xl text-xs font-bold transition">Dalam<br>Pengantaran</button>
                            <button class="flex-1 bg-green-50 text-green-500 py-2.5 rounded-xl text-xs font-bold transition hover:bg-green-100">Selesai</button>
                        </div>
                    </div>
                </div>

            </div>
        </div>
<<<<<<< HEAD
    </main>
=======
        @empty
        <div class="bg-white border-2 border-dashed border-gray-200 rounded-2xl p-10 text-center">
            <p class="text-gray-400 text-sm italic">Belum ada tugas buat kamu!</p>
        </div>
        @endforelse
    </div>

    <nav class="fixed bottom-0 left-0 right-0 bg-white border-t border-gray-200 px-6 py-3 flex justify-between items-center shadow-[0_-2px_10px_rgba(0,0,0,0.05)]">
        <a href="{{ route('kurir.dashboard') }}" class="flex flex-col items-center text-blue-600">
            <i class="fas fa-home text-xl"></i>
            <span class="text-[10px] mt-1 font-bold">TUGAS</span>
        </a>
        <a href="{{ route('kurir.history') }}" class="flex flex-col items-center text-gray-400">
            <i class="fas fa-history text-xl"></i>
            <span class="text-[10px] mt-1 font-bold">RIWAYAT</span>
        </a>
        <a href="{{ route('kurir.profile.edit') }}" class="flex flex-col items-center text-gray-400">
            <i class="fas fa-id-badge text-xl"></i>
            <span class="text-[10px] mt-1 font-bold">PROFIL</span>
        </a>
        <a href="{{ route('kurir.settings.edit') }}" class="flex flex-col items-center text-gray-400">
            <i class="fas fa-cog text-xl"></i>
            <span class="text-[10px] mt-1 font-bold">PENGATURAN</span>
        </a>
        <form action="{{ route('logout') }}" method="POST" class="inline">
            @csrf
            <button type="submit" class="flex flex-col items-center text-red-400">
                <i class="fas fa-power-off text-xl"></i>
                <span class="text-[10px] mt-1 font-bold">KELUAR</span>
            </button>
        </form>
    </nav>
>>>>>>> 0d7885c6d42e58a5a7b3c3b1e67b0b34d2c58639

</body>
</html>