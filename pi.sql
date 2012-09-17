-- phpMyAdmin SQL Dump
-- version 3.4.11.1deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 16, 2012 at 06:11 PM
-- Server version: 5.5.24
-- PHP Version: 5.4.4-2

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `pi`
--

-- --------------------------------------------------------

--
-- Table structure for table `configuration`
--

CREATE TABLE IF NOT EXISTS `configuration` (
  `key` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `value` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `type` enum('int','string','boolean','long') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'string',
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `configuration`
--

INSERT INTO `configuration` (`key`, `value`, `type`) VALUES
('boostTime', '60', 'int'),
('heatingBoost', 'false', 'boolean'),
('heatingBoostOffTime', '1347789155119', 'long'),
('heatingStatus', 'false', 'boolean'),
('holidayUntil', '1345970934722', 'long'),
('toggleHeating', 'false', 'boolean'),
('toggleWater', 'false', 'boolean'),
('waterBoost', 'false', 'boolean'),
('waterBoostOffTime', '1347777379911', 'long'),
('waterStatus', 'false', 'boolean');

-- --------------------------------------------------------

--
-- Table structure for table `schedule`
--

CREATE TABLE IF NOT EXISTS `schedule` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `group` smallint(6) unsigned NOT NULL,
  `day` int(2) NOT NULL,
  `hourOn` smallint(6) NOT NULL,
  `minuteOn` smallint(6) NOT NULL,
  `hourOff` smallint(6) NOT NULL,
  `minuteOff` smallint(6) NOT NULL,
  `heatingOn` tinyint(1) NOT NULL,
  `waterOn` tinyint(1) NOT NULL,
  `enabled` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `group` (`group`),
  KEY `day` (`day`),
  KEY `minuteOn` (`minuteOn`),
  KEY `hourOn` (`hourOn`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=72 ;

--
-- Dumping data for table `schedule`
--

INSERT INTO `schedule` (`id`, `group`, `day`, `hourOn`, `minuteOn`, `hourOff`, `minuteOff`, `heatingOn`, `waterOn`, `enabled`) VALUES
(58, 1, 2, 5, 45, 6, 30, 0, 1, 1),
(59, 1, 3, 5, 45, 6, 30, 0, 1, 1),
(60, 1, 4, 5, 45, 6, 30, 0, 1, 1),
(61, 1, 5, 5, 45, 6, 30, 0, 1, 1),
(62, 1, 6, 5, 45, 6, 30, 0, 1, 1),
(63, 1, 1, 17, 30, 18, 0, 0, 1, 1),
(64, 1, 4, 17, 30, 18, 0, 0, 1, 1),
(65, 1, 2, 17, 30, 18, 0, 0, 1, 1),
(66, 1, 3, 17, 30, 18, 0, 0, 1, 1),
(67, 1, 7, 5, 45, 6, 30, 0, 1, 1),
(68, 1, 7, 17, 30, 18, 0, 0, 1, 1),
(69, 1, 5, 17, 30, 18, 0, 0, 1, 1),
(70, 1, 6, 17, 30, 18, 0, 0, 1, 1),
(71, 1, 1, 5, 45, 6, 30, 0, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `schedule_groups`
--

CREATE TABLE IF NOT EXISTS `schedule_groups` (
  `id` smallint(6) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `name` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `schedule_groups`
--

INSERT INTO `schedule_groups` (`id`, `name`) VALUES
(1, 'Normal');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `schedule`
--
ALTER TABLE `schedule`
  ADD CONSTRAINT `schedule_ibfk_1` FOREIGN KEY (`group`) REFERENCES `schedule_groups` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
