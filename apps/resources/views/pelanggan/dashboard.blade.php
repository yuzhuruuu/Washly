<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Pelanggan - Washly</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-[#F8FAFC] min-h-screen font-sans text-slate-800 pb-12">

    {{-- NAVBAR --}}
    <nav class="bg-white border-b border-gray-100 shadow-sm sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center relative">
            <div class="flex items-center">
                <img src="{{ asset('images/w-g.svg') }}" alt="Washly" class="h-8">
            </div>

            <div class="hidden md:flex space-x-10 text-sm font-semibold absolute left-1/2 -translate-x-1/2">
                <a href="{{ route('pelanggan.dashboard') }}" class="text-[#0074A6] border-b-2 border-[#0074A6] pb-1">Beranda</a>
                <a href="{{ route('pelanggan.pesanan.baru') }}" class="text-gray-400 hover:text-gray-600 transition">Layanan</a>
                <a href="{{ route('pelanggan.riwayat') }}" class="text-gray-400 hover:text-gray-600 transition">Riwayat</a>
                <a href="{{ route('pelanggan.tentang-kami') }}" class="text-gray-400 hover:text-gray-600 transition">Tentang Kami</a>
            </div>

            <div class="flex items-center space-x-5">
                <span class="text-sm text-gray-500 font-medium">Halo, {{ Auth::guard('pelanggan')->user()?->nama ?? 'Pelanggan' }}!</span>
                <div class="w-8 h-8 rounded-full bg-blue-50 overflow-hidden border border-blue-200">
                    <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::guard('pelanggan')->user()?->nama ?? 'User') }}&background=0074A6&color=fff&bold=true" alt="Avatar" class="w-full h-full object-cover">
                </div>
                <form action="{{ route('logout') }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="text-red-400 hover:text-red-600 text-xs font-bold pl-2 border-l border-gray-200 transition">
                        <i class="fas fa-sign-out-alt"></i>
                    </button>
                </form>
            </div>
        </div>
    </nav>

    {{-- KONTEN UTAMA --}}
    <main class="max-w-6xl mx-auto px-6 mt-8">
        
        {{-- HERO BANNER --}}
        <div class="bg-gradient-to-r from-[#005B82] to-[#0074A6] rounded-[2rem] p-10 flex justify-between items-center text-white relative overflow-hidden shadow-xl shadow-blue-900/10">
            <div class="relative z-10 max-w-lg">
                <h1 class="text-3xl font-bold mb-3">Mau laundry hari ini?</h1>
                <p class="text-sm text-blue-100 leading-relaxed mb-6 opacity-90">
                    Biar kami yang urus cucian kotormu. Santai saja di rumah, kami jemput dan antar kembali dengan wangi paripurna.
                </p>
                <a href="{{ route('pelanggan.pesanan.baru') }}" class="inline-flex bg-white text-[#0074A6] px-6 py-3 rounded-full text-sm font-bold items-center gap-2 hover:bg-gray-50 transition shadow-md active:scale-95">
                    <span class="text-[12px] font-bold">Pesan Sekarang</span>
                    <i class="fas fa-arrow-right ml-1"></i>
                </a>
            </div>
            <div class="absolute -right-6 top-1/2 -translate-y-1/2 opacity-20 pointer-events-none">
                <i class="fas fa-water text-[250px]"></i>
            </div>
        </div>

        {{-- SECTION LAYANAN --}}
        <div class="mt-12">
            <h2 class="text-xl font-bold text-gray-800 mb-6">Layanan Kami</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @forelse($daftar_layanan ?? [] as $layanan)
                    <div onclick="window.location.href='{{ route('pelanggan.pesanan.baru') }}'" class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 relative overflow-hidden group cursor-pointer hover:shadow-md transition">
                        <h3 class="font-bold text-gray-800 mb-1">{{ $layanan->nama_layanan }}</h3>
                        <span class="text-[#0074A6] text-[10px] font-bold px-2.5 py-1 rounded-md bg-blue-50">Rp {{ number_format($layanan->harga_per_kg, 0, ',', '.') }}/kg</span>
                    </div>
                @empty
                    <div class="col-span-full text-center text-gray-400">Belum ada layanan.</div>
                @endforelse
            </div>
        </div>

        {{-- PESANAN AKTIF --}}
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-10 mt-12">
            <div class="lg:col-span-2">
                <h2 class="text-xl font-bold text-gray-800 mb-6">Pesanan Aktif Kamu</h2>
                <div class="space-y-4">
                    @forelse($semua_pesanan ?? [] as $p)
                        <div onclick=\"window.location.href='{{ route('pelanggan.status') }}'\" class=\"bg-white rounded-xl p-4 flex items-center shadow-sm border border-gray-100 hover:shadow-md transition cursor-pointer\">
                            <div class="flex-1">
                                <p class="text-sm font-bold text-gray-800">WS-{{ $p->id_pesanan }}</p>
                                <p class="text-[10px] text-gray-400">{{ str_replace('_', ' ', $p->status) }}</p>
                            </div>
                            <p class="text-sm font-bold text-gray-800">Rp {{ number_format($p->total_harga ?? 0, 0, ',', '.') }}</p>
                        </div>
                    @empty
                        <div class="bg-white rounded-2xl p-8 text-center border border-dashed border-gray-200">
                            <p class="text-xs font-bold text-gray-500">Belum ada pesanan.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </main>
</body>
</html>