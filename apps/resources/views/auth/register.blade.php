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
    
    <div class="bg-white rounded-[2rem] shadow-xl shadow-blue-900/5 p-8 w-full max-w-sm text-center">
        
        {{-- 1. Logo Washly --}}
        <div class="flex justify-center mb-4">
            <img src="{{ asset('images/w-g.svg') }}" alt="Washly Logo" class="h-auto w-[120px]">
        </div>
        
        <h2 class="text-xl font-bold text-gray-800">Buat Akun Baru</h2>
        <p class="text-xs text-gray-500 mb-6">Selamat datang di Washly!</p>

        <form action="{{ route('register') }}" method="POST" class="space-y-3 text-left">
            @csrf
<<<<<<< HEAD
=======
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="block text-gray-700 text-xs font-bold mb-1 uppercase">Nama Lengkap</label>
                    <input type="text" name="nama" class="w-full px-4 py-2 border rounded-lg focus:border-blue-500 focus:ring-1 focus:ring-blue-500" placeholder="Contoh: Zayn Malik" required>
                </div>
                <div>
                    <label class="block text-gray-700 text-xs font-bold mb-1 uppercase">No. WhatsApp</label>
                    <input type="text" name="no_hp" class="w-full px-4 py-2 border rounded-lg focus:border-blue-500 focus:ring-1 focus:ring-blue-500" placeholder="Tanpa Nol : 628123..." required>
                </div>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-xs font-bold mb-1 uppercase">Email</label>
                <input type="email" name="email" class="w-full px-4 py-2 border rounded-lg focus:border-blue-500 focus:ring-1 focus:ring-blue-500" placeholder="nama@email.com" required>
            </div>

            <div>
                <label class="block text-gray-700 text-xs font-bold mb-1 uppercase">Username</label>
                <input type="text" name="username" class="w-full px-4 py-2 border rounded-lg focus:border-blue-500 focus:ring-1 focus:ring-blue-500" placeholder="Username" required>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-xs font-bold mb-1 uppercase">Alamat Lengkap</label>
                <textarea name="alamat" rows="2" class="w-full px-4 py-2 border rounded-lg focus:border-blue-500 focus:ring-1 focus:ring-blue-500" placeholder="Jl. Raya Banaran..." required></textarea>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                <div>
                    <label class="block text-gray-700 text-xs font-bold mb-1 uppercase">Password</label>
                    <input type="password" name="password" class="w-full px-4 py-2 border rounded-lg focus:border-blue-500 focus:ring-1 focus:ring-blue-500" placeholder="********" required>
                </div>
                <div>
                    <label class="block text-gray-700 text-xs font-bold mb-1 uppercase">Konfirmasi Password</label>
                    <input type="password" name="password_confirmation" class="w-full px-4 py-2 border rounded-lg focus:border-blue-500 focus:ring-1 focus:ring-blue-500" placeholder="********" required>
                </div>
            </div>
>>>>>>> 0d7885c6d42e58a5a7b3c3b1e67b0b34d2c58639
            
            {{-- Nama Lengkap --}}
            <div class="relative">
                {{-- FIX Icon Rata Tengah --}}
                <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400"><i class="far fa-user"></i></span>
                <input type="text" name="name" required class="w-full bg-[#E8EDF2] border-none rounded-xl pl-10 pr-4 py-3 text-sm focus:ring-2 focus:ring-[#0074A6] placeholder-gray-400" placeholder="Nama Lengkap">
            </div>

            {{-- Username (Opsional, sesuaikan DB) --}}
            <div class="relative">
                <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400"><i class="fas fa-id-badge"></i></span>
                <input type="text" name="username" class="w-full bg-[#E8EDF2] border-none rounded-xl pl-10 pr-4 py-3 text-sm focus:ring-2 focus:ring-[#0074A6] placeholder-gray-400" placeholder="Username">
            </div>

            {{-- Email --}}
            <div class="relative">
                <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400"><i class="far fa-envelope"></i></span>
                <input type="email" name="email" required class="w-full bg-[#E8EDF2] border-none rounded-xl pl-10 pr-4 py-3 text-sm focus:ring-2 focus:ring-[#0074A6] placeholder-gray-400" placeholder="Email">
            </div>

            {{-- Password --}}
            <div class="relative" x-data="{ show: false }">
                <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400"><i class="fas fa-lock"></i></span>
                <input :type="show ? 'text' : 'password'" name="password" required class="w-full bg-[#E8EDF2] border-none rounded-xl pl-10 pr-10 py-3 text-sm focus:ring-2 focus:ring-[#0074A6] placeholder-gray-400" placeholder="Password">
                <button type="button" @click="show = !show" class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600">
                    <i :class="show ? 'fas fa-eye-slash' : 'fas fa-eye'"></i>
                </button>
            </div>

            {{-- Konfirmasi Password --}}
            <div class="relative">
                <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400"><i class="fas fa-lock"></i></span>
                <input type="password" name="password_confirmation" required class="w-full bg-[#E8EDF2] border-none rounded-xl pl-10 pr-4 py-3 text-sm focus:ring-2 focus:ring-[#0074A6] placeholder-gray-400" placeholder="Konfirmasi Password">
            </div>

            {{-- 3. Tombol Selanjutnya (Bentuk Pill + Gradasi) --}}
            <a href="{{ route('register.address') }}" class="w-full flex justify-center items-center bg-gradient-to-r from-[#0074A6] to-[#004B6D] hover:from-[#0085BE] hover:to-[#005B82] text-white font-semibold py-3.5 rounded-full transition-all duration-300 shadow-lg shadow-[#0074A6]/30 mt-4">
                Selanjutnya
            </a>
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