<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Saya - Washly</title>
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
                <a href="{{ url('/dashboard/pelanggan') }}" class="text-gray-400 hover:text-gray-600 transition">Beranda</a>
                <a href="{{ url('/layanan/pesan') }}" class="text-gray-400 hover:text-gray-600 transition">Layanan</a>
                <a href="#" class="text-gray-400 hover:text-gray-600 transition">Riwayat</a>
                <a href="#" class="text-gray-400 hover:text-gray-600 transition">Tentang Kami</a>
            </div>
            <div class="flex items-center space-x-5">
                <button class="text-[#0074A6]"><i class="far fa-bell text-lg"></i></button>
                <div class="w-8 h-8 rounded-full bg-[#0074A6] text-white flex items-center justify-center font-bold text-xs shadow-sm">
                    JB
                </div>
            </div>
        </div>
    </nav>

    {{-- MAIN CONTAINER (Jarak atas udah dilonggarin pakai pt-20) --}}
    <main class="max-w-5xl mx-auto px-6 pt-20 pb-20 relative z-10">

        {{-- HEADER PROFIL (Langsung dikasih mt-16 di sini biar turun menjauh dari navbar) --}}
        <div class="flex flex-col items-center mb-10 mt-16">
            <div class="relative w-28 h-28 mb-4">
                <div class="w-full h-full rounded-full border-4 border-white shadow-lg overflow-hidden bg-gray-200">
                    <img src="https://ui-avatars.com/api/?name=Justin+Bieber&background=0074A6&color=fff&size=150" alt="Profile" class="w-full h-full object-cover">
                </div>
                <button class="absolute bottom-0 right-0 bg-[#0074A6] w-8 h-8 rounded-full shadow-md flex items-center justify-center text-white border-2 border-white hover:bg-[#005B82] transition">
                    <i class="fas fa-pen text-[10px]"></i>
                </button>
            </div>
            <h2 class="text-2xl font-bold text-gray-800">Justin Bieber</h2>
            <p class="text-sm text-gray-500 mb-4">justinbieber@gmail.com</p>
            <button class="px-6 py-2 bg-[#0074A6] hover:bg-[#005B82] text-white rounded-full text-xs font-semibold shadow-md flex items-center gap-2 transition">
                <i class="fas fa-user-edit text-[10px]"></i> Edit Profil
            </button>
        </div>

        {{-- GRID STATS & INFO --}}
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-10">

            {{-- Kolom Kiri: Stats --}}
            <div class="space-y-4">
                {{-- Stats Baris 1: Pesanan & Selesai --}}
                <div class="grid grid-cols-2 gap-4">
                    {{-- Pesanan --}}
                    <div class="bg-white p-6 rounded-3xl shadow-sm border border-gray-100 flex flex-col items-center justify-center">
                        <div class="w-10 h-10 bg-blue-50 text-blue-400 rounded-full flex items-center justify-center mb-3">
                            <i class="fas fa-shopping-bag"></i>
                        </div>
                        <p class="text-2xl font-bold text-gray-800 leading-none mb-1">12</p>
                        <p class="text-[10px] font-semibold text-gray-400 tracking-wider">PESANAN</p>
                    </div>
                    {{-- Selesai (Centang udah gak double!) --}}
                    <div class="bg-white p-6 rounded-3xl shadow-sm border border-gray-100 flex flex-col items-center justify-center">
                        <div class="w-10 h-10 bg-green-50 text-green-400 rounded-full flex items-center justify-center mb-3">
                            <i class="fas fa-check-circle"></i>
                        </div>
                        <p class="text-2xl font-bold text-gray-800 leading-none mb-1">10</p>
                        <p class="text-[10px] font-semibold text-gray-400 tracking-wider">SELESAI</p>
                    </div>
                </div>

                {{-- Stats Baris 2: Aktif --}}
                <div class="bg-white p-5 rounded-3xl shadow-sm border border-gray-100 flex justify-between items-center">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 bg-orange-50 text-orange-400 rounded-xl flex items-center justify-center text-lg">
                            <i class="fas fa-receipt"></i>
                        </div>
                        <div>
                            <p class="text-xl font-bold text-gray-800 leading-none mb-1">2</p>
                            <p class="text-[10px] font-semibold text-gray-400 tracking-wider">AKTIF</p>
                        </div>
                    </div>
                    <a href="{{ url('/pesanan/status') }}" class="text-[#0074A6] text-xs font-bold hover:underline">Lihat</a>
                </div>
            </div>

            {{-- Kolom Kanan: Informasi Pribadi (Udah dikasih gap dan layout persis Figma) --}}
            <div class="lg:col-span-2 bg-white rounded-3xl p-8 shadow-sm border border-gray-100">
                <div class="flex items-center gap-3 mb-6">
                    <div class="w-10 h-10 bg-[#005B82] text-white rounded-full flex items-center justify-center shadow-sm">
                        <i class="fas fa-id-card"></i>
                    </div>
                    <h3 class="text-lg font-bold text-gray-800">Informasi Pribadi</h3>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-2">
                        <label class="text-[11px] font-medium text-gray-800">Nama</label>
                        <div class="bg-gray-100 px-4 py-3 rounded-xl text-sm font-medium text-gray-700 w-full">
                            Justin Bieber
                        </div>
                    </div>
                    <div class="space-y-2">
                        <label class="text-[11px] font-medium text-gray-800">Email</label>
                        <div class="bg-gray-100 px-4 py-3 rounded-xl text-sm font-medium text-gray-700 w-full">
                            justinbieber@gmail.com
                        </div>
                    </div>
                    <div class="space-y-2">
                        <label class="text-[11px] font-medium text-gray-800">No. Telepon</label>
                        <div class="bg-gray-100 px-4 py-3 rounded-xl text-sm font-medium text-gray-700 w-full">
                            +62 812 3456 7890
                        </div>
                    </div>
                    <div class="space-y-2">
                        <label class="text-[11px] font-medium text-gray-800">Alamat Default</label>
                        <div class="bg-gray-100 px-4 py-3 rounded-xl text-sm font-medium text-gray-700 w-full truncate">
                            Gg. Pisang No 13B, Gunungpati.
                        </div>
                    </div>
                </div>
            </div>

        </div>

        {{-- MENU LIST (Bebas nge-scroll sekarang) --}}
        <div class="flex flex-col gap-3 mb-10">
            <a href="#" class="bg-white px-6 py-4 rounded-2xl shadow-sm flex items-center justify-between hover:bg-gray-50 transition border border-gray-100 group">
                <div class="flex items-center gap-4">
                    <div class="w-10 h-10 rounded-full bg-gray-100 flex items-center justify-center text-gray-500 group-hover:bg-white transition">
                        <i class="far fa-bell"></i>
                    </div>
                    <span class="text-sm font-medium text-gray-700">Notifikasi</span>
                </div>
                <i class="fas fa-chevron-right text-gray-300 text-xs transition group-hover:translate-x-1"></i>
            </a>

            <a href="#" class="bg-white px-6 py-4 rounded-2xl shadow-sm flex items-center justify-between hover:bg-gray-50 transition border border-gray-100 group">
                <div class="flex items-center gap-4">
                    <div class="w-10 h-10 rounded-full bg-gray-100 flex items-center justify-center text-gray-500 group-hover:bg-white transition">
                        <i class="fas fa-unlock-alt"></i>
                    </div>
                    <span class="text-sm font-medium text-gray-700">Ubah Password</span>
                </div>
                <i class="fas fa-chevron-right text-gray-300 text-xs transition group-hover:translate-x-1"></i>
            </a>

            <a href="#" class="bg-white px-6 py-4 rounded-2xl shadow-sm flex items-center justify-between hover:bg-gray-50 transition border border-gray-100 group">
                <div class="flex items-center gap-4">
                    <div class="w-10 h-10 rounded-full bg-gray-100 flex items-center justify-center text-gray-500 group-hover:bg-white transition">
                        <i class="far fa-question-circle"></i>
                    </div>
                    <span class="text-sm font-medium text-gray-700">Bantuan</span>
                </div>
                <i class="fas fa-chevron-right text-gray-300 text-xs transition group-hover:translate-x-1"></i>
            </a>

            <a href="#" class="bg-white px-6 py-4 rounded-2xl shadow-sm flex items-center justify-between hover:bg-gray-50 transition border border-gray-100 group">
                <div class="flex items-center gap-4">
                    <div class="w-10 h-10 rounded-full bg-gray-100 flex items-center justify-center text-gray-500 group-hover:bg-white transition">
                        <i class="far fa-file-alt"></i>
                    </div>
                    <span class="text-sm font-medium text-gray-700">Syarat & Ketentuan</span>
                </div>
                <i class="fas fa-chevron-right text-gray-300 text-xs transition group-hover:translate-x-1"></i>
            </a>
        </div>

        {{-- KELUAR BUTTON (Pake jurus paksa lebar minimum) --}}
        <div class="flex justify-center mt-10 mb-12">
            <form action="{{ url('/logout') }}" method="POST">
                @csrf
                <button type="submit" class="flex items-center justify-center gap-2 min-w-[150px] px-6 py-3 bg-white border border-red-500 text-red-500 rounded-full font-semibold text-sm hover:bg-red-50 transition shadow-sm active:scale-95">
                    <i class="fas fa-sign-out-alt"></i> Keluar
                </button>
            </form>
        </div>

    </main>
</body>
</html>