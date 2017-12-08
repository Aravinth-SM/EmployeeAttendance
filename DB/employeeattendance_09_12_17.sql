-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 08, 2017 at 07:59 PM
-- Server version: 5.5.8
-- PHP Version: 5.3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `employeeattendance`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `username`, `password`) VALUES
(1, 'Aravinth', 'aravinth', 'sm@123'),
(2, 'Manickam', 'manickam', 'admin@123');

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE IF NOT EXISTS `attendance` (
  `emp_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `in_time` varchar(255) NOT NULL,
  `out_time` varchar(255) DEFAULT NULL,
  `ot_time` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`emp_id`, `date`, `in_time`, `out_time`, `ot_time`) VALUES
(101, '2017-10-22', '09:30AM', '07:15PM', 1),
(131, '2017-10-22', '09:15AM', '05:30PM', 0),
(102, '2017-10-22', '10:00AM', '07:00AM', 2),
(130, '2017-10-22', '07:15AM', '04:10AM', 2),
(102, '2017-10-23', '10:30AM', '04:45PM', 0),
(130, '2017-10-23', '09:35AM', '06:35PM', 1),
(101, '2017-10-23', '08:15AM', '05:40PM', 1),
(6789, '2017-10-23', '09:05AM', '05:15PM', 0),
(9876, '2017-10-23', '10:43AM', '03:45AM', 0),
(102, '2017-10-25', '02:43AM', '08:45PM', 0),
(101, '2017-10-25', '08:45AM', '07:40PM', 2),
(131, '2017-10-25', '10:15AM', '08:44PM', 0),
(9876, '2017-10-25', '09:15AM', '04:50PM', 0),
(6789, '2017-10-25', '08:05AM', '08:35PM', 2),
(101, '2017-10-26', '09:30AM', '07:15PM', 1),
(131, '2017-10-26', '09:15AM', '05:30PM', 0),
(102, '2017-10-26', '10:00AM', '07:00AM', 2),
(130, '2017-10-26', '07:15AM', '04:10AM', 2),
(102, '2017-10-27', '10:30AM', '04:45PM', 0),
(130, '2017-10-27', '09:35AM', '06:35PM', 1),
(101, '2017-10-27', '08:15AM', '05:40PM', 1),
(6789, '2017-10-27', '09:05AM', '05:15PM', 0),
(9876, '2017-10-27', '10:43AM', '03:45AM', 0),
(102, '2017-10-28', '02:43AM', '08:45PM', 0),
(101, '2017-10-28', '08:45AM', '07:40PM', 2),
(131, '2017-10-28', '10:15AM', '08:44PM', 0),
(9876, '2017-10-28', '09:15AM', '04:50PM', 0),
(6789, '2017-10-28', '08:05AM', '08:35PM', 2),
(101, '2017-10-29', '09:30AM', '07:15PM', 1),
(131, '2017-10-29', '09:15AM', '05:30PM', 0),
(102, '2017-10-29', '10:00AM', '07:00AM', 2),
(130, '2017-10-29', '07:15AM', '04:10AM', 2),
(102, '2017-10-30', '10:30AM', '04:45PM', 0),
(130, '2017-10-30', '09:35AM', '06:35PM', 1),
(101, '2017-10-30', '08:15AM', '05:40PM', 1),
(6789, '2017-10-30', '09:05AM', '05:15PM', 0),
(9876, '2017-10-30', '10:43AM', '03:45AM', 0),
(102, '2017-10-18', '02:43AM', '08:45PM', 0),
(101, '2017-10-18', '08:45AM', '07:40PM', 2),
(131, '2017-10-18', '10:15AM', '08:44PM', 0),
(9876, '2017-10-18', '09:15AM', '04:50PM', 0),
(6789, '2017-10-18', '08:05AM', '08:35PM', 2),
(101, '2017-10-19', '09:30AM', '07:15PM', 1),
(131, '2017-10-19', '09:15AM', '05:30PM', 0),
(102, '2017-10-19', '10:00AM', '07:00AM', 2),
(130, '2017-10-19', '07:15AM', '04:10AM', 2),
(102, '2017-10-20', '10:30AM', '04:45PM', 0),
(130, '2017-10-20', '09:35AM', '06:35PM', 1),
(101, '2017-10-20', '08:15AM', '05:40PM', 1),
(6789, '2017-10-20', '09:05AM', '05:15PM', 0),
(9876, '2017-10-20', '10:43AM', '03:45AM', 0),
(102, '2017-10-21', '02:43AM', '08:45PM', 0),
(101, '2017-10-21', '08:45AM', '07:40PM', 2),
(131, '2017-10-21', '10:15AM', '08:44PM', 0),
(9876, '2017-10-21', '09:15AM', '04:50PM', 0),
(6789, '2017-10-21', '08:05AM', '08:35PM', 2),
(101, '2017-10-08', '09:30AM', '07:15PM', 1),
(131, '2017-10-08', '09:15AM', '05:30PM', 0),
(102, '2017-10-08', '10:00AM', '07:00AM', 2),
(130, '2017-10-08', '07:15AM', '04:10AM', 2),
(102, '2017-10-10', '10:30AM', '04:45PM', 0),
(130, '2017-10-10', '09:35AM', '06:35PM', 1),
(101, '2017-10-10', '08:15AM', '05:40PM', 1),
(6789, '2017-10-10', '09:05AM', '05:15PM', 0),
(9876, '2017-10-10', '10:43AM', '03:45AM', 0),
(102, '2017-10-11', '02:43AM', '08:45PM', 0),
(101, '2017-10-11', '08:45AM', '07:40PM', 2),
(131, '2017-10-11', '10:15AM', '08:44PM', 0),
(9876, '2017-10-11', '09:15AM', '04:50PM', 0),
(6789, '2017-10-11', '08:05AM', '08:35PM', 2),
(101, '2017-10-12', '09:30AM', '07:15PM', 1),
(131, '2017-10-12', '09:15AM', '05:30PM', 0),
(102, '2017-10-12', '10:00AM', '07:00AM', 2),
(130, '2017-10-12', '07:15AM', '04:10AM', 2),
(102, '2017-10-13', '10:30AM', '04:45PM', 0),
(130, '2017-10-13', '09:35AM', '06:35PM', 1),
(101, '2017-10-13', '08:15AM', '05:40PM', 1),
(6789, '2017-10-13', '09:05AM', '05:15PM', 0),
(9876, '2017-10-13', '10:43AM', '03:45AM', 0),
(102, '2017-10-14', '02:43AM', '08:45PM', 0),
(101, '2017-10-14', '08:45AM', '07:40PM', 2),
(131, '2017-10-14', '10:15AM', '08:44PM', 0),
(9876, '2017-10-14', '09:15AM', '04:50PM', 0),
(6789, '2017-10-14', '08:05AM', '08:35PM', 2),
(101, '2017-10-01', '09:30AM', '07:15PM', 1),
(131, '2017-10-01', '09:15AM', '05:30PM', 0),
(102, '2017-10-01', '10:00AM', '07:00AM', 2),
(130, '2017-10-01', '07:15AM', '04:10AM', 2),
(102, '2017-10-02', '10:30AM', '04:45PM', 0),
(130, '2017-10-02', '09:35AM', '06:35PM', 1),
(101, '2017-10-02', '08:15AM', '05:40PM', 1),
(6789, '2017-10-02', '09:05AM', '05:15PM', 0),
(9876, '2017-10-02', '10:43AM', '03:45AM', 0),
(102, '2017-10-04', '02:43AM', '08:45PM', 0),
(101, '2017-10-04', '08:45AM', '07:40PM', 2),
(131, '2017-10-04', '10:15AM', '08:44PM', 0),
(9876, '2017-10-04', '09:15AM', '04:50PM', 0),
(6789, '2017-10-04', '08:05AM', '08:35PM', 2),
(101, '2017-10-05', '09:30AM', '07:15PM', 1),
(131, '2017-10-05', '09:15AM', '05:30PM', 0),
(102, '2017-10-05', '10:00AM', '07:00AM', 2),
(130, '2017-10-05', '07:15AM', '04:10AM', 2),
(102, '2017-10-06', '10:30AM', '04:45PM', 0),
(130, '2017-10-06', '09:35AM', '06:35PM', 1),
(101, '2017-10-06', '08:15AM', '05:40PM', 1),
(6789, '2017-10-06', '09:05AM', '05:15PM', 0),
(9876, '2017-10-06', '10:43AM', '03:45AM', 0),
(102, '2017-10-07', '02:43AM', '08:45PM', 0),
(101, '2017-10-07', '08:45AM', '07:40PM', 2),
(131, '2017-10-07', '10:15AM', '08:44PM', 0),
(9876, '2017-10-07', '09:15AM', '04:50PM', 0),
(6789, '2017-10-07', '08:05AM', '08:35PM', 2),
(130, '2017-09-01', '07:15AM', '04:10AM', 2),
(101, '2017-09-01', '09:30AM', '07:15PM', 1),
(131, '2017-09-01', '09:15AM', '05:30PM', 0),
(102, '2017-09-01', '10:00AM', '07:00AM', 2),
(6789, '2017-09-02', '09:05AM', '05:15PM', 0),
(101, '2017-09-02', '08:15AM', '05:40PM', 1),
(130, '2017-09-02', '09:35AM', '06:35PM', 1),
(102, '2017-09-02', '10:30AM', '04:45PM', 0),
(9876, '2017-09-02', '10:43AM', '03:45AM', 0),
(102, '2017-09-04', '02:43AM', '08:45PM', 0),
(101, '2017-09-04', '08:45AM', '07:40PM', 2),
(131, '2017-09-04', '10:15AM', '08:44PM', 0),
(6789, '2017-09-04', '08:05AM', '08:35PM', 2),
(9876, '2017-09-04', '09:15AM', '04:50PM', 0),
(101, '2017-09-05', '09:30AM', '07:15PM', 1),
(131, '2017-09-05', '09:15AM', '05:30PM', 0),
(130, '2017-09-05', '07:15AM', '04:10AM', 2),
(102, '2017-09-05', '10:00AM', '07:00AM', 2),
(6789, '2017-09-06', '09:05AM', '05:15PM', 0),
(9876, '2017-09-06', '10:43AM', '03:45AM', 0),
(102, '2017-09-06', '10:30AM', '04:45PM', 0),
(130, '2017-09-06', '09:35AM', '06:35PM', 1),
(101, '2017-09-06', '08:15AM', '05:40PM', 1),
(131, '2017-09-07', '10:15AM', '08:44PM', 0),
(101, '2017-09-07', '08:45AM', '07:40PM', 2),
(102, '2017-09-07', '02:43AM', '08:45PM', 0),
(6789, '2017-09-07', '08:05AM', '08:35PM', 2),
(9876, '2017-09-07', '09:15AM', '04:50PM', 0),
(130, '2017-09-08', '07:15AM', '04:10AM', 2),
(101, '2017-09-08', '09:30AM', '07:15PM', 1),
(102, '2017-09-08', '10:00AM', '07:00AM', 2),
(131, '2017-09-08', '09:15AM', '05:30PM', 0),
(130, '2017-09-09', '09:35AM', '06:35PM', 1),
(101, '2017-09-09', '08:15AM', '05:40PM', 1),
(102, '2017-09-09', '10:30AM', '04:45PM', 0),
(9876, '2017-09-09', '10:43AM', '03:45AM', 0),
(6789, '2017-09-09', '09:05AM', '05:15PM', 0),
(102, '2017-09-11', '02:43AM', '08:45PM', 0),
(101, '2017-09-11', '08:45AM', '07:40PM', 2),
(131, '2017-09-11', '10:15AM', '08:44PM', 0),
(9876, '2017-09-11', '09:15AM', '04:50PM', 0),
(6789, '2017-09-11', '08:05AM', '08:35PM', 2),
(131, '2017-09-12', '09:15AM', '05:30PM', 0),
(102, '2017-09-12', '10:00AM', '07:00AM', 2),
(130, '2017-09-12', '07:15AM', '04:10AM', 2),
(101, '2017-09-12', '09:30AM', '07:15PM', 1),
(130, '2017-09-13', '09:35AM', '06:35PM', 1),
(102, '2017-09-13', '10:30AM', '04:45PM', 0),
(9876, '2017-09-13', '10:43AM', '03:45AM', 0),
(6789, '2017-09-13', '09:05AM', '05:15PM', 0),
(101, '2017-09-13', '08:15AM', '05:40PM', 1),
(102, '2017-09-14', '02:43AM', '08:45PM', 0),
(9876, '2017-09-14', '09:15AM', '04:50PM', 0),
(6789, '2017-09-14', '08:05AM', '08:35PM', 2),
(101, '2017-09-14', '08:45AM', '07:40PM', 2),
(131, '2017-09-14', '10:15AM', '08:44PM', 0),
(101, '2017-09-18', '08:45AM', '07:40PM', 2),
(102, '2017-09-18', '02:43AM', '08:45PM', 0),
(131, '2017-09-18', '10:15AM', '08:44PM', 0),
(9876, '2017-09-18', '09:15AM', '04:50PM', 0),
(6789, '2017-09-18', '08:05AM', '08:35PM', 2),
(131, '2017-09-19', '09:15AM', '05:30PM', 0),
(101, '2017-09-19', '09:30AM', '07:15PM', 1),
(102, '2017-09-19', '10:00AM', '07:00AM', 2),
(130, '2017-09-19', '07:15AM', '04:10AM', 2),
(9876, '2017-09-20', '10:43AM', '03:45AM', 0),
(6789, '2017-09-20', '09:05AM', '05:15PM', 0),
(101, '2017-09-20', '08:15AM', '05:40PM', 1),
(130, '2017-09-20', '09:35AM', '06:35PM', 1),
(102, '2017-09-20', '10:30AM', '04:45PM', 0),
(102, '2017-09-21', '02:43AM', '08:45PM', 0),
(101, '2017-09-21', '08:45AM', '07:40PM', 2),
(131, '2017-09-21', '10:15AM', '08:44PM', 0),
(9876, '2017-09-21', '09:15AM', '04:50PM', 0),
(6789, '2017-09-21', '08:05AM', '08:35PM', 2),
(101, '2017-09-22', '09:30AM', '07:15PM', 1),
(131, '2017-09-22', '09:15AM', '05:30PM', 0),
(102, '2017-09-22', '10:00AM', '07:00AM', 2),
(130, '2017-09-22', '07:15AM', '04:10AM', 2),
(102, '2017-09-23', '10:30AM', '04:45PM', 0),
(130, '2017-09-23', '09:35AM', '06:35PM', 1),
(101, '2017-09-23', '08:15AM', '05:40PM', 1),
(9876, '2017-09-23', '10:43AM', '03:45AM', 0),
(6789, '2017-09-23', '09:05AM', '05:15PM', 0),
(102, '2017-09-25', '02:43AM', '08:45PM', 0),
(101, '2017-09-25', '08:45AM', '07:40PM', 2),
(131, '2017-09-25', '10:15AM', '08:44PM', 0),
(9876, '2017-09-25', '09:15AM', '04:50PM', 0),
(6789, '2017-09-25', '08:05AM', '08:35PM', 2),
(131, '2017-09-26', '09:15AM', '05:30PM', 0),
(102, '2017-09-26', '10:00AM', '07:00AM', 2),
(101, '2017-09-26', '09:30AM', '07:15PM', 1),
(130, '2017-09-26', '07:15AM', '04:10AM', 2),
(102, '2017-09-27', '10:30AM', '04:45PM', 0),
(130, '2017-09-27', '09:35AM', '06:35PM', 1),
(101, '2017-09-27', '08:15AM', '05:40PM', 1),
(6789, '2017-09-27', '09:05AM', '05:15PM', 0),
(9876, '2017-09-27', '10:43AM', '03:45AM', 0),
(102, '2017-09-28', '02:43AM', '08:45PM', 0),
(6789, '2017-09-28', '08:05AM', '08:35PM', 2),
(9876, '2017-09-28', '09:15AM', '04:50PM', 0),
(131, '2017-09-28', '10:15AM', '08:44PM', 0),
(101, '2017-09-28', '08:45AM', '07:40PM', 2),
(101, '2017-09-29', '09:30AM', '07:15PM', 1),
(130, '2017-09-29', '07:15AM', '04:10AM', 2),
(131, '2017-09-29', '09:15AM', '05:30PM', 0),
(102, '2017-09-29', '10:00AM', '07:00AM', 2),
(130, '2017-09-30', '09:35AM', '06:35PM', 1),
(101, '2017-09-30', '08:15AM', '05:40PM', 1),
(6789, '2017-09-30', '09:05AM', '05:15PM', 0),
(9876, '2017-09-30', '10:43AM', '03:45AM', 0),
(102, '2017-09-30', '10:30AM', '04:45PM', 0),
(101, '2017-11-29', '02:17AM', '05:18AM', 0),
(130, '2017-11-29', '10:24AM', '08:24PM', 3),
(102, '2017-11-29', '02:25AM', '03:25PM', 1);

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE IF NOT EXISTS `employee` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `emp_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `type` varchar(100) NOT NULL,
  `salary` int(11) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `DOB` varchar(255) NOT NULL,
  `DOJ` varchar(255) NOT NULL,
  `address` varchar(200) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `fixed_salary` int(11) NOT NULL DEFAULT '0',
  `PF` int(11) NOT NULL DEFAULT '0',
  `ESI` int(11) NOT NULL DEFAULT '0',
  `gender` varchar(255) NOT NULL DEFAULT 'male',
  `busFare` int(11) NOT NULL DEFAULT '0',
  `messFare` int(11) NOT NULL DEFAULT '0',
  `plant` varchar(255) NOT NULL DEFAULT 'Jelly',
  `bankAccountNumber` int(11) NOT NULL DEFAULT '0',
  `branchName` varchar(255) NOT NULL DEFAULT 'madurai',
  `branchCode` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=52 ;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`id`, `emp_id`, `name`, `type`, `salary`, `phone`, `DOB`, `DOJ`, `address`, `status`, `fixed_salary`, `PF`, `ESI`, `gender`, `busFare`, `messFare`, `plant`, `bankAccountNumber`, `branchName`, `branchCode`) VALUES
