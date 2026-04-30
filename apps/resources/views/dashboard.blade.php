<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ Auth::user()->role === 'admin' ? __('Panel Kendali Admin Washly') : __('Dashboard Pelanggan Washly') }}
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

                    @if(Auth::user()->role === 'admin')
                        <div class="flex justify-between items-center mb-6">
                            <h3 class="text-lg font-bold text-gray-800">Daftar Pesanan Masuk</h3>
                            <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded uppercase">Mode Admin</span>
                        </div>
                        
                        <div class="overflow-x-auto shadow-sm rounded-lg border">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">ID</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Pelanggan</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Total Harga</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase text-center">Status</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase text-center">Aksi</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tanggal</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @forelse($semua_pesanan as $p)
                                    <tr class="hover:bg-gray-50 transition">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">#{{ $p->id_pesanan }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $p->user->name }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700 font-semibold">Rp {{ number_format($p->total_harga, 0, ',', '.') }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-center">
                                            <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full 
                                                {{ $p->status == 'menunggu' ? 'bg-yellow-100 text-yellow-800' : ($p->status == 'proses' ? 'bg-blue-100 text-blue-800' : 'bg-green-100 text-green-800') }}">
                                                {{ strtoupper($p->status) }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $p->created_at->format('d M Y, H:i') }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                                            
                                            @if($p->pembayaran)
                                                <div class="flex flex-col items-center gap-2">
                                                    <a href="{{ asset('storage/' . $p->pembayaran->bukti_bayar) }}" target="_blank" class="text-blue-600 hover:underline text-xs">
                                                        Lihat Bukti
                                                    </a>

                                                    @if($p->pembayaran->status_pembayaran === 'menunggu_konfirmasi')
                                                        <form action="{{ route('pembayaran.konfirmasi', $p->pembayaran->id_pembayaran) }}" method="POST">
                                                            @csrf
                                                            @method('PATCH')
                                                            <button type="submit" class="bg-green-500 hover:bg-green-600 text-white px-3 py-1 rounded text-xs shadow">
                                                                Konfirmasi Bayar
                                                            </button>
                                                        </form>
                                                    @elseif($p->pembayaran->status_pembayaran === 'valid')
                                                        @if($p->status !== 'selesai')
                                                            <form action="{{ route('pesanan.updateStatus', $p->id_pesanan) }}" method="POST">
                                                                @csrf
                                                                @method('PATCH')
                                                                <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white px-3 py-1 rounded text-xs shadow">
                                                                    {{ $p->status == 'menunggu' ? 'Proses Sekarang' : 'Selesaikan' }}
                                                                </button>
                                                            </form>
                                                        @else
                                                            <span class="text-green-600 font-bold italic">Selesai ✓</span>
                                                        @endif
                                                    @endif
                                                </div>
                                            @else
                                                <span class="text-gray-400 italic text-xs">Menunggu Pembayaran</span>
                                            @endif

                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="6" class="px-6 py-4 text-center text-gray-500 italic">Belum ada pesanan masuk.</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                    @else
                        <div class="mb-6">
                            <h3 class="text-lg font-bold text-gray-800">Halo, {{ Auth::user()->name }}!</h3>
                            <p class="text-sm text-gray-600">Mau titip laundry apa hari ini?</p>
                        </div>

                        <div class="bg-gray-50 p-6 rounded-xl border border-gray-200 mb-10">
                            <form action="{{ route('pesanan.store') }}" method="POST">
                                @csrf
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div>
                                        <label class="block font-semibold text-sm text-gray-700 mb-2">Pilih Jenis Layanan</label>
                                        <select name="id_layanan" class="w-full border-gray-300 focus:border-blue-500 focus:ring-blue-500 rounded-lg shadow-sm">
                                            @foreach($layanans as $l)
                                                <option value="{{ $l->id_layanan }}">
                                                    {{ $l->nama_layanan }} (Rp {{ number_format($l->harga_per_kg, 0, ',', '.') }}/kg)
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div>
                                        <label class="block font-semibold text-sm text-gray-700 mb-2">Estimasi Berat (Kg)</label>
                                        <input type="number" name="berat" min="1" step="0.1" placeholder="Contoh: 2" 
                                               class="w-full border-gray-300 focus:border-blue-500 focus:ring-blue-500 rounded-lg shadow-sm" required>
                                    </div>
                                </div>
                                <div class="mt-8">
                                    <button type="submit" class="w-full md:w-auto px-8 py-3 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-lg transition shadow-md">
                                        Buat Pesanan Sekarang
                                    </button>
                                </div>
                            </form>
                        </div>

                        <div class="mt-10">
                            <h3 class="text-lg font-bold mb-4 text-gray-800">Riwayat Pesanan Saya</h3>
                            <div class="overflow-x-auto border rounded-lg shadow-sm">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">ID Pesanan</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Total Harga</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tanggal</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        @php
                                            $pesanan_saya = \App\Models\Pesanan::where('id_user', Auth::id())->latest()->get();
                                        @endphp
                                        @forelse($pesanan_saya as $ps)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">#{{ $ps->id_pesanan }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700 font-semibold">Rp {{ number_format($ps->total_harga, 0, ',', '.') }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full 
                                                    {{ $ps->status == 'menunggu' ? 'bg-yellow-100 text-yellow-800' : ($ps->status == 'proses' ? 'bg-blue-100 text-blue-800' : 'bg-green-100 text-green-800') }}">
                                                    {{ strtoupper($ps->status) }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span class="px-2 py-1 text-xs rounded-full {{ $ps->status == 'selesai' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                                    {{ $ps->status }}
                                                </span>
                                                
                                                @if($ps->status == 'menunggu')
                                                    <a href="{{ route('pembayaran.create', $ps->id_pesanan) }}" class="ml-2 text-blue-600 hover:underline text-xs font-bold">
                                                        Bayar Sekarang
                                                    </a>
                                                @endif
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $ps->created_at->format('d/m/Y') }}</td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="4" class="px-6 py-4 text-center text-gray-500 italic text-sm">Kamu belum punya riwayat pesanan.</td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
</x-app-layout>