-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 15, 2020 at 09:17 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `booking_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `id` int(11) NOT NULL,
  `pub_id` int(11) NOT NULL,
  `table_id` int(11) NOT NULL,
  `booking_no` int(11) DEFAULT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `contact_number` varchar(255) DEFAULT NULL,
  `no_of_people` int(11) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `from_time` time DEFAULT NULL,
  `to_time` time DEFAULT NULL,
  `additional_information` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `id` int(11) NOT NULL,
  `pub_id` int(11) NOT NULL,
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`id`, `pub_id`, `image`) VALUES
(21, 43, 'victorymansion.jpg'),
(22, 44, 'homeboybar.jpg'),
(26, 45, 'oriolebar.jpg'),
(27, 46, 'sportsbarandg.jpeg'),
(28, 47, 'thesunonthehill.jpg'),
(29, 48, 'dasdisko.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `opening_hours`
--

CREATE TABLE `opening_hours` (
  `id` int(11) NOT NULL,
  `pub_id` int(11) NOT NULL,
  `day` varchar(255) DEFAULT NULL,
  `from_time` varchar(255) DEFAULT NULL,
  `to_time` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `opening_hours`
--

INSERT INTO `opening_hours` (`id`, `pub_id`, `day`, `from_time`, `to_time`) VALUES
(568, 43, 'Mon', 'Closed', 'Closed'),
(569, 43, 'Tue', 'Closed', 'Closed'),
(570, 43, 'Wed', '17:00', '23:00'),
(571, 43, 'Thu', '17:00', '23:00'),
(572, 43, 'Fri', '17:00', '23:00'),
(573, 43, 'Sat', '12:00', '23:00'),
(574, 43, 'Sun', 'Closed', 'Closed'),
(575, 44, 'Mon', '15:00', '23:00'),
(576, 44, 'Tue', '15:00', '23:00'),
(577, 44, 'Wed', '15:30', '23:00'),
(578, 44, 'Thu', '15:00', '23:00'),
(579, 44, 'Fri', '15:00', '01:00'),
(580, 44, 'Sat', '15:00', '01:00'),
(581, 44, 'Sun', '15:00', '23:00'),
(603, 45, 'Mon', 'Closed', 'Closed'),
(604, 45, 'Tue', 'Closed', 'Closed'),
(605, 45, 'Wed', '17:00', '22:00'),
(606, 45, 'Thu', '17:00', '22:00'),
(607, 45, 'Fri', '17:00', '22:00'),
(608, 45, 'Sat', '17:00', '22:00'),
(609, 45, 'Sun', '17:00', '22:00'),
(610, 46, 'Mon', 'Closed', 'Closed'),
(611, 46, 'Tue', 'Closed', 'Closed'),
(612, 46, 'Wed', '11:00', '22:00'),
(613, 46, 'Thu', 'Closed', 'Closed'),
(614, 46, 'Fri', 'Closed', 'Closed'),
(615, 46, 'Sat', 'Closed', 'Closed'),
(616, 46, 'Sun', 'Closed', 'Closed'),
(617, 47, 'Mon', '10:00', '23:00'),
(618, 47, 'Tue', '10:00', '23:00'),
(619, 47, 'Wed', '10:00', '23:00'),
(620, 47, 'Thu', '10:00', '23:00'),
(621, 47, 'Fri', '10:00', '01:00'),
(622, 47, 'Sat', '10:00', '01:00'),
(623, 47, 'Sun', '10:00', '23:00'),
(624, 48, 'Mon', 'Closed', 'Closed'),
(625, 48, 'Tue', '17:00', '00:00'),
(626, 48, 'Wed', '17:00', '00:00'),
(627, 48, 'Thu', '17:00', '00:00'),
(628, 48, 'Fri', '17:00', '02:00'),
(629, 48, 'Sat', '17:00', '02:00'),
(630, 48, 'Sun', 'Closed', 'Closed');

-- --------------------------------------------------------

--
-- Table structure for table `pubs`
--

CREATE TABLE `pubs` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `company_name` varchar(255) DEFAULT NULL,
  `venue_type` varchar(255) DEFAULT NULL,
  `address_one` varchar(255) DEFAULT NULL,
  `address_two` varchar(255) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `post_code` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `booking_available` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pubs`
--

