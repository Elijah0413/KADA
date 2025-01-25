-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 20, 2025 at 02:34 PM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kada`
--

-- --------------------------------------------------------

--
-- Table structure for table `inquiries`
--

CREATE TABLE `inquiries` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `subject` varchar(100) NOT NULL,
  `message` text NOT NULL,
  `status` enum('pending','in_progress','resolved') DEFAULT 'pending',
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `admin_response` text,
  `admin_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `inquiries`
--

INSERT INTO `inquiries` (`id`, `user_id`, `subject`, `message`, `status`, `created_at`, `updated_at`, `admin_response`, `admin_id`) VALUES
(6, 25, 'account', 'ghgh', 'resolved', '2025-01-10 13:26:07', '2025-01-10 13:26:30', 'asda', 15),
(7, 29, 'account', 'hi', 'resolved', '2025-01-11 11:45:49', '2025-01-11 11:49:40', 'uibkj', 15),
(8, 29, 'transaction', 'abc', 'resolved', '2025-01-11 11:46:03', '2025-01-11 11:49:27', 'kbkj', 15);

-- --------------------------------------------------------

--
-- Table structure for table `loan_applications`
--

CREATE TABLE `loan_applications` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `loan_type` varchar(50) NOT NULL,
  `t_amount` decimal(10,2) NOT NULL,
  `period` int NOT NULL,
  `mon_installment` decimal(10,2) NOT NULL,
  `name` varchar(100) NOT NULL,
  `no_ic` varchar(20) NOT NULL,
  `sex` varchar(10) NOT NULL,
  `religion` varchar(50) NOT NULL,
  `nationality` varchar(50) NOT NULL,
  `DOB` date NOT NULL,
  `add1` text NOT NULL,
  `postcode1` varchar(10) NOT NULL,
  `state1` varchar(50) NOT NULL,
  `memberID` varchar(50) NOT NULL,
  `PFNo` varchar(50) NOT NULL,
  `position` varchar(100) NOT NULL,
  `add2` text NOT NULL,
  `postcode2` varchar(10) NOT NULL,
  `state2` varchar(50) NOT NULL,
  `office_pNo` varchar(20) NOT NULL,
  `pNo` varchar(20) NOT NULL,
  `bankName` varchar(100) NOT NULL,
  `bankAcc` varchar(50) NOT NULL,
  `guarantor_N` varchar(100) NOT NULL,
  `guarantor_ic` varchar(20) NOT NULL,
  `guarantor_pNo` varchar(20) NOT NULL,
  `PFNo1` varchar(50) NOT NULL,
  `guarantorMemberID` varchar(50) NOT NULL,
  `guarantor_N2` varchar(100) NOT NULL,
  `guarantor_ic2` varchar(20) NOT NULL,
  `guarantor_pNo2` varchar(20) NOT NULL,
  `PFNo2` varchar(50) NOT NULL,
  `guarantorMemberID2` varchar(50) NOT NULL,
  `status` varchar(20) DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `admin_remark` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `loan_applications`
--

