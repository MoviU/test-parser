-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Хост: localhost:3306
-- Время создания: Июн 06 2022 г., 20:43
-- Версия сервера: 8.0.25-0ubuntu0.20.04.1
-- Версия PHP: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `test_parser`
--

-- --------------------------------------------------------

--
-- Структура таблицы `details`
--

CREATE TABLE `details` (
  `id` int UNSIGNED NOT NULL,
  `details_short` text CHARACTER SET utf8 COLLATE utf8_general_ci,
  `details_long` text CHARACTER SET utf8 COLLATE utf8_general_ci,
  `product_id` int UNSIGNED NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

--
-- Дамп данных таблицы `details`
--

INSERT INTO `details` (`id`, `details_short`, `details_long`, `product_id`) VALUES
(3, '{\"\\u0448\\u0438\\u0440\\u043e\\u043a\\u043e\\u044d\\u043a\\u0440\\u0430\\u043d\\u043d\\u044b\\u0439 (16:9)\":\"d\"}', '{\"\\u0413\\u0430\\u0440\\u0430\\u043d\\u0442\\u0438\\u044f\":[\"12 \\u043c\\u0435\\u0441.\"],\"\\u0414\\u0438\\u0430\\u0433\\u043e\\u043d\\u0430\\u043b\\u044c\":[\"40\\\" (101 \\u0441\\u043c)\"],\"\\u0420\\u0430\\u0437\\u0440\\u0435\\u0448\\u0435\\u043d\\u0438\\u0435\":[\"1920 \\u0445 1080 (Full HD)\"],\"Smart TV\":[\"\\u0434\\u0430;\",\"Android\"],\"\\u0424\\u043e\\u0440\\u043c\\u0430\\u0442 \\u044d\\u043a\\u0440\\u0430\\u043d\\u0430\":[\"\\u0448\\u0438\\u0440\\u043e\\u043a\\u043e\\u044d\\u043a\\u0440\\u0430\\u043d\\u043d\\u044b\\u0439 (16:9)\"],\"\\u042f\\u0440\\u043a\\u043e\\u0441\\u0442\\u044c\":[\"200\\u043a\\u0434\\/\\u043c2\"],\"\\u041a\\u043e\\u043d\\u0442\\u0440\\u0430\\u0441\\u0442\\u043d\\u043e\\u0441\\u0442\\u044c\":[\"1200:1\"],\"\\u0427\\u0430\\u0441\\u0442\\u043e\\u0442\\u0430 \\u0440\\u0430\\u0437\\u0432\\u0435\\u0440\\u0442\\u043a\\u0438\":[\"60\\u0413\\u0446\"],\"HDR\":[\"\\u043d\\u0435\\u0442\"],\"\\u0422\\u0438\\u043f \\u043f\\u043e\\u0434\\u0441\\u0432\\u0435\\u0442\\u043a\\u0438\":[\"LED\"],\"\\u0420\\u0430\\u0437\\u044a\\u0435\\u043c\\u044b\":[\"HDMI 2.0;\",\"USB;\",\"LAN (Ethernet);\",\"\\u0430\\u043d\\u0442\\u0435\\u043d\\u043d\\u044b\\u0439 \\u0432\\u0445\\u043e\\u0434 (RF)\"],\"\\u0411\\u0435\\u0441\\u043f\\u0440\\u043e\\u0432\\u043e\\u0434\\u043d\\u044b\\u0435 \\u043a\\u043e\\u043c\\u043c\\u0443\\u043d\\u0438\\u043a\\u0430\\u0446\\u0438\\u0438\":[\"Wi-Fi;\",\"Bluetooth;\",\"Miracast\"],\"\\u0426\\u0432\\u0435\\u0442 \\u0440\\u0430\\u043c\\u043a\\u0438\":[\"\\u0447\\u0435\\u0440\\u043d\\u044b\\u0439\"],\"\\u0412\\u0441\\u0442\\u0440\\u043e\\u0435\\u043d\\u043d\\u044b\\u0435 \\u0442\\u044e\\u043d\\u0435\\u0440\\u044b\":[\"\\u0430\\u043d\\u0430\\u043b\\u043e\\u0433\\u043e\\u0432\\u044b\\u0439;\",\"DVB-T;\",\"DVB-C;\",\"DVB-T2;\",\"DVB-S2\"],\"\\u0423\\u043f\\u0440\\u0430\\u0432\\u043b\\u0435\\u043d\\u0438\\u0435\":[\"\\u0433\\u043e\\u043b\\u043e\\u0441\\u043e\\u043c;\",\"\\u0441\\u043e \\u0441\\u043c\\u0430\\u0440\\u0442\\u0444\\u043e\\u043d\\u0430\"],\"\\u0412\\u0441\\u0442\\u0440\\u043e\\u0435\\u043d\\u043d\\u0430\\u044f \\u043f\\u0430\\u043c\\u044f\\u0442\\u044c\":[\"8\\u0413\\u0431\"],\"\\u041e\\u043f\\u0435\\u0440\\u0430\\u0442\\u0438\\u0432\\u043d\\u0430\\u044f \\u043f\\u0430\\u043c\\u044f\\u0442\\u044c\":[\"1\\u0413\\u0431\"],\"\\u0424\\u0443\\u043d\\u043a\\u0446\\u0438\\u0438\":[\"\\u0442\\u0435\\u043b\\u0435\\u0442\\u0435\\u043a\\u0441\\u0442;\",\"Time Shift (\\u0437\\u0430\\u043f\\u0438\\u0441\\u044c \\u0422\\u0412-\\u043f\\u0440\\u043e\\u0433\\u0440\\u0430\\u043c\\u043c);\",\"\\u0442\\u0430\\u0439\\u043c\\u0435\\u0440 \\\"\\u0421\\u043e\\u043d\\\";\",\"\\u0437\\u0430\\u043c\\u043e\\u043a \\u043e\\u0442 \\u0434\\u0435\\u0442\\u0435\\u0439\"],\"\\u041a\\u043e\\u043d\\u0444\\u0438\\u0433\\u0443\\u0440\\u0430\\u0446\\u0438\\u044f \\u0430\\u0443\\u0434\\u0438\\u043e\\u0441\\u0438\\u0441\\u0442\\u0435\\u043c\\u044b\":[\"2.0\"],\"\\u0421\\u0443\\u043c\\u043c\\u0430\\u0440\\u043d\\u0430\\u044f \\u043c\\u043e\\u0449\\u043d\\u043e\\u0441\\u0442\\u044c \\u0434\\u0438\\u043d\\u0430\\u043c\\u0438\\u043a\\u043e\\u0432\":[\"14\\u0412\\u0442\"],\"\\u0417\\u0432\\u0443\\u043a\\u043e\\u0432\\u044b\\u0435 \\u044d\\u0444\\u0444\\u0435\\u043a\\u0442\\u044b\":[\"DTS Studio Sound\"],\"USB \\u0440\\u0430\\u0437\\u044a\\u0435\\u043c\\u043e\\u0432\":[\"1\\u0448\\u0442\"],\"HDMI 1.4 \\u0440\\u0430\\u0437\\u044a\\u0435\\u043c\\u043e\\u0432\":[\"3\"],\"\\u0413\\u0430\\u0431\\u0430\\u0440\\u0438\\u0442\\u044b \\u0431\\u0435\\u0437 \\u043f\\u043e\\u0434\\u0441\\u0442\\u0430\\u0432\\u043a\\u0438 (\\u0428\\u0445\\u0412\\u0445\\u0413)\":[\"893 \\u0445 513 \\u0445 86\\u043c\\u043c\"],\"\\u0413\\u0430\\u0431\\u0430\\u0440\\u0438\\u0442\\u044b \\u0441 \\u043f\\u043e\\u0434\\u0441\\u0442\\u0430\\u0432\\u043a\\u043e\\u0439 (\\u0428\\u0445\\u0412\\u0445\\u0413)\":[\"893 \\u0445 559 \\u0445 182\\u043c\\u043c\"],\"\\u0412\\u0435\\u0441 \\u0431\\u0435\\u0437 \\u043f\\u043e\\u0434\\u0441\\u0442\\u0430\\u0432\\u043a\\u0438\":[\"5.4\\u043a\\u0433\"],\"\\u0412\\u0435\\u0441 \\u0441 \\u043f\\u043e\\u0434\\u0441\\u0442\\u0430\\u0432\\u043a\\u043e\\u0439\":[\"5.5\\u043a\\u0433\"],\"\\u041a\\u043e\\u043c\\u043f\\u043b\\u0435\\u043a\\u0442\\u0430\\u0446\\u0438\\u044f\":[\"\\u0442\\u0435\\u043b\\u0435\\u0432\\u0438\\u0437\\u043e\\u0440, \\u043f\\u0443\\u043b\\u044c\\u0442, \\u043a\\u0430\\u0431\\u0435\\u043b\\u044c \\u043f\\u0438\\u0442\\u0430\\u043d\\u0438\\u044f, \\u0434\\u043e\\u043a\\u0443\\u043c\\u0435\\u043d\\u0442\\u0430\\u0446\\u0438\\u044f\"],\"\\u0421\\u0442\\u0430\\u043d\\u0434\\u0430\\u0440\\u0442 \\u043a\\u0440\\u0435\\u043f\\u043b\\u0435\\u043d\\u0438\\u044f VESA\":[\"200 x 100\"]}', 6);

-- --------------------------------------------------------

--
-- Структура таблицы `prices`
--

CREATE TABLE `prices` (
  `id` int UNSIGNED NOT NULL,
  `price` decimal(12,2) DEFAULT NULL,
  `currency` varchar(8) NOT NULL,
  `product_id` int UNSIGNED NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

--
-- Дамп данных таблицы `prices`
--

INSERT INTO `prices` (`id`, `price`, `currency`, `product_id`) VALUES
(7, '10499.00', '₴', 6);

-- --------------------------------------------------------

--
-- Структура таблицы `products`
--

CREATE TABLE `products` (
  `id` int UNSIGNED NOT NULL,
  `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

--
-- Дамп данных таблицы `products`
--

INSERT INTO `products` (`id`, `title`) VALUES
(6, 'Телевизор HISENSE 40A5720FA');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `details`
--
ALTER TABLE `details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`);

--
-- Индексы таблицы `prices`
--
ALTER TABLE `prices`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`);

--
-- Индексы таблицы `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `details`
--
ALTER TABLE `details`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `prices`
--
ALTER TABLE `prices`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT для таблицы `products`
--
ALTER TABLE `products`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
