# 📋 Dokumentasi Controller Pelanggan - Washly

## 1️⃣ LOKASI CONTROLLER YANG MENANGANI PELANGGAN

### Folder Lokasi
```
apps/app/Http/Controllers/
```

### File-file Controller Terkait Pelanggan:

| File | Fungsi |
|------|--------|
| **PesananController.php** | **UTAMA** - Menangani semua operasi pelanggan (dashboard, pesanan, profil, status, notifikasi, dll) |
| **PembayaranController.php** | Menangani proses pembayaran pesanan pelanggan |
| **AuthController.php** | Menangani autentikasi (login/register pelanggan) |
| ProfileController.php | Untuk Kurir profile (bukan pelanggan) |
| AdminController.php | Untuk Admin dashboard |

---

## 2️⃣ METHOD DALAM PESANAN CONTROLLER UNTUK PELANGGAN

### Struktur & Alur Route Pelanggan

```
PREFIX: /dashboard/pelanggan
MIDDLEWARE: auth:pelanggan
CONTROLLER: PesananController
```

### Daftar Method Pelanggan

| Route | Method HTTP | Method Controller | Function | Data Yang Dikirim |
|-------|-------------|-------------------|----------|-------------------|
| `/` | GET | `pelangganIndex()` | Dashboard utama pelanggan | `daftar_layanan` (Layanan::all()), `semua_pesanan` (Pesanan milik user) |
| `/pesanan-baru` | GET | `createPesanan()` | Form buat pesanan baru | `daftar_layanan` |
| `/riwayat` | GET | `pelangganRiwayat()` | Lihat riwayat semua pesanan | `semua_pesanan` |
| `/profil` | GET | `pelangganProfil()` | Lihat data profil | `pelanggan` (user yang login) |
| `/profil/edit` | GET | `pelangganProfilEdit()` | Form edit profil | `pelanggan` (user yang login) |
| `/profil` | PATCH | `pelangganProfilUpdate()` | Update data profil | - (return ke route `pelanggan.profil`) |
| `/notifikasi` | GET | `pelangganNotifikasi()` | Lihat notifikasi pesanan | `notifications` (array of recent pesanan) |
| `/ubah-password` | GET | `pelangganUbahPassword()` | Form ubah password | `pelanggan` (user yang login) |
| `/ubah-password` | POST | `pelangganUpdatePassword()` | Update password | - (return ke route `pelanggan.profil`) |
| `/bantuan` | GET | `pelangganBantuan()` | Halaman bantuan/support | `admins` (Admin::all()) |
| `/syarat-ketentuan` | GET | View langsung | Halaman syarat & ketentuan | - (tidak perlu data) |
| `/status/{id?}` | GET | `pelangganStatus($id)` | Tracking status pesanan | `pesanan`, `step` (0-5 status pesanan) |
| `/pesan-laundry` | POST | `store()` | Create pesanan baru | - (redirect ke dashboard) |
| `/pembayaran/{id}/create` | GET | `PembayaranController::create()` | Form input pembayaran | Data dari PembayaranController |
| `/pembayaran` | POST | `PembayaranController::store()` | Submit pembayaran | - |
| `/pesanan/upload-bayar/{id}` | POST | `uploadPembayaran()` | Upload bukti bayar | - (return back) |

---

## 3️⃣ DATA YANG DIKIRIM KE BLADE VIEW

### a) **pelangganIndex()** → `pelanggan.dashboard`
```php
compact(
    'daftar_layanan',  // Collection Layanan
    'semua_pesanan'    // Collection Pesanan dengan relasi layanan & kurir
)
```

**Relasi Data:**
- `daftar_layanan`: Layanan::all()
- `semua_pesanan`: Pesanan dengan relationships ['layanan', 'kurir']
  - Field: id_pesanan, id_layanan, total_harga, status, dll
  - Relasi: layanan->nama_layanan, kurir->nama

---

### b) **createPesanan()** → `pelanggan.pesanan-baru`
```php
compact(
    'daftar_layanan'   // Collection Layanan
)
```

---

### c) **pelangganRiwayat()** → `pelanggan.riwayat`
```php
compact(
    'semua_pesanan'    // Collection Pesanan dengan relasi layanan & kurir
)
```

---

### d) **pelangganProfil()** → `pelanggan.profil`
```php
compact(
    'pelanggan'        // Auth user (Pelanggan model)
)
// Field: id_pelanggan, nama, email, no_hp, alamat, username, created_at, dll
```

