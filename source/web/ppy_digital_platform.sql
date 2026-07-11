-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 10, 2026 at 04:27 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ppy_digital_platform`
--

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `citizens`
--

CREATE TABLE `citizens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `household_id` bigint(20) UNSIGNED DEFAULT NULL,
  `cid` varchar(13) NOT NULL,
  `title_id` bigint(20) UNSIGNED DEFAULT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) DEFAULT NULL,
  `gender` enum('ชาย','หญิง') NOT NULL,
  `birth_date` date DEFAULT NULL,
  `religion_id` bigint(20) UNSIGNED DEFAULT NULL,
  `nationality_id` bigint(20) UNSIGNED DEFAULT NULL,
  `occupation_id` bigint(20) UNSIGNED DEFAULT NULL,
  `education_level_id` bigint(20) UNSIGNED DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `citizens`
--

INSERT INTO `citizens` (`id`, `household_id`, `cid`, `title_id`, `first_name`, `last_name`, `gender`, `birth_date`, `religion_id`, `nationality_id`, `occupation_id`, `education_level_id`, `phone`, `email`, `status`, `created_at`, `updated_at`) VALUES
(3, 2, '1111111111112', NULL, 'นาย กอขอ', 'งอจอ', 'ชาย', '2000-01-01', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2026-07-04 06:29:34', '2026-07-04 23:27:31'),
(4, 2, '1111111111113', NULL, 'นางเอบี', 'ซีดีอี', 'หญิง', '2000-02-02', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2026-07-04 23:16:10', '2026-07-05 00:13:59');

-- --------------------------------------------------------

--
-- Table structure for table `education_levels`
--

CREATE TABLE `education_levels` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(20) NOT NULL,
  `name_th` varchar(255) NOT NULL,
  `name_en` varchar(255) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `health_profiles`
--

CREATE TABLE `health_profiles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `citizen_id` bigint(20) UNSIGNED NOT NULL,
  `has_chronic_disease` tinyint(1) NOT NULL DEFAULT 0,
  `has_diabetes` tinyint(1) NOT NULL DEFAULT 0,
  `has_hypertension` tinyint(1) NOT NULL DEFAULT 0,
  `has_heart_disease` tinyint(1) NOT NULL DEFAULT 0,
  `has_kidney_disease` tinyint(1) NOT NULL DEFAULT 0,
  `is_bedridden` tinyint(1) NOT NULL DEFAULT 0,
  `is_homebound` tinyint(1) NOT NULL DEFAULT 0,
  `is_disabled` tinyint(1) NOT NULL DEFAULT 0,
  `is_elderly` tinyint(1) NOT NULL DEFAULT 0,
  `health_level` enum('green','yellow','orange','red') NOT NULL DEFAULT 'green',
  `last_home_visit_at` date DEFAULT NULL,
  `remark` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `health_profiles`
--

INSERT INTO `health_profiles` (`id`, `citizen_id`, `has_chronic_disease`, `has_diabetes`, `has_hypertension`, `has_heart_disease`, `has_kidney_disease`, `is_bedridden`, `is_homebound`, `is_disabled`, `is_elderly`, `health_level`, `last_home_visit_at`, `remark`, `created_at`, `updated_at`) VALUES
(1, 4, 0, 1, 1, 0, 0, 0, 0, 0, 0, 'green', '2026-07-09', 'ทดลองระบบสุขภาพ', '2026-07-09 06:41:46', '2026-07-09 06:42:42');

-- --------------------------------------------------------

--
-- Table structure for table `households`
--

CREATE TABLE `households` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `house_code` varchar(20) NOT NULL,
  `house_no` varchar(20) NOT NULL,
  `village_id` bigint(20) UNSIGNED DEFAULT NULL,
  `moo` varchar(10) DEFAULT NULL,
  `road` varchar(255) DEFAULT NULL,
  `alley` varchar(255) DEFAULT NULL,
  `postcode` varchar(5) DEFAULT NULL,
  `latitude` decimal(10,7) DEFAULT NULL,
  `longitude` decimal(10,7) DEFAULT NULL,
  `flood_level` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0=ไม่ท่วม,1=เขียว,2=เหลือง,3=ส้ม,4=แดง',
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `households`
--

INSERT INTO `households` (`id`, `house_code`, `house_no`, `village_id`, `moo`, `road`, `alley`, `postcode`, `latitude`, `longitude`, `flood_level`, `status`, `created_at`, `updated_at`) VALUES
(2, 'A001', '110', NULL, '7', NULL, NULL, '72000', 13.7358371, 100.4892620, 0, 1, '2026-07-04 23:27:12', '2026-07-04 23:27:12');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2026_06_28_143834_create_permission_tables', 1),
(5, '2026_07_01_125342_create_households_table', 1),
(6, '2026_07_01_125352_create_citizens_table', 1),
(7, '2026_07_01_125354_create_titles_table', 1),
(8, '2026_07_01_125356_create_religions_table', 1),
(9, '2026_07_01_125357_create_nationalities_table', 1),
(10, '2026_07_01_125359_create_occupations_table', 1),
(11, '2026_07_01_125400_create_education_levels_table', 1),
(12, '2026_07_05_122715_create_welfare_profiles_table', 2),
(13, '2026_07_05_124946_add_levels_to_welfare_profiles_table', 3),
(14, '2026_07_05_131503_create_welfare_assistances_table', 4),
(15, '2026_07_05_132348_create_service_cases_table', 4),
(16, '2026_07_06_122203_create_service_case_timelines_table', 5),
(17, '2026_07_09_125424_create_health_profiles_table', 6);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `nationalities`
--

CREATE TABLE `nationalities` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(20) NOT NULL,
  `name_th` varchar(255) NOT NULL,
  `name_en` varchar(255) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `nationalities`
--

INSERT INTO `nationalities` (`id`, `code`, `name_th`, `name_en`, `status`, `created_at`, `updated_at`) VALUES
(1, 'TH', 'ไทย', NULL, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `occupations`
--

CREATE TABLE `occupations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(20) NOT NULL,
  `name_th` varchar(255) NOT NULL,
  `name_en` varchar(255) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `religions`
--

CREATE TABLE `religions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(20) NOT NULL,
  `name_th` varchar(255) NOT NULL,
  `name_en` varchar(255) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `religions`
--

INSERT INTO `religions` (`id`, `code`, `name_th`, `name_en`, `status`, `created_at`, `updated_at`) VALUES
(1, 'BUD', 'พุทธ', NULL, 1, NULL, NULL),
(2, 'CHR', 'คริสต์', NULL, 1, NULL, NULL),
(3, 'ISL', 'อิสลาม', NULL, 1, NULL, NULL),
(4, 'OTH', 'อื่น ๆ', NULL, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `service_cases`
--

CREATE TABLE `service_cases` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `case_no` varchar(30) NOT NULL,
  `citizen_id` bigint(20) UNSIGNED DEFAULT NULL,
  `module` varchar(50) NOT NULL,
  `case_type` varchar(100) NOT NULL,
  `status` enum('open','assessing','approved','processing','follow_up','closed','cancelled') NOT NULL DEFAULT 'open',
  `priority` enum('normal','urgent','emergency') NOT NULL DEFAULT 'normal',
  `opened_at` date DEFAULT NULL,
  `closed_at` date DEFAULT NULL,
  `assigned_to` bigint(20) UNSIGNED DEFAULT NULL,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `remark` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `service_cases`
--

INSERT INTO `service_cases` (`id`, `case_no`, `citizen_id`, `module`, `case_type`, `status`, `priority`, `opened_at`, `closed_at`, `assigned_to`, `created_by`, `remark`, `created_at`, `updated_at`) VALUES
(1, 'PPY-2569-000001', 3, 'social_welfare', 'รถเข็น', 'follow_up', 'normal', '2026-07-06', NULL, NULL, 2, 'ต้องการรถเข็น', '2026-07-06 07:07:37', '2026-07-08 07:13:48'),
(2, 'PPY-2569-000002', 4, 'social_welfare', 'elderly_assistance', 'open', 'normal', NULL, NULL, NULL, 2, 'Normal case', '2026-07-08 06:35:01', '2026-07-08 06:35:01'),
(3, 'PPY-2569-000003', 4, 'social_welfare', 'เตียงลม', 'open', 'urgent', '2026-07-08', NULL, NULL, 2, 'เคสติดเตียง ต้องการเตียงลม', '2026-07-08 06:36:14', '2026-07-08 06:36:14'),
(4, 'PPY-2569-000004', 4, 'social_welfare', 'elderly_assistance', 'open', 'normal', NULL, NULL, NULL, 2, '123', '2026-07-08 06:44:02', '2026-07-08 06:44:02'),
(5, 'PPY-2569-000005', 4, 'social_welfare', 'elderly_assistance', 'open', 'normal', NULL, NULL, NULL, 2, '789789', '2026-07-08 06:45:01', '2026-07-08 06:45:01'),
(6, 'PPY-2569-000006', 4, 'public_health', 'NCD', 'open', 'normal', '2026-07-09', NULL, NULL, 2, NULL, '2026-07-09 07:19:06', '2026-07-09 07:19:06'),
(7, 'PPY-2569-000007', 4, 'public_health', 'home_visit', 'open', 'normal', NULL, NULL, NULL, 2, 'เยี่ยมบ้านได้ไหม', '2026-07-09 07:41:45', '2026-07-09 07:41:45');

-- --------------------------------------------------------

--
-- Table structure for table `service_case_timelines`
--

CREATE TABLE `service_case_timelines` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `service_case_id` bigint(20) UNSIGNED NOT NULL,
  `action` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `action_at` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `service_case_timelines`
--

INSERT INTO `service_case_timelines` (`id`, `service_case_id`, `action`, `description`, `user_id`, `action_at`, `created_at`, `updated_at`) VALUES
(1, 1, 'open_case', 'เปิดเคสใหม่', 2, '2026-07-06 14:07:37', '2026-07-06 07:07:37', '2026-07-06 07:07:37'),
(2, 2, 'open_case', 'เปิดเคสใหม่', 2, '2026-07-08 13:35:01', '2026-07-08 06:35:01', '2026-07-08 06:35:01'),
(3, 3, 'open_case', 'เปิดเคสใหม่', 2, '2026-07-08 13:36:14', '2026-07-08 06:36:14', '2026-07-08 06:36:14'),
(4, 4, 'open_case', 'เปิดเคสใหม่', 2, '2026-07-08 13:44:02', '2026-07-08 06:44:02', '2026-07-08 06:44:02'),
(5, 5, 'open_case', 'เปิดเคสใหม่', 2, '2026-07-08 13:45:01', '2026-07-08 06:45:01', '2026-07-08 06:45:01'),
(6, 1, 'status_changed', 'เปลี่ยนสถานะจาก open เป็น follow_up', 2, '2026-07-08 14:13:48', '2026-07-08 07:13:48', '2026-07-08 07:13:48'),
(7, 1, 'field_visit', NULL, 2, '2026-07-08 14:32:00', '2026-07-08 07:32:24', '2026-07-08 07:32:24'),
(8, 1, 'phone_followup', 'แจ้งก่อนเยี่ยมบ้าน', 2, '2026-07-08 14:32:00', '2026-07-08 07:32:54', '2026-07-08 07:32:54'),
(9, 6, 'open_case', 'เปิดเคสใหม่', 2, '2026-07-09 14:19:06', '2026-07-09 07:19:06', '2026-07-09 07:19:06'),
(10, 7, 'open_case', 'เปิดเคสใหม่', 2, '2026-07-09 14:41:45', '2026-07-09 07:41:45', '2026-07-09 07:41:45');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('ilyILIGrWqaBHhj2KhHEYkxLQyvQMNAj6CnQiJjT', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiT1NuNlRwYzJvWTRjajF6SjZZb1FzWkpIUnJyQ2tRNUxrVjlhV29PNSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDI6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9wb3B1bGF0aW9uL2Rhc2hib2FyZCI7czo1OiJyb3V0ZSI7czoyMDoicG9wdWxhdGlvbi5kYXNoYm9hcmQiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToyO30=', 1783241820),
('na9D1XUUBVIyvOW1SRVG9MnUhVIEnI2UqmpBqiun', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiRDRLV0Zqa21VYlcwdmFxNnF4QXRHaWNpMlIxMkNSWUo3RXFHMHdIdSI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjI6e3M6MzoidXJsIjtzOjUyOiJodHRwOi8vbG9jYWxob3N0OjgwMDAvY2l0aXplbnMvNC9oZWFsdGgtY2FzZXMvY3JlYXRlIjtzOjU6InJvdXRlIjtzOjI4OiJjaXRpemVucy5oZWFsdGgtY2FzZXMuY3JlYXRlIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6Mjt9', 1783692117),
('Nl0NtXDjrgGbM4sfES7tTKbIj4YpmKT6PrvcvLJZ', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiTzNMNVpKUFg2NUVGMXo4dWhXMFNDSlFXWEtPTmxkZHVtMFV4UHNwYyI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjI6e3M6MzoidXJsIjtzOjMxOiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvZGFzaGJvYXJkIjtzOjU6InJvdXRlIjtzOjk6ImRhc2hib2FyZCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjI7fQ==', 1783350554),
('rxunoHbyS6nqGAXE4fgC2bVm87r6EVuGFbYzqIXl', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiNXQ0WEd3TFhnVFNTb0d2OEFORXFxUGRkYWptaWRsaFZJZTlMSmZXbyI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjI6e3M6MzoidXJsIjtzOjMyOiJodHRwOi8vbG9jYWxob3N0OjgwMDAvaG91c2Vob2xkcyI7czo1OiJyb3V0ZSI7czoxNjoiaG91c2Vob2xkcy5pbmRleCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjI7fQ==', 1783259138),
('VYBnOcMvduQVf66M1yvLX9FQJCvJe2T0HwSitTLF', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiRnZ0MG5IUTk5QkNkTFNtRjJyQ3pqbUNPZ2l0emI3emx3bWFtOU1ueiI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjI6e3M6MzoidXJsIjtzOjM1OiJodHRwOi8vbG9jYWxob3N0OjgwMDAvc2VydmljZS1jYXNlcyI7czo1OiJyb3V0ZSI7czoxOToic2VydmljZS1jYXNlcy5pbmRleCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjI7fQ==', 1783608105),
('W6t5iUrjtn9bgDjZadB9fWkUvT5RVhKpJ8tdNACI', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoibnhhRlM0YjJLUFdhTGtzQTEwbVMxRzBNcHllaklac3ZQYXNtdWhRZyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDY6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9zb2NpYWwtd2VsZmFyZS9kYXNoYm9hcmQiO3M6NToicm91dGUiO3M6MjQ6InNvY2lhbC13ZWxmYXJlLmRhc2hib2FyZCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjI7fQ==', 1783437005),
('X4R1IduTT4NSyB6JfhJs0A9Zm5drXE9SjvP4HgU4', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiZDdDekZiQlBJMzBZNEFyNEZIOXFLclgyVkFNUmpoMFZrN1dFaEFpZiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMCI7czo1OiJyb3V0ZSI7Tjt9fQ==', 1783521847);

-- --------------------------------------------------------

--
-- Table structure for table `titles`
--

CREATE TABLE `titles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(20) NOT NULL,
  `name_th` varchar(100) NOT NULL,
  `name_en` varchar(100) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `titles`
--

INSERT INTO `titles` (`id`, `code`, `name_th`, `name_en`, `status`, `created_at`, `updated_at`) VALUES
(1, 'MR', 'นาย', NULL, 1, NULL, NULL),
(2, 'MRS', 'นาง', NULL, 1, NULL, NULL),
(3, 'MS', 'นางสาว', NULL, 1, NULL, NULL),
(4, 'CH', 'เด็กชาย', NULL, 1, NULL, NULL),
(5, 'CG', 'เด็กหญิง', NULL, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Test User', 'test@example.com', '2026-07-01 06:15:31', '$2y$12$E1/tI3fUI8PX381.eLdmU.46MG77clBwE1h2BqL3n7oRJvJZmtH4O', 'fHBZ4e9c3n', '2026-07-01 06:15:32', '2026-07-01 06:15:32'),
(2, 'admin', 'admin@test.com', NULL, '$2y$12$8mEdC3NjILK6GlZ4G9aJquBXmQQ0E./jJSaDIlhSxfWtEn3wA0vAi', NULL, '2026-07-03 06:27:40', '2026-07-03 06:27:40');

-- --------------------------------------------------------

--
-- Table structure for table `welfare_assistances`
--

CREATE TABLE `welfare_assistances` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `welfare_profiles`
--

CREATE TABLE `welfare_profiles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `citizen_id` bigint(20) UNSIGNED NOT NULL,
  `is_elderly` tinyint(1) NOT NULL DEFAULT 0,
  `is_disabled` tinyint(1) NOT NULL DEFAULT 0,
  `is_low_income` tinyint(1) NOT NULL DEFAULT 0,
  `is_vulnerable` tinyint(1) NOT NULL DEFAULT 0,
  `is_bedridden` tinyint(1) NOT NULL DEFAULT 0,
  `is_homebound` tinyint(1) NOT NULL DEFAULT 0,
  `remark` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `care_level` enum('normal','watch','home_visit','homebound','bedridden') NOT NULL DEFAULT 'normal',
  `risk_level` enum('low','medium','high','critical') NOT NULL DEFAULT 'low',
  `priority_level` enum('normal','urgent','emergency') NOT NULL DEFAULT 'normal'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `welfare_profiles`
--

INSERT INTO `welfare_profiles` (`id`, `citizen_id`, `is_elderly`, `is_disabled`, `is_low_income`, `is_vulnerable`, `is_bedridden`, `is_homebound`, `remark`, `created_at`, `updated_at`, `care_level`, `risk_level`, `priority_level`) VALUES
(1, 4, 1, 1, 1, 0, 1, 0, 'เพิ่ม Timeline การติดตามดูแล', '2026-07-07 07:59:12', '2026-07-08 06:02:56', 'watch', 'low', 'normal');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_expiration_index` (`expiration`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_locks_expiration_index` (`expiration`);

--
-- Indexes for table `citizens`
--
ALTER TABLE `citizens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `citizens_cid_unique` (`cid`),
  ADD KEY `citizens_cid_index` (`cid`),
  ADD KEY `citizens_household_id_index` (`household_id`);

--
-- Indexes for table `education_levels`
--
ALTER TABLE `education_levels`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `education_levels_code_unique` (`code`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `health_profiles`
--
ALTER TABLE `health_profiles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `health_profiles_citizen_id_unique` (`citizen_id`);

--
-- Indexes for table `households`
--
ALTER TABLE `households`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `households_house_code_unique` (`house_code`),
  ADD KEY `households_house_no_index` (`house_no`),
  ADD KEY `households_village_id_index` (`village_id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `nationalities`
--
ALTER TABLE `nationalities`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nationalities_code_unique` (`code`);

--
-- Indexes for table `occupations`
--
ALTER TABLE `occupations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `occupations_code_unique` (`code`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `religions`
--
ALTER TABLE `religions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `religions_code_unique` (`code`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `service_cases`
--
ALTER TABLE `service_cases`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `service_cases_case_no_unique` (`case_no`),
  ADD KEY `service_cases_citizen_id_foreign` (`citizen_id`),
  ADD KEY `service_cases_assigned_to_foreign` (`assigned_to`),
  ADD KEY `service_cases_created_by_foreign` (`created_by`),
  ADD KEY `service_cases_module_index` (`module`),
  ADD KEY `service_cases_case_type_index` (`case_type`),
  ADD KEY `service_cases_status_index` (`status`),
  ADD KEY `service_cases_priority_index` (`priority`);

--
-- Indexes for table `service_case_timelines`
--
ALTER TABLE `service_case_timelines`
  ADD PRIMARY KEY (`id`),
  ADD KEY `service_case_timelines_service_case_id_foreign` (`service_case_id`),
  ADD KEY `service_case_timelines_user_id_foreign` (`user_id`),
  ADD KEY `service_case_timelines_action_index` (`action`),
  ADD KEY `service_case_timelines_action_at_index` (`action_at`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `titles`
--
ALTER TABLE `titles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `titles_code_unique` (`code`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `welfare_assistances`
--
ALTER TABLE `welfare_assistances`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `welfare_profiles`
--
ALTER TABLE `welfare_profiles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `welfare_profiles_citizen_id_foreign` (`citizen_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `citizens`
--
ALTER TABLE `citizens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `education_levels`
--
ALTER TABLE `education_levels`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `health_profiles`
--
ALTER TABLE `health_profiles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `households`
--
ALTER TABLE `households`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `nationalities`
--
ALTER TABLE `nationalities`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `occupations`
--
ALTER TABLE `occupations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `religions`
--
ALTER TABLE `religions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `service_cases`
--
ALTER TABLE `service_cases`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `service_case_timelines`
--
ALTER TABLE `service_case_timelines`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `titles`
--
ALTER TABLE `titles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `welfare_assistances`
--
ALTER TABLE `welfare_assistances`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `welfare_profiles`
--
ALTER TABLE `welfare_profiles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `health_profiles`
--
ALTER TABLE `health_profiles`
  ADD CONSTRAINT `health_profiles_citizen_id_foreign` FOREIGN KEY (`citizen_id`) REFERENCES `citizens` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `service_cases`
--
ALTER TABLE `service_cases`
  ADD CONSTRAINT `service_cases_assigned_to_foreign` FOREIGN KEY (`assigned_to`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `service_cases_citizen_id_foreign` FOREIGN KEY (`citizen_id`) REFERENCES `citizens` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `service_cases_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `service_case_timelines`
--
ALTER TABLE `service_case_timelines`
  ADD CONSTRAINT `service_case_timelines_service_case_id_foreign` FOREIGN KEY (`service_case_id`) REFERENCES `service_cases` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `service_case_timelines_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `welfare_profiles`
--
ALTER TABLE `welfare_profiles`
  ADD CONSTRAINT `welfare_profiles_citizen_id_foreign` FOREIGN KEY (`citizen_id`) REFERENCES `citizens` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
