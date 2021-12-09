-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 13, 2021 at 05:37 PM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 5.6.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `projectdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `airwaybill`
--

CREATE TABLE `airwaybill` (
  `airWaybillNo` int(50) NOT NULL,
  `customerEmail` varchar(50) NOT NULL,
  `staffID` varchar(15) DEFAULT NULL,
  `locationID` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `receiverName` varchar(100) NOT NULL,
  `receiverPhoneNumber` varchar(100) NOT NULL,
  `receiverAddress` varchar(255) NOT NULL,
  `weight` float DEFAULT NULL,
  `totalPrice` decimal(10,1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `airwaybill`
--

INSERT INTO `airwaybill` (`airWaybillNo`, `customerEmail`, `staffID`, `locationID`, `date`, `receiverName`, `receiverPhoneNumber`, `receiverAddress`, `weight`, `totalPrice`) VALUES
(1, 'marcus@gmail.com', 'Mary112', 1, '2021-03-24 08:12:13', 'Peter', '23456454', 'Flat 8, Chates Farm Court, John Street, Brighton', 3.1, '1880.0'),
(3, 'marcus@gmail.com', 'Cheung1', 2, '2021-07-13 14:28:33', 'boris', '1231', 'white house', 5.2, '1750.0'),
(7, 'apple@e.com', NULL, 1, '2021-07-13 15:04:01', 'pear person', '3080', 'MiHoYou', 0, '0.0'),
(8, 'apple@e.com', NULL, 1, '2021-07-13 15:09:42', 'WaterMelon', '2070', 'Kadokawa', 0, '0.0'),
(12, 'marcus@gmail.com', NULL, 1, '2021-07-13 15:20:44', 'strawberry girl', '710', 'Linux', 0, '0.0');

-- --------------------------------------------------------

--
-- Table structure for table `airwaybilldeliveryrecord`
--

CREATE TABLE `airwaybilldeliveryrecord` (
  `airWaybillDeliveryRecordID` int(11) NOT NULL,
  `airWaybillNo` int(50) NOT NULL,
  `deliveryStatusID` int(2) NOT NULL,
  `recordDateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `currentLocation` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `airwaybilldeliveryrecord`
--

INSERT INTO `airwaybilldeliveryrecord` (`airWaybillDeliveryRecordID`, `airWaybillNo`, `deliveryStatusID`, `recordDateTime`, `currentLocation`) VALUES
(1, 1, 1, '2021-03-22 20:36:00', NULL),
(3, 1, 2, '2021-03-23 23:36:00', NULL),
(4, 1, 3, '2021-03-24 09:36:00', 'Hong Kong'),
(5, 1, 3, '2021-03-25 09:36:00', 'Shenzhen'),
(6, 1, 3, '2021-03-26 09:36:00', 'Shanghai'),
(7, 1, 4, '2021-03-27 09:36:00', 'Shanghai'),
(8, 1, 5, '2021-03-28 09:36:00', 'Shanghai'),
(17, 7, 1, '2021-07-13 15:04:01', NULL),
(18, 8, 1, '2021-07-13 15:06:57', 'Hong Kong'),
(19, 3, 1, '2021-07-13 15:09:21', 'hk'),
(20, 3, 2, '2021-07-13 15:11:21', 'lo wu'),
(21, 12, 1, '2021-07-13 15:20:44', 'Hong Kong');

-- --------------------------------------------------------

--
-- Table structure for table `chargetable`
--

