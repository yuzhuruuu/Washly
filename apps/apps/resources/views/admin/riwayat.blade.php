<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Pesanan - Washly Admin</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-[#F8FAFC] h-screen font-sans text-slate-800 flex overflow-hidden">

    {{-- SIDEBAR KONSISTEN --}}
    <aside x-data class="w-64 bg-white border-r border-gray-100 flex flex-col h-full shrink-0 relative z-20">
        <div class="p-6">
            <img src="{{ asset('images/w-a.svg') }}" alt="Washly Admin" class="h-8">
        </div>

        <div class="px-6 flex items-center gap-3 mb-8">
            <div class="w-10 h-10 rounded-full border border-gray-100 overflow-hidden shadow-sm">
                <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::guard('admin')->user()?->nama ?? Auth::guard('admin')->user()?->username ?? 'Admin') }}&background=00AEEF&color=fff" alt="Admin Profile" class="w-full h-full object-cover">
            </div>
            <div>
                <h3 class="font-bold text-sm text-gray-800 leading-tight truncate w-32" title="{{ Auth::guard('admin')->user()?->nama ?? Auth::guard('admin')->user()?->username ?? 'Admin' }}">
                    {{ Auth::guard('admin')->user()?->nama ?? Auth::guard('admin')->user()?->username ?? 'Admin' }}
                </h3>
                <p class="text-[10px] text-gray-500 font-medium mt-0.5">Panel Kendali Utama</p>
            </div>
        </div>

        <nav class="flex-1 px-4 space-y-1">
            <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-4 py-3 text-gray-500 hover:bg-gray-50 hover:text-[#0074A6] rounded-xl font-medium text-sm transition group">
                <i class="fas fa-th-large w-5 text-center text-gray-400 group-hover:text-[#0074A6] transition"></i> Dashboard
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
            
            {{-- MENU RIWAYAT ADMIN (Aktif) --}}
            <a href="{{ route('admin.riwayat') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl font-bold text-sm transition mb-1" style="background-color: #EFF6FF; color: #1D5D8A;">
                <i class="fas fa-history w-5 text-center"></i> Riwayat Admin
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

        {{-- TRIGGER MODAL --}}
        <div class="p-5 mt-auto">
            <button @click="$dispatch('buka-modal-layanan')" class="w-full text-white py-3 rounded-xl text-sm font-bold shadow-md transition active:scale-95 flex items-center justify-center gap-2 hover:opacity-90" style="background-color: #005B82;">
                <i class="fas fa-plus"></i> Tambah Layanan
            </button>
        </div>
    </aside>

    {{-- KONTEN UTAMA --}}
    <main class="flex-1 overflow-y-auto relative z-10" x-data="{ modalTambahLayanan: false, showFilterPanel: false }" @buka-modal-layanan.window="modalTambahLayanan = true">
        
        <div class="absolute top-0 right-0 w-[500px] h-[500px] bg-blue-50/50 rounded-full blur-[120px] pointer-events-none z-0"></div>

        <div class="p-10 max-w-6xl mx-auto relative z-10">
            
            <div class="flex justify-between items-center mb-8">
                <div>
                    <h1 class="text-3xl font-bold text-gray-800 mb-2">Riwayat Pesanan</h1>
                    <p class="text-sm text-gray-500 font-medium">Tinjau seluruh transaksi, analisis performa, dan unduh laporan operasional.</p>
                </div>
                <a href="{{ route('admin.riwayat.export', array_merge(request()->query(), ['export' => 'csv'])) }}" class="bg-white border border-gray-200 text-gray-600 px-6 py-2.5 rounded-full text-sm font-bold shadow-sm hover:bg-gray-50 transition flex items-center gap-2">
                    <i class="fas fa-download text-gray-400"></i> Export CSV
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <div class="bg-white p-6 rounded-3xl border border-gray-100 shadow-sm flex flex-col justify-between">
                    <div class="flex justify-between items-start mb-4">
                        <p class="text-[10px] font-bold text-gray-400 uppercase tracking-wider">Total Pesanan</p>
                        <div class="w-10 h-10 rounded-full bg-blue-50 text-blue-500 flex items-center justify-center">
                            <i class="fas fa-box text-sm"></i>
                        </div>
                    </div>
                    <div>
                        <h3 class="text-3xl font-black text-gray-800 mb-1">{{ number_format($totalPesanan ?? 0, 0, ',', '.') }}</h3>
                        <p class="text-xs font-bold text-teal-500 flex items-center gap-1"><i class="fas fa-check-circle"></i> Selesai Keseluruhan</p>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-3xl border border-gray-100 shadow-sm flex flex-col justify-between">
                    <div class="flex justify-between items-start mb-4">
                        <p class="text-[10px] font-bold text-gray-400 uppercase tracking-wider">Total Pendapatan</p>
                        <div class="w-10 h-10 rounded-full bg-cyan-50 text-cyan-500 flex items-center justify-center">
                            <i class="fas fa-wallet text-sm"></i>
                        </div>
                    </div>
                    <div>
                        <h3 class="text-3xl font-black text-gray-800 mb-1">Rp {{ number_format($totalPendapatan ?? 0, 0, ',', '.') }}</h3>
                        <p class="text-xs font-bold text-teal-500 flex items-center gap-1"><i class="fas fa-check-circle"></i> Omzet Bersih</p>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-3xl border border-gray-100 shadow-sm flex flex-col justify-between">
                    <div class="flex justify-between items-start mb-4">
                        <p class="text-[10px] font-bold text-gray-400 uppercase tracking-wider">Rata-Rata Berat</p>
                        <div class="w-10 h-10 rounded-full bg-orange-50 text-orange-500 flex items-center justify-center">
                            <i class="fas fa-weight-hanging text-sm"></i>
                        </div>
                    </div>
                    <div>
                        <h3 class="text-3xl font-black text-gray-800 mb-1">{{ number_format($rataBerat ?? 0, 1, ',', '.') }} <span class="text-lg text-gray-400 font-semibold">kg</span></h3>
                        <p class="text-xs font-bold text-gray-400 flex items-center gap-1"><i class="fas fa-minus"></i> Per Pesanan</p>
                    </div>
                </div>
            </div>

            <div class="flex flex-col md:flex-row gap-4 mb-4">
                <form action="{{ route('admin.riwayat') }}" method="GET" class="relative flex-1">
                    <i class="fas fa-search absolute left-6 top-1/2 -translate-y-1/2 text-slate-400"></i>
                    <input type="text" name="cari" value="{{ request('cari') }}" placeholder="Cari ID Pesanan atau Pelanggan..." class="w-full bg-white border border-slate-200 shadow-sm rounded-xl py-3.5 pl-12 pr-4 text-sm font-medium text-slate-700 focus:outline-none focus:border-[#1D5D8A] focus:ring-1 focus:ring-[#1D5D8A] transition">
                </form>
                
                <div class="flex gap-4">
                    <a href="{{ route('admin.riwayat', array_merge(request()->query(), ['bulan' => 'ini'])) }}" class="bg-white border border-slate-200 shadow-sm text-slate-600 px-6 py-3.5 rounded-xl text-sm font-bold hover:bg-slate-50 transition flex items-center gap-2 whitespace-nowrap">
                        <i class="far fa-calendar-alt text-slate-400"></i> Bulan Ini
                    </a>
                    <button type="button" @click="showFilterPanel = !showFilterPanel" class="bg-white border border-slate-200 shadow-sm text-slate-600 px-6 py-3.5 rounded-xl text-sm font-bold hover:bg-slate-50 transition flex items-center gap-2 whitespace-nowrap">
                        <i class="fas fa-filter text-slate-400"></i> Filter
                    </button>
                </div>
            </div>

            <div x-show="showFilterPanel" x-transition class="mb-8">
                <div class="bg-white border border-slate-200 rounded-3xl shadow-sm p-5">
                    <form action="{{ route('admin.riwayat') }}" method="GET" class="grid gap-4 md:grid-cols-3 items-end">
                        <input type="hidden" name="cari" value="{{ request('cari') }}">

                        <div>
                            <label for="filter_status" class="block text-[11px] font-bold text-gray-500 mb-2">Status Pesanan</label>
                            <select id="filter_status" name="filter_status" class="w-full bg-white border border-slate-200 rounded-xl py-3.5 px-4 text-sm font-medium text-slate-700 focus:outline-none focus:border-[#1D5D8A] focus:ring-1 focus:ring-[#1D5D8A] transition">
                                <option value="" {{ request('filter_status') ? '' : 'selected' }}>Semua Status</option>
                                <option value="Selesai" {{ request('filter_status') === 'Selesai' ? 'selected' : '' }}>Selesai</option>
                                <option value="Batal" {{ request('filter_status') === 'Batal' ? 'selected' : '' }}>Batal</option>
                                <option value="Dibatalkan" {{ request('filter_status') === 'Dibatalkan' ? 'selected' : '' }}>Dibatalkan</option>
                            </select>
                        </div>

                        <div>
                            <label for="bulan" class="block text-[11px] font-bold text-gray-500 mb-2">Rentang Waktu</label>
                            <select id="bulan" name="bulan" class="w-full bg-white border border-slate-200 rounded-xl py-3.5 px-4 text-sm font-medium text-slate-700 focus:outline-none focus:border-[#1D5D8A] focus:ring-1 focus:ring-[#1D5D8A] transition">
                                <option value="" {{ request('bulan') ? '' : 'selected' }}>Semua Bulan</option>
                                <option value="ini" {{ request('bulan') === 'ini' ? 'selected' : '' }}>Bulan Ini</option>
                            </select>
                        </div>

                        <div class="flex gap-2 justify-end md:justify-start">
                            <button type="submit" class="w-full md:w-auto bg-[#005B82] text-white px-6 py-3.5 rounded-xl text-sm font-bold hover:bg-[#004d69] transition">Terapkan</button>
                            <a href="{{ route('admin.riwayat') }}" class="w-full md:w-auto bg-white border border-slate-200 text-slate-600 px-6 py-3.5 rounded-xl text-sm font-bold hover:bg-slate-50 transition text-center">Reset</a>
                        </div>
                    </form>
                </div>
            </div>

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
                            @forelse($riwayatPesanan ?? [] as $pesanan)
                                @php
                                    $nama = $pesanan->pelanggan->nama ?? 'Unknown';
                                    $kata = explode(' ', $nama);
                                    $inisial = strtoupper(substr($kata[0], 0, 1) . (isset($kata[1]) ? substr($kata[1], 0, 1) : ''));
                                    
                                    $warna = ['bg-blue-100 text-blue-600', 'bg-cyan-100 text-cyan-600', 'bg-orange-100 text-orange-600', 'bg-indigo-100 text-indigo-500', 'bg-gray-200 text-gray-600'];
                                    $warnaPilih = $warna[crc32($nama) % count($warna)];
                                    
                                    $tglSelesai = $pesanan->updated_at ? \Carbon\Carbon::parse($pesanan->updated_at) : null;
                                @endphp

                                <tr class="border-b border-gray-50 hover:bg-gray-50/50 transition">
                                    <td class="py-4 px-6 font-bold text-[#1D5D8A]">
                                        #WS-{{ $pesanan->created_at ? $pesanan->created_at->format('Y') : date('Y') }}-{{ str_pad($pesanan->id_pesanan ?? $pesanan->id, 3, '0', STR_PAD_LEFT) }}
                                    </td>
                                    <td class="py-4 px-6 text-gray-600">
                                        <p>{{ $tglSelesai ? $tglSelesai->translatedFormat('d M Y,') : '-' }}</p>
                                        <p class="text-xs text-gray-400">{{ $tglSelesai ? $tglSelesai->format('H:i') : '-' }}</p>
                                    </td>
                                    <td class="py-4 px-6">
                                        <div class="flex items-center gap-3">
                                            <div class="w-8 h-8 rounded-full {{ $warnaPilih }} flex items-center justify-center font-bold text-xs shrink-0">{{ $inisial }}</div>
                                            <span class="text-gray-700">{{ $nama }}</span>
                                        </div>
                                    </td>
                                    <td class="py-4 px-6 text-gray-600">
                                        <p>{{ $pesanan->layanan->nama_layanan ?? 'N/A' }}</p>
                                        <p class="text-[10px] text-gray-400 font-bold">{{ number_format($pesanan->berat ?? 0, 1, ',', '.') }} kg</p>
                                    </td>
                                    <td class="py-4 px-6 text-right font-bold {{ in_array($pesanan->status, ['Batal', 'Dibatalkan']) ? 'text-gray-400 line-through' : 'text-gray-800' }}">
                                        Rp {{ number_format($pesanan->total_harga ?? 0, 0, ',', '.') }}
                                    </td>
                                    <td class="py-4 px-6 text-center">
                                        @if(in_array($pesanan->status, ['Batal', 'Dibatalkan', 'batal']))
                                            <span class="bg-red-50 text-red-500 px-4 py-1.5 rounded-full text-[10px] font-bold">Dibatalkan</span>
                                        @else
                                            <span class="bg-blue-50 text-blue-600 px-4 py-1.5 rounded-full text-[10px] font-bold">Selesai</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="py-10 text-center text-gray-400 text-sm font-medium">
                                        <i class="fas fa-box-open text-3xl mb-3 text-gray-300 block"></i>
                                        Belum ada riwayat pesanan.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                
                <div class="px-6 py-4 border-t border-gray-100 flex justify-between items-center bg-white">
                    <p class="text-xs text-gray-500 font-medium">
                        Menampilkan {{ isset($riwayatPesanan) && $riwayatPesanan->total() > 0 ? $riwayatPesanan->firstItem() . '-' . $riwayatPesanan->lastItem() : '0' }} dari {{ number_format($riwayatPesanan->total() ?? 0, 0, ',', '.') }} pesanan
                    </p>
                    
                    @if(isset($riwayatPesanan) && $riwayatPesanan->hasPages())
                        <div class="flex gap-1 items-center">
                            <a href="{{ $riwayatPesanan->previousPageUrl() }}" class="w-8 h-8 rounded-full flex items-center justify-center text-gray-400 hover:bg-gray-50 transition {{ $riwayatPesanan->onFirstPage() ? 'opacity-50 pointer-events-none' : '' }}">
                                <i class="fas fa-chevron-left text-xs"></i>
                            </a>
                            <button class="w-8 h-8 rounded-full text-white font-bold text-xs flex items-center justify-center shadow-sm" style="background-color: #005B82;">{{ $riwayatPesanan->currentPage() }}</button>
                            <a href="{{ $riwayatPesanan->nextPageUrl() }}" class="w-8 h-8 rounded-full flex items-center justify-center text-gray-400 hover:bg-gray-50 transition {{ !$riwayatPesanan->hasMorePages() ? 'opacity-50 pointer-events-none' : '' }}">
                                <i class="fas fa-chevron-right text-xs"></i>
                            </a>
                        </div>
                    @endif
                </div>
            </div>

        </div>

        {{-- 🔥 POP UP MODAL TAMBAH LAYANAN 🔥 --}}
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