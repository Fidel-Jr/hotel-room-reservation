-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 12, 2024 at 06:19 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hotel_db`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `check_room_availability` (IN `room_id` INT, IN `check_in_date` DATE, IN `check_out_date` DATE)   BEGIN 
	SELECT * FROM booking WHERE booking.room_id = room_id
    AND ((check_in = check_in_date AND booking.check_in_time  >= '14:00:00' )
    OR(check_out = check_out_date)
    OR(check_in_date BETWEEN check_in AND check_out)
    OR(check_out_date BETWEEN check_in AND check_out));
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `display_room` (IN `room_id` INT)   BEGIN 
	SELECT * FROM room_type WHERE id = room_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `rate` (IN `room_id` INT)   BEGIN 

		DECLARE total_rating INT;
		
        SET total_rating = (SELECT AVG(rating) FROM rating as total_rating WHERE room_type_id = room_id);
    	UPDATE room_type SET rating = total_rating WHERE id = room_id;
        
       
    
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `search` (IN `check_in_date` DATE, IN `check_out_date` DATE, IN `total_person` INT)   BEGIN
	SELECT room_type.* , COUNT(room.room_type) AS count
                                FROM room INNER JOIN room_type ON room.room_type = room_type.id
                                WHERE room.id NOT IN (
                                    SELECT room.id 
                                    FROM booking 
                                    INNER JOIN room ON booking.room_id = room.id 
                                    WHERE (
                                        (booking.check_in = check_in_date AND booking.check_in_time >= '14:00:00')
                                        OR (booking.check_out = check_out_date AND booking.check_out_time >= '12:00:00')
                                        OR (check_in_date BETWEEN CONCAT(booking.check_in, ' ', booking.check_in_time) AND CONCAT(booking.check_out, ' ', booking.check_out_time))
                                        OR (check_out_date BETWEEN CONCAT(booking.check_in, ' ', booking.check_in_time) AND CONCAT(booking.check_out, ' ', booking.check_out_time))
                                    )
                                ) AND room_type.capacity_adult + room_type.capacity_children >= total_person
                                GROUP BY room_type
                                ORDER BY count DESC, room_type.rating DESC;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `show_bed` (IN `room_id` INT)   BEGIN
	SELECT feature.name, room_feature.count FROM room_feature INNER JOIN feature ON 
    room_feature.feature_id=feature.id INNER JOIN room_type ON 
    room_feature.room_type_id = room_type.id 
    WHERE room_feature.room_type_id = room_id AND feature.type = 'Bed';
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `activity_log`
--

CREATE TABLE `activity_log` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `action` varchar(155) NOT NULL,
  `time_login` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `activity_log`
--

INSERT INTO `activity_log` (`id`, `user_id`, `action`, `time_login`) VALUES
(1, 7, 'User logged in', '2024-06-02 19:44:52'),
(2, 9, 'User logged in', '2024-06-02 23:14:38'),
(3, 7, 'User logged in', '2024-06-03 13:45:28'),
(4, 9, 'User logged in', '2024-06-03 14:11:11'),
(5, 10, 'User logged in', '2024-06-03 14:20:30'),
(6, 10, 'User logged in', '2024-06-03 14:30:16'),
(7, 9, 'User logged in', '2024-06-03 14:30:37'),
(8, 11, 'User logged in', '2024-06-03 14:35:46'),
(9, 12, 'User logged in', '2024-06-03 14:39:31'),
(10, 11, 'User logged in', '2024-06-03 15:00:49'),
(11, 8, 'User logged in', '2024-06-03 16:47:27'),
(12, 8, 'User logged in', '2024-06-03 19:08:39'),
(13, 12, 'User logged in', '2024-06-03 19:14:51'),
(14, 11, 'User logged in', '2024-06-03 19:15:57'),
(15, 7, 'User logged in', '2024-06-03 21:32:27'),
(16, 8, 'User logged in', '2024-06-03 21:40:35'),
(17, 9, 'User logged in', '2024-06-03 21:46:44'),
(18, 11, 'User logged in', '2024-06-04 05:07:41'),
(19, 10, 'User logged in', '2024-06-04 05:25:03'),
(20, 11, 'User logged in', '2024-06-04 05:25:44'),
(21, 12, 'User logged in', '2024-06-04 05:26:12'),
(22, 7, 'User logged in', '2024-06-04 05:47:37'),
(23, 13, 'User logged in', '2024-06-04 06:14:08'),
(24, 14, 'User logged in', '2024-06-04 06:16:00'),
(25, 9, 'User logged in', '2024-06-04 06:17:55'),
(26, 10, 'User logged in', '2024-06-04 06:20:10'),
(27, 8, 'User logged in', '2024-06-05 08:35:18');

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `id` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `check_in` date NOT NULL,
  `check_out` date NOT NULL,
  `check_in_time` time NOT NULL DEFAULT '14:00:00',
  `check_out_time` time NOT NULL DEFAULT '12:00:00',
  `booking_date` date NOT NULL DEFAULT current_timestamp(),
  `total_price` double NOT NULL,
  `booking_status` varchar(150) NOT NULL DEFAULT 'Pending',
  `payment_status` enum('Pending','Completed','Canceled','') NOT NULL DEFAULT 'Pending',
  `guest_count` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`id`, `room_id`, `user_id`, `check_in`, `check_out`, `check_in_time`, `check_out_time`, `booking_date`, `total_price`, `booking_status`, `payment_status`, `guest_count`) VALUES
(131, 8, 7, '2024-06-03', '2024-06-04', '14:00:00', '12:00:00', '2024-06-03', 5000, 'Pending', 'Completed', 3),
(133, 5, 10, '2024-06-03', '2024-06-05', '14:00:00', '12:00:00', '2024-06-03', 13000, 'Pending', 'Completed', 5),
(135, 51, 9, '2024-06-03', '2024-06-04', '14:00:00', '12:00:00', '2024-06-03', 8500, 'Pending', 'Completed', 1),
(137, 35, 11, '2024-06-03', '2024-06-04', '14:00:00', '12:00:00', '2024-06-03', 6500, 'Pending', 'Completed', 5),
(140, 27, 11, '2024-06-03', '2024-06-04', '16:00:00', '12:00:00', '2024-06-03', 5000, 'Pending', 'Completed', 2),
(141, 33, 11, '2024-06-03', '2024-06-09', '14:00:00', '12:00:00', '2024-06-03', 39000, 'Pending', 'Pending', 5),
(142, 25, 7, '2024-06-04', '2024-06-09', '17:00:00', '12:00:00', '2024-06-03', 32500, 'Pending', 'Pending', 10),
(143, 34, 7, '2024-06-04', '2024-06-07', '14:00:00', '12:00:00', '2024-06-03', 19500, 'Pending', 'Pending', 10),
(149, 52, 13, '2024-06-04', '2024-06-05', '14:00:00', '12:00:00', '2024-06-04', 8500, 'Pending', 'Pending', 1),
(150, 56, 14, '2024-06-04', '2024-06-05', '14:00:00', '12:00:00', '2024-06-04', 10000, 'Cleaning', 'Pending', 2),
(151, 53, 9, '2024-06-04', '2024-06-07', '14:00:00', '12:00:00', '2024-06-04', 25500, 'Pending', 'Pending', 1),
(153, 9, 8, '2024-06-05', '2024-06-06', '14:00:00', '12:00:00', '2024-06-05', 7900, 'Pending', 'Pending', 3);

-- --------------------------------------------------------

--
-- Table structure for table `booking_history`
--

CREATE TABLE `booking_history` (
  `id` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `check_in` date NOT NULL,
  `check_out` date NOT NULL,
  `check_in_time` time NOT NULL,
  `check_out_time` time NOT NULL,
  `booking_date` date NOT NULL,
  `total_price` double NOT NULL,
  `booking_status` varchar(100) NOT NULL DEFAULT 'Done',
  `payment_status` varchar(100) NOT NULL DEFAULT 'Done',
  `guest_count` int(11) NOT NULL,
  `rating_status` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `booking_history`
--

INSERT INTO `booking_history` (`id`, `room_id`, `user_id`, `check_in`, `check_out`, `check_in_time`, `check_out_time`, `booking_date`, `total_price`, `booking_status`, `payment_status`, `guest_count`, `rating_status`) VALUES
(1, 5, 8, '2024-06-01', '2024-06-02', '17:00:00', '12:00:00', '2024-06-01', 19500, 'Done', 'Done', 5, 'rated'),
(2, 4, 8, '2024-06-01', '2024-06-02', '15:00:00', '12:00:00', '2024-06-02', 10000, 'Done', 'Done', 2, 'rated'),
(3, 5, 9, '2024-05-31', '2024-06-01', '14:00:00', '12:00:00', '2024-06-02', 6500, 'Done', 'Done', 3, 'rated'),
(4, 5, 10, '2024-05-31', '2024-06-01', '19:00:00', '12:00:00', '2024-06-02', 6500, 'Done', 'Done', 5, 'rated'),
(5, 6, 11, '2024-05-29', '2024-05-30', '19:00:00', '12:00:00', '2024-06-02', 10000, 'Done', 'Done', 1, 'rated'),
(6, 4, 12, '2024-05-28', '2024-05-30', '19:00:00', '12:00:00', '2024-05-28', 10000, 'Done', 'Done', 1, 'rated'),
(7, 26, 8, '2024-06-02', '2024-06-03', '14:00:00', '12:00:00', '2024-06-02', 5000, 'Done', 'Done', 4, 'rated'),
(8, 1, 8, '2024-05-29', '2024-05-30', '15:00:00', '12:00:00', '2024-05-29', 15000, 'Done', 'Done', 2, NULL),
(10, 9, 11, '2024-06-02', '2024-06-03', '14:00:00', '12:00:00', '2024-06-02', 7900, 'Done', 'Done', 2, 'rated'),
(11, 3, 10, '2024-06-02', '2024-06-03', '14:00:00', '12:00:00', '2024-06-02', 30000, 'Done', 'Done', 4, 'rated'),
(12, 48, 12, '2024-06-01', '2024-06-03', '14:00:00', '12:00:00', '2024-06-01', 48000, 'Done', 'Done', 2, 'rated'),
(13, 46, 10, '2024-06-04', '2024-06-05', '14:00:00', '12:00:00', '2024-06-04', 24000, 'Done', 'Done', 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `feature`
--

CREATE TABLE `feature` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `feature`
--

INSERT INTO `feature` (`id`, `name`, `type`) VALUES
(1, 'Balcony', 'Special'),
(2, 'Free Wifi', 'Special'),
(3, 'Kitchen/Kitchenette', 'Space'),
(4, 'Private Pool', 'Special'),
(5, 'TV', 'Special'),
(6, 'Sofa', 'Furniture'),
(7, 'Armchairs', 'Furniture'),
(8, 'Desks', 'Furniture'),
(9, 'Mini-Fridge', 'Extras'),
(10, 'Microwave', 'Extras'),
(11, 'Twin Bed', 'Bed'),
(12, 'Queen Bed', 'Bed'),
(13, 'King Bed', 'Bed'),
(14, 'Single Bed', 'Bed');

-- --------------------------------------------------------

--
-- Table structure for table `login_attempts`
--

CREATE TABLE `login_attempts` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `attempt_time` datetime NOT NULL DEFAULT current_timestamp(),
  `success` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `login_attempts`
--

INSERT INTO `login_attempts` (`id`, `user_id`, `attempt_time`, `success`) VALUES
(2, 7, '2024-06-02 19:44:52', 1),
(3, 9, '2024-06-02 23:14:38', 1),
(4, 7, '2024-06-03 13:45:28', 1),
(5, 9, '2024-06-03 14:11:11', 1),
(6, 10, '2024-06-03 14:20:30', 1),
(7, 10, '2024-06-03 14:30:16', 1),
(8, 9, '2024-06-03 14:30:37', 1),
(9, 11, '2024-06-03 14:35:46', 1),
(10, 12, '2024-06-03 14:39:31', 1),
(11, 11, '2024-06-03 15:00:49', 1),
(12, 8, '2024-06-03 16:47:27', 1),
(13, 8, '2024-06-03 19:08:39', 1),
(14, 12, '2024-06-03 19:14:51', 1),
(15, 11, '2024-06-03 19:15:57', 1),
(16, 7, '2024-06-03 21:32:27', 1),
(17, 8, '2024-06-03 21:40:35', 1),
(18, 9, '2024-06-03 21:46:44', 1),
(19, 11, '2024-06-04 05:07:41', 1),
(20, 10, '2024-06-04 05:25:03', 1),
(21, 11, '2024-06-04 05:25:44', 1),
(22, 12, '2024-06-04 05:26:12', 1),
(23, 7, '2024-06-04 05:47:37', 1),
(24, 13, '2024-06-04 06:14:08', 1),
(25, 14, '2024-06-04 06:16:00', 1),
(26, 9, '2024-06-04 06:17:55', 1),
(27, 10, '2024-06-04 06:20:10', 1),
(28, 8, '2024-06-05 08:35:18', 1);

--
-- Triggers `login_attempts`
--
DELIMITER $$
CREATE TRIGGER `log_user_login` AFTER INSERT ON `login_attempts` FOR EACH ROW BEGIN
    IF NEW.success THEN
        INSERT INTO activity_log (user_id, action, time_login)
        VALUES (NEW.user_id, 'User logged in', NEW.attempt_time);
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `rating`
--

CREATE TABLE `rating` (
  `id` int(11) NOT NULL,
  `booking_history_id` int(11) NOT NULL,
  `room_type_id` int(11) NOT NULL,
  `rating` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rating`
