-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 05, 2025 at 07:24 PM
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
-- Database: `tile`
--

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `id` int(10) UNSIGNED NOT NULL,
  `fullname` varchar(100) DEFAULT NULL,
  `phoneno` int(10) DEFAULT NULL,
  `email` text DEFAULT NULL,
  `cdate` date DEFAULT NULL,
  `msg` varchar(255) DEFAULT NULL,
  `approval` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`id`, `fullname`, `phoneno`, `email`, `cdate`, `msg`, `approval`) VALUES
(9, 'isuru', 4567890, 'aa@gg.com', '2024-02-29', 'ggg', '');

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `item_id` int(10) UNSIGNED NOT NULL,
  `item_name` varchar(5000) NOT NULL DEFAULT '',
  `item_price` double DEFAULT NULL,
  `item_image` varchar(5000) NOT NULL DEFAULT '',
  `qty` int(11) NOT NULL DEFAULT 0,
  `item_date` date NOT NULL DEFAULT '0000-00-00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`item_id`, `item_name`, `item_price`, `item_image`, `qty`, `item_date`) VALUES
(2, 'MT DD 059A (2x2)', 1750, '9bcbafa04a497ed72119a3662bf0af7c1706246053.png', 49, '2024-01-17'),
(3, 'MT DD 060A (2x2)', 1750, '0fc4b2b5a6ae99a99648ec46fe6618a51706246092.png', 97, '2023-09-16'),
(4, 'MT DD 062A (2x2)', 1750, 'd56670b38d3334143b7f288a0f8dfc3c1706246140.png', 100, '2023-09-16'),
(5, 'MT DD 065A (2x2)', 1750, '3af335674ea28d97457eb1f358f732451706246210.png', 0, '2023-09-16'),
(6, 'MT DD 070A (2x2)', 1750, 'f97d7a09ed5c7ecfdda4b7c84f3a5de61706246238.png', 100, '2023-09-16'),
(7, 'MT DD 072A (2x2)', 1550, 'a4ece65c2a5bd9a12794c88c006698841706246263.png', 100, '2023-09-16'),
(9, 'FD C 028B (2x1)', 850, 'dd0e64216f79c1471a5a66e5c677a3721706248183.png', 99, '2023-09-16'),
(10, 'GC 12 035A (2x1)', 950, '903767be86adb6f550268085a1eb41871706248293.png', 100, '2023-09-16'),
(11, 'GC 12 036A (2x1)', 950, '6e1e20ffc35a56a7b193f8b53f32a8c01706248352.png', 100, '2023-09-16'),
(12, 'GC 12 036B (2x1)', 925, '4772243803d0e121a5b9ba5b517bb5271706248406.png', 100, '2023-09-16'),
(13, 'GC 12 039A (2x1)', 950, '180629e279905164f075eac92336529d1706248492.png', 100, '2023-09-16'),
(14, 'GC 22 591A (2x1)', 950, '01dad45b1515e67ab11ccb75e4eae3d01706248529.png', 100, '2023-09-16'),
(15, 'GC 22 617A (2x1)', 950, '52389a2fbe997b08f068b8c01ec4f61a1706248579.png', 100, '2023-09-16'),
(16, 'DD 319A (2x2)', 1550, '5bde3bc6470d8163a4083bc20da8857d1706248659.png', 100, '2023-09-16'),
(17, 'DD 346C (2x2)', 1550, 'a5fd2f851a1e304588c40bf5e43fa2581706248839.png', 100, '2023-09-16'),
(18, 'DD 476A (2x2)', 1550, '3cfc9ff0fa2336e79dbcfe6ca088ceb61706248907.png', 100, '2023-09-16'),
(19, 'DD 479A (2x2)', 1975, '033680044f33d73366a26dad327455ce1706248956.png', 100, '2023-09-16'),
(20, 'DD 482A (2x2)', 1950, '77533be67ca14cbd530a1da2ede78ce21706248997.png', 100, '2023-09-16'),
(21, 'DD 495B (2x2)', 1750, '3e844c6167eac75e58f99094686dc10f1706249430.png', 100, '2023-09-16'),
(22, 'DD 528B (2x2)', 1350, 'ad386a6baec3aa4b22bab691682651151706249470.png', 100, '2023-09-16'),
(24, 'DD 536A (2x2)', 1550, '257002db7ba4bfbc33f1e64e9664e4581706249652.png', 100, '2023-09-16'),
(26, 'DD 573A 1 (2x2)', 1650, '0457067e80a862311aeacfa42017636d1706249694.png', 100, '2023-09-16'),
(27, 'DD 573A 2 (2x2)', 1650, '7794e93cb0c24fe13944cffd58d4035f1706249726.png', 100, '2023-09-16'),
(28, 'DD 573A 3 (2x2)', 1650, '6d334b68dfb4bf3f1dc2b463cfbed4881706249760.png', 100, '2023-09-16'),
(29, 'DD 573A 4 (2x2)', 1650, '0cae6b4e6a0c7658b5d219cfb3a8e7d61706249797.png', 100, '2023-09-16'),
(30, 'DD 548A (2x2) ', 1550, 'efde53cb075b04c4e0c9bfe9513e40fc1706249831.png', 100, '2023-09-16');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `ID` int(10) UNSIGNED NOT NULL,
  `AdminName` varchar(30) DEFAULT NULL,
  `AdminuserName` varchar(30) DEFAULT NULL,
  `MobileNumber` bigint(11) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Password` varchar(50) NOT NULL,
  `AdminRegdate` timestamp(6) NOT NULL DEFAULT current_timestamp(6) ON UPDATE current_timestamp(6),
  `UserType` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`ID`, `AdminName`, `AdminuserName`, `MobileNumber`, `Email`, `Password`, `AdminRegdate`, `UserType`) VALUES
(8, 'Admin', 'admin', 710852093, 'admin@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', '2025-03-05 18:12:40.698991', 1);

-- --------------------------------------------------------

--
-- Table structure for table `orderdetails`
--

CREATE TABLE `orderdetails` (
  `order_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT 0,
  `order_name` varchar(1000) NOT NULL DEFAULT '',
  `order_price` double NOT NULL DEFAULT 0,
  `order_quantity` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `order_total` double NOT NULL DEFAULT 0,
  `order_status` varchar(45) NOT NULL DEFAULT '',
  `order_date` date NOT NULL DEFAULT '0000-00-00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `orderdetails`
