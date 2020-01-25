-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 25, 2020 at 08:47 AM
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
(1, 'HTML', 'HTML', 'html', '2019-07-19 22:52:00', '2019-07-19 22:52:00'),
(2, 'CSS', 'CSS', 'css', '2019-07-19 22:52:09', '2019-07-19 22:52:09'),
(3, 'PHP', 'PHP', 'php', '2019-07-19 22:52:17', '2019-07-19 22:52:17'),
(4, 'SQL', 'SQL', 'sql', '2019-07-19 22:52:23', '2019-07-21 12:47:06'),
(5, 'CodeIgniter', 'CodeIgniter', 'codeigniter', '2019-07-19 22:52:31', '2019-07-21 13:43:32'),
(6, 'Laravel', 'Laravel', 'laravel', '2019-07-19 22:52:38', '2019-07-19 22:52:38');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `pid` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `comment` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp(),
  `updated` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `pid`, `uid`, `comment`, `status`, `created`, `updated`) VALUES
(1, 6, 4, 'test', 'approved', '2019-07-21 13:36:26', '2019-07-21 13:38:16'),
(2, 6, 4, 'test comment', 'approved', '2019-07-21 13:36:35', '2019-07-21 13:38:17'),
(3, 6, 2, 'comment by editor', 'approved', '2019-07-21 13:37:28', '2019-07-21 13:38:14'),
(4, 6, 1, 'Comment by Admin', 'approved', '2019-07-21 13:38:38', '2019-07-21 13:38:45'),
(5, 6, 4, 'New Comment by Subscriber', 'approved', '2020-01-02 16:28:07', '2020-01-02 16:31:10');

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
(1, 1, 'About', '<p><span style=\"font-family: \'Open Sans\', Arial, sans-serif; font-size: 14px; text-align: justify; background-color: #ffffff;\">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse eleifend tortor sed ante lacinia, a laoreet nibh dictum. Vivamus vel metus tellus. Vestibulum sit amet purus id tortor interdum egestas. Nullam nec quam et neque dapibus consequat vel nec massa. Aenean mollis condimentum massa, id auctor nibh imperdiet in. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Aenean posuere, risus vel semper posuere, nibh nibh tempor urna, ac vestibulum elit sem in elit. Nulla sed congue urna. Nulla in felis sit amet nisi bibendum lobortis. Vivamus cursus, odio nec tempus fringilla, nisi urna efficitur felis, fringilla feugiat diam sapien eu orci. Fusce maximus suscipit neque, sit amet lacinia nulla mattis in.</span></p>', 'published', 'about', 'media/1563693461maxresdefault.jpg', '1', '2019-07-21 12:47:41', '2019-07-21 13:25:03');

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
(1, 1, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit', '<p style=\"margin: 0px 0px 15px; padding: 0px; text-align: justify; font-family: \'Open Sans\', Arial, sans-serif; font-size: 14px; background-color: #ffffff;\"><strong>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras ac nunc nibh. Nulla nec quam neque. Sed massa lacus, eleifend vitae sapien eget, consequat facilisis nisi. Donec cursus metus a leo lacinia, quis lacinia dolor facilisis. Praesent volutpat mollis vulputate. Nullam pellentesque in erat et sodales</strong>. <em>Integer viverra enim ex, vel molestie diam condimentum ut. Nulla tincidunt mollis condimentum. Aenean quis elit mattis, scelerisque nibh id, molestie sapien. Duis quis nibh ut nibh ultrices dapibus sit amet id orci. Nam eleifend vel lacus eu lobortis.</em></p>\r\n<p style=\"margin: 0px 0px 15px; padding: 0px; text-align: justify; font-family: \'Open Sans\', Arial, sans-serif; font-size: 14px; background-color: #ffffff;\"><span style=\"text-decoration: underline;\">Nullam sit amet nulla consectetur, imperdiet dolor sed, ornare augue. Fusce diam mi, malesuada sit amet lacus vel, pharetra mollis metus. Vestibulum efficitur feugiat sapien sed volutpat. Ut auctor venenatis ligula. Pellentesque a nulla urna. Ut nibh dolor, vehicula quis enim nec, accumsan tristique ex. Fusce vel felis nec nulla viverra tincidunt. Donec efficitur at nisi quis faucibus. Vestibulum at magna justo. Sed et convallis purus.</span></p>\r\n<p style=\"margin: 0px 0px 15px; padding: 0px; text-align: justify; font-family: \'Open Sans\', Arial, sans-serif; font-size: 14px; background-color: #ffffff;\"><span style=\"text-decoration: line-through;\">Nulla urna lacus, faucibus quis mi sed, tincidunt aliquam metus. Proin auctor et elit quis venenatis. Pellentesque pretium pulvinar leo. Phasellus vel diam dapibus, iaculis turpis sed, vestibulum lorem. Morbi vel venenatis nunc. Sed id dui id tellus tempus commodo. Aliquam interdum turpis metus, vitae lobortis mi feugiat at. Etiam feugiat nulla rhoncus dignissim bibendum. Duis consectetur velit non ligula bibendum ultrices.</span></p>\r\n<p style=\"margin: 0px 0px 15px; padding: 0px; text-align: justify; font-family: \'Open Sans\', Arial, sans-serif; font-size: 14px; background-color: #ffffff;\"><span style=\"color: #2880b9;\">Nunc porttitor mollis justo id gravida. Phasellus ornare augue in libero dignissim, id condimentum orci dapibus. Donec hendrerit tellus nisi, quis aliquam lacus congue hendrerit. Quisque facilisis suscipit erat, faucibus dictum ex sagittis id. Morbi convallis nulla in pharetra aliquam. Sed at elementum lorem, ut lacinia orci. Nam et eros vitae odio tempor euismod ac eu nunc. Pellentesque pellentesque mauris blandit odio cursus, ac egestas quam feugiat. Quisque scelerisque leo non nibh gravida imperdiet. Cras mollis, ligula eu vestibulum commodo, tortor lectus vestibulum justo, eget dapibus libero ante vitae risus. Curabitur sed consectetur neque, quis porta sapien. Phasellus lobortis tellus erat, ut ornare odio laoreet et. Fusce ut tincidunt lacus. Sed blandit cursus metus.</span></p>\r\n<p style=\"margin: 0px 0px 15px; padding: 0px; text-align: justify; font-family: \'Open Sans\', Arial, sans-serif; font-size: 14px; background-color: #ffffff;\"><span style=\"background-color: #f1c40f;\">Etiam at leo quis turpis semper vulputate sed non mi. Sed sed odio diam. In quis massa dictum sem mattis pellentesque vel et est. Pellentesque dictum quis felis vel molestie. In facilisis vehicula sapien scelerisque semper. Curabitur sit amet nisl nec lectus pellentesque luctus ac nec mi. Mauris hendrerit sed ex sed varius. Phasellus rutrum, nibh et dictum maximus, metus magna hendrerit ex, facilisis fringilla ipsum ex non leo. Maecenas vestibulum bibendum lectus, nec dignissim ex congue luctus.</span></p>', 'published', 'lorem-ipsum-dolor-sit-amet-consectetur-adipiscing-elit', 'media/1563557081maxresdefault.jpg', '2019-07-19 22:54:41', '2019-07-21 12:44:10'),
(2, 1, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean ut nunc', '<p style=\"margin: 0px 0px 15px; padding: 0px; text-align: justify; font-family: \'Open Sans\', Arial, sans-serif; font-size: 14px; background-color: #ffffff;\"><span style=\"color: #e74c3c;\">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean ut nunc bibendum, porta eros ac, ultricies sem. Suspendisse pharetra fermentum enim, quis venenatis sem. Curabitur lobortis iaculis nibh sit amet tempus. Pellentesque ultrices erat imperdiet, tincidunt elit sed, mattis metus. Duis vitae mauris cursus purus feugiat tempus non id urna. Maecenas eros libero, varius et nisi ac, fermentum hendrerit purus. Ut tellus nibh, dapibus quis massa nec, semper dapibus metus. Morbi imperdiet vehicula nunc, quis luctus velit semper vel.</span></p>\r\n<p style=\"margin: 0px 0px 15px; padding: 0px; text-align: justify; font-family: \'Open Sans\', Arial, sans-serif; font-size: 14px; background-color: #ffffff;\"><span style=\"background-color: #2880b9;\">Morbi varius sed nunc in elementum. In venenatis, eros vitae imperdiet interdum, dolor nibh pellentesque diam, ut volutpat tortor tellus ut justo. Etiam mollis sed leo vitae ultricies. In maximus tellus at rutrum accumsan. Nullam ac elementum felis. Nulla congue, ante ac dictum porta, orci arcu efficitur quam, non fermentum metus ligula eu orci. Duis volutpat malesuada metus id malesuada. Pellentesque enim tellus, dapibus at ultrices pulvinar, laoreet sed diam. Proin sem odio, lacinia a nulla nec, pellentesque maximus sapien. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Nullam vel nisi sed dui pretium cursus. Sed quis eros suscipit, suscipit neque vitae, interdum quam. Sed et neque magna. Pellentesque imperdiet risus at tristique faucibus. Cras in ultrices ipsum.</span></p>\r\n<p style=\"margin: 0px 0px 15px; padding: 0px; text-align: justify; font-family: \'Open Sans\', Arial, sans-serif; font-size: 14px; background-color: #ffffff;\"><span style=\"background-color: #27ae60;\">Praesent ac turpis nibh. Curabitur nec nibh neque. Vestibulum lobortis sem quam, sed tincidunt diam facilisis nec. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Pellentesque ultrices convallis sapien, quis euismod massa consequat quis. Mauris at tristique est, vel ultricies enim. Donec vel pellentesque lacus. In finibus lobortis lorem, ac dignissim neque suscipit nec. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Quisque nec libero quis odio dictum pulvinar ac vitae ipsum.</span></p>', 'published', 'lorem-ipsum-dolor-sit-amet-consectetur-adipiscing-elit-aenean-ut-nunc', 'media/1563557337maxresdefault.jpg', '2019-07-19 22:58:57', '2019-07-21 12:34:47'),
(3, 1, 'aliquet hendrerit. Ut laoreet in nisi eget varius', '<p style=\"margin: 0px 0px 15px; padding: 0px; font-family: \'Open Sans\', Arial, sans-serif; font-size: 14px; background-color: #ffffff; text-align: center;\">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed eleifend eros purus, nec semper neque lacinia at. Maecenas vestibulum aliquet hendrerit. Ut laoreet in nisi eget varius. Morbi fermentum porta erat, in commodo quam vestibulum sit amet. Nunc nisl arcu, venenatis vitae sem eu, accumsan iaculis odio. Proin viverra vehicula vestibulum. Donec tincidunt magna et velit lacinia, a venenatis urna rutrum. Donec ultricies mauris quam, non volutpat turpis cursus mollis. Mauris semper consequat mauris, vel dapibus felis euismod non. Sed ultricies, lacus a elementum varius, mauris tellus euismod massa, non bibendum purus orci non massa. Integer quis sollicitudin libero. Integer suscipit eget ex sed venenatis. Integer vel nulla ac risus rutrum porttitor.</p>\r\n<p style=\"margin: 0px 0px 15px; padding: 0px; text-align: justify; font-family: \'Open Sans\', Arial, sans-serif; font-size: 14px; background-color: #ffffff;\"><span style=\"font-size: 14pt;\">Etiam sit amet bibendum tortor. Aenean turpis ex, fringilla eu justo vitae, fringilla molestie nunc. Nam efficitur vitae dui id iaculis. Interdum et malesuada fames ac ante ipsum primis in faucibus. In metus ligula, tristique ac metus vel, ullamcorper vulputate diam. Aliquam at ante ut sapien dapibus vestibulum vitae sed orci. Maecenas et varius mi. Nulla facilisi.</span></p>', 'published', 'aliquet-hendrerit-ut-laoreet-in-nisi-eget-varius', 'media/1563557498maxresdefault.jpg', '2019-07-19 23:01:38', '2019-07-19 23:01:38'),
(4, 1, 'Lorem ipsum dolor sit amet', '<ul style=\"margin: 0px; padding: 0px; font-family: \'Open Sans\', Arial, sans-serif; font-size: 14px; text-align: justify; background-color: #ffffff;\">\r\n<li style=\"margin: 0px; padding: 0px;\">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</li>\r\n<li style=\"margin: 0px; padding: 0px;\">Suspendisse dictum est at mauris elementum euismod.</li>\r\n<li style=\"margin: 0px; padding: 0px;\">Fusce in ligula at justo congue tincidunt.</li>\r\n<li style=\"margin: 0px; padding: 0px;\">Mauris sodales lorem quis nisi vestibulum faucibus at vitae odio.</li>\r\n<li style=\"margin: 0px; padding: 0px;\">Mauris vel mauris non leo molestie pretium sed at nulla.</li>\r\n</ul>\r\n<p style=\"margin: 0px 0px 15px; padding: 0px; text-align: justify; font-family: \'Open Sans\', Arial, sans-serif; font-size: 14px; background-color: #ffffff;\">&nbsp;</p>\r\n<p style=\"margin: 0px 0px 15px; padding: 0px; text-align: justify; font-family: \'Open Sans\', Arial, sans-serif; font-size: 14px; background-color: #ffffff;\">&nbsp;</p>\r\n<ul style=\"margin: 0px; padding: 0px; font-family: \'Open Sans\', Arial, sans-serif; font-size: 14px; text-align: justify; background-color: #ffffff;\">\r\n<li style=\"margin: 0px; padding: 0px;\">Sed eu turpis et urna rutrum luctus.</li>\r\n<li style=\"margin: 0px; padding: 0px;\">Mauris id magna sed nibh pharetra ultricies.</li>\r\n</ul>', 'published', 'lorem-ipsum-dolor-sit-amet', 'media/1563557608maxresdefault.jpg', '2019-07-19 23:03:28', '2019-07-19 23:03:28'),
(5, 1, 'consectetur adipiscing elit', '<div id=\"lipsum\" style=\"margin: 0px; padding: 0px; text-align: justify; font-family: \'Open Sans\', Arial, sans-serif; font-size: 14px; background-color: #ffffff;\">\r\n<p style=\"margin: 0px 0px 15px; padding: 0px;\">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed ac eleifend lorem. Praesent vel tempor nunc. In ultrices, purus nec tincidunt dapibus, mi urna euismod felis, pharetra porttitor ex quam quis lectus. Sed nec lacinia est. Sed tincidunt eget diam ac blandit. Nam viverra semper risus, eget congue turpis auctor at. Suspendisse fringilla nisl neque, ut ultricies ligula maximus non. In et tincidunt nulla. Aliquam aliquam mattis mauris, eget vehicula enim tristique ac. Mauris vitae nunc a tortor dignissim fermentum. Aenean tortor nulla, consectetur eu tempor eget, tincidunt in sem. Praesent aliquam, nulla sed placerat tincidunt, augue orci viverra dui, vitae scelerisque arcu tortor quis odio.</p>\r\n</div>', 'published', 'consectetur-adipiscing-elit', 'media/1563557664maxresdefault.jpg', '2019-07-19 23:04:24', '2019-07-19 23:04:24'),
(6, 1, 'Vestibulum ante ipsum primis in faucibus orci luctus', '<p style=\"margin: 0px 0px 15px; padding: 0px; text-align: justify; font-family: \'Open Sans\', Arial, sans-serif; font-size: 14px; background-color: #ffffff;\">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse eleifend tortor sed ante lacinia, a laoreet nibh dictum. Vivamus vel metus tellus. Vestibulum sit amet purus id tortor interdum egestas. Nullam nec quam et neque dapibus consequat vel nec massa. Aenean mollis condimentum massa, id auctor nibh imperdiet in. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Aenean posuere, risus vel semper posuere, nibh nibh tempor urna, ac vestibulum elit sem in elit. Nulla sed congue urna. Nulla in felis sit amet nisi bibendum lobortis. Vivamus cursus, odio nec tempus fringilla, nisi urna efficitur felis, fringilla feugiat diam sapien eu orci. Fusce maximus suscipit neque, sit amet lacinia nulla mattis in.</p>\r\n<p style=\"margin: 0px 0px 15px; padding: 0px; text-align: justify; font-family: \'Open Sans\', Arial, sans-serif; font-size: 14px; background-color: #ffffff;\">Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Pellentesque cursus tortor ipsum, eu dapibus nunc dignissim non. Aenean ac velit non justo pharetra rutrum eget ac orci. Nam tempor varius est. Phasellus hendrerit vehicula libero, eget malesuada nunc luctus eu. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed nec imperdiet enim. Nulla ornare, massa in aliquam sodales, eros tellus blandit mauris, quis varius turpis nunc ac nulla. Etiam faucibus fermentum tellus, vitae sollicitudin dolor malesuada euismod. Curabitur nisi erat, ullamcorper quis egestas at, ornare eget lacus. Pellentesque convallis, nunc sit amet dapibus vestibulum, est purus egestas tortor, a scelerisque lacus ipsum et urna. Nam diam lectus, tincidunt eu neque id, pulvinar venenatis lorem. Suspendisse interdum velit ac risus tincidunt, at pretium diam condimentum. Nunc neque nibh, eleifend scelerisque nisl non, ultrices bibendum massa. Praesent vel lectus orci.</p>', 'published', 'vestibulum-ante-ipsum-primis-in-faucibus-orci-luctus', 'media/1563557704maxresdefault.jpg', '2019-07-19 23:05:04', '2019-07-19 23:05:04'),
(8, 2, 'Article by Editor', '<p>Article by <strong>Editor</strong></p>', 'published', 'article-by-editor', 'media/1577962795maxresdefault.jpg', '2020-01-02 16:29:55', '2020-01-02 16:29:55');

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
(1, 1, 2, '2019-07-19 22:54:41', '2019-07-19 22:54:41'),
(2, 1, 3, '2019-07-19 22:54:41', '2019-07-19 22:54:41'),
(3, 2, 1, '2019-07-19 22:58:57', '2019-07-19 22:58:57'),
(4, 2, 4, '2019-07-19 22:58:57', '2019-07-19 22:58:57'),
(5, 2, 5, '2019-07-19 22:58:57', '2019-07-19 22:58:57'),
(6, 3, 5, '2019-07-19 23:01:38', '2019-07-19 23:01:38'),
(7, 3, 6, '2019-07-19 23:01:38', '2019-07-19 23:01:38'),
(8, 4, 1, '2019-07-19 23:03:28', '2019-07-19 23:03:28'),
(9, 4, 2, '2019-07-19 23:03:28', '2019-07-19 23:03:28'),
(10, 4, 3, '2019-07-19 23:03:28', '2019-07-19 23:03:28'),
(11, 4, 4, '2019-07-19 23:03:28', '2019-07-19 23:03:28'),
(12, 4, 5, '2019-07-19 23:03:28', '2019-07-19 23:03:28'),
(13, 4, 6, '2019-07-19 23:03:28', '2019-07-19 23:03:28'),
(14, 5, 1, '2019-07-19 23:04:24', '2019-07-19 23:04:24'),
(15, 5, 2, '2019-07-19 23:04:24', '2019-07-19 23:04:24'),
(16, 5, 3, '2019-07-19 23:04:24', '2019-07-19 23:04:24'),
(17, 5, 4, '2019-07-19 23:04:24', '2019-07-19 23:04:24'),
(18, 5, 5, '2019-07-19 23:04:24', '2019-07-19 23:04:24'),
(19, 5, 6, '2019-07-19 23:04:24', '2019-07-19 23:04:24'),
(20, 6, 1, '2019-07-19 23:05:04', '2019-07-19 23:05:04'),
(21, 6, 2, '2019-07-19 23:05:04', '2019-07-19 23:05:04'),
(22, 6, 3, '2019-07-19 23:05:04', '2019-07-19 23:05:04'),
(23, 6, 4, '2019-07-19 23:05:04', '2019-07-19 23:05:04'),
(24, 6, 5, '2019-07-19 23:05:04', '2019-07-19 23:05:04'),
(25, 6, 6, '2019-07-19 23:05:04', '2019-07-19 23:05:04'),
(26, 7, 2, '2019-07-21 12:24:34', '2019-07-21 12:24:34'),
(27, 8, 2, '2020-01-02 16:29:55', '2020-01-02 16:29:55'),
(28, 8, 3, '2020-01-02 16:29:55', '2020-01-02 16:29:55');

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
(1, 'sitetitle', 'Blog New', '2019-07-15 16:37:09', '2020-01-02 16:32:37'),
(2, 'tagline', 'PHP Blog New', '2019-07-15 16:37:09', '2020-01-02 16:32:37'),
(3, 'email', 'vivek@codingcyber.com', '2019-07-15 16:37:34', '2020-01-02 16:32:37'),
(4, 'userreg', 'yes', '2019-07-15 16:37:34', '2020-01-02 16:32:37'),
(5, 'resultsperpage', '4', '2019-07-15 16:38:02', '2020-01-02 16:32:37'),
(6, 'comments', 'yes', '2019-07-15 16:38:02', '2020-01-02 16:32:37'),
(7, 'cleanurls', 'yes', '2019-07-15 16:38:17', '2020-01-02 16:32:37');

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
(1, '', '', 'vivek', 'vivek@codingcyber.com', '$2y$10$ed1tQ.CFuPyNMqPSqb.aNu/TTtEqqhMEvVejV2tyVD5sRu8a82T8O', 'administrator', '2019-07-10 14:51:41', '2019-07-10 14:51:41'),
(2, 'Vivek', 'V', 'vivekv', 'vivek@pixelw3.com', '$2y$10$ZV..tDoP7Kg9W/THYFenMeMa3sROL7Mb0t438N3WrEEpzdUED6oMS', 'editor', '2019-07-13 15:48:14', '2019-07-16 19:15:21'),
(4, '', '', 'test', 'test@gmail.com', '$2y$10$XwPz2qdlMiVrw.tT0wX7b.DnxrqnhTtmNCSHQ3.51c5tZkXGXNUYa', 'subscriber', '2019-07-15 19:09:24', '2019-07-15 19:09:24'),
(5, 'Vivek', 'Vengala', 'admin', 'info@pixelw3.com', '$2y$10$v3jp62yVRlfc6p8lYm3hWu24wqQXCmjAQjAvG2Q1.BgrXp1RQ38lW', 'Administrator', '2019-07-21 13:40:39', '2019-07-21 13:40:39');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `post_categories`
--
ALTER TABLE `post_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `widget`
--
ALTER TABLE `widget`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
