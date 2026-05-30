<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tentang Kami - Washly</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    
    {{-- CSS Khusus untuk Animasi biar makin cakep tanpa perlu edit config tailwind --}}
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }
        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
            100% { transform: translateY(0px); }
        }
        .animate-fade { opacity: 0; animation: fadeInUp 0.8s cubic-bezier(0.16, 1, 0.3, 1) forwards; }
        .delay-100 { animation-delay: 0.1s; }
        .delay-200 { animation-delay: 0.2s; }
        .delay-300 { animation-delay: 0.3s; }
        .animate-float { animation: float 6s ease-in-out infinite; }
    </style>
</head>
<body class="bg-[#F8FAFC] text-slate-800 antialiased selection:bg-[#00AEEF] selection:text-white">

    {{-- NAVBAR --}}
    <nav class="bg-white border-b border-gray-100 shadow-sm sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center relative">
            <div class="flex items-center">
                <img src="{{ asset('images/w-g.svg') }}" alt="Washly" class="h-8">
            </div>

            <div class="hidden md:flex space-x-10 text-sm font-semibold absolute left-1/2 -translate-x-1/2">
                <a href="{{ route('pelanggan.dashboard') }}" class="text-gray-400 hover:text-gray-600 transition">Beranda</a>
                <a href="{{ route('pelanggan.pesanan.baru') }}" class="text-gray-400 hover:text-gray-600 transition">Layanan</a>
                <a href="{{ route('pelanggan.riwayat') }}" class="text-gray-400 hover:text-gray-600 transition">Riwayat</a>
                <a href="{{ route('pelanggan.tentang-kami') }}" class="text-[#0074A6] border-b-2 border-[#0074A6] pb-1">Tentang Kami</a>
            </div>

            <div class="flex items-center space-x-5">
                <span class="text-sm text-gray-500 font-medium">Halo, {{ Auth::guard('pelanggan')->user()?->nama ?? 'Pelanggan' }}!</span>
                <a href="{{ route('pelanggan.profil') }}" class="w-8 h-8 rounded-full bg-blue-50 overflow-hidden border border-blue-200 block hover:ring-2 hover:ring-[#00AEEF] hover:shadow-md transition-all cursor-pointer">
                    <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::guard('pelanggan')->user()?->nama ?? 'User') }}&background=0074A6&color=fff&bold=true" alt="Avatar" class="w-full h-full object-cover">
                </a>
                <form action="{{ route('logout') }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="text-red-400 hover:text-red-600 text-xs font-bold pl-2 border-l border-gray-200 transition">
                        <i class="fas fa-sign-out-alt"></i>
                    </button>
                </form>
            </div>
        </div>
    </nav>

    {{-- HERO SECTION --}}
    <section class="relative pt-24 pb-32 overflow-hidden flex flex-col items-center justify-center text-center px-8 animate-fade">
        <div class="absolute top-10 left-1/4 w-96 h-96 bg-[#00AEEF]/10 rounded-full mix-blend-multiply filter blur-3xl animate-float"></div>
        <div class="absolute -bottom-10 right-1/4 w-80 h-80 bg-[#0074A6]/10 rounded-full mix-blend-multiply filter blur-3xl animate-float" style="animation-delay: 2s;"></div>
        
        <div class="relative z-10 max-w-4xl mx-auto flex flex-col items-center">
            </span>
            <h1 class="text-5xl md:text-7xl font-black text-gray-800 mb-8 leading-[1.1] tracking-tight">
                Lebih dari Sekadar Mencuci,<br>
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-[#0074A6] to-[#00AEEF]">Kami Merawat Ceritamu.</span>
            </h1>
            <p class="text-lg md:text-xl text-gray-500 font-medium max-w-2xl leading-relaxed">
                Setiap noda punya cerita, setiap pakaian punya kenangan. Washly hadir untuk memastikan kamu selalu tampil percaya diri tanpa harus pusing memikirkan cucian yang menumpuk.
            </p>
        </div>
    </section>

    {{-- OUR STORY (ZIGZAG LAYOUT) --}}
    <section class="max-w-7xl mx-auto px-8 py-16 space-y-32">
        <div class="flex flex-col lg:flex-row items-center gap-16 animate-fade delay-100">
            <div class="flex-1 w-full relative group">
                <div class="absolute inset-0 bg-[#00AEEF] rounded-[2.5rem] transform translate-x-6 translate-y-6 opacity-20 group-hover:translate-x-8 group-hover:translate-y-8 transition-transform duration-500"></div>
                <img src="https://images.unsplash.com/photo-1545173168-9f1947eebb7f?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Laundry" class="relative z-10 rounded-[2.5rem] shadow-xl w-full h-[450px] object-cover hover:-translate-y-2 transition-transform duration-500">
            </div>
            <div class="flex-1">
                <h2 class="text-4xl font-black text-gray-800 mb-6 leading-tight">Berawal dari Tumpukan Baju Kotor di Kosan.</h2>
                <p class="text-gray-500 font-medium text-lg leading-relaxed mb-4">
                    Dulu, kami juga sama sepertimu. Pekerjaan numpuk, tugas kuliah nggak kelar-kelar, dan <i class="italic font-semibold text-gray-700">boom</i>—sadar-sadar keranjang cucian udah setinggi gunung. Baju favorit habis, <i class="italic font-semibold text-gray-700">mood</i> jadi berantakan.
                </p>
                <p class="text-gray-500 font-medium text-lg leading-relaxed">
                    Dari situlah <strong class="text-[#0074A6]">Washly</strong> lahir. Kami ingin menciptakan sebuah ekosistem <i class="italic">on-demand laundry</i> yang nggak cuma bersih, tapi juga <i class="italic">seamless</i>, cepat, dan bisa diandalkan.
                </p>
            </div>
        </div>
        
        <div class="flex flex-col-reverse lg:flex-row items-center gap-16 animate-fade delay-200">
            <div class="flex-1">
                <h2 class="text-4xl font-black text-gray-800 mb-6 leading-tight">Kurir Sepenuh Hati, Kualitas Tanpa Kompromi.</h2>
                <p class="text-gray-500 font-medium text-lg leading-relaxed mb-4">
                    Kami tidak menggunakan pihak ketiga. Washly memiliki armada kurir sendiri yang terlatih untuk menjemput dan mengantar pakaianmu dengan aman, tepat waktu, dan senyum ramah.
                </p>
                <p class="text-gray-500 font-medium text-lg leading-relaxed">
                    Dipadukan dengan deterjen ramah lingkungan dan teknologi pelacakan <i class="italic">real-time</i>, kamu bisa rebahan tenang sambil mantau status cucianmu langsung dari <i class="italic">smartphone</i>.
                </p>
            </div>
            <div class="flex-1 w-full relative group">
                <div class="absolute inset-0 bg-[#0074A6] rounded-[2.5rem] transform -translate-x-6 translate-y-6 opacity-20 group-hover:-translate-x-8 group-hover:translate-y-8 transition-transform duration-500"></div>
                <img src="https://images.unsplash.com/photo-1582735689369-4fe89db7114c?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Kurir Washly" class="relative z-10 rounded-[2.5rem] shadow-xl w-full h-[450px] object-cover hover:-translate-y-2 transition-transform duration-500">
            </div>
        </div>
    </section>

    {{-- IMPACT / STATISTIK --}}
    <section class="bg-white py-24 mt-20 border-y border-gray-100 animate-fade delay-200">
        <div class="max-w-7xl mx-auto px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl font-black text-gray-800 mb-4">Dampak yang Kami Buat</h2>
                <p class="text-gray-500 font-medium">Ribuan orang telah mempercayakan waktu berharganya pada Washly.</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <div class="bg-[#F8FAFC] rounded-[2rem] p-8 text-center hover:-translate-y-2 transition-transform duration-300 border border-slate-100 shadow-sm group">
                    <div class="w-16 h-16 mx-auto bg-blue-100 text-[#0074A6] rounded-2xl flex items-center justify-center text-2xl mb-6 group-hover:scale-110 transition-transform">
                        <i class="fas fa-tshirt"></i>
                    </div>
                    <h3 class="text-4xl font-black text-gray-800 mb-2">12K+</h3>
                    <p class="text-xs font-bold text-gray-400 uppercase tracking-wider">Pakaian Dicuci</p>
                </div>
                <div class="bg-[#F8FAFC] rounded-[2rem] p-8 text-center hover:-translate-y-2 transition-transform duration-300 border border-slate-100 shadow-sm group">
                    <div class="w-16 h-16 mx-auto bg-cyan-100 text-cyan-600 rounded-2xl flex items-center justify-center text-2xl mb-6 group-hover:scale-110 transition-transform">
                        <i class="fas fa-smile-beam"></i>
                    </div>
                    <h3 class="text-4xl font-black text-gray-800 mb-2">4.800+</h3>
                    <p class="text-xs font-bold text-gray-400 uppercase tracking-wider">Pelanggan Bahagia</p>
                </div>
                <div class="bg-[#F8FAFC] rounded-[2rem] p-8 text-center hover:-translate-y-2 transition-transform duration-300 border border-slate-100 shadow-sm group">
                    <div class="w-16 h-16 mx-auto bg-teal-100 text-teal-600 rounded-2xl flex items-center justify-center text-2xl mb-6 group-hover:scale-110 transition-transform">
                        <i class="fas fa-motorcycle"></i>
                    </div>
                    <h3 class="text-4xl font-black text-gray-800 mb-2">85+</h3>
                    <p class="text-xs font-bold text-gray-400 uppercase tracking-wider">Mitra Kurir Aktif</p>
                </div>
                <div class="bg-[#F8FAFC] rounded-[2rem] p-8 text-center hover:-translate-y-2 transition-transform duration-300 border border-slate-100 shadow-sm group">
                    <div class="w-16 h-16 mx-auto bg-orange-100 text-orange-500 rounded-2xl flex items-center justify-center text-2xl mb-6 group-hover:scale-110 transition-transform">
                        <i class="fas fa-star"></i>
                    </div>
                    <h3 class="text-4xl font-black text-gray-800 mb-2">4.9/5</h3>
                    <p class="text-xs font-bold text-gray-400 uppercase tracking-wider">Rating Rata-rata</p>
                </div>
            </div>
        </div>
    </section>

    {{-- CALL TO ACTION (CTA) --}}
    <section class="max-w-5xl mx-auto px-8 py-24 animate-fade delay-300">
        <div class="bg-gradient-to-br from-[#0074A6] to-[#00AEEF] rounded-[3rem] p-12 text-center relative overflow-hidden shadow-2xl">
            <div class="absolute -right-20 -top-20 w-64 h-64 bg-white opacity-10 rounded-full blur-2xl"></div>
            <div class="absolute -left-20 -bottom-20 w-80 h-80 bg-white opacity-10 rounded-full blur-2xl"></div>
            
            <div class="relative z-10">
                <h2 class="text-4xl md:text-5xl font-black text-white mb-6 leading-tight">Siap Ucapkan Selamat Tinggal<br>pada Tumpukan Cucian?</h2>
                <p class="text-blue-100 font-medium text-lg mb-10 max-w-xl mx-auto">
                    Rebahan aja di rumah. Biar kurir kami yang menjemput cucian kotormu dan mengantarnya kembali dengan wangi paripurna.
                </p>
                <a href="{{ route('pelanggan.pesanan.baru') }}" class="inline-flex items-center gap-3 bg-white text-[#0074A6] font-bold text-lg px-10 py-4 rounded-full hover:shadow-lg hover:scale-105 transition-all duration-300">
                    Pesan Washly Sekarang <i class="fas fa-arrow-right"></i>
                </a>
            </div>
        </div>
    </section>

    {{-- SIMPLE FOOTER --}}
    <footer class="bg-white border-t border-gray-100 py-10 mt-10">
        <div class="max-w-7xl mx-auto px-8 flex flex-col md:flex-row justify-between items-center gap-6">
            <div class="flex items-center gap-2">
                <img src="{{ asset('images/w-g.svg') }}" alt="Washly" class="h-6 opacity-50 grayscale hover:grayscale-0 transition">
            </div>
            <p class="text-xs font-medium text-gray-400">© 2026 Washly Indonesia.</p>
            <div class="flex gap-4 text-gray-400">
            </div>
        </div>
    </footer>

</body>
</html>