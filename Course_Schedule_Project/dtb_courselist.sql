-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 17, 2021 at 12:25 AM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 8.0.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `288wampproject`
--

-- --------------------------------------------------------

--
-- Table structure for table `t_courses`
--

CREATE TABLE `t_courses` (
  `ID_course` int(11) NOT NULL,
  `course_code` char(5) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `course_desc` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_courses`
--

INSERT INTO `t_courses` (`ID_course`, `course_code`, `course_desc`) VALUES
(101, '21101', 'Computer Programming I'),
(102, '21102', 'Computer Programming II'),
(135, '21135', 'Calculus I'),
(136, '21136', 'Calculus II'),
(155, '21155', 'Honors Calculus I'),
(156, '21156', 'Honors Calculus II'),
(235, '21235', 'Calculus III'),
(237, '21237', 'Discrete Struct'),
(251, '21251', 'Computer Organization'),
(280, '21280', 'Prog Lang Conc'),
(288, '21288', 'Intensive Prog'),
(327, '21327', 'Prob & Stat'),
(335, '21335', 'Data Structures'),
(473, '21473', 'Numerical Ana'),
(490, '21490', 'Guided Design'),
(491, '540', 'xyz'),
(492, '600', 'x');

-- --------------------------------------------------------

--
-- Table structure for table `t_schedules`
--

CREATE TABLE `t_schedules` (
  `ID_Schedule` int(11) NOT NULL,
  `ID_Student` int(11) NOT NULL,
  `ID_Course` int(11) NOT NULL,
  `Sched_Yr` int(4) NOT NULL COMMENT '	YYYY',
  `Sched_Sem` char(2) NOT NULL COMMENT '	FA SP S1 S2',
  `Grade_Letter` char(2) NOT NULL COMMENT 'A+=4.0 A=3.75 B+=3.5 B=3.0 C+=2.5 C=2.0 D=1.0 F=0.0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_schedules`
--

INSERT INTO `t_schedules` (`ID_Schedule`, `ID_Student`, `ID_Course`, `Sched_Yr`, `Sched_Sem`, `Grade_Letter`) VALUES
(1, 1, 101, 2011, 'FA', 'C'),
(2, 2, 101, 2011, 'FA', 'B'),
(3, 3, 101, 2011, 'FA', 'C'),
(4, 4, 101, 2011, 'FA', 'B');

-- --------------------------------------------------------

--
-- Table structure for table `t_students`
--

CREATE TABLE `t_students` (
  `ID_Student` int(11) NOT NULL,
  `FName` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `LName` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `Phone` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `Email` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `Status` tinyint(1) NOT NULL,
  `Start_Dte` date NOT NULL,
  `End_Dte` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_students`
--

INSERT INTO `t_students` (`ID_Student`, `FName`, `LName`, `Phone`, `Email`, `Status`, `Start_Dte`, `End_Dte`) VALUES
(1, 'Harry', 'Potter', '(111)-111-1234', 'potter_harry@hogwarts.con', 1, '2021-01-02', NULL),
(2, 'Hermonie', 'Granger', '(111)-111-1235', 'granger_hermonie@hogwarts.con', 0, '2021-01-02', NULL),
(3, 'Ron', 'Weasley', '(111)-111-1236', 'weasley_ron@hogwarts.con', 0, '2021-01-02', NULL),
(4, 'Draco', 'Malfoy', '(111)-111-4321', 'malfoy_draco@hogwarts.con', 0, '2021-01-02', NULL),
(5, 'Luna', 'Lovegood', '(111)-111-1237', 'lovegood_luna@hogwarts.con', 0, '2021-01-02', NULL),
(6, 'Neville', 'Longbot', '(111)-111-1238', 'longbot_neville@hogwarts.con', 0, '2021-01-02', NULL),
(7, 'Sirius', 'White', '(111)-110-1234', 'white_sirius@hogwarts.con', 0, '2011-01-02', NULL),
(8, 'Padma', 'Laxmi', '(111)-111-1239', 'laxmi_padma@hogwarts.con', 0, '2021-01-02', NULL),
(9, 'Ginny', 'Weasley', '(111)-111-1230', 'weasley_ginny@hogwarts.con', 0, '2021-01-02', NULL),
(10, 'Peter', 'Pettigrew', '(011)-110-1234', 'pettigrew_peter@hogwarts.con', 0, '2011-01-02', NULL),
(11, 'James', 'Potter', '(011)-111-1235', 'potter_james@hogwarts.con', 0, '2011-01-02', NULL),
(12, 'Lilly', 'Potter', '(011)-111-1236', 'potter_lilly@hogwarts.con', 0, '2011-01-02', NULL),
(13, 'Severus', 'Snape', '(011)-111-1237', 'severus_snape@hogwarts.con', 0, '2011-01-02', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `t_courses`
--
ALTER TABLE `t_courses`
  ADD PRIMARY KEY (`ID_course`);

--
-- Indexes for table `t_schedules`
--
ALTER TABLE `t_schedules`
  ADD PRIMARY KEY (`ID_Schedule`);

--
-- Indexes for table `t_students`
--
ALTER TABLE `t_students`
  ADD PRIMARY KEY (`ID_Student`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `t_courses`
--
ALTER TABLE `t_courses`
  MODIFY `ID_course` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=493;

--
-- AUTO_INCREMENT for table `t_schedules`
--
ALTER TABLE `t_schedules`
  MODIFY `ID_Schedule` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `t_students`
--
ALTER TABLE `t_students`
  MODIFY `ID_Student` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
