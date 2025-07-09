-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 19, 2025 at 10:47 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `qc`
--

-- --------------------------------------------------------

--
-- Table structure for table `data_hasil_produksi`
--

CREATE TABLE `data_hasil_produksi` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `hari` varchar(255) DEFAULT NULL,
  `tanggal` varchar(255) DEFAULT NULL,
  `mesin` varchar(255) DEFAULT NULL,
  `nama_produk` int(11) DEFAULT NULL,
  `jenis_bahan` varchar(255) DEFAULT NULL,
  `acuan_sampling` varchar(255) DEFAULT NULL,
  `aql_check` varchar(255) DEFAULT NULL,
  `status_pre_order` varchar(255) DEFAULT NULL,
  `tanggal_start_awal` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `data_hasil_produksi`
--

INSERT INTO `data_hasil_produksi` (`id`, `hari`, `tanggal`, `mesin`, `nama_produk`, `jenis_bahan`, `acuan_sampling`, `aql_check`, `status_pre_order`, `tanggal_start_awal`, `created_at`, `updated_at`) VALUES
(1, NULL, '2025-06-14', 'ANu', 1, 'sadkjasj', 'kjsadjahsd', 'jshdfkjshd', 'Open', '2025-06-15', '2025-06-16 07:54:39', '2025-06-16 08:05:20'),
(2, NULL, '2025-06-21', 'JK21', 1, 'jsdhajkhd', 'sakjdhashd', 'kjdfksjbfs', 'Close', '2025-06-19', '2025-06-16 08:38:46', '2025-06-16 08:38:46'),
(3, NULL, '2025-06-21', 'basdfashjvdf', 1, 'kjehrfsjiebe', 'jdhfisejg', 'fsdjofbs', 'Open', '2025-06-22', '2025-06-16 16:05:36', '2025-06-16 16:05:36'),
(4, 'Senin', '2025-06-18', 'fasdsqaf', 1, 'wfe', 'dfsdfq', '1fgsfs', 'Open', '2025-06-18', '2025-06-18 12:35:56', '2025-06-18 12:35:56'),
(5, NULL, '2025-06-17', 'efgwer1', 1, 'gsdfsdf', 'sfef', 'fasfw', 'Open', '2025-06-17', '2025-06-18 12:40:12', '2025-06-18 12:40:12'),
(6, NULL, '2025-06-18', 'werwer', 4, 'rwrew', 'werwer', 'werwerwe', 'Open', '2025-06-18', '2025-06-18 15:18:08', '2025-06-18 15:18:08');

-- --------------------------------------------------------

--
-- Table structure for table `data_hasil_qc`
--

