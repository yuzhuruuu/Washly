<?php

namespace App\Http\Controllers;

use App\Models\Layanan;
use App\Models\Pelanggan;
use App\Models\Pesanan;
use App\Models\Kurir;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

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

        $daftar_layanan = Layanan::all();

        return view('admin.dashboard', compact('pesananHariIni', 'sedangDiproses', 'selesaiHariIni', 'menungguBayar', 'pesananTerbaru', 'daftar_layanan'));
    }

    public function adminRiwayat(\Illuminate\Http\Request $request)
    {
        $query = $this->buildAdminRiwayatQuery($request);
        $riwayatPesanan = $query->latest('updated_at')->paginate(5)->withQueryString(); 

        $totalPesanan = \App\Models\Pesanan::where('status', 'Selesai')->count();
        $totalPendapatan = \App\Models\Pesanan::where('status', 'Selesai')->sum('total_harga');
        $rataBerat = \App\Models\Pesanan::where('status', 'Selesai')->avg('berat');

        return view('admin.riwayat', compact('riwayatPesanan', 'totalPesanan', 'totalPendapatan', 'rataBerat'));
    }

    public function adminRiwayatExport(\Illuminate\Http\Request $request)
    {
        $pesananList = $this->buildAdminRiwayatQuery($request)
            ->latest('updated_at')
            ->get();

        $csvRows = [[
            'ID Pesanan',
            'Tanggal Selesai',
            'Pelanggan',
            'Layanan',
            'Berat (kg)',
            'Total Harga',
            'Status',
        ]];

        foreach ($pesananList as $pesanan) {
            $tglSelesai = $pesanan->updated_at ? \Carbon\Carbon::parse($pesanan->updated_at)->format('Y-m-d H:i:s') : '-';
            $csvRows[] = [
                '#WS-' . ($pesanan->created_at ? $pesanan->created_at->format('Y') : now()->format('Y')) . '-' . str_pad($pesanan->id_pesanan ?? $pesanan->id, 3, '0', STR_PAD_LEFT),
                $tglSelesai,
                $pesanan->pelanggan->nama ?? 'Unknown',
                $pesanan->layanan->nama_layanan ?? 'N/A',
                number_format($pesanan->berat ?? 0, 1, ',', '.'),
                'Rp ' . number_format($pesanan->total_harga ?? 0, 0, ',', '.'),
                $pesanan->status,
            ];
        }

        $csv = '';
        foreach ($csvRows as $row) {
            $escaped = array_map(function ($value) {
                return '"' . str_replace('"', '""', $value) . '"';
            }, $row);
            $csv .= implode(',', $escaped) . "\r\n";
        }

        $fileName = 'riwayat-pesanan-' . now()->format('Y-m-d') . '.csv';

        return response($csv, 200, [
            'Content-Type' => 'text/csv; charset=UTF-8',
            'Content-Disposition' => "attachment; filename={$fileName}",
        ]);
    }

    private function buildAdminRiwayatQuery(\Illuminate\Http\Request $request)
    {
        $query = \App\Models\Pesanan::with(['pelanggan', 'layanan'])
                  ->whereIn('status', ['Selesai', 'Batal', 'Dibatalkan']);

        if ($request->filled('cari')) {
            $cari = $request->cari;
            $query->where(function ($sub) use ($cari) {
                $sub->whereHas('pelanggan', function ($q) use ($cari) {
                    $q->where('nama', 'like', "%{$cari}%");
                })
                ->orWhere('id_pesanan', 'like', "%{$cari}%");
            });
        }

        if ($request->filled('filter_status') && in_array($request->filter_status, ['Selesai', 'Batal', 'Dibatalkan'])) {
            $query->where('status', $request->filter_status);
        }

        if ($request->filled('bulan') && $request->bulan === 'ini') {
            $query->whereYear('updated_at', now()->year)
                  ->whereMonth('updated_at', now()->month);
        }

        return $query;
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

        // Jika berat diubah, rekalkulasi total_harga berdasarkan layanan + ongkir flat
        $updateData = [
            'id_kurir' => $request->id_kurir ?? $pesanan->id_kurir,
            'berat' => $request->berat ?? $pesanan->berat,
            'status' => $request->status ?? $pesanan->status,
        ];

        if ($request->filled('berat')) {
            $layanan = Layanan::find($pesanan->id_layanan);
            $hargaPerKg = $layanan->harga_per_kg ?? 0;
            $ongkir = $this->getTarifOngkir();
            $totalHarga = intval($hargaPerKg * $request->berat) + intval($ongkir);
            $updateData['total_harga'] = $totalHarga;
        }

        $pesanan->update($updateData);

        return back()->with('success', 'Update berhasil!');
    }

    public function storeManual(Request $request)
    {
        $request->validate([
            'nama_pelanggan' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'no_hp' => 'required|string|max:15',
            'alamat' => 'required|string|max:255',
            'id_layanan' => 'required|exists:layanans,id_layanan',
            'berat' => 'required|numeric|min:0.1',
        ]);

        $pelanggan = Pelanggan::where('email', $request->email)
            ->orWhere('no_hp', $request->no_hp)
            ->first();

        if (! $pelanggan) {
            $pelanggan = Pelanggan::create([
                'nama' => $request->nama_pelanggan,
                'email' => $request->email,
                'password' => Hash::make(Str::random(12)),
                'no_hp' => $request->no_hp,
                'alamat' => $request->alamat,
            ]);
        }

        $layanan = Layanan::findOrFail($request->id_layanan);
        $totalHarga = $layanan->harga_per_kg * $request->berat;
        $ongkir = 5000; // default flat ongkir (pickup-delivery)
        $totalHarga += intval($ongkir);

        Pesanan::create([
            'id_pelanggan' => $pelanggan->id_pelanggan,
            'id_layanan' => $layanan->id_layanan,
            'status' => 'menunggu_pickup',
            'berat' => $request->berat,
            'total_harga' => $totalHarga,
            'tanggal_pesan' => now(),
            'catatan' => $request->input('catatan'),
        ]);

        return back()->with('success', 'Pesanan manual berhasil dibuat!');
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

    public function pelangganProfil()
    {
        $pelanggan = auth('pelanggan')->user();
        return view('pelanggan.profil', compact('pelanggan'));
    }

    public function pelangganProfilEdit()
    {
        $pelanggan = auth('pelanggan')->user();
        return view('pelanggan.edit-profil', compact('pelanggan'));
    }

    public function pelangganNotifikasi()
    {
        $pelangganId = auth('pelanggan')->id();
        $pesanans = Pesanan::where('id_pelanggan', $pelangganId)
                    ->with('layanan')
                    ->latest('updated_at')
                    ->take(10)
                    ->get();

        $notifications = $pesanans->map(function ($p) {
            return (object) [
                'id' => $p->id_pesanan ?? $p->id,
                'title' => 'Pesanan #' . ($p->id_pesanan ?? $p->id),
                'message' => 'Status: ' . ucfirst($p->status) . ($p->layanan ? ' — ' . $p->layanan->nama_layanan : ''),
                'time' => $p->updated_at,
                'link' => route('pelanggan.riwayat'),
            ];
        });

        return view('pelanggan.notifikasi', compact('notifications'));
    }

    public function pelangganUbahPassword()
    {
        $pelanggan = auth('pelanggan')->user();
        return view('pelanggan.ubah-password', compact('pelanggan'));
    }

    public function pelangganUpdatePassword(Request $request)
    {
        $pelanggan = auth('pelanggan')->user();

        $request->validate([
            'current_password' => 'required',
            'password' => 'required|string|min:8|confirmed',
        ]);

        if (! Hash::check($request->current_password, $pelanggan->password)) {
            return back()->withErrors(['current_password' => 'Password saat ini tidak cocok.']);
        }

        $pelanggan->password = Hash::make($request->password);
        $pelanggan->save();

        return redirect()->route('pelanggan.profil')->with('success', 'Password berhasil diperbarui.');
    }

    public function pelangganBantuan()
    {
        $admins = \App\Models\Admin::select('id_admin', 'nama', 'email', 'username')->get();
        return view('pelanggan.bantuan', compact('admins'));
    }

    public function pelangganStatus($id = null)
    {
        $pesanan = null;
        $step = 0;

        if ($id) {
            $pesanan = Pesanan::where('id_pesanan', $id)
                ->where('id_pelanggan', auth('pelanggan')->id())
                ->with(['layanan', 'kurir'])
                ->firstOrFail();
        } else {
            $pesanan = Pesanan::where('id_pelanggan', auth('pelanggan')->id())
                ->with(['layanan', 'kurir'])
                ->latest('created_at')
                ->first();
        }

        if ($pesanan) {
            if (in_array($pesanan->status, ['menunggu_bayar', 'menunggu_konfirmasi'])) {
                $step = 0;
            } elseif ($pesanan->status === 'menunggu_pickup') {
                $step = 1;
            } elseif ($pesanan->status === 'menunggu_timbang') {
                $step = 2;
            } elseif ($pesanan->status === 'proses') {
                $step = 3;
            } elseif ($pesanan->status === 'delivery') {
                $step = 4;
            } elseif ($pesanan->status === 'selesai') {
                $step = 5;
            }
        }

        return view('pelanggan.status-pesanan', compact('pesanan', 'step'));
    }

    public function pelangganProfilUpdate(Request $request)
    {
        $pelanggan = auth('pelanggan')->user();

        $request->validate([
            'nama' => 'required|string|max:255',
            'username' => 'nullable|string|max:50|unique:pelanggans,username,' . ($pelanggan->id_pelanggan ?? 'NULL') . ',id_pelanggan',
            'email' => 'required|email|max:255|unique:pelanggans,email,' . ($pelanggan->id_pelanggan ?? 'NULL') . ',id_pelanggan',
            'no_hp' => 'nullable|string|max:15',
            'alamat' => 'nullable|string|max:255',
        ]);

        $pelanggan->update([
            'username' => $request->username,
            'nama' => $request->nama,
            'email' => $request->email,
            'no_hp' => $request->no_hp,
            'alamat' => $request->alamat,
        ]);

        return redirect()->route('pelanggan.profil')->with('success', 'Profil berhasil diperbarui.');
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_layanan' => 'required|exists:layanans,id_layanan',
            'alamat' => 'required|string|max:255',
            'berat' => 'required|numeric|min:0.1',
        ]);

        $layanan = Layanan::findOrFail($request->id_layanan);
        $ongkir = $this->getTarifOngkir();
        $totalHarga = intval($layanan->harga_per_kg * $request->berat) + intval($ongkir);

        $pesanan = Pesanan::create([
            'id_pelanggan' => auth('pelanggan')->id(),
            'id_layanan' => $request->id_layanan,
            'alamat' => $request->alamat,
            'berat' => $request->berat,
            'status' => 'menunggu_pickup',
            'total_harga' => $totalHarga,
            'tanggal_pesan' => now(),
        ]);

        return redirect()->route('pelanggan.status', $pesanan->id_pesanan ?? $pesanan->id)
                         ->with('success', 'Pesanan dibuat! Kurir akan segera meluncur. Pantau status pesanan.');
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
            ->whereIn('status', ['selesai', 'menunggu_timbang'])
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
            ->whereIn('status', ['selesai', 'menunggu_timbang'])
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

    private function getTarifOngkir()
    {
        $path = storage_path('app/settings.json');
        if (!file_exists($path)) return 5000;
        $json = file_get_contents($path);
        $data = json_decode($json, true);
        if (is_array($data) && isset($data['tarif_ongkir'])) {
            return intval($data['tarif_ongkir']);
        }
        return 5000;
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