-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 29, 2026 at 02:38 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `washly_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id_admin` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id_admin`, `nama`, `username`, `email`, `password`, `created_at`, `updated_at`) VALUES
(1, 'Admin Washly', 'admin_washly', 'admin@washly.com', '$2y$12$Xjp7RrJ918dDxJ6HdwJ3OuWDjziJ5Mv.sR9rJVvs8DOJmau8tChuS', '2026-05-11 09:03:58', '2026-05-28 21:18:44');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kurirs`
--

CREATE TABLE `kurirs` (
  `id_kurir` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) NOT NULL,
  `no_hp` varchar(255) NOT NULL,
  `notif_tugas` tinyint(1) NOT NULL DEFAULT 1,
  `notif_pesan` tinyint(1) NOT NULL DEFAULT 1,
  `notif_promo` tinyint(1) NOT NULL DEFAULT 0,
  `status` enum('aktif','nonaktif') NOT NULL DEFAULT 'aktif',
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kurirs`
--

INSERT INTO `kurirs` (`id_kurir`, `nama`, `no_hp`, `notif_tugas`, `notif_pesan`, `notif_promo`, `status`, `username`, `password`, `created_at`, `updated_at`) VALUES
(1, 'Budi Kurir', '08987654322', 1, 1, 0, 'aktif', 'budi_washly', '$2y$12$YIhmAMJHgqo20POXrHvu7u08.axmwNeVPHhNboeZA7m8TQ9QjbtTS', '2026-05-11 09:03:59', '2026-05-28 08:23:38'),
(2, 'Abel', '0987654321', 1, 1, 0, 'aktif', 'abel_kurir', '$2y$12$iNyS2leytJkSj28LsWLKau4uIk5qSGzvtzs5/2Ppw9YLSmidGUmLm', '2026-05-12 05:40:32', '2026-05-12 05:40:32'),
(3, 'Shawn Mendes', '0858999999', 1, 1, 0, 'aktif', 'sm123', '$2y$12$U.DL/Yp2NNSssoXVf2DDi.Ay5ZpOy9V.2mr497NaYI8vHOBWvpMsq', '2026-05-19 06:00:58', '2026-05-19 06:00:58'),
(4, 'Louis Tom', '089635876114', 1, 1, 0, 'aktif', 'lulu123', '$2y$12$eejGFM/0gHFzjetvMFXYNugz.Znaq8uU.zmgDEkvmU/Ex7U6jKx0C', '2026-05-28 06:00:42', '2026-05-28 06:00:42');

-- --------------------------------------------------------

--
-- Table structure for table `layanans`
--

CREATE TABLE `layanans` (
  `id_layanan` bigint(20) UNSIGNED NOT NULL,
  `nama_layanan` varchar(255) NOT NULL,
  `harga_per_kg` decimal(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `layanans`
--

INSERT INTO `layanans` (`id_layanan`, `nama_layanan`, `harga_per_kg`, `created_at`, `updated_at`) VALUES
(1, 'Cuci Saja', 7000.00, '2026-05-11 09:03:58', '2026-05-28 21:18:45'),
(2, 'Setrika Saja', 5000.00, '2026-05-11 09:03:58', '2026-05-28 21:18:45'),
(3, 'Cuci + Setrika', 15000.00, '2026-05-11 09:03:58', '2026-05-28 21:18:45');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000001_create_cache_table', 1),
(2, '0001_01_01_000002_create_jobs_table', 1),
(3, '2026_05_07_154257_create_pelanggans_table', 1),
(4, '2026_05_07_154406_create_kurirs_table', 1),
(5, '2026_05_07_154617_create_admins_table', 1),
(6, '2026_05_07_154655_create_layanans_table', 1),
(7, '2026_05_07_154754_create_pesanans_table', 1),
(8, '2026_05_07_154829_create_pengirimans_table', 1),
(9, '2026_05_07_154914_create_pembayarans_table', 1),
(10, '2026_05_11_140629_rename_email_to_username_in_kurirs_table', 1),
(11, '2026_05_11_145410_add_id_kurir_to_pesanans_table', 1),
(12, '2026_05_12_115728_add_username_to_pelanggans_and_admins_table', 2),
(13, '2026_05_12_144346_add_bukti_bayar_to_pesanans_table', 3),
(14, '2026_05_12_150000_add_metode_pembayaran_to_pembayarans_table', 4),
(15, '2026_05_19_120000_add_notify_new_task_to_kurirs_table', 5),
(16, '2026_05_28_145203_add_notification_columns_to_kurirs_table', 6);

-- --------------------------------------------------------

--
-- Table structure for table `pelanggans`
--

CREATE TABLE `pelanggans` (
  `id_pelanggan` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `no_hp` varchar(255) NOT NULL,
  `alamat` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pelanggans`
--

