<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Pesanan Admin - Washly</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-[#F8FAFC] font-sans text-slate-800 flex h-screen overflow-hidden">

    {{-- SIDEBAR (Sama persis kayak di Dashboard) --}}
    <aside class="w-64 bg-white border-r border-slate-100 flex flex-col justify-between hidden md:flex">
        <div>
            <div class="p-6">
                <div class="text-4xl font-black text-[#003B5C] flex items-baseline">
                    W<span class="text-xl ml-1">💙</span><span class="text-xs ml-1 bg-blue-100 text-blue-700 px-2 py-0.5 rounded-md">admin</span>
                </div>
            </div>
            <div class="px-6 mb-6 flex items-center">
                <img src="https://i.pravatar.cc/150?img=47" alt="Admin" class="w-10 h-10 rounded-full object-cover">
                <div class="ml-3">
                    <p class="text-sm font-bold">Admin</p>
                    <p class="text-[10px] text-slate-400">Panel Kendali Utama</p>
                </div>
            </div>
            <nav class="px-4 space-y-1">
                <a href="#" class="flex items-center px-4 py-3 text-slate-500 hover:bg-slate-50 hover:text-[#0074A6] rounded-xl font-semibold text-sm transition">
                    <i class="fas fa-th-large w-5"></i> Dashboard
                </a>
                <a href="#" class="flex items-center px-4 py-3 bg-[#F0F7FA] text-[#0074A6] rounded-xl font-bold text-sm transition">
                    <i class="fas fa-list-ul w-5"></i> Kelola Pesanan
                </a>
                <a href="#" class="flex items-center px-4 py-3 text-slate-500 hover:bg-slate-50 hover:text-[#0074A6] rounded-xl font-semibold text-sm transition">
                    <i class="fas fa-wallet w-5"></i> Pembayaran
                </a>
                <a href="#" class="flex items-center px-4 py-3 text-slate-500 hover:bg-slate-50 hover:text-[#0074A6] rounded-xl font-semibold text-sm transition">
                    <i class="fas fa-motorcycle w-5"></i> Kurir
                </a>
                <a href="#" class="flex items-center px-4 py-3 text-slate-500 hover:bg-slate-50 hover:text-[#0074A6] rounded-xl font-semibold text-sm transition">
                    <i class="fas fa-history w-5"></i> Riwayat Admin
                </a>
                <a href="#" class="flex items-center px-4 py-3 text-slate-500 hover:bg-slate-50 hover:text-[#0074A6] rounded-xl font-semibold text-sm transition">
                    <i class="fas fa-cog w-5"></i> Pengaturan
                </a>
            </nav>
        </div>
        <div class="p-6">
            <button class="w-full bg-[#0074A6] hover:bg-[#005B82] text-white font-bold py-3 rounded-xl transition flex items-center justify-center text-sm shadow-md shadow-blue-200">
                <i class="fas fa-plus mr-2"></i> Tambah Layanan
            </button>
        </div>
    </aside>

    {{-- KONTEN UTAMA --}}
    <main class="flex-1 flex flex-col h-screen overflow-y-auto relative">
        {{-- Hiasan Background Biru (Opsional, biar kayak di Figma) --}}
        <div class="absolute top-0 right-0 w-64 h-64 bg-blue-50 rounded-full filter blur-3xl opacity-50 -z-10"></div>

        <div class="p-8">
            <h1 class="text-3xl font-bold text-slate-800 mb-8">Kelola Pesanan</h1>

            {{-- Header Action (Search & Filters) --}}
            <div class="flex flex-col md:flex-row justify-between items-center gap-4 mb-8 z-10 relative">
                {{-- Search Bar --}}
                <div class="relative w-full md:w-96">
                    <span class="absolute left-4 top-3 text-slate-400"><i class="fas fa-search"></i></span>
                    <input type="text" placeholder="Cari ID Pesanan, Nama..." class="w-full bg-slate-100 border-none rounded-xl pl-12 pr-4 py-3 text-sm focus:ring-2 focus:ring-[#0074A6] text-slate-600">
                </div>

                {{-- Badges Filter --}}
                <div class="flex flex-wrap gap-2">
                    <button class="bg-[#0074A6] text-white font-bold text-xs px-4 py-2 rounded-full transition shadow-md shadow-blue-200">Semua</button>
                    <button class="bg-slate-200 hover:bg-slate-300 text-slate-600 font-bold text-xs px-4 py-2 rounded-full transition">Menunggu</button>
                    <button class="bg-slate-200 hover:bg-slate-300 text-slate-600 font-bold text-xs px-4 py-2 rounded-full transition">Diproses</button>
                    <button class="bg-slate-200 hover:bg-slate-300 text-slate-600 font-bold text-xs px-4 py-2 rounded-full transition">Pickup</button>
                    <button class="bg-slate-200 hover:bg-slate-300 text-slate-600 font-bold text-xs px-4 py-2 rounded-full transition">Selesai</button>
                </div>
            </div>

            {{-- Grid Cards Pesanan --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 z-10 relative">
                
                {{-- Card 1: Leonardo D --}}
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 hover:shadow-md transition">
                    <div class="flex justify-between items-start mb-4">
                        <span class="text-xs font-semibold text-slate-500 uppercase tracking-wider">WS-2026-089</span>
                        <span class="bg-orange-100 text-orange-600 text-[10px] font-bold px-3 py-1 rounded-full">Diproses</span>
                    </div>
                    <div class="flex items-center mb-5">
                        <div class="w-12 h-12 rounded-full bg-orange-100 text-orange-500 flex items-center justify-center font-bold text-xl mr-4">L</div>
                        <div>
                            <h3 class="text-lg font-bold text-slate-800 leading-tight">Leonardo D</h3>
                            <p class="text-xs text-slate-500 font-semibold">0812-3456-7890</p>
                        </div>
                    </div>
                    <div class="flex gap-2 mb-6">
                        <span class="bg-slate-50 text-slate-600 text-[10px] font-bold px-2 py-1 rounded border border-slate-100"><i class="fas fa-tshirt mr-1"></i> Cuci Komplit</span>
                        <span class="bg-slate-50 text-slate-600 text-[10px] font-bold px-2 py-1 rounded border border-slate-100"><i class="fas fa-truck mr-1"></i> Pickup</span>
                    </div>
                    <button class="w-full border-2 border-[#0074A6] text-[#0074A6] hover:bg-blue-50 font-bold py-2 rounded-full text-sm transition">Detail Pesanan</button>
                </div>

                {{-- Card 2: Ryan Reynolds --}}
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 hover:shadow-md transition">
                    <div class="flex justify-between items-start mb-4">
                        <span class="text-xs font-semibold text-slate-500 uppercase tracking-wider">WS-2024-090</span>
                        <span class="bg-red-50 text-red-500 text-[10px] font-bold px-3 py-1 rounded-full">Menunggu</span>
                    </div>
                    <div class="flex items-center mb-5">
                        <div class="w-12 h-12 rounded-full bg-blue-100 text-blue-500 flex items-center justify-center font-bold text-xl mr-4">R</div>
                        <div>
                            <h3 class="text-lg font-bold text-slate-800 leading-tight">Ryan Reynolds</h3>
                            <p class="text-xs text-slate-500 font-semibold">0856-7890-1234</p>
                        </div>
                    </div>
                    <div class="flex gap-2 mb-6">
                        <span class="bg-slate-50 text-slate-600 text-[10px] font-bold px-2 py-1 rounded border border-slate-100"><i class="fas fa-tshirt mr-1"></i> Setrika Saja</span>
                        <span class="bg-slate-50 text-slate-600 text-[10px] font-bold px-2 py-1 rounded border border-slate-100"><i class="fas fa-store mr-1"></i> Walk-in</span>
                    </div>
                    <button class="w-full border-2 border-[#0074A6] text-[#0074A6] hover:bg-blue-50 font-bold py-2 rounded-full text-sm transition">Detail Pesanan</button>
                </div>

                {{-- Card 3: Zendaya --}}
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 hover:shadow-md transition">
                    <div class="flex justify-between items-start mb-4">
                        <span class="text-xs font-semibold text-slate-500 uppercase tracking-wider">WS-2024-088</span>
                        <span class="bg-cyan-100 text-cyan-600 text-[10px] font-bold px-3 py-1 rounded-full">Selesai</span>
                    </div>
                    <div class="flex items-center mb-5">
                        <div class="w-12 h-12 rounded-full bg-slate-200 text-slate-600 flex items-center justify-center font-bold text-xl mr-4">Z</div>
                        <div>
                            <h3 class="text-lg font-bold text-slate-800 leading-tight">Zendaya</h3>
                            <p class="text-xs text-slate-500 font-semibold">0899-1122-3344</p>
                        </div>
                    </div>
                    <div class="flex gap-2 mb-6">
                        <span class="bg-slate-50 text-slate-600 text-[10px] font-bold px-2 py-1 rounded border border-slate-100"><i class="fas fa-tshirt mr-1"></i> Cuci Kering</span>
                        <span class="bg-slate-50 text-slate-600 text-[10px] font-bold px-2 py-1 rounded border border-slate-100"><i class="fas fa-truck mr-1"></i> Delivery</span>
                    </div>
                    <button class="w-full border-2 border-[#0074A6] text-[#0074A6] hover:bg-blue-50 font-bold py-2 rounded-full text-sm transition">Detail Pesanan</button>
                </div>

            </div>
        </div>
    </main>
</body>
</html>