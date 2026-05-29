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
                        <label class="block text-sm font-medium">Metode Pembayaran</label>
                        <select name="metode_pembayaran" onchange="togglePaymentInfo(this)" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                            <option value="" disabled selected>-- Pilih Metode Pembayaran --</option>
                            <option value="transfer_bank">Transfer Bank</option>
                            <option value="ewalet_qris">E-Walet / QRIS</option>
                        </select>
                    </div>

                    <div id="payment-info" class="mb-4 hidden">
                        <div id="bank-info" class="hidden rounded-2xl bg-gray-50 border border-gray-200 p-4 text-sm text-gray-700">
                            <p class="font-bold text-gray-800 mb-2">Transfer Bank</p>
                            <p class="text-xs text-gray-500 mb-1">Silakan transfer ke rekening berikut:</p>
                            <p class="font-black">BCA 123-456-7890</p>
                            <p class="text-xs text-gray-500">a.n. Washly Laundry</p>
                        </div>
                        <div id="ewalet-info" class="hidden rounded-2xl bg-gray-50 border border-gray-200 p-4 text-sm text-gray-700">
                            <p class="font-bold text-gray-800 mb-2">E-Walet / QRIS</p>
                            <p class="text-xs text-gray-500 mb-3">Scan QR berikut atau gunakan kode berikut di aplikasi e-wallet:</p>
                            <div class="bg-white rounded-2xl p-4 text-center border border-gray-200">
                                <div class="mx-auto mb-3 w-28 h-28 rounded-xl bg-gray-200 flex items-center justify-center text-xs text-gray-500">QRIS</div>
                                <p class="font-black">0812-3456-7890</p>
                            </div>
                        </div>
                    </div>

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

    <script>
        function togglePaymentInfo(select) {
            var bankInfo = document.getElementById('bank-info');
            var ewalletInfo = document.getElementById('ewalet-info');
            var container = document.getElementById('payment-info');
            bankInfo.classList.add('hidden');
            ewalletInfo.classList.add('hidden');
            if (select.value === 'transfer_bank') {
                container.classList.remove('hidden');
                bankInfo.classList.remove('hidden');
            } else if (select.value === 'ewalet_qris') {
                container.classList.remove('hidden');
                ewalletInfo.classList.remove('hidden');
            } else {
                container.classList.add('hidden');
            }
        }
    </script>
</x-app-layout>