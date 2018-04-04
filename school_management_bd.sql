-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 04, 2018 at 06:03 PM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 7.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `school_management_bd`
--

-- --------------------------------------------------------

--
-- Table structure for table `class`
--

CREATE TABLE `class` (
  `id` int(10) UNSIGNED NOT NULL,
  `class_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `class`
--

INSERT INTO `class` (`id`, `class_name`) VALUES
(1, 'One'),
(2, 'Two'),
(3, 'Three'),
(4, 'Four'),
(5, 'Five'),
(6, 'Six'),
(7, 'Seven'),
(8, 'Eight'),
(9, 'Nine'),
(10, 'Ten');

-- --------------------------------------------------------

--
-- Table structure for table `class_routine`
--

CREATE TABLE `class_routine` (
  `id` int(10) UNSIGNED NOT NULL,
  `scl_code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `class_id` int(10) UNSIGNED NOT NULL,
  `time_id` int(10) UNSIGNED NOT NULL,
  `saturday` int(10) UNSIGNED NOT NULL,
  `sunday` int(10) UNSIGNED NOT NULL,
  `monday` int(10) UNSIGNED NOT NULL,
  `tuesday` int(10) UNSIGNED NOT NULL,
  `wednesday` int(10) UNSIGNED NOT NULL,
  `thursday` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `class_routine`
--

INSERT INTO `class_routine` (`id`, `scl_code`, `class_id`, `time_id`, `saturday`, `sunday`, `monday`, `tuesday`, `wednesday`, `thursday`, `created_at`, `updated_at`) VALUES
(1, 'KPHS', 2, 1, 1, 1, 1, 1, 1, 1, NULL, NULL),
(2, 'KPHS', 2, 2, 2, 2, 2, 2, 2, 2, NULL, NULL),
(3, 'KPHS', 2, 3, 4, 4, 4, 4, 4, 4, NULL, NULL),
(4, 'KPHS', 2, 4, 5, 5, 5, 5, 5, 5, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `class_time`
--

CREATE TABLE `class_time` (
  `id` int(10) UNSIGNED NOT NULL,
  `time` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `scl_code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `class_time`
--

INSERT INTO `class_time` (`id`, `time`, `scl_code`) VALUES
(1, '9:00am-9:45am', 'kphs'),
(2, '9:45am-10:30am', 'kphs'),
(3, '10:45am-11:15am', 'kphs'),
(4, '11:15am-12:00pm', 'kphs'),
(5, '12:00pm-12:45pm', 'kphs');

-- --------------------------------------------------------

--
-- Table structure for table `country`
--

CREATE TABLE `country` (
  `id` int(10) UNSIGNED NOT NULL,
  `country_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `country`
--

INSERT INTO `country` (`id`, `country_name`) VALUES
(1, 'Bangladesh'),
(2, 'India');

-- --------------------------------------------------------

--
-- Table structure for table `days`
--

CREATE TABLE `days` (
  `id` int(10) UNSIGNED NOT NULL,
  `day` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `days`
--

INSERT INTO `days` (`id`, `day`) VALUES
(3, 'Monday'),
(1, 'Saturday'),
(2, 'Sunday'),
(6, 'Thursday'),
(4, 'Tuesday'),
(5, 'Wednessday');

-- --------------------------------------------------------

--
-- Table structure for table `district`
--

CREATE TABLE `district` (
  `id` int(10) UNSIGNED NOT NULL,
  `district_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `division_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `district`
--

INSERT INTO `district` (`id`, `district_name`, `division_id`) VALUES
(1, 'Dhaka', 1),
(2, 'Narayangonj', 1),
(3, 'Gazipur', 1),
(4, 'Tangail', 1),
(5, 'Kishoregonj', 1),
(6, 'Narsingdi', 1),
(7, 'Gopalgonj', 1),
(8, 'Faridpur', 1);

-- --------------------------------------------------------

--
-- Table structure for table `division`
--

CREATE TABLE `division` (
  `id` int(10) UNSIGNED NOT NULL,
  `division_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `division`
--

INSERT INTO `division` (`id`, `division_name`, `country_id`) VALUES
(1, 'Dhaka', 1),
(2, 'Rajshahi', 1),
(3, 'Chittagong', 1),
(4, 'Rangpur', 1),
(5, 'Barisal', 1),
(6, 'Khulna', 1),
(7, 'Mymensing', 1),
(8, 'Sylhet', 1);

-- --------------------------------------------------------

--
-- Table structure for table `exam_costs`
--

CREATE TABLE `exam_costs` (
  `id` int(10) UNSIGNED NOT NULL,
  `school_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `exam_term_id` int(11) NOT NULL,
  `exam_fee` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `exam_term`
--

CREATE TABLE `exam_term` (
  `id` int(10) UNSIGNED NOT NULL,
  `exam_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `exam_term`
--

INSERT INTO `exam_term` (`id`, `exam_name`) VALUES
(1, 'First Term'),
(2, 'Second Term'),
(3, 'Final Term');

-- --------------------------------------------------------

--
-- Table structure for table `features`
--

CREATE TABLE `features` (
  `id` int(10) UNSIGNED NOT NULL,
  `feature` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `features`
--

INSERT INTO `features` (`id`, `feature`, `created_at`, `updated_at`) VALUES
(1, 'Student Management', NULL, NULL),
(2, 'Teacher Management', NULL, NULL),
(3, 'User Management', NULL, NULL),
(4, 'Parents Management', NULL, NULL),
(5, 'Exam Management', NULL, NULL),
(6, 'Fees Management', NULL, NULL),
(7, 'Result Management', NULL, NULL),
(8, 'Notice Board Management', NULL, NULL),
(9, 'Notification Management', NULL, NULL),
(10, 'Report Management', NULL, NULL),
(11, 'Class Routine Management', NULL, NULL),
(12, 'Staff Management', NULL, NULL),
(13, 'Staff Salary Management', NULL, NULL),
(14, 'Staff Promotion Management', NULL, NULL),
(15, 'Techer-Student Conversation', NULL, NULL),
(16, 'Techer-Techer Conversation', NULL, NULL),
(17, 'Student-Student Conversation', NULL, NULL),
(18, 'Admin Panel', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `guardians`
--

CREATE TABLE `guardians` (
  `id` int(10) UNSIGNED NOT NULL,
  `g_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `profession` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `org_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(3, '2018_02_27_135443_create_class_table', 1),
(4, '2018_02_27_135814_create_subject_table', 1),
(5, '2018_02_27_140229_create_super_admin_table', 1),
(6, '2018_02_27_141258_create_visitor_table', 1),
(8, '2018_02_27_151408_create_days_table', 1),
(9, '2018_02_27_192438_create_teachers_profiles_table', 1),
(10, '2018_02_27_192705_create_students_profiles_table', 1),
(11, '2018_02_27_193300_create_exam_term_table', 1),
(12, '2018_02_27_193816_create_office_costs_table', 1),
(13, '2018_02_27_194147_create_exam_costs_table', 1),
(14, '2018_02_27_194619_create_monthly_fee_table', 1),
(15, '2018_02_27_194834_create_months_table', 1),
(16, '2018_02_27_201020_create_warning_table', 1),
(17, '2018_02_27_201253_create_tasks_table', 1),
(18, '2018_02_27_201458_create_notifications_table', 1),
(19, '2018_02_27_202057_create_notice_board_table', 1),
(20, '2018_02_27_202255_create_work_sheet_table', 1),
(21, '2018_03_13_143641_create_schools_reg_table', 1),
(22, '2018_03_14_140222_create_country_table', 1),
(23, '2018_03_14_140816_create_district_table', 1),
(24, '2018_03_14_141104_create_thana_table', 1),
(25, '2018_03_14_141947_create_division_table', 1),
(26, '2018_03_17_130338_create_theme_table', 1),
(27, '2018_03_17_134248_create_super_admin_msg_table', 1),
(28, '2018_03_25_020322_create_guardians_table', 1),
(29, '2018_03_26_174116_create_features_table', 1),
(31, '2018_04_04_181631_create_class_time_table', 2),
(32, '2018_02_27_151021_create_class_routine_table', 3);

-- --------------------------------------------------------

--
-- Table structure for table `monthly_fee`
--

CREATE TABLE `monthly_fee` (
  `id` int(10) UNSIGNED NOT NULL,
  `school_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `month_id` int(11) NOT NULL,
  `fee` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `months`
--

CREATE TABLE `months` (
  `id` int(10) UNSIGNED NOT NULL,
  `month_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `months`
--

INSERT INTO `months` (`id`, `month_name`) VALUES
(1, 'January'),
(2, 'February'),
(3, 'March'),
(4, 'April'),
(5, 'May'),
(6, 'June'),
(7, 'July'),
(8, 'August'),
(9, 'September'),
(10, 'October'),
(11, 'November'),
(12, 'December');

-- --------------------------------------------------------

--
-- Table structure for table `notice_board`
--

CREATE TABLE `notice_board` (
  `id` int(10) UNSIGNED NOT NULL,
  `school_id` int(11) NOT NULL,
  `notice_details` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `publish_date` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(10) UNSIGNED NOT NULL,
  `request_user_id` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `office_costs`
--

CREATE TABLE `office_costs` (
  `id` int(10) UNSIGNED NOT NULL,
  `school_id` int(11) NOT NULL,
  `cost_description` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Table structure for table `schools_reg`
--

CREATE TABLE `schools_reg` (
  `id` int(10) UNSIGNED NOT NULL,
  `scl_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `scl_code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `scl_email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `scl_phone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `scl_establish_date` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `thana_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `scl_address` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `scl_expire_date` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `scl_password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `schools_reg`
--

INSERT INTO `schools_reg` (`id`, `scl_name`, `scl_code`, `scl_email`, `scl_phone`, `scl_establish_date`, `thana_id`, `scl_address`, `scl_expire_date`, `scl_password`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Kalaroa Pilot High School', 'KPHS', 'kphs@gmail.com', '01712451994', '2016-02-02', '1', 'zxg djrtjnrt jrtjryj ry', '2018-05-04', '202cb962ac59075b964b07152d234b70', 1, '2018-04-03 23:50:09', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `students_profiles`
--

CREATE TABLE `students_profiles` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `roll_no` int(11) NOT NULL,
  `fathers_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mothers_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `subject`
--

CREATE TABLE `subject` (
  `id` int(10) UNSIGNED NOT NULL,
  `subject_name_en` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subject_name_bn` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `subject`
--

INSERT INTO `subject` (`id`, `subject_name_en`, `subject_name_bn`, `created_at`, `updated_at`) VALUES
(1, 'Bangla', 'বাংলা', NULL, NULL),
(2, 'Enlish', 'ইংরেজি', NULL, NULL),
(3, 'Islam Religion', 'ইসলাম ধর্ম', NULL, NULL),
(4, 'Hindu Religion', 'হিন্দু ধর্ম', NULL, NULL),
(5, 'Mathematics', 'গণিত', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `super_admin`
--

CREATE TABLE `super_admin` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `super_admin`
--

INSERT INTO `super_admin` (`id`, `name`, `username`, `email`, `phone`, `password`, `created_at`, `updated_at`) VALUES
(1, 'Ruhul', 'superadmin', 'superadmin@gmail.com', '01638584622', '17c4520f6cfd1ab53d8745e84681eb49', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `super_admin_msg`
--

CREATE TABLE `super_admin_msg` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE `tasks` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `tasks` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `submission_date` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `teachers_profiles`
--

CREATE TABLE `teachers_profiles` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `subject_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fathers_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mothers_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `thana`
--

CREATE TABLE `thana` (
  `id` int(10) UNSIGNED NOT NULL,
  `thana_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `district_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `thana`
--

INSERT INTO `thana` (`id`, `thana_name`, `district_id`) VALUES
(1, 'Ramna', 1),
(2, 'Dhanmondi', 1);

-- --------------------------------------------------------

--
-- Table structure for table `theme`
--

CREATE TABLE `theme` (
  `id` int(10) UNSIGNED NOT NULL,
  `color_class_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `color_code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `theme`
--

INSERT INTO `theme` (`id`, `color_class_name`, `color_code`) VALUES
(1, 'default', '#4A8BC2'),
(2, 'green', '#74B749'),
(3, 'gray', '#2d2d2d'),
(4, 'purple', '#7265ae'),
(5, 'red', '#DE577B'),
(6, 'orange', 'orange');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `scl_code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `class_id` int(11) DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_of_birth` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `religion` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `thana_id` int(10) UNSIGNED NOT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pic` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rank` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `power` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `phone`, `scl_code`, `class_id`, `password`, `date_of_birth`, `gender`, `religion`, `thana_id`, `address`, `slug`, `pic`, `user_type`, `rank`, `power`, `status`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Mamun', 'mamun@gmail.com', '01712451994', 'kphs', 2, '202cb962ac59075b964b07152d234b70', '2004-03-02', 'male', 'Muslim', 1, 'rn k6nib46 j46uj64y', 'Mamun017124519948871', 'public/img/male.png', 'student', NULL, NULL, 1, NULL, '2018-04-04 11:52:23', NULL),
(2, 'Ruhul Amin', 'ruhulrahman2233@gmail.com', '1843867772', 'KPHS', 2, '202cb962ac59075b964b07152d234b70', '2004-01-01', 'male', 'Muslim', 1, '125/5, Tejkunipara', 'Ruhul Amin18438677728481', 'public/img/male.png', 'student', NULL, NULL, 1, NULL, '2018-04-04 11:53:19', NULL),
(3, 'Ruhul Amin', 'ruhulrahman@gmail.com', '01843867772', 'KPHS', NULL, '202cb962ac59075b964b07152d234b70', '1988-02-02', 'male', 'Muslim', 2, '125/5, Tejkunipara', 'Ruhul Amin018438677722730', 'public/img/female.png', 'teacher', 'Head Teacher', 'admin', 1, NULL, '2018-04-04 11:57:34', NULL),
(4, 'dkgdfh tryb', 'gfg2f@gmf.dgd', '21111', 'hlkn', NULL, '6351efe055f2f2bb1cfa0e244bc4ed58', '2017-03-02', 'male', 'Muslim', 1, 'eghetyn6b8k7ty', 'dkgdfh tryb211118694', 'public/img/female.png', 'teacher', 'n,m', NULL, 8694, NULL, '2018-04-04 12:02:03', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `visitors`
--

CREATE TABLE `visitors` (
  `id` int(10) UNSIGNED NOT NULL,
  `visitor` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `device` varchar(17) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `warning`
--

CREATE TABLE `warning` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `warning_details` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `work_sheet`
--

CREATE TABLE `work_sheet` (
  `id` int(10) UNSIGNED NOT NULL,
  `school_id` int(11) NOT NULL,
  `work_details` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `working_date` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `class`
--
ALTER TABLE `class`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `class_routine`
--
ALTER TABLE `class_routine`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `class_time`
--
ALTER TABLE `class_time`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `country`
--
ALTER TABLE `country`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `days`
--
ALTER TABLE `days`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `days_day_unique` (`day`);

--
-- Indexes for table `district`
--
ALTER TABLE `district`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `division`
--
ALTER TABLE `division`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `exam_costs`
--
ALTER TABLE `exam_costs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `exam_term`
--
ALTER TABLE `exam_term`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `features`
--
ALTER TABLE `features`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `guardians`
--
ALTER TABLE `guardians`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `monthly_fee`
--
ALTER TABLE `monthly_fee`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `months`
--
ALTER TABLE `months`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notice_board`
--
ALTER TABLE `notice_board`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `office_costs`
--
ALTER TABLE `office_costs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `schools_reg`
--
ALTER TABLE `schools_reg`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students_profiles`
--
ALTER TABLE `students_profiles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subject`
--
ALTER TABLE `subject`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `super_admin`
--
ALTER TABLE `super_admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `super_admin_msg`
--
ALTER TABLE `super_admin_msg`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teachers_profiles`
--
ALTER TABLE `teachers_profiles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `thana`
--
ALTER TABLE `thana`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `theme`
--
ALTER TABLE `theme`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_phone_unique` (`phone`);

--
-- Indexes for table `visitors`
--
ALTER TABLE `visitors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `warning`
--
ALTER TABLE `warning`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `work_sheet`
--
ALTER TABLE `work_sheet`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `class`
--
ALTER TABLE `class`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `class_routine`
--
ALTER TABLE `class_routine`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `class_time`
--
ALTER TABLE `class_time`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `country`
--
ALTER TABLE `country`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `days`
--
ALTER TABLE `days`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `district`
--
ALTER TABLE `district`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `division`
--
ALTER TABLE `division`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `exam_costs`
--
ALTER TABLE `exam_costs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `exam_term`
--
ALTER TABLE `exam_term`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `features`
--
ALTER TABLE `features`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `guardians`
--
ALTER TABLE `guardians`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `monthly_fee`
--
ALTER TABLE `monthly_fee`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `months`
--
ALTER TABLE `months`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `notice_board`
--
ALTER TABLE `notice_board`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `office_costs`
--
ALTER TABLE `office_costs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `schools_reg`
--
ALTER TABLE `schools_reg`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `students_profiles`
--
ALTER TABLE `students_profiles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `subject`
--
ALTER TABLE `subject`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `super_admin`
--
ALTER TABLE `super_admin`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `super_admin_msg`
--
ALTER TABLE `super_admin_msg`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `teachers_profiles`
--
ALTER TABLE `teachers_profiles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `thana`
--
ALTER TABLE `thana`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `theme`
--
ALTER TABLE `theme`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `visitors`
--
ALTER TABLE `visitors`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `warning`
--
ALTER TABLE `warning`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `work_sheet`
--
ALTER TABLE `work_sheet`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
