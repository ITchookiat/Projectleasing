-- phpMyAdmin SQL Dump
-- version 4.8.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 23, 2020 at 03:36 AM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 7.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `laravel_lawyer`
--

-- --------------------------------------------------------

--
-- Table structure for table `law_datas`
--

CREATE TABLE `law_datas` (
  `Law_id` bigint(20) UNSIGNED NOT NULL,
  `Contract_no` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Member_no` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Date_contract` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Date_firstdue` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Date_lastdue` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Finance_request` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Finance_approve` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Service_charge` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Total_amount` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Balance_amount` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Guarantor_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Status_notis` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Upload` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `law_datas`
--

INSERT INTO `law_datas` (`Law_id`, `Contract_no`, `Name`, `Member_no`, `Date_contract`, `Date_firstdue`, `Date_lastdue`, `Finance_request`, `Finance_approve`, `Service_charge`, `Total_amount`, `Balance_amount`, `Guarantor_name`, `Status_notis`, `Upload`, `created_at`, `updated_at`) VALUES
(1, 'ปน-สม-2536-000243', 'บริษัท ไอคิว (นายมูฮำมัดใฟซอล  สาแม)', '121-01-00669', '1993-07-15', '1993-08-15', '1993-08-15', NULL, '370000', '19902', '389902', '46421', NULL, NULL, '1', '2020-07-21 17:00:00', '2020-07-21 17:00:00'),
(2, 'ปน-สม-2536-000300', 'นายชาติชาย  สหสันติวรกุล', '121-01-00455', '1993-10-17', '1993-11-17', NULL, NULL, '50000', '31600', '81600', '19079', NULL, NULL, '1', '2020-07-21 17:00:00', '2020-07-21 17:00:00'),
(3, 'ปน-สม-2536-000335', 'บริษัท ไอคิว (นายมูฮำมัดใฟซอล  สาแม)', '121-01-00669', '1993-12-07', '1994-01-07', NULL, NULL, '200000', '151900', '351900', '192951', NULL, NULL, '1', '2020-07-21 17:00:00', '2020-07-21 17:00:00'),
(4, 'ปน-สม-2537-000367', 'นายมุตัรมีซี  มะ', '121-01-00162', '1994-01-18', '1994-02-18', NULL, NULL, '45000', '7800', '52800', '41264', NULL, NULL, '1', '2020-07-21 17:00:00', '2020-07-21 17:00:00'),
(5, 'ปน-สม-2537-000368', 'นายอิบรอฮิม  กูนิง', '121-01-00619', '1994-03-21', '1994-04-21', NULL, NULL, '30000', '13850', '43850', '29075', NULL, NULL, '1', '2020-07-21 17:00:00', '2020-07-21 17:00:00'),
(6, 'ปน-สม-2537-000436', 'นายมูฮำมัดใฟซอล  สาแม', '121-01-00669', '1994-06-27', '1994-07-27', NULL, NULL, '25000', '750', '25750', '11171', NULL, NULL, '1', '2020-07-21 17:00:00', '2020-07-21 17:00:00'),
(7, 'ปน-สม-2537-000471', 'นายมะนายิ  เจะมิง', '121-01-00000', '1994-08-17', '1994-09-17', NULL, NULL, '29000', '7888', '36888', '31888', NULL, NULL, '1', '2020-07-21 17:00:00', '2020-07-21 17:00:00'),
(8, 'ปน-สม-2538-000583', 'นายมะลีเป็ง  เจะยะ', '121-01-00000', '1995-02-22', '1995-03-22', NULL, NULL, '60000', '1800', '61800', '6800', NULL, NULL, '1', '2020-07-21 17:00:00', '2020-07-21 17:00:00'),
(9, 'ปน-สม-2538-000600', 'นายมะยูโซ๊ะ  ดอเลาะ (ปัตตานี ออโต้)', '121-01-00007', '1995-03-30', '1995-04-30', NULL, NULL, '224000', '26200', '250200', '75000', NULL, NULL, '1', '2020-07-21 17:00:00', '2020-07-21 17:00:00'),
(10, 'ปน-สม-2538-000639', 'นายมะตามีซี  มะ', '121-01-000162', '1995-06-08', '1995-07-08', NULL, NULL, '55000', '34100', '89100', '16100', NULL, NULL, '1', '2020-07-21 17:00:00', '2020-07-21 17:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2020_07_20_154446_create_users_table', 1),
(2, '2020_07_21_090407_create_law_datas_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `branch` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `password`, `password_token`, `email`, `type`, `branch`, `email_verified_at`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin', '$2y$10$tuLx4Ck1KfE0b/fDsDGOWOrhvPs9JfapZRooH9sMh7A2wAm1x4Mru', '123456', 'admin@gmail.com', 'Admin', '99', NULL, NULL, '2020-07-21 02:25:37', '2020-07-21 02:25:37');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `law_datas`
--
ALTER TABLE `law_datas`
  ADD PRIMARY KEY (`Law_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
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
-- AUTO_INCREMENT for table `law_datas`
--
ALTER TABLE `law_datas`
  MODIFY `Law_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
