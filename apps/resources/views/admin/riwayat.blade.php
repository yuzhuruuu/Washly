<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Pesanan - Washly Admin</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-[#F8FAFC] h-screen font-sans text-slate-800 flex overflow-hidden">

    {{-- SIDEBAR KONSISTEN --}}
    <aside class="w-64 bg-white border-r border-gray-100 flex flex-col h-full shrink-0 relative z-20">
        <div class="p-6">
            <img src="{{ asset('images/w-a.svg') }}" alt="Washly Admin" class="h-8">
        </div>

        <div class="px-6 flex items-center gap-3 mb-8">
            <div class="w-10 h-10 rounded-full border border-gray-100 overflow-hidden shadow-sm">
                <img src="https://ui-avatars.com/api/?name=Admin&background=00AEEF&color=fff" alt="Admin Profile" class="w-full h-full object-cover">
            </div>
            <div>
                <h3 class="font-bold text-sm text-gray-800 leading-tight">Admin</h3>
                <p class="text-[10px] text-gray-500 font-medium mt-0.5">Panel Kendali Utama</p>
            </div>
        </div>

        <nav class="flex-1 px-4 space-y-1">
            <a href="{{ url('/dashboard/admin') }}" class="flex items-center gap-3 px-4 py-3 text-gray-500 hover:bg-gray-50 hover:text-[#0074A6] rounded-xl font-medium text-sm transition group">
                <i class="fas fa-th-large w-5 text-center text-gray-400 group-hover:text-[#0074A6] transition"></i> Dashboard
            </a>
            <a href="{{ url('/dashboard/admin/pesanan') }}" class="flex items-center gap-3 px-4 py-3 text-gray-500 hover:bg-gray-50 hover:text-[#0074A6] rounded-xl font-medium text-sm transition group">
                <i class="fas fa-clipboard-list w-5 text-center text-gray-400 group-hover:text-[#0074A6] transition"></i> Kelola Pesanan
            </a>
            <a href="{{ url('/dashboard/admin/pembayaran') }}" class="flex items-center gap-3 px-4 py-3 text-gray-500 hover:bg-gray-50 hover:text-[#0074A6] rounded-xl font-medium text-sm transition group">
                <i class="fas fa-wallet w-5 text-center text-gray-400 group-hover:text-[#0074A6] transition"></i> Pembayaran
            </a>
            <a href="{{ url('/dashboard/admin/kurir') }}" class="flex items-center gap-3 px-4 py-3 text-gray-500 hover:bg-gray-50 hover:text-[#0074A6] rounded-xl font-medium text-sm transition group">
                <i class="fas fa-motorcycle w-5 text-center text-gray-400 group-hover:text-[#0074A6] transition"></i> Kurir
            </a>
            
            {{-- MENU RIWAYAT ADMIN (Aktif) --}}
            <a href="{{ url('/dashboard/admin/riwayat') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl font-bold text-sm transition" style="background-color: #EFF6FF; color: #1D5D8A;">
                <i class="fas fa-history w-5 text-center"></i> Riwayat Admin
            </a>
            
            <a href="#" class="flex items-center gap-3 px-4 py-3 text-gray-500 hover:bg-gray-50 hover:text-[#0074A6] rounded-xl font-medium text-sm transition group">
                <i class="fas fa-cog w-5 text-center text-gray-400 group-hover:text-[#0074A6] transition"></i> Pengaturan
            </a>
        </nav>

        <div class="p-5 mt-auto">
            <button class="w-full text-white py-3 rounded-xl text-sm font-bold shadow-md transition active:scale-95 flex items-center justify-center gap-2 hover:opacity-90" style="background-color: #005B82;">
                <i class="fas fa-plus"></i> Tambah Layanan
            </button>
        </div>
    </aside>

    {{-- KONTEN UTAMA --}}
    <main class="flex-1 overflow-y-auto relative z-10">
        
        {{-- Hiasan Background Blobs --}}
        <div class="absolute top-0 right-0 w-[500px] h-[500px] bg-blue-50/50 rounded-full blur-[120px] pointer-events-none z-0"></div>

        <div class="p-10 max-w-6xl mx-auto relative z-10">
            
            {{-- Header --}}
            <div class="flex justify-between items-center mb-8">
                <div>
                    <h1 class="text-3xl font-bold text-gray-800 mb-2">Riwayat Pesanan</h1>
                    <p class="text-sm text-gray-500 font-medium">Tinjau seluruh transaksi, analisis performa, dan unduh laporan operasional.</p>
                </div>
                <button class="bg-white border border-gray-200 text-gray-600 px-6 py-2.5 rounded-full text-sm font-bold shadow-sm hover:bg-gray-50 transition flex items-center gap-2">
                    <i class="fas fa-download text-gray-400"></i> Export CSV
                </button>
            </div>

            {{-- 3 SUMMARY CARDS --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                
                {{-- Card 1: Total Pesanan --}}
                <div class="bg-white p-6 rounded-3xl border border-gray-100 shadow-sm flex flex-col justify-between">
                    <div class="flex justify-between items-start mb-4">
                        <p class="text-[10px] font-bold text-gray-400 uppercase tracking-wider">Total Pesanan</p>
                        <div class="w-10 h-10 rounded-full bg-blue-50 text-blue-500 flex items-center justify-center">
                            <i class="fas fa-box text-sm"></i>
                        </div>
                    </div>
                    <div>
                        <h3 class="text-3xl font-black text-gray-800 mb-1">1,245</h3>
                        <p class="text-xs font-bold text-teal-500 flex items-center gap-1"><i class="fas fa-arrow-trend-up"></i> +12% dari bulan lalu</p>
                    </div>
                </div>

                {{-- Card 2: Total Pendapatan --}}
                <div class="bg-white p-6 rounded-3xl border border-gray-100 shadow-sm flex flex-col justify-between">
                    <div class="flex justify-between items-start mb-4">
                        <p class="text-[10px] font-bold text-gray-400 uppercase tracking-wider">Total Pendapatan</p>
                        <div class="w-10 h-10 rounded-full bg-cyan-50 text-cyan-500 flex items-center justify-center">
                            <i class="fas fa-wallet text-sm"></i>
                        </div>
                    </div>
                    <div>
                        <h3 class="text-3xl font-black text-gray-800 mb-1">Rp 45.5M</h3>
                        <p class="text-xs font-bold text-teal-500 flex items-center gap-1"><i class="fas fa-arrow-trend-up"></i> +8.4% dari bulan lalu</p>
                    </div>
                </div>

                {{-- Card 3: Rata-Rata Berat --}}
                <div class="bg-white p-6 rounded-3xl border border-gray-100 shadow-sm flex flex-col justify-between">
                    <div class="flex justify-between items-start mb-4">
                        <p class="text-[10px] font-bold text-gray-400 uppercase tracking-wider">Rata-Rata Berat</p>
                        <div class="w-10 h-10 rounded-full bg-orange-50 text-orange-500 flex items-center justify-center">
                            <i class="fas fa-weight-hanging text-sm"></i>
                        </div>
                    </div>
                    <div>
                        <h3 class="text-3xl font-black text-gray-800 mb-1">3.5 <span class="text-lg text-gray-400 font-semibold">kg</span></h3>
                        <p class="text-xs font-bold text-gray-400 flex items-center gap-1"><i class="fas fa-minus"></i> Stabil bulan ini</p>
                    </div>
                </div>

            </div>

            {{-- ACTION BAR (Search & Filters - Wujudnya Udah Nyata!) --}}
            <div class="flex flex-col md:flex-row gap-4 mb-8">
                
                {{-- Search Bar --}}
                <div class="relative flex-1">
                    <i class="fas fa-search absolute left-6 top-1/2 -translate-y-1/2 text-slate-400"></i>
                    <input type="text" placeholder="Cari ID Pesanan atau Pelanggan..." class="w-full bg-white border border-slate-200 shadow-sm rounded-xl py-3.5 pl-12 pr-4 text-sm font-medium text-slate-700 focus:outline-none focus:border-[#1D5D8A] focus:ring-1 focus:ring-[#1D5D8A] transition">
                </div>
                
                {{-- Filter Buttons --}}
                <div class="flex gap-4">
                    <button class="bg-white border border-slate-200 shadow-sm text-slate-600 px-6 py-3.5 rounded-xl text-sm font-bold hover:bg-slate-50 transition flex items-center gap-2 whitespace-nowrap">
                        <i class="far fa-calendar-alt text-slate-400"></i> Bulan Ini
                    </button>
                    <button class="bg-white border border-slate-200 shadow-sm text-slate-600 px-6 py-3.5 rounded-xl text-sm font-bold hover:bg-slate-50 transition flex items-center gap-2 whitespace-nowrap">
                        <i class="fas fa-filter text-slate-400"></i> Filter
                    </button>
                </div>

            </div>

            {{-- TABEL RIWAYAT --}}
            <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="border-b border-gray-100 bg-gray-50/30">
                                <th class="py-4 px-6 text-[10px] font-bold text-gray-400 uppercase tracking-wider">ID Pesanan</th>
                                <th class="py-4 px-6 text-[10px] font-bold text-gray-400 uppercase tracking-wider">Tanggal Selesai</th>
                                <th class="py-4 px-6 text-[10px] font-bold text-gray-400 uppercase tracking-wider">Pelanggan</th>
                                <th class="py-4 px-6 text-[10px] font-bold text-gray-400 uppercase tracking-wider">Layanan & Berat</th>
                                <th class="py-4 px-6 text-[10px] font-bold text-gray-400 uppercase tracking-wider text-right">Total Harga</th>
                                <th class="py-4 px-6 text-[10px] font-bold text-gray-400 uppercase tracking-wider text-center">Status</th>
                            </tr>
                        </thead>
                        <tbody class="text-sm font-medium">
                            
                            {{-- Row 1: Louis Partridge --}}
                            <tr class="border-b border-gray-50 hover:bg-gray-50/50 transition">
                                <td class="py-4 px-6 font-bold text-[#1D5D8A]">#WS-2026-092</td>
                                <td class="py-4 px-6 text-gray-600">
                                    <p>12 Mei 2026,</p>
                                    <p class="text-xs text-gray-400">14:30</p>
                                </td>
                                <td class="py-4 px-6">
                                    <div class="flex items-center gap-3">
                                        <div class="w-8 h-8 rounded-full bg-orange-100 text-orange-600 flex items-center justify-center font-bold text-xs shrink-0">L</div>
                                        <span class="text-gray-700">Louis Partridge</span>
                                    </div>
                                </td>
                                <td class="py-4 px-6 text-gray-600">
                                    <p>Cuci Setrika</p>
                                    <p class="text-[10px] text-gray-400 font-bold">4.2 kg</p>
                                </td>
                                <td class="py-4 px-6 text-right font-bold text-gray-800">Rp 42.000</td>
                                <td class="py-4 px-6 text-center">
                                    <span class="bg-blue-50 text-blue-600 px-4 py-1.5 rounded-full text-[10px] font-bold">Selesai</span>
                                </td>
                            </tr>

                            {{-- Row 2: Mark Ruffalo --}}
                            <tr class="border-b border-gray-50 hover:bg-gray-50/50 transition">
                                <td class="py-4 px-6 font-bold text-[#1D5D8A]">#WS-2026-093</td>
                                <td class="py-4 px-6 text-gray-600">
                                    <p>12 Mei 2026,</p>
                                    <p class="text-xs text-gray-400">11:15</p>
                                </td>
                                <td class="py-4 px-6">
                                    <div class="flex items-center gap-3">
                                        <div class="w-8 h-8 rounded-full bg-cyan-100 text-cyan-600 flex items-center justify-center font-bold text-xs shrink-0">M</div>
                                        <span class="text-gray-700">Mark Ruffalo</span>
                                    </div>
                                </td>
                                <td class="py-4 px-6 text-gray-600">
                                    <p>Dry Clean (Jas)</p>
                                    <p class="text-[10px] text-gray-400 font-bold">2 Pcs</p>
                                </td>
                                <td class="py-4 px-6 text-right font-bold text-gray-800">Rp 75.000</td>
                                <td class="py-4 px-6 text-center">
                                    <span class="bg-blue-50 text-blue-600 px-4 py-1.5 rounded-full text-[10px] font-bold">Selesai</span>
                                </td>
                            </tr>

                            {{-- Row 3: Scarlett Johanson --}}
                            <tr class="border-b border-gray-50 hover:bg-gray-50/50 transition">
                                <td class="py-4 px-6 font-bold text-[#1D5D8A]">#WS-2026-094</td>
                                <td class="py-4 px-6 text-gray-600">
                                    <p>11 Mei 2026,</p>
                                    <p class="text-xs text-gray-400">09:00</p>
                                </td>
                                <td class="py-4 px-6">
                                    <div class="flex items-center gap-3">
                                        <div class="w-8 h-8 rounded-full bg-gray-200 text-gray-600 flex items-center justify-center font-bold text-xs shrink-0">S</div>
                                        <span class="text-gray-700">Scarlett Johanson</span>
                                    </div>
                                </td>
                                <td class="py-4 px-6 text-gray-600">
                                    <p>Cuci Kering</p>
                                    <p class="text-[10px] text-gray-400 font-bold">3.0 kg</p>
                                </td>
                                <td class="py-4 px-6 text-right font-bold text-gray-400 line-through">Rp 24.000</td>
                                <td class="py-4 px-6 text-center">
                                    <span class="bg-red-50 text-red-500 px-4 py-1.5 rounded-full text-[10px] font-bold">Dibatalkan</span>
                                </td>
                            </tr>

                            {{-- Row 4: Chris Evans --}}
                            <tr class="border-b border-gray-50 hover:bg-gray-50/50 transition">
                                <td class="py-4 px-6 font-bold text-[#1D5D8A]">#WS-2026-095</td>
                                <td class="py-4 px-6 text-gray-600">
                                    <p>10 Mei 2026,</p>
                                    <p class="text-xs text-gray-400">16:45</p>
                                </td>
                                <td class="py-4 px-6">
                                    <div class="flex items-center gap-3">
                                        <div class="w-8 h-8 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center font-bold text-xs shrink-0">C</div>
                                        <span class="text-gray-700">Chris Evans</span>
                                    </div>
                                </td>
                                <td class="py-4 px-6 text-gray-600">
                                    <p>Setrika Saja</p>
                                    <p class="text-[10px] text-gray-400 font-bold">5.5 kg</p>
                                </td>
                                <td class="py-4 px-6 text-right font-bold text-gray-800">Rp 33.000</td>
                                <td class="py-4 px-6 text-center">
                                    <span class="bg-blue-50 text-blue-600 px-4 py-1.5 rounded-full text-[10px] font-bold">Selesai</span>
                                </td>
                            </tr>

                            {{-- Row 5: Tom Holland --}}
                            <tr class="hover:bg-gray-50/50 transition">
                                <td class="py-4 px-6 font-bold text-[#1D5D8A]">#WS-2026-096</td>
                                <td class="py-4 px-6 text-gray-600">
                                    <p>10 Mei 2026,</p>
                                    <p class="text-xs text-gray-400">10:20</p>
                                </td>
                                <td class="py-4 px-6">
                                    <div class="flex items-center gap-3">
                                        <div class="w-8 h-8 rounded-full bg-orange-100 text-orange-600 flex items-center justify-center font-bold text-xs shrink-0">T</div>
                                        <span class="text-gray-700">Tom Holland</span>
                                    </div>
                                </td>
                                <td class="py-4 px-6 text-gray-600">
                                    <p>Cuci Setrika Express</p>
                                    <p class="text-[10px] text-gray-400 font-bold">8.0 kg</p>
                                </td>
                                <td class="py-4 px-6 text-right font-bold text-gray-800">Rp 120.000</td>
                                <td class="py-4 px-6 text-center">
                                    <span class="bg-blue-50 text-blue-600 px-4 py-1.5 rounded-full text-[10px] font-bold">Selesai</span>
                                </td>
                            </tr>

                        </tbody>
                    </table>
                </div>
                
                {{-- Pagination Footer --}}
                <div class="px-6 py-4 border-t border-gray-100 flex justify-between items-center bg-white">
                    <p class="text-xs text-gray-500 font-medium">Menampilkan 1-5 dari 1,245 pesanan</p>
                    <div class="flex gap-1">
                        <button class="w-8 h-8 rounded-full flex items-center justify-center text-gray-400 hover:bg-gray-50 transition"><i class="fas fa-chevron-left text-xs"></i></button>
                        <button class="w-8 h-8 rounded-full text-white font-bold text-xs flex items-center justify-center shadow-sm" style="background-color: #005B82;">1</button>
                        <button class="w-8 h-8 rounded-full text-gray-600 font-bold text-xs flex items-center justify-center hover:bg-gray-50 transition">2</button>
                        <button class="w-8 h-8 rounded-full text-gray-600 font-bold text-xs flex items-center justify-center hover:bg-gray-50 transition">3</button>
                        <span class="w-8 h-8 flex items-center justify-center text-gray-400 text-xs">...</span>
                        <button class="w-8 h-8 rounded-full flex items-center justify-center text-gray-400 hover:bg-gray-50 transition"><i class="fas fa-chevron-right text-xs"></i></button>
                    </div>
                </div>
            </div>

        </div>
    </main>

</body>
</html>