-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1
-- Время создания: Сен 07 2013 г., 22:20
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Дамп данных таблицы `ha_logins`
--

INSERT INTO `ha_logins` (`id`, `userId`, `loginProvider`, `loginProviderIdentifier`) VALUES
(1, 1, 'facebook', '100006579181545');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=38 ;

--
-- Дамп данных таблицы `tbl_image`
--

INSERT INTO `tbl_image` (`id`, `image`, `user_id`, `filesize`, `mime`) VALUES
(34, '5279-tumblr_mrro2oWDW81qzfsnio1_1280.jpg', 2, 0, ''),
(37, '5710-where-did-the-google-chrome-logo-really-came-from_20120408033611.jpg', 1, 0, '');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=57 ;

--
-- Дамп данных таблицы `tbl_question`
--

INSERT INTO `tbl_question` (`id`, `question_text`, `question_video_id`, `from_id`, `to_id`, `answer_text`, `answer_video_id`, `image`, `likes_n`, `anonym`, `anonym_custom`, `status`, `seen`, `hide`, `updated_time`, `created_time`) VALUES
(4, 'dont stop', 0, 1, 1, 'fdsgdsfgsdfgsdfg', 0, '', 0, 0, '', 1, 1, 1, '2013-09-05 17:39:30', '2013-08-23 21:15:26'),
(5, 'Ti kto takoi ?', 0, 1, 1, 'Davai dosvidania !', 0, '5855-tumblr_mrro2oWDW81qzfsnio1_1280.jpg', 0, 0, '', 1, 1, 0, '2013-09-05 17:34:51', '2013-08-25 16:00:59'),
(6, 'qwerqwerq', 0, 1, 2, 'qwerwqerwqer', 0, '4286-Illustrated-Grumpy-Cat-HD.jpg', 0, 0, '', 1, 1, 0, '2013-08-25 18:47:22', '2013-08-25 17:28:11'),
(7, 'awdawsafsadfsad', 0, 1, 1, 'fasdfasdfasdf', 0, '8872-2012-11-14-Comic_Jam.jpg', 0, 0, '', 1, 1, 1, '2013-09-05 17:39:35', '2013-08-25 18:19:22'),
(8, 'awdawdawdawd', 0, 1, 2, 'awdawdawdawd', 0, '9907-iPhone-6-concept-images.jpg', 0, 0, '', 1, 1, 0, '2013-08-27 19:03:00', '2013-08-26 17:34:04'),
(9, 'sadfsdfasd', 0, 1, 1, 'fasdfasdf', 0, '', 0, 0, '', 1, 1, 1, '2013-09-05 17:39:25', '2013-08-26 17:45:17'),
(11, 'dont stop', 0, 1, 2, 'pump dat ', 0, '', 0, 0, '', 1, 1, 0, '2013-08-23 22:34:42', '2013-08-23 21:15:26'),
(12, 'dont stop', 0, 1, 2, 'pump dat ', 0, '', 0, 0, '', 1, 1, 0, '2013-08-23 22:34:42', '2013-08-23 21:15:26'),
(13, 'dont stop', 0, 1, 2, 'pump dat ', 0, '', 0, 0, '', 1, 1, 0, '2013-08-23 22:34:42', '2013-08-23 21:15:26'),
(14, 'dont stop', 0, 1, 2, 'pump dat ', 0, '', 0, 0, '', 1, 1, 0, '2013-08-23 22:34:42', '2013-08-23 21:15:26'),
(15, 'dont stop', 0, 1, 2, 'pump dat ', 0, '', 0, 0, '', 1, 1, 0, '2013-08-23 22:34:42', '2013-08-23 21:15:26'),
(16, 'dont stop', 0, 1, 2, 'pump dat ', 0, '', 0, 0, '', 1, 1, 0, '2013-08-23 22:34:42', '2013-08-23 21:15:26'),
(17, 'dont stop', 0, 1, 2, 'pump dat ', 0, '', 0, 0, '', 1, 1, 0, '2013-08-23 22:34:42', '2013-08-23 21:15:26'),
(18, 'dont stop', 0, 1, 2, 'pump dat ', 0, '', 0, 0, '', 1, 1, 0, '2013-08-23 22:34:42', '2013-08-23 21:15:26'),
(19, 'dont stop', 0, 1, 2, 'pump dat ', 0, '', 0, 0, '', 1, 1, 0, '2013-08-23 22:34:42', '2013-08-23 21:15:26'),
(20, 'dont stop', 0, 1, 2, 'pump dat ', 0, '', 0, 0, '', 1, 1, 0, '2013-08-23 22:34:42', '2013-08-23 21:15:26'),
(21, 'dont stop', 0, 1, 2, 'pump dat ', 0, '', 0, 0, '', 1, 1, 0, '2013-08-23 22:34:42', '2013-08-23 21:15:26'),
(22, 'dont stop', 0, 1, 2, 'pump dat ', 0, '', 0, 0, '', 1, 1, 0, '2013-08-23 22:34:42', '2013-08-23 21:15:26'),
(23, 'dont stop', 0, 1, 2, 'pump dat ', 0, '', 0, 0, '', 1, 1, 0, '2013-08-23 22:34:42', '2013-08-23 21:15:26'),
(24, 'dont stop', 0, 1, 2, 'pump dat ', 0, '', 0, 0, '', 1, 1, 0, '2013-08-23 22:34:42', '2013-08-23 21:15:26'),
(25, 'dont stop', 0, 1, 2, 'pump dat ', 0, '', 0, 0, '', 1, 1, 0, '2013-08-23 22:34:42', '2013-08-23 21:15:26'),
(26, 'dont stop', 0, 1, 2, 'pump dat ', 0, '', 0, 0, '', 1, 1, 0, '2013-08-23 22:34:42', '2013-08-23 21:15:26'),
(27, 'dont stop', 0, 1, 2, 'pump dat ', 0, '', 0, 0, '', 1, 1, 0, '2013-08-23 22:34:42', '2013-08-23 21:15:26'),
(28, 'dont stop', 0, 1, 2, 'pump dat ', 0, '', 0, 0, '', 1, 1, 0, '2013-08-23 22:34:42', '2013-08-23 21:15:26'),
(29, 'dont stop', 0, 1, 2, 'pump dat ', 0, '', 0, 0, '', 1, 1, 0, '2013-08-23 22:34:42', '2013-08-23 21:15:26'),
(30, 'dont stop', 0, 1, 2, 'pump dat ', 0, '', 0, 0, '', 1, 1, 0, '2013-08-23 22:34:42', '2013-08-23 21:15:26'),
(31, 'dont stop', 0, 1, 2, 'pump dat ', 0, '', 0, 0, '', 1, 1, 0, '2013-08-23 22:34:42', '2013-08-23 21:15:26'),
(32, 'dont stop', 0, 1, 2, 'pump dat ', 0, '', 0, 0, '', 1, 1, 0, '2013-08-23 22:34:42', '2013-08-23 21:15:26'),
(33, 'dont stop', 0, 1, 2, 'pump dat ', 0, '', 0, 0, '', 1, 1, 0, '2013-08-23 22:34:42', '2013-08-23 21:15:26'),
(34, 'dont stop', 0, 1, 2, 'pump dat ', 0, '', 0, 0, '', 1, 1, 0, '2013-08-23 22:34:42', '2013-08-23 21:15:26'),
(35, 'dont stop', 0, 1, 2, 'pump dat ', 0, '', 0, 0, '', 1, 1, 0, '2013-08-23 22:34:42', '2013-08-23 21:15:26'),
(36, 'dont stop', 0, 1, 2, 'pump dat ', 0, '', 0, 0, '', 1, 1, 0, '2013-08-23 22:34:42', '2013-08-23 21:15:26'),
(37, 'dont stop', 0, 1, 2, 'pump dat ', 0, '', 0, 0, '', 1, 1, 0, '2013-08-23 22:34:42', '2013-08-23 21:15:26'),
(38, 'dont stop', 0, 1, 2, 'pump dat ', 0, '', 0, 0, '', 1, 1, 0, '2013-08-23 22:34:42', '2013-08-23 21:15:26'),
(39, 'dont stop', 0, 1, 2, 'pump dat ', 0, '', 0, 0, '', 1, 1, 0, '2013-08-23 22:34:42', '2013-08-23 21:15:26'),
(40, 'dont stop', 0, 1, 2, 'pump dat ', 0, '', 0, 0, '', 1, 1, 0, '2013-08-23 22:34:42', '2013-08-23 21:15:26'),
(41, 'dont stop', 0, 1, 2, 'pump dat ', 0, '', 0, 0, '', 1, 1, 0, '2013-08-23 22:34:42', '2013-08-23 21:15:26'),
(42, 'dont stop', 0, 1, 2, 'pump dat ', 0, '', 0, 0, '', 1, 1, 0, '2013-08-23 22:34:42', '2013-08-23 21:15:26'),
(43, 'dont stop', 0, 1, 2, 'pump dat ', 0, '', 0, 0, '', 1, 1, 0, '2013-08-23 22:34:42', '2013-08-23 21:15:26'),
(44, 'dont stop', 0, 1, 2, 'pump dat ', 0, '', 0, 0, '', 1, 1, 0, '2013-08-23 22:34:42', '2013-08-23 21:15:26'),
(45, 'dont stop', 0, 1, 2, 'pump dat ', 0, '', 0, 0, '', 1, 1, 0, '2013-08-23 22:34:42', '2013-08-23 21:15:26'),
(46, 'dont stop', 0, 1, 2, 'pump dat ', 0, '', 0, 0, '', 1, 1, 0, '2013-08-23 22:34:42', '2013-08-23 21:15:26'),
(48, 'How are you ?', 0, 1, 1, 'addadaad', 0, '3770-tumblr_mrro2oWDW81qzfsnio1_1280.jpg', 0, 0, '', 1, 1, 1, '2013-09-05 17:39:33', '2013-08-29 22:27:48'),
(50, 'Dadaasdasd', 0, 1, 1, 'dadadaasdas', 0, '', 0, 2, 'Pepa pig', 1, 1, 1, '2013-09-05 17:39:29', '2013-08-30 11:54:04'),
(51, 'sdfgdsfg', 0, 2, 2, 'sdfgsd', 0, '', 0, 0, '', 1, 1, 0, '2013-09-01 10:58:28', '2013-09-01 10:58:28'),
(52, 'Cum te numesti ?', 0, 1, 1, 'Bors de zeama.', 0, '', 0, 2, 'Baran', 1, 1, 1, '2013-09-05 17:39:27', '2013-09-01 14:29:57'),
(53, 'Trololo', 0, 1, 1, 'awdawd', 0, '', 0, 2, 'Anthony Kiedis', 1, 1, 1, '2013-09-05 17:39:26', '2013-09-03 21:20:00'),
(54, 'Lol Lo l?', 0, 1, 1, 'YOLO YOLO', 0, '', 0, 0, '', 1, 1, 0, '2013-09-05 17:47:02', '2013-09-03 21:21:41'),
(56, 'Blah blah blah', 0, 1, 1, '', 0, '', 0, 0, '', 0, 1, 0, '2013-09-05 17:57:49', '2013-09-05 17:57:49');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Дамп данных таблицы `tbl_user`
--

