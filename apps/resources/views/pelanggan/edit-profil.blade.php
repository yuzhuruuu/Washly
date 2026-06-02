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
<body class="bg-slate-100 min-h-screen font-sans text-slate-800 pb-12 antialiased">

    @include('pelanggan.partials.navbar')

<main class="max-w-5xl lg:max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 pt-12 pb-20 relative z-10">
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

