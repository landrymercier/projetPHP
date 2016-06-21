-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Mar 21 Juin 2016 à 09:35
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
-- Structure de la table `espece`
--

DROP TABLE IF EXISTS `espece`;
CREATE TABLE IF NOT EXISTS `espece` (
  `IDespeces` int(10) NOT NULL AUTO_INCREMENT,
  `Nom` varchar(40) NOT NULL,
  `IDzone` int(4) NOT NULL,
  PRIMARY KEY (`IDespeces`,`IDzone`),
  KEY `IDzone` (`IDzone`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Vider la table avant d'insérer `espece`
--

TRUNCATE TABLE `espece`;
--
-- Contenu de la table `espece`
--

INSERT INTO `espece` (`IDespeces`, `Nom`, `IDzone`) VALUES
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
  `IDespece` int(10) NOT NULL,
  `quantite` int(8) NOT NULL,
  PRIMARY KEY (`IDzone`,`IDespece`),
  KEY `prelevement_ibfk_2` (`IDespece`)
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
  `Nom` varchar(40) NOT NULL COMMENT 'Nom du groupe',
  `Superficie` float NOT NULL,
  PRIMARY KEY (`ID`,`IDplage`),
  KEY `IDplage` (`IDplage`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Vider la table avant d'insérer `zones`
--

TRUNCATE TABLE `zones`;
--
-- Contenu de la table `zones`
--

INSERT INTO `zones` (`ID`, `IDplage`, `latA`, `longA`, `latB`, `longB`, `latC`, `longC`, `latD`, `longD`, `Nom`, `Superficie`) VALUES
(1, 1, '4°45''9554"', '4°45''9471"', '4°45''9798"', '4°45''9451"', '4°45''9489"', '4°45''9795"', '4°45''9112"', '4°45''9487"', 'AC/DC', 45),
(2, 1, '2°45''9577"', '2°45''9477"', '2°45''9797"', '2°45''9471"', '2°45''9479"', '2°45''9775"', '2°45''9712"', '2°45''9787"', 'Metallica', 45),
(3, 2, '4°45''9577"', '4°45''9477"', '4°45''9797"', '4°45''9471"', '4°45''9479"', '4°45''9775"', '4°45''9712"', '4°45''9787"', 'LED Zepplin', 45),
(4, 2, '4°45''97877"', '4°45''94977"', '4°45''99819"', '4°45''94497"', '4°45''95419"', '4°45''99988"', '4°45''95449"', '4°45''97897"', 'Rammstein', 984);

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `espece`
--
ALTER TABLE `espece`
  ADD CONSTRAINT `espece_ibfk_1` FOREIGN KEY (`IDzone`) REFERENCES `zones` (`ID`);

--
-- Contraintes pour la table `prelevement`
--
ALTER TABLE `prelevement`
  ADD CONSTRAINT `prelevement_ibfk_1` FOREIGN KEY (`IDzone`) REFERENCES `zones` (`ID`),
  ADD CONSTRAINT `prelevement_ibfk_2` FOREIGN KEY (`IDespece`) REFERENCES `espece` (`IDespeces`);

--
-- Contraintes pour la table `zones`
--
ALTER TABLE `zones`
  ADD CONSTRAINT `zones_ibfk_1` FOREIGN KEY (`IDplage`) REFERENCES `plage` (`ID`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
