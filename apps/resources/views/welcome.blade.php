<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Selamat Datang di Washly</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 h-screen flex items-center justify-center">
    <div class="max-w-md w-full bg-white p-8 rounded-2xl shadow-lg text-center">
        <h1 class="text-4xl font-extrabold text-blue-600 mb-2">Washly</h1>
        <p class="text-gray-500 mb-8">Laundry Kilat, Beres Gak Pakai Ribet!</p>

        @if (Route::has('login'))
            <div class="space-y-4">
                @auth
                    {{-- Kalau user sudah login, kasih tombol ke dashboard sesuai role --}}
                    <p class="text-sm text-gray-600 mb-2">Kamu sudah masuk sebagai <b>{{ Auth::user()->nama ?? 'User' }}</b></p>
                    <a href="{{ url('/dashboard') }}" class="block w-full bg-blue-600 text-white font-bold py-3 rounded-xl shadow-md hover:bg-blue-700 transition">
                        Buka Dashboard
                    </a>
                @else
                    {{-- Kalau belum login, kasih pilihan Login atau Register --}}
                    <a href="{{ route('login') }}" class="block w-full bg-blue-600 text-white font-bold py-3 rounded-xl shadow-md hover:bg-blue-700 transition">
                        Masuk (Login)
                    </a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="block w-full bg-white text-blue-600 border-2 border-blue-600 font-bold py-3 rounded-xl hover:bg-blue-50 transition">
                            Daftar Pelanggan Baru
                        </a>
                    @endif
                @endauth
            </div>
        @endif
    </div>
</body>
</html>