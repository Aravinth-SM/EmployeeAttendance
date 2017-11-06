-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 07, 2017 at 12:11 AM
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
(1, 'Aravinth', 'aravinth', 'sm@12345'),
(2, 'Manickam', 'manickam', 'admin@123');

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE IF NOT EXISTS `attendance` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `emp_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `in_time` time NOT NULL,
  `out_time` time DEFAULT NULL,
  `duration` time DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=90 ;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`id`, `emp_id`, `date`, `in_time`, `out_time`, `duration`) VALUES
(12, 101, '2017-10-25', '23:57:48', NULL, NULL),
(27, 102, '2017-10-26', '00:48:07', '00:49:25', '00:01:18'),
(28, 101, '2017-10-26', '00:49:02', '00:50:10', '00:01:08'),
(65, 101, '2017-10-27', '03:54:13', '07:38:40', '03:44:27'),
(66, 103, '2017-10-28', '21:59:22', '22:07:08', '00:07:46'),
(67, 118, '2017-10-28', '21:59:25', '22:50:54', '00:51:29'),
(68, 108, '2017-10-28', '21:59:26', '22:26:36', '00:27:10'),
(69, 106, '2017-10-28', '21:59:27', '22:27:41', '00:28:14'),
(70, 121, '2017-10-28', '21:59:30', '22:26:41', '00:27:11'),
(71, 101, '2017-10-28', '22:09:34', '23:04:30', '00:54:56'),
(72, 115, '2017-10-28', '22:26:45', NULL, NULL),
(73, 130, '2017-10-28', '22:26:47', NULL, NULL),
(74, 114, '2017-10-28', '22:26:48', NULL, NULL),
(75, 128, '2017-10-28', '22:26:52', '23:23:58', '00:57:06'),
(76, 119, '2017-10-28', '22:27:55', '23:04:36', '00:36:41'),
(77, 113, '2017-10-28', '22:51:18', NULL, NULL),
(78, 104, '2017-10-28', '23:04:33', '23:05:12', '00:00:39'),
(79, 109, '2017-10-28', '23:04:38', NULL, NULL),
(80, 120, '2017-10-28', '23:04:39', NULL, NULL),
(81, 126, '2017-10-28', '23:05:09', NULL, NULL),
(82, 102, '2017-10-28', '23:05:15', NULL, NULL),
(83, 107, '2017-10-28', '23:05:39', NULL, NULL),
(84, 127, '2017-10-28', '23:24:04', NULL, NULL),
(86, 105, '2017-10-29', '02:17:04', NULL, NULL),
(87, 108, '2017-10-29', '02:17:14', NULL, NULL),
(88, 101, '2017-10-29', '02:17:15', NULL, NULL),
(89, 103, '2017-11-07', '01:59:15', NULL, NULL);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=45 ;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`id`, `emp_id`, `name`, `type`, `salary`, `phone`, `DOB`, `DOJ`, `address`, `status`, `PF`, `ESI`, `gender`, `busFare`, `messFare`, `plant`, `bankAccountNumber`, `branchName`, `branchCode`) VALUES
(2, 101, 'Aravinth', 'daily', 2000, '9876543210', '13 October, 2010', '24 October, 2017', 'G-308, Lancor lumina', 1, 0, 0, 'male', 0, 0, 'Jelly', 0, 'madurai', 0),
(3, 102, 'Manickam', 'monthly', 25000, '0123456789', '6 January, 2011', '2 October, 2017', 'm-803', 1, 0, 0, 'male', 0, 0, 'Jelly', 0, 'madurai', 0),
(6, 103, 'Rohit Sharma', 'daily', 250, '0123456789', '4 October, 1972', '3 March, 2017', 'R-103, Madurai.', 1, 0, 0, 'male', 0, 0, 'Jelly', 0, 'madurai', 0),
(7, 105, 'Virat kohli', 'monthly', 25000, '9876543210', '8 June, 1989', '12 March, 2015', 'V-105, Coimbatore.', 1, 0, 0, 'male', 0, 0, 'Jelly', 0, 'madurai', 0),
(8, 104, 'Shikar Dhawan', 'daily', 200, '6543217890', '16 December, 1987', '5 October, 2016', 'S-104, Mumbai.', 1, 0, 0, 'male', 0, 0, 'Jelly', 0, 'madurai', 0),
(9, 106, 'Anjinkya Rahane', 'monthly', 15000, '9865321470', '13 May, 1992', '9 April, 2015', 'A-106, Kanpur.', 1, 0, 0, 'male', 0, 0, 'Jelly', 0, 'madurai', 0),
(10, 107, 'Cheteswar Pujara', 'daily', 300, '2356897410', '7 December, 1995', '23 November, 2016', 'C-107, Bangalore.', 1, 0, 0, 'male', 0, 0, 'Jelly', 0, 'madurai', 0),
(11, 108, 'Dinesh Karthick', 'monthly', 22000, '1679458320', '4 January, 1984', '6 April, 2017', 'DK-108, Chennai.', 1, 0, 0, 'male', 0, 0, 'Jelly', 0, 'madurai', 0),
(14, 109, 'Murali Vijay', 'monthly', 14000, '3468795120', '15 December, 1993', '22 August, 2017', 'M-109, Salem.', 1, 0, 0, 'male', 0, 0, 'Jelly', 0, 'madurai', 0),
(15, 110, 'MS Dhoni', 'monthly', 50000, '0582147963', '14 December, 1981', '7 October, 2009', 'MS-110, Ranchi.', 1, 0, 0, 'male', 0, 0, 'Jelly', 0, 'madurai', 0),
(16, 111, 'Yuvraj Singh', 'daily', 500, '3245619870', '5 May, 1981', '16 March, 2004', 'Y-111, Punjab.', 1, 0, 0, 'male', 0, 0, 'Jelly', 0, 'madurai', 0),
(17, 113, 'Harbhajan Singh', 'monthly', 23000, '3214856970', '14 July, 1982', '15 October, 2002', 'H-113', 1, 0, 0, 'male', 0, 0, 'Jelly', 0, 'madurai', 0),
(18, 114, 'Zaheer Khan', 'monthly', 42000, '3495687210', '4 March, 1980', '19 February, 2003', 'Z-114, Delhi', 1, 0, 0, 'male', 0, 0, 'Jelly', 0, 'madurai', 0),
(19, 112, 'Jadeja', 'daily', 450, '3465127890', '19 December, 1990', '16 August, 2017', 'J-112, Rajasthan.', 1, 0, 0, 'male', 0, 0, 'Jelly', 0, 'madurai', 0),
(20, 115, 'Raina', 'monthly', 12000, '4697851230', '8 April, 1992', '3 October, 2014', 'SR-115, Chennai.', 1, 0, 0, 'male', 0, 0, 'Jelly', 0, 'madurai', 0),
(21, 116, 'Bhuvaneshwar', 'monthly', 8000, '4625789130', '4 October, 1983', '12 October, 2017', 'B-116, Hyderabad.', 1, 0, 0, 'male', 0, 0, 'Jelly', 0, 'madurai', 0),
(22, 118, 'Sachin', 'monthly', 75000, '6175984230', '10 December, 1973', '13 December, 1989', 'SRT-118, Mumbai.', 1, 0, 0, 'male', 0, 0, 'Jelly', 0, 'madurai', 0),
(23, 117, 'Dravid', 'monthly', 34000, '1256789430', '7 March, 1973', '9 April, 1996', 'RD-117, Bangalore.', 1, 0, 0, 'male', 0, 0, 'Jelly', 0, 'madurai', 0),
(24, 119, 'Anil Kumble', 'monthly', 64899, '6124537890', '5 April, 1972', '7 September, 1988', 'AK-119, Bangalore.', 1, 0, 0, 'male', 0, 0, 'Jelly', 0, 'madurai', 0),
(25, 120, 'VVS Lakshman', 'daily', 750, '3245617890', '4 February, 1975', '9 March, 1999', 'VVS-120, Hyderabad.', 1, 0, 0, 'male', 0, 0, 'Jelly', 0, 'madurai', 0),
(26, 121, 'Gambir', 'daily', 462, '3245617890', '2 January, 2008', '12 October, 2017', 'GG-121, Delhi.', 1, 0, 0, 'male', 0, 0, 'Jelly', 0, 'madurai', 0),
(27, 122, 'Shewag', 'daily', 1000, '3215468970', '5 March, 1981', '8 March, 2000', 'S-122, Delhi.', 1, 0, 0, 'male', 0, 0, 'Jelly', 0, 'madurai', 0),
(28, 123, 'Ishanth', 'monthly', 9000, '3245618790', '5 February, 1992', '5 October, 2012', 'I-123, Delhi.', 1, 0, 0, 'male', 0, 0, 'Jelly', 0, 'madurai', 0),
(29, 124, 'Irfan Pathan', 'daily', 350, '7532468910', '7 February, 1986', '4 February, 2004', 'IP-124, Rajasthan.', 1, 0, 0, 'male', 0, 0, 'Jelly', 0, 'madurai', 0),
(30, 125, 'RP Singh', 'monthly', 18006, '9875641230', '16 October, 1985', '1 February, 2017', 'RP-125, Hyderabad.', 1, 0, 0, 'male', 0, 0, 'Jelly', 0, 'madurai', 0),
(31, 126, 'Nehra', 'daily', 560, '6479581230', '2 October, 1980', '6 October, 2017', 'AN-126, Delhi.', 1, 0, 0, 'male', 0, 0, 'Jelly', 0, 'madurai', 0),
(32, 127, 'Agarkar', 'monthly', 13500, '9548627130', '5 February, 1986', '26 March, 2004', 'AA-127, Mumbai.', 1, 0, 0, 'male', 0, 0, 'Jelly', 0, 'madurai', 0),
(33, 128, 'Ganguly', 'monthly', 36500, '6745892130', '6 February, 1973', '12 June, 1996', 'SG-128, Kolkatha.', 1, 0, 0, 'male', 0, 0, 'Jelly', 0, 'madurai', 0),
(34, 129, 'Robin Uthappa', 'monthly', 24600, '9576481230', '8 April, 1986', '16 January, 2014', 'RU-129, Kochin.', 1, 0, 0, 'male', 0, 0, 'Jelly', 0, 'madurai', 0),
(35, 130, 'Sreesanth', 'daily', 842, '6578942310', '9 April, 1986', '29 December, 2009', 'SS-130, Cochin.', 1, 0, 0, 'male', 0, 0, 'Jelly', 0, 'madurai', 0),
(36, 131, 'Kapil', 'daily', 1000, '3451268790', '4 October, 1968', '4 October, 1983', 'KD-131, Kanpur.', 1, 0, 0, 'male', 0, 0, 'Jelly', 0, 'madurai', 0),
(43, 9876, 'test', 'daily', 4560, '98765432', '1 November, 2017', '7 November, 2017', 'bombay', 1, 20, 45, 'female', 1, 0, 'Toy & Jar', 0, '', 0),
(44, 6789, 'test2', 'monthly', 7802, '4564898', '1 November, 2017', '7 November, 2017', 'mumbai', 1, 5, 10, 'male', 1, 1, 'Lollypop', 65478123, 'maduraiBranch', 42056);

-- --------------------------------------------------------

--
-- Table structure for table `holidays`
--

CREATE TABLE IF NOT EXISTS `holidays` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `reason` varchar(200) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=76 ;

--
-- Dumping data for table `holidays`
--

INSERT INTO `holidays` (`id`, `date`, `reason`) VALUES
(73, '2017-10-24', 'test'),
(74, '2017-10-23', 'saturday'),
(75, '2017-10-22', 'sunday');
