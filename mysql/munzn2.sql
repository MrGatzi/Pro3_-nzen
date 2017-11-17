-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 16. Nov 2017 um 15:31
-- Server-Version: 10.1.28-MariaDB
-- PHP-Version: 7.1.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `munzn`
--
CREATE DATABASE IF NOT EXISTS `munzn` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `munzn`;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `charts`
--

DROP TABLE IF EXISTS `charts`;
CREATE TABLE IF NOT EXISTS `charts` (
  `idcharts` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_iduser` bigint(20) UNSIGNED NOT NULL,
  `amount` decimal(10,10) NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`idcharts`),
  KEY `user_idx` (`user_iduser`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `coins`
--

DROP TABLE IF EXISTS `coins`;
CREATE TABLE IF NOT EXISTS `coins` (
  `idcoins` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_iduser` bigint(20) UNSIGNED NOT NULL,
  `currency` varchar(20) NOT NULL,
  `amount` double NOT NULL,
  PRIMARY KEY (`idcoins`),
  KEY `user_idx` (`user_iduser`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `coins`
--

INSERT INTO `coins` (`idcoins`, `user_iduser`, `currency`, `amount`) VALUES
(1, 1, 'BTC', 10),
(2, 1, 'BTC', 10),
(3, 1, 'BTC', 10),
(4, 1, 'BTC', 10),
(5, 1, 'XRP', 110);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `iduser` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `email` varchar(100) NOT NULL,
  `password` char(128) NOT NULL,
  `verified` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`iduser`),
  KEY `user_idx` (`iduser`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `user`
--

INSERT INTO `user` (`iduser`, `email`, `password`, `verified`) VALUES
(1, 'muster@muster.at', '$2y$10$1ZNdKnw9gZpVBMqdM4PE4eXDmF2BMiqOMfYbNMJ3gY8vOXEe/vePe', 1),
(3, 'robinfellinger99@gmail.com', '$2y$10$kUvC4WNt/F6LCpd7CyrYuObLfWei.ZnzD..48rg8jjjtXagLSYfi2', 1);

--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `charts`
--
ALTER TABLE `charts`
  ADD CONSTRAINT `charts_ibfk_1` FOREIGN KEY (`user_iduser`) REFERENCES `user` (`iduser`);

--
-- Constraints der Tabelle `coins`
--
ALTER TABLE `coins`
  ADD CONSTRAINT `coins_ibfk_1` FOREIGN KEY (`user_iduser`) REFERENCES `user` (`iduser`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
