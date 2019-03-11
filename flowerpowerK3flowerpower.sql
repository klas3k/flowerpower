-- phpMyAdmin SQL Dump
-- version 4.4.15.5
-- http://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: Mar 06, 2018 at 07:45 AM
-- Server version: 5.5.49-log
-- PHP Version: 7.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `flowerpower`
--
CREATE DATABASE IF NOT EXISTS `flowerpower` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `flowerpower`;

-- --------------------------------------------------------

--
-- Table structure for table `artikelen`
--

CREATE TABLE IF NOT EXISTS `artikelen` (
  `id` int(11) NOT NULL,
  `omschrijving` varchar(100) NOT NULL,
  `prijs` float NOT NULL,
  `voorraad` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `artikelen`
--

INSERT INTO `artikelen` (`id`, `omschrijving`, `prijs`, `voorraad`) VALUES
(1, 'bos voorjaar, tulpen, narcissen', 25, 4),
(2, 'bos valentijnsdag, rode rozen, roze rozen', 21, 15),
(3, 'bos vroege zomer, hyacinten, krokussen', 12.5, 10),
(4, 'bos blauw, blauwe druifjes, ridderspoor', 18, 6);

-- --------------------------------------------------------

--
-- Table structure for table `bestellingen`
--

CREATE TABLE IF NOT EXISTS `bestellingen` (
  `id` int(11) NOT NULL,
  `wkl_id` int(11) NOT NULL,
  `psn_kl_id` int(11) NOT NULL,
  `pns_mw_id` int(11) NOT NULL,
  `datum` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `afgehaald` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `bestellingen`
--

INSERT INTO `bestellingen` (`id`, `wkl_id`, `psn_kl_id`, `pns_mw_id`, `datum`, `afgehaald`) VALUES
(2, 1, 1, 99, '2018-03-04 19:36:40', 0),
(3, 0, 1, 99, '2018-03-04 19:36:47', 0),
(4, 1, 1, 0, '2018-03-28 22:00:00', 0),
(5, 1, 1, 0, '2018-03-27 22:00:00', 0),
(6, 1, 1, 0, '2018-07-23 22:00:00', 0),
(7, 1, 1, 0, '2018-04-15 22:00:00', 0),
(8, 1, 1, 0, '2018-04-05 22:00:00', 0),
(9, 1, 1, 0, '2018-03-05 23:00:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `bestelregels`
--

CREATE TABLE IF NOT EXISTS `bestelregels` (
  `id` int(11) NOT NULL,
  `bsg_id` int(11) NOT NULL,
  `atl_id` int(11) NOT NULL,
  `psn_kl_id` int(11) NOT NULL,
  `aantal` int(11) NOT NULL,
  `prijs` float NOT NULL,
  `besteld` tinyint(4) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `bestelregels`
--

INSERT INTO `bestelregels` (`id`, `bsg_id`, `atl_id`, `psn_kl_id`, `aantal`, `prijs`, `besteld`) VALUES
(1, 2, 1, 0, 1, 0, 1),
(2, 2, 1, 0, 2, 0, 1),
(3, 2, 2, 0, 2, 0, 1),
(4, 4, 4, 0, 2, 0, 1),
(5, 4, 4, 0, 2, 0, 1),
(6, 4, 4, 0, 2, 0, 1),
(7, 4, 1, 0, 3, 0, 1),
(8, 4, 4, 0, 2, 0, 1),
(9, 5, 4, 0, 3, 0, 0),
(10, 6, 1, 0, 3, 0, 1),
(11, 6, 2, 0, 2, 0, 1),
(12, 6, 4, 0, 3, 0, 1),
(13, 6, 1, 0, 2, 0, 1),
(14, 6, 1, 0, 3, 0, 1),
(15, 6, 2, 0, 5, 0, 1),
(16, 7, 1, 0, 1, 0, 1),
(17, 7, 1, 0, 2, 0, 1),
(18, 7, 1, 0, 1, 0, 1),
(19, 8, 1, 0, 10, 0, 1),
(20, 8, 3, 0, 10, 0, 1),
(21, 8, 2, 0, 2, 0, 1),
(22, 8, 2, 0, 4, 0, 1),
(23, 8, 2, 0, 4, 0, 1),
(24, 9, 1, 0, 4, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `filialen`
--

CREATE TABLE IF NOT EXISTS `filialen` (
  `id` int(11) NOT NULL,
  `vestiging` varchar(100) NOT NULL,
  `adres` varchar(100) NOT NULL,
  `postcode` varchar(10) NOT NULL,
  `vestigingsplaats` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `filialen`
--

INSERT INTO `filialen` (`id`, `vestiging`, `adres`, `postcode`, `vestigingsplaats`) VALUES
(1, 'flower power Lemans', 'oude gracht 21', '3521AA', 'Utrecht'),
(2, 'flower power Grieg', 'Mark 21', '2567EO', 'Heemstede');

-- --------------------------------------------------------

--
-- Table structure for table `personen`
--

CREATE TABLE IF NOT EXISTS `personen` (
  `id` int(11) NOT NULL,
  `voornaam` varchar(100) NOT NULL,
  `tussenvoegsel` varchar(25) DEFAULT NULL,
  `achternaam` varchar(100) NOT NULL,
  `gebruikersnaam` varchar(25) NOT NULL,
  `wachtwoord` varchar(100) NOT NULL,
  `role` varchar(12) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `personen`
--

INSERT INTO `personen` (`id`, `voornaam`, `tussenvoegsel`, `achternaam`, `gebruikersnaam`, `wachtwoord`, `role`) VALUES
(1, 'mevrouw P.', NULL, 'Bakker', 'pbakker', 'welkom', 'klant'),
(2, 'de heer G.', NULL, 'Groninger', 'ggron', 'welkom', 'klant'),
(3, 'Mieke', 'de', 'Vos', 'Vos01', 'qwerty', 'admin'),
(4, 'Henk', NULL, 'Aambeeld', 'Aam01', 'qwerty', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `artikelen`
--
ALTER TABLE `artikelen`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bestellingen`
--
ALTER TABLE `bestellingen`
  ADD PRIMARY KEY (`id`),
  ADD KEY `wkl_id` (`wkl_id`),
  ADD KEY `psn_kl_id` (`psn_kl_id`),
  ADD KEY `pns_mw_id` (`pns_mw_id`);

--
-- Indexes for table `bestelregels`
--
ALTER TABLE `bestelregels`
  ADD PRIMARY KEY (`id`),
  ADD KEY `atl_id` (`atl_id`),
  ADD KEY `psn_kl_id` (`psn_kl_id`);

--
-- Indexes for table `filialen`
--
ALTER TABLE `filialen`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personen`
--
ALTER TABLE `personen`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `artikelen`
--
ALTER TABLE `artikelen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `bestellingen`
--
ALTER TABLE `bestellingen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `bestelregels`
--
ALTER TABLE `bestelregels`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT for table `filialen`
--
ALTER TABLE `filialen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `personen`
--
ALTER TABLE `personen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
