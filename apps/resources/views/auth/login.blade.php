<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Washly</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    {{-- CDN FontAwesome untuk icon mata di password --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-[#F4F7FB] min-h-screen flex items-center justify-center relative px-4">
    
    <div class="bg-white rounded-[2rem] shadow-xl shadow-blue-900/5 p-8 w-full max-w-sm text-center relative z-10">
        {{-- Logo --}}
        <div class="flex justify-center mb-6">
            <img src="{{ asset('images/w-g.svg') }}" alt="Washly Logo" class="h-auto w-[120px]">
        </div>
        
        <h2 class="text-lg font-bold text-gray-800 mb-8">Selamat Datang Kembali</h2>

        <form action="{{ route('login') }}" method="POST" class="space-y-5 text-left">
            @csrf
            
            {{-- Input Email atau Username--}}
            <div>
                <label class="block text-[11px] font-bold text-gray-400 mb-1">Email</label>
                <div class="relative">
                    {{-- FIX: top-1/2 -translate-y-1/2 biar rata tengah sempurna --}}
                    <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-300"><i class="far fa-envelope"></i></span>
                    <input type="text" name="email" required class="w-full bg-[#F8FAFC] border-none rounded-xl pl-10 pr-4 py-3 text-sm focus:ring-2 focus:ring-[#0074A6] text-gray-600" placeholder="Masukkan email / username Anda">
                </div>
            </div>

            {{-- Input Password --}}
            <div>
                <label class="block text-[11px] font-bold text-gray-400 mb-1">Password</label>
                <div class="relative" x-data="{ show: false }">
                    {{-- FIX: top-1/2 -translate-y-1/2 --}}
                    <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-300"><i class="fas fa-lock"></i></span>
                    <input :type="show ? 'text' : 'password'" name="password" required class="w-full bg-[#F8FAFC] border-none rounded-xl pl-10 pr-10 py-3 text-sm focus:ring-2 focus:ring-[#0074A6] text-gray-600" placeholder="••••••••">
                    {{-- FIX: Icon mata juga disamain biar presisi --}}
                    <button type="button" @click="show = !show" class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600">
                        <i :class="show ? 'fas fa-eye-slash' : 'fas fa-eye'"></i>
                    </button>
                </div>
            </div>

            <div class="text-right">
                <a href="#" class="text-[11px] font-semibold text-[#0074A6] hover:underline">Lupa password?</a>
            </div>

            <button type="submit" class="w-full flex justify-center items-center bg-gradient-to-r from-[#0085BE] to-[#005B82] hover:from-[#0074A6] hover:to-[#004B6D] text-white font-semibold py-3.5 rounded-full transition-all duration-300 shadow-lg shadow-[#0074A6]/30 mt-2">
                Masuk
            </button>
        </form>

        <div class="mt-8 border-t border-gray-100 pt-6">
            <p class="text-xs text-gray-500">
                Belum punya akun? <a href="{{ route('register') }}" class="text-[#0074A6] font-bold hover:underline">Daftar sekarang</a>
            </p>
        </div>
    </div>
</body>
</html>