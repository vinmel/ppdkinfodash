-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jul 05, 2023 at 12:53 AM
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
(2, 'Sample documents', '																																&lt;h2&gt;&lt;b&gt;Sample Header&amp;nbsp;&lt;/b&gt;&lt;/h2&gt;&lt;p style=&quot;text-align: justify; &quot;&gt;&lt;font color=&quot;#000000&quot; face=&quot;Open Sans, Arial, sans-serif&quot;&gt;&lt;span style=&quot;font-size: 14px;&quot;&gt;Test first&lt;/span&gt;&lt;/font&gt;&lt;/p&gt;																																											', '[\"1605080340_Sample_Doc.doc\",\"1605080340_sample_pdf_file.pdf\"]', 1, '2020-11-11 15:39:50', ''),
(5, 'test', '								asdas							', '[\"1686498060_Atomic_Habits_by_James_Clear-1.pdf\"]', 3, '2023-06-11 23:41:56', ''),
(8, '              Airport chart', 'WBGS airport chart&amp;nbsp;', '[\"1688212320_WBGS LIST OF CHTS.pdf\"]', 5, '2023-07-01 19:53:40', ''),
(12, '              Cobaan ', '								File mengandungi file&amp;nbsp;							', '[\"1688219880_Atomic_Habits_by_James_Clear-1.pdf\"]', 2, '2023-07-01 21:58:23', ''),
(13, '             SUBa', 'Test2', '[\"1688481120_Catalog 2021.pdf\"]', 2, '2023-07-04 22:33:01', '');

-- --------------------------------------------------------

--
-- Table structure for table `shared_files`
--

CREATE TABLE `shared_files` (
  `id` int(11) NOT NULL,
  `recipient` varchar(255) NOT NULL,
  `document_id` int(11) NOT NULL,
  `assigned_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `shared_files`
--

INSERT INTO `shared_files` (`id`, `recipient`, `document_id`, `assigned_date`) VALUES
(2, '4', 8, '2023-07-01 21:06:02'),
(3, '', 12, '2023-07-04 22:26:17'),
(4, '4', 12, '2023-07-04 22:27:21'),
(5, '4', 12, '2023-07-04 22:28:04'),
(6, '4', 12, '2023-07-04 22:29:12'),
(7, '4', 12, '2023-07-04 22:30:00'),
(8, '3', 13, '2023-07-04 22:33:12'),
(9, '3', 12, '2023-07-04 22:36:07'),
(10, '4', 13, '2023-07-04 23:23:39');

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
(1, 'Admin', 'Aja', '', '+12354654787', 'Sample', 'admin@admin.com', '0192023a7bbd73250516f069df18b500', 1, '', '2020-11-11 15:35:19'),
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
  MODIFY `document_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `shared_files`
--
ALTER TABLE `shared_files`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
