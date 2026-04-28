<x-app-layout>
    <div class="py-12">
        <div class="max-w-md mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 rounded-lg shadow">
                <h3 class="text-lg font-bold mb-4">Upload Bukti Bayar - Pesanan #{{ $pesanan->id_pesanan }}</h3>
                <p class="mb-4 text-sm text-gray-600">Total yang harus dibayar: <strong>Rp {{ number_format($pesanan->total_harga) }}</strong></p>
                
                <form action="{{ route('pembayaran.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id_pesanan" value="{{ $pesanan->id_pesanan }}">
                    
                    <div class="mb-4">
                        <label class="block text-sm font-medium">Foto Bukti Transfer</label>
                        <input type="file" name="bukti_bayar" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                    </div>

                    <button type="submit" class="w-full bg-blue-600 text-white font-bold py-2 rounded">
                        Kirim Konfirmasi
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>