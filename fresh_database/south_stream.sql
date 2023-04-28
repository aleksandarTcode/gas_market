-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Apr 28, 2023 at 07:13 AM
-- Server version: 5.7.24
-- PHP Version: 8.1.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `south_stream`
--

-- --------------------------------------------------------

--
-- Table structure for table `gas`
--

DROP TABLE IF EXISTS `gas`;
CREATE TABLE IF NOT EXISTS `gas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `country` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `amount` int(11) NOT NULL,
  `price` double NOT NULL,
  `total_price` double NOT NULL,
  `date1` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `gas_ibfk_1` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=86 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `gas`
--

INSERT INTO `gas` (`id`, `country`, `amount`, `price`, `total_price`, `date1`, `user_id`) VALUES
(45, 'Bulgaria', 1255, 2555, 3206525, '2021-03-18 16:12:07', 6),
(47, 'Romania', 2525, 2700, 6817500, '2021-03-17 16:12:47', 6),
(48, 'North Macedonia', 524, 2300, 1205200, '2021-03-15 16:13:00', 6),
(50, 'North Macedonia', 55, 2708, 148940, '2021-03-07 16:13:44', 6),
(51, 'Russia', 10000, 2477, 24770000, '2021-03-17 16:14:03', 6),
(55, 'Russia', 75000, 2800, 210000000, '2021-03-15 16:16:07', 6),
(56, 'Ukraine', 50000, 2855, 142750000, '2021-03-02 16:16:19', 6),
(58, 'Romania', 52000, 3000, 156000000, '2021-03-17 16:17:08', 6),
(75, 'Hungary', 23, 2323, 53429, '2021-03-19 13:04:44', 6),
(79, 'Bulgaria', 100000, 2222, 222200000, '2021-03-18 15:04:09', 6),
(80, 'Ukraine', 100433, 2334, 234410622, '2021-03-19 15:04:25', 6),
(81, 'North Macedonia', 34444, 3222, 110978568, '2021-03-19 15:04:37', 6),
(82, 'Romania', 100000, 2020, 202000000, '2021-03-19 15:04:54', 6),
(83, 'Russia', 50000, 3000, 150000000, '2021-03-18 15:05:52', 6),
(85, 'North Macedonia', 225, 1500, 337500, '2023-04-21 09:08:56', 15);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `first_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `age` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `first_name`, `last_name`, `age`) VALUES
(3, 'jane', '$2y$10$DBnH7FAEbAHljQZAZHrhlO560P7O69.8zbEXykQ/qBhLt7qFGMnX2', 'jane@gmail.com', 'Jane', 'Johnson', 22),
(6, 'marko', '$2y$10$DBnH7FAEbAHljQZAZHrhlO560P7O69.8zbEXykQ/qBhLt7qFGMnX2', 'aleksandar.trmcic@gmail.com', 'Marko', 'Markovic', 30),
(13, 'john', '$2y$10$DBnH7FAEbAHljQZAZHrhlO560P7O69.8zbEXykQ/qBhLt7qFGMnX2', 'john@gmail.com', 'john', 'johnson', 22),
(14, 'trmac', '$2y$10$DBnH7FAEbAHljQZAZHrhlO560P7O69.8zbEXykQ/qBhLt7qFGMnX2', 'aleksandar.trmcic@hotmail.com', 'Aleksandar', 'Trmcic', 32),
(15, 'test', '$2y$10$DBnH7FAEbAHljQZAZHrhlO560P7O69.8zbEXykQ/qBhLt7qFGMnX2', 'test@test.com', 'test', 'test', 22);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `gas`
--
ALTER TABLE `gas`
  ADD CONSTRAINT `gas_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
