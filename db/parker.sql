-- phpMyAdmin SQL Dump
-- version 3.3.7deb5build0.10.10.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 09, 2011 at 10:18 AM
-- Server version: 5.1.49
-- PHP Version: 5.3.3-1ubuntu9.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `parker`
--

-- --------------------------------------------------------

--
-- Table structure for table `content`
--

CREATE TABLE IF NOT EXISTS `content` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `slug` varchar(255) NOT NULL,
  `parent_id` bigint(20) NOT NULL DEFAULT '0',
  `keywords` tinytext,
  `description` tinytext,
  `title` tinytext NOT NULL,
  `h_image` varchar(200) NOT NULL,
  `body` longtext NOT NULL,
  `type` int(11) NOT NULL,
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `content`
--

INSERT INTO `content` (`id`, `slug`, `parent_id`, `keywords`, `description`, `title`, `h_image`, `body`, `type`, `created`, `updated`) VALUES
(1, 'root', 0, 'root_page', 'root_page', 'root_page', '', '', 1, NULL, NULL),
(2, 'test', 1, NULL, NULL, 'Test Page', '', '<p>this is the test.</p>', 3, '2011-08-11 11:01:17', '2011-08-11 11:49:51'),
(4, 'main', 1, NULL, NULL, 'main', '', '<p>main</p>', 2, '2011-08-11 11:48:22', '2011-08-11 11:48:22'),
(5, 'add', 4, NULL, NULL, 'add', '', '<p>add</p>', 3, '2011-08-11 11:48:46', '2011-08-11 11:48:46');

-- --------------------------------------------------------

--
-- Table structure for table `garages`
--

CREATE TABLE IF NOT EXISTS `garages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `garage_id` varchar(50) NOT NULL,
  `garage_name` varchar(250) NOT NULL,
  `g_state` varchar(50) NOT NULL,
  `g_city` varchar(50) NOT NULL,
  `g_zip_code` int(50) NOT NULL,
  `g_address` varchar(255) NOT NULL,
  `g_email` varchar(255) NOT NULL,
  `g_phone` int(20) NOT NULL,
  `g_description` varchar(255) NOT NULL,
  `g_status` enum('0','1') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `garages`
--

INSERT INTO `garages` (`id`, `garage_id`, `garage_name`, `g_state`, `g_city`, `g_zip_code`, `g_address`, `g_email`, `g_phone`, `g_description`, `g_status`) VALUES
(3, '2001', 'jtest', 'Punjab', 'mohali', 123456, '#345 , sec 71,mohali', 'test.rexwebsolution@gmail.com', 1234567890, '<p>another</p>', '1'),
(6, '201', 'jtest', 'Punjab', 'mohali', 123456, '#345 , phase 8 ,mohali', 'test.rexwebsolution@gmail.com', 1234568888, '<p>dfgfd gfgdf</p>', '1');

-- --------------------------------------------------------

--
-- Table structure for table `garage_avail_spaces`
--

CREATE TABLE IF NOT EXISTS `garage_avail_spaces` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `garage_id` int(11) NOT NULL,
  `facility_type` varchar(55) NOT NULL,
  `full_address` varchar(255) NOT NULL,
  `status` enum('0','1') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `garage_avail_spaces`
--

INSERT INTO `garage_avail_spaces` (`id`, `garage_id`, `facility_type`, `full_address`, `status`) VALUES
(3, 3, 'Garage', 'another', '1'),
(6, 6, 'Garage', 'ddddddddddddddd', '0');

-- --------------------------------------------------------

--
-- Table structure for table `homes`
--

CREATE TABLE IF NOT EXISTS `homes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(55) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `homes`
--


-- --------------------------------------------------------

--
-- Table structure for table `news_letters`
--

CREATE TABLE IF NOT EXISTS `news_letters` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `n_email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `n_status` enum('1','0') COLLATE utf8_unicode_ci NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=14 ;

--
-- Dumping data for table `news_letters`
--

INSERT INTO `news_letters` (`id`, `n_email`, `n_status`, `created`, `modified`) VALUES
(3, 'test.rexweb@gmail.com', '1', '2011-06-14 20:36:47', '2011-06-14 20:36:47'),
(10, 'test1.rexweb@gmail.com', '1', '2011-09-15 14:01:54', '2011-09-15 14:01:54'),
(13, 'test2.rexweb@gmail.com', '1', '2011-09-16 13:38:55', '2011-09-16 13:38:55');

-- --------------------------------------------------------

--
-- Table structure for table `send_newsletters`
--

CREATE TABLE IF NOT EXISTS `send_newsletters` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `n_subject` varchar(200) NOT NULL,
  `n_description` varchar(255) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `send_newsletters`
--

INSERT INTO `send_newsletters` (`id`, `n_subject`, `n_description`, `created`, `modified`) VALUES
(1, 'hhhhhhhhh', 'hhhhhhhhhhhhhh', '2011-06-15 08:39:34', '2011-06-15 08:39:34'),
(2, 'test', '<p>just test</p>', '2011-06-15 09:14:16', '2011-06-15 09:14:16');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role` enum('admin','coder') DEFAULT NULL COMMENT 'Foreign key of users_types table.',
  `firstname` varchar(45) DEFAULT NULL,
  `lastname` varchar(45) DEFAULT NULL,
  `reviewer_name` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `phone` varchar(45) DEFAULT NULL,
  `fax` varchar(45) DEFAULT NULL,
  `address` varchar(45) DEFAULT NULL,
  `city` varchar(45) DEFAULT NULL,
  `state` varchar(45) DEFAULT NULL,
  `zip` varchar(10) DEFAULT NULL,
  `country` varchar(45) DEFAULT NULL,
  `image` varchar(45) DEFAULT NULL,
  `status` tinyint(1) DEFAULT '1',
  `username` varchar(45) DEFAULT NULL,
  `password` varchar(45) DEFAULT NULL,
  `supervised` tinyint(1) NOT NULL,
  `created` datetime DEFAULT NULL COMMENT 'Will be given option to decide the date/time.',
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='Users table to host admin & coders\n' AUTO_INCREMENT=12 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `role`, `firstname`, `lastname`, `reviewer_name`, `email`, `phone`, `fax`, `address`, `city`, `state`, `zip`, `country`, `image`, `status`, `username`, `password`, `supervised`, `created`, `modified`) VALUES
(2, 'admin', 'admin', 'admin', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 1, '2010-05-18 06:07:59', '2011-08-12 10:53:42'),
(11, 'admin', 'gurpreet', 'singh', NULL, 'gurpreet.rexweb@gmail.com', '3432423', NULL, '3363', 'ludhiana', 'punjab', NULL, 'india', NULL, 1, 'gurpreet', '14e1b600b1fd579f47433b88e8d85291', 0, '2011-09-14 11:41:35', '2011-11-02 16:32:05');
