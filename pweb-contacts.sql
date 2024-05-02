-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 02, 2024 at 02:23 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pweb-contacts`
--

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `contact_id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone_number` varchar(50) DEFAULT NULL,
  `address` text,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `user_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`contact_id`, `name`, `email`, `phone_number`, `address`, `created_at`, `updated_at`, `user_id`) VALUES
(1, 'Admin', 'admin@example.com', '202-555-0000', '100 Admin Rd, Capitapolis', '2024-04-26 15:34:13', '2024-04-26 15:34:13', 1),
(2, 'Elizabeth Ross', 'elizabeth.ross@example.com', '202-555-0143', '123 Main St, Springfield', '2024-04-26 15:34:13', '2024-04-26 15:34:13', 2),
(3, 'Jacob Ferguson', 'jacob.ferguson@example.com', '202-555-0144', '124 Main St, Springfield', '2024-04-26 15:34:13', '2024-04-26 15:34:13', 3),
(4, 'Emily Hudson', 'emily.hudson@example.com', '202-555-0145', '125 Main St, Springfield', '2024-04-26 15:34:13', '2024-04-26 15:34:13', 4),
(5, 'Matthew Gray', 'matthew.gray@example.com', '202-555-0146', '126 Main St, Springfield', '2024-04-26 15:34:13', '2024-04-26 15:34:13', 5),
(6, 'Olivia Ford', 'olivia.ford@example.com', '202-555-0147', '127 Main St, Springfield', '2024-04-26 15:34:13', '2024-04-26 15:34:13', 6),
(7, 'Jack Coleman', 'jack.coleman@example.com', '202-555-0148', '128 Main St, Springfield', '2024-04-26 15:34:13', '2024-04-26 15:34:13', 7),
(8, 'Sophia Bailey', 'sophia.bailey@example.com', '202-555-0149', '129 Main St, Springfield', '2024-04-26 15:34:13', '2024-04-26 15:34:13', 8),
(9, 'Mason Slater', 'mason.slater@example.com', '202-555-0150', '130 Main St, Springfield', '2024-04-26 15:34:13', '2024-04-26 15:34:13', 9),
(10, 'Isabella Byrd', 'isabella.byrd@example.com', '202-555-0151', '131 Main St, Springfield', '2024-04-26 15:34:13', '2024-04-26 15:34:13', 10),
(11, 'Liam Lucas', 'liam.lucas@example.com', '202-555-0152', '132 Main St, Springfield', '2024-04-26 15:34:13', '2024-04-26 15:34:13', 11),
(12, 'Emma Cook', 'emma.cook@example.com', '202-555-0153', '133 Main St, Springfield', '2024-04-26 15:34:13', '2024-04-26 15:34:13', 12),
(13, 'Noah Webb', 'noah.webb@example.com', '202-555-0154', '134 Main St, Springfield', '2024-04-26 15:34:13', '2024-04-26 15:34:13', 13),
(14, 'Ava Mills', 'ava.mills@example.com', '202-555-0155', '135 Main St, Springfield', '2024-04-26 15:34:13', '2024-04-26 15:34:13', 14),
(15, 'Logan Price', 'logan.price@example.com', '202-555-0156', '136 Main St, Springfield', '2024-04-26 15:34:13', '2024-04-26 15:34:13', 15),
(16, 'Mia Fletcher', 'mia.fletcher@example.com', '202-555-0157', '137 Main St, Springfield', '2024-04-26 15:34:13', '2024-04-26 15:34:13', 16),
(17, 'Aiden Little', 'aiden.little@example.com', '202-555-0158', '138 Main St, Springfield', '2024-04-26 15:34:13', '2024-04-26 15:34:13', 17),
(18, 'Lily Bell', 'lily.bell@example.com', '202-555-0159', '139 Main St, Springfield', '2024-04-26 15:34:13', '2024-04-26 15:34:13', 18),
(19, 'Ethan Hart', 'ethan.hart@example.com', '202-555-0160', '140 Main St, Springfield', '2024-04-26 15:34:13', '2024-04-26 15:34:13', 19),
(20, 'Ella Wood', 'ella.wood@example.com', '202-555-0161', '141 Main St, Springfield', '2024-04-26 15:34:13', '2024-04-26 15:34:13', 20),
(21, 'James Clarke', 'james.clarke@example.com', '202-555-0162', '142 Main St, Springfield', '2024-04-26 15:34:13', '2024-04-26 15:34:13', 21),
(22, 'Amelia Farmer', 'amelia.farmer@example.com', '202-555-0163', '143 Main St, Springfield', '2024-04-26 15:34:13', '2024-04-26 15:34:13', 22),
(23, 'Benjamin Cartwright', 'benjamin.cartwright@example.com', '202-555-0164', '144 Main St, Springfield', '2024-04-26 15:34:13', '2024-04-26 15:34:13', 23),
(24, 'Chloe Roberts', 'chloe.roberts@example.com', '202-555-0165', '145 Main St, Springfield', '2024-04-26 15:34:13', '2024-04-26 15:34:13', 24),
(25, 'Jacob Harper', 'jacob.harper@example.com', '202-555-0166', '146 Main St, Springfield', '2024-04-26 15:34:13', '2024-04-26 15:34:13', 25),
(26, 'Isla Turner', 'isla.turner@example.com', '202-555-0167', '147 Main St, Springfield', '2024-04-26 15:34:13', '2024-04-26 15:34:13', 26),
(27, 'Daniel Powell', 'daniel.powell@example.com', '202-555-0168', '148 Main St, Springfield', '2024-04-26 15:34:13', '2024-04-26 15:34:13', 27),
(28, 'Harper Knight', 'harper.knight@example.com', '202-555-0169', '149 Main St, Springfield', '2024-04-26 15:34:13', '2024-04-26 15:34:13', 28),
(29, 'Lucas King', 'lucas.king@example.com', '202-555-0170', '150 Main St, Springfield', '2024-04-26 15:34:13', '2024-04-26 15:34:13', 29),
(30, 'Charlotte Cunningham', 'charlotte.cunningham@example.com', '202-555-0171', '151 Main St, Springfield', '2024-04-26 15:34:13', '2024-04-26 15:34:13', 30),
(31, 'Oliver Graham', 'oliver.graham@example.com', '202-555-0172', '152 Main St, Springfield', '2024-04-26 15:34:13', '2024-04-26 15:34:13', 31);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `role_id` int NOT NULL,
  `role_name` varchar(255) NOT NULL,
  `description` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`role_id`, `role_name`, `description`) VALUES
