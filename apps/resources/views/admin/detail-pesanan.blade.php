<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Pesanan Admin - Washly</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-[#F8FAFC] h-screen font-sans text-slate-800 flex overflow-hidden antialiased">

    {{-- SIDEBAR KONSISTEN --}}
    <aside class="w-64 bg-white border-r border-gray-100 flex flex-col h-full shrink-0 relative z-20">
        {{-- Logo --}}
        <div class="p-6">
            <img src="{{ asset('images/w-a.svg') }}" alt="Washly Admin" class="h-8">
        </div>

        {{-- Profil Admin --}}
        <div class="px-6 flex items-center gap-3 mb-8">
            <div class="w-10 h-10 rounded-full border border-gray-100 overflow-hidden shadow-sm">
                <img src="https://ui-avatars.com/api/?name=Admin&background=00AEEF&color=fff" alt="Admin Profile" class="w-full h-full object-cover">
            </div>
            <div>
                <h3 class="font-bold text-sm text-gray-800 leading-tight">Admin</h3>
                <p class="text-[10px] text-gray-500 font-medium mt-0.5">Panel Kendali Utama</p>
            </div>
        </div>

        {{-- Menu Navigasi --}}
        <nav class="flex-1 px-4 space-y-1">
            <a href="{{ url('/dashboard/admin') }}" class="flex items-center gap-3 px-4 py-3 text-gray-500 hover:bg-gray-50 hover:text-[#0074A6] rounded-xl font-medium text-sm transition group">
                <i class="fas fa-th-large w-5 text-center text-gray-400 group-hover:text-[#0074A6] transition"></i> Dashboard
            </a>
            
            {{-- MENU KELOLA PESANAN --}}
            <a href="{{ url('/dashboard/admin/pesanan') }}" class="flex items-center gap-3 px-4 py-3 bg-blue-50 text-[#0074A6] rounded-xl font-bold text-sm transition">
                <i class="fas fa-clipboard-list w-5 text-center"></i> Kelola Pesanan
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
            <a href="{{ url('/dashboard/admin/pengaturan') }}" class="flex items-center gap-3 px-4 py-3 text-gray-500 hover:bg-gray-50 hover:text-[#0074A6] rounded-xl font-medium text-sm transition group">
                <i class="fas fa-cog w-5 text-center text-gray-400 group-hover:text-[#0074A6] transition"></i> Pengaturan
            </a>
        </nav>

        {{-- Tombol Tambah Layanan --}}
        <div class="p-5 mt-auto">
            <button class="w-full bg-[#005B82] hover:bg-[#004B6D] text-white py-3 rounded-xl text-sm font-bold shadow-md transition active:scale-95 flex items-center justify-center gap-2">
                <i class="fas fa-plus"></i> Tambah Layanan
            </button>
        </div>
    </aside>

    {{-- KONTEN UTAMA (Kanan) --}}
    <main class="flex-1 h-full overflow-y-auto relative z-10 p-10">
        
        <div class="max-w-6xl mx-auto">
            
            {{-- HEADER HALAMAN --}}
            <div class="flex justify-between items-start mb-8">
                <div class="flex items-center gap-5">
                    <a href="{{ url('/dashboard/admin/pesanan') }}" class="w-12 h-12 bg-gray-200/70 hover:bg-gray-300 text-gray-700 rounded-full flex items-center justify-center transition">
                        <i class="fas fa-arrow-left"></i>
                    </a>
                    <div>
                        <h1 class="text-2xl font-bold text-gray-800">Detail Pesanan</h1>
                        <p class="text-sm text-gray-500 mt-0.5">ID: #WS-{{ $pesanan->id_pesanan }}</p>
                    </div>
                </div>

                @php
                    $badgeClass = 'bg-gray-100 text-gray-600';
                    if(in_array($pesanan->status, ['menunggu_pickup', 'menunggu_timbang'])) { $badgeClass = 'bg-orange-100 text-orange-600'; }
                    elseif(in_array($pesanan->status, ['menunggu_bayar', 'menunggu_konfirmasi'])) { $badgeClass = 'bg-blue-100 text-blue-600'; }
                    elseif($pesanan->status == 'proses') { $badgeClass = 'bg-purple-100 text-purple-600'; }
                    elseif($pesanan->status == 'delivery') { $badgeClass = 'bg-cyan-100 text-cyan-600'; }
                    elseif($pesanan->status == 'selesai') { $badgeClass = 'bg-green-100 text-green-600'; }
                @endphp
                <div class="{{ $badgeClass }} px-5 py-2.5 rounded-full text-sm font-bold flex items-center gap-2 uppercase tracking-wide">
                    <span class="w-2 h-2 rounded-full bg-current"></span> {{ str_replace('_', ' ', $pesanan->status) }}
                </div>
            </div>

            {{-- GRID KONTEN --}}
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                
                {{-- KOLOM KIRI (Info & Detail) --}}
                <div class="lg:col-span-2 space-y-6">
                    
                    {{-- Card Informasi Pelanggan --}}
                    <div class="bg-white rounded-3xl p-7 border border-gray-100 shadow-sm">
                        <div class="flex items-center gap-3 mb-6">
                            <i class="far fa-user text-[#0074A6] text-lg"></i>
                            <h2 class="text-lg font-bold text-gray-800">Informasi Pelanggan</h2>
                        </div>
                        <div class="grid grid-cols-2 gap-6 mb-6">
                            <div>
                                <p class="text-[11px] text-gray-500 font-medium mb-1">Nama Pelanggan</p>
                                <p class="font-semibold text-gray-800">{{ $pesanan->pelanggan->nama ?? 'N/A' }}</p>
                            </div>
                            <div>
                                <p class="text-[11px] text-gray-500 font-medium mb-1">Nomor Telepon</p>
                                <p class="font-semibold text-gray-800"><i class="fab fa-whatsapp text-green-500"></i> {{ $pesanan->pelanggan->no_hp ?? '-' }}</p>
                            </div>
                        </div>
                        <div>
                            <p class="text-[11px] text-gray-500 font-medium mb-2">Alamat Pickup / Delivery</p>
                            <div class="bg-[#F8FAFC] p-4 rounded-2xl flex items-center gap-3 text-sm font-medium text-gray-700">
                                <i class="fas fa-map-marker-alt text-gray-400"></i>
                                {{ $pesanan->alamat ?? ($pesanan->pelanggan->alamat ?? 'Tidak ada alamat') }}
                            </div>
                        </div>
                    </div>

                    {{-- Card Detail Layanan --}}
                    <div class="bg-white rounded-3xl p-7 border border-gray-100 shadow-sm relative overflow-hidden">
                        <div class="absolute top-0 right-0 w-40 h-40 bg-cyan-50/50 rounded-bl-full -mr-10 -mt-10 pointer-events-none"></div>
                        <div class="flex items-center gap-3 mb-6 relative z-10">
                            <i class="fas fa-receipt text-[#0074A6] text-lg"></i>
                            <h2 class="text-lg font-bold text-gray-800">Detail Layanan</h2>
                        </div>
                        <div class="flex justify-between items-center mb-6 relative z-10 border-b border-gray-100 pb-6">
                            <div>
                                <h3 class="font-bold text-gray-800 text-lg">{{ $pesanan->layanan->nama_layanan ?? 'N/A' }}</h3>
                                <p class="text-sm text-gray-500 mt-1">Metode: Cash / Transfer Mandiri</p>
                            </div>
                            <div class="text-right">
                                <p class="text-[11px] text-gray-400 font-medium mb-1">Tarif</p>
                                <p class="font-bold text-[#0074A6] text-lg">Rp {{ number_format($pesanan->layanan->harga_per_kg ?? 0, 0, ',', '.') }} / kg</p>
                            </div>
                        </div>
                        <div class="grid grid-cols-2 gap-6 relative z-10">
                            <div>
                                <p class="text-[11px] text-gray-500 font-medium mb-1">Waktu Masuk Order</p>
                                <p class="font-semibold text-gray-800 text-sm">{{ $pesanan->created_at->format('d M Y, H:i') }}</p>
                            </div>
                            <div>
                                <p class="text-[11px] text-gray-500 font-medium mb-1">Sudah Diupload Bukti Bayar?</p>
                                @if($pesanan->bukti_bayar)
                                    <a href="{{ asset('storage/'.$pesanan->bukti_bayar) }}" target="_blank" class="text-xs font-bold text-green-600 hover:underline flex items-center gap-1 mt-1">
                                        <i class="fas fa-image"></i> Lihat Foto Bukti Bayar
                                    </a>
                                @else
                                    <p class="text-xs font-semibold text-gray-400 italic mt-1">Belum ada bukti bayar</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                {{-- KOLOM KANAN (Aksi Admin Form) --}}
                <div class="bg-white rounded-3xl p-7 border border-gray-100 shadow-sm flex flex-col">
                    <div class="flex items-center gap-3 mb-6">
                        <i class="fas fa-sliders-h text-[#0074A6] text-lg"></i>
                        <h2 class="text-lg font-bold text-gray-800">Aksi Admin</h2>
                    </div>
                    
                    {{-- DIHUBUNGKAN KE ROUTE UPDATE PESANAN BACKEND KAMU --}}
                    <form action="{{ route('admin.pesanan.update', $pesanan->id_pesanan) }}" method="POST" class="flex-1 flex flex-col">
                        @csrf 
                        @method('PATCH')
                        
                        {{-- Input Berat --}}
                        <div class="mb-5">
                            <label class="block text-[12px] font-medium text-gray-800 mb-2">Input Berat Aktual (kg)</label>
                            <div class="relative">
                                <input type="number" step="0.1" name="berat" id="input-berat" value="{{ $pesanan->berat ?? '' }}" class="w-full bg-[#F1F5F9] border-none rounded-2xl py-3.5 px-4 text-gray-800 font-semibold focus:ring-2 focus:ring-[#0074A6] outline-none transition" placeholder="0.0" />
                                <span class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 font-medium text-sm">kg</span>
                            </div>
                            <p class="text-[10px] text-gray-400 mt-2 font-medium">*Mengisi berat otomatis mengalkulasi tagihan pembayaraan.</p>
                        </div>

                        {{-- Total Harga Pill (Bisa live hitung via JS di bawah) --}}
                        <div class="border border-gray-100 rounded-full py-4 px-6 flex justify-between items-center mb-6 bg-white shadow-sm">
                            <span class="text-xs font-medium text-gray-500">Total Harga</span>
                            <span class="text-2xl font-black text-[#0074A6]" id="live-total-harga">Rp {{ number_format($pesanan->total_harga ?? 0, 0, ',', '.') }}</span>
                        </div>

                        {{-- Tugaskan Petugas Kurir (Ditambahkan kembali agar fungsional) --}}
                        <div class="mb-5">
                            <label class="block text-[12px] font-medium text-gray-800 mb-2">Tugaskan Kurir</label>
                            <div class="relative">
                                <select name="id_kurir" class="w-full bg-[#F1F5F9] border-none rounded-2xl py-3.5 px-4 text-gray-700 font-semibold appearance-none focus:ring-2 focus:ring-[#0074A6] outline-none transition cursor-pointer">
                                    <option value="">-- Pilih Petugas Kurir --</option>
                                    @foreach($daftar_kurir ?? [] as $k)
                                        <option value="{{ $k->id_kurir }}" {{ $pesanan->id_kurir == $k->id_kurir ? 'selected' : '' }}>{{ $k->nama }}</option>
                                    @endforeach
                                </select>
                                <i class="fas fa-chevron-down absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 pointer-events-none text-xs"></i>
                            </div>
                        </div>

                        {{-- Update Status --}}
                        <div class="mb-8">
                            <label class="block text-[12px] font-medium text-gray-800 mb-2">Update Status Alur</label>
                            <div class="relative">
                                <select name="status" id="dropdown-status" class="w-full bg-[#F1F5F9] border-none rounded-2xl py-3.5 px-4 text-gray-700 font-semibold appearance-none focus:ring-2 focus:ring-[#0074A6] outline-none transition cursor-pointer">
                                    <option value="menunggu_pickup" {{ $pesanan->status == 'menunggu_pickup' ? 'selected' : '' }}>Jemput Sekarang</option>
                                    <option value="menunggu_timbang" {{ $pesanan->status == 'menunggu_timbang' ? 'selected' : '' }}>Sudah Dijemput (Tunggu Timbang)</option>
                                    <option value="menunggu_bayar" {{ $pesanan->status == 'menunggu_bayar' ? 'selected' : '' }}>Menunggu Pembayaran User</option>
                                    <option value="menunggu_konfirmasi" {{ $pesanan->status == 'menunggu_konfirmasi' ? 'selected' : '' }}>Validasi Pembayaran User</option>
                                    <option value="proses" {{ $pesanan->status == 'proses' ? 'selected' : '' }}>Sedang Dicuci (Proses)</option>
                                    <option value="delivery" {{ $pesanan->status == 'delivery' ? 'selected' : '' }}>Siap Diantar Kurir</option>
                                    <option value="selesai" {{ $pesanan->status == 'selesai' ? 'selected' : '' }}>Selesai / Berhasil</option>
                                </select>
                                <i class="fas fa-chevron-down absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 pointer-events-none text-xs"></i>
                            </div>
                        </div>

                        {{-- Tombol Aksi --}}
                        <div class="mt-auto space-y-3 pt-4 border-t border-gray-50">
                            <button type="submit" class="w-full bg-[#005B82] hover:bg-[#004B6D] text-white py-3.5 rounded-full text-sm font-bold shadow-lg shadow-blue-900/20 transition active:scale-95 text-center uppercase tracking-wider">
                                Simpan Perubahan
                            </button>
                            <a href="{{ url('/dashboard/admin/pesanan') }}" class="block w-full text-center text-gray-500 hover:bg-gray-50 py-3.5 rounded-full text-sm font-bold transition">
                                Kembali ke Daftar
                            </a>
                        </div>
                    </form>

                </div>
            </div>

        </div>
    </main>

    {{-- SCRIPT SAKTI: LIVE COUNT HARGA + AUTO STATUS JAVASCRIPT --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const inputBerat = document.getElementById('input-berat');
            const dropdownStatus = document.getElementById('dropdown-status');
            const liveTotalHarga = document.getElementById('live-total-harga');
            
            // Ambil data tarif harga per kilo dari backend laravel blade
            const hargaPerKg = {{ $pesanan->layanan->harga_per_kg ?? 0 }};
            const statusAwal = "{{ $pesanan->status }}";

            if(inputBerat) {
                inputBerat.addEventListener('input', function() {
                    const berat = parseFloat(this.value) || 0;
                    
                    // 1. Hitung Live Total Biaya Laundry di Layar
                    const totalCalculated = berat * hargaPerKg;
                    liveTotalHarga.innerText = "Rp " + totalCalculated.toLocaleString('id-ID');

                    // 2. Fitur Auto Status: otomatis geser dropdown ke menunggu_bayar
                    if (berat > 0 && dropdownStatus.value === 'menunggu_timbang') {
                        dropdownStatus.value = 'menunggu_bayar';
                    }
                });
            }
        });
    </script>
</body>
</html>