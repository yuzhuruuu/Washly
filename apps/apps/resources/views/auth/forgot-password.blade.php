<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buat Password Baru - Washly</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-[#F4F7FB] min-h-screen flex items-center justify-center relative px-4">
    
    <div class="bg-white rounded-[2rem] shadow-xl shadow-blue-900/5 p-8 w-full max-w-sm text-center relative z-10">
        {{-- Logo --}}
        <div class="flex justify-center mb-6">
            <img src="{{ asset('images/w-g.svg') }}" alt="Washly Logo" class="h-auto w-[120px]">
        </div>
        
        {{-- Header --}}
        <div class="mb-8">
            <h2 class="text-xl font-bold text-gray-800 mb-2">Buat Password Baru</h2>
            <p class="text-xs text-gray-500 leading-relaxed px-2">
                Silakan buat password baru untuk akun Anda. Pastikan password mudah diingat namun sulit ditebak.
            </p>
        </div>

        {{-- Form Tembak ke Route Anak BE --}}
        <form action="{{ route('password.store') }}" method="POST" class="space-y-5 text-left">
            @csrf

            {{-- Token Rahasia dari URL --}}
            <input type="hidden" name="token" value="{{ $request->route('token') }}">
            
            {{-- Input Email (Otomatis Terisi & Dikunci) --}}
            <div>
                <label class="block text-[11px] font-bold text-gray-400 mb-1">Email Terdaftar</label>
                <div class="relative">
                    <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-300"><i class="far fa-envelope"></i></span>
                    <input type="email" name="email" value="{{ old('email', $request->email) }}" readonly class="w-full bg-gray-100 border-none rounded-xl pl-10 pr-4 py-3 text-sm text-gray-500 cursor-not-allowed">
                </div>
                @error('email')
                    <p class="text-red-500 text-[10px] font-bold mt-1">❌ {{ $message }}</p>
                @enderror
            </div>

            {{-- Input Password Baru --}}
            <div>
                <label class="block text-[11px] font-bold text-gray-400 mb-1">Password Baru</label>
                <div class="relative" x-data="{ show: false }">
                    <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-300"><i class="fas fa-lock"></i></span>
                    <input :type="show ? 'text' : 'password'" name="password" required class="w-full bg-[#F8FAFC] border-none rounded-xl pl-10 pr-10 py-3 text-sm focus:ring-2 focus:ring-[#0074A6] text-gray-600" placeholder="Minimal 8 karakter">
                    <button type="button" @click="show = !show" class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 hover:text-[#0074A6] transition-colors">
                        <i :class="show ? 'fas fa-eye-slash' : 'fas fa-eye'"></i>
                    </button>
                </div>
                @error('password')
                    <p class="text-red-500 text-[10px] font-bold mt-1">❌ {{ $message }}</p>
                @enderror
            </div>

            {{-- Input Konfirmasi Password Baru --}}
            <div>
                <label class="block text-[11px] font-bold text-gray-400 mb-1">Konfirmasi Password Baru</label>
                <div class="relative" x-data="{ show: false }">
                    <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-300"><i class="fas fa-check-circle"></i></span>
                    <input :type="show ? 'text' : 'password'" name="password_confirmation" required class="w-full bg-[#F8FAFC] border-none rounded-xl pl-10 pr-10 py-3 text-sm focus:ring-2 focus:ring-[#0074A6] text-gray-600" placeholder="Ketik ulang password baru">
                    <button type="button" @click="show = !show" class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 hover:text-[#0074A6] transition-colors">
                        <i :class="show ? 'fas fa-eye-slash' : 'fas fa-eye'"></i>
                    </button>
                </div>
            </div>

            {{-- Tombol Submit --}}
            <button type="submit" class="w-full flex justify-center items-center bg-gradient-to-r from-[#0085BE] to-[#005B82] hover:from-[#0074A6] hover:to-[#004B6D] text-white font-semibold py-3.5 rounded-full transition-all duration-300 shadow-lg shadow-[#0074A6]/30 mt-4">
                Simpan Password Baru
            </button>
        </form>
    </div>

</body>
</html>