-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 02, 2022 at 11:40 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `database_uvii`
--

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(7, '2014_10_12_000000_create_users_table', 1),
(8, '2014_10_12_100000_create_password_resets_table', 1),
(9, '2019_08_19_000000_create_failed_jobs_table', 1),
(15, '2022_06_23_154850_create_answers_table', 2),
(16, '2022_06_23_154850_create_entries_table', 2),
(17, '2022_06_23_154850_create_questions_table', 2),
(18, '2022_06_23_154850_create_sections_table', 2),
(19, '2022_06_23_154850_create_surveys_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('jack@yahoo.com', '$2y$10$JKQkHT8hvTgyIDVCoDQZB.hLZUvNEwsn.dJSmBQs7//SN81qj4PfO', '2022-06-04 21:02:24');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `nik` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_lengkap` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nomer_hp` varchar(12) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kota` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `peran` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`nik`, `nama_lengkap`, `email`, `nomer_hp`, `kota`, `alamat`, `username`, `password`, `peran`, `remember_token`, `created_at`, `updated_at`) VALUES
('0912456778909123', 'blk uvii', 'blk@yahoo.com', '081234984512', 'surabaya', 'rungkut', 'blk', '$2y$10$VoHLHnW8PvlBhyhc7BNiL.p2fXQDXdbwJ3andejKtWWjD2Xar4OEC', 'Peserta', NULL, '2022-07-02 01:26:17', '2022-07-02 01:26:17'),
('0981242900234214', 'putri novi r', 'putri@yahoo.com', '081230921943', 'Surabaya', 'Land mark', 'putri', '$2y$10$7EiKs17owdvor47Q8Mevi.6HJNO73qCk/98oD9sbklVSihXEh5QHS', 'Peserta', NULL, '2022-06-05 01:40:12', '2022-06-05 01:40:12'),
('1231024912402112', 'blk 2 uvii', 'blk2@yahoo.com', '081234567812', 'surabaya', 'rungkut', 'blk 2', '$2y$10$EsLUweYErMESQYGT.4LehO/U/2RAOGc2QTOerW8jZ0o0kTg2wYyo.', 'Peserta', NULL, '2022-07-02 01:30:46', '2022-07-02 01:30:46'),
('1234567890123456', 'jack ryan', 'jack@yahoo.com', '123456789012', 'surabaya', 'kutisari', 'jack', '$2y$10$/Kfgq2mLJndOXKMj6KfbkONjQBc3DbdjFgDzJ2rCqOmRcnoPUYSsC', 'Peserta', NULL, '2022-06-04 12:16:48', '2022-06-30 23:49:46'),
('1234801290301910', 'jason state', 'jasonStateless@yahoo.com', '021496909012', 'madura', 'genteng', 'jason', '$2y$10$x1soAP8FiBEtBsaJ85W0QuQW5ET94aHERnmvPuvUMxdgaytXTUjEO', 'Peserta', NULL, '2022-06-09 06:07:42', '2022-06-09 06:07:42'),
('2134236960124578', 'jason w', 'jason@yahoo.com', '081252075493', 'palembang', 'JL. soekarno, sukolilo, rungkut no. 123 jawa timur', 'jason w', '$2y$10$qOjipRaqZPQGsroHD.SsPOrmtbxIbAzfh3uk4pqu1oTBk69JC1YXy', 'Peserta', NULL, '2022-06-04 22:01:10', '2022-06-04 22:01:10'),
('3100413940129012', 'Rudolf K. Weisman', 'pat22@yahoo.com', '123456789012', 'balikpapan', 'kilo', 'rudolf', '$2y$10$xUZ5yrD.UcjO4ydnX83PHeSQxF4MvtlrNCwphoUS23Wsq04r8PeCy', 'Peserta', NULL, '2022-06-26 07:22:42', '2022-06-26 07:22:42'),
('3531341240921409', 'jack the learner', 'learninge938@gmail.com', '082198098323', 'malang', 'lebak banten', 'jack the learner', '$2y$10$/xv5JeGKXKlzxMUAo6kn8eKJmyPgazTF8BklExzgspb2jLTxvZ/D.', 'Peserta', NULL, '2022-06-04 22:22:13', '2022-07-01 00:10:50'),
('3534340121291234', 'pelix', 'pat21@yahoo.com', '081252075493', 'jakarta', 'JL. soekarno, sukolilo, rungkut no. 123 jawa timur', 'pelix', '$2y$10$qOjipRaqZPQGsroHD.SsPOrmtbxIbAzfh3uk4pqu1oTBk69JC1YXy', 'Peserta', NULL, '2022-06-26 07:21:22', '2022-06-30 23:25:22');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
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
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`nik`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
