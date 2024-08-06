-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 11, 2022 at 08:47 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fmh`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_feedback`
--

CREATE TABLE `tbl_feedback` (
  `to_id` int(10) UNSIGNED NOT NULL,
  `feedback` text NOT NULL,
  `feedback_response` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_img`
--

CREATE TABLE `tbl_img` (
  `r_id` int(255) UNSIGNED NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_img`
--

INSERT INTO `tbl_img` (`r_id`, `image`) VALUES
(13, 'uploads/Architecture (13).jpg'),
(15, 'uploads/Architecture (15).jpg'),
(16, 'uploads/Architecture (16).jpg'),
(17, 'uploads/Architecture (17).jpg'),
(18, 'uploads/Architecture (18).jpg'),
(19, 'uploads/Architecture (19).jpg'),
(1, 'uploads/Architecture (14).jpg'),
(25, 'uploads/Architecture (4).jpg'),
(25, 'uploads/Architecture (5).jpg'),
(25, 'uploads/Architecture (6).jpg'),
(25, 'uploads/Architecture (7).jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_room`
--

CREATE TABLE `tbl_room` (
  `r_id` int(10) UNSIGNED NOT NULL,
  `f_id` int(10) UNSIGNED DEFAULT NULL,
  `occupy` varchar(15) NOT NULL DEFAULT 'Not Occupied',
  `location` varchar(255) NOT NULL,
  `latitude` varchar(255) NOT NULL,
  `longitude` varchar(255) NOT NULL,
  `type` varchar(25) NOT NULL,
  `roomSize` varchar(12) NOT NULL DEFAULT 'Small',
  `price` bigint(25) NOT NULL,
  `per` varchar(10) NOT NULL DEFAULT 'Month',
  `negotiable` varchar(15) NOT NULL DEFAULT 'Negotiable',
  `furnishing` varchar(25) NOT NULL DEFAULT 'Not Furnished',
  `services` varchar(255) NOT NULL,
  `floor` int(11) NOT NULL,
  `bhk` int(2) NOT NULL DEFAULT 1,
  `rating` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_room`
--

INSERT INTO `tbl_room` (`r_id`, `f_id`, `occupy`, `location`, `latitude`, `longitude`, `type`, `roomSize`, `price`, `per`, `negotiable`, `furnishing`, `services`, `floor`, `bhk`, `rating`) VALUES
(1, 2, 'Not Occupied', 'Thapathali', '27.7172453', '85.3234605', 'Single Room', 'Large', 445, 'Month', 'Non Negotiable', 'Semi Furnished', ' Security, Internet', 3, 1, 5),
(13, 2, 'Not Occupied', 'anamnagar', '', '', '', 'Small', 0, 'Month', 'Negotiable', 'Not Furnished', '', 0, 1, 0),
(15, 7, 'Not Occupied', 'Balaju', '27.727662505460824', '85.30466621303007', 'Single room', 'Medium', 5555, 'Month', 'Non Negotiable', 'Full Furnished', 'Drinking Water, Security, Internet, Waste', 5, 1, 0),
(16, 1, 'Not Occupied', 'Bālāju', '27.7422182', '85.2991106', 'Flat', 'Medium', 6001, 'Month', 'Negotiable', 'Not Furnished', 'Drinking Water, Waste', 3, 1, 0),
(17, 2, 'Not Occupied', 'Balaju', 'Error', 'Error', 'Flat', 'Small', 666, 'Month', 'Non Negotiable', 'Semi Furnished', 'Drinking Water, Security', 2, 3, 0),
(18, 1, 'Not Occupied', 'Kathmandu', '27.69904055788703', '85.32382552362316', 'Flat', 'Medium', 555, 'Month', 'Non Negotiable', 'Semi Furnished', 'Drinking Water, Internet', 3, 3, 0),
(19, 1, 'Not Occupied', 'Thapathali', '27.7172453', '85.3239605', 'Single Room', 'Medium', 555, 'Month', 'Non Negotiable', 'Semi Furnished', ' Security, Internet', 3, 1, 0),
(25, 1, 'Occupied', 'Bāneswar', '27.6922368', '85.3344256', 'Single Room', 'Medium', 6000, 'Month', 'Negotiable', 'Not Furnished', 'Drinking Water, Security', 1, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_to`
--

CREATE TABLE `tbl_to` (
  `to_id` int(10) UNSIGNED NOT NULL,
  `role` varchar(15) NOT NULL,
  `name` varchar(30) NOT NULL,
  `address` varchar(40) NOT NULL,
  `dob` date NOT NULL,
  `gender` varchar(6) NOT NULL,
  `phone` bigint(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `marital_status` varchar(10) NOT NULL,
  `note` text DEFAULT NULL,
  `dp` varchar(100) NOT NULL,
  `gov_id` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_to`
--

INSERT INTO `tbl_to` (`to_id`, `role`, `name`, `address`, `dob`, `gender`, `phone`, `email`, `password`, `marital_status`, `note`, `dp`, `gov_id`) VALUES
(1, 'Owner', 'Samir Shrestha', 'Lalbandi', '2000-10-23', 'Male', 9807898070, 'samirshrestha@kcc.edu.np', 'be565264147e8523fd306d86ce966541', 'Dc', '', 'uploads/samir.jpg', 'uploads/2092.jpg'),
(2, 'Owner', 'Bishal Tamang', 'Damauli', '1999-12-14', 'Male', 9812345678, 'bishaltamang117@gmail.com', '1adb27fabdfee91e29a94e3fb02e08bc', 'Dc', 'I\'m bishal', 'uploads/images.png', 'uploads/2092.jpg'),
(3, 'Tenant', 'Shristi Pradhan', 'Imadol', '2002-03-19', 'Female', 9844455532, 'shristi555pradhan@gmail.com', '3968f3bf0cc5f4f102681910939e1730', 'Unmarried', '', 'uploads/kisspng-user-logo-information-service-design-5ba34f886b6700.1362345615374293844399.jpg', 'uploads/2092.jpg'),
(4, 'Tenant', 'Samir Shrestha', 'Lalbandi', '2000-10-23', 'Male', 9807898070, 'samirshrestha9807@gmail.com', '513868a1ab92de4c34d68013d59603fa', 'Unmarried', '', 'uploads/blue-user-icon-32.jpg', 'uploads/2092.jpg'),
(5, 'Owner', 'Hey', 'OuwluNPp7D', '2018-12-05', 'Male', 753748, 'samirshrestha9807@gmail.com', '0e087adf275d228a4b1f2f1a62b8c4ce', 'Married', '\"I\'m samir\"', 'uploads/899048ab0cc455154006fdb9676964b3.jpg', 'uploads/2092.jpg'),
(6, 'Tenant', 'Samir Shrestha', 'Lalbandi', '2018-12-31', 'Male', 123, 'meronamsamirshrestha@gmail.com', '513868a1ab92de4c34d68013d59603fa', 'Unmarried', '', 'uploads/899048ab0cc455154006fdb9676964b3.jpg', 'uploads/2092.jpg'),
(7, 'Owner', 'Hey', 'JzTh4RByFi', '2018-12-05', 'Male', 753483, 'meronamsamirshrestha@gmail.com', '0e087adf275d228a4b1f2f1a62b8c4ce', 'Married', '\"I\'m samir\"', 'uploads/interior-design-style-minimalism-wallpaper-preview (Custom).jpg', 'uploads/VerticalBoardAccentWallwithShelf4-730x1024.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_wishlist`
--

CREATE TABLE `tbl_wishlist` (
  `to_id` int(10) UNSIGNED NOT NULL,
  `r_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_wishlist`
--

INSERT INTO `tbl_wishlist` (`to_id`, `r_id`) VALUES
(1, 19),
(1, 25);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_feedback`
--
ALTER TABLE `tbl_feedback`
  ADD KEY `tenant_feedback` (`to_id`);

--
-- Indexes for table `tbl_img`
--
ALTER TABLE `tbl_img`
  ADD KEY `r_id` (`r_id`);

--
-- Indexes for table `tbl_room`
--
ALTER TABLE `tbl_room`
  ADD PRIMARY KEY (`r_id`),
  ADD KEY `f_id` (`f_id`);

--
-- Indexes for table `tbl_to`
--
ALTER TABLE `tbl_to`
  ADD PRIMARY KEY (`to_id`);

--
-- Indexes for table `tbl_wishlist`
--
ALTER TABLE `tbl_wishlist`
  ADD KEY `tenant` (`to_id`),
  ADD KEY `room` (`r_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_room`
--
ALTER TABLE `tbl_room`
  MODIFY `r_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `tbl_to`
--
ALTER TABLE `tbl_to`
  MODIFY `to_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_feedback`
--
ALTER TABLE `tbl_feedback`
  ADD CONSTRAINT `tenant_feedback` FOREIGN KEY (`to_id`) REFERENCES `tbl_to` (`to_id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `tbl_img`
--
ALTER TABLE `tbl_img`
  ADD CONSTRAINT `r_id` FOREIGN KEY (`r_id`) REFERENCES `tbl_room` (`r_id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `tbl_room`
--
ALTER TABLE `tbl_room`
  ADD CONSTRAINT `f_id` FOREIGN KEY (`f_id`) REFERENCES `tbl_to` (`to_id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `tbl_wishlist`
--
ALTER TABLE `tbl_wishlist`
  ADD CONSTRAINT `room` FOREIGN KEY (`r_id`) REFERENCES `tbl_room` (`r_id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `tenant` FOREIGN KEY (`to_id`) REFERENCES `tbl_to` (`to_id`) ON DELETE CASCADE ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
