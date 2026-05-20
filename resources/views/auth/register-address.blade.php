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
        <p class="text-xs text-gray-500 mb-6">Selamat datang di Washly!</p>

        {{-- Form actionnya dikosongin dulu '#' karena backend belum siap --}}
        <form action="#" method="POST" class="text-left">
            @csrf
            
            {{-- Header Peta --}}
            <div class="flex justify-between items-end mb-2">
                <label class="block text-[11px] font-bold text-gray-800">Pilih Lokasi di Peta</label>
                <button type="button" class="text-[10px] font-bold text-[#0074A6] hover:underline flex items-center gap-1">
                    <i class="fas fa-crosshairs"></i> Gunakan Lokasi Saat Ini
                </button>
            </div>

            {{-- Mockup UI Peta --}}
            <div class="relative w-full h-48 bg-gray-200 rounded-2xl overflow-hidden mb-5 border border-gray-200 shadow-inner">
                {{-- Magic: Peta Asli OpenStreetMap --}}
                <iframe width="100%" height="100%" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://www.openstreetmap.org/export/embed.html?bbox=110.37%2C-7.05%2C110.47%2C-6.95&amp;layer=mapnik&amp;marker=-7.0%2C110.42" class="w-full h-full object-cover pointer-events-none opacity-80"></iframe>

                {{-- Search Bar Mengambang (Diperbaiki: Gak nabrak & Gak ada garis kaku) --}}
                {{-- Kita ganti right-3 jadi right-14 biar ngasih ruang buat tombol zoom peta di kanan --}}
                <div class="absolute top-3 left-3 right-14 bg-white/95 backdrop-blur-sm rounded-lg shadow-sm flex items-center px-3 py-1.5">
                    <i class="fas fa-search text-gray-400 mr-2 text-xs"></i>
                    {{-- border-0, outline-none, focus:ring-0, dan p-0 wajib biar inputnya beneran nyatu sama background --}}
                    <input type="text" class="w-full text-[11px] bg-transparent border-0 outline-none focus:outline-none focus:ring-0 shadow-none p-0 text-gray-700 placeholder-gray-400" placeholder="Cari lokasi atau jalan...">
                </div>

                {{-- Pin Peta di Tengah --}}
                <div class="absolute inset-0 flex items-center justify-center pointer-events-none pb-6">
                    <i class="fas fa-map-marker-alt text-4xl text-[#003B5C] drop-shadow-md"></i>
                </div>
                
            </div>

            {{-- Keterangan Alamat --}}
            <div class="mb-6">
                <label class="block text-[11px] font-bold text-gray-800 mb-2">Keterangan Alamat (Opsional)</label>
                <textarea name="address_detail" rows="3" class="w-full bg-[#F0F4F8] border-none rounded-xl p-4 text-xs focus:ring-2 focus:ring-[#0074A6] text-gray-600 placeholder-gray-400 resize-none" placeholder="Cth: Gedung A, Lantai 4, Pagar warna hitam..."></textarea>
            </div>

            {{-- Tombol Daftar Sekarang (Gradasi & Bentuk disamakan dengan Login) --}}
            <a href="{{ route('login') }}" class="w-full flex flex-col justify-center items-center bg-gradient-to-r from-[#0085BE] to-[#005B82] hover:from-[#0074A6] hover:to-[#004B6D] text-white font-semibold py-2.5 rounded-full transition-all duration-300 shadow-lg shadow-[#0074A6]/30">
                <span class="text-sm">Daftar Sekarang</span>
            </a>
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