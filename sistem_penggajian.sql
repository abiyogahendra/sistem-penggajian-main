-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 26, 2021 at 03:21 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sistem_penggajian`
--

-- --------------------------------------------------------

--
-- Table structure for table `absensi`
--

CREATE TABLE `absensi` (
  `id_absen` int(11) UNSIGNED NOT NULL,
  `tanggal` date DEFAULT NULL,
  `id_karyawan` int(11) UNSIGNED DEFAULT NULL,
  `jam_masuk` time DEFAULT NULL,
  `id_status` tinyint(3) UNSIGNED DEFAULT NULL,
  `keterangan` varchar(255) DEFAULT '-',
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp(),
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `absensi`
--

INSERT INTO `absensi` (`id_absen`, `tanggal`, `id_karyawan`, `jam_masuk`, `id_status`, `keterangan`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '2021-03-01', 3, '08:00:00', 1, '-', '2021-03-01 08:00:54', '2021-03-01 08:00:54', NULL),
(2, '2021-03-01', 2, '08:00:00', 1, '-', '2021-03-01 08:00:34', '2021-03-01 08:00:34', NULL),
(3, '2021-03-02', 3, '08:20:00', 2, 'Motor mogok', '2021-03-02 08:20:53', '2021-03-23 17:09:47', NULL),
(4, '2021-03-02', 2, '08:00:00', 1, '-', '2021-03-02 08:00:12', '2021-03-02 08:00:12', NULL),
(5, '2021-03-03', 3, '08:00:00', 1, '-', '2021-03-03 08:00:09', '2021-03-03 08:00:09', NULL),
(6, '2021-03-03', 2, '08:00:00', 1, '-', '2021-03-03 08:00:09', '2021-03-03 08:00:09', NULL),
(9, '2021-02-22', 3, '08:00:00', 1, '-', '2021-03-23 14:56:26', '2021-03-23 14:56:26', NULL),
(10, '2021-02-22', 2, '08:00:00', 1, '-', '2021-03-23 14:56:26', '2021-03-23 14:56:26', NULL),
(11, '2021-03-01', 4, '08:00:00', 1, '-', '2021-03-23 21:00:09', '2021-03-23 21:00:09', NULL),
(12, '2021-03-02', 4, '08:10:00', 2, '-', '2021-03-23 21:00:47', '2021-03-23 21:00:47', NULL),
(13, '2021-03-03', 4, '08:00:00', 1, '-', '2021-03-23 21:01:01', '2021-03-23 21:01:01', NULL),
(14, '2021-03-04', 3, '08:00:00', 1, '-', '2021-03-24 15:20:30', '2021-03-24 15:20:30', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `gaji`
--

CREATE TABLE `gaji` (
  `id` int(11) UNSIGNED NOT NULL,
  `id_karyawan` int(11) UNSIGNED DEFAULT NULL,
  `bulan` char(2) DEFAULT NULL,
  `tahun` char(4) DEFAULT NULL,
  `salary` int(11) DEFAULT NULL,
  `hadir` int(11) DEFAULT NULL,
  `potongan` int(11) DEFAULT NULL,
  `gaji_bersih` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `gaji`
--

INSERT INTO `gaji` (`id`, `id_karyawan`, `bulan`, `tahun`, `salary`, `hadir`, `potongan`, `gaji_bersih`, `created_at`, `updated_at`, `deleted_at`) VALUES
(212, 3, '03', '2021', 2500000, 3, 30000, 2470000, '2021-03-24 12:17:20', '2021-03-24 12:17:20', NULL),
(213, 7, '03', '2021', 0, 0, 0, 0, '2021-03-24 12:17:20', '2021-03-24 12:17:20', NULL),
(214, 2, '03', '2021', 1790500, 3, 15000, 1775500, '2021-03-24 12:17:20', '2021-03-24 12:17:20', NULL),
(215, 1, '03', '2021', 0, 0, 0, 0, '2021-03-24 12:17:20', '2021-03-24 12:17:20', NULL),
(216, 5, '03', '2021', 0, 0, 0, 0, '2021-03-24 12:17:20', '2021-03-24 12:17:20', NULL),
(217, 6, '03', '2021', 0, 0, 0, 0, '2021-03-24 12:17:20', '2021-03-24 12:17:20', NULL),
(218, 4, '03', '2021', 1790500, 3, 15000, 1775500, '2021-03-24 12:17:20', '2021-03-24 12:17:20', NULL),
(267, 3, '01', '2021', 0, 0, 0, 0, '2021-05-21 11:17:25', '2021-05-21 11:17:25', NULL),
(268, 7, '01', '2021', 0, 0, 0, 0, '2021-05-21 11:17:25', '2021-05-21 11:17:25', NULL),
(269, 2, '01', '2021', 0, 0, 0, 0, '2021-05-21 11:17:25', '2021-05-21 11:17:25', NULL),
(270, 5, '01', '2021', 0, 0, 0, 0, '2021-05-21 11:17:25', '2021-05-21 11:17:25', NULL),
(271, 6, '01', '2021', 0, 0, 0, 0, '2021-05-21 11:17:25', '2021-05-21 11:17:25', NULL),
(272, 4, '01', '2021', 0, 0, 0, 0, '2021-05-21 11:17:25', '2021-05-21 11:17:25', NULL),
(273, 3, '02', '2021', 2500000, 1, 15000, 2485000, '2021-05-21 11:17:32', '2021-05-21 11:17:32', NULL),
(274, 7, '02', '2021', 0, 0, 0, 0, '2021-05-21 11:17:32', '2021-05-21 11:17:32', NULL),
(275, 2, '02', '2021', 1790500, 1, 15000, 1775500, '2021-05-21 11:17:32', '2021-05-21 11:17:32', NULL),
(276, 5, '02', '2021', 0, 0, 0, 0, '2021-05-21 11:17:32', '2021-05-21 11:17:32', NULL),
(277, 6, '02', '2021', 0, 0, 0, 0, '2021-05-21 11:17:32', '2021-05-21 11:17:32', NULL),
(278, 4, '02', '2021', 0, 0, 0, 0, '2021-05-21 11:17:32', '2021-05-21 11:17:32', NULL),
(286, 8, '05', '2021', 0, 0, 0, 0, '2021-05-26 18:51:31', '2021-05-26 18:51:31', NULL),
(287, 3, '05', '2021', 0, 0, 0, 0, '2021-05-26 18:51:31', '2021-05-26 18:51:31', NULL),
(288, 7, '05', '2021', 0, 0, 0, 0, '2021-05-26 18:51:31', '2021-05-26 18:51:31', NULL),
(289, 2, '05', '2021', 0, 0, 0, 0, '2021-05-26 18:51:31', '2021-05-26 18:51:31', NULL),
(290, 5, '05', '2021', 0, 0, 0, 0, '2021-05-26 18:51:31', '2021-05-26 18:51:31', NULL),
(291, 6, '05', '2021', 0, 0, 0, 0, '2021-05-26 18:51:31', '2021-05-26 18:51:31', NULL),
(292, 4, '05', '2021', 0, 0, 0, 0, '2021-05-26 18:51:31', '2021-05-26 18:51:31', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `karyawan`
--

CREATE TABLE `karyawan` (
  `id` int(11) UNSIGNED NOT NULL,
  `nama` varchar(128) DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `telepon` varchar(24) DEFAULT NULL,
  `username` varchar(64) DEFAULT NULL,
  `salary` int(11) UNSIGNED DEFAULT NULL,
  `tanggal_masuk` date DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `karyawan`
--

INSERT INTO `karyawan` (`id`, `nama`, `alamat`, `telepon`, `username`, `salary`, `tanggal_masuk`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Pandu Cahyo Sukoco', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2, 'Nur Wahid', 'Jalan Kenanga No. 12, Kebumen', '082245680621', NULL, 1790500, '2021-02-26', '2021-03-09 19:55:05', '2021-03-10 02:37:37', NULL),
(3, 'Brilli Noval Nur Wibowo', 'Jl. Gatak Gg. Tulip, Jaranan, Banguntapan', '081234561234', NULL, 2500000, '2021-03-15', '2021-03-15 08:32:46', '2021-03-15 08:32:46', NULL),
(4, 'Yuda Junianto', 'Jalan Cebongan, Cebongan, Sleman', '087798765432', NULL, 1790500, '2021-03-23', '2021-03-23 18:10:44', '2021-03-23 18:10:44', NULL),
(5, 'Salma Maulida', 'Jalan Prembun, Kabekelan, Sleman', '082245680621', NULL, 2500000, '2021-03-24', '2021-03-24 10:10:19', '2021-03-24 10:24:53', NULL),
(6, 'Sintya', 'Desa Bagung, Prembun, Bantul', '082245680621', NULL, 3500000, '2021-03-24', '2021-03-24 10:25:51', '2021-03-24 10:25:51', NULL),
(7, 'Chandra', 'Desa Patukrejo Rt. 002/RW. 003, Kec. Bonorowo', '082245680621', NULL, 1790500, '2021-03-24', '2021-03-24 10:30:13', '2021-03-24 10:30:13', NULL),
(8, 'abiyoga', 'Abiyoga Hendra Wijaya', '901902919992', NULL, 10209890, '2021-05-26', '2021-05-26 18:46:43', '2021-05-26 18:46:43', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `status_absensi`
--

CREATE TABLE `status_absensi` (
  `id_status_absen` tinyint(3) UNSIGNED NOT NULL,
  `status_absen` varchar(64) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `status_absensi`
--

INSERT INTO `status_absensi` (`id_status_absen`, `status_absen`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Hadir', '2021-03-14 08:11:03', '2021-03-14 08:11:03', NULL),
(2, 'Telat', '2021-03-14 08:11:09', '2021-03-14 08:11:09', NULL),
(3, 'Absen', '2021-03-14 08:11:14', '2021-03-16 18:11:29', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `id_karyawan` int(11) UNSIGNED DEFAULT NULL,
  `username` varchar(64) DEFAULT NULL,
  `password` varchar(128) DEFAULT NULL,
  `is_admin` tinyint(3) DEFAULT 0,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `id_karyawan`, `username`, `password`, `is_admin`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'panduadmin', '$2y$10$Z85KSJIYOwCyk7mRDwrKsuBgcOZk5.xSPVqSskzRMzbJ4.vZP.pUa', 1, '2021-03-07 10:35:46', '2021-03-07 10:35:46', NULL),
(2, 2, 'nurwahid', '$2y$10$BmC1Op9E/557fDIGa0HCWe3HvfW/.XIMveeBKn/7RlkvT5tTPPNlW', 0, '2021-03-09 19:55:05', '2021-03-10 02:37:37', NULL),
(4, 3, 'brilli', '$2y$10$e0E2T00NCqOKwPDFDoHcme/sKPbFyZjZRstE5zwE5WtlLTIWap/FW', 0, '2021-03-15 08:32:46', '2021-03-15 08:32:46', NULL),
(5, 4, 'yudajuni66', '$2y$10$9pff5copHX.nTJWwatqqDOjIgQn9nHRr3QNMqC3.6lVofcltWwSLK', 0, '2021-03-23 18:10:44', '2021-03-23 18:10:44', NULL),
(6, 5, 'salmamaulida', '$2y$10$nNOv83S0ZkPRflmLZNm/U.smlp8u242QKLuTU8.hbNkc0ghAK8Lg6', 0, '2021-03-24 10:10:19', '2021-03-24 10:24:53', NULL),
(7, 6, 'sintya', '$2y$10$gt2BH8wjUucNm9HB4dOkjOkk1Iox6XrXymwX6ZoniQE/gImGRAfe.', 0, '2021-03-24 10:25:51', '2021-03-24 10:25:51', NULL),
(8, 7, 'chandra', '$2y$10$Qt4tBE/kpeE6xYqPIduoVuRDZKIg7Y4uK5bfAdns/wPXZBTa0BnMq', 0, '2021-03-24 10:30:13', '2021-03-24 10:30:13', NULL),
(12, 8, 'abiyoga', '$2y$10$0ezTFQxK2K8k2XfRugEeTOCLE9QGxibSijPU7h2Ki3872KMEgj0Lu', 0, '2021-05-26 18:46:43', '2021-05-26 18:46:43', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `absensi`
--
ALTER TABLE `absensi`
  ADD PRIMARY KEY (`id_absen`),
  ADD KEY `absensi_ibfk_1` (`id_karyawan`),
  ADD KEY `absensi_ibfk_2` (`id_status`);

--
-- Indexes for table `gaji`
--
ALTER TABLE `gaji`
  ADD PRIMARY KEY (`id`),
  ADD KEY `gaji_ibfk_1` (`id_karyawan`);

--
-- Indexes for table `karyawan`
--
ALTER TABLE `karyawan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `status_absensi`
--
ALTER TABLE `status_absensi`
  ADD PRIMARY KEY (`id_status_absen`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_karyawan` (`id_karyawan`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `absensi`
--
ALTER TABLE `absensi`
  MODIFY `id_absen` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `gaji`
--
ALTER TABLE `gaji`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=293;

--
-- AUTO_INCREMENT for table `karyawan`
--
ALTER TABLE `karyawan`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `status_absensi`
--
ALTER TABLE `status_absensi`
  MODIFY `id_status_absen` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `absensi`
--
ALTER TABLE `absensi`
  ADD CONSTRAINT `absensi_ibfk_1` FOREIGN KEY (`id_karyawan`) REFERENCES `karyawan` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `absensi_ibfk_2` FOREIGN KEY (`id_status`) REFERENCES `status_absensi` (`id_status_absen`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `gaji`
--
ALTER TABLE `gaji`
  ADD CONSTRAINT `gaji_ibfk_1` FOREIGN KEY (`id_karyawan`) REFERENCES `karyawan` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`id_karyawan`) REFERENCES `karyawan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
