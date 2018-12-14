-- phpMyAdmin SQL Dump
-- version 4.0.10deb1ubuntu0.1
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Дек 14 2018 г., 12:42
-- Версия сервера: 5.5.62-0ubuntu0.14.04.1
-- Версия PHP: 7.2.12-1+ubuntu14.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `eDb`
--

-- --------------------------------------------------------

--
-- Дублирующая структура для представления `all_training`
--
CREATE TABLE IF NOT EXISTS `all_training` (
`id` int(11)
,`day` int(11)
,`intensity` text
,`dayname` text
,`description` text
,`start_time` time
,`capacity` int(11)
,`first_name` text
,`last_name` text
,`tel` text
,`ya_map` text
,`image` text
,`date` date
,`price` float
,`adress` text
);
-- --------------------------------------------------------

--
-- Структура таблицы `event_training`
--

CREATE TABLE IF NOT EXISTS `event_training` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `training` int(11) NOT NULL,
  `player` int(11) NOT NULL,
  `sched` int(11) NOT NULL COMMENT '1 - yes, 2-usheduled',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `messages_list`
--

CREATE TABLE IF NOT EXISTS `messages_list` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `message_group` int(11) NOT NULL,
  `member` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `message_group`
--

CREATE TABLE IF NOT EXISTS `message_group` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `news`
--

CREATE TABLE IF NOT EXISTS `news` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` text NOT NULL,
  `text` text NOT NULL,
  `images` text NOT NULL,
  `href` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Дамп данных таблицы `news`
--

INSERT INTO `news` (`id`, `title`, `text`, `images`, `href`) VALUES
(1, '', '<div id="vk_post_39891999_1026"></div>\r\n<script type="text/javascript" src="https://vk.com/js/api/openapi.js?160"></script>\r\n<script type="text/javascript">\r\n  (function() {\r\n    VK.Widgets.Post("vk_post_39891999_1026", 39891999, 1026, ''Q55YyoYup1Dm9p0yKF-RrHXCAAQ'');\r\n  }());\r\n</script>', '', ''),
(5, '', '<div id="vk_post_39891999_1024"></div>\n<script type="text/javascript" src="https://vk.com/js/api/openapi.js?160"></script>\n<script type="text/javascript">\n  (function() {\n    VK.Widgets.Post("vk_post_39891999_1024", 39891999, 1024, ''ISdqBv2dNO37SoXPgTnMyE_m_2k'');\n  }());\n</script>', '', '');

-- --------------------------------------------------------

--
-- Структура таблицы `roots`
--

CREATE TABLE IF NOT EXISTS `roots` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` text NOT NULL,
  `last_name` text NOT NULL,
  `id_vk` int(11) NOT NULL,
  `role` int(11) NOT NULL COMMENT '0 - user 1-admin 8-god',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Дамп данных таблицы `roots`
--

