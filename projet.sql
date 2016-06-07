-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Lun 06 Juin 2016 à 08:34
-- Version du serveur :  5.7.9
-- Version de PHP :  5.6.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `projet_annelide`
--
CREATE DATABASE IF NOT EXISTS `projet_annelide` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `projet_annelide`;

-- --------------------------------------------------------

--
-- Structure de la table `bestioles`
--

DROP TABLE IF EXISTS `bestioles`;
CREATE TABLE IF NOT EXISTS `bestioles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `bestioles` text NOT NULL,
  `nb` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `bestioles`
--

INSERT INTO `bestioles` (`id`, `bestioles`, `nb`) VALUES
(1, 'Magicarpe', 12),
(2, 'Flagadoss', 15),
(3, 'stari', 58),
(4, 'leviathor (shiny !)', 1),
(5, 'starros', 2),
(6, 'carapuce', 4),
(7, 'Aquali', 4),
(8, 'Aquali', 4),
(9, 'Crabi', 14);

-- --------------------------------------------------------

--
-- Structure de la table `groupe`
--

DROP TABLE IF EXISTS `groupe`;
CREATE TABLE IF NOT EXISTS `groupe` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Nom` varchar(30) NOT NULL,
  `zone` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `groupe`
--

INSERT INTO `groupe` (`ID`, `Nom`, `zone`) VALUES
(1, 'Métallica', NULL),
(2, 'AC/DC', NULL),
(3, 'Métallica', NULL),
(4, 'AC/DC', NULL),
(5, 'Van Halen', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `plage`
--

DROP TABLE IF EXISTS `plage`;
CREATE TABLE IF NOT EXISTS `plage` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Nom` text NOT NULL,
  `Superficie` int(11) NOT NULL,
  `Date` date NOT NULL,
  `zone` int(11) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `zone`
--

DROP TABLE IF EXISTS `zone`;
CREATE TABLE IF NOT EXISTS `zone` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `CoordX1` text NOT NULL,
  `CoordY1` text NOT NULL,
  `CoordX2` text NOT NULL,
  `CoordY2` text NOT NULL,
  `CoordX3` text NOT NULL,
  `CoordY3` text NOT NULL,
  `CoordX4` text NOT NULL,
  `CoordY4` text NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
