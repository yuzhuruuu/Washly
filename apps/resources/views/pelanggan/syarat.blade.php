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
<body class="bg-slate-100 min-h-screen font-sans text-slate-800 pb-12 antialiased">

    @include('pelanggan.partials.navbar')

    <main class="max-w-5xl lg:max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 pt-8 pb-20 relative z-10">
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
