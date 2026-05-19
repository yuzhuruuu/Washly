<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kurir; // Wajib import model Kurir
use Illuminate\Support\Facades\Hash; // Wajib import Hash

class AdminController extends Controller
{
    public function adminDashboard()
    {
        $hariIni = now()->format('Y-m-d');

        // Statistik
        $stats = [
            'pesanan_baru' => \App\Models\Pesanan::whereDate('created_at', $hariIni)->count(),
            'total_pendapatan' => \App\Models\Pesanan::whereDate('created_at', $hariIni)->sum('total_harga'),
            'kurir_aktif' => \App\Models\Kurir::count(),
            'perlu_diproses' => \App\Models\Pesanan::whereIn('status', ['menunggu_pickup', 'menunggu_timbang'])->count(),
        ];

        $semua_pesanan = \App\Models\Pesanan::with(['pelanggan', 'layanan'])->latest()->get();
        $pesanan_terbaru = $semua_pesanan->take(5); 
        $daftar_kurir = \App\Models\Kurir::all();
        $daftar_layanan = \App\Models\Layanan::all(); 

        return view('admin.dashboard', compact('stats', 'semua_pesanan', 'pesanan_terbaru', 'daftar_kurir', 'daftar_layanan'));
    }

    public function storeKurir(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'no_hp' => 'required|string|max:15',
            'username' => 'required|string|max:255|unique:kurirs',
            'password' => 'required|string|min:8',
        ]);

        Kurir::create([
            'nama' => $request->nama,
            'no_hp' => $request->no_hp,
            'username' => $request->username,
            'password' => Hash::make($request->password),
        ]);

        return back()->with('success', 'Akun Kurir berhasil dibuat! Budi siap disuruh kerja.');
    }

    public function updateLayanan(Request $request, $id)
    {
        $layanan = \App\Models\Layanan::findOrFail($id);

        $request->validate([
            'nama_layanan' => 'required|string|max:255',
            'harga_per_kg' => 'required|numeric|min:0',
        ]);

        $layanan->update([
            'nama_layanan' => $request->nama_layanan,
            'harga_per_kg' => $request->harga_per_kg,
        ]);

        return back()->with('success', 'Layanan dan tarif berhasil diperbarui.');
    }
}