CREATE TABLE `data_hasil_qc` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `hari` varchar(255) DEFAULT NULL,
  `tanggal` varchar(255) DEFAULT NULL,
  `nama_produk` varchar(255) DEFAULT NULL,
  `nama_mesin` varchar(255) DEFAULT NULL,
  `jumlah_cavity` varchar(255) DEFAULT NULL,
  `jenis_bahan` varchar(255) DEFAULT NULL,
  `tebal_bahan` varchar(255) DEFAULT NULL,
  `status_pre` varchar(255) DEFAULT NULL,
  `dimensi` varchar(255) DEFAULT NULL,
  `aql_check` varchar(255) DEFAULT NULL,
  `inline` varchar(255) DEFAULT NULL,
  `point_critical` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `dimensi_panjang` double(8,2) DEFAULT NULL,
  `dimensi_lebar` double(8,2) DEFAULT NULL,
  `dimensi_tinggi` double(8,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `data_hasil_qc`
--

INSERT INTO `data_hasil_qc` (`id`, `hari`, `tanggal`, `nama_produk`, `nama_mesin`, `jumlah_cavity`, `jenis_bahan`, `tebal_bahan`, `status_pre`, `dimensi`, `aql_check`, `inline`, `point_critical`, `created_at`, `updated_at`, `dimensi_panjang`, `dimensi_lebar`, `dimensi_tinggi`) VALUES
(1, NULL, '2025-06-15', '1', 'dsnfjsdfn', '12', 'jdnasd', '12', 'OK', NULL, 'dfnlksndfl', 'Thermolid', 'kkdnfss', '2025-06-16 09:27:29', '2025-06-16 09:27:29', NULL, NULL, NULL),
(2, NULL, '2025-06-17', '1', 'iwdjfghfdiuwg', '123', 'hasgdfguasdfy', '123', 'OK', NULL, 'sdfsdf', 'Thermolid', 'fsdf', '2025-06-16 15:26:35', '2025-06-16 15:34:42', 1111.00, 1200.00, 1100.00);

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `hakakses`
--

CREATE TABLE `hakakses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `hakakses`
--

INSERT INTO `hakakses` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'create', NULL, NULL),
(2, 'read', NULL, NULL),
(3, 'update', NULL, NULL),
(4, 'delete', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `hakakses_permission`
--

CREATE TABLE `hakakses_permission` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `hakakses_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `hakakses_permission`
--

INSERT INTO `hakakses_permission` (`id`, `permission_id`, `hakakses_id`, `role_id`) VALUES
(1, 1, 1, 1),
(2, 1, 4, 1),
(3, 1, 2, 1),
(4, 1, 3, 1),
(5, 2, 1, 1),
(6, 2, 4, 1),
(7, 2, 2, 1),
(8, 2, 3, 1),
(9, 3, 1, 1),
(10, 3, 4, 1),
(11, 3, 2, 1),
(12, 3, 3, 1),
(13, 4, 1, 1),
(14, 4, 4, 1),
(15, 4, 2, 1),
(16, 4, 3, 1),
(17, 5, 1, 1),
(18, 5, 4, 1),
(19, 5, 2, 1),
(20, 5, 3, 1),
(21, 6, 1, 1),
(22, 6, 4, 1),
(23, 6, 2, 1),
(24, 6, 3, 1),
(25, 7, 1, 1),
(26, 7, 4, 1),
(27, 7, 2, 1),
(28, 7, 3, 1),
(29, 8, 1, 1),
(30, 8, 4, 1),
(31, 8, 2, 1),
(32, 8, 3, 1),
(37, 1, 1, 3),
(38, 1, 4, 3),
(39, 1, 2, 3),
(40, 1, 3, 3),
(41, 2, 1, 3),
(42, 2, 4, 3),
(43, 2, 2, 3),
(44, 2, 3, 3),
(45, 3, 1, 3),
(46, 3, 4, 3),
(47, 3, 2, 3),
(48, 3, 3, 3),
(49, 4, 1, 3),
(50, 4, 4, 3),
(51, 4, 2, 3),
(52, 4, 3, 3),
(53, 5, 1, 3),
(54, 5, 4, 3),
(55, 5, 2, 3),
(56, 5, 3, 3),
(57, 1, 2, 2),
(58, 2, 2, 2),
(59, 3, 2, 2),
(60, 4, 2, 2),
(61, 5, 2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `kelola_permasalahan`
--

CREATE TABLE `kelola_permasalahan` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `jam` datetime DEFAULT NULL,
  `mesin` varchar(255) DEFAULT NULL,
  `nama_operator` varchar(255) DEFAULT NULL,
  `nama_produk` varchar(255) DEFAULT NULL,
  `penyebab` varchar(255) DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `permasalahan` varchar(255) DEFAULT NULL,
  `inline` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kelola_permasalahan`
--

INSERT INTO `kelola_permasalahan` (`id`, `jam`, `mesin`, `nama_operator`, `nama_produk`, `penyebab`, `foto`, `permasalahan`, `inline`, `created_at`, `updated_at`) VALUES
(1, '2025-06-19 01:55:00', 'qsa', 'qwqert', '2', 'dertf', NULL, 'qwqwq', 'Thermolid', '2025-06-16 04:54:13', '2025-06-17 14:37:51'),
(2, '2025-06-16 15:48:00', 'jhdahd', 'asjdsadj', '1', 'klsdflsknf', NULL, 'sdsjdsb', 'Sortir Atas', '2025-06-16 08:49:18', '2025-06-16 08:49:18'),
(3, '2025-06-16 16:06:00', 'jhdahd', 'sakdaksd', '1', 'nsdfldsknflsd', '1750064764_pexels-philkallahar-983200.jpg', 'ndsfbsdjfb', 'Thermolid', '2025-06-16 09:06:04', '2025-06-17 14:53:58'),
(4, '2025-06-15 11:54:00', 'fsdfds', 'fasfdasfd', '1', 'fsaasf', '1750089241_WhatsApp Image 2025-05-08 at 09.17.33 (2).jpeg', 'safasf', 'Thermolid', '2025-06-16 15:54:02', '2025-06-16 15:54:02'),
(5, '2025-06-17 21:30:00', 'bbasfjkbsfk', 'kjasbkjdbas`', '1', 'lkafdnlskdnf', '1750170661_1.png', 'daskjgdu114', 'Thermolid', '2025-06-17 14:31:02', '2025-06-17 14:31:02'),
(6, '2025-06-28 21:34:00', 'dfhsjfdb', 'JBSDKJABJSAFD', '1', 'SKJDBFKSJDF', '1750170876_5.png', 'KJDSHFJSDBFJ', 'Thermolid', '2025-06-17 14:34:37', '2025-06-17 14:34:37'),
(7, '2025-06-17 21:35:00', 'ASB 1', 'sasa', '2', 'dfrds', '1750170990_1.png', 'sakah', 'Vacuum', '2025-06-17 14:36:30', '2025-06-17 14:36:30'),
(8, '2025-06-18 19:40:00', 'fasf', 'safdasf', '1', 'dsfsdfsdf', '1750250469_refrensi.jpg', 'fasdfsf', 'Thermolid', '2025-06-18 12:41:10', '2025-06-18 12:41:10'),
(9, '2025-06-18 19:43:00', 'dfsdfdsf', 'sdfdsfs', '1', 'sfdsdfsdfs', '1750250629_refrensi.jpg', 'fsdfsdfsddfs', 'Thermolid', '2025-06-18 12:43:49', '2025-06-18 12:43:49'),
(10, '2025-06-18 19:43:00', 'dfsdfdsf', 'sdfdsfs', '1', 'sfdsdfsdfs', 'hacx3T5rLk8vkgdGwLcKcPisaq8IwL4hkoIMclqe.jpg', 'fsdfsdfsddfs', 'Thermolid', '2025-06-18 12:51:37', '2025-06-18 12:51:37'),
(11, '2025-06-17 19:51:00', 'sdgsdf', 'dsfsdfsdf', '1', 'sdfsdfsdf', 'MmQ7ZLfRRHX6XQHvNhBcyWVlXNzLjlzgipo761Dn.jpg', 'sdfasefsd', 'Thermolid', '2025-06-18 12:52:00', '2025-06-18 12:52:00'),
(12, '2025-06-17 19:51:00', 'sdgsdf', 'dsfsdfsdf', '1', 'sdfsdfsdf', '1750251309_refrensi.jpg', 'sdfasefsd', 'Thermolid', '2025-06-18 12:55:09', '2025-06-18 12:55:09'),
(13, '2025-06-18 22:43:00', 'gsdfdf', 'gfdgd', '4', 'sdfsdf', '1750261429_WhatsApp Image 2025-05-08 at 09.17.33 (1).jpeg', 'dgffd', 'Thermolid', '2025-06-18 15:43:49', '2025-06-18 15:43:49');

-- --------------------------------------------------------

--
-- Table structure for table `laporan_hasil_produksi`
--

CREATE TABLE `laporan_hasil_produksi` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `hari` varchar(255) DEFAULT NULL,
  `tanggal` timestamp NULL DEFAULT NULL,
  `mesin` varchar(255) DEFAULT NULL,
  `nama_operator` varchar(255) DEFAULT NULL,
  `nama_produk` varchar(255) DEFAULT NULL,
  `acuan_sampling` varchar(255) DEFAULT NULL,
  `aql_check` varchar(255) DEFAULT NULL,
  `status_produk` varchar(255) DEFAULT NULL,
  `temuan_defect` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `laporan_hasil_produksi`
--

INSERT INTO `laporan_hasil_produksi` (`id`, `hari`, `tanggal`, `mesin`, `nama_operator`, `nama_produk`, `acuan_sampling`, `aql_check`, `status_produk`, `temuan_defect`, `created_at`, `updated_at`) VALUES
(1, 'Selasa', '2025-06-15 17:00:00', 'ANu', 'samndlkasn', '1', 'sadml;ad', 'lklkjdfjdsf', 'HOLD', 'lkadlkaslkdasd', '2025-06-16 04:06:06', '2025-06-16 04:06:06'),
(2, NULL, '2025-06-18 17:00:00', 'Mesin Jahit', 'fsfsdfsd', '1', 'fsdfsdfs', 'fsdfds', 'OK', 'sdfsdfds', '2025-06-18 12:56:21', '2025-06-18 16:00:37');

-- --------------------------------------------------------

--
-- Table structure for table `master_produk`
--

CREATE TABLE `master_produk` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `customer` varchar(255) DEFAULT NULL,
  `kode_barang` varchar(255) DEFAULT NULL,
  `nama_produk` varchar(255) DEFAULT NULL,
  `bahan` varchar(255) DEFAULT NULL,
  `tebal_bahan` varchar(255) DEFAULT NULL,
  `gramature` varchar(255) DEFAULT NULL,
  `dimensi` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `gramature_min` decimal(8,2) DEFAULT NULL,
  `gramature_standar` decimal(8,2) DEFAULT NULL,
  `gramature_max` decimal(8,2) DEFAULT NULL,
  `dimensi_panjang` decimal(8,2) DEFAULT NULL,
  `dimensi_lebar` decimal(8,2) DEFAULT NULL,
  `dimensi_tinggi` decimal(8,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `master_produk`
--

INSERT INTO `master_produk` (`id`, `customer`, `kode_barang`, `nama_produk`, `bahan`, `tebal_bahan`, `gramature`, `dimensi`, `created_at`, `updated_at`, `gramature_min`, `gramature_standar`, `gramature_max`, `dimensi_panjang`, `dimensi_lebar`, `dimensi_tinggi`) VALUES
(1, 'Sofyan', 'TE32S', 'Test', 'Cotton', '2', 'Min', 'Lebar', '2025-05-26 07:32:19', '2025-05-26 07:32:19', NULL, NULL, NULL, NULL, NULL, NULL),
(2, 'jbdfkjfbs', '623467ahjgdf', 'gfahfg', 'fjkws', '123', NULL, NULL, '2025-06-16 16:13:41', '2025-06-16 16:13:41', NULL, NULL, NULL, NULL, NULL, NULL),
(3, 'dfsdf', 'qecasf213', 'asdasd', 'fsdf', '122', NULL, NULL, '2025-06-16 17:05:31', '2025-06-16 17:05:31', 12.40, 12.50, 12.60, 12.00, 12.00, 12.00),
(4, 'Senpai', 'hagdgdauy', 'Jahe', 'jbsdf', '123', NULL, NULL, '2025-06-18 15:17:29', '2025-06-18 15:17:29', 12.30, 12.40, 23.00, 12.50, 12.40, 12.30);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2014_10_12_200000_add_two_factor_columns_to_users_table', 1),
(4, '2019_08_19_000000_create_failed_jobs_table', 1),
(5, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(6, '2023_01_05_082912_create_hakakses_table', 1),
(7, '2023_08_19_092704_create_permission_tables', 1),
(8, '2023_08_20_084236_create_settings_table', 1),
(9, '2025_05_20_084237_create_office_tables', 1),
(10, '2025_06_16_155741_add_foto_to_kelola_permasalahan_table', 2),
(11, '2025_06_16_222716_add_dimensi_to_data_hasil_qc_table', 3),
(12, '2025_06_17_000412_add_dimensi_gramature_to_master_produk', 4);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `level` int(11) DEFAULT NULL,
  `group` int(11) DEFAULT NULL,
  `icon` varchar(255) DEFAULT NULL,
  `position` int(11) DEFAULT NULL,
  `route` varchar(255) DEFAULT NULL,
  `with_sumber` tinyint(1) DEFAULT 0,
  `type` varchar(255) DEFAULT NULL,
  `description` longtext DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `level`, `group`, `icon`, `position`, `route`, `with_sumber`, `type`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Dashboard', 'web', 1, 1, 'fa-solid fa-chart-line', 1, 'dashboard', 0, 'static', 'Dashboard', NULL, NULL),
(2, 'Data Hasil Produksi', 'web', 1, 1, 'fa-solid fa-industry', 1, 'data_hasil_produksi', 0, 'static', 'Data Hasil Produk', NULL, NULL),
(3, 'Data Hasil QC', 'web', 1, 1, 'fa-solid fa-check-circle', 1, 'data_hasil_qc', 0, 'static', 'Data Hasil QC', NULL, NULL),
(4, 'Laporan Hasil Produksi', 'web', 1, 1, 'fa-solid fa-file-lines', 1, 'laporan_hasil_produksi', 0, 'static', 'Laporan Hasil Produk', NULL, NULL),
(5, 'Kelola Permasalahan', 'web', 1, 1, 'fa-solid fa-triangle-exclamation', 1, 'kelola_permasalahan', 0, 'static', 'Kelola Permasalahan', NULL, NULL),
(6, 'Master Produk', 'web', 1, 1, 'fa-solid fa-boxes-stacked', 1, 'master_produk', 0, 'static', 'Master Produk', NULL, NULL),
(7, 'Settings', 'web', 1, 100, 'fa-solid fa-bars', 100, 'settings', 0, 'dropdown', 'settings', NULL, NULL),
(8, 'User Management', 'web', 2, 100, 'ri-file-user-line', 1, 'settings.user', 0, 'static', 'User Management', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `description` longtext DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'admin_qc', 'web', NULL, '2025-05-26 07:32:18', '2025-05-26 07:32:18'),
(2, 'pimpinan', 'web', NULL, '2025-05-26 07:32:18', '2025-05-26 07:32:18'),
(3, 'qc_inline', 'web', NULL, '2025-05-26 07:32:18', '2025-05-26 07:32:18');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 1),
(1, 2),
(1, 3),
(2, 1),
(2, 2),
(2, 3),
(3, 1),
(3, 2),
(3, 3),
(4, 1),
(4, 2),
(4, 3),
(5, 1),
(5, 2),
(5, 3),
(6, 1),
(7, 1),
(8, 1);

-- --------------------------------------------------------

--
-- Table structure for table `role_has_user`
--

CREATE TABLE `role_has_user` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `user_type` varchar(255) NOT NULL DEFAULT 'AppModelsUser'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_has_user`
--

INSERT INTO `role_has_user` (`role_id`, `user_id`, `user_type`) VALUES
(1, 1, 'AppModelsUser'),
(2, 2, 'AppModelsUser'),
(3, 3, 'AppModelsUser'),
(1, 4, 'AppModelsUser');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` char(36) NOT NULL,
  `name` varchar(255) NOT NULL,
  `data` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`data`)),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `name`, `data`, `created_at`, `updated_at`) VALUES
