-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 14, 2026 at 03:06 PM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sistem_penjualan_nasi`
--

-- --------------------------------------------------------

--
-- Table structure for table `detail_penjualan`
--

CREATE TABLE `detail_penjualan` (
  `id` bigint UNSIGNED NOT NULL,
  `penjualan_id` bigint UNSIGNED NOT NULL,
  `menu_id` bigint UNSIGNED NOT NULL,
  `jumlah` int NOT NULL,
  `harga` decimal(12,2) NOT NULL,
  `subtotal` decimal(12,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `detail_penjualan`
--

INSERT INTO `detail_penjualan` (`id`, `penjualan_id`, `menu_id`, `jumlah`, `harga`, `subtotal`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 1, '10000.00', '10000.00', '2026-09-26 06:56:25', '2026-09-26 06:56:25'),
(2, 2, 2, 2, '10000.00', '20000.00', '2026-10-12 19:40:58', '2026-10-12 19:40:58'),
(3, 3, 2, 5, '10000.00', '50000.00', '2026-10-13 08:12:57', '2026-10-13 08:12:57'),
(4, 4, 2, 1, '10000.00', '10000.00', '2026-10-13 09:00:31', '2026-10-13 09:00:31'),
(5, 5, 2, 1, '10000.00', '10000.00', '2026-10-13 10:31:42', '2026-10-13 10:31:42'),
(6, 6, 2, 1, '10000.00', '10000.00', '2026-10-13 17:01:51', '2026-10-13 17:01:51');

-- --------------------------------------------------------

--
-- Table structure for table `menus`
--

CREATE TABLE `menus` (
  `id` bigint UNSIGNED NOT NULL,
  `nama_menu` varchar(100) NOT NULL,
  `deskripsi` text,
  `harga` decimal(12,2) NOT NULL,
  `kategori` varchar(50) NOT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `stok` int NOT NULL DEFAULT '0',
  `status` enum('tersedia','habis') DEFAULT 'tersedia',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `menus`
--

INSERT INTO `menus` (`id`, `nama_menu`, `deskripsi`, `harga`, `kategori`, `foto`, `stok`, `status`, `created_at`, `updated_at`) VALUES
(2, 'Nasi Ayam', 'Nasi putih dengan ayam goreng berbumbu gurih, sambal, dan lalapan segar.', '10000.00', 'Nasi', 'menus/n6TnSpnNkDqdrNYZLqlzve1A5GjOI41vQbtj4Io9.png', 20, 'tersedia', '2026-09-25 08:01:06', '2026-10-13 17:34:31'),
(3, 'Nasi Kuning', 'Nasi kuning dengan lauk dan pelengkap sesuai menu yang dijual', '10000.00', 'Nasi', 'menus/vVqD4sY4HHc2Jzm08wQGF8hCNMqm4I1j186hwAo6.png', 20, 'tersedia', '2026-10-13 16:12:46', '2026-10-13 17:39:35'),
(4, 'Nasi Goreng+Telur', 'Nasi goreng dengan bumbu sederhana ala masakan rumahan.', '15000.00', 'Nasi', 'menus/HD07vLgWKaQvGlLb8GkaULfj9jmImhn2zmDMoYGM.png', 20, 'tersedia', '2026-10-13 17:33:55', '2026-10-13 17:33:55'),
(5, 'Nasi Rames', 'Nasi dengan beberapa pilihan lauk dan sayur.', '10000.00', 'Nasi', 'menus/o8Z5DJ6qIjQF3drXEIsWjbUasvhwArw35Q3gJmQ0.png', 20, 'tersedia', '2026-10-13 17:36:57', '2026-10-13 17:36:57'),
(6, 'Nasi Bandeng', 'Nasi putih dengan ikan bandeng goreng atau bandeng berbumbu dan sambal', '10000.00', 'Nasi', 'menus/nzLwpr2L0rfOHBvzWMgqXUs2sqc2xWTEJIbIPfXG.png', 20, 'tersedia', '2026-10-13 17:38:48', '2026-10-13 17:38:48'),
(7, 'Nasi Gudangan', 'Nasi putih dengan sayuran rebus, kelapa parut berbumbu, dan sambal sesuai selera.', '10000.00', 'Nasi', 'menus/ZtMfyKoFg7vYfs5zsXKfBDEQa4M8Om8YRJQOcKq3.png', 10, 'tersedia', '2026-10-13 17:41:21', '2026-10-13 17:41:21'),
(8, 'Tempe Bacem', 'Tempe berbumbu manis gurih.', '5000.00', 'Lauk', 'menus/HrNqrSl2kjP4GF1OMf6T8f6Bc6AxkcPmCVjmFTOc.png', 20, 'tersedia', '2026-10-13 17:43:40', '2026-10-13 17:43:40'),
(9, 'Telur Dadar', 'Telur dadar gurih untuk lauk nasi.', '5000.00', 'Lauk', 'menus/dE121EqbSvPJcqqwreF7d6i4NyMhRaNoINSjGP0H.png', 20, 'tersedia', '2026-10-13 17:45:27', '2026-10-13 17:45:27'),
(10, 'Perkedel Kentang', 'Perkedel kentang sebagai lauk tambahan.', '5000.00', 'Lauk', 'menus/9pUiI9wjpuvGEQmvTEAio72LIE2VRyu7LR865iEH.png', 20, 'tersedia', '2026-10-13 17:47:24', '2026-10-13 17:47:24'),
(11, 'Tumis Wortel Buncis', 'Wortel dan buncis tumis yang cocok untuk lauk nasi.', '5000.00', 'Lauk', 'menus/yGTDfkVHgHIioi1dZF4zjo6pBxOEYoBxWoijUrex.png', 20, 'tersedia', '2026-10-13 17:49:09', '2026-10-13 17:49:09'),
(12, 'Terong Balado', 'Terong dengan sambal merah pedas gurih.', '5000.00', 'Lauk', 'menus/cHGcfm1PpaXlsSSl2s1dKzPXfwVeg3NlqXdeQyE3.png', 20, 'tersedia', '2026-10-13 17:50:31', '2026-10-13 17:50:31'),
(13, 'Oseng Daun Pepaya', 'Daun pepaya berbumbu, bisa ditambah teri.', '5000.00', 'Lauk', 'menus/ncurG7RJiusMsiAYqYr50GqtE9Oqoe5EpLhXtjFE.png', 20, 'tersedia', '2026-10-13 17:59:17', '2026-10-13 17:59:17'),
(14, 'Urap Sayur', 'Sayuran rebus dengan kelapa parut berbumbu.', '5000.00', 'Lauk', 'menus/qElsNggZeAT08f0am55kfj6Tqs03eZw2jHzmbahj.png', 20, 'tersedia', '2026-10-13 18:00:43', '2026-10-13 18:00:43'),
(15, 'Oseng Kacang Panjang', 'Kacang panjang ditumis dengan bumbu gurih', '5000.00', 'Lauk', 'menus/ttu2NDgZ55A9D0FhQ7eFqhYNvZC0tKNER6y69Qui.png', 20, 'tersedia', '2026-10-13 18:03:04', '2026-10-13 18:03:04'),
(16, 'Orek Tempe', 'Tempe tumis kecap manis dengan bumbu sederhana.', '5000.00', 'Lauk', 'menus/UJR0mkamM6n8nPoXZ3WQkXMwKdhonbCFcmW3DGnl.png', 20, 'tersedia', '2026-10-13 18:04:24', '2026-10-13 18:04:24'),
(17, 'Tempe Mendoan', 'Tempe berbalut tepung berbumbu, digoreng hingga lembut.', '5000.00', 'Lauk', 'menus/4OVWM6oombRsoU2VonOmYHu0FK9WOfoL6XevX69j.png', 20, 'tersedia', '2026-10-13 18:05:41', '2026-10-13 18:06:31'),
(18, 'Tahu Bacem', 'Tahu manis gurih dengan bumbu bacem.', '5000.00', 'Lauk', 'menus/5I0dzRYG9Ln5OQb6JDstRr7iU0zl8MJpcT2Mmqwd.png', 20, 'tersedia', '2026-10-13 18:08:13', '2026-10-13 18:08:13');

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id` bigint UNSIGNED NOT NULL,
  `penjualan_id` bigint UNSIGNED NOT NULL,
  `metode_pembayaran` enum('tunai','transfer','qris') NOT NULL,
  `jumlah_bayar` decimal(12,2) NOT NULL,
  `kembalian` decimal(12,2) NOT NULL DEFAULT '0.00',
  `status_pembayaran` enum('belum_bayar','lunas') DEFAULT 'lunas',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `pembayaran`
