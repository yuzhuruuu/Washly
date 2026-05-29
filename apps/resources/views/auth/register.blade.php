<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar - Washly</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-[#F4F7FB] min-h-screen flex items-center justify-center py-10 px-4">
    
    <div class="bg-white rounded-[2rem] shadow-xl shadow-blue-900/5 p-8 w-full max-w-sm text-center my-8">
        
        {{-- Logo Washly --}}
        <div class="flex justify-center mb-4">
            <img src="{{ asset('images/w-g.svg') }}" alt="Washly Logo" class="h-auto w-[120px]">
        </div>
        
        <h2 class="text-xl font-bold text-gray-800">Buat Akun Baru</h2>
        <p class="text-xs text-gray-500 mb-6">Selamat Datang di Washly!</p>

        {{-- CONTAINER ERROR VALIDASI --}}
        @if ($errors->any())
            <div class="bg-red-100 text-red-600 text-xs p-3 rounded-xl mb-4 text-left">
                <ul class="list-disc pl-5 space-y-0.5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- REVISI: Mengarah ke rute register.address (Halaman Google Maps) menggunakan method GET --}}
        <form action="{{ route('register.address') }}" method="GET" class="space-y-3 text-left">
            
            {{-- Nama Lengkap --}}
            <div class="relative">
                <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400"><i class="far fa-user"></i></span>
                <input type="text" name="nama" value="{{ old('nama') }}" required class="w-full bg-[#E8EDF2] border-none rounded-xl pl-10 pr-4 py-3 text-sm focus:ring-2 focus:ring-[#0074A6] placeholder-gray-400" placeholder="Nama Lengkap">
            </div>

            {{-- Username --}}
            <div class="relative">
                <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400"><i class="fas fa-id-badge"></i></span>
                <input type="text" name="username" value="{{ old('username') }}" required class="w-full bg-[#E8EDF2] border-none rounded-xl pl-10 pr-4 py-3 text-sm focus:ring-2 focus:ring-[#0074A6] placeholder-gray-400" placeholder="Username">
            </div>

            {{-- Email --}}
            <div class="relative">
                <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400"><i class="far fa-envelope"></i></span>
                <input type="email" name="email" value="{{ old('email') }}" required class="w-full bg-[#E8EDF2] border-none rounded-xl pl-10 pr-4 py-3 text-sm focus:ring-2 focus:ring-[#0074A6] placeholder-gray-400" placeholder="Email">
            </div>

            {{-- No HP --}}
            <div class="relative">
                <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400"><i class="fas fa-phone"></i></span>
<<<<<<< HEAD
                <input type="text" name="no_hp" value="{{ old('no_hp') }}" required class="w-full bg-[#E8EDF2] border-none rounded-xl pl-10 pr-4 py-3 text-sm focus:ring-2 focus:ring-[#0074A6] placeholder-gray-400" placeholder="No. HP / WhatsApp">
=======
                <input type="text" name="no_hp" value="{{ old('no_hp') }}" required class="w-full bg-[#E8EDF2] border-none rounded-xl pl-10 pr-4 py-3 text-sm focus:ring-2 focus:ring-[#0074A6] placeholder-gray-400" placeholder="No. WhatsApp (Format 62...)">
>>>>>>> 1aa579cc41edae45803d9ea51980ca0d1dde8be7
            </div>

            {{-- Password --}}
            <div class="relative" x-data="{ show: false }">
                <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400"><i class="fas fa-lock"></i></span>
                <input :type="show ? 'text' : 'password'" name="password" required class="w-full bg-[#E8EDF2] border-none rounded-xl pl-10 pr-10 py-3 text-sm focus:ring-2 focus:ring-[#0074A6] placeholder-gray-400" placeholder="Password (Min. 8 Karakter)">
                <button type="button" @click="show = !show" class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600">
                    <i :class="show ? 'fas fa-eye-slash' : 'fas fa-eye'"></i>
                </button>
            </div>

            {{-- Konfirmasi Password --}}
            <div class="relative">
                <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400"><i class="fas fa-lock"></i></span>
                <input type="password" name="password_confirmation" required class="w-full bg-[#E8EDF2] border-none rounded-xl pl-10 pr-4 py-3 text-sm focus:ring-2 focus:ring-[#0074A6] placeholder-gray-400" placeholder="Konfirmasi Password">
            </div>

            {{-- REVISI: Menggunakan <button type="submit"> berkekuatan POST/GET data formulir ke page maps --}}
            <button type="submit" class="w-full flex justify-center items-center bg-gradient-to-r from-[#0074A6] to-[#004B6D] hover:from-[#0085BE] hover:to-[#005B82] text-white font-semibold py-3.5 rounded-full transition-all duration-300 shadow-lg shadow-[#0074A6]/30 mt-4 cursor-pointer">
                Selanjutnya
            </button>
        </form>

        <div class="mt-6 relative">
            <div class="absolute inset-0 flex items-center">
                <div class="w-full border-t border-gray-200"></div>
            </div>
            <div class="relative flex justify-center text-[10px]">
                <span class="bg-white px-2 text-gray-400 uppercase font-bold tracking-wider">Atau</span>
            </div>
        </div>

        <p class="mt-6 text-xs text-gray-500">
            Sudah punya akun? <a href="{{ route('login') }}" class="text-[#0074A6] font-bold hover:underline">Masuk di sini</a>
        </p>
    </div>
</body>
</html>