-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 01, 2018 at 05:39 AM
-- Server version: 10.1.36-MariaDB
-- PHP Version: 7.2.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `admin.macdinh`
--

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `id` int(3) UNSIGNED NOT NULL,
  `parent_id` int(3) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `link` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `icon` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `orders` int(3) UNSIGNED NOT NULL,
  `status` tinyint(1) UNSIGNED NOT NULL DEFAULT '1',
  `target` tinyint(1) UNSIGNED NOT NULL DEFAULT '0' COMMENT '0: tab hiện tại; 1: tab mới'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id`, `parent_id`, `name`, `link`, `icon`, `orders`, `status`, `target`) VALUES
(1, 0, 'Trang chủ', '', NULL, 4, 1, 0),
(2, 0, 'Tin tức', '', NULL, 3, 1, 0),
(3, 0, 'Giới thiệu', '', NULL, 2, 1, 0),
(4, 0, 'Album', '', NULL, 1, 1, 0),
(5, 4, 'Album Đà Nẵng', '', NULL, 3, 1, 0),
(6, 4, 'Album Hồ Cốc', '', NULL, 1, 1, 0),
(7, 2, 'Tin tức thế giới', '', NULL, 1, 1, 0),
(9, 4, 'Album Nha Trang', '', NULL, 2, 1, 0),
(10, 5, 'Album Đà Nẵng 001', '', NULL, 1, 1, 0),
(17, 6, 'Hồ Cốc 11111', 'ho-coc-11111', NULL, 1, 0, 0),
(18, 6, 'Hồ Cốc 2', '', NULL, 2, 1, 0),
(19, 6, 'Hồ Cốc 3', '', NULL, 3, 1, 0),
(24, 17, 'Hồ Cốc 1 - 1', '', NULL, 2, 1, 0),
(25, 17, 'Hồ Cốc 1 - 2', '', NULL, 1, 1, 0),
(26, 25, 'Hồ Cốc 1 - 2 - 1', '', NULL, 1, 1, 0),
(27, 18, 'Hồ Cốc 2 - 1', '', NULL, 1, 1, 0),
(28, 7, 'Tin Mỹ', '', NULL, 1, 1, 0),
(29, 28, 'Bắc Mỹ', '', NULL, 1, 1, 0),
(30, 28, 'Nam Mỹ', '', NULL, 1, 1, 0),
(31, 29, 'Bắc Mỹ 1', '', NULL, 1, 1, 0),
(32, 31, 'Bắc Mỹ 1 - 1', '', NULL, 1, 1, 0),
(33, 19, 'Hồ Cốc 3 - 1', '', NULL, 1, 1, 0),
(34, 19, 'Hồ Cốc 3 - 2', '', NULL, 2, 1, 0),
(35, 34, 'Hồ Cốc 3 - 2 - 2', '', NULL, 1, 1, 0),
(36, 7, 'Tin Nga', '', NULL, 2, 1, 0),
(37, 10, 'Đà Nẵng 001 - 001', '', NULL, 1, 1, 0),
(38, 37, 'Menu mới - sẽ dùng để xóa sau', '', NULL, 1, 1, 0),
(39, 2, 'Tin khác - Có thể xóa', '', NULL, 2, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `id` int(11) UNSIGNED NOT NULL,
  `category_id` int(11) UNSIGNED NOT NULL,
  `author` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `alias` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `view` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `thumbnail` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `caption` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(1) UNSIGNED NOT NULL,
  `created_at` datetime NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `keyword` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`id`, `category_id`, `author`, `name`, `alias`, `view`, `thumbnail`, `caption`, `content`, `status`, `created_at`, `title`, `keyword`, `description`) VALUES
(1, 1, 41, 'Đây là tin tức thử nghiệm', 'day-la-tin-tuc-thu-nghiem', '0', '/source/news/Chrysanthemum.jpg', 'Mô tả tin tức thử nghiệm', '<p style=\"text-align: center;\"><span style=\"color: #000080; font-size: 18pt;\"><strong>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</strong></span></p>\r\n<p style=\"text-align: justify;\"><span style=\"color: #000000; font-size: 10pt;\">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Asperiores illum corporis ea consequuntur optio pariatur, nobis expedita, velit ipsum, nulla dolorem odit sed libero atque et aut veniam vitae molestiae. Id quae dignissimos animi nam doloremque, accusamus perspiciatis deleniti incidunt molestiae eos assumenda, nesciunt amet tempore, voluptate numquam laboriosam expedita <a href=\"/admin/news/abc.com\">suscipit</a>. Vel magnam magni, deleniti fugiat. Assumenda odio molestias tempora magnam vero ducimus id commodi pariatur cum quae sunt quaerat laudantium nemo, nihil sapiente possimus doloribus qui eius, fuga debitis esse ea modi! Non enim, voluptatum voluptatem, quaerat nostrum veritatis iste quos esse deleniti unde sunt. Corporis temporibus sequi consequuntur:</span></p>\r\n<ul>\r\n<li style=\"text-align: justify;\"><span style=\"color: #000000; font-size: 10pt;\">Lorem ipsum dolor sit amet</span></li>\r\n<li style=\"text-align: justify;\"><span style=\"color: #000000; font-size: 10pt;\">deleniti unde sunt.</span></li>\r\n<li style=\"text-align: justify;\"><span style=\"color: #000000; font-size: 10pt;\">accusamus perspiciatis deleniti incidunt molestiae</span></li>\r\n</ul>\r\n<p><span style=\"color: #000000; font-size: 10pt;\"><img src=\"https://images3.alphacoders.com/583/583852.jpg\" width=\"100%\" /></span></p>\r\n<p style=\"text-align: justify;\">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Asperiores illum corporis ea consequuntur optio pariatur, nobis expedita, velit ipsum, nulla dolorem odit sed libero atque et aut veniam vitae molestiae. Id quae dignissimos animi nam doloremque, accusamus perspiciatis deleniti incidunt molestiae eos assumenda, nesciunt amet tempore, voluptate numquam laboriosam expedita suscipit. Vel magnam magni, deleniti fugiat. Assumenda odio molestias tempora magnam vero ducimus id commodi pariatur cum quae sunt quaerat laudantium nemo, nihil sapiente possimus doloribus qui eius, fuga debitis esse ea modi! Non enim, voluptatum voluptatem, quaerat nostrum veritatis iste quos esse deleniti unde sunt. Corporis temporibus sequi consequuntur&nbsp;Lorem ipsum dolor sit amet, consectetur adipisicing elit. Asperiores illum corporis ea consequuntur optio pariatur, nobis expedita, velit ipsum, nulla dolorem odit sed libero atque et aut veniam vitae molestiae. Id quae dignissimos animi nam doloremque, accusamus perspiciatis deleniti incidunt molestiae eos assumenda, nesciunt amet tempore, voluptate numquam laboriosam expedita suscipit. Vel magnam magni, deleniti fugiat. Assumenda odio molestias tempora magnam vero ducimus id commodi pariatur cum quae sunt quaerat laudantium nemo, nihil sapiente possimus doloribus qui eius, fuga debitis esse ea modi! Non enim, voluptatum voluptatem, quaerat nostrum veritatis iste quos esse deleniti unde sunt. Corporis temporibus sequi consequuntur?</p>\r\n<p style=\"text-align: justify;\"><img src=\"https://avatars.mds.yandex.net/get-pdb/27625/911cd6cf-dc8e-4352-9cef-3a7db8170a8d/orig\" alt=\"\" width=\"100%\" height=\"1080\" /></p>\r\n<p style=\"text-align: justify;\">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Asperiores illum corporis ea consequuntur optio pariatur, nobis expedita, velit ipsum, nulla dolorem odit sed libero atque et aut veniam vitae molestiae. Id quae dignissimos animi nam doloremque, accusamus perspiciatis deleniti incidunt molestiae eos assumenda, nesciunt amet tempore, voluptate numquam laboriosam expedita suscipit. Vel magnam magni, deleniti fugiat. Assumenda odio molestias tempora magnam vero ducimus id commodi pariatur cum quae sunt quaerat laudantium nemo, nihil sapiente possimus doloribus qui eius, fuga debitis esse ea modi! Non enim, voluptatum voluptatem, quaerat nostrum veritatis iste quos esse deleniti unde sunt. Corporis temporibus sequi consequuntur?</p>', 1, '2018-11-26 10:49:46', 'title', 'keyword', 'description');

-- --------------------------------------------------------

--
-- Table structure for table `news_categories`
--

CREATE TABLE `news_categories` (
  `id` int(11) UNSIGNED NOT NULL,
  `parent_id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `alias` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `banner` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `thumbnail` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `link` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `introduction` text COLLATE utf8_unicode_ci,
  `orders` int(3) UNSIGNED DEFAULT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `keyword` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` tinyint(1) UNSIGNED NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `news_categories`
--

INSERT INTO `news_categories` (`id`, `parent_id`, `name`, `alias`, `banner`, `thumbnail`, `link`, `introduction`, `orders`, `title`, `keyword`, `description`, `status`) VALUES
(1, 0, 'Danh mục tin tức đầu tiên', 'danh-muc-tin-tuc-dau-tien', NULL, NULL, NULL, NULL, NULL, 'Tiêu đề', '', '', 1),
(2, 0, 'Danh mục tin tức thứ 2', 'danh-muc-tin-tuc-thu-2', NULL, NULL, NULL, NULL, NULL, '', '', '', 1),
(3, 0, 'Danh mục tin tức thứ 3', 'danh-muc-tin-tuc-thu-3', NULL, NULL, NULL, NULL, NULL, '', '', '', 0),
(4, 0, 'Danh mục mới nhất', 'danh-muc-moi-nhat', NULL, NULL, NULL, NULL, NULL, '', '', '', 1),
(5, 0, 'Danh mục mới này', 'danh-muc-moi-nay', NULL, NULL, NULL, NULL, NULL, '', '', '', 0),
(6, 0, 'Test', 'test', NULL, NULL, NULL, NULL, NULL, '', '', '', 1),
(7, 0, 'Danh mục tin tức thứ 2123', 'danh-muc-tin-tuc-thu-2123', NULL, NULL, NULL, NULL, NULL, '123', '', '', 1),
(8, 0, 'Danh mục tin tức đầu tiên thứ 2', 'danh-muc-tin-tuc-dau-tien-thu-2', NULL, NULL, NULL, NULL, NULL, 'Tiêu đề', '', '', 1),
(9, 0, 'Danh mục tin tức thứ 14071997_01', 'danh-muc-tin-tuc-thu-14071997_01', NULL, NULL, NULL, NULL, NULL, 'tiêu đề 14071997_01', 'từ khóa', 'mô tả 14071997', 1),
(10, 0, 'Danh mục tin tức thứ 14071997_02', 'danh-muc-tin-tuc-thu-14071997_02', NULL, NULL, NULL, NULL, NULL, 'tiêu đề 14071997_02', '', 'mô tả 14071997', 1),
(11, 0, 'Danh mục tin tức thứ 14071997_03', 'danh-muc-tin-tuc-thu-14071997_03', NULL, NULL, NULL, NULL, NULL, 'tiêu đề 14071997_03', 'từ khóa', 'mô tả 14071997', 1),
(12, 0, 'abcxyz', 'abcxyz', NULL, NULL, NULL, NULL, NULL, '', '', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `username` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `avatar` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `firstname` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `lastname` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `mobile_no` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `address` mediumtext COLLATE utf8_unicode_ci,
  `role` tinyint(4) NOT NULL DEFAULT '1',
  `is_active` tinyint(4) NOT NULL DEFAULT '1',
  `is_verify` tinyint(4) NOT NULL DEFAULT '0',
  `is_admin` tinyint(4) NOT NULL DEFAULT '0',
  `is_visible` tinyint(1) NOT NULL DEFAULT '1',
  `is_deletable` tinyint(1) NOT NULL DEFAULT '1',
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `last_ip` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `last_login` datetime DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `avatar`, `firstname`, `lastname`, `email`, `mobile_no`, `password`, `address`, `role`, `is_active`, `is_verify`, `is_admin`, `is_visible`, `is_deletable`, `token`, `password_reset_code`, `last_ip`, `last_login`, `created_at`, `updated_at`) VALUES
(3, 'admin', NULL, 'admin', 'admin', 'admin@admin.com', '', '$2y$10$YFRA1t5txkA9DZu4RDOOsOpjkS36tXkERzMCIIgOdmHNXezjRvrYm', '', 1, 1, 1, 1, 1, 1, '', '', '', NULL, '2017-09-29 10:09:44', '2018-04-19 09:04:51'),
(37, 'irfan90', NULL, 'irfan', 'majeed', 'irfan.majeed90@gmail.com', '0981773456', '$2y$10$YYsrNfWjrNVxk14/G.jLruLF8BA5EqdgP0TYSvjsDTc76nulWu3Z6', '', 1, 0, 0, 0, 1, 1, '', '', '', NULL, '2018-04-19 09:04:31', '2018-04-19 09:04:31'),
(36, 'ali', NULL, 'ali', 'raza', 'ali@gmail.com', '123456', '$2y$10$y2NEydEkaJjjPmXLWLhr2uk090RRxpK4MihyzxwJPzT/BR4dbaSLy', '', 2, 1, 0, 0, 1, 1, '', '', '', NULL, '2018-04-19 09:04:39', '2018-04-19 09:04:39'),
(35, 'nauman', NULL, 'nauman', 'ahmed', 'naumanahmedcs@gmail.com', '44876666655', '$2y$10$Vs8oLdjx0S8guZOKgT02PuTYD8fZoG/QVEGKQkjmmlpNLJvcvcDqK', '', 1, 0, 0, 0, 1, 1, 'a86c450b76fb8c371afead6410d55534', '', '', NULL, '2018-04-18 09:04:18', '2018-04-19 08:04:34'),
(34, 'naumanit', NULL, 'nauman', 'wwe', 'nauman_wwe@yahoo.com', '', '$2y$10$o4/7prp1Zv9FmtKjo6ler.zK4TIUAIkZJiy/O5zb1MLWNikUyaTEq', '', 1, 0, 0, 0, 1, 1, '2f55707d4193dc27118a0f19a1985716', '', '', NULL, '2018-04-18 08:04:58', '2018-04-19 08:04:15'),
(38, 'naumanit', NULL, 'nauman', 'ahmed', 'codeglamour1@gmail.com', '', '$2y$10$F82UAQYcq/yKvWqasv.HIeb5qapbDBFz/ayO/1qRRqrrzB.BASv8O', '', 1, 0, 1, 0, 1, 1, '', '', '', NULL, '2018-04-20 07:04:23', '2018-04-20 07:04:55'),
(39, 'MuhammadNoman', NULL, 'Muhammad', 'Noman', 'mnomannaveed007@gmail.com', '', '$2y$10$/XqcMSRI4oo6t6Qs2Jklb.S.Cw2LeN7jwP5o41W5MEqcIAxrO/iqO', '', 1, 1, 1, 0, 1, 1, '', '', '', NULL, '2018-04-21 05:04:52', '2018-04-21 06:04:37'),
(40, '', NULL, 'Abdullah', 'Iftikhar', 'charmimughal27@gmail.com', '', '$2y$10$FMefU.20mBgadT4pj9.z3eL0RBgKSy8OJ4VBMtB43s565P3kOxNu.', '', 1, 0, 1, 0, 1, 1, '', '632725352efe55675c8084885bdc2c88', '', NULL, '2018-04-21 06:04:32', '2018-04-21 06:04:32'),
(41, '', '/source/avatars/avt1.jpg', 'Luan', 'Vu Minh', 'vuminhluan1407@gmail.com', '0991776789', '$2y$10$BdaLZA.pw4BLrVhM.CwY9ecAukoTEXCe9oQEQRmAjJBkpB04KbroW', '', 1, 1, 1, 1, 1, 1, '', '', '', '2018-11-24 01:14:09', '2018-11-19 00:00:00', '2018-11-19 00:00:00'),
(42, '', NULL, 'Long', 'Nguyen', 'vuminhluan97@gmail.com', '', '$2y$10$.Y9JXdlPr6X31H0Aai7Pz.8MSMJ660UwJrLLCoVDK6FIBu2qbji5u', '', 1, 1, 1, 1, 1, 1, '', '', '', '2018-11-22 05:27:00', '2018-11-20 00:00:00', '2018-11-20 00:00:00'),
(43, NULL, NULL, NULL, NULL, 'vuminhluantest2@gmail.com', NULL, '$2y$10$wfRADxwXyzdRS9he4ZH8/.jmUajYDy3Bq97JmQ/4BJ7I7ZMrw7UEK', NULL, 1, 1, 1, 1, 1, 1, '', NULL, NULL, NULL, '2018-11-22 12:38:37', '2018-11-22 12:38:37'),
(45, NULL, NULL, 'Ten', NULL, 'email@email.com', NULL, '$2y$10$DWW4vVNb9gN7vxfYWPAxLeaUp.ZqXWU8b4igzvRoS6FvKSVbGZqQO', 'Tan Phu TP HCM', 8, 1, 0, 0, 1, 1, 'e3b80d30a727c738f3cff0941f6bc55a', NULL, NULL, NULL, '2018-11-24 01:02:05', '2018-11-24 01:02:05'),
(44, NULL, NULL, NULL, NULL, 'vuminhluantest1@gmail.com', NULL, '$2y$10$h6eEbIoftLXRD8EePnrjS.Xp9t18ci3ZzRlacb8xUGaGEZ9X5Pzie', NULL, 1, 1, 1, 1, 1, 1, '', '', NULL, '2018-11-23 02:28:21', '2018-11-22 08:13:00', '2018-11-22 08:13:00'),
(46, NULL, NULL, 'Một', 'Xóa', 'xoa@xoa.com', NULL, '$2y$10$VDMWEKYKD1i/aOt6widL/O4IWRz1/6P5BzfkHZ9whZWSm5jk0lm7a', NULL, 1, 1, 0, 0, 1, 1, 'f3067d687ee39c3cbfa75573457e479d', NULL, NULL, NULL, '2018-11-24 09:02:44', '2018-11-24 09:02:44'),
(47, NULL, NULL, 'Hai', 'Xóa', 'xoa@xoa10.com', NULL, '$2y$10$Dvf10ihVMi9PbkvTvAIfMucvwuZ7F.QV0h9YX8jgvF/tQRhqBp.7K', NULL, 4, 1, 0, 0, 1, 1, 'aff0a6a4521232970b2c1cf539ad0a19', NULL, NULL, NULL, '2018-11-24 09:03:36', '2018-11-24 09:03:36'),
(48, NULL, NULL, 'Ba', 'Xóa', 'xoa@xoa3.com', NULL, '$2y$10$Mz3lXozZ6qV0bvGuVxpxm.eIAeLjdAoU4qVNfmlD0ZegWc9YUTvne', NULL, 1, 1, 0, 0, 1, 1, '86b122d4358357d834a87ce618a55de0', NULL, NULL, NULL, '2018-11-24 09:04:05', '2018-11-24 09:04:05');

-- --------------------------------------------------------

--
-- Table structure for table `user_groups`
--

CREATE TABLE `user_groups` (
  `id` int(11) UNSIGNED NOT NULL,
  `group_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `is_deletable` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user_groups`
--

INSERT INTO `user_groups` (`id`, `group_name`, `status`, `is_deletable`) VALUES
(1, 'Thành viên', 1, 0),
(2, 'Khách hàng', 1, 0),
(4, 'Kế toán', 1, 0),
(7, 'Kinh doanh', 1, 0),
(8, 'Lập trình', 1, 0),
(11, 'Tên nhóm mới', 1, 1),
(12, 'Nhóm có thể xóa được', 1, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `news_categories`
--
ALTER TABLE `news_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_groups`
--
ALTER TABLE `user_groups`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `news_categories`
--
ALTER TABLE `news_categories`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `user_groups`
--
ALTER TABLE `user_groups`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;