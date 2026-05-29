<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengaturan - Washly Admin</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-[#F8FAFC] h-screen font-sans text-slate-800 flex overflow-hidden">

    {{-- SIDEBAR KONSISTEN --}}
    <aside class="w-64 bg-white border-r border-gray-100 flex flex-col h-full shrink-0 relative z-20">
        <div class="p-6">
            <img src="{{ asset('images/w-a.svg') }}" alt="Washly Admin" class="h-8">
        </div>

        {{-- SINKRONISASI PROFIL SIDEBAR --}}
        <div class="px-6 flex items-center gap-3 mb-8">
            <div class="w-10 h-10 rounded-full border border-gray-100 overflow-hidden shadow-sm">
                <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::guard('admin')->user()?->nama ?? Auth::guard('admin')->user()?->username ?? 'Admin') }}&background=00AEEF&color=fff" alt="Admin Profile" class="w-full h-full object-cover">
            </div>
            <div>
                <h3 class="font-bold text-sm text-gray-800 leading-tight truncate w-32" title="{{ Auth::guard('admin')->user()?->nama ?? Auth::guard('admin')->user()?->username ?? 'Admin' }}">
                    {{ Auth::guard('admin')->user()?->nama ?? Auth::guard('admin')->user()?->username ?? 'Admin' }}
                </h3>
                <p class="text-[10px] text-gray-500 font-medium mt-0.5">Panel Kendali Utama</p>
            </div>
        </div>

        <nav class="flex-1 px-4 space-y-1">
            <a href="{{ url('/dashboard/admin') }}" class="flex items-center gap-3 px-4 py-3 text-gray-500 hover:bg-gray-50 hover:text-[#0074A6] rounded-xl font-medium text-sm transition group">
                <i class="fas fa-th-large w-5 text-center text-gray-400 group-hover:text-[#0074A6] transition"></i> Dashboard
            </a>
            <a href="{{ url('/dashboard/admin/pesanan') }}" class="flex items-center gap-3 px-4 py-3 text-gray-500 hover:bg-gray-50 hover:text-[#0074A6] rounded-xl font-medium text-sm transition group">
                <i class="fas fa-clipboard-list w-5 text-center text-gray-400 group-hover:text-[#0074A6] transition"></i> Kelola Pesanan
            </a>
            <a href="{{ url('/dashboard/admin/pembayaran') }}" class="flex items-center gap-3 px-4 py-3 text-gray-500 hover:bg-gray-50 hover:text-[#0074A6] rounded-xl font-medium text-sm transition group">
                <i class="fas fa-wallet w-5 text-center text-gray-400 group-hover:text-[#0074A6] transition"></i> Pembayaran
            </a>
            <a href="{{ url('/dashboard/admin/kurir') }}" class="flex items-center gap-3 px-4 py-3 text-gray-500 hover:bg-gray-50 hover:text-[#0074A6] rounded-xl font-medium text-sm transition group">
                <i class="fas fa-motorcycle w-5 text-center text-gray-400 group-hover:text-[#0074A6] transition"></i> Kurir
            </a>
            <a href="{{ url('/dashboard/admin/riwayat') }}" class="flex items-center gap-3 px-4 py-3 text-gray-500 hover:bg-gray-50 hover:text-[#0074A6] rounded-xl font-medium text-sm transition group">
                <i class="fas fa-history w-5 text-center text-gray-400 group-hover:text-[#0074A6] transition"></i> Riwayat Admin
            </a>
            
            {{-- MENU PENGATURAN (Aktif) --}}
            <a href="{{ url('/dashboard/admin/pengaturan') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl font-bold text-sm transition mb-1" style="background-color: #EFF6FF; color: #1D5D8A;">
                <i class="fas fa-cog w-5 text-center"></i> Pengaturan
            </a>

            {{-- FORM TOMBOL LOG OUT DI SIDEBAR NAVIGASI --}}
            <form action="{{ route('logout') }}" method="POST" class="block w-full">
                @csrf
                <button type="submit" class="w-full flex items-center gap-3 px-4 py-3 text-red-500 hover:bg-red-50 rounded-xl font-medium text-sm transition group cursor-pointer">
                    <i class="fas fa-sign-out-alt w-5 text-center text-red-400 group-hover:text-red-600 transition"></i> Keluar Akun
                </button>
            </form>
        </nav>

        <div class="p-5 mt-auto">
            <button class="w-full text-white py-3 rounded-xl text-sm font-bold shadow-md transition active:scale-95 flex items-center justify-center gap-2 hover:opacity-90" style="background-color: #005B82;">
                <i class="fas fa-plus"></i> Tambah Layanan
            </button>
        </div>
    </aside>

    {{-- KONTEN UTAMA --}}
    <main class="flex-1 overflow-y-auto relative z-10">
        
        {{-- Hiasan Background Blobs --}}
        <div class="absolute bottom-0 right-0 w-[400px] h-[400px] bg-cyan-50/50 rounded-full blur-[100px] pointer-events-none z-0"></div>

        <div class="p-10 max-w-6xl mx-auto relative z-10">
            
            {{-- Header --}}
            <div class="mb-8">
                <h1 class="text-3xl font-black text-gray-800 mb-2">Pengaturan</h1>
                <p class="text-sm text-gray-500 font-medium">Kelola informasi admin, profil toko, and tarif layanan Washly Anda.</p>
            </div>

            <form action="{{ route('admin.pengaturan.update') }}" method="POST" class="grid grid-cols-1 lg:grid-cols-12 gap-8">
            @csrf
                
                {{-- KOLOM KIRI (Informasi Admin & Profil Toko) --}}
                <div class="lg:col-span-7 space-y-8">
                    
                    {{-- Card 1: Informasi Admin --}}
                    <div class="bg-white p-7 rounded-3xl border border-gray-100 shadow-sm relative overflow-hidden">
                        {{-- Aksen biru di pojok kanan atas --}}
                        <div class="absolute top-0 right-0 w-32 h-32 bg-blue-50 rounded-bl-full -mr-4 -mt-4 pointer-events-none z-0"></div>
                        
                        <h2 class="text-xl font-bold text-gray-800 mb-6 relative z-10">Informasi Admin</h2>
                        
                        <div class="flex flex-col sm:flex-row items-center sm:items-start gap-6 relative z-10">
                            {{-- Foto Profil Dinamis Bawaan --}}
                            <div class="relative w-24 h-24 shrink-0">
                                <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::guard('admin')->user()?->nama ?? Auth::guard('admin')->user()?->username ?? 'Admin') }}&background=1D5D8A&color=fff&size=150" alt="Admin Profile" class="w-full h-full rounded-full object-cover border-4 border-white shadow-sm">
                                <button type="button" class="absolute bottom-0 right-0 w-8 h-8 bg-white rounded-full flex items-center justify-center text-[#1D5D8A] shadow-md border border-gray-100 hover:bg-gray-50 transition">
                                    <i class="fas fa-pencil-alt text-xs"></i>
                                </button>
                            </div>
                            
                            {{-- Input Nama Lengkap (SINKRON DB) --}}
                            <div class="w-full">
                                <label class="block text-xs font-semibold text-gray-600 mb-2">Nama Lengkap</label>
                                <input type="text" name="nama" value="{{ Auth::guard('admin')->user()?->nama ?? Auth::guard('admin')->user()?->username }}" class="w-full bg-slate-100 border-none rounded-xl py-3.5 px-4 text-sm font-semibold text-gray-700 focus:outline-none focus:ring-2 focus:ring-[#1D5D8A] transition">
                            </div>
                        </div>
                    </div>

                    {{-- Card 2: Profil Toko --}}
                    <div class="bg-white p-7 rounded-3xl border border-gray-100 shadow-sm">
                        <h2 class="text-xl font-bold text-gray-800 mb-6">Profil Toko</h2>
                        
                        <div class="space-y-5">
                            {{-- Nama Laundry --}}
                            <div>
                                <label class="block text-xs font-semibold text-gray-600 mb-2">Nama Laundry</label>
                                <div class="w-full bg-slate-100 rounded-xl flex items-center px-4 focus-within:ring-2 focus-within:ring-[#1D5D8A] transition overflow-hidden">
                                    <i class="fas fa-store text-gray-400 shrink-0"></i>
                                    <input type="text" name="nama_toko" value="Washly Premium Laundry" class="w-full bg-transparent border-none py-3.5 pl-4 pr-0 text-sm font-semibold text-gray-700 focus:outline-none focus:ring-0">
                                </div>
                            </div>
                            
                            {{-- Alamat --}}
                            <div>
                                <label class="block text-xs font-semibold text-gray-600 mb-2">Alamat</label>
                                <div class="w-full bg-slate-100 rounded-xl flex items-center px-4 py-3.5 focus-within:ring-2 focus-within:ring-[#1D5D8A] transition overflow-hidden">
                                    <i class="fas fa-map-marker-alt text-gray-400 shrink-0"></i>
                                    <textarea name="alamat_toko" rows="2" class="w-full bg-transparent border-none p-0 pl-4 text-sm font-semibold text-gray-700 focus:outline-none focus:ring-0 resize-none">Jl. Tamansiswa No. 99, Sekaran.</textarea>
                                </div>
                            </div>
                            
                            {{-- Jam Operasional --}}
                            <div>
                                <label class="block text-xs font-semibold text-gray-600 mb-2">Jam Operasional</label>
                                <div class="flex items-center gap-4">
                                    <div class="w-full bg-slate-100 rounded-xl flex items-center px-4 focus-within:ring-2 focus-within:ring-[#1D5D8A] transition overflow-hidden flex-1">
                                        <i class="far fa-clock text-gray-400 shrink-0"></i>
                                        <input type="time" name="jam_buka" value="08:00" class="w-full bg-transparent border-none py-3.5 pl-4 pr-0 text-sm font-semibold text-gray-700 focus:outline-none focus:ring-0 cursor-pointer">
                                    </div>
                                    <span class="text-xs font-bold text-gray-400">hingga</span>
                                    <div class="w-full bg-slate-100 rounded-xl flex items-center px-4 focus-within:ring-2 focus-within:ring-[#1D5D8A] transition overflow-hidden flex-1">
                                        <i class="far fa-clock text-gray-400 shrink-0"></i>
                                        <input type="time" name="jam_tutup" value="21:00" class="w-full bg-transparent border-none py-3.5 pl-4 pr-0 text-sm font-semibold text-gray-700 focus:outline-none focus:ring-0 cursor-pointer">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- KOLOM KANAN (Tarif & Layanan) --}}
                <div class="lg:col-span-5 flex flex-col h-full">
                    
