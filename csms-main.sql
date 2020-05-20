-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 15, 2020 at 02:59 PM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 7.2.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `crms`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `admin_id` int(10) NOT NULL,
  `name` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `date_created` datetime NOT NULL,
  `last_login` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`admin_id`, `name`, `email`, `password`, `date_created`, `last_login`) VALUES
(2, ' Developer Kit', 'admin@developer', '$2y$10$T6ERd74IMzO5V4K9WrePZeMnoG2Y0iv43egnITOnoPA/48zLFL0Ce', '2019-09-13 14:27:38', '2019-11-15 02:22:28');

-- --------------------------------------------------------

--
-- Table structure for table `areas`
--

CREATE TABLE `areas` (
  `area_id` int(10) NOT NULL,
  `area_name` varchar(30) DEFAULT NULL,
  `area_text` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `areas`
--

INSERT INTO `areas` (`area_id`, `area_name`, `area_text`) VALUES
(1, 'Oke-odo', '16:00'),
(2, 'Oyo', '19:00'),
(3, 'Ogun', '14:00'),
(4, 'Oduni', '13:00');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `comment_id` int(10) NOT NULL,
  `comment_text` text NOT NULL,
  `comment_date` date NOT NULL,
  `comment_time` time NOT NULL,
  `request_id` int(10) NOT NULL,
  `customer_id` int(10) DEFAULT NULL,
  `staff_id` int(10) DEFAULT NULL,
  `comment_status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`comment_id`, `comment_text`, `comment_date`, `comment_time`, `request_id`, `customer_id`, `staff_id`, `comment_status`) VALUES
(1, 'Hello John', '2020-04-18', '21:41:56', 6, NULL, 4, 'Y'),
(2, 'We are on our way', '2020-04-18', '22:06:35', 6, NULL, 4, 'Y'),
(3, 'We\'ve assigned our workteam straight to your destination', '2020-04-18', '22:07:34', 6, NULL, 2, 'Y'),
(4, 'You\'ll be updated duely', '2020-04-18', '22:07:50', 6, NULL, 2, 'Y'),
(5, 'Thank you!', '2020-04-18', '22:08:05', 6, 1, NULL, 'Y'),
(6, 'I\'ll be expecting you', '2020-04-18', '22:08:18', 6, 1, NULL, 'Y'),
(7, 'We are done, you can close this request by clicking on the Confirm Resolved button', '2020-04-18', '22:09:12', 6, NULL, 4, 'Y'),
(8, 'Please John, confirm this', '2020-04-18', '22:09:39', 6, NULL, 2, 'Y'),
(9, 'Yes, I am glad', '2020-04-18', '22:09:57', 6, 1, NULL, 'Y'),
(10, 'We\'re happy you are satisfied!', '2020-04-18', '22:10:16', 6, NULL, 2, 'Y'),
(11, 'Yeah', '2020-04-18', '13:57:07', 6, 1, NULL, 'Y'),
(12, 'Have a great day, I\'ll be closing this request now', '2020-04-18', '13:57:09', 6, NULL, 2, 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `customer_id` int(10) NOT NULL,
  `customer_name` varchar(50) NOT NULL,
  `customer_email` varchar(100) NOT NULL,
  `customer_password` varchar(100) NOT NULL,
  `customer_meter_num` varchar(50) NOT NULL,
  `customer_phone_num` varchar(20) NOT NULL,
  `customer_image` text NOT NULL,
  `customer_state` varchar(15) NOT NULL,
  `customer_city` varchar(15) NOT NULL,
  `customer_address` varchar(100) NOT NULL,
  `customer_creator` varchar(10) NOT NULL,
  `customer_status` varchar(20) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_login` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `area_id` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`customer_id`, `customer_name`, `customer_email`, `customer_password`, `customer_meter_num`, `customer_phone_num`, `customer_image`, `customer_state`, `customer_city`, `customer_address`, `customer_creator`, `customer_status`, `date_created`, `last_login`, `area_id`) VALUES
