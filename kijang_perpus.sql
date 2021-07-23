-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 31, 2021 at 12:45 AM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.4.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kijang_perpus`
--

-- --------------------------------------------------------

--
-- Table structure for table `data_anggota`
--

CREATE TABLE `data_anggota` (
  `no_anggota` varchar(20) NOT NULL,
  `nama_anggota` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `data_anggota`
--

INSERT INTO `data_anggota` (`no_anggota`, `nama_anggota`) VALUES
('20210511001', 'Eka Bagus Fernadi'),
('20210511002', 'Abdul Hilmi'),
('20210511003', 'Dibio Agus Satya Darma'),
('20210511004', 'Ahmad Husain Faruq'),
('20210511005', 'Rizki Amirudin'),
('20210529002', 'Satoya');

-- --------------------------------------------------------

--
-- Table structure for table `data_buku`
--

CREATE TABLE `data_buku` (
  `kode_buku` varchar(30) NOT NULL,
  `judul_buku` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `data_buku`
--

INSERT INTO `data_buku` (`kode_buku`, `judul_buku`) VALUES
('BO-001', 'Boku No Hero Academia'),
('DE-001', 'Death Note'),
('GI-001', 'Gintama'),
('JU-002', 'Juju Sanpo'),
('JU-003', 'Jujutsu Kaisen'),
('KA-001', 'Kamen Rider'),
('ON-001', 'One Piece'),
('SH-002', 'Shingeki No Bahamut'),
('SH-001', 'Shingeki No Kyoujin'),
('TO-002', 'Tomodachi Game'),
('TO-001', 'Toriko');

-- --------------------------------------------------------

--
-- Table structure for table `data_buku_tersedia`
--

CREATE TABLE `data_buku_tersedia` (
  `id_data_buku_tersedia` int(11) NOT NULL,
  `kode_buku` varchar(30) CHARACTER SET latin1 NOT NULL,
  `judul_buku` varchar(100) CHARACTER SET latin1 NOT NULL,
  `ketersediaan` varchar(20) CHARACTER SET latin1 DEFAULT 'TERSEDIA'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `data_buku_tersedia`
--

INSERT INTO `data_buku_tersedia` (`id_data_buku_tersedia`, `kode_buku`, `judul_buku`, `ketersediaan`) VALUES
(3, 'JU-002', 'Juju Sanpo', 'TERSEDIA'),
(7, 'SH-001', 'Shingeki No Kyoujin', 'TERSEDIA'),
(8, 'DE-001', 'Death Note', 'TERSEDIA'),
(9, 'GI-001', 'Gintama', 'TERSEDIA'),
(11, 'ON-001', 'One Piece', 'TERSEDIA'),
(12, 'BO-001', 'Boku No Hero Academia', 'KOSONG'),
(13, 'KA-001', 'Kamen Rider', 'TERSEDIA'),
(14, 'SH-002', 'Shingeki No Bahamut', 'TERSEDIA'),
(15, 'TO-001', 'Toriko', 'TERSEDIA'),
(16, 'TO-002', 'Tomodachi Game', 'TERSEDIA'),
(17, 'JU-003', 'Jujutsu Kaisen', 'TERSEDIA');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi_pengembalian`
--

