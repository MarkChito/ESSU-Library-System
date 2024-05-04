-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 04, 2024 at 07:05 PM
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_info_books`
--

CREATE TABLE `tbl_info_books` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `author` varchar(255) NOT NULL,
  `genre` varchar(255) NOT NULL,
  `year_published` int(11) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_info_books`
--

INSERT INTO `tbl_info_books` (`id`, `title`, `author`, `genre`, `year_published`, `description`, `image`) VALUES
(1, 'To Kill a Mockingbird', 'Harper Lee', 'Historical Fiction', 1960, 'Set in the racially charged atmosphere of 1930s Alabama, \"To Kill a Mockingbird\" follows young Scout Finch as she witnesses her father, lawyer Atticus Finch, defend a black man falsely accused of raping a white woman, grappling with themes of prejudice, justice, and moral growth.', '1.png'),
(2, '1984', 'George Orwell', 'Dystopian', 1949, 'A dystopian classic, \"1984\" depicts a totalitarian regime where individuality and freedom are suppressed, and reality is manipulated by the all-seeing Big Brother, prompting protagonist Winston Smith to rebel against the oppressive regime.', '2.png'),
(3, 'The Great Gatsby', 'F. Scott Fitzgerald', 'Historical Romance', 1925, 'Set in the Jazz Age of the 1920s, \"The Great Gatsby\" explores themes of love, wealth, and the American Dream through the tragic story of Jay Gatsby\'s pursuit of the elusive Daisy Buchanan.', '3.png'),
(4, 'The Hitchhiker\'s Guide to the Galaxy', 'Douglas Adams', 'Science Fiction,Comedy', 1979, 'A humorous science fiction novel, \"The Hitchhiker\'s Guide to the Galaxy\" follows the misadventures of Arthur Dent, an ordinary human who finds himself traveling the cosmos with an eclectic cast of characters after Earth is unexpectedly destroyed to make way for a hyperspace bypass.', '4.png'),
(5, 'The Hunger Games', 'Suzanne Collins', 'Young Adult,Dystopian', 2008, 'Set in a dystopian society where children are forced to fight to the death in a televised spectacle, \"The Hunger Games\" follows Katniss Everdeen as she volunteers to take her sister\'s place in the deadly competition, sparking a rebellion against the oppressive Capitol.', '5.png'),
(6, 'One Hundred Years of Solitude', 'Gabriel García Márquez', 'Fantasy', 1967, 'A masterpiece of magical realism, this novel chronicles the multi-generational saga of the Buendía family in the fictional town of Macondo, exploring themes of love, loss, and the cyclical nature of history.', '6.png'),
(7, 'The Catcher in the Rye', 'J.D. Salinger', 'Literary Fiction', 1951, 'A coming-of-age novel, \"The Catcher in the Rye\" follows Holden Caulfield, a disillusioned teenager, as he navigates the complexities of adolescence, alienation, and societal expectations in post-World War II America.', '7.png'),
(8, 'Harry Potter and the Philosopher\'s Stone', 'J.K. Rowling', 'Fantasy', 1997, 'The first installment in the beloved Harry Potter series, this book introduces readers to the magical world of Hogwarts School of Witchcraft and Wizardry, following young Harry Potter as he discovers his true identity and confronts the dark wizard who killed his parents.', '8.png'),
(9, 'The Alchemist', 'Paulo Coelho', 'Philosophy', 1988, 'A philosophical fable about following one\'s dreams and the journey of self-discovery, \"The Alchemist\" tells the story of Santiago, a shepherd boy who embarks on a quest for treasure, only to realize that the true riches lie in the lessons learned along the way.', '9.png'),
(10, 'The Girl with the Dragon Tattoo', 'Stieg Larsson', 'Mystery,Thriller', 2005, 'A gripping mystery thriller, this novel follows investigative journalist Mikael Blomkvist and hacker Lisbeth Salander as they delve into a decades-old disappearance, uncovering dark secrets and corruption in Swedish society.', '10.png'),
(11, 'Brave New World', 'Aldous Huxley', 'Dystopian', 1932, 'Set in a dystopian future, \"Brave New World\" explores a society where citizens are engineered and conditioned for specific roles, challenging notions of individuality, freedom, and the consequences of a technologically advanced yet morally bankrupt society.', '11.png'),
(12, 'Pride and Prejudice', 'Jane Austen', 'Romance', 1813, 'A timeless classic, \"Pride and Prejudice\" follows the story of Elizabeth Bennet as she navigates societal expectations, love, and personal growth in Regency-era England, all while grappling with her initial prejudices towards the enigmatic Mr. Darcy.', '12.png');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_info_inventory`
--

CREATE TABLE `tbl_info_inventory` (
  `id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `inventory` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_info_inventory`
--

INSERT INTO `tbl_info_inventory` (`id`, `book_id`, `inventory`) VALUES
(1, 1, 10),
(2, 2, 10),
(3, 3, 10),
(4, 4, 10),
(5, 5, 10),
(6, 6, 10),
(7, 7, 10),
(8, 8, 10),
(9, 9, 10),
(10, 10, 10),
(11, 12, 10),
(12, 13, 10);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_info_offtake`
--

CREATE TABLE `tbl_info_offtake` (
  `id` int(11) NOT NULL,
  `date_created` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_info_useraccounts`
--

INSERT INTO `tbl_info_useraccounts` (`id`, `name`, `username`, `password`, `user_type`) VALUES
(1, 'Administrator', 'admin', '$2y$10$4yve9mdeiFHBl7eZhAlMb.rYoEZRf5Je1ZrARJNJ/RpNZfJ5f5vBq', 'admin');

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
-- Indexes for table `tbl_info_inventory`
--
ALTER TABLE `tbl_info_inventory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_info_offtake`
--
ALTER TABLE `tbl_info_offtake`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_info_books`
--
ALTER TABLE `tbl_info_books`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tbl_info_inventory`
--
ALTER TABLE `tbl_info_inventory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tbl_info_offtake`
--
ALTER TABLE `tbl_info_offtake`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_info_profiles`
--
ALTER TABLE `tbl_info_profiles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_info_useraccounts`
--
ALTER TABLE `tbl_info_useraccounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
