-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: dd21900
-- Erstellungszeit: 20. Feb 2021 um 16:44
-- Server-Version: 5.7.28-nmm1-log
-- PHP-Version: 7.4.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `d0357bd3`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `entries`
--

CREATE TABLE `entries` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `stores` text,
  `week` int(24) DEFAULT NULL,
  `link` varchar(255) DEFAULT NULL,
  `images` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `entries`
--

INSERT INTO `entries` (`id`, `title`, `stores`, `week`, `link`, `images`) VALUES
(16, 'Testangebot 01', 'flt,sln,efz', 1612479600, 'http://www.test.de', '60302ac579dd5.jpg,60302ac642ec0.jpg,60302ac6ec348.jpg,60302ac79c8d8.jpg,60302ac84a004.jpg'),
(17, 'Testangebot 05', 'nft,syr,inb', 1615330800, 'http://www.test.de', '60302adfcc0b4.jpg,60302ae067811.jpg,60302ae1654d0.jpg,60302ae222156.jpg,60302ae2ba980.jpg'),
(18, 'Testangebot 03', 'syr,hun,lza,hoc', 1614121200, 'http://www.test.de', '60302aff899e8.jpg,60302b0070a3b.jpg,60302b012b5eb.jpg,60302b01c1eb4.jpg,60302b026ac85.jpg'),
(19, 'Testangebot 04', 'nra,nrg,wiz', 1614726000, 'http://www.test.de', '60302b21678bd.jpg,60302b224a117.jpg,60302b22e0d4d.jpg,60302b2387389.jpg,60302b2433786.jpg'),
(20, 'Testangebot 02', 'oha,stt,eln', 1613516400, 'http://www.test.de', '60302b3cbdb15.jpg,60302b3ee9ded.jpg,60302b3f918af.jpg'),
(28, 'Testangebot 06', 'flt', 1615935600, 'http://www.test.de', '6030f193d47f5.jpg');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `migration`
--

CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `migration`
--

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1613406104),
('m210215_162353_init', 1613407276),
('m210219_131423_init', 1613740632);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(55) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `auth_key` varchar(255) DEFAULT NULL,
  `access_token` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `auth_key`, `access_token`) VALUES
(1, 'emma', '$2y$13$9.fsloopGBP5dGb43xAYSecL4MPjRBUmO1AeAcsUGs4qaceG/xvcC', 'iSFn5Kj05ZWTYLYilIIsjgKihlB0CLDI', 'nZZh0XkH92jeNqjcHJF7hvL_hqQrqEdF');

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `entries`
--
ALTER TABLE `entries`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `migration`
--
ALTER TABLE `migration`
  ADD PRIMARY KEY (`version`);

--
-- Indizes für die Tabelle `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `entries`
--
ALTER TABLE `entries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT für Tabelle `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
