<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengaturan Akun - Washly Kurir</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-[#F8FAFC] h-screen font-sans text-slate-800 flex overflow-hidden w-full">

    {{-- SIDEBAR KURIR --}}
    <aside class="w-64 bg-white border-r border-gray-100 flex flex-col h-full shrink-0 relative z-20 overflow-hidden">
        {{-- Logo --}}
        <div class="p-6">
            <img src="{{ asset('images/w-k.svg') }}" alt="Washly Kurir" class="h-8">
        </div>

        {{-- Profil Kurir --}}
        <div class="px-6 flex items-center gap-3 mb-8 w-full">
            <div class="w-10 h-10 rounded-full border border-gray-100 overflow-hidden shadow-sm shrink-0">
                <img src="https://i.pravatar.cc/150?img=14" alt="Sal Priadi" class="w-full h-full object-cover">
            </div>
            <div class="flex-1 min-w-0">
                <h3 class="font-bold text-sm text-[#0074A6] leading-tight truncate">Sal Priadi</h3>
                <p class="text-[10px] text-gray-500 font-medium mt-0.5">Kurir</p>
            </div>
        </div>

        {{-- Menu Navigasi --}}
        <nav class="flex-1 px-4 space-y-2 w-full overflow-y-auto no-scrollbar">
            <a href="{{ url('/dashboard/kurir') }}" class="flex items-center gap-3 px-4 py-3 text-gray-500 hover:bg-gray-50 hover:text-[#0074A6] rounded-xl font-medium text-sm transition group w-full">
                <i class="fas fa-th-large w-5 text-center text-gray-400 group-hover:text-[#0074A6] transition shrink-0"></i> Daftar Tugas
            </a>
            
            <a href="{{ url('/dashboard/kurir/profil') }}" class="flex items-center gap-3 px-4 py-3 text-gray-500 hover:bg-gray-50 hover:text-[#0074A6] rounded-xl font-medium text-sm transition group w-full">
                <i class="far fa-user w-5 text-center text-gray-400 group-hover:text-[#0074A6] transition shrink-0"></i> Profil
            </a>
            
            <a href="{{ url('/dashboard/kurir/riwayat') }}" class="flex items-center gap-3 px-4 py-3 text-gray-500 hover:bg-gray-50 hover:text-[#0074A6] rounded-xl font-medium text-sm transition group w-full">
                <i class="fas fa-history w-5 text-center text-gray-400 group-hover:text-[#0074A6] transition shrink-0"></i> Riwayat Tugas
            </a>
            
            {{-- MENU PENGATURAN (Aktif) --}}
            <a href="{{ url('/dashboard/kurir/pengaturan') }}" class="flex items-center gap-3 px-4 py-3 bg-blue-50 text-[#0074A6] rounded-xl font-bold text-sm transition shadow-sm border border-blue-100 w-full">
                <i class="fas fa-cog w-5 text-center shrink-0"></i> Pengaturan
            </a>
        </nav>
    </aside>

    {{-- KONTEN UTAMA (Versi Final, Anti-Hantu & Anti-Nyangkut!) --}}
    <main class="flex-1 w-full h-full overflow-y-auto relative z-10 no-scrollbar bg-[#F8FAFC]">
        <div class="p-8 max-w-5xl mx-auto w-full">
            
            {{-- Header Section --}}
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-8 w-full">
                <div class="flex-1 min-w-0">
                    <h1 class="text-3xl font-bold text-gray-800 mb-2 truncate">Pengaturan Akun</h1>
                    <p class="text-sm text-gray-500 font-medium truncate">Kelola informasi pribadi dan preferensi notifikasi kurir Washly.</p>
                </div>
                <div class="shrink-0 bg-blue-50 border border-blue-100 text-blue-600 px-5 py-2.5 rounded-full text-xs font-bold flex items-center gap-2 shadow-sm">
                    <i class="fas fa-check-circle"></i> Status Kurir Aktif
                </div>
            </div>

            {{-- Grid Atas: Informasi Profil & Ganti Sandi --}}
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6 w-full">
                
                {{-- Kiri: Informasi Profil --}}
                <div class="lg:col-span-2 bg-white rounded-[2rem] p-8 shadow-sm border border-gray-100 w-full">
                    <div class="flex items-center gap-4 mb-8">
                        <div class="w-12 h-12 bg-blue-50 text-[#0074A6] rounded-xl flex items-center justify-center text-lg shrink-0">
                            <i class="far fa-user"></i>
                        </div>
                        <h2 class="text-xl font-bold text-gray-800">Informasi Profil</h2>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 w-full mb-6">
                        <div class="w-full flex flex-col">
                            <label class="block text-xs font-semibold text-gray-600 mb-2">Nama Lengkap</label>
                            <input type="text" value="Sal Priadi" class="w-full bg-slate-50 border border-slate-100 rounded-xl px-4 py-3.5 text-sm font-medium text-gray-700 focus:outline-none focus:border-blue-300 focus:ring-1 focus:ring-blue-300 transition">
                        </div>
                        <div class="w-full flex flex-col">
                            <label class="block text-xs font-semibold text-gray-600 mb-2">Nomor Telepon</label>
                            <input type="text" value="+62 812 3456 7890" class="w-full bg-slate-50 border border-slate-100 rounded-xl px-4 py-3.5 text-sm font-medium text-gray-700 focus:outline-none focus:border-blue-300 focus:ring-1 focus:ring-blue-300 transition">
                        </div>
                        <div class="w-full flex flex-col md:col-span-2">
                            <label class="block text-xs font-semibold text-gray-600 mb-2">Alamat Email</label>
                            <input type="text" value="salpri@gmail.com" readonly class="w-full bg-slate-50 border border-slate-100 rounded-xl px-4 py-3.5 text-sm font-medium text-gray-700 focus:outline-none cursor-not-allowed">
                            <p class="text-[10px] text-gray-400 mt-2 ml-1">Email hanya dapat diubah melalui admin pusat.</p>
                        </div>
                    </div>

                    <div class="flex justify-end w-full">
                        {{-- Tombol pake inline-style biar warnanya mustahil gaib --}}
                        <button class="text-white font-bold py-3.5 px-8 rounded-full text-sm shadow-md transition transform active:scale-95" style="background-color: #2f748f;">
                            Simpan Perubahan
                        </button>
                    </div>
                </div>

                {{-- Kanan: Ganti Sandi --}}
                <div class="bg-white rounded-[2rem] p-8 shadow-sm border border-gray-100 flex flex-col items-center justify-center text-center w-full">
                    <div class="w-20 h-20 bg-cyan-100 text-cyan-500 rounded-full flex items-center justify-center text-3xl mb-6 shadow-sm">
                        <i class="fas fa-key"></i>
                    </div>
                    <h2 class="text-xl font-bold text-gray-800 mb-3">Ganti Sandi</h2>
                    <p class="text-sm text-gray-500 font-medium mb-8 leading-relaxed">
                        Jaga keamanan akun dengan memperbarui kata sandi secara berkala.
                    </p>
                    <button class="w-full bg-slate-50 border border-slate-100 text-slate-700 hover:bg-slate-100 font-bold py-3.5 rounded-full text-sm transition">
                        Atur Kata Sandi
                    </button>
                </div>

            </div>

            {{-- ================= TIMPA MULAI DARI SINI ================= --}}

            {{-- Preferensi Notifikasi (Toggle Pake Flexbox, MUSTAHIL NYANGKUT!) --}}
            <div class="bg-white rounded-[2rem] p-8 shadow-sm border border-gray-100 mb-6 w-full">
                <div class="flex items-center gap-4 mb-8">
                    <div class="w-12 h-12 bg-cyan-100 text-cyan-600 rounded-xl flex items-center justify-center text-lg shrink-0">
                        <i class="far fa-bell"></i>
                    </div>
                    <div>
                        <h2 class="text-xl font-bold text-gray-800 mb-1">Preferensi Notifikasi</h2>
                        <p class="text-xs text-gray-500 font-medium">Atur bagaimana kami mengabari Anda tentang tugas baru.</p>
                    </div>
                </div>

                <div class="space-y-4 w-full">
                    {{-- Toggle 1 (ON - Nyender Kanan) --}}
                    <div class="flex items-center justify-between p-5 border border-slate-100 rounded-2xl hover:bg-slate-50/50 transition">
                        <div class="flex items-center gap-4 min-w-0 flex-1">
                            <div class="w-10 h-10 bg-blue-50 text-blue-500 rounded-xl flex items-center justify-center shrink-0">
                                <i class="fas fa-file-alt"></i>
                            </div>
                            <div class="min-w-0 flex-1">
                                <h4 class="text-sm font-bold text-gray-800 truncate">Tugas Baru Tersedia</h4>
                                <p class="text-[11px] text-gray-500 truncate mt-0.5">Notifikasi saat ada laundry yang perlu diambil.</p>
                            </div>
                        </div>
                        <div class="w-12 h-7 rounded-full flex items-center justify-end px-1 shrink-0 ml-4 cursor-pointer" style="background-color: #00AEEF;">
                            <div class="w-5 h-5 bg-white rounded-full shadow-sm"></div>
                        </div>
                    </div>

                    {{-- Toggle 2 (ON - Nyender Kanan) --}}
                    <div class="flex items-center justify-between p-5 border border-slate-100 rounded-2xl hover:bg-slate-50/50 transition">
                        <div class="flex items-center gap-4 min-w-0 flex-1">
                            <div class="w-10 h-10 bg-blue-50 text-blue-500 rounded-xl flex items-center justify-center shrink-0">
                                <i class="fas fa-comment-dots"></i>
                            </div>
                            <div class="min-w-0 flex-1">
                                <h4 class="text-sm font-bold text-gray-800 truncate">Pesan Pelanggan</h4>
                                <p class="text-[11px] text-gray-500 truncate mt-0.5">Pemberitahuan chat langsung dari pengguna.</p>
                            </div>
                        </div>
                        <div class="w-12 h-7 rounded-full flex items-center justify-end px-1 shrink-0 ml-4 cursor-pointer" style="background-color: #00AEEF;">
                            <div class="w-5 h-5 bg-white rounded-full shadow-sm"></div>
                        </div>
                    </div>

                    {{-- Toggle 3 (OFF - Nyender Kiri) --}}
                    <div class="flex items-center justify-between p-5 border border-slate-100 rounded-2xl hover:bg-slate-50/50 transition">
                        <div class="flex items-center gap-4 min-w-0 flex-1">
                            <div class="w-10 h-10 bg-blue-50 text-blue-500 rounded-xl flex items-center justify-center shrink-0">
                                <i class="fas fa-bullhorn"></i>
                            </div>
                            <div class="min-w-0 flex-1">
                                <h4 class="text-sm font-bold text-gray-800 truncate">Promo & Pengumuman</h4>
                                <p class="text-[11px] text-gray-500 truncate mt-0.5">Info bonus kurir dan event khusus Washly.</p>
                            </div>
                        </div>
                        <div class="w-12 h-7 bg-gray-200 rounded-full flex items-center justify-start px-1 shrink-0 ml-4 cursor-pointer">
                            <div class="w-5 h-5 bg-white rounded-full shadow-sm"></div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- ================= TIMPA FULL BLOK INI AJA ================= --}}
            <div class="bg-red-50 border border-red-100 rounded-[2rem] p-8 flex justify-between items-center w-full mb-6">
                
                {{-- Bagian Kiri (Icon & Teks) --}}
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 bg-red-100 text-red-500 rounded-full flex items-center justify-center text-lg shrink-0">
                        <i class="fas fa-sign-out-alt"></i>
                    </div>
                    <div>
                        <h2 class="text-lg font-bold text-gray-800 mb-1">Selesaikan Sesi</h2>
                        <p class="text-xs text-gray-500 font-medium">Keluar dari akun kurir Anda sekarang.</p>
                    </div>
                </div>

                {{-- Bagian Kanan (Tombol Merah Dipaku Lebarnya) --}}
                <button class="text-white font-bold py-3.5 px-8 rounded-full text-sm shadow-md transition hover:opacity-90 whitespace-nowrap" style="background-color: #C9302C; min-width: 140px;">
                    Keluar
                </button>
                
            </div>

            {{-- ================= SAMPAI SINI AJA ================= --}}

            {{-- Footer Text --}}
            <div class="text-center text-[10px] font-medium text-gray-400 mt-10 mb-4">
                Washly © 2026
            </div>

        </div>
    </main>

</body>
</html>