INSERT INTO `tbl_user` (`id`, `email`, `password`, `firstname`, `lastname`, `residence`, `language`, `about`, `website`, `title`, `username`, `birthday`, `role`, `answers_n`, `likes_n`, `followers_n`, `created_time`, `updated_time`, `last_login_time`, `status`, `anonym_questions`, `gravatar`) VALUES
(1, 'danielgrosu1998@gmail.com', '', 'Daniel', 'Grosu', '', '', 'They''re gonna hit me alive, if i stumble. They''re gonna hit me alive, can you hear my heart ?', '', 'Get back motherfucker !', 'grosu', '1998-03-05', 0, 29, 0, 0, '2013-08-23 00:14:33', '2013-09-05 17:47:02', '2013-09-05 23:16:29', 0, 1, 0),
(2, 'sorelia.grosu@gmail.com', '', 'Sorelia', 'Grosu', '', '', 'sdfsdf', '', '', 'sorelia', '2013-01-01', 0, 1, 0, 0, '2013-08-26 18:03:51', '2013-09-01 10:58:28', '2013-09-01 10:38:45', 0, 0, 0),
(3, 'sorelia.grosu@email.com', '$2a$12$uPM1KZ/s5PsbY0uyh1TWg.RK5TD4oorDKnGk3xQzN8V0x6GaKv5XW', 'Sorelia', 'Grosu', '', '', '', '', '', 'blum', '0000-00-00', 0, 0, 0, 0, '2013-08-27 13:38:33', '2013-08-27 13:38:33', '2013-08-29 11:52:43', 0, 0, 0);

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