INSERT INTO `pelanggans` (`id_pelanggan`, `nama`, `username`, `email`, `password`, `no_hp`, `alamat`, `created_at`, `updated_at`) VALUES
(1, 'Zayn Malik', NULL, 'javvad@gmail.com', '$2y$12$x2eSYMCcuK271mDw9aG1buWOvW0WqHxTLaBu3ON.rfImOhuoWOutO', '6281234567890', 'Banaran, Gunungpati, Semarang', '2026-05-11 09:03:58', '2026-05-11 09:03:58'),
(3, 'Justin Bieber', 'jb123', 'jb@pelanggan.com', '$2y$12$DOFC3XmqwFvLkFjd5AozZuspuWyu5AJ9dZ/dJnnSIl79.LFNToB6G', '6289602557435', 'Jl. Taman Siswa', '2026-05-18 22:19:36', '2026-05-18 22:19:36'),
(4, 'Shawn Mendes 1', 'sw123', 'pelanggan3@gmail.com', '$2y$12$RCBLmy6TTV6N6QEEVk/s9e0yPLuKhfwv48T9sMxcLe8Gzdy16H36e', '6289602557435', 'Gg. Manggis', '2026-05-28 05:30:35', '2026-05-29 05:20:46');

-- --------------------------------------------------------

--
-- Table structure for table `pembayarans`
--