---

### e) **pelangganProfilEdit()** → `pelanggan.edit-profil`
```php
compact(
    'pelanggan'        // Auth user (Pelanggan model)
)
```

---

### f) **pelangganNotifikasi()** → `pelanggan.notifikasi`
```php
compact(
    'notifications'    // Array of stdClass Object
)
// Setiap notification:
// - id: id pesanan
// - title: "Pesanan #ID"
// - message: "Status: ... — Layanan: ..."
// - time: updated_at timestamp
// - link: route('pelanggan.riwayat')
```

---

### g) **pelangganUbahPassword()** → `pelanggan.ubah-password`
```php
compact(
    'pelanggan'        // Auth user
)
```

---

### h) **pelangganBantuan()** → `pelanggan.bantuan`
```php
compact(
    'admins'           // Admin::select('id_admin', 'nama', 'email', 'username')->get()
)
```

---

### i) **pelangganStatus()** → `pelanggan.status-pesanan`
```php
compact(
    'pesanan',         // Pesanan model dengan relasi layanan & kurir (atau null)
    'step'             // Integer 0-5 (tahap tracking)
)
// step values:
// 0 = menunggu_bayar / menunggu_konfirmasi
// 1 = menunggu_pickup
// 2 = menunggu_timbang
// 3 = proses (cuci)
// 4 = delivery (pengiriman)
// 5 = selesai
```

---

## 4️⃣ ROUTES TERDAFTAR UNTUK PELANGGAN

### Full Route Definitions (dari `routes/web.php`)

```php
// Prefix: /dashboard/pelanggan
// Middleware: auth:pelanggan
// Controller: PesananController

Route::middleware(['auth:pelanggan'])->prefix('dashboard/pelanggan')->group(function () {
    // Dashboard & Pesanan
    Route::get('/', [PesananController::class, 'pelangganIndex'])
        ->name('pelanggan.dashboard');
    
    Route::get('/pesanan-baru', [PesananController::class, 'createPesanan'])
        ->name('pelanggan.pesanan.baru');
    
    Route::get('/riwayat', [PesananController::class, 'pelangganRiwayat'])
        ->name('pelanggan.riwayat');
    
    // Profil
    Route::get('/profil', [PesananController::class, 'pelangganProfil'])
        ->name('pelanggan.profil');
    
    Route::get('/profil/edit', [PesananController::class, 'pelangganProfilEdit'])
        ->name('pelanggan.profil.edit');
    
    Route::patch('/profil', [PesananController::class, 'pelangganProfilUpdate'])
        ->name('pelanggan.profil.update');
    
    // Notifikasi & Bantuan
    Route::get('/notifikasi', [PesananController::class, 'pelangganNotifikasi'])
        ->name('pelanggan.notifikasi');
    
    Route::get('/ubah-password', [PesananController::class, 'pelangganUbahPassword'])
        ->name('pelanggan.ubah-password');
    
    Route::post('/ubah-password', [PesananController::class, 'pelangganUpdatePassword'])
        ->name('pelanggan.ubah-password.update');
    
    Route::get('/bantuan', [PesananController::class, 'pelangganBantuan'])
        ->name('pelanggan.bantuan');
    
    Route::get('/syarat-ketentuan', function() { 
        return view('pelanggan.syarat'); 
    })->name('pelanggan.syarat');
    
    // Status & Pembayaran
    Route::get('/status/{id?}', [PesananController::class, 'pelangganStatus'])
        ->name('pelanggan.status');
    
    Route::post('/pesan-laundry', [PesananController::class, 'store'])
        ->name('pesanan.store');
    
    Route::get('/pembayaran/{id}/create', [PembayaranController::class, 'create'])
        ->name('pembayaran.create');
    
    Route::post('/pembayaran', [PembayaranController::class, 'store'])
        ->name('pembayaran.store');
    
    Route::post('/pesanan/upload-bayar/{id}', [PesananController::class, 'uploadPembayaran'])
        ->name('pelanggan.upload.pembayaran');
});
```

---

## 5️⃣ HALAMAN TENTANG-KAMI (Tentang Kami)

**Status:** ⚠️ **BELUM ADA ROUTE KHUSUS**

- **File View:** `resources/views/pelanggan/tentang-kami.blade.php` ✅ (exist)
- **Route:** Belum terdaftar di `routes/web.php`
- **Akses Saat Ini:** Melalui href `/preview-about` (tidak terdaftar)

