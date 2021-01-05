-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Янв 05 2021 г., 22:27
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
-- База данных: `las-core`
--

-- --------------------------------------------------------

--
-- Структура таблицы `attribute`
--

CREATE TABLE `attribute` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sort` int(10) UNSIGNED NOT NULL DEFAULT 200,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `attribute`
--

INSERT INTO `attribute` (`id`, `name`, `sort`, `created_at`, `updated_at`) VALUES
(1, 'Производитель', 5, NULL, NULL),
(2, 'Гарантия производителя', 10, NULL, NULL),
(3, 'Артикул товара', 20, NULL, NULL),
(4, 'Длина', 25, NULL, NULL),
(5, 'Глубина', 35, NULL, NULL),
(6, 'Высота', 40, NULL, NULL),
(7, 'Ширина', 45, NULL, NULL),
(8, 'Диаметр', 50, NULL, NULL),
(9, 'Толщина', 55, NULL, NULL),
(10, 'Размер под посадку', 60, NULL, NULL),
(11, 'Внешний размер', 65, NULL, NULL),
(12, 'Мощность', 70, NULL, NULL),
(13, 'Отапливаемя площадь', 75, NULL, NULL),
(14, 'Чистое горение', 80, NULL, NULL),
(15, 'Вторичный дожиг газов', 85, NULL, NULL),
(16, 'Длительное горение', 90, NULL, NULL),
(17, 'Подвод воздуха', 95, NULL, NULL),
(18, 'Топится', 95, NULL, NULL),
(19, 'Объем парного помещения', 100, NULL, NULL),
(20, 'Масса камней', 105, NULL, NULL),
(21, 'Диаметр дымохода', 110, NULL, NULL),
(22, 'Подключение дымохода', 115, NULL, NULL),
(23, 'Цвет', 120, NULL, NULL),
(24, 'Масса', 125, NULL, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `_lft` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `_rgt` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `parent_id` int(10) UNSIGNED DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `active` int(10) UNSIGNED NOT NULL DEFAULT 1,
  `sort` int(10) UNSIGNED NOT NULL DEFAULT 500,
  `h1` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `img` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `prev_img` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `categories`
--

INSERT INTO `categories` (`id`, `_lft`, `_rgt`, `parent_id`, `name`, `slug`, `active`, `sort`, `h1`, `meta_title`, `meta_description`, `description`, `img`, `prev_img`, `created_at`, `updated_at`) VALUES
(1, 1, 10, NULL, 'Первая главная категория', 'pervaya-glavnaya-kategoriya', 1, 500, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2, 2, 3, 1, 'Вторая вложенная категория-2', 'vtoraya-vlozhennaya-kategoriya-2', 1, 500, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(3, 4, 9, 1, 'Другая вложенная категория', 'drugaya-vlozhennaya-kategoriya', 1, 500, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(4, 5, 6, 3, 'Вложенная категория 3-го уровня', 'vlozhennaya-kategoriya-3-go-urovnya', 1, 500, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(5, 7, 8, 3, 'Другая вложенная 3-го уровня', 'drugaya-vlozhennaya-3-go-urovnya', 1, 500, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `currency`
--

CREATE TABLE `currency` (
  `currency` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `CharCode` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Nominal` int(10) UNSIGNED NOT NULL DEFAULT 1,
  `value` decimal(10,4) UNSIGNED NOT NULL,
  `Date` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `currency`
--

INSERT INTO `currency` (`currency`, `CharCode`, `Name`, `Nominal`, `value`, `Date`, `created_at`, `updated_at`) VALUES
('BYN', 'BYN', 'Белорусский рубль', 1, '28.5234', NULL, NULL, '2021-01-05 12:52:10'),
('EUR', 'EUR', 'Евро', 1, '90.7932', NULL, NULL, '2021-01-05 12:52:10'),
('UAH', 'UAH', 'Украинских гривен', 10, '26.0711', NULL, NULL, '2021-01-05 12:52:10'),
('USD', 'USD', 'Доллар США', 1, '73.8757', NULL, NULL, '2021-01-05 12:52:10');

-- --------------------------------------------------------

