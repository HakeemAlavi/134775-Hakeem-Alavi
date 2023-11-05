-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 05, 2023 at 06:35 PM
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
-- Database: `cholera`
--

-- --------------------------------------------------------

--
-- Table structure for table `userfeedback`
--

CREATE TABLE `userfeedback` (
  `feedback_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `feedback` text DEFAULT NULL,
  `diagnosis` enum('yes','no') NOT NULL,
  `submission_time` timestamp NOT NULL DEFAULT current_timestamp(),
  `read_status` tinyint(1) NOT NULL DEFAULT 0 CHECK (`read_status` in (0,1))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `userfeedback`
--

INSERT INTO `userfeedback` (`feedback_id`, `user_id`, `feedback`, `diagnosis`, `submission_time`, `read_status`) VALUES
(1, 4, 'I had gone camping and developed a stomach ache coupled with diarrdoea. I was worried I had developed cholera, but now, I am more confident that it was just a minor stomach upset.', 'no', '2023-11-05 16:58:14', 0),
(2, 9, 'I had all the symptoms being questioned in the classification and this has made me take this seriously and visit a doctor imminently.', 'yes', '2023-11-05 17:33:03', 0);

-- --------------------------------------------------------

--
-- Table structure for table `userquiz`
--

CREATE TABLE `userquiz` (
  `quiz_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `score` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `userquiz`
--

INSERT INTO `userquiz` (`quiz_id`, `user_id`, `score`) VALUES
(4, 1, NULL),
(5, 2, NULL),
(6, 3, NULL),
(7, 4, 11),
(13, 9, 8);

-- --------------------------------------------------------

--
-- Table structure for table `userreview`
--

CREATE TABLE `userreview` (
  `review_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `review` int(11) DEFAULT NULL,
  `submit_status` tinyint(1) NOT NULL DEFAULT 0 CHECK (`submit_status` in (0,1))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `userreview`
--

INSERT INTO `userreview` (`review_id`, `user_id`, `review`, `submit_status`) VALUES
(4, 1, 0, 0),
(5, 2, 0, 0),
(6, 3, 0, 0),
(7, 4, 5, 1),
(13, 9, 4, 1);

-- --------------------------------------------------------

--
-- Table structure for table `usertable`
--

CREATE TABLE `usertable` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `code` mediumint(50) NOT NULL,
  `status` text NOT NULL,
  `authorization` varchar(20) NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `usertable`
--

INSERT INTO `usertable` (`id`, `name`, `email`, `password`, `code`, `status`, `authorization`) VALUES
(1, 'Hakeem Alavi', 'abdulhakeemalavi49@gmail.com', '$2y$10$4rCt5nFh71p/pVwweDEOGu0xdb80dpRFaXC8yvyzTulVU.0Z5YCNq', 0, 'verified', 'admin'),
(2, 'John Doe', 'xiiicapitan@gmail.com', '$2y$10$WqM5ULICiiD7QLjX7KUhCeZ2mPYHqDLFzoRBw0blHPIatitItq4.y', 0, 'verified', 'user'),
(3, 'Aicha Mbongo', 'zindamoyen2@gmail.com', '$2y$10$ZuHpxSwimfeHX1lz8hydB.p/d361Z/1FDm.rcgpjEciGvOGYbVlEW', 0, 'verified', 'admin'),
(4, 'Barry Allen', 'abdulhakeemalavi94@gmail.com', '$2y$10$fdSWhMtuuJaddUX9M2J8.OO4xooUwWizU6wd2AnoSU4jvatddzjxC', 0, 'verified', 'user'),
(9, 'James Smith', 'hakeem.alavi@strathmore.edu', '$2y$10$u4Q.J2VZvd3QP3Ypndi74OyVXsCppTfOy9qTcJrYI2D/aGjyX5C/S', 0, 'verified', 'user');

--
-- Triggers `usertable`
--
DELIMITER $$
CREATE TRIGGER `add_user_trigger` AFTER INSERT ON `usertable` FOR EACH ROW BEGIN

    INSERT INTO userreview (review_id, user_id, review, submit_status) VALUES (NULL, NEW.id, 0, 0);

    INSERT INTO userquiz (quiz_id, user_id, score) VALUES (NULL, NEW.id, NULL);

END
$$
DELIMITER ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `userfeedback`
--
ALTER TABLE `userfeedback`
  ADD PRIMARY KEY (`feedback_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `userquiz`
--
ALTER TABLE `userquiz`
  ADD PRIMARY KEY (`quiz_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `userreview`
--
ALTER TABLE `userreview`
  ADD PRIMARY KEY (`review_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `usertable`
--
ALTER TABLE `usertable`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `userfeedback`
--
ALTER TABLE `userfeedback`
  MODIFY `feedback_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `userquiz`
--
ALTER TABLE `userquiz`
  MODIFY `quiz_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `userreview`
--
ALTER TABLE `userreview`
  MODIFY `review_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `usertable`
--
ALTER TABLE `usertable`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `userfeedback`
--
ALTER TABLE `userfeedback`
  ADD CONSTRAINT `userfeedback_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `usertable` (`id`);

--
-- Constraints for table `userquiz`
--
ALTER TABLE `userquiz`
  ADD CONSTRAINT `userquiz_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `usertable` (`id`);

--
-- Constraints for table `userreview`
--
ALTER TABLE `userreview`
  ADD CONSTRAINT `userreview_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `usertable` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
