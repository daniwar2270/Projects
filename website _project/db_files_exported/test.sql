-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Време на генериране: 18 апр 2022 в 11:06
-- Версия на сървъра: 10.4.21-MariaDB
-- Версия на PHP: 8.0.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данни: `test`
--

-- --------------------------------------------------------

--
-- Структура на таблица `images`
--

CREATE TABLE `images` (
  `id` int(11) NOT NULL,
  `title` text NOT NULL,
  `description` text NOT NULL,
  `filepath` text NOT NULL,
  `uploaded_date` datetime NOT NULL DEFAULT current_timestamp(),
  `user_id` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Схема на данните от таблица `images`
--

INSERT INTO `images` (`id`, `title`, `description`, `filepath`, `uploaded_date`, `user_id`) VALUES
(9, '9564', '456', 'images/8-Room.jpeg', '2022-04-11 17:27:26', 44),
(10, 'jacuzzi', 'relax time', 'images/2.jpeg', '2022-04-12 11:06:27', 44),
(11, 'Porch', 'bbq on a sunny day', 'images/3.jpg', '2022-04-12 15:57:36', 44),
(12, 'bedroom', '2nd floor bedroom', 'images/4-Room-4.jpeg', '2022-04-13 01:14:19', 44),
(13, 'bathroom', 'bathroom 2nd flooor\r\n', 'images/10-Room-1-Suite.jpeg', '2022-04-13 01:28:03', 44),
(14, 'kitchen', 'kitchen', 'images/kitchen.jpeg', '2022-04-13 15:47:21', 43);

-- --------------------------------------------------------

--
-- Структура на таблица `news`
--

CREATE TABLE `news` (
  `id` int(255) NOT NULL,
  `news` varchar(255) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp(),
  `user_id` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Схема на данните от таблица `news`
--

INSERT INTO `news` (`id`, `news`, `date`, `user_id`) VALUES
(1, 'Party Saturday night at the local brewery \'CISCO\'!!!', '2022-04-13', 43),
(2, 'Fun Kids Activities all day long!!!', '2022-04-13', 43),
(3, 'Power outage will be taking place tommorow!!!', '2022-04-13', 43);

-- --------------------------------------------------------

--
-- Структура на таблица `payment`
--

CREATE TABLE `payment` (
  `id` int(255) NOT NULL,
  `due_date` date NOT NULL,
  `status` int(255) NOT NULL,
  `amount` int(255) NOT NULL,
  `res_id` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Структура на таблица `reservations`
--

CREATE TABLE `reservations` (
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `name` varchar(255) NOT NULL,
  `id` int(255) NOT NULL,
  `payment` varchar(255) NOT NULL,
  `No_adults` int(255) NOT NULL,
  `No_children` int(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mobile` int(255) NOT NULL,
  `amount` int(255) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'unpaid',
  `user_id` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Схема на данните от таблица `reservations`
--

INSERT INTO `reservations` (`start_date`, `end_date`, `name`, `id`, `payment`, `No_adults`, `No_children`, `email`, `mobile`, `amount`, `status`, `user_id`) VALUES
('2022-04-20', '2022-04-23', 'Daniel Pavlov', 54, 'cash', 2, 1, 'danieldpavlovv@gmail.com', 651561561, 3000, 'unpaid', 43),
('2022-05-04', '2022-05-07', 'Daniel Pavlov', 57, 'check', 8, 6, 'danieldpavlovv@gmail.com', 7574645, 3000, 'unpaid', 43),
('2022-04-15', '2022-04-19', 'Daniel Pavlov', 61, 'cash', 4, 4, 'danieldpavlovv@gmail.com', 898514180, 4000, 'paid', 43),
('2022-05-18', '2022-05-20', 'Yoanna Spasova', 62, 'check', 3, 1, 'yoanna.sp.pl@gmail.com', 898514180, 2000, 'unpaid', 46),
('2022-05-26', '2022-05-30', 'Yoanna Spasova', 63, 'cash', 2, 1, 'yoanna.sp.pl@gmail.com', 2147483647, 4000, 'unpaid', 46);

-- --------------------------------------------------------

--
-- Структура на таблица `reviews`
--

CREATE TABLE `reviews` (
  `id` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `review` varchar(255) NOT NULL,
  `rating` varchar(255) NOT NULL,
  `date` varchar(255) NOT NULL,
  `is_approved` tinyint(1) NOT NULL,
  `email` varchar(255) NOT NULL,
  `user_id` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Схема на данните от таблица `reviews`
--

INSERT INTO `reviews` (`id`, `name`, `review`, `rating`, `date`, `is_approved`, `email`, `user_id`) VALUES
(70, 'Yoanna Spasova', 'My stay was incredible amazings experience. Would visit again.', '4.5', '2022.04.12', 1, '', 46),
(71, 'Valio Georgiev', 'Everything was amazing. Amazins vacation!!Would Recommend to friends!', '5', '2022.04.12', 1, '', 47),
(73, 'Daniel Pavlov', 'Everything was amazing. Amazing and spacious. The weather was bad for a couple of days but the game are zone compansated for that. Wildflowers Inn is a must visit!', '5', '2022.04.12', 1, '', 43);

-- --------------------------------------------------------

--
-- Структура на таблица `user`
--

CREATE TABLE `user` (
  `Id` int(255) NOT NULL,
  `name` varchar(30) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(30) NOT NULL,
  `role` varchar(255) DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Схема на данните от таблица `user`
--

INSERT INTO `user` (`Id`, `name`, `password`, `email`, `role`) VALUES
(43, 'Daniel Pavlov', '$2y$10$478mwviu1vlC3vEVYTSSbeVJ4aAMFy6/LWYwtYzGRbqh88teRSqB6', 'danieldpavlovv@gmail.com', 'mod'),
(44, 'Admin', '$2y$10$bNaG9lf0N4WQbGgTL5vtKuQS4/iOsm/6NRpogeoZkEMHCKSIKip3a', 'admin@test', 'admin'),
(46, 'Yoanna Spasova', '$2y$10$RKFauBDR/9TmHqfNBYtqW.kd0E.kOgEyB6X..2POA.mxsUJnjLM6O', 'yoanna.sp.pl@gmail.com', 'user'),
(47, 'Valio Georgiev', '$2y$10$12rA4A0YWSdEfoHFTdS4lu6XZSvLRk0XNXk6oyDgtrLD/aSz2xk/e', 'valio@abv.bg', 'user'),
(48, 'Ivan Karamukov', '$2y$10$aeLueytVpzgoWQxSyGeWqeycPHnVvLBbLA20dThI.lyIufOiBF7GW', 'ivan@abv.bg', 'user');

--
-- Indexes for dumped tables
--

--
-- Индекси за таблица `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Индекси за таблица `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Индекси за таблица `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `res_id` (`res_id`);

--
-- Индекси за таблица `reservations`
--
ALTER TABLE `reservations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Индекси за таблица `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_id` (`user_id`) USING BTREE;

--
-- Индекси за таблица `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`Id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reservations`
--
ALTER TABLE `reservations`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `Id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- Ограничения за дъмпнати таблици
--

--
-- Ограничения за таблица `images`
--
ALTER TABLE `images`
  ADD CONSTRAINT `images_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения за таблица `news`
--
ALTER TABLE `news`
  ADD CONSTRAINT `news_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения за таблица `payment`
--
ALTER TABLE `payment`
  ADD CONSTRAINT `payment_ibfk_1` FOREIGN KEY (`res_id`) REFERENCES `reservations` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения за таблица `reservations`
--
ALTER TABLE `reservations`
  ADD CONSTRAINT `reservations_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения за таблица `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
