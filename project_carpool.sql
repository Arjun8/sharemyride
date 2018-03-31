-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Mar 31, 2018 at 10:31 AM
-- Server version: 5.7.19
-- PHP Version: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project_carpool`
--

-- --------------------------------------------------------

--
-- Table structure for table `off_ride`
--

DROP TABLE IF EXISTS `off_ride`;
CREATE TABLE IF NOT EXISTS `off_ride` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `address` varchar(80) NOT NULL,
  `lat` float(10,6) NOT NULL,
  `lng` float(10,6) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(254) NOT NULL,
  `password` varchar(64) NOT NULL,
  `first_name` varchar(30) NOT NULL,
  `last_name` varchar(30) NOT NULL,
  `phonenumber` varchar(10) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `first_name`, `last_name`, `phonenumber`) VALUES
(1, 'akasana8@gmail.com', '62cc0f79b17dfdb84521af92582fad8f548bec409b594a7de3acff27aa4e6e50', 'Arjun', 'Singh', '9041401528'),
(2, 'pankajsinghjangra@gmail.com', '62cc0f79b17dfdb84521af92582fad8f548bec409b594a7de3acff27aa4e6e50', 'Pankaj', 'Jangra', '9872405272'),
(3, 'sachin88.coolest@gmail.com', '62cc0f79b17dfdb84521af92582fad8f548bec409b594a7de3acff27aa4e6e50', 'Sachin', 'Pandey', '7696939080'),
(4, 'followsp@gmail.com', '62cc0f79b17dfdb84521af92582fad8f548bec409b594a7de3acff27aa4e6e50', 'Suraj', 'Patel', '7986220154'),
(5, 'arvindkasana8@gmail.com', '62cc0f79b17dfdb84521af92582fad8f548bec409b594a7de3acff27aa4e6e50', 'Arvind', 'Kasana', '8010222481'),
(6, 'anuj@gmail.com', '62cc0f79b17dfdb84521af92582fad8f548bec409b594a7de3acff27aa4e6e50', 'Anuj', 'Soni', '9041401528'),
(7, 'rashil3411@gmail.com', '62cc0f79b17dfdb84521af92582fad8f548bec409b594a7de3acff27aa4e6e50', 'Rashil', 'Shrivastava', '9041401528'),
(8, 'aaron@gmail.com', '62cc0f79b17dfdb84521af92582fad8f548bec409b594a7de3acff27aa4e6e50', 'Aaron', 'Kasana', '9041401528'),
(9, 'aryan@gmail.com', '62cc0f79b17dfdb84521af92582fad8f548bec409b594a7de3acff27aa4e6e50', 'Aryan', 'Kasana', '9041401528'),
(10, 'aarti@gmail.com', '62cc0f79b17dfdb84521af92582fad8f548bec409b594a7de3acff27aa4e6e50', 'Aarti', 'Kasana', '9041401528'),
(11, 'aarekh@gmail.com', '62cc0f79b17dfdb84521af92582fad8f548bec409b594a7de3acff27aa4e6e50', 'Aarekh', 'Kasana', '9041401528'),
(12, 'aarzoo@gmail.com', '62cc0f79b17dfdb84521af92582fad8f548bec409b594a7de3acff27aa4e6e50', 'Aarzoo', 'Kasana', '9041401528'),
(13, 'eatendra@gmail.com', '62cc0f79b17dfdb84521af92582fad8f548bec409b594a7de3acff27aa4e6e50', 'Atendra', 'Kumar', '9041401528'),
(14, 'ravi@gmail.com', '62cc0f79b17dfdb84521af92582fad8f548bec409b594a7de3acff27aa4e6e50', 'Ravi', 'Beniwal', '9041401528'),
(15, 'abhi@gmail.com', '62cc0f79b17dfdb84521af92582fad8f548bec409b594a7de3acff27aa4e6e50', 'Abhishek', 'Sharma', '9041401528'),
(16, 'asim@gmail.com', '62cc0f79b17dfdb84521af92582fad8f548bec409b594a7de3acff27aa4e6e50', 'Asim', 'Khan', '9041401528'),
(17, 'ram@gmail.com', '62cc0f79b17dfdb84521af92582fad8f548bec409b594a7de3acff27aa4e6e50', 'Ram', 'Singh', '9041401528');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