CREATE TABLE `chargetable` (
  `chargeID` int(11) NOT NULL,
  `locationID` int(11) NOT NULL,
  `weight` float NOT NULL,
  `rate` decimal(10,1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `chargetable`
--

INSERT INTO `chargetable` (`chargeID`, `locationID`, `weight`, `rate`) VALUES
(1, 1, 1, '150.0'),
(2, 1, 2, '298.0'),
(3, 1, 3, '440.0'),
(4, 1, 4, '586.0'),
(5, 1, 5, '731.0'),
(6, 1, 6, '876.0'),
(7, 1, 7, '1021.0'),
(8, 1, 8, '1166.0'),
(9, 1, 9, '1311.0'),
(10, 1, 10, '1456.0'),
(11, 2, 1, '300.0'),
(12, 2, 2, '590.0'),
(13, 2, 3, '880.0'),
(14, 2, 4, '1170.0'),
(15, 2, 5, '1460.0'),
(16, 2, 6, '1750.0'),
(17, 2, 7, '2040.0'),
(18, 2, 8, '2330.0'),
(19, 2, 9, '2620.0'),
(20, 2, 10, '2910.0'),
(21, 3, 1, '549.0'),
(22, 3, 2, '1096.0'),
(23, 3, 3, '1643.0'),
(24, 3, 4, '2190.0'),
(25, 3, 5, '2737.0'),
(26, 3, 6, '3284.0'),
(27, 3, 7, '3831.0'),
(28, 3, 8, '4378.0'),
(29, 3, 9, '4925.0'),
(30, 3, 10, '5472.0');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `customerEmail` varchar(50) NOT NULL,
  `customerName` varchar(100) NOT NULL,
  `customerPassword` varchar(40) NOT NULL,
  `accountCreationDate` date NOT NULL,
  `phoneNumber` varchar(8) NOT NULL,
  `address` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customerEmail`, `customerName`, `customerPassword`, `accountCreationDate`, `phoneNumber`, `address`) VALUES
('apple@e.com', 'apple man', '1', '2021-07-01', '1080', 'sheung shui'),
('marcus@gmail.com', 'Marcus Cheung Pro', 'a', '2021-03-21', '12345678', '2/F');

-- --------------------------------------------------------

--
-- Table structure for table `deliverystatus`
--

CREATE TABLE `deliverystatus` (
  `deliveryStatusID` int(2) NOT NULL,
  `deliveryStatusName` varchar(255) NOT NULL,
  `deliveryStatusDescription` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `deliverystatus`
--

INSERT INTO `deliverystatus` (`deliveryStatusID`, `deliveryStatusName`, `deliveryStatusDescription`) VALUES
(1, 'Waiting for Confirmation', 'Waiting staff to verify the information'),
(2, 'Confirmed', 'Order is confirmed'),
(3, 'In Transit', 'Means that the parcel is on the way to the destination'),
(4, 'Delivering', 'Means that the deliveryman is sending the parcel to the receiver'),
(5, 'Completed', 'Means that the receiver received the parcel');

-- --------------------------------------------------------

--
-- Table structure for table `location`
--

CREATE TABLE `location` (
  `locationID` int(11) NOT NULL,
  `locationName` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `location`
--

INSERT INTO `location` (`locationID`, `locationName`) VALUES
(1, 'China Shanghai'),
(2, 'Japan'),
(3, 'Australia');

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `staffID` varchar(15) NOT NULL,
  `staffName` varchar(255) NOT NULL,
  `staffPassword` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`staffID`, `staffName`, `staffPassword`) VALUES
('Cheung1', 'Cheung Man', '1'),
('Mary112', 'Mary Chau', 'mary999');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `airwaybill`
--
ALTER TABLE `airwaybill`
  ADD PRIMARY KEY (`airWaybillNo`),
  ADD KEY `FKAirWaybill444828` (`customerEmail`),
  ADD KEY `FKAirWaybill454482` (`staffID`),
  ADD KEY `FKAirWaybill118245` (`locationID`);

--
-- Indexes for table `airwaybilldeliveryrecord`
--
ALTER TABLE `airwaybilldeliveryrecord`
  ADD PRIMARY KEY (`airWaybillDeliveryRecordID`),
  ADD KEY `FKAirWaybill437304` (`deliveryStatusID`),
  ADD KEY `FKAirWaybill115654` (`airWaybillNo`);

--
-- Indexes for table `chargetable`
--
ALTER TABLE `chargetable`
  ADD PRIMARY KEY (`chargeID`),
  ADD KEY `FKChargeTabl634318` (`locationID`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customerEmail`);

--
-- Indexes for table `deliverystatus`
--
ALTER TABLE `deliverystatus`
  ADD PRIMARY KEY (`deliveryStatusID`);

--
-- Indexes for table `location`
--
ALTER TABLE `location`
  ADD PRIMARY KEY (`locationID`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`staffID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `airwaybill`
--
ALTER TABLE `airwaybill`
  MODIFY `airWaybillNo` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `airwaybilldeliveryrecord`
--
ALTER TABLE `airwaybilldeliveryrecord`
  MODIFY `airWaybillDeliveryRecordID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `chargetable`
--
ALTER TABLE `chargetable`
  MODIFY `chargeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `deliverystatus`
--
ALTER TABLE `deliverystatus`
  MODIFY `deliveryStatusID` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `airwaybill`
--
ALTER TABLE `airwaybill`
  ADD CONSTRAINT `FKAirWaybill118245` FOREIGN KEY (`locationID`) REFERENCES `location` (`locationID`),
  ADD CONSTRAINT `FKAirWaybill444828` FOREIGN KEY (`customerEmail`) REFERENCES `customer` (`customerEmail`),
  ADD CONSTRAINT `FKAirWaybill454482` FOREIGN KEY (`staffID`) REFERENCES `staff` (`staffID`);

--
-- Constraints for table `airwaybilldeliveryrecord`
--
ALTER TABLE `airwaybilldeliveryrecord`
  ADD CONSTRAINT `FKAirWaybill115654` FOREIGN KEY (`airWaybillNo`) REFERENCES `airwaybill` (`airWaybillNo`),
  ADD CONSTRAINT `FKAirWaybill437304` FOREIGN KEY (`deliveryStatusID`) REFERENCES `deliverystatus` (`deliveryStatusID`);

--
-- Constraints for table `chargetable`
--
ALTER TABLE `chargetable`
  ADD CONSTRAINT `FKChargeTabl634318` FOREIGN KEY (`locationID`) REFERENCES `location` (`locationID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
