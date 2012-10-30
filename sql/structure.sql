-- phpMyAdmin SQL Dump
-- version 3.3.2deb1ubuntu1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 30, 2012 at 07:44 AM
-- Server version: 5.1.63
-- PHP Version: 5.2.17

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=98 ;

-- --------------------------------------------------------

--
-- Table structure for table `schedule_groups`
--

CREATE TABLE IF NOT EXISTS `schedule_groups` (
  `id` smallint(6) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `name` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `schedule`
--
ALTER TABLE `schedule`
  ADD CONSTRAINT `schedule_ibfk_1` FOREIGN KEY (`group`) REFERENCES `schedule_groups` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
