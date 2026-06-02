<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran - Washly</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-gray-50 min-h-screen font-sans text-slate-800 pb-12 antialiased">

    {{-- NAVBAR HEADER --}}
    <nav class="bg-white border-b border-gray-100 shadow-sm sticky top-0 z-50">
        <div class="max-w-4xl mx-auto px-6 py-4 flex items-center justify-between relative">
            {{-- 🔥 FIX RUTE: Kembali ke halaman buat pesanan baru --}}
            <a href="{{ route('pelanggan.pesanan.baru') }}" class="text-gray-600 hover:text-gray-900 transition">
                <i class="fas fa-arrow-left text-lg"></i>
            </a>
            <h1 class="text-lg font-bold text-gray-800">Pembayaran</h1>
            
            {{-- 🔥 FIX RUTE & DATA PELANGGAN --}}
            <a href="{{ route('pelanggan.profil') }}" class="w-8 h-8 rounded-full bg-gray-200 overflow-hidden border border-gray-300 shadow-inner block hover:ring-2 hover:ring-[#00AEEF] hover:shadow-md transition-all">
                <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::guard('pelanggan')->user()?->nama ?? 'User') }}&background=0074A6&color=fff&bold=true" alt="Avatar" class="w-full h-full object-cover">
            </a>
        </div>
    </nav>

    {{-- MAIN CONTENT (Alpine State) --}}
    <main class="max-w-4xl mx-auto px-6 mt-8" 
          x-data="{ 
              tab: 'bank', 
              metodeBank: 'BCA', 
              metodeEwallet: 'GOPAY',
              copied: false,
              waktuSisa: 86399, /* 23:59:59 dalam detik */
              fileName: '',
              
              /* Fungsi otomatis jalan pas halaman dibuka buat ngurangin waktu */
              init() {
                  setInterval(() => {
                      if (this.waktuSisa > 0) this.waktuSisa--;
                  }, 1000);
              },
              
              /* Fungsi buat ubah detik jadi format HH:MM:SS */
              formatWaktu() {
                  let jam = Math.floor(this.waktuSisa / 3600).toString().padStart(2, '0');
                  let menit = Math.floor((this.waktuSisa % 3600) / 60).toString().padStart(2, '0');
                  let detik = (this.waktuSisa % 60).toString().padStart(2, '0');
                  return `${jam}:${menit}:${detik}`;
              },

              copyToClipboard(text) {
                  navigator.clipboard.writeText(text);
                  this.copied = true;
                  setTimeout(() => this.copied = false, 2000);
              },
              
              /* Fungsi buat nangkep file yang diupload */
              handleUpload(event) {
                  const file = event.target.files[0];
                  if (file) {
                      // Validasi sisi klien biar ga lebih dari 2MB
                      if(file.size > 2097152){
                          alert('Ukuran gambar terlalu besar ege! Maksimal 2MB ya.');
                          event.target.value = ''; // Reset input
                          this.fileName = '';
                          return;
                      }
                      this.fileName = file.name;
                  } else {
                      this.fileName = '';
                  }
              }
          }">
        
        {{-- ALERT SUCCESS (Muncul Kalau Selesai Upload) --}}
        @if(session('success'))
            <div class="bg-green-100 border border-green-200 text-green-700 px-5 py-4 rounded-xl text-sm font-bold shadow-sm mb-6 flex items-center gap-3">
                <i class="fas fa-check-circle text-xl text-green-500"></i>
                <p>{{ session('success') }}</p>
            </div>
        @endif

        @error('bukti_bayar')
            <div class="bg-red-100 border border-red-200 text-red-700 px-5 py-4 rounded-xl text-sm font-bold shadow-sm mb-6 flex items-center gap-3">
                <i class="fas fa-exclamation-circle text-xl text-red-500"></i>
                <p>{{ $message }}</p>
            </div>
        @enderror

        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden pb-8">
            
            {{-- TIMER --}}
            <div class="flex justify-center mt-6 mb-4">
                <div class="bg-red-50 text-red-500 rounded-full px-4 py-1.5 text-xs font-bold flex items-center gap-2 border border-red-100 shadow-sm">
                    <i class="far fa-clock animate-pulse"></i> Selesaikan dalam <span x-text="formatWaktu()">23:59:59</span>
                </div>
            </div>

            {{-- BANNER TOTAL (🔥 SINKRON DATABASE) --}}
            <div class="mx-6 bg-gradient-to-r from-[#005B82] to-[#0085BE] rounded-xl p-8 text-center text-white shadow-md relative overflow-hidden mb-6">
                <p class="text-xs text-blue-100 mb-1 opacity-90">Total Pembayaran</p>
                <h2 class="text-4xl font-extrabold mb-3">Rp {{ number_format($pesanan->total_harga ?? 0, 0, ',', '.') }}</h2>
                <div class="inline-block bg-white/20 backdrop-blur-sm rounded-full px-4 py-1.5 text-[11px] font-semibold shadow-inner">
                    ID Pesanan: #WS-{{ date('Y') }}-{{ str_pad($pesanan->id_pesanan ?? $pesanan->id, 3, '0', STR_PAD_LEFT) }}
                </div>
                <div class="absolute -right-10 -bottom-10 w-40 h-40 bg-white opacity-5 rounded-full blur-2xl pointer-events-none"></div>
            </div>

            <div class="px-6">
                {{-- TAB SWITCHER --}}
                <div class="bg-gray-100 p-1 rounded-full flex mb-6 relative z-10">
                    <button @click="tab = 'bank'" 
                            :class="tab === 'bank' ? 'bg-white text-[#0074A6] shadow font-bold' : 'text-gray-500 font-medium hover:text-gray-700'"
                            class="flex-1 py-2.5 rounded-full text-sm transition-all duration-300">
                        Transfer Bank
                    </button>
                    <button @click="tab = 'ewallet'" 
                            :class="tab === 'ewallet' ? 'bg-white text-[#0074A6] shadow font-bold' : 'text-gray-500 font-medium hover:text-gray-700'"
                            class="flex-1 py-2.5 rounded-full text-sm transition-all duration-300">
                        E-Wallet & QRIS
                    </button>
                </div>

                {{-- KONTEN: TRANSFER BANK --}}
                <div x-show="tab === 'bank'" x-transition.opacity.duration.300ms>
                    <p class="text-xs font-bold text-gray-800 mb-3">Pilih Bank</p>
                    
                    <div class="grid grid-cols-2 gap-4 mb-6">
                        <button @click="metodeBank = 'BCA'" 
                                :class="metodeBank === 'BCA' ? 'border-[#0074A6] text-[#0074A6] font-extrabold shadow-sm' : 'border-gray-200 text-gray-400 font-bold hover:border-gray-300'"
                                class="border-2 rounded-lg py-4 text-xl flex justify-center items-center relative transition-all bg-white">
                            BCA
                            <i class="fas fa-check-circle absolute top-2 right-2 text-sm" x-show="metodeBank === 'BCA'"></i>
                        </button>
                        <button @click="metodeBank = 'BNI'" 
                                :class="metodeBank === 'BNI' ? 'border-[#0074A6] text-[#0074A6] font-extrabold shadow-sm' : 'border-gray-200 text-gray-400 font-bold hover:border-gray-300'"
                                class="border-2 rounded-lg py-4 text-xl flex justify-center items-center relative transition-all bg-white">
                            BNI
                            <i class="fas fa-check-circle absolute top-2 right-2 text-sm" x-show="metodeBank === 'BNI'"></i>
                        </button>
                    </div>

                    <div class="border-l-4 border-[#0074A6] pl-5 py-2 mb-8">
                        <p class="text-[11px] text-gray-500 font-medium mb-1">Nomor Rekening (<span x-text="metodeBank"></span>)</p>
                        
                        <div class="bg-gray-100 rounded-xl p-3 flex justify-between items-center mb-4">
                            <span class="text-2xl font-bold text-gray-800 tracking-wider ml-2" 
                                  x-text="metodeBank === 'BCA' ? '882 1920 334' : '012 3456 789'"></span>
                            
                            <button @click="copyToClipboard(metodeBank === 'BCA' ? '8821920334' : '0123456789')" 
                                    class="w-10 h-10 bg-[#38B2AC] hover:bg-[#2c8f8a] text-white rounded-lg flex items-center justify-center transition-colors shadow-sm relative group">
                                <i :class="copied ? 'fas fa-check' : 'far fa-copy'" class="text-lg"></i>
                                <span class="absolute -top-8 bg-gray-800 text-white text-[10px] px-2 py-1 rounded opacity-0 transition-opacity" :class="copied ? 'opacity-100' : 'group-hover:opacity-100'">Salin</span>
                            </button>
                        </div>

                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-full bg-[#EBF4FA] text-[#0074A6] flex items-center justify-center text-xs">
                                <i class="fas fa-building"></i>
                            </div>
                            <div class="leading-tight">
                                <p class="text-[10px] text-gray-400 font-medium">Atas Nama</p>
                                <p class="text-xs font-bold text-gray-800">PT Washly Indonesia</p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- KONTEN: E-WALLET & QRIS --}}
                <div x-show="tab === 'ewallet'" x-transition.opacity.duration.300ms style="display: none;">
                    <p class="text-xs font-bold text-gray-800 mb-3">Pilih E-Wallet / QRIS</p>
                    
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">
                        <template x-for="wallet in ['GOPAY', 'DANA', 'ShopeePay', 'QRIS']">
                            <button @click="metodeEwallet = wallet" 
                                    :class="metodeEwallet === wallet ? 'border-[#0074A6] text-[#0074A6] font-extrabold shadow-sm' : 'border-gray-200 text-gray-400 font-bold hover:border-gray-300'"
                                    class="border-2 rounded-lg py-3 text-sm flex justify-center items-center relative transition-all bg-white">
                                <span x-text="wallet"></span>
                                <i class="fas fa-check-circle absolute top-1.5 right-1.5 text-[10px]" x-show="metodeEwallet === wallet"></i>
                            </button>
                        </template>
                    </div>

                    <div class="border-l-4 border-[#0074A6] pl-5 py-2 mb-8">
                        <template x-if="metodeEwallet !== 'QRIS'">
                            <div>
                                <p class="text-[11px] text-gray-500 font-medium mb-1">Nomor Handphone (<span x-text="metodeEwallet"></span>)</p>
                                <div class="bg-gray-100 rounded-xl p-3 flex justify-between items-center mb-4">
                                    <span class="text-2xl font-bold text-gray-800 tracking-wider ml-2">0812 3456 7890</span>
                                    <button @click="copyToClipboard('081234567890')" 
                                            class="w-10 h-10 bg-[#38B2AC] hover:bg-[#2c8f8a] text-white rounded-lg flex items-center justify-center transition-colors shadow-sm relative group">
                                        <i :class="copied ? 'fas fa-check' : 'far fa-copy'" class="text-lg"></i>
                                    </button>
                                </div>
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-full bg-[#EBF4FA] text-[#0074A6] flex items-center justify-center text-xs">
                                        <i class="fas fa-building"></i>
                                    </div>
                                    <div class="leading-tight">
                                        <p class="text-[10px] text-gray-400 font-medium">Atas Nama</p>
                                        <p class="text-xs font-bold text-gray-800">PT Washly Indonesia</p>
                                    </div>
                                </div>
                            </div>
                        </template>

                        <template x-if="metodeEwallet === 'QRIS'">
                            <div class="flex flex-col items-center justify-center bg-gray-50 border border-gray-200 rounded-xl p-6">
                                <div class="w-90 h-120 bg-white border border-gray-200 shadow-sm p-2 rounded-lg mb-3 flex items-center justify-center overflow-hidden">
                                    <img src="{{ asset('images/qris.png') }}" alt="QRIS Washly" class="w-full h-full object-contain">
                                </div>
                                <p class="text-xs text-gray-500 text-center">Scan QR Code ini menggunakan aplikasi M-Banking atau E-Wallet Anda.</p>
                            </div>
                        </template>
                    </div>
                </div>

                {{-- 🔥 FORM KIRIM GAMBAR (DI BUNGKUS KE CONTROLLER) 🔥 --}}
                <form action="{{ route('pelanggan.upload.pembayaran', $pesanan->id_pesanan ?? $pesanan->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    {{-- AREA UPLOAD --}}
                    <div class="relative border-2 border-dashed border-gray-300 rounded-xl bg-gray-50 p-8 flex flex-col items-center justify-center hover:bg-gray-100 transition-colors mb-8 group overflow-hidden">
                        
                        {{-- Input file di-binding dengan Alpine handleUpload --}}
                        <input type="file" name="bukti_bayar" accept="image/png, image/jpeg, image/jpg" @change="handleUpload($event)" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-20" required>
                        
                        {{-- Tampilan saat BELUM ada file --}}
                        <div x-show="fileName === ''" class="flex flex-col items-center relative z-10 pointer-events-none">
                            <div class="w-12 h-12 bg-gray-200 text-gray-600 rounded-full flex items-center justify-center text-xl mb-3 group-hover:bg-[#0074A6] group-hover:text-white transition-colors shadow-sm">
                                <i class="fas fa-file-upload"></i>
                            </div>
                            <p class="text-sm font-bold text-gray-800 mb-1">Unggah Bukti Transfer</p>
                            <p class="text-[10px] text-gray-500 font-medium">Format JPG, PNG (Maks. 2MB)</p>
                        </div>

                        {{-- Tampilan saat SUDAH ada file yang dipilih --}}
                        <div x-show="fileName !== ''" style="display: none;" class="flex flex-col items-center relative z-10 pointer-events-none">
                            <div class="w-12 h-12 bg-green-100 text-green-600 rounded-full flex items-center justify-center text-xl mb-3 shadow-sm border border-green-200">
                                <i class="fas fa-check"></i>
                            </div>
                            <p class="text-sm font-bold text-gray-800 mb-1" x-text="fileName"></p>
                            <p class="text-[10px] text-[#0074A6] font-semibold">Klik area ini untuk mengganti gambar</p>
                        </div>
                    </div>

                    {{-- TOMBOL KONFIRMASI --}}
                    <button type="submit" class="w-full bg-[#005B82] hover:bg-[#004B6D] text-white font-bold py-4 rounded-full transition-all duration-300 shadow-lg flex justify-center items-center gap-2 active:scale-[0.98]"
                            :class="fileName === '' ? 'opacity-50 cursor-not-allowed' : ''"
                            :disabled="fileName === ''">
                        <i class="fas fa-check-circle text-sm"></i> Konfirmasi Pembayaran
                    </button>
                </form>

            </div>
        </div>
    </main>

</body>
</html>