--

INSERT INTO `pembayaran` (`id`, `penjualan_id`, `metode_pembayaran`, `jumlah_bayar`, `kembalian`, `status_pembayaran`, `created_at`, `updated_at`) VALUES
(1, 1, 'tunai', '15000.00', '5000.00', 'lunas', '2026-09-26 07:39:07', '2026-09-26 07:39:07'),
(2, 4, 'qris', '10000.00', '0.00', 'lunas', '2026-10-13 15:45:07', '2026-10-13 15:45:07'),
(3, 6, 'tunai', '50000.00', '40000.00', 'lunas', '2026-10-13 17:03:54', '2026-10-13 17:03:54'),
(4, 5, 'transfer', '10000.00', '0.00', 'lunas', '2026-10-14 00:06:56', '2026-10-14 00:06:56');

-- --------------------------------------------------------

--
-- Table structure for table `pengaturan`
--

CREATE TABLE `pengaturan` (
  `id` bigint UNSIGNED NOT NULL,
  `nama_usaha` varchar(100) NOT NULL,
  `nama_pemilik` varchar(100) DEFAULT NULL,
  `no_hp` varchar(20) DEFAULT NULL,
  `alamat` text,
  `deskripsi` text,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `pengaturan`
--

INSERT INTO `pengaturan` (`id`, `nama_usaha`, `nama_pemilik`, `no_hp`, `alamat`, `deskripsi`, `created_at`, `updated_at`) VALUES
(1, 'Nasi Ibu', 'Haryanti', '085934937949', 'Ledoksari RT01/RW06,Ngaglik,Klepu,Kc.Ceper,Kabupaten Klaten,Jawa Tengah 57465', 'Nasi Ibu adalah usaha makanan rumahan yang menyajikan masakan lezat dengan cita rasa rumahan. Kami berkomitmen menggunakan bahan pilihan dan menyiapkan setiap hidangan dengan penuh perhatian. Dengan harga yang terjangkau dan proses pemesanan yang mudah, Nasi Ibu hadir untuk menemani waktu makan keluarga setiap hari.', '2026-09-26 08:11:23', '2026-10-13 16:57:32');

-- --------------------------------------------------------

--
-- Table structure for table `penjualan`
--

CREATE TABLE `penjualan` (
  `id` bigint UNSIGNED NOT NULL,
  `kode_transaksi` varchar(30) NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `nama_pelanggan` varchar(100) DEFAULT NULL,
  `total_harga` decimal(12,2) NOT NULL DEFAULT '0.00',
  `status` enum('menunggu','diproses','selesai','dibatalkan') NOT NULL DEFAULT 'menunggu',
  `catatan` text,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `no_whatsapp` varchar(25) DEFAULT NULL,
  `alamat_pelanggan` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `penjualan`
--

INSERT INTO `penjualan` (`id`, `kode_transaksi`, `user_id`, `nama_pelanggan`, `total_harga`, `status`, `catatan`, `created_at`, `updated_at`, `no_whatsapp`, `alamat_pelanggan`) VALUES
(1, 'TRX-20260926135625-504', 1, 'bu siti', '10000.00', 'selesai', 'sambal campur', '2026-09-26 06:56:25', '2026-09-26 06:56:25', NULL, NULL),
(2, 'TRX-20261013024058-NDCG3', NULL, 'Hana', '20000.00', 'menunggu', 'sambal dipisah', '2026-10-12 19:40:58', '2026-10-12 19:40:58', NULL, NULL),
(3, 'TRX-20261013151257-MWBEP', NULL, 'Ana', '50000.00', 'dibatalkan', 'sambal pisah', '2026-10-13 08:12:57', '2026-10-13 16:06:23', NULL, NULL),
(4, 'TRX-20261013160031-8WLVB', NULL, 'Fauzan', '10000.00', 'selesai', NULL, '2026-10-13 09:00:31', '2026-10-13 15:53:21', NULL, NULL),
(5, 'TRX-20261013173142-NEJM3', NULL, 'Afifah', '10000.00', 'diproses', 'sambal campur', '2026-10-13 10:31:42', '2026-10-14 00:06:36', '083123456789', 'Jl. Melati No 12 rumah no 08'),
(6, 'TRX-20261014000151-BCS7Q', NULL, 'Nana', '10000.00', 'selesai', 'sambal dipisah', '2026-10-13 17:01:51', '2026-10-13 17:04:03', '083123456789', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `nama` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','kasir') DEFAULT 'kasir',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `nama`, `email`, `password`, `role`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@gmail.com', '$2y$12$d9Pkj8CJasxIg9zLJW8uAuRqVbm6GUmKp593KQ0U1Bt7K5eU3cjke', 'admin', '2026-09-25 06:47:17', '2026-09-25 07:00:06');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `detail_penjualan`
--
ALTER TABLE `detail_penjualan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `penjualan_id` (`penjualan_id`),
  ADD KEY `menu_id` (`menu_id`);

--
-- Indexes for table `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`id`),
  ADD KEY `penjualan_id` (`penjualan_id`);

--
-- Indexes for table `pengaturan`
--
ALTER TABLE `pengaturan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `penjualan`
--
ALTER TABLE `penjualan`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kode_transaksi` (`kode_transaksi`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `detail_penjualan`
--
ALTER TABLE `detail_penjualan`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `menus`
--
ALTER TABLE `menus`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `pengaturan`
--
ALTER TABLE `pengaturan`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `penjualan`
--
ALTER TABLE `penjualan`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `detail_penjualan`
--
ALTER TABLE `detail_penjualan`
  ADD CONSTRAINT `detail_penjualan_ibfk_1` FOREIGN KEY (`penjualan_id`) REFERENCES `penjualan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `detail_penjualan_ibfk_2` FOREIGN KEY (`menu_id`) REFERENCES `menus` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE;

--
-- Constraints for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD CONSTRAINT `pembayaran_ibfk_1` FOREIGN KEY (`penjualan_id`) REFERENCES `penjualan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `penjualan`
--
ALTER TABLE `penjualan`
  ADD CONSTRAINT `penjualan_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
