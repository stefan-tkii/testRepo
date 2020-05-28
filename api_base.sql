-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 28, 2020 at 01:24 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.3.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `api_base`
--

-- --------------------------------------------------------

--
-- Table structure for table `makentity`
--

CREATE TABLE `makentity` (
  `Id` int(11) NOT NULL,
  `field` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `userId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `makentity`
--

INSERT INTO `makentity` (`Id`, `field`, `userId`) VALUES
(1, 'adesfghujhg', 3),
(2, 'ewqdas', 3),
(3, 'randomdata', 1);

-- --------------------------------------------------------

--
-- Table structure for table `testfield`
--

CREATE TABLE `testfield` (
  `Id` int(11) NOT NULL,
  `random` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `testfield`
--

INSERT INTO `testfield` (`Id`, `random`) VALUES
(1, 'random text');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `Id` int(11) NOT NULL,
  `firstname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ssid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`Id`, `firstname`, `lastname`, `ssid`) VALUES
(1, 'Mitko', 'Lasa', 5434),
(3, 'Mende', 'Mrza', 3243);

-- --------------------------------------------------------

--
-- Table structure for table `variable`
--

CREATE TABLE `variable` (
  `Id` int(11) NOT NULL,
  `count` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `testfieldId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `variable`
--

INSERT INTO `variable` (`Id`, `count`, `userId`, `testfieldId`) VALUES
(1, 5, 1, 1),
(3, 7, 3, 1),
(4, 2, 3, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `makentity`
--
ALTER TABLE `makentity`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `userId` (`userId`);

--
-- Indexes for table `testfield`
--
ALTER TABLE `testfield`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `variable`
--
ALTER TABLE `variable`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `userId` (`userId`),
  ADD KEY `testfieldId` (`testfieldId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `makentity`
--
ALTER TABLE `makentity`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `testfield`
--
ALTER TABLE `testfield`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `variable`
--
ALTER TABLE `variable`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `makentity`
--
ALTER TABLE `makentity`
  ADD CONSTRAINT `makentity_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `user` (`Id`);

--
-- Constraints for table `variable`
--
ALTER TABLE `variable`
  ADD CONSTRAINT `variable_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `user` (`Id`),
  ADD CONSTRAINT `variable_ibfk_2` FOREIGN KEY (`testfieldId`) REFERENCES `testfield` (`Id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
