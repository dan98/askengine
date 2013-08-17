-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1
-- Время создания: Авг 16 2013 г., 14:26
-- Версия сервера: 5.6.11
-- Версия PHP: 5.5.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `askengine`
--
CREATE DATABASE IF NOT EXISTS `askengine` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Дамп данных таблицы `ha_logins`
--

INSERT INTO `ha_logins` (`id`, `userId`, `loginProvider`, `loginProviderIdentifier`) VALUES
(1, 4, 'facebook', '100002946424643'),
(2, 15, 'facebook', '100006579181545');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=62 ;

--
-- Дамп данных таблицы `tbl_image`
--

INSERT INTO `tbl_image` (`id`, `image`, `user_id`, `filesize`, `mime`) VALUES
(60, '2425-sDbMEow.jpg', 4, 0, ''),
(61, '1687-8775428119_dbb1a7d6f6_h.jpg', 15, 0, '');

-- --------------------------------------------------------

--
-- Структура таблицы `tbl_question`
--

CREATE TABLE IF NOT EXISTS `tbl_question` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `question_text` text NOT NULL,
  `question_video_id` int(11) NOT NULL,
  `from_id` int(11) NOT NULL,
  `to_id` int(11) NOT NULL,
  `answer_text` text NOT NULL,
  `answer_video_id` int(11) NOT NULL,
  `image` varchar(256) NOT NULL,
  `likes_n` int(11) NOT NULL,
  `anonym` int(1) NOT NULL DEFAULT '0',
  `anonym_custom` varchar(30) NOT NULL,
  `status` int(1) NOT NULL,
  `hide` int(1) NOT NULL,
  `updated_time` datetime NOT NULL,
  `created_time` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=155 ;

--
-- Дамп данных таблицы `tbl_question`
--

