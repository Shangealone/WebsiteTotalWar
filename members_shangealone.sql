-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 11, 2024 at 06:54 PM
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
-- Database: `members_shangealone`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` mediumint(8) UNSIGNED NOT NULL,
  `fname` varchar(40) NOT NULL,
  `lname` varchar(40) NOT NULL,
  `email` varchar(50) NOT NULL,
  `psword` varchar(255) NOT NULL,
  `registration_date` datetime DEFAULT NULL,
  `user_level` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `fname`, `lname`, `email`, `psword`, `registration_date`, `user_level`) VALUES
(1, 'admin', 'admin', 'admin@admin.com', '$2y$10$VFDkU1Y1lOndI6oJAe5vCuF9mOyDdt.iB.Js5MQDWxDV8LXMFoVi2', '2024-12-12 01:47:02', 1),
(9, 'Cheichei', 'Puro', 'Chei@gmail.com', '$2y$10$gDgjBGmV8ly/CUQ7OpybhOQgmZPwA50jyWXJFmoCOcaq6sDO575.C', '2024-12-11 22:46:38', 0),
(10, 'shan', 'gealone', 'shan@gmail.com', '$2y$10$8X4mdBYEMN1v9yFp14OoKuSmYz6HaJwVCyIpRid9u5VJW5QPQJDSu', '2024-12-12 01:41:55', 0),
(11, 'Dan', 'Rivero', 'dan@gmail.com', '$2y$10$wzc2bMje0tQRumyVcpS2/e2M1kAzJ/iDXlIE9uw0aFZSFE86MR1kq', '2024-12-12 01:44:22', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
