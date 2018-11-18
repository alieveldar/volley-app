-- phpMyAdmin SQL Dump
-- version 4.0.10deb1ubuntu0.1
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Ноя 17 2018 г., 07:35
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
-- Структура таблицы `event_training`
--

CREATE TABLE IF NOT EXISTS `event_training` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `training` int(11) NOT NULL,
  `player` int(11) NOT NULL,
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `trainer`
--

CREATE TABLE IF NOT EXISTS `trainer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` text NOT NULL,
  `last_name` text NOT NULL,
  `tel` int(11) NOT NULL,
  `vk_id` int(11) NOT NULL,
  `sex` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Дамп данных таблицы `trainer`
--

INSERT INTO `trainer` (`id`, `first_name`, `last_name`, `tel`, `vk_id`, `sex`) VALUES
(1, 'Уле-Эйнар', 'Бьорндаллен', 2147483647, 1306508, 2),
(2, 'Мартэн', 'Фуркад', 222222222, 1306508, 2),
(3, 'Йоханнес', 'Бё', 33333, 1306508, 0);

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
  `start_time` int(11) NOT NULL,
  `duration` int(11) NOT NULL,
  `capacity` int(11) NOT NULL,
  `level` int(11) NOT NULL,
  `repeatability` int(11) NOT NULL,
  `price` float NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Дамп данных таблицы `training`
--

INSERT INTO `training` (`id`, `trainer`, `volley_room`, `date`, `day_of_week`, `start_time`, `duration`, `capacity`, `level`, `repeatability`, `price`) VALUES
(1, 2, 4, '0000-00-00', 1, 2000, 0, 21, 1, 0, 150),
(2, 1, 2, '0000-00-00', 1, 1830, 0, 16, 2, 0, 800),
(3, 3, 1, '0000-00-00', 1, 1900, 0, 21, 3, 0, 200),
(4, 1, 3, '0000-00-00', 1, 2000, 0, 16, 8, 0, 100),
(5, 1, 4, '0000-00-00', 2, 1830, 0, 21, 0, 0, 200),
(6, 2, 3, '0000-00-00', 2, 2030, 0, 16, 1, 0, 0),
(7, 1, 2, '0000-00-00', 2, 1800, 0, 21, 3, 0, 8500),
(8, 2, 3, '0000-00-00', 2, 1900, 0, 16, 3, 0, 150),
(9, 2, 1, '2018-11-13', 1, 1920, 50, 80, 7, 0, 8);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=513 ;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `id_vk`, `first_name`, `last_name`, `age`, `nick_name`, `tel`, `role`, `sex`, `avatar`) VALUES
(407, 39891999, 'Антон', 'Шипулин', 3110, '', 0, 0, 2, 'https://pp.userapi.com/c638519/v638519999/2389/jFzCxZsRaPs.jpg?ava=1'),
(512, 514842413, 'Антон', 'Бабиков', 3110, '', 0, 0, 2, 'https://vk.com/images/camera_50.png?ava=1');

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
(1, 'Центральный стадион', 'Казань', 'ул. Ташаяк, 2А, Казань', 0, 0, 'assets/img/rooms/central.jpg', ''),
(2, 'Казань Арена', 'Казань', 'просп. Ямашева, 115А, Казань', 0, 0, 'https://lvh.me/assets/img/rooms/central.jpg', ''),
(3, 'Каи Олимп', 'Казань', 'Чистопольская ул., 67, Казань\r\n', 0, 0, 'https://lvh.me/assets/img/rooms/central.jpg', ''),
(4, 'Динамо', 'Казань', 'ул. Максима Горького, 10А, Казань\r\n', 0, 0, 'assets/img/rooms/central.jpg', '');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