INSERT INTO `loan_applications` (`id`, `user_id`, `loan_type`, `t_amount`, `period`, `mon_installment`, `name`, `no_ic`, `sex`, `religion`, `nationality`, `DOB`, `add1`, `postcode1`, `state1`, `memberID`, `PFNo`, `position`, `add2`, `postcode2`, `state2`, `office_pNo`, `pNo`, `bankName`, `bankAcc`, `guarantor_N`, `guarantor_ic`, `guarantor_pNo`, `PFNo1`, `guarantorMemberID`, `guarantor_N2`, `guarantor_ic2`, `guarantor_pNo2`, `PFNo2`, `guarantorMemberID2`, `status`, `created_at`, `updated_at`, `admin_remark`) VALUES
(1, 18, 'aibai', '12000.00', 12, '12.00', 'ELIJAH SHE YU SHENG', '040413131145', 'Lelaki', 'Islam', 'Cina', '2000-12-12', 'lot 1079, blk 5, lorong 9 1/2 krokop', '98000', 'Sarawak', '1234', '4567', 'POLIS', 'lot 1079, blk 5, lorong 9 1/2 krokop', '98000', 'Sarawak', '0165093690', '0165093690', 'Alliance Bank', '8040504013', 'elijah', '345678903456', '0109876542', '2345678', '2345678', '1234567890', '34567890345678', '01234567890', '123456', '23456789', 'rejected', '2025-01-10 02:11:35', '2025-01-15 03:02:35', 'qwesrdfghb'),
(2, 18, 'LAIN LAIN', '120000.00', 12, '120.00', 'ELIJAH SHE YU SHENG', '040413131145', 'Lelaki', 'Buddha', 'Cina', '2000-12-12', 'lot 1079, blk 5, lorong 9 1/2 krokop', '98000', 'Sarawak', '1234', '4567', 'POLIS', 'lot 1079, blk 5, lorong 9 1/2 krokop', '98000', 'Sarawak', '0165093690', '0165093690', 'OCBC Online', '8040504013', '567890', '345678903456', '0109876542', '2345678', '2345678', '1234567890', '34567890345678', '01234567890', '123456', '23456789', 'pending', '2025-01-10 02:18:52', '2025-01-10 02:18:52', NULL),
(3, 25, 'aiinah', '34234.00', 24, '1000.00', 'EFSSD', '73563', 'Lelaki', 'Buddha', 'Cina', '2024-12-30', 'sdfasd', '346786', 'Pulau Pinang', '342', '34', '34', 'weqw', '1241', 'Sarawak', '45634', '1245', 'Affin Bank', '235664', 'gfdgwr', '35675435', '25y4u53', '4235', '12', 'retr', '78756', '524142', '23624', '2', 'pending', '2025-01-10 05:09:50', '2025-01-12 13:35:01', 'blehhhhh'),
(4, 25, 'LAIN LAIN', '90000.00', 36, '1000.00', 'Testing', '412414', 'Lelaki', 'Buddha', 'Melayu', '2025-01-01', 'gsere', '242562', 'Perak', '35', '4141', 'gffe', 'wersf', '2674', 'Terengganu', '56243', '1235642', 'Bank Islam', '1231231255', 'KEWWew', '24523634', '1245635', '34633', '25', 'qwfdqw', '73324', '764533', '56356523', '12', 'APPROVED', '2025-01-10 05:13:04', '2025-01-12 13:35:01', 'HASHAHHA'),
(5, 19, 'SKIM KHAS', '11000.00', 12345, '12.00', 'JOANNE', '040312018812', 'Perempuan', 'Buddha', 'Cina', '2025-01-07', '1qwertgh', '81300', 'Johor', '12345', '1234343434', 'Pengetua', '18,JALAN SEJAHTERA 8,KADa', '81300', 'Johor', '0177777688', '0177777688', 'Standard Chartered Bank', '1234354568790', 'SDFGHJK', '1234567890', '0177777688', '1234343434', '23456', 'RDTFRYGUIHYIP[OP[', '1234567890', '01234567890', '1234567890', '1234567', 'rejected', '2025-01-10 10:37:09', '2025-01-12 13:56:16', 'cannot\r\n'),
(6, 25, 'aiinah', '66666.00', 24, '1000.00', 'Lee Yin Shen', '123131', 'Lelaki', 'Buddha', 'Melayu', '2024-12-30', 'asdasd', '123121', 'Perlis', '12', '23', 'qweqe', 'qweqweq', '12315', 'Johor', '3122114', '12324', 'HSBC Online', '12214', 'gwert', '124115', '124412', '245221', '3', 'reewtegw', '1414', '124123', '12451', '12', 'REJECTED', '2025-01-10 11:47:34', '2025-01-12 13:35:01', 'dfgvb'),
(7, 26, 'aibai', '1231232.00', 1231, '123.00', 'fsddssfs', '3423', 'Perempuan', 'Buddha', 'Cina', '2024-12-29', 'rrwrw', '414124', 'Terengganu', '1', '24', '24', 'adasda', '123414', 'Perak', '23123', '423', 'Bank Islam', '124141', 'rwerws', '1231314', '4123131', '3412412', '2', 'eqweqw', '131124', '13141', '13141', '23', 'APPROVED', '2025-01-10 12:28:07', '2025-01-12 13:56:23', 'cannot\r\n'),
(12, 51, 'Pembiayaan_Skim_Khas', '888.00', 24, '80.00', 'LIM YU HAN', '0123', 'Female', 'CHRISTIAN', 'CINA', '2009-02-12', 'ERTYU', 'WERTYU', 'Johor', '0123', '012345', 'dsadsadas', 'dasdas', '81300', 'Johor', '0167727876', '0167168876', 'Ambank', '1234567890', 'qwertyui', '345678', '767727876', '1234567', '1234567', 'wertjjk', '2345678', '767727876', '12345678', '245678', 'approved', '2025-01-15 03:11:48', '2025-01-16 07:31:45', NULL),
(13, 51, 'Pembiayaan_Al_Bai', '2000.00', 13, '160.85', 'LIM YU HAN', '0123', 'Female', 'CHRISTIAN', 'CINA', '2025-01-16', 'ERTYU', 'WERTYU', 'Johor', '0123', '012345', '5151', 'T-2 Taman Sri Triang，28300,Triang，Pahang，Malaysia\r\nT-2 Taman Sri Triang，28300,Triang，Pahang，Malaysia', '28300', 'Pahang', '334324', '56365', 'Bank Muamalat', '4325452', 'sfgfsd', '3424', '4234234', '324234', '2342', 'sdffgs', '32434', '3242432', '234234', '324234', 'approved', '2025-01-16 07:28:06', '2025-01-16 07:28:41', NULL),
(14, 51, 'Pembiayaan_RoadTaxInsuran', '5000.00', 14, '374.64', 'LIM YU HAN', '0123', 'Female', 'CHRISTIAN', 'CINA', '2025-01-24', 'ERTYU', 'WERTYU', 'Johor', '0123', '012345', 'teacher', 'T-2 Taman Sri Triang，28300,Triang，Pahang，Malaysia\r\nT-2 Taman Sri Triang，28300,Triang，Pahang，Malaysia', '28300', 'Pahang', '4353454', '32423423', 'Bank Islam', '234234234', 'jingyi', '443665', '23424324', '4324', '3423', 'uyu', '3242545', '4324', '234324', '23423', 'approved', '2025-01-16 07:32:51', '2025-01-16 07:32:56', NULL),
(15, 52, 'Pembiayaan_RoadTaxInsuran', '3000.00', 12, '260.50', 'Choh Jing Yi', '040809', 'Male', 'buddha', 'chinese', '2025-01-16', 'T-2 Taman Sri Triang，28300,Triang，Pahang，MalaysiaT-2 Taman Sri Triang，28300,Triang，Pahang，Malaysia', '28300', 'Pahang', 'A1', 'A2', 'student', 'T-2 Taman Sri Triang，28300,Triang，Pahang，Malaysia\r\nT-2 Taman Sri Triang，28300,Triang，Pahang，Malaysia', '28300', 'Pahang', '45345344', '54353454', 'OCBC Online', '34534', 'sfdhsd', '5435', '435', '5345', '543', 'gffdgdsg', '34534', '345345', '435435', '43534', 'approved', '2025-01-16 08:43:24', '2025-01-16 08:43:31', NULL),
(16, 51, 'Pembiayaan_Al_Innah', '66666.00', 24, '3011.08', 'LIM YU HAN', '0123', 'Female', 'CHRISTIAN', 'CINA', '2008-03-17', 'ERTYU', 'WERTYU', 'Johor', '0123', '012345', 'QEWRQWD', 'WDAWSDA', '81300', 'Johor', '0167727876', '0167727876', 'Bank Rakyat', '7876', 'qwertyui', '345678', '0167727876', '1234567', '1234567', 'wertjjk', '2345678', '0167727876', '12345678', '245678', 'approved', '2025-01-17 01:59:10', '2025-01-17 01:59:33', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `member_family`
--

CREATE TABLE `member_family` (
  `id` int NOT NULL,
  `member_ic` varchar(22) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `ic_no` varchar(22) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `relationship` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `member_family`
--

INSERT INTO `member_family` (`id`, `member_ic`, `name`, `ic_no`, `relationship`, `created_at`, `updated_at`) VALUES
(1, '090909000000', 'yh', '010101010101', 'Parent', '2025-01-20 10:42:39', '2025-01-20 10:42:39');

-- --------------------------------------------------------

--
-- Table structure for table `member_profile`
--

CREATE TABLE `member_profile` (
  `id` int NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `ic_number` varchar(20) NOT NULL,
  `date_of_birth` date NOT NULL,
  `gender` enum('Male','Female') NOT NULL,
  `marital_status` enum('Single','Married','Divorced','Widowed') NOT NULL,
  `race` enum('Malay','Chinese','Indian','Others') DEFAULT NULL,
  `occupation` varchar(100) NOT NULL,
  `department` varchar(100) NOT NULL,
  `position` varchar(100) NOT NULL,
  `employment_date` date NOT NULL,
  `monthly_salary` decimal(10,2) NOT NULL,
  `home_address` text NOT NULL,
  `postcode` varchar(10) NOT NULL,
  `state` enum('Johor','Kedah','Kelantan','Melaka','Negeri Sembilan','Pahang','Perak','Perlis','Pulau Pinang','Sabah','Sarawak','Selangor','Terengganu','Kuala Lumpur','Labuan','Putrajaya') NOT NULL,
  `phone_no` varchar(20) NOT NULL,
  `email` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `user_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `member_profile`
--

INSERT INTO `member_profile` (`id`, `full_name`, `ic_number`, `date_of_birth`, `gender`, `marital_status`, `race`, `occupation`, `department`, `position`, `employment_date`, `monthly_salary`, `home_address`, `postcode`, `state`, `phone_no`, `email`, `created_at`, `updated_at`, `user_id`) VALUES
(19, 'fgfjhgf', '040809050165', '2025-01-01', 'Female', 'Married', 'Indian', 'DSFSD', 'wertw', '5151', '2025-01-01', '2335.00', 'T-2 Taman Sri Triang，28300,Triang，Pahang，Malaysia\r\nT-2 Taman Sri Triang，28300,Triang，Pahang，Malaysia', '28300', 'Pahang', '325123', 'seot5wright@hotmail.com', '2025-01-01 15:47:07', '2025-01-01 15:47:56', 6),
(20, 'elijah she yu  sheng', '040413131145', '2004-04-13', 'Male', 'Single', 'Chinese', 'student', 'student', 'nope', '2025-01-02', '3000.00', 'lot 1079, blk 5, lorong 9 1/2 krokop', '98000', 'Sarawak', '0165093690', 'elijahshe04@gmail.com', '2025-01-02 03:55:47', '2025-01-02 03:55:47', 8),
(23, 'elijah she yu  sheng', '040413131144', '2009-05-04', 'Male', 'Single', 'Malay', 'student', 'student', 'nope', '2023-02-02', '3000.00', 'lot 1079, blk 5, lorong 9 1/2 krokop', '98000', 'Sarawak', '0165093690', 'elijahshe05@gmail.com', '2025-01-02 14:47:03', '2025-01-02 14:47:03', 16),
(24, 'yuhan', '030813011434', '2003-08-13', 'Female', 'Single', 'Chinese', 'abc', 'abc', 'abc', '2023-02-02', '5000.00', '1', '1', 'Pulau Pinang', '1', 'yuhan7876@gmail.com', '2025-01-07 10:21:41', '2025-01-07 10:21:41', 14),
(25, 'yuhan', '030813011000', '2006-06-30', 'Female', 'Single', 'Chinese', 'abc', 'abc', 'abc', '2023-11-08', '5000.00', '1', '1', 'Pulau Pinang', '1', 'yuhan1111@gmail.com', '2025-01-07 10:44:13', '2025-01-07 10:44:13', 18),
(26, 'JOANNE CHING YIN XUAN', '040312010888', '2000-03-09', 'Female', 'Single', 'Chinese', '1', '1', '1', '2025-01-07', '1067.00', '15TDFUGIHIOUIHIUGHGGFF', '81300', 'Johor', '0177777688', 'jyinxuan@gmail.com', '2025-01-08 01:37:43', '2025-01-08 01:37:43', 19),
(27, 'LEE', '1234124213', '2024-12-31', 'Male', 'Single', 'Chinese', 'wqe', 'weweq', 'qwew', '2024-12-29', '123212.00', 'qweqew', '12312321', 'Johor', '123123131', 'leeyinshen2004@gmail.com', '2025-01-10 01:40:22', '2025-01-10 01:40:22', 20),
(28, 'LEE YIN SHEN', '3112322', '2025-01-02', 'Male', 'Single', 'Chinese', 'weqw', 'qeqeq', 'qweqe', '2024-12-30', '321232.00', 'qweqe', '213123', 'Johor', '23313', 'leeshen@gradute.utm.my', '2025-01-10 03:26:46', '2025-01-10 03:26:46', 23),
(29, 'dfghjre', '34632354', '2024-12-31', 'Male', 'Single', 'Indian', 'dfgdjr', 'jggrt', 'fghj', '2025-01-01', '43453.00', 'fgd', '7355', 'Johor', '5623', 'Jerry@gmail.com', '2025-01-10 05:11:06', '2025-01-10 05:23:17', 25);

-- --------------------------------------------------------

--
-- Table structure for table `pendingregistermember`
--

CREATE TABLE `pendingregistermember` (
  `id` int NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `ic_no` varchar(22) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` enum('Male','Female') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `religion` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `race` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `marital_status` enum('Single','Married','Divorced','Widowed') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `member_number` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `pf_number` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `position` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `grade` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `monthly_salary` decimal(10,2) NOT NULL,
  `home_address` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `home_postcode` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `home_state` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `office_address` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `office_postcode` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `office_phone` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `home_phone` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `fax` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `registration_fee` decimal(10,2) NOT NULL,
  `share_capital` decimal(10,2) NOT NULL,
  `fee_capital` decimal(10,2) NOT NULL,
  `deposit_funds` decimal(10,2) NOT NULL,
  `welfare_fund` decimal(10,2) NOT NULL,
  `fixed_deposit` decimal(10,2) NOT NULL,
  `other_contributions` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` enum('pending','approved','rejected') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `user_id` int DEFAULT NULL,
  `admin_remark` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pendingregistermember`
--

INSERT INTO `pendingregistermember` (`id`, `name`, `ic_no`, `gender`, `religion`, `race`, `marital_status`, `member_number`, `pf_number`, `position`, `grade`, `monthly_salary`, `home_address`, `home_postcode`, `home_state`, `office_address`, `office_postcode`, `office_phone`, `home_phone`, `fax`, `registration_fee`, `share_capital`, `fee_capital`, `deposit_funds`, `welfare_fund`, `fixed_deposit`, `other_contributions`, `created_at`, `updated_at`, `status`, `user_id`, `admin_remark`) VALUES
(9, 'yuhan', '010101010101', 'Female', 'a', 'a', 'Single', '1', '1', 'abc', 'abc', '5000.00', '1', '1', 'Pulau Pinang', 'jalan abc', '81300', '0167727876', '077727876', 'aaa', '50.00', '50.00', '50.00', '50.00', '50.00', '50.00', '50', '2025-01-11 01:48:05', '2025-01-11 02:22:53', 'approved', 28, NULL),
(14, 'LIM YU HAN', '0123', 'Female', 'CHRISTIAN', 'CINA', 'Single', '0123', '012345', 'ABC', 'A', '60000.00', 'ERTYU', 'WERTYU', 'Johor', 'WERT', '81300', '0167167876', '2345246895', '0254253', '600.00', '600.00', '600.00', '600.00', '600.00', '600.00', 'WEWSFESF', '2025-01-14 10:43:25', '2025-01-14 10:44:19', 'approved', 51, NULL),
(7, 'testing2', '031031203', 'Male', 'Malaysia', 'Chinese', 'Married', 'sdfwerf', '12534', '124', 'A', '23322.00', 'wqeq', '12514', 'Kedah', 'wreqew', '12314', '141', '5432', '123', '51.00', '50.00', '50.00', '50.00', '50.00', '50.00', 'yh', '2025-01-10 12:22:09', '2025-01-12 13:16:47', 'approved', 26, NULL),
(6, 'JOANNE', '040312010111', 'Female', 'Buddha', 'Cina', 'Single', '1234545', '123456', 'Pengetua', 'A', '10000.00', '18,JALAN SEJAHTERA 8,TAMAN 123', '81300', 'Johor', '18,JALAN SEJAHTERA 8,KADA', '81300', '0177777688', '0177777688', '13W23', '12345.00', '123456.00', '12345.00', '123456.00', '234567.00', '23456.00', NULL, '2025-01-10 10:30:14', '2025-01-10 11:07:45', 'rejected', 19, NULL),
(11, 'elijah she yu  sheng', '040413131145', 'Male', '1', '1', 'Single', '1', '11', '1', '1', '1.00', 'lot 1079, blk 5, lorong 9 1/2 krokop', '98000', 'Sarawak', 'lot 1079, blk 5, lorong 9 1/2 krokop', '98000', '0165093690', '111', '11', '1.00', '1.00', '1.00', '1.00', '1.00', '1.00', '1', '2025-01-11 18:14:33', '2025-01-11 18:19:44', 'approved', 44, NULL),
(15, 'Choh Jing Yi', '040809', 'Male', 'buddha', 'chinese', 'Married', 'A1', 'A2', 'teacher', '42', '3000.00', 'T-2 Taman Sri Triang，28300,Triang，Pahang，Malaysia\r\nT-2 Taman Sri Triang，28300,Triang，Pahang，Malaysia', '28300', 'Pahang', 'T-2 Taman Sri Triang，28300,Triang，Pahang，Malaysia\r\nT-2 Taman Sri Triang，28300,Triang，Pahang，Malaysia', '28300', '9032804234', '247923', '23424', '50.00', '50.00', '50.00', '5000.00', '50.00', '50.00', '50', '2025-01-16 08:41:32', '2025-01-16 08:41:58', 'approved', 52, NULL),
(13, 'Choh Jing Yi', '040809050165', 'Male', 'buddha', 'chinese', 'Single', 'A1', 'A2', 'teacher', '42', '3000.00', 'T-2 Taman Sri Triang，28300,Triang，Pahang，Malaysia\r\nT-2 Taman Sri Triang，28300,Triang，Pahang，Malaysia', '28300', 'Pahang', 'T-2 Taman Sri Triang，28300,Triang，Pahang，Malaysia\r\nT-2 Taman Sri Triang，28300,Triang，Pahang，Malaysia', '28300', '9032804234', '247923', '23424', '50.00', '1000.00', '1000.00', '2000.00', '2000.00', '2000.00', '-', '2025-01-12 14:59:34', '2025-01-12 15:01:12', 'approved', 50, NULL),
(16, 'YUYANG', '090909000000', 'Male', 'Kristian', 'Cina', 'Single', '666666', '666666', 'abc', 'a', '50000.00', 'jalan abc', '81300', 'Johor', 'jalan abc', '81300', '0167727876', '0167727876', '15552626', '35.00', '300.00', '50.00', '5000.00', '5.00', '2000.00', NULL, '2025-01-20 10:42:39', '2025-01-20 10:42:58', 'approved', 53, NULL),
(4, 'Lee Yin Shen', '1232133', 'Male', 'Malaysia', 'Chinese', 'Single', '231231', '5234', 'qweqe', 'AAA', '12334.00', 'qwew', '2313', 'Sarawak', 'weqeq', '3213', '5235', '2132', 'qweq', '50.00', '50.00', '50.00', '50.00', '50.00', '50.00', 'u', '2025-01-10 04:30:27', '2025-01-10 04:30:27', 'pending', 24, NULL),
(12, 'brenda', '12334444', 'Male', '1', '1', 'Single', '1', '11', '1', '1', '1.00', '1111', '98000', 'Sarawak', '1111', '98000', '0165093690', '111', '11', '1.00', '1.00', '1.00', '1.00', '1.00', '1.00', '11', '2025-01-12 13:18:45', '2025-01-12 13:56:01', 'rejected', 47, 'cannot'),
(1, 'asdada', '2133132132', 'Male', 'Malaysia', 'Chinese', 'Single', '12323123', '12332', 'AA', 'A', '5999.00', '12313weqqwe', '4112421', 'Perak', 'eqweqq', '21323', '123234', '43541', 'sdads23', '60.00', '60.00', '60.00', '60.00', '60.00', '60.00', 'r', '2025-01-10 03:22:27', '2025-01-10 03:22:27', 'pending', NULL, NULL),
(10, 'limyuhan', '555555', 'Female', 'a', 'a', 'Single', '1', '1', 'abc', 'abc', '5000.00', '2', '1', 'Pulau Pinang', '1', '81300', '0167727876', '015', 'aaa', '50.00', '50.00', '50.00', '50.00', '50.00', '50.00', NULL, '2025-01-11 03:45:09', '2025-01-11 03:46:47', 'approved', 29, NULL),
(5, 'Elijah', '666666', 'Male', 'Malaysia', 'Chinese', 'Married', 'safseqweq', '1245', 'fsdg', 'GBB', '267324.00', 'dsfds', '85663', 'Perlis', 'erggsf', '3735', '23426', '785', '234', '50.00', '50.00', '50.00', '50.00', '50.00', '50.00', 'hrhert', '2025-01-10 04:41:37', '2025-01-10 04:41:37', 'pending', 25, NULL),
(8, 'testing888', '888888', 'Male', 'Malaysia', 'Chinese', 'Married', '888888', '32424', 'werew', 'aDDS', '12312.00', 'weqw', '1234', 'Selangor', 're', '75754', '4536', '25622', '43', '60.00', '60.00', '60.00', '60.00', '60.00', '60.00', NULL, '2025-01-10 13:24:02', '2025-01-11 03:28:45', 'rejected', 27, NULL);

--
-- Triggers `pendingregistermember`
--
DELIMITER $$
CREATE TRIGGER `create_saving_account_after_approval` AFTER UPDATE ON `pendingregistermember` FOR EACH ROW BEGIN
    IF NEW.status = 'approved' AND (OLD.status != 'approved' OR OLD.status IS NULL) THEN
        INSERT INTO saving_accounts (user_ic, account_number, balance)
        VALUES (
            NEW.ic_no,
            CONCAT('SA', LPAD(FLOOR(RAND() * 1000000), 6, '0')),
            0.00
        );
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `saving_accounts`
--

CREATE TABLE `saving_accounts` (
  `id` int NOT NULL,
  `user_ic` varchar(22) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `account_number` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `balance` decimal(10,2) DEFAULT '0.00',
  `status` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `has_paid_one_time_fees` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `saving_accounts`
--

INSERT INTO `saving_accounts` (`id`, `user_ic`, `account_number`, `balance`, `status`, `created_at`, `updated_at`, `has_paid_one_time_fees`) VALUES
(1, '010101010101', 'SA872919', '17550.00', 'pending', '2025-01-11 02:22:53', '2025-01-11 03:34:27', 0),
(2, '555555', 'SA567254', '35000.00', 'pending', '2025-01-11 03:46:47', '2025-01-11 03:50:22', 0),
(3, '040413131145', 'SA888584', '0.00', 'pending', '2025-01-11 18:19:44', '2025-01-11 18:19:44', 0),
(4, '031031203', 'SA842875', '0.00', 'pending', '2025-01-12 13:16:47', '2025-01-12 13:16:47', 0),
(5, '12334444', 'SA746221', '0.00', 'pending', '2025-01-12 13:19:15', '2025-01-12 13:19:15', 0),
(6, '12334444', 'SA438497', '0.00', 'pending', '2025-01-12 13:44:15', '2025-01-12 13:44:15', 0),
(7, '040809050165', 'SA565302', '250.00', 'pending', '2025-01-12 15:01:12', '2025-01-13 10:55:23', 0),
(8, '0123', 'SA085687', '89822.00', 'pending', '2025-01-14 10:44:19', '2025-01-17 01:59:33', 0),
(9, '040809', 'SA441340', '8000.00', 'pending', '2025-01-16 08:41:58', '2025-01-16 08:43:31', 0),
(10, '090909000000', 'SA056136', '18968.00', 'complete', '2025-01-20 10:42:58', '2025-01-20 14:33:32', 0),
(11, '090909000000', '', '19000.00', 'complete', '2025-01-20 10:42:58', '2025-01-20 14:33:32', 0);

-- --------------------------------------------------------

--
-- Table structure for table `saving_transactions`
--

CREATE TABLE `saving_transactions` (
  `id` int NOT NULL,
  `account_id` int NOT NULL,
  `transaction_type` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amount` decimal(10,2) NOT NULL,
  `payment_method` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deposit_bank` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `card_type` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bank_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bank_account` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `transfer_purpose` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `admin_remark` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `processed_by` int DEFAULT NULL,
  `processed_at` timestamp NULL DEFAULT NULL,
  `status` enum('pending','approved','rejected') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT 'pending',
  `transaction_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `saving_transactions`
--

INSERT INTO `saving_transactions` (`id`, `account_id`, `transaction_type`, `amount`, `payment_method`, `deposit_bank`, `card_type`, `bank_name`, `bank_account`, `transfer_purpose`, `description`, `admin_remark`, `processed_by`, `processed_at`, `status`, `transaction_date`, `updated_at`) VALUES
(5, 1, 'deposit', '10000.00', NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, 'approved', '2025-01-11 02:53:19', '2025-01-11 02:53:19'),
(6, 1, 'transfer', '500.00', NULL, NULL, NULL, NULL, NULL, NULL, 'Pendidikan:', 'ok', 15, '2025-01-11 03:09:43', 'approved', '2025-01-11 02:54:20', '2025-01-15 02:25:18'),
(7, 1, 'transfer', '600.00', NULL, NULL, NULL, NULL, NULL, NULL, 'Lain-lain:', 'yes', 15, '2025-01-11 03:34:27', 'approved', '2025-01-11 02:54:29', '2025-01-15 02:25:18'),
(8, 1, 'transfer', '1500.00', NULL, NULL, NULL, NULL, NULL, NULL, 'Kecemasan: halo', 'yes', 15, '2025-01-11 03:34:17', 'approved', '2025-01-11 03:18:49', '2025-01-15 02:25:18'),
(9, 1, 'transfer', '500.00', NULL, NULL, NULL, NULL, NULL, NULL, 'Kesihatan: hi', 'tq', 15, '2025-01-11 03:19:31', 'approved', '2025-01-11 03:19:01', '2025-01-15 02:25:18'),
(10, 2, 'deposit', '50000.00', NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, 'approved', '2025-01-11 03:47:20', '2025-01-11 03:47:20'),
(11, 2, 'transfer', '15000.00', NULL, NULL, NULL, NULL, NULL, NULL, 'Kecemasan: ubdcjkb', 'ubujnj', 15, '2025-01-11 03:50:22', 'approved', '2025-01-11 03:47:50', '2025-01-15 02:25:18'),
(12, 2, 'transfer', '1000.00', NULL, NULL, NULL, NULL, NULL, NULL, 'Pendidikan: bjhn', 'rtgrtgr', 15, '2025-01-11 03:50:28', 'rejected', '2025-01-11 03:50:02', '2025-01-15 02:25:18'),
(13, 7, 'deposit', '50.00', NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, 'approved', '2025-01-12 15:04:27', '2025-01-12 15:04:27'),
(14, 7, 'transfer', '50.00', NULL, NULL, NULL, NULL, NULL, NULL, 'Pendidikan:', NULL, NULL, NULL, 'pending', '2025-01-12 15:04:40', '2025-01-15 02:25:18'),
(15, 7, 'deposit', '100.00', NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, 'approved', '2025-01-12 17:12:22', '2025-01-12 17:12:22'),
(16, 7, 'deposit', '100.00', NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, 'approved', '2025-01-13 10:55:23', '2025-01-13 10:55:23'),
(17, 8, 'deposit', '600.00', NULL, NULL, NULL, NULL, NULL, NULL, 'Initial deposit from registration', NULL, NULL, NULL, 'approved', '2025-01-14 10:44:19', '2025-01-14 10:44:19'),
(18, 8, 'deposit', '500.00', NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, 'approved', '2025-01-14 10:45:11', '2025-01-14 10:45:11'),
(19, 8, 'transfer', '200.00', NULL, NULL, NULL, NULL, NULL, NULL, 'Kesihatan: dfghjk', 'qwerty', 51, '2025-01-14 10:45:52', 'approved', '2025-01-14 10:45:41', '2025-01-15 02:25:18'),
(20, 8, 'deposit', '8544.00', NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, 'approved', '2025-01-14 10:46:22', '2025-01-14 10:46:22'),
(21, 8, 'deposit', '6000.00', NULL, NULL, NULL, NULL, NULL, NULL, 'Pinjaman Diluluskan', NULL, NULL, NULL, 'approved', '2025-01-15 01:47:30', '2025-01-15 01:47:30'),
(22, 8, 'deposit', '963.00', NULL, NULL, NULL, NULL, NULL, NULL, 'Pinjaman Diluluskan', NULL, NULL, NULL, 'approved', '2025-01-15 01:55:28', '2025-01-15 01:55:28'),
(23, 8, 'transfer', '333.00', NULL, NULL, NULL, NULL, NULL, NULL, 'Pindahan ke Public Bank (345436457568)', 'asdasdfasda', NULL, '2025-01-15 02:57:31', 'approved', '2025-01-15 02:53:54', '2025-01-15 02:57:31'),
(24, 8, 'transfer', '555.00', NULL, NULL, NULL, NULL, NULL, NULL, 'Pindahan ke Public Bank (345436457568)', 'qwerdfgvhbj', NULL, '2025-01-15 03:00:24', 'rejected', '2025-01-15 03:00:17', '2025-01-15 03:00:24'),
(25, 8, 'transfer', '666.00', NULL, NULL, NULL, NULL, NULL, NULL, 'Pindahan ke Public Bank (345436457568)', 'dfghbj', NULL, '2025-01-15 03:01:07', 'approved', '2025-01-15 03:00:49', '2025-01-15 03:01:07'),
(26, 8, 'deposit', '888.00', NULL, NULL, NULL, NULL, NULL, NULL, 'Pinjaman Diluluskan', NULL, NULL, NULL, 'approved', '2025-01-15 03:12:02', '2025-01-15 03:12:02'),
(27, 8, 'deposit', '2000.00', NULL, NULL, NULL, NULL, NULL, NULL, 'Pinjaman Diluluskan', NULL, NULL, NULL, 'approved', '2025-01-16 07:28:20', '2025-01-16 07:28:20'),
(28, 8, 'deposit', '5000.00', NULL, NULL, NULL, NULL, NULL, NULL, 'Pinjaman Diluluskan', NULL, NULL, NULL, 'approved', '2025-01-16 07:32:56', '2025-01-16 07:32:56'),
(29, 9, 'deposit', '5000.00', NULL, NULL, NULL, NULL, NULL, NULL, 'Initial deposit from registration', NULL, NULL, NULL, 'approved', '2025-01-16 08:41:58', '2025-01-16 08:41:58'),
(30, 9, 'deposit', '3000.00', NULL, NULL, NULL, NULL, NULL, NULL, 'Pinjaman Diluluskan', NULL, NULL, NULL, 'approved', '2025-01-16 08:43:31', '2025-01-16 08:43:31'),
(31, 8, 'deposit', '8.00', NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, 'approved', '2025-01-16 13:37:55', '2025-01-16 13:37:55'),
(32, 8, 'deposit', '5.00', NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, 'approved', '2025-01-16 13:39:59', '2025-01-16 13:39:59'),
(33, 8, 'deposit', '3.00', NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, 'approved', '2025-01-16 13:43:58', '2025-01-16 13:43:58'),
(34, 8, 'transfer', '23.00', NULL, NULL, NULL, NULL, NULL, NULL, 'Pindahan ke RHB Bank (111): education - pl', 'okjb', NULL, '2025-01-16 14:05:08', 'approved', '2025-01-16 14:04:33', '2025-01-16 14:05:08'),
(35, 8, 'deposit', '3.00', 'grabpay', NULL, NULL, NULL, NULL, NULL, 'pp', NULL, NULL, NULL, 'approved', '2025-01-16 14:36:57', '2025-01-16 14:36:57'),
(36, 8, 'transfer', '6.00', NULL, NULL, NULL, 'RHB Bank', '111', '', 'pp', 'oij', NULL, '2025-01-16 14:37:56', 'approved', '2025-01-16 14:37:36', '2025-01-16 14:37:56'),
(37, 8, 'deposit', '5.00', 'card', NULL, NULL, NULL, NULL, NULL, 'll', NULL, NULL, NULL, 'approved', '2025-01-16 14:45:11', '2025-01-16 14:45:11'),
(38, 8, 'deposit', '5.00', 'tng', NULL, NULL, NULL, NULL, NULL, 'ji', NULL, NULL, NULL, 'approved', '2025-01-16 14:48:56', '2025-01-16 14:48:56'),
(39, 8, 'deposit', '100.00', 'cash', NULL, NULL, NULL, NULL, NULL, 'Test transaction', NULL, NULL, NULL, 'approved', '2025-01-16 14:51:25', '2025-01-16 14:51:25'),
(40, 8, 'deposit', '88.00', 'card', NULL, NULL, NULL, NULL, NULL, 'gg', NULL, NULL, NULL, 'approved', '2025-01-16 14:55:02', '2025-01-16 14:55:02'),
(41, 8, 'transfer', '96.00', NULL, NULL, NULL, 'RHB Bank', '111', '', 'hu', 'ok', NULL, '2025-01-16 14:56:20', 'approved', '2025-01-16 14:55:36', '2025-01-16 14:56:20'),
(42, 8, 'transfer', '85.00', NULL, NULL, NULL, 'RHB Bank', '111', 'Pendidikan', 'school', 'rtcfvhb', NULL, '2025-01-16 15:17:15', 'approved', '2025-01-16 15:16:37', '2025-01-16 15:17:15'),
(43, 8, 'transfer', '85.00', NULL, NULL, NULL, 'Maybank', '1222', 'Pemindahan', 'trx', 'good', NULL, '2025-01-16 15:27:11', 'approved', '2025-01-16 15:26:36', '2025-01-16 15:27:11'),
(44, 8, 'deposit', '54.00', 'card', NULL, NULL, NULL, NULL, NULL, 'halo', NULL, NULL, NULL, 'approved', '2025-01-16 15:48:47', '2025-01-16 15:48:47'),
(45, 8, 'deposit', '21.00', 'card', NULL, NULL, NULL, NULL, NULL, 'bye', NULL, NULL, NULL, 'approved', '2025-01-16 16:15:17', '2025-01-16 16:15:17'),
(46, 8, 'deposit', '21.00', 'grabpay', NULL, NULL, NULL, NULL, NULL, 'gy', NULL, NULL, NULL, 'approved', '2025-01-16 16:18:23', '2025-01-16 16:18:23'),
(47, 8, 'transfer', '21.00', NULL, NULL, NULL, 'UOB Bank', '1222', NULL, 'rt', 'az', NULL, '2025-01-16 16:24:29', 'rejected', '2025-01-16 16:18:49', '2025-01-16 16:24:29'),
(48, 8, 'transfer', '74.00', NULL, NULL, NULL, 'AmBank', '111', '', '333', 'wsdx', NULL, '2025-01-16 16:24:22', 'approved', '2025-01-16 16:23:46', '2025-01-16 16:24:22'),
(49, 8, 'deposit', '88.00', 'grabpay', NULL, NULL, NULL, NULL, NULL, '66', NULL, NULL, NULL, 'approved', '2025-01-16 16:24:08', '2025-01-16 16:24:08'),
(50, 8, 'deposit', '4.00', 'card', NULL, NULL, NULL, NULL, NULL, '4', NULL, NULL, NULL, 'approved', '2025-01-16 16:30:48', '2025-01-16 16:30:48'),
(51, 8, 'transfer', '5.00', NULL, NULL, NULL, 'Maybank', '111', NULL, '111', 'w', NULL, '2025-01-16 16:31:28', 'approved', '2025-01-16 16:31:20', '2025-01-16 16:31:28'),
(52, 8, 'transfer', '8.00', NULL, NULL, NULL, 'CIMB Bank', '111', NULL, 'w', NULL, NULL, NULL, 'pending', '2025-01-16 16:33:55', '2025-01-16 16:33:55'),
(53, 8, 'transfer', '85.00', NULL, NULL, NULL, 'Maybank', '111', 'education', 'uu', '9', NULL, '2025-01-16 16:38:44', 'approved', '2025-01-16 16:38:00', '2025-01-16 16:38:44'),
(54, 8, 'transfer', '77.00', NULL, NULL, NULL, 'BSN', '222', 'payment', 'pembayaran', NULL, NULL, NULL, 'pending', '2025-01-16 16:39:54', '2025-01-16 16:39:54'),
(55, 8, 'deposit', '666.00', 'grabpay', NULL, NULL, NULL, NULL, NULL, 'abcd', NULL, NULL, NULL, 'approved', '2025-01-17 01:29:16', '2025-01-17 01:29:16'),
(56, 8, 'transfer', '666.00', NULL, NULL, NULL, 'Bank Rakyat', '8888888', 'education', 'pendidikan', 'okokok', NULL, '2025-01-17 01:30:30', 'approved', '2025-01-17 01:30:00', '2025-01-17 01:30:30'),
(57, 8, 'deposit', '6.00', 'card', NULL, NULL, NULL, NULL, NULL, 'ok', NULL, NULL, NULL, 'approved', '2025-01-17 01:32:15', '2025-01-17 01:32:15'),
(58, 8, 'deposit', '55.00', 'grabpay', NULL, NULL, NULL, NULL, NULL, 'nice', NULL, NULL, NULL, 'approved', '2025-01-17 01:51:49', '2025-01-17 01:51:49'),
(59, 8, 'transfer', '56.00', NULL, NULL, NULL, 'OCBC Bank', '1222', 'transfer', 'pemindahan', 'ee', NULL, '2025-01-17 01:52:47', 'approved', '2025-01-17 01:52:38', '2025-01-17 01:52:47'),
(60, 8, 'deposit', '9.00', 'card', NULL, NULL, NULL, NULL, NULL, 'KAD', NULL, NULL, NULL, 'approved', '2025-01-17 01:55:37', '2025-01-17 01:55:37'),
(61, 8, 'deposit', '66666.00', NULL, NULL, NULL, NULL, NULL, NULL, 'Pinjaman Diluluskan', NULL, NULL, NULL, 'approved', '2025-01-17 01:59:33', '2025-01-17 01:59:33'),
(82, 10, 'fee', '50.00', 'banking', NULL, NULL, NULL, NULL, NULL, 'Modal Yuran Bulanan', NULL, NULL, NULL, 'approved', '2025-01-20 14:30:55', '2025-01-20 14:30:55'),
(83, 10, 'welfare', '5.00', 'banking', NULL, NULL, NULL, NULL, NULL, 'Tabung Kebajikan Bulanan', NULL, NULL, NULL, 'approved', '2025-01-20 14:30:55', '2025-01-20 14:30:55'),
(84, 10, 'deposit', '2000.00', 'banking', NULL, NULL, NULL, NULL, NULL, 'Simpanan Tetap Bulanan', NULL, NULL, NULL, 'approved', '2025-01-20 14:30:55', '2025-01-20 14:30:55'),
(85, 10, 'deposit', '56.00', 'fpx', NULL, NULL, NULL, NULL, NULL, '111', NULL, NULL, NULL, 'approved', '2025-01-20 14:31:22', '2025-01-20 14:31:22'),
(86, 10, 'transfer', '88.00', NULL, NULL, NULL, 'Maybank', '111', 'payment', '', 'good', NULL, '2025-01-20 14:32:02', 'approved', '2025-01-20 14:31:50', '2025-01-20 14:32:02'),
(87, 10, 'fee', '50.00', 'banking', NULL, NULL, NULL, NULL, NULL, 'Modal Yuran Bulanan', NULL, NULL, NULL, 'approved', '2025-01-20 14:33:32', '2025-01-20 14:33:32'),
(88, 10, 'welfare', '5.00', 'banking', NULL, NULL, NULL, NULL, NULL, 'Tabung Kebajikan Bulanan', NULL, NULL, NULL, 'approved', '2025-01-20 14:33:32', '2025-01-20 14:33:32'),
(89, 10, 'deposit', '2000.00', 'banking', NULL, NULL, NULL, NULL, NULL, 'Simpanan Tetap Bulanan', NULL, NULL, NULL, 'approved', '2025-01-20 14:33:32', '2025-01-20 14:33:32');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `ic_no` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','user') NOT NULL DEFAULT 'user',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `email` varchar(255) NOT NULL,
  `verification_token` varchar(255) DEFAULT NULL,
  `email_verified` tinyint(1) DEFAULT '0',
  `reset_token` varchar(64) DEFAULT NULL,
  `reset_token_expires` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `ic_no`, `password`, `role`, `created_at`, `updated_at`, `email`, `verification_token`, `email_verified`, `reset_token`, `reset_token_expires`) VALUES
(6, 'jingyi', '$2y$10$xXfoXuWFi4d9.uSEwgILxuSnR0QOI3XF2JLg00sBiUib6MDLSWMAK', 'user', '2025-01-01 15:42:41', '2025-01-11 11:04:34', 'temp_6@example.com', NULL, 0, NULL, NULL),
(8, 'e', '$2y$10$iXqNY1qi3ErrQJY52cBwNupCajdqQCwrzCluzL.DBhUHAkm6Ke6J6', 'user', '2025-01-02 01:48:49', '2025-01-11 11:04:34', 'temp_8@example.com', NULL, 0, NULL, NULL),
(14, 'elijah', '$2y$10$T4A38rz.4LaxG5HeR4ZSf.lPAwpW2a9WeGm/lyJ4Wzd7UOYEBeXHS', 'user', '2024-12-31 23:04:49', '2025-01-11 11:04:34', 'temp_14@example.com', NULL, 0, NULL, NULL),
(15, 'admin', '$2y$10$T4A38rz.4LaxG5HeR4ZSf.lPAwpW2a9WeGm/lyJ4Wzd7UOYEBeXHS', 'admin', '2024-12-31 23:33:47', '2025-01-11 11:04:34', 'temp_15@example.com', NULL, 0, NULL, NULL),
(16, 'q', '$2y$10$DksNXurikYRHv0bfWP.udOEQn7gV16.6nQ.mzRNWt.HbIRmKB0CvW', 'user', '2025-01-02 14:44:34', '2025-01-11 11:04:34', 'temp_16@example.com', NULL, 0, NULL, NULL),
(18, 'yuhan', '$2y$10$kG3NxS62RbzxIls/2.H/EOUcQ2I.ZWLRu0W3J8YW1QQCuj0sgfm5W', 'user', '2025-01-07 10:42:19', '2025-01-11 11:04:34', 'temp_18@example.com', NULL, 0, NULL, NULL),
(19, 'joanne', '$2y$10$FBKcSlG1g1ZVS8q.oQDfLeq7EKoFZGIY0zM9A.HMmCDtPjyyLp.TC', 'user', '2025-01-08 01:35:37', '2025-01-11 11:04:34', 'temp_19@example.com', NULL, 0, NULL, NULL),
(20, 'lee', '$2y$10$9agIx2IC2np3.PuNa2Qg9./eF4UOQV8zHGPYMhtq7v/4wLOLhb3RS', 'user', '2025-01-10 01:38:37', '2025-01-11 11:04:34', 'temp_20@example.com', NULL, 0, NULL, NULL),
(23, 'lee3', '$2y$10$q6RUH9.2bvdorIWL4jAr3e0uQwQvuc2pwoKoZKTSj8/fvLhgPtV4K', 'user', '2025-01-10 03:21:45', '2025-01-11 11:04:34', 'temp_23@example.com', NULL, 0, NULL, NULL),
(24, 'test', '$2y$10$6xFWdn82Ben1LU3q5BfugePzCniiyfRvWwa5rjkFMs/Y0oEzH5Squ', 'user', '2025-01-10 04:27:34', '2025-01-11 11:04:34', 'temp_24@example.com', NULL, 0, NULL, NULL),
(25, '666666', '$2y$10$HkOX/bPfQCBj5EHc.ikvguoiHP8FqicydQHEuK.jiXzbS8ILvQo.G', 'user', '2025-01-10 04:40:22', '2025-01-11 11:04:34', 'temp_25@example.com', NULL, 0, NULL, NULL),
(26, 'testing2', '$2y$10$Ec4RFXqhIBHwNIcvvOO2DeXPRak96v6TiDiDrCbFrk9PLdFE95ime', 'user', '2025-01-10 12:21:27', '2025-01-11 11:04:34', 'temp_26@example.com', NULL, 0, NULL, NULL),
(27, '888888', '$2y$10$Uc.MIJ.5ES4pfZbXhvTco.ovTueSA7vuFNa6Da.J4NZnoymrhtG2m', 'user', '2025-01-10 13:23:16', '2025-01-11 11:04:34', 'temp_27@example.com', NULL, 0, NULL, NULL),
(28, '333333', '$2y$10$1mdkXSZnvMMbo0GDcusmYuF/jvwnwNY6OSp52ZRK0E.BIAMSsBCFW', 'user', '2025-01-11 01:46:24', '2025-01-11 11:04:34', 'temp_28@example.com', NULL, 0, NULL, NULL),
(29, '555555', '$2y$10$0.xLBMvOqqduoLjGVt3poOdMFb91/AfBbkszwHNY0AhRsh.H/VbIS', 'user', '2025-01-11 03:44:16', '2025-01-11 11:04:34', 'temp_29@example.com', NULL, 0, NULL, NULL),
(44, '123', '$2y$10$o5GS4fkrDXjpBfVfYYw.ROVcWgcy/vqO1koC8L8OUeQlGukeWzMti', 'user', '2025-01-11 18:13:10', '2025-01-12 12:40:01', 'elijahshe04@gmail.com', NULL, 1, NULL, NULL),
(47, '123456', '$2y$10$C.Y30YykYySGx28SOCBmq.0lEYcCe4YHJMO.7HEsJ2b1ZQYwOrirW', 'user', '2025-01-12 13:17:45', '2025-01-12 13:41:02', 'elijahshe05@gmail.com', NULL, 1, NULL, NULL),
(48, '12344', '$2y$10$VePv6YnjVTrf6GOZbBr0ue9LCOdhqGl.7jTsDP/mkETnn7Ddfef7G', 'user', '2025-01-12 13:43:14', '2025-01-12 13:43:32', 'elijahsheyu@graduate.utm.my', NULL, 1, NULL, NULL),
(50, '040809050165', '$2y$10$EnKEzjGt28KVxXpB1IUfMeBbUjdgz2rWQtJtvHwXF2cPcDmyXSE5q', 'user', '2025-01-12 14:54:55', '2025-01-12 14:55:13', 'jingyichoh@gmail.com', NULL, 1, NULL, NULL),
(51, '0123', '$2y$10$2uAaLW9MbPwmG6QIlsg/ReoB5uBAP0TUlRmdHMWQ3/g0ygqiZ.t/W', 'user', '2025-01-14 10:40:21', '2025-01-17 02:01:18', 'yuhan7876@gmail.com', NULL, 1, 'de5c12799b0bbf63d1ef66bd783930679bc2cc841b78b77463ad7de6b31f439f', '2025-01-17 11:01:18'),
(52, '040809', '$2y$10$c43osaOEGZHxaZ/bCEBx6eHeWivh0sZwwdOmbJat9Lu2ub6M4mGZS', 'user', '2025-01-16 08:38:38', '2025-01-16 08:40:19', 'choh@graduate.utm.my', NULL, 1, NULL, NULL),
(53, '090909000000', '$2y$10$H9PRLQetBQ0vZ9OdVzcINOAGqKNmdx52Wtro/AlXFv7SO/MvVF4Ia', 'user', '2025-01-20 10:40:21', '2025-01-20 10:41:41', 'yuyanglim09@gmail.com', NULL, 1, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `inquiries`
--
ALTER TABLE `inquiries`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `admin_id` (`admin_id`);

--
-- Indexes for table `loan_applications`
--
ALTER TABLE `loan_applications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `member_family`
--
ALTER TABLE `member_family`
  ADD PRIMARY KEY (`id`),
  ADD KEY `member_ic` (`member_ic`);

--
-- Indexes for table `member_profile`
--
ALTER TABLE `member_profile`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `ic_number` (`ic_number`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `unique_user_id` (`user_id`),
  ADD KEY `idx_email` (`email`),
  ADD KEY `idx_ic_number` (`ic_number`);

--
-- Indexes for table `pendingregistermember`
--
ALTER TABLE `pendingregistermember`
  ADD PRIMARY KEY (`ic_no`),
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `saving_accounts`
--
ALTER TABLE `saving_accounts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_ic` (`user_ic`);

--
-- Indexes for table `saving_transactions`
--
ALTER TABLE `saving_transactions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `account_id` (`account_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`ic_no`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `inquiries`
--
ALTER TABLE `inquiries`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `loan_applications`
--
ALTER TABLE `loan_applications`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `member_family`
--
ALTER TABLE `member_family`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `member_profile`
--
ALTER TABLE `member_profile`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `pendingregistermember`
--
ALTER TABLE `pendingregistermember`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `saving_accounts`
--
ALTER TABLE `saving_accounts`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `saving_transactions`
--
ALTER TABLE `saving_transactions`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=90;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `inquiries`
--
ALTER TABLE `inquiries`
  ADD CONSTRAINT `inquiries_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `inquiries_ibfk_2` FOREIGN KEY (`admin_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `loan_applications`
--
ALTER TABLE `loan_applications`
  ADD CONSTRAINT `loan_applications_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `member_family`
--
ALTER TABLE `member_family`
  ADD CONSTRAINT `member_family_ibfk_1` FOREIGN KEY (`member_ic`) REFERENCES `pendingregistermember` (`ic_no`) ON DELETE CASCADE;

--
-- Constraints for table `member_profile`
--
ALTER TABLE `member_profile`
  ADD CONSTRAINT `member_profile_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `pendingregistermember`
--
ALTER TABLE `pendingregistermember`
  ADD CONSTRAINT `pendingregistermember_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `saving_accounts`
--
ALTER TABLE `saving_accounts`
  ADD CONSTRAINT `saving_accounts_ibfk_1` FOREIGN KEY (`user_ic`) REFERENCES `pendingregistermember` (`ic_no`);

--
-- Constraints for table `saving_transactions`
--
ALTER TABLE `saving_transactions`
  ADD CONSTRAINT `saving_transactions_ibfk_1` FOREIGN KEY (`account_id`) REFERENCES `saving_accounts` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
