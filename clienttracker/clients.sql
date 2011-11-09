-- phpMyAdmin SQL Dump
-- version 3.3.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 09, 2011 at 04:34 PM
-- Server version: 5.1.46
-- PHP Version: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `clients`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts_info`
--

CREATE TABLE IF NOT EXISTS `accounts_info` (
  `clientId` bigint(13) NOT NULL,
  `clientPanelUser` varchar(8) DEFAULT NULL,
  `clientDefaultPass` varchar(12) DEFAULT NULL,
  `clientDomain` varchar(100) DEFAULT NULL,
  `clientRenewDate` bigint(13) NOT NULL DEFAULT '0',
  `clientPayment` double(5,2) NOT NULL DEFAULT '0.00',
  `clientTerms` decimal(3,2) NOT NULL DEFAULT '0.00',
  KEY `clientId` (`clientId`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `clientLicense`
--

CREATE TABLE IF NOT EXISTS `clientLicense` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userId` int(10) NOT NULL,
  `software` varchar(255) NOT NULL,
  `key` varchar(255) NOT NULL,
  `date` int(12) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `userId` (`userId`,`software`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Table structure for table `clients_info`
--

CREATE TABLE IF NOT EXISTS `clients_info` (
  `clientId` bigint(13) NOT NULL AUTO_INCREMENT,
  `clientUserName` varchar(50) NOT NULL,
  `clientPassword` varchar(100) NOT NULL,
  `clientName` varchar(60) NOT NULL,
  `clientEmail` varchar(70) NOT NULL,
  `clientSecEmail` varchar(25) DEFAULT NULL,
  `clientAddress` varchar(30) NOT NULL,
  `clientCity` varchar(20) NOT NULL,
  `clientState` varchar(20) NOT NULL,
  `clientZip` int(5) NOT NULL,
  `clientPhone` varchar(14) NOT NULL,
  `clientHash` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`clientId`),
  UNIQUE KEY `clientHash` (`clientHash`),
  KEY `clientUserName` (`clientUserName`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

-- --------------------------------------------------------

--
-- Table structure for table `clients_sessions`
--

CREATE TABLE IF NOT EXISTS `clients_sessions` (
  `sessionId` varchar(32) NOT NULL,
  `time` int(11) NOT NULL,
  `ipAddress` varchar(20) NOT NULL,
  `data` tinytext NOT NULL,
  UNIQUE KEY `sessionId` (`sessionId`,`ipAddress`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `client_config`
--

CREATE TABLE IF NOT EXISTS `client_config` (
  `id` varchar(25) NOT NULL,
  `value` varchar(255) NOT NULL,
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
