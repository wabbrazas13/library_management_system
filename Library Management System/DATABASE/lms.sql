-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 11, 2022 at 12:28 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lms`
--
CREATE DATABASE IF NOT EXISTS `lms` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `lms`;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `admin_id` varchar(100) NOT NULL,
  `admin_fn` varchar(100) DEFAULT NULL,
  `admin_mn` varchar(100) DEFAULT NULL,
  `admin_ln` varchar(100) DEFAULT NULL,
  `admin_gender` varchar(100) DEFAULT NULL,
  `admin_dob` date DEFAULT NULL,
  `admin_email` varchar(100) DEFAULT NULL,
  `admin_password` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`admin_id`, `admin_fn`, `admin_mn`, `admin_ln`, `admin_gender`, `admin_dob`, `admin_email`, `admin_password`) VALUES
('A1-02055', 'Welmar Alex', 'Bautista', 'Brazas', 'MALE', '2000-05-20', 'welmaralexbrazas@gmail.com', 'ThrulX$13');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_book`
--

CREATE TABLE `tbl_book` (
  `ISBN` varchar(100) NOT NULL,
  `book_title` varchar(100) DEFAULT NULL,
  `book_image` varchar(100) DEFAULT NULL,
  `book_category` varchar(100) DEFAULT NULL,
  `book_edition` varchar(100) DEFAULT NULL,
  `book_author` varchar(100) DEFAULT NULL,
  `book_publisher` varchar(100) DEFAULT NULL,
  `pub_date` varchar(100) DEFAULT NULL,
  `book_quantity` int(11) DEFAULT NULL,
  `book_keyword` varchar(100) DEFAULT NULL,
  `book_description` varchar(2000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_book`
--

INSERT INTO `tbl_book` (`ISBN`, `book_title`, `book_image`, `book_category`, `book_edition`, `book_author`, `book_publisher`, `pub_date`, `book_quantity`, `book_keyword`, `book_description`) VALUES
('9780134112831', 'Chemistry: A Molecular Approach', 'ISBN_9780134112831.jpg', 'Science', '4th', 'Nivaldo J. Tro', 'Prentice Hall', '2016', 25, 'chemistry, science, molecules', 'reinforces development of 21st century skills including data interpretation and analysis, problem solving and quantitative reasoning, applying conceptual understanding to new situations, and peer-to-peer collaboration. Nivaldo Tro presents chemistry visually through multi-level images-macroscopic, molecular, and symbolic representations-helping readers see the connections between the world they see around them (macroscopic), the atoms, and molecules that compose the world (molecular), and the formulas they write down on paper (symbolic).'),
('9780134711409', 'Society The Basics', 'ISBN_9780134711409.jpg', 'Sociology', '15th', 'John J. Macionis', 'Pearson', '2019', 30, 'Society', 'Change the way your students see the world Society: The Basics, author John Macionis empowers your students to change the way they view the world by showing them how to see sociology in everyday life.'),
('9780446310789', 'To Kill a Mockingbird', 'ISBN_9780446310789.jpg', 'Social Science', '1st', 'Harper Lee', 'Grand Central Publishing', '1988', 6, 'childhood', 'To Kill a Mockingbird is full of life lessons. Atticus is pretty much the perfect human and the wisdom he imparts to Scout and Jem is profound. I liked how Harper Lee took her time building up to the actual trial. She shows us years of life in Maycomb so that the reader can truly understand the South in the 1930s.'),
('9780671020330', 'The Hardy Boys Casefiles', 'ISBN_9780671020330.jpg', 'Fiction', '1st', 'Franklin W. Dixon', 'New York : Pocket Books', '1998', 5, 'detective, mystery, story', 'The Hardy Boys Casefiles is a young adult novel series, produced, for Simon & Schuster, by Mega-Books of New York, Inc. (later just Mega-Books) and published by Archway Paperbacks (an imprint of Simon & Schuster), between 1987 and 1998. '),
('9780746000311', 'The Usborne Childrens Encyclopedia', 'ISBN_9780746000311.jpg', 'Children Encyclopedia', '1st', 'Jane Elliott', 'London : Usborne', '1986', 3, 'children encyclopedia', 'The Usborne Children’s Encyclopedia is an absolutely essential book to keep in the home. It will be a resource for homework and reports, for turning to with questions about how things work, and a place to go for information on whatever topic interests them. '),
('9781259824913', 'Biology: The Essentials', 'ISBN_9781259824913.jpg', 'Biology', '3rd', 'Marielle Hoefnagels', 'Amazon', '2020', 20, 'biology, essential, life', 'Biology: The Essentials, Third Edition offers a broader and more conceptual introduction to biology, simplifying the more complex biological content to the essential elements that students need to act as framework for the details.');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_bookcopy`
--

CREATE TABLE `tbl_bookcopy` (
  `book_no` int(11) NOT NULL,
  `ISBN` varchar(100) DEFAULT NULL,
  `copy_no` int(11) DEFAULT NULL,
  `book_status` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_bookcopy`
--

INSERT INTO `tbl_bookcopy` (`book_no`, `ISBN`, `copy_no`, `book_status`) VALUES
(1, '9780134112831', 1, 'Reserved'),
(2, '9780134112831', 2, 'Reserved'),
(3, '9780134112831', 3, 'Reserved'),
(4, '9780134112831', 4, 'Reserved'),
(5, '9780134112831', 5, 'Reserved'),
(6, '9780134112831', 6, 'Available'),
(7, '9780134112831', 7, 'Available'),
(8, '9780134112831', 8, 'Available'),
(9, '9780134112831', 9, 'Available'),
(10, '9780134112831', 10, 'Available'),
(11, '9780134112831', 11, 'Available'),
(12, '9780134112831', 12, 'Available'),
(13, '9780134112831', 13, 'Available'),
(14, '9780134112831', 14, 'Available'),
(15, '9780134112831', 15, 'Available'),
(16, '9780134112831', 16, 'Available'),
(17, '9780134112831', 17, 'Available'),
(18, '9780134112831', 18, 'Available'),
(19, '9780134112831', 19, 'Available'),
(23, '9781259824913', 1, 'Reserved'),
(24, '9780134711409', 1, 'Reserved'),
(25, '9780671020330', 1, 'Not Available'),
(26, '9780746000311', 1, 'Reserved'),
(27, '9780446310789', 1, 'Available'),
(53, '9780134711409', 2, 'Available'),
(54, '9780134711409', 3, 'Available'),
(55, '9780134711409', 4, 'Available'),
(56, '9780134711409', 5, 'Available'),
(57, '9780134711409', 6, 'Available'),
(58, '9780134711409', 7, 'Available'),
(59, '9780134711409', 8, 'Available'),
(60, '9780134711409', 9, 'Available'),
(61, '9780134711409', 10, 'Available'),
(68, '9780671020330', 2, 'Available'),
(69, '9780671020330', 3, 'Available'),
(70, '9780671020330', 4, 'Available'),
(71, '9780671020330', 5, 'Available'),
(72, '9780746000311', 2, 'Reserved'),
(73, '9780746000311', 3, 'Available'),
(74, '9780446310789', 2, 'Available'),
(75, '9780446310789', 3, 'Available'),
(76, '9780446310789', 4, 'Available'),
(77, '9780446310789', 5, 'Available'),
(78, '9780446310789', 6, 'Available'),
(79, '9781259824913', 2, 'Available'),
(80, '9781259824913', 3, 'Not Available'),
(81, '9781259824913', 4, 'Not Available'),
(82, '9781259824913', 5, 'Available'),
(83, '9781259824913', 6, 'Available'),
(84, '9781259824913', 7, 'Available'),
(85, '9781259824913', 8, 'Available'),
(86, '9781259824913', 9, 'Available'),
(87, '9781259824913', 10, 'Available'),
(88, '9781259824913', 11, 'Available'),
(89, '9781259824913', 12, 'Available'),
(90, '9781259824913', 13, 'Available'),
(91, '9781259824913', 14, 'Available'),
(92, '9781259824913', 15, 'Available'),
(93, '9781259824913', 16, 'Available'),
(94, '9781259824913', 17, 'Available'),
(95, '9781259824913', 18, 'Available'),
(96, '9781259824913', 19, 'Available'),
(97, '9781259824913', 20, 'Available'),
(98, '9780134711409', 11, 'Available'),
(99, '9780134711409', 12, 'Available'),
(100, '9780134711409', 13, 'Available'),
(101, '9780134711409', 14, 'Available'),
(102, '9780134711409', 15, 'Available'),
(103, '9780134711409', 16, 'Available'),
(104, '9780134711409', 17, 'Available'),
(105, '9780134711409', 18, 'Available'),
(106, '9780134711409', 19, 'Available'),
(107, '9780134711409', 20, 'Available'),
(108, '9780134711409', 21, 'Available'),
(109, '9780134711409', 22, 'Available'),
(110, '9780134711409', 23, 'Available'),
(111, '9780134711409', 24, 'Available'),
(112, '9780134711409', 25, 'Available'),
(113, '9780134711409', 26, 'Available'),
(114, '9780134711409', 27, 'Available'),
(115, '9780134711409', 28, 'Available'),
(116, '9780134711409', 29, 'Available'),
(117, '9780134711409', 30, 'Available'),
(118, '9780134112831', 20, 'Available'),
(119, '9780134112831', 21, 'Available'),
(120, '9780134112831', 22, 'Available'),
(121, '9780134112831', 23, 'Available'),
(122, '9780134112831', 24, 'Available'),
(123, '9780134112831', 25, 'Available');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_penalty`
--

CREATE TABLE `tbl_penalty` (
  `penalty_id` int(11) NOT NULL,
  `user_id` varchar(100) DEFAULT NULL,
  `num_of_days` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_report`
--

CREATE TABLE `tbl_report` (
  `report_no` int(11) NOT NULL,
  `trans_no` int(11) DEFAULT NULL,
  `report_description` varchar(100) DEFAULT NULL,
  `report_status` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_request`
--

CREATE TABLE `tbl_request` (
  `req_no` int(11) NOT NULL,
  `ISBN` varchar(100) DEFAULT NULL,
  `user_id` varchar(50) DEFAULT NULL,
  `book_title` varchar(50) DEFAULT NULL,
  `book_edition` varchar(100) DEFAULT NULL,
  `book_author` varchar(50) DEFAULT NULL,
  `book_quantity` int(11) DEFAULT NULL,
  `req_date` date DEFAULT NULL,
  `req_exp` date DEFAULT NULL,
  `req_status` varchar(50) DEFAULT NULL,
  `admin_id` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_request`
--

INSERT INTO `tbl_request` (`req_no`, `ISBN`, `user_id`, `book_title`, `book_edition`, `book_author`, `book_quantity`, `req_date`, `req_exp`, `req_status`, `admin_id`) VALUES
(8, '9780134554563', '19-02055', 'Chemistry', '14th', ' Theodore E. Brown', 1, '2022-03-11', '2022-04-10', 'PENDING', NULL),
(9, '9781461411673', '19-02056', 'Computer Science', '1st', ' Edward K. Blum', 5, '2022-03-11', '2022-04-10', 'PENDING', NULL),
(10, '9789715848046', '19-02144', 'El Filibusterismo', '1st', 'Jose P. Rizal', 10, '2022-03-11', '2022-04-10', 'PENDING', NULL),
(11, '9789710389476', '19-03992', 'Ibong Adarna', '1st', 'Encarnacion Jimenez, Melinda Iquin, Jesus Cena', 1, '2022-03-11', '2022-04-10', 'PENDING', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_reservation`
--

CREATE TABLE `tbl_reservation` (
  `res_no` int(11) NOT NULL,
  `user_id` varchar(100) DEFAULT NULL,
  `ISBN` varchar(100) DEFAULT NULL,
  `book_quantity` int(11) DEFAULT NULL,
  `res_date` date DEFAULT NULL,
  `res_expiry` date DEFAULT NULL,
  `res_status` varchar(100) DEFAULT NULL,
  `admin_id` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_reservation`
--

INSERT INTO `tbl_reservation` (`res_no`, `user_id`, `ISBN`, `book_quantity`, `res_date`, `res_expiry`, `res_status`, `admin_id`) VALUES
(36, '19-02055', '9781259824913', 1, '2022-03-11', '2022-03-18', 'PENDING', NULL),
(37, '19-02056', '9780134112831', 5, '2022-03-11', '2022-03-18', 'PENDING', NULL),
(38, '19-02144', '9780746000311', 2, '2022-03-11', '2022-03-18', 'PENDING', NULL),
(39, '19-03992', '9780134711409', 1, '2022-03-11', '2022-03-18', 'PENDING', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_transaction`
--

CREATE TABLE `tbl_transaction` (
  `trans_no` int(11) NOT NULL,
  `user_id` varchar(100) DEFAULT NULL,
  `ISBN` varchar(100) DEFAULT NULL,
  `book_quantity` int(11) DEFAULT NULL,
  `borrow_date` date DEFAULT NULL,
  `due_date` date DEFAULT NULL,
  `renew_date` date DEFAULT NULL,
  `trans_status` varchar(100) DEFAULT NULL,
  `admin_id` varchar(100) DEFAULT NULL,
  `returned_date` date DEFAULT NULL,
  `returned_qty` int(11) DEFAULT NULL,
  `returned_remarks` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_transaction`
--

INSERT INTO `tbl_transaction` (`trans_no`, `user_id`, `ISBN`, `book_quantity`, `borrow_date`, `due_date`, `renew_date`, `trans_status`, `admin_id`, `returned_date`, `returned_qty`, `returned_remarks`) VALUES
(22, '19-02056', '9781259824913', 3, '2022-03-11', '2022-03-18', NULL, 'RETURNED INCOMPLETE', 'A1-02055', '2022-03-11', 1, 'ON TIME'),
(23, '19-02055', '9780671020330', 1, '2022-03-11', '2022-03-18', NULL, 'BORROWED', 'A1-02055', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `user_id` varchar(100) NOT NULL,
  `user_fn` varchar(100) DEFAULT NULL,
  `user_mn` varchar(100) DEFAULT NULL,
  `user_ln` varchar(100) DEFAULT NULL,
  `user_gender` varchar(100) DEFAULT NULL,
  `user_dob` date DEFAULT NULL,
  `user_type` varchar(100) DEFAULT NULL,
  `user_email` varchar(100) DEFAULT NULL,
  `user_password` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`user_id`, `user_fn`, `user_mn`, `user_ln`, `user_gender`, `user_dob`, `user_type`, `user_email`, `user_password`) VALUES
('19-02055', 'Welmar Alex', 'Bautista', 'Brazas', 'MALE', '2000-05-20', 'STUDENT', 'wabbrazas@bpsu.edu.ph', 'ThrulX$13'),
('19-02056', 'Thrul', 'Deux', 'Ex', 'MALE', '2022-03-01', 'TEACHER', 'thrulx13@gmail.com', '1321'),
('19-02144', 'Alec', 'Deyniel', 'Bumanlag', 'FEMALE', '1990-11-01', 'TEACHER', 'alecbumanlag@gmail.com', 'helloworld'),
('19-03992', 'Joy Marie', 'Samson', 'Aguilar', 'FEMALE', '2000-02-14', 'STUDENT', 'joymarie13@gmail.com', 'heart');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `tbl_book`
--
ALTER TABLE `tbl_book`
  ADD PRIMARY KEY (`ISBN`);

--
-- Indexes for table `tbl_bookcopy`
--
ALTER TABLE `tbl_bookcopy`
  ADD PRIMARY KEY (`book_no`);

--
-- Indexes for table `tbl_penalty`
--
ALTER TABLE `tbl_penalty`
  ADD PRIMARY KEY (`penalty_id`);

--
-- Indexes for table `tbl_report`
--
ALTER TABLE `tbl_report`
  ADD PRIMARY KEY (`report_no`);

--
-- Indexes for table `tbl_request`
--
ALTER TABLE `tbl_request`
  ADD PRIMARY KEY (`req_no`);

--
-- Indexes for table `tbl_reservation`
--
ALTER TABLE `tbl_reservation`
  ADD PRIMARY KEY (`res_no`);

--
-- Indexes for table `tbl_transaction`
--
ALTER TABLE `tbl_transaction`
  ADD PRIMARY KEY (`trans_no`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_bookcopy`
--
ALTER TABLE `tbl_bookcopy`
  MODIFY `book_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=124;

--
-- AUTO_INCREMENT for table `tbl_penalty`
--
ALTER TABLE `tbl_penalty`
  MODIFY `penalty_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_report`
--
ALTER TABLE `tbl_report`
  MODIFY `report_no` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_request`
--
ALTER TABLE `tbl_request`
  MODIFY `req_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tbl_reservation`
--
ALTER TABLE `tbl_reservation`
  MODIFY `res_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `tbl_transaction`
--
ALTER TABLE `tbl_transaction`
  MODIFY `trans_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
