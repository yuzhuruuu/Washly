<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PembayaranController extends Controller
{
    public function create($id)
    {
        $pesanan = \App\Models\Pesanan::findOrFail($id);
        return view('pembayaran.create', compact('pesanan'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_pesanan' => 'required',
            'bukti_bayar' => 'required|image|mimes:jpg,png,jpeg|max:2048', // Max 2MB
        ]);

        // Simpan file ke folder storage/app/public/bukti_bayar
        if ($request->hasFile('bukti_bayar')) {
            $path = $request->file('bukti_bayar')->store('bukti_bayar', 'public');

            // Simpan data ke tabel pembayarans
            \App\Models\Pembayaran::create([
                'id_pesanan' => $request->id_pesanan,
                'tanggal_bayar' => now(),
                'jumlah_bayar' => 0, // Nanti bisa diisi total harga
                'bukti_bayar' => $path,
                'status_pembayaran' => 'menunggu_konfirmasi'
            ]);

            return redirect()->route('dashboard')->with('success', 'Bukti bayar berhasil diupload! Tunggu konfirmasi admin.');
        }
    }
    public function konfirmasi($id)
    {
        $pembayaran = \App\Models\Pembayaran::findOrFail($id);
        
        // Update status pembayaran jadi valid
        $pembayaran->status_pembayaran = 'valid';
        $pembayaran->save();

        return redirect()->back()->with('success', 'Pembayaran Berhasil Dikonfirmasi!');
    }
}