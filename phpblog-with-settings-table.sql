-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 15, 2019 at 01:12 PM
-- Server version: 10.3.15-MariaDB
-- PHP Version: 7.1.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `phpblog`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp(),
  `updated` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `title`, `description`, `slug`, `created`, `updated`) VALUES
(1, 'Category 1 Updated', 'Category 1 Description Updated', 'category-1-update', '2019-07-10 16:08:13', '2019-07-10 18:24:54'),
(2, 'Category 2', 'Category 2 Description', 'category-2', '2019-07-10 16:10:00', '2019-07-10 16:10:00');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `pid` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `website` varchar(255) NOT NULL,
  `message` varchar(255) NOT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp(),
  `updated` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `status` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `pic` varchar(255) NOT NULL,
  `page_order` varchar(255) NOT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp(),
  `updated` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `uid`, `title`, `content`, `status`, `slug`, `pic`, `page_order`, `created`, `updated`) VALUES
(1, 1, 'test update 1', 'test update', 'draft', 'test-update-1', '', '1', '2019-07-13 11:59:25', '2019-07-13 13:21:13'),
(3, 1, 'test', 'test', 'draft', 'test', 'media/1563101485maxresdefault.jpg', '1', '2019-07-14 16:14:10', '2019-07-14 16:21:25');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `status` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `pic` varchar(255) NOT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp(),
  `updated` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `uid`, `title`, `content`, `status`, `slug`, `pic`, `created`, `updated`) VALUES
(1, 1, 'test update', 'testupdate', 'published', 'test-update', '', '2019-07-10 22:27:43', '2019-07-14 22:03:17'),
(11, 1, 'test 1', 'test 1', 'review', 'test 1', 'media/1563121640maxresdefault.jpg', '2019-07-14 15:31:06', '2019-07-14 22:03:00');

-- --------------------------------------------------------

--
-- Table structure for table `post_categories`
--

CREATE TABLE `post_categories` (
  `id` int(11) NOT NULL,
  `pid` int(11) NOT NULL,
  `cid` int(11) NOT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp(),
  `updated` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `post_categories`
--

INSERT INTO `post_categories` (`id`, `pid`, `cid`, `created`, `updated`) VALUES
(1, 1, 2, '2019-07-10 22:27:43', '2019-07-10 22:27:43'),
(2, 1, 3, '2019-07-10 22:27:43', '2019-07-10 22:27:43'),
(24, 11, 1, '2019-07-14 22:03:00', '2019-07-14 22:03:00'),
(25, 11, 2, '2019-07-14 22:03:00', '2019-07-14 22:03:00'),
(26, 1, 1, '2019-07-14 22:03:17', '2019-07-14 22:03:17');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `value` varchar(255) NOT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp(),
  `updated` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `name`, `value`, `created`, `updated`) VALUES
(1, 'sitetitle', 'Blog', '2019-07-15 16:37:09', '2019-07-15 16:37:09'),
(2, 'tagline', 'PHP Blog', '2019-07-15 16:37:09', '2019-07-15 16:37:09'),
(3, 'email', 'vivek@codingcyber.com', '2019-07-15 16:37:34', '2019-07-15 16:37:34'),
(4, 'userreg', 'yes', '2019-07-15 16:37:34', '2019-07-15 16:37:34'),
(5, 'resultsperpage', '10', '2019-07-15 16:38:02', '2019-07-15 16:38:02'),
(6, 'comments', 'yes', '2019-07-15 16:38:02', '2019-07-15 16:38:02'),
(7, 'cleanurls', 'yes', '2019-07-15 16:38:17', '2019-07-15 16:38:17');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp(),
  `updated` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fname`, `lname`, `username`, `email`, `password`, `role`, `created`, `updated`) VALUES
(1, '', '', 'vivek', 'vivek@codingcyber.com', '$2y$10$ed1tQ.CFuPyNMqPSqb.aNu/TTtEqqhMEvVejV2tyVD5sRu8a82T8O', '', '2019-07-10 14:51:41', '2019-07-10 14:51:41'),
(2, 'Vivek', 'V', 'vivekv', 'vivek@pixelw3.com', '$2y$10$ZV..tDoP7Kg9W/THYFenMeMa3sROL7Mb0t438N3WrEEpzdUED6oMS', 'administrator', '2019-07-13 15:48:14', '2019-07-14 21:18:07');

-- --------------------------------------------------------

--
-- Table structure for table `widget`
--

CREATE TABLE `widget` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `widget_order` varchar(255) NOT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp(),
  `updated` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `widget`
--

INSERT INTO `widget` (`id`, `title`, `type`, `content`, `widget_order`, `created`, `updated`) VALUES
(2, 'HTML Widget', 'html', 'HTML Widget Content', '1', '2019-07-13 17:57:41', '2019-07-13 18:44:47'),
(3, 'Search', 'search', 'Search', '1', '2019-07-14 13:42:06', '2019-07-14 13:42:06'),
(4, 'Categories', 'categories', 'Categories', '1', '2019-07-14 13:42:51', '2019-07-14 13:42:51'),
(5, 'New HTML Widget', 'html', 'New HTML Widget\r\n<strong>Strong Text</strong>', '2', '2019-07-14 13:46:17', '2019-07-14 13:46:17'),
(6, 'Recent Articles', 'articles', 'Recent Articles', '1', '2019-07-14 13:46:41', '2019-07-14 13:46:41'),
(7, 'Pages', 'pages', 'Pages', '5', '2019-07-14 13:51:12', '2019-07-14 21:02:58');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `post_categories`
--
ALTER TABLE `post_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `widget`
--
ALTER TABLE `widget`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `post_categories`
--
ALTER TABLE `post_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `widget`
--
ALTER TABLE `widget`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
