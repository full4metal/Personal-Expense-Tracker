-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Mar 28, 2024 at 04:04 PM
-- Server version: 8.0.31
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `petdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `tblcategory`
--

DROP TABLE IF EXISTS `tblcategory`;
CREATE TABLE IF NOT EXISTS `tblcategory` (
  `categoryid` int NOT NULL AUTO_INCREMENT,
  `categoryname` varchar(300) NOT NULL,
  `userid` int NOT NULL,
  `createdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `limits` decimal(10,0) NOT NULL,
  PRIMARY KEY (`categoryid`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tblcategory`
--

INSERT INTO `tblcategory` (`categoryid`, `categoryname`, `userid`, `createdate`, `limits`) VALUES
(5, 'Rent', 1, '2023-10-16 09:41:31', '10000'),
(2, 'food', 1, '2023-10-01 12:12:24', '20000'),
(3, 'petrol', 1, '2023-10-01 12:14:37', '10000'),
(4, 'Entertainment', 1, '2023-10-16 08:24:51', '5000'),
(6, 'Petrol', 4, '2024-01-16 19:00:08', '10000'),
(7, 'food', 4, '2024-01-16 19:18:46', '10000'),
(9, 'Rent', 4, '2024-01-18 08:00:57', '1000'),
(10, 'petrol', 14, '2024-02-24 17:42:32', '1000'),
(11, 'rent', 14, '2024-02-24 17:42:38', '0'),
(12, 'food', 14, '2024-02-24 17:43:25', '0'),
(13, 'Entertainment', 14, '2024-03-08 15:10:58', '0'),
(14, 'Fuel', 20, '2024-03-09 15:57:26', '500'),
(15, 'Food', 20, '2024-03-09 15:58:46', '500'),
(16, 'Entertainment', 20, '2024-03-09 16:06:00', '1000'),
(17, 'rent', 20, '2024-03-10 13:05:16', '5000'),
(18, 'a', 22, '2024-03-11 05:44:18', '0'),
(19, 'b', 22, '2024-03-11 05:44:24', '0'),
(20, 'c', 22, '2024-03-11 05:44:29', '0');

-- --------------------------------------------------------

--
-- Table structure for table `tblexpense`
--

DROP TABLE IF EXISTS `tblexpense`;
CREATE TABLE IF NOT EXISTS `tblexpense` (
  `id` int NOT NULL AUTO_INCREMENT,
  `userid` int NOT NULL,
  `expensedate` date NOT NULL,
  `categoryid` int NOT NULL,
  `category` varchar(200) NOT NULL,
  `expensecost` varchar(200) NOT NULL,
  `description` varchar(300) NOT NULL,
  `notedate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=105 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tblexpense`
--

INSERT INTO `tblexpense` (`id`, `userid`, `expensedate`, `categoryid`, `category`, `expensecost`, `description`, `notedate`) VALUES
(1, 1, '2023-10-01', 1, 'Rent', '3000', 'Rent for the month ', '2023-10-01 12:06:46'),
(2, 1, '2023-10-02', 2, 'food', '300', 'food ', '2023-10-01 12:13:26'),
(3, 1, '2023-10-01', 3, 'petrol', '500', 'petrol ', '2023-10-01 12:14:45'),
(4, 1, '2023-10-02', 2, 'food', '100', 'biriyani ', '2023-10-03 06:16:44'),
(5, 1, '2023-10-03', 3, 'petrol', '250', 'petrol ', '2023-10-03 06:56:49'),
(42, 1, '2024-01-11', 4, 'Entertainment', '500', 'movie ', '2024-01-11 15:30:43'),
(41, 1, '2024-01-11', 3, 'petrol', '6000', 'aa ', '2024-01-11 09:10:14'),
(20, 1, '2023-10-16', 4, 'Entertainment', '1500', '2 ', '2023-10-16 10:21:00'),
(12, 1, '2023-10-05', 5, 'Rent', '3000', 'rent ', '2023-10-16 09:41:43'),
(32, 1, '2023-10-16', 2, 'food', '300', 'a ', '2023-10-16 10:51:40'),
(33, 1, '2023-10-16', 2, 'food', '300', 'a ', '2023-10-16 10:51:57'),
(35, 1, '2023-10-16', 2, 'food', '500', 'x ', '2023-10-16 10:54:23'),
(36, 1, '2023-10-16', 4, 'Entertainment', '500', 's ', '2023-10-16 10:54:56'),
(21, 1, '2023-10-16', 4, 'Entertainment', '1000', 'racing ', '2023-10-16 10:21:50'),
(37, 1, '2023-10-16', 4, 'Entertainment', '455', 'a ', '2023-10-16 10:55:05'),
(40, 1, '2023-10-14', 2, 'food', '1000', 'food ', '2023-10-25 05:34:20'),
(45, 1, '2024-01-11', 4, 'Entertainment', '200', 'dbd ', '2024-01-11 15:54:48'),
(44, 1, '2023-12-29', 5, 'Rent', '8000', 'r ', '2024-01-11 15:32:00'),
(46, 4, '2024-01-16', 6, 'Petrol', '500', 'a ', '2024-01-16 19:00:17'),
(47, 4, '2024-01-16', 7, 'food', '400', 'breakfast ', '2024-01-16 19:18:56'),
(52, 4, '2024-01-18', 7, 'food', '400', 'g ', '2024-01-18 07:42:27'),
(59, 4, '2024-01-18', 6, 'Petrol', '100', 'k ', '2024-01-18 17:52:01'),
(54, 4, '2024-01-01', 6, 'Petrol', '500', 'mm ', '2024-01-18 07:46:37'),
(55, 4, '2024-01-18', 9, 'Rent', '3000', 'home ', '2024-01-18 08:01:07'),
(60, 4, '2024-01-18', 6, 'Petrol', '200', 'm ', '2024-01-18 17:52:07'),
(57, 4, '2024-01-18', 6, 'Petrol', '600', 'a ', '2024-01-18 17:35:06'),
(58, 4, '2024-01-18', 6, 'Petrol', '200', 'a ', '2024-01-18 17:36:40'),
(61, 4, '2024-01-18', 6, 'Petrol', '400', 'l ', '2024-01-18 17:59:43'),
(64, 14, '2024-02-08', 10, 'petrol', '300', 'petrol ', '2024-02-24 17:42:50'),
(63, 4, '2024-02-17', 6, 'Petrol', '2000', 'adwd ', '2024-02-18 06:12:52'),
(65, 14, '2024-02-24', 12, 'food', '500', 'dinner ', '2024-02-24 17:43:41'),
(66, 14, '2024-02-02', 11, 'rent', '3000', 'rent ', '2024-02-24 17:47:17'),
(67, 14, '2024-02-25', 10, 'petrol', '2500', 'adwd ', '2024-02-25 13:13:32'),
(68, 14, '2024-02-21', 10, 'petrol', '3000', '21545 ', '2024-02-25 13:14:02'),
(69, 14, '2024-02-25', 10, 'petrol', '1000', 'dsf ', '2024-02-25 13:16:33'),
(70, 14, '2024-03-04', 10, 'petrol', '200', 'petrol ', '2024-03-05 14:44:40'),
(71, 14, '2024-03-08', 12, 'food', '400', 'dinner ', '2024-03-08 15:08:58'),
(72, 14, '2024-02-15', 10, 'petrol', '300', 'hbhj ', '2024-03-08 15:10:02'),
(73, 14, '2024-02-05', 13, 'Entertainment', '400', 'movie ', '2024-03-08 15:11:14'),
(74, 14, '2024-03-01', 13, 'Entertainment', '100', 'movie ', '2024-03-08 15:11:51'),
(75, 14, '2024-03-08', 13, 'Entertainment', '500', 'movie ', '2024-03-08 15:38:32'),
(76, 14, '2024-03-08', 13, 'Entertainment', '100', 'jj ', '2024-03-08 15:41:43'),
(77, 14, '2024-03-08', 13, 'Entertainment', '100', 'kk ', '2024-03-08 15:42:06'),
(78, 14, '2024-03-08', 10, 'petrol', '100', 'j ', '2024-03-08 15:44:56'),
(79, 14, '2024-03-08', 10, 'petrol', '100', 'j ', '2024-03-08 15:53:35'),
(80, 14, '2024-03-08', 10, 'petrol', '100', 'j ', '2024-03-08 15:53:40'),
(81, 14, '2024-03-09', 10, 'petrol', '100', 'kmkj ', '2024-03-08 15:54:00'),
(82, 14, '2024-03-08', 10, 'petrol', '500', 'mjij ', '2024-03-08 15:54:26'),
(99, 20, '2024-03-02', 15, 'Food', '250', 'breakfast ', '2024-03-10 13:04:33'),
(96, 20, '2024-03-10', 14, 'Fuel', '400', 'jjj', '2024-03-10 12:07:46'),
(97, 20, '2024-03-10', 16, 'Entertainment', '200', 'a ', '2024-03-10 12:07:52'),
(98, 20, '2024-03-06', 16, 'Entertainment', '450', 'game', '2024-03-10 13:03:27'),
(100, 20, '2024-03-01', 17, 'rent', '3000', 'rent ', '2024-03-10 13:05:29'),
(101, 20, '2024-03-10', 14, 'Fuel', '200', 'sad ', '2024-03-10 13:33:44'),
(102, 22, '2024-03-11', 18, 'a', '100', 'dcd ', '2024-03-11 05:45:28'),
(103, 22, '2024-03-11', 19, 'b', '200', 'ewd ', '2024-03-11 05:45:43'),
(104, 22, '2024-03-11', 20, 'c', '300', 'dcdfgg ', '2024-03-11 05:45:53');

-- --------------------------------------------------------

--
-- Table structure for table `tblincome`
--

DROP TABLE IF EXISTS `tblincome`;
CREATE TABLE IF NOT EXISTS `tblincome` (
  `id` int NOT NULL AUTO_INCREMENT,
  `userid` int NOT NULL,
  `incomedate` date NOT NULL,
  `description` varchar(100) NOT NULL,
  `incomeamount` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tblincome`
--

INSERT INTO `tblincome` (`id`, `userid`, `incomedate`, `description`, `incomeamount`) VALUES
(23, 20, '2024-02-09', 'salary ', 30000),
(22, 20, '2024-03-01', 'salary ', 30000),
(20, 14, '2024-02-01', 'salary ', 50000),
(17, 4, '2024-02-18', 'salary ', 50000),
(21, 14, '2024-03-01', 'salary ', 25000),
(24, 20, '2024-03-04', 'Trading ', 5000);

-- --------------------------------------------------------

--
-- Table structure for table `tbluser`
--

DROP TABLE IF EXISTS `tbluser`;
CREATE TABLE IF NOT EXISTS `tbluser` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(150) NOT NULL,
  `email` varchar(150) NOT NULL,
  `password` varchar(200) NOT NULL,
  `regdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
