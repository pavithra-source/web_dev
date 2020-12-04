-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 04, 2020 at 10:24 AM
-- Server version: 5.7.24
-- PHP Version: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `blood_bank`
--

-- --------------------------------------------------------

--
-- Table structure for table `bloodgroups`
--

CREATE TABLE `bloodgroups` (
  `id` int(11) NOT NULL,
  `bloodgroup` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bloodgroups`
--

INSERT INTO `bloodgroups` (`id`, `bloodgroup`) VALUES
(1, 'A+'),
(2, 'A-'),
(3, 'AB+'),
(4, 'AB-'),
(5, 'O+'),
(6, 'O-');

-- --------------------------------------------------------

--
-- Table structure for table `hospitalblooddetails`
--

CREATE TABLE `hospitalblooddetails` (
  `id` int(10) NOT NULL,
  `hospitalname` varchar(100) NOT NULL,
  `bloodgroup` varchar(40) NOT NULL,
  `status` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hospitalblooddetails`
--

INSERT INTO `hospitalblooddetails` (`id`, `hospitalname`, `bloodgroup`, `status`) VALUES
(9, 'B', 'B-', 1),
(10, 'C', 'A+', 1),
(11, 'B', 'AB-', 1),
(12, 'B', 'A+', 1),
(13, 'Modi', 'AB+', 1),
(14, 'Modi', 'O-', 1);

-- --------------------------------------------------------

--
-- Table structure for table `hospitalusers`
--

CREATE TABLE `hospitalusers` (
  `id` int(20) NOT NULL,
  `hospitalname` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `updationdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `hospitalusers`
--

INSERT INTO `hospitalusers` (`id`, `hospitalname`, `email`, `password`, `updationdate`) VALUES
(1, 'A', 'asd@gmail.com', 'd41d8cd98f00b204e9800998ecf8427e', '2020-11-28 08:18:46'),
(2, 'B', 'W@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', '2020-11-28 08:20:41'),
(3, 'C', 'test@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', '2020-12-03 05:12:55'),
(4, 'modi', 'modi@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', '2020-12-04 09:40:13');

-- --------------------------------------------------------

--
-- Table structure for table `receiveruser`
--

CREATE TABLE `receiveruser` (
  `id` int(10) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `bloodgroup` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `updationdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `receiveruser`
--

INSERT INTO `receiveruser` (`id`, `username`, `email`, `bloodgroup`, `password`, `updationdate`) VALUES
(1, 'pavithra natarajan', 'test@gmail.com', 'AB+', '827ccb0eea8a706c4c34a16891f84e7b', '2020-11-30 12:55:16'),
(2, 'jancy', 'jancy@gmail.com', 'O-', '827ccb0eea8a706c4c34a16891f84e7b', '2020-12-04 10:06:52');

-- --------------------------------------------------------

--
-- Table structure for table `requestedbloodinfo`
--

CREATE TABLE `requestedbloodinfo` (
  `id` int(10) NOT NULL,
  `username` varchar(100) NOT NULL,
  `bloodgroup` varchar(40) NOT NULL,
  `hospitalname` varchar(100) NOT NULL,
  `status` int(20) NOT NULL,
  `updationdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `requestedbloodinfo`
--

INSERT INTO `requestedbloodinfo` (`id`, `username`, `bloodgroup`, `hospitalname`, `status`, `updationdate`) VALUES
(8, 'pavithra natarajan', 'A+', 'KIMS', 0, '2020-12-02 10:29:17'),
(10, 'pavithra natarajan', 'AB+', 'C', 1, '2020-12-03 08:42:02'),
(11, 'pavithra natarajan', 'AB+', 'B', 1, '2020-12-04 04:56:14'),
(12, 'pavithra natarajan', 'A+', 'B', 1, '2020-12-04 06:35:58'),
(13, 'pavithra natarajan', 'A+', 'KIMS', 1, '2020-12-04 06:36:26'),
(14, 'jancy', 'A+', 'mo', 1, '2020-12-04 10:07:44'),
(15, 'jancy', 'O-', 'Modi', 1, '2020-12-04 10:07:57');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bloodgroups`
--
ALTER TABLE `bloodgroups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hospitalblooddetails`
--
ALTER TABLE `hospitalblooddetails`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hospitalusers`
--
ALTER TABLE `hospitalusers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `receiveruser`
--
ALTER TABLE `receiveruser`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `requestedbloodinfo`
--
ALTER TABLE `requestedbloodinfo`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bloodgroups`
--
ALTER TABLE `bloodgroups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `hospitalblooddetails`
--
ALTER TABLE `hospitalblooddetails`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `hospitalusers`
--
ALTER TABLE `hospitalusers`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `receiveruser`
--
ALTER TABLE `receiveruser`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `requestedbloodinfo`
--
ALTER TABLE `requestedbloodinfo`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
