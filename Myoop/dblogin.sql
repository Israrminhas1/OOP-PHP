-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 30, 2022 at 11:48 AM
-- Server version: 5.7.33
-- PHP Version: 7.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dblogin`
--

-- --------------------------------------------------------

--
-- Table structure for table `blog`
--

CREATE TABLE `blog` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `main_image` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `userid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `blog`
--

INSERT INTO `blog` (`id`, `title`, `main_image`, `description`, `userid`) VALUES
(3, 'Fithub international', '125496912_156939736152599_4716462097492320785_o.jpg', '<h3><strong>manufacturer and Supplier of all sports item</strong></h3>\r\n<p>nThis is descriptionThis is descriptionThis is descriptionThis is descriptionThis is descriptionThis is descriptionThis is descriptionThis is descriptionThis is descriptionThis is descriptionThis is descriptionThis is descriptionThis is descriptionThis is descriptionThis is descriptionThis is descriptionThis is descriptionThis is descriptionThis is descriptionThis is descriptionThis is descriptionThis is descriptionThis is descriptionThis is descriptionThis is descriptionThis is descriptionThis is descriptionThis is descriptionThis is descriptionThis is descriptionThis is descriptionThis is descriptionThis is descriptionThis is descriptionThis is descriptionThis is descriptionThis is descriptionThis is descriptionThis is descriptionThis is descriptionThis is descriptionThis is descriptionThis is descriptionThis is descriptionThis is descriptionThis is descriptionThis is descriptionThis is description</p>\r\n<table style=\"border-collapse: collapse; width: 49.8297%; height: 89.5624px;\" border=\"1\"><colgroup><col style=\"width: 33.2955%;\"><col style=\"width: 33.2955%;\"><col style=\"width: 33.2955%;\"></colgroup>\r\n<tbody>\r\n<tr style=\"height: 22.3906px;\">\r\n<td style=\"height: 22.3906px;\">id</td>\r\n<td style=\"height: 22.3906px;\">NAME</td>\r\n<td style=\"height: 22.3906px;\">PRICE</td>\r\n</tr>\r\n<tr style=\"height: 22.3906px;\">\r\n<td style=\"height: 22.3906px;\">1</td>\r\n<td style=\"height: 22.3906px;\">ABC</td>\r\n<td style=\"height: 22.3906px;\">$100</td>\r\n</tr>\r\n<tr style=\"height: 22.3906px;\">\r\n<td style=\"height: 22.3906px;\">2</td>\r\n<td style=\"height: 22.3906px;\">ASE</td>\r\n<td style=\"height: 22.3906px;\">$200</td>\r\n</tr>\r\n<tr style=\"height: 22.3906px;\">\r\n<td style=\"height: 22.3906px;\">3</td>\r\n<td style=\"height: 22.3906px;\">SCS</td>\r\n<td style=\"height: 22.3906px;\">$230</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<p><br>scriptionThis is descriptionThis is descriptionThis is descriptionThis is descriptionThis is descriptionThis is descriptionThis is descriptionThis is descriptionThis is descriptionThis is description</p>\r\n<p><strong><img src=\"../uploads/blue.jpg\" alt=\"\" width=\"187\" height=\"124\"></strong></p>\r\n<hr>\r\n<p>2022-06-22</p>', 15),
(4, 'asad blog', 'Grappling Gloves Ltr 2.jpg', '<p>Welcome to TinyMCE!</p>', 20),
(6, '2ndblog', '199834299_1174465566298908_3409242876312604091_n.jpg', '<p>Welcome to TinyMCE!</p>', 15);

-- --------------------------------------------------------

--
-- Table structure for table `permission`
--

CREATE TABLE `permission` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `permissions` json NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `permission`
--

INSERT INTO `permission` (`id`, `userid`, `permissions`) VALUES
(3, 15, '{\"EditBlog\": \"0\", \"CreateBlog\": \"0\", \"DeleteBlog\": \"0\"}'),
(5, 20, '{\"EditBlog\": \"1\", \"CreateBlog\": \"1\", \"DeleteBlog\": \"1\"}');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `verification_code` varchar(255) NOT NULL,
  `active` int(100) NOT NULL DEFAULT '0',
  `image` varchar(255) NOT NULL DEFAULT '123.png',
  `role` varchar(100) NOT NULL DEFAULT 'u'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `phone`, `email`, `password`, `verification_code`, `active`, `image`, `role`) VALUES
(1, 'Israr Minhas', '92311770233', 'israrminhas99@gmail.com', '$2y$10$9vYYNVFYslqFeTjN72EU8uHHuOfan8z61UGaQoHuu3Rbu/CwIzCAO', '661d6d163af0e2e397f0ef0536d8615e', 1, 'israr.jpg', 'a'),
(15, 'Cruv down', '2312312312', 'cruvdown11@gmail.com', '$2y$10$xAf57Ga/mMZsSoraHPb.zefKMZCgXL6Iml07KRm3Cg881t3uA4oDC', '24c755f9adb89ac3e0db9bce0b897da7', 1, '123.png', 'u'),
(20, 'Asad ali', '123123123', 'asad123@gmail.com', '$2y$10$L8aCRjv0rwJSmZwzDp.a4O/QvtyQC5L0l8cPqHK8FBOWR5WRWPdtm', '54b8b692edcafbcba7442b74077b4fee', 1, '123.png', 'u');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `blog`
--
ALTER TABLE `blog`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userid` (`userid`);

--
-- Indexes for table `permission`
--
ALTER TABLE `permission`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userid` (`userid`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `blog`
--
ALTER TABLE `blog`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `permission`
--
ALTER TABLE `permission`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `blog`
--
ALTER TABLE `blog`
  ADD CONSTRAINT `blog_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `permission`
--
ALTER TABLE `permission`
  ADD CONSTRAINT `permission_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
