-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Lun 20 Juin 2016 à 09:33
-- Version du serveur :  5.7.9
-- Version de PHP :  5.6.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `prelevebdd`
--
CREATE DATABASE IF NOT EXISTS `prelevebdd` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `prelevebdd`;

-- --------------------------------------------------------

--
-- Structure de la table `especes`
--

DROP TABLE IF EXISTS `especes`;
CREATE TABLE IF NOT EXISTS `especes` (
  `IDespeces` int(4) NOT NULL AUTO_INCREMENT,
  `Nom` varchar(40) NOT NULL,
  `IDzone` int(4) NOT NULL,
  PRIMARY KEY (`IDespeces`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Vider la table avant d'insérer `especes`
--

TRUNCATE TABLE `especes`;
--
-- Contenu de la table `especes`
--

INSERT INTO `especes` (`IDespeces`, `Nom`, `IDzone`) VALUES
(1, 'Magicarpe', 1),
(2, 'Carapuce', 1),
(3, 'Stari', 1),
(4, 'Magicarpe', 2),
(5, 'Leviathor (shiny !)', 2);

-- --------------------------------------------------------

--
-- Structure de la table `plage`
--

DROP TABLE IF EXISTS `plage`;
CREATE TABLE IF NOT EXISTS `plage` (
  `ID` int(4) NOT NULL AUTO_INCREMENT COMMENT 'id auto incremente',
  `Nom` varchar(40) NOT NULL COMMENT 'nom de la plage',
  `Ville` varchar(40) NOT NULL COMMENT 'ville de la plage',
  `Superficie` float NOT NULL COMMENT 'superficie calc',
  `Datepreleve` date NOT NULL COMMENT 'date de preleve',
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Vider la table avant d'insérer `plage`
--

TRUNCATE TABLE `plage`;
--
-- Contenu de la table `plage`
--

INSERT INTO `plage` (`ID`, `Nom`, `Ville`, `Superficie`, `Datepreleve`) VALUES
(1, 'Karmouk les roches', 'Karmouk', 90, '2016-06-20'),
(2, 'Crevette-sur-salade', 'les morues', 125, '2016-06-22');

-- --------------------------------------------------------

--
-- Structure de la table `prelevement`
--

DROP TABLE IF EXISTS `prelevement`;
CREATE TABLE IF NOT EXISTS `prelevement` (
  `IDzone` int(4) NOT NULL,
  `IDespece` int(4) NOT NULL,
  `quantite` int(8) NOT NULL,
  PRIMARY KEY (`IDzone`,`IDespece`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Vider la table avant d'insérer `prelevement`
--

TRUNCATE TABLE `prelevement`;
--
-- Contenu de la table `prelevement`
--

INSERT INTO `prelevement` (`IDzone`, `IDespece`, `quantite`) VALUES
(1, 1, 4),
(1, 2, 8),
(1, 3, 12),
(2, 4, 48),
(2, 5, 1);

-- --------------------------------------------------------

--
-- Structure de la table `zones`
--

DROP TABLE IF EXISTS `zones`;
CREATE TABLE IF NOT EXISTS `zones` (
  `ID` int(4) NOT NULL AUTO_INCREMENT,
  `IDplage` int(4) NOT NULL,
  `latA` varchar(20) NOT NULL,
  `longA` varchar(20) NOT NULL,
  `latB` varchar(20) NOT NULL,
  `longB` varchar(20) NOT NULL,
  `latC` varchar(20) NOT NULL,
  `longC` varchar(20) NOT NULL,
  `latD` varchar(20) NOT NULL,
  `longD` varchar(20) NOT NULL,
  `Nom` varchar(40) NOT NULL,
  `Superficie` float NOT NULL,
  PRIMARY KEY (`ID`,`IDplage`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Vider la table avant d'insérer `zones`
--

TRUNCATE TABLE `zones`;
--
-- Contenu de la table `zones`
--

INSERT INTO `zones` (`ID`, `IDplage`, `latA`, `longA`, `latB`, `longB`, `latC`, `longC`, `latD`, `longD`, `Nom`, `Superficie`) VALUES
(1, 1, '4''45''9554"', '4''45''9471"', '4''45''9798"', '4''45''9451"', '4''45''9489"', '4''45''9795"', '4''45''9112"', '4''45''9487"', 'Karmouk city', 45),
(2, 1, '4''45''9577"', '4''45''9477"', '4''45''9797"', '4''45''9471"', '4''45''9479"', '4''45''9775"', '4''45''9712"', '4''45''9787"', 'Karmouk bourg', 45);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
