# Washly - Laundry Booking System (Web-Based)

## Deskripsi Proyek

**Washly** adalah aplikasi berbasis web yang dirancang untuk membantu digitalisasi layanan laundry UMKM. Sistem ini memungkinkan pelanggan melakukan pemesanan layanan laundry secara online, mempermudah pengelolaan operasional oleh admin, serta mengatur distribusi tugas penjemputan dan pengantaran oleh kurir secara efisien.

---

## Tujuan

* Mempermudah proses booking laundry tanpa harus manual (chat/telepon).
* Mengurangi kesalahan pencatatan melalui sistem database terpusat.
* Memberikan transparansi status pesanan kepada pelanggan secara real-time.
* Mendukung digitalisasi UMKM di bidang jasa laundry agar lebih efisien dan modern.

---

## Tim Pengembang

Proyek ini dikembangkan oleh:

* **Ananda Khairu A**
  📬 [anandakhairu3108@students.unnes.ac.id](mailto:anandakhairu3108@students.unnes.ac.id)

* **Annisa Yusri N R**
  📬 [yusriannisa@students.unnes.ac.id](mailto:yusriannisa@students.unnes.ac.id)

* **Fathimah Shaffa A**
  📬 [shaffaftm@students.unnes.ac.id](mailto:shaffaftm@students.unnes.ac.id)

---

## Fitur Utama

### User (Pelanggan)

* Registrasi dan login akun.
* Melakukan booking laundry (jenis layanan, estimasi berat, alamat).
* Upload bukti pembayaran.
* Melihat status pesanan dan riwayat transaksi.

### Admin (Owner)

* Dashboard monitoring operasional.
* Manajemen layanan (CRUD paket & harga).
* Mengelola pesanan masuk.
* Menugaskan kurir untuk pickup & delivery.

### Kurir

* Menerima tugas penjemputan dan pengantaran.
* Update status pekerjaan (pickup/delivery selesai).

---

## Alur Sistem (Workflow)

1. **Pemesanan:** Pelanggan melakukan booking melalui web.
2. **Penjemputan:** Admin assign kurir → kurir pickup → status “Dipickup”.
3. **Proses Laundry:** Validasi → cuci → setrika → status “Selesai”.
4. **Pembayaran & Pengiriman:** Upload bukti → verifikasi → kurir delivery.

---

## Modul Aplikasi

* **Autentikasi:** Multi-role (Admin, Pelanggan, Kurir).
* **Transaksi:** Pengelolaan pesanan & pembayaran.
* **Distribusi:** Tracking tugas kurir.

---

## Struktur Database

* `admins` – data admin
* `pelanggans` – data pelanggan
* `kurirs` – data kurir
* `layanans` – paket & harga
* `pesanans` – transaksi utama
* `pengirimans` – log pengiriman
* `pembayarans` – data pembayaran

---

## Teknologi

* **Frontend:** HTML, CSS, JavaScript, Bootstrap / Tailwind
* **Bundler:** Vite
* **Backend:** PHP (Laravel)
* **Database:** MySQL / MariaDB
* **Email:** SMTP Gmail
* **Hosting:** http://washly.lovestoblog.com

---

## Cara Menjalankan (Local Development)

### 1. Clone Repository

```bash
git clone https://github.com/yuzhuruuu/Washly/
```

### 2. Masuk Folder

```bash
cd Washly/apps
```

### 3. Install Dependency Backend

```bash
composer install
```

### 4. Install Dependency Frontend

```bash
npm install
```

### 5. Setup Environment

```bash
cp .env.example .env
```

Sesuaikan konfigurasi database & email di file `.env`.

### 6. Generate Key

```bash
php artisan key:generate
```

### 7. Migrasi & Seeder

```bash
php artisan migrate:fresh --seed
```

### 8. Jalankan Vite

```bash
npm run dev
```

### 9. Jalankan Server

```bash
php artisan serve
```

Akses di browser:

```
http://127.0.0.1:8000
```

---

## ✨ Penutup

Washly hadir sebagai solusi digital untuk meningkatkan efisiensi dan profesionalitas layanan laundry UMKM melalui sistem yang terintegrasi, mudah digunakan, dan scalable.
