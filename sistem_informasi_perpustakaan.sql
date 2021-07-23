-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 30, 2021 at 05:29 AM
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
-- Database: `sistem_informasi_perpustakaan`
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
('20210511001', 'Eka Bagus Fernadia'),
('20210511002', 'Abdul Hilmi'),
('20210511003', 'Dibio Agus Satya Darmsdfa'),
('20210511004', 'Ahmad Husain Faruq'),
('20210511005', 'Rizk'),
('20210529002', 'Sasukesdff');

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
('FF-055', 'Tutorial Hero Mobile Legend Lengkap'),
('HN-111', 'Perjuangan Semut'),
('JU-001', 'jujutsu kaisen'),
('JU-021', 'jujutsu kaisen ova6'),
('JU-022', 'jujjusanpo'),
('LA-001', 'Las vegas'),
('NA-001', 'naruto'),
('NA-003', 'Napak Tilas'),
('NA-004', 'narutos'),
('ND-002', 'One Punch Man'),
('SG-212', 'Wiro Sableng'),
('SS-015', 'Hacking to The Gate');

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
(24, 56, '2021-05-29'),
(25, 52, '2021-05-29'),
(26, 57, '2021-05-29'),
(27, 53, '2021-05-29'),
(28, 54, '2021-05-29'),
(29, 58, '2021-05-29'),
(30, 60, '2021-05-29');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi_pinjam_buku`
--

CREATE TABLE `transaksi_pinjam_buku` (
  `id_transaksi_pinjam_buku` int(10) UNSIGNED NOT NULL,
  `no_anggota` varchar(20) NOT NULL,
  `kode_buku` varchar(30) NOT NULL,
  `tanggal_pinjam_buku` date DEFAULT current_timestamp(),
  `batas_pengembalian_buku` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaksi_pinjam_buku`
--

INSERT INTO `transaksi_pinjam_buku` (`id_transaksi_pinjam_buku`, `no_anggota`, `kode_buku`, `tanggal_pinjam_buku`, `batas_pengembalian_buku`) VALUES
(45, '20210511001', 'JU-022', '2021-05-29', '2021-06-05'),
(50, '20210511002', 'ND-002', '2021-05-29', '2021-06-05'),
(51, '20210511003', 'NA-001', '2021-05-29', '2021-06-05'),
(55, '20210511002', 'JU-021', '2021-05-29', '2021-06-05'),
(59, '20210511001', 'NA-004', '2021-05-29', '2021-06-05'),
(61, '20210511001', 'HN-111', '2021-05-29', '2021-06-05');

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
  ADD PRIMARY KEY (`kode_buku`);

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
  ADD UNIQUE KEY `kode_buku` (`kode_buku`),
  ADD KEY `no_anggota` (`no_anggota`),
  ADD KEY `kode_buku_2` (`kode_buku`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `transaksi_pengembalian`
--
ALTER TABLE `transaksi_pengembalian`
  MODIFY `id_transaksi_pengembalian` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `transaksi_pinjam_buku`
--
ALTER TABLE `transaksi_pinjam_buku`
  MODIFY `id_transaksi_pinjam_buku` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- Constraints for dumped tables
--

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
