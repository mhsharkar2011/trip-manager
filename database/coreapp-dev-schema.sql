-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: data.dev.sandbox3000.com
-- Generation Time: Feb 16, 2023 at 04:29 PM
-- Server version: 5.7.36
-- PHP Version: 8.0.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `coreapp`
--

-- --------------------------------------------------------

--
-- Table structure for table `activity_log`
--

CREATE TABLE `activity_log` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `log_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `subject_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `event` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subject_id` bigint(20) UNSIGNED DEFAULT NULL,
  `causer_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `causer_id` bigint(20) UNSIGNED DEFAULT NULL,
  `properties` json DEFAULT NULL,
  `batch_uuid` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `screen_size` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone_os` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `duaration` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `attachments`
--

CREATE TABLE `attachments` (
  `id` int(10) UNSIGNED NOT NULL,
  `attachmentable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `attachmentable_id` int(11) NOT NULL,
  `uuid` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_directory` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mime_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `disk` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `size` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `category_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `category_item`
--

CREATE TABLE `category_item` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) NOT NULL,
  `item_id` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

CREATE TABLE `cities` (
  `id` int(11) NOT NULL,
  `city_name` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `comment` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `commentable_id` int(11) NOT NULL,
  `commentable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` enum('DECISION','NOTE','WARNING','POLICY','COMMENT') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'DECISION',
  `comment_by` int(11) NOT NULL,
  `project_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `companies`
--

CREATE TABLE `companies` (
  `id` int(11) NOT NULL,
  `owner_id` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `company_name` varchar(255) NOT NULL,
  `fiscal_year_end` varchar(40) NOT NULL,
  `company_type` varchar(40) NOT NULL,
  `company_code` longtext,
  `country` smallint(6) NOT NULL,
  `state` mediumint(9) NOT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `global_id_count` int(11) DEFAULT NULL,
  `logo` varchar(191) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `company_users`
--

CREATE TABLE `company_users` (
  `id` int(11) NOT NULL,
  `company_id` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `is_admin` int(11) DEFAULT NULL,
  `is_disable` int(11) DEFAULT NULL,
  `is_verified` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `day_leave_config`
--

CREATE TABLE `day_leave_config` (
  `id` bigint(20) NOT NULL,
  `yearly_casual_leave` int(11) DEFAULT NULL,
  `yearly_holidays` int(11) DEFAULT NULL,
  `yearly_sick_leave` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `day_leave_holiday`
--

CREATE TABLE `day_leave_holiday` (
  `id` bigint(20) NOT NULL,
  `holiday_date` date DEFAULT NULL,
  `holiday_title` varchar(255) DEFAULT NULL,
  `holiday_type` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `day_leave_records`
--

CREATE TABLE `day_leave_records` (
  `id` bigint(20) NOT NULL,
  `agree_flag` bit(1) NOT NULL,
  `company_id` int(11) DEFAULT NULL,
  `leave_reason` longtext,
  `leave_start` date DEFAULT NULL,
  `leave_type` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `total_day` int(11) DEFAULT NULL,
  `users_id` bigint(20) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `day_leave_userholiday_holiday`
--

CREATE TABLE `day_leave_userholiday_holiday` (
  `userholiday_id` bigint(20) NOT NULL,
  `holiday_id` bigint(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `day_leave_user_additional_holiday`
--

CREATE TABLE `day_leave_user_additional_holiday` (
  `id` bigint(20) NOT NULL,
  `holiday_reason` varchar(255) DEFAULT NULL,
  `holiday_title` varchar(255) DEFAULT NULL,
  `total_day_for_use` int(11) DEFAULT NULL,
  `user_id` bigint(20) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `day_leave_user_holiday`
--

CREATE TABLE `day_leave_user_holiday` (
  `id` bigint(20) NOT NULL,
  `user_id` bigint(20) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `day_leave_user_role`
--

CREATE TABLE `day_leave_user_role` (
  `user_id` bigint(20) NOT NULL,
  `role_id` bigint(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `email_verification`
--

CREATE TABLE `email_verification` (
  `id` int(10) UNSIGNED NOT NULL,
  `verification_code` varchar(255) NOT NULL,
  `json_data` text NOT NULL,
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `entities`
--

CREATE TABLE `entities` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `meta` json DEFAULT NULL,
  `is_generated` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `fields`
--

CREATE TABLE `fields` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type_label` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `meta` json DEFAULT NULL,
  `position` int(11) NOT NULL DEFAULT '0',
  `is_system_generated` tinyint(1) NOT NULL DEFAULT '0',
  `entity_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `hibernate_sequence`
--

CREATE TABLE `hibernate_sequence` (
  `next_val` bigint(20) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `live_cms_pages`
--

CREATE TABLE `live_cms_pages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `route` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `template` longtext COLLATE utf8mb4_unicode_ci,
  `template_checksum` int(10) UNSIGNED DEFAULT NULL,
  `path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `media`
--

CREATE TABLE `media` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `collection_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mime_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `disk` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `conversions_disk` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `size` bigint(20) UNSIGNED NOT NULL,
  `manipulations` json NOT NULL,
  `custom_properties` json NOT NULL,
  `generated_conversions` json NOT NULL,
  `responsive_images` json NOT NULL,
  `order_column` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `meetings`
--

CREATE TABLE `meetings` (
  `id` int(10) UNSIGNED NOT NULL,
  `meeting_name` varchar(255) NOT NULL,
  `initiator` varchar(100) DEFAULT NULL,
  `description` text,
  `meeting_date` datetime NOT NULL,
  `meeting_duration` time DEFAULT NULL,
  `initiative` tinyint(1) NOT NULL DEFAULT '0',
  `project_id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `owner_id` int(11) NOT NULL,
  `updated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `meeting_agendas`
--

CREATE TABLE `meeting_agendas` (
  `id` int(10) UNSIGNED NOT NULL,
  `agenda` varchar(255) NOT NULL,
  `outcome` text NOT NULL,
  `meeting_id` bigint(20) UNSIGNED NOT NULL,
  `project_id` int(11) NOT NULL,
  `owner_id` int(11) NOT NULL,
  `updated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `meeting_attendees`
--

CREATE TABLE `meeting_attendees` (
  `id` int(10) UNSIGNED NOT NULL,
  `meeting_id` bigint(20) UNSIGNED NOT NULL,
  `project_id` int(11) NOT NULL,
  `confirmed` enum('YES','NO','DECLINE') NOT NULL DEFAULT 'NO',
  `user_id` int(11) NOT NULL,
  `decline_reason` varchar(191) DEFAULT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `meeting_invites`
--

CREATE TABLE `meeting_invites` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `meeting_id` int(11) NOT NULL,
  `verification_code` varchar(128) NOT NULL,
  `completed` int(11) NOT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
(1, '2019_05_22_062300_create_password_resets_table', 1),
(2, '2019_05_23_101044_create_pmapp_card_types_table', 1),
(3, '2019_05_23_101045_create_pmapp_card_states_table', 1),
(4, '2019_05_23_101106_create_user_projects_table', 1),
(5, '2019_05_23_101700_create_pmapp_card_assigns_table', 1),
(6, '2019_05_23_101730_create_pmapp_time_spents_table', 1),
(7, '2019_05_23_101807_create_pmapp_state_change_histories_table', 1),
(8, '2019_05_29_074213_create_pmapp_type_states_table', 1),
(9, '2019_07_30_103510_create_pmapp_sessions_table', 1),
(10, '2019_08_28_100748_create_pmapp_releases_table', 1),
(11, '2019_08_28_102359_create_sprints_table', 1),
(12, '2019_08_29_103253_create_pmapp_release_projects_table', 1),
(13, '2019_08_29_121830_create_pmapp_release_cards_table', 1),
(14, '2019_08_29_124420_create_pmapp_sprint_cards_table', 2),
(15, '2019_08_30_101130_create_pmapp_sprint_projects_table', 2),
(16, '2019_09_02_051242_create_pmapp_card_users_table', 2),
(17, '2019_09_05_075954_create_pmapp_row_columns_table', 2),
(18, '2019_09_05_085057_create_pmapp_board_views_table', 2),
(19, '2019_09_05_091312_create_pmapp_board_card_types_table', 3),
(20, '2019_09_09_081240_add_release_id_to_pmapp_cards', 4),
(21, '2019_09_09_111542_add_project_id_to_pmapp_releases', 5),
(22, '2019_09_09_111711_add_project_id_to_pmapp_sprints', 5),
(23, '2019_09_10_115909_add_is_admin_to_users', 5),
(24, '2019_09_11_124732_pmapp_time_spends', 6),
(25, '2019_09_20_093910_create_pmapp_attachments_table', 7),
(26, '2019_09_23_090221_create_pmapp_comments_table', 7),
(27, '2019_09_23_122624_create_pmapp_project_states_table', 8),
(28, '2019_09_27_055445_add_work_hour_to_pmapp_time_spends', 9),
(29, '2019_09_30_102738_create_pmapp_board_view_users_table', 10),
(30, '2019_09_30_121334_add_parent_child_card_to_pmapp_cards', 11),
(31, '2019_09_30_124647_add_parent_child_card_to_pmapp_card_types', 12),
(32, '2019_10_03_061113_add_description_to_projects', 13),
(33, '2019_10_03_061444_add_description_to_pmapp_releases', 14),
(34, '2019_10_03_061538_add_description_to_pmapp_sprints', 15),
(35, '2019_10_04_074957_add_global_id_to_pmapp_releases', 15),
(36, '2019_10_04_075012_add_global_id_to_pmapp_sprints', 16),
(37, '2019_10_04_075039_add_global_id_to_projects', 17),
(38, '2019_10_04_075054_add_global_id_to_pmapp_cards', 17),
(39, '2019_10_04_081751_add_global_id_to_users', 17),
(40, '2019_10_04_081853_add_global_id_count_to_companies', 18),
(41, '2019_10_04_095810_create_pmapp_global_entities_table', 18),
(42, '2019_10_07_045724_create_pmapp_default_board_views_table', 18),
(43, '2019_10_10_100725_add_description_to_pmapp_time_spends', 18),
(49, '2019_05_23_101659_create_pmapp_cards_table', 0),
(50, '2020_02_25_120008_create_pmapp_project_description_table', 19),
(51, '2020_02_26_113032_add_user_id_to_pmapp_board_views_table', 20),
(52, '2020_03_11_050544_create_pmapp_business_value_table', 21),
(53, '2020_03_11_055726_create_pmapp_severity_sequence_table', 21),
(54, '2020_03_11_063842_add_severity_and_business_value_to_pmapp_cards_table', 21),
(55, '2020_03_12_035653_add_small_to_pmapp_board_views_table', 21),
(56, '2020_03_12_035922_add_medium_to_pmapp_board_views_table', 21),
(57, '2020_03_12_040010_add_large_to_pmapp_board_views_table', 21),
(58, '2020_03_17_102143_add_company_id_to_pmapp_board_views_table', 22),
(59, '2020_03_18_082915_create_company_users_table', 22),
(60, '2020_03_18_102612_add_company_code_to_companies_table', 22),
(61, '2020_03_25_031232_create_pmapp_card_history_table', 22),
(62, '2020_04_09_034316_create_pmapp_time_estimate_table', 23),
(63, '2020_04_24_030953_add_default_cost_users_table', 24),
(64, '2020_04_24_093836_add_cost_user_projects_table', 24),
(65, '2020_04_27_032934_create_pmapp_card_visualization_table', 25),
(66, '2020_04_28_050724_add_time_duration_to_pmapp_time_estimates_table', 26),
(67, '2020_05_04_054727_create_pmapp_status_table', 27),
(68, '2020_05_04_074425_add_project_status_to_projects_table', 28),
(69, '2020_05_07_091224_add_avatar_directory_to_users_table', 29),
(70, '2020_08_25_055815_create_pmapp_card_user_roles_table', 30),
(71, '2020_08_25_063304_add_user_role_to_pmapp_card_users_table', 30),
(72, '2020_09_14_045203_add_company_id_to_pmapp_card_states_table', 31),
(73, '2020_10_01_065145_add_is_seen_to_pmapp_card_users_table', 31),
(74, '2020_10_02_045538_create_pmapp_comment_mentions_table', 32),
(75, '2020_10_14_023017_add_is_disable_to_company_users_table', 33),
(76, '2020_10_15_062647_add_customer_request_to_pmapp_cards_table', 33),
(77, '2020_10_19_024725_create_pmapp_deployment_server_table', 34),
(78, '2020_10_19_041236_add_deployment_server_id_to_pmapp_cards_table', 34),
(79, '2020_10_27_025618_add_description_to_pmapp_deployment_server_table', 35),
(80, '2021_03_03_052806_create_pmapp_notifications_table', 36),
(81, '2021_03_15_093626_add_deployment_server_id_to_pmapp_release_table', 36),
(82, '2021_03_17_032437_create_pmapp_activity_table', 36),
(83, '2021_04_23_042451_add_action_type_to_pmapp_notifications_table', 37),
(84, '2021_06_01_022228_add_otp_code_to_users_table', 37),
(85, '2021_06_07_051534_add_color_code_to_projects_table', 38),
(86, '0000_00_00_000000_create_websockets_statistics_entries_table', 39),
(87, '2021_06_28_080223_add_color_to_pmapp_business_value_table', 39),
(88, '2021_07_15_095425_add_rates_to_users_table', 40),
(89, '2021_07_15_095634_add_rates_to_user_projects_table', 40),
(90, '2021_11_09_102627_add_is_report_item_to_pmapp_cards_table', 40),
(91, '2022_03_02_102958_create_pmapp_user_project_roles', 41),
(92, '2022_03_03_093214_add_user_project_role_id_to_user_projects_table', 41),
(93, '2014_10_12_000000_admin_create_users_table', 42),
(94, '2022_05_18_092849_add_skype_id_to_users_table', 43),
(95, '2022_05_20_101758_add_country_code_and_religion_to_users_table', 43),
(96, '2014_10_12_200000_add_two_factor_columns_to_users_table', 44),
(97, '2018_08_08_100000_create_telescope_entries_table', 44),
(98, '2019_08_19_000000_create_failed_jobs_table', 44),
(99, '2019_12_14_000001_create_personal_access_tokens_table', 44),
(100, '2020_05_21_100000_create_teams_table', 44),
(101, '2020_05_21_200000_create_team_user_table', 44),
(102, '2021_04_10_104606_create_entities_table', 44),
(103, '2021_04_10_111151_create_fields_table', 44),
(104, '2021_04_27_203812_create_media_table', 44),
(105, '2021_05_10_161308_livecms_create_pages_table', 44),
(106, '2021_05_21_103215_create_social_logins_table', 44),
(107, '2021_10_05_131503_add_password_recovery_code_to_users', 44),
(108, '2022_05_18_212641_create_category_item_table', 44),
(109, '2022_06_19_020728_create_progress_reports_table', 45),
(110, '2022_06_20_060648_add_report_id_to_report_recipients_table', 45),
(111, '2022_06_21_094757_create_report_recipients_table', 45),
(112, '2022_06_09_093350_add_logo_to_companies_table', 46),
(113, '2022_07_29_110108_create_supercards_categories_table', 46),
(114, '2022_07_29_110142_create_supercards_tags_table', 46),
(115, '2022_07_29_110216_create_supercards_card_tags_table', 46),
(116, '2022_08_03_070434_add_reject_reason_update_enum_meeting_atteendee_table', 47),
(117, '2022_08_03_070505_add_meeting_duration_to_meetings_table', 48),
(118, '2022_08_03_070533_change_initiator_column_nullable_meetings_table', 48),
(119, '2022_06_21_065215_create_report_categories_table', 49),
(120, '2022_06_21_065216_create_report_items_table', 49),
(121, '2022_06_21_105257_add_report_id_to_report_recipients_table', 50),
(122, '2022_06_23_101935_make_send_date_nullable_on_progress_reports_table', 50),
(123, '2022_07_29_125834_add_description_to_progress_reports_table', 51),
(124, '2022_08_09_121931_update_table_and_add_new_column_to_todos_table', 51),
(125, '2022_08_12_130732_create_report_attachments_table', 52),
(126, '2022_08_12_163250_create_supercards_project_tags_table', 52),
(127, '2022_08_17_130732_create_report_attachments_table', 53),
(129, '2022_08_15_124615_create_todo_assign_users_table', 55),
(131, '2022_08_21_180505_add_description_to_meetings_table', 55),
(132, '2022_08_23_172710_create_media_table', 56),
(133, '2022_08_26_084627_add_company_id_to_todos_table', 56),
(134, '2022_08_29_125834_add_description_to_progress_reports_table', 57),
(135, '2022_08_29_092950_create_comments_table', 58),
(136, '2022_08_31_093550_add_initiative_to_meetings_table', 58),
(137, '2022_08_29_125834_add_report_summary_to_progress_reports_table', 59),
(138, '2022_08_16_174833_create_attachments_table', 60),
(139, '2022_08_17_140212_create_report_attachments_table', 61),
(140, '2022_09_02_105439_add_report_item_id_to_report_attachments_table', 61),
(145, '2022_09_09_105813_add_email_verification_code_to_users_table', 62),
(146, '2022_09_13_082912_add_comment_by_to_comments_table', 63),
(147, '2022_09_16_074511_create_report_app_comments_table', 64),
(148, '2014_10_12_000000_create_users_table', 65),
(149, '2014_10_12_000001_add_new_columns_to_users_table', 65),
(150, '2014_10_12_100000_create_password_resets_table', 65),
(151, '2020_09_19_062623_create_sessions_table', 65),
(152, '2021_08_02_174428_create_checklist_categories_table', 65),
(153, '2021_08_03_160252_create_checklists_table', 65),
(154, '2021_08_04_164428_create_stages_table', 65),
(155, '2021_08_05_164428_create_tasks_table', 65),
(156, '2021_08_05_164430_add_new_columns_to_pmapp_cards_table', 65),
(157, '2021_08_05_171819_create_item_categories_table', 65),
(158, '2021_08_05_171820_create_item_types_table', 65),
(159, '2021_08_05_171823_create_items_table', 65),
(160, '2021_08_09_063709_create_rfqs_table', 65),
(161, '2021_08_11_061704_create_bids_table', 65),
(162, '2021_08_11_110909_create_statuses_table', 65),
(163, '2021_08_12_133938_create_userables_table', 65),
(164, '2021_08_19_065122_create_statusables_table', 65),
(165, '2021_09_02_051321_create_notification_events_table', 65),
(166, '2021_09_02_090835_create_notification_event_types_table', 65),
(167, '2021_09_04_054235_create_notification_event_details_table', 65),
(168, '2021_09_13_034206_create_consultances_table', 65),
(169, '2021_09_17_043815_create_chats_table', 65),
(170, '2021_10_06_082418_create_payments_table', 65),
(171, '2021_10_22_100240_add_description_to_consultances_table', 65),
(172, '2021_11_09_132933_alter_users_table_add_gcal_token_expiry', 65),
(173, '2021_11_10_065117_alter_users_table_add_notes_column', 65),
(174, '2021_11_10_072432_alter_tasks_table_add_related_tasks_field', 65),
(175, '2021_11_11_060917_create_rfq_users_table', 65),
(176, '2021_11_11_134305_add_charge_id_to_payments_table', 65),
(177, '2021_11_12_050445_add_new_event_data_to_notification_events_table', 65),
(178, '2021_11_12_100704_alter_tasks_table_add_more_columns', 65),
(179, '2021_11_23_051858_create_services_table', 65),
(180, '2021_11_23_104659_add_calendar_event_id_to_consultances_table', 65),
(181, '2021_11_25_034017_add_country_code_to_users_table', 65),
(182, '2021_11_26_014824_create_rfq_media_table', 65),
(183, '2021_11_26_040436_add_service_id_to_rfqs_table', 65),
(184, '2021_12_09_042524_create_service_users_table', 65),
(185, '2021_12_10_113909_add_event_data_to_notification_events_table', 65),
(186, '2021_12_13_135500_alter_consultances_table_add_zoom_meeting_fields', 65),
(187, '2021_12_14_043136_add_time_zone_to_consultances_table', 65),
(188, '2021_12_20_031057_create_serviceables_table', 65),
(189, '2021_12_29_032932_add_confirm_date_to_consultances_table', 65),
(190, '2022_01_04_121129_create_activity_log_table', 65),
(191, '2022_01_04_121130_add_event_column_to_activity_log_table', 65),
(192, '2022_01_04_121131_add_batch_uuid_column_to_activity_log_table', 65),
(193, '2022_02_08_084019_add_paid_to_items_table', 65),
(194, '2022_03_09_094518_create_tags_table', 65),
(195, '2022_03_10_030436_create_goal_tags_table', 65),
(196, '2022_03_10_030728_create_checklist_tags_table', 65),
(197, '2022_03_10_092202_create_settings_table', 65),
(198, '2022_03_11_022047_add_is_complete_to_checklists_table', 65),
(199, '2022_03_11_024316_add_joining_date_to_users_table', 65),
(200, '2022_03_11_085555_add_parent_id_to_tasks_table', 65),
(201, '2022_03_15_093648_add_is_quit_to_checklists_table', 65),
(202, '2022_03_28_080151_add_is_admin_added_to_tags_table', 65),
(203, '2022_04_07_094238_add_is_promote_to_checklists_table', 65),
(204, '2022_04_08_065035_add_firebase_token_to_users_table', 65),
(205, '2022_04_11_051055_create_schedule_notifications_table', 65),
(206, '2022_04_11_074543_create_user_notifications_table', 65),
(207, '2022_04_12_171808_add_os_system_to_activity_log_table', 65),
(208, '2022_06_27_064619_add_otp_code_to_users_table', 65),
(209, '2022_09_19_084442_add_change_column_name_to_sparkflowz_serviceables_table', 65),
(210, '2022_09_20_072657_add_change_column_name_to_projects_table', 65),
(211, '2022_09_26_100522_create_stageables_table', 65),
(212, '2022_10_03_174556_create_project_visions_table', 66),
(213, '2022_10_04_083332_create_project_narratives_table', 66),
(214, '2019_09_22_090221_create_comment_types_table', 67),
(215, '2022_10_05_071130_add_comment_type_pmapp_comments_table', 67),
(216, '2022_10_10_081656_create_report_item_attachments_table', 68),
(217, '2022_09_29_110029_add_sequence_id_to_pmapp_cards', 69),
(221, '2022_09_07_113713_create_report_app_jobs_table', 71),
(222, '2022_09_08_041714_create_report_app_milestones_table', 71),
(223, '2022_10_12_065657_add_decription_to_report_app_jobs_table', 72),
(224, '2022_10_17_095130_add_created_user_id_to_reports_app_jobs_milestones_table', 73),
(225, '2022_10_18_061429_create_pmapp_related_cards_table', 74),
(227, '2022_10_21_112751_add_assigned_by_to_pmapp_card_users_table', 75),
(228, '2022_10_26_033308_add_job_id_to_progress_reports_table', 76),
(229, '2022_10_25_120641_add_email_verified_at_to_users_table', 77),
(230, '2022_10_24_103911_add_type_to_pmapp_comments_table', 78),
(231, '2022_10_26_103850_add_mime_type_to_pmapp_attachments_table', 78),
(232, '2022_10_28_063158_add_type_to_supercards_categories_table', 79),
(233, '2022_09_06_112953_add_meeting_agenda_id_and_due_date_to_pmapp_cards_table', 80),
(234, '2022_11_01_063741_alter_meeting_duration_nullable_to_meetings_table', 81),
(235, '2022_10_26_102127_create_pmapp_user_avatars_table', 82),
(236, '2022_11_14_095050_add_resize_avatar_to_users_table', 82),
(237, '2022_11_15_042056_create_roles_table', 82),
(242, '2022_11_15_115611_add_feature_story_id_to_pmapp_cards_table', 82),
(243, '2022_11_15_060756_create_project_features_table', 83),
(244, '2022_11_15_070623_create_project_feature_roles_table', 83),
(245, '2022_11_15_092758_create_feature_stories_table', 83),
(246, '2022_11_15_112539_create_feature_story_roles_table', 83),
(247, '2022_11_23_050520_create_external_recipients_table', 84),
(248, '2022_11_28_135001_create_report_sent_users_table', 85),
(249, '2022_12_01_140025_add_company_id_to_supercards_categories_table', 86),
(250, '2022_12_01_150918_create_project_categories_table', 86),
(251, '2022_12_01_191407_add_avatar_resize_to_projects_table', 86),
(252, '2022_12_07_183049_add_project_id_to_report_categories_table', 87),
(253, '2022_12_09_045224_add_description_to_pmapp_roles_table', 88),
(263, '2022_12_13_210030_create_endpoints_table', 89),
(264, '2022_12_14_065057_create_attributes_table', 89),
(265, '2022_12_14_073052_create_endpoint_views_table', 89),
(266, '2022_12_14_091416_create_context_variables_table', 89),
(267, '2022_12_14_145330_create_properties_table', 89),
(268, '2022_12_14_175158_create_components_table', 89),
(269, '2022_12_14_183423_create_actions_table', 89),
(270, '2022_12_14_194243_create_action_roles_table', 89),
(271, '2022_12_15_040310_create_gates_table', 89),
(272, '2022_12_14_095013_create_pmapp_release_deployment_server_table', 90),
(273, '2022_12_27_113958_add_project_id_to_report_sent_users_table', 91),
(274, '2023_01_02_082748_create_favourite_meetings_table', 92),
(275, '2023_01_04_084057_add_end_date_to_report_app_milestones_table', 93),
(276, '2023_01_19_050953_add_avatar_resize_to_pmapp_attachments_table', 94),
(277, '2023_01_20_104726_add_report_type_to_progress_reports_table', 95),
(278, '2023_01_24_054857_add_time_estimate_to_pmapp_cards_table', 96),
(279, '2023_01_27_133157_add_time_estimate_to_pmapp_project_features_table', 97);

-- --------------------------------------------------------

--
-- Table structure for table `notification_events`
--

CREATE TABLE `notification_events` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sent_when` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `template_variables` json DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `notification_event_details`
--

CREATE TABLE `notification_event_details` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `notification_event_id` int(11) DEFAULT NULL,
  `notification_event_type_id` int(11) DEFAULT NULL,
  `tenant_id` int(11) DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT NULL,
  `to` json DEFAULT NULL,
  `subject` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `body` longtext COLLATE utf8mb4_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `notification_event_types`
--

CREATE TABLE `notification_event_types` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_clients`
--

CREATE TABLE `oauth_clients` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `oauth_provider` varchar(20) NOT NULL,
  `oauth_uid` varchar(255) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `gender` varchar(50) NOT NULL,
  `locale` varchar(100) NOT NULL,
  `picture` varchar(255) NOT NULL,
  `link` varchar(255) NOT NULL,
  `actie` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ob_bounties`
--

CREATE TABLE `ob_bounties` (
  `id` int(10) UNSIGNED NOT NULL,
  `coins` int(11) UNSIGNED NOT NULL,
  `owner_id` int(11) UNSIGNED NOT NULL,
  `category_id` int(11) NOT NULL,
  `comment` varchar(255) NOT NULL,
  `to_user` int(11) UNSIGNED NOT NULL,
  `project_id` int(11) UNSIGNED NOT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ob_bounty_accounts`
--

CREATE TABLE `ob_bounty_accounts` (
  `id` int(10) UNSIGNED NOT NULL,
  `silver_coin` int(11) NOT NULL,
  `gold_coin` int(11) NOT NULL,
  `platinum_coin` int(11) NOT NULL,
  `owner_id` int(11) NOT NULL,
  `updated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ob_bounty_balance`
--

CREATE TABLE `ob_bounty_balance` (
  `id` int(10) UNSIGNED NOT NULL,
  `silver_coin` int(11) NOT NULL,
  `gold_coin` int(11) NOT NULL,
  `platinum_coin` int(11) NOT NULL,
  `owner_id` int(11) NOT NULL,
  `balance_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ob_categories`
--

CREATE TABLE `ob_categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `owner_id` int(11) UNSIGNED NOT NULL,
  `project_id` int(11) UNSIGNED NOT NULL,
  `created_by` int(11) NOT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `office_assistant_additional_holiday`
--

CREATE TABLE `office_assistant_additional_holiday` (
  `id` bigint(20) NOT NULL,
  `holiday_reason` varchar(255) DEFAULT NULL,
  `holiday_title` varchar(255) DEFAULT NULL,
  `total_day_for_use` int(11) DEFAULT NULL,
  `user_id` bigint(20) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `office_assistant_attachments`
--

CREATE TABLE `office_assistant_attachments` (
  `id` bigint(20) NOT NULL,
  `details` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `entity_id` int(11) DEFAULT NULL,
  `entity_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_default` bit(1) DEFAULT NULL,
  `mime_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `original_file_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `office_assistant_bill`
--

CREATE TABLE `office_assistant_bill` (
  `id` int(11) NOT NULL,
  `details` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `from_date` date DEFAULT NULL,
  `short_description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `to_date` date DEFAULT NULL,
  `status_id` int(11) DEFAULT NULL,
  `user_id` bigint(20) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `office_assistant_config`
--

CREATE TABLE `office_assistant_config` (
  `id` bigint(20) NOT NULL,
  `yearly_casual_leave` int(11) DEFAULT NULL,
  `yearly_holidays` int(11) DEFAULT NULL,
  `yearly_sick_leave` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `office_assistant_document_category`
--

CREATE TABLE `office_assistant_document_category` (
  `id` bigint(20) NOT NULL,
  `category_description` longtext,
  `category_name` varchar(255) DEFAULT NULL,
  `company_id` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `office_assistant_document_files`
--

CREATE TABLE `office_assistant_document_files` (
  `id` bigint(20) NOT NULL,
  `file_description` longtext,
  `file_name` varchar(255) DEFAULT NULL,
  `fileurl` varchar(255) DEFAULT NULL,
  `large_description` longtext,
  `category_id` bigint(20) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `office_assistant_holiday`
--

CREATE TABLE `office_assistant_holiday` (
  `id` bigint(20) NOT NULL,
  `holiday_date` date DEFAULT NULL,
  `holiday_title` varchar(255) DEFAULT NULL,
  `holiday_type` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `office_assistant_records`
--

CREATE TABLE `office_assistant_records` (
  `id` bigint(20) NOT NULL,
  `agree_flag` bit(1) NOT NULL,
  `company_id` int(11) DEFAULT NULL,
  `leave_reason` longtext,
  `leave_start` date DEFAULT NULL,
  `leave_type` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `total_day` int(11) DEFAULT NULL,
  `users_id` bigint(20) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `office_assistant_status`
--

CREATE TABLE `office_assistant_status` (
  `id` int(11) NOT NULL,
  `dbname` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `office_assistant_user_holiday`
--

CREATE TABLE `office_assistant_user_holiday` (
  `id` bigint(20) NOT NULL,
  `user_id` bigint(20) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `og_teams`
--

CREATE TABLE `og_teams` (
  `id` int(10) UNSIGNED NOT NULL,
  `team_name` varchar(100) NOT NULL,
  `ea_id` int(10) UNSIGNED NOT NULL,
  `image_name` varchar(255) NOT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `og_team_members`
--

CREATE TABLE `og_team_members` (
  `id` int(10) UNSIGNED NOT NULL,
  `team_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pmapp_activity`
--

CREATE TABLE `pmapp_activity` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `project_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `card_id` int(11) DEFAULT NULL,
  `release_id` int(11) DEFAULT NULL,
  `sprint_id` int(11) DEFAULT NULL,
  `comment_id` int(11) DEFAULT NULL,
  `action` longtext COLLATE utf8mb4_unicode_ci,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pmapp_attachments`
--

CREATE TABLE `pmapp_attachments` (
  `id` int(10) UNSIGNED NOT NULL,
  `card_id` int(10) UNSIGNED DEFAULT NULL,
  `file_directory` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `src_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mime_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `avatar_resize` json DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pmapp_board_card_types`
--

CREATE TABLE `pmapp_board_card_types` (
  `id` int(10) UNSIGNED NOT NULL,
  `board_view_id` int(10) UNSIGNED DEFAULT NULL,
  `card_type_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pmapp_board_views`
--

CREATE TABLE `pmapp_board_views` (
  `id` int(10) UNSIGNED NOT NULL,
  `board_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `column_id` int(10) UNSIGNED DEFAULT NULL,
  `row_id` int(10) UNSIGNED DEFAULT NULL,
  `project_id` int(10) UNSIGNED DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `company_id` int(11) DEFAULT NULL,
  `small` longtext COLLATE utf8mb4_unicode_ci,
  `medium` longtext COLLATE utf8mb4_unicode_ci,
  `large` longtext COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pmapp_board_view_users`
--

CREATE TABLE `pmapp_board_view_users` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `board_view_id` int(10) UNSIGNED DEFAULT NULL,
  `is_owner` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pmapp_business_value`
--

CREATE TABLE `pmapp_business_value` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `color_code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sequence` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pmapp_cards`
--

CREATE TABLE `pmapp_cards` (
  `id` int(10) UNSIGNED NOT NULL,
  `project_id` int(10) UNSIGNED DEFAULT NULL,
  `card_type_id` int(10) UNSIGNED DEFAULT NULL,
  `parent_card_type` int(10) UNSIGNED DEFAULT NULL,
  `child_card_type` int(10) UNSIGNED DEFAULT NULL,
  `created_user_id` int(10) UNSIGNED DEFAULT NULL,
  `parent_id` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `state_id` int(10) UNSIGNED DEFAULT NULL,
  `release_id` int(10) UNSIGNED DEFAULT NULL,
  `sprint_id` int(10) UNSIGNED DEFAULT NULL,
  `business_value_id` int(11) DEFAULT NULL,
  `severity_sequence_id` int(11) DEFAULT NULL,
  `is_customer_request` tinyint(1) NOT NULL DEFAULT '0',
  `deployment_server_id` int(11) NOT NULL DEFAULT '0',
  `global_id` int(11) DEFAULT NULL,
  `sequence_id` double DEFAULT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `comments` longtext COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_report_item` tinyint(1) DEFAULT NULL,
  `start_date` datetime DEFAULT NULL,
  `due_date` datetime DEFAULT NULL,
  `meeting_id` int(10) UNSIGNED DEFAULT NULL,
  `agenda_id` bigint(20) UNSIGNED DEFAULT NULL,
  `priority` int(11) DEFAULT NULL,
  `checklist_id` int(10) UNSIGNED DEFAULT NULL,
  `is_complete` tinyint(1) NOT NULL DEFAULT '0',
  `stage_id` int(10) UNSIGNED DEFAULT NULL,
  `related_task` text COLLATE utf8mb4_unicode_ci,
  `calendar` text COLLATE utf8mb4_unicode_ci,
  `warning` text COLLATE utf8mb4_unicode_ci,
  `inspection` text COLLATE utf8mb4_unicode_ci,
  `feature_story_id` bigint(20) UNSIGNED DEFAULT NULL,
  `time_estimate` double NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pmapp_card_assigns`
--

CREATE TABLE `pmapp_card_assigns` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `card_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pmapp_card_history`
--

CREATE TABLE `pmapp_card_history` (
  `id` int(10) UNSIGNED NOT NULL,
  `card_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `action` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_time` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pmapp_card_states`
--

CREATE TABLE `pmapp_card_states` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sequence` int(11) NOT NULL,
  `company_id` int(11) DEFAULT NULL,
  `default` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pmapp_card_types`
--

CREATE TABLE `pmapp_card_types` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent_id` int(10) UNSIGNED DEFAULT NULL,
  `child_id` int(10) UNSIGNED DEFAULT NULL,
  `color` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pmapp_card_users`
--

CREATE TABLE `pmapp_card_users` (
  `id` int(10) UNSIGNED NOT NULL,
  `card_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `user_role_id` int(10) UNSIGNED NOT NULL DEFAULT '1',
  `is_seen` tinyint(1) NOT NULL DEFAULT '0',
  `assigned_by` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pmapp_card_user_roles`
--

CREATE TABLE `pmapp_card_user_roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_role` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sequence` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pmapp_card_visualization`
--

CREATE TABLE `pmapp_card_visualization` (
  `id` int(10) UNSIGNED NOT NULL,
  `board_view_id` int(10) UNSIGNED DEFAULT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `value` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `color` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pmapp_comments`
--

CREATE TABLE `pmapp_comments` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `card_id` int(10) UNSIGNED DEFAULT NULL,
  `comment` longtext COLLATE utf8mb4_unicode_ci,
  `type` enum('DECISION','NOTE','WARNING','POLICY','COMMENT') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `comment_type_id` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pmapp_comment_mentions`
--

CREATE TABLE `pmapp_comment_mentions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `comment_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `is_seen` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pmapp_comment_types`
--

CREATE TABLE `pmapp_comment_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `company_id` int(11) NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sequence` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pmapp_default_board_views`
--

CREATE TABLE `pmapp_default_board_views` (
  `id` int(10) UNSIGNED NOT NULL,
  `board_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `column_id` int(10) UNSIGNED DEFAULT NULL,
  `row_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pmapp_deployment_server`
--

CREATE TABLE `pmapp_deployment_server` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `company_id` int(11) NOT NULL,
  `project_id` int(11) DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `sequence` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pmapp_favourite_meetings`
--

CREATE TABLE `pmapp_favourite_meetings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `meeting_id` int(10) UNSIGNED DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pmapp_feature_stories`
--

CREATE TABLE `pmapp_feature_stories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `project_feature_id` bigint(20) UNSIGNED DEFAULT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `time_estimate` double NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pmapp_feature_story_roles`
--

CREATE TABLE `pmapp_feature_story_roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `feature_story_id` bigint(20) UNSIGNED DEFAULT NULL,
  `role_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pmapp_global_entities`
--

CREATE TABLE `pmapp_global_entities` (
  `id` int(10) UNSIGNED NOT NULL,
  `company_id` int(10) UNSIGNED NOT NULL,
  `global_id` int(11) DEFAULT NULL,
  `entity_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pmapp_notifications`
--

CREATE TABLE `pmapp_notifications` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_project_id` int(11) NOT NULL,
  `created_user_id` int(11) NOT NULL,
  `action_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `action_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `details` json DEFAULT NULL,
  `is_seen` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pmapp_project_description`
--

CREATE TABLE `pmapp_project_description` (
  `id` int(10) UNSIGNED NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `project_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pmapp_project_features`
--

CREATE TABLE `pmapp_project_features` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `company_id` int(11) NOT NULL,
  `project_id` bigint(20) UNSIGNED DEFAULT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `time_estimate` double NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pmapp_project_feature_roles`
--

CREATE TABLE `pmapp_project_feature_roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `project_feature_id` bigint(20) UNSIGNED DEFAULT NULL,
  `role_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pmapp_project_narratives`
--

CREATE TABLE `pmapp_project_narratives` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `project_id` int(10) UNSIGNED DEFAULT NULL,
  `narrative_title` longtext COLLATE utf8mb4_unicode_ci,
  `narrative_description` longtext COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pmapp_project_states`
--

CREATE TABLE `pmapp_project_states` (
  `id` int(10) UNSIGNED NOT NULL,
  `project_id` int(10) UNSIGNED DEFAULT NULL,
  `card_state_id` int(10) UNSIGNED DEFAULT NULL,
  `sequence` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pmapp_project_visions`
--

CREATE TABLE `pmapp_project_visions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `project_id` int(10) UNSIGNED DEFAULT NULL,
  `vision_title` longtext COLLATE utf8mb4_unicode_ci,
  `vision_description` longtext COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pmapp_related_cards`
--

CREATE TABLE `pmapp_related_cards` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `card_id` int(10) UNSIGNED NOT NULL,
  `related_card_id` int(10) UNSIGNED NOT NULL,
  `related_type` enum('RELATED CARD','BLOCKER OF','DEPENDS ON') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'RELATED CARD',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pmapp_releases`
--

CREATE TABLE `pmapp_releases` (
  `id` int(10) UNSIGNED NOT NULL,
  `project_id` int(10) UNSIGNED DEFAULT NULL,
  `global_id` int(11) DEFAULT NULL,
  `deployment_server_id` int(11) DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pmapp_release_cards`
--

CREATE TABLE `pmapp_release_cards` (
  `id` int(10) UNSIGNED NOT NULL,
  `release_id` int(10) UNSIGNED NOT NULL,
  `card_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pmapp_release_deployment_server`
--

CREATE TABLE `pmapp_release_deployment_server` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `release_id` int(11) NOT NULL,
  `deployment_server_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pmapp_release_projects`
--

CREATE TABLE `pmapp_release_projects` (
  `id` int(10) UNSIGNED NOT NULL,
  `release_id` int(10) UNSIGNED NOT NULL,
  `project_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pmapp_roles`
--

CREATE TABLE `pmapp_roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `company_id` int(11) NOT NULL,
  `project_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `sequence` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pmapp_row_columns`
--

CREATE TABLE `pmapp_row_columns` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sequence` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pmapp_severity_sequence`
--

CREATE TABLE `pmapp_severity_sequence` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sequence` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pmapp_sprints`
--

CREATE TABLE `pmapp_sprints` (
  `id` int(10) UNSIGNED NOT NULL,
  `project_id` int(10) UNSIGNED DEFAULT NULL,
  `release_id` int(10) UNSIGNED DEFAULT NULL,
  `global_id` int(11) DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pmapp_sprint_cards`
--

CREATE TABLE `pmapp_sprint_cards` (
  `id` int(10) UNSIGNED NOT NULL,
  `sprint_id` int(10) UNSIGNED NOT NULL,
  `card_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pmapp_sprint_projects`
--

CREATE TABLE `pmapp_sprint_projects` (
  `id` int(10) UNSIGNED NOT NULL,
  `sprint_id` int(10) UNSIGNED NOT NULL,
  `project_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pmapp_state_change_histories`
--

CREATE TABLE `pmapp_state_change_histories` (
  `id` int(10) UNSIGNED NOT NULL,
  `state_id` int(10) UNSIGNED NOT NULL,
  `card_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pmapp_status`
--

CREATE TABLE `pmapp_status` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `status_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sequence` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pmapp_time_estimates`
--

CREATE TABLE `pmapp_time_estimates` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `card_id` int(10) UNSIGNED DEFAULT NULL,
  `hour` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '00',
  `minute` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '00',
  `day` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `duration` bigint(20) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pmapp_time_spends`
--

CREATE TABLE `pmapp_time_spends` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `card_id` int(10) UNSIGNED DEFAULT NULL,
  `start_time` datetime DEFAULT NULL,
  `end_time` datetime DEFAULT NULL,
  `work_date` datetime DEFAULT NULL,
  `duration` bigint(20) NOT NULL DEFAULT '0',
  `work_hour` bigint(20) DEFAULT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pmapp_type_states`
--

CREATE TABLE `pmapp_type_states` (
  `id` int(10) UNSIGNED NOT NULL,
  `card_type_id` int(10) UNSIGNED NOT NULL,
  `card_state_id` int(10) UNSIGNED NOT NULL,
  `sequence` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pmapp_user_avatars`
--

CREATE TABLE `pmapp_user_avatars` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `avatar_dir` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `avatar` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `large` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `medium` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `small` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pmapp_user_project_roles`
--

CREATE TABLE `pmapp_user_project_roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `owner_id` int(11) NOT NULL,
  `post_title` varchar(255) NOT NULL,
  `post_category` enum('politics','science','culture','travel') NOT NULL,
  `category_id` int(11) NOT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `post_authors`
--

CREATE TABLE `post_authors` (
  `id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `author_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `progress_reports`
--

CREATE TABLE `progress_reports` (
  `id` int(10) UNSIGNED NOT NULL,
  `report_code` varchar(255) NOT NULL,
  `company_id` int(10) UNSIGNED NOT NULL,
  `from_date` date NOT NULL,
  `to_date` date NOT NULL,
  `send_date` datetime DEFAULT NULL,
  `project_id` int(11) NOT NULL,
  `state` enum('DRAFT','READY','SENT') NOT NULL DEFAULT 'DRAFT',
  `owner_id` int(11) NOT NULL,
  `report_summary` longtext,
  `updated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `report_app_job_id` bigint(20) UNSIGNED DEFAULT NULL,
  `report_type` varchar(191) DEFAULT 'REPORT'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `id` int(10) UNSIGNED NOT NULL,
  `company_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `owner_id` int(10) UNSIGNED NOT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `global_id` int(11) DEFAULT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `archived` tinyint(1) NOT NULL,
  `status_id` varchar(191) DEFAULT NULL,
  `color_code` varchar(191) DEFAULT NULL,
  `logo` varchar(191) DEFAULT NULL,
  `is_complete` tinyint(1) NOT NULL DEFAULT '0',
  `is_quit` tinyint(1) NOT NULL DEFAULT '0',
  `joinDate` date DEFAULT NULL,
  `mandatory_type` varchar(255) DEFAULT NULL,
  `total_task` int(11) NOT NULL DEFAULT '0',
  `completed_task` int(11) NOT NULL DEFAULT '0',
  `task_List` json DEFAULT NULL,
  `is_promote` tinyint(1) NOT NULL DEFAULT '0',
  `checklist_type` varchar(255) DEFAULT NULL,
  `publish_date` date DEFAULT NULL,
  `is_recurring` tinyint(1) NOT NULL DEFAULT '0',
  `recur_interval` varchar(255) DEFAULT NULL,
  `parent_id` varchar(255) DEFAULT NULL,
  `partipant_count` varchar(255) DEFAULT NULL,
  `is_template` tinyint(1) DEFAULT NULL,
  `is_specify_task_deadline` tinyint(1) NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `has_draft` tinyint(1) NOT NULL DEFAULT '1',
  `temaplte_parent_id` int(10) UNSIGNED DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `checklist_category_id` int(10) UNSIGNED DEFAULT NULL,
  `avatar_resize` json DEFAULT NULL,
  `avatar_directory` longtext
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `project_jobs`
--

CREATE TABLE `project_jobs` (
  `id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `description` text NOT NULL,
  `archived` tinyint(1) NOT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `queue_email`
--

CREATE TABLE `queue_email` (
  `id` int(11) NOT NULL,
  `from_name` varchar(50) NOT NULL,
  `from_email` varchar(50) NOT NULL,
  `to_name` varchar(50) NOT NULL,
  `to_email` varchar(50) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `body` text NOT NULL,
  `sent` int(11) NOT NULL,
  `error` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `reports_external_recipients`
--

CREATE TABLE `reports_external_recipients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `report_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `project_id` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `report_app_comments`
--

CREATE TABLE `report_app_comments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` longtext COLLATE utf8mb4_unicode_ci,
  `release_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `to_date` date DEFAULT NULL,
  `from_date` date DEFAULT NULL,
  `global_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_user_id` int(10) UNSIGNED DEFAULT NULL,
  `report_id` int(11) DEFAULT NULL,
  `report_category_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `report_app_jobs`
--

CREATE TABLE `report_app_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `project_id` bigint(20) UNSIGNED NOT NULL,
  `created_user_id` int(10) UNSIGNED DEFAULT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `start_date` datetime DEFAULT NULL,
  `completion_date` datetime DEFAULT NULL,
  `show_number` longtext COLLATE utf8mb4_unicode_ci,
  `show_date` datetime DEFAULT NULL,
  `status` enum('DRAFT','ACTIVE','DONE','SIGNED OFF') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'DRAFT',
  `state_id` int(10) UNSIGNED DEFAULT NULL,
  `sequence` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `report_app_milestones`
--

CREATE TABLE `report_app_milestones` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `report_app_job_id` bigint(20) UNSIGNED NOT NULL,
  `created_user_id` int(10) UNSIGNED DEFAULT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `start_date` datetime DEFAULT NULL,
  `completion_date` datetime DEFAULT NULL,
  `end_date` datetime DEFAULT NULL,
  `status` enum('NEW','DONE','WORKING') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'NEW',
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `state_id` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `report_attachments`
--

CREATE TABLE `report_attachments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `report_id` bigint(20) UNSIGNED DEFAULT NULL,
  `report_category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `src_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file_directory` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated` timestamp NOT NULL,
  `created` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `report_categories`
--

CREATE TABLE `report_categories` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `project_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `report_email_log`
--

CREATE TABLE `report_email_log` (
  `id` int(11) NOT NULL,
  `recipient_email` varchar(50) NOT NULL,
  `recipient_name` varchar(100) NOT NULL,
  `project_id` int(11) NOT NULL,
  `project_name` varchar(100) NOT NULL,
  `report_id` int(11) NOT NULL,
  `preview_code` varchar(255) NOT NULL,
  `recipient_id` int(11) NOT NULL,
  `report_of_month` varchar(15) NOT NULL,
  `report_of_day` varchar(2) NOT NULL,
  `date_planned` datetime NOT NULL,
  `date_sent` datetime NOT NULL,
  `date_viewed` datetime NOT NULL,
  `send_status` enum('PENDING','SENT','FAILED','VIEWED') NOT NULL,
  `created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `report_items`
--

CREATE TABLE `report_items` (
  `id` int(10) UNSIGNED NOT NULL,
  `report_id` int(11) NOT NULL,
  `content` text NOT NULL,
  `report_category_id` int(10) UNSIGNED NOT NULL,
  `project_id` int(11) NOT NULL,
  `owner_id` int(11) NOT NULL,
  `updated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `report_item_attachments`
--

CREATE TABLE `report_item_attachments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `report_id` bigint(20) UNSIGNED DEFAULT NULL,
  `report_category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `report_item_id` bigint(20) UNSIGNED DEFAULT NULL,
  `src_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file_directory` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated` timestamp NOT NULL,
  `created` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `report_logs`
--

CREATE TABLE `report_logs` (
  `id` int(10) UNSIGNED NOT NULL,
  `project_id` int(11) NOT NULL,
  `project_name` varchar(255) NOT NULL,
  `report_id` int(11) NOT NULL,
  `content` text NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `report_recipients`
--

CREATE TABLE `report_recipients` (
  `id` int(11) NOT NULL,
  `report_id` int(11) DEFAULT NULL,
  `project_id` int(11) NOT NULL,
  `receive_draft` tinyint(1) NOT NULL,
  `receive_final` tinyint(1) NOT NULL,
  `is_moderator` tinyint(1) NOT NULL,
  `user_id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `report_sent_users`
--

CREATE TABLE `report_sent_users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `report_id` bigint(20) UNSIGNED DEFAULT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `project_id` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `req_actions`
--

CREATE TABLE `req_actions` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `component_id` int(10) UNSIGNED NOT NULL,
  `endpoint_id` int(10) UNSIGNED DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `permission_key` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `req_action_roles`
--

CREATE TABLE `req_action_roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `action_id` bigint(20) UNSIGNED DEFAULT NULL,
  `role_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `req_attributes`
--

CREATE TABLE `req_attributes` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `endpoint_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` text COLLATE utf8mb4_unicode_ci,
  `length` int(11) DEFAULT NULL,
  `is_default` tinyint(1) NOT NULL DEFAULT '0',
  `default_value` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `req_components`
--

CREATE TABLE `req_components` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `project_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `req_context_variables`
--

CREATE TABLE `req_context_variables` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `endpoint_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `column_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `data_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_optional` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `req_endpoints`
--

CREATE TABLE `req_endpoints` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `project_id` int(11) NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `table_name` text COLLATE utf8mb4_unicode_ci,
  `is_visibility` tinyint(1) NOT NULL DEFAULT '0',
  `access_label` tinyint(1) NOT NULL DEFAULT '0',
  `view_only` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `req_endpoint_views`
--

CREATE TABLE `req_endpoint_views` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `endpoint_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `query` longtext COLLATE utf8mb4_unicode_ci,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `req_gates`
--

CREATE TABLE `req_gates` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `project_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `req_properties`
--

CREATE TABLE `req_properties` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `project_id` int(10) UNSIGNED NOT NULL,
  `deployment_server_id` int(10) UNSIGNED NOT NULL,
  `key` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `value` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `social_logins`
--

CREATE TABLE `social_logins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `provider_id` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `provider` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nickname` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `avatar` longtext COLLATE utf8mb4_unicode_ci,
  `token` longtext COLLATE utf8mb4_unicode_ci,
  `refreshToken` longtext COLLATE utf8mb4_unicode_ci,
  `expire` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_details` json DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sparkflowz_bids`
--

CREATE TABLE `sparkflowz_bids` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `message` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `rfq_id` int(10) UNSIGNED DEFAULT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `is_accept` tinyint(1) NOT NULL DEFAULT '0',
  `appointment_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sparkflowz_chats`
--

CREATE TABLE `sparkflowz_chats` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `sender_id` int(11) DEFAULT NULL,
  `receiver_id` int(11) DEFAULT NULL,
  `text` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_seen` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sparkflowz_checklists`
--

CREATE TABLE `sparkflowz_checklists` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `checklist_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `publish_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `is_recurring` tinyint(1) NOT NULL DEFAULT '0',
  `recur_interval` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parent_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `partipant_count` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_template` tinyint(1) DEFAULT NULL,
  `is_specify_task_deadline` tinyint(1) NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `has_draft` tinyint(1) NOT NULL DEFAULT '1',
  `temaplte_parent_id` int(10) UNSIGNED DEFAULT NULL,
  `state` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `owner_id` int(11) DEFAULT NULL,
  `checklist_category_id` int(10) UNSIGNED DEFAULT NULL,
  `service_id` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sparkflowz_checklist_categories`
--

CREATE TABLE `sparkflowz_checklist_categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sequence` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sparkflowz_checklist_tags`
--

CREATE TABLE `sparkflowz_checklist_tags` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `checklist_id` int(10) UNSIGNED DEFAULT NULL,
  `tag_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sparkflowz_consultances`
--

CREATE TABLE `sparkflowz_consultances` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `checklist_id` int(10) UNSIGNED DEFAULT NULL,
  `amount` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dates` json DEFAULT NULL,
  `confirm_date` datetime DEFAULT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `duration` int(11) DEFAULT NULL,
  `calendar_event_id` longtext COLLATE utf8mb4_unicode_ci,
  `zoom_meeting_id` bigint(20) UNSIGNED DEFAULT NULL,
  `zoom_meeting_join_url_for_attendees` text COLLATE utf8mb4_unicode_ci,
  `zoom_meeting_start_url_for_host` text COLLATE utf8mb4_unicode_ci,
  `time_zone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sparkflowz_goal_tags`
--

CREATE TABLE `sparkflowz_goal_tags` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `rfq_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sparkflowz_items`
--

CREATE TABLE `sparkflowz_items` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `item_category_id` int(10) UNSIGNED DEFAULT NULL,
  `item_type_id` int(10) UNSIGNED DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `estimate_cost` int(11) DEFAULT NULL,
  `actual_cost` int(11) DEFAULT NULL,
  `checklist_id` int(10) UNSIGNED DEFAULT NULL,
  `is_used` tinyint(1) DEFAULT NULL,
  `note` longtext COLLATE utf8mb4_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sparkflowz_item_categories`
--

CREATE TABLE `sparkflowz_item_categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `estimate_cost` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `actual_cost` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sequence` int(11) DEFAULT NULL,
  `checklist_id` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sparkflowz_item_types`
--

CREATE TABLE `sparkflowz_item_types` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sequence` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sparkflowz_payments`
--

CREATE TABLE `sparkflowz_payments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `consultance_id` bigint(20) UNSIGNED DEFAULT NULL,
  `amount` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `session_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `webhook_payload` longtext COLLATE utf8mb4_unicode_ci,
  `webhook_payload_customer` text COLLATE utf8mb4_unicode_ci,
  `webhook_payload_payment_intent` text COLLATE utf8mb4_unicode_ci,
  `stripe_customer_email` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `stripe_payment_status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `webhook_charge_id` longtext COLLATE utf8mb4_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sparkflowz_rfqs`
--

CREATE TABLE `sparkflowz_rfqs` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `start_date` datetime DEFAULT NULL,
  `end_date` datetime DEFAULT NULL,
  `checklist_id` int(10) UNSIGNED DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `cost` int(11) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `service_id` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sparkflowz_rfq_media`
--

CREATE TABLE `sparkflowz_rfq_media` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `rfq_id` int(10) UNSIGNED DEFAULT NULL,
  `media_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sparkflowz_rfq_users`
--

CREATE TABLE `sparkflowz_rfq_users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `rfq_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sparkflowz_schedule_notifications`
--

CREATE TABLE `sparkflowz_schedule_notifications` (
  `id` int(10) UNSIGNED NOT NULL,
  `checklist_id` int(11) DEFAULT NULL,
  `notify_date` date DEFAULT NULL,
  `message` longtext COLLATE utf8mb4_unicode_ci,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sparkflowz_serviceables`
--

CREATE TABLE `sparkflowz_serviceables` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sparkflowz_serviceable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sparkflowz_serviceable_id` bigint(20) UNSIGNED NOT NULL,
  `service_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sparkflowz_services`
--

CREATE TABLE `sparkflowz_services` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sequence` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sparkflowz_service_users`
--

CREATE TABLE `sparkflowz_service_users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `service_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sparkflowz_settings`
--

CREATE TABLE `sparkflowz_settings` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `key` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `value` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sparkflowz_stageables`
--

CREATE TABLE `sparkflowz_stageables` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `stage_id` int(11) NOT NULL,
  `sparkflowz_stageables_id` int(11) NOT NULL,
  `sparkflowz_stageables_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sparkflowz_stages`
--

CREATE TABLE `sparkflowz_stages` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sequence` int(11) DEFAULT NULL,
  `checklist_id` int(10) UNSIGNED DEFAULT NULL,
  `is_completed` tinyint(1) NOT NULL DEFAULT '0',
  `completed_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sparkflowz_statusables`
--

CREATE TABLE `sparkflowz_statusables` (
  `status_id` int(11) NOT NULL,
  `statusable_id` int(11) NOT NULL,
  `statusable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sparkflowz_statuses`
--

CREATE TABLE `sparkflowz_statuses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sparkflowz_tags`
--

CREATE TABLE `sparkflowz_tags` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_admin_added` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sparkflowz_userables`
--

CREATE TABLE `sparkflowz_userables` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sparkflowz_user_notifications`
--

CREATE TABLE `sparkflowz_user_notifications` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `checklist_id` bigint(20) UNSIGNED DEFAULT NULL,
  `message` longtext COLLATE utf8mb4_unicode_ci,
  `is_seen` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `supercards_card_tags`
--

CREATE TABLE `supercards_card_tags` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `card_id` int(10) UNSIGNED DEFAULT NULL,
  `tag_id` int(10) UNSIGNED DEFAULT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `supercards_categories`
--

CREATE TABLE `supercards_categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `category_type` enum('GENERIC','UNIQUE','LIMITED','PROJECT_TAG') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'GENERIC',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_multiple` tinyint(1) NOT NULL DEFAULT '1',
  `company_id` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `supercards_project_categories`
--

CREATE TABLE `supercards_project_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `project_id` int(11) DEFAULT NULL,
  `supercards_category_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `supercards_project_tags`
--

CREATE TABLE `supercards_project_tags` (
  `project_id` int(10) UNSIGNED DEFAULT NULL,
  `tag_id` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `supercards_tags`
--

CREATE TABLE `supercards_tags` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `category_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `teams`
--

CREATE TABLE `teams` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `personal_team` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `team_user`
--

CREATE TABLE `team_user` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `team_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `telescope_entries`
--

CREATE TABLE `telescope_entries` (
  `sequence` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `family_hash` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `should_display_on_index` tinyint(1) NOT NULL DEFAULT '1',
  `type` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `telescope_entries_tags`
--

CREATE TABLE `telescope_entries_tags` (
  `entry_uuid` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tag` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `telescope_monitoring`
--

CREATE TABLE `telescope_monitoring` (
  `tag` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `todos`
--

CREATE TABLE `todos` (
  `id` int(10) UNSIGNED NOT NULL,
  `assigned_to` bigint(20) UNSIGNED DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` text,
  `due_date` date NOT NULL,
  `priority` enum('LOW','NORMAL','HIGH','CRITICAL') NOT NULL DEFAULT 'NORMAL',
  `task_status` enum('NEW','IN-PROGRESS','DONE') NOT NULL DEFAULT 'NEW',
  `project_id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `meeting_id` int(10) UNSIGNED NOT NULL,
  `agenda_id` bigint(20) UNSIGNED NOT NULL,
  `owner_id` int(11) NOT NULL,
  `updated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `todo_assign_users`
--

CREATE TABLE `todo_assign_users` (
  `id` int(10) UNSIGNED NOT NULL,
  `todo_id` int(10) UNSIGNED NOT NULL,
  `assigned_to` int(11) NOT NULL,
  `assigned_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(50) NOT NULL DEFAULT '',
  `email` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_mobile` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `two_factor_secret` text,
  `two_factor_recovery_codes` text,
  `usertype` int(11) NOT NULL,
  `user_roles` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `designation` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `check_in` int(11) DEFAULT NULL,
  `primary_company_id` int(11) DEFAULT NULL,
  `address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `area` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `city_id` int(11) NOT NULL,
  `district_province` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `country_code` varchar(191) DEFAULT NULL,
  `religion` varchar(191) DEFAULT NULL,
  `skype_id` varchar(191) DEFAULT NULL,
  `is_admin` int(11) NOT NULL DEFAULT '0',
  `global_id` int(11) DEFAULT NULL,
  `avatar` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `default_cost` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `avatar_directory` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `otp_code` int(11) DEFAULT NULL,
  `rates` varchar(191) DEFAULT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `recovery_code` int(11) DEFAULT NULL,
  `verification_code` longtext,
  `is_verified` tinyint(1) NOT NULL DEFAULT '0',
  `name` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `company` varchar(255) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `current_team_id` varchar(255) DEFAULT NULL,
  `role` varchar(255) DEFAULT NULL,
  `google_calendar_token` longtext,
  `is_google_calendar_connection` tinyint(1) NOT NULL DEFAULT '0',
  `google_calendar_refresh_token` longtext,
  `google_calendar_token_expires_in` int(10) UNSIGNED DEFAULT NULL,
  `google_selected_calendar` varchar(255) DEFAULT NULL,
  `note` text,
  `joining_date` date DEFAULT NULL,
  `firebase_token` longtext,
  `avatar_resize` json DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users_unverified`
--

CREATE TABLE `users_unverified` (
  `id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL DEFAULT '',
  `email` varchar(50) NOT NULL,
  `verification_code` varchar(255) NOT NULL,
  `client_app_id` varchar(100) NOT NULL,
  `phone_mobile` varchar(15) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `usertype` int(11) NOT NULL,
  `user_roles` text NOT NULL,
  `designation` varchar(50) NOT NULL DEFAULT '',
  `check_in` int(11) DEFAULT NULL,
  `company_id` int(11) DEFAULT NULL,
  `address` varchar(255) NOT NULL,
  `area` varchar(50) NOT NULL,
  `city_id` int(11) NOT NULL,
  `district_province` varchar(50) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `is_admin` int(11) NOT NULL DEFAULT '0',
  `global_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user_companies`
--

CREATE TABLE `user_companies` (
  `id` int(10) UNSIGNED NOT NULL,
  `company_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `is_admin` int(11) NOT NULL DEFAULT '0',
  `is_verified` int(11) NOT NULL DEFAULT '0',
  `is_disable` tinyint(1) NOT NULL DEFAULT '0',
  `app_id` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_projects`
--

CREATE TABLE `user_projects` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `user_project_role_id` bigint(20) UNSIGNED DEFAULT NULL,
  `project_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `cost` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rates` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_roles`
--

CREATE TABLE `user_roles` (
  `id` int(11) NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `role_id` varchar(255) NOT NULL,
  `Description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user_sessions`
--

CREATE TABLE `user_sessions` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `device_id` varchar(255) NOT NULL,
  `user_info` text NOT NULL,
  `roles` text NOT NULL,
  `access_token` varchar(255) NOT NULL,
  `session_start` bigint(20) NOT NULL,
  `session_last_access` bigint(20) NOT NULL,
  `expired` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  `expired_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user_types`
--

CREATE TABLE `user_types` (
  `id` int(11) NOT NULL,
  `user_type_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `websockets_statistics_entries`
--

CREATE TABLE `websockets_statistics_entries` (
  `id` int(10) UNSIGNED NOT NULL,
  `app_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `peak_connection_count` int(11) NOT NULL,
  `websocket_message_count` int(11) NOT NULL,
  `api_message_count` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activity_log`
--
ALTER TABLE `activity_log`
  ADD PRIMARY KEY (`id`),
  ADD KEY `subject` (`subject_type`,`subject_id`),
  ADD KEY `causer` (`causer_type`,`causer_id`),
  ADD KEY `activity_log_log_name_index` (`log_name`);

--
-- Indexes for table `attachments`
--
ALTER TABLE `attachments`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `attachments_uuid_unique` (`uuid`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category_item`
--
ALTER TABLE `category_item`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `comments_project_id_foreign` (`project_id`);

--
-- Indexes for table `companies`
--
ALTER TABLE `companies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `company_users`
--
ALTER TABLE `company_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `day_leave_config`
--
ALTER TABLE `day_leave_config`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `day_leave_holiday`
--
ALTER TABLE `day_leave_holiday`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `day_leave_records`
--
ALTER TABLE `day_leave_records`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK6a59yy8na9kxfmtmib5nym9de` (`users_id`);

--
-- Indexes for table `day_leave_userholiday_holiday`
--
ALTER TABLE `day_leave_userholiday_holiday`
  ADD KEY `FKomj7whymsaaaq9w70qr5jg5jb` (`holiday_id`),
  ADD KEY `FKh8tj2ls0xl6m0cvqb3yt168vp` (`userholiday_id`);

--
-- Indexes for table `day_leave_user_additional_holiday`
--
ALTER TABLE `day_leave_user_additional_holiday`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK9uki4wcw0refaq9vv4jqq1b4g` (`user_id`);

--
-- Indexes for table `day_leave_user_holiday`
--
ALTER TABLE `day_leave_user_holiday`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FKe2ccxhyq6gcfwl2lhml58vyjc` (`user_id`);

--
-- Indexes for table `day_leave_user_role`
--
ALTER TABLE `day_leave_user_role`
  ADD KEY `FKqhdem0cwlgr980actaxde37fh` (`role_id`),
  ADD KEY `FK6ak9ie3youwf8wuv3ythhg3tp` (`user_id`);

--
-- Indexes for table `email_verification`
--
ALTER TABLE `email_verification`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `entities`
--
ALTER TABLE `entities`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `entities_slug_unique` (`slug`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `fields`
--
ALTER TABLE `fields`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fields_entity_id_foreign` (`entity_id`);

--
-- Indexes for table `live_cms_pages`
--
ALTER TABLE `live_cms_pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `media`
--
ALTER TABLE `media`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `media_uuid_unique` (`uuid`),
  ADD KEY `media_model_type_model_id_index` (`model_type`,`model_id`);

--
-- Indexes for table `meetings`
--
ALTER TABLE `meetings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `meeting_agendas`
--
ALTER TABLE `meeting_agendas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `meeting_attendees`
--
ALTER TABLE `meeting_attendees`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `meeting_invites`
--
ALTER TABLE `meeting_invites`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notification_events`
--
ALTER TABLE `notification_events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notification_event_details`
--
ALTER TABLE `notification_event_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notification_event_types`
--
ALTER TABLE `notification_event_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ob_bounties`
--
ALTER TABLE `ob_bounties`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ob_bounty_accounts`
--
ALTER TABLE `ob_bounty_accounts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ob_bounty_balance`
--
ALTER TABLE `ob_bounty_balance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ob_categories`
--
ALTER TABLE `ob_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `office_assistant_additional_holiday`
--
ALTER TABLE `office_assistant_additional_holiday`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FKg33lxvk5yhs1bp9x1yxg6twhr` (`user_id`);

--
-- Indexes for table `office_assistant_attachments`
--
ALTER TABLE `office_assistant_attachments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `office_assistant_bill`
--
ALTER TABLE `office_assistant_bill`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FKg6ye8wue75fumxvr04kakd9bb` (`status_id`),
  ADD KEY `FKe5e06xttcwdlt58qp8q78746d` (`user_id`);

--
-- Indexes for table `office_assistant_config`
--
ALTER TABLE `office_assistant_config`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `office_assistant_document_category`
--
ALTER TABLE `office_assistant_document_category`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FKbhombomc4f51g74ytd5225ap2` (`company_id`);

--
-- Indexes for table `office_assistant_document_files`
--
ALTER TABLE `office_assistant_document_files`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK3t0e8yfvmfx4txuw5kqldfc05` (`category_id`);

--
-- Indexes for table `office_assistant_holiday`
--
ALTER TABLE `office_assistant_holiday`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `office_assistant_records`
--
ALTER TABLE `office_assistant_records`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FKkxcn32wbd0mmye2evhg0h75rd` (`users_id`);

--
-- Indexes for table `office_assistant_status`
--
ALTER TABLE `office_assistant_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `office_assistant_user_holiday`
--
ALTER TABLE `office_assistant_user_holiday`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK5uqqlr27vdmj1prlolwoypkw4` (`user_id`);

--
-- Indexes for table `og_teams`
--
ALTER TABLE `og_teams`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `og_team_members`
--
ALTER TABLE `og_team_members`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `pmapp_activity`
--
ALTER TABLE `pmapp_activity`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pmapp_attachments`
--
ALTER TABLE `pmapp_attachments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `attachments_card_id_foreign` (`card_id`);

--
-- Indexes for table `pmapp_board_card_types`
--
ALTER TABLE `pmapp_board_card_types`
  ADD PRIMARY KEY (`id`),
  ADD KEY `board_card_types_board_view_id_foreign` (`board_view_id`),
  ADD KEY `board_card_types_card_type_id_foreign` (`card_type_id`);

--
-- Indexes for table `pmapp_board_views`
--
ALTER TABLE `pmapp_board_views`
  ADD PRIMARY KEY (`id`),
  ADD KEY `board_views_project_id_foreign` (`project_id`),
  ADD KEY `board_views_column_id_foreign` (`column_id`),
  ADD KEY `board_views_row_id_foreign` (`row_id`);

--
-- Indexes for table `pmapp_board_view_users`
--
ALTER TABLE `pmapp_board_view_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pmapp_business_value`
--
ALTER TABLE `pmapp_business_value`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pmapp_cards`
--
ALTER TABLE `pmapp_cards`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cards_project_id_foreign` (`project_id`),
  ADD KEY `cards_card_type_id_foreign` (`card_type_id`),
  ADD KEY `cards_state_id_foreign` (`state_id`),
  ADD KEY `cards_created_user_id_foreign` (`created_user_id`),
  ADD KEY `cards_release_id_foreign` (`release_id`),
  ADD KEY `cards_sprint_id_foreign` (`sprint_id`),
  ADD KEY `cards_parent_card_type_foreign` (`parent_card_type`),
  ADD KEY `cards_child_card_type_foreign` (`child_card_type`);

--
-- Indexes for table `pmapp_card_assigns`
--
ALTER TABLE `pmapp_card_assigns`
  ADD PRIMARY KEY (`id`),
  ADD KEY `card_assigns_user_id_foreign` (`user_id`),
  ADD KEY `card_assigns_card_id_foreign` (`card_id`);

--
-- Indexes for table `pmapp_card_history`
--
ALTER TABLE `pmapp_card_history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pmapp_card_states`
--
ALTER TABLE `pmapp_card_states`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pmapp_card_types`
--
ALTER TABLE `pmapp_card_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pmapp_card_users`
--
ALTER TABLE `pmapp_card_users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `card_users_card_id_foreign` (`card_id`),
  ADD KEY `card_users_user_id_foreign` (`user_id`);

--
-- Indexes for table `pmapp_card_user_roles`
--
ALTER TABLE `pmapp_card_user_roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pmapp_card_visualization`
--
ALTER TABLE `pmapp_card_visualization`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pmapp_comments`
--
ALTER TABLE `pmapp_comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `comments_user_id_foreign` (`user_id`),
  ADD KEY `comments_card_id_foreign` (`card_id`);

--
-- Indexes for table `pmapp_comment_mentions`
--
ALTER TABLE `pmapp_comment_mentions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pmapp_comment_types`
--
ALTER TABLE `pmapp_comment_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pmapp_default_board_views`
--
ALTER TABLE `pmapp_default_board_views`
  ADD PRIMARY KEY (`id`),
  ADD KEY `default_board_views_column_id_foreign` (`column_id`),
  ADD KEY `default_board_views_row_id_foreign` (`row_id`);

--
-- Indexes for table `pmapp_deployment_server`
--
ALTER TABLE `pmapp_deployment_server`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pmapp_favourite_meetings`
--
ALTER TABLE `pmapp_favourite_meetings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pmapp_feature_stories`
--
ALTER TABLE `pmapp_feature_stories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pmapp_feature_story_roles`
--
ALTER TABLE `pmapp_feature_story_roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `pmapp_feature_story_roles_feature_story_id_role_id_unique` (`feature_story_id`,`role_id`);

--
-- Indexes for table `pmapp_global_entities`
--
ALTER TABLE `pmapp_global_entities`
  ADD PRIMARY KEY (`id`),
  ADD KEY `global_entities_company_id_foreign` (`company_id`);

--
-- Indexes for table `pmapp_notifications`
--
ALTER TABLE `pmapp_notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pmapp_project_description`
--
ALTER TABLE `pmapp_project_description`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pmapp_project_description_project_id_foreign` (`project_id`);

--
-- Indexes for table `pmapp_project_features`
--
ALTER TABLE `pmapp_project_features`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pmapp_project_feature_roles`
--
ALTER TABLE `pmapp_project_feature_roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `pmapp_project_feature_roles_project_feature_id_role_id_unique` (`project_feature_id`,`role_id`);

--
-- Indexes for table `pmapp_project_narratives`
--
ALTER TABLE `pmapp_project_narratives`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pmapp_project_states`
--
ALTER TABLE `pmapp_project_states`
  ADD PRIMARY KEY (`id`),
  ADD KEY `project_states_project_id_foreign` (`project_id`),
  ADD KEY `project_states_card_state_id_foreign` (`card_state_id`);

--
-- Indexes for table `pmapp_project_visions`
--
ALTER TABLE `pmapp_project_visions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pmapp_project_visions_project_id_foreign` (`project_id`);

--
-- Indexes for table `pmapp_related_cards`
--
ALTER TABLE `pmapp_related_cards`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pmapp_releases`
--
ALTER TABLE `pmapp_releases`
  ADD PRIMARY KEY (`id`),
  ADD KEY `releases_project_id_foreign` (`project_id`);

--
-- Indexes for table `pmapp_release_cards`
--
ALTER TABLE `pmapp_release_cards`
  ADD PRIMARY KEY (`id`),
  ADD KEY `release_cards_release_id_foreign` (`release_id`),
  ADD KEY `release_cards_card_id_foreign` (`card_id`);

--
-- Indexes for table `pmapp_release_deployment_server`
--
ALTER TABLE `pmapp_release_deployment_server`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pmapp_release_projects`
--
ALTER TABLE `pmapp_release_projects`
  ADD PRIMARY KEY (`id`),
  ADD KEY `release_projects_release_id_foreign` (`release_id`),
  ADD KEY `release_projects_project_id_foreign` (`project_id`);

--
-- Indexes for table `pmapp_roles`
--
ALTER TABLE `pmapp_roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pmapp_row_columns`
--
ALTER TABLE `pmapp_row_columns`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pmapp_severity_sequence`
--
ALTER TABLE `pmapp_severity_sequence`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pmapp_sprints`
--
ALTER TABLE `pmapp_sprints`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sprints_release_id_foreign` (`release_id`),
  ADD KEY `sprints_project_id_foreign` (`project_id`);

--
-- Indexes for table `pmapp_sprint_cards`
--
ALTER TABLE `pmapp_sprint_cards`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sprint_cards_sprint_id_foreign` (`sprint_id`),
  ADD KEY `sprint_cards_card_id_foreign` (`card_id`);

--
-- Indexes for table `pmapp_sprint_projects`
--
ALTER TABLE `pmapp_sprint_projects`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sprint_projects_sprint_id_foreign` (`sprint_id`),
  ADD KEY `sprint_projects_project_id_foreign` (`project_id`);

--
-- Indexes for table `pmapp_state_change_histories`
--
ALTER TABLE `pmapp_state_change_histories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `state_change_histories_card_id_foreign` (`card_id`),
  ADD KEY `state_change_histories_user_id_foreign` (`user_id`),
  ADD KEY `state_change_histories_state_id_foreign` (`state_id`);

--
-- Indexes for table `pmapp_status`
--
ALTER TABLE `pmapp_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pmapp_time_estimates`
--
ALTER TABLE `pmapp_time_estimates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pmapp_time_spends`
--
ALTER TABLE `pmapp_time_spends`
  ADD PRIMARY KEY (`id`),
  ADD KEY `time_spends_user_id_foreign` (`user_id`),
  ADD KEY `time_spends_card_id_foreign` (`card_id`);

--
-- Indexes for table `pmapp_type_states`
--
ALTER TABLE `pmapp_type_states`
  ADD PRIMARY KEY (`id`),
  ADD KEY `type_states_card_type_id_foreign` (`card_type_id`),
  ADD KEY `type_states_card_state_id_foreign` (`card_state_id`);

--
-- Indexes for table `pmapp_user_avatars`
--
ALTER TABLE `pmapp_user_avatars`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pmapp_user_project_roles`
--
ALTER TABLE `pmapp_user_project_roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `post_authors`
--
ALTER TABLE `post_authors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `progress_reports`
--
ALTER TABLE `progress_reports`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `projects_color_code_company_id_unique` (`color_code`,`company_id`);

--
-- Indexes for table `project_jobs`
--
ALTER TABLE `project_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `queue_email`
--
ALTER TABLE `queue_email`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reports_external_recipients`
--
ALTER TABLE `reports_external_recipients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `report_app_comments`
--
ALTER TABLE `report_app_comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `report_app_jobs`
--
ALTER TABLE `report_app_jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `report_app_jobs_state_id_foreign` (`state_id`);

--
-- Indexes for table `report_app_milestones`
--
ALTER TABLE `report_app_milestones`
  ADD PRIMARY KEY (`id`),
  ADD KEY `report_app_milestones_report_app_job_id_foreign` (`report_app_job_id`),
  ADD KEY `report_app_milestones_state_id_foreign` (`state_id`);

--
-- Indexes for table `report_attachments`
--
ALTER TABLE `report_attachments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `report_categories`
--
ALTER TABLE `report_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `report_email_log`
--
ALTER TABLE `report_email_log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `report_items`
--
ALTER TABLE `report_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `report_item_attachments`
--
ALTER TABLE `report_item_attachments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `report_logs`
--
ALTER TABLE `report_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `report_recipients`
--
ALTER TABLE `report_recipients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `report_sent_users`
--
ALTER TABLE `report_sent_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `req_actions`
--
ALTER TABLE `req_actions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `req_actions_component_id_foreign` (`component_id`),
  ADD KEY `req_actions_endpoint_id_foreign` (`endpoint_id`);

--
-- Indexes for table `req_action_roles`
--
ALTER TABLE `req_action_roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `req_action_roles_action_id_role_id_unique` (`action_id`,`role_id`);

--
-- Indexes for table `req_attributes`
--
ALTER TABLE `req_attributes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `req_attributes_endpoint_id_foreign` (`endpoint_id`);

--
-- Indexes for table `req_components`
--
ALTER TABLE `req_components`
  ADD PRIMARY KEY (`id`),
  ADD KEY `req_components_project_id_foreign` (`project_id`);

--
-- Indexes for table `req_context_variables`
--
ALTER TABLE `req_context_variables`
  ADD PRIMARY KEY (`id`),
  ADD KEY `req_context_variables_endpoint_id_foreign` (`endpoint_id`);

--
-- Indexes for table `req_endpoints`
--
ALTER TABLE `req_endpoints`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `req_endpoint_views`
--
ALTER TABLE `req_endpoint_views`
  ADD PRIMARY KEY (`id`),
  ADD KEY `req_endpoint_views_endpoint_id_foreign` (`endpoint_id`);

--
-- Indexes for table `req_gates`
--
ALTER TABLE `req_gates`
  ADD PRIMARY KEY (`id`),
  ADD KEY `req_gates_project_id_foreign` (`project_id`);

--
-- Indexes for table `req_properties`
--
ALTER TABLE `req_properties`
  ADD PRIMARY KEY (`id`),
  ADD KEY `req_properties_project_id_foreign` (`project_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD UNIQUE KEY `sessions_id_unique` (`id`);

--
-- Indexes for table `social_logins`
--
ALTER TABLE `social_logins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sparkflowz_bids`
--
ALTER TABLE `sparkflowz_bids`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sparkflowz_chats`
--
ALTER TABLE `sparkflowz_chats`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sparkflowz_checklists`
--
ALTER TABLE `sparkflowz_checklists`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sparkflowz_checklists_checklist_category_id_foreign` (`checklist_category_id`);

--
-- Indexes for table `sparkflowz_checklist_categories`
--
ALTER TABLE `sparkflowz_checklist_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sparkflowz_checklist_tags`
--
ALTER TABLE `sparkflowz_checklist_tags`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sparkflowz_checklist_tags_checklist_id_foreign` (`checklist_id`),
  ADD KEY `sparkflowz_checklist_tags_tag_id_foreign` (`tag_id`);

--
-- Indexes for table `sparkflowz_consultances`
--
ALTER TABLE `sparkflowz_consultances`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sparkflowz_consultances_user_id_foreign` (`user_id`),
  ADD KEY `sparkflowz_consultances_checklist_id_foreign` (`checklist_id`);

--
-- Indexes for table `sparkflowz_goal_tags`
--
ALTER TABLE `sparkflowz_goal_tags`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sparkflowz_items`
--
ALTER TABLE `sparkflowz_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sparkflowz_items_item_category_id_foreign` (`item_category_id`),
  ADD KEY `sparkflowz_items_item_type_id_foreign` (`item_type_id`),
  ADD KEY `sparkflowz_items_checklist_id_foreign` (`checklist_id`);

--
-- Indexes for table `sparkflowz_item_categories`
--
ALTER TABLE `sparkflowz_item_categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sparkflowz_item_categories_checklist_id_foreign` (`checklist_id`);

--
-- Indexes for table `sparkflowz_item_types`
--
ALTER TABLE `sparkflowz_item_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sparkflowz_payments`
--
ALTER TABLE `sparkflowz_payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sparkflowz_payments_consultance_id_foreign` (`consultance_id`);

--
-- Indexes for table `sparkflowz_rfqs`
--
ALTER TABLE `sparkflowz_rfqs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sparkflowz_rfqs_checklist_id_foreign` (`checklist_id`),
  ADD KEY `sparkflowz_rfqs_user_id_foreign` (`user_id`);

--
-- Indexes for table `sparkflowz_rfq_media`
--
ALTER TABLE `sparkflowz_rfq_media`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sparkflowz_rfq_media_media_id_foreign` (`media_id`),
  ADD KEY `sparkflowz_rfq_media_rfq_id_foreign` (`rfq_id`);

--
-- Indexes for table `sparkflowz_rfq_users`
--
ALTER TABLE `sparkflowz_rfq_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sparkflowz_schedule_notifications`
--
ALTER TABLE `sparkflowz_schedule_notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sparkflowz_serviceables`
--
ALTER TABLE `sparkflowz_serviceables`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sparkflowz_serviceables_serviceable_type_serviceable_id_index` (`sparkflowz_serviceable_type`,`sparkflowz_serviceable_id`),
  ADD KEY `sparkflowz_serviceables_service_id_foreign` (`service_id`);

--
-- Indexes for table `sparkflowz_services`
--
ALTER TABLE `sparkflowz_services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sparkflowz_service_users`
--
ALTER TABLE `sparkflowz_service_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sparkflowz_settings`
--
ALTER TABLE `sparkflowz_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sparkflowz_stageables`
--
ALTER TABLE `sparkflowz_stageables`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `sparkflowz_stageables_stage_id_sparkflowz_stageables_id_unique` (`stage_id`,`sparkflowz_stageables_id`);

--
-- Indexes for table `sparkflowz_stages`
--
ALTER TABLE `sparkflowz_stages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sparkflowz_stages_checklist_id_foreign` (`checklist_id`);

--
-- Indexes for table `sparkflowz_statuses`
--
ALTER TABLE `sparkflowz_statuses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sparkflowz_tags`
--
ALTER TABLE `sparkflowz_tags`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sparkflowz_userables`
--
ALTER TABLE `sparkflowz_userables`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sparkflowz_userables_model_type_model_id_index` (`model_type`,`model_id`),
  ADD KEY `sparkflowz_userables_user_id_foreign` (`user_id`);

--
-- Indexes for table `sparkflowz_user_notifications`
--
ALTER TABLE `sparkflowz_user_notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `supercards_card_tags`
--
ALTER TABLE `supercards_card_tags`
  ADD PRIMARY KEY (`id`),
  ADD KEY `supercards_card_tags_card_id_foreign` (`card_id`),
  ADD KEY `supercards_card_tags_tag_id_foreign` (`tag_id`);

--
-- Indexes for table `supercards_categories`
--
ALTER TABLE `supercards_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `supercards_project_categories`
--
ALTER TABLE `supercards_project_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `supercards_project_tags`
--
ALTER TABLE `supercards_project_tags`
  ADD KEY `supercards_project_tags_project_id_foreign` (`project_id`),
  ADD KEY `supercards_project_tags_tag_id_foreign` (`tag_id`);

--
-- Indexes for table `supercards_tags`
--
ALTER TABLE `supercards_tags`
  ADD PRIMARY KEY (`id`),
  ADD KEY `supercards_tags_category_id_foreign` (`category_id`);

--
-- Indexes for table `teams`
--
ALTER TABLE `teams`
  ADD PRIMARY KEY (`id`),
  ADD KEY `teams_user_id_index` (`user_id`);

--
-- Indexes for table `team_user`
--
ALTER TABLE `team_user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `team_user_team_id_user_id_unique` (`team_id`,`user_id`);

--
-- Indexes for table `telescope_entries`
--
ALTER TABLE `telescope_entries`
  ADD PRIMARY KEY (`sequence`),
  ADD UNIQUE KEY `telescope_entries_uuid_unique` (`uuid`),
  ADD KEY `telescope_entries_batch_id_index` (`batch_id`),
  ADD KEY `telescope_entries_family_hash_index` (`family_hash`),
  ADD KEY `telescope_entries_created_at_index` (`created_at`),
  ADD KEY `telescope_entries_type_should_display_on_index_index` (`type`,`should_display_on_index`);

--
-- Indexes for table `telescope_entries_tags`
--
ALTER TABLE `telescope_entries_tags`
  ADD KEY `telescope_entries_tags_entry_uuid_tag_index` (`entry_uuid`,`tag`),
  ADD KEY `telescope_entries_tags_tag_index` (`tag`);

--
-- Indexes for table `todos`
--
ALTER TABLE `todos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `todo_assign_users`
--
ALTER TABLE `todo_assign_users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `todo_assign_users_todo_id_foreign` (`todo_id`),
  ADD KEY `todo_assign_users_assigned_to_foreign` (`assigned_to`),
  ADD KEY `todo_assign_users_assigned_by_foreign` (`assigned_by`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `users_unverified`
--
ALTER TABLE `users_unverified`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_companies`
--
ALTER TABLE `user_companies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_projects`
--
ALTER TABLE `user_projects`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_projects_user_id_foreign` (`user_id`),
  ADD KEY `user_projects_project_id_foreign` (`project_id`);

--
-- Indexes for table `user_roles`
--
ALTER TABLE `user_roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_sessions`
--
ALTER TABLE `user_sessions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_types`
--
ALTER TABLE `user_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `websockets_statistics_entries`
--
ALTER TABLE `websockets_statistics_entries`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activity_log`
--
ALTER TABLE `activity_log`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `attachments`
--
ALTER TABLE `attachments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `category_item`
--
ALTER TABLE `category_item`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cities`
--
ALTER TABLE `cities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `companies`
--
ALTER TABLE `companies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `company_users`
--
ALTER TABLE `company_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `day_leave_config`
--
ALTER TABLE `day_leave_config`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `day_leave_holiday`
--
ALTER TABLE `day_leave_holiday`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `day_leave_records`
--
ALTER TABLE `day_leave_records`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `day_leave_user_additional_holiday`
--
ALTER TABLE `day_leave_user_additional_holiday`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `day_leave_user_holiday`
--
ALTER TABLE `day_leave_user_holiday`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `email_verification`
--
ALTER TABLE `email_verification`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `entities`
--
ALTER TABLE `entities`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `fields`
--
ALTER TABLE `fields`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `live_cms_pages`
--
ALTER TABLE `live_cms_pages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `media`
--
ALTER TABLE `media`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `meetings`
--
ALTER TABLE `meetings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `meeting_agendas`
--
ALTER TABLE `meeting_agendas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `meeting_attendees`
--
ALTER TABLE `meeting_attendees`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `meeting_invites`
--
ALTER TABLE `meeting_invites`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=280;

--
-- AUTO_INCREMENT for table `notification_events`
--
ALTER TABLE `notification_events`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `notification_event_details`
--
ALTER TABLE `notification_event_details`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `notification_event_types`
--
ALTER TABLE `notification_event_types`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ob_bounties`
--
ALTER TABLE `ob_bounties`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ob_bounty_accounts`
--
ALTER TABLE `ob_bounty_accounts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ob_bounty_balance`
--
ALTER TABLE `ob_bounty_balance`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ob_categories`
--
ALTER TABLE `ob_categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `office_assistant_additional_holiday`
--
ALTER TABLE `office_assistant_additional_holiday`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `office_assistant_bill`
--
ALTER TABLE `office_assistant_bill`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `office_assistant_config`
--
ALTER TABLE `office_assistant_config`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `office_assistant_document_category`
--
ALTER TABLE `office_assistant_document_category`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `office_assistant_document_files`
--
ALTER TABLE `office_assistant_document_files`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `office_assistant_holiday`
--
ALTER TABLE `office_assistant_holiday`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `office_assistant_records`
--
ALTER TABLE `office_assistant_records`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `office_assistant_status`
--
ALTER TABLE `office_assistant_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `office_assistant_user_holiday`
--
ALTER TABLE `office_assistant_user_holiday`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `og_teams`
--
ALTER TABLE `og_teams`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `og_team_members`
--
ALTER TABLE `og_team_members`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pmapp_activity`
--
ALTER TABLE `pmapp_activity`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pmapp_attachments`
--
ALTER TABLE `pmapp_attachments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pmapp_board_card_types`
--
ALTER TABLE `pmapp_board_card_types`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pmapp_board_views`
--
ALTER TABLE `pmapp_board_views`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pmapp_board_view_users`
--
ALTER TABLE `pmapp_board_view_users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pmapp_business_value`
--
ALTER TABLE `pmapp_business_value`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pmapp_cards`
--
ALTER TABLE `pmapp_cards`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pmapp_card_assigns`
--
ALTER TABLE `pmapp_card_assigns`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pmapp_card_history`
--
ALTER TABLE `pmapp_card_history`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pmapp_card_states`
--
ALTER TABLE `pmapp_card_states`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pmapp_card_types`
--
ALTER TABLE `pmapp_card_types`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pmapp_card_users`
--
ALTER TABLE `pmapp_card_users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pmapp_card_user_roles`
--
ALTER TABLE `pmapp_card_user_roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pmapp_card_visualization`
--
ALTER TABLE `pmapp_card_visualization`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pmapp_comments`
--
ALTER TABLE `pmapp_comments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pmapp_comment_mentions`
--
ALTER TABLE `pmapp_comment_mentions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pmapp_comment_types`
--
ALTER TABLE `pmapp_comment_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pmapp_default_board_views`
--
ALTER TABLE `pmapp_default_board_views`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pmapp_deployment_server`
--
ALTER TABLE `pmapp_deployment_server`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pmapp_favourite_meetings`
--
ALTER TABLE `pmapp_favourite_meetings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pmapp_feature_stories`
--
ALTER TABLE `pmapp_feature_stories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pmapp_feature_story_roles`
--
ALTER TABLE `pmapp_feature_story_roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pmapp_global_entities`
--
ALTER TABLE `pmapp_global_entities`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pmapp_notifications`
--
ALTER TABLE `pmapp_notifications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pmapp_project_description`
--
ALTER TABLE `pmapp_project_description`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pmapp_project_features`
--
ALTER TABLE `pmapp_project_features`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pmapp_project_feature_roles`
--
ALTER TABLE `pmapp_project_feature_roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pmapp_project_narratives`
--
ALTER TABLE `pmapp_project_narratives`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pmapp_project_states`
--
ALTER TABLE `pmapp_project_states`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pmapp_project_visions`
--
ALTER TABLE `pmapp_project_visions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pmapp_related_cards`
--
ALTER TABLE `pmapp_related_cards`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pmapp_releases`
--
ALTER TABLE `pmapp_releases`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pmapp_release_cards`
--
ALTER TABLE `pmapp_release_cards`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pmapp_release_deployment_server`
--
ALTER TABLE `pmapp_release_deployment_server`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pmapp_release_projects`
--
ALTER TABLE `pmapp_release_projects`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pmapp_roles`
--
ALTER TABLE `pmapp_roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pmapp_row_columns`
--
ALTER TABLE `pmapp_row_columns`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pmapp_severity_sequence`
--
ALTER TABLE `pmapp_severity_sequence`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pmapp_sprints`
--
ALTER TABLE `pmapp_sprints`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pmapp_sprint_cards`
--
ALTER TABLE `pmapp_sprint_cards`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pmapp_sprint_projects`
--
ALTER TABLE `pmapp_sprint_projects`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pmapp_state_change_histories`
--
ALTER TABLE `pmapp_state_change_histories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pmapp_status`
--
ALTER TABLE `pmapp_status`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pmapp_time_estimates`
--
ALTER TABLE `pmapp_time_estimates`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pmapp_time_spends`
--
ALTER TABLE `pmapp_time_spends`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pmapp_type_states`
--
ALTER TABLE `pmapp_type_states`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pmapp_user_avatars`
--
ALTER TABLE `pmapp_user_avatars`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pmapp_user_project_roles`
--
ALTER TABLE `pmapp_user_project_roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `post_authors`
--
ALTER TABLE `post_authors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `progress_reports`
--
ALTER TABLE `progress_reports`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `project_jobs`
--
ALTER TABLE `project_jobs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `queue_email`
--
ALTER TABLE `queue_email`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reports_external_recipients`
--
ALTER TABLE `reports_external_recipients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `report_app_comments`
--
ALTER TABLE `report_app_comments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `report_app_jobs`
--
ALTER TABLE `report_app_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `report_app_milestones`
--
ALTER TABLE `report_app_milestones`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `report_attachments`
--
ALTER TABLE `report_attachments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `report_categories`
--
ALTER TABLE `report_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `report_email_log`
--
ALTER TABLE `report_email_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `report_items`
--
ALTER TABLE `report_items`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `report_item_attachments`
--
ALTER TABLE `report_item_attachments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `report_logs`
--
ALTER TABLE `report_logs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `report_recipients`
--
ALTER TABLE `report_recipients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `report_sent_users`
--
ALTER TABLE `report_sent_users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `req_actions`
--
ALTER TABLE `req_actions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `req_action_roles`
--
ALTER TABLE `req_action_roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `req_attributes`
--
ALTER TABLE `req_attributes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `req_components`
--
ALTER TABLE `req_components`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `req_context_variables`
--
ALTER TABLE `req_context_variables`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `req_endpoints`
--
ALTER TABLE `req_endpoints`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `req_endpoint_views`
--
ALTER TABLE `req_endpoint_views`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `req_gates`
--
ALTER TABLE `req_gates`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `req_properties`
--
ALTER TABLE `req_properties`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `social_logins`
--
ALTER TABLE `social_logins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sparkflowz_bids`
--
ALTER TABLE `sparkflowz_bids`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sparkflowz_chats`
--
ALTER TABLE `sparkflowz_chats`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sparkflowz_checklists`
--
ALTER TABLE `sparkflowz_checklists`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sparkflowz_checklist_categories`
--
ALTER TABLE `sparkflowz_checklist_categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sparkflowz_checklist_tags`
--
ALTER TABLE `sparkflowz_checklist_tags`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sparkflowz_consultances`
--
ALTER TABLE `sparkflowz_consultances`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sparkflowz_goal_tags`
--
ALTER TABLE `sparkflowz_goal_tags`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sparkflowz_items`
--
ALTER TABLE `sparkflowz_items`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sparkflowz_item_categories`
--
ALTER TABLE `sparkflowz_item_categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sparkflowz_item_types`
--
ALTER TABLE `sparkflowz_item_types`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sparkflowz_payments`
--
ALTER TABLE `sparkflowz_payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sparkflowz_rfqs`
--
ALTER TABLE `sparkflowz_rfqs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sparkflowz_rfq_media`
--
ALTER TABLE `sparkflowz_rfq_media`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sparkflowz_rfq_users`
--
ALTER TABLE `sparkflowz_rfq_users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sparkflowz_schedule_notifications`
--
ALTER TABLE `sparkflowz_schedule_notifications`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sparkflowz_serviceables`
--
ALTER TABLE `sparkflowz_serviceables`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sparkflowz_services`
--
ALTER TABLE `sparkflowz_services`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sparkflowz_service_users`
--
ALTER TABLE `sparkflowz_service_users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sparkflowz_settings`
--
ALTER TABLE `sparkflowz_settings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sparkflowz_stageables`
--
ALTER TABLE `sparkflowz_stageables`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sparkflowz_stages`
--
ALTER TABLE `sparkflowz_stages`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sparkflowz_statuses`
--
ALTER TABLE `sparkflowz_statuses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sparkflowz_tags`
--
ALTER TABLE `sparkflowz_tags`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sparkflowz_userables`
--
ALTER TABLE `sparkflowz_userables`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sparkflowz_user_notifications`
--
ALTER TABLE `sparkflowz_user_notifications`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `supercards_card_tags`
--
ALTER TABLE `supercards_card_tags`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `supercards_categories`
--
ALTER TABLE `supercards_categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `supercards_project_categories`
--
ALTER TABLE `supercards_project_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `supercards_tags`
--
ALTER TABLE `supercards_tags`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `teams`
--
ALTER TABLE `teams`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `team_user`
--
ALTER TABLE `team_user`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `telescope_entries`
--
ALTER TABLE `telescope_entries`
  MODIFY `sequence` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `todos`
--
ALTER TABLE `todos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `todo_assign_users`
--
ALTER TABLE `todo_assign_users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users_unverified`
--
ALTER TABLE `users_unverified`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_companies`
--
ALTER TABLE `user_companies`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_projects`
--
ALTER TABLE `user_projects`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_roles`
--
ALTER TABLE `user_roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_sessions`
--
ALTER TABLE `user_sessions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_types`
--
ALTER TABLE `user_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `websockets_statistics_entries`
--
ALTER TABLE `websockets_statistics_entries`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_project_id_foreign` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `fields`
--
ALTER TABLE `fields`
  ADD CONSTRAINT `fields_entity_id_foreign` FOREIGN KEY (`entity_id`) REFERENCES `entities` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `pmapp_attachments`
--
ALTER TABLE `pmapp_attachments`
  ADD CONSTRAINT `attachments_card_id_foreign` FOREIGN KEY (`card_id`) REFERENCES `pmapp_cards` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `pmapp_board_card_types`
--
ALTER TABLE `pmapp_board_card_types`
  ADD CONSTRAINT `board_card_types_board_view_id_foreign` FOREIGN KEY (`board_view_id`) REFERENCES `pmapp_board_views` (`id`),
  ADD CONSTRAINT `board_card_types_card_type_id_foreign` FOREIGN KEY (`card_type_id`) REFERENCES `pmapp_card_types` (`id`);

--
-- Constraints for table `pmapp_board_views`
--
ALTER TABLE `pmapp_board_views`
  ADD CONSTRAINT `board_views_column_id_foreign` FOREIGN KEY (`column_id`) REFERENCES `pmapp_row_columns` (`id`),
  ADD CONSTRAINT `board_views_project_id_foreign` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`),
  ADD CONSTRAINT `board_views_row_id_foreign` FOREIGN KEY (`row_id`) REFERENCES `pmapp_row_columns` (`id`);

--
-- Constraints for table `pmapp_project_description`
--
ALTER TABLE `pmapp_project_description`
  ADD CONSTRAINT `pmapp_project_description_project_id_foreign` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`);

--
-- Constraints for table `pmapp_project_visions`
--
ALTER TABLE `pmapp_project_visions`
  ADD CONSTRAINT `pmapp_project_visions_project_id_foreign` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`);

--
-- Constraints for table `report_app_jobs`
--
ALTER TABLE `report_app_jobs`
  ADD CONSTRAINT `report_app_jobs_state_id_foreign` FOREIGN KEY (`state_id`) REFERENCES `pmapp_card_states` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `report_app_milestones`
--
ALTER TABLE `report_app_milestones`
  ADD CONSTRAINT `report_app_milestones_report_app_job_id_foreign` FOREIGN KEY (`report_app_job_id`) REFERENCES `report_app_jobs` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `report_app_milestones_state_id_foreign` FOREIGN KEY (`state_id`) REFERENCES `pmapp_card_states` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `req_actions`
--
ALTER TABLE `req_actions`
  ADD CONSTRAINT `req_actions_component_id_foreign` FOREIGN KEY (`component_id`) REFERENCES `req_components` (`id`),
  ADD CONSTRAINT `req_actions_endpoint_id_foreign` FOREIGN KEY (`endpoint_id`) REFERENCES `req_endpoints` (`id`);

--
-- Constraints for table `req_attributes`
--
ALTER TABLE `req_attributes`
  ADD CONSTRAINT `req_attributes_endpoint_id_foreign` FOREIGN KEY (`endpoint_id`) REFERENCES `req_endpoints` (`id`);

--
-- Constraints for table `req_components`
--
ALTER TABLE `req_components`
  ADD CONSTRAINT `req_components_project_id_foreign` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`);

--
-- Constraints for table `req_context_variables`
--
ALTER TABLE `req_context_variables`
  ADD CONSTRAINT `req_context_variables_endpoint_id_foreign` FOREIGN KEY (`endpoint_id`) REFERENCES `req_endpoints` (`id`);

--
-- Constraints for table `req_endpoint_views`
--
ALTER TABLE `req_endpoint_views`
  ADD CONSTRAINT `req_endpoint_views_endpoint_id_foreign` FOREIGN KEY (`endpoint_id`) REFERENCES `req_endpoints` (`id`);

--
-- Constraints for table `req_gates`
--
ALTER TABLE `req_gates`
  ADD CONSTRAINT `req_gates_project_id_foreign` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`);

--
-- Constraints for table `req_properties`
--
ALTER TABLE `req_properties`
  ADD CONSTRAINT `req_properties_project_id_foreign` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`);

--
-- Constraints for table `sparkflowz_checklists`
--
ALTER TABLE `sparkflowz_checklists`
  ADD CONSTRAINT `sparkflowz_checklists_checklist_category_id_foreign` FOREIGN KEY (`checklist_category_id`) REFERENCES `sparkflowz_checklist_categories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `sparkflowz_checklist_tags`
--
ALTER TABLE `sparkflowz_checklist_tags`
  ADD CONSTRAINT `sparkflowz_checklist_tags_checklist_id_foreign` FOREIGN KEY (`checklist_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `sparkflowz_checklist_tags_tag_id_foreign` FOREIGN KEY (`tag_id`) REFERENCES `sparkflowz_tags` (`id`);

--
-- Constraints for table `sparkflowz_consultances`
--
ALTER TABLE `sparkflowz_consultances`
  ADD CONSTRAINT `sparkflowz_consultances_checklist_id_foreign` FOREIGN KEY (`checklist_id`) REFERENCES `projects` (`id`),
  ADD CONSTRAINT `sparkflowz_consultances_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `sparkflowz_items`
--
ALTER TABLE `sparkflowz_items`
  ADD CONSTRAINT `sparkflowz_items_checklist_id_foreign` FOREIGN KEY (`checklist_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `sparkflowz_items_item_category_id_foreign` FOREIGN KEY (`item_category_id`) REFERENCES `sparkflowz_item_categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `sparkflowz_items_item_type_id_foreign` FOREIGN KEY (`item_type_id`) REFERENCES `sparkflowz_item_types` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `sparkflowz_item_categories`
--
ALTER TABLE `sparkflowz_item_categories`
  ADD CONSTRAINT `sparkflowz_item_categories_checklist_id_foreign` FOREIGN KEY (`checklist_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `sparkflowz_payments`
--
ALTER TABLE `sparkflowz_payments`
  ADD CONSTRAINT `sparkflowz_payments_consultance_id_foreign` FOREIGN KEY (`consultance_id`) REFERENCES `sparkflowz_consultances` (`id`);

--
-- Constraints for table `sparkflowz_rfqs`
--
ALTER TABLE `sparkflowz_rfqs`
  ADD CONSTRAINT `sparkflowz_rfqs_checklist_id_foreign` FOREIGN KEY (`checklist_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `sparkflowz_rfqs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `sparkflowz_rfq_media`
--
ALTER TABLE `sparkflowz_rfq_media`
  ADD CONSTRAINT `sparkflowz_rfq_media_media_id_foreign` FOREIGN KEY (`media_id`) REFERENCES `media` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `sparkflowz_rfq_media_rfq_id_foreign` FOREIGN KEY (`rfq_id`) REFERENCES `sparkflowz_rfqs` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `sparkflowz_serviceables`
--
ALTER TABLE `sparkflowz_serviceables`
  ADD CONSTRAINT `sparkflowz_serviceables_service_id_foreign` FOREIGN KEY (`service_id`) REFERENCES `sparkflowz_services` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `sparkflowz_stages`
--
ALTER TABLE `sparkflowz_stages`
  ADD CONSTRAINT `sparkflowz_stages_checklist_id_foreign` FOREIGN KEY (`checklist_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `sparkflowz_userables`
--
ALTER TABLE `sparkflowz_userables`
  ADD CONSTRAINT `sparkflowz_userables_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `supercards_card_tags`
--
ALTER TABLE `supercards_card_tags`
  ADD CONSTRAINT `supercards_card_tags_card_id_foreign` FOREIGN KEY (`card_id`) REFERENCES `pmapp_cards` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `supercards_card_tags_tag_id_foreign` FOREIGN KEY (`tag_id`) REFERENCES `supercards_tags` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `supercards_project_tags`
--
ALTER TABLE `supercards_project_tags`
  ADD CONSTRAINT `supercards_project_tags_project_id_foreign` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `supercards_project_tags_tag_id_foreign` FOREIGN KEY (`tag_id`) REFERENCES `supercards_tags` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `supercards_tags`
--
ALTER TABLE `supercards_tags`
  ADD CONSTRAINT `supercards_tags_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `supercards_categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `telescope_entries_tags`
--
ALTER TABLE `telescope_entries_tags`
  ADD CONSTRAINT `telescope_entries_tags_entry_uuid_foreign` FOREIGN KEY (`entry_uuid`) REFERENCES `telescope_entries` (`uuid`) ON DELETE CASCADE;

--
-- Constraints for table `todo_assign_users`
--
ALTER TABLE `todo_assign_users`
  ADD CONSTRAINT `todo_assign_users_assigned_by_foreign` FOREIGN KEY (`assigned_by`) REFERENCES `users` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `todo_assign_users_assigned_to_foreign` FOREIGN KEY (`assigned_to`) REFERENCES `users` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `todo_assign_users_todo_id_foreign` FOREIGN KEY (`todo_id`) REFERENCES `todos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
