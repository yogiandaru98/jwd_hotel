-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 26, 2023 at 01:48 AM
-- Server version: 8.0.30
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hotel_jwd`
--

-- --------------------------------------------------------

--
-- Table structure for table `class`
--

CREATE TABLE `class` (
  `id` int NOT NULL,
  `name` varchar(50) NOT NULL,
  `price` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `class`
--

INSERT INTO `class` (`id`, `name`, `price`) VALUES
(1, 'standar', 500000),
(2, 'deluxe', 1000000),
(3, 'executif', 1500000);

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE `order` (
  `id` int NOT NULL,
  `id_class` int NOT NULL,
  `name` varchar(50) NOT NULL,
  `gender` enum('pria','wanita') NOT NULL,
  `num_identity` char(16) NOT NULL,
  `order_date` date NOT NULL,
  `duration` int NOT NULL,
  `breakfast` enum('Ya','Tidak') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT 'Tidak',
  `total_price` bigint NOT NULL,
  `discount` float NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `order`
--

INSERT INTO `order` (`id`, `id_class`, `name`, `gender`, `num_identity`, `order_date`, `duration`, `breakfast`, `total_price`, `discount`) VALUES
(4, 3, 'udin aja', 'pria', '1111111111111114', '2023-08-28', 4, 'Ya', 5720000, 0.1),
(5, 3, 'YOGI ANDARU', 'pria', '1111111111111123', '2023-08-30', 2, 'Tidak', 3000000, 0);

-- --------------------------------------------------------

--
-- Table structure for table `rooms_gallery`
--

CREATE TABLE `rooms_gallery` (
  `id` int NOT NULL,
  `id_class` int NOT NULL,
  `file` varchar(255) NOT NULL,
  `type` enum('image','video') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `rooms_gallery`
--

INSERT INTO `rooms_gallery` (`id`, `id_class`, `file`, `type`) VALUES
(1, 1, 'https://www.kokoonhotelsvillas.com/surabaya/wp-content/uploads/sites/2/2020/01/standard-room.jpg', 'image'),
(2, 2, 'https://backend.parador-hotels.com/wp-content/uploads/2023/04/Deluxe-Room-Artinya-1024x512.jpg', 'image'),
(3, 3, 'https://d2e5ushqwiltxm.cloudfront.net/wp-content/uploads/sites/12/2016/02/09120423/Pullman-Executive-Room-King-Bed-1.jpg', 'image'),
(4, 1, 'https://www.youtube.com/embed/VmAn32gKhF0', 'video'),
(5, 3, 'https://www.youtube.com/embed/Cm05NBgtOso', 'video'),
(6, 2, 'https://www.youtube.com/embed/7KRw0nq6TaE', 'video'),
(7, 1, 'https://assets-global.website-files.com/5c6d6c45eaa55f57c6367749/624b471bdf247131f10ea14f_61d31b8dbff9b500cbd7ed32_types_of_rooms_in_a_5-star_hotel_2_optimized_optimized.jpeg', 'image');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `class`
--
ALTER TABLE `class`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_class_order` (`id_class`);

--
-- Indexes for table `rooms_gallery`
--
ALTER TABLE `rooms_gallery`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_class` (`id_class`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `class`
--
ALTER TABLE `class`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `order`
--
ALTER TABLE `order`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `rooms_gallery`
--
ALTER TABLE `rooms_gallery`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `order`
--
ALTER TABLE `order`
  ADD CONSTRAINT `FK_class_order` FOREIGN KEY (`id_class`) REFERENCES `class` (`id`);

--
-- Constraints for table `rooms_gallery`
--
ALTER TABLE `rooms_gallery`
  ADD CONSTRAINT `FK_class` FOREIGN KEY (`id_class`) REFERENCES `class` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
