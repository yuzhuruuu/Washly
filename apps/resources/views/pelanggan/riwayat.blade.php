<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Pesanan - Washly</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="bg-[#F8FAFC] min-h-screen font-sans text-slate-800 pb-20 antialiased relative overflow-x-hidden">

    {{-- Background Glowing Blobs --}}
    <div class="absolute top-0 left-0 w-96 h-96 bg-blue-100/40 rounded-full blur-[100px] -translate-x-1/2 -translate-y-1/2 pointer-events-none z-0"></div>
    <div class="absolute top-1/3 right-0 w-[400px] h-[400px] bg-cyan-100/30 rounded-full blur-[100px] translate-x-1/3 pointer-events-none z-0"></div>

    {{-- NAVBAR --}}
    <nav class="bg-white border-b border-gray-100 shadow-sm sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center relative">
            <div class="flex items-center">
                <img src="{{ asset('images/w-g.svg') }}" alt="Washly" class="h-8">
            </div>

            <div class="hidden md:flex space-x-10 text-sm font-semibold absolute left-1/2 -translate-x-1/2">
                <a href="{{ route('pelanggan.dashboard') }}" class="text-gray-400 hover:text-gray-600 transition">Beranda</a>
                <a href="{{ route('pelanggan.pesanan.baru') }}" class="text-gray-400 hover:text-gray-600 transition">Layanan</a>
                <a href="{{ route('pelanggan.riwayat') }}" class="text-[#0074A6] border-b-2 border-[#0074A6] pb-1">Riwayat</a>
                <a href="{{ route('pelanggan.tentang-kami') }}" class="text-gray-400 hover:text-gray-600 transition">Tentang Kami</a>
            </div>

            <div class="flex items-center space-x-5">
                <span class="text-sm text-gray-500 font-medium">Halo, {{ Auth::guard('pelanggan')->user()?->nama ?? 'Pelanggan' }}!</span>
                <a href="{{ route('pelanggan.profil') }}" class="w-8 h-8 rounded-full bg-blue-50 overflow-hidden border border-blue-200 block hover:ring-2 hover:ring-[#00AEEF] hover:shadow-md transition-all cursor-pointer">
                    <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::guard('pelanggan')->user()?->nama ?? 'User') }}&background=0074A6&color=fff&bold=true" alt="Avatar" class="w-full h-full object-cover">
                </a>
                <form action="{{ route('logout') }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="text-red-400 hover:text-red-600 text-xs font-bold pl-2 border-l border-gray-200 transition">
                        <i class="fas fa-sign-out-alt"></i>
                    </button>
                </form>
            </div>
        </div>
    </nav>

    {{-- MAIN CONTENT (Dengan Alpine.js untuk Filter Tabs) --}}
    <main class="max-w-6xl mx-auto px-6 pt-12 relative z-10" x-data="{ activeTab: 'semua' }">
        
        {{-- Header Title }}
        <div class="mb-8">
            <h1 class="text-3xl font-black text-gray-800 mb-2">Riwayat Pesanan</h1>
            <p class="text-gray-500 text-sm">Lacak semua cucian bersihmu di sini.</p>
        </div>

        {{-- Filter Tabs (Udah Anti-Hilang) --}}
        <div class="flex flex-wrap gap-3 mb-10">
            <button @click="activeTab = 'semua'" 
                    class="px-6 py-2 rounded-full text-sm font-bold transition shadow-sm"
                    :class="activeTab === 'semua' ? 'bg-blue-500 text-white shadow-blue-200' : 'bg-gray-100 text-gray-500 hover:bg-gray-200'">
                Semua
            </button>
            <button @click="activeTab = 'menunggu'" 
                    class="px-6 py-2 rounded-full text-sm font-bold transition shadow-sm"
                    :class="activeTab === 'menunggu' ? 'bg-blue-500 text-white shadow-blue-200' : 'bg-gray-100 text-gray-500 hover:bg-gray-200'">
                Menunggu
            </button>
            <button @click="activeTab = 'diproses'" 
                    class="px-6 py-2 rounded-full text-sm font-bold transition shadow-sm"
                    :class="activeTab === 'diproses' ? 'bg-blue-500 text-white shadow-blue-200' : 'bg-gray-100 text-gray-500 hover:bg-gray-200'">
                Diproses
            </button>
            <button @click="activeTab = 'selesai'" 
                    class="px-6 py-2 rounded-full text-sm font-bold transition shadow-sm"
                    :class="activeTab === 'selesai' ? 'bg-blue-500 text-white shadow-blue-200' : 'bg-gray-100 text-gray-500 hover:bg-gray-200'">
                Selesai
            </button>
        </div>

        @php
            $statusGroups = [
                'menunggu' => ['menunggu_pickup', 'menunggu_timbang', 'menunggu_bayar', 'menunggu_konfirmasi'],
                'diproses' => ['proses', 'delivery'],
                'selesai' => ['selesai'],
            ];
        @endphp

        <div class="space-y-6">
            <div x-show="activeTab === 'semua'" x-transition.opacity>
                @if($semua_pesanan->isEmpty())
                    <div class="bg-white rounded-3xl p-10 text-center border border-dashed border-gray-200 text-gray-400">
                        Belum ada pesanan. Yuk pesan laundry sekarang.
                    </div>
                @else
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($semua_pesanan as $pesanan)
                            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-md transition">
                                <div class="p-6">
                                    <div class="flex justify-between items-start mb-4">
                                        <div>
                                            <p class="text-[10px] font-bold text-gray-400 uppercase tracking-wider">#WS-{{ $pesanan->id_pesanan }}</p>
                                            <h3 class="font-bold text-gray-800 text-sm mt-1">{{ $pesanan->layanan?->nama_layanan ?? 'Layanan Tidak Diketahui' }}</h3>
                                        </div>
                                        <span class="text-[10px] font-bold uppercase tracking-wider px-3 py-1 rounded-full {{ $pesanan->status == 'selesai' ? 'bg-green-100 text-green-700' : (in_array($pesanan->status, ['proses', 'delivery']) ? 'bg-orange-100 text-orange-700' : 'bg-blue-100 text-blue-700') }}">
                                            {{ str_replace('_', ' ', $pesanan->status) }}
                                        </span>
                                    </div>
                                    <div class="text-xs font-medium text-gray-500 space-y-1 mb-5">
                                        <p>{{ $pesanan->created_at?->format('d M Y • H:i') ?? '-' }}</p>
                                        <p>{{ $pesanan->berat ? number_format($pesanan->berat, 1, ',', '.') . ' kg' : 'Belum ditimbang' }}</p>
                                    </div>
                                    <div class="flex justify-between items-center border-t border-gray-100 pt-4">
                                        <div>
                                            <p class="text-[10px] uppercase tracking-widest text-gray-400">Total Biaya</p>
                                            <p class="text-lg font-black text-[#0074A6]">{{ $pesanan->total_harga > 0 ? 'Rp '.number_format($pesanan->total_harga, 0, ',', '.') : 'Tunggu ditimbang' }}</p>
                                        </div>
                                        <a href="{{ route('pelanggan.status', $pesanan->id_pesanan) }}" class="px-4 py-2 rounded-full bg-blue-50 text-blue-700 text-xs font-bold">Lihat</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

            <div x-show="activeTab === 'menunggu'" x-transition.opacity>
                @php $menungguPesanan = $semua_pesanan->whereIn('status', $statusGroups['menunggu']); @endphp
                @if($menungguPesanan->isEmpty())
                    <div class="bg-white rounded-3xl p-10 text-center border border-dashed border-gray-200 text-gray-400">
                        Tidak ada pesanan menunggu.
                    </div>
                @else
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($menungguPesanan as $pesanan)
                            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-md transition">
                                <div class="p-6">
                                    <div class="flex justify-between items-start mb-4">
                                        <div>
                                            <p class="text-[10px] font-bold text-gray-400 uppercase tracking-wider">#WS-{{ $pesanan->id_pesanan }}</p>
                                            <h3 class="font-bold text-gray-800 text-sm mt-1">{{ $pesanan->layanan?->nama_layanan ?? 'Layanan Tidak Diketahui' }}</h3>
                                        </div>
                                        <span class="text-[10px] font-bold uppercase tracking-wider px-3 py-1 rounded-full bg-blue-100 text-blue-700">
                                            {{ str_replace('_', ' ', $pesanan->status) }}
                                        </span>
                                    </div>
                                    <div class="text-xs font-medium text-gray-500 space-y-1 mb-5">
                                        <p>{{ $pesanan->created_at?->format('d M Y • H:i') ?? '-' }}</p>
                                        <p>{{ $pesanan->berat ? number_format($pesanan->berat, 1, ',', '.') . ' kg' : 'Belum ditimbang' }}</p>
                                    </div>
                                    <div class="flex justify-between items-center border-t border-gray-100 pt-4">
                                        <div>
                                            <p class="text-[10px] uppercase tracking-widest text-gray-400">Total Biaya</p>
                                            <p class="text-lg font-black text-[#0074A6]">{{ $pesanan->total_harga > 0 ? 'Rp '.number_format($pesanan->total_harga, 0, ',', '.') : 'Tunggu ditimbang' }}</p>
                                        </div>
                                        <a href="{{ route('pelanggan.status', $pesanan->id_pesanan) }}" class="px-4 py-2 rounded-full bg-blue-50 text-blue-700 text-xs font-bold">Lihat</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

            <div x-show="activeTab === 'diproses'" x-transition.opacity>
                @php $diprosesPesanan = $semua_pesanan->whereIn('status', $statusGroups['diproses']); @endphp
                @if($diprosesPesanan->isEmpty())
                    <div class="bg-white rounded-3xl p-10 text-center border border-dashed border-gray-200 text-gray-400">
                        Tidak ada pesanan dalam proses.
                    </div>
                @else
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($diprosesPesanan as $pesanan)
                            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-md transition">
                                <div class="p-6">
                                    <div class="flex justify-between items-start mb-4">
                                        <div>
                                            <p class="text-[10px] font-bold text-gray-400 uppercase tracking-wider">#WS-{{ $pesanan->id_pesanan }}</p>
                                            <h3 class="font-bold text-gray-800 text-sm mt-1">{{ $pesanan->layanan?->nama_layanan ?? 'Layanan Tidak Diketahui' }}</h3>
                                        </div>
                                        <span class="text-[10px] font-bold uppercase tracking-wider px-3 py-1 rounded-full bg-orange-100 text-orange-700">
                                            {{ str_replace('_', ' ', $pesanan->status) }}
                                        </span>
                                    </div>
                                    <div class="text-xs font-medium text-gray-500 space-y-1 mb-5">
                                        <p>{{ $pesanan->created_at?->format('d M Y • H:i') ?? '-' }}</p>
                                        <p>{{ $pesanan->berat ? number_format($pesanan->berat, 1, ',', '.') . ' kg' : 'Belum ditimbang' }}</p>
                                    </div>
                                    <div class="flex justify-between items-center border-t border-gray-100 pt-4">
                                        <div>
                                            <p class="text-[10px] uppercase tracking-widest text-gray-400">Total Biaya</p>
                                            <p class="text-lg font-black text-[#0074A6]">{{ $pesanan->total_harga > 0 ? 'Rp '.number_format($pesanan->total_harga, 0, ',', '.') : 'Tunggu ditimbang' }}</p>
                                        </div>
                                        <a href="{{ route('pelanggan.status', $pesanan->id_pesanan) }}" class="px-4 py-2 rounded-full bg-blue-50 text-blue-700 text-xs font-bold">Lihat</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

            <div x-show="activeTab === 'selesai'" x-transition.opacity>
                @php $selesaiPesanan = $semua_pesanan->where('status', 'selesai'); @endphp
                @if($selesaiPesanan->isEmpty())
                    <div class="bg-white rounded-3xl p-10 text-center border border-dashed border-gray-200 text-gray-400">
                        Belum ada pesanan selesai.
                    </div>
                @else
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($selesaiPesanan as $pesanan)
                            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-md transition">
                                <div class="p-6">
                                    <div class="flex justify-between items-start mb-4">
                                        <div>
                                            <p class="text-[10px] font-bold text-gray-400 uppercase tracking-wider">#WS-{{ $pesanan->id_pesanan }}</p>
                                            <h3 class="font-bold text-gray-800 text-sm mt-1">{{ $pesanan->layanan?->nama_layanan ?? 'Layanan Tidak Diketahui' }}</h3>
                                        </div>
                                        <span class="text-[10px] font-bold uppercase tracking-wider px-3 py-1 rounded-full bg-green-100 text-green-700">
                                            Selesai
                                        </span>
                                    </div>
                                    <div class="text-xs font-medium text-gray-500 space-y-1 mb-5">
                                        <p>{{ $pesanan->created_at?->format('d M Y • H:i') ?? '-' }}</p>
                                        <p>{{ $pesanan->berat ? number_format($pesanan->berat, 1, ',', '.') . ' kg' : 'Belum ditimbang' }}</p>
                                    </div>
                                    <div class="flex justify-between items-center border-t border-gray-100 pt-4">
                                        <div>
                                            <p class="text-[10px] uppercase tracking-widest text-gray-400">Total Biaya</p>
                                            <p class="text-lg font-black text-[#0074A6]">{{ $pesanan->total_harga > 0 ? 'Rp '.number_format($pesanan->total_harga, 0, ',', '.') : 'Tunggu ditimbang' }}</p>
                                        </div>
                                        <a href="{{ route('pelanggan.status', $pesanan->id_pesanan) }}" class="px-4 py-2 rounded-full bg-blue-50 text-blue-700 text-xs font-bold">Lihat</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </main>

</body>
</html>
