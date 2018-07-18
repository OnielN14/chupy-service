-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 18, 2018 at 06:06 AM
-- Server version: 10.1.22-MariaDB
-- PHP Version: 7.1.4

SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_chuppy_rpl`
--

-- --------------------------------------------------------

--
-- Table structure for table `fotokonten`
--

CREATE TABLE `fotokonten` (
  `id` int(5) NOT NULL,
  `gambar` text,
  `idKonten` int(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `fotoproduk`
--

CREATE TABLE `fotoproduk` (
  `id` int(5) NOT NULL,
  `gambar` text,
  `idProduk` int(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `hakakses`
--

CREATE TABLE `hakakses` (
  `id` int(5) NOT NULL,
  `levelAkses` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `jenisproduk`
--

CREATE TABLE `jenisproduk` (
  `id` int(5) NOT NULL,
  `nama` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `kategorikonten`
--

CREATE TABLE `kategorikonten` (
  `id` int(5) NOT NULL,
  `nama` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `kategoriproduk`
--

CREATE TABLE `kategoriproduk` (
  `id` int(5) NOT NULL,
  `nama` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `konten`
--

CREATE TABLE `konten` (
  `id` int(5) NOT NULL,
  `judul` varchar(255) DEFAULT NULL,
  `deskripsi` text,
  `idKategori` int(5) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `map`
--

CREATE TABLE `map` (
  `id` int(5) NOT NULL,
  `longitude` varchar(255) DEFAULT NULL,
  `latitude` varchar(255) DEFAULT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `deskripsi` text,
  `foto` text,
  `url_foto` text NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pengguna`
--

CREATE TABLE `pengguna` (
  `id` int(5) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `idHakakses` int(5) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `petshop`
--

CREATE TABLE `petshop` (
  `id` int(5) NOT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `deskripsi` varchar(255) DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `idPengguna` int(5) DEFAULT NULL,
  `idMap` int(5) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `postpengguna`
--

CREATE TABLE `postpengguna` (
  `id` int(5) NOT NULL,
  `idPengguna` int(5) DEFAULT NULL,
  `idKonten` int(5) DEFAULT NULL,
  `statusPost` enum('publish','draft') DEFAULT NULL,
  `tanggalPost` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id` int(5) NOT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `deskripsi` text,
  `stok` int(10) DEFAULT NULL,
  `harga` int(5) DEFAULT NULL,
  `idKategori` int(5) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tagkonten`
--

CREATE TABLE `tagkonten` (
  `id` int(5) NOT NULL,
  `nama` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `fotokonten`
--
ALTER TABLE `fotokonten`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fotokonten_ibfk_1` (`idKonten`);

--
-- Indexes for table `fotoproduk`
--
ALTER TABLE `fotoproduk`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idProduk` (`idProduk`);

--
-- Indexes for table `hakakses`
--
ALTER TABLE `hakakses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jenisproduk`
--
ALTER TABLE `jenisproduk`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kategorikonten`
--
ALTER TABLE `kategorikonten`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kategoriproduk`
--
ALTER TABLE `kategoriproduk`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `konten`
--
ALTER TABLE `konten`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idKategori` (`idKategori`);

--
-- Indexes for table `map`
--
ALTER TABLE `map`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `pengguna`
--
ALTER TABLE `pengguna`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `petshop`
--
ALTER TABLE `petshop`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idMap` (`idMap`);

--
-- Indexes for table `postpengguna`
--
ALTER TABLE `postpengguna`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idKonten` (`idKonten`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idKategori` (`idKategori`);

--
-- Indexes for table `tagkonten`
--
ALTER TABLE `tagkonten`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `pengguna`
--
ALTER TABLE `pengguna`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tagkonten`
--
ALTER TABLE `tagkonten`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `fotokonten`
--
ALTER TABLE `fotokonten`
  ADD CONSTRAINT `fotokonten_ibfk_1` FOREIGN KEY (`idKonten`) REFERENCES `konten` (`id`);

--
-- Constraints for table `fotoproduk`
--
ALTER TABLE `fotoproduk`
  ADD CONSTRAINT `fotoproduk_ibfk_1` FOREIGN KEY (`idProduk`) REFERENCES `produk` (`id`);

--
-- Constraints for table `konten`
--
ALTER TABLE `konten`
  ADD CONSTRAINT `konten_ibfk_1` FOREIGN KEY (`idKategori`) REFERENCES `kategorikonten` (`id`);

--
-- Constraints for table `petshop`
--
ALTER TABLE `petshop`
  ADD CONSTRAINT `petshop_ibfk_1` FOREIGN KEY (`idMap`) REFERENCES `map` (`id`);

--
-- Constraints for table `postpengguna`
--
ALTER TABLE `postpengguna`
  ADD CONSTRAINT `postpengguna_ibfk_1` FOREIGN KEY (`idKonten`) REFERENCES `konten` (`id`);

--
-- Constraints for table `produk`
--
ALTER TABLE `produk`
  ADD CONSTRAINT `produk_ibfk_1` FOREIGN KEY (`idKategori`) REFERENCES `kategoriproduk` (`id`);
SET FOREIGN_KEY_CHECKS=1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
