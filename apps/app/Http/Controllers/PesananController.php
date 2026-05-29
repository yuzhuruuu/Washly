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
        $pesananHariIni = \App\Models\Pesanan::whereDate('created_at', \Carbon\Carbon::today())->count();
        $sedangDiproses = \App\Models\Pesanan::whereIn('status', ['Sedang Diproses', 'Proses Cuci', 'Diambil Kurir'])->count();
        $selesaiHariIni = \App\Models\Pesanan::where('status', 'Selesai')->whereDate('updated_at', \Carbon\Carbon::today())->count();
        $menungguBayar  = \App\Models\Pesanan::where('status', 'Menunggu Pembayaran')->count();

        $pesananTerbaru = \App\Models\Pesanan::with(['pelanggan', 'layanan'])
                                            ->latest('created_at')
                                            ->take(5)
                                            ->get();

        return view('admin.dashboard', compact('pesananHariIni', 'sedangDiproses', 'selesaiHariIni', 'menungguBayar', 'pesananTerbaru'));
    }

    public function adminRiwayat(\Illuminate\Http\Request $request)
    {
        $query = \App\Models\Pesanan::with(['pelanggan', 'layanan'])
                  ->whereIn('status', ['Selesai', 'Batal', 'Dibatalkan']);
                  
        if ($request->filled('cari')) {
            $cari = $request->cari;
            $query->whereHas('pelanggan', function($q) use ($cari) {
                $q->where('nama', 'like', "%{$cari}%");
            })->orWhere('id_pesanan', 'like', "%{$cari}%");
        }

        $riwayatPesanan = $query->latest('updated_at')->paginate(5); 

        $totalPesanan = \App\Models\Pesanan::where('status', 'Selesai')->count();
        $totalPendapatan = \App\Models\Pesanan::where('status', 'Selesai')->sum('total_harga');
        $rataBerat = \App\Models\Pesanan::where('status', 'Selesai')->avg('berat');

        return view('admin.riwayat', compact('riwayatPesanan', 'totalPesanan', 'totalPendapatan', 'rataBerat'));
    }

    public function kelolaPesanan()
    {
        $semua_pesanan = Pesanan::with(['pelanggan', 'layanan', 'kurir'])->latest()->get();
        $daftar_kurir = Kurir::all();
        
        return view('admin.kelola-pesanan', compact('semua_pesanan', 'daftar_kurir'));
    }

    public function adminUpdatePesanan(Request $request, $id)
    {
        $pesanan = \App\Models\Pesanan::findOrFail($id);
        
        // 🔥 JALUR KHUSUS: Mengubah Status Pesanan via Form Konfirmasi Pembayaran
        if ($request->has('status_pembayaran')) {
            $statusBaru = ($request->status_pembayaran == 'Lunas') ? 'Sedang Diproses' : 'Menunggu Pembayaran';
            
            $pesanan->update(['status' => $statusBaru]);
            
            return back()->with('success', 'Status pesanan berhasil diupdate ke: ' . $statusBaru);
        }

        // 🔥 JALUR KELOLA PESANAN MANUAL
        $request->validate([
            'id_kurir' => 'nullable',
            'status' => 'nullable',
            'berat' => 'nullable|numeric',
        ]);

        $pesanan->update([
            'id_kurir' => $request->id_kurir ?? $pesanan->id_kurir,
            'berat' => $request->berat ?? $pesanan->berat,
            'status' => $request->status ?? $pesanan->status,
        ]);

        return back()->with('success', 'Update berhasil!');
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
            'status' => 'menunggu_pickup',
            'berat' => 0,
            'total_harga' => 0,
            'tanggal_pesan' => now(),
        ]);

        return back()->with('success', 'Pesanan offline berhasil dibuat!');
    }

    public function adminPembayaran()
    {
        $pesananList = \App\Models\Pesanan::with(['pelanggan'])
                                        ->whereNotNull('bukti_bayar')
                                        ->latest('updated_at')
                                        ->get();

        // 🔥 FILTER PINTAR ALPINE.JS: 
        // Mengubah status asli database menjadi filter tab (dikonfirmasi/ditolak/belum)
        $pesananList->map(function($pesanan) {
            $s = strtolower($pesanan->status);
            
            if (strpos($s, 'proses') !== false || strpos($s, 'selesai') !== false || strpos($s, 'delivery') !== false || strpos($s, 'diambil') !== false) {
                $pesanan->status_pembayaran = 'dikonfirmasi';
            } elseif (strpos($s, 'batal') !== false || strpos($s, 'tolak') !== false) {
                $pesanan->status_pembayaran = 'ditolak';
            } else {
                $pesanan->status_pembayaran = 'belum';
            }
            return $pesanan;
        });

        return view('admin.pembayaran', compact('pesananList'));
    }

    // ==========================================
    // AREA PELANGGAN
    // ==========================================

    public function pelangganIndex()
    {
        $daftar_layanan = Layanan::all();
        $semua_pesanan = Pesanan::where('id_pelanggan', auth('pelanggan')->id())
                        ->with(['layanan', 'kurir'])
                        ->latest()
                        ->get();

        return view('pelanggan.dashboard', compact('daftar_layanan', 'semua_pesanan'));
    }

    public function createPesanan()
    {
        $daftar_layanan = Layanan::all();
        return view('pelanggan.pesanan-baru', compact('daftar_layanan'));
    }

    public function pelangganRiwayat()
    {
        $semua_pesanan = Pesanan::where('id_pelanggan', auth('pelanggan')->id())
                        ->with(['layanan', 'kurir'])
                        ->latest()
                        ->get();

        return view('pelanggan.riwayat', compact('semua_pesanan'));
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

        return redirect()->route('pelanggan.dashboard')->with('success', 'Pesanan dibuat! Kurir akan segera meluncur.');
    }

    public function uploadPembayaran(Request $request, $id)
    {
        $request->validate([
            'bukti_bayar' => 'required|image|mimes:jpg,png,jpeg|max:2048', 
        ]);

        $pesanan = Pesanan::findOrFail($id);

        if ($request->hasFile('bukti_bayar')) {
            $file = $request->file('bukti_bayar');
            $path = $file->store('bukti_bayar', 'public');

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

    public function kurirRiwayat()
    {
        $kurirId = Auth::guard('kurir')->id();

        $riwayat_tugas = Pesanan::where('id_kurir', $kurirId)
            ->where('status', 'selesai')
            ->with('pelanggan')
            ->latest()
            ->get();

        return view('kurir.riwayat', compact('riwayat_tugas'));
    }

    public function kurirSelesaikanTugas($id)
    {
        $pesanan = \App\Models\Pesanan::findOrFail($id);
        
        if ($pesanan->status == 'menunggu_pickup') {
            $pesanan->status = 'menunggu_timbang'; 
            $pesan_sukses = 'Baju berhasil dijemput! Serahkan ke admin buat ditimbang.';
        } elseif ($pesanan->status == 'delivery') {
            $pesanan->status = 'selesai'; 
            $pesan_sukses = 'Tugas antar selesai! Cuan mengalir wkwk.';
        } else {
            return back()->with('error', 'Status pesanan nggak valid buat diselesaikan kurir.');
        }

        $pesanan->save();

        return redirect()->route('kurir.dashboard')->with('success', $pesan_sukses);
    }

    public function kurirProfil()
    {
        $kurirId = Auth::guard('kurir')->id();

        $riwayat_tugas = Pesanan::where('id_kurir', $kurirId)
            ->where('status', 'selesai')
            ->get();

        return view('kurir.profil', compact('riwayat_tugas'));
    }
    
    public function kurirPengaturan()
    {
        return view('kurir.pengaturan');
    }

    public function kurirUpdatePengaturan(\Illuminate\Http\Request $request)
    {
        $kurir = \App\Models\Kurir::find(\Illuminate\Support\Facades\Auth::guard('kurir')->id());

        if ($request->has('password_action')) {
            $request->validate([
                'password_baru' => 'required|min:6',
            ]);
            $kurir->password = \Illuminate\Support\Facades\Hash::make($request->password_baru);
            $kurir->save();

            \Illuminate\Support\Facades\Auth::guard('kurir')->login($kurir);
            return redirect()->route('kurir.pengaturan')->with('success', 'Kata sandi berhasil diperbarui!');
        }

        if ($request->has('notification_action')) {
            $kurir->notif_tugas = $request->has('notif_tugas') ? 1 : 0;
            $kurir->notif_pesan = $request->has('notif_pesan') ? 1 : 0;
            $kurir->notif_promo = $request->has('notif_promo') ? 1 : 0;
            $kurir->save();

            \Illuminate\Support\Facades\Auth::guard('kurir')->login($kurir);
            return redirect()->route('kurir.pengaturan')->with('success', 'Preferensi notifikasi berhasil diperbarui!');
        }

        $kurir->nama = $request->nama;
        $kurir->no_hp = $request->no_hp;
        $kurir->save();

        \Illuminate\Support\Facades\Auth::guard('kurir')->login($kurir);
        return redirect()->route('kurir.pengaturan')->with('success', 'Informasi profil berhasil diperbarui!');
    }
}