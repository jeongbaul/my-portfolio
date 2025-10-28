-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- 생성 시간: 25-10-28 15:37
-- 서버 버전: 10.4.32-MariaDB
-- PHP 버전: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 데이터베이스: `portfolio`
--

-- --------------------------------------------------------

--
-- 테이블 구조 `users`
--

CREATE TABLE `users` (
  `no` int(11) NOT NULL,
  `id` varchar(50) NOT NULL,
  `pw` varchar(255) NOT NULL,
  `name` varchar(50) NOT NULL,
  `level` tinyint(4) NOT NULL DEFAULT 2,
  `regdate` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 테이블의 덤프 데이터 `users`
--

INSERT INTO `users` (`no`, `id`, `pw`, `name`, `level`, `regdate`) VALUES
(1, 'ss', '$2y$10$0Xbqvr7ikpm/BYDaw.rTD.iMQilO7SR3w4hsNLSGa.4KMRUTWgdmy', 'ss', 2, '2025-10-28 17:38:13'),
(3, 'ㅁㅁ', '$2y$10$3u/4RyYAJggrCXgue18KRe4.aStgD238PfH6hDqJ3jenNb6ubZIRW', 'ㅁㅁ', 2, '2025-10-28 17:40:32'),
(4, '정바울', '$2y$10$iy./V4czShYkket8Rt.NxuC7nNMr.9VquUDJIHwY0AXHZdHJqfiQO', '정바울', 1, '2025-10-28 17:57:57');

--
-- 덤프된 테이블의 인덱스
--

--
-- 테이블의 인덱스 `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`no`),
  ADD UNIQUE KEY `id` (`id`);

--
-- 덤프된 테이블의 AUTO_INCREMENT
--

--
-- 테이블의 AUTO_INCREMENT `users`
--
ALTER TABLE `users`
  MODIFY `no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
