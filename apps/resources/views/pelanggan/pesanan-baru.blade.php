<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buat Pesanan Baru - Washly</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    {{-- Alpine JS buat efek interaktif --}}
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-[#F8FAFC] min-h-screen font-sans text-slate-800 pb-12 antialiased">

    {{-- NAVBAR --}}
    <nav class="bg-white border-b border-gray-100 shadow-sm sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center relative">
            <div class="flex items-center">
                <img src="{{ asset('images/w-g.svg') }}" alt="Washly" class="h-8">
            </div>

            <div class="hidden md:flex space-x-10 text-sm font-semibold absolute left-1/2 -translate-x-1/2">
                <a href="{{ route('pelanggan.dashboard') }}" class="text-gray-400 hover:text-gray-600 transition">Beranda</a>
                <a href="{{ route('pelanggan.pesanan.baru') }}" class="text-[#0074A6] border-b-2 border-[#0074A6] pb-1">Layanan</a>
                <a href="{{ route('pelanggan.riwayat') }}" class="text-gray-400 hover:text-gray-600 transition">Riwayat</a>
            </div>

            <div class="flex items-center space-x-5">
               <span class="text-sm text-gray-500 font-medium">Halo, {{ Auth::guard('pelanggan')->user()?->nama ?? 'Pelanggan' }}!</span>
                <button class="text-[#0074A6] hover:text-blue-800"><i class="far fa-bell text-lg"></i></button>
                <div class="w-8 h-8 rounded-full bg-gray-200 overflow-hidden border border-gray-300 shadow-inner">
                    <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::guard('pelanggan')->user()?->nama ?? 'User') }}&background=0074A6&color=fff&bold=true" alt="Avatar" class="w-full h-full object-cover">
                </div>
            </div>
        </div>
    </nav>

    {{-- KONTEN UTAMA --}}
    {{-- OTAK ALPINE.JS BARU --}}
    <main class="max-w-[1200px] mx-auto px-6 mt-10" 
          x-data="{ 
              step: 1, 
              layanan: '', 
              layananId: null,
              harga: 0, 
              berat: 0, 
              alamat: '',
              pilihLayanan(nama, hrg, id) {
                  this.layanan = nama;
                  this.harga = hrg;
                  this.layananId = id;
                  if (this.step === 1) {
                      this.step = 2; 
                  }
              },
              lanjutKeKonfirmasi() {
                  if(this.berat > 0 && this.layanan !== '' && this.alamat.trim() !== '') {
                      this.step = 3; 
                      setTimeout(() => {
                          this.$refs.orderForm.submit();
                      }, 300);
                  }
              }
          }">
        
        {{-- HEADER & STEPPER --}}
        <div class="mb-14">
            <h1 class="text-3xl font-bold text-[#005B82] mb-3 leading-tight">Buat Pesanan Baru</h1>
            <p class="text-sm text-gray-400 font-medium leading-relaxed">
                Silakan lengkapi detail cucian Anda dan kami akan mengurus sisanya.
            </p>

            {{-- STEPPER UI INTERAKTIF (Diperbaiki: Garis Presisi) --}}
            <div class="flex items-center justify-between max-w-lg mt-12 relative w-full mx-auto">
                
                {{-- Step 1: Pilih Layanan --}}
                <div class="flex flex-col items-center cursor-pointer relative z-10" @click="step = 1">
                    <div :class="step >= 2 ? 'bg-[#005B82] text-white shadow-lg shadow-blue-800/10' : 'bg-[#0074A6] text-white ring-8 ring-[#E6F3FA] shadow-lg shadow-blue-800/10'" 
                         class="w-12 h-12 rounded-full flex items-center justify-center font-bold text-lg transition-all duration-300">
                        <i class="fas fa-check" x-show="step >= 2"></i>
                        <span x-show="step === 1">1</span>
                    </div>
                    <span class="text-sm font-bold mt-4 absolute top-full text-center w-32" :class="step >= 1 ? 'text-[#005B82]' : 'text-gray-400'">Pilih Layanan</span>
                </div>

                {{-- Garis Penghubung 1 ke 2 --}}
                <div class="flex-1 h-1.5 mx-4 rounded-full transition-colors duration-500" 
                     :class="step >= 2 ? 'bg-[#005B82]' : 'bg-gray-100'"></div>

                {{-- Step 2: Detail --}}
                <div class="flex flex-col items-center relative z-10">
                    <div :class="step === 2 ? 'bg-[#0074A6] text-white ring-8 ring-[#E6F3FA] shadow-lg shadow-blue-800/10' : (step > 2 ? 'bg-[#005B82] text-white' : 'bg-white text-gray-300 ring-4 ring-gray-50 border-2 border-gray-100')" 
                         class="w-12 h-12 rounded-full flex items-center justify-center font-bold text-lg transition-all duration-300">
                        <i class="fas fa-check" x-show="step > 2" style="display: none;"></i>
                        <span x-show="step <= 2">2</span>
                    </div>
                    <span class="text-sm mt-4 absolute top-full text-center w-32" :class="step >= 2 ? 'text-[#0074A6] font-bold' : 'text-gray-400 font-semibold'">Detail</span>
                </div>

                {{-- Garis Penghubung 2 ke 3 --}}
                <div class="flex-1 h-1.5 mx-4 rounded-full transition-colors duration-500" 
                     :class="step >= 3 ? 'bg-[#005B82]' : 'bg-gray-100'"></div>

                {{-- Step 3: Konfirmasi --}}
                <div class="flex flex-col items-center relative z-10">
                    <div :class="step === 3 ? 'bg-[#0074A6] text-white ring-8 ring-[#E6F3FA] shadow-lg shadow-blue-800/10' : 'bg-white text-gray-300 ring-4 ring-gray-50 border-2 border-gray-100'" 
                         class="w-12 h-12 rounded-full flex items-center justify-center font-bold text-lg transition-all duration-300">
                        3
                    </div>
                    <span class="text-sm font-semibold mt-4 absolute top-full text-center w-32" :class="step === 3 ? 'text-[#0074A6]' : 'text-gray-400'">Konfirmasi</span>
                </div>
            </div>
            
            {{-- Spacer tambahan biar teks stepper yang absolute gak ketabrak konten di bawahnya --}}
            <div class="h-8"></div>
            </div>
        </div>

        {{-- FORM GRID --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-10 mt-16">
            
            {{-- KIRI: FORM DETAIL --}}
            <div class="md:col-span-2 space-y-8">
                
                {{-- Card 1: Pilih Layanan --}}
                <div class="bg-white rounded-[2rem] p-8 shadow-sm border border-gray-100 relative transition-all"
                     :class="step === 1 ? 'ring-2 ring-[#0074A6] ring-offset-4' : ''">
                    <div class="flex items-center gap-3 mb-8">
                        <i class="fas fa-clipboard-list text-[#005B82] text-xl"></i>
                        <h2 class="text-lg font-bold text-[#005B82]">Pilih Layanan</h2>
                    </div>

                    {{-- Button Group Interaktif --}}
                    <div class="flex flex-wrap gap-4 mb-8">
                        <button @click="pilihLayanan('Cuci Saja', 7000, 1)" 
                                :class="layanan === 'Cuci Saja' ? 'border-2 border-[#0074A6] bg-[#E6F3FA] text-[#0074A6] font-bold shadow-md shadow-blue-100' : 'border border-gray-200 text-gray-500 font-medium bg-white hover:border-[#0074A6]'"
                                class="px-7 py-3 rounded-full text-sm transition-all duration-300">
                            Cuci Saja
                        </button>
                        <button @click="pilihLayanan('Setrika Saja', 6000, 2)" 
                                :class="layanan === 'Setrika Saja' ? 'border-2 border-[#0074A6] bg-[#E6F3FA] text-[#0074A6] font-bold shadow-md shadow-blue-100' : 'border border-gray-200 text-gray-500 font-medium bg-white hover:border-[#0074A6]'"
                                class="px-7 py-3 rounded-full text-sm transition-all duration-300">
                            Setrika Saja
                        </button>
                        <button @click="pilihLayanan('Cuci + Setrika', 15000, 3)" 
                                :class="layanan === 'Cuci + Setrika' ? 'border-2 border-[#0074A6] bg-[#E6F3FA] text-[#0074A6] font-bold shadow-md shadow-blue-100' : 'border border-gray-200 text-gray-500 font-medium bg-white hover:border-[#0074A6]'"
                                class="px-7 py-3 rounded-full text-sm transition-all duration-300">
                            Cuci + Setrika
                        </button>
                    </div>

                    <p class="text-sm font-semibold text-gray-800 leading-tight">
                        Harga / kg : <span x-text="harga > 0 ? harga.toLocaleString('id-ID') : '0'">0</span>
                    </p>
                </div>

                {{-- Card 2: Detail Tambahan (Terkunci kalau belum pilih layanan) --}}
                <div class="bg-white rounded-[2rem] p-8 shadow-sm border border-gray-100 transition-all duration-300"
                     :class="step < 2 ? 'opacity-50 pointer-events-none' : 'opacity-100'">
                    <div class="flex items-center gap-3 mb-8">
                        <i class="far fa-file-alt text-[#005B82] text-xl"></i>
                        <h2 class="text-lg font-bold text-[#005B82]">Detail Tambahan</h2>
                    </div>

                    <div class="grid grid-cols-1 gap-8">
                        <div>
                            <label class="block text-sm font-semibold text-gray-800 mb-2">Alamat Pickup</label>
                            <textarea x-model="alamat" name="alamat" form="orderForm" rows="3" class="w-full rounded-xl border border-gray-200 bg-[#F4F7FB] px-4 py-3 text-sm text-gray-700 focus:border-[#0074A6] focus:ring-2 focus:ring-[#0074A6] focus:outline-none" placeholder="Masukkan alamat lengkap pickup"></textarea>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-end">
                            <div>
                                <label class="block text-sm font-semibold text-gray-800 mb-2">Perkiraan Berat (kg)</label>
                                <div class="flex items-center bg-[#F4F7FB] rounded-xl p-1.5 border border-transparent focus-within:border-[#0074A6] transition h-[52px]">
                                    <button @click="if(berat > 0) berat--" type="button" class="w-10 h-full flex items-center justify-center text-gray-500 hover:text-[#0074A6] bg-white rounded-lg shadow-sm font-bold text-lg active:scale-95 transition-all">-</button>
                                    <input type="number" x-model="berat" class="w-full h-full text-center bg-transparent border-none outline-none focus:ring-0 text-xl font-extrabold text-gray-800 shadow-none appearance-none [&::-webkit-inner-spin-button]:appearance-none [&::-webkit-outer-spin-button]:appearance-none m-0" readonly>
                                    <button @click="berat++" type="button" class="w-10 h-full flex items-center justify-center text-[#0074A6] hover:bg-[#0074A6] hover:text-white bg-white rounded-lg shadow-sm font-bold text-lg active:scale-95 transition-all">+</button>
                                </div>
                            </div>

                            <div>
                                <label class="block text-sm font-semibold text-gray-800 mb-2">Tanggal Pickup</label>
                                <div class="relative">
                                    <input type="date" class="w-full h-[52px] bg-[#F4F7FB] border-none rounded-xl px-4 text-sm focus:ring-2 focus:ring-[#0074A6] text-gray-700 font-semibold focus:outline-none">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            {{-- KANAN: RINGKASAN --}}
            <div class="md:col-span-1">
                <form x-ref="orderForm" id="orderForm" action="{{ route('pesanan.store') }}" method="POST" class="bg-white rounded-[2rem] p-8 shadow-xl shadow-blue-900/5 border border-gray-50 sticky top-28 w-full max-w-sm mx-auto md:w-auto">
                    @csrf
                    <input type="hidden" name="id_layanan" :value="layananId">
                    <input type="hidden" name="berat" :value="berat">
                    <div class="flex justify-between items-center mb-8 border-b border-gray-100 pb-5">
                        <h2 class="text-xl font-bold text-[#005B82]">Ringkasan</h2>
                        <i class="fas fa-receipt text-[#0074A6] text-xl opacity-80"></i>
                    </div>

                    <div class="space-y-4 mb-8">
                        <div class="flex justify-between items-center">
                            <span class="text-sm font-medium text-gray-400">Layanan</span>
                            {{-- Teks berubah otomatis --}}
                            <span class="text-sm font-bold" :class="layanan === '' ? 'text-gray-400 italic' : 'text-gray-800'" x-text="layanan === '' ? 'Belum dipilih' : layanan">Belum dipilih</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-sm font-medium text-gray-400">Metode</span>
                            <span class="text-sm font-bold text-gray-800">Pickup</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-sm font-medium text-gray-400">Estimasi Berat</span>
                            <span class="text-sm font-bold text-gray-800" x-text="berat + ' kg'">3 kg</span>
                        </div>
                    </div>

                    <p class="text-[10px] text-gray-400 italic mb-10 leading-tight">
                        *Harga akhir akan disesuaikan saat penimbangan aktual
                    </p>

                    <div class="bg-[#F0F7FA] rounded-2xl p-6 flex justify-between items-center mb-8 border border-blue-50 shadow-inner">
                        <span class="text-xs font-semibold text-gray-500">Estimasi Biaya</span>
                        {{-- Harga ngitung otomatis dan sinkron --}}
                        <span class="text-2xl font-bold text-[#0074A6]" x-text="'Rp ' + (layanan !== '' ? (berat * harga).toLocaleString('id-ID') : '0')">Rp 0</span>
                    </div>

                    
                    {{-- Tombol Lanjutkan (Cuma 1x Klik!) --}}
                    <button @click="lanjutKeKonfirmasi()"
                            type="button"
                            class="w-full bg-[#005B82] hover:bg-[#004B6D] text-white font-bold py-4 rounded-full transition-all duration-300 shadow-lg shadow-blue-800/20 flex justify-center items-center gap-2.5 active:scale-[0.98]"
                            :class="(step < 2 || berat === 0 || layananId === null || alamat.trim() === '') ? 'opacity-50 cursor-not-allowed' : ''"
                            :disabled="step < 2 || berat === 0 || layananId === null || alamat.trim() === '' || step === 3">
                        {{-- Teks berubah jadi memproses pas diklik --}}
                        <span x-text="step === 3 ? 'Memproses...' : 'Lanjutkan'">Lanjutkan</span> 
                        <i class="fas fa-arrow-right text-xs" x-show="step < 3"></i>
                        <i class="fas fa-circle-notch fa-spin text-xs" x-show="step === 3" style="display: none;"></i>
                    </button>

                    <div class="flex justify-center items-center gap-5 mt-7 text-[10px] font-semibold text-gray-400">
                        <span class="flex items-center gap-1.5"><i class="fas fa-shield-alt text-gray-300"></i> Aman</span>
                        <span class="flex items-center gap-1.5"><i class="fas fa-headset text-gray-300"></i> 24/7 Bantuan</span>
                    </div>
                </form>
            </div>

        </div>

    </main>

</body>
</html>