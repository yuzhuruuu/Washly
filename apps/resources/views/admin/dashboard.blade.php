<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Washly</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<<<<<<< HEAD
<body class="bg-[#F8FAFC] h-screen font-sans text-slate-800 flex overflow-hidden antialiased">

    {{-- SIDEBAR (Kiri) --}}
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
=======
<body class="bg-gray-50">
    <div class="flex min-h-screen">
        
        {{-- ========================================== --}}
        {{-- SIDEBAR --}}
        {{-- ========================================== --}}
        <div class="w-64 bg-gray-900 text-white p-6">
            <h1 class="text-2xl font-bold text-blue-400 mb-8">Washly Admin</h1>
            <nav class="space-y-4">
                <button onclick="bukaHalaman('tab-dashboard', this)" class="menu-btn block w-full text-left py-2 px-4 bg-blue-600 rounded transition">
                    Dashboard
                </button>
                <button id="sidebar-tab-pesanan-btn" onclick="bukaHalaman('tab-pesanan', this)" class="menu-btn block w-full text-left py-2 px-4 hover:bg-gray-800 rounded transition">
                    Kelola Pesanan
                </button>
                <button onclick="bukaHalaman('tab-pembayaran', this)" class="menu-btn block w-full text-left py-2 px-4 hover:bg-gray-800 rounded transition">
                    Pembayaran
                </button>
                <button onclick="bukaHalaman('tab-kurir', this)" class="menu-btn block w-full text-left py-2 px-4 hover:bg-gray-800 rounded transition">
                    Kurir
                </button>
                    <button onclick="bukaHalaman('tab-riwayat-admin', this)" class="menu-btn block w-full text-left py-2 px-4 hover:bg-gray-800 rounded transition">
                    Riwayat Admin
                </button>
                    <button onclick="bukaHalaman('tab-pengaturan', this)" class="menu-btn block w-full text-left py-2 px-4 hover:bg-gray-800 rounded transition">
                    Pengaturan
                </button>
                
                <form action="{{ route('logout') }}" method="POST" class="mt-10">
                    @csrf
                    <button type="submit" class="text-red-400 hover:text-red-300 px-4 py-2 w-full text-left">Keluar</button>
                </form>
            </nav>
        </div>

        {{-- ========================================== --}}
        {{-- KONTEN UTAMA --}}
        {{-- ========================================== --}}
        <div class="flex-1 p-10">
            <h2 id="judul-halaman" class="text-3xl font-bold mb-8 text-gray-800">Dashboard</h2>
            @if(session('success'))
                <div class="mb-6 rounded-3xl border border-green-200 bg-green-50 px-5 py-4 text-sm text-green-700">
                    {{ session('success') }}
                </div>
            @endif
