-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 24, 2012 at 05:51 PM
-- Server version: 5.5.24-log
-- PHP Version: 5.3.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `directory-in`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `ParentID` int(11) NOT NULL DEFAULT '0',
  `Name` varchar(200) NOT NULL,
  `Description` text NOT NULL,
  `Status` tinyint(4) NOT NULL DEFAULT '1',
  `Created` datetime NOT NULL,
  `Modified` datetime NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`ID`, `ParentID`, `Name`, `Description`, `Status`, `Created`, `Modified`) VALUES
(1, 0, 'Information Technology', 'lorem ipsum', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 0, 'Consulting', 'Consulting and startegy', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 0, 'Accounting', '', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 0, 'Electrical', 'Electrical engineering', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE IF NOT EXISTS `jobs` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `UserID` int(11) NOT NULL,
  `CategoryID` int(11) NOT NULL,
  `Title` varchar(200) NOT NULL,
  `Skill` varchar(200) NOT NULL,
  `ShortDesc` varchar(200) NOT NULL,
  `LongDesc` text NOT NULL,
  `LocationID` int(11) NOT NULL,
  `Address` text NOT NULL,
  `City` varchar(100) NOT NULL,
  `District` varchar(100) NOT NULL,
  `Phone` varchar(200) NOT NULL,
  `Email` varchar(200) NOT NULL,
  `URL` varchar(200) NOT NULL,
  `DisplayUntil` datetime NOT NULL,
  `Created` datetime NOT NULL,
  `Modified` datetime NOT NULL,
  `Status` tinyint(4) NOT NULL DEFAULT '1',
  `Order` tinyint(11) NOT NULL,
  `NumVisit` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `listing`
--

CREATE TABLE IF NOT EXISTS `listing` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `UserID` int(11) NOT NULL,
  `LocationID` int(11) NOT NULL,
  `CategoryID` int(11) NOT NULL,
  `Title` varchar(200) NOT NULL,
  `ShortDesc` varchar(200) NOT NULL,
  `LongDesc` text NOT NULL,
  `Address` text NOT NULL,
  `City` varchar(100) NOT NULL,
  `District` varchar(100) NOT NULL,
  `Phone` varchar(200) NOT NULL,
  `Email` varchar(200) NOT NULL,
  `URL` varchar(200) NOT NULL,
  `Map` text NOT NULL,
  `Image` varchar(100) NOT NULL,
  `Created` datetime NOT NULL,
  `Modified` datetime NOT NULL,
  `Status` tinyint(4) NOT NULL DEFAULT '1',
  `Order` tinyint(11) NOT NULL,
  `NumVisit` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `location`
--

CREATE TABLE IF NOT EXISTS `location` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `ParentID` int(11) NOT NULL DEFAULT '0',
  `Name` varchar(100) NOT NULL,
  `Description` text NOT NULL,
  `Created` datetime NOT NULL,
  `Modified` datetime NOT NULL,
  `Status` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `location`
--

INSERT INTO `location` (`ID`, `ParentID`, `Name`, `Description`, `Created`, `Modified`, `Status`) VALUES
(1, 0, 'Kerala', 'Gods own country', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(2, 0, 'Tamil Nadu', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `FirstName` varchar(100) NOT NULL,
  `LastName` varchar(100) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Password` varchar(100) NOT NULL,
  `Created` datetime NOT NULL,
  `Updated` datetime NOT NULL,
  `Status` tinyint(4) NOT NULL DEFAULT '1',
  `Role` enum('admin','user') NOT NULL DEFAULT 'user',
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`ID`, `FirstName`, `LastName`, `Email`, `Password`, `Created`, `Updated`, `Status`, `Role`) VALUES
(1, 'Thomas', 'Paulson', 'thomas.paulson@hotmail.com', 'mf2ativ32', '2012-05-03 19:40:38', '0000-00-00 00:00:00', 1, 'admin');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
