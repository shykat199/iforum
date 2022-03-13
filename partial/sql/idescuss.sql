-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 13, 2022 at 05:41 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `idescuss`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `categories_id` int(11) NOT NULL,
  `categories_name` varchar(255) NOT NULL,
  `categories_description` varchar(500) NOT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`categories_id`, `categories_name`, `categories_description`, `created`) VALUES
(1, 'Python', 'Python is a high-level general-purpose programming language. Its design philosophy emphasizes code readability with the use of significant indentation. ', '2022-03-08 19:57:59'),
(2, 'Java', 'Java is a high-level, class-based, object-oriented programming language that is designed to have as few implementation dependencies as possible.\r\n', '2022-03-08 19:59:25'),
(3, 'JavaScript', 'JavaScript, often abbreviated JS, is a programming language that is one of the core technologies of the World Wide Web, alongside HTML and CSS.', '2022-03-08 19:59:58');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `comment_id` int(10) NOT NULL,
  `comment_content` text NOT NULL,
  `thread_id` int(10) NOT NULL,
  `time` datetime NOT NULL DEFAULT current_timestamp(),
  `comment_by` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`comment_id`, `comment_content`, `thread_id`, `time`, `comment_by`) VALUES
(1, 'This is a content', 1, '2022-03-10 09:23:50', 35),
(3, 'Reinstall python all package....', 3, '2022-03-10 11:03:41', 35),
(4, 'Re-install java again\r\n', 2, '2022-03-10 11:05:35', 35);

-- --------------------------------------------------------

--
-- Table structure for table `threads`
--

CREATE TABLE `threads` (
  `threads_id` int(10) NOT NULL,
  `threads_title` varchar(255) NOT NULL,
  `threads_desc` text NOT NULL,
  `threads_cat_id` int(20) NOT NULL,
  `threads_user_id` int(20) NOT NULL,
  `timestamp` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `threads`
--

INSERT INTO `threads` (`threads_id`, `threads_title`, `threads_desc`, `threads_cat_id`, `threads_user_id`, `timestamp`) VALUES
(1, 'Unable to install Python.', 'Why i am not able to install python in windows 10?', 1, 35, '2022-03-09 16:43:57'),
(2, 'Unable to install java.', 'Why i am not able to setup java in windows 10.', 2, 35, '2022-03-09 22:04:01'),
(3, 'Unable to install panda.', 'Why panda is not installing in windows 10.', 1, 36, '2022-03-09 22:05:02');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(10) NOT NULL,
  `user_email` varchar(20) NOT NULL,
  `user_pass` varchar(255) NOT NULL,
  `timestamo` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_email`, `user_pass`, `timestamo`) VALUES
(35, 'abc@gmail.com', '$2y$10$iPiqYO2GTPFVbOnUqq3r8uBkjqG6x4WMzC7EquPHt5hNH38S1RstG', '2022-03-11 10:04:28'),
(36, 'hello@gmail.com', '$2y$10$sNP41wtUhuIpysPDZ0bepuKoWGIpZ79JaU.GY1V0ykR1tkl/Nnlgu', '2022-03-11 13:11:43'),
(39, 'mynexff@gmail.com', '$2y$10$WR837SXdrSdrm7vs.gSB/.Nz5tuJDLArUU1kPLCsoRLWiZvZwx3YS', '2022-03-12 13:47:36');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`categories_id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`);

--
-- Indexes for table `threads`
--
ALTER TABLE `threads`
  ADD PRIMARY KEY (`threads_id`);
ALTER TABLE `threads` ADD FULLTEXT KEY `threads_desc` (`threads_desc`,`threads_title`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `user_email` (`user_email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `categories_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `threads`
--
ALTER TABLE `threads`
  MODIFY `threads_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
