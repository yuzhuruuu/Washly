<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Syarat & Ketentuan - Washly</title>
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
            </div>

            <div class="flex items-center space-x-5">
                <span class="text-sm text-gray-500 font-medium">Halo, {{ Auth::guard('pelanggan')->user()?->nama ?? 'Pelanggan' }}!</span>
                <a href="{{ route('pelanggan.notifikasi') }}" class="text-gray-400 hover:text-[#0074A6] transition"><i class="far fa-bell text-lg"></i></a>
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

    <main class="max-w-3xl mx-auto px-6 pt-8 pb-20 relative z-10">
        <div class="bg-white rounded-3xl p-6 shadow-sm border border-gray-100 mb-6 flex flex-col gap-4 md:flex-row md:items-center">
            <a href="{{ route('pelanggan.profil') }}" class="inline-flex items-center justify-center w-12 h-12 rounded-full bg-white shadow-md border border-gray-100 text-gray-600 hover:bg-gray-50">
                <i class="fas fa-arrow-left"></i>
            </a>
            <div>
                <h1 class="text-2xl font-bold">Syarat & Ketentuan</h1>
                <p class="text-sm text-gray-500">Ketentuan penggunaan layanan Washly yang berlaku untuk pelanggan.</p>
            </div>
        </div>

        <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 space-y-4">
            <section>
                <h2 class="font-semibold">1. Ruang Lingkup Layanan</h2>
                <p class="text-sm text-gray-600">Washly menyediakan layanan laundry berbasis pickup dan delivery sesuai paket layanan yang ditampilkan pada aplikasi. Layanan mencakup pencucian, pengeringan, dan penyetrikaan sesuai deskripsi paket.</p>
            </section>

            <section>
                <h2 class="font-semibold">2. Pemesanan dan Pembayaran</h2>
                <p class="text-sm text-gray-600">Pelanggan wajib mengisi data alamat dan berat secara jujur. Harga dihitung berdasarkan paket dan berat yang diinput. Pembayaran dapat dilakukan melalui metode yang tersedia pada saat checkout.</p>
            </section>

            <section>
                <h2 class="font-semibold">3. Pembatalan & Pengembalian</h2>
                <p class="text-sm text-gray-600">Pembatalan pesanan dapat dilakukan sebelum pesanan dijemput. Kebijakan pengembalian atau kompensasi akan ditentukan setelah verifikasi klaim kerusakan atau kehilangan.</p>
            </section>

            <section>
                <h2 class="font-semibold">4. Kewajiban Pelanggan</h2>
                <p class="text-sm text-gray-600">Pelanggan bertanggung jawab untuk memberi tahu kondisi khusus pakaian (mis. noda minyak, bahan sensitif). Washly tidak bertanggung jawab atas barang yang tidak diinformasikan sebelumnya.</p>
            </section>

            <section>
                <h2 class="font-semibold">5. Perubahan Ketentuan</h2>
                <p class="text-sm text-gray-600">Washly berhak mengubah syarat & ketentuan ini sewaktu-waktu. Perubahan akan diinformasikan melalui aplikasi.</p>
            </section>
        </div>
    </main>
</body>
</html>