<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Kurir - Washly</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
</head>
<body class="bg-gray-100 text-gray-900">
    <div class="max-w-4xl mx-auto py-10 px-4">
        <div class="mb-6 flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold">Profil Kurir</h1>
                <p class="text-sm text-gray-500">Informasi dasar yang tersimpan untuk akun kurirmu.</p>
            </div>
            <div class="inline-flex items-center gap-2 px-4 py-3 rounded-xl border border-gray-300 bg-white text-sm font-semibold">
                <i class="fas fa-user text-blue-600"></i>
                {{ $user->username }}
            </div>
        </div>

        @if (session('status') === 'profile-updated')
            <div class="bg-green-50 border border-green-200 text-green-700 p-4 rounded-xl mb-6">
                Profil berhasil diperbarui.
            </div>
        @endif

        <div class="bg-white rounded-3xl shadow-sm border border-gray-200 p-6">
            <h2 class="text-xl font-bold mb-4">Detail Profil</h2>
            <form action="{{ route('kurir.profile.update') }}" method="POST" class="space-y-4">
                @csrf
                @method('patch')

                <div>
                    <label class="block text-sm font-semibold text-gray-700">Nama Lengkap</label>
                    <input type="text" name="nama" value="{{ old('nama', $user->nama) }}" class="mt-1 block w-full rounded-2xl border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required>
                    <span class="text-xs text-gray-500">Nama yang tampil saat bertugas dan di dashboard.</span>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700">Nomor WhatsApp</label>
                    <input type="text" name="no_hp" value="{{ old('no_hp', $user->no_hp) }}" class="mt-1 block w-full rounded-2xl border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required>
                    <span class="text-xs text-gray-500">Nomor kontak pelanggan yang bisa dihubungi.</span>
                </div>

                <div class="flex justify-between items-center">
                    <a href="{{ route('kurir.settings.edit') }}" class="inline-flex items-center gap-2 text-sm font-semibold text-blue-600 hover:text-blue-700">
                        <i class="fas fa-cog"></i>
                        Pengaturan Akun
                    </a>
                    <button type="submit" class="inline-flex items-center justify-center rounded-2xl bg-blue-600 px-5 py-3 text-sm font-semibold text-white hover:bg-blue-700">Simpan Profil</button>
                </div>
            </form>
        </div>
    </div>

    <nav class="fixed bottom-0 left-0 right-0 bg-white border-t border-gray-200 px-6 py-3 flex justify-between items-center shadow-[0_-2px_10px_rgba(0,0,0,0.05)]">
        <a href="{{ route('kurir.dashboard') }}" class="flex flex-col items-center text-gray-400 hover:text-blue-600">
            <i class="fas fa-home text-xl"></i>
            <span class="text-[10px] mt-1 font-bold">DASHBOARD</span>
        </a>
        <a href="{{ route('kurir.history') }}" class="flex flex-col items-center text-gray-400 hover:text-blue-600">
            <i class="fas fa-history text-xl"></i>
            <span class="text-[10px] mt-1 font-bold">RIWAYAT</span>
        </a>
        <a href="{{ route('kurir.profile.edit') }}" class="flex flex-col items-center text-blue-600">
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
