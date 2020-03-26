-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 26, 2020 at 04:33 AM
-- Server version: 5.7.29
-- PHP Version: 7.1.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `icecube`
--

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(32) NOT NULL,
  `message` varchar(1028) CHARACTER SET utf8mb4 NOT NULL,
  `school` varchar(16) CHARACTER SET utf8mb4 NOT NULL,
  `userID` int(32) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `message`, `school`, `userID`, `date_created`) VALUES
(3, 'Quarantine yourself to avoid cross contamination.', 'csuf', 2, '2020-03-24 21:30:03'),
(4, 'The virtual session of classes are such a mess', 'csuf', 1, '2020-03-24 21:48:24'),
(7, 'Please wash your hands for more than 20 seconds.', 'csuf', 0, '2020-03-24 23:21:07'),
(8, 'Keep social distance away from others.', 'csuf', 0, '2020-03-24 23:23:14'),
(9, 'Sneeze into your elbows.', 'csuf', 0, '2020-03-24 23:25:04'),
(10, 'Don\'t go out if you don\'t feel good.', 'csuf', 3, '2020-03-24 23:33:12'),
(11, 'Try to avoid touching your face.', 'csuf', 4, '2020-03-24 23:34:03'),
(12, 'Stay home if not emergeny.', 'csuf', 4, '2020-03-24 23:41:54'),
(14, 'Please wash your hands for more than 20 seconds with hand soap.', '', 4, '2020-03-24 23:48:34'),
(15, 'Please wash your hands for more than 20 seconds with hand soap frequently if possible.', 'cpp', 3, '2020-03-25 00:14:48'),
(17, 'Please do not touch face without washing your hand with soap.', 'fullcoll', 4, '2020-03-25 03:28:04'),
(18, 'Try to exercise and eat healthy.', 'csuf', 5, '2020-03-25 04:05:45'),
(19, 'PHP is very fun and enjoyable.', 'occ', 7, '2020-03-25 15:11:04'),
(20, 'The person staying home can\'t stop eating.\r\nThe person loves eating rice.', 'cpp', 8, '2020-03-25 15:40:14'),
(21, 'Why is time moving so fast?', 'cpp', 8, '2020-03-25 15:57:17'),
(22, 'I want to go back to school.', 'csuf', 9, '2020-03-25 16:29:22');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) CHARACTER SET utf8mb4 NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `school` varchar(255) CHARACTER SET utf8mb4 NOT NULL,
  `avatar` varchar(16) CHARACTER SET utf8mb4 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `created_at`, `school`, `avatar`) VALUES
(2, 'test_user2', '$2y$10$/UtGTa07ZVGws9gr4.X5AeTRjrUUsvnyHlRAJNXx9ORiGc5RUC.6y', 'testUser2@csu.fullerton.edu', '2020-03-24 16:25:17', 'csuf', 'avatar1'),
(3, '349_user', '$2y$10$Dao.VhzeYljwr9u9cWXFOeuGa6M8HSaQodiVA3grYJVkPCCgkgLxe', '349user@fullcoll.edu', '2020-03-24 22:28:25', 'cpp', 'avatar2'),
(4, 'testacct', '$2y$10$9MVqqywiNrr5jHhvCi.YM.hHdvQ.CvzFCbjmUtfzCnjBZSF55wvZa', 'testacct12@fullcoll.edu', '2020-03-24 23:20:46', 'fullcoll', 'avatar3'),
(5, 'ywen1306', '$2y$10$N2vXi4DPLxuUz3sc71lEQOKBd4lXFXVkCJQ6mIqj/3wMzX6dWfDvO', 'ywen1306@csu.fullerton.edu', '2020-03-25 03:29:34', 'csuf', 'avatar2'),
(6, 'icecube_test', '$2y$10$ddY1o9SodvtZzle5gsjno.QeE1ofygd407Gxe8Qz8ie5ZRM5NtJi.', 'icecube_test@student.cccd.edu', '2020-03-25 14:46:53', 'occ', 'avatar1'),
(7, 'icecube_test2', '$2y$10$S6lYk9TKMHmqFjRnuaiTru7HbBL50cahinMzMjArllmyO4N1oeSuy', 'icecube_test2@student.cccd.edu', '2020-03-25 15:07:55', 'occ', 'avatar1'),
(8, 'icecube_test8', '$2y$10$Z2KqlZrcHu.iku529vxVW.Nw5ZMiL2DtA0vNYeqbDBBPiUd8fkhwu', 'icecube_test21@student.cccd.edu', '2020-03-25 15:36:57', 'cpp', 'avatar1'),
(9, 'testuser', '$2y$10$l6L2aCrKAyjvurILuvnXA.zlM9RHgtHEyFDItxuKP6AL.Sr4ObGb2', 'test@csu.fullerton.edu', '2020-03-25 16:26:37', 'csuf', 'avatar1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(32) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
