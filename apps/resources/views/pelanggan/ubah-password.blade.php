<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ubah Password - Washly</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <style>body { font-family: 'Plus Jakarta Sans', sans-serif; }</style>
</head>
<body class="bg-[#F8FAFC] text-slate-800 antialiased selection:bg-[#00AEEF] selection:text-white">

    {{-- NAVBAR (Rata Tengah Sempurna Matematis!) --}}
    <nav class="bg-white sticky top-0 z-50 border-b border-gray-100 w-full shadow-sm">
        <!-- Tambahin class 'relative' di wrapper ini -->
        <div class="max-w-7xl mx-auto px-8 py-4 flex justify-between items-center relative">
            
            <!-- Logo (Kiri) -->
            <div class="flex items-center gap-2 relative z-10">
                <img src="{{ asset('images/w-g.svg') }}" alt="Washly Logo" class="h-8">
            </div>
            
            <!-- Navigation Links (Dipaku mati di tengah!) -->
            <div class="hidden md:flex items-center gap-8 text-sm font-semibold text-gray-500 absolute left-1/2 transform -translate-x-1/2 z-0">
                <a href="{{ route('pelanggan.dashboard') }}" class="hover:text-[#0074A6] transition">Beranda</a>
                <a href="{{ route('pelanggan.pesanan.baru') }}" class="hover:text-[#0074A6] transition">Layanan</a>
                <a href="{{ route('pelanggan.riwayat') }}" class="hover:text-[#0074A6] transition">Riwayat</a>
                <a href="{{ route('pelanggan.tentang-kami') }}" class="hover:text-[#0074A6] transition">Tentang Kami</a>
            </div>
            
            <!-- User Profile & Actions (Kanan) -->
            <div class="flex items-center gap-5 relative z-10">
                <span class="text-sm font-medium text-gray-700 hidden sm:block">Halo, {{ Auth::guard('pelanggan')->user()?->nama ?? 'User' }}!</span>
                <a href="{{ route('pelanggan.profil') }}" class="w-10 h-10 rounded-full border-2 border-white shadow-sm overflow-hidden cursor-pointer">
                    <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::guard('pelanggan')->user()?->nama ?? 'User') }}&background=0074A6&color=fff&bold=true" alt="Profile" class="w-full h-full object-cover">
                </a>
            </div>
            
        </div>
    </nav>

    {{-- KONTEN UBAH PASSWORD --}}
    <main class="max-w-2xl mx-auto px-8 py-12">
        
        <!-- Header Navigasi Balik -->
        <div class="mb-8 flex items-center gap-4">
            <a href="/profil" class="w-10 h-10 bg-white border border-gray-200 rounded-full flex items-center justify-center text-gray-500 hover:bg-gray-50 hover:text-[#0074A6] transition shadow-sm">
                <i class="fas fa-arrow-left"></i>
            </a>
            <div>
                <h1 class="text-2xl font-bold text-gray-800">Ubah Password</h1>
                <p class="text-sm text-gray-500 font-medium">Pastikan akun Anda selalu aman.</p>
            </div>
        </div>

        <!-- Form Card -->
        <div class="bg-white rounded-[2rem] p-8 shadow-sm border border-gray-100 relative overflow-hidden">
            <!-- Ornamen Dekorasi Bubbly -->
            <div class="absolute top-0 right-0 w-32 h-32 bg-[#00AEEF]/5 rounded-bl-full -z-10"></div>
            
            <form action="#" method="POST" class="space-y-6">
                
                <!-- Password Lama -->
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Password Saat Ini</label>
                    <div class="relative flex items-center">
                        <i class="fas fa-lock absolute left-4 text-gray-400 pointer-events-none"></i>
                        <input type="password" class="w-full bg-[#F8FAFC] border border-gray-200 text-gray-800 text-sm rounded-xl focus:ring-[#0074A6] focus:border-[#0074A6] block pl-12 py-3.5 pr-4 transition" placeholder="Masukkan password saat ini">
                    </div>
                </div>

                <hr class="border-gray-100">

                <!-- Password Baru -->
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Password Baru</label>
                    <div class="relative flex items-center">
                        <i class="fas fa-key absolute left-4 text-gray-400 pointer-events-none"></i>
                        <input type="password" class="w-full bg-[#F8FAFC] border border-gray-200 text-gray-800 text-sm rounded-xl focus:ring-[#0074A6] focus:border-[#0074A6] block pl-12 py-3.5 pr-4 transition" placeholder="Buat password baru">
                    </div>
                    <p class="text-xs text-gray-400 mt-2 font-medium"><i class="fas fa-info-circle mr-1"></i>Minimal 8 karakter, kombinasi huruf dan angka.</p>
                </div>

                <!-- Konfirmasi Password Baru -->
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Konfirmasi Password Baru</label>
                    <div class="relative flex items-center">
                        <i class="fas fa-check-circle absolute left-4 text-gray-400 pointer-events-none"></i>
                        <input type="password" class="w-full bg-[#F8FAFC] border border-gray-200 text-gray-800 text-sm rounded-xl focus:ring-[#0074A6] focus:border-[#0074A6] block pl-12 py-3.5 pr-4 transition" placeholder="Ketik ulang password baru">
                    </div>
                </div>

                <!-- Action Button -->
                <div class="pt-4">
                    <button type="submit" class="w-full bg-[#0074A6] hover:bg-[#005a82] text-white font-bold py-3.5 px-6 rounded-full text-sm shadow-md transition">
                        Simpan Password Baru
                    </button>
                </div>
            </form>
        </div>
    </main>

</body>
</html>