INSERT INTO `roots` (`id`, `first_name`, `last_name`, `id_vk`, `role`) VALUES
(1, 'Эльдар1', 'Алиев1', 39891999, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `ssid`
--

CREATE TABLE IF NOT EXISTS `ssid` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `us_key` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Дамп данных таблицы `ssid`
--

INSERT INTO `ssid` (`id`, `us_key`) VALUES
(1, 'fecf9c0140842b3508b333862dfce8eb344bc896a6ee4180ca4aa8401d54c9c6d1b9aa00c90f57ccbef8f');

-- --------------------------------------------------------

--
-- Структура таблицы `trainer`
--

CREATE TABLE IF NOT EXISTS `trainer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` text NOT NULL,
  `last_name` text NOT NULL,
  `tel` text NOT NULL,
  `vk_id` int(11) NOT NULL,
  `sex` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

--
-- Дамп данных таблицы `trainer`
--

INSERT INTO `trainer` (`id`, `first_name`, `last_name`, `tel`, `vk_id`, `sex`) VALUES
(2, 'Эльдар', 'Алиев', ' 89625540431', 788, 0),
(12, 'Эльдар2', 'Алиев2', ' 89625540431', 788, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `training`
--

CREATE TABLE IF NOT EXISTS `training` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `trainer` int(11) NOT NULL,
  `volley_room` int(11) NOT NULL,
  `date` date NOT NULL,
  `day_of_week` int(11) NOT NULL,
  `start_time` time NOT NULL,
  `duration` int(11) NOT NULL,
  `capacity` int(11) NOT NULL,
  `level` int(11) NOT NULL,
  `repeatability` int(11) NOT NULL,
  `price` float NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- Дамп данных таблицы `training`
--

INSERT INTO `training` (`id`, `trainer`, `volley_room`, `date`, `day_of_week`, `start_time`, `duration`, `capacity`, `level`, `repeatability`, `price`) VALUES
(3, 12, 1, '2018-11-30', 1, '00:19:00', 0, 21, 3, 0, 200),
(4, 1, 3, '0000-00-00', 1, '00:20:00', 0, 16, 8, 0, 100),
(5, 1, 4, '0000-00-00', 2, '00:18:30', 0, 21, 3, 0, 200),
(6, 2, 3, '0000-00-00', 2, '00:20:30', 0, 16, 1, 0, 0),
(7, 1, 2, '0000-00-00', 2, '00:18:00', 0, 21, 3, 0, 8500),
(8, 2, 3, '0000-00-00', 2, '00:19:00', 0, 16, 3, 0, 150),
(9, 2, 1, '2018-11-13', 1, '00:19:20', 50, 80, 7, 0, 8),
(10, 1, 4, '2018-11-15', 3, '00:21:00', 5, 20, 3, 0, 850),
(11, 11, 3, '2018-12-31', 1, '13:00:00', 0, 2000, 6, 0, 1500);

-- --------------------------------------------------------

--
-- Структура таблицы `training_level`
--

CREATE TABLE IF NOT EXISTS `training_level` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `description` text NOT NULL,
  `intensity` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Дамп данных таблицы `training_level`
--

INSERT INTO `training_level` (`id`, `description`, `intensity`) VALUES
(1, 'Нападение', 'Стандарт'),
(2, 'Курс Начинающие', 'Стандарт'),
(3, 'Курс Связующие', 'Стандарт'),
(4, 'Командная', 'MIDLE'),
(5, 'Подача', 'low'),
(6, 'Прием-Защита', 'low'),
(7, 'Турнир', 'high'),
(8, 'Игровая', 'low');

-- --------------------------------------------------------

--
-- Структура таблицы `training_repeatability`
--

CREATE TABLE IF NOT EXISTS `training_repeatability` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `freq` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_vk` int(11) NOT NULL,
  `first_name` text NOT NULL,
  `last_name` text NOT NULL,
  `age` int(11) NOT NULL,
  `nick_name` text NOT NULL,
  `tel` int(11) NOT NULL,
  `role` int(11) NOT NULL,
  `sex` int(11) NOT NULL,
  `avatar` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=22 ;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `id_vk`, `first_name`, `last_name`, `age`, `nick_name`, `tel`, `role`, `sex`, `avatar`) VALUES
(21, 39891999, 'Эльдар', 'Юрьевич', 3110, '', 0, 0, 2, 'https://pp.userapi.com/c638519/v638519999/2389/jFzCxZsRaPs.jpg?ava=1');

-- --------------------------------------------------------

--
-- Структура таблицы `vkfriends`
--

CREATE TABLE IF NOT EXISTS `vkfriends` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_vk` int(11) NOT NULL,
  `first_name` text NOT NULL,
  `last_name` text NOT NULL,
  `age` int(11) NOT NULL,
  `tel` int(11) NOT NULL,
  `refferer` int(11) NOT NULL,
  `sex` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_vk` (`id_vk`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `volley_room`
--

CREATE TABLE IF NOT EXISTS `volley_room` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `city` text NOT NULL,
  `adress` text NOT NULL,
  `gps_longitude` float NOT NULL,
  `gps_latitude` float NOT NULL,
  `image` text NOT NULL,
  `ya_map` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Дамп данных таблицы `volley_room`
--

INSERT INTO `volley_room` (`id`, `name`, `city`, `adress`, `gps_longitude`, `gps_latitude`, `image`, `ya_map`) VALUES
(1, 'Центральный стадион', 'Казань', 'ул. Ташаяк, 2А', 0, 0, 'assets/img/rooms/central.jpg', ''),
(2, 'Казань Арена', 'Казань', 'просп. Ямашева, 115А, Казань', 0, 0, 'https://lvh.me/assets/img/rooms/central.jpg', '645'),
(3, 'Каи Олимп', 'Казань', 'Чистопольская ул., 67, Казань\r\n', 0, 0, 'https://lvh.me/assets/img/rooms/central.jpg', ''),
(4, 'Динамо', 'Казань', 'ул. Максима Горького, 10А, Казань\r\n', 0, 0, 'assets/img/rooms/central.jpg', '');

-- --------------------------------------------------------

--
-- Структура таблицы `week_day`
--

CREATE TABLE IF NOT EXISTS `week_day` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dayname` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Дамп данных таблицы `week_day`
--

INSERT INTO `week_day` (`id`, `dayname`) VALUES
(1, 'Понедельник'),
(2, 'Вторник'),
(3, 'Среда'),
(4, 'Четверг'),
(5, 'Пятница'),
(6, 'Суббота'),
(7, 'Воскресение');

-- --------------------------------------------------------

--
-- Структура для представления `all_training`
--
DROP TABLE IF EXISTS `all_training`;

CREATE ALGORITHM=TEMPTABLE DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `all_training` AS select `training`.`id` AS `id`,`training`.`day_of_week` AS `day`,`training_level`.`intensity` AS `intensity`,`week_day`.`dayname` AS `dayname`,`training_level`.`description` AS `description`,`training`.`start_time` AS `start_time`,`training`.`capacity` AS `capacity`,`trainer`.`first_name` AS `first_name`,`trainer`.`last_name` AS `last_name`,`trainer`.`tel` AS `tel`,`volley_room`.`ya_map` AS `ya_map`,`volley_room`.`image` AS `image`,`training`.`date` AS `date`,`training`.`price` AS `price`,`volley_room`.`adress` AS `adress` from ((((`training` left join `week_day` on((`training`.`day_of_week` = `week_day`.`id`))) left join `training_level` on((`training`.`level` = `training_level`.`id`))) left join `volley_room` on((`training`.`volley_room` = `volley_room`.`id`))) left join `trainer` on((`training`.`trainer` = `trainer`.`id`)));

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
