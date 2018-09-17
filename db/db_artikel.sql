-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Sep 17, 2018 at 05:50 AM
-- Server version: 10.1.34-MariaDB
-- PHP Version: 7.0.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_artikel`
--

-- --------------------------------------------------------

--
-- Table structure for table `ci_sessions`
--

CREATE TABLE `ci_sessions` (
  `id` varchar(128) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `timestamp` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `data` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ci_sessions`
--

INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES
('ndjjlpl4rsuhcs51qs2enb5g50dj5h45', '::1', 1536053009, 0x5f5f63695f6c6173745f726567656e65726174657c693a313533363035333030393b),
('5ekodb2eljc83l03ufqm8h9turkglfqi', '::1', 1536053972, 0x5f5f63695f6c6173745f726567656e65726174657c693a313533363035333937323b),
('tquh1lbr2dglnnbtbaf91i2jrpmacbvl', '::1', 1536054299, 0x5f5f63695f6c6173745f726567656e65726174657c693a313533363035343239393b736573735f6c6f67696e5f61646d696e7c613a31353a7b733a373a22757365725f6964223b733a313a2231223b733a343a226e616d65223b733a353a2261646d696e223b733a383a22757365726e616d65223b733a353a2261646d696e223b733a383a2270617373776f7264223b733a34303a2264303333653232616533343861656235363630666332313430616563333538353063346461393937223b733a353a22656d61696c223b733a31353a2261646d696e4061646d696e2e636f6d223b733a31313a22756e697175655f636f6465223b4e3b733a31393a22656e645f666f72676f74706173735f74696d65223b4e3b733a31353a226c6173745f6c6f67696e5f74696d65223b733a31393a22323031382d30382d31352032303a32333a3432223b733a373a22726f6c655f4964223b733a313a2231223b733a363a22737461747573223b733a313a2231223b733a31323a22637265617465645f64617465223b733a31393a22323031372d31322d32392031313a32313a3331223b733a31323a22757064617465645f64617465223b733a31393a22323031382d30382d31352032303a32333a3432223b733a31303a22637265617465645f6279223b733a313a2231223b733a373a22726f6c655f6964223b733a313a2231223b733a393a22726f6c655f6e616d65223b733a31303a22537570657261646d696e223b7d757365725f69647c733a313a2231223b726f6c657c733a313a2231223b),
('s46o0nmcdipnm64uf1jdubdiaa47uhoc', '::1', 1536054896, 0x5f5f63695f6c6173745f726567656e65726174657c693a313533363035343839363b736573735f6c6f67696e5f61646d696e7c613a31353a7b733a373a22757365725f6964223b733a313a2231223b733a343a226e616d65223b733a353a2261646d696e223b733a383a22757365726e616d65223b733a353a2261646d696e223b733a383a2270617373776f7264223b733a34303a2264303333653232616533343861656235363630666332313430616563333538353063346461393937223b733a353a22656d61696c223b733a31353a2261646d696e4061646d696e2e636f6d223b733a31313a22756e697175655f636f6465223b4e3b733a31393a22656e645f666f72676f74706173735f74696d65223b4e3b733a31353a226c6173745f6c6f67696e5f74696d65223b733a31393a22323031382d30382d31352032303a32333a3432223b733a373a22726f6c655f4964223b733a313a2231223b733a363a22737461747573223b733a313a2231223b733a31323a22637265617465645f64617465223b733a31393a22323031372d31322d32392031313a32313a3331223b733a31323a22757064617465645f64617465223b733a31393a22323031382d30382d31352032303a32333a3432223b733a31303a22637265617465645f6279223b733a313a2231223b733a373a22726f6c655f6964223b733a313a2231223b733a393a22726f6c655f6e616d65223b733a31303a22537570657261646d696e223b7d757365725f69647c733a313a2231223b726f6c657c733a313a2231223b),
('q87076b65es93ktovvdj43garkrt10r9', '::1', 1536056341, 0x5f5f63695f6c6173745f726567656e65726174657c693a313533363035363334313b736573735f6c6f67696e5f61646d696e7c613a31353a7b733a373a22757365725f6964223b733a313a2231223b733a343a226e616d65223b733a353a2261646d696e223b733a383a22757365726e616d65223b733a353a2261646d696e223b733a383a2270617373776f7264223b733a34303a2264303333653232616533343861656235363630666332313430616563333538353063346461393937223b733a353a22656d61696c223b733a31353a2261646d696e4061646d696e2e636f6d223b733a31313a22756e697175655f636f6465223b4e3b733a31393a22656e645f666f72676f74706173735f74696d65223b4e3b733a31353a226c6173745f6c6f67696e5f74696d65223b733a31393a22323031382d30382d31352032303a32333a3432223b733a373a22726f6c655f4964223b733a313a2231223b733a363a22737461747573223b733a313a2231223b733a31323a22637265617465645f64617465223b733a31393a22323031372d31322d32392031313a32313a3331223b733a31323a22757064617465645f64617465223b733a31393a22323031382d30382d31352032303a32333a3432223b733a31303a22637265617465645f6279223b733a313a2231223b733a373a22726f6c655f6964223b733a313a2231223b733a393a22726f6c655f6e616d65223b733a31303a22537570657261646d696e223b7d757365725f69647c733a313a2231223b726f6c657c733a313a2231223b),
('tnf0ci63k19pau7q822vpo9pala65djf', '::1', 1536056392, 0x5f5f63695f6c6173745f726567656e65726174657c693a313533363035363334313b736573735f6c6f67696e5f61646d696e7c613a31353a7b733a373a22757365725f6964223b733a313a2231223b733a343a226e616d65223b733a353a2261646d696e223b733a383a22757365726e616d65223b733a353a2261646d696e223b733a383a2270617373776f7264223b733a34303a2264303333653232616533343861656235363630666332313430616563333538353063346461393937223b733a353a22656d61696c223b733a31353a2261646d696e4061646d696e2e636f6d223b733a31313a22756e697175655f636f6465223b4e3b733a31393a22656e645f666f72676f74706173735f74696d65223b4e3b733a31353a226c6173745f6c6f67696e5f74696d65223b733a31393a22323031382d30382d31352032303a32333a3432223b733a373a22726f6c655f4964223b733a313a2231223b733a363a22737461747573223b733a313a2231223b733a31323a22637265617465645f64617465223b733a31393a22323031372d31322d32392031313a32313a3331223b733a31323a22757064617465645f64617465223b733a31393a22323031382d30382d31352032303a32333a3432223b733a31303a22637265617465645f6279223b733a313a2231223b733a373a22726f6c655f6964223b733a313a2231223b733a393a22726f6c655f6e616d65223b733a31303a22537570657261646d696e223b7d757365725f69647c733a313a2231223b726f6c657c733a313a2231223b),
('22qq3vn2cnm3veckcmv0oktc8pqp94nn', '::1', 1536662213, 0x5f5f63695f6c6173745f726567656e65726174657c693a313533363636323230323b),
('otcjak36imlra6pfe1k1q2nsaj7jbc0p', '::1', 1536745633, 0x5f5f63695f6c6173745f726567656e65726174657c693a313533363734353630313b);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_artikel`
--

CREATE TABLE `tbl_artikel` (
  `artikel_id` int(11) NOT NULL,
  `artikel_judul` varchar(100) DEFAULT NULL,
  `artikel_pretty_url` varchar(100) DEFAULT NULL,
  `artikel_slug` varchar(100) DEFAULT NULL,
  `artikel_photo` varchar(255) DEFAULT NULL,
  `artikel_photo_real` varchar(255) DEFAULT NULL,
  `artikel_isi` text,
  `artikel_category_id` int(11) DEFAULT NULL,
  `artikel_type_id` int(11) DEFAULT NULL,
  `artikel_status` tinyint(4) DEFAULT '1' COMMENT '"0=nonactive;1=created,2=edited,3=cancel;4=published"',
  `artikel_created_date` datetime DEFAULT NULL,
  `artikel_updated_date` datetime DEFAULT NULL,
  `artikel_published_date` datetime DEFAULT NULL,
  `artikel_created_by` int(11) DEFAULT NULL,
  `artikel_updated_by` int(11) UNSIGNED DEFAULT NULL,
  `artikel_deleted_by` int(11) DEFAULT NULL,
  `artikel_deleted_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_artikel`
--

INSERT INTO `tbl_artikel` (`artikel_id`, `artikel_judul`, `artikel_pretty_url`, `artikel_slug`, `artikel_photo`, `artikel_photo_real`, `artikel_isi`, `artikel_category_id`, `artikel_type_id`, `artikel_status`, `artikel_created_date`, `artikel_updated_date`, `artikel_published_date`, `artikel_created_by`, `artikel_updated_by`, `artikel_deleted_by`, `artikel_deleted_date`) VALUES
(1, 'bug fix lier', 'bug-fix-lier', NULL, '/upload/article/web_dakwah_1533993397.png', NULL, '<p>bug fix save data , jquery mesti upgrade&nbsp;</p>', 46, NULL, 4, '2018-08-11 15:23:00', '2018-08-11 15:23:00', NULL, 1, 1, NULL, NULL),
(2, 'test data dummy manhaj', 'test-data-dummy-manhaj', NULL, '/upload/article/web_dakwah_1534180373.png', NULL, '<p>bug fix save data , jquery mesti upgrade&nbsp;</p>', 46, NULL, 4, '2018-08-13 19:12:53', '2018-08-13 19:15:45', '2018-08-13 19:15:45', 1, 1, NULL, NULL),
(3, 'test lagi aja gan', 'test-lagi-aja-gan', NULL, '/upload/article/web_dakwah_1534180425.png', NULL, '<p>bug fix save data , jquery mesti upgrade&nbsp;</p>', 46, NULL, 4, '2018-08-13 19:13:45', '2018-08-13 19:15:35', '2018-08-13 19:15:35', 1, NULL, NULL, NULL),
(4, 'yowes ben', 'yowes-ben', NULL, '/upload/article/web_dakwah_1534180493.png', NULL, '<p>bug fix save data , jquery mesti upgrade&nbsp;</p>', 92, NULL, 4, '2018-08-13 19:14:53', '2018-08-13 19:15:23', '2018-08-13 19:15:23', 1, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_artikel_detail`
--

