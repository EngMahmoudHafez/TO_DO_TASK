-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 185.27.134.10
-- Generation Time: Oct 15, 2022 at 02:09 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `epiz_32796326_online_me`
--

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE `tasks` (
  `id` int(11) NOT NULL,
  `text` text NOT NULL,
  `user_id` int(11) NOT NULL,
  `create_date` datetime NOT NULL DEFAULT current_timestamp(),
  `start_date` datetime NOT NULL,
  `end_date` datetime NOT NULL,
  `checked` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`id`, `text`, `user_id`, `create_date`, `start_date`, `end_date`, `checked`) VALUES
(6, 'hello bro', 1, '2022-10-09 21:07:16', '2022-10-10 00:00:00', '2022-10-19 00:00:00', 1),
(13, 'ieee tasks done ', 11, '2022-10-15 12:46:35', '2022-10-01 12:46:00', '2022-10-15 12:46:00', 1),
(14, 'study ps to join dsdlfjfs', 11, '2022-10-15 12:48:47', '2022-10-28 12:47:00', '2022-10-31 12:48:00', 0),
(15, 'study arabic and e', 3, '2022-10-15 13:14:04', '2022-10-15 13:13:00', '2022-10-15 17:13:00', 0);

-- --------------------------------------------------------

--
-- Stand-in structure for view `usee_tasks`
-- (See below for the actual view)
--
CREATE TABLE `usee_tasks` (
`id` int(11)
,`Name` varchar(100)
,`tasks_num` bigint(21)
,`done` decimal(25,0)
);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `Name` varchar(100) NOT NULL,
  `age` int(11) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `Name`, `age`, `phone`, `email`, `password`) VALUES
(1, 'mahmoud', 20, '01054254254', 'mahmoud@me.com', '8cb2237d0679ca88db6464eac60da96345513964'),
(3, 'asmaa', 9, '0105487454', 'Asmaa@1.com', '8cb2237d0679ca88db6464eac60da96345513964'),
(5, 'mego', 22, '01064065456', 'mego@me.com', '8cb2237d0679ca88db6464eac60da96345513964'),
(10, 'nora', 39, '01025142152', 'nora@n.con', '8cb2237d0679ca88db6464eac60da96345513964'),
(11, 'mostafa', 22, '01068063536', 'mostafa@1.com', '8cb2237d0679ca88db6464eac60da96345513964'),
(12, 'asmaa', 11, '010623054', 'asmaa@1.com', '8cb2237d0679ca88db6464eac60da96345513964');

-- --------------------------------------------------------

--
-- Structure for view `usee_tasks`
--
DROP TABLE IF EXISTS `usee_tasks`;

CREATE ALGORITHM=UNDEFINED DEFINER=`epiz_32796326`@`sql305.epizy.com` SQL SECURITY DEFINER VIEW `usee_tasks`  AS SELECT `users`.`id` AS `id`, `users`.`Name` AS `Name`, count(`tasks`.`user_id`) AS `tasks_num`, sum(`tasks`.`checked`) AS `done` FROM (`users` left join `tasks` on(`users`.`id` = `tasks`.`user_id`)) GROUP BY `users`.`Name` ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tasks`
--
ALTER TABLE `tasks`
  ADD CONSTRAINT `tasks_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