--
-- Структура таблицы `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `image`
--

CREATE TABLE `image` (
  `id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `sort` int(10) UNSIGNED NOT NULL DEFAULT 500,
  `img` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `thumbnail` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `image`
--

INSERT INTO `image` (`id`, `product_id`, `sort`, `img`, `thumbnail`, `created_at`, `updated_at`) VALUES
(21, 1, 500, 'storage/upload/images/05/1609353524_big_kcq.jpg', 'storage/upload/images/05/1609353524_small_jq0.jpg', '2020-12-30 15:38:44', '2020-12-30 15:38:44'),
(22, 1, 500, 'storage/upload/images/nx/1609353524_big_x4k.jpg', 'storage/upload/images/nx/1609353524_small_wpu.jpg', '2020-12-30 15:38:44', '2020-12-30 15:38:44'),
(23, 1, 500, 'storage/upload/images/ii/1609353524_big_y8t.jpg', 'storage/upload/images/ii/1609353524_small_4vq.jpg', '2020-12-30 15:38:44', '2020-12-30 15:38:44'),
(24, 1, 500, 'storage/upload/images/ze/1609353524_big_lda.jpg', 'storage/upload/images/ze/1609353524_small_vdc.jpg', '2020-12-30 15:38:44', '2020-12-30 15:38:44'),
(25, 2, 500, 'storage/upload/images/g3/big_1609862219_b6.jpg', 'storage/upload/images/g3/small_1609862219_b6.jpg', '2021-01-05 12:56:59', '2021-01-05 12:56:59'),
(26, 2, 500, 'storage/upload/images/s1/big_1609862219_pu.jpg', 'storage/upload/images/s1/small_1609862219_pu.jpg', '2021-01-05 12:56:59', '2021-01-05 12:56:59'),
(27, 3, 500, 'storage/upload/images/2y/big_1609862543_iy.jpg', 'storage/upload/images/2y/small_1609862543_iy.jpg', '2021-01-05 13:02:23', '2021-01-05 13:02:23'),
(28, 3, 500, 'storage/upload/images/zv/big_1609862543_rf.jpg', 'storage/upload/images/zv/small_1609862543_rf.jpg', '2021-01-05 13:02:23', '2021-01-05 13:02:23'),
(29, 4, 500, 'storage/upload/images/ix/big_1609862765_ec.jpg', 'storage/upload/images/ix/small_1609862765_ec.jpg', '2021-01-05 13:06:05', '2021-01-05 13:06:05'),
(30, 4, 500, 'storage/upload/images/ik/big_1609862765_su.jpg', 'storage/upload/images/ik/small_1609862765_su.jpg', '2021-01-05 13:06:05', '2021-01-05 13:06:05'),
(31, 4, 500, 'storage/upload/images/r4/big_1609862765_gx.jpg', 'storage/upload/images/r4/small_1609862765_gx.jpg', '2021-01-05 13:06:05', '2021-01-05 13:06:05'),
(32, 5, 500, 'storage/upload/images/co/big_1609863018_n0.jpg', 'storage/upload/images/co/small_1609863018_n0.jpg', '2021-01-05 13:10:18', '2021-01-05 13:10:18'),
(33, 5, 500, 'storage/upload/images/9i/big_1609863018_bj.jpg', 'storage/upload/images/9i/small_1609863018_bj.jpg', '2021-01-05 13:10:18', '2021-01-05 13:10:18');

-- --------------------------------------------------------

