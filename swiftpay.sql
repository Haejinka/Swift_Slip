-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 02, 2023 at 01:39 PM
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
-- Database: `swiftpay`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `userAdmin` varchar(50) NOT NULL,
  `passAdmin` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`userAdmin`, `passAdmin`) VALUES
('Hazel', 'password'),
('rhey', 'rhey'),
('arzey', 'admin'),
('Hazel', 'password'),
('rhey', 'rhey'),
('arzey', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `archive_attendance`
--

CREATE TABLE `archive_attendance` (
  `attendance_id` int(11) NOT NULL,
  `employee_id` int(11) DEFAULT NULL,
  `time_in` datetime DEFAULT NULL,
  `time_out` datetime DEFAULT NULL,
  `hours_worked` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `archive_attendance`
--

INSERT INTO `archive_attendance` (`attendance_id`, `employee_id`, `time_in`, `time_out`, `hours_worked`) VALUES
(27, 10007, '2023-09-02 18:55:00', '2023-09-02 12:55:00', -6.00),
(30, 10007, '2023-09-02 19:33:00', '2023-09-02 23:33:00', 4.00);

-- --------------------------------------------------------

--
-- Table structure for table `archive_payroll`
--

CREATE TABLE `archive_payroll` (
  `parc_id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `pay_term` varchar(20) NOT NULL,
  `hours_worked` decimal(10,2) NOT NULL,
  `hourly_rate` decimal(10,2) NOT NULL,
  `deduction_id` int(11) NOT NULL,
  `net_pay` decimal(10,2) NOT NULL,
  `gross_pay` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `attendance_id` int(11) NOT NULL,
  `employee_id` int(11) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `time_in` datetime DEFAULT NULL,
  `time_out` datetime DEFAULT NULL,
  `hours_worked` decimal(10,2) GENERATED ALWAYS AS (time_to_sec(timediff(`time_out`,`time_in`)) / 3600) STORED
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`attendance_id`, `employee_id`, `date`, `time_in`, `time_out`) VALUES
(100060, 10007, NULL, '2023-09-02 19:09:00', '2023-09-02 22:09:00'),
(100061, 10021, NULL, '2023-09-02 19:11:00', '2023-09-04 19:11:00');

-- --------------------------------------------------------

--
-- Table structure for table `deductions`
--

CREATE TABLE `deductions` (
  `deduction_id` int(11) NOT NULL,
  `deduction_name` varchar(255) DEFAULT NULL,
  `deduction_amount` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `deductions`
--

INSERT INTO `deductions` (`deduction_id`, `deduction_name`, `deduction_amount`) VALUES
(1615, 'Tax', 0.10),
(1621, 'Pag-ibig', 0.08),
(1622, 'Insurance', 0.15),
(1623, 'Philhealth', 0.20);

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `department_id` int(11) NOT NULL,
  `department_name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`department_id`, `department_name`) VALUES
(100006, 'IT'),
(100007, 'MARKETING'),
(100008, 'DENTISTRY'),
(100009, 'MEDTECH'),
(100010, 'NURSING'),
(100011, 'SD+C'),
(100012, 'VETMED'),
(100013, 'PATHOLOGY');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `employee_id` int(11) NOT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `hire_date` date DEFAULT NULL,
  `position_id` int(11) DEFAULT NULL,
  `department_id` int(11) DEFAULT NULL,
  `jobstatus_id` int(11) NOT NULL,
  `deduction_id` int(11) NOT NULL,
  `password` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`employee_id`, `first_name`, `last_name`, `hire_date`, `position_id`, `department_id`, `jobstatus_id`, `deduction_id`, `password`) VALUES
(10006, 'Evon', 'Vergara', '2023-08-29', 2016, 100011, 3016, 1622, 'evon123'),
(10007, 'Raven', 'de Leon', '2023-08-29', 2009, 100009, 3017, 1621, 'raven123'),
(10008, 'Desiree', 'Cendana', '2023-08-29', 2011, 100006, 3016, 1615, 'desiree123'),
(10009, 'Relgin', 'Paloma', '2020-01-30', 2012, 100013, 3016, 1621, 'relgin123'),
(10017, 'Justin', 'Comendador', '2023-08-31', 2013, 100007, 3016, 1622, 'test'),
(10018, 'Romnick', 'Hershel', '2019-05-31', 2014, 100008, 3016, 1621, 'romnick123'),
(10019, 'Harvey', 'de Gracia', '2022-05-31', 2015, 100012, 3016, 1615, 'harvey123'),
(10020, 'Arzey', 'Nepomuceno', '2021-02-28', 2013, 100010, 3016, 1623, 'arzey123'),
(10021, 'Desiree', 'Cendana1', '2023-09-01', 2011, 100006, 3016, 1621, 'swu123');

-- --------------------------------------------------------

--
-- Table structure for table `employee_accounts`
--

CREATE TABLE `employee_accounts` (
  `acc_id` int(11) NOT NULL,
  `employee_id` int(11) DEFAULT NULL,
  `employee_username` varchar(255) DEFAULT NULL,
  `employee_password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employee_accounts`
--

INSERT INTO `employee_accounts` (`acc_id`, `employee_id`, `employee_username`, `employee_password`) VALUES
(1024, 10007, 'Raven', 'password1');

-- --------------------------------------------------------

--
-- Table structure for table `jobposition`
--

CREATE TABLE `jobposition` (
  `position_id` int(11) NOT NULL,
  `position_name` varchar(255) DEFAULT NULL,
  `hourly_rate` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jobposition`
--

INSERT INTO `jobposition` (`position_id`, `position_name`, `hourly_rate`) VALUES
(2009, 'Manager', 100.00),
(2010, 'Secretary', 90.00),
(2011, 'CEO', 1000.00),
(2012, 'COO', 800.00),
(2013, 'Executive Officer', 200.00),
(2014, 'CFO', 500.00),
(2015, 'CMO', 500.00),
(2016, 'CTO', 500.00),
(2017, 'President', 2000.00);

-- --------------------------------------------------------

--
-- Table structure for table `jobstatus`
--

CREATE TABLE `jobstatus` (
  `jobstatus_id` int(11) NOT NULL,
  `jobstatus_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jobstatus`
--

INSERT INTO `jobstatus` (`jobstatus_id`, `jobstatus_name`) VALUES
(3016, 'Active'),
(3017, 'On Leave');

-- --------------------------------------------------------

--
-- Table structure for table `payroll`
--

CREATE TABLE `payroll` (
  `payroll_id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `pay_term` varchar(20) NOT NULL,
  `hours_worked` decimal(10,2) DEFAULT NULL,
  `hourly_rate` decimal(10,2) DEFAULT NULL,
  `deduction_id` int(11) NOT NULL,
  `net_pay` decimal(10,2) DEFAULT NULL,
  `gross_pay` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payroll`
--

INSERT INTO `payroll` (`payroll_id`, `employee_id`, `pay_term`, `hours_worked`, `hourly_rate`, `deduction_id`, `net_pay`, `gross_pay`) VALUES
(202409, 10021, 'FIRST HALF', 60.00, 1000.00, 1615, 54000.00, 60000.00),
(202410, 10021, 'SECOND HALF', 60.00, 1000.00, 1621, 55200.00, 60000.00);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `archive_attendance`
--
ALTER TABLE `archive_attendance`
  ADD PRIMARY KEY (`attendance_id`);

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`attendance_id`),
  ADD KEY `attendance_ibfk_1` (`employee_id`);

--
-- Indexes for table `deductions`
--
ALTER TABLE `deductions`
  ADD PRIMARY KEY (`deduction_id`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`department_id`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`employee_id`),
  ADD KEY `employee_ibfk_1` (`position_id`),
  ADD KEY `employee_ibfk_3` (`jobstatus_id`),
  ADD KEY `employee_ibfk_2` (`department_id`);

--
-- Indexes for table `employee_accounts`
--
ALTER TABLE `employee_accounts`
  ADD PRIMARY KEY (`acc_id`),
  ADD KEY `employee_accounts_ibfk_1` (`employee_id`);

--
-- Indexes for table `jobposition`
--
ALTER TABLE `jobposition`
  ADD PRIMARY KEY (`position_id`);

--
-- Indexes for table `jobstatus`
--
ALTER TABLE `jobstatus`
  ADD PRIMARY KEY (`jobstatus_id`);

--
-- Indexes for table `payroll`
--
ALTER TABLE `payroll`
  ADD PRIMARY KEY (`payroll_id`),
  ADD KEY `employee_id_fk` (`employee_id`),
  ADD KEY `deduction_id_fk_1` (`deduction_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `archive_attendance`
--
ALTER TABLE `archive_attendance`
  MODIFY `attendance_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `attendance_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100063;

--
-- AUTO_INCREMENT for table `deductions`
--
ALTER TABLE `deductions`
  MODIFY `deduction_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1624;

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `department_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100014;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `employee_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10022;

--
-- AUTO_INCREMENT for table `jobposition`
--
ALTER TABLE `jobposition`
  MODIFY `position_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2018;

--
-- AUTO_INCREMENT for table `jobstatus`
--
ALTER TABLE `jobstatus`
  MODIFY `jobstatus_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3018;

--
-- AUTO_INCREMENT for table `payroll`
--
ALTER TABLE `payroll`
  MODIFY `payroll_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=202411;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `attendance`
--
ALTER TABLE `attendance`
  ADD CONSTRAINT `attendance_ibfk_1` FOREIGN KEY (`employee_id`) REFERENCES `employee` (`employee_id`);

--
-- Constraints for table `employee`
--
ALTER TABLE `employee`
  ADD CONSTRAINT `employee_ibfk_1` FOREIGN KEY (`position_id`) REFERENCES `jobposition` (`position_id`),
  ADD CONSTRAINT `employee_ibfk_2` FOREIGN KEY (`department_id`) REFERENCES `department` (`department_id`),
  ADD CONSTRAINT `employee_ibfk_3` FOREIGN KEY (`jobstatus_id`) REFERENCES `jobstatus` (`jobstatus_id`);

--
-- Constraints for table `employee_accounts`
--
ALTER TABLE `employee_accounts`
  ADD CONSTRAINT `employee_accounts_ibfk_1` FOREIGN KEY (`employee_id`) REFERENCES `employee` (`employee_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
