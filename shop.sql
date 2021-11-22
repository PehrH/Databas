-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Värd: 127.0.0.1
-- Tid vid skapande: 22 nov 2021 kl 14:46
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
(11, 'Iphone 3g', 800, 5, 'The iPhone 3G is a smartphone designed and marketed by Apple Inc.; it is the second generation of iPhone, successor to the original iPhone, and was introduced on June 9, 2008, at the WWDC 2008 at the Moscone Center in San Francisco, United States.', '3g.jpg'),
(12, 'iphone 4', 1100, 3, 'Iphone 4, i marknadsföringssyfte skrivet iPhone 4, är en smartphone med pekskärm som utvecklats av Apple. Det är den fjärde generationen Iphone, och efterföljaren till Iphone 3GS. Den är speciellt marknadsförd för videosamtal, konsumtion av media som böcker och tidningar, filmer, musik och spel, samt för allmän internet- och emailåtkomst. Telefonen tillkännagavs den 7 juni 2010 på WWDC 2010 vid Moscone Center, San Francisco,[3] och släpptes den 24 juni 2010 i USA,', '4.jpg'),
(13, 'iphone 4s', 1350, 7, 'Iphone 4S, av Apple skrivet iPhone 4S, är en smarttelefon med pekskärm som utvecklats av Apple Inc. Det är en utveckling av den fjärde generationen Iphone, och efterföljaren till Iphone 4.', '4s.jpg'),
(14, 'iphone 5', 1500, 4, 'The iPhone 5 is a smartphone that was designed and marketed by Apple Inc. It is the 6th generation iPhone, succeeding the iPhone 4S and preceding both the iPhone 5S and 5C. It was formally unveiled as part of a press event on September 12, 2012, and subsequently released on September 21, 2012.', '5.jpg'),
(15, 'iphone 5c', 1600, 2, 'phone 5C (marknadsfört som iPhone 5c) är en smartphone med pekskärm som utvecklats av Apple. Det är den sjunde generationen Iphone och en av efterföljarna till Iphone 5.', '5c.jpg'),
(16, 'iphone 6', 1900, 6, 'The iPhone 6 and iPhone 6 Plus are smartphones that were designed and marketed by Apple Inc. They are the eighth generation of the iPhone, succeeding the iPhone 5S, and were announced on September 9, 2014 and released on September 19, 2014', '6.png'),
(17, 'iphone 6s', 2100, 7, 'Iphone 6S & Iphone 6S Plus, officiellt skrivet iPhone 6s & iPhone 6s Plus, blev vid lanseringen den 9 september 2015 Apple Incs nya flaggskepp i företagets utbud av smartmobiler.[2] Telefonerna presenterades i Bill Graham Civic Auditorium i San Francisco av Apples VD Tim Cook.', '6s.jpg'),
(18, 'iphone se', 2000, 4, 'Iphone SE, (officiellt skrivet iPhone SE), är namnet på Apples smarta telefoner i lågprisklassen.', 'se.jpg'),
(19, 'iphone 7', 2400, 6, 'Iphone 7 och Iphone 7 Plus, i marknadsföringssyfte skrivna iPhone 7 respektive iPhone 7 Plus, är smarttelefoner designade och skapade av Apple Inc.[1]', '7.png'),
(20, 'iphone 8', 2900, 9, 'Iphone 8 och Iphone 8 Plus, i marknadsföringssyfte skrivna iPhone 8 respektive iPhone 8 Plus, är smarttelefoner av Apple Inc. De presenterades den 12 september 2017 i Cupertino i Kalifornien och började säljas den 22 september 2017.', '8.jpg'),
(21, 'iphone X', 3400, 7, 'The iPhone X (Roman numeral \"X\" pronounced \"ten\")[11][12] is a smartphone designed, developed, marketed, produced, and sold by Apple Inc. The 11th generation of the iPhone, it was available to pre-order on October 27, 2017, and was released on November 3, 2017.', 'x.jpg'),
(22, 'iphone XR', 4100, 14, 'The iPhone XR (stylized and marketed as iPhone Xʀ; Roman numeral \"X\" pronounced \"ten\")[16][17] is a smartphone designed and manufactured by Apple Inc. It is part of the twelfth generation of the iPhone. Pre-orders began on October 19, 2018, with an official release on October 26, 2018', 'xr.jpg'),
(23, 'iphone 11', 5800, 6, 'Iphone 11, i marknadsföringssyfte skrivet iPhone 11, är en mobiltelefon från Apple. Den visades först tillsammans med Iphone 11 Pro av Tim Cook den 10 september 2019. Från den 13 september 2019 kunde man förhandsbeställa telefonen och den släpptes 20 september 2019, en dag efter att IOS 13 släpptes.', '11.jpg'),
(24, 'iphone 12', 7600, 8, 'The iPhone 12 and iPhone 12 Mini (stylized and marketed as iPhone 12 mini) are a range of smartphones designed, developed, and marketed by Apple Inc. They are the fourteenth-generation, lower-priced iPhones, succeeding the iPhone 11.', '12.jpg'),
(25, 'iphone 13', 9000, 7, 'The iPhone 13 and iPhone 13 Mini (stylized as iPhone 13 mini) are smartphones designed, developed, marketed, and sold by Apple Inc. They are the fifteenth generation of iPhones (succeeding the iPhone 12 and iPhone 12 Mini). They were unveiled at an Apple Event in Apple Park in Cupertino, California on September 14, 2021, alongside the higher priced iPhone 13 Pro and iPhone 13 Pro Max flagships.[12] Pre-orders for the iPhone 13 and iPhone 13 Mini began on September 17, 2021. They became available on September 24, 2021', '13.jpg');

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
  MODIFY `prod_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT för tabell `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
