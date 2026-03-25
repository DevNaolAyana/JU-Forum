-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 25, 2026 at 07:26 PM
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
-- Database: `forum`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(5) NOT NULL,
  `email` varchar(200) NOT NULL,
  `adminname` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--
-- All admins use the SAME password hash (TestAdmin's password)
-- Password for all admins: TestAdmin

INSERT INTO `admins` (`id`, `email`, `adminname`, `password`, `created_at`) VALUES
(1, 'naolmelaku@gmail.com', 'naolmelaku', '$2y$10$r/48CVyOCmVs99ZYmoUAbOXSkkl0Ra5eBylYQTmkGLetJQaTGsngC', '2026-01-05 10:38:09'),
(2, 'meklit.kassahun@gmail.com', 'meklitkassahun', '$2y$10$r/48CVyOCmVs99ZYmoUAbOXSkkl0Ra5eBylYQTmkGLetJQaTGsngC', '2026-01-06 15:45:14'),
(3, 'abdisa.ketema@gmail.com', 'abdisaketema', '$2y$10$r/48CVyOCmVs99ZYmoUAbOXSkkl0Ra5eBylYQTmkGLetJQaTGsngC', '2026-01-09 15:35:40'),
(6, 'TestAdmin@gmail.com', 'TestAdmin', '$2y$10$r/48CVyOCmVs99ZYmoUAbOXSkkl0Ra5eBylYQTmkGLetJQaTGsngC', '2026-03-25 18:17:07');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(5) NOT NULL,
  `name` varchar(200) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `created_at`) VALUES
(1, 'Internship ', '2026-01-21 21:02:48'),
(2, 'Department Selection', '2026-01-21 21:03:00'),
(3, 'Cafe and Non-Cafe', '2026-01-21 21:03:10'),
(4, 'Dormitory', '2026-01-21 21:03:17'),
(5, 'Library', '2026-01-21 21:03:34'),
(14, 'Registrar', '2026-01-21 21:04:00');

-- --------------------------------------------------------

--
-- Table structure for table `replies`
--

