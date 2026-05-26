<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Kurir - Washly</title>
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
            
            {{-- MENU PROFIL (Aktif) --}}
            <a href="{{ url('/dashboard/kurir/profil') }}" class="flex items-center gap-3 px-4 py-3 bg-blue-50 text-[#0074A6] rounded-xl font-bold text-sm transition shadow-sm border border-blue-100 w-full">
                <i class="far fa-user w-5 text-center shrink-0"></i> Profil
            </a>
            
            <a href="#" class="flex items-center gap-3 px-4 py-3 text-gray-500 hover:bg-gray-50 hover:text-[#0074A6] rounded-xl font-medium text-sm transition group w-full">
                <i class="fas fa-history w-5 text-center text-gray-400 group-hover:text-[#0074A6] transition shrink-0"></i> Riwayat Tugas
            </a>
            <a href="#" class="flex items-center gap-3 px-4 py-3 text-gray-500 hover:bg-gray-50 hover:text-[#0074A6] rounded-xl font-medium text-sm transition group w-full">
                <i class="fas fa-cog w-5 text-center text-gray-400 group-hover:text-[#0074A6] transition shrink-0"></i> Pengaturan
            </a>
        </nav>

        {{-- Tombol Keluar --}}
        <div class="p-6 mt-auto border-t border-gray-50 w-full shrink-0">
            <button class="w-full bg-[#D9534F] hover:bg-[#C9302C] text-white py-3 rounded-xl text-sm font-bold shadow-md transition active:scale-95 flex items-center justify-center gap-2">
                <i class="fas fa-sign-out-alt shrink-0"></i> Keluar
            </button>
        </div>
    </aside>

    {{-- KONTEN UTAMA --}}
    <main class="flex-1 w-full h-full overflow-y-auto w-full relative z-10 no-scrollbar">
        <div class="p-8 max-w-6xl mx-auto w-full h-full">
            
            {{-- Dibagi 2 Kolom Pakai Flexbox --}}
            <div class="flex flex-col lg:flex-row gap-8 w-full h-full">
                
                {{-- ================= KOLOM KIRI (1/3 Lebar) ================= --}}
                <div class="w-full lg:w-1/3 flex flex-col gap-6 h-full min-w-0">
                    
                    {{-- 1. Card Profil Utama --}}
                    <div class="w-full bg-white rounded-[2rem] p-8 shadow-sm border border-gray-100 flex flex-col items-center text-center">
                        <div class="relative mb-5">
                            <div class="w-28 h-28 rounded-full p-1 bg-gradient-to-br from-blue-100 to-blue-50 shrink-0">
                                <img src="https://i.pravatar.cc/150?img=14" alt="Sal Priadi" class="w-full h-full rounded-full object-cover border-4 border-white shadow-sm">
                            </div>
                            <span class="absolute bottom-1 right-2 w-5 h-5 bg-[#22C55E] border-4 border-white rounded-full shrink-0"></span>
                        </div>
                        
                        <h2 class="text-xl font-bold text-gray-800 truncate w-full">Sal Priadi</h2>
                        <p class="text-xs text-gray-400 font-medium mt-1 mb-5 truncate w-full">ID Karyawan: #KWS-00892</p>
                        
                        <span class="bg-blue-50 text-[#0074A6] px-5 py-2 rounded-full text-xs font-bold flex items-center gap-2 max-w-full">
                            <i class="fas fa-check-circle shrink-0"></i> Mitra Aktif
                        </span>
                    </div>

                    {{-- 2. Statistik Total Tugas (Rating DiHapus & w-full) --}}
                    <div class="w-full">
                        <div class="w-full bg-white rounded-[2rem] p-6 shadow-sm border border-gray-100 flex flex-col items-center text-center justify-center">
                            <i class="fas fa-clipboard-list text-[#0074A6] text-xl mb-3 shrink-0"></i>
                            <h3 class="text-xl font-black text-gray-800">1,248</h3>
                            <p class="text-[10px] text-gray-400 font-bold uppercase tracking-wider mt-1 truncate w-full">Total Tugas</p>
                        </div>
                    </div>

                    {{-- 3. Aksi Cepat (w-full & Sama Panjang) --}}
                    <div class="w-full bg-slate-50/70 rounded-[2rem] p-6 border border-slate-100 h-full flex flex-col">
                        <h3 class="text-sm font-bold text-gray-800 mb-4 px-2">Aksi Cepat</h3>
                        <div class="space-y-3 w-full flex-1">
                            <button class="w-full bg-white px-5 py-4 rounded-2xl shadow-sm border border-gray-100 flex justify-between items-center hover:shadow-md transition group overflow-hidden">
                                <div class="flex items-center gap-3 text-sm font-bold text-gray-700 group-hover:text-[#0074A6] transition min-w-0 flex-1">
                                    <i class="fas fa-pen text-[#0074A6] shrink-0"></i> 
                                    <span class="truncate">Edit Profil</span>
                                </div>
                                <i class="fas fa-chevron-right text-gray-300 text-xs group-hover:text-[#0074A6] transition shrink-0 ml-2"></i>
                            </button>
                            <button class="w-full bg-white px-5 py-4 rounded-2xl shadow-sm border border-gray-100 flex justify-between items-center hover:shadow-md transition group overflow-hidden">
                                <div class="flex items-center gap-3 text-sm font-bold text-gray-700 group-hover:text-[#0074A6] transition min-w-0 flex-1">
                                    <i class="fas fa-lock text-[#0074A6] shrink-0"></i> 
                                    <span class="truncate">Ganti Kata Sandi</span>
                                </div>
                                <i class="fas fa-chevron-right text-gray-300 text-xs group-hover:text-[#0074A6] transition shrink-0 ml-2"></i>
                            </button>
                        </div>
                    </div>

                </div>

                {{-- ================= KOLOM KANAN (2/3 Lebar) ================= --}}
                <div class="w-full lg:w-2/3 flex flex-col gap-8 h-full min-w-0">
                    
                    {{-- 4. Card Informasi Akun (Gap Diperbaiki, Anti Nempel!) --}}
                    <div class="w-full bg-white rounded-[2rem] p-8 shadow-sm border border-gray-100">
                        <div class="flex items-center gap-4 mb-8">
                            <div class="w-12 h-12 bg-blue-50 text-[#0074A6] rounded-xl flex items-center justify-center text-lg shrink-0">
                                <i class="far fa-user"></i>
                            </div>
                            <h2 class="text-lg font-bold text-gray-800">Informasi Akun</h2>
                        </div>

                        {{-- Pakai gap-6 yang udah pasti dibaca Tailwind --}}
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 w-full">
                            
                            {{-- Baris 1 Kiri: Email --}}
                            <div class="w-full flex flex-col">
                                <label class="block text-[11px] font-bold text-gray-400 uppercase tracking-wider mb-2">Alamat Email</label>
                                <div class="bg-slate-50 border border-slate-100 rounded-xl px-4 py-3.5 flex items-center gap-3 text-sm font-semibold text-gray-700 w-full overflow-hidden">
                                    <i class="far fa-envelope text-gray-400 shrink-0"></i> 
                                    <span class="truncate flex-1">salpri@gmail.com</span>
                                </div>
                            </div>
                            
                            {{-- Baris 1 Kanan: Telepon --}}
                            <div class="w-full flex flex-col">
                                <label class="block text-[11px] font-bold text-gray-400 uppercase tracking-wider mb-2">Nomor Telepon</label>
                                <div class="bg-slate-50 border border-slate-100 rounded-xl px-4 py-3.5 flex items-center gap-3 text-sm font-semibold text-gray-700 w-full overflow-hidden">
                                    <i class="fas fa-phone-alt text-gray-400 text-xs shrink-0"></i> 
                                    <span class="truncate flex-1">+62 812-3456-7890</span>
                                </div>
                            </div>
                            
                            {{-- Baris 2 Kiri: Plat (Ditambah mt-2 biar makin lega) --}}
                            <div class="w-full flex flex-col mt-2">
                                <label class="block text-[11px] font-bold text-gray-400 uppercase tracking-wider mb-2">Nomor Plat Kendaraan</label>
                                <div class="bg-slate-50 border border-slate-100 rounded-xl px-4 py-3.5 flex items-center gap-3 text-sm font-black text-gray-800 w-full overflow-hidden">
                                    <i class="fas fa-motorcycle text-gray-400 text-xs shrink-0"></i> 
                                    <span class="truncate flex-1">B 1234 WSH</span>
                                </div>
                            </div>
                            
                            {{-- Baris 2 Kanan: Bergabung --}}
                            <div class="w-full flex flex-col mt-2">
                                <label class="block text-[11px] font-bold text-gray-400 uppercase tracking-wider mb-2">Tanggal Bergabung</label>
                                <div class="bg-slate-50 border border-slate-100 rounded-xl px-4 py-3.5 flex items-center gap-3 text-sm font-semibold text-gray-700 w-full overflow-hidden">
                                    <i class="far fa-calendar-alt text-gray-400 shrink-0"></i> 
                                    <span class="truncate flex-1">12 Maret 2023</span>
                                </div>
                            </div>

                        </div>
                    </div>

                    {{-- 5. Card Kendaraan Terdaftar (Udah Di-Ruqyah Anti Nempel!) --}}
                    <div class="w-full bg-white rounded-[2rem] p-8 shadow-sm border border-gray-100">
                        <div class="flex items-center justify-between mb-8 w-full gap-4">
                            <div class="flex items-center gap-4 min-w-0 flex-1">
                                <div class="w-12 h-12 bg-[#E6F4F1] text-teal-600 rounded-xl flex items-center justify-center text-lg shrink-0">
                                    <i class="fas fa-truck-pickup"></i>
                                </div>
                                <h2 class="text-lg font-bold text-gray-800 truncate">Kendaraan Terdaftar</h2>
                            </div>
                            <span class="bg-[#E6F4F1] text-teal-600 border border-teal-100 px-4 py-1.5 rounded-full text-[11px] font-bold shrink-0 whitespace-nowrap">
                                Layak Jalan
                            </span>
                        </div>

                        {{-- Section Isi Bawah (Pakai gap-6 dan mt-4 manual biar 100% jalan!) --}}
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 pl-1 w-full">
                            
                            {{-- Baris 1 Kiri --}}
                            <div class="w-full flex flex-col">
                                <p class="text-[11px] font-bold text-gray-400 uppercase tracking-wider mb-1 truncate w-full">Merk & Model</p>
                                <p class="text-sm font-black text-gray-800 truncate w-full">Honda Vario 160</p>
                            </div>
                            
                            {{-- Baris 1 Kanan --}}
                            <div class="w-full flex flex-col">
                                <p class="text-[11px] font-bold text-gray-400 uppercase tracking-wider mb-1 truncate w-full">Tahun Kendaraan</p>
                                <p class="text-sm font-black text-gray-800 truncate w-full">2023</p>
                            </div>
                            
                            {{-- Baris 2 Kiri (Dikasih mt-4 biar jaraknya nyata) --}}
                            <div class="w-full flex flex-col mt-4">
                                <p class="text-[11px] font-bold text-gray-400 uppercase tracking-wider mb-1 truncate w-full">Warna</p>
                                <p class="text-sm font-black text-gray-800 truncate w-full">Matte Blue</p>
                            </div>
                            
                            {{-- Baris 2 Kanan --}}
                            <div class="w-full flex flex-col mt-4">
                                <p class="text-[11px] font-bold text-gray-400 uppercase tracking-wider mb-1 truncate w-full">Status Pajak</p>
                                <p class="text-sm font-black text-[#059669] truncate w-full">Hingga Nov 2026</p>
                            </div>

                        </div>
                    </div>

                </div>

            </div>

        </div>
    </main>

</body>
</html>