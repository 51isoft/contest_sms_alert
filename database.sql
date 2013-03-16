-- phpMyAdmin SQL Dump
-- version 3.5.7
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2013 年 03 月 17 日 07:04
-- 服务器版本: 5.5.29-0ubuntu0.12.04.2
-- PHP 版本: 5.3.10-1ubuntu3.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `contest_sms`
--
CREATE DATABASE `contest_sms` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `contest_sms`;

-- --------------------------------------------------------

--
-- 表的结构 `fetched`
--

CREATE TABLE IF NOT EXISTS `fetched` (
  `fid` int(11) NOT NULL AUTO_INCREMENT,
  `user` varchar(300) NOT NULL,
  `id` int(11) NOT NULL,
  `version` int(11) NOT NULL,
  PRIMARY KEY (`fid`),
  KEY `user` (`user`),
  KEY `id` (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `info`
--

CREATE TABLE IF NOT EXISTS `info` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `oj` varchar(50) NOT NULL,
  `title` text NOT NULL,
  `start` datetime NOT NULL,
  `dow` varchar(20) NOT NULL COMMENT 'day of week',
  `type` varchar(50) NOT NULL,
  `src` text NOT NULL,
  `version` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `oj` (`oj`),
  KEY `start` (`start`),
  KEY `type` (`type`),
  KEY `dow` (`dow`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `queue`
--

CREATE TABLE IF NOT EXISTS `queue` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` varchar(300) NOT NULL,
  `message` text NOT NULL,
  `phone` varchar(30) NOT NULL,
  `fetion` tinyint(1) NOT NULL,
  `time` datetime NOT NULL,
  `sent` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sent` (`sent`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `uoj`
--

CREATE TABLE IF NOT EXISTS `uoj` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` varchar(300) NOT NULL,
  `oj` varchar(300) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user` (`user`),
  KEY `oj` (`oj`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` varchar(300) NOT NULL,
  `passwd` varchar(150) NOT NULL,
  `phone` varchar(30) NOT NULL,
  `fetion` tinyint(1) NOT NULL,
  `hours` int(11) NOT NULL,
  `from` int(11) NOT NULL,
  `to` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `isroot` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user` (`user`),
  KEY `status` (`status`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `utype`
--

CREATE TABLE IF NOT EXISTS `utype` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` varchar(300) NOT NULL,
  `type` varchar(300) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user` (`user`),
  KEY `type` (`type`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
