-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th6 12, 2024 lúc 06:43 PM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `travel_blog`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `articles`
--

CREATE TABLE `articles` (
  `article_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `content` varchar(500) NOT NULL,
  `cate_id` int(11) NOT NULL,
  `create_at` datetime NOT NULL,
  `image` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `articles`
--

INSERT INTO `articles` (`article_id`, `user_id`, `title`, `content`, `cate_id`, `create_at`, `image`) VALUES
(14, 2, 'Tips and tricks to plan your next adventure.', 'To make the most out of your travel experience, take some time to research your destination before you go. Learn about the local customs, traditions, and etiquette to show respect and avoid unintentional cultural mistakes. Familiarize yourself with the local transportation system, so you can easily navigate your way around. Research the must-see attractions, but also look for hidden gems and off-the-beaten-path spots that are less crowded and offer a more authentic experience. Find out about loc', 7, '2024-06-06 07:44:00', '../uploads/journals-5.jpg'),
(15, 3, 'The Importance of Planning Ahead', 'When it comes to travel, planning ahead is crucial. It allows you to make the most of your time and ensures a smooth and stress-free journey.  This is why I ALWAYS recommend starting with a travel agent (shameless plug) to see how they can be of assistance.  They, or you if you decide to go it alone, should start by creating a detailed itinerary that includes all the places you want to visit, activities you want to do, and any special events or festivals happening during your trip. ', 8, '2024-06-12 14:49:00', '../uploads/journals-6.jpg'),
(17, 4, 'Capturing Memories Through Photography', 'To make the most out of your travel experience, take some time to research your destination before you go. Learn about the local customs, traditions, and etiquette to show respect and avoid unintentional cultural mistakes. Familiarize yourself with the local transportation system, so you can easily navigate your way around. Research the must-see attractions, but also look for hidden gems and off-the-beaten-path spots that are less crowded and offer a more authentic experience. Find out about loc', 6, '2024-05-30 17:52:00', '../uploads/journals-2.jpg'),
(20, 2, 'Staying Organized with Travel Documents', 'Traveling requires a lot of documents, from passports and visas to boarding passes and hotel reservations. To stay organized and avoid any last-minute panics, create a digital and physical backup of all your important travel documents. ', 7, '2024-05-30 03:17:00', '../uploads/journals-2.jpg'),
(21, 4, 'Making the Most of Your Transportation Options', 'When booking flights, compare prices from different airlines and be flexible with your travel dates to find the best deals. Consider using budget airlines or booking a flight with a layover to save money. If you’re traveling by train, look into rail passes or discounted tickets for multiple journeys.', 8, '2024-06-06 18:21:00', '../uploads/about.jpg'),
(22, 4, 'Exploring Local Cuisine and Culture', 'One of the best ways to immerse yourself in a new destination is through its cuisine and culture. Food can be a gateway to understanding the local traditions and way of life. Be adventurous and try local dishes that you may not have heard of before. Visit local markets or food stalls to get a taste of authentic street food.', 7, '0000-00-00 00:00:00', '../uploads/journals-4.jpg');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `categories`
--

CREATE TABLE `categories` (
  `cate_id` int(11) NOT NULL,
  `cate_name` varchar(20) NOT NULL,
  `description` varchar(200) NOT NULL,
  `image` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `categories`
--

INSERT INTO `categories` (`cate_id`, `cate_name`, `description`, `image`) VALUES
(6, 'Food Traveling', 'Food travel bloggers often write about local restaurants, street food experiences, and unique food experiences.', '../uploads/food-cate.jpg'),
(7, 'Adventure Traveling', 'Adventure travel bloggers often write about hiking, camping, rock climbing, and other outdoor activities.', '../uploads/adventure-cate.jpg'),
(8, 'Cultural Traveling', 'Cultural travel bloggers often write about history, art, architecture, and other aspects of local cultures.', '../uploads/discover-3.jpg');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `comments`
--

CREATE TABLE `comments` (
  `cmt_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `article_id` int(11) NOT NULL,
  `comment` varchar(300) NOT NULL,
  `create_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `comments`
--

INSERT INTO `comments` (`cmt_id`, `user_id`, `article_id`, `comment`, `create_at`) VALUES
(8, 4, 15, 'Life is either a daring adventure or nothing at all.', '2024-06-12 17:41:05'),
(10, 2, 17, 'To Travel is to Live.', '2024-06-12 22:49:00'),
(11, 4, 17, 'Blessed are the curious for they shall have adventures.', '2024-06-12 23:09:00');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `yob` int(4) NOT NULL,
  `city` varchar(50) NOT NULL,
  `role` varchar(10) NOT NULL,
  `image` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `name`, `email`, `phone`, `yob`, `city`, `role`, `image`) VALUES
(2, 'huong6523', '12345678', 'Huong', 'daohuong6523@gmail.com', '0399798515', 2003, 'Ha Noi', '', '../author-6.jpg'),
(3, 'admin', '12345678', 'admin', 'admin@gmail.com', '0399798515', 2003, 'Ha Noi', 'admin', '../uploadsblog-3.jpg'),
(4, 'huongdao65', '12345678', '', 'daohuong6523@gmail.com', '0326058223', 2003, 'Hà Nội', '', '../uploadsblog-4.jpg');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`article_id`),
  ADD KEY `dhsgf` (`user_id`),
  ADD KEY `dsfhsj` (`cate_id`);

--
-- Chỉ mục cho bảng `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`cate_id`);

--
-- Chỉ mục cho bảng `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`cmt_id`),
  ADD KEY `foreign key` (`article_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `articles`
--
ALTER TABLE `articles`
  MODIFY `article_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT cho bảng `categories`
--
ALTER TABLE `categories`
  MODIFY `cate_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT cho bảng `comments`
--
ALTER TABLE `comments`
  MODIFY `cmt_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `articles`
--
ALTER TABLE `articles`
  ADD CONSTRAINT `dhsgf` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `dsfhsj` FOREIGN KEY (`cate_id`) REFERENCES `categories` (`cate_id`);

--
-- Các ràng buộc cho bảng `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `foreign key` FOREIGN KEY (`article_id`) REFERENCES `articles` (`article_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
