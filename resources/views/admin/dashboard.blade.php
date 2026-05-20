<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - Washly</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-[#F8FAFC] font-sans text-slate-800 flex h-screen overflow-hidden">

    {{-- SIDEBAR --}}
    <aside class="w-64 bg-white border-r border-slate-100 flex flex-col justify-between hidden md:flex">
        <div>
            {{-- Logo --}}
            <div class="p-6">
                <div class="text-4xl font-black text-[#003B5C] flex items-baseline">
                    W<span class="text-xl ml-1">💙</span><span class="text-xs ml-1 bg-blue-100 text-blue-700 px-2 py-0.5 rounded-md">admin</span>
                </div>
            </div>

            {{-- Profil Admin --}}
            <div class="px-6 mb-6 flex items-center">
                <img src="https://i.pravatar.cc/150?img=47" alt="Admin" class="w-10 h-10 rounded-full object-cover">
                <div class="ml-3">
                    <p class="text-sm font-bold">Admin</p>
                    <p class="text-[10px] text-slate-400">Panel Kendali Utama</p>
                </div>
            </div>

            {{-- Menu Navigasi --}}
            <nav class="px-4 space-y-1">
                <a href="#" class="flex items-center px-4 py-3 bg-[#F0F7FA] text-[#0074A6] rounded-xl font-bold text-sm transition">
                    <i class="fas fa-th-large w-5"></i> Dashboard
                </a>
                <a href="#" class="flex items-center px-4 py-3 text-slate-500 hover:bg-slate-50 hover:text-[#0074A6] rounded-xl font-semibold text-sm transition">
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
    <main class="flex-1 flex flex-col h-screen overflow-y-auto">
        {{-- Header --}}
        <header class="bg-white border-b border-slate-100 p-6 flex justify-between items-center sticky top-0 z-10">
            <div>
                <h1 class="text-2xl font-bold text-slate-800">Overview Dashboard</h1>
                <p class="text-xs text-slate-500 mt-1">Ringkasan operasional Washly hari ini.</p>
            </div>
            <button class="w-10 h-10 bg-slate-100 rounded-full flex items-center justify-center text-slate-600 hover:bg-slate-200 transition">
                <i class="fas fa-bell"></i>
            </button>
        </header>

        <div class="p-8">
            {{-- Bagian Statistik --}}
            <div class="flex justify-between items-end mb-6">
                <h2 class="text-xl font-bold text-slate-800">Statistik Hari Ini</h2>
                <button class="bg-[#1DA1F2] hover:bg-[#0C85D0] text-white font-bold py-2.5 px-5 rounded-full text-sm transition shadow-md shadow-blue-200 flex items-center">
                    <i class="fas fa-plus-circle mr-2"></i> Tambah Pesanan Manual
                </button>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
                {{-- Card 1 --}}
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-50 relative overflow-hidden">
                    <div class="absolute top-4 right-4 bg-blue-50 text-blue-600 text-[10px] font-bold px-2 py-1 rounded-full">+12%</div>
                    <div class="w-10 h-10 bg-blue-100 text-[#0074A6] rounded-full flex items-center justify-center mb-4">
                        <i class="fas fa-receipt"></i>
                    </div>
                    <p class="text-xs text-slate-500 font-semibold mb-1">Pesanan Hari Ini</p>
                    <h3 class="text-3xl font-black text-slate-800">42</h3>
                </div>

                {{-- Card 2 --}}
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-50 relative overflow-hidden">
                    <div class="w-10 h-10 bg-orange-100 text-orange-600 rounded-full flex items-center justify-center mb-4">
                        <i class="fas fa-sync-alt"></i>
                    </div>
                    <p class="text-xs text-slate-500 font-semibold mb-1">Sedang Diproses</p>
                    <h3 class="text-3xl font-black text-slate-800">18</h3>
                </div>

                {{-- Card 3 --}}
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-50 relative overflow-hidden">
                    <div class="w-10 h-10 bg-teal-100 text-teal-600 rounded-full flex items-center justify-center mb-4">
                        <i class="fas fa-check-circle"></i>
                    </div>
                    <p class="text-xs text-slate-500 font-semibold mb-1">Selesai Hari Ini</p>
                    <h3 class="text-3xl font-black text-slate-800">24</h3>
                </div>

                {{-- Card 4 --}}
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-50 relative overflow-hidden">
                    <div class="absolute top-4 right-4 bg-red-50 text-red-500 text-[10px] font-bold px-2 py-1 rounded-full">Action Needed</div>
                    <div class="w-10 h-10 bg-red-100 text-red-500 rounded-full flex items-center justify-center mb-4">
                        <i class="fas fa-money-bill-wave"></i>
                    </div>
                    <p class="text-xs text-slate-500 font-semibold mb-1">Menunggu Bayar</p>
                    <h3 class="text-3xl font-black text-slate-800">5</h3>
                </div>
            </div>

            {{-- Tabel Pesanan Terbaru --}}
            <div class="bg-white rounded-3xl shadow-sm border border-slate-50 overflow-hidden">
                <div class="p-6 border-b border-slate-50 flex justify-between items-center">
                    <h2 class="text-lg font-bold text-slate-800">Pesanan Terbaru</h2>
                    <a href="#" class="text-sm font-semibold text-[#0074A6] hover:underline">Lihat Semua</a>
                </div>
                
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-slate-50 text-[10px] uppercase text-slate-400 font-bold tracking-wider">
                                <th class="p-4 pl-6">ID Pesanan</th>
                                <th class="p-4">Pelanggan</th>
                                <th class="p-4">Layanan</th>
                                <th class="p-4">Status</th>
                                <th class="p-4 pr-6 text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="text-sm">
                            {{-- Row 1 --}}
                            <tr class="border-b border-slate-50 hover:bg-slate-50/50 transition">
                                <td class="p-4 pl-6 font-semibold text-slate-700">#ORD-0921</td>
                                <td class="p-4">
                                    <div class="flex items-center">
                                        <div class="w-8 h-8 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center font-bold text-xs mr-3">BP</div>
                                        <span class="font-medium text-slate-700">Budi Pratama</span>
                                    </div>
                                </td>
                                <td class="p-4 text-slate-600">Cuci Kering + Setrika</td>
                                <td class="p-4">
                                    <span class="bg-orange-100 text-orange-700 text-[10px] font-bold px-3 py-1 rounded-full">Sedang Diproses</span>
                                </td>
                                <td class="p-4 pr-6 text-right">
                                    <button class="border border-[#0074A6] text-[#0074A6] hover:bg-blue-50 px-4 py-1.5 rounded-full text-xs font-bold transition">Kelola</button>
                                </td>
                            </tr>
                            {{-- Row 2 --}}
                            <tr class="border-b border-slate-50 hover:bg-slate-50/50 transition">
                                <td class="p-4 pl-6 font-semibold text-slate-700">#ORD-0920</td>
                                <td class="p-4">
                                    <div class="flex items-center">
                                        <div class="w-8 h-8 rounded-full bg-cyan-100 text-cyan-600 flex items-center justify-center font-bold text-xs mr-3">AS</div>
                                        <span class="font-medium text-slate-700">Anita Sari</span>
                                    </div>
                                </td>
                                <td class="p-4 text-slate-600">Cuci Sepatu Premium</td>
                                <td class="p-4">
                                    <span class="bg-red-100 text-red-600 text-[10px] font-bold px-3 py-1 rounded-full">Menunggu Bayar</span>
                                </td>
                                <td class="p-4 pr-6 text-right">
                                    <button class="border border-[#0074A6] text-[#0074A6] hover:bg-blue-50 px-4 py-1.5 rounded-full text-xs font-bold transition">Kelola</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </main>
</body>
</html>