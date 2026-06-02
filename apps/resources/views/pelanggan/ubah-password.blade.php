<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ubah Password - Washly</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <style>body { font-family: 'Plus Jakarta Sans', sans-serif; }</style>
</head>
<body class="bg-slate-100 text-slate-800 antialiased selection:bg-[#00AEEF] selection:text-white">

    @include('pelanggan.partials.navbar')

    {{-- KONTEN UBAH PASSWORD --}}
    <main class="max-w-5xl lg:max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        
        <!-- Header Navigasi Balik -->
        <div class="mb-8 flex items-center gap-4">
            <a href="{{ route('pelanggan.profil') }}" class="w-10 h-10 bg-white border border-gray-200 rounded-full flex items-center justify-center text-gray-500 hover:bg-gray-50 hover:text-[#0074A6] transition shadow-sm">
                <i class="fas fa-arrow-left"></i>
            </a>
            <div>
                <h1 class="text-2xl font-bold text-gray-800">Ubah Password</h1>
                <p class="text-sm text-gray-500 font-medium">Pastikan akun Anda selalu aman.</p>
            </div>
        </div>

        <!-- Form Card -->
        <div class="bg-white rounded-[2rem] p-8 shadow-sm border border-gray-100 relative overflow-hidden">
            <div class="absolute top-0 right-0 w-32 h-32 bg-[#00AEEF]/5 rounded-bl-full -z-10"></div>
            
            {{-- KONEK BACKEND: Method POST, Tembak rute update, dan kasih @csrf --}}
            <form action="{{ route('pelanggan.ubah-password.update') }}" method="POST" class="space-y-6">
                @csrf
                
                {{-- ALERT AUTOMATIS JIKA SUKSES / EROR --}}
                @if(session('success'))
                    <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-xl text-sm font-semibold mb-4">
                        ✅ {{ session('success') }}
                    </div>
                @endif
                @if($errors->any())
                    <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-xl text-sm font-semibold mb-4">
                        ❌ {{ $errors->first() }}
                    </div>
                @endif

                <!-- Password Lama -->
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Password Saat Ini</label>
                    <div class="relative flex items-center">
                        <i class="fas fa-lock absolute left-4 text-gray-400 pointer-events-none"></i>
                        {{-- WAJIB: name="current_password" --}}
                        <input type="password" name="current_password" required class="w-full bg-[#F8FAFC] border border-gray-200 text-gray-800 text-sm rounded-xl focus:ring-[#0074A6] focus:border-[#0074A6] block pl-12 py-3.5 pr-4 transition" placeholder="Masukkan password saat ini">
                    </div>
                </div>

                <hr class="border-gray-100">

                <!-- Password Baru -->
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Password Baru</label>
                    <div class="relative flex items-center">
                        <i class="fas fa-key absolute left-4 text-gray-400 pointer-events-none"></i>
                        {{-- WAJIB: name="password" --}}
                        <input type="password" name="password" required class="w-full bg-[#F8FAFC] border border-gray-200 text-gray-800 text-sm rounded-xl focus:ring-[#0074A6] focus:border-[#0074A6] block pl-12 py-3.5 pr-4 transition" placeholder="Buat password baru">
                    </div>
                </div>

                <!-- Konfirmasi Password Baru -->
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Konfirmasi Password Baru</label>
                    <div class="relative flex items-center">
                        <i class="fas fa-check-circle absolute left-4 text-gray-400 pointer-events-none"></i>
                        {{-- WAJIB: name="password_confirmation" --}}
                        <input type="password" name="password_confirmation" required class="w-full bg-[#F8FAFC] border border-gray-200 text-gray-800 text-sm rounded-xl focus:ring-[#0074A6] focus:border-[#0074A6] block pl-12 py-3.5 pr-4 transition" placeholder="Ketik ulang password baru">
                    </div>
                </div>

                <!-- Action Button -->
                <div class="pt-4">
                    <button type="submit" class="w-full bg-[#0074A6] hover:bg-[#005a82] text-white font-bold py-3.5 px-6 rounded-full text-sm shadow-md transition">
                        Simpan Password Baru
                    </button>
                </div>
            </form>
        </div>
    </main>

</body>
</html>
