-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 12, 2024 at 04:06 PM
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
-- Database: `wiki`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userId` int(11) NOT NULL,
  `userName` varchar(255) DEFAULT NULL,
  `userEmail` varchar(255) DEFAULT NULL,
  `userPassword` varchar(255) DEFAULT NULL,
  `userDate` date DEFAULT '2024-01-11',
  `userRole` enum('admin','author') NOT NULL DEFAULT 'author'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userId`, `userName`, `userEmail`, `userPassword`, `userDate`, `userRole`) VALUES
(1, 'admin', 'admin@youcode.ma', '$2y$10$UM/Nn9MAWzrGgXH1TpSscumHQEoTeKHuh8QaqJ22ijvoWXtRzTj0e', '2024-01-11', 'admin'),
(2, 'digylu', 'camec@mailinator.com', '$2y$10$CrG9kOECY9g65yUbIswSOulnaqEhIQQ/BqoXdSDnUQkxXSMWmRerq', '2024-01-11', 'author'),
(3, 'xodez', 'dadozyx@mailinator.com', '$2y$10$dqRKxeuKEvwWLTvbTANES.eXg.wUHyit8Ucpu3Cg2/7Wx0YBZs3wW', '2024-01-11', 'author'),
(4, 'zazusuje', 'zoruxa@mailinator.com', '$2y$10$.3sQPeWyyD9UuLgkF7jVkuAeJSJ0WsHCfv8q/s9w1vIF/xQzQsp/e', '2024-01-11', 'author'),
(5, 'penadi', 'vydobafak@mailinator.com', '$2y$10$hXgdc9e93Q9WCmEwJvcC6uVlP1TQIu7OckjydPf61sg.tiMt0f6AW', '2024-01-11', 'author');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
