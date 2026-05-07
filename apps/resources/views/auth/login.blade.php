<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk - Washly</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-blue-50 flex items-center justify-center h-screen">
    <div class="bg-white p-8 rounded-xl shadow-lg w-full max-w-md border border-blue-100">
        <div class="text-center mb-8">
            <h2 class="text-3xl font-extrabold text-blue-600">Washly</h2>
            <p class="text-gray-500 text-sm mt-1">Sistem Manajemen Laundry Cerdas</p>
        </div>

        {{-- Alert kalau ada error (misal password salah) --}}
        @if($errors->any())
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-3 rounded mb-6 text-sm">
                {{ $errors->first() }}
            </div>
        @endif

        {{-- Form Login menembak ke Route POST /login --}}
        <form action="{{ route('login') }}" method="POST">
            @csrf {{-- <--- INI WAJIB ADA, EGE! --}}
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Email</label>
                <input type="email" name="email" value="{{ old('email') }}" 
                       class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500" 
                       placeholder="contoh@email.com" required>
            </div>
            
            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-bold mb-2">Password</label>
                <input type="password" name="password" 
                       class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500" 
                       placeholder="********" required>
            </div>
            
            <button type="submit" class="w-full bg-blue-600 text-white font-bold py-3 px-4 rounded-lg hover:bg-blue-700 transition shadow-md">
                Masuk
            </button>
        </form>

        <p class="text-center text-sm text-gray-600 mt-6">
            Belum jadi pelanggan? <a href="{{ url('/register') }}" class="text-blue-600 font-bold hover:underline">Daftar sekarang</a>
        </p>
    </div>
</body>
</html>