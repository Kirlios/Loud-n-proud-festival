-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hostiteľ: 127.0.0.1
-- Čas generovania: Út 03.Mar 2026, 10:34
-- Verzia serveru: 10.4.27-MariaDB
-- Verzia PHP: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Databáza: `loudnproud`
--
CREATE DATABASE IF NOT EXISTS `loudnproud` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `loudnproud`;

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `artists`
--

CREATE TABLE `artists` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `image_url` varchar(500) DEFAULT '',
  `origin` varchar(50) DEFAULT 'US',
  `stage` varchar(100) DEFAULT 'Main Stage',
  `performance_day` varchar(50) DEFAULT 'Day 1',
  `popularity` int(11) DEFAULT 0,
  `is_headliner` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Sťahujem dáta pre tabuľku `artists`
--

INSERT INTO `artists` (`id`, `name`, `image_url`, `origin`, `stage`, `performance_day`, `popularity`, `is_headliner`) VALUES
(1, 'Kendrick Lamar', '', 'US', 'Main Stage', 'Day 1', 100, 1),
(2, 'Skepta', '', 'UK', 'Main Stage', 'Day 2', 96, 1),
(3, 'J. Cole', '', 'US', 'Black Stage', 'Day 1', 95, 1),
(4, 'EsDeeKid', '', 'UK', 'Black Stage', 'Day 2', 90, 1),
(5, 'Tyler, the Creator', '', 'US', 'Main Stage', 'Day 1', 97, 0),
(6, 'Travis Scott', '', 'US', 'Red Stage', 'Day 1', 94, 0),
(7, '21 Savage', '', 'US', 'Red Stage', 'Day 2', 91, 0),
(8, 'Denzel Curry', '', 'US', 'Black Stage', 'Day 1', 87, 0),
(9, 'Dave', '', 'UK', 'Main Stage', 'Day 1', 92, 0),
(10, 'Little Simz', '', 'UK', 'Black Stage', 'Day 2', 89, 0),
(11, 'Stormzy', '', 'UK', 'Red Stage', 'Day 1', 91, 0),
(12, 'Central Cee', '', 'UK', 'Red Stage', 'Day 2', 88, 0),
(13, 'Separ', '', 'SK', 'Main Stage', 'Day 2', 93, 0),
(14, 'Nik Tendo', '', 'CZ', 'Black Stage', 'Day 1', 85, 0),
(15, 'Calin', '', 'CZ', 'Red Stage', 'Day 2', 83, 0),
(16, 'Kontrafakt', '', 'SK', 'Red Stage', 'Day 1', 82, 0),
(17, 'Pil C', '', 'SK', 'Black Stage', 'Day 2', 80, 0),
(18, 'Ektor', '', 'CZ', 'Red Stage', 'Day 1', 79, 0),
(19, 'Vec', '', 'SK', 'Black Stage', 'Day 2', 77, 0),
(20, 'Majk Spirit', '', 'SK', 'Red Stage', 'Day 2', 75, 0);

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `tickets`
--

CREATE TABLE `tickets` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `price` int(11) NOT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Sťahujem dáta pre tabuľku `tickets`
--

INSERT INTO `tickets` (`id`, `name`, `price`, `description`) VALUES
(1, 'Basic Pass', 79, '1-day entry to all stages'),
(2, 'Full Festival', 149, 'All days — full access'),
(3, 'VIP', 299, 'VIP zone, open bar & exclusive vibe');

--
-- Kľúče pre exportované tabuľky
--

--
-- Indexy pre tabuľku `artists`
--
ALTER TABLE `artists`
  ADD PRIMARY KEY (`id`);

--
-- Indexy pre tabuľku `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pre exportované tabuľky
--

--
-- AUTO_INCREMENT pre tabuľku `artists`
--
ALTER TABLE `artists`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT pre tabuľku `tickets`
--
ALTER TABLE `tickets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
