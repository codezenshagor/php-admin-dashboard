-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 04, 2025 at 04:08 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `demo_site`
--

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `id` int(11) NOT NULL,
  `employee_id` int(11) DEFAULT NULL,
  `shift_id` varchar(255) DEFAULT NULL,
  `attendance_date` date DEFAULT NULL,
  `in_time` varchar(250) DEFAULT '-',
  `out_time` varchar(250) DEFAULT '-',
  `duration_hours` decimal(5,2) DEFAULT NULL,
  `device_serial` varchar(100) DEFAULT NULL,
  `type` varchar(250) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `in_email` int(5) NOT NULL DEFAULT 0,
  `out_email` int(5) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`id`, `employee_id`, `shift_id`, `attendance_date`, `in_time`, `out_time`, `duration_hours`, `device_serial`, `type`, `created_at`, `in_email`, `out_email`) VALUES
(51, 1, '6', '2025-07-25', '2025-07-25 05:50:27', '2025-07-25 06:00:12', '0.16', 'JJA1242900053', 'present', '2025-07-27 08:48:02', 1, 1),
(52, 1, '6', '2025-07-26', '2025-07-26 06:57:57', '-', '0.00', 'JJA1242900053', 'present', '2025-07-27 08:48:02', 1, 1),
(53, 1, '6', '2025-07-27', '2025-07-27 05:26:23', '0000-00-00 00:00:00', '0.00', 'JJA1242900053', 'present', '2025-07-27 08:48:02', 1, 0),
(54, 9, '4', '2025-07-25', '2025-07-26 04:04:22', '-', '0.00', 'JJA1242900053', 'present', '2025-07-27 19:37:05', 0, 0),
(55, 12, '4', '2025-07-25', '2025-07-26 04:05:11', '-', '0.00', 'JJA1242900053', 'present', '2025-07-27 19:37:05', 0, 0),
(56, 13, '4', '2025-07-25', '2025-07-25 13:26:04', '2025-07-26 04:07:41', '14.69', 'JJA1242900053', 'present', '2025-07-27 19:37:05', 0, 0),
(57, 7, '7', '2025-07-26', '2025-07-26 12:12:38', '-', '0.00', 'JJA1242900053', 'present', '2025-07-27 19:37:05', 1, 0),
(58, 9, '4', '2025-07-26', '2025-07-26 14:41:09', '2025-07-27 04:16:09', '13.58', 'JJA1242900053', 'present', '2025-07-27 19:37:05', 0, 0),
(59, 10, '6', '2025-07-26', '2025-07-26 12:26:02', '-', '0.00', 'JJA1242900053', 'present', '2025-07-27 19:37:05', 0, 0),
(60, 12, '4', '2025-07-26', '2025-07-26 17:44:02', '2025-07-27 04:04:01', '10.33', 'JJA1242900053', 'present', '2025-07-27 19:37:05', 0, 0),
(61, 13, '4', '2025-07-26', '2025-07-26 14:29:13', '2025-07-27 04:13:06', '13.73', 'JJA1242900053', 'present', '2025-07-27 19:37:05', 0, 0),
(62, 7, '7', '2025-07-27', '2025-07-27 11:00:20', '2025-07-27 13:00:20', '1.40', 'JJA1242900053', 'present', '2025-07-27 19:37:05', 1, 1),
(63, 9, '4', '2025-07-27', '2025-07-27 14:29:55', '-', '0.00', 'JJA1242900053', 'present', '2025-07-27 19:37:05', 0, 0),
(64, 10, '6', '2025-07-27', '2025-07-27 10:27:49', '-', '0.00', 'JJA1242900053', 'present', '2025-07-27 19:37:05', 0, 0),
(65, 13, '4', '2025-07-27', '2025-07-27 14:32:52', '-', '0.00', 'JJA1242900053', 'present', '2025-07-27 19:37:05', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `attendance_log_status`
--

CREATE TABLE `attendance_log_status` (
  `id` int(11) NOT NULL,
  `last_attlog_id` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `attendance_log_status`
--

INSERT INTO `attendance_log_status` (`id`, `last_attlog_id`) VALUES
(1, 120);

-- --------------------------------------------------------

--
-- Table structure for table `attlog`
--

CREATE TABLE `attlog` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `datetime` datetime NOT NULL,
  `verify_type` int(11) DEFAULT 0,
  `state` varchar(20) DEFAULT '0',
  `col5` varchar(250) DEFAULT '0',
  `col6` varchar(250) DEFAULT '0',
  `col7` varchar(250) DEFAULT '0',
  `col8` varchar(250) DEFAULT '0',
  `col9` varchar(250) DEFAULT '0',
  `col10` varchar(250) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `attlog`
--

INSERT INTO `attlog` (`id`, `user_id`, `datetime`, `verify_type`, `state`, `col5`, `col6`, `col7`, `col8`, `col9`, `col10`) VALUES
(16, 10007, '2025-07-17 00:11:57', 0, '1', '0', '0', '0', '0', '0', 'JJA1242900053'),
(17, 100024, '2025-07-18 16:24:51', 0, '1', '0', '0', '0', '0', '0', 'JJA1242900053'),
(18, 10003, '2025-07-18 16:33:34', 0, '1', '0', '0', '0', '0', '0', 'JJA1242900053'),
(19, 1, '2025-07-18 20:21:44', 1, '1', '0', '0', '0', '0', '0', 'JJA1242900053'),
(20, 100020, '2025-07-18 21:10:56', 1, '1', '0', '0', '0', '0', '0', 'JJA1242900053'),
(21, 100024, '2025-07-18 22:31:21', 0, '1', '0', '0', '0', '0', '0', 'JJA1242900053'),
(22, 100024, '2025-07-18 22:31:52', 1, '1', '0', '0', '0', '0', '0', 'JJA1242900053'),
(23, 10006, '2025-07-19 00:32:35', 1, '1', '0', '0', '0', '0', '0', 'JJA1242900053'),
(24, 10007, '2025-07-19 04:08:32', 1, '1', '0', '0', '0', '0', '0', 'JJA1242900053'),
(25, 100024, '2025-07-19 05:00:08', 0, '1', '0', '0', '0', '0', '0', 'JJA1242900053'),
(26, 10003, '2025-07-19 05:00:20', 1, '1', '0', '0', '0', '0', '0', 'JJA1242900053'),
(27, 1, '2025-07-19 05:01:50', 0, '1', '0', '0', '0', '0', '0', 'JJA1242900053'),
(28, 10006, '2025-07-19 10:33:45', 0, '1', '0', '0', '0', '0', '0', 'JJA1242900053'),
(29, 100024, '2025-07-19 10:42:01', 0, '1', '0', '0', '0', '0', '0', 'JJA1242900053'),
(30, 10004, '2025-07-19 13:51:48', 0, '1', '0', '0', '0', '0', '0', 'JJA1242900053'),
(31, 10008, '2025-07-19 14:33:32', 0, '1', '0', '0', '0', '0', '0', 'JJA1242900053'),
(32, 10003, '2025-07-19 17:27:25', 0, '1', '0', '0', '0', '0', '0', 'JJA1242900053'),
(33, 10007, '2025-07-19 17:27:37', 0, '1', '0', '0', '0', '0', '0', 'JJA1242900053'),
(34, 100024, '2025-07-19 18:58:49', 1, '1', '0', '0', '0', '0', '0', 'JJA1242900053'),
(35, 1, '2025-07-19 22:39:08', 1, '1', '0', '0', '0', '0', '0', 'JJA1242900053'),
(36, 10010, '2025-07-19 23:46:21', 1, '1', '0', '0', '0', '0', '0', 'JJA1242900053'),
(37, 10010, '2025-07-19 23:46:36', 1, '1', '0', '0', '0', '0', '0', 'JJA1242900053'),
(38, 10006, '2025-07-20 00:12:25', 1, '1', '0', '0', '0', '0', '0', 'JJA1242900053'),
(39, 10007, '2025-07-20 04:04:18', 1, '1', '0', '0', '0', '0', '0', 'JJA1242900053'),
(40, 10008, '2025-07-20 04:06:42', 1, '1', '0', '0', '0', '0', '0', 'JJA1242900053'),
(41, 10004, '2025-07-20 04:06:47', 1, '1', '0', '0', '0', '0', '0', 'JJA1242900053'),
(42, 100024, '2025-07-20 05:16:27', 0, '1', '0', '0', '0', '0', '0', 'JJA1242900053'),
(43, 10003, '2025-07-20 05:53:46', 1, '1', '0', '0', '0', '0', '0', 'JJA1242900053'),
(44, 10006, '2025-07-20 10:24:31', 0, '1', '0', '0', '0', '0', '0', 'JJA1242900053'),
(45, 10007, '2025-07-20 14:54:49', 0, '1', '0', '0', '0', '0', '0', 'JJA1242900053'),
(46, 100024, '2025-07-20 18:48:46', 1, '1', '0', '0', '0', '0', '0', 'JJA1242900053'),
(47, 1, '2025-07-20 19:05:32', 1, '1', '0', '0', '0', '0', '0', 'JJA1242900053'),
(48, 10006, '2025-07-21 00:47:59', 1, '1', '0', '0', '0', '0', '0', 'JJA1242900053'),
(49, 10004, '2025-07-21 04:03:42', 1, '1', '0', '0', '0', '0', '0', 'JJA1242900053'),
(50, 10007, '2025-07-21 04:13:30', 1, '1', '0', '0', '0', '0', '0', 'JJA1242900053'),
(51, 10008, '2025-07-21 04:15:03', 1, '1', '0', '0', '0', '0', '0', 'JJA1242900053'),
(52, 100024, '2025-07-21 05:12:14', 0, '1', '0', '0', '0', '0', '0', 'JJA1242900053'),
(53, 1, '2025-07-21 05:23:39', 0, '1', '0', '0', '0', '0', '0', 'JJA1242900053'),
(54, 10004, '2025-07-21 14:06:53', 1, '1', '0', '0', '0', '0', '0', 'JJA1242900053'),
(55, 10008, '2025-07-21 14:58:38', 0, '1', '0', '0', '0', '0', '0', 'JJA1242900053'),
(56, 10007, '2025-07-21 15:29:06', 0, '1', '0', '0', '0', '0', '0', 'JJA1242900053'),
(57, 10006, '2025-07-21 16:34:56', 0, '1', '0', '0', '0', '0', '0', 'JJA1242900053'),
(58, 100024, '2025-07-21 18:58:29', 1, '1', '0', '0', '0', '0', '0', 'JJA1242900053'),
(59, 10006, '2025-07-22 00:05:02', 1, '1', '0', '0', '0', '0', '0', 'JJA1242900053'),
(60, 10004, '2025-07-22 04:05:11', 1, '1', '0', '0', '0', '0', '0', 'JJA1242900053'),
(61, 10007, '2025-07-22 04:05:23', 1, '1', '0', '0', '0', '0', '0', 'JJA1242900053'),
(62, 10008, '2025-07-22 04:06:06', 1, '1', '0', '0', '0', '0', '0', 'JJA1242900053'),
(63, 100024, '2025-07-22 04:59:32', 0, '1', '0', '0', '0', '0', '0', 'JJA1242900053'),
(64, 1, '2025-07-22 06:43:43', 0, '1', '0', '0', '0', '0', '0', 'JJA1242900053'),
(65, 10004, '2025-07-22 15:03:21', 0, '1', '0', '0', '0', '0', '0', 'JJA1242900053'),
(66, 10007, '2025-07-22 15:12:13', 0, '1', '0', '0', '0', '0', '0', 'JJA1242900053'),
(67, 10006, '2025-07-22 16:46:18', 0, '1', '0', '0', '0', '0', '0', 'JJA1242900053'),
(68, 100024, '2025-07-22 18:50:41', 1, '1', '0', '0', '0', '0', '0', 'JJA1242900053'),
(69, 1, '2025-07-22 22:18:25', 1, '1', '0', '0', '0', '0', '0', 'JJA1242900053'),
(70, 10006, '2025-07-23 00:07:45', 1, '1', '0', '0', '0', '0', '0', 'JJA1242900053'),
(71, 100024, '2025-07-23 05:52:44', 0, '1', '0', '0', '0', '0', '0', 'JJA1242900053'),
(72, 10006, '2025-07-23 10:41:36', 0, '1', '0', '0', '0', '0', '0', 'JJA1242900053'),
(73, 10008, '2025-07-23 14:25:10', 0, '1', '0', '0', '0', '0', '0', 'JJA1242900053'),
(74, 10004, '2025-07-23 14:36:33', 0, '1', '0', '0', '0', '0', '0', 'JJA1242900053'),
(75, 10007, '2025-07-23 14:47:44', 0, '1', '0', '0', '0', '0', '0', 'JJA1242900053'),
(76, 100024, '2025-07-23 18:49:29', 1, '1', '0', '0', '0', '0', '0', 'JJA1242900053'),
(77, 10006, '2025-07-24 00:21:58', 1, '1', '0', '0', '0', '0', '0', 'JJA1242900053'),
(78, 10004, '2025-07-24 04:06:23', 1, '1', '0', '0', '0', '0', '0', 'JJA1242900053'),
(79, 10008, '2025-07-24 05:02:02', 1, '1', '0', '0', '0', '0', '0', 'JJA1242900053'),
(80, 100024, '2025-07-24 05:02:16', 0, '1', '0', '0', '0', '0', '0', 'JJA1242900053'),
(81, 1, '2025-07-24 05:06:29', 0, '1', '0', '0', '0', '0', '0', 'JJA1242900053'),
(82, 10006, '2025-07-24 10:32:05', 0, '1', '0', '0', '0', '0', '0', 'JJA1242900053'),
(83, 10008, '2025-07-24 14:36:39', 0, '1', '0', '0', '0', '0', '0', 'JJA1242900053'),
(84, 10007, '2025-07-24 14:48:01', 0, '1', '0', '0', '0', '0', '0', 'JJA1242900053'),
(85, 10004, '2025-07-24 15:00:07', 0, '1', '0', '0', '0', '0', '0', 'JJA1242900053'),
(86, 2, '2025-07-24 16:15:50', 0, '1', '0', '0', '0', '0', '0', 'JJA1242900053'),
(87, 100024, '2025-07-24 18:48:33', 1, '1', '0', '0', '0', '0', '0', 'JJA1242900053'),
(88, 10006, '2025-07-25 00:24:46', 1, '1', '0', '0', '0', '0', '0', 'JJA1242900053'),
(89, 10007, '2025-07-25 04:01:24', 1, '1', '0', '0', '0', '0', '0', 'JJA1242900053'),
(90, 10004, '2025-07-25 04:03:07', 1, '1', '0', '0', '0', '0', '0', 'JJA1242900053'),
(91, 10008, '2025-07-25 04:11:26', 1, '1', '0', '0', '0', '0', '0', 'JJA1242900053'),
(92, 100024, '2025-07-25 05:06:04', 0, '1', '0', '0', '0', '0', '0', 'JJA1242900053'),
(93, 1, '2025-07-25 05:50:27', 0, '1', '0', '0', '0', '0', '0', 'JJA1242900053'),
(94, 10006, '2025-07-17 00:46:01', 1, '1', '0', '0', '0', '0', '0', 'JJA1242900053'),
(95, 10007, '2025-07-17 04:59:00', 1, '1', '0', '0', '0', '0', '0', 'JJA1242900053'),
(96, 10004, '2025-07-17 05:03:11', 1, '1', '0', '0', '0', '0', '0', 'JJA1242900053'),
(97, 1, '2025-07-17 05:03:56', 0, '1', '0', '0', '0', '0', '0', 'JJA1242900053'),
(98, 10003, '2025-07-17 05:05:45', 0, '1', '0', '0', '0', '0', '0', 'JJA1242900053'),
(99, 10003, '2025-07-17 05:05:58', 1, '1', '0', '0', '0', '0', '0', 'JJA1242900053'),
(100, 10004, '2025-07-17 05:34:51', 0, '1', '0', '0', '0', '0', '0', 'JJA1242900053'),
(101, 10008, '2025-07-17 06:03:21', 1, '1', '0', '0', '0', '0', '0', 'JJA1242900053'),
(102, 10006, '2025-07-17 10:38:03', 0, '1', '0', '0', '0', '0', '0', 'JJA1242900053'),
(103, 10008, '2025-07-17 14:24:47', 0, '1', '0', '0', '0', '0', '0', 'JJA1242900053'),
(104, 100024, '2025-07-17 15:01:04', 0, '1', '0', '0', '0', '0', '0', 'JJA1242900053'),
(105, 10003, '2025-07-17 15:16:01', 0, '1', '0', '0', '0', '0', '0', 'JJA1242900053'),
(106, 10007, '2025-07-17 18:02:18', 0, '1', '0', '0', '0', '0', '0', 'JJA1242900053'),
(107, 10004, '2025-07-17 19:08:24', 1, '1', '0', '0', '0', '0', '0', 'JJA1242900053'),
(108, 10006, '2025-07-18 00:30:41', 1, '1', '0', '0', '0', '0', '0', 'JJA1242900053'),
(109, 100024, '2025-07-18 03:53:20', 1, '1', '0', '0', '0', '0', '0', 'JJA1242900053'),
(110, 10008, '2025-07-18 03:58:30', 1, '1', '0', '0', '0', '0', '0', 'JJA1242900053'),
(111, 10003, '2025-07-18 03:58:47', 1, '1', '0', '0', '0', '0', '0', 'JJA1242900053'),
(112, 10007, '2025-07-18 03:58:51', 1, '1', '0', '0', '0', '0', '0', 'JJA1242900053'),
(113, 10004, '2025-07-18 05:22:35', 0, '1', '0', '0', '0', '0', '0', 'JJA1242900053'),
(114, 1, '2025-07-18 05:58:22', 0, '1', '0', '0', '0', '0', '0', 'JJA1242900053'),
(115, 10006, '2025-07-18 10:39:28', 0, '1', '0', '0', '0', '0', '0', 'JJA1242900053'),
(116, 10007, '2025-07-18 13:08:08', 0, '1', '0', '0', '0', '0', '0', 'JJA1242900053'),
(117, 1, '2025-07-25 06:00:12', 0, '1', '0', '0', '0', '0', '0', 'JJA1242900053'),
(118, 1, '2025-07-25 06:02:27', 0, '1', '0', '0', '0', '0', '0', 'JJA1242900053'),
(119, 0, '0000-00-00 00:00:00', 0, 'Passwd=666', 'Card=', 'Grp=1', 'TZ=0000000100000000', 'Verify=-1', 'ViceCard=', 'JJA1242900053'),
(120, 666, '2025-07-25 06:16:17', 0, '3', '0', '0', '0', '0', '0', 'JJA1242900053'),
(121, 10008, '2025-07-25 13:26:04', 0, '1', '0', '0', '0', '0', '0', 'JJA1242900053'),
(122, 100024, '2025-07-25 19:22:13', 0, '1', '0', '0', '0', '0', '0', 'JJA1242900053'),
(123, 100024, '2025-07-25 19:22:42', 1, '1', '0', '0', '0', '0', '0', 'JJA1242900053'),
(124, 10004, '2025-07-26 04:04:22', 1, '1', '0', '0', '0', '0', '0', 'JJA1242900053'),
(125, 10007, '2025-07-26 04:05:11', 1, '1', '0', '0', '0', '0', '0', 'JJA1242900053'),
(126, 10008, '2025-07-26 04:07:41', 1, '1', '0', '0', '0', '0', '0', 'JJA1242900053'),
(127, 100024, '2025-07-26 06:32:22', 0, '1', '0', '0', '0', '0', '0', 'JJA1242900053'),
(128, 1, '2025-07-26 06:57:57', 0, '1', '0', '0', '0', '0', '0', 'JJA1242900053'),
(129, 2, '2025-07-26 12:12:38', 0, '1', '0', '0', '0', '0', '0', 'JJA1242900053'),
(130, 10006, '2025-07-26 12:26:02', 0, '1', '0', '0', '0', '0', '0', 'JJA1242900053'),
(131, 10008, '2025-07-26 14:29:13', 5, '1', '0', '0', '0', '0', '0', 'JJA1242900053'),
(132, 10004, '2025-07-26 14:41:09', 4, '1', '0', '0', '0', '0', '0', 'JJA1242900053'),
(133, 10007, '2025-07-26 17:44:02', 4, '1', '0', '0', '0', '0', '0', 'JJA1242900053'),
(134, 100024, '2025-07-26 18:43:39', 1, '1', '0', '0', '0', '0', '0', 'JJA1242900053'),
(135, 10006, '2025-07-27 00:11:49', 1, '1', '0', '0', '0', '0', '0', 'JJA1242900053'),
(136, 10007, '2025-07-27 04:04:01', 1, '1', '0', '0', '0', '0', '0', 'JJA1242900053'),
(137, 10008, '2025-07-27 04:13:06', 1, '1', '0', '0', '0', '0', '0', 'JJA1242900053'),
(138, 10004, '2025-07-27 04:16:09', 1, '1', '0', '0', '0', '0', '0', 'JJA1242900053'),
(139, 1, '2025-07-27 05:26:23', 0, '1', '0', '0', '0', '0', '0', 'JJA1242900053'),
(140, 100024, '2025-07-27 05:28:14', 0, '1', '0', '0', '0', '0', '0', 'JJA1242900053'),
(141, 0, '0000-00-00 00:00:00', 0, 'Passwd=', 'Card=', 'Grp=1', 'TZ=0000000100000000', 'Verify=-1', 'ViceCard=', 'JJA1242900053'),
(142, 0, '0000-00-00 00:00:00', 0, 'Passwd=10027', 'Card=', 'Grp=1', 'TZ=0000000100000000', 'Verify=-1', 'ViceCard=', 'JJA1242900053'),
(143, 1, '2025-07-27 10:20:34', 0, '1', '0', '0', '0', '0', '0', 'JJA1242900053'),
(144, 1, '2025-07-27 10:21:04', 1, '1', '0', '0', '0', '0', '0', 'JJA1242900053'),
(145, 10006, '2025-07-27 10:27:49', 0, '1', '0', '0', '0', '0', '0', 'JJA1242900053'),
(146, 2, '2025-07-27 11:00:20', 0, '1', '0', '0', '0', '0', '0', 'JJA1242900053'),
(147, 10004, '2025-07-27 14:29:55', 0, '1', '0', '0', '0', '0', '0', 'JJA1242900053'),
(148, 10008, '2025-07-27 14:32:52', 0, '1', '0', '0', '0', '0', '0', 'JJA1242900053');

-- --------------------------------------------------------

--
-- Table structure for table `documents`
--

CREATE TABLE `documents` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `document_name` varchar(255) DEFAULT NULL,
  `document_path` varchar(255) DEFAULT NULL,
  `upload_date` date NOT NULL,
  `status` enum('pending','approved','rejected') DEFAULT 'pending',
  `reject_reason` text DEFAULT NULL,
  `admin_id` int(11) DEFAULT NULL,
  `approved_at` datetime DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(150) NOT NULL,
  `user_id` varchar(50) NOT NULL,
  `group_id` int(10) UNSIGNED NOT NULL,
  `zkteco_user_id` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `mobile` varchar(20) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `location_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `name`, `user_id`, `group_id`, `zkteco_user_id`, `email`, `mobile`, `image`, `created_at`, `updated_at`, `location_id`) VALUES
(1, 'Ahsanul Hoque', '1', 4, '1', 'aahsanuh62@gmail.com', '9660553687388', 'uploads/6885303512780_219988.png', '2025-07-24 18:32:02', '2025-07-27 05:02:08', 3),
(7, 'Md Shagor Ali', '2', 4, '2', 'mdshagor110824@gmail.com', '01712036295', NULL, '2025-07-27 06:33:45', '2025-07-28 12:35:21', 3),
(8, 'Norossovie', '10003', 4, '10003', '', '', NULL, '2025-07-27 06:34:32', NULL, 3),
(9, 'Ahesan Ahmed', '10004', 4, '10004', '', '', NULL, '2025-07-27 06:35:29', NULL, 3),
(10, 'Saiful Islam', '10006', 4, '10006', '', '', NULL, '2025-07-27 06:36:09', NULL, 3),
(11, 'Mohmadul Hoq', '10025', 4, '10025', '', '', NULL, '2025-07-27 06:39:06', NULL, 3),
(12, 'Raihan', '10007', 4, '10007', '', '', NULL, '2025-07-27 06:40:07', NULL, 3),
(13, 'Sajib', '10008', 4, '10008', '', '', NULL, '2025-07-27 06:40:34', NULL, 3),
(14, 'MD Hasan', '10010', 4, '10010', '', '', NULL, '2025-07-27 06:41:07', NULL, 3),
(15, 'MD Rakib', '10024', 4, '10024', '', '', NULL, '2025-07-27 06:43:30', NULL, 3),
(16, 'Nur Siddik', '10027', 4, '10027', '', '', NULL, '2025-07-27 06:46:11', NULL, 3);

-- --------------------------------------------------------

--
-- Table structure for table `employee_shifts`
--

CREATE TABLE `employee_shifts` (
  `id` int(10) UNSIGNED NOT NULL,
  `employee_id` int(10) UNSIGNED NOT NULL,
  `shift_id` int(10) UNSIGNED NOT NULL,
  `assigned_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `expense_entries`
--

CREATE TABLE `expense_entries` (
  `id` int(11) NOT NULL,
  `shop_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `entry_date` date NOT NULL,
  `expense_amount` decimal(10,2) NOT NULL,
  `expense_description` text DEFAULT NULL,
  `status` enum('pending','approved','rejected') DEFAULT 'pending',
  `reject_reason` text DEFAULT NULL,
  `admin_id` int(11) DEFAULT NULL,
  `approved_at` datetime DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `name`, `description`, `created_at`, `updated_at`) VALUES
(4, 'Azzouz', 'Azzouz Walyal Ahd', '2025-07-24 21:20:33', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `locations`
--

CREATE TABLE `locations` (
  `id` int(11) NOT NULL,
  `office_name` varchar(255) DEFAULT NULL,
  `branch_name` varchar(255) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `device_serials` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `locations`
--

INSERT INTO `locations` (`id`, `office_name`, `branch_name`, `address`, `device_serials`) VALUES
(3, 'Azzouz Markets&Bakery', 'Azzouz Markets&Bakery', 'Walyal Ahd', 'JJA1242900053');

-- --------------------------------------------------------

--
-- Table structure for table `overtime`
--

CREATE TABLE `overtime` (
  `id` int(10) UNSIGNED NOT NULL,
  `employee_id` int(10) UNSIGNED NOT NULL,
  `shift_id` int(10) UNSIGNED NOT NULL,
  `overtime_hours` decimal(5,2) NOT NULL DEFAULT 0.00,
  `overtime_date` date NOT NULL,
  `rate_per_hour` decimal(10,2) NOT NULL DEFAULT 0.00,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `salaries`
--

CREATE TABLE `salaries` (
  `id` int(10) UNSIGNED NOT NULL,
  `employee_id` int(10) UNSIGNED NOT NULL,
  `basic_salary` decimal(10,2) NOT NULL DEFAULT 0.00,
  `allowance` decimal(10,2) NOT NULL DEFAULT 0.00,
  `deduction` decimal(10,2) NOT NULL DEFAULT 0.00,
  `pay_date` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sell_entries`
--

CREATE TABLE `sell_entries` (
  `id` int(11) NOT NULL,
  `shop_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `entry_date` date NOT NULL,
  `total_amount` decimal(10,2) NOT NULL,
  `status` enum('pending','approved','rejected') DEFAULT 'pending',
  `reject_reason` text DEFAULT NULL,
  `admin_id` int(11) DEFAULT NULL,
  `approved_at` datetime DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `shifts`
--

CREATE TABLE `shifts` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `start_time` varchar(150) NOT NULL,
  `end_time` varchar(150) NOT NULL,
  `overtime_start` varchar(150) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `shifts`
--

INSERT INTO `shifts` (`id`, `name`, `start_time`, `end_time`, `overtime_start`, `description`, `created_at`, `updated_at`) VALUES
(4, '2:00Pm - 4:00 Am', '14:00', '05:30', '04:30', 'Dupur 2ta theke sokal 4ta', '2025-07-24 21:22:36', '2025-07-27 05:47:22'),
(6, 'Sokal 5am-7pm', '05:00', '20:30', '04:30', 'Sokal 5am Theke Bikal 7pm', '2025-07-27 06:17:11', NULL),
(7, 'Sokal 10am-12am', '10:00', '23:30', '00:30', 'Sokal 10am theke raat 12am', '2025-07-27 06:18:16', NULL),
(8, '2Shift Sokal 5-12', '05:00', '23:30', '12:30', 'Sokal 5ta theke dupur 12 ta', '2025-07-27 06:20:03', NULL),
(9, '2Shift Bikal 9-Rat  2', '21:00', '03:30', '02:30', '', '2025-07-27 06:27:08', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `shift_assign`
--

CREATE TABLE `shift_assign` (
  `id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `shift_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `shift_assign`
--

INSERT INTO `shift_assign` (`id`, `employee_id`, `shift_id`) VALUES
(5, 1, 6),
(6, 7, 7),
(7, 9, 4),
(8, 10, 6),
(9, 11, 6),
(10, 12, 4),
(11, 13, 4),
(12, 15, 6),
(13, 16, 4);

-- --------------------------------------------------------

--
-- Table structure for table `shops`
--

CREATE TABLE `shops` (
  `id` int(11) NOT NULL,
  `shop_name` varchar(255) NOT NULL,
  `owner_name` varchar(255) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `status` enum('active','inactive') DEFAULT 'active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `shops`
--

INSERT INTO `shops` (`id`, `shop_name`, `owner_name`, `phone`, `email`, `address`, `status`, `created_at`, `updated_at`) VALUES
(2, 'Dhaka', 'Md Shagor', '01712036295', 'binarybrainaic@gmail.com', 'Saghatta\r\nSaghatta', 'active', '2025-07-28 18:46:44', '2025-07-28 18:46:44');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `profile_image` varchar(255) DEFAULT NULL,
  `role` enum('admin','user') DEFAULT 'user',
  `status` tinyint(1) DEFAULT 1,
  `email_verified` tinyint(1) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `remember_token` varchar(100) NOT NULL,
  `selected_location_id` int(11) DEFAULT NULL,
  `permission` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `phone`, `password`, `profile_image`, `role`, `status`, `email_verified`, `created_at`, `updated_at`, `remember_token`, `selected_location_id`, `permission`) VALUES
(1, 'Md Shagor Ali', 'binarybrainaic@gmail.com', '01712036295', '$2y$10$0qCj7IOyIBBwJ6.uhnThYORhMx.31X9oPjLOSXEUYGWnPSZqDITmm', 'uploads/68820446f231c_user-profile.jpeg', 'user', 1, 0, '2025-07-24 07:59:54', '2025-07-28 15:01:53', '2f07cf2e483ee54e13542eafe92ec1be40ff2e602abd87b8c89832efed264c20', NULL, 'admin'),
(2, 'ahsan', 'azzouzmb2025@gmail.com', '0553687388', '$2y$10$/WKtY9UhWmqnpvM8inTxn.A06EekL/ZJLcviW32gbq8S.lxj34Aza', NULL, 'user', 1, 0, '2025-07-25 02:50:22', '2025-07-28 15:01:57', '80227c6a3aeeb0eeb2d9048d67eb357f31497109781dd7a9f991b6c69b2e308e', NULL, 'shop');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_att` (`employee_id`,`attendance_date`,`shift_id`);

--
-- Indexes for table `attendance_log_status`
--
ALTER TABLE `attendance_log_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `attlog`
--
ALTER TABLE `attlog`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `documents`
--
ALTER TABLE `documents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_id` (`user_id`),
  ADD KEY `group_id` (`group_id`);

--
-- Indexes for table `employee_shifts`
--
ALTER TABLE `employee_shifts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `employee_shift_unique` (`employee_id`,`shift_id`),
  ADD KEY `shift_id` (`shift_id`);

--
-- Indexes for table `expense_entries`
--
ALTER TABLE `expense_entries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `locations`
--
ALTER TABLE `locations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `overtime`
--
ALTER TABLE `overtime`
  ADD PRIMARY KEY (`id`),
  ADD KEY `employee_id` (`employee_id`),
  ADD KEY `shift_id` (`shift_id`);

--
-- Indexes for table `salaries`
--
ALTER TABLE `salaries`
  ADD PRIMARY KEY (`id`),
  ADD KEY `employee_id` (`employee_id`);

--
-- Indexes for table `sell_entries`
--
ALTER TABLE `sell_entries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shifts`
--
ALTER TABLE `shifts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `shift_assign`
--
ALTER TABLE `shift_assign`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shops`
--
ALTER TABLE `shops`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT for table `attendance_log_status`
--
ALTER TABLE `attendance_log_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `attlog`
--
ALTER TABLE `attlog`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=149;

--
-- AUTO_INCREMENT for table `documents`
--
ALTER TABLE `documents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `employee_shifts`
--
ALTER TABLE `employee_shifts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `expense_entries`
--
ALTER TABLE `expense_entries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `locations`
--
ALTER TABLE `locations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `overtime`
--
ALTER TABLE `overtime`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `salaries`
--
ALTER TABLE `salaries`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sell_entries`
--
ALTER TABLE `sell_entries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `shifts`
--
ALTER TABLE `shifts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `shift_assign`
--
ALTER TABLE `shift_assign`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `shops`
--
ALTER TABLE `shops`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `employees`
--
ALTER TABLE `employees`
  ADD CONSTRAINT `employees_ibfk_1` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `employee_shifts`
--
ALTER TABLE `employee_shifts`
  ADD CONSTRAINT `employee_shifts_ibfk_1` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `employee_shifts_ibfk_2` FOREIGN KEY (`shift_id`) REFERENCES `shifts` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `overtime`
--
ALTER TABLE `overtime`
  ADD CONSTRAINT `overtime_ibfk_1` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `overtime_ibfk_2` FOREIGN KEY (`shift_id`) REFERENCES `shifts` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `salaries`
--
ALTER TABLE `salaries`
  ADD CONSTRAINT `salaries_ibfk_1` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
