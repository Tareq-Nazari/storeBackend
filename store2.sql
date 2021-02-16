-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 16, 2021 at 03:59 PM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.3.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `store2`
--

-- --------------------------------------------------------

--
-- Table structure for table `basket`
--

CREATE TABLE `basket` (
  `id` int(11) NOT NULL,
  `profile_id` int(11) NOT NULL,
  `store_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `product_id` int(11) NOT NULL,
  `name` varchar(200) COLLATE utf8_persian_ci NOT NULL,
  `product_name` varchar(200) COLLATE utf8_persian_ci NOT NULL,
  `price` int(11) NOT NULL,
  `count` int(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

--
-- Dumping data for table `basket`
--

INSERT INTO `basket` (`id`, `profile_id`, `store_id`, `created_at`, `updated_at`, `product_id`, `name`, `product_name`, `price`, `count`) VALUES
(1, 8, 2, '2020-08-06 07:58:16', '2020-08-06 07:58:16', 2, 'falid', 'کیک', 3000, 0);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(250) COLLATE utf8_persian_ci NOT NULL,
  `store_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `store_id`) VALUES
(2, 'xcxxx', 3),
(23, 'sdass', 0),
(24, 'dfw', 3),
(31, 'dsd', 23),
(32, 'dsd', 23),
(34, 'x', 21),
(36, 'wer', 1),
(38, 'lmoknes', 23),
(40, 'sdfs', 23),
(41, 'sdf', 23),
(42, 'shoe', 23);

-- --------------------------------------------------------

--
-- Table structure for table `factor`
--

