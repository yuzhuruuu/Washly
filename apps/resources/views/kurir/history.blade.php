<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Kurir - Washly</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
</head>
<body class="bg-gray-100 text-gray-900 pb-24">
    <div class="max-w-4xl mx-auto py-10 px-4">
        <div class="mb-6 flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold">Riwayat Pengantaran</h1>
                <p class="text-sm text-gray-500">Semua tugas selesai yang pernah kamu kerjakan.</p>
            </div>
            <a href="{{ route('kurir.dashboard') }}" class="inline-flex items-center gap-2 px-4 py-3 rounded-xl border border-gray-300 bg-white text-sm font-semibold hover:bg-gray-50">
                <i class="fas fa-arrow-left"></i>
                Kembali ke Dashboard
            </a>
        </div>

        @if($riwayat_tugas->isEmpty())
            <div class="bg-white rounded-3xl shadow-sm border border-gray-200 p-10 text-center text-gray-500">
                <p class="text-sm">Belum ada riwayat tugas selesai.</p>
            </div>
        @else
            <div class="space-y-4">
                @foreach($riwayat_tugas as $tugas)
                    <div class="bg-white rounded-3xl shadow-sm border border-gray-200 p-5">
                        <div class="flex justify-between items-start gap-4 mb-3">
                            <div>
                                <h2 class="text-lg font-bold text-gray-900">#WSH-{{ $tugas->id_pesanan }} - {{ $tugas->pelanggan->nama }}</h2>
                                <p class="text-sm text-gray-500">{{ $tugas->pelanggan->alamat }}</p>
                            </div>
                            <span class="px-3 py-1 rounded-full bg-green-100 text-green-700 text-xs font-semibold uppercase">Selesai</span>
                        </div>
                        <div class="grid gap-2 sm:grid-cols-2 text-sm text-gray-600">
                            <div>
                                <p><span class="font-semibold">Tanggal:</span> {{ optional($tugas->updated_at)->format('d M Y') }}</p>
                                <p><span class="font-semibold">Nomor:</span> {{ $tugas->pelanggan->no_hp }}</p>
                            </div>
                            <div>
                                <p><span class="font-semibold">Berat:</span> {{ $tugas->berat }} kg</p>
                                <p><span class="font-semibold">Total Harga:</span> Rp {{ number_format($tugas->total_harga, 0, ',', '.') }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>

    <nav class="fixed bottom-0 left-0 right-0 bg-white border-t border-gray-200 px-6 py-3 flex justify-between items-center shadow-[0_-2px_10px_rgba(0,0,0,0.05)]">
        <a href="{{ route('kurir.dashboard') }}" class="flex flex-col items-center text-gray-400 hover:text-blue-600">
            <i class="fas fa-home text-xl"></i>
            <span class="text-[10px] mt-1 font-bold">TUGAS</span>
        </a>
        <a href="{{ route('kurir.history') }}" class="flex flex-col items-center text-blue-600">
            <i class="fas fa-history text-xl"></i>
            <span class="text-[10px] mt-1 font-bold">RIWAYAT</span>
        </a>
        <a href="{{ route('kurir.profile.edit') }}" class="flex flex-col items-center text-gray-400 hover:text-blue-600">
            <i class="fas fa-id-badge text-xl"></i>
            <span class="text-[10px] mt-1 font-bold">PROFIL</span>
        </a>
        <a href="{{ route('kurir.settings.edit') }}" class="flex flex-col items-center text-gray-400 hover:text-blue-600">
            <i class="fas fa-cog text-xl"></i>
            <span class="text-[10px] mt-1 font-bold">PENGATURAN</span>
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
