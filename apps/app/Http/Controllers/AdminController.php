<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kurir; 
use App\Models\Pesanan; 
use App\Models\Layanan; 
use Illuminate\Support\Facades\Hash; 

class AdminController extends Controller
{
    public function adminDashboard()
    {
        $hariIni = now()->format('Y-m-d');

        // Statistik
        $stats = [
            'pesanan_baru' => Pesanan::whereDate('created_at', $hariIni)->count(),
            'total_pendapatan' => Pesanan::whereDate('created_at', $hariIni)->sum('total_harga'),
            'kurir_aktif' => Kurir::count(),
            'perlu_diproses' => Pesanan::whereIn('status', ['menunggu_pickup', 'menunggu_timbang'])->count(),
        ];

        $semua_pesanan = Pesanan::with(['pelanggan', 'layanan'])->latest()->get();
        $pesanan_terbaru = $semua_pesanan->take(5); 
        $daftar_kurir = Kurir::all();
        $daftar_layanan = Layanan::all(); 

        return view('admin.dashboard', compact('stats', 'semua_pesanan', 'pesanan_terbaru', 'daftar_kurir', 'daftar_layanan'));
    }

    public function storeKurir(Request $request)
    {
        
        $request->validate([
            'nama' => 'required|string|max:255',
            'no_hp' => 'required|string|max:15',
            'username' => 'required|string|max:255|unique:kurirs,username', 
            'password' => 'required|string|min:8',
        ]);

        Kurir::create([
            'nama' => $request->nama,
            'no_hp' => $request->no_hp,
            'username' => $request->username,
            'password' => Hash::make($request->password),
        ]);

        return back()->with('success', 'Akun Kurir berhasil dibuat! Kurir siap bekerja.');
    }

    public function updateLayanan(Request $request, $id)
    {
        $layanan = Layanan::findOrFail($id);

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