-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 16, 2024 at 07:03 PM
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
-- Database: `engineering_projects_management`
--

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `CustomerId` int(11) NOT NULL,
  `CustomerName` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `CustomerPhone` varchar(15) NOT NULL,
  `userType` int(11) DEFAULT 2,
  `joinDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`CustomerId`, `CustomerName`, `email`, `password`, `CustomerPhone`, `userType`, `joinDate`) VALUES
(1, 'أحمد عبد الرزاق الهاشمي', 'ahmed@gmail.com', '$2y$10$04MDSWvSWZq1ZxPyoqDQFeDLJ0LdAeE.ZyURuI8JY8E3O/aWbFBRu', '0936545877', 2, '2020-03-10'),
(2, 'الطاهرمصطفى محمد', 'Taher@email.com', '$2y$10$HpuAc9kuCB/twTnIgyEeW.O4Lu/i5VNLUmdo8M9O1AcU4sjObQ5Au', '0912345821', 2, '2021-04-28'),
(3, 'خالد هشام الهوني', 'kaled@email.com', '$2y$10$pK.DU/bvW1lTupmaTRG9oeCQwt8RZWgyJG0gu34K7VTdyl4aHL.sq', '0943382772', 2, '2022-06-08'),
(4, 'محمد فتحي التكبالي', 'moh@gmail.com', '$2y$10$l3AdqX3EY8Yz6jdn6SNgZO1lNHEE6v4w4.HNgQOMTj5YQieYYxAY.', '0911457877	', 2, '2022-10-16'),
(5, 'عبد الرحمن محمود الغرياني', 'abdulrahman.mahmoud@gmail.com', '$2y$10$hCmaxosPLWpgzNcuAwuSJuBAhe/MXbjfbRfB2DreGadDnnwyyj1wG', '0924566882', 2, '2023-05-30');

-- --------------------------------------------------------

--
-- Table structure for table `documentationtypes`
--

CREATE TABLE `documentationtypes` (
  `DocumentationTypeID` int(11) NOT NULL,
  `DocumentationTypeName` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `employeeId` int(11) NOT NULL,
  `employeeName` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `employeePhone` varchar(15) NOT NULL,
  `userType` int(11) NOT NULL,
  `joinDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`employeeId`, `employeeName`, `email`, `password`, `employeePhone`, `userType`, `joinDate`) VALUES
(1, 'عبد الله سالم امحمد	', 'abdullah@gmail.com', '$2y$10$saRuZys6jU/bN4BhTIuDpeJaXg4bpX2wJIIjP4r1VNAockGwqo2.a', '0911112255	', 1, '2020-01-01'),
(2, 'فيصل محمد سالم', 'fisel@gmail.com', '$2y$10$Sxk0G6i1nP195e1fgNarqeZMDH3E0FAtS0pIjq66R3z6I/TCvAM0m', '0946324567	', 3, '2020-01-01'),
(3, 'ابراهيم الطاهر الفيتوري', 'ibrahim@gmail.com', '$2y$10$eh5gbqGJ7q/VMzTmeY5wRuVrpKG3B2J55DHjItpnV9H6E4Vo.GOFS', '0914446611', 3, '2020-01-01'),
(4, 'حسن احمد امحمد', 'hassanEmmahmed@gmail.com', '$2y$10$PGdihjm9SrPfVgoeihUO9.sKkpybPSlIl3iiJBKdeNSYyB0RFZvSi', '2020-01-10', 3, '2020-01-10'),
(5, 'سالم الميلادي', 'salem@gmail.com', '$2y$10$2jZVr/d9kTjW1/OtTCYJiOtAMuvkfjpey8e/lN7In1F6x/wTlzQde', '0912233144', 4, '2021-01-23'),
(6, 'صلاح بن طاهر', 'salah@gmail.com', '$2y$10$jEzwOTav7.tLou2JKyHSzO5QD7XAj9O/BQYe7K5Ne2I3KRiEYdCvm', '0922133657', 5, '2021-03-10'),
(7, 'فتحي الرفاعي', 'fathi@gmail.com', '$2y$10$YraXyuic92LXk2aYzQqTwuci7FD2j2o2ihtST2D.jPaPwaza.iyAy', '0931124882	', 4, '2022-04-01'),
(8, 'محمد بن بركة', 'mohmed@gmail.com', '$2y$10$kiKsHLqnbQ8YsnCtmDRFDObtpJ6ENwgglhLEYvl0NnZJbGMfsy2uy', '0912887347', 5, '2022-07-10'),
(9, 'سارة محمد فرحات', 'sara@gmail.com', '$2y$10$tB9nkbTJGLZ5F.OQ.e9rvuZ2N0IrEAjstNth7O1WCxNJXRuYyiYE2', '0929182727', 6, '2023-09-16'),
(10, 'جلال نور الدين', 'jalal@gmail.com', '$2y$10$PTR.BpeB8rq.vvf0FQu7PeNzioEPeRlrdWaQJcSDeJ//ySSeSQcey', '0916267344', 6, '2024-07-03');

-- --------------------------------------------------------

--
-- Table structure for table `group_policy`
--