CREATE TABLE `factor` (
  `id` int(11) NOT NULL,
  `payment_receipt` int(11) NOT NULL,
  `profile_id` int(11) NOT NULL,
  `name` varchar(200) COLLATE utf8_persian_ci NOT NULL,
  `price` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_name` varchar(200) COLLATE utf8_persian_ci NOT NULL,
  `store_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `store_name` varchar(200) COLLATE utf8_persian_ci NOT NULL,
  `count` int(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

--
-- Dumping data for table `factor`
--

INSERT INTO `factor` (`id`, `payment_receipt`, `profile_id`, `name`, `price`, `product_id`, `product_name`, `store_id`, `created_at`, `updated_at`, `store_name`, `count`) VALUES
(1, 1, 3, 'farid', 4000, 2, 'keik', 3, '2020-08-06 16:14:02', NULL, '', 0),
(2, 5, 4, 'farzad', 45000, 8, 'keiik', 4, '2020-08-23 19:30:00', NULL, '', 0),
(3, 470932, 8, 'dfdf', 5222, 4, 'sdsd', 5, '2020-08-12 16:59:24', '2020-08-12 16:59:24', 'df', 200),
(4, 976731, 30, 'xxxxx', 123, 13, 'asd', 23, '2020-09-07 19:15:57', '2020-09-07 19:15:57', 'ویمانا', NULL),
(5, 976873, 30, 'xxxxx', 123, 13, 'asd', 23, '2020-09-07 19:15:57', '2020-09-07 19:15:57', 'ویمانا', NULL),
(6, 342105, 30, 'xxxxx', 123, 13, 'asd', 23, '2020-09-07 19:15:57', '2020-09-07 19:15:57', 'ویمانا', NULL),
(7, 549965, 30, 'xxxxx', 123, 13, 'asd', 23, '2020-09-07 19:15:57', '2020-09-07 19:15:57', 'ویمانا', NULL),
(8, 984222, 30, 'xxxxx', 123, 13, 'asd', 23, '2020-09-07 19:15:57', '2020-09-07 19:15:57', 'ویمانا', NULL),
(9, 219792, 30, 'xxxxx', 123, 13, 'asd', 23, '2020-09-07 19:15:57', '2020-09-07 19:15:57', 'ویمانا', NULL),
(10, 305531, 30, 'xxxxx', 123, 13, 'asd', 23, '2020-09-07 19:15:57', '2020-09-07 19:15:57', 'ویمانا', NULL),
(11, 492152, 30, 'xxxxx', 123, 13, 'asd', 23, '2020-09-07 19:15:57', '2020-09-07 19:15:57', 'ویمانا', NULL),
(12, 866938, 30, 'xxxxx', 123, 13, 'asd', 23, '2020-09-07 19:15:57', '2020-09-07 19:15:57', 'ویمانا', NULL),
(13, 918934, 30, 'xxxxx', 123, 13, 'asd', 23, '2020-09-07 19:15:57', '2020-09-07 19:15:57', 'ویمانا', NULL),
(14, 476486, 30, 'xxxxx', 123, 13, 'asd', 23, '2020-09-07 19:15:57', '2020-09-07 19:15:57', 'ویمانا', NULL),
(15, 576503, 30, 'xxxxx', 123, 13, 'asd', 23, '2020-09-07 19:15:57', '2020-09-07 19:15:57', 'ویمانا', NULL),
(16, 717116, 30, 'xxxxx', 123, 13, 'asd', 23, '2020-09-07 19:15:57', '2020-09-07 19:15:57', 'ویمانا', NULL),
(17, 153612, 30, 'xxxxx', 123, 13, 'asd', 23, '2020-09-07 19:15:57', '2020-09-07 19:15:57', 'ویمانا', NULL),
(18, 326258, 30, 'xxxxx', 123, 13, 'asd', 23, '2020-09-07 19:15:57', '2020-09-07 19:15:57', 'ویمانا', NULL),
(19, 701309, 30, 'xxxxx', 123, 13, 'asd', 23, '2020-09-07 19:15:57', '2020-09-07 19:15:57', 'ویمانا', NULL),
(20, 393817, 30, 'asa', 123, 13, 'asd', 23, '2020-09-07 21:37:53', '2020-09-07 21:37:53', 'ویمانا', NULL),
(21, 617414, 30, 'asas', 700000, 16, 'پالتو', 23, '2020-09-12 00:23:19', '2020-09-12 00:23:19', 'ویمان', NULL),
(22, 546156, 30, 'asas', 700000, 16, 'پالتو', 23, '2020-09-12 00:23:19', '2020-09-12 00:23:19', 'ویمان', NULL),
(23, 886550, 30, 'asas', 700000, 16, 'پالتو', 23, '2020-09-12 00:23:19', '2020-09-12 00:23:19', 'ویمان', NULL),
(24, 269461, 30, 'asas', 324234, 19, 'asdsa', 23, '2020-09-12 00:23:19', '2020-09-12 00:23:19', 'ویمان', NULL);

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
-- Table structure for table `lesson`
--

CREATE TABLE `lesson` (
  `id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `title` varchar(13) COLLATE utf8_persian_ci NOT NULL,
  `caption` text COLLATE utf8_persian_ci NOT NULL,
  `media` varchar(100) COLLATE utf8_persian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

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
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2016_06_01_000001_create_oauth_auth_codes_table', 2),
(5, '2016_06_01_000002_create_oauth_access_tokens_table', 2),
(6, '2016_06_01_000003_create_oauth_refresh_tokens_table', 2),
(7, '2016_06_01_000004_create_oauth_clients_table', 2),
(8, '2016_06_01_000005_create_oauth_personal_access_clients_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `oauth_access_tokens`
--

CREATE TABLE `oauth_access_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `oauth_access_tokens`
--

INSERT INTO `oauth_access_tokens` (`id`, `user_id`, `client_id`, `name`, `scopes`, `revoked`, `created_at`, `updated_at`, `expires_at`) VALUES
('06d779a96010713daaf4ac4deec9b22d8d21212b872b804b3ea94fa88a1cd6b9008c6e891b3a65b5', 12, 1, 'Personal Access Token', '[\"shopOwner\"]', 0, '2020-08-23 03:10:34', '2020-08-23 03:10:34', '2021-08-23 07:40:34'),
('079d524fc6d71144713cda42a1d23f65ea0f4d5193efba001bc558ec753690c56d4e17a977ab9db6', 6, 1, 'Personal Access Token', '[\"can_create\"]', 0, '2020-07-28 14:00:31', '2020-07-28 14:00:31', '2021-07-28 18:30:31'),
('082a95d26b4c52fc07076fd5958f192612ece9d23025a1ff1ba6dbda774430750a6adb3b3bc43299', 37, 1, 'Personal Access Token', '[\"shopOwner\"]', 0, '2020-08-31 05:56:24', '2020-08-31 05:56:24', '2021-08-31 10:26:24'),
('08b13a77b61b8347e2677f684ea1b0eff6f6003b828a90a38cff67112f0bce111dee50fa1340f4e4', 53, 1, 'Personal Access Token', '[\"shopOwner\"]', 0, '2020-12-27 18:13:17', '2020-12-27 18:13:17', '2021-12-27 10:13:17'),
('0e69b2a65d535e2aa5bb738224c8f5dcbf7ea734f8e22e4cc8770cb19de99ec3ce3787570fd545ef', 41, 1, 'Personal Access Token', '[\"shopOwner\"]', 0, '2020-09-11 20:44:16', '2020-09-11 20:44:16', '2021-09-11 13:44:16'),
('1867a8827cc63cacafe3bc66720fdbe4befa08be3636d16b31a764da172dc6987265e0eb51e4e6b1', 42, 1, 'Personal Access Token', '[\"user\"]', 0, '2020-09-09 01:03:33', '2020-09-09 01:03:33', '2021-09-08 18:03:33'),
('1ccf8268829a71159308cb4031d2eb19b490eca85189c4e1e031763d2545980e99e498786a10a1bc', 40, 1, 'Personal Access Token', '[\"shopOwner\"]', 0, '2020-09-04 19:47:56', '2020-09-04 19:47:56', '2021-09-04 12:47:56'),
('20ba3407e15a23bfec3e2d40774d7649399c484bd717795f7740e7f83b5110502059601e1c797685', 41, 1, 'Personal Access Token', '[\"user\"]', 0, '2020-09-12 04:02:43', '2020-09-12 04:02:43', '2021-09-11 21:02:43'),
('230b39abd481ecbc09af3eb0808567c6880726676b955f2c74ae03a7544a8c63498e0b51dabb7083', 6, 1, 'Personal Access Token', '[\"can_create\"]', 0, '2020-07-29 10:12:40', '2020-07-29 10:12:40', '2021-07-29 14:42:40'),
('25954cf967a44fc1e0ae676976dbe5ce1c0407768a43f582b38da9d2260368b5b8ad70df6ef1af8f', 53, 1, 'Personal Access Token', '[\"shopOwner\"]', 0, '2020-12-27 18:08:55', '2020-12-27 18:08:55', '2021-12-27 10:08:55'),
('290b79d4e30adbb0134b236f42ca9b548c91a21c4b68dc2e71e7eb770fe197e0a315fa1e7945a44f', 38, 1, 'Personal Access Token', '[\"shopOwner\"]', 0, '2020-08-31 06:02:16', '2020-08-31 06:02:16', '2021-08-31 10:32:16'),
('2c1aa19b4a36369e9cbd969cadeb8fcf0055718439db4debc1ee593902cc90c308615f3b3c6fea08', 12, 1, 'Personal Access Token', '[\"shopOwner\"]', 0, '2020-08-23 03:28:47', '2020-08-23 03:28:47', '2021-08-23 07:58:47'),
('2f0bae40a5c721cfa6b550e2fbc777a40ea9373c286a06ad1f283799ab779c94bd04b25be282daec', 2, 1, NULL, '[\"can_create\"]', 0, '2020-07-11 20:20:46', '2020-07-11 20:20:46', '2021-07-11 13:20:46'),
('314011522b80e341ca3e66426b616356de78a8c5d5542d029a641e2687b65bf996892ca7f0fe8ca4', 41, 1, 'Personal Access Token', '[\"shopOwner\"]', 0, '2020-09-11 20:47:58', '2020-09-11 20:47:58', '2021-09-11 13:47:58'),
('389624ad9171a8e1be5b5245a4dba765b07ca262d39e67adb3d624f230cf460601c279a766210684', 33, 1, 'Personal Access Token', '[\"shopOwner\"]', 0, '2020-08-31 05:17:29', '2020-08-31 05:17:29', '2021-08-31 09:47:29'),
('3e071e27070445ff99b99ebc915c7c60bb40b5723d9e9f27ed69d7df3b35207ad96d1359e0a68418', 41, 1, 'Personal Access Token', '[\"shopOwner\"]', 0, '2020-09-06 23:12:22', '2020-09-06 23:12:22', '2021-09-06 16:12:22'),
('406fb6974c64d1d63c7d261dcf843edd558cd8ff685f035a0031d616544192d7a0dfb922baeec71c', 12, 1, 'Personal Access Token', '[\"shopOwner\"]', 0, '2020-08-15 08:03:16', '2020-08-15 08:03:16', '2021-08-15 12:33:16'),
('4354650ad506f6ec4b99605218ea9c307698c03f0a9b9cf488f4f5c5175afd2c804447285f247bd5', 12, 1, 'Personal Access Token', '[\"do_anything\"]', 0, '2020-08-04 07:51:21', '2020-08-04 07:51:21', '2021-08-04 12:21:21'),
('4e5ef16bbf857bd24bbf83bce2e440926a21632678415e50a76ea2fe68118a932dc6eb3e5b98ff9e', 41, 1, 'Personal Access Token', '[\"shopOwner\"]', 0, '2020-09-04 20:23:28', '2020-09-04 20:23:28', '2021-09-04 13:23:28'),
('51fa0ec5ef0ae66aa618f297cff13415c9cb5832b96f90671e615e4d831a88124e9736452f0c96de', 37, 1, 'Personal Access Token', '[\"shopOwner\"]', 0, '2020-08-31 05:22:47', '2020-08-31 05:22:47', '2021-08-31 09:52:47'),
('5288dd839b2701a7622668052f6b692a836e0210f4589b93db917214b73bd78ce65dcd7f5de71efa', 12, 1, 'Personal Access Token', '[\"shopOwner\"]', 0, '2020-08-23 03:57:13', '2020-08-23 03:57:13', '2021-08-23 08:27:13'),
('52c5686e4ee549f523c4748b932634b51541eb4a696c918f3e199d499daaf26c306e4550c6273068', 12, 1, 'Personal Access Token', '[\"do_anything\"]', 0, '2020-08-06 07:53:35', '2020-08-06 07:53:35', '2021-08-06 12:23:35'),
('56abd24a6315abe14dc5287fd1406b3e97161e545699f10fd8b8edc8cbd494f6adb2373c7ba52a52', 6, 1, 'Personal Access Token', '[\"can_create\"]', 0, '2020-07-28 10:15:39', '2020-07-28 10:15:39', '2021-07-28 14:45:39'),
('56b4954b036f2d38e8ed7190dbf3b388a5ef55f648db9a889f34a2b08faba6a48bee92b297914c36', 41, 1, 'Personal Access Token', '[\"shopOwner\"]', 0, '2020-09-11 18:30:53', '2020-09-11 18:30:53', '2021-09-11 11:30:53'),
('60a6d8af67076fdee9fae79fe8fe7ac5de20f4f6e7680d640c65527075f4f9d10f1620a7c6e76dbb', 41, 1, 'Personal Access Token', '[\"shopOwner\"]', 0, '2020-09-12 04:04:58', '2020-09-12 04:04:58', '2021-09-11 21:04:58'),
('65da3c210d7df966c202b52079d153aab782d27ff11ea43cfaa474889ee2393cc06305c5d7429533', 5, 1, 'Personal Access Token', '[\"can_create\"]', 0, '2020-07-24 12:37:41', '2020-07-24 12:37:41', '2021-07-24 17:07:41'),
('681b9480fb7880e140faca6d3a733ea054440c43dc6759f6bc42c9b3525cee1cb0cdd144d771bdef', 12, 1, 'Personal Access Token', '[\"do_anything\"]', 0, '2020-08-04 07:44:13', '2020-08-04 07:44:13', '2021-08-04 12:14:13'),
('6f8cfea344ffab8432236fb82a076dfe4bfba3056e878998ba70a6c55a14e08dbed8eff23928efbf', 37, 1, 'Personal Access Token', '[\"user\"]', 0, '2020-08-31 05:48:07', '2020-08-31 05:48:07', '2021-08-31 10:18:07'),
('70562d8158899f7e7572b839fb44adc16c576e1a78d4637590965e73b2c3fd956d2e5f62553a51fb', 40, 1, 'Personal Access Token', '[\"shopOwner\"]', 0, '2020-09-04 19:54:22', '2020-09-04 19:54:22', '2021-09-04 12:54:22'),
('71b9cb738dc0badc283ca33bffb16348b923a152a4d59c1220f5a8226c4d80be5a140218f572e63f', 41, 1, 'Personal Access Token', '[\"user\"]', 0, '2020-09-06 23:33:35', '2020-09-06 23:33:35', '2021-09-06 16:33:35'),
('7919ce57de7fc008c9038de2fd4d44974eaf250b89a8c9376a1765052a0f5e3bf0ededb1d566098c', 6, 1, 'Personal Access Token', '[\"can_create\"]', 0, '2020-07-28 13:03:26', '2020-07-28 13:03:26', '2021-07-28 17:33:26'),
('80fbb92d026820aacaf4ef763b75c1a4d40d71247110c7359ff23af0f7db0f8584ade3c365aba701', 42, 1, 'Personal Access Token', '[\"user\"]', 0, '2020-09-09 01:13:26', '2020-09-09 01:13:26', '2021-09-08 18:13:26'),
('81385aa6d9d0b1fdf359c566409429a26fd785d11a3b8904866e61d2129946769426e65b0980699e', 41, 1, 'Personal Access Token', '[\"shopOwner\"]', 0, '2020-09-11 18:30:55', '2020-09-11 18:30:55', '2021-09-11 11:30:55'),
('83e344da55587df536f8562808951eceefb9bcde026e231318e77f4b4a4537dfc4526dd6c3e5013e', 33, 1, 'Personal Access Token', '[\"shopOwner\"]', 0, '2020-08-31 05:18:15', '2020-08-31 05:18:15', '2021-08-31 09:48:15'),
('8791b0e4a0cc278000a4a522c8b93f8800528a8af659583436f51d1f9c65c22901e68f113531543e', 25, 1, 'Personal Access Token', '[\"admin\"]', 0, '2020-08-15 08:08:56', '2020-08-15 08:08:56', '2021-08-15 12:38:56'),
('8b5f3a1c261f6143dc5785fe67cd58c7130ce665993463ee2c2c79565a563246280f8fb14439e700', 41, 1, 'Personal Access Token', '[\"shopOwner\"]', 0, '2020-09-11 20:03:02', '2020-09-11 20:03:02', '2021-09-11 13:03:02'),
('8d7df7c0c766d02dac1027b6a8b892f6d25531e8f1c87275827a96aed8d0641340b5725a9d50c13a', 39, 1, 'Personal Access Token', '[\"shopOwner\"]', 0, '2020-08-31 10:19:34', '2020-08-31 10:19:34', '2021-08-31 14:49:34'),
('956b84a29db55cc8813a231c81f2a895a2f39f88a83531cd4d436201ed084fe94398a4955d998e18', 41, 1, 'Personal Access Token', '[\"admin\"]', 0, '2020-09-12 04:03:43', '2020-09-12 04:03:43', '2021-09-11 21:03:43'),
('98791028b03bac457d909a9b7121bd27baa9c16faa56020502eb1f91d290d77dc5c33324b59296e1', 42, 1, 'Personal Access Token', '[\"user\"]', 0, '2020-09-09 01:06:32', '2020-09-09 01:06:32', '2021-09-08 18:06:32'),
('9adf1117a2d614cae67d16c209c600636d902236c01b5f39d7b0f415b5ff23076d6d2812007b6c3e', 41, 1, 'Personal Access Token', '[\"shopOwner\"]', 0, '2020-09-06 02:05:41', '2020-09-06 02:05:41', '2021-09-05 19:05:41'),
('9c7a35ee8b631555a0f6ef00aa54f557f540c515b2b60ceacca2d6b41b1c23718b4a81b9c151d8eb', 37, 1, 'Personal Access Token', '[\"user\"]', 0, '2020-08-31 05:44:47', '2020-08-31 05:44:47', '2021-08-31 10:14:47'),
('a81046aab5ca4d3b842e5545399d09bab4c15ee8c38e12fb775bba076ca89d1f589ed912e101ce48', 41, 1, 'Personal Access Token', '[\"admin\"]', 0, '2020-09-11 21:27:24', '2020-09-11 21:27:24', '2021-09-11 14:27:24'),
('b279c0451ab36e21b28f05b1a9b041cc26b6eeeabe8571eb4f9d1d9fc3694951e6ab69736bfa8e9f', 42, 1, 'Personal Access Token', '[\"user\"]', 0, '2020-09-09 01:09:07', '2020-09-09 01:09:07', '2021-09-08 18:09:07'),
('b5ba590d96b671f498ddde3b1d8ac59b55a6782b8fdf746de98800d74a237f48fff72217731ea99e', 33, 1, 'Personal Access Token', '[\"shopOwner\"]', 0, '2020-08-29 17:18:14', '2020-08-29 17:18:14', '2021-08-29 21:48:14'),
('b9855e4f10ba4834739d9b3d4f5083206262fef2e4617afe2d0d63ec03da729e3fbed7fb019ceb14', 6, 1, 'Personal Access Token', '[\"can_create\"]', 0, '2020-07-28 12:45:23', '2020-07-28 12:45:23', '2021-07-28 17:15:23'),
('c4295cd923bc9bc248c38da12a14442110a4d0337491e65d07f288c5e5619f18b402c7cf62e981f9', 2, 1, 'Personal Access Token', '[\"can_create\"]', 0, '2020-07-11 20:38:01', '2020-07-11 20:38:01', '2021-07-11 13:38:01'),
('c47af1355abbeb8772a51b4d17c359f528e62ad3086a8f37839fdbbb783c0636c13085accc1d4223', 6, 1, 'Personal Access Token', '[\"can_create\"]', 0, '2020-07-28 08:25:25', '2020-07-28 08:25:25', '2021-07-28 12:55:25'),
('c63f7683238965618af35a29179b3f94a886966abbe4c132a9e7c97b15b2b76c5c0ce053293a8160', 37, 1, 'Personal Access Token', '[\"user\"]', 1, '2020-08-31 05:44:55', '2020-08-31 05:44:55', '2021-08-31 10:14:55'),
('cbd66cc467307eca756e67109cc6f81b7f093302af3aa6cad46344764df32ba7ad4dcdf0f07d484f', 6, 1, 'Personal Access Token', '[\"can_create\"]', 0, '2020-07-28 10:59:02', '2020-07-28 10:59:02', '2021-07-28 15:29:02'),
('cd2d75e6fb7b0514b1cbd7ca3d7ffc30d2171dcc68e94c76a5fc9f7356255cee8ee0d9971094fd4f', 38, 1, 'Personal Access Token', '[\"shopOwner\"]', 0, '2020-08-31 06:06:24', '2020-08-31 06:06:24', '2021-08-31 10:36:24'),
('d68f65473ce4ddf62bfc54c709dbb418b91a66961069e51471d05782bcb1464b10347bdb84f0cbf1', 40, 1, 'Personal Access Token', '[\"shopOwner\"]', 0, '2020-09-04 19:51:00', '2020-09-04 19:51:00', '2021-09-04 12:51:00'),
('dacb32b0d17dbccd453a36c9e795ba929ce2fe5f62c063ac136b0f4b8ce2cabc077cd3463166f535', 53, 1, 'Personal Access Token', '[\"shopOwner\"]', 0, '2020-12-27 18:10:48', '2020-12-27 18:10:48', '2021-12-27 10:10:48'),
('daee20cad97655fdbbde5f981680ca5e855b5366ab49d7789f32ef7be611a944823def2219012caf', 41, 1, 'Personal Access Token', '[\"shopOwner\"]', 0, '2020-09-06 23:18:58', '2020-09-06 23:18:58', '2021-09-06 16:18:58'),
('dcea20121ab61c0d3352ce27ae28f48b784a86a6164a1613bb86450894b91a42969e280b2a05bef3', 33, 1, 'Personal Access Token', '[\"shopOwner\"]', 0, '2020-08-31 05:19:52', '2020-08-31 05:19:52', '2021-08-31 09:49:52'),
('e4f6509c2573f0704486404b65f760a19c9f123d4c11b0a974116b7d10fe43a1750027cbe15b884b', 40, 1, 'Personal Access Token', '[\"shopOwner\"]', 0, '2020-09-04 19:48:07', '2020-09-04 19:48:07', '2021-09-04 12:48:07'),
('ed694ce0ca77925f793673a095e4045538c56bb7af7146f976f62f797d716601987e66de3012dd60', 28, 1, 'Personal Access Token', '[\"admin\"]', 1, '2020-08-24 14:46:15', '2020-08-24 14:46:15', '2021-08-24 19:16:15'),
('f11c97885ece76e11e786034bd37e50d231a8b572772eaa7fd4ce852f71ecb0cce11fca0bdb72ac2', 8, 1, 'Personal Access Token', '[\"do_anything\"]', 0, '2020-07-31 10:11:08', '2020-07-31 10:11:08', '2021-07-31 14:41:08'),
('f8df1a53326af424e1972cb67c970b71f07fa849c0af7835fc7d554d93ffe339d4281618aee58748', 41, 1, 'Personal Access Token', '[\"shopOwner\"]', 0, '2020-09-04 20:07:37', '2020-09-04 20:07:37', '2021-09-04 13:07:37'),
('fb4d7ed542c7b8bc50d3f9354b0ea4e21fe297385b9b7c4e99b60a2b61f61869062d86a6565abcc8', 40, 1, 'Personal Access Token', '[\"shopOwner\"]', 0, '2020-09-04 19:54:25', '2020-09-04 19:54:25', '2021-09-04 12:54:25'),
('fed4924b8f631e2169a2a8f8c451c035718bece328dc60783d737927102a2bf675b2dce4d9a0f391', 41, 1, 'Personal Access Token', '[\"shopOwner\"]', 0, '2020-09-06 06:27:56', '2020-09-06 06:27:56', '2021-09-05 23:27:56');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_auth_codes`
--

CREATE TABLE `oauth_auth_codes` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_clients`
--

CREATE TABLE `oauth_clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `secret` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `provider` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `redirect` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `personal_access_client` tinyint(1) NOT NULL,
  `password_client` tinyint(1) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `oauth_clients`
--

INSERT INTO `oauth_clients` (`id`, `user_id`, `name`, `secret`, `provider`, `redirect`, `personal_access_client`, `password_client`, `revoked`, `created_at`, `updated_at`) VALUES
(1, NULL, 'Laravel Personal Access Client', 'sVrk3ydL8BBWC0sWtW9FBekJ0z1DIkBW6rqAQKGI', NULL, 'http://localhost', 1, 0, 0, '2020-07-07 01:02:42', '2020-07-07 01:02:42'),
(2, NULL, 'Laravel Password Grant Client', 'W1yPrFzz8aaZ01asRfbLvOtMwplO4Xr7wZ2Rhwbk', 'users', 'http://localhost', 0, 1, 0, '2020-07-07 01:02:42', '2020-07-07 01:02:42');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_personal_access_clients`
--

CREATE TABLE `oauth_personal_access_clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `oauth_personal_access_clients`
--

INSERT INTO `oauth_personal_access_clients` (`id`, `client_id`, `created_at`, `updated_at`) VALUES
(1, 1, '2020-07-07 01:02:42', '2020-07-07 01:02:42');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_refresh_tokens`
--

CREATE TABLE `oauth_refresh_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `access_token_id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `store_id` int(11) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `name` char(255) COLLATE utf8_persian_ci NOT NULL,
  `price` int(20) NOT NULL,
  `caption` varchar(500) COLLATE utf8_persian_ci NOT NULL,
  `pic` char(50) COLLATE utf8_persian_ci DEFAULT NULL,
  `tumbnail_pic` char(50) COLLATE utf8_persian_ci NOT NULL,
  `size` varchar(255) COLLATE utf8_persian_ci NOT NULL,
  `color` varchar(255) COLLATE utf8_persian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `store_id`, `cat_id`, `name`, `price`, `caption`, `pic`, `tumbnail_pic`, `size`, `color`) VALUES
(2, 2, 29, 'aaaaa', 2200, 'lk', '306558563.jpg', '', '', ''),
(6, 1, 2, 'pofak', 2000, 'adawwsd', 'asdsd', '', '', ''),
(12, 19, 23, 'sdsd', 22000, 'ssds', '610730006.jpg', '310773798.jpg', '', ''),
(14, 23, 31, 'هودی', 300000, 'هودی مشکی', '882158564.jpg', '213535221.jpg', 'xls', 'مشکی'),
(15, 23, 31, 'هودی', 300000, 'هودی مشکی', '415681276.jpg', '799375036.jpg', 'xl', 'مشکی'),
(16, 23, 40, 'پالتو', 700000, 'پالتو اسپرت', '706667250.jpg', '847917375.jpg', 'xxl', 'خاکستری'),
(17, 23, 40, 'پالتو', 700000, 'پالتو اسپرت', '479585658.jpg', '955289752.jpg', 'xxl', 'خاکستری'),
(18, 23, 31, 'rwer', 2000000, 'alskdjalkdjaklsjd', '659613436.jpg', '354696759.jpg', 'xl', 'sfsd'),
(19, 23, 42, 'asdsa', 324234, 'dadasdasd', '668606467.jpg', '396079179.jpg', 'dfdf', 'qwda');

-- --------------------------------------------------------

--
-- Table structure for table `product_comment`
--

CREATE TABLE `product_comment` (
  `id` int(11) NOT NULL,
  `comment` text COLLATE utf8_persian_ci NOT NULL,
  `product_id` int(11) NOT NULL,
  `profile_id` int(11) NOT NULL,
  `created_at` date NOT NULL,
  `updated_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

--
-- Dumping data for table `product_comment`
--

INSERT INTO `product_comment` (`id`, `comment`, `product_id`, `profile_id`, `created_at`, `updated_at`) VALUES
(2, 'asdasd', 13, 30, '2020-09-07', '2020-09-07'),
(3, 'asds', 12, 30, '2020-09-11', '2020-09-11');

-- --------------------------------------------------------

--
-- Table structure for table `profiles`
--

CREATE TABLE `profiles` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_persian_ci NOT NULL,
  `address` varchar(255) COLLATE utf8_persian_ci NOT NULL,
  `phone` char(11) COLLATE utf8_persian_ci NOT NULL,
  `role` int(1) NOT NULL,
  `pic` varchar(255) COLLATE utf8_persian_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

--
-- Dumping data for table `profiles`
--

INSERT INTO `profiles` (`id`, `user_id`, `name`, `address`, `phone`, `role`, `pic`) VALUES
(8, 8, 'pp', 'hakoogmao', '09147894569', 3, NULL),
(9, 5, 'ff', 'sdjsdk', '9184536576', 1, ''),
(10, 17, 'ff', 'sdjsdk', '9184536983', 1, ''),
(11, 18, 'ff', 'sdjsdk', '99999999999', 1, ''),
(12, 19, 'ff', 'sdjsdk', '99999999999', 1, ''),
(13, 22, 'ff', 'sdjsdk', '9184536983', 1, ''),
(14, 23, 'ff', 'sdjsdk', '9184536983', 2, ''),
(15, 24, 'ff', 'sdjsdk', '09184536983', 1, ''),
(16, 25, 'f', 'ilam', '09194536983', 3, ''),
(17, 26, 'ff', 'sdkja', '09184536983', 1, ''),
(18, 29, 'faf', 'ilam', '09194536983', 3, NULL),
(19, 30, 'fazad', 'wwe', '09184563987', 2, NULL),
(20, 31, 'fea', 'sdsd', '09184563987', 2, NULL),
(21, 32, 'fari', 'ssdsdsd', '09184536983', 1, NULL),
(22, 33, 'fari', 'ssdsdsd', '09184536983', 2, NULL),
(23, 34, 'fari', 'ssdsdsd', '09184536983', 3, NULL),
(24, 35, 'fari', 'ssdsdsd', '09184536983', 1, NULL),
(25, 36, 'fari', 'ssdsdsd', '09184536983', 1, NULL),
(26, 37, 'farid', 'sdd', '09187894569', 1, NULL),
(27, 38, 'farid', 'sdd', '09187894569', 2, NULL),
(28, 39, 'farid', 'sdd', '09187894569', 2, NULL),
(29, 40, 'xxxxx', 'ajdklasjd', '0987', 1, NULL),
(30, 41, 'asas', 'dadfsdf', '0987654', 2, NULL),
(31, 42, 'wqe', 'dajhdgsah', '09999999', 1, NULL),
(32, 43, 'dasdad', 'qeqweqwe', '0987654', 1, NULL),
(33, 44, 'asdasd', 'sdfsdf', '4234', 1, NULL),
(34, 45, 'wqeqwe', 'sdfsdf', '4234', 1, NULL),
(35, 46, 'asd', 'asd', '123', 1, NULL),
(36, 47, 'asd', 'asd', '123', 1, NULL),
(37, 48, 'asdasd', 'asd', '123', 1, NULL),
(38, 49, 'asdasd', 'asd', '123', 1, NULL),
(39, 50, 'asdasd', 'asd', '123', 1, NULL),
(40, 51, 'asd', 'asdasdasd', '091111', 1, NULL),
(41, 52, 'asdad', 'asd', '098', 1, NULL),
(42, 53, 'ta', 'sasd', '091111111', 2, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(1) NOT NULL,
  `title` varchar(100) COLLATE utf8_persian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `title`) VALUES
(1, 'shopOwner'),
(2, 'admin'),
(3, 'author');

-- --------------------------------------------------------

--
-- Table structure for table `stores`
--

CREATE TABLE `stores` (
  `id` int(11) NOT NULL,
  `name` char(25) COLLATE utf8_persian_ci NOT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `cat_id` int(2) NOT NULL,
  `header_pic` char(200) COLLATE utf8_persian_ci DEFAULT NULL,
  `profile_pic` char(200) COLLATE utf8_persian_ci DEFAULT NULL,
  `phone` char(11) COLLATE utf8_persian_ci NOT NULL,
  `address` varchar(255) COLLATE utf8_persian_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_persian_ci NOT NULL,
  `profile_id` int(11) NOT NULL,
  `caption` varchar(1000) COLLATE utf8_persian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

--
-- Dumping data for table `stores`
--

INSERT INTO `stores` (`id`, `name`, `status`, `cat_id`, `header_pic`, `profile_pic`, `phone`, `address`, `email`, `profile_id`, `caption`) VALUES
(17, 'ff', NULL, 4, '340701416.jpg', '893795236.jpg', '17', 'sdsd', 'p@gmail', 28, 'ssds'),
(19, 'e', NULL, 22, '984632708.jpg', '274177208.jpg', '2200', 'sdsd', 'p@gmail', 22, 'ssds'),
(20, 'lk,m', NULL, 22, NULL, NULL, '09184536983', 'sdsdsd', 'aq@gmail', 26, 'hakooww@gmao'),
(21, 'lk,m', NULL, 4, NULL, NULL, '09184536983', 'sdsdsd', 'aq@gmail', 27, 'hakaww@gmao'),
(22, 'lk,m', NULL, 4, NULL, NULL, '09184536983', 'sdsdsd', 'aweq@gmail', 28, 'hakaww@gmao'),
(23, 'ویمان', 0, 2, '330196752.jpeg', '826811124.jpg', '098764332', 'djcvxjbccdsdgfhsdfgshgdfhjsg', 'vim@gmail.co', 30, 'به روز ترین های پوشاک'),
(24, 'کوروش', NULL, 4, NULL, NULL, '09187777777', 'sadasdasasdasdasdasd', 'tareqmnae@gmail.com', 42, 'شسیبشسیبش');

-- --------------------------------------------------------

--
-- Table structure for table `store_categories`
--

CREATE TABLE `store_categories` (
  `id` int(11) NOT NULL,
  `name` varchar(200) COLLATE utf8_persian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

--
-- Dumping data for table `store_categories`
--

INSERT INTO `store_categories` (`id`, `name`) VALUES
(2, 'sdas'),
(4, 'sdas'),
(6, 'xxcx');

-- --------------------------------------------------------

--
-- Table structure for table `store_comment`
--

CREATE TABLE `store_comment` (
  `id` int(11) NOT NULL,
  `comment` text COLLATE utf8_persian_ci NOT NULL,
  `store_id` int(11) NOT NULL,
  `profile_id` int(11) NOT NULL,
  `created_at` date NOT NULL,
  `updated_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

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
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `role` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `role`) VALUES
(1, 'taregh', 'taregh1996nazari@gmail.com', NULL, '$2y$10$IGNJzahZ4fiQiFfQoZ9N4.GFUkXi6e/Nk1lfrctl94PU.gyeD06W2', NULL, '2020-07-08 20:24:41', '2020-07-08 20:24:41', 1),
(2, 'daker', 'dak@gmail.com', NULL, '$2y$10$0rU8ppN4pjHIhFg6D/Wp5u/Cl7ksp.0bhjPGIOvagropcXXaL6u5O', NULL, '2020-07-08 22:06:45', '2020-07-08 22:06:45', 1),
(5, 'fardid', 'farid@gmail', NULL, '$2y$10$5cdzCZxCUVRHrEgVffRvtuyDwm9WJTpR9YaxM.N58ut7/ktrFa0Dy', 'yYMzLlhXPTBmbEEO6A96b9svYVVCtWMwuH4DSkM51mS3tiaYrb0CXhflQMy7', '2020-07-24 12:16:09', '2020-07-24 12:16:09', 1),
(8, 'pp', 'hakooww@gmao', NULL, '$2y$10$X4nn7T9pnRzXPXd5lE6iduavzkdR3o05d.skWQqv8xdwoj8UVCjYC', NULL, '2020-07-31 10:09:01', '2020-07-31 10:09:01', 2),
(9, 'faid', 'sobhanii@gmail', NULL, '$2y$10$Sbuz5IFIGGVRWiot4w5Hr.T2kjlhp.XBMvC5pq7Yfq/UlhEybysj2', NULL, '2020-08-02 07:28:57', '2020-08-02 07:28:57', 2),
(11, 'faid', 'sobh45anii@gmail', NULL, '$2y$10$OskoIiofzvDinnbqdxF7be77M8gsuob4Q13r.OHlGnOLbKe74ZMtO', NULL, '2020-08-02 07:29:35', '2020-08-02 07:29:35', 2),
(12, 'falid', 'hakoo@gmao', NULL, '$2y$10$byBmadVyjSFJmiG29GrftOc8WY.0Smpwx11nzYuPIvw5mbDqUtrSC', NULL, '2020-08-04 07:43:21', '2020-08-04 07:43:21', 2),
(13, 'ff', 'fa@gmail', NULL, '$2y$10$ytw5N99FhIKe7qdMk4hmKu97rmMvPJNICItkoJ/4yDpNOa9TfQ3Z6', NULL, '2020-08-13 16:18:05', '2020-08-13 16:18:05', 1),
(14, 'ff', 'far@gmail', NULL, '$2y$10$3kRPq99z7DX5jcM06fSApuJTe3TYZhK/kSHylfIoNrs7Fp9wisgRe', NULL, '2020-08-13 16:19:21', '2020-08-13 16:19:21', 1),
(15, 'ff', 'fari@gmail', NULL, '$2y$10$/l9MaveSVt247uNwcYk0kuj90CV6A7R9GgEXvb/M./WoB/2c9UVoK', NULL, '2020-08-13 16:23:51', '2020-08-13 16:23:51', 1),
(16, 'ff', 'fariB@gmail', NULL, '$2y$10$ayZxY7G5rE/DPENIHWrecuXlx9473KSRXpYVHRMOlvarPKbmMNP9W', NULL, '2020-08-13 16:26:34', '2020-08-13 16:26:34', 1),
(17, 'ff', 'fariSB@gmail', NULL, '$2y$10$HulV3w50SGuMR/RXlbVDkunWu3x.4.kaVBbSAIufnCJiVpFMYJ9gq', NULL, '2020-08-13 16:27:38', '2020-08-13 16:27:38', 1),
(18, 'ff', 'SD@gmail', NULL, '$2y$10$qQKOAHYWkIMAvxUh/xs0w.72vOv8UsJSwZ7qlaZoPeGGPchwet9GC', NULL, '2020-08-13 16:28:20', '2020-08-13 16:28:20', 1),
(19, 'ff', 'SsD@gmail', NULL, '$2y$10$JHZ8ELu1t2.4HbUdaNBiZe.leFeSesZGFr57AsFSd5osQIj5rxRSS', NULL, '2020-08-13 16:35:35', '2020-08-13 16:35:35', 1),
(20, 'ff', 'SsqqD@gmail', NULL, '$2y$10$leEI6kB197EXmN8TnC9GMOw27frb0TFGKC8AMnIujWL/xTf17qBiW', NULL, '2020-08-13 16:41:54', '2020-08-13 16:41:54', 1),
(21, 'ff', 'SsaqqD@gmail', NULL, '$2y$10$dNgYEnQEgsPDE1opIZaJrePQcqHc/G19IiRlr17.C8BMqTIjnukRG', NULL, '2020-08-13 16:43:24', '2020-08-13 16:43:24', 1),
(22, 'ff', 'SssaqqD@gmail', NULL, '$2y$10$8ru/HbSRn0oqv7ltDiksB.oBX/6zcn42p.0FHFigbjTKGVavD5t4O', NULL, '2020-08-13 16:44:49', '2020-08-13 16:44:49', 1),
(23, 'ff', 'SsfsaqqD@gmail', NULL, '$2y$10$A/MYqCQM8LjmiGL9orEng.H89MH4fZgSe3zqpOUxlsZOJwnryyHgO', NULL, '2020-08-13 16:47:57', '2020-08-13 16:47:57', 2),
(24, 'ff', 'SsfsaqwqqD@gmail', NULL, '$2y$10$oXiKYnQwmKmmBsY3lD4SYe5srTarrfWud2czHL30DL4cHoETJjCK2', NULL, '2020-08-14 04:52:31', '2020-08-14 04:52:31', 1),
(25, 'f', 'a@gmail', NULL, '$2y$10$MDnfsvAfNxgD44nrndHnr.qunrvNgpx/lId8B0GGWkidcSCYSh00S', NULL, '2020-08-15 08:08:18', '2020-08-15 08:08:18', 3),
(26, 'ff', 'as@gmail', NULL, '$2y$10$8Ye6R9v5ICIgjzQC1wzlIeXy1wtwRK1HDbOf04lY04RvtkhFQo8gu', NULL, '2020-08-20 08:53:06', '2020-08-20 08:53:06', 1),
(27, 'f', 'aa@gmail', NULL, '$2y$10$W6tn8xww7oV3M53Y.TkhoeU8.2S.s8JIXLpWB7ZGfbcNcoomngO5S', NULL, '2020-08-24 14:44:42', '2020-08-24 14:44:42', 3),
(28, 'f', 'ja@gmail', NULL, '$2y$10$chHMwuefHOAJUg.rrH6DNO/BxKd0ZCNls2rz6JMnBpZvnvcILlZj2', NULL, '2020-08-24 14:45:15', '2020-08-24 14:45:15', 3),
(29, 'faf', 'jaas@gmail', NULL, '$2y$10$vPpoDEgCIVJOo9vILmz0z.cZpG2CjzsW2pZz5zA.2/G53SJ9Ebd8C', NULL, '2020-08-25 08:36:18', '2020-08-25 08:36:18', 3),
(30, 'fazad', 'dfdf@gmail.comdd', NULL, '$2y$10$CjJWhLJXtp5PfBr2cJcUBe/efXOQ.m1NzvBjxWxJS4D3OLnbz9jaC', NULL, '2020-08-25 08:37:55', '2020-08-25 08:37:55', 2),
(31, 'fea', 'sar@gmail', NULL, '$2y$10$iVaSIr.g228r8Jv6i2ieqOU/55A91ApCr7off/rF7PsuDSHC9pnae', NULL, '2020-08-25 08:55:45', '2020-08-25 08:55:45', 2),
(32, 'fari', 'shop@gmail', NULL, '$2y$10$sayU3vH9KcC4L21sQnq0oe3w0NdQjWwBuYlgC845f3g4Hi0U.FUyG', NULL, '2020-08-29 17:14:57', '2020-08-29 17:14:57', 1),
(33, 'fari', 'shop1@gmail', NULL, '$2y$10$wRVKCzQrnXbnRUXKxbeWnepbwR7lLovQ6Wah8P6arwK/wU2map88i', NULL, '2020-08-29 17:15:31', '2020-08-29 17:15:31', 2),
(34, 'fari', 'shop2@gmail', NULL, '$2y$10$IdYPiYanZKjqVHybetej0OOmqm6GLrTjcBVcp3XBFA8Z5BVckz.my', NULL, '2020-08-31 05:16:52', '2020-08-31 05:16:52', 3),
(35, 'fari', 'shop3@gmail', NULL, '$2y$10$C/KPTaq7n3GJlNW0TJ.cjeWiDdOD1O0MGL.c1tDKXOAgLzDn8SJmK', NULL, '2020-08-31 05:18:05', '2020-08-31 05:18:05', 1),
(36, 'fari', 'shop4@gmail', NULL, '$2y$10$lunJ3ZxtrP.TjuKWFT2cGuYr.iJqSDtDB20nEYoowssR8ok30J8QW', NULL, '2020-08-31 05:19:43', '2020-08-31 05:19:43', 1),
(37, 'farid', 'sho@gmail', NULL, '$2y$10$y2nu4o7ZznLjV7fejblPZOYqiJnl3C/SsD8YpkmwxKSklhupRQLNe', NULL, '2020-08-31 05:21:56', '2020-08-31 05:21:56', 2),
(38, 'farid', 'shopi@gmail', NULL, '$2y$10$4RkUvxJGdkjdZ17n4m61S.Qoh.9v333TsXa8WSLZxsAWN2hxDh9QS', NULL, '2020-08-31 06:02:00', '2020-08-31 06:02:00', 2),
(39, 'farid', 'shopii@gmail', NULL, '$2y$10$pu8KXbxJO8o7FSyptdD1xux9/o5aciI5RsEcBbdJBH8qFk3Y8axaW', NULL, '2020-08-31 10:19:11', '2020-08-31 10:19:11', 2),
(41, 'asas', 'store2@gmail.com', NULL, '$2y$10$0sMoEl2W5JE5lbCWdG8nGutIrI5TN91OnSRrJqjeBJKZhRbIKEqAK', NULL, '2020-09-04 20:07:27', '2020-09-04 20:07:27', 2),
(42, 'wqe', 'user@gmail.com', NULL, '$2y$10$BtRMvNbTTGXdrZvPqNl.zuRcM7ZnrJUbmQCLKxVc4vNLECxm7abru', NULL, '2020-09-06 23:35:00', '2020-09-06 23:35:00', 1),
(43, 'dasdad', 'asdas@asd.com', NULL, '$2y$10$b1qCw6nrOUBODxpJwqZLe..gLVh/f2MVBWldc0.xqyHcIHRpVywvi', NULL, '2020-09-09 06:18:27', '2020-09-09 06:18:27', 1),
(44, 'asdasd', 'ad@gm.com', NULL, '$2y$10$7xoPHpKlelhfHlqtF/cRuupPRqr/TTHsLvR5gTum2RMdQrRPBiZnS', NULL, '2020-09-09 06:20:32', '2020-09-09 06:20:32', 1),
(45, 'wqeqwe', 'asd@gm.com', NULL, '$2y$10$8WwpzuyUwtLNcpAAF41ObO25NZaS6ZikQZRxTid73c0M2WoYaqhxy', NULL, '2020-09-09 06:21:14', '2020-09-09 06:21:14', 1),
(46, 'asd', 'taresq1996nazari@gmail.com', NULL, '$2y$10$ZMWtK1YzbHj03ZbQQHkwTOcSisl/CoFOkOOHX.J5fUD.q5TFb64XC', NULL, '2020-09-09 06:21:32', '2020-09-09 06:21:32', 1),
(47, 'asd', 'taressgh1996nazari@gmail.com', NULL, '$2y$10$9xvIHGok9THPvUL1oCX1TuEYplNRo0bsoOf6u8Gu2LVhSwstW5Su2', NULL, '2020-09-09 06:22:18', '2020-09-09 06:22:18', 1),
(48, 'asdasd', 'a@gm.coms', NULL, '$2y$10$u5mMeM5Mb0B197PH9cSWNe07bayqLE2X/mkQyw6DFHpWUsNOqdeQu', NULL, '2020-09-09 07:53:32', '2020-09-09 07:53:32', 1),
(49, 'asdasd', 'aaaaaaa@gm.coma', NULL, '$2y$10$xYUJbUwElmL1AAzCe/QI0Oj8pv93mY2A7ylqwMARhCnIS8/aYNIuK', NULL, '2020-09-09 07:53:49', '2020-09-09 07:53:49', 1),
(50, 'asdasd', 'aaaassaaa@gm.coma', NULL, '$2y$10$.qUm5/HBDwgbKq0/UBmscOz6WTQYPLoj5QqLkUVAvmwCNQaI2Sdmi', NULL, '2020-09-09 07:54:14', '2020-09-09 07:54:14', 1),
(51, 'asd', 'storssse2@gmail.com', NULL, '$2y$10$nir0NWY3bIyn7w.dEOeMeOsgHzIPybS09GEnalpLeUFIFKYhFsUR2', NULL, '2020-09-09 07:55:15', '2020-09-09 07:55:15', 1),
(52, 'asdad', 'ajsgdasssd@gmail.com', NULL, '$2y$10$hVHRnORt/mbhy8.vls3rK.Xgg0aWg8/4opqVAMycUqU6uHMCKZUjW', NULL, '2020-09-09 07:56:02', '2020-09-09 07:56:02', 1),
(53, 'ta', 'tareq@gmail.com', NULL, '$2y$10$apGd2BQ0G7I86xrO4BFyLuWzG/u7C9Apg8R.Sn2AyS9wHnR8OC0bi', NULL, '2020-12-27 18:08:22', '2020-12-27 18:08:22', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `basket`
--
ALTER TABLE `basket`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `factor`
--
ALTER TABLE `factor`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lesson`
--
ALTER TABLE `lesson`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `oauth_access_tokens`
--
ALTER TABLE `oauth_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_access_tokens_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_auth_codes`
--
ALTER TABLE `oauth_auth_codes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_auth_codes_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_clients_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `oauth_refresh_tokens`
--
ALTER TABLE `oauth_refresh_tokens`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_comment`
--
ALTER TABLE `product_comment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `profiles`
--
ALTER TABLE `profiles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stores`
--
ALTER TABLE `stores`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `store_categories`
--
ALTER TABLE `store_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `store_comment`
--
ALTER TABLE `store_comment`
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
-- AUTO_INCREMENT for table `basket`
--
ALTER TABLE `basket`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `factor`
--
ALTER TABLE `factor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `lesson`
--
ALTER TABLE `lesson`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `product_comment`
--
ALTER TABLE `product_comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `profiles`
--
ALTER TABLE `profiles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `stores`
--
ALTER TABLE `stores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `store_categories`
--
ALTER TABLE `store_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `store_comment`
--
ALTER TABLE `store_comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
