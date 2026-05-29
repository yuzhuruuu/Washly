<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Kurir - Washly Admin</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-[#F8FAFC] h-screen font-sans text-slate-800 flex overflow-hidden">

    <aside class="w-64 bg-white border-r border-gray-100 flex flex-col h-full shrink-0 relative z-20">
        <div class="p-6">
            <img src="{{ asset('images/w-a.svg') }}" alt="Washly Admin" class="h-8">
        </div>

        <div class="px-6 flex items-center gap-3 mb-8">
            <div class="w-10 h-10 rounded-full border border-gray-100 overflow-hidden shadow-sm">
                <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::guard('admin')->user()?->nama ?? Auth::guard('admin')->user()?->username ?? 'Admin') }}&background=00AEEF&color=fff" alt="Admin Profile" class="w-full h-full object-cover">
            </div>
            <div>
                <h3 class="font-bold text-sm text-gray-800 leading-tight truncate w-32" title="{{ Auth::guard('admin')->user()?->nama ?? Auth::guard('admin')->user()?->username ?? 'Admin' }}">
                    {{ Auth::guard('admin')->user()?->nama ?? Auth::guard('admin')->user()?->username ?? 'Admin' }}
                </h3>
                <p class="text-[10px] text-gray-500 font-medium mt-0.5">Panel Kendali Utama</p>
            </div>
        </div>

        <nav class="flex-1 px-4 space-y-1">
            <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-4 py-3 text-gray-500 hover:bg-gray-50 hover:text-[#0074A6] rounded-xl font-medium text-sm transition group">
                <i class="fas fa-th-large w-5 text-center text-gray-400 group-hover:text-[#0074A6] transition"></i> Dashboard
            </a>
            <a href="{{ route('admin.pesanan.kelola') }}" class="flex items-center gap-3 px-4 py-3 text-gray-500 hover:bg-gray-50 hover:text-[#0074A6] rounded-xl font-medium text-sm transition group">
                <i class="fas fa-clipboard-list w-5 text-center text-gray-400 group-hover:text-[#0074A6] transition"></i> Kelola Pesanan
            </a>
            <a href="{{ route('admin.pembayaran') }}" class="flex items-center gap-3 px-4 py-3 text-gray-500 hover:bg-gray-50 hover:text-[#0074A6] rounded-xl font-medium text-sm transition group">
                <i class="fas fa-wallet w-5 text-center text-gray-400 group-hover:text-[#0074A6] transition"></i> Pembayaran
            </a>
            <a href="{{ route('admin.kurir') }}" class="flex items-center gap-3 px-4 py-3 text-gray-500 hover:bg-gray-50 hover:text-[#0074A6] rounded-xl font-medium text-sm transition group">
                <i class="fas fa-motorcycle w-5 text-center text-gray-400 group-hover:text-[#0074A6] transition"></i> Kurir
            </a>
            <a href="{{ route('admin.riwayat') }}" class="flex items-center gap-3 px-4 py-3 text-gray-500 hover:bg-gray-50 hover:text-[#0074A6] rounded-xl font-medium text-sm transition group">
                <i class="fas fa-history w-5 text-center text-gray-400 group-hover:text-[#0074A6] transition"></i> Riwayat Admin
            </a>
            <a href="{{ route('admin.pengaturan') }}" class="flex items-center gap-3 px-4 py-3 text-gray-500 hover:bg-gray-50 hover:text-[#0074A6] rounded-xl font-medium text-sm transition group">
                <i class="fas fa-cog w-5 text-center text-gray-400 group-hover:text-[#0074A6] transition"></i> Pengaturan
            </a>
            <form action="{{ route('logout') }}" method="POST" class="block w-full">
                @csrf
                <button type="submit" class="w-full flex items-center gap-3 px-4 py-3 text-red-500 hover:bg-red-50 rounded-xl font-medium text-sm transition group cursor-pointer">
                    <i class="fas fa-sign-out-alt w-5 text-center text-red-400 group-hover:text-red-600 transition"></i> Keluar Akun
                </button>
            </form>
        </nav>
    </aside>

    <main class="flex-1 overflow-y-auto relative z-10">
        <div class="p-10 max-w-4xl mx-auto">
            <div class="flex justify-between items-center mb-8">
                <div>
                    <h1 class="text-4xl font-black text-gray-800 mb-2">Edit Kurir</h1>
                    <p class="text-sm text-gray-500 font-medium">Perbarui informasi mitra pengiriman dan statusnya di sistem.</p>
                </div>
                <a href="{{ route('admin.kurir') }}" class="bg-white border border-gray-200 text-gray-700 px-5 py-3 rounded-xl text-sm font-bold hover:bg-gray-50 transition flex items-center gap-2">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
            </div>

            @if ($errors->any())
                <div class="bg-red-50 border border-red-200 text-red-700 px-5 py-4 rounded-2xl mb-6">
                    <ul class="list-disc list-inside text-sm">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.kurir.update', $kurir->id_kurir) }}" method="POST" class="bg-white rounded-3xl border border-gray-100 shadow-sm p-8 space-y-6">
                @csrf
                @method('PATCH')

                <div>
                    <label class="block text-xs font-semibold text-gray-600 mb-2">Nama Lengkap</label>
                    <input type="text" name="nama" value="{{ old('nama', $kurir->nama) }}" class="w-full bg-slate-50 border border-slate-200 rounded-xl py-3.5 px-4 text-sm text-gray-700 focus:outline-none focus:border-[#1D5D8A] focus:ring-1 focus:ring-[#1D5D8A] transition" required>
                </div>

                <div class="grid gap-4 md:grid-cols-2">
                    <div>
                        <label class="block text-xs font-semibold text-gray-600 mb-2">Username</label>
                        <input type="text" name="username" value="{{ old('username', $kurir->username) }}" class="w-full bg-slate-50 border border-slate-200 rounded-xl py-3.5 px-4 text-sm text-gray-700 focus:outline-none focus:border-[#1D5D8A] focus:ring-1 focus:ring-[#1D5D8A] transition" required>
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gray-600 mb-2">No. HP</label>
                        <input type="text" name="no_hp" value="{{ old('no_hp', $kurir->no_hp) }}" class="w-full bg-slate-50 border border-slate-200 rounded-xl py-3.5 px-4 text-sm text-gray-700 focus:outline-none focus:border-[#1D5D8A] focus:ring-1 focus:ring-[#1D5D8A] transition" required>
                    </div>
                </div>

                <div class="grid gap-4 md:grid-cols-2">
                    <div>
                        <label class="block text-xs font-semibold text-gray-600 mb-2">Status</label>
                        <select name="status" class="w-full bg-slate-50 border border-slate-200 rounded-xl py-3.5 px-4 text-sm text-gray-700 focus:outline-none focus:border-[#1D5D8A] focus:ring-1 focus:ring-[#1D5D8A] transition" required>
                            <option value="aktif" {{ old('status', $kurir->status) === 'aktif' ? 'selected' : '' }}>Aktif</option>
                            <option value="nonaktif" {{ old('status', $kurir->status) === 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gray-600 mb-2">Password Baru (opsional)</label>
                        <input type="password" name="password" class="w-full bg-slate-50 border border-slate-200 rounded-xl py-3.5 px-4 text-sm text-gray-700 focus:outline-none focus:border-[#1D5D8A] focus:ring-1 focus:ring-[#1D5D8A] transition" placeholder="Kosongkan jika tidak ingin mengubah">
                    </div>
                </div>

                <div class="flex flex-col sm:flex-row gap-3 justify-end">
                    <a href="{{ route('admin.kurir') }}" class="w-full sm:w-auto bg-white border border-gray-200 text-gray-700 px-6 py-3 rounded-xl text-sm font-bold hover:bg-gray-50 transition text-center">Batal</a>
                    <button type="submit" class="w-full sm:w-auto bg-[#1D5D8A] text-white px-6 py-3 rounded-xl text-sm font-bold hover:bg-[#174b67] transition">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </main>

</body>
</html>
