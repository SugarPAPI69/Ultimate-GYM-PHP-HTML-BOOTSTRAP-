-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 21, 2020 at 01:14 AM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ultimate`
--

-- --------------------------------------------------------

--
-- Table structure for table `class`
--

CREATE TABLE `class` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `details` varchar(500) NOT NULL,
  `trainer_id` int(11) NOT NULL,
  `time_open` varchar(100) NOT NULL,
  `class_size` int(50) DEFAULT NULL,
  `current_class_size` int(11) DEFAULT NULL,
  `category` varchar(100) NOT NULL,
  `image` varchar(500) NOT NULL,
  `email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `cover`
--

CREATE TABLE `cover` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` varchar(100) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cover`
--

INSERT INTO `cover` (`id`, `title`, `description`, `image`) VALUES
(1, 'GYM', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore ', 'images/gym/gym.jpg'),
(2, 'fgbbh', 'fdggrf', 'images/gym/gym1.jpg'),
(3, 'gbtfhbtg', 'fcvrfg', 'images/gym/gym2.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `customer_payment`
--

CREATE TABLE `customer_payment` (
  `PaymentID` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `PaymentType` enum('Cash','Card') NOT NULL,
  `card_details` int(30) NOT NULL,
  `PaymentDate` date NOT NULL,
  `class_id` int(11) DEFAULT NULL,
  `PaymentRate` decimal(5,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `enrolled`
--

CREATE TABLE `enrolled` (
  `trainer_id` int(11) NOT NULL,
  `id` int(11) DEFAULT NULL,
  `enroll_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `DateClass` date NOT NULL,
  `payment_id` int(11) NOT NULL,
  `active` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `trainers`
--

CREATE TABLE `trainers` (
  `trainer_id` int(11) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` int(11) NOT NULL,
  `expertise` varchar(50) NOT NULL,
  `images` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `Fname` varchar(24) NOT NULL,
  `Lname` varchar(24) NOT NULL,
  `phone` int(11) NOT NULL,
  `email` varchar(32) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `class`
--
ALTER TABLE `class`
  ADD PRIMARY KEY (`id`),
  ADD KEY `CLASS_FK` (`trainer_id`);

--
-- Indexes for table `customer_payment`
--
ALTER TABLE `customer_payment`
  ADD PRIMARY KEY (`PaymentID`),
  ADD KEY `CUSTOMER_PAYMENT_FK` (`user_id`),
  ADD KEY `CUSTOMER_PAYMENT_FK2` (`class_id`);

--
-- Indexes for table `enrolled`
--
ALTER TABLE `enrolled`
  ADD PRIMARY KEY (`enroll_id`),
  ADD KEY `ENROLLED_FK` (`trainer_id`),
  ADD KEY `ENROLLED2_FK` (`user_id`),
  ADD KEY `ENROLLED3_FK` (`id`),
  ADD KEY `payment_id` (`payment_id`);

--
-- Indexes for table `trainers`
--
ALTER TABLE `trainers`
  ADD PRIMARY KEY (`trainer_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `class`
--
ALTER TABLE `class`
  ADD CONSTRAINT `CLASS_FK` FOREIGN KEY (`trainer_id`) REFERENCES `trainers` (`trainer_id`);

--
-- Constraints for table `customer_payment`
--
ALTER TABLE `customer_payment`
  ADD CONSTRAINT `CUSTOMER_PAYMENT_FK` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`),
  ADD CONSTRAINT `CUSTOMER_PAYMENT_FK2` FOREIGN KEY (`class_id`) REFERENCES `class` (`id`);

--
-- Constraints for table `enrolled`
--
ALTER TABLE `enrolled`
  ADD CONSTRAINT `ENROLLED2_FK` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`),
  ADD CONSTRAINT `ENROLLED3_FK` FOREIGN KEY (`id`) REFERENCES `class` (`id`),
  ADD CONSTRAINT `ENROLLED4_KF` FOREIGN KEY (`payment_id`) REFERENCES `customer_payment` (`PaymentID`),
  ADD CONSTRAINT `ENROLLED_FK` FOREIGN KEY (`trainer_id`) REFERENCES `trainers` (`trainer_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
