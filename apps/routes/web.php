<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PesananController;
use App\Http\Controllers\AdminController;

// 1. PUBLIC ROUTES
Route::get('/', function () { return view('welcome'); });
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

// 2. BACKEND ROUTES - PELANGGAN
Route::middleware(['auth:pelanggan'])->prefix('dashboard/pelanggan')->group(function () {
    Route::get('/', [PesananController::class, 'pelangganIndex'])->name('pelanggan.dashboard');
    
    // PENTING: Panggil Controller biar data layanannya muncul!
    Route::get('/pesanan-baru', [PesananController::class, 'createPesanan'])->name('pelanggan.pesanan.baru');
    
    Route::get('/riwayat', [PesananController::class, 'pelangganRiwayat'])->name('pelanggan.riwayat');
    Route::post('/pesan-laundry', [PesananController::class, 'store'])->name('pesanan.store');
    Route::post('/pesanan/upload-bayar/{id}', [PesananController::class, 'uploadPembayaran'])->name('pelanggan.upload.pembayaran');
});

// 3. BACKEND ROUTES - ADMIN
Route::middleware(['auth:admin'])->prefix('dashboard/admin')->group(function () {
    Route::get('/', [PesananController::class, 'adminIndex'])->name('admin.dashboard');
    Route::get('/pesanan', [PesananController::class, 'kelolaPesanan'])->name('admin.pesanan.kelola');
    Route::patch('/pesanan/{id}/update', [PesananController::class, 'adminUpdatePesanan'])->name('admin.pesanan.update');
    Route::get('/kurir', [AdminController::class, 'indexKurir'])->name('admin.kurir');
    Route::post('/kurir/store', [AdminController::class, 'storeKurir'])->name('admin.kurir.store');
});

// 4. BACKEND ROUTES - KURIR
Route::middleware(['auth:kurir'])->prefix('dashboard/kurir')->group(function () {
    Route::get('/', [PesananController::class, 'kurirIndex'])->name('kurir.dashboard');
    Route::get('/riwayat', [PesananController::class, 'kurirHistory'])->name('kurir.history');
    Route::patch('/tugas/{id}/selesaikan', [PesananController::class, 'kurirSelesaikanTugas'])->name('kurir.tugas.selesai');
});