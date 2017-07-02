-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 14, 2017 at 10:26 PM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 7.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `messenger`
--
USE `messenger`;
-- --------------------------------------------------------

--
-- Table structure for table `friendships`
--

CREATE TABLE `friendships` (
  `id1` int(11) NOT NULL,
  `id2` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `friendships`
--

INSERT INTO `friendships` (`id1`, `id2`) VALUES
(1, 2),
(1, 3),
(3, 1),
(3, 2),
(2, 3);

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `id` int(12) NOT NULL,
  `creator_id` int(10) NOT NULL,
  `message_body` text NOT NULL,
  `create_date` timestamp(3) NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`id`, `creator_id`, `message_body`, `create_date`) VALUES
(1, 1, 'Hello, world!(2017-04-12 19:48:54)', '2017-04-12 19:48:54.000'),
(2, 1, 'Hey there johnny boi, hows it goin? (2017-04-12 19:48:55)', '2017-04-12 19:48:55.000'),
(3, 2, 'oh you know, just hootin and a hollerin per the usual. You get that ol girl a rooten tooten runnin? (2017-04-12 19:48:56)', '2017-04-12 19:48:56.000'),
(4, 1, 'Weeell im a workin on it. It aint gone be easy but ill keep ya posted! (2017-04-12 19:48:56)', '2017-04-12 19:48:56.000'),
(5, 2, 'Yee haw!(2017-04-12 20:48:50)', '2017-04-12 20:48:50.000'),
(6, 1, 'Hey there johnny boi, hows it goin?(2017-04-12 20:48:50)', '2017-04-12 20:48:50.000'),
(7, 2, 'Oh you know, just hootin and a hollerin per the usual. You get that ol girl a rooten tooten runnin?(2017-05-12 20:48:50)', '2017-05-12 20:48:50.000'),
(8, 1, 'Weeell im a workin on it. It aint gone be easy but ill keep ya posted!(2017-06-12 00:48:50)', '2017-06-12 00:48:50.000'),
(9, 2, 'Yee haw!(2018-04-13 22:48:50)', '2018-04-13 22:48:50.000'),
(10, 1, 'Hey there johnny boi, hows it goin?(2017-04-13 20:48:50)', '2017-04-13 20:48:50.000'),
(11, 2, 'Oh you know, just hootin and a hollerin per the usual. You get that ol girl a rooten tooten runnin?(2017-04-14 20:48:50)', '2017-04-14 20:48:50.000'),
(12, 1, 'Weeell im a workin on it. It aint gone be easy but ill keep ya posted!(2015-04-12 20:48:50)', '2015-04-12 20:48:50.000');

-- --------------------------------------------------------

--
-- Table structure for table `message_recipient`
--

CREATE TABLE `message_recipient` (
  `id` int(10) NOT NULL,
  `recipient_id` int(10) NOT NULL,
  `message_id` int(11) NOT NULL,
  `is_read` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `message_recipient`
--

INSERT INTO `message_recipient` (`id`, `recipient_id`, `message_id`, `is_read`) VALUES
(1, 2, 1, 0),
(2, 2, 2, 0),
(3, 1, 3, 0),
(4, 2, 4, 0),
(5, 1, 5, 0), 
(6, 2, 6, 0), 
(7, 1, 7, 0), 
(8, 2, 8, 0), 
(9, 1, 9, 0), 
(10, 2, 10, 0), 
(11, 1, 11, 0),
(12, 2, 12, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(9) NOT NULL,
  `username` varchar(50) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `is_active` int(11) NOT NULL DEFAULT '0',
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `first_name`, `last_name`, `is_active`, `password`) VALUES
(1, 'aarobrai', 'Aaron', 'Brainard', 0, '$2y$10$y0Y9WkFj4fLfchh2R4JulurXzxusZB4UsJhCkh5VoAedwjv43bp8e'),
(2, 'abraham_drinkin', 'Abraham', 'Drinkin', 0, '$2y$10$3TQ3evHYtnaFFIYkfV3qQupMS.9.o3pdvE2gTMGMKmu4nQPF56a.W'),
(3, 'the_senate', 'Sheev', 'Palpatine', 0, '$2y$10$JvsY20BfuHUq10mgmtRBKe2oseweRBu2QYdm2E7NK/cTeUNykp6ae');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `friendships`
--
ALTER TABLE `friendships`
  ADD KEY `id1` (`id1`),
  ADD KEY `id2` (`id2`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id`),
  ADD KEY `creator_id` (`creator_id`);

--
-- Indexes for table `message_recipient`
--
ALTER TABLE `message_recipient`
  ADD PRIMARY KEY (`id`),
  ADD KEY `recipient_id` (`recipient_id`),
  ADD KEY `message_id` (`message_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `friendships`
--
ALTER TABLE `friendships`
  ADD CONSTRAINT `friendships_ibfk_1` FOREIGN KEY (`id1`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `friendships_ibfk_2` FOREIGN KEY (`id2`) REFERENCES `users` (`id`);

--
-- Constraints for table `message`
--
ALTER TABLE `message`
  ADD CONSTRAINT `message_ibfk_1` FOREIGN KEY (`creator_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `message_recipient`
--
ALTER TABLE `message_recipient`
  ADD CONSTRAINT `message_recipient_ibfk_1` FOREIGN KEY (`recipient_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `message_recipient_ibfk_2` FOREIGN KEY (`message_id`) REFERENCES `message` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
