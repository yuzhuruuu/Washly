{{-- Bagian Atas: Welcoming & Info Singkat --}}
<div class="mb-8">
    <div class="flex flex-col md:flex-row md:items-end md:justify-between gap-4">
        <div>
            <h3 class="text-xl font-bold text-gray-800">Halo, {{ Auth::guard('pelanggan')->user()->nama }}!</h3>
            <p class="text-sm text-gray-500 mt-1">Kelola pesananmu di sini. Pilih layanan, cek status, dan lihat riwayat.</p>
        </div>
        <div class="flex gap-2 overflow-x-auto">
            <button onclick="bukaHalaman('tab-beranda', this)" class="tab-btn bg-blue-600 text-white rounded-xl px-4 py-2 text-sm font-semibold">Beranda</button>
            <button onclick="bukaHalaman('tab-layanan', this)" class="tab-btn bg-gray-100 text-gray-700 rounded-xl px-4 py-2 text-sm font-semibold">Layanan</button>
            <button onclick="bukaHalaman('tab-riwayat', this)" class="tab-btn bg-gray-100 text-gray-700 rounded-xl px-4 py-2 text-sm font-semibold">Riwayat</button>
            <button onclick="bukaHalaman('tab-tentang', this)" class="tab-btn bg-gray-100 text-gray-700 rounded-xl px-4 py-2 text-sm font-semibold">Tentang Kami</button>
        </div>
    </div>
</div>

<div id="tab-beranda" class="tab-content block">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">
        <div class="bg-white rounded-3xl p-6 shadow-sm border border-gray-100">
            <p class="text-xs uppercase tracking-widest text-gray-400 font-bold">Pesanan Aktif</p>
            <p class="mt-4 text-3xl font-black text-gray-900">{{ $pesanan_saya->whereIn('status', ['menunggu_pickup', 'menunggu_timbang', 'menunggu_bayar', 'menunggu_konfirmasi', 'proses', 'delivery'])->count() }}</p>
            <p class="mt-2 text-sm text-gray-500">Sedang diproses oleh Washly.</p>
        </div>
        <div class="bg-white rounded-3xl p-6 shadow-sm border border-gray-100">
            <p class="text-xs uppercase tracking-widest text-gray-400 font-bold">Total Pesanan</p>
            <p class="mt-4 text-3xl font-black text-gray-900">{{ $pesanan_saya->count() }}</p>
            <p class="mt-2 text-sm text-gray-500">Semua pesanan yang pernah kamu buat.</p>
        </div>
        <div class="bg-white rounded-3xl p-6 shadow-sm border border-gray-100">
            <p class="text-xs uppercase tracking-widest text-gray-400 font-bold">Tagihan Tertunda</p>
            <p class="mt-4 text-3xl font-black text-gray-900">{{ $pesanan_saya->where('status', 'menunggu_bayar')->count() }}</p>
            <p class="mt-2 text-sm text-gray-500">Unggah bukti pembayaran segera.</p>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
        <div class="bg-white rounded-3xl p-6 shadow-sm border border-gray-100">
            <h4 class="text-lg font-bold text-gray-800 mb-3">Selamat datang di Washly</h4>
            <p class="text-sm text-gray-500 leading-relaxed">Di tab Layanan kamu bisa langsung memesan laundry dan melihat status pesanan secara real-time. Tab Riwayat menyimpan semua riwayat pesananmu, sementara Tentang Kami menjelaskan layanan Washly dan keunggulannya.</p>
        </div>
        <div class="bg-blue-600 rounded-3xl p-6 shadow-lg text-white">
            <h4 class="text-lg font-bold mb-3">Cepat & Mudah</h4>
            <p class="text-sm leading-relaxed">Pesan laundry dengan beberapa klik, bayar lewat transfer atau e-wallet, lalu biarkan kami menjemput dan mengembalikan pakaianmu dalam kondisi bersih.</p>
            <div class="mt-6 space-y-3 text-sm">
                <p><span class="font-bold">1.</span> Pilih layanan di tab Layanan.</p>
                <p><span class="font-bold">2.</span> Unggah bukti pembayaran jika diperlukan.</p>
                <p><span class="font-bold">3.</span> Pantau status pesanan sampai selesai.</p>
            </div>
        </div>
    </div>
</div>

<div id="tab-layanan" class="tab-content hidden">

