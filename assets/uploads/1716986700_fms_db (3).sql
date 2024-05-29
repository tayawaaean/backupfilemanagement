-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 29, 2024 at 09:33 AM
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
(43, 'Aean Gabrielle D. Tayawa', 'Admin', '2024-05-24 17:35:41', 'Document Deleted', 'Deleted FORM 8 WITH ENGINEER and COE in Test folder'),
(44, 'Aean Gabrielle D. Tayawa', 'Admin', '2024-05-24 17:38:06', 'Folder Deleted', 'Deleted folder Test'),
(45, 'Aean Gabrielle D. Tayawa', 'Admin', '2024-05-24 17:41:57', 'File Uploaded', 'Uploaded file FORM 8 WITH ENGINEER and COE.docx in folder ID 14'),
(46, 'Aean Gabrielle D. Tayawa', 'Admin', '2024-05-24 17:52:34', 'Folder Created', 'Created folder Okay'),
(47, 'Aean Gabrielle D. Tayawa', 'Admin', '2024-05-24 17:52:54', 'Folder Updated', 'Updated folder Okayed'),
(48, 'Aean Gabrielle D. Tayawa', 'Admin', '2024-05-24 17:57:21', 'File Renamed', 'Renamed file to FORM 8 WITH and COE.docx in folder ID 0'),
(49, 'Aean Gabrielle D. Tayawa', 'Admin', '2024-05-24 18:05:40', 'Shared a File', 'Shared file ID 20 with new description: testing');

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
(17, 'TCW-CHAPTER-1', '', 8, 12, 'pptx', '1715433540_TCW-CHAPTER-1.pptx', 0, '2024-05-11 21:19:54'),
(18, 'Chapter-I', '', 8, 12, 'docx', '1715433660_Chapter-I.docx', 0, '2024-05-11 21:21:07'),
(19, 'Chapter-I ||1', '', 8, 12, 'docx', '1715433900_Chapter-I.docx', 0, '2024-05-11 21:25:15'),
(20, 'FORM 8 WITH and COE', 'testing', 5, 0, 'docx', '1716564060_FORM 8 WITH ENGINEER and COE.docx', 1, '2024-05-25 00:05:40'),
(25, 'FORM 8 WITH ENGINEER and COE', 'test', 5, 14, 'docx', '1716565260_FORM 8 WITH ENGINEER and COE.docx', 0, '2024-05-24 23:41:57');

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
(12, 8, 'test', 0),
(14, 5, 'Test', 0),
(15, 5, 'Okayed', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(30) NOT NULL,
  `profile_pic` varchar(128) NOT NULL,
  `name` varchar(200) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(200) NOT NULL,
  `type` tinyint(1) NOT NULL DEFAULT 2 COMMENT '1+admin , 2 = users',
  `contact_number` varchar(20) NOT NULL,
  `email` varchar(128) NOT NULL,
  `address` text NOT NULL,
  `position` varchar(50) NOT NULL,
  `birthday` varchar(50) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `civil_status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `profile_pic`, `name`, `username`, `password`, `type`, `contact_number`, `email`, `address`, `position`, `birthday`, `gender`, `civil_status`) VALUES
(5, 'profile_pics/profile_picture_206776.png', 'Aean Gabrielle D. Tayawa', 'tayawaaean', '202cb962ac59075b964b07152d234b70', 1, '', '', '', '', '', '', ''),
(8, 'profile_pics/profile_picture_550633.png', 'Micheal Jay Pedronan', 'mekel', '202cb962ac59075b964b07152d234b70', 2, '095668317230', 'mekel@gmail.com', 'Batac City', 'President', '2024-05-29', 'male', 'single'),
(11, 'profile_picture_672602.png', 'Kenric Catiwa', 'kenken', '202cb962ac59075b964b07152d234b70', 2, '', '', '', '', '', '', ''),
(13, '', 'Ryan Anthony Gabriel Adaya', 'ryan', '827ccb0eea8a706c4c34a16891f84e7b', 2, '', '', '', '', '', '', ''),
(20, 'profile_pics/profile_picture_614861.jpg', 'Jandel Jade Tejada', 'jjadetejada', '202cb962ac59075b964b07152d234b70', 0, '', '', '', '', '', '', '');

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
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `files`
--
ALTER TABLE `files`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `folders`
--
ALTER TABLE `folders`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
