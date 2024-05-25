-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 25, 2024 at 12:40 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lifetrans_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `harga`
--

CREATE TABLE `harga` (
  `id_harga` int(11) NOT NULL,
  `id_rute` int(11) DEFAULT NULL,
  `harga` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lokasi_akhir`
--

CREATE TABLE `lokasi_akhir` (
  `id_lokasi_akhir` int(11) NOT NULL,
  `nama_lokasi` varchar(100) DEFAULT NULL,
  `alamat_lokasi` text DEFAULT NULL,
  `koordinat_lokasi` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lokasi_awal`
--

CREATE TABLE `lokasi_awal` (
  `id_lokasi_awal` int(11) NOT NULL,
  `nama_lokasi` varchar(100) DEFAULT NULL,
  `alamat_lokasi` text DEFAULT NULL,
  `koordinat_lokasi` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rek_rute`
--

CREATE TABLE `rek_rute` (
  `id_rek_rute` int(11) NOT NULL,
  `id_rute` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `review_rating`
--

CREATE TABLE `review_rating` (
  `id_review` int(11) NOT NULL,
  `id_rute` int(11) DEFAULT NULL,
  `ulasan` text DEFAULT NULL,
  `rating` int(11) DEFAULT NULL CHECK (`rating` between 1 and 5)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rute`
--

CREATE TABLE `rute` (
  `id_rute` int(11) NOT NULL,
  `id_lokasi_awal` int(11) DEFAULT NULL,
  `id_lokasi_akhir` int(11) DEFAULT NULL,
  `id_tp_public` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `transportasi_publik`
--

CREATE TABLE `transportasi_publik` (
  `id_tp_public` int(11) NOT NULL,
  `nama_tp` varchar(100) DEFAULT NULL,
  `jenis_tp` varchar(50) DEFAULT NULL,
  `deskripsi_tp` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `role` varchar(50) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `waktu`
--

CREATE TABLE `waktu` (
  `id_waktu` int(11) NOT NULL,
  `id_rute` int(11) DEFAULT NULL,
  `waktu_keberangkatan` time DEFAULT NULL,
  `waktu_tempuh` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `harga`
--
ALTER TABLE `harga`
  ADD PRIMARY KEY (`id_harga`),
  ADD KEY `id_rute` (`id_rute`);

--
-- Indexes for table `lokasi_akhir`
--
ALTER TABLE `lokasi_akhir`
  ADD PRIMARY KEY (`id_lokasi_akhir`);

--
-- Indexes for table `lokasi_awal`
--
ALTER TABLE `lokasi_awal`
  ADD PRIMARY KEY (`id_lokasi_awal`);

--
-- Indexes for table `rek_rute`
--
ALTER TABLE `rek_rute`
  ADD PRIMARY KEY (`id_rek_rute`),
  ADD KEY `id_rute` (`id_rute`);

--
-- Indexes for table `review_rating`
--
ALTER TABLE `review_rating`
  ADD PRIMARY KEY (`id_review`),
  ADD KEY `id_rute` (`id_rute`);

--
-- Indexes for table `rute`
--
ALTER TABLE `rute`
  ADD PRIMARY KEY (`id_rute`),
  ADD KEY `id_lokasi_awal` (`id_lokasi_awal`),
  ADD KEY `id_lokasi_akhir` (`id_lokasi_akhir`),
  ADD KEY `id_tp_public` (`id_tp_public`);

--
-- Indexes for table `transportasi_publik`
--
ALTER TABLE `transportasi_publik`
  ADD PRIMARY KEY (`id_tp_public`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `waktu`
--
ALTER TABLE `waktu`
  ADD PRIMARY KEY (`id_waktu`),
  ADD KEY `id_rute` (`id_rute`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `harga`
--
ALTER TABLE `harga`
  MODIFY `id_harga` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `lokasi_akhir`
--
ALTER TABLE `lokasi_akhir`
  MODIFY `id_lokasi_akhir` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `lokasi_awal`
--
ALTER TABLE `lokasi_awal`
  MODIFY `id_lokasi_awal` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rek_rute`
--
ALTER TABLE `rek_rute`
  MODIFY `id_rek_rute` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `review_rating`
--
ALTER TABLE `review_rating`
  MODIFY `id_review` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rute`
--
ALTER TABLE `rute`
  MODIFY `id_rute` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `transportasi_publik`
--
ALTER TABLE `transportasi_publik`
  MODIFY `id_tp_public` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `waktu`
--
ALTER TABLE `waktu`
  MODIFY `id_waktu` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `harga`
--
ALTER TABLE `harga`
  ADD CONSTRAINT `harga_ibfk_1` FOREIGN KEY (`id_rute`) REFERENCES `rute` (`id_rute`);

--
-- Constraints for table `rek_rute`
--
ALTER TABLE `rek_rute`
  ADD CONSTRAINT `rek_rute_ibfk_1` FOREIGN KEY (`id_rute`) REFERENCES `rute` (`id_rute`);

--
-- Constraints for table `review_rating`
--
ALTER TABLE `review_rating`
  ADD CONSTRAINT `review_rating_ibfk_1` FOREIGN KEY (`id_rute`) REFERENCES `rute` (`id_rute`);

--
-- Constraints for table `rute`
--
ALTER TABLE `rute`
  ADD CONSTRAINT `rute_ibfk_1` FOREIGN KEY (`id_lokasi_awal`) REFERENCES `lokasi_awal` (`id_lokasi_awal`),
  ADD CONSTRAINT `rute_ibfk_2` FOREIGN KEY (`id_lokasi_akhir`) REFERENCES `lokasi_akhir` (`id_lokasi_akhir`),
  ADD CONSTRAINT `rute_ibfk_3` FOREIGN KEY (`id_tp_public`) REFERENCES `transportasi_publik` (`id_tp_public`);

--
-- Constraints for table `waktu`
--
ALTER TABLE `waktu`
  ADD CONSTRAINT `waktu_ibfk_1` FOREIGN KEY (`id_rute`) REFERENCES `rute` (`id_rute`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
