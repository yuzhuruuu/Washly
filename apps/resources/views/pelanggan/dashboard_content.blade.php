{{-- Bagian Atas: Welcoming & Info Singkat --}}
<div class="mb-8 flex justify-between items-end">
    <div>
        <h3 class="text-xl font-bold text-gray-800">Halo, {{ Auth::guard('pelanggan')->user()->nama }}! 👋</h3>
        <p class="text-sm text-gray-500 mt-1">Mau laundry apa hari ini? Kurir kami siap menjemput.</p>
    </div>
</div>

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
                <p class="text-gray-400 italic">Belum ada pesanan ege. Cobain dong jasanya!</p>
            </div>
        @endforelse
    </div>
</div>