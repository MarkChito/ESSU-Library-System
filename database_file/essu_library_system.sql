-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 11, 2024 at 06:24 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `essu_library_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_info_activitylogs`
--

CREATE TABLE `tbl_info_activitylogs` (
  `id` int(11) NOT NULL,
  `log_date` varchar(30) NOT NULL,
  `user_id` int(11) NOT NULL,
  `activity` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_info_activitylogs`
--

INSERT INTO `tbl_info_activitylogs` (`id`, `log_date`, `user_id`, `activity`) VALUES
(1, '2024-03-12 00:20:10', 2, 'Mark Chito R. Anteja created an account.'),
(2, '2024-03-12 00:24:10', 1, 'Super Admin logged in to the system.'),
(3, '2024-03-12 00:25:48', 2, 'Mark Chito R. Anteja logged in to the system.'),
(4, '2024-03-12 00:42:47', 1, 'Super Admin logged in to the system.'),
(5, '2024-03-12 00:43:07', 2, 'Mark Chito R. Anteja logged in to the system.'),
(6, '2024-03-12 00:59:46', 1, 'Super Admin logged in to the system.'),
(7, '2024-03-12 01:09:57', 1, 'Super Admin logged in to the system.'),
(8, '2024-03-12 01:14:14', 1, 'Super Admin added a new book entitled Brave New World'),
(9, '2024-03-12 01:21:01', 1, 'Super Admin logged out from the system.'),
(10, '2024-03-12 01:21:10', 2, 'Mark Chito R. Anteja logged in to the system.'),
(11, '2024-03-12 01:21:42', 2, 'Mark Chito R. Anteja logged out from the system.'),
(12, '2024-03-12 01:21:47', 1, 'Super Admin logged in to the system.'),
(13, '2024-03-12 01:22:33', 1, 'Super Admin added a new book entitled Pride and Prejudice');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_info_books`
--

CREATE TABLE `tbl_info_books` (
  `id` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `author` varchar(30) NOT NULL,
  `genre` varchar(50) NOT NULL,
  `year_published` int(11) NOT NULL,
  `image` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_info_books`
--

INSERT INTO `tbl_info_books` (`id`, `title`, `author`, `genre`, `year_published`, `image`) VALUES
(1, 'To Kill a Mockingbird', 'Harper Lee', 'Fiction, Southern Gothic', 1960, '1.png'),
(2, '1984', 'George Orwell', 'Dystopian Fiction', 1949, '2.png'),
(3, 'The Great Gatsby', 'F. Scott Fitzgerald', 'Classic, Jazz Age', 1925, '3.png'),
(4, 'The Hitchhiker\'s Guide to the Galaxy', 'Douglas Adams', 'Science Fiction, Comedy', 1979, '4.png'),
(5, 'The Hunger Games', 'Suzanne Collins', 'Young Adult, Dystopian', 2008, '5.png'),
(6, 'One Hundred Years of Solitude', 'Gabriel García Márquez', 'Magical Realism', 1967, '6.png'),
(7, 'The Catcher in the Rye', 'J.D. Salinger', 'Coming-of-age, Fiction', 1951, '7.png'),
(8, 'Harry Potter and the Philosopher\'s Stone', 'J.K. Rowling', 'Fantasy', 1997, '8.png'),
(9, 'The Alchemist', 'Paulo Coelho', 'Fiction, Philosophy', 1988, '9.png'),
(10, 'The Girl with the Dragon Tattoo', 'Stieg Larsson', 'Mystery, Thriller', 2005, '10.png'),
(12, 'Brave New World', 'Aldous Huxley', 'Dystopian Fiction', 1932, '11_1.png'),
(13, 'Pride and Prejudice', 'Jane Austen', 'Classic, Romance', 1813, '12.png');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_info_profiles`
--

CREATE TABLE `tbl_info_profiles` (
  `id` int(11) NOT NULL,
  `useraccount_id` int(11) NOT NULL,
  `student_number` varchar(10) NOT NULL,
  `course` varchar(20) NOT NULL,
  `year` int(11) NOT NULL,
  `section` varchar(20) NOT NULL,
  `first_name` varchar(30) NOT NULL,
  `middle_name` varchar(30) NOT NULL,
  `last_name` varchar(30) NOT NULL,
  `birthday` varchar(20) NOT NULL,
  `mobile_number` varchar(15) NOT NULL,
  `email` varchar(20) NOT NULL,
  `address` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_info_profiles`
--

INSERT INTO `tbl_info_profiles` (`id`, `useraccount_id`, `student_number`, `course`, `year`, `section`, `first_name`, `middle_name`, `last_name`, `birthday`, `mobile_number`, `email`, `address`) VALUES
(1, 2, '17-00136', 'BSIT', 1, 'A', 'Mark Chito', 'Rizano', 'Anteja', '1994-07-23', '09511816599', '00anteja23@gmail.com', 'Blk 33 Lot 86 Phase 6 Victoria Villas Manila Hills, San Jose, Rodriguez, Rizal');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_info_useraccounts`
--

CREATE TABLE `tbl_info_useraccounts` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(100) NOT NULL,
  `user_type` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_info_useraccounts`
--

INSERT INTO `tbl_info_useraccounts` (`id`, `name`, `username`, `password`, `user_type`) VALUES
(1, 'Super Admin', 'admin', '$2y$10$qZaaUdNw9dwAlnMZDFfqSOj5mVKvlNC86XHgRRWs/UaKyQMHZINby', 'admin'),
(2, 'Mark Chito R. Anteja', 'chito23', '$2y$10$f4Eho1fcI4qERPdJpYpyGu8knu.yr8MvR5QkyKBdoG2VqNXIj8r4u', 'student');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_info_activitylogs`
--
ALTER TABLE `tbl_info_activitylogs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_info_books`
--
ALTER TABLE `tbl_info_books`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_info_profiles`
--
ALTER TABLE `tbl_info_profiles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_info_useraccounts`
--
ALTER TABLE `tbl_info_useraccounts`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_info_activitylogs`
--
ALTER TABLE `tbl_info_activitylogs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `tbl_info_books`
--
ALTER TABLE `tbl_info_books`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `tbl_info_profiles`
--
ALTER TABLE `tbl_info_profiles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_info_useraccounts`
--
ALTER TABLE `tbl_info_useraccounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