**Rekomendasi:** 
Tambahkan route baru di `routes/web.php`:
```php
Route::get('/tentang-kami', function() { 
    return view('pelanggan.tentang-kami'); 
})->name('pelanggan.tentang-kami');
```

---

## 6️⃣ RINGKASAN HALAMAN PELANGGAN

### Daftar Halaman Lengkap:

| # | Halaman | File View | Route Name | Method | Status |
|---|---------|-----------|-----------|--------|--------|
| 1 | Dashboard | `dashboard.blade.php` | `pelanggan.dashboard` | GET / | ✅ |
| 2 | Pesanan Baru | `pesanan-baru.blade.php` | `pelanggan.pesanan.baru` | GET | ✅ |
| 3 | Riwayat Pesanan | `riwayat.blade.php` | `pelanggan.riwayat` | GET | ✅ |
| 4 | Profil | `profil.blade.php` | `pelanggan.profil` | GET | ✅ |
| 5 | Edit Profil | `edit-profil.blade.php` | `pelanggan.profil.edit` | GET | ✅ |
| 6 | Notifikasi | `notifikasi.blade.php` | `pelanggan.notifikasi` | GET | ✅ |
| 7 | Ubah Password | `ubah-password.blade.php` | `pelanggan.ubah-password` | GET | ✅ |
| 8 | Bantuan | `bantuan.blade.php` | `pelanggan.bantuan` | GET | ✅ |
| 9 | Syarat & Ketentuan | `syarat.blade.php` | `pelanggan.syarat` | GET | ✅ |
| 10 | Status Pesanan | `status-pesanan.blade.php` | `pelanggan.status` | GET | ✅ |
| 11 | **Tentang Kami** | `tentang-kami.blade.php` | - | - | ⚠️ (route missing) |
| 12 | Detail Pesanan | `detail_pesanan.blade.php` | - | - | ⚠️ (no route) |
| 13 | Pembayaran | `pembayaran.blade.php` | - | - | ⚠️ (no route) |

---

## 7️⃣ MODEL RELATIONSHIPS

### Pesanan Model
```
Pesanan 
  ├─ belongsTo(Pelanggan)      → pelanggan
  ├─ belongsTo(Layanan)        → layanan
  ├─ belongsTo(Kurir)          → kurir (nullable)
  └─ hasOne(Pembayaran)        → pembayaran
```

### Data Pesanan yang Relevan:
- `id_pesanan` / `id`
- `id_pelanggan`
- `id_layanan`
- `id_kurir` (nullable)
- `status` (menunggu_pickup, menunggu_timbang, proses, delivery, selesai, dll)
- `berat`
- `total_harga`
- `alamat`
- `tanggal_pesan`
- `bukti_bayar` (path file jika sudah upload)
- `catatan`
- `created_at`, `updated_at`

---

## 8️⃣ CONTROLLER FILES PATH

```
📁 apps/app/Http/Controllers/
├── 📄 PesananController.php          ← UTAMA untuk Pelanggan
├── 📄 PembayaranController.php       ← Pembayaran
├── 📄 AuthController.php             ← Login/Register
├── 📄 ProfileController.php          ← Kurir Profile
├── 📄 AdminController.php            ← Admin Dashboard
├── 📄 Controller.php                 ← Base Controller
└── 📁 Auth/                          ← Built-in Auth Controllers
    ├── AuthenticatedSessionController.php
    ├── ConfirmablePasswordController.php
    ├── EmailVerificationNotificationController.php
    ├── EmailVerificationPromptController.php
    ├── NewPasswordController.php
    ├── PasswordController.php
    ├── PasswordResetLinkController.php
    ├── RegisteredUserController.php
    └── VerifyEmailController.php
```

---

## 📌 CATATAN PENTING

1. **Tentang-Kami:** Route belum terdaftar, hanya ada view file
2. **Detail Pesanan & Pembayaran:** View ada tapi belum ada route terpisah
3. **Upload Bukti Bayar:** Disimpan di folder `storage/app/public/bukti_bayar/`
4. **Tahapan Status Pesanan:**
   - Menunggu Bayar → Menunggu Pickup → Menunggu Timbang → Proses Cuci → Delivery → Selesai
5. **Auth Guard:** Menggunakan `auth('pelanggan')` bukan `auth()`
6. **Base URL Pelanggan:** `/dashboard/pelanggan`

---

**Generated:** May 30, 2026
**Last Updated:** Dokumentasi controller pelanggan lengkap