{{-- Card Buat Pesanan Baru --}}
<div class="bg-blue-600 rounded-2xl p-6 mb-10 shadow-lg text-white">
    <div class="flex items-center mb-4">
        <div class="p-2 bg-blue-500 rounded-lg mr-3">
            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
        </div>
        <h4 class="text-lg font-bold">Buat Pesanan Baru</h4>
    </div>

    <form action="{{ route('pesanan.store') }}" method="POST" class="bg-white p-5 rounded-xl text-gray-800">
        @csrf
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            {{-- Pilih Layanan --}}
            <div class="space-y-1">
                <label class="text-xs font-bold text-gray-400 uppercase">Jenis Layanan</label>
                <select name="id_layanan" class="w-full border-gray-200 rounded-lg focus:ring-blue-500 focus:border-blue-500" required>
                    <option value="" disabled selected>-- Pilih Layanan --</option>
                    @foreach($layanan as $l)
                        <option value="{{ $l->id_layanan }}">
                            {{ $l->nama_layanan }} (Rp {{ number_format($l->harga_per_kg, 0, ',', '.') }}/kg)
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Alamat Penjemputan --}}
            <div class="space-y-1">
                <label class="text-xs font-bold text-gray-400 uppercase">Alamat Penjemputan</label>
                <input type="text" name="alamat" value="{{ Auth::guard('pelanggan')->user()->alamat }}" 
                       class="w-full border-gray-200 rounded-lg focus:ring-blue-500 focus:border-blue-500" required>
            </div>
        </div>

        <button type="submit" class="w-full mt-4 bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 rounded-lg transition duration-200 shadow-md">
            Pesan Sekarang
        </button>
    </form>
</div>

