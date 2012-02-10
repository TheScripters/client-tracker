-- phpMyAdmin SQL Dump
-- version 3.3.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 10, 2012 at 01:37 AM
-- Server version: 5.1.46
-- PHP Version: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `thescrip_clients`
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
  `sessionId` int(10) NOT NULL AUTO_INCREMENT,
  `phpSessionId` varchar(32) NOT NULL,
  `sessionKey` varchar(15) NOT NULL,
  `updated` int(10) NOT NULL,
  `created` int(10) NOT NULL,
  `loggedIn` tinyint(1) NOT NULL,
  `userId` int(10) NOT NULL,
  `userAgent` varchar(255) NOT NULL,
  `ipAddress` varchar(15) NOT NULL,
  PRIMARY KEY (`sessionId`,`phpSessionId`,`sessionKey`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `client_config`
--

CREATE TABLE IF NOT EXISTS `client_config` (
  `id` varchar(25) NOT NULL,
  `value` varchar(255) NOT NULL,
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `client_config`
--

INSERT INTO `client_config` (`id`, `value`) VALUES
('ssl', 'no'),
('title', 'Client Tracker Database'),
('admin_password', '$2a$08$FKT28xzNzFI.hFkPkasfo.c6wTH.Qa6z30unwoBRRITf78EP4eK5m'),
('reCaptcha_public', ''), -- Get your own key at google.com/recaptcha
('reCaptcha_private', ''), -- Your own key from google.com/recaptcha
('paypal_id', ''),
('paypal_api_username', ''),
('paypal_api_password', ''),
('paypal_api_signature', ''),
('ip_sensitivity','3');