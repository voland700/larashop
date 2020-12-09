-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Дек 07 2020 г., 14:59
-- Версия сервера: 10.3.22-MariaDB
-- Версия PHP: 7.3.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `shop`
--

-- --------------------------------------------------------

--
-- Структура таблицы `currency`
--

CREATE TABLE `currency` (
  `currency` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `CharCode` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Nominal` int(10) UNSIGNED NOT NULL DEFAULT 1,
  `value` decimal(10,4) DEFAULT NULL,
  `Date` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `currency`
--

INSERT INTO `currency` (`currency`, `CharCode`, `Name`, `Nominal`, `value`, `Date`, `created_at`, `updated_at`) VALUES
('BYN', 'BYN', 'Белорусский рубль', 1, '28.9001', NULL, NULL, '2020-12-04 10:06:55'),
('EUR', 'EUR', 'Евро', 1, '90.2618', NULL, NULL, '2020-12-04 10:06:55'),
('UAH', 'UAH', 'Украинских гривен', 10, '26.2287', NULL, NULL, '2020-12-04 10:06:55'),
('USD', 'USD', 'Доллар США', 1, '74.2529', NULL, NULL, '2020-12-04 10:06:55');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `currency`
--
ALTER TABLE `currency`
  ADD UNIQUE KEY `currency_currency_unique` (`currency`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
