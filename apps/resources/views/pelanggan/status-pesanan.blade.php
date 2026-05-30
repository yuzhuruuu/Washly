<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Status Pesanan - Washly</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-[#F8FAFC] min-h-screen font-sans text-slate-800 pb-12 antialiased relative overflow-x-hidden">

    <div class="absolute top-0 left-0 w-96 h-96 bg-blue-200/40 rounded-full blur-[100px] -translate-x-1/2 -translate-y-1/2 pointer-events-none z-0"></div>
    <div class="absolute bottom-0 right-0 w-[500px] h-[500px] bg-cyan-200/30 rounded-full blur-[120px] translate-x-1/3 translate-y-1/3 pointer-events-none z-0"></div>

    <nav class="bg-white border-b border-gray-100 shadow-sm sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center relative">
            <div class="flex items-center">
                <img src="{{ asset('images/w-g.svg') }}" alt="Washly" class="h-8">
            </div>

            <div class="hidden md:flex space-x-10 text-sm font-semibold absolute left-1/2 -translate-x-1/2">
                <a href="{{ route('pelanggan.dashboard') }}" class="text-[#0074A6] border-b-2 border-[#0074A6] pb-1">Beranda</a>
                <a href="{{ route('pelanggan.pesanan.baru') }}" class="text-gray-400 hover:text-gray-600 transition">Layanan</a>
                <a href="{{ route('pelanggan.riwayat') }}" class="text-gray-400 hover:text-gray-600 transition">Riwayat</a>
                <a href="{{ route('pelanggan.tentang-kami') }}" class="text-gray-400 hover:text-gray-600 transition">Tentang Kami</a>
            </div>

            <div class="flex items-center space-x-5">
                <span class="text-sm text-gray-500 font-medium">Halo, {{ Auth::guard('pelanggan')->user()?->nama ?? 'Pelanggan' }}!</span>
                <a href="{{ route('pelanggan.profil') }}" class="w-8 h-8 rounded-full bg-blue-50 overflow-hidden border border-blue-200 block">
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

    <main class="max-w-5xl mx-auto px-6 mt-12 relative z-10"
          x-data="{ 
              hasPesanan: {{ $pesanan ? 'true' : 'false' }},
              step: {{ $pesanan ? ($step ?? 0) : 0 }}, 
              getStatusText() {
                  if(!this.hasPesanan) return 'BELUM ADA PESANAN';
                  if(this.step === 0) return 'MENUNGGU PEMBAYARAN';
                  if(this.step === 1) return 'DITERIMA';
                  if(this.step === 2) return 'DIJEMPUT';
                  if(this.step === 3) return 'DIPROSES';
                  if(this.step === 4) return 'SIAP DIANTAR';
                  if(this.step === 5) return 'SELESAI';
              }
          }">
        
        {{-- Tombol Kembali & Judul --}}
        <div class="flex items-center gap-5 mb-8">
            <a href="{{ route('pelanggan.dashboard') }}" class="w-10 h-10 bg-white rounded-full flex items-center justify-center shadow-sm text-gray-600 hover:bg-gray-50 transition border border-gray-100">
                <i class="fas fa-arrow-left"></i>
            </a>
            <h1 class="text-3xl font-bold text-gray-800">Status Pesanan</h1>
        </div>

        @if($pesanan)
            <div class="bg-white rounded-[2rem] p-10 shadow-sm border border-gray-50 mb-8">
                <div class="flex justify-between items-start mb-12">
                    <div>
                        <p class="text-[11px] font-bold tracking-widest text-gray-400 mb-1">NO. PESANAN</p>
                        <h2 class="text-3xl font-extrabold text-gray-800 tracking-tight">WS-{{ $pesanan->id_pesanan }}</h2>
                        <p class="text-sm text-gray-500 mt-1">{{ $pesanan->layanan?->nama_layanan ?? 'Layanan Tidak Diketahui' }}</p>
                    </div>
                    <div class="px-4 py-1.5 rounded-full text-xs font-bold shadow-sm border transition-all"
                         :class="step === 0 ? 'bg-red-50 text-red-600 border-red-100' : (step === 5 ? 'bg-green-50 text-green-600 border-green-100' : 'bg-orange-50 text-orange-500 border-orange-100')"
                         x-text="getStatusText()">
                    </div>
                </div>

                {{-- STEPPER UI YANG BENAR-BENAR BERSIH DARI ABSOLUTE LINE --}}
                <div class="flex items-center justify-between w-full mx-auto max-w-4xl px-4 mt-8">
                    <div class="flex flex-col items-center relative z-10 w-14">
                        <div class="w-14 h-14 rounded-full flex items-center justify-center text-xl transition-all duration-300 shadow-md"
                             :class="step >= 1 ? 'bg-[#005B82] text-white' : 'bg-white border-2 border-gray-200 text-gray-300'">
                            <i class="fas fa-check"></i>
                        </div>
                        <span class="text-xs mt-4 absolute top-full w-24 text-center font-bold" :class="step >= 1 ? 'text-gray-800' : 'text-gray-400'">Diterima</span>
                    </div>

                    <div class="flex-1 h-1.5 mx-2 rounded-full transition-all duration-300" :class="step >= 2 ? 'bg-[#005B82]' : 'bg-gray-200'"></div>

                    <div class="flex flex-col items-center relative z-10 w-14">
                        <div class="w-14 h-14 rounded-full flex items-center justify-center text-xl transition-all duration-300 shadow-md"
                             :class="step >= 2 ? 'bg-[#005B82] text-white' : 'bg-white border-2 border-gray-200 text-gray-300'">
                            <i class="fas fa-truck"></i>
                        </div>
                        <span class="text-xs mt-4 absolute top-full w-24 text-center font-bold" :class="step >= 2 ? 'text-gray-800' : 'text-gray-400'">Dijemput</span>
                    </div>

                    <div class="flex-1 h-1.5 mx-2 rounded-full transition-all duration-300" :class="step >= 3 ? 'bg-[#005B82]' : 'bg-gray-200'"></div>

                    <div class="flex flex-col items-center relative z-10 w-14">
                        <div class="w-14 h-14 rounded-full flex items-center justify-center text-xl transition-all duration-300 shadow-md"
                             :class="step >= 3 ? 'bg-[#005B82] text-white' : 'bg-white border-2 border-gray-200 text-gray-300'">
                            <svg class="w-6 h-6 fill-current" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path d="M8 6C9.1 6 10 5.1 10 4C10 2.9 9.1 2 8 2C6.9 2 6 2.9 6 4C6 5.1 6.9 6 8 6M14 6H20V4H14V6M19.1 22C20.2 22 21.1 21.1 21.1 20V10C21.1 8.9 20.2 8 19.1 8H4.9C3.8 8 2.9 8.9 2.9 10V20C2.9 21.1 3.8 22 4.9 22H19.1M12 11C14.2 11 16 12.8 16 15C16 17.2 14.2 19 12 19C9.8 19 8 17.2 8 15C8 12.8 9.8 11 12 11M12 13C10.9 13 10 13.9 10 15C10 16.1 10.9 17 12 17C13.1 17 14 16.1 14 15C14 13.9 13.1 13 12 13Z" />
                            </svg>
                        </div>
                        <span class="text-xs mt-4 absolute top-full w-24 text-center font-bold" :class="step >= 3 ? 'text-gray-800' : 'text-gray-400'">Diproses</span>
                    </div>

                    <div class="flex-1 h-1.5 mx-2 rounded-full transition-all duration-300" :class="step >= 4 ? 'bg-[#005B82]' : 'bg-gray-200'"></div>

                    <div class="flex flex-col items-center relative z-10 w-14">
                        <div class="w-14 h-14 rounded-full flex items-center justify-center text-xl transition-all duration-300 shadow-md"
                             :class="step >= 4 ? 'bg-[#005B82] text-white' : 'bg-white border-2 border-gray-200 text-gray-300'">
                            <i class="fas fa-box"></i>
                        </div>
                        <span class="text-xs mt-4 absolute top-full w-24 text-center font-bold" :class="step >= 4 ? 'text-gray-800' : 'text-gray-400'">Siap</span>
                    </div>

                    <div class="flex-1 h-1.5 mx-2 rounded-full transition-all duration-300" :class="step >= 5 ? 'bg-[#22C55E]' : 'bg-gray-200'"></div>

                    <div class="flex flex-col items-center relative z-10 w-14">
                        <div class="w-14 h-14 rounded-full flex items-center justify-center text-xl transition-all duration-300 shadow-md"
                             :class="step >= 5 ? 'bg-[#22C55E] text-white' : 'bg-white border-2 border-gray-200 text-gray-300'">
                            <i class="fas fa-home"></i>
                        </div>
                        <span class="text-xs mt-4 absolute top-full w-24 text-center font-bold" :class="step >= 5 ? 'text-gray-800' : 'text-gray-400'">Selesai</span>
                    </div>
                </div>
            </div>
            <div class="h-10"></div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <div class="lg:col-span-2">
                    <h3 class="text-xl font-bold text-gray-800 mb-6">Detail Layanan</h3>
                    <div class="bg-white rounded-2xl p-4 flex items-center gap-4 shadow-sm border border-gray-50 mb-6">
                        <div class="w-12 h-12 bg-blue-50 text-[#00AEEF] rounded-full flex items-center justify-center text-xl border border-blue-100">
                            <i class="fas fa-tint"></i>
                        </div>
                        <div>
                            <p class="font-bold text-gray-800 text-sm">{{ $pesanan->layanan?->nama_layanan ?? 'Cuci Komplit (Reguler)' }}</p>
                            <p class="text-xs text-gray-500">{{ $pesanan->layanan?->deskripsi ?? 'Cuci, Kering, Setrika' }}</p>
                        </div>
                    </div>
                    <div class="space-y-4">
                        <div class="flex justify-between items-center py-2 border-b border-gray-100">
                            <span class="text-sm text-gray-500">Berat Aktual</span>
                            <span class="text-sm font-bold text-gray-800">{{ $pesanan->berat ? number_format($pesanan->berat, 1, ',', '.') . ' Kg' : 'Belum ditimbang' }}</span>
                        </div>
                        <div class="flex justify-between items-center py-2 border-b border-gray-100">
                            <span class="text-sm text-gray-500">Tanggal Selesai (Est)</span>
                            <span class="text-sm font-bold text-gray-800">{{ $pesanan->created_at ? $pesanan->created_at->copy()->addDay()->format('d M Y, H:i') : '-' }}</span>
                        </div>
                    </div>
                </div>

                <div class="lg:col-span-1">
                    <div x-show="step === 0" class="bg-orange-50 border border-orange-200 rounded-2xl p-6 shadow-sm">
                        <div class="flex items-center gap-3 mb-4">
                            <div class="w-8 h-8 bg-orange-500 text-white rounded-full flex items-center justify-center shadow-sm">
                                <i class="fas fa-credit-card"></i>
                            </div>
                            <h3 class="font-bold text-orange-700 text-lg leading-tight">Lakukan Pembayaran</h3>
                        </div>
                        <p class="text-xs font-semibold text-orange-600 mb-2">Langkah Selanjutnya:</p>
                        <p class="text-sm text-orange-700/80 leading-relaxed mb-6">
                            Admin sudah mengkonfirmasi harga untuk pesanan Anda. Selesaikan pembayaran sekarang untuk mengaktifkan proses laundry.
                        </p>
                        <a href="{{ route('pembayaran.create', $pesanan->id_pesanan) }}" class="mt-4 block w-full px-4 py-2.5 bg-orange-500 hover:bg-orange-600 text-white font-bold text-sm rounded-lg text-center transition shadow-sm">
                            <i class="fas fa-credit-card mr-2"></i> Lakukan Pembayaran
                        </a>
                    </div>

                    <div x-show="step > 0" class="bg-gradient-to-br from-[#E0FCFE] to-[#D0F4F8] border border-cyan-100 rounded-2xl p-6 shadow-sm">
                        <div class="flex items-center gap-3 mb-4">
                            <div class="w-8 h-8 bg-[#005B82] text-white rounded-full flex items-center justify-center shadow-sm">
                                <i class="fas fa-check"></i>
                            </div>
                            <h3 class="font-bold text-[#005B82] text-lg leading-tight">Pesanan Berhasil!</h3>
                        </div>
                        <p class="text-xs font-semibold text-[#005B82] mb-2">Langkah Selanjutnya:</p>
                        <p class="text-sm text-gray-600 leading-relaxed mb-6" x-show="step === 1">Kurir kami sedang bersiap untuk menjemput pakaian Anda di lokasi.</p>
                        <p class="text-sm text-gray-600 leading-relaxed mb-6" x-show="step === 2">Kurir telah menjemput pakaian Anda dan sedang dalam perjalanan ke outlet Washly.</p>
                        <p class="text-sm text-gray-600 leading-relaxed mb-6" x-show="step === 3">Pesanan Anda sedang diproses oleh tim kami. Anda akan menerima notifikasi jika pakaian sudah siap untuk diantar.</p>
                        <p class="text-sm text-gray-600 leading-relaxed mb-6" x-show="step === 4">Pakaian Anda sudah wangi paripurna dan siap diantarkan kembali oleh kurir!</p>
                        <p class="text-sm text-gray-600 leading-relaxed mb-6" x-show="step === 5">Pesanan selesai. Terima kasih telah mempercayakan cucian Anda pada Washly!</p>
                        <div class="pt-4 border-t border-cyan-200 flex items-center gap-2 text-[11px] font-bold text-[#0074A6]">
                            <i class="fas fa-shield-alt"></i> Layanan Terjamin Washly
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="bg-white rounded-[2rem] p-10 shadow-sm border border-gray-50 mb-8 text-center">
            <div class="text-center py-20">
                <p class="text-sm text-gray-400 uppercase tracking-[0.2em] mb-4">Belum ada pesanan</p>
                <h2 class="text-3xl font-bold text-gray-800 mb-4">Kamu belum memesan laundry.</h2>
                <p class="text-sm text-gray-500 mb-8">Silakan pesan layanan sekarang atau lihat riwayat kalau kamu sudah pernah memesan.</p>
                <div class="flex flex-col sm:flex-row items-center justify-center gap-3">
                    <a href="{{ route('pelanggan.pesanan.baru') }}" class="px-6 py-3 rounded-full bg-blue-600 text-white text-sm font-semibold hover:bg-blue-700 transition">Pesan Sekarang</a>
                    <a href="{{ route('pelanggan.riwayat') }}" class="px-6 py-3 rounded-full border border-gray-200 text-gray-700 text-sm font-semibold hover:bg-gray-50 transition">Lihat Riwayat</a>
                </div>
            </div>
        </div>
    @endif

        <div class="text-center mt-16 mb-8">
            <a href="{{ route('pelanggan.bantuan') }}" class="text-[#0074A6] hover:text-blue-800 font-bold text-sm flex justify-center items-center gap-2 transition">
                <i class="fas fa-headset"></i> Hubungi Admin
            </a>
        </div>
    </main>
</body>
</html>