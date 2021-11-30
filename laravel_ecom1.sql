-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 30, 2021 at 04:37 PM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 7.4.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `laravel_ecom1`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE IF NOT EXISTS `admins` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `admins_email_unique` (`email`),
  UNIQUE KEY `admins_phone_unique` (`phone`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `phone`, `image`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'EvilGenius', 'sio@gmail.com', '01611223344', 'images/backend/admin/232425_13112021151318.jpg', '2021-11-03 07:12:54', '$2y$10$srxveuYn3IqTUS.mBVXxAeXGl420Tr3EKC0kzES3fjfonEMF2hCjK', 'uQhXRmNErGnpbPllFlZoG5LdoLQcTPV33jM034xUh5yV1d4ghyUQGaoVNAhB', '2021-11-03 07:12:54', '2021-11-13 09:13:29');

-- --------------------------------------------------------

--
-- Table structure for table `banner_sliders`
--

CREATE TABLE IF NOT EXISTS `banner_sliders` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `short_note` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `normal_title` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `colored_title` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `short_description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) DEFAULT 1 COMMENT '0=inactive, 1=live',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `banner_sliders`
--

INSERT INTO `banner_sliders` (`id`, `short_note`, `normal_title`, `colored_title`, `short_description`, `image`, `status`, `created_at`, `updated_at`) VALUES
(4, 'Fall 2021', 'Women Trends', NULL, 'This is the new trend description.', 'images/backend/banner-slider/1716507462771521_15112021151121.jpg', 1, '2021-11-15 09:11:21', '2021-11-17 10:29:49'),
(5, 'Spring 2022', 'Women', 'Fashion', 'This is the women fashion description.', 'images/backend/banner-slider/1716507546141170_15112021151240.jpg', 0, '2021-11-15 09:12:03', '2021-11-17 10:18:05'),
(6, 'Fall 2021', 'Best', 'Products', 'It is a long established fact that a reader', 'images/backend/banner-slider/1716692965529458_17112021161950.jpg', 1, '2021-11-17 10:19:50', '2021-11-17 10:30:22'),
(7, 'Summer 2022', 'New Collections', NULL, 'Lorem Ipsum is simply dummy text', 'images/backend/banner-slider/1716693304481395_17112021162513.jpg', 0, '2021-11-17 10:25:13', '2021-11-17 10:30:39'),
(8, 'Fall 2021', 'Mens', 'Fashion', NULL, 'images/backend/banner-slider/1716693518260923_17112021162837.jpg', 1, '2021-11-17 10:28:37', '2021-11-17 10:28:37');

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE IF NOT EXISTS `brands` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`id`, `name`, `image`, `slug`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Samsung', 'images/backend/brand/883242_samsung_11092021070538.png', 'samsung', NULL, '2021-11-08 01:05:38', '2021-11-09 01:05:38'),
(4, 'Oppo', 'images/backend/brand/931146_oppo_11092021095949.png', 'oppo', NULL, '2021-11-09 03:59:49', '2021-11-09 03:59:49'),
(5, 'Vivo', 'images/backend/brand/179999_vivo_11092021100020.png', 'vivo', NULL, '2021-11-09 04:00:20', '2021-11-09 04:00:20'),
(6, 'Apple', 'images/backend/brand/650610_apple_11092021164006.png', 'apple', NULL, '2021-11-09 04:01:55', '2021-11-10 00:59:19'),
(7, 'Nokia', 'images/backend/brand/342270_nokia_11092021100254.png', 'nokia', NULL, '2021-11-09 04:02:54', '2021-11-09 04:02:54'),
(10, 'Xiaomi', 'images/backend/brand/170021_xiaomi_11102021080052.png', 'xiaomi', '2021-11-10 02:01:30', '2021-11-10 02:00:52', '2021-11-10 02:01:30'),
(11, 'Xiaomi', 'images/backend/brand/925147_xiaomi_m_11102021080210.png', 'xiaomi', NULL, '2021-11-10 02:01:41', '2021-11-10 02:02:22'),
(12, 'Non brand', 'images/backend/brand/456323_non_brand_11182021074253.jpg', 'non-brand', NULL, '2021-11-14 08:26:43', '2021-11-20 02:09:08'),
(13, 'Ecstasy BD', 'images/backend/brand/265340_ecstasy_bd_11172021154412.jpg', 'ecstasy-bd', NULL, '2021-11-17 09:44:12', '2021-11-17 09:44:12'),
(14, 'Yellow BD', 'images/backend/brand/427291_yellow_bd_11172021154510.png', 'yellow-bd', NULL, '2021-11-17 09:45:10', '2021-11-17 09:45:10'),
(15, 'Local', 'images/backend/brand/255009_local_11272021184917.png', 'local', NULL, '2021-11-27 12:49:17', '2021-11-27 12:49:17'),
(16, 'Richman', 'images/backend/brand/509519_richman_11272021202240.jpg', 'richman', NULL, '2021-11-27 14:22:40', '2021-11-27 14:22:40'),
(17, 'Realme', 'images/backend/brand/966006_realme_11272021204132.jpg', 'realme', NULL, '2021-11-27 14:41:32', '2021-11-27 14:41:32');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) DEFAULT 1 COMMENT '0=inactive, 1=live',
  `parent_id` bigint(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `slug`, `status`, `parent_id`, `created_at`, `updated_at`) VALUES
(1, 'Clothing', 'clothing', 1, NULL, '2021-11-12 10:41:29', '2021-11-12 10:41:29'),
(4, 'Electronics', 'electronics', 1, NULL, '2021-11-13 08:04:29', '2021-11-13 08:04:29'),
(5, 'Mobile', 'mobile', 1, 4, '2021-11-13 08:26:08', '2021-11-13 08:26:08'),
(6, 'Women', 'women', 1, 1, '2021-11-16 09:42:43', '2021-11-16 09:42:43'),
(8, 'Men', 'men', 1, 1, '2021-11-17 09:46:03', '2021-11-17 09:46:03'),
(10, 'Formal Pants', 'formal-pants', 1, 8, '2021-11-17 09:48:07', '2021-11-17 09:48:07'),
(11, 'Jeans Pants', 'jeans-pants', 1, 8, '2021-11-17 09:48:19', '2021-11-17 09:48:19'),
(12, 'Salwar Kameez', 'salwar-kameez', 1, 6, '2021-11-17 09:58:20', '2021-11-17 09:58:20'),
(13, 'Bag', 'bag', 1, 6, '2021-11-17 10:05:10', '2021-11-17 10:05:10'),
(14, 'Groceries', 'groceries', 1, NULL, '2021-11-27 12:46:30', '2021-11-27 12:46:30'),
(15, 'Vegitables', 'vegitables', 1, 14, '2021-11-27 12:46:44', '2021-11-27 12:46:44'),
(16, 'Casual Shirts', 'casual-shirts', 1, 8, '2021-11-27 14:32:52', '2021-11-27 14:32:52');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2021_11_03_130049_create_admins_table', 1),
(6, '2021_11_09_061431_create_brands_table', 2),
(7, '2021_11_10_141113_create_categories_table', 3),
(8, '2021_11_12_160721_create_products_table', 4),
(9, '2021_11_13_145520_create_products_table', 5),
(10, '2021_11_14_155424_create_banner_sliders_table', 6),
(26, '2021_11_21_150059_create_shipping_divisions_table', 7),
(27, '2021_11_22_094127_create_orders_table', 7),
(28, '2021_11_22_101412_create_order_items_table', 7),
(29, '2021_11_26_174931_create_site_settings_table', 8);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE IF NOT EXISTS `orders` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `initial_amount` double NOT NULL,
  `discount_amount` double DEFAULT NULL,
  `amount` double NOT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `transaction_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `currency` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payment_method` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `delivered_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=128 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `name`, `phone`, `email`, `initial_amount`, `discount_amount`, `amount`, `city`, `address`, `transaction_id`, `currency`, `payment_method`, `status`, `user_id`, `delivered_at`, `deleted_at`, `created_at`, `updated_at`) VALUES
