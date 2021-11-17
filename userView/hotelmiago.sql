-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 17, 2021 at 02:35 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hotelmiago`
--

-- --------------------------------------------------------

--
-- Table structure for table `amenities`
--

CREATE TABLE `amenities` (
  `id` int(100) NOT NULL,
  `hotelId` int(100) NOT NULL,
  `amenity` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `amenities`
--

INSERT INTO `amenities` (`id`, `hotelId`, `amenity`) VALUES
(1, 8, 'Pool'),
(2, 8, 'Gym'),
(3, 8, 'Spa'),
(4, 8, 'Business Office'),
(5, 7, 'Pool'),
(6, 7, 'Gym'),
(7, 7, 'Business Office'),
(8, 2, 'Pool'),
(9, 2, 'Gym'),
(10, 6, 'Pool'),
(11, 6, 'Gym'),
(12, 6, 'Spa'),
(13, 6, 'Business Office'),
(14, 10, 'Pool'),
(15, 9, 'Pool'),
(16, 9, 'Gym'),
(17, 9, 'Spa'),
(18, 9, 'Business Office'),
(19, 4, 'Pool'),
(20, 4, 'Gym'),
(21, 1, 'Pool'),
(22, 1, 'Business Office'),
(23, 3, 'Pool');

-- --------------------------------------------------------

--
-- Table structure for table `hotels`
--

CREATE TABLE `hotels` (
  `hotelId` int(100) NOT NULL,
  `hotelName` varchar(50) NOT NULL,
  `numRoomS` int(100) NOT NULL,
  `numRoomQ` int(100) DEFAULT NULL,
  `numRoomK` int(100) DEFAULT NULL,
  `standardPrice` float NOT NULL,
  `queenPrice` float DEFAULT NULL,
  `kingPrice` float DEFAULT NULL,
  `weekendDiff` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `hotels`
--

INSERT INTO `hotels` (`hotelId`, `hotelName`, `numRoomS`, `numRoomQ`, `numRoomK`, `standardPrice`, `queenPrice`, `kingPrice`, `weekendDiff`) VALUES
(1, 'HomeAway Inn', 30, NULL, NULL, 50, NULL, NULL, 0.25),
(2, 'Park North Hotel', 50, 30, 20, 50, 75, 90, 0.15),
(3, 'Rio Inn', 25, 15, 10, 25, 55, 89, 0.2),
(4, 'Sun Palace Inn', 25, 15, 10, 40, 60, 80, 0.25),
(5, 'The Comfy Motel Place', 25, 25, NULL, 30, 50, NULL, 0.1),
(6, 'The Courtyard Suites', 10, 6, 4, 100, 150, 250, 0.25),
(7, 'The Lofts at Town Centre', 30, 18, 12, 105, 120, 190, 0.35),
(8, 'The Magnolia All Suites', 10, 6, 4, 100, 150, 250, 0.25),
(9, 'The Regency Rooms', 10, 6, 4, 100, 150, 250, 0.25),
(10, 'Town Inn Budget Rooms', 75, 45, 30, 25, 50, 60, 0.15),
(22, 'Test 1', 10, 5, 10, 10, 30, 50, 0.5);

-- --------------------------------------------------------

--
-- Table structure for table `reservations`
--

CREATE TABLE `reservations` (
  `resId` int(11) NOT NULL,
  `usersId` int(100) NOT NULL,
  `hotelName` varchar(100) NOT NULL,
  `roomType` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `phoneNum` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `totalPrice` double NOT NULL,
  `fromDate` date NOT NULL,
  `toDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `usersId` int(11) NOT NULL,
  `usersName` varchar(128) NOT NULL,
  `usersEmail` varchar(128) NOT NULL,
  `usersPhone` varchar(10) NOT NULL,
  `usersUid` varchar(128) NOT NULL,
  `usersPwd` varchar(128) NOT NULL,
  `isAdmin` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`usersId`, `usersName`, `usersEmail`, `usersPhone`, `usersUid`, `usersPwd`, `isAdmin`) VALUES
(1, 'Robert Quintanilla', 'qrobert@rocketmail.com', '9152471933', 'rob2radical', '$2y$10$i4RuORwBpiCzKGo257WveuVb6Rdz.W/vdrUQ1PBeBWfHiqs0nokcm', 0),
(2, 'Rogelio Myres', 'myres555@gmail.com', '5555555555', 'quickchecks', '$2y$10$il0EU0dxJGuBSGm19U/5HOffpil3Q7FqBFoUyZx8ZWHM3uQTarXHO', 0),
(3, 'course', 'dragonz4twenty@gmail.com', '5555555555', 'bruh', '$2y$10$qYgpmKxHHdi8gYxH3ZadEeKxJTI5ZM2eXhB6ZjFwX8DAwRMEpLli2', 1),
(4, 'Juan Rodriguez', 'qsy775@my.utsa.edu', '1234567899', 'meatman', '$2y$10$AKrOPfHj8Cqvdk0iqL1HZeucaOyTwdig.BxSsFBBsKdzj78knQvtS', NULL),
(5, 'Amber Sanchez', 'lovelylibra55@gmail.com', '2105361729', 'cashmoney', '$2y$10$ZpI3tEsqhuxAcDacs3SgquML03HvxYc.9Gl13mg/nHAyvJlPw4U8q', NULL),
(6, 'Dan Dan', 'danielmontaudon909@live.com', '8623242401', 'pooopooo', '$2y$10$mzcGZaAWmVNL3eAezE.gYuNwBtOhk5Q.NVvK8Z3tUlF3xrD8MArxy', 1),
(7, 'Daniel Ricardo Blom Montaudon', 'danielmontaudon909@live.com', '1234561234', 'yeah', '$2y$10$kyUCceXe0k402U/GQ3yiaOyzohmw0Yf7TpPfGSbRz4ar9G1cs7.Ua', NULL),
(8, 'Daniel Ricardo Blom Montaudon', 'danielmontaudon@live.com', '8623242401', 'yum', '$2y$10$GGLj/0rPkUcYozGCI41G3..G2/.EJgjtwE2d7NQvmQjCxwkEcGHcq', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `amenities`
--
ALTER TABLE `amenities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hotels`
--
ALTER TABLE `hotels`
  ADD PRIMARY KEY (`hotelId`);

--
-- Indexes for table `reservations`
--
ALTER TABLE `reservations`
  ADD PRIMARY KEY (`resId`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`usersId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `amenities`
--
ALTER TABLE `amenities`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `hotels`
--
ALTER TABLE `hotels`
  MODIFY `hotelId` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `reservations`
--
ALTER TABLE `reservations`
  MODIFY `resId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `usersId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
