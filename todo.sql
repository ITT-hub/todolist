SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;


CREATE TABLE `todo_list` (
  `id` int(6) NOT NULL,
  `uid` int(6) NOT NULL,
  `task` varchar(60) NOT NULL,
  `time_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `task_desc` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `todo_list` (`id`, `uid`, `task`, `time_date`, `task_desc`) VALUES
(1, 2, 'Задача 1', '2021-03-20 16:00:00', 'Описание'),
(2, 2, 'Задача 2', '2021-03-20 16:00:00', 'Описание 2'),
(3, 2, 'Задача 3', '2021-03-20 16:00:00', 'Описание 3'),
(4, 2, 'Задача 4', '2021-03-21 16:00:00', 'Описание 4'),
(5, 2, 'Задача 5', '2021-03-21 16:00:00', 'Описание 5'),
(6, 2, 'Задача 6', '1970-01-29 16:00:00', 'Описание 6'),
(7, 2, 'Задача 7', '1970-01-29 16:00:00', 'Описание 7'),
(8, 2, 'Задача 8', '1970-01-29 16:00:00', 'Описание 8'),
(9, 2, 'Задача 9', '1970-01-30 16:00:00', 'Описание 9'),
(10, 2, 'Задача 10', '1970-01-30 16:00:00', 'Описание 10'),
(11, 2, 'Задача 11', '1970-01-30 16:00:00', 'Описание 11'),
(12, 2, 'Задача 12', '1970-01-30 16:00:00', 'Описание 12'),
(13, 2, 'Задача 13', '1970-01-28 16:00:00', 'Описание 13');

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `login` varchar(64) NOT NULL,
  `last_name` varchar(64) NOT NULL,
  `first_name` varchar(64) NOT NULL,
  `email` varchar(64) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `users` (`id`, `login`, `last_name`, `first_name`, `email`, `password`) VALUES
(2, 'ITT-hub', 'Pokatsky', 'Alexandr', 'weabdizain@gmail.com', '$2y$10$4C0BQeJ9lX47omNNX8IbveF3kRvNL3ZrpioaL3ncupIizAySzRwwi');


ALTER TABLE `todo_list`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);


ALTER TABLE `todo_list`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
