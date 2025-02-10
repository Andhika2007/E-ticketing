-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Feb 10, 2025 at 04:56 AM
-- Server version: 8.0.30
-- PHP Version: 8.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lsp_eticketing`
--

-- --------------------------------------------------------

--
-- Table structure for table `bandaras`
--

CREATE TABLE `bandaras` (
  `id` bigint UNSIGNED NOT NULL,
  `id_bandara` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_bandara` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kota` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `negara` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bandaras`
--

INSERT INTO `bandaras` (`id`, `id_bandara`, `nama_bandara`, `kota`, `negara`, `created_at`, `updated_at`) VALUES
(1, 'GCK', 'Soeakrno Hatta', 'Banten', 'Indonesia', '2025-02-05 00:54:51', '2025-02-05 00:54:51'),
(2, 'ABC', 'Purnama', 'Bulan', 'Bimasakti', '2025-02-05 00:54:57', '2025-02-05 00:54:57'),
(3, 'GCKs', 'Tes Bandara', 'Hokaido', 'Irlandia', '2025-02-08 20:33:02', '2025-02-08 20:33:02');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jadwal`
--

CREATE TABLE `jadwal` (
  `id` bigint UNSIGNED NOT NULL,
  `no_penerbangan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_pesawat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `keberangkatan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tujuan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `boarding_time` time NOT NULL,
  `gerbang` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `harga` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jadwal`
--

INSERT INTO `jadwal` (`id`, `no_penerbangan`, `id_pesawat`, `keberangkatan`, `tujuan`, `date`, `boarding_time`, `gerbang`, `harga`, `created_at`, `updated_at`) VALUES
(2, '2', '1', 'ABC', 'ABC', '2025-02-06', '22:00:00', '1', 1, '2025-02-05 21:54:01', '2025-02-05 21:58:50'),
(3, 'GA-002', '2', 'GCK', 'GCKs', '2025-02-10', '10:33:00', 'A1', 3000000, '2025-02-08 20:33:27', '2025-02-08 20:33:27'),
(4, 'GA-001', '3', 'GCK', 'GCKs', '2025-02-10', '10:34:00', 'A1', 2000000, '2025-02-08 20:34:58', '2025-02-08 20:34:58');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `maskapais`
--

