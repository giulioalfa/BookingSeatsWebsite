-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Creato il: Giu 19, 2019 alle 14:48
-- Versione del server: 5.7.26-0ubuntu0.16.04.1
-- Versione PHP: 7.0.33-0ubuntu0.16.04.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `s267589`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `seats`
--

DROP TABLE IF EXISTS `seats`;
CREATE TABLE `seats` (
  `seatid` varchar(5) COLLATE utf8_bin NOT NULL,
  `userid` int(11) NOT NULL,
  `bought` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dump dei dati per la tabella `seats`
--

INSERT INTO `seats` (`seatid`, `userid`, `bought`) VALUES
('B2', 2, 1),
('B3', 2, 1),
('B4', 2, 1),
('A4', 1, 0),
('D4', 1, 0),
('F4', 2, 0);

-- --------------------------------------------------------

--
-- Struttura della tabella `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `userid` int(11) NOT NULL,
  `email` text COLLATE utf8_bin NOT NULL,
  `pass` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dump dei dati per la tabella `users`
--

INSERT INTO `users` (`userid`, `email`, `pass`) VALUES
(1, 'u1@p.it', 'ec6ef230f1828039ee794566b9c58adc'),
(2, 'u2@p.it', '1d665b9b1467944c128a5575119d1cfd');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
