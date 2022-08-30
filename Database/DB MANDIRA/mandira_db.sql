-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 30, 2022 at 08:03 PM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mandira_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `lamarans`
--

CREATE TABLE `lamarans` (
  `users_email` varchar(25) CHARACTER SET utf8mb4 NOT NULL,
  `lowongans_id` int(11) NOT NULL,
  `tanggal_pelamaran` datetime NOT NULL,
  `status` varchar(200) CHARACTER SET utf8mb4 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `lamarans`
--

INSERT INTO `lamarans` (`users_email`, `lowongans_id`, `tanggal_pelamaran`, `status`) VALUES
('budi@gmail.com', 1, '2022-08-30 21:02:58', 'Terdaftar'),
('budi@gmail.com', 2, '2022-08-30 21:16:32', 'Tahap Seleksi'),
('budi@gmail.com', 4, '2022-08-31 00:54:24', 'Tahap Seleksi'),
('carikerja1@gmail.com', 1, '2022-08-30 21:34:29', 'Terdaftar'),
('carikerja@gmail.com', 1, '2022-08-30 21:31:06', 'Terdaftar');

-- --------------------------------------------------------

--
-- Table structure for table `lowongans`
--

CREATE TABLE `lowongans` (
  `id` int(11) NOT NULL,
  `nama` varchar(45) NOT NULL,
  `posisi` varchar(45) NOT NULL,
  `lokasi_kerja` varchar(200) NOT NULL,
  `jam_kerja` time NOT NULL,
  `pengalaman_kerja` longtext NOT NULL,
  `pendidikan_terakhir` varchar(200) NOT NULL,
  `deskripsi_kerja` longtext NOT NULL,
  `profile_perusahaan` longtext NOT NULL,
  `tanggal_pemasangan` date NOT NULL,
  `perusahaans_id` int(11) NOT NULL,
  `gaji` int(11) NOT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `lowongans`
--

INSERT INTO `lowongans` (`id`, `nama`, `posisi`, `lokasi_kerja`, `jam_kerja`, `pengalaman_kerja`, `pendidikan_terakhir`, `deskripsi_kerja`, `profile_perusahaan`, `tanggal_pemasangan`, `perusahaans_id`, `gaji`, `updated_at`, `created_at`) VALUES
(1, 'Backend Developer Internship', 'Backend Developer', 'Jakarta', '00:00:08', '2 Tahun  Backend Developer', 'Pendidikan minimal SMA/SMK\r\nMemiliki pengalaman minimal 1-2 tahun\r\nMemiliki integritas yang tinggi, jujur dan bisa dipercaya\r\nBisa menggunakan Microsoft Office (Word dan Excel)\r\nTeliti dalam bekerja\r\n', 'Mengurus Server', 'tidak ada', '2022-08-27', 2, 15000000, '2022-08-27 11:23:04', '2022-08-27 11:23:04'),
(2, 'Backend Developer Internship', 'Backend Developer', 'Jakarta', '00:00:08', 'Bisa menggunakan Microsoft Office (Word dan Excel)\r\nTeliti dalam bekerja\r\nDapat bekerja dibawah tekanan', 'Bisa menggunakan Microsoft Office (Word dan Excel)\r\nTeliti dalam bekerja\r\nDapat bekerja dibawah tekanan', 'Mengurus Server', 'tidak ada', '2022-08-27', 3, 15000000, '2022-08-27 11:44:07', '2022-08-27 11:44:07'),
(3, 'Frontend Developer Internship', 'Frontend Developer', 'Jakarta', '00:00:04', 'frontend 1 tahun', 'Bisa menggunakan Microsoft Office (Word dan Excel)\r\nTeliti dalam bekerja\r\nDapat bekerja dibawah tekanan', 'Mengurus Server', 'tidak ada', '2022-08-26', 3, 15000000, '2022-08-27 11:46:17', '2022-08-27 11:46:17'),
(4, 'Data Science Internship', 'Data Scientist', 'Surabaya', '00:00:03', 'Bisa menggunakan Microsoft Office (Word dan Excel)\r\nTeliti dalam bekerja\r\nDapat bekerja dibawah tekanan', 'Bisa menggunakan Microsoft Office (Word dan Excel)\r\nTeliti dalam bekerja\r\nDapat bekerja dibawah tekanan', 'Mengurus Server', 'asd', '2022-08-18', 2, 15000000, '2022-08-27 16:06:48', '2022-08-27 16:06:48'),
(5, 'Backend Developer Internship', 'Backend Developer', 'Surabaya', '00:00:04', 'Backennd', 'Bisa menggunakan Microsoft Office (Word dan Excel)\r\nTeliti dalam bekerja\r\nDapat bekerja dibawah tekanan', 'Mengurus Server', 'ubaya', '2022-08-29', 4, 15000000, '2022-08-29 10:12:33', '2022-08-29 10:12:33'),
(6, 'UI UX Internship', 'UI UX', 'Surabaya', '00:00:04', 'as', 'Bisa menggunakan Microsoft Office (Word dan Excel)\r\nTeliti dalam bekerja\r\nDapat bekerja dibawah tekanan', 'Mengurus Server', 'asas', '2022-08-30', 3, 15000000, '2022-08-30 04:16:38', '2022-08-30 04:16:38'),
(7, 'Frontend Developer Intern', 'Developer', 'Pakuwon', '00:00:05', 'Minimal 5 Tahun', 'Bisa menggunakan Microsoft Office (Word dan Excel)\r\nTeliti dalam bekerja\r\nDapat bekerja dibawah tekanan', 'Mengurus UI', 'Perusahaan ini menghasilkan banyak uang', '2022-09-01', 2, 10000000, '2022-08-30 07:55:37', '2022-08-30 07:55:37');

-- --------------------------------------------------------

--
-- Table structure for table `pelatihan_mentors`
--

CREATE TABLE `pelatihan_mentors` (
  `sesi_pelatihans_id` int(11) NOT NULL,
  `mentors_email` varchar(25) CHARACTER SET utf8mb4 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pelatihan_mentors`
--

INSERT INTO `pelatihan_mentors` (`sesi_pelatihans_id`, `mentors_email`) VALUES
(1, 'kiky3@gmail.com'),
(1, 'wily@gmail.com'),
(3, 'kuky@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `pelatihan_pesertas`
--

CREATE TABLE `pelatihan_pesertas` (
  `sesi_pelatihans_id` int(11) NOT NULL,
  `email_peserta` varchar(25) CHARACTER SET utf8mb4 NOT NULL,
  `status` enum('terdaftar','dalam seleksi','diterima','ditolak','sedang proses pelatihan','lulus pelatihan','tidak lulus pelatihan','direkomendasi untuk uji kompetensi') NOT NULL,
  `is_sesuai_minat` enum('-1','0','1') DEFAULT NULL,
  `tanggal_pendaftar_pesertas` date DEFAULT NULL,
  `is_daftar_ulang` tinyint(1) DEFAULT '0',
  `tanggal_daftar_ulang` datetime DEFAULT NULL,
  `rekom_catatan` text,
  `rekom_nilai_TPA` int(11) DEFAULT NULL,
  `rekom_keputusan` enum('Lulus','Tidak Lulus','Cadangan') DEFAULT NULL,
  `rekom_tanggal_draft` datetime DEFAULT NULL,
  `rekom_tanggal_final` datetime DEFAULT NULL,
  `rekom_is_permanent` tinyint(1) DEFAULT '0',
  `hasil_kompetensi` enum('Kompeten','Belum Kompeten') DEFAULT NULL,
  `tanggal_seleksi` date DEFAULT NULL,
  `rekom_validator` varchar(25) CHARACTER SET utf8mb4 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pelatihan_pesertas`
--

INSERT INTO `pelatihan_pesertas` (`sesi_pelatihans_id`, `email_peserta`, `status`, `is_sesuai_minat`, `tanggal_pendaftar_pesertas`, `is_daftar_ulang`, `tanggal_daftar_ulang`, `rekom_catatan`, `rekom_nilai_TPA`, `rekom_keputusan`, `rekom_tanggal_draft`, `rekom_tanggal_final`, `rekom_is_permanent`, `hasil_kompetensi`, `tanggal_seleksi`, `rekom_validator`) VALUES
(1, 'pesertasatu@gmail.com', 'terdaftar', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2022-08-30', NULL),
(1, 'www@gmail.com', 'lulus pelatihan', '1', NULL, 0, NULL, 'Bagus', 90, 'Lulus', NULL, NULL, 1, 'Kompeten', NULL, ''),
(1, 'yobong@gmail.com', 'terdaftar', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2022-08-30', NULL),
(3, 'natan@gmail.com', 'diterima', NULL, NULL, 0, NULL, 'Bagus', 90, 'Lulus', NULL, NULL, 1, 'Kompeten', '2022-09-10', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `perusahaans`
--

CREATE TABLE `perusahaans` (
  `id` int(11) NOT NULL,
  `nama` varchar(200) NOT NULL,
  `bidang` varchar(200) NOT NULL,
  `alamat` varchar(200) NOT NULL,
  `kode_pos` varchar(45) NOT NULL,
  `no_telp` varchar(12) NOT NULL,
  `siup` varchar(200) NOT NULL,
  `npwp` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `images` varchar(200) NOT NULL,
  `verified_by` varchar(255) CHARACTER SET utf8mb4 DEFAULT NULL,
  `verified_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `tentang_perusahaan` longtext NOT NULL,
  `logo` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `perusahaans`
--

INSERT INTO `perusahaans` (`id`, `nama`, `bidang`, `alamat`, `kode_pos`, `no_telp`, `siup`, `npwp`, `email`, `images`, `verified_by`, `verified_at`, `created_at`, `updated_at`, `tentang_perusahaan`, `logo`) VALUES
(2, 'PT Djarum (Djaga Rumah)', 'IT', 'Jakarta Barat', '13254', '081234567890', 'siup/MDHFuIK6vuwKMphntjpLyuWPQkegCL2g3OZLcatL.pdf', 'npwp/XEaMGy2EBW1P84ujLeqEkWDe9TpCDNDu7S52nfm4.pdf', 'member@gmail.com', 'foto_perusahaan/I8R6nYLELT4VP9SvBGNNDn4G26ohPoeAh0ElepDW.jpg', NULL, NULL, '2022-08-27 10:36:23', '2022-08-27 10:36:23', 'SLS adalah sebuah perusahaan yang mengedepankan SDM sebagai asset perusahaan yang sangat berharga. Lebih dari 10 tahun, kami berusaha untuk menjaga kualitas produk dan layanan, serta SDM kami. Sebuah distributor komponen mesin yang selalu memberikan solusi dan kontribusi untuk kesuksesan bisnis pelanggan dan mitra bisnis kami.', 'logo/Q1kajS7JmrU7JemccYOk3dw6SzDtriix6lUlnbtJ.jpg'),
(3, 'Shopee', 'IT', 'Jakarta Timur', '12345', '081234567890', 'siup/SwjbnDEqIhEG9E2AjaRI7cGgrtu02RLwCt96fzUs.pdf', 'npwp/iwPEWbK92qQDcBxo33Sp5h4JO696szkx9KhsNsMU.pdf', 'perusahaanx@gmail.com', 'foto_perusahaan/8BVMcAHGAWkNv5wLYrWiaX8PpcoYKeaRvkTeWPmB.jpg', NULL, NULL, '2022-08-27 11:42:03', '2022-08-27 11:42:03', 'SLS adalah sebuah perusahaan yang mengedepankan SDM sebagai asset perusahaan yang sangat berharga. Lebih dari 10 tahun, kami berusaha untuk menjaga kualitas produk dan layanan, serta SDM kami. Sebuah distributor komponen mesin yang selalu memberikan solusi dan kontribusi untuk kesuksesan bisnis pelanggan dan mitra bisnis kami.', 'logo/iRd7YCMGMoFLWrz9Z1iRAyS7DBhjM9RiMh2eLsq0.jpg'),
(4, 'UBAYA', 'IT', 'Surabaya', '12345', '081234567890', 'siup/llYgyPvcTW9LPf7JUThXfiEU2ue2auZCIvvL2pD7.pdf', 'npwp/qbSCSgUdhW5OGq9YmLc98WmYsJlBhmjwAkSRI1hV.pdf', 'ubaya@gmail.com', 'foto_perusahaan/BfdyhctwJuB4S67JoJtMAkmoO5CMYXiFbIdfTHTQ.jpg', NULL, NULL, '2022-08-29 10:10:49', '2022-08-29 10:10:49', 'SLS adalah sebuah perusahaan yang mengedepankan SDM sebagai asset perusahaan yang sangat berharga. Lebih dari 10 tahun, kami berusaha untuk menjaga kualitas produk dan layanan, serta SDM kami. Sebuah distributor komponen mesin yang selalu memberikan solusi dan kontribusi untuk kesuksesan bisnis pelanggan dan mitra bisnis kami.', 'logo/4WckkhgnyCcZPFAtccAzPtRBTgthoCzu1ZXmyWSS.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `sesi_pelatihans`
--

CREATE TABLE `sesi_pelatihans` (
  `id` int(11) NOT NULL,
  `tanggal_pendaftaran` datetime NOT NULL,
  `tanggal_tutup` datetime NOT NULL,
  `lokasi` varchar(45) NOT NULL,
  `tanggal_mulai_pelatihan` datetime NOT NULL,
  `tanggal_selesai_pelatihan` datetime NOT NULL,
  `harga` double NOT NULL,
  `kuota` int(11) NOT NULL,
  `tanggal_seleksi` datetime NOT NULL,
  `paket_program_id` int(11) NOT NULL,
  `aktivitas` text NOT NULL,
  `gambar_pelatihan` varchar(500) DEFAULT NULL,
  `deskripsi` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sesi_pelatihans`
--

INSERT INTO `sesi_pelatihans` (`id`, `tanggal_pendaftaran`, `tanggal_tutup`, `lokasi`, `tanggal_mulai_pelatihan`, `tanggal_selesai_pelatihan`, `harga`, `kuota`, `tanggal_seleksi`, `paket_program_id`, `aktivitas`, `gambar_pelatihan`, `deskripsi`) VALUES
(1, '2022-08-01 11:56:00', '2022-08-04 11:56:00', 'surabaya', '2022-08-05 11:56:00', '2022-08-25 11:56:00', 12222, 12, '2022-08-30 11:56:00', 17, 'wqssqweqweqweqw', '', ''),
(2, '2022-08-23 16:11:00', '2022-08-31 16:11:00', 'bojonegoro', '2022-08-31 16:11:00', '2022-09-07 16:11:00', 0, 16, '2022-09-10 16:11:00', 17, 'menjahit', NULL, NULL),
(3, '2022-09-01 14:40:00', '2022-09-02 14:40:00', 'GM', '2022-09-03 14:40:00', '2022-09-04 14:40:00', 1000000, 16, '2022-09-10 14:40:00', 18, 'Berolahraga Setiap Subuh', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `status_pelatihan_pesertas`
--

CREATE TABLE `status_pelatihan_pesertas` (
  `sesi_pelatihans_id` int(11) NOT NULL,
  `users_email` varchar(25) CHARACTER SET utf8mb4 NOT NULL,
  `status` enum('terdaftar','dalam seleksi','diterima','ditolak','sedang proses pelatihan','lulus pelatihan','tidak lulus pelatihan','direkomendasi untuk uji kompetensi') NOT NULL,
  `is_sesuai_minat` enum('-1','0','1') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `lamarans`
--
ALTER TABLE `lamarans`
  ADD PRIMARY KEY (`users_email`,`lowongans_id`),
  ADD KEY `fk_users_has_lowongans_lowongans1_idx` (`lowongans_id`);

--
-- Indexes for table `lowongans`
--
ALTER TABLE `lowongans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_lowongans_perusahaans1_idx` (`perusahaans_id`);

--
-- Indexes for table `pelatihan_mentors`
--
ALTER TABLE `pelatihan_mentors`
  ADD PRIMARY KEY (`sesi_pelatihans_id`,`mentors_email`);

--
-- Indexes for table `pelatihan_pesertas`
--
ALTER TABLE `pelatihan_pesertas`
  ADD PRIMARY KEY (`sesi_pelatihans_id`,`email_peserta`),
  ADD KEY `fk_pelatihan_pesertas_sesi_pelatihans1_idx` (`sesi_pelatihans_id`);

--
-- Indexes for table `perusahaans`
--
ALTER TABLE `perusahaans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sesi_pelatihans`
--
ALTER TABLE `sesi_pelatihans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `status_pelatihan_pesertas`
--
ALTER TABLE `status_pelatihan_pesertas`
  ADD PRIMARY KEY (`sesi_pelatihans_id`,`users_email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `lowongans`
--
ALTER TABLE `lowongans`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `perusahaans`
--
ALTER TABLE `perusahaans`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `sesi_pelatihans`
--
ALTER TABLE `sesi_pelatihans`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `lamarans`
--
ALTER TABLE `lamarans`
  ADD CONSTRAINT `fk_users_has_lowongans_lowongans1` FOREIGN KEY (`lowongans_id`) REFERENCES `lowongans` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `lowongans`
--
ALTER TABLE `lowongans`
  ADD CONSTRAINT `fk_lowongans_perusahaans1` FOREIGN KEY (`perusahaans_id`) REFERENCES `perusahaans` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `pelatihan_mentors`
--
ALTER TABLE `pelatihan_mentors`
  ADD CONSTRAINT `fk_sesi_pelatihans_has_users_sesi_pelatihans1` FOREIGN KEY (`sesi_pelatihans_id`) REFERENCES `sesi_pelatihans` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `pelatihan_pesertas`
--
ALTER TABLE `pelatihan_pesertas`
  ADD CONSTRAINT `fk_pelatihan_pesertas_sesi_pelatihans1` FOREIGN KEY (`sesi_pelatihans_id`) REFERENCES `sesi_pelatihans` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `status_pelatihan_pesertas`
--
ALTER TABLE `status_pelatihan_pesertas`
  ADD CONSTRAINT `fk_status_pelatihan_pesertas_sesi_pelatihans1` FOREIGN KEY (`sesi_pelatihans_id`) REFERENCES `sesi_pelatihans` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
