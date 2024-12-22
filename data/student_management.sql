-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1:3306
-- Thời gian đã tạo: Th12 22, 2024 lúc 11:19 AM
-- Phiên bản máy phục vụ: 8.3.0
-- Phiên bản PHP: 8.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `student_management`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `students`
--

DROP TABLE IF EXISTS `students`;
CREATE TABLE IF NOT EXISTS `students` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` text,
  `id_stu` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `dob` text NOT NULL,
  `class` text,
  `major` text,
  `faculty` text,
  `gender` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `email` text,
  `phone` text,
  `address` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=34 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Đang đổ dữ liệu cho bảng `students`
--

INSERT INTO `students` (`id`, `name`, `id_stu`, `dob`, `class`, `major`, `faculty`, `gender`, `email`, `phone`, `address`) VALUES
(33, 'Wit2blhEMGNjdEF2SW1LS2FOZnJQZz09', 'V2FwdUpIc2h6dlB5VFVrdlhQclJGZz09', 'VWNmWGRsRHVoVVlJeUxvcytzVmdRdz09', 'S0FCWTZyeVVwYlJkbHNNTjJ1ZGhwaUx0SVhHbnZkQWsxTDdKbXlYRUhYdz0=', 'S0FCWTZyeVVwYlJkbHNNTjJ1ZGhwcW1BcTRBWVBSVFE=', 'S0FCWTZyeVVwYlI1S1BPbGhvZnFVdz09', 'R1pEUGtRMjBQVTA9', 'YjdFZENQazJuMi9qTEZvVjJmeXc1eURlZ3BnV213ZU8=', 'UVBia0l5TnZtRDAyZVo3NFMrajRmQT09', 'a3dhRFEvTVFza2IyMWY5SGg5OS94cE9FdGtSWWwwcjg='),
(32, 'b0toOHhDZGlGcFV6b0YxaFpaN21sUT09', 'V2FwdUpIc2h6dk1YeW41NUFHNm52UT09', 'VWNmWGRsRHVoVVlBa2hVRk1PNnNwdz09', 'S0FCWTZyeVVwYlF6cEVNRDRNWjQ2UHpzMk9jZDRBMTlnTFM1bnFoUjNIYz0=', 'S0FCWTZyeVVwYlF6cEVNRDRNWjQ2RytVeU0rNnh5MjA=', 'S0FCWTZyeVVwYlI1S1BPbGhvZnFVdz09', 'R1pEUGtRMjBQVTA9', 'WHpvU2w4eTVhUlRmUDRIS2N3b0NSQzhhMTV3Y0pQejA=', 'T2RodWw2akRpNldQTkFzTnZZYTgxZz09', 'a3dhRFEvTVFza2IyMWY5SGg5OS94cE9FdGtSWWwwcjg=');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `username`, `password`) VALUES
(1, 'admin', '$2y$10$afyvfgMQ1teXGYVdNIf/1u0oMZKwvPxNCQyOA27SZzkIzP4.umuLG'),
(5, 'dtvu', '$2y$10$RgUZC7oAsst0VsI0gmqRc.KI04YIcjD8cBnnTLs1cUXdKayuu078i');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
