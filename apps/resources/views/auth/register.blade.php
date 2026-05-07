<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Pelanggan - Washly</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-blue-50 py-10 flex items-center justify-center">
    <div class="bg-white p-8 rounded-xl shadow-lg w-full max-w-lg border border-blue-100">
        <div class="text-center mb-8">
            <h2 class="text-3xl font-extrabold text-blue-600">Gabung Washly</h2>
            <p class="text-gray-500 text-sm mt-1">Daftar sekarang untuk mulai laundry tanpa ribet!</p>
        </div>

        @if($errors->any())
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-3 rounded mb-6 text-sm">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ url('/register') }}" method="POST">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="block text-gray-700 text-xs font-bold mb-1 uppercase">Nama Lengkap</label>
                    <input type="text" name="nama" class="w-full px-4 py-2 border rounded-lg focus:border-blue-500 focus:ring-1 focus:ring-blue-500" placeholder="Contoh: Zayn Malik" required>
                </div>
                <div>
                    <label class="block text-gray-700 text-xs font-bold mb-1 uppercase">No. WhatsApp</label>
                    <input type="text" name="no_hp" class="w-full px-4 py-2 border rounded-lg focus:border-blue-500 focus:ring-1 focus:ring-blue-500" placeholder="08123..." required>
                </div>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-xs font-bold mb-1 uppercase">Email</label>
                <input type="email" name="email" class="w-full px-4 py-2 border rounded-lg focus:border-blue-500 focus:ring-1 focus:ring-blue-500" placeholder="nama@email.com" required>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-xs font-bold mb-1 uppercase">Alamat Lengkap</label>
                <textarea name="alamat" rows="2" class="w-full px-4 py-2 border rounded-lg focus:border-blue-500 focus:ring-1 focus:ring-blue-500" placeholder="Jl. Raya Banaran..." required></textarea>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                <div>
                    <label class="block text-gray-700 text-xs font-bold mb-1 uppercase">Password</label>
                    <input type="password" name="password" class="w-full px-4 py-2 border rounded-lg focus:border-blue-500 focus:ring-1 focus:ring-blue-500" placeholder="********" required>
                </div>
                <div>
                    <label class="block text-gray-700 text-xs font-bold mb-1 uppercase">Konfirmasi Password</label>
                    <input type="password" name="password_confirmation" class="w-full px-4 py-2 border rounded-lg focus:border-blue-500 focus:ring-1 focus:ring-blue-500" placeholder="********" required>
                </div>
            </div>
            
            <button type="submit" class="w-full bg-blue-600 text-white font-bold py-3 px-4 rounded-lg hover:bg-blue-700 transition shadow-md">
                Daftar Sekarang
            </button>
        </form>

        <p class="text-center text-sm text-gray-600 mt-6">
            Sudah punya akun? <a href="{{ url('/login') }}" class="text-blue-600 font-bold hover:underline">Masuk di sini</a>
        </p>
    </div>
</body>
</html>