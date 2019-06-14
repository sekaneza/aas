-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 11, 2017 at 12:40 PM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 7.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `AAS`
--

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `ID` int(11) NOT NULL,
  `student_ID` int(11) NOT NULL,
  `reg_num` varchar(45) NOT NULL,
  `dep_ID` int(11) NOT NULL,
  `course_ID` int(11) NOT NULL,
  `session` char(1) DEFAULT NULL,
  `lecturer_ID` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `obs` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`ID`, `student_ID`, `reg_num`, `dep_ID`, `course_ID`, `session`, `lecturer_ID`, `date`, `obs`) VALUES
(94, 1, '01110/15/G', 1, 4, 'M', 3, '2017-12-09 13:04:00', 'P'),
(95, 5, '02345/16/G', 3, 4, 'M', 3, '2017-12-09 13:04:00', 'P'),
(96, 4, '0968/14/G', 2, 4, 'M', 3, '2017-12-09 13:04:00', 'A'),
(97, 1, '01110/15/G', 1, 4, 'M', 3, '2017-12-10 13:05:59', 'A'),
(98, 5, '02345/16/G', 3, 4, 'M', 3, '2017-12-10 13:05:59', 'P'),
(99, 4, '0968/14/G', 2, 4, 'M', 3, '2017-12-10 13:05:59', 'P'),
(136, 1, '01110/15/G', 1, 4, 'M', 3, '2017-12-11 08:59:41', 'P'),
(137, 4, '0968/14/G', 2, 4, 'M', 3, '2017-12-11 08:59:41', 'P'),
(138, 5, '02345/16/G', 3, 4, 'M', 3, '2017-12-11 08:59:41', 'P');

-- --------------------------------------------------------

--
-- Table structure for table `att_check`
--

CREATE TABLE `att_check` (
  `ID` int(11) NOT NULL,
  `lecturer_ID` int(11) NOT NULL,
  `course_ID` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `att_check`
--

INSERT INTO `att_check` (`ID`, `lecturer_ID`, `course_ID`, `date`) VALUES
(90, 2, 1, '2017-12-04 09:59:28'),
(150, 3, 2, '2017-12-06 19:15:08'),
(156, 3, 4, '2017-12-11 11:22:42');

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `ID` int(11) NOT NULL,
  `code` varchar(45) DEFAULT NULL,
  `title` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`ID`, `code`, `title`) VALUES
(1, NULL, 'Multimedia Technology'),
(2, NULL, 'Human Computer Interaction'),
(3, NULL, 'Software Engineering'),
(4, NULL, 'Research Methodology'),
(5, NULL, 'Digital Electronics'),
(6, NULL, 'Optic fiber');

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `ID` int(11) NOT NULL,
  `name` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`ID`, `name`) VALUES
(1, 'CE'),
(2, 'BIT'),
(3, 'BBM');

-- --------------------------------------------------------

--
-- Table structure for table `holidays`
--