INSERT INTO `tbl_question` (`id`, `question_text`, `question_video_id`, `from_id`, `to_id`, `answer_text`, `answer_video_id`, `image`, `likes_n`, `anonym`, `anonym_custom`, `status`, `hide`, `updated_time`, `created_time`) VALUES
(112, 'CEO ?', 0, 4, 4, 'dadadad', 0, '', 0, 0, '', 1, 1, '2013-08-12 11:03:45', '2013-08-12 11:01:26'),
(113, 'CEO ?', 0, 4, 4, 'Yeaeaea', 0, '', 0, 0, '', 1, 1, '2013-08-12 11:02:30', '2013-08-12 11:01:27'),
(114, 'wdwddwadad', 0, 4, 4, 'dwwddwwdwdwdwd', 0, '', 0, 0, '', 1, 1, '2013-08-12 11:04:03', '2013-08-12 11:03:50'),
(115, 'awdwdwawaaawa', 0, 4, 4, 'qweqwqweqeweqwqweqw', 0, '', 0, 0, '', 1, 1, '2013-08-12 11:07:07', '2013-08-12 11:06:26'),
(116, 'adwdawdsawdwdwwd', 0, 14, 3, '', 0, '', 0, 0, '', 0, 0, '2013-08-12 13:10:17', '2013-08-12 13:10:17'),
(117, 'adwdawdsawdwdwwd', 0, 14, 3, '', 0, '', 0, 0, '', 0, 0, '2013-08-12 13:10:24', '2013-08-12 13:10:24'),
(118, 'adwdawdsawdwdwwd', 0, 14, 3, '', 0, '', 0, 1, '', 0, 0, '2013-08-12 13:10:26', '2013-08-12 13:10:26'),
(119, 'adwdawdsawdwdwwd', 0, 14, 3, '', 0, '', 0, 1, '', 0, 0, '2013-08-12 13:10:32', '2013-08-12 13:10:32'),
(120, 'awdawgre', 0, 14, 3, '', 0, '', 0, 0, '', 0, 0, '2013-08-12 13:11:35', '2013-08-12 13:11:35'),
(121, 'awdawgre', 0, 14, 3, '', 0, '', 0, 1, '', 0, 0, '2013-08-12 13:11:45', '2013-08-12 13:11:45'),
(122, 'awdawgre', 0, 14, 3, '', 0, '', 0, 1, '', 0, 0, '2013-08-12 13:11:46', '2013-08-12 13:11:46'),
(123, 'wdawdeef?', 0, 14, 3, '', 0, '', 0, 0, '', 0, 0, '2013-08-12 13:12:46', '2013-08-12 13:12:46'),
(124, 'wdawdeef?', 0, 14, 3, '', 0, '', 0, 0, '', 0, 0, '2013-08-12 13:12:55', '2013-08-12 13:12:55'),
(125, 'awdrrgherherhesrg', 0, 14, 3, '', 0, '', 0, 0, '', 0, 0, '2013-08-12 13:13:02', '2013-08-12 13:13:02'),
(126, 'awdrrgherherhesrg', 0, 14, 3, '', 0, '', 0, 1, '', 0, 0, '2013-08-12 13:13:09', '2013-08-12 13:13:09'),
(127, 'awdrrgherherhesrg', 0, 14, 3, '', 0, '', 0, 1, '', 0, 0, '2013-08-12 13:13:10', '2013-08-12 13:13:10'),
(128, 'awdwdasdawda?????????', 0, 14, 3, '', 0, '', 0, 0, '', 0, 0, '2013-08-12 13:13:49', '2013-08-12 13:13:49'),
(129, 'awdawdawdddddddd', 0, 14, 3, '', 0, '', 0, 0, '', 0, 0, '2013-08-12 13:14:25', '2013-08-12 13:14:25'),
(130, 'awdawdawdddddddd', 0, 14, 3, '', 0, '', 0, 1, '', 0, 0, '2013-08-12 13:14:31', '2013-08-12 13:14:31'),
(131, 'awdawdawdddddddd', 0, 14, 3, '', 0, '', 0, 1, '', 0, 0, '2013-08-12 13:14:32', '2013-08-12 13:14:32'),
(132, 'sdfaffdssdd', 0, 14, 3, '', 0, '', 0, 0, '', 0, 0, '2013-08-12 13:14:43', '2013-08-12 13:14:43'),
(133, 'sdfaffdssdd', 0, 14, 3, '', 0, '', 0, 0, '', 0, 0, '2013-08-12 13:14:51', '2013-08-12 13:14:51'),
(134, 'efdsfsdfsdf', 0, 14, 3, '', 0, '', 0, 0, '', 0, 0, '2013-08-12 13:16:23', '2013-08-12 13:16:23'),
(135, 'efdsfsdfsdf', 0, 14, 3, '', 0, '', 0, 1, '', 0, 0, '2013-08-12 13:16:30', '2013-08-12 13:16:30'),
(136, 'efdsfsdfsdf', 0, 14, 3, '', 0, '', 0, 1, '', 0, 0, '2013-08-12 13:16:32', '2013-08-12 13:16:32'),
(137, 'awddwdwwdaw', 0, 14, 3, '', 0, '', 0, 0, '', 0, 0, '2013-08-12 15:12:15', '2013-08-12 15:12:15'),
(138, 'awddwdwwdaw', 0, 14, 3, '', 0, '', 0, 1, '', 0, 0, '2013-08-12 15:12:16', '2013-08-12 15:12:16'),
(139, 'awddwdwwdaw', 0, 14, 3, '', 0, '', 0, 1, '', 0, 0, '2013-08-12 15:12:18', '2013-08-12 15:12:18'),
(140, 'quesion\r\n', 0, 14, 3, '', 0, '', 0, 0, '', 0, 0, '2013-08-12 15:16:17', '2013-08-12 15:16:17'),
(141, 'awdwdwq1', 0, 14, 3, '', 0, '', 0, 0, '', 0, 0, '2013-08-12 15:17:58', '2013-08-12 15:17:58'),
(142, 'awdawdawdefef', 0, 14, 3, '', 0, '', 0, 0, '', 0, 0, '2013-08-12 18:30:29', '2013-08-12 18:30:29'),
(143, 'awdawdawdefef', 0, 14, 3, '', 0, '', 0, 1, '', 0, 0, '2013-08-12 18:30:31', '2013-08-12 18:30:31'),
(144, 'awdawdawdefef', 0, 14, 3, '', 0, '', 0, 1, '', 0, 0, '2013-08-12 18:30:32', '2013-08-12 18:30:32'),
(145, 'IM CEO, Bitch.', 0, 15, 5, 'Its our time !', 0, '2972-this-is-our-time-cover.jpg', 0, 0, '', 1, 0, '2013-08-16 15:38:59', '2013-08-16 15:37:52'),
(146, 'IM CEO, Bitch.', 0, 15, 5, 'Its our time !', 0, '', 0, 0, '', 1, 0, '2013-08-16 15:38:59', '2013-08-16 15:37:52'),
(147, 'IM CEO, Bitch.', 0, 15, 5, 'Its our time !', 0, '', 0, 0, '', 1, 0, '2013-08-16 15:38:59', '2013-08-16 15:37:52'),
(148, 'IM CEO, Bitch.', 0, 15, 5, 'Its our time !', 0, '', 0, 0, '', 1, 0, '2013-08-16 15:38:59', '2013-08-16 15:37:52'),
(149, 'IM CEO, Bitch.', 0, 15, 5, 'Its our time !', 0, '', 0, 0, '', 1, 0, '2013-08-16 15:38:59', '2013-08-16 15:37:52'),
(150, 'IM CEO, Bitch.', 0, 15, 5, 'Its our time !', 0, '', 0, 0, '', 1, 0, '2013-08-16 15:38:59', '2013-08-16 15:37:52'),
(151, 'IM CEO, Bitch.', 0, 15, 5, 'Its our time !', 0, '', 0, 0, '', 1, 0, '2013-08-16 15:38:59', '2013-08-16 15:37:52'),
(152, 'IM CEO, Bitch.', 0, 15, 5, 'Its our time !', 0, '', 0, 0, '', 1, 0, '2013-08-16 15:38:59', '2013-08-16 15:37:52'),
(153, 'IM CEO, Bitch.', 0, 15, 5, 'Its our time !', 0, '', 0, 0, '', 1, 0, '2013-08-16 15:38:59', '2013-08-16 15:37:52'),
(154, 'IM CEO, Bitch.', 0, 15, 5, 'Its our time !', 0, '', 0, 0, '', 1, 0, '2013-08-16 15:38:59', '2013-08-16 15:37:52');

