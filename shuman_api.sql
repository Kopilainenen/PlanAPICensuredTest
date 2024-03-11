-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Хост: localhost
-- Время создания: Мар 09 2024 г., 16:25
-- Версия сервера: 5.7.21-20-beget-5.7.21-20-1-log
-- Версия PHP: 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `payusovs95_api`
--

-- --------------------------------------------------------

--
-- Структура таблицы `Tarif_plan`
--
-- Создание: Мар 09 2024 г., 10:46
--

DROP TABLE IF EXISTS `Tarif_plan`;
CREATE TABLE `Tarif_plan` (
  `id` bigint(20) NOT NULL,
  `type` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `price` varchar(255) NOT NULL,
  `is_archive` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `Tarif_type`
--
-- Создание: Мар 09 2024 г., 10:44
-- Последнее обновление: Мар 09 2024 г., 10:49
--

DROP TABLE IF EXISTS `Tarif_type`;
CREATE TABLE `Tarif_type` (
  `id_type` int(11) NOT NULL,
  `name_type` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `Tarif_type`
--

INSERT INTO `Tarif_type` (`id_type`, `name_type`) VALUES
(1, 'free'),
(2, 'pro'),
(3, 'business');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `Tarif_plan`
--
ALTER TABLE `Tarif_plan`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `type` (`type`);

--
-- Индексы таблицы `Tarif_type`
--
ALTER TABLE `Tarif_type`
  ADD PRIMARY KEY (`id_type`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `Tarif_plan`
--
ALTER TABLE `Tarif_plan`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `Tarif_type`
--
ALTER TABLE `Tarif_type`
  MODIFY `id_type` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `Tarif_plan`
--
ALTER TABLE `Tarif_plan`
  ADD CONSTRAINT `Tarif_plan_ibfk_1` FOREIGN KEY (`type`) REFERENCES `Tarif_type` (`id_type`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
