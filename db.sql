-- phpMyAdmin SQL Dump
-- version 3.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 01, 2013 at 10:44 PM
-- Server version: 5.5.25a
-- PHP Version: 5.4.4

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `ave`
--

-- --------------------------------------------------------

--
-- Table structure for table `ci_sessions`
--

CREATE TABLE IF NOT EXISTS `ci_sessions` (
  `session_id` varchar(40) NOT NULL DEFAULT '0',
  `ip_address` varchar(45) NOT NULL DEFAULT '0',
  `user_agent` varchar(120) NOT NULL,
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  `user_data` text NOT NULL,
  PRIMARY KEY (`session_id`),
  KEY `last_activity_idx` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ci_sessions`
--

INSERT INTO `ci_sessions` (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES
('0794540f448d7f7363a7df518e08eadf', '::1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/30.0.1599.101 Safari/537.36', 1383079109, 'a:5:{s:9:"user_data";s:0:"";s:5:"email";s:19:"avenir.ro@gmail.com";s:6:"iduser";s:1:"1";s:9:"logged_in";s:1:"1";s:6:"groups";a:2:{i:0;a:2:{s:8:"idgroups";s:1:"1";s:4:"name";s:5:"admin";}i:1;a:2:{s:8:"idgroups";s:1:"2";s:4:"name";s:7:"members";}}}'),
('14ce45a2c9633cca96e9108ba5925568', '::1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/30.0.1599.101 Safari/537.36', 1383078752, ''),
('3aa776c2be528c27335f58a8d070b1b3', '::1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/30.0.1599.101 Safari/537.36', 1383079805, 'a:5:{s:9:"user_data";s:0:"";s:5:"email";s:19:"avenir.ro@gmail.com";s:6:"iduser";s:1:"1";s:9:"logged_in";s:1:"1";s:6:"groups";a:2:{i:0;a:2:{s:8:"idgroups";s:1:"1";s:4:"name";s:5:"admin";}i:1;a:2:{s:8:"idgroups";s:1:"2";s:4:"name";s:7:"members";}}}'),
('78563e052a681ff7dfa85387fb5a4c8d', '::1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/30.0.1599.101 Safari/537.36', 1383080542, ''),
('7b0015678775c10a7c348664fbbf4a5c', '::1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/30.0.1599.101 Safari/537.36', 1383081460, 'a:4:{s:5:"email";s:19:"avenir.ro@gmail.com";s:6:"iduser";s:1:"1";s:9:"logged_in";s:1:"1";s:6:"groups";a:2:{i:0;a:2:{s:8:"idgroups";s:1:"1";s:4:"name";s:5:"admin";}i:1;a:2:{s:8:"idgroups";s:1:"2";s:4:"name";s:7:"members";}}}'),
('941936472ee08b5484c4f7fb040e7d0e', '::1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/30.0.1599.101 Safari/537.36', 1383342135, 'a:5:{s:9:"user_data";s:0:"";s:5:"email";s:15:"admin@admin.com";s:6:"iduser";s:1:"2";s:9:"logged_in";s:1:"1";s:6:"groups";a:1:{i:0;a:2:{s:8:"idgroups";s:1:"1";s:4:"name";s:5:"admin";}}}'),
('b28934ee742110060998554bae0871e2', '::1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/30.0.1599.101 Safari/537.36', 1383082470, 'a:5:{s:9:"user_data";s:0:"";s:5:"email";s:19:"avenir.ro@gmail.com";s:6:"iduser";s:1:"1";s:9:"logged_in";s:1:"1";s:6:"groups";a:2:{i:0;a:2:{s:8:"idgroups";s:1:"1";s:4:"name";s:5:"admin";}i:1;a:2:{s:8:"idgroups";s:1:"2";s:4:"name";s:7:"members";}}}'),
('f3f378e0910e3a6e91d44756baa515fe', '::1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/30.0.1599.101 Safari/537.36', 1383080282, 'a:5:{s:9:"user_data";s:0:"";s:5:"email";s:19:"avenir.ro@gmail.com";s:6:"iduser";s:1:"1";s:9:"logged_in";s:1:"1";s:6:"groups";a:2:{i:0;a:2:{s:8:"idgroups";s:1:"1";s:4:"name";s:5:"admin";}i:1;a:2:{s:8:"idgroups";s:1:"2";s:4:"name";s:7:"members";}}}');

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE IF NOT EXISTS `groups` (
  `idgroups` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  PRIMARY KEY (`idgroups`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`idgroups`, `name`, `description`) VALUES
(1, 'admin', 'Administrators'),
(2, 'members', 'Members');

-- --------------------------------------------------------

--
-- Table structure for table `temp_users`
--

CREATE TABLE IF NOT EXISTS `temp_users` (
  `idtemp_users` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) DEFAULT NULL,
  `key` varchar(255) DEFAULT NULL,
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`idtemp_users`),
  UNIQUE KEY `email_UNIQUE` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `idusers` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(254) NOT NULL,
  `password` varchar(254) NOT NULL,
  `last_login` timestamp NULL DEFAULT NULL,
  `last_action` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `login_attempts` int(1) NOT NULL DEFAULT '0',
  `ip` varchar(15) NOT NULL,
  `status` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`idusers`),
  UNIQUE KEY `email_UNIQUE` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`idusers`, `email`, `password`, `last_login`, `last_action`, `login_attempts`, `ip`, `status`) VALUES
(1, 'avenir.ro@gmail.com', '067cca6ce67e8d78c948caa49ed9bb92', '2013-11-01 18:40:18', '2013-11-01 20:27:54', 0, '::1', 1),
(2, 'admin@admin.com', '5f4dcc3b5aa765d61d8327deb882cf99', '2013-11-01 20:42:22', '2013-11-01 20:42:22', 0, '::1', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users_groups`
--

CREATE TABLE IF NOT EXISTS `users_groups` (
  `idusers` int(11) NOT NULL,
  `idgroups` int(11) NOT NULL,
  UNIQUE KEY `idusers` (`idusers`,`idgroups`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users_groups`
--

INSERT INTO `users_groups` (`idusers`, `idgroups`) VALUES
(1, 1),
(1, 2),
(2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_details`
--

CREATE TABLE IF NOT EXISTS `user_details` (
  `idusers` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `last_login` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_details`
--

INSERT INTO `user_details` (`idusers`, `first_name`, `last_name`, `last_login`) VALUES
(1, 'Adrian', 'Voicu', '2013-10-24 22:03:41'),
(2, 'Admin', 'Istrator', '2013-11-01 21:37:02');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
