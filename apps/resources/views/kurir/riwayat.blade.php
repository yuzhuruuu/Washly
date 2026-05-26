<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Tugas - Washly Kurir</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-[#F8FAFC] h-screen font-sans text-slate-800 flex overflow-hidden w-full">

    {{-- SIDEBAR KURIR --}}
    <aside class="w-64 bg-white border-r border-gray-100 flex flex-col h-full shrink-0 relative z-20 overflow-hidden">
        {{-- Logo --}}
        <div class="p-6">
            <img src="{{ asset('images/w-k.svg') }}" alt="Washly Kurir" class="h-8">
        </div>

        {{-- Profil Kurir --}}
        <div class="px-6 flex items-center gap-3 mb-8 w-full">
            <div class="w-10 h-10 rounded-full border border-gray-100 overflow-hidden shadow-sm shrink-0">
                <img src="https://i.pravatar.cc/150?img=14" alt="Sal Priadi" class="w-full h-full object-cover">
            </div>
            <div class="flex-1 min-w-0">
                <h3 class="font-bold text-sm text-[#0074A6] leading-tight truncate">Sal Priadi</h3>
                <p class="text-[10px] text-gray-500 font-medium mt-0.5">Kurir</p>
            </div>
        </div>

        {{-- Menu Navigasi --}}
        <nav class="flex-1 px-4 space-y-2 w-full overflow-y-auto no-scrollbar">
            <a href="{{ url('/dashboard/kurir') }}" class="flex items-center gap-3 px-4 py-3 text-gray-500 hover:bg-gray-50 hover:text-[#0074A6] rounded-xl font-medium text-sm transition group w-full">
                <i class="fas fa-th-large w-5 text-center text-gray-400 group-hover:text-[#0074A6] transition shrink-0"></i> Daftar Tugas
            </a>
            
            <a href="{{ url('/dashboard/kurir/profil') }}" class="flex items-center gap-3 px-4 py-3 text-gray-500 hover:bg-gray-50 hover:text-[#0074A6] rounded-xl font-medium text-sm transition group w-full">
                <i class="far fa-user w-5 text-center text-gray-400 group-hover:text-[#0074A6] transition shrink-0"></i> Profil
            </a>
            
            {{-- MENU RIWAYAT (Aktif) --}}
            <a href="{{ url('/dashboard/kurir/riwayat') }}" class="flex items-center gap-3 px-4 py-3 bg-blue-50 text-[#0074A6] rounded-xl font-bold text-sm transition shadow-sm border border-blue-100 w-full">
                <i class="fas fa-history w-5 text-center shrink-0"></i> Riwayat Tugas
            </a>
            
            <a href="#" class="flex items-center gap-3 px-4 py-3 text-gray-500 hover:bg-gray-50 hover:text-[#0074A6] rounded-xl font-medium text-sm transition group w-full">
                <i class="fas fa-cog w-5 text-center text-gray-400 group-hover:text-[#0074A6] transition shrink-0"></i> Pengaturan
            </a>
        </nav>

        {{-- Tombol Keluar --}}
        <div class="p-6 mt-auto border-t border-gray-50 w-full shrink-0">
            <button class="w-full bg-[#D9534F] hover:bg-[#C9302C] text-white py-3 rounded-xl text-sm font-bold shadow-md transition active:scale-95 flex items-center justify-center gap-2">
                <i class="fas fa-sign-out-alt shrink-0"></i> Keluar
            </button>
        </div>
    </aside>

    {{-- KONTEN UTAMA (Total Jarak Dihapus, Tabel Status Lurus 100%!) --}}
    <main class="flex-1 w-full h-full overflow-y-auto relative z-10 no-scrollbar">
        <div class="p-8 max-w-6xl mx-auto w-full">
            
            {{-- Header Section --}}
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-10 w-full">
                <div class="mb-6 md:mb-0">
                    <h1 class="text-3xl font-bold text-gray-800 mb-2">Riwayat Tugas</h1>
                    <p class="text-sm text-gray-500 font-medium">Pantau semua penyelesaian tugas pengambilan dan pengiriman Anda.</p>
                </div>
                
                {{-- Aksi Header --}}
                <div class="flex flex-col sm:flex-row gap-4 w-full md:w-auto">
                    <button class="bg-white border border-gray-200 text-gray-600 rounded-full px-6 py-3.5 flex items-center justify-center gap-3 text-sm font-semibold shadow-sm transition">
                        <i class="far fa-calendar-alt"></i> 10 Jan 2025 - 12 Jan 2025
                    </button>
                    <button class="text-white rounded-full px-8 py-3.5 flex items-center justify-center gap-2 text-sm font-bold shadow-md transition" style="background-color: #00AEEF;">
                        <i class="fas fa-filter"></i> Filter
                    </button>
                </div>
            </div>

            {{-- Summary Cards (Udah Di-pendekin Ramping Anti-Melar!) --}}
            <div class="mb-10 w-full max-w-sm">
                <div class="bg-white rounded-3xl p-6 shadow-sm border border-gray-100 flex items-center gap-5 w-full relative overflow-hidden">
                    
                    {{-- Aksen lingkaran tipis di pojok --}}
                    <div class="absolute -right-6 -top-6 w-24 h-24 bg-teal-50 rounded-full opacity-50 pointer-events-none"></div>
                    
                    <div class="w-14 h-14 bg-teal-50 text-teal-600 rounded-2xl flex items-center justify-center text-2xl shrink-0 relative z-10">
                        <i class="fas fa-check-circle"></i>
                    </div>
                    <div class="flex-1 min-w-0 relative z-10">
                        <p class="text-[11px] font-bold text-gray-400 uppercase tracking-wider mb-1 truncate">Total Selesai</p>
                        <h3 class="text-2xl font-black text-gray-800 truncate">124 Tugas</h3>
                    </div>
                    
                </div>
            </div>

            {{-- Table Riwayat --}}
            <div class="bg-white rounded-[2rem] shadow-sm border border-gray-100 overflow-hidden w-full">
                <div class="overflow-x-auto w-full">
                    <table class="w-full text-left border-collapse min-w-[800px]">
                        <thead>
                            <tr class="border-b border-gray-100 bg-gray-50/50">
                                <th class="py-6 px-8 text-[11px] font-bold text-gray-500 uppercase tracking-wider whitespace-nowrap w-[35%]">Pelanggan</th>
                                <th class="py-6 px-6 text-[11px] font-bold text-gray-500 uppercase tracking-wider whitespace-nowrap w-[20%]">Tipe Layanan</th>
                                <th class="py-6 px-6 text-[11px] font-bold text-gray-500 uppercase tracking-wider whitespace-nowrap w-[25%]">Tanggal Selesai</th>
                                {{-- Judul Status dibikin rata tengah biar sejajar --}}
                                <th class="py-6 px-6 text-[11px] font-bold text-gray-500 uppercase tracking-wider whitespace-nowrap text-center w-[20%]">Status</th>
                            </tr>
                        </thead>
                        <tbody class="text-sm">
                            {{-- Row 1 --}}
                            <tr class="border-b border-gray-50 hover:bg-gray-50/30 transition">
                                <td class="py-4 px-8">
                                    <div class="flex items-center gap-4">
                                        <div class="w-9 h-9 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center text-xs font-bold shrink-0">AP</div>
                                        <span class="font-semibold text-gray-700 truncate">Ananda Putri</span>
                                    </div>
                                </td>
                                <td class="py-4 px-6">
                                    <div class="flex items-center gap-2 text-gray-600 font-medium">
                                        <i class="fas fa-shopping-basket text-gray-400 w-4 text-center"></i> Pickup
                                    </div>
                                </td>
                                <td class="py-4 px-6 text-gray-600 font-medium">12 Jan 2025</td>
                                {{-- Isi Data Status dibikin rata tengah --}}
                                <td class="py-4 px-6 text-center">
                                    <span class="inline-block bg-teal-50 text-teal-600 px-4 py-1.5 rounded-full text-[10px] font-bold tracking-wider uppercase">Selesai</span>
                                </td>
                            </tr>

                            {{-- Row 2 --}}
                            <tr class="border-b border-gray-50 hover:bg-gray-50/30 transition">
                                <td class="py-4 px-8">
                                    <div class="flex items-center gap-4">
                                        <div class="w-9 h-9 rounded-full bg-orange-100 text-orange-600 flex items-center justify-center text-xs font-bold shrink-0">RW</div>
                                        <span class="font-semibold text-gray-700 truncate">Rudi Wahyudi</span>
                                    </div>
                                </td>
                                <td class="py-4 px-6">
                                    <div class="flex items-center gap-2 text-gray-600 font-medium">
                                        <i class="fas fa-truck text-gray-400 w-4 text-center"></i> Delivery
                                    </div>
                                </td>
                                <td class="py-4 px-6 text-gray-600 font-medium">12 Jan 2025</td>
                                <td class="py-4 px-6 text-center">
                                    <span class="inline-block bg-teal-50 text-teal-600 px-4 py-1.5 rounded-full text-[10px] font-bold tracking-wider uppercase">Selesai</span>
                                </td>
                            </tr>

                            {{-- Row 3 --}}
                            <tr class="border-b border-gray-50 hover:bg-gray-50/30 transition">
                                <td class="py-4 px-8">
                                    <div class="flex items-center gap-4">
                                        <div class="w-9 h-9 rounded-full bg-cyan-100 text-cyan-600 flex items-center justify-center text-xs font-bold shrink-0">SM</div>
                                        <span class="font-semibold text-gray-700 truncate">Siti Maryam</span>
                                    </div>
                                </td>
                                <td class="py-4 px-6">
                                    <div class="flex items-center gap-2 text-gray-600 font-medium">
                                        <i class="fas fa-shopping-basket text-gray-400 w-4 text-center"></i> Pickup
                                    </div>
                                </td>
                                <td class="py-4 px-6 text-gray-600 font-medium">11 Jan 2025</td>
                                <td class="py-4 px-6 text-center">
                                    <span class="inline-block bg-teal-50 text-teal-600 px-4 py-1.5 rounded-full text-[10px] font-bold tracking-wider uppercase">Selesai</span>
                                </td>
                            </tr>

                            {{-- Row 4 --}}
                            <tr class="border-b border-gray-50 hover:bg-gray-50/30 transition">
                                <td class="py-4 px-8">
                                    <div class="flex items-center gap-4">
                                        <div class="w-9 h-9 rounded-full bg-gray-200 text-gray-600 flex items-center justify-center text-xs font-bold shrink-0">BK</div>
                                        <span class="font-semibold text-gray-700 truncate">Bambang Kusuma</span>
                                    </div>
                                </td>
                                <td class="py-4 px-6">
                                    <div class="flex items-center gap-2 text-gray-600 font-medium">
                                        <i class="fas fa-truck text-gray-400 w-4 text-center"></i> Delivery
                                    </div>
                                </td>
                                <td class="py-4 px-6 text-gray-600 font-medium">11 Jan 2025</td>
                                <td class="py-4 px-6 text-center">
                                    <span class="inline-block bg-teal-50 text-teal-600 px-4 py-1.5 rounded-full text-[10px] font-bold tracking-wider uppercase">Selesai</span>
                                </td>
                            </tr>

                            {{-- Row 5 --}}
                            <tr class="hover:bg-gray-50/30 transition">
                                <td class="py-4 px-8">
                                    <div class="flex items-center gap-4">
                                        <div class="w-9 h-9 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center text-xs font-bold shrink-0">DN</div>
                                        <span class="font-semibold text-gray-700 truncate">Dewi Nurhaliza</span>
                                    </div>
                                </td>
                                <td class="py-4 px-6">
                                    <div class="flex items-center gap-2 text-gray-600 font-medium">
                                        <i class="fas fa-shopping-basket text-gray-400 w-4 text-center"></i> Pickup
                                    </div>
                                </td>
                                <td class="py-4 px-6 text-gray-600 font-medium">10 Jan 2025</td>
                                <td class="py-4 px-6 text-center">
                                    <span class="inline-block bg-teal-50 text-teal-600 px-4 py-1.5 rounded-full text-[10px] font-bold tracking-wider uppercase">Selesai</span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                {{-- Pagination --}}
                <div class="px-8 py-10 border-t border-gray-100 flex flex-col sm:flex-row justify-between items-center gap-6 bg-white w-full">
                    <p class="text-sm text-gray-500 font-medium">Menampilkan 1–5 dari 124 riwayat</p>
                    <div class="flex items-center gap-3">
                        <button class="w-10 h-10 rounded-full border border-gray-200 flex items-center justify-center text-gray-400 hover:bg-gray-50 transition bg-transparent"><i class="fas fa-chevron-left text-xs"></i></button>
                        <button class="w-10 h-10 rounded-full text-white font-bold text-sm flex items-center justify-center shadow-sm" style="background-color: #00AEEF;">1</button>
                        <button class="w-10 h-10 rounded-full bg-transparent text-gray-600 font-bold text-sm flex items-center justify-center hover:bg-gray-50 transition">2</button>
                        <button class="w-10 h-10 rounded-full bg-transparent text-gray-600 font-bold text-sm flex items-center justify-center hover:bg-gray-50 transition">3</button>
                        <button class="w-10 h-10 rounded-full border border-gray-200 flex items-center justify-center text-gray-600 hover:bg-gray-50 transition bg-transparent"><i class="fas fa-chevron-right text-xs"></i></button>
                    </div>
                </div>

            </div>
        </div>
    </main>

</body>
</html>