--
-- Структура таблицы `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2014_10_12_200000_add_two_factor_columns_to_users_table', 1),
(4, '2019_08_19_000000_create_failed_jobs_table', 1),
(5, '2020_10_28_075827_create_permission_tables', 1),
(6, '2020_12_03_084954_create_products_table', 1),
(7, '2020_12_03_101856_create_categories_table', 1),
(8, '2020_12_03_102225_create_images_table', 1),
(9, '2020_12_03_111112_create_currency_table', 1),
(10, '2020_12_03_115422_create_attributes_table', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `product`
--

CREATE TABLE `product` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `active` int(10) UNSIGNED NOT NULL DEFAULT 1,
  `hit` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `new` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `stock` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `advice` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `sort` int(10) UNSIGNED NOT NULL DEFAULT 500,
  `category_id` int(10) UNSIGNED NOT NULL,
  `h1` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `prev` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `img` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `prev_img` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `base_price` decimal(10,2) UNSIGNED NOT NULL DEFAULT 0.00,
  `price` decimal(10,2) UNSIGNED NOT NULL DEFAULT 0.00,
  `currency` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'RUB',
  `properties` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `product`
--

INSERT INTO `product` (`id`, `created_at`, `updated_at`, `name`, `slug`, `active`, `hit`, `new`, `stock`, `advice`, `sort`, `category_id`, `h1`, `meta_title`, `meta_description`, `prev`, `description`, `img`, `prev_img`, `base_price`, `price`, `currency`, `properties`) VALUES
(1, '2020-12-30 15:38:43', '2020-12-30 15:38:43', 'Первый товар', 'pervyy-tovar', 1, 0, 0, 0, 0, 500, 1, NULL, NULL, NULL, NULL, NULL, NULL, 'storage/upload/images/8w/1609353523_prev_br.jpg', '5000.00', '453966.00', 'EUR', '{\"1\":{\"name\":\"Производитель\",\"value\":\"MORSO\"},\"2\":{\"name\":\"Гарантия производителя\",\"value\":\"10 лет\"},\"4\":{\"name\":\"Длина\",\"value\":\"157 мм\"},\"5\":{\"name\":\"Глубина\",\"value\":\"390 мм\"},\"6\":{\"name\":\"Высота\",\"value\":\"557 мм\"},\"7\":{\"name\":\"Ширина\",\"value\":\"300 мм\"},\"8\":{\"name\":\"Диаметр\",\"value\":\"125 мм\"},\"12\":{\"name\":\"Мощность\",\"value\":\"7,5 кВт\"},\"13\":{\"name\":\"Отапливаемя площадь\",\"value\":\"45-100 м2\"},\"14\":{\"name\":\"Чистое горение\",\"value\":\"Да\"},\"15\":{\"name\":\"Вторичный дожиг газов\",\"value\":\"Да\"},\"16\":{\"name\":\"Длительное горение\",\"value\":\"Да\"},\"17\":{\"name\":\"Подвод воздуха\",\"value\":\"Да\"},\"24\":{\"name\":\"Масса\",\"value\":\"120 кг\"}}'),
(2, '2021-01-05 12:56:58', '2021-01-05 12:56:58', 'Товар 2 - в рублях', 'tovar-2-v-rublyah', 1, 0, 0, 0, 0, 500, 2, 'Заголовок H1', 'META Title', 'META Description', NULL, NULL, 'storage/upload/images/mo/1609862218_slsyc.jpg', 'storage/upload/images/rp/1609862218_prev_7v.jpg', '25700.00', '25700.00', 'RUB', '{\"1\":{\"name\":\"Производитель\",\"value\":\"Везувий\"},\"2\":{\"name\":\"Гарантия производителя\",\"value\":\"2 года\"},\"4\":{\"name\":\"Длина\",\"value\":\"157 мм\"},\"5\":{\"name\":\"Глубина\",\"value\":\"390 мм\"},\"6\":{\"name\":\"Высота\",\"value\":\"557 мм\"},\"18\":{\"name\":\"Топится\",\"value\":\"Из парной\"},\"19\":{\"name\":\"Объем парного помещения\",\"value\":\"25 м3\"},\"20\":{\"name\":\"Масса камней\",\"value\":\"70 кг\"},\"21\":{\"name\":\"Диаметр дымохода\",\"value\":\"150 мм\"}}'),
(3, '2021-01-05 13:02:23', '2021-01-05 13:02:23', 'Товар в в долларах США', 'tovar-v-v-dollarah-ssha', 1, 0, 0, 0, 0, 500, 3, 'Заголовок H1', 'META Title', 'META Description', NULL, NULL, 'storage/upload/images/qi/1609862543_6xmso.jpg', 'storage/upload/images/dk/1609862543_prev_d4.jpg', '250.00', '18468.93', 'USD', '{\"1\":{\"name\":\"Производитель\",\"value\":\"Рубцовский ЛДВ\"},\"10\":{\"name\":\"Размер под посадку\",\"value\":\"250*350 мм\"},\"11\":{\"name\":\"Внешний размер\",\"value\":\"270*370 мм\"},\"23\":{\"name\":\"Цвет\",\"value\":\"черный\"},\"24\":{\"name\":\"Масса\",\"value\":\"7,5 кг\"}}'),
(4, '2021-01-05 13:06:05', '2021-01-05 13:06:05', 'Товар из Беларусии', 'tovar-iz-belarusii', 1, 1, 1, 1, 0, 500, 4, NULL, NULL, NULL, 'Фуражка военная, полу-шерстиная купитьв Москве по цене завода', 'Фуражки, военные, МВД, для армии и флота - от Российского производителя ООО Полковник Воронов. Производство -Россия. Доставка по всей России', 'storage/upload/images/bc/1609862765_yvr6z.jpg', 'storage/upload/images/am/1609862765_prev_yl.jpg', '0.00', '0.00', 'RUB', '{\"1\":{\"name\":\"Производитель\",\"value\":\"Полковник Воронов\"},\"2\":{\"name\":\"Гарантия производителя\",\"value\":\"2 года\"},\"11\":{\"name\":\"Внешний размер\",\"value\":\"58\"},\"24\":{\"name\":\"Масса\",\"value\":\"200 гр\"}}'),
(5, '2021-01-05 13:10:18', '2021-01-05 13:10:18', 'Фуражки для Украины', 'furazhki-dlya-ukrainy', 1, 0, 1, 0, 1, 27, 5, 'Фуражка офицера армии РФ', 'Фуражка офицерская, Российской армии, для поставки в Украину', 'Производитель фуражек Полковник Воронов, предлагает фуражки для России и Украины - цены в гривнах', NULL, NULL, 'storage/upload/images/fj/1609863018_cr6pn.jpg', 'storage/upload/images/vb/1609863018_prev_za.jpg', '700.00', '182497.70', 'UAH', '{\"1\":{\"name\":\"Производитель\",\"value\":\"Полковник Воронов\"},\"2\":{\"name\":\"Гарантия производителя\",\"value\":\"2 года\"},\"3\":{\"name\":\"Артикул товара\",\"value\":\"4500579\"},\"7\":{\"name\":\"Ширина\",\"value\":\"210 мм\"},\"11\":{\"name\":\"Внешний размер\",\"value\":\"58\"},\"23\":{\"name\":\"Цвет\",\"value\":\"синий\"},\"24\":{\"name\":\"Масса\",\"value\":\"200 гр\"}}');

-- --------------------------------------------------------

--
-- Структура таблицы `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'web', '2020-12-30 12:08:25', '2020-12-30 12:08:25');