CREATE TABLE `pembayarans` (
  `id_pembayaran` bigint(20) UNSIGNED NOT NULL,
  `id_pesanan` bigint(20) UNSIGNED NOT NULL,
  `tanggal_bayar` date DEFAULT NULL,
  `status_pembayaran` varchar(255) NOT NULL DEFAULT 'validasi',
  `metode_pembayaran` varchar(255) DEFAULT NULL,
  `bukti_bayar` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pembayarans`
--

INSERT INTO `pembayarans` (`id_pembayaran`, `id_pesanan`, `tanggal_bayar`, `status_pembayaran`, `metode_pembayaran`, `bukti_bayar`, `created_at`, `updated_at`) VALUES
(2, 1, NULL, 'validasi', NULL, 'bukti_bayar/GxAcEEkOTpvCIZHw4311lGvhbpQ5dqEP7ZTCwj2e.png', '2026-05-12 07:16:08', '2026-05-12 07:16:08'),
(3, 2, NULL, 'validasi', NULL, 'bukti_bayar/11aD76xIo2ogNluzc2HTMlzqA0dhHl5RnVhNIRxC.png', '2026-05-12 08:34:01', '2026-05-12 08:34:01'),
(4, 1, NULL, 'valid', 'ewalet_qris', 'bukti_bayar/SFjH5H0N8UizGFKvwyN6cvJTlyYlehUFzBRLOiK5.png', '2026-05-12 08:49:22', '2026-05-12 09:02:34'),
(5, 3, NULL, 'validasi', 'ewalet_qris', 'bukti_bayar/nBuVSXcEVvnQKnFuB3kVCq5TmaZZ6bmx7YtH5lex.png', '2026-05-19 00:24:27', '2026-05-19 00:24:27');

-- --------------------------------------------------------

--
-- Table structure for table `pengirimans`
--

CREATE TABLE `pengirimans` (
  `id_pengiriman` bigint(20) UNSIGNED NOT NULL,
  `id_pesanan` bigint(20) UNSIGNED NOT NULL,
  `id_kurir_pickup` bigint(20) UNSIGNED DEFAULT NULL,
  `id_kurir_antar` bigint(20) UNSIGNED DEFAULT NULL,
  `alamat_jemput` text NOT NULL,
  `alamat_antar` text NOT NULL,
  `status_pengiriman` enum('pending','dalam_proses','selesai') NOT NULL,
  `waktu_jemput` datetime NOT NULL,
  `waktu_antar` datetime NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pesanans`
--

CREATE TABLE `pesanans` (
  `id_pesanan` bigint(20) UNSIGNED NOT NULL,
  `id_layanan` bigint(20) UNSIGNED NOT NULL,
  `id_pelanggan` bigint(20) UNSIGNED NOT NULL,
  `id_kurir` bigint(20) UNSIGNED DEFAULT NULL,
  `tanggal_pesan` datetime NOT NULL,
  `berat` decimal(8,2) DEFAULT NULL,
  `total_harga` int(11) NOT NULL DEFAULT 0,
  `bukti_bayar` varchar(255) DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'menunggu_pickup',
  `catatan` text DEFAULT NULL,
  `tanggal_pickup` datetime DEFAULT NULL,
  `tanggal_selesai` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pesanans`
--

INSERT INTO `pesanans` (`id_pesanan`, `id_layanan`, `id_pelanggan`, `id_kurir`, `tanggal_pesan`, `berat`, `total_harga`, `bukti_bayar`, `status`, `catatan`, `tanggal_pickup`, `tanggal_selesai`, `created_at`, `updated_at`) VALUES
(1, 1, 1, NULL, '2026-05-11 16:04:57', 5.00, 40000, 'bukti_bayar/SFjH5H0N8UizGFKvwyN6cvJTlyYlehUFzBRLOiK5.png', 'selesai', NULL, NULL, NULL, '2026-05-11 09:04:57', '2026-05-28 08:55:42'),
(2, 2, 1, 1, '2026-05-12 14:25:57', 5.00, 25000, NULL, 'selesai', NULL, NULL, NULL, '2026-05-12 07:25:57', '2026-05-12 08:40:21'),
(3, 3, 3, NULL, '2026-05-19 05:23:33', 5.00, 80000, 'bukti_bayar/nBuVSXcEVvnQKnFuB3kVCq5TmaZZ6bmx7YtH5lex.png', 'proses', NULL, NULL, NULL, '2026-05-18 22:23:33', '2026-05-28 19:43:35'),
(4, 3, 4, 1, '2026-05-29 11:42:55', 4.00, 0, NULL, 'menunggu_timbang', NULL, NULL, NULL, '2026-05-29 04:42:55', '2026-05-29 05:25:16');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id_admin`),
  ADD UNIQUE KEY `admins_username_unique` (`username`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_expiration_index` (`expiration`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_locks_expiration_index` (`expiration`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kurirs`
--
ALTER TABLE `kurirs`
  ADD PRIMARY KEY (`id_kurir`);

--
-- Indexes for table `layanans`
--
ALTER TABLE `layanans`
  ADD PRIMARY KEY (`id_layanan`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pelanggans`
--
ALTER TABLE `pelanggans`
  ADD PRIMARY KEY (`id_pelanggan`),
  ADD UNIQUE KEY `pelanggans_username_unique` (`username`);

--
-- Indexes for table `pembayarans`
--
ALTER TABLE `pembayarans`
  ADD PRIMARY KEY (`id_pembayaran`),
  ADD KEY `pembayarans_id_pesanan_foreign` (`id_pesanan`);

--
-- Indexes for table `pengirimans`
--
ALTER TABLE `pengirimans`
  ADD PRIMARY KEY (`id_pengiriman`),
  ADD KEY `pengirimans_id_pesanan_foreign` (`id_pesanan`),
  ADD KEY `pengirimans_id_kurir_pickup_foreign` (`id_kurir_pickup`),
  ADD KEY `pengirimans_id_kurir_antar_foreign` (`id_kurir_antar`);

--
-- Indexes for table `pesanans`
--
ALTER TABLE `pesanans`
  ADD PRIMARY KEY (`id_pesanan`),
  ADD KEY `pesanans_id_layanan_foreign` (`id_layanan`),
  ADD KEY `pesanans_id_pelanggan_foreign` (`id_pelanggan`),
  ADD KEY `pesanans_id_kurir_foreign` (`id_kurir`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id_admin` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kurirs`
--
ALTER TABLE `kurirs`
  MODIFY `id_kurir` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `layanans`
--
ALTER TABLE `layanans`
  MODIFY `id_layanan` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `pelanggans`
--
ALTER TABLE `pelanggans`
  MODIFY `id_pelanggan` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `pembayarans`
--
ALTER TABLE `pembayarans`
  MODIFY `id_pembayaran` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `pengirimans`
--
ALTER TABLE `pengirimans`
  MODIFY `id_pengiriman` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pesanans`
--
ALTER TABLE `pesanans`
  MODIFY `id_pesanan` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `pembayarans`
--
ALTER TABLE `pembayarans`
  ADD CONSTRAINT `pembayarans_id_pesanan_foreign` FOREIGN KEY (`id_pesanan`) REFERENCES `pesanans` (`id_pesanan`) ON DELETE CASCADE;

--
-- Constraints for table `pengirimans`
--
ALTER TABLE `pengirimans`
  ADD CONSTRAINT `pengirimans_id_kurir_antar_foreign` FOREIGN KEY (`id_kurir_antar`) REFERENCES `kurirs` (`id_kurir`),
  ADD CONSTRAINT `pengirimans_id_kurir_pickup_foreign` FOREIGN KEY (`id_kurir_pickup`) REFERENCES `kurirs` (`id_kurir`),
  ADD CONSTRAINT `pengirimans_id_pesanan_foreign` FOREIGN KEY (`id_pesanan`) REFERENCES `pesanans` (`id_pesanan`);

--
-- Constraints for table `pesanans`
--
ALTER TABLE `pesanans`
  ADD CONSTRAINT `pesanans_id_kurir_foreign` FOREIGN KEY (`id_kurir`) REFERENCES `kurirs` (`id_kurir`) ON DELETE SET NULL,
  ADD CONSTRAINT `pesanans_id_layanan_foreign` FOREIGN KEY (`id_layanan`) REFERENCES `layanans` (`id_layanan`),
  ADD CONSTRAINT `pesanans_id_pelanggan_foreign` FOREIGN KEY (`id_pelanggan`) REFERENCES `pelanggans` (`id_pelanggan`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
