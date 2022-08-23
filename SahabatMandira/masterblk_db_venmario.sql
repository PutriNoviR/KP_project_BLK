-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 22, 2022 at 09:21 AM
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
-- Database: `masterblk_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `blks`
--

CREATE TABLE `blks` (
  `id` int(11) NOT NULL,
  `nama` varchar(45) NOT NULL,
  `alamat` varchar(250) NOT NULL,
  `website_portfolio` varchar(1000) DEFAULT NULL,
  `is_punyasistem` tinyint(1) DEFAULT NULL,
  `link_pendaftaran` varchar(1000) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `blks`
--

INSERT INTO `blks` (`id`, `nama`, `alamat`, `website_portfolio`, `is_punyasistem`, `link_pendaftaran`, `created_at`, `updated_at`) VALUES
(8, 'UPT Bojonegoro', 'Bojonegoro', 'www.com', 1, 'www.com', '2022-08-18 13:09:30', '2022-08-18 13:09:30'),
(9, 'UPT Surabaya', 'surabaya', 'www.com', 1, 'www.com', '2022-08-18 13:10:31', '2022-08-18 13:10:31'),
(10, 'UPT JEMBER', 'Jember', 'www.com', 1, 'www.com', '2022-08-18 13:10:48', '2022-08-18 13:10:48');

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `id` int(11) NOT NULL,
  `nama` varchar(45) DEFAULT NULL,
  `deskripsi` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `nama`, `deskripsi`) VALUES
(1, 'indonesia', 'negara');

-- --------------------------------------------------------

--
-- Table structure for table `kategori_psikometrik`
--

CREATE TABLE `kategori_psikometrik` (
  `id` int(11) NOT NULL,
  `nama` varchar(500) DEFAULT NULL,
  `kode` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `kategori_psikometrik`
--

INSERT INTO `kategori_psikometrik` (`id`, `nama`, `kode`) VALUES
(1, 'Data-People', 'Program Bahasa'),
(2, 'Data-Things', 'Administrasi Perkantoran'),
(3, 'Data-Things-People', ''),
(4, 'Things-Hewan', 'Pembudidaya Ternak'),
(5, 'Things-Pengolahan', 'Pengolah Hasil Pertanian'),
(6, 'Things-Tanaman', 'Pengolah Hasil Pertanian'),
(7, 'Idea-Things-Art', ''),
(8, 'Idea-Things-Garment', ''),
(9, 'Idea-Things-Media', 'Designer Grafis'),
(10, 'Idea-Things-People', 'Penata Rias');

-- --------------------------------------------------------

--
-- Table structure for table `kejuruans`
--

CREATE TABLE `kejuruans` (
  `id` int(11) NOT NULL,
  `nama` varchar(45) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kejuruans`
--

INSERT INTO `kejuruans` (`id`, `nama`, `created_at`, `updated_at`) VALUES
(1, 'Teknik Informatika', '2022-08-12 18:19:12', '2022-08-19 14:22:59'),
(2, 'Teknik Industri', '2022-08-12 18:19:59', '2022-08-12 18:19:59'),
(4, 'Teknik Elektro', '2022-08-18 14:47:02', '2022-08-18 14:47:02'),
(5, 'Teknik Manufaktur', '2022-08-19 14:24:38', '2022-08-19 14:24:38'),
(6, 'Psikologi', '2022-08-22 04:18:57', '2022-08-22 04:18:57');

-- --------------------------------------------------------

--
-- Table structure for table `klaster_psikometrik`
--

