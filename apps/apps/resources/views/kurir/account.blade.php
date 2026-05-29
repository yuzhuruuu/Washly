<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengaturan Akun Kurir - Washly</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
</head>
<body class="bg-gray-100 text-gray-900">
    <div class="max-w-4xl mx-auto py-10 px-4">
        <div class="mb-6 flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold">Pengaturan Akun</h1>
                <p class="text-sm text-gray-500">Kelola informasi akun dan keamanan untuk profil kurirmu.</p>
            </div>
            <a href="{{ route('kurir.dashboard') }}" class="inline-flex items-center gap-2 px-4 py-3 rounded-xl border border-gray-300 bg-white text-sm font-semibold hover:bg-gray-50">
                <i class="fas fa-arrow-left"></i>
                Kembali ke Dashboard
            </a>
        </div>

        @if ($errors->any())
            <div class="bg-red-50 border border-red-200 text-red-700 p-4 rounded-xl mb-6">
                <ul class="list-disc pl-5 space-y-1 text-sm">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if (session('status') === 'profile-updated')
            <div class="bg-green-50 border border-green-200 text-green-700 p-4 rounded-xl mb-6">
                Profil berhasil diperbarui.
            </div>
        @endif

        <div class="grid gap-6 lg:grid-cols-2">
            <div class="bg-white rounded-3xl shadow-sm border border-gray-200 p-6">
                <h2 class="text-lg font-bold mb-4">Informasi Akun</h2>
                <form action="{{ route('kurir.profile.update') }}" method="POST" class="space-y-4">
                    @csrf
                    @method('patch')

                    <div>
                        <label class="block text-sm font-semibold text-gray-700">Nama Lengkap</label>
                        <input type="text" name="nama" value="{{ old('nama', $user->nama) }}" class="mt-1 block w-full rounded-2xl border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700">Username</label>
                        <input type="text" name="username" value="{{ old('username', $user->username) }}" class="mt-1 block w-full rounded-2xl border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700">Email</label>
                        <input type="email" name="email" value="{{ old('email', $user->email) }}" class="mt-1 block w-full rounded-2xl border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700">Nomor WhatsApp</label>
                        <input type="text" name="no_hp" value="{{ old('no_hp', $user->no_hp) }}" class="mt-1 block w-full rounded-2xl border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required>
                    </div>

                    <div class="flex justify-end">
                        <button type="submit" class="inline-flex items-center justify-center rounded-2xl bg-blue-600 px-5 py-3 text-sm font-semibold text-white hover:bg-blue-700">Simpan Perubahan</button>
                    </div>
                </form>
            </div>

            <div class="bg-white rounded-3xl shadow-sm border border-gray-200 p-6">
                <h2 class="text-lg font-bold mb-4">Ubah Password</h2>
                <form action="{{ route('kurir.password.update') }}" method="POST" class="space-y-4">
                    @csrf
                    @method('put')

                    <div>
                        <label class="block text-sm font-semibold text-gray-700">Password Saat Ini</label>
                        <input type="password" name="current_password" class="mt-1 block w-full rounded-2xl border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700">Password Baru</label>
                        <input type="password" name="password" class="mt-1 block w-full rounded-2xl border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700">Konfirmasi Password</label>
                        <input type="password" name="password_confirmation" class="mt-1 block w-full rounded-2xl border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required>
                    </div>

                    <div class="flex justify-end">
                        <button type="submit" class="inline-flex items-center justify-center rounded-2xl bg-gray-900 px-5 py-3 text-sm font-semibold text-white hover:bg-black">Perbarui Password</button>
                    </div>
                </form>

                @if ($errors->updatePassword->any())
                    <div class="mt-4 bg-red-50 border border-red-200 text-red-700 p-4 rounded-xl text-sm">
                        <ul class="list-disc pl-5">
                            @foreach ($errors->updatePassword->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
        </div>
    </div>
</body>
</html>
