-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 07, 2020 at 11:10 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.2.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `realestate`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_payments`
--

CREATE TABLE `tbl_payments` (
  `id` int(6) UNSIGNED ZEROFILL NOT NULL,
  `building_id` int(11) NOT NULL,
  `unit_id` int(11) NOT NULL,
  `payment_amount` decimal(11,2) NOT NULL,
  `payment_date` datetime NOT NULL,
  `payment_startdate` datetime NOT NULL,
  `payment_enddate` datetime NOT NULL,
  `payment_type` enum('Cash','Transfer','Card','Cheque') NOT NULL,
  `bank_id` int(11) DEFAULT NULL,
  `document_copy` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `status` enum('Active','Deleted') NOT NULL,
  `created_by` varchar(255) NOT NULL,
  `created_on` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_by` varchar(255) NOT NULL,
  `updated_on` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_payments`
--

INSERT INTO `tbl_payments` (`id`, `building_id`, `unit_id`, `payment_amount`, `payment_date`, `payment_startdate`, `payment_enddate`, `payment_type`, `bank_id`, `document_copy`, `description`, `status`, `created_by`, `created_on`, `updated_by`, `updated_on`) VALUES
(000001, 1, 3, '2000.00', '2020-07-07 00:00:00', '2020-07-01 23:54:17', '2020-07-31 23:54:22', 'Cheque', 1, '', 'sd', 'Active', 'Admin', '2020-07-07 22:18:19', 'Admin', '2020-07-07 22:18:19');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_payments`
--
ALTER TABLE `tbl_payments`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_payments`
--
ALTER TABLE `tbl_payments`
  MODIFY `id` int(6) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
