-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 24, 2020 at 03:22 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `classroom`
--

-- --------------------------------------------------------

--
-- Table structure for table `assignmentnotice`
--

CREATE TABLE `assignmentnotice` (
  `postId` int(20) NOT NULL,
  `postText` text NOT NULL,
  `file` blob NOT NULL,
  `dueDate` timestamp(6) NOT NULL DEFAULT current_timestamp(6) ON UPDATE current_timestamp(6)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `class`
--

CREATE TABLE `class` (
  `courseId` varchar(20) NOT NULL,
  `classId` varchar(20) NOT NULL,
  `section` int(3) NOT NULL,
  `time` time NOT NULL,
  `roomNo` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `postId` int(20) NOT NULL,
  `commiterId` int(20) NOT NULL,
  `comments` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `enrollstudent`
--

CREATE TABLE `enrollstudent` (
  `classId` varchar(20) NOT NULL,
  `nsuId` int(11) NOT NULL,
  `personId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `examnotice`
--

CREATE TABLE `examnotice` (
  `postId` int(20) NOT NULL,
  `examTimeDate` timestamp(6) NOT NULL DEFAULT current_timestamp(6) ON UPDATE current_timestamp(6),
  `syllabus` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `facultydata`
--

CREATE TABLE `facultydata` (
  `facultyID` int(12) NOT NULL,
  `facultyInitial` varchar(10) NOT NULL,
  `personId` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `person`
--

CREATE TABLE `person` (
  `name` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `phoneNumber` varchar(11) NOT NULL,
  `password` varchar(50) NOT NULL,
  `personId` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE `post` (
  `postId` int(20) NOT NULL,
  `classId` int(20) NOT NULL,
  `createdTime` timestamp(6) NOT NULL DEFAULT current_timestamp(6) ON UPDATE current_timestamp(6),
  `createdBy` int(20) NOT NULL,
  `priority` int(10) NOT NULL,
  `material` blob NOT NULL,
  `postText` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `studentdata`
--

CREATE TABLE `studentdata` (
  `nsuId` int(11) NOT NULL,
  `personId` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `takeclass`
--

CREATE TABLE `takeclass` (
  `classId` varchar(20) NOT NULL,
  `personId` varchar(20) NOT NULL,
  `facultyID` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `class`
--
ALTER TABLE `class`
  ADD PRIMARY KEY (`classId`);

--
-- Indexes for table `facultydata`
--
ALTER TABLE `facultydata`
  ADD PRIMARY KEY (`facultyID`);

--
-- Indexes for table `person`
--
ALTER TABLE `person`
  ADD PRIMARY KEY (`personId`);

--
-- Indexes for table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`postId`);

--
-- Indexes for table `studentdata`
--
ALTER TABLE `studentdata`
  ADD PRIMARY KEY (`nsuId`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
