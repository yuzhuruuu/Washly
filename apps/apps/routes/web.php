<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PesananController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;

// 1. PUBLIC ROUTES
Route::get('/', function () { return view('welcome'); });
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/register-address', function () { return view('auth.register-address'); })->name('register.address');
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::get('/forgot-password', [PasswordResetLinkController::class, 'create'])
    ->name('password.request');

Route::post('/forgot-password', [PasswordResetLinkController::class, 'store'])
    ->name('password.email');

Route::get('/reset-password/{token}', [NewPasswordController::class, 'create'])
    ->name('password.reset');

Route::post('/reset-password', [NewPasswordController::class, 'store'])
    ->name('password.store');

// 2. BACKEND ROUTES - PELANGGAN
// 🔥 Penjaga pintu dikembalikan ke auth:pelanggan
Route::middleware(['auth:pelanggan'])->prefix('dashboard/pelanggan')->group(function () {
    Route::get('/', [PesananController::class, 'pelangganIndex'])->name('pelanggan.dashboard');
    Route::get('/pesanan-baru', [PesananController::class, 'createPesanan'])->name('pelanggan.pesanan.baru');
    Route::get('/riwayat', [PesananController::class, 'pelangganRiwayat'])->name('pelanggan.riwayat');
    Route::get('/profil', [PesananController::class, 'pelangganProfil'])->name('pelanggan.profil');
    Route::get('/profil/edit', [PesananController::class, 'pelangganProfilEdit'])->name('pelanggan.profil.edit');
    Route::patch('/profil', [PesananController::class, 'pelangganProfilUpdate'])->name('pelanggan.profil.update');
    // Profile helper pages
    Route::get('/notifikasi', [PesananController::class, 'pelangganNotifikasi'])->name('pelanggan.notifikasi');
    Route::get('/ubah-password', [PesananController::class, 'pelangganUbahPassword'])->name('pelanggan.ubah-password');
    Route::post('/ubah-password', [PesananController::class, 'pelangganUpdatePassword'])->name('pelanggan.ubah-password.update');
    Route::get('/bantuan', [PesananController::class, 'pelangganBantuan'])->name('pelanggan.bantuan');
    Route::get('/syarat-ketentuan', function() { return view('pelanggan.syarat'); })->name('pelanggan.syarat');
    Route::get('/status/{id?}', [PesananController::class, 'pelangganStatus'])->name('pelanggan.status');
    Route::post('/pesan-laundry', [PesananController::class, 'store'])->name('pesanan.store');
    Route::get('/pembayaran/{id}/create', [PembayaranController::class, 'create'])->name('pembayaran.create');
    Route::post('/pembayaran', [PembayaranController::class, 'store'])->name('pembayaran.store');
    Route::post('/pesanan/upload-bayar/{id}', [PesananController::class, 'uploadPembayaran'])->name('pelanggan.upload.pembayaran');
});

// 3. BACKEND ROUTES - ADMIN
// 🔥 Penjaga pintu dikembalikan ke auth:admin
Route::middleware(['auth:admin'])->prefix('dashboard/admin')->group(function () {
    Route::get('/', [PesananController::class, 'adminIndex'])->name('admin.dashboard');
    Route::get('/pesanan', [PesananController::class, 'kelolaPesanan'])->name('admin.pesanan.kelola');
    Route::get('/pesanan/{id}/detail', function ($id) {
        $pesanan = \App\Models\Pesanan::with(['pelanggan', 'layanan', 'kurir', 'pembayaran'])->findOrFail($id);
        $daftar_kurir = \App\Models\Kurir::all();
        return view('admin.detail-pesanan', compact('pesanan', 'daftar_kurir'));
    })->name('admin.pesanan.detail');
    Route::patch('/pesanan/{id}/update', [PesananController::class, 'adminUpdatePesanan'])->name('admin.pesanan.update');
    Route::post('/pesanan/store', [PesananController::class, 'storeManual'])->name('admin.pesanan.store');
    Route::get('/kurir', [AdminController::class, 'indexKurir'])->name('admin.kurir');
    Route::get('/kurir/export', [AdminController::class, 'exportKurir'])->name('admin.kurir.export');
    Route::get('/kurir/{id}/edit', [AdminController::class, 'editKurir'])->name('admin.kurir.edit');
    Route::patch('/kurir/{id}', [AdminController::class, 'updateKurir'])->name('admin.kurir.update');
    Route::delete('/kurir/{id}', [AdminController::class, 'destroyKurir'])->name('admin.kurir.destroy');
    Route::post('/kurir/store', [AdminController::class, 'storeKurir'])->name('admin.kurir.store');
    Route::get('/pembayaran', [PesananController::class, 'adminPembayaran'])->name('admin.pembayaran');
    Route::get('/riwayat', [PesananController::class, 'adminRiwayat'])->name('admin.riwayat');
    Route::get('/riwayat/export', [PesananController::class, 'adminRiwayatExport'])->name('admin.riwayat.export');
    Route::get('/pengaturan', [AdminController::class, 'pengaturan'])->name('admin.pengaturan');
    Route::post('/pengaturan', [AdminController::class, 'updatePengaturan'])->name('admin.pengaturan.update');
    Route::post('/layanan/store', [AdminController::class, 'storeLayanan'])->name('admin.layanan.store');
});

// 4. BACKEND ROUTES - KURIR
// 🔥 Penjaga pintu wajib auth:kurir (Plus rute sakti pengaturan anti-error method)
Route::middleware(['auth:kurir'])->prefix('dashboard/kurir')->group(function () {
    Route::get('/', [PesananController::class, 'kurirIndex'])->name('kurir.dashboard');
    Route::get('/riwayat', [PesananController::class, 'kurirRiwayat'])->name('kurir.riwayat');
    Route::patch('/tugas/{id}/selesaikan', [PesananController::class, 'kurirSelesaikanTugas'])->name('kurir.tugas.selesai');
    Route::get('/profil', [PesananController::class, 'kurirProfil'])->name('kurir.profil');
    Route::any('/pengaturan', [PesananController::class, 'kurirPengaturan'])->name('kurir.pengaturan');
    Route::any('/pengaturan/update', [PesananController::class, 'kurirUpdatePengaturan'])->name('kurir.update.pengaturan');
});

