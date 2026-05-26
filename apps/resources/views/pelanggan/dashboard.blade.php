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

    {{-- NAVBAR BARU (Tengah Mutlak Sempurna) --}}
    <nav class="bg-white border-b border-gray-100 shadow-sm sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center relative">
            
            {{-- Kiri: Logo --}}
            <div class="flex items-center">
                <img src="{{ asset('images/w-g.svg') }}" alt="Washly" class="h-8">
            </div>

            {{-- TENGAH MUTLAK: Menu Links --}}
            <div class="hidden md:flex space-x-10 text-sm font-semibold absolute left-1/2 -translate-x-1/2">
                <a href="{{ url('/dashboard/pelanggan') }}" class="text-[#0074A6] border-b-2 border-[#0074A6] pb-1">Beranda</a>
                <a href="{{ url('/dashboard/pelanggan/pesanan-baru') }}" class="text-gray-400 hover:text-gray-600 transition">Layanan</a>
                <a href="{{ url('/dashboard/pelanggan/riwayat') }}" class="text-gray-400 hover:text-gray-600 transition">Riwayat</a>
            </div>

            {{-- Kanan: Profil & Notif --}}
            <div class="flex items-center space-x-5">
                <span class="text-sm text-gray-500 font-medium">Halo, {{ Auth::guard('pelanggan')->user()?->nama ?? 'Pelanggan' }}!</span>
                <button class="text-[#0074A6] hover:text-blue-800"><i class="far fa-bell text-lg"></i></button>
                <div class="w-8 h-8 rounded-full bg-blue-50 overflow-hidden border border-blue-200">
                    <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::guard('pelanggan')->user()?->nama ?? 'User') }}&background=0074A6&color=fff&bold=true" alt="Avatar" class="w-full h-full object-cover">
                </div>
                
                {{-- Form Keluar Akun Pelanggan --}}
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
                    Biar kami yang urus cucian kotormu. Santai saja di rumah, kami jemput<br>dan antar kembali dengan wangi paripurna.
                </p>
                <a href="{{ url('/dashboard/pelanggan/pesanan-baru') }}" class="inline-flex bg-white text-[#0074A6] px-6 py-3 rounded-full text-sm font-bold items-center gap-2 hover:bg-gray-50 transition shadow-md active:scale-95">
                    <span class="text-[12px] font-bold">Pesan Sekarang</span>
                    <i class="fas fa-arrow-right ml-1"></i>
                </a>
            </div>
            <div class="absolute -right-6 top-1/2 -translate-y-1/2 opacity-20 pointer-events-none">
                <i class="fas fa-water text-[250px]"></i>
            </div>
        </div>

        {{-- SECTION: LAYANAN KAMI (Dibuat Dinamis Berdasarkan Data Database Kelompok) --}}
        <div class="mt-12">
            <h2 class="text-xl font-bold text-gray-800 mb-6">Layanan Kami</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                
                @forelse($daftar_layanan ?? [] as $layanan)
                    @php
                        // Menentukan dekorasi warna berdasarkan tipe layanan kelompok kamu
                        $cardBg = 'bg-[#F4F8FB]'; $iconBg = 'bg-blue-500'; $badgeBg = 'bg-[#EBF4FA]'; $badgeText = 'text-[#0074A6]'; $icon = 'fa-tshirt';
                        if (str_contains(strtolower($layanan->nama_layanan), 'setrika')) {
                            $cardBg = 'bg-[#F0FAF9]'; $iconBg = 'bg-[#38B2AC]'; $badgeBg = 'bg-[#E6F6F5]'; $badgeText = 'text-[#38B2AC]'; $icon = 'fa-iron';
                        } elseif (str_contains(strtolower($layanan->nama_layanan), 'premium') || str_contains(strtolower($layanan->nama_layanan), 'care')) {
                            $cardBg = 'bg-[#FCF6EE]'; $iconBg = 'bg-[#D97706]'; $badgeBg = 'bg-[#FDF3E7]'; $badgeText = 'text-[#D97706]'; $icon = 'fa-user-tie';
                        }
                    @endphp
                    <div onclick="window.location.href='{{ url('/dashboard/pelanggan/pesanan-baru') }}'" class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 relative overflow-hidden group cursor-pointer hover:shadow-md transition">
                        <div class="absolute top-0 right-0 w-32 h-32 {{ $cardBg }} rounded-bl-full -mr-10 -mt-10 transition-transform group-hover:scale-110"></div>
                        <div class="w-12 h-12 {{ $iconBg }} text-white rounded-full flex items-center justify-center text-xl mb-12 relative z-10 shadow-md">
                            <i class="fas {{ $icon }}"></i>
                        </div>
                        <h3 class="font-bold text-gray-800 mb-1 relative z-10">{{ $layanan->nama_layanan }}</h3>
                        <div class="flex justify-between items-end relative z-10">
                            <p class="text-xs text-gray-400">Tarif Proteksi</p>
                            <span class="{{ $badgeBg }} {{ $badgeText }} text-[10px] font-bold px-2.5 py-1 rounded-md">Rp {{ number_format($layanan->harga_per_kg, 0, ',', '.') }}/kg</span>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full bg-white p-6 rounded-2xl text-center text-gray-400 border border-dashed">
                        Belum ada jenis layanan terdaftar.
                    </div>
                @endforelse

            </div>
        </div>

        {{-- SECTION BAWAH: PESANAN & PROMO --}}
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-10 mt-12">
            
            {{-- Kiri: Pesanan Terbaru User Aktif --}}
            <div class="lg:col-span-2">
                <div class="flex justify-between items-end mb-6">
                    <h2 class="text-xl font-bold text-gray-800">Pesanan Aktif Kamu</h2>
                    <a href="{{ url('/dashboard/pelanggan/riwayat') }}" class="text-xs text-[#0074A6] hover:underline font-medium">
                        Lihat Semua Riwayat
                    </a>
                </div>

                <div class="space-y-4">
                    @forelse($semua_pesanan ?? [] as $p)
                        @php
                            // Pewarnaan garis pinggir kiri (border-l-4) dinamis berdasarkan status orderan
                            $borderLeft = 'border-l-[#D97706]'; $statusBg = 'bg-[#FDF3E7]'; $statusText = 'text-[#D97706]';
                            if (in_array($p->status, ['menunggu_bayar', 'menunggu_konfirmasi'])) {
                                $borderLeft = 'border-l-blue-500'; $statusBg = 'bg-blue-50'; $statusText = 'text-blue-600';
                            } elseif ($p->status == 'proses') {
                                $borderLeft = 'border-l-purple-500'; $statusBg = 'bg-purple-50'; $statusText = 'text-purple-600';
                            } elseif ($p->status == 'delivery') {
                                $borderLeft = 'border-l-cyan-500'; $statusBg = 'bg-cyan-50'; $statusText = 'text-cyan-600';
                            } elseif ($p->status == 'selesai') {
                                $borderLeft = 'border-l-green-500'; $statusBg = 'bg-green-50'; $statusText = 'text-green-600';
                            }
                        @endphp
                        
                        <div onclick="window.location.href='{{ url('/dashboard/pelanggan/status-pesanan') }}'" class="bg-white rounded-xl p-4 flex items-center shadow-sm border border-gray-100 border-l-4 {{ $borderLeft }} hover:shadow-md transition cursor-pointer">
                            <div class="w-10 h-10 bg-gray-100 rounded-full flex items-center justify-center text-gray-500 mr-4">
                                <i class="fas fa-file-invoice-dollar"></i>
                            </div>
                            <div class="flex-1">
                                <p class="text-sm font-bold text-gray-800">WS-{{ $p->id_pesanan }}</p>
                                <p class="text-[10px] text-gray-400">{{ $p->created_at->diffForHumans() }} | {{ $p->layanan->nama_layanan ?? '-' }}</p>
                            </div>
                            <div class="flex flex-col items-end gap-1">
                                <span class="{{ $statusBg }} {{ $statusText }} text-[9px] font-bold px-2.5 py-0.5 rounded-full flex items-center gap-1 uppercase tracking-wider">
                                    <span class="w-1.5 h-1.5 rounded-full bg-current"></span> {{ str_replace('_', ' ', $p->status) }}
                                </span>
                                <p class="text-sm font-bold text-gray-800">Rp {{ number_format($p->total_harga ?? 0, 0, ',', '.') }}</p>
                            </div>
                        </div>
                    @empty
                        <div class="bg-white rounded-2xl p-8 text-center border border-dashed border-gray-200">
                            <div class="w-12 h-12 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-3 text-gray-400">
                                <i class="fas fa-box-open text-xl"></i>
                            </div>
                            <p class="text-xs font-bold text-gray-500">Kamu belum memesan laundry.</p>
                            <p class="text-[10px] text-gray-400 mt-0.5">Baju kotormu numpuk? Klik tombol pesan di atas biar kurir jemput!</p>
                        </div>
                    @endforelse
                </div>
            </div>

            {{-- Kanan: Spesial Untukmu (Promo Statis Estetik bawaan FE) --}}
            <div class="lg:col-span-1" x-data="{ code: 'NEWWASH', copied: false }">
                <h2 class="text-xl font-bold text-gray-800 mb-6">Spesial Untukmu</h2>
                
                <div class="bg-gradient-to-br from-[#FDF3E7] via-[#F8EDF1] to-[#F1EEFC] rounded-2xl p-6 shadow-sm relative overflow-hidden">
                    <div class="w-8 h-8 bg-transparent border-2 border-[#5C3D2E] rounded flex items-center justify-center text-[#5C3D2E] mb-4">
                        <i class="fas fa-gift text-sm"></i>
                    </div>
                    
                    <h3 class="text-lg font-bold text-[#5C3D2E] mb-1">Diskon 20%</h3>
                    <p class="text-xs text-[#5C3D2E] leading-relaxed mb-5 opacity-90 pr-4">
                        Untuk Pelanggan Baru! Gunakan kode NEWWASH.
                    </p>
                    
                    <button 
                        @click="navigator.clipboard.writeText(code).then(() => { copied = true; setTimeout(() => copied = false, 1500); })"
                        :class="copied ? 'bg-green-600 hover:bg-green-700' : 'bg-[#5C3D2E] hover:bg-[#4A3125]'"
                        class="text-white text-[11px] font-bold px-5 py-2 rounded-full transition-all duration-300 shadow-md flex items-center gap-1.5"
                    >
                        <i :class="copied ? 'fas fa-check' : 'fas fa-copy'"></i>
                        <span x-text="copied ? 'Tersalin!' : 'Salin Kode'"></span>
                    </button>
                    
                    <div class="absolute -right-8 -bottom-8 w-32 h-32 bg-white opacity-10 rounded-full pointer-events-none"></div>
                </div>
            </div>

        </div>

    </main>

</body>
</html>