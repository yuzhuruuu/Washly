<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Alamat - Washly</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-[#F4F7FB] min-h-screen flex items-center justify-center py-10 px-4 relative overflow-hidden">
    
    {{-- Lingkaran Dekorasi Background --}}
    <div class="absolute top-10 left-10 w-24 h-24 bg-blue-100 rounded-full mix-blend-multiply filter blur-xl opacity-70"></div>
    <div class="absolute bottom-20 right-10 w-32 h-32 bg-cyan-100 rounded-full mix-blend-multiply filter blur-xl opacity-70"></div>

    <div class="bg-white rounded-[2rem] shadow-xl shadow-blue-900/5 p-8 w-full max-w-sm text-center z-10 relative">
        
        {{-- Logo Washly --}}
        <div class="flex justify-center mb-4">
            <img src="{{ asset('images/w-g.svg') }}" alt="Washly Logo" class="h-auto w-[120px]">
        </div>
        
        <h2 class="text-xl font-bold text-gray-800">Buat Akun Baru</h2>
        <p class="text-xs text-gray-500 mb-6">Langkah 2: Tentukan Lokasi Rumah</p>

        {{-- REVISI: Action diarahkan ke route('register') dengan method POST --}}
        <form action="{{ route('register') }}" method="POST" class="text-left">
            @csrf
            
            {{-- REVISI HIDDEN INPUT: Menjaga data akun dari URL agar ikut terkirim ke DB --}}
            <input type="hidden" name="nama" value="{{ request('nama') }}">
            <input type="hidden" name="username" value="{{ request('username') }}">
            <input type="hidden" name="email" value="{{ request('email') }}">
            <input type="hidden" name="no_hp" value="{{ request('no_hp') }}">
            <input type="hidden" name="password" value="{{ request('password') }}">
            <input type="hidden" name="password_confirmation" value="{{ request('password_confirmation') }}">


            {{-- Keterangan Alamat --}}
            <div class="mb-6">
                <label class="block text-[11px] font-bold text-gray-800 mb-2">Alamat Lengkap Rumah</label>
                {{-- REVISI: name diubah jadi 'alamat' sesuai rule validasi backend --}}
                <textarea name="alamat" required rows="3" class="w-full bg-[#F0F4F8] border-none rounded-xl p-4 text-xs focus:ring-2 focus:ring-[#0074A6] text-gray-600 placeholder-gray-400 resize-none" placeholder="Cth : Gedung A, Lantai 4, Pagar warna Hitam ..."></textarea>
            </div>

            {{-- REVISI: Mengubah tag <a> menjadi <button type="submit"> berkekuatan POST --}}
            <button type="submit" class="w-full flex justify-center items-center bg-gradient-to-r from-[#0085BE] to-[#005B82] hover:from-[#0074A6] hover:to-[#004B6D] text-white font-semibold py-3 rounded-full transition-all duration-300 shadow-lg shadow-[#0074A6]/30 cursor-pointer">
                Daftar Sekarang
            </button>
        </form>

        {{-- Divider ATAU --}}
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