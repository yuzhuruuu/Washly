<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kurir Dashboard - Washly</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-gray-100 text-gray-800 font-sans pb-24">

    <div class="bg-white p-6 shadow-sm border-b border-gray-200">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-xl font-bold text-gray-900">Halo, {{ auth('kurir')->user()->nama }}!</h1>
                <p class="text-sm text-gray-500">Petugas Kurir Washly</p>
            </div>
            <div class="h-12 w-12 bg-blue-100 rounded-full flex items-center justify-center text-blue-600">
                <i class="fas fa-user-tie text-xl"></i>
            </div>
        </div>
    </div>

    <div class="p-4 grid grid-cols-2 gap-4">
        <div class="bg-white p-4 rounded-xl shadow-sm border border-gray-200">
            <span class="text-xs font-bold text-gray-400 uppercase">Tugas Baru</span>
            <p class="text-2xl font-bold text-blue-600">{{ $tugas_kurir->count() }}</p>
        </div>
        <div class="bg-white p-4 rounded-xl shadow-sm border border-gray-200">
            <span class="text-xs font-bold text-gray-400 uppercase">Riwayat</span>
            <p class="text-2xl font-bold text-gray-700">{{ $riwayat_tugas->count() }}</p>
        </div>
    </div>

    <div class="px-4">
        <div class="flex justify-between items-center mb-4">
            <h2 class="font-bold text-gray-700">Daftar Tugas Jemput/Antar</h2>
            <span class="text-xs text-blue-600 font-medium">Lihat Semua</span>
        </div>

        @forelse($tugas_kurir as $tugas)
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-4 mb-4">
            <div class="flex justify-between items-start mb-3">
                <div>
                    <h3 class="font-bold text-gray-900">{{ $tugas->pelanggan->nama }}</h3>
                    <p class="text-xs text-gray-500">ID Pesanan: #WSH-{{ $tugas->id_pesanan }}</p>
                </div>
                <span class="px-2 py-1 bg-yellow-100 text-yellow-700 text-[10px] font-bold rounded-lg uppercase">
                    {{ $tugas->status }}
                </span>
            </div>
            
            <div class="space-y-2 mb-4 text-sm text-gray-600">
                <p><i class="fas fa-map-marker-alt w-5 text-red-500"></i> {{ $tugas->pelanggan->alamat }}</p>
                <p><i class="fas fa-phone w-5 text-green-500"></i> {{ $tugas->pelanggan->no_hp }}</p>
            </div>

            <div class="grid grid-cols-2 gap-2">
            <a href="https://wa.me/{{ $tugas->pelanggan->no_hp }}" target="_blank" class="w-full bg-green-500 text-white text-center py-3 rounded-xl font-bold">
                Hubungi (WhatsApp)
            </a>
                <form action="{{ route('kurir.tugas.selesai', $tugas->id_pesanan) }}" method="POST">
                    @csrf
                    <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 rounded-xl transition duration-200">
                        Selesaikan Tugas
                    </button>
                </form>
            </div>
        </div>
        @empty
        <div class="bg-white border-2 border-dashed border-gray-200 rounded-2xl p-10 text-center">
            <p class="text-gray-400 text-sm italic">Belum ada tugas buat kamu, ege.</p>
        </div>
        @endforelse
    </div>

    <nav class="fixed bottom-0 left-0 right-0 bg-white border-t border-gray-200 px-6 py-3 flex justify-between items-center shadow-[0_-2px_10px_rgba(0,0,0,0.05)]">
        <a href="{{ route('kurir.dashboard') }}" class="flex flex-col items-center text-blue-600">
            <i class="fas fa-home text-xl"></i>
            <span class="text-[10px] mt-1 font-bold">TUGAS</span>
        </a>
        <a href="#" class="flex flex-col items-center text-gray-400">
            <i class="fas fa-history text-xl"></i>
            <span class="text-[10px] mt-1 font-bold">RIWAYAT</span>
        </a>
        <a href="{{ route('profile.edit') }}" class="flex flex-col items-center text-gray-400">
            <i class="fas fa-user-circle text-xl"></i>
            <span class="text-[10px] mt-1 font-bold">PROFIL</span>
        </a>
        <form action="{{ route('logout') }}" method="POST" class="inline">
            @csrf
            <button type="submit" class="flex flex-col items-center text-red-400">
                <i class="fas fa-power-off text-xl"></i>
                <span class="text-[10px] mt-1 font-bold">KELUAR</span>
            </button>
        </form>
    </nav>

</body>
</html>