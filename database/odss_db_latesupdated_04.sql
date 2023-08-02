-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Aug 02, 2023 at 10:18 PM
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
  `updated_at` datetime DEFAULT NULL,
  `is_deleted` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `documents`
--

INSERT INTO `documents` (`document_id`, `title`, `description`, `file_json`, `user_id`, `date_created`, `updated_at`, `is_deleted`) VALUES
(5, '                            test', '																								asdas 22 updated test today date', '[\"1689738300_Test upload.docx\"]', 1, '2023-06-11 23:41:56', '2023-07-19 11:45:16', 0),
(15, '                            PHP book', '								Learning php							', '[\"1689492300_Test upload.docx\"]', 5, '2023-07-05 21:37:20', '2023-07-16 15:25:23', 0),
(18, '                                          PHP ', '																Learning php test1 updated							', '[\"1689760020_Test upload.docx\"]', 2, '2023-07-06 21:42:54', '2023-07-19 17:47:54', 0),
(29, '                                                                                                                             Book Of PHP', '																																																&lt;p&gt;																Learning others updated 15/7/2023 terbaru lagi satu&lt;/p&gt;																																										', '[\"1689408840_CBOP3103 Object-Oriented Approach in Software Development_cDec15(rs).pdf\"]', 2, '2023-07-09 19:52:59', '2023-07-15 16:40:18', 0),
(31, '              Test upload 2', '								Data in test							', '[\"1689477360_ON SITE SERVICE.docx\"]', 2, '2023-07-16 11:16:05', '2023-07-16 13:40:39', 0),
(32, 'Docu1', 'Latest one to see latest updated.&amp;nbsp;', '[\"1689485940_ON SITE SERVICE.docx\"]', 2, '2023-07-16 13:39:58', '0000-00-00 00:00:00', 0),
(33, ' New Document 1      ', '																This only uploads to see whether the updated date follows the format. Yes it does congrats.', '[\"1689502080_Test upload.docx\"]', 5, '2023-07-16 17:58:43', '2023-07-31 23:12:36', 0),
(34, 'Test EXCEL', 'Cubaan pertama kali format excel.', '[\"1690017180_test.xlsx\"]', 2, '2023-07-22 17:13:10', NULL, 0),
(35, 'Powerpoint ', '								New powerpoint test&amp;nbsp; updated latest', '[\"1690017300_test.pptx\"]', 2, '2023-07-22 17:15:16', '2023-07-23 23:00:04', 0);

-- --------------------------------------------------------

--
-- Table structure for table `schools_info`
--