>>>>>>> 0d7885c6d42e58a5a7b3c3b1e67b0b34d2c58639

        {{-- Menu Navigasi --}}
        <nav class="flex-1 px-4 space-y-1">
            <a href="#" class="flex items-center gap-3 px-4 py-3 bg-blue-50 text-[#0074A6] rounded-xl font-bold text-sm transition">
                <i class="fas fa-th-large w-5 text-center"></i> Dashboard
            </a>
            <a href="#" class="flex items-center gap-3 px-4 py-3 text-gray-500 hover:bg-gray-50 hover:text-[#0074A6] rounded-xl font-medium text-sm transition group">
                <i class="fas fa-clipboard-list w-5 text-center text-gray-400 group-hover:text-[#0074A6] transition"></i> Kelola Pesanan
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

        {{-- Tombol Tambah Layanan (Bawah) --}}
        <div class="p-5">
            <button class="w-full bg-[#005B82] hover:bg-[#004B6D] text-white py-3 rounded-xl text-sm font-bold shadow-md transition active:scale-95 flex items-center justify-center gap-2">
                <i class="fas fa-plus"></i> Tambah Layanan
            </button>
        </div>
    </aside>

    {{-- KONTEN UTAMA (Kanan) --}}
    <main class="flex-1 h-full overflow-y-auto relative z-10">
        
        {{-- Hiasan Background Blobs (Opsional biar ga kaku) --}}
        <div class="absolute bottom-0 left-0 w-96 h-96 bg-cyan-100/30 rounded-full blur-[120px] pointer-events-none z-0"></div>

        <div class="p-10 max-w-7xl mx-auto relative z-10">
            
            {{-- Header Atas --}}
            <header class="flex justify-between items-center mb-10">
                <div>
                    <h1 class="text-[22px] font-bold text-gray-800">Overview Dashboard</h1>
                    <p class="text-sm text-gray-500 mt-1 font-medium">Ringkasan operasional Washly hari ini.</p>
                </div>
                <button class="w-10 h-10 bg-white rounded-full shadow-sm border border-gray-100 flex items-center justify-center text-gray-400 hover:text-[#0074A6] hover:bg-gray-50 transition">
                    <i class="fas fa-bell"></i>
                </button>
            </header>

            {{-- Judul Seksi & Tombol Tambah --}}
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-xl font-bold text-gray-800">Statistik Hari Ini</h2>
                <button class="bg-[#00AEEF] hover:bg-blue-500 text-white px-5 py-2.5 rounded-full text-sm font-bold shadow-md shadow-blue-200 transition active:scale-95 flex items-center gap-2">
                    <i class="fas fa-plus-circle"></i> Tambah Pesanan Manual
                </button>
            </div>

            {{-- 4 KOTAK STATISTIK --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
                
                {{-- Card 1: Pesanan Hari Ini --}}
                <div class="bg-white p-6 rounded-[1.25rem] shadow-sm border border-gray-100 relative overflow-hidden group hover:shadow-md transition">
                    <div class="absolute top-0 right-0 w-20 h-20 bg-blue-50/50 rounded-bl-full -mr-4 -mt-4 transition group-hover:scale-110"></div>
                    <div class="flex justify-between items-start mb-4 relative z-10">
                        <div class="w-10 h-10 bg-blue-50 text-[#00AEEF] rounded-full flex items-center justify-center">
                            {{-- SVG Mesin Cuci Anti-Gaib --}}
                            <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path d="M8 6C9.1 6 10 5.1 10 4C10 2.9 9.1 2 8 2C6.9 2 6 2.9 6 4C6 5.1 6.9 6 8 6M14 6H20V4H14V6M19.1 22C20.2 22 21.1 21.1 21.1 20V10C21.1 8.9 20.2 8 19.1 8H4.9C3.8 8 2.9 8.9 2.9 10V20C2.9 21.1 3.8 22 4.9 22H19.1M12 11C14.2 11 16 12.8 16 15C16 17.2 14.2 19 12 19C9.8 19 8 17.2 8 15C8 12.8 9.8 11 12 11M12 13C10.9 13 10 13.9 10 15C10 16.1 10.9 17 12 17C13.1 17 14 16.1 14 15C14 13.9 13.1 13 12 13Z" />
                            </svg>
                        </div>
                        <span class="bg-blue-50 text-[#00AEEF] px-2.5 py-1 rounded-full text-[10px] font-bold">+12%</span>
                    </div>
                    <p class="text-xs text-gray-500 font-medium mb-1 relative z-10">Pesanan Hari Ini</p>
                    <h3 class="text-3xl font-black text-gray-800 relative z-10">42</h3>
                </div>

<<<<<<< HEAD
                {{-- Card 2: Sedang Diproses --}}
                <div class="bg-white p-6 rounded-[1.25rem] shadow-sm border border-gray-100 relative overflow-hidden group hover:shadow-md transition">
                    <div class="absolute top-0 right-0 w-20 h-20 bg-orange-50/50 rounded-bl-full -mr-4 -mt-4 transition group-hover:scale-110"></div>
                    <div class="w-10 h-10 bg-orange-50 text-orange-500 rounded-full flex items-center justify-center mb-4 relative z-10">
                        <i class="fas fa-sync-alt"></i>
                    </div>
                    <p class="text-xs text-gray-500 font-medium mb-1 relative z-10">Sedang Diproses</p>
                    <h3 class="text-3xl font-black text-gray-800 relative z-10">18</h3>
                </div>

                {{-- Card 3: Selesai Hari Ini --}}
                <div class="bg-white p-6 rounded-[1.25rem] shadow-sm border border-gray-100 relative overflow-hidden group hover:shadow-md transition">
                    <div class="absolute top-0 right-0 w-20 h-20 bg-cyan-50/50 rounded-bl-full -mr-4 -mt-4 transition group-hover:scale-110"></div>
                    <div class="w-10 h-10 bg-cyan-50 text-cyan-500 rounded-full flex items-center justify-center mb-4 relative z-10">
                        <i class="fas fa-check-circle"></i>
                    </div>
                    <p class="text-xs text-gray-500 font-medium mb-1 relative z-10">Selesai Hari Ini</p>
                    <h3 class="text-3xl font-black text-gray-800 relative z-10">24</h3>
                </div>

                {{-- Card 4: Menunggu Bayar --}}
                <div class="bg-white p-6 rounded-[1.25rem] shadow-sm border border-gray-100 relative overflow-hidden group hover:shadow-md transition">
                    <div class="absolute top-0 right-0 w-20 h-20 bg-red-50/50 rounded-bl-full -mr-4 -mt-4 transition group-hover:scale-110"></div>
                    <div class="flex justify-between items-start mb-4 relative z-10">
                        <div class="w-10 h-10 bg-red-50 text-red-500 rounded-full flex items-center justify-center">
                            <i class="fas fa-money-bill-wave"></i>
                        </div>
                        <span class="bg-red-50 text-red-500 px-2.5 py-1 rounded-full text-[10px] font-bold">Action Needed</span>
                    </div>
                    <p class="text-xs text-gray-500 font-medium mb-1 relative z-10">Menunggu Bayar</p>
                    <h3 class="text-3xl font-black text-gray-800 relative z-10">5</h3>
                </div>

            </div>

            {{-- TABEL PESANAN TERBARU --}}
            <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-7">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-lg font-bold text-gray-800">Pesanan Terbaru</h2>
                    <a href="#" class="text-[#0074A6] text-sm font-semibold hover:underline">Lihat Semua</a>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="border-b border-gray-100">
                                <th class="pb-3 text-[10px] font-bold text-gray-400 uppercase tracking-wider">ID Pesanan</th>
                                <th class="pb-3 text-[10px] font-bold text-gray-400 uppercase tracking-wider">Pelanggan</th>
                                <th class="pb-3 text-[10px] font-bold text-gray-400 uppercase tracking-wider">Layanan</th>
                                <th class="pb-3 text-[10px] font-bold text-gray-400 uppercase tracking-wider">Status</th>
                                <th class="pb-3 text-[10px] font-bold text-gray-400 uppercase tracking-wider text-right">Aksi</th>
=======
                <div class="bg-white rounded-2xl shadow-sm border p-6">
                    <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between mb-4">
                        <h3 class="font-bold text-gray-800">Pesanan Terbaru</h3>
                        <button onclick="bukaHalaman('tab-pesanan', document.getElementById('sidebar-tab-pesanan-btn'))" class="inline-flex items-center gap-2 rounded-xl border border-blue-200 bg-blue-50 px-4 py-2 text-sm font-semibold text-blue-600 hover:bg-blue-100 transition">
                            Lihat Semua Pesanan
                        </button>
                    </div>
                    <table class="w-full text-left">
                        <tbody class="divide-y">
                            @foreach($pesanan_terbaru ?? [] as $pt)
                            <tr>
                                <td class="py-3 font-bold text-sm">{{ $pt->pelanggan->nama }}</td>
                                <td class="py-3 text-sm text-gray-500">{{ $pt->layanan->nama_layanan }}</td>
                                <td class="py-3"><span class="px-2 py-1 bg-blue-50 text-blue-600 text-[10px] font-bold rounded-full">{{ strtoupper($pt->status) }}</span></td>
                                <td class="py-3 text-xs text-gray-400 text-right">{{ $pt->created_at->diffForHumans() }}</td>
>>>>>>> 0d7885c6d42e58a5a7b3c3b1e67b0b34d2c58639
                            </tr>
                        </thead>
                        <tbody class="text-sm">
                            
                            {{-- Baris 1: Budi --}}
                            <tr class="border-b border-gray-50 hover:bg-gray-50/80 transition">
                                <td class="py-4 font-semibold text-gray-700">#ORD-0921</td>
                                <td class="py-4">
                                    <div class="flex items-center gap-3">
                                        <div class="w-8 h-8 rounded-full bg-blue-100 text-blue-500 flex items-center justify-center text-[10px] font-bold">BP</div>
                                        <span class="font-medium text-gray-700">Budi Pratama</span>
                                    </div>
                                </td>
                                <td class="py-4 text-gray-500 font-medium">Cuci Kering + Setrika</td>
                                <td class="py-4">
                                    <span class="bg-orange-50 text-orange-600 px-3 py-1.5 rounded-full text-[10px] font-bold">Sedang Diproses</span>
                                </td>
                                <td class="py-4 text-right">
                                    <button class="px-5 py-1.5 border border-gray-200 text-gray-500 rounded-full text-xs font-semibold hover:border-[#0074A6] hover:text-[#0074A6] hover:bg-blue-50 transition">Kelola</button>
                                </td>
                            </tr>
                            
                            {{-- Baris 2: Anita --}}
                            <tr class="border-b border-gray-50 hover:bg-gray-50/80 transition">
                                <td class="py-4 font-semibold text-gray-700">#ORD-0920</td>
                                <td class="py-4">
                                    <div class="flex items-center gap-3">
                                        <div class="w-8 h-8 rounded-full bg-cyan-100 text-cyan-600 flex items-center justify-center text-[10px] font-bold">AS</div>
                                        <span class="font-medium text-gray-700">Anita Sari</span>
                                    </div>
                                </td>
                                <td class="py-4 text-gray-500 font-medium">Cuci Sepatu Premium</td>
                                <td class="py-4">
                                    <span class="bg-red-50 text-red-500 px-3 py-1.5 rounded-full text-[10px] font-bold">Menunggu Bayar</span>
                                </td>
                                <td class="py-4 text-right">
                                    <button class="px-5 py-1.5 border border-gray-200 text-gray-500 rounded-full text-xs font-semibold hover:border-[#0074A6] hover:text-[#0074A6] hover:bg-blue-50 transition">Kelola</button>
                                </td>
                            </tr>

                            {{-- Baris 3: Dian --}}
                            <tr class="hover:bg-gray-50/80 transition">
                                <td class="py-4 font-semibold text-gray-700">#ORD-0919</td>
                                <td class="py-4">
                                    <div class="flex items-center gap-3">
                                        <div class="w-8 h-8 rounded-full bg-orange-100 text-orange-600 flex items-center justify-center text-[10px] font-bold">DW</div>
                                        <span class="font-medium text-gray-700">Dian Wijaya</span>
                                    </div>
                                </td>
                                <td class="py-4 text-gray-500 font-medium">Setrika Saja (5kg)</td>
                                <td class="py-4">
                                    <span class="bg-cyan-50 text-cyan-500 px-3 py-1.5 rounded-full text-[10px] font-bold">Selesai</span>
                                </td>
                                <td class="py-4 text-right">
                                    <button class="px-5 py-1.5 border border-gray-200 text-gray-500 rounded-full text-xs font-semibold hover:border-[#0074A6] hover:text-[#0074A6] hover:bg-blue-50 transition">Kelola</button>
                                </td>
                            </tr>

                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </main>

<<<<<<< HEAD
=======
                    {{-- ========================================== --}}
                    {{-- MODAL DETAIL (REVISI AUTO-STATUS) --}}
                    {{-- ========================================== --}}
                    <div id="modal-{{ $p->id_pesanan }}" class="fixed inset-0 bg-black bg-opacity-60 hidden flex items-center justify-center z-50 p-4">
                        <div class="bg-white rounded-3xl w-full max-w-4xl overflow-hidden shadow-2xl animate-in fade-in zoom-in duration-200">
                            
                            {{-- Header --}}
                            <div class="bg-gray-900 p-6 flex justify-between items-center text-white">
                                <div>
                                    <h3 class="text-xl font-black uppercase tracking-tight">Detail Pesanan #{{ $p->id_pesanan }}</h3>
                                    <p class="text-xs text-gray-400 mt-1">Masuk pada: {{ $p->created_at->format('d M Y, H:i') }}</p>
                                </div>
                                <button onclick="document.getElementById('modal-{{ $p->id_pesanan }}').classList.add('hidden')" class="text-gray-400 hover:text-white text-2xl">&times;</button>
                            </div>

                            {{-- Body --}}
                            <form id="admin-update-form-{{ $p->id_pesanan }}" action="{{ route('admin.pesanan.update', $p->id_pesanan) }}" method="POST" class="space-y-5">
                                @csrf @method('PATCH')
                                <div class="p-8 grid grid-cols-1 md:grid-cols-2 gap-10">
                                    
                                    {{-- KOLOM KIRI: INFO PELANGGAN & BUKTI --}}
                                    <div class="space-y-6">
                                        <div>
                                            <h4 class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-3">Informasi Pelanggan</h4>
                                            <div class="bg-gray-50 p-5 rounded-2xl border border-gray-100">
                                                <p class="text-lg font-bold text-gray-800">{{ $p->pelanggan->nama }}</p>
                                                <p class="text-sm text-gray-600 mt-1"><i class="fab fa-whatsapp mr-2 text-green-500"></i> {{ $p->pelanggan->no_hp }}</p>
                                                <p class="text-sm text-gray-600 mt-2 flex items-start"><i class="fas fa-map-marker-alt mr-2 mt-1 text-red-400"></i> {{ $p->pelanggan->alamat }}</p>
                                            </div>
                                        </div>

                                        <div>
                                            <h4 class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-3">Bukti Pembayaran</h4>
                                            @if($p->status == 'menunggu_konfirmasi')
                                                <div class="mb-5 flex items-center justify-between p-4 rounded-2xl border border-blue-100 bg-blue-50">
                                                    <label for="validasi-pembayaran-{{ $p->id_pesanan }}" class="flex items-center gap-3 cursor-pointer">
                                                        <input id="validasi-pembayaran-{{ $p->id_pesanan }}" type="checkbox" name="validasi_pembayaran" value="1" class="h-5 w-5 text-blue-600 border-gray-300 rounded">
                                                        <span class="text-sm font-bold text-blue-700">Centang untuk validasi pembayaran</span>
                                                    </label>
                                                    <span class="text-xs font-bold uppercase tracking-wider text-blue-600">Auto ke Sedang Dicuci</span>
                                                </div>
                                            @endif
                                            @php
                                                $buktiPath = $p->bukti_bayar ?? optional($p->pembayaran)->bukti_bayar;
                                                $metodePembayaran = $p->metode_pembayaran ?? optional($p->pembayaran)->metode_pembayaran;
                                            @endphp
                                            @if($metodePembayaran)
                                                <p class="text-xs font-bold text-gray-500 uppercase tracking-widest mb-2">Metode: {{ $metodePembayaran == 'transfer_bank' ? 'Transfer Bank' : 'E-Walet / QRIS' }}</p>
                                            @endif
                                            @if($buktiPath)
                                                <a href="{{ asset('storage/'.$buktiPath) }}" target="_blank" class="group relative block rounded-2xl overflow-hidden border-2 border-gray-100">
                                                    <img src="{{ asset('storage/'.$buktiPath) }}" class="w-full h-48 object-cover group-hover:scale-105 transition duration-300">
                                                    <div class="absolute inset-0 bg-black bg-opacity-20 flex items-center justify-center opacity-0 group-hover:opacity-100 transition">
                                                        <span class="bg-white text-gray-900 px-4 py-2 rounded-full font-bold text-xs shadow-lg">Klik Perbesar</span>
                                                    </div>
                                                </a>
                                            @else
                                                <div class="py-12 text-center border-2 border-dashed rounded-2xl bg-gray-50 text-gray-400 italic text-sm">
                                                    Belum ada bukti pembayaran!
                                                </div>
                                            @endif
                                        </div>
                                    </div>

                                    {{-- KOLOM KANAN: FORM UPDATE ADMIN --}}
                                    <div class="bg-white">
                                        <h4 class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-3">Aksi Admin</h4>

                                        <div>
                                            <label class="block text-xs font-bold text-gray-600 mb-2">Update Berat (Kg)</label>
                                            <div class="relative">
                                                {{-- SULAP: oninput akan mengubah dropdown status secara otomatis --}}
                                                <input type="number" step="0.1" name="berat" value="{{ $p->berat }}" 
                                                    oninput="if(this.value > 0 && document.getElementById('status-{{ $p->id_pesanan }}').value == 'menunggu_timbang') { document.getElementById('status-{{ $p->id_pesanan }}').value = 'menunggu_bayar'; }"
                                                    class="w-full bg-gray-50 border-gray-200 rounded-xl py-3 px-4 focus:ring-2 focus:ring-blue-400 transition" placeholder="Contoh: 3.5">
                                                <span class="absolute right-4 top-3 text-gray-400 font-bold">Kg</span>
                                            </div>
                                            @if($p->total_harga > 0)
                                                <p class="mt-2 text-sm font-black text-green-600">Estimasi Biaya: Rp {{ number_format($p->total_harga, 0, ',', '.') }}</p>
                                            @endif
                                        </div>

                                        <div>
                                            <label class="block text-xs font-bold text-gray-600 mb-2">Tugaskan Kurir</label>
                                            <select name="id_kurir" class="w-full bg-gray-50 border-gray-200 rounded-xl py-3 px-4 focus:ring-2 focus:ring-blue-400">
                                                <option value="">-- Pilih Kurir --</option>
                                                @foreach($daftar_kurir ?? [] as $k)
                                                    <option value="{{ $k->id_kurir }}" {{ $p->id_kurir == $k->id_kurir ? 'selected' : '' }}>{{ $k->nama }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div>
                                            <label class="block text-xs font-bold text-gray-600 mb-2">Status Pesanan</label>
                                            {{-- Dikasih ID status-{{ $p->id_pesanan }} supaya bisa dipanggil JavaScript di atas --}}
                                            <select name="status" id="status-{{ $p->id_pesanan }}" class="w-full bg-blue-50 text-blue-700 border-blue-100 rounded-xl py-3 px-4 font-bold focus:ring-2 focus:ring-blue-400">
                                                @if($p->status == 'menunggu_konfirmasi')
                                                    <option value="menunggu_konfirmasi" selected>Validasi Pembayaran (gunakan checkbox kiri)</option>
                                                @endif
                                                <option value="menunggu_pickup" {{ $p->status == 'menunggu_pickup' ? 'selected' : '' }}>Jemput Sekarang</option>
                                                <option value="menunggu_timbang" {{ $p->status == 'menunggu_timbang' ? 'selected' : '' }}>Sudah Dijemput (Tunggu Timbang)</option>
                                                <option value="menunggu_bayar" {{ $p->status == 'menunggu_bayar' ? 'selected' : '' }}>Menunggu Pembayaran</option>
                                                <option value="proses" {{ $p->status == 'proses' ? 'selected' : '' }}>Sedang Dicuci</option>
                                                <option value="delivery" {{ $p->status == 'delivery' ? 'selected' : '' }}>Siap Diantar Kurir</option>
                                                <option value="selesai" {{ $p->status == 'selesai' ? 'selected' : '' }}>Selesai / Berhasil</option>
                                            </select>
                                        </div>

                                        <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-black py-4 rounded-xl shadow-lg transition duration-200 uppercase tracking-widest text-xs">
                                            Simpan Perubahan
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            {{-- HALAMAN 3: KURIR --}}
            <div id="tab-kurir" class="tab-konten hidden">
                <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-xl font-bold text-gray-800">Manajemen Petugas Kurir</h3>
                        <button onclick="document.getElementById('form-tambah-kurir').classList.toggle('hidden')" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm font-bold shadow-md transition">+ Tambah Akun Kurir</button>
                    </div>

                    {{-- Form Tambah Kurir --}}
                    <div id="form-tambah-kurir" class="hidden mb-8 bg-gray-50 p-6 rounded-2xl border border-dashed border-gray-300">
                        <h4 class="text-xs font-bold text-gray-400 uppercase mb-4 tracking-widest">Buat Akun Kurir Baru</h4>
                        <form action="{{ route('admin.kurir.store') }}" method="POST" class="grid grid-cols-1 md:grid-cols-4 gap-4">
                            @csrf
                            <input type="text" name="nama" placeholder="Nama Lengkap" class="border-gray-200 rounded-xl p-3 text-sm focus:ring-blue-500" required>
                            <input type="text" name="no_hp" placeholder="Nomor HP (WA)" class="border-gray-200 rounded-xl p-3 text-sm focus:ring-blue-500" required>
                            <input type="text" name="username" placeholder="Username Login" class="border-gray-200 rounded-xl p-3 text-sm focus:ring-blue-500" required>
                            @error('username')
                                <p class="text-red-500 text-xs mt-1 font-bold">Username ini udah dipake kurir lain! Ganti dengan yang lain!</p>
                            @enderror
                            <input type="password" name="password" placeholder="Password" class="border-gray-200 rounded-xl p-3 text-sm focus:ring-blue-500" required>
                            <button type="submit" class="bg-green-600 hover:bg-green-700 text-white rounded-xl font-bold col-span-full py-3 shadow-md transition">Simpan & Aktifkan Kurir</button>
                        </form>
                    </div>

                    {{-- Tabel Daftar Kurir --}}
                    <div class="overflow-x-auto">
                        <table class="w-full text-left">
                            <thead class="bg-gray-50 border-b text-xs uppercase text-gray-400">
                                <tr>
                                    <th class="p-4 font-bold">Nama Petugas</th>
                                    <th class="p-4 font-bold">Username</th>
                                    <th class="p-4 font-bold">No HP</th>
                                    <th class="p-4 font-bold text-center">Status</th>
                                    <th class="p-4 font-bold text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                @forelse($daftar_kurir ?? [] as $kurir)
                                <tr class="hover:bg-gray-50 transition">
                                    <td class="p-4 font-bold text-gray-800">{{ $kurir->nama }}</td>
                                    <td class="p-4 text-sm text-gray-500 font-mono bg-gray-100 px-2 rounded">{{ $kurir->username }}</td>
                                    <td class="p-4 text-sm text-gray-600">{{ $kurir->no_hp }}</td>
                                    <td class="p-4 text-center">
                                        @php $sedangTugas = $kurir->pesanan()->whereIn('status', ['menunggu_pickup', 'delivery'])->count(); @endphp
                                        <span class="px-2 py-1 text-[10px] font-bold rounded-full uppercase {{ $sedangTugas > 0 ? 'bg-orange-100 text-orange-600' : 'bg-green-100 text-green-600' }}">
                                            {{ $sedangTugas > 0 ? 'Sibuk' : 'Aktif / Standby' }}
                                        </span>
                                    </td>
                                    <td class="p-4 text-center">
                                        <button class="text-blue-500 hover:text-blue-700 font-bold text-xs mr-3"><i class="fas fa-edit"></i> Edit</button>
                                        <button class="text-red-500 hover:text-red-700 font-bold text-xs"><i class="fas fa-trash"></i> Hapus</button>
                                    </td>
                                </tr>
                                @empty
                                <tr><td colspan="5" class="p-10 text-center text-gray-400 italic">Belum ada kurir, rekrut si Budi gih!</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            {{-- HALAMAN LAIN (KOSONGAN) --}}
            <div id="tab-pembayaran" class="tab-konten hidden">
                <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-8">
                    <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6">
                        <div>
                            <h3 class="text-xl font-bold text-gray-800">Validasi Pembayaran</h3>
                            <p class="text-sm text-gray-500 mt-2">Lihat status bukti pembayaran pelanggan dan konfirmasi jika sudah sesuai.</p>
                        </div>
                        <button onclick="bukaHalaman('tab-pesanan', document.getElementById('sidebar-tab-pesanan-btn'))" class="rounded-xl bg-blue-600 text-white px-4 py-2 text-sm font-semibold hover:bg-blue-700 transition">Buka Kelola Pesanan</button>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-left">
                            <thead class="bg-gray-50 border-b text-xs uppercase text-gray-400">
                                <tr>
                                    <th class="p-4 font-bold">Pesanan</th>
                                    <th class="p-4 font-bold">Nama Pelanggan</th>
                                    <th class="p-4 font-bold">Metode</th>
                                    <th class="p-4 font-bold">Status</th>
                                    <th class="p-4 font-bold">Bukti</th>
                                    <th class="p-4 font-bold">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                @forelse($daftar_pembayaran ?? [] as $pembayaran)
                                <tr class="hover:bg-gray-50 transition">
                                    <td class="p-4 text-sm font-bold">WS-{{ $pembayaran->id_pesanan }}</td>
                                    <td class="p-4 text-sm text-gray-600">{{ optional(optional($pembayaran->pesanan)->pelanggan)->nama ?? '-' }}</td>
                                    <td class="p-4 text-sm text-gray-600">{{ $pembayaran->metode_pembayaran == 'transfer_bank' ? 'Transfer Bank' : 'E-Walet / QRIS' }}</td>
                                    <td class="p-4 text-sm">
                                        @if($pembayaran->status_pembayaran == 'valid')
                                            <span class="px-2 py-1 rounded-full bg-green-100 text-green-700 uppercase text-[10px] font-bold">Valid</span>
                                        @else
                                            <span class="px-2 py-1 rounded-full bg-yellow-100 text-yellow-700 uppercase text-[10px] font-bold">Menunggu Validasi</span>
                                        @endif
                                    </td>
                                    <td class="p-4 text-sm text-blue-600 font-semibold">
                                        @if($pembayaran->bukti_bayar)
                                            <a href="{{ asset('storage/'.$pembayaran->bukti_bayar) }}" target="_blank" class="hover:underline">Lihat Bukti</a>
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td class="p-4 text-center">
                                        @if($pembayaran->status_pembayaran !== 'valid')
                                            <form action="{{ route('pembayaran.konfirmasi', $pembayaran->id_pembayaran) }}" method="POST" class="inline-block">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="rounded-xl bg-green-600 text-white px-3 py-2 text-xs font-bold hover:bg-green-700 transition">Konfirmasi</button>
                                            </form>
                                        @else
                                            <span class="text-xs text-gray-500">Tidak ada aksi</span>
                                        @endif
                                    </td>
                                </tr>
                                @empty
                                <tr><td colspan="6" class="p-10 text-center text-gray-400 italic">Belum ada bukti pembayaran yang masuk.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div id="tab-riwayat-admin" class="tab-konten hidden">
                <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-8">
                    <h3 class="text-xl font-bold text-gray-800 mb-6">Riwayat Pesanan</h3>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                        <div class="rounded-3xl border border-gray-200 bg-sky-50 p-6">
                            <p class="text-sm uppercase tracking-[0.3em] text-sky-600 font-semibold">Total Pesanan</p>
                            <p class="mt-4 text-3xl font-bold text-slate-900">{{ $jumlah_pesanan ?? 0 }}</p>
                        </div>
                        <div class="rounded-3xl border border-gray-200 bg-emerald-50 p-6">
                            <p class="text-sm uppercase tracking-[0.3em] text-emerald-600 font-semibold">Total Pendapatan</p>
                            <p class="mt-4 text-3xl font-bold text-emerald-900">Rp {{ number_format($total_pendapatan_semua ?? 0, 0, ',', '.') }}</p>
                        </div>
                        <div class="rounded-3xl border border-gray-200 bg-violet-50 p-6">
                            <p class="text-sm uppercase tracking-[0.3em] text-violet-600 font-semibold">Rata-rata Berat</p>
                            <p class="mt-4 text-3xl font-bold text-violet-900">{{ number_format($rata_rata_berat ?? 0, 2, ',', '.') }} kg</p>
                        </div>
                    </div>

                    <div class="overflow-x-auto rounded-3xl border border-gray-200 bg-white shadow-sm">
                        <table class="min-w-full divide-y divide-gray-200 text-sm">
                            <thead class="bg-gray-50 text-left text-xs uppercase text-gray-500 tracking-wide">
                                <tr>
                                    <th class="px-4 py-3">No</th>
                                    <th class="px-4 py-3">Pelanggan</th>
                                    <th class="px-4 py-3">Layanan</th>
                                    <th class="px-4 py-3">Berat</th>
                                    <th class="px-4 py-3">Total Harga</th>
                                    <th class="px-4 py-3">Status</th>
                                    <th class="px-4 py-3">Tanggal</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100 bg-white">
                                @forelse($semua_pesanan as $index => $pesanan)
                                    <tr>
                                        <td class="px-4 py-4 text-gray-700">{{ $index + 1 }}</td>
                                        <td class="px-4 py-4 text-gray-700">{{ $pesanan->pelanggan->nama ?? 'Tidak diketahui' }}</td>
                                        <td class="px-4 py-4 text-gray-700">{{ $pesanan->layanan->nama_layanan ?? '-' }}</td>
                                        <td class="px-4 py-4 text-gray-700">{{ $pesanan->berat > 0 ? number_format($pesanan->berat, 2, ',', '.') . ' kg' : '0 kg' }}</td>
                                        <td class="px-4 py-4 text-gray-700">Rp {{ number_format($pesanan->total_harga ?? 0, 0, ',', '.') }}</td>
                                        <td class="px-4 py-4">
                                            <span class="inline-flex items-center rounded-full bg-slate-100 px-3 py-1 text-xs font-semibold text-slate-700">
                                                {{ ucfirst(str_replace('_', ' ', $pesanan->status ?? 'unknown')) }}
                                            </span>
                                        </td>
                                        <td class="px-4 py-4 text-gray-500">{{ optional($pesanan->created_at)->format('d M Y') }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="px-4 py-10 text-center text-gray-400">Belum ada riwayat pesanan.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div id="tab-pengaturan" class="tab-konten hidden">
                <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-8">
                    <h3 class="text-xl font-bold text-gray-800 mb-6">Pengaturan Admin</h3>
                    <div class="grid gap-6 lg:grid-cols-2">
                        <div class="rounded-3xl border border-gray-200 bg-slate-50 p-6">
                            <h4 class="text-lg font-semibold text-gray-800 mb-3">Informasi Admin</h4>
                            <p class="text-sm text-gray-500 mb-4">Data admin saat ini yang sedang login.</p>
                            <div class="space-y-4 text-sm text-gray-700">
                                <div>
                                    <p class="font-semibold text-gray-800">Nama</p>
                                    <p>{{ $admin->nama ?? 'Admin Washly' }}</p>
                                </div>
                                <div>
                                    <p class="font-semibold text-gray-800">Username</p>
                                    <p>{{ $admin->username ?? '-' }}</p>
                                </div>
                                <div>
                                    <p class="font-semibold text-gray-800">Email</p>
                                    <p>{{ $admin->email ?? '-' }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="rounded-3xl border border-gray-200 bg-slate-50 p-6">
                            <h4 class="text-lg font-semibold text-gray-800 mb-3">Profil Toko</h4>
                            <p class="text-sm text-gray-500 mb-4">Informasi dasar toko laundry yang bisa dilihat admin.</p>
                            <div class="space-y-4 text-sm text-gray-700">
                                <div>
                                    <p class="font-semibold text-gray-800">Nama Laundry</p>
                                    <p>{{ $toko_profil['nama'] }}</p>
                                </div>
                                <div>
                                    <p class="font-semibold text-gray-800">Alamat</p>
                                    <p>{{ $toko_profil['alamat'] }}</p>
                                </div>
                                <div>
                                    <p class="font-semibold text-gray-800">Jam Operasional</p>
                                    <p>{{ $toko_profil['jam_operasional'] }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-10">
                        <h4 class="text-lg font-semibold text-gray-800 mb-4">Edit Layanan & Tarif</h4>
                        <div class="overflow-x-auto rounded-3xl border border-gray-200 bg-white shadow-sm">
                            <table class="min-w-full divide-y divide-gray-200 text-sm">
                                <thead class="bg-gray-50 text-left text-xs uppercase text-gray-500 tracking-wide">
                                    <tr>
                                        <th class="px-4 py-3">Layanan</th>
                                        <th class="px-4 py-3">Harga / Kg</th>
                                        <th class="px-4 py-3">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-100 bg-white">
                                    @forelse($daftar_layanan as $layanan)
                                        <tr>
                                            <td class="px-4 py-4 text-gray-700">
                                                <form action="{{ route('admin.layanan.update', $layanan->id_layanan) }}" method="POST" class="grid gap-3 sm:grid-cols-[1fr,200px,130px] items-center">
                                                    @csrf
                                                    @method('PATCH')
                                                    <input type="text" name="nama_layanan" value="{{ $layanan->nama_layanan }}" class="w-full rounded-xl border border-gray-200 bg-gray-50 px-4 py-3 text-sm text-gray-800" required>
                                            </td>
                                            <td class="px-4 py-4 text-gray-700">
                                                    <div class="relative">
                                                        <span class="pointer-events-none absolute left-4 top-1/2 -translate-y-1/2 text-gray-400">Rp</span>
                                                        <input type="number" name="harga_per_kg" value="{{ $layanan->harga_per_kg }}" step="0.01" min="0" class="w-full rounded-xl border border-gray-200 bg-gray-50 px-11 py-3 text-sm text-gray-800" required>
                                                    </div>
                                            </td>
                                            <td class="px-4 py-4 text-gray-700">
                                                    <button type="submit" class="inline-flex items-center justify-center rounded-xl bg-blue-600 px-4 py-3 text-xs font-bold uppercase tracking-widest text-white transition hover:bg-blue-700 sm:w-full">
                                                        Simpan
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="3" class="px-4 py-10 text-center text-gray-400">Belum ada layanan tersedia untuk diedit.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div> 
    </div>

    <script>
        function bukaHalaman(idTab, elemen) {
            document.querySelectorAll('.tab-konten').forEach(el => { el.classList.add('hidden'); el.classList.remove('block'); });
            const target = document.getElementById(idTab);
            target.classList.remove('hidden');
            target.classList.add('block');
            document.getElementById('judul-halaman').innerText = elemen.innerText.trim();
            document.querySelectorAll('.menu-btn').forEach(btn => { btn.classList.remove('bg-blue-600', 'rounded'); btn.classList.add('hover:bg-gray-800'); });
            elemen.classList.add('bg-blue-600', 'rounded');
        }
    </script>
>>>>>>> 0d7885c6d42e58a5a7b3c3b1e67b0b34d2c58639
</body>
</html>