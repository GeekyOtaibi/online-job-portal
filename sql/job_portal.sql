-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 10, 2017 at 10:13 PM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 7.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `job_portal`
--

-- --------------------------------------------------------

--
-- Table structure for table `profiles`
--

CREATE TABLE `profiles` (
  `Id` int(11) NOT NULL,
  `Name` varchar(32) NOT NULL,
  `Email` text NOT NULL,
  `Address` text NOT NULL,
  `Website` text NOT NULL,
  `Phone` int(11) NOT NULL,
  `CSkills` text NOT NULL,
  `Objective` text NOT NULL,
  `Degree` text NOT NULL,
  `YOG` int(11) NOT NULL,
  `University` text NOT NULL,
  `Country` text NOT NULL,
  `Cposition` text NOT NULL,
  `YOJ` int(11) NOT NULL,
  `Org` text NOT NULL,
  `NOJob` text NOT NULL,
  `PWExp` text NOT NULL,
  `PYOJ` int(11) NOT NULL,
  `PYOL` int(11) NOT NULL,
  `DSkills` text NOT NULL,
  `SSkills` text NOT NULL,
  `img` text NOT NULL,
  `sid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `profiles`
--

INSERT INTO `profiles` (`Id`, `Name`, `Email`, `Address`, `Website`, `Phone`, `CSkills`, `Objective`, `Degree`, `YOG`, `University`, `Country`, `Cposition`, `YOJ`, `Org`, `NOJob`, `PWExp`, `PYOJ`, `PYOL`, `DSkills`, `SSkills`, `img`, `sid`) VALUES
(9, 'golden smith', 'gold@smith.com', 'nyc', 'https://www.google.com', 2147483647, 'smith', 'objective', 'Bachelor', 1999, 'harverd', 'usa', 'smith dev', 2000, 'google', 'ceo smith', 'smith', 1999, 2002, 'smith development', 'smithing', 'img/profiles/profile-golden smith.jpg', 7);

-- --------------------------------------------------------

--
-- Table structure for table `recruit`
--

CREATE TABLE `recruit` (
  `vid` int(11) NOT NULL,
  `sid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(32) NOT NULL,
  `password` varchar(32) NOT NULL,
  `name` varchar(32) NOT NULL,
  `type` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `name`, `type`) VALUES
(1, 'admin1', '81dc9bdb52d04dc20036dbd8313ed055', 'Hamad Alotaibi', 'admin'),
(6, 'recruiter1', 'fca0789e7891cbc0583298a238316122', 'Aramco', 'recruiter'),
(7, 'seeker1', 'fca0789e7891cbc0583298a238316122', 'golden smith', 'seeker'),
(8, 'seeker2', 'fca0789e7891cbc0583298a238316122', 'jesse pinkman', 'seeker'),
(9, 'recruiter2', 'fca0789e7891cbc0583298a238316122', 'walter white', 'recruiter');

-- --------------------------------------------------------

--
-- Table structure for table `vacancy`
--

CREATE TABLE `vacancy` (
  `id` int(11) NOT NULL,
  `title` varchar(64) NOT NULL,
  `capacity` int(11) NOT NULL,
  `available` int(11) NOT NULL,
  `enddate` date DEFAULT NULL,
  `desc` text NOT NULL,
  `rid` int(11) NOT NULL,
  `ptime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vacancy`
--

INSERT INTO `vacancy` (`id`, `title`, `capacity`, `available`, `enddate`, `desc`, `rid`, `ptime`) VALUES
(30, 'designer', 2, 2, '2017-05-12', 'web design', 6, '2017-05-10 22:38:18'),
(31, 'video editor', 1, 1, '2017-05-31', 'work experince 5 years', 9, '2017-05-10 22:39:08');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `profiles`
--
ALTER TABLE `profiles`
  ADD PRIMARY KEY (`Id`),
  ADD UNIQUE KEY `SID` (`sid`);

--
-- Indexes for table `recruit`
--
ALTER TABLE `recruit`
  ADD UNIQUE KEY `vid` (`vid`,`sid`),
  ADD KEY `seeker_id` (`sid`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `vacancy`
--
ALTER TABLE `vacancy`
  ADD PRIMARY KEY (`id`),
  ADD KEY `recruiter` (`rid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `profiles`
--
ALTER TABLE `profiles`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
--
-- AUTO_INCREMENT for table `vacancy`
--
ALTER TABLE `vacancy`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `recruit`
--
ALTER TABLE `recruit`
  ADD CONSTRAINT `seeker_id` FOREIGN KEY (`sid`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `vacancy_id` FOREIGN KEY (`vid`) REFERENCES `vacancy` (`id`);

--
-- Constraints for table `vacancy`
--
ALTER TABLE `vacancy`
  ADD CONSTRAINT `recruiter` FOREIGN KEY (`rid`) REFERENCES `user` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
