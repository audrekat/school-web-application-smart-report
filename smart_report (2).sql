-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 23, 2024 at 12:28 AM
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
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `Admin_ID` int(11) NOT NULL,
  `Name` varchar(100) DEFAULT NULL,
  `Surname` varchar(100) DEFAULT NULL,
  `Email` varchar(100) DEFAULT NULL,
  `Password` varchar(50) DEFAULT NULL,
  `Date_created` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `Comment_ID` int(11) NOT NULL,
  `Report_ID` int(11) DEFAULT NULL,
  `Comment` varchar(255) DEFAULT NULL,
  `Date_created` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `learner`
--

CREATE TABLE `learner` (
  `learner_id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `surname` varchar(100) DEFAULT NULL,
  `id_number` bigint(15) DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `grade` varchar(10) DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `registration_date` timestamp NULL DEFAULT current_timestamp(),
  `gender` enum('male','female','other','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `learner`
--

INSERT INTO `learner` (`learner_id`, `name`, `surname`, `id_number`, `parent_id`, `address`, `grade`, `date_of_birth`, `registration_date`, `gender`) VALUES
(1, 'joe', 'c', 987654321, 1, 'jekwbfs1', '5', '2024-09-05', '2024-09-21 22:41:50', 'female'),
(2, 'joe', 'c', 987654321, 1, 'jekwbfs1', '5', '2024-09-18', '2024-09-21 22:42:48', 'female'),
(3, 'joe', 'c', 6432123456789, NULL, 'jekwbfs1', '5', '2024-09-13', '2024-09-21 22:44:18', 'female'),
(4, 'joe', 'c', 5463728190, NULL, 'jd', '5', '2024-09-18', '2024-09-21 22:48:43', 'female'),
(5, 'mack', 'w', 1, NULL, 'w', '2', '2024-09-19', '2024-09-22 08:17:56', 'female'),
(6, 'Mahlatse Mack', 'Malema', 3, NULL, 'MENTZ MSHOGOVILL STAND NO133', '5', '2024-09-11', '2024-09-22 08:18:57', 'female'),
(7, 'q', 'aw', 1, NULL, 'MENTZ MSHOGOVILL STAND NO133', '5', '2024-09-12', '2024-09-22 08:19:29', 'female'),
(8, 'Mahlatse Mack', 'Malema', 1, NULL, 'MENTZ MSHOGOVILL STAND NO133', '7', '2024-09-10', '2024-09-22 08:24:30', 'female'),
(9, 'Mahlatse Mack', 'Malema', 3, NULL, 'MENTZ MSHOGOVILL STAND NO133', '2', '2024-09-18', '2024-09-22 16:16:00', 'female'),
(10, 'PK', 'Morwatshehla', 3, NULL, 'MENTZ MSHOGOVILL STAND NO133', '2', '2024-09-04', '2024-09-22 16:29:10', 'female'),
(11, 'Mahlatse Mack', 'Malema', 1, NULL, 'MENTZ MSHOGOVILL STAND NO133', '5', '2024-09-04', '2024-09-22 16:29:57', 'female'),
(12, 'q', 'a', 1, NULL, '2', '55', '2024-09-10', '2024-09-22 16:33:58', 'female');

-- --------------------------------------------------------

--
-- Table structure for table `parent`
--

CREATE TABLE `parent` (
  `parent_id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `surname` varchar(100) DEFAULT NULL,
  `id_number` bigint(15) DEFAULT NULL,
  `contact` bigint(15) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `registration_date` timestamp NULL DEFAULT current_timestamp(),
  `user_type` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `gender` enum('male','female','other','') NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `parent`
--

INSERT INTO `parent` (`parent_id`, `name`, `surname`, `id_number`, `contact`, `address`, `email`, `registration_date`, `user_type`, `username`, `gender`, `password`) VALUES
(1, 'joe', 'doe', 1234567890, 1234567890, 'jekwbfs1', 'ma@m.com', NULL, 'parent', 'ma@.com', 'female', ''),
(2, 'joe', 'doe', 1234567890, 1234567890, 'jekwbfs1', 'ma@m.com', NULL, 'parent', 'ma@.com', 'female', ''),
(3, 'x', 'man', 6432123456789, 1234567890, 'jd', 'malemamack@gmail.com', NULL, 'parent', 'malemamack@gmail.com', 'other', '$2y$10$vCsVWZy738u8/ypH81gcwu7WlCjdBediVWKfpjMoBjxkC2CuqgrMK'),
(4, 'd', 'man', 6432123456789, 1234567890, 'jekwbfs1', 'malemamack@gmail.com', NULL, 'parent', 'malemamack@gmail.com', 'female', '$2y$10$GS48tgLi0ogARFVpKcTKMufc0gFp766ZxTuDbkDEz7.WXh2mhZPMq'),
(5, 'm', 'n', 5463728190, 123456789, 'fgh', 'malemamack@gmail.com', NULL, 'parent', 'mack', 'male', '35a8e3cd'),
(10, 'Mahlatse Mack', 'Malema', 134567, 1234567890, 'MENTZ MSHOGOVILL STAND NO133', 'malemamack@gmail.com', NULL, 'parent', 'malemamack@gmail.com', 'female', '3dda059f'),
(11, 'joe', 'x', 12345678, 12345678, 'MENTZ MSHOGOVILL STAND NO1731', 'malemamack@gmail.com', NULL, 'parent', 'malemamack@gmail.com', 'other', '7f8909ce'),
(13, 'Mahlatse Mack', 'Malema', 134567, 1234567890, 'MENTZ MSHOGOVILL STAND NO133', 'malemamack@gmail.com', '2024-09-21 22:00:00', 'parent', 'mack', 'female', '$2y$10$b.VutPWM3wNQa3oqE3cjFeyTZedyaJdaa6l40AtYK412WOGdvOrb.'),
(14, 'j', 'x', 1, 1, 'j', 'malemamack@gmail.com', '2024-09-21 22:00:00', 'parent', 'malemamack@gmail.com', 'female', '$2y$10$q52fkAQ4BibWUy2bx6J8FetRNGlqCvamCLuEPi3CV.9HLo4LqSMpW'),
(15, 'PK', 'Morwatshehla', 134567, 1234567890, 'MENTZ MSHOGOVILL STAND NO133', 'mmalema1@csir.co.za', '2024-09-21 22:00:00', 'parent', 'mahlatse ', 'female', '$2y$10$EWimzGKw.0gp78EMoLot.OybQKbH9TcqvxNlgrIr3WDvcefGD56VS');

-- --------------------------------------------------------

--
-- Table structure for table `report`
--

CREATE TABLE `report` (
  `Report_ID` int(11) NOT NULL,
  `Learner_id` int(11) DEFAULT NULL,
  `Subject_ID` int(11) DEFAULT NULL,
  `Grade` varchar(10) DEFAULT NULL,
  `Comment` text DEFAULT NULL,
  `Date_created` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `subject`
--

CREATE TABLE `subject` (
  `Subject_ID` int(11) NOT NULL,
  `subject_name` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `subject`
--

INSERT INTO `subject` (`Subject_ID`, `subject_name`) VALUES
(6, 'Art'),
(13, 'Biology'),
(14, 'Chemistry'),
(9, 'Computer Science'),
(4, 'English'),
(10, 'French'),
(5, 'Geography'),
(12, 'German'),
(3, 'History'),
(1, 'Mathematics'),
(7, 'Music'),
(8, 'Physical Education'),
(15, 'Physics'),
(2, 'Science'),
(11, 'Spanish');

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `Subject_ID` int(11) NOT NULL,
  `subject` varchar(100) DEFAULT NULL,
  `learner_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`Subject_ID`, `subject`, `learner_id`) VALUES
(1, '[value-2]', 0),
(2, 'Chemistry', 12);

-- --------------------------------------------------------

--
-- Table structure for table `teacher`
--

CREATE TABLE `teacher` (
  `Teacher_ID` int(11) NOT NULL,
  `Name` varchar(100) DEFAULT NULL,
  `Surname` varchar(100) DEFAULT NULL,
  `Email` varchar(100) DEFAULT NULL,
  `Subject_ID` int(11) DEFAULT NULL,
  `Contact` bigint(15) DEFAULT NULL,
  `registration_date` timestamp NULL DEFAULT current_timestamp(),
  `gender` enum('male','female','other','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `userlogin`
--

CREATE TABLE `userlogin` (
  `UserID` int(11) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `role` enum('admin','teacher','parent','') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `userlogin`
--

INSERT INTO `userlogin` (`UserID`, `email`, `password`, `role`) VALUES
(1, 'malemamack@gmail.com', '$2y$10$VcD1vQmlJ7mLhA2DKlovfOL7ew7NrUW2FOnmsSq5xoe', 'parent'),
(2, 'malemamack@gmail.com', '$2y$10$zYD1/oRVDXZiuMcFW8glhOyf8.d2c9zl4b7SMd9Wa2g', 'parent'),
(3, 'mack', '$2y$10$b.VutPWM3wNQa3oqE3cjFeyTZedyaJdaa6l40AtYK41', 'parent'),
(4, 'malemamack@gmail.com', '$2y$10$q52fkAQ4BibWUy2bx6J8FetRNGlqCvamCLuEPi3CV.9', 'parent'),
(5, 'mahlatse ', '$2y$10$EWimzGKw.0gp78EMoLot.OybQKbH9TcqvxNlgrIr3WD', 'parent');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`Admin_ID`);

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`Comment_ID`),
  ADD KEY `Report_ID` (`Report_ID`);

--
-- Indexes for table `learner`
--
ALTER TABLE `learner`
  ADD PRIMARY KEY (`learner_id`),
  ADD KEY `Parent_id` (`parent_id`);

--
-- Indexes for table `parent`
--
ALTER TABLE `parent`
  ADD PRIMARY KEY (`parent_id`);

--
-- Indexes for table `report`
--
ALTER TABLE `report`
  ADD PRIMARY KEY (`Report_ID`),
  ADD KEY `Learner_id` (`Learner_id`),
  ADD KEY `Subject_ID` (`Subject_ID`);

--
-- Indexes for table `subject`
--
ALTER TABLE `subject`
  ADD PRIMARY KEY (`Subject_ID`),
  ADD UNIQUE KEY `subject_name` (`subject_name`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`Subject_ID`),
  ADD UNIQUE KEY `learner_id` (`learner_id`),
  ADD UNIQUE KEY `subject_name` (`subject`);

--
-- Indexes for table `teacher`
--
ALTER TABLE `teacher`
  ADD PRIMARY KEY (`Teacher_ID`),
  ADD KEY `Subject_ID` (`Subject_ID`);

--
-- Indexes for table `userlogin`
--
ALTER TABLE `userlogin`
  ADD PRIMARY KEY (`UserID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `Admin_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `Comment_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `learner`
--
ALTER TABLE `learner`
  MODIFY `learner_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `parent`
--
ALTER TABLE `parent`
  MODIFY `parent_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `report`
--
ALTER TABLE `report`
  MODIFY `Report_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `subject`
--
ALTER TABLE `subject`
  MODIFY `Subject_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `Subject_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `teacher`
--
ALTER TABLE `teacher`
  MODIFY `Teacher_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `userlogin`
--
ALTER TABLE `userlogin`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `comment_ibfk_1` FOREIGN KEY (`Report_ID`) REFERENCES `report` (`Report_ID`);

--
-- Constraints for table `learner`
--
ALTER TABLE `learner`
  ADD CONSTRAINT `learner_ibfk_1` FOREIGN KEY (`Parent_id`) REFERENCES `parent` (`Parent_id`);

--
-- Constraints for table `report`
--
ALTER TABLE `report`
  ADD CONSTRAINT `report_ibfk_1` FOREIGN KEY (`Learner_id`) REFERENCES `learner` (`Learner_id`),
  ADD CONSTRAINT `report_ibfk_2` FOREIGN KEY (`Subject_ID`) REFERENCES `subject` (`Subject_ID`);

--
-- Constraints for table `teacher`
--
ALTER TABLE `teacher`
  ADD CONSTRAINT `teacher_ibfk_1` FOREIGN KEY (`Subject_ID`) REFERENCES `subject` (`Subject_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
