-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jun 30, 2018 at 08:54 PM
-- Server version: 5.7.21
-- PHP Version: 7.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `imperial`
--

-- --------------------------------------------------------

--
-- Table structure for table `cars`
--

DROP TABLE IF EXISTS `cars`;
CREATE TABLE IF NOT EXISTS `cars` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `make` int(11) NOT NULL,
  `model` int(11) NOT NULL,
  `number_plate` varchar(7) NOT NULL,
  `mileage` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cars`
--

INSERT INTO `cars` (`id`, `make`, `model`, `number_plate`, `mileage`) VALUES
(1, 1, 1, 'SK14PDF', 40013),
(2, 1, 1, 'SB17ABC', 12293),
(3, 1, 2, 'SA63DEF', 66323),
(4, 2, 3, 'SB14DFF', 44124),
(5, 2, 4, 'SB66ABF', 32033),
(6, 3, 5, 'WG12ARB', 32033),
(7, 3, 5, 'AG12BEF', 48742);

-- --------------------------------------------------------

--
-- Table structure for table `makes`
--

DROP TABLE IF EXISTS `makes`;
CREATE TABLE IF NOT EXISTS `makes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `make` varchar(80) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `makes`
--

INSERT INTO `makes` (`id`, `make`) VALUES
(1, 'BMW'),
(2, 'Ford'),
(3, 'Vauxhall');

-- --------------------------------------------------------

--
-- Table structure for table `models`
--

DROP TABLE IF EXISTS `models`;
CREATE TABLE IF NOT EXISTS `models` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `model` varchar(80) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `models`
--

INSERT INTO `models` (`id`, `model`) VALUES
(1, '3 Series'),
(2, '5 Series'),
(3, 'Mondeo'),
(4, 'Transit'),
(5, 'Zafira');
COMMIT;

--
-- Table structure for table `cars`
--

-- --------------------------------------------------------

DROP TABLE IF EXISTS `features`;
CREATE TABLE IF NOT EXISTS `features` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `feature` varchar(80) NOT NULL,
  `cost` int(11),
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cars`
--

INSERT INTO `features` (`id`, `feature`, `cost`) VALUES
(1, 'Electric Windows',150),
(2, 'BlueTooth',250),
(3, 'Sat Nav',1100),
(4, 'All Wheel Drive',2000),
(5, 'Sliding Side Door',1300);

-- --------------------------------------------------------

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
