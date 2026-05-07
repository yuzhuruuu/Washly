<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @if(Auth::guard('admin')->check())
                {{ __('Panel Kendali Admin Washly') }}
            @elseif(Auth::guard('kurir')->check())
                {{ __('Dashboard Kurir Washly') }}
            @else
                {{ __('Dashboard Pelanggan Washly') }}
            @endif
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if(session('success'))
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 px-4 py-3 rounded mb-6 shadow-sm flex justify-between items-center">
                    <span>{{ session('success') }}</span>
                    <button onclick="this.parentElement.remove()" class="font-bold text-lg">&times;</button>
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    {{-- ========================================== --}}
                    {{-- SIDE ADMIN --}}
                    {{-- ========================================== --}}
                    @if(Auth::guard('admin')->check())
                        <div class="flex justify-between items-center mb-6">
                            <h3 class="text-lg font-bold text-gray-800">Halo Admin, {{ Auth::guard('admin')->user()->nama }}!</h3>
                            <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded uppercase">Mode Admin</span>
                        </div>
                        
                        <div class="overflow-x-auto shadow-sm rounded-lg border">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">ID & Pelanggan</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Detail Berat & Harga</th>
                                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">Status Alur</th>
                                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">Aksi Admin</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @forelse($semua_pesanan ?? [] as $p)
                                    <tr class="hover:bg-gray-50 transition">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm font-bold text-gray-900">#{{ $p->id_pesanan }}</div>
                                            {{-- Ganti dari $p->user->name jadi $p->pelanggan->nama --}}
                                            <div class="text-xs text-gray-500">{{ $p->pelanggan->nama ?? 'Anonim' }}</div> 
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            @if($p->total_harga > 0)
                                                <div class="text-sm text-gray-700 font-semibold">Rp {{ number_format($p->total_harga, 0, ',', '.') }}</div>
                                                <div class="text-xs text-gray-500">{{ $p->berat }} Kg</div>
                                            @else
                                                <span class="text-xs italic text-red-500">Belum ditimbang</span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-center">
                                            {{-- Sesuaikan dengan Enum di Database Baru --}}
                                            <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full 
                                                @if($p->status == 'menunggu_pickup') bg-gray-100 text-gray-800 
                                                @elseif($p->status == 'menunggu_bayar') bg-yellow-100 text-yellow-800
                                                @elseif($p->status == 'proses') bg-indigo-100 text-indigo-800
                                                @elseif($p->status == 'delivery') bg-blue-100 text-blue-800
                                                @else bg-green-100 text-green-800 @endif">
                                                {{ strtoupper(str_replace('_', ' ', $p->status)) }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-center">
                                            <div class="flex flex-col items-center gap-2">
                                                @if($p->status == 'menunggu_pickup')
                                                    <form action="{{ route('pesanan.updateTimbangan', $p->id_pesanan) }}" method="POST" class="flex gap-2">
                                                        @csrf @method('PATCH')
                                                        <input type="number" name="berat" step="0.1" class="w-20 text-xs rounded border-gray-300" placeholder="Kg" required>
                                                        <button type="submit" class="bg-orange-500 hover:bg-orange-600 text-white px-2 py-1 rounded text-xs transition">Timbang</button>
                                                    </form>
                                                @elseif($p->status == 'menunggu_bayar' && $p->pembayaran)
                                                    <a href="{{ asset('storage/' . $p->pembayaran->bukti_bayar) }}" target="_blank" class="text-blue-600 hover:underline text-xs mb-1">Cek Bukti</a>
                                                    @if($p->pembayaran->status_pembayaran === 'validasi')
                                                        <form action="{{ route('pembayaran.konfirmasi', $p->pembayaran->id_pembayaran) }}" method="POST">
                                                            @csrf @method('PATCH')
                                                            <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-4 py-1 rounded text-xs shadow transition">Konfirmasi Lunas</button>
                                                        </form>
                                                    @endif
                                                @elseif($p->status == 'proses')
                                                     <form action="{{ route('pesanan.updateStatus', $p->id_pesanan) }}" method="POST">
                                                        @csrf @method('PATCH')
                                                        <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-1 rounded text-xs shadow transition">Selesai Cuci (Kirim)</button>
                                                    </form>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="4" class="px-6 py-4 text-center text-gray-500 italic">Belum ada pesanan masuk.</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>


                    {{-- ========================================== --}}
                    {{-- SIDE KURIR --}}
                    {{-- ========================================== --}}
                    @elseif(Auth::guard('kurir')->check())
                        <div class="text-center py-10">
                            <h3 class="text-2xl font-bold text-gray-800">Halo Kurir, {{ Auth::guard('kurir')->user()->nama }}!</h3>
                            <p class="text-gray-500 mt-2">Daftar tugas jemput dan antar kamu akan muncul di sini nanti.</p>
                        </div>


                    {{-- ========================================== --}}
                    {{-- SIDE PELANGGAN --}}
                    {{-- ========================================== --}}
                    @elseif(Auth::guard('pelanggan')->check())
                        <div class="mb-6 flex justify-between items-end">
                            <div>
                                <h3 class="text-lg font-bold text-gray-800">Halo, {{ Auth::guard('pelanggan')->user()->nama }}!</h3>
                                <p class="text-sm text-gray-600">Alur Pesanan: Jemput -> Timbang -> Bayar -> Cuci -> Selesai</p>
                            </div>
                            <a href="#riwayat" class="text-blue-600 text-sm hover:underline">Lihat Riwayat Pesanan</a>
                        </div>

                        {{-- Form Order Baru --}}
                        <div class="bg-blue-50 p-6 rounded-xl border border-blue-200 mb-10 shadow-sm">
                            <h4 class="font-bold text-blue-800 mb-4 flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                                Buat Pesanan Baru
                            </h4>
                            <form action="{{ route('pesanan.store') }}" method="POST">
                                @csrf
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div class="space-y-2">
                                        <label class="block font-semibold text-sm text-gray-700">Pilih Jenis Layanan</label>
                                        <select name="id_layanan" class="w-full border-gray-300 focus:border-blue-500 focus:ring-blue-500 rounded-lg shadow-sm" required>
                                            <option value="" disabled selected>-- Pilih Layanan --</option>
                                            @forelse($layanan as $l)
                                                <option value="{{ $l->id_layanan }}">
                                                    {{ $l->nama_layanan }} (Rp {{ number_format($l->harga_per_kg, 0, ',', '.') }}/kg)
                                                </option>
                                            @empty
                                                <option disabled>Layanan belum diinput Admin.</option>
                                            @endforelse
                                        </select>
                                    </div>
                                    <div class="space-y-2">
                                        <label class="block font-semibold text-sm text-gray-700">Alamat Penjemputan</label>
                                        {{-- Otomatis ngisi alamat dari database pelanggan --}}
                                        <input type="text" name="alamat" value="{{ Auth::guard('pelanggan')->user()->alamat }}" 
                                               class="w-full border-gray-300 focus:border-blue-500 focus:ring-blue-500 rounded-lg shadow-sm" required>
                                    </div>
                                </div>
                                <div class="mt-6">
                                    <button type="submit" class="w-full md:w-auto px-10 py-3 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-lg transition shadow-md">
                                        Pesan Sekarang (Kurir Akan Menjemput)
                                    </button>
                                </div>
                            </form>
                        </div>

                        {{-- Daftar Pesanan Aktif Pelanggan --}}
                        <div id="riwayat" class="mt-10">
                            <h3 class="text-lg font-bold mb-4 text-gray-800">Status Pesanan Saya</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                                @php
                                    // Query pakai ID Pelanggan yang login, sesuaikan nama kolom dengan migrasi
                                    $pesanan_saya = \App\Models\Pesanan::where('id_pelanggan', Auth::guard('pelanggan')->id())->latest()->get();
                                @endphp
                                @forelse($pesanan_saya as $ps)
                                    <div class="bg-white border rounded-xl p-5 shadow-sm hover:shadow-md transition">
                                        <div class="flex justify-between items-start mb-3">
                                            <span class="text-xs font-bold text-gray-400 uppercase">#{{ $ps->id_pesanan }}</span>
                                            <span class="px-2 py-1 text-[10px] font-bold rounded-full 
                                                {{ $ps->status == 'selesai' ? 'bg-green-100 text-green-700' : 'bg-orange-100 text-orange-700' }}">
                                                {{ strtoupper(str_replace('_', ' ', $ps->status)) }}
                                            </span>
                                        </div>
                                        
                                        <div class="mb-4">
                                            <div class="text-sm font-bold text-gray-800">{{ $ps->layanan->nama_layanan ?? 'Layanan' }}</div>
                                            <div class="text-xs text-gray-500">{{ $ps->created_at->format('d M Y, H:i') }}</div>
                                        </div>

                                        <div class="border-t pt-3 flex justify-between items-center">
                                            <div>
                                                <div class="text-[10px] text-gray-400 uppercase leading-none">Total Bayar</div>
                                                <div class="text-sm font-black text-blue-600">
                                                    {{ $ps->total_harga > 0 ? 'Rp '.number_format($ps->total_harga, 0, ',', '.') : 'Menunggu ditimbang' }}
                                                </div>
                                            </div>

                                            @if($ps->status == 'menunggu_bayar')
                                                <a href="{{ route('pembayaran.create', $ps->id_pesanan) }}" class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-2 rounded-lg text-xs font-bold shadow-sm transition">
                                                    Bayar Sekarang
                                                </a>
                                            @endif
                                        </div>
                                    </div>
                                @empty
                                    <div class="col-span-full py-10 text-center text-gray-400 italic">Kamu belum pernah memesan laundry di Washly.</div>
                                @endforelse
                            </div>
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
</x-app-layout>