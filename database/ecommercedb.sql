-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 02, 2020 at 05:14 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ecommercedb`
--

-- --------------------------------------------------------

--
-- Table structure for table `ecom_admin`
--

CREATE TABLE `ecom_admin` (
  `password` varchar(100) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL DEFAULT 'Crenet Admin'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ecom_admin`
--

INSERT INTO `ecom_admin` (`password`, `phone`, `username`) VALUES
('Admin', '12345', 'Crenet Admin');

-- --------------------------------------------------------

--
-- Table structure for table `ecom_customers`
--

CREATE TABLE `ecom_customers` (
  `id` int(11) NOT NULL,
  `fname` varchar(200) NOT NULL,
  `lname` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `phone` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `gender` varchar(100) NOT NULL,
  `withdrable_money` decimal(10,0) NOT NULL,
  `account_name` varchar(100) NOT NULL,
  `account_number` mediumtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ecom_customers`
--

INSERT INTO `ecom_customers` (`id`, `fname`, `lname`, `email`, `phone`, `password`, `gender`, `withdrable_money`, `account_name`, `account_number`) VALUES
(18, 'Emmy', 'Odoh', 'eodoh37@gmail.com', '07068782597', 'emmyson', 'male', '133000', 'Odoh Emmanuel', '1234567890'),
(20, 'Mathew', 'Ewaoche', 'radicemmy@gmail.com', '08068258134', 'emmy', 'male', '100400', 'emmy bank', '001234');

-- --------------------------------------------------------

--
-- Table structure for table `ecom_customer_wallet`
--

CREATE TABLE `ecom_customer_wallet` (
  `id` int(11) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `amount` varchar(100) NOT NULL,
  `reference` varchar(200) NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ecom_customer_wallet`
--

INSERT INTO `ecom_customer_wallet` (`id`, `firstname`, `lastname`, `amount`, `reference`, `created_on`) VALUES
(159, 'Mathew', 'Ewaoche', '4500', 'PORHKRSVQ4', '2020-08-01 18:04:55'),
(167, 'Mathew', 'Ewaoche', '50000', 'JDMZ6MVW1S', '2020-08-02 01:01:43'),
(168, 'Mathew', 'Ewaoche', '400', '2VMMIQJQ3T', '2020-08-02 01:09:43');

-- --------------------------------------------------------

--
-- Table structure for table `ecom_pages`
--

CREATE TABLE `ecom_pages` (
  `id` int(11) NOT NULL,
  `menu_title` varchar(100) DEFAULT NULL,
  `slug` varchar(100) NOT NULL,
  `title` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ecom_pages`
--

INSERT INTO `ecom_pages` (`id`, `menu_title`, `slug`, `title`) VALUES
(1, 'REGISTER', 'register', 'Register'),
(2, 'LOGIN', 'login', 'Login');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ecom_customers`
--
ALTER TABLE `ecom_customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ecom_customer_wallet`
--
ALTER TABLE `ecom_customer_wallet`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ecom_pages`
--
ALTER TABLE `ecom_pages`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ecom_customers`
--
ALTER TABLE `ecom_customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `ecom_customer_wallet`
--
ALTER TABLE `ecom_customer_wallet`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=169;

--
-- AUTO_INCREMENT for table `ecom_pages`
--
ALTER TABLE `ecom_pages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
