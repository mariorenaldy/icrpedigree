-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 18, 2023 at 03:02 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `icrpedigree`
--

-- --------------------------------------------------------

--
-- Table structure for table `approval_status`
--

CREATE TABLE `approval_status` (
  `stat_id` tinyint(4) NOT NULL,
  `stat_name` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `approval_status`
--

INSERT INTO `approval_status` (`stat_id`, `stat_name`) VALUES
(0, 'Diproses / Processed'),
(1, 'Disetujui / Accepted'),
(2, 'Ditolak / Rejected'),
(3, 'Selesai / Completed'),
(4, 'Dibatalkan / Cancelled'),
(5, 'Belum dibayar / Not yet paid'),
(6, 'Pembayaran gagal / Payment failed'),
(7, 'Dihapus / Deleted');

-- --------------------------------------------------------

--
-- Table structure for table `births`
--

CREATE TABLE `births` (
  `bir_id` int(11) NOT NULL,
  `bir_stu_id` int(11) NOT NULL,
  `bir_member_id` int(11) NOT NULL,
  `bir_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `bir_user` tinyint(4) NOT NULL,
  `bir_reg_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `bir_app_user` int(4) NOT NULL,
  `bir_app_date` timestamp NULL DEFAULT NULL,
  `bir_stat` tinyint(4) NOT NULL DEFAULT 0,
  `bir_date_of_birth` date NOT NULL,
  `bir_dam_photo` text NOT NULL,
  `bir_male` int(11) NOT NULL,
  `bir_female` int(11) NOT NULL,
  `bir_app_note` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `births`
--

INSERT INTO `births` (`bir_id`, `bir_stu_id`, `bir_member_id`, `bir_date`, `bir_user`, `bir_reg_date`, `bir_app_user`, `bir_app_date`, `bir_stat`, `bir_date_of_birth`, `bir_dam_photo`, `bir_male`, `bir_female`, `bir_app_note`) VALUES
(1, 1, 4, '2023-06-25 12:37:20', 1, '2023-05-10 12:35:01', 2, '2023-06-25 12:35:08', 3, '2023-05-10', 'birth_1687696501.png', 2, 2, ''),
(2, 2, 4, '2023-06-25 12:45:43', 2, '2023-05-05 12:45:38', 2, '2023-06-25 12:45:43', 3, '2023-05-05', 'birth_1687697138.png', 0, 2, ''),
(3, 4, 13, '2023-12-18 12:59:55', 2, '2023-06-25 15:20:50', 2, '2023-06-25 15:22:11', 1, '2023-05-13', 'birth_1687706450.png', 2, 2, ''),
(4, 5, 13, '2023-06-25 23:05:59', 2, '2023-06-25 23:05:52', 2, '2023-06-25 23:05:59', 3, '2023-04-19', 'birth_1687734352.png', 1, 1, ''),
(5, 6, 15, '2023-06-25 23:17:08', 2, '2022-08-30 23:17:03', 2, '2023-06-25 23:17:08', 3, '2023-04-19', 'birth_1687735023.png', 1, 2, ''),
(6, 7, 13, '2023-06-25 23:25:07', 2, '2023-06-25 23:25:02', 2, '2023-06-25 23:25:07', 3, '2023-04-20', 'birth_1687735502.png', 1, 2, ''),
(7, 9, 13, '2023-06-25 23:49:56', 2, '2023-06-25 23:49:15', 2, '2023-06-25 23:49:56', 1, '2023-04-19', 'birth_1687736955.png', 2, 2, ''),
(8, 10, 15, '2023-06-26 00:08:27', 2, '2023-06-26 00:08:21', 2, '2023-06-26 00:08:27', 0, '2023-04-24', 'birth_1687738101.png', 1, 1, ''),
(9, 12, 13, '2023-12-18 07:10:11', 2, '2023-12-13 04:17:57', 2, '2023-12-13 04:18:10', 0, '2023-10-12', 'birth_1702441077.png', 1, 1, ''),
(10, 13, 13, '2023-12-18 09:14:44', 2, '2023-12-14 05:41:25', 2, '2023-12-18 08:49:43', 3, '2023-10-01', 'birth_1702532485.png', 2, 2, 'del'),
(11, 14, 13, '2023-12-18 13:55:37', 2, '2023-12-18 13:50:07', 2, '2023-12-18 13:50:25', 3, '2023-10-24', 'birth_1702907407.png', 2, 3, '');

-- --------------------------------------------------------

--
-- Table structure for table `canines`
--

CREATE TABLE `canines` (
  `can_id` int(11) NOT NULL,
  `can_reg_number` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `can_a_s` varchar(60) NOT NULL,
  `can_icr_number` varchar(15) NOT NULL,
  `can_breed` varchar(50) NOT NULL,
  `can_gender` varchar(10) NOT NULL,
  `can_color` varchar(50) NOT NULL,
  `can_date_of_birth` date NOT NULL,
  `can_chip_number` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `can_reg_date` date NOT NULL,
  `can_photo` text NOT NULL,
  `can_stat` tinyint(4) NOT NULL,
  `can_note` text NOT NULL,
  `can_member_id` int(11) NOT NULL,
  `can_print` tinyint(4) NOT NULL DEFAULT 0,
  `can_rip` tinyint(4) NOT NULL DEFAULT 0,
  `can_app_user` tinyint(4) NOT NULL,
  `can_app_date` timestamp NULL DEFAULT NULL,
  `can_app_note` text NOT NULL,
  `can_kennel_id` int(11) NOT NULL DEFAULT 0,
  `can_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `can_user` tinyint(4) NOT NULL,
  `can_last_print` datetime DEFAULT NULL,
  `can_pay_id` int(11) NOT NULL,
  `can_pay_photo` text DEFAULT NULL,
  `can_pay_invoice` varchar(60) DEFAULT NULL,
  `can_pay_due_date` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `canines`
--

INSERT INTO `canines` (`can_id`, `can_reg_number`, `can_a_s`, `can_icr_number`, `can_breed`, `can_gender`, `can_color`, `can_date_of_birth`, `can_chip_number`, `can_reg_date`, `can_photo`, `can_stat`, `can_note`, `can_member_id`, `can_print`, `can_rip`, `can_app_user`, `can_app_date`, `can_app_note`, `can_kennel_id`, `can_date`, `can_user`, `can_last_print`, `can_pay_id`, `can_pay_photo`, `can_pay_invoice`, `can_pay_due_date`) VALUES
(1, '-', 'NO MALE', '-', 'AMERICAN PIT BULL TERRIER', 'MALE', '-', '2000-01-01', '-', '2013-05-26', '-', 1, '', 1, 0, 0, 0, '2022-03-21 07:23:15', '', 0, '2023-02-10 05:50:57', 0, NULL, 0, '', '', NULL),
(2, '-', 'NO FEMALE', '-', 'AMERICAN PIT BULL TERRIER', 'FEMALE', '-', '2000-01-01', '-', '2013-05-26', '-', 1, '', 1, 0, 0, 0, '2022-03-21 07:23:15', '', 0, '2023-02-10 05:50:57', 0, NULL, 0, '', '', NULL),
(3, '-', 'GREAT POINT` EDGAR', '-', 'AMERICAN PIT BULL TERRIER', 'MALE', '-', '2022-05-01', '-', '2023-03-01', 'canine_1687694015.png', 1, '', 2, 0, 0, 2, '2023-06-25 11:55:21', '', 2, '2023-06-25 11:55:21', 2, NULL, 0, 'payment_1687694015.png', '', NULL),
(4, '-', 'GREAT POINT` ARANDA', '-', 'AMERICAN PIT BULL TERRIER', 'FEMALE', '-', '2022-04-01', '-', '2023-06-25', 'canine_1687694279.png', 1, '', 2, 0, 0, 2, '2023-06-25 11:58:04', '', 2, '2023-06-25 11:58:04', 2, NULL, 0, 'payment_1687694279.png', '', NULL),
(5, '-', 'DELPHIE VON NORTH SANTIAM', '-', 'AMERICAN PIT BULL TERRIER', 'FEMALE', '-', '2022-01-06', '-', '2023-06-25', 'canine_1687694521.png', 1, '', 4, 0, 0, 2, '2023-06-25 12:02:07', '', 4, '2023-06-25 12:02:07', 2, NULL, 0, 'payment_1687694521.png', '', NULL),
(6, '-', 'LIONEL VON NORTH SANTIAM', '-', 'AMERICAN PIT BULL TERRIER', 'MALE', '-', '2022-03-08', '-', '2023-06-25', 'canine_1687694571.png', 1, '', 4, 0, 0, 2, '2023-06-25 12:02:56', '', 4, '2023-06-25 12:02:56', 2, NULL, 0, 'payment_1687694571.png', '', NULL),
(7, '-', 'ARIA VON NORTH SANTIAM', '-', 'AMERICAN PIT BULL TERRIER', 'FEMALE', '-', '2022-05-01', '-', '2023-06-25', 'canine_1687696632.png', 1, '', 4, 0, 0, 2, '2023-06-25 12:37:24', '', 4, '2023-06-25 12:41:11', 2, NULL, 0, 'payment_1687696632.png', '', NULL),
(8, '-', 'SCHAFFER RIDGE` ROCKY', '-', 'AMERICAN PIT BULL TERRIER', 'MALE', '-', '2022-02-09', '-', '2023-06-25', 'canine_1687696815.png', 1, '', 6, 0, 0, 2, '2023-06-25 12:40:21', '', 6, '2023-06-25 12:40:21', 2, NULL, 0, 'payment_1687696815.png', '', NULL),
(9, '-', 'WILDLINE` AQUILA', '-', 'AMERICAN PIT BULL TERRIER', 'FEMALE', '-', '2022-05-04', '-', '2023-06-25', 'canine_1687697458.png', 1, '', 13, 0, 0, 2, '2023-06-25 12:51:06', '', 13, '2023-06-25 22:52:55', 2, NULL, 0, 'payment_1687697458.png', '', NULL),
(10, '-', 'DIONA VON NORTH SANTIAM', '-', 'AMERICAN PIT BULL TERRIER', 'FEMALE', '-', '2023-05-05', '-', '2023-06-25', 'canine_1687697401.png', 1, '', 6, 0, 0, 2, '2023-06-25 12:51:09', '', 6, '2023-06-25 13:38:25', 2, NULL, 0, 'payment_1687697401.png', '', NULL),
(11, '-', 'EMMA VON EXPLOSIVE', '-', 'DESIGNER BULLY', 'FEMALE', '-', '2021-11-02', '-', '2022-03-02', 'canine_1687703353.png', 1, '', 10, 0, 0, 2, '2023-06-25 14:32:56', '', 10, '2023-06-25 14:32:56', 2, NULL, 0, 'payment_1687703353.png', '', NULL),
(12, '-', 'DESSY VON EXPLOSIVE', '-', 'GIANT POODLE', 'FEMALE', '-', '2021-10-02', '-', '2021-10-01', 'canine_1687703477.png', 1, '', 10, 0, 0, 2, '2023-06-25 14:32:54', '', 10, '2023-06-25 14:32:54', 2, NULL, 0, 'payment_1687703477.png', '', NULL),
(14, '-', 'WILDLINE` CAROL', '-', 'DESIGNER BULLY', 'FEMALE', '-', '2021-09-01', '-', '2023-06-25', 'canine_1687704278.png', 1, '', 13, 0, 0, 2, '2023-06-25 14:46:01', '', 13, '2023-06-25 14:46:01', 2, NULL, 0, 'payment_1687704278.png', '', NULL),
(15, '-', 'WILDLINE` EVIANA', '-', 'DESIGNER BULLY', 'FEMALE', '-', '2021-03-03', '-', '2023-06-25', 'canine_1687704347.png', 1, '', 13, 0, 0, 2, '2023-06-25 14:45:59', '', 13, '2023-06-25 14:45:59', 2, NULL, 0, 'payment_1687704347.png', '', NULL),
(16, '-', 'WILDLINE` TRISTANA', '-', 'GIANT POODLE', 'FEMALE', '-', '2021-10-06', '-', '2023-06-25', 'canine_1687704408.png', 1, '', 13, 0, 0, 2, '2023-06-25 14:48:29', '', 13, '2023-06-25 14:48:29', 2, NULL, 0, 'payment_1687704408.png', '', NULL),
(17, '-', 'WILDLINE` IONIA', '-', 'GIANT POODLE', 'FEMALE', '-', '2022-01-07', '-', '2023-05-03', 'canine_1687704457.png', 1, '', 13, 0, 0, 2, '2023-06-25 14:48:27', '', 13, '2023-06-25 14:48:27', 2, NULL, 0, 'payment_1687704457.png', '', NULL),
(18, '-', 'WILDLINE` JEREMIAH', '-', 'GIANT POODLE', 'MALE', '-', '2021-11-03', '-', '2023-06-25', 'canine_1687704500.png', 0, '', 13, 0, 0, 0, NULL, '', 13, '2023-06-25 14:48:20', 0, NULL, 0, 'payment_1687704500.png', '', NULL),
(22, '-', 'WILDLINE` NIKITA', '-', 'AMERICAN PIT BULL TERRIER', 'FEMALE', '-', '2021-10-05', '2039455', '2022-08-10', 'canine_1687704835.png', 1, '', 13, 1, 0, 2, '2023-06-25 14:54:00', '', 13, '2023-06-25 16:56:21', 2, '2023-12-12 13:28:40', 0, 'payment_1687704835.png', '', NULL),
(24, '-', 'MAYFLOWER` JOE', '-', 'DESIGNER BULLY', 'MALE', '-', '2022-03-02', '-', '2023-06-25', 'canine_1687705483.png', 1, '', 14, 0, 0, 2, '2023-06-25 15:04:48', '', 14, '2023-06-25 15:14:42', 2, NULL, 0, 'payment_1687705483.png', '', NULL),
(25, '-', 'MAYFLOWER` LEVINE', '-', 'AMERICAN PIT BULL TERRIER', 'MALE', '-', '2021-11-04', '-', '2021-10-08', 'canine_1687705529.png', 1, '', 14, 0, 0, 2, '2023-06-25 15:05:35', '', 14, '2023-06-25 15:14:30', 2, NULL, 0, 'payment_1687705529.png', '', NULL),
(26, '-', 'MAYFLOWER` JAMES', '-', 'GIANT POODLE', 'MALE', '-', '2021-11-04', '-', '2023-05-17', 'canine_1687705617.png', 1, '', 14, 0, 0, 2, '2023-06-25 15:07:01', '', 14, '2023-06-25 15:07:57', 2, NULL, 0, 'payment_1687705617.png', '', NULL),
(28, '-', 'JACKSON VON LYNWOOD', '-', 'AMERICAN PIT BULL TERRIER', 'MALE', '-', '2022-01-04', '-', '2023-04-08', 'canine_1687733925.png', 1, '', 15, 0, 0, 2, '2023-06-25 22:58:50', '', 15, '2023-06-25 22:58:50', 2, NULL, 0, 'payment_1687733925.png', '', NULL),
(29, '-', 'WILDLINE` HANNAH', '-', 'AMERICAN PIT BULL TERRIER', 'FEMALE', '-', '2022-02-03', '-', '2023-06-26', 'canine_1687734558.png', 1, '', 13, 0, 0, 2, '2023-06-25 23:09:28', '', 13, '2023-06-25 23:09:28', 2, NULL, 0, 'payment_1687734558.png', '', NULL),
(30, '-', 'SABRINA VON LYNWOOD', '-', 'AMERICAN PIT BULL TERRIER', 'FEMALE', '-', '2022-03-03', '-', '2023-06-26', 'canine_1687734836.png', 1, '', 15, 0, 0, 2, '2023-06-25 23:14:02', '', 15, '2023-06-25 23:14:02', 2, NULL, 0, 'payment_1687734836.png', '', NULL),
(31, '-', 'CASSIUS VON LYNWOOD', '-', 'AMERICAN PIT BULL TERRIER', 'MALE', '-', '2021-04-08', '-', '2023-06-26', 'canine_1687735126.png', 1, '', 15, 0, 0, 2, '2023-06-25 23:19:57', '', 15, '2023-06-25 23:19:57', 2, NULL, 0, 'payment_1687735126.png', '', NULL),
(32, '-', 'WILDLINE` RENGAR', '-', 'AMERICAN PIT BULL TERRIER', 'MALE', '-', '2023-04-20', '-', '2023-04-05', 'canine_1687735579.png', 1, '', 13, 0, 0, 2, '2023-06-25 23:26:59', '', 13, '2023-06-25 23:26:59', 2, NULL, 0, 'payment_1687735579.png', '', NULL),
(33, '-', 'WILDLINE` SANDRA', '-', 'AMERICAN PIT BULL TERRIER', 'FEMALE', '-', '2022-04-03', '-', '2023-04-06', 'canine_1687735552.png', 1, '', 13, 0, 0, 2, '2023-06-25 23:27:02', '', 13, '2023-06-25 23:27:02', 2, NULL, 0, 'payment_1687735552.png', '', NULL),
(36, '-', 'SCHAFFER RIDGE` WAYNE', '-', 'AMERICAN PIT BULL TERRIER', 'MALE', '-', '2022-03-10', '-', '2023-03-31', 'canine_1687736750.png', 1, '', 6, 0, 0, 2, '2023-06-25 23:45:54', '', 6, '2023-06-25 23:45:54', 2, NULL, 0, 'payment_1687736750.png', '', NULL),
(37, '-', 'YUNA VON LYNWOOD', '-', 'GIANT POODLE', 'FEMALE', '-', '2022-02-09', '-', '2023-06-26', 'canine_1687737883.png', 1, '', 15, 0, 0, 2, '2023-06-26 00:05:32', '', 15, '2023-06-26 00:05:32', 2, NULL, 0, 'payment_1687737883.png', '', NULL),
(38, '-', 'CLYDE VON LYNWOOD', '-', 'GIANT POODLE', 'MALE', '-', '2022-05-04', '-', '2023-06-26', 'canine_1687737926.png', 1, '', 15, 0, 0, 2, '2023-06-26 00:05:30', '', 15, '2023-06-26 00:06:02', 2, NULL, 0, 'payment_1687737926.png', '', NULL),
(77, '-', 'JONATHAN VON LOWBRAD', '-', 'AMERICAN PIT BULL TERRIER', 'MALE', '-', '2022-10-06', '-', '2023-12-18', 'canine_1702906994.png', 1, '', 39, 0, 0, 2, '2023-12-18 13:43:37', '', 39, '2023-12-18 13:44:09', 2, NULL, 2, '-', 'TESCAN-67926676', '2023-12-18 14:43:14'),
(78, '-', 'WILDLINE` TATIANA', '-', 'AMERICAN PIT BULL TERRIER', 'MALE', '-', '2023-10-24', '-', '2023-12-18', 'canine_17029078942.png', 1, '', 13, 0, 0, 2, '2023-12-18 13:58:35', '', 13, '2023-12-18 13:58:35', 2, NULL, 0, '-', NULL, NULL),
(79, '-', 'KENGO VON LOWBRAD', '-', 'AMERICAN PIT BULL TERRIER', 'MALE', '-', '2023-10-24', '-', '2023-12-18', 'canine_17029078941.png', 1, '', 39, 0, 0, 2, '2023-12-18 13:58:37', '', 39, '2023-12-18 13:59:32', 2, NULL, 0, '-', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `canine_notes`
--

CREATE TABLE `canine_notes` (
  `note_id` int(11) NOT NULL,
  `can_id` int(11) NOT NULL,
  `note_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `note_user` int(11) NOT NULL,
  `note_desc` text NOT NULL,
  `note_stat` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `certificate_complain`
--

CREATE TABLE `certificate_complain` (
  `com_id` int(11) NOT NULL,
  `com_req_id` int(11) NOT NULL,
  `com_photo` text NOT NULL,
  `com_desc` text NOT NULL,
  `com_created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `certificate_complain`
--

INSERT INTO `certificate_complain` (`com_id`, `com_req_id`, `com_photo`, `com_desc`, `com_created_at`) VALUES
(1, 9, 'complain_1702622532.png', 'tidak sampai', '2023-12-15 06:42:12');

-- --------------------------------------------------------

--
-- Table structure for table `certificate_status`
--

CREATE TABLE `certificate_status` (
  `cert_stat_id` int(11) NOT NULL,
  `cert_stat_name` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `certificate_status`
--

INSERT INTO `certificate_status` (`cert_stat_id`, `cert_stat_name`) VALUES
(1, 'Sedang diproses / Being processed'),
(2, 'Sedang dikirim / Being delivered'),
(3, 'Sampai pada tujuan / Arrived at the destination'),
(4, 'Dibatalkan / Cancelled'),
(5, 'Ditolak / Rejected'),
(6, 'Selesai / Completed'),
(7, 'Dikomplain / Complained');

-- --------------------------------------------------------

--
-- Table structure for table `city`
--

CREATE TABLE `city` (
  `city_id` int(11) NOT NULL,
  `city_name` varchar(60) NOT NULL,
  `city_province_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `city`
--

INSERT INTO `city` (`city_id`, `city_name`, `city_province_id`) VALUES
(1, 'Kabupaten Aceh Barat', 21),
(2, 'Kabupaten Aceh Barat Daya', 21),
(3, 'Kabupaten Aceh Besar', 21),
(4, 'Kabupaten Aceh Jaya', 21),
(5, 'Kabupaten Aceh Selatan', 21),
(6, 'Kabupaten Aceh Singkil', 21),
(7, 'Kabupaten Aceh Tamiang', 21),
(8, 'Kabupaten Aceh Tengah', 21),
(9, 'Kabupaten Aceh Tenggara', 21),
(10, 'Kabupaten Aceh Timur', 21),
(11, 'Kabupaten Aceh Utara', 21),
(12, 'Kabupaten Agam', 32),
(13, 'Kabupaten Alor', 23),
(14, 'Kota Ambon', 19),
(15, 'Kabupaten Asahan', 34),
(16, 'Kabupaten Asmat', 24),
(17, 'Kabupaten Badung', 1),
(18, 'Kabupaten Balangan', 13),
(19, 'Kota Balikpapan', 15),
(20, 'Kota Banda Aceh', 21),
(21, 'Kota Bandar Lampung', 18),
(22, 'Kabupaten Bandung', 9),
(23, 'Kota Bandung', 9),
(24, 'Kabupaten Bandung Barat', 9),
(25, 'Kabupaten Banggai', 29),
(26, 'Kabupaten Banggai Kepulauan', 29),
(27, 'Kabupaten Bangka', 2),
(28, 'Kabupaten Bangka Barat', 2),
(29, 'Kabupaten Bangka Selatan', 2),
(30, 'Kabupaten Bangka Tengah', 2),
(31, 'Kabupaten Bangkalan', 11),
(32, 'Kabupaten Bangli', 1),
(33, 'Kabupaten Banjar', 13),
(34, 'Kota Banjar', 9),
(35, 'Kota Banjarbaru', 13),
(36, 'Kota Banjarmasin', 13),
(37, 'Kabupaten Banjarnegara', 10),
(38, 'Kabupaten Bantaeng', 28),
(39, 'Kabupaten Bantul', 5),
(40, 'Kabupaten Banyuasin', 33),
(41, 'Kabupaten Banyumas', 10),
(42, 'Kabupaten Banyuwangi', 11),
(43, 'Kabupaten Barito Kuala', 13),
(44, 'Kabupaten Barito Selatan', 14),
(45, 'Kabupaten Barito Timur', 14),
(46, 'Kabupaten Barito Utara', 14),
(47, 'Kabupaten Barru', 28),
(48, 'Kota Batam', 17),
(49, 'Kabupaten Batang', 10),
(50, 'Kabupaten Batang Hari', 8),
(51, 'Kota Batu', 11),
(52, 'Kabupaten Batu Bara', 34),
(53, 'Kota Bau-Bau', 30),
(54, 'Kabupaten Bekasi', 9),
(55, 'Kota Bekasi', 9),
(56, 'Kabupaten Belitung', 2),
(57, 'Kabupaten Belitung Timur', 2),
(58, 'Kabupaten Belu', 23),
(59, 'Kabupaten Bener Meriah', 21),
(60, 'Kabupaten Bengkalis', 26),
(61, 'Kabupaten Bengkayang', 12),
(62, 'Kota Bengkulu', 4),
(63, 'Kabupaten Bengkulu Selatan', 4),
(64, 'Kabupaten Bengkulu Tengah', 4),
(65, 'Kabupaten Bengkulu Utara', 4),
(66, 'Kabupaten Berau', 15),
(67, 'Kabupaten Biak Numfor', 24),
(68, 'Kabupaten Bima', 22),
(69, 'Kota Bima', 22),
(70, 'Kota Binjai', 34),
(71, 'Kabupaten Bintan', 17),
(72, 'Kabupaten Bireuen', 21),
(73, 'Kota Bitung', 31),
(74, 'Kabupaten Blitar', 11),
(75, 'Kota Blitar', 11),
(76, 'Kabupaten Blora', 10),
(77, 'Kabupaten Boalemo', 7),
(78, 'Kabupaten Bogor', 9),
(79, 'Kota Bogor', 9),
(80, 'Kabupaten Bojonegoro', 11),
(81, 'Kabupaten Bolaang Mongondow (Bolmong)', 31),
(82, 'Kabupaten Bolaang Mongondow Selatan', 31),
(83, 'Kabupaten Bolaang Mongondow Timur', 31),
(84, 'Kabupaten Bolaang Mongondow Utara', 31),
(85, 'Kabupaten Bombana', 30),
(86, 'Kabupaten Bondowoso', 11),
(87, 'Kabupaten Bone', 28),
(88, 'Kabupaten Bone Bolango', 7),
(89, 'Kota Bontang', 15),
(90, 'Kabupaten Boven Digoel', 24),
(91, 'Kabupaten Boyolali', 10),
(92, 'Kabupaten Brebes', 10),
(93, 'Kota Bukittinggi', 32),
(94, 'Kabupaten Buleleng', 1),
(95, 'Kabupaten Bulukumba', 28),
(96, 'Kabupaten Bulungan (Bulongan)', 16),
(97, 'Kabupaten Bungo', 8),
(98, 'Kabupaten Buol', 29),
(99, 'Kabupaten Buru', 19),
(100, 'Kabupaten Buru Selatan', 19),
(101, 'Kabupaten Buton', 30),
(102, 'Kabupaten Buton Utara', 30),
(103, 'Kabupaten Ciamis', 9),
(104, 'Kabupaten Cianjur', 9),
(105, 'Kabupaten Cilacap', 10),
(106, 'Kota Cilegon', 3),
(107, 'Kota Cimahi', 9),
(108, 'Kabupaten Cirebon', 9),
(109, 'Kota Cirebon', 9),
(110, 'Kabupaten Dairi', 34),
(111, 'Kabupaten Deiyai (Deliyai)', 24),
(112, 'Kabupaten Deli Serdang', 34),
(113, 'Kabupaten Demak', 10),
(114, 'Kota Denpasar', 1),
(115, 'Kota Depok', 9),
(116, 'Kabupaten Dharmasraya', 32),
(117, 'Kabupaten Dogiyai', 24),
(118, 'Kabupaten Dompu', 22),
(119, 'Kabupaten Donggala', 29),
(120, 'Kota Dumai', 26),
(121, 'Kabupaten Empat Lawang', 33),
(122, 'Kabupaten Ende', 23),
(123, 'Kabupaten Enrekang', 28),
(124, 'Kabupaten Fakfak', 25),
(125, 'Kabupaten Flores Timur', 23),
(126, 'Kabupaten Garut', 9),
(127, 'Kabupaten Gayo Lues', 21),
(128, 'Kabupaten Gianyar', 1),
(129, 'Kabupaten Gorontalo', 7),
(130, 'Kota Gorontalo', 7),
(131, 'Kabupaten Gorontalo Utara', 7),
(132, 'Kabupaten Gowa', 28),
(133, 'Kabupaten Gresik', 11),
(134, 'Kabupaten Grobogan', 10),
(135, 'Kabupaten Gunung Kidul', 5),
(136, 'Kabupaten Gunung Mas', 14),
(137, 'Kota Gunungsitoli', 34),
(138, 'Kabupaten Halmahera Barat', 20),
(139, 'Kabupaten Halmahera Selatan', 20),
(140, 'Kabupaten Halmahera Tengah', 20),
(141, 'Kabupaten Halmahera Timur', 20),
(142, 'Kabupaten Halmahera Utara', 20),
(143, 'Kabupaten Hulu Sungai Selatan', 13),
(144, 'Kabupaten Hulu Sungai Tengah', 13),
(145, 'Kabupaten Hulu Sungai Utara', 13),
(146, 'Kabupaten Humbang Hasundutan', 34),
(147, 'Kabupaten Indragiri Hilir', 26),
(148, 'Kabupaten Indragiri Hulu', 26),
(149, 'Kabupaten Indramayu', 9),
(150, 'Kabupaten Intan Jaya', 24),
(151, 'Kota Jakarta Barat', 6),
(152, 'Kota Jakarta Pusat', 6),
(153, 'Kota Jakarta Selatan', 6),
(154, 'Kota Jakarta Timur', 6),
(155, 'Kota Jakarta Utara', 6),
(156, 'Kota Jambi', 8),
(157, 'Kabupaten Jayapura', 24),
(158, 'Kota Jayapura', 24),
(159, 'Kabupaten Jayawijaya', 24),
(160, 'Kabupaten Jember', 11),
(161, 'Kabupaten Jembrana', 1),
(162, 'Kabupaten Jeneponto', 28),
(163, 'Kabupaten Jepara', 10),
(164, 'Kabupaten Jombang', 11),
(165, 'Kabupaten Kaimana', 25),
(166, 'Kabupaten Kampar', 26),
(167, 'Kabupaten Kapuas', 14),
(168, 'Kabupaten Kapuas Hulu', 12),
(169, 'Kabupaten Karanganyar', 10),
(170, 'Kabupaten Karangasem', 1),
(171, 'Kabupaten Karawang', 9),
(172, 'Kabupaten Karimun', 17),
(173, 'Kabupaten Karo', 34),
(174, 'Kabupaten Katingan', 14),
(175, 'Kabupaten Kaur', 4),
(176, 'Kabupaten Kayong Utara', 12),
(177, 'Kabupaten Kebumen', 10),
(178, 'Kabupaten Kediri', 11),
(179, 'Kota Kediri', 11),
(180, 'Kabupaten Keerom', 24),
(181, 'Kabupaten Kendal', 10),
(182, 'Kota Kendari', 30),
(183, 'Kabupaten Kepahiang', 4),
(184, 'Kabupaten Kepulauan Anambas', 17),
(185, 'Kabupaten Kepulauan Aru', 19),
(186, 'Kabupaten Kepulauan Mentawai', 32),
(187, 'Kabupaten Kepulauan Meranti', 26),
(188, 'Kabupaten Kepulauan Sangihe', 31),
(189, 'Kabupaten Kepulauan Seribu', 6),
(190, 'Kabupaten Kepulauan Siau Tagulandang Biaro (Sitaro)', 31),
(191, 'Kabupaten Kepulauan Sula', 20),
(192, 'Kabupaten Kepulauan Talaud', 31),
(193, 'Kabupaten Kepulauan Yapen (Yapen Waropen)', 24),
(194, 'Kabupaten Kerinci', 8),
(195, 'Kabupaten Ketapang', 12),
(196, 'Kabupaten Klaten', 10),
(197, 'Kabupaten Klungkung', 1),
(198, 'Kabupaten Kolaka', 30),
(199, 'Kabupaten Kolaka Utara', 30),
(200, 'Kabupaten Konawe', 30),
(201, 'Kabupaten Konawe Selatan', 30),
(202, 'Kabupaten Konawe Utara', 30),
(203, 'Kabupaten Kotabaru', 13),
(204, 'Kota Kotamobagu', 31),
(205, 'Kabupaten Kotawaringin Barat', 14),
(206, 'Kabupaten Kotawaringin Timur', 14),
(207, 'Kabupaten Kuantan Singingi', 26),
(208, 'Kabupaten Kubu Raya', 12),
(209, 'Kabupaten Kudus', 10),
(210, 'Kabupaten Kulon Progo', 5),
(211, 'Kabupaten Kuningan', 9),
(212, 'Kabupaten Kupang', 23),
(213, 'Kota Kupang', 23),
(214, 'Kabupaten Kutai Barat', 15),
(215, 'Kabupaten Kutai Kartanegara', 15),
(216, 'Kabupaten Kutai Timur', 15),
(217, 'Kabupaten Labuhan Batu', 34),
(218, 'Kabupaten Labuhan Batu Selatan', 34),
(219, 'Kabupaten Labuhan Batu Utara', 34),
(220, 'Kabupaten Lahat', 33),
(221, 'Kabupaten Lamandau', 14),
(222, 'Kabupaten Lamongan', 11),
(223, 'Kabupaten Lampung Barat', 18),
(224, 'Kabupaten Lampung Selatan', 18),
(225, 'Kabupaten Lampung Tengah', 18),
(226, 'Kabupaten Lampung Timur', 18),
(227, 'Kabupaten Lampung Utara', 18),
(228, 'Kabupaten Landak', 12),
(229, 'Kabupaten Langkat', 34),
(230, 'Kota Langsa', 21),
(231, 'Kabupaten Lanny Jaya', 24),
(232, 'Kabupaten Lebak', 3),
(233, 'Kabupaten Lebong', 4),
(234, 'Kabupaten Lembata', 23),
(235, 'Kota Lhokseumawe', 21),
(236, 'Kabupaten Lima Puluh Koto/Kota', 32),
(237, 'Kabupaten Lingga', 17),
(238, 'Kabupaten Lombok Barat', 22),
(239, 'Kabupaten Lombok Tengah', 22),
(240, 'Kabupaten Lombok Timur', 22),
(241, 'Kabupaten Lombok Utara', 22),
(242, 'Kota Lubuk Linggau', 33),
(243, 'Kabupaten Lumajang', 11),
(244, 'Kabupaten Luwu', 28),
(245, 'Kabupaten Luwu Timur', 28),
(246, 'Kabupaten Luwu Utara', 28),
(247, 'Kabupaten Madiun', 11),
(248, 'Kota Madiun', 11),
(249, 'Kabupaten Magelang', 10),
(250, 'Kota Magelang', 10),
(251, 'Kabupaten Magetan', 11),
(252, 'Kabupaten Majalengka', 9),
(253, 'Kabupaten Majene', 27),
(254, 'Kota Makassar', 28),
(255, 'Kabupaten Malang', 11),
(256, 'Kota Malang', 11),
(257, 'Kabupaten Malinau', 16),
(258, 'Kabupaten Maluku Barat Daya', 19),
(259, 'Kabupaten Maluku Tengah', 19),
(260, 'Kabupaten Maluku Tenggara', 19),
(261, 'Kabupaten Maluku Tenggara Barat', 19),
(262, 'Kabupaten Mamasa', 27),
(263, 'Kabupaten Mamberamo Raya', 24),
(264, 'Kabupaten Mamberamo Tengah', 24),
(265, 'Kabupaten Mamuju', 27),
(266, 'Kabupaten Mamuju Utara', 27),
(267, 'Kota Manado', 31),
(268, 'Kabupaten Mandailing Natal', 34),
(269, 'Kabupaten Manggarai', 23),
(270, 'Kabupaten Manggarai Barat', 23),
(271, 'Kabupaten Manggarai Timur', 23),
(272, 'Kabupaten Manokwari', 25),
(273, 'Kabupaten Manokwari Selatan', 25),
(274, 'Kabupaten Mappi', 24),
(275, 'Kabupaten Maros', 28),
(276, 'Kota Mataram', 22),
(277, 'Kabupaten Maybrat', 25),
(278, 'Kota Medan', 34),
(279, 'Kabupaten Melawi', 12),
(280, 'Kabupaten Merangin', 8),
(281, 'Kabupaten Merauke', 24),
(282, 'Kabupaten Mesuji', 18),
(283, 'Kota Metro', 18),
(284, 'Kabupaten Mimika', 24),
(285, 'Kabupaten Minahasa', 31),
(286, 'Kabupaten Minahasa Selatan', 31),
(287, 'Kabupaten Minahasa Tenggara', 31),
(288, 'Kabupaten Minahasa Utara', 31),
(289, 'Kabupaten Mojokerto', 11),
(290, 'Kota Mojokerto', 11),
(291, 'Kabupaten Morowali', 29),
(292, 'Kabupaten Muara Enim', 33),
(293, 'Kabupaten Muaro Jambi', 8),
(294, 'Kabupaten Muko Muko', 4),
(295, 'Kabupaten Muna', 30),
(296, 'Kabupaten Murung Raya', 14),
(297, 'Kabupaten Musi Banyuasin', 33),
(298, 'Kabupaten Musi Rawas', 33),
(299, 'Kabupaten Nabire', 24),
(300, 'Kabupaten Nagan Raya', 21),
(301, 'Kabupaten Nagekeo', 23),
(302, 'Kabupaten Natuna', 17),
(303, 'Kabupaten Nduga', 24),
(304, 'Kabupaten Ngada', 23),
(305, 'Kabupaten Nganjuk', 11),
(306, 'Kabupaten Ngawi', 11),
(307, 'Kabupaten Nias', 34),
(308, 'Kabupaten Nias Barat', 34),
(309, 'Kabupaten Nias Selatan', 34),
(310, 'Kabupaten Nias Utara', 34),
(311, 'Kabupaten Nunukan', 16),
(312, 'Kabupaten Ogan Ilir', 33),
(313, 'Kabupaten Ogan Komering Ilir', 33),
(314, 'Kabupaten Ogan Komering Ulu', 33),
(315, 'Kabupaten Ogan Komering Ulu Selatan', 33),
(316, 'Kabupaten Ogan Komering Ulu Timur', 33),
(317, 'Kabupaten Pacitan', 11),
(318, 'Kota Padang', 32),
(319, 'Kabupaten Padang Lawas', 34),
(320, 'Kabupaten Padang Lawas Utara', 34),
(321, 'Kota Padang Panjang', 32),
(322, 'Kabupaten Padang Pariaman', 32),
(323, 'Kota Padang Sidempuan', 34),
(324, 'Kota Pagar Alam', 33),
(325, 'Kabupaten Pakpak Bharat', 34),
(326, 'Kota Palangka Raya', 14),
(327, 'Kota Palembang', 33),
(328, 'Kota Palopo', 28),
(329, 'Kota Palu', 29),
(330, 'Kabupaten Pamekasan', 11),
(331, 'Kabupaten Pandeglang', 3),
(332, 'Kabupaten Pangandaran', 9),
(333, 'Kabupaten Pangkajene Kepulauan', 28),
(334, 'Kota Pangkal Pinang', 2),
(335, 'Kabupaten Paniai', 24),
(336, 'Kota Parepare', 28),
(337, 'Kota Pariaman', 32),
(338, 'Kabupaten Parigi Moutong', 29),
(339, 'Kabupaten Pasaman', 32),
(340, 'Kabupaten Pasaman Barat', 32),
(341, 'Kabupaten Paser', 15),
(342, 'Kabupaten Pasuruan', 11),
(343, 'Kota Pasuruan', 11),
(344, 'Kabupaten Pati', 10),
(345, 'Kota Payakumbuh', 32),
(346, 'Kabupaten Pegunungan Arfak', 25),
(347, 'Kabupaten Pegunungan Bintang', 24),
(348, 'Kabupaten Pekalongan', 10),
(349, 'Kota Pekalongan', 10),
(350, 'Kota Pekanbaru', 26),
(351, 'Kabupaten Pelalawan', 26),
(352, 'Kabupaten Pemalang', 10),
(353, 'Kota Pematang Siantar', 34),
(354, 'Kabupaten Penajam Paser Utara', 15),
(355, 'Kabupaten Pesawaran', 18),
(356, 'Kabupaten Pesisir Barat', 18),
(357, 'Kabupaten Pesisir Selatan', 32),
(358, 'Kabupaten Pidie', 21),
(359, 'Kabupaten Pidie Jaya', 21),
(360, 'Kabupaten Pinrang', 28),
(361, 'Kabupaten Pohuwato', 7),
(362, 'Kabupaten Polewali Mandar', 27),
(363, 'Kabupaten Ponorogo', 11),
(364, 'Kabupaten Pontianak', 12),
(365, 'Kota Pontianak', 12),
(366, 'Kabupaten Poso', 29),
(367, 'Kota Prabumulih', 33),
(368, 'Kabupaten Pringsewu', 18),
(369, 'Kabupaten Probolinggo', 11),
(370, 'Kota Probolinggo', 11),
(371, 'Kabupaten Pulang Pisau', 14),
(372, 'Kabupaten Pulau Morotai', 20),
(373, 'Kabupaten Puncak', 24),
(374, 'Kabupaten Puncak Jaya', 24),
(375, 'Kabupaten Purbalingga', 10),
(376, 'Kabupaten Purwakarta', 9),
(377, 'Kabupaten Purworejo', 10),
(378, 'Kabupaten Raja Ampat', 25),
(379, 'Kabupaten Rejang Lebong', 4),
(380, 'Kabupaten Rembang', 10),
(381, 'Kabupaten Rokan Hilir', 26),
(382, 'Kabupaten Rokan Hulu', 26),
(383, 'Kabupaten Rote Ndao', 23),
(384, 'Kota Sabang', 21),
(385, 'Kabupaten Sabu Raijua', 23),
(386, 'Kota Salatiga', 10),
(387, 'Kota Samarinda', 15),
(388, 'Kabupaten Sambas', 12),
(389, 'Kabupaten Samosir', 34),
(390, 'Kabupaten Sampang', 11),
(391, 'Kabupaten Sanggau', 12),
(392, 'Kabupaten Sarmi', 24),
(393, 'Kabupaten Sarolangun', 8),
(394, 'Kota Sawah Lunto', 32),
(395, 'Kabupaten Sekadau', 12),
(396, 'Kabupaten Selayar (Kepulauan Selayar)', 28),
(397, 'Kabupaten Seluma', 4),
(398, 'Kabupaten Semarang', 10),
(399, 'Kota Semarang', 10),
(400, 'Kabupaten Seram Bagian Barat', 19),
(401, 'Kabupaten Seram Bagian Timur', 19),
(402, 'Kabupaten Serang', 3),
(403, 'Kota Serang', 3),
(404, 'Kabupaten Serdang Bedagai', 34),
(405, 'Kabupaten Seruyan', 14),
(406, 'Kabupaten Siak', 26),
(407, 'Kota Sibolga', 34),
(408, 'Kabupaten Sidenreng Rappang/Rapang', 28),
(409, 'Kabupaten Sidoarjo', 11),
(410, 'Kabupaten Sigi', 29),
(411, 'Kabupaten Sijunjung (Sawah Lunto Sijunjung)', 32),
(412, 'Kabupaten Sikka', 23),
(413, 'Kabupaten Simalungun', 34),
(414, 'Kabupaten Simeulue', 21),
(415, 'Kota Singkawang', 12),
(416, 'Kabupaten Sinjai', 28),
(417, 'Kabupaten Sintang', 12),
(418, 'Kabupaten Situbondo', 11),
(419, 'Kabupaten Sleman', 5),
(420, 'Kabupaten Solok', 32),
(421, 'Kota Solok', 32),
(422, 'Kabupaten Solok Selatan', 32),
(423, 'Kabupaten Soppeng', 28),
(424, 'Kabupaten Sorong', 25),
(425, 'Kota Sorong', 25),
(426, 'Kabupaten Sorong Selatan', 25),
(427, 'Kabupaten Sragen', 10),
(428, 'Kabupaten Subang', 9),
(429, 'Kota Subulussalam', 21),
(430, 'Kabupaten Sukabumi', 9),
(431, 'Kota Sukabumi', 9),
(432, 'Kabupaten Sukamara', 14),
(433, 'Kabupaten Sukoharjo', 10),
(434, 'Kabupaten Sumba Barat', 23),
(435, 'Kabupaten Sumba Barat Daya', 23),
(436, 'Kabupaten Sumba Tengah', 23),
(437, 'Kabupaten Sumba Timur', 23),
(438, 'Kabupaten Sumbawa', 22),
(439, 'Kabupaten Sumbawa Barat', 22),
(440, 'Kabupaten Sumedang', 9),
(441, 'Kabupaten Sumenep', 11),
(442, 'Kota Sungaipenuh', 8),
(443, 'Kabupaten Supiori', 24),
(444, 'Kota Surabaya', 11),
(445, 'Kota Surakarta (Solo)', 10),
(446, 'Kabupaten Tabalong', 13),
(447, 'Kabupaten Tabanan', 1),
(448, 'Kabupaten Takalar', 28),
(449, 'Kabupaten Tambrauw', 25),
(450, 'Kabupaten Tana Tidung', 16),
(451, 'Kabupaten Tana Toraja', 28),
(452, 'Kabupaten Tanah Bumbu', 13),
(453, 'Kabupaten Tanah Datar', 32),
(454, 'Kabupaten Tanah Laut', 13),
(455, 'Kabupaten Tangerang', 3),
(456, 'Kota Tangerang', 3),
(457, 'Kota Tangerang Selatan', 3),
(458, 'Kabupaten Tanggamus', 18),
(459, 'Kota Tanjung Balai', 34),
(460, 'Kabupaten Tanjung Jabung Barat', 8),
(461, 'Kabupaten Tanjung Jabung Timur', 8),
(462, 'Kota Tanjung Pinang', 17),
(463, 'Kabupaten Tapanuli Selatan', 34),
(464, 'Kabupaten Tapanuli Tengah', 34),
(465, 'Kabupaten Tapanuli Utara', 34),
(466, 'Kabupaten Tapin', 13),
(467, 'Kota Tarakan', 16),
(468, 'Kabupaten Tasikmalaya', 9),
(469, 'Kota Tasikmalaya', 9),
(470, 'Kota Tebing Tinggi', 34),
(471, 'Kabupaten Tebo', 8),
(472, 'Kabupaten Tegal', 10),
(473, 'Kota Tegal', 10),
(474, 'Kabupaten Teluk Bintuni', 25),
(475, 'Kabupaten Teluk Wondama', 25),
(476, 'Kabupaten Temanggung', 10),
(477, 'Kota Ternate', 20),
(478, 'Kota Tidore Kepulauan', 20),
(479, 'Kabupaten Timor Tengah Selatan', 23),
(480, 'Kabupaten Timor Tengah Utara', 23),
(481, 'Kabupaten Toba Samosir', 34),
(482, 'Kabupaten Tojo Una-Una', 29),
(483, 'Kabupaten Toli-Toli', 29),
(484, 'Kabupaten Tolikara', 24),
(485, 'Kota Tomohon', 31),
(486, 'Kabupaten Toraja Utara', 28),
(487, 'Kabupaten Trenggalek', 11),
(488, 'Kota Tual', 19),
(489, 'Kabupaten Tuban', 11),
(490, 'Kabupaten Tulang Bawang', 18),
(491, 'Kabupaten Tulang Bawang Barat', 18),
(492, 'Kabupaten Tulungagung', 11),
(493, 'Kabupaten Wajo', 28),
(494, 'Kabupaten Wakatobi', 30),
(495, 'Kabupaten Waropen', 24),
(496, 'Kabupaten Way Kanan', 18),
(497, 'Kabupaten Wonogiri', 10),
(498, 'Kabupaten Wonosobo', 10),
(499, 'Kabupaten Yahukimo', 24),
(500, 'Kabupaten Yalimo', 24),
(501, 'Kota Yogyakarta', 5);

-- --------------------------------------------------------

--
-- Table structure for table `ci_sessions`
--

CREATE TABLE `ci_sessions` (
  `id` varchar(128) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `timestamp` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `data` blob NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `ci_sessions`
--

INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES
('c6s6o1onttmpartbk931nqfjhil49atb', '::1', 1702905898, 0x5f5f63695f6c6173745f726567656e65726174657c693a313730323930353632313b6b6579776f72647c733a303a22223b6b6579776f7264737c733a343a2264657363223b736f72745f62797c733a31333a2263616e5f6170705f6461746532223b736f72745f747970657c733a343a2264657363223b7573655f70707c733a36323a22687474703a2f2f6c6f63616c686f73742f69637270656469677265652f75706c6f6164732f75736572732f757365725f313638373638353532332e706e67223b646174657c733a303a22223b7573655f757365726e616d657c733a353a2261646d696e223b7573655f69647c733a313a2232223b7573655f747970655f69647c733a313a2230223b757365726e616d657c733a353a226c696d616e223b6d656d5f69647c733a323a223133223b6d656d5f6e616d657c733a31323a224c494d414e2049524157414e223b6d656d5f747970657c733a313a2232223b6d656d5f70707c733a36363a22687474703a2f2f6c6f63616c686f73742f69637270656469677265652f75706c6f6164732f6d656d626572732f6d656d6265725f313638373730343030382e706e67223b6e6f7469665f636f756e747c733a333a22313330223b),
('ndbu1modrdkrodaq4vnnarcg9qbb385n', '::1', 1702899023, 0x5f5f63695f6c6173745f726567656e65726174657c693a313730323839383732383b6b6579776f72647c733a303a22223b6b6579776f7264737c733a303a22223b736f72745f62797c733a31333a2263616e5f6170705f6461746532223b736f72745f747970657c733a343a2264657363223b7573655f70707c733a36323a22687474703a2f2f6c6f63616c686f73742f69637270656469677265652f75706c6f6164732f75736572732f757365725f313638373638353532332e706e67223b646174657c733a303a22223b7573655f757365726e616d657c733a353a2261646d696e223b7573655f69647c733a313a2232223b7573655f747970655f69647c733a313a2230223b757365726e616d657c733a353a226c696d616e223b6d656d5f69647c733a323a223133223b6d656d5f6e616d657c733a31323a224c494d414e2049524157414e223b6d656d5f747970657c733a313a2231223b6d656d5f70707c733a36363a22687474703a2f2f6c6f63616c686f73742f69637270656469677265652f75706c6f6164732f6d656d626572732f6d656d6265725f313638373730343030382e706e67223b6e6f7469665f636f756e747c733a333a22313330223b),
('56c8tfkl642gp68c8dppkej3ek9s2msf', '::1', 1702906234, 0x5f5f63695f6c6173745f726567656e65726174657c693a313730323930353935303b6b6579776f72647c733a303a22223b6b6579776f7264737c733a343a2264657363223b736f72745f62797c733a31333a2263616e5f6170705f6461746532223b736f72745f747970657c733a343a2264657363223b7573655f70707c733a36323a22687474703a2f2f6c6f63616c686f73742f69637270656469677265652f75706c6f6164732f75736572732f757365725f313638373638353532332e706e67223b646174657c733a303a22223b7573655f757365726e616d657c733a353a2261646d696e223b7573655f69647c733a313a2232223b7573655f747970655f69647c733a313a2230223b757365726e616d657c733a353a226c696d616e223b6d656d5f69647c733a323a223133223b6d656d5f6e616d657c733a31323a224c494d414e2049524157414e223b6d656d5f747970657c733a313a2232223b6d656d5f70707c733a36363a22687474703a2f2f6c6f63616c686f73742f69637270656469677265652f75706c6f6164732f6d656d626572732f6d656d6265725f313638373730343030382e706e67223b6e6f7469665f636f756e747c733a333a22313330223b),
('de399ova42uois2v6r0h8c0gtinble10', '::1', 1702906485, 0x5f5f63695f6c6173745f726567656e65726174657c693a313730323930363235383b6b6579776f72647c733a303a22223b6b6579776f7264737c733a303a22223b736f72745f62797c733a31323a22637265617465645f64617465223b736f72745f747970657c733a343a2264657363223b7573655f70707c733a36323a22687474703a2f2f6c6f63616c686f73742f69637270656469677265652f75706c6f6164732f75736572732f757365725f313638373638353532332e706e67223b646174657c733a303a22223b7573655f757365726e616d657c733a353a2261646d696e223b7573655f69647c733a313a2232223b7573655f747970655f69647c733a313a2230223b),
('a606octd48kekuvc2m6mgq63s4tc8heo', '::1', 1702907013, 0x5f5f63695f6c6173745f726567656e65726174657c693a313730323930363731333b6b6579776f72647c733a303a22223b6b6579776f7264737c733a303a22223b736f72745f62797c733a31333a2263616e5f6170705f6461746532223b736f72745f747970657c733a343a2264657363223b7573655f70707c733a36323a22687474703a2f2f6c6f63616c686f73742f69637270656469677265652f75706c6f6164732f75736572732f757365725f313638373638353532332e706e67223b646174657c733a303a22223b7573655f757365726e616d657c733a353a2261646d696e223b7573655f69647c733a313a2232223b7573655f747970655f69647c733a313a2230223b757365726e616d657c733a343a227468656f223b6d656d5f69647c733a323a223339223b6d656d5f6e616d657c733a31333a225448454f2043414d5042454c4c223b6d656d5f747970657c733a313a2231223b6d656d5f70707c733a36363a22687474703a2f2f6c6f63616c686f73742f69637270656469677265652f75706c6f6164732f6d656d626572732f6d656d6265725f313730323930363731332e706e67223b6e6f7469665f636f756e747c733a313a2231223b),
('r56ufh33lthv7s73ijprgsghk82djhqa', '::1', 1702907284, 0x5f5f63695f6c6173745f726567656e65726174657c693a313730323930373031343b6b6579776f72647c733a303a22223b6b6579776f7264737c733a303a22223b736f72745f62797c733a31333a2263616e5f6170705f6461746532223b736f72745f747970657c733a343a2264657363223b7573655f70707c733a36323a22687474703a2f2f6c6f63616c686f73742f69637270656469677265652f75706c6f6164732f75736572732f757365725f313638373638353532332e706e67223b646174657c733a303a22223b7573655f757365726e616d657c733a353a2261646d696e223b7573655f69647c733a313a2232223b7573655f747970655f69647c733a313a2230223b757365726e616d657c733a343a227468656f223b6d656d5f69647c733a323a223339223b6d656d5f6e616d657c733a31333a225448454f2043414d5042454c4c223b6d656d5f747970657c733a313a2231223b6d656d5f70707c733a36363a22687474703a2f2f6c6f63616c686f73742f69637270656469677265652f75706c6f6164732f6d656d626572732f6d656d6265725f313730323930363731332e706e67223b6e6f7469665f636f756e747c733a313a2231223b),
('e0cle7h2aprdf0h2hsr6u48rsjm240kl', '::1', 1702907519, 0x5f5f63695f6c6173745f726567656e65726174657c693a313730323930373334343b6b6579776f72647c733a303a22223b6b6579776f7264737c733a303a22223b736f72745f62797c733a31333a2263616e5f6170705f6461746532223b736f72745f747970657c733a343a2264657363223b7573655f70707c733a36323a22687474703a2f2f6c6f63616c686f73742f69637270656469677265652f75706c6f6164732f75736572732f757365725f313638373638353532332e706e67223b646174657c733a303a22223b7573655f757365726e616d657c733a353a2261646d696e223b7573655f69647c733a313a2232223b7573655f747970655f69647c733a313a2230223b757365726e616d657c733a353a226c696d616e223b6d656d5f69647c733a323a223133223b6d656d5f6e616d657c733a31323a224c494d414e2049524157414e223b6d656d5f747970657c733a313a2231223b6d656d5f70707c733a36363a22687474703a2f2f6c6f63616c686f73742f69637270656469677265652f75706c6f6164732f6d656d626572732f6d656d6265725f313638373730343030382e706e67223b6e6f7469665f636f756e747c733a333a22313435223b),
('fed3e6c46fk4o87gv44svrrpejg8vcvd', '::1', 1702907993, 0x5f5f63695f6c6173745f726567656e65726174657c693a313730323930373639333b6b6579776f72647c733a303a22223b6b6579776f7264737c733a303a22223b736f72745f62797c733a31333a2263616e5f6170705f6461746532223b736f72745f747970657c733a343a2264657363223b7573655f70707c733a36323a22687474703a2f2f6c6f63616c686f73742f69637270656469677265652f75706c6f6164732f75736572732f757365725f313638373638353532332e706e67223b646174657c733a303a22223b7573655f757365726e616d657c733a353a2261646d696e223b7573655f69647c733a313a2232223b7573655f747970655f69647c733a313a2230223b757365726e616d657c733a343a227468656f223b6d656d5f69647c733a323a223339223b6d656d5f6e616d657c733a31333a225448454f2043414d5042454c4c223b6d656d5f747970657c733a313a2231223b6d656d5f70707c733a36363a22687474703a2f2f6c6f63616c686f73742f69637270656469677265652f75706c6f6164732f6d656d626572732f6d656d6265725f313730323930363731332e706e67223b6e6f7469665f636f756e747c733a313a2235223b),
('75js7mrj8nvc94jogdjkhh3252gb44r5', '::1', 1702908129, 0x5f5f63695f6c6173745f726567656e65726174657c693a313730323930373939353b6b6579776f72647c733a303a22223b6b6579776f7264737c733a303a22223b736f72745f62797c733a31333a2263616e5f6170705f6461746532223b736f72745f747970657c733a343a2264657363223b7573655f70707c733a35303a22687474703a2f2f6c6f63616c686f73742f69637270656469677265652f6173736574732f696d672f6176617461722e6a7067223b646174657c733a303a22223b),
('478d979jp3sb65un21kt1ulat0l3mu57', '::1', 1702905576, 0x5f5f63695f6c6173745f726567656e65726174657c693a313730323930353330373b6b6579776f72647c733a303a22223b6b6579776f7264737c733a343a2264657363223b736f72745f62797c733a31333a2263616e5f6170705f6461746532223b736f72745f747970657c733a343a2264657363223b7573655f70707c733a36323a22687474703a2f2f6c6f63616c686f73742f69637270656469677265652f75706c6f6164732f75736572732f757365725f313638373638353532332e706e67223b646174657c733a303a22223b7573655f757365726e616d657c733a353a2261646d696e223b7573655f69647c733a313a2232223b7573655f747970655f69647c733a313a2230223b757365726e616d657c733a353a226c696d616e223b6d656d5f69647c733a323a223133223b6d656d5f6e616d657c733a31323a224c494d414e2049524157414e223b6d656d5f747970657c733a313a2232223b6d656d5f70707c733a36363a22687474703a2f2f6c6f63616c686f73742f69637270656469677265652f75706c6f6164732f6d656d626572732f6d656d6265725f313638373730343030382e706e67223b6e6f7469665f636f756e747c733a333a22313330223b),
('s7u0uen1dl9bpmv8biafjt41at1pnv9u', '::1', 1702905202, 0x5f5f63695f6c6173745f726567656e65726174657c693a313730323930343936343b6b6579776f72647c733a303a22223b6b6579776f7264737c733a343a2264657363223b736f72745f62797c733a31333a2263616e5f6170705f6461746532223b736f72745f747970657c733a343a2264657363223b7573655f70707c733a36323a22687474703a2f2f6c6f63616c686f73742f69637270656469677265652f75706c6f6164732f75736572732f757365725f313638373638353532332e706e67223b646174657c733a303a22223b7573655f757365726e616d657c733a353a2261646d696e223b7573655f69647c733a313a2232223b7573655f747970655f69647c733a313a2230223b757365726e616d657c733a353a226c696d616e223b6d656d5f69647c733a323a223133223b6d656d5f6e616d657c733a31323a224c494d414e2049524157414e223b6d656d5f747970657c733a313a2232223b6d656d5f70707c733a36363a22687474703a2f2f6c6f63616c686f73742f69637270656469677265652f75706c6f6164732f6d656d626572732f6d656d6265725f313638373730343030382e706e67223b6e6f7469665f636f756e747c733a333a22313330223b),
('valo205cku74kte3c67q0mqdsca7i729', '::1', 1702904635, 0x5f5f63695f6c6173745f726567656e65726174657c693a313730323930343333383b6b6579776f72647c733a303a22223b6b6579776f7264737c733a303a22223b736f72745f62797c733a31333a2263616e5f6170705f6461746532223b736f72745f747970657c733a343a2264657363223b7573655f70707c733a36323a22687474703a2f2f6c6f63616c686f73742f69637270656469677265652f75706c6f6164732f75736572732f757365725f313638373638353532332e706e67223b646174657c733a303a22223b7573655f757365726e616d657c733a353a2261646d696e223b7573655f69647c733a313a2232223b7573655f747970655f69647c733a313a2230223b757365726e616d657c733a353a226c696d616e223b6d656d5f69647c733a323a223133223b6d656d5f6e616d657c733a31323a224c494d414e2049524157414e223b6d656d5f747970657c733a313a2231223b6d656d5f70707c733a36363a22687474703a2f2f6c6f63616c686f73742f69637270656469677265652f75706c6f6164732f6d656d626572732f6d656d6265725f313638373730343030382e706e67223b6e6f7469665f636f756e747c733a333a22313330223b),
('6u5u7jbpn00o6umne2op0h3783sontsb', '::1', 1702902912, 0x5f5f63695f6c6173745f726567656e65726174657c693a313730323930323634343b6b6579776f72647c733a303a22223b6b6579776f7264737c733a303a22223b736f72745f62797c733a31333a2263616e5f6170705f6461746532223b736f72745f747970657c733a343a2264657363223b7573655f70707c733a36323a22687474703a2f2f6c6f63616c686f73742f69637270656469677265652f75706c6f6164732f75736572732f757365725f313638373638353532332e706e67223b646174657c733a303a22223b7573655f757365726e616d657c733a353a2261646d696e223b7573655f69647c733a313a2232223b7573655f747970655f69647c733a313a2230223b757365726e616d657c733a353a226c696d616e223b6d656d5f69647c733a323a223133223b6d656d5f6e616d657c733a31323a224c494d414e2049524157414e223b6d656d5f747970657c733a313a2231223b6d656d5f70707c733a36363a22687474703a2f2f6c6f63616c686f73742f69637270656469677265652f75706c6f6164732f6d656d626572732f6d656d6265725f313638373730343030382e706e67223b6e6f7469665f636f756e747c733a333a22313330223b),
('o20bdhcl1u1rb4cjefpgsj6i6mueahk1', '::1', 1702904932, 0x5f5f63695f6c6173745f726567656e65726174657c693a313730323930343634303b6b6579776f72647c733a303a22223b6b6579776f7264737c733a343a2264657363223b736f72745f62797c733a31333a2263616e5f6170705f6461746532223b736f72745f747970657c733a343a2264657363223b7573655f70707c733a36323a22687474703a2f2f6c6f63616c686f73742f69637270656469677265652f75706c6f6164732f75736572732f757365725f313638373638353532332e706e67223b646174657c733a303a22223b7573655f757365726e616d657c733a353a2261646d696e223b7573655f69647c733a313a2232223b7573655f747970655f69647c733a313a2230223b757365726e616d657c733a353a226c696d616e223b6d656d5f69647c733a323a223133223b6d656d5f6e616d657c733a31323a224c494d414e2049524157414e223b6d656d5f747970657c733a313a2232223b6d656d5f70707c733a36363a22687474703a2f2f6c6f63616c686f73742f69637270656469677265652f75706c6f6164732f6d656d626572732f6d656d6265725f313638373730343030382e706e67223b6e6f7469665f636f756e747c733a333a22313330223b),
('e907g893cn0blccd86dtfaa4bmc32d3d', '::1', 1702902634, 0x5f5f63695f6c6173745f726567656e65726174657c693a313730323930323334323b6b6579776f72647c733a303a22223b6b6579776f7264737c733a303a22223b736f72745f62797c733a31333a2263616e5f6170705f6461746532223b736f72745f747970657c733a343a2264657363223b7573655f70707c733a36323a22687474703a2f2f6c6f63616c686f73742f69637270656469677265652f75706c6f6164732f75736572732f757365725f313638373638353532332e706e67223b646174657c733a303a22223b7573655f757365726e616d657c733a353a2261646d696e223b7573655f69647c733a313a2232223b7573655f747970655f69647c733a313a2230223b757365726e616d657c733a353a226c696d616e223b6d656d5f69647c733a323a223133223b6d656d5f6e616d657c733a31323a224c494d414e2049524157414e223b6d656d5f747970657c733a313a2231223b6d656d5f70707c733a36363a22687474703a2f2f6c6f63616c686f73742f69637270656469677265652f75706c6f6164732f6d656d626572732f6d656d6265725f313638373730343030382e706e67223b6e6f7469665f636f756e747c733a333a22313330223b),
('dpoll1kto5ob9fts3k1segqimcorv17h', '::1', 1702902338, 0x5f5f63695f6c6173745f726567656e65726174657c693a313730323930323033393b6b6579776f72647c733a303a22223b6b6579776f7264737c733a303a22223b736f72745f62797c733a31333a2263616e5f6170705f6461746532223b736f72745f747970657c733a343a2264657363223b7573655f70707c733a36323a22687474703a2f2f6c6f63616c686f73742f69637270656469677265652f75706c6f6164732f75736572732f757365725f313638373638353532332e706e67223b646174657c733a303a22223b7573655f757365726e616d657c733a353a2261646d696e223b7573655f69647c733a313a2232223b7573655f747970655f69647c733a313a2230223b757365726e616d657c733a353a226c696d616e223b6d656d5f69647c733a323a223133223b6d656d5f6e616d657c733a31323a224c494d414e2049524157414e223b6d656d5f747970657c733a313a2231223b6d656d5f70707c733a36363a22687474703a2f2f6c6f63616c686f73742f69637270656469677265652f75706c6f6164732f6d656d626572732f6d656d6265725f313638373730343030382e706e67223b6e6f7469665f636f756e747c733a333a22313330223b),
('h45fjvhoahg2k7hvj54rto5vasu68cb8', '::1', 1702901838, 0x5f5f63695f6c6173745f726567656e65726174657c693a313730323930313732383b6b6579776f72647c733a303a22223b6b6579776f7264737c733a303a22223b736f72745f62797c733a31333a2263616e5f6170705f6461746532223b736f72745f747970657c733a343a2264657363223b7573655f70707c733a36323a22687474703a2f2f6c6f63616c686f73742f69637270656469677265652f75706c6f6164732f75736572732f757365725f313638373638353532332e706e67223b646174657c733a303a22223b7573655f757365726e616d657c733a353a2261646d696e223b7573655f69647c733a313a2232223b7573655f747970655f69647c733a313a2230223b757365726e616d657c733a353a226c696d616e223b6d656d5f69647c733a323a223133223b6d656d5f6e616d657c733a31323a224c494d414e2049524157414e223b6d656d5f747970657c733a313a2231223b6d656d5f70707c733a36363a22687474703a2f2f6c6f63616c686f73742f69637270656469677265652f75706c6f6164732f6d656d626572732f6d656d6265725f313638373730343030382e706e67223b6e6f7469665f636f756e747c733a333a22313330223b),
('g6a2mee3vdkpvj3bf3sp5jaq4ce02tla', '::1', 1702901695, 0x5f5f63695f6c6173745f726567656e65726174657c693a313730323930313431373b6b6579776f72647c733a303a22223b6b6579776f7264737c733a303a22223b736f72745f62797c733a31333a2263616e5f6170705f6461746532223b736f72745f747970657c733a343a2264657363223b7573655f70707c733a36323a22687474703a2f2f6c6f63616c686f73742f69637270656469677265652f75706c6f6164732f75736572732f757365725f313638373638353532332e706e67223b646174657c733a303a22223b7573655f757365726e616d657c733a353a2261646d696e223b7573655f69647c733a313a2232223b7573655f747970655f69647c733a313a2230223b757365726e616d657c733a353a226c696d616e223b6d656d5f69647c733a323a223133223b6d656d5f6e616d657c733a31323a224c494d414e2049524157414e223b6d656d5f747970657c733a313a2231223b6d656d5f70707c733a36363a22687474703a2f2f6c6f63616c686f73742f69637270656469677265652f75706c6f6164732f6d656d626572732f6d656d6265725f313638373730343030382e706e67223b6e6f7469665f636f756e747c733a333a22313330223b),
('2jn13ds5gpnkmhot1q2offr6o08uqfn0', '::1', 1702901362, 0x5f5f63695f6c6173745f726567656e65726174657c693a313730323930313039343b6b6579776f72647c733a303a22223b6b6579776f7264737c733a303a22223b736f72745f62797c733a31333a2263616e5f6170705f6461746532223b736f72745f747970657c733a343a2264657363223b7573655f70707c733a36323a22687474703a2f2f6c6f63616c686f73742f69637270656469677265652f75706c6f6164732f75736572732f757365725f313638373638353532332e706e67223b646174657c733a303a22223b7573655f757365726e616d657c733a353a2261646d696e223b7573655f69647c733a313a2232223b7573655f747970655f69647c733a313a2230223b757365726e616d657c733a353a226c696d616e223b6d656d5f69647c733a323a223133223b6d656d5f6e616d657c733a31323a224c494d414e2049524157414e223b6d656d5f747970657c733a313a2231223b6d656d5f70707c733a36363a22687474703a2f2f6c6f63616c686f73742f69637270656469677265652f75706c6f6164732f6d656d626572732f6d656d6265725f313638373730343030382e706e67223b6e6f7469665f636f756e747c733a333a22313330223b),
('94fdo7fena8jsc47ngsv7el6ugh3akbr', '::1', 1702901093, 0x5f5f63695f6c6173745f726567656e65726174657c693a313730323930303739333b6b6579776f72647c733a303a22223b6b6579776f7264737c733a303a22223b736f72745f62797c733a31333a2263616e5f6170705f6461746532223b736f72745f747970657c733a343a2264657363223b7573655f70707c733a36323a22687474703a2f2f6c6f63616c686f73742f69637270656469677265652f75706c6f6164732f75736572732f757365725f313638373638353532332e706e67223b646174657c733a303a22223b7573655f757365726e616d657c733a353a2261646d696e223b7573655f69647c733a313a2232223b7573655f747970655f69647c733a313a2230223b757365726e616d657c733a353a226c696d616e223b6d656d5f69647c733a323a223133223b6d656d5f6e616d657c733a31323a224c494d414e2049524157414e223b6d656d5f747970657c733a313a2231223b6d656d5f70707c733a36363a22687474703a2f2f6c6f63616c686f73742f69637270656469677265652f75706c6f6164732f6d656d626572732f6d656d6265725f313638373730343030382e706e67223b6e6f7469665f636f756e747c733a333a22313330223b),
('470sbcl24pvpvepakgtn4blcfpiuj7gs', '::1', 1702900677, 0x5f5f63695f6c6173745f726567656e65726174657c693a313730323930303434363b6b6579776f72647c733a303a22223b6b6579776f7264737c733a303a22223b736f72745f62797c733a31333a2263616e5f6170705f6461746532223b736f72745f747970657c733a343a2264657363223b7573655f70707c733a36323a22687474703a2f2f6c6f63616c686f73742f69637270656469677265652f75706c6f6164732f75736572732f757365725f313638373638353532332e706e67223b646174657c733a303a22223b7573655f757365726e616d657c733a353a2261646d696e223b7573655f69647c733a313a2232223b7573655f747970655f69647c733a313a2230223b757365726e616d657c733a353a226c696d616e223b6d656d5f69647c733a323a223133223b6d656d5f6e616d657c733a31323a224c494d414e2049524157414e223b6d656d5f747970657c733a313a2231223b6d656d5f70707c733a36363a22687474703a2f2f6c6f63616c686f73742f69637270656469677265652f75706c6f6164732f6d656d626572732f6d656d6265725f313638373730343030382e706e67223b6e6f7469665f636f756e747c733a333a22313330223b),
('an3p3a0adicc02f0g1npgj2jhq2o3khq', '::1', 1702900279, 0x5f5f63695f6c6173745f726567656e65726174657c693a313730323930303034363b6b6579776f72647c733a303a22223b6b6579776f7264737c733a303a22223b736f72745f62797c733a31333a2263616e5f6170705f6461746532223b736f72745f747970657c733a343a2264657363223b7573655f70707c733a36323a22687474703a2f2f6c6f63616c686f73742f69637270656469677265652f75706c6f6164732f75736572732f757365725f313638373638353532332e706e67223b646174657c733a303a22223b7573655f757365726e616d657c733a353a2261646d696e223b7573655f69647c733a313a2232223b7573655f747970655f69647c733a313a2230223b757365726e616d657c733a353a226c696d616e223b6d656d5f69647c733a323a223133223b6d656d5f6e616d657c733a31323a224c494d414e2049524157414e223b6d656d5f747970657c733a313a2231223b6d656d5f70707c733a36363a22687474703a2f2f6c6f63616c686f73742f69637270656469677265652f75706c6f6164732f6d656d626572732f6d656d6265725f313638373730343030382e706e67223b6e6f7469665f636f756e747c733a333a22313330223b),
('ujff1geefn4kd5ofcfdhqs1790f17tob', '::1', 1702899984, 0x5f5f63695f6c6173745f726567656e65726174657c693a313730323839393638373b6b6579776f72647c733a303a22223b6b6579776f7264737c733a303a22223b736f72745f62797c733a31333a2263616e5f6170705f6461746532223b736f72745f747970657c733a343a2264657363223b7573655f70707c733a36323a22687474703a2f2f6c6f63616c686f73742f69637270656469677265652f75706c6f6164732f75736572732f757365725f313638373638353532332e706e67223b646174657c733a303a22223b7573655f757365726e616d657c733a353a2261646d696e223b7573655f69647c733a313a2232223b7573655f747970655f69647c733a313a2230223b757365726e616d657c733a353a226c696d616e223b6d656d5f69647c733a323a223133223b6d656d5f6e616d657c733a31323a224c494d414e2049524157414e223b6d656d5f747970657c733a313a2231223b6d656d5f70707c733a36363a22687474703a2f2f6c6f63616c686f73742f69637270656469677265652f75706c6f6164732f6d656d626572732f6d656d6265725f313638373730343030382e706e67223b6e6f7469665f636f756e747c733a333a22313330223b),
('gnof46aagrqajnnb3iecobflnu1lp64j', '::1', 1702899642, 0x5f5f63695f6c6173745f726567656e65726174657c693a313730323839393335373b6b6579776f72647c733a303a22223b6b6579776f7264737c733a303a22223b736f72745f62797c733a31333a2263616e5f6170705f6461746532223b736f72745f747970657c733a343a2264657363223b7573655f70707c733a36323a22687474703a2f2f6c6f63616c686f73742f69637270656469677265652f75706c6f6164732f75736572732f757365725f313638373638353532332e706e67223b646174657c733a303a22223b7573655f757365726e616d657c733a353a2261646d696e223b7573655f69647c733a313a2232223b7573655f747970655f69647c733a313a2230223b757365726e616d657c733a353a226c696d616e223b6d656d5f69647c733a323a223133223b6d656d5f6e616d657c733a31323a224c494d414e2049524157414e223b6d656d5f747970657c733a313a2231223b6d656d5f70707c733a36363a22687474703a2f2f6c6f63616c686f73742f69637270656469677265652f75706c6f6164732f6d656d626572732f6d656d6265725f313638373730343030382e706e67223b6e6f7469665f636f756e747c733a333a22313330223b),
('55m3q9lmoajqa57agr6nl2i0hlkcph3q', '::1', 1702899281, 0x5f5f63695f6c6173745f726567656e65726174657c693a313730323839393034373b6b6579776f72647c733a303a22223b6b6579776f7264737c733a303a22223b736f72745f62797c733a31333a2263616e5f6170705f6461746532223b736f72745f747970657c733a343a2264657363223b7573655f70707c733a36323a22687474703a2f2f6c6f63616c686f73742f69637270656469677265652f75706c6f6164732f75736572732f757365725f313638373638353532332e706e67223b646174657c733a303a22223b7573655f757365726e616d657c733a353a2261646d696e223b7573655f69647c733a313a2232223b7573655f747970655f69647c733a313a2230223b757365726e616d657c733a353a226c696d616e223b6d656d5f69647c733a323a223133223b6d656d5f6e616d657c733a31323a224c494d414e2049524157414e223b6d656d5f747970657c733a313a2231223b6d656d5f70707c733a36363a22687474703a2f2f6c6f63616c686f73742f69637270656469677265652f75706c6f6164732f6d656d626572732f6d656d6265725f313638373730343030382e706e67223b6e6f7469665f636f756e747c733a333a22313330223b);

-- --------------------------------------------------------

--
-- Table structure for table `kennels`
--

CREATE TABLE `kennels` (
  `ken_id` int(11) NOT NULL,
  `ken_type_id` int(11) NOT NULL,
  `ken_name` varchar(50) NOT NULL,
  `ken_photo` text NOT NULL,
  `ken_stat` tinyint(4) NOT NULL DEFAULT 0,
  `ken_member_id` int(11) NOT NULL DEFAULT 0,
  `ken_app_user` int(4) NOT NULL,
  `ken_app_date` timestamp NULL DEFAULT NULL,
  `ken_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `ken_user` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `kennels`
--

INSERT INTO `kennels` (`ken_id`, `ken_type_id`, `ken_name`, `ken_photo`, `ken_stat`, `ken_member_id`, `ken_app_user`, `ken_app_date`, `ken_date`, `ken_user`) VALUES
(1, 0, '', '-', 1, 1, 1, NULL, '2023-02-10 05:51:55', 0),
(2, 2, 'GREAT POINT', 'kennel_1687686287.png', 1, 2, 2, '2023-06-25 09:50:55', '2023-06-25 09:50:55', 2),
(3, 0, '', '-', 1, 3, 0, NULL, '2023-06-25 10:37:12', 1),
(4, 1, 'NORTH SANTIAM', 'kennel_1687690048.png', 1, 4, 2, '2023-06-25 10:47:37', '2023-06-25 10:47:37', 2),
(5, 0, '', '-', 1, 5, 0, NULL, '2023-06-25 10:49:29', 1),
(6, 2, 'SCHAFFER RIDGE', 'kennel_1687690448.png', 1, 6, 2, '2023-06-25 10:54:15', '2023-06-25 10:54:15', 2),
(7, 0, '', '-', 1, 7, 0, NULL, '2023-06-25 11:06:05', 1),
(8, 0, '', '-', 1, 8, 0, NULL, '2023-06-25 11:07:59', 1),
(9, 0, '', '-', 1, 9, 0, NULL, '2023-06-25 11:08:55', 1),
(10, 1, 'EXPLOSIVE', 'kennel_1687691661.png', 1, 10, 2, '2023-06-25 11:14:29', '2023-06-25 11:14:29', 2),
(11, 2, 'PAW HOME', 'kennel_1687692156.png', 0, 11, 0, NULL, '2023-06-25 11:22:36', 1),
(12, 1, 'HEARTWOOD', 'kennel_1687692493.png', 0, 12, 0, NULL, '2023-06-25 11:28:13', 1),
(13, 2, 'WILDLINE', 'kennel_1687704008.png', 1, 13, 2, '2023-06-25 14:40:14', '2023-06-25 14:40:14', 2),
(14, 2, 'MAYFLOWER', 'kennel_1687705388.png', 1, 14, 2, '2023-06-25 15:03:13', '2023-06-25 15:03:13', 2),
(15, 1, 'LYNWOOD', 'kennel_1687733840.png', 1, 15, 2, '2023-06-25 22:57:28', '2023-06-25 22:57:28', 2),
(16, 2, 'GOBERT', 'kennel_1702378081.png', 1, 16, 2, '2023-12-12 10:48:45', '2023-12-12 12:32:41', 2),
(17, 2, 'GOBERS', 'kennel_1702387016.png', 1, 17, 2, '2023-12-12 13:17:12', '2023-12-12 13:32:04', 2),
(18, 0, '', '-', 1, 18, 0, NULL, '2023-12-12 13:49:23', 2),
(19, 2, 'JOSHUABELL', 'kennel_1702389037.png', 1, 19, 2, '2023-12-12 13:50:37', '2023-12-12 13:50:37', 2),
(20, 2, 'RANDY', 'kennel_1702447017.png', 0, 20, 0, NULL, '2023-12-13 05:56:57', 1),
(21, 2, 'RANDY', 'kennel_1702447340.png', 2, 21, 0, NULL, '2023-12-13 06:09:16', 2),
(22, 2, 'RANDY', 'kennel_1702447802.png', 1, 22, 2, '2023-12-13 06:14:51', '2023-12-13 06:14:51', 2),
(23, 2, 'RUDYN', 'kennel_1702448284.png', 1, 23, 2, '2023-12-13 06:18:11', '2023-12-13 06:18:11', 2),
(24, 0, '', '-', 1, 24, 0, NULL, '2023-12-13 06:19:21', 1),
(25, 0, '', '-', 1, 25, 0, NULL, '2023-12-13 06:21:27', 1),
(26, 2, 'REPEATLUDY', 'kennel_1702448590.png', 0, 26, 0, NULL, '2023-12-13 06:23:10', 1),
(27, 2, 'REPEATLUDY', 'kennel_1702448761.png', 0, 27, 0, NULL, '2023-12-13 06:26:01', 1),
(28, 2, 'REPEATLUDY', 'kennel_1702448823.png', 0, 28, 0, NULL, '2023-12-13 06:27:03', 1),
(29, 2, 'REPEATLUDY', 'kennel_1702449044.png', 0, 29, 0, NULL, '2023-12-13 06:30:44', 1),
(30, 2, 'REPEATLUDY', 'kennel_1702450460.png', 0, 30, 0, NULL, '2023-12-13 06:54:20', 1),
(31, 2, 'REPEATLUDY', 'kennel_1702451059.png', 0, 31, 0, NULL, '2023-12-13 07:04:19', 1),
(32, 2, 'WARAH', 'kennel_1702451759.png', 0, 32, 0, NULL, '2023-12-13 07:15:59', 1),
(33, 2, 'WARAH', 'kennel_1702451789.png', 1, 33, 2, '2023-12-13 07:17:10', '2023-12-13 07:17:10', 2),
(34, 2, 'WARAH2', 'kennel_1702455196.png', 1, 34, 2, '2023-12-13 10:04:00', '2023-12-13 10:04:00', 2),
(35, 2, 'TESNOPAY', 'kennel_1702452899.png', 2, 35, 0, NULL, '2023-12-13 07:35:19', 2),
(36, 2, 'TESNOPAY', 'kennel_1702452952.png', 1, 36, 2, '2023-12-13 07:35:57', '2023-12-13 07:35:57', 2),
(37, 2, 'BACKUSER', 'kennel_1702532319.png', 1, 37, 2, '2023-12-14 05:38:39', '2023-12-14 05:38:39', 2),
(38, 2, '18923719823', 'kennel_1702714826.png', 7, 38, 2, '2023-12-16 08:20:26', '2023-12-18 08:29:06', 2),
(39, 1, 'LOWBRAD', 'kennel_1702906713.png', 1, 39, 2, '2023-12-18 13:39:36', '2023-12-18 13:39:36', 2);

-- --------------------------------------------------------

--
-- Table structure for table `kennels_type`
--

CREATE TABLE `kennels_type` (
  `ken_type_id` int(11) NOT NULL,
  `ken_type_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `kennels_type`
--

INSERT INTO `kennels_type` (`ken_type_id`, `ken_type_name`) VALUES
(0, 'Tidak ada kennel / No Kennel'),
(1, 'xxx + von + kennel'),
(2, 'kennel + \' + xxx');

-- --------------------------------------------------------

--
-- Table structure for table `logs_birth`
--

CREATE TABLE `logs_birth` (
  `log_id` int(11) NOT NULL,
  `log_bir_id` int(11) NOT NULL,
  `log_stu_id` int(11) NOT NULL,
  `log_member_id` int(11) NOT NULL,
  `log_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `log_user` tinyint(4) NOT NULL,
  `log_app_user` int(4) NOT NULL,
  `log_app_date` timestamp NULL DEFAULT NULL,
  `log_stat` tinyint(4) NOT NULL DEFAULT 0,
  `log_date_of_birth` date NOT NULL,
  `log_dam_photo` text NOT NULL,
  `log_male` int(11) NOT NULL,
  `log_female` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `logs_birth`
--

INSERT INTO `logs_birth` (`log_id`, `log_bir_id`, `log_stu_id`, `log_member_id`, `log_date`, `log_user`, `log_app_user`, `log_app_date`, `log_stat`, `log_date_of_birth`, `log_dam_photo`, `log_male`, `log_female`) VALUES
(1, 1, 1, 4, '2023-06-25 12:35:08', 2, 2, '2023-06-25 12:35:08', 1, '2023-06-25', 'birth_1687696501.png', 2, 2),
(2, 2, 2, 4, '2023-06-25 12:45:43', 2, 2, '2023-06-25 12:45:43', 1, '2023-06-25', 'birth_1687697138.png', 0, 2),
(3, 3, 4, 13, '2023-06-25 15:22:11', 2, 2, '2023-06-25 15:22:11', 1, '2023-05-10', 'birth_1687706450.png', 2, 1),
(4, 4, 5, 13, '2023-06-25 23:05:59', 2, 2, '2023-06-25 23:05:59', 1, '2023-06-26', 'birth_1687734352.png', 1, 1),
(5, 5, 6, 15, '2023-06-25 23:17:08', 2, 2, '2023-06-25 23:17:08', 1, '2023-06-26', 'birth_1687735023.png', 1, 2),
(6, 6, 7, 13, '2023-06-25 23:25:07', 2, 2, '2023-06-25 23:25:07', 1, '2023-06-25', 'birth_1687735502.png', 1, 2),
(7, 7, 9, 13, '2023-06-25 23:49:56', 2, 2, '2023-06-25 23:49:56', 1, '2023-04-19', 'birth_1687736955.png', 2, 2),
(8, 8, 10, 15, '2023-06-26 00:08:27', 2, 2, '2023-06-26 00:08:27', 1, '2023-06-25', 'birth_1687738101.png', 1, 1),
(27, 11, 14, 13, '2023-12-18 13:50:25', 2, 2, '2023-12-18 13:50:25', 1, '2023-12-17', 'birth_1702907407.png', 2, 3),
(28, 11, 14, 13, '2023-12-18 13:55:37', 2, 2, '0000-00-00 00:00:00', 1, '2023-10-24', 'birth_1702907407.png', 2, 3);

-- --------------------------------------------------------

--
-- Table structure for table `logs_canine`
--

CREATE TABLE `logs_canine` (
  `log_id` int(11) NOT NULL,
  `log_canine_id` int(11) NOT NULL,
  `log_reg_number` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `log_a_s` varchar(50) NOT NULL,
  `log_icr_number` varchar(15) NOT NULL,
  `log_breed` varchar(50) NOT NULL,
  `log_gender` varchar(10) NOT NULL,
  `log_color` varchar(50) NOT NULL,
  `log_date_of_birth` date NOT NULL,
  `log_chip_number` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `log_photo` text NOT NULL,
  `log_stat` tinyint(4) NOT NULL,
  `log_member_id` int(11) NOT NULL,
  `log_app_user` tinyint(4) NOT NULL,
  `log_app_date` timestamp NULL DEFAULT NULL,
  `log_kennel_id` int(11) NOT NULL DEFAULT 0,
  `log_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `log_user` tinyint(4) NOT NULL,
  `log_note` text NOT NULL,
  `log_rip` tinyint(4) NOT NULL,
  `log_pay_photo` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `logs_canine`
--

INSERT INTO `logs_canine` (`log_id`, `log_canine_id`, `log_reg_number`, `log_a_s`, `log_icr_number`, `log_breed`, `log_gender`, `log_color`, `log_date_of_birth`, `log_chip_number`, `log_photo`, `log_stat`, `log_member_id`, `log_app_user`, `log_app_date`, `log_kennel_id`, `log_date`, `log_user`, `log_note`, `log_rip`, `log_pay_photo`) VALUES
(1, 3, '-', 'GREAT POINT` EDGAR', '-', 'AMERICAN PIT BULL TERRIER', 'MALE', '-', '2022-05-01', '-', 'canine_1687694015.png', 1, 2, 2, '2023-06-25 11:55:21', 2, '2023-06-25 11:55:21', 2, '', 0, 'payment_1687694015.png'),
(2, 4, '-', 'GREAT POINT` ARANDA', '-', 'AMERICAN PIT BULL TERRIER', 'FEMALE', '-', '2022-04-01', '-', 'canine_1687694279.png', 1, 2, 2, '2023-06-25 11:58:04', 2, '2023-06-25 11:58:04', 2, '', 0, 'payment_1687694279.png'),
(3, 5, '-', 'DELPHIE VON NORTH SANTIAM', '-', 'AMERICAN PIT BULL TERRIER', 'FEMALE', '-', '2022-01-06', '-', 'canine_1687694521.png', 1, 4, 2, '2023-06-25 12:02:07', 4, '2023-06-25 12:02:07', 2, '', 0, 'payment_1687694521.png'),
(4, 6, '-', 'LIONEL VON NORTH SANTIAM', '-', 'AMERICAN PIT BULL TERRIER', 'MALE', '-', '2022-03-08', '-', 'canine_1687694571.png', 1, 4, 2, '2023-06-25 12:02:56', 4, '2023-06-25 12:02:56', 2, '', 0, 'payment_1687694571.png'),
(5, 7, '-', 'ARIA VON NORTH SANTIAM', '-', 'AMERICAN PIT BULL TERRIER', 'FEMALE', '-', '2023-05-10', '-', 'canine_1687696632.png', 1, 4, 2, '2023-06-25 12:37:24', 4, '2023-06-25 12:37:24', 2, '-', 0, 'payment_1687696632.png'),
(6, 8, '-', 'SCHAFFER RIDGE` ROCKY', '-', 'AMERICAN PIT BULL TERRIER', 'MALE', '-', '2022-02-09', '-', 'canine_1687696815.png', 1, 6, 2, '2023-06-25 12:40:21', 6, '2023-06-25 12:40:21', 2, '', 0, 'payment_1687696815.png'),
(7, 7, '-', 'ARIA VON NORTH SANTIAM', '-', 'AMERICAN PIT BULL TERRIER', 'FEMALE', '-', '2022-05-01', '-', 'canine_1687696632.png', 1, 4, 0, NULL, 4, '2023-06-25 12:41:11', 2, '', 0, 'payment_1687696632.png'),
(8, 9, '-', 'AQUILA VON NORTH SANTIAM', '-', 'AMERICAN PIT BULL TERRIER', 'FEMALE', '-', '2023-05-05', '-', 'canine_1687697458.png', 1, 4, 2, '2023-06-25 12:51:06', 4, '2023-06-25 12:51:06', 2, '-', 0, 'payment_1687697458.png'),
(9, 10, '-', 'DIONA VON NORTH SANTIAM', '-', 'AMERICAN PIT BULL TERRIER', 'FEMALE', '-', '2023-05-05', '-', 'canine_1687697401.png', 1, 4, 2, '2023-06-25 12:51:09', 4, '2023-06-25 12:51:09', 2, '-', 0, 'payment_1687697401.png'),
(10, 10, '-', 'DIONA VON NORTH SANTIAM', '-', 'AMERICAN PIT BULL TERRIER', 'FEMALE', '-', '2023-05-05', '-', 'canine_1687697401.png', 1, 6, 2, '2023-06-25 12:51:09', 6, '2023-06-25 12:52:35', 2, '', 0, 'payment_1687697401.png'),
(11, 10, '-', 'DIONA VON NORTH SANTIAM', '-', 'AMERICAN PIT BULL TERRIER', 'FEMALE', '-', '2023-05-05', '-', 'canine_1687697401.png', 1, 6, 0, NULL, 6, '2023-06-25 13:38:25', 2, '', 0, 'payment_1687697401.png'),
(12, 13, '-', 'SNOWY VON EXPLOSIVE', '-', 'POMERANIAN', 'FEMALE', '-', '2022-04-06', '-', 'canine_1687703567.png', 1, 10, 2, '2023-06-25 14:32:51', 10, '2023-06-25 14:32:51', 2, '', 0, 'payment_1687703567.png'),
(13, 12, '-', 'DESSY VON EXPLOSIVE', '-', 'GIANT POODLE', 'FEMALE', '-', '2021-10-02', '-', 'canine_1687703477.png', 1, 10, 2, '2023-06-25 14:32:54', 10, '2023-06-25 14:32:54', 2, '', 0, 'payment_1687703477.png'),
(14, 11, '-', 'EMMA VON EXPLOSIVE', '-', 'DESIGNER BULLY', 'FEMALE', '-', '2021-11-02', '-', 'canine_1687703353.png', 1, 10, 2, '2023-06-25 14:32:56', 10, '2023-06-25 14:32:56', 2, '', 0, 'payment_1687703353.png'),
(15, 15, '-', 'WILDLINE` EVIANA', '-', 'DESIGNER BULLY', 'FEMALE', '-', '2021-03-03', '-', 'canine_1687704347.png', 1, 13, 2, '2023-06-25 14:45:59', 13, '2023-06-25 14:45:59', 2, '', 0, 'payment_1687704347.png'),
(16, 14, '-', 'WILDLINE` CAROL', '-', 'DESIGNER BULLY', 'FEMALE', '-', '2021-09-01', '-', 'canine_1687704278.png', 1, 13, 2, '2023-06-25 14:46:01', 13, '2023-06-25 14:46:01', 2, '', 0, 'payment_1687704278.png'),
(17, 17, '-', 'WILDLINE` IONIA', '-', 'GIANT POODLE', 'FEMALE', '-', '2022-01-07', '-', 'canine_1687704457.png', 1, 13, 2, '2023-06-25 14:48:27', 13, '2023-06-25 14:48:27', 2, '', 0, 'payment_1687704457.png'),
(18, 16, '-', 'WILDLINE` TRISTANA', '-', 'GIANT POODLE', 'FEMALE', '-', '2021-10-06', '-', 'canine_1687704408.png', 1, 13, 2, '2023-06-25 14:48:29', 13, '2023-06-25 14:48:29', 2, '', 0, 'payment_1687704408.png'),
(19, 20, '-', 'WILDLINE` GISELLA', '-', 'POMERANIAN', 'FEMALE', '-', '2021-11-04', '-', 'canine_1687704616.png', 1, 13, 2, '2023-06-25 14:50:24', 13, '2023-06-25 14:50:24', 2, '', 0, 'payment_1687704616.png'),
(20, 19, '-', 'WILDLINE` BIANCA', '-', 'POMERANIAN', 'FEMALE', '-', '2022-02-03', '-', 'canine_1687704583.png', 1, 13, 2, '2023-06-25 14:50:27', 13, '2023-06-25 14:50:27', 2, '', 0, 'payment_1687704583.png'),
(21, 22, '-', 'WILDLINE` NIKITA', '-', 'AMERICAN PIT BULL TERRIER', 'FEMALE', '-', '2021-10-05', '-', 'canine_1687704835.png', 1, 13, 2, '2023-06-25 14:54:00', 13, '2023-06-25 14:54:00', 2, '', 0, 'payment_1687704835.png'),
(22, 23, '-', 'MAYFLOWER` FILLY', '-', 'POMERANIAN', 'MALE', '-', '2022-01-06', '-', 'canine_1687705434.png', 1, 14, 2, '2023-06-25 15:03:59', 14, '2023-06-25 15:03:59', 2, '', 0, 'payment_1687705434.png'),
(23, 24, '-', 'MAYFLOWER` JOE', '-', 'AMERICAN PIT BULL TERRIER', 'MALE', '-', '2022-03-02', '-', 'canine_1687705483.png', 1, 14, 2, '2023-06-25 15:04:48', 14, '2023-06-25 15:04:48', 2, '', 0, 'payment_1687705483.png'),
(24, 25, '-', 'MAYFLOWER` LEVINE', '-', 'DESIGNER BULLY', 'MALE', '-', '2021-11-04', '-', 'canine_1687705529.png', 1, 14, 2, '2023-06-25 15:05:35', 14, '2023-06-25 15:05:35', 2, '', 0, 'payment_1687705529.png'),
(25, 26, '-', 'MAYFLOWER` JAMES', '-', 'AMERICAN PIT BULL TERRIER', 'MALE', '-', '2021-11-04', '-', 'canine_1687705617.png', 1, 14, 2, '2023-06-25 15:07:01', 14, '2023-06-25 15:07:01', 2, '', 0, 'payment_1687705617.png'),
(26, 26, '-', 'MAYFLOWER` JAMES', '-', 'GIANT POODLE', 'MALE', '-', '2021-11-04', '-', 'canine_1687705617.png', 1, 14, 0, NULL, 14, '2023-06-25 15:07:57', 2, '', 0, 'payment_1687705617.png'),
(27, 25, '-', 'MAYFLOWER` LEVINE', '-', 'AMERICAN PIT BULL TERRIER', 'MALE', '-', '2021-11-04', '-', 'canine_1687705529.png', 1, 14, 0, NULL, 14, '2023-06-25 15:14:30', 2, '', 0, 'payment_1687705529.png'),
(28, 24, '-', 'MAYFLOWER` JOE', '-', 'DESIGNER BULLY', 'MALE', '-', '2022-03-02', '-', 'canine_1687705483.png', 1, 14, 0, NULL, 14, '2023-06-25 15:14:42', 2, '', 0, 'payment_1687705483.png'),
(29, 27, '-', 'WILDLINE` GREGORY', '-', 'POMERANIAN', 'MALE', '-', '2022-05-05', '-', 'canine_1687710147.png', 1, 13, 2, '2023-06-25 16:22:32', 13, '2023-06-25 16:22:32', 2, '', 0, 'payment_1687710147.png'),
(30, 22, '-', 'WILDLINE` NIKITA', '-', 'AMERICAN PIT BULL TERRIER', 'FEMALE', '-', '2021-10-05', '2039455', 'canine_1687704835.png', 1, 13, 0, NULL, 13, '2023-06-25 16:56:21', 2, '', 0, 'payment_1687704835.png'),
(31, 9, '-', 'AQUILA VON NORTH SANTIAM', '-', 'AMERICAN PIT BULL TERRIER', 'FEMALE', '-', '2023-05-05', '-', 'canine_1687697458.png', 1, 13, 2, '0000-00-00 00:00:00', 13, '2023-06-25 22:52:55', 2, '', 0, 'payment_1687697458.png'),
(32, 28, '-', 'JACKSON VON LYNWOOD', '-', 'AMERICAN PIT BULL TERRIER', 'MALE', '-', '2021-12-01', '-', 'canine_1687733925.png', 1, 15, 2, '2023-06-25 22:58:50', 15, '2023-06-25 22:58:50', 2, '', 0, 'payment_1687733925.png'),
(33, 29, '-', 'WILDLINE` HANNAH', '-', 'AMERICAN PIT BULL TERRIER', 'FEMALE', '-', '2023-04-19', '-', 'canine_1687734558.png', 1, 13, 2, '2023-06-25 23:09:28', 13, '2023-06-25 23:09:28', 2, '-', 0, 'payment_1687734558.png'),
(34, 30, '-', 'SABRINA VON LYNWOOD', '-', 'AMERICAN PIT BULL TERRIER', 'FEMALE', '-', '2022-03-03', '-', 'canine_1687734836.png', 1, 15, 2, '2023-06-25 23:14:02', 15, '2023-06-25 23:14:02', 2, '', 0, 'payment_1687734836.png'),
(35, 31, '-', 'CASSIUS VON LYNWOOD', '-', 'AMERICAN PIT BULL TERRIER', 'MALE', '-', '2023-04-19', '-', 'canine_1687735126.png', 1, 15, 2, '2023-06-25 23:19:57', 15, '2023-06-25 23:19:57', 2, '-', 0, 'payment_1687735126.png'),
(36, 32, '-', 'WILDLINE` RENGAR', '-', 'AMERICAN PIT BULL TERRIER', 'MALE', '-', '2023-04-20', '-', 'canine_1687735579.png', 1, 13, 2, '2023-06-25 23:26:59', 13, '2023-06-25 23:26:59', 2, '-', 0, 'payment_1687735579.png'),
(37, 33, '-', 'WILDLINE` SANDRA', '-', 'AMERICAN PIT BULL TERRIER', 'FEMALE', '-', '2023-04-20', '-', 'canine_1687735552.png', 1, 13, 2, '2023-06-25 23:27:02', 13, '2023-06-25 23:27:02', 2, '-', 0, 'payment_1687735552.png'),
(38, 35, '-', 'QUINN VON LYNWOOD', '-', 'POMERANIAN', 'FEMALE', '-', '2022-02-01', '-', 'canine_1687736074.png', 1, 15, 2, '2023-06-25 23:34:40', 15, '2023-06-25 23:34:40', 2, '', 0, 'payment_1687736074.png'),
(39, 34, '-', 'OLIVER VON LYNWOOD', '-', 'POMERANIAN', 'MALE', '-', '2022-04-07', '-', 'canine_1687736045.png', 1, 15, 2, '2023-06-25 23:34:43', 15, '2023-06-25 23:34:43', 2, '', 0, 'payment_1687736045.png'),
(40, 34, '-', 'OLIVER VON LYNWOOD', '-', 'POMERANIAN', 'MALE', '-', '2022-04-07', '-', 'canine_1687736045.png', 1, 13, 2, '0000-00-00 00:00:00', 13, '2023-06-25 23:39:14', 2, '', 0, 'payment_1687736045.png'),
(41, 35, '-', 'QUINN VON LYNWOOD', '-', 'POMERANIAN', 'FEMALE', '-', '2022-02-01', '-', 'canine_1687736074.png', 1, 13, 2, '0000-00-00 00:00:00', 13, '2023-06-25 23:39:17', 2, '', 0, 'payment_1687736074.png'),
(42, 36, '-', 'SCHAFFER RIDGE` WAYNE', '-', 'AMERICAN PIT BULL TERRIER', 'MALE', '-', '2022-03-10', '-', 'canine_1687736750.png', 1, 6, 2, '2023-06-25 23:45:54', 6, '2023-06-25 23:45:54', 2, '', 0, 'payment_1687736750.png'),
(43, 38, '-', 'CLYDE VON LYNWOOD', '-', 'AMERICAN PIT BULL TERRIER', 'MALE', '-', '2022-05-04', '-', 'canine_1687737926.png', 1, 15, 2, '2023-06-26 00:05:30', 15, '2023-06-26 00:05:30', 2, '', 0, 'payment_1687737926.png'),
(44, 37, '-', 'YUNA VON LYNWOOD', '-', 'GIANT POODLE', 'FEMALE', '-', '2022-02-09', '-', 'canine_1687737883.png', 1, 15, 2, '2023-06-26 00:05:32', 15, '2023-06-26 00:05:32', 2, '', 0, 'payment_1687737883.png'),
(45, 38, '-', 'CLYDE VON LYNWOOD', '-', 'GIANT POODLE', 'MALE', '-', '2022-05-04', '-', 'canine_1687737926.png', 1, 15, 0, NULL, 15, '2023-06-26 00:06:02', 2, '', 0, 'payment_1687737926.png'),
(46, 40, '-', 'LEONA VON LYNWOOD', '-', 'POMERANIAN', 'FEMALE', '-', '2022-05-04', '-', 'canine_1687738407.png', 1, 15, 2, '2023-06-26 00:13:31', 15, '2023-06-26 00:13:31', 2, '', 0, 'payment_1687738407.png'),
(47, 39, '-', 'JAYCE VON LYNWOOD', '-', 'POMERANIAN', 'MALE', '-', '2022-03-02', '-', 'canine_1687738380.png', 1, 15, 2, '2023-06-26 00:13:33', 15, '2023-06-26 00:13:33', 2, '', 0, 'payment_1687738380.png'),
(48, 35, '', '', '', '', '', '', '0000-00-00', '', '-', 0, 0, 0, NULL, 0, '2023-06-26 23:28:56', 2, '', 1, ''),
(49, 34, '', '', '', '', '', '', '0000-00-00', '', '-', 0, 0, 0, NULL, 0, '2023-06-26 23:29:30', 2, '', 1, ''),
(50, 35, '', '', '', '', '', '', '0000-00-00', '', 'canine_1687822207.png', 0, 0, 0, NULL, 0, '2023-06-26 23:30:12', 2, '', 0, ''),
(51, 42, '-', 'WILDLINE` HALDOG', '-', 'DESIGNER BULLY', 'FEMALE', '-', '2023-06-01', '-', 'canine_1702431516.png', 1, 13, 2, '2023-12-13 01:42:22', 13, '2023-12-13 01:42:22', 2, '', 0, '-'),
(52, 50, '23232', 'WILDLINE` TESTIMER', '23232', 'AMERICAN PIT BULL TERRIER', 'MALE', 'red', '2023-08-02', '', 'canine_1702439637.png', 1, 13, 2, '2023-12-13 03:53:57', 13, '2023-12-13 03:53:57', 2, '', 0, '-'),
(53, 50, '23232', 'WILDLINE` TESTIMER', '23232', 'AMERICAN PIT BULL TERRIER', 'MALE', 'red', '2023-08-02', '', 'canine_1702439637.png', 2, 13, 2, '2023-12-13 03:54:12', 13, '2023-12-13 03:54:12', 2, '', 0, '-'),
(54, 52, '-', 'WILDLINE` TESUPLOAD', '-', 'AMERICAN PIT BULL TERRIER', 'MALE', '-', '2023-08-01', '-', 'canine_1702439889.png', 1, 13, 2, '2023-12-13 04:02:23', 13, '2023-12-13 04:02:23', 2, '', 0, 'payment_1702439889.png'),
(55, 52, '', '', '', '', '', '', '0000-00-00', '', '-', 0, 0, 0, NULL, 0, '2023-12-13 04:03:30', 2, '', 1, ''),
(56, 52, '-', 'WILDLINE` TESUPLOAD', '-', 'AMERICAN PIT BULL TERRIER', 'MALE', '-', '2022-02-01', '-', 'canine_1702439889.png', 1, 13, 0, NULL, 13, '2023-12-13 04:15:08', 2, '', 0, 'payment_1702439889.png'),
(57, 53, '-', 'WILDLINE` HADA', '-', 'AMERICAN PIT BULL TERRIER', 'FEMALE', '-', '2023-10-12', '-', 'canine_1702441115.png', 1, 13, 2, '2023-12-13 04:18:45', 13, '2023-12-13 04:18:45', 2, '-', 0, 'payment_1702441115.png'),
(58, 53, '-', 'WILDLINE` HADA', '-', 'AMERICAN PIT BULL TERRIER', 'FEMALE', '-', '2023-10-12', '-', 'canine_1702441115.png', 1, 13, 0, NULL, 13, '2023-12-13 04:27:46', 2, '', 0, 'payment_1702441115.png'),
(59, 54, '-', 'WILDLINE` UCHIGA', '-', 'GIANT POODLE', 'MALE', '-', '2023-08-01', '-', 'canine_1702453129.png', 1, 13, 2, '2023-12-13 07:39:06', 13, '2023-12-13 07:39:06', 2, '', 0, '-'),
(60, 60, '-', 'WILDLINE` MALE2', '-', 'AMERICAN PIT BULL TERRIER', 'MALE', '-', '2023-10-01', '-', 'canine_1702553088.png', 1, 13, 2, '2023-12-14 11:30:48', 13, '2023-12-14 11:30:48', 2, '-', 0, 'payment_1702553088.png'),
(61, 61, '-', 'WILDLINE` FEMALE1', '-', 'AMERICAN PIT BULL TERRIER', 'FEMALE', '-', '2023-10-01', '-', 'canine_1702553088.png', 1, 13, 2, '2023-12-14 11:30:51', 13, '2023-12-14 11:30:51', 2, '-', 0, 'payment_1702553088.png'),
(62, 62, '-', 'WILDLINE` FEMALE1', '-', 'AMERICAN PIT BULL TERRIER', 'FEMALE', '-', '2023-10-01', '-', 'canine_17025554841.png', 1, 13, 2, '2023-12-14 12:04:57', 13, '2023-12-14 12:04:57', 2, '-', 0, 'payment_1702555484.png'),
(63, 63, '-', 'WILDLINE` MALE1', '-', 'AMERICAN PIT BULL TERRIER', 'MALE', '-', '2023-10-01', '-', 'canine_17025554842.png', 1, 13, 2, '2023-12-14 12:04:59', 13, '2023-12-14 12:04:59', 2, '-', 0, 'payment_1702555484.png'),
(64, 64, '', 'WARAH2` SHEPHERD2', '', 'AMERICAN PIT BULL TERRIER', 'MALE', '', '2023-10-02', '', 'canine_1702713304.png', 1, 34, 2, '2023-12-16 07:55:04', 34, '2023-12-16 07:55:04', 2, '', 0, '-'),
(65, 64, '-', 'WARAH2` SHEPHERD2', '-', 'AMERICAN PIT BULL TERRIER', 'MALE', '-', '2023-10-02', '-', 'canine_1702713304.png', 1, 25, 0, NULL, 25, '2023-12-16 08:09:45', 2, '', 0, '-'),
(66, 64, '-', 'WARAH2` SHEPHERD2', '-', 'AMERICAN PIT BULL TERRIER', 'MALE', '-', '2023-10-02', '-', 'canine_1702713304.png', 1, 23, 0, NULL, 23, '2023-12-16 08:10:46', 2, '', 0, '-'),
(67, 64, '-', 'RUDYN` SHEPHERD2', '-', 'AMERICAN PIT BULL TERRIER', 'MALE', '-', '2023-10-02', '-', 'canine_1702713304.png', 1, 23, 0, NULL, 23, '2023-12-16 08:11:08', 2, '', 0, '-'),
(68, 66, '-', 'WILDLINE` ASD', '-', 'AMERICAN PIT BULL TERRIER', 'MALE', '-', '2023-10-01', '-', 'canine_17027180301.png', 1, 13, 2, '2023-12-16 09:13:50', 13, '2023-12-16 09:13:50', 2, '', 0, '-'),
(69, 67, '-', 'WILDLINE` GOLDEN1', '-', 'AMERICAN PIT BULL TERRIER', 'FEMALE', '-', '2023-10-01', '-', 'canine_17027197371.png', 1, 13, 2, '2023-12-16 09:42:17', 13, '2023-12-16 09:42:17', 2, '', 0, '-'),
(70, 68, '-', 'WILDLINE` SHEPHERD1', '-', 'AMERICAN PIT BULL TERRIER', 'MALE', '-', '2023-10-01', '-', 'canine_17027197372.png', 1, 13, 2, '2023-12-16 09:42:17', 13, '2023-12-16 09:42:17', 2, '', 0, '-'),
(71, 69, '-', 'WILDLINE` HUSKY1', '-', 'AMERICAN PIT BULL TERRIER', 'MALE', '-', '2023-10-01', '-', 'canine_17027197373.png', 1, 13, 2, '2023-12-16 09:42:17', 13, '2023-12-16 09:42:17', 2, '', 0, '-'),
(72, 70, '-', 'WILDLINE` PUG1', '-', 'AMERICAN PIT BULL TERRIER', 'FEMALE', '-', '2023-10-01', '-', 'canine_17027197374.png', 1, 13, 2, '2023-12-16 09:42:17', 13, '2023-12-16 09:42:17', 2, '', 0, '-'),
(73, 71, '-', 'WILDLINE` SHEPHERD1', '-', 'AMERICAN PIT BULL TERRIER', 'MALE', '-', '2023-10-01', '-', 'canine_17028803993.png', 1, 13, 2, '2023-12-18 06:23:48', 13, '2023-12-18 06:23:48', 2, '-', 0, '-'),
(74, 72, '-', 'WILDLINE` SHEP1', '-', 'AMERICAN PIT BULL TERRIER', 'MALE', '-', '2023-10-01', '-', 'canine_17028874883.png', 1, 13, 2, '2023-12-18 08:18:34', 13, '2023-12-18 08:18:34', 2, '-', 0, '-'),
(75, 73, '-', 'WILDLINE` WOLF1', '-', 'AMERICAN PIT BULL TERRIER', 'MALE', '-', '2023-10-01', '-', 'canine_17028874882.png', 1, 13, 2, '2023-12-18 08:18:37', 13, '2023-12-18 08:18:37', 2, '-', 0, '-'),
(76, 74, '-', 'WILDLINE` PUG1', '-', 'AMERICAN PIT BULL TERRIER', 'FEMALE', '-', '2023-10-01', '-', 'canine_17028874881.png', 1, 13, 2, '2023-12-18 08:18:39', 13, '2023-12-18 08:18:39', 2, '-', 0, '-'),
(77, 72, '-', 'WILDLINE` SHEP1', '-', 'AMERICAN PIT BULL TERRIER', 'MALE', '-', '2023-10-01', '-', 'canine_17028874883.png', 2, 13, 2, '2023-12-18 08:21:02', 13, '2023-12-18 08:21:02', 2, '', 0, '-'),
(78, 73, '-', 'WILDLINE` WOLF1', '-', 'AMERICAN PIT BULL TERRIER', 'MALE', '-', '2023-10-01', '-', 'canine_17028874882.png', 2, 13, 2, '2023-12-18 08:21:10', 13, '2023-12-18 08:21:10', 2, '', 0, '-'),
(79, 74, '-', 'WILDLINE` PUG1', '-', 'AMERICAN PIT BULL TERRIER', 'FEMALE', '-', '2023-10-01', '-', 'canine_17028874881.png', 2, 13, 2, '2023-12-18 08:26:09', 13, '2023-12-18 08:26:09', 2, '', 0, '-'),
(80, 74, '-', 'WILDLINE` PUG1', '-', 'AMERICAN PIT BULL TERRIER', 'FEMALE', '-', '2023-10-01', '-', 'canine_17028874881.png', 7, 13, 2, '2023-12-18 08:28:25', 13, '2023-12-18 08:28:25', 2, '', 0, '-'),
(81, 53, '-', 'WILDLINE` HADA', '-', 'AMERICAN PIT BULL TERRIER', 'FEMALE', '-', '2023-10-12', '-', 'canine_1702441115.png', 2, 13, 2, '2023-12-18 08:54:22', 13, '2023-12-18 08:54:22', 2, '', 0, 'payment_1702441115.png'),
(82, 75, '-', 'WILDLINE` GAR3', '-', 'AMERICAN PIT BULL TERRIER', 'FEMALE', '-', '2023-10-01', '-', 'canine_17028909092.png', 1, 13, 2, '2023-12-18 09:15:33', 13, '2023-12-18 09:15:33', 2, '-', 0, '-'),
(83, 76, '-', 'WILDLINE` HAR2', '-', 'AMERICAN PIT BULL TERRIER', 'FEMALE', '-', '2023-10-01', '-', 'canine_17028909091.png', 1, 13, 2, '2023-12-18 09:15:35', 13, '2023-12-18 09:15:35', 2, '-', 0, '-'),
(84, 76, '-', 'WILDLINE` HAR2', '-', 'AMERICAN PIT BULL TERRIER', 'FEMALE', '-', '2023-10-01', '23', 'canine_17028909091.png', 1, 13, 0, NULL, 13, '2023-12-18 12:03:32', 2, '', 0, '-'),
(85, 76, '-', 'WILDLINE` HAR2', '-', 'AMERICAN PIT BULL TERRIER', 'FEMALE', '-', '2023-10-01', '-', 'canine_17028909091.png', 1, 13, 0, NULL, 13, '2023-12-18 12:03:41', 2, '', 0, '-'),
(86, 77, '-', 'JONATHAN VON LOWBRAD', '-', 'AMERICAN PIT BULL TERRIER', 'MALE', '-', '2023-10-10', '-', 'canine_1702906994.png', 1, 39, 2, '2023-12-18 13:43:37', 39, '2023-12-18 13:43:37', 2, '', 0, '-'),
(87, 77, '-', 'JONATHAN VON LOWBRAD', '-', 'AMERICAN PIT BULL TERRIER', 'MALE', '-', '2022-10-06', '-', 'canine_1702906994.png', 1, 39, 0, NULL, 39, '2023-12-18 13:44:09', 2, '', 0, '-'),
(88, 78, '-', 'WILDLINE` TATIANA', '-', 'AMERICAN PIT BULL TERRIER', 'MALE', '-', '2023-10-24', '-', 'canine_17029078942.png', 1, 13, 2, '2023-12-18 13:58:35', 13, '2023-12-18 13:58:35', 2, '-', 0, '-'),
(89, 79, '-', 'WILDLINE` KENGO', '-', 'AMERICAN PIT BULL TERRIER', 'MALE', '-', '2023-10-24', '-', 'canine_17029078941.png', 1, 13, 2, '2023-12-18 13:58:37', 13, '2023-12-18 13:58:37', 2, '-', 0, '-'),
(90, 79, '-', 'WILDLINE` KENGO', '-', 'AMERICAN PIT BULL TERRIER', 'MALE', '-', '2023-10-24', '-', 'canine_17029078941.png', 1, 39, 2, '0000-00-00 00:00:00', 39, '2023-12-18 13:59:32', 2, '', 0, '-');

-- --------------------------------------------------------

--
-- Table structure for table `logs_canine_note`
--

CREATE TABLE `logs_canine_note` (
  `log_id` int(11) NOT NULL,
  `note_id` int(11) NOT NULL,
  `can_id` int(11) NOT NULL,
  `log_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `log_user` int(11) NOT NULL,
  `log_desc` text NOT NULL,
  `log_stat` tinyint(4) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `logs_canine_note`
--

INSERT INTO `logs_canine_note` (`log_id`, `note_id`, `can_id`, `log_date`, `log_user`, `log_desc`, `log_stat`, `date`) VALUES
(1, 1, 67, '2023-12-14 17:00:00', 2, 'pemenang lomba', 1, '2023-12-16 16:53:20');

-- --------------------------------------------------------

--
-- Table structure for table `logs_kennel`
--

CREATE TABLE `logs_kennel` (
  `log_id` int(11) NOT NULL,
  `log_kennel_id` int(11) NOT NULL,
  `log_kennel_name` varchar(50) NOT NULL,
  `log_kennel_type_id` int(11) NOT NULL,
  `log_kennel_photo` text NOT NULL,
  `log_stat` tinyint(4) NOT NULL,
  `log_app_user` int(4) NOT NULL,
  `log_app_date` datetime DEFAULT NULL,
  `log_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `log_user` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `logs_kennel`
--

INSERT INTO `logs_kennel` (`log_id`, `log_kennel_id`, `log_kennel_name`, `log_kennel_type_id`, `log_kennel_photo`, `log_stat`, `log_app_user`, `log_app_date`, `log_date`, `log_user`) VALUES
(1, 2, 'GREAT POINT', 2, 'kennel_1687686287.png', 1, 2, '2023-06-25 16:50:55', '2023-06-25 09:50:55', 2),
(2, 4, 'NORTH SANTIAM', 1, 'kennel_1687690048.png', 1, 2, '2023-06-25 17:47:37', '2023-06-25 10:47:37', 2),
(3, 6, 'SCHAFFER RIDGE', 2, 'kennel_1687690448.png', 1, 2, '2023-06-25 17:54:15', '2023-06-25 10:54:15', 2),
(4, 10, 'EXPLOSIVE', 1, 'kennel_1687691661.png', 1, 2, '2023-06-25 18:14:29', '2023-06-25 11:14:29', 2),
(5, 13, 'WILDLINE', 2, 'kennel_1687704008.png', 1, 2, '2023-06-25 21:40:14', '2023-06-25 14:40:14', 2),
(6, 14, 'MAYFLOWER', 2, 'kennel_1687705388.png', 1, 2, '2023-06-25 22:03:13', '2023-06-25 15:03:13', 2),
(7, 15, 'LYNWOOD', 1, 'kennel_1687733840.png', 1, 2, '2023-06-26 05:57:28', '2023-06-25 22:57:28', 2),
(8, 16, 'GOBERT', 2, 'kennel_1702378081.png', 1, 2, '2023-12-12 17:48:45', '2023-12-12 10:48:45', 2),
(9, 16, 'GOBERT', 2, '', 0, 0, NULL, '2023-12-12 12:32:41', 2),
(10, 17, 'Gobers', 2, 'kennel_1702387016.png', 1, 2, '2023-12-12 20:17:12', '2023-12-12 13:17:12', 2),
(11, 17, 'GOBERS', 2, 'kennel_1702387016.png', 1, 0, NULL, '2023-12-12 13:32:04', 2),
(12, 19, 'JOSHUABELL', 2, 'kennel_1702389037.png', 1, 2, '2023-12-12 20:50:37', '2023-12-12 13:50:37', 2),
(13, 21, 'RANDY', 2, 'kennel_1702447340.png', 2, 0, NULL, '2023-12-13 06:09:16', 2),
(14, 22, 'RANDY', 2, 'kennel_1702447802.png', 1, 2, '2023-12-13 13:14:51', '2023-12-13 06:14:51', 2),
(15, 23, 'RUDYN', 2, 'kennel_1702448284.png', 1, 2, '2023-12-13 13:18:11', '2023-12-13 06:18:11', 2),
(16, 33, 'WARAH', 2, 'kennel_1702451789.png', 1, 2, '2023-12-13 14:17:10', '2023-12-13 07:17:10', 2),
(17, 34, 'WARAH2', 2, 'kennel_1702451958.png', 1, 2, '2023-12-13 14:19:23', '2023-12-13 07:19:23', 2),
(18, 34, 'WARAH2', 2, 'kennel_1702451958.png', 1, 2, '2023-12-13 14:19:46', '2023-12-13 07:19:46', 2),
(19, 35, 'TESNOPAY', 2, 'kennel_1702452899.png', 2, 0, NULL, '2023-12-13 07:35:19', 2),
(20, 36, 'TESNOPAY', 2, 'kennel_1702452952.png', 1, 2, '2023-12-13 14:35:57', '2023-12-13 07:35:57', 2),
(21, 34, 'WARAH2', 2, '', 1, 2, '2023-12-13 15:12:49', '2023-12-13 08:12:49', 2),
(22, 34, 'WARAH2', 2, 'kennel_1702455196.png', 1, 2, '2023-12-13 15:15:27', '2023-12-13 08:15:27', 2),
(23, 34, 'WARAH2', 2, '', 1, 2, '2023-12-13 15:23:34', '2023-12-13 08:23:34', 2),
(24, 34, 'WARAH2', 2, '', 1, 2, '2023-12-13 16:29:31', '2023-12-13 09:29:31', 2),
(25, 34, 'WARAH2', 2, '', 1, 2, '2023-12-13 17:04:00', '2023-12-13 10:04:00', 2),
(26, 37, 'BACKUSER', 2, 'kennel_1702532319.png', 1, 2, '2023-12-14 12:38:39', '2023-12-14 05:38:39', 2),
(27, 38, '18923719823', 2, 'kennel_1702714826.png', 1, 2, '2023-12-16 15:20:26', '2023-12-16 08:20:26', 2),
(28, 38, '18923719823', 2, 'kennel_1702714826.png', 1, 0, NULL, '2023-12-16 08:21:11', 2),
(29, 38, '18923719823', 2, 'kennel_1702714826.png', 7, 0, NULL, '2023-12-18 08:29:06', 2),
(30, 39, 'LOWBRAD', 1, 'kennel_1702906713.png', 1, 2, '2023-12-18 20:39:36', '2023-12-18 13:39:36', 2);

-- --------------------------------------------------------

--
-- Table structure for table `logs_member`
--

CREATE TABLE `logs_member` (
  `log_id` int(11) NOT NULL,
  `log_member_id` int(11) NOT NULL,
  `log_name` varchar(50) NOT NULL,
  `log_address` varchar(100) NOT NULL,
  `log_mail_address` varchar(100) NOT NULL,
  `log_hp` varchar(20) NOT NULL,
  `log_email` varchar(50) NOT NULL,
  `log_kota` varchar(50) NOT NULL,
  `log_kode_pos` varchar(10) NOT NULL,
  `log_ktp` varchar(50) NOT NULL,
  `log_stat` tinyint(4) NOT NULL,
  `log_app_user` int(4) NOT NULL,
  `log_app_date` datetime DEFAULT NULL,
  `log_mem_type` int(11) NOT NULL,
  `log_payment_date` date NOT NULL DEFAULT '2023-01-01',
  `log_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `log_user` tinyint(4) NOT NULL,
  `log_pay_photo` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `logs_member`
--

INSERT INTO `logs_member` (`log_id`, `log_member_id`, `log_name`, `log_address`, `log_mail_address`, `log_hp`, `log_email`, `log_kota`, `log_kode_pos`, `log_ktp`, `log_stat`, `log_app_user`, `log_app_date`, `log_mem_type`, `log_payment_date`, `log_date`, `log_user`, `log_pay_photo`) VALUES
(1, 2, 'ADIANTO WIJAYA', 'Jl Cikutra 99', 'Jl Cikutra 99', '081299396401', 'adianto@gmail.com', 'Bandung', '40111', '3525015201880002', 1, 2, '2023-06-25 16:50:55', 1, '2024-06-25', '2023-06-25 09:50:55', 2, 'payment_1687686287.png'),
(2, 4, 'OLIVIA AGUSTINA', 'JL. Gatot Subroto No 283A', 'JL. Gatot Subroto No 283A', '081299396403', 'olivia@gmail.com', 'Bandung', '40112', '3525010510930001', 1, 2, '2023-06-25 17:47:37', 1, '2024-06-25', '2023-06-25 10:47:37', 2, 'payment_1687690048.png'),
(3, 6, 'DIMAS SIHOMBING', 'Jl Jend Gatot Subroto 44', 'Jl Jend Gatot Subroto 44', '081299396500', 'dimas@gmail.com', 'Jakarta', '12710', '3525016005650004', 1, 2, '2023-06-25 17:54:15', 1, '2024-06-25', '2023-06-25 10:54:15', 2, 'payment_1687690448.png'),
(4, 10, 'MILA MULYANI', 'Jl Adi Sucipto 68, Dandangan', 'Jl Adi Sucipto 68, Dandangan', '081299396410', 'mila20@gmail.com', 'Kediri', '64131', '3525015306780002', 1, 2, '2023-06-25 18:14:29', 1, '2024-06-25', '2023-06-25 11:14:29', 2, 'payment_1687691661.png'),
(5, 13, 'LIMAN IRAWAN', 'Ki. Suniaraja No. 296', 'Ki. Suniaraja No. 296', '09707237904', 'liman@gmail.com', 'Serang', '88190', '3525017006620060', 1, 2, '2023-06-25 21:40:14', 1, '2024-06-25', '2023-06-25 14:40:14', 2, 'payment_1687704008.png'),
(6, 14, 'GERALD HARTANTO', 'Kpg. Pasteur No. 256', 'Kpg. Pasteur No. 256', '02682641016', 'gerald@gmail.com', 'Banjarbaru', '80961', '3525017006950028', 1, 2, '2023-06-25 22:03:13', 1, '2024-06-25', '2023-06-25 15:03:13', 2, 'payment_1687705388.png'),
(7, 15, 'TIARA RAHMAWATI', 'Jln. Wahidin Sudirohusodo No. 580', 'Jln. Wahidin Sudirohusodo No. 580', '036465953548', 'tiara@gmail.com', 'Gorontalo', '60553', '3326161808790021', 1, 2, '2023-06-26 05:57:28', 1, '2024-06-26', '2023-06-25 22:57:28', 2, 'payment_1687733840.png'),
(8, 16, 'RUDY GOBERT', 'address test', 'mail address test', '0239209302', 'rudyg@gmail.com', 'Kabupaten Bengkulu Utara', '0932', '01293812932', 1, 2, '2023-12-12 17:48:45', 1, '2024-12-12', '2023-12-12 10:48:45', 2, 'payment_1702378081.png'),
(9, 16, 'RUDY GOBERT', 'address test', 'mail address test', '0239209302', 'rudyg@gmail.com', 'Kabupaten Bengkalis', '0932', '01293812932', 0, 0, NULL, 0, '2023-01-01', '2023-12-12 12:32:41', 2, ''),
(10, 17, 'ALDY GOBER', 'address aldy', 'mail aldy', '23092032', 'aldygobert@gmail.com', 'Kota Yogyakarta', '23232', '0232893238', 1, 2, '2023-12-12 20:17:12', 1, '2023-01-01', '2023-12-12 13:17:12', 2, 'payment_1702387016.png'),
(11, 17, 'ALDY GOBERTT', 'address aldy', 'mail aldy', '23092032', 'aldygobert@gmail.com', 'Kota Yogyakarta', '23232', '0232893238', 1, 2, '2023-12-12 00:00:00', 1, '2024-12-12', '2023-12-12 13:31:54', 2, ''),
(12, 17, 'ALDY GOBERTT', 'address aldy', 'mail aldy', '23092032', 'aldygobert@gmail.com', 'Kota Ternate', '23232', '0232893238', 1, 0, NULL, 1, '2023-01-01', '2023-12-12 13:32:04', 2, '-'),
(13, 19, 'JOSHUA BELL', 'joshua address', 'joshua address', '23920392', 'joshuabell@gmail.com', 'Kabupaten Ciamis', '2324', '232324242', 1, 2, '2023-12-12 20:50:37', 1, '2023-01-01', '2023-12-12 13:50:37', 2, '-'),
(14, 21, 'RANDY', 'randy address', 'randy address', '23242', 'randy@gmail.com', 'Kota Jakarta Selatan', '2242', '2323242', 2, 0, NULL, 1, '2023-01-01', '2023-12-13 06:09:16', 2, '-'),
(15, 22, 'RANDY', 'randy address', 'randy address', '2324242', 'randy@gmail.com', 'Kabupaten Banyuasin', '22211', '3238293', 1, 2, '2023-12-13 13:14:51', 1, '2024-12-13', '2023-12-13 06:14:51', 2, '-'),
(16, 23, 'RUDYN', 'rudy address', 'rudy address', '2342114141', 'rudyn@gmail.com', 'Kabupaten Belitung Timur', '24242424', '232424221111', 1, 2, '2023-12-13 13:18:11', 1, '2024-12-13', '2023-12-13 06:18:11', 2, 'payment_1702448284.png'),
(17, 33, 'WARAH', 'warah', 'warah', '1241412', 'warah@gmail.com', 'Kabupaten Aceh Besar', '1241423', '13211249', 1, 2, '2023-12-13 14:17:10', 1, '2024-12-13', '2023-12-13 07:17:10', 2, '-'),
(18, 34, 'WARAH2', 'warah', 'warah', '1231231', 'warah2@gmail.com', 'Kabupaten Aceh Barat Daya', '239823', '12938239', 1, 2, '2023-12-13 14:19:23', 1, '2024-12-13', '2023-12-13 07:19:23', 2, 'payment_1702451958.png'),
(19, 34, 'WARAH2', 'warah', 'warah', '1231231', 'warah2@gmail.com', 'Kabupaten Aceh Barat Daya', '239823', '12938239', 1, 2, '2023-12-13 14:19:46', 1, '2024-12-13', '2023-12-13 07:19:46', 2, 'payment_1702451958.png'),
(20, 35, 'TESNOPAY', 'tesnopay', 'tesnopay address', '18237918237', 'tesnopay@gmail.com', 'Kabupaten Bangkalan', '123214', '39812980321', 2, 0, NULL, 1, '2023-01-01', '2023-12-13 07:35:19', 2, '-'),
(21, 36, 'TESNOPAY', 'tesnopay', 'tesnopay address', '28732832', 'tesnopay@gmail.com', 'Kabupaten Banggai', '12141', '128930123', 1, 2, '2023-12-13 14:35:57', 1, '2024-12-13', '2023-12-13 07:35:57', 2, 'payment_1702452952.png'),
(22, 34, 'WARAH2', 'warah', 'warah', '1231231', 'warah2@gmail.com', 'Kabupaten Aceh Barat Daya', '239823', '12938239', 1, 2, '2023-12-13 15:12:49', 1, '2023-01-01', '2023-12-13 08:12:49', 2, ''),
(23, 34, 'WARAH2', 'warah', 'warah', '1231231', 'warah2@gmail.com', 'Kabupaten Aceh Barat Daya', '239823', '12938239', 1, 2, '2023-12-13 15:15:27', 1, '2023-01-01', '2023-12-13 08:15:27', 2, 'payment_1702455196.png'),
(24, 34, 'WARAH2', 'warah', 'warah', '1231231', 'warah2@gmail.com', 'Kabupaten Aceh Barat Daya', '239823', '12938239', 1, 2, '2023-12-13 15:23:34', 1, '2023-01-01', '2023-12-13 08:23:34', 2, ''),
(25, 34, 'WARAH2', 'warah', 'warah', '1231231', 'warah2@gmail.com', 'Kabupaten Aceh Barat Daya', '239823', '12938239', 1, 2, '2023-12-13 16:29:31', 1, '2023-01-01', '2023-12-13 09:29:31', 2, ''),
(26, 34, 'WARAH2', 'warah', 'warah', '1231231', 'warah2@gmail.com', 'Kabupaten Aceh Barat Daya', '239823', '12938239', 1, 2, '2023-12-13 17:04:00', 1, '2023-01-01', '2023-12-13 10:04:00', 2, ''),
(27, 37, 'BACKUSER', 'backuser', 'backuser', '23234234', 'backuser@gmail.com', 'Kabupaten Bangka Barat', '123123', '293239', 1, 2, '2023-12-14 12:38:39', 1, '2023-01-01', '2023-12-14 05:38:39', 2, '-'),
(28, 38, '18923719823', '18923719823', '18923719823', '18923719823', '18923719823@gmail.com', 'Kabupaten Aceh Besar', '1892371982', '18923719823', 1, 2, '2023-12-16 15:20:26', 1, '2023-01-01', '2023-12-16 08:20:26', 2, '-'),
(29, 38, '18923719823', '18923719823', '18923719823', '18923719823', '18923719823@gmail.com', 'Kabupaten Aceh Besar', '1892371982', '18923719823', 1, 0, NULL, 1, '2023-01-01', '2023-12-16 08:21:11', 2, '-'),
(30, 38, '18923719823', '18923719823', '18923719823', '18923719823', '18923719823@gmail.com', 'Kabupaten Aceh Besar', '1892371982', '18923719823', 7, 2, '2023-12-16 00:00:00', 1, '2023-01-01', '2023-12-18 08:29:06', 2, '-'),
(31, 39, 'THEO CAMPBELL', 'Ds. Yoga No. 932, Tegal 59830, JaTeng', 'Ds. Yoga No. 932, Tegal 59830, JaTeng', '08244842670003', 'theocamp@gmail.com', 'Kabupaten Tegal', '59830', '5494687012040459', 1, 2, '2023-12-18 20:39:36', 1, '2024-12-18', '2023-12-18 13:39:36', 2, '-');

-- --------------------------------------------------------

--
-- Table structure for table `logs_order`
--

CREATE TABLE `logs_order` (
  `log_id` int(11) NOT NULL,
  `log_ord_id` int(11) NOT NULL,
  `log_mem_id` int(11) NOT NULL,
  `log_invoice` varchar(60) NOT NULL,
  `log_city_id` int(11) NOT NULL,
  `log_address` varchar(100) NOT NULL,
  `log_shipping_id` int(11) NOT NULL,
  `log_shipping_type` varchar(60) NOT NULL,
  `log_shipping_cost` int(11) NOT NULL,
  `log_total_price` int(11) NOT NULL,
  `log_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `log_updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `log_updated_by` int(11) DEFAULT NULL,
  `log_pay_date` timestamp NULL DEFAULT NULL,
  `log_pay_due_date` timestamp NULL DEFAULT NULL,
  `log_arrived_date` timestamp NULL DEFAULT NULL,
  `log_completed_date` timestamp NULL DEFAULT NULL,
  `log_stat_id` int(11) NOT NULL,
  `log_reject_note` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `logs_order`
--

INSERT INTO `logs_order` (`log_id`, `log_ord_id`, `log_mem_id`, `log_invoice`, `log_city_id`, `log_address`, `log_shipping_id`, `log_shipping_type`, `log_shipping_cost`, `log_total_price`, `log_date`, `log_updated_at`, `log_updated_by`, `log_pay_date`, `log_pay_due_date`, `log_arrived_date`, `log_completed_date`, `log_stat_id`, `log_reject_note`) VALUES
(1, 1, 13, 'INV-15423925', 0, '', 0, '', 0, 50000, '2023-06-25 15:50:29', '2023-06-25 15:59:18', 2, '2023-06-25 15:50:43', '2023-06-25 16:50:29', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 3, NULL),
(2, 1, 13, 'INV-15423925', 0, '', 0, '', 0, 50000, '2023-06-25 15:50:29', '2023-06-25 15:59:20', 2, '2023-06-25 15:50:43', '2023-06-25 16:50:29', '2023-06-25 15:59:20', '0000-00-00 00:00:00', 4, NULL),
(3, 2, 13, 'INV-59835958', 0, '', 0, '', 0, 200000, '2023-06-25 15:50:52', '2023-06-25 15:59:27', 2, '2023-06-25 15:51:14', '2023-06-25 16:50:52', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 7, 'Kendala pengiriman / Delivery problem'),
(4, 3, 13, 'INV-84825419', 0, '', 0, '', 0, 70000, '2023-06-25 15:51:23', '2023-06-25 15:59:31', 2, '2023-06-25 15:51:46', '2023-06-25 16:51:23', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 3, NULL),
(5, 6, 13, 'INV-17759311', 0, '', 0, '', 0, 50000, '2023-06-25 16:08:31', '2023-06-25 16:09:02', 2, '2023-06-25 16:08:47', '2023-06-25 17:08:31', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 3, NULL),
(6, 6, 13, 'INV-17759311', 0, '', 0, '', 0, 50000, '2023-06-25 16:08:31', '2023-06-25 16:09:04', 2, '2023-06-25 16:08:47', '2023-06-25 17:08:31', '2023-06-25 16:09:04', '0000-00-00 00:00:00', 4, NULL),
(7, 7, 2, 'INV-50753655', 0, '', 0, '', 0, 200000, '2023-06-25 17:03:22', '2023-06-25 17:03:44', 2, '2023-06-25 17:03:36', '2023-06-25 18:03:22', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 3, NULL),
(8, 7, 2, 'INV-50753655', 0, '', 0, '', 0, 200000, '2023-06-25 17:03:22', '2023-06-25 17:03:45', 2, '2023-06-25 17:03:36', '2023-06-25 18:03:22', '2023-06-25 17:03:45', '0000-00-00 00:00:00', 4, NULL),
(9, 17, 13, 'TES-38796984', 0, 'reguler 3 produk', 0, '', 13000, 113000, '2023-12-09 09:09:25', '2023-12-09 09:25:42', 2, '2023-12-09 09:09:54', '2023-12-09 10:09:25', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 3, NULL),
(10, 17, 13, 'TES-38796984', 0, 'reguler 3 produk', 0, '', 13000, 113000, '2023-12-09 09:09:25', '2023-12-09 09:25:52', 2, '2023-12-09 09:09:54', '2023-12-09 10:09:25', '2023-12-09 09:25:52', '0000-00-00 00:00:00', 4, NULL),
(11, 18, 13, 'TES-33908189', 0, 'tes', 0, '', 13000, 18000, '2023-12-09 09:30:25', '2023-12-09 09:30:51', 2, '2023-12-09 09:30:43', '2023-12-09 10:30:25', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 3, NULL),
(12, 18, 13, 'TES-33908189', 0, 'tes', 0, '', 13000, 18000, '2023-12-09 09:30:25', '2023-12-09 09:30:53', 2, '2023-12-09 09:30:43', '2023-12-09 10:30:25', '2023-12-09 09:30:53', '0000-00-00 00:00:00', 4, NULL),
(13, 19, 13, 'TES-23276302', 0, 'haree', 0, '', 13000, 63000, '2023-12-09 09:40:35', '2023-12-09 09:41:36', 2, '2023-12-09 09:40:47', '2023-12-09 10:40:35', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 7, 'stok habis'),
(14, 22, 13, 'TES-74992553', 0, '3 produk ekonomi', 0, '', 12000, 167000, '2023-12-09 11:34:43', '2023-12-09 11:38:05', 2, '2023-12-09 11:35:22', '2023-12-09 12:34:43', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 3, NULL),
(15, 22, 13, 'TES-74992553', 0, '3 produk ekonomi', 0, '', 12000, 167000, '2023-12-09 11:34:43', '2023-12-09 11:38:13', 2, '2023-12-09 11:35:22', '2023-12-09 12:34:43', '2023-12-09 11:38:13', '0000-00-00 00:00:00', 4, NULL),
(16, 26, 13, 'TES-89711068', 0, 'solding out', 0, '', 12000, 2162000, '2023-12-09 12:56:17', '2023-12-09 12:56:57', 2, '2023-12-09 12:56:37', '2023-12-09 13:56:17', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 7, 'Kendala pengiriman / Delivery problem'),
(26, 30, 13, 'TES-46416578', 0, 'tester', 0, '', 12000, 3162000, '2023-12-09 13:21:14', '2023-12-09 13:22:54', 2, '2023-12-09 13:21:25', '2023-12-09 14:21:14', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 7, 'Kendala pengiriman / Delivery problem'),
(27, 29, 13, 'TES-53529066', 0, 'addee', 0, '', 13000, 2263000, '2023-12-09 13:12:26', '2023-12-09 13:23:21', 2, '2023-12-09 13:12:38', '2023-12-09 14:12:26', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 7, 'Kendala pengiriman / Delivery problem'),
(28, 31, 13, 'TES-87282327', 0, 'pedpo', 0, '', 13000, 2263000, '2023-12-09 13:23:52', '2023-12-09 13:25:08', 2, '2023-12-09 13:24:37', '2023-12-09 14:23:52', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 7, 'Kendala pengiriman / Delivery problem'),
(29, 32, 13, 'TES-73923189', 0, 'boltd', 0, '', 12000, 2212000, '2023-12-09 13:25:55', '2023-12-09 13:26:16', 2, '2023-12-09 13:26:06', '2023-12-09 14:25:55', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 3, NULL),
(30, 32, 13, 'TES-73923189', 0, 'boltd', 0, '', 12000, 2212000, '2023-12-09 13:25:55', '2023-12-09 13:26:31', 2, '2023-12-09 13:26:06', '2023-12-09 14:25:55', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 7, 'Stok habis'),
(31, 33, 13, 'TES-65222065', 0, '23232', 0, '', 13000, 113000, '2023-12-09 13:27:15', '2023-12-09 13:27:50', 2, '2023-12-09 13:27:29', '2023-12-09 14:27:15', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 3, NULL),
(32, 33, 13, 'TES-65222065', 0, '23232', 0, '', 13000, 113000, '2023-12-09 13:27:15', '2023-12-09 13:27:58', 2, '2023-12-09 13:27:29', '2023-12-09 14:27:15', '2023-12-09 13:27:58', '0000-00-00 00:00:00', 4, NULL),
(33, 36, 13, 'TES-52393139', 106, 'cilegon 2 no. 45, banten 40123', 3, 'Pos Nextday', 38000, 243000, '2023-12-11 06:02:26', '2023-12-11 08:44:05', 2, '2023-12-11 06:04:38', '2023-12-11 07:02:26', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 3, NULL),
(34, 36, 13, 'TES-52393139', 106, 'cilegon 2 no. 45, banten 40123', 3, 'Pos Nextday', 38000, 243000, '2023-12-11 06:02:26', '2023-12-11 08:44:29', 2, '2023-12-11 06:04:38', '2023-12-11 07:02:26', '2023-12-11 08:44:29', '0000-00-00 00:00:00', 4, NULL),
(35, 37, 13, 'TES-01115114', 27, 'bangka address', 1, 'OKE', 38000, 108000, '2023-12-11 08:07:51', '2023-12-11 08:51:08', 2, '2023-12-11 08:50:51', '2023-12-11 09:07:51', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 3, NULL),
(36, 37, 13, 'TES-01115114', 27, 'bangka address', 1, 'OKE', 38000, 108000, '2023-12-11 08:07:51', '2023-12-11 08:51:10', 2, '2023-12-11 08:50:51', '2023-12-11 09:07:51', '2023-12-11 08:51:10', '0000-00-00 00:00:00', 4, NULL),
(37, 38, 13, 'TES-88831014', 402, 'test', 2, 'REG', 12000, 62000, '2023-12-11 08:57:26', '2023-12-11 08:58:49', 2, '2023-12-11 08:57:40', '2023-12-11 09:57:26', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 7, 'Kendala pengiriman / Delivery problem'),
(38, 39, 13, 'TES-45870850', 402, 'tester', 1, 'OKE', 17000, 117000, '2023-12-11 08:59:42', '2023-12-11 09:00:14', 2, '2023-12-11 08:59:59', '2023-12-11 09:59:42', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 7, 'stok sedang habis 02x'),
(39, 42, 13, 'TES-80602784', 175, 'kaur', 1, 'OKE', 41000, 111000, '2023-12-11 09:10:40', '2023-12-11 09:11:18', 2, '2023-12-11 09:10:54', '2023-12-11 10:10:40', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 3, NULL),
(40, 42, 13, 'TES-80602784', 175, 'kaur', 1, 'OKE', 41000, 111000, '2023-12-11 09:10:40', '2023-12-11 09:11:29', 2, '2023-12-11 09:10:54', '2023-12-11 10:10:40', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 7, 'kendala'),
(41, 42, 13, 'IND-02323', 106, 'cilegon', 1, 'REG', 16000, 86000, '0000-00-00 00:00:00', '2023-12-11 11:29:29', 2, '2023-12-04 23:24:00', '2023-12-19 22:18:00', NULL, NULL, 2, 'kendala2'),
(42, 42, 13, 'INS-2023', 106, 'cilegon', 3, 'Pos Reguler', 14000, 84000, '0000-00-00 00:00:00', '2023-12-11 11:33:11', 2, '2023-12-04 23:24:00', '2023-12-19 22:18:00', NULL, NULL, 2, 'kendala2'),
(43, 42, 13, 'INS-2023', 106, 'cilegon', 3, 'Pos Reguler', 14000, 84000, '2023-12-11 09:10:40', '2023-12-11 11:33:31', 2, '2023-12-04 23:24:00', '2023-12-19 22:18:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 3, 'kendala2'),
(44, 42, 13, 'INS-2023', 106, 'cilegon', 3, 'Pos Reguler', 14000, 84000, '2023-12-11 09:10:40', '2023-12-11 11:33:40', 2, '2023-12-04 23:24:00', '2023-12-19 22:18:00', '2023-12-11 11:33:40', '0000-00-00 00:00:00', 4, 'kendala2'),
(45, 42, 13, 'INS-2023', 106, 'cilegon', 3, 'Pos Reguler', 14000, 84000, '0000-00-00 00:00:00', '2023-12-11 11:33:57', 2, '2023-12-04 23:24:00', '2023-12-19 22:18:00', '2023-12-11 11:33:40', '2023-12-11 11:33:47', 4, 'kendala2'),
(46, 42, 13, 'INS-2023', 106, 'cilegon', 3, 'Pos Reguler', 14000, 84000, '0000-00-00 00:00:00', '2023-12-11 11:34:49', 2, '2023-12-04 23:24:00', '2023-12-19 22:18:00', '2023-12-11 11:33:40', '2023-12-11 11:34:21', 4, 'kendala2'),
(47, 42, 13, 'INS-2023', 106, 'cilegon address', 3, 'Pos Reguler', 14000, 84000, '0000-00-00 00:00:00', '2023-12-12 08:00:33', 7, '2023-12-04 23:24:00', '2023-12-19 22:18:00', '2023-12-11 11:33:40', '2023-12-11 11:35:00', 9, 'kendala2'),
(48, 43, 13, 'TES-67623077', 152, 'japos', 3, 'Pos Nextday', 15500, 185500, '2023-12-12 08:05:46', '2023-12-12 08:07:11', 7, '2023-12-12 08:06:00', '2023-12-12 09:05:46', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 3, NULL),
(49, 43, 13, 'TES-67623077', 152, 'japos', 3, 'Pos Nextday', 15500, 185500, '2023-12-12 08:05:46', '2023-12-12 08:07:28', 7, '2023-12-12 08:06:00', '2023-12-12 09:05:46', '2023-12-12 08:07:28', '0000-00-00 00:00:00', 4, NULL),
(50, 44, 17, 'TES-27573417', 232, 'lebak address', 1, 'OKE', 17000, 187000, '2023-12-12 12:35:24', '2023-12-12 13:17:58', 7, '2023-12-12 12:35:44', '2023-12-12 13:35:24', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 3, NULL),
(51, 47, 13, 'TES-10677717', 27, 'bangka 2', 1, 'OKE', 38000, 88000, '2023-12-18 06:07:51', '2023-12-18 06:09:02', 7, '2023-12-18 06:08:11', '2023-12-18 07:07:51', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 3, NULL),
(52, 47, 13, 'TES-10677717', 27, 'bangka 2', 1, 'OKE', 38000, 88000, '2023-12-18 06:07:51', '2023-12-18 06:09:06', 7, '2023-12-18 06:08:11', '2023-12-18 07:07:51', '2023-12-18 06:09:06', '0000-00-00 00:00:00', 4, NULL),
(53, 48, 39, 'TES-53511538', 135, 'JL. Wonosari-Panggang, Km 22, Saptosari, Gunung Kidul, Kepek, Kec. Saptosari, Kabupaten Gunung Kidul', 1, 'OKE', 72000, 347000, '2023-12-18 14:01:06', '2023-12-18 14:01:31', 7, '2023-12-18 14:01:15', '2023-12-18 15:01:06', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 3, NULL),
(54, 48, 39, 'TES-53511538', 135, 'JL. Wonosari-Panggang, Km 22, Saptosari, Gunung Kidul, Kepek, Kec. Saptosari, Kabupaten Gunung Kidul', 1, 'OKE', 72000, 347000, '2023-12-18 14:01:06', '2023-12-18 14:01:41', 7, '2023-12-18 14:01:15', '2023-12-18 15:01:06', '2023-12-18 14:01:41', '0000-00-00 00:00:00', 4, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `logs_pedigree`
--

CREATE TABLE `logs_pedigree` (
  `log_id` int(11) NOT NULL,
  `log_sire_id` int(11) NOT NULL,
  `log_dam_id` int(11) NOT NULL,
  `log_canine_id` int(11) NOT NULL,
  `log_user` int(4) NOT NULL,
  `log_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `logs_pedigree`
--

INSERT INTO `logs_pedigree` (`log_id`, `log_sire_id`, `log_dam_id`, `log_canine_id`, `log_user`, `log_date`) VALUES
(1, 1, 2, 3, 2, '2023-06-25 18:55:21'),
(2, 1, 2, 4, 2, '2023-06-25 18:58:04'),
(3, 1, 2, 5, 2, '2023-06-25 19:02:07'),
(4, 1, 2, 6, 2, '2023-06-25 19:02:56'),
(5, 3, 5, 7, 2, '2023-06-25 19:37:24'),
(6, 1, 2, 8, 2, '2023-06-25 19:40:21'),
(7, 8, 7, 9, 2, '2023-06-25 19:51:06'),
(8, 8, 7, 10, 2, '2023-06-25 19:51:09'),
(9, 1, 2, 13, 2, '2023-06-25 21:32:51'),
(10, 1, 2, 12, 2, '2023-06-25 21:32:54'),
(11, 1, 2, 11, 2, '2023-06-25 21:32:56'),
(12, 1, 2, 15, 2, '2023-06-25 21:45:59'),
(13, 1, 2, 14, 2, '2023-06-25 21:46:01'),
(14, 1, 2, 17, 2, '2023-06-25 21:48:27'),
(15, 1, 2, 16, 2, '2023-06-25 21:48:29'),
(16, 1, 2, 20, 2, '2023-06-25 21:50:24'),
(17, 1, 2, 19, 2, '2023-06-25 21:50:27'),
(18, 1, 2, 22, 2, '2023-06-25 21:54:00'),
(19, 1, 2, 23, 2, '2023-06-25 22:03:59'),
(20, 1, 2, 24, 2, '2023-06-25 22:04:48'),
(21, 1, 2, 25, 2, '2023-06-25 22:05:35'),
(22, 1, 2, 26, 2, '2023-06-25 22:07:01'),
(23, 1, 2, 27, 2, '2023-06-25 23:22:32'),
(24, 1, 2, 28, 2, '2023-06-26 05:58:50'),
(25, 28, 9, 29, 2, '2023-06-26 06:09:28'),
(26, 1, 2, 30, 2, '2023-06-26 06:14:02'),
(27, 25, 30, 31, 2, '2023-06-26 06:19:57'),
(28, 31, 29, 32, 2, '2023-06-26 06:26:59'),
(29, 31, 29, 33, 2, '2023-06-26 06:27:02'),
(30, 1, 2, 35, 2, '2023-06-26 06:34:40'),
(31, 1, 2, 34, 2, '2023-06-26 06:34:43'),
(32, 1, 2, 36, 2, '2023-06-26 06:45:54'),
(33, 1, 2, 38, 2, '2023-06-26 07:05:30'),
(34, 1, 2, 37, 2, '2023-06-26 07:05:32'),
(35, 1, 2, 40, 2, '2023-06-26 07:13:31'),
(36, 1, 2, 39, 2, '2023-06-26 07:13:33'),
(37, 1, 2, 42, 2, '2023-12-13 08:42:22'),
(38, 1, 2, 50, 2, '2023-12-13 10:53:57'),
(39, 1, 2, 52, 2, '2023-12-13 11:02:23'),
(40, 52, 33, 53, 2, '2023-12-13 11:18:45'),
(41, 1, 2, 54, 2, '2023-12-13 14:39:06'),
(42, 52, 29, 60, 2, '2023-12-14 18:30:48'),
(43, 52, 29, 61, 2, '2023-12-14 18:30:51'),
(44, 52, 29, 62, 2, '2023-12-14 19:04:57'),
(45, 52, 29, 63, 2, '2023-12-14 19:04:59'),
(46, 1, 2, 64, 2, '2023-12-16 14:55:04'),
(47, 52, 29, 66, 2, '2023-12-16 16:13:50'),
(48, 52, 29, 67, 2, '2023-12-16 16:42:17'),
(49, 52, 29, 68, 2, '2023-12-16 16:42:17'),
(50, 52, 29, 69, 2, '2023-12-16 16:42:17'),
(51, 52, 29, 70, 2, '2023-12-16 16:42:17'),
(52, 52, 29, 71, 2, '2023-12-18 13:23:48'),
(53, 52, 29, 72, 2, '2023-12-18 15:18:34'),
(54, 52, 29, 73, 2, '2023-12-18 15:18:37'),
(55, 52, 29, 74, 2, '2023-12-18 15:18:39'),
(56, 52, 29, 75, 2, '2023-12-18 16:15:33'),
(57, 52, 29, 76, 2, '2023-12-18 16:15:35'),
(58, 1, 2, 77, 2, '2023-12-18 20:43:37'),
(59, 77, 33, 78, 2, '2023-12-18 20:58:35'),
(60, 77, 33, 79, 2, '2023-12-18 20:58:37');

-- --------------------------------------------------------

--
-- Table structure for table `logs_product`
--

CREATE TABLE `logs_product` (
  `log_id` int(11) NOT NULL,
  `log_product_id` int(11) NOT NULL,
  `log_product_type_id` int(11) NOT NULL,
  `log_product_name` varchar(100) NOT NULL,
  `log_product_price` int(11) NOT NULL,
  `log_product_weight` int(11) NOT NULL,
  `log_product_stock` int(11) NOT NULL,
  `log_product_desc` text NOT NULL,
  `log_product_photo` varchar(255) NOT NULL,
  `log_product_created_user` tinyint(4) NOT NULL,
  `log_product_updated_user` tinyint(4) NOT NULL,
  `log_product_created_at` timestamp NULL DEFAULT current_timestamp(),
  `log_product_updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `log_stat` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `logs_product`
--

INSERT INTO `logs_product` (`log_id`, `log_product_id`, `log_product_type_id`, `log_product_name`, `log_product_price`, `log_product_weight`, `log_product_stock`, `log_product_desc`, `log_product_photo`, `log_product_created_user`, `log_product_updated_user`, `log_product_created_at`, `log_product_updated_at`, `log_stat`) VALUES
(1, 5, 3, 'Ped Food', 5000, 0, 2, 'Tes dog food', 'product_1702010166.png', 2, 2, '2023-12-08 04:36:06', '2023-12-08 04:36:06', 1),
(2, 5, 3, 'Ped Foods', 5000, 0, 2, 'Tes dog food', 'product_1702010166.png', 0, 2, '2023-12-08 04:36:24', '2023-12-08 04:36:24', 1),
(3, 2, 1, 'Milk-Bone Soft & Chewy Dog Treats', 70000, 0, 55, '', 'product_milk-bone.png', 0, 2, '2023-12-09 12:03:37', '2023-12-09 12:03:37', 1),
(4, 4, 2, 'Pedigree Pouch', 50000, 0, 45, '', 'product_1686573819.png', 0, 2, '2023-12-09 13:09:51', '2023-12-09 13:09:51', 1),
(5, 1, 2, 'Blackwood Salmon Meal', 25000, 0, 87, 'adalah resep beraroma, mudah dicerna yang memberikan nutrisi superior di setiap dosisnya. Ini dimasak lambat dalam partai kecil untuk hasil yang maksimal, dan membuat anjing yang sehat. Makanan ini bisa buat diet khusus untuk kulit sensitif dan perut, tanpa jagung, gandum atau kedelai dan dibuat dengan protein domba yang holistik, super premium, alami.', 'product_1686155470.png', 0, 2, '2023-12-10 11:41:03', '2023-12-10 11:41:03', 1),
(6, 1, 2, 'Blackwood Salmon Meal', 25000, 500, 87, 'adalah resep beraroma, mudah dicerna yang memberikan nutrisi superior di setiap dosisnya. Ini dimasak lambat dalam partai kecil untuk hasil yang maksimal, dan membuat anjing yang sehat. Makanan ini bisa buat diet khusus untuk kulit sensitif dan perut, tanpa jagung, gandum atau kedelai dan dibuat dengan protein domba yang holistik, super premium, alami.', 'product_1686155470.png', 0, 2, '2023-12-10 11:42:07', '2023-12-10 11:42:07', 1),
(7, 4, 2, 'Pedigree Pouch', 50000, 150, 45, '', 'product_1686573819.png', 0, 2, '2023-12-11 05:05:50', '2023-12-11 05:05:50', 1),
(8, 2, 1, 'Milk-Bone Soft & Chewy Dog Treats', 70000, 50, 45, '', 'product_milk-bone.png', 0, 2, '2023-12-11 05:05:55', '2023-12-11 05:05:55', 1),
(9, 3, 3, 'Bolt Dog Food', 100000, 1000, 21, '', 'product_1686569436.png', 0, 2, '2023-12-11 05:06:01', '2023-12-11 05:06:01', 1),
(10, 1, 2, 'Blackwood Salmon Meal', 25000, 500, 90, 'adalah resep beraroma, mudah dicerna yang memberikan nutrisi superior di setiap dosisnya. Ini dimasak lambat dalam partai kecil untuk hasil yang maksimal, dan membuat anjing yang sehat. Makanan ini bisa buat diet khusus untuk kulit sensitif dan perut, tanpa jagung, gandum atau kedelai dan dibuat dengan protein domba yang holistik, super premium, alami', 'product_1686155470.png', 0, 8, '2023-12-12 07:58:48', '2023-12-12 07:58:48', 1),
(11, 5, 0, '', 0, 0, 0, '', '', 0, 8, '2023-12-18 08:54:55', '2023-12-18 08:54:55', 0);

-- --------------------------------------------------------

--
-- Table structure for table `logs_req_certificate`
--

CREATE TABLE `logs_req_certificate` (
  `log_id` int(11) NOT NULL,
  `log_req_id` int(11) NOT NULL,
  `log_mem_id` int(11) NOT NULL,
  `log_can_id` int(11) NOT NULL,
  `log_stat_id` int(11) NOT NULL,
  `log_created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `log_updated_at` timestamp NULL DEFAULT NULL,
  `log_updated_by` int(11) DEFAULT NULL,
  `log_arrived_date` timestamp NULL DEFAULT NULL,
  `log_reject_note` text DEFAULT NULL,
  `log_desc` text NOT NULL,
  `log_city_id` int(11) NOT NULL,
  `log_address` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `logs_req_certificate`
--

INSERT INTO `logs_req_certificate` (`log_id`, `log_req_id`, `log_mem_id`, `log_can_id`, `log_stat_id`, `log_created_at`, `log_updated_at`, `log_updated_by`, `log_arrived_date`, `log_reject_note`, `log_desc`, `log_city_id`, `log_address`) VALUES
(1, 1, 13, 22, 2, '2023-06-25 16:57:12', '2023-06-25 16:57:18', 2, '0000-00-00 00:00:00', NULL, 'Pembuatan sertifikat pertama', 0, ''),
(2, 1, 13, 22, 3, '2023-06-25 16:57:12', '2023-06-25 16:57:20', 2, '2023-06-25 16:57:20', NULL, 'Pembuatan sertifikat pertama', 0, ''),
(3, 2, 13, 20, 2, '2023-06-25 16:59:36', '2023-06-25 17:00:07', 2, '0000-00-00 00:00:00', NULL, 'Sertifikat yang lama rusak', 0, ''),
(4, 3, 13, 19, 2, '2023-06-25 17:00:02', '2023-12-12 08:14:45', 2, '0000-00-00 00:00:00', NULL, 'Permintaan sertifikat dengan desain baru', 0, ''),
(5, 8, 13, 54, 5, '2023-12-15 06:24:28', '2023-12-15 06:29:55', 2, '0000-00-00 00:00:00', 'kendala pengiriman', 'new cert', 0, ''),
(6, 9, 13, 54, 2, '2023-12-15 06:30:27', '2023-12-15 06:30:35', 2, '0000-00-00 00:00:00', NULL, 'pembuatan sertifikat baru', 0, ''),
(7, 9, 13, 54, 3, '2023-12-15 06:30:27', '2023-12-15 06:30:58', 2, '2023-12-15 06:30:58', NULL, 'pembuatan sertifikat baru', 0, ''),
(8, 9, 13, 54, 2, '0000-00-00 00:00:00', '2023-12-15 06:35:52', 2, '2023-12-15 06:30:58', '', 'pembuatan sertifikat baru', 0, ''),
(9, 9, 13, 54, 3, '2023-12-15 06:30:27', '2023-12-15 06:41:53', 2, '2023-12-15 06:41:53', '', 'pembuatan sertifikat baru', 0, ''),
(10, 9, 13, 54, 2, '2023-12-15 06:30:27', '2023-12-15 06:49:40', 2, '2023-12-15 06:41:53', '', 'pembuatan sertifikat baru', 4, 'aceh no. 2 12b 44012'),
(11, 9, 13, 54, 3, '2023-12-15 06:30:27', '2023-12-15 06:49:46', 2, '2023-12-15 06:49:46', '', 'pembuatan sertifikat baru', 4, 'aceh no. 2 12b 44012'),
(12, 9, 13, 54, 6, '0000-00-00 00:00:00', '2023-12-15 06:52:55', 2, '2023-12-15 06:49:46', '', 'pembuatan sertifikat baru', 4, 'aceh no. 2 12b 44012'),
(13, 9, 13, 54, 6, '1970-01-01 00:00:15', '2023-12-15 06:55:06', 2, '2023-12-15 06:49:46', '', 'pembuatan sertifikat baru', 4, 'aceh no. 2 12b 44012'),
(14, 9, 13, 54, 6, '1970-01-01 00:00:15', '2023-12-15 06:55:47', 2, '2023-12-15 06:49:46', '', 'pembuatan sertifikat baru', 4, 'aceh no. 2 12b 44012'),
(15, 9, 13, 54, 6, '2023-12-15 06:30:27', '2023-12-15 06:57:07', 2, '2023-12-15 06:49:46', '', 'pembuatan sertifikat baru', 4, 'aceh no. 2 12b 44012'),
(16, 9, 13, 54, 6, '2023-12-15 06:30:27', '2023-12-15 07:12:17', 2, '2023-12-15 06:49:46', '', 'pembuatan sertifikat baru', 4, 'aceh no. 2 12b 44012'),
(17, 9, 13, 54, 6, '2023-12-15 06:30:27', '2023-12-15 07:13:35', 2, '2023-12-15 06:49:46', '', 'pembuatan sertifikat baru', 4, 'aceh no. 2 12b 44012'),
(18, 9, 13, 54, 6, '2023-12-15 06:30:27', '2023-12-15 07:14:25', 2, '2023-12-15 06:49:46', '', 'pembuatan sertifikat baru', 2, 'daya 2'),
(19, 12, 13, 54, 1, '2023-12-15 08:15:35', '2023-12-15 08:15:35', 2, NULL, '', 'sertifikat baru', 2, 'barat daya 2'),
(20, 13, 13, 54, 2, '2023-12-15 08:16:02', '2023-12-15 08:16:02', 2, NULL, '', 'sertifikat kedua', 5, 'selatan 3'),
(21, 13, 13, 54, 5, '2023-12-15 08:16:02', '2023-12-15 08:16:44', 2, '0000-00-00 00:00:00', 'Terlalu sering meminta sertifikat / Certificate requested too often', 'sertifikat kedua', 5, 'selatan 3'),
(22, 12, 13, 54, 2, '2023-12-15 08:15:35', '2023-12-15 08:17:01', 2, '0000-00-00 00:00:00', '', 'sertifikat baru', 2, 'barat daya 2'),
(23, 12, 13, 54, 3, '2023-12-15 08:15:35', '2023-12-15 08:17:02', 2, '2023-12-15 08:17:02', '', 'sertifikat baru', 2, 'barat daya 2');

-- --------------------------------------------------------

--
-- Table structure for table `logs_req_microchip`
--

CREATE TABLE `logs_req_microchip` (
  `log_id` int(11) NOT NULL,
  `log_req_id` int(11) NOT NULL,
  `log_mem_id` int(11) NOT NULL,
  `log_can_id` int(11) NOT NULL,
  `log_stat_id` int(11) NOT NULL,
  `log_created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `log_updated_at` timestamp NULL DEFAULT NULL,
  `log_updated_by` int(11) DEFAULT NULL,
  `log_datetime` datetime NOT NULL,
  `log_reject_note` text DEFAULT NULL,
  `log_pay_photo` text DEFAULT NULL,
  `log_pay_id` int(11) NOT NULL,
  `log_pay_invoice` varchar(60) DEFAULT NULL,
  `log_pay_due_date` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `logs_req_microchip`
--

INSERT INTO `logs_req_microchip` (`log_id`, `log_req_id`, `log_mem_id`, `log_can_id`, `log_stat_id`, `log_created_at`, `log_updated_at`, `log_updated_by`, `log_datetime`, `log_reject_note`, `log_pay_photo`, `log_pay_id`, `log_pay_invoice`, `log_pay_due_date`) VALUES
(1, 1, 13, 22, 1, '2023-06-25 16:35:36', '2023-06-25 16:50:52', 2, '2023-06-30 11:00:00', NULL, 'payment_1687710936.png', 0, NULL, NULL),
(2, 1, 13, 22, 3, '2023-06-25 16:35:36', '2023-06-25 16:55:41', 2, '2023-06-30 11:00:00', NULL, 'payment_1687710936.png', 0, NULL, NULL),
(3, 3, 13, 19, 1, '2023-06-25 16:58:48', '2023-06-25 16:59:06', 2, '2023-06-27 09:00:00', NULL, 'payment_1687712328.png', 0, NULL, NULL),
(4, 6, 13, 76, 2, '2023-12-18 10:50:34', '2023-12-18 10:50:47', 2, '2023-12-19 00:00:00', 'Tanggal kunjungan tidak disetujui / Appointment date not approved', 'payment_1702896634.png', 0, NULL, NULL),
(5, 8, 13, 76, 1, '2023-12-18 11:39:48', '2023-12-18 11:40:21', 2, '2023-12-19 04:26:00', NULL, '-', 0, NULL, NULL),
(6, 8, 13, 76, 3, '2023-12-18 11:39:48', '2023-12-18 11:44:32', 2, '2023-12-19 04:26:00', NULL, '-', 0, NULL, NULL),
(7, 8, 13, 76, 5, '0000-00-00 00:00:00', '2023-12-18 11:47:37', 2, '2023-12-19 04:26:00', '', '-', 0, NULL, NULL),
(8, 8, 13, 76, 3, '0000-00-00 00:00:00', '2023-12-18 11:47:49', 2, '2023-12-19 04:26:00', '', '-', 0, NULL, NULL),
(9, 8, 13, 76, 1, '0000-00-00 00:00:00', '2023-12-18 11:57:35', 2, '2023-12-19 04:26:00', '', '-', 0, NULL, NULL),
(10, 8, 13, 76, 0, '0000-00-00 00:00:00', '2023-12-18 11:57:40', 2, '2023-12-19 04:26:00', '', '-', 0, NULL, NULL),
(11, 8, 13, 76, 1, '2023-12-18 11:39:48', '2023-12-18 11:57:46', 2, '2023-12-19 04:26:00', '', '-', 2, 'TESCHIP-17262372', '2023-12-18 12:39:48'),
(12, 8, 13, 76, 3, '2023-12-18 11:39:48', '2023-12-18 11:57:54', 2, '2023-12-19 04:26:00', '', '-', 0, NULL, NULL),
(13, 8, 13, 76, 3, '0000-00-00 00:00:00', '2023-12-18 12:00:00', 2, '2023-12-19 04:26:00', '', '-', 2, 'TESCHIP-17262372', '2023-12-18 12:39:48'),
(14, 9, 13, 76, 1, '2023-12-18 12:03:52', '2023-12-18 12:04:22', 2, '2023-12-19 00:00:00', NULL, 'payment_1702901032.png', 1, '-', NULL),
(15, 9, 13, 76, 3, '2023-12-18 12:03:52', '2023-12-18 12:04:32', 2, '2023-12-19 00:00:00', NULL, 'payment_1702901032.png', 1, '-', NULL),
(16, 9, 13, 76, 0, '0000-00-00 00:00:00', '2023-12-18 12:08:17', 2, '2023-12-19 00:00:00', '', 'payment_1702901032.png', 1, '-', NULL),
(18, 11, 13, 9, 0, '2023-12-18 12:31:19', '2023-12-18 12:31:19', 2, '2023-12-19 00:00:00', '', '-', 0, NULL, NULL),
(19, 11, 13, 9, 2, '2023-12-18 12:31:19', '2023-12-18 12:32:40', 2, '2023-12-19 00:00:00', 'pembayaran gagal', '-', 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `logs_stambum`
--

CREATE TABLE `logs_stambum` (
  `log_id` int(11) NOT NULL,
  `log_stb_id` int(11) NOT NULL,
  `log_bir_id` int(11) NOT NULL,
  `log_a_s` varchar(50) NOT NULL,
  `log_gender` varchar(10) NOT NULL,
  `log_photo` text NOT NULL,
  `log_stat` tinyint(4) NOT NULL DEFAULT 1,
  `log_member_id` int(11) NOT NULL,
  `log_app_user` tinyint(4) NOT NULL,
  `log_app_date` timestamp NULL DEFAULT NULL,
  `log_kennel_id` int(11) NOT NULL DEFAULT 0,
  `log_date_of_birth` date NOT NULL,
  `log_breed` varchar(50) NOT NULL,
  `log_date` timestamp NULL DEFAULT NULL,
  `log_user` tinyint(4) NOT NULL,
  `log_can_id` int(11) NOT NULL,
  `log_pay_photo` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `logs_stambum`
--

INSERT INTO `logs_stambum` (`log_id`, `log_stb_id`, `log_bir_id`, `log_a_s`, `log_gender`, `log_photo`, `log_stat`, `log_member_id`, `log_app_user`, `log_app_date`, `log_kennel_id`, `log_date_of_birth`, `log_breed`, `log_date`, `log_user`, `log_can_id`, `log_pay_photo`) VALUES
(1, 1, 1, 'ARIA VON NORTH SANTIAM', 'FEMALE', 'canine_1687696632.png', 1, 4, 2, '2023-06-25 12:37:24', 4, '2023-05-10', 'AMERICAN PIT BULL TERRIER', '2023-06-25 12:37:24', 2, 7, 'payment_1687696632.png'),
(2, 3, 2, 'AQUILA VON NORTH SANTIAM', 'FEMALE', 'canine_1687697458.png', 1, 4, 2, '2023-06-25 12:51:06', 4, '2023-05-05', 'AMERICAN PIT BULL TERRIER', '2023-06-25 12:51:06', 2, 9, 'payment_1687697458.png'),
(3, 2, 2, 'DIONA VON NORTH SANTIAM', 'FEMALE', 'canine_1687697401.png', 1, 4, 2, '2023-06-25 12:51:09', 4, '2023-05-05', 'AMERICAN PIT BULL TERRIER', '2023-06-25 12:51:09', 2, 10, 'payment_1687697401.png'),
(4, 5, 4, 'WILDLINE` HANNAH', 'FEMALE', 'canine_1687734558.png', 1, 13, 2, '2023-06-25 23:09:28', 13, '2023-04-19', 'AMERICAN PIT BULL TERRIER', '2023-06-25 23:09:28', 2, 29, 'payment_1687734558.png'),
(5, 6, 5, 'CASSIUS VON LYNWOOD', 'MALE', 'canine_1687735126.png', 1, 15, 2, '2023-06-25 23:19:57', 15, '2023-04-19', 'AMERICAN PIT BULL TERRIER', '2023-06-25 23:19:57', 2, 31, 'payment_1687735126.png'),
(6, 10, 6, 'WILDLINE` RENGAR', 'MALE', 'canine_1687735579.png', 2, 13, 2, '2023-06-25 23:26:59', 13, '2023-04-20', 'AMERICAN PIT BULL TERRIER', '2023-12-16 05:51:29', 0, 32, 'payment_1687735579.png'),
(7, 9, 6, 'WILDLINE` SANDRA', 'FEMALE', 'canine_1687735552.png', 1, 13, 2, '2023-06-25 23:27:02', 13, '2023-04-20', 'AMERICAN PIT BULL TERRIER', '2023-06-25 23:27:02', 2, 33, 'payment_1687735552.png'),
(8, 12, 9, 'WILDLINE` HADA', 'FEMALE', 'canine_1702441115.png', 1, 13, 2, '2023-12-13 04:18:45', 13, '2023-10-12', 'AMERICAN PIT BULL TERRIER', '2023-12-13 04:18:45', 2, 53, 'payment_1702441115.png'),
(9, 16, 10, 'WILDLINE` FEMALE2', 'FEMALE', 'canine_1702553088.png', 2, 13, 2, '2023-12-14 11:30:43', 13, '2023-10-01', 'AMERICAN PIT BULL TERRIER', '2023-12-14 11:30:43', 2, 0, 'payment_1702553088.png'),
(10, 15, 10, 'WILDLINE` MALE2', 'MALE', 'canine_1702553088.png', 1, 13, 2, '2023-12-14 11:30:48', 13, '2023-10-01', 'AMERICAN PIT BULL TERRIER', '2023-12-14 11:30:48', 2, 60, 'payment_1702553088.png'),
(11, 14, 10, 'WILDLINE` FEMALE1', 'FEMALE', 'canine_1702553088.png', 1, 13, 2, '2023-12-14 11:30:51', 13, '2023-10-01', 'AMERICAN PIT BULL TERRIER', '2023-12-14 11:30:51', 2, 61, 'payment_1702553088.png'),
(12, 13, 10, 'WILDLINE` MALE1', 'MALE', 'canine_1702553088.png', 2, 13, 2, '2023-12-14 11:30:54', 13, '2023-10-01', 'AMERICAN PIT BULL TERRIER', '2023-12-14 11:30:54', 2, 0, 'payment_1702553088.png'),
(13, 19, 10, 'WILDLINE` FEMALE1', 'FEMALE', 'canine_17025554841.png', 1, 13, 2, '2023-12-14 12:04:57', 13, '2023-10-01', 'AMERICAN PIT BULL TERRIER', '2023-12-14 12:04:57', 2, 62, 'payment_1702555484.png'),
(14, 20, 10, 'WILDLINE` MALE1', 'MALE', 'canine_17025554842.png', 1, 13, 2, '2023-12-14 12:04:59', 13, '2023-10-01', 'AMERICAN PIT BULL TERRIER', '2023-12-14 12:04:59', 2, 63, 'payment_1702555484.png'),
(15, 32, 10, 'WILDLINE` ASD', 'MALE', 'canine_17027180301.png', 1, 13, 2, '2023-12-16 09:13:50', 13, '2023-10-01', 'AMERICAN PIT BULL TERRIER', '2023-12-16 09:13:50', 2, 66, '-'),
(16, 33, 10, 'WILDLINE` GOLDEN1', 'FEMALE', 'canine_17027197371.png', 1, 13, 2, '2023-12-16 09:42:17', 13, '2023-10-01', 'AMERICAN PIT BULL TERRIER', '2023-12-16 09:42:17', 2, 67, '-'),
(17, 34, 10, 'WILDLINE` SHEPHERD1', 'MALE', 'canine_17027197372.png', 1, 13, 2, '2023-12-16 09:42:17', 13, '2023-10-01', 'AMERICAN PIT BULL TERRIER', '2023-12-16 09:42:17', 2, 68, '-'),
(18, 35, 10, 'WILDLINE` HUSKY1', 'MALE', 'canine_17027197373.png', 1, 13, 2, '2023-12-16 09:42:17', 13, '2023-10-01', 'AMERICAN PIT BULL TERRIER', '2023-12-16 09:42:17', 2, 69, '-'),
(19, 36, 10, 'WILDLINE` PUG1', 'FEMALE', 'canine_17027197374.png', 1, 13, 2, '2023-12-16 09:42:17', 13, '2023-10-01', 'AMERICAN PIT BULL TERRIER', '2023-12-16 09:42:17', 2, 70, '-'),
(20, 40, 10, 'WILDLINE` GOLDEN1', 'FEMALE', 'canine_17028803994.png', 2, 13, 2, '2023-12-18 06:23:46', 13, '2023-10-01', 'AMERICAN PIT BULL TERRIER', '2023-12-18 06:23:46', 2, 0, '-'),
(21, 39, 10, 'WILDLINE` SHEPHERD1', 'MALE', 'canine_17028803993.png', 1, 13, 2, '2023-12-18 06:23:48', 13, '2023-10-01', 'AMERICAN PIT BULL TERRIER', '2023-12-18 06:23:48', 2, 71, '-'),
(22, 44, 10, 'WILDLINE` GOLDEN2', 'FEMALE', 'canine_17028826184.png', 2, 13, 2, '2023-12-18 06:57:41', 13, '2023-10-01', 'AMERICAN PIT BULL TERRIER', '2023-12-18 06:57:41', 2, 0, '-'),
(23, 43, 10, 'WILDLINE` SHEPHERD2', 'MALE', 'canine_17028826183.png', 2, 13, 2, '2023-12-18 06:57:43', 13, '2023-10-01', 'AMERICAN PIT BULL TERRIER', '2023-12-18 06:57:43', 2, 0, '-'),
(24, 42, 10, 'WILDLINE` HUSKY2', 'MALE', 'canine_17028826182.png', 2, 13, 2, '2023-12-18 06:57:45', 13, '2023-10-01', 'AMERICAN PIT BULL TERRIER', '2023-12-18 06:57:45', 2, 0, '-'),
(25, 41, 10, 'WILDLINE` PUG2', 'FEMALE', 'canine_17028826181.png', 2, 13, 2, '2023-12-18 06:57:47', 13, '2023-10-01', 'AMERICAN PIT BULL TERRIER', '2023-12-18 06:57:47', 2, 0, '-'),
(26, 56, 10, 'WILDLINE` GOLDEN1', 'FEMALE', 'canine_17028874884.png', 2, 13, 2, '2023-12-18 08:18:32', 13, '2023-10-01', 'AMERICAN PIT BULL TERRIER', '2023-12-18 08:18:32', 2, 0, '-'),
(27, 55, 10, 'WILDLINE` SHEP1', 'MALE', 'canine_17028874883.png', 1, 13, 2, '2023-12-18 08:18:34', 13, '2023-10-01', 'AMERICAN PIT BULL TERRIER', '2023-12-18 08:18:34', 2, 72, '-'),
(28, 54, 10, 'WILDLINE` WOLF1', 'MALE', 'canine_17028874882.png', 1, 13, 2, '2023-12-18 08:18:37', 13, '2023-10-01', 'AMERICAN PIT BULL TERRIER', '2023-12-18 08:18:37', 2, 73, '-'),
(29, 53, 10, 'WILDLINE` PUG1', 'FEMALE', 'canine_17028874881.png', 1, 13, 2, '2023-12-18 08:18:39', 13, '2023-10-01', 'AMERICAN PIT BULL TERRIER', '2023-12-18 08:18:39', 2, 74, '-'),
(30, 55, 10, 'WILDLINE` SHEP1', 'MALE', 'canine_17028874883.png', 2, 13, 2, '2023-12-18 08:21:02', 13, '2023-10-01', 'AMERICAN PIT BULL TERRIER', '2023-12-18 08:21:02', 2, 72, '-'),
(31, 54, 10, 'WILDLINE` WOLF1', 'MALE', 'canine_17028874882.png', 2, 13, 2, '2023-12-18 08:21:10', 13, '2023-10-01', 'AMERICAN PIT BULL TERRIER', '2023-12-18 08:21:10', 2, 73, '-'),
(32, 53, 10, 'WILDLINE` PUG1', 'FEMALE', 'canine_17028874881.png', 7, 13, 2, '2023-12-18 08:26:09', 13, '2023-10-01', 'AMERICAN PIT BULL TERRIER', '2023-12-18 08:26:09', 2, 74, '-'),
(33, 53, 10, 'WILDLINE` PUG1', 'FEMALE', 'canine_17028874881.png', 7, 13, 2, '2023-12-18 08:28:25', 13, '2023-10-01', 'AMERICAN PIT BULL TERRIER', '2023-12-18 08:28:25', 2, 74, '-'),
(34, 12, 9, 'WILDLINE` HADA', 'FEMALE', 'canine_1702441115.png', 7, 13, 2, '2023-12-18 08:54:22', 13, '2023-10-12', 'AMERICAN PIT BULL TERRIER', '2023-12-18 08:54:22', 2, 53, 'payment_1702441115.png'),
(35, 58, 10, 'WILDLINE` PUG2', 'MALE', 'canine_17028907522.png', 2, 13, 2, '2023-12-18 09:14:29', 13, '2023-10-01', 'AMERICAN PIT BULL TERRIER', '2023-12-18 09:14:29', 2, 0, 'payment_1702890752.png'),
(36, 57, 10, 'WILDLINE` SHEP2', 'MALE', 'canine_17028907521.png', 2, 13, 2, '2023-12-18 09:14:32', 13, '2023-10-01', 'AMERICAN PIT BULL TERRIER', '2023-12-18 09:14:32', 2, 0, 'payment_1702890752.png'),
(37, 60, 10, 'WILDLINE` GAR3', 'FEMALE', 'canine_17028909092.png', 1, 13, 2, '2023-12-18 09:15:33', 13, '2023-10-01', 'AMERICAN PIT BULL TERRIER', '2023-12-18 09:15:33', 2, 75, '-'),
(38, 59, 10, 'WILDLINE` HAR2', 'FEMALE', 'canine_17028909091.png', 1, 13, 2, '2023-12-18 09:15:35', 13, '2023-10-01', 'AMERICAN PIT BULL TERRIER', '2023-12-18 09:15:35', 2, 76, '-'),
(39, 62, 11, 'WILDLINE` TATIANA', 'MALE', 'canine_17029078942.png', 1, 13, 2, '2023-12-18 13:58:35', 13, '2023-10-24', 'AMERICAN PIT BULL TERRIER', '2023-12-18 13:58:35', 2, 78, '-'),
(40, 61, 11, 'WILDLINE` KENGO', 'MALE', 'canine_17029078941.png', 1, 13, 2, '2023-12-18 13:58:37', 13, '2023-10-24', 'AMERICAN PIT BULL TERRIER', '2023-12-18 13:58:37', 2, 79, '-');

-- --------------------------------------------------------

--
-- Table structure for table `logs_stud`
--

CREATE TABLE `logs_stud` (
  `log_id` int(11) NOT NULL,
  `log_stu_id` int(11) NOT NULL,
  `log_sire_id` int(11) NOT NULL,
  `log_sire_photo` text NOT NULL,
  `log_dam_id` int(11) NOT NULL,
  `log_dam_photo` text NOT NULL,
  `log_stud_date` date NOT NULL,
  `log_app_user` int(4) NOT NULL,
  `log_app_date` timestamp NULL DEFAULT NULL,
  `log_photo` text NOT NULL,
  `log_stat` tinyint(4) NOT NULL DEFAULT 0,
  `log_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `log_user` tinyint(4) NOT NULL,
  `log_member_id` int(11) NOT NULL,
  `log_partner_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `logs_stud`
--

INSERT INTO `logs_stud` (`log_id`, `log_stu_id`, `log_sire_id`, `log_sire_photo`, `log_dam_id`, `log_dam_photo`, `log_stud_date`, `log_app_user`, `log_app_date`, `log_photo`, `log_stat`, `log_date`, `log_user`, `log_member_id`, `log_partner_id`) VALUES
(1, 1, 3, 'sire_1687696407.png', 5, 'dam_1687696407.png', '2023-04-27', 2, '2023-06-25 12:33:34', 'stud_1687696407.png', 1, '2023-06-25 12:33:34', 2, 2, 4),
(2, 2, 8, 'sire_1687697008.png', 7, 'dam_1687697008.png', '2023-04-20', 2, '2023-06-25 12:43:50', 'stud_1687697008.png', 1, '2023-06-25 12:43:50', 2, 6, 4),
(3, 3, 26, 'sire_1687705861.png', 16, 'dam_1687705861.png', '2023-04-27', 2, '2023-06-25 15:12:28', 'stud_1687705861.png', 1, '2023-06-25 15:12:28', 2, 14, 13),
(4, 4, 24, 'sire_1687706249.png', 14, 'dam_1687706249.png', '2023-03-01', 2, '2023-06-25 15:17:41', 'stud_1687706249.png', 1, '2023-06-25 15:17:41', 2, 14, 13),
(5, 5, 28, 'sire_1687734285.png', 9, 'dam_1687734285.png', '2023-04-21', 2, '2023-06-25 23:04:56', 'stud_1687734285.png', 1, '2023-06-25 23:04:56', 2, 15, 13),
(6, 6, 25, 'sire_1687734953.png', 30, 'dam_1687734953.png', '2023-04-13', 2, '2023-06-25 23:16:02', 'stud_1687734953.png', 1, '2023-06-25 23:16:02', 2, 14, 15),
(7, 7, 31, 'sire_1687735466.png', 29, 'dam_1687735466.png', '2023-04-19', 2, '2023-06-25 23:24:31', 'stud_1687735466.png', 1, '2023-06-25 23:24:31', 2, 15, 13),
(8, 8, 34, 'sire_1687736403.png', 35, 'dam_1687736403.png', '2023-04-18', 2, '2023-06-25 23:40:56', 'stud_1687736403.png', 1, '2023-06-25 23:40:56', 2, 13, 13),
(9, 9, 36, 'sire_1687736902.png', 33, 'dam_1687736902.png', '2023-04-19', 2, '2023-06-25 23:48:32', 'stud_1687736902.png', 1, '2023-06-25 23:48:32', 2, 6, 13),
(10, 10, 38, 'sire_1687738065.png', 37, 'dam_1687738065.png', '2023-04-21', 2, '2023-06-26 00:07:52', 'stud_1687738065.png', 1, '2023-06-26 00:07:52', 2, 15, 15),
(11, 12, 52, 'sire_1702440956.png', 33, 'dam_1702440956.png', '2023-12-12', 2, '2023-12-13 04:16:46', 'stud_1702440956.png', 1, '2023-12-13 04:16:46', 2, 13, 13),
(12, 12, 52, 'sire_1702440956.png', 33, 'dam_1702440956.png', '2023-10-12', 0, NULL, 'stud_1702440956.png', 0, '2023-12-13 04:17:18', 2, 0, 13),
(13, 13, 52, 'sire_1702532448.png', 29, 'dam_1702532448.png', '2023-12-13', 2, '2023-12-14 05:40:55', 'stud_1702532448.png', 1, '2023-12-14 05:40:55', 2, 13, 13),
(14, 13, 52, 'sire_1702532448.png', 29, 'dam_1702532448.png', '2023-10-11', 0, NULL, 'stud_1702532448.png', 0, '2023-12-14 05:41:03', 2, 0, 13),
(15, 12, 52, 'sire_1702440956.png', 33, 'dam_1702440956.png', '2023-10-12', 0, NULL, 'stud_1702440956.png', 7, '2023-12-18 08:43:23', 2, 0, 0),
(16, 13, 0, '', 0, '', '0000-00-00', 0, NULL, '', 1, '2023-12-18 08:49:43', 2, 0, 0),
(17, 14, 77, 'sire_1702907155.png', 33, 'dam_1702907155.png', '2023-12-17', 2, '2023-12-18 13:46:13', 'stud_1702907155.png', 1, '2023-12-18 13:46:13', 2, 39, 13),
(18, 14, 77, 'sire_1702907155.png', 33, 'dam_1702907155.png', '2023-10-18', 0, NULL, 'stud_1702907155.png', 0, '2023-12-18 13:46:31', 2, 0, 13),
(19, 14, 77, 'sire_1702907155.png', 33, 'dam_1702907155.png', '2023-10-18', 0, NULL, 'stud_1702907155.png', 0, '2023-12-18 13:46:31', 2, 0, 13);

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE `members` (
  `mem_id` int(11) NOT NULL,
  `mem_name` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `mem_address` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `mem_mail_address` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `mem_hp` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `mem_created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `mem_stat` int(4) NOT NULL,
  `mem_app_user` int(4) NOT NULL,
  `mem_app_date` timestamp NULL DEFAULT NULL,
  `mem_username` varchar(50) NOT NULL,
  `mem_password` varchar(255) NOT NULL,
  `mem_email` varchar(50) NOT NULL,
  `mem_pp` varchar(255) NOT NULL,
  `mem_kota` varchar(50) NOT NULL,
  `mem_kode_pos` varchar(10) NOT NULL,
  `mem_ktp` varchar(30) NOT NULL,
  `mem_payment_date` date DEFAULT NULL,
  `mem_type` int(11) NOT NULL,
  `mem_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `mem_user` tinyint(4) NOT NULL,
  `last_login` datetime NOT NULL,
  `mem_app_note` text NOT NULL,
  `mem_pay_id` int(11) NOT NULL,
  `mem_pay_photo` text NOT NULL,
  `mem_pay_invoice` varchar(60) DEFAULT NULL,
  `mem_pay_due_date` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`mem_id`, `mem_name`, `mem_address`, `mem_mail_address`, `mem_hp`, `mem_created_at`, `mem_stat`, `mem_app_user`, `mem_app_date`, `mem_username`, `mem_password`, `mem_email`, `mem_pp`, `mem_kota`, `mem_kode_pos`, `mem_ktp`, `mem_payment_date`, `mem_type`, `mem_date`, `mem_user`, `last_login`, `mem_app_note`, `mem_pay_id`, `mem_pay_photo`, `mem_pay_invoice`, `mem_pay_due_date`) VALUES
(1, 'NO MEMBER', '-', '-', '-', '2021-07-26 00:35:10', 1, 0, NULL, 'super', '8451ba8a14d79753d34cb33b51ba46b4b025eb81', '-', 'member_16315411401.jpeg', '-', '-', '', '2023-01-08', 0, '2023-02-10 05:51:21', 0, '2023-06-25 14:04:04', '', 0, '', NULL, NULL),
(2, 'ADIANTO WIJAYA', 'Jl Cikutra 99', 'Jl Cikutra 99', '081299396401', '2023-04-01 09:44:47', 1, 2, '2023-06-25 09:50:55', 'adianto', 'b24eafac238c7f103e41cbb8855e8f26902ad35d', 'adianto@gmail.com', 'member_1687686287.png', 'Bandung', '40111', '3525015201880002', '2024-06-25', 1, '2023-06-25 09:50:55', 2, '2023-12-17 20:52:52', '', 0, 'payment_1687686287.png', NULL, NULL),
(3, 'ELMA OKTAVIANI', '', '', '081299396402', '2023-05-02 10:37:12', 1, 0, NULL, 'elma@gmail.com', 'f480d5fb395cc04f56b06a51e14452d3e3e945b5', 'elma@gmail.com', '', '', '', '', NULL, 0, '2023-06-25 10:37:12', 1, '2023-06-27 06:31:22', '', 0, '', NULL, NULL),
(4, 'OLIVIA AGUSTINA', 'JL. Gatot Subroto No 283A', 'JL. Gatot Subroto No 283A', '081299396403', '2023-06-25 10:47:28', 1, 2, '2023-06-25 10:47:37', 'olivia', '5cc9dc7fa726d8d8cfa53f899984125409090863', 'olivia@gmail.com', 'member_1687690048.png', 'Bandung', '40112', '3525010510930001', '2024-06-25', 1, '2023-06-25 10:47:37', 2, '2023-09-11 09:49:11', '', 0, 'payment_1687690048.png', NULL, NULL),
(5, 'ZAHRA PUSPASARI', '', '', '081299396404', '2023-06-25 10:49:29', 1, 0, NULL, 'zahra@gmail.com', '44af0c766ab9ee7785f5234c88a9febe97ae19b1', 'zahra@gmail.com', '', '', '', '', NULL, 0, '2023-06-25 10:49:29', 1, '2023-06-25 17:49:39', '', 0, '', NULL, NULL),
(6, 'DIMAS SIHOMBING', 'Jl Jend Gatot Subroto 44', 'Jl Jend Gatot Subroto 44', '081299396500', '2023-06-25 10:54:08', 1, 2, '2023-06-25 10:54:15', 'dimas', 'b11d0a950e8a6485ca742a48b7eacbbe7ffdd979', 'dimas@gmail.com', 'member_1687690448.png', 'Jakarta', '12710', '3525016005650004', '2024-06-25', 1, '2023-06-25 10:54:15', 2, '2023-06-26 06:44:16', '', 0, 'payment_1687690448.png', NULL, NULL),
(7, 'CAHYADI MAULANA', '', '', '081299396700', '2021-04-01 11:06:05', 1, 0, NULL, 'cahyadi@gmail.com', '4253eb324d01d1c538e92951c1cfac6dc2d65baf', 'cahyadi@gmail.com', '', '', '', '', NULL, 0, '2023-06-25 11:06:05', 1, '2023-06-25 18:06:14', '', 0, '', NULL, NULL),
(8, 'ARTANTO JANUAR', '', '', '081299396701', '2022-03-01 11:07:59', 1, 0, NULL, 'artanto@gmail.com', 'b65817acf6b04e1d1fce418de31ced9f362d41a3', 'artanto@gmail.com', '', '', '', '', NULL, 0, '2023-06-25 11:07:59', 1, '0000-00-00 00:00:00', '', 0, '', NULL, NULL),
(9, 'KAMARIA RIYANTI', '', '', '081299396702', '2022-08-11 11:08:55', 1, 0, NULL, 'riyanti223@gmail.com', '88cae9f37615b8881e65ff92b78a2ae5bccd1baa', 'riyanti223@gmail.com', '', '', '', '', NULL, 0, '2023-06-25 11:08:55', 1, '0000-00-00 00:00:00', '', 0, '', NULL, NULL),
(10, 'MILA MULYANI', 'Jl Adi Sucipto 68, Dandangan', 'Jl Adi Sucipto 68, Dandangan', '081299396410', '2022-08-06 11:14:21', 1, 2, '2023-06-25 11:14:29', 'mila20', '5be87182cbc1a50a297ff6c246097ad223c8846e', 'mila20@gmail.com', 'member_1687691661.png', 'Kediri', '64131', '3525015306780002', '2024-06-25', 1, '2023-06-25 11:14:29', 2, '2023-06-25 21:26:13', '', 0, 'payment_1687691661.png', NULL, NULL),
(11, 'KEISHA YULIARTI', 'Ds. Lumban Tobing No. 541', 'Ds. Lumban Tobing No. 541', '076345210414', '2023-01-05 11:22:36', 0, 0, NULL, 'keishaa55', '356ccc1dc1de816943567ef1a75b688016bcccde', 'keishaa55@gmail.com', 'member_1687692156.png', 'Palu', '47409', '3525016501830002', NULL, 1, '2023-06-25 11:22:36', 1, '0000-00-00 00:00:00', '', 0, 'payment_1687692156.png', NULL, NULL),
(12, 'ASIRWADA MUSTOFA', 'Ki. Siliwangi No. 131', 'Ki. Siliwangi No. 131', '064772866468', '2023-01-11 11:28:13', 0, 0, NULL, 'asirwada', '5fb54df2022244c5ee635cddcff90eb93d982165', 'asirwada@gmail.com', 'member_1687692493.png', 'Banjar', '33984', '3525011506830001', NULL, 1, '2023-06-25 11:28:13', 1, '0000-00-00 00:00:00', '', 0, 'payment_1687692493.png', NULL, NULL),
(13, 'LIMAN IRAWAN', 'Ki. Suniaraja No. 296', 'Ki. Suniaraja No. 296', '09707237904', '2023-05-02 14:40:08', 1, 2, '2023-06-25 14:40:14', 'liman', '31245660e8fa3bc5be3098b5be5ede128ebe6a8d', 'liman@gmail.com', 'member_1687704008.png', 'Serang', '88190', '3525017006620060', '2024-06-25', 1, '2023-06-25 14:40:14', 2, '2023-12-18 20:59:12', '', 0, 'payment_1687704008.png', NULL, NULL),
(14, 'GERALD HARTANTO', 'Kpg. Pasteur No. 256', 'Kpg. Pasteur No. 256', '02682641016', '2023-06-25 15:03:08', 1, 2, '2023-06-25 15:03:13', 'gerald', '446f6fe420322ac611e4621119ab11e5a51daf2f', 'gerald@gmail.com', 'member_1687705388.png', 'Banjarbaru', '80961', '3525017006950028', '2024-06-25', 1, '2023-06-25 15:03:13', 2, '2023-06-26 06:44:00', '', 0, 'payment_1687705388.png', NULL, NULL),
(15, 'TIARA RAHMAWATI', 'Jln. Wahidin Sudirohusodo No. 580', 'Jln. Wahidin Sudirohusodo No. 580', '036465953548', '2023-03-08 22:57:21', 1, 2, '2023-06-25 22:57:28', 'tiara', 'c35bf6e2b2bc7397ff9f2321c39ecabd9043f671', 'tiara@gmail.com', 'member_1687733840.png', 'Gorontalo', '60553', '3326161808790021', '2024-06-26', 1, '2023-06-25 22:57:28', 2, '2023-06-26 06:56:16', '', 0, 'payment_1687733840.png', NULL, NULL),
(39, 'THEO CAMPBELL', 'Ds. Yoga No. 932, Tegal 59830, JaTeng', 'Ds. Yoga No. 932, Tegal 59830, JaTeng', '08244842670003', '2023-12-18 13:38:33', 1, 2, '2023-12-18 13:39:36', 'theo', 'cf91a9cfe0882326bc9e5276dcdb1cce8cbef4ce', 'theocamp@gmail.com', 'member_1702906713.png', 'Kabupaten Tegal', '59830', '5494687012040459', '2024-12-18', 1, '2023-12-18 13:39:36', 2, '2023-12-18 20:59:42', '', 2, '-', 'TESMB-43313890', '2023-12-18 14:38:33');

-- --------------------------------------------------------

--
-- Table structure for table `member_type`
--

CREATE TABLE `member_type` (
  `mem_type_id` int(11) NOT NULL,
  `mem_type_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `member_type`
--

INSERT INTO `member_type` (`mem_type_id`, `mem_type_name`) VALUES
(0, 'Free'),
(1, 'Pro');

-- --------------------------------------------------------

--
-- Table structure for table `microchip_complain`
--

CREATE TABLE `microchip_complain` (
  `com_id` int(11) NOT NULL,
  `com_req_id` int(11) NOT NULL,
  `com_photo` text NOT NULL,
  `com_desc` text NOT NULL,
  `com_created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `microchip_complain`
--

INSERT INTO `microchip_complain` (`com_id`, `com_req_id`, `com_photo`, `com_desc`, `com_created_at`) VALUES
(2, 8, '-', 'tidak diupdate2', '2023-12-18 11:47:57');

-- --------------------------------------------------------

--
-- Table structure for table `microchip_status`
--

CREATE TABLE `microchip_status` (
  `micro_stat_id` int(11) NOT NULL,
  `micro_stat_name` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `microchip_status`
--

INSERT INTO `microchip_status` (`micro_stat_id`, `micro_stat_name`) VALUES
(0, 'Diproses / Processed'),
(1, 'Disetujui / Accepted'),
(2, 'Ditolak / Rejected'),
(3, 'Dipasang / Implanted'),
(4, 'Dibatalkan / Cancelled'),
(5, 'Selesai / Completed'),
(6, 'Dikomplain / Complained'),
(7, 'Belum dibayar / Not yet paid'),
(8, 'Pembayaran gagal / Payment failed');

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `news_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp(),
  `stat` tinyint(4) NOT NULL DEFAULT 1,
  `type` tinyint(4) NOT NULL,
  `photo` text NOT NULL,
  `trans_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`news_id`, `title`, `description`, `date`, `stat`, `type`, `photo`, `trans_id`) VALUES
(1, 'Pacak / Bred AMERICAN PIT BULL TERRIER', 'Telah dilakukan pacak oleh ADIANTO WIJAYA (GREAT POINT) pada tanggal 27-04-2023 antara GREAT POINT` EDGAR dan DELPHIE VON NORTH SANTIAM<br><hr>ADIANTO WIJAYA (GREAT POINT) has bred on 27-04-2023 between GREAT POINT` EDGAR and DELPHIE VON NORTH SANTIAM', '2023-04-27 00:00:00', 2, 1, 'stud_1687696407.png', 1),
(2, 'Lahir / Birth AMERICAN PIT BULL TERRIER', 'Telah lahir 2 jantan dan 2 betina pada tanggal 25-06-2023. Hubungi OLIVIA AGUSTINA (NORTH SANTIAM) untuk informasi lebih lanjut<br><hr>2 male(s) and 2 female(s) was/were born on 25-06-2023. Contact OLIVIA AGUSTINA (NORTH SANTIAM) for more information', '2023-06-25 00:00:00', 1, 2, 'birth_1687696501.png', 1),
(3, 'Pacak / Bred AMERICAN PIT BULL TERRIER', 'Telah dilakukan pacak oleh DIMAS SIHOMBING (SCHAFFER RIDGE) pada tanggal 20-04-2023 antara SCHAFFER RIDGE` ROCKY dan ARIA VON NORTH SANTIAM<br><hr>DIMAS SIHOMBING (SCHAFFER RIDGE) has bred on 20-04-2023 between SCHAFFER RIDGE` ROCKY and ARIA VON NORTH SANTIAM', '2023-04-20 00:00:00', 2, 1, 'stud_1687697008.png', 2),
(4, 'Lahir / Birth AMERICAN PIT BULL TERRIER', 'Telah lahir 2 betina pada tanggal 25-06-2023. Hubungi OLIVIA AGUSTINA (NORTH SANTIAM) untuk informasi lebih lanjut<br><hr>2 female(s) was/were born on 25-06-2023. Contact OLIVIA AGUSTINA (NORTH SANTIAM) for more information', '2023-06-25 00:00:00', 1, 2, 'birth_1687697138.png', 2),
(5, 'Pacak / Bred GIANT POODLE', 'Telah dilakukan pacak oleh GERALD HARTANTO (MAYFLOWER) pada tanggal 27-04-2023 antara MAYFLOWER` JAMES dan WILDLINE` TRISTANA<br><hr>GERALD HARTANTO (MAYFLOWER) has bred on 27-04-2023 between MAYFLOWER` JAMES and WILDLINE` TRISTANA', '2023-04-27 00:00:00', 1, 1, 'stud_1687705861.png', 3),
(6, 'Pacak / Bred DESIGNER BULLY', 'Telah dilakukan pacak oleh GERALD HARTANTO (MAYFLOWER) pada tanggal 01-03-2023 antara MAYFLOWER` JOE dan WILDLINE` CAROL<br><hr>GERALD HARTANTO (MAYFLOWER) has bred on 01-03-2023 between MAYFLOWER` JOE and WILDLINE` CAROL', '2023-03-01 00:00:00', 2, 1, 'stud_1687706249.png', 4),
(7, 'Lahir / Birth DESIGNER BULLY', 'Telah lahir 2 jantan dan 1 betina pada tanggal 10-05-2023. Hubungi LIMAN IRAWAN (WILDLINE) untuk informasi lebih lanjut<br><hr>2 male(s) and 1 female(s) was/were born on 10-05-2023. Contact LIMAN IRAWAN (WILDLINE) for more information', '2023-05-10 00:00:00', 1, 2, 'birth_1687706450.png', 3),
(8, 'Pacak / Bred AMERICAN PIT BULL TERRIER', 'Telah dilakukan pacak oleh TIARA RAHMAWATI (LYNWOOD) pada tanggal 21-04-2023 antara JACKSON VON LYNWOOD dan WILDLINE` AQUILA<br><hr>TIARA RAHMAWATI (LYNWOOD) has bred on 21-04-2023 between JACKSON VON LYNWOOD and WILDLINE` AQUILA', '2023-04-21 00:00:00', 2, 1, 'stud_1687734285.png', 5),
(9, 'Lahir / Birth AMERICAN PIT BULL TERRIER', 'Telah lahir 1 jantan dan 1 betina pada tanggal 26-06-2023. Hubungi LIMAN IRAWAN (WILDLINE) untuk informasi lebih lanjut<br><hr>1 male(s) and 1 female(s) was/were born on 26-06-2023. Contact LIMAN IRAWAN (WILDLINE) for more information', '2023-06-26 00:00:00', 1, 2, 'birth_1687734352.png', 4),
(10, 'Pacak / Bred AMERICAN PIT BULL TERRIER', 'Telah dilakukan pacak oleh GERALD HARTANTO (MAYFLOWER) pada tanggal 13-04-2023 antara MAYFLOWER` LEVINE dan SABRINA VON LYNWOOD<br><hr>GERALD HARTANTO (MAYFLOWER) has bred on 13-04-2023 between MAYFLOWER` LEVINE and SABRINA VON LYNWOOD', '2023-04-13 00:00:00', 2, 1, 'stud_1687734953.png', 6),
(11, 'Lahir / Birth AMERICAN PIT BULL TERRIER', 'Telah lahir 1 jantan dan 2 betina pada tanggal 26-06-2023. Hubungi TIARA RAHMAWATI (LYNWOOD) untuk informasi lebih lanjut<br><hr>1 male(s) and 2 female(s) was/were born on 26-06-2023. Contact TIARA RAHMAWATI (LYNWOOD) for more information', '2023-06-26 00:00:00', 1, 2, 'birth_1687735023.png', 5),
(12, 'Pacak / Bred AMERICAN PIT BULL TERRIER', 'Telah dilakukan pacak oleh TIARA RAHMAWATI (LYNWOOD) pada tanggal 19-04-2023 antara CASSIUS VON LYNWOOD dan WILDLINE` HANNAH<br><hr>TIARA RAHMAWATI (LYNWOOD) has bred on 19-04-2023 between CASSIUS VON LYNWOOD and WILDLINE` HANNAH', '2023-04-19 00:00:00', 2, 1, 'stud_1687735466.png', 7),
(13, 'Lahir / Birth AMERICAN PIT BULL TERRIER', 'Telah lahir 1 jantan dan 2 betina pada tanggal 25-06-2023. Hubungi LIMAN IRAWAN (WILDLINE) untuk informasi lebih lanjut<br><hr>1 male(s) and 2 female(s) was/were born on 25-06-2023. Contact LIMAN IRAWAN (WILDLINE) for more information', '2023-06-25 00:00:00', 1, 2, 'birth_1687735502.png', 6),
(15, 'Pacak / Bred AMERICAN PIT BULL TERRIER', 'Telah dilakukan pacak oleh DIMAS SIHOMBING (SCHAFFER RIDGE) pada tanggal 19-04-2023 antara SCHAFFER RIDGE` WAYNE dan WILDLINE` SANDRA<br><hr>DIMAS SIHOMBING (SCHAFFER RIDGE) has bred on 19-04-2023 between SCHAFFER RIDGE` WAYNE and WILDLINE` SANDRA', '2023-04-19 00:00:00', 2, 1, 'stud_1687736902.png', 9),
(16, 'Lahir / Birth AMERICAN PIT BULL TERRIER', 'Telah lahir 2 jantan dan 2 betina pada tanggal 19-04-2023. Hubungi LIMAN IRAWAN (WILDLINE) untuk informasi lebih lanjut<br><hr>2 male(s) and 2 female(s) was/were born on 19-04-2023. Contact LIMAN IRAWAN (WILDLINE) for more information', '2023-04-19 00:00:00', 1, 2, 'birth_1687736955.png', 7),
(17, 'Pacak / Bred GIANT POODLE', 'Telah dilakukan pacak oleh TIARA RAHMAWATI (LYNWOOD) pada tanggal 21-04-2023 antara CLYDE VON LYNWOOD dan YUNA VON LYNWOOD<br><hr>TIARA RAHMAWATI (LYNWOOD) has bred on 21-04-2023 between CLYDE VON LYNWOOD and YUNA VON LYNWOOD', '2023-04-21 00:00:00', 2, 1, 'stud_1687738065.png', 10),
(18, 'Lahir / Birth GIANT POODLE', 'Telah lahir 1 jantan dan 1 betina pada tanggal 25-06-2023. Hubungi TIARA RAHMAWATI (LYNWOOD) untuk informasi lebih lanjut<br><hr>1 male(s) and 1 female(s) was/were born on 25-06-2023. Contact TIARA RAHMAWATI (LYNWOOD) for more information', '2023-06-25 00:00:00', 1, 2, 'birth_1687738101.png', 8),
(19, 'Pacak / Bred AMERICAN PIT BULL TERRIER', 'Telah dilakukan pacak oleh LIMAN IRAWAN (WILDLINE) pada tanggal 12-12-2023 antara WILDLINE` TESUPLOAD dan WILDLINE` SANDRA<br><hr>LIMAN IRAWAN (WILDLINE) has bred on 12-12-2023 between WILDLINE` TESUPLOAD and WILDLINE` SANDRA', '2023-12-12 00:00:00', 2, 1, 'stud_1702440956.png', 12),
(21, 'Pacak / Bred AMERICAN PIT BULL TERRIER', 'Telah dilakukan pacak oleh LIMAN IRAWAN (WILDLINE) pada tanggal 13-12-2023 antara WILDLINE` TESUPLOAD dan WILDLINE` HANNAH<br><hr>LIMAN IRAWAN (WILDLINE) has bred on 13-12-2023 between WILDLINE` TESUPLOAD and WILDLINE` HANNAH', '2023-12-13 00:00:00', 2, 1, 'stud_1702532448.png', 13),
(22, 'Pacak / Bred AMERICAN PIT BULL TERRIER', 'Telah dilakukan pacak oleh THEO CAMPBELL (LOWBRAD) pada tanggal 17-12-2023 antara JONATHAN VON LOWBRAD dan WILDLINE` SANDRA<br><hr>THEO CAMPBELL (LOWBRAD) has bred on 17-12-2023 between JONATHAN VON LOWBRAD and WILDLINE` SANDRA', '2023-12-17 00:00:00', 2, 1, 'stud_1702907155.png', 14),
(23, 'Lahir / Birth AMERICAN PIT BULL TERRIER', 'Telah lahir 2 jantan dan 3 betina pada tanggal 17-12-2023. Hubungi LIMAN IRAWAN (WILDLINE) untuk informasi lebih lanjut<br><hr>2 male(s) and 3 female(s) was/were born on 17-12-2023. Contact LIMAN IRAWAN (WILDLINE) for more information', '2023-12-17 00:00:00', 1, 2, 'birth_1702907407.png', 11);

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

CREATE TABLE `notification` (
  `notification_id` int(11) NOT NULL,
  `notificationtype_id` tinyint(4) NOT NULL,
  `transaction_id` int(11) NOT NULL,
  `created_date` datetime NOT NULL,
  `mem_id` int(11) NOT NULL,
  `note` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `notification`
--

INSERT INTO `notification` (`notification_id`, `notificationtype_id`, `transaction_id`, `created_date`, `mem_id`, `note`) VALUES
(1, 17, 2, '2023-06-25 16:50:55', 2, ''),
(2, 17, 4, '2023-06-25 17:47:37', 4, ''),
(3, 17, 6, '2023-06-25 17:54:15', 6, ''),
(4, 17, 10, '2023-06-25 18:14:29', 10, ''),
(5, 11, 3, '2023-06-25 18:55:21', 2, 'Nama anjing / Canine name: GREAT POINT` EDGAR'),
(6, 11, 4, '2023-06-25 18:58:04', 2, 'Nama anjing / Canine name: GREAT POINT` ARANDA'),
(7, 11, 5, '2023-06-25 19:02:07', 4, 'Nama anjing / Canine name: DELPHIE VON NORTH SANTIAM'),
(8, 11, 6, '2023-06-25 19:02:56', 4, 'Nama anjing / Canine name: LIONEL VON NORTH SANTIAM'),
(9, 1, 1, '2023-06-25 19:33:34', 2, 'Nama jantan / Sire name: GREAT POINT` EDGAR<br>Nama betina / Dam name: DELPHIE VON NORTH SANTIAM'),
(10, 1, 1, '2023-06-25 19:33:34', 4, 'Nama jantan / Sire name: GREAT POINT` EDGAR<br>Nama betina / Dam name: DELPHIE VON NORTH SANTIAM<br><a class=\"text-reset link-warning\" href=\"http://localhost/icrpedigree/frontend/Births/add/1\">Lapor Lahir / Birth Report</a>'),
(11, 2, 1, '2023-06-25 19:35:08', 2, 'Nama Jantan / Sire Name: GREAT POINT` EDGAR<br>Nama Betina / Dam Name: DELPHIE VON NORTH SANTIAM'),
(12, 2, 1, '2023-06-25 19:35:08', 4, 'Nama Jantan / Sire Name: GREAT POINT` EDGAR<br>Nama Betina / Dam Name: DELPHIE VON NORTH SANTIAM<br><a class=\"text-reset link-warning\" href=\"http://localhost/icrpedigree/frontend/Stambums/add/1\">Lapor Anak / Puppy Report</a>'),
(13, 4, 1, '2023-06-25 19:37:24', 4, 'Nama anjing / Canine name: ARIA VON NORTH SANTIAM<br>Nama jantan / Sire name: GREAT POINT` EDGAR<br>Nama betina / Dam name: DELPHIE VON NORTH SANTIAM'),
(14, 11, 8, '2023-06-25 19:40:21', 6, 'Nama anjing / Canine name: SCHAFFER RIDGE` ROCKY'),
(15, 1, 2, '2023-06-25 19:43:50', 6, 'Nama jantan / Sire name: SCHAFFER RIDGE` ROCKY<br>Nama betina / Dam name: ARIA VON NORTH SANTIAM'),
(16, 1, 2, '2023-06-25 19:43:50', 4, 'Nama jantan / Sire name: SCHAFFER RIDGE` ROCKY<br>Nama betina / Dam name: ARIA VON NORTH SANTIAM<br><a class=\"text-reset link-warning\" href=\"http://localhost/icrpedigree/frontend/Births/add/2\">Lapor Lahir / Birth Report</a>'),
(17, 2, 2, '2023-06-25 19:45:43', 6, 'Nama Jantan / Sire Name: SCHAFFER RIDGE` ROCKY<br>Nama Betina / Dam Name: ARIA VON NORTH SANTIAM'),
(18, 2, 2, '2023-06-25 19:45:43', 4, 'Nama Jantan / Sire Name: SCHAFFER RIDGE` ROCKY<br>Nama Betina / Dam Name: ARIA VON NORTH SANTIAM<br><a class=\"text-reset link-warning\" href=\"http://localhost/icrpedigree/frontend/Stambums/add/2\">Lapor Anak / Puppy Report</a>'),
(19, 4, 3, '2023-06-25 19:51:06', 4, 'Nama anjing / Canine name: AQUILA VON NORTH SANTIAM<br>Nama jantan / Sire name: SCHAFFER RIDGE` ROCKY<br>Nama betina / Dam name: ARIA VON NORTH SANTIAM'),
(20, 4, 2, '2023-06-25 19:51:09', 4, 'Nama anjing / Canine name: DIONA VON NORTH SANTIAM<br>Nama jantan / Sire name: SCHAFFER RIDGE` ROCKY<br>Nama betina / Dam name: ARIA VON NORTH SANTIAM'),
(21, 3, 1, '2023-06-25 19:52:35', 4, 'Nama anjing / Canine name: DIONA VON NORTH SANTIAM<br/>Pemilik lama / Previous owner: OLIVIA AGUSTINA (NORTH SANTIAM)<br/>Pemilik baru / New owner: DIMAS SIHOMBING (SCHAFFER RIDGE)'),
(22, 3, 1, '2023-06-25 19:52:35', 6, 'Nama anjing / Canine name: DIONA VON NORTH SANTIAM<br/>Pemilik lama / Previous owner: OLIVIA AGUSTINA (NORTH SANTIAM)<br/>Pemilik baru / New owner: DIMAS SIHOMBING (SCHAFFER RIDGE)'),
(23, 11, 13, '2023-06-25 21:32:51', 10, 'Nama anjing / Canine name: SNOWY VON EXPLOSIVE'),
(24, 11, 12, '2023-06-25 21:32:54', 10, 'Nama anjing / Canine name: DESSY VON EXPLOSIVE'),
(25, 11, 11, '2023-06-25 21:32:56', 10, 'Nama anjing / Canine name: EMMA VON EXPLOSIVE'),
(26, 17, 13, '2023-06-25 21:40:14', 13, ''),
(27, 11, 15, '2023-06-25 21:45:59', 13, 'Nama anjing / Canine name: WILDLINE` EVIANA'),
(28, 11, 14, '2023-06-25 21:46:01', 13, 'Nama anjing / Canine name: WILDLINE` CAROL'),
(29, 11, 17, '2023-06-25 21:48:27', 13, 'Nama anjing / Canine name: WILDLINE` IONIA'),
(30, 11, 16, '2023-06-25 21:48:29', 13, 'Nama anjing / Canine name: WILDLINE` TRISTANA'),
(31, 11, 20, '2023-06-25 21:50:24', 13, 'Nama anjing / Canine name: WILDLINE` GISELLA'),
(32, 11, 19, '2023-06-25 21:50:27', 13, 'Nama anjing / Canine name: WILDLINE` BIANCA'),
(33, 11, 22, '2023-06-25 21:54:00', 13, 'Nama anjing / Canine name: WILDLINE` NIKITA'),
(34, 17, 14, '2023-06-25 22:03:13', 14, ''),
(35, 11, 23, '2023-06-25 22:03:59', 14, 'Nama anjing / Canine name: MAYFLOWER` FILLY'),
(36, 11, 24, '2023-06-25 22:04:48', 14, 'Nama anjing / Canine name: MAYFLOWER` JOE'),
(37, 11, 25, '2023-06-25 22:05:35', 14, 'Nama anjing / Canine name: MAYFLOWER` LEVINE'),
(38, 11, 26, '2023-06-25 22:07:01', 14, 'Nama anjing / Canine name: MAYFLOWER` JAMES'),
(39, 1, 3, '2023-06-25 22:12:28', 14, 'Nama jantan / Sire name: MAYFLOWER` JAMES<br>Nama betina / Dam name: WILDLINE` TRISTANA'),
(40, 1, 3, '2023-06-25 22:12:28', 13, 'Nama jantan / Sire name: MAYFLOWER` JAMES<br>Nama betina / Dam name: WILDLINE` TRISTANA<br><a class=\"text-reset link-warning\" href=\"http://localhost/icrpedigree/frontend/Births/add/3\">Lapor Lahir / Birth Report</a>'),
(41, 1, 4, '2023-06-25 22:17:41', 14, 'Nama jantan / Sire name: MAYFLOWER` JOE<br>Nama betina / Dam name: WILDLINE` CAROL'),
(42, 1, 4, '2023-06-25 22:17:41', 13, 'Nama jantan / Sire name: MAYFLOWER` JOE<br>Nama betina / Dam name: WILDLINE` CAROL<br><a class=\"text-reset link-warning\" href=\"http://localhost/icrpedigree/frontend/Births/add/4\">Lapor Lahir / Birth Report</a>'),
(43, 2, 3, '2023-06-25 22:22:11', 14, 'Nama Jantan / Sire Name: MAYFLOWER` JOE<br>Nama Betina / Dam Name: WILDLINE` CAROL'),
(44, 2, 3, '2023-06-25 22:22:11', 13, 'Nama Jantan / Sire Name: MAYFLOWER` JOE<br>Nama Betina / Dam Name: WILDLINE` CAROL<br><a class=\"text-reset link-warning\" href=\"http://localhost/icrpedigree/frontend/Stambums/add/3\">Lapor Anak / Puppy Report</a>'),
(45, 30, 1, '2023-06-25 22:59:18', 13, 'Invoice Pesanan / Order: INV-15423925'),
(46, 31, 1, '2023-06-25 22:59:20', 13, 'Invoice Pesanan / Order: INV-15423925'),
(47, 32, 2, '2023-06-25 22:59:27', 13, 'Invoice Pesanan / Order: INV-59835958'),
(48, 30, 3, '2023-06-25 22:59:31', 13, 'Invoice Pesanan / Order: INV-84825419'),
(49, 30, 6, '2023-06-25 23:09:02', 13, 'Invoice Pesanan / Order: INV-17759311'),
(50, 31, 6, '2023-06-25 23:09:04', 13, 'Invoice Pesanan / Order: INV-17759311'),
(51, 11, 27, '2023-06-25 23:22:32', 13, 'Nama anjing / Canine name: WILDLINE` GREGORY'),
(52, 37, 1, '2023-06-25 23:50:52', 13, 'Microchip untuk anjing / Microchip for dog: WILDLINE` NIKITA'),
(53, 39, 1, '2023-06-25 23:55:41', 13, 'Microchip untuk anjing / Microchip for dog: WILDLINE` NIKITA'),
(54, 34, 1, '2023-06-25 23:57:18', 13, 'Sertifikat untuk anjing / Certificate for dog: WILDLINE` NIKITA'),
(55, 35, 1, '2023-06-25 23:57:20', 13, 'Sertifikat untuk anjing / Certificate for dog: WILDLINE` NIKITA'),
(56, 37, 3, '2023-06-25 23:59:06', 13, 'Microchip untuk anjing / Microchip for dog: WILDLINE` BIANCA'),
(57, 34, 2, '2023-06-26 00:00:07', 13, 'Sertifikat untuk anjing / Certificate for dog: WILDLINE` GISELLA'),
(58, 30, 7, '2023-06-26 00:03:44', 2, 'Invoice Pesanan / Order: INV-50753655'),
(59, 31, 7, '2023-06-26 00:03:45', 2, 'Invoice Pesanan / Order: INV-50753655'),
(60, 3, 2, '2023-06-26 05:52:55', 4, 'Nama anjing / Canine name: WILDLINE` AQUILA<br/>Pemilik lama / Previous owner: OLIVIA AGUSTINA (NORTH SANTIAM)<br/>Pemilik baru / New owner: LIMAN IRAWAN (WILDLINE)'),
(61, 3, 2, '2023-06-26 05:52:55', 13, 'Nama anjing / Canine name: WILDLINE` AQUILA<br/>Pemilik lama / Previous owner: OLIVIA AGUSTINA (NORTH SANTIAM)<br/>Pemilik baru / New owner: LIMAN IRAWAN (WILDLINE)'),
(62, 17, 15, '2023-06-26 05:57:28', 15, ''),
(63, 11, 28, '2023-06-26 05:58:50', 15, 'Nama anjing / Canine name: JACKSON VON LYNWOOD'),
(64, 1, 5, '2023-06-26 06:04:56', 15, 'Nama jantan / Sire name: JACKSON VON LYNWOOD<br>Nama betina / Dam name: WILDLINE` AQUILA'),
(65, 1, 5, '2023-06-26 06:04:56', 13, 'Nama jantan / Sire name: JACKSON VON LYNWOOD<br>Nama betina / Dam name: WILDLINE` AQUILA<br><a class=\"text-reset link-warning\" href=\"http://localhost/icrpedigree/frontend/Births/add/5\">Lapor Lahir / Birth Report</a>'),
(66, 2, 4, '2023-06-26 06:05:59', 15, 'Nama Jantan / Sire Name: JACKSON VON LYNWOOD<br>Nama Betina / Dam Name: WILDLINE` AQUILA'),
(67, 2, 4, '2023-06-26 06:05:59', 13, 'Nama Jantan / Sire Name: JACKSON VON LYNWOOD<br>Nama Betina / Dam Name: WILDLINE` AQUILA<br><a class=\"text-reset link-warning\" href=\"http://localhost/icrpedigree/frontend/Stambums/add/4\">Lapor Anak / Puppy Report</a>'),
(68, 4, 5, '2023-06-26 06:09:28', 13, 'Nama anjing / Canine name: WILDLINE` HANNAH<br>Nama jantan / Sire name: JACKSON VON LYNWOOD<br>Nama betina / Dam name: WILDLINE` AQUILA'),
(69, 11, 30, '2023-06-26 06:14:02', 15, 'Nama anjing / Canine name: SABRINA VON LYNWOOD'),
(70, 1, 6, '2023-06-26 06:16:02', 14, 'Nama jantan / Sire name: MAYFLOWER` LEVINE<br>Nama betina / Dam name: SABRINA VON LYNWOOD'),
(71, 1, 6, '2023-06-26 06:16:02', 15, 'Nama jantan / Sire name: MAYFLOWER` LEVINE<br>Nama betina / Dam name: SABRINA VON LYNWOOD<br><a class=\"text-reset link-warning\" href=\"http://localhost/icrpedigree/frontend/Births/add/6\">Lapor Lahir / Birth Report</a>'),
(72, 2, 5, '2023-06-26 06:17:08', 14, 'Nama Jantan / Sire Name: MAYFLOWER` LEVINE<br>Nama Betina / Dam Name: SABRINA VON LYNWOOD'),
(73, 2, 5, '2023-06-26 06:17:08', 15, 'Nama Jantan / Sire Name: MAYFLOWER` LEVINE<br>Nama Betina / Dam Name: SABRINA VON LYNWOOD<br><a class=\"text-reset link-warning\" href=\"http://localhost/icrpedigree/frontend/Stambums/add/5\">Lapor Anak / Puppy Report</a>'),
(74, 4, 6, '2023-06-26 06:19:57', 15, 'Nama anjing / Canine name: CASSIUS VON LYNWOOD<br>Nama jantan / Sire name: MAYFLOWER` LEVINE<br>Nama betina / Dam name: SABRINA VON LYNWOOD'),
(75, 1, 7, '2023-06-26 06:24:31', 15, 'Nama jantan / Sire name: CASSIUS VON LYNWOOD<br>Nama betina / Dam name: WILDLINE` HANNAH'),
(76, 1, 7, '2023-06-26 06:24:31', 13, 'Nama jantan / Sire name: CASSIUS VON LYNWOOD<br>Nama betina / Dam name: WILDLINE` HANNAH<br><a class=\"text-reset link-warning\" href=\"http://localhost/icrpedigree/frontend/Births/add/7\">Lapor Lahir / Birth Report</a>'),
(77, 2, 6, '2023-06-26 06:25:07', 15, 'Nama Jantan / Sire Name: CASSIUS VON LYNWOOD<br>Nama Betina / Dam Name: WILDLINE` HANNAH'),
(78, 2, 6, '2023-06-26 06:25:07', 13, 'Nama Jantan / Sire Name: CASSIUS VON LYNWOOD<br>Nama Betina / Dam Name: WILDLINE` HANNAH<br><a class=\"text-reset link-warning\" href=\"http://localhost/icrpedigree/frontend/Stambums/add/6\">Lapor Anak / Puppy Report</a>'),
(79, 4, 10, '2023-06-26 06:26:59', 13, 'Nama anjing / Canine name: WILDLINE` RENGAR<br>Nama jantan / Sire name: CASSIUS VON LYNWOOD<br>Nama betina / Dam name: WILDLINE` HANNAH'),
(80, 4, 9, '2023-06-26 06:27:02', 13, 'Nama anjing / Canine name: WILDLINE` SANDRA<br>Nama jantan / Sire name: CASSIUS VON LYNWOOD<br>Nama betina / Dam name: WILDLINE` HANNAH'),
(81, 11, 35, '2023-06-26 06:34:40', 15, 'Nama anjing / Canine name: QUINN VON LYNWOOD'),
(82, 11, 34, '2023-06-26 06:34:43', 15, 'Nama anjing / Canine name: OLIVER VON LYNWOOD'),
(83, 3, 4, '2023-06-26 06:39:14', 15, 'Nama anjing / Canine name: WILDLINE` OLIVER<br/>Pemilik lama / Previous owner: TIARA RAHMAWATI (LYNWOOD)<br/>Pemilik baru / New owner: LIMAN IRAWAN (WILDLINE)'),
(84, 3, 4, '2023-06-26 06:39:14', 13, 'Nama anjing / Canine name: WILDLINE` OLIVER<br/>Pemilik lama / Previous owner: TIARA RAHMAWATI (LYNWOOD)<br/>Pemilik baru / New owner: LIMAN IRAWAN (WILDLINE)'),
(85, 3, 3, '2023-06-26 06:39:17', 15, 'Nama anjing / Canine name: WILDLINE` QUINN<br/>Pemilik lama / Previous owner: TIARA RAHMAWATI (LYNWOOD)<br/>Pemilik baru / New owner: LIMAN IRAWAN (WILDLINE)'),
(86, 3, 3, '2023-06-26 06:39:17', 13, 'Nama anjing / Canine name: WILDLINE` QUINN<br/>Pemilik lama / Previous owner: TIARA RAHMAWATI (LYNWOOD)<br/>Pemilik baru / New owner: LIMAN IRAWAN (WILDLINE)'),
(87, 1, 8, '2023-06-26 06:40:56', 13, 'Nama jantan / Sire name: WILDLINE` OLIVER<br>Nama betina / Dam name: WILDLINE` QUINN<br><a class=\"text-reset link-warning\" href=\"http://localhost/icrpedigree/frontend/Births/add/8\">Lapor Lahir / Birth Report</a>'),
(88, 11, 36, '2023-06-26 06:45:54', 6, 'Nama anjing / Canine name: SCHAFFER RIDGE` WAYNE'),
(89, 1, 9, '2023-06-26 06:48:32', 6, 'Nama jantan / Sire name: SCHAFFER RIDGE` WAYNE<br>Nama betina / Dam name: WILDLINE` SANDRA'),
(90, 1, 9, '2023-06-26 06:48:32', 13, 'Nama jantan / Sire name: SCHAFFER RIDGE` WAYNE<br>Nama betina / Dam name: WILDLINE` SANDRA<br><a class=\"text-reset link-warning\" href=\"http://localhost/icrpedigree/frontend/Births/add/9\">Lapor Lahir / Birth Report</a>'),
(91, 2, 7, '2023-06-26 06:49:56', 6, 'Nama Jantan / Sire Name: SCHAFFER RIDGE` WAYNE<br>Nama Betina / Dam Name: WILDLINE` SANDRA'),
(92, 2, 7, '2023-06-26 06:49:56', 13, 'Nama Jantan / Sire Name: SCHAFFER RIDGE` WAYNE<br>Nama Betina / Dam Name: WILDLINE` SANDRA<br><a class=\"text-reset link-warning\" href=\"http://localhost/icrpedigree/frontend/Stambums/add/7\">Lapor Anak / Puppy Report</a>'),
(93, 11, 38, '2023-06-26 07:05:30', 15, 'Nama anjing / Canine name: CLYDE VON LYNWOOD'),
(94, 11, 37, '2023-06-26 07:05:32', 15, 'Nama anjing / Canine name: YUNA VON LYNWOOD'),
(95, 1, 10, '2023-06-26 07:07:52', 15, 'Nama jantan / Sire name: CLYDE VON LYNWOOD<br>Nama betina / Dam name: YUNA VON LYNWOOD<br><a class=\"text-reset link-warning\" href=\"http://localhost/icrpedigree/frontend/Births/add/10\">Lapor Lahir / Birth Report</a>'),
(96, 2, 8, '2023-06-26 07:08:27', 15, 'Nama Jantan / Sire Name: CLYDE VON LYNWOOD<br>Nama Betina / Dam Name: YUNA VON LYNWOOD'),
(97, 2, 8, '2023-06-26 07:08:27', 15, 'Nama Jantan / Sire Name: CLYDE VON LYNWOOD<br>Nama Betina / Dam Name: YUNA VON LYNWOOD<br><a class=\"text-reset link-warning\" href=\"http://localhost/icrpedigree/frontend/Stambums/add/8\">Lapor Anak / Puppy Report</a>'),
(98, 11, 40, '2023-06-26 07:13:31', 15, 'Nama anjing / Canine name: LEONA VON LYNWOOD'),
(99, 11, 39, '2023-06-26 07:13:33', 15, 'Nama anjing / Canine name: JAYCE VON LYNWOOD'),
(100, 23, 1, '2023-06-27 06:03:35', 13, 'Nama anjing / Canine name: WILDLINE` QUINN'),
(101, 23, 2, '2023-06-27 06:04:29', 13, 'Nama anjing / Canine name: WILDLINE` QUINN'),
(102, 23, 3, '2023-06-27 06:04:57', 13, 'Nama anjing / Canine name: WILDLINE` QUINN'),
(103, 23, 4, '2023-06-27 06:28:46', 13, 'Nama anjing / Canine name: WILDLINE` QUINN'),
(104, 22, 5, '2023-06-27 06:28:56', 13, 'Nama anjing / Canine name: WILDLINE` QUINN'),
(105, 22, 6, '2023-06-27 06:29:30', 13, 'Nama anjing / Canine name: WILDLINE` OLIVER'),
(106, 22, 7, '2023-06-27 06:30:12', 13, 'Nama anjing / Canine name: WILDLINE` QUINN'),
(107, 16, 1, '2023-06-27 06:33:32', 13, 'Nama jantan / Sire name: MAYFLOWER` JOE<br>Nama betina / Dam name: WILDLINE` CAROL'),
(108, 16, 2, '2023-06-27 06:34:05', 13, 'Nama jantan / Sire name: MAYFLOWER` JOE<br>Nama betina / Dam name: WILDLINE` CAROL'),
(109, 15, 3, '2023-06-27 06:40:50', 13, 'Nama jantan / Sire name: MAYFLOWER` JOE<br>Nama betina / Dam name: WILDLINE` CAROL'),
(110, 16, 4, '2023-06-27 06:41:18', 13, 'Nama jantan / Sire name: MAYFLOWER` JOE<br>Nama betina / Dam name: WILDLINE` CAROL'),
(111, 15, 5, '2023-06-27 06:41:35', 13, 'Nama jantan / Sire name: MAYFLOWER` JOE<br>Nama betina / Dam name: WILDLINE` CAROL'),
(112, 23, 8, '2023-06-27 06:47:04', 13, 'Nama anjing / Canine name: WILDLINE` QUINN'),
(113, 15, 6, '2023-06-27 06:47:57', 13, 'Nama jantan / Sire name: MAYFLOWER` JOE<br>Nama betina / Dam name: WILDLINE` CAROL'),
(114, 30, 17, '2023-12-09 16:25:42', 13, 'Invoice Pesanan / Order: TES-38796984'),
(115, 31, 17, '2023-12-09 16:25:52', 13, 'Invoice Pesanan / Order: TES-38796984'),
(116, 30, 18, '2023-12-09 16:30:51', 13, 'Invoice Pesanan / Order: TES-33908189'),
(117, 31, 18, '2023-12-09 16:30:53', 13, 'Invoice Pesanan / Order: TES-33908189'),
(118, 32, 19, '2023-12-09 16:41:36', 13, 'Invoice Pesanan / Order: TES-23276302'),
(119, 30, 22, '2023-12-09 18:38:05', 13, 'Invoice Pesanan / Order: TES-74992553'),
(120, 31, 22, '2023-12-09 18:38:13', 13, 'Invoice Pesanan / Order: TES-74992553'),
(121, 32, 26, '2023-12-09 19:56:57', 13, 'Invoice Pesanan / Order: TES-89711068'),
(122, 32, 30, '2023-12-09 20:22:54', 13, 'Invoice Pesanan / Order: TES-46416578'),
(123, 32, 29, '2023-12-09 20:23:21', 13, 'Invoice Pesanan / Order: TES-53529066'),
(124, 32, 31, '2023-12-09 20:25:08', 13, 'Invoice Pesanan / Order: TES-87282327'),
(125, 30, 32, '2023-12-09 20:26:16', 13, 'Invoice Pesanan / Order: TES-73923189'),
(126, 32, 32, '2023-12-09 20:26:31', 13, 'Invoice Pesanan / Order: TES-73923189'),
(127, 30, 33, '2023-12-09 20:27:50', 13, 'Invoice Pesanan / Order: TES-65222065'),
(128, 31, 33, '2023-12-09 20:27:58', 13, 'Invoice Pesanan / Order: TES-65222065'),
(129, 30, 36, '2023-12-11 15:44:05', 13, 'Invoice Pesanan / Order: TES-52393139'),
(130, 31, 36, '2023-12-11 15:44:29', 13, 'Invoice Pesanan / Order: TES-52393139'),
(131, 30, 37, '2023-12-11 15:51:08', 13, 'Invoice Pesanan / Order: TES-01115114'),
(132, 31, 37, '2023-12-11 15:51:10', 13, 'Invoice Pesanan / Order: TES-01115114'),
(133, 32, 38, '2023-12-11 15:58:49', 13, 'Invoice Pesanan / Order: TES-88831014'),
(134, 32, 39, '2023-12-11 16:00:14', 13, 'Invoice Pesanan / Order: TES-45870850'),
(135, 30, 42, '2023-12-11 16:11:18', 13, 'Invoice Pesanan / Order: TES-80602784'),
(136, 32, 42, '2023-12-11 16:11:29', 13, 'Invoice Pesanan / Order: TES-80602784'),
(137, 30, 42, '2023-12-11 18:33:31', 13, 'Invoice Pesanan / Order: INS-2023'),
(138, 31, 42, '2023-12-11 18:33:40', 13, 'Invoice Pesanan / Order: INS-2023'),
(139, 30, 43, '2023-12-12 15:07:11', 13, 'Invoice Pesanan / Order: TES-67623077'),
(140, 31, 43, '2023-12-12 15:07:28', 13, 'Invoice Pesanan / Order: TES-67623077'),
(141, 34, 3, '2023-12-12 15:14:45', 13, 'Sertifikat untuk anjing / Certificate for dog: WILDLINE` BIANCA'),
(142, 17, 16, '2023-12-12 17:48:45', 16, ''),
(143, 24, 3, '2023-12-12 19:32:41', 16, ''),
(144, 26, 2, '2023-12-12 20:17:12', 17, ''),
(145, 30, 44, '2023-12-12 20:17:58', 17, 'Invoice Pesanan / Order: TES-27573417'),
(146, 19, 17, '2023-12-12 20:31:54', 17, ''),
(147, 17, 18, '2023-12-12 20:49:23', 18, ''),
(148, 17, 19, '2023-12-12 20:50:37', 19, ''),
(149, 11, 42, '2023-12-13 08:42:22', 13, 'Nama anjing / Canine name: WILDLINE` HALDOG'),
(150, 13, 50, '2023-12-13 10:53:57', 13, 'Nama anjing / Canine Name: WILDLINE` TESTIMER'),
(151, 11, 52, '2023-12-13 11:02:23', 13, 'Nama anjing / Canine name: WILDLINE` TESUPLOAD'),
(152, 22, 9, '2023-12-13 11:03:30', 13, 'Nama anjing / Canine name: WILDLINE` TESUPLOAD'),
(153, 8, 5, '2023-12-13 11:03:42', 13, 'Nama anjing / Canine name: WILDLINE` TESUPLOAD<br/>Pemilik lama / Previous owner: LIMAN IRAWAN (WILDLINE)<br/>Pemilik baru / New owner: JOSHUA BELL (JOSHUABELL)'),
(154, 8, 5, '2023-12-13 11:03:42', 19, 'Nama anjing / Canine name: WILDLINE` TESUPLOAD<br/>Pemilik lama / Previous owner: LIMAN IRAWAN (WILDLINE)<br/>Pemilik baru / New owner: JOSHUA BELL (JOSHUABELL)'),
(155, 1, 12, '2023-12-13 11:16:46', 13, 'Nama jantan / Sire name: WILDLINE` TESUPLOAD<br>Nama betina / Dam name: WILDLINE` SANDRA<br><a class=\"text-reset link-warning\" href=\"http://localhost/icrpedigree/frontend/Births/add/12\">Lapor Lahir / Birth Report</a>'),
(156, 1, 12, '2023-12-13 11:17:18', 13, 'Nama jantan / Sire name: WILDLINE` TESUPLOAD<br>Nama betina / Dam name: WILDLINE` SANDRA<br><a class=\"text-reset link-warning\" href=\"http://localhost/icrpedigree/frontend/Births/add/12\">Lapor Lahir / Birth Report</a>'),
(157, 2, 9, '2023-12-13 11:18:10', 13, 'Nama Jantan / Sire Name: WILDLINE` TESUPLOAD<br>Nama Betina / Dam Name: WILDLINE` SANDRA'),
(158, 2, 9, '2023-12-13 11:18:10', 13, 'Nama Jantan / Sire Name: WILDLINE` TESUPLOAD<br>Nama Betina / Dam Name: WILDLINE` SANDRA<br><a class=\"text-reset link-warning\" href=\"http://localhost/icrpedigree/frontend/Stambums/add/9\">Lapor Anak / Puppy Report</a>'),
(159, 4, 12, '2023-12-13 11:18:45', 13, 'Nama anjing / Canine name: WILDLINE` HADA<br>Nama jantan / Sire name: WILDLINE` TESUPLOAD<br>Nama betina / Dam name: WILDLINE` SANDRA'),
(160, 17, 22, '2023-12-13 13:14:51', 22, ''),
(161, 17, 23, '2023-12-13 13:18:11', 23, ''),
(162, 17, 33, '2023-12-13 14:17:10', 33, ''),
(163, 17, 34, '2023-12-13 14:19:23', 34, ''),
(164, 17, 34, '2023-12-13 14:19:46', 34, ''),
(165, 17, 36, '2023-12-13 14:35:57', 36, ''),
(166, 11, 54, '2023-12-13 14:39:06', 13, 'Nama anjing / Canine name: WILDLINE` UCHIGA'),
(167, 26, 6, '2023-12-13 15:12:49', 34, ''),
(168, 26, 7, '2023-12-13 15:15:27', 34, ''),
(169, 27, 8, '2023-12-13 15:18:39', 34, ''),
(170, 26, 9, '2023-12-13 15:23:34', 34, ''),
(171, 26, 14, '2023-12-13 16:29:31', 34, ''),
(172, 27, 16, '2023-12-13 16:49:39', 34, ''),
(173, 26, 19, '2023-12-13 17:04:00', 34, ''),
(174, 17, 37, '2023-12-14 12:38:39', 37, ''),
(175, 1, 13, '2023-12-14 12:40:55', 13, 'Nama jantan / Sire name: WILDLINE` TESUPLOAD<br>Nama betina / Dam name: WILDLINE` HANNAH<br><a class=\"text-reset link-warning\" href=\"http://localhost/icrpedigree/frontend/Births/add/13\">Lapor Lahir / Birth Report</a>'),
(176, 1, 13, '2023-12-14 12:41:03', 13, 'Nama jantan / Sire name: WILDLINE` TESUPLOAD<br>Nama betina / Dam name: WILDLINE` HANNAH<br><a class=\"text-reset link-warning\" href=\"http://localhost/icrpedigree/frontend/Births/add/13\">Lapor Lahir / Birth Report</a>'),
(177, 2, 10, '2023-12-14 12:41:29', 13, 'Nama Jantan / Sire Name: WILDLINE` TESUPLOAD<br>Nama Betina / Dam Name: WILDLINE` HANNAH'),
(178, 2, 10, '2023-12-14 12:41:29', 13, 'Nama Jantan / Sire Name: WILDLINE` TESUPLOAD<br>Nama Betina / Dam Name: WILDLINE` HANNAH<br><a class=\"text-reset link-warning\" href=\"http://localhost/icrpedigree/frontend/Stambums/add/10\">Lapor Anak / Puppy Report</a>'),
(179, 15, 7, '2023-12-14 14:18:20', 13, 'Nama jantan / Sire name: WILDLINE` TESUPLOAD<br>Nama betina / Dam name: WILDLINE` HANNAH'),
(180, 5, 16, '2023-12-14 18:30:43', 13, 'Nama anjing / Canine name: WILDLINE` FEMALE2<br>Nama jantan / Sire name: WILDLINE` TESUPLOAD<br>Nama betina / Dam name: WILDLINE` HANNAH'),
(181, 4, 15, '2023-12-14 18:30:48', 13, 'Nama anjing / Canine name: WILDLINE` MALE2<br>Nama jantan / Sire name: WILDLINE` TESUPLOAD<br>Nama betina / Dam name: WILDLINE` HANNAH'),
(182, 4, 14, '2023-12-14 18:30:51', 13, 'Nama anjing / Canine name: WILDLINE` FEMALE1<br>Nama jantan / Sire name: WILDLINE` TESUPLOAD<br>Nama betina / Dam name: WILDLINE` HANNAH'),
(183, 5, 13, '2023-12-14 18:30:54', 13, 'Nama anjing / Canine name: WILDLINE` MALE1<br>Nama jantan / Sire name: WILDLINE` TESUPLOAD<br>Nama betina / Dam name: WILDLINE` HANNAH'),
(184, 4, 19, '2023-12-14 19:04:57', 13, 'Nama anjing / Canine name: WILDLINE` FEMALE1<br>Nama jantan / Sire name: WILDLINE` TESUPLOAD<br>Nama betina / Dam name: WILDLINE` HANNAH'),
(185, 4, 20, '2023-12-14 19:04:59', 13, 'Nama anjing / Canine name: WILDLINE` MALE1<br>Nama jantan / Sire name: WILDLINE` TESUPLOAD<br>Nama betina / Dam name: WILDLINE` HANNAH'),
(186, 36, 8, '2023-12-15 13:29:55', 13, 'Sertifikat untuk anjing / Certificate for dog: WILDLINE` UCHIGA'),
(187, 34, 9, '2023-12-15 13:30:35', 13, 'Sertifikat untuk anjing / Certificate for dog: WILDLINE` UCHIGA'),
(188, 35, 9, '2023-12-15 13:30:58', 13, 'Sertifikat untuk anjing / Certificate for dog: WILDLINE` UCHIGA'),
(189, 35, 9, '2023-12-15 13:41:53', 13, 'Sertifikat untuk anjing / Certificate for dog: WILDLINE` UCHIGA'),
(190, 34, 9, '2023-12-15 13:49:40', 13, 'Sertifikat untuk anjing / Certificate for dog: WILDLINE` UCHIGA'),
(191, 35, 9, '2023-12-15 13:49:46', 13, 'Sertifikat untuk anjing / Certificate for dog: WILDLINE` UCHIGA'),
(192, 34, 13, '2023-12-15 15:16:02', 13, 'Sertifikat untuk anjing / Certificate for dog: WILDLINE` UCHIGA'),
(193, 36, 13, '2023-12-15 15:16:44', 13, 'Sertifikat untuk anjing / Certificate for dog: WILDLINE` UCHIGA'),
(194, 34, 12, '2023-12-15 15:17:01', 13, 'Sertifikat untuk anjing / Certificate for dog: WILDLINE` UCHIGA'),
(195, 35, 12, '2023-12-15 15:17:02', 13, 'Sertifikat untuk anjing / Certificate for dog: WILDLINE` UCHIGA'),
(196, 13, 64, '2023-12-16 14:55:04', 34, 'Nama anjing / Canine Name: WARAH2` SHEPHERD2'),
(197, 17, 38, '2023-12-16 15:20:26', 38, ''),
(198, 18, 32, '2023-12-16 16:13:50', 13, 'Nama anjing / Canine name: WILDLINE` ASD<br>Nama jantan / Sire name: WILDLINE` TESUPLOAD<br>Nama betina / Dam name: WILDLINE` HANNAH'),
(199, 18, 33, '2023-12-16 16:42:17', 13, 'Nama anjing / Canine name: WILDLINE` GOLDEN1<br>Nama jantan / Sire name: WILDLINE` TESUPLOAD<br>Nama betina / Dam name: WILDLINE` HANNAH'),
(200, 18, 34, '2023-12-16 16:42:17', 13, 'Nama anjing / Canine name: WILDLINE` SHEPHERD1<br>Nama jantan / Sire name: WILDLINE` TESUPLOAD<br>Nama betina / Dam name: WILDLINE` HANNAH'),
(201, 18, 35, '2023-12-16 16:42:17', 13, 'Nama anjing / Canine name: WILDLINE` HUSKY1<br>Nama jantan / Sire name: WILDLINE` TESUPLOAD<br>Nama betina / Dam name: WILDLINE` HANNAH'),
(202, 18, 36, '2023-12-16 16:42:17', 13, 'Nama anjing / Canine name: WILDLINE` PUG1<br>Nama jantan / Sire name: WILDLINE` TESUPLOAD<br>Nama betina / Dam name: WILDLINE` HANNAH'),
(203, 30, 47, '2023-12-18 13:09:02', 13, 'Invoice Pesanan / Order: TES-10677717'),
(204, 31, 47, '2023-12-18 13:09:06', 13, 'Invoice Pesanan / Order: TES-10677717'),
(205, 5, 40, '2023-12-18 13:23:46', 13, 'Nama anjing / Canine name: WILDLINE` GOLDEN1<br>Nama jantan / Sire name: WILDLINE` TESUPLOAD<br>Nama betina / Dam name: WILDLINE` HANNAH'),
(206, 4, 39, '2023-12-18 13:23:48', 13, 'Nama anjing / Canine name: WILDLINE` SHEPHERD1<br>Nama jantan / Sire name: WILDLINE` TESUPLOAD<br>Nama betina / Dam name: WILDLINE` HANNAH'),
(207, 5, 44, '2023-12-18 13:57:41', 13, 'Nama anjing / Canine name: WILDLINE` GOLDEN2<br>Nama jantan / Sire name: WILDLINE` TESUPLOAD<br>Nama betina / Dam name: WILDLINE` HANNAH'),
(208, 5, 43, '2023-12-18 13:57:43', 13, 'Nama anjing / Canine name: WILDLINE` SHEPHERD2<br>Nama jantan / Sire name: WILDLINE` TESUPLOAD<br>Nama betina / Dam name: WILDLINE` HANNAH'),
(209, 5, 42, '2023-12-18 13:57:45', 13, 'Nama anjing / Canine name: WILDLINE` HUSKY2<br>Nama jantan / Sire name: WILDLINE` TESUPLOAD<br>Nama betina / Dam name: WILDLINE` HANNAH'),
(210, 5, 41, '2023-12-18 13:57:47', 13, 'Nama anjing / Canine name: WILDLINE` PUG2<br>Nama jantan / Sire name: WILDLINE` TESUPLOAD<br>Nama betina / Dam name: WILDLINE` HANNAH'),
(211, 2, 10, '2023-12-18 14:12:26', 13, 'Nama Jantan / Sire Name: WILDLINE` TESUPLOAD<br>Nama Betina / Dam Name: WILDLINE` HANNAH'),
(212, 2, 10, '2023-12-18 14:12:26', 13, 'Nama Jantan / Sire Name: WILDLINE` TESUPLOAD<br>Nama Betina / Dam Name: WILDLINE` HANNAH<br><a class=\"text-reset link-warning\" href=\"http://localhost/icrpedigree/frontend/Stambums/add/10\">Lapor Anak / Puppy Report</a>'),
(213, 5, 56, '2023-12-18 15:18:32', 13, 'Nama anjing / Canine name: WILDLINE` GOLDEN1<br>Nama jantan / Sire name: WILDLINE` TESUPLOAD<br>Nama betina / Dam name: WILDLINE` HANNAH'),
(214, 4, 55, '2023-12-18 15:18:34', 13, 'Nama anjing / Canine name: WILDLINE` SHEP1<br>Nama jantan / Sire name: WILDLINE` TESUPLOAD<br>Nama betina / Dam name: WILDLINE` HANNAH'),
(215, 4, 54, '2023-12-18 15:18:37', 13, 'Nama anjing / Canine name: WILDLINE` WOLF1<br>Nama jantan / Sire name: WILDLINE` TESUPLOAD<br>Nama betina / Dam name: WILDLINE` HANNAH'),
(216, 4, 53, '2023-12-18 15:18:39', 13, 'Nama anjing / Canine name: WILDLINE` PUG1<br>Nama jantan / Sire name: WILDLINE` TESUPLOAD<br>Nama betina / Dam name: WILDLINE` HANNAH'),
(217, 5, 58, '2023-12-18 16:14:29', 13, 'Nama anjing / Canine name: WILDLINE` PUG2<br>Nama jantan / Sire name: WILDLINE` TESUPLOAD<br>Nama betina / Dam name: WILDLINE` HANNAH'),
(218, 5, 57, '2023-12-18 16:14:32', 13, 'Nama anjing / Canine name: WILDLINE` SHEP2<br>Nama jantan / Sire name: WILDLINE` TESUPLOAD<br>Nama betina / Dam name: WILDLINE` HANNAH'),
(219, 4, 60, '2023-12-18 16:15:33', 13, 'Nama anjing / Canine name: WILDLINE` GAR3<br>Nama jantan / Sire name: WILDLINE` TESUPLOAD<br>Nama betina / Dam name: WILDLINE` HANNAH'),
(220, 4, 59, '2023-12-18 16:15:35', 13, 'Nama anjing / Canine name: WILDLINE` HAR2<br>Nama jantan / Sire name: WILDLINE` TESUPLOAD<br>Nama betina / Dam name: WILDLINE` HANNAH'),
(221, 38, 6, '2023-12-18 17:50:47', 13, 'Microchip untuk anjing / Microchip for dog: WILDLINE` HAR2'),
(222, 37, 8, '2023-12-18 18:40:21', 13, 'Microchip untuk anjing / Microchip for dog: WILDLINE` HAR2'),
(223, 39, 8, '2023-12-18 18:44:32', 13, 'Microchip untuk anjing / Microchip for dog: WILDLINE` HAR2'),
(224, 37, 8, '2023-12-18 18:57:46', 13, 'Microchip untuk anjing / Microchip for dog: WILDLINE` HAR2'),
(225, 39, 8, '2023-12-18 18:57:54', 13, 'Microchip untuk anjing / Microchip for dog: WILDLINE` HAR2'),
(226, 37, 9, '2023-12-18 19:04:22', 13, 'Microchip untuk anjing / Microchip for dog: WILDLINE` HAR2'),
(227, 39, 9, '2023-12-18 19:04:32', 13, 'Microchip untuk anjing / Microchip for dog: WILDLINE` HAR2'),
(228, 38, 11, '2023-12-18 19:32:40', 13, 'Microchip untuk anjing / Microchip for dog: WILDLINE` AQUILA'),
(229, 17, 39, '2023-12-18 20:39:36', 39, ''),
(230, 11, 77, '2023-12-18 20:43:37', 39, 'Nama anjing / Canine name: JONATHAN VON LOWBRAD'),
(231, 1, 14, '2023-12-18 20:46:13', 39, 'Nama jantan / Sire name: JONATHAN VON LOWBRAD<br>Nama betina / Dam name: WILDLINE` SANDRA'),
(232, 1, 14, '2023-12-18 20:46:13', 13, 'Nama jantan / Sire name: JONATHAN VON LOWBRAD<br>Nama betina / Dam name: WILDLINE` SANDRA<br><a class=\"text-reset link-warning\" href=\"http://localhost/icrpedigree/frontend/Births/add/14\">Lapor Lahir / Birth Report</a>'),
(233, 1, 14, '2023-12-18 20:46:31', 13, 'Nama jantan / Sire name: JONATHAN VON LOWBRAD<br>Nama betina / Dam name: WILDLINE` SANDRA<br><a class=\"text-reset link-warning\" href=\"http://localhost/icrpedigree/frontend/Births/add/14\">Lapor Lahir / Birth Report</a>'),
(234, 1, 14, '2023-12-18 20:46:31', 13, 'Nama jantan / Sire name: JONATHAN VON LOWBRAD<br>Nama betina / Dam name: WILDLINE` SANDRA<br><a class=\"text-reset link-warning\" href=\"http://localhost/icrpedigree/frontend/Births/add/14\">Lapor Lahir / Birth Report</a>'),
(235, 2, 11, '2023-12-18 20:50:25', 39, 'Nama Jantan / Sire Name: JONATHAN VON LOWBRAD<br>Nama Betina / Dam Name: WILDLINE` SANDRA'),
(236, 2, 11, '2023-12-18 20:50:25', 13, 'Nama Jantan / Sire Name: JONATHAN VON LOWBRAD<br>Nama Betina / Dam Name: WILDLINE` SANDRA<br><a class=\"text-reset link-warning\" href=\"http://localhost/icrpedigree/frontend/Stambums/add/11\">Lapor Anak / Puppy Report</a>'),
(237, 4, 62, '2023-12-18 20:58:35', 13, 'Nama anjing / Canine name: WILDLINE` TATIANA<br>Nama jantan / Sire name: JONATHAN VON LOWBRAD<br>Nama betina / Dam name: WILDLINE` SANDRA'),
(238, 4, 61, '2023-12-18 20:58:37', 13, 'Nama anjing / Canine name: WILDLINE` KENGO<br>Nama jantan / Sire name: JONATHAN VON LOWBRAD<br>Nama betina / Dam name: WILDLINE` SANDRA'),
(239, 3, 6, '2023-12-18 20:59:32', 13, 'Nama anjing / Canine name: KENGO VON LOWBRAD<br/>Pemilik lama / Previous owner: LIMAN IRAWAN (WILDLINE)<br/>Pemilik baru / New owner: THEO CAMPBELL (LOWBRAD)'),
(240, 3, 6, '2023-12-18 20:59:32', 39, 'Nama anjing / Canine name: KENGO VON LOWBRAD<br/>Pemilik lama / Previous owner: LIMAN IRAWAN (WILDLINE)<br/>Pemilik baru / New owner: THEO CAMPBELL (LOWBRAD)'),
(241, 30, 48, '2023-12-18 21:01:31', 39, 'Invoice Pesanan / Order: TES-53511538'),
(242, 31, 48, '2023-12-18 21:01:41', 39, 'Invoice Pesanan / Order: TES-53511538');

-- --------------------------------------------------------

--
-- Table structure for table `notificationtype`
--

CREATE TABLE `notificationtype` (
  `notificationtype_id` tinyint(4) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `notificationtype`
--

INSERT INTO `notificationtype` (`notificationtype_id`, `title`, `description`) VALUES
(1, 'Stud Accepted', 'Laporan pacak disetujui / Stud report is accepted'),
(2, 'Birth Accepted', 'Laporan lahir disetujui / Birth report is accepted'),
(3, 'Change Canine Ownership Accepted', 'Laporan ubah pemilik disetujui / Change canine ownership report is accepted'),
(4, 'Puppy Accepted', 'Laporan anak disetujui / Puppy report is accepted'),
(5, 'Puppy Rejected', 'Laporan anak ditolak / Puppy report is rejected'),
(6, 'Stud Rejected', 'Laporan pacak ditolak / Stud report is rejected'),
(7, 'Birth Rejected', 'Laporan lahir ditolak / Birth report is rejected'),
(8, 'Change Canine Ownership Rejected', 'Laporan ubah pemilik ditolak / Change canine ownership report is rejected '),
(9, '', ''),
(10, '', ''),
(11, 'Canine Addition Accepted', 'Laporan tambah anjing disetujui / Canine addition report is accepted'),
(12, 'Canine Addition Rejected', 'Laporan tambah anjing ditolak / Canine addition report is rejected'),
(13, 'Canine Addition', 'Penambahan data anjing disetujui / Canine addition is accepted'),
(14, 'Stud Addition', 'Penambahan data pacak disetujui / Stud addition is accepted'),
(15, 'Birth Update Accepted', 'Laporan Ubah Data Lahir diterima / Birth update report is accepted'),
(16, 'Birth Update Rejected', 'Laporan Ubah Data Lahir ditolak / Birth update report is rejected'),
(17, 'Kennel Accepted', 'Kennel disetujui / Kennel is accepted'),
(18, 'Puppy Addition', 'Penambahan data anak disetujui / Puppy addition is accepted'),
(19, 'Membership Payment', 'Iuran keanggotaan tahunan diterima / Membership payment has been received'),
(20, 'Membership Renewal', 'Perpanjangan iuran kennel tahunan belum diterima. Keanggotaan diturunkan dari anggota berbayar menjadi anggota gratis. <hr>Membership renewal fee has not been received. We decided to change the Pro membership to Free membership.'),
(21, 'Birth Addition', 'Penambahan data lahir disetujui / Birth addition is accepted'),
(22, 'Canine Update Accepted', 'Laporan ubah data anjing disetujui / Canine update report is accepted'),
(23, 'Canine Update Rejected', 'Laporan ubah data anjing ditolak / Canine update report is rejected'),
(24, 'Kennel Update Accepted', 'Laporan Ubah Kennel disetujui / Kennel Update report is accepted'),
(25, 'Kennel Update Rejected', 'Laporan Ubah Kennel ditolak / Kennel Update report is rejected'),
(26, 'Upgrade Pro Accepted', 'Menjadi Pro disetujui / Upgrade Pro report is accepted'),
(27, 'Upgrade Pro Rejected', 'Menjadi Pro ditolak / Upgrade pro report is rejected'),
(28, 'Stud Rejected', 'Lapor lahir telah melewati batas yang ditetapkan / Birth report has excedeed '),
(29, 'Birth Rejection', 'Lapor anak telah melewati batas yang ditetapkan / Puppy report has been excedeed'),
(30, 'Order Delivered', 'Pesanan anda sedang dikirim / Your order is being delivered'),
(31, 'Order Arrived', 'Pesanan anda sudah sampai / Your order has arrived'),
(32, 'Order Rejected', 'Pesanan anda ditolak / Your order has been rejected'),
(33, 'Order Payment Failed', 'Pembayaran pesanan anda gagal / Your order payment has failed'),
(34, 'Certificate Delivered', 'Sertifikat anda sedang dikirim / Your certificate is being delivered'),
(35, 'Certificate Arrived', 'Sertifikat anda sudah sampai / Your certificate has arrived'),
(36, 'Certificate Request Rejected', 'Permintaan cetak sertifikat ditolak / Your print certificate request has been rejected'),
(37, 'Microchip Request Accepted', 'Pengajuan pemasangan microchip disetujui / Implant microchip request accepted'),
(38, 'Microchip Request Rejected', 'Pengajuan pemasangan microchip ditolak / Implant microchip request rejected'),
(39, 'Microchip Implant Completed', 'Pemasangan microchip telah selesai / Microchip implant is complete');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `ord_id` int(11) NOT NULL,
  `ord_mem_id` int(11) NOT NULL,
  `ord_invoice` varchar(60) NOT NULL,
  `ord_city_id` int(11) NOT NULL,
  `ord_address` varchar(100) NOT NULL,
  `ord_shipping_id` int(11) NOT NULL,
  `ord_shipping_type` varchar(60) NOT NULL,
  `ord_shipping_cost` int(11) NOT NULL,
  `ord_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `ord_pay_date` timestamp NULL DEFAULT NULL,
  `ord_pay_due_date` timestamp NULL DEFAULT NULL,
  `ord_total_price` int(11) NOT NULL,
  `ord_arrived_date` timestamp NULL DEFAULT NULL,
  `ord_completed_date` timestamp NULL DEFAULT NULL,
  `ord_stat_id` int(11) NOT NULL,
  `ord_reject_note` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`ord_id`, `ord_mem_id`, `ord_invoice`, `ord_city_id`, `ord_address`, `ord_shipping_id`, `ord_shipping_type`, `ord_shipping_cost`, `ord_date`, `ord_pay_date`, `ord_pay_due_date`, `ord_total_price`, `ord_arrived_date`, `ord_completed_date`, `ord_stat_id`, `ord_reject_note`) VALUES
(36, 13, 'TES-52393139', 106, 'Jl. Ahmad Yani, Sukmajaya, Kec. Jombang, Kota Cilegon, Banten 42426', 3, 'Pos Nextday', 38000, '2023-12-11 06:02:26', '2023-10-02 06:04:38', '2023-12-11 07:02:26', 243000, '2023-12-11 08:44:29', '2023-12-11 08:50:20', 9, NULL),
(37, 13, 'TES-01115114', 27, 'Jl. Raya Cantian Tangkel Bangkalan No.5, Genangkah, Burneh, Kec. Burneh, Kabupaten Bangkalan', 1, 'OKE', 38000, '2023-12-11 08:07:51', '2023-11-08 08:50:51', '2023-12-11 09:07:51', 108000, '2023-12-11 08:51:10', '2023-12-11 08:56:11', 5, NULL),
(38, 13, 'TES-88831014', 402, 'Jl. Raya Mancak, Kadu Agung, Gunungsari, Kabupaten Serang, Banten 42163', 2, 'REG', 12000, '2023-12-11 08:57:26', '2023-10-01 08:57:40', '2023-12-11 09:57:26', 62000, NULL, NULL, 7, 'Kendala pengiriman / Delivery problem'),
(39, 13, 'TES-45870850', 402, 'Bandulu, Anyar, Serang Regency, Banten 42166', 1, 'OKE', 17000, '2023-12-11 08:59:42', '2023-10-10 08:59:59', '2023-12-11 09:59:42', 117000, NULL, NULL, 7, 'stok sedang habis 02x'),
(42, 13, 'INS-2023', 106, 'Jl. Kp. Sawah No.99, Cibeber, Kec. Cibeber, Kota Cilegon, Banten 42426, Indonesia', 3, 'Pos Reguler', 14000, '2023-12-11 09:10:40', '2023-12-04 23:24:00', '2023-12-19 22:18:00', 84000, '2023-12-11 11:33:40', '2023-12-11 11:35:00', 9, 'kendala2'),
(43, 13, 'TES-67623077', 152, 'Jl Casablanca 45 RT 009/05, Dki Jakarta', 3, 'Pos Nextday', 15500, '2021-12-14 08:05:46', '2023-12-12 08:06:00', '2023-12-12 09:05:46', 185500, '2023-12-12 08:07:28', '2023-12-12 08:07:37', 9, NULL),
(47, 13, 'TES-10677717', 27, 'Jl Yos Sudarso No 1 Pangkal Pinang', 1, 'OKE', 38000, '2023-12-18 06:07:51', '2022-12-01 06:08:11', '2023-12-18 07:07:51', 88000, '2023-12-18 06:09:06', '2023-12-18 06:09:09', 9, NULL),
(48, 39, 'TES-53511538', 135, 'JL. Wonosari-Panggang, Km 22, Saptosari, Gunung Kidul, Kepek, Kec. Saptosari, Kabupaten Gunung Kidul', 1, 'OKE', 72000, '2023-12-18 14:01:06', '2023-12-18 14:01:15', '2023-12-18 15:01:06', 347000, '2023-12-18 14:01:41', '2023-12-18 14:01:44', 9, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `order_complain`
--

CREATE TABLE `order_complain` (
  `com_id` int(11) NOT NULL,
  `com_ord_id` int(11) NOT NULL,
  `com_photo` text NOT NULL,
  `com_desc` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_complain`
--

INSERT INTO `order_complain` (`com_id`, `com_ord_id`, `com_photo`, `com_desc`) VALUES
(1, 17, '-', 'tidak sampai'),
(2, 18, 'complain_1702114632.png', 'tidak sampai'),
(3, 37, 'complain_1702284971.png', 'abstrak 02'),
(4, 42, 'complain_1702294461.png', 'erd');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `itm_id` int(11) NOT NULL,
  `itm_ord_id` int(11) NOT NULL,
  `itm_pro_id` int(11) NOT NULL,
  `itm_quantity` int(11) NOT NULL,
  `itm_subtotal` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`itm_id`, `itm_ord_id`, `itm_pro_id`, `itm_quantity`, `itm_subtotal`) VALUES
(1, 1, 5, 1, 5000),
(2, 2, 2, 2, 140000),
(3, 2, 1, 1, 25000),
(4, 2, 3, 1, 100000),
(5, 3, 2, 1, 70000),
(6, 4, 1, 5, 125000),
(7, 5, 3, 10, 1000000),
(8, 6, 3, 10, 1000000),
(9, 7, 3, 10, 1000000),
(10, 8, 3, 10, 1000000),
(11, 9, 3, 10, 1000000),
(12, 10, 3, 10, 1000000),
(13, 11, 3, 10, 1000000),
(14, 12, 3, 10, 1000000),
(15, 13, 1, 1, 25000),
(16, 13, 2, 1, 70000),
(17, 14, 4, 1, 50000),
(18, 14, 3, 1, 100000),
(19, 15, 1, 1, 25000),
(20, 15, 5, 1, 5000),
(21, 16, 5, 1, 5000),
(22, 16, 3, 1, 100000),
(23, 16, 4, 1, 50000),
(24, 17, 5, 1, 5000),
(25, 17, 2, 1, 70000),
(26, 17, 1, 1, 25000),
(27, 18, 5, 1, 5000),
(28, 19, 4, 1, 50000),
(29, 20, 5, 3, 15000),
(30, 21, 5, 1, 5000),
(31, 22, 5, 1, 5000),
(32, 22, 4, 1, 50000),
(33, 22, 3, 1, 100000),
(34, 23, 1, 8, 200000),
(35, 24, 1, 5, 125000),
(36, 25, 4, 43, 2150000),
(37, 26, 4, 43, 2150000),
(38, 27, 4, 45, 2250000),
(39, 28, 4, 45, 2250000),
(40, 29, 4, 45, 2250000),
(41, 30, 2, 45, 3150000),
(42, 31, 4, 45, 2250000),
(43, 32, 3, 22, 2200000),
(44, 33, 3, 1, 100000),
(45, 34, 5, 1, 5000),
(46, 35, 5, 1, 5000),
(47, 35, 4, 1, 50000),
(48, 35, 1, 3, 75000),
(49, 36, 5, 1, 5000),
(50, 36, 4, 2, 100000),
(51, 36, 3, 1, 100000),
(52, 37, 2, 1, 70000),
(53, 38, 4, 1, 50000),
(54, 39, 3, 1, 100000),
(55, 40, 2, 1, 70000),
(56, 41, 2, 1, 70000),
(57, 42, 2, 1, 70000),
(58, 43, 3, 1, 100000),
(59, 43, 2, 1, 70000),
(60, 44, 3, 1, 100000),
(61, 44, 2, 1, 70000),
(62, 45, 4, 1, 50000),
(63, 46, 3, 1, 100000),
(64, 47, 4, 1, 50000),
(65, 48, 1, 3, 75000),
(66, 48, 3, 2, 200000);

-- --------------------------------------------------------

--
-- Table structure for table `order_status`
--

CREATE TABLE `order_status` (
  `ord_stat_id` int(11) NOT NULL,
  `ord_stat_name` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_status`
--

INSERT INTO `order_status` (`ord_stat_id`, `ord_stat_name`) VALUES
(1, 'Menunggu pembayaran / Waiting for payment'),
(2, 'Sedang diproses / Being processed'),
(3, 'Sedang dikirim / Being delivered'),
(4, 'Sampai pada tujuan / Arrived at the destination'),
(5, 'Dikomplain / Complained'),
(6, 'Dibatalkan / Cancelled'),
(7, 'Ditolak / Rejected'),
(8, 'Pembayaran gagal / Payment failed'),
(9, 'Selesai / Completed');

-- --------------------------------------------------------

--
-- Table structure for table `payment_method`
--

CREATE TABLE `payment_method` (
  `pay_id` int(11) NOT NULL,
  `pay_name` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payment_method`
--

INSERT INTO `payment_method` (`pay_id`, `pay_name`) VALUES
(1, 'Manual Transfer'),
(2, 'Payment Gateway DOKU');

-- --------------------------------------------------------

--
-- Table structure for table `pedigrees`
--

CREATE TABLE `pedigrees` (
  `ped_id` int(11) NOT NULL,
  `ped_sire_id` int(11) NOT NULL,
  `ped_dam_id` int(11) NOT NULL,
  `ped_canine_id` int(11) NOT NULL,
  `ped_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `ped_user` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `pedigrees`
--

INSERT INTO `pedigrees` (`ped_id`, `ped_sire_id`, `ped_dam_id`, `ped_canine_id`, `ped_date`, `ped_user`) VALUES
(1, 1, 2, 1, '2023-02-10 05:52:40', 0),
(2, 1, 2, 2, '2023-02-10 05:52:40', 0),
(3, 1, 2, 3, '2023-06-25 11:53:35', 0),
(4, 1, 2, 4, '2023-06-25 11:57:59', 0),
(5, 1, 2, 5, '2023-06-25 12:02:01', 0),
(6, 1, 2, 6, '2023-06-25 12:02:51', 0),
(7, 3, 5, 7, '2023-06-25 12:37:24', 0),
(8, 1, 2, 8, '2023-06-25 12:40:15', 0),
(9, 8, 7, 9, '2023-06-25 12:51:06', 0),
(10, 8, 7, 10, '2023-06-25 12:51:09', 0),
(11, 1, 2, 11, '2023-06-25 14:29:13', 0),
(12, 1, 2, 12, '2023-06-25 14:31:17', 0),
(13, 1, 2, 13, '2023-06-25 14:32:47', 0),
(14, 1, 2, 14, '2023-06-25 14:44:38', 0),
(15, 1, 2, 15, '2023-06-25 14:45:48', 0),
(16, 1, 2, 16, '2023-06-25 14:46:48', 0),
(17, 1, 2, 17, '2023-06-25 14:47:37', 0),
(18, 1, 2, 18, '2023-06-25 14:48:20', 0),
(19, 1, 2, 19, '2023-06-25 14:49:43', 0),
(20, 1, 2, 20, '2023-06-25 14:50:16', 0),
(21, 1, 2, 21, '2023-06-25 14:51:07', 0),
(22, 1, 2, 22, '2023-06-25 14:53:55', 0),
(23, 1, 2, 23, '2023-06-25 15:03:54', 0),
(24, 1, 2, 24, '2023-06-25 15:04:43', 0),
(25, 1, 2, 25, '2023-06-25 15:05:29', 0),
(26, 1, 2, 26, '2023-06-25 15:06:57', 0),
(27, 1, 2, 27, '2023-06-25 16:22:27', 0),
(28, 1, 2, 28, '2023-06-25 22:58:45', 0),
(29, 28, 9, 29, '2023-06-25 23:09:28', 0),
(30, 1, 2, 30, '2023-06-25 23:13:56', 0),
(31, 25, 30, 31, '2023-06-25 23:19:57', 0),
(32, 31, 29, 32, '2023-06-25 23:26:59', 0),
(33, 31, 29, 33, '2023-06-25 23:27:02', 0),
(34, 1, 2, 34, '2023-06-25 23:34:05', 0),
(35, 1, 2, 35, '2023-06-25 23:34:34', 0),
(36, 1, 2, 36, '2023-06-25 23:45:50', 0),
(37, 1, 2, 37, '2023-06-26 00:04:43', 0),
(38, 1, 2, 38, '2023-06-26 00:05:26', 0),
(39, 1, 2, 39, '2023-06-26 00:13:00', 0),
(40, 1, 2, 40, '2023-06-26 00:13:27', 0),
(41, 1, 2, 41, '2023-12-13 01:28:01', 0),
(42, 1, 2, 42, '2023-12-13 01:38:36', 0),
(43, 1, 2, 43, '2023-12-13 01:41:37', 0),
(44, 1, 2, 44, '2023-12-13 01:46:04', 0),
(45, 1, 2, 45, '2023-12-13 01:55:25', 0),
(46, 1, 2, 46, '2023-12-13 02:05:39', 0),
(47, 1, 2, 47, '2023-12-13 02:19:15', 0),
(48, 1, 2, 48, '2023-12-13 03:04:02', 0),
(49, 1, 2, 49, '2023-12-13 03:32:49', 0),
(50, 1, 2, 50, '2023-12-13 03:53:57', 0),
(51, 1, 2, 51, '2023-12-13 03:55:04', 0),
(52, 1, 2, 52, '2023-12-13 03:58:09', 0),
(53, 52, 33, 53, '2023-12-13 04:18:45', 0),
(54, 1, 2, 54, '2023-12-13 07:38:50', 0),
(55, 1, 2, 55, '2023-12-13 09:03:04', 0),
(56, 1, 2, 56, '2023-12-13 09:03:36', 0),
(57, 1, 2, 57, '2023-12-13 09:17:27', 0),
(58, 1, 2, 58, '2023-12-13 09:47:53', 0),
(59, 1, 2, 59, '2023-12-14 08:29:55', 0),
(60, 52, 29, 60, '2023-12-14 11:30:48', 0),
(61, 52, 29, 61, '2023-12-14 11:30:51', 0),
(62, 52, 29, 62, '2023-12-14 12:04:57', 0),
(63, 52, 29, 63, '2023-12-14 12:04:59', 0),
(64, 1, 2, 64, '2023-12-16 07:55:04', 0),
(66, 52, 29, 66, '2023-12-16 09:13:50', 0),
(67, 52, 29, 67, '2023-12-16 09:42:17', 0),
(68, 52, 29, 68, '2023-12-16 09:42:17', 0),
(69, 52, 29, 69, '2023-12-16 09:42:17', 0),
(70, 52, 29, 70, '2023-12-16 09:42:17', 0),
(71, 52, 29, 71, '2023-12-18 06:23:48', 0),
(72, 52, 29, 72, '2023-12-18 08:18:34', 0),
(73, 52, 29, 73, '2023-12-18 08:18:37', 0),
(74, 52, 29, 74, '2023-12-18 08:18:39', 0),
(75, 52, 29, 75, '2023-12-18 09:15:33', 0),
(76, 52, 29, 76, '2023-12-18 09:15:35', 0),
(77, 1, 2, 77, '2023-12-18 13:43:14', 0),
(78, 77, 33, 78, '2023-12-18 13:58:35', 0),
(79, 77, 33, 79, '2023-12-18 13:58:37', 0);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `pro_id` int(11) NOT NULL,
  `pro_type_id` int(11) NOT NULL,
  `pro_name` varchar(100) NOT NULL,
  `pro_price` int(11) NOT NULL,
  `pro_weight` int(11) NOT NULL,
  `pro_stock` int(11) NOT NULL,
  `pro_desc` text NOT NULL,
  `pro_photo` varchar(255) NOT NULL,
  `pro_created_user` tinyint(4) NOT NULL,
  `pro_updated_user` tinyint(4) NOT NULL,
  `pro_created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `pro_updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `pro_stat` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`pro_id`, `pro_type_id`, `pro_name`, `pro_price`, `pro_weight`, `pro_stock`, `pro_desc`, `pro_photo`, `pro_created_user`, `pro_updated_user`, `pro_created_at`, `pro_updated_at`, `pro_stat`) VALUES
(1, 2, 'Blackwood Salmon Meal', 25000, 500, 87, 'adalah resep beraroma, mudah dicerna yang memberikan nutrisi superior di setiap dosisnya. Ini dimasak lambat dalam partai kecil untuk hasil yang maksimal, dan membuat anjing yang sehat. Makanan ini bisa buat diet khusus untuk kulit sensitif dan perut, tanpa jagung, gandum atau kedelai dan dibuat dengan protein domba yang holistik, super premium, alami', 'product_1686155470.png', 1, 8, '2023-06-07 16:31:10', '2023-12-12 07:58:48', 1),
(2, 1, 'Milk-Bone Soft & Chewy Dog Treats', 70000, 50, 42, '', 'product_milk-bone.png', 1, 2, '2023-06-12 11:30:15', '2023-12-11 05:05:55', 1),
(3, 3, 'Bolt Dog Food', 100000, 1000, 16, '', 'product_1686569436.png', 1, 2, '2023-06-12 11:30:36', '2023-12-11 05:06:01', 1),
(4, 2, 'Pedigree Pouch', 50000, 150, 42, '', 'product_1686573819.png', 1, 2, '2023-06-12 12:43:39', '2023-12-11 05:05:50', 1);

-- --------------------------------------------------------

--
-- Table structure for table `products_type`
--

CREATE TABLE `products_type` (
  `pro_type_id` int(11) NOT NULL,
  `pro_type_name` varchar(50) NOT NULL,
  `pro_type_stat` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `products_type`
--

INSERT INTO `products_type` (`pro_type_id`, `pro_type_name`, `pro_type_stat`) VALUES
(1, 'Snack', 1),
(2, 'Makanan anak anjing / Puppy food', 1),
(3, 'Makanan anjing dewasa / Adult dog food', 1);

-- --------------------------------------------------------

--
-- Table structure for table `province`
--

CREATE TABLE `province` (
  `prov_id` int(11) NOT NULL,
  `prov_name` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `province`
--

INSERT INTO `province` (`prov_id`, `prov_name`) VALUES
(1, 'Bali'),
(2, 'Bangka Belitung'),
(3, 'Banten'),
(4, 'Bengkulu'),
(5, 'DI Yogyakarta'),
(6, 'DKI Jakarta'),
(7, 'Gorontalo'),
(8, 'Jambi'),
(9, 'Jawa Barat'),
(10, 'Jawa Tengah'),
(11, 'Jawa Timur'),
(12, 'Kalimantan Barat'),
(13, 'Kalimantan Selatan'),
(14, 'Kalimantan Tengah'),
(15, 'Kalimantan Timur'),
(16, 'Kalimantan Utara'),
(17, 'Kepulauan Riau'),
(18, 'Lampung'),
(19, 'Maluku'),
(20, 'Maluku Utara'),
(21, 'Nanggroe Aceh Darussalam (NAD)'),
(22, 'Nusa Tenggara Barat (NTB)'),
(23, 'Nusa Tenggara Timur (NTT)'),
(24, 'Papua'),
(25, 'Papua Barat'),
(26, 'Riau'),
(27, 'Sulawesi Barat'),
(28, 'Sulawesi Selatan'),
(29, 'Sulawesi Tengah'),
(30, 'Sulawesi Tenggara'),
(31, 'Sulawesi Utara'),
(32, 'Sumatera Barat'),
(33, 'Sumatera Selatan'),
(34, 'Sumatera Utara');

-- --------------------------------------------------------

--
-- Table structure for table `reject_reasons`
--

CREATE TABLE `reject_reasons` (
  `rej_id` int(11) NOT NULL,
  `rej_name` varchar(100) NOT NULL,
  `rej_type` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reject_reasons`
--

INSERT INTO `reject_reasons` (`rej_id`, `rej_name`, `rej_type`) VALUES
(1, 'Kendala pengiriman / Delivery problem', 'Order'),
(2, 'Terlalu sering meminta sertifikat / Certificate requested too often', 'Certificate'),
(3, 'Kendala pengiriman / Delivery problem', 'Certificate'),
(4, 'Pembayaran tidak diterima / Payment not received', 'Microchip'),
(5, 'Tanggal kunjungan tidak disetujui / Appointment date not approved', 'Microchip'),
(8, 'Alasan pengajuan tidak valid / Reason for the request is not valid', 'Certificate');

-- --------------------------------------------------------

--
-- Table structure for table `requests_certificate`
--

CREATE TABLE `requests_certificate` (
  `req_id` int(11) NOT NULL,
  `req_mem_id` int(11) NOT NULL,
  `req_can_id` int(11) NOT NULL,
  `req_stat_id` int(11) NOT NULL,
  `req_created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `req_updated_at` timestamp NULL DEFAULT NULL,
  `req_updated_by` int(11) DEFAULT NULL,
  `req_arrived_date` timestamp NULL DEFAULT NULL,
  `req_reject_note` text DEFAULT NULL,
  `req_desc` text NOT NULL,
  `req_city_id` int(11) NOT NULL,
  `req_address` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `requests_certificate`
--

INSERT INTO `requests_certificate` (`req_id`, `req_mem_id`, `req_can_id`, `req_stat_id`, `req_created_at`, `req_updated_at`, `req_updated_by`, `req_arrived_date`, `req_reject_note`, `req_desc`, `req_city_id`, `req_address`) VALUES
(1, 13, 22, 1, '2023-06-25 16:57:12', '2023-06-25 16:57:20', 2, '2023-06-25 16:57:20', NULL, 'Pembuatan sertifikat pertama', 0, ''),
(2, 13, 20, 2, '2023-06-25 16:59:36', '2023-06-25 17:00:07', 2, NULL, NULL, 'Sertifikat yang lama rusak', 0, ''),
(3, 13, 19, 2, '2023-06-25 17:00:02', '2023-12-12 08:14:45', 2, NULL, NULL, 'Permintaan sertifikat dengan desain baru', 0, ''),
(4, 13, 52, 4, '2023-12-13 04:02:54', NULL, NULL, NULL, NULL, 'tes', 0, ''),
(5, 13, 54, 4, '2023-12-15 05:57:36', NULL, NULL, NULL, NULL, 'new cert', 3, 'aceh no. 2 12b 44012'),
(6, 13, 54, 4, '2023-12-15 06:05:55', NULL, NULL, NULL, NULL, 'new cert', 5, 'aceh no. 2 12b 44012'),
(7, 13, 54, 4, '2023-12-15 06:06:03', NULL, NULL, NULL, NULL, 'new cert', 5, 'aceh no. 2 12b 44012'),
(8, 13, 54, 5, '2023-12-15 06:24:28', '2023-12-15 06:29:55', 2, NULL, 'kendala pengiriman', 'new cert', 5, 'aceh no. 2 12b 44012'),
(9, 13, 54, 6, '2023-12-15 06:30:27', '2023-12-15 07:14:25', 2, '2023-12-15 06:49:46', '', 'pembuatan sertifikat baru', 2, 'daya 2'),
(12, 13, 54, 6, '2023-12-15 08:15:35', '2023-12-15 08:17:02', 2, '2023-12-15 08:17:02', '', 'sertifikat baru', 2, 'barat daya 2'),
(13, 13, 54, 5, '2023-12-15 08:16:02', '2023-12-15 08:16:44', 2, NULL, 'Terlalu sering meminta sertifikat / Certificate requested too often', 'sertifikat kedua', 5, 'selatan 3');

-- --------------------------------------------------------

--
-- Table structure for table `requests_member`
--

CREATE TABLE `requests_member` (
  `req_id` int(11) NOT NULL,
  `req_member_id` int(11) NOT NULL,
  `req_name` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `req_address` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `req_mail_address` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `req_hp` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `req_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `req_stat` int(4) NOT NULL,
  `req_app_user` int(4) NOT NULL,
  `req_app_date` timestamp NULL DEFAULT NULL,
  `req_email` varchar(50) NOT NULL,
  `req_kota` varchar(50) NOT NULL,
  `req_kode_pos` varchar(10) NOT NULL,
  `req_ktp` varchar(30) NOT NULL,
  `req_kennel_id` int(11) NOT NULL,
  `req_kennel_name` varchar(50) NOT NULL,
  `req_kennel_type_id` int(11) NOT NULL,
  `req_kennel_photo` text NOT NULL,
  `req_old_name` varchar(50) NOT NULL,
  `req_old_address` varchar(100) NOT NULL,
  `req_old_mail_address` varchar(100) NOT NULL,
  `req_old_hp` varchar(20) NOT NULL,
  `req_old_email` varchar(50) NOT NULL,
  `req_old_kota` varchar(50) NOT NULL,
  `req_old_kode_pos` varchar(10) NOT NULL,
  `req_old_ktp` varchar(30) NOT NULL,
  `req_old_kennel_name` varchar(50) NOT NULL,
  `req_old_kennel_type_id` int(11) NOT NULL,
  `req_old_kennel_photo` text NOT NULL,
  `req_app_note` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `requests_member`
--

INSERT INTO `requests_member` (`req_id`, `req_member_id`, `req_name`, `req_address`, `req_mail_address`, `req_hp`, `req_date`, `req_stat`, `req_app_user`, `req_app_date`, `req_email`, `req_kota`, `req_kode_pos`, `req_ktp`, `req_kennel_id`, `req_kennel_name`, `req_kennel_type_id`, `req_kennel_photo`, `req_old_name`, `req_old_address`, `req_old_mail_address`, `req_old_hp`, `req_old_email`, `req_old_kota`, `req_old_kode_pos`, `req_old_ktp`, `req_old_kennel_name`, `req_old_kennel_type_id`, `req_old_kennel_photo`, `req_app_note`) VALUES
(1, 6, 'DIMAS SIHOMBING', 'Jl Jend Gatot Subroto 42', 'Jl Jend Gatot Subroto 42', '081299396500', '2023-06-25 11:31:28', 0, 0, NULL, 'dimas@gmail.com', 'Jakarta', '12710', '3525016005650004', 6, 'SCHAFFER RIDGE', 2, '-', 'DIMAS SIHOMBING', 'Jl Jend Gatot Subroto 44', 'Jl Jend Gatot Subroto 44', '081299396500', 'dimas@gmail.com', 'Jakarta', '12710', '3525016005650004', 'SCHAFFER RIDGE', 2, 'kennel_1687690448.png', ''),
(2, 10, 'MILA MULYANA', 'Jl Adi Sucipto 68, Dandangan', 'Jl Adi Sucipto 68, Dandangan', '081299396410', '2023-06-25 11:32:06', 0, 0, NULL, 'mila20@gmail.com', 'Kediri', '64131', '3525015306780002', 10, 'EXPLOSIVE', 1, '-', 'MILA MULYANI', 'Jl Adi Sucipto 68, Dandangan', 'Jl Adi Sucipto 68, Dandangan', '081299396410', 'mila20@gmail.com', 'Kediri', '64131', '3525015306780002', 'EXPLOSIVE', 1, 'kennel_1687691661.png', ''),
(3, 16, 'RUDY GOBERT', 'address test', 'mail address test', '0239209302', '2023-12-12 12:32:21', 1, 2, '2023-12-12 12:32:41', 'rudyg@gmail.com', 'Kabupaten Bengkalis', '0932', '01293812932', 16, 'GOBERT', 2, '-', 'RUDY GOBERT', 'address test', 'mail address test', '0239209302', 'rudyg@gmail.com', 'Kabupaten Bengkulu Utara', '0932', '01293812932', 'GOBERT', 2, 'kennel_1702378081.png', '');

-- --------------------------------------------------------

--
-- Table structure for table `requests_microchip`
--

CREATE TABLE `requests_microchip` (
  `req_id` int(11) NOT NULL,
  `req_mem_id` int(11) NOT NULL,
  `req_can_id` int(11) NOT NULL,
  `req_stat_id` int(11) NOT NULL,
  `req_created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `req_updated_at` timestamp NULL DEFAULT NULL,
  `req_updated_by` int(11) DEFAULT NULL,
  `req_datetime` datetime NOT NULL,
  `req_reject_note` text DEFAULT NULL,
  `req_pay_photo` text DEFAULT NULL,
  `req_pay_id` int(11) NOT NULL,
  `req_pay_invoice` varchar(60) DEFAULT NULL,
  `req_pay_due_date` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `requests_microchip`
--

INSERT INTO `requests_microchip` (`req_id`, `req_mem_id`, `req_can_id`, `req_stat_id`, `req_created_at`, `req_updated_at`, `req_updated_by`, `req_datetime`, `req_reject_note`, `req_pay_photo`, `req_pay_id`, `req_pay_invoice`, `req_pay_due_date`) VALUES
(1, 13, 22, 5, '2023-06-25 16:35:36', '2023-06-25 16:55:41', 2, '2023-06-30 11:00:00', NULL, 'payment_1687710936.png', 0, NULL, NULL),
(2, 13, 20, 0, '2023-06-25 16:58:22', NULL, NULL, '2023-06-29 09:00:00', NULL, 'payment_1687712302.png', 0, NULL, NULL),
(3, 13, 19, 1, '2023-06-25 16:58:48', '2023-06-25 16:59:06', 2, '2023-06-27 09:00:00', NULL, 'payment_1687712328.png', 0, NULL, NULL),
(4, 13, 76, 4, '2023-12-18 10:21:58', NULL, NULL, '2023-12-17 00:00:00', NULL, 'payment_1702894918.png', 0, NULL, NULL),
(5, 13, 76, 4, '2023-12-18 10:46:10', NULL, NULL, '2023-12-19 00:00:00', NULL, 'payment_1702896370.png', 0, NULL, NULL),
(6, 13, 76, 2, '2023-12-18 10:50:34', '2023-12-18 10:50:47', 2, '2023-12-19 00:00:00', 'Tanggal kunjungan tidak disetujui / Appointment date not approved', 'payment_1702896634.png', 0, NULL, NULL),
(7, 13, 76, 4, '2023-12-18 11:26:51', NULL, NULL, '2023-12-19 10:37:00', NULL, '-', 2, 'TESCHIP-95842658', '2023-12-18 12:26:51'),
(8, 13, 76, 5, '2023-12-18 11:39:48', '2023-12-18 12:00:00', 2, '2023-12-19 04:26:00', '', '-', 2, 'TESCHIP-17262372', '2023-12-18 12:39:48'),
(9, 13, 76, 4, '2023-12-18 12:03:52', '2023-12-18 12:08:17', 2, '2023-12-19 00:00:00', '', 'payment_1702901032.png', 1, '-', NULL),
(12, 13, 76, 8, '2023-12-18 12:34:26', NULL, NULL, '2023-12-19 00:00:00', NULL, '-', 2, 'TESCHIP-01430761', '2023-12-17 13:34:26');

-- --------------------------------------------------------

--
-- Table structure for table `requests_ownership_canine`
--

CREATE TABLE `requests_ownership_canine` (
  `req_id` int(11) NOT NULL,
  `req_can_id` int(11) NOT NULL,
  `req_app_user` int(4) NOT NULL,
  `req_app_date` timestamp NULL DEFAULT NULL,
  `req_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `req_stat` tinyint(4) NOT NULL DEFAULT 0,
  `req_kennel_id` int(11) NOT NULL DEFAULT 0,
  `req_member_id` int(11) NOT NULL DEFAULT 0,
  `req_old_kennel_id` int(11) NOT NULL,
  `req_old_member_id` int(11) NOT NULL,
  `req_app_note` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `requests_ownership_canine`
--

INSERT INTO `requests_ownership_canine` (`req_id`, `req_can_id`, `req_app_user`, `req_app_date`, `req_date`, `req_stat`, `req_kennel_id`, `req_member_id`, `req_old_kennel_id`, `req_old_member_id`, `req_app_note`) VALUES
(1, 10, 2, '2023-06-25 12:52:35', '2023-06-25 12:52:28', 1, 6, 6, 4, 4, ''),
(2, 9, 2, '2023-06-25 22:52:55', '2023-06-25 22:52:42', 1, 13, 13, 4, 4, ''),
(3, 35, 2, '2023-06-25 23:39:17', '2023-06-25 23:38:55', 1, 13, 13, 15, 15, ''),
(4, 34, 2, '2023-06-25 23:39:14', '2023-06-25 23:39:07', 1, 13, 13, 15, 15, ''),
(5, 52, 2, '2023-12-13 04:03:42', '2023-12-13 04:03:04', 2, 19, 19, 13, 13, '-'),
(6, 79, 2, '2023-12-18 13:59:32', '2023-12-18 13:59:24', 1, 39, 39, 13, 13, '');

-- --------------------------------------------------------

--
-- Table structure for table `requests_pro`
--

CREATE TABLE `requests_pro` (
  `req_id` int(11) NOT NULL,
  `req_member_id` int(11) NOT NULL,
  `req_name` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `req_address` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `req_mail_address` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `req_hp` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `req_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `req_stat` int(4) NOT NULL,
  `req_app_user` int(4) NOT NULL,
  `req_app_date` timestamp NULL DEFAULT NULL,
  `req_email` varchar(50) NOT NULL,
  `req_kota` varchar(50) NOT NULL,
  `req_kode_pos` varchar(10) NOT NULL,
  `req_ktp` varchar(30) NOT NULL,
  `req_kennel_id` int(11) NOT NULL,
  `req_kennel_name` varchar(50) NOT NULL,
  `req_kennel_type_id` int(11) NOT NULL,
  `req_kennel_photo` text NOT NULL,
  `req_old_name` varchar(50) NOT NULL,
  `req_old_address` varchar(100) NOT NULL,
  `req_old_mail_address` varchar(100) NOT NULL,
  `req_old_hp` varchar(20) NOT NULL,
  `req_old_email` varchar(50) NOT NULL,
  `req_old_kota` varchar(50) NOT NULL,
  `req_old_kode_pos` varchar(10) NOT NULL,
  `req_old_ktp` varchar(30) NOT NULL,
  `req_old_kennel_name` varchar(50) NOT NULL,
  `req_old_kennel_type_id` int(11) NOT NULL,
  `req_old_kennel_photo` text NOT NULL,
  `req_app_note` text NOT NULL,
  `req_pay_id` int(11) NOT NULL,
  `req_pay_photo` text NOT NULL,
  `req_pay_invoice` varchar(60) DEFAULT NULL,
  `req_pay_due_date` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `requests_pro`
--

INSERT INTO `requests_pro` (`req_id`, `req_member_id`, `req_name`, `req_address`, `req_mail_address`, `req_hp`, `req_date`, `req_stat`, `req_app_user`, `req_app_date`, `req_email`, `req_kota`, `req_kode_pos`, `req_ktp`, `req_kennel_id`, `req_kennel_name`, `req_kennel_type_id`, `req_kennel_photo`, `req_old_name`, `req_old_address`, `req_old_mail_address`, `req_old_hp`, `req_old_email`, `req_old_kota`, `req_old_kode_pos`, `req_old_ktp`, `req_old_kennel_name`, `req_old_kennel_type_id`, `req_old_kennel_photo`, `req_app_note`, `req_pay_id`, `req_pay_photo`, `req_pay_invoice`, `req_pay_due_date`) VALUES
(1, 3, 'ELMA OKTAVIANI', 'Jl Pasar Indralaya Ds Indralaya', 'Jl Pasar Indralaya Ds Indralaya', '081299396402', '2023-06-25 11:40:18', 0, 0, NULL, 'elma@gmail.com', 'Palembang', '30862', '3525017006650078', 3, 'Underdog', 1, 'kennel_1687693218.png', 'ELMA OKTAVIANI', '', '', '081299396402', 'elma@gmail.com', '', '', '', '', 0, '-', '', 0, 'payment_1687693218.png', '', NULL),
(2, 17, 'ALDY GOBER', 'address aldy', 'mail aldy', '23092032', '2023-12-12 13:16:56', 1, 2, '2023-12-12 13:17:12', 'aldygobert@gmail.com', 'Kota Yogyakarta', '23232', '0232893238', 17, 'Gobers', 2, 'kennel_1702387016.png', 'ALDY GOBER', '', '', '23092032', 'aldygobert@gmail.com', '', '', '', '', 0, '-', '', 0, 'payment_1702387016.png', '', NULL),
(14, 34, 'WARAH2', 'warah', 'warah', '1231231', '2023-12-13 09:28:31', 1, 2, '2023-12-13 09:29:31', 'warah2@gmail.com', 'Kabupaten Aceh Barat Daya', '239823', '12938239', 34, 'WARAH2', 2, '-', 'WARAH2', 'warah', 'warah', '1231231', 'warah2@gmail.com', 'Kabupaten Aceh Barat Daya', '239823', '12938239', 'WARAH2', 2, 'kennel_1702455196.png', '', 2, '-', 'TESMB-10417869', '2023-12-13 10:28:31'),
(15, 34, 'WARAH2', 'warah', 'warah', '1231231', '2023-12-13 09:29:53', 6, 0, NULL, 'warah2@gmail.com', 'Kabupaten Aceh Barat Daya', '239823', '12938239', 34, 'WARAH2', 2, '-', 'WARAH2', 'warah', 'warah', '1231231', 'warah2@gmail.com', 'Kabupaten Aceh Barat Daya', '239823', '12938239', 'WARAH2', 2, 'kennel_1702455196.png', '', 2, '-', 'TESMB-83094149', '2023-12-13 08:29:53'),
(16, 34, 'WARAH2', 'warah', 'warah', '1231231', '2023-12-13 09:40:50', 2, 2, '2023-12-13 09:49:39', 'warah2@gmail.com', 'Kabupaten Aceh Barat Daya', '239823', '12938239', 34, 'WARAH2', 2, '-', 'WARAH2', 'warah', 'warah', '1231231', 'warah2@gmail.com', 'Kabupaten Aceh Barat Daya', '239823', '12938239', 'WARAH2', 2, 'kennel_1702455196.png', 'del', 2, '-', 'TESMB-50701181', '2023-12-13 10:40:50'),
(17, 34, 'WARAH2', 'warah', 'warah', '1231231', '2023-12-13 09:49:44', 4, 0, NULL, 'warah2@gmail.com', 'Kabupaten Aceh Barat Daya', '239823', '12938239', 34, 'WARAH2', 2, '-', 'WARAH2', 'warah', 'warah', '1231231', 'warah2@gmail.com', 'Kabupaten Aceh Barat Daya', '239823', '12938239', 'WARAH2', 2, 'kennel_1702455196.png', '', 2, '-', 'TESMB-81456134', '2023-12-13 10:49:44'),
(18, 34, 'WARAH2', 'warah', 'warah', '1231231', '2023-12-13 09:56:40', 4, 0, NULL, 'warah2@gmail.com', 'Kabupaten Aceh Barat Daya', '239823', '12938239', 34, 'WARAH2', 2, '-', 'WARAH2', 'warah', 'warah', '1231231', 'warah2@gmail.com', 'Kabupaten Aceh Barat Daya', '239823', '12938239', 'WARAH2', 2, 'kennel_1702455196.png', '', 2, '-', 'TESMB-86234110', '2023-12-13 10:56:40'),
(19, 34, 'WARAH2', 'warah', 'warah', '1231231', '2023-12-13 10:02:43', 1, 2, '2023-12-13 10:04:00', 'warah2@gmail.com', 'Kabupaten Aceh Barat Daya', '239823', '12938239', 34, 'WARAH2', 2, '-', 'WARAH2', 'warah', 'warah', '1231231', 'warah2@gmail.com', 'Kabupaten Aceh Barat Daya', '239823', '12938239', 'WARAH2', 2, 'kennel_1702455196.png', '', 2, '-', 'TESMB-82780539', '2023-12-13 11:02:43');

-- --------------------------------------------------------

--
-- Table structure for table `requests_update_birth`
--

CREATE TABLE `requests_update_birth` (
  `req_id` int(11) NOT NULL,
  `req_bir_id` int(11) NOT NULL,
  `req_member_id` int(11) NOT NULL,
  `req_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `req_app_user` int(4) NOT NULL,
  `req_app_date` timestamp NULL DEFAULT NULL,
  `req_stat` tinyint(4) NOT NULL DEFAULT 0,
  `req_date_of_birth` date NOT NULL,
  `req_dam_photo` text NOT NULL,
  `req_male` int(11) NOT NULL,
  `req_female` int(11) NOT NULL,
  `req_old_date_of_birth` date NOT NULL,
  `req_old_dam_photo` text NOT NULL,
  `req_old_male` int(11) NOT NULL,
  `req_old_female` int(11) NOT NULL,
  `req_app_note` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `requests_update_birth`
--

INSERT INTO `requests_update_birth` (`req_id`, `req_bir_id`, `req_member_id`, `req_date`, `req_app_user`, `req_app_date`, `req_stat`, `req_date_of_birth`, `req_dam_photo`, `req_male`, `req_female`, `req_old_date_of_birth`, `req_old_dam_photo`, `req_old_male`, `req_old_female`, `req_app_note`) VALUES
(1, 3, 13, '2023-06-26 23:33:08', 2, '2023-06-26 23:33:32', 2, '2023-05-11', '-', 2, 1, '2023-05-10', 'birth_1687706450.png', 2, 1, 'tidak valid'),
(2, 3, 13, '2023-06-26 23:34:00', 2, '2023-06-26 23:34:05', 2, '2023-05-25', '-', 2, 1, '2023-05-10', 'birth_1687706450.png', 2, 1, '-'),
(3, 3, 13, '2023-06-26 23:34:42', 2, '2023-06-26 23:40:50', 1, '2023-05-12', '-', 2, 1, '2023-05-10', 'birth_1687706450.png', 2, 1, ''),
(4, 3, 13, '2023-06-26 23:41:11', 2, '2023-06-26 23:41:18', 2, '2023-05-12', '-', 2, 10, '2023-05-12', 'birth_1687706450.png', 2, 1, 'a'),
(5, 3, 13, '2023-06-26 23:41:30', 2, '2023-06-26 23:41:35', 1, '2023-05-12', '-', 2, 10000, '2023-05-12', 'birth_1687706450.png', 2, 1, ''),
(6, 3, 13, '2023-06-26 23:46:09', 2, '2023-06-26 23:47:57', 1, '2023-05-13', '-', 2, 10000, '2023-05-12', 'birth_1687706450.png', 2, 10000, ''),
(7, 10, 13, '2023-12-14 07:18:03', 2, '2023-12-14 07:18:20', 1, '2023-12-13', '-', 2, 2, '2023-10-01', 'birth_1702532485.png', 2, 1, '');

-- --------------------------------------------------------

--
-- Table structure for table `requests_update_canine`
--

CREATE TABLE `requests_update_canine` (
  `req_id` int(11) NOT NULL,
  `req_can_id` int(11) NOT NULL,
  `req_app_user` int(4) NOT NULL,
  `req_app_date` timestamp NULL DEFAULT NULL,
  `req_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `req_stat` tinyint(4) NOT NULL DEFAULT 0,
  `req_photo` text NOT NULL,
  `req_old_photo` text NOT NULL,
  `req_member_id` int(11) NOT NULL,
  `req_rip` tinyint(4) NOT NULL,
  `req_app_note` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `requests_update_canine`
--

INSERT INTO `requests_update_canine` (`req_id`, `req_can_id`, `req_app_user`, `req_app_date`, `req_date`, `req_stat`, `req_photo`, `req_old_photo`, `req_member_id`, `req_rip`, `req_app_note`) VALUES
(1, 35, 2, '2023-06-26 23:03:35', '2023-06-26 23:03:12', 2, '-', 'canine_1687736074.png', 13, 0, '-'),
(2, 35, 2, '2023-06-26 23:04:29', '2023-06-26 23:04:01', 2, '-', 'canine_1687736074.png', 13, 1, 'tes '),
(3, 35, 2, '2023-06-26 23:04:57', '2023-06-26 23:04:48', 2, '-', 'canine_1687736074.png', 13, 0, ' a'),
(4, 35, 2, '2023-06-26 23:28:46', '2023-06-26 23:07:21', 2, '-', 'canine_1687736074.png', 13, 0, '-'),
(5, 35, 2, '2023-06-26 23:28:56', '2023-06-26 23:28:52', 1, '-', 'canine_1687736074.png', 13, 1, ''),
(6, 34, 2, '2023-06-26 23:29:30', '2023-06-26 23:29:26', 1, '-', 'canine_1687736045.png', 13, 1, ''),
(7, 35, 2, '2023-06-26 23:30:12', '2023-06-26 23:30:07', 1, 'canine_1687822207.png', 'canine_1687736074.png', 13, 0, ''),
(8, 35, 2, '2023-06-26 23:47:04', '2023-06-26 23:46:55', 2, '-', 'canine_1687822207.png', 13, 0, '-'),
(9, 52, 2, '2023-12-13 04:03:30', '2023-12-13 04:03:11', 1, '-', 'canine_1702439889.png', 13, 1, '');

-- --------------------------------------------------------

--
-- Table structure for table `shipping`
--

CREATE TABLE `shipping` (
  `ship_id` int(11) NOT NULL,
  `ship_name` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `shipping`
--

INSERT INTO `shipping` (`ship_id`, `ship_name`) VALUES
(1, 'JNE'),
(2, 'TIKI'),
(3, 'POS');

-- --------------------------------------------------------

--
-- Table structure for table `stambums`
--

CREATE TABLE `stambums` (
  `stb_id` int(11) NOT NULL,
  `stb_bir_id` int(11) NOT NULL,
  `stb_a_s` varchar(50) NOT NULL,
  `stb_gender` varchar(10) NOT NULL,
  `stb_photo` text NOT NULL,
  `stb_stat` tinyint(4) NOT NULL DEFAULT 1,
  `stb_member_id` int(11) NOT NULL,
  `stb_app_user` tinyint(4) NOT NULL,
  `stb_app_date` timestamp NULL DEFAULT NULL,
  `stb_kennel_id` int(11) NOT NULL DEFAULT 0,
  `stb_date_of_birth` date NOT NULL,
  `stb_breed` varchar(50) NOT NULL,
  `stb_reg_date` timestamp NULL DEFAULT NULL,
  `stb_date` timestamp NULL DEFAULT NULL,
  `stb_user` tinyint(4) NOT NULL,
  `stb_can_id` int(11) NOT NULL,
  `stb_app_note` text NOT NULL,
  `stb_count` int(11) NOT NULL,
  `stb_pay_id` int(11) NOT NULL,
  `stb_pay_photo` text DEFAULT NULL,
  `stb_pay_invoice` varchar(60) DEFAULT NULL,
  `stb_pay_due_date` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `stambums`
--

INSERT INTO `stambums` (`stb_id`, `stb_bir_id`, `stb_a_s`, `stb_gender`, `stb_photo`, `stb_stat`, `stb_member_id`, `stb_app_user`, `stb_app_date`, `stb_kennel_id`, `stb_date_of_birth`, `stb_breed`, `stb_reg_date`, `stb_date`, `stb_user`, `stb_can_id`, `stb_app_note`, `stb_count`, `stb_pay_id`, `stb_pay_photo`, `stb_pay_invoice`, `stb_pay_due_date`) VALUES
(1, 1, 'ARIA VON NORTH SANTIAM', 'FEMALE', 'canine_1687696632.png', 1, 4, 2, '2023-06-25 12:37:24', 4, '2023-05-10', 'AMERICAN PIT BULL TERRIER', '2023-06-24 17:00:00', '2023-06-25 12:37:24', 2, 7, '', 0, 0, 'payment_1687696632.png', NULL, NULL),
(2, 2, 'DIONA VON NORTH SANTIAM', 'FEMALE', 'canine_1687697401.png', 1, 4, 2, '2023-06-25 12:51:09', 4, '2023-05-05', 'AMERICAN PIT BULL TERRIER', '2023-06-24 17:00:00', '2023-06-25 12:51:09', 2, 10, '', 0, 0, 'payment_1687697401.png', NULL, NULL),
(3, 2, 'AQUILA VON NORTH SANTIAM', 'FEMALE', 'canine_1687697458.png', 1, 4, 2, '2023-06-25 12:51:06', 4, '2023-05-05', 'AMERICAN PIT BULL TERRIER', '2023-06-24 17:00:00', '2023-06-25 12:51:06', 2, 9, '', 0, 0, 'payment_1687697458.png', NULL, NULL),
(4, 4, 'WILDLINE` ROBBIE', 'MALE', 'canine_1687734535.png', 0, 13, 0, NULL, 13, '2023-04-19', 'AMERICAN PIT BULL TERRIER', '2023-06-25 17:00:00', '2023-06-25 23:08:55', 1, 0, '', 0, 0, 'payment_1687734535.png', NULL, NULL),
(5, 4, 'WILDLINE` HANNAH', 'FEMALE', 'canine_1687734558.png', 1, 13, 2, '2023-06-25 23:09:28', 13, '2023-04-19', 'AMERICAN PIT BULL TERRIER', '2023-06-25 17:00:00', '2023-06-25 23:09:28', 2, 29, '', 0, 0, 'payment_1687734558.png', NULL, NULL),
(6, 5, 'CASSIUS VON LYNWOOD', 'MALE', 'canine_1687735126.png', 1, 15, 2, '2023-06-25 23:19:57', 15, '2023-04-19', 'AMERICAN PIT BULL TERRIER', '2023-06-25 17:00:00', '2023-06-25 23:19:57', 2, 31, '', 0, 0, 'payment_1687735126.png', NULL, NULL),
(7, 5, 'CORTANA VON LYNWOOD', 'FEMALE', 'canine_1687735165.png', 0, 15, 0, NULL, 15, '2023-04-19', 'AMERICAN PIT BULL TERRIER', '2023-06-25 17:00:00', '2023-06-25 23:19:25', 1, 0, '', 0, 0, 'payment_1687735165.png', NULL, NULL),
(8, 5, 'ELEANOR VON LYNWOOD', 'FEMALE', 'canine_1687735189.png', 0, 15, 0, NULL, 15, '2023-04-19', 'AMERICAN PIT BULL TERRIER', '2023-06-25 17:00:00', '2023-06-25 23:19:49', 1, 0, '', 0, 0, 'payment_1687735189.png', NULL, NULL),
(9, 6, 'WILDLINE` SANDRA', 'FEMALE', 'canine_1687735552.png', 1, 13, 2, '2023-06-25 23:27:02', 13, '2023-04-20', 'AMERICAN PIT BULL TERRIER', '2023-06-25 17:00:00', '2023-06-25 23:27:02', 2, 33, '', 0, 0, 'payment_1687735552.png', NULL, NULL),
(10, 6, 'WILDLINE` RENGAR', 'MALE', 'canine_1687735579.png', 1, 13, 2, '2023-06-25 23:26:59', 13, '2023-04-20', 'AMERICAN PIT BULL TERRIER', '2023-06-25 17:00:00', '2023-06-25 23:26:59', 2, 32, '', 0, 0, 'payment_1687735579.png', NULL, NULL),
(61, 11, 'WILDLINE` KENGO', 'MALE', 'canine_17029078941.png', 1, 13, 2, '2023-12-18 13:58:37', 13, '2023-10-24', 'AMERICAN PIT BULL TERRIER', '2023-12-18 13:58:14', '2023-12-18 13:58:37', 2, 79, '', 2, 2, '-', 'TESCAN-95568626', '2023-12-18 14:58:14'),
(62, 11, 'WILDLINE` TATIANA', 'MALE', 'canine_17029078942.png', 1, 13, 2, '2023-12-18 13:58:35', 13, '2023-10-24', 'AMERICAN PIT BULL TERRIER', '2023-12-18 13:58:14', '2023-12-18 13:58:35', 2, 78, '', 2, 2, '-', 'TESCAN-95568626', '2023-12-18 14:58:14');

-- --------------------------------------------------------

--
-- Table structure for table `studs`
--

CREATE TABLE `studs` (
  `stu_id` int(11) NOT NULL,
  `stu_sire_id` int(11) NOT NULL,
  `stu_sire_photo` text NOT NULL,
  `stu_dam_id` int(11) NOT NULL,
  `stu_dam_photo` text NOT NULL,
  `stu_stud_date` date NOT NULL,
  `stu_app_user` int(4) NOT NULL,
  `stu_app_date` timestamp NULL DEFAULT NULL,
  `stu_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `stu_user` tinyint(4) NOT NULL,
  `stu_reg_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `stu_photo` text NOT NULL,
  `stu_stat` tinyint(4) NOT NULL DEFAULT 0,
  `stu_member_id` int(11) NOT NULL,
  `stu_partner_id` int(11) DEFAULT NULL,
  `stu_app_note` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `studs`
--

INSERT INTO `studs` (`stu_id`, `stu_sire_id`, `stu_sire_photo`, `stu_dam_id`, `stu_dam_photo`, `stu_stud_date`, `stu_app_user`, `stu_app_date`, `stu_date`, `stu_user`, `stu_reg_date`, `stu_photo`, `stu_stat`, `stu_member_id`, `stu_partner_id`, `stu_app_note`) VALUES
(1, 3, 'sire_1687696407.png', 5, 'dam_1687696407.png', '2023-04-27', 2, '2023-06-25 12:33:34', '2023-03-13 12:33:34', 2, '2023-04-26 12:33:27', 'stud_1687696407.png', 3, 2, 4, ''),
(2, 8, 'sire_1687697008.png', 7, 'dam_1687697008.png', '2023-04-20', 2, '2023-06-25 12:43:50', '2023-03-07 12:43:50', 2, '2023-04-19 12:43:28', 'stud_1687697008.png', 3, 6, 4, ''),
(3, 26, 'sire_1687705861.png', 16, 'dam_1687705861.png', '2023-04-27', 2, '2023-06-25 15:12:28', '2023-06-25 15:12:28', 2, '2023-06-25 15:11:01', 'stud_1687705861.png', 1, 14, 13, ''),
(4, 24, 'sire_1687706249.png', 14, 'dam_1687706249.png', '2023-03-13', 2, '2023-06-25 15:17:41', '2023-06-25 15:17:41', 2, '2023-06-25 15:17:29', 'stud_1687706249.png', 3, 14, 13, ''),
(5, 28, 'sire_1687734285.png', 9, 'dam_1687734285.png', '2023-02-20', 2, '2023-06-25 23:04:56', '2023-06-25 23:04:56', 2, '2023-06-25 23:04:45', 'stud_1687734285.png', 3, 15, 13, ''),
(6, 25, 'sire_1687734953.png', 30, 'dam_1687734953.png', '2023-04-13', 2, '2023-06-25 23:16:02', '2023-06-25 23:16:02', 2, '2022-08-09 23:15:53', 'stud_1687734953.png', 3, 14, 15, ''),
(7, 31, 'sire_1687735466.png', 29, 'dam_1687735466.png', '2023-04-19', 2, '2023-06-25 23:24:31', '2023-06-25 23:24:31', 2, '2023-06-25 23:24:26', 'stud_1687735466.png', 3, 15, 13, ''),
(8, 34, 'sire_1687736403.png', 35, 'dam_1687736403.png', '2023-04-26', 2, '2023-06-25 23:40:56', '2023-06-25 23:40:56', 2, '2023-06-25 23:40:03', 'stud_1687736403.png', 1, 13, 13, ''),
(9, 36, 'sire_1687736902.png', 33, 'dam_1687736902.png', '2023-04-19', 2, '2023-06-25 23:48:32', '2023-06-25 23:48:32', 2, '2023-06-25 23:48:22', 'stud_1687736902.png', 3, 6, 13, ''),
(10, 38, 'sire_1687738065.png', 37, 'dam_1687738065.png', '2023-02-21', 2, '2023-06-26 00:07:52', '2023-06-26 00:07:52', 2, '2023-06-26 00:07:45', 'stud_1687738065.png', 3, 15, 15, ''),
(11, 39, 'sire_1687738506.png', 40, 'dam_1687738506.png', '2023-04-19', 0, NULL, '2023-06-26 00:15:06', 0, '2023-06-26 00:15:06', 'stud_1687738506.png', 0, 15, 15, ''),
(14, 77, 'sire_1702907155.png', 33, 'dam_1702907155.png', '2023-10-18', 2, '2023-12-18 13:46:13', '2023-12-18 13:46:31', 2, '2023-12-18 13:45:55', 'stud_1702907155.png', 3, 39, 13, '');

-- --------------------------------------------------------

--
-- Table structure for table `trah`
--

CREATE TABLE `trah` (
  `tra_id` int(11) NOT NULL,
  `tra_name` varchar(200) NOT NULL,
  `tra_stat` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `trah`
--

INSERT INTO `trah` (`tra_id`, `tra_name`, `tra_stat`) VALUES
(1, 'AMERICAN PIT BULL TERRIER', 1),
(2, 'GIANT POODLE', 1),
(11, 'DESIGNER BULLY', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `use_id` int(4) NOT NULL,
  `use_username` varchar(30) NOT NULL,
  `use_password` varchar(255) NOT NULL,
  `use_photo` varchar(255) NOT NULL,
  `use_stat` int(11) NOT NULL DEFAULT 1,
  `use_type_id` tinyint(4) NOT NULL DEFAULT 1
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`use_id`, `use_username`, `use_password`, `use_photo`, `use_stat`, `use_type_id`) VALUES
(2, 'Admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'user_1687685523.png', 1, 0),
(3, 'Andi', 'dbd122ef7b6a09ffecf5db9c9296320f3c94e707', 'user_1687685609.png', 1, 1),
(0, '', '8cb2237d0679ca88db6464eac60da96345513964', '-', 0, 1),
(1, 'System', '317f1e761f2faa8da781a4762b9dcc2c5cad209a', '-', 0, 1),
(5, 'Devi', '825e522c6f25f4d5e79c97adb96bf4d84f8606c2', '', 1, 1),
(6, 'Dika', 'f9c22e5c8b56ff08487e9a8e727df2a752438222', '', 1, 0),
(7, 'staff', '6ccb4b7c39a6e77f76ecfa935a855c6c46ad5611', '-', 1, 3),
(8, 'manager', '1a8565a9dc72048ba03b4156be3e569f22771f23', '-', 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `user_type`
--

CREATE TABLE `user_type` (
  `user_type_id` int(11) NOT NULL,
  `user_type_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `user_type`
--

INSERT INTO `user_type` (`user_type_id`, `user_type_name`) VALUES
(0, 'Super Admin'),
(1, 'Admin'),
(2, 'Stock Manager'),
(3, 'Staff');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `approval_status`
--
ALTER TABLE `approval_status`
  ADD PRIMARY KEY (`stat_id`);

--
-- Indexes for table `births`
--
ALTER TABLE `births`
  ADD PRIMARY KEY (`bir_id`),
  ADD KEY `fk_births_stud` (`bir_stu_id`),
  ADD KEY `fk_births_member_id` (`bir_member_id`);

--
-- Indexes for table `canines`
--
ALTER TABLE `canines`
  ADD PRIMARY KEY (`can_id`),
  ADD KEY `fk_canines_member` (`can_member_id`),
  ADD KEY `fk_canines_kennel_id` (`can_kennel_id`);

--
-- Indexes for table `canine_notes`
--
ALTER TABLE `canine_notes`
  ADD PRIMARY KEY (`note_id`),
  ADD KEY `fk_canine_notes_user` (`note_user`),
  ADD KEY `fk_note_canine` (`can_id`);

--
-- Indexes for table `certificate_complain`
--
ALTER TABLE `certificate_complain`
  ADD PRIMARY KEY (`com_id`);

--
-- Indexes for table `certificate_status`
--
ALTER TABLE `certificate_status`
  ADD PRIMARY KEY (`cert_stat_id`);

--
-- Indexes for table `city`
--
ALTER TABLE `city`
  ADD PRIMARY KEY (`city_id`);

--
-- Indexes for table `ci_sessions`
--
ALTER TABLE `ci_sessions`
  ADD KEY `ci_sessions_timestamp` (`timestamp`);

--
-- Indexes for table `kennels`
--
ALTER TABLE `kennels`
  ADD PRIMARY KEY (`ken_id`);

--
-- Indexes for table `kennels_type`
--
ALTER TABLE `kennels_type`
  ADD PRIMARY KEY (`ken_type_id`);

--
-- Indexes for table `logs_birth`
--
ALTER TABLE `logs_birth`
  ADD PRIMARY KEY (`log_id`),
  ADD KEY `fk_births_stud` (`log_stu_id`),
  ADD KEY `fk_logs_birth_id` (`log_bir_id`),
  ADD KEY `fk_logs_birth_member_id` (`log_member_id`);

--
-- Indexes for table `logs_canine`
--
ALTER TABLE `logs_canine`
  ADD PRIMARY KEY (`log_id`),
  ADD KEY `fk_canines_member` (`log_member_id`),
  ADD KEY `fk_canines_kennel_id` (`log_kennel_id`),
  ADD KEY `fk_logs_canine` (`log_canine_id`);

--
-- Indexes for table `logs_canine_note`
--
ALTER TABLE `logs_canine_note`
  ADD PRIMARY KEY (`log_id`),
  ADD KEY `fk_canine_notes_user` (`log_user`),
  ADD KEY `fk_note_canine` (`can_id`),
  ADD KEY `fk_log_canine_notes` (`note_id`);

--
-- Indexes for table `logs_kennel`
--
ALTER TABLE `logs_kennel`
  ADD PRIMARY KEY (`log_id`),
  ADD KEY `fk_logs_kennel_id` (`log_kennel_id`);

--
-- Indexes for table `logs_member`
--
ALTER TABLE `logs_member`
  ADD PRIMARY KEY (`log_id`),
  ADD KEY `fk_logs_member` (`log_member_id`);

--
-- Indexes for table `logs_order`
--
ALTER TABLE `logs_order`
  ADD PRIMARY KEY (`log_id`);

--
-- Indexes for table `logs_pedigree`
--
ALTER TABLE `logs_pedigree`
  ADD PRIMARY KEY (`log_id`),
  ADD KEY `bapak` (`log_sire_id`),
  ADD KEY `induk` (`log_dam_id`),
  ADD KEY `anjing_id` (`log_canine_id`);

--
-- Indexes for table `logs_product`
--
ALTER TABLE `logs_product`
  ADD PRIMARY KEY (`log_id`);

--
-- Indexes for table `logs_req_certificate`
--
ALTER TABLE `logs_req_certificate`
  ADD PRIMARY KEY (`log_id`);

--
-- Indexes for table `logs_req_microchip`
--
ALTER TABLE `logs_req_microchip`
  ADD PRIMARY KEY (`log_id`);

--
-- Indexes for table `logs_stambum`
--
ALTER TABLE `logs_stambum`
  ADD PRIMARY KEY (`log_id`),
  ADD KEY `fk_stambum_birth` (`log_bir_id`),
  ADD KEY `fk_stambum_member` (`log_member_id`),
  ADD KEY `fk_stambum_kennel` (`log_kennel_id`),
  ADD KEY `fk_stambum_canine` (`log_can_id`),
  ADD KEY `fk_logs_stambum_id` (`log_stb_id`);

--
-- Indexes for table `logs_stud`
--
ALTER TABLE `logs_stud`
  ADD PRIMARY KEY (`log_id`),
  ADD KEY `fk_studs_member` (`log_member_id`),
  ADD KEY `fk_log_stud_member_partner` (`log_partner_id`),
  ADD KEY `fk_logs_stud_id` (`log_stu_id`);

--
-- Indexes for table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`mem_id`);

--
-- Indexes for table `member_type`
--
ALTER TABLE `member_type`
  ADD PRIMARY KEY (`mem_type_id`);

--
-- Indexes for table `microchip_complain`
--
ALTER TABLE `microchip_complain`
  ADD PRIMARY KEY (`com_id`);

--
-- Indexes for table `microchip_status`
--
ALTER TABLE `microchip_status`
  ADD PRIMARY KEY (`micro_stat_id`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`news_id`);

--
-- Indexes for table `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`notification_id`),
  ADD KEY `fk_notification_type` (`notificationtype_id`),
  ADD KEY `fk_notification_member` (`mem_id`);

--
-- Indexes for table `notificationtype`
--
ALTER TABLE `notificationtype`
  ADD PRIMARY KEY (`notificationtype_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`ord_id`);

--
-- Indexes for table `order_complain`
--
ALTER TABLE `order_complain`
  ADD PRIMARY KEY (`com_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`itm_id`);

--
-- Indexes for table `order_status`
--
ALTER TABLE `order_status`
  ADD PRIMARY KEY (`ord_stat_id`);

--
-- Indexes for table `payment_method`
--
ALTER TABLE `payment_method`
  ADD PRIMARY KEY (`pay_id`);

--
-- Indexes for table `pedigrees`
--
ALTER TABLE `pedigrees`
  ADD PRIMARY KEY (`ped_id`),
  ADD KEY `bapak` (`ped_sire_id`),
  ADD KEY `induk` (`ped_dam_id`),
  ADD KEY `anjing_id` (`ped_canine_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`pro_id`),
  ADD KEY `fk_product_type` (`pro_type_id`);

--
-- Indexes for table `products_type`
--
ALTER TABLE `products_type`
  ADD PRIMARY KEY (`pro_type_id`);

--
-- Indexes for table `province`
--
ALTER TABLE `province`
  ADD PRIMARY KEY (`prov_id`);

--
-- Indexes for table `reject_reasons`
--
ALTER TABLE `reject_reasons`
  ADD PRIMARY KEY (`rej_id`);

--
-- Indexes for table `requests_certificate`
--
ALTER TABLE `requests_certificate`
  ADD PRIMARY KEY (`req_id`);

--
-- Indexes for table `requests_member`
--
ALTER TABLE `requests_member`
  ADD PRIMARY KEY (`req_id`),
  ADD KEY `fk_requests_member_id` (`req_member_id`);

--
-- Indexes for table `requests_microchip`
--
ALTER TABLE `requests_microchip`
  ADD PRIMARY KEY (`req_id`);

--
-- Indexes for table `requests_ownership_canine`
--
ALTER TABLE `requests_ownership_canine`
  ADD PRIMARY KEY (`req_id`),
  ADD KEY `fk_request_kennel_id` (`req_kennel_id`),
  ADD KEY `fk_request_member_id` (`req_member_id`),
  ADD KEY `fk_request_member_canine` (`req_can_id`),
  ADD KEY `fk_request_canine_old_kennel` (`req_old_kennel_id`),
  ADD KEY `fk_request_canine_old_member` (`req_old_member_id`);

--
-- Indexes for table `requests_pro`
--
ALTER TABLE `requests_pro`
  ADD PRIMARY KEY (`req_id`),
  ADD KEY `fk_requests_member_id` (`req_member_id`);

--
-- Indexes for table `requests_update_birth`
--
ALTER TABLE `requests_update_birth`
  ADD PRIMARY KEY (`req_id`),
  ADD KEY `fk_births_member_id` (`req_member_id`),
  ADD KEY `fk_request_birth` (`req_bir_id`);

--
-- Indexes for table `requests_update_canine`
--
ALTER TABLE `requests_update_canine`
  ADD PRIMARY KEY (`req_id`),
  ADD KEY `fk_request_update_canine` (`req_can_id`),
  ADD KEY `fk_requests_update_canine` (`req_member_id`);

--
-- Indexes for table `shipping`
--
ALTER TABLE `shipping`
  ADD PRIMARY KEY (`ship_id`);

--
-- Indexes for table `stambums`
--
ALTER TABLE `stambums`
  ADD PRIMARY KEY (`stb_id`),
  ADD KEY `fk_stambum_birth` (`stb_bir_id`),
  ADD KEY `fk_stambum_member` (`stb_member_id`),
  ADD KEY `fk_stambum_kennel` (`stb_kennel_id`),
  ADD KEY `fk_stambum_canine` (`stb_can_id`);

--
-- Indexes for table `studs`
--
ALTER TABLE `studs`
  ADD PRIMARY KEY (`stu_id`),
  ADD KEY `fk_studs_member` (`stu_member_id`),
  ADD KEY `fk_studs_member_partner` (`stu_partner_id`);

--
-- Indexes for table `trah`
--
ALTER TABLE `trah`
  ADD PRIMARY KEY (`tra_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`use_id`),
  ADD UNIQUE KEY `username` (`use_username`);

--
-- Indexes for table `user_type`
--
ALTER TABLE `user_type`
  ADD PRIMARY KEY (`user_type_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `approval_status`
--
ALTER TABLE `approval_status`
  MODIFY `stat_id` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `births`
--
ALTER TABLE `births`
  MODIFY `bir_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `canines`
--
ALTER TABLE `canines`
  MODIFY `can_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

--
-- AUTO_INCREMENT for table `canine_notes`
--
ALTER TABLE `canine_notes`
  MODIFY `note_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `certificate_complain`
--
ALTER TABLE `certificate_complain`
  MODIFY `com_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `certificate_status`
--
ALTER TABLE `certificate_status`
  MODIFY `cert_stat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `city`
--
ALTER TABLE `city`
  MODIFY `city_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=502;

--
-- AUTO_INCREMENT for table `kennels`
--
ALTER TABLE `kennels`
  MODIFY `ken_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `logs_birth`
--
ALTER TABLE `logs_birth`
  MODIFY `log_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `logs_canine`
--
ALTER TABLE `logs_canine`
  MODIFY `log_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;

--
-- AUTO_INCREMENT for table `logs_canine_note`
--
ALTER TABLE `logs_canine_note`
  MODIFY `log_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `logs_kennel`
--
ALTER TABLE `logs_kennel`
  MODIFY `log_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `logs_member`
--
ALTER TABLE `logs_member`
  MODIFY `log_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `logs_order`
--
ALTER TABLE `logs_order`
  MODIFY `log_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `logs_pedigree`
--
ALTER TABLE `logs_pedigree`
  MODIFY `log_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `logs_product`
--
ALTER TABLE `logs_product`
  MODIFY `log_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `logs_req_certificate`
--
ALTER TABLE `logs_req_certificate`
  MODIFY `log_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `logs_req_microchip`
--
ALTER TABLE `logs_req_microchip`
  MODIFY `log_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `logs_stambum`
--
ALTER TABLE `logs_stambum`
  MODIFY `log_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `logs_stud`
--
ALTER TABLE `logs_stud`
  MODIFY `log_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
  MODIFY `mem_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `microchip_complain`
--
ALTER TABLE `microchip_complain`
  MODIFY `com_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `microchip_status`
--
ALTER TABLE `microchip_status`
  MODIFY `micro_stat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `ord_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `order_complain`
--
ALTER TABLE `order_complain`
  MODIFY `com_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `itm_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT for table `order_status`
--
ALTER TABLE `order_status`
  MODIFY `ord_stat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `payment_method`
--
ALTER TABLE `payment_method`
  MODIFY `pay_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pedigrees`
--
ALTER TABLE `pedigrees`
  MODIFY `ped_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `pro_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `products_type`
--
ALTER TABLE `products_type`
  MODIFY `pro_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `province`
--
ALTER TABLE `province`
  MODIFY `prov_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `reject_reasons`
--
ALTER TABLE `reject_reasons`
  MODIFY `rej_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `requests_certificate`
--
ALTER TABLE `requests_certificate`
  MODIFY `req_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `requests_member`
--
ALTER TABLE `requests_member`
  MODIFY `req_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `requests_microchip`
--
ALTER TABLE `requests_microchip`
  MODIFY `req_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `requests_ownership_canine`
--
ALTER TABLE `requests_ownership_canine`
  MODIFY `req_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `requests_pro`
--
ALTER TABLE `requests_pro`
  MODIFY `req_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `requests_update_birth`
--
ALTER TABLE `requests_update_birth`
  MODIFY `req_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `requests_update_canine`
--
ALTER TABLE `requests_update_canine`
  MODIFY `req_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `shipping`
--
ALTER TABLE `shipping`
  MODIFY `ship_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `stambums`
--
ALTER TABLE `stambums`
  MODIFY `stb_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `studs`
--
ALTER TABLE `studs`
  MODIFY `stu_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `trah`
--
ALTER TABLE `trah`
  MODIFY `tra_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `use_id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `births`
--
ALTER TABLE `births`
  ADD CONSTRAINT `fk_births_member_id` FOREIGN KEY (`bir_member_id`) REFERENCES `members` (`mem_id`);

--
-- Constraints for table `logs_birth`
--
ALTER TABLE `logs_birth`
  ADD CONSTRAINT `fk_logs_birth_id` FOREIGN KEY (`log_bir_id`) REFERENCES `births` (`bir_id`),
  ADD CONSTRAINT `fk_logs_birth_member_id` FOREIGN KEY (`log_member_id`) REFERENCES `members` (`mem_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