-- --------------------------------------------------------

--
-- Структура таблицы `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `two_factor_secret` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `two_factor_recovery_codes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `two_factor_secret`, `two_factor_recovery_codes`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Administrator', 'admin@mail.mail', NULL, '$2y$10$DDBlvcFht0KDukETylxmcegyc04SsT06ymwGEaOEdT/jvN./t4Qaq', NULL, NULL, 'EyNfNxo9RJJfpnFheCx9n0tz9bP8SHVxamvIQPyz0I3zJkjfoeLX1kCiP6hV', '2020-12-30 12:08:26', '2020-12-30 12:08:26');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `attribute`
--
ALTER TABLE `attribute`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categories_slug_unique` (`slug`),
  ADD KEY `categories__lft__rgt_parent_id_index` (`_lft`,`_rgt`,`parent_id`);

--
-- Индексы таблицы `currency`
--
ALTER TABLE `currency`
  ADD UNIQUE KEY `currency_currency_unique` (`currency`);

--
-- Индексы таблицы `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Индексы таблицы `image`
--
ALTER TABLE `image`
  ADD PRIMARY KEY (`id`),
  ADD KEY `image_product_id_foreign` (`product_id`);

--
-- Индексы таблицы `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Индексы таблицы `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Индексы таблицы `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Индексы таблицы `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `attribute`
--
ALTER TABLE `attribute`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT для таблицы `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `image`
--
ALTER TABLE `image`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT для таблицы `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT для таблицы `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `product`
--
ALTER TABLE `product`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `image`
--
ALTER TABLE `image`
  ADD CONSTRAINT `image_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