CREATE TABLE `tbl_artikel_detail` (
  `artikel_detail_id` int(11) NOT NULL,
  `artikel_id` int(11) NOT NULL,
  `tag_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_artikel_detail`
--

INSERT INTO `tbl_artikel_detail` (`artikel_detail_id`, `artikel_id`, `tag_id`) VALUES
(3, 2, 1),
(4, 1, 1),
(5, 3, 2),
(6, 4, 3);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_artikel_type`
--

CREATE TABLE `tbl_artikel_type` (
  `type_id` int(11) NOT NULL,
  `type_nam` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_artikel_type`
--

INSERT INTO `tbl_artikel_type` (`type_id`, `type_nam`) VALUES
(1, 'NASEHAT'),
(2, 'KAJIAN'),
(3, 'TIPS');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_artikel_video`
--

CREATE TABLE `tbl_artikel_video` (
  `artikel_video_id` int(11) NOT NULL,
  `title` varchar(50) DEFAULT NULL,
  `pretty_url` varchar(50) DEFAULT NULL,
  `url_video` varchar(100) DEFAULT NULL,
  `url_image` varchar(255) DEFAULT NULL,
  `id_embed` varchar(255) DEFAULT NULL,
  `content` text,
  `copyright` varchar(50) DEFAULT NULL,
  `status` tinyint(4) DEFAULT '1' COMMENT '"0=nonactive;1=active;3=cancel;4=publish"',
  `created_date` datetime DEFAULT NULL,
  `updated_date` datetime DEFAULT NULL,
  `publish_date` datetime DEFAULT NULL,
  `publish_by` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_artikel_video`
--

INSERT INTO `tbl_artikel_video` (`artikel_video_id`, `title`, `pretty_url`, `url_video`, `url_image`, `id_embed`, `content`, `copyright`, `status`, `created_date`, `updated_date`, `publish_date`, `publish_by`, `created_by`, `deleted_by`) VALUES
(1, 'judul ini', 'judul-ini', 'http://devel-aks.com', NULL, NULL, '', 'ya', 0, '2018-08-11 15:37:45', NULL, NULL, NULL, 1, 1),
(2, 'judul ini', 'judul-ini', 'http://devel-aks.com', NULL, NULL, '', 'ya', 0, '2018-08-11 15:39:01', NULL, NULL, NULL, 1, 1),
(3, 'bug fix', 'bug-fix', 'bug fix', NULL, NULL, '', 'bug fix edit SD', 0, '2018-08-11 15:42:53', '2018-08-11 15:42:53', NULL, NULL, 1, 1),
(8, 'tes sdsd', 'tes-sdsd', 'https://www.youtube.com/embed/Bkc21wU5wKE', 'http://img.youtube.com/vi/Bkc21wU5wKE/0.jpg', NULL, '', 'te', 1, '2018-08-14 09:36:07', NULL, NULL, NULL, 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_background_slider`
--

CREATE TABLE `tbl_background_slider` (
  `slider_id` int(11) NOT NULL,
  `title` varchar(45) DEFAULT NULL,
  `image` varchar(100) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `status` tinyint(4) DEFAULT '1' COMMENT '"0=nonactive;1=active"',
  `created_date` datetime DEFAULT NULL,
  `updated_date` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_background_slider`
--

INSERT INTO `tbl_background_slider` (`slider_id`, `title`, `image`, `description`, `status`, `created_date`, `updated_date`, `created_by`) VALUES
(1, 'judul', '/upload/background/pejuangshubuh_1534015820.png', 'wewe', 1, '2018-08-11 21:30:22', NULL, 1),
(2, 'test', '/upload/background/pejuangshubuh_1534181557.png', 'test', 1, '2018-08-13 19:32:40', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_change_log`
--

CREATE TABLE `tbl_change_log` (
  `change_log_id` int(11) NOT NULL,
  `change_log_name` varchar(50) DEFAULT NULL,
  `change_log_description` text,
  `change_log_date` datetime DEFAULT NULL,
  `change_log_curr_version` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_change_log`
--

INSERT INTO `tbl_change_log` (`change_log_id`, `change_log_name`, `change_log_description`, `change_log_date`, `change_log_curr_version`) VALUES
(1, 'Realese CMS', 'REALESE CMS untuk penulisan artikel pribadi', '2018-02-10 20:33:36', 'VERSION 1.0.1');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_jadwal`
--

CREATE TABLE `tbl_jadwal` (
  `jadwal_id` int(11) NOT NULL,
  `jadwal_name` varchar(200) DEFAULT NULL,
  `jadwal_location` text,
  `jadwal_photo` varchar(255) DEFAULT NULL,
  `jadwal_start` datetime DEFAULT NULL,
  `jadwal_end` datetime DEFAULT NULL,
  `jadwal_event_date` datetime DEFAULT NULL,
  `jadwal_kategori_id` int(11) DEFAULT NULL,
  `jadwal_description` text,
  `jadwal_status` tinyint(4) DEFAULT '1' COMMENT '''0=nonactive;1=active;2=edited;3=cancel;4=publish''',
  `jadwal_created_date` datetime DEFAULT NULL,
  `jadwal_updated_date` datetime DEFAULT NULL,
  `jadwal_created_by` int(11) DEFAULT NULL,
  `jadwal_updated_by` int(11) DEFAULT NULL,
  `jadwal_deleted_by` int(11) DEFAULT NULL,
  `jadwal_deleted_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_jadwal`
--

INSERT INTO `tbl_jadwal` (`jadwal_id`, `jadwal_name`, `jadwal_location`, `jadwal_photo`, `jadwal_start`, `jadwal_end`, `jadwal_event_date`, `jadwal_kategori_id`, `jadwal_description`, `jadwal_status`, `jadwal_created_date`, `jadwal_updated_date`, `jadwal_created_by`, `jadwal_updated_by`, `jadwal_deleted_by`, `jadwal_deleted_date`) VALUES
(25, 'test', 'test', NULL, '2018-09-04 16:57:28', NULL, NULL, 147, '', 2, '2018-09-04 16:57:31', '2018-09-04 16:57:31', NULL, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_jadwal_kategori`
--

CREATE TABLE `tbl_jadwal_kategori` (
  `jadwal_kategori_id` int(11) NOT NULL,
  `kategori_name` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_jadwal_kategori`
--

INSERT INTO `tbl_jadwal_kategori` (`jadwal_kategori_id`, `kategori_name`) VALUES
(145, 'Kajian Sunnah'),
(146, 'Tabligh Akbar'),
(147, 'Acara Masjid');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_kategori`
--

CREATE TABLE `tbl_kategori` (
  `kategori_id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `status` tinyint(4) DEFAULT '1' COMMENT '"0=nonactive;1=active"',
  `created_date` datetime DEFAULT NULL,
  `updated_date` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_kategori`
--

INSERT INTO `tbl_kategori` (`kategori_id`, `name`, `parent_id`, `status`, `created_date`, `updated_date`) VALUES
(45, 'Kajian', NULL, 1, '2018-01-02 08:14:48', NULL),
(46, 'Artikel Harian', NULL, 1, '2018-01-02 00:00:00', NULL),
(89, 'Nasional', NULL, 1, '2018-01-02 00:00:00', NULL),
(90, 'Hadits', NULL, 1, NULL, NULL),
(91, 'Manhaj', NULL, 1, NULL, NULL),
(92, 'Aqidah', NULL, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_quote`
--

CREATE TABLE `tbl_quote` (
  `quote_id` int(11) NOT NULL,
  `quote` varchar(200) NOT NULL,
  `quote_create_date` datetime NOT NULL,
  `quote_updated_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_tag`
--

CREATE TABLE `tbl_tag` (
  `tag_id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `status` tinyint(4) DEFAULT '1' COMMENT '"0=nonactive;1=active"',
  `created_date` datetime DEFAULT NULL,
  `updated_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_tag`
--

INSERT INTO `tbl_tag` (`tag_id`, `name`, `status`, `created_date`, `updated_date`) VALUES
(1, 'ini tes', 1, '2018-08-13 19:11:31', NULL),
(2, 'oke test terus', 1, '2018-08-13 19:13:48', NULL),
(3, 'yowes ben', 1, '2018-08-13 19:14:56', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `user_id` int(11) NOT NULL,
  `name` varchar(200) DEFAULT NULL,
  `username` varchar(45) DEFAULT NULL,
  `password` varchar(45) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `unique_code` varchar(40) DEFAULT NULL,
  `end_forgotpass_time` datetime DEFAULT NULL,
  `last_login_time` timestamp NULL DEFAULT NULL,
  `role_Id` int(11) DEFAULT NULL,
  `status` tinyint(4) DEFAULT '1' COMMENT '"0=non-active;1=active"',
  `created_date` datetime DEFAULT NULL,
  `updated_date` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`user_id`, `name`, `username`, `password`, `email`, `unique_code`, `end_forgotpass_time`, `last_login_time`, `role_Id`, `status`, `created_date`, `updated_date`, `created_by`) VALUES
(1, 'admin', 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'admin@admin.com', NULL, NULL, '2018-09-04 09:43:10', 1, 1, '2017-12-29 11:21:31', '2018-09-04 16:43:10', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user_role`
--

CREATE TABLE `tbl_user_role` (
  `role_id` int(11) NOT NULL,
  `role_name` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_user_role`
--

INSERT INTO `tbl_user_role` (`role_id`, `role_name`) VALUES
(1, 'Superadmin'),
(2, 'admin'),
(3, 'Penulis');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ci_sessions`
--
ALTER TABLE `ci_sessions`
  ADD KEY `ci_sessions_timestamp` (`timestamp`);

--
-- Indexes for table `tbl_artikel`
--
ALTER TABLE `tbl_artikel`
  ADD PRIMARY KEY (`artikel_id`);

--
-- Indexes for table `tbl_artikel_detail`
--
ALTER TABLE `tbl_artikel_detail`
  ADD PRIMARY KEY (`artikel_detail_id`);

--
-- Indexes for table `tbl_artikel_type`
--
ALTER TABLE `tbl_artikel_type`
  ADD PRIMARY KEY (`type_id`);

--
-- Indexes for table `tbl_artikel_video`
--
ALTER TABLE `tbl_artikel_video`
  ADD PRIMARY KEY (`artikel_video_id`);

--
-- Indexes for table `tbl_background_slider`
--
ALTER TABLE `tbl_background_slider`
  ADD PRIMARY KEY (`slider_id`);

--
-- Indexes for table `tbl_change_log`
--
ALTER TABLE `tbl_change_log`
  ADD PRIMARY KEY (`change_log_id`);

--
-- Indexes for table `tbl_jadwal`
--
ALTER TABLE `tbl_jadwal`
  ADD PRIMARY KEY (`jadwal_id`);

--
-- Indexes for table `tbl_jadwal_kategori`
--
ALTER TABLE `tbl_jadwal_kategori`
  ADD PRIMARY KEY (`jadwal_kategori_id`);

--
-- Indexes for table `tbl_kategori`
--
ALTER TABLE `tbl_kategori`
  ADD PRIMARY KEY (`kategori_id`);

--
-- Indexes for table `tbl_quote`
--
ALTER TABLE `tbl_quote`
  ADD PRIMARY KEY (`quote_id`);

--
-- Indexes for table `tbl_tag`
--
ALTER TABLE `tbl_tag`
  ADD PRIMARY KEY (`tag_id`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `tbl_user_role`
--
ALTER TABLE `tbl_user_role`
  ADD PRIMARY KEY (`role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_artikel`
--
ALTER TABLE `tbl_artikel`
  MODIFY `artikel_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_artikel_detail`
--
ALTER TABLE `tbl_artikel_detail`
  MODIFY `artikel_detail_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_artikel_type`
--
ALTER TABLE `tbl_artikel_type`
  MODIFY `type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_artikel_video`
--
ALTER TABLE `tbl_artikel_video`
  MODIFY `artikel_video_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tbl_background_slider`
--
ALTER TABLE `tbl_background_slider`
  MODIFY `slider_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_change_log`
--
ALTER TABLE `tbl_change_log`
  MODIFY `change_log_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_jadwal`
--
ALTER TABLE `tbl_jadwal`
  MODIFY `jadwal_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `tbl_jadwal_kategori`
--
ALTER TABLE `tbl_jadwal_kategori`
  MODIFY `jadwal_kategori_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=148;

--
-- AUTO_INCREMENT for table `tbl_kategori`
--
ALTER TABLE `tbl_kategori`
  MODIFY `kategori_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=93;

--
-- AUTO_INCREMENT for table `tbl_quote`
--
ALTER TABLE `tbl_quote`
  MODIFY `quote_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_tag`
--
ALTER TABLE `tbl_tag`
  MODIFY `tag_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_user_role`
--
ALTER TABLE `tbl_user_role`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
