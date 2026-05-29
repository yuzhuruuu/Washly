<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bantuan - Washly</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-[#F8FAFC] min-h-screen font-sans text-slate-800 antialiased relative overflow-x-hidden">

    {{-- Background Glowing Blobs - Bikin estetik gak polos --}}
    <div class="absolute top-0 left-0 w-96 h-96 bg-blue-100 rounded-full blur-[120px] opacity-60 -translate-x-1/2 -translate-y-1/2 pointer-events-none z-0"></div>
    <div class="absolute bottom-0 right-0 w-[500px] h-[500px] bg-cyan-100 rounded-full blur-[150px] opacity-40 translate-x-1/3 translate-y-1/3 pointer-events-none z-0"></div>
    
    {{-- NAVBAR --}}
    <nav class="bg-white/80 backdrop-blur-md border-b border-gray-100 shadow-sm sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center relative">
            <div class="flex items-center"><img src="{{ asset('images/w-g.svg') }}" alt="Washly" class="h-8"></div>
            <div class="hidden md:flex space-x-10 text-sm font-semibold absolute left-1/2 -translate-x-1/2">
                <a href="{{ route('pelanggan.dashboard') }}" class="text-gray-400 hover:text-gray-600 transition">Beranda</a>
                <a href="{{ route('pelanggan.pesanan.baru') }}" class="text-gray-400 hover:text-gray-600 transition">Layanan</a>
                <a href="{{ route('pelanggan.riwayat') }}" class="text-gray-400 hover:text-gray-600 transition">Riwayat</a>
            </div>
             <div class="flex items-center space-x-5">
                <span class="text-sm text-gray-500 font-medium">Halo, {{ Auth::guard('pelanggan')->user()?->nama ?? 'Pelanggan' }}!</span>
                <a href="{{ route('pelanggan.notifikasi') }}" class="text-gray-400 hover:text-[#0074A6] transition"><i class="far fa-bell text-lg"></i></a>
                <a href="{{ route('pelanggan.bantuan') }}" class="text-gray-400 hover:text-[#0074A6] transition"><i class="far fa-question-circle text-lg"></i></a>
                <a href="{{ route('pelanggan.profil') }}" class="w-8 h-8 rounded-full bg-blue-50 overflow-hidden border border-blue-200 block">
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

    <main class="max-w-3xl mx-auto px-6 pt-8 pb-20 relative z-10">
        <div class="bg-white rounded-3xl p-6 shadow-sm border border-gray-100 mb-6 flex flex-col gap-4 md:flex-row md:items-center">
            <a href="{{ route('pelanggan.profil') }}" class="inline-flex items-center justify-center w-12 h-12 rounded-full bg-white shadow-md border border-gray-100 text-gray-600 hover:bg-gray-50">
                <i class="fas fa-arrow-left"></i>
            </a>
            <div>
                <h1 class="text-2xl font-bold">Pusat Bantuan</h1>
                <p class="text-sm text-gray-500">FAQ dan kontak CS langsung dari admin Washly.</p>
            </div>
        </div>

        <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 space-y-6">
            <section>
                <h2 class="font-bold text-lg mb-2">FAQ — Pertanyaan yang Sering Diajukan</h2>
                <div class="space-y-3">
                    <div>
                        <p class="font-semibold">1. Bagaimana cara memesan laundry?</p>
                        <p class="text-sm text-gray-600">Masuk ke halaman Layanan, pilih paket, masukkan alamat dan berat, lalu konfirmasi pesanan.</p>
                    </div>
                    <div>
                        <p class="font-semibold">2. Bagaimana cara melacak status pesanan?</p>
                        <p class="text-sm text-gray-600">Buka Riwayat pesanan di dashboard. Setiap pesanan menampilkan status terbaru.</p>
                    </div>
                    <div>
                        <p class="font-semibold">3. Bagaimana jika ada kerusakan/kehilangan?</p>
                        <p class="text-sm text-gray-600">Segera hubungi Customer Service melalui chat atau telepon. Sertakan nomor pesanan dan foto bukti.</p>
                    </div>
                    <div>
                        <p class="font-semibold">4. Metode pembayaran apa yang diterima?</p>
                        <p class="text-sm text-gray-600">Kami menerima transfer bank dan pembayaran melalui aplikasi mitra. Detail tersedia saat checkout.</p>
                    </div>
                </div>
            </section>

            <section>
                <h2 class="font-bold text-lg mb-2">Kontak Customer Service</h2>
                @if(isset($admins) && $admins->count())
                    <div class="grid sm:grid-cols-2 gap-4">
                        @foreach($admins as $admin)
                            <div class="bg-gray-50 p-4 rounded-lg">
                                <p class="text-sm text-gray-600">Petugas</p>
                                <p class="font-semibold text-gray-800 mt-1">{{ $admin->nama }}</p>
                                <p class="text-sm text-gray-600 mt-2">Email</p>
                                <p class="font-semibold text-gray-800 mt-1">{{ $admin->email }}</p>
                                @if(!empty($admin->phone) || !empty($admin->no_hp))
                                    <p class="text-sm text-gray-600 mt-2">Telepon</p>
                                    <p class="font-semibold text-gray-800 mt-1">{{ $admin->phone ?? $admin->no_hp }}</p>
                                @endif
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="p-4 bg-gray-50 rounded-lg text-gray-600">Kontak CS belum tersedia. Silakan cek kembali nanti.</div>
                @endif
                <p class="text-sm text-gray-500 mt-3">Jam operasional CS: Senin–Jumat 09:00–18:00</p>
            </section>
        </div>
    </main>
</body>
</html>