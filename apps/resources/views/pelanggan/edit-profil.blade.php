<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profil - Washly</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-[#F8FAFC] min-h-screen font-sans text-slate-800 pb-12">

    {{-- NAVBAR --}}
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
                <a href="{{ route('pelanggan.bantuan') }}" class="text-gray-400 hover:text-[#0074A6] transition"><i class="far fa-question-circle text-lg"></i></a>
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

<main class="max-w-3xl mx-auto px-6 pt-12 pb-20 relative z-10">
    <div class="mb-6 flex items-center gap-4">
        <a href="{{ route('pelanggan.profil') }}" class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white shadow-sm border border-gray-100 text-gray-600 hover:bg-gray-50">
            <i class="fas fa-arrow-left"></i>
        </a>
        <h1 class="text-2xl font-bold">Edit Profil</h1>
    </div>

    @if(session('success'))
        <div class="mb-4 p-4 bg-green-50 border border-green-100 text-green-700 rounded">{{ session('success') }}</div>
    @endif

    <form action="{{ route('pelanggan.profil.update') }}" method="POST" class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100">
        @csrf
        @method('PATCH')

        <div class="grid grid-cols-1 gap-4">
            <div>
                <label class="text-sm font-medium text-gray-700">Nama</label>
                <input type="text" name="nama" value="{{ old('nama', $pelanggan->nama ?? '') }}" class="mt-1 w-full px-4 py-3 rounded-xl border border-gray-200 bg-gray-50" required>
                @error('nama') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="text-sm font-medium text-gray-700">Email</label>
                <input type="email" name="email" value="{{ old('email', $pelanggan->email ?? '') }}" class="mt-1 w-full px-4 py-3 rounded-xl border border-gray-200 bg-gray-50" required>
                @error('email') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="text-sm font-medium text-gray-700">Username</label>
                <input type="text" name="username" value="{{ old('username', $pelanggan->username ?? '') }}" class="mt-1 w-full px-4 py-3 rounded-xl border border-gray-200 bg-gray-50">
                @error('username') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="text-sm font-medium text-gray-700">No. Telepon</label>
                <input type="text" name="no_hp" value="{{ old('no_hp', $pelanggan->no_hp ?? '') }}" class="mt-1 w-full px-4 py-3 rounded-xl border border-gray-200 bg-gray-50">
                @error('no_hp') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="text-sm font-medium text-gray-700">Alamat</label>
                <textarea name="alamat" class="mt-1 w-full px-4 py-3 rounded-xl border border-gray-200 bg-gray-50">{{ old('alamat', $pelanggan->alamat ?? '') }}</textarea>
                @error('alamat') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="flex justify-end gap-3 mt-4">
                <a href="{{ route('pelanggan.profil') }}" class="px-4 py-2 rounded-full bg-white border border-gray-200 text-gray-600">Batal</a>
                <button type="submit" class="px-4 py-2 rounded-full bg-[#0074A6] text-white">Simpan</button>
            </div>
        </div>
    </form>
</main>

</body>
</html>
