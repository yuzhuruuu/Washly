<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Kurir - Washly Admin</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="bg-[#F8FAFC] h-screen font-sans text-slate-800 flex overflow-hidden">

    {{-- SIDEBAR KONSISTEN --}}
    <aside class="w-64 bg-white border-r border-gray-100 flex flex-col h-full shrink-0 relative z-20">
        <div class="p-6">
            <img src="{{ asset('images/w-a.svg') }}" alt="Washly Admin" class="h-8">
        </div>

        <div class="px-6 flex items-center gap-3 mb-8">
            <div class="w-10 h-10 rounded-full border border-gray-100 overflow-hidden shadow-sm">
                <img src="https://ui-avatars.com/api/?name=Admin&background=00AEEF&color=fff" alt="Admin Profile" class="w-full h-full object-cover">
            </div>
            <div>
                <h3 class="font-bold text-sm text-gray-800 leading-tight">Admin</h3>
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
            
            {{-- MENU KURIR (Aktif) --}}
            <a href="{{ url('/dashboard/admin/kurir') }}" class="flex items-center gap-3 px-4 py-3 bg-blue-50 text-[#0074A6] rounded-xl font-bold text-sm transition">
                <i class="fas fa-motorcycle w-5 text-center"></i> Kurir
            </a>
            
            <a href="{{ url('/dashboard/admin/riwayat') }}" class="flex items-center gap-3 px-4 py-3 text-gray-500 hover:bg-gray-50 hover:text-[#0074A6] rounded-xl font-medium text-sm transition group">
                <i class="fas fa-history w-5 text-center text-gray-400 group-hover:text-[#0074A6] transition"></i> Riwayat Admin
            </a>
            <a href="{{ url('/dashboard/admin/pengaturan') }}" class="flex items-center gap-3 px-4 py-3 text-gray-500 hover:bg-gray-50 hover:text-[#0074A6] rounded-xl font-medium text-sm transition group">
                <i class="fas fa-cog w-5 text-center text-gray-400 group-hover:text-[#0074A6] transition"></i> Pengaturan
            </a>
            <form action="{{ route('logout') }}" method="POST" class="block w-full">
                @csrf
                <button type="submit" class="w-full flex items-center gap-3 px-4 py-3 text-red-500 hover:bg-red-50 rounded-xl font-medium text-sm transition group cursor-pointer">
                    <i class="fas fa-sign-out-alt w-5 text-center text-red-400 group-hover:text-red-600 transition"></i> Keluar Akun
                </button>
            </form>
        </nav>

        <div class="p-5 mt-auto">
            <button class="w-full bg-[#005B82] hover:bg-[#004B6D] text-white py-3 rounded-xl text-sm font-bold shadow-md transition active:scale-95 flex items-center justify-center gap-2">
                <i class="fas fa-plus"></i> Tambah Layanan
            </button>
        </div>
    </aside>

    {{-- KONTEN UTAMA --}}
    <main class="flex-1 overflow-y-auto relative z-10" x-data="{ showModal: {{ $errors->has('username') ? 'true' : 'false' }} }">
        
        {{-- Hiasan Background Blobs --}}
        <div class="absolute top-0 right-0 w-[500px] h-[500px] bg-blue-50/50 rounded-full blur-[120px] pointer-events-none z-0"></div>

        <div class="p-10 max-w-6xl mx-auto relative z-10">
            
            {{-- Header & Tombol Tambah --}}
            <div class="flex justify-between items-center mb-8">
                <div>
                    <h1 class="text-4xl font-black text-gray-800 mb-2">Kelola Kurir</h1>
                    <p class="text-sm text-gray-500 font-medium">Pantau dan kelola tim pengantaran Anda dengan efisien.</p>
                </div>
                <button @click="showModal = true" class="text-white px-6 py-3 rounded-xl text-sm font-bold shadow-md transition active:scale-95 flex items-center gap-2 hover:opacity-90" style="background-color: #1D5D8A;">
                    <i class="fas fa-user-plus"></i> Tambah Kurir Baru
                </button>
            </div>

            {{-- Flash Notification Status --}}
            @if(session('success'))
                <div class="bg-green-100 border border-green-200 text-green-700 px-5 py-3 rounded-2xl text-xs font-bold shadow-sm mb-6 flex items-center gap-2">
                    <i class="fas fa-check-circle text-green-500"></i> {{ session('success') }}
                </div>
            @endif

            {{-- Action Bar --}}
            <div class="flex gap-4 mb-8">
                <div class="relative flex-1">
                    <i class="fas fa-search absolute left-4 top-1/2 -translate-y-1/2 text-gray-400"></i>
                    <input type="text" placeholder="Cari nama, username, atau nomor HP..." class="w-full bg-white border border-gray-200 rounded-xl py-3 pl-12 pr-4 text-sm font-medium focus:outline-none focus:border-[#0074A6] focus:ring-1 focus:ring-[#0074A6] transition">
                </div>
                <button class="bg-white border border-gray-200 text-gray-600 px-5 py-3 rounded-xl text-sm font-bold hover:bg-gray-50 transition flex items-center gap-2">
                    <i class="fas fa-filter text-gray-400"></i> Filter
                </button>
                <button class="bg-white border border-gray-200 text-gray-600 px-5 py-3 rounded-xl text-sm font-bold hover:bg-gray-50 transition flex items-center gap-2">
                    <i class="fas fa-download text-gray-400"></i> Export
                </button>
            </div>

            {{-- Table Kurir Card --}}
            <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden mb-8">
                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead>
                            <tr class="border-b border-gray-100 bg-gray-50/50">
                                <th class="py-4 px-6 text-[10px] font-bold text-gray-400 uppercase tracking-wider w-[35%]">Nama Kurir</th>
                                <th class="py-4 px-6 text-[10px] font-bold text-gray-400 uppercase tracking-wider w-[20%]">Username</th>
                                <th class="py-4 px-6 text-[10px] font-bold text-gray-400 uppercase tracking-wider w-[20%]">No. HP</th>
                                <th class="py-4 px-6 text-[10px] font-bold text-gray-400 uppercase tracking-wider w-[15%]">Status</th>
                                <th class="py-4 px-6 text-[10px] font-bold text-gray-400 uppercase tracking-wider w-[10%] text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="text-sm font-medium">
                            @forelse($daftar_kurir ?? [] as $kurir)
                                <tr class="border-b border-gray-50 hover:bg-gray-50/50 transition">
                                    <td class="py-4 px-6">
                                        <div class="flex items-center gap-3">
                                            {{-- UI Avatar dinamis berdasarkan nama kurir --}}
                                            <img src="https://ui-avatars.com/api/?name={{ urlencode($kurir->nama) }}&background=E0F2FE&color=0369A1&bold=true" alt="{{ $kurir->nama }}" class="w-10 h-10 rounded-full object-cover border border-gray-50">
                                            <div>
                                                <p class="font-bold text-[#1D5D8A]">{{ $kurir->nama }}</p>
                                                <p class="text-[10px] text-gray-400">Terdaftar: {{ $kurir->created_at ? $kurir->created_at->format('d M Y') : 'N/A' }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="py-4 px-6 text-gray-600 font-mono text-xs bg-gray-50/50 rounded px-2">{{ $kurir->username }}</td>
                                    <td class="py-4 px-6 text-gray-600 flex items-center gap-2 h-full my-auto"><i class="fas fa-phone-alt text-blue-400 text-xs"></i> {{ $kurir->no_hp }}</td>
                                    <td class="py-4 px-6">
                                        {{-- Deteksi status tugas aktif kurir secara otomatis --}}
                                        @php 
                                            $sedangSibuk = $kurir->pesanan ? $kurir->pesanan()->whereIn('status', ['menunggu_pickup', 'delivery'])->count() : 0; 
                                        @endphp
                                        
                                        @if($sedangSibuk > 0)
                                            <span class="inline-flex items-center gap-1.5 text-[10px] font-bold text-yellow-600 bg-yellow-50 px-2.5 py-1 rounded-md border border-yellow-100">
                                                <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span> SIBUK ({{ $sedangSibuk }} TUGAS)
                                            </span>
                                        @else
                                            <span class="inline-flex items-center gap-1.5 text-[10px] font-bold text-green-600 bg-green-50 px-2.5 py-1 rounded-md border border-green-100">
                                                <span class="w-1.5 h-1.5 rounded-full bg-green-500"></span> AKTIF / STANDBY
                                            </span>
                                        @endif
                                    </td>
                                    <td class="py-4 px-6 text-right space-x-2">
                                        <button class="text-blue-400 hover:text-blue-600 transition"><i class="far fa-edit"></i></button>
                                        <button class="text-red-400 hover:text-red-600 transition"><i class="far fa-trash-alt"></i></button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="py-12 text-center text-gray-400 font-medium italic">
                                        <i class="fas fa-user-slash text-xl mb-2 block text-gray-300"></i> Belum ada mitra kurir terdaftar ege.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                
                {{-- Pagination Statis --}}
                <div class="px-6 py-4 border-t border-gray-100 flex justify-between items-center bg-gray-50/30">
                    <p class="text-xs text-gray-500 font-medium">Total: {{ count($daftar_kurir ?? []) }} Petugas Logistik</p>
                    <div class="flex gap-1">
                        <button class="w-8 h-8 rounded-lg border border-gray-200 flex items-center justify-center text-gray-400 hover:bg-gray-100 transition"><i class="fas fa-chevron-left text-xs"></i></button>
                        <button class="w-8 h-8 rounded-lg text-white font-bold text-xs flex items-center justify-center shadow-sm" style="background-color: #1D5D8A;">1</button>
                        <button class="w-8 h-8 rounded-lg border border-gray-200 flex items-center justify-center text-gray-400 hover:bg-gray-100 transition"><i class="fas fa-chevron-right text-xs"></i></button>
                    </div>
                </div>
            </div>

            {{-- Summary Cards Bawah --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                {{-- Total Kurir Dinamis --}}
                <div class="bg-blue-50/50 p-6 rounded-3xl border border-blue-100 flex flex-col justify-between">
                    <div class="flex items-start gap-4 mb-4">
                        <div class="w-12 h-12 rounded-xl text-white flex items-center justify-center text-xl shrink-0" style="background-color: #1D5D8A;">
                            <i class="fas fa-users"></i>
                        </div>
                        <div>
                            <p class="text-[10px] font-bold text-gray-500 uppercase tracking-wider mb-1">Total Kurir</p>
                            <h3 class="text-3xl font-black text-gray-800">{{ count($daftar_kurir ?? []) }}</h3>
                        </div>
                    </div>
                    <p class="text-xs text-gray-500 font-medium">Jumlah kurir aktif yang terintegrasi dalam ekosistem operasional Washly.</p>
                </div>

                {{-- Card Pengiriman --}}
                <div class="bg-red-50/50 p-6 rounded-3xl border border-red-100 flex flex-col justify-between">
                    <div class="flex items-start gap-4 mb-4">
                        <div class="w-12 h-12 rounded-xl bg-red-100 text-red-500 flex items-center justify-center text-xl shrink-0">
                            <i class="fas fa-truck"></i>
                        </div>
                        <div class="w-full">
                            <p class="text-[10px] font-bold text-gray-500 uppercase tracking-wider mb-1">Kapasitas Tugas</p>
                            <h3 class="text-3xl font-black text-red-600">Active</h3>
                        </div>
                    </div>
                    <div>
                        <div class="w-full bg-gray-200 rounded-full h-1.5 mb-1.5 overflow-hidden">
                            <div class="h-1.5 rounded-full" style="width: 40%; background-color: #1D5D8A;"></div>
                        </div>
                        <p class="text-[10px] font-bold text-gray-400 uppercase tracking-wider">Sistem Penjemputan Siap</p>
                    </div>
                </div>

                {{-- Card Rating --}}
                <div class="bg-yellow-50/50 p-6 rounded-3xl border border-yellow-100 flex flex-col justify-between">
                    <div class="flex items-start gap-4 mb-4">
                        <div class="w-12 h-12 rounded-xl bg-yellow-100 text-yellow-600 flex items-center justify-center text-xl shrink-0">
                            <i class="fas fa-star"></i>
                        </div>
                        <div>
                            <p class="text-[10px] font-bold text-gray-500 uppercase tracking-wider mb-1">Indeks Kepuasan</p>
                            <h3 class="text-3xl font-black text-gray-800">4.9<span class="text-lg text-gray-400 font-semibold">/5.0</span></h3>
                        </div>
                    </div>
                    <div class="text-xs text-[#F59E0B] font-bold flex items-center gap-1">
                        <i class="fas fa-shield-alt"></i> Mitra Driver Terpercaya
                    </div>
                </div>
            </div>

        </div>

        {{-- MODAL TAMBAH KURIR BARU --}}
        <div x-cloak x-show="showModal" 
             class="fixed inset-0 z-50 flex items-center justify-center bg-slate-900/40 backdrop-blur-sm"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0">
             
            <div class="bg-white rounded-[2rem] shadow-2xl w-full max-w-lg overflow-hidden"
                 @click.away="showModal = false"
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0 translate-y-8 scale-95"
                 x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                 x-transition:leave="transition ease-in duration-200"
                 x-transition:leave-start="opacity-100 translate-y-0 scale-100"
                 x-transition:leave-end="opacity-0 translate-y-8 scale-95">
                 
                 <div class="p-8">
                     <div class="flex gap-4 mb-8">
                         <div class="w-12 h-12 bg-blue-50 text-[#1D5D8A] rounded-xl flex items-center justify-center shrink-0">
                             <i class="fas fa-user-plus text-lg"></i>
                         </div>
                         <div>
                             <h2 class="text-lg font-bold text-[#1D5D8A]">Tambah Kurir Baru</h2>
                             <p class="text-xs text-gray-500 font-medium mt-1">Masukkan informasi detail untuk mendaftarkan mitra pengiriman baru</p>
                         </div>
                     </div>

                     {{-- DIHUBUNGKAN KE ROUTE STORE KURIR DI ADMINCONTROLLER --}}
                     <form action="{{ route('admin.kurir.store') }}" method="POST" class="space-y-5">
                         @csrf
                         
                         {{-- Input Nama --}}
                         <div>
                             <label class="block text-xs font-semibold text-gray-600 mb-2">Nama Lengkap</label>
                             <div class="relative">
                                 <i class="far fa-id-card absolute left-4 top-1/2 -translate-y-1/2 text-gray-400"></i>
                                 <input type="text" name="nama" value="{{ old('nama') }}" placeholder="Contoh: Budi Santoso" class="w-full bg-white border border-gray-200 rounded-xl py-3 pl-10 pr-4 text-sm font-medium focus:outline-none focus:border-[#1D5D8A] focus:ring-1 focus:ring-[#1D5D8A] transition" required>
                             </div>
                         </div>

                         <div class="grid grid-cols-2 gap-4">
                             {{-- Input Username --}}
                             <div>
                                 <label class="block text-xs font-semibold text-gray-600 mb-2">Username</label>
                                 <div class="relative">
                                     <i class="fas fa-at absolute left-4 top-1/2 -translate-y-1/2 text-gray-400"></i>
                                     <input type="text" name="username" value="{{ old('username') }}" placeholder="username_" class="w-full bg-white border border-gray-200 rounded-xl py-3 pl-10 pr-4 text-sm font-medium focus:outline-none focus:border-[#1D5D8A] focus:ring-1 focus:ring-[#1D5D8A] transition" required>
                                 </div>
                                 {{-- Error Warning Username Kembar --}}
                                 @error('username')
                                     <p class="text-red-500 text-[10px] mt-1 font-bold">❌ Username sudah terpakai ege!</p>
                                 @enderror
                             </div>
                             
                             {{-- Input Nomor HP --}}
                             <div>
                                 <label class="block text-xs font-semibold text-gray-600 mb-2">Nomor HP</label>
                                 <div class="relative">
                                     <i class="fas fa-mobile-alt absolute left-4 top-1/2 -translate-y-1/2 text-gray-400"></i>
                                     <input type="text" name="no_hp" value="{{ old('no_hp') }}" placeholder="0812xxxxxxx" class="w-full bg-white border border-gray-200 rounded-xl py-3 pl-10 pr-4 text-sm font-medium focus:outline-none focus:border-[#1D5D8A] focus:ring-1 focus:ring-[#1D5D8A] transition" required>
                                 </div>
                             </div>
                         </div>

                         {{-- Input Password --}}
                         <div>
                             <label class="block text-xs font-semibold text-gray-600 mb-2">Password</label>
                             <div class="relative">
                                 <i class="fas fa-lock absolute left-4 top-1/2 -translate-y-1/2 text-gray-400"></i>
                                 <input type="password" name="password" placeholder="Min. 8 karakter" class="w-full bg-white border border-gray-200 rounded-xl py-3 pl-10 pr-10 text-sm font-medium focus:outline-none focus:border-[#1D5D8A] focus:ring-1 focus:ring-[#1D5D8A] transition" required>
                             </div>
                             <p class="text-[10px] text-gray-400 mt-2">Gunakan kombinasi password yang kuat untuk menjaga privasi akun petugas.</p>
                         </div>

                         {{-- Tombol Submit --}}
                         <div class="flex gap-3 pt-2">
                             <button type="submit" class="flex-1 text-white py-3.5 rounded-xl text-sm font-bold shadow-md transition flex items-center justify-center gap-2 hover:opacity-90" style="background-color: #1D5D8A;">
                                 <i class="fas fa-save"></i> Simpan Kurir
                             </button>
                             <button type="button" @click="showModal = false" class="bg-red-50 hover:bg-red-100 text-red-500 px-8 py-3.5 rounded-xl text-sm font-bold transition">
                                 Batal
                             </button>
                         </div>
                     </form>
                 </div>

                 <div class="bg-gray-50/50 border-t border-gray-100 px-8 py-4 flex justify-between items-center">
                     <p class="text-[9px] font-bold text-gray-400 tracking-widest uppercase">Washly Logistics System V2.0</p>
                     <div class="flex gap-1">
                         <span class="w-1.5 h-1.5 rounded-full bg-blue-300"></span>
                         <span class="w-1.5 h-1.5 rounded-full bg-cyan-300"></span>
                         <span class="w-1.5 h-1.5 rounded-full bg-purple-300"></span>
                     </div>
                 </div>

            </div>
        </div>
    </main>
</body>
</html>