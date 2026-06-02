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
    <aside class="w-64 bg-white border-r border-gray-100 flex flex-col h-full shrink-0 relative z-20">
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

        <div class="p-5 mt-auto">
            <button @click="$dispatch('buka-modal-layanan')" class="w-full bg-[#005B82] hover:bg-[#004B6D] text-white py-3 rounded-xl text-sm font-bold shadow-md transition active:scale-95 flex items-center justify-center gap-2">
                <i class="fas fa-plus"></i> Tambah Layanan
            </button>
        </div>
    </aside>

    {{-- KONTEN UTAMA DENGAN TAMBAHAN STATE ALPINE BUAT MODAL --}}
    <main class="flex-1 p-10 overflow-y-auto relative z-10" x-data="{ filter: 'belum', modalOpen: false, imageSrc: '' }">
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

            <h2 class="text-lg font-bold text-gray-800 mb-4">
                <i class="fas fa-receipt mr-2"></i> Semua Pesanan & Pembayaran
            </h2>

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
                        } elseif ($pesanan->tipe_pesanan === 'manual' && in_array($pesanan->status, ['manual_menunggu_bayar', 'menunggu_bayar'])) {
                            $statusLabel = 'Menunggu Bayar';
                        } else {
                            $statusLabel = 'Menunggu Konfirmasi';
                        }

                        $metode = $pesanan->payment_method_label ?? 'Belum Bayar';
                        $iconMetode = 'fa-money-bill-wave';
                        if (stripos($metode, 'cash') !== false) {
                            $iconMetode = 'fa-money-bill';
                        } elseif (stripos($metode, 'qris') !== false) {
                            $iconMetode = 'fa-qrcode';
                        } elseif (stripos($metode, 'transfer') !== false) {
                            $iconMetode = 'fa-university';
                        } elseif (stripos($metode, 'ewalet') !== false) {
                            $iconMetode = 'fa-wallet';
                        }

                        $buktiLink = '#';
                        if (!empty($pesanan->pembayaran?->bukti_bayar)) {
                            $buktiLink = asset('storage/' . str_replace('public/', '', $pesanan->pembayaran->bukti_bayar));
                        } elseif (!empty($pesanan->bukti_bayar)) {
                            $buktiLink = asset('storage/' . str_replace('public/', '', $pesanan->bukti_bayar));
                        }
                    @endphp

                    <div x-show="filter === 'semua' || filter === '{{ $kategoriFilter }}'" class="bg-white px-6 py-4 rounded-2xl shadow-sm border border-gray-100 hover:shadow-md transition">
                        <div class="grid grid-cols-1 md:grid-cols-[minmax(250px,1fr)_auto] gap-4 items-center">
                            <div class="flex items-center gap-4">
                                <div class="w-10 h-10 rounded-full {{ $warnaPilih }} flex items-center justify-center text-lg font-bold shrink-0">{{ $inisial }}</div>
                                <div class="min-w-0">
                                    <h3 class="font-bold text-gray-800 text-sm truncate" title="{{ $nama }}">{{ $nama }}</h3>
                                    <p class="text-[10px] text-gray-500 uppercase tracking-[0.2em] mt-1"># WS-{{ date('Y') }}-{{ str_pad($pesanan->id_pesanan, 3, '0', STR_PAD_LEFT) }}</p>
                                    <div class="mt-2 flex flex-wrap gap-2 text-[10px] uppercase tracking-[0.14em] font-bold">
                                        <span class="px-2 py-1 rounded-full bg-slate-100 text-slate-600">{{ $pesanan->order_type_label ?? ($pesanan->tipe_pesanan === 'manual' ? 'Manual' : 'Regular') }}</span>
                                        <span class="px-2 py-1 rounded-full bg-blue-100 text-blue-700">{{ $pesanan->layanan->nama_layanan ?? 'Layanan' }}</span>
                                    </div>
                                </div>
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-3 gap-3 text-sm text-gray-700">
                                <div class="bg-slate-50 rounded-2xl p-3">
                                    <p class="text-[10px] text-gray-400 uppercase tracking-[0.18em]">Total</p>
                                    <p class="font-black text-gray-900">Rp {{ number_format($pesanan->total_harga ?? 0, 0, ',', '.') }}</p>
                                </div>
                                <div class="bg-slate-50 rounded-2xl p-3">
                                    <p class="text-[10px] text-gray-400 uppercase tracking-[0.18em]">Status</p>
                                    <p class="font-bold {{ $kategoriFilter === 'dikonfirmasi' ? 'text-green-700' : ($kategoriFilter === 'ditolak' ? 'text-red-600' : 'text-orange-600') }}">{{ $statusLabel }}</p>
                                </div>
                                <div class="bg-slate-50 rounded-2xl p-3">
                                    <p class="text-[10px] text-gray-400 uppercase tracking-[0.18em]">Metode</p>
                                    <p class="font-semibold text-gray-900 flex items-center gap-2"><i class="fas {{ $iconMetode }}"></i> {{ ucfirst($metode) }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="mt-4 flex flex-wrap gap-3 items-center justify-between">
                            <div class="text-[11px] text-gray-500">
                                <span class="font-bold">Berat:</span> {{ $pesanan->berat ?? 0 }} kg • <span class="font-bold">Status Pesanan:</span> {{ $pesanan->status }}
                            </div>

                            <div class="flex flex-wrap gap-2">
                                @if($pesanan->tipe_pesanan === 'manual' && in_array($pesanan->status, ['manual_menunggu_bayar', 'menunggu_bayar']))
                                    <div x-data="{ open: false }" class="relative">
                                        <button @click="open = true" class="bg-orange-500 hover:bg-orange-600 text-white px-4 py-2 rounded-full text-xs font-bold transition">Terima Bayar</button>
                                        <div x-show="open" style="display: none;" class="fixed inset-0 z-[100] flex items-center justify-center bg-slate-900/70 backdrop-blur-sm">
                                            <div @click.outside="open = false" class="bg-white p-6 rounded-2xl shadow-2xl max-w-xs w-full">
                                                <h3 class="text-lg font-bold text-gray-800 mb-4">Pilih Metode Pembayaran</h3>
                                                <form action="{{ route('admin.pembayaran.manual') }}" method="POST" class="space-y-3">
                                                    @csrf
                                                    <input type="hidden" name="id_pesanan" value="{{ $pesanan->id_pesanan }}">
                                                    <button type="submit" name="metode_pembayaran" value="cash" class="w-full bg-green-100 border-2 border-green-500 hover:bg-green-200 text-green-700 py-3 rounded-xl font-bold transition flex items-center justify-center gap-2">
                                                        <i class="fas fa-money-bill text-xl"></i> Tunai (Cash)
                                                    </button>
                                                    <button type="submit" name="metode_pembayaran" value="qris" class="w-full bg-blue-100 border-2 border-blue-500 hover:bg-blue-200 text-blue-700 py-3 rounded-xl font-bold transition flex items-center justify-center gap-2">
                                                        <i class="fas fa-qrcode text-xl"></i> QRIS
                                                    </button>
                                                    <button type="button" @click="open = false" class="w-full bg-gray-100 hover:bg-gray-200 text-gray-700 py-2 rounded-xl font-semibold transition">
                                                        Batal
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                @elseif($kategoriFilter === 'belum' && !in_array($pesanan->tipe_pesanan, ['manual']))
                                    <form action="{{ route('admin.pesanan.update', $pesanan->id_pesanan) }}" method="POST" class="inline-flex gap-2">
                                        @csrf
                                        @method('PATCH')
                                        <input type="hidden" name="status_pembayaran" value="Lunas">
                                        <button type="submit" class="bg-[#0074A6] hover:bg-[#005B82] text-white px-4 py-2 rounded-full text-xs font-bold transition">Konfirmasi</button>
                                    </form>
                                    <form action="{{ route('admin.pesanan.update', $pesanan->id_pesanan) }}" method="POST" class="inline-flex">
                                        @csrf
                                        @method('PATCH')
                                        <input type="hidden" name="status_pembayaran" value="Ditolak">
                                        <button type="submit" class="bg-red-100 hover:bg-red-200 text-red-600 px-4 py-2 rounded-full text-xs font-bold transition">Tolak</button>
                                    </form>
                                @endif
                            </div>
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

        {{-- ================= MODAL BUKTI PEMBAYARAN ALPINE.JS ================= --}}
        <div x-show="modalOpen" style="display: none;" class="fixed inset-0 z-[100] flex items-center justify-center bg-slate-900/70 backdrop-blur-sm transition-opacity">
            <div @click.outside="modalOpen = false" class="bg-white p-3 rounded-3xl shadow-2xl max-w-md w-full relative transform scale-100 transition-transform">
                
                {{-- Tombol Close --}}
                <button @click="modalOpen = false" class="absolute -top-3 -right-3 bg-red-100 text-red-600 w-8 h-8 rounded-full shadow-md flex items-center justify-center hover:bg-red-200 transition font-bold">
                    <i class="fas fa-times"></i>
                </button>
                
                {{-- Area Gambar Bukti --}}
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
        {{-- ================= END MODAL ================= --}}

    </main>
</body>
</html>