-- --------------------------------------------------------

--
-- Структура таблицы `tbl_user`
--

CREATE TABLE IF NOT EXISTS `tbl_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(256) NOT NULL,
  `password` varchar(256) NOT NULL,
  `firstname` text NOT NULL,
  `lastname` text NOT NULL,
  `residence` text NOT NULL,
  `language` varchar(10) NOT NULL,
  `about` text NOT NULL,
  `website` varchar(256) NOT NULL,
  `title` text NOT NULL,
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
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Дамп данных таблицы `tbl_user`
--

INSERT INTO `tbl_user` (`id`, `email`, `password`, `firstname`, `lastname`, `residence`, `language`, `about`, `website`, `title`, `username`, `birthday`, `role`, `answers_n`, `likes_n`, `followers_n`, `created_time`, `updated_time`, `last_login_time`, `status`, `anonym_questions`) VALUES
(3, 'barack.obama@gov.us', '$2a$12$ItAm0jVfq9ulBfb89HIunu/ZgMSu4OdLsmBoLQV4OzbRZPI.N3DpG', 'Barack', 'Obama', '', '', '', '', '', 'barack.obama', '0000-00-00', 0, 0, 0, 0, '2013-08-01 18:24:29', '2013-08-01 18:24:29', '0000-00-00 00:00:00', 1, 0),
(4, 'daniel.grosu@hotmail.com', '$2a$12$tWiQ64YHFTLKtXOOg4xCNObGg9rjmjYxtWI8tbiWQ/z.e02zL81pa', 'Daniel', 'Grosu', '', '', '', '', 'Leave a question', 'ceo', '2013-01-01', 0, 2, 0, 0, '2013-08-08 10:33:35', '2013-08-12 11:07:07', '2013-08-12 16:31:54', 1, 1),
(5, 'mark.zuckerberg@facebook.com', '$2a$12$.7Og6t.OWR2DsScoNv31du/iwTHGf70G0yCiRn3kOHYRibZiSHOX6', 'Mark', 'Zuckerberg', '', '', '', '', '', 'mark', '0000-00-00', 0, 0, 0, 0, '2013-08-12 12:44:46', '2013-08-12 12:44:46', '0000-00-00 00:00:00', 1, 1),
(14, 'bill.gates@hotmail.com', '$2a$12$CU/Q5S83SeSUUlvrDcFr0eKdQsBcDhj9b/fbkxwfMTRCpiGvcD6rC', 'Bill', 'Gates', '', '', '', '', '', 'bill', '0000-00-00', 0, 0, 0, 0, '2013-08-12 12:56:42', '2013-08-12 12:56:42', '2013-08-12 10:58:26', 1, 1),
(15, 'danielgrosu1998@gmail.com', '$2a$12$AXqz4xrpkmT5ElSYQCOYUuByRfsY75kEA1XuqQ3GQNoK4v7hVZoym', 'Daniel', 'Grosu', '', '', '', '', '', 'dan', '0000-00-00', 0, 0, 0, 0, '2013-08-16 15:32:15', '2013-08-16 15:38:59', '2013-08-16 13:36:30', 1, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `tbl_user_question_assignment`
--

CREATE TABLE IF NOT EXISTS `tbl_user_question_assignment` (
  `user_id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL,
  PRIMARY KEY (`user_id`,`question_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Дамп данных таблицы `tbl_user_question_assignment`
--

INSERT INTO `tbl_user_question_assignment` (`user_id`, `question_id`) VALUES
(15, 145),
(15, 150);

-- --------------------------------------------------------

--
-- Структура таблицы `tbl_user_user_assignment`
--

CREATE TABLE IF NOT EXISTS `tbl_user_user_assignment` (
  `user_1` int(11) NOT NULL,
  `user_2` int(11) NOT NULL,
  PRIMARY KEY (`user_1`,`user_2`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Дамп данных таблицы `tbl_user_user_assignment`
--

INSERT INTO `tbl_user_user_assignment` (`user_1`, `user_2`) VALUES
(15, 5);

-- --------------------------------------------------------

--
-- Структура таблицы `tbl_video`
--

CREATE TABLE IF NOT EXISTS `tbl_video` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `filename` varchar(256) NOT NULL,
  `created_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
