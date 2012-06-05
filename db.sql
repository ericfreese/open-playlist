-- phpMyAdmin SQL Dump
-- version 3.3.2deb1ubuntu1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 18, 2012 at 09:14 PM
-- Server version: 5.1.62
-- PHP Version: 5.3.2-1ubuntu4.15

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `comrad`
--
CREATE DATABASE `comrad` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `comrad`;

-- --------------------------------------------------------

--
-- Table structure for table `Albums`
--

CREATE TABLE IF NOT EXISTS `Albums` (
  `a_AlbumID` int(11) NOT NULL AUTO_INCREMENT,
  `a_Title` varchar(250) NOT NULL,
  `a_Artist` varchar(250) DEFAULT NULL,
  `a_Label` varchar(250) DEFAULT NULL,
  `a_GenreID` int(11) DEFAULT NULL,
  `a_AddDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `a_Local` tinyint(1) DEFAULT NULL,
  `a_Compilation` tinyint(1) DEFAULT NULL,
  `a_Location` enum('Gnu Bin','Personal','Library','Digital Library','Discarded/Lost') NOT NULL,
  `a_AlbumArt` varchar(500) DEFAULT NULL,
  `a_ITunesId` int(11) DEFAULT NULL,
  PRIMARY KEY (`a_AlbumID`),
  KEY `IX_GenreId` (`a_GenreID`),
  FULLTEXT KEY `a_Title` (`a_Title`,`a_Artist`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `Albums`
--

INSERT INTO `Albums` (`a_AlbumID`, `a_Title`, `a_Artist`, `a_Label`, `a_GenreID`, `a_AddDate`, `a_Local`, `a_Compilation`, `a_Location`, `a_AlbumArt`, `a_ITunesId`) VALUES(1, 'Abbey Road', 'The Beatles', 'Apple', 9, '2012-05-18 20:58:21', NULL, 0, 'Gnu Bin', 'http://a3.mzstatic.com/us/r1000/068/Music/17/07/36/mzi.ldnorbao.100x100-75.jpg', 401186200);

-- --------------------------------------------------------

--
-- Table structure for table `DBObject`
--

CREATE TABLE IF NOT EXISTS `DBObject` (
  `o_Id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `o_ParentId` int(10) DEFAULT NULL,
  `o_Name` varchar(100) NOT NULL,
  PRIMARY KEY (`o_Id`),
  UNIQUE KEY `Name` (`o_Name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=48 ;

--
-- Dumping data for table `DBObject`
--

INSERT INTO `DBObject` (`o_Id`, `o_ParentId`, `o_Name`) VALUES(1, NULL, 'Album');
INSERT INTO `DBObject` (`o_Id`, `o_ParentId`, `o_Name`) VALUES(2, NULL, 'Event');
INSERT INTO `DBObject` (`o_Id`, `o_ParentId`, `o_Name`) VALUES(3, 6, 'AlertEvent');
INSERT INTO `DBObject` (`o_Id`, `o_ParentId`, `o_Name`) VALUES(4, 6, 'AnnouncementEvent');
INSERT INTO `DBObject` (`o_Id`, `o_ParentId`, `o_Name`) VALUES(5, 2, 'EASTestEvent');
INSERT INTO `DBObject` (`o_Id`, `o_ParentId`, `o_Name`) VALUES(6, 2, 'EventWithCopy');
INSERT INTO `DBObject` (`o_Id`, `o_ParentId`, `o_Name`) VALUES(7, 2, 'FeatureEvent');
INSERT INTO `DBObject` (`o_Id`, `o_ParentId`, `o_Name`) VALUES(8, 6, 'LegalIdEvent');
INSERT INTO `DBObject` (`o_Id`, `o_ParentId`, `o_Name`) VALUES(9, 6, 'PSAEvent');
INSERT INTO `DBObject` (`o_Id`, `o_ParentId`, `o_Name`) VALUES(10, 2, 'ShowEvent');
INSERT INTO `DBObject` (`o_Id`, `o_ParentId`, `o_Name`) VALUES(11, 6, 'TicketGiveawayEvent');
INSERT INTO `DBObject` (`o_Id`, `o_ParentId`, `o_Name`) VALUES(12, 6, 'UnderwritingEvent');
INSERT INTO `DBObject` (`o_Id`, `o_ParentId`, `o_Name`) VALUES(13, NULL, 'FloatingShowElement');
INSERT INTO `DBObject` (`o_Id`, `o_ParentId`, `o_Name`) VALUES(14, 13, 'DJComment');
INSERT INTO `DBObject` (`o_Id`, `o_ParentId`, `o_Name`) VALUES(15, 13, 'TrackPlay');
INSERT INTO `DBObject` (`o_Id`, `o_ParentId`, `o_Name`) VALUES(16, 13, 'VoiceBreak');
INSERT INTO `DBObject` (`o_Id`, `o_ParentId`, `o_Name`) VALUES(17, 13, 'FloatingShowEvent');
INSERT INTO `DBObject` (`o_Id`, `o_ParentId`, `o_Name`) VALUES(18, NULL, 'Genre');
INSERT INTO `DBObject` (`o_Id`, `o_ParentId`, `o_Name`) VALUES(19, NULL, 'GenreTag');
INSERT INTO `DBObject` (`o_Id`, `o_ParentId`, `o_Name`) VALUES(20, NULL, 'Host');
INSERT INTO `DBObject` (`o_Id`, `o_ParentId`, `o_Name`) VALUES(21, NULL, 'PSACategory');
INSERT INTO `DBObject` (`o_Id`, `o_ParentId`, `o_Name`) VALUES(22, NULL, 'Role');
INSERT INTO `DBObject` (`o_Id`, `o_ParentId`, `o_Name`) VALUES(23, NULL, 'ScheduledEvent');
INSERT INTO `DBObject` (`o_Id`, `o_ParentId`, `o_Name`) VALUES(24, NULL, 'ScheduledEventInstance');
INSERT INTO `DBObject` (`o_Id`, `o_ParentId`, `o_Name`) VALUES(25, 34, 'ScheduledAlertInstance');
INSERT INTO `DBObject` (`o_Id`, `o_ParentId`, `o_Name`) VALUES(26, 34, 'ScheduledAnnouncementInstance');
INSERT INTO `DBObject` (`o_Id`, `o_ParentId`, `o_Name`) VALUES(27, 34, 'ScheduledEASTestInstance');
INSERT INTO `DBObject` (`o_Id`, `o_ParentId`, `o_Name`) VALUES(28, 34, 'ScheduledFeatureInstance');
INSERT INTO `DBObject` (`o_Id`, `o_ParentId`, `o_Name`) VALUES(29, 34, 'ScheduledLegalIdInstance');
INSERT INTO `DBObject` (`o_Id`, `o_ParentId`, `o_Name`) VALUES(30, 34, 'ScheduledPSAInstance');
INSERT INTO `DBObject` (`o_Id`, `o_ParentId`, `o_Name`) VALUES(31, 24, 'ScheduledShowInstance');
INSERT INTO `DBObject` (`o_Id`, `o_ParentId`, `o_Name`) VALUES(32, 34, 'ScheduledTicketGiveawayInstance');
INSERT INTO `DBObject` (`o_Id`, `o_ParentId`, `o_Name`) VALUES(33, 34, 'ScheduledUnderwritingInstance');
INSERT INTO `DBObject` (`o_Id`, `o_ParentId`, `o_Name`) VALUES(34, 24, 'ExecutableScheduledEventInstance');
INSERT INTO `DBObject` (`o_Id`, `o_ParentId`, `o_Name`) VALUES(35, NULL, 'TimeInfo');
INSERT INTO `DBObject` (`o_Id`, `o_ParentId`, `o_Name`) VALUES(36, 35, 'NonRepeatingTimeInfo');
INSERT INTO `DBObject` (`o_Id`, `o_ParentId`, `o_Name`) VALUES(37, 35, 'RepeatingTimeInfo');
INSERT INTO `DBObject` (`o_Id`, `o_ParentId`, `o_Name`) VALUES(38, 37, 'DailyRepeatingTimeInfo');
INSERT INTO `DBObject` (`o_Id`, `o_ParentId`, `o_Name`) VALUES(39, 37, 'WeeklyRepeatingTimeInfo');
INSERT INTO `DBObject` (`o_Id`, `o_ParentId`, `o_Name`) VALUES(40, 37, 'MonthlyRepeatingTimeInfo');
INSERT INTO `DBObject` (`o_Id`, `o_ParentId`, `o_Name`) VALUES(41, 37, 'YearlyRepeatingTimeInfo');
INSERT INTO `DBObject` (`o_Id`, `o_ParentId`, `o_Name`) VALUES(42, NULL, 'Track');
INSERT INTO `DBObject` (`o_Id`, `o_ParentId`, `o_Name`) VALUES(43, NULL, 'User');
INSERT INTO `DBObject` (`o_Id`, `o_ParentId`, `o_Name`) VALUES(44, NULL, 'Venue');
INSERT INTO `DBObject` (`o_Id`, `o_ParentId`, `o_Name`) VALUES(45, NULL, 'DBObject');
INSERT INTO `DBObject` (`o_Id`, `o_ParentId`, `o_Name`) VALUES(46, NULL, 'DBObjectPermission');
INSERT INTO `DBObject` (`o_Id`, `o_ParentId`, `o_Name`) VALUES(47, NULL, 'ScheduledEventException');

-- --------------------------------------------------------

--
-- Table structure for table `DBObjectPermission`
--

CREATE TABLE IF NOT EXISTS `DBObjectPermission` (
  `op_Id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `op_DBObjectId` int(10) NOT NULL,
  `op_RoleId` int(10) NOT NULL,
  `op_Read` tinyint(1) NOT NULL,
  `op_Write` tinyint(1) NOT NULL,
  `op_Insert` tinyint(1) NOT NULL,
  `op_Delete` tinyint(1) NOT NULL,
  PRIMARY KEY (`op_Id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=540 ;

--
-- Dumping data for table `DBObjectPermission`
--

INSERT INTO `DBObjectPermission` (`op_Id`, `op_DBObjectId`, `op_RoleId`, `op_Read`, `op_Write`, `op_Insert`, `op_Delete`) VALUES(131, 1, 1, 1, 1, 1, 1);
INSERT INTO `DBObjectPermission` (`op_Id`, `op_DBObjectId`, `op_RoleId`, `op_Read`, `op_Write`, `op_Insert`, `op_Delete`) VALUES(132, 2, 1, 1, 1, 1, 1);
INSERT INTO `DBObjectPermission` (`op_Id`, `op_DBObjectId`, `op_RoleId`, `op_Read`, `op_Write`, `op_Insert`, `op_Delete`) VALUES(133, 3, 1, 1, 1, 1, 1);
INSERT INTO `DBObjectPermission` (`op_Id`, `op_DBObjectId`, `op_RoleId`, `op_Read`, `op_Write`, `op_Insert`, `op_Delete`) VALUES(134, 4, 1, 1, 1, 1, 1);
INSERT INTO `DBObjectPermission` (`op_Id`, `op_DBObjectId`, `op_RoleId`, `op_Read`, `op_Write`, `op_Insert`, `op_Delete`) VALUES(135, 5, 1, 1, 1, 1, 1);
INSERT INTO `DBObjectPermission` (`op_Id`, `op_DBObjectId`, `op_RoleId`, `op_Read`, `op_Write`, `op_Insert`, `op_Delete`) VALUES(136, 6, 1, 1, 1, 1, 1);
INSERT INTO `DBObjectPermission` (`op_Id`, `op_DBObjectId`, `op_RoleId`, `op_Read`, `op_Write`, `op_Insert`, `op_Delete`) VALUES(137, 7, 1, 1, 1, 1, 1);
INSERT INTO `DBObjectPermission` (`op_Id`, `op_DBObjectId`, `op_RoleId`, `op_Read`, `op_Write`, `op_Insert`, `op_Delete`) VALUES(138, 8, 1, 1, 1, 1, 1);
INSERT INTO `DBObjectPermission` (`op_Id`, `op_DBObjectId`, `op_RoleId`, `op_Read`, `op_Write`, `op_Insert`, `op_Delete`) VALUES(139, 9, 1, 1, 1, 1, 1);
INSERT INTO `DBObjectPermission` (`op_Id`, `op_DBObjectId`, `op_RoleId`, `op_Read`, `op_Write`, `op_Insert`, `op_Delete`) VALUES(140, 10, 1, 1, 1, 1, 1);
INSERT INTO `DBObjectPermission` (`op_Id`, `op_DBObjectId`, `op_RoleId`, `op_Read`, `op_Write`, `op_Insert`, `op_Delete`) VALUES(141, 11, 1, 1, 1, 1, 1);
INSERT INTO `DBObjectPermission` (`op_Id`, `op_DBObjectId`, `op_RoleId`, `op_Read`, `op_Write`, `op_Insert`, `op_Delete`) VALUES(142, 12, 1, 1, 1, 1, 1);
INSERT INTO `DBObjectPermission` (`op_Id`, `op_DBObjectId`, `op_RoleId`, `op_Read`, `op_Write`, `op_Insert`, `op_Delete`) VALUES(143, 13, 1, 1, 1, 1, 1);
INSERT INTO `DBObjectPermission` (`op_Id`, `op_DBObjectId`, `op_RoleId`, `op_Read`, `op_Write`, `op_Insert`, `op_Delete`) VALUES(144, 14, 1, 1, 1, 1, 1);
INSERT INTO `DBObjectPermission` (`op_Id`, `op_DBObjectId`, `op_RoleId`, `op_Read`, `op_Write`, `op_Insert`, `op_Delete`) VALUES(145, 15, 1, 1, 1, 1, 1);
INSERT INTO `DBObjectPermission` (`op_Id`, `op_DBObjectId`, `op_RoleId`, `op_Read`, `op_Write`, `op_Insert`, `op_Delete`) VALUES(146, 16, 1, 1, 1, 1, 1);
INSERT INTO `DBObjectPermission` (`op_Id`, `op_DBObjectId`, `op_RoleId`, `op_Read`, `op_Write`, `op_Insert`, `op_Delete`) VALUES(147, 17, 1, 1, 1, 1, 1);
INSERT INTO `DBObjectPermission` (`op_Id`, `op_DBObjectId`, `op_RoleId`, `op_Read`, `op_Write`, `op_Insert`, `op_Delete`) VALUES(148, 18, 1, 1, 1, 1, 1);
INSERT INTO `DBObjectPermission` (`op_Id`, `op_DBObjectId`, `op_RoleId`, `op_Read`, `op_Write`, `op_Insert`, `op_Delete`) VALUES(149, 19, 1, 1, 1, 1, 1);
INSERT INTO `DBObjectPermission` (`op_Id`, `op_DBObjectId`, `op_RoleId`, `op_Read`, `op_Write`, `op_Insert`, `op_Delete`) VALUES(150, 20, 1, 1, 1, 1, 1);
INSERT INTO `DBObjectPermission` (`op_Id`, `op_DBObjectId`, `op_RoleId`, `op_Read`, `op_Write`, `op_Insert`, `op_Delete`) VALUES(151, 21, 1, 1, 1, 1, 1);
INSERT INTO `DBObjectPermission` (`op_Id`, `op_DBObjectId`, `op_RoleId`, `op_Read`, `op_Write`, `op_Insert`, `op_Delete`) VALUES(152, 22, 1, 1, 1, 1, 1);
INSERT INTO `DBObjectPermission` (`op_Id`, `op_DBObjectId`, `op_RoleId`, `op_Read`, `op_Write`, `op_Insert`, `op_Delete`) VALUES(153, 23, 1, 1, 1, 1, 1);
INSERT INTO `DBObjectPermission` (`op_Id`, `op_DBObjectId`, `op_RoleId`, `op_Read`, `op_Write`, `op_Insert`, `op_Delete`) VALUES(154, 24, 1, 1, 1, 1, 1);
INSERT INTO `DBObjectPermission` (`op_Id`, `op_DBObjectId`, `op_RoleId`, `op_Read`, `op_Write`, `op_Insert`, `op_Delete`) VALUES(155, 25, 1, 1, 1, 1, 1);
INSERT INTO `DBObjectPermission` (`op_Id`, `op_DBObjectId`, `op_RoleId`, `op_Read`, `op_Write`, `op_Insert`, `op_Delete`) VALUES(156, 26, 1, 1, 1, 1, 1);
INSERT INTO `DBObjectPermission` (`op_Id`, `op_DBObjectId`, `op_RoleId`, `op_Read`, `op_Write`, `op_Insert`, `op_Delete`) VALUES(157, 27, 1, 1, 1, 1, 1);
INSERT INTO `DBObjectPermission` (`op_Id`, `op_DBObjectId`, `op_RoleId`, `op_Read`, `op_Write`, `op_Insert`, `op_Delete`) VALUES(158, 28, 1, 1, 1, 1, 1);
INSERT INTO `DBObjectPermission` (`op_Id`, `op_DBObjectId`, `op_RoleId`, `op_Read`, `op_Write`, `op_Insert`, `op_Delete`) VALUES(159, 29, 1, 1, 1, 1, 1);
INSERT INTO `DBObjectPermission` (`op_Id`, `op_DBObjectId`, `op_RoleId`, `op_Read`, `op_Write`, `op_Insert`, `op_Delete`) VALUES(160, 30, 1, 1, 1, 1, 1);
INSERT INTO `DBObjectPermission` (`op_Id`, `op_DBObjectId`, `op_RoleId`, `op_Read`, `op_Write`, `op_Insert`, `op_Delete`) VALUES(161, 31, 1, 1, 1, 1, 1);
INSERT INTO `DBObjectPermission` (`op_Id`, `op_DBObjectId`, `op_RoleId`, `op_Read`, `op_Write`, `op_Insert`, `op_Delete`) VALUES(162, 32, 1, 1, 1, 1, 1);
INSERT INTO `DBObjectPermission` (`op_Id`, `op_DBObjectId`, `op_RoleId`, `op_Read`, `op_Write`, `op_Insert`, `op_Delete`) VALUES(163, 33, 1, 1, 1, 1, 1);
INSERT INTO `DBObjectPermission` (`op_Id`, `op_DBObjectId`, `op_RoleId`, `op_Read`, `op_Write`, `op_Insert`, `op_Delete`) VALUES(164, 34, 1, 1, 1, 1, 1);
INSERT INTO `DBObjectPermission` (`op_Id`, `op_DBObjectId`, `op_RoleId`, `op_Read`, `op_Write`, `op_Insert`, `op_Delete`) VALUES(165, 35, 1, 1, 1, 1, 1);
INSERT INTO `DBObjectPermission` (`op_Id`, `op_DBObjectId`, `op_RoleId`, `op_Read`, `op_Write`, `op_Insert`, `op_Delete`) VALUES(166, 36, 1, 1, 1, 1, 1);
INSERT INTO `DBObjectPermission` (`op_Id`, `op_DBObjectId`, `op_RoleId`, `op_Read`, `op_Write`, `op_Insert`, `op_Delete`) VALUES(167, 37, 1, 1, 1, 1, 1);
INSERT INTO `DBObjectPermission` (`op_Id`, `op_DBObjectId`, `op_RoleId`, `op_Read`, `op_Write`, `op_Insert`, `op_Delete`) VALUES(168, 38, 1, 1, 1, 1, 1);
INSERT INTO `DBObjectPermission` (`op_Id`, `op_DBObjectId`, `op_RoleId`, `op_Read`, `op_Write`, `op_Insert`, `op_Delete`) VALUES(169, 39, 1, 1, 1, 1, 1);
INSERT INTO `DBObjectPermission` (`op_Id`, `op_DBObjectId`, `op_RoleId`, `op_Read`, `op_Write`, `op_Insert`, `op_Delete`) VALUES(170, 40, 1, 1, 1, 1, 1);
INSERT INTO `DBObjectPermission` (`op_Id`, `op_DBObjectId`, `op_RoleId`, `op_Read`, `op_Write`, `op_Insert`, `op_Delete`) VALUES(171, 41, 1, 1, 1, 1, 1);
INSERT INTO `DBObjectPermission` (`op_Id`, `op_DBObjectId`, `op_RoleId`, `op_Read`, `op_Write`, `op_Insert`, `op_Delete`) VALUES(172, 42, 1, 1, 1, 1, 1);
INSERT INTO `DBObjectPermission` (`op_Id`, `op_DBObjectId`, `op_RoleId`, `op_Read`, `op_Write`, `op_Insert`, `op_Delete`) VALUES(173, 43, 1, 1, 1, 1, 1);
INSERT INTO `DBObjectPermission` (`op_Id`, `op_DBObjectId`, `op_RoleId`, `op_Read`, `op_Write`, `op_Insert`, `op_Delete`) VALUES(174, 44, 1, 1, 1, 1, 1);
INSERT INTO `DBObjectPermission` (`op_Id`, `op_DBObjectId`, `op_RoleId`, `op_Read`, `op_Write`, `op_Insert`, `op_Delete`) VALUES(175, 45, 1, 1, 1, 1, 1);
INSERT INTO `DBObjectPermission` (`op_Id`, `op_DBObjectId`, `op_RoleId`, `op_Read`, `op_Write`, `op_Insert`, `op_Delete`) VALUES(176, 46, 1, 1, 1, 1, 1);
INSERT INTO `DBObjectPermission` (`op_Id`, `op_DBObjectId`, `op_RoleId`, `op_Read`, `op_Write`, `op_Insert`, `op_Delete`) VALUES(177, 47, 1, 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `Event`
--

CREATE TABLE IF NOT EXISTS `Event` (
  `e_Id` int(11) NOT NULL AUTO_INCREMENT,
  `e_DISCRIMINATOR` enum('AlertEvent','AnnouncementEvent','EASTestEvent','FeatureEvent','LegalIdEvent','PSAEvent','ShowEvent','TicketGiveawayEvent','UnderwritingEvent') NOT NULL,
  `e_ProducerName` varchar(256) DEFAULT NULL,
  `e_GuestName` varchar(256) DEFAULT NULL,
  `e_Description` text,
  `e_InternalNote` varchar(256) DEFAULT NULL,
  `e_PSACategoryId` int(10) DEFAULT NULL,
  `e_StartDate` date DEFAULT NULL,
  `e_KillDate` date DEFAULT NULL,
  `e_Title` text NOT NULL,
  `e_Copy` text,
  `e_OrgName` text,
  `e_ContactName` text,
  `e_ContactPhone` text,
  `e_ContactWebsite` text,
  `e_ContactEmail` text,
  `e_Active` tinyint(1) NOT NULL,
  `e_EventDate` datetime DEFAULT NULL,
  `e_VenueId` int(10) DEFAULT NULL,
  `e_WinnerName` varchar(256) DEFAULT NULL,
  `e_WinnerPhone` varchar(20) DEFAULT NULL,
  `e_TicketType` enum('Hard Ticket','Guest List') DEFAULT NULL,
  `e_HasHost` tinyint(1) DEFAULT NULL,
  `e_HostId` int(10) DEFAULT NULL,
  `e_RecordAudio` tinyint(1) DEFAULT NULL,
  `e_URL` varchar(256) DEFAULT NULL,
  `e_Source` enum('KGNU','Ext') DEFAULT NULL,
  `e_Category` enum('Announcements','Mix','Music','NewsPA','OurMusic') DEFAULT NULL,
  `e_Class` varchar(256) DEFAULT NULL,
  `e_ShortDescription` varchar(256) DEFAULT NULL,
  `e_LongDescription` text,
  PRIMARY KEY (`e_Id`),
  KEY `IX_HostId` (`e_HostId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `Event`
--


-- --------------------------------------------------------

--
-- Table structure for table `FloatingShowElement`
--

CREATE TABLE IF NOT EXISTS `FloatingShowElement` (
  `fse_Id` int(10) NOT NULL AUTO_INCREMENT,
  `fse_DISCRIMINATOR` enum('TrackPlay','DJComment','VoiceBreak','FloatingShowEvent') NOT NULL,
  `fse_ScheduledShowInstanceId` int(10) NOT NULL,
  `fse_StartDateTime` datetime NOT NULL,
  `fse_Executed` datetime DEFAULT NULL,
  `fse_TrackId` int(10) DEFAULT NULL,
  `fse_Body` text,
  `fse_EventId` int(10) DEFAULT NULL,
  PRIMARY KEY (`fse_Id`),
  KEY `IX_TrackId` (`fse_TrackId`),
  KEY `IX_EventId` (`fse_EventId`),
  KEY `IX_Executed` (`fse_Executed`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `FloatingShowElement`
--


-- --------------------------------------------------------

--
-- Table structure for table `GenreTags`
--

CREATE TABLE IF NOT EXISTS `GenreTags` (
  `gt_GenreTagID` int(11) NOT NULL AUTO_INCREMENT,
  `gt_GenreID` int(11) NOT NULL,
  `gt_AlbumID` int(11) NOT NULL,
  PRIMARY KEY (`gt_GenreTagID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `GenreTags`
--


-- --------------------------------------------------------

--
-- Table structure for table `Genres`
--

CREATE TABLE IF NOT EXISTS `Genres` (
  `g_GenreID` int(11) NOT NULL AUTO_INCREMENT,
  `g_Name` text NOT NULL,
  `g_TopLevel` tinyint(1) NOT NULL,
  PRIMARY KEY (`g_GenreID`),
  FULLTEXT KEY `g_Name` (`g_Name`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=283 ;

--
-- Dumping data for table `Genres`
--

INSERT INTO `Genres` (`g_GenreID`, `g_Name`, `g_TopLevel`) VALUES(64, 'Rap Star', 1);
INSERT INTO `Genres` (`g_GenreID`, `g_Name`, `g_TopLevel`) VALUES(99, 'Unknown', 1);
INSERT INTO `Genres` (`g_GenreID`, `g_Name`, `g_TopLevel`) VALUES(27, 'Hip Hop', 1);
INSERT INTO `Genres` (`g_GenreID`, `g_Name`, `g_TopLevel`) VALUES(26, 'Childrens', 1);
INSERT INTO `Genres` (`g_GenreID`, `g_Name`, `g_TopLevel`) VALUES(24, 'Zydeco', 1);
INSERT INTO `Genres` (`g_GenreID`, `g_Name`, `g_TopLevel`) VALUES(23, 'Cajun', 1);
INSERT INTO `Genres` (`g_GenreID`, `g_Name`, `g_TopLevel`) VALUES(22, 'Ragtime', 1);
INSERT INTO `Genres` (`g_GenreID`, `g_Name`, `g_TopLevel`) VALUES(21, 'Celtic', 1);
INSERT INTO `Genres` (`g_GenreID`, `g_Name`, `g_TopLevel`) VALUES(20, 'Humor', 1);
INSERT INTO `Genres` (`g_GenreID`, `g_Name`, `g_TopLevel`) VALUES(19, 'Modern', 1);
INSERT INTO `Genres` (`g_GenreID`, `g_Name`, `g_TopLevel`) VALUES(18, 'Techno', 1);
INSERT INTO `Genres` (`g_GenreID`, `g_Name`, `g_TopLevel`) VALUES(17, 'Xmas', 1);
INSERT INTO `Genres` (`g_GenreID`, `g_Name`, `g_TopLevel`) VALUES(16, 'Rap', 1);
INSERT INTO `Genres` (`g_GenreID`, `g_Name`, `g_TopLevel`) VALUES(15, 'R & B', 1);
INSERT INTO `Genres` (`g_GenreID`, `g_Name`, `g_TopLevel`) VALUES(14, 'Gospel', 1);
INSERT INTO `Genres` (`g_GenreID`, `g_Name`, `g_TopLevel`) VALUES(13, 'Bluegrass', 1);
INSERT INTO `Genres` (`g_GenreID`, `g_Name`, `g_TopLevel`) VALUES(12, 'Soundtrack', 1);
INSERT INTO `Genres` (`g_GenreID`, `g_Name`, `g_TopLevel`) VALUES(11, 'Spoken Word', 1);
INSERT INTO `Genres` (`g_GenreID`, `g_Name`, `g_TopLevel`) VALUES(10, 'Space', 1);
INSERT INTO `Genres` (`g_GenreID`, `g_Name`, `g_TopLevel`) VALUES(9, 'Rock', 1);
INSERT INTO `Genres` (`g_GenreID`, `g_Name`, `g_TopLevel`) VALUES(8, 'Lounge/Schlock', 1);
INSERT INTO `Genres` (`g_GenreID`, `g_Name`, `g_TopLevel`) VALUES(7, 'Jazz', 1);
INSERT INTO `Genres` (`g_GenreID`, `g_Name`, `g_TopLevel`) VALUES(6, 'International', 1);
INSERT INTO `Genres` (`g_GenreID`, `g_Name`, `g_TopLevel`) VALUES(5, 'Country', 1);
INSERT INTO `Genres` (`g_GenreID`, `g_Name`, `g_TopLevel`) VALUES(4, 'Folk', 1);
INSERT INTO `Genres` (`g_GenreID`, `g_Name`, `g_TopLevel`) VALUES(3, 'Classical', 1);
INSERT INTO `Genres` (`g_GenreID`, `g_Name`, `g_TopLevel`) VALUES(2, 'Blues', 1);
INSERT INTO `Genres` (`g_GenreID`, `g_Name`, `g_TopLevel`) VALUES(1, 'Reggae', 1);

-- --------------------------------------------------------

--
-- Table structure for table `Host`
--

CREATE TABLE IF NOT EXISTS `Host` (
  `UID` int(11) NOT NULL AUTO_INCREMENT,
  `Name` text NOT NULL,
  `Active` tinyint(1) NOT NULL DEFAULT '1',
  `Internal` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`UID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `Host`
--

INSERT INTO `Host` (`UID`, `Name`, `Active`, `Internal`) VALUES(1, 'Bob Loblaw', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `PSACategory`
--

CREATE TABLE IF NOT EXISTS `PSACategory` (
  `Id` int(10) NOT NULL AUTO_INCREMENT,
  `Title` varchar(64) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=19 ;

--
-- Dumping data for table `PSACategory`
--

INSERT INTO `PSACategory` (`Id`, `Title`) VALUES(1, 'Benefit');
INSERT INTO `PSACategory` (`Id`, `Title`) VALUES(2, 'Arts/Film/Performance');
INSERT INTO `PSACategory` (`Id`, `Title`) VALUES(3, 'Environment');
INSERT INTO `PSACategory` (`Id`, `Title`) VALUES(4, 'Education');
INSERT INTO `PSACategory` (`Id`, `Title`) VALUES(5, 'Women');
INSERT INTO `PSACategory` (`Id`, `Title`) VALUES(6, 'Health');
INSERT INTO `PSACategory` (`Id`, `Title`) VALUES(7, 'Animals');
INSERT INTO `PSACategory` (`Id`, `Title`) VALUES(8, 'Workshop/Self-Help');
INSERT INTO `PSACategory` (`Id`, `Title`) VALUES(9, 'Youth/Child');
INSERT INTO `PSACategory` (`Id`, `Title`) VALUES(10, 'Lecture');
INSERT INTO `PSACategory` (`Id`, `Title`) VALUES(11, 'Political');
INSERT INTO `PSACategory` (`Id`, `Title`) VALUES(12, 'Seniors');
INSERT INTO `PSACategory` (`Id`, `Title`) VALUES(13, 'Support');
INSERT INTO `PSACategory` (`Id`, `Title`) VALUES(14, 'Volunteer');
INSERT INTO `PSACategory` (`Id`, `Title`) VALUES(15, 'Public Meetings');
INSERT INTO `PSACategory` (`Id`, `Title`) VALUES(16, 'Miscellaneous');
INSERT INTO `PSACategory` (`Id`, `Title`) VALUES(17, 'Recreation/Dance');
INSERT INTO `PSACategory` (`Id`, `Title`) VALUES(18, 'Special Events/Seasonal');

-- --------------------------------------------------------

--
-- Table structure for table `Role`
--

CREATE TABLE IF NOT EXISTS `Role` (
  `Id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`Id`),
  UNIQUE KEY `Name` (`Name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=7 ;

--
-- Dumping data for table `Role`
--

INSERT INTO `Role` (`Id`, `Name`) VALUES(1, 'administrator');

-- --------------------------------------------------------

--
-- Table structure for table `ScheduledEvent`
--

CREATE TABLE IF NOT EXISTS `ScheduledEvent` (
  `se_Id` int(10) NOT NULL AUTO_INCREMENT,
  `se_EventId` int(10) NOT NULL,
  `se_TimeInfoId` int(10) NOT NULL,
  `se_RecordingOffset` int(2) NOT NULL DEFAULT '0' COMMENT '(in minutes)',
  PRIMARY KEY (`se_Id`),
  KEY `IX_EventId` (`se_EventId`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `ScheduledEvent`
--


-- --------------------------------------------------------

--
-- Table structure for table `ScheduledEventException`
--

CREATE TABLE IF NOT EXISTS `ScheduledEventException` (
  `see_Id` int(10) NOT NULL AUTO_INCREMENT,
  `see_ScheduledEventId` int(10) NOT NULL,
  `see_ExceptionDate` date NOT NULL,
  PRIMARY KEY (`see_Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `ScheduledEventException`
--


-- --------------------------------------------------------

--
-- Table structure for table `ScheduledEventInstance`
--

CREATE TABLE IF NOT EXISTS `ScheduledEventInstance` (
  `sei_Id` int(11) NOT NULL AUTO_INCREMENT,
  `sei_DISCRIMINATOR` enum('ScheduledAlertInstance','ScheduledAnnouncementInstance','ScheduledEASTestInstance','ScheduledFeatureInstance','ScheduledLegalIdInstance','ScheduledPSAInstance','ScheduledShowInstance','ScheduledTicketGiveawayInstance','ScheduledUnderwritingInstance') NOT NULL,
  `sei_ScheduledEventId` int(10) NOT NULL,
  `sei_StartDateTime` datetime NOT NULL,
  `sei_Duration` int(5) NOT NULL,
  `sei_Executed` datetime DEFAULT NULL,
  `sei_Order` int(5) DEFAULT NULL,
  `sei_GuestName` varchar(256) DEFAULT NULL,
  `sei_Description` text,
  `sei_InternalNote` varchar(256) DEFAULT NULL,
  `sei_Copy` text,
  `sei_EventDate` datetime DEFAULT NULL,
  `sei_VenueId` int(10) DEFAULT NULL,
  `sei_WinnerName` varchar(256) DEFAULT NULL,
  `sei_WinnerPhone` varchar(20) DEFAULT NULL,
  `sei_TicketType` enum('Hard Ticket','Guest List') DEFAULT NULL,
  `sei_HostId` int(10) DEFAULT NULL,
  `sei_ShortDescription` varchar(256) DEFAULT NULL,
  `sei_LongDescription` text,
  `sei_RecordedFileName` varchar(256) DEFAULT NULL,
  PRIMARY KEY (`sei_Id`),
  KEY `IX_Discriminator` (`sei_DISCRIMINATOR`),
  KEY `IX_StartDateTime` (`sei_StartDateTime`),
  KEY `IX_ScheduledEventId` (`sei_ScheduledEventId`),
  KEY `IX_Executed` (`sei_Executed`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `ScheduledEventInstance`
--


-- --------------------------------------------------------

--
-- Table structure for table `TimeInfo`
--

CREATE TABLE IF NOT EXISTS `TimeInfo` (
  `ti_Id` int(11) NOT NULL AUTO_INCREMENT,
  `ti_DISCRIMINATOR` enum('NonRepeatingTimeInfo','DailyRepeatingTimeInfo','WeeklyRepeatingTimeInfo','MonthlyRepeatingTimeInfo','YearlyRepeatingTimeInfo') NOT NULL,
  `ti_StartDateTime` datetime NOT NULL,
  `ti_Duration` int(5) NOT NULL,
  `ti_EndDate` date DEFAULT NULL COMMENT 'Inclusive',
  `ti_Interval` int(5) DEFAULT NULL,
  `ti_WeeklyOnSunday` tinyint(1) DEFAULT NULL,
  `ti_WeeklyOnMonday` tinyint(1) DEFAULT NULL,
  `ti_WeeklyOnTuesday` tinyint(1) DEFAULT NULL,
  `ti_WeeklyOnWednesday` tinyint(1) DEFAULT NULL,
  `ti_WeeklyOnThursday` tinyint(1) DEFAULT NULL,
  `ti_WeeklyOnFriday` tinyint(1) DEFAULT NULL,
  `ti_WeeklyOnSaturday` tinyint(1) DEFAULT NULL,
  `ti_MonthlyRepeatBy` enum('DAY_OF_MONTH','DAY_OF_WEEK') DEFAULT NULL,
  PRIMARY KEY (`ti_Id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `TimeInfo`
--


-- --------------------------------------------------------

--
-- Table structure for table `Tracks`
--

CREATE TABLE IF NOT EXISTS `Tracks` (
  `t_TrackID` int(11) NOT NULL AUTO_INCREMENT,
  `t_AlbumID` int(11) NOT NULL,
  `t_Title` varchar(250) NOT NULL,
  `t_TrackNumber` smallint(6) NOT NULL,
  `t_Artist` varchar(250) DEFAULT NULL,
  `t_DiskNumber` smallint(6) DEFAULT NULL,
  `t_Duration` int(11) NOT NULL,
  PRIMARY KEY (`t_TrackID`),
  KEY `IX_AlbumId` (`t_AlbumID`),
  FULLTEXT KEY `t_Title` (`t_Title`,`t_Artist`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=19 ;

--
-- Dumping data for table `Tracks`
--

INSERT INTO `Tracks` (`t_TrackID`, `t_AlbumID`, `t_Title`, `t_TrackNumber`, `t_Artist`, `t_DiskNumber`, `t_Duration`) VALUES(1, 1, 'Come Together', 1, '', 1, 259);
INSERT INTO `Tracks` (`t_TrackID`, `t_AlbumID`, `t_Title`, `t_TrackNumber`, `t_Artist`, `t_DiskNumber`, `t_Duration`) VALUES(2, 1, 'Something', 2, '', 1, 182);
INSERT INTO `Tracks` (`t_TrackID`, `t_AlbumID`, `t_Title`, `t_TrackNumber`, `t_Artist`, `t_DiskNumber`, `t_Duration`) VALUES(3, 1, 'Maxwell''s Silver Hammer', 3, '', 1, 208);
INSERT INTO `Tracks` (`t_TrackID`, `t_AlbumID`, `t_Title`, `t_TrackNumber`, `t_Artist`, `t_DiskNumber`, `t_Duration`) VALUES(4, 1, 'Oh! Darling', 4, '', 1, 207);
INSERT INTO `Tracks` (`t_TrackID`, `t_AlbumID`, `t_Title`, `t_TrackNumber`, `t_Artist`, `t_DiskNumber`, `t_Duration`) VALUES(5, 1, 'Octopus''s Garden', 5, '', 1, 171);
INSERT INTO `Tracks` (`t_TrackID`, `t_AlbumID`, `t_Title`, `t_TrackNumber`, `t_Artist`, `t_DiskNumber`, `t_Duration`) VALUES(6, 1, 'I Want You (She''s So Heavy)', 6, '', 1, 467);
INSERT INTO `Tracks` (`t_TrackID`, `t_AlbumID`, `t_Title`, `t_TrackNumber`, `t_Artist`, `t_DiskNumber`, `t_Duration`) VALUES(7, 1, 'Here Comes the Sun', 7, '', 1, 186);
INSERT INTO `Tracks` (`t_TrackID`, `t_AlbumID`, `t_Title`, `t_TrackNumber`, `t_Artist`, `t_DiskNumber`, `t_Duration`) VALUES(8, 1, 'Because', 8, '', 1, 166);
INSERT INTO `Tracks` (`t_TrackID`, `t_AlbumID`, `t_Title`, `t_TrackNumber`, `t_Artist`, `t_DiskNumber`, `t_Duration`) VALUES(9, 1, 'You Never Give Me Your Money', 9, '', 1, 243);
INSERT INTO `Tracks` (`t_TrackID`, `t_AlbumID`, `t_Title`, `t_TrackNumber`, `t_Artist`, `t_DiskNumber`, `t_Duration`) VALUES(10, 1, 'Sun King', 10, '', 1, 146);
INSERT INTO `Tracks` (`t_TrackID`, `t_AlbumID`, `t_Title`, `t_TrackNumber`, `t_Artist`, `t_DiskNumber`, `t_Duration`) VALUES(11, 1, 'Mean Mr. Mustard', 11, '', 1, 67);
INSERT INTO `Tracks` (`t_TrackID`, `t_AlbumID`, `t_Title`, `t_TrackNumber`, `t_Artist`, `t_DiskNumber`, `t_Duration`) VALUES(12, 1, 'Polythene Pam', 12, '', 1, 73);
INSERT INTO `Tracks` (`t_TrackID`, `t_AlbumID`, `t_Title`, `t_TrackNumber`, `t_Artist`, `t_DiskNumber`, `t_Duration`) VALUES(13, 1, 'She Came In Through the Bathroom Window', 13, '', 1, 119);
INSERT INTO `Tracks` (`t_TrackID`, `t_AlbumID`, `t_Title`, `t_TrackNumber`, `t_Artist`, `t_DiskNumber`, `t_Duration`) VALUES(14, 1, 'Golden Slumbers', 14, '', 1, 92);
INSERT INTO `Tracks` (`t_TrackID`, `t_AlbumID`, `t_Title`, `t_TrackNumber`, `t_Artist`, `t_DiskNumber`, `t_Duration`) VALUES(15, 1, 'Carry That Weight', 15, '', 1, 96);
INSERT INTO `Tracks` (`t_TrackID`, `t_AlbumID`, `t_Title`, `t_TrackNumber`, `t_Artist`, `t_DiskNumber`, `t_Duration`) VALUES(16, 1, 'The End', 16, '', 1, 142);
INSERT INTO `Tracks` (`t_TrackID`, `t_AlbumID`, `t_Title`, `t_TrackNumber`, `t_Artist`, `t_DiskNumber`, `t_Duration`) VALUES(17, 1, 'Her Majesty', 17, '', 1, 24);
INSERT INTO `Tracks` (`t_TrackID`, `t_AlbumID`, `t_Title`, `t_TrackNumber`, `t_Artist`, `t_DiskNumber`, `t_Duration`) VALUES(18, 1, 'Abbey Road (Documentary)', 18, '', 1, 232);

-- --------------------------------------------------------

--
-- Table structure for table `User`
--

CREATE TABLE IF NOT EXISTS `User` (
  `Id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Username` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `PasswordHash` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `RoleId` int(10) unsigned NOT NULL,
  `LastVisit` datetime DEFAULT NULL,
  `Shared` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`Id`),
  UNIQUE KEY `Username` (`Username`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=28 ;

--
-- Dumping data for table `User`
--

INSERT INTO `User` (`Id`, `Username`, `PasswordHash`, `RoleId`, `LastVisit`, `Shared`) VALUES(1, 'root', 'cd78abd152b9c698766c4c16738bd104', 1, '2011-05-29 18:37:19', 0);

-- --------------------------------------------------------

--
-- Table structure for table `Venue`
--

CREATE TABLE IF NOT EXISTS `Venue` (
  `UID` int(11) NOT NULL AUTO_INCREMENT,
  `Name` text NOT NULL,
  `Location` text NOT NULL,
  `URL` varchar(200) NOT NULL,
  `Active` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`UID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `Venue`
--

