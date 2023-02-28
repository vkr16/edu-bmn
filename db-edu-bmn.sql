-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 28, 2023 at 12:45 PM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `data-bmn`
--

-- --------------------------------------------------------

--
-- Table structure for table `atls`
--

CREATE TABLE `atls` (
  `id` int(11) NOT NULL,
  `uid` varchar(50) NOT NULL,
  `kode_barang` varchar(50) NOT NULL,
  `nup` varchar(50) NOT NULL,
  `nama_barang` varchar(255) NOT NULL,
  `kuantitas` varchar(50) NOT NULL,
  `perolehan` varchar(50) NOT NULL,
  `no_sk` varchar(100) NOT NULL,
  `tanggal_sk` varchar(50) NOT NULL,
  `instansi_sk` varchar(100) NOT NULL,
  `sesuai` varchar(50) NOT NULL,
  `tidak_sesuai` varchar(50) NOT NULL,
  `pihak_lain` varchar(50) NOT NULL,
  `keterangan` varchar(255) NOT NULL,
  `last_editor` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `gdbs`
--

CREATE TABLE `gdbs` (
  `id` int(11) NOT NULL,
  `uid` varchar(50) NOT NULL,
  `kode_barang` varchar(50) NOT NULL,
  `nup` varchar(50) NOT NULL,
  `nama_barang` varchar(255) NOT NULL,
  `kuantitas` varchar(50) NOT NULL,
  `perolehan` varchar(50) NOT NULL,
  `no_sk` varchar(100) NOT NULL,
  `tanggal_sk` varchar(50) NOT NULL,
  `instansi_sk` varchar(100) NOT NULL,
  `sesuai` varchar(50) NOT NULL,
  `tidak_sesuai` varchar(50) NOT NULL,
  `pihak_lain` varchar(50) NOT NULL,
  `keterangan` varchar(255) NOT NULL,
  `last_editor` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `jijs`
--

CREATE TABLE `jijs` (
  `id` int(11) NOT NULL,
  `uid` varchar(50) NOT NULL,
  `kode_barang` varchar(50) NOT NULL,
  `nup` varchar(50) NOT NULL,
  `nama_barang` varchar(255) NOT NULL,
  `kuantitas` varchar(50) NOT NULL,
  `perolehan` varchar(50) NOT NULL,
  `no_sk` varchar(100) NOT NULL,
  `tanggal_sk` varchar(50) NOT NULL,
  `instansi_sk` varchar(100) NOT NULL,
  `sesuai` varchar(50) NOT NULL,
  `tidak_sesuai` varchar(50) NOT NULL,
  `pihak_lain` varchar(50) NOT NULL,
  `keterangan` varchar(255) NOT NULL,
  `last_editor` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `kdps`
--

CREATE TABLE `kdps` (
  `id` int(11) NOT NULL,
  `uid` varchar(50) NOT NULL,
  `kode_barang` varchar(50) NOT NULL,
  `nup` varchar(50) NOT NULL,
  `nama_barang` varchar(255) NOT NULL,
  `kuantitas` varchar(50) NOT NULL,
  `perolehan` varchar(50) NOT NULL,
  `no_sk` varchar(100) NOT NULL,
  `tanggal_sk` varchar(50) NOT NULL,
  `instansi_sk` varchar(100) NOT NULL,
  `sesuai` varchar(50) NOT NULL,
  `tidak_sesuai` varchar(50) NOT NULL,
  `pihak_lain` varchar(50) NOT NULL,
  `keterangan` varchar(255) NOT NULL,
  `last_editor` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `pdms`
--

CREATE TABLE `pdms` (
  `id` int(11) NOT NULL,
  `uid` varchar(50) NOT NULL,
  `kode_barang` varchar(50) NOT NULL,
  `nup` varchar(50) NOT NULL,
  `nama_barang` varchar(255) NOT NULL,
  `kuantitas` varchar(50) NOT NULL,
  `perolehan` varchar(50) NOT NULL,
  `no_sk` varchar(100) NOT NULL,
  `tanggal_sk` varchar(50) NOT NULL,
  `instansi_sk` varchar(100) NOT NULL,
  `sesuai` varchar(50) NOT NULL,
  `tidak_sesuai` varchar(50) NOT NULL,
  `pihak_lain` varchar(50) NOT NULL,
  `keterangan` varchar(255) NOT NULL,
  `last_editor` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tnhs`
--

CREATE TABLE `tnhs` (
  `id` int(11) NOT NULL,
  `uid` varchar(50) NOT NULL,
  `kode_barang` varchar(50) NOT NULL,
  `nup` varchar(50) NOT NULL,
  `nama_barang` varchar(255) NOT NULL,
  `kuantitas` varchar(50) NOT NULL,
  `perolehan` varchar(50) NOT NULL,
  `no_sk` varchar(100) NOT NULL,
  `tanggal_sk` varchar(50) NOT NULL,
  `instansi_sk` varchar(100) NOT NULL,
  `sesuai` varchar(50) NOT NULL,
  `tidak_sesuai` varchar(50) NOT NULL,
  `pihak_lain` varchar(50) NOT NULL,
  `keterangan` varchar(255) NOT NULL,
  `last_editor` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(10) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Administrator', 'admin@akuonline.my.id', '$2y$10$a7W4sEXFkieOTzD0nz.5f.iFTRWHNyRNApSRDFWCHNpJ/aMzV6hsq', 'admin', '2022-09-25 15:29:34', '2022-09-25 15:29:34', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `atls`
--
ALTER TABLE `atls`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gdbs`
--
ALTER TABLE `gdbs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jijs`
--
ALTER TABLE `jijs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kdps`
--
ALTER TABLE `kdps`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pdms`
--
ALTER TABLE `pdms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tnhs`
--
ALTER TABLE `tnhs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `atls`
--
ALTER TABLE `atls`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `gdbs`
--
ALTER TABLE `gdbs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jijs`
--
ALTER TABLE `jijs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kdps`
--
ALTER TABLE `kdps`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pdms`
--
ALTER TABLE `pdms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tnhs`
--
ALTER TABLE `tnhs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
