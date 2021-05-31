-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 21, 2020 at 03:13 AM
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
  `trainer_name` char(50) DEFAULT NULL,
  `time_open` varchar(100) NOT NULL,
  `class_size` int(50) DEFAULT NULL,
  `current_class_size` int(11) DEFAULT NULL,
  `category` varchar(100) NOT NULL,
  `image` varchar(500) NOT NULL,
  `email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `class`
--

INSERT INTO `class` (`id`, `name`, `details`, `trainer_name`, `time_open`, `class_size`, `current_class_size`, `category`, `image`, `email`) VALUES
(14, 'fgdgdfg', 'gdfgfg', 'dfgdfgfg', '12313', 21, 21, 'Yoga', 'dfdfgdgdvfg', 'fgvdfgdfgh@fdgd.com'),
(15, 'sdfvgfg', 'gfgvfgh', 'gfgvfgf', '10:30', 21, 20, 'Kick Boxing', 'rfefvergrgvrfgrf', 'fegvdgvfg@gfgrf.com'),
(16, 'fedgvrf', 'hihih', 'hihbih', '20i39', 2, 2, 'Zumba', 'sadwfsd', 'swdesf'),
(17, 'BOxing101', 'scdve', 'bubuj', '10', 11, 1, 'Boxing', 'efcedvfedv', 'vdvv');

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
(1, 'Wicky', 'ffedgfedgve', 'csf'),
(2, 'fgbbh', 'fdggrf', 'images/gym/gym1.jpg'),
(3, 'gbtfhbtg', 'fcvrfg', 'images/gym/gym2.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `trainers`
--

CREATE TABLE `trainers` (
  `id` int(11) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` int(11) NOT NULL,
  `expertise` varchar(50) NOT NULL,
  `images` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `trainers`
--

INSERT INTO `trainers` (`id`, `fname`, `lname`, `email`, `phone`, `expertise`, `images`) VALUES
(1, 'john', 'cena', 'john@gmail.com', 2147483647, 'Zumba Coach', 'images/gym/john.jpg'),
(2, 'wefef', 'cfedfcedf', 'ffefefgeg@dfis.com', 31324, 'ZCoach', 'images/trainers/1.jpg'),
(3, 'dxsfdf', 'Rickybot', 'fdfedg@grfgfr.com', 323424, 'KBCoach', 'images/trainers/2.png'),
(4, 'Rickybottyyy', 'Brain', 'brainrickyboy@ajplol,com', 2147483647, 'Yago Instructor', 'images/trainers/3.png'),
(5, 'Gelnn', 'Pepito', 'glen@gmail.com', 123, 'Zumba Instructor', 'images/trainers/4.jpg'),
(6, 'GLen', 'Sanchez', 'sanchez@gmail.com', 123, 'Boxing Coach', 'images/trainers/4.png'),
(7, 'Ricky ', 'Boy', 'dbsudcbeufb@dwud.com', 1, 'Zumba instructor', 'dswnidxcnfc'),
(8, 'CSDCDECSCD', 'CDVDV', 'VDV DFV FV F', 0, 'CSDC DV ', 'CDCVDV'),
(9, 'Wicky', 'Brain', 'bboy@gmail.com', 123, 'Zumba Coach', 'cefcedfv');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `phone` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `firstname`, `lastname`, `phone`) VALUES
(13, 'Ricky11@outlook.com', 'a5d21a11bdd223f929b7fc8892ed3659fe7b9e521e5d06f3ef5d91a0396403fd', 'Ricky', 'Brain', '123'),
(14, 'Ricky11@gmail.com', 'a5d21a11bdd223f929b7fc8892ed3659fe7b9e521e5d06f3ef5d91a0396403fd', 'Ricky', 'Brain', '123'),
(15, 'jhoe@gmail.com', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 'John', 'Doe', '123'),
(16, 'cedcedv@fef.com', '7dec2beca7530a60223035e5928bc00e68aad71b2288c9afb32784a70ce4e518', 'fdfddvfrvg', 'vgrfvrf', '123'),
(17, 'brainrickyboy@gmail.com', 'd2f483672c0239f6d7dd3c9ecee6deacbcd59185855625902a8b1c1a3bd67440', 'Ricky', 'Brain', '09215569173'),
(18, 'dfefef@fedf.com', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 'Glen', 'Pepito', '123');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `class`
--
ALTER TABLE `class`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cover`
--
ALTER TABLE `cover`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `trainers`
--
ALTER TABLE `trainers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `class`
--
ALTER TABLE `class`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2133;

--
-- AUTO_INCREMENT for table `cover`
--
ALTER TABLE `cover`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `trainers`
--
ALTER TABLE `trainers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