(120, 'Jhon Doe', '01122334455', 'user@gmail.com', 8789, 0, 8789, 'Dhaka', 'Dhaka 1212', 'TRX_61A246AD82250', 'BDT', 'cash on delivery', 'Delivered', 3, '2021-11-27 14:55:33', NULL, '2021-11-25 14:54:37', '2021-11-27 14:55:33'),
(121, 'Jhon Doe', '01122334455', 'user@gmail.com', 740, 0, 740, 'Dhaka', 'DHAKA 1212', 'TRX_61A24D07F0190', 'BDT', 'online', 'Delivered', 3, '2021-11-27 16:26:27', NULL, '2021-11-27 15:21:43', '2021-11-27 16:26:27'),
(122, 'Jane Doe', '01611223344', 'user2@gmail.com', 32500, 650, 31850, 'Dhaka', 'Dhaka 1213', 'TRX_61A24D89AF0ED', 'BDT', 'cash on delivery', 'Delivered', 4, '2021-11-27 15:24:41', NULL, '2021-11-27 15:23:53', '2021-11-27 15:24:41'),
(123, 'Username', '01192616379', 'sio@gmail.com', 50, 0, 50, 'Khulna', 'Janina', 'TRX_61A256B41A26B', 'BDT', 'cash on delivery', 'Delivered', 3, '2021-11-27 16:03:26', NULL, '2021-11-27 16:03:00', '2021-11-27 16:03:26'),
(124, 'Janina', '01192616379', 'user@gmail.com', 6500, 130, 6370, 'Dhaka', 'DHAKA', 'TRX_61A257A660F3B', 'BDT', 'cash on delivery', 'Delivered', 3, '2021-11-29 14:29:02', NULL, '2021-11-27 16:07:02', '2021-11-29 14:29:02'),
(126, 'Ichigo', '01611223344', 'user@gmail.com', 1806, 36.12, 1769.88, 'Dhaka', 'Karahura Town, Japan', 'TRX_61A4E6E02FF79', 'BDT', 'online', 'Confirmed', 3, NULL, NULL, '2021-11-29 14:42:40', '2021-11-29 14:43:50'),
(127, 'aizen', '01122334455', 'aizen@gmail.com', 5, 0, 5, 'Dhaka', 'AAAAAAAA', 'TRX_61A4E81F121A2', 'BDT', 'cash on delivery', 'Confirmed', 3, NULL, NULL, '2021-11-29 14:47:59', '2021-11-29 14:55:25');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE IF NOT EXISTS `order_items` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `qty` int(11) NOT NULL,
  `unit_price` double NOT NULL,
  `unit_discount_amount` int(11) DEFAULT NULL,
  `product_id` bigint(20) NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `order_items_order_id_foreign` (`order_id`)
) ENGINE=InnoDB AUTO_INCREMENT=60 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `qty`, `unit_price`, `unit_discount_amount`, `product_id`, `order_id`, `created_at`, `updated_at`) VALUES
(45, 3, 1400, NULL, 24, 120, '2021-11-27 14:54:37', '2021-11-27 14:54:37'),
(46, 1, 2300, NULL, 23, 120, '2021-11-27 14:54:37', '2021-11-27 14:54:37'),
(47, 1, 2289, NULL, 12, 120, '2021-11-27 14:54:37', '2021-11-27 14:54:37'),
(48, 10, 5, NULL, 19, 121, '2021-11-27 15:21:44', '2021-11-27 15:21:44'),
(49, 4, 35, NULL, 17, 121, '2021-11-27 15:21:44', '2021-11-27 15:21:44'),
(50, 10, 15, NULL, 18, 121, '2021-11-27 15:21:44', '2021-11-27 15:21:44'),
(51, 5, 10, NULL, 16, 121, '2021-11-27 15:21:44', '2021-11-27 15:21:44'),
(52, 10, 20, NULL, 20, 121, '2021-11-27 15:21:44', '2021-11-27 15:21:44'),
(53, 5, 30, NULL, 21, 121, '2021-11-27 15:21:44', '2021-11-27 15:21:44'),
(54, 5, 6500, 2, 27, 122, '2021-11-27 15:23:53', '2021-11-27 15:23:53'),
(55, 10, 5, NULL, 19, 123, '2021-11-27 16:03:00', '2021-11-27 16:03:00'),
(56, 1, 6500, 2, 27, 124, '2021-11-27 16:07:02', '2021-11-27 16:07:02'),
(58, 1, 1806, 2, 11, 126, '2021-11-29 14:42:40', '2021-11-29 14:42:40'),
(59, 1, 5, NULL, 19, 127, '2021-11-29 14:47:59', '2021-11-29 14:47:59');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE IF NOT EXISTS `products` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` double NOT NULL,
  `discount` smallint(6) DEFAULT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` int(11) NOT NULL,
  `condition` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT 'normal',
  `status` int(11) DEFAULT 1 COMMENT '0=inactive, 1=live, 2=discontinued, 3=force_stock_out',
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_featured` tinyint(1) DEFAULT 0 COMMENT '0=not featured, 1=featured',
  `short_description` tinytext COLLATE utf8mb4_unicode_ci NOT NULL,
  `long_description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `brand_id` bigint(20) NOT NULL,
  `category_id` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `title`, `slug`, `price`, `discount`, `code`, `quantity`, `condition`, `status`, `image`, `is_featured`, `short_description`, `long_description`, `brand_id`, `category_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(2, 'Samsung Galaxy F22 6Gb/128Gb', 'samsung-galaxy-f22-6gb128gb', 18299, NULL, 'Galaxy F22', 100, 'new', 1, 'images/backend/product/1717587465873083_27112021191732.jpg', 0, 'Samsung Galaxy F22 6GB/128GB\r\nPrice: 18299 taka in Bangladesh', 'Software\r\nOS\r\nAndroid 11, One UI Core 3.1\r\nHardware\r\nDesign\r\nweight\r\n203 gm\r\nscreen\r\n6.4\" Super AMOLED, 90Hz, 600 nits (HDR)\r\ndimension\r\n160 x 74 x 9.4 mm\r\nbuild\r\n720 x 1600 pixels, 20:9 ratio (~274 ppi density)\r\nresolution\r\n720 x 1600 pixels, 20:9 ratio (~274 ppi density)\r\nMemory\r\nexpandable\r\n1024 GB\r\nRAM\r\n6 GB\r\nROM\r\n128 GB\r\nProcessor\r\nnumber of cores\r\n8 core\r\nSoC\r\nMediatek Helio G80 (12 nm)\r\nCPU\r\nOcta-core (2x2.0 GHz Cortex-A75 & 6x1.8 GHz Cortex-A55)\r\nGPU\r\nMali-G52 MC2\r\nCamera\r\nsecondary\r\n13 MP, f/2.2, (wide), 1/3.1\", 1.12m\r\nvideo\r\n1080p@30fps\r\nfeatures\r\nLED flash, panorama, HDR\r\nprimary\r\nQuad:\r\n48 MP, f/1.8, (wide), PDAF\r\n8 MP, f/2.2, 123 (ultrawide), 1/4.0\", 1.12m\r\n2 MP, f/2.4, (macro)\r\n2 MP, f/2.4, (depth)\r\nBattery\r\ncapacity\r\n6000mAh Li-Polymer (non-removable)\r\ncharging\r\nFast charging 15W\r\nConnectivity\r\nUSB\r\nUSB Type-C 2.0, USB On-The-Go\r\nGPS\r\nYes, with A-GPS, GLONASS, GALILEO, BDS\r\nWi-Fi\r\nWi-Fi 802.11 a/b/g/n/ac, dual-band, hotspot\r\ninternet\r\n4G/LTE\r\nbluetooth\r\n5.0, A2DP, LE\r\nAudio\r\nradio\r\nFM radio\r\nOthers\r\nsensors\r\nFingerprint (side-mounted), accelerometer, gyro, proximity, compass\r\nManufacturer\r\nfirst arrival\r\nSeptember, 2021\r\nManufactured By\r\nSamsung\r\navailability\r\navailable\r\nSIM\r\nDual SIM (Nano-SIM, dual stand-by)', 1, 5, '2021-11-14 07:37:40', '2021-11-27 14:04:36', NULL),
(3, 'Samsung Galaxy A03S', 'samsung-galaxy-a03s', 13999, 5, 'Galaxy A03s', 150, 'sale', 1, 'images/backend/product/1717587477989983_27112021191743.jpg', 0, 'Samsung Galaxy A03s\r\nPrice: 13999 taka in Bangladesh', 'Software\r\nOS\r\nAndroid 11, One UI 3.1 Core\r\nHardware\r\nDesign\r\nscreen\r\n6.5\" PLS LCD\r\nresolution\r\n720 x 1600 pixels, 20:9 ratio (~270 ppi density)\r\ndimension\r\n164.2 x 75.9 x 9.1 mm\r\nweight\r\n196 gm\r\nMemory\r\nexpandable\r\n256 GB\r\nRAM\r\n4 GB\r\nROM\r\n64 GB\r\nProcessor\r\nnumber of cores\r\n8 core\r\nSoC\r\nMediaTek MT6765 Helio P35 (12nm)\r\nCPU\r\nOcta-core (4x2.35 GHz Cortex-A53 & 4x1.8 GHz Cortex-A53)\r\nGPU\r\nPowerVR GE8320\r\nCamera\r\nfeatures\r\nLED flash\r\nvideo\r\n1080p@30fps\r\nprimary\r\nTriple:\r\n13 MP, f/2.2, (wide), AF\r\n2 MP, f/2.4, (macro)\r\n2 MP, f/2.4, (depth)\r\nsecondary\r\n5 MP, f/2.2\r\nBattery\r\ncapacity\r\n5000mAh Li-Polymer (non-removable)\r\ncharging\r\nFast charging 15W\r\nConnectivity\r\nUSB\r\nUSB Type-C 2.0\r\nGPS\r\nYes, with A-GPS, GLONASS, GALILEO, BDS\r\nWi-Fi\r\nWi-Fi 802.11 b/g/n, Wi-Fi Direct, hotspot\r\ninternet\r\n4G/LTE\r\nbluetooth\r\n5.0, A2DP\r\nAudio\r\nradio\r\nUnspecified\r\nOthers\r\nsensors\r\nFingerprint (side-mounted), accelerometer, proximity\r\nManufacturer\r\nfirst arrival\r\nOctober, 2021\r\nManufactured By\r\nSamsung\r\navailability\r\navailable\r\nSIM\r\nDual SIM (Nano-SIM, dual stand-by)', 1, 5, '2021-11-14 07:39:00', '2021-11-27 13:17:44', NULL),
(4, 'Xiaomi Redmi Note 10 6Gb/128Gb', 'xiaomi-redmi-note-10-6gb128gb', 22999, 15, 'Redmi-N106128', 96, 'hot', 1, 'images/backend/product/1717587489885884_27112021191755.jpg', 1, 'Xiaomi Redmi Note 10 6GB/128GB\r\nPrice: 22999 taka in Bangladesh', 'Software\r\nOS\r\nAndroid 11, MIUI 12\r\nHardware\r\nDesign\r\nscreen\r\n6.43\" Super AMOLED, 450 nits (typ), 1100 nits (peak)\r\nresolution\r\n1080 x 2400 pixels, 20:9 ratio (~409 ppi density)\r\ndimension\r\n160.5 x 74.5 x 8.3 mm\r\nweight\r\n178.8 gm\r\nMemory\r\nexpandable\r\n512 GB\r\nRAM\r\n6 GB\r\nROM\r\n128 GB\r\nProcessor\r\nnumber of cores\r\n8 core\r\nSoC\r\nQualcomm SDM678 Snapdragon 678 (11 nm)\r\nCPU\r\nOcta-core (2x2.2 GHz Kryo 460 Gold & 6x1.7 GHz Kryo 460 Silver)\r\nGPU\r\nAdreno 612\r\nCamera\r\nfeatures\r\nLED flash, HDR, panorama\r\nvideo\r\n4K@30fps, 1080p@30/60fps\r\nprimary\r\nQuad:\r\n48 MP, f/1.8, 26mm (wide), 1/2.0\", 0.8m, PDAF\r\n8 MP, f/2.2, 118 (ultrawide), 1/4.0\", 1.12m\r\n2 MP, f/2.4, (macro)\r\n2 MP, f/2.4, (depth)\r\nsecondary\r\n13 MP, f/2.5, (wide), 1/3.06\", 1.12m\r\nBattery\r\ncapacity\r\n5000mAh Li-Polymer (non-removable)\r\ncharging\r\nFast charging 33W\r\nConnectivity\r\nUSB\r\nUSB Type-C 2.0\r\nGPS\r\nYes, with A-GPS, GLONASS, BDS, GALILEO\r\nWi-Fi\r\nWi-Fi 802.11 a/b/g/n/ac, dual-band, Wi-Fi Direct, hotspot\r\ninternet\r\n2G/3G/4G\r\nbluetooth\r\n5.0, A2DP, LE\r\nAudio\r\nradio\r\nFM Radio\r\nOthers\r\nsensors\r\nFingerprint (side-mounted), accelerometer, gyro, proximity, compass\r\nManufacturer\r\nfirst arrival\r\nMarch, 2021\r\nManufactured By\r\nXiaomi\r\navailability\r\navailable\r\nSIM\r\nDual SIM (Nano-SIM, dual stand-by)', 11, 5, '2021-11-14 07:41:26', '2021-11-27 13:17:55', NULL),
(5, 'Oppo Reno6', 'oppo-reno6', 32990, NULL, 'OPPO-R6X', 150, 'hot', 1, 'images/backend/product/1717587500253442_27112021191805.jpg', 0, 'Oppo Reno6\r\nPrice: 32990 taka in Bangladesh', 'Software\r\nOS\r\nAndroid 11, ColorOS 11.1\r\nHardware\r\nDesign\r\nscreen\r\n6.4\" AMOLED, 90Hz, 430 nits (typ)\r\nresolution\r\n1080 x 2400 pixels, 20:9 ratio (~411 ppi density)\r\ndimension\r\n159.1 x 73.3 x 7.8 mm\r\nweight\r\n173 gm\r\nMemory\r\nexpandable\r\n512 GB\r\nRAM\r\n8 GB\r\nROM\r\n128 GB\r\nProcessor\r\nnumber of cores\r\n8 core\r\nSoC\r\nQualcomm SM7125 Snapdragon 720G (8 nm)\r\nCPU\r\nOcta-core (2x2.3 GHz Kryo 465 Gold & 6x1.8 GHz Kryo 465 Silver)\r\nGPU\r\nAdreno 618\r\nCamera\r\nsecondary\r\n44 MP, f/2.4, 24mm (wide)\r\nvideo\r\n4K@30fps, 1080p@30/60/120fps\r\nfeatures\r\nDual-LED dual-tone flash, HDR, panorama\r\nprimary\r\nQuad:\r\n64 MP, f/1.7, 26mm (wide), 1/2.0\", 0.7m, PDAF\r\n8 MP, f/2.2, 119 (ultrawide), 1/4.0\", 1.12m\r\n2 MP, f/2.4, (macro)\r\n2 MP, f/2.4, (depth)\r\nBattery\r\ncapacity\r\n4310mAh Li-Polymer (non-removable)\r\ncharging\r\nFast charging 50W\r\nConnectivity\r\nUSB\r\nUSB Type-C 2.0, USB On-The-Go\r\nGPS\r\nYes, with A-GPS, GLONASS, BDS, GALILEO, QZSS\r\nWi-Fi\r\nWi-Fi 802.11 a/b/g/n/ac, dual-band, Wi-Fi Direct, hotspot\r\ninternet\r\n4G/LTE\r\nbluetooth\r\n5.1, A2DP, LE, aptX HD\r\nAudio\r\nradio\r\nFM radio\r\nOthers\r\nsensors\r\nFingerprint (under display, optical), accelerometer, gyro, proximity, compass\r\nManufacturer\r\nfirst arrival\r\nNovember, 2021\r\nManufactured By\r\nOppo\r\navailability\r\navailable\r\nSIM\r\nDual SIM (Nano-SIM, dual stand-by)', 4, 5, '2021-11-14 07:43:23', '2021-11-27 13:18:05', NULL),
(7, 'Nokia 3.4', 'nokia-34', 14999, 12, 'N34', 148, 'sale', 1, 'images/backend/product/1717587510800864_27112021191815.jpg', 1, 'Testing out', 'Testing out 2', 7, 5, '2021-11-17 07:37:00', '2021-11-27 13:18:15', NULL),
(11, 'Black Boxed Pattern Gabardine', 'black-boxed-pattern-gabardine', 1806, 2, '100001847', 249, 'new', 1, 'images/backend/product/1717587530548790_27112021191834.jpeg', 0, '95% Cotton \r\n5% Spandex', '95% Cotton,\r\n5% Spandex,\r\nSize : 32, 33, 35,', 13, 10, '2021-11-17 09:53:37', '2021-11-27 13:18:34', NULL),
(12, 'Distressed Slim Fit Denim Jeans', 'distressed-slim-fit-denim-jeans', 2289, NULL, '10002108', 99, 'hot', 1, 'images/backend/product/1717587542069543_27112021191845.jpg', 0, 'Nice Denim Jeans', 'Stretchy, comfortable cotton blend Premium fabric construction,\r\nConcealed zipper fly with top button closure,\r\nStylish ripped effect,\r\nStylish Denim jeans range From Tanjim Brand,\r\nMaterial Composition: 98% Denim, 2% Sapndex,\r\nCare Instructions: Machine Wash,\r\nClosure: Button,\r\nStyle: Slim,\r\nFit Type: Slim Fit', 13, 11, '2021-11-17 09:55:23', '2021-11-30 14:17:51', NULL),
(13, 'Formal Lawn Maroon Full Sleeve Kamiz', 'formal-lawn-maroon-full-sleeve-kamiz', 7000, 5, 'WFORPF13 FALL21', 300, 'normal', 1, 'images/backend/product/1717587555055030_27112021191857.jpg', 0, 'Womens Wear', 'Nice Womens Wear', 14, 12, '2021-11-17 10:01:37', '2021-11-30 14:18:39', NULL),
(14, 'Faux Leather Bag Red', 'faux-leather-bag-red', 2604, NULL, '12000354', 69, 'sale', 1, 'images/backend/product/1717587564924869_27112021191906.jpeg', 1, 'FAUX LEATHER', 'FAUX LEATHER BAG', 13, 13, '2021-11-17 10:06:34', '2021-11-27 14:34:32', NULL),
(15, 'Broccoli', 'broccoli', 50, NULL, 'B159', 100, 'normal', 1, 'images/backend/product/1717587589833891_27112021191930.jpg', 0, 'Fresh Brocollis', 'We collect our veggies from best local sellers!', 15, 15, '2021-11-27 12:51:02', '2021-11-28 14:48:16', NULL),
(16, 'Cucamber', 'cucamber', 10, NULL, 'C10', 195, 'normal', 1, 'images/backend/product/1717683620628028_28112021204552.jpg', 0, 'Fresh Cucumbers', 'We collect our veggies from best local sellers!', 15, 15, '2021-11-27 12:53:52', '2021-11-28 14:45:52', NULL),
(17, 'Cauliflower', 'cauliflower', 35, NULL, 'C35', 146, 'normal', 1, 'images/backend/product/1717683479948346_28112021204338.jpg', 0, 'Fresh Cauliflower', 'We collect our veggies from best local sellers!', 15, 15, '2021-11-27 12:56:29', '2021-11-28 14:43:38', NULL),
(18, 'Eggplants', 'eggplants', 15, NULL, 'EP15', 240, 'normal', 1, 'images/backend/product/1717683575292234_28112021204509.jpg', 0, 'Fresh Eggplants', 'We collect our veggies from best local sellers!', 15, 15, '2021-11-27 12:58:44', '2021-11-28 14:45:09', NULL),
(19, 'Potato', 'potato', 5, NULL, 'PO5', 979, 'normal', 1, 'images/backend/product/1717683533050402_28112021204429.jpg', 0, '5 Taka per piece Potato', 'Fresh potatoes', 15, 15, '2021-11-27 13:01:17', '2021-11-28 14:44:29', NULL),
(20, 'Capsicum', 'capsicum', 20, NULL, 'CAP20', 290, 'normal', 1, 'images/backend/product/1717683724560848_28112021204731.png', 0, 'Fresh Local Capsicums', 'We always store fresh green products', 15, 15, '2021-11-27 13:03:48', '2021-11-28 14:47:32', NULL),
(21, 'Corn', 'corn', 30, NULL, 'CR30', 595, 'normal', 1, 'images/backend/product/1717683384605378_28112021204207.jpg', 0, 'Fresh corns', 'Best of best!!!', 15, 15, '2021-11-27 13:05:19', '2021-11-28 14:42:07', NULL),
(22, 'Men’s Formal Slim-Fit Pant', 'mens-formal-slim-fit-pant', 2720, NULL, '4201310345', 100, 'new', 1, 'images/backend/product/1717591901837894_27112021202802.jpg', 1, 'Richman pants are cool!!', 'STYLE: MFPS-JE-134 (3347)\r\nFABRICS: BLENDED\r\nCOLOR: BLUE', 16, 10, '2021-11-27 14:27:51', '2021-11-27 14:28:03', NULL),
(23, 'Men’s Denim Jeans Pant', 'mens-denim-jeans-pant', 2300, NULL, '42003188', 49, 'normal', 1, 'images/backend/product/1717592047010328_27112021203021.jpg', 0, 'What is Lorem Ipsum?', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 16, 11, '2021-11-27 14:30:21', '2021-11-30 14:17:33', NULL),
(24, 'Men’s Printed Hawai Shirt', 'mens-printed-hawai-shirt', 1400, NULL, '4105511312', 147, 'normal', 1, 'images/backend/product/1717592285084024_27112021203408.jpg', 1, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 16, 16, '2021-11-27 14:34:08', '2021-11-27 15:15:03', NULL),
(25, 'Apple Iphone 12', 'apple-iphone-12', 117999, 5, 'APPLE12', 50, 'hot', 1, 'images/backend/product/1717592620651897_27112021203928.jpg', 1, 'Apple iPhone 12', 'Apple iPhone 12 comes with a 6.1 inches Super Retina XDR OLED screen which is one of its main specialties. It has a classical Apple iPhone notch design. The back camera is of dual 12+12 MP with powerful image processing capability and 4K video recording. The front one is of Dual 12 MP and SL 3D camera. Apple iPhone 12 comes with Li-ion battery with 18W fast charging solution. It has 6 GB RAM, Hexa-core CPU and Apple GPU. It is powered by a 5 nm Apple A14 Bionic chipset. The device comes with 64, 128 or 256 GB internal storage.\r\n\r\nAmong other features, there is Face ID, Apple Pay, Siri, Qi Wireless Charging etc. There is no FM Radio, 3.5mm jack and MicroSD slot in this phone. The device is IP68 certified waterproof and 5G supported.', 6, 5, '2021-11-27 14:39:28', '2021-11-27 14:39:28', NULL),
(26, 'Realme Gt Neo2', 'realme-gt-neo2', 39990, NULL, 'RM-GTNEO2', 70, 'new', 1, 'images/backend/product/1717592842422652_27112021204259.jpg', 1, '8/128 GB', 'Realme GT Neo2 comes with 6.62 inches Full HD+ AMOLED screen. It has a Full-View left punch-hole design. The back camera is of triple 64+8+2 MP with PDAF, LED flash, dedicated macro camera, ultrawide lens etc. and 4K video recording. The front camera is of 16 MP. Realme GT Neo2 comes with 5000 mAh battery with 65W Fast Charging. It has 8 GB RAM, up to 3.2 GHz octa-core CPU and Adreno 650 GPU. It is powered by a Qualcomm Snapdragon 870 5G (7 nm) chipset. The device comes with 128 GB internal storage and no MicroSD slot. There is a in-display fingerprint sensor in this phone.\r\n\r\nAmong other features, there is Dual SIM, face unlock, USB Type-C etc.', 17, 5, '2021-11-27 14:43:00', '2021-11-27 15:44:11', NULL),
(27, 'Women\'s Formal Lawn Kamiz', 'womens-formal-lawn-kamiz', 6500, 2, 'WFOR10', 94, 'normal', 1, 'images/backend/product/1717678390432882_28112021192244.jpg', 0, 't is a long established fact that a reader will be distracted by the readable content of a page', 't is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', 14, 12, '2021-11-27 14:46:46', '2021-11-30 14:18:17', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `shipping_divisions`
--

CREATE TABLE IF NOT EXISTS `shipping_divisions` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `shipping_divisions`
--

INSERT INTO `shipping_divisions` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Dhaka', '2021-11-23 15:53:15', '2021-11-23 15:53:15'),
(2, 'Khulna', '2021-11-23 15:53:20', '2021-11-23 15:53:20'),
(3, 'Barisal', '2021-11-23 15:53:23', '2021-11-23 15:53:23'),
(4, 'Chittagong', '2021-11-23 15:53:27', '2021-11-23 15:53:27'),
(5, 'Sylhet', '2021-11-23 15:53:30', '2021-11-23 15:53:30'),
(6, 'Rajshahi', '2021-11-23 15:53:34', '2021-11-23 15:53:34'),
(7, 'Rangpur', '2021-11-23 15:53:38', '2021-11-23 15:53:38'),
(8, 'Mymensingh', '2021-11-23 15:53:42', '2021-11-23 15:53:42');

-- --------------------------------------------------------

--
-- Table structure for table `site_settings`
--

CREATE TABLE IF NOT EXISTS `site_settings` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `logo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tab_icon` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `site_settings`
--

INSERT INTO `site_settings` (`id`, `name`, `logo`, `tab_icon`, `email`, `phone`, `address`, `created_at`, `updated_at`) VALUES
(1, 'Online Mart', 'images/logo-icon/logo.png', 'images/logo-icon/tab_icon.png', 'onlinemart@gmail.com', '01122334455', 'Satellite Moon, north end 778899', NULL, '2021-11-26 14:28:36');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  UNIQUE KEY `users_phone_unique` (`phone`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `phone`, `image`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(3, 'Jhon Doe', 'user@gmail.com', NULL, 'images/frontend/user/664438_24112021213011.png', NULL, '$2y$10$UJ5bFh43Uxw1Bt2tA0wnc.7TYUlyfc3szD3v2NqHuOuXAWWvpq8ZO', '3nGXFDD4d35JtBYqRfjZgDEpnwywtdgZEko75QrYcJ0zbbz3oSopWf8uQiqB', '2021-11-14 09:30:12', '2021-11-30 14:45:43'),
(4, 'Jhane Doe', 'user2@gmail.com', NULL, NULL, NULL, '$2y$10$7h51xUiZRMPqx6GGHJrmJO5VFJhxMoHxnhkufiRGE1vbgYkAlKDlC', NULL, '2021-11-23 07:47:19', '2021-11-23 07:47:19');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
