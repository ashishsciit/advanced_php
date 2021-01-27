-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 24, 2021 at 12:08 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cricket_rest`
--

-- --------------------------------------------------------

--
-- Table structure for table `player`
--

CREATE TABLE `player` (
  `id` int(11) NOT NULL,
  `name` varchar(60) NOT NULL,
  `age` int(11) NOT NULL,
  `jersey_no` decimal(10,0) DEFAULT NULL,
  `team_id` int(11) NOT NULL DEFAULT 1,
  `stats_id` int(11) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp(),
  `updated_by` int(11) NOT NULL DEFAULT 1,
  `deleted` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `player`
--

INSERT INTO `player` (`id`, `name`, `age`, `jersey_no`, `team_id`, `stats_id`, `created_at`, `updated_at`, `updated_by`, `deleted`) VALUES
(1, 'Virat Kohli', 29, '12', 1, 1, '2021-01-21 23:25:40', '2021-01-21 23:25:40', 1, 0),
(2, 'pat cummins', 31, '18', 2, 2, '2021-01-21 23:25:40', '2021-01-21 23:25:40', 1, 0),
(3, 'Rohit Sharama', 33, '10', 1, 3, '2021-01-23 13:21:20', '2021-01-23 13:21:20', 1, 0),
(6, 'Youvaraj Singh', 36, '6', 1, 4, '2021-01-23 14:31:36', '2021-01-23 14:31:36', 1, 0),
(7, 'Steve Smith', 30, '28', 2, 5, '2021-01-24 14:12:30', '2021-01-24 14:12:30', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `statistics`
--

CREATE TABLE `statistics` (
  `id` int(11) NOT NULL,
  `roll` varchar(30) NOT NULL DEFAULT 'na',
  `matches` decimal(10,0) NOT NULL DEFAULT 0,
  `runs` decimal(10,0) NOT NULL DEFAULT 0,
  `run_rate` float NOT NULL DEFAULT 0,
  `strike_rate` float NOT NULL DEFAULT 0,
  `fours` decimal(10,0) NOT NULL DEFAULT 0,
  `sixes` decimal(10,0) NOT NULL DEFAULT 0,
  `fifties` decimal(10,0) NOT NULL DEFAULT 0,
  `hundreds` decimal(10,0) NOT NULL DEFAULT 0,
  `wickets` decimal(10,0) NOT NULL DEFAULT 0,
  `wickets_strike_rate` float NOT NULL DEFAULT 0,
  `economy_rate` float NOT NULL DEFAULT 0,
  `maidens` decimal(10,0) NOT NULL DEFAULT 0,
  `five_wickets` decimal(10,0) NOT NULL DEFAULT 0,
  `catches` decimal(10,0) NOT NULL DEFAULT 0,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_by` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `statistics`
--

INSERT INTO `statistics` (`id`, `roll`, `matches`, `runs`, `run_rate`, `strike_rate`, `fours`, `sixes`, `fifties`, `hundreds`, `wickets`, `wickets_strike_rate`, `economy_rate`, `maidens`, `five_wickets`, `catches`, `created_at`, `updated_at`, `updated_by`) VALUES
(1, 'batsman', '58', '2039', 38.56, 96.67, '322', '86', '9', '3', '0', 0, 0, '0', '0', '19', '2021-01-21 23:20:18', '2021-01-21 23:20:18', 1),
(2, 'bowler', '60', '2094', 37.98, 88.56, '106', '25', '14', '6', '82', 24.76, 8.38, '2', '0', '93', '2021-01-21 23:20:18', '2021-01-21 23:20:18', 1),
(3, 'batsman', '83', '4067', 45.56, 98.26, '234', '68', '31', '8', '0', 0, 0, '0', '0', '0', '2021-01-23 13:21:21', '2021-01-23 13:21:21', 1),
(4, 'all rounder', '76', '3096', 45.27, 110.26, '232', '89', '26', '13', '64', 29.45, 8.45, '4', '1', '157', '2021-01-23 14:31:36', '2021-01-23 14:31:36', 1),
(5, 'batsman', '98', '4864', 37.94, 92.64, '232', '89', '26', '13', '64', 29.45, 8.45, '4', '1', '157', '2021-01-24 14:12:30', '2021-01-24 14:12:30', 1);

-- --------------------------------------------------------

--
-- Table structure for table `team`
--

CREATE TABLE `team` (
  `id` int(11) NOT NULL,
  `name` varchar(60) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp(),
  `updated_by` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `team`
--

INSERT INTO `team` (`id`, `name`, `created_at`, `updated_at`, `updated_by`) VALUES
(1, 'india', '2021-01-21 23:12:48', '2021-01-21 23:12:48', 1),
(2, 'australia', '2021-01-21 23:12:48', '2021-01-21 23:12:48', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `player`
--
ALTER TABLE `player`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `statistics`
--
ALTER TABLE `statistics`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `team`
--
ALTER TABLE `team`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `player`
--
ALTER TABLE `player`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `statistics`
--
ALTER TABLE `statistics`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `team`
--
ALTER TABLE `team`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
