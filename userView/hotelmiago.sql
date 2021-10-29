-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 29, 2021 at 09:18 PM
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
  `hotelName` varchar(100) NOT NULL,
  `amenity` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `amenities`
--

INSERT INTO `amenities` (`hotelName`, `amenity`) VALUES
('The Magnolia All Suites', 'Pool'),
('The Magnolia All Suites', 'Gym'),
('The Magnolia All Suites', 'Spa'),
('The Magnolia All Suites', 'Business Office'),
('The Lofts at Town Centre', 'Pool'),
('The Lofts at Town Centre', 'Gym'),
('The Lofts at Town Centre', 'Business Office'),
('Park North Hotel', 'Pool'),
('Park North Hotel', 'Gym'),
('The Courtyard Suites', 'Pool'),
('The Courtyard Suites', 'Gym'),
('The Courtyard Suites', 'Spa'),
('The Courtyard Suites', 'Business Office'),
('Town Inn Budget Rooms', 'Pool'),
('The Regency Rooms', 'Pool'),
('The Regency Rooms', 'Gym'),
('The Regency Rooms', 'Spa'),
('The Regency Rooms', 'Business Office'),
('Sun Palace Inn', 'Pool'),
('Sun Palace Inn', 'Gym'),
('HomeAway Inn', 'Pool'),
('HomeAway Inn', 'Business Office'),
('Rio Inn', 'Pool');

-- --------------------------------------------------------

--
-- Table structure for table `hotels`
--

CREATE TABLE `hotels` (
  `hotelName` varchar(50) NOT NULL,
  `numRoomS` int(100) NOT NULL,
  `numRoomQ` int(100) NOT NULL,
  `numRoomK` int(100) NOT NULL,
  `standardPrice` double NOT NULL,
  `queenPrice` double NOT NULL,
  `kingPrice` double NOT NULL,
  `weekendDiff` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `hotels`
--

INSERT INTO `hotels` (`hotelName`, `numRoomS`, `numRoomQ`, `numRoomK`, `standardPrice`, `queenPrice`, `kingPrice`, `weekendDiff`) VALUES
('HomeAway Inn', 30, 0, 0, 50, 0, 0, 0.25),
('Park North Hotel', 50, 30, 20, 50, 75, 90, 0.15),
('Rio Inn', 25, 15, 10, 25, 55, 89, 0.2),
('Sun Palace Inn', 25, 15, 10, 40, 60, 80, 0.25),
('The Comfy Motel Place', 25, 25, 0, 30, 50, 0, 0.1),
('The Courtyard Suites', 10, 6, 4, 100, 150, 250, 0.25),
('The Lofts at Town Centre', 30, 18, 12, 105, 120, 190, 0.35),
('The Magnolia All Suites', 10, 6, 4, 100, 150, 250, 0.25),
('The Regency Rooms', 10, 6, 4, 100, 150, 250, 0.25),
('Town Inn Budget Rooms', 75, 45, 30, 25, 50, 60, 0.15);

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
-- Indexes for table `hotels`
--
ALTER TABLE `hotels`
  ADD PRIMARY KEY (`hotelName`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`usersId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `usersId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
