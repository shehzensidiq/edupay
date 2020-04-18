-- phpMyAdmin SQL Dump
-- version 4.7.6
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 04, 2018 at 12:33 PM
-- Server version: 10.1.29-MariaDB
-- PHP Version: 7.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `edupay`
--

-- --------------------------------------------------------

--
-- Table structure for table `table_admin_edupay`
--

CREATE TABLE `table_admin_edupay` (
  `admin_id` int(11) NOT NULL,
  `admin_name` varchar(1000) NOT NULL,
  `email` varchar(1000) NOT NULL,
  `password` varchar(1000) NOT NULL,
  `dob` date NOT NULL,
  `last_login` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `table_admin_edupay`
--

INSERT INTO `table_admin_edupay` (`admin_id`, `admin_name`, `email`, `password`, `dob`, `last_login`) VALUES
(8, 'admin', 'riy7G9whs1t9TaMiuifNug==', 'RWRlLNb810ZEsV6aOSv/gA==', '0000-00-00', '2018-07-03 22:27:12');

-- --------------------------------------------------------

--
-- Table structure for table `table_admin_faculty`
--

CREATE TABLE `table_admin_faculty` (
  `ad_id` int(11) NOT NULL,
  `ad_name` varchar(100) NOT NULL,
  `ad_email` varchar(10000) NOT NULL,
  `ad_password` varchar(10000) NOT NULL,
  `admin_for` varchar(10000) NOT NULL,
  `dob` date NOT NULL,
  `last_login` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `table_admin_faculty`
--

INSERT INTO `table_admin_faculty` (`ad_id`, `ad_name`, `ad_email`, `ad_password`, `admin_for`, `dob`, `last_login`) VALUES
(7, 'admin', 'riy7G9whs1t9TaMiuifNug==', 'RWRlLNb810ZEsV6aOSv/gA==', 'transport', '2005-02-02', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `table_library`
--

CREATE TABLE `table_library` (
  `Number` bigint(20) NOT NULL,
  `u_id` bigint(20) NOT NULL,
  `bookId` varchar(100) NOT NULL,
  `bookName` varchar(400) NOT NULL,
  `bookAuthor` varchar(400) NOT NULL,
  `statusOfBook` varchar(200) NOT NULL,
  `issueDate` date NOT NULL,
  `returnDate` date NOT NULL,
  `fine` int(11) NOT NULL,
  `fine_status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `table_library`
--

INSERT INTO `table_library` (`Number`, `u_id`, `bookId`, `bookName`, `bookAuthor`, `statusOfBook`, `issueDate`, `returnDate`, `fine`, `fine_status`) VALUES
(3, 1, '12345', 'shehzen sidiq malla', 'asdv', 'Returned', '2018-06-19', '2018-06-19', 15, 'unpaid'),
(4, 1, '12345', 'shehzen sidiq malla', 'asdv', 'Returned', '2018-06-19', '2018-08-19', 0, 'no fine'),
(5, 20, '2345678', 'shehzen sidiq malla', 'sssss', 'pending', '2018-06-19', '2018-08-19', 0, 'no fine'),
(6, 1, '1234567', 'shehzen sidiq malla', 'adfdz', 'pending', '2018-06-19', '2016-06-19', 4000, 'unpaid'),
(7, 1, '1234567', 'shehzen sidiq malla', 'adfdz', 'Returned', '2018-06-19', '2018-08-19', 15, 'unpaid'),
(12, 1, '234567890', 'tfgio', 'ujkgbkopi', 'pending', '2018-06-20', '2018-05-21', 170, 'unpaid'),
(13, 20, '9876543', 'malla', 'malla', 'pending', '2018-06-20', '2018-05-19', 180, 'unpaid'),
(14, 20, '12321', 'fdsa', 'asdfv', 'pending', '2018-06-20', '2017-04-18', 2300, 'unpaid'),
(15, 38, '', '', '', '', '0000-00-00', '0000-00-00', 50, '');

-- --------------------------------------------------------

--
-- Table structure for table `table_routes`
--

CREATE TABLE `table_routes` (
  `route_id` int(11) NOT NULL,
  `stop_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `table_routes`
--

INSERT INTO `table_routes` (`route_id`, `stop_name`) VALUES
(1, 'Delina'),
(2, 'sangrama'),
(3, 'hamrey'),
(4, 'pattan'),
(5, 'singpora'),
(6, 'magam'),
(7, 'hmt'),
(8, 'qamarwari'),
(9, 'seikidafar'),
(10, 'eidgah'),
(11, 'soura'),
(12, '90 feet'),
(13, 'buchpora'),
(14, 'ahmadnagar'),
(15, 'pandach'),
(16, 'nagbal'),
(17, 'gulabbagh'),
(18, 'zukura'),
(19, 'Habak'),
(20, 'university'),
(21, 'bemina'),
(22, 'batamaloo');

-- --------------------------------------------------------

--
-- Table structure for table `table_transport_allot`
--

CREATE TABLE `table_transport_allot` (
  `transport_allot_id` int(11) NOT NULL,
  `u_id` bigint(20) NOT NULL,
  `pick_up` varchar(1000) NOT NULL,
  `vehicle_id` int(11) DEFAULT NULL,
  `statusOfBus` varchar(1000) NOT NULL,
  `fee` int(11) DEFAULT NULL,
  `reg_num` varchar(1000) NOT NULL,
  `allot_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `table_transport_allot`
--

INSERT INTO `table_transport_allot` (`transport_allot_id`, `u_id`, `pick_up`, `vehicle_id`, `statusOfBus`, `fee`, `reg_num`, `allot_date`) VALUES
(2, 48, '90 feet', 5, 'pending', 1800, '12345678', '2018-07-03'),
(4, 51, 'sangrama', 5, 'pending', 1800, '123456789', '2018-07-03'),
(5, 52, 'qamarwari', 4, 'pending', 1800, '4567812345', '2018-07-03'),
(6, 54, 'university', 6, 'pending', 1800, '567890', '2018-07-03');

-- --------------------------------------------------------

--
-- Table structure for table `table_user_edupay`
--

CREATE TABLE `table_user_edupay` (
  `u_id` bigint(20) NOT NULL,
  `userName` varchar(1000) NOT NULL,
  `name` varchar(1000) NOT NULL,
  `email` varchar(1000) NOT NULL,
  `password` varchar(1000) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `reg_num` varchar(1000) NOT NULL,
  `enroll_id` int(100) NOT NULL,
  `course` varchar(100) NOT NULL,
  `semester` varchar(100) NOT NULL,
  `batch` varchar(100) NOT NULL,
  `profile_pic` varchar(1000) NOT NULL,
  `dob` date NOT NULL,
  `status` varchar(100) NOT NULL,
  `date_of_joining` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `last_login` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `table_user_edupay`
--

INSERT INTO `table_user_edupay` (`u_id`, `userName`, `name`, `email`, `password`, `gender`, `reg_num`, `enroll_id`, `course`, `semester`, `batch`, `profile_pic`, `dob`, `status`, `date_of_joining`, `last_login`) VALUES
(48, '', 'nyla manzoor', 'OLpa/FTSYqCnqSxhVoGbVA==', 'uqJcMJufMF7UH4gSPS2b/A==', 'female', '12345678', 2147483647, 'B.Tech', '8', '2014', 'default.png', '0000-00-00', 'Approved', '2018-07-01 15:47:11', '2018-07-01 21:17:11'),
(49, '', 'waseem munawar', 'TWFvKIBpaW+ejwWveCnYwtZe8a4CTDFR97JkY+EQkSo=', 'zXz0/jjXcOIXswzdujhvMA==', 'male', '1234567', 2147483647, 'B.Tech', '8', '2014', 'default.png', '0000-00-00', 'Approved', '2018-06-27 16:40:01', '0000-00-00 00:00:00'),
(50, '', 'yasmeenaa', 'HKMaWDWIrvpRaQaGAY2PTk68ucpFHvk0hD5ZNMhJgvQ=', 'QhywVJ/wCL9s5aoQGpFOng==', 'female', '1234567', 2147483647, 'B.Tech', '8', '2014', 'default.png', '0000-00-00', 'Approved', '2018-06-27 16:40:04', '0000-00-00 00:00:00'),
(51, '', 'shehzen', 'brupRfdh0cJKocGNIkmZTvKxGsjkKw0dCCMdr21FoOc=', 'PAEJBIStJL+8UOLJ5bebeg==', 'male', '123456789', 56789, 'B.Tech', '6', '2012', 'default.png', '0000-00-00', 'Approved', '2018-07-01 15:50:46', '0000-00-00 00:00:00'),
(52, '', 'waseem', 'gP8NS0NYgOHLuQjashsGENZe8a4CTDFR97JkY+EQkSo=', '4qmVBVMZ4kBme4hQB+OiAg==', 'male', '4567812345', 2345689, 'IMBA', '2', '2012', 'default.png', '0000-00-00', 'Approved', '2018-07-02 07:03:33', '0000-00-00 00:00:00'),
(53, '', 'admin', 'riy7G9whs1t9TaMiuifNug==', 'qvvXks/jfgohrYGOZeUZAg==', 'male', '45678', 3456789, 'IMBA', '4', '2013', 'default.png', '0000-00-00', 'Approved', '2018-07-03 13:32:53', '0000-00-00 00:00:00'),
(54, '', 'salma', 'BPEsQLU9PsdRTqEASiZtNQ==', 'KGVpG78g/0a+p6k3NyPDgw==', 'female', '567890', 54321, 'MCA', '3', '2011', 'default.png', '0000-00-00', 'Approved', '2018-07-03 13:34:17', '0000-00-00 00:00:00'),
(55, '', 'abid sefi', 'J/8oQDgZkdj2a5XfgmX5ew==', 'LXjm9km1CVbF+97wte7Idg==', 'male', '0987654098', 23456789, 'MA', '5', '2012', 'default.png', '0000-00-00', 'Approved', '2018-07-04 09:45:37', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `table_vehicle`
--

CREATE TABLE `table_vehicle` (
  `vehicle_id` int(11) NOT NULL,
  `route_num` int(11) NOT NULL,
  `seats` int(11) NOT NULL,
  `reg_num` varchar(1000) NOT NULL,
  `vehicle_type` varchar(1000) NOT NULL,
  `route` varchar(2000) NOT NULL,
  `occupied_seats` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `table_vehicle`
--

INSERT INTO `table_vehicle` (`vehicle_id`, `route_num`, `seats`, `reg_num`, `vehicle_type`, `route`, `occupied_seats`) VALUES
(4, 1, 30, '111mamm111', 'mini_bus', 'Delina,sangrama,90 feet', 1),
(5, 2, 12, 'mskaksd', 'bus', 'QAMARWARI,SOURA,90 feet\r\n', 2),
(6, 3, 10, 'malla', 'van', 'baramula,delina,sangrama,pattann,sgr,soura,nagbal,university', 0),
(7, 35, 60, 'JK01AA4231', 'bus', 'Buchpora,Upper Soura, Soura,Zoonimar,Eidgah, Sikdaphar,Noorbagh,Qamarwari,HMT', 1);

-- --------------------------------------------------------

--
-- Table structure for table `table_wallet_history`
--

CREATE TABLE `table_wallet_history` (
  `wallet_id` bigint(20) NOT NULL,
  `u_id` bigint(20) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `amount` int(11) NOT NULL,
  `statusOfTxn` varchar(1000) NOT NULL,
  `txn_id` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `table_wallet_history`
--

INSERT INTO `table_wallet_history` (`wallet_id`, `u_id`, `date`, `time`, `amount`, `statusOfTxn`, `txn_id`) VALUES
(1, 48, '2018-06-30', '14:53:02', 12222, 'Confirmed', 'kgTVpjpm7iWuUVj8c'),
(2, 48, '2018-06-30', '14:54:18', 2300, 'Confirmed', 'Ig2ACxgWTHLB4gVuc'),
(3, 48, '2018-07-01', '12:40:44', 100, 'Confirmed', 'HcKXGoJQgNobQrSc2');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `table_admin_edupay`
--
ALTER TABLE `table_admin_edupay`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `table_admin_faculty`
--
ALTER TABLE `table_admin_faculty`
  ADD PRIMARY KEY (`ad_id`);

--
-- Indexes for table `table_library`
--
ALTER TABLE `table_library`
  ADD PRIMARY KEY (`Number`);

--
-- Indexes for table `table_routes`
--
ALTER TABLE `table_routes`
  ADD PRIMARY KEY (`route_id`);

--
-- Indexes for table `table_transport_allot`
--
ALTER TABLE `table_transport_allot`
  ADD PRIMARY KEY (`transport_allot_id`);

--
-- Indexes for table `table_user_edupay`
--
ALTER TABLE `table_user_edupay`
  ADD PRIMARY KEY (`u_id`);

--
-- Indexes for table `table_vehicle`
--
ALTER TABLE `table_vehicle`
  ADD PRIMARY KEY (`vehicle_id`);

--
-- Indexes for table `table_wallet_history`
--
ALTER TABLE `table_wallet_history`
  ADD PRIMARY KEY (`wallet_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `table_admin_edupay`
--
ALTER TABLE `table_admin_edupay`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `table_admin_faculty`
--
ALTER TABLE `table_admin_faculty`
  MODIFY `ad_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `table_library`
--
ALTER TABLE `table_library`
  MODIFY `Number` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `table_routes`
--
ALTER TABLE `table_routes`
  MODIFY `route_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `table_transport_allot`
--
ALTER TABLE `table_transport_allot`
  MODIFY `transport_allot_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `table_user_edupay`
--
ALTER TABLE `table_user_edupay`
  MODIFY `u_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `table_vehicle`
--
ALTER TABLE `table_vehicle`
  MODIFY `vehicle_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `table_wallet_history`
--
ALTER TABLE `table_wallet_history`
  MODIFY `wallet_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
