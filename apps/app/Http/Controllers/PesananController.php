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
        $layanan = \App\Models\Layanan::all();
        
        // Cek jumlah data yang masuk
        // return "Jumlah layanan di database: " . $layanan->count(); 
        
        $pesanan_saya = \App\Models\Pesanan::where('id_pelanggan', auth('pelanggan')->id())->get();
        return view('dashboard', compact('layanan', 'pesanan_saya'));
    }

    public function adminIndex()
    {
        // 1. Ambil SEMUA pesanan dari database untuk dikelola Admin
        // Kita pakai eager loading 'pelanggan' biar bisa nampilin nama pemesannya
        $semua_pesanan = \App\Models\Pesanan::with('pelanggan')->latest()->get();

        // 2. Ambil data layanan (siapa tahu admin butuh lihat daftar harga)
        $layanan = \App\Models\Layanan::all();

        // 3. Kirim ke view dashboard (view-nya sama, tapi nanti isinya beda karena guard admin)
        return view('dashboard', compact('semua_pesanan', 'layanan'));
    }

    // Logika menyimpan pesanan (Checkout)
    public function store(Request $request)
    {
        // 1. Validasi Input
        $request->validate([
            'id_layanan' => 'required|exists:layanans,id_layanan',
            'alamat' => 'required|string|max:255',
        ]);

        // 2. Simpan Data
        \App\Models\Pesanan::create([
            'id_pelanggan' => auth('pelanggan')->id(),
            'id_layanan' => $request->id_layanan,
            'alamat' => $request->alamat, // Pastikan kolom 'alamat' ada di tabel pesanans
            'status' => 'menunggu_jemput', // Status awal sesuai alur baru kita
            'total_harga' => 0, // Harga 0 dulu karena belum ditimbang
        ]);

        return redirect()->route('dashboard')->with('success', 'Pesanan berhasil dibuat! Kurir akan segera menjemput.');
    }

    // Fungsi untuk mengubah status pesanan (Khusus Admin)
    public function updateStatus(Request $request, $id)
    {
        // Cek apakah yang akses benar-benar admin
        if (auth('admin')->check() && auth('admin')->user()->role !== 'admin') {
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

    public function inputTimbangan(Request $request, $id)
    {
        // 1. Validasi inputan berat
        $request->validate([
            'berat' => 'required|numeric|min:0.1',
        ]);

        // 2. Cari data pesanan dan layanan terkait
        $pesanan = Pesanan::findOrFail($id);
        $layanan = $pesanan->layanan; // Pastikan relasi 'layanan' sudah ada di Model Pesanan

        // 3. Hitung total harga berdasarkan berat asli
        $total_harga = $request->berat * $layanan->harga_per_kg;

        // 4. Update data pesanan
        $pesanan->update([
            'berat' => $request->berat,
            'total_harga' => $total_harga,
            'status' => 'menunggu_pembayaran', // Geser status ke tahap selanjutnya
        ]);

        return redirect()->route('dashboard')->with('success', 'Berat pesanan #' . $id . ' berhasil diinput. User sekarang bisa melakukan pembayaran!');
    }

    public function konfirmasiPembayaran($id)
    {
        $pesanan = Pesanan::findOrFail($id);
        $pesanan->update(['status' => 'dicuci']); // Alur: Bayar -> Cuci

        return redirect()->back()->with('success', 'Pembayaran valid, selamat mencuci!');
    }
}