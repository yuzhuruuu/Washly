<?php

namespace App\Http\Controllers;

use App\Models\Layanan;
use App\Models\Pesanan;
use App\Models\DetailPesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PesananController extends Controller
{
    // Menampilkan halaman dashboard dengan daftar layanan
    public function index()
        {
            $layanans = \App\Models\Layanan::all();

        if (auth()->user()->role === 'admin') {
            // Tambahkan 'pembayaran' di dalam with()
            $semua_pesanan = \App\Models\Pesanan::with(['user', 'pembayaran'])
                            ->orderBy('created_at', 'desc')
                            ->get();
            return view('dashboard', compact('layanans', 'semua_pesanan'));
        }

        return view('dashboard', compact('layanans'));
    }

    // Logika menyimpan pesanan (Checkout)
    public function store(Request $request)
    {
        // 1. Validasi input
        $request->validate([
            'id_layanan' => 'required|exists:layanans,id_layanan',
            'berat' => 'required|numeric|min:1',
        ]);

        // 2. Ambil data layanan untuk hitung harga
        $layanan = Layanan::find($request->id_layanan);
        $total_harga = $layanan->harga_per_kg * $request->berat;

        // 3. Simpan ke tabel pesanans
        $pesanan = Pesanan::create([
            'id_user' => Auth::id(),
            'tanggal_pesan' => now(),
            'status' => 'menunggu',
            'total_harga' => $total_harga,
        ]);

        // 4. Simpan ke tabel detail_pesanans
        DetailPesanan::create([
            'id_pesanan' => $pesanan->id_pesanan,
            'id_layanan' => $layanan->id_layanan,
            'berat' => $request->berat,
            'subtotal' => $total_harga,
        ]);

        return redirect()->back()->with('success', 'Pesanan berhasil dibuat! Total: Rp ' . number_format($total_harga, 0, ',', '.'));
    }
    // Fungsi untuk mengubah status pesanan (Khusus Admin)
    public function updateStatus(Request $request, $id)
    {
        // Cek apakah yang akses benar-benar admin
        if (auth()->user()->role !== 'admin') {
            return redirect()->back()->with('error', 'Anda tidak punya akses!');
        }

        $pesanan = Pesanan::findOrFail($id);
        
        // Logika perubahan status sederhana
        if ($pesanan->status === 'menunggu') {
            $pesanan->status = 'proses';
        } elseif ($pesanan->status === 'proses') {
            $pesanan->status = 'selesai';
        }

        $pesanan->save();

        return redirect()->back()->with('success', 'Status pesanan berhasil diperbarui!');
    }
}