-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Хост: localhost
-- Время создания: Июн 08 2021 г., 09:33
-- Версия сервера: 10.4.19-MariaDB
-- Версия PHP: 8.0.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `yii_lab6`
--

-- --------------------------------------------------------

--
-- Структура таблицы `department`
--

CREATE TABLE `department` (
  `department_id` int(11) NOT NULL,
  `department_name` varchar(255) NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `type_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `department`
--

INSERT INTO `department` (`department_id`, `department_name`, `parent_id`, `type_id`) VALUES
(1, 'Рада директорів', NULL, 1),
(2, 'Головна виконавча рада', 1, 1),
(3, 'Операційний центр', 2, 2),
(4, 'Фінансовий центр', 2, 2),
(5, 'Центр розробки', 2, 2),
(6, 'Відділ кадрів', 3, 3),
(7, 'Відділ продажів', 3, 3),
(8, 'Маркетинговий центр', 2, 2),
(9, 'Відділ аудиту', 4, 3),
(10, 'Відділ податків', 4, 3),
(11, 'Казначейський відділ', 4, 3),
(12, 'Рекламний відділ', 8, 3),
(13, 'Відділ аналізу потреб споживачів', 8, 3),
(14, 'Відділ зв\'язків з громадськістю', 8, 3),
(15, 'Відділ розробки', 5, 3),
(16, 'Відділ досліджень', 5, 3),
(17, 'Відділ внутрішньої інфраструктури', 5, 3),
(18, 'Відділ статистики', 3, 3),
(19, 'Відділ ризиків', 4, 3);

-- --------------------------------------------------------

--
-- Структура таблицы `department_type`
--

CREATE TABLE `department_type` (
  `type_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `department_type`
--

INSERT INTO `department_type` (`type_id`, `name`) VALUES
(1, 'Board'),
(2, 'Center'),
(3, 'Department');

-- --------------------------------------------------------

--
-- Структура таблицы `employee`
--

CREATE TABLE `employee` (
  `employee_id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `department_id` int(11) NOT NULL,
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `employee`
--

INSERT INTO `employee` (`employee_id`, `first_name`, `last_name`, `email`, `user_id`, `department_id`, `image`) VALUES
(4, 'Jonathan', 'Webb', 'YaroslavHrishyn1@gmail.com', 5, 1, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `migration`
--

CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `migration`
--

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1617457793),
('m130524_201442_init', 1617457798),
('m190124_110200_add_verification_token_column_to_user_table', 1617457798);

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT 10,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `verification_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`id`, `username`, `auth_key`, `password_hash`, `password_reset_token`, `email`, `status`, `created_at`, `updated_at`, `verification_token`) VALUES
(1, 'sasha', 'HbF9fT7kNLDeLX6DSDKvFyLUYeUXiuXQ', '$2y$13$u/H5wGMtNYwOzeMNTVmHDufJUJVJ6HMbG81rPz9flFzbdWgRilRZO', NULL, 'svistelniksasha2001@gmail.com', 10, 1617477444, 1617477444, '4jxPv9jLeMBavRxvMdRO7OnGhQXkVCUk_1617477444'),
(2, 'sofia', 'ss3xOdeq3gNJuNv3PwmHCe4nFpBBLldy', '$2y$13$pdYtDTfrUrQf/rGLIA1BvemALSFkHS74q.ZmMc5E7ydV5omilly22', NULL, 'sofia@gmail.com', 10, 1618814973, 1618814973, 'KEA18NU_Vki2J4YiaZvshtW9sn0VP918_1618814973'),
(3, 'ivan', '2CPbElqwmvxjE9jq_2OeQ_YedsgXrOcL', '$2y$13$gYI2VGNROcPPRw6R9mg25.eyAvAQ/.HcvkIUGJ5hVbA6qes8lDN6.', NULL, 'ivan@gmail.com', 10, 1618816302, 1618816302, 'KXsf3e6HQ-8oVgJ9xNos3dfDaia_G326_1618816302'),
(5, 'Webb', 'XDCLG_PMytjHLmf2S36UymF2cSyDZYbq', '$2y$13$bZfwSog5DuYTvSKhn3MOOePJbCQ.rLVxiRmcuWU5tpyv6OEH9hMYu', NULL, 'YaroslavHrishyn1@gmail.com', 10, 1623133506, 1623133506, 'VlDZhNbNDvqsJpWsxEkvlZwlJSpTmvfl_1623133506');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`department_id`),
  ADD KEY `type_id` (`type_id`);

--
-- Индексы таблицы `department_type`
--
ALTER TABLE `department_type`
  ADD PRIMARY KEY (`type_id`);

--
-- Индексы таблицы `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`employee_id`),
  ADD UNIQUE KEY `email` (`email`) USING BTREE,
  ADD UNIQUE KEY `user_id` (`user_id`) USING BTREE,
  ADD KEY `department_id` (`department_id`);

--
-- Индексы таблицы `migration`
--
ALTER TABLE `migration`
  ADD PRIMARY KEY (`version`);

--
-- Индексы таблицы `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `password_reset_token` (`password_reset_token`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `department`
--
ALTER TABLE `department`
  MODIFY `department_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT для таблицы `department_type`
--
ALTER TABLE `department_type`
  MODIFY `type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `employee`
--
ALTER TABLE `employee`
  MODIFY `employee_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `department`
--
ALTER TABLE `department`
  ADD CONSTRAINT `department_ibfk_1` FOREIGN KEY (`type_id`) REFERENCES `department_type` (`type_id`);

--
-- Ограничения внешнего ключа таблицы `employee`
--
ALTER TABLE `employee`
  ADD CONSTRAINT `employee_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `employee_ibfk_2` FOREIGN KEY (`department_id`) REFERENCES `department` (`department_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
