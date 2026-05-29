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

        {{-- Profil Kurir (SINKRON DATA LOGIN) --}}
        <div class="px-6 flex items-center gap-3 mb-8 w-full">
            <div class="w-10 h-10 rounded-full border border-gray-100 overflow-hidden shadow-sm shrink-0">
                <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::guard('kurir')->user()?->nama ?? 'Kurir') }}&background=0074A6&color=fff&bold=true" alt="Profile" class="w-full h-full object-cover">
            </div>
            <div class="flex-1 min-w-0">
                <h3 class="font-bold text-sm text-[#0074A6] leading-tight truncate">{{ Auth::guard('kurir')->user()?->nama ?? 'Kurir Aktif' }}</h3>
                <p class="text-[10px] text-gray-500 font-medium mt-0.5">Kurir Washly</p>
            </div>
        </div>

        {{-- Menu Navigasi --}}
        <nav class="flex-1 px-4 space-y-2 w-full overflow-y-auto no-scrollbar">
            <a href="{{ route('kurir.dashboard') }}" class="flex items-center gap-3 px-4 py-3 text-gray-500 hover:bg-gray-50 hover:text-[#0074A6] rounded-xl font-medium text-sm transition group w-full">
                <i class="fas fa-th-large w-5 text-center text-gray-400 group-hover:text-[#0074A6] transition shrink-0"></i> Daftar Tugas
            </a>
            
            <a href="{{ route('kurir.profil') }}" class="flex items-center gap-3 px-4 py-3 text-gray-500 hover:bg-gray-50 hover:text-[#0074A6] rounded-xl font-medium text-sm transition group w-full">
                <i class="far fa-user w-5 text-center text-gray-400 group-hover:text-[#0074A6] transition shrink-0"></i> Profil
            </a>
            
            <a href="{{ route('kurir.riwayat') }}" class="flex items-center gap-3 px-4 py-3 text-gray-500 hover:bg-gray-50 hover:text-[#0074A6] rounded-xl font-medium text-sm transition group w-full">
                <i class="fas fa-history w-5 text-center text-gray-400 group-hover:text-[#0074A6] transition shrink-0"></i> Riwayat Tugas
            </a>
            
            {{-- MENU PENGATURAN (Aktif) --}}
            <a href="{{ route('kurir.pengaturan') }}" class="flex items-center gap-3 px-4 py-3 bg-blue-50 text-[#0074A6] rounded-xl font-bold text-sm transition shadow-sm border border-blue-100 w-full">
                <i class="fas fa-cog w-5 text-center shrink-0"></i> Pengaturan
            </a>
        </nav>
    </aside>

    {{-- KONTEN UTAMA --}}
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

            {{-- Flash Message Success/Error Backend --}}
            @if(session('success'))
                <div class="mb-4 p-4 bg-green-50 border border-green-200 text-green-600 rounded-2xl text-sm font-semibold">
                    {{ session('success') }}
                </div>
            @endif

            {{-- Grid Atas: Informasi Profil & Ganti Sandi --}}
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6 w-full">
                
                {{-- Kiri: Informasi Profil --}}
                <form action="{{ route('kurir.update.pengaturan') }}" method="POST" class="lg:col-span-2 bg-white rounded-[2rem] p-8 shadow-sm border border-gray-100 w-full flex flex-col justify-between">
                    @csrf
                    <div>
                        <div class="flex items-center gap-4 mb-8">
                            <div class="w-12 h-12 bg-blue-50 text-[#0074A6] rounded-xl flex items-center justify-center text-lg shrink-0">
                                <i class="far fa-user"></i>
                            </div>
                            <h2 class="text-xl font-bold text-gray-800">Informasi Profil</h2>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 w-full mb-6">
                            <div class="w-full flex flex-col">
                                <label class="block text-xs font-semibold text-gray-600 mb-2">Nama Lengkap</label>
                                <input type="text" name="nama" value="{{ Auth::guard('kurir')->user()?->nama }}" class="w-full bg-slate-50 border border-slate-100 rounded-xl px-4 py-3.5 text-sm font-medium text-gray-700 focus:outline-none focus:border-blue-300 focus:ring-1 focus:ring-blue-300 transition">
                            </div>
                            <div class="w-full flex flex-col">
                                <label class="block text-xs font-semibold text-gray-600 mb-2">Nomor Telepon</label>
                                <input type="text" name="no_hp" value="{{ Auth::guard('kurir')->user()?->no_hp }}" class="w-full bg-slate-50 border border-slate-100 rounded-xl px-4 py-3.5 text-sm font-medium text-gray-700 focus:outline-none focus:border-blue-300 focus:ring-1 focus:ring-blue-300 transition">
                            </div>
                            <div class="w-full flex flex-col md:col-span-2">
                                <label class="block text-xs font-semibold text-gray-600 mb-2">Username Sistem</label>
                                <input type="text" value="{{ Auth::guard('kurir')->user()?->username }}" readonly class="w-full bg-slate-50 border border-slate-100 rounded-xl px-4 py-3.5 text-sm font-medium text-gray-700 focus:outline-none cursor-not-allowed">
                                <p class="text-[10px] text-gray-400 mt-2 ml-1">Username hanya dapat diubah melalui admin pusat.</p>
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-end w-full mt-4">
                        <button type="submit" class="text-white font-bold py-3.5 px-8 rounded-full text-sm shadow-md transition transform active:scale-95 cursor-pointer" style="background-color: #2f748f;">
                            Simpan Perubahan
                        </button>
                    </div>
                </form>

                {{-- Kanan: Ganti Sandi --}}
                <div class="bg-white rounded-[2rem] p-8 shadow-sm border border-gray-100 flex flex-col items-center justify-center text-center w-full">
                    <div class="w-20 h-20 bg-cyan-100 text-cyan-500 rounded-full flex items-center justify-center text-3xl mb-6 shadow-sm">
                        <i class="fas fa-key"></i>
                    </div>
                    <h2 class="text-xl font-bold text-gray-800 mb-3">Ganti Sandi</h2>
                    <p class="text-sm text-gray-500 font-medium mb-8 leading-relaxed">
                        Jaga keamanan akun dengan memperbarui kata sandi secara berkala.
                    </p>
                    {{-- REVISI: Button bertipe button biasa, memicu fungsi JavaScript buat buka pop-up --}}
                    <button type="button" onclick="openModalPassword()" class="w-full bg-slate-50 border border-slate-100 text-slate-700 hover:bg-slate-100 font-bold py-3.5 rounded-full text-sm transition cursor-pointer">
                        Atur Kata Sandi
                    </button>
                </div>
            </div>

            {{-- Preferensi Notifikasi --}}
            <form action="{{ route('kurir.update.pengaturan') }}" method="POST" class="bg-white rounded-[2rem] p-8 shadow-sm border border-gray-100 mb-6 w-full">
                @csrf
                <input type="hidden" name="notification_action" value="1">
                
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
                    {{-- Toggle 1 --}}
                    <label class="flex items-center justify-between p-5 border border-slate-100 rounded-2xl hover:bg-slate-50/50 transition cursor-pointer">
                        <div class="flex items-center gap-4 min-w-0 flex-1">
                            <div class="w-10 h-10 bg-blue-50 text-blue-500 rounded-xl flex items-center justify-center shrink-0">
                                <i class="fas fa-file-alt"></i>
                            </div>
                            <div class="min-w-0 flex-1">
                                <h4 class="text-sm font-bold text-gray-800 truncate">Tugas Baru Tersedia</h4>
                                <p class="text-[11px] text-gray-500 truncate mt-0.5">Notifikasi saat ada laundry yang perlu diambil.</p>
                            </div>
                        </div>
                        <input type="checkbox" name="notif_tugas" class="sr-only peer" {{ Auth::guard('kurir')->user()?->notif_tugas ? 'checked' : '' }} onchange="this.form.submit()">
                        <div class="w-12 h-7 bg-gray-200 rounded-full flex items-center px-1 shrink-0 ml-4 transition-colors peer-checked:bg-[#00AEEF]">
                            <div class="w-5 h-5 bg-white rounded-full shadow-sm transition-transform transform peer-checked:translate-x-5"></div>
                        </div>
                    </label>

                    {{-- Toggle 2 --}}
                    <label class="flex items-center justify-between p-5 border border-slate-100 rounded-2xl hover:bg-slate-50/50 transition cursor-pointer">
                        <div class="flex items-center gap-4 min-w-0 flex-1">
                            <div class="w-10 h-10 bg-blue-50 text-blue-500 rounded-xl flex items-center justify-center shrink-0">
                                <i class="fas fa-comment-dots"></i>
                            </div>
                            <div class="min-w-0 flex-1">
                                <h4 class="text-sm font-bold text-gray-800 truncate">Pesan Pelanggan</h4>
                                <p class="text-[11px] text-gray-500 truncate mt-0.5">Pemberitahuan chat langsung dari pengguna.</p>
                            </div>
                        </div>
                        <input type="checkbox" name="notif_pesan" class="sr-only peer" {{ Auth::guard('kurir')->user()?->notif_pesan ? 'checked' : '' }} onchange="this.form.submit()">
                        <div class="w-12 h-7 bg-gray-200 rounded-full flex items-center px-1 shrink-0 ml-4 transition-colors peer-checked:bg-[#00AEEF]">
                            <div class="w-5 h-5 bg-white rounded-full shadow-sm transition-transform transform peer-checked:translate-x-5"></div>
                        </div>
                    </label>

                    {{-- Toggle 3 --}}
                    <label class="flex items-center justify-between p-5 border border-slate-100 rounded-2xl hover:bg-slate-50/50 transition cursor-pointer">
                        <div class="flex items-center gap-4 min-w-0 flex-1">
                            <div class="w-10 h-10 bg-blue-50 text-blue-500 rounded-xl flex items-center justify-center shrink-0">
                                <i class="fas fa-bullhorn"></i>
                            </div>
                            <div class="min-w-0 flex-1">
                                <h4 class="text-sm font-bold text-gray-800 truncate">Promo & Pengumuman</h4>
                                <p class="text-[11px] text-gray-500 truncate mt-0.5">Info bonus kurir dan event khusus Washly.</p>
                            </div>
                        </div>
                        <input type="checkbox" name="notif_promo" class="sr-only peer" {{ Auth::guard('kurir')->user()?->notif_promo ? 'checked' : '' }} onchange="this.form.submit()">
                        <div class="w-12 h-7 bg-gray-200 rounded-full flex items-center px-1 shrink-0 ml-4 transition-colors peer-checked:bg-[#00AEEF]">
                            <div class="w-5 h-5 bg-white rounded-full shadow-sm transition-transform transform peer-checked:translate-x-5"></div>
                        </div>
                    </label>
                </div>
            </form>

            {{-- Selesaikan Sesi --}}
            <div class="bg-red-50 border border-red-100 rounded-[2rem] p-8 flex justify-between items-center w-full mb-6">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 bg-red-100 text-red-500 rounded-full flex items-center justify-center text-lg shrink-0">
                        <i class="fas fa-sign-out-alt"></i>
                    </div>
                    <div>
                        <h2 class="text-lg font-bold text-gray-800 mb-1">Selesaikan Sesi</h2>
                        <p class="text-xs text-gray-500 font-medium">Keluar dari akun kurir Anda sekarang.</p>
                    </div>
                </div>

                {{-- Aksi Logout Backend Terintegrasi --}}
                <form action="{{ route('logout') }}" method="POST" class="shrink-0 m-0 p-0">
                    @csrf
                    <button type="submit" class="text-white font-bold py-3.5 px-8 rounded-full text-sm shadow-md transition hover:opacity-90 whitespace-nowrap cursor-pointer" style="background-color: #C9302C; min-width: 140px;">
                        Keluar
                    </button>
                </form>
            </div>

            {{-- Footer Text --}}
            <div class="text-center text-[10px] font-medium text-gray-400 mt-10 mb-4">
                Washly © 2026
            </div>

        </div>
    </main>

    {{-- Script Tambahan Untuk Efek Interaktif Transisi Geser Toggle Tanma Merusak Desain HTML --}}
    <style>
        .peer:checked ~ div .peer-checked\:translate-x-5 {
            transform: translateX(1.25rem);
        }
    </style>

    <div id="modalPassword" class="fixed inset-0 z-50 hidden flex items-center justify-center bg-slate-900/60 backdrop-blur-sm p-4 transition duration-300">
        <div class="bg-white rounded-[2.5rem] p-8 max-w-sm w-full shadow-2xl border border-gray-50 transform transition-all flex flex-col items-center text-center relative">
            
            {{-- Tombol Close Pojok Kanan Atas --}}
            <button type="button" onclick="closeModalPassword()" class="absolute right-6 top-6 text-gray-400 hover:text-gray-600 transition">
                <i class="fas fa-times text-lg"></i>
            </button>

            <div class="w-16 h-16 bg-cyan-50 text-cyan-500 rounded-2xl flex items-center justify-center text-2xl mb-4 shadow-sm">
                <i class="fas fa-lock"></i>
            </div>

            <h3 class="text-lg font-bold text-gray-800 mb-1">Perbarui Kata Sandi</h3>
            <p class="text-xs text-gray-400 font-medium mb-6">Masukkan kata sandi baru untuk akun kurir Anda.</p>

            {{-- Form Proses Update Password --}}
            <form action="{{ route('kurir.update.pengaturan') }}" method="POST" class="w-full m-0 p-0">
                @csrf
                <input type="hidden" name="password_action" value="1">
                
                <div class="w-full flex flex-col text-left mb-6">
                    <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-wider mb-2 ml-1">Kata Sandi Baru</label>
                    <input type="password" name="password_baru" placeholder="Minimal 6 karakter" class="w-full bg-slate-50 border border-slate-100 rounded-xl px-4 py-3.5 text-sm font-medium text-gray-700 focus:outline-none focus:border-blue-300 focus:ring-1 focus:ring-blue-300 transition" required>
                </div>

                <div class="flex gap-3 w-full">
                    <button type="button" onclick="closeModalPassword()" class="flex-1 bg-slate-50 border border-slate-100 text-slate-500 font-bold py-3.5 rounded-full text-xs transition hover:bg-slate-100">
                        Batal
                    </button>
                    <button type="submit" class="flex-1 text-white font-bold py-3.5 rounded-full text-xs shadow-md transition hover:opacity-90" style="background-color: #00AEEF;">
                        Simpan Sandi
                    </button>
                </div>
            </form>

        </div>
    </div>

    <script>
        function openModalPassword() {
            const modal = document.getElementById('modalPassword');
            modal.classList.remove('hidden');
        }

        function closeModalPassword() {
            const modal = document.getElementById('modalPassword');
            modal.classList.add('hidden');
        }

        window.onclick = function(event) {
            const modal = document.getElementById('modalPassword');
            if (event.target == modal) {
                modal.classList.add('hidden');
            }
        }
    </script>

</body>
</html>