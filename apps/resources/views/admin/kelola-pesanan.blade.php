<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Pesanan - Washly Admin</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-[#F8FAFC] h-screen font-sans text-slate-800 flex overflow-hidden">

    {{-- SIDEBAR KONSISTEN --}}
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
            
            {{-- MENU KELOLA PESANAN (Sekarang Aktif/Biru) --}}
            <a href="{{ url('/dashboard/admin/pesanan') }}" class="flex items-center gap-3 px-4 py-3 bg-blue-50 text-[#0074A6] rounded-xl font-bold text-sm transition">
                <i class="fas fa-clipboard-list w-5 text-center"></i> Kelola Pesanan
            </a>
            
            <a href="#" class="flex items-center gap-3 px-4 py-3 text-gray-500 hover:bg-gray-50 hover:text-[#0074A6] rounded-xl font-medium text-sm transition group">
                <i class="fas fa-wallet w-5 text-center text-gray-400 group-hover:text-[#0074A6] transition"></i> Pembayaran
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
    <main class="flex-1 p-10 overflow-y-auto">
        <h1 class="text-2xl font-bold text-gray-800 mb-8">Kelola Pesanan</h1>

        {{-- GRID LIST PESANAN --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            
            {{-- Contoh Card Pesanan (Leonardo) --}}
            <div class="bg-white p-6 rounded-3xl border border-gray-100 shadow-sm hover:shadow-md transition">
                <div class="flex justify-between items-start mb-4">
                    <span class="text-[10px] font-bold text-gray-400 uppercase">#ORD-2023-8890</span>
                    <span class="bg-orange-100 text-orange-600 text-[10px] font-bold px-3 py-1 rounded-full">Menunggu</span>
                </div>
                <div class="flex items-center gap-4 mb-5">
                    <div class="w-12 h-12 rounded-full bg-blue-100 flex items-center justify-center font-bold text-[#0074A6]">L</div>
                    <div>
                        <h3 class="font-bold text-gray-800">Leonardo D</h3>
                        <p class="text-xs text-gray-500">0812-3456-7890</p>
                    </div>
                </div>
                <a href="{{ url('/dashboard/admin/pesanan/detail') }}" class="block w-full bg-gray-100 hover:bg-[#0074A6] hover:text-white text-center py-3 rounded-xl text-sm font-bold transition">
                    Detail Pesanan
                </a>
            </div>

            {{-- Card Tambahan (Bisa di-looping pakai foreach dari DB) --}}
            <div class="bg-white p-6 rounded-3xl border border-gray-100 shadow-sm hover:shadow-md transition">
                <div class="flex justify-between items-start mb-4">
                    <span class="text-[10px] font-bold text-gray-400 uppercase">#ORD-2023-8891</span>
                    <span class="bg-green-100 text-green-600 text-[10px] font-bold px-3 py-1 rounded-full">Proses</span>
                </div>
                <div class="flex items-center gap-4 mb-5">
                    <div class="w-12 h-12 rounded-full bg-purple-100 flex items-center justify-center font-bold text-purple-600">R</div>
                    <div>
                        <h3 class="font-bold text-gray-800">Ryan P</h3>
                        <p class="text-xs text-gray-500">0857-9988-7766</p>
                    </div>
                </div>
                <a href="#" class="block w-full bg-gray-100 hover:bg-[#0074A6] hover:text-white text-center py-3 rounded-xl text-sm font-bold transition">
                    Detail Pesanan
                </a>
            </div>

        </div>
    </main>
</body>
</html>