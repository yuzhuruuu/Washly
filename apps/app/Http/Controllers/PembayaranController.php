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

        $path = $request->file('bukti_bayar')->store('bukti_bayar', 'public');

            \App\Models\Pembayaran::create([
                'id_pesanan' => $request->id_pesanan,
                'bukti_bayar' => $path,
                'status_pembayaran' => 'validasi'
            ]);

            // Update status pesanan jadi menunggu konfirmasi admin
            \App\Models\Pesanan::where('id_pesanan', $request->id_pesanan)
                            ->update(['status' => 'menunggu_konfirmasi']);

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
}