{{-- Daftar Pesanan Aktif --}}
<div id="status-pesanan">
    <h3 class="text-lg font-bold mb-4 text-gray-800 flex items-center">
        <i class="fas fa-tasks mr-2 text-blue-600"></i> Status Pesanan Saya
    </h3>
    
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        @forelse($pesanan_saya as $ps)
            <div class="bg-white border border-gray-100 rounded-2xl p-5 shadow-sm hover:shadow-md transition border-l-4 
                @if($ps->status == 'selesai') border-l-green-500 @else border-l-blue-500 @endif">
                
                <div class="flex justify-between items-start mb-3">
                    <span class="text-[10px] font-black text-gray-300 uppercase tracking-widest">#{{ $ps->id_pesanan }}</span>
                    <span class="px-3 py-1 text-[10px] font-bold rounded-full uppercase
                        @if($ps->status == 'selesai') bg-green-100 text-green-700 
                        @elseif($ps->status == 'menunggu_jemput') bg-yellow-100 text-yellow-700
                        @else bg-blue-100 text-blue-700 @endif">
                        {{ str_replace('_', ' ', $ps->status) }}
                    </span>
                </div>
                
                <div class="mb-4">
                    <div class="text-md font-bold text-gray-800">{{ $ps->layanan->nama_layanan }}</div>
                    <div class="text-xs text-gray-400 italic">{{ $ps->created_at->diffForHumans() }}</div>
                </div>

                <div class="flex justify-between items-center pt-3 border-t border-gray-50">
                    <div>
                        <p class="text-[10px] text-gray-400 uppercase font-bold">Total Tagihan</p>
                        <p class="text-lg font-black text-blue-600">
                            {{ $ps->total_harga > 0 ? 'Rp '.number_format($ps->total_harga, 0, ',', '.') : 'Tunggu Ditimbang' }}
                        </p>
                    </div>

                    {{-- REVISI: Tombol Upload cuma muncul pas status beneran 'menunggu_bayar' --}}
                    @if($ps->status == 'menunggu_bayar')
                    <div class="mt-4 pt-4 border-t border-gray-100">
                        <div class="p-4 bg-yellow-50 border border-yellow-200 rounded-2xl">
                            <p class="text-[10px] font-black text-yellow-700 uppercase mb-3 tracking-widest flex items-center">
                                <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20"><path d="M4 4a2 2 0 00-2 2v1h16V6a2 2 0 00-2-2H4z"></path><path fill-rule="evenodd" d="M18 9H2v5a2 2 0 002 2h12a2 2 0 002-2V9zM4 13a1 1 0 011-1h1a1 1 0 110 2H5a1 1 0 01-1-1zm5-1a1 1 0 100 2h1a1 1 0 100-2H9z" clip-rule="evenodd"></path></svg>
                                Konfirmasi Pembayaran
                            </p>
                            
                            <form action="{{ route('pembayaran.store') }}" method="POST" enctype="multipart/form-data" class="space-y-3">
                                @csrf
                                <input type="hidden" name="id_pesanan" value="{{ $ps->id_pesanan }}">

                                <div>
                                    <label class="block text-xs font-bold text-gray-600 uppercase mb-2">Metode Pembayaran</label>
                                    <select name="metode_pembayaran" onchange="togglePaymentInfo(this, '{{ $ps->id_pesanan }}')" class="w-full border border-yellow-300 rounded-xl py-3 px-4 text-sm focus:ring-yellow-400 focus:border-yellow-400" required>
                                        <option value="" disabled selected>-- Pilih Metode Pembayaran --</option>
                                        <option value="transfer_bank">Transfer Bank</option>
                                        <option value="ewalet_qris">E-Walet / QRIS</option>
                                    </select>
                                </div>

                                <div id="payment-info-{{ $ps->id_pesanan }}" class="space-y-3 hidden">
                                    <div id="bank-info-{{ $ps->id_pesanan }}" class="hidden rounded-2xl bg-white border border-yellow-200 p-4 text-sm text-gray-700">
                                        <p class="font-bold text-yellow-700 mb-2">Transfer Bank</p>
                                        <p class="text-xs text-gray-500 mb-1">Silakan transfer ke rekening berikut:</p>
                                        <p class="font-black">BCA 123-456-7890</p>
                                        <p class="text-xs text-gray-500">a.n. Washly Laundry</p>
                                    </div>
                                    <div id="ewalet-info-{{ $ps->id_pesanan }}" class="hidden rounded-2xl bg-white border border-yellow-200 p-4 text-sm text-gray-700">
                                        <p class="font-bold text-yellow-700 mb-2">E-Walet / QRIS</p>
                                        <p class="text-xs text-gray-500 mb-3">Scan QR berikut atau gunakan kode berikut di aplikasi e-wallet kamu:</p>
                                        <div class="bg-gray-100 rounded-2xl p-4 text-center">
                                            <p class="font-black mb-2">QRIS CODE</p>
                                            <div class="mx-auto mb-2 w-28 h-28 rounded-xl bg-gray-200 flex items-center justify-center text-xs text-gray-500">QRIS</div>
                                            <p class="text-xs text-gray-600">0812-3456-7890</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="relative">
                                    <input type="file" name="bukti_bayar" id="file-{{ $ps->id_pesanan }}" class="hidden" required onchange="updateFileName(this, 'name-{{ $ps->id_pesanan }}')">
                                    <label for="file-{{ $ps->id_pesanan }}" class="flex items-center justify-center w-full px-4 py-2 border-2 border-dashed border-yellow-300 rounded-xl text-xs text-yellow-600 cursor-pointer hover:bg-yellow-100 transition">
                                        <span id="name-{{ $ps->id_pesanan }}">Pilih Foto Bukti Transfer</span>
                                    </label>
                                </div>

                                <button type="submit" class="w-full bg-yellow-600 hover:bg-yellow-700 text-white text-xs font-bold py-3 rounded-xl shadow-md transition duration-200 uppercase tracking-tight">
                                    Kirim Bukti & Konfirmasi
                                </button>
                            </form>
                        </div>
                    </div>
                    @endif

                    {{-- REVISI: Kalau sudah upload tapi admin belum validasi --}}
                    @if($ps->status == 'menunggu_konfirmasi')
                    <div class="mt-4 p-4 bg-blue-50 border border-blue-100 rounded-2xl text-center">
                        <p class="text-[10px] font-bold text-blue-600 uppercase">Status Pembayaran</p>
                        <p class="text-xs text-blue-500 mt-1">Bukti sudah dikirim, tunggu Admin validasi ya</p>
                    </div>
                    @endif
                </div>
            </div>
        @empty
            <div class="col-span-full py-12 text-center bg-gray-50 rounded-2xl border-2 border-dashed border-gray-200">
                <p class="text-gray-400 italic">Belum ada pesanan. Cobain dong jasanya!</p>
            </div>
        @endforelse
    </div>
</div>

</div>

