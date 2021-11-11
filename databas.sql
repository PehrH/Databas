-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Värd: localhost
-- Tid vid skapande: 11 nov 2021 kl 16:36
-- Serverversion: 10.4.21-MariaDB
-- PHP-version: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Databas: `databas`
--

-- --------------------------------------------------------

--
-- Tabellstruktur `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `Aname` varchar(40) NOT NULL,
  `Apassword` varchar(40) NOT NULL,
  `Aemail` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumpning av Data i tabell `admin`
--

INSERT INTO `admin` (`admin_id`, `Aname`, `Apassword`, `Aemail`) VALUES
(1, 'admin', 'admin', 'e3sar@hotmail.se');

-- --------------------------------------------------------

--
-- Tabellstruktur `users`
--

CREATE TABLE `users` (
  `user_id` bigint(20) NOT NULL,
  `fName` varchar(40) NOT NULL,
  `lName` varchar(40) NOT NULL,
  `password` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumpning av Data i tabell `users`
--

INSERT INTO `users` (`user_id`, `fName`, `lName`, `password`, `email`) VALUES
(7, 'admin', '', '123456', ''),
(8, 'ameer', 'alkadhimi', '1111', 'ameer@text.se'),
(9, 'test1', 'test1', '', 'aaa@hotmail.se'),
(10, 'ameer', 'alkadhimi', '147159', 'e3sar@hotmail.se'),
(11, 'test1', 'test1', '1111', 'aaa@hotmail.se'),
(12, 'ameer2', 'ameer2', '1235874', 'ameer2@gmail.com'),
(13, 'pehr', 'häggqvist', '159951', 'hahah@gmail.com'),
(14, 'hamid', 'qurban', '1474', 'ha@gmail.com'),
(15, 'amory', 'hashim', 'ameer1992', 'aaaam22@hotmail.se'),
(16, 'aaaaaaa', 'aaaaaaaaa', '111', 'alll//**@jj.se'),
(17, 'ameer', 'hashim', '19920602', 'ameer@hotmail.se');

--
-- Index för dumpade tabeller
--

--
-- Index för tabell `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Index för tabell `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT för dumpade tabeller
--

--
-- AUTO_INCREMENT för tabell `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT för tabell `users`
--
ALTER TABLE `users`
  MODIFY `user_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
