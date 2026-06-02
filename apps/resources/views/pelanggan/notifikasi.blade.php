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
<body class="bg-slate-100 min-h-screen font-sans text-slate-800 pb-12 antialiased">

    @include('pelanggan.partials.navbar')

    <main class="max-w-5xl lg:max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 pt-8 pb-20 relative z-10">
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
