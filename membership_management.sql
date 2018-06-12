-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 29, 2018 at 08:05 PM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 7.2.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `membership_management`
--

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE `members` (
  `id_member` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `origin` varchar(255) NOT NULL,
  `created_date` date NOT NULL,
  `mem_phone_number` varchar(10) NOT NULL,
  `calender_events` varchar(255) NOT NULL,
  `recurring_services` varchar(255) NOT NULL,
  `payments` int(11) NOT NULL,
  `balance` int(11) NOT NULL,
  `purchase_sessions` int(11) NOT NULL,
  `remaining_sessions` int(11) NOT NULL,
  `agreement_status` varchar(255) NOT NULL,
  `alert` varchar(255) NOT NULL,
  `application_status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`id_member`, `id_user`, `name`, `origin`, `created_date`, `mem_phone_number`, `calender_events`, `recurring_services`, `payments`, `balance`, `purchase_sessions`, `remaining_sessions`, `agreement_status`, `alert`, `application_status`) VALUES
(25, 1, 'John Doe', 'Maryland', '2017-12-31', '1234567890', '2019-12-31', 'Yes', 0, 80, 5, 5, 'Past Due', 'On Going', 'Deliquent'),
(26, 1, 'Joseph M. McCloud', 'Illinois', '2018-05-01', '6304196171', '2018-05-16', 'Yes', 10, 0, 0, 10, 'Good', 'On Going', 'Active'),
(27, 1, 'George E. Quincy', 'California', '2018-02-14', '4567328198', '2018-05-15', 'Yes', 20, 80, 0, 0, 'Suspended', 'On Going', 'Active Customer - Suspended'),
(28, 1, 'Charlie Oppen', 'Pennsylvania', '2017-05-24', '4567898423', '2018-03-15', 'No', 10, 90, 1, 0, 'Good', 'On Going', 'Drop In'),
(29, 1, 'Karlo Poljak', 'Wyoming', '2016-06-07', '0987678765', '2018-01-17', 'Yes', 10, 5, 1, 3, 'Past Due', 'On Going', 'Deliquent'),
(30, 1, 'Thomas Marcoux', 'New York', '2014-08-15', '8765434567', '2015-06-10', 'Yes', 50, 0, 1, 5, 'Inactive', 'Canceled', 'Canceled Customer'),
(31, 1, 'Rodrigo Santos Melo', 'Portland', '2008-02-05', '2345678987', '2011-03-05', 'Yes', 0, 0, 1, 0, 'Inactive', 'Expired', 'Expired Customer'),
(32, 1, 'Leevi Lumme', 'Washington', '2017-04-25', '9876543456', '2018-04-26', 'Yes', 80, 60, 5, 3, 'Good', 'On Going', 'Collections Customer'),
(33, 1, 'Giliola MareÅ¡', 'Maryland', '2015-04-28', '4543456789', '2016-04-15', 'Yes', 60, 0, 1, 0, 'Good', 'On Going', 'Drop In'),
(34, 1, 'Quirico Monaldo', 'Virginia', '2016-04-23', '2345678908', '2017-05-28', 'No', 100, 0, 0, 10, 'Good', 'On Going', 'Active'),
(35, 1, 'Stef Nakken', 'North Carolina', '2010-11-28', '2345678909', '2015-12-30', 'Yes', 0, 0, 1, 0, 'Good', 'On Going', 'Active'),
(36, 1, 'Gary Buck', 'Texas', '2011-12-02', '9876543456', '2012-02-09', 'Yes', 20, 30, 5, 5, 'Past Due', 'On Going', 'Deliquent'),
(37, 1, 'Kyle Bridgewaters', 'Arizona', '2015-09-10', '0987654345', '2015-02-04', 'Yes', 90, 0, 5, 5, 'Good', 'On Going', 'Active'),
(38, 1, 'Gabriel Lima Pinto', 'Texas', '2008-02-22', '0765434567', '2009-12-12', 'Yes', 0, 0, 1, 2, 'Collections', 'On Going', 'Collections Customer');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `e_mail` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone_num` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `first_name`, `last_name`, `e_mail`, `password`, `phone_num`) VALUES
(1, 'test', 'test', 'test@test.com', 'NmY0YjcyNjIzOGU0ZWRhYzM3M2QxMjY0ZGNiNmY4OTA=', '9999999999'),
(2, 'John', 'Doe', 'john@test.com', 'NmY0YjcyNjIzOGU0ZWRhYzM3M2QxMjY0ZGNiNmY4OTA=', '0987654356'),
(3, 'First', 'Last', 'firstlast@test.com', 'NmY0YjcyNjIzOGU0ZWRhYzM3M2QxMjY0ZGNiNmY4OTA=', '0987654323');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`id_member`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `e_mail` (`e_mail`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
  MODIFY `id_member` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
