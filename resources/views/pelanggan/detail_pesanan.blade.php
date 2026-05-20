@php
    // Logika mengecek apakah berat atau total_harga masih kosong
    $belumDitimbang = is_null($pesanan->berat) || $pesanan->total_harga == 0 || is_null($pesanan->total_harga);
    $textStatus = $belumDitimbang ? "Menunggu Timbangan" : "Menunggu Pembayaran";
@endphp

<div class="p-6 max-w-xl mx-auto bg-white rounded-xl shadow-md space-y-4">
    <h1 class="text-2xl font-bold">Detail Pesanan #{{ $pesanan->id_pesanan }}</h1>
    
    <div class="p-4 border rounded-lg bg-gray-50">
        <p class="text-gray-600">Status Saat Ini:</p>
        <p class="text-xl font-semibold text-blue-600">{{ $textStatus }}</p>
    </div>

    <div class="space-y-2">
        <p>Berat Cucian: {{ $belumDitimbang ? 'Belum ditimbang' : $pesanan->berat . ' kg' }}</p>
        {{-- Menggunakan number_format bawaan PHP biar harganya cakep ada titiknya --}}
        <p>Total Tagihan: {{ $belumDitimbang ? 'Belum tersedia' : 'Rp ' . number_format($pesanan->total_harga, 0, ',', '.') }}</p>
    </div>

    {{-- Tombol akan disabled dan berubah warna kalau belum ditimbang --}}
    <button 
        @if($belumDitimbang) disabled @endif
        class="w-full py-2 px-4 rounded-md text-white font-bold transition-colors {{ $belumDitimbang ? 'bg-gray-400 cursor-not-allowed' : 'bg-green-500 hover:bg-green-600' }}"
        {{-- Aku arahin langsung ke route pembayaran.create sesuai web.php kamu --}}
        onclick="window.location.href='{{ route('pembayaran.create', $pesanan->id_pesanan) }}'"
    >
        Konfirmasi Bayar
    </button>
</div>