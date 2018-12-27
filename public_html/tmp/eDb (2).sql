-- phpMyAdmin SQL Dump
-- version 4.0.10deb1ubuntu0.1
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Дек 27 2018 г., 20:02
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
-- Структура для представления `all_training`
--

CREATE ALGORITHM=TEMPTABLE DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `all_training` AS select `training`.`id` AS `id`,`training`.`day_of_week` AS `day`,`training_level`.`intensity` AS `intensity`,`week_day`.`dayname` AS `dayname`,`training_level`.`description` AS `description`,`training`.`start_time` AS `start_time`,`training`.`capacity` AS `capacity`,`trainer`.`first_name` AS `first_name`,`trainer`.`last_name` AS `last_name`,`trainer`.`tel` AS `tel`,`volley_room`.`ya_map` AS `ya_map`,`volley_room`.`image` AS `image`,`training`.`date` AS `date`,`training`.`price` AS `price`,`volley_room`.`adress` AS `adress`,`trainer`.`id` AS `trainer_id`,`volley_room`.`id` AS `room_id`,`training_level`.`id` AS `training_intesid` from ((((`training` left join `week_day` on((`training`.`day_of_week` = `week_day`.`id`))) left join `training_level` on((`training`.`level` = `training_level`.`id`))) left join `volley_room` on((`training`.`volley_room` = `volley_room`.`id`))) left join `trainer` on((`training`.`trainer` = `trainer`.`id`)));

--
-- VIEW  `all_training`
-- Данные: Нет
--


/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
