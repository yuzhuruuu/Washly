<?php

use App\Http\Controllers\PesananController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

// --- Halaman Utama (Public) ---
Route::get('/', function () {
    return view('welcome');
});

// --- Authentication Routes ---
// Kita buat manual karena kita pakai Multi-Auth Custom
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// ==========================================
// AREA JALUR TIKUS FE ASHA 💅 (Taruh di sini posisinya!)
// ==========================================
Route::get('/dashboard/pelanggan', function () {
    return view('pelanggan.dashboard'); 
});
Route::get('/dashboard/admin', function () {
    return view('admin.dashboard'); 
});
Route::get('/dashboard/kurir', function () {
    return view('kurir.dashboard');
});
Route::get('/layanan/pesan', function () {
    return view('pelanggan.pesanan-baru');
});
Route::get('/pembayaran/demo', function () {
    return view('pelanggan.pembayaran');
});
Route::get('/pesanan/status', function () {
    return view('pelanggan.status-pesanan');
});


// ==========================================
// AREA PELANGGAN (User Biasa)
// ==========================================
Route::middleware(['auth:pelanggan'])->group(function () {
    
    Route::get('/dashboard', [PesananController::class, 'pelangganIndex'])->name('dashboard');

    // Manajemen Pesanan
    Route::post('/pesan-laundry', [PesananController::class, 'store'])->name('pesanan.store');

    // Manajemen Pembayaran
    Route::get('/pembayaran/{id}', [PembayaranController::class, 'create'])->name('pembayaran.create');
    Route::post('/pembayaran', [PembayaranController::class, 'store'])->name('pembayaran.store');

    // Profile (Opsional kalau mau tetap ada)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update'); // <--- INI KUNCINYA
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::put('/password', [App\Http\Controllers\Auth\PasswordController::class, 'update'])->name('password.update');
});


// ==========================================
// AREA ADMIN
// ==========================================
Route::middleware(['auth:admin'])->prefix('admin')->group(function () {
    
    Route::get('/dashboard', [PesananController::class, 'adminIndex'])->name('admin.dashboard');

    // 1. INPUT TIMBANGAN
    Route::patch('/pesanan/{id}/timbang', [PesananController::class, 'inputTimbangan'])
        ->name('pesanan.updateTimbangan');

    // 2. KONFIRMASI BAYAR (Validasi bukti transfer)
    Route::patch('/pembayaran/{id}/konfirmasi', [PembayaranController::class, 'konfirmasi'])
        ->name('pembayaran.konfirmasi');

    // 3. UPDATE STATUS (Alur: Cuci -> Selesai)
    Route::patch('/pesanan/{id}/update-status', [PesananController::class, 'updateStatus'])
        ->name('pesanan.updateStatus');

    // Rute untuk simpan perubahan berat dan kurir
    Route::patch('/pesanan/{id}/update', [PesananController::class, 'adminUpdatePesanan'])->name('admin.pesanan.update');

    Route::post('/kurir/store', [App\Http\Controllers\AdminController::class, 'storeKurir'])->name('admin.kurir.store');

    Route::post('/admin/pesanan/manual', [App\Http\Controllers\PesananController::class, 'storeManual'])->name('pesanan.storeManual');
});


// ==========================================
// AREA KURIR
// ==========================================
Route::middleware(['auth:kurir'])->prefix('kurir')->group(function () {
    // Pastikan ini mengarah ke folder kurir.dashboard
    Route::get('/dashboard', [PesananController::class, 'kurirIndex'])->name('kurir.dashboard');

    Route::post('/kurir/tugas/{id}/selesaikan', [App\Http\Controllers\PesananController::class, 'kurirSelesaikanTugas'])->name('kurir.tugas.selesai');
});

Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::get('/register-address', function () {
    return view('auth.register-address'); // Sesuaikan nama folder kalau beda, misal cuma 'register-address'
})->name('register.address');
Route::post('/pesanan/upload-bayar/{id}', [App\Http\Controllers\PesananController::class, 'uploadPembayaran'])->name('pelanggan.upload.pembayaran');

// Route::get('/dashboard/pelanggan', [PelangganController::class, 'index']);
Route::get('/dashboard/admin', [AdminController::class, 'index']);
Route::get('/dashboard/kurir', [KurirController::class, 'index']);

