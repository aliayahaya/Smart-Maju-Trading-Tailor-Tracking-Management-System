-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 01, 2025 at 03:00 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tailortrack`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(3) UNSIGNED ZEROFILL NOT NULL,
  `admin_name` varchar(50) NOT NULL,
  `admin_phone` varchar(15) NOT NULL,
  `admin_email` varchar(30) NOT NULL,
  `user_id` int(3) UNSIGNED ZEROFILL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `admin_name`, `admin_phone`, `admin_email`, `user_id`) VALUES
(001, 'ALLYA MARISSA', '012345688', 'allyamarissa96@gmail.com', 001),
(003, 'AREESYA SURIANA', '0135846394', 'areesya02@gmail.com', NULL),
(005, 'HANIS AFIQAH', '0195668347', '2024793033@student.uitm.edu.my', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE `order` (
  `order_id` int(3) UNSIGNED ZEROFILL NOT NULL,
  `service_type` enum('Embroidery Services','Formal & Casual Wear Customization','Custom Garment Making','Alterations & Repairs','Fabric Sourcing') NOT NULL,
  `order_type` enum('Muslimah Clothes','Kids Clothes','Adult Long Sleeves','Adult Short Sleeves') NOT NULL,
  `size` varchar(10) NOT NULL,
  `order_date` date NOT NULL,
  `due_date` date NOT NULL,
  `quantity` int(100) NOT NULL,
  `notes` text NOT NULL,
  `status` enum('Processing','In Progress','Completed','Pick-Up') NOT NULL,
  `amount_paid` decimal(10,2) NOT NULL,
  `admin_id` int(3) UNSIGNED ZEROFILL DEFAULT NULL,
  `tailor_id` int(3) UNSIGNED ZEROFILL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order`
--

