-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 12, 2023 at 11:04 PM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `service`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `AdminID` int(11) NOT NULL,
  `Username` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `First_nume` varchar(255) NOT NULL,
  `Last_name` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`AdminID`, `Username`, `Password`, `First_nume`, `Last_name`, `Email`) VALUES
(1, 'vericu', 'softarabesc', 'vericu', 'popescu', 'vericu@yahoo.com');

-- --------------------------------------------------------

--
-- Table structure for table `cars`
--

CREATE TABLE `cars` (
  `CarID` int(11) NOT NULL,
  `ClientID` int(11) NOT NULL,
  `ModelID` int(11) NOT NULL,
  `Year_of_production` int(11) NOT NULL,
  `Km` int(11) NOT NULL,
  `Engine` varchar(255) NOT NULL,
  `Color` int(11) NOT NULL,
  `Registration number` varchar(8) NOT NULL,
  `Vin_number` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cars`
--

INSERT INTO `cars` (`CarID`, `ClientID`, `ModelID`, `Year_of_production`, `Km`, `Engine`, `Color`, `Registration number`, `Vin_number`) VALUES
(4, 6, 2, 2012, 200000, '1.7', 543, 'B22STG', '11dfsdsdgfrFD32'),
(5, 5, 4, 2005, 300000, '2.1', 823, 'GL11ATF', '1sdgt2sfsd5wfsa'),
(17, 10, 2, 19978, 234, '23', 2342, 'w3r3r324', 'khjmgnf'),
(19, 11, 4, 19978, 234, '1.5', 2342, 'w3r3r324', ''),
(28, 11, 4, 19978, 234, '2.2', 2342, 'w3r3r324', 'dsfkiuyjthgrefdw');

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `ClientID` int(11) NOT NULL,
  `First_name` varchar(255) NOT NULL,
  `Last_name` varchar(255) NOT NULL,
  `Phone_number` char(10) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `County` varchar(255) NOT NULL,
  `City` varchar(255) NOT NULL,
  `Street` varchar(255) NOT NULL,
  `No.` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`ClientID`, `First_name`, `Last_name`, `Phone_number`, `Email`, `County`, `City`, `Street`, `No.`) VALUES
(5, 'Vadim', 'Tudor', '0745827531', 'tudor_vadim@yahoo.com', 'Romania', 'Bucuresti', 'Somaldoacii', 12),
(6, 'Neacsu', 'Dan', '0745452457', 'dan_neacsu@yahoo.com', 'Romania', 'Bucuresti', 'Republicii', 21),
(10, 'cl1', 'cl1', '213', '123', 'sdg', '213', '324', 324),
(11, 'cl2', 'cl2', '2sdf', 'vb3', 'sddsfg', '213d', '32swwe4', 32);

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `EmployeeID` int(11) NOT NULL,
  `First_name` varchar(255) NOT NULL,
  `Last_name` varchar(255) NOT NULL,
  `CNP` char(13) NOT NULL,
  `Specialization` varchar(255) NOT NULL,
  `Employment date` date NOT NULL DEFAULT current_timestamp(),
  `Resignation_date` date DEFAULT NULL,
  `Is_free` tinyint(1) NOT NULL DEFAULT 1,
  `Salary` decimal(7,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`EmployeeID`, `First_name`, `Last_name`, `CNP`, `Specialization`, `Employment date`, `Resignation_date`, `Is_free`, `Salary`) VALUES
(1, 'Popescu', 'Marian', '5951203450064', 'mecanic', '2017-04-23', NULL, 0, '3300.00'),
(4, 'Tanase', 'Andrei', '0598020378154', 'tinichigiu', '2019-08-05', NULL, 0, '2300.00'),
(13, 'Eftimie', 'Denis', '1', 'electrician', '2023-01-04', NULL, 1, '2222.00'),
(20, 'test', 'test', '13', 'tinichigiu', '2023-01-05', NULL, 0, '99999.99'),
(21, 'a', 'a', '2', 'mecanic', '2023-01-07', NULL, 0, '2222.00');

-- --------------------------------------------------------

--
-- Table structure for table `models`
--

CREATE TABLE `models` (
  `ModelID` int(11) NOT NULL,
  `Model_name` varchar(255) NOT NULL,
  `Producer_name` varchar(255) NOT NULL,
  `Body_type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `models`
--

INSERT INTO `models` (`ModelID`, `Model_name`, `Producer_name`, `Body_type`) VALUES
(1, 'logan', 'dacia', 'sedan'),
(2, 'sandero', 'dacia', 'hatchback'),
(3, 'duster', 'dacia', 'suv'),
(4, 'golf', 'wv', 'hatchback'),
(5, 'tiguan', 'wv', 'suv');

-- --------------------------------------------------------

--
-- Table structure for table `parts`
--

CREATE TABLE `parts` (
  `PartID` int(11) NOT NULL,
  `ServiceID` int(11) NOT NULL,
  `ModelID` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Price` decimal(7,2) NOT NULL,
  `No_stock` int(11) NOT NULL,
  `No_lot` char(10) NOT NULL,
  `Date_manufacturing` date NOT NULL,
  `Validity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `parts`
--

INSERT INTO `parts` (`PartID`, `ServiceID`, `ModelID`, `Name`, `Price`, `No_stock`, `No_lot`, `Date_manufacturing`, `Validity`) VALUES
(1, 1, 1, 'filtru ulei', '100.00', 100000011, '52453', '2020-08-03', 4),
(2, 1, 1, 'ulei', '200.00', 11, '52453', '2020-08-03', 4),
(3, 1, 2, 'filtru ulei', '300.00', 7, '354453', '2020-08-03', 4),
(4, 1, 2, 'ulei', '400.00', 13, '45253', '2020-08-03', 4),
(5, 1, 3, 'filtru ulei', '500.00', 13, '52343', '2020-08-03', 4),
(6, 1, 3, 'ulei', '600.00', 6013, '53423', '2020-08-03', 4),
(7, 2, 4, 'stick cu soft', '700.00', 15, '324353', '2020-08-03', 4),
(8, 1, 5, 'filtru ulei', '800.00', 12, '64532', '2019-03-23', 23),
(9, 1, 4, 'filtru ulei', '900.00', 3, '64532', '2019-03-23', 23),
(10, 1, 4, 'ulei', '1000.00', 3, '64532', '2019-03-23', 23),
(11, 1, 5, 'ulei', '1100.00', 12, '64532', '2019-03-23', 23),
(12, 2, 1, 'stick cu soft', '1200.00', 6, '6356', '2020-05-13', 99),
(13, 2, 2, 'stick cu soft', '1300.00', 20, '6356', '2020-05-13', 99),
(14, 2, 3, 'stick cu soft', '1400.00', 22, '6356', '2020-05-13', 99),
(15, 2, 5, 'stick cu soft', '1500.00', 23, '6356', '2020-05-13', 99),
(16, 3, 1, 'kit pana', '1600.00', 0, '6356', '2020-05-13', 99),
(17, 3, 2, 'kit pana', '1700.00', 22, '6356', '2020-05-13', 99),
(18, 3, 3, 'kit pana', '1800.00', 21, '6356', '2020-05-13', 99),
(19, 3, 4, 'kit pana', '1900.00', 22, '6356', '2020-05-13', 99),
(20, 3, 5, 'kit pana', '2000.00', 23, '6356', '2020-05-13', 99),
(21, 4, 1, 'becuri', '2100.00', 99, '435', '2019-05-13', 99),
(22, 4, 2, 'becuri', '2200.00', 100, '435', '2019-05-13', 99),
(23, 4, 3, 'becuri', '2300.00', 6099, '435', '2019-05-13', 99),
(24, 4, 4, 'becuri', '2400.00', 100, '435', '2019-05-13', 99),
(25, 4, 5, 'becuri', '2500.00', 100, '435', '2019-05-13', 99),
(26, 5, 1, 'kit caroserie', '2600.00', 99, '435', '2019-05-13', 99),
(27, 5, 1, 'vopsea', '2700.00', 99, '435', '2019-05-13', 99),
(28, 5, 2, 'kit caroserie', '2800.00', 100, '435', '2019-05-13', 99),
(29, 5, 2, 'vopsea', '2900.00', 100, '435', '2019-05-13', 99),
(30, 5, 3, 'kit caroserie', '3000.00', 66, '435', '2019-05-13', 99),
(31, 5, 3, 'vopsea', '3100.00', 96, '435', '2019-05-13', 99),
(32, 5, 4, 'kit caroserie', '3200.00', 94, '435', '2019-05-13', 99),
(33, 5, 4, 'vopsea', '3300.00', 94, '435', '2019-05-13', 99),
(34, 5, 5, 'kit caroserie', '3400.00', 100, '435', '2019-05-13', 99),
(35, 5, 5, 'vopsea', '3500.00', 100, '435', '2019-05-13', 99);

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `ServiceID` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Specialization_needed` varchar(255) NOT NULL,
  `No_hours` int(11) NOT NULL,
  `Cost` decimal(7,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`ServiceID`, `Name`, `Specialization_needed`, `No_hours`, `Cost`) VALUES
(1, 'schimb ulei', 'mecanic', 2, '120.00'),
(2, 'soft arabesc', 'electrician', 2, '180.00'),
(3, 'pana', 'mecanic', 1, '30.00'),
(4, 'faruri', 'electrician', 1, '30.00'),
(5, 'caroserie', 'tinichigiu', 5, '360.00');

-- --------------------------------------------------------

--
-- Table structure for table `works_performed`
--

CREATE TABLE `works_performed` (
  `WorkID` int(11) NOT NULL,
  `ServiceID` int(11) NOT NULL,
  `EmployeeID` int(11) DEFAULT NULL,
  `CarID` int(11) DEFAULT NULL,
  `Date_started` datetime NOT NULL DEFAULT current_timestamp(),
  `Duration` int(11) DEFAULT NULL,
  `Finished` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `works_performed`
--

INSERT INTO `works_performed` (`WorkID`, `ServiceID`, `EmployeeID`, `CarID`, `Date_started`, `Duration`, `Finished`) VALUES
(58, 1, NULL, NULL, '2023-01-03 12:29:05', 0, 1),
(59, 2, NULL, NULL, '2023-01-03 12:30:00', 0, 1),
(60, 1, 1, NULL, '2023-01-03 12:30:07', 0, 1),
(61, 1, NULL, NULL, '2023-01-03 12:31:33', 0, 1),
(62, 2, NULL, 5, '2023-01-03 12:31:50', 0, 1),
(63, 1, 1, NULL, '2023-01-03 12:42:57', 0, 1),
(64, 1, NULL, NULL, '2023-01-03 12:46:30', 0, 1),
(65, 2, NULL, NULL, '2023-01-03 12:58:17', 0, 1),
(66, 1, NULL, NULL, '2023-01-03 13:08:09', 0, 1),
(67, 1, NULL, NULL, '2023-01-03 13:14:26', 0, 1),
(68, 2, NULL, NULL, '2023-01-03 13:14:54', 0, 1),
(70, 1, 1, 4, '2023-01-03 13:15:22', 0, 1),
(71, 2, NULL, NULL, '2023-01-03 13:16:30', 1, 1),
(72, 1, NULL, 4, '2023-01-03 13:50:23', 0, 1),
(73, 2, NULL, NULL, '2023-01-03 14:19:53', 0, 1),
(74, 1, NULL, NULL, '2023-01-03 14:41:42', 0, 1),
(76, 1, NULL, 4, '2023-01-03 14:45:33', 0, 1),
(77, 1, 1, NULL, '2023-01-03 14:52:05', 0, 1),
(78, 2, NULL, 4, '2023-01-03 15:10:48', 2, 1),
(80, 1, 1, NULL, '2023-01-03 18:50:33', 0, 1),
(82, 1, NULL, NULL, '2023-01-03 18:54:52', 0, 1),
(83, 1, 1, NULL, '2023-01-03 18:55:04', 0, 1),
(86, 2, NULL, NULL, '2023-01-03 19:13:18', 0, 1),
(87, 3, 1, NULL, '2023-01-03 19:13:30', 0, 1),
(88, 1, NULL, NULL, '2023-01-03 19:15:47', 0, 1),
(89, 3, 1, NULL, '2023-01-03 19:15:53', 0, 1),
(90, 2, NULL, NULL, '2023-01-03 19:16:00', 0, 1),
(91, 1, NULL, NULL, '2023-01-03 19:16:07', 0, 1),
(92, 1, 1, NULL, '2023-01-03 20:11:19', 0, 1),
(93, 1, NULL, NULL, '2023-01-03 20:11:27', 0, 1),
(94, 5, 4, NULL, '2023-01-03 20:11:33', 0, 1),
(95, 1, 1, NULL, '2023-01-03 20:11:41', 0, 1),
(96, 1, 1, 5, '2023-01-04 11:55:04', 0, 1),
(97, 1, NULL, NULL, '2023-01-04 12:37:46', 0, 1),
(98, 2, NULL, NULL, '2023-01-04 12:40:03', 0, 1),
(99, 1, 1, NULL, '2023-01-04 12:41:49', 0, 1),
(100, 1, NULL, 5, '2023-01-04 12:42:18', 0, 1),
(101, 1, NULL, 4, '2023-01-04 12:46:40', 0, 1),
(102, 1, NULL, NULL, '2023-01-04 13:28:17', 0, 1),
(103, 2, NULL, NULL, '2023-01-04 13:28:34', 0, 1),
(104, 2, NULL, NULL, '2023-01-04 13:29:14', 0, 1),
(105, 4, NULL, NULL, '2023-01-04 13:30:33', 0, 1),
(107, 1, 1, NULL, '2023-01-04 16:29:16', 0, 1),
(108, 2, NULL, 5, '2023-01-04 16:33:40', 0, 1),
(109, 1, 1, 4, '2023-01-04 16:33:59', 0, 1),
(110, 1, NULL, 5, '2023-01-04 16:39:40', 0, 1),
(111, 1, NULL, 4, '2023-01-04 16:42:27', 0, 1),
(112, 1, 1, NULL, '2023-01-04 16:45:05', 0, 1),
(113, 1, NULL, NULL, '2023-01-04 16:45:45', 0, 1),
(114, 1, NULL, NULL, '2023-01-04 16:48:36', 0, 1),
(115, 2, NULL, 4, '2023-01-04 16:49:19', 0, 1),
(116, 5, 4, NULL, '2023-01-04 16:49:31', 0, 1),
(117, 3, 1, NULL, '2023-01-04 16:49:38', 0, 1),
(118, 1, NULL, NULL, '2023-01-04 17:06:10', 0, 1),
(119, 3, 1, NULL, '2023-01-04 17:06:44', 0, 1),
(120, 1, NULL, 5, '2023-01-04 17:07:44', 0, 1),
(121, 2, NULL, NULL, '2023-01-04 17:08:06', 0, 1),
(122, 2, NULL, NULL, '2023-01-04 17:09:42', 0, 1),
(124, 3, NULL, NULL, '2023-01-04 18:08:56', 0, 1),
(125, 2, 13, 5, '2023-01-04 18:20:36', 19, 1),
(126, 1, 1, NULL, '2023-01-04 18:22:07', 19, 1),
(127, 2, 13, 5, '2023-01-05 15:42:27', 0, 1),
(128, 1, 1, NULL, '2023-01-05 15:46:54', 0, 1),
(129, 3, 1, NULL, '2023-01-05 15:47:49', 0, 1),
(130, 1, 1, NULL, '2023-01-05 15:50:40', 0, 1),
(131, 2, 13, NULL, '2023-01-05 15:50:51', 0, 1),
(132, 5, 4, NULL, '2023-01-05 15:51:03', 0, 1),
(133, 1, 1, NULL, '2023-01-05 15:52:34', 0, 1),
(134, 2, 13, NULL, '2023-01-05 15:52:41', 0, 1),
(135, 1, 1, NULL, '2023-01-05 15:55:05', 0, 1),
(136, 1, NULL, 5, '2023-01-05 16:28:31', 0, 1),
(137, 1, NULL, 5, '2023-01-05 16:32:22', 0, 1),
(138, 1, NULL, NULL, '2023-01-05 16:33:42', 0, 1),
(139, 3, 1, NULL, '2023-01-05 16:48:30', 0, 1),
(140, 1, 1, NULL, '2023-01-05 16:48:42', 0, 1),
(141, 1, NULL, 5, '2023-01-05 16:52:23', 0, 1),
(142, 3, NULL, NULL, '2023-01-05 16:52:56', 0, 1),
(143, 1, 1, NULL, '2023-01-05 16:53:26', 0, 1),
(144, 1, 1, NULL, '2023-01-05 16:55:46', 0, 1),
(145, 5, 4, NULL, '2023-01-05 16:56:21', 0, 1),
(146, 1, NULL, NULL, '2023-01-05 16:57:05', 0, 1),
(147, 3, NULL, NULL, '2023-01-05 16:57:28', 0, 1),
(148, 2, 13, NULL, '2023-01-05 16:57:58', 43, 1),
(149, 2, NULL, 5, '2023-01-05 16:59:11', 0, 1),
(150, 1, NULL, NULL, '2023-01-05 17:03:24', 0, 1),
(151, 3, NULL, NULL, '2023-01-05 17:03:33', 43, 1),
(152, 5, 4, NULL, '2023-01-05 17:06:23', 43, 1),
(153, 1, 1, NULL, '2023-01-07 12:48:14', 0, 1),
(154, 5, 4, NULL, '2023-01-07 12:49:21', 0, 1),
(155, 5, 4, NULL, '2023-01-07 12:50:30', 0, 1),
(156, 5, 20, NULL, '2023-01-07 12:51:06', 0, 1),
(157, 5, 20, NULL, '2023-01-07 12:51:42', 0, 1),
(158, 5, 20, NULL, '2023-01-07 12:52:07', 0, 1),
(159, 1, NULL, NULL, '2023-01-07 13:20:13', 0, 1),
(160, 1, 21, 5, '2023-01-07 13:28:36', 128, 1),
(161, 1, 1, 17, '2023-01-07 13:47:08', NULL, 0),
(162, 5, 4, 19, '2023-01-07 13:47:48', NULL, 0),
(163, 5, 20, 28, '2023-01-07 13:47:54', NULL, 0),
(164, 1, 21, 5, '2023-01-12 21:54:52', NULL, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`AdminID`);

--
-- Indexes for table `cars`
--
ALTER TABLE `cars`
  ADD PRIMARY KEY (`CarID`),
  ADD UNIQUE KEY `Vin_number` (`Vin_number`),
  ADD KEY `ModelID` (`ModelID`),
  ADD KEY `cars_ibfk_1` (`ClientID`);

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`ClientID`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`EmployeeID`),
  ADD UNIQUE KEY `CNP` (`CNP`);

--
-- Indexes for table `models`
--
ALTER TABLE `models`
  ADD PRIMARY KEY (`ModelID`);

--
-- Indexes for table `parts`
--
ALTER TABLE `parts`
  ADD PRIMARY KEY (`PartID`),
  ADD KEY `ServiceID` (`ServiceID`),
  ADD KEY `ModelID` (`ModelID`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`ServiceID`);

--
-- Indexes for table `works_performed`
--
ALTER TABLE `works_performed`
  ADD PRIMARY KEY (`WorkID`),
  ADD KEY `ServiciuID` (`ServiceID`),
  ADD KEY `works_performed_ibfk_2` (`EmployeeID`),
  ADD KEY `works_performed_ibfk_3` (`CarID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `AdminID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cars`
--
ALTER TABLE `cars`
  MODIFY `CarID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `ClientID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `EmployeeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `models`
--
ALTER TABLE `models`
  MODIFY `ModelID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `parts`
--
ALTER TABLE `parts`
  MODIFY `PartID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `ServiceID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `works_performed`
--
ALTER TABLE `works_performed`
  MODIFY `WorkID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=165;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cars`
--
ALTER TABLE `cars`
  ADD CONSTRAINT `cars_ibfk_1` FOREIGN KEY (`ClientID`) REFERENCES `clients` (`ClientID`) ON DELETE CASCADE,
  ADD CONSTRAINT `cars_ibfk_2` FOREIGN KEY (`ModelID`) REFERENCES `models` (`ModelID`);

--
-- Constraints for table `parts`
--
ALTER TABLE `parts`
  ADD CONSTRAINT `parts_ibfk_1` FOREIGN KEY (`ServiceID`) REFERENCES `services` (`ServiceID`),
  ADD CONSTRAINT `parts_ibfk_2` FOREIGN KEY (`ModelID`) REFERENCES `models` (`ModelID`);

--
-- Constraints for table `works_performed`
--
ALTER TABLE `works_performed`
  ADD CONSTRAINT `works_performed_ibfk_1` FOREIGN KEY (`ServiceID`) REFERENCES `services` (`ServiceID`),
  ADD CONSTRAINT `works_performed_ibfk_2` FOREIGN KEY (`EmployeeID`) REFERENCES `employees` (`EmployeeID`) ON DELETE SET NULL,
  ADD CONSTRAINT `works_performed_ibfk_3` FOREIGN KEY (`CarID`) REFERENCES `cars` (`CarID`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
