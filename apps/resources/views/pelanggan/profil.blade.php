<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Saya - Washly</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-slate-100 min-h-screen font-sans text-slate-800 pb-12 antialiased">

    @include('pelanggan.partials.navbar')

    {{-- MAIN CONTAINER (Jarak atas udah dilonggarin pakai pt-20) --}}
    <main class="max-w-5xl lg:max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 pt-20 pb-20 relative z-10">

        {{-- HEADER PROFIL (Langsung dikasih mt-16 di sini biar turun menjauh dari navbar) --}}
        <div class="flex flex-col items-center mb-10 mt-16">
            <a href="{{ route('pelanggan.profil.edit') }}" class="relative w-28 h-28 mb-4 group">
                <div class="w-full h-full rounded-full border-4 border-white shadow-lg overflow-hidden bg-gray-200 group-hover:shadow-xl transition">
                    <img src="https://ui-avatars.com/api/?name={{ urlencode($pelanggan->nama ?? 'User') }}&background=0074A6&color=fff&size=150" alt="Profile" class="w-full h-full object-cover">
                </div>
                <div class="absolute bottom-0 right-0 bg-[#0074A6] w-8 h-8 rounded-full shadow-md flex items-center justify-center text-white border-2 border-white hover:bg-[#005B82] transition group-hover:scale-110">
                    <i class="fas fa-pen text-[10px]"></i>
                </div>
            </a>
            <h2 class="text-2xl font-bold text-gray-800">{{ $pelanggan->nama ?? 'Pelanggan' }}</h2>
            <p class="text-sm text-gray-500">{{ $pelanggan->email ?? 'Email tidak tersedia' }}</p>
            <p class="text-sm text-gray-400 mb-4">{{ $pelanggan->username ? '@' . $pelanggan->username : '-' }}</p>
            <a href="{{ route('pelanggan.profil.edit') }}" class="px-6 py-2 bg-[#0074A6] hover:bg-[#005B82] text-white rounded-full text-xs font-semibold shadow-md flex items-center gap-2 transition">
                <i class="fas fa-user-edit text-[10px]"></i> Edit Profil
            </a>
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
                        <p class="text-2xl font-bold text-gray-800 leading-none mb-1">{{ \App\Models\Pesanan::where('id_pelanggan', $pelanggan->id_pelanggan)->count() }}</p>
                        <p class="text-[10px] font-semibold text-gray-400 tracking-wider">PESANAN</p>
                    </div>
                    {{-- Selesai (Centang udah gak double!) --}}
                    <div class="bg-white p-6 rounded-3xl shadow-sm border border-gray-100 flex flex-col items-center justify-center">
                        <div class="w-10 h-10 bg-green-50 text-green-400 rounded-full flex items-center justify-center mb-3">
                            <i class="fas fa-check-circle"></i>
                        </div>
                        <p class="text-2xl font-bold text-gray-800 leading-none mb-1">{{ \App\Models\Pesanan::where('id_pelanggan', $pelanggan->id_pelanggan)->where('status', 'selesai')->count() }}</p>
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
                            <p class="text-xl font-bold text-gray-800 leading-none mb-1">{{ \App\Models\Pesanan::where('id_pelanggan', $pelanggan->id_pelanggan)->whereIn('status', ['menunggu_pickup','menunggu_timbang','menunggu_bayar','menunggu_konfirmasi','proses','delivery'])->count() }}</p>
                            <p class="text-[10px] font-semibold text-gray-400 tracking-wider">AKTIF</p>
                        </div>
                    </div>
                    <a href="{{ route('pelanggan.status') }}" class="text-[#0074A6] text-xs font-bold hover:underline">Lihat</a>
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
                            {{ $pelanggan->nama ?? '-' }}
                        </div>
                    </div>
                    <div class="space-y-2">
                        <label class="text-[11px] font-medium text-gray-800">Email</label>
                        <div class="bg-gray-100 px-4 py-3 rounded-xl text-sm font-medium text-gray-700 w-full">
                            {{ $pelanggan->email ?? '-' }}
                        </div>
                    </div>
                    <div class="space-y-2">
                        <label class="text-[11px] font-medium text-gray-800">No. Telepon</label>
                        <div class="bg-gray-100 px-4 py-3 rounded-xl text-sm font-medium text-gray-700 w-full">
                            {{ $pelanggan->no_hp ?? '-' }}
                        </div>
                    </div>
                    <div class="space-y-2">
                        <label class="text-[11px] font-medium text-gray-800">Alamat Default</label>
                        <div class="bg-gray-100 px-4 py-3 rounded-xl text-sm font-medium text-gray-700 w-full truncate">
                            {{ $pelanggan->alamat ?? 'Belum ditentukan' }}
                        </div>
                    </div>
                </div>
            </div>

        </div>

        {{-- MENU LIST (Bebas nge-scroll sekarang) --}}
        <div class="flex flex-col gap-3 mb-10">
            <a href="{{ route('pelanggan.notifikasi') }}" class="bg-white px-6 py-4 rounded-2xl shadow-sm flex items-center justify-between hover:bg-gray-50 transition border border-gray-100 group">
                <div class="flex items-center gap-4">
                    <div class="w-10 h-10 rounded-full bg-gray-100 flex items-center justify-center text-gray-500 group-hover:bg-white transition">
                        <i class="far fa-bell"></i>
                    </div>
                    <span class="text-sm font-medium text-gray-700">Notifikasi</span>
                </div>
                <i class="fas fa-chevron-right text-gray-300 text-xs transition group-hover:translate-x-1"></i>
            </a>
            <a href="{{ route('pelanggan.ubah-password') }}" class="bg-white px-6 py-4 rounded-2xl shadow-sm flex items-center justify-between hover:bg-gray-50 transition border border-gray-100 group">
                <div class="flex items-center gap-4">
                    <div class="w-10 h-10 rounded-full bg-gray-100 flex items-center justify-center text-gray-500 group-hover:bg-white transition">
                        <i class="fas fa-unlock-alt"></i>
                    </div>
                    <span class="text-sm font-medium text-gray-700">Ubah Password</span>
                </div>
                <i class="fas fa-chevron-right text-gray-300 text-xs transition group-hover:translate-x-1"></i>
            </a>
            <a href="{{ route('pelanggan.bantuan') }}" class="bg-white px-6 py-4 rounded-2xl shadow-sm flex items-center justify-between hover:bg-gray-50 transition border border-gray-100 group">
                <div class="flex items-center gap-4">
                    <div class="w-10 h-10 rounded-full bg-gray-100 flex items-center justify-center text-gray-500 group-hover:bg-white transition">
                        <i class="far fa-question-circle"></i>
                    </div>
                    <span class="text-sm font-medium text-gray-700">Bantuan</span>
                </div>
                <i class="fas fa-chevron-right text-gray-300 text-xs transition group-hover:translate-x-1"></i>
            </a>
            <a href="{{ route('pelanggan.syarat') }}" class="bg-white px-6 py-4 rounded-2xl shadow-sm flex items-center justify-between hover:bg-gray-50 transition border border-gray-100 group">
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
