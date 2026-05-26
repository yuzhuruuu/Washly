<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Kurir - Washly</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-[#F8FAFC] h-screen font-sans text-slate-800 flex overflow-hidden">

    {{-- SIDEBAR KURIR (Desktop/Tablet) --}}
    <aside class="hidden md:flex w-64 bg-white border-r border-gray-100 flex-col h-full shrink-0 relative z-20">
        {{-- Logo --}}
        <div class="p-6">
            <img src="{{ asset('images/w-k.svg') }}" alt="Washly Kurir" class="h-8">
        </div>

        {{-- Profil Kurir --}}
        <div class="px-6 flex items-center gap-3 mb-8">
            <div class="w-10 h-10 rounded-full border border-gray-100 overflow-hidden shadow-sm bg-blue-50">
                <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::guard('kurir')->user()?->nama ?? 'Kurir') }}&background=1D5D8A&color=fff&bold=true" alt="Avatar Kurir" class="w-full h-full object-cover">
            </div>
            <div>
                <h3 class="font-bold text-sm text-[#0074A6] leading-tight">{{ Auth::guard('kurir')->user()?->nama ?? 'Budi Kurir' }}</h3>
                <p class="text-[10px] text-gray-500 font-medium mt-0.5">Petugas Kurir</p>
            </div>
        </div>

        {{-- Menu Navigasi --}}
        <nav class="flex-1 px-4 space-y-2">
            <a href="{{ url('/dashboard/kurir') }}" class="flex items-center gap-3 px-4 py-3 bg-blue-50 text-[#0074A6] rounded-xl font-bold text-sm transition shadow-sm border border-blue-100">
                <i class="fas fa-th-large w-5 text-center"></i> Daftar Tugas
            </a>
            <a href="{{ url('/dashboard/kurir/profil') }}" class="flex items-center gap-3 px-4 py-3 text-gray-500 hover:bg-gray-50 hover:text-[#0074A6] rounded-xl font-medium text-sm transition group">
                <i class="far fa-user w-5 text-center text-gray-400 group-hover:text-[#0074A6] transition"></i> Profil
            </a>
            <a href="{{ url('/dashboard/kurir/riwayat') }}" class="flex items-center gap-3 px-4 py-3 text-gray-500 hover:bg-gray-50 hover:text-[#0074A6] rounded-xl font-medium text-sm transition group">
                <i class="fas fa-history w-5 text-center text-gray-400 group-hover:text-[#0074A6] transition"></i> Riwayat Tugas
            </a>
            <a href="{{ url('/dashboard/kurir/pengaturan') }}" class="flex items-center gap-3 px-4 py-3 text-gray-500 hover:bg-gray-50 hover:text-[#0074A6] rounded-xl font-medium text-sm transition group">
                <i class="fas fa-cog w-5 text-center text-gray-400 group-hover:text-[#0074A6] transition"></i> Pengaturan
            </a>
        </nav>

        {{-- Tombol Keluar --}}
        <form action="{{ route('logout') }}" method="POST" class="p-6 mt-auto border-t border-gray-50">
            @csrf
            <button type="submit" class="w-full bg-[#D9534F] hover:bg-[#C9302C] text-white py-3 rounded-xl text-sm font-bold shadow-md transition active:scale-95 flex items-center justify-center gap-2">
                <i class="fas fa-sign-out-alt"></i> Keluar
            </button>
        </form>
    </aside>

    {{-- KONTEN UTAMA --}}
    <main class="flex-1 overflow-y-auto relative z-10 pb-20 md:pb-0">
        <div class="p-5 md:p-8 max-w-6xl mx-auto">
            
            {{-- Header --}}
            <div class="flex justify-between items-center mb-8">
                <h1 class="text-2xl font-bold text-[#2C4B64]">Tugas Hari Ini</h1>
                <div class="flex gap-4 text-[#2C4B64]">
                    <button class="hover:text-blue-600 transition"><i class="far fa-bell text-lg"></i></button>
                </div>
            </div>

            {{-- Kartu Sapaan (Data Dinamis) --}}
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-10">
                
                {{-- Banner Biru --}}
                <div class="lg:col-span-2 bg-[#2D6A9F] rounded-3xl p-6 md:p-8 text-white relative overflow-hidden shadow-md">
                    <i class="fas fa-motorcycle absolute -right-6 -bottom-6 text-9xl text-white opacity-10"></i>
                    
                    <div class="relative z-10">
                        <h2 class="text-2xl md:text-3xl font-bold mb-2">Semangat, {{ explode(' ', Auth::guard('kurir')->user()?->nama ?? 'Kurir')[0] }}!</h2>
                        <p class="text-blue-100 text-sm md:w-3/4 mb-8 leading-relaxed">Ada {{ count($tugas_kurir ?? []) }} tugas menunggu untuk diselesaikan. Pastikan laundry pelanggan sampai dengan selamat.</p>
                        
                        <div class="flex gap-4">
                            @php
                                $totalPickup = 0; $totalDelivery = 0;
                                foreach($tugas_kurir ?? [] as $t) {
                                    if($t->status == 'menunggu_pickup') $totalPickup++;
                                    if($t->status == 'delivery') $totalDelivery++;
                                }
                            @endphp
                            <div class="bg-white/20 border border-white/30 backdrop-blur-sm rounded-xl px-5 py-3 text-center min-w-[80px]">
                                <h3 class="text-3xl font-black mb-1">{{ str_pad($totalPickup, 2, '0', STR_PAD_LEFT) }}</h3>
                                <p class="text-[10px] font-bold tracking-widest uppercase">Pickup</p>
                            </div>
                            <div class="bg-white/20 border border-white/30 backdrop-blur-sm rounded-xl px-5 py-3 text-center min-w-[80px]">
                                <h3 class="text-3xl font-black mb-1">{{ str_pad($totalDelivery, 2, '0', STR_PAD_LEFT) }}</h3>
                                <p class="text-[10px] font-bold tracking-widest uppercase">Delivery</p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Target Statis --}}
                <div class="bg-white rounded-3xl p-8 border border-gray-100 shadow-sm flex flex-col items-center justify-center text-center hidden lg:flex">
                    <div class="w-14 h-14 bg-blue-50 text-[#0074A6] rounded-full flex items-center justify-center text-2xl mb-4">
                        <i class="fas fa-trophy"></i>
                    </div>
                    <p class="text-xs font-bold text-gray-400 mb-1">Target Harian</p>
                    <h3 class="text-2xl font-black text-gray-800 mb-4">On Track</h3>
                    <div class="w-full bg-gray-100 rounded-full h-2.5 overflow-hidden">
                        <div class="bg-[#2D6A9F] h-2.5 rounded-full" style="width: 100%"></div>
                    </div>
                </div>
            </div>

            {{-- Flash Message Jika Berhasil Selesaikan Tugas --}}
            @if(session('success'))
                <div class="bg-green-100 border border-green-200 text-green-700 px-5 py-3 rounded-xl text-sm font-bold shadow-sm mb-6 flex items-center gap-2">
                    <i class="fas fa-check-circle"></i> {{ session('success') }}
                </div>
            @endif

            {{-- Grid Tugas Dinamis --}}
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-lg font-bold text-gray-800">Daftar Eksekusi</h3>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                
                @forelse($tugas_kurir ?? [] as $t)
                    <div class="bg-white p-6 rounded-3xl border border-gray-100 shadow-sm hover:shadow-md transition flex flex-col h-full">
                        
                        {{-- Label Tipe Tugas --}}
                        <div class="flex justify-between items-center mb-4">
                            @if($t->status == 'menunggu_pickup')
                                <span class="bg-blue-50 text-blue-600 px-3 py-1 rounded flex items-center gap-1.5 text-[10px] font-bold tracking-wide">
                                    <i class="fas fa-shopping-basket"></i> JEMPUT CUCIAN
                                </span>
                            @elseif($t->status == 'delivery')
                                <span class="bg-red-50 text-red-500 px-3 py-1 rounded flex items-center gap-1.5 text-[10px] font-bold tracking-wide">
                                    <i class="fas fa-truck"></i> ANTAR CUCIAN
                                </span>
                            @endif
                            <span class="text-xs font-bold text-gray-400 uppercase">WS-{{ $t->id_pesanan }}</span>
                        </div>

                        {{-- Info Pelanggan --}}
                        <h4 class="text-lg font-bold text-[#2C4B64] mb-2">{{ $t->pelanggan->nama ?? 'Pelanggan' }}</h4>
                        <div class="flex items-start gap-2 text-sm text-gray-500 mb-2 flex-1">
                            <i class="fas fa-map-marker-alt text-[#2D6A9F] mt-1"></i>
                            <p class="leading-relaxed">{{ $t->pelanggan->alamat ?? 'Alamat tidak tersedia' }}</p>
                        </div>
                        
                        {{-- Tombol WhatsApp --}}
                        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $t->pelanggan->no_hp ?? '') }}" target="_blank" class="text-[#25D366] text-xs font-bold hover:underline mb-6 inline-flex items-center gap-1">
                            <i class="fab fa-whatsapp text-sm"></i> Hubungi Pelanggan
                        </a>

                        {{-- Aksi Selesaikan Tugas --}}
                        <div class="bg-gray-50 p-3 rounded-2xl">
                            <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-2 px-1">Aksi Eksekusi:</p>
                            
                            {{-- HUBUNGKAN KE ROUTE CONTROLLER --}}
                            <form action="{{ route('kurir.tugas.selesai', $t->id_pesanan) }}" method="POST" class="flex gap-2">
                                @csrf 
                                @method('PATCH')
                                
                                @if($t->status == 'menunggu_pickup')
                                    <button type="button" class="flex-1 bg-orange-100 text-orange-600 py-2.5 rounded-xl text-xs font-bold cursor-default">Menunggu<br>Pickup</button>
                                    <button type="submit" class="flex-1 bg-green-50 text-green-500 py-2.5 rounded-xl text-xs font-bold transition hover:bg-green-100 shadow-sm active:scale-95">Selesaikan<br>Jemputan</button>
                                @elseif($t->status == 'delivery')
                                    <button type="button" class="flex-1 bg-orange-100 text-orange-600 py-2.5 rounded-xl text-xs font-bold cursor-default">Dalam<br>Pengantaran</button>
                                    <button type="submit" class="flex-1 bg-green-50 text-green-500 py-2.5 rounded-xl text-xs font-bold transition hover:bg-green-100 shadow-sm active:scale-95">Selesaikan<br>Antaran</button>
                                @endif
                            </form>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full bg-white border-2 border-dashed border-gray-200 rounded-3xl p-12 text-center">
                        <div class="w-16 h-16 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-4 text-gray-400">
                            <i class="fas fa-bed text-2xl"></i>
                        </div>
                        <h3 class="text-lg font-bold text-gray-600 mb-1">Tidak ada tugas!</h3>
                        <p class="text-gray-400 text-sm italic">Kamu bisa bersantai sambil menunggu orderan masuk.</p>
                    </div>
                @endforelse

            </div>
        </div>
    </main>

    {{-- BOTTOM NAVIGATION (Khusus Tampilan HP) --}}
    <nav class="md:hidden fixed bottom-0 left-0 right-0 bg-white border-t border-gray-200 px-6 py-3 flex justify-between items-center z-50 pb-safe">
        <a href="{{ url('/dashboard/kurir') }}" class="flex flex-col items-center text-[#0074A6]">
            <i class="fas fa-home text-xl mb-1"></i>
            <span class="text-[9px] font-bold tracking-wider">TUGAS</span>
        </a>
        <a href="{{ url('/dashboard/kurir/riwayat') }}" class="flex flex-col items-center text-gray-400 hover:text-[#0074A6] transition">
            <i class="fas fa-history text-xl mb-1"></i>
            <span class="text-[9px] font-bold tracking-wider">RIWAYAT</span>
        </a>
        <a href="{{ url('/dashboard/kurir/profil') }}" class="flex flex-col items-center text-gray-400 hover:text-[#0074A6] transition">
            <i class="far fa-user text-xl mb-1"></i>
            <span class="text-[9px] font-bold tracking-wider">PROFIL</span>
        </a>
        <form action="{{ route('logout') }}" method="POST" class="inline flex flex-col items-center text-red-400 hover:text-red-600 transition cursor-pointer" onclick="this.submit();">
            @csrf
            <i class="fas fa-sign-out-alt text-xl mb-1"></i>
            <span class="text-[9px] font-bold tracking-wider">KELUAR</span>
        </form>
    </nav>

</body>
</html>