<div id="tab-riwayat" class="tab-content hidden">
    <div class="bg-white rounded-3xl p-6 shadow-sm border border-gray-100">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">
            <div>
                <h4 class="text-xl font-bold text-gray-800">Riwayat Pesanan</h4>
                <p class="text-sm text-gray-500 mt-1">Semua pesananmu ditampilkan di sini.</p>
            </div>
            <span class="text-xs uppercase font-bold tracking-widest text-gray-500">Total: {{ $pesanan_saya->count() }}</span>
        </div>

        @if($pesanan_saya->isEmpty())
            <div class="rounded-3xl border border-dashed border-gray-200 p-10 text-center text-gray-400">
                Belum ada riwayat pesanan.
            </div>
        @else
            <div class="space-y-4">
                @foreach($pesanan_saya as $ps)
                    <div class="rounded-3xl border p-5 shadow-sm transition hover:shadow-md">
                        <div class="flex flex-col md:flex-row md:justify-between md:items-start gap-4">
                            <div>
                                <p class="text-xs uppercase tracking-widest text-gray-400 font-bold">#{{ $ps->id_pesanan }}</p>
                                <h5 class="text-lg font-bold text-gray-900">{{ $ps->layanan->nama_layanan }}</h5>
                                <p class="text-sm text-gray-500 mt-1">{{ $ps->created_at->format('d M Y H:i') }}</p>
                            </div>
                            <div class="space-y-1 text-right">
                                <p class="text-xs uppercase tracking-widest text-gray-400 font-bold">Status</p>
                                <p class="text-sm font-bold @if($ps->status == 'selesai') text-green-700 @else text-blue-700 @endif">{{ str_replace('_', ' ', $ps->status) }}</p>
                            </div>
                        </div>
                        <div class="mt-4 grid grid-cols-1 sm:grid-cols-3 gap-4 text-sm text-gray-600">
                            <div>
                                <p class="font-semibold text-gray-800">Total</p>
                                <p>{{ $ps->total_harga > 0 ? 'Rp '.number_format($ps->total_harga, 0, ',', '.') : 'Tunggu Ditimbang' }}</p>
                            </div>
                            <div>
                                <p class="font-semibold text-gray-800">Alamat</p>
                                <p>{{ $ps->alamat ?? Auth::guard('pelanggan')->user()->alamat }}</p>
                            </div>
                            <div>
                                <p class="font-semibold text-gray-800">Kurir</p>
                                <p>{{ optional($ps->kurir)->nama ?? '-' }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>

<div id="tab-tentang" class="tab-content hidden">
    <div class="bg-white rounded-3xl p-6 shadow-sm border border-gray-100">
        <h4 class="text-xl font-bold text-gray-800 mb-4">Tentang Washly</h4>
        <p class="text-sm text-gray-500 leading-relaxed mb-4">Washly adalah layanan laundry jemput-antar yang memudahkan pelanggan dalam mencuci, menyetrika, dan mengembalikan pakaian dengan cepat dan aman. Kami melayani berbagai jenis pakaian dan paket layanan untuk kebutuhan sehari-hari.</p>
        <div class="grid gap-4 md:grid-cols-2">
            <div class="rounded-3xl bg-blue-50 p-5">
                <h5 class="font-bold text-gray-900 mb-2">Kenapa pilih Washly?</h5>
                <ul class="space-y-2 text-sm text-gray-600">
                    <li>- Penjemputan dan pengantaran langsung ke lokasi kamu.</li>
                    <li>- Proses cepat dan transparan.</li>
                    <li>- Harga terjangkau dengan kualitas premium.</li>
                </ul>
            </div>
            <div class="rounded-3xl bg-gray-50 p-5">
                <h5 class="font-bold text-gray-900 mb-2">Kontak Kami</h5>
                <p class="text-sm text-gray-600">Jl. Melati No. 12, Bandung</p>
                <p class="text-sm text-gray-600 mt-2">Telepon: 0812-3456-7890</p>
                <p class="text-sm text-gray-600">Email: info@washly.laundry</p>
            </div>
        </div>
    </div>
</div>

<script>
    function bukaHalaman(idTab, elemen) {
        document.querySelectorAll('.tab-content').forEach(el => {
            el.classList.add('hidden');
            el.classList.remove('block');
        });
        document.querySelectorAll('.tab-btn').forEach(btn => {
            btn.classList.remove('bg-blue-600', 'text-white');
            btn.classList.add('bg-gray-100', 'text-gray-700');
        });
        document.getElementById(idTab).classList.remove('hidden');
        document.getElementById(idTab).classList.add('block');
        if (elemen) {
            elemen.classList.remove('bg-gray-100', 'text-gray-700');
            elemen.classList.add('bg-blue-600', 'text-white');
        }
    }

    document.addEventListener('DOMContentLoaded', function() {
        const defaultButton = document.querySelector('.tab-btn');
        if (defaultButton) {
            defaultButton.click();
        }
    });

    function togglePaymentInfo(select, id) {
        var bankInfo = document.getElementById('bank-info-' + id);
        var ewalletInfo = document.getElementById('ewalet-info-' + id);
        var container = document.getElementById('payment-info-' + id);
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
    function updateFileName(input, labelId) {
        var label = document.getElementById(labelId);
        if (input.files && input.files[0]) {
            label.textContent = input.files[0].name;
        } else {
            label.textContent = 'Pilih Foto Bukti Transfer';
        }
    }
</script>