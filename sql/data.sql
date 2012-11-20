-- phpMyAdmin SQL Dump
-- version 3.3.2deb1ubuntu1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 30, 2012 at 07:45 AM
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

--
-- Dumping data for table `configuration`
--

INSERT INTO `configuration` (`key`, `value`, `type`) VALUES
('boostTime', '60', 'int'),
('heatingBoost', 'false', 'boolean'),
('heatingBoostOffTime', '1348319894049', 'long'),
('heatingStatus', 'false', 'boolean'),
('holidayFrom', '1347580800000', 'long'),
('holidayUntil', '1348272000000', 'long'),
('toggleHeating', 'false', 'boolean'),
('toggleWater', 'false', 'boolean'),
('waterBoost', 'false', 'boolean'),
('waterBoostOffTime', '1347993548772', 'long'),
('waterStatus', 'false', 'boolean');
