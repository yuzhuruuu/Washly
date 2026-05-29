<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Washly</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-[#F8FAFC] h-screen font-sans text-slate-800 flex overflow-hidden antialiased">

    {{-- SIDEBAR (Kiri) --}}
    <aside x-data class="w-64 bg-white border-r border-gray-100 flex flex-col h-full shrink-0 relative z-20">
        {{-- Logo --}}
        <div class="p-6">
            <img src="{{ asset('images/w-a.svg') }}" alt="Washly Admin" class="h-8">
        </div>

        {{-- Profil Admin (SINKRON DATABASE) --}}
        <div class="px-6 flex items-center gap-3 mb-8">
            <div class="w-10 h-10 rounded-full border border-gray-100 overflow-hidden shadow-sm">
                <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::guard('admin')->user()?->nama ?? Auth::guard('admin')->user()?->username ?? 'Admin') }}&background=00AEEF&color=fff" alt="Admin Profile" class="w-full h-full object-cover">
            </div>
            <div>
                <h3 class="font-bold text-sm text-gray-800 leading-tight">{{ Auth::guard('admin')->user()?->nama ?? Auth::guard('admin')->user()?->username ?? 'Admin' }}</h3>
                <p class="text-[10px] text-gray-500 font-medium mt-0.5">Panel Kendali Utama</p>
            </div>
        </div>

        {{-- Menu Navigasi --}}
        <nav class="flex-1 px-4 space-y-1">
            <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-4 py-3 bg-blue-50 text-[#0074A6] rounded-xl font-bold text-sm transition">
                <i class="fas fa-th-large w-5 text-center"></i> Dashboard
            </a>
            <a href="{{ route('admin.pesanan.kelola') }}" class="flex items-center gap-3 px-4 py-3 text-gray-500 hover:bg-gray-50 hover:text-[#0074A6] rounded-xl font-medium text-sm transition group">
                <i class="fas fa-clipboard-list w-5 text-center text-gray-400 group-hover:text-[#0074A6] transition"></i> Kelola Pesanan
            </a>
            <a href="{{ route('admin.pembayaran') }}" class="flex items-center gap-3 px-4 py-3 text-gray-500 hover:bg-gray-50 hover:text-[#0074A6] rounded-xl font-medium text-sm transition group">
                <i class="fas fa-wallet w-5 text-center text-gray-400 group-hover:text-[#0074A6] transition"></i> Pembayaran
            </a>
            <a href="{{ route('admin.kurir') }}" class="flex items-center gap-3 px-4 py-3 text-gray-500 hover:bg-gray-50 hover:text-[#0074A6] rounded-xl font-medium text-sm transition group">
                <i class="fas fa-motorcycle w-5 text-center text-gray-400 group-hover:text-[#0074A6] transition"></i> Kurir
            </a>
            <a href="{{ route('admin.riwayat') }}" class="flex items-center gap-3 px-4 py-3 text-gray-500 hover:bg-gray-50 hover:text-[#0074A6] rounded-xl font-medium text-sm transition group">
                <i class="fas fa-history w-5 text-center text-gray-400 group-hover:text-[#0074A6] transition"></i> Riwayat Admin
            </a>
            <a href="{{ route('admin.pengaturan') }}" class="flex items-center gap-3 px-4 py-3 text-gray-500 hover:bg-gray-50 hover:text-[#0074A6] rounded-xl font-medium text-sm transition group">
                <i class="fas fa-cog w-5 text-center text-gray-400 group-hover:text-[#0074A6] transition"></i> Pengaturan
            </a>
            <form action="{{ route('logout') }}" method="POST" class="block w-full">
                @csrf
                <button type="submit" class="w-full flex items-center gap-3 px-4 py-3 text-red-500 hover:bg-red-50 rounded-xl font-medium text-sm transition group cursor-pointer">
                    <i class="fas fa-sign-out-alt w-5 text-center text-red-400 group-hover:text-red-600 transition"></i> Keluar Akun
                </button>
            </form>
        </nav>

<<<<<<< HEAD
        {{-- Tombol Tambah Layanan (Bawah) --}}
=======
        {{-- Tombol Tambah Layanan (Bawah) - TRIGGER --}}
>>>>>>> 1aa579cc41edae45803d9ea51980ca0d1dde8be7
        <div class="p-5 mt-auto">
            <button @click="$dispatch('buka-modal-layanan')" class="w-full text-white py-3 rounded-xl text-sm font-bold shadow-md transition active:scale-95 flex items-center justify-center gap-2 hover:opacity-90" style="background-color: #005B82;">
                <i class="fas fa-plus"></i> Tambah Layanan
            </button>
        </div>
    </aside>

    {{-- KONTEN UTAMA (Kanan) --}}
<<<<<<< HEAD
    <main class="flex-1 overflow-y-auto relative z-10" x-data="{ modalTambahLayanan: false }" @buka-modal-layanan.window="modalTambahLayanan = true">
=======
    <main class="flex-1 overflow-y-auto relative z-10" x-data="{ modalTambahLayanan: false, modalTambahPesananManual: false }" @buka-modal-layanan.window="modalTambahLayanan = true">
>>>>>>> 1aa579cc41edae45803d9ea51980ca0d1dde8be7
        
        {{-- Hiasan Background Blobs --}}
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
                <button type="button" @click="modalTambahPesananManual = true" class="bg-[#00AEEF] hover:bg-blue-500 text-white px-5 py-2.5 rounded-full text-sm font-bold shadow-md shadow-blue-200 transition active:scale-95 flex items-center gap-2">
                    <i class="fas fa-plus-circle"></i> Tambah Pesanan Manual
                </button>
            </div>

            {{-- 4 KOTAK STATISTIK (SINKRON VARIABEL) --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
                
                {{-- Card 1: Pesanan Hari Ini --}}
                <div class="bg-white p-6 rounded-[1.25rem] shadow-sm border border-gray-100 relative overflow-hidden group hover:shadow-md transition">
                    <div class="absolute top-0 right-0 w-20 h-20 bg-blue-50/50 rounded-bl-full -mr-4 -mt-4 transition group-hover:scale-110"></div>
                    <div class="flex justify-between items-start mb-4 relative z-10">
                        <div class="w-10 h-10 bg-blue-50 text-[#00AEEF] rounded-full flex items-center justify-center">
                            <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path d="M8 6C9.1 6 10 5.1 10 4C10 2.9 9.1 2 8 2C6.9 2 6 2.9 6 4C6 5.1 6.9 6 8 6M14 6H20V4H14V6M19.1 22C20.2 22 21.1 21.1 21.1 20V10C21.1 8.9 20.2 8 19.1 8H4.9C3.8 8 2.9 8.9 2.9 10V20C2.9 21.1 3.8 22 4.9 22H19.1M12 11C14.2 11 16 12.8 16 15C16 17.2 14.2 19 12 19C9.8 19 8 17.2 8 15C8 12.8 9.8 11 12 11M12 13C10.9 13 10 13.9 10 15C10 16.1 10.9 17 12 17C13.1 17 14 16.1 14 15C14 13.9 13.1 13 12 13Z" />
                            </svg>
                        </div>
                        <span class="bg-blue-50 text-[#00AEEF] px-2.5 py-1 rounded-full text-[10px] font-bold">Total</span>
                    </div>
                    <p class="text-xs text-gray-500 font-medium mb-1 relative z-10">Pesanan Hari Ini</p>
                    <h3 class="text-3xl font-black text-gray-800 relative z-10">{{ $pesananHariIni ?? 0 }}</h3>
                </div>

                {{-- Card 2: Sedang Diproses --}}
                <div class="bg-white p-6 rounded-[1.25rem] shadow-sm border border-gray-100 relative overflow-hidden group hover:shadow-md transition">
                    <div class="absolute top-0 right-0 w-20 h-20 bg-orange-50/50 rounded-bl-full -mr-4 -mt-4 transition group-hover:scale-110"></div>
                    <div class="w-10 h-10 bg-orange-50 text-orange-500 rounded-full flex items-center justify-center mb-4 relative z-10">
                        <i class="fas fa-sync-alt"></i>
                    </div>
                    <p class="text-xs text-gray-500 font-medium mb-1 relative z-10">Sedang Diproses</p>
                    <h3 class="text-3xl font-black text-gray-800 relative z-10">{{ $sedangDiproses ?? 0 }}</h3>
                </div>

                {{-- Card 3: Selesai Hari Ini --}}
                <div class="bg-white p-6 rounded-[1.25rem] shadow-sm border border-gray-100 relative overflow-hidden group hover:shadow-md transition">
                    <div class="absolute top-0 right-0 w-20 h-20 bg-cyan-50/50 rounded-bl-full -mr-4 -mt-4 transition group-hover:scale-110"></div>
                    <div class="w-10 h-10 bg-cyan-50 text-cyan-500 rounded-full flex items-center justify-center mb-4 relative z-10">
                        <i class="fas fa-check-circle"></i>
                    </div>
                    <p class="text-xs text-gray-500 font-medium mb-1 relative z-10">Selesai Hari Ini</p>
                    <h3 class="text-3xl font-black text-gray-800 relative z-10">{{ $selesaiHariIni ?? 0 }}</h3>
                </div>

                {{-- Card 4: Menunggu Bayar --}}
                <div class="bg-white p-6 rounded-[1.25rem] shadow-sm border border-gray-100 relative overflow-hidden group hover:shadow-md transition">
                    <div class="absolute top-0 right-0 w-20 h-20 bg-red-50/50 rounded-bl-full -mr-4 -mt-4 transition group-hover:scale-110"></div>
                    <div class="flex justify-between items-start mb-4 relative z-10">
                        <div class="w-10 h-10 bg-red-50 text-red-500 rounded-full flex items-center justify-center">
                            <i class="fas fa-money-bill-wave"></i>
                        </div>
                        @if(($menungguBayar ?? 0) > 0)
                            <span class="bg-red-50 text-red-500 px-2.5 py-1 rounded-full text-[10px] font-bold">Action Needed</span>
                        @endif
                    </div>
                    <p class="text-xs text-gray-500 font-medium mb-1 relative z-10">Menunggu Bayar</p>
                    <h3 class="text-3xl font-black text-gray-800 relative z-10">{{ $menungguBayar ?? 0 }}</h3>
                </div>

            </div>

            {{-- TABEL PESANAN TERBARU (SINKRON PERULANGAN) --}}
            <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-7">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-lg font-bold text-gray-800">Pesanan Terbaru</h2>
                    <a href="{{ route('admin.pesanan.kelola') }}" class="text-[#0074A6] text-sm font-semibold hover:underline">Lihat Semua</a>
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
                            </tr>
                        </thead>
                        <tbody class="text-sm">
<<<<<<< HEAD
                            
=======
>>>>>>> 1aa579cc41edae45803d9ea51980ca0d1dde8be7
                            @forelse($pesananTerbaru ?? [] as $pesanan)
                                <tr class="border-b border-gray-50 hover:bg-gray-50/80 transition">
                                    <td class="py-4 font-semibold text-gray-700">#ORD-{{ str_pad($pesanan->id_pesanan ?? $pesanan->id, 4, '0', STR_PAD_LEFT) }}</td>
                                    <td class="py-4">
                                        <div class="flex items-center gap-3">
<<<<<<< HEAD
                                            {{-- Logika Avatar Dinamis & Warna-warni --}}
=======
>>>>>>> 1aa579cc41edae45803d9ea51980ca0d1dde8be7
                                            @php
                                                $nama = $pesanan->pelanggan->nama ?? 'Unknown';
                                                $kata = explode(' ', $nama);
                                                $inisial = strtoupper(substr($kata[0], 0, 1) . (isset($kata[1]) ? substr($kata[1], 0, 1) : ''));
<<<<<<< HEAD
                                                
                                                // Daftar warna persis seperti mockup FE
                                                $warna = [
                                                    'bg-blue-100 text-blue-500', 
                                                    'bg-cyan-100 text-cyan-600', 
                                                    'bg-orange-100 text-orange-600',
                                                    'bg-indigo-100 text-indigo-500',
                                                    'bg-pink-100 text-pink-500'
                                                ];
=======
                                                $warna = ['bg-blue-100 text-blue-500', 'bg-cyan-100 text-cyan-600', 'bg-orange-100 text-orange-600', 'bg-indigo-100 text-indigo-500', 'bg-pink-100 text-pink-500'];
>>>>>>> 1aa579cc41edae45803d9ea51980ca0d1dde8be7
                                                $warnaPilih = $warna[crc32($nama) % count($warna)];
                                            @endphp
                                            <div class="w-8 h-8 rounded-full {{ $warnaPilih }} flex items-center justify-center text-[10px] font-bold">
                                                {{ $inisial }}
                                            </div>
                                            <span class="font-medium text-gray-700">{{ $nama }}</span>
                                        </div>
                                    </td>
                                    <td class="py-4 text-gray-500 font-medium">{{ $pesanan->layanan->nama_layanan ?? 'N/A' }}</td>
                                    <td class="py-4">
<<<<<<< HEAD
                                        {{-- Logika Warna Badge Status Persis FE --}}
=======
>>>>>>> 1aa579cc41edae45803d9ea51980ca0d1dde8be7
                                        @if(($pesanan->status_pembayaran ?? '') == 'Belum Lunas' || ($pesanan->status ?? '') == 'Menunggu Pembayaran')
                                            <span class="bg-red-50 text-red-500 px-3 py-1.5 rounded-full text-[10px] font-bold">Menunggu Bayar</span>
                                        @elseif(($pesanan->status ?? '') == 'Selesai')
                                            <span class="bg-cyan-50 text-cyan-500 px-3 py-1.5 rounded-full text-[10px] font-bold">Selesai</span>
                                        @elseif(in_array(($pesanan->status ?? ''), ['Proses Cuci', 'Sedang Diproses', 'Diambil Kurir']))
                                            <span class="bg-orange-50 text-orange-600 px-3 py-1.5 rounded-full text-[10px] font-bold">{{ $pesanan->status }}</span>
                                        @else
                                            <span class="bg-blue-50 text-blue-500 px-3 py-1.5 rounded-full text-[10px] font-bold">{{ $pesanan->status ?? 'Pesanan Baru' }}</span>
                                        @endif
                                    </td>
                                    <td class="py-4 text-right">
                                        <a href="{{ route('admin.pesanan.detail', $pesanan->id_pesanan ?? $pesanan->id) }}" class="px-5 py-1.5 border border-gray-200 text-gray-500 rounded-full text-xs font-semibold hover:border-[#0074A6] hover:text-[#0074A6] hover:bg-blue-50 transition inline-block">Kelola</a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="py-8 text-center text-gray-400 text-sm font-medium">
                                        Belum ada pesanan terbaru hari ini.
                                    </td>
                                </tr>
                            @endforelse
<<<<<<< HEAD

=======
>>>>>>> 1aa579cc41edae45803d9ea51980ca0d1dde8be7
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    
        {{-- KODE MODAL POP-UP TAMBAH LAYANAN --}}
        <div x-show="modalTambahLayanan" style="display: none;" class="fixed inset-0 z-[100] flex items-center justify-center bg-slate-900/70 backdrop-blur-sm transition-opacity">
            <div @click.outside="modalTambahLayanan = false" class="bg-white p-8 rounded-3xl shadow-2xl max-w-md w-full relative transform scale-100 transition-transform">
                
<<<<<<< HEAD
                {{-- Tombol Close X --}}
=======
>>>>>>> 1aa579cc41edae45803d9ea51980ca0d1dde8be7
                <button @click="modalTambahLayanan = false" class="absolute top-4 right-4 bg-gray-100 text-gray-500 w-8 h-8 rounded-full flex items-center justify-center hover:bg-red-100 hover:text-red-500 transition font-bold">
                    <i class="fas fa-times"></i>
                </button>
                
                <h2 class="text-xl font-black text-[#1D5D8A] mb-2"><i class="fas fa-plus-circle mr-2"></i>Tambah Layanan</h2>
                <p class="text-xs text-gray-500 mb-6 font-medium">Masukkan nama layanan baru beserta tarif per kilogramnya.</p>

<<<<<<< HEAD
                {{-- Form Kirim Data ke Controller --}}
                <form action="{{ route('admin.layanan.store') }}" method="POST">
                    @csrf
                    
                    <div class="space-y-5">
                        {{-- Input Nama Layanan --}}
=======
                <form action="{{ route('admin.layanan.store') }}" method="POST">
                    @csrf
                    <div class="space-y-5">
>>>>>>> 1aa579cc41edae45803d9ea51980ca0d1dde8be7
                        <div>
                            <label class="block text-[11px] font-bold text-gray-500 mb-2">Nama Layanan</label>
                            <div class="bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 flex items-center focus-within:ring-2 focus-within:ring-[#1D5D8A] transition">
                                <i class="fas fa-tag text-gray-400 mr-3"></i>
                                <input type="text" name="nama_layanan" placeholder="Misal: Cuci Karpet" required class="bg-transparent border-none w-full text-sm font-semibold text-gray-700 focus:outline-none p-0 m-0">
                            </div>
                        </div>

<<<<<<< HEAD
                        {{-- Input Harga per KG --}}
=======
>>>>>>> 1aa579cc41edae45803d9ea51980ca0d1dde8be7
                        <div>
                            <label class="block text-[11px] font-bold text-gray-500 mb-2">Harga (per kg / pcs)</label>
                            <div class="bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 flex items-center focus-within:ring-2 focus-within:ring-[#1D5D8A] transition">
                                <span class="text-gray-400 font-bold mr-2 text-sm">Rp</span>
                                <input type="number" name="harga_per_kg" placeholder="15000" required class="bg-transparent border-none w-full text-sm font-bold text-gray-700 focus:outline-none p-0 m-0">
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="w-full text-white py-3.5 mt-8 rounded-2xl text-sm font-bold shadow-lg transition active:scale-95 flex items-center justify-center gap-2 hover:opacity-90" style="background-color: #005B82;">
                        <i class="fas fa-save"></i> Simpan Layanan Baru
                    </button>
                </form>

            </div>
        </div>
<<<<<<< HEAD
=======

        <div x-show="modalTambahPesananManual" style="display: none;" class="fixed inset-0 z-[100] flex items-center justify-center bg-slate-900/70 backdrop-blur-sm transition-opacity">
            <div @click.outside="modalTambahPesananManual = false" class="bg-white p-8 rounded-3xl shadow-2xl max-w-lg w-full relative transform scale-100 transition-transform">
                <button @click="modalTambahPesananManual = false" class="absolute top-4 right-4 bg-gray-100 text-gray-500 w-8 h-8 rounded-full flex items-center justify-center hover:bg-red-100 hover:text-red-500 transition font-bold">
                    <i class="fas fa-times"></i>
                </button>

                <h2 class="text-xl font-black text-[#1D5D8A] mb-2"><i class="fas fa-shopping-cart mr-2"></i>Tambah Pesanan Manual</h2>
                <p class="text-xs text-gray-500 mb-6 font-medium">Isi data pelanggan dan layanan untuk membuat pesanan langsung dari dashboard admin.</p>

                <form action="{{ route('admin.pesanan.store') }}" method="POST" class="space-y-5">
                    @csrf
                    <div class="grid grid-cols-1 gap-4">
                        <div>
                            <label class="block text-[11px] font-bold text-gray-500 mb-2">Nama Pelanggan</label>
                            <input type="text" name="nama_pelanggan" placeholder="Misal: Budi Santoso" required class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-sm font-semibold text-gray-700 focus:outline-none focus:ring-2 focus:ring-[#1D5D8A] transition" value="{{ old('nama_pelanggan') }}">
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-[11px] font-bold text-gray-500 mb-2">Email Pelanggan</label>
                                <input type="email" name="email" placeholder="email@example.com" required class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-sm font-semibold text-gray-700 focus:outline-none focus:ring-2 focus:ring-[#1D5D8A] transition" value="{{ old('email') }}">
                            </div>
                            <div>
                                <label class="block text-[11px] font-bold text-gray-500 mb-2">No. HP</label>
                                <input type="text" name="no_hp" placeholder="0812xxxx" required class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-sm font-semibold text-gray-700 focus:outline-none focus:ring-2 focus:ring-[#1D5D8A] transition" value="{{ old('no_hp') }}">
                            </div>
                        </div>
                        <div>
                            <label class="block text-[11px] font-bold text-gray-500 mb-2">Alamat Pengambilan</label>
                            <textarea name="alamat" rows="3" placeholder="Jl. Contoh No. 1, Jakarta" required class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-sm font-semibold text-gray-700 focus:outline-none focus:ring-2 focus:ring-[#1D5D8A] transition">{{ old('alamat') }}</textarea>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-[11px] font-bold text-gray-500 mb-2">Jenis Layanan</label>
                                <select name="id_layanan" required class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-sm font-semibold text-gray-700 focus:outline-none focus:ring-2 focus:ring-[#1D5D8A] transition">
                                    <option value="" disabled selected>Pilih layanan</option>
                                    @foreach($daftar_layanan as $layanan)
                                        <option value="{{ $layanan->id_layanan }}" {{ old('id_layanan') == $layanan->id_layanan ? 'selected' : '' }}>{{ $layanan->nama_layanan }} - Rp {{ number_format($layanan->harga_per_kg, 0, ',', '.') }}/kg</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label class="block text-[11px] font-bold text-gray-500 mb-2">Berat (kg)</label>
                                <input type="number" step="0.1" name="berat" placeholder="1.5" required class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-sm font-semibold text-gray-700 focus:outline-none focus:ring-2 focus:ring-[#1D5D8A] transition" value="{{ old('berat') }}">
                            </div>
                        </div>
                        <div>
                            <label class="block text-[11px] font-bold text-gray-500 mb-2">Catatan (opsional)</label>
                            <textarea name="catatan" rows="2" placeholder="Contoh: jemput sore ini" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-sm font-semibold text-gray-700 focus:outline-none focus:ring-2 focus:ring-[#1D5D8A] transition">{{ old('catatan') }}</textarea>
                        </div>
                    </div>

                    <button type="submit" class="w-full text-white py-3.5 rounded-2xl text-sm font-bold shadow-lg transition active:scale-95 flex items-center justify-center gap-2 hover:opacity-90" style="background-color: #005B82;">
                        <i class="fas fa-save"></i> Simpan Pesanan Manual
                    </button>
                </form>
            </div>
        </div>
>>>>>>> 1aa579cc41edae45803d9ea51980ca0d1dde8be7
    </main>

</body>
</html>