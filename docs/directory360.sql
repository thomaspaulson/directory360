-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 02, 2012 at 07:47 AM
-- Server version: 5.5.24-log
-- PHP Version: 5.3.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `directory360`
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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`ID`, `ParentID`, `Name`, `Description`, `Status`, `Created`, `Modified`) VALUES
(1, 0, 'Information Technology', 'lorem ipsum', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 0, 'Consulting', 'Consulting and startegy', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 0, 'Accounting', '', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 0, 'Electrical', 'Electrical engineering', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(5, 0, 'Production', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum', 0, '0000-00-00 00:00:00', '2012-11-11 10:18:28'),
(8, 0, 'test', 'test', 0, '2012-11-13 02:38:46', '0000-00-00 00:00:00'),
(9, 0, 'information technolgoy', 'asdf', 0, '2012-11-23 12:34:53', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE IF NOT EXISTS `jobs` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `UserID` int(11) NOT NULL,
  `CategoryID` int(11) NOT NULL,
  `LocationID` int(11) NOT NULL,
  `Skill` varchar(200) NOT NULL,
  `ShortDesc` varchar(200) NOT NULL,
  `Address` text NOT NULL,
  `City` varchar(100) NOT NULL,
  `District` varchar(100) NOT NULL,
  `Phone` varchar(200) NOT NULL,
  `Email` varchar(200) NOT NULL,
  `WebsiteURL` varchar(200) NOT NULL,
  `DisplayUntil` datetime NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `listing`
--

CREATE TABLE IF NOT EXISTS `listing` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `PageID` int(11) NOT NULL,
  `LocationID` int(11) NOT NULL,
  `CategoryID` int(11) NOT NULL,
  `ShortDesc` varchar(200) NOT NULL,
  `Address` text NOT NULL,
  `City` varchar(100) NOT NULL,
  `District` varchar(100) NOT NULL,
  `Phone` varchar(200) NOT NULL,
  `Email` varchar(200) NOT NULL,
  `WebsiteURL` varchar(200) NOT NULL,
  `Map` text NOT NULL,
  `Image` varchar(100) NOT NULL,
  `Featured` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `listing`
--

INSERT INTO `listing` (`ID`, `PageID`, `LocationID`, `CategoryID`, `ShortDesc`, `Address`, `City`, `District`, `Phone`, `Email`, `WebsiteURL`, `Map`, `Image`, `Featured`) VALUES
(1, 4, 1, 2, '', '', '', '', '', '', '', '', '', 0);

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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `location`
--

INSERT INTO `location` (`ID`, `ParentID`, `Name`, `Description`, `Created`, `Modified`, `Status`) VALUES
(1, 0, 'Kerala', 'Gods own country', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(2, 0, 'Tamil Nadu', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `page`
--

CREATE TABLE IF NOT EXISTS `page` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `ParentID` int(11) NOT NULL DEFAULT '0',
  `UserID` int(11) NOT NULL,
  `URL` varchar(255) NOT NULL,
  `Title` varchar(255) NOT NULL,
  `Content` text NOT NULL,
  `MetaTitle` varchar(255) NOT NULL,
  `MetaDescription` text NOT NULL,
  `MetaKeywords` text NOT NULL,
  `Controller` varchar(100) NOT NULL,
  `ShowInMenus` int(11) NOT NULL,
  `SortOrder` int(11) NOT NULL,
  `Created` datetime NOT NULL,
  `Modified` datetime NOT NULL,
  `Status` int(11) NOT NULL,
  `NumVisit` int(11) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `page`
--

INSERT INTO `page` (`ID`, `ParentID`, `UserID`, `URL`, `Title`, `Content`, `MetaTitle`, `MetaDescription`, `MetaKeywords`, `Controller`, `ShowInMenus`, `SortOrder`, `Created`, `Modified`, `Status`, `NumVisit`) VALUES
(2, 0, 0, 'Home', 'Home', 'Home page contetn', 'Home', 'meeeta desc', 'keywords`', '', 0, 0, '2012-11-23 16:23:55', '2012-11-23 17:56:47', 0, 0),
(3, 0, 2, 'about-us', 'About Us', 'test', '', '', '', '', 0, 0, '2012-11-25 08:46:52', '0000-00-00 00:00:00', 0, 0),
(4, 0, 0, '', 'signcube', '', '', '', '', '', 0, 0, '2012-11-27 23:33:21', '0000-00-00 00:00:00', 0, 0);

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
  `Modified` datetime NOT NULL,
  `Status` tinyint(4) NOT NULL DEFAULT '1',
  `Role` enum('admin','user') NOT NULL DEFAULT 'user',
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`ID`, `FirstName`, `LastName`, `Email`, `Password`, `Created`, `Modified`, `Status`, `Role`) VALUES
(8, 'gmail', '', 'thomaspaulsonmc@gmail.com', 'a435bff43dc3834beb0df406963cb48a', '2012-11-18 12:32:15', '0000-00-00 00:00:00', 1, 'user'),
(2, 'Thomas', 'Paulson', 'thomas.paulson@hotmail.com', 'eb41a8c71ad74a28de6177b6ecc75417', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'admin'),
(9, 'te', '', 'thomaspaulson@gmail.com', '', '2012-11-22 23:23:38', '0000-00-00 00:00:00', 1, 'user');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