--

INSERT INTO `rating` (`id`, `booking_history_id`, `room_type_id`, `rating`) VALUES
(29, 1, 4, 5),
(30, 2, 1, 5),
(34, 3, 4, 5),
(35, 4, 4, 5),
(37, 5, 6, 5),
(38, 6, 1, 5),
(39, 7, 3, 5),
(40, 11, 7, 5),
(41, 10, 2, 5),
(42, 12, 8, 5);

-- --------------------------------------------------------

--
-- Table structure for table `room`
--

CREATE TABLE `room` (
  `id` int(11) NOT NULL,
  `room_type` int(11) NOT NULL,
  `room_number` int(11) NOT NULL,
  `availability` enum('Available','Not Available','','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `room`
--

INSERT INTO `room` (`id`, `room_type`, `room_number`, `availability`) VALUES
(1, 5, 1, 'Available'),
(2, 6, 1, 'Available'),
(3, 7, 1, 'Available'),
(4, 1, 1, 'Available'),
(5, 4, 1, 'Available'),
(6, 3, 1, 'Available'),
(8, 1, 2, 'Available'),
(9, 2, 1, 'Available'),
(10, 7, 2, 'Available'),
(11, 7, 3, 'Available'),
(12, 5, 2, 'Available'),
(15, 2, 2, 'Available'),
(16, 2, 3, 'Available'),
(17, 2, 4, 'Available'),
(18, 2, 5, 'Available'),
(19, 6, 2, 'Available'),
(20, 7, 4, 'Available'),
(24, 6, 3, 'Available'),
(25, 4, 2, 'Available'),
(26, 1, 3, 'Available'),
(27, 1, 4, 'Available'),
(28, 1, 5, 'Available'),
(29, 3, 2, 'Available'),
(30, 3, 3, 'Available'),
(31, 3, 4, 'Available'),
(32, 3, 5, 'Available'),
(33, 4, 3, 'Available'),
(34, 4, 4, 'Available'),
(35, 4, 5, 'Available'),
(36, 5, 3, 'Available'),
(37, 5, 4, 'Available'),
(38, 5, 5, 'Available'),
(39, 6, 4, 'Available'),
(40, 6, 5, 'Available'),
(41, 7, 5, 'Available'),
(46, 8, 1, 'Available'),
(47, 8, 2, 'Available'),
(48, 8, 3, 'Available'),
(49, 8, 4, 'Available'),
(50, 8, 5, 'Available'),
(51, 9, 1, 'Available'),
(52, 9, 2, 'Available'),
(53, 9, 3, 'Available'),
(54, 9, 5, 'Available'),
(55, 9, 4, 'Available'),
(56, 10, 1, 'Available'),
(57, 10, 2, 'Available'),
(58, 10, 3, 'Available'),
(59, 10, 4, 'Available'),
(60, 10, 5, 'Available');

-- --------------------------------------------------------

--
-- Table structure for table `room_feature`
--

CREATE TABLE `room_feature` (
  `id` int(11) NOT NULL,
  `feature_id` int(11) NOT NULL,
  `room_type_id` int(11) NOT NULL,
  `count` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `room_feature`
--

INSERT INTO `room_feature` (`id`, `feature_id`, `room_type_id`, `count`) VALUES
(1, 2, 1, 1),
(2, 12, 1, 1),
(3, 14, 1, 2),
(4, 2, 2, 1),
(5, 13, 2, 1),
(6, 11, 2, 2),
(15, 2, 5, 1),
(16, 13, 5, 1),
(17, 14, 5, 2),
(33, 2, 8, 1),
(34, 14, 8, 2),
(35, 2, 9, 1),
(36, 14, 9, 1),
(41, 7, 8, 2),
(42, 2, 7, 1),
(43, 1, 7, 1),
(44, 3, 7, 1),
(45, 4, 7, 1),
(46, 5, 7, 1),
(47, 6, 7, 1),
(48, 7, 7, 1),
(49, 8, 7, 1),
(50, 12, 7, 1),
(51, 13, 7, 1),
(52, 14, 7, 3),
(53, 2, 4, 1),
(54, 1, 4, 1),
(55, 3, 4, 1),
(56, 4, 4, 1),
(57, 5, 4, 1),
(58, 12, 4, 1),
(59, 11, 4, 2),
(60, 14, 4, 3),
(61, 2, 6, 1),
(62, 3, 6, 1),
(63, 4, 6, 1),
(64, 5, 6, 1),
(65, 7, 6, 1),
(66, 8, 6, 2),
(67, 14, 6, 3),
(68, 2, 3, 1),
(69, 13, 3, 1),
(70, 8, 3, 2),
(71, 7, 3, 3),
(72, 14, 3, 2),
(73, 9, 3, 1),
(74, 2, 10, 1),
(75, 11, 10, 1);

-- --------------------------------------------------------

--
-- Table structure for table `room_images`
--

CREATE TABLE `room_images` (
  `id` int(11) NOT NULL,
  `room_type_id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `room_images`
--

INSERT INTO `room_images` (`id`, `room_type_id`, `image`) VALUES
(1, 1, 'download (5).jpg'),
(2, 4, 'img-2.jpeg'),
(3, 4, 'img-4.jpeg'),
(4, 4, 'img-1.jpeg'),
(5, 4, 'img-3.jpeg'),
(6, 4, 'img-5.jpeg'),
(7, 4, 'img-6.jpeg'),
(8, 4, 'img-7.jpeg'),
(9, 4, 'img-8.jpeg'),
(10, 2, 'img-3.png'),
(11, 2, 'img-2.png'),
(12, 2, 'img-1.png'),
(13, 2, 'img-4.png'),
(14, 2, 'img-5.png'),
(15, 2, 'img-6.png'),
(16, 2, 'img-7.png'),
(17, 2, 'img-8.jpeg'),
(18, 1, 'img-3.png'),
(20, 1, 'img-2.png'),
(21, 1, 'img-4.png'),
(22, 6, 'img-1.png'),
(23, 6, 'img-2.png'),
(24, 6, 'img-3.png'),
(26, 6, 'img-5.png'),
(27, 6, 'img-6.png'),
(28, 6, 'img-7.png'),
(29, 6, 'img-8.png'),
(30, 3, 'img-1.png'),
(31, 3, 'img-2.png'),
(32, 3, 'img-3.png'),
(33, 3, 'img-4.png'),
(34, 3, 'img-5.png'),
(35, 3, 'img-6.png'),
(36, 3, 'img-7.png'),
(37, 3, 'img-8.png'),
(38, 5, 'img-1.jpg'),
(39, 5, 'img-2.jpg'),
(40, 5, 'img-3.jpg'),
(41, 5, 'img-4.jpg'),
(42, 5, 'img-5.jpg'),
(43, 5, 'img-6.jpg'),
(44, 5, 'img-7.jpg'),
(45, 5, 'img-8.jpg'),
(46, 7, 'sd-img-8.jpg'),
(48, 7, 'sngr-1.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `room_type`
--

CREATE TABLE `room_type` (
  `id` int(11) NOT NULL,
  `room_type` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `bed` int(11) NOT NULL,
  `bathroom` int(11) NOT NULL,
  `floor` int(11) NOT NULL,
  `price` double NOT NULL,
  `capacity_adult` int(11) NOT NULL,
  `capacity_children` int(11) NOT NULL,
  `max_capacity` int(11) NOT NULL,
  `rating` int(11) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `room_type`
--

INSERT INTO `room_type` (`id`, `room_type`, `description`, `bed`, `bathroom`, `floor`, `price`, `capacity_adult`, `capacity_children`, `max_capacity`, `rating`, `image`) VALUES
(1, 'Standard Room', 'A basic room with essential amenities, usually suitable for one or two guests.  ', 3, 1, 1, 5000, 2, 2, 5, 5, 'sr-img.png'),
(2, 'Deluxe Room', 'A room offering more space, better views, and upgraded amenities. It provides a more comfortable and luxurious experience compared to the basic accommodations.', 3, 1, 2, 7900, 2, 4, 8, 5, 'dr-img.png'),
(3, 'Executive Room', 'Ideal for business travelers who need a comfortable and functional space to work and relax, as well as leisure travelers who desire a higher level of service and amenities.', 3, 2, 3, 10000, 2, 2, 4, 5, 'room-2.jpg'),
(4, 'Family Room', 'Ideal for families with children or groups who need additional space and sleeping arrangements beyond what is available in standard or deluxe rooms.', 6, 1, 2, 6500, 5, 5, 10, 5, 'fr-img.jpeg'),
(5, 'Junior Suite', 'Spacious and luxurious suite featuring a king-size bed, have a private balcony.', 3, 2, 3, 15000, 1, 1, 5, 0, 'room-1.jpg'),
(6, 'Executive Suite', 'Spacious and luxurious suite featuring a king-size bed, have a private balcony and desks.', 3, 2, 4, 23000, 3, 0, 6, 0, 'room-2.jpg'),
(7, 'Super Deluxe', 'The Super Deluxe Room offers a perfect blend of luxury and comfort. This room features a queen-size bed, and a modern ensuite bathroom with a rain shower.', 5, 1, 5, 30000, 1, 1, 10, 5, 'room-3.jpg'),
(8, 'Studio Room', 'A room with a studio setup, which includes a bed and a small kitchenette or sitting area.', 2, 1, 6, 24000, 1, 1, 2, 5, 'studio-room.jpg'),
(9, 'Single Room', 'A single room provides a comfortable and efficient space for a single guest, ensuring all the essential amenities for a pleasant stay without the extra cost of a larger room.', 1, 1, 1, 8500, 2, 0, 2, 0, 'single-room.jpg'),
(10, 'Double Room', 'A Room offers a comfortable and convenient stay for two guests, with a variety of amenities and services aimed at enhancing the guest experience. ', 1, 1, 1, 10000, 2, 0, 3, 0, 'double-room.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `gender` varchar(100) DEFAULT NULL,
  `phone_number` varchar(100) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `registration_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `email`, `password`, `fullname`, `gender`, `phone_number`, `address`, `dob`, `registration_date`) VALUES
(7, 'Gojo', 'gojosatoru@gmail.com', '$2y$10$I6b94YI.AK4o5M8XU8NHB.n3i/ue0dqk2Dj6hDmNkv7NzOQmD3Hpm', 'Gojo Satoru', 'Male', '09550071438', 'Japan', '1986-12-25', '2024-05-30 22:10:21'),
(8, 'Fidel', 'fidelsalongacolinares04@gmail.com', '$2y$10$md3UCsp4dBi.ZZoxOevP/ubpXmLr6IypDwXjo1E95UXxs7slT7p1y', 'Fidel Colinares', 'Male', '09673561791', 'Licanan Lasang Davao City', '2004-05-04', '2024-05-31 05:29:46'),
(9, 'Geto', 'geto@gmail.com', '$2y$10$57qXEmKxZlT.1I/AmjRQbeFhC85XMm7G/3NgT10X2D.eMi0KPGpXm', 'Geto Suguru', 'Male', '09673561791', 'Kyoto', '1987-11-01', '2024-06-02 17:14:46'),
(10, 'Yuji', 'yuji@gmail.com', '$2y$10$CY92W7OcZaQEMlsdiJQvWudY2VUb4iicLpB3sQ2tQbCgy4spni6qK', 'Yuji Itadori', 'Male', '09673561791', 'Kyoto', '2004-04-05', '2024-06-02 18:59:34'),
(11, 'Nanamin', 'nanami@gmail.com', '$2y$10$AeJn9xuoy.Iwp/MkBf0k9O7uN/oy.793sAdTRSe5FwnGeoYPUr/Ji', 'Nanami', 'Male', '09673561791', 'Kyoto', '1990-08-21', '2024-06-02 19:06:45'),
(12, 'Megumi', 'megumi@gmail.com', '$2y$10$4OBoWBy9MZzjhiajwx6I5uuOz4qt6B4AqA5oqhpY7BgTvkvMWEPiS', 'Megumi Fushiguro', 'Male', '09673561791', 'Kyoto', '2004-05-04', '2024-06-02 19:10:55'),
(13, 'james', 'james@gmail.com', '$2y$10$gn6nVSg.ukF77AxwIZvK/ebBytajqN3WMW3F89jgRBtnFHBDLEf2a', 'James Ryan', 'Male', '09673561791', 'Calokohan', '1930-12-25', '2024-06-04 06:13:56'),
(14, 'David', 'davidvillacencio@gmail.com', '$2y$10$hKR.SVhpiNn9Un6Oe6mDIeBpbqMllOq0mD8Q3WGG5ANf6BESCN7gm', 'David Roy Villancencio', 'Male', '09673561791', 'Tagam', '1940-12-25', '2024-06-04 06:15:52');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activity_log`
--
ALTER TABLE `activity_log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`id`),
  ADD KEY `check_in` (`check_in`),
  ADD KEY `check_out` (`check_out`);

--
-- Indexes for table `booking_history`
--
ALTER TABLE `booking_history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `room_id` (`room_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `feature`
--
ALTER TABLE `feature`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `login_attempts`
--
ALTER TABLE `login_attempts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rating`
--
ALTER TABLE `rating`
  ADD PRIMARY KEY (`id`),
  ADD KEY `room_type_id` (`room_type_id`),
  ADD KEY `booking_history_id` (`booking_history_id`);

--
-- Indexes for table `room`
--
ALTER TABLE `room`
  ADD PRIMARY KEY (`id`),
  ADD KEY `room_type` (`room_type`);

--
-- Indexes for table `room_feature`
--
ALTER TABLE `room_feature`
  ADD PRIMARY KEY (`id`),
  ADD KEY `room_feature_ibfk_1` (`feature_id`),
  ADD KEY `room_type_id` (`room_type_id`);

--
-- Indexes for table `room_images`
--
ALTER TABLE `room_images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `room_type`
--
ALTER TABLE `room_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activity_log`
--
ALTER TABLE `activity_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `booking`
--
ALTER TABLE `booking`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=154;

--
-- AUTO_INCREMENT for table `booking_history`
--
ALTER TABLE `booking_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `feature`
--
ALTER TABLE `feature`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `login_attempts`
--
ALTER TABLE `login_attempts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `rating`
--
ALTER TABLE `rating`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `room`
--
ALTER TABLE `room`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `room_feature`
--
ALTER TABLE `room_feature`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- AUTO_INCREMENT for table `room_images`
--
ALTER TABLE `room_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `room_type`
--
ALTER TABLE `room_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `booking`
--
ALTER TABLE `booking`
  ADD CONSTRAINT `booking_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `booking_ibfk_3` FOREIGN KEY (`room_id`) REFERENCES `room` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `booking_history`
--
ALTER TABLE `booking_history`
  ADD CONSTRAINT `booking_history_ibfk_1` FOREIGN KEY (`room_id`) REFERENCES `room` (`id`),
  ADD CONSTRAINT `booking_history_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Constraints for table `rating`
--
ALTER TABLE `rating`
  ADD CONSTRAINT `rating_ibfk_1` FOREIGN KEY (`room_type_id`) REFERENCES `room_type` (`id`),
  ADD CONSTRAINT `rating_ibfk_2` FOREIGN KEY (`booking_history_id`) REFERENCES `booking_history` (`id`);

--
-- Constraints for table `room`
--
ALTER TABLE `room`
  ADD CONSTRAINT `room_ibfk_1` FOREIGN KEY (`room_type`) REFERENCES `room_type` (`id`);

--
-- Constraints for table `room_feature`
--
ALTER TABLE `room_feature`
  ADD CONSTRAINT `room_feature_ibfk_1` FOREIGN KEY (`feature_id`) REFERENCES `feature` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `room_feature_ibfk_2` FOREIGN KEY (`room_type_id`) REFERENCES `room_type` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
