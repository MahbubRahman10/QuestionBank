-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 16, 2018 at 10:24 PM
-- Server version: 10.1.26-MariaDB
-- PHP Version: 7.0.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `question`
--

-- --------------------------------------------------------

--
-- Table structure for table `adminchats`
--

CREATE TABLE `adminchats` (
  `id` int(10) UNSIGNED NOT NULL,
  `sender_id` int(11) NOT NULL,
  `sender_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `destination_id` int(11) NOT NULL,
  `message` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `adminchats`
--

INSERT INTO `adminchats` (`id`, `sender_id`, `sender_name`, `destination_id`, `message`, `created_at`, `updated_at`) VALUES
(59, 1, 'cse', 2, 'Hlw', '2017-12-05 15:20:31', '2017-12-05 15:20:31'),
(60, 2, 'cse', 1, 'kita kobor', '2017-12-05 15:20:46', '2017-12-05 15:20:46'),
(61, 1, 'cse', 2, 'kobor to vala', '2017-12-05 15:21:02', '2017-12-05 15:21:02'),
(62, 1, 'cse', 2, 'tumar', '2017-12-05 15:21:19', '2017-12-05 15:21:19'),
(63, 1, 'cse', 2, 'cs', '2017-12-05 15:22:01', '2017-12-05 15:22:01'),
(64, 1, 'cse', 2, 'ni', '2017-12-05 15:22:14', '2017-12-05 15:22:14'),
(65, 1, 'cse', 2, 'nope', '2017-12-05 15:23:12', '2017-12-05 15:23:12'),
(66, 5, 'cse', 2, 'csvcs', '2017-12-07 13:29:17', '2017-12-07 13:29:17'),
(67, 1, 'cse', 2, 'csc', '2017-12-08 07:31:26', '2017-12-08 07:31:26'),
(68, 1, 'cse', 2, 'cs', '2017-12-08 07:31:52', '2017-12-08 07:31:52'),
(69, 1, 'cse', 2, 'Hello', '2017-12-09 12:28:06', '2017-12-09 12:28:06'),
(70, 1, 'cse', 5, 'ko', '2017-12-09 12:28:36', '2017-12-09 12:28:36'),
(71, 5, 'cse', 1, 'oy', '2017-12-09 12:28:41', '2017-12-09 12:28:41'),
(72, 1, 'cse', 5, 'tumi ni', '2017-12-09 12:28:48', '2017-12-09 12:28:48'),
(73, 5, 'cse', 1, 'oy', '2017-12-09 12:28:51', '2017-12-09 12:28:51'),
(74, 1, 'cse', 5, 'ami', '2017-12-09 12:28:56', '2017-12-09 12:28:56'),
(75, 5, 'cse', 1, 'oh', '2017-12-09 12:29:34', '2017-12-09 12:29:34'),
(76, 2, 'cse', 1, 'css', '2018-01-03 13:44:22', '2018-01-03 13:44:22'),
(77, 1, 'cse', 2, 'ok', '2018-01-03 14:02:51', '2018-01-03 14:02:51'),
(78, 1, 'cse', 2, 'Hello Sir', '2018-01-13 13:00:07', '2018-01-13 13:00:07'),
(79, 1, 'cse', 5, 'cscsc', '2018-01-13 13:12:53', '2018-01-13 13:12:53'),
(80, 1, 'cse', 2, 'Hi', '2018-01-13 13:13:19', '2018-01-13 13:13:19'),
(81, 2, 'cse', 1, 'Hay man', '2018-01-13 13:13:26', '2018-01-13 13:13:26');

-- --------------------------------------------------------

--
-- Table structure for table `boards`
--

CREATE TABLE `boards` (
  `id` int(10) UNSIGNED NOT NULL,
  `board_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `boards`
--

INSERT INTO `boards` (`id`, `board_name`, `created_at`, `updated_at`) VALUES
(1, 'Dhaka Board', '2018-01-01 19:44:21', '2018-01-01 19:44:21'),
(2, 'Chittagong Board', '2018-01-01 19:44:21', '2018-01-01 19:44:21'),
(3, 'Comilla Board', '2018-01-01 19:44:31', '2018-01-01 19:44:31'),
(4, 'Sylhet Board', '2018-01-01 19:44:46', '2018-01-01 19:44:46'),
(5, 'Rajshahi Board', '2018-01-01 19:44:46', '2018-01-01 19:44:46'),
(6, 'Jessore Board', '2018-01-01 19:45:00', '2018-01-01 19:45:00'),
(7, 'Dinajpur Board', '2018-01-01 19:45:00', '2018-01-01 19:45:00'),
(8, 'Barisal Board', '2018-01-01 19:45:07', '2018-01-01 19:45:07'),
(9, 'Madrasah Board', '2018-01-01 19:45:32', '2018-01-01 19:45:32');

-- --------------------------------------------------------

--
-- Table structure for table `board_examinations`
--

CREATE TABLE `board_examinations` (
  `id` int(10) UNSIGNED NOT NULL,
  `board_id` int(10) UNSIGNED NOT NULL,
  `examination_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `board_examinations`
--

INSERT INTO `board_examinations` (`id`, `board_id`, `examination_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '2018-01-02 17:03:38', '2018-01-02 17:03:38'),
(2, 1, 2, '2018-01-02 17:03:47', '2018-01-02 17:03:47'),
(3, 1, 3, '2018-01-02 17:03:53', '2018-01-02 17:03:53'),
(4, 9, 4, '2018-01-03 07:20:10', '2018-01-03 07:20:10'),
(5, 9, 5, '2018-01-03 07:20:10', '2018-01-03 07:20:10'),
(6, 9, 6, '2018-01-03 07:20:17', '2018-01-03 07:20:17'),
(7, 4, 1, '2018-01-03 18:47:57', '2018-01-03 18:47:57'),
(8, 4, 2, '2018-01-03 18:47:57', '2018-01-03 18:47:57'),
(9, 4, 3, '2018-01-03 18:48:03', '2018-01-03 18:48:03');

-- --------------------------------------------------------

--
-- Table structure for table `board_exam_questions`
--

CREATE TABLE `board_exam_questions` (
  `id` int(10) UNSIGNED NOT NULL,
  `examination_id` int(10) UNSIGNED NOT NULL,
  `subject_id` int(10) UNSIGNED NOT NULL,
  `section_id` int(10) UNSIGNED NOT NULL,
  `mcq_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `question_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `c1` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `c2` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `c3` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `option_no_1` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `option_no_2` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `option_no_3` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `option_no_4` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `correct_answer` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `board_exam_questions`
--

INSERT INTO `board_exam_questions` (`id`, `examination_id`, `subject_id`, `section_id`, `mcq_type`, `question_name`, `c1`, `c2`, `c3`, `option_no_1`, `option_no_2`, `option_no_3`, `option_no_4`, `correct_answer`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 44, '1', 'TEST2', NULL, NULL, NULL, 'ca', 'ca', 'ca', 'ca', 'ca', '2018-01-15 13:34:08', '2018-01-15 14:03:15'),
(3, 1, 1, 44, '1', 'TEST1', NULL, NULL, NULL, 'ca', 'ca', 'ca', 'ca', 'ca', '2018-01-15 13:53:36', '2018-01-15 14:03:20');

-- --------------------------------------------------------

--
-- Table structure for table `board_questions`
--

CREATE TABLE `board_questions` (
  `id` int(10) UNSIGNED NOT NULL,
  `board_examinations_id` int(10) UNSIGNED NOT NULL,
  `subject_id` int(11) UNSIGNED NOT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `question` longblob NOT NULL,
  `year` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `board_questions`
--

INSERT INTO `board_questions` (`id`, `board_examinations_id`, `subject_id`, `type`, `question`, `year`, `created_at`, `updated_at`) VALUES
(29, 1, 1, 'MCQ', 0x78636a68685a34536b4e4e7238444a782e706466, '16', '2018-01-05 12:11:07', '2018-01-05 12:11:07'),
(33, 1, 1, 'Creative', 0xe0a6ace0a6bee0a682e0a6b2e0a6be20e0a6b8e0a783e0a69ce0a6a8e0a6b6e0a780e0a6b2202d20323031372e706466, '2017', '2018-01-19 14:58:23', '2018-01-19 14:58:23');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `category_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `category_name`, `created_at`, `updated_at`) VALUES
(1, 'cscscc', '2018-02-11 20:21:24', '2018-02-13 21:12:54'),
(2, 'Mobile', '2018-02-11 20:21:35', '2018-02-11 20:21:35'),
(4, 'কম্পিউটার', '2018-02-13 21:07:24', '2018-02-13 21:14:25');

-- --------------------------------------------------------

--
-- Table structure for table `classes`
--

CREATE TABLE `classes` (
  `id` int(10) UNSIGNED NOT NULL,
  `class` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `classes`
--

INSERT INTO `classes` (`id`, `class`, `type`, `created_at`, `updated_at`) VALUES
(1, '৬ষ্ঠ', 'school', '2017-12-11 11:14:09', '2017-12-11 11:14:09'),
(2, '৭ম', 'school', '2017-12-11 11:14:09', '2017-12-11 11:14:09'),
(3, '৮ম', 'school', '2017-12-11 11:14:22', '2017-12-11 11:14:22'),
(4, '৯-১০ম', 'school', '2017-12-11 11:14:22', '2017-12-11 11:14:22'),
(5, '১১-১২তম', 'school', '2017-12-11 11:14:30', '2017-12-11 11:14:30'),
(6, '৬ষ্ঠ', 'madrasha', '2017-12-19 12:20:04', '2017-12-19 12:20:04'),
(7, '৭ম', 'madrasha', '2017-12-19 12:20:04', '2017-12-19 12:20:04'),
(8, '৮ম', 'madrasha', '2017-12-19 12:20:18', '2017-12-19 12:20:18'),
(9, '৯-১০ম', 'madrasha', '2017-12-19 12:20:18', '2017-12-19 12:20:18'),
(10, '১১-১২তম', 'madrasha', '2017-12-19 12:20:25', '2017-12-19 12:20:25'),
(11, 'BCS', NULL, '2018-02-01 08:47:37', '2018-02-01 08:47:37'),
(12, 'NTRCA', NULL, '2018-02-01 08:47:37', '2018-02-01 08:47:37'),
(13, 'DPE', NULL, '2018-02-01 08:47:53', '2018-02-01 08:47:53'),
(14, 'BANK', NULL, '2018-02-01 08:47:53', '2018-02-01 08:47:53'),
(15, 'Normal', 'university', '2018-02-07 20:06:14', '2018-02-07 20:06:14'),
(16, 'Engineering', 'university', '2018-02-07 20:11:17', '2018-02-07 20:11:17'),
(17, 'Technology', 'university', '2018-02-07 20:11:17', '2018-02-07 20:11:17'),
(18, 'Agriculture', 'university', '2018-02-07 20:11:47', '2018-02-07 20:11:47');

-- --------------------------------------------------------

--
-- Table structure for table `classsubject`
--

CREATE TABLE `classsubject` (
  `id` int(10) UNSIGNED NOT NULL,
  `class_id` int(10) UNSIGNED NOT NULL,
  `subject_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `classsubject`
--

INSERT INTO `classsubject` (`id`, `class_id`, `subject_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '2017-12-11 11:35:18', '2017-12-11 11:35:18'),
(2, 1, 2, '2017-12-11 11:35:56', '2017-12-11 11:35:56'),
(3, 1, 3, '2017-12-11 11:35:56', '2017-12-11 11:35:56'),
(4, 1, 4, '2017-12-11 11:36:15', '2017-12-11 11:36:15'),
(5, 1, 5, '2017-12-11 11:36:15', '2017-12-11 11:36:15'),
(6, 1, 6, '2017-12-11 11:36:51', '2017-12-11 11:36:51'),
(7, 1, 8, '2017-12-11 11:36:51', '2017-12-11 11:36:51'),
(8, 1, 7, '2017-12-11 11:37:25', '2017-12-11 11:37:25'),
(9, 2, 1, '2017-12-13 10:47:28', '2017-12-13 10:47:28'),
(10, 2, 2, '2017-12-13 10:47:28', '2017-12-13 10:47:28'),
(11, 5, 1, '2017-12-19 12:09:32', '2017-12-19 12:09:32'),
(13, 3, 1, '2018-01-01 19:42:11', '2018-01-01 19:42:11'),
(15, 2, 3, '2018-01-30 21:27:21', '2018-01-30 21:27:21'),
(16, 2, 4, '2018-01-30 21:27:48', '2018-01-30 21:27:48'),
(17, 2, 5, '2018-01-30 21:27:48', '2018-01-30 21:27:48'),
(18, 2, 6, '2018-01-30 21:28:07', '2018-01-30 21:28:07'),
(19, 2, 8, '2018-01-30 21:28:07', '2018-01-30 21:28:07'),
(20, 2, 7, '2018-01-30 21:28:18', '2018-01-30 21:28:18'),
(21, 3, 2, '2018-01-30 21:28:46', '2018-01-30 21:28:46'),
(22, 3, 3, '2018-01-30 21:30:17', '2018-01-30 21:30:17'),
(23, 3, 4, '2018-01-30 21:30:17', '2018-01-30 21:30:17'),
(24, 3, 5, '2018-01-30 21:30:31', '2018-01-30 21:30:31'),
(25, 3, 6, '2018-01-30 21:30:31', '2018-01-30 21:30:31'),
(26, 3, 8, '2018-01-30 21:30:56', '2018-01-30 21:30:56'),
(27, 3, 7, '2018-01-30 21:30:56', '2018-01-30 21:30:56'),
(28, 4, 1, '2018-01-30 21:31:49', '2018-01-30 21:31:49'),
(29, 4, 2, '2018-01-30 21:31:49', '2018-01-30 21:31:49'),
(30, 4, 3, '2018-01-30 21:32:26', '2018-01-30 21:32:26'),
(31, 4, 4, '2018-01-30 21:32:26', '2018-01-30 21:32:26'),
(32, 4, 5, '2018-01-30 21:32:49', '2018-01-30 21:32:49'),
(33, 4, 6, '2018-01-30 21:32:49', '2018-01-30 21:32:49'),
(34, 4, 8, '2018-01-30 21:33:08', '2018-01-30 21:33:08'),
(35, 4, 7, '2018-01-30 21:33:08', '2018-01-30 21:33:08'),
(36, 4, 9, '2018-01-30 21:33:51', '2018-01-30 21:33:51'),
(37, 4, 11, '2018-01-30 21:33:51', '2018-01-30 21:33:51'),
(38, 4, 10, '2018-01-30 21:34:07', '2018-01-30 21:34:07'),
(39, 4, 12, '2018-01-30 21:34:34', '2018-01-30 21:34:34'),
(40, 4, 13, '2018-01-30 21:35:46', '2018-01-30 21:35:46'),
(41, 4, 14, '2018-01-30 21:35:46', '2018-01-30 21:35:46'),
(42, 4, 15, '2018-01-30 21:36:05', '2018-01-30 21:36:05'),
(43, 4, 18, '2018-01-30 21:36:05', '2018-01-30 21:36:05'),
(44, 4, 19, '2018-01-30 21:37:35', '2018-01-30 21:37:35'),
(45, 4, 20, '2018-01-30 21:37:35', '2018-01-30 21:37:35'),
(46, 4, 23, '2018-01-30 21:38:07', '2018-01-30 21:38:07'),
(47, 6, 1, '2018-01-31 08:42:01', '2018-01-31 08:42:01'),
(48, 6, 2, '2018-01-31 08:42:01', '2018-01-31 08:42:01'),
(49, 6, 24, '2018-01-31 08:42:45', '2018-01-31 08:42:45'),
(50, 6, 25, '2018-01-31 08:42:45', '2018-01-31 08:42:45'),
(51, 6, 3, '2018-01-31 08:43:13', '2018-01-31 08:43:13'),
(52, 6, 4, '2018-01-31 08:43:13', '2018-01-31 08:43:13'),
(53, 7, 1, '2018-01-31 08:44:52', '2018-01-31 08:44:52'),
(54, 7, 2, '2018-01-31 08:44:52', '2018-01-31 08:44:52'),
(55, 7, 24, '2018-01-31 08:45:08', '2018-01-31 08:45:08'),
(56, 7, 25, '2018-01-31 08:45:08', '2018-01-31 08:45:08'),
(57, 7, 3, '2018-01-31 08:45:30', '2018-01-31 08:45:30'),
(58, 7, 4, '2018-01-31 08:45:30', '2018-01-31 08:45:30'),
(59, 8, 1, '2018-01-31 08:46:30', '2018-01-31 08:46:30'),
(60, 8, 2, '2018-01-31 08:46:30', '2018-01-31 08:46:30'),
(61, 8, 24, '2018-01-31 08:46:41', '2018-01-31 08:46:41'),
(62, 8, 25, '2018-01-31 08:46:41', '2018-01-31 08:46:41'),
(63, 8, 3, '2018-01-31 08:47:00', '2018-01-31 08:47:00'),
(64, 8, 4, '2018-01-31 08:47:00', '2018-01-31 08:47:00'),
(65, 9, 1, '2018-01-31 08:47:33', '2018-01-31 08:47:33'),
(66, 9, 2, '2018-01-31 08:47:33', '2018-01-31 08:47:33'),
(67, 9, 24, '2018-01-31 08:48:56', '2018-01-31 08:48:56'),
(68, 9, 26, '2018-01-31 08:48:56', '2018-01-31 08:48:56'),
(69, 9, 28, '2018-01-31 08:49:24', '2018-01-31 08:49:24'),
(70, 9, 27, '2018-01-31 08:49:24', '2018-01-31 08:49:24'),
(71, 9, 3, '2018-01-31 08:50:19', '2018-01-31 08:50:19'),
(72, 9, 9, '2018-01-31 08:50:19', '2018-01-31 08:50:19'),
(73, 9, 11, '2018-01-31 08:50:34', '2018-01-31 08:50:34'),
(74, 9, 10, '2018-01-31 08:50:34', '2018-01-31 08:50:34'),
(75, 9, 12, '2018-01-31 08:51:29', '2018-01-31 08:51:29'),
(76, 9, 18, '2018-01-31 08:51:29', '2018-01-31 08:51:29'),
(77, 11, 29, '2018-02-01 08:54:24', '2018-02-01 08:54:24'),
(78, 11, 30, '2018-02-01 08:54:24', '2018-02-01 08:54:24'),
(79, 11, 31, '2018-02-01 08:54:41', '2018-02-01 08:54:41'),
(80, 11, 32, '2018-02-01 08:54:41', '2018-02-01 08:54:41'),
(81, 11, 33, '2018-02-01 08:54:50', '2018-02-01 08:54:50'),
(82, 11, 34, '2018-02-01 08:56:02', '2018-02-01 08:56:02'),
(83, 11, 35, '2018-02-01 08:56:02', '2018-02-01 08:56:02'),
(84, 11, 36, '2018-02-01 08:56:19', '2018-02-01 08:56:19'),
(85, 11, 37, '2018-02-01 08:56:19', '2018-02-01 08:56:19'),
(86, 11, 38, '2018-02-01 08:56:27', '2018-02-01 08:56:27'),
(87, 12, 1, '2018-02-01 11:04:57', '2018-02-01 11:04:57'),
(88, 12, 39, '2018-02-01 11:04:57', '2018-02-01 11:04:57'),
(89, 12, 40, '2018-02-01 11:05:30', '2018-02-01 11:05:30'),
(90, 12, 41, '2018-02-01 11:05:30', '2018-02-01 11:05:30'),
(91, 13, 1, '2018-02-01 11:06:42', '2018-02-01 11:06:42'),
(92, 13, 39, '2018-02-01 11:06:42', '2018-02-01 11:06:42'),
(93, 13, 40, '2018-02-01 11:07:17', '2018-02-01 11:07:17'),
(94, 13, 4, '2018-02-01 11:07:17', '2018-02-01 11:07:17'),
(95, 13, 41, '2018-02-01 11:07:33', '2018-02-01 11:07:33'),
(96, 14, 1, '2018-02-01 11:09:37', '2018-02-01 11:09:37'),
(97, 14, 39, '2018-02-01 11:09:37', '2018-02-01 11:09:37'),
(98, 14, 40, '2018-02-01 11:10:35', '2018-02-01 11:10:35'),
(99, 14, 4, '2018-02-01 11:10:35', '2018-02-01 11:10:35'),
(102, 14, 41, '2018-02-01 11:11:07', '2018-02-01 11:11:07'),
(103, 14, 43, '2018-02-01 11:11:07', '2018-02-01 11:11:07'),
(104, 14, 35, '2018-02-01 11:11:30', '2018-02-01 11:11:30'),
(105, 14, 42, '2018-02-01 11:11:30', '2018-02-01 11:11:30'),
(106, 15, 1, '2018-02-07 20:37:28', '2018-02-07 20:37:28'),
(107, 15, 39, '2018-02-08 12:47:25', '2018-02-08 12:47:25'),
(108, 15, 41, '2018-02-08 12:47:25', '2018-02-08 12:47:25'),
(109, 15, 9, '2018-02-08 12:47:55', '2018-02-08 12:47:55'),
(110, 15, 10, '2018-02-08 12:47:55', '2018-02-08 12:47:55'),
(111, 15, 11, '2018-02-08 12:48:24', '2018-02-08 12:48:24'),
(112, 15, 2, '2018-02-08 12:48:24', '2018-02-08 12:48:24'),
(113, 15, 19, '2018-02-08 12:49:36', '2018-02-08 12:49:36'),
(114, 15, 20, '2018-02-08 12:49:36', '2018-02-08 12:49:36'),
(115, 15, 23, '2018-02-08 12:49:52', '2018-02-08 12:49:52'),
(116, 16, 1, '2018-02-08 12:50:31', '2018-02-08 12:50:31'),
(117, 16, 39, '2018-02-08 12:50:31', '2018-02-08 12:50:31'),
(118, 16, 41, '2018-02-08 12:50:55', '2018-02-08 12:50:55'),
(119, 16, 9, '2018-02-08 12:50:55', '2018-02-08 12:50:55'),
(120, 16, 10, '2018-02-08 12:51:17', '2018-02-08 12:51:17'),
(121, 16, 11, '2018-02-08 12:51:17', '2018-02-08 12:51:17'),
(122, 16, 2, '2018-02-08 12:51:27', '2018-02-08 12:51:27'),
(123, 18, 1, '2018-02-08 12:55:11', '2018-02-08 12:55:11'),
(124, 18, 41, '2018-02-08 12:55:11', '2018-02-08 12:55:11'),
(125, 18, 39, '2018-02-08 12:55:30', '2018-02-08 12:55:30'),
(126, 18, 9, '2018-02-08 12:55:30', '2018-02-08 12:55:30'),
(127, 18, 10, '2018-02-08 12:55:44', '2018-02-08 12:55:44'),
(128, 18, 11, '2018-02-08 12:55:44', '2018-02-08 12:55:44'),
(129, 18, 2, '2018-02-08 12:55:56', '2018-02-08 12:55:56');

-- --------------------------------------------------------

--
-- Table structure for table `creative_questions`
--

CREATE TABLE `creative_questions` (
  `id` int(10) UNSIGNED NOT NULL,
  `question_name` varchar(1910) COLLATE utf8mb4_unicode_ci NOT NULL,
  `question_image` varchar(2550) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `classsubject_id` int(10) UNSIGNED NOT NULL,
  `section_id` int(11) UNSIGNED NOT NULL,
  `question_no_1` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `question_no_2` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `question_no_3` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `question_no_4` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `creative_questions`
--

INSERT INTO `creative_questions` (`id`, `question_name`, `question_image`, `classsubject_id`, `section_id`, `question_no_1`, `question_no_2`, `question_no_3`, `question_no_4`, `created_at`, `updated_at`) VALUES
(16, '#FFAD33', NULL, 1, 10, '#FFAD33', '#FFAD33', '#FFAD33', '#FFAD33', '2017-12-11 16:44:33', '2017-12-11 16:44:33'),
(17, 'c', NULL, 1, 9, 'c', 'c', 'c', 'c', '2017-12-11 16:46:16', '2017-12-11 16:46:16'),
(18, 'c', NULL, 1, 7, 'csc', 'csc', 'c', 'c', '2017-12-11 16:47:33', '2017-12-12 13:24:16'),
(22, 'v', NULL, 1, 9, 'v', 'v', 'v', 'v', '2017-12-12 10:44:27', '2017-12-12 10:44:27'),
(23, 'somaj', NULL, 3, 27, 'somaj', 'somaj', 'somaj', 'somaj', '2017-12-12 12:19:06', '2017-12-12 12:19:06'),
(25, 'sel', NULL, 3, 26, 'sel', 'sel', 'sel', 'sel', '2017-12-12 13:32:58', '2017-12-12 13:32:58'),
(40, 'কালাম, আবুল ও হাফিজ একই গ্রামে বাস করে। তাদের অবস্থা তেমন ভালো নয়। কোন মতে দিন অতিবাহিত করে। হাজী মকবুল সাহেব তার যাকাতের টাকা দিয়ে আবুলকে একটি রিক্সা, কালামকে একটি ভ্যানগাড়ি আর হাফিজকে একটি সেলাই মেশিন কিনে দিলেন। আর বললেন, তোমরা পরিশ্রম করে খাও আর তোমাদের সাধ্যমত গরিব মানুষের উপকার কর। কিছুদিন পর হাজী সাহেব তাদের পরীক্ষা করার জন্য এক ভিক্ষুককে পাঠালেন তাদের কাছে সাহায্য চাইতে। আবুল আর কালাম কোন সাহায্যই করল না। কিন্তু হাফিজ বিনে পয়সায় ভিক্ষুকের জামাটি সেলাই করে দিল।', NULL, 1, 2, 'স্বর্গীয় দূত কতজন ইহুদিকে পরীক্ষা করেছিলেন?', 'স্বর্গীয় দূত মানুষের ছদ্মবেশ ধারণ করেছিলেন কেন?', 'কালাম ও আবুলের কাজের মাঝে ‘সততার পুরষ্কার’ গল্পের যে দিকটি প্রতিফলিত হয়েছে তা ব্যাখ্যা কর।', '‘হাফিজের কাজের মধ্যেই ‘সততার পুরষ্কার’ গল্পের মুল শিক্ষা নিহিত’ – কথাটি বিশ্লেষণ কর।', '2018-02-09 21:11:13', '2018-02-09 21:11:13'),
(41, 'বন্যা সারা সকাল মিসেস সালমার বাসায় কাজ করে, তাকে খালাম্মা বলে ডাকে। সে মিসেস সালমার যাবতীয় কাজে সাহায্য করার চেষ্টা করে। দিবা শাখার একটি স্কুলেও সে পড়ে। পড়ালেখায় সে পিছিয়ে নেই। শুধু প্রকৃতির কোন কিছুর সঙ্গে তার সখ্য গড়ে ওঠে নি; সে সময়ই বা তার কোথায়? তার নিজের জীবন আর কাজ নিয়েই সে ব্যস্ত। প্রকৃতিতে নয়, নিজের কাজেই সে শান্তি খুঁজে পায়। বন্যা তার কাজ দিয়ে, কথা দিয়ে মিসেস সালমাকে এমন করে নিয়েছে যে মিসেস সালমাও বন্যাকে পরিবারের অন্য সদস্যের মতোই মনে করে।', NULL, 1, 5, 'মিনু কার বাড়িতে থাকত?', 'ষষ্ঠ ইন্দ্রিয় বলতে কী বোঝানো হয়েছে?', 'অবস্থানগতদিক দিয়ে উদ্দীপকের বন্যা ও মিনুর মধ্যে যে বৈসাদৃশ্য লক্ষ করা যায় – তা ব্যাখ্যা কর।', '‘বন্যার শিক্ষা ছিল প্রাতিষ্ঠানিক, আর প্রকৃতি হচ্ছে মিনুর পাঠশালা’ কথাটি বিশ্লেষণ কর।', '2018-02-09 21:12:25', '2018-02-09 21:12:25'),
(42, 'পল্লিপ্রকৃতির কোলে বেরে ওঠা বিধবা মায়ের ডানপিটে সন্তান ফটিক। নতুনের আকর্ষণে সে চলে আসে কলকাতার মামার বাড়িতে। কিন্তু মামি তাকে মোটেও আপন করে নিতে পারে নি; বরং অনাবশ্যক ঝামেলা মনে করে তাকে স্নেহ থেকে বঞ্চিত করে। একদিকে প্রকৃতির তান ও মায়ের ভালোবাসা পাওয়ার আকাঙ্ক্ষা অন্যদিকে মামির অবহেলা, অনাদর ও তিরষ্কার তার মনকে পীড়িত করে। ফলে এ পৃথিবী থেকে তাকে অসময়ে বিদায় নিতে হয়।', NULL, 1, 5, 'মিনুর বয়স কত?', 'শুকতারাকে মিনু সই মনে করে কেন?', 'উদ্দীপকে ফটিক ও ‘মিনু’ গল্পের মিনুর মধ্যে বৈসাদৃশ্য ব্যাখ্যা কর।', '‘ফটিক ও মিনুর পরিণতি ভিন্ন হলেও উভয়ের বেড়ে ওঠার পরিবেশ ছিল প্রতিকূল।’ – উক্তিটির যথার্থতা যাচাই কর।', '2018-02-09 21:13:17', '2018-02-09 21:13:17'),
(43, 'আমরা কয়েকজন বন্ধু গ্রীষ্মের ছুটিতে সেন্ট মার্টিন দ্বীপের উদ্দেশ্যে রওনা হলাম। উদ্দেশ্য, দুচোখ ভরে প্রাকৃতিক দৃশ্য উপভোগ করা। ঢাকা থেকে চট্টগ্রাম আবার সেখান থেকে কক্সবাজার গেলাম, সেখান থেকে সেন্ট মার্টিন, কী অপূর্ব দৃশ্য আর সৌন্দর্যের মাখামাখি। কোরাল পাথরের ছড়াছড়ি সেন্ট মার্টিন- এর এক বিশাল অহংকার। এছাড়াও আছে নীল পানির এক রাজপুরী। সেখানে কচ্ছপেরা অবাধে ঘুরে বেড়ায়, ডিইম পাড়ে; কাকড়ার দল বেধে আল্পনা আকে। সেন্ট মার্টিনে না গেলে প্রাকৃতিক সৌন্দর্যের এই লীলাভূমি অদেখাই থেকে যেত।', NULL, 1, 6, '‘নীলনদ আর পিরামিডের দেশ’ – কার লেখা?', 'উটের চোখগুলো রাতের বেলা সবুজ দেখাচ্ছিল কেন?', 'ভ্রমণকারীদের যাত্রাপথের সাথে লেখকের মিশর ভ্রমণের কী মিল খুঁজে পাওয়া যায়? বর্ননা কর।', '‘সেন্ট মার্টিন না গেলে প্রাকৃতিক সৌন্দর্যের এই লীলাভূমি অদেখাই থেকে যেত’ – এই বক্তব্য অনুসরণে নীলনদের সৌন্দর্যের সাদৃশ্য দেখাও।', '2018-02-09 21:14:42', '2018-02-09 21:14:42'),
(45, 'ধনধান্য পুষ্পভরা আমাদের এই বসুন্ধরা;\nতাহার মাঝে আছে দেশ এক- সকল দেশের সেরা;\nও সে স্বপ্ন দিয়ে তৈরি সে দেশ স্মৃতি দিয়ে ঘেরা;\nএমন দেশটি কোথাও খুঁজে পাবে নাকো তুমি,\nসকল দেশের রানি সে যে- আমার জন্মভূমি।', NULL, 1, 13, 'কবিইর অঙ্গ জুড়ায় কিসে?', 'কবির শেষ ইচ্ছা কী? ব্যাখ্যা কর।', 'উদ্দীপকে ‘জন্মভূমি’ কবিতার কোন দিকটির মিল লক্ষ করা যায়?', 'উদ্দীপক ও কবিতায় জন্মভূমিকে রানি সম্বোধন করার যৌক্তিকতা ব্যখ্যা কর।', '2018-02-09 21:18:40', '2018-02-09 21:18:40'),
(46, 'আলিম ও জামিল দুই ভাই। প্রবাসে গিয়ে আলিম প্রচুর সম্পদের মালিক হয়ে দেশে ফিরেছেন। বাড়ি-গাড়ি সবই করেছেন। নিজের সুখের সকল ব্যবস্থাই করেছেন। অপরদিকে জামিল কেবল নিজের সুখ নিয়েই ব্যস্ত নন। পরিবার ও পাড়া প্রতিবেশীর সুখে-দুঃখে তিনি এগিয়ে যান। অন্যের উপকার করার সুযোগ পেলে খুশি হন।', NULL, 1, 14, '‘অবনী’ শব্দের অর্থ কী?', 'সংসারকে সমর-অঙ্গন বলা হয়েছে কেন?', 'উদ্দীপকের জামিল সুখ কবিতায় বর্ণিত সুখী হবার কোন প্রক্রিয়াটি অনুসরণ করেছে- ব্যাখ্যা কর।', '‘আলিমের সুখ প্রকৃত সুখ নয়।’ – সুখ কবিতার আলোকে মন্তব্যটি বিশ্লেষণ কর।', '2018-02-09 21:19:26', '2018-02-09 21:19:26'),
(47, 'রহিম, শ্যামল ও রোজারিও তিন বন্ধু। ঈদ, পূজা ও বড়দিনে তারা একে অন্যের বাড়ি বেড়াতে যায়। আনন্দে-উৎসবে, সুখে-দুঃখে একে অন্যকে সাহায্য-সহযোগিতা করে। এরূপ আচরণে তাদের বাবা-মা খুব খুশি। রহিমের বাবা বলেন, ‘তোমরা অতি অসাধারণ। তোমাদের মতো সবাই বন্ধু-সূলভ হলে এ পৃথিবী আরো সুন্দর বাসস্থান হবে।’', NULL, 1, 17, '‘মানুষ জাতি’ কোন কাব্যগ্রন্থ থেকে নেওয়া হয়েছে?', '‘দুনিয়া সবারি জনম বেদি’- একথা দ্বারা কী বোঝানো হয়েছে?', 'রহিম, শ্যামল ও রোজারিওর বন্ধুত্বে ‘মানুষ জাতি’ কবিতার কোন বক্তব্যটি ফুটে উঠেছে-ব্যাখ্যা কর।', 'উদ্দীপকের রহিমের বাবার মন্তব্যই যেন ‘মানুষ জাতি’ কবিতার মূল সুর – উক্তিটি বিশ্লেষণ কর।', '2018-02-09 21:21:03', '2018-02-09 21:21:03');

-- --------------------------------------------------------

--
-- Table structure for table `examinations`
--

CREATE TABLE `examinations` (
  `id` int(10) UNSIGNED NOT NULL,
  `exam_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `class_id` int(155) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `examinations`
--

INSERT INTO `examinations` (`id`, `exam_name`, `class_id`, `created_at`, `updated_at`) VALUES
(1, 'JSC', 3, '2018-01-01 19:46:04', '2018-01-01 19:46:04'),
(2, 'SSC', 4, '2018-01-01 19:46:04', '2018-01-01 19:46:04'),
(3, 'HSC', 5, '2018-01-01 19:46:10', '2018-01-01 19:46:10'),
(4, 'JDC', 8, '2018-01-03 07:19:36', '2018-01-03 07:19:36'),
(5, 'Dakhil', 9, '2018-01-03 07:19:36', '2018-01-03 07:19:36'),
(6, 'Alim', 10, '2018-01-03 07:19:44', '2018-01-03 07:19:44');

-- --------------------------------------------------------

--
-- Table structure for table `forums`
--

CREATE TABLE `forums` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `bestreply` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `num_reply` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `visitor` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `forums`
--

INSERT INTO `forums` (`id`, `user_id`, `title`, `category`, `description`, `bestreply`, `num_reply`, `visitor`, `created_at`, `updated_at`) VALUES
(1, 21, 'পাইথনে কিভাবে ফাইল রাইড করতে হয়?', 'কম্পিউটার', 'আমি পাইথনে নতুন। আমি একটা ফাইল ড্রাইভ থেকে রিড করতে চাই কিন্তু কিভাবে করব তা জানি না। দয়া করে যদি কেউ সাহায্য করতেন। ধন্যবাদ', NULL, '0', '12', '2018-02-01 17:54:34', '2018-02-13 18:14:31'),
(2, 21, 'চার্ট একাউন্ট কাজ করতেছে না ?', 'কম্পিউটার', 'আমি একটি সাধারণ জাএস স্ক্রিপ্ট পেয়েছি যা টেক্সট এলাকায় টাইপ করার সময় একটি স্প্যান এলিমেন্টে চারাকোট ডাউন করে থাকে। আমি এটা বিস্তারিত বিস্তৃত পেয়েছি কারণ পৃষ্ঠায় অনেক ফলাফল outputting আছে। প্রতিটি একটি টেক্সটবাক্স আছে। Charcount স্ক্রিপ্টটি পোস্ট টোকেন এবং স্ট্রিং গঠিত হওয়ার জন্য অ্যারে ব্যবহার করে। আমি এই পৃষ্ঠাতে কাজ পেয়েছি, কিন্তু বর্তমান পৃষ্ঠাতে ত্রুটিটি খুঁজে পাওয়া যায় না।', NULL, '2', '1', '2018-02-11 17:55:16', '2018-02-16 19:01:24');

-- --------------------------------------------------------

--
-- Table structure for table `forum_visitors`
--

CREATE TABLE `forum_visitors` (
  `id` int(10) UNSIGNED NOT NULL,
  `forum_id` int(10) UNSIGNED NOT NULL,
  `visitor_ip` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `forum_visitors`
--

INSERT INTO `forum_visitors` (`id`, `forum_id`, `visitor_ip`, `created_at`, `updated_at`) VALUES
(1, 2, '127.0.0.1', '2018-02-11 18:23:51', '2018-02-11 18:23:51'),
(2, 1, '127.0.0.1', '2018-02-13 18:14:31', '2018-02-13 18:14:31');

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `reply_id` int(10) UNSIGNED NOT NULL,
  `like` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `mcq_questions`
--

CREATE TABLE `mcq_questions` (
  `id` int(10) UNSIGNED NOT NULL,
  `question_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `question_image` varchar(2555) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `classsubject_id` int(10) UNSIGNED NOT NULL,
  `mcq_type` enum('1','2','3','') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `c1` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `c2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `c3` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `section_id` int(10) UNSIGNED DEFAULT NULL,
  `option_no_1` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `option_no_2` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `option_no_3` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `option_no_4` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `correct_answer` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `mcq_questions`
--

INSERT INTO `mcq_questions` (`id`, `question_name`, `question_image`, `classsubject_id`, `mcq_type`, `c1`, `c2`, `c3`, `section_id`, `option_no_1`, `option_no_2`, `option_no_3`, `option_no_4`, `correct_answer`, `created_at`, `updated_at`) VALUES
(6, 'ca', NULL, 3, '1', NULL, NULL, NULL, 26, 'ca', 'ca', 'ca', 'ca', 'ca', '2017-12-12 16:23:09', '2017-12-12 16:23:09'),
(7, 'mcq7', NULL, 9, '1', NULL, NULL, NULL, 42, 'mcq7', 'mcq7', 'mcq7', 'mcq7', 'mcq7', '2017-12-13 07:31:59', '2017-12-13 07:31:59'),
(20, 'ফেরেশতা কেন ইহুদিদের কাছে এসেছিলেন?', NULL, 1, '1', NULL, NULL, NULL, 2, 'সাহায্য নেওয়ার জন্য', 'পরীক্ষা নেওয়ার জন্য', 'শিক্ষা দেওয়ার জন্য', 'মূল্যায়নের জন্য', 'পরীক্ষা নেওয়ার জন্য', '2018-02-09 21:23:16', '2018-02-09 21:23:16'),
(21, 'তৃতীয় ব্যক্তি ফেরেশতাকে সবকিছু দিতে রাজি হয়েছিল কেন?', NULL, 1, '1', NULL, NULL, NULL, 2, 'আল্লাহর প্রতি কৃতজ্ঞ থাকায়', 'তার ছাগল বেশি হয়েছিল', 'তার আর ধনসম্পদ দরকার ছিল না', 'সে অকৃপণ ছিল', 'আল্লাহর প্রতি কৃতজ্ঞ থাকায়', '2018-02-09 21:24:23', '2018-02-09 21:24:23'),
(22, 'মিনুর সই কে?', NULL, 1, '1', NULL, NULL, NULL, 5, 'চাঁদ', 'সূর্য', 'মঙ্গল গ্রহ', 'শুকতারা', 'চাঁদ', '2018-02-09 21:25:22', '2018-02-09 21:25:22'),
(23, '‘মিনুর বাবা অনেক দূর দেশে আছে’ – এখানে ‘দূর দেশে’ বলতে কোনটিকে বোঝানো হয়েছে?', NULL, 1, '1', NULL, NULL, NULL, 5, 'ইউরোপ', 'আমেরিকা', 'পরপার', 'আকাশ', 'পরপার', '2018-02-09 21:26:17', '2018-02-09 21:26:17'),
(24, 'কোন দেশকে পিরামিডের দেশ বলা হয়?', NULL, 1, '1', NULL, NULL, NULL, 2, 'সুদান', 'সৌদি আরব', 'ইরান', 'মিশর', 'মিশর', '2018-02-09 21:33:13', '2018-02-09 21:33:13'),
(25, 'সৈয়দ মুজতবা আলী কায়রোকে ‘নিশাচর শহর’ বলেছেন কেন?', NULL, 1, '1', NULL, NULL, NULL, 6, 'রাতে আলোকিত শহর দেখতে পাওয়া যায় বলে', 'কায়রোর রাস্তা খাবারের গন্ধে ম-ম করে বলে', 'এমন চেহারার আর কোন শহর দেখেন নি বলে', 'রেস্তোরাঁ, ক্যাফেগুলো খদ্দেরে গিজগিজ করে বলে', 'রেস্তোরাঁ, ক্যাফেগুলো খদ্দেরে গিজগিজ করে বলে', '2018-02-09 21:34:46', '2018-02-09 21:34:46'),
(26, 'কবির মন আকুল হয় কিসে?', NULL, 1, '1', NULL, NULL, NULL, 13, 'চাদের আলোয়', 'গাছের ছায়ায়', 'ফুলের গন্ধে', 'জন্মভূমির আলোয়', 'চাদের আলোয়', '2018-02-09 21:36:02', '2018-02-09 21:36:02'),
(27, 'জন্মভূমি কবিতার আলোকে উদ্দীপকের চরণ দুটিতে কবি মনের কোন দিকটি বিশেষভাবে প্রকাশিত হয়েছে?', NULL, 1, '1', NULL, NULL, NULL, 13, 'সৌন্দর্যবোধ', 'আত্মতৃপ্তি', 'গভীর আবেগ', 'দেশপ্রেম', 'দেশপ্রেম', '2018-02-09 21:36:44', '2018-02-09 21:36:44'),
(28, 'কে সুখ লাভ করবে?', NULL, 1, '1', NULL, NULL, NULL, 14, 'যে উপকার করবে', 'যে জীবনসংগ্রামে জয়ী হবে', 'যে আত্মসচেতন হয়ে উঠবে', 'যে বীরত্বের সঙ্গে যুদ্ধ করবে', 'যে জীবনসংগ্রামে জয়ী হবে', '2018-02-09 21:37:44', '2018-02-09 21:37:44'),
(29, 'মনের কষ্ট বৃদ্ধি পায়', NULL, 1, '2', 'সুখের জন্য কাঁদলে', 'সুখ নিয়ে ভাবলে', 'নিজেকে নিয়ে ব্যস্ত থাকলে', 14, 'i ও ii', 'i ও iii', 'ii ও iii', 'i, ii ও ii', 'i ও iii', '2018-02-09 21:38:47', '2018-02-09 21:38:47'),
(30, 'বাংলা কবিতার ক্ষেত্রে কাকে ‘ছন্দের জাদুকর’ বলা হয়?', NULL, 1, '1', NULL, NULL, NULL, 17, 'কাজী নজরুল ইসলামকে', 'রবীন্দ্রনাথ ঠাকুরকে', 'সত্যেন্দ্রনাথ দত্তকে', 'জসীমউদ্দীনকে', 'রবীন্দ্রনাথ ঠাকুরকে', '2018-02-09 21:39:37', '2018-02-09 21:39:37'),
(31, '‘এক পৃথিবীর স্তন্যে লালিত’ – এ উক্তিতে কী বোঝানো হয়েছে?', NULL, 1, '1', NULL, NULL, NULL, 17, 'একই পৃথিবীর স্নেহছায়ায় বেড়ে ওঠা', 'জীবন ধারণের ভিন্ন উপাদান', 'মানুষে মানুষে মেলবন্ধন', 'মনবকল্যানে কাজ করে যাওয়া', 'একই পৃথিবীর স্নেহছায়ায় বেড়ে ওঠা', '2018-02-09 21:40:26', '2018-02-09 21:40:26'),
(32, 'সূর্য এর প্রতিশব্দ কি?', NULL, 77, '1', NULL, NULL, NULL, NULL, 'সুধাংশু', 'শশাংক', 'বিধু', 'আদিত্য', 'বিধু', '2018-02-14 19:45:11', '2018-02-14 19:45:11'),
(33, '‘আপন’ শব্দের অর্থ কোনটি?', NULL, 77, '1', NULL, NULL, NULL, NULL, 'দোকান', 'অঙ্গ', 'অঙ্গ', 'আত্মীয়', 'আত্মীয়', '2018-02-14 19:45:11', '2018-02-14 19:45:11');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2017_11_06_191101_create_classes_table', 2),
(4, '2017_11_06_191425_create_subjects_table', 2),
(5, '2017_11_06_194111_crete_class_subject_table', 3),
(9, '2017_11_06_212924_create_creative_questions_table', 4),
(10, '2017_11_06_213621_create_mcq_questions_table', 4),
(11, '2017_11_07_160257_create_boards_table', 5),
(12, '2017_11_07_174434_create_examinations_table', 6),
(13, '2017_11_07_174623_create_board_examinations_table', 7),
(14, '2017_11_07_155950_create_board_questions_table', 8),
(15, '2017_11_07_155805_create_test_questions_table', 9),
(16, '2017_12_05_185716_create_adminchats_table', 10),
(17, '2017_12_11_113840_create_sections_table', 11),
(18, '2018_01_15_174506_create_normal_exam_questions_table', 12),
(19, '2018_01_15_174522_create_board_exam_questions_table', 12),
(20, '2018_01_24_195516_create_normal_exam_questions_user_table', 13),
(21, '2018_01_24_195516_create_normal_exam_question_user_table', 14),
(22, '2018_01_30_013603_create_results_table', 15),
(23, '2018_02_10_233159_create_saved_questions_table', 16),
(24, '2018_02_11_233503_create_forums_table', 17),
(25, '2018_02_11_233654_create_replies_table', 17),
(26, '2018_02_11_233704_create_categories_table', 17),
(27, '2018_02_11_233721_create_likes_table', 17),
(28, '2018_02_12_002030_create_forum_visitors_table', 18);

-- --------------------------------------------------------

--
-- Table structure for table `normal_exam_questions`
--

CREATE TABLE `normal_exam_questions` (
  `id` int(10) UNSIGNED NOT NULL,
  `classsubject_id` int(10) UNSIGNED NOT NULL,
  `section_id` int(10) UNSIGNED DEFAULT NULL,
  `mcq_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `question_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `question_image` varchar(2550) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `c1` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `c2` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `c3` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `option_no_1` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `option_no_2` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `option_no_3` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `option_no_4` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `correct_answer` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pexam` varchar(2550) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `normal_exam_questions`
--

INSERT INTO `normal_exam_questions` (`id`, `classsubject_id`, `section_id`, `mcq_type`, `question_name`, `question_image`, `c1`, `c2`, `c3`, `option_no_1`, `option_no_2`, `option_no_3`, `option_no_4`, `correct_answer`, `pexam`, `created_at`, `updated_at`) VALUES
(3, 77, NULL, '1', '“ধর্ম সাধারণ লোকের সংস্কৃতি, আর সংস্কৃতি শিক্ষিত মার্জিত লোকের ধর্ম”—কে বলেছেন?', NULL, NULL, NULL, NULL, 'মোতাহের হোসেন চৌধুরী', 'রামেন্দ্রসুন্দর ত্রিবেদী', 'প্রমথ চৌধুরী', 'কাজী আব্দুল ওদুদ', 'মোতাহের হোসেন চৌধুরী', NULL, '2018-02-14 13:40:09', '2018-02-14 13:40:09'),
(4, 77, NULL, '1', '‘আমার ভাইয়ের রক্তের রাঙানো একুশে ফেব্রুয়ারি’ গানটির রচয়িতা ও সুরকার হলেন যথাক্রমে-', NULL, NULL, NULL, NULL, 'গোবিন্দচন্দ্র ও আলতাফ মাহমুদ', 'আলতাফ মাহমুদ ও আবদুল গাফফার চৌধুরী', 'আবদুল গাফফার চৌধুরী ও আলতাফ মাহমুদ', 'আল মাহমুদ ও আলতাফ মাহমুদ', 'আবদুল গাফফার চৌধুরী ও আলতাফ মাহমুদ', NULL, '2018-02-14 13:41:34', '2018-02-14 13:41:34'),
(5, 77, NULL, '1', 'জসীমউদ্দীনের \'কবর\' কবিতাটি কোন ছন্দে রচিত?', NULL, NULL, NULL, NULL, 'স্বরবৃত্ত', 'মাত্রাবৃত্ত', 'অক্ষরবৃত্ত', 'মুক্তক', 'মাত্রাবৃত্ত', NULL, '2018-02-14 13:42:41', '2018-02-14 13:42:41'),
(6, 77, NULL, '1', 'কোনটি বাগধারা বোঝায়?', NULL, NULL, NULL, NULL, 'চৈত্র সংক্রান্তি', 'পৌষ সংক্রান্তি', 'শিরে সংক্রান্তি', 'শিব-সংক্রান্তি', 'শিরে সংক্রান্তি', NULL, '2018-02-14 13:45:26', '2018-02-14 13:45:26'),
(7, 77, NULL, '1', 'মাতা শব্দের সমার্থক শব্দ-', NULL, NULL, NULL, NULL, 'কান্ত', 'প্রসূতি', 'দয়িত', 'নাথ', 'প্রসূতি', NULL, '2018-02-14 13:46:21', '2018-02-14 13:46:21'),
(8, 77, NULL, '1', 'সূর্য এর প্রতিশব্দ কি?', NULL, NULL, NULL, NULL, 'সুধাংশু', 'শশাংক', 'বিধু', 'আদিত্য', 'বিধু', NULL, '2018-02-14 20:05:27', '2018-02-14 20:05:27'),
(9, 77, NULL, '1', '‘আপন’ শব্দের অর্থ কোনটি?', NULL, NULL, NULL, NULL, 'দোকান', 'অঙ্গ', 'অঙ্গ', 'আত্মীয়', 'আত্মীয়', NULL, '2018-02-14 20:05:27', '2018-02-14 20:05:27'),
(12, 87, NULL, '1', 'সূর্য এর প্রতিশব্দ কি?', NULL, NULL, NULL, NULL, 'সুধাংশু', 'শশাংক', 'বিধু', 'আদিত্য', 'বিধু', NULL, '2018-02-14 20:32:55', '2018-02-14 20:32:55'),
(13, 87, NULL, '1', '‘আপন’ শব্দের অর্থ কোনটি?', NULL, NULL, NULL, NULL, 'দোকান', 'অঙ্গ', 'অঙ্গ', 'আত্মীয়', 'আত্মীয়', NULL, '2018-02-14 20:32:55', '2018-02-14 20:32:55'),
(14, 91, NULL, '1', 'সূর্য এর প্রতিশব্দ কি?', NULL, NULL, NULL, NULL, 'সুধাংশু', 'শশাংক', 'বিধু', 'আদিত্য', 'বিধু', NULL, '2018-02-14 20:33:11', '2018-02-14 20:33:11'),
(15, 91, NULL, '1', '‘আপন’ শব্দের অর্থ কোনটি?', NULL, NULL, NULL, NULL, 'দোকান', 'অঙ্গ', 'অঙ্গ', 'আত্মীয়', 'আত্মীয়', NULL, '2018-02-14 20:33:11', '2018-02-14 20:33:11'),
(16, 96, NULL, '1', 'সূর্য এর প্রতিশব্দ কি?', NULL, NULL, NULL, NULL, 'সুধাংশু', 'শশাংক', 'বিধু', 'আদিত্য', 'বিধু', NULL, '2018-02-14 20:33:21', '2018-02-14 20:33:21'),
(17, 96, NULL, '1', '‘আপন’ শব্দের অর্থ কোনটি?', NULL, NULL, NULL, NULL, 'দোকান', 'অঙ্গ', 'অঙ্গ', 'আত্মীয়', 'আত্মীয়', NULL, '2018-02-14 20:33:21', '2018-02-14 20:33:21'),
(18, 77, NULL, '1', '‘একচ্ছত্র’-এর সন্ধি বিচ্ছেদ', NULL, NULL, NULL, NULL, 'এক+ছত্র', 'এক+ছত', 'এ+ছত্র', 'এক+ত্র', 'এক+ছত্র', NULL, '2018-02-14 20:39:40', '2018-02-14 20:39:40'),
(19, 77, NULL, '1', '‘শীতার্ত’-এর সন্ধি বিচ্ছেদ-', NULL, NULL, NULL, NULL, 'শীত+ত', 'শীতা+ত', 'শীত+ঋত', 'শীতা+ঋত', 'শীত+ঋত', NULL, '2018-02-14 20:39:40', '2018-02-14 20:39:40'),
(20, 91, NULL, '1', '‘একচ্ছত্র’-এর সন্ধি বিচ্ছেদ', NULL, NULL, NULL, NULL, 'এক+ছত্র', 'এক+ছত', 'এ+ছত্র', 'এক+ত্র', 'এক+ছত্র', NULL, '2018-02-14 20:40:16', '2018-02-14 20:40:16'),
(21, 91, NULL, '1', '‘শীতার্ত’-এর সন্ধি বিচ্ছেদ-', NULL, NULL, NULL, NULL, 'শীত+ত', 'শীতা+ত', 'শীত+ঋত', 'শীতা+ঋত', 'শীত+ঋত', NULL, '2018-02-14 20:40:16', '2018-02-14 20:40:16'),
(22, 96, NULL, '1', '‘একচ্ছত্র’-এর সন্ধি বিচ্ছেদ', NULL, NULL, NULL, NULL, 'এক+ছত্র', 'এক+ছত', 'এ+ছত্র', 'এক+ত্র', 'এক+ছত্র', NULL, '2018-02-14 20:40:26', '2018-02-14 20:40:26'),
(23, 96, NULL, '1', '‘শীতার্ত’-এর সন্ধি বিচ্ছেদ-', NULL, NULL, NULL, NULL, 'শীত+ত', 'শীতা+ত', 'শীত+ঋত', 'শীতা+ঋত', 'শীত+ঋত', NULL, '2018-02-14 20:40:26', '2018-02-14 20:40:26'),
(24, 87, NULL, '1', '‘একচ্ছত্র’-এর সন্ধি বিচ্ছেদ', NULL, NULL, NULL, NULL, 'এক+ছত্র', 'এক+ছত', 'এ+ছত্র', 'এক+ত্র', 'এক+ছত্র', NULL, '2018-02-14 20:40:32', '2018-02-14 20:40:32'),
(25, 87, NULL, '1', '‘শীতার্ত’-এর সন্ধি বিচ্ছেদ-', NULL, NULL, NULL, NULL, 'শীত+ত', 'শীতা+ত', 'শীত+ঋত', 'শীতা+ঋত', 'শীত+ঋত', NULL, '2018-02-14 20:40:32', '2018-02-14 20:40:32'),
(26, 1, 2, '1', 'cscac', NULL, NULL, NULL, NULL, 'csc', 'ca', 'i', 'i, ii ও iii', 'csc', NULL, '2018-02-15 17:22:28', '2018-02-15 17:22:28'),
(27, 1, 2, '1', 'a', NULL, NULL, NULL, NULL, 'csc', 'c', 'b', 'i, ii ও iii', 'c', NULL, '2018-02-15 17:54:38', '2018-02-15 17:54:38'),
(28, 1, 2, '1', 'ca', NULL, NULL, NULL, NULL, 'csc', 'c', 'i', 'ccaca', 'csc', NULL, '2018-02-15 18:37:32', '2018-02-15 18:37:32'),
(29, 1, 2, '1', 'ca', NULL, NULL, NULL, NULL, 'caca', 'cacaca', 'cacacacaca', 'cacacacacaca', 'caca', NULL, '2018-02-15 18:37:57', '2018-02-15 18:37:57');

-- --------------------------------------------------------

--
-- Table structure for table `normal_exam_question_user`
--

CREATE TABLE `normal_exam_question_user` (
  `id` int(11) NOT NULL,
  `normal_exam_question_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `exam_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `answer` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `result` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `normal_exam_question_user`
--

INSERT INTO `normal_exam_question_user` (`id`, `normal_exam_question_id`, `user_id`, `exam_token`, `answer`, `result`, `created_at`, `updated_at`) VALUES
(46, 6, 21, 'pMpzZ', 'চৈত্র সংক্রান্তি', 'Worng', '2018-02-14 13:59:44', '2018-02-14 13:59:44'),
(47, 3, 21, 'pMpzZ', 'মোতাহের হোসেন চৌধুরী', 'Correct', '2018-02-14 13:59:44', '2018-02-14 13:59:44'),
(48, 4, 21, 'pMpzZ', 'আবদুল গাফফার চৌধুরী ও আলতাফ মাহমুদ', 'Correct', '2018-02-14 13:59:44', '2018-02-14 13:59:44'),
(49, 7, 21, 'pMpzZ', 'দয়িত', 'Worng', '2018-02-14 13:59:44', '2018-02-14 13:59:44'),
(50, 5, 21, 'pMpzZ', 'মাত্রাবৃত্ত', 'Correct', '2018-02-14 13:59:44', '2018-02-14 13:59:44'),
(61, 4, 21, 'mzLV3', 'আবদুল গাফফার চৌধুরী ও আলতাফ মাহমুদ', 'Correct', '2018-02-14 14:38:42', '2018-02-14 14:38:42'),
(62, 5, 21, 'mzLV3', 'মাত্রাবৃত্ত', 'Correct', '2018-02-14 14:38:42', '2018-02-14 14:38:42'),
(63, 6, 21, 'mzLV3', 'চৈত্র সংক্রান্তি', 'Worng', '2018-02-14 14:38:42', '2018-02-14 14:38:42'),
(64, 3, 21, 'mzLV3', 'মোতাহের হোসেন চৌধুরী', 'Correct', '2018-02-14 14:38:42', '2018-02-14 14:38:42'),
(65, 7, 21, 'mzLV3', 'দয়িত', 'Worng', '2018-02-14 14:38:42', '2018-02-14 14:38:42'),
(66, 4, 21, 'NMzBN', 'আবদুল গাফফার চৌধুরী ও আলতাফ মাহমুদ', 'Correct', '2018-02-14 14:39:16', '2018-02-14 14:39:16'),
(67, 5, 21, 'NMzBN', 'মাত্রাবৃত্ত', 'Correct', '2018-02-14 14:39:17', '2018-02-14 14:39:17'),
(68, 7, 21, 'NMzBN', 'দয়িত', 'Correct', '2018-02-14 14:39:17', '2018-02-14 14:39:17'),
(69, 6, 21, 'NMzBN', 'চৈত্র সংক্রান্তি', 'Worng', '2018-02-14 14:39:17', '2018-02-14 14:39:17'),
(70, 3, 21, 'NMzBN', 'মোতাহের হোসেন চৌধুরী', 'Correct', '2018-02-14 14:39:17', '2018-02-14 14:39:17');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `replies`
--

CREATE TABLE `replies` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `forum_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `best` enum('Yes','No') COLLATE utf8mb4_unicode_ci NOT NULL,
  `Like` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `results`
--

CREATE TABLE `results` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `etoken` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_question` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `right_answer` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `results`
--

INSERT INTO `results` (`id`, `user_id`, `etoken`, `total_question`, `right_answer`, `created_at`, `updated_at`) VALUES
(4, 21, 'mzLV3', '5', '3', '2018-02-14 14:38:55', '2018-02-14 14:38:55'),
(5, 21, 'NMzBN', '5', '4', '2018-02-14 14:39:28', '2018-02-14 14:39:28');

-- --------------------------------------------------------

--
-- Table structure for table `saved_questions`
--

CREATE TABLE `saved_questions` (
  `id` int(10) UNSIGNED NOT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `question_id` int(11) NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `classsubject_id` int(10) UNSIGNED NOT NULL,
  `section_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sections`
--

CREATE TABLE `sections` (
  `id` int(10) UNSIGNED NOT NULL,
  `section_no` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `section_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `section_details` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ClassSubject_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sections`
--

INSERT INTO `sections` (`id`, `section_no`, `section_name`, `section_details`, `ClassSubject_id`, `created_at`, `updated_at`) VALUES
(2, '১ম', 'সততার পুরস্কার', NULL, 1, '2017-12-11 14:07:34', '2017-12-11 14:07:34'),
(5, '২য়', 'মিনু', NULL, 1, '2017-12-11 14:08:13', '2017-12-11 14:08:13'),
(6, '৩য়', 'নীলনদ আর পিরামিডের দেশ', NULL, 1, '2017-12-11 14:08:13', '2017-12-11 14:08:13'),
(7, '৪থ', 'তোলপাড়', NULL, 1, '2017-12-11 14:09:13', '2017-12-11 14:09:13'),
(8, '৫ম', 'অমর একুশে', NULL, 1, '2017-12-11 14:09:13', '2017-12-11 14:09:13'),
(9, '৬ষ্ঠ', 'আকাশ', NULL, 1, '2017-12-11 14:10:00', '2017-12-11 14:10:00'),
(10, '৭ম', 'মাদার তেরেসা', NULL, 1, '2017-12-11 14:10:00', '2017-12-11 14:10:00'),
(11, '৮ম', 'কতদিকে কত কারিগর', NULL, 1, '2017-12-11 14:11:23', '2017-12-11 14:11:23'),
(12, '৯ম', 'কতকাল ধরে', NULL, 1, '2017-12-11 14:11:23', '2017-12-11 14:11:23'),
(13, '১০ম', 'জন্মভুমি', NULL, 1, '2017-12-11 14:13:36', '2017-12-11 14:13:36'),
(14, '১১', 'সুখ', NULL, 1, '2017-12-11 14:13:36', '2017-12-11 14:13:36'),
(17, '১২', 'মানুষ জাতি', NULL, 1, '2017-12-11 14:15:54', '2017-12-11 14:15:54'),
(18, '১৩', 'ঝিঙে ফুল', NULL, 1, '2017-12-11 14:15:54', '2017-12-11 14:15:54'),
(19, '১৪', 'আসমানি', NULL, 1, '2017-12-11 14:16:33', '2017-12-11 14:16:33'),
(20, '১৫', 'মুজিব', NULL, 1, '2017-12-11 14:16:33', '2017-12-11 14:16:33'),
(23, '১৬', 'বাঁচতে দাও', NULL, 1, '2017-12-11 14:17:06', '2017-12-11 14:17:06'),
(24, '১৭', 'পাখির কাছে ফুলের কাছে', NULL, 1, '2017-12-11 14:17:06', '2017-12-11 14:17:06'),
(25, '১৮', 'ফাগুন মাস', NULL, 1, '2017-12-11 14:17:09', '2017-12-11 14:17:09'),
(26, '১ম', 'বাংলাদেশের ইতিহাস', NULL, 3, '2017-12-11 16:19:28', '2017-12-11 16:19:28'),
(27, '২য়', 'বাংলাদেশের ও বিশ্বসভ্যতা', NULL, 3, '2017-12-11 16:19:28', '2017-12-11 16:19:28'),
(30, '৩য়', 'বিশ্ব ভৌগোলিক পরিমন্ডলে বাংলাদেশ', NULL, 3, '2017-12-11 16:21:21', '2017-12-11 16:21:21'),
(31, '৪থ', 'বাংলাদেশের জনসংখ্যা পরিচিতি', NULL, 3, '2017-12-11 16:21:21', '2017-12-11 16:21:21'),
(32, '৫ম', 'বাংলাদেশের সমাজ', NULL, 3, '2017-12-11 16:22:23', '2017-12-11 16:22:23'),
(33, '৬ষ্ঠ', 'বাংলাদেশের সংস্কৃতি', NULL, 3, '2017-12-11 16:22:23', '2017-12-11 16:22:23'),
(34, '৭ম', 'বাংলাদেশের অর্থনীতি', NULL, 3, '2017-12-11 16:23:22', '2017-12-11 16:23:22'),
(35, '৮ম', 'বাংলাদেশ ও বাংলাদেশের নাগরিক', NULL, 3, '2017-12-11 16:23:22', '2017-12-11 16:23:22'),
(36, '৯ম', 'বাংলাদেশের পরিবার', NULL, 3, '2017-12-11 16:24:03', '2017-12-11 16:24:03'),
(37, '১০ম', 'বাংলাদেশের শিশু অধিকার', NULL, 3, '2017-12-11 16:24:03', '2017-12-11 16:24:03'),
(38, '১১তম', 'বাংলাদেশের শিশু বেড়ে ওঠা ও প্রতিবন্ধকতা', NULL, 3, '2017-12-11 16:25:46', '2017-12-11 16:25:46'),
(39, '১২তম', 'বাংলাদেশ ও আঞ্চলিক সহযোগিতা', NULL, 3, '2017-12-11 16:25:46', '2017-12-11 16:25:46'),
(42, '১ম', 'কাবুলিওয়ালা', NULL, 9, '2017-12-13 11:28:03', '2017-12-13 11:28:03'),
(43, '২য়', 'লখার একুশে', NULL, 9, '2017-12-13 11:28:03', '2017-12-13 11:28:03'),
(44, '১ম', 'অতীতের স্মৃতি', NULL, 13, '2018-01-15 19:14:50', '2018-01-15 19:14:50'),
(48, '১ম', 'স্বাভাবিক সংখ্যা ও ভগ্নাংশ', NULL, 2, '2018-01-23 19:40:12', '2018-01-23 19:40:12'),
(49, '২য়', 'অনুপাত ও শতকরা', NULL, 2, '2018-01-23 19:40:12', '2018-01-23 19:40:12'),
(50, '৩য়', 'পূর্ণসংখ্যা', NULL, 2, '2018-01-23 19:42:12', '2018-01-23 19:42:12'),
(51, '৪থ', 'বীজগণিতীয় রাশি', NULL, 2, '2018-01-23 19:42:12', '2018-01-23 19:42:12'),
(52, '৫ম', 'সরল সমীকরণ', NULL, 2, '2018-01-23 19:42:46', '2018-01-23 19:42:46'),
(53, '৬ষ্ঠ', 'জ্যামিতির মৌলিক ধারণা', NULL, 2, '2018-01-23 19:42:46', '2018-01-23 19:42:46'),
(54, '৭ম', 'ব্যাবহারিক জ্যামিতি', NULL, 2, '2018-01-23 19:43:18', '2018-01-23 19:43:18'),
(55, '৮ম', 'তথ্য ও উপাত্ত', NULL, 2, '2018-01-23 19:43:18', '2018-01-23 19:43:18'),
(56, '১ম', 'বৈজ্ঞানিক প্রক্রিয়া ও পরিমাপ', NULL, 4, '2018-01-23 19:45:49', '2018-01-23 19:45:49'),
(57, '২য়', 'জীবজগৎ', NULL, 4, '2018-01-23 19:45:49', '2018-01-23 19:45:49'),
(58, '৩য়', 'উদ্ভিদ ও প্রাণীর কোষীয় সংগঠন', NULL, 4, '2018-01-23 19:46:24', '2018-01-23 19:46:24'),
(59, '৪র্থ', 'উদ্ভিদের বাহ্যিক বৈশিষ্ট্য', NULL, 4, '2018-01-23 19:46:24', '2018-01-23 19:46:24'),
(60, '৫ম', 'সালোকসংশ্লেষণ', NULL, 4, '2018-01-23 19:46:58', '2018-01-23 19:46:58'),
(61, '৬ষ্ঠ', 'সংবেদি অঙ্গ', NULL, 4, '2018-01-23 19:46:58', '2018-01-23 19:46:58'),
(62, '৭ম', 'পদার্থের বৈশিষ্ট্য এবং বাহ্যিক প্রভাব', NULL, 4, '2018-01-23 19:47:28', '2018-01-23 19:47:28'),
(63, '৮ম', 'মিশ্রণ', NULL, 4, '2018-01-23 19:47:28', '2018-01-23 19:47:28'),
(64, '৯ম', 'আলোর ঘটনা', NULL, 4, '2018-01-23 19:48:00', '2018-01-23 19:48:00'),
(65, '১০ম', 'গতি', NULL, 4, '2018-01-23 19:48:00', '2018-01-23 19:48:00'),
(66, '১১তম', 'বল এবং সরল যন্ত্র', NULL, 4, '2018-01-23 19:49:02', '2018-01-23 19:49:02'),
(67, '১২তম', 'পৃথিবীর উৎপত্তি ও গঠন', NULL, 4, '2018-01-23 19:49:02', '2018-01-23 19:49:02'),
(68, '১৩তম', 'খাদ্য ও পুষ্টি', NULL, 4, '2018-01-23 19:49:31', '2018-01-23 19:49:31'),
(69, '১৪তম', 'পরিবেশের ভারসাম্য এবং আমাদের জীবন', NULL, 4, '2018-01-23 19:49:31', '2018-01-23 19:49:31'),
(70, '১ম', 'আকাইদ', NULL, 5, '2018-01-23 19:50:46', '2018-01-23 19:50:46'),
(71, '২য়', 'ইবাদত', NULL, 5, '2018-01-23 19:50:46', '2018-01-23 19:50:46'),
(72, '৩য়', 'কুরআন ও হাদিস শিক্ষা', NULL, 5, '2018-01-23 19:51:27', '2018-01-23 19:51:27'),
(73, '৪র্থ', 'আখলাক', NULL, 5, '2018-01-23 19:51:27', '2018-01-23 19:51:27'),
(74, '৫ম', 'আদর্শ জীবনচরিত', NULL, 5, '2018-01-23 19:51:40', '2018-01-23 19:51:40'),
(75, '১ম', 'স্রষ্টা ও সৃষ্টি', NULL, 6, '2018-01-23 19:53:04', '2018-01-23 19:53:04'),
(76, '২য়', 'ধর্মগ্রন্থ', NULL, 6, '2018-01-23 19:53:04', '2018-01-23 19:53:04'),
(77, '৩য়', 'হিন্দুধর্মের স্বরূপ ও বিশ্বাস', NULL, 6, '2018-01-23 19:53:47', '2018-01-23 19:53:47'),
(78, '৪থ', 'নিত্যকর্ম ও যোগাসন', NULL, 6, '2018-01-23 19:53:47', '2018-01-23 19:53:47'),
(79, '৫ম', 'দেব-দেবী ও পূজা-পার্বণ', NULL, 6, '2018-01-23 19:54:23', '2018-01-23 19:54:23'),
(80, '৬ষ্ঠ', 'ধর্মীয় উপাখ্যানে নৈতিক শিক্ষা', NULL, 6, '2018-01-23 19:54:23', '2018-01-23 19:54:23'),
(81, '৭ম', 'আদর্শ জীবনচরিত', NULL, 6, '2018-01-23 19:54:59', '2018-01-23 19:54:59'),
(82, '৮ম', 'হিন্দুধর্ম ও নৈতিক মূল্যবোধ', NULL, 6, '2018-01-23 19:54:59', '2018-01-23 19:54:59'),
(83, '১ম', 'ঈশ্বরকে জানা', NULL, 8, '2018-01-23 19:55:51', '2018-01-23 19:55:51'),
(84, '২য়', 'ঈশ্বরের সৃস্টিকর্মের উদ্দেশ্য', NULL, 8, '2018-01-23 19:55:51', '2018-01-23 19:55:51'),
(85, '৩য়', 'মানুষ সৃষ্টি', NULL, 8, '2018-01-23 19:56:21', '2018-01-23 19:56:21'),
(86, '৪থ', 'স্বর্গদূত ও মানুষের পতনঃ পরিত্রানের প্রতিশ্রুতি', NULL, 8, '2018-01-23 19:56:21', '2018-01-23 19:56:21'),
(87, '৫ম', 'ঈশ্বরের আহবানে ইসাইয়ার সাড়াদান', NULL, 8, '2018-01-23 19:56:57', '2018-01-23 19:56:57'),
(88, '৬ষ্ঠ', 'মুক্তিদাতা যীশুর জন্ম ও শৈশব', NULL, 8, '2018-01-23 19:56:57', '2018-01-23 19:56:57'),
(89, '৭ম', 'প্রভূ যীশুর আশ্চর্য কাজ', NULL, 8, '2018-01-23 19:57:26', '2018-01-23 19:57:26'),
(90, '৮ম', 'খ্রিষ্টমন্ডলীর জন্ম ও প্রেরণকর্ম', NULL, 8, '2018-01-23 19:57:26', '2018-01-23 19:57:26'),
(91, '৯ম', 'সত্যবাদিতা, শৃঙ্খলা ও সেবা', NULL, 8, '2018-01-23 19:57:57', '2018-01-23 19:57:57'),
(92, '১০ম', 'প্রিয়নাথ বৈরাগী', NULL, 8, '2018-01-23 19:57:57', '2018-01-23 19:57:57'),
(93, '১ম', 'গৌতম বুদ্ধের জীবপ্রেম', NULL, 7, '2018-01-23 19:58:33', '2018-01-23 19:58:33'),
(94, '২য়', 'বন্দনা', NULL, 7, '2018-01-23 19:58:33', '2018-01-23 19:58:33'),
(95, '৩য়', 'শীল', NULL, 7, '2018-01-23 19:58:58', '2018-01-23 19:58:58'),
(96, '৪থ', 'দান', NULL, 7, '2018-01-23 19:58:58', '2018-01-23 19:58:58'),
(97, '৫ম', 'সুত্র ও নীতিগাথা', NULL, 7, '2018-01-23 19:59:31', '2018-01-23 19:59:31'),
(98, '৬ষ্ঠ', 'চতুরার্য সত্য', NULL, 7, '2018-01-23 19:59:31', '2018-01-23 19:59:31'),
(99, '৭ম', 'ধর্মীয় আচার-অনুষ্ঠান ও উৎসব', NULL, 7, '2018-01-23 19:59:57', '2018-01-23 19:59:57'),
(100, '৮ম', 'চরিতমালা', NULL, 7, '2018-01-23 19:59:57', '2018-01-23 19:59:57'),
(101, '৯ম', 'জাতক', NULL, 7, '2018-01-23 20:00:28', '2018-01-23 20:00:28'),
(102, '১০ম', 'বাংলাদেশের বৌদ্ধ ঐতিহ্য ও দর্শনীয় স্থান', NULL, 7, '2018-01-23 20:00:28', '2018-01-23 20:00:28'),
(103, '১১তম', 'বৌদ্ধধর্মের রাজন্যবর্গের অবদানঃ রাজা বিম্বিসার', NULL, 7, '2018-01-23 20:00:44', '2018-01-23 20:00:44'),
(104, '৩য়', 'মরু-ভাষ্কর', NULL, 9, '2018-01-30 21:41:53', '2018-01-30 21:41:53'),
(105, '৪র্থ', 'শব্দ থেকে কবিতা', NULL, 9, '2018-01-30 21:43:02', '2018-01-30 21:43:02'),
(106, '৫ম', 'পাখি', NULL, 9, '2018-01-30 21:43:02', '2018-01-30 21:43:02'),
(107, '৬ষ্ঠ', 'পিতৃপুরুষের গল্প', NULL, 9, '2018-01-30 21:43:31', '2018-01-30 21:43:31'),
(108, '৭ম', 'ছবির রং', NULL, 9, '2018-01-30 21:43:31', '2018-01-30 21:43:31'),
(109, '৮ম', 'রোকেয়া সাখাওয়াত হোসেন', NULL, 9, '2018-01-30 21:43:59', '2018-01-30 21:43:59'),
(110, '৯ম', 'সেই ছেলেটি', NULL, 9, '2018-01-30 21:43:59', '2018-01-30 21:43:59'),
(111, '১০ম', 'বাংলাদেশের ক্ষুদ্র জাতিসত্তা', NULL, 9, '2018-01-30 21:44:32', '2018-01-30 21:44:32'),
(112, '১১তম', 'নতুন দেশ', NULL, 9, '2018-01-30 21:44:32', '2018-01-30 21:44:32'),
(113, '১২তম', 'কুলি-মজুর', NULL, 9, '2018-01-30 21:45:03', '2018-01-30 21:45:03'),
(114, '১৩তম', 'আমার বাড়ি', NULL, 9, '2018-01-30 21:45:03', '2018-01-30 21:45:03'),
(115, '১৪তম', 'শোন একটি মুজিবরের থেকে', NULL, 9, '2018-01-30 21:45:49', '2018-01-30 21:45:49'),
(116, '১৫তম', 'সবার আমি ছাত্র', NULL, 9, '2018-01-30 21:45:49', '2018-01-30 21:45:49'),
(117, '১৬তম', ' শ্রাবণে', NULL, 9, '2018-01-30 21:47:41', '2018-01-30 21:47:41'),
(118, '১৭তম', 'গরবিনী মা-জননী', NULL, 9, '2018-01-30 21:47:41', '2018-01-30 21:47:41'),
(121, '১৮তম', 'সাম্য', NULL, 9, '2018-01-30 21:48:29', '2018-01-30 21:48:29'),
(122, '১৯তম', 'মেলা', NULL, 9, '2018-01-30 21:48:29', '2018-01-30 21:48:29'),
(123, '২০তম', 'এই অক্ষরে', NULL, 9, '2018-01-30 21:49:04', '2018-01-30 21:49:04'),
(124, '১ম', 'মূলদ ও অমূলদ সংখ্যা ', NULL, 10, '2018-01-30 22:05:23', '2018-01-30 22:05:23'),
(125, '২য়', 'সমানুপাত ও লাভ-ক্ষতি ', NULL, 10, '2018-01-30 22:05:23', '2018-01-30 22:05:23'),
(126, '৩য়', 'পরিমাপ ', NULL, 10, '2018-01-30 22:11:41', '2018-01-30 22:11:41'),
(127, '৪র্থ', 'বীজগণিতীয় রাশির গুণ ও ভাগ ', NULL, 10, '2018-01-30 22:11:41', '2018-01-30 22:11:41'),
(128, '৫ম', 'বীজগণিতীয় সূত্রাবলি ও প্রয়োগ  ', NULL, 10, '2018-01-30 22:11:41', '2018-01-30 22:11:41'),
(129, '৬ষ্ঠ', 'বীজগণিতীয় ভগ্নাংশ ', NULL, 10, '2018-01-30 22:11:41', '2018-01-30 22:11:41'),
(130, '৭ম', 'সরল সমীকরণ ', NULL, 10, '2018-01-30 22:11:41', '2018-01-30 22:11:41'),
(131, '৮ম', 'সমান্তরাল সরলরেখা ', NULL, 10, '2018-01-30 22:11:41', '2018-01-30 22:11:41'),
(132, '৯ম', 'ত্রিভূজ ', NULL, 10, '2018-01-30 22:11:41', '2018-01-30 22:11:41'),
(133, '১০ম', 'সর্বসমতা ও সাদৃশ্যতা  ', NULL, 10, '2018-01-30 22:11:41', '2018-01-30 22:11:41'),
(134, '১১তম', 'তথ্য ও উপাত্ত', NULL, 10, '2018-01-30 22:11:41', '2018-01-30 22:11:41'),
(135, '১ম', 'বাংলাদেশের স্বাধীনতা সংগ্রাম', NULL, 15, '2018-01-30 22:20:20', '2018-01-30 22:20:20'),
(136, '২য়', 'বাংলাদেশের সংস্কৃতি ও সাংস্কৃতিক বৈচিত্র', NULL, 15, '2018-01-30 22:20:20', '2018-01-30 22:20:20'),
(137, '৩য়', 'পরিবারে শিশুর বেড়ে ওঠা', NULL, 15, '2018-01-30 22:20:20', '2018-01-30 22:20:20'),
(138, '৪র্থ', 'বাংলাদেশের অর্থনীতি', NULL, 15, '2018-01-30 22:20:20', '2018-01-30 22:20:20'),
(139, '৫ম', 'বাংলাদেশ ও বাংলাদেশের নাগরিক', NULL, 15, '2018-01-30 22:20:20', '2018-01-30 22:20:20'),
(140, '৬ষ্ঠ', 'বাংলাদেশের নির্বাচন ব্যবস্থা', NULL, 15, '2018-01-30 22:20:20', '2018-01-30 22:20:20'),
(141, '৭ম', 'বাংলাদেশের জলবায়ূ', NULL, 15, '2018-01-30 22:20:20', '2018-01-30 22:20:20'),
(142, '৮ম', 'বাংলাদেশের জনসংখ্যা পরিচিতি', NULL, 15, '2018-01-30 22:20:20', '2018-01-30 22:20:20'),
(143, '৯ম', ' বাংলাদেশের প্রবীণ ব্যাক্তি ও নারী অধিকার', NULL, 15, '2018-01-30 22:20:20', '2018-01-30 22:20:20'),
(144, '১০ম', 'বাংলাদেশের সামাজিক সমস্যা', NULL, 15, '2018-01-30 22:20:20', '2018-01-30 22:20:20'),
(145, '১১তম', 'এশিয়ার কয়েকটি দেশ', NULL, 15, '2018-01-30 22:20:20', '2018-01-30 22:20:20'),
(146, '১2তম', 'বাংলাদেশ ও আন্তর্জাতিক সহযোগিতা', NULL, 15, '2018-01-30 22:20:20', '2018-01-30 22:20:20'),
(147, '১ম', 'নিম্নশ্রেণির জীব', NULL, 16, '2018-01-30 22:22:57', '2018-01-30 22:22:57'),
(148, '২য়', 'উদ্ভিদ ও প্রাণীর কোষীয় সংগঠন', NULL, 16, '2018-01-30 22:22:57', '2018-01-30 22:22:57'),
(149, '৩য়', 'উদ্ভিদের বাহ্যিক বৈশিষ্ট্য', NULL, 16, '2018-01-30 22:22:57', '2018-01-30 22:22:57'),
(150, '৪র্থ', 'শ্বষন', NULL, 16, '2018-01-30 22:22:57', '2018-01-30 22:22:57'),
(151, '৫ম', 'পরিপাকতন্ত্র এবং রক্ত সংবহনতন্ত্র', NULL, 16, '2018-01-30 22:22:57', '2018-01-30 22:22:57'),
(152, '৬ষ্ঠ', 'পদার্থের গঠন', NULL, 16, '2018-01-30 22:22:57', '2018-01-30 22:22:57'),
(153, '৭ম', 'শক্তির ব্যবহার', NULL, 16, '2018-01-30 22:22:57', '2018-01-30 22:22:57'),
(154, '৮ম', 'শব্দের কথা', NULL, 16, '2018-01-30 22:22:57', '2018-01-30 22:22:57'),
(155, '৯ম', 'তাপ ও তাপমাত্রা', NULL, 16, '2018-01-30 22:22:57', '2018-01-30 22:22:57'),
(156, '১০ম', 'বিদ্যুৎ ও চুম্বকের ঘটনা', NULL, 16, '2018-01-30 22:22:57', '2018-01-30 22:22:57'),
(157, '১১তম', 'পারিপার্শ্বিক পরিবর্তন ও বিভিন্ন ঘটনা', NULL, 16, '2018-01-30 22:22:57', '2018-01-30 22:22:57'),
(158, '১2তম', 'সৌরজগৎ ও আমাদে পৃথিবী', NULL, 16, '2018-01-30 22:22:57', '2018-01-30 22:22:57'),
(159, '১৩তম', 'প্রাকৃতিক পরিবেশ এবং দূষণ', NULL, 16, '2018-01-30 22:22:57', '2018-01-30 22:22:57'),
(160, '১৪তম', 'জলবায়ূ পরিবর্তন', NULL, 16, '2018-01-30 22:22:57', '2018-01-30 22:22:57'),
(161, '১ম', 'আকাইদ', NULL, 17, '2018-01-30 22:24:43', '2018-01-30 22:24:43'),
(162, '২য়', 'ইবাদত', NULL, 17, '2018-01-30 22:24:43', '2018-01-30 22:24:43'),
(163, '৩য়', 'কুরআন ও হাদিস শিক্ষা', NULL, 17, '2018-01-30 22:24:43', '2018-01-30 22:24:43'),
(164, '৪র্থ', 'আখলাক', NULL, 17, '2018-01-30 22:24:43', '2018-01-30 22:24:43'),
(165, '৫ম', 'আদর্শ জীবনচরিত', NULL, 17, '2018-01-30 22:24:43', '2018-01-30 22:24:43'),
(166, '১ম', 'ঈশ্বরের স্বরূপ', NULL, 18, '2018-01-30 22:26:28', '2018-01-30 22:26:28'),
(167, '২য়', 'ধর্মগ্রন্থ', NULL, 18, '2018-01-30 22:26:28', '2018-01-30 22:26:28'),
(168, '৩য়', 'হিন্দুধর্মের স্বরূপ ও বিশ্বাস', NULL, 18, '2018-01-30 22:26:28', '2018-01-30 22:26:28'),
(169, '৪র্থ', 'নিত্যকর্ম ও যোগাসন', NULL, 18, '2018-01-30 22:26:28', '2018-01-30 22:26:28'),
(170, '৫ম', 'দেব-দেবী ও পূজ-পার্বণ', NULL, 18, '2018-01-30 22:26:28', '2018-01-30 22:26:28'),
(171, '৬ষ্ঠ', 'ধর্মীয় উপাখ্যানে নৈতিক শিক্ষা', NULL, 18, '2018-01-30 22:26:28', '2018-01-30 22:26:28'),
(172, '৭ম', 'আদর্শ জীবনচরিত', NULL, 18, '2018-01-30 22:26:28', '2018-01-30 22:26:28'),
(173, '৮ম', 'হিন্দুধর্ম ও নৈতিক মূল্যবোধ', NULL, 18, '2018-01-30 22:26:28', '2018-01-30 22:26:28'),
(174, '১ম', 'গৌতম বুদ্ধের নৈতিক শিক্ষা', NULL, 19, '2018-01-30 22:28:30', '2018-01-30 22:28:30'),
(175, '২য়', 'বন্দনা', NULL, 19, '2018-01-30 22:28:30', '2018-01-30 22:28:30'),
(176, '৩য়', 'শীল', NULL, 19, '2018-01-30 22:28:30', '2018-01-30 22:28:30'),
(177, '৪র্থ', 'দান', NULL, 19, '2018-01-30 22:28:30', '2018-01-30 22:28:30'),
(178, '৫ম', 'সূত্র ও নীতিগাথা', NULL, 19, '2018-01-30 22:28:30', '2018-01-30 22:28:30'),
(179, '৬ষ্ঠ', 'আর্য অষ্টাঙ্গিক মার্গ', NULL, 19, '2018-01-30 22:28:30', '2018-01-30 22:28:30'),
(180, '৭ম', 'ধর্মীয় আচার অনুষ্ঠান ও উৎসব', NULL, 19, '2018-01-30 22:28:30', '2018-01-30 22:28:30'),
(181, '৮ম', 'চরিতমালা', NULL, 19, '2018-01-30 22:28:30', '2018-01-30 22:28:30'),
(182, '৯ম', 'জাতক', NULL, 19, '2018-01-30 22:28:30', '2018-01-30 22:28:30'),
(183, '১০ম', 'বৌদ্ধ ঐতিহ্য ও দর্শনীয় স্থান', NULL, 19, '2018-01-30 22:28:30', '2018-01-30 22:28:30'),
(184, '১১তম', 'বৌদ্ধধর্মে রাজন্যবর্গের অবদানঃ সম্রাট অশোক ', NULL, 19, '2018-01-30 22:28:30', '2018-01-30 22:28:30'),
(185, '১ম', 'ঈশ্বরের অদ্বিতীইয় পুত্র যীশু খ্রিষ্ট', NULL, 20, '2018-01-30 22:30:19', '2018-01-30 22:30:19'),
(186, '২য়', 'ঈশ্বরের সৃষ্টি উত্তম', NULL, 20, '2018-01-30 22:30:19', '2018-01-30 22:30:19'),
(187, '৩য়', 'দেহ, মন ও আত্মাসম্পন্ন মানুষ', NULL, 20, '2018-01-30 22:30:19', '2018-01-30 22:30:19'),
(188, '৪র্থ', 'পাপ', NULL, 20, '2018-01-30 22:30:19', '2018-01-30 22:30:19'),
(189, '৫ম', 'মুক্তিদাতা যীশুর জীবন ও কাজ', NULL, 20, '2018-01-30 22:30:19', '2018-01-30 22:30:19'),
(190, '৬ষ্ঠ', 'ঈশ্বরের আহবানে মারীয়ার সাড়াদান', NULL, 20, '2018-01-30 22:30:19', '2018-01-30 22:30:19'),
(191, '৭ম', 'যীশুর আশ্চর্য কাজ ও ঐশরাজ্য', NULL, 20, '2018-01-30 22:30:19', '2018-01-30 22:30:19'),
(192, '৮ম', 'খ্রিষ্টমণ্ডলী এক, পবিত্র ও প্রৈরিতিক', NULL, 20, '2018-01-30 22:30:19', '2018-01-30 22:30:19'),
(193, '৯ম', 'ক্ষমা, সহনশীলতা ও দেশপ্রেম', NULL, 20, '2018-01-30 22:30:19', '2018-01-30 22:30:19'),
(194, '১০ম', 'ফাদার চার্লস যোসেফ ইয়াং', NULL, 20, '2018-01-30 22:30:19', '2018-01-30 22:30:19'),
(195, '২য়', 'ভাব ও কাজ', NULL, 13, '2018-01-31 07:14:38', '2018-01-31 07:14:38'),
(196, '৩য়', 'পড়ে পাওয়া', NULL, 13, '2018-01-31 07:14:38', '2018-01-31 07:14:38'),
(197, '৪র্থ', 'তৈলচিত্রের ভূত', NULL, 13, '2018-01-31 07:14:38', '2018-01-31 07:14:38'),
(198, '৫ম', 'এবারের সংগ্রাম স্বাধীনতার সংগ্রাম', NULL, 13, '2018-01-31 07:14:38', '2018-01-31 07:14:38'),
(199, '৬ষ্ঠ', 'আমাদের লোকশিল্প', NULL, 13, '2018-01-31 07:14:38', '2018-01-31 07:14:38'),
(200, '৭ম', 'সুখী মানুষ', NULL, 13, '2018-01-31 07:14:38', '2018-01-31 07:14:38'),
(201, '৮ম', 'শিল্পকলার নানাদিক', NULL, 13, '2018-01-31 07:14:38', '2018-01-31 07:14:38'),
(202, '৯ম', 'মংডুর পথে', NULL, 13, '2018-01-31 07:14:38', '2018-01-31 07:14:38'),
(203, '১০ম', 'বাংলা নববর্ষ', NULL, 13, '2018-01-31 07:14:38', '2018-01-31 07:14:38'),
(204, '১১তম', 'বাংলা ভাষার জন্মকথা', NULL, 13, '2018-01-31 07:14:38', '2018-01-31 07:14:38'),
(205, '১২তম', 'মানবধর্ম', NULL, 13, '2018-01-31 07:14:38', '2018-01-31 07:14:38'),
(206, '১৩তম', 'বঙ্গভূমির প্রতি', NULL, 13, '2018-01-31 07:14:38', '2018-01-31 07:14:38'),
(207, '১৪তম', 'দুই বিঘা জমি', NULL, 13, '2018-01-31 07:14:38', '2018-01-31 07:14:38'),
(208, '১৫তম', 'পাছে লোকে কিছু বলে', NULL, 13, '2018-01-31 07:14:38', '2018-01-31 07:14:38'),
(209, '১৬তম', 'প্রার্থনা', NULL, 13, '2018-01-31 07:14:38', '2018-01-31 07:14:38'),
(210, '১৭তম', 'বাবুরের মহত্ত্ব', NULL, 13, '2018-01-31 07:14:38', '2018-01-31 07:14:38'),
(211, '১৮তম', 'নারী', NULL, 13, '2018-01-31 07:14:38', '2018-01-31 07:14:38'),
(212, '১৯তম', 'আবার আসিব ফিরে', NULL, 13, '2018-01-31 07:14:38', '2018-01-31 07:14:38'),
(213, '২১তম', 'রুপাই', NULL, 13, '2018-01-31 07:14:38', '2018-01-31 07:14:38'),
(214, '২২তম', 'নদীর স্বপ্ন', NULL, 13, '2018-01-31 07:14:38', '2018-01-31 07:14:38'),
(215, '২৩তম', 'জাগো তবে অরণ্য কন্যারা', NULL, 13, '2018-01-31 07:14:38', '2018-01-31 07:14:38'),
(216, '২৪তম', 'প্রার্থী', NULL, 13, '2018-01-31 07:14:38', '2018-01-31 07:14:38'),
(217, '২৫তম', 'একুশের গান', NULL, 13, '2018-01-31 07:14:38', '2018-01-31 07:14:38'),
(218, '১ম', 'প্যাটার্ন', NULL, 21, '2018-01-31 07:16:51', '2018-01-31 07:16:51'),
(219, '২য়', 'মুনাফা', NULL, 21, '2018-01-31 07:16:51', '2018-01-31 07:16:51'),
(220, '৩য়', 'পরিমাপ', NULL, 21, '2018-01-31 07:16:51', '2018-01-31 07:16:51'),
(221, '৪র্থ', 'বীজগণিতীয় সূত্রাবলি ও প্রয়োগ', NULL, 21, '2018-01-31 07:16:51', '2018-01-31 07:16:51'),
(222, '৫ম', 'বীজগণিতীয় ভগ্নাংশ', NULL, 21, '2018-01-31 07:16:51', '2018-01-31 07:16:51'),
(223, '৬ষ্ঠ', 'সরল সহসমীকরণ', NULL, 21, '2018-01-31 07:16:51', '2018-01-31 07:16:51'),
(224, '৭ম', 'সেট', NULL, 21, '2018-01-31 07:16:51', '2018-01-31 07:16:51'),
(225, '৮ম', 'চতুর্ভূজ', NULL, 21, '2018-01-31 07:16:51', '2018-01-31 07:16:51'),
(226, '৯ম', 'পিথাগোরাসের উপপাদ্য', NULL, 21, '2018-01-31 07:16:51', '2018-01-31 07:16:51'),
(227, '১০ম', 'বৃত্ত', NULL, 21, '2018-01-31 07:16:51', '2018-01-31 07:16:51'),
(228, '১১তম', 'তথ্য ও উপাত্ত', NULL, 21, '2018-01-31 07:16:51', '2018-01-31 07:16:51'),
(229, '১ম', 'ঔপনিবেশিক যুগ ও বাংলার স্বাধীনতা সংগ্রাম', NULL, 22, '2018-01-31 07:19:29', '2018-01-31 07:19:29'),
(230, '২য়', 'বাংলাদেশের মুক্তিযুদ্ধ', NULL, 22, '2018-01-31 07:19:29', '2018-01-31 07:19:29'),
(231, '৩য়', 'বাংলাদেশের সাংস্কৃতক পরিবর্তন ও উন্নয়ন', NULL, 22, '2018-01-31 07:19:29', '2018-01-31 07:19:29'),
(232, '৪র্থ', 'ঔপনিবেশিক যুগের প্রত্নতাত্তিক ঐতিহ্য', NULL, 22, '2018-01-31 07:19:29', '2018-01-31 07:19:29'),
(233, '৫ম', 'সামাজিকীকরণ ও উন্নয়ন', NULL, 22, '2018-01-31 07:19:29', '2018-01-31 07:19:29'),
(234, '৬ষ্ঠ', 'বাংলাদেশের অর্থনীতি', NULL, 22, '2018-01-31 07:19:29', '2018-01-31 07:19:29'),
(235, '৭ম', 'বাংলাদেশঃ রাস্ট্র ও সরকার ব্যবস্থা', NULL, 22, '2018-01-31 07:19:29', '2018-01-31 07:19:29'),
(236, '৮ম', 'বাংলাদেশের দূর্যোগ', NULL, 22, '2018-01-31 07:19:29', '2018-01-31 07:19:29'),
(237, '৯ম', 'বাংলাদেশের জনসংখ্যা ও উন্নয়ন', NULL, 22, '2018-01-31 07:19:29', '2018-01-31 07:19:29'),
(238, '১০ম', 'বাংলাদেশের সামাজিক সমস্যা', NULL, 22, '2018-01-31 07:19:29', '2018-01-31 07:19:29'),
(239, '১১তম', 'বাংলাদেশের বিভিন্ন নৃগোষ্ঠী', NULL, 22, '2018-01-31 07:19:29', '2018-01-31 07:19:29'),
(240, '১২তম', 'বাংলাদেশের প্রাকৃতিক সম্পদ', NULL, 22, '2018-01-31 07:19:29', '2018-01-31 07:19:29'),
(241, '১৩তম', 'বাংলাদেশ এবং বিভিন্ন আন্তর্জাতিক ও আঞ্চলিক সহযোগী সংস্থা', NULL, 22, '2018-01-31 07:19:29', '2018-01-31 07:19:29'),
(242, '১ম', 'প্রানিজগতের শ্রেনিবিন্যাস', NULL, 23, '2018-01-31 07:23:14', '2018-01-31 07:23:14'),
(243, '২য়', 'জীবের বৃদ্ধি ও বংশগতি', NULL, 23, '2018-01-31 07:23:14', '2018-01-31 07:23:14'),
(244, '৩য়', 'ব্যাপন, অভিস্রবণ ও প্রস্বেদন', NULL, 23, '2018-01-31 07:23:14', '2018-01-31 07:23:14'),
(245, '৪র্থ', 'উদ্ভিদে বংশ বৃদ্ধি', NULL, 23, '2018-01-31 07:23:14', '2018-01-31 07:23:14'),
(246, '৫ম', 'সমন্বয় ও নিঃসরণ', NULL, 23, '2018-01-31 07:23:14', '2018-01-31 07:23:14'),
(247, '৬ষ্ঠ', 'পরমাণুর গঠন', NULL, 23, '2018-01-31 07:23:14', '2018-01-31 07:23:14'),
(248, '৭ম', 'পৃথিবী ও মহাকর্ষ', NULL, 23, '2018-01-31 07:23:14', '2018-01-31 07:23:14'),
(249, '৮ম', 'রাসায়নিক বিক্রিয়া', NULL, 23, '2018-01-31 07:23:14', '2018-01-31 07:23:14'),
(250, '৯ম', 'বর্তনী ও চলবিদ্যুৎ', NULL, 23, '2018-01-31 07:23:14', '2018-01-31 07:23:14'),
(251, '১০ম', 'অম্ল, ক্ষারক ও লবণ', NULL, 23, '2018-01-31 07:23:14', '2018-01-31 07:23:14'),
(252, '১১তম', 'আলো', NULL, 23, '2018-01-31 07:23:14', '2018-01-31 07:23:14'),
(253, '১২তম', 'মহাকাশ ও উপগ্রহ', NULL, 23, '2018-01-31 07:23:14', '2018-01-31 07:23:14'),
(254, '১৩তম', 'খাদ্য ও পুষ্টি', NULL, 23, '2018-01-31 07:23:14', '2018-01-31 07:23:14'),
(255, '১৪তম', 'পরিবেশ ও বাস্তুতন্ত্র', NULL, 23, '2018-01-31 07:23:14', '2018-01-31 07:23:14'),
(256, '১ম', 'আকাইদ', NULL, 24, '2018-01-31 07:24:32', '2018-01-31 07:24:32'),
(257, '২য়', 'ইবাদত', NULL, 24, '2018-01-31 07:24:32', '2018-01-31 07:24:32'),
(258, '৩য়', 'কুরআন ও হাদিস শিক্ষা', NULL, 24, '2018-01-31 07:24:32', '2018-01-31 07:24:32'),
(259, '৪র্থ', 'আখলাক', NULL, 24, '2018-01-31 07:24:32', '2018-01-31 07:24:32'),
(260, '৫ম', 'আদর্শ জীবনচরিত', NULL, 24, '2018-01-31 07:24:32', '2018-01-31 07:24:32'),
(261, '১ম', 'ঈস্বরের স্বরূপ', NULL, 25, '2018-01-31 07:26:46', '2018-01-31 07:26:46'),
(262, '২য়', 'ধর্মগ্রন্থ', NULL, 25, '2018-01-31 07:26:46', '2018-01-31 07:26:46'),
(263, '৩য়', 'হিন্দুধর্মের স্বরূপ ও বিশ্বাস', NULL, 25, '2018-01-31 07:26:46', '2018-01-31 07:26:46'),
(264, '৪র্থ', 'নিত্যকর্ম ও যোগাসন', NULL, 25, '2018-01-31 07:26:46', '2018-01-31 07:26:46'),
(265, '৫ম', 'দেব-দেবী ও পূজা-পার্বণ', NULL, 25, '2018-01-31 07:26:46', '2018-01-31 07:26:46'),
(266, '৬ষ্ঠ', 'ধর্মীয় উপাখ্যানে নৈতিক শিক্ষা', NULL, 25, '2018-01-31 07:26:46', '2018-01-31 07:26:46'),
(267, '৭ম', 'আদর্শ জীবনচরিত', NULL, 25, '2018-01-31 07:26:46', '2018-01-31 07:26:46'),
(268, '৮ম', 'হিন্দুধর্ম ও নৈতিক মূল্যবোধ', NULL, 25, '2018-01-31 07:26:46', '2018-01-31 07:26:46'),
(269, '১ম', 'গৌতম বুদ্ধের সাম্যনীতি', NULL, 26, '2018-01-31 07:28:32', '2018-01-31 07:28:32'),
(270, '২য়', 'বন্দনা', NULL, 26, '2018-01-31 07:28:32', '2018-01-31 07:28:32'),
(271, '৩য়', 'শীল', NULL, 26, '2018-01-31 07:28:32', '2018-01-31 07:28:32'),
(272, '৪র্থ', 'দান', NULL, 26, '2018-01-31 07:28:32', '2018-01-31 07:28:32'),
(273, '৫ম', 'সূত্র ও নীতিগাথা', NULL, 26, '2018-01-31 07:28:32', '2018-01-31 07:28:32'),
(274, '৬ষ্ঠ', 'পারমী', NULL, 26, '2018-01-31 07:28:32', '2018-01-31 07:28:32'),
(275, '৭ম', 'ধর্মীয় আচার অনুষ্ঠান ও উৎসব', NULL, 26, '2018-01-31 07:28:32', '2018-01-31 07:28:32'),
(276, '৮ম', 'চরিতমালা', NULL, 26, '2018-01-31 07:28:32', '2018-01-31 07:28:32'),
(277, '৯ম', 'জাতক', NULL, 26, '2018-01-31 07:28:32', '2018-01-31 07:28:32'),
(278, '১০ম', 'বৌদ্ধ তীর্থস্থান', NULL, 26, '2018-01-31 07:28:32', '2018-01-31 07:28:32'),
(279, '১১তম', 'বৌদ্ধধর্মে রাজন্যবর্গের অবদানঃ সম্রাট কণিষ্ক', NULL, 26, '2018-01-31 07:28:32', '2018-01-31 07:28:32'),
(280, '১ম', 'মুক্তির পথে আহবান', NULL, 27, '2018-01-31 07:31:23', '2018-01-31 07:31:23'),
(281, '২য়', 'স্বাধীনতা ও আমি', NULL, 27, '2018-01-31 07:31:23', '2018-01-31 07:31:23'),
(282, '৩য়', 'আমার স্বাধীনতা ও সমাজ', NULL, 27, '2018-01-31 07:31:23', '2018-01-31 07:31:23'),
(283, '৪র্থ', 'স্বাধীনতায় বেড়ে ওঠা', NULL, 27, '2018-01-31 07:31:23', '2018-01-31 07:31:23'),
(284, '৫ম', 'স্বাধীনতা ও বাধ্যতা', NULL, 27, '2018-01-31 07:31:23', '2018-01-31 07:31:23'),
(285, '৬ষ্ঠ', 'বিশ্বস্ত বন্ধু', NULL, 27, '2018-01-31 07:31:23', '2018-01-31 07:31:23'),
(286, '৭ম', 'পুরুষ ও নারী', NULL, 27, '2018-01-31 07:31:23', '2018-01-31 07:31:23'),
(287, '৮ম', 'স্বাধীনতা ও জীবনাহবান', NULL, 27, '2018-01-31 07:31:23', '2018-01-31 07:31:23'),
(288, '৯ম', 'পিতার সম্মুখে', NULL, 27, '2018-01-31 07:31:23', '2018-01-31 07:31:23'),
(289, '১০ম', 'অসুস্থ বিশ্বের নিরাময়', NULL, 27, '2018-01-31 07:31:23', '2018-01-31 07:31:23'),
(290, '১১তম', 'বিবেকের নীরব কণ্ঠস্বর', NULL, 27, '2018-01-31 07:31:23', '2018-01-31 07:31:23'),
(291, '১২তম', 'হৃদয়ের তীব্র যন্ত্রণা', NULL, 27, '2018-01-31 07:31:23', '2018-01-31 07:31:23'),
(292, '১৩তম', 'সহিংসতা ও শান্তি', NULL, 27, '2018-01-31 07:31:23', '2018-01-31 07:31:23'),
(293, '১৪তম', 'পরিবর্তিত বিশ্ব চাই', NULL, 27, '2018-01-31 07:31:23', '2018-01-31 07:31:23'),
(294, '১৫তম', 'আমাদের মুক্তির পথ', NULL, 27, '2018-01-31 07:31:23', '2018-01-31 07:31:23'),
(295, '১ম', 'প্রত্যুপকার', NULL, 28, '2018-01-31 07:44:08', '2018-01-31 07:44:08'),
(296, '২য়', 'সুভা', NULL, 28, '2018-01-31 07:44:08', '2018-01-31 07:44:08'),
(297, '৩য়', 'লাইব্রেরী', NULL, 28, '2018-01-31 07:44:08', '2018-01-31 07:44:08'),
(298, '৪র্থ', 'বই পড়া', NULL, 28, '2018-01-31 07:44:08', '2018-01-31 07:44:08'),
(299, '৫ম', 'পল্লিসাহিত্য', NULL, 28, '2018-01-31 07:44:08', '2018-01-31 07:44:08'),
(300, '৬ষ্ঠ', 'উদ্যম ও পরিশ্রম', NULL, 28, '2018-01-31 07:44:08', '2018-01-31 07:44:08'),
(301, '৭ম', 'মানুষ মুহাম্মদ (স)', NULL, 28, '2018-01-31 07:44:08', '2018-01-31 07:44:08'),
(302, '৮ম', 'নিমগাছ', NULL, 28, '2018-01-31 07:44:08', '2018-01-31 07:44:08'),
(303, '৯ম', 'শিক্ষা ও মনুষ্যত্ব', NULL, 28, '2018-01-31 07:44:08', '2018-01-31 07:44:08'),
(304, '১০ম', 'মমতাদি', NULL, 28, '2018-01-31 07:44:08', '2018-01-31 07:44:08'),
(305, '১১তম', 'একাত্তরের দিনগুলি', NULL, 28, '2018-01-31 07:44:08', '2018-01-31 07:44:08'),
(306, '১২তম', 'বাঁধ', NULL, 28, '2018-01-31 07:44:08', '2018-01-31 07:44:08'),
(307, '১৩তম', 'রক্তে ভেজা একুশ', NULL, 28, '2018-01-31 07:44:08', '2018-01-31 07:44:08'),
(308, '১৪তম', 'তথ্য প্রযুক্তি', NULL, 28, '2018-01-31 07:44:08', '2018-01-31 07:44:08'),
(309, '১৫তম', 'বন্দনা', NULL, 28, '2018-01-31 07:44:08', '2018-01-31 07:44:08'),
(310, '১৬তম', 'বঙ্গবাণী', NULL, 28, '2018-01-31 07:44:08', '2018-01-31 07:44:08'),
(311, '১৭তম', 'কপোতাক্ষ নদ', NULL, 28, '2018-01-31 07:44:08', '2018-01-31 07:44:08'),
(312, '১৮তম', 'জুতা-আবিষ্কার', NULL, 28, '2018-01-31 07:44:08', '2018-01-31 07:44:08'),
(313, '১৯তম', 'জীবন বিনিময়', NULL, 28, '2018-01-31 07:44:08', '2018-01-31 07:44:08'),
(314, '২০তম', 'উমর ফারুক', NULL, 28, '2018-01-31 07:44:08', '2018-01-31 07:44:08'),
(315, '২১তম', 'পল্লিজননী', NULL, 28, '2018-01-31 07:44:08', '2018-01-31 07:44:08'),
(316, '২২তম', 'আশা', NULL, 28, '2018-01-31 07:44:08', '2018-01-31 07:44:08'),
(317, '২৩তম', 'তোমাকে পাওয়ার জন্যে, হে স্বাধীনতা', NULL, 28, '2018-01-31 07:44:08', '2018-01-31 07:44:08'),
(318, '২৪তম', 'অবাক সূর্যোদয়', NULL, 28, '2018-01-31 07:44:08', '2018-01-31 07:44:08'),
(319, '২৫তম', 'সাহসী জননী বাংলা', NULL, 28, '2018-01-31 07:44:08', '2018-01-31 07:44:08'),
(320, '২৬তম', 'মিছিল', NULL, 28, '2018-01-31 07:44:08', '2018-01-31 07:44:08'),
(321, '১ম', 'বাস্তব সংখ্যা', NULL, 29, '2018-01-31 07:48:06', '2018-01-31 07:48:06'),
(322, '২য়', 'সেট ও ফাংশন', NULL, 29, '2018-01-31 07:48:06', '2018-01-31 07:48:06'),
(323, '৩য়', 'বীজগণিতিক রাশি', NULL, 29, '2018-01-31 07:48:06', '2018-01-31 07:48:06'),
(324, '৪র্থ', 'সূচক ও লগারিদম', NULL, 29, '2018-01-31 07:48:06', '2018-01-31 07:48:06'),
(325, '৫ম', 'এক চলকবিশিষ্ট সমীকরণ', NULL, 29, '2018-01-31 07:48:06', '2018-01-31 07:48:06'),
(326, '৬ষ্ঠ', 'রেখা, কোণ ও ত্রিভূজ', NULL, 29, '2018-01-31 07:48:06', '2018-01-31 07:48:06'),
(327, '৭ম', 'ব্যবহারিক জ্যামিতি', NULL, 29, '2018-01-31 07:48:06', '2018-01-31 07:48:06'),
(328, '৮ম', 'বৃত্ত', NULL, 29, '2018-01-31 07:48:06', '2018-01-31 07:48:06'),
(329, '৯ম', 'ত্রিকোণমিতিক অনুপাত', NULL, 29, '2018-01-31 07:48:06', '2018-01-31 07:48:06'),
(330, '১০ম', 'দূরত্ব ও উচ্চতা', NULL, 29, '2018-01-31 07:48:06', '2018-01-31 07:48:06'),
(331, '১১তম', 'বীজগাণিতিক অনুপাত ও সমানুপাত', NULL, 29, '2018-01-31 07:48:06', '2018-01-31 07:48:06'),
(332, '১২তম', 'দুই চলকবিশিষ্ট সরল সহসমীকরণ', NULL, 29, '2018-01-31 07:48:06', '2018-01-31 07:48:06'),
(333, '১৩তম', 'সসীম ধারা', NULL, 29, '2018-01-31 07:48:06', '2018-01-31 07:48:06'),
(334, '১৪তম', 'অনুপাত, সদৃশতা ও প্রতিসমতা', NULL, 29, '2018-01-31 07:48:06', '2018-01-31 07:48:06'),
(335, '১৫তম', 'ক্ষেত্রফল সম্পর্কিত উপপাদ্য ও সম্পাদ্য', NULL, 29, '2018-01-31 07:48:06', '2018-01-31 07:48:06'),
(336, '১৬তম', 'পরিমিতি', NULL, 29, '2018-01-31 07:48:06', '2018-01-31 07:48:06'),
(337, '১৭তম', 'পরিসংখ্যান', NULL, 29, '2018-01-31 07:48:06', '2018-01-31 07:48:06'),
(338, '১ম', 'পূর্ব বাংলার আন্দোলন ও জাতীয়তাবাদের উত্থান', NULL, 30, '2018-01-31 07:51:31', '2018-01-31 07:51:31'),
(339, '২য়', 'স্বাধীন বাংলাদেশ', NULL, 30, '2018-01-31 07:51:31', '2018-01-31 07:51:31'),
(340, '৩য়', 'সৌরজগৎ ও ভূমন্ডল', NULL, 30, '2018-01-31 07:51:31', '2018-01-31 07:51:31'),
(341, '৪র্থ', 'বাংলাদেশের ভূপ্রকৃতি ও জলবায়ূ', NULL, 30, '2018-01-31 07:51:31', '2018-01-31 07:51:31'),
(342, '৫ম', 'বাংলাদেশের নদ-নদী ও প্রাকৃতিক সম্পদ', NULL, 30, '2018-01-31 07:51:31', '2018-01-31 07:51:31'),
(343, '৬ষ্ঠ', 'রাষ্ট্র, নাগরিকতা ও আইন', NULL, 30, '2018-01-31 07:51:31', '2018-01-31 07:51:31'),
(344, '৭ম', 'বাংলাদেশ সরকারের বিভিন্ন অঙ্গ ও প্রশাসন ব্যবস্থা', NULL, 30, '2018-01-31 07:51:31', '2018-01-31 07:51:31'),
(345, '৮ম', 'বাংলাদেশের গণতন্ত্র ও নির্বাচন', NULL, 30, '2018-01-31 07:51:31', '2018-01-31 07:51:31'),
(346, '৯ম', 'জাতিসংঘ ও বাংলাদেশ', NULL, 30, '2018-01-31 07:51:31', '2018-01-31 07:51:31'),
(347, '১০ম', 'জাতীয় সম্পদ ও অর্থনৈতিক ব্যবস্থা', NULL, 30, '2018-01-31 07:51:31', '2018-01-31 07:51:31'),
(348, '১১তম', 'অর্থনৈতিক নির্দেশকসমূহ ও বাংলাদেশের অর্থনীতির প্রকৃতি', NULL, 30, '2018-01-31 07:51:31', '2018-01-31 07:51:31'),
(349, '১২তম', 'বাংলাদেশ সরকারের অর্থ ও ব্যাংক ব্যবস্থা', NULL, 30, '2018-01-31 07:51:31', '2018-01-31 07:51:31'),
(350, '১৩তম', 'বাংলাদেশের পরিবার কাঠামো ও সামাজিকীকরণ', NULL, 30, '2018-01-31 07:51:31', '2018-01-31 07:51:31'),
(351, '১৪তম', 'বাংলাদেশের সামাজিক পরিবর্তন', NULL, 30, '2018-01-31 07:51:31', '2018-01-31 07:51:31'),
(352, '১৫তম', 'বাংলাদেশের সামাজিক সমস্যা ও এর প্রতিকার', NULL, 30, '2018-01-31 07:51:31', '2018-01-31 07:51:31'),
(353, '১ম', 'উন্নতর জীবনধারা', NULL, 31, '2018-01-31 07:53:38', '2018-01-31 07:53:38'),
(354, '২য়', 'জীবনের জন্য পানি', NULL, 31, '2018-01-31 07:53:38', '2018-01-31 07:53:38'),
(355, '৩য়', 'হৃদযন্ত্রের কথা', NULL, 31, '2018-01-31 07:53:38', '2018-01-31 07:53:38'),
(356, '৪র্থ', 'নবজীবনের সূচনা', NULL, 31, '2018-01-31 07:53:38', '2018-01-31 07:53:38'),
(357, '৫ম', 'দেখতে হলে আলো চাই', NULL, 31, '2018-01-31 07:53:38', '2018-01-31 07:53:38'),
(358, '৬ষ্ঠ', 'পলিমার', NULL, 31, '2018-01-31 07:53:38', '2018-01-31 07:53:38'),
(359, '৭ম', 'অম্ল, ক্ষারক ও লবণের ব্যাবহার', NULL, 31, '2018-01-31 07:53:38', '2018-01-31 07:53:38'),
(360, '৮ম', 'আমাদের সম্পদ', NULL, 31, '2018-01-31 07:53:38', '2018-01-31 07:53:38'),
(361, '৯ম', 'দুর্যোগের সাথে বসবাস', NULL, 31, '2018-01-31 07:53:38', '2018-01-31 07:53:38'),
(362, '১০ম', 'এসো বলকে জানি', NULL, 31, '2018-01-31 07:53:38', '2018-01-31 07:53:38'),
(363, '১১তম', 'জীবপ্রযুক্তি', NULL, 31, '2018-01-31 07:53:38', '2018-01-31 07:53:38'),
(364, '১২তম', 'প্রাত্যহিক জীবনে তড়িৎ', NULL, 31, '2018-01-31 07:53:38', '2018-01-31 07:53:38'),
(365, '১৩তম', 'সাবাই কাছাকাছি', NULL, 31, '2018-01-31 07:53:38', '2018-01-31 07:53:38'),
(366, '১৪তম', 'জীবন  বাঁচাতে বিজ্ঞান', NULL, 31, '2018-01-31 07:53:38', '2018-01-31 07:53:38'),
(367, '১ম', 'আকাইদ ও নৈতিক জীবন', NULL, 32, '2018-01-31 07:54:59', '2018-01-31 07:54:59'),
(368, '২য়', 'শরিয়তের উৎস', NULL, 32, '2018-01-31 07:54:59', '2018-01-31 07:54:59'),
(369, '৩য়', 'ইবাদত', NULL, 32, '2018-01-31 07:54:59', '2018-01-31 07:54:59'),
(370, '৪র্থ', 'আখলাক', NULL, 32, '2018-01-31 07:54:59', '2018-01-31 07:54:59'),
(371, '৫ম', 'আদর্শ জীবনচরিত', NULL, 32, '2018-01-31 07:54:59', '2018-01-31 07:54:59'),
(372, '১ম', 'স্রষ্টা ও সৃষ্টি', NULL, 33, '2018-01-31 07:56:12', '2018-01-31 07:56:12'),
(373, '২য়', 'হিন্দুধর্মের বিশ্বাস, উৎপত্তি ও বিকাশ', NULL, 33, '2018-01-31 07:56:12', '2018-01-31 07:56:12'),
(374, '৩য়', 'ধর্মীয় আচার-অনুষ্ঠান', NULL, 33, '2018-01-31 07:56:12', '2018-01-31 07:56:12'),
(375, '৪র্থ', 'হিন্দুধর্মে সংস্কার', NULL, 33, '2018-01-31 07:56:12', '2018-01-31 07:56:12'),
(376, '৫ম', 'দেব-দেবী ও পূজা', NULL, 33, '2018-01-31 07:56:12', '2018-01-31 07:56:12'),
(377, '৬ষ্ঠ', 'যোগসাধনা', NULL, 33, '2018-01-31 07:56:12', '2018-01-31 07:56:12'),
(378, '৭ম', 'ধর্মগ্রন্থে নৈতিক শিক্ষা', NULL, 33, '2018-01-31 07:56:12', '2018-01-31 07:56:12'),
(379, '৮ম', 'ধর্মীয় উপাখ্যান ও নৈতিক শিক্ষা', NULL, 33, '2018-01-31 07:56:12', '2018-01-31 07:56:12'),
(380, '৯ম', 'ধর্মপথ ও আদর্শ জীবন', NULL, 33, '2018-01-31 07:56:12', '2018-01-31 07:56:12'),
(381, '১০ম', 'অবতার ও আদর্শ জীবনচরিত', NULL, 33, '2018-01-31 07:56:12', '2018-01-31 07:56:12'),
(382, '১ম', 'গৌতম বুদ্ধের জীবন ও শিক্ষা', NULL, 34, '2018-01-31 08:00:42', '2018-01-31 08:00:42'),
(383, '২য়', 'বুদ্ধ ও বোধিসত্ত্ব', NULL, 34, '2018-01-31 08:00:42', '2018-01-31 08:00:42'),
(384, '৩য়', 'ত্রিপিটক', NULL, 34, '2018-01-31 08:00:42', '2018-01-31 08:00:42'),
(385, '৪র্থ', 'সূত্র ও নীতিগাথা', NULL, 34, '2018-01-31 08:00:42', '2018-01-31 08:00:42'),
(386, '৫ম', 'বৌদ্ধ কর্মবাদ', NULL, 34, '2018-01-31 08:00:42', '2018-01-31 08:00:42'),
(387, '৬ষ্ঠ', 'অট্ঠকথা', NULL, 34, '2018-01-31 08:00:42', '2018-01-31 08:00:42'),
(388, '৭ম', 'নির্বাণ', NULL, 34, '2018-01-31 08:00:42', '2018-01-31 08:00:42'),
(389, '৮ম', 'সঙ্গীতি', NULL, 34, '2018-01-31 08:00:42', '2018-01-31 08:00:42'),
(390, '৯ম', 'জাতক', NULL, 34, '2018-01-31 08:00:42', '2018-01-31 08:00:42'),
(391, '১০ম', 'চরিতমালা', NULL, 34, '2018-01-31 08:00:42', '2018-01-31 08:00:42'),
(392, '১ম', 'গৌতম বুদ্ধের জীবন ও শিক্ষা', NULL, 34, '2018-01-31 08:00:50', '2018-01-31 08:00:50'),
(393, '২য়', 'বুদ্ধ ও বোধিসত্ত্ব', NULL, 34, '2018-01-31 08:00:50', '2018-01-31 08:00:50'),
(394, '৩য়', 'ত্রিপিটক', NULL, 34, '2018-01-31 08:00:50', '2018-01-31 08:00:50'),
(395, '৪র্থ', 'সূত্র ও নীতিগাথা', NULL, 34, '2018-01-31 08:00:50', '2018-01-31 08:00:50'),
(396, '৫ম', 'বৌদ্ধ কর্মবাদ', NULL, 34, '2018-01-31 08:00:50', '2018-01-31 08:00:50'),
(397, '৬ষ্ঠ', 'অট্ঠকথা', NULL, 34, '2018-01-31 08:00:50', '2018-01-31 08:00:50'),
(398, '৭ম', 'নির্বাণ', NULL, 34, '2018-01-31 08:00:50', '2018-01-31 08:00:50'),
(399, '৮ম', 'সঙ্গীতি', NULL, 34, '2018-01-31 08:00:50', '2018-01-31 08:00:50'),
(400, '৯ম', 'জাতক', NULL, 34, '2018-01-31 08:00:50', '2018-01-31 08:00:50'),
(401, '১০ম', 'চরিতমালা', NULL, 34, '2018-01-31 08:00:50', '2018-01-31 08:00:50'),
(402, '১১তম', 'বৌদ্ধধর্মের ইতিহাস', NULL, 34, '2018-01-31 08:00:50', '2018-01-31 08:00:50'),
(403, '১২তম', 'বৌদ্ধ ভিক্ষু ও গৃহীদের নিত্যকর্ম ও অনুশাসন', NULL, 34, '2018-01-31 08:00:50', '2018-01-31 08:00:50'),
(404, '১ম', 'মুক্তির পথে আহবান', NULL, 35, '2018-01-31 08:02:45', '2018-01-31 08:02:45'),
(405, '২য়', 'স্বাধীনতা ও আমি', NULL, 35, '2018-01-31 08:02:45', '2018-01-31 08:02:45'),
(406, '৩য়', 'আমার স্বাধীনতা ও সমাজ', NULL, 35, '2018-01-31 08:02:45', '2018-01-31 08:02:45'),
(407, '৪র্থ', 'স্বাধীনতায় বেড়ে ওঠা', NULL, 35, '2018-01-31 08:02:45', '2018-01-31 08:02:45'),
(408, '৫ম', 'স্বাধীনতা ও বাধ্যতা', NULL, 35, '2018-01-31 08:02:45', '2018-01-31 08:02:45'),
(409, '৬ষ্ঠ', 'বিশ্বস্ত বন্ধু', NULL, 35, '2018-01-31 08:02:45', '2018-01-31 08:02:45'),
(410, '৭ম', 'পুরুষ ও নারী', NULL, 35, '2018-01-31 08:02:45', '2018-01-31 08:02:45'),
(411, '৮ম', 'স্বাধীনতা ও জীবনাহবান', NULL, 35, '2018-01-31 08:02:45', '2018-01-31 08:02:45'),
(412, '৯ম', 'পিতার সম্মুখে', NULL, 35, '2018-01-31 08:02:45', '2018-01-31 08:02:45'),
(413, '১০ম', 'অসুস্থ বিশ্বের নিরাময়', NULL, 35, '2018-01-31 08:02:45', '2018-01-31 08:02:45'),
(414, '১১তম', 'বিবেকের নীরব কন্ঠস্বর', NULL, 35, '2018-01-31 08:02:45', '2018-01-31 08:02:45'),
(415, '১২তম', 'হৃদয়ের তীব্র যন্ত্রণা', NULL, 35, '2018-01-31 08:02:45', '2018-01-31 08:02:45'),
(416, '১৩তম', 'সহিংসতা ও শান্তি', NULL, 35, '2018-01-31 08:02:45', '2018-01-31 08:02:45'),
(417, '১৪তম', 'পরিবর্তিত বিশ্ব চাই', NULL, 35, '2018-01-31 08:02:45', '2018-01-31 08:02:45'),
(418, '১৫তম', 'আমাদের মুক্তির পথ', NULL, 35, '2018-01-31 08:02:45', '2018-01-31 08:02:45'),
(419, '১ম', 'ভৌত রাশি এবং পরিমাপ', NULL, 36, '2018-01-31 08:07:15', '2018-01-31 08:07:15'),
(420, '২য়', 'গতি', NULL, 36, '2018-01-31 08:07:15', '2018-01-31 08:07:15'),
(421, '৩য়', 'বল', NULL, 36, '2018-01-31 08:07:15', '2018-01-31 08:07:15'),
(422, '৪র্থ', 'কাজ, ক্ষমতা ও শক্তি', NULL, 36, '2018-01-31 08:07:15', '2018-01-31 08:07:15'),
(423, '৫ম', 'পদার্থের অবস্থা ও চাপ', NULL, 36, '2018-01-31 08:07:15', '2018-01-31 08:07:15'),
(424, '৬ষ্ঠ', 'বস্তুর ওপর তাপের প্রভাব', NULL, 36, '2018-01-31 08:07:15', '2018-01-31 08:07:15'),
(425, '৭ম', 'তরঙ্গ ও শব্দ', NULL, 36, '2018-01-31 08:07:15', '2018-01-31 08:07:15'),
(426, '৮ম', 'আলোর প্রতিফলন', NULL, 36, '2018-01-31 08:07:15', '2018-01-31 08:07:15'),
(427, '৯ম', 'আলোর প্রতিসর', NULL, 36, '2018-01-31 08:07:15', '2018-01-31 08:07:15'),
(428, '১০ম', 'স্থির বিদ্যুৎ', NULL, 36, '2018-01-31 08:07:15', '2018-01-31 08:07:15'),
(429, '১১তম', 'চল বিদ্যুৎ', NULL, 36, '2018-01-31 08:07:15', '2018-01-31 08:07:15'),
(430, '১২তম', 'বিদ্যুতের চৌম্বক ক্রিয়া', NULL, 36, '2018-01-31 08:07:15', '2018-01-31 08:07:15'),
(431, '১৩তম', 'আধুনিক পদার্থবিজ্ঞান ও ইলেকট্রনিকস', NULL, 36, '2018-01-31 08:07:15', '2018-01-31 08:07:15'),
(432, '১৪তম', 'জীবন বাঁচাতে পদার্থবিজ্ঞান', NULL, 36, '2018-01-31 08:07:15', '2018-01-31 08:07:15'),
(433, '১ম', 'জীবন পাঠ', NULL, 37, '2018-01-31 08:09:23', '2018-01-31 08:09:23'),
(434, '২য়', 'জীবকোষ ও টিস্যু', NULL, 37, '2018-01-31 08:09:23', '2018-01-31 08:09:23'),
(435, '৩য়', 'কোষ বিভাজন', NULL, 37, '2018-01-31 08:09:23', '2018-01-31 08:09:23'),
(436, '৪র্থ', 'জীবনীশক্তি', NULL, 37, '2018-01-31 08:09:23', '2018-01-31 08:09:23'),
(437, '৫ম', 'খাদ্য, পুষ্টি এবং পরিপাক', NULL, 37, '2018-01-31 08:09:23', '2018-01-31 08:09:23'),
(438, '৬ষ্ঠ', 'জীবে পরিবহন', NULL, 37, '2018-01-31 08:09:23', '2018-01-31 08:09:23'),
(439, '৭ম', 'গ্যাসীয় বিনিময়', NULL, 37, '2018-01-31 08:09:23', '2018-01-31 08:09:23'),
(440, '৮ম', 'রেচন প্রক্রিয়া', NULL, 37, '2018-01-31 08:09:23', '2018-01-31 08:09:23'),
(441, '৯ম', 'দৃঢ়তা প্রদান ও চলন', NULL, 37, '2018-01-31 08:09:23', '2018-01-31 08:09:23'),
(442, '১০ম', 'সমন্বয়', NULL, 37, '2018-01-31 08:09:23', '2018-01-31 08:09:23'),
(443, '১১তম', 'জীবের প্রজনন', NULL, 37, '2018-01-31 08:09:23', '2018-01-31 08:09:23'),
(444, '১২তম', 'জীবের বংশগতি ও বিবর্তন', NULL, 37, '2018-01-31 08:09:23', '2018-01-31 08:09:23'),
(445, '১৩তম', 'জীবের পরিবেশ', NULL, 37, '2018-01-31 08:09:23', '2018-01-31 08:09:23'),
(446, '১৪তম', 'জীবপ্রযুক্তি', NULL, 37, '2018-01-31 08:09:23', '2018-01-31 08:09:23'),
(447, '১ম', 'রসায়নের ধারণা', NULL, 38, '2018-01-31 08:11:40', '2018-01-31 08:11:40'),
(448, '২য়', 'পদার্থের অবস্থা', NULL, 38, '2018-01-31 08:11:40', '2018-01-31 08:11:40'),
(449, '৩য়', 'পদার্থের গঠন', NULL, 38, '2018-01-31 08:11:40', '2018-01-31 08:11:40'),
(450, '৪র্থ', 'পর্যায় সারণি', NULL, 38, '2018-01-31 08:11:40', '2018-01-31 08:11:40'),
(451, '৫ম', 'রাসায়নিক বন্ধন', NULL, 38, '2018-01-31 08:11:40', '2018-01-31 08:11:40'),
(452, '৬ষ্ঠ', 'মোলের ধারণা ও রাসায়নিক গণনা', NULL, 38, '2018-01-31 08:11:40', '2018-01-31 08:11:40'),
(453, '৭ম', 'রাসায়নিক বিক্রিয়া', NULL, 38, '2018-01-31 08:11:40', '2018-01-31 08:11:40'),
(454, '৮ম', 'রসায়ন ও শক্তি', NULL, 38, '2018-01-31 08:11:40', '2018-01-31 08:11:40'),
(455, '৯ম', 'এসিড-ক্ষারক সমতা', NULL, 38, '2018-01-31 08:11:40', '2018-01-31 08:11:40'),
(456, '১০ম', 'খনিজ সম্পদঃ ধাতু-অধাতু', NULL, 38, '2018-01-31 08:11:40', '2018-01-31 08:11:40'),
(457, '১১তম', 'খনিজ সম্পদঃ জীবাশ্ম', NULL, 38, '2018-01-31 08:11:40', '2018-01-31 08:11:40'),
(458, '১২তম', 'আমাদের জীবনে রসায়ন', NULL, 38, '2018-01-31 08:11:40', '2018-01-31 08:11:40'),
(459, '১ম', 'সেট ও ফাংশন', NULL, 39, '2018-01-31 08:14:01', '2018-01-31 08:14:01'),
(460, '২য়', 'বীজগণিতীয় রাশি', NULL, 39, '2018-01-31 08:14:01', '2018-01-31 08:14:01'),
(461, '৩য়', 'জ্যামিতি', NULL, 39, '2018-01-31 08:14:01', '2018-01-31 08:14:01'),
(462, '৪র্থ', 'জ্যামিতিক অঙ্কন', NULL, 39, '2018-01-31 08:14:01', '2018-01-31 08:14:01'),
(463, '৫ম', 'সমীকরণ', NULL, 39, '2018-01-31 08:14:01', '2018-01-31 08:14:01'),
(464, '৬ষ্ঠ', 'অসমতা', NULL, 39, '2018-01-31 08:14:01', '2018-01-31 08:14:01'),
(465, '৭ম', 'অসীম ধারা', NULL, 39, '2018-01-31 08:14:01', '2018-01-31 08:14:01'),
(466, '৮ম', 'ত্রিকোণমিতি', NULL, 39, '2018-01-31 08:14:01', '2018-01-31 08:14:01'),
(467, '৯ম', 'সূচকীয় ও লগারিদমীয় ফাংশন', NULL, 39, '2018-01-31 08:14:01', '2018-01-31 08:14:01'),
(468, '১০ম', 'দ্বিপদী বিস্তৃতি', NULL, 39, '2018-01-31 08:14:01', '2018-01-31 08:14:01'),
(469, '১১তম', 'স্থানাঙ্ক জ্যামিতি', NULL, 39, '2018-01-31 08:14:01', '2018-01-31 08:14:01'),
(470, '১২তম', 'সমতলীয় ভেক্টর', NULL, 39, '2018-01-31 08:14:01', '2018-01-31 08:14:01'),
(471, '১৩তম', 'ঘন জ্যামিতি', NULL, 39, '2018-01-31 08:14:01', '2018-01-31 08:14:01'),
(472, '১৪তম', 'সম্ভাবনা', NULL, 39, '2018-01-31 08:14:01', '2018-01-31 08:14:01'),
(473, '১ম', 'ইতিহাস পরিচিতি', NULL, 40, '2018-01-31 08:18:18', '2018-01-31 08:18:18'),
(474, '২য়', 'বিশ্বসভ্যতা (মিশর, সিন্ধু, গ্রিক ও রোম)', NULL, 40, '2018-01-31 08:18:18', '2018-01-31 08:18:18'),
(475, '৩য়', 'প্রাচীন বাংলার জনপদ', NULL, 40, '2018-01-31 08:18:18', '2018-01-31 08:18:18'),
(476, '৪র্থ', 'প্রাচীন বাংলার রাজনৈতিক ইতিহাস (খ্রিষ্টপূর্বাব্দ ৩২৬-১২০৪ খ্রিষ্টাব্দ)', NULL, 40, '2018-01-31 08:18:18', '2018-01-31 08:18:18'),
(477, '৫ম', 'প্রাচীন বাংলার সামাজিক, অর্থনৈতিক ও সাংস্কৃতিক ইতিহাস', NULL, 40, '2018-01-31 08:18:18', '2018-01-31 08:18:18'),
(478, '৬ষ্ঠ', 'মধ্যযুগের বাংলার রাজনৈতিক ইতিহাস (১২০৪-১৭৫৭ খ্রিষ্টাব্দ)', NULL, 40, '2018-01-31 08:18:18', '2018-01-31 08:18:18'),
(479, '৭ম', 'মধ্যযুগের বাংলার সামাজিক, অর্থনৈতিক ও সাংস্কৃতিক ইতিহাস', NULL, 40, '2018-01-31 08:18:18', '2018-01-31 08:18:18'),
(480, '৮ম', 'বাংলায় ইংরেজ শাসনের সূচনাপর্ব', NULL, 40, '2018-01-31 08:18:18', '2018-01-31 08:18:18'),
(481, '৯ম', 'ইংরেজ শাসন আমলে বাংলায় প্রতিরোধ, নবজাগরণ ও সংস্কার আন্দোলন', NULL, 40, '2018-01-31 08:18:18', '2018-01-31 08:18:18'),
(482, '১০ম', 'ইংরেজ শাসন আমলে বাংলার স্বাধিকার আন্দোলন', NULL, 40, '2018-01-31 08:18:18', '2018-01-31 08:18:18'),
(483, '১১তম', 'ভাষা আন্দোলন ও পরবর্তী রাজনৈতিক ঘটনাপ্রবাহ', NULL, 40, '2018-01-31 08:18:18', '2018-01-31 08:18:18'),
(484, '১২তম', 'সামরিক শাসন ও স্বাধিকার আন্দোলন', NULL, 40, '2018-01-31 08:18:18', '2018-01-31 08:18:18'),
(485, '১৩তম', 'সত্তরের নির্বাচন এবং মুক্তিযুদ্ধ', NULL, 40, '2018-01-31 08:18:18', '2018-01-31 08:18:18'),
(486, '১৪তম', 'বঙ্গবন্ধু শেখ মুজিবুর রহমানের শাসনকাল (১৯৭২-১৯৭৫)', NULL, 40, '2018-01-31 08:18:18', '2018-01-31 08:18:18'),
(487, '১৫তম', 'সামরিক শাসন ও পরবর্তী ঘটনাপ্রবাহ (১৯৭৫-১৯৯০)', NULL, 40, '2018-01-31 08:18:18', '2018-01-31 08:18:18'),
(488, '১ম', 'ভূগোল ও পরিবেশ', NULL, 41, '2018-01-31 08:20:45', '2018-01-31 08:20:45'),
(489, '২য়', 'মহাবিশ্ব ও আমাদের পৃথিবী', NULL, 41, '2018-01-31 08:20:45', '2018-01-31 08:20:45'),
(490, '৩য়', 'মানচিত্র গঠন ও ব্যবহার', NULL, 41, '2018-01-31 08:20:45', '2018-01-31 08:20:45'),
(491, '৪র্থ', 'পৃথিবীর অভ্যন্তরীণ ও বাহ্যিক গঠন', NULL, 41, '2018-01-31 08:20:45', '2018-01-31 08:20:45'),
(492, '৫ম', 'বায়ুমন্ডল', NULL, 41, '2018-01-31 08:20:45', '2018-01-31 08:20:45'),
(493, '৬ষ্ঠ', 'বারিমন্ডল', NULL, 41, '2018-01-31 08:20:45', '2018-01-31 08:20:45'),
(494, '৭ম', 'জনসংখ্যা', NULL, 41, '2018-01-31 08:20:45', '2018-01-31 08:20:45'),
(495, '৮ম', 'মানব বসতি', NULL, 41, '2018-01-31 08:20:45', '2018-01-31 08:20:45'),
(496, '৯ম', 'সম্পদ ও অর্থনৈতিক কার্যাবলি', NULL, 41, '2018-01-31 08:20:45', '2018-01-31 08:20:45'),
(497, '১০ম', 'বাংলাদেশের ভৌগলিক বিবরণ', NULL, 41, '2018-01-31 08:20:45', '2018-01-31 08:20:45'),
(498, '১১তম', 'বাংলাদেশের সম্পদ ও শিল্প', NULL, 41, '2018-01-31 08:20:45', '2018-01-31 08:20:45'),
(499, '১২তম', 'বাংলাদেশের যোগাযোগ ব্যবস্থা ও বাণিজ্য', NULL, 41, '2018-01-31 08:20:45', '2018-01-31 08:20:45'),
(500, '১৩তম', 'বাংলাদেশের উন্নয়ন কর্মকান্ড ও পরিবেশের ভারসাম্য', NULL, 41, '2018-01-31 08:20:45', '2018-01-31 08:20:45'),
(501, '১৪তম', 'বাংলাদেশের প্রাকৃতিক দুর্যোগ', NULL, 41, '2018-01-31 08:20:45', '2018-01-31 08:20:45'),
(502, '১ম', 'অর্থনীতি পরিচয়', NULL, 42, '2018-01-31 08:23:44', '2018-01-31 08:23:44'),
(503, '২য়', 'অর্থনীতির গুরুত্বপূর্ণ ধারণাসমূহ', NULL, 42, '2018-01-31 08:23:44', '2018-01-31 08:23:44'),
(504, '৩য়', 'উপযোগ, চাহিদা, যোগান ও ভারসাম্য', NULL, 42, '2018-01-31 08:23:44', '2018-01-31 08:23:44'),
(505, '৪র্থ', 'উৎপাদন ও সংগঠন', NULL, 42, '2018-01-31 08:23:44', '2018-01-31 08:23:44'),
(506, '৫ম', 'বাজার', NULL, 42, '2018-01-31 08:23:44', '2018-01-31 08:23:44'),
(507, '৬ষ্ঠ', 'জাতীয় আয় ও এর পরিমাণ', NULL, 42, '2018-01-31 08:23:44', '2018-01-31 08:23:44'),
(508, '৭ম', 'অর্থ ও ব্যাংক ব্যবস্থা', NULL, 42, '2018-01-31 08:23:44', '2018-01-31 08:23:44'),
(509, '৮ম', 'বাংলাদেশের অর্থনীতি', NULL, 42, '2018-01-31 08:23:44', '2018-01-31 08:23:44'),
(510, '৯ম', 'বাংলাদেশের গুরুত্বপূর্ণ অর্থনৈতিক প্রসঙ্গ', NULL, 42, '2018-01-31 08:23:44', '2018-01-31 08:23:44'),
(511, '১০ম', 'বাংলাদেশ সরকারের অর্থব্যবস্থা', NULL, 42, '2018-01-31 08:23:44', '2018-01-31 08:23:44'),
(512, '১ম', 'পৌরনীতি ও নাগরিকতা', NULL, 43, '2018-01-31 08:25:11', '2018-01-31 08:25:11'),
(513, '২য়', 'নাগরিক ও নাগরিকতা', NULL, 43, '2018-01-31 08:25:11', '2018-01-31 08:25:11'),
(514, '৩য়', 'আইন, স্বাধীনতা ও সাম্য', NULL, 43, '2018-01-31 08:25:11', '2018-01-31 08:25:11'),
(515, '৪র্থ', 'রাষ্ট্র ও সরকারব্যবস্থা', NULL, 43, '2018-01-31 08:25:11', '2018-01-31 08:25:11'),
(516, '৫ম', 'সংবিধান', NULL, 43, '2018-01-31 08:25:11', '2018-01-31 08:25:11'),
(517, '৬ষ্ঠ', 'বাংলাদেশের সরকারব্যবস্থা', NULL, 43, '2018-01-31 08:25:11', '2018-01-31 08:25:11'),
(518, '৭ম', 'গণতন্ত্রে রাজনৈতিক দল ও নির্বাচন', NULL, 43, '2018-01-31 08:25:11', '2018-01-31 08:25:11'),
(519, '৮ম', 'বাংলাদেশের স্থানীয় সরকারব্যবস্থা', NULL, 43, '2018-01-31 08:25:11', '2018-01-31 08:25:11'),
(520, '৯ম', 'নাগরিক সমস্যা ও আমাদের করনীয়', NULL, 43, '2018-01-31 08:25:11', '2018-01-31 08:25:11'),
(521, '১০ম', 'স্বাধীন বাংলাদেশের অভ্যুদয়ে নাগরিক চেতনা', NULL, 43, '2018-01-31 08:25:11', '2018-01-31 08:25:11'),
(522, '১১তম', 'বাংলাদেশ ও আন্তর্জাতিক সংগঠন', NULL, 43, '2018-01-31 08:25:11', '2018-01-31 08:25:11'),
(523, '১ম', 'হিসাবিজ্ঞান পরিচিতি', NULL, 44, '2018-01-31 08:26:51', '2018-01-31 08:26:51'),
(524, '২য়', 'লেনদেন', NULL, 44, '2018-01-31 08:26:51', '2018-01-31 08:26:51'),
(525, '৩য়', 'দুতরফা দাখিলা পদ্ধতি', NULL, 44, '2018-01-31 08:26:51', '2018-01-31 08:26:51'),
(526, '৪র্থ', 'মূলধন ও মিনাফা জাতীয় লেনদেন', NULL, 44, '2018-01-31 08:26:51', '2018-01-31 08:26:51'),
(527, '৫ম', 'হিসাব', NULL, 44, '2018-01-31 08:26:51', '2018-01-31 08:26:51'),
(528, '৬ষ্ঠ', 'জাবেদা', NULL, 44, '2018-01-31 08:26:51', '2018-01-31 08:26:51'),
(529, '৭ম', 'খতিয়ান', NULL, 44, '2018-01-31 08:26:51', '2018-01-31 08:26:51'),
(530, '৮ম', 'নগদান বই', NULL, 44, '2018-01-31 08:26:51', '2018-01-31 08:26:51'),
(531, '৯ম', 'রেওয়ামিল', NULL, 44, '2018-01-31 08:26:51', '2018-01-31 08:26:51'),
(532, '১০ম', 'আর্থিক বিবরণী', NULL, 44, '2018-01-31 08:26:51', '2018-01-31 08:26:51'),
(533, '১১তম', 'পণ্যের ক্রয়মূল্য, উৎপাদন ব্যয় ও বিক্রয়মূল্য', NULL, 44, '2018-01-31 08:26:51', '2018-01-31 08:26:51'),
(534, '১২তম', 'পারিবারিক ও আত্মকর্মসংস্থানমূলক উদ্যোগের হিসাব', NULL, 44, '2018-01-31 08:26:51', '2018-01-31 08:26:51'),
(535, '১ম', 'অর্থায়ন ও ব্যবসায় অর্থায়ন', NULL, 45, '2018-01-31 08:29:24', '2018-01-31 08:29:24'),
(536, '২য়', 'অর্থায়নের উৎস', NULL, 45, '2018-01-31 08:29:24', '2018-01-31 08:29:24'),
(537, '৩য়', 'অর্থের সময়মূল্য', NULL, 45, '2018-01-31 08:29:24', '2018-01-31 08:29:24'),
(538, '৪র্থ', 'ঝুঁকি ও অনিশ্চয়তা', NULL, 45, '2018-01-31 08:29:24', '2018-01-31 08:29:24'),
(539, '৫ম', 'মূলধনি আয়-ব্যয় প্রাক্কলন', NULL, 45, '2018-01-31 08:29:24', '2018-01-31 08:29:24'),
(540, '৬ষ্ঠ', 'মূলধন ব্যয়', NULL, 45, '2018-01-31 08:29:24', '2018-01-31 08:29:24'),
(541, '৭ম', 'শেয়ার, বন্ড ও ডিবেঞ্চার', NULL, 45, '2018-01-31 08:29:24', '2018-01-31 08:29:24'),
(542, '৮ম', 'মুদ্রা, ব্যাংক ও ব্যাংকিং', NULL, 45, '2018-01-31 08:29:24', '2018-01-31 08:29:24'),
(543, '৯ম', 'ব্যাংকিং ব্যবসা ও তার ধরন', NULL, 45, '2018-01-31 08:29:24', '2018-01-31 08:29:24'),
(544, '১০ম', 'বাণিজ্যিক ব্যাংক ও তার পরিচিতি', NULL, 45, '2018-01-31 08:29:24', '2018-01-31 08:29:24'),
(545, '১১তম', 'ব্যাংকের আমানত', NULL, 45, '2018-01-31 08:29:24', '2018-01-31 08:29:24'),
(546, '১২তম', 'ব্যাংক ও গ্রাহক', NULL, 45, '2018-01-31 08:29:24', '2018-01-31 08:29:24'),
(547, '১৩তম', 'কেন্দ্রীয় ব্যাংক', NULL, 45, '2018-01-31 08:29:24', '2018-01-31 08:29:24'),
(548, '১ম', 'ব্যবসায় পরিচিতি', NULL, 46, '2018-01-31 08:31:10', '2018-01-31 08:31:10'),
(549, '২য়', 'ব্যবসায় উদ্যোগ ও উদ্যোক্তা', NULL, 46, '2018-01-31 08:31:10', '2018-01-31 08:31:10'),
(550, '৩য়', 'আত্মকর্মসংস্থান', NULL, 46, '2018-01-31 08:31:10', '2018-01-31 08:31:10'),
(551, '৪র্থ', 'মালিকানার ভিত্তিতে ব্যবসায়', NULL, 46, '2018-01-31 08:31:10', '2018-01-31 08:31:10'),
(552, '৫ম', 'ব্যবসায়ের আইনগত দিক', NULL, 46, '2018-01-31 08:31:10', '2018-01-31 08:31:10'),
(553, '৬ষ্ঠ', 'ব্যবসায় পরিকল্পনা', NULL, 46, '2018-01-31 08:31:10', '2018-01-31 08:31:10'),
(554, '৭ম', 'বাংলাদেশের শিল্প', NULL, 46, '2018-01-31 08:31:10', '2018-01-31 08:31:10'),
(555, '৮ম', 'ব্যবসায় ও প্রতিষ্ঠানের ব্যাবস্থাপনা', NULL, 46, '2018-01-31 08:31:10', '2018-01-31 08:31:10'),
(556, '৯ম', 'বিপণন', NULL, 46, '2018-01-31 08:31:10', '2018-01-31 08:31:10'),
(557, '১০ম', 'ব্যবসায় উদ্যোগ উন্নয়নে সহায়ক সেবা', NULL, 46, '2018-01-31 08:31:10', '2018-01-31 08:31:10'),
(558, '১১তম', 'ব্যবসায় নৈতিকতা ও সামাজিক দায়িত্ব', NULL, 46, '2018-01-31 08:31:10', '2018-01-31 08:31:10'),
(559, '১২তম', 'সফল উদ্যোক্তাদের জীবনী থেকে শিক্ষণীয়', NULL, 46, '2018-01-31 08:31:10', '2018-01-31 08:31:10'),
(562, '১ম', 'কুরআন মাজিদের পরিচয় ও ইতিহাস', NULL, 49, '2018-01-31 13:14:02', '2018-01-31 13:14:02'),
(563, '২য়', 'তাজভিদসহ পঠন এবং অর্থসহ মুখস্তকরণ', NULL, 49, '2018-01-31 13:14:02', '2018-01-31 13:14:02'),
(566, '৩য়', 'কুরআন মাজিদ', NULL, 49, '2018-01-31 13:15:44', '2018-01-31 13:15:44'),
(567, '৪র্থ', 'তাজভিদ শিক্ষা', NULL, 49, '2018-01-31 13:15:44', '2018-01-31 13:15:44'),
(568, '১ম', 'আল আকাইদ', NULL, 50, '2018-01-31 13:19:01', '2018-01-31 13:19:01'),
(569, '২য়', 'আল ফিকহ', NULL, 50, '2018-01-31 13:19:01', '2018-01-31 13:19:01'),
(570, '৩য়', 'আল আখলাক', NULL, 50, '2018-01-31 13:19:29', '2018-01-31 13:19:29'),
(571, '১ম', 'আল কুরআন পরিচয় ও ইতিহাস', NULL, 55, '2018-01-31 14:08:19', '2018-01-31 14:08:19'),
(572, '২য়', 'তাজভিদসহ পঠন এবং অর্থসহ মুখস্তকরণ', NULL, 55, '2018-01-31 14:08:19', '2018-01-31 14:08:19'),
(573, '৩য়', 'আল কুরআন', NULL, 55, '2018-01-31 14:09:17', '2018-01-31 14:09:17'),
(574, '৪র্থ', 'তাজভিদ শিক্ষা', NULL, 55, '2018-01-31 14:09:17', '2018-01-31 14:09:17'),
(575, '১ম', 'আল আকাইদ', NULL, 56, '2018-01-31 14:12:21', '2018-01-31 14:12:21');
INSERT INTO `sections` (`id`, `section_no`, `section_name`, `section_details`, `ClassSubject_id`, `created_at`, `updated_at`) VALUES
(576, '২য়', 'আল ফিকহ', NULL, 56, '2018-01-31 14:12:21', '2018-01-31 14:12:21'),
(577, '৩য়', 'আল আখলাক', NULL, 56, '2018-01-31 14:12:37', '2018-01-31 14:12:37'),
(578, '১ম', 'আল কুরআন পরিচয় ও ইতিহাস', NULL, 61, '2018-01-31 14:14:07', '2018-01-31 14:14:07'),
(579, '২য়', 'তাজভিদসহ পঠন এবং অর্থসহ মুখস্তকরণ', NULL, 61, '2018-01-31 14:14:07', '2018-01-31 14:14:07'),
(580, '৩য়', 'আল কুরআন', NULL, 61, '2018-01-31 14:14:57', '2018-01-31 14:14:57'),
(581, '৪র্থ', 'তাজভিদ শিক্ষা', NULL, 61, '2018-01-31 14:14:57', '2018-01-31 14:14:57'),
(582, '১ম', 'আল আকাইদ', NULL, 62, '2018-01-31 14:15:55', '2018-01-31 14:15:55'),
(583, '২য়', 'আল ফিকহ', NULL, 62, '2018-01-31 14:15:55', '2018-01-31 14:15:55'),
(584, '৩য়', 'আল আখলাক', NULL, 62, '2018-01-31 14:16:20', '2018-01-31 14:16:20'),
(585, '১ম', 'আল কুরআনের পরিচয়', NULL, 67, '2018-01-31 14:21:01', '2018-01-31 14:21:01'),
(586, '২য়', 'নির্বাচিত বিষয়সমূহ', NULL, 67, '2018-01-31 14:21:01', '2018-01-31 14:21:01'),
(587, '৩য়', 'তাজভিদ শিক্ষা', NULL, 67, '2018-01-31 14:21:29', '2018-01-31 14:21:29'),
(588, '১ম', 'হাদিস পরিচিতি', NULL, 68, '2018-01-31 14:23:45', '2018-01-31 14:23:45'),
(589, '২য়', 'সালাম অধ্যায়', NULL, 68, '2018-01-31 14:23:45', '2018-01-31 14:23:45'),
(590, '৩য়', 'অনুমতি প্রার্থনা অধ্যায়', NULL, 68, '2018-01-31 14:25:28', '2018-01-31 14:25:28'),
(591, '৪র্থ', 'করমর্দন ও কোলাকুলি অধ্যায়', NULL, 68, '2018-01-31 14:25:28', '2018-01-31 14:25:28'),
(594, '৫ম', 'দন্ডায়মান হওয়া সংক্রান্ত অধ্যায়', NULL, 68, '2018-01-31 14:32:31', '2018-01-31 14:32:31'),
(595, '৬ষ্ঠ', 'হাঁচি দেয়া ও হাই তোলা অধ্যায়', NULL, 68, '2018-01-31 14:32:31', '2018-01-31 14:32:31'),
(596, '৭ম', 'হা', 'হাঁচি সংক্রান্ত অধ্যায়', 68, '2018-01-31 14:34:06', '2018-01-31 14:34:06'),
(597, '৮ম', 'নাম রাখা সম্পর্কিত অধ্যায়', NULL, 68, '2018-01-31 14:34:06', '2018-01-31 14:34:06'),
(598, '৯ম', 'জিহবা সংযত করণ, গিবত ও গালমন্দ সংক্রান্ত অধ্যায়', NULL, 68, '2018-01-31 14:36:33', '2018-01-31 14:36:33'),
(599, '১০ম', 'প্রতিশ্রুতি সংক্রান্ত অধ্যায়', NULL, 68, '2018-01-31 14:36:33', '2018-01-31 14:36:33'),
(600, '১১তম', 'কৌতুক সংক্রান্ত অধ্যায়', NULL, 68, '2018-01-31 14:39:43', '2018-01-31 14:39:43'),
(601, '১২তম', 'বংশ গৌরব ও স্বজন-প্রীতির বর্ণনা অধ্যায়', NULL, 68, '2018-01-31 14:39:43', '2018-01-31 14:39:43'),
(602, '১৩তম', 'দয়া অনুগ্রহ ও আত্মীয় স্বজনের প্রতি সদাচারণ অধ্যায় ', NULL, 68, '2018-01-31 14:43:24', '2018-01-31 14:43:24'),
(603, '১৪তম', 'বৃষ্টির প্রতি দয়া-অনুগ্রহ প্রদর্শন করা অধ্যায়', NULL, 68, '2018-01-31 14:43:24', '2018-01-31 14:43:24'),
(604, '১৫তম', 'আল্লাহ তাআলার জন্য ভালোবাসা এবং তার পক্ষ থেকে ভালোবাসা সম্পর্কিত অধ্যায়', NULL, 68, '2018-01-31 14:47:18', '2018-01-31 14:47:18'),
(605, '১৬তম', 'কাউকে বর্জন, সম্পর্কচ্ছেদ এবং দোষানেষণের নিষেধাজ্ঞা অধ্যায়', NULL, 68, '2018-01-31 14:47:18', '2018-01-31 14:47:18'),
(606, '১৭তম', 'সকল কাজে আত্ম-সংযম, সতর্কতা এবং ধীরস্থিরতা অধ্যায়', NULL, 68, '2018-01-31 14:50:23', '2018-01-31 14:50:23'),
(607, '১৮তম', 'দয়া, লজ্জাশীলতা এবং উত্তম চরিত্রের বর্ণনা অধ্যায়', NULL, 68, '2018-01-31 14:50:23', '2018-01-31 14:50:23'),
(608, '১৯তম', 'ক্রোধ ও অহংকারের বিবরণ অধ্যায়', NULL, 68, '2018-01-31 14:51:57', '2018-01-31 14:51:57'),
(609, '২০তম', 'অত্যাচারের বর্ণনা অধ্যায়', NULL, 68, '2018-01-31 14:51:57', '2018-01-31 14:51:57'),
(610, '২১তম', 'সংকাজের আদেশ ও মন্দকাজের নিষেধ অধ্যায়', NULL, 68, '2018-01-31 14:53:43', '2018-01-31 14:53:43'),
(611, '২২তম', 'খাদ্যবস্তু সম্মন্ধীয় অধ্যায়', NULL, 68, '2018-01-31 14:53:43', '2018-01-31 14:53:43'),
(612, '২৩তম', 'দান-খয়রাত অধ্যায়', NULL, 68, '2018-01-31 14:56:00', '2018-01-31 14:56:00'),
(613, '২৪তম', 'জাহান্নামের শাস্তির বর্ণনা সম্মন্ধীয় অধ্যায়', NULL, 68, '2018-01-31 14:56:00', '2018-01-31 14:56:00'),
(614, '২৫তম', 'জান্নাতের নেয়ামত সম্মন্ধীয় অধ্যায়', NULL, 68, '2018-01-31 14:57:39', '2018-01-31 14:57:39'),
(615, '২৬তম', 'হালাল রুজি উপার্জন অধ্যায়', NULL, 68, '2018-01-31 14:57:39', '2018-01-31 14:57:39'),
(616, '২৭তম', 'ব্যবসায়ে সত্যবাদিতার অধ্যায়', NULL, 68, '2018-01-31 14:59:13', '2018-01-31 14:59:13'),
(617, '২৮তম', 'ফিংনা ফাসাদের বর্ণনা অধ্যায়', NULL, 68, '2018-01-31 14:59:13', '2018-01-31 14:59:13'),
(618, '২৯তম', 'নেশা জাতীয় দ্রব্যাদির বর্ণনা অধ্যায় ', NULL, 68, '2018-01-31 15:01:19', '2018-01-31 15:01:19'),
(619, '৩০তম', 'সন্ত্রাসী কর্মকান্ডের ভয়াবহতা অধ্যায়', NULL, 68, '2018-01-31 15:01:19', '2018-01-31 15:01:19'),
(620, '৩১তম', 'নারীদের উত্ত্যক্ত করা / ইভটিজিং সংক্রান্ত অধ্যায়', NULL, 68, '2018-01-31 15:02:38', '2018-01-31 15:02:38'),
(621, '১ম', 'আদ দীন', NULL, 69, '2018-01-31 15:08:30', '2018-01-31 15:08:30'),
(622, '২য়', 'আল্লাহর উপর বিশ্বাস', NULL, 69, '2018-01-31 15:08:30', '2018-01-31 15:08:30'),
(623, '৩য়', 'রসুলগণের উপর বিশ্বাস', NULL, 69, '2018-01-31 15:09:53', '2018-01-31 15:09:53'),
(624, '৪র্থ', 'আসমানি কিতাবসমুহের উপর বিশ্বাস', NULL, 69, '2018-01-31 15:09:53', '2018-01-31 15:09:53'),
(625, '৫ম', 'পরকালের উপর বিশ্বাস', NULL, 69, '2018-01-31 15:10:25', '2018-01-31 15:10:25'),
(626, '৬ষ্ঠ', 'ইমান বিল কদর', NULL, 69, '2018-01-31 15:10:25', '2018-01-31 15:10:25'),
(627, '৭ম', 'ইলমুল বেলায়েত', NULL, 69, '2018-01-31 15:12:05', '2018-01-31 15:12:05'),
(628, '৮ম', 'ইলমে ফিকহের পরিচয় ও ইতিহাস', NULL, 69, '2018-01-31 15:12:05', '2018-01-31 15:12:05'),
(629, '৯ম', 'আল ফিকহ - কুদুরি', NULL, 69, '2018-01-31 15:12:55', '2018-01-31 15:12:55'),
(630, '১০ম', 'আল আখলাক', NULL, 69, '2018-01-31 15:12:55', '2018-01-31 15:12:55'),
(631, '১১তম', 'উসুলুল ফিকহ', NULL, 69, '2018-01-31 15:13:19', '2018-01-31 15:13:19'),
(633, '১ম', 'প্রাক-ইসলামি পটভূমি ও রাসুল (স.) এর মক্কা জীবন', NULL, 70, '2018-01-31 15:17:20', '2018-01-31 15:17:20'),
(634, '২য়', 'হযরত মুহাম্মদ (স.) এর মদিনা জীবন', NULL, 70, '2018-01-31 15:17:20', '2018-01-31 15:17:20'),
(635, '৩য়', 'খুলাফায়ে রাশেদিন', NULL, 70, '2018-01-31 15:18:51', '2018-01-31 15:18:51'),
(636, '৪র্থ', 'ভারতীয় উপমহাদেশে মুসলমানদের আগমন', NULL, 70, '2018-01-31 15:18:51', '2018-01-31 15:18:51');

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `id` int(10) UNSIGNED NOT NULL,
  `subject_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`id`, `subject_name`, `created_at`, `updated_at`) VALUES
(1, 'বাংলা', '2017-12-11 11:15:35', '2017-12-11 11:15:35'),
(2, 'গনিত', '2017-12-11 11:15:35', '2017-12-11 11:15:35'),
(3, 'বাংলাদেশ ও বিশ্বপরিচয়', '2017-12-11 11:17:44', '2017-12-11 11:17:44'),
(4, 'সাধারণ বিজ্ঞান', '2017-12-11 11:17:44', '2017-12-11 11:17:44'),
(5, 'ইসলাম ও নৈতিক শিক্ষা', '2017-12-11 11:20:02', '2017-12-11 11:20:02'),
(6, 'হিন্দু ও নৈতিক শিক্ষা', '2017-12-11 11:20:02', '2017-12-11 11:20:02'),
(7, 'খীস্টান ও নৈতিক শিক্ষা', '2017-12-11 11:22:15', '2017-12-11 11:22:15'),
(8, 'বৌদ্ধ ও নৈতিক শিক্ষা', '2017-12-11 11:22:15', '2017-12-11 11:22:15'),
(9, 'পদার্থবিজ্ঞান', '2017-12-11 11:24:36', '2017-12-11 11:24:36'),
(10, 'রসায়ন', '2017-12-11 11:24:36', '2017-12-11 11:24:36'),
(11, 'জীববিজ্ঞান', '2017-12-11 11:25:08', '2017-12-11 11:25:08'),
(12, 'উচ্চতর গণিত', '2017-12-11 11:25:08', '2017-12-11 11:25:08'),
(13, 'বাংলাদেশের ইতিহাস ও বিশ্বসভ্যতা', '2017-12-11 11:26:41', '2017-12-11 11:26:41'),
(14, 'ভূগোল ও পরিবেশ ', '2017-12-11 11:26:41', '2017-12-11 11:26:41'),
(15, 'অর্থনীতি', '2017-12-11 11:26:55', '2017-12-11 11:26:55'),
(16, 'কৃষিশিক্ষা', '2017-12-11 11:26:55', '2017-12-11 11:26:55'),
(17, 'গার্হস্থ্য বিজ্ঞান', '2017-12-11 11:27:12', '2017-12-11 11:27:12'),
(18, 'পৌরনীতি ও নাগরিকতা', '2017-12-11 11:27:12', '2017-12-11 11:27:12'),
(19, 'হিসাববিজ্ঞান', '2017-12-11 11:27:35', '2017-12-11 11:27:35'),
(20, 'ফিন্যান্স ও ব্যাংকিং', '2017-12-11 11:27:35', '2017-12-11 11:27:35'),
(21, 'কৃষি শিক্ষা', '2018-01-23 19:38:04', '2018-01-23 19:38:04'),
(22, 'গার্হস্থ্য বিজ্ঞান', '2018-01-23 19:38:04', '2018-01-23 19:38:04'),
(23, 'ব্যবসায় উদ্যোগ', '2018-01-30 21:37:03', '2018-01-30 21:37:03'),
(24, 'কোরআন মজিদ ও তাজভিদ', '2018-01-31 08:37:36', '2018-01-31 08:37:36'),
(25, 'আল আকায়েদ ওয়াল ফিক্হ', '2018-01-31 08:37:36', '2018-01-31 08:37:36'),
(26, 'হাদিস শরফি', '2018-01-31 08:39:30', '2018-01-31 08:39:30'),
(27, 'ইসলামের ইতিহাস', '2018-01-31 08:40:35', '2018-01-31 08:40:35'),
(28, 'আকায়েদ ও ফিকহ ', '2018-01-31 08:48:25', '2018-01-31 08:48:25'),
(29, 'বাংলা ভাষা ও সাহিত্য', '2018-02-01 08:51:36', '2018-02-01 08:51:36'),
(30, 'ইংরেজি ভাষা ও সাহিত্য', '2018-02-01 08:51:36', '2018-02-01 08:51:36'),
(31, 'বাংলাদেশ বিষয়াবলি', '2018-02-01 08:51:53', '2018-02-01 08:51:53'),
(32, 'আর্ন্তজাতিক বিষয়াবলি', '2018-02-01 08:51:53', '2018-02-01 08:51:53'),
(33, 'ভুগোল (বাংলাদেশ ও বিশ্ব), পরিবেশ ও দুর্যোগ ব্যবস্থাপনা', '2018-02-01 08:52:10', '2018-02-01 08:52:10'),
(34, 'সাধারণ বিজ্ঞান', '2018-02-01 08:52:10', '2018-02-01 08:52:10'),
(35, 'কম্পিউটার ও তথ্য-প্রযুক্তি', '2018-02-01 08:52:28', '2018-02-01 08:52:28'),
(36, 'গাণিতিক যুক্তি', '2018-02-01 08:52:28', '2018-02-01 08:52:28'),
(37, 'মানসিক দক্ষতা', '2018-02-01 08:52:40', '2018-02-01 08:52:40'),
(38, 'নৈতিকতা, মুল্যবোধ ও সুশাসন', '2018-02-01 08:52:40', '2018-02-01 08:52:40'),
(39, 'ইংরেজী', '2018-02-01 11:03:17', '2018-02-01 11:03:17'),
(40, 'সাধারণ গণিত', '2018-02-01 11:03:17', '2018-02-01 11:03:17'),
(41, 'সাধারণ জ্ঞান', '2018-02-01 11:03:37', '2018-02-01 11:03:37'),
(42, 'অ্যানালিটিক্যাল অ্যাবিলিটি, পাজলস, ডাটা সাফিশিয়েন্সি', '2018-02-01 11:09:13', '2018-02-01 11:09:13'),
(43, 'ইসলামিক জ্ঞান', '2018-02-01 11:09:13', '2018-02-01 11:09:13');

-- --------------------------------------------------------

--
-- Table structure for table `university_questions`
--

CREATE TABLE `university_questions` (
  `id` int(10) UNSIGNED NOT NULL,
  `classsubject_id` int(11) UNSIGNED NOT NULL,
  `question` blob NOT NULL,
  `option_no_1` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `option_no_2` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `option_no_3` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `option_no_4` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `answer` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `exam` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `university_questions`
--

INSERT INTO `university_questions` (`id`, `classsubject_id`, `question`, `option_no_1`, `option_no_2`, `option_no_3`, `option_no_4`, `answer`, `exam`, `created_at`, `updated_at`) VALUES
(1, 123, 0x7375626a6563745f, 'subject_', 'subject_', 'subject_', 'subject_', 'subject_', 'subject_', '2018-02-08 14:23:29', '2018-02-08 14:23:29'),
(2, 106, 0x7375626a6563745f, 'subject_', 'subject_', 'subject_', 'subject_', 'subject_', 'subject_', '2018-02-08 14:26:10', '2018-02-08 14:26:10');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `isAdmin` tinyint(4) NOT NULL DEFAULT '0',
  `rule` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `about` varchar(10000) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'offline',
  `email_token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `verified` tinyint(4) DEFAULT '0',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `isAdmin`, `rule`, `name`, `email`, `mobile`, `about`, `password`, `status`, `email_token`, `verified`, `remember_token`, `created_at`, `updated_at`) VALUES
(2, 0, NULL, 'Mahbub Shuvo', 'mahbub.shuvo12@gmail.com', '', NULL, '$2y$10$yQmRTs4aPQQ6hUmSm2uvKOBakP1VgrXRsiGJ95f/foTXsrMhTRucq', 'offline', NULL, 1, '9OTSyN7byqt3UnvOsJBJBn4mAQACdPc3tRAN8MIsoqD61PZNmjKkmeUQx4YG', '2017-12-01 10:25:37', '2018-01-13 13:14:41'),
(5, 0, NULL, 'Fahim', 'mahbub.rahman180@gmail.com', '', NULL, '$2y$10$yxy9bZUCCTdb47V8DSjRUerXnMYG7i/KClH8MCbs5/.ra/Inp5kT.', 'offline', NULL, 1, 'CSdxGewIvG2V2Z6Jmxrw87AyjLGxxbIerrgdl08OkddBNLxcEs66lCulr2Y2', '2017-12-03 15:54:35', '2018-01-28 21:55:17'),
(21, 1, 'Mentor', 'Mahbub', 'mahbub.shuvo10@gmail.com', NULL, NULL, '$2y$10$lZdyp4Va5SPyFer8REWH8OiduSIo3rMibtQQwFU.qInkEL3VS06Xy', 'offline', NULL, 1, 'qQW6m5xg2PBkQRxhoT4rsnFevkwnYRVotCBAXyz0yXQwaeMZHvXG0z6tOuQk', '2018-02-11 15:54:27', '2018-02-11 15:54:27');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `adminchats`
--
ALTER TABLE `adminchats`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `boards`
--
ALTER TABLE `boards`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `board_examinations`
--
ALTER TABLE `board_examinations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `board_examinations_board_id_foreign` (`board_id`),
  ADD KEY `board_examinations_examination_id_foreign` (`examination_id`);

--
-- Indexes for table `board_exam_questions`
--
ALTER TABLE `board_exam_questions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `board_exam_questions_board_examinations_id_foreign` (`examination_id`),
  ADD KEY `board_exam_questions_subject_id_foreign` (`subject_id`),
  ADD KEY `board_exam_questions_section_id_foreign` (`section_id`);

--
-- Indexes for table `board_questions`
--
ALTER TABLE `board_questions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `board_questions_board_examinations_id_foreign` (`board_examinations_id`),
  ADD KEY `subject_id` (`subject_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `classes`
--
ALTER TABLE `classes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `classsubject`
--
ALTER TABLE `classsubject`
  ADD PRIMARY KEY (`id`),
  ADD KEY `classsubject_class_id_foreign` (`class_id`),
  ADD KEY `classsubject_subject_id_foreign` (`subject_id`);

--
-- Indexes for table `creative_questions`
--
ALTER TABLE `creative_questions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `creative_questions_classsubject_id_foreign` (`classsubject_id`),
  ADD KEY `section_id` (`section_id`);

--
-- Indexes for table `examinations`
--
ALTER TABLE `examinations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `forums`
--
ALTER TABLE `forums`
  ADD PRIMARY KEY (`id`),
  ADD KEY `forums_user_id_foreign` (`user_id`);

--
-- Indexes for table `forum_visitors`
--
ALTER TABLE `forum_visitors`
  ADD PRIMARY KEY (`id`),
  ADD KEY `forum_visitors_forum_id_foreign` (`forum_id`);

--
-- Indexes for table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `likes_reply_id_foreign` (`reply_id`),
  ADD KEY `likes_user_id_foreign` (`user_id`);

--
-- Indexes for table `mcq_questions`
--
ALTER TABLE `mcq_questions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `mcq_questions_classsubject_id_foreign` (`classsubject_id`),
  ADD KEY `section_id` (`section_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `normal_exam_questions`
--
ALTER TABLE `normal_exam_questions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `normal_exam_questions_classsubject_id_foreign` (`classsubject_id`),
  ADD KEY `normal_exam_questions_section_id_foreign` (`section_id`);

--
-- Indexes for table `normal_exam_question_user`
--
ALTER TABLE `normal_exam_question_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `replies`
--
ALTER TABLE `replies`
  ADD PRIMARY KEY (`id`),
  ADD KEY `replies_user_id_foreign` (`user_id`),
  ADD KEY `replies_forum_id_foreign` (`forum_id`);

--
-- Indexes for table `results`
--
ALTER TABLE `results`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `saved_questions`
--
ALTER TABLE `saved_questions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `saved_questions_user_id_foreign` (`user_id`),
  ADD KEY `saved_questions_classsubject_id_foreign` (`classsubject_id`);

--
-- Indexes for table `sections`
--
ALTER TABLE `sections`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sections_classsubject_id_foreign` (`ClassSubject_id`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `university_questions`
--
ALTER TABLE `university_questions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `classsubject_id` (`classsubject_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `adminchats`
--
ALTER TABLE `adminchats`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- AUTO_INCREMENT for table `boards`
--
ALTER TABLE `boards`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `board_examinations`
--
ALTER TABLE `board_examinations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `board_exam_questions`
--
ALTER TABLE `board_exam_questions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `board_questions`
--
ALTER TABLE `board_questions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `classes`
--
ALTER TABLE `classes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `classsubject`
--
ALTER TABLE `classsubject`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=130;

--
-- AUTO_INCREMENT for table `creative_questions`
--
ALTER TABLE `creative_questions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `examinations`
--
ALTER TABLE `examinations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `forums`
--
ALTER TABLE `forums`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `forum_visitors`
--
ALTER TABLE `forum_visitors`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `likes`
--
ALTER TABLE `likes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `mcq_questions`
--
ALTER TABLE `mcq_questions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `normal_exam_questions`
--
ALTER TABLE `normal_exam_questions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `normal_exam_question_user`
--
ALTER TABLE `normal_exam_question_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT for table `replies`
--
ALTER TABLE `replies`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `results`
--
ALTER TABLE `results`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `saved_questions`
--
ALTER TABLE `saved_questions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sections`
--
ALTER TABLE `sections`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=637;

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `university_questions`
--
ALTER TABLE `university_questions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `board_examinations`
--
ALTER TABLE `board_examinations`
  ADD CONSTRAINT `board_examinations_board_id_foreign` FOREIGN KEY (`board_id`) REFERENCES `boards` (`id`),
  ADD CONSTRAINT `board_examinations_examination_id_foreign` FOREIGN KEY (`examination_id`) REFERENCES `examinations` (`id`);

--
-- Constraints for table `board_exam_questions`
--
ALTER TABLE `board_exam_questions`
  ADD CONSTRAINT `board_exam_questions_board_examinations_id_foreign` FOREIGN KEY (`examination_id`) REFERENCES `board_examinations` (`id`),
  ADD CONSTRAINT `board_exam_questions_section_id_foreign` FOREIGN KEY (`section_id`) REFERENCES `sections` (`id`),
  ADD CONSTRAINT `board_exam_questions_subject_id_foreign` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`id`);

--
-- Constraints for table `board_questions`
--
ALTER TABLE `board_questions`
  ADD CONSTRAINT `board_questions_board_examinations_id_foreign` FOREIGN KEY (`board_examinations_id`) REFERENCES `board_examinations` (`id`),
  ADD CONSTRAINT `board_questions_ibfk_1` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`id`);

--
-- Constraints for table `classsubject`
--
ALTER TABLE `classsubject`
  ADD CONSTRAINT `classsubject_class_id_foreign` FOREIGN KEY (`class_id`) REFERENCES `classes` (`id`),
  ADD CONSTRAINT `classsubject_subject_id_foreign` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`id`);

--
-- Constraints for table `creative_questions`
--
ALTER TABLE `creative_questions`
  ADD CONSTRAINT `creative_questions_classsubject_id_foreign` FOREIGN KEY (`classsubject_id`) REFERENCES `classsubject` (`id`),
  ADD CONSTRAINT `creative_questions_ibfk_1` FOREIGN KEY (`section_id`) REFERENCES `sections` (`id`);

--
-- Constraints for table `forums`
--
ALTER TABLE `forums`
  ADD CONSTRAINT `forums_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `forum_visitors`
--
ALTER TABLE `forum_visitors`
  ADD CONSTRAINT `forum_visitors_forum_id_foreign` FOREIGN KEY (`forum_id`) REFERENCES `forums` (`id`);

--
-- Constraints for table `likes`
--
ALTER TABLE `likes`
  ADD CONSTRAINT `likes_reply_id_foreign` FOREIGN KEY (`reply_id`) REFERENCES `replies` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `likes_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `mcq_questions`
--
ALTER TABLE `mcq_questions`
  ADD CONSTRAINT `mcq_questions_classsubject_id_foreign` FOREIGN KEY (`classsubject_id`) REFERENCES `classsubject` (`id`),
  ADD CONSTRAINT `mcq_questions_ibfk_1` FOREIGN KEY (`section_id`) REFERENCES `sections` (`id`);

--
-- Constraints for table `normal_exam_questions`
--
ALTER TABLE `normal_exam_questions`
  ADD CONSTRAINT `normal_exam_questions_classsubject_id_foreign` FOREIGN KEY (`classsubject_id`) REFERENCES `classsubject` (`id`),
  ADD CONSTRAINT `normal_exam_questions_section_id_foreign` FOREIGN KEY (`section_id`) REFERENCES `sections` (`id`);

--
-- Constraints for table `replies`
--
ALTER TABLE `replies`
  ADD CONSTRAINT `replies_forum_id_foreign` FOREIGN KEY (`forum_id`) REFERENCES `forums` (`id`),
  ADD CONSTRAINT `replies_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `results`
--
ALTER TABLE `results`
  ADD CONSTRAINT `results_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `saved_questions`
--
ALTER TABLE `saved_questions`
  ADD CONSTRAINT `saved_questions_classsubject_id_foreign` FOREIGN KEY (`classsubject_id`) REFERENCES `classsubject` (`id`),
  ADD CONSTRAINT `saved_questions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `sections`
--
ALTER TABLE `sections`
  ADD CONSTRAINT `sections_classsubject_id_foreign` FOREIGN KEY (`ClassSubject_id`) REFERENCES `classsubject` (`id`);

--
-- Constraints for table `university_questions`
--
ALTER TABLE `university_questions`
  ADD CONSTRAINT `university_questions_ibfk_1` FOREIGN KEY (`classsubject_id`) REFERENCES `classsubject` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
