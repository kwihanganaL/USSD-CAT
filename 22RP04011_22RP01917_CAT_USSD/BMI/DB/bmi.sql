-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 16, 2025 at 11:47 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bmi`
--

-- --------------------------------------------------------

--
-- Table structure for table `bmi_data`
--

CREATE TABLE `bmi_data` (
  `bmi_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `height` decimal(10,2) NOT NULL,
  `weight` decimal(10,2) NOT NULL,
  `bmi` decimal(10,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bmi_data`
--

INSERT INTO `bmi_data` (`bmi_id`, `user_id`, `height`, `weight`, `bmi`, `created_at`) VALUES
(1, 10, 80.00, 80.00, 0.01, '2025-05-16 09:15:41'),
(2, 1, 60.00, 89.00, 0.02, '2025-05-16 09:17:30');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `fullname` varchar(250) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `pin` varchar(100) NOT NULL,
  `registered_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `fullname`, `phone`, `pin`, `registered_at`) VALUES
(1, 'IGIHOZO Patience', '+250790222449', '1234', '2025-05-16 00:42:16'),
(5, 'ip', '+250793341420', '1234', '2025-05-16 01:03:48'),
(6, 'hhhhhhhh', '0792359800', '1234', '2025-05-16 01:23:38'),
(7, 'NIYOMUREMYI Gilbert', '+250790222444', '1234', '2025-05-16 08:36:19'),
(8, 'kwihangana lullaby', '+250790222443', '1234', '2025-05-16 08:44:09'),
(9, 'billy', '+250790222556', '1234', '2025-05-16 08:47:32'),
(10, 'ip patience', '0792359801', '1234', '2025-05-16 09:14:54'),
(11, 'mandela', '+250732542540', '1234', '2025-05-16 09:19:09'),
(12, 'gilbert', '+250790922449', '1234', '2025-05-16 09:20:22');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bmi_data`
--
ALTER TABLE `bmi_data`
  ADD PRIMARY KEY (`bmi_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bmi_data`
--
ALTER TABLE `bmi_data`
  MODIFY `bmi_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
