-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 18, 2018 at 01:10 PM
-- Server version: 10.1.19-MariaDB
-- PHP Version: 7.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `munzn`
--

-- --------------------------------------------------------

--
-- Table structure for table `charts`
--

DROP TABLE IF EXISTS `charts`;
CREATE TABLE `charts` (
  `idcharts` bigint(20) UNSIGNED NOT NULL,
  `user_iduser` bigint(20) UNSIGNED NOT NULL,
  `amount` decimal(10,10) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `coins`
--

DROP TABLE IF EXISTS `coins`;
CREATE TABLE `coins` (
  `idcoins` bigint(20) UNSIGNED NOT NULL,
  `user_iduser` bigint(20) UNSIGNED NOT NULL,
  `currency` varchar(20) NOT NULL,
  `amount` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `coins`
--

INSERT INTO `coins` (`idcoins`, `user_iduser`, `currency`, `amount`) VALUES
(6, 1, 'XMR', 1),
(7, 1, 'BTC', 10),
(8, 1, 'BTC', 10),
(9, 1, 'BTC', 10),
(10, 1, 'XRP', 110);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `iduser` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` char(128) NOT NULL,
  `verified` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`iduser`, `username`, `email`, `password`, `verified`) VALUES
(1, '', 'muster@muster.at', '$2y$10$1ZNdKnw9gZpVBMqdM4PE4eXDmF2BMiqOMfYbNMJ3gY8vOXEe/vePe', 1),
(3, '', 'robinfellinger99@gmail.com', '$2y$10$kUvC4WNt/F6LCpd7CyrYuObLfWei.ZnzD..48rg8jjjtXagLSYfi2', 1),
(4, '', 'robinfellinge2r99@gmail.com', '$2y$10$1/K95SYNxQt18pKvJ8pIruVuGXavBbVUq8v4kmfLi5JljO4PsjtzS', 1),
(5, '', 'peter.lustig@hotmail.com', '$2y$10$M1emtkK9rpD0.6jham6iHOpb7x7Ox74VH8wVoJ9HZMQFFZq4/ukgC', 1),
(6, '', 'hue@due.com', '$2y$10$oR7YpzsAwkl5z040qqWHd.UMsb8lSdhesJETJEyYl2.K0KpNPMFUa', 1),
(7, '', 'hue@due.com', '$2y$10$wqUd0PsgU/2rHMxqDMkbxudMyiApZRjbBtlOHEXWxOAWHnNinsdZC', 1),
(8, '', 'huehda@gmail.com', '$2y$10$gwnMJFYDVTduwH4zqramD.3TMZvVNnXw/MoWAI9RY1s/8D5VOCybi', 1),
(9, '', 'new@user.com', '$2y$10$4tjxROa/zznWl/BB6KO8fOISj3Z1jTJDH4/p/HQP68du4Zw5PXZzG', 1),
(10, '', 'asdasdasd@asdasd.com', '$2y$10$GPAPMzKHTtvTDl61TOZKjOsiUWChQZKQDcq5yXTcFNgJIMfKI9v.K', 1),
(11, '', 'asdasdasd@asdasd.com', '$2y$10$zhQxekx6H90Ruu5Vq2uzmun6TZcnP7r9Mf8nJ60kyBpkfXr4IexfW', 1),
(12, '', 'owen@wilson.com', '$2y$10$.gBhphBVLEQPxYhhGtWGUuuHezfk5KOKBS73TWXUyTlRD7XGbnP4u', 1),
(13, '', 'owen@wilson.com', '$2y$10$Ydvv.x6ARdIXUfj//2oiPOoQMIg30ujh5HUUrEeXDPuxilZ7llNsS', 1),
(14, '', 'owen@wilson.com', '$2y$10$V6VGx8fC3EcZyVqeNJj04.8Aj2Ox.aEV3DDNrr8en6gtkkLejAg06', 1),
(15, '', 'gatzi@gatzi.com', '$2y$10$zdoIvntl3dF5m5niehCz7uUNa244MVdxvs8brwDvOeWI5pIKsRpXa', 1),
(16, '', 'peter.slustig@hotmail.com', '$2y$10$GKJhdey7/rT5/RhN6vErnei1C5/wm6d8ABKzlPZajHmV7sNCcXf0m', 1),
(17, '', 'iduser@iduser.com', '$2y$10$YBNcjaAJbYaN.hVbtEyLAeatsfsxxbo9D4rnC7VbYoKYIKatwa2mC', 1),
(18, '', 'flo@gmail.com', '$2y$10$pDec/bouFt3iMZNUPaPN3OzJFaqp6XU2zADs.4eGwU8Cz1wBs7k6O', 1),
(19, '', 'flo@gmail.com', '$2y$10$cdLn6mQ2.X5kTIsliu.N0uLaAvAjU/suUPzYeHESYOfFPvM2q9LBW', 1),
(20, '', 'id@test.at', '$2y$10$rXlE7nY2KXgBqoKh0brkK.kD92.jXmyYgQxBOSHOihwhyck5UkRBW', 1),
(21, '', 'asdas@gsadas.at', '$2y$10$Y5Adiv81qvQyVF/BDJEhquRmVleWcr3o1fTHoZsl9QzzckM6mZbQG', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `charts`
--
ALTER TABLE `charts`
  ADD PRIMARY KEY (`idcharts`),
  ADD KEY `user_idx` (`user_iduser`) USING BTREE;

--
-- Indexes for table `coins`
--
ALTER TABLE `coins`
  ADD PRIMARY KEY (`idcoins`),
  ADD KEY `user_idx` (`user_iduser`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`iduser`),
  ADD KEY `user_idx` (`iduser`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `charts`
--
ALTER TABLE `charts`
  MODIFY `idcharts` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `coins`
--
ALTER TABLE `coins`
  MODIFY `idcoins` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `iduser` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `charts`
--
ALTER TABLE `charts`
  ADD CONSTRAINT `charts_ibfk_1` FOREIGN KEY (`user_iduser`) REFERENCES `user` (`iduser`);

--
-- Constraints for table `coins`
--
ALTER TABLE `coins`
  ADD CONSTRAINT `coins_ibfk_1` FOREIGN KEY (`user_iduser`) REFERENCES `user` (`iduser`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