--
-- Дамп данных таблицы `tbl_user_question_assignment`
--

INSERT INTO `tbl_user_question_assignment` (`user_id`, `question_id`, `created_time`) VALUES
(1, 1, '2013-08-23 22:35:56'),
(1, 6, '2013-08-27 19:03:17'),
(1, 11, '2013-08-31 10:10:02'),
(1, 12, '2013-08-28 20:36:12'),
(1, 13, '2013-08-29 13:51:38'),
(1, 25, '2013-09-03 20:06:35'),
(1, 26, '2013-09-01 13:16:03'),
(1, 28, '2013-09-03 20:06:20'),
(1, 35, '2013-09-03 20:06:37'),
(1, 36, '2013-09-01 13:16:13'),
(1, 40, '2013-09-03 20:06:43'),
(1, 51, '2013-09-03 20:41:08'),
(1, 54, '2013-09-05 16:31:25'),
(1, 55, '2013-09-04 18:09:56'),
(3, 2, '2013-08-27 13:39:10'),
(3, 4, '2013-08-27 13:39:08'),
(3, 6, '2013-08-27 13:38:58'),
(3, 7, '2013-08-27 13:39:07');

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

--
-- Дамп данных таблицы `tbl_user_user_assignment`
--

INSERT INTO `tbl_user_user_assignment` (`user_1`, `user_2`, `created_time`) VALUES
(1, 2, '2013-09-01 14:32:13');

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
