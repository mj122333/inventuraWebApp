-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 03, 2024 at 12:11 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `inventura`
--

-- --------------------------------------------------------

--
-- Table structure for table `vl_inventura`
--

CREATE TABLE `vl_inventura` (
  `id` int(11) NOT NULL,
  `pocetak` datetime DEFAULT NULL,
  `kraj` datetime DEFAULT NULL,
  `aktivno` bit(1) NOT NULL DEFAULT b'1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vl_inventura`
--

INSERT INTO `vl_inventura` (`id`, `pocetak`, `kraj`, `aktivno`) VALUES
(25, '2024-01-01 18:10:11', '2024-01-01 18:10:12', b'0'),
(26, '2024-01-01 18:10:13', '2024-01-01 18:10:13', b'0'),
(27, '2024-01-01 18:10:17', '2024-01-01 18:10:20', b'0'),
(28, '2024-01-02 13:21:21', '2024-01-02 13:21:21', b'0'),
(29, '2024-01-02 13:21:22', NULL, b'1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `vl_inventura`
--
ALTER TABLE `vl_inventura`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `vl_inventura`
--
ALTER TABLE `vl_inventura`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
