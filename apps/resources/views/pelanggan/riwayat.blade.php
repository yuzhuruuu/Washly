<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Pesanan - Washly</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="bg-[#F8FAFC] min-h-screen font-sans text-slate-800 pb-20 antialiased relative overflow-x-hidden">

    {{-- Background Glowing Blobs --}}
    <div class="absolute top-0 left-0 w-96 h-96 bg-blue-100/40 rounded-full blur-[100px] -translate-x-1/2 -translate-y-1/2 pointer-events-none z-0"></div>
    <div class="absolute top-1/3 right-0 w-[400px] h-[400px] bg-cyan-100/30 rounded-full blur-[100px] translate-x-1/3 pointer-events-none z-0"></div>

    {{-- NAVBAR --}}
    <nav class="bg-white/80 backdrop-blur-md border-b border-gray-100 shadow-sm sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center relative">
            <div class="flex items-center"><img src="{{ asset('images/w-g.svg') }}" alt="Washly" class="h-8"></div>
            <div class="hidden md:flex space-x-10 text-sm font-semibold absolute left-1/2 -translate-x-1/2">
                <a href="{{ url('/dashboard/pelanggan') }}" class="text-gray-400 hover:text-gray-600 transition">Beranda</a>
                <a href="{{ url('/layanan/pesan') }}" class="text-gray-400 hover:text-gray-600 transition">Layanan</a>
                {{-- Tab Riwayat Aktif --}}
                <a href="#" class="text-[#0074A6] border-b-2 border-[#0074A6] pb-1">Riwayat</a>
                <a href="#" class="text-gray-400 hover:text-gray-600 transition">Tentang Kami</a>
            </div>
            <div class="flex items-center space-x-5">
                <button class="text-gray-400 hover:text-[#0074A6] transition"><i class="far fa-bell text-lg"></i></button>
                <button class="text-gray-400 hover:text-[#0074A6] transition"><i class="far fa-question-circle text-lg"></i></button>
                <div class="w-8 h-8 rounded-full border border-gray-200 overflow-hidden shadow-sm">
                    <img src="https://ui-avatars.com/api/?name=Justin+Bieber&background=0074A6&color=fff" alt="Profile" class="w-full h-full object-cover">
                </div>
            </div>
        </div>
    </nav>

    {{-- MAIN CONTENT (Dengan Alpine.js untuk Filter Tabs) --}}
    <main class="max-w-6xl mx-auto px-6 pt-12 relative z-10" x-data="{ activeTab: 'semua' }">
        
        {{-- Header Title --}}
        <div class="mb-8">
            <h1 class="text-3xl font-black text-gray-800 mb-2">Riwayat Pesanan</h1>
            <p class="text-gray-500 text-sm">Lacak semua cucian bersihmu di sini.</p>
        </div>

        {{-- Filter Tabs (Udah Anti-Hilang) --}}
        <div class="flex flex-wrap gap-3 mb-10">
            <button @click="activeTab = 'semua'" 
                    class="px-6 py-2 rounded-full text-sm font-bold transition shadow-sm"
                    :class="activeTab === 'semua' ? 'bg-blue-500 text-white shadow-blue-200' : 'bg-gray-100 text-gray-500 hover:bg-gray-200'">
                Semua
            </button>
            <button @click="activeTab = 'menunggu'" 
                    class="px-6 py-2 rounded-full text-sm font-bold transition shadow-sm"
                    :class="activeTab === 'menunggu' ? 'bg-blue-500 text-white shadow-blue-200' : 'bg-gray-100 text-gray-500 hover:bg-gray-200'">
                Menunggu
            </button>
            <button @click="activeTab = 'diproses'" 
                    class="px-6 py-2 rounded-full text-sm font-bold transition shadow-sm"
                    :class="activeTab === 'diproses' ? 'bg-blue-500 text-white shadow-blue-200' : 'bg-gray-100 text-gray-500 hover:bg-gray-200'">
                Diproses
            </button>
            <button @click="activeTab = 'selesai'" 
                    class="px-6 py-2 rounded-full text-sm font-bold transition shadow-sm"
                    :class="activeTab === 'selesai' ? 'bg-blue-500 text-white shadow-blue-200' : 'bg-gray-100 text-gray-500 hover:bg-gray-200'">
                Selesai
            </button>
        </div>

        {{-- GRID CARDS --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

            {{-- CARD 1: SELESAI --}}
            <div x-show="activeTab === 'semua' || activeTab === 'selesai'" x-transition.opacity
                 class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden relative flex flex-col group hover:shadow-md transition">
                
                {{-- Top Border Line (Jurus Paksa Pakai Inline Style!) --}}
                <div class="absolute top-0 left-0 w-full h-1.5" style="background-color: #00AEEF;"></div>
                
                <div class="p-6 flex-1">
                    {{-- Card Header --}}
                    <div class="flex justify-between items-start mb-6">
                        <div class="flex gap-4">
                            {{-- Icon SVG Mesin Cuci Anti-Hilang --}}
                            <div class="w-10 h-10 bg-blue-50 text-[#00AEEF] rounded-full flex items-center justify-center">
                                <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M8 6C9.1 6 10 5.1 10 4C10 2.9 9.1 2 8 2C6.9 2 6 2.9 6 4C6 5.1 6.9 6 8 6M14 6H20V4H14V6M19.1 22C20.2 22 21.1 21.1 21.1 20V10C21.1 8.9 20.2 8 19.1 8H4.9C3.8 8 2.9 8.9 2.9 10V20C2.9 21.1 3.8 22 4.9 22H19.1M12 11C14.2 11 16 12.8 16 15C16 17.2 14.2 19 12 19C9.8 19 8 17.2 8 15C8 12.8 9.8 11 12 11M12 13C10.9 13 10 13.9 10 15C10 16.1 10.9 17 12 17C13.1 17 14 16.1 14 15C14 13.9 13.1 13 12 13Z" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-[10px] font-bold text-gray-400 uppercase tracking-wider">ID: #WSL-9821</p>
                                <h3 class="font-bold text-gray-800 text-sm mt-0.5">Cuci Kering & Setrika</h3>
                            </div>
                        </div>
                        <div class="bg-cyan-50 text-[#00AEEF] px-3 py-1 rounded-full text-[10px] font-bold">
                            Selesai
                        </div>
                    </div>

                    {{-- Detail --}}
                    <div class="text-xs font-medium text-gray-500 space-y-1 mb-6">
                        <p>12 Okt 2023 • 09:30 WIB</p>
                        <p>3 kg • Regular</p>
                    </div>
                </div>

                {{-- Footer Line --}}
                <div class="border-t border-gray-100 px-6 py-4 flex justify-between items-center bg-gray-50/50">
                    <div>
                        <p class="text-[10px] font-bold text-gray-400 mb-0.5">Total Biaya</p>
                        <p class="text-xl font-black text-[#0074A6]">Rp 45.000</p>
                    </div>
                    <button class="px-5 py-2 bg-blue-50 text-[#0074A6] hover:bg-[#0074A6] hover:text-white rounded-full text-xs font-bold transition">
                        Pesan Lagi
                    </button>
                </div>
            </div>

            {{-- CARD 2: DIPROSES --}}
            <div x-show="activeTab === 'semua' || activeTab === 'diproses'" x-transition.opacity
                 class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden relative flex flex-col group hover:shadow-md transition">
                <div class="absolute top-0 left-0 w-full h-1.5 bg-orange-500"></div>
                
                <div class="p-6 flex-1">
                    <div class="flex justify-between items-start mb-6">
                        <div class="flex gap-4">
                            <div class="w-10 h-10 bg-orange-50 text-orange-500 rounded-full flex items-center justify-center text-lg">
                                <i class="fas fa-tint"></i>
                            </div>
                            <div>
                                <p class="text-[10px] font-bold text-gray-400 uppercase tracking-wider">ID: #WSL-9830</p>
                                <h3 class="font-bold text-gray-800 text-sm mt-0.5">Cuci Karpet</h3>
                            </div>
                        </div>
                        <div class="bg-orange-50 text-orange-600 px-3 py-1 rounded-full text-[10px] font-bold">
                            Diproses
                        </div>
                    </div>

                    <div class="text-xs font-medium text-gray-500 space-y-1 mb-4">
                        <p>15 Okt 2023 • 14:00 WIB</p>
                        <p>1 pcs • Express</p>
                    </div>

                    {{-- Progress Bar Mini --}}
                    <div class="w-full bg-gray-100 rounded-full h-1.5 mb-2 overflow-hidden">
                        <div class="bg-orange-500 h-1.5 rounded-full w-2/3"></div>
                    </div>
                </div>

                <div class="border-t border-gray-100 px-6 py-4 flex justify-between items-center bg-gray-50/50">
                    <div>
                        <p class="text-[10px] font-bold text-gray-400 mb-0.5">Total Biaya</p>
                        <p class="text-xl font-black text-[#0074A6]">Rp 120.000</p>
                    </div>
                    <button class="px-5 py-2 bg-gray-100 text-gray-600 hover:bg-gray-200 rounded-full text-xs font-bold transition">
                        Lihat Detail
                    </button>
                </div>
            </div>

            {{-- CARD 3: MENUNGGU --}}
            <div x-show="activeTab === 'semua' || activeTab === 'menunggu'" x-transition.opacity
                 class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden relative flex flex-col group hover:shadow-md transition">
                <div class="absolute top-0 left-0 w-full h-1.5 bg-red-500"></div>
                
                <div class="p-6 flex-1">
                    <div class="flex justify-between items-start mb-6">
                        <div class="flex gap-4">
                            <div class="w-10 h-10 bg-red-50 text-red-500 rounded-full flex items-center justify-center text-lg">
                                <i class="fas fa-tshirt"></i>
                            </div>
                            <div>
                                <p class="text-[10px] font-bold text-gray-400 uppercase tracking-wider">ID: #WSL-9842</p>
                                <h3 class="font-bold text-gray-800 text-sm mt-0.5">Setrika Saja</h3>
                            </div>
                        </div>
                        <div class="bg-red-50 text-red-600 px-3 py-1 rounded-full text-[10px] font-bold">
                            Menunggu
                        </div>
                    </div>

                    <div class="text-xs font-medium text-gray-500 space-y-1 mb-6">
                        <p>Hari Ini • 08:00 WIB</p>
                        <p>5 kg • Regular</p>
                    </div>
                </div>

                <div class="border-t border-gray-100 px-6 py-4 flex justify-between items-center bg-gray-50/50">
                    <div>
                        <p class="text-[10px] font-bold text-gray-400 mb-0.5">Total Biaya</p>
                        <p class="text-xl font-black text-[#0074A6]">Rp 35.000</p>
                    </div>
                    <button class="px-5 py-2 bg-blue-50 text-[#0074A6] hover:bg-[#0074A6] hover:text-white rounded-full text-xs font-bold transition">
                        Lacak Kurir
                    </button>
                </div>
            </div>

        </div>
    </main>

</body>
</html>