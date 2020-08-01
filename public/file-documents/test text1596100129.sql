-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 18, 2018 at 07:49 PM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 7.2.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `laundry`
--

-- --------------------------------------------------------

--
-- Table structure for table `alert`
--

CREATE TABLE `alert` (
  `alert_id` int(11) NOT NULL,
  `note` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `amount` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `payer` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `receiver` int(11) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Dumping data for table `alert`
--

INSERT INTO `alert` (`alert_id`, `note`, `amount`, `user_id`, `payer`, `receiver`, `date`) VALUES
(18, 'หักเงินในบัญชี', 5171, 5, 'อามีน สอและ', 5, '2018-12-19 01:04:11'),
(19, 'เพิ่มเงินในบัญชี', 5111, 5, 'อามีน สอและ', 6, '2018-12-19 01:04:11'),
(20, 'เพิ่มเงินในบัญชี', 60, 5, 'อามีน สอและ', 2, '2018-12-19 01:04:11'),
(21, 'หักเงินในบัญชี', 512, 5, 'อามีน สอและ', 5, '2018-12-19 01:17:37'),
(22, 'เพิ่มเงินในบัญชี', 512, 5, 'อามีน สอและ', 6, '2018-12-19 01:17:37'),
(23, 'หักเงินในบัญชี', 512, 5, 'อามีน สอและ', 5, '2018-12-19 01:25:06'),
(24, 'เพิ่มเงินในบัญชี', 512, 5, 'อามีน สอและ', 6, '2018-12-19 01:25:06');

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `comment_id` int(11) NOT NULL,
  `customer_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `customer_lastname` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `shop_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `comment` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `level` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`comment_id`, `customer_name`, `customer_lastname`, `shop_name`, `comment`, `level`, `customer_id`, `date`) VALUES
