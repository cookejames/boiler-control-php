-- phpMyAdmin SQL Dump
-- version 3.3.2deb1ubuntu1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 19, 2013 at 12:19 PM
-- Server version: 5.1.66
-- PHP Version: 5.2.17

SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Database: `pi`
--

--
-- Dumping data for table `configuration`
--

INSERT INTO `configuration` (`key`, `value`, `type`) VALUES
('boostTime', '60', 'int'),
('holidayFrom', '1347580800000', 'long'),
('holidayUntil', '1348272000000', 'long');

--
-- Dumping data for table `schedule`
--

INSERT INTO `schedule` (`id`, `group`, `day`, `hourOn`, `minuteOn`, `hourOff`, `minuteOff`, `heatingOn`, `waterOn`, `enabled`) VALUES
(58, 1, 2, 5, 45, 6, 30, 0, 1, 0),
(59, 1, 3, 5, 45, 6, 30, 0, 1, 0),
(60, 1, 4, 5, 45, 6, 30, 0, 1, 0),
(61, 1, 5, 5, 45, 6, 30, 0, 1, 0),
(62, 1, 6, 5, 45, 6, 30, 0, 1, 0),
(63, 3, 1, 17, 30, 18, 0, 0, 1, 0),
(64, 1, 4, 17, 30, 18, 0, 0, 1, 0),
(65, 1, 2, 17, 30, 18, 0, 0, 1, 0),
(66, 1, 3, 17, 30, 18, 0, 0, 1, 0),
(67, 3, 7, 5, 45, 6, 30, 0, 1, 0),
(68, 3, 7, 17, 30, 18, 0, 0, 1, 0),
(69, 1, 5, 17, 30, 18, 0, 0, 1, 0),
(70, 1, 6, 17, 30, 18, 0, 0, 1, 0),
(71, 3, 1, 5, 45, 6, 30, 0, 1, 0),
(79, 4, 1, 6, 45, 7, 30, 0, 1, 1),
(80, 4, 2, 6, 45, 7, 30, 0, 1, 1),
(81, 4, 3, 6, 45, 7, 30, 0, 1, 1),
(82, 4, 4, 6, 45, 7, 30, 0, 1, 1),
(83, 4, 5, 6, 45, 7, 30, 0, 1, 1),
(84, 4, 6, 6, 45, 7, 30, 0, 1, 1),
(85, 4, 7, 6, 45, 7, 30, 0, 1, 1),
(86, 4, 1, 17, 0, 17, 30, 0, 1, 1),
(87, 4, 2, 17, 0, 17, 30, 0, 1, 1),
(88, 4, 3, 17, 0, 17, 30, 0, 1, 1),
(89, 4, 4, 17, 0, 17, 30, 0, 1, 1),
(90, 4, 5, 17, 0, 17, 30, 0, 1, 1),
(91, 4, 6, 17, 0, 17, 30, 0, 1, 1),
(93, 4, 7, 17, 0, 17, 30, 0, 1, 1),
(97, 1, 3, 5, 45, 6, 30, 1, 0, 1);

--
-- Dumping data for table `schedule_groups`
--

INSERT INTO `schedule_groups` (`id`, `name`) VALUES
(4, 'Nights'),
(1, 'Work Weekdays'),
(3, 'Work Weekend');
SET FOREIGN_KEY_CHECKS=1;