CREATE TABLE `transaksi_pengembalian` (
  `id_transaksi_pengembalian` int(10) UNSIGNED NOT NULL,
  `id_transaksi_pinjam_buku` int(10) UNSIGNED NOT NULL,
  `tanggal_pengembalian_buku` date DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaksi_pengembalian`
--

INSERT INTO `transaksi_pengembalian` (`id_transaksi_pengembalian`, `id_transaksi_pinjam_buku`, `tanggal_pengembalian_buku`) VALUES
(31, 74, '2021-05-31'),
(33, 82, '2021-05-31'),
(34, 73, '2021-05-31'),
(35, 77, '2021-05-31'),
(36, 78, '2021-05-31'),
(37, 79, '2021-05-31'),
(38, 80, '2021-05-31'),
(39, 81, '2021-05-31'),
(40, 83, '2021-05-31'),
(41, 84, '2021-05-31');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi_pinjam_buku`
--

CREATE TABLE `transaksi_pinjam_buku` (
  `id_transaksi_pinjam_buku` int(10) UNSIGNED NOT NULL,
  `no_anggota` varchar(20) NOT NULL,
  `kode_buku` varchar(30) NOT NULL,
  `tanggal_pinjam_buku` date DEFAULT current_timestamp(),
  `batas_pengembalian_buku` date NOT NULL,
  `status` varchar(20) DEFAULT 'BELUM KEMBALI'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaksi_pinjam_buku`
--

INSERT INTO `transaksi_pinjam_buku` (`id_transaksi_pinjam_buku`, `no_anggota`, `kode_buku`, `tanggal_pinjam_buku`, `batas_pengembalian_buku`, `status`) VALUES
(72, '20210511001', 'ON-001', '2021-05-30', '2021-06-06', 'SUDAH KEMBALI'),
(73, '20210511001', 'JU-002', '2021-05-31', '2021-06-07', 'SUDAH KEMBALI'),
(74, '20210511002', 'DE-001', '2021-05-31', '2021-06-07', 'SUDAH KEMBALI'),
(77, '20210511001', 'BO-001', '2021-05-31', '2021-06-07', 'SUDAH KEMBALI'),
(78, '20210511002', 'KA-001', '2021-05-31', '2021-06-07', 'SUDAH KEMBALI'),
(79, '20210511003', 'GI-001', '2021-05-31', '2021-06-07', 'SUDAH KEMBALI'),
(80, '20210511003', 'JU-003', '2021-05-31', '2021-06-07', 'SUDAH KEMBALI'),
(81, '20210511003', 'DE-001', '2021-05-31', '2021-06-07', 'SUDAH KEMBALI'),
(82, '20210511001', 'ON-001', '2021-05-31', '2021-06-07', 'SUDAH KEMBALI'),
(83, '20210511003', 'KA-001', '2021-05-31', '2021-06-07', 'SUDAH KEMBALI'),
(84, '20210511002', 'BO-001', '2021-05-24', '2021-05-30', 'SUDAH KEMBALI'),
(86, '20210529002', 'BO-001', '2021-05-31', '2021-06-07', 'BELUM KEMBALI');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `data_anggota`
--
ALTER TABLE `data_anggota`
  ADD PRIMARY KEY (`no_anggota`);

--
-- Indexes for table `data_buku`
--
ALTER TABLE `data_buku`
  ADD PRIMARY KEY (`kode_buku`),
  ADD UNIQUE KEY `judul_buku` (`judul_buku`);

--
-- Indexes for table `data_buku_tersedia`
--
ALTER TABLE `data_buku_tersedia`
  ADD PRIMARY KEY (`id_data_buku_tersedia`),
  ADD UNIQUE KEY `kode_buku` (`kode_buku`),
  ADD KEY `kode_buku_2` (`kode_buku`),
  ADD KEY `judul_buku` (`judul_buku`);

--
-- Indexes for table `transaksi_pengembalian`
--
ALTER TABLE `transaksi_pengembalian`
  ADD PRIMARY KEY (`id_transaksi_pengembalian`),
  ADD UNIQUE KEY `id_transaksi_pinjam_buku` (`id_transaksi_pinjam_buku`),
  ADD KEY `id_transaksi_pinjam_buku_2` (`id_transaksi_pinjam_buku`);

--
-- Indexes for table `transaksi_pinjam_buku`
--
ALTER TABLE `transaksi_pinjam_buku`
  ADD PRIMARY KEY (`id_transaksi_pinjam_buku`),
  ADD KEY `no_anggota` (`no_anggota`),
  ADD KEY `kode_buku_2` (`kode_buku`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `data_buku_tersedia`
--
ALTER TABLE `data_buku_tersedia`
  MODIFY `id_data_buku_tersedia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `transaksi_pengembalian`
--
ALTER TABLE `transaksi_pengembalian`
  MODIFY `id_transaksi_pengembalian` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `transaksi_pinjam_buku`
--
ALTER TABLE `transaksi_pinjam_buku`
  MODIFY `id_transaksi_pinjam_buku` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `data_buku_tersedia`
--
ALTER TABLE `data_buku_tersedia`
  ADD CONSTRAINT `data_buku_tersedia_ibfk_1` FOREIGN KEY (`kode_buku`) REFERENCES `data_buku` (`kode_buku`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `data_buku_tersedia_ibfk_2` FOREIGN KEY (`judul_buku`) REFERENCES `data_buku` (`judul_buku`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `transaksi_pengembalian`
--
ALTER TABLE `transaksi_pengembalian`
  ADD CONSTRAINT `transaksi_pengembalian_ibfk_1` FOREIGN KEY (`id_transaksi_pinjam_buku`) REFERENCES `transaksi_pinjam_buku` (`id_transaksi_pinjam_buku`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `transaksi_pinjam_buku`
--
ALTER TABLE `transaksi_pinjam_buku`
  ADD CONSTRAINT `transaksi_pinjam_buku_ibfk_2` FOREIGN KEY (`kode_buku`) REFERENCES `data_buku` (`kode_buku`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `transaksi_pinjam_buku_ibfk_3` FOREIGN KEY (`no_anggota`) REFERENCES `data_anggota` (`no_anggota`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