CREATE TABLE `holidays` (
  `ID` int(11) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `lecturers`
--

CREATE TABLE `lecturers` (
  `ID` int(11) NOT NULL,
  `fname` varchar(45) DEFAULT NULL,
  `lname` varchar(45) DEFAULT NULL,
  `uname` varchar(45) DEFAULT NULL,
  `password` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `lecturers`
--

INSERT INTO `lecturers` (`ID`, `fname`, `lname`, `uname`, `password`) VALUES
(1, 'RUTARINDWA', 'Jean Pierre', 'ruta', 'ruta'),
(2, 'SINAYOBYE', 'Omar', 'sina', 'sinayobye'),
(3, 'NIZEYIMANA', 'Jean Paul', 'nize', 'nizeyimana'),
(4, 'MUNYANEZA', 'Justin', 'munya', 'munyaneza');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `ID` int(11) NOT NULL,
  `lecturer_ID` int(11) NOT NULL,
  `student_ID` int(11) NOT NULL,
  `phone` varchar(45) DEFAULT NULL,
  `message` text NOT NULL,
  `date` varchar(45) NOT NULL,
  `obs` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `ID` int(11) NOT NULL,
  `reg_num` varchar(20) NOT NULL,
  `fname` varchar(45) NOT NULL,
  `lname` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  `dep_ID` int(11) NOT NULL,
  `year` int(11) NOT NULL,
  `trimester` int(11) NOT NULL,
  `session` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`ID`, `reg_num`, `fname`, `lname`, `password`, `dep_ID`, `year`, `trimester`, `session`) VALUES
(1, '01110/15/G', 'RWABAHIZI', 'Jonathan', '123456789', 1, 3, 1, 'M'),
(2, '01234/16/G', 'MARUGIRA', 'Seggi', '12345', 1, 2, 1, 'M'),
(4, '0968/14/G', 'RUKUMBUZI', 'Claude', '12345', 2, 3, 2, 'M'),
(5, '02345/16/G', 'NSIBOMANA', 'Francine', '12345', 3, 3, 3, 'M'),
(6, '01120/15/G', 'GASHUGI', 'Robert', '12345', 1, 2, 1, 'M'),
(7, '00784/14/g', 'Shyaka', 'Ben', '12345', 1, 3, 1, 'M');

-- --------------------------------------------------------

--
-- Table structure for table `timetable`
--

CREATE TABLE `timetable` (
  `ID` int(11) NOT NULL,
  `course_ID` int(11) NOT NULL,
  `dep_ID` int(11) NOT NULL,
  `year` int(11) DEFAULT NULL,
  `trimester` int(11) DEFAULT NULL,
  `session` char(1) DEFAULT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `lecturer_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `timetable`
--

INSERT INTO `timetable` (`ID`, `course_ID`, `dep_ID`, `year`, `trimester`, `session`, `start_date`, `end_date`, `lecturer_ID`) VALUES
(1, 1, 1, 3, 1, 'M', '2017-12-09', '2017-12-20', 2),
(2, 1, 2, 3, 2, 'M', '2017-12-09', '2017-12-20', 2),
(3, 4, 1, 3, 1, 'M', '2017-12-09', '2017-12-20', 3),
(4, 4, 2, 3, 1, 'M', '2017-12-09', '2017-12-20', 3),
(5, 4, 3, 3, 1, 'M', '2017-12-09', '2017-12-20', 3),
(8, 2, 1, 3, 1, 'M', '2017-12-04', '2017-12-15', 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `dep_ID_idx` (`dep_ID`),
  ADD KEY `course_ID_idx` (`course_ID`),
  ADD KEY `student_ID_idx` (`student_ID`),
  ADD KEY `lecturer_ID_idx` (`lecturer_ID`);

--
-- Indexes for table `att_check`
--
ALTER TABLE `att_check`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `lecturer_ID_idx` (`lecturer_ID`),
  ADD KEY `course_ID_idx` (`course_ID`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `holidays`
--
ALTER TABLE `holidays`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `lecturers`
--
ALTER TABLE `lecturers`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `lecturer_ID_idx` (`lecturer_ID`),
  ADD KEY `student_ID_idx` (`student_ID`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `dep_ID_idx` (`dep_ID`);

--
-- Indexes for table `timetable`
--
ALTER TABLE `timetable`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `dep_ID_idx` (`dep_ID`),
  ADD KEY `course_ID_idx` (`course_ID`),
  ADD KEY `lecturer_ID_idx` (`lecturer_ID`) USING BTREE;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=233;
--
-- AUTO_INCREMENT for table `att_check`
--
ALTER TABLE `att_check`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=157;
--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `holidays`
--
ALTER TABLE `holidays`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `lecturers`
--
ALTER TABLE `lecturers`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `timetable`
--
ALTER TABLE `timetable`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `attendance`
--
ALTER TABLE `attendance`
  ADD CONSTRAINT `attendance_ibfk_1` FOREIGN KEY (`dep_ID`) REFERENCES `departments` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `attendance_ibfk_2` FOREIGN KEY (`course_ID`) REFERENCES `courses` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `attendance_ibfk_3` FOREIGN KEY (`student_ID`) REFERENCES `students` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `attendance_ibfk_4` FOREIGN KEY (`lecturer_ID`) REFERENCES `lecturers` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `att_check`
--
ALTER TABLE `att_check`
  ADD CONSTRAINT `att_check_ibfk_1` FOREIGN KEY (`lecturer_ID`) REFERENCES `lecturers` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `att_check_ibfk_2` FOREIGN KEY (`course_ID`) REFERENCES `courses` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages_ibfk_1` FOREIGN KEY (`lecturer_ID`) REFERENCES `lecturers` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `messages_ibfk_2` FOREIGN KEY (`student_ID`) REFERENCES `students` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `students`
--
ALTER TABLE `students`
  ADD CONSTRAINT `students_ibfk_1` FOREIGN KEY (`dep_ID`) REFERENCES `departments` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `timetable`
--
ALTER TABLE `timetable`
  ADD CONSTRAINT `timetable_ibfk_1` FOREIGN KEY (`dep_ID`) REFERENCES `departments` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `timetable_ibfk_2` FOREIGN KEY (`lecturer_ID`) REFERENCES `lecturers` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `timetable_ibfk_3` FOREIGN KEY (`course_ID`) REFERENCES `courses` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