(2, 'อามีน', 'สอและ', 'ผังเมือง 4 ร้าน ซัก อบรีด ซักแห้ง', 'ไม่อยากใช้บริการแล้ว', 2, 28, '2018-12-19 01:29:07');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `customer_id` int(11) NOT NULL,
  `customer_name` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `customer_lastname` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `tel` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `shop_id` int(11) NOT NULL,
  `shop_choose` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `type` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `price` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `lat` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `lng` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `status` int(1) NOT NULL,
  `user_id` int(11) NOT NULL,
  `taxi_id` int(11) NOT NULL,
  `fare_price` float NOT NULL,
  `pay_status` int(11) NOT NULL,
  `comment` varchar(500) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customer_id`, `customer_name`, `customer_lastname`, `tel`, `shop_id`, `shop_choose`, `type`, `price`, `lat`, `lng`, `status`, `user_id`, `taxi_id`, `fare_price`, `pay_status`, `comment`, `date`) VALUES
(28, 'อามีน', 'สอและ', '0697580234', 2, 'ผังเมือง 4 ร้าน ซัก อบรีด ซักแห้ง', 'ซักอบ', '60', '3.0738379', '101.5183469', 3, 5, 6, 5111, 1, 'ไม่อยากใช้บริการแล้ว', '2018-12-19 00:50:12'),
(29, 'อามีน', 'สอและ', '0697580234', 0, 'ผังเมือง 4 ร้าน ซัก อบรีด ซักแห้ง', '', '0', '3.0738379', '101.5183469', 1, 5, 0, 0, 0, '', '2018-12-19 00:51:37'),
(30, 'อามีน', 'สอและ', '0697580234', 0, 'บางกอกซักแห้ง', 'ซักแห้ง', '0', '3.0738379', '101.5183469', 1, 5, 0, 5111, 0, '', '2018-12-19 01:00:08');

-- --------------------------------------------------------

--
-- Table structure for table `log`
--

CREATE TABLE `log` (
  `log_id` int(11) NOT NULL,
  `user` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `log_event` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `ip_address` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Dumping data for table `log`
--

INSERT INTO `log` (`log_id`, `user`, `log_event`, `ip_address`, `date`) VALUES
(272, 'user01@gmail.com', 'logout from website...', '::1', '2018-06-20 06:43:28'),
(273, 'taxi01@gmail.com', 'logout from website...', '::1', '2018-06-20 06:43:32'),
(274, 'อามีน (Customer)', 'login to website...', '::1', '2018-06-20 17:14:12'),
(275, 'สมชาย (Taxi user)', 'login to website...', '::1', '2018-06-20 22:16:36'),
(276, 'taxi01@gmail.com', 'logout from website...', '::1', '2018-06-20 17:37:11'),
(277, 'วาสนา (Shop user)', 'login to website...', '::1', '2018-06-20 22:37:25'),
(278, 'shop01@gmail.com', 'logout from website...', '::1', '2018-06-20 17:37:30'),
(279, 'อาหมัด (Shop user)', 'login to website...', '::1', '2018-06-20 22:37:41'),
(280, 'shop02@gmail.com', 'logout from website...', '::1', '2018-06-20 17:37:45'),
(281, 'อามีนะ (Shop user)', 'login to website...', '::1', '2018-06-20 22:37:57'),
(282, 'user01@gmail.com', 'logout from website...', '::1', '2018-06-20 18:45:24'),
(283, ' (Customer)', 'login to website...', '::1', '2018-06-20 18:55:58'),
(285, 'user02@gmail.com (Customer)', 'login to website...', '::1', '2018-06-20 18:59:19'),
(286, 'shop03@gmail.com', 'logout from website...', '::1', '2018-06-20 19:22:02'),
(287, 'user02@gmail.com', 'logout from website...', '::1', '2018-06-20 19:31:38'),
(288, 'อามีน (Customer)', 'login to website...', '::1', '2018-06-20 19:31:51'),
(289, 'user01@gmail.com', 'logout from website...', '::1', '2018-06-20 19:33:42'),
(290, 'อามีน (Customer)', 'login to website...', '::1', '2018-06-21 05:58:14'),
(291, 'สมชาย (Taxi user)', 'login to website...', '::1', '2018-06-21 12:34:11'),
(292, 'อามีนจ่ายค่าแท็กซี่ $result บาท', 'login to website...', '::1', '2018-06-21 14:09:14'),
(293, 'อามีนจ่ายค่าแท็กซี่ $result บาท', 'login to website...', '::1', '2018-06-21 14:10:33'),
(294, 'อามีนจ่ายค่าแท็กซี่ $result บาท', 'login to website...', '::1', '2018-06-21 14:18:38'),
(295, 'อามีนจ่ายค่าแท็กซี่ $result บาท', 'login to website...', '::1', '2018-06-21 14:22:19'),
(296, 'user01@gmail.com', 'logout from website...', '::1', '2018-06-21 09:23:37'),
(297, 'taxi01@gmail.com', 'logout from website...', '::1', '2018-06-21 10:56:41'),
(298, 'TuanFarida (Admin)', 'login to website...', '::1', '2018-06-23 09:52:34'),
(299, 'TuanFarida (Admin)', 'Update profile ofTuanFarida', '::1', '2018-06-23 08:00:56'),
(300, 'TuanFarida (Admin)', 'Update profile ofTuanFarida', '::1', '2018-06-23 10:07:40'),
(301, 'TuanFarida (Admin)', 'Update profile ofTuanFarida', '::1', '2018-06-23 10:08:48'),
(302, 'TuanFarida (Admin)', 'Update profile ofTuanFarida', '::1', '2018-06-23 10:08:55'),
(304, 'tuan@gmail.com', 'logout from website...', '::1', '2018-06-23 10:35:19'),
(305, 'TuanFarida (Admin)', 'login to website...', '::1', '2018-07-17 11:14:34'),
(306, 'tuan@gmail.com', 'logout from website...', '::1', '2018-07-17 07:25:47'),
(307, 'TuanFarida (Admin)', 'login to website...', '::1', '2018-07-17 12:42:42'),
(308, 'TuanFarida (Admin)', 'login to website...', '::1', '2018-07-17 17:41:41'),
(309, 'อามีน (Customer)', 'login to website...', '::1', '2018-07-23 08:34:05'),
(310, 'อามีน (Customer)', 'login to website...', '::1', '2018-08-03 05:15:22'),
(311, 'user01@gmail.com', 'logout from website...', '::1', '2018-08-03 11:57:47'),
(312, 'วาสนา (Shop user)', 'login to website...', '::1', '2018-08-04 17:33:31'),
(313, 'shop01@gmail.com', 'logout from website...', '::1', '2018-08-04 12:57:05'),
(314, 'วาสนา (Shop user)', 'login to website...', '::1', '2018-08-04 17:57:52'),
(315, 'shop01@gmail.com', 'logout from website...', '::1', '2018-08-04 12:58:41'),
(316, 'TuanFarida (Admin)', 'login to website...', '::1', '2018-09-05 10:30:33'),
(317, 'tuan@gmail.com', 'logout from website...', '::1', '2018-09-05 08:10:52'),
(318, 'TuanFarida (Admin)', 'login to website...', '::1', '2018-09-06 13:13:16'),
(319, 'TuanFarida (Admin)', 'Update profile ofTuanFarida', '::1', '2018-09-06 08:14:20'),
(320, 'tuan@gmail.com', 'logout from website...', '::1', '2018-09-06 08:14:25'),
(321, 'TuanFarida (Admin)', 'login to website...', '::1', '2018-09-06 13:14:47'),
(322, 'Tuan (Admin)', 'Update profile ofTuan', '::1', '2018-09-06 08:16:20'),
(323, 'Tuan (Admin)', 'Update profile ofTuan', '::1', '2018-09-06 08:17:01'),
(324, 'Tuan (Admin)', 'Update profile ofTuan', '::1', '2018-09-06 08:17:39'),
(325, 'tuan@gmail.com', 'logout from website...', '::1', '2018-09-06 08:18:02'),
(326, 'Tuan (Admin)', 'login to website...', '::1', '2018-09-06 13:18:25'),
(327, 'tuan@gmail.com', 'logout from website...', '::1', '2018-09-06 08:20:03'),
(328, 'Tuan (Admin)', 'login to website...', '::1', '2018-09-06 13:20:48'),
(329, 'tuan@gmail.com', 'logout from website...', '::1', '2018-09-06 08:25:46'),
(330, 'Tuan (Admin)', 'login to website...', '192.168.43.1', '2018-09-06 16:54:30'),
(331, 'Tuan (Admin)', 'login to website...', '192.168.43.238', '2018-09-06 16:58:57'),
(332, 'Tuan (Admin)', 'login to website...', '::1', '2018-09-06 17:04:49'),
(333, 'tuan@gmail.com', 'logout from website...', '192.168.43.1', '2018-09-06 12:08:59'),
(334, 'Tuan (Admin)', 'login to website...', '192.168.43.1', '2018-09-06 17:09:35'),
(335, 'tuan@gmail.com', 'logout from website...', '192.168.43.1', '2018-09-06 12:15:54'),
(336, 'tuan@gmail.com', 'logout from website...', '::1', '2018-09-06 12:20:03'),
(337, 'tuan@gmail.com', 'logout from website...', '192.168.43.238', '2018-09-06 12:22:51'),
(338, 'อามีน (Customer)', 'login to website...', '::1', '2018-09-12 11:12:27'),
(339, 'user01@gmail.com', 'logout from website...', '::1', '2018-09-12 11:27:13'),
(340, 'Tuan (Admin)', 'login to website...', '::1', '2018-12-04 00:43:39'),
(341, 'tuan@gmail.com', 'logout from website...', '::1', '2018-12-03 18:49:14'),
(342, 'อามีน (Customer)', 'login to website...', '::1', '2018-12-03 18:49:25'),
(343, 'user01@gmail.com', 'logout from website...', '::1', '2018-12-03 18:55:56'),
(344, 'สมชาย (Taxi user)', 'login to website...', '::1', '2018-12-04 00:56:10'),
(345, 'taxi01@gmail.com', 'logout from website...', '::1', '2018-12-03 18:59:21'),
(346, 'อามีน (Customer)', 'login to website...', '::1', '2018-12-04 21:33:18'),
(347, 'อามีน (Customer)', 'login to website...', '::1', '2018-12-04 23:00:04'),
(348, 'user01@gmail.com', 'logout from website...', '::1', '2018-12-04 23:25:00'),
(349, 'อามีน (Customer)', 'login to website...', '::1', '2018-12-05 08:07:50'),
(350, 'user01@gmail.com', 'logout from website...', '::1', '2018-12-05 08:10:53'),
(351, 'อามีน (Customer)', 'login to website...', '::1', '2018-12-08 19:27:45'),
(352, 'user01@gmail.com', 'logout from website...', '::1', '2018-12-08 19:31:23'),
(353, 'สมชาย (Taxi user)', 'login to website...', '::1', '2018-12-09 01:31:39'),
(354, 'taxi01@gmail.com', 'logout from website...', '::1', '2018-12-08 19:40:15'),
(355, 'Tuan (Admin)', 'login to website...', '::1', '2018-12-09 13:46:39'),
(356, 'อามีน (Customer)', 'login to website...', '::1', '2018-12-18 18:46:03'),
(357, 'สมชาย (Taxi user)', 'login to website...', '::1', '2018-12-19 00:48:37'),
(358, 'วาสนา (Shop user)', 'login to website...', '::1', '2018-12-19 01:02:37'),
(359, 'อามีนจ่ายค่าแท็กซี่ $result บาท', 'login to website...', '::1', '2018-12-19 01:17:37'),
(360, 'อามีนจ่ายค่าแท็กซี่ $result บาท', 'login to website...', '::1', '2018-12-19 01:25:06'),
(361, 'shop01@gmail.com', 'logout from website...', '::1', '2018-12-18 19:31:08'),
(362, 'taxi01@gmail.com', 'logout from website...', '::1', '2018-12-18 19:43:02'),
(363, 'วาสนา (Shop user)', 'login to website...', '::1', '2018-12-19 01:43:15'),
(364, 'shop01@gmail.com', 'logout from website...', '::1', '2018-12-18 19:45:54'),
(365, 'user01@gmail.com', 'logout from website...', '::1', '2018-12-18 19:46:22');

-- --------------------------------------------------------

--
-- Table structure for table `order_info`
--

CREATE TABLE `order_info` (
  `order_id` int(11) NOT NULL,
  `taxi_id` int(11) NOT NULL,
  `taxi_name` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `taxi_lastname` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `taxi_tel` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `taxi_plate` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `taxi_brand` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `customer_id` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `customer_name` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `customer_lastname` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `customer_tel` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `shop_choose` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `type` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `quantity` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `price` int(11) NOT NULL,
  `lat` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `lng` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `status` int(11) NOT NULL,
  `shop_id` int(11) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Dumping data for table `order_info`
--

INSERT INTO `order_info` (`order_id`, `taxi_id`, `taxi_name`, `taxi_lastname`, `taxi_tel`, `taxi_plate`, `taxi_brand`, `customer_id`, `customer_name`, `customer_lastname`, `customer_tel`, `shop_choose`, `type`, `quantity`, `price`, `lat`, `lng`, `status`, `shop_id`, `date`) VALUES
(3, 6, 'สมชาย', 'หมายปอง', '0174582633', 'กย 15 ยะลา', 'โตโยต้า', '28', 'อามีน', 'สอและ', '0697580234', 'ผังเมือง 4 ร้าน ซัก อบรีด ซักแห้ง', 'ซักอบ', '0', 0, '3.0738379', '101.5183469', 1, 0, '2018-12-19 00:51:01'),
(4, 6, 'สมชาย', 'หมายปอง', '0174582633', 'กย 15 ยะลา', 'โตโยต้า', '28', 'อามีน', 'สอและ', '0697580234', 'ผังเมือง 4 ร้าน ซัก อบรีด ซักแห้ง', 'ซักอบ', '2', 60, '3.0738379', '101.5183469', 2, 2, '2018-12-19 01:00:49'),
(5, 6, 'สมชาย', 'หมายปอง', '0174582633', 'กย 15 ยะลา', 'โตโยต้า', '30', 'อามีน', 'สอและ', '0697580234', 'บางกอกซักแห้ง', 'ซักแห้ง', '0', 0, '3.0738379', '101.5183469', 1, 0, '2018-12-19 01:01:13');

-- --------------------------------------------------------

--
-- Table structure for table `order_report`
--

CREATE TABLE `order_report` (
  `report_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `customer_name` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `customer_lastname` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `customer_tel` varchar(10) COLLATE utf8_turkish_ci NOT NULL,
  `type` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `t_shirt` int(11) NOT NULL,
  `jacket` int(11) NOT NULL,
  `short_shirt` int(11) NOT NULL,
  `long_shirt` int(11) NOT NULL,
  `short_touser` int(11) NOT NULL,
  `long_touser` int(11) NOT NULL,
  `jean` int(11) NOT NULL,
  `evening_dress` int(11) NOT NULL,
  `short_skirt` int(11) NOT NULL,
  `long_skirt` int(11) NOT NULL,
  `suit` int(11) NOT NULL,
  `towel` int(11) NOT NULL,
  `blanket` int(11) NOT NULL,
  `quilt` int(11) NOT NULL,
  `bedsheet` int(11) NOT NULL,
  `curtain` int(11) NOT NULL,
  `total_quantity` int(11) NOT NULL,
  `total_price` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Dumping data for table `order_report`
