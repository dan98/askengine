-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1
-- Время создания: Авг 23 2013 г., 00:08
-- Версия сервера: 5.5.32
-- Версия PHP: 5.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `askengine`
--
CREATE DATABASE IF NOT EXISTS `askengine` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `askengine`;

-- --------------------------------------------------------

--
-- Структура таблицы `ha_logins`
--

CREATE TABLE IF NOT EXISTS `ha_logins` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userId` int(11) NOT NULL,
  `loginProvider` varchar(50) NOT NULL,
  `loginProviderIdentifier` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `loginProvider_2` (`loginProvider`,`loginProviderIdentifier`),
  KEY `loginProvider` (`loginProvider`),
  KEY `loginProviderIdentifier` (`loginProviderIdentifier`),
  KEY `userId` (`userId`),
  KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `tbl_image`
--

CREATE TABLE IF NOT EXISTS `tbl_image` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `image` varchar(256) NOT NULL,
  `user_id` int(11) NOT NULL,
  `filesize` int(11) NOT NULL,
  `mime` varchar(256) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `tbl_notification`
--

CREATE TABLE IF NOT EXISTS `tbl_notification` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `namespace` varchar(50) NOT NULL,
  `object_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `notification_text` varchar(50) NOT NULL,
  `created_time` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `tbl_question`
--

CREATE TABLE IF NOT EXISTS `tbl_question` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `question_text` mediumtext NOT NULL,
  `question_video_id` int(11) NOT NULL,
  `from_id` int(11) NOT NULL,
  `to_id` int(11) NOT NULL,
  `answer_text` mediumtext NOT NULL,
  `answer_video_id` int(11) NOT NULL,
  `image` varchar(256) NOT NULL,
  `likes_n` int(11) NOT NULL,
  `anonym` int(1) NOT NULL DEFAULT '0',
  `anonym_custom` varchar(30) NOT NULL,
  `status` int(1) NOT NULL,
  `seen` int(11) NOT NULL,
  `hide` int(1) NOT NULL,
  `updated_time` datetime NOT NULL,
  `created_time` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `tbl_user`
--

CREATE TABLE IF NOT EXISTS `tbl_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(256) NOT NULL,
  `password` varchar(256) NOT NULL,
  `firstname` mediumtext NOT NULL,
  `lastname` mediumtext NOT NULL,
  `residence` varchar(50) NOT NULL,
  `language` varchar(10) NOT NULL,
  `about` varchar(256) NOT NULL,
  `website` varchar(256) NOT NULL,
  `title` varchar(30) NOT NULL,
  `username` varchar(16) NOT NULL,
  `birthday` date NOT NULL,
  `role` int(1) NOT NULL,
  `answers_n` int(11) NOT NULL,
  `likes_n` int(11) NOT NULL,
  `followers_n` int(11) NOT NULL,
  `created_time` datetime NOT NULL,
  `updated_time` datetime NOT NULL,
  `last_login_time` datetime NOT NULL,
  `status` int(1) NOT NULL,
  `anonym_questions` int(1) NOT NULL,
  `gravatar` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `tbl_user_question_assignment`
--

CREATE TABLE IF NOT EXISTS `tbl_user_question_assignment` (
  `user_id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL,
  `created_time` datetime NOT NULL,
  PRIMARY KEY (`user_id`,`question_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `tbl_user_user_assignment`
--

CREATE TABLE IF NOT EXISTS `tbl_user_user_assignment` (
  `user_1` int(11) NOT NULL,
  `user_2` int(11) NOT NULL,
  `created_time` datetime NOT NULL,
  PRIMARY KEY (`user_1`,`user_2`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `tbl_video`
--

CREATE TABLE IF NOT EXISTS `tbl_video` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `filename` varchar(256) NOT NULL,
  `created_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