CREATE TABLE `replies` (
  `id` int(5) NOT NULL,
  `reply` varchar(200) NOT NULL,
  `user_id` int(5) NOT NULL,
  `user_image` varchar(200) NOT NULL,
  `topic_id` int(5) NOT NULL,
  `user_name` varchar(200) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `replies`
--

INSERT INTO `replies` (`id`, `reply`, `user_id`, `user_image`, `topic_id`, `user_name`, `created_at`) VALUES
(52, 'Flexibility is good, but we need academic advisors to guide students through the process. A probation period could ensure serious decisions.', 3, 'male3.png', 38, 'naolmelaku', '2026-01-21 21:18:42'),
(53, 'Definitely need more online journal subscriptions. Also, 24/7 access during finals week would be very helpful for students.', 3, 'male3.png', 39, 'naolmelaku', '2026-01-21 21:19:20'),
(54, 'Regular health inspections and student feedback systems are essential. Also, more variety for dietary restrictions would help.', 12, 'female1.jpg', 42, 'meklitkassahun', '2026-01-21 21:20:22'),
(55, 'A simpler interface with fewer steps would help. Also, automated status updates for document processing would reduce office visits.', 12, 'female1.jpg', 43, 'meklitkassahun', '2026-01-21 21:20:45'),
(56, 'I agree. We need a dedicated internship office that actively connects students with companies. Regular industry visits and mentorship programs would also help.', 11, 'male4.jpg', 40, 'abdisaketema', '2026-01-21 21:21:22'),
(57, 'Wi-Fi connectivity and 24-hour study rooms should be top priorities. Also, regular maintenance schedules need to be established.', 11, 'male4.jpg', 41, 'abdisaketema', '2026-01-21 21:22:18');

-- --------------------------------------------------------

--
-- Table structure for table `topics`
--

CREATE TABLE `topics` (
  `id` int(5) NOT NULL,
  `title` varchar(200) NOT NULL,
  `category` varchar(200) NOT NULL,
  `body` text NOT NULL,
  `user_name` varchar(200) NOT NULL,
  `user_image` varchar(200) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `topics`
--

INSERT INTO `topics` (`id`, `title`, `category`, `body`, `user_name`, `user_image`, `created_at`) VALUES
(38, 'Allow Department Changes After First Year', 'Department Selection', ' Current department transfer rules are too restrictive. Many students realize their true interests after experiencing different courses. Should the university allow more flexibility for department changes after the first semester? What safeguards should be in place? ', 'abdisaketema', 'male4.jpg', '2026-01-21 21:09:37'),
(39, 'More Digital Resources Needed', 'Library', 'The library\'s digital collection is limited, and study spaces are often overcrowded during exams. How can the university improve both physical and digital resources? Should there be extended hours during critical academic periods?', 'abdisaketema', 'male4.jpg', '2026-01-21 21:11:47'),
(40, 'Better Internship Partnerships Needed', 'Internship ', 'Many students struggle to find quality internships that match their field of study. The university should establish more partnerships with local companies and organizations to create structured internship programs. What initiatives would help bridge the gap between academic learning and practical experience?', 'meklitkassahun', 'female1.jpg', '2026-01-21 21:13:00'),
(41, 'Upgrade Dormitory Facilities', 'Dormitory', 'Many dormitories lack basic amenities like reliable hot water, proper ventilation, and study spaces. How can the university upgrade housing facilities to meet modern student needs? What should be the priority improvements?', 'meklitkassahun', 'female1.jpg', '2026-01-21 21:13:47'),
(42, 'Improve Campus Food Quality', 'Cafe and Non-Cafe', 'Students have reported inconsistent food quality and occasional hygiene concerns in campus cafeterias. What measures should the university take to improve food standards? Should there be a student committee to monitor food services?', 'naolmelaku', 'male3.png', '2026-01-21 21:14:59'),
(43, 'Fix Online Registration System', 'Registrar', 'The current online registration system frequently experiences technical issues, and document processing takes too long. What specific improvements would make these services more efficient? Should there be a mobile app for registration?', 'naolmelaku', 'male3.png', '2026-01-21 21:18:06');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(5) NOT NULL,
  `name` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `username` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `about` text NOT NULL,
  `avatar` varchar(200) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--
-- All users use the SAME password hash (TestTest's password)
-- Password for all users: TestTest

INSERT INTO `users` (`id`, `name`, `email`, `username`, `password`, `about`, `avatar`, `created_at`) VALUES
(3, 'Naol Melaku', 'naolmelaku@gmail.com', 'naolmelaku', '$2y$10$yUW0wCKdVNoyOWmuRgBONuRUXVwqe8sPPbA.czne3Nb/LTXYTSgzG', 'updated Software Engineering student at Jimma University. Interested in web development and artificial intelligence. ', 'male3.png', '2026-01-22 11:23:51'),
(11, 'Abdisa Ketema', 'abdisa.ketema@gmail.com', 'abdisaketema', '$2y$10$yUW0wCKdVNoyOWmuRgBONuRUXVwqe8sPPbA.czne3Nb/LTXYTSgzG', 'I\'m a third-year software engineering student at Jimma University. Interested in web development and artificial intelligence. Active in the programming club.', 'male4.jpg', '2026-01-21 20:49:58'),
(12, 'Meklit Kassahun', 'meklit.kassahun@gmail.com', 'meklitkassahun', '$2y$10$yUW0wCKdVNoyOWmuRgBONuRUXVwqe8sPPbA.czne3Nb/LTXYTSgzG', 'I\'m a third-year software engineering student at Jimma University. Interested in web development and artificial intelligence.', 'female1.jpg', '2026-01-22 09:51:08'),
(31, 'Test Test', 'Test@gmail.com', 'TestTest', '$2y$10$yUW0wCKdVNoyOWmuRgBONuRUXVwqe8sPPbA.czne3Nb/LTXYTSgzG', 'TestTest ', 'male1.jpg', '2026-03-25 18:10:08');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `replies`
--
ALTER TABLE `replies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `topics`
--
ALTER TABLE `topics`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `replies`
--
ALTER TABLE `replies`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `topics`
--
ALTER TABLE `topics`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;