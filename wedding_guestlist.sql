-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 07, 2025 at 05:08 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `wedding_guestlist`
--

-- --------------------------------------------------------

--
-- Table structure for table `guests`
--

CREATE TABLE `guests` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `first_name` varchar(100) DEFAULT NULL,
  `last_name` varchar(100) DEFAULT NULL,
  `family_group` varchar(100) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `rsvp` tinyint(1) DEFAULT NULL,
  `mehendi` tinyint(1) DEFAULT NULL,
  `grah_shanti` tinyint(1) DEFAULT NULL,
  `welcome_party` tinyint(1) DEFAULT NULL,
  `wedding` tinyint(1) DEFAULT NULL,
  `kankotri` tinyint(1) DEFAULT NULL,
  `save_the_date` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `guests`
--

INSERT INTO `guests` (`id`, `user_id`, `first_name`, `last_name`, `family_group`, `address`, `phone`, `email`, `rsvp`, `mehendi`, `grah_shanti`, `welcome_party`, `wedding`, `kankotri`, `save_the_date`) VALUES
(6, 3, 'test1', 'test', 'test family', '123 test dr test, tt 12345', '1234567890', 'test@test.com', 1, 1, 1, 1, 1, 1, 1),
(7, 3, 'test2', 'test', 'test family', '123 test dr test, tt 12345', '1234567890', 'test@test.net', 1, 0, 0, 0, 0, 0, 0),
(8, 3, 'A', 'test', 'letter family', '321 test dr test, AA 43253', '9087654321', 'A@test.org', 0, 1, 0, 0, 0, 0, 0),
(9, 3, 'B', 'test', 'test family', '', '5373489344', 'B@test.gov', 0, 0, 1, 0, 0, 0, 0),
(10, 3, 'C', 'test', 'letter family', '', '4324434323', 'C@test.com', 0, 0, 0, 1, 0, 0, 0),
(11, 3, 'D', 'test', 'letter family', '23 letter dr let, lt 34323', '3434443232', 'D@test.com', 0, 0, 0, 0, 1, 0, 0),
(12, 3, 'E', 'test', 'letter family', '', '2343328089', 'E@test.net', 0, 0, 0, 0, 0, 1, 0),
(13, 3, 'F', 'test', 'letter family', '', '3443569898', 'F@test.com', 0, 0, 0, 0, 0, 0, 1),
(14, 3, 'Z', 'test', '', '', '', '', 0, 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`) VALUES
(3, 'test', '$2y$10$Kfro86HRgyj/8//1wAlIj.ywLFhNOgQXbiiSfW/0/9439IBrbJIp2');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `guests`
--
ALTER TABLE `guests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `guests`
--
ALTER TABLE `guests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `guests`
--
ALTER TABLE `guests`
  ADD CONSTRAINT `guests_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