(1, 'John Bob', 'john.bob@gmail.com', 'eaea7928d3c0c10ce80be4f79222981b', 'S11P003789', '09000000123', 'Profile Pic.jpg', 'Kwara', 'Ilorin', 'No. 3 Sateri Street, Oku', '', 'ACTIVATED', '2020-05-02 22:01:40', '2020-05-15 11:35:13', 4),
(2, 'Teslima Rahman', 'Teslima.Rahman@gmail.com', '05061a1b05b121ff2d31efdc78852284', 'S11P222429', '08022259867', 'avatar.png', 'Osun', 'Ede', 'Ayola Street', '', 'ACTIVATED', '2020-05-02 21:56:45', '2020-03-10 22:36:37', 3),
(4, 'Enemali Onah', 'enemali.onah@gmail.com', '2990da177b17912355694881352ae494', 'S11P003789', '08143547213', 'avatar.png', 'Kwara', 'Ilorin', 'Aweye Building, Ilodun Street, Tanke', '', 'DEACTIVATED', '2020-05-02 21:45:24', '2020-03-10 22:36:37', 1),
(5, 'Omto Chine', 'omto.chine@gmail.com', 'e595139b9b1500bc67b0c3cc7867a32b', '', '08143546590', 'avatar.png', 'Osun', 'Otewu', 'Irani County, Ogun', '', 'DEACTIVATED', '2020-05-02 21:45:32', '2020-03-10 22:36:37', 1),
(7, 'Emmanuel Rose', 'em.rose@gmail.com', '38b58483cf2d2651d95abb1db676b24f', 'S12B002629', '09087654321', 'avatar.png', 'Nassarawa', 'Mararaba', 'Abuja-Keffi Express Way', '', 'DEACTIVATED', '2020-05-02 21:45:39', '2020-04-10 10:38:18', 2),
(8, 'Jamo', 'jamo@gmail.com', '38b58483cf2d2651d95abb1db676b24f', 'S11P003741', '09087654321', 'avatar.png', 'Nassarawa', 'Mararaba', 'Abuja-Keffi Express Way', '300415', 'ACTIVATED', '2020-05-02 22:11:47', '2020-05-02 22:09:30', 3);

-- --------------------------------------------------------

--
-- Table structure for table `notes`
--

