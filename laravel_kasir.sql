-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 18, 2022 at 05:29 PM
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
-- Database: `laravel_kasir`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `create_categories` (`id_category` INT(10), `name_category` VARCHAR(255), `created_at` TIMESTAMP, `updated_at` TIMESTAMP)  BEGIN
    
    INSERT INTO categories
    VALUES (id_category, name_category, created_at, updated_at);
    END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `create_products` (`id_product` INT(10), `id_category` INT(10), `code_product` VARCHAR(255), `name_product` VARCHAR(255), `brand` VARCHAR(255), `purchase_price` INT(11), `discount` TINYINT(4), `selling_price` INT(11), `stock` INT(11), `created_at` TIMESTAMP, `updated_at` TIMESTAMP)  BEGIN
    
    INSERT INTO products
    VALUES (id_product, id_category, code_product, name_product, brand, purchase_price, discount, selling_price, stock, created_at, updated_at);
    END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `activity_log`
--

CREATE TABLE `activity_log` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `log_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `subject_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subject_id` bigint(20) UNSIGNED DEFAULT NULL,
  `causer_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `causer_id` bigint(20) UNSIGNED DEFAULT NULL,
  `properties` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`properties`)),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `activity_log`
--

INSERT INTO `activity_log` (`id`, `log_name`, `description`, `subject_type`, `subject_id`, `causer_type`, `causer_id`, `properties`, `created_at`, `updated_at`) VALUES
(1, 'default', 'Membuka menu daftar pengguna', NULL, NULL, 'App\\Models\\User', 14, '[]', '2022-05-15 11:41:13', '2022-05-15 11:41:13'),
(2, 'default', 'Menambahkan pengguna baru', NULL, NULL, 'App\\Models\\User', 14, '[]', '2022-05-15 11:41:30', '2022-05-15 11:41:30'),
(3, 'default', 'Membuka menu daftar pengguna', NULL, NULL, 'App\\Models\\User', 14, '[]', '2022-05-15 11:41:33', '2022-05-15 11:41:33'),
(4, 'default', 'Membuka menu daftar pengguna', NULL, NULL, 'App\\Models\\User', 14, '[]', '2022-05-15 11:45:38', '2022-05-15 11:45:38'),
(5, 'default', 'Menambahkan produk baru', NULL, NULL, 'App\\Models\\User', 15, '[]', '2022-05-15 12:53:02', '2022-05-15 12:53:02'),
(6, 'default', 'Membuka menu daftar produk', NULL, NULL, 'App\\Models\\User', 15, '[]', '2022-05-15 12:53:08', '2022-05-15 12:53:08'),
(7, 'default', 'Membuka menu daftar produk', NULL, NULL, 'App\\Models\\User', 15, '[]', '2022-05-15 12:54:58', '2022-05-15 12:54:58'),
(8, 'default', 'Membuka menu riwayat transaksi', NULL, NULL, 'App\\Models\\User', 15, '[]', '2022-05-15 13:15:14', '2022-05-15 13:15:14'),
(9, 'default', 'Membuka menu riwayat transaksi', NULL, NULL, 'App\\Models\\User', 5, '[]', '2022-05-15 13:15:35', '2022-05-15 13:15:35'),
(10, 'default', 'Membuka menu riwayat transaksi', NULL, NULL, 'App\\Models\\User', 5, '[]', '2022-05-15 13:16:46', '2022-05-15 13:16:46'),
(11, 'default', 'Membuka menu riwayat transaksi', NULL, NULL, 'App\\Models\\User', 5, '[]', '2022-05-15 13:19:02', '2022-05-15 13:19:02'),
(12, 'default', 'Membuka menu riwayat transaksi', NULL, NULL, 'App\\Models\\User', 5, '[]', '2022-05-15 13:20:03', '2022-05-15 13:20:03'),
(13, 'default', 'Membuka menu riwayat transaksi', NULL, NULL, 'App\\Models\\User', 5, '[]', '2022-05-15 13:20:31', '2022-05-15 13:20:31'),
(14, 'default', 'Membuka menu daftar pengguna', NULL, NULL, 'App\\Models\\User', 14, '[]', '2022-05-15 13:21:06', '2022-05-15 13:21:06'),
(15, 'default', 'Membuka menu riwayat transaksi', NULL, NULL, 'App\\Models\\User', 15, '[]', '2022-05-15 13:29:31', '2022-05-15 13:29:31'),
(16, 'default', 'Membuka menu riwayat transaksi', NULL, NULL, 'App\\Models\\User', 15, '[]', '2022-05-15 13:31:23', '2022-05-15 13:31:23'),
(17, 'default', 'Membuka menu riwayat transaksi', NULL, NULL, 'App\\Models\\User', 15, '[]', '2022-05-15 13:32:48', '2022-05-15 13:32:48'),
(18, 'default', 'Membuka menu daftar kategori', NULL, NULL, 'App\\Models\\User', 15, '[]', '2022-05-15 13:34:12', '2022-05-15 13:34:12'),
(19, 'default', 'Membuka menu riwayat transaksi', NULL, NULL, 'App\\Models\\User', 14, '[]', '2022-05-16 05:27:53', '2022-05-16 05:27:53'),
(20, 'default', 'Membuka menu riwayat transaksi', NULL, NULL, 'App\\Models\\User', 14, '[]', '2022-05-16 05:28:00', '2022-05-16 05:28:00'),
(21, 'default', 'Membuka menu daftar pengguna', NULL, NULL, 'App\\Models\\User', 14, '[]', '2022-05-16 05:37:04', '2022-05-16 05:37:04'),
(22, 'default', 'Membuka menu pengaturan', NULL, NULL, 'App\\Models\\User', 14, '[]', '2022-05-16 06:17:12', '2022-05-16 06:17:12'),
(23, 'default', 'Membuka menu pengaturan', NULL, NULL, 'App\\Models\\User', 14, '[]', '2022-05-16 06:17:18', '2022-05-16 06:17:18'),
(24, 'default', 'Membuka menu pengaturan', NULL, NULL, 'App\\Models\\User', 14, '[]', '2022-05-16 06:21:33', '2022-05-16 06:21:33'),
(25, 'default', 'Membuka menu daftar pengguna', NULL, NULL, 'App\\Models\\User', 14, '[]', '2022-05-16 06:30:02', '2022-05-16 06:30:02'),
(26, 'default', 'Membuka menu pengaturan', NULL, NULL, 'App\\Models\\User', 14, '[]', '2022-05-16 06:30:04', '2022-05-16 06:30:04'),
(27, 'default', 'Membuka menu daftar kategori', NULL, NULL, 'App\\Models\\User', 15, '[]', '2022-05-16 06:52:52', '2022-05-16 06:52:52'),
(28, 'default', 'Membuka menu daftar produk', NULL, NULL, 'App\\Models\\User', 15, '[]', '2022-05-16 08:06:33', '2022-05-16 08:06:33'),
(29, 'default', 'Membuka menu riwayat transaksi', NULL, NULL, 'App\\Models\\User', 15, '[]', '2022-05-16 08:28:39', '2022-05-16 08:28:39'),
(30, 'default', 'Membuka menu laporan pendapatan', NULL, NULL, 'App\\Models\\User', 15, '[]', '2022-05-16 08:28:41', '2022-05-16 08:28:41'),
(31, 'default', 'Membuka menu riwayat transaksi', NULL, NULL, 'App\\Models\\User', 15, '[]', '2022-05-16 08:28:49', '2022-05-16 08:28:49'),
(32, 'default', 'Membuka menu laporan pendapatan', NULL, NULL, 'App\\Models\\User', 15, '[]', '2022-05-16 08:56:05', '2022-05-16 08:56:05'),
(33, 'default', 'Membuka menu riwayat transaksi', NULL, NULL, 'App\\Models\\User', 15, '[]', '2022-05-16 08:56:33', '2022-05-16 08:56:33'),
(34, 'default', 'Membuka menu laporan pendapatan', NULL, NULL, 'App\\Models\\User', 15, '[]', '2022-05-16 08:56:39', '2022-05-16 08:56:39'),
(35, 'default', 'Membuka menu laporan pendapatan', NULL, NULL, 'App\\Models\\User', 15, '[]', '2022-05-16 09:09:07', '2022-05-16 09:09:07'),
(36, 'default', 'Membuka menu riwayat transaksi', NULL, NULL, 'App\\Models\\User', 5, '[]', '2022-05-16 18:52:55', '2022-05-16 18:52:55'),
(37, 'default', 'Membuka menu daftar kategori', NULL, NULL, 'App\\Models\\User', 15, '[]', '2022-05-16 18:54:37', '2022-05-16 18:54:37'),
(38, 'default', 'Membuka menu daftar produk', NULL, NULL, 'App\\Models\\User', 15, '[]', '2022-05-16 18:54:53', '2022-05-16 18:54:53'),
(39, 'default', 'Membuka menu daftar produk', NULL, NULL, 'App\\Models\\User', 15, '[]', '2022-05-16 18:56:10', '2022-05-16 18:56:10'),
(40, 'default', 'Membuka menu riwayat transaksi', NULL, NULL, 'App\\Models\\User', 15, '[]', '2022-05-16 18:56:35', '2022-05-16 18:56:35'),
(41, 'default', 'Membuka menu laporan pendapatan', NULL, NULL, 'App\\Models\\User', 15, '[]', '2022-05-16 18:56:42', '2022-05-16 18:56:42'),
(42, 'default', 'Membuka menu daftar pengguna', NULL, NULL, 'App\\Models\\User', 14, '[]', '2022-05-16 19:00:59', '2022-05-16 19:00:59'),
(43, 'default', 'Membuka menu pengaturan', NULL, NULL, 'App\\Models\\User', 14, '[]', '2022-05-16 19:01:04', '2022-05-16 19:01:04'),
(44, 'default', 'Membuka menu riwayat transaksi', NULL, NULL, 'App\\Models\\User', 5, '[]', '2022-05-18 14:55:12', '2022-05-18 14:55:12'),
(45, 'default', 'Membuka menu riwayat transaksi', NULL, NULL, 'App\\Models\\User', 5, '[]', '2022-05-18 15:14:57', '2022-05-18 15:14:57'),
(46, 'default', 'Membuka menu riwayat transaksi', NULL, NULL, 'App\\Models\\User', 5, '[]', '2022-05-18 15:15:23', '2022-05-18 15:15:23'),
(47, 'default', 'Membuka menu riwayat transaksi', NULL, NULL, 'App\\Models\\User', 5, '[]', '2022-05-18 15:24:07', '2022-05-18 15:24:07');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id_category` int(10) UNSIGNED NOT NULL,
  `name_category` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id_category`, `name_category`, `created_at`, `updated_at`) VALUES
