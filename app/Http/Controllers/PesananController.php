<?php

namespace App\Http\Controllers;

use App\Models\Layanan;
use App\Models\Pesanan;
use App\Models\Kurir;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PesananController extends Controller
{
    // ==========================================
    // AREA ADMIN
    // ==========================================
    
    public function adminIndex()
    {
        $hariIni = now()->format('Y-m-d');

        $stats = [
            'pesanan_baru' => Pesanan::whereDate('created_at', $hariIni)->count(),
            'total_pendapatan' => Pesanan::whereDate('created_at', $hariIni)->sum('total_harga'),
            'kurir_aktif' => Kurir::count(),
            'perlu_diproses' => Pesanan::whereIn('status', ['menunggu_pickup', 'menunggu_timbang'])->count(),
        ];

        // REVISI: Eager Loading 'kurir' dan 'pelanggan' biar gak berat
        $semua_pesanan = Pesanan::with(['pelanggan', 'layanan', 'kurir'])->latest()->get();
        $pesanan_terbaru = $semua_pesanan->take(5);

        // REVISI: Admin butuh liat semua kurir (termasuk yang sibuk) buat ditugaskan
        $daftar_kurir = Kurir::all(); 
        $daftar_layanan = Layanan::all();

        return view('admin.dashboard', compact(
            'stats', 
            'semua_pesanan', 
            'pesanan_terbaru', 
            'daftar_kurir', 
            'daftar_layanan'
        ));
    }

    // --- 1. Fungsi Update Admin Pintar ---
    public function adminUpdatePesanan(Request $request, $id)
    {
        $pesanan = \App\Models\Pesanan::findOrFail($id);
        
        $request->validate([
            'id_kurir' => 'nullable|exists:kurirs,id_kurir',
            'status' => 'required',
            'berat' => 'nullable|numeric|min:0',
        ]);

        $hargaPerKg = $pesanan->layanan->harga_per_kg ?? 0;
        $beratBaru = $request->berat ?? $pesanan->berat;
        $totalHargaBaru = $beratBaru * $hargaPerKg;
        
        $statusBaru = $request->status;

        // 🔥 MAGIC: Kalau admin input berat (>0) dan sebelumnya beratnya 0, status OTOMATIS jadi menunggu_bayar!
        if ($beratBaru > 0 && $pesanan->berat == 0) {
            $statusBaru = 'menunggu_bayar';
        }

        $pesanan->update([
            'id_kurir' => $request->id_kurir,
            'berat' => $beratBaru,
            'total_harga' => $totalHargaBaru,
            'status' => $statusBaru,
        ]);

        return back()->with('success', 'Update berhasil! Status sekarang: ' . $statusBaru);
    }

    public function storeManual(Request $request)
    {
        $request->validate([
            'id_pelanggan' => 'required|exists:pelanggans,id_pelanggan',
            'id_layanan' => 'required|exists:layanans,id_layanan',
        ]);

        Pesanan::create([
            'id_pelanggan' => $request->id_pelanggan,
            'id_layanan' => $request->id_layanan,
            'status' => 'menunggu_pickup', // Alur awal
            'berat' => 0,
            'total_harga' => 0,
            'tanggal_pesan' => now(),
        ]);

        return back()->with('success', 'Pesanan offline berhasil dibuat!');
    }

    // ==========================================
    // AREA PELANGGAN
    // ==========================================

    public function pelangganIndex()
    {
        $layanan = Layanan::all();
        $pesanan_saya = Pesanan::where('id_pelanggan', auth('pelanggan')->id())
                        ->with(['layanan', 'kurir'])
                        ->latest()
                        ->get();

        return view('dashboard', compact('layanan', 'pesanan_saya'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_layanan' => 'required|exists:layanans,id_layanan',
            'alamat' => 'required|string|max:255',
        ]);

        Pesanan::create([
            'id_pelanggan' => auth('pelanggan')->id(),
            'id_layanan' => $request->id_layanan,
            'alamat' => $request->alamat,
            'status' => 'menunggu_pickup',
            'total_harga' => 0,
            'tanggal_pesan' => now(),
        ]);

        return redirect()->route('dashboard')->with('success', 'Pesanan dibuat! Kurir akan segera meluncur.');
    }

    public function uploadPembayaran(Request $request, $id)
    {
        $request->validate([
            'bukti_bayar' => 'required|image|mimes:jpg,png,jpeg|max:2048', // Max 2MB ege
        ]);

        $pesanan = Pesanan::findOrFail($id);

        if ($request->hasFile('bukti_bayar')) {
            // Simpan file ke folder storage/app/public/bukti_bayar
            $file = $request->file('bukti_bayar');
            $path = $file->store('bukti_bayar', 'public');

            // Update database
            $pesanan->update([
                'bukti_bayar' => $path,
                'status' => 'menunggu_konfirmasi' 
            ]);
        }

        return back()->with('success', 'Bukti berhasil diupload! Tunggu admin validasi ya.');
    }

    // ==========================================
    // AREA KURIR
    // ==========================================

    public function kurirIndex()
    {
        $kurirId = Auth::guard('kurir')->id();

        // REVISI: Gabungkan query biar gak dobel
        $tugas_kurir = Pesanan::where('id_kurir', $kurirId)
            ->whereIn('status', ['menunggu_pickup', 'delivery']) 
            ->with('pelanggan')
            ->latest()
            ->get();

        $riwayat_tugas = Pesanan::where('id_kurir', $kurirId)
            ->where('status', 'selesai')
            ->with('pelanggan')
            ->latest()
            ->limit(10)
            ->get();

        return view('kurir.dashboard', compact('tugas_kurir', 'riwayat_tugas'));
    }

    public function kurirSelesaikanTugas($id)
    {
        $pesanan = \App\Models\Pesanan::findOrFail($id);
        
        // Logika perubahan status otomatis
        if ($pesanan->status == 'menunggu_pickup') {
            $pesanan->status = 'menunggu_timbang'; // Beres jemput, baju sampai di toko buat ditimbang
            $pesan_sukses = 'Baju berhasil dijemput! Serahkan ke admin buat ditimbang ege.';
        } elseif ($pesanan->status == 'delivery') {
            $pesanan->status = 'selesai'; // Beres antar ke pelanggan
            $pesan_sukses = 'Tugas antar selesai! Cuan mengalir wkwk.';
        } else {
            return back()->with('error', 'Status pesanan nggak valid buat diselesaikan kurir.');
        }

        $pesanan->save();

        return redirect()->route('kurir.dashboard')->with('success', $pesan_sukses);
    }
}