{{-- Card 3: Tarif --}}
                    <div class="bg-slate-100 p-7 rounded-3xl border border-slate-200 shadow-sm flex-1 flex flex-col">
                        <h2 class="text-xl font-bold text-gray-800 mb-3 flex items-center gap-2">
                            <i class="fas fa-money-bill-wave text-[#1D5D8A]"></i> Tarif & Layanan
                        </h2>
                        <p class="text-sm text-gray-500 font-medium mb-8 leading-relaxed">
                            Sesuaikan harga per kilogram dan biaya pengiriman standar.
                        </p>

                        <div class="space-y-5 flex-1">
                            {{-- Tarif Cuci --}}
                            <div>
                                <label class="block text-[11px] font-bold text-gray-500 mb-2">Tarif Cuci (per kg)</label>
                                <div class="flex items-center bg-white rounded-xl px-4 py-3 shadow-sm focus-within:ring-2 focus-within:ring-[#1D5D8A] transition">
                                    <span class="text-gray-400 font-bold mr-2 text-sm">Rp</span>
                                    <input type="text" name="tarif_cuci" value="{{ intval($tarif_cuci) }}" class="bg-transparent border-none w-full font-bold text-gray-700 text-sm focus:outline-none p-0 m-0">
                                </div>
                            </div>

                            {{-- Tarif Setrika --}}
                            <div>
                                <label class="block text-[11px] font-bold text-gray-500 mb-2">Tarif Setrika (per kg)</label>
                                <div class="flex items-center bg-white rounded-xl px-4 py-3 shadow-sm focus-within:ring-2 focus-within:ring-[#1D5D8A] transition">
                                    <span class="text-gray-400 font-bold mr-2 text-sm">Rp</span>
                                    <input type="text" name="tarif_setrika" value="{{ intval($tarif_setrika) }}" class="bg-transparent border-none w-full font-bold text-gray-700 text-sm focus:outline-none p-0 m-0">
                                </div>
                            </div>

                            {{-- Tarif Cuci + Setrika --}}
                            <div>
                                <label class="block text-[11px] font-bold text-gray-500 mb-2">Tarif Cuci + Setrika (per kg)</label>
                                <div class="flex items-center bg-white rounded-xl px-4 py-3 shadow-sm focus-within:ring-2 focus-within:ring-[#1D5D8A] transition">
                                    <span class="text-gray-400 font-bold mr-2 text-sm">Rp</span>
                                    <input type="text" name="tarif_combo" value="{{ intval($tarif_combo) }}" class="bg-transparent border-none w-full font-bold text-gray-700 text-sm focus:outline-none p-0 m-0">
                                </div>
                            </div>

                            {{-- Ongkir Flat (Khusus ongkir biarkan statis karena nggak ada di tabel layanans) --}}
                            <div class="pt-4 border-t border-slate-200 mt-2">
                                <label class="block text-[11px] font-bold text-gray-500 mb-2">Ongkir Flat (PickUp - Delivery)</label>
                                <div class="flex items-center justify-between bg-white rounded-xl px-4 py-3 shadow-sm focus-within:ring-2 focus-within:ring-[#1D5D8A] transition">
                                    <div class="flex items-center flex-1">
                                        <span class="text-gray-400 font-bold mr-2 text-sm">Rp</span>
                                        <input type="text" name="tarif_ongkir" value="5000" class="bg-transparent border-none w-full font-bold text-gray-700 text-sm focus:outline-none p-0 m-0">
                                    </div>
                                    <i class="fas fa-truck text-[#1D5D8A]"></i>
                                </div>
                            </div>
                        </div>

                        {{-- Tombol Simpan --}}
                        <button type="submit" class="w-full text-white py-3.5 mt-8 rounded-2xl text-sm font-bold shadow-lg transition active:scale-95 flex items-center justify-center gap-2 hover:opacity-90" style="background-color: #005B82;">
                            <i class="fas fa-save"></i> Simpan
                        </button>
                    </div>
                </div>

            </form>
        </div>
    </main>

</body>
</html>