--

INSERT INTO `order_report` (`report_id`, `customer_id`, `customer_name`, `customer_lastname`, `customer_tel`, `type`, `t_shirt`, `jacket`, `short_shirt`, `long_shirt`, `short_touser`, `long_touser`, `jean`, `evening_dress`, `short_skirt`, `long_skirt`, `suit`, `towel`, `blanket`, `quilt`, `bedsheet`, `curtain`, `total_quantity`, `total_price`, `user_id`, `order_id`, `date`) VALUES
(1, 28, 'อามีน', 'สอและ', '0697580234', 'ซักอบ', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 2, 60, 2, 4, '2018-12-18 19:12:28');

-- --------------------------------------------------------

--
-- Table structure for table `promotion`
--

CREATE TABLE `promotion` (
  `promotion_id` int(11) NOT NULL,
  `shop_name` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `promotion_name` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `promotion_detail` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Dumping data for table `promotion`
--

INSERT INTO `promotion` (`promotion_id`, `shop_name`, `promotion_name`, `promotion_detail`, `user_id`, `date`) VALUES
(1, 'ผังเมือง 4 ร้าน ซัก อบรีด ซักแห้ง', 'ฟรีผงซักฟอก', 'ขนาด 20 กรัม', 1, '2018-05-22 09:05:11'),
(2, 'ผังเมือง 4 ร้าน ซัก อบรีด ซักแห้ง', 'ฟรีผงซักฟอก', 'เมื่อซักผ้า 20 กิโลขึ้นไป', 2, '2018-06-18 14:05:18'),
(5, 'บางกอกซักแห้ง', 'ฟรีน้ำยา', 'เมื่อซักผ้า 25 กิโลขึ้นไป', 4, '2018-06-20 23:42:08'),
(6, 'บางกอกซักแห้ง', 'หอมแก้มหนึ่งที', 'เดะต่วนคนเดียวเท่านั้นที่ใช้ได้', 1, '2018-06-23 09:06:56');

-- --------------------------------------------------------

--
-- Table structure for table `service`
--

CREATE TABLE `service` (
  `service_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `customer_name` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `customer_lastname` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `customer_tel` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `customer_lat` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `customer_lng` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `shop_id` int(11) NOT NULL,
  `shop_name` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `shop_tel` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `shop_address` varchar(500) COLLATE utf8_turkish_ci NOT NULL,
  `shop_lat` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `shop_lng` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `type` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `price` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `status` int(1) NOT NULL,
  `pay_status` int(11) NOT NULL,
  `taxi_id` int(11) NOT NULL,
  `fare_price` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Dumping data for table `service`
--

INSERT INTO `service` (`service_id`, `user_id`, `customer_id`, `customer_name`, `customer_lastname`, `customer_tel`, `customer_lat`, `customer_lng`, `shop_id`, `shop_name`, `shop_tel`, `shop_address`, `shop_lat`, `shop_lng`, `type`, `price`, `status`, `pay_status`, `taxi_id`, `fare_price`, `date`) VALUES
(1, 5, 28, 'อามีน', 'สอและ', '0697580234', '3.0738379', '101.5183469', 1, 'ผังเมือง 4 ร้าน ซัก อบรีด ซักแห้ง', '0913162602', 'ถนน สุขยางค์ ตำบลสะเตง อำเภอเมืองยะลา ยะลา 95000 ประเทศไทย', '6.5470573', '101.2764617', 'ซักอบ', '60', 0, 1, 6, '512', '2018-12-19 01:06:48');

-- --------------------------------------------------------

--
-- Table structure for table `shop_info`
--

CREATE TABLE `shop_info` (
  `store_id` int(11) NOT NULL,
  `shop_name` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `firstname` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `lastname` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `id_card` varchar(13) COLLATE utf8_turkish_ci NOT NULL,
  `gender` int(11) NOT NULL,
  `address` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `tel` varchar(10) COLLATE utf8_turkish_ci NOT NULL,
  `service_detail` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `price_sab1` varchar(500) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `price_sab2` varchar(500) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `price_sab3` varchar(500) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `promotion` varchar(1000) CHARACTER SET utf32 COLLATE utf32_unicode_ci NOT NULL,
  `lat` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `lng` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `image_name` varchar(250) COLLATE utf8_turkish_ci DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Dumping data for table `shop_info`
--

INSERT INTO `shop_info` (`store_id`, `shop_name`, `firstname`, `lastname`, `id_card`, `gender`, `address`, `tel`, `service_detail`, `price_sab1`, `price_sab2`, `price_sab3`, `promotion`, `lat`, `lng`, `image_name`, `user_id`, `date`) VALUES
(1, 'ผังเมือง 4 ร้าน ซัก อบรีด ซักแห้ง', 'วาสนา', 'มีโชค', '1950411125123', 2, 'ถนน สุขยางค์ ตำบลสะเตง อำเภอเมืองยะลา ยะลา 95000 ประเทศไทย', '0913162602', 'เปิดให้บริการอยู่ : 07:00น - 20:30น.', '', '', '', 'บริการฟรีผงซักฟอง ปริมาณ 5 กรัม', '6.5470573', '101.2764617', '01.jpg', 2, '2018-02-18 00:40:39'),
(2, 'เอ๋ ซักอบรีด', 'อาหมัด', 'แสนดี', '1950412425128', 1, '49/1 ถนน ผังเมือง 5 ตำบล สะเตง อำเภอเมืองยะลา ยะลา 95000 ประเทศไทย', '0645824532', 'เปิดให้บริการอยู่ : 07:00น - 21:00น.', '', '', '', 'แพ็คเกจสมาชิก ซัก อบ รีด (อายุการใช้งาน 30 วัน) ทางร้านมีแพ็คเกจสำหรับสมาชิก 2 แบบ คือแบบนับชิ้น และ กำหนดวงเงิน แบบนับชิ้น คือ คิดราคาตามจำนวนผ้าที่นำมาซักสามารถใช้รวมกับผ้านวม ผ้าปูที่นอนได้ (ผ้าบางชนิดทางร้านอาจจะนับมากกว่า 1 ชิ้น เช่น ชุดเดรสจะนับเป็น 2 ชิ้น) สำหรับแพ็คเกจนี้ทางร้านมีเฉพาะบริการเป็น ซัก อบ พับ แบบกำหนดวงเงิน คือ คิดราคาตามแบบผ้าที่นำมาซัก แล้วหักค่าบริการตามจำนวนเงินที่มาใช้บริการ เช่น - ​​​​​​​เสื้อยืด ราคาซัก(เครื่อง) อบ รีด ราคา 22 บาท - เสื้อเชิ้ต ราคาซัก(เครื่อง) อบ รีด ราคา 25 บาท ซึ่งลูกค้าสามารถเลือกใช้บริการได้หลากหลายถึง 6 แบบ คือ - ซัก(เครื่อง) อบ รีด - ซัก(มือ) อบ รีด - รีดอย่างเดียว ​- ซัก อบ พับ - ซักผ้านวม ผ้าปูที่นอน - ซักแห้ง ​ลูกค้าแบบกำหนดวงเงินจะได้ใช้บริการเพิ่มมากขึ้นกว่าที่จ่ายจริง เช่น ลูกค้าสมัครสมาชิก 600 บาท จะใช้บริการได้ 690 บาท', '6.5470567', '101.2764617', '02.jpg', 3, '2018-02-18 00:49:36'),
(3, 'บางกอกซักแห้ง', 'อามีนะ', 'บุญดี', '3950412425188', 2, '21 ถนนรัฐกิจ อำเภอเมือง ยะลา 95000 ประเทศไทย', '073213955', 'เปิดให้บริการอยู่ : 07:00น - 20:30น.', '', '', '', '', '6.5470561', '101.2764617', '03.jpg', 4, '2018-02-18 00:55:21');

-- --------------------------------------------------------

--
-- Table structure for table `taxi_info`
--

CREATE TABLE `taxi_info` (
  `taxi_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `taxi_firstname` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `taxi_lastname` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `taxi_id_card` varchar(13) COLLATE utf8_turkish_ci NOT NULL,
  `taxi_address` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `taxi_tel` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `car_plate` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `car_brand` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `car_type` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `car_color` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `car_image` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `status` int(1) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Dumping data for table `taxi_info`
--

INSERT INTO `taxi_info` (`taxi_id`, `user_id`, `taxi_firstname`, `taxi_lastname`, `taxi_id_card`, `taxi_address`, `taxi_tel`, `car_plate`, `car_brand`, `car_type`, `car_color`, `car_image`, `status`, `date`) VALUES
(1, 6, 'สมชาย', 'หมายปอง', '2147483647', '21 ผังเมือง 4 ซอย 4 ตำบลสะเตง อำเภอเมืองยะลา 95000', '0174582633', 'กย 15 ยะลา', 'โตโยต้า', 'เก๋ง วีออส', 'ดำ', '15877showing.jpg', 1, '2018-02-18 00:59:18'),
(5, 1, 'tuanhakim', 'tohkubaha', '1234567891111', 'than to', '0801390953', 'asd12333', 'toyota', 'vigo', 'white', 'cool.jpg', 1, '2018-06-23 14:34:29');

-- --------------------------------------------------------

--
-- Table structure for table `to_do`
--

CREATE TABLE `to_do` (
  `to_do_id` int(11) NOT NULL,
  `list` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `user_id` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Dumping data for table `to_do`
--

INSERT INTO `to_do` (`to_do_id`, `list`, `user_id`, `date`) VALUES
(1, 'add tuan user', '1', '2018-02-08 06:05:00'),
(2, 'edit page', '1', '2018-05-22 08:05:22');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `firstname` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `lastname` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `id_card` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `gender` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `address` text COLLATE utf8_turkish_ci NOT NULL,
  `tel` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `username` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `password` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `user_image` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `type_status` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `firstname`, `lastname`, `id_card`, `gender`, `address`, `tel`, `username`, `password`, `user_image`, `type_status`, `date`) VALUES
(1, 'Tuan', 'Krab', '1234501265488', '2', 'yala sayang รักเดะต่วน', '0123455645', 'tuan@gmail.com', '123', 'avatar.png', 'admin', '2018-01-28 21:01:22'),
(2, 'วาสนา', 'มีโชค', '1950411125100', '2', 'ถนน สุขยางค์ ตำบลสะเตง อำเภอเมืองยะลา 95000', '0913162602', 'shop01@gmail.com', '123', 'avatar3.png', 'shop', '2018-02-18 00:20:00'),
(3, 'อาหมัด', 'แสนดี', '1950412425128', '1', '49/1 ถนน ผังเมือง 5 ตำบลสะเตง อำเภอเมืองยะลา 95000', '0645824536', 'shop02@gmail.com', '123', 'avatar4.png', 'shop', '2018-02-18 00:25:00'),
(4, 'อามีนะ', 'บุญดี', '3950412425188', '2', '21 ถนนรัฐกิจ อำเภอเมือง อำเภอเมืองยะลา 95000', '073213955', 'shop03@gmail.com', '123', 'avatar2.png', 'shop', '2018-02-18 00:30:00'),
(5, 'อามีน', 'สอและ', '1940414425144', '1', '21 บ้านบุดี ตำบลสะเตงนอก อำเภอเมืองยะลา 95000', '0697580234', 'user01@gmail.com', '123', 'avatar5.png', 'customer', '2018-02-19 00:30:00'),
(6, 'สมชาย', 'หมายปอง', '1950415425100', '1', '21 ผังเมือง 4 ซอย 4 ตำบลสะเตง อำเภอเมืองยะลา 95000', '0174582633', 'taxi01@gmail.com', '123', 'avatar04.png', 'taxi', '2018-12-19 01:42:04'),
(7, 'ต่วนฮากีม', 'มะซา', '1457896325487', '1', 'ธารโต ธารโต ยะลา 96000', '0801390953', 'user02@gmail.com', '123456789', 'DPP_0179_re.jpg', 'customer', '2018-06-20 23:58:08');

-- --------------------------------------------------------

--
-- Table structure for table `wallet`
--

CREATE TABLE `wallet` (
  `wallet_id` int(11) NOT NULL,
  `firstname` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `lastname` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `id_card` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `balance` int(50) NOT NULL,
  `user_id` int(11) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Dumping data for table `wallet`
--

INSERT INTO `wallet` (`wallet_id`, `firstname`, `lastname`, `id_card`, `balance`, `user_id`, `date`) VALUES
(1, 'อามีน', 'สอและ', '1940414425175', 90000, 5, '2018-02-18 08:59:16'),
(2, 'สมชาย', 'หมายปอง', '1950415425186', 41934, 6, '2018-02-18 10:13:17'),
(3, 'วาสนา', 'มีโชค', '1950411125123', 2060, 2, '2018-02-18 11:58:47'),
(4, 'อามีนะ', 'บุญดี', '3950412425188', 3460, 4, '2018-06-20 22:39:48'),
(5, 'ต่วนฮากีม', 'มะซา', '1457896325487', 10000, 7, '2018-06-21 00:28:40');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `alert`
--
ALTER TABLE `alert`
  ADD PRIMARY KEY (`alert_id`);

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`comment_id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customer_id`);

--
-- Indexes for table `log`
--
ALTER TABLE `log`
  ADD PRIMARY KEY (`log_id`);

--
-- Indexes for table `order_info`
--
ALTER TABLE `order_info`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `order_report`
--
ALTER TABLE `order_report`
  ADD PRIMARY KEY (`report_id`);

--
-- Indexes for table `promotion`
--
ALTER TABLE `promotion`
  ADD PRIMARY KEY (`promotion_id`);

--
-- Indexes for table `service`
--
ALTER TABLE `service`
  ADD PRIMARY KEY (`service_id`);

--
-- Indexes for table `shop_info`
--
ALTER TABLE `shop_info`
  ADD PRIMARY KEY (`store_id`);

--
-- Indexes for table `taxi_info`
--
ALTER TABLE `taxi_info`
  ADD PRIMARY KEY (`taxi_id`);

--
-- Indexes for table `to_do`
--
ALTER TABLE `to_do`
  ADD PRIMARY KEY (`to_do_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `wallet`
--
ALTER TABLE `wallet`
  ADD PRIMARY KEY (`wallet_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `alert`
--
ALTER TABLE `alert`
  MODIFY `alert_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `log`
--
ALTER TABLE `log`
  MODIFY `log_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=366;

--
-- AUTO_INCREMENT for table `order_info`
--
ALTER TABLE `order_info`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `order_report`
--
ALTER TABLE `order_report`
  MODIFY `report_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `promotion`
--
ALTER TABLE `promotion`
  MODIFY `promotion_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `service`
--
ALTER TABLE `service`
  MODIFY `service_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `shop_info`
--
ALTER TABLE `shop_info`
  MODIFY `store_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `taxi_info`
--
ALTER TABLE `taxi_info`
  MODIFY `taxi_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `to_do`
--
ALTER TABLE `to_do`
  MODIFY `to_do_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `wallet`
--
ALTER TABLE `wallet`
  MODIFY `wallet_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
