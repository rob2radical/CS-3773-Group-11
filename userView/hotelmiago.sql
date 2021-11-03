-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 03, 2021 at 02:39 AM
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
  `hotelName` varchar(100) NOT NULL,
  `amenity` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `amenities`
--

INSERT INTO `amenities` (`id`, `hotelId`, `hotelName`, `amenity`) VALUES
(1, 7, 'The Magnolia All Suites', 'Pool'),
(2, 7, 'The Magnolia All Suites', 'Gym'),
(3, 7, 'The Magnolia All Suites', 'Spa'),
(4, 7, 'The Magnolia All Suites', 'Business Office'),
(5, 6, 'The Lofts at Town Centre', 'Pool'),
(6, 6, 'The Lofts at Town Centre', 'Gym'),
(7, 6, 'The Lofts at Town Centre', 'Business Office'),
(8, 1, 'Park North Hotel', 'Pool'),
(9, 1, 'Park North Hotel', 'Gym'),
(10, 5, 'The Courtyard Suites', 'Pool'),
(11, 5, 'The Courtyard Suites', 'Gym'),
(12, 5, 'The Courtyard Suites', 'Spa'),
(13, 5, 'The Courtyard Suites', 'Business Office'),
(14, 9, 'Town Inn Budget Rooms', 'Pool'),
(15, 8, 'The Regency Rooms', 'Pool'),
(16, 8, 'The Regency Rooms', 'Gym'),
(17, 8, 'The Regency Rooms', 'Spa'),
(18, 8, 'The Regency Rooms', 'Business Office'),
(19, 3, 'Sun Palace Inn', 'Pool'),
(20, 3, 'Sun Palace Inn', 'Gym'),
(21, 0, 'HomeAway Inn', 'Pool'),
(22, 0, 'HomeAway Inn', 'Business Office'),
(23, 2, 'Rio Inn', 'Pool');

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
  `standardPrice` double NOT NULL,
  `queenPrice` double DEFAULT NULL,
  `kingPrice` double DEFAULT NULL,
  `weekendDiff` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `hotels`
--

INSERT INTO `hotels` (`hotelId`, `hotelName`, `numRoomS`, `numRoomQ`, `numRoomK`, `standardPrice`, `queenPrice`, `kingPrice`, `weekendDiff`) VALUES
(0, 'HomeAway Inn', 30, NULL, NULL, 50, NULL, NULL, 0.25),
(1, 'Park North Hotel', 50, 30, 20, 50, 75, 90, 0.15),
(2, 'Rio Inn', 25, 15, 10, 25, 55, 89, 0.2),
(3, 'Sun Palace Inn', 25, 15, 10, 40, 60, 80, 0.25),
(4, 'The Comfy Motel Place', 25, 25, NULL, 30, 50, NULL, 0.1),
(5, 'The Courtyard Suites', 10, 6, 4, 100, 150, 250, 0.25),
(6, 'The Lofts at Town Centre', 30, 18, 12, 105, 120, 190, 0.35),
(7, 'The Magnolia All Suites', 10, 6, 4, 100, 150, 250, 0.25),
(8, 'The Regency Rooms', 10, 6, 4, 100, 150, 250, 0.25),
(9, 'Town Inn Budget Rooms', 75, 45, 30, 25, 50, 60, 0.15);

-- --------------------------------------------------------

--
-- Table structure for table `reservations`
--

CREATE TABLE `reservations` (
  `usersId` int(100) NOT NULL,
  `hotelName` varchar(100) NOT NULL,
  `roomType` int(100) NOT NULL,
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
(6, 'Danny Monty', 'danielmontaudon909@live.com', '8623242401', 'pooopooo1', '$2y$10$mzcGZaAWmVNL3eAezE.gYuNwBtOhk5Q.NVvK8Z3tUlF3xrD8MArxy', 1);

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
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `usersId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
