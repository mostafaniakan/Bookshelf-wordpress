-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 08, 2023 at 06:03 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `wordpress`
--

-- --------------------------------------------------------

--
-- Table structure for table `wp_my_bookshelf`
--

CREATE TABLE `wp_my_bookshelf` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `author` varchar(255) NOT NULL,
  `genre` varchar(255) NOT NULL,
  `publication_year` date NOT NULL,
  `image` varchar(255) NOT NULL,
  `excerpt` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `wp_my_bookshelf`
--

INSERT INTO `wp_my_bookshelf` (`id`, `title`, `author`, `genre`, `publication_year`, `image`, `excerpt`, `user_id`) VALUES
(20, 'ملت عشق', 'الیف شافاک', 'عاشقانه', '2023-06-21', 'http://localhost/wordpress/wp-content/uploads/Bookshelf_uploads_dir/2023/07/melateshgh2723.jpg', 'ملت عشق کتابی است پرفروش در ترکیه و البته ایران. شاید پیش از منتشر شدن این کتاب در ایران و استقبال بی‌نظیر از آن کمتر کسی الیف شافاک نویسنده', 1),
(21, 'laravel', 'laravel', 'عاشقانه', '2018-06-28', 'http://localhost/wordpress/wp-content/uploads/Bookshelf_uploads_dir/2023/07/OReilly8064.jpg', 'sdafasdfasdf', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `wp_my_bookshelf`
--
ALTER TABLE `wp_my_bookshelf`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `wp_my_bookshelf`
--
ALTER TABLE `wp_my_bookshelf`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `wp_my_bookshelf`
--
ALTER TABLE `wp_my_bookshelf`
  ADD CONSTRAINT `wp_my_bookshelf_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `wp_users` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