CREATE TABLE `klaster_psikometrik` (
  `id` int(11) NOT NULL,
  `nama` varchar(500) DEFAULT NULL,
  `link_kejuruan_tes_2` varchar(1000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `klaster_psikometrik`
--

INSERT INTO `klaster_psikometrik` (`id`, `nama`, `link_kejuruan_tes_2`) VALUES
(1, 'Administrasi dan Layanan', 'https://www.kompas.com/skola/read/2021/08/18/154901669/administrasi-pengertian-tujuan-ciri-ciri-fungsi-dan-jenisnya'),
(2, 'Agriculture', 'https://hot.liputan6.com/read/4693295/agrikultur-adalah-upaya-membuat-pangan-di-bidang-pertanian-ketahui-jenis-jenisnya'),
(3, 'Seni', ''),
(4, 'Teknik', 'https://www.kompas.com/edu/read/2021/11/10/131100771/17-jurusan-teknik-dengan-prospek-kerja-menjanjikan-kamu-pilih-mana?page=all');

-- --------------------------------------------------------

--
-- Table structure for table `menu_manajemens`
--

CREATE TABLE `menu_manajemens` (
  `id` int(11) NOT NULL,
  `nama` varchar(45) NOT NULL,
  `deskripsi` varchar(250) NOT NULL,
  `status` enum('Aktif','Tidak Aktif') NOT NULL,
  `url` varchar(250) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `menu_manajemens_has_roles`
--

CREATE TABLE `menu_manajemens_has_roles` (
  `menu_manajemens_id` int(11) NOT NULL,
  `roles_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `minat_users`
--

CREATE TABLE `minat_users` (
  `users_email` varchar(25) CHARACTER SET utf8mb4 NOT NULL,
  `sub_kejuruans_id` int(11) NOT NULL,
  `peringkat` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `paket_program`
--

CREATE TABLE `paket_program` (
  `id` int(11) NOT NULL,
  `sub_kejuruans_id` int(11) DEFAULT NULL,
  `blks_id` int(11) NOT NULL,
  `kejuruans_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `paket_program`
--

INSERT INTO `paket_program` (`id`, `sub_kejuruans_id`, `blks_id`, `kejuruans_id`, `created_at`, `updated_at`) VALUES
(4, 10, 8, 1, '2022-08-18 14:44:17', '2022-08-18 17:58:27'),
(5, NULL, 8, 2, '2022-08-18 14:44:27', '2022-08-18 14:44:27'),
(6, 13, 9, 1, '2022-08-18 14:44:47', '2022-08-19 07:46:51'),
(7, NULL, 9, 2, '2022-08-18 14:45:21', '2022-08-18 14:45:21'),
(8, NULL, 10, 4, '2022-08-18 14:47:02', '2022-08-18 14:47:02'),
(9, 14, 9, 1, '2022-08-18 16:59:14', '2022-08-19 07:47:43'),
(10, 11, 8, 1, '2022-08-18 17:58:50', '2022-08-18 17:58:50'),
(11, 12, 8, 1, '2022-08-18 18:05:07', '2022-08-18 18:05:07'),
(12, 15, 9, 1, '2022-08-19 07:48:00', '2022-08-19 07:48:00'),
(13, 16, 9, 1, '2022-08-19 11:50:03', '2022-08-19 11:50:03'),
(14, 17, 8, 1, '2022-08-19 11:50:20', '2022-08-19 11:50:20');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `nama_role` varchar(45) NOT NULL,
  `deskripsi` varchar(250) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `nama_role`, `deskripsi`, `created_at`, `updated_at`) VALUES
(1, 'peserta', 'role peserta', NULL, NULL),
(2, 'adminblk', 'adminblk', NULL, NULL),
(3, 'superadmin', 'superadmin', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sub_kejuruans`
--

CREATE TABLE `sub_kejuruans` (
  `id` int(11) NOT NULL,
  `nama` varchar(45) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `kejuruans_id` int(11) NOT NULL,
  `kode_kategori` int(11) NOT NULL,
  `kode_klaster` int(11) NOT NULL,
  `aktivitas` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sub_kejuruans`
--

INSERT INTO `sub_kejuruans` (`id`, `nama`, `created_at`, `updated_at`, `kejuruans_id`, `kode_kategori`, `kode_klaster`, `aktivitas`) VALUES
(2, 'Mulmed', '2022-08-12 18:57:07', '2022-08-19 16:08:30', 1, 1, 1, '- Menggambar\r\n- Coding\r\n- Desainer Grafis'),
(3, 'Mesins', '2022-08-12 18:58:26', '2022-08-12 19:10:38', 2, 2, 3, ''),
(6, 'DSAI', '2022-08-18 17:50:43', '2022-08-18 17:50:43', 1, 10, 2, ''),
(8, 'DSAI', '2022-08-18 17:57:27', '2022-08-18 17:57:27', 1, 5, 1, ''),
(10, 'DSAI', '2022-08-18 17:58:27', '2022-08-18 17:58:27', 1, 4, 4, ''),
(11, 'Mulmed', '2022-08-18 17:58:50', '2022-08-18 17:58:50', 1, 8, 3, ''),
(12, 'NCS', '2022-08-18 18:05:07', '2022-08-18 18:05:07', 1, 9, 1, ''),
(13, 'DSAI', '2022-08-19 07:46:51', '2022-08-19 07:46:51', 1, 9, 1, ''),
(14, 'Mulmed', '2022-08-19 07:47:43', '2022-08-19 07:47:43', 1, 8, 1, ''),
(15, 'NCS', '2022-08-19 07:47:59', '2022-08-19 07:47:59', 1, 4, 4, ''),
(16, 'GD', '2022-08-19 11:50:03', '2022-08-19 11:50:03', 1, 6, 4, ''),
(17, 'GD', '2022-08-19 11:50:20', '2022-08-19 11:50:20', 1, 7, 3, ''),
(18, 'Machine Learning', '2022-08-19 15:10:01', '2022-08-19 15:10:01', 1, 3, 4, 'Data Preprocessing\r\nModel\r\nDeploy'),
(19, 'Machine Learning', '2022-08-22 04:20:53', '2022-08-22 04:20:53', 6, 2, 3, 'zxczxczxc');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `email` varchar(25) CHARACTER SET utf8mb4 NOT NULL,
  `nomor_identitas` varchar(45) CHARACTER SET utf8mb4 DEFAULT NULL,
  `jenis_identitas` enum('KTP','Pasport') CHARACTER SET utf8mb4 DEFAULT NULL,
  `nama_depan` varchar(250) CHARACTER SET utf8mb4 NOT NULL,
  `nama_belakang` varchar(250) CHARACTER SET utf8mb4 NOT NULL,
  `nomer_hp` varchar(12) CHARACTER SET utf8mb4 DEFAULT NULL,
  `kota` varchar(250) CHARACTER SET utf8mb4 DEFAULT NULL,
  `alamat` varchar(250) CHARACTER SET utf8mb4 DEFAULT NULL,
  `username` varchar(45) CHARACTER SET utf8mb4 NOT NULL,
  `password` varchar(250) CHARACTER SET utf8mb4 NOT NULL,
  `ktp` varchar(500) CHARACTER SET utf8mb4 DEFAULT NULL,
  `pas_foto` varchar(500) CHARACTER SET utf8mb4 DEFAULT NULL,
  `ijazah` varchar(500) CHARACTER SET utf8mb4 DEFAULT NULL,
  `ksk` varchar(500) CHARACTER SET utf8mb4 DEFAULT NULL,
  `is_verified` tinyint(4) DEFAULT NULL,
  `verified_by` varchar(255) CHARACTER SET utf8mb4 DEFAULT NULL,
  `verified_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `jenis_kelamin` enum('Laki-Laki','Perempuan') CHARACTER SET utf8mb4 DEFAULT NULL,
  `pendidikan_terakhir` enum('SD Sederajat','SMP Sederajat','SMA Sederajat','S1','Pasca Sarjana') CHARACTER SET utf8mb4 DEFAULT NULL,
  `hobi` varchar(255) CHARACTER SET utf8mb4 DEFAULT NULL,
  `countries_id` int(11) NOT NULL,
  `is_buta_warna` tinyint(1) DEFAULT NULL,
  `is_suspend` tinyint(1) DEFAULT NULL,
  `tanggal_suspend` datetime DEFAULT NULL,
  `roles_id` int(11) NOT NULL,
  `suspended_by` varchar(25) CHARACTER SET utf8mb4 DEFAULT NULL,
  `blks_id_admin` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`email`, `nomor_identitas`, `jenis_identitas`, `nama_depan`, `nama_belakang`, `nomer_hp`, `kota`, `alamat`, `username`, `password`, `ktp`, `pas_foto`, `ijazah`, `ksk`, `is_verified`, `verified_by`, `verified_at`, `remember_token`, `created_at`, `updated_at`, `tanggal_lahir`, `jenis_kelamin`, `pendidikan_terakhir`, `hobi`, `countries_id`, `is_buta_warna`, `is_suspend`, `tanggal_suspend`, `roles_id`, `suspended_by`, `blks_id_admin`) VALUES
('mario@gmail.com', NULL, NULL, 'venansius', 'mario', NULL, NULL, NULL, 'venmario', '$2y$10$H78LQfnaGYBobSSnhjzkxOinZ8wnPWuc8YKMbJn4i0xsGtNdYzMR.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-08-12 17:25:44', '2022-08-12 17:25:44', NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, 3, NULL, NULL),
('peserta@gmail.com', NULL, NULL, 'depan', 'belakang', '123456789', NULL, NULL, 'peserta', '$2y$10$nRrc/vmPe9uWRwqDvf2uOu3i3GbU9kKF980.vZKMrFk/Llsdq6ZvW', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-08-18 09:13:49', '2022-08-20 13:20:14', NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, 2, NULL, 8),
('weley@gmail.com', NULL, NULL, 'weley', 'juga', NULL, NULL, NULL, 'weley', '$2y$10$ENq6Wm7tVnjZQfotP67QKOlsXM..ZYosDdOclHECxPKqnCe8/q9La', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-08-22 06:54:05', '2022-08-22 07:16:51', NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, 2, NULL, 8);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `blks`
--
ALTER TABLE `blks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kategori_psikometrik`
--
ALTER TABLE `kategori_psikometrik`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kejuruans`
--
ALTER TABLE `kejuruans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `klaster_psikometrik`
--
ALTER TABLE `klaster_psikometrik`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menu_manajemens`
--
ALTER TABLE `menu_manajemens`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menu_manajemens_has_roles`
--
ALTER TABLE `menu_manajemens_has_roles`
  ADD PRIMARY KEY (`menu_manajemens_id`,`roles_id`),
  ADD KEY `fk_roles_menu_idx` (`roles_id`);

--
-- Indexes for table `minat_users`
--
ALTER TABLE `minat_users`
  ADD PRIMARY KEY (`users_email`,`sub_kejuruans_id`),
  ADD KEY `fk_users_has_sub_kejuruans_sub_kejuruans1_idx` (`sub_kejuruans_id`),
  ADD KEY `fk_users_has_sub_kejuruans_users1_idx` (`users_email`);

--
-- Indexes for table `paket_program`
--
ALTER TABLE `paket_program`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_paket_program_sub_kejuruans1_idx` (`sub_kejuruans_id`),
  ADD KEY `fk_paket_program_blks1_idx` (`blks_id`),
  ADD KEY `fk_paket_program_kejuruans1_idx` (`kejuruans_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sub_kejuruans`
--
ALTER TABLE `sub_kejuruans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_sub_kejuruans_kejuruans1_idx` (`kejuruans_id`),
  ADD KEY `fk_sub_kejuruans_kategori_psikometrik1_idx` (`kode_kategori`),
  ADD KEY `fk_sub_kejuruans_klaster_psikometrik1_idx` (`kode_klaster`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`email`),
  ADD KEY `fk_users_countries1_idx` (`countries_id`),
  ADD KEY `fk_users_roles1_idx` (`roles_id`),
  ADD KEY `fk_users_users1_idx` (`suspended_by`),
  ADD KEY `fk_users_blks1_idx` (`blks_id_admin`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `blks`
--
ALTER TABLE `blks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `kategori_psikometrik`
--
ALTER TABLE `kategori_psikometrik`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `kejuruans`
--
ALTER TABLE `kejuruans`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `klaster_psikometrik`
--
ALTER TABLE `klaster_psikometrik`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `menu_manajemens`
--
ALTER TABLE `menu_manajemens`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `paket_program`
--
ALTER TABLE `paket_program`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `sub_kejuruans`
--
ALTER TABLE `sub_kejuruans`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `menu_manajemens_has_roles`
--
ALTER TABLE `menu_manajemens_has_roles`
  ADD CONSTRAINT `fk_menu_roles` FOREIGN KEY (`menu_manajemens_id`) REFERENCES `menu_manajemens` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_roles_menu` FOREIGN KEY (`roles_id`) REFERENCES `roles` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `minat_users`
--
ALTER TABLE `minat_users`
  ADD CONSTRAINT `fk_users_has_sub_kejuruans_sub_kejuruans1` FOREIGN KEY (`sub_kejuruans_id`) REFERENCES `sub_kejuruans` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_users_has_sub_kejuruans_users1` FOREIGN KEY (`users_email`) REFERENCES `users` (`email`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `paket_program`
--
ALTER TABLE `paket_program`
  ADD CONSTRAINT `fk_paket_program_blks1` FOREIGN KEY (`blks_id`) REFERENCES `blks` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_paket_program_kejuruans1` FOREIGN KEY (`kejuruans_id`) REFERENCES `kejuruans` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_paket_program_sub_kejuruans1` FOREIGN KEY (`sub_kejuruans_id`) REFERENCES `sub_kejuruans` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `sub_kejuruans`
--
ALTER TABLE `sub_kejuruans`
  ADD CONSTRAINT `fk_sub_kejuruans_kategori_psikometrik1` FOREIGN KEY (`kode_kategori`) REFERENCES `kategori_psikometrik` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_sub_kejuruans_kejuruans1` FOREIGN KEY (`kejuruans_id`) REFERENCES `kejuruans` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_sub_kejuruans_klaster_psikometrik1` FOREIGN KEY (`kode_klaster`) REFERENCES `klaster_psikometrik` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `fk_users_blks1` FOREIGN KEY (`blks_id_admin`) REFERENCES `blks` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_users_countries1` FOREIGN KEY (`countries_id`) REFERENCES `countries` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_users_roles1` FOREIGN KEY (`roles_id`) REFERENCES `roles` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_users_users1` FOREIGN KEY (`suspended_by`) REFERENCES `users` (`email`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