--

INSERT INTO `orderdetails` (`order_id`, `user_id`, `order_name`, `order_price`, `order_quantity`, `order_total`, `order_status`, `order_date`) VALUES
(69, 13, 'MT DD 059A (2x2)', 1750, 1, 1750, 'Ordered', '2025-03-02'),
(70, 13, 'MT DD 060A (2x2)', 1750, 1, 1750, 'Ordered', '2025-03-02'),
(71, 13, 'MT DD 059A (2x2)', 1750, 1, 1750, 'Pending', '2025-03-03'),
(72, 13, 'MT DD 060A (2x2)', 1750, 1, 1750, 'Pending', '2025-03-04'),
(73, 13, 'FD C 028B (2x1)', 850, 1, 850, 'Pending', '2025-03-04'),
(74, 13, 'MT DD 059A (2x2)', 1750, 1, 1750, 'Pending', '2025-03-04');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_email` varchar(1000) NOT NULL,
  `user_password` varchar(1000) NOT NULL,
  `user_firstname` varchar(1000) NOT NULL,
  `user_lastname` varchar(1000) NOT NULL,
  `user_address` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_email`, `user_password`, `user_firstname`, `user_lastname`, `user_address`) VALUES
(13, 'dinithanipunaka333@gmail.com', '1234', 'Dinitha', 'Nipunaka', 'no65, 2nd lane, kanduratasandella,Mailapitiya');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`item_id`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `orderdetails`
--
ALTER TABLE `orderdetails`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `FK_orderdetails_1` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `item_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `orderdetails`
--
ALTER TABLE `orderdetails`
  MODIFY `order_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
