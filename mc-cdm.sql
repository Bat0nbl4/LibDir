-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Хост: MySQL-8.2
-- Время создания: Май 31 2026 г., 20:56
-- Версия сервера: 8.2.0
-- Версия PHP: 8.3.6

SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `mc-cdm`
--
CREATE DATABASE IF NOT EXISTS `mc-cdm` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `mc-cdm`;

-- --------------------------------------------------------

--
-- Структура таблицы `appoint`
--

CREATE TABLE `appoint` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `event_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Очистить таблицу перед добавлением данных `appoint`
--

TRUNCATE TABLE `appoint`;
-- --------------------------------------------------------

--
-- Структура таблицы `event`
--

CREATE TABLE `event` (
  `id` int NOT NULL,
  `title` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `status_id` int NOT NULL DEFAULT '1',
  `short_description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `img` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Очистить таблицу перед добавлением данных `event`
--

TRUNCATE TABLE `event`;
--
-- Дамп данных таблицы `event`
--

INSERT INTO `event` (`id`, `title`, `description`, `start_date`, `end_date`, `status_id`, `short_description`, `img`) VALUES
(1, '«Алтай. Территория развития – 2026»', 'Мероприятие объединило более 350 представителей активной молодёжи Алтайского края в возрасте от 14 до 35 лет: волонтёров, лидеров студенческого самоуправления, педагогов, государственных служащих, активистов «Движения Первых», бойцов студенческих отрядов, медийных специалистов и работающую молодёжь.', NULL, '2026-05-25', 2, 'С 22 по 25 мая на базе санатория «Сосновый бор» (с. Зудилово, Первомайский район) состоялся 18-й региональный форум «Алтай. Территория развития».', 'ATR.jpg');

-- --------------------------------------------------------

--
-- Структура таблицы `event_status`
--

CREATE TABLE `event_status` (
  `id` int NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `style` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Очистить таблицу перед добавлением данных `event_status`
--

TRUNCATE TABLE `event_status`;
--
-- Дамп данных таблицы `event_status`
--

INSERT INTO `event_status` (`id`, `name`, `style`) VALUES
(1, 'Планируется', NULL),
(2, 'Идёт набор', NULL),
(3, 'Проходит', NULL),
(4, 'Прошло', NULL),
(5, 'Отмененно', NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `role`
--

CREATE TABLE `role` (
  `id` int NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `short_name` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Очистить таблицу перед добавлением данных `role`
--

TRUNCATE TABLE `role`;
--
-- Дамп данных таблицы `role`
--

INSERT INTO `role` (`id`, `name`, `short_name`) VALUES
(1, 'Пользователь', 'user');

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE `user` (
  `id` int NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `surname` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `patronymic` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `birthdate` date NOT NULL,
  `email` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` enum('М','Ж') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'М',
  `role_id` int NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Очистить таблицу перед добавлением данных `user`
--

TRUNCATE TABLE `user`;
--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`id`, `name`, `surname`, `patronymic`, `birthdate`, `email`, `phone`, `password`, `gender`, `role_id`) VALUES
(2, 'Олег', 'Богомолов', 'Олегович', '2006-05-15', 'bat0nbl4@mail.ru', '+7 (983) 356-1527', '$2y$12$.hJ1f3.dPxqpnJ7cFJaIdOY1IIFMD2KsCTFQh.zrd6PaAXU93Siz2', 'М', 1),
(3, 'Иван', 'Иванов', '', '2004-06-10', 'example@mail.ru', '+7 (800) 555-3535', '$2y$12$sYhevQ2kxoqoBoxAO/GTjOVxNjncNcb88yo3Vfr28cOd.HVApWE5i', 'М', 1);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `appoint`
--
ALTER TABLE `appoint`
  ADD PRIMARY KEY (`id`),
  ADD KEY `appoint_user_FK` (`user_id`),
  ADD KEY `appoint_event_FK` (`event_id`);

--
-- Индексы таблицы `event`
--
ALTER TABLE `event`
  ADD PRIMARY KEY (`id`),
  ADD KEY `event_event_status_FK` (`status_id`);

--
-- Индексы таблицы `event_status`
--
ALTER TABLE `event_status`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `role_short_name` (`short_name`);

--
-- Индексы таблицы `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_email` (`email`),
  ADD UNIQUE KEY `user_phone` (`phone`),
  ADD KEY `user_role_FK` (`role_id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `appoint`
--
ALTER TABLE `appoint`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `event`
--
ALTER TABLE `event`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `event_status`
--
ALTER TABLE `event_status`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `role`
--
ALTER TABLE `role`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `user`
--
ALTER TABLE `user`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `appoint`
--
ALTER TABLE `appoint`
  ADD CONSTRAINT `appoint_event_FK` FOREIGN KEY (`event_id`) REFERENCES `event` (`id`),
  ADD CONSTRAINT `appoint_user_FK` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Ограничения внешнего ключа таблицы `event`
--
ALTER TABLE `event`
  ADD CONSTRAINT `event_event_status_FK` FOREIGN KEY (`status_id`) REFERENCES `event_status` (`id`);

--
-- Ограничения внешнего ключа таблицы `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_role_FK` FOREIGN KEY (`role_id`) REFERENCES `role` (`id`);
SET FOREIGN_KEY_CHECKS=1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