('0fc172ac-7d5e-4e25-a98f-a678b690e602', 'General', '{\"logo\": \"{\\\"sm\\\":\\\"logo-sm.png\\\",\\\"dark\\\":\\\"logo-dark.png\\\",\\\"light\\\":\\\"logo-light.png\\\"}\", \"role\": \"User\"}', '2025-05-26 07:32:19', '2025-05-26 07:32:19');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `log_user` varchar(255) DEFAULT NULL,
  `tanggal_login` timestamp NULL DEFAULT NULL,
  `tanggal_logout` timestamp NULL DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `two_factor_secret` text DEFAULT NULL,
  `two_factor_recovery_codes` text DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `email`, `log_user`, `tanggal_login`, `tanggal_logout`, `email_verified_at`, `password`, `two_factor_secret`, `two_factor_recovery_codes`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin QC', 'admin_qc', 'admin_qc@gmail.com', 'login', '2025-06-18 12:39:30', NULL, '2025-05-26 07:32:18', '$2y$10$c6QmixWtCEY1QJ/qKcpFaOq3AmSh5eU48zr5rmqYi5L50.0aAWat6', NULL, NULL, 'IWRbLoeD3C', '2025-05-26 07:32:18', '2025-06-18 12:39:30'),
(2, 'Pimpinan', 'pimpinan', 'pimpinan@gmail.com', 'login', '2025-06-19 06:24:17', NULL, '2025-05-26 07:32:18', '$2y$10$5.pKBjuV.ga6fnEzsgaDre/FCNOujcpebEzPPUWfnR2XocZCZJETe', NULL, NULL, '8jkgttzopMR4lxkqxZ7XgFCKemDVsXfxKUWBGxid8zxyQpEn4AlDRZVFO03O', '2025-05-26 07:32:18', '2025-06-19 06:24:17'),
(3, 'QC Inline', 'qc_inline', 'qc_inline@gmail.com', 'login', '2025-05-26 07:34:53', NULL, '2025-05-26 07:32:18', '$2y$10$JDQmaX0XIYwfuAZLc0KKfOAitJLO.t2//H9hwGJQwDbI7k5KW.lQO', NULL, NULL, 'S9lTXfZSeh', '2025-05-26 07:32:18', '2025-05-26 07:34:53'),
(4, 'Admin Sistem', 'admin123', 'admin@gmail.com', 'login', '2025-06-16 03:58:42', NULL, '2025-06-16 04:03:47', '$2y$10$/Tn9CRvgquv7bSe8ju55q.0J/9mCryxfSmoSss4n49yuMn947VvFK', NULL, NULL, NULL, '2025-06-16 03:52:57', '2025-06-16 04:03:47');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `data_hasil_produksi`
--
ALTER TABLE `data_hasil_produksi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `data_hasil_qc`
--
ALTER TABLE `data_hasil_qc`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `hakakses`
--
ALTER TABLE `hakakses`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `hakakses_name_unique` (`name`);

--
-- Indexes for table `hakakses_permission`
--
ALTER TABLE `hakakses_permission`
  ADD PRIMARY KEY (`id`),
  ADD KEY `hakakses_permission_permission_id_foreign` (`permission_id`),
  ADD KEY `hakakses_permission_hakakses_id_foreign` (`hakakses_id`),
  ADD KEY `hakakses_permission_role_id_foreign` (`role_id`);

--
-- Indexes for table `kelola_permasalahan`
--
ALTER TABLE `kelola_permasalahan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `laporan_hasil_produksi`
--
ALTER TABLE `laporan_hasil_produksi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `master_produk`
--
ALTER TABLE `master_produk`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `role_has_user`
--
ALTER TABLE `role_has_user`
  ADD KEY `role_has_user_role_id_foreign` (`role_id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `data_hasil_produksi`
--
ALTER TABLE `data_hasil_produksi`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `data_hasil_qc`
--
ALTER TABLE `data_hasil_qc`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hakakses`
--
ALTER TABLE `hakakses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `hakakses_permission`
--
ALTER TABLE `hakakses_permission`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `kelola_permasalahan`
--
ALTER TABLE `kelola_permasalahan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `laporan_hasil_produksi`
--
ALTER TABLE `laporan_hasil_produksi`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `master_produk`
--
ALTER TABLE `master_produk`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `hakakses_permission`
--
ALTER TABLE `hakakses_permission`
  ADD CONSTRAINT `hakakses_permission_hakakses_id_foreign` FOREIGN KEY (`hakakses_id`) REFERENCES `hakakses` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `hakakses_permission_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `hakakses_permission_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_has_user`
--
ALTER TABLE `role_has_user`
  ADD CONSTRAINT `role_has_user_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
