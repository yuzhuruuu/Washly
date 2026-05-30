<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notifikasi - Washly</title>
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
        <div class="bg-white rounded-3xl p-6 shadow-sm border border-gray-100 mb-6 flex items-center gap-4">
            <a href="{{ route('pelanggan.profil') }}" class="inline-flex items-center justify-center w-12 h-12 rounded-full bg-white shadow-md border border-gray-100 text-gray-600 hover:bg-gray-50">
                <i class="fas fa-arrow-left"></i>
            </a>
            <div>
                <h1 class="text-2xl font-bold">Notifikasi</h1>
                <p class="text-sm text-gray-500">Notifikasi terbaru dari pesanan dan layanan Anda</p>
            </div>
        </div>

        <div class="bg-white rounded-2xl p-4 shadow-sm border border-gray-100">
            @if(isset($notifications) && $notifications->count())
                <ul class="divide-y">
                    @foreach($notifications as $note)
                        <li class="px-4 py-4 hover:bg-gray-50 flex justify-between items-start">
                            <div>
                                <p class="text-sm font-semibold text-gray-800">{{ $note->title }}</p>
                                <p class="text-xs text-gray-600 mt-1">{{ $note->message }}</p>
                                <p class="text-[11px] text-gray-400 mt-2">{{ $note->time ? $note->time->diffForHumans() : '' }}</p>
                            </div>
                            <div class="ml-4">
                                <a href="{{ $note->link }}" class="text-sm text-[#0074A6] font-semibold">Lihat</a>
                            </div>
                        </li>
                    @endforeach
                </ul>
            @else
                <div class="p-6 text-center text-gray-600">Belum ada notifikasi terbaru.</div>
            @endif
        </div>
    </main>
</body>
</html>