INSERT INTO `pubs` (`id`, `user_id`, `company_name`, `venue_type`, `address_one`, `address_two`, `country`, `city`, `post_code`, `description`, `booking_available`) VALUES
(43, 29, 'Victory Mansion', 'Other', '18 Stoke Newington High St', 'Clapton', 'United Kingdom', 'London', 'N16 7PL', 'Neighbourhood Bar, great cocktails, wines & beers alongside Bold & unique Asian tacos', 1),
(44, 30, 'Homeboy Bar', 'Cocktail Bar', '108 Essex Rd', 'Islington', 'United Kingdom', 'London', 'N1 8LX', 'Speakeasy-style bar with leather banquettes and bare brick walls, serving quirkily named cocktails', 1),
(45, 31, 'Oriole Bar', 'Cocktail Bar', 'E Poultry Ave', 'Farringdon', 'United Kingdom', 'London', 'EC1A 9LH', 'Subterranean cocktail bar with explorer style decor and live music, for cocktails and rare spirits.', 1),
(46, 32, 'Sports Bar & Grill', 'Sports Bar', 'Victoria St', 'Victoria', 'United Kingdom', 'London', 'SW1V 1JU', 'Simple menu of comfort classics in a sports bar where every seat has an undistributed view of a TV.', 1),
(47, 33, 'The Sun On The Hill', 'Gastropub', '23 Bennetts Hill', '', 'United Kingdom', 'Birmingham', 'B2 5QP', 'Classic, high ceilinged pub with a buzzy vibe and food such as burgers, plus regular live acts.', 1),
(48, 35, 'Das Disko', 'Bar', '9 Pelham St', '', 'United Kingdom', 'Nottingham', 'NG1 2EH', 'Intimate and candle-lit old world setting for inventive cocktails and nightly live blues music.', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tables_list`
--

CREATE TABLE `tables_list` (
  `id` int(11) NOT NULL,
  `pub_id` int(11) NOT NULL,
  `table_no` int(11) DEFAULT NULL,
  `table_name` varchar(255) DEFAULT NULL,
  `table_location` varchar(255) DEFAULT NULL,
  `capacity` int(11) DEFAULT NULL,
  `floor_plan` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tables_list`
--

INSERT INTO `tables_list` (`id`, `pub_id`, `table_no`, `table_name`, `table_location`, `capacity`, `floor_plan`, `description`) VALUES
(31, 48, 1, 'Collossal', 'Inside', 8, 'table-dasdisko.jpg', 'This is our largest table that we have in the venue'),
(32, 48, 2, 'Disko Booth', 'Inside', 5, 'Booth.jpg', 'This is our cushioned seated table'),
(33, 44, 1, 'Wood Table', 'Inside', 4, 'floorplan.png', 'This is our standard oak table');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `created_at`, `updated_at`) VALUES
(29, 'victorymansion', 'victorymansion@email.com', 'victorymansion', '2020-12-15 18:40:58', '2020-12-15 18:40:58'),
(30, 'homeboybar', 'homeboybar@email.com', 'homeboybar', '2020-12-15 18:50:36', '2020-12-15 18:50:36'),
(31, 'oriolebar', 'info@oriole.com', 'oriolebar', '2020-12-15 18:56:30', '2020-12-15 18:56:30'),
(32, 'sportsbarandg', 'sportsbarandg@email.com', 'sportsbarandg', '2020-12-15 19:06:11', '2020-12-15 19:06:11'),
(33, 'thesunonthehill', 'info@sunonthehill.com', 'thesunonthehill', '2020-12-15 19:13:41', '2020-12-15 19:13:41'),
(35, 'dasdisko', 'dasdisko@email.com', 'dasdisko', '2020-12-15 19:30:52', '2020-12-15 19:30:52');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`,`pub_id`,`table_id`),
  ADD KEY `pub_id` (`pub_id`),
  ADD KEY `table_id` (`table_id`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`,`pub_id`),
  ADD KEY `pub_id` (`pub_id`);

--
-- Indexes for table `opening_hours`
--
ALTER TABLE `opening_hours`
  ADD PRIMARY KEY (`id`,`pub_id`),
  ADD KEY `pub_id` (`pub_id`);

--
-- Indexes for table `pubs`
--
ALTER TABLE `pubs`
  ADD PRIMARY KEY (`id`,`user_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `tables_list`
--
ALTER TABLE `tables_list`
  ADD PRIMARY KEY (`id`,`pub_id`),
  ADD KEY `pub_id` (`pub_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `opening_hours`
--
ALTER TABLE `opening_hours`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=631;

--
-- AUTO_INCREMENT for table `pubs`
--
ALTER TABLE `pubs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `tables_list`
--
ALTER TABLE `tables_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `bookings_ibfk_1` FOREIGN KEY (`pub_id`) REFERENCES `pubs` (`id`),
  ADD CONSTRAINT `bookings_ibfk_2` FOREIGN KEY (`table_id`) REFERENCES `tables_list` (`id`);

--
-- Constraints for table `images`
--
ALTER TABLE `images`
  ADD CONSTRAINT `images_ibfk_1` FOREIGN KEY (`pub_id`) REFERENCES `pubs` (`id`);

--
-- Constraints for table `opening_hours`
--
ALTER TABLE `opening_hours`
  ADD CONSTRAINT `opening_hours_ibfk_1` FOREIGN KEY (`pub_id`) REFERENCES `pubs` (`id`);

--
-- Constraints for table `pubs`
--
ALTER TABLE `pubs`
  ADD CONSTRAINT `pubs_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `tables_list`
--
ALTER TABLE `tables_list`
  ADD CONSTRAINT `tables_list_ibfk_1` FOREIGN KEY (`pub_id`) REFERENCES `pubs` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