CREATE TABLE `maskapais` (
  `id` bigint UNSIGNED NOT NULL,
  `id_pesawat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_maskapai` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_pesawat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis_pesawat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jumlah_kursi` int NOT NULL,
  `kursi_perbaris` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `maskapais`
--

INSERT INTO `maskapais` (`id`, `id_pesawat`, `nama_maskapai`, `nama_pesawat`, `jenis_pesawat`, `jumlah_kursi`, `kursi_perbaris`, `created_at`, `updated_at`) VALUES
(1, '1', 'Garuda', 'Garuda', 'Jet', 12, 2, '2025-02-05 00:54:44', '2025-02-05 00:54:44'),
(2, '2', '2', '2', '2', 12, 2, '2025-02-08 20:31:09', '2025-02-08 20:31:09'),
(3, '3', 'Sriwijaya', 'aa', 'Jet', 12, 2, '2025-02-08 20:34:31', '2025-02-08 20:34:31');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_02_05_014607_create_maskapais_table', 1),
(5, '2025_02_05_015324_create_bandaras_table', 1),
(6, '2025_02_05_042557_create_jadwals_table', 1),
(7, '2025_02_05_043923_create_seats_table', 1),
(8, '2025_02_05_070058_create_pemesanans_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pemesanans`
--

CREATE TABLE `pemesanans` (
  `id` bigint UNSIGNED NOT NULL,
  `no_pemesanan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_penerbangan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bangku_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jumlah_penumpang` int NOT NULL,
  `pembayaran` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bukti_pembayaran` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status_pesanan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Pending',
  `user_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `total_harga` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pemesanans`
--

INSERT INTO `pemesanans` (`id`, `no_pemesanan`, `no_penerbangan`, `bangku_code`, `jumlah_penumpang`, `pembayaran`, `bukti_pembayaran`, `status_pesanan`, `user_id`, `created_at`, `updated_at`, `total_harga`) VALUES
(33, 'ORD-67a8d4e9aeb13', 'GA-001', '1A', 1, 'DANA', 'bukti_pembayaran/59AEmkqUbIFDbYaSRspbZfw5FESAfaJtb4UrQCuT.jpg', 'Pending', 3, '2025-02-09 09:16:41', '2025-02-09 09:16:41', 2000000),
(34, 'ORD-67a8d4f6eccbf', 'GA-001', '1B', 1, 'OVO', 'bukti_pembayaran/1qp4C3vgnuJNDTEQmaWKqFQ0fpmUkczUNCsMSz7p.jpg', 'Pending', 3, '2025-02-09 09:16:54', '2025-02-09 09:16:54', 2000000);

-- --------------------------------------------------------

--
-- Table structure for table `seats`
--

CREATE TABLE `seats` (
  `id` bigint UNSIGNED NOT NULL,
  `id_pesawat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bangku_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `seats`
--

INSERT INTO `seats` (`id`, `id_pesawat`, `bangku_code`, `created_at`, `updated_at`) VALUES
(1, '1', '1A', '2025-02-05 00:54:44', '2025-02-05 00:54:44'),
(2, '1', '1B', '2025-02-05 00:54:44', '2025-02-05 00:54:44'),
(3, '1', '2A', '2025-02-05 00:54:44', '2025-02-05 00:54:44'),
(4, '1', '2B', '2025-02-05 00:54:44', '2025-02-05 00:54:44'),
(5, '1', '3A', '2025-02-05 00:54:44', '2025-02-05 00:54:44'),
(6, '1', '3B', '2025-02-05 00:54:44', '2025-02-05 00:54:44'),
(7, '1', '4A', '2025-02-05 00:54:44', '2025-02-05 00:54:44'),
(8, '1', '4B', '2025-02-05 00:54:44', '2025-02-05 00:54:44'),
(9, '1', '5A', '2025-02-05 00:54:44', '2025-02-05 00:54:44'),
(10, '1', '5B', '2025-02-05 00:54:44', '2025-02-05 00:54:44'),
(11, '1', '6A', '2025-02-05 00:54:44', '2025-02-05 00:54:44'),
(12, '1', '6B', '2025-02-05 00:54:44', '2025-02-05 00:54:44'),
(14, '3', '1A', '2025-02-08 20:34:31', '2025-02-08 20:34:31'),
(15, '3', '1B', '2025-02-08 20:34:31', '2025-02-08 20:34:31'),
(16, '3', '2A', '2025-02-08 20:34:31', '2025-02-08 20:34:31'),
(17, '3', '2B', '2025-02-08 20:34:31', '2025-02-08 20:34:31'),
(18, '3', '3A', '2025-02-08 20:34:31', '2025-02-08 20:34:31'),
(19, '3', '3B', '2025-02-08 20:34:31', '2025-02-08 20:34:31'),
(20, '3', '4A', '2025-02-08 20:34:31', '2025-02-08 20:34:31'),
(21, '3', '4B', '2025-02-08 20:34:31', '2025-02-08 20:34:31'),
(22, '3', '5A', '2025-02-08 20:34:31', '2025-02-08 20:34:31'),
(23, '3', '5B', '2025-02-08 20:34:31', '2025-02-08 20:34:31'),
(24, '3', '6A', '2025-02-08 20:34:31', '2025-02-08 20:34:31'),
(25, '3', '6B', '2025-02-08 20:34:31', '2025-02-08 20:34:31');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('SAZfgAkMGGzpA08DnF61QUQHmJFkblu2SPmPTWKX', 3, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/132.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiTzZFQ0NXc01BdE9jYmF5ZlFhQ1VGaGZmeFMzUlpzYm5sWlE2TTZjbyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzI6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9teS10aWNrZXRzIjt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6Mzt9', 1739119292);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` enum('admin','customer','maskapai') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'customer',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `role`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(3, 'tes', 'tes@gmail.com', 'customer', NULL, '$2y$12$.YmFR7lcg2iCEL6CVi6fb.hnpROamHn8l1OF3MIlSx3diBvISP3eS', NULL, '2025-02-05 21:19:40', '2025-02-05 21:19:40'),
(4, 'admin', 'admin@gmail.com', 'admin', NULL, '$2y$12$Jjk4AEIQ9raGT2JXsqtlO.Nm9.CHIodc43j3butVFrsFBcLCePdzu', NULL, '2025-02-08 20:23:57', '2025-02-08 20:23:57'),
(5, 'Andhika Ramaditya', 'example@gmail.com', 'maskapai', NULL, '$2y$12$jorVVpoF8f5vMJIVNbdGouMI9tHFfinpsgzeMZAEo/gK7tfOK8x5O', NULL, '2025-02-09 07:53:26', '2025-02-09 07:53:26');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bandaras`
--
ALTER TABLE `bandaras`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `bandaras_id_bandara_unique` (`id_bandara`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jadwal`
--
ALTER TABLE `jadwal`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `jadwal_no_penerbangan_unique` (`no_penerbangan`),
  ADD KEY `jadwal_id_pesawat_foreign` (`id_pesawat`),
  ADD KEY `jadwal_keberangkatan_foreign` (`keberangkatan`),
  ADD KEY `jadwal_tujuan_foreign` (`tujuan`);

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
-- Indexes for table `maskapais`
--
ALTER TABLE `maskapais`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `maskapais_id_pesawat_unique` (`id_pesawat`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `pemesanans`
--
ALTER TABLE `pemesanans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pemesanans_user_id_foreign` (`user_id`),
  ADD KEY `pemesanans_no_penerbangan_foreign` (`no_penerbangan`),
  ADD KEY `pemesanans_bangku_code_foreign` (`bangku_code`),
  ADD KEY `pemesanans_no_pemesanan_unique` (`no_pemesanan`) USING BTREE;

--
-- Indexes for table `seats`
--
ALTER TABLE `seats`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_pesawat` (`id_pesawat`),
  ADD KEY `seats_bangku_code_unique` (`bangku_code`) USING BTREE;

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bandaras`
--
ALTER TABLE `bandaras`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jadwal`
--
ALTER TABLE `jadwal`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `maskapais`
--
ALTER TABLE `maskapais`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `pemesanans`
--
ALTER TABLE `pemesanans`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `seats`
--
ALTER TABLE `seats`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `jadwal`
--
ALTER TABLE `jadwal`
  ADD CONSTRAINT `jadwal_id_pesawat_foreign` FOREIGN KEY (`id_pesawat`) REFERENCES `maskapais` (`id_pesawat`),
  ADD CONSTRAINT `jadwal_keberangkatan_foreign` FOREIGN KEY (`keberangkatan`) REFERENCES `bandaras` (`id_bandara`),
  ADD CONSTRAINT `jadwal_tujuan_foreign` FOREIGN KEY (`tujuan`) REFERENCES `bandaras` (`id_bandara`);

--
-- Constraints for table `pemesanans`
--
ALTER TABLE `pemesanans`
  ADD CONSTRAINT `pemesanans_bangku_code_foreign` FOREIGN KEY (`bangku_code`) REFERENCES `seats` (`bangku_code`),
  ADD CONSTRAINT `pemesanans_no_penerbangan_foreign` FOREIGN KEY (`no_penerbangan`) REFERENCES `jadwal` (`no_penerbangan`),
  ADD CONSTRAINT `pemesanans_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `seats`
--
ALTER TABLE `seats`
  ADD CONSTRAINT `seats_id_pesawat_foreign` FOREIGN KEY (`id_pesawat`) REFERENCES `maskapais` (`id_pesawat`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