(1, 'Administrator', 'A user who can access all features.'),
(2, 'Manager', 'A user who can manage entries and moderate discussions.'),
(3, 'Staff', 'A user who can enter data and generate reports.'),
(4, 'Guest', 'A user who can view content and make inquiries.');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `last_login` timestamp NULL DEFAULT NULL,
  `role_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `created_at`, `last_login`, `role_id`) VALUES
(1, 'admin', 'password', '2024-04-26 15:34:13', NULL, 1),
(2, 'elizabeth_ross', 'password', '2024-04-26 15:34:13', NULL, 2),
(3, 'jacob_ferguson', 'password', '2024-04-26 15:34:13', NULL, 2),
(4, 'emily_hudson', 'password', '2024-04-26 15:34:13', NULL, 3),
(5, 'matthew_gray', 'password', '2024-04-26 15:34:13', NULL, 3),
(6, 'olivia_ford', 'password', '2024-04-26 15:34:13', NULL, 4),
(7, 'jack_coleman', 'password', '2024-04-26 15:34:13', NULL, 4),
(8, 'sophia_bailey', 'password', '2024-04-26 15:34:13', NULL, 2),
(9, 'mason_slater', 'password', '2024-04-26 15:34:13', NULL, 2),
(10, 'isabella_byrd', 'password', '2024-04-26 15:34:13', NULL, 3),
(11, 'liam_lucas', 'password', '2024-04-26 15:34:13', NULL, 3),
(12, 'emma_cook', 'password', '2024-04-26 15:34:13', NULL, 4),
(13, 'noah_webb', 'password', '2024-04-26 15:34:13', NULL, 4),
(14, 'ava_mills', 'password', '2024-04-26 15:34:13', NULL, 2),
(15, 'logan_price', 'password', '2024-04-26 15:34:13', NULL, 2),
(16, 'mia_fletcher', 'password', '2024-04-26 15:34:13', NULL, 3),
(17, 'aiden_little', 'password', '2024-04-26 15:34:13', NULL, 3),
(18, 'lily_bell', 'password', '2024-04-26 15:34:13', NULL, 4),
(19, 'ethan_hart', 'password', '2024-04-26 15:34:13', NULL, 4),
(20, 'ella_wood', 'password', '2024-04-26 15:34:13', NULL, 2),
(21, 'james_clarke', 'password', '2024-04-26 15:34:13', NULL, 2),
(22, 'amelia_farmer', 'password', '2024-04-26 15:34:13', NULL, 3),
(23, 'benjamin_cartwright', 'password', '2024-04-26 15:34:13', NULL, 3),
(24, 'chloe_roberts', 'password', '2024-04-26 15:34:13', NULL, 4),
(25, 'jacob_harper', 'password', '2024-04-26 15:34:13', NULL, 4),
(26, 'isla_turner', 'password', '2024-04-26 15:34:13', NULL, 2),
(27, 'daniel_powell', 'password', '2024-04-26 15:34:13', NULL, 2),
(28, 'harper_knight', 'password', '2024-04-26 15:34:13', NULL, 3),
(29, 'lucas_king', 'password', '2024-04-26 15:34:13', NULL, 3),
(30, 'charlotte_cunningham', 'password', '2024-04-26 15:34:13', NULL, 4),
(31, 'oliver_graham', 'password', '2024-04-26 15:34:13', NULL, 4);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`contact_id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`role_id`),
  ADD UNIQUE KEY `role_name` (`role_name`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD KEY `role_id` (`role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `contact_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `role_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `contacts`
--
ALTER TABLE `contacts`
  ADD CONSTRAINT `contacts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `roles` (`role_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
