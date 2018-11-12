-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 12, 2018 at 05:22 PM
-- Server version: 10.1.34-MariaDB
-- PHP Version: 7.0.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `contacts`
--

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `id` int(11) NOT NULL,
  `first_name` varchar(200) NOT NULL,
  `last_name` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`id`, `first_name`, `last_name`) VALUES
(4, 'Mostafa', 'Khalil'),
(9, 'Mohammed', 'Saudi'),
(10, 'Galal', 'Sameh'),
(11, 'Galal', 'Sameh'),
(14, 'dsrfdsf', 'sdfsdf'),
(15, 'dsrfdsf', 'sdfsdf'),
(20, 'ASsaddf', 'sadafdsf'),
(21, 'ASsaddf', 'sadafdsf'),
(22, 'dfagdfgadfgadf', 'gadfgfdgfghgf'),
(23, 'ASADADAS', 'dsfa sdgdgdsfgfdsgsdf'),
(24, 'dsfa sgdf', 'gfdsg sdfgdf'),
(25, 'Hala', 'Ali'),
(26, 'ASDSFDF', 'ASKGAKJ'),
(27, 'dsg dfgsdfg', ' sdfgsdfg dfgsdfg'),
(28, 'Hamza Abdullah', 'Ziad'),
(40, 'oikawa', 'tooru'),
(43, 'oikawa', 'tooru'),
(44, 'Mickey', 'Mouse');

-- --------------------------------------------------------

--
-- Table structure for table `phone_numbers`
--

CREATE TABLE `phone_numbers` (
  `phone_title` varchar(200) NOT NULL,
  `phone_number` varchar(20) NOT NULL,
  `default_num` tinyint(1) NOT NULL,
  `contact_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `phone_numbers`
--

INSERT INTO `phone_numbers` (`phone_title`, `phone_number`, `default_num`, `contact_id`) VALUES
('Home', '2147483647', 1, 4),
('HOME', '2147483647', 1, 9),
('HOME', '2147483647', 1, 10),
('HOME', '2147483647', 1, 11),
('HOME', '2147483647', 1, 20),
('HOME', '2147483647', 1, 21),
('HOME', '2147483647', 1, 22),
('HOME', '2147483647', 1, 23),
('HOME', '2147483647', 1, 24),
('HOME', '2147483647', 1, 25),
('HOME', '2147483647', 1, 26),
('HOME', '2147483647', 1, 27),
('HOME', '2147483647', 1, 28),
('HOME', '14136965428615', 1, 40),
('HOME', '2147483647', 1, 43),
('HOME', '632541789', 0, 44);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL,
  `auth` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `auth`) VALUES
(1, 'asmaaayyash', '147258', '{k2}ZApM-01K2-R');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `phone_numbers`
--
ALTER TABLE `phone_numbers`
  ADD PRIMARY KEY (`contact_id`,`phone_title`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `phone_numbers`
--
ALTER TABLE `phone_numbers`
  ADD CONSTRAINT `phone_numbers_ibfk_1` FOREIGN KEY (`contact_id`) REFERENCES `contact` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
