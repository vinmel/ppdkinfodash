-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jul 13, 2023 at 01:01 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `odss_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `documents`
--

CREATE TABLE `documents` (
  `document_id` int(11) NOT NULL,
  `title` varchar(200) NOT NULL,
  `description` text NOT NULL,
  `file_json` text NOT NULL,
  `user_id` int(30) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `recipient` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `documents`
--

INSERT INTO `documents` (`document_id`, `title`, `description`, `file_json`, `user_id`, `date_created`, `recipient`) VALUES
(5, 'test', '								asdas							', '[\"1686498060_Atomic_Habits_by_James_Clear-1.pdf\"]', 1, '2023-06-11 23:41:56', ''),
(15, '              PHP book', 'Learning php', '[\"1688564220_PHP and MySQL Web Development_ Master the Concepts of PHP_ A Step By Step Process ( PDFDrive ).pdf\"]', 5, '2023-07-05 21:37:20', ''),
(18, '              PHP ', 'Learning php', '[\"1688650920_PHP and MySQL Web Development_ Master the Concepts of PHP_ A Step By Step Process ( PDFDrive ).pdf\"]', 2, '2023-07-06 21:42:54', ''),
(29, '                           Book Of PHP', '								Learning others							', '[\"1688903520_Laravel 5.1 Beauty_ Creating Beautiful Web Apps with Laravel 5.1 ( PDFDrive ).pdf\"]', 2, '2023-07-09 19:52:59', '');

-- --------------------------------------------------------

--
-- Table structure for table `shared_files`
--

CREATE TABLE `shared_files` (
  `id` int(11) NOT NULL,
  `recipient` varchar(255) NOT NULL,
  `document_id` int(11) NOT NULL,
  `assigned_date` datetime NOT NULL DEFAULT current_timestamp(),
  `is_deleted` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `shared_files`
--

INSERT INTO `shared_files` (`id`, `recipient`, `document_id`, `assigned_date`, `is_deleted`) VALUES
(13, '4', 29, '2023-07-09 22:44:49', 0),
(14, '4', 18, '2023-07-09 22:51:08', 0),
(15, '3', 18, '2023-07-09 22:51:11', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(30) NOT NULL,
  `firstname` varchar(200) NOT NULL,
  `lastname` varchar(200) NOT NULL,
  `middlename` varchar(200) NOT NULL,
  `contact` varchar(100) NOT NULL,
  `address` text NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` text NOT NULL,
  `type` tinyint(1) DEFAULT 3 COMMENT '1=Admin,2=User Level 1,3=User Level 2',
  `avatar` text NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `middlename`, `contact`, `address`, `email`, `password`, `type`, `avatar`, `date_created`) VALUES
(1, 'Admin', 'Melvin', '', '+12354654787', 'Sample', 'admin@admin.com', '0192023a7bbd73250516f069df18b500', 1, '', '2020-11-11 15:35:19'),
(2, 'John', 'Smith', 'C', '+14526-5455-44', 'Address', 'jsmith@sample.com', '25d55ad283aa400af464c76d713c07ad', 2, '1605080820_avatar.jpg', '2020-11-11 09:24:40'),
(3, 'MARCO', 'SAM', '', '012312312332', 'kuching sarawak', 'marco_polo@gmail.com', '25f9e794323b453885f5181f1b624d0b', 3, '1683250260_tikurak.jpg', '2023-05-05 09:31:00'),
(4, 'MERVIN ', 'ROVER', '', '380192840-9182', 'kuching sarwak', 'mervin@gmail.com', '25f9e794323b453885f5181f1b624d0b', 3, '', '2023-06-15 22:04:09'),
(5, 'Paul', 'Solos', 'L', '80890-90-', 'Batu Kawa', 'paul@solos.com', '25d55ad283aa400af464c76d713c07ad', 2, '', '2023-07-01 18:28:38');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `documents`
--
ALTER TABLE `documents`
  ADD PRIMARY KEY (`document_id`);

--
-- Indexes for table `shared_files`
--
ALTER TABLE `shared_files`
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
-- AUTO_INCREMENT for table `documents`
--
ALTER TABLE `documents`
  MODIFY `document_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `shared_files`
--
ALTER TABLE `shared_files`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
