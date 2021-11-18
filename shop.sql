-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Värd: 127.0.0.1
-- Tid vid skapande: 18 nov 2021 kl 14:07
-- Serverversion: 10.4.21-MariaDB
-- PHP-version: 7.3.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Databas: `shop`
--

-- --------------------------------------------------------

--
-- Tabellstruktur `admins`
--

CREATE TABLE `admins` (
  `admin_id` int(11) NOT NULL,
  `Aname` varchar(40) NOT NULL,
  `admin_password` varchar(40) NOT NULL,
  `admin_email` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumpning av Data i tabell `admins`
--

INSERT INTO `admins` (`admin_id`, `Aname`, `admin_password`, `admin_email`) VALUES
(1, 'admin', 'admin', 'e3sar@hotmail.se');

-- --------------------------------------------------------

--
-- Tabellstruktur `prod`
--

CREATE TABLE `prod` (
  `prod_id` int(11) NOT NULL,
  `prod_title` varchar(40) NOT NULL,
  `prod_price` int(11) NOT NULL,
  `prod_count` int(11) NOT NULL,
  `prod_des` text NOT NULL,
  `prod_image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumpning av Data i tabell `prod`
--

INSERT INTO `prod` (`prod_id`, `prod_title`, `prod_price`, `prod_count`, `prod_des`, `prod_image`) VALUES
(5, 'iphone 12', 8775, 5, 'ny iphone', 'iphone.jpg'),
(6, 'ny test', 5554, 10, 'pepepepepepepepeee', 'iphone.jpg'),
(7, 'ny test', 5554, 10, 'pepepepepepepepeee', 'iphone.jpg'),
(8, 'iphone 8', 4770, 6, 'ny iphone 8', 'iphone2.jpg'),
(9, 'iphone igen', 8774, 10, 'ny iphone', 'iphone2.jpg'),
(10, 'nokia', 3250, 4, 'detta är ny nokia', 'nokia.jpg');

-- --------------------------------------------------------

--
-- Tabellstruktur `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `Fname` varchar(40) NOT NULL,
  `Lname` varchar(40) NOT NULL,
  `user_password` varchar(40) NOT NULL,
  `user_email` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumpning av Data i tabell `users`
--

INSERT INTO `users` (`user_id`, `Fname`, `Lname`, `user_password`, `user_email`) VALUES
(1, 'ameer', 'alkadhimi', '19920602', 'e3sar@hotmail.se');

--
-- Index för dumpade tabeller
--

--
-- Index för tabell `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`admin_id`);

--
-- Index för tabell `prod`
--
ALTER TABLE `prod`
  ADD PRIMARY KEY (`prod_id`);

--
-- Index för tabell `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT för dumpade tabeller
--

--
-- AUTO_INCREMENT för tabell `admins`
--
ALTER TABLE `admins`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT för tabell `prod`
--
ALTER TABLE `prod`
  MODIFY `prod_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT för tabell `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
