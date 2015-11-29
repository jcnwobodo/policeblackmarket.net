-- phpMyAdmin SQL Dump
-- version 4.5.0.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 29, 2015 at 10:31 PM
-- Server version: 10.0.17-MariaDB
-- PHP Version: 5.5.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `www_police_blackmarket`
--

-- --------------------------------------------------------

--
-- Table structure for table `pbm_reports`
--

CREATE TABLE `pbm_reports` (
  `id` int(16) NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `event_time` bigint(32) NOT NULL,
  `report_time` bigint(32) NOT NULL,
  `location_state` int(16) NOT NULL COMMENT 'site_locations.id',
  `location_lga` int(16) NOT NULL,
  `location_district` int(16) NOT NULL,
  `location_scene` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT '2' COMMENT '0|1|2'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pbm_reports`
--

INSERT INTO `pbm_reports` (`id`, `title`, `description`, `event_time`, `report_time`, `location_state`, `location_lga`, `location_district`, `location_scene`, `status`) VALUES
(2, 'title', 'text', 1448755261, 1448751600, 1, 2, 3, '', 2);

-- --------------------------------------------------------

--
-- Table structure for table `pbm_reports_meta`
--

CREATE TABLE `pbm_reports_meta` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `report_id` bigint(20) UNSIGNED NOT NULL,
  `meta_type` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `meta_value` text COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `site_categories`
--

CREATE TABLE `site_categories` (
  `id` int(16) NOT NULL,
  `guid` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent` int(16) DEFAULT NULL COMMENT 'site_posts_categories.id',
  `caption` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `site_categories`
--

INSERT INTO `site_categories` (`id`, `guid`, `parent`, `caption`, `type`) VALUES
(1, 'news', NULL, 'News', 'post'),
(2, 'extortion', NULL, 'Extortion', 'report'),
(3, 'bribery', NULL, 'Bribery', 'report');

-- --------------------------------------------------------

--
-- Table structure for table `site_comments`
--

CREATE TABLE `site_comments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `parent` int(16) UNSIGNED NOT NULL DEFAULT '0',
  `post_id` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `comment_author` int(16) NOT NULL,
  `comment_time` bigint(32) NOT NULL,
  `comment_type` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(1) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `site_locations`
--

CREATE TABLE `site_locations` (
  `id` bigint(16) NOT NULL,
  `parent` bigint(16) DEFAULT NULL,
  `location_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slogan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `location_type` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `latitude` decimal(5,3) DEFAULT NULL,
  `longitude` decimal(5,3) DEFAULT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `site_locations`
--

INSERT INTO `site_locations` (`id`, `parent`, `location_name`, `slogan`, `location_type`, `latitude`, `longitude`, `status`) VALUES
(1, NULL, 'Enugu', 'Coal City State', 'state', '0.000', '0.000', 1),
(2, 1, 'Nsukka', '', 'lga', '0.000', '0.000', 1),
(3, 2, 'UNN', NULL, 'district', NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `site_posts`
--

CREATE TABLE `site_posts` (
  `id` int(16) NOT NULL,
  `parent` int(16) DEFAULT NULL COMMENT 'site_posts.id',
  `post_type` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guid` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `excerpt` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `featured_image` int(16) DEFAULT NULL COMMENT 'uploads.id',
  `category` int(16) DEFAULT NULL COMMENT 'site_posts_categories.id',
  `author` int(16) NOT NULL COMMENT 'users.id',
  `date_created` int(32) NOT NULL,
  `last_update` int(32) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `site_posts`
--

INSERT INTO `site_posts` (`id`, `parent`, `post_type`, `guid`, `title`, `content`, `excerpt`, `featured_image`, `category`, `author`, `date_created`, `last_update`, `status`) VALUES
(1, NULL, 'page', 'how-it-works', 'How It Works', 'some text', 'some exerpt', NULL, NULL, 1, 500000, 510000, 1);

-- --------------------------------------------------------

--
-- Table structure for table `site_sessions`
--

CREATE TABLE `site_sessions` (
  `id` int(16) NOT NULL,
  `session_id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(16) NOT NULL COMMENT 'users.id',
  `user_type` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'users_access_levels.user_type',
  `start_time` int(32) NOT NULL,
  `user_agent` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ip_address` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity_time` int(32) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `site_sessions`
--

INSERT INTO `site_sessions` (`id`, `session_id`, `user_id`, `user_type`, `start_time`, `user_agent`, `ip_address`, `last_activity_time`, `status`) VALUES
(7, '565875b0bdbe06.70203316', 1, 'admin', 1448578800, 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:40.0) Gecko/20100101 Firefox/40.0', '::1', 1448755261, 1);

-- --------------------------------------------------------

--
-- Table structure for table `site_uploads`
--

CREATE TABLE `site_uploads` (
  `id` int(16) NOT NULL,
  `MIME_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `upload_time` int(32) NOT NULL,
  `location` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guid` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `author` int(16) NOT NULL COMMENT 'site_users.id'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `site_users`
--

CREATE TABLE `site_users` (
  `id` int(16) NOT NULL,
  `username` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_type` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `first_name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nickname` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` char(1) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_of_birth` int(32) NOT NULL,
  `date_joined` bigint(32) NOT NULL,
  `place_of_origin` int(16) NOT NULL COMMENT 'site_locations.id',
  `place_of_residence` int(16) NOT NULL COMMENT 'maps_countries.id',
  `email` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `photo` int(16) DEFAULT NULL COMMENT 'uploads.id',
  `biography` text COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `site_users`
--

INSERT INTO `site_users` (`id`, `username`, `password`, `user_type`, `first_name`, `last_name`, `nickname`, `gender`, `date_of_birth`, `date_joined`, `place_of_origin`, `place_of_residence`, `email`, `phone`, `photo`, `biography`) VALUES
(1, 'admin', 'password', 'admin', 'Chukwuemeka', 'Nwobodo', 'Joe', 'M', 500000000, 800000000, 2, 4, 'jc.nwobodo@gmail.com', '08133621591', NULL, 'some text here');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pbm_reports`
--
ALTER TABLE `pbm_reports`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pbm_reports_meta`
--
ALTER TABLE `pbm_reports_meta`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `site_categories`
--
ALTER TABLE `site_categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `guid` (`guid`);

--
-- Indexes for table `site_comments`
--
ALTER TABLE `site_comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `site_locations`
--
ALTER TABLE `site_locations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `site_posts`
--
ALTER TABLE `site_posts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `pamalink` (`guid`);

--
-- Indexes for table `site_sessions`
--
ALTER TABLE `site_sessions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `session_id` (`session_id`);

--
-- Indexes for table `site_uploads`
--
ALTER TABLE `site_uploads`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `pamanent link` (`guid`);

--
-- Indexes for table `site_users`
--
ALTER TABLE `site_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `photo_id` (`photo`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pbm_reports`
--
ALTER TABLE `pbm_reports`
  MODIFY `id` int(16) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `pbm_reports_meta`
--
ALTER TABLE `pbm_reports_meta`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `site_categories`
--
ALTER TABLE `site_categories`
  MODIFY `id` int(16) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `site_comments`
--
ALTER TABLE `site_comments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `site_locations`
--
ALTER TABLE `site_locations`
  MODIFY `id` bigint(16) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `site_posts`
--
ALTER TABLE `site_posts`
  MODIFY `id` int(16) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `site_sessions`
--
ALTER TABLE `site_sessions`
  MODIFY `id` int(16) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `site_uploads`
--
ALTER TABLE `site_uploads`
  MODIFY `id` int(16) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `site_users`
--
ALTER TABLE `site_users`
  MODIFY `id` int(16) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
