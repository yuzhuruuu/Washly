<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengaturan Kurir - Washly</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
</head>
<body class="bg-gray-100 text-gray-900">
    <div class="max-w-4xl mx-auto py-10 px-4">
        <div class="mb-6 flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold">Pengaturan Akun</h1>
                <p class="text-sm text-gray-500">Atur username dan keamanan akun kurirmu.</p>
            </div>
            <a href="{{ route('kurir.profile.edit') }}" class="inline-flex items-center gap-2 px-4 py-3 rounded-xl border border-gray-300 bg-white text-sm font-semibold hover:bg-gray-50">
                <i class="fas fa-arrow-left"></i>
                Kembali ke Profil
            </a>
        </div>

        @if (session('status') === 'profile-updated')
            <div class="bg-green-50 border border-green-200 text-green-700 p-4 rounded-xl mb-6">
                Pengaturan berhasil disimpan.
            </div>
        @endif

        <div class="grid gap-6 lg:grid-cols-2">
            <div class="bg-white rounded-3xl shadow-sm border border-gray-200 p-6">
                <h2 class="text-xl font-bold mb-4">Username</h2>
                <form action="{{ route('kurir.settings.update') }}" method="POST" class="space-y-4">
                    @csrf
                    @method('patch')

                    <div>
                        <label class="block text-sm font-semibold text-gray-700">Username</label>
                        <input type="text" name="username" value="{{ old('username', $user->username) }}" class="mt-1 block w-full rounded-2xl border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required>
                        <x-input-error class="mt-2" :messages="$errors->get('username')" />
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700">Nomor WhatsApp</label>
                        <input type="text" name="no_hp" value="{{ old('no_hp', $user->no_hp) }}" class="mt-1 block w-full rounded-2xl border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" placeholder="08123...">
                        <x-input-error class="mt-2" :messages="$errors->get('no_hp')" />
                    </div>

                    <div>
                        <label class="inline-flex items-center gap-2 mt-2">
                            <input type="hidden" name="notify_new_task" value="0">
                            <input type="checkbox" name="notify_new_task" value="1" class="form-checkbox h-5 w-5 text-blue-600" {{ old('notify_new_task', $user->notify_new_task) ? 'checked' : '' }}>
                            <span class="text-sm text-gray-700">Terima notifikasi untuk tugas baru yang tersedia</span>
                        </label>
                        <x-input-error class="mt-2" :messages="$errors->get('notify_new_task')" />
                    </div>

                    <div class="flex justify-end">
                        <button type="submit" class="inline-flex items-center justify-center rounded-2xl bg-blue-600 px-5 py-3 text-sm font-semibold text-white hover:bg-blue-700">Simpan Username</button>
                    </div>
                </form>
            </div>

            <div class="bg-white rounded-3xl shadow-sm border border-gray-200 p-6">
                <h2 class="text-xl font-bold mb-4">Ubah Password</h2>
                <form action="{{ route('kurir.settings.password.update') }}" method="POST" class="space-y-4">
                    @csrf
                    @method('put')

                    <div>
                        <label class="block text-sm font-semibold text-gray-700">Password Saat Ini</label>
                        <input type="password" name="current_password" class="mt-1 block w-full rounded-2xl border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required>
                        <x-input-error class="mt-2" :messages="$errors->updatePassword->get('current_password')" />
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700">Password Baru</label>
                        <input type="password" name="password" class="mt-1 block w-full rounded-2xl border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required>
                        <x-input-error class="mt-2" :messages="$errors->updatePassword->get('password')" />
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700">Konfirmasi Password</label>
                        <input type="password" name="password_confirmation" class="mt-1 block w-full rounded-2xl border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required>
                        <x-input-error class="mt-2" :messages="$errors->updatePassword->get('password_confirmation')" />
                    </div>

                    <div class="flex justify-end">
                        <button type="submit" class="inline-flex items-center justify-center rounded-2xl bg-gray-900 px-5 py-3 text-sm font-semibold text-white hover:bg-black">Perbarui Password</button>
                    </div>
                </form>
            </div>
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
        <a href="{{ route('kurir.profile.edit') }}" class="flex flex-col items-center text-gray-400 hover:text-blue-600">
            <i class="fas fa-id-badge text-xl"></i>
            <span class="text-[10px] mt-1 font-bold">PROFIL</span>
        </a>
        <a href="{{ route('kurir.settings.edit') }}" class="flex flex-col items-center text-blue-600">
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
