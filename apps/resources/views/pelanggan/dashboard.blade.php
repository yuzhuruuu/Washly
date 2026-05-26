<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Pelanggan - Washly</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-[#F8FAFC] min-h-screen font-sans text-slate-800 pb-12">

{{-- NAVBAR BARU (Tengah Mutlak Sempurna) --}}
    <nav class="bg-white border-b border-gray-100 shadow-sm sticky top-0 z-50">
        {{-- WAJIB kasih 'relative' di container ini --}}
        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center relative">
            
            {{-- Kiri: Logo --}}
            <div class="flex items-center">
                <img src="{{ asset('images/w-g.svg') }}" alt="Washly" class="h-8">
            </div>

            {{-- TENGAH MUTLAK: Menu Links --}}
            {{-- Pakai absolute left-1/2 -translate-x-1/2 biar dipaku di tengah layar --}}
            <div class="hidden md:flex space-x-10 text-sm font-semibold absolute left-1/2 -translate-x-1/2">
                <a href="#" class="text-[#0074A6] border-b-2 border-[#0074A6] pb-1">Beranda</a>
                <a href="#" class="text-gray-400 hover:text-gray-600 transition">Layanan</a>
                <a href="#" class="text-gray-400 hover:text-gray-600 transition">Riwayat</a>
                <a href="#" class="text-gray-400 hover:text-gray-600 transition">Tentang Kami</a>
            </div>

            {{-- Kanan: Profil & Notif --}}
            <div class="flex items-center space-x-5">
                <span class="text-sm text-gray-500 font-medium">Halo, {{ Auth::guard('pelanggan')->user()?->nama ?? 'Justin' }}!</span>
                <button class="text-[#0074A6] hover:text-blue-800"><i class="far fa-bell text-lg"></i></button>
                <div class="w-8 h-8 rounded-full bg-gray-200 overflow-hidden border border-gray-300">
                    <img src="https://ui-avatars.com/api/?name=Justin&background=0074A6&color=fff" alt="Avatar" class="w-full h-full object-cover">
                </div>
            </div>

        </div>
    </nav>

    {{-- KONTEN UTAMA --}}
    <main class="max-w-6xl mx-auto px-6 mt-8">
        
        {{-- HERO BANNER --}}
        <div class="bg-gradient-to-r from-[#005B82] to-[#0074A6] rounded-[2rem] p-10 flex justify-between items-center text-white relative overflow-hidden shadow-xl shadow-blue-900/10">
            {{-- Teks --}}
            <div class="relative z-10 max-w-lg">
                <h1 class="text-3xl font-bold mb-3">Mau laundry hari ini?</h1>
                <p class="text-sm text-blue-100 leading-relaxed mb-6 opacity-90">
                    Biar kami yang urus cucian kotormu. Santai saja di rumah, kami jemput<br>dan antar kembali dengan wangi paripurna.
                </p>
                <button class="bg-white text-[#0074A6] px-6 py-2.5 rounded-full text-sm font-bold flex items-center gap-2 hover:bg-gray-50 transition shadow-md">
                    <span class="flex flex-col text-left leading-none">
                        <span class="text-[12px] font-bold">Pesan Sekarang</span>
                    </span>
                    <i class="fas fa-arrow-right ml-1"></i>
                </button>
            </div>
            {{-- Logo Raksasa di Kanan (Mockup pakai huruf W putih transparan) --}}
            <div class="absolute -right-6 top-1/2 -translate-y-1/2 opacity-20 pointer-events-none">
                <i class="fas fa-water text-[250px]"></i>
            </div>
        </div>

        {{-- SECTION: LAYANAN KAMI --}}
        <div class="mt-12">
            <h2 class="text-xl font-bold text-gray-800 mb-6">Layanan Kami</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                
                {{-- Card 1: Cuci Komplit --}}
                <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 relative overflow-hidden group cursor-pointer hover:shadow-md transition">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-[#F4F8FB] rounded-bl-full -mr-10 -mt-10 transition-transform group-hover:scale-110"></div>
                    <div class="w-12 h-12 bg-blue-500 text-white rounded-full flex items-center justify-center text-xl mb-12 relative z-10 shadow-md">
                        <i class="fas fa-tshirt"></i>
                    </div>
                    <h3 class="font-bold text-gray-800 mb-1 relative z-10">Cuci Komplit</h3>
                    <div class="flex justify-between items-end relative z-10">
                        <p class="text-xs text-gray-400">Mulai dari</p>
                        <span class="bg-[#EBF4FA] text-[#0074A6] text-[10px] font-bold px-2.5 py-1 rounded-md">Rp 6.000/kg</span>
                    </div>
                </div>

                {{-- Card 2: Setrika Saja --}}
                <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 relative overflow-hidden group cursor-pointer hover:shadow-md transition">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-[#F0FAF9] rounded-bl-full -mr-10 -mt-10 transition-transform group-hover:scale-110"></div>
                    <div class="w-12 h-12 bg-[#38B2AC] text-white rounded-full flex items-center justify-center text-xl mb-12 relative z-10 shadow-md">
                        <svg class="w-6 h-6 fill-current" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path d="M21,11C21,9.34 19.66,8 18,8H15V6H21V4H15C13.9,4 13,4.9 13,6V8H10C7.79,8 6,9.79 6,12V14H22V12C22,11.45 21.55,11 21,11M8,12C8,10.9 8.9,10 10,10H13V12H8M19,16H5A2,2 0 0,0 3,18V19H21V18A2,2 0 0,0 19,16Z" />
                        </svg>
                    </div>
                    <h3 class="font-bold text-gray-800 mb-1 relative z-10">Setrika Saja</h3>
                    <div class="flex justify-between items-end relative z-10">
                        <p class="text-xs text-gray-400">Mulai dari</p>
                        <span class="bg-[#E6F6F5] text-[#38B2AC] text-[10px] font-bold px-2.5 py-1 rounded-md">Rp 4.000/kg</span>
                    </div>
                </div>

                {{-- Card 3: Premium Care --}}
                <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 relative overflow-hidden group cursor-pointer hover:shadow-md transition">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-[#FCF6EE] rounded-bl-full -mr-10 -mt-10 transition-transform group-hover:scale-110"></div>
                    <div class="w-12 h-12 bg-[#D97706] text-white rounded-full flex items-center justify-center text-xl mb-12 relative z-10 shadow-md">
                        <i class="fas fa-user-tie"></i>
                        <div class="absolute -top-1 -right-1 w-3 h-3 bg-red-500 rounded-full border-2 border-white"></div>
                    </div>
                    <h3 class="font-bold text-gray-800 mb-1 relative z-10">Premium Care</h3>
                    <div class="flex justify-between items-end relative z-10">
                        <p class="text-xs text-gray-400">Mulai dari</p>
                        <span class="bg-[#FDF3E7] text-[#D97706] text-[10px] font-bold px-2.5 py-1 rounded-md">Rp 12.000/pc</span>
                    </div>
                </div>

            </div>
        </div>

        {{-- SECTION BAWAH: PESANAN & PROMO --}}
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-10 mt-12">
            
            {{-- Kiri: Pesanan Terbaru --}}
            <div class="lg:col-span-2">
                <div class="flex justify-between items-end mb-6">
                    <h2 class="text-xl font-bold text-gray-800">Pesanan Terbaru</h2>
                    <a href="#" class="text-xs text-[#0074A6] hover:underline font-medium">
                        Lihat Semua
                    </a>
                </div>

                <div class="space-y-4">
                    {{-- List 1 --}}
                    <div class="bg-white rounded-xl p-4 flex items-center shadow-sm border border-gray-100 border-l-4 border-l-[#38B2AC] hover:shadow-md transition cursor-pointer">
                        <div class="w-10 h-10 bg-gray-100 rounded-full flex items-center justify-center text-gray-500 mr-4">
                            <i class="fas fa-file-invoice"></i>
                        </div>
                        <div class="flex-1">
                            <p class="text-sm font-bold text-gray-800">WS-2024-001</p>
                            <p class="text-[10px] text-gray-400">Hari ini, 09:45 WIB</p>
                        </div>
                        <div class="flex flex-col items-end gap-1">
                            <span class="bg-[#E6F6F5] text-[#38B2AC] text-[9px] font-bold px-2 py-0.5 rounded-full flex items-center gap-1">
                                <span class="w-1.5 h-1.5 bg-[#38B2AC] rounded-full"></span> Sedang Dicuci
                            </span>
                            <p class="text-sm font-bold text-gray-800">Rp 45.000</p>
                        </div>
                    </div>

                    {{-- List 2 --}}
                    <div class="bg-white rounded-xl p-4 flex items-center shadow-sm border border-gray-100 border-l-4 border-l-[#D97706] hover:shadow-md transition cursor-pointer">
                        <div class="w-10 h-10 bg-gray-100 rounded-full flex items-center justify-center text-gray-500 mr-4">
                            <i class="fas fa-file-invoice"></i>
                        </div>
                        <div class="flex-1">
                            <p class="text-sm font-bold text-gray-800">WS-2024-002</p>
                            <p class="text-[10px] text-gray-400">Kemarin, 14:20 WIB</p>
                        </div>
                        <div class="flex flex-col items-end gap-1">
                            <span class="bg-[#FDF3E7] text-[#D97706] text-[9px] font-bold px-2 py-0.5 rounded-full flex items-center gap-1">
                                <span class="w-1.5 h-1.5 bg-[#D97706] rounded-full"></span> Menunggu Kurir
                            </span>
                            <p class="text-sm font-bold text-gray-800">Rp 32.000</p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Kanan: Spesial Untukmu --}}
            <div class="lg:col-span-1" x-data="{ code: 'NEWWASH', copied: false }">
                <h2 class="text-xl font-bold text-gray-800 mb-6">Spesial Untukmu</h2>
                
                <div class="bg-gradient-to-br from-[#FDF3E7] via-[#F8EDF1] to-[#F1EEFC] rounded-2xl p-6 shadow-sm relative overflow-hidden">                    {{-- Dekorasi Bintang/Icon --}}
                    <div class="w-8 h-8 bg-transparent border-2 border-[#5C3D2E] rounded flex items-center justify-center text-[#5C3D2E] mb-4">
                        <i class="fas fa-gift text-sm"></i>
                    </div>
                    
                    <h3 class="text-lg font-bold text-[#5C3D2E] mb-1">Diskon 20%</h3>
                    <p class="text-xs text-[#5C3D2E] leading-relaxed mb-5 opacity-90 pr-4">
                        Untuk Pelanggan Baru! Gunakan kode NEWWASH.
                    </p>
                    
                    <button 
                        @click="navigator.clipboard.writeText(code).then(() => { copied = true; setTimeout(() => copied = false, 1500); })"
                        :class="copied ? 'bg-green-600 hover:bg-green-700' : 'bg-[#5C3D2E] hover:bg-[#4A3125]'"
                        class="text-white text-[11px] font-bold px-5 py-2 rounded-full transition-all duration-300 shadow-md flex items-center gap-1.5"
                    >
                        <i :class="copied ? 'fas fa-check' : 'fas fa-copy'"></i>
                        <span x-text="copied ? 'Tersalin!' : 'Salin Kode'"></span>
                    </button>
                    
                    {{-- Lingkaran Dekorasi Promo --}}
                    <div class="absolute -right-8 -bottom-8 w-32 h-32 bg-white opacity-10 rounded-full pointer-events-none"></div>
                </div>
            </div>

        </div>

    </main>

</body>
</html>