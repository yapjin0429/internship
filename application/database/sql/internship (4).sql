-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 25, 2021 at 10:56 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `internship`
--

-- --------------------------------------------------------

--
-- Table structure for table `artwork`
--

CREATE TABLE `artwork` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `artwork_title` varchar(255) NOT NULL,
  `artwork_description` text NOT NULL,
  `artwork_image` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `artwork`
--

INSERT INTO `artwork` (`id`, `user_id`, `artwork_title`, `artwork_description`, `artwork_image`, `created_at`) VALUES
(35, 23, 'volkswagen', 'mk7 gti', 'http://localhost/internship/image/111004911.jpg', '2021-01-21 06:49:29');

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `artwork_id` int(11) NOT NULL,
  `body` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`id`, `user_id`, `artwork_id`, `body`, `created_at`) VALUES
(7, 22, 11, 'wow nice car', '2021-01-07 06:05:20'),
(8, 22, 11, 'great job', '2021-01-07 06:05:25'),
(9, 22, 33, 'fantastic', '2021-01-07 06:29:09'),
(10, 22, 33, 'amazing', '2021-01-07 06:29:14'),
(11, 22, 11, 'fantastic', '2021-01-07 07:04:09'),
(12, 22, 11, 'fast car', '2021-01-07 07:17:01'),
(13, 22, 34, 'aggresive', '2021-01-07 07:20:44'),
(15, 23, 35, 'Nice haha', '2021-02-05 06:10:57');

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

CREATE TABLE `company` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `active` tinyint(1) NOT NULL,
  `activation_code` varchar(255) NOT NULL,
  `password_reset_code` varchar(255) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `company`
--

INSERT INTO `company` (`id`, `email`, `password`, `name`, `active`, `activation_code`, `password_reset_code`, `date_created`) VALUES
(4, 'tp049944@mail.apu.edu.my', '6ff601dcc1025dc81acbbdabb8778a55fea93ba27de4d13a5294afdaa347cc34d806675503b9085d9f5a660df8f1588f9ab086b57c590a15825e7c45bd8275dbgKSO/arzN4wG9WQHZZo3OBtJuYswDIpHq37NDUmaPHc=', 'Intel', 1, '', '', '2021-01-15 06:53:27'),
(6, '2@mail.apu.edu.my', 'ef8c57432ede6cd534ac58ed4b2ea7e47ef844f4d05804d227b4ff630f9c8d478e09d077e8f3b4d2d9056a228ecab98f0304179507d6464d5a0c68ef9f67fbe2Jim4Tbid9JI0DHn3XFL1+UNaQOFaDjGi7f4STwN8j1w=', 'vitrox', 1, '', '', '2021-01-19 03:57:49'),
(12, '1@gmail.com', '64e76f1519efe63471348cc53b4311cac417084257fc5fe18ea2bd633811e02327bde1abd76c5440133cb82d9b73747a2e9821e7a5924c1516d20cba7c2f8ad3bCuI+K+OeEFFaXoNc3r7YmWspnT/Q31evjNn02EOzuc=', 'uwc', 1, '', '', '2021-01-21 03:31:00');

-- --------------------------------------------------------

--
-- Table structure for table `company_offer`
--

