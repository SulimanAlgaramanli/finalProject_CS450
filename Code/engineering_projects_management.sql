-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 13, 2024 at 02:14 PM
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
  `InvoiceID` int(11) NOT NULL,
  `ProjectID` int(11) DEFAULT NULL,
  `InvoiceNumber` varchar(50) DEFAULT NULL,
  `PaymentID` int(11) DEFAULT NULL,
  `Specialty` varchar(100) DEFAULT NULL,
  `Description` text DEFAULT NULL,
  `Amount` decimal(10,2) DEFAULT NULL,
  `InvoiceDate` date DEFAULT NULL,
  `PaymentMethod` varchar(50) DEFAULT NULL,
  `StoreName` varchar(100) DEFAULT NULL,
  `InvoiceImage` blob DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `materialinvoices`
--

INSERT INTO `materialinvoices` (`InvoiceID`, `ProjectID`, `InvoiceNumber`, `PaymentID`, `Specialty`, `Description`, `Amount`, `InvoiceDate`, `PaymentMethod`, `StoreName`, `InvoiceImage`) VALUES
(1, 3, '', NULL, 'الصحي', '', 1200.00, '0000-00-00', 'نقدا', 'النعمي', ''),
(2, 3, '2', NULL, 'wpdddsda', 'fddf', 332.00, '0000-00-00', 'نقدا', 'النعمي', ''),
(3, 3, '2', NULL, 'wpdddsda', 'fddf', 332.00, '0000-00-00', 'نقدا', 'النعمي', ''),
(4, 3, '2', NULL, 'wpdddsda', 'fddf', 332.00, '0000-00-00', 'نقدا', 'النعمي', ''),
(5, 4, '22', NULL, 'سسس', 'بسليسلثير', 300.00, '0000-00-00', 'نقدا', 'ببي', '');

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
(3, 'حوالة');

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
(34, 6, 50000, '2024-07-20', NULL, 3, 0.00, 0.00, 7, 3),
(35, 6, 55000, '2024-07-12', NULL, 4, 0.00, 0.00, 5, 1);

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
(6, 2, 2, '2024-07-02', 'قرجي', 1, 0, 1, 300, '2024-07-17', NULL, 1, 0, NULL, 10);

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
(14, 'الطلاء');

-- --------------------------------------------------------

--
-- Table structure for table `technicianinvoices`
--

CREATE TABLE `technicianinvoices` (
  `InvoiceID` int(11) NOT NULL,
  `ProjectID` int(11) DEFAULT NULL,
  `Amount` float DEFAULT NULL,
  `Category` varchar(100) DEFAULT NULL,
  `Date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
  ADD PRIMARY KEY (`InvoiceID`),
  ADD KEY `ProjectID` (`ProjectID`),
  ADD KEY `FK_PaymentNumber` (`PaymentID`);

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
-- Indexes for table `technicianinvoices`
--
ALTER TABLE `technicianinvoices`
  ADD PRIMARY KEY (`InvoiceID`),
  ADD KEY `ProjectID` (`ProjectID`);

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
  MODIFY `CustomerId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

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
  MODIFY `InvoiceID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `paymentmethods`
--
ALTER TABLE `paymentmethods`
  MODIFY `PaymentMethodID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `PaymentID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `projectdocumentation`
--
ALTER TABLE `projectdocumentation`
  MODIFY `DocumentationID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `ProjectID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

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
  MODIFY `SpecializationID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `technicianinvoices`
--
ALTER TABLE `technicianinvoices`
  MODIFY `InvoiceID` int(11) NOT NULL AUTO_INCREMENT;

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
  ADD CONSTRAINT `FK_PaymentNumber` FOREIGN KEY (`PaymentID`) REFERENCES `payments` (`PaymentID`),
  ADD CONSTRAINT `materialinvoices_ibfk_1` FOREIGN KEY (`ProjectID`) REFERENCES `projects` (`ProjectID`);

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
  ADD CONSTRAINT `projecttechnicians_ibfk_1` FOREIGN KEY (`ProjectID`) REFERENCES `projects` (`ProjectID`),
  ADD CONSTRAINT `projecttechnicians_ibfk_2` FOREIGN KEY (`TechnicianID`) REFERENCES `technicians` (`TechnicianID`),
  ADD CONSTRAINT `projecttechnicians_ibfk_3` FOREIGN KEY (`SpecializationID`) REFERENCES `specializations` (`SpecializationID`);

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