CREATE TABLE `notes` (
  `note_id` int(10) NOT NULL,
  `note_text` varchar(255) NOT NULL,
  `note_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `note_status` varchar(10) NOT NULL,
  `staff_code` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notes`
--

INSERT INTO `notes` (`note_id`, `note_text`, `note_date`, `note_status`, `staff_code`) VALUES
(1, 'Sama', '2020-03-28 15:34:56', 'N', '300512'),
(2, 'Note Testing', '2020-03-28 15:40:08', 'N', '300512'),
(3, 'Testing', '2020-03-28 15:41:16', 'N', '300512'),
(4, 'Test', '2020-03-28 15:44:44', 'N', '300512'),
(5, 'Speak to the WT-A team', '2020-05-02 16:12:53', 'Y', '300415'),
(6, 'Change the request status', '2020-05-02 16:13:00', 'N', '300415'),
(7, 'Ruth testing', '2020-05-02 17:50:15', 'N', '300415'),
(8, 'Re-open request #REQ-1102', '2020-05-02 15:58:56', 'Y', '300415'),
(9, 'Yes, It works', '2020-05-02 17:18:44', 'N', '300415'),
(10, 'No loading', '2020-05-02 17:20:18', 'N', '300415'),
(12, 'Newest', '2020-05-02 18:02:42', 'Y', '300415'),
(13, 'Pend requests', '2020-05-03 09:04:07', 'N', '200156');

-- --------------------------------------------------------

--
-- Table structure for table `requests`
--

CREATE TABLE `requests` (
  `request_id` int(10) NOT NULL,
  `request_address` varchar(200) NOT NULL,
  `request_code` varchar(255) NOT NULL,
  `request_subject` varchar(100) NOT NULL,
  `request_message` text NOT NULL,
  `request_attachment` text,
  `request_status` varchar(20) DEFAULT NULL,
  `customer_id` int(10) NOT NULL,
  `workteam_id` int(10) DEFAULT NULL,
  `request_date` date NOT NULL,
  `request_time` time NOT NULL,
  `request_assignee` varchar(10) DEFAULT NULL,
  `request_cat_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `requests`
--

INSERT INTO `requests` (`request_id`, `request_address`, `request_code`, `request_subject`, `request_message`, `request_attachment`, `request_status`, `customer_id`, `workteam_id`, `request_date`, `request_time`, `request_assignee`, `request_cat_id`) VALUES
(6, 'Piloy Jos', '#UTK1804-6', 'NEED SOME INFO', 'I need to know how my details are been handled', '', 'OPEN', 1, 3, '2020-05-06', '13:02:41', '200156', 5),
(7, 'Aweye Building, Ilodun Street, Tanke', '#EJX0705-7', 'Low power supply', 'Low power since Covid-19', 'Color_Codes_1.pdf', 'NEW', 1, NULL, '2020-05-07', '11:41:04', NULL, 6);

-- --------------------------------------------------------

--
-- Table structure for table `request_cats`
--

CREATE TABLE `request_cats` (
  `request_cat_id` int(10) NOT NULL,
  `request_category` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `request_cats`
--

INSERT INTO `request_cats` (`request_cat_id`, `request_category`) VALUES
(1, 'Bills Related Inquiry'),
(2, 'Meter'),
(3, 'Report misconducts'),
(4, 'Customer Details update'),
(5, 'Product specials'),
(6, 'Others...');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `role_id` int(10) NOT NULL,
  `role_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`role_id`, `role_name`) VALUES
(1, 'Managers'),
(2, 'Customer Representative'),
(3, 'Technician'),
(4, '---');

-- --------------------------------------------------------

--
-- Table structure for table `staffs`
--

CREATE TABLE `staffs` (
  `staff_id` int(10) NOT NULL,
  `staff_name` varchar(50) NOT NULL,
  `staff_code` varchar(10) NOT NULL,
  `staff_email` varchar(100) NOT NULL,
  `staff_phone_num` varchar(20) NOT NULL,
  `staff_password` varchar(100) NOT NULL,
  `staff_image` text NOT NULL,
  `staff_creator` varchar(10) NOT NULL,
  `staff_status` varchar(20) NOT NULL,
  `role_id` int(10) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_login` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `staffs`
--

INSERT INTO `staffs` (`staff_id`, `staff_name`, `staff_code`, `staff_email`, `staff_phone_num`, `staff_password`, `staff_image`, `staff_creator`, `staff_status`, `role_id`, `date_created`, `last_login`) VALUES
(1, 'Emma Melu', '200156', 'emma.melu@gmail.com', '09099990009', 'df2d555b4589e722ad83af64e978596c', 'IMG_1078.JPG', '', 'ACTIVATED', 2, '2020-05-02 21:18:34', '2020-05-07 12:18:03'),
(2, 'Ruth Hart', '300415', 'ruth.hart@gmail.com', '09021564778', '66266e1d2f3c32e9b3f21f116aba5f84', 'avatar.png', '', 'ACTIVATED', 1, '2020-05-02 21:17:00', '2020-05-15 11:08:25'),
(3, 'Turgis Kara', '300976', 'turgis.kara@gmail.com', '09000000000', '075d30229d8598dc1c065bfe0a693cc5', 'avatar.png', '', 'ACTIVATED', 3, '2020-05-02 20:44:09', '2020-03-10 22:41:42'),
(4, 'Peter Uli', '200531', 'peter.uli@gmail.com', '09087654321', 'f52396b16889e114992ee16fbafe6447', 'IMG_1201.JPG', '', 'DEACTIVATED', 3, '2020-05-02 20:53:17', '2020-03-16 03:59:06'),
(6, 'Obute Moses Agbo', '200698', 'obutemoses5@gmail.com', '+2348165777349', 'cbea073ad254e3eb8761603068ccd0ca', 'avatar.png', '300415', 'ACTIVATED', 2, '2020-05-02 20:42:51', '2020-04-10 12:03:33'),
(7, 'Omto Chine', '300743', 'omto.chine@gmail.com', '09087654321', '38b58483cf2d2651d95abb1db676b24f', 'avatar.png', '300415', 'ACTIVATED', 3, '2020-05-02 21:23:45', '2020-05-02 21:23:45');

-- --------------------------------------------------------

--
-- Table structure for table `workteams`
--

CREATE TABLE `workteams` (
  `workteam_id` int(10) NOT NULL,
  `workteam_title` varchar(15) DEFAULT NULL,
  `workteam_head` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `workteams`
--

INSERT INTO `workteams` (`workteam_id`, `workteam_title`, `workteam_head`) VALUES
(1, 'WT-A', 1),
(2, 'WT-B', 3),
(3, 'WT-C', 4),
(4, 'WT-D', 7);

-- --------------------------------------------------------

--
-- Table structure for table `workteam_members`
--

CREATE TABLE `workteam_members` (
  `workteam_id` int(10) NOT NULL,
  `workteam_member` varchar(100) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `workteam_members`
--

INSERT INTO `workteam_members` (`workteam_id`, `workteam_member`, `date_created`) VALUES
(3, '200531', '2020-03-17 09:27:29'),
(2, '300976', '2020-03-17 09:31:18'),
(1, '200156', '2020-04-11 17:54:45'),
(4, '300743', '2020-05-06 09:56:05');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `areas`
--
ALTER TABLE `areas`
  ADD PRIMARY KEY (`area_id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`customer_id`);

--
-- Indexes for table `notes`
--
ALTER TABLE `notes`
  ADD PRIMARY KEY (`note_id`);

--
-- Indexes for table `requests`
--
ALTER TABLE `requests`
  ADD PRIMARY KEY (`request_id`);

--
-- Indexes for table `request_cats`
--
ALTER TABLE `request_cats`
  ADD PRIMARY KEY (`request_cat_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`role_id`);

--
-- Indexes for table `staffs`
--
ALTER TABLE `staffs`
  ADD PRIMARY KEY (`staff_id`),
  ADD UNIQUE KEY `staff_code` (`staff_code`),
  ADD UNIQUE KEY `staff_email` (`staff_email`),
  ADD KEY `role_id` (`role_id`);

--
-- Indexes for table `workteams`
--
ALTER TABLE `workteams`
  ADD PRIMARY KEY (`workteam_id`);

--
-- Indexes for table `workteam_members`
--
ALTER TABLE `workteam_members`
  ADD KEY `workteam_member` (`workteam_member`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `admin_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `areas`
--
ALTER TABLE `areas`
  MODIFY `area_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `customer_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `notes`
--
ALTER TABLE `notes`
  MODIFY `note_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `requests`
--
ALTER TABLE `requests`
  MODIFY `request_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `request_cats`
--
ALTER TABLE `request_cats`
  MODIFY `request_cat_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `role_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `staffs`
--
ALTER TABLE `staffs`
  MODIFY `staff_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `workteams`
--
ALTER TABLE `workteams`
  MODIFY `workteam_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `staffs`
--
ALTER TABLE `staffs`
  ADD CONSTRAINT `staffs_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `roles` (`role_id`);

--
-- Constraints for table `workteam_members`
--
ALTER TABLE `workteam_members`
  ADD CONSTRAINT `workteam_members_ibfk_1` FOREIGN KEY (`workteam_member`) REFERENCES `staffs` (`staff_code`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
