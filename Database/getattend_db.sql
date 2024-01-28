-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Sep 02, 2023 at 05:53 PM
-- Server version: 8.0.31
-- PHP Version: 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `getattend`
--

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

DROP TABLE IF EXISTS `attendance`;
CREATE TABLE IF NOT EXISTS `attendance` (
  `Register_no` varchar(20) DEFAULT NULL,
  `Attendance_type` varchar(20) DEFAULT NULL,
  `Attendance_status` varchar(10) DEFAULT NULL,
  `Attendance_taker` varchar(100) DEFAULT NULL,
  `Atten_Taker_ID` varchar(20) NOT NULL,
  `A_Subject` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `Attendance_date` date DEFAULT NULL,
  `Attendance_time` time DEFAULT NULL,
  `Attendance_code` int NOT NULL,
  `Batch` varchar(20) NOT NULL,
  `A_Year` varchar(10) NOT NULL,
  KEY `Register_no` (`Register_no`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

DROP TABLE IF EXISTS `student`;
CREATE TABLE IF NOT EXISTS `student` (
  `Register_no` varchar(20) NOT NULL,
  `First_name` varchar(20) DEFAULT NULL,
  `Last_name` varchar(20) DEFAULT NULL,
  `S_Address` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `Gender` varchar(10) DEFAULT NULL,
  `DOB` date DEFAULT NULL,
  `Email_ID` varchar(50) NOT NULL,
  `Mobile_no` varchar(10) NOT NULL,
  `Profile_pic` longblob,
  PRIMARY KEY (`Register_no`,`Email_ID`,`Mobile_no`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `student_college_info`
--

DROP TABLE IF EXISTS `student_college_info`;
CREATE TABLE IF NOT EXISTS `student_college_info` (
  `Register_no` varchar(20) NOT NULL,
  `College_name` varchar(200) DEFAULT NULL,
  `Class` varchar(10) DEFAULT NULL,
  `Std_year` int DEFAULT NULL,
  `Semister` int DEFAULT NULL,
  `Batch` text NOT NULL,
  PRIMARY KEY (`Register_no`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `student_login`
--

DROP TABLE IF EXISTS `student_login`;
CREATE TABLE IF NOT EXISTS `student_login` (
  `Register_no` varchar(20) NOT NULL,
  `Email_ID` varchar(50) NOT NULL,
  `Mobile_no` varchar(10) NOT NULL,
  `Passwords` varchar(100) NOT NULL,
  PRIMARY KEY (`Register_no`,`Email_ID`,`Mobile_no`,`Passwords`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `teacher`
--

DROP TABLE IF EXISTS `teacher`;
CREATE TABLE IF NOT EXISTS `teacher` (
  `Teacher_ID` varchar(20) NOT NULL,
  `First_name` varchar(20) DEFAULT NULL,
  `Last_name` varchar(20) DEFAULT NULL,
  `Gender` varchar(10) DEFAULT NULL,
  `DOB` date DEFAULT NULL,
  `Email_ID` varchar(50) NOT NULL,
  `Mobile_no` varchar(10) NOT NULL,
  `Profile_pic` longblob,
  PRIMARY KEY (`Teacher_ID`,`Email_ID`,`Mobile_no`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `teacher_college_info`
--

DROP TABLE IF EXISTS `teacher_college_info`;
CREATE TABLE IF NOT EXISTS `teacher_college_info` (
  `Teacher_ID` varchar(20) NOT NULL,
  `College_name` varchar(200) DEFAULT NULL,
  `Class` varchar(10) DEFAULT NULL,
  `Std_year` int DEFAULT NULL,
  `Semister` int DEFAULT NULL,
  `Subjects` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  PRIMARY KEY (`Teacher_ID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `teacher_login`
--

DROP TABLE IF EXISTS `teacher_login`;
CREATE TABLE IF NOT EXISTS `teacher_login` (
  `Teacher_ID` varchar(20) NOT NULL,
  `Email_ID` varchar(50) NOT NULL,
  `Mobile_no` varchar(10) NOT NULL,
  `Passwords` varchar(100) NOT NULL,
  PRIMARY KEY (`Teacher_ID`,`Email_ID`,`Mobile_no`,`Passwords`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `total_attendance_record`
--

DROP TABLE IF EXISTS `total_attendance_record`;
CREATE TABLE IF NOT EXISTS `total_attendance_record` (
  `Teacher_ID` varchar(20) DEFAULT NULL,
  `Batch` varchar(20) DEFAULT NULL,
  `Class` varchar(10) DEFAULT NULL,
  `Std_year` int DEFAULT NULL,
  `Subjects` varchar(20) DEFAULT NULL,
  `Total_attendance` varchar(10) DEFAULT NULL,
  KEY `Teacher_ID` (`Teacher_ID`),
  KEY `Class` (`Class`),
  KEY `Std_year` (`Std_year`),
  KEY `Subjects` (`Subjects`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
