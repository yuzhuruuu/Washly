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
            
            {{-- MENU KELOLA PESANAN (Aktif) --}}
            <a href="{{ url('/dashboard/admin/pesanan') }}" class="flex items-center gap-3 px-4 py-3 bg-blue-50 text-[#0074A6] rounded-xl font-bold text-sm transition">
                <i class="fas fa-clipboard-list w-5 text-center"></i> Kelola Pesanan
            </a>
            
            <a href="{{ url('/dashboard/admin/pembayaran') }}" class="flex items-center gap-3 px-4 py-3 text-gray-500 hover:bg-gray-50 hover:text-[#0074A6] rounded-xl font-medium text-sm transition group">
                <i class="fas fa-wallet w-5 text-center text-gray-400 group-hover:text-[#0074A6] transition"></i> Pembayaran
            </a>
            <a href="{{ url('/dashboard/admin/kurir') }}" class="flex items-center gap-3 px-4 py-3 text-gray-500 hover:bg-gray-50 hover:text-[#0074A6] rounded-xl font-medium text-sm transition group">
                <i class="fas fa-motorcycle w-5 text-center text-gray-400 group-hover:text-[#0074A6] transition"></i> Kurir
            </a>
            <a href="{{ url('/dashboard/admin/riwayat') }}" class="flex items-center gap-3 px-4 py-3 text-gray-500 hover:bg-gray-50 hover:text-[#0074A6] rounded-xl font-medium text-sm transition group">
                <i class="fas fa-history w-5 text-center text-gray-400 group-hover:text-[#0074A6] transition"></i> Riwayat Admin
            </a>
            <a href="{{ url('/dashboard/admin/pengaturan') }}" class="flex items-center gap-3 px-4 py-3 text-gray-500 hover:bg-gray-50 hover:text-[#0074A6] rounded-xl font-medium text-sm transition group">
                <i class="fas fa-cog w-5 text-center text-gray-400 group-hover:text-[#0074A6] transition"></i> Pengaturan
            </a>
            <form action="{{ route('logout') }}" method="POST" class="block w-full">
                @csrf
                <button type="submit" class="w-full flex items-center gap-3 px-4 py-3 text-red-500 hover:bg-red-50 rounded-xl font-medium text-sm transition group cursor-pointer">
                    <i class="fas fa-sign-out-alt w-5 text-center text-red-400 group-hover:text-red-600 transition"></i> Keluar Akun
                </button>
            </form>
        </nav>

        {{-- Tombol Tambah Layanan --}}
        <div class="p-5 mt-auto">
            <button class="w-full bg-[#005B82] hover:bg-[#004B6D] text-white py-3 rounded-xl text-sm font-bold shadow-md transition active:scale-95 flex items-center justify-center gap-2">
                <i class="fas fa-plus"></i> Tambah Layanan
            </button>
        </div>
    </aside>

    {{-- KONTEN UTAMA --}}
    <main class="flex-1 p-10 overflow-y-auto">
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-2xl font-bold text-gray-800">Kelola Pesanan</h1>
            
            {{-- Flash Alert Sukses Berhasil Update Data --}}
            @if(session('success'))
                <div class="bg-green-100 border border-green-200 text-green-700 px-4 py-2 rounded-xl text-xs font-bold shadow-sm">
                    ✨ {{ session('success') }}
                </div>
            @endif
        </div>

        {{-- GRID LIST PESANAN REAL-TIME DARI DATABASE --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            
            @forelse($semua_pesanan ?? [] as $p)
                <div class="bg-white p-6 rounded-3xl border border-gray-100 shadow-sm hover:shadow-md transition">
                    <div class="flex justify-between items-start mb-4">
                        <span class="text-[10px] font-bold text-gray-400 uppercase tracking-wide">WS-{{ $p->id_pesanan }}</span>
                        
                        {{-- Logika Badge Pewarnaan Status Dinamis Biar Keren --}}
                        @php
                            $badgeColor = 'bg-gray-100 text-gray-600';
                            if(in_array($p->status, ['menunggu_pickup', 'menunggu_timbang'])) {
                                $badgeColor = 'bg-orange-100 text-orange-600';
                            } elseif(in_array($p->status, ['menunggu_bayar', 'menunggu_konfirmasi'])) {
                                $badgeColor = 'bg-blue-100 text-blue-600';
                            } elseif($p->status == 'proses') {
                                $badgeColor = 'bg-purple-100 text-purple-600';
                            } elseif($p->status == 'delivery') {
                                $badgeColor = 'bg-cyan-100 text-cyan-600';
                            } elseif($p->status == 'selesai') {
                                $badgeColor = 'bg-green-100 text-green-600';
                            }
                        @endphp
                        <span class="{{ $badgeColor }} text-[10px] font-black px-3 py-1 rounded-full uppercase tracking-tight">
                            {{ str_replace('_', ' ', $p->status) }}
                        </span>
                    </div>

                    <div class="flex items-center gap-4 mb-5">
                        {{-- Avatar Inisial Huruf Depan Pelanggan --}}
                        <div class="w-12 h-12 rounded-full bg-blue-50 border border-blue-100 flex items-center justify-center font-black text-lg text-[#0074A6]">
                            {{ strtoupper(substr($p->pelanggan->nama ?? 'U', 0, 1)) }}
                        </div>
                        <div>
                            <h3 class="font-bold text-gray-800 leading-tight">{{ $p->pelanggan->nama ?? 'User Washly' }}</h3>
                            <p class="text-xs text-gray-500 font-medium mt-0.5"><i class="fab fa-whatsapp text-green-500 mr-0.5"></i> {{ $p->pelanggan->no_hp ?? '-' }}</p>
                        </div>
                    </div>

                    <div class="mb-5 text-xs text-gray-500 font-medium space-y-1 bg-gray-50 p-3 rounded-2xl border border-gray-50">
                        <p><span class="text-gray-400">Layanan:</span> <span class="font-bold text-gray-700">{{ $p->layanan->nama_layanan ?? '-' }}</span></p>
                        <p><span class="text-gray-400">Berat:</span> <span class="font-bold text-gray-700">{{ $p->berat ?? '0' }} Kg</span></p>
                        <p><span class="text-gray-400">Total:</span> <span class="font-bold text-green-600">Rp {{ number_format($p->total_harga ?? 0, 0, ',', '.') }}</span></p>
                    </div>

                    {{-- Link diarahkan ke Halaman Detail Bawaan Rute Laravel Baru --}}
                    <a href="{{ route('admin.pesanan.detail', $p->id_pesanan) }}" class="block w-full bg-gray-100 hover:bg-[#0074A6] hover:text-white text-center py-3 rounded-xl text-sm font-bold transition">
                        Detail & Update
                    </a>
                </div>
            @empty
                {{-- Tampilan Kalau Database Masih Bersih Gaada Pesanan --}}
                <div class="col-span-full py-20 text-center border-2 border-dashed border-gray-200 rounded-3xl bg-white">
                    <div class="w-16 h-16 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-4 text-gray-400">
                        <i class="fas fa-box-open text-2xl"></i>
                    </div>
                    <p class="text-sm font-bold text-gray-500">Belum ada pesanan masuk ege.</p>
                    <p class="text-xs text-gray-400 mt-1">Data orderan laundry dari user akan otomatis parkir di sini.</p>
                </div>
            @endforelse

        </div>
    </main>
</body>
</html>