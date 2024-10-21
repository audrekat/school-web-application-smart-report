-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 23, 2024 at 10:13 AM
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
-- Database: `smart_report`
--

-- --------------------------------------------------------

--
-- Table structure for table `parent`
--

CREATE TABLE `parent` (
  `name` text NOT NULL,
  `surname` text NOT NULL,
  `id_number` int(15) NOT NULL,
  `gender` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `contact` int(11) NOT NULL,
  `password` varchar(100) NOT NULL,
  `user_type` varchar(11) NOT NULL,
  `username` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `parent`
--

INSERT INTO `parent` (`name`, `surname`, `id_number`, `gender`, `email`, `contact`, `password`, `user_type`, `username`) VALUES
('0', '0', 2147483647, 0, '0', 720815786, '1234', '0', '0'),
('0', '0', 2147483647, 0, '0', 720815931, '1234', '0', '0'),
('0', '0', 2147483647, 0, '0', 720815931, '1234', '0', '0'),
('0', '0', 2147483647, 0, '0', 2147483647, '1234', '0', '0'),
('0', 'kaepea', 2147483647, 0, 'auda@gmail.com', 2147483647, '1234parent', 'parent', 'root'),
('kari', 'mmmm', 2147483647, 0, 'weg@bh', 98765456, '1234parent', 'parent', 'root'),
('kari', 'mmmm', 2147483647, 0, 'audreymmakaepea@gmail.com', 98765456, '1234parent', 'parent', 'root'),
('kari', 'mmmm', 2147483647, 0, 'audreymmakaepea@gmail.com', 98765456, '1234parent', 'parent', 'root'),
('dfgh', 'xcvb', 8654345, 0, 'cvb', 787654334, '1234parent', 'parent', 'root'),
('dfgh', 'xcvb', 8654345, 0, 'lerato@gmail.com', 787654334, '1234parent', 'parent', 'root'),
('lerato', 'mmak', 2147483647, 0, 'tryphosa@gmail.com', 765438758, '1234parent', 'parent', 'root'),
('lerato', 'mmak', 2147483647, 0, 'tryphosa@gmail.com', 765438758, '1234parent', 'parent', 'root'),
('lerato', 'mmak', 2147483647, 0, 'tryphosa@gmail.com', 765438758, '1234parent', 'parent', 'root'),
('lerato', 'mmak', 2147483647, 0, 'tryphosa@gmail.com', 765438758, '1234parent', 'parent', 'root'),
('mapula', 'mororopa', 2147483647, 0, 'tshegonkomi49@gmail', 67, '1234parent', 'parent', 'root'),
('mapula', 'mororopa', 2147483647, 0, 'tshegonkomi49@gmail.com', 67, '1234parent', 'parent', 'root'),
('mapula', 'mororopa', 2147483647, 0, 'tshegonkomi49@gmail.com', 67, '1234parent', 'parent', 'root'),
('mapula', 'mororopa', 2147483647, 0, 'tshegonkomi49@gmail.com', 67, '1234parent', 'parent', 'root'),
('mapula', 'mororopa', 2147483647, 0, 'tshegonkomi49@gmail.com', 67, '1234parent', 'parent', 'root'),
('mapula', 'mororopa', 2147483647, 0, 'tshegonkomi49@gmail.com', 67, '1234parent', 'parent', 'root'),
('mapula', 'mororopa', 2147483647, 0, 'tshegonkomi49@gmail.com', 67, '1234parent', 'parent', 'root'),
('mapula', 'mororopa', 2147483647, 0, 'tshegonkomi49@gmail.com', 67, '1234parent', 'parent', 'root');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
