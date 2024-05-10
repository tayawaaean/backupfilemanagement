-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 10, 2024 at 06:25 PM
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
-- Database: `fms_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `activity_log`
--

CREATE TABLE `activity_log` (
  `id` int(255) NOT NULL,
  `Author` varchar(255) NOT NULL,
  `job_title` varchar(255) NOT NULL,
  `DateTime` datetime NOT NULL,
  `Action` varchar(255) NOT NULL,
  `Description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `activity_log`
--

INSERT INTO `activity_log` (`id`, `Author`, `job_title`, `DateTime`, `Action`, `Description`) VALUES
(1, 'Aean Gabrielle Tayawa', 'Admin', '2024-04-17 00:38:17', 'New User Approved', 'Dexter John Perdido'),
(2, 'Dexter John Perdido', 'User', '2024-04-17 18:38:17', 'Document Deleted', 'MMSU Waiver.docx'),
(3, 'Kenric Catiwa', 'User', '2024-04-17 18:43:14', 'Document Upload', 'Ma\'am Abbie Assignment.pdf'),
(18, 'Aean Gabrielle D. Tayawa', 'Admin', '2024-04-20 23:14:07', 'New User Approved', 'Kimberly Mae B. Reodique'),
(21, 'Aean Gabrielle D. Tayawa', 'Admin', '2024-04-20 23:31:29', 'New User Approved', 'Ryan Anthony Gabriel B. Adaya'),
(22, 'Aean Gabrielle D. Tayawa', 'Admin', '2024-04-20 23:34:38', 'New User Denied', 'Ryan Anthony Gabriel B. Adaya'),
(23, 'mekel', 'Employee', '2024-04-22 14:59:00', 'Profile Updated', 'mekel'),
(24, 'Micheal Jay A. Pedronan', 'Employee', '2024-04-22 15:51:17', 'Profile Updated', 'Micheal Jay A. Pedronan'),
(25, 'Micheal Jay A. Pedronan', 'Employee', '2024-04-22 22:10:16', 'Profile Updated', 'Micheal Jay A. Pedronan'),
(26, 'Aean Gabrielle D. Tayawa', 'Admin', '2024-04-22 22:13:36', 'New User Approved', 'Kimberly Mae B. Reodique'),
(27, 'Aean Gabrielle D. Tayawa', 'Admin', '2024-04-22 22:15:00', 'New User Approved', 'Kimberly Mae B. Reodique'),
(28, 'Micheal Jay A. Pedronan', 'Employee', '2024-05-01 21:52:16', 'Profile Updated', 'Micheal Jay A. Pedronan'),
(29, 'Micheal Jay A. Pedronan', '', '2024-05-01 23:52:09', 'Uploaded a new file', 'test'),
(30, 'Micheal Jay A. Pedronan', 'Employee', '2024-05-01 23:54:23', 'Uploaded a new file', 'test'),
(31, 'Micheal Jay A. Pedronan', 'Employee', '2024-05-02 01:48:20', 'Uploaded Multiple Files', 'test'),
(32, 'Micheal Jay A. Pedronan', 'Employee', '2024-05-02 02:04:06', 'Created A New Folder', 'New Folder'),
(33, 'Micheal Jay A. Pedronan', 'Employee', '2024-05-07 20:50:37', 'Uploaded a new file', ''),
(34, 'Micheal Jay A. Pedronan', 'Employee', '2024-05-07 20:58:04', 'Uploaded a new file', 'test'),
(35, 'Micheal Jay A. Pedronan', 'Employee', '2024-05-07 21:05:57', 'Created A New Folder', 'final test'),
(36, 'Micheal Jay A. Pedronan', 'Employee', '2024-05-10 02:06:19', 'Created A New Folder', 'as');

-- --------------------------------------------------------

--
-- Table structure for table `files`
--

CREATE TABLE `files` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `description` text NOT NULL,
  `user_id` int(30) NOT NULL,
  `folder_id` int(30) NOT NULL,
  `file_type` varchar(50) NOT NULL,
  `file_path` text NOT NULL,
  `is_public` tinyint(1) DEFAULT 0,
  `date_updated` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `files`
--

INSERT INTO `files` (`id`, `name`, `description`, `user_id`, `folder_id`, `file_type`, `file_path`, `is_public`, `date_updated`) VALUES
(1, 'sample pdf file', 'Sample file uploaded', 1, 1, 'pdf', '1600320360_1600314660_sample.pdf', 1, '2020-09-17 16:22:26'),
(3, 'sample', 'Sample PDF Document', 3, 9, 'pdf', '1600330200_sample.pdf', 0, '2020-09-17 16:10:25'),
(4, 'New Microsoft Word Document', '', 1, 10, 'docx', '1715174520_New Microsoft Word Document.docx', 0, '2024-05-08 21:22:52'),
(5, '1b90', 'tite', 1, 10, 'pdf', '1715174580_1b90.pdf', 0, '2024-05-08 21:23:51'),
(6, '1CanjKtPVzu_8JAWsBVGdpRuEwKJso7U-jVN8TE9JjD0', '', 1, 11, 'pdf', '1715174700_1CanjKtPVzu_8JAWsBVGdpRuEwKJso7U-jVN8TE9JjD0.pdf', 0, '2024-05-08 21:25:02'),
(7, 'fms_db', 'hehe', 8, 12, 'sql', '1715355000_fms_db.sql', 1, '2024-05-10 23:30:39');

-- --------------------------------------------------------

--
-- Table structure for table `folders`
--

CREATE TABLE `folders` (
  `id` int(30) NOT NULL,
  `user_id` int(30) NOT NULL,
  `name` varchar(200) NOT NULL,
  `parent_id` int(30) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `folders`
--

INSERT INTO `folders` (`id`, `user_id`, `name`, `parent_id`) VALUES
(1, 1, 'Sample Folder', 0),
(3, 1, 'Sample Folder 3', 0),
(5, 1, 'Sample Folder 4', 0),
(6, 1, 'New Folder', 1),
(7, 1, 'Folder 1', 1),
(8, 1, 'test folder', 7),
(9, 3, 'My Folder 1', 0),
(10, 1, 'subfolder', 6),
(11, 1, 'tite', 8),
(12, 8, 'test', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(30) NOT NULL,
  `name` varchar(200) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(200) NOT NULL,
  `type` tinyint(1) NOT NULL DEFAULT 2 COMMENT '1+admin , 2 = users'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `password`, `type`) VALUES
(5, 'Aean Gabrielle D. Tayawa', 'tayawaaean', '202cb962ac59075b964b07152d234b70', 1),
(8, 'Micheal Jay Pedronan', 'mekel', '202cb962ac59075b964b07152d234b70', 2),
(11, 'Kenric Catiwa', 'kenken', '202cb962ac59075b964b07152d234b70', 2),
(12, 'Kimberly Reodique', 'kimmy', '827ccb0eea8a706c4c34a16891f84e7b', 2),
(13, 'Ryan Anthony Gabriel Adaya', 'ryan', '827ccb0eea8a706c4c34a16891f84e7b', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activity_log`
--
ALTER TABLE `activity_log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `files`
--
ALTER TABLE `files`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `folders`
--
ALTER TABLE `folders`
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
-- AUTO_INCREMENT for table `activity_log`
--
ALTER TABLE `activity_log`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `files`
--
ALTER TABLE `files`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `folders`
--
ALTER TABLE `folders`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
