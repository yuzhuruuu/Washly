<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PembayaranController extends Controller
{
    public function create($id)
    {
        $pesanan = \App\Models\Pesanan::findOrFail($id);
        return view('pelanggan.pembayaran', compact('pesanan'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_pesanan' => 'required',
            'metode_pembayaran' => 'required|in:BCA,BNI,GOPAY,DANA,ShopeePay,QRIS',
            'bukti_bayar' => 'required|image|mimes:jpg,png,jpeg|max:2048', // Max 2MB
        ]);

        $path = $request->file('bukti_bayar')->store('bukti_bayar', 'public');

            \App\Models\Pembayaran::create([
                'id_pesanan' => $request->id_pesanan,
                'metode_pembayaran' => $request->metode_pembayaran,
                'bukti_bayar' => $path,
                'status_pembayaran' => 'validasi'
            ]);

            // Update status pesanan jadi menunggu konfirmasi admin dan simpan path bukti di tabel pesanan juga
            \App\Models\Pesanan::where('id_pesanan', $request->id_pesanan)
                            ->update([
                                'status' => 'menunggu_konfirmasi',
                                'bukti_bayar' => $path
                            ]);

            return back()->with('success', 'Bukti bayar berhasil diunggah! Tunggu admin cek ya.');
    }
    public function konfirmasi($id)
    {
        $pembayaran = \App\Models\Pembayaran::findOrFail($id);
        
        // Update status pembayaran jadi valid
        $pembayaran->status_pembayaran = 'valid';
        $pembayaran->save();

        return redirect()->back()->with('success', 'Pembayaran Berhasil Dikonfirmasi!');
    }

    /**
     * Proses pembayaran manual oleh admin untuk pesanan tipe manual
     * Admin input metode pembayaran (cash/qris) langsung tanpa upload bukti
     */
    public function storeManual(Request $request)
    {
        $request->validate([
            'id_pesanan' => 'required|exists:pesanans,id_pesanan',
            'metode_pembayaran' => 'required|in:cash,qris',
        ]);

        $pesanan = \App\Models\Pesanan::findOrFail($request->id_pesanan);

        // Pastikan ini pesanan manual
        if ($pesanan->tipe_pesanan !== 'manual') {
            return back()->with('error', 'Pesanan ini bukan tipe manual.');
        }

        // Buat record pembayaran
        \App\Models\Pembayaran::create([
            'id_pesanan' => $request->id_pesanan,
            'metode_pembayaran' => $request->metode_pembayaran,
            'status_pembayaran' => 'valid',
            'tanggal_bayar' => now(),
            'bukti_bayar' => null,
        ]);

        // Update status pesanan jadi selesai langsung dan simpan metode pembayaran
        $pesanan->update([
            'status' => 'Selesai',
            'metode_pembayaran_manual' => $request->metode_pembayaran,
            'tanggal_selesai' => now()
        ]);

        return back()->with('success', 'Pembayaran manual berhasil disimpan! Pesanan selesai.');
    }
}