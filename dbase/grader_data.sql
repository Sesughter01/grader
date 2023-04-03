-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 16, 2023 at 09:44 AM
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
-- Database: `grader_data`
--

-- --------------------------------------------------------





--
-- Table structure for table `results`
--

CREATE TABLE `results` (
  `id` int(30) NOT NULL,
  `student_id` int(30) NOT NULL,
  `marks` decimal(20,2) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `results`
--

INSERT INTO `results` (`id`, `student_id`, `marks`, `date_created`) VALUES
(1, 1, 88,'2020-11-21 16:57:05'),
(2, 2, 90,'2020-11-25 16:45:52');

-- --------------------------------------------------------

--
-- Table structure for table `result_items`
--

CREATE TABLE `result_items` (
  `id` int(30) NOT NULL,
  `result_id` int(30) NOT NULL,
  `module_id` int(30) NOT NULL,
  `mark` float NOT NULL,
  `grade` varchar(1) NOT NULL,
  `c_u_e` int(10) NOT NULL,
  `c_load` int(10) NOT NULL,
  `status` text NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `result_items`
--

INSERT INTO `result_items` (`id`, `result_id`, `module_id`, `mark`, `grade`,`c_u_e`,`c_load`,`status` ,`date_created`) VALUES
(1, 1, 2, 88,'A',20,20,'passed', '2020-11-21 16:57:05'),
(2, 1, 1, 65,'B',20,20,'passed' ,'2020-11-21 16:57:05'),
(3, 1, 3, 90,'A',20,20,'passed','2020-11-21 16:57:05'),
(4, 2, 2, 90,'A',20,20,'passed', '2020-11-25 16:45:52'),
(5, 2, 1, 88,'A',20,20,'passed', '2020-11-25 16:45:52'),
(6, 2, 3, 45,'F',0,20,'failed', '2020-11-25 16:45:52');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(30) NOT NULL,
  `user_id` int(30) NOT NULL,
  `student_code` varchar(50) NOT NULL,
  `firstname` varchar(200) NOT NULL,
  `middlename` varchar(200) NOT NULL,
  `lastname` varchar(200) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`,`user_id` ,`student_code`, `firstname`, `middlename`, `lastname`, `date_created`) VALUES
(1,1, 'msc701', 'Otesiri', 'O', 'Okposio', '2020-11-21 14:29:03'),
(2,2, 'msc712', 'GoodChild', 'K', 'Trent',   '2020-11-25 16:45:05');

-- --------------------------------------------------------

--
-- Table structure for table `modules`
--

CREATE TABLE `modules` (
  `id` int(30) NOT NULL,
  `module_code` varchar(50) NOT NULL,
  `module` varchar(200) NOT NULL,
  `description` text NOT NULL,
  `credits` int(50) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `modules`
--

INSERT INTO `modules` (`id`, `module_code`, `module`, `description`,`credits`,`date_created`) VALUES
(1, '7001', 'COMP', 'Object-Oriented Programming',20 ,'2023-03-16 11:43:25'),
(2, '7002', 'COMP', 'Modern Computer Systems',20 ,'2023-03-16 11:46:30'),
(3, '7005', 'TECH', 'Research,Scholarship and Professional Skills',20, '2023-03-16 11:46:49'),
(4, '7002', 'DALT', 'Data Science Foundations',10, '2023-03-16 11:48:20'),
(5, '7011', 'DALT', 'Introduction To Machine Learning',10, '2023-03-16 11:48:39'),
(6, '7003', 'SOFT', 'Advanced Software Development',20, '2023-03-16 11:48:40'),
(7, '7004', 'TECH', 'Cyber Security and the Web',20, '2023-03-16 11:50:10'),
(8, '7009', 'TECH', 'MSc Dissertation in Computing Subjects',60, '2023-03-16 11:50:20');

-- --------------------------------------------------------

--
-- Table structure for table `my_settings`
--

CREATE TABLE `my_settings` (
  `id` int(30) NOT NULL,
  `name` text NOT NULL,
  `email` varchar(200) NOT NULL,
  `cover_img` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `my_settings`
--

INSERT INTO `my_settings` (`id`, `name`, `email`, `cover_img`) VALUES
(1, 'MSc Computer Science Grading System', 'otesiri@sample.comm', '1605927120_avatar.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(30) NOT NULL,
  `firstname` varchar(200) NOT NULL,
  `lastname` varchar(200) NOT NULL,
  `middlename` varchar(200) NOT NULL,
  `username` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` text NOT NULL,
  `user_type` int(1) NOT NULL DEFAULT 1,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`,`middlename`, `username`,`email`, `password`, `user_type`, `date_created`) VALUES
(1, 'Otesiri', 'Okposio','O', 'adm','otesiri@sample.comm', '0192023a7bbd73250516f069df18b500', 1, '2023-04-20 13:25:41'),
(2, 'GoodChild', 'K', 'Trent', 'tre','trent@sample.comm', '0192023a7bbd73250516f069df18b500', 3, '2023-04-20 13:27:40');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `results`
--
ALTER TABLE `results`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `result_items`
--
ALTER TABLE `result_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `modules`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `my_settings`
--
ALTER TABLE `my_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `results`
--
ALTER TABLE `results`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `result_items`
--
ALTER TABLE `result_items`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `modules`
--
ALTER TABLE `modules`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `my_settings`
--
ALTER TABLE `my_settings`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
