<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran Admin - Washly</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-[#F8FAFC] h-screen font-sans text-slate-800 flex overflow-hidden">

    {{-- SIDEBAR KONSISTEN --}}
    <aside x-data class="w-64 bg-white border-r border-gray-100 flex flex-col h-full shrink-0 relative z-20">
        {{-- Logo --}}
        <div class="p-6">
            <img src="{{ asset('images/w-a.svg') }}" alt="Washly Admin" class="h-8">
        </div>

        {{-- Profil Admin --}}
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
            <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-4 py-3 text-gray-500 hover:bg-gray-50 hover:text-[#0074A6] rounded-xl font-medium text-sm transition group">
                <i class="fas fa-th-large w-5 text-center text-gray-400 group-hover:text-[#0074A6] transition"></i> Dashboard
            </a>
            <a href="{{ route('admin.pesanan.kelola') }}" class="flex items-center gap-3 px-4 py-3 text-gray-500 hover:bg-gray-50 hover:text-[#0074A6] rounded-xl font-medium text-sm transition group">
                <i class="fas fa-clipboard-list w-5 text-center text-gray-400 group-hover:text-[#0074A6] transition"></i> Kelola Pesanan
            </a>
            <a href="{{ route('admin.pembayaran') }}" class="flex items-center gap-3 px-4 py-3 bg-blue-50 text-[#0074A6] rounded-xl font-bold text-sm transition">
                <i class="fas fa-wallet w-5 text-center"></i> Pembayaran
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

        {{-- TRIGGER TAMBAH LAYANAN --}}
        <div class="p-5 mt-auto">
            <button @click="$dispatch('buka-modal-layanan')" class="w-full bg-[#005B82] hover:bg-[#004B6D] text-white py-3 rounded-xl text-sm font-bold shadow-md transition active:scale-95 flex items-center justify-center gap-2">
                <i class="fas fa-plus"></i> Tambah Layanan
            </button>
        </div>
    </aside>

    {{-- KONTEN UTAMA --}}
    {{-- 🔥 TAMBAH STATE ALPINE.JS --}}
    <main class="flex-1 p-10 overflow-y-auto relative z-10" x-data="{ filter: 'belum', modalOpen: false, imageSrc: '', modalTambahLayanan: false }" @buka-modal-layanan.window="modalTambahLayanan = true">
        <div class="absolute bottom-0 left-0 w-96 h-96 bg-cyan-100/30 rounded-full blur-[120px] pointer-events-none z-0"></div>

        <div class="max-w-5xl mx-auto relative z-10">
            
            <div class="flex justify-between items-start mb-8">
                <div>
                    <h1 class="text-2xl font-bold text-gray-800 mb-1">Konfirmasi Pembayaran</h1>
                    <p class="text-sm text-gray-500 font-medium">Tinjau dan verifikasi bukti transfer dari pelanggan.</p>
                </div>
                
                @if(session('success'))
                    <div class="bg-green-50 border border-green-200 text-green-600 px-4 py-2 rounded-xl text-xs font-bold shadow-sm">
                        <i class="fas fa-check-circle mr-1"></i> {{ session('success') }}
                    </div>
                @endif
            </div>

            <div class="flex flex-wrap gap-3 mb-8">
                <button @click="filter = 'semua'" :class="filter === 'semua' ? 'bg-[#0074A6] text-white' : 'bg-gray-200 text-gray-600 hover:bg-gray-300'" class="px-5 py-2 rounded-full text-xs font-bold transition">Semua</button>
                <button @click="filter = 'belum'" :class="filter === 'belum' ? 'bg-[#0074A6] text-white shadow-md' : 'bg-gray-200 text-gray-600 hover:bg-gray-300'" class="px-5 py-2 rounded-full text-xs font-bold transition">Belum Dikonfirmasi</button>
                <button @click="filter = 'dikonfirmasi'" :class="filter === 'dikonfirmasi' ? 'bg-[#0074A6] text-white shadow-md' : 'bg-gray-200 text-gray-600 hover:bg-gray-300'" class="px-5 py-2 rounded-full text-xs font-bold transition">Dikonfirmasi</button>
                <button @click="filter = 'ditolak'" :class="filter === 'ditolak' ? 'bg-[#0074A6] text-white shadow-md' : 'bg-gray-200 text-gray-600 hover:bg-gray-300'" class="px-5 py-2 rounded-full text-xs font-bold transition">Ditolak</button>
            </div>

            <div class="space-y-4">
                
                    @forelse($pesananList ?? [] as $pesanan)
                    @php
                        $nama = $pesanan->pelanggan->nama ?? 'Unknown';
                        $kata = explode(' ', $nama);
                        $inisial = strtoupper(substr($kata[0], 0, 1) . (isset($kata[1]) ? substr($kata[1], 0, 1) : ''));
                        
                        $warna = ['bg-blue-100 text-[#0074A6]', 'bg-cyan-100 text-cyan-600', 'bg-orange-100 text-orange-600', 'bg-indigo-100 text-indigo-500', 'bg-pink-100 text-pink-500'];
                        $warnaPilih = $warna[crc32($nama) % count($warna)];

                        $kategoriFilter = $pesanan->status_pembayaran ?? 'belum'; 
                        
                        if ($kategoriFilter === 'dikonfirmasi') {
                            $statusLabel = 'Dikonfirmasi';
                        } elseif ($kategoriFilter === 'ditolak') {
                            $statusLabel = 'Ditolak';
                        } else {
                            $statusLabel = 'Menunggu Konfirmasi';
                        }

                        $metode = $pesanan->metode_pembayaran ?? 'Transfer';
                        $iconMetode = (stripos($metode, 'gopay') !== false || stripos($metode, 'ovo') !== false || stripos($metode, 'dana') !== false) ? 'fa-wallet' : 'fa-university';

                        $buktiLink = $pesanan->bukti_bayar ? asset('storage/' . str_replace('public/', '', $pesanan->bukti_bayar)) : '#';
                    @endphp

                    <div x-show="filter === 'semua' || filter === '{{ $kategoriFilter }}'" class="bg-white px-6 py-4 rounded-2xl shadow-sm border border-gray-100 flex items-center justify-between hover:shadow-md transition gap-4">
                        
                        <div class="flex items-center gap-4 w-[200px] shrink-0">
                            <div class="w-10 h-10 rounded-full {{ $warnaPilih }} flex items-center justify-center text-lg font-bold shrink-0">{{ $inisial }}</div>
                            <div>
                                <h3 class="font-bold text-gray-800 text-sm whitespace-nowrap truncate w-[140px]" title="{{ $nama }}">{{ $nama }}</h3>
                                <p class="text-[9px] font-bold text-gray-400 mt-0.5 uppercase tracking-wider whitespace-nowrap"># WS-{{ date('Y') }}-{{ str_pad($pesanan->id_pesanan ?? $pesanan->id, 3, '0', STR_PAD_LEFT) }}</p>
                            </div>
                        </div>

                        <div class="flex-1 flex justify-center overflow-x-auto no-scrollbar">
                            <div class="bg-slate-50 border border-slate-100 rounded-full py-2 px-6 flex items-center justify-between gap-8 min-w-[300px]">
                                <div>
                                    <p class="text-[9px] font-bold text-gray-400 uppercase tracking-wider mb-0.5">Nominal</p>
                                    <p class="text-sm font-black text-[#0074A6] whitespace-nowrap">Rp {{ number_format($pesanan->total_harga ?? 0, 0, ',', '.') }}</p>
                                </div>
                                <div>
                                    <p class="text-[9px] font-bold text-gray-400 uppercase tracking-wider mb-0.5">Metode</p>
                                    <div class="flex items-center gap-2 text-gray-700 font-semibold text-xs whitespace-nowrap">
                                        <i class="fas {{ $iconMetode }} text-[#0074A6]"></i> {{ $metode }}
                                    </div>
                                </div>
                                
                                <button type="button" @click="modalOpen = true; imageSrc = '{{ $buktiLink }}'" title="Lihat Bukti Transfer" class="w-9 h-9 bg-[#C5E1E1] rounded-lg flex items-center justify-center text-teal-800 cursor-pointer hover:opacity-80 transition shadow-sm shrink-0">
                                    <i class="fas fa-file-invoice text-sm"></i>
                                </button>
                            </div>
                        </div>

                        <div class="flex flex-col gap-2 w-24 shrink-0 justify-center">
                        @if($kategoriFilter === 'belum')
                            <form action="{{ route('admin.pesanan.update', $pesanan->id_pesanan ?? $pesanan->id) }}" method="POST" class="m-0 p-0">
                                @csrf
                                @method('PATCH')
                                <input type="hidden" name="status_pembayaran" value="Lunas"> 
                                <button type="submit" class="w-full bg-[#0074A6] hover:bg-[#005B82] text-white py-1.5 rounded-full text-[11px] font-bold transition shadow-sm cursor-pointer">Konfirmasi</button>
                            </form>

                            <form action="{{ route('admin.pesanan.update', $pesanan->id_pesanan ?? $pesanan->id) }}" method="POST" class="m-0 p-0">
                                @csrf
                                @method('PATCH')
                                <input type="hidden" name="status_pembayaran" value="Ditolak">
                                <button type="submit" class="w-full bg-red-100 hover:bg-red-200 text-red-600 py-1.5 rounded-full text-[11px] font-bold transition cursor-pointer">Tolak</button>
                            </form>
                        @else
                            <span class="w-full text-center py-1.5 rounded-full text-[11px] font-bold {{ $kategoriFilter === 'dikonfirmasi' ? 'bg-green-100 text-green-600' : 'bg-red-100 text-red-600' }}">
                                {{ $statusLabel }}
                            </span>
                        @endif
                        </div>
                    </div>
                @empty
                    <div class="bg-white px-6 py-10 rounded-2xl shadow-sm border border-gray-100 text-center flex flex-col items-center justify-center">
                        <div class="w-16 h-16 bg-gray-50 text-gray-300 rounded-full flex items-center justify-center text-3xl mb-4">
                            <i class="fas fa-inbox"></i>
                        </div>
                        <p class="text-gray-500 font-semibold">Belum ada data pembayaran yang masuk.</p>
                    </div>
                @endforelse

            </div>

        </div>

        {{-- ================= MODAL BUKTI PEMBAYARAN ================= --}}
        <div x-show="modalOpen" style="display: none;" class="fixed inset-0 z-[100] flex items-center justify-center bg-slate-900/70 backdrop-blur-sm transition-opacity">
            <div @click.outside="modalOpen = false" class="bg-white p-3 rounded-3xl shadow-2xl max-w-md w-full relative transform scale-100 transition-transform">
                <button @click="modalOpen = false" class="absolute -top-3 -right-3 bg-red-100 text-red-600 w-8 h-8 rounded-full shadow-md flex items-center justify-center hover:bg-red-200 transition font-bold">
                    <i class="fas fa-times"></i>
                </button>
                
                <div class="rounded-2xl overflow-hidden bg-slate-50 border border-slate-100 flex items-center justify-center min-h-[300px]">
                    <template x-if="imageSrc !== '#'">
                        <img :src="imageSrc" alt="Bukti Pembayaran" class="w-full h-auto object-contain max-h-[70vh]">
                    </template>
                    <template x-if="imageSrc === '#'">
                        <div class="text-center text-gray-400 p-10">
                            <i class="fas fa-image text-4xl mb-3 text-gray-300"></i>
                            <p class="text-sm font-medium">Bukti pembayaran tidak dilampirkan.</p>
                        </div>
                    </template>
                </div>
            </div>
        </div>

        {{-- 🔥 KODE MODAL POP-UP TAMBAH LAYANAN 🔥 --}}
        <div x-show="modalTambahLayanan" style="display: none;" class="fixed inset-0 z-[100] flex items-center justify-center bg-slate-900/70 backdrop-blur-sm transition-opacity">
            <div @click.outside="modalTambahLayanan = false" class="bg-white p-8 rounded-3xl shadow-2xl max-w-md w-full relative transform scale-100 transition-transform">
                
                <button @click="modalTambahLayanan = false" class="absolute top-4 right-4 bg-gray-100 text-gray-500 w-8 h-8 rounded-full flex items-center justify-center hover:bg-red-100 hover:text-red-500 transition font-bold">
                    <i class="fas fa-times"></i>
                </button>
                
                <h2 class="text-xl font-black text-[#1D5D8A] mb-2"><i class="fas fa-plus-circle mr-2"></i>Tambah Layanan</h2>
                <p class="text-xs text-gray-500 mb-6 font-medium">Masukkan nama layanan baru beserta tarif per kilogramnya.</p>

                <form action="{{ route('admin.layanan.store') }}" method="POST">
                    @csrf
                    <div class="space-y-5">
                        <div>
                            <label class="block text-[11px] font-bold text-gray-500 mb-2">Nama Layanan</label>
                            <div class="bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 flex items-center focus-within:ring-2 focus-within:ring-[#1D5D8A] transition">
                                <i class="fas fa-tag text-gray-400 mr-3"></i>
                                <input type="text" name="nama_layanan" placeholder="Misal: Cuci Karpet" required class="bg-transparent border-none w-full text-sm font-semibold text-gray-700 focus:outline-none p-0 m-0">
                            </div>
                        </div>

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

    </main>
</body>
</html>