CREATE TABLE `schools_info` (
  `id` int(11) NOT NULL,
  `schools_type` varchar(100) NOT NULL,
  `total` int(11) NOT NULL,
  `table_no` int(11) NOT NULL,
  `date_updated` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `schools_info`
--

INSERT INTO `schools_info` (`id`, `schools_type`, `total`, `table_no`, `date_updated`) VALUES
(1, 'SK', 41, 1, '2023-07-23 16:51:13'),
(2, 'SJK(C)', 12, 1, '2023-07-23 16:51:13'),
(3, 'SK(M)', 6, 1, '2023-07-23 16:51:13'),
(4, 'SK(A)', 1, 1, '2023-07-23 16:51:13'),
(5, 'SKPK', 1, 1, '2023-07-23 16:51:13'),
(6, 'SMK', 18, 1, '2023-07-23 16:51:13'),
(7, 'SMK(M)', 4, 2, '2023-07-23 16:51:13'),
(8, 'SMK(A)', 1, 2, '2023-07-23 16:51:13'),
(9, 'KOLEJ(A)', 1, 2, '2023-07-23 16:51:13'),
(10, 'SEKOLAH SENI', 1, 2, '2023-07-23 16:51:13'),
(11, 'KOLEJ VOKASIONAL', 1, 2, '2023-07-23 16:51:13'),
(12, 'SMT', 1, 2, '2023-07-23 16:51:14');

--
-- Triggers `schools_info`
--
DELIMITER $$
CREATE TRIGGER `updated_date_updated` BEFORE UPDATE ON `schools_info` FOR EACH ROW BEGIN
SET New.date_updated = CURRENT_TIMESTAMP();
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `shared_files`
--

CREATE TABLE `shared_files` (
  `id` int(11) NOT NULL,
  `recipient` varchar(255) NOT NULL,
  `document_id` int(11) NOT NULL,
  `assigned_date` datetime NOT NULL DEFAULT current_timestamp(),
  `is_deleted` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `created_by` int(30) NOT NULL DEFAULT 2
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `shared_files`
--

INSERT INTO `shared_files` (`id`, `recipient`, `document_id`, `assigned_date`, `is_deleted`, `created_at`, `created_by`) VALUES
(13, '4', 29, '2023-07-09 22:44:49', 1, '2023-07-15 15:44:31', 2),
(14, '4', 18, '2023-07-09 22:51:08', 0, '2023-07-15 15:44:31', 2),
(15, '3', 18, '2023-07-09 22:51:11', 1, '2023-07-15 15:44:31', 2),
(16, '3', 29, '2023-07-15 16:03:23', 0, '2023-07-15 16:03:23', 2),
(17, '3', 15, '2023-07-16 15:25:35', 0, '2023-07-16 15:25:35', 5),
(18, '3', 18, '2023-07-17 21:29:28', 1, '2023-07-17 21:29:28', 2),
(19, '3', 34, '2023-07-22 17:13:31', 0, '2023-07-22 17:13:31', 2),
(20, '4', 34, '2023-07-22 17:13:58', 0, '2023-07-22 17:13:58', 2),
(21, '3', 35, '2023-07-22 17:15:40', 0, '2023-07-22 17:15:40', 2),
(22, '4', 35, '2023-07-22 17:18:01', 0, '2023-07-22 17:18:01', 2),
(24, '4', 33, '2023-07-31 23:11:12', 0, '2023-07-31 23:11:12', 5);

-- --------------------------------------------------------

--
-- Table structure for table `staff_info`
--

CREATE TABLE `staff_info` (
  `id` int(11) NOT NULL,
  `edu` int(11) NOT NULL,
  `adm` int(11) NOT NULL,
  `it` int(11) NOT NULL,
  `eng` int(11) NOT NULL,
  `tcsec_schl` int(11) NOT NULL,
  `tcpm_schl` int(11) NOT NULL,
  `tot_student` int(11) NOT NULL,
  `date_updated` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `staff_info`
--

INSERT INTO `staff_info` (`id`, `edu`, `adm`, `it`, `eng`, `tcsec_schl`, `tcpm_schl`, `tot_student`, `date_updated`) VALUES
(1, 57, 28, 66, 3, 2550, 3810, 89000, '2023-07-27 23:02:39');

--
-- Triggers `staff_info`
--
DELIMITER $$
CREATE TRIGGER `update_date_updated` BEFORE UPDATE ON `staff_info` FOR EACH ROW BEGIN
  SET NEW.date_updated = CURRENT_TIMESTAMP();
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(30) NOT NULL,
  `salutation` varchar(11) NOT NULL,
  `firstname` varchar(200) NOT NULL,
  `lastname` varchar(200) NOT NULL,
  `middlename` varchar(200) NOT NULL,
  `gender` varchar(100) NOT NULL,
  `grade` varchar(100) NOT NULL,
  `dob` date DEFAULT NULL,
  `contact` varchar(100) NOT NULL,
  `address` text NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` text NOT NULL,
  `type` tinyint(1) DEFAULT 3 COMMENT '1=Admin,2=User Level 1,3=User Level 2',
  `avatar` text NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `isActive` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `salutation`, `firstname`, `lastname`, `middlename`, `gender`, `grade`, `dob`, `contact`, `address`, `email`, `password`, `type`, `avatar`, `date_created`, `isActive`) VALUES
(1, '', 'Admin', 'Melvin', '', '', '', NULL, '+12354654787', 'Sample', 'admin@admin.com', '0192023a7bbd73250516f069df18b500', 1, '', '2020-11-11 15:35:19', 1),
(2, 'Mr', 'John', 'Smith', 'Cor', 'Male', 'N32', '1985-05-23', '+14526-5455-44', 'Kuching , Sarawak', 'jsmith@sample.com', '25d55ad283aa400af464c76d713c07ad', 2, '1605080820_avatar.jpg', '2020-11-11 09:24:40', 1),
(3, '', 'MARCO', 'MEDING', 'SAMEON', '', '', NULL, '012312312332', 'kuching sarawak', 'marco_polo@gmail.com', '25f9e794323b453885f5181f1b624d0b', 3, '1683250260_tikurak.jpg', '2023-05-05 09:31:00', 1),
(4, '', 'MERVIN ', 'ROVER', 'ANAK', '', '', NULL, '380192840-9182', 'kuching sarwak', 'mervin@gmail.com', '25f9e794323b453885f5181f1b624d0b', 3, '', '2023-06-15 22:04:09', 1),
(5, '', 'Paul', 'Solos', 'L', '', '', NULL, '80890-90-', 'Batu Kawa', 'paul@solos.com', '25d55ad283aa400af464c76d713c07ad', 2, '', '2023-07-01 18:28:38', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `documents`
--
ALTER TABLE `documents`
  ADD PRIMARY KEY (`document_id`);

--
-- Indexes for table `schools_info`
--
ALTER TABLE `schools_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shared_files`
--
ALTER TABLE `shared_files`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `staff_info`
--
ALTER TABLE `staff_info`
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
  MODIFY `document_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `schools_info`
--
ALTER TABLE `schools_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `shared_files`
--
ALTER TABLE `shared_files`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `staff_info`
--
ALTER TABLE `staff_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