INSERT INTO `order` (`order_id`, `service_type`, `order_type`, `size`, `order_date`, `due_date`, `quantity`, `notes`, `status`, `amount_paid`, `admin_id`, `tailor_id`) VALUES
(002, 'Custom Garment Making', 'Muslimah Clothes', 'M', '2025-07-28', '2025-08-13', 2, 'allya marissa', 'Pick-Up', 50.00, NULL, 000),
(003, 'Formal & Casual Wear Customization', 'Adult Short Sleeves', 'L', '2025-07-29', '2025-08-29', 1, '', 'Pick-Up', 90.00, NULL, 000),
(004, 'Alterations & Repairs', 'Kids Clothes', '15-16 y/o', '2025-07-23', '2025-08-31', 1, 'ain', 'Pick-Up', 20.00, NULL, 000),
(005, 'Formal & Casual Wear Customization', 'Kids Clothes', '3-4 y/o', '2025-07-08', '2025-07-25', 2, 'make shorter', 'Pick-Up', 120.00, NULL, 000),
(006, 'Formal & Casual Wear Customization', 'Muslimah Clothes', 'XL', '2025-07-03', '2025-08-01', 1, 'add embroidery name', 'Pick-Up', 5.00, NULL, 000),
(008, 'Custom Garment Making', 'Adult Short Sleeves', 'L', '2025-06-30', '2025-08-30', 1, '', 'Pick-Up', 50.00, NULL, 000),
(009, 'Alterations & Repairs', 'Kids Clothes', '7-8', '2025-07-29', '2025-08-29', 3, '', 'Pick-Up', 20.00, NULL, 000),
(010, 'Formal & Casual Wear Customization', 'Adult Long Sleeves', 'L', '2025-08-26', '2025-07-29', 1, '', 'Pick-Up', 90.00, NULL, 000),
(011, 'Formal & Casual Wear Customization', 'Adult Short Sleeves', '2XL', '2025-07-29', '2025-09-01', 1, '', 'Pick-Up', 70.00, NULL, 000),
(012, 'Formal & Casual Wear Customization', 'Muslimah Clothes', 'S', '2025-07-30', '2025-09-04', 2, '', 'Pick-Up', 120.00, NULL, NULL),
(013, 'Embroidery Services', 'Adult Long Sleeves', 'L', '2025-07-09', '2025-10-30', 1, '', 'Pick-Up', 90.00, NULL, NULL),
(014, 'Fabric Sourcing', 'Kids Clothes', '13-14', '2025-07-10', '2025-07-30', 2, '', 'Pick-Up', 30.00, NULL, NULL),
(015, 'Alterations & Repairs', 'Adult Short Sleeves', 'M', '2025-07-16', '2025-08-21', 4, 'Make the shirt length shorter 1 inch', 'Completed', 0.00, NULL, NULL),
(016, 'Embroidery Services', 'Muslimah Clothes', 'M', '2025-07-10', '2025-07-19', 7, 'corak modern', 'Pick-Up', 60.00, NULL, NULL),
(017, 'Formal & Casual Wear Customization', 'Kids Clothes', '11-12', '2025-07-26', '2025-07-31', 5, '', 'Completed', 0.00, NULL, NULL),
(018, 'Embroidery Services', 'Muslimah Clothes', 'L', '2025-07-17', '2025-07-31', 3, '', 'Processing', 0.00, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `order_service`
--

CREATE TABLE `order_service` (
  `order_id` int(3) UNSIGNED ZEROFILL DEFAULT NULL,
  `service_id` int(3) UNSIGNED ZEROFILL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_size`
--

CREATE TABLE `order_size` (
  `order_id` int(3) UNSIGNED ZEROFILL DEFAULT NULL,
  `size_id` int(3) UNSIGNED ZEROFILL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `register`
--

CREATE TABLE `register` (
  `user_id` int(3) UNSIGNED ZEROFILL NOT NULL,
  `name` varchar(50) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `email` varchar(30) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `role` enum('admin','tailor','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `register`
--

INSERT INTO `register` (`user_id`, `name`, `phone`, `email`, `username`, `password`, `role`) VALUES
(001, 'ALLYA MARISSA', '012345688', 'allyamarissa96@gmail.com', 'allya', '12345', 'admin'),
(002, 'SYAZATUL AIN', '0122344354', 'Brsh3f@turniti.com', 'ain', '09876', 'tailor'),
(003, 'AREESYA SURIANA', '01234567889', '2024793033@student.uitm.edu.my', 'areesya', '112233', 'admin'),
(004, 'HANIS AFIQAH', '0195668347', '2024793033@student.uitm.edu.my', 'hanis', '010203', 'admin'),
(010, 'NURUL NAJWA', '0158408294', 'nurulnajwa@gmail.com', 'najwa', '11111', 'tailor');

-- --------------------------------------------------------

--
-- Table structure for table `service`
--

CREATE TABLE `service` (
  `service_id` int(3) UNSIGNED ZEROFILL NOT NULL,
  `service_name` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `size`
--

CREATE TABLE `size` (
  `size_id` int(3) UNSIGNED ZEROFILL NOT NULL,
  `size_type` enum('Muslimah Clothes','Kids Clothes','Adult Long Sleeve','Adult Short Sleeve') NOT NULL,
  `size_range` varchar(10) NOT NULL,
  `shirt_length` int(20) NOT NULL,
  `chest` int(20) NOT NULL,
  `shoulder_width` int(20) NOT NULL,
  `sleeve_length` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tailor`
--

CREATE TABLE `tailor` (
  `tailor_id` int(3) UNSIGNED ZEROFILL NOT NULL,
  `tailor_name` varchar(50) NOT NULL,
  `tailor_phone` varchar(15) NOT NULL,
  `tailor_email` varchar(30) NOT NULL,
  `user_id` int(3) UNSIGNED ZEROFILL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tailor`
--

INSERT INTO `tailor` (`tailor_id`, `tailor_name`, `tailor_phone`, `tailor_email`, `user_id`) VALUES
(002, 'SYAZATUL AIN', '0122344354', 'Brsh3f@turniti.com', 002),
(004, 'NURUL NAJWA', '0158408294', 'nurulnajwa@gmail.com', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `admin_id` (`admin_id`);

--
-- Indexes for table `order_service`
--
ALTER TABLE `order_service`
  ADD KEY `order_id` (`order_id`),
  ADD KEY `service_id` (`service_id`);

--
-- Indexes for table `order_size`
--
ALTER TABLE `order_size`
  ADD KEY `order_id` (`order_id`),
  ADD KEY `size_id` (`size_id`);

--
-- Indexes for table `register`
--
ALTER TABLE `register`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `service`
--
ALTER TABLE `service`
  ADD PRIMARY KEY (`service_id`);

--
-- Indexes for table `size`
--
ALTER TABLE `size`
  ADD PRIMARY KEY (`size_id`);

--
-- Indexes for table `tailor`
--
ALTER TABLE `tailor`
  ADD PRIMARY KEY (`tailor_id`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(3) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `order`
--
ALTER TABLE `order`
  MODIFY `order_id` int(3) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `register`
--
ALTER TABLE `register`
  MODIFY `user_id` int(3) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `service`
--
ALTER TABLE `service`
  MODIFY `service_id` int(3) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `size`
--
ALTER TABLE `size`
  MODIFY `size_id` int(3) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tailor`
--
ALTER TABLE `tailor`
  MODIFY `tailor_id` int(3) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admin`
--
ALTER TABLE `admin`
  ADD CONSTRAINT `admin_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `register` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `order`
--
ALTER TABLE `order`
  ADD CONSTRAINT `order_ibfk_1` FOREIGN KEY (`admin_id`) REFERENCES `admin` (`admin_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `order_service`
--
ALTER TABLE `order_service`
  ADD CONSTRAINT `order_service_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `order` (`order_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `order_service_ibfk_2` FOREIGN KEY (`service_id`) REFERENCES `service` (`service_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `order_size`
--
ALTER TABLE `order_size`
  ADD CONSTRAINT `order_size_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `order` (`order_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `order_size_ibfk_2` FOREIGN KEY (`size_id`) REFERENCES `size` (`size_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tailor`
--
ALTER TABLE `tailor`
  ADD CONSTRAINT `tailor_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `register` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
