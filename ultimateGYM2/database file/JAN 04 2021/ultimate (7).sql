-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 04, 2021 at 07:20 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
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
  `curr_Date` datetime NOT NULL,
  `time_open` varchar(100) NOT NULL,
  `class_size` int(50) DEFAULT NULL,
  `current_class_size` int(11) DEFAULT NULL,
  `price` int(6) NOT NULL,
  `intensity_Level` varchar(100) NOT NULL,
  `category` varchar(100) NOT NULL,
  `image` varchar(500) NOT NULL,
  `email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `class`
--

INSERT INTO `class` (`id`, `name`, `details`, `trainer_name`, `curr_Date`, `time_open`, `class_size`, `current_class_size`, `price`, `intensity_Level`, `category`, `image`, `email`) VALUES
(15, 'KICK BOXING', 'gfgvfgh', 'gfgvfgf', '0000-00-00 00:00:00', '10:30', 21, 20, 200, '1', 'Kick Boxing', 'images/categories/kickboxing101.jpg', 'fegvdgvfg@gfgrf.com'),
(16, 'ZUMBA', 'hihih', 'hihbih', '2021-01-05 09:07:20', '4:30 PM', 2, 2, 350, '2', 'Zumba', 'images/categories/zumba1012.jpg', 'swdesf'),
(17, 'BOxing101', 'scdve', 'bubuj', '0000-00-00 00:00:00', '10', 11, 1, 200, '', 'Boxing', 'images/categories/boxing101.jpg', 'vdvv'),
(2133, 'sdf', 'fdg', 'gfgb', '0000-00-00 00:00:00', '21', 2, 2, 0, '', 'Yoga', 'wfdefe', 'fedefdfvr@gfg.com'),
(2134, 'dwsdf', 'fdf', 'vfdg', '0000-00-00 00:00:00', '323', 32, 42, 0, '', 'Yoga', 'fd', 'gfrvf'),
(2135, 'Wicky', 'dsff', 'dvdvdvv', '0000-00-00 00:00:00', '324', 21, 21, 0, '', 'Yoga', 'rgvrfgr', 'frgrgvrgr@gmail.com'),
(2136, 'fefgdg', 'vfvfg', 'gfgfh', '0000-00-00 00:00:00', '32234', 32, 32, 0, '', 'Yoga', 'bfbf', 'vfvf@ff.com'),
(2137, 'Kick Boxing 1201', 'epal', 'Glen Pepito', '0000-00-00 00:00:00', '9:30', 21, 0, 0, '', 'Kick Boxing', 'ffgfggfgf', 'brainrickyo@yahoo.com');

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
(1, 'CARDIO', 'Get Ready to BURN', 'images/gym/gym.jpg'),
(2, 'BICEPS', 'Build arm strength', 'images/gym/gym1.jpg'),
(3, 'DEADLIFT', 'Build core stability and gripping strength', 'images/gym/gym2.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `enrolled`
--

CREATE TABLE `enrolled` (
  `enrolled_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `payment_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `payment_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `card_no` int(50) NOT NULL,
  `card_holderName` varchar(50) NOT NULL,
  `bank_name` varchar(50) NOT NULL,
  `cvv` tinyint(3) NOT NULL,
  `expiry` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
(12, 'John', 'Doe', 'Doe@yahoo.com', 12345, 'Yoga', 'images/trainers/1.jpg'),
(13, 'Arnold', 'Schwarzenegger', 'arn@yahoo.com', 123456789, 'Boxing', 'images/trainers/2.png'),
(14, 'Silvester', 'Stallone', 'rocky@yahoo.com', 92232324, 'Kick Boxing', 'images/trainers/3.png'),
(15, 'Gunnar', 'Peterson', 'gun@yahoo.com', 32435, 'Yoga', 'images/trainers/4.png');

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
(15, 'jhoe@gmail.com', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 'John', 'Doe', '123'),
(16, 'cedcedv@fef.com', '7dec2beca7530a60223035e5928bc00e68aad71b2288c9afb32784a70ce4e518', 'fdfddvfrvg', 'vgrfvrf', '123'),
(17, 'brainrickyboy@gmail.com', 'd2f483672c0239f6d7dd3c9ecee6deacbcd59185855625902a8b1c1a3bd67440', 'Ricky', 'Brain', '09215569173'),
(19, 'rickyboy@yahoo.com', '4a9ca4596692e94f9d2912b06a0d007564a22ee750339a6021c2392149b25d6d', 'Ricky', 'Brain', '1234567'),
(20, 'arnne@yahoo.com', '3ea1e155ad46c87ddf3700ef2d3cbba2a4c6d2dd050ed3531835020302289a19', 'Arnne', 'Fano', '097'),
(21, 'fdbfu@fdf.com', '95d245f3eb25eb695e980c0591c16a4c818e609cd2aac265580749c877848926', 'Rickydd', 'defef', '04304808'),
(22, 'frr354@fef.com', '89aa1e580023722db67646e8149eb246c748e180e34a1cf679ab0b41a416d904', 'fdv', 'fbf', '234'),
(23, 'bra@yahoo.com', '5994471abb01112afcc18159f6cc74b4f511b99806da59b3caf5a9c173cacfc5', 'Ric', 'Bra', '1234');

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
-- Indexes for table `enrolled`
--
ALTER TABLE `enrolled`
  ADD PRIMARY KEY (`enrolled_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `class_id` (`class_id`),
  ADD KEY `payment_id` (`payment_id`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`payment_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `class_id` (`class_id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2138;

--
-- AUTO_INCREMENT for table `cover`
--
ALTER TABLE `cover`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `enrolled`
--
ALTER TABLE `enrolled`
  MODIFY `enrolled_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `trainers`
--
ALTER TABLE `trainers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `enrolled`
--
ALTER TABLE `enrolled`
  ADD CONSTRAINT `FK_class_id_enrolled` FOREIGN KEY (`class_id`) REFERENCES `class` (`id`),
  ADD CONSTRAINT `FK_payment_id_enrolled` FOREIGN KEY (`payment_id`) REFERENCES `payment` (`payment_id`),
  ADD CONSTRAINT `FK_user_id_enrolled` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `payment`
--
ALTER TABLE `payment`
  ADD CONSTRAINT `FK_class_id` FOREIGN KEY (`class_id`) REFERENCES `class` (`id`),
  ADD CONSTRAINT `FK_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
