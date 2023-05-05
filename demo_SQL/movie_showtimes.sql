-- phpMyAdmin SQL Dump
-- version 5.1.1deb5ubuntu1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 30, 2023 at 12:16 AM
-- Server version: 10.6.12-MariaDB-0ubuntu0.22.04.1
-- PHP Version: 8.1.2-1ubuntu2.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `Dev_assignment`
--

-- --------------------------------------------------------

--
-- Table structure for table `movie_showtimes`
--

CREATE TABLE `movie_showtimes` (
  `id` int(6) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `discount_rate` decimal(10,2) DEFAULT NULL,
  `start_datetime` datetime NOT NULL,
  `end_datetime` datetime NOT NULL,
  `movie_id` int(6) NOT NULL,
  `available_seat` varchar(255) NOT NULL DEFAULT '[1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31, 32, 33, 34, 35, 36, 37, 38, 39, 40]',
  `status` char(1) NOT NULL DEFAULT 'N'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `movie_showtimes`
--

INSERT INTO `movie_showtimes` (`id`, `name`, `description`, `price`, `discount_rate`, `start_datetime`, `end_datetime`, `movie_id`, `available_seat`, `status`) VALUES
(4, 'Titanic (1977) Replay', '', '25.00', '0.00', '2023-04-29 12:00:00', '2023-04-29 15:00:00', 7, '[1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34,35,36,37,38,39,40]', 'N'),
(5, 'John Wick Chapter 4', '', '50.00', '10.00', '2023-04-30 12:00:00', '2023-04-30 14:00:00', 8, '[1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31, 32, 33, 34, 35, 36, 37, 38, 39, 40]', 'N'),
(6, 'John Wick (2014)', '', '35.00', '25.00', '2023-04-30 15:30:00', '2023-04-30 18:00:00', 9, '[1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31, 32, 33, 34, 35, 36, 37, 38, 39, 40]', 'N'),
(7, 'Star Wars: Episode III (Replay)', '', '50.00', '0.00', '2023-05-01 12:40:00', '2023-05-01 15:10:00', 10, '[1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31, 32, 33, 34, 35, 36, 37, 38, 39, 40]', 'N'),
(8, 'Star Wars: Episode II (Replay)', '', '30.00', '0.00', '2023-05-02 12:10:00', '2023-05-02 03:10:00', 11, '[1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34,35,36,37,38,39,40]', 'N'),
(9, 'Star Wars: Episode I (Replay)', '', '25.00', '0.00', '2023-05-04 12:10:00', '2023-05-03 15:10:00', 12, '[1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31, 32, 33, 34, 35, 36, 37, 38, 39, 40]', 'N');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `movie_showtimes`
--
ALTER TABLE `movie_showtimes`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `movie_showtimes`
--
ALTER TABLE `movie_showtimes`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
