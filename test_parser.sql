-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Хост: localhost:3306
-- Час створення: Чрв 05 2022 р., 16:47
-- Версія сервера: 8.0.25-0ubuntu0.20.04.1
-- Версія PHP: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База даних: `test_parser`
--

-- --------------------------------------------------------

--
-- Структура таблиці `details`
--

CREATE TABLE `details` (
  `id` int UNSIGNED NOT NULL,
  `detail` text CHARACTER SET utf8 COLLATE utf8_general_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Структура таблиці `prices`
--

CREATE TABLE `prices` (
  `id` int UNSIGNED NOT NULL,
  `price` decimal(12,2) DEFAULT NULL,
  `currency` varchar(8) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Структура таблиці `products`
--

CREATE TABLE `products` (
  `id` int UNSIGNED NOT NULL,
  `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `detail_id` int DEFAULT NULL,
  `price_id` int UNSIGNED DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

--
-- Індекси збережених таблиць
--

--
-- Індекси таблиці `details`
--
ALTER TABLE `details`
  ADD PRIMARY KEY (`id`);

--
-- Індекси таблиці `prices`
--
ALTER TABLE `prices`
  ADD PRIMARY KEY (`id`);

--
-- Індекси таблиці `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для збережених таблиць
--

--
-- AUTO_INCREMENT для таблиці `details`
--
ALTER TABLE `details`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблиці `prices`
--
ALTER TABLE `prices`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблиці `products`
--
ALTER TABLE `products`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
