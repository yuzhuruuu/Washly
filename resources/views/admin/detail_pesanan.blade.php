<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Pesanan Admin - Washly</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    {{-- Alpine.js buat kalkulasi harga otomatis --}}
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-[#F8FAFC] font-sans text-slate-800 flex h-screen overflow-hidden">

    {{-- SIDEBAR --}}
    <aside class="w-64 bg-white border-r border-slate-100 flex flex-col justify-between hidden md:flex">
        <div>
            <div class="p-6">
                <div class="text-4xl font-black text-[#003B5C] flex items-baseline">
                    W<span class="text-xl ml-1">💙</span><span class="text-xs ml-1 bg-blue-100 text-blue-700 px-2 py-0.5 rounded-md">admin</span>
                </div>
            </div>
            <div class="px-6 mb-6 flex items-center">
                <img src="https://i.pravatar.cc/150?img=47" alt="Admin" class="w-10 h-10 rounded-full object-cover">
                <div class="ml-3">
                    <p class="text-sm font-bold">Admin</p>
                    <p class="text-[10px] text-slate-400">Panel Kendali Utama</p>
                </div>
            </div>
            <nav class="px-4 space-y-1">
                <a href="#" class="flex items-center px-4 py-3 text-slate-500 hover:bg-slate-50 hover:text-[#0074A6] rounded-xl font-semibold text-sm transition">
                    <i class="fas fa-th-large w-5"></i> Dashboard
                </a>
                <a href="#" class="flex items-center px-4 py-3 bg-[#F0F7FA] text-[#0074A6] rounded-xl font-bold text-sm transition">
                    <i class="fas fa-list-ul w-5"></i> Kelola Pesanan
                </a>
                <a href="#" class="flex items-center px-4 py-3 text-slate-500 hover:bg-slate-50 hover:text-[#0074A6] rounded-xl font-semibold text-sm transition">
                    <i class="fas fa-wallet w-5"></i> Pembayaran
                </a>
                <a href="#" class="flex items-center px-4 py-3 text-slate-500 hover:bg-slate-50 hover:text-[#0074A6] rounded-xl font-semibold text-sm transition">
                    <i class="fas fa-motorcycle w-5"></i> Kurir
                </a>
                <a href="#" class="flex items-center px-4 py-3 text-slate-500 hover:bg-slate-50 hover:text-[#0074A6] rounded-xl font-semibold text-sm transition">
                    <i class="fas fa-cog w-5"></i> Pengaturan
                </a>
            </nav>
        </div>
    </aside>

    {{-- KONTEN UTAMA --}}
    <main class="flex-1 flex flex-col h-screen overflow-y-auto relative">
        <div class="p-8 max-w-5xl mx-auto w-full">
            
            {{-- Header Navigasi --}}
            <div class="flex justify-between items-center mb-8">
                <div class="flex items-center">
                    <button class="w-10 h-10 bg-white border border-slate-200 rounded-full flex items-center justify-center text-slate-600 hover:bg-slate-50 transition mr-4">
                        <i class="fas fa-arrow-left"></i>
                    </button>
                    <div>
                        <h1 class="text-2xl font-bold text-slate-800">Detail Pesanan</h1>
                        <p class="text-sm text-slate-500">ID: #ORD-2023-8890</p>
                    </div>
                </div>
                <span class="bg-orange-100 text-orange-600 font-bold px-4 py-1.5 rounded-full text-sm">
                    <span class="inline-block w-2 h-2 rounded-full bg-orange-500 mr-2 animate-pulse"></span> Menunggu Proses
                </span>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                
                {{-- Kolom Kiri: Informasi Pelanggan & Layanan --}}
                <div class="lg:col-span-2 space-y-6">
                    
                    {{-- Info Pelanggan --}}
                    <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100">
                        <h3 class="text-lg font-bold mb-4 flex items-center text-slate-800">
                            <i class="far fa-user text-[#0074A6] mr-2"></i> Informasi Pelanggan
                        </h3>
                        <div class="grid grid-cols-2 gap-6 mb-4">
                            <div>
                                <p class="text-xs text-slate-400 font-bold mb-1">Nama Pelanggan</p>
                                <p class="font-semibold text-slate-700">Leonardo D</p>
                            </div>
                            <div>
                                <p class="text-xs text-slate-400 font-bold mb-1">Nomor Telepon</p>
                                <p class="font-semibold text-slate-700">+62 812 3456 7890</p>
                            </div>
                        </div>
                        <div class="bg-slate-50 p-4 rounded-xl border border-slate-100 flex items-start">
                            <i class="fas fa-map-marker-alt text-slate-400 mt-1 mr-3"></i>
                            <div>
                                <p class="text-xs text-slate-400 font-bold mb-1">Alamat Pickup / Delivery</p>
                                <p class="text-sm font-semibold text-slate-700">Jl. Raya Banaran Blok Z No. 77</p>
                            </div>
                        </div>
                    </div>

                    {{-- Info Layanan --}}
                    <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100">
                        <h3 class="text-lg font-bold mb-4 flex items-center text-slate-800">
                            <i class="fas fa-tshirt text-[#0074A6] mr-2"></i> Detail Layanan
                        </h3>
                        <div class="flex justify-between items-center border-b border-slate-100 pb-4 mb-4">
                            <div>
                                <p class="font-bold text-slate-800">Cuci Kiloan Reguler</p>
                                <p class="text-xs text-slate-500">Cuci + Setrika (3 Hari)</p>
                            </div>
                            <div class="text-right">
                                <p class="text-xs text-slate-400 font-bold mb-1">Estimasi</p>
                                <p class="font-bold text-[#0074A6]">Rp 12.000 / kg</p>
                            </div>
                        </div>
                        <div class="grid grid-cols-2 gap-6">
                            <div>
                                <p class="text-xs text-slate-400 font-bold mb-1">Jadwal Pickup</p>
                                <p class="font-semibold text-slate-700">15 Mai 2026, 10:00</p>
                            </div>
                            <div>
                                <p class="text-xs text-slate-400 font-bold mb-1">Estimasi Selesai</p>
                                <p class="font-semibold text-slate-700">18 Mai 2026</p>
                            </div>
                        </div>
                    </div>

                </div>

                {{-- Kolom Kanan: Aksi Admin dengan Alpine.js --}}
                {{-- Harga 12000 diset di x-data, nanti bisa ditarik dari database backend --}}
                <div class="lg:col-span-1" x-data="{ berat: 3.5, hargaPerKg: 12000, get total() { return this.berat * this.hargaPerKg } }">
                    <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100">
                        <h3 class="text-lg font-bold mb-6 flex items-center text-slate-800">
                            <i class="fas fa-sliders-h text-[#0074A6] mr-2"></i> Aksi Admin
                        </h3>
                        
                        <form action="#" method="POST">
                            @csrf
                            
                            {{-- Input Berat --}}
                            <div class="mb-6">
                                <label class="block text-xs font-bold text-slate-600 mb-2">Input Berat Aktual (kg)</label>
                                <div class="relative">
                                    <input type="number" step="0.1" name="berat" x-model="berat" class="w-full bg-slate-100 border-none rounded-xl px-4 py-3 font-bold text-slate-700 focus:ring-2 focus:ring-[#0074A6]">
                                    <span class="absolute right-4 top-3 text-slate-400 font-bold">kg</span>
                                </div>
                                <p class="text-[10px] text-slate-400 mt-1">*Berat minimum 2 kg.</p>
                            </div>

                            {{-- Total Harga Dinamis --}}
                            <div class="mb-6 border-2 border-blue-100 rounded-xl p-4 flex justify-between items-center bg-blue-50/50">
                                <span class="text-sm font-bold text-slate-600">Total Harga</span>
                                {{-- x-text otomatis memformat angka jadi format Rupiah --}}
                                <span class="text-2xl font-black text-[#0074A6]" x-text="'Rp ' + new Intl.NumberFormat('id-ID').format(total)"></span>
                            </div>

                            {{-- Update Status --}}
                            <div class="mb-6">
                                <label class="block text-xs font-bold text-slate-600 mb-2">Update Status</label>
                                <select name="status" class="w-full bg-slate-100 border-none rounded-xl px-4 py-3 font-semibold text-slate-700 focus:ring-2 focus:ring-[#0074A6] appearance-none cursor-pointer">
                                    <option value="diproses">Dalam Proses</option>
                                    <option value="menunggu_bayar">Selesai Dicuci (Tunggu Bayar)</option>
                                    <option value="siap">Siap Diantar</option>
                                    <option value="selesai">Selesai</option>
                                </select>
                            </div>

                            {{-- Catatan --}}
                            <div class="mb-8">
                                <label class="block text-xs font-bold text-slate-600 mb-2">Catatan Internal</label>
                                <textarea name="catatan" rows="3" class="w-full bg-slate-100 border-none rounded-xl px-4 py-3 text-sm text-slate-700 focus:ring-2 focus:ring-[#0074A6]" placeholder="Tambahkan catatan khusus untuk pesanan ini..."></textarea>
                            </div>

                            {{-- Tombol --}}
                            <button type="submit" class="w-full bg-[#0074A6] hover:bg-[#005B82] text-white font-bold py-3 rounded-xl transition shadow-md shadow-blue-200 mb-3">
                                Simpan Perubahan
                            </button>
                            <button type="button" class="w-full bg-white text-red-500 hover:bg-red-50 font-bold py-3 rounded-xl transition">
                                Batalkan Pesanan
                            </button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </main>
</body>
</html>