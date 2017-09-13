-- phpMyAdmin SQL Dump
-- version 4.0.9
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 30, 2016 at 02:52 AM
-- Server version: 5.5.34
-- PHP Version: 5.4.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


--
-- Database: `test`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `test_multi_sets`()
    DETERMINISTIC
begin
        select user() as first_col;
        select user() as first_col, now() as second_col;
        select user() as first_col, now() as second_col, now() as third_col;
        end$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `photo`
--

CREATE TABLE IF NOT EXISTS `photo` (
  `photo_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `ishname` varchar(50) NOT NULL,
  `path` varchar(50) NOT NULL,
  `timein` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`photo_id`),
  KEY `fuser_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=83 ;

--
-- Dumping data for table `photo`
--

INSERT INTO `photo` (`photo_id`, `user_id`, `ishname`, `path`, `timein`) VALUES
(77, 1, 'Koala.jpg', '8ac6b79d119fa54396d854abaaa29225.jpeg', '2016-05-30 00:50:10'),
(78, 1, 'Penguins.jpg', 'b996eb1a8a4da60c937bfc15440348e9.jpeg', '2016-05-30 00:50:10'),
(79, 1, 'Jellyfish.jpg', 'eca88bd20acadcea4406f6dd681ca556.jpeg', '2016-05-30 00:50:10'),
(80, 1, 'Tulips.jpg', '8d9e908ba36337d6f939ff25135d8937.jpeg', '2016-05-30 00:50:10'),
(81, 1, 'Hydrangeas.jpg', '89ab3a7eb88e8894df18120e35032a67.jpeg', '2016-05-30 00:50:10'),
(82, 1, 'Lighthouse.jpg', '507aac8de06846a0f18edbfd6559d7db.jpeg', '2016-05-30 00:50:10');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `user_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(30) NOT NULL,
  `username` varchar(50) NOT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `user_email` (`email`),
  KEY `user_name` (`username`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `email`, `username`) VALUES
(1, 'alexvkv@mail.ru', 'Петров Васечкин'),
(2, 'ss@ss.ru', 'sss'),
(3, 'aaaa@aaaa.ru', 'Петр Иванович');

