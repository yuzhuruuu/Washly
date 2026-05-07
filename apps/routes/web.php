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
// AREA PELANGGAN (User Biasa)
// ==========================================
Route::middleware(['auth:pelanggan'])->group(function () {
    
    Route::get('/dashboard', [PesananController::class, 'index'])->name('dashboard');

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
});


// ==========================================
// AREA KURIR (Fitur Baru Washly!)
// ==========================================
Route::middleware(['auth:kurir'])->prefix('kurir')->group(function () {
    Route::get('/dashboard', function() {
        return "Halo Kurir " . auth('kurir')->user()->nama;
    })->name('kurir.dashboard');
    
    // Nanti bisa tambah route jemput/antar barang di sini
});

// Hapus require auth.php kalau kamu tidak pakai Breeze/Jetstream bawaan lagi
// require __DIR__.'/auth.php';

Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);