(2, 101, 'Aravinth.SM', 'daily', 2000, '9876543210', '13 October, 2010', '24 October, 2017', '                        G-308, Lancor lumina                  ', 1, 0, 1, 1, 'male', 1, 0, 'Jelly', 0, '', 0),
(3, 102, 'Manickam', 'monthly', 25000, '0123456789', '6 January, 2011', '2 October, 2017', '            m-803         ', 1, 0, 1, 1, 'male', 0, 1, 'Waffer', 6788754, ' Madurai', 6579),
(6, 103, 'Rohit Sharma', 'daily', 250, '0123456789', '4 October, 1972', '3 March, 2017', 'R-103, Madurai.', 0, 0, 0, 0, 'male', 0, 0, 'Jelly', 0, 'madurai', 0),
(7, 105, 'Virat kohli', 'monthly', 25000, '9876543210', '8 June, 1989', '12 March, 2015', 'V-105, Coimbatore.', 0, 0, 0, 0, 'male', 0, 0, 'Jelly', 0, 'madurai', 0),
(8, 104, 'Shikar Dhawan', 'daily', 200, '6543217890', '16 December, 1987', '5 October, 2016', 'S-104, Mumbai.', 0, 0, 0, 0, 'male', 0, 0, 'Jelly', 0, 'madurai', 0),
(9, 106, 'Anjinkya Rahane', 'monthly', 15000, '9865321470', '13 May, 1992', '9 April, 2015', 'A-106, Kanpur.', 0, 0, 0, 0, 'male', 0, 0, 'Jelly', 0, 'madurai', 0),
(10, 107, 'Cheteswar Pujara', 'daily', 300, '2356897410', '7 December, 1995', '23 November, 2016', 'C-107, Bangalore.', 0, 0, 0, 0, 'male', 0, 0, 'Jelly', 0, 'madurai', 0),
(11, 108, 'Dinesh Karthick', 'monthly', 22000, '1679458320', '4 January, 1984', '6 April, 2017', 'DK-108, Chennai.', 0, 0, 0, 0, 'male', 0, 0, 'Jelly', 0, 'madurai', 0),
(14, 109, 'Murali Vijay', 'monthly', 14000, '3468795120', '15 December, 1993', '22 August, 2017', 'M-109, Salem.', 0, 0, 0, 0, 'male', 0, 0, 'Jelly', 0, 'madurai', 0),
(15, 110, 'MS Dhoni', 'monthly', 50000, '0582147963', '14 December, 1981', '7 October, 2009', 'MS-110, Ranchi.', 0, 0, 0, 0, 'male', 0, 0, 'Jelly', 0, 'madurai', 0),
(16, 111, 'Yuvraj Singh', 'daily', 500, '3245619870', '5 May, 1981', '16 March, 2004', 'Y-111, Punjab.', 0, 0, 0, 0, 'male', 0, 0, 'Jelly', 0, 'madurai', 0),
(17, 113, 'Harbhajan Singh', 'monthly', 23000, '3214856970', '14 July, 1982', '15 October, 2002', 'H-113', 0, 0, 0, 0, 'male', 0, 0, 'Jelly', 0, 'madurai', 0),
(18, 114, 'Zaheer Khan', 'monthly', 42000, '3495687210', '4 March, 1980', '19 February, 2003', 'Z-114, Delhi', 0, 0, 0, 0, 'male', 0, 0, 'Jelly', 0, 'madurai', 0),
(19, 112, 'Jadeja', 'daily', 450, '3465127890', '19 December, 1990', '16 August, 2017', 'J-112, Rajasthan.', 0, 0, 0, 0, 'male', 0, 0, 'Jelly', 0, 'madurai', 0),
(20, 115, 'Raina', 'monthly', 12000, '4697851230', '8 April, 1992', '3 October, 2014', 'SR-115, Chennai.', 0, 0, 0, 0, 'male', 0, 0, 'Jelly', 0, 'madurai', 0),
(21, 116, 'Bhuvaneshwar', 'monthly', 8000, '4625789130', '4 October, 1983', '12 October, 2017', 'B-116, Hyderabad.', 0, 0, 0, 0, 'male', 0, 0, 'Jelly', 0, 'madurai', 0),
(22, 118, 'Sachin', 'monthly', 75000, '6175984230', '10 December, 1973', '13 December, 1989', 'SRT-118, Mumbai.', 0, 0, 0, 0, 'male', 0, 0, 'Jelly', 0, 'madurai', 0),
(23, 117, 'Dravid', 'monthly', 34000, '1256789430', '7 March, 1973', '9 April, 1996', 'RD-117, Bangalore.', 0, 0, 0, 0, 'male', 0, 0, 'Jelly', 0, 'madurai', 0),
(24, 119, 'Anil Kumble', 'monthly', 64899, '6124537890', '5 April, 1972', '7 September, 1988', 'AK-119, Bangalore.', 0, 0, 0, 0, 'male', 0, 0, 'Jelly', 0, 'madurai', 0),
(25, 120, 'VVS Lakshman', 'daily', 750, '3245617890', '4 February, 1975', '9 March, 1999', 'VVS-120, Hyderabad.', 0, 0, 0, 0, 'male', 0, 0, 'Jelly', 0, 'madurai', 0),
(26, 121, 'Gambir', 'daily', 462, '3245617890', '2 January, 2008', '12 October, 2017', 'GG-121, Delhi.', 0, 0, 0, 0, 'male', 0, 0, 'Jelly', 0, 'madurai', 0),
(27, 122, 'Shewag', 'daily', 1000, '3215468970', '5 March, 1981', '8 March, 2000', 'S-122, Delhi.', 0, 0, 0, 0, 'male', 0, 0, 'Jelly', 0, 'madurai', 0),
(28, 123, 'Ishanth', 'monthly', 9000, '3245618790', '5 February, 1992', '5 October, 2012', 'I-123, Delhi.', 0, 0, 0, 0, 'male', 0, 0, 'Jelly', 0, 'madurai', 0),
(29, 124, 'Irfan Pathan', 'daily', 350, '7532468910', '7 February, 1986', '4 February, 2004', 'IP-124, Rajasthan.', 0, 0, 0, 0, 'male', 0, 0, 'Jelly', 0, 'madurai', 0),
(30, 125, 'RP Singh', 'monthly', 18006, '9875641230', '16 October, 1985', '1 February, 2017', 'RP-125, Hyderabad.', 0, 0, 0, 0, 'female', 0, 0, 'Jelly', 0, 'madurai', 0),
(31, 126, 'Nehra', 'daily', 560, '6479581230', '2 October, 1980', '6 October, 2017', 'AN-126, Delhi.', 0, 0, 0, 0, 'male', 0, 0, 'Jelly', 0, 'madurai', 0),
(32, 127, 'Agarkar', 'monthly', 13500, '9548627130', '5 February, 1986', '26 March, 2004', 'AA-127, Mumbai.', 0, 0, 0, 0, 'female', 0, 0, 'Jelly', 0, 'madurai', 0),
(33, 128, 'Ganguly', 'monthly', 36500, '6745892130', '6 February, 1973', '12 June, 1996', 'SG-128, Kolkatha.', 0, 0, 0, 0, 'male', 0, 0, 'Jelly', 0, 'madurai', 0),
(34, 129, 'Robin Uthappa', 'monthly', 24600, '9576481230', '8 April, 1986', '16 January, 2014', 'RU-129, Kochin.', 0, 0, 0, 0, 'female', 0, 0, 'Jelly', 0, 'madurai', 0),
(35, 130, 'Sreesanth', 'daily', 842, '6578942310', '9 April, 1986', '29 December, 2009', '            SS-130, Cochin.         ', 1, 0, 0, 0, 'female', 1, 0, 'Cup', 0, '', 0),
(36, 131, 'Kapil', 'daily', 1000, '3451268790', '4 October, 1968', '4 October, 1983', '                                    KD-131, Kanpur.                           ', 1, 0, 0, 0, 'male', 0, 0, 'Jelly', 16546, 'madurai', 4562),
(43, 9876, 'test', 'daily', 4560, '98765432', '1 November, 2017', '7 November, 2017', '            bombay         ', 1, 0, 1, 1, 'female', 1, 0, 'Lollypop', 567678, 'chennai', 654),
(44, 6789, 'test2', 'monthly', 7802, '4564898', '1 November, 2017', '7 November, 2017', 'mumbai', 1, 0, 1, 1, 'female', 1, 1, 'Lollypop', 65478123, 'maduraiBranch', 42056),
(45, 861, 'test3', 'monthly', 45462, '545345', '13 November, 2017', '6 November, 2017', 'dfdhdf', 1, 0, 1, 1, 'male', 0, 0, 'Waffer', 0, '', 0),
(47, 505, 'test5', 'monthly', 25000, '48648435', '6 November, 2017', '21 November, 2017', 'address', 1, 0, 1, 1, 'female', 0, 0, '', 0, '', 0),
(48, 679, 'fixedSaltest', 'monthly', 45662, '4855533', '11 December, 2017', '18 December, 2017', 'sefs', 1, 0, 0, 0, 'female', 1, 0, 'Jelly', 0, '', 0),
(49, 68468, 'sbkskusuhsk', 'monthly', 8465, '48546', '11 December, 2017', '11 December, 2017', 'drhrd', 1, 0, 1, 1, 'male', 0, 0, 'Jelly', 0, '', 0),
(50, 888845, 'testttttt', 'daily', 84654, '465', '4 December, 2017', '20 December, 2017', '                        dsv                  ', 1, 1, 0, 1, 'female', 1, 0, 'Jelly', 0, '', 0),
(51, 95666, 'fdjfj', 'monthly', 46, '68654', '19 December, 2017', '18 December, 2017', '                        fyjgu                  ', 1, 1, 1, 1, 'male', 0, 0, 'Jelly', 0, '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `holidays`
--

CREATE TABLE IF NOT EXISTS `holidays` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `reason` varchar(200) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `holidays`
--

INSERT INTO `holidays` (`id`, `date`, `reason`) VALUES
(15, '2017-09-03', '');

-- --------------------------------------------------------

--
-- Table structure for table `salary`
--

CREATE TABLE IF NOT EXISTS `salary` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `month` varchar(255) NOT NULL,
  `emp_id` int(11) NOT NULL,
  `present` int(11) NOT NULL,
  `absent` int(11) NOT NULL,
  `holiday` int(11) NOT NULL,
  `OT` int(11) NOT NULL,
  `perDay` float NOT NULL,
  `perHour` float NOT NULL,
  `bus_fare` float NOT NULL,
  `mess_fare` float NOT NULL,
  `PF` float NOT NULL,
  `ESI` float NOT NULL,
  `salary` float NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=47 ;

--
-- Dumping data for table `salary`
--

INSERT INTO `salary` (`id`, `month`, `emp_id`, `present`, `absent`, `holiday`, `OT`, `perDay`, `perHour`, `bus_fare`, `mess_fare`, `PF`, `ESI`, `salary`) VALUES
(7, '2017-09', 101, 24, 5, 1, 32, 2000, 210.53, 0, 0, 120, 10, 48607),
(8, '2017-09', 102, 24, 5, 1, 16, 961.54, 101.16, 0, 0, 240, 110, 21460.9),
(9, '2017-09', 130, 16, 13, 1, 24, 842, 88.63, 0, 0, 0, 0, 13073.1),
(10, '2017-09', 131, 16, 13, 1, 0, 1000, 105.26, 0, 0, 0, 0, 13000),
(11, '2017-09', 6789, 16, 13, 1, 16, 300.08, 31.58, 0, 0, 5, 10, 4391.32),
(12, '2017-09', 9876, 16, 13, 1, 0, 4560, 480, 0, 0, 20, 45, 59215),
(19, '2017-10', 101, 24, 7, 0, 32, 2000, 210.53, 465, 0, 280, 60, 43932),
(20, '2017-10', 102, 24, 7, 0, 16, 961.54, 101.16, 0, 1820, 3500, 750, 13817.8),
(21, '2017-10', 130, 16, 15, 0, 24, 842, 88.63, 465, 0, 0, 0, 10924.1),
(22, '2017-10', 131, 16, 15, 0, 0, 1000, 105.26, 0, 0, 0, 0, 11000),
(23, '2017-10', 505, 0, 31, 0, 0, 961.54, 101.16, 0, 0, 3500, 750, -9057.7),
(24, '2017-10', 861, 0, 31, 0, 0, 1748.54, 184, 0, 0, 6364.68, 1363.86, -16471.2),
(25, '2017-10', 6789, 16, 15, 0, 16, 300.08, 31.58, 465, 1820, 1092.28, 234.06, 194.82),
(26, '2017-10', 9876, 16, 15, 0, 0, 4560, 480, 465, 0, 638.4, 136.8, 48919.8),
(35, '2017-11', 101, 1, 29, 0, 0, 2000, 210.53, 456, 0, 240, 35, -6731),
(36, '2017-11', 102, 1, 29, 0, 1, 961.54, 101.16, 0, 1805, 3000, 437.5, -8025.96),
(37, '2017-11', 130, 1, 29, 0, 3, 842, 88.63, 456, 0, 0, 0, -2716.11),
(38, '2017-11', 131, 0, 30, 0, 0, 1000, 105.26, 0, 0, 0, 0, -4000),
(39, '2017-11', 505, 0, 30, 0, 0, 961.54, 101.16, 0, 0, 3000, 437.5, -7283.66),
(40, '2017-11', 679, 0, 30, 0, 0, 1756.23, 184.84, 456, 0, 0, 0, -7480.92),
(41, '2017-11', 861, 0, 30, 0, 0, 1748.54, 184, 0, 0, 5455.44, 795.59, -13245.2),
(42, '2017-11', 6789, 0, 30, 0, 0, 300.08, 31.58, 456, 1805, 936.24, 136.54, -4534.1),
(43, '2017-11', 9876, 0, 30, 0, 0, 4560, 480, 456, 0, 547.2, 79.8, -19323),
(44, '2017-11', 68468, 0, 30, 0, 0, 325.58, 34.21, 0, 0, 1015.8, 148.14, -2466.26),
(45, '2017-11', 95666, 0, 30, 0, 0, 1.77, 0.11, 0, 0, 5.52, 0.81, 46),
(46, '2017-11', 888845, 0, 30, 0, 0, 84654, 8910.95, 456, 0, 0, 1481.45, 84654);

-- --------------------------------------------------------

--
-- Table structure for table `variables`
--

CREATE TABLE IF NOT EXISTS `variables` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `month` varchar(255) NOT NULL,
  `bus_fare` int(11) NOT NULL,
  `mess_fare` int(11) NOT NULL,
  `PF` float NOT NULL,
  `ESI` float NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `variables`
--

INSERT INTO `variables` (`id`, `month`, `bus_fare`, `mess_fare`, `PF`, `ESI`) VALUES
(1, '2017-07', 450, 1800, 10, 3),
(2, '2017-08', 455, 1805, 17, 6),
(3, '2017-09', 460, 1810, 15, 2),
(4, '2017-10', 465, 1820, 14, 3),
(5, '2017-11', 456, 1805, 12, 1.75),
(6, '2017-12', 456, 1805, 12, 1.75);
