<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Washly - Laundry Bersih, Hidup Lebih Ringan</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#F4F7FB] min-h-screen flex flex-col items-center justify-center relative overflow-hidden font-sans text-slate-800">

    {{-- Lingkaran Dekorasi Background --}}
    <div class="absolute top-10 left-10 w-24 h-24 bg-blue-100 rounded-full mix-blend-multiply filter blur-xl opacity-70"></div>
    <div class="absolute bottom-20 left-4 w-32 h-32 bg-cyan-100 rounded-full mix-blend-multiply filter blur-xl opacity-70"></div>
    <div class="absolute top-20 right-20 w-16 h-16 bg-blue-100 rounded-full mix-blend-multiply filter blur-xl opacity-70"></div>
    <div class="absolute bottom-10 right-32 w-24 h-24 bg-cyan-100 rounded-full mix-blend-multiply filter blur-xl opacity-70"></div>

    {{-- Konten Utama --}}
    <div class="z-10 text-center max-w-lg px-8 flex flex-col items-center">
        {{-- Logo (Bisa diganti pakai tag <img> kalau kamu udah export logo SVG-nya) --}}
        {{-- Konten Utama --}}      
        <img src="{{ asset('images/w-g.svg') }}" alt="Washly Logo" class="w-[230px] h-auto">
        <div class="h-[70px] w-full"></div>

        <h1 class="text-2xl font-bold mb-4 w-full">Laundry Bersih, Hidup Lebih Ringan.</h1>
        <p class="text-sm text-slate-500 mb-10 leading-relaxed px-4">
            Nikmati kemudahan layanan laundry on-demand yang cepat, bersih, dan wangi. Cukup pesan dari perangkat Anda, kami yang urus sisanya.
        </p>

        <a href="{{ route('login') }}" class="w-[250px] flex justify-center items-center bg-gradient-to-r from-[#0085BE] to-[#005B82] hover:from-[#0074A6] hover:to-[#004B6D] text-white font-semibold py-3.5 rounded-full transition-all duration-300 shadow-lg shadow-[#0074A6]/30">
            Login
        </a>

        <p class="mt-8 text-sm text-slate-500">
            Belum punya akun? <a href="{{ route('register') }}" class="text-[#0074A6] font-semibold hover:underline">Daftar sekarang &rarr;</a>
        </p>
    </div>

</body>
</html>