CREATE TABLE `company_offer` (
  `id` int(11) NOT NULL,
  `job_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `offered_on` datetime NOT NULL DEFAULT current_timestamp(),
  `status` varchar(255) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `company_offer`
--

INSERT INTO `company_offer` (`id`, `job_id`, `user_id`, `company_id`, `offered_on`, `status`) VALUES
(17, 20, 23, 4, '2021-01-29 12:42:55', '1'),
(18, 19, 23, 4, '2021-01-29 16:22:08', '2');

-- --------------------------------------------------------

--
-- Table structure for table `company_profile`
--

CREATE TABLE `company_profile` (
  `id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `company_logo` varchar(255) NOT NULL,
  `nature_of_business` varchar(255) NOT NULL,
  `company_type` varchar(255) NOT NULL,
  `company_size` varchar(255) NOT NULL,
  `working_hour` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `company_profile`
--

INSERT INTO `company_profile` (`id`, `company_id`, `company_logo`, `nature_of_business`, `company_type`, `company_size`, `working_hour`) VALUES
(1, 4, 'http://localhost/internship/image/company_logo/logo2.png', 'business', 'big', '112', '1'),
(2, 6, 'http://localhost/internship/image/company_logo/vitrox3.png', 'tech', 'big', 'big', '10'),
(11, 12, 'http://localhost/internship/image/company_logo/uwc15.jpg', 'technology', 'big', 'big', '1212');

-- --------------------------------------------------------

--
-- Table structure for table `company_saved_intern`
--

CREATE TABLE `company_saved_intern` (
  `id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `company_saved_intern`
--

INSERT INTO `company_saved_intern` (`id`, `company_id`, `user_id`, `date_created`) VALUES
(7, 12, 23, '2021-01-26 10:04:58'),
(8, 4, 23, '2021-01-27 04:03:08'),
(10, 4, 22, '2021-02-08 06:48:46');

-- --------------------------------------------------------

--
-- Table structure for table `fb`
--

CREATE TABLE `fb` (
  `id` int(11) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `birthyear` varchar(255) NOT NULL,
  `birthdate` varchar(255) NOT NULL,
  `languages` text NOT NULL,
  `interested` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `fb`
--

INSERT INTO `fb` (`id`, `gender`, `birthyear`, `birthdate`, `languages`, `interested`) VALUES
(1, 'Male', '1996', '30 January', 'English, Malay, Chinese, Cantonese', 'Female');

-- --------------------------------------------------------

--
-- Table structure for table `job`
--

CREATE TABLE `job` (
  `id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `job_title` varchar(255) NOT NULL,
  `allowance` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `job_posting_date` datetime NOT NULL,
  `job_posting_valid_until` datetime NOT NULL,
  `requirements` text NOT NULL,
  `responsibility` text NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `job`
--

INSERT INTO `job` (`id`, `company_id`, `job_title`, `allowance`, `location`, `job_posting_date`, `job_posting_valid_until`, `requirements`, `responsibility`, `status`) VALUES
(18, 6, 'lawyer', '2000', 'kl', '2021-01-01 00:00:00', '2021-01-27 00:00:00', '1', '1', '1'),
(19, 4, 'lawyer', '2000', 'kl', '2021-01-01 00:00:00', '2021-01-22 00:00:00', '1', '1', '2'),
(20, 4, 'accountant', '2000', 'kl', '2021-01-01 00:00:00', '2021-01-21 00:00:00', '1\r\n', '1', '1');

-- --------------------------------------------------------

--
-- Table structure for table `profile`
--

CREATE TABLE `profile` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `university` varchar(255) DEFAULT NULL,
  `major_course` varchar(255) DEFAULT NULL,
  `skills` longtext DEFAULT NULL,
  `experience` longtext DEFAULT NULL,
  `intro` longtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `profile`
--

INSERT INTO `profile` (`id`, `user_id`, `university`, `major_course`, `skills`, `experience`, `intro`) VALUES
(8, 22, 'APU University', 'Software Engineering', 'web development', 'student', 'hi');

-- --------------------------------------------------------

--
-- Table structure for table `test_todolist`
--

CREATE TABLE `test_todolist` (
  `id` int(11) NOT NULL,
  `content` text NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `test_todolist`
--

INSERT INTO `test_todolist` (`id`, `content`, `created_at`) VALUES
(124, 'cxvsrtwesfds', '2021-02-23 23:00:13'),
(126, 'xcvbdfrtfxbzxcsf', '2021-02-23 23:18:46'),
(127, 'cvb', '2021-02-23 23:20:26'),
(131, 'cvxcx', '2021-02-25 10:51:18');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 0,
  `activation_code` varchar(255) NOT NULL,
  `password_reset_code` varchar(255) DEFAULT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `email`, `password`, `first_name`, `last_name`, `active`, `activation_code`, `password_reset_code`, `date_created`) VALUES
(22, 'user@gmail.com', '2bc6f319ec886454e9c89130deab2961cb89ce4928a516701d64228afefd65a817cb4105d420c89b9807b54a15672d655a29246d0b7f08726a99f698d32e36cehGd5u618Q1wmzXrFQCMLRR9pQjQebvoTznt/XF0z43k=', 'yap', 'jin', 1, '', NULL, '2021-01-04 01:43:38'),
(23, 'yapjin6686@gmail.com', '85ed169f47efae1f78ac11ef15c32fedac17c355761d95dc70ca6af842dea6b51ac38d156a36327da6bf447604763a1d81e64c1e125d7c16f9e66ee808f573a968nRuHITo0OJ8NSmG1W51N50nwOISnDl0gbvnb0pBgs=', 'yap', 'jin', 1, '', NULL, '2021-01-20 06:51:25');

-- --------------------------------------------------------

--
-- Table structure for table `user_job`
--

CREATE TABLE `user_job` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `job_id` int(11) NOT NULL,
  `apply_on` datetime NOT NULL DEFAULT current_timestamp(),
  `status` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_job`
--

INSERT INTO `user_job` (`id`, `user_id`, `company_id`, `job_id`, `apply_on`, `status`) VALUES
(15, 23, 4, 20, '2021-02-03 18:11:44', 1),
(16, 23, 4, 19, '2021-02-03 18:13:31', 1),
(17, 22, 4, 19, '2021-02-09 11:40:19', 2);

-- --------------------------------------------------------

--
-- Table structure for table `user_profile`
--

CREATE TABLE `user_profile` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `date_of_birth` date NOT NULL,
  `contact` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `institution` varchar(255) NOT NULL,
  `program` varchar(255) NOT NULL,
  `internship_start` date NOT NULL,
  `internship_end` date NOT NULL,
  `prefer_location` varchar(255) NOT NULL,
  `prefer_allowance` varchar(255) NOT NULL,
  `resume` varchar(255) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_profile`
--

INSERT INTO `user_profile` (`id`, `user_id`, `name`, `date_of_birth`, `contact`, `email`, `institution`, `program`, `internship_start`, `internship_end`, `prefer_location`, `prefer_allowance`, `resume`, `active`) VALUES
(12, 23, 'Yap Yao Jin', '1998-04-29', '012-5952877', 'yapjin6686@gmail.com', 'APU', 'SE', '2021-01-01', '2021-01-01', 'KL', 'RM666', 'http://localhost/internship/image/resume/my-cv1.pdf', 1),
(13, 22, 'Ali', '1999-01-21', '1212', 'yapjin6686@gmail.com', 'UTAR', 'SE', '2021-01-12', '2021-01-12', 'Penang', '1000', 'http://localhost/internship/image/resume/Yaps_Resume.pdf', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `artwork`
--
ALTER TABLE `artwork`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `company_offer`
--
ALTER TABLE `company_offer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `company_profile`
--
ALTER TABLE `company_profile`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `company_saved_intern`
--
ALTER TABLE `company_saved_intern`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fb`
--
ALTER TABLE `fb`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `job`
--
ALTER TABLE `job`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `profile`
--
ALTER TABLE `profile`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `test_todolist`
--
ALTER TABLE `test_todolist`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_job`
--
ALTER TABLE `user_job`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_profile`
--
ALTER TABLE `user_profile`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `artwork`
--
ALTER TABLE `artwork`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT for table `company`
--
ALTER TABLE `company`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `company_offer`
--
ALTER TABLE `company_offer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `company_profile`
--
ALTER TABLE `company_profile`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `company_saved_intern`
--
ALTER TABLE `company_saved_intern`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `fb`
--
ALTER TABLE `fb`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `job`
--
ALTER TABLE `job`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `profile`
--
ALTER TABLE `profile`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `test_todolist`
--
ALTER TABLE `test_todolist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=132;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `user_job`
--
ALTER TABLE `user_job`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `user_profile`
--
ALTER TABLE `user_profile`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
