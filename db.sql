-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Gazda: 127.0.0.1
-- Timp de generare: 08 Ian 2014 la 23:07
-- Versiune server: 5.6.11
-- Versiune PHP: 5.5.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Bază de date: `ave`
--
CREATE DATABASE IF NOT EXISTS `ave` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `ave`;

-- --------------------------------------------------------

--
-- Structura de tabel pentru tabelul `ci_sessions`
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
-- Salvarea datelor din tabel `ci_sessions`
--

INSERT INTO `ci_sessions` (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES
('54edf63045389353abaca176c7a35c7a', '::1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/31.0.1650.63 Safari/537.36', 1389218770, 'a:5:{s:9:"user_data";s:0:"";s:5:"email";s:15:"admin@admin.com";s:6:"iduser";s:1:"2";s:9:"logged_in";s:1:"1";s:6:"groups";a:1:{i:0;a:2:{s:8:"idgroups";s:1:"1";s:4:"name";s:5:"admin";}}}');

-- --------------------------------------------------------

--
-- Structura de tabel pentru tabelul `groups`
--

CREATE TABLE IF NOT EXISTS `groups` (
  `idgroups` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  PRIMARY KEY (`idgroups`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Salvarea datelor din tabel `groups`
--

INSERT INTO `groups` (`idgroups`, `name`, `description`) VALUES
(1, 'admin', 'Administrators'),
(3, 'members', 'Members');

-- --------------------------------------------------------

--
-- Structura de tabel pentru tabelul `temp_users`
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
-- Structura de tabel pentru tabelul `users`
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Salvarea datelor din tabel `users`
--

INSERT INTO `users` (`idusers`, `email`, `password`, `last_login`, `last_action`, `login_attempts`, `ip`, `status`) VALUES
(2, 'admin@admin.com', '5f4dcc3b5aa765d61d8327deb882cf99', '2014-01-08 20:09:14', '2014-01-08 21:07:10', 0, '::1', 1),
(4, 'avenir.ro@gmail.com', '067cca6ce67e8d78c948caa49ed9bb92', NULL, '0000-00-00 00:00:00', 0, '', 1);

-- --------------------------------------------------------

--
-- Structura de tabel pentru tabelul `users_groups`
--

CREATE TABLE IF NOT EXISTS `users_groups` (
  `idusers` int(11) NOT NULL,
  `idgroups` int(11) NOT NULL,
  UNIQUE KEY `usersgroups` (`idusers`,`idgroups`),
  KEY `idgroups` (`idgroups`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Salvarea datelor din tabel `users_groups`
--

INSERT INTO `users_groups` (`idusers`, `idgroups`) VALUES
(2, 1),
(4, 3);

-- --------------------------------------------------------

--
-- Structura de tabel pentru tabelul `user_details`
--

CREATE TABLE IF NOT EXISTS `user_details` (
  `idusers` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `last_login` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  UNIQUE KEY `idusers` (`idusers`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Salvarea datelor din tabel `user_details`
--

INSERT INTO `user_details` (`idusers`, `first_name`, `last_name`, `last_login`) VALUES
(2, 'Admin', 'Istrator', '2013-11-01 21:37:02'),
(4, 'Adrian', 'Voicu', '2013-11-02 22:13:52');

--
-- Restrictii pentru tabele sterse
--

--
-- Restrictii pentru tabele `users_groups`
--
ALTER TABLE `users_groups`
  ADD CONSTRAINT `users_groups_ibfk_2` FOREIGN KEY (`idusers`) REFERENCES `users` (`idusers`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `users_groups_ibfk_1` FOREIGN KEY (`idgroups`) REFERENCES `groups` (`idgroups`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restrictii pentru tabele `user_details`
--
ALTER TABLE `user_details`
  ADD CONSTRAINT `user_details_ibfk_1` FOREIGN KEY (`idusers`) REFERENCES `users` (`idusers`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
