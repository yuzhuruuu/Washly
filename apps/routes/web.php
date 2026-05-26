<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PesananController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\PasswordController;

// ==========================================
// 1. GLOBAL & AUTHENTICATION ROUTES
// ==========================================
Route::get('/', function () {
    return view('welcome');
});

// Login & Logout
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Register
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::get('/register-address', function () {
    return view('auth.register-address'); 
})->name('register.address');


// ==========================================
// 2. AREA JALUR TIKUS FE ASHA 💅 (Mockup UI)
// ==========================================

// --- FE Pelanggan ---
Route::get('/dashboard/pelanggan', function () { return view('pelanggan.dashboard'); });
Route::get('/layanan/pesan', function () { return view('pelanggan.pesanan-baru'); });
Route::get('/pembayaran/demo', function () { return view('pelanggan.pembayaran'); });
Route::get('/pesanan/status', function () { return view('pelanggan.status-pesanan'); });
Route::get('/profil', function () { return view('pelanggan.profil'); });
Route::get('/riwayat', function () { return view('pelanggan.riwayat'); });

// --- FE Admin ---
Route::prefix('dashboard/admin')->group(function () {
    Route::get('/', function () { return view('admin.dashboard'); });
    Route::get('/pesanan', function () { return view('admin.kelola-pesanan'); });
    Route::get('/pesanan/detail', function () { return view('admin.detail-pesanan'); });
    Route::get('/pembayaran', function () { return view('admin.pembayaran'); });
    Route::get('/kurir', function () { return view('admin.kurir'); });
    Route::get('/riwayat', function () { return view('admin.riwayat'); });
    Route::get('/pengaturan', function () { return view('admin.pengaturan'); });
});

// --- FE Kurir ---
Route::prefix('dashboard/kurir')->group(function () {
    Route::get('/', function () { return view('kurir.dashboard'); });
    Route::get('/profil', function () { return view('kurir.profil'); });
    Route::get('/riwayat', function () { return view('kurir.riwayat'); });
    Route::get('/pengaturan', function () { return view('kurir.pengaturan'); });
});


// ==========================================
// 3. BACKEND ROUTES - PELANGGAN
// ==========================================
Route::middleware(['auth:pelanggan'])->group(function () {
    Route::get('/dashboard', [PesananController::class, 'pelangganIndex'])->name('dashboard');

    // Manajemen Pesanan & Pembayaran
    Route::post('/pesan-laundry', [PesananController::class, 'store'])->name('pesanan.store');
    Route::get('/pembayaran/{id}', [PembayaranController::class, 'create'])->name('pembayaran.create');
    Route::post('/pembayaran', [PembayaranController::class, 'store'])->name('pembayaran.store');
    Route::post('/pesanan/upload-bayar/{id}', [PesananController::class, 'uploadPembayaran'])->name('pelanggan.upload.pembayaran');

    // Profil Pelanggan
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::put('/password', [PasswordController::class, 'update'])->name('password.update');
});


// ==========================================
// 4. BACKEND ROUTES - ADMIN
// ==========================================
Route::middleware(['auth:admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [PesananController::class, 'adminIndex'])->name('admin.dashboard');

    // Manajemen Pesanan & Layanan (Update dari Temenmu)
    Route::patch('/pesanan/{id}/timbang', [PesananController::class, 'inputTimbangan'])->name('pesanan.updateTimbangan');
    Route::patch('/pesanan/{id}/update-status', [PesananController::class, 'updateStatus'])->name('pesanan.updateStatus');
    Route::patch('/pesanan/{id}/update', [PesananController::class, 'adminUpdatePesanan'])->name('admin.pesanan.update');
    Route::post('/pesanan/manual', [PesananController::class, 'storeManual'])->name('pesanan.storeManual');
    Route::patch('/layanan/{id}/update', [AdminController::class, 'updateLayanan'])->name('admin.layanan.update');

    // Konfirmasi Bayar & Kurir
    Route::patch('/pembayaran/{id}/konfirmasi', [PembayaranController::class, 'konfirmasi'])->name('pembayaran.konfirmasi');
    Route::post('/kurir/store', [AdminController::class, 'storeKurir'])->name('admin.kurir.store');
});


// ==========================================
// 5. BACKEND ROUTES - KURIR
// ==========================================
Route::middleware(['auth:kurir'])->prefix('kurir')->group(function () {
    // Dashboard & History (Update dari Temenmu)
    Route::get('/dashboard', [PesananController::class, 'kurirIndex'])->name('kurir.dashboard');
    Route::get('/history', [PesananController::class, 'kurirHistory'])->name('kurir.history');
    
    // Profile & Settings Kurir (Update dari Temenmu)
    Route::get('/profile', [ProfileController::class, 'editKurirProfile'])->name('kurir.profile.edit');
    Route::patch('/profile', [ProfileController::class, 'updateKurirProfile'])->name('kurir.profile.update');
    Route::get('/settings', [ProfileController::class, 'editKurirSettings'])->name('kurir.settings.edit');
    Route::patch('/settings', [ProfileController::class, 'updateKurirSettings'])->name('kurir.settings.update');
    Route::put('/settings/password', [PasswordController::class, 'update'])->name('kurir.settings.password.update');
    
    // Penyelesaian Tugas
    Route::post('/tugas/{id}/selesaikan', [PesananController::class, 'kurirSelesaikanTugas'])->name('kurir.tugas.selesai');
});