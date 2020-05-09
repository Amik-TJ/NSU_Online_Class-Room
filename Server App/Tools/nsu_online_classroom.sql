-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 09, 2020 at 08:27 PM
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
-- Database: `nsu_online_classroom`
--

-- --------------------------------------------------------

--
-- Table structure for table `assignment_notice`
--

CREATE TABLE `assignment_notice` (
  `post_id` varchar(255) NOT NULL,
  `post_text` text NOT NULL,
  `file` blob NOT NULL,
  `due_date` timestamp(6) NOT NULL DEFAULT current_timestamp(6) ON UPDATE current_timestamp(6)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `class`
--

CREATE TABLE `class` (
  `course_id` varchar(20) NOT NULL,
  `course_title` varchar(255) DEFAULT NULL,
  `class_id` varchar(20) NOT NULL,
  `section` int(3) NOT NULL,
  `time` time NOT NULL,
  `room_no` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `class`
--

INSERT INTO `class` (`course_id`, `course_title`, `class_id`, `section`, `time`, `room_no`) VALUES
('cse225', 'Data Structure And Algorithm', 'cse_225_10', 10, '09:40:00', 'sac610'),
('cse311', 'Database Systems', 'cse_311_11', 11, '09:40:00', 'sac210'),
('cse323', 'Operating Systems Design', 'cse_323_3', 3, '04:20:00', 'sac315'),
('cse327', 'Software Engineering', 'cse_327_6', 6, '13:00:00', 'sac210'),
('cse327', 'Software Engineering', 'cse_327_7', 7, '08:00:00', 'sac315'),
('cse331', 'Microprocessor Interfacing & Embedded System', 'cse_331_6', 6, '02:40:00', 'sac310'),
('cse332', 'Computer Organization and Architecture ', 'cse_332_1', 1, '09:40:00', 'sac206');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `post_id` varchar(255) NOT NULL,
  `commiter_id` varchar(255) NOT NULL,
  `comments` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`post_id`, `commiter_id`, `comments`) VALUES
('cse_327_6_1', '1721277042', 'This is 1 st comment by 1721277042');

-- --------------------------------------------------------

--
-- Table structure for table `enroll_student`
--

CREATE TABLE `enroll_student` (
  `class_id` varchar(20) NOT NULL,
  `nsu_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `enroll_student`
--

INSERT INTO `enroll_student` (`class_id`, `nsu_id`) VALUES
('cse_327_6', 1721277042),
('cse_225_10', 1721277042),
('cse_311_11', 1721277042),
('cse_323_3', 1721277042),
('cse_331_6', 1721277042),
('cse_225_10', 1722231042),
('cse_311_11', 1722231042),
('cse_323_3', 1722231042),
('cse_332_1', 1712275042),
('cse_331_6', 1712275042),
('cse_327_6', 1712275042),
('cse_225_10', 1712390642),
('cse_311_11', 1712390642),
('cse_323_3', 1712390642),
('cse_327_6', 1712390642);

-- --------------------------------------------------------

--
-- Table structure for table `exam_notice`
--

CREATE TABLE `exam_notice` (
  `post_id` varchar(255) NOT NULL,
  `exam_time_date` timestamp(6) NOT NULL DEFAULT current_timestamp(6) ON UPDATE current_timestamp(6),
  `syllabus` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `faculty_data`
--

CREATE TABLE `faculty_data` (
  `faculty_iD` int(10) NOT NULL,
  `faculty_initial` varchar(10) NOT NULL,
  `person_id` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `faculty_data`
--

INSERT INTO `faculty_data` (`faculty_iD`, `faculty_initial`, `person_id`) VALUES
(1610000111, 'DHN', 'f3'),
(1720000111, 'KMB', 'f1'),
(1920000111, 'ITN', 'f2');

-- --------------------------------------------------------

--
-- Table structure for table `person`
--

CREATE TABLE `person` (
  `name` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `phone_number` int(11) NOT NULL,
  `password` varchar(50) NOT NULL,
  `person_id` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `person`
--

INSERT INTO `person` (`name`, `email`, `phone_number`, `password`, `person_id`, `gender`) VALUES
('Khan Mohammad Habibullah', 'khan.habibullah@northsouth.edu', 1311111111, '1234', 'f1', 'male'),
('Intisar Tahmid', 'intisarnsu@gmail.com', 1786666666, '1234', 'f2', 'male'),
('Dihan Md Nurudddin', 'dihannsu@gmail.com', 1812222222, '1234', 'f3', 'male'),
('Fahad Rahman Amik', 'amiknsu@gmail.com', 1685290796, '1234', 's1', 'male'),
('Ariful Haque', 'arifulnsu@gmail.com', 1687878656, '1234', 's2', 'male'),
('Yearat Hossain', 'yearatnsu@gmail.com', 1678888009, '1234', 's3', 'male'),
('Simanto Tareq', 'tareqnsu@gmail.com', 1699999999, '1234', 's4', 'male');

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE `post` (
  `post_id` varchar(255) NOT NULL,
  `class_id` varchar(20) NOT NULL,
  `created_time` timestamp(6) NOT NULL DEFAULT current_timestamp(6) ON UPDATE current_timestamp(6),
  `created_by` varchar(255) NOT NULL,
  `priority` int(10) NOT NULL,
  `material` blob DEFAULT NULL,
  `post_text` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`post_id`, `class_id`, `created_time`, `created_by`, `priority`, `material`, `post_text`) VALUES
('cse_327_6_1', 'cse_327_6', '2020-04-28 11:55:13.020723', '1721277042', 3, NULL, 'Hello ! THis is post 1 created by 1721277042 Student');

-- --------------------------------------------------------

--
-- Table structure for table `student_data`
--

CREATE TABLE `student_data` (
  `nsu_id` int(11) NOT NULL,
  `person_id` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `student_data`
--

INSERT INTO `student_data` (`nsu_id`, `person_id`) VALUES
(1721277042, 's1'),
(1722231042, 's2'),
(1712275042, 's3'),
(1712390642, 's4');

-- --------------------------------------------------------

--
-- Table structure for table `take_class`
--

CREATE TABLE `take_class` (
  `class_id` varchar(20) NOT NULL,
  `faculty_id` int(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `take_class`
--

INSERT INTO `take_class` (`class_id`, `faculty_id`) VALUES
('cse_327_6', 1720000111),
('cse_225_10', 1720000111),
('cse_311_11', 1920000111),
('cse_323_3', 1920000111),
('cse_327_7', 1920000111),
('cse_331_6', 1610000111),
('cse_332_1', 1610000111);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `assignment_notice`
--
ALTER TABLE `assignment_notice`
  ADD KEY `assignment_notice_fk0` (`post_id`);

--
-- Indexes for table `class`
--
ALTER TABLE `class`
  ADD PRIMARY KEY (`class_id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD KEY `comments_fk0` (`post_id`);

--
-- Indexes for table `enroll_student`
--
ALTER TABLE `enroll_student`
  ADD KEY `enroll_student_fk0` (`class_id`),
  ADD KEY `enroll_student_fk1` (`nsu_id`);

--
-- Indexes for table `exam_notice`
--
ALTER TABLE `exam_notice`
  ADD KEY `exam_notice_fk0` (`post_id`);

--
-- Indexes for table `faculty_data`
--
ALTER TABLE `faculty_data`
  ADD PRIMARY KEY (`faculty_iD`),
  ADD KEY `faculty_data_fk0` (`person_id`);

--
-- Indexes for table `person`
--
ALTER TABLE `person`
  ADD PRIMARY KEY (`person_id`),
  ADD UNIQUE KEY `person_id` (`person_id`);

--
-- Indexes for table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`post_id`),
  ADD KEY `post_fk0` (`class_id`);

--
-- Indexes for table `student_data`
--
ALTER TABLE `student_data`
  ADD PRIMARY KEY (`nsu_id`),
  ADD KEY `student_data_fk0` (`person_id`);

--
-- Indexes for table `take_class`
--
ALTER TABLE `take_class`
  ADD KEY `take_class_fk0` (`class_id`),
  ADD KEY `take_class_fk1` (`faculty_id`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `assignment_notice`
--
ALTER TABLE `assignment_notice`
  ADD CONSTRAINT `assignment_notice_fk0` FOREIGN KEY (`post_id`) REFERENCES `post` (`post_id`);

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_fk0` FOREIGN KEY (`post_id`) REFERENCES `post` (`post_id`);

--
-- Constraints for table `enroll_student`
--
ALTER TABLE `enroll_student`
  ADD CONSTRAINT `enroll_student_fk0` FOREIGN KEY (`class_id`) REFERENCES `class` (`class_id`),
  ADD CONSTRAINT `enroll_student_fk1` FOREIGN KEY (`nsu_id`) REFERENCES `student_data` (`nsu_id`);

--
-- Constraints for table `exam_notice`
--
ALTER TABLE `exam_notice`
  ADD CONSTRAINT `exam_notice_fk0` FOREIGN KEY (`post_id`) REFERENCES `post` (`post_id`);

--
-- Constraints for table `faculty_data`
--
ALTER TABLE `faculty_data`
  ADD CONSTRAINT `faculty_data_fk0` FOREIGN KEY (`person_id`) REFERENCES `person` (`person_id`);

--
-- Constraints for table `post`
--
ALTER TABLE `post`
  ADD CONSTRAINT `post_fk0` FOREIGN KEY (`class_id`) REFERENCES `class` (`class_id`);

--
-- Constraints for table `student_data`
--
ALTER TABLE `student_data`
  ADD CONSTRAINT `student_data_fk0` FOREIGN KEY (`person_id`) REFERENCES `person` (`person_id`);

--
-- Constraints for table `take_class`
--
ALTER TABLE `take_class`
  ADD CONSTRAINT `take_class_fk0` FOREIGN KEY (`class_id`) REFERENCES `class` (`class_id`),
  ADD CONSTRAINT `take_class_fk1` FOREIGN KEY (`faculty_id`) REFERENCES `faculty_data` (`faculty_iD`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