CREATE TABLE `group_policy` (
  `id` int(11) NOT NULL,
  `permission` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `materialinvoices`
--

CREATE TABLE `materialinvoices` (
  `Invoice_id` int(11) NOT NULL,
  `project_id` int(11) DEFAULT NULL,
  `payment_id` int(11) DEFAULT NULL,
  `invoice_number` int(11) DEFAULT NULL,
  `specialization_id` int(11) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `amount` decimal(10,2) DEFAULT NULL,
  `invoice_date` date DEFAULT NULL,
  `payment_method_id` int(11) DEFAULT NULL,
  `store_id` int(11) DEFAULT NULL,
  `invoice_image` blob DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `materialinvoices`
--

INSERT INTO `materialinvoices` (`Invoice_id`, `project_id`, `payment_id`, `invoice_number`, `specialization_id`, `description`, `amount`, `invoice_date`, `payment_method_id`, `store_id`, `invoice_image`) VALUES
(1, 1, 1, 1, 1, 'الحفر ( تأجير كاشيك )', 3000.00, '2020-03-15', 1, 1, NULL),
(2, 1, 1, 2, 1, 'الردم ( تراب أحمر )', 1000.00, '2020-03-30', 1, 1, NULL),
(3, 1, 1, 3, 1, 'الدك ( تأجير دكاك )', 6000.00, '2020-04-04', 1, 1, NULL),
(4, 1, 1, 4, 2, 'حديد تسليح', 15000.00, '2020-04-11', 1, 2, NULL),
(5, 1, 1, 5, 2, 'خرسانة جاهزة', 15000.00, '2020-05-01', 2, 3, NULL),
(6, 1, 1, 6, 2, 'حديد تسليح', 15000.00, '2020-05-12', 1, 2, NULL),
(7, 1, 1, 7, 2, 'خرسانة جاهزة', 15000.00, '2020-06-05', 2, 4, NULL),
(8, 1, 2, 8, 2, 'حديد تسليح', 10000.00, '2020-06-15', 3, 2, NULL),
(9, 1, 2, 9, 2, 'خرسانة جاهزة', 10000.00, '2020-07-11', 1, 5, NULL),
(10, 1, 2, 10, 2, 'حديد تسليح', 20000.00, '2020-08-28', 1, 2, NULL),
(11, 1, 2, 11, 4, 'مواد كهربائية', 2500.00, '2020-09-12', 1, 6, NULL),
(12, 1, 2, 12, 5, 'مواد صحية', 2500.00, '2020-09-27', 1, 7, NULL),
(13, 1, 2, 13, 2, 'هوردي', 5000.00, '2020-12-02', 1, 8, NULL),
(14, 1, 2, 14, 2, 'خرسانة جاهزة', 15000.00, '2020-12-25', 1, 5, NULL),
(15, 1, 3, 15, 3, 'بوميشي', 40000.00, '2021-01-05', 3, 10, NULL),
(16, 1, 3, 16, 3, 'أسمنت', 10000.00, '2021-01-30', 1, 2, NULL),
(17, 1, 3, 17, 3, 'قزة وقرانيليه', 5000.00, '2021-02-22', 1, 2, NULL),
(18, 1, 3, 18, 4, 'مواد كهربائية', 10000.00, '2021-03-23', 1, 18, NULL),
(19, 1, 3, 19, 5, 'مواد صحية', 10000.00, '2021-04-28', 1, 9, NULL),
(20, 2, 1, 1, 1, 'الحفر ( تأجير كاشيك )', 3000.00, '2021-05-05', 1, 1, NULL),
(21, 1, 4, 20, 6, 'أسمنت', 20000.00, '2021-05-07', 1, 2, NULL),
(22, 2, 1, 2, 1, 'الردم ( تراب أحمر )', 1000.00, '2021-05-15', 1, 1, NULL),
(23, 1, 4, 21, 6, 'قزة وقرانيليه', 5000.00, '2021-05-18', 1, 1, NULL),
(24, 2, 1, 3, 1, 'الدك ( تأجير دكاك )', 6000.00, '2021-05-30', 1, 1, NULL),
(25, 1, 4, 22, 4, 'مواد كهربائية', 10000.00, '2021-06-12', 1, 11, NULL),
(26, 2, 1, 4, 2, 'حديد تسليح', 15000.00, '2021-07-23', 1, 2, NULL),
(27, 1, 4, 23, 5, 'مواد صحية', 10000.00, '2021-08-09', 1, 12, NULL),
(28, 2, 1, 5, 2, 'خرسانة جاهزة', 15000.00, '2021-09-16', 2, 3, NULL),
(29, 2, 1, 6, 2, 'حديد تسليح', 15000.00, '2021-10-01', 1, 2, NULL),
(30, 1, 4, 24, 7, 'جبس وغيره', 5000.00, '2021-11-12', 1, 2, NULL),
(31, 2, 1, 7, 2, 'خرسانة جاهزة', 15000.00, '2021-12-15', 2, 4, NULL),
(32, 2, 2, 8, 2, 'حديد تسليح', 10000.00, '2021-07-10', 3, 2, NULL),
(33, 2, 2, 9, 2, 'خرسانة جاهزة', 10000.00, '2021-08-15', 1, 5, NULL),
(34, 2, 2, 10, 2, 'حديد تسليح', 20000.00, '2021-09-17', 1, 2, NULL),
(35, 2, 2, 11, 4, 'مواد كهربائية', 2500.00, '2021-11-11', 1, 19, NULL),
(36, 2, 2, 12, 5, 'مواد صحية', 2500.00, '2021-12-12', 1, 7, NULL),
(37, 1, 5, 25, 8, 'بورسلين', 10000.00, '2021-12-10', 1, 13, NULL),
(38, 2, 2, 13, 2, 'هوردي', 5000.00, '2021-12-15', 1, 8, NULL),
(39, 1, 5, 26, 9, 'رخام', 10000.00, '2021-12-23', 1, 14, NULL),
(40, 2, 2, 14, 2, 'خرسانة جاهزة', 15000.00, '2021-12-28', 1, 5, NULL),
(41, 1, 5, 27, 11, 'ألومنيوم', 40000.00, '2022-01-01', 2, 15, NULL),
(42, 2, 3, 15, 3, 'بوميشي', 40000.00, '2022-01-02', 3, 16, NULL),
(43, 1, 5, 28, 12, 'خشبية', 20000.00, '2022-02-26', 2, 21, NULL),
(44, 2, 3, 16, 3, 'أسمنت', 10000.00, '2022-04-01', 1, 10, NULL),
(45, 1, 6, 29, 4, 'مواد كهربائية', 10000.00, '2022-05-05', 1, 17, NULL),
(46, 2, 3, 17, 3, 'قزة وقرانيليه', 5000.00, '2022-06-03', 1, 2, NULL),
(47, 3, 1, 1, 1, 'الحفر ( تأجير كاشيك )', 3000.00, '2022-06-10', 1, 1, NULL),
(48, 3, 1, 2, 1, 'الردم ( تراب أحمر )', 1000.00, '2022-06-16', 1, 1, NULL),
(49, 3, 1, 3, 1, 'الدك ( تأجير دكاك )', 6000.00, '2022-06-22', 1, 1, NULL),
(50, 1, 6, 30, 5, 'مواد صحية', 10000.00, '2022-06-26', 1, 9, NULL),
(51, 2, 3, 18, 4, 'مواد كهربائية', 10000.00, '2022-06-27', 1, 6, NULL),
(52, 2, 3, 19, 5, 'مواد صحية', 10000.00, '2022-06-29', 1, 9, NULL),
(53, 3, 1, 4, 2, 'حديد تسليح', 15000.00, '2022-06-29', 1, 2, NULL),
(54, 2, 4, 20, 6, 'أسمنت', 20000.00, '2022-07-01', 1, 10, NULL),
(55, 1, 6, 31, 8, 'بورسلين', 30000.00, '2022-08-15', 1, 13, NULL),
(56, 3, 1, 5, 2, 'خرسانة جاهزة', 15000.00, '2022-08-17', 2, 3, NULL),
(57, 1, 6, 32, 9, 'رخام', 20000.00, '2022-08-25', 1, 14, NULL),
(58, 2, 4, 21, 6, 'قزة وقرانيليه', 5000.00, '2022-08-30', 1, 2, NULL),
(59, 3, 1, 6, 2, 'حديد تسليح', 15000.00, '2022-09-01', 1, 2, NULL),
(60, 1, 7, 33, 5, 'مواد صحية', 20000.00, '2022-09-02', 3, 12, NULL),
(61, 2, 4, 22, 4, 'مواد كهربائية', 10000.00, '2022-09-08', 1, 11, NULL),
(62, 3, 1, 7, 2, 'خرسانة جاهزة', 15000.00, '2022-10-04', 2, 4, NULL),
(63, 1, 7, 34, 4, 'مواد كهربائية', 10000.00, '2022-10-10', 1, 11, NULL),
(64, 2, 4, 23, 7, 'جبس وغيره', 5000.00, '2022-10-18', 1, 2, NULL),
(65, 4, 1, 1, 1, 'الحفر ( تأجير كاشيك )', 3000.00, '2022-10-20', 1, 1, NULL),
(66, 3, 2, 8, 2, 'حديد تسليح', 30000.00, '2022-10-30', 3, 2, NULL),
(67, 3, 2, 9, 2, 'خرسانة جاهزة', 10000.00, '2022-11-10', 1, 5, NULL),
(68, 4, 1, 2, 1, 'الردم ( تراب أحمر )', 1000.00, '2022-11-14', 1, 1, NULL),
(69, 4, 1, 3, 1, 'الدك ( تأجير دكاك )', 6000.00, '2022-12-05', 1, 1, NULL),
(70, 1, 8, 35, 5, 'مواد صحية', 10000.00, '2022-12-05', 1, 12, NULL),
(71, 2, 4, 23, 5, 'مواد صحية', 10000.00, '2022-12-20', 1, 12, NULL),
(72, 4, 1, 4, 2, 'حديد تسليح', 15000.00, '2022-12-28', 1, 2, NULL),
(73, 3, 2, 11, 4, 'مواد كهربائية', 2500.00, '2023-01-01', 1, 20, NULL),
(74, 2, 5, 24, 5, 'مواد صحية', 10000.00, '2023-01-02', 1, 12, NULL),
(75, 3, 2, 12, 5, 'مواد صحية', 2500.00, '2023-01-10', 1, 7, NULL),
(76, 4, 1, 5, 2, 'خرسانة جاهزة', 15000.00, '2023-01-15', 2, 3, NULL),
(77, 1, 8, 36, 4, 'مواد كهربائية', 10000.00, '2023-01-15', 1, 11, NULL),
(78, 3, 2, 13, 2, 'هوردي', 5000.00, '2023-01-17', 1, 8, NULL),
(79, 3, 2, 14, 2, 'خرسانة جاهزة', 15000.00, '2023-01-29', 1, 5, NULL),
(80, 4, 1, 6, 2, 'حديد تسليح', 15000.00, '2023-02-02', 1, 2, NULL),
(81, 1, 8, 37, 11, 'ألومنيوم', 30000.00, '2023-02-09', 2, 15, NULL),
(82, 1, 8, 38, 14, 'طلاء داخلي', 15000.00, '2023-02-15', 1, 25, NULL),
(83, 4, 1, 7, 2, 'خرسانة جاهزة', 15000.00, '2023-02-22', 2, 4, NULL),
(84, 3, 3, 15, 11, 'مواد صحية', 10000.00, '2023-03-01', 2, 12, NULL),
(85, 4, 2, 8, 2, 'حديد تسليح', 10000.00, '2023-03-02', 3, 2, NULL),
(86, 2, 5, 25, 4, 'مواد كهربائية', 10000.00, '2023-03-03', 1, 11, NULL),
(87, 4, 2, 9, 2, 'خرسانة جاهزة', 10000.00, '2023-03-28', 1, 5, NULL),
(88, 4, 2, 10, 2, 'حديد تسليح', 20000.00, '2023-04-07', 1, 2, NULL),
(89, 4, 2, 11, 4, 'مواد كهربائية', 2500.00, '2023-04-12', 1, 20, NULL),
(90, 3, 3, 16, 3, 'بوميشي', 40000.00, '2023-04-18', 2, 16, NULL),
(91, 4, 2, 12, 5, 'مواد صحية', 2500.00, '2023-04-22', 1, 7, NULL),
(92, 4, 2, 13, 2, 'هوردي', 5000.00, '2023-05-05', 1, 8, NULL),
(93, 3, 3, 17, 3, 'أسمنت', 10000.00, '2023-05-10', 1, 10, NULL),
(94, 2, 5, 26, 12, 'خشبية', 30000.00, '2023-05-14', 1, 21, NULL),
(95, 4, 2, 14, 2, 'خرسانة جاهزة', 15000.00, '2023-05-27', 1, 5, NULL),
(96, 5, 1, 1, 1, 'الحفر - ردم - دك', 10000.00, '2023-06-05', 1, 1, NULL),
(97, 2, 5, 27, 11, 'ألومنيوم', 20000.00, '2023-06-28', 2, 15, NULL),
(98, 4, 3, 19, 5, 'مواد صحية', 10000.00, '2023-09-28', 1, 9, NULL),
(99, 5, 2, 6, 2, 'خرسانة جاهزة', 25000.00, '2023-10-03', 1, 5, NULL),
(100, 4, 4, 20, 6, 'أسمنت', 20000.00, '2023-10-05', 1, 2, NULL),
(101, 3, 4, 20, 9, 'رخام', 20000.00, '2023-10-15', 3, 23, NULL),
(102, 4, 4, 21, 6, 'قزة وقرانيليه', 5000.00, '2023-10-19', 1, 2, NULL),
(103, 2, 6, 31, 8, 'بورسلين', 30000.00, '2023-10-20', 1, 22, NULL),
(104, 5, 2, 7, 2, 'هوردي', 5000.00, '2023-10-27', 1, 8, NULL),
(105, 2, 6, 32, 5, 'مواد صحية', 10000.00, '2023-10-29', 1, 12, NULL),
(106, 2, 7, 33, 5, 'مواد صحية', 10000.00, '2023-11-02', 1, 12, NULL),
(107, 4, 4, 22, 4, 'مواد كهربائية', 10000.00, '2023-11-04', 1, 11, NULL),
(108, 3, 4, 21, 11, 'ألومنيوم', 30000.00, '2023-11-29', 2, 26, NULL),
(109, 5, 2, 8, 3, 'بوميشي', 5000.00, '2023-11-30', 1, 16, NULL),
(110, 4, 3, 19, 5, 'مواد صحية', 10000.00, '2023-09-28', 1, 9, NULL),
(111, 5, 2, 6, 2, 'خرسانة جاهزة', 25000.00, '2023-10-03', 1, 5, NULL),
(112, 4, 4, 20, 6, 'أسمنت', 20000.00, '2023-10-05', 1, 2, NULL),
(113, 3, 4, 20, 9, 'رخام', 20000.00, '2023-10-15', 3, 23, NULL),
(114, 4, 4, 21, 6, 'قزة وقرانيليه', 5000.00, '2023-10-19', 1, 2, NULL),
(115, 2, 6, 31, 8, 'بورسلين', 30000.00, '2023-10-20', 1, 22, NULL),
(116, 5, 2, 7, 2, 'هوردي', 5000.00, '2023-10-27', 1, 8, NULL),
(117, 2, 6, 32, 5, 'مواد صحية', 10000.00, '2023-10-29', 1, 12, NULL),
(118, 2, 7, 33, 5, 'مواد صحية', 10000.00, '2023-11-02', 1, 12, NULL),
(119, 4, 4, 22, 4, 'مواد كهربائية', 10000.00, '2023-11-04', 1, 11, NULL),
(120, 3, 4, 21, 11, 'ألومنيوم', 30000.00, '2023-11-29', 2, 26, NULL),
(121, 5, 2, 8, 3, 'بوميشي', 5000.00, '2023-11-30', 1, 16, NULL),
(122, 4, 4, 23, 5, 'مواد صحية', 10000.00, '2023-12-01', 1, 12, NULL),
(123, 5, 3, 9, 3, 'بوميشي', 20000.00, '2023-12-05', 1, 16, NULL),
(124, 2, 7, 34, 4, 'مواد كهربائية', 10000.00, '2023-12-10', 1, 11, NULL),
(125, 4, 4, 24, 7, 'جبس وغيره', 5000.00, '2023-12-29', 1, 2, NULL),
(126, 5, 3, 10, 3, 'أسمنت', 20000.00, '2023-12-30', 1, 10, NULL),
(127, 4, 5, 25, 8, 'بورسلين', 10000.00, '2024-01-05', 1, 13, NULL),
(128, 5, 3, 11, 3, 'قزة وقرانيلية', 10000.00, '2024-01-05', 1, 2, NULL),
(129, 4, 5, 26, 9, 'رخام', 10000.00, '2024-01-23', 1, 14, NULL),
(130, 2, 7, 35, 13, 'حديد حماية للنوافذ', 30000.00, '2024-01-24', 2, 24, NULL),
(131, 5, 3, 12, 4, 'مواد كهربائية', 15000.00, '2024-01-25', 1, 11, NULL),
(132, 4, 5, 27, 11, 'ألومنيوم', 40000.00, '2024-02-12', 2, 15, NULL),
(133, 5, 4, 13, 9, 'رخام', 20000.00, '2024-02-25', 1, 14, NULL),
(134, 4, 5, 28, 12, 'خشبية', 20000.00, '2024-02-26', 2, 21, NULL),
(135, 2, 7, 36, 14, 'طلاء داخلي', 10000.00, '2024-02-27', 1, 25, NULL),
(136, 2, 8, 37, 5, 'مواد صحية', 10000.00, '2024-03-02', 1, 12, NULL),
(137, 4, 6, 29, 4, 'مواد كهربائية', 10000.00, '2024-03-05', 1, 20, NULL),
(138, 4, 6, 30, 5, 'مواد صحية', 10000.00, '2024-03-26', 1, 9, NULL),
(139, 2, 8, 38, 4, 'مواد كهربائية', 10000.00, '2024-03-28', 1, 11, NULL),
(140, 4, 6, 31, 8, 'بورسلين', 30000.00, '2024-04-15', 1, 13, NULL),
(141, 2, 8, 39, 11, 'الومنيوم', 30000.00, '2024-04-20', 2, 15, NULL),
(142, 5, 4, 14, 8, 'بورسلين', 20000.00, '2024-04-22', 1, 13, NULL),
(143, 2, 8, 40, 14, 'طلاء داخلي', 15000.00, '2024-05-08', 1, 25, NULL),
(144, 4, 6, 32, 9, 'رخام', 20000.00, '2024-05-25', 1, 14, NULL),
(145, 5, 4, 15, 11, 'الومنيوم', 30000.00, '2024-05-26', 1, 26, NULL),
(146, 4, 7, 33, 4, 'مواد كهربائية', 10000.00, '2024-06-02', 1, 11, NULL),
(147, 4, 7, 34, 5, 'مواد صحية', 15000.00, '2024-06-22', 3, 12, NULL),
(148, 4, 7, 35, 13, 'حديد حماية للنوافذ', 20000.00, '2024-07-25', 2, 24, NULL),
(149, 4, 7, 36, 14, 'طلاء داخلي', 5000.00, '2024-08-15', 1, 25, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `paymentmethods`
--

CREATE TABLE `paymentmethods` (
  `PaymentMethodID` int(11) NOT NULL,
  `PaymentMethodName` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `paymentmethods`
--

INSERT INTO `paymentmethods` (`PaymentMethodID`, `PaymentMethodName`) VALUES
(1, 'نقداً'),
(2, 'صك مصدق'),
(3, 'آجل'),
(4, 'حوالة');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `PaymentID` int(11) NOT NULL,
  `ProjectID` int(11) DEFAULT NULL,
  `Amount` decimal(10,0) NOT NULL,
  `PaymentDate` date DEFAULT NULL,
  `SettlementDate` date DEFAULT NULL,
  `paymentNumber` int(11) DEFAULT NULL,
  `materialInvoices` decimal(10,2) DEFAULT NULL,
  `technicianInvoices` decimal(10,2) DEFAULT NULL,
  `accountantID` int(11) DEFAULT NULL,
  `PaymentMethodID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`PaymentID`, `ProjectID`, `Amount`, `PaymentDate`, `SettlementDate`, `paymentNumber`, `materialInvoices`, `technicianInvoices`, `accountantID`, `PaymentMethodID`) VALUES
(1, 1, 110000, '2020-03-10', '2020-06-20', 1, 70000.00, 30000.00, 5, 2),
(2, 1, 110000, '2020-06-10', '2021-01-10', 2, 70000.00, 30000.00, 7, 1),
(3, 1, 110000, '2021-01-01', '2012-05-10', 3, 70000.00, 30000.00, 5, 1),
(4, 2, 110000, '2021-04-28', '2021-07-20', 1, 70000.00, 30000.00, 7, 1),
(5, 1, 110000, '2021-05-01', '2021-12-20', 4, 65000.00, 35000.00, 5, 3),
(6, 2, 110000, '2021-07-10', '2022-01-10', 2, 65000.00, 35000.00, 7, 1),
(7, 1, 110000, '2021-12-10', '2022-05-10', 5, 65000.00, 35000.00, 5, 1),
(8, 2, 110000, '2022-01-01', '2022-07-10', 3, 65000.00, 35000.00, 7, 1),
(9, 1, 110000, '2022-05-01', '2022-09-10', 6, 70000.00, 30000.00, 5, 1),
(10, 3, 110000, '2022-06-08', '2022-06-18', 1, 70000.00, 30000.00, 7, 1),
(11, 2, 110000, '2022-07-01', '2023-01-10', 4, 65000.00, 35000.00, 5, 1),
(12, 1, 110000, '2022-09-01', '2023-03-10', 7, 65000.00, 35000.00, 7, 1),
(13, 3, 110000, '2022-09-10', '2023-02-10', 2, 65000.00, 35000.00, 5, 1),
(14, 4, 110000, '2022-10-16', '2023-03-10', 1, 70000.00, 30000.00, 7, 1),
(15, 1, 110000, '2022-12-01', '2023-02-28', 8, 70000.00, 30000.00, 5, 1),
(16, 2, 110000, '2023-01-01', '2023-07-10', 5, 70000.00, 30000.00, 7, 1),
(17, 3, 110000, '2023-02-01', '2023-08-10', 3, 65000.00, 35000.00, 5, 1),
(18, 4, 110000, '2023-03-01', '2023-08-10', 2, 65000.00, 35000.00, 7, 1),
(19, 5, 110000, '2023-05-30', '2023-09-10', 1, 65000.00, 35000.00, 5, 1),
(20, 4, 110000, '2023-06-01', '2023-10-10', 3, 75000.00, 25000.00, 7, 1),
(21, 2, 110000, '2023-07-01', '2023-11-10', 6, 70000.00, 30000.00, 5, 1),
(22, 3, 110000, '2023-08-01', NULL, 4, 70000.00, 30000.00, 7, 1),
(23, 5, 110000, '2023-09-01', '2023-12-10', 2, 65000.00, 35000.00, 5, 1),
(24, 4, 110000, '2023-10-01', '2024-01-10', 4, 50000.00, 50000.00, 7, 1),
(25, 2, 110000, '2023-11-01', '2024-03-10', 7, 70000.00, 30000.00, 5, 1),
(26, 5, 110000, '2023-12-01', '2024-02-10', 3, 65000.00, 35000.00, 7, 1),
(27, 4, 110000, '2024-01-01', '2024-03-10', 5, 80000.00, 20000.00, 5, 1),
(28, 5, 110000, '2024-02-01', '2024-06-10', 4, 70000.00, 30000.00, 7, 1),
(29, 2, 110000, '2024-03-01', '2024-05-10', 8, 65000.00, 35000.00, 5, 1),
(30, 4, 110000, '2024-03-01', '2024-06-10', 6, 70000.00, 30000.00, 7, 1),
(31, 4, 110000, '2024-06-01', NULL, 7, 50000.00, 20000.00, 5, 1),
(32, 6, 11000, '2024-07-19', '0000-00-00', 1, 0.00, 0.00, 5, 1),
(33, 6, 22000, '2024-07-20', '0000-00-00', 2, 0.00, 0.00, 5, 2),
(34, 6, 50000, '2024-07-20', NULL, 3, 0.00, 0.00, 7, 3);

-- --------------------------------------------------------

--
-- Table structure for table `projectdocumentation`
--

CREATE TABLE `projectdocumentation` (
  `DocumentationID` int(11) NOT NULL,
  `ProjectID` int(11) NOT NULL,
  `DocumentationTypeID` int(11) NOT NULL,
  `FilePath` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `ProjectID` int(11) NOT NULL,
  `CustomerID` int(11) DEFAULT NULL,
  `SupervisingEngineerID` int(11) DEFAULT NULL,
  `ContractSignDate` date DEFAULT NULL,
  `LandLocation` varchar(255) DEFAULT NULL,
  `IsInPlan` tinyint(1) DEFAULT NULL,
  `HasBuildingPermit` tinyint(1) DEFAULT NULL,
  `PropertyType` int(11) NOT NULL,
  `LandArea` float DEFAULT NULL,
  `ProjectStartDate` date DEFAULT NULL,
  `ProjectEndDate` date DEFAULT NULL,
  `ProjectStatus` int(11) NOT NULL,
  `ProgressPercentage` float DEFAULT NULL,
  `PropertyDescription` text DEFAULT NULL,
  `rate_Of_CostPlus` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`ProjectID`, `CustomerID`, `SupervisingEngineerID`, `ContractSignDate`, `LandLocation`, `IsInPlan`, `HasBuildingPermit`, `PropertyType`, `LandArea`, `ProjectStartDate`, `ProjectEndDate`, `ProjectStatus`, `ProgressPercentage`, `PropertyDescription`, `rate_Of_CostPlus`) VALUES
(1, 1, 4, '2020-02-24', 'عين زارة', 0, 0, 1, 400, '2020-03-10', '2024-05-15', 2, 100, 'فيلا دورين بها جنان وحوض سباحة', 10),
(2, 2, 2, '2021-04-03', 'المشتل', 1, 0, 1, 600, '2021-04-28', NULL, 1, 70, NULL, 10),
(3, 3, 4, '2022-05-14', 'ميزران', 1, 1, 5, 1500, '2022-06-08', NULL, 3, 20, NULL, 10),
(4, 4, 3, '2022-09-06', 'الدهماني', 1, 1, 1, 500, '2022-10-16', NULL, 1, 65, NULL, 10),
(5, 5, 2, '2023-05-28', 'زناته', 1, 0, 2, 2000, '2023-05-30', NULL, 1, 15, NULL, 10),
(6, 2, 2, '2024-07-02', 'قرجي', 1, 0, 1, 300, '2024-07-17', NULL, 1, 0, NULL, 15),
(7, 3, 3, '2024-07-10', 'المشتل', 1, 0, 2, 300, '2024-07-03', NULL, 1, 0, NULL, 12);

-- --------------------------------------------------------

--
-- Table structure for table `projectstatus`
--

CREATE TABLE `projectstatus` (
  `id` int(11) NOT NULL,
  `StatusName` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `projectstatus`
--

INSERT INTO `projectstatus` (`id`, `StatusName`) VALUES
(1, 'تحت التنفيذ'),
(2, 'مكتمل'),
(3, 'متوقف');

-- --------------------------------------------------------

--
-- Table structure for table `projecttechnicians`
--

CREATE TABLE `projecttechnicians` (
  `ProjectID` int(11) NOT NULL,
  `TechnicianID` int(11) NOT NULL,
  `SpecializationID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `propertytype`
--

CREATE TABLE `propertytype` (
  `id` int(11) NOT NULL,
  `TypeName` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `propertytype`
--

INSERT INTO `propertytype` (`id`, `TypeName`) VALUES
(1, 'فيلا'),
(2, 'عمارة'),
(3, 'فندق'),
(4, 'سوق'),
(5, 'مصحة'),
(6, 'مدرسة'),
(7, 'شركة');

-- --------------------------------------------------------

--
-- Table structure for table `specializations`
--

CREATE TABLE `specializations` (
  `SpecializationID` int(11) NOT NULL,
  `SpecializationName` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `specializations`
--

INSERT INTO `specializations` (`SpecializationID`, `SpecializationName`) VALUES
(1, 'عام'),
(2, 'الهيكل'),
(3, 'المباني'),
(4, 'الكهرباء'),
(5, 'الصحي'),
(6, 'اللياسة'),
(7, 'الجبس'),
(8, 'الأرضيات'),
(9, 'التكسيات'),
(10, 'الجلي'),
(11, 'النوافذ'),
(12, 'الأبواب'),
(13, 'الحديد المشغول'),
(14, 'الطلاء'),
(15, 'الحفر');

-- --------------------------------------------------------

--
-- Table structure for table `stores`
--

CREATE TABLE `stores` (
  `StoreID` int(11) NOT NULL,
  `StoreName` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `stores`
--

INSERT INTO `stores` (`StoreID`, `StoreName`) VALUES
(2, 'أبناء الساحلي'),
(17, 'أنوار المدينة'),
(10, 'الاتحاد العربي'),
(8, 'الاتحاد الليبي الحديث'),
(19, 'البيت المضيء'),
(21, 'الحجاجي'),
(13, 'الحضيري'),
(5, 'الدار الوطنية'),
(7, 'الدواس'),
(26, 'السويح'),
(15, 'المجراب'),
(9, 'المدينة'),
(11, 'النجمة اللامعة'),
(12, 'النعمي'),
(20, 'الهاشمي'),
(16, 'برباش'),
(25, 'جوتين'),
(24, 'حسن المغربي'),
(18, 'شركة الإضاءة'),
(6, 'شركة الشرق'),
(3, 'شركة ساحل الخمس'),
(4, 'شركة فالكون ليبيا'),
(1, 'عبد الوهاب الغراري'),
(22, 'قصر السدير'),
(23, 'مصنع البارون'),
(14, 'مصنع الكردون');

-- --------------------------------------------------------

--
-- Table structure for table `technicianinvoices`
--

CREATE TABLE `technicianinvoices` (
  `InvoiceID` int(11) NOT NULL,
  `ProjectID` int(11) DEFAULT NULL,
  `TechnicianID` int(11) DEFAULT NULL,
  `PaymentID` int(11) DEFAULT NULL,
  `InvoiceNumber` int(11) DEFAULT NULL,
  `SpecializationID` int(11) DEFAULT NULL,
  `Amount` decimal(10,2) DEFAULT NULL,
  `InvoiceDate` date DEFAULT NULL,
  `PaymentMethodID` int(11) DEFAULT NULL,
  `Description` text DEFAULT NULL,
  `InvoiceImage` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `technicianinvoices`
--

INSERT INTO `technicianinvoices` (`InvoiceID`, `ProjectID`, `TechnicianID`, `PaymentID`, `InvoiceNumber`, `SpecializationID`, `Amount`, `InvoiceDate`, `PaymentMethodID`, `Description`, `InvoiceImage`) VALUES
(1, 1, 1, 1, 1, 1, 5000.00, '2020-03-15', 1, NULL, NULL),
(2, 1, 2, 1, 2, 2, 25000.00, '2020-05-30', 1, NULL, NULL),
(3, 1, 2, 2, 3, 2, 30000.00, '2020-09-04', 1, NULL, NULL),
(4, 1, 3, 3, 4, 4, 5000.00, '2021-01-11', 1, NULL, NULL),
(5, 1, 4, 3, 5, 5, 5000.00, '2021-02-15', 1, NULL, NULL),
(6, 1, 2, 3, 6, 3, 20000.00, '2021-04-12', 1, NULL, NULL),
(7, 2, 1, 1, 1, 1, 5000.00, '2021-05-10', 1, NULL, NULL),
(8, 2, 5, 1, 2, 2, 25000.00, '2021-07-03', 1, NULL, NULL),
(9, 1, 6, 4, 7, 6, 30000.00, '2021-11-30', 1, NULL, NULL),
(10, 1, 7, 4, 8, 7, 5000.00, '2021-12-05', 1, NULL, NULL),
(11, 2, 5, 2, 3, 2, 30000.00, '2021-12-15', 1, NULL, NULL),
(12, 1, 8, 5, 9, 8, 10000.00, '2021-12-20', 1, NULL, NULL),
(13, 2, 9, 3, 4, 4, 5000.00, '2022-01-18', 1, NULL, NULL),
(14, 1, 10, 5, 10, 9, 15000.00, '2022-02-16', 1, NULL, NULL),
(15, 2, 13, 3, 5, 5, 5000.00, '2022-03-12', 1, NULL, NULL),
(16, 1, 3, 5, 11, 4, 10000.00, '2022-04-21', 1, NULL, NULL),
(17, 1, 4, 6, 12, 5, 10000.00, '2022-05-10', 1, NULL, NULL),
(18, 2, 5, 3, 6, 3, 20000.00, '2022-06-21', 1, NULL, NULL),
(19, 3, 1, 1, 1, 1, 5000.00, '2022-07-10', 1, NULL, NULL),
(20, 3, 12, 1, 2, 2, 25000.00, '2022-09-02', 1, NULL, NULL),
(21, 1, 8, 6, 13, 8, 10000.00, '2022-09-07', 1, NULL, NULL),
(22, 1, 3, 7, 15, 4, 10000.00, '2022-09-10', 1, NULL, NULL),
(23, 3, 12, 2, 3, 2, 30000.00, '2022-09-15', 1, NULL, NULL),
(24, 1, 13, 7, 16, 5, 15000.00, '2022-10-16', 1, NULL, NULL),
(25, 2, 13, 4, 7, 6, 30000.00, '2022-11-11', 1, NULL, NULL),
(26, 4, 1, 1, 1, 1, 5000.00, '2022-11-15', 1, NULL, NULL),
(27, 1, 14, 7, 17, 10, 10000.00, '2022-11-27', 1, NULL, NULL),
(28, 1, 10, 6, 14, 9, 10000.00, '2022-12-01', 1, NULL, NULL),
(29, 2, 15, 4, 8, 9, 5000.00, '2022-12-15', 1, NULL, NULL),
(30, 3, 3, 2, 4, 4, 5000.00, '2023-01-18', 1, NULL, NULL),
(31, 1, 1, 8, 19, 1, 5000.00, '2023-02-10', 1, NULL, NULL),
(32, 4, 2, 1, 2, 2, 25000.00, '2023-02-26', 1, NULL, NULL),
(33, 3, 4, 3, 5, 5, 5000.00, '2023-03-28', 1, NULL, NULL),
(34, 1, 16, 8, 18, 14, 25000.00, '2023-03-31', 1, NULL, NULL),
(35, 2, 17, 5, 9, 8, 20000.00, '2023-04-26', 1, NULL, NULL),
(36, 2, 15, 5, 10, 9, 15000.00, '2023-06-15', 1, NULL, NULL),
(37, 5, 1, 1, 1, 1, 5000.00, '2023-06-20', 1, NULL, NULL),
(38, 3, 12, 3, 6, 3, 30000.00, '2023-07-14', 1, NULL, NULL),
(39, 4, 2, 3, 3, 2, 30000.00, '2023-07-15', 1, NULL, NULL),
(40, 3, 6, 4, 7, 6, 15000.00, '2023-08-20', 1, NULL, NULL),
(41, 5, 5, 1, 2, 2, 30000.00, '2023-08-22', 1, NULL, NULL),
(42, 4, 9, 3, 4, 4, 5000.00, '2023-09-10', 1, NULL, NULL),
(43, 2, 9, 6, 11, 4, 15000.00, '2023-09-28', 1, NULL, NULL),
(44, 4, 13, 4, 5, 5, 5000.00, '2023-10-15', 1, NULL, NULL),
(45, 2, 13, 6, 12, 5, 15000.00, '2023-10-26', 1, NULL, NULL),
(46, 5, 5, 2, 3, 2, 30000.00, '2023-10-27', 1, NULL, NULL),
(47, 3, 8, 4, 8, 8, 20000.00, '2023-11-12', 1, NULL, NULL),
(48, 4, 17, 5, 9, 8, 20000.00, '2023-11-25', 1, NULL, NULL),
(49, 5, 3, 3, 4, 4, 5000.00, '2023-12-05', 1, NULL, NULL),
(50, 4, 15, 5, 10, 9, 15000.00, '2023-12-22', 1, NULL, NULL),
(51, 5, 4, 3, 5, 5, 5000.00, '2024-01-10', 1, NULL, NULL),
(52, 3, 10, 5, 11, 9, 15000.00, '2024-01-22', 1, NULL, NULL),
(53, 5, 13, 4, 7, 6, 30000.00, '2024-02-10', 1, NULL, NULL),
(54, 5, 14, 4, 8, 10, 10000.00, '2024-02-20', 1, NULL, NULL),
(55, 3, 8, 6, 13, 8, 20000.00, '2024-03-01', 1, NULL, NULL),
(56, 3, 10, 6, 14, 9, 10000.00, '2024-03-10', 1, NULL, NULL),
(57, 4, 3, 6, 15, 4, 10000.00, '2024-03-20', 1, NULL, NULL),
(58, 5, 9, 5, 12, 4, 15000.00, '2024-04-05', 1, NULL, NULL),
(59, 4, 13, 7, 16, 5, 15000.00, '2024-04-15', 1, NULL, NULL),
(60, 5, 4, 5, 13, 5, 10000.00, '2024-04-25', 1, NULL, NULL),
(61, 3, 14, 7, 17, 10, 10000.00, '2024-05-02', 1, NULL, NULL),
(62, 4, 1, 8, 19, 1, 5000.00, '2024-05-10', 1, NULL, NULL),
(63, 4, 16, 8, 18, 14, 25000.00, '2024-05-20', 1, NULL, NULL),
(64, 5, 3, 6, 15, 4, 10000.00, '2024-06-01', 1, NULL, NULL),
(65, 5, 4, 6, 16, 5, 10000.00, '2024-06-10', 1, NULL, NULL),
(66, 4, 15, 9, 20, 9, 15000.00, '2024-06-20', 1, NULL, NULL),
(67, 5, 14, 7, 18, 10, 10000.00, '2024-07-01', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `technicians`
--

CREATE TABLE `technicians` (
  `TechnicianID` int(11) NOT NULL,
  `TechnicianName` varchar(255) NOT NULL,
  `Nationality` varchar(100) DEFAULT NULL,
  `PhoneNumber` varchar(15) DEFAULT NULL,
  `JoinDate` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `technicians`
--

INSERT INTO `technicians` (`TechnicianID`, `TechnicianName`, `Nationality`, `PhoneNumber`, `JoinDate`) VALUES
(1, 'كابانكو', 'نيجيري', '0912345671', '2020-01-15'),
(2, 'أبو عصام', 'سوري', '0912345672', '2020-02-20'),
(3, 'العربي', 'ليبي', '0912345673', '2020-03-25'),
(4, 'حمدي', 'مصري', '0912345674', '2020-04-30'),
(5, 'أبو فهد', 'سوري', '0912345675', '2020-05-05'),
(6, 'إيريك الغاني', 'غاني', '0912345676', '2020-06-10'),
(7, 'محمد جمال', 'مصري', '0912345677', '2020-07-15'),
(8, 'وليد', 'أردني', '0912345678', '2020-08-20'),
(9, 'عادل', 'ليبي', '0912345679', '2020-09-25'),
(10, 'واثق', 'سوري', '0912345680', '2020-10-30'),
(11, 'فوزي', 'مصري', '0912345681', '2020-11-05'),
(12, 'أبو عمر', 'سوري', '0912345682', '2020-12-10'),
(13, 'حسين المصري', 'مصري', '0912345683', '2021-01-15'),
(14, 'ياسر', 'مصري', '0912345684', '2021-02-20'),
(15, 'رمضان', 'سوري', '0912345685', '2021-03-25'),
(16, 'خالد', 'مصري', '0912345686', '2021-04-30'),
(17, 'عدلي', 'سوري', '0912345687', '2021-05-05'),
(18, 'مالك', 'مصري', '0912345688', '2021-06-10');

-- --------------------------------------------------------

--
-- Table structure for table `technician_specializations`
--

CREATE TABLE `technician_specializations` (
  `TechnicianSpecializationID` int(11) NOT NULL,
  `TechnicianID` int(11) NOT NULL,
  `SpecializationID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `technician_specializations`
--

INSERT INTO `technician_specializations` (`TechnicianSpecializationID`, `TechnicianID`, `SpecializationID`) VALUES
(1, 1, 1),
(2, 2, 2),
(3, 2, 3),
(4, 3, 4),
(5, 4, 5),
(6, 5, 2),
(7, 5, 3),
(8, 6, 6),
(9, 7, 7),
(10, 8, 8),
(11, 8, 9),
(12, 9, 4),
(13, 10, 8),
(14, 10, 9),
(15, 11, 5),
(16, 12, 2),
(17, 12, 3),
(18, 13, 6),
(19, 14, 10),
(20, 15, 8),
(21, 15, 9),
(22, 16, 14),
(23, 17, 8),
(24, 17, 9),
(25, 18, 14);

-- --------------------------------------------------------

--
-- Table structure for table `usertype`
--

CREATE TABLE `usertype` (
  `id` int(11) NOT NULL,
  `type` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `usertype`
--

INSERT INTO `usertype` (`id`, `type`) VALUES
(1, 'مدير'),
(2, 'زبون'),
(3, 'مهندس'),
(4, 'محاسب'),
(5, 'مشتري'),
(6, 'مدخل بيانات');

-- --------------------------------------------------------

--
-- Table structure for table `usertype_group_policy`
--

CREATE TABLE `usertype_group_policy` (
  `user_type_id` int(11) NOT NULL,
  `group_policy_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`CustomerId`),
  ADD KEY `userType` (`userType`);

--
-- Indexes for table `documentationtypes`
--
ALTER TABLE `documentationtypes`
  ADD PRIMARY KEY (`DocumentationTypeID`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`employeeId`),
  ADD KEY `userType` (`userType`);

--
-- Indexes for table `group_policy`
--
ALTER TABLE `group_policy`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `materialinvoices`
--
ALTER TABLE `materialinvoices`
  ADD PRIMARY KEY (`Invoice_id`),
  ADD KEY `fk_project` (`project_id`),
  ADD KEY `fk_payment` (`payment_id`),
  ADD KEY `fk_specialization` (`specialization_id`),
  ADD KEY `fk_payment_method` (`payment_method_id`),
  ADD KEY `fk_store` (`store_id`);

--
-- Indexes for table `paymentmethods`
--
ALTER TABLE `paymentmethods`
  ADD PRIMARY KEY (`PaymentMethodID`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`PaymentID`),
  ADD KEY `ProjectID` (`ProjectID`),
  ADD KEY `fk_accountant` (`accountantID`),
  ADD KEY `FK_PaymentMethod` (`PaymentMethodID`);

--
-- Indexes for table `projectdocumentation`
--
ALTER TABLE `projectdocumentation`
  ADD PRIMARY KEY (`DocumentationID`),
  ADD KEY `ProjectID` (`ProjectID`),
  ADD KEY `DocumentationTypeID` (`DocumentationTypeID`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`ProjectID`),
  ADD KEY `projects_ibfk_1` (`CustomerID`),
  ADD KEY `projects_ibfk_2` (`SupervisingEngineerID`),
  ADD KEY `fk_ProjectStatus` (`ProjectStatus`),
  ADD KEY `fk_PropertyType` (`PropertyType`);

--
-- Indexes for table `projectstatus`
--
ALTER TABLE `projectstatus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `projecttechnicians`
--
ALTER TABLE `projecttechnicians`
  ADD PRIMARY KEY (`ProjectID`,`TechnicianID`),
  ADD KEY `TechnicianID` (`TechnicianID`),
  ADD KEY `SpecializationID` (`SpecializationID`);

--
-- Indexes for table `propertytype`
--
ALTER TABLE `propertytype`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `specializations`
--
ALTER TABLE `specializations`
  ADD PRIMARY KEY (`SpecializationID`);

--
-- Indexes for table `stores`
--
ALTER TABLE `stores`
  ADD PRIMARY KEY (`StoreID`),
  ADD UNIQUE KEY `unique_storename` (`StoreName`);

--
-- Indexes for table `technicianinvoices`
--
ALTER TABLE `technicianinvoices`
  ADD PRIMARY KEY (`InvoiceID`),
  ADD KEY `fk_ProjectID` (`ProjectID`),
  ADD KEY `fk_TechnicianID` (`TechnicianID`),
  ADD KEY `fk_PaymentID` (`PaymentID`),
  ADD KEY `fk_SpecializationID` (`SpecializationID`),
  ADD KEY `fk_PaymentMethodID` (`PaymentMethodID`);

--
-- Indexes for table `technicians`
--
ALTER TABLE `technicians`
  ADD PRIMARY KEY (`TechnicianID`);

--
-- Indexes for table `technician_specializations`
--
ALTER TABLE `technician_specializations`
  ADD PRIMARY KEY (`TechnicianSpecializationID`),
  ADD KEY `TechnicianID` (`TechnicianID`),
  ADD KEY `SpecializationID` (`SpecializationID`);

--
-- Indexes for table `usertype`
--
ALTER TABLE `usertype`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `usertype_group_policy`
--
ALTER TABLE `usertype_group_policy`
  ADD PRIMARY KEY (`user_type_id`,`group_policy_id`),
  ADD KEY `group_policy_id` (`group_policy_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `CustomerId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `documentationtypes`
--
ALTER TABLE `documentationtypes`
  MODIFY `DocumentationTypeID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `employeeId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `group_policy`
--
ALTER TABLE `group_policy`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `materialinvoices`
--
ALTER TABLE `materialinvoices`
  MODIFY `Invoice_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=150;

--
-- AUTO_INCREMENT for table `paymentmethods`
--
ALTER TABLE `paymentmethods`
  MODIFY `PaymentMethodID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `PaymentID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `projectdocumentation`
--
ALTER TABLE `projectdocumentation`
  MODIFY `DocumentationID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `ProjectID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `projectstatus`
--
ALTER TABLE `projectstatus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `propertytype`
--
ALTER TABLE `propertytype`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `specializations`
--
ALTER TABLE `specializations`
  MODIFY `SpecializationID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `stores`
--
ALTER TABLE `stores`
  MODIFY `StoreID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `technicianinvoices`
--
ALTER TABLE `technicianinvoices`
  MODIFY `InvoiceID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT for table `technicians`
--
ALTER TABLE `technicians`
  MODIFY `TechnicianID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `technician_specializations`
--
ALTER TABLE `technician_specializations`
  MODIFY `TechnicianSpecializationID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `usertype`
--
ALTER TABLE `usertype`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `customers`
--
ALTER TABLE `customers`
  ADD CONSTRAINT `customers_ibfk_1` FOREIGN KEY (`userType`) REFERENCES `usertype` (`id`);

--
-- Constraints for table `employees`
--
ALTER TABLE `employees`
  ADD CONSTRAINT `employees_ibfk_1` FOREIGN KEY (`userType`) REFERENCES `usertype` (`id`);

--
-- Constraints for table `materialinvoices`
--
ALTER TABLE `materialinvoices`
  ADD CONSTRAINT `fk_payment` FOREIGN KEY (`payment_id`) REFERENCES `payments` (`PaymentID`),
  ADD CONSTRAINT `fk_payment_method` FOREIGN KEY (`payment_method_id`) REFERENCES `paymentmethods` (`PaymentMethodID`),
  ADD CONSTRAINT `fk_project` FOREIGN KEY (`project_id`) REFERENCES `projects` (`ProjectID`),
  ADD CONSTRAINT `fk_specialization` FOREIGN KEY (`specialization_id`) REFERENCES `specializations` (`SpecializationID`),
  ADD CONSTRAINT `fk_store` FOREIGN KEY (`store_id`) REFERENCES `stores` (`StoreID`);

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `FK_PaymentMethod` FOREIGN KEY (`PaymentMethodID`) REFERENCES `paymentmethods` (`PaymentMethodID`),
  ADD CONSTRAINT `fk_accountant` FOREIGN KEY (`accountantID`) REFERENCES `employees` (`employeeId`);

--
-- Constraints for table `projectdocumentation`
--
ALTER TABLE `projectdocumentation`
  ADD CONSTRAINT `projectdocumentation_ibfk_1` FOREIGN KEY (`ProjectID`) REFERENCES `projects` (`ProjectID`),
  ADD CONSTRAINT `projectdocumentation_ibfk_2` FOREIGN KEY (`DocumentationTypeID`) REFERENCES `documentationtypes` (`DocumentationTypeID`);

--
-- Constraints for table `projecttechnicians`
--
ALTER TABLE `projecttechnicians`
  ADD CONSTRAINT `fk_projecttechnicians_project` FOREIGN KEY (`ProjectID`) REFERENCES `projects` (`ProjectID`),
  ADD CONSTRAINT `projecttechnicians_ibfk_1` FOREIGN KEY (`ProjectID`) REFERENCES `projects` (`ProjectID`),
  ADD CONSTRAINT `projecttechnicians_ibfk_2` FOREIGN KEY (`TechnicianID`) REFERENCES `technicians` (`TechnicianID`),
  ADD CONSTRAINT `projecttechnicians_ibfk_3` FOREIGN KEY (`SpecializationID`) REFERENCES `specializations` (`SpecializationID`);

--
-- Constraints for table `technicianinvoices`
--
ALTER TABLE `technicianinvoices`
  ADD CONSTRAINT `fk_PaymentID` FOREIGN KEY (`PaymentID`) REFERENCES `payments` (`PaymentID`),
  ADD CONSTRAINT `fk_PaymentMethodID` FOREIGN KEY (`PaymentMethodID`) REFERENCES `paymentmethods` (`PaymentMethodID`),
  ADD CONSTRAINT `fk_ProjectID` FOREIGN KEY (`ProjectID`) REFERENCES `projects` (`ProjectID`),
  ADD CONSTRAINT `fk_SpecializationID` FOREIGN KEY (`SpecializationID`) REFERENCES `specializations` (`SpecializationID`),
  ADD CONSTRAINT `fk_TechnicianID` FOREIGN KEY (`TechnicianID`) REFERENCES `technicians` (`TechnicianID`);

--
-- Constraints for table `technician_specializations`
--
ALTER TABLE `technician_specializations`
  ADD CONSTRAINT `technician_specializations_ibfk_1` FOREIGN KEY (`TechnicianID`) REFERENCES `technicians` (`TechnicianID`),
  ADD CONSTRAINT `technician_specializations_ibfk_2` FOREIGN KEY (`SpecializationID`) REFERENCES `specializations` (`SpecializationID`);

--
-- Constraints for table `usertype_group_policy`
--
ALTER TABLE `usertype_group_policy`
  ADD CONSTRAINT `usertype_group_policy_ibfk_1` FOREIGN KEY (`user_type_id`) REFERENCES `usertype` (`id`),
  ADD CONSTRAINT `usertype_group_policy_ibfk_2` FOREIGN KEY (`group_policy_id`) REFERENCES `group_policy` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
