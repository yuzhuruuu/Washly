<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kurir; 
use App\Models\Pesanan; 
use App\Models\Layanan;
use App\Models\Admin; 
use Illuminate\Support\Facades\Hash; 
use Illuminate\Support\Facades\Auth;

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

        return view('admin.kelola-pesanan', compact('stats', 'semua_pesanan', 'pesanan_terbaru', 'daftar_kurir', 'daftar_layanan'));
    }

    
    public function indexKurir()
    {
        // Ambil semua data kurir dari database urut dari yang terbaru
        $daftar_kurir = Kurir::latest()->get();
        
        // Tampilkan ke halaman admin.kurir
        return view('admin.kurir', compact('daftar_kurir'));
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

    public function pengaturan()
    {
        // Ambil data harga dari tabel layanans berdasarkan namanya
        $tarif_cuci = \App\Models\Layanan::where('nama_layanan', 'Cuci Saja')->value('harga_per_kg') ?? 7000;
        $tarif_setrika = \App\Models\Layanan::where('nama_layanan', 'Setrika Saja')->value('harga_per_kg') ?? 5000;
        $tarif_combo = \App\Models\Layanan::where('nama_layanan', 'Cuci + Setrika')->value('harga_per_kg') ?? 15000;

        // Lempar variabel harga ke halaman Blade
        return view('admin.pengaturan', compact('tarif_cuci', 'tarif_setrika', 'tarif_combo'));
    }

    public function updatePengaturan(Request $request)
    {
        $admin = Admin::find(Auth::guard('admin')->id());
        
        // 1. Simpan Nama Admin ke Database
        if ($request->has('nama')) {
            $admin->nama = $request->nama;
            $admin->save();
        }

        // 2. Simpan Harga Layanan ke Tabel Layanans
        if ($request->has('tarif_cuci')) {
            \App\Models\Layanan::where('nama_layanan', 'Cuci Saja')
                ->update(['harga_per_kg' => $request->tarif_cuci]);
        }
        if ($request->has('tarif_setrika')) {
            \App\Models\Layanan::where('nama_layanan', 'Setrika Saja')
                ->update(['harga_per_kg' => $request->tarif_setrika]);
        }
        if ($request->has('tarif_combo')) {
            \App\Models\Layanan::where('nama_layanan', 'Cuci + Setrika')
                ->update(['harga_per_kg' => $request->tarif_combo]);
        }
        
        return back()->with('success', 'Pengaturan dan Tarif berhasil disimpan!');
    }
    public function storeLayanan(Request $request)
    {
        // Validasi data yang masuk
        $request->validate([
            'nama_layanan' => 'required|string|max:255',
            'harga_per_kg' => 'required|numeric|min:0',
        ]);

        // Simpan ke database tabel layanans
        \App\Models\Layanan::create([
            'nama_layanan' => $request->nama_layanan,
            'harga_per_kg' => $request->harga_per_kg,
        ]);

        return back()->with('success', 'Layanan baru berhasil ditambahkan!');
    }
}