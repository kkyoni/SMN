-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: projects-beta.com.mysql.service.one.com:3306
-- Generation Time: Aug 13, 2021 at 04:33 PM
-- Server version: 10.3.30-MariaDB-1:10.3.30+maria~focal
-- PHP Version: 7.2.24-0ubuntu0.18.04.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `projects_beta_com_simple`
--

-- --------------------------------------------------------

--
-- Table structure for table `balances`
--

CREATE TABLE `balances` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `transaction_id` bigint(20) DEFAULT NULL,
  `user_id` bigint(20) DEFAULT NULL,
  `opening_balance` double(15,2) DEFAULT NULL,
  `closing_balance` double(15,2) DEFAULT NULL,
  `commission` double(15,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `expenses`
--

CREATE TABLE `expenses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `to_user_id` bigint(20) DEFAULT NULL,
  `from_user_id` bigint(20) DEFAULT NULL,
  `expense_type_id` bigint(20) DEFAULT NULL,
  `transactions_id` bigint(20) DEFAULT NULL,
  `amount` double(8,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `expense_types`
--

CREATE TABLE `expense_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `expense_types`
--

INSERT INTO `expense_types` (`id`, `name`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'demo', '2021-08-13 14:04:42', '2021-08-13 14:04:42', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8_unicode_ci NOT NULL,
  `queue` text COLLATE utf8_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `opening_balance_inr` double(15,4) NOT NULL DEFAULT 0.0000,
  `opening_balance_aed` double(15,4) NOT NULL DEFAULT 0.0000,
  `opening_balance_usd` double(15,4) NOT NULL DEFAULT 0.0000,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `group_closing_balances`
--

CREATE TABLE `group_closing_balances` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `group_id` int(11) NOT NULL,
  `closing_balance_inr` double(15,4) DEFAULT NULL,
  `closing_balance_aed` double(15,4) DEFAULT NULL,
  `closing_balance_usd` double(15,4) DEFAULT NULL,
  `closing_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `int_transactions`
--

CREATE TABLE `int_transactions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) DEFAULT NULL,
  `group_id` int(11) DEFAULT NULL,
  `client_name` varchar(1000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `currency` tinyint(4) NOT NULL COMMENT '1=Indian, 2=USD',
  `amount` double(15,4) NOT NULL,
  `inr_conversation_rate` double(15,4) DEFAULT NULL,
  `usd_conversation_rate` double(15,4) DEFAULT NULL,
  `aed_amount` double(15,4) NOT NULL,
  `s_aed_amount` double(15,4) DEFAULT NULL,
  `s_inr_amount` double(15,4) DEFAULT NULL,
  `s_usd_amount` double(15,2) DEFAULT NULL,
  `s_usd_inr_amount` double(15,2) DEFAULT NULL,
  `usd_amount` double(15,4) DEFAULT NULL,
  `inr_amount` double(15,4) DEFAULT NULL,
  `created_at` date NOT NULL,
  `payment_mode` char(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `note` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `type` tinyint(4) DEFAULT NULL COMMENT '1=Cut,2=Book',
  `payment_received` tinyint(4) DEFAULT NULL COMMENT '1=Yes,0=No',
  `payment_given` tinyint(4) DEFAULT NULL COMMENT '1=Yes,2=No',
  `opening_balance_inr` double(15,4) NOT NULL DEFAULT 0.0000,
  `opening_balance_aed` double(15,4) NOT NULL DEFAULT 0.0000,
  `opening_balance_usd` double(15,4) NOT NULL DEFAULT 0.0000,
  `closing_balance_inr` double(15,4) NOT NULL DEFAULT 0.0000,
  `closing_balance_aed` double(15,4) NOT NULL DEFAULT 0.0000,
  `closing_balance_usd` double(15,4) NOT NULL DEFAULT 0.0000,
  `created_date_time` datetime DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(13, '2021_02_03_000000_create_failed_jobs_table', 1),
(14, '2021_02_03_000000_create_users_table', 1),
(15, '2021_02_03_100000_create_password_resets_table', 1),
(16, '2021_07_08_121847_create_settings_table', 1),
(17, '2021_08_04_093714_create_balances_table', 1),
(18, '2021_08_04_093722_create_expenses_table', 1),
(19, '2021_08_04_093724_create_expense_types_table', 1),
(20, '2021_08_04_093726_create_groups_table', 1),
(21, '2021_08_04_093728_create_group_closing_balances_table', 1),
(22, '2021_08_04_093730_create_int_transactions_table', 1),
(23, '2021_08_04_093737_create_payments_table', 1),
(24, '2021_08_04_104206_create_transactions_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `group_id` int(11) DEFAULT NULL,
  `amount` double(15,4) NOT NULL,
  `client_name` varchar(1000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `opening_balance_inr` double(15,4) NOT NULL,
  `opening_balance_aed` double(15,4) NOT NULL,
  `opening_balance_usd` double(15,4) NOT NULL,
  `closing_balance_inr` double(15,4) NOT NULL,
  `closing_balance_aed` double(15,4) NOT NULL,
  `closing_balance_usd` double(15,4) NOT NULL,
  `created_at` date NOT NULL,
  `created_date_time` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `type` enum('BOOLEAN','NUMBER','DATE','TEXT','SELECT','FILE','TEXTAREA') COLLATE utf8_unicode_ci DEFAULT NULL,
  `label` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `value` longtext COLLATE utf8_unicode_ci DEFAULT NULL,
  `hidden` varchar(191) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `code`, `type`, `label`, `value`, `hidden`, `created_at`, `updated_at`) VALUES
(1, 'application_logo', 'FILE', 'Application logo', 'VfCEKcFE0t.jpg', '0', '2021-08-04 08:14:31', '2021-08-04 08:14:31'),
(2, 'application_title', 'TEXT', 'Application Title', 'SMN', '0', '2021-08-04 08:14:31', '2021-08-04 08:14:31'),
(3, 'favicon_logo', 'FILE', 'Favicon Logo', 'quTPXQDbDe.png', '0', '2021-08-04 08:14:31', '2021-08-04 08:14:31'),
(4, 'copyright', 'TEXT', 'Copy Right', 'SMN', '0', '2021-08-04 08:14:31', '2021-08-04 08:14:31'),
(5, 'indian_balance', 'TEXT', 'Indian Balance', '0', '0', '2021-08-04 08:14:31', '2021-08-04 08:14:31'),
(6, 'dubai_balance', 'TEXT', 'Dubai Balance', '0', '0', '2021-08-04 08:14:31', '2021-08-04 08:14:31'),
(7, 'conversation_rate', 'TEXT', 'Conversation Rate', '4325', '0', '2021-08-04 08:14:31', '2021-08-04 08:14:31'),
(8, 'usd_balance', 'TEXT', 'Usd Balance', '0', '0', '2021-08-04 08:14:31', '2021-08-04 08:14:31'),
(9, 'conversation_rate_inr', 'TEXT', 'Conversation Rate Inr', '4818', '0', '2021-08-04 08:14:31', '2021-08-04 08:14:31'),
(10, 'conversation_rate_usd', 'TEXT', 'Conversation Rate Usd', '3.6725', '0', '2021-08-04 08:14:31', '2021-08-04 08:14:31'),
(11, 'conversation_rate_aed_to_inr', 'TEXT', 'Conversation Rate Aed To Inr', '4818', '0', '2021-08-04 08:14:31', '2021-08-04 08:14:31'),
(12, 'conversation_rate_aed_to_usd', 'TEXT', 'Conversation Rate Aed To Usd', '3.6725', '0', '2021-08-04 08:14:31', '2021-08-04 08:14:31');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_by` bigint(20) DEFAULT NULL,
  `accepted_by` bigint(20) DEFAULT NULL,
  `from_user_id` bigint(20) DEFAULT NULL,
  `to_user_id` bigint(20) DEFAULT NULL,
  `from_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `from_commission_amount` double(15,2) DEFAULT NULL,
  `from_commission` double(8,2) DEFAULT NULL,
  `from_current_balance` double(15,2) DEFAULT NULL,
  `from_total_balance` double(15,2) DEFAULT NULL,
  `from_closing_balance` double(15,2) DEFAULT NULL,
  `amount` double(15,2) DEFAULT NULL,
  `to_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `to_commission_amount` double(15,2) DEFAULT NULL,
  `to_commission` double(15,2) DEFAULT NULL,
  `to_current_balance` double(15,2) DEFAULT NULL,
  `to_total_balance` double(15,2) DEFAULT NULL,
  `to_closing_balance` double(15,2) DEFAULT NULL,
  `profit` double(15,2) DEFAULT NULL,
  `transaction_profit` double(15,2) DEFAULT NULL,
  `remarks` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sender_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sender_contact` bigint(20) DEFAULT NULL,
  `receiver_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `receiver_contact` bigint(20) DEFAULT NULL,
  `transaction_type` enum('1','2','3','4') COLLATE utf8_unicode_ci NOT NULL DEFAULT '1' COMMENT '1=Auto, 2=Manual, 3=Normal',
  `status` enum('1','2','3') COLLATE utf8_unicode_ci NOT NULL DEFAULT '1' COMMENT '1=Placed,2=Approved,3=Rejected',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `created_by`, `accepted_by`, `from_user_id`, `to_user_id`, `from_name`, `from_commission_amount`, `from_commission`, `from_current_balance`, `from_total_balance`, `from_closing_balance`, `amount`, `to_name`, `to_commission_amount`, `to_commission`, `to_current_balance`, `to_total_balance`, `to_closing_balance`, `profit`, `transaction_profit`, `remarks`, `sender_name`, `sender_contact`, `receiver_name`, `receiver_contact`, `transaction_type`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, NULL, 2, 3, 'ahat kalyan', NULL, 10000.50, 0.00, 10000.50, 10000.50, NULL, 'afnan kalyna', NULL, 10000.30, 0.00, 10000.30, -10000.30, 0.20, 0.20, 'REMARKS', 'ahat kalyan', 1234567890, 'afnan kalyan', 1234567890, '4', '2', '2021-08-06 08:07:17', '2021-08-06 08:07:17', NULL),
(2, 1, NULL, 4, 5, 'vijay ahemadnagar', NULL, 10000.50, 0.00, 10000.50, 10000.50, NULL, 'ajit thane', NULL, 10000.30, 0.00, 10000.30, -10000.30, 0.20, 0.20, 'REMARKS', 'vijay ahemadnagar', 1234567890, 'ajit thane', 1234567890, '4', '2', '2021-08-06 08:08:21', '2021-08-06 08:08:21', NULL),
(3, 1, NULL, 6, 7, 'anish makhi', NULL, 10000.50, 0.00, 10000.50, 10000.50, NULL, 'arvind kanti pune', NULL, 10000.30, 0.00, 10000.30, -10000.30, 0.20, 0.20, 'REMARKS', 'anish makhi', 1234567890, 'arvind kanti pune', 1234567890, '4', '2', '2021-08-06 08:09:24', '2021-08-06 08:09:24', NULL),
(4, 1, NULL, 8, 9, 'ashish mandre', NULL, 20000.50, 0.00, 20000.50, 20000.50, NULL, 'ashish mulund', NULL, 20000.30, 0.00, 20000.30, -20000.30, 0.20, 0.20, 'REMARKS', 'ashish mandre', 1234567890, 'ashish mulund', 1234567890, '4', '2', '2021-08-06 08:10:36', '2021-08-06 08:10:36', NULL),
(5, 1, NULL, 10, 11, 'ashpak kalyan', NULL, 10000.70, 0.00, 10000.70, 10000.70, NULL, 'pankaj aurangabad', NULL, 10000.20, 0.00, 10000.20, -10000.20, 0.50, 0.50, 'REMARKS', 'ashpak kalyan', 1234567890, 'pankaj aurangabad', 1234567890, '4', '2', '2021-08-06 08:11:49', '2021-08-06 08:11:49', NULL),
(6, 1, NULL, 2, 5, 'ahat kalyan', NULL, 20000.30, 10000.50, 20000.30, 30000.80, NULL, 'ajit thane', NULL, 20000.10, -10000.30, 20000.10, -30000.40, 0.20, 0.20, 'REMARKS', 'ahat kalyan', 1234567890, 'ajit thane', 1234567890, '4', '2', '2021-08-06 08:13:09', '2021-08-06 08:13:09', NULL),
(7, 1, NULL, 8, 4, 'ashish mandre', NULL, 20000.80, 20000.50, 20000.80, 40001.30, NULL, 'vijay ahemadnagar', NULL, 20000.40, 10000.50, 20000.40, -9999.90, 0.40, 0.40, 'REMARKS', 'ashish mandre', 1234567890, 'vijay ahemadnagar', 1234567890, '4', '2', '2021-08-06 08:14:16', '2021-08-06 08:14:16', NULL),
(8, 1, NULL, 14, 30, 'baba shahnawaz', NULL, 40000.40, 0.00, 40000.40, 40000.40, NULL, 'nirav nashik', NULL, 40000.30, 0.00, 40000.30, -40000.30, 0.10, 0.10, 'REMARKS', 'baba shahnawaz', 1234567890, 'nirav nashik', 1234567890, '4', '2', '2021-08-06 08:15:32', '2021-08-06 08:15:32', NULL),
(9, 1, NULL, 40, 57, 'SHREE JI', NULL, 3000.00, 0.00, 3000.00, 3000.00, NULL, 'PREM KM', NULL, 2000.00, 0.00, 2000.00, -2000.00, 1000.00, 1000.00, 'REMARKS', 'SHREE JI', 1234567890, 'PREM KM', 1234567890, '4', '2', '2021-08-06 08:16:33', '2021-08-06 08:16:33', NULL),
(10, 1, NULL, 29, 44, 'harshad kaka mumbai', NULL, 50000.70, 0.00, 50000.70, 50000.70, NULL, 'ALTAF NDSN', NULL, 50000.30, 0.00, 50000.30, -50000.30, 0.40, 0.40, 'REMARKS', 'harshad kaka mumbai', 1234567890, 'ALTAF NDSN', 1234567890, '4', '2', '2021-08-06 08:17:40', '2021-08-06 08:17:40', NULL),
(11, 1, NULL, 52, 111, 'JAGO SHREE JI', NULL, 30000.00, 0.00, 30000.00, 30000.00, NULL, 'amit mum', NULL, 1000.00, 0.00, 1000.00, -1000.00, 29000.00, 29000.00, 'REMARKS', 'JAGO SHREE JI', 1234567890, 'amit mum', 1234567890, '4', '2', '2021-08-06 08:18:38', '2021-08-06 08:18:38', NULL),
(12, 1, NULL, 47, 64, 'RAJU KADI', NULL, 36000.30, 0.00, 36000.30, 36000.30, NULL, 'PANKAJ VIVA GRP', NULL, 36000.00, 0.00, 36000.00, -36000.00, 0.30, 0.30, 'REMARKS', 'RAJU KADI', 1234567890, 'PANKAJ VIVA GRP', 1234567890, '4', '2', '2021-08-06 08:19:53', '2021-08-06 08:19:53', NULL),
(13, 1, NULL, 18, 48, 'bhura bhai', NULL, 10000.30, 0.00, 10000.30, 10000.30, NULL, 'HM ENT', NULL, 100.00, 0.00, 100.00, -100.00, 9900.30, 9900.30, 'REMARKS', 'bhura bhai', 1123456789, 'HM ENT', 1123456789, '4', '2', '2021-08-06 08:21:34', '2021-08-06 08:21:34', NULL),
(14, 1, NULL, 5, 19, 'ajit thane', NULL, 2500.00, -30000.40, 2500.00, -27500.40, NULL, 'brp vashi', NULL, 10.00, 0.00, 10.00, -10.00, 2490.00, 2490.00, 'REMARKS', 'ajit thane', 1234567890, 'brp vashi', 1234567890, '4', '2', '2021-08-06 08:22:19', '2021-08-06 08:22:19', NULL),
(15, 1, NULL, 50, 54, 'HOME', NULL, 5000.00, 0.00, 5000.00, 5000.00, NULL, 'KALU MUNSI', NULL, 4000.00, 0.00, 4000.00, -4000.00, 1000.00, 1000.00, 'REMARKS', 'HOME', 1234567890, 'KALU MUNSI', 1234567890, '4', '2', '2021-08-06 08:23:09', '2021-08-06 08:23:09', NULL),
(16, 1, NULL, 25, 29, 'dhanesh ght', NULL, 1502.03, 0.00, 1502.03, 1502.03, NULL, 'harshad kaka mumbai', NULL, 1501.02, 50000.70, 1501.02, 48499.68, 1.01, 1.01, 'REMARKS', 'dhanesh ght', 1234567890, 'harshad kaka mumbai', 1234567890, '4', '2', '2021-08-06 08:24:06', '2021-08-06 08:24:06', NULL),
(17, 1, NULL, 64, 55, 'PANKAJ VIVA GRP', NULL, 450.00, -36000.00, 450.00, -35550.00, NULL, 'KISHAN LUDHIYANA', NULL, 35.20, 0.00, 35.20, -35.20, 414.80, 414.80, 'REMARKS', 'PANKAJ VIVA GRP', 123456789, 'KISHAN LUDHIYANA', 123456789, '4', '2', '2021-08-06 08:25:00', '2021-08-06 08:25:00', NULL),
(18, 1, NULL, 56, 61, 'KISHOR MUMBAI', NULL, 10000.50, 0.00, 10000.50, 10000.50, NULL, 'NEHAL NGP', NULL, 10000.30, 0.00, 10000.30, -10000.30, 0.20, 0.20, 'REMARKS', 'KISHOR MUMBAI', 1235678950, 'NEHAL NGP', 1235678950, '4', '2', '2021-08-06 08:25:45', '2021-08-06 08:25:45', NULL),
(19, 1, NULL, 69, 71, 'praveen jija vashi', NULL, 150.00, 0.00, 150.00, 150.00, NULL, 'pritesh adajan', NULL, 10.00, 0.00, 10.00, -10.00, 140.00, 140.00, 'REMARKS', 'praveen jija vashi', 123456789, 'pritesh adajan', 123456789, '4', '2', '2021-08-06 08:26:38', '2021-08-06 08:26:38', NULL),
(20, 1, NULL, 65, 39, 'SABU PARBHNI', NULL, 1000.70, 0.00, 1000.70, 1000.70, NULL, 'P UMESH LUDHIYANA', NULL, 1000.30, 0.00, 1000.30, -1000.30, 0.40, 0.40, 'REMARKS', 'SABU PARBHNI', 123456789, 'P UMESH LUDHIYANA', 123456789, '4', '2', '2021-08-06 08:27:42', '2021-08-06 08:27:42', NULL),
(21, 1, NULL, 112, 113, 'RJKT', NULL, 1001.00, 0.00, 1001.00, 1001.00, NULL, 'SURAT', NULL, 1000.50, 0.00, 1000.50, -1000.50, 0.50, 0.50, NULL, 'AKSHAY', NULL, 'SUNIL', NULL, '4', '2', '2021-08-09 06:32:10', '2021-08-09 06:32:10', NULL),
(22, 1, NULL, 112, 48, 'RJKT', NULL, 1001.00, 1001.00, 1001.00, 2002.00, NULL, 'HM ENT', NULL, 1000.50, -100.00, 1000.50, -1100.50, 0.50, 0.50, NULL, NULL, NULL, NULL, NULL, '4', '2', '2021-08-09 07:08:09', '2021-08-09 07:08:09', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `user_type_id` tinyint(3) UNSIGNED NOT NULL DEFAULT 2 COMMENT '1=Admin,2=User',
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone_number` bigint(20) UNSIGNED DEFAULT NULL,
  `sender_commission` double(8,2) UNSIGNED DEFAULT NULL,
  `receiving_commission` double(8,2) UNSIGNED DEFAULT NULL,
  `limit` double(15,2) UNSIGNED DEFAULT NULL,
  `current_balance` double(15,2) DEFAULT 0.00,
  `image` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'default.png',
  `api_token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(3) UNSIGNED NOT NULL DEFAULT 1 COMMENT '1=Active,2=Inactive',
  `is_head_office` tinyint(3) UNSIGNED NOT NULL DEFAULT 0 COMMENT '1=Yes,0=No',
  `device_type` tinyint(3) UNSIGNED DEFAULT NULL COMMENT '1=Android,2=IOS',
  `is_verified` tinyint(3) UNSIGNED NOT NULL DEFAULT 0 COMMENT '1=Verified,0=Not Verified',
  `device_token` varchar(1000) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `created_by`, `user_type_id`, `name`, `code`, `username`, `password`, `address`, `city`, `phone_number`, `sender_commission`, `receiving_commission`, `limit`, `current_balance`, `image`, `api_token`, `status`, `is_head_office`, `device_type`, `is_verified`, `device_token`, `remember_token`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 1, 'Our Vatav', 'VAT', 'maet1947', '$2y$10$XjQQgbJGrXBGYS7EUGviD.5SnhomBXQHtrx./WHUhB3LQByeAcmx6', NULL, NULL, NULL, NULL, NULL, NULL, 43950.41, 'default.png', NULL, 1, 1, NULL, 0, NULL, 'mNN2bOhU4qO7BO8CxGzvjuspCPpCsjpJopSODdzSIDek8gSQRCB88tFfg1hM', '2021-05-04 23:53:04', '2021-08-09 07:08:09', NULL),
(2, 1, 2, 'ahat kalyan', 'ahat', 'ahat', '$2y$10$bDMBIVAPFxSTcW9k0JqcZOry7VIXVaSy75WfR8p.IW4YO5F7RvNna', NULL, 'kalyan', NULL, NULL, NULL, NULL, 30000.80, 'default.png', NULL, 1, 0, NULL, 0, NULL, NULL, '2021-07-01 06:27:20', '2021-08-06 08:13:09', NULL),
(3, 1, 2, 'afnan kalyna', 'afnan', 'afnan', '$2y$10$2h4w8Emh6VQKzGLry.ZKPe7XHJ4jy8Ics7DM/CJMnPGak/sMugwOK', NULL, 'kalyna', NULL, NULL, NULL, NULL, -10000.30, 'default.png', NULL, 1, 0, NULL, 0, NULL, NULL, '2021-07-01 06:28:32', '2021-08-06 08:07:17', NULL),
(4, 1, 2, 'vijay ahemadnagar', 'vijay', 'vijay', '$2y$10$pkxMaL3MdY.VwUYfY3qequ7BHzEwVkKPHRYLZHH0ao5aMLTg9U4ki', NULL, NULL, NULL, NULL, NULL, NULL, -9999.90, 'default.png', NULL, 1, 0, NULL, 0, NULL, NULL, '2021-07-01 06:29:50', '2021-08-06 08:14:16', NULL),
(5, 1, 2, 'ajit thane', 'ajit', 'ajit', '$2y$10$bDN61fu/FQnQTb/Xr5EObea09UowsN1/TfLP6Dd0/4.QfRTyzsu5W', NULL, NULL, NULL, NULL, NULL, NULL, -27500.40, 'default.png', NULL, 1, 0, NULL, 0, NULL, NULL, '2021-07-01 06:31:09', '2021-08-06 08:22:19', NULL),
(6, 1, 2, 'anish makhi', 'anis', 'anis', '$2y$10$wUPmCu9uscB6/eV7v0Tu1eL3xUwB1ulvZeVeK0HDB3dH2VOdQRcL2', NULL, NULL, NULL, NULL, NULL, NULL, 10000.50, 'default.png', NULL, 1, 0, NULL, 0, NULL, NULL, '2021-07-01 06:35:21', '2021-08-06 08:09:24', NULL),
(7, 1, 2, 'arvind kanti pune', 'akp', 'akp', '$2y$10$RvVOn8572YMttgXeDUsrp.z5lh3OiB6keRa4oyDQARUmCbYP4qqTa', NULL, NULL, NULL, NULL, NULL, NULL, -10000.30, 'default.png', NULL, 1, 0, NULL, 0, NULL, NULL, '2021-07-01 06:36:26', '2021-08-06 08:09:24', NULL),
(8, 1, 2, 'ashish mandre', 'ashish', 'ashish', '$2y$10$yUw2LIfpOX.qezqRHAWqyumSh4jTcYlxhHv9odaJTNSwHv9rP3KGy', NULL, NULL, NULL, NULL, NULL, NULL, 40001.30, 'default.png', NULL, 1, 0, NULL, 0, NULL, NULL, '2021-07-01 06:37:23', '2021-08-06 08:14:16', NULL),
(9, 1, 2, 'ashish mulund', 'as mulund', 'as mulund', '$2y$10$KRvG/TVk6nVY3h0t7SW.FusYpnN7i2TVhPAhtTUfteSDW6bX2cDQm', NULL, NULL, NULL, NULL, NULL, NULL, -20000.30, 'default.png', NULL, 1, 0, NULL, 0, NULL, NULL, '2021-07-01 06:38:56', '2021-08-06 08:10:36', NULL),
(10, 1, 2, 'ashpak kalyan', 'ashpak', 'ashpak', '$2y$10$VUalSk5iJVAitQHVY0.Mp.HUcad3gy/gBdrF/3SGy.nT.zfdaNYOe', NULL, NULL, NULL, NULL, NULL, NULL, 10000.70, 'default.png', NULL, 1, 0, NULL, 0, NULL, NULL, '2021-07-01 06:40:01', '2021-08-06 08:11:49', NULL),
(11, 1, 2, 'pankaj aurangabad', 'pankaj', 'pankaj', '$2y$10$MUVUmghX8rZLMnpuey0WluAhvtivjaI/u5FP5UIdHEcw9tlwO6xo.', NULL, NULL, NULL, NULL, NULL, NULL, -10000.20, 'default.png', NULL, 1, 0, NULL, 0, NULL, NULL, '2021-07-01 06:40:52', '2021-08-06 08:11:49', NULL),
(12, 1, 2, 'avkash jain', 'avkash', 'avkash', '$2y$10$wDVPlj5wGjaGdaVS2NChluocbRsEJlIBMaq.wNa7xFsdtx8OaGBLm', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'default.png', NULL, 1, 0, NULL, 0, NULL, NULL, '2021-07-01 06:41:32', '2021-07-01 12:23:34', NULL),
(13, 1, 2, 'bablu malad', 'b mld', 'b mld', '$2y$10$HJgk8rhPmj.h0RkQxBSqcOPDtGJu/XQe9O/zUGcWT5ahHaApCfXJO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'default.png', NULL, 1, 0, NULL, 0, NULL, NULL, '2021-07-01 06:42:21', '2021-07-01 11:07:19', NULL),
(14, 1, 2, 'baba shahnawaz', 'baba', 'baba', '$2y$10$X2P/ncdfTRBmaOV91sxTpOeyeHRP5v6bTFRw7LZzsX.mlgqhBFCz.', NULL, NULL, NULL, NULL, NULL, NULL, 40000.40, 'default.png', NULL, 1, 0, NULL, 0, NULL, NULL, '2021-07-01 06:43:01', '2021-08-06 08:15:32', NULL),
(15, 1, 2, 'BEST', 'best', 'best', '$2y$10$UtLRPKZ6v2C2frVZ9s0.jeh4OJgj32Tyv3IQjUwsbMVJks7NOTK0a', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'default.png', NULL, 1, 0, NULL, 0, NULL, NULL, '2021-07-01 06:46:17', '2021-07-01 11:15:01', NULL),
(16, 1, 2, 'bhakhar farid', 'bhakhar', 'bhakhar', '$2y$10$A/cX8bV6qikTkUr1NpTakO6eIRwsrMaBnGuRXTiH8HQ4f03kmZf9W', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'default.png', NULL, 1, 0, NULL, 0, NULL, NULL, '2021-07-01 06:47:02', '2021-07-01 06:47:14', NULL),
(17, 1, 2, 'bhavesh jain', 'bhavesh', 'bhavesh', '$2y$10$2TjDH05OmfJzyDwpdQq..e0Eh812BwN6KW7avvVvSRvH8kUKcWkxu', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'default.png', NULL, 1, 0, NULL, 0, NULL, NULL, '2021-07-01 06:47:50', '2021-07-01 06:48:01', NULL),
(18, 1, 2, 'bhura bhai', 'bhura', 'bhura', '$2y$10$5I.MBMRKThe4e.mhKBUoa.fkI3Ww8pr8OyGs7WZtvbOEI744cpGjK', NULL, NULL, NULL, NULL, NULL, NULL, 10000.30, 'default.png', NULL, 1, 0, NULL, 0, NULL, NULL, '2021-07-01 06:49:05', '2021-08-06 08:21:34', NULL),
(19, 1, 2, 'brp vashi', 'brp', 'brp', '$2y$10$H.XLwCpY7.Br3r3eEGZ9euajU/EC9ks9ZL/voVHNydk2HOQcRLxbG', NULL, NULL, NULL, NULL, NULL, NULL, -10.00, 'default.png', NULL, 1, 0, NULL, 0, NULL, NULL, '2021-07-01 06:50:34', '2021-08-06 08:22:19', NULL),
(20, 1, 2, 'bunty solapur', 'bunty', 'bunty', '$2y$10$r1Yh3rAZpxJTrrhhK9tBbO78a2.yw8VHDs/QE218BgbuVMEduneUO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'default.png', NULL, 1, 0, NULL, 0, NULL, NULL, '2021-07-01 06:51:17', '2021-07-01 06:51:24', NULL),
(21, 1, 2, 'cash', 'cash', 'cash', '$2y$10$/uCS8/Nkt7236OYQGgjYj.IeA2oefpct/IxffZo8RM5hTZkG.VKwS', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'default.png', NULL, 1, 0, NULL, 0, NULL, NULL, '2021-07-01 06:51:56', '2021-07-01 12:28:29', NULL),
(22, 1, 2, 'chhagan mld', 'c mld', 'c mld', '$2y$10$G46Ktzst2DI1Pmi0/BqcXOf8AZgWh9fx1Y8ZwqNVV1kG8..tZIhY.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'default.png', NULL, 1, 0, NULL, 0, NULL, NULL, '2021-07-01 06:53:38', '2021-07-01 12:25:38', NULL),
(23, 1, 2, 'chhota lalit', 'lalit', 'lalit', '$2y$10$8TJCK2JW7wK.Wiw57kxA1.WI6xgz0BdsBmyFHZHg9kd7OT/cQe5Uq', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'default.png', NULL, 1, 0, NULL, 0, NULL, NULL, '2021-07-01 06:54:06', '2021-07-01 06:54:14', NULL),
(24, 1, 2, 'montu delhi', 'montu', 'montu', '$2y$10$OanbEPXv6aUrmjDhUKMCwu1Ks15yRQEjfpgo1wmd43hgA/z7TVxPm', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'default.png', NULL, 1, 0, NULL, 0, NULL, NULL, '2021-07-01 06:54:55', '2021-07-01 06:55:02', NULL),
(25, 1, 2, 'dhanesh ght', 'dhanesh', 'dhanesh', '$2y$10$/y5WgN.o0psytETl7srDRO3Z6MmCHZ5nb2Xe3tTLwW3kCCEviCde6', NULL, NULL, NULL, NULL, NULL, NULL, 1502.03, 'default.png', NULL, 1, 0, NULL, 0, NULL, NULL, '2021-07-01 06:55:43', '2021-08-06 08:24:06', NULL),
(26, 1, 2, 'pankaj dhuliya', 'p dhuliya', 'p dhuliya', '$2y$10$h.YiCKhHG7Np2QQwRuU4V.iE1ID6o4Gq1.u4hQ9U64XwTDSaPrXTa', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'default.png', NULL, 1, 0, NULL, 0, NULL, NULL, '2021-07-01 06:56:42', '2021-07-01 10:04:23', NULL),
(27, 1, 2, 'ginesh ghatkopar', 'g ght', 'g ght', '$2y$10$Ga.NRqvYQwG7eKNSLt4gwuwqFZuTTQ0.dJHQxdXSoejPwsimTpg.y', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'default.png', NULL, 1, 0, NULL, 0, NULL, NULL, '2021-07-01 06:58:08', '2021-07-01 06:58:17', NULL),
(28, 1, 2, 'goodluck', 'good', 'good', '$2y$10$/aeIIyfhXBN.MnbAWIR83uflrx0v7v3ih9fIw3BkySenZDBM9TbDS', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'default.png', NULL, 1, 0, NULL, 0, NULL, NULL, '2021-07-01 06:59:09', '2021-07-01 11:11:13', NULL),
(29, 1, 2, 'harshad kaka mumbai', 'harshad', 'harshad', '$2y$10$UlxcC0QDOiVli..KR74VauoFOmimnpyodyA5BGlruG.Qebqt2nFJ.', NULL, NULL, NULL, NULL, NULL, NULL, 48499.68, 'default.png', NULL, 1, 0, NULL, 0, NULL, NULL, '2021-07-01 07:00:24', '2021-08-06 08:24:06', NULL),
(30, 1, 2, 'nirav nashik', 'nirav', 'nirav', '$2y$10$D9OBLy1KPVmWK98RNgeZDOt.2UJygnA3FyjQGJjHUxf.KUJ5hLzIS', NULL, NULL, NULL, NULL, NULL, NULL, -40000.30, 'default.png', NULL, 1, 0, NULL, 0, NULL, NULL, '2021-07-01 07:03:08', '2021-08-06 08:15:32', NULL),
(31, 1, 2, 'vinod sangli', 'vinod', 'vinod', '$2y$10$4bIm3DQ41joLj5MVIpDSLOHtakkXJIMRIDvk1x13Pv0mPV03FuciW', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'default.png', NULL, 1, 0, NULL, 0, NULL, NULL, '2021-07-01 07:04:03', '2021-07-01 12:26:49', NULL),
(32, 1, 2, 'JAGDISH LATUR', 'JAGDISH', 'JAGDISH', '$2y$10$gZFkquZpdxLp9Q25kOhIzeKfx26ZB2kx/LnKfFzz5F/ewbXEad9M6', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'default.png', NULL, 1, 0, NULL, 0, NULL, NULL, '2021-07-01 07:36:17', '2021-07-01 07:38:06', NULL),
(33, 1, 2, 'MOTIRAM KHAMGAO', 'MOTI', 'MOTI', '$2y$10$LJc8.FP16gDH4/JooFLkCeu7Hv6K6Ugu3vR3.nCerN1wdo.U81qf2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'default.png', NULL, 1, 0, NULL, 0, NULL, NULL, '2021-07-01 07:39:07', '2021-07-01 07:40:59', NULL),
(34, 1, 2, 'RAMESH BHUJ', 'RAMESH', 'RAMESH', '$2y$10$iTYsWEMEVgmiEQRo3J0Xke.K/75eOGrQdbqTs52A9F7J2.xBsvAaa', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'default.png', NULL, 1, 0, NULL, 0, NULL, NULL, '2021-07-01 07:41:55', '2021-07-01 07:42:21', NULL),
(35, 1, 2, 'RAJU RAJKOT', 'RAJU', 'RAJU', '$2y$10$px23nt/kNcGNhvg7AnhffeszhzIghiJ7n7uo0z1hFCxNXez1fbLCu', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'default.png', NULL, 1, 0, NULL, 0, NULL, NULL, '2021-07-01 07:42:37', '2021-07-01 07:42:48', NULL),
(36, 1, 2, 'SAGAR HUBLI', 'SAGAR', 'SAGAR', '$2y$10$rxeGjMY2nooTGHZWR3FJZOF0ED3prvl8MEKoe7zHE05ybYlbh.d9W', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'default.png', NULL, 1, 0, NULL, 0, NULL, NULL, '2021-07-01 07:43:02', '2021-07-01 07:43:21', NULL),
(37, 1, 2, 'KOLHAPUR', 'KOL', 'KOL', '$2y$10$a2ZR0B5nCPQSVxqqvL2XRuTi1SRPm7sRNSmJHWDnXElVh7sec4fLq', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'default.png', NULL, 1, 0, NULL, 0, NULL, NULL, '2021-07-01 07:43:48', '2021-07-01 12:23:07', NULL),
(38, 1, 2, 'KESHAV HYD', 'HYD', 'HYD', '$2y$10$V2wOcjw9y2Hn1KktL25jDOwIhK0x4fMYjYX3ZJKh2TgPe7kq1/1i2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'default.png', NULL, 1, 0, NULL, 0, NULL, NULL, '2021-07-01 07:44:19', '2021-07-01 12:28:29', NULL),
(39, 1, 2, 'P UMESH LUDHIYANA', 'P UMESH', 'P UMESH', '$2y$10$ZvKkrHbDE2d3XfyWflVYcOi8elQMwhW/d3rs8ZbMFuTPvDtKTKj2i', NULL, NULL, NULL, NULL, NULL, NULL, -1000.30, 'default.png', NULL, 1, 0, NULL, 0, NULL, NULL, '2021-07-01 07:44:49', '2021-08-06 08:27:42', NULL),
(40, 1, 2, 'SHREE JI', 'SHREE', 'SHREE', '$2y$10$5BmwGlslOvpft0bb6DqDWuyh9I/MvwryHBBdyJQuTDRM.9WJvMMnK', NULL, NULL, NULL, NULL, NULL, NULL, 3000.00, 'default.png', NULL, 1, 0, NULL, 0, NULL, NULL, '2021-07-01 07:46:25', '2021-08-06 08:16:33', NULL),
(41, 1, 2, 'VIPUL DHULIYA', 'V DHULIYA', 'V DHULIYA', '$2y$10$zb3l0egoNeoF39tx7d9Ez.gdszNVFQnWShhH9C72O.EgZmD2OHo7G', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'default.png', NULL, 1, 0, NULL, 0, NULL, NULL, '2021-07-01 07:47:07', '2021-07-01 09:55:05', NULL),
(42, 1, 2, 'PRAMOD JLGN', 'PRAMOD', 'PRAMOD', '$2y$10$Z0OQOzUyMq0ZzyeiskKP5uSUYn4/EiMUx/DXB64N3XzrSoS.LlLKC', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'default.png', NULL, 1, 0, NULL, 0, NULL, NULL, '2021-07-01 07:47:44', '2021-07-01 10:10:20', NULL),
(43, 1, 2, 'RAJU GHATKOPAR', 'RAJU GHT', 'RAJU GHT', '$2y$10$TjJkEj3at1X.oOUfh3u1GeDsQM9RIUSuY6HIZ77IiuDpYaO57begm', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'default.png', NULL, 1, 0, NULL, 0, NULL, NULL, '2021-07-01 07:48:20', '2021-07-01 12:26:49', NULL),
(44, 1, 2, 'ALTAF NDSN', 'ALTAF', 'ALTAF', '$2y$10$NuUH1vjLoeq.Erg9/MmoB.p693O4ZaqxMVitU6Q6mrpJrSJsd/kCq', NULL, NULL, NULL, NULL, NULL, NULL, -50000.30, 'default.png', NULL, 1, 0, NULL, 0, NULL, NULL, '2021-07-01 07:48:52', '2021-08-06 08:17:40', NULL),
(45, 1, 2, 'JAGDISH AJMER', 'JAGDISH A', 'JAGDISH A', '$2y$10$7PfnpS41bNdXjlCggs7I0.dx1xnV1UkXwgwMDrhL2c.ZsRfsxu6c.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'default.png', NULL, 1, 0, NULL, 0, NULL, NULL, '2021-07-01 07:49:33', '2021-07-01 09:19:35', NULL),
(46, 1, 2, 'JAYESH MARVEL', 'JAYESH', 'JAYESH', '$2y$10$bZDZa.iP5Z8sKyVuvLWgWOr4mKEOalQLX7yPB.HwY9lWdGrtEQSZC', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'default.png', NULL, 1, 0, NULL, 0, NULL, NULL, '2021-07-01 07:50:40', '2021-07-01 07:51:00', NULL),
(47, 1, 2, 'RAJU KADI', 'R KADI', 'R KADI', '$2y$10$Qcwe5RKhbG9iUVdY5HeTi.qPwJ4dujcplKYJmuC774SgwxWX0b6ne', NULL, NULL, NULL, NULL, NULL, NULL, 36000.30, 'default.png', NULL, 1, 0, NULL, 0, NULL, NULL, '2021-07-01 07:51:28', '2021-08-06 08:19:53', NULL),
(48, 1, 2, 'HM ENT', 'HM', 'HM', '$2y$10$ZrjZynAtJbBexPBLdscMeum5k/lFETBPAPjxr7wfo9gPFY/THUEIa', NULL, NULL, NULL, NULL, NULL, NULL, -1100.50, 'default.png', NULL, 1, 0, NULL, 0, NULL, NULL, '2021-07-01 07:53:07', '2021-08-09 07:08:09', NULL),
(49, 1, 2, 'HM NASHIK', 'HM N', 'HM N', '$2y$10$WrTjzzdyoVcmOSC2JSNoOOaQz5mu5MJOVFZLQq3eAUpF8QxYv3LkG', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'default.png', NULL, 1, 0, NULL, 0, NULL, NULL, '2021-07-01 07:54:29', '2021-07-01 07:54:47', NULL),
(50, 1, 2, 'HOME', 'HOME', 'HOME', '$2y$10$y8hs1EoOfFUOlIUCfVigLevBhmhVdP9C5XKZHpIILx3fIdsvmF8DG', NULL, NULL, NULL, NULL, NULL, NULL, 5000.00, 'default.png', NULL, 1, 0, NULL, 0, NULL, NULL, '2021-07-01 07:55:53', '2021-08-06 08:23:09', NULL),
(51, 1, 2, 'ILIYASH VASHI', 'ILIYAS', 'ILIYAS', '$2y$10$xNJxNW7LXoO7.xVt7ZS0/eSpOkZKWBuEu2ei8Kg1hqcP/lbJ.VJNe', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'default.png', NULL, 1, 0, NULL, 0, NULL, NULL, '2021-07-01 07:57:42', '2021-07-01 08:00:05', NULL),
(52, 1, 2, 'JAGO SHREE JI', 'JAGO', 'JAGO', '$2y$10$grySAm1ohfaKud81yKAqQ.Z5XZ1x98kM1KB4WhPIomcEHcwmb/QcC', NULL, NULL, NULL, NULL, NULL, NULL, 30000.00, 'default.png', NULL, 1, 0, NULL, 0, NULL, NULL, '2021-07-01 08:02:04', '2021-08-06 08:18:38', NULL),
(53, 1, 2, 'KALP IMPEX', 'KALP', 'KALP', '$2y$10$pU38Ous6xUH6gReCPK1Ev.dACvXX.KKbvrx7AtwmIR2QgX7/RqAXq', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'default.png', NULL, 1, 0, NULL, 0, NULL, NULL, '2021-07-01 08:04:10', '2021-07-01 08:04:27', NULL),
(54, 1, 2, 'KALU MUNSI', 'KALU', 'KALU', '$2y$10$hJwxLoiIr0/81rG78lFqaeO6ct53FXHEKRswely6Dy3sO/0in2TWG', NULL, NULL, NULL, NULL, NULL, NULL, -4000.00, 'default.png', NULL, 1, 0, NULL, 0, NULL, NULL, '2021-07-01 08:04:56', '2021-08-06 08:23:09', NULL),
(55, 1, 2, 'KISHAN LUDHIYANA', 'KISHAN', 'KISHAN', '$2y$10$ZxXov/gfmCUFQFstLHX/zOjaBsaqAXnLX7Vdmic07WsS45inWL/0m', NULL, NULL, NULL, NULL, NULL, NULL, -35.20, 'default.png', NULL, 1, 0, NULL, 0, NULL, NULL, '2021-07-01 08:06:41', '2021-08-06 08:25:00', NULL),
(56, 1, 2, 'KISHOR MUMBAI', 'KISHOR', 'KISHOR', '$2y$10$.pEwHW/SzY0g3ztHG.gikuYL6nBa/e.53ODfSc7Vk6wHxfUL4Wjaa', NULL, NULL, NULL, NULL, NULL, NULL, 10000.50, 'default.png', NULL, 1, 0, NULL, 0, NULL, NULL, '2021-07-01 08:07:16', '2021-08-06 08:25:45', NULL),
(57, 1, 2, 'PREM KM', 'KM', 'KM', '$2y$10$fv3gG0alAvLY6ehkPZTANOjzdj1qqG1YUg6p2XwNpfYUjZZf5C9Xq', NULL, NULL, NULL, NULL, NULL, NULL, -2000.00, 'default.png', NULL, 1, 0, NULL, 0, NULL, NULL, '2021-07-01 08:07:49', '2021-08-06 08:16:33', NULL),
(58, 1, 2, 'NAKODA MUM', 'N MUM', 'N MUM', '$2y$10$xBl59f26Y0ZHmJ4hsWqUj.usuL2Xg8DZDLhlpFSJ3FrMW6r3X1pDy', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'default.png', NULL, 1, 0, NULL, 0, NULL, NULL, '2021-07-01 08:15:04', '2021-07-01 12:23:34', NULL),
(59, 1, 2, 'NAKODA PAPER N PARCEL', 'NPP', 'NPP', '$2y$10$pJ4.oAL9BfdcENPYwU5Cruvq.2wq0thzaJ2kpHDTFYRlYB3BtkxZu', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'default.png', NULL, 1, 0, NULL, 0, NULL, NULL, '2021-07-01 08:15:52', '2021-07-01 08:16:00', NULL),
(60, 1, 2, 'NASIR DELHI', 'NASIR', 'NASIR', '$2y$10$7jdAUxDhnh4RL5S1p0lIsOcpbkFQIAnEyCEwP398zxBH1Jvvc1Eji', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'default.png', NULL, 1, 0, NULL, 0, NULL, NULL, '2021-07-01 08:16:55', '2021-07-01 08:17:02', NULL),
(61, 1, 2, 'NEHAL NGP', 'N NGP', 'N NGP', '$2y$10$xadD13oKmz1C8fsq3pyXJebgTFStdRgoNdCKRw/HKggNX2VrOXUuK', NULL, NULL, NULL, NULL, NULL, NULL, -10000.30, 'default.png', NULL, 1, 0, NULL, 0, NULL, NULL, '2021-07-01 08:17:46', '2021-08-06 08:25:45', NULL),
(62, 1, 2, 'NITESH VAPI', 'N VAPI', 'N VAPI', '$2y$10$6kS4bxBb3rshlZ8tnwy5aeOqBQW.keAKlStD6ZFOej6wFilAW/rUq', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'default.png', NULL, 1, 0, NULL, 0, NULL, NULL, '2021-07-01 08:19:55', '2021-07-01 08:33:23', NULL),
(63, 1, 2, 'P UMESH VSHI', 'P VASHI', 'P VASHI', '$2y$10$ucHWAa6VAZNuSCCloJrlVuRjErNwNkhIr9StH7pv5I1jDC8xGxSDy', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'default.png', NULL, 1, 0, NULL, 0, NULL, NULL, '2021-07-01 08:21:27', '2021-07-01 08:21:53', NULL),
(64, 1, 2, 'PANKAJ VIVA GRP', 'P VIVA', 'P VIVA', '$2y$10$iqQwI0YNMbKOZUIitZ0XxuXfWrm4r6amPenPWT5T8oP4tHXojvZb.', NULL, NULL, NULL, NULL, NULL, NULL, -35550.00, 'default.png', NULL, 1, 0, NULL, 0, NULL, NULL, '2021-07-01 08:22:32', '2021-08-06 08:25:00', NULL),
(65, 1, 2, 'SABU PARBHNI', 'SABU', 'Sabu', '$2y$10$eKoaTFRsf20bEZO7iC.kPOg.O2f2r62S6NyTk8kJpWpTc6Ib52gnm', NULL, NULL, NULL, NULL, NULL, NULL, 1000.70, 'default.png', NULL, 1, 0, NULL, 0, NULL, NULL, '2021-07-01 08:23:16', '2021-08-06 08:27:42', NULL),
(66, 1, 2, 'parcel', 'parcel', 'parcel', '$2y$10$SzhIZqQsdo/ijNuyM1moz.XX0uWp70BHIssB9DGm8BC/Ix9h1sjWK', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'default.png', NULL, 1, 0, NULL, 0, NULL, NULL, '2021-07-01 08:24:06', '2021-07-01 08:24:18', NULL),
(67, 1, 2, 'pm uls', 'pm', 'pm', '$2y$10$aah/5PDquGIyeomL87E7Yu2aGBVGZlK3kd/kU0fjfC2O2TQ.IK3bG', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'default.png', NULL, 1, 0, NULL, 0, NULL, NULL, '2021-07-01 08:26:00', '2021-07-01 08:26:25', NULL),
(68, 1, 2, 'prashant gondiya', 'prashant', 'prashant', '$2y$10$4o/8tPcZOBBj2WkA7fg/yusD2SA6iu7PrVt9fldIoqDf.GeBXFScG', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'default.png', NULL, 1, 0, NULL, 0, NULL, NULL, '2021-07-01 08:27:41', '2021-07-01 08:27:49', NULL),
(69, 1, 2, 'praveen jija vashi', 'praveen', 'praveen', '$2y$10$4..Ajp4N1Rhl8Zi38Ay1R.ScekfaHd1KQilVyc8KLTRklbsXjj6tG', NULL, NULL, NULL, NULL, NULL, NULL, 150.00, 'default.png', NULL, 1, 0, NULL, 0, NULL, NULL, '2021-07-01 08:28:34', '2021-08-06 08:26:38', NULL),
(70, 1, 2, 'praveen trimurti', 'praveen t', 'praveen t', '$2y$10$GkRDKFdqukKovIBQZh2IduOZsx2krd9z.kWvDF1wHGR8vTk67swCe', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'default.png', NULL, 1, 0, NULL, 0, NULL, NULL, '2021-07-01 08:30:21', '2021-07-01 08:30:30', NULL),
(71, 1, 2, 'pritesh adajan', 'pritesh', 'pritesh', '$2y$10$/sU3KueBPaMgDyuA7wtEzuyX0FFco.YbwViZnnZALosoh3y/j2MA6', NULL, NULL, NULL, NULL, NULL, NULL, -10.00, 'default.png', NULL, 1, 0, NULL, 0, NULL, NULL, '2021-07-01 08:30:53', '2021-08-06 08:26:38', NULL),
(72, 1, 2, 'raja amritsir', 'raja', 'raja', '$2y$10$vo7A6PAY1wx12512adaZieuMBNchWtWh159q5GUX5i6SOn0GYr9a6', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'default.png', NULL, 1, 0, NULL, 0, NULL, NULL, '2021-07-01 08:35:17', '2021-07-01 10:02:27', NULL),
(73, 1, 2, 'rajesh kalani', 'rajesh', 'rajesh', '$2y$10$y/to/W5Okwm/9eUPYCcwP.aQ2wBsLarUQVLProdorLAodxgygFlQG', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'default.png', NULL, 1, 0, NULL, 0, NULL, NULL, '2021-07-01 08:36:10', '2021-07-01 08:39:43', NULL),
(74, 1, 2, 'rajesh pathare', 'r pathare', 'r pathare', '$2y$10$LPt62Cx5fas4.eONeRT0Ye2Wnvwuowdhp.DMu4xOVjY/LqYGuhROC', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'default.png', NULL, 1, 0, NULL, 0, NULL, NULL, '2021-07-01 08:37:26', '2021-07-01 08:37:33', NULL),
(75, 1, 2, 'rajni kanti pintu', 'rajni kanti', 'rajni kanti', '$2y$10$Jj6k9lWnfiXTz8QsyXRim.CR3EZ9Tfa11Qk.vgI0BfbcN2Nw6z2yK', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'default.png', NULL, 1, 0, NULL, 0, NULL, NULL, '2021-07-01 08:38:08', '2021-07-01 08:38:08', NULL),
(76, 1, 2, 'raju pimpri', 'r pimpri', 'r pimri', '$2y$10$g0aqGrU9mw4c0LxJ7XWC4Og1F1iyvHIUCl7AIbOFzor6w7TqTzWmW', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'default.png', NULL, 1, 0, NULL, 0, NULL, NULL, '2021-07-01 08:38:42', '2021-07-01 12:14:20', NULL),
(77, 1, 2, 'raju dinkar', 'raju d', 'raju d', '$2y$10$GBh6Zg43gEdU6epXeoriH.gm71iWJJPx2hLAPSQxv2UOVsrUr82Sm', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'default.png', NULL, 1, 0, NULL, 0, NULL, NULL, '2021-07-01 08:40:13', '2021-07-01 08:40:21', NULL),
(78, 1, 2, 'raju uls', 'r uls', 'r uls', '$2y$10$FHQCXDe3QndOJbN1PdwuAuPbp//VgqYZWcAITLmeA0u61c7Lw/qyO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'default.png', NULL, 1, 0, NULL, 0, NULL, NULL, '2021-07-01 08:41:09', '2021-07-01 09:00:53', NULL),
(79, 1, 2, 'rakesh raipur', 'r raipur', 'r raipur', '$2y$10$LGGFhKZRAC0cqweTItF0jOTdDQvsjhxTwIFPk6FY5hC43teRUM31m', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'default.png', NULL, 1, 0, NULL, 0, NULL, NULL, '2021-07-01 08:41:45', '2021-07-01 08:41:49', NULL),
(80, 1, 2, 'ram kothwani', 'ram', 'ram', '$2y$10$hxeGLKDP7evf6BZHHVzyl.9C6ierJZe7pUqlg8RLEhqs/3lnV7aym', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'default.png', NULL, 1, 0, NULL, 0, NULL, NULL, '2021-07-01 08:42:11', '2021-07-01 08:42:18', NULL),
(81, 1, 2, 'ramesh bhaji', 'r bhaji', 'r bhaji', '$2y$10$sB9ZufKmrxaO64Hq7ceWJu6UwSOKPKYok9L6xv/cCJrdgDknGREFa', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'default.png', NULL, 1, 0, NULL, 0, NULL, NULL, '2021-07-01 08:42:56', '2021-07-01 08:48:07', NULL),
(82, 1, 2, 'ramesh bhuj', '82_r bhuj', '82_r bhuj', '$2y$10$1wnUCyWzD3czMRuIYVyvqux6lhGepC5gSM//kwH3bUltPKyQ5g8Sa', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'default.png', NULL, 1, 0, NULL, 0, NULL, NULL, '2021-07-01 08:43:11', '2021-07-01 08:43:23', '2021-07-01 08:43:23'),
(83, 1, 2, 'ramesh ndsn', 'r ndsn', 'r ndsn', '$2y$10$OnPyMHDNC73V/C2YYovklubUNCMZKAQZjCqa.VZYD24y6WVbJXoD.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'default.png', NULL, 1, 0, NULL, 0, NULL, NULL, '2021-07-01 08:43:52', '2021-07-01 08:44:02', NULL),
(84, 1, 2, 'ramu dom', 'ramu', 'ramu', '$2y$10$P4/F.EUvF9RkOKKwo2TIYusyymlAd7pR2tvjsrn9wFdP1NFyHWNbK', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'default.png', NULL, 1, 0, NULL, 0, NULL, NULL, '2021-07-01 08:44:59', '2021-07-01 08:45:07', NULL),
(85, 1, 2, 's bharat', 's bharat', 's bharat', '$2y$10$1BLysqjOkfuD9nBrHd308eOADK5sD2lY0yb.D98GqLvljHc45oQPq', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'default.png', NULL, 1, 0, NULL, 0, NULL, NULL, '2021-07-01 08:46:45', '2021-07-01 08:46:45', NULL),
(86, 1, 2, 'sachin karia', 'sachin', 'sachin', '$2y$10$Tj/tEiypg77ImAWQ2ke57eFcL1T/HVS9u8BN/aMvPtPxHeEkqL/bq', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'default.png', NULL, 1, 0, NULL, 0, NULL, NULL, '2021-07-01 08:48:40', '2021-07-01 08:48:52', NULL),
(87, 1, 2, 'sai ac', 'sai', 'sai', '$2y$10$qNbQhZXMwEB.eN/cM6SJteHIagDk/l80HTmfFOfMcG9AjVxLZ/7A2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'default.png', NULL, 1, 0, NULL, 0, NULL, NULL, '2021-07-01 08:49:43', '2021-07-01 08:49:51', NULL),
(88, 1, 2, 'sandeep ght', 's ght', 's ght', '$2y$10$QtTi6H5w6gOKc7q7WSF1HuvXhvTYxD8euGqQ3epueGUJbCSpv8y6W', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'default.png', NULL, 1, 0, NULL, 0, NULL, NULL, '2021-07-01 08:50:20', '2021-07-01 08:50:51', NULL),
(89, 1, 2, 'santosh amd', 's amd', 's amd', '$2y$10$dRrSaq5VLenjWcMCbcwQQ.8GAQA4eSxedD1YQILJ6GJbHDaBEamqq', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'default.png', NULL, 1, 0, NULL, 0, NULL, NULL, '2021-07-01 08:51:08', '2021-07-01 08:51:08', NULL),
(90, 1, 2, 'vinay selam', 'v selam', 'v selam', '$2y$10$7iaq2b/AfieGl4u/IPPUFOVAVJE8Z89mc5zp8Vijb8LR9l180wmDy', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'default.png', NULL, 1, 0, NULL, 0, NULL, NULL, '2021-07-01 08:51:38', '2021-07-01 08:51:48', NULL),
(91, 1, 2, 'shashi kyn', 'shashi', 'shashi', '$2y$10$FephdaBJn3Z9QNwWEFAJvOc8dib6umjAx4uMQpITATAB3sUf1NB2K', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'default.png', NULL, 1, 0, NULL, 0, NULL, NULL, '2021-07-01 08:52:51', '2021-07-01 08:53:01', NULL),
(92, 1, 2, 'shezad', 'shezad', 'shezad', '$2y$10$9Wvfu9BBrEihZHdCGEUPTO3BkS7MNJLAEf1D4e2E6kgtoMKwDbata', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'default.png', NULL, 1, 0, NULL, 0, NULL, NULL, '2021-07-01 08:53:24', '2021-07-01 08:53:35', NULL),
(93, 1, 2, 'shyam ac', 's ac', 's ac', '$2y$10$vVXUNLlZge0o.K.L.sINTOrpwYjVKKEqLIQJPvZnd0usFfiFs7V4q', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'default.png', NULL, 1, 0, NULL, 0, NULL, NULL, '2021-07-01 08:54:08', '2021-07-01 08:54:14', NULL),
(94, 1, 2, 'sm ent', 'sm', 'sm', '$2y$10$yF8WSE0Hv1U213LxEFcvOOZobexeGw0ugVhTrwLXEpxN6S60GNRJq', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'default.png', NULL, 1, 0, NULL, 0, NULL, NULL, '2021-07-01 08:54:35', '2021-07-01 12:10:38', NULL),
(95, 1, 2, 'sm deposit', 'sm d', 'sm d', '$2y$10$sBDmXr4h9KPHdbg1f0x3Gu09IYsl9F6QbtpzDtT.xPfG/4ZLDUAHm', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'default.png', NULL, 1, 0, NULL, 0, NULL, NULL, '2021-07-01 08:55:20', '2021-07-01 08:55:34', NULL),
(96, 1, 2, 'sm mld', 's mld', 's mld', '$2y$10$Zsg4M8zKxpnmgZkw/0mnpu6WKe6aiS9948hYD97VHl4tY6T6BxPUa', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'default.png', NULL, 1, 0, NULL, 0, NULL, NULL, '2021-07-01 08:56:07', '2021-07-01 08:56:15', NULL),
(97, 1, 2, 'sm nasik', 's nasik', 's nasik', '$2y$10$arNhee9uRtyCP26NXOj.y.O6dXaKadlmO1ywTvBytCaugM1xbOfde', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'default.png', NULL, 1, 0, NULL, 0, NULL, NULL, '2021-07-01 08:56:33', '2021-07-01 08:56:41', NULL),
(98, 1, 2, 'solapur', 'sol', 'sol', '$2y$10$iRpc6TE1KGyOclHJmPkQJ.M/NI1I.OsKny2uYfpC/NaUEUh9VUDz.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'default.png', NULL, 1, 0, NULL, 0, NULL, NULL, '2021-07-01 08:57:02', '2021-07-01 08:57:11', NULL),
(99, 1, 2, 'sufiyan 2', 's2', 's2', '$2y$10$A4MdjT9AZTyhqAfVE14sretIaClGHe/VG6jz7lr6qhNX0n8jzC/4C', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'default.png', NULL, 1, 0, NULL, 0, NULL, NULL, '2021-07-01 08:57:49', '2021-07-01 08:57:57', NULL),
(100, 1, 2, 'sufiyan kyn', 's kyn', 's kyn', '$2y$10$Y0NnG9vpstd010J/BK/MLuOfpRsFjFAQBsJbPZvvMF83a/EQlDNVO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'default.png', NULL, 1, 0, NULL, 0, NULL, NULL, '2021-07-01 08:58:21', '2021-07-01 09:46:20', NULL),
(101, 1, 2, 'rishi bhai surat', 'r surat', 's surat', '$2y$10$q3j1YP5gx4j7m9TQ47aMjOKEUIF.LSb/wQABPf8WduC54lxk.ZjiO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'default.png', NULL, 1, 0, NULL, 0, NULL, NULL, '2021-07-01 08:59:11', '2021-07-01 08:59:21', NULL),
(102, 1, 2, 'tpg', 'tpg', 'tpg', '$2y$10$K/DlMiswQyCb7X/EylRf8eKEnVwb/mryqQg27qfUaZhyisW6QiEum', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'default.png', NULL, 1, 0, NULL, 0, NULL, NULL, '2021-07-01 09:00:19', '2021-07-01 11:17:57', NULL),
(103, 1, 2, 'umer ndsn', 'umer', 'umer', '$2y$10$ULzyuh2sIpS.IwXMBLo4oeUqb86iP5jTXYpsK/YIxu0qQFZVmfz2q', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'default.png', NULL, 1, 0, NULL, 0, NULL, NULL, '2021-07-01 09:01:14', '2021-07-01 09:01:23', NULL),
(104, 1, 2, 'vicky ludhiyana', 'vicky', 'vicky', '$2y$10$thTzDZ0LyFfbG8k4Jy.3V.J9HPUvP6adMN6ur2w909eOQKkA9EhW6', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'default.png', NULL, 1, 0, NULL, 0, NULL, NULL, '2021-07-01 09:01:58', '2021-07-01 11:27:16', NULL),
(105, 1, 2, 'vishnu bhai', 'vs', 'vs', '$2y$10$EgyqPwyzPjdmUcykoCMizu8FEIIYY2GqA7Nh18JWPLJWDnF0wmhXC', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'default.png', NULL, 1, 0, NULL, 0, NULL, NULL, '2021-07-01 09:03:04', '2021-07-01 09:03:12', NULL),
(106, 1, 2, 'vinod bpng', 'v bpng', 'v bpng', '$2y$10$YQih9o/20d.cg0HZDg/6huuRU38XTjysaj6PIIkjYYr1gshJY4Ana', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'default.png', NULL, 1, 0, NULL, 0, NULL, NULL, '2021-07-01 09:03:35', '2021-07-01 11:10:31', NULL),
(107, 1, 2, 'ritu ac', 'ritu', 'ritu', '$2y$10$j1CUhUxzoaDbtAJJQsVlGuEFVRbHsh.JefrPylL4JfgTVlnQ.9ybG', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'default.png', NULL, 1, 0, NULL, 0, NULL, NULL, '2021-07-01 09:03:55', '2021-07-01 09:04:44', NULL),
(108, 1, 2, 'dbx sc', 'dbx', 'dbx', '$2y$10$k9LBgujhReXG4KKyM8bdE.vTpFFdmgLmkfFVemIQSDtWcYZf/2u02', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'default.png', NULL, 1, 0, NULL, 0, NULL, NULL, '2021-07-01 09:16:58', '2021-07-01 11:47:16', NULL),
(109, 1, 2, 'p vijay', 'p vijay', 'p vijay', '$2y$10$jre6jFK3yGCO30JjaVCdrOBMZyyz17.0fyDgW2vG9VeOV8aeUwa8i', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'default.png', NULL, 1, 0, NULL, 0, NULL, NULL, '2021-07-01 11:44:40', '2021-07-01 11:47:16', NULL),
(110, 1, 2, 'lab ac', 'lab', 'lab', '$2y$10$RBQhatjaYgaP2us.Zx7B4ui5dZn7DRn5OAVoDCauY8WGDqSGrCBRi', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'default.png', NULL, 1, 0, NULL, 0, NULL, NULL, '2021-07-01 12:08:06', '2021-07-01 12:13:58', NULL),
(111, 1, 2, 'amit mum', 'amit', 'amit', '$2y$10$Zvfaranhf605tsT.dmaFn.jLzsOXvOMNVk06h/wN2cRbGnbqAcroa', NULL, NULL, NULL, NULL, NULL, NULL, -1000.00, 'default.png', NULL, 1, 0, NULL, 0, NULL, NULL, '2021-07-01 12:24:15', '2021-08-06 08:18:38', NULL),
(112, 1, 2, 'RJKT', 'RJKT', 'RJKT', '1234567890', NULL, NULL, NULL, NULL, NULL, NULL, 2002.00, 'default.png', NULL, 1, 0, NULL, 0, NULL, NULL, '2021-08-09 06:29:09', '2021-08-09 07:08:09', NULL),
(113, 1, 2, 'SURAT', 'SURAT', 'SURAT', '1234567890', NULL, NULL, NULL, NULL, NULL, NULL, -1000.50, 'default.png', NULL, 1, 0, NULL, 0, NULL, NULL, '2021-08-09 06:30:55', '2021-08-09 06:32:10', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `balances`
--
ALTER TABLE `balances`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `expenses`
--
ALTER TABLE `expenses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `expense_types`
--
ALTER TABLE `expense_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `group_closing_balances`
--
ALTER TABLE `group_closing_balances`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `int_transactions`
--
ALTER TABLE `int_transactions`
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
  ADD PRIMARY KEY (`id`),
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `balances`
--
ALTER TABLE `balances`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `expenses`
--
ALTER TABLE `expenses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `expense_types`
--
ALTER TABLE `expense_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `group_closing_balances`
--
ALTER TABLE `group_closing_balances`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `int_transactions`
--
ALTER TABLE `int_transactions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `password_resets`
--
ALTER TABLE `password_resets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=114;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
