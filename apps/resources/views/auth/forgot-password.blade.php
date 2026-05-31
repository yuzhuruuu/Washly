<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lupa Password - Washly</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-[#F4F7FB] min-h-screen flex items-center justify-center relative px-4">
    
    <div class="bg-white rounded-[2rem] shadow-xl shadow-blue-900/5 p-8 w-full max-w-sm text-center relative z-10">
        {{-- Logo --}}
        <div class="flex justify-center mb-6">
            <img src="{{ asset('images/w-g.svg') }}" alt="Washly Logo" class="h-auto w-[120px]">
        </div>
        
        {{-- Header & Deskripsi --}}
        <div class="mb-8">
            <div class="w-14 h-14 bg-blue-50 rounded-full flex items-center justify-center mx-auto mb-4 text-[#0074A6]">
                <i class="fas fa-key text-xl"></i>
            </div>
            <h2 class="text-xl font-bold text-gray-800 mb-2">Lupa Password?</h2>
            <p class="text-xs text-gray-500 leading-relaxed px-2">
                Jangan panik! Masukkan email akun Anda di bawah ini, dan kami akan mengirimkan tautan untuk mengatur ulang password.
            </p>
        </div>

        {{-- Bawaan Laravel: Alert Kalau Email Sukses Terkirim --}}
        @if (session('status'))
            <div class="mb-6 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-xl text-xs font-bold text-left flex gap-2 items-start">
                <i class="fas fa-check-circle mt-0.5"></i>
                <span>{{ session('status') }}</span>
            </div>
        @endif

        {{-- Form Tembak ke Route Anak BE --}}
        <form action="{{ route('password.email') }}" method="POST" class="space-y-5 text-left">
            @csrf
            
            {{-- Input Email --}}
            <div>
                <label class="block text-[11px] font-bold text-gray-400 mb-1">Email Terdaftar</label>
                <div class="relative">
                    <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-300"><i class="far fa-envelope"></i></span>
                    <input type="email" name="email" value="{{ old('email') }}" required autofocus class="w-full bg-[#F8FAFC] border-none rounded-xl pl-10 pr-4 py-3 text-sm focus:ring-2 focus:ring-[#0074A6] text-gray-600 transition-all" placeholder="contoh: nama@email.com">
                </div>
                
                {{-- Error Message --}}
                @error('email')
                    <p class="text-red-500 text-[10px] font-bold mt-1">❌ {{ $message }}</p>
                @enderror
            </div>

            {{-- Tombol Submit --}}
            <button type="submit" class="w-full flex justify-center items-center bg-gradient-to-r from-[#0085BE] to-[#005B82] hover:from-[#0074A6] hover:to-[#004B6D] text-white font-semibold py-3.5 rounded-full transition-all duration-300 shadow-lg shadow-[#0074A6]/30 mt-2">
                Kirim Tautan Reset
            </button>
        </form>

        {{-- Link Kembali ke Login --}}
        <div class="mt-8 border-t border-gray-100 pt-6">
            <a href="{{ route('login') }}" class="text-xs font-bold text-gray-400 hover:text-[#0074A6] transition-colors flex items-center justify-center gap-2">
                <i class="fas fa-arrow-left"></i> Kembali ke Login
            </a>
        </div>
    </div>

</body>
</html>