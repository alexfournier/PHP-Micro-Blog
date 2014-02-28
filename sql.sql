-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 11, 2013 at 03:34 AM
-- Server version: 5.5.25
-- PHP Version: 5.4.4

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `microblog`
--

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `message_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `message_txt` varchar(2000) NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `time_stamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`message_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=53 ;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`message_id`, `message_txt`, `user_id`, `time_stamp`) VALUES
(46, 'First Blog Post', 47, '2013-03-11 02:10:57'),
(47, 'second post - IT WORKS!', 48, '2013-03-11 02:13:32'),
(48, 'its working', 48, '2013-03-11 02:14:03'),
(49, 'this is a longer post to see what it will look like with a longer post with more text then the others and a longer post wos is a longer post to see what it will look like with a longer post with more text then the others and a longer post wos is a longer post to see what it will look like with a longer post with more text then the others and a longer post wos is a longer post to see what it will look like with a longer post with more text then the others and a longer post wos is a longer post to see what it will look like with a longer post with more text then the others and a longer post wos is a longer post to see what it will look like with a longer post with more text then the others and a longer post wo', 49, '2013-03-11 02:15:40'),
(50, 'testing Blog post order', 49, '2013-03-11 02:21:44'),
(51, 'more blog posts', 49, '2013-03-11 02:29:13'),
(52, 'alex blog post - typing typing type type\r\nalex blog post - typing typing type type\r\nalex blog post - typing typing type type\r\nalex blog post - typing typing type typealex blog post - typing typing type typealex blog post - typing typing type type', 50, '2013-03-11 02:29:58');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_name` text NOT NULL,
  `user_hash` char(32) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=51 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `user_hash`) VALUES
(47, 'user', '1a1dc91c907325c69271ddf0c944bc72'),
(48, 'newuser2', '1a1dc91c907325c69271ddf0c944bc72'),
(49, 'blogUser', '1a1dc91c907325c69271ddf0c944bc72'),
(50, 'alex', '1a1dc91c907325c69271ddf0c944bc72');
