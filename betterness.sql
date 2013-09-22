-- phpMyAdmin SQL Dump
-- version 3.5.8.1deb1
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Сен 22 2013 г., 16:26
-- Версия сервера: 5.5.32-0ubuntu0.13.04.1-log
-- Версия PHP: 5.4.9-4ubuntu2.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `betterness`
--

-- --------------------------------------------------------

--
-- Структура таблицы `grades`
--

CREATE TABLE IF NOT EXISTS `grades` (
  `grade_id` int(7) NOT NULL AUTO_INCREMENT,
  `task_id` int(7) NOT NULL,
  `user_id` int(7) NOT NULL,
  `grade` text NOT NULL,
  PRIMARY KEY (`grade_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

--
-- Структура таблицы `regusers`
--

CREATE TABLE IF NOT EXISTS `regusers` (
  `regusers_id` int(7) NOT NULL AUTO_INCREMENT,
  `regusersemail` varchar(35) NOT NULL,
  `reguserspass` varchar(35) NOT NULL,
  PRIMARY KEY (`regusers_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

--
-- Структура таблицы `tasks`
--

CREATE TABLE IF NOT EXISTS `tasks` (
  `task_id` int(7) NOT NULL AUTO_INCREMENT,
  `taskname` tinytext NOT NULL,
  `criterias` text NOT NULL,
  PRIMARY KEY (`task_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

--
-- Структура таблицы `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(7) NOT NULL AUTO_INCREMENT,
  `username` varchar(15) NOT NULL,
  `password` varchar(35) NOT NULL,
  `email` varchar(35) NOT NULL,
  `activated` int(1) NOT NULL DEFAULT '0',
  `confirmation` varchar(35) NOT NULL,
  `reg_date` int(11) NOT NULL,
  `last_login` int(11) NOT NULL DEFAULT '0',
  `group_id` int(2) NOT NULL DEFAULT '1',
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `email`, `activated`, `confirmation`, `reg_date`, `last_login`, `group_id`) VALUES
(1, 'thermatk', '8f6356bf9c92d547de55374ce035e8c2', 'thermatk@thermatk.com', 1, '', 1367765790, 1367918144, 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