(1, 'Makanan', '2022-04-08 23:40:54', '2022-04-08 23:40:54'),
(5, 'Minuman', '2022-04-09 21:57:58', '2022-04-09 21:57:58'),
(9, 'cekin', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
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
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2014_10_12_200000_add_two_factor_columns_to_users_table', 1),
(4, '2019_08_19_000000_create_failed_jobs_table', 1),
(5, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(6, '2022_03_16_040813_create_field_news_to_users_table', 1),
(7, '2022_03_16_042904_create_categories_table', 1),
(8, '2022_03_16_043309_create_products_table', 1),
(9, '2022_03_16_044508_create_members_table', 1),
(10, '2022_03_16_045755_create_suppliers_table', 1),
(11, '2022_03_16_050335_create_purchases_table', 1),
(12, '2022_03_16_051508_create_purchase_details_table', 1),
(13, '2022_03_16_051638_create_sales_table', 1),
(14, '2022_03_16_051735_create_sales_details_table', 1),
(15, '2022_03_16_051820_create_setting_table', 1),
(16, '2022_03_16_055420_create_expenditure_table', 1),
(17, '2022_03_25_165607_create_sessions_table', 1),
(18, '2022_03_30_145818_create_sessions_table', 2),
(19, '2022_04_10_054517_create_foreign_key_to_products_table', 3),
(20, '2022_04_11_025147_create_code_to_products_table', 4),
(21, '2022_04_11_031148_create_code_to_products_table', 5),
(22, '2022_04_16_030236_create_discount_to_setting_table', 6),
(23, '2022_05_06_220837_create_table_to_sales_details_table', 7),
(24, '2022_05_15_130908_create_users_aktivity_table', 8),
(25, '2022_05_15_172833_create_activity_log_table', 9);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id_product` int(10) UNSIGNED NOT NULL,
  `id_category` int(10) UNSIGNED NOT NULL,
  `code_product` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_product` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `brand` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `purchase_price` int(11) NOT NULL,
  `discount` tinyint(4) NOT NULL DEFAULT 0,
  `selling_price` int(11) NOT NULL,
  `stock` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id_product`, `id_category`, `code_product`, `name_product`, `brand`, `purchase_price`, `discount`, `selling_price`, `stock`, `created_at`, `updated_at`) VALUES
(27, 5, 'P000001', 'Kopi Susu Jahe', 'Tidak Ada Merk', 15000, 0, 15000, 17, '2022-04-27 13:46:59', '2022-05-18 15:24:38'),
(28, 5, 'P000028', 'Kopi Luak', 'Tidak Ada Merk', 20000, 0, 20000, 38, '2022-04-27 13:47:39', '2022-05-18 15:24:38'),
(29, 1, 'P000029', 'roti babakaran', 'Tidak Ada Merk', 13000, 0, 13000, 93, '2022-05-15 12:53:02', '2022-05-18 15:24:38');

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `id_sale` int(10) UNSIGNED NOT NULL,
  `total_items` int(11) NOT NULL,
  `total_price` int(11) NOT NULL,
  `pay` int(11) NOT NULL DEFAULT 0,
  `accepted` int(11) NOT NULL DEFAULT 0,
  `id_user` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`id_sale`, `total_items`, `total_price`, `pay`, `accepted`, `id_user`, `created_at`, `updated_at`) VALUES
(85, 1, 20000, 20000, 20000, 5, '2022-05-05 02:08:28', '2022-05-05 02:08:34'),
(86, 3, 50000, 50000, 50000, 5, '2022-05-05 02:08:34', '2022-05-05 02:13:47'),
(99, 3, 55000, 55000, 55000, 5, '2022-05-05 09:43:47', '2022-05-05 09:44:19'),
(100, 2, 35000, 35000, 35000, 5, '2022-05-05 13:31:32', '2022-05-05 14:08:52'),
(101, 2, 35000, 35000, 35000, 5, '2022-05-06 05:33:49', '2022-05-06 05:34:07'),
(102, 3, 60000, 60000, 60000, 5, '2022-05-06 14:22:20', '2022-05-06 16:58:03'),
(103, 3, 60000, 60000, 60000, 5, '2022-05-06 17:07:44', '2022-05-06 17:08:05'),
(104, 1, 15000, 15000, 15000, 5, '2022-05-06 17:20:11', '2022-05-06 17:20:22'),
(105, 2, 35000, 35000, 50000, 5, '2022-05-06 17:24:17', '2022-05-06 17:24:29'),
(106, 4, 70000, 70000, 100000, 5, '2022-05-07 07:33:54', '2022-05-07 07:34:20'),
(107, 0, 0, 0, 0, 5, '2022-05-08 03:41:55', '2022-05-08 03:41:55'),
(108, 0, 0, 0, 0, 5, '2022-05-08 10:33:59', '2022-05-08 10:33:59'),
(109, 1, 15000, 15000, 20000, 5, '2022-05-08 10:34:02', '2022-05-08 10:34:14'),
(110, 1, 15000, 15000, 20000, 5, '2022-05-08 14:11:03', '2022-05-08 14:11:17'),
(111, 2, 35000, 35000, 100000, 5, '2022-05-08 14:14:37', '2022-05-08 14:14:50'),
(112, 0, 0, 0, 0, 5, '2022-05-11 03:07:06', '2022-05-11 03:07:06'),
(113, 0, 0, 0, 0, 15, '2022-05-15 00:59:09', '2022-05-15 00:59:09'),
(114, 0, 0, 0, 0, 5, '2022-05-15 01:03:04', '2022-05-15 01:03:04'),
(115, 0, 0, 0, 0, 5, '2022-05-15 01:03:13', '2022-05-15 01:03:13'),
(116, 0, 0, 0, 0, 5, '2022-05-15 01:18:09', '2022-05-15 01:18:09'),
(117, 0, 0, 0, 0, 5, '2022-05-15 02:25:01', '2022-05-15 02:25:01'),
(118, 0, 0, 0, 0, 5, '2022-05-16 01:51:47', '2022-05-16 01:51:47'),
(119, 2, 33000, 33000, 50000, 5, '2022-05-16 04:22:28', '2022-05-16 04:22:46'),
(120, 0, 0, 0, 0, 5, '2022-05-16 09:27:21', '2022-05-16 09:27:21'),
(121, 0, 0, 0, 0, 5, '2022-05-16 18:52:39', '2022-05-16 18:52:39'),
(122, 0, 0, 0, 0, 5, '2022-05-16 18:52:43', '2022-05-16 18:52:43'),
(123, 3, 45000, 45000, 50000, 5, '2022-05-18 14:49:08', '2022-05-18 14:49:22'),
(124, 10, 200000, 200000, 200000, 5, '2022-05-18 14:52:51', '2022-05-18 14:53:27'),
(125, 1, 20000, 20000, 0, 5, '2022-05-18 14:54:25', '2022-05-18 14:54:40'),
(126, 1, 20000, 20000, 0, 5, '2022-05-18 14:54:51', '2022-05-18 14:55:04'),
(127, 1, 20000, 20000, 0, 5, '2022-05-18 14:55:32', '2022-05-18 15:12:51'),
(128, 1, 20000, 20000, 0, 5, '2022-05-18 15:12:58', '2022-05-18 15:13:05'),
(129, 0, 0, 0, 0, 5, '2022-05-18 15:13:15', '2022-05-18 15:13:15'),
(130, 1, 20000, 20000, 0, 5, '2022-05-18 15:15:34', '2022-05-18 15:16:34'),
(131, 1, 15000, 15000, 0, 5, '2022-05-18 15:16:39', '2022-05-18 15:16:47'),
(132, 2, 35000, 35000, 0, 5, '2022-05-18 15:17:01', '2022-05-18 15:17:23'),
(133, 6, 96000, 96000, 0, 5, '2022-05-18 15:17:32', '2022-05-18 15:18:25'),
(134, 11, 165000, 165000, 200000, 5, '2022-05-18 15:19:08', '2022-05-18 15:21:13'),
(135, 3, 48000, 48000, 50000, 5, '2022-05-18 15:23:32', '2022-05-18 15:23:53'),
(136, 3, 48000, 48000, 50000, 5, '2022-05-18 15:24:16', '2022-05-18 15:24:38');

-- --------------------------------------------------------

--
-- Table structure for table `sales_details`
--

CREATE TABLE `sales_details` (
  `id_sale_details` int(10) UNSIGNED NOT NULL,
  `id_sale` int(11) NOT NULL,
  `table` int(11) DEFAULT NULL,
  `id_product` int(11) NOT NULL,
  `selling_price` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `subtotal` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sales_details`
--

INSERT INTO `sales_details` (`id_sale_details`, `id_sale`, `table`, `id_product`, `selling_price`, `total`, `subtotal`, `created_at`, `updated_at`) VALUES
(66, 85, 0, 28, 20000, 10, 20000, '2022-05-05 02:08:32', '2022-05-05 02:08:32'),
(67, 86, 0, 27, 15000, 1, 15000, '2022-05-05 02:13:24', '2022-05-05 02:13:24'),
(68, 86, 0, 27, 15000, 1, 15000, '2022-05-05 02:13:27', '2022-05-05 02:13:27'),
(69, 86, 0, 28, 20000, 1, 20000, '2022-05-05 02:13:32', '2022-05-05 02:13:32'),
(72, 99, 0, 28, 20000, 2, 40000, '2022-05-05 09:43:51', '2022-05-05 09:43:56'),
(73, 99, 0, 27, 15000, 2, 30000, '2022-05-05 09:43:55', '2022-05-05 09:43:58'),
(74, 100, 0, 28, 20000, 1, 20000, '2022-05-05 14:08:45', '2022-05-05 14:08:45'),
(75, 100, 0, 27, 15000, 1, 15000, '2022-05-05 14:08:48', '2022-05-05 14:08:48'),
(76, 101, 0, 28, 20000, 1, 20000, '2022-05-06 05:33:55', '2022-05-06 05:33:55'),
(77, 101, 0, 27, 15000, 1, 15000, '2022-05-06 05:33:59', '2022-05-06 05:33:59'),
(78, 102, 0, 28, 20000, 2, 40000, '2022-05-06 14:22:23', '2022-05-06 16:57:45'),
(79, 103, NULL, 28, 20000, 3, 60000, '2022-05-06 17:07:54', '2022-05-06 17:07:57'),
(80, 104, NULL, 27, 15000, 1, 15000, '2022-05-06 17:20:17', '2022-05-06 17:20:17'),
(81, 105, NULL, 28, 20000, 1, 20000, '2022-05-06 17:24:21', '2022-05-06 17:24:21'),
(82, 105, NULL, 27, 15000, 1, 15000, '2022-05-06 17:24:23', '2022-05-06 17:24:23'),
(83, 106, NULL, 28, 20000, 2, 40000, '2022-05-07 07:34:01', '2022-05-07 07:34:12'),
(84, 106, NULL, 27, 15000, 2, 30000, '2022-05-07 07:34:10', '2022-05-07 07:34:13'),
(85, 109, NULL, 27, 15000, 1, 15000, '2022-05-08 10:34:07', '2022-05-08 10:34:07'),
(86, 110, NULL, 27, 15000, 1, 15000, '2022-05-08 14:11:13', '2022-05-08 14:11:13'),
(87, 111, NULL, 28, 20000, 1, 20000, '2022-05-08 14:14:41', '2022-05-08 14:14:41'),
(88, 111, NULL, 27, 15000, 1, 15000, '2022-05-08 14:14:43', '2022-05-08 14:14:43'),
(89, 118, NULL, 28, 20000, 1, 20000, '2022-05-16 01:51:55', '2022-05-16 01:51:55'),
(90, 119, NULL, 28, 20000, 1, 20000, '2022-05-16 04:22:38', '2022-05-16 04:22:38'),
(91, 119, NULL, 29, 13000, 1, 13000, '2022-05-16 04:22:42', '2022-05-16 04:22:42'),
(93, 120, NULL, 28, 20000, 2, 20000, '2022-05-16 09:28:03', '2022-05-16 09:28:03'),
(94, 123, NULL, 27, 15000, 3, 45000, '2022-05-18 14:49:14', '2022-05-18 14:49:17'),
(95, 124, NULL, 28, 20000, 10, 200000, '2022-05-18 14:53:03', '2022-05-18 14:53:23'),
(96, 125, NULL, 28, 20000, 1, 20000, '2022-05-18 14:54:32', '2022-05-18 14:54:32'),
(97, 126, NULL, 28, 20000, 2, 40000, '2022-05-18 14:54:57', '2022-05-18 14:55:01'),
(100, 127, NULL, 28, 20000, 1, 20000, '2022-05-18 15:12:40', '2022-05-18 15:12:40'),
(101, 128, NULL, 28, 20000, 1, 20000, '2022-05-18 15:13:02', '2022-05-18 15:13:02'),
(102, 130, NULL, 28, 20000, 1, 20000, '2022-05-18 15:16:24', '2022-05-18 15:16:24'),
(103, 131, NULL, 27, 15000, 2, 30000, '2022-05-18 15:16:43', '2022-05-18 15:16:45'),
(104, 132, NULL, 27, 15000, 1, 15000, '2022-05-18 15:17:05', '2022-05-18 15:17:05'),
(105, 132, NULL, 28, 20000, 1, 20000, '2022-05-18 15:17:08', '2022-05-18 15:17:08'),
(106, 133, NULL, 28, 20000, 2, 40000, '2022-05-18 15:17:58', '2022-05-18 15:18:09'),
(107, 133, NULL, 27, 15000, 2, 30000, '2022-05-18 15:18:01', '2022-05-18 15:18:10'),
(108, 133, NULL, 29, 13000, 2, 26000, '2022-05-18 15:18:03', '2022-05-18 15:18:15'),
(110, 134, NULL, 27, 15000, 11, 165000, '2022-05-18 15:21:03', '2022-05-18 15:21:06'),
(111, 135, NULL, 28, 20000, 1, 20000, '2022-05-18 15:23:35', '2022-05-18 15:23:35'),
(112, 135, NULL, 27, 15000, 1, 15000, '2022-05-18 15:23:37', '2022-05-18 15:23:37'),
(113, 135, NULL, 29, 13000, 1, 13000, '2022-05-18 15:23:39', '2022-05-18 15:23:39'),
(114, 136, NULL, 28, 20000, 1, 20000, '2022-05-18 15:24:21', '2022-05-18 15:24:21'),
(115, 136, NULL, 27, 15000, 1, 15000, '2022-05-18 15:24:24', '2022-05-18 15:24:24'),
(116, 136, NULL, 29, 13000, 1, 13000, '2022-05-18 15:24:26', '2022-05-18 15:24:26');

--
-- Triggers `sales_details`
--
DELIMITER $$
CREATE TRIGGER `stock` BEFORE UPDATE ON `sales_details` FOR EACH ROW UPDATE products SET stock = stock - NEW.total WHERE id_product = NEW.id_product
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payload` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('bmIO7HPHXbYnqLBGOTP7Es9V5xMH2pxdzr3s0lCR', 5, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/101.0.4951.67 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiNWZkU0NKUVppbXpQVVliek80TnBoVlJROGlXck56dkZPTFB6S0llTyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NTk6Imh0dHA6Ly9sb2NhbGhvc3QvMjAyMi9iZWxhamFyL2thc2lyLWxhcmF2ZWwvVHJhbnNhY3Rpb24vZW5kIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6NTtzOjc6ImlkX3NhbGUiO2k6MTM2O30=', 1652887478);

-- --------------------------------------------------------

--
-- Table structure for table `setting`
--

CREATE TABLE `setting` (
  `id_setting` int(10) UNSIGNED NOT NULL,
  `company_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nota_type` tinyint(4) NOT NULL,
  `path_logo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `setting`
--

INSERT INTO `setting` (`id_setting`, `company_name`, `address`, `phone`, `nota_type`, `path_logo`, `created_at`, `updated_at`) VALUES
(1, 'Kafe Bisa Ngoding', 'Jl. Niwarna No. 100', '085161321612', 2, '/img/logo-20220511100749.jfif', NULL, '2022-05-11 10:45:23');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `level` tinyint(4) NOT NULL DEFAULT 0,
  `two_factor_secret` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `two_factor_recovery_codes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `current_team_id` bigint(20) UNSIGNED DEFAULT NULL,
  `profile_photo_path` varchar(2048) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `level`, `two_factor_secret`, `two_factor_recovery_codes`, `remember_token`, `current_team_id`, `profile_photo_path`, `created_at`, `updated_at`) VALUES
(5, 'Kasir', 'kasir@kasir.com', NULL, '$2y$10$.60gforH0v2t1uyX.2/h9uU4z8VIPMhgY2L.Xt6UEWvEvprVKAmha', 0, NULL, NULL, NULL, NULL, '/img/logo-20220511153527.jfif', '2022-04-17 04:00:23', '2022-05-11 08:35:27'),
(14, 'Admin', 'admin@admin.com', NULL, '$2y$10$zEaidTxeN1xIUgRRSFQfXOVZ8a9Pyco7IXOn/lKnthtTMhRi6SNUq', 1, NULL, NULL, NULL, NULL, '/img/logo-20220515000138.jpg', '2022-05-14 16:47:49', '2022-05-14 17:01:38'),
(15, 'Manager', 'manager@manager.com', NULL, '$2y$10$eml2yCISaxPNJzGwEU3nK.AoIScwq7yblheNWZfbmCvHdB9DtZY3O', 2, NULL, NULL, NULL, NULL, '/img/logo-20220515074820.jfif', '2022-05-15 00:36:52', '2022-05-15 00:48:20'),
(16, 'dita', 'admin@kares.com', NULL, '$2y$10$6TEKk3F99igaDjrG5zIQCeKE/qm3Qr7QFDTy86MsVt60AXL9vf7ha', 0, NULL, NULL, NULL, NULL, '/img/user.png', '2022-05-15 11:41:30', '2022-05-15 11:41:30');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activity_log`
--
ALTER TABLE `activity_log`
  ADD PRIMARY KEY (`id`),
  ADD KEY `subject` (`subject_type`,`subject_id`),
  ADD KEY `causer` (`causer_type`,`causer_id`),
  ADD KEY `activity_log_log_name_index` (`log_name`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id_category`),
  ADD UNIQUE KEY `categories_nama_category_unique` (`name_category`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

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
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id_product`),
  ADD UNIQUE KEY `products_name_product_unique` (`name_product`),
  ADD UNIQUE KEY `products_code_product_unique` (`code_product`),
  ADD KEY `products_id_category_foreign` (`id_category`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`id_sale`);

--
-- Indexes for table `sales_details`
--
ALTER TABLE `sales_details`
  ADD PRIMARY KEY (`id_sale_details`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `setting`
--
ALTER TABLE `setting`
  ADD PRIMARY KEY (`id_setting`);

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
-- AUTO_INCREMENT for table `activity_log`
--
ALTER TABLE `activity_log`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id_category` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id_product` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `id_sale` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=137;

--
-- AUTO_INCREMENT for table `sales_details`
--
ALTER TABLE `sales_details`
  MODIFY `id_sale_details` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=117;

--
-- AUTO_INCREMENT for table `setting`
--
ALTER TABLE `setting`
  MODIFY `id_setting` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_id_category_foreign` FOREIGN KEY (`id_category`) REFERENCES `categories` (`id_category`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
