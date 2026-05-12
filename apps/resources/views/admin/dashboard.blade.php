<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Washly</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-gray-50">
    <div class="flex min-h-screen">
        
        {{-- ========================================== --}}
        {{-- SIDEBAR --}}
        {{-- ========================================== --}}
        <div class="w-64 bg-gray-900 text-white p-6">
            <h1 class="text-2xl font-bold text-blue-400 mb-8">Washly Admin</h1>
            <nav class="space-y-4">
                <button onclick="bukaHalaman('tab-dashboard', this)" class="menu-btn block w-full text-left py-2 px-4 bg-blue-600 rounded transition">
                    Dashboard
                </button>
                <button onclick="bukaHalaman('tab-pesanan', this)" class="menu-btn block w-full text-left py-2 px-4 hover:bg-gray-800 rounded transition">
                    Kelola Pesanan
                </button>
                <button onclick="bukaHalaman('tab-pembayaran', this)" class="menu-btn block w-full text-left py-2 px-4 hover:bg-gray-800 rounded transition">
                    Pembayaran
                </button>
                <button onclick="bukaHalaman('tab-kurir', this)" class="menu-btn block w-full text-left py-2 px-4 hover:bg-gray-800 rounded transition">
                    Kurir
                </button>
                    <button onclick="bukaHalaman('tab-riwayat-admin', this)" class="menu-btn block w-full text-left py-2 px-4 hover:bg-gray-800 rounded transition">
                    Riwayat Admin
                </button>
                    <button onclick="bukaHalaman('tab-pengaturan', this)" class="menu-btn block w-full text-left py-2 px-4 hover:bg-gray-800 rounded transition">
                    Pengaturan
                </button>
                
                <form action="{{ route('logout') }}" method="POST" class="mt-10">
                    @csrf
                    <button type="submit" class="text-red-400 hover:text-red-300 px-4 py-2 w-full text-left">Keluar</button>
                </form>
            </nav>
        </div>

        {{-- ========================================== --}}
        {{-- KONTEN UTAMA --}}
        {{-- ========================================== --}}
        <div class="flex-1 p-10">
            <h2 id="judul-halaman" class="text-3xl font-bold mb-8 text-gray-800">Dashboard</h2>

            {{-- HALAMAN 1: DASHBOARD --}}
            <div id="tab-dashboard" class="tab-konten block">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                    <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                        <p class="text-xs font-bold text-gray-400 uppercase">Pesanan Hari Ini</p>
                        <p class="text-2xl font-bold text-gray-800">{{ $stats['pesanan_baru'] ?? 0 }}</p>
                    </div>
                    <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                        <p class="text-xs font-bold text-gray-400 uppercase">Pendapatan Hari Ini</p>
                        <p class="text-2xl font-bold text-green-600">Rp {{ number_format($stats['total_pendapatan'] ?? 0, 0, ',', '.') }}</p>
                    </div>
                    <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                        <p class="text-xs font-bold text-gray-400 uppercase">Perlu Diproses</p>
                        <p class="text-2xl font-bold text-orange-500">{{ $stats['perlu_diproses'] ?? 0 }}</p>
                    </div>
                    <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                        <p class="text-xs font-bold text-gray-400 uppercase">Total Kurir</p>
                        <p class="text-2xl font-bold text-blue-600">{{ $stats['kurir_aktif'] ?? 0 }}</p>
                    </div>
                </div>

                <div class="bg-white rounded-2xl shadow-sm border p-6">
                    <h3 class="font-bold text-gray-800 mb-4">Pesanan Terbaru</h3>
                    <table class="w-full text-left">
                        <tbody class="divide-y">
                            @foreach($pesanan_terbaru ?? [] as $pt)
                            <tr>
                                <td class="py-3 font-bold text-sm">{{ $pt->pelanggan->nama }}</td>
                                <td class="py-3 text-sm text-gray-500">{{ $pt->layanan->nama_layanan }}</td>
                                <td class="py-3"><span class="px-2 py-1 bg-blue-50 text-blue-600 text-[10px] font-bold rounded-full">{{ strtoupper($pt->status) }}</span></td>
                                <td class="py-3 text-xs text-gray-400 text-right">{{ $pt->created_at->diffForHumans() }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- HALAMAN 2: KELOLA PESANAN (CARD VIEW + MODAL LENGKAP) --}}
            <div id="tab-pesanan" class="tab-konten hidden">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($semua_pesanan ?? [] as $p)
                    <div class="bg-white rounded-3xl p-6 shadow-sm border border-gray-100">
                        <div class="flex justify-between items-start mb-4">
                            <span class="text-[10px] font-black text-gray-400 tracking-widest">WS-{{ $p->id_pesanan }}</span>
                            <span class="px-3 py-1 text-[10px] font-bold rounded-full uppercase bg-blue-100 text-blue-600">
                                {{ str_replace('_', ' ', $p->status) }}
                            </span>
                        </div>
                        <div class="flex items-center gap-4 mb-6">
                            <div class="w-12 h-12 rounded-full bg-orange-100 flex items-center justify-center text-orange-600 font-bold text-xl">
                                {{ strtoupper(substr($p->pelanggan->nama, 0, 1)) }}
                            </div>
                            <div>
                                <h4 class="font-bold text-gray-800">{{ $p->pelanggan->nama }}</h4>
                                <p class="text-xs text-gray-400">{{ $p->pelanggan->no_hp }}</p>
                            </div>
                        </div>
                        <button onclick="document.getElementById('modal-{{ $p->id_pesanan }}').classList.remove('hidden')" 
                            class="w-full py-2 border-2 border-blue-400 text-blue-500 rounded-full font-bold text-sm hover:bg-blue-50 transition">
                            Detail & Update
                        </button>
                    </div>

                    {{-- ========================================== --}}
                    {{-- MODAL DETAIL (VERSI LENGKAP INFO PELANGGAN) --}}
                    {{-- ========================================== --}}
                    <div id="modal-{{ $p->id_pesanan }}" class="fixed inset-0 bg-black bg-opacity-60 hidden flex items-center justify-center z-50 p-4">
                        <div class="bg-white rounded-3xl w-full max-w-4xl overflow-hidden shadow-2xl animate-in fade-in zoom-in duration-200">
                            
                            {{-- Header --}}
                            <div class="bg-gray-900 p-6 flex justify-between items-center text-white">
                                <div>
                                    <h3 class="text-xl font-black uppercase tracking-tight">Detail Pesanan #{{ $p->id_pesanan }}</h3>
                                    <p class="text-xs text-gray-400 mt-1">Masuk pada: {{ $p->created_at->format('d M Y, H:i') }}</p>
                                </div>
                                <button onclick="document.getElementById('modal-{{ $p->id_pesanan }}').classList.add('hidden')" class="text-gray-400 hover:text-white text-2xl">&times;</button>
                            </div>

                            {{-- Body --}}
                            <div class="p-8 grid grid-cols-1 md:grid-cols-2 gap-10">
                                
                                {{-- KOLOM KIRI: INFO PELANGGAN & BUKTI --}}
                                <div class="space-y-6">
                                    <div>
                                        <h4 class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-3">Informasi Pelanggan</h4>
                                        <div class="bg-gray-50 p-5 rounded-2xl border border-gray-100">
                                            <p class="text-lg font-bold text-gray-800">{{ $p->pelanggan->nama }}</p>
                                            <p class="text-sm text-gray-600 mt-1"><i class="fab fa-whatsapp mr-2 text-green-500"></i> {{ $p->pelanggan->no_hp }}</p>
                                            <p class="text-sm text-gray-600 mt-2 flex items-start"><i class="fas fa-map-marker-alt mr-2 mt-1 text-red-400"></i> {{ $p->pelanggan->alamat }}</p>
                                        </div>
                                    </div>

                                    <div>
                                        <h4 class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-3">Bukti Pembayaran</h4>
                                        @if($p->bukti_bayar)
                                            <a href="{{ asset('storage/'.$p->bukti_bayar) }}" target="_blank" class="group relative block rounded-2xl overflow-hidden border-2 border-gray-100">
                                                <img src="{{ asset('storage/'.$p->bukti_bayar) }}" class="w-full h-48 object-cover group-hover:scale-105 transition duration-300">
                                                <div class="absolute inset-0 bg-black bg-opacity-20 flex items-center justify-center opacity-0 group-hover:opacity-100 transition">
                                                    <span class="bg-white text-gray-900 px-4 py-2 rounded-full font-bold text-xs shadow-lg">Klik Perbesar</span>
                                                </div>
                                            </a>
                                        @else
                                            <div class="py-12 text-center border-2 border-dashed rounded-2xl bg-gray-50 text-gray-400 italic text-sm">
                                                Belum ada bukti pembayaran ege.
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                {{-- KOLOM KANAN: FORM UPDATE ADMIN --}}
                                <div class="bg-white">
                                    <h4 class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-3">Aksi Admin</h4>
                                    <form action="{{ route('admin.pesanan.update', $p->id_pesanan) }}" method="POST" class="space-y-5">
                                        @csrf @method('PATCH')
                                        
                                        <div>
                                            <label class="block text-xs font-bold text-gray-600 mb-2">Update Berat (Kg)</label>
                                            <div class="relative">
                                                <input type="number" step="0.1" name="berat" value="{{ $p->berat }}" class="w-full bg-gray-50 border-gray-200 rounded-xl py-3 px-4 focus:ring-2 focus:ring-blue-400 transition" placeholder="Contoh: 3.5">
                                                <span class="absolute right-4 top-3 text-gray-400 font-bold">Kg</span>
                                            </div>
                                            @if($p->total_harga > 0)
                                                <p class="mt-2 text-sm font-black text-green-600">Estimasi Biaya: Rp {{ number_format($p->total_harga, 0, ',', '.') }}</p>
                                            @endif
                                        </div>

                                        <div>
                                            <label class="block text-xs font-bold text-gray-600 mb-2">Tugaskan Kurir</label>
                                            <select name="id_kurir" class="w-full bg-gray-50 border-gray-200 rounded-xl py-3 px-4 focus:ring-2 focus:ring-blue-400">
                                                <option value="">-- Pilih Kurir --</option>
                                                @foreach($daftar_kurir ?? [] as $k)
                                                    <option value="{{ $k->id_kurir }}" {{ $p->id_kurir == $k->id_kurir ? 'selected' : '' }}>{{ $k->nama }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div>
                                            <label class="block text-xs font-bold text-gray-600 mb-2">Status Pesanan</label>
                                            <select name="status" class="w-full bg-blue-50 text-blue-700 border-blue-100 rounded-xl py-3 px-4 font-bold focus:ring-2 focus:ring-blue-400">
                                                <option value="menunggu_pickup" {{ $p->status == 'menunggu_pickup' ? 'selected' : '' }}>Jemput Sekarang</option>
                                                <option value="menunggu_timbang" {{ $p->status == 'menunggu_timbang' ? 'selected' : '' }}>Sudah Dijemput (Tunggu Timbang)</option>
                                                <option value="menunggu_bayar" {{ $p->status == 'menunggu_bayar' ? 'selected' : '' }}>Menunggu Pembayaran User</option>
                                                <option value="menunggu_konfirmasi" {{ $p->status == 'menunggu_konfirmasi' ? 'selected' : '' }}>Validasi Pembayaran User</option>
                                                <option value="proses" {{ $p->status == 'proses' ? 'selected' : '' }}>Sedang Dicuci</option>
                                                <option value="delivery" {{ $p->status == 'delivery' ? 'selected' : '' }}>Siap Diantar Kurir</option>
                                                <option value="selesai" {{ $p->status == 'selesai' ? 'selected' : '' }}>Selesai / Berhasil</option>
                                            </select>
                                        </div>

                                        <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-black py-4 rounded-xl shadow-lg transition duration-200 uppercase tracking-widest text-xs">
                                            Simpan Perubahan
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            {{-- HALAMAN 3: KURIR (UDAH BALIK JIR!) --}}
            <div id="tab-kurir" class="tab-konten hidden">
                <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-xl font-bold text-gray-800">Manajemen Petugas Kurir</h3>
                        <button onclick="document.getElementById('form-tambah-kurir').classList.toggle('hidden')" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm font-bold shadow-md transition">+ Tambah Akun Kurir</button>
                    </div>

                    {{-- Form Tambah Kurir --}}
                    <div id="form-tambah-kurir" class="hidden mb-8 bg-gray-50 p-6 rounded-2xl border border-dashed border-gray-300">
                        <h4 class="text-xs font-bold text-gray-400 uppercase mb-4 tracking-widest">Buat Akun Kurir Baru</h4>
                        <form action="{{ route('admin.kurir.store') }}" method="POST" class="grid grid-cols-1 md:grid-cols-4 gap-4">
                            @csrf
                            <input type="text" name="nama" placeholder="Nama Lengkap" class="border-gray-200 rounded-xl p-3 text-sm focus:ring-blue-500" required>
                            <input type="text" name="no_hp" placeholder="Nomor HP (WA)" class="border-gray-200 rounded-xl p-3 text-sm focus:ring-blue-500" required>
                            <input type="text" name="username" placeholder="Username Login" class="border-gray-200 rounded-xl p-3 text-sm focus:ring-blue-500" required>
                            <input type="password" name="password" placeholder="Password" class="border-gray-200 rounded-xl p-3 text-sm focus:ring-blue-500" required>
                            <button type="submit" class="bg-green-600 hover:bg-green-700 text-white rounded-xl font-bold col-span-full py-3 shadow-md transition">Simpan & Aktifkan Kurir</button>
                        </form>
                    </div>

                    {{-- Tabel Daftar Kurir --}}
                    <div class="overflow-x-auto">
                        <table class="w-full text-left">
                            <thead class="bg-gray-50 border-b text-xs uppercase text-gray-400">
                                <tr>
                                    <th class="p-4 font-bold">Nama Petugas</th>
                                    <th class="p-4 font-bold">Username</th>
                                    <th class="p-4 font-bold">No HP</th>
                                    <th class="p-4 font-bold text-center">Status</th>
                                    <th class="p-4 font-bold text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                @forelse($daftar_kurir ?? [] as $kurir)
                                <tr class="hover:bg-gray-50 transition">
                                    <td class="p-4 font-bold text-gray-800">{{ $kurir->nama }}</td>
                                    <td class="p-4 text-sm text-gray-500 font-mono bg-gray-100 px-2 rounded">{{ $kurir->username }}</td>
                                    <td class="p-4 text-sm text-gray-600">{{ $kurir->no_hp }}</td>
                                    <td class="p-4 text-center">
                                        @php $sedangTugas = $kurir->pesanan()->whereIn('status', ['menunggu_pickup', 'delivery'])->count(); @endphp
                                        <span class="px-2 py-1 text-[10px] font-bold rounded-full uppercase {{ $sedangTugas > 0 ? 'bg-orange-100 text-orange-600' : 'bg-green-100 text-green-600' }}">
                                            {{ $sedangTugas > 0 ? 'Sibuk' : 'Aktif / Standby' }}
                                        </span>
                                    </td>
                                    <td class="p-4 text-center">
                                        <button class="text-blue-500 hover:text-blue-700 font-bold text-xs mr-3"><i class="fas fa-edit"></i> Edit</button>
                                        <button class="text-red-500 hover:text-red-700 font-bold text-xs"><i class="fas fa-trash"></i> Hapus</button>
                                    </td>
                                </tr>
                                @empty
                                <tr><td colspan="5" class="p-10 text-center text-gray-400 italic">Belum ada kurir ege, rekrut si Budi gih!</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            {{-- HALAMAN LAIN (KOSONGAN) --}}
            <div id="tab-pembayaran" class="tab-konten hidden"><div class="p-20 text-center text-gray-400 italic">Gunakan halaman Kelola Pesanan untuk validasi bayar ege.</div></div>
            <div id="tab-kurir" class="tab-konten hidden"><div class="p-20 text-center text-gray-400 italic">Data Kurir.</div></div>

        </div> 
    </div>

    <script>
        function bukaHalaman(idTab, elemen) {
            document.querySelectorAll('.tab-konten').forEach(el => { el.classList.add('hidden'); el.classList.remove('block'); });
            const target = document.getElementById(idTab);
            target.classList.remove('hidden');
            target.classList.add('block');
            document.getElementById('judul-halaman').innerText = elemen.innerText.trim();
            document.querySelectorAll('.menu-btn').forEach(btn => { btn.classList.remove('bg-blue-600', 'rounded'); btn.classList.add('hover:bg-gray-800'); });
            elemen.classList.add('bg-blue-600', 'rounded');
        }
    </script>
</body>
</html>