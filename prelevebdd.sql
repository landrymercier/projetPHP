-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Lun 25 Juillet 2016 à 10:56
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
) ENGINE=InnoDB AUTO_INCREMENT=56 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `espece`
--

INSERT INTO `espece` (`IDespeces`, `Nom`, `IDzone`) VALUES
(41, 'Magicarpe', 24),
(42, 'Carapuce', 24),
(43, 'Stari', 24),
(44, 'Espece 1', 25),
(45, 'Espece 2', 25),
(46, 'Espece 3', 25),
(47, 'Espece 1', 26),
(48, 'Espece 2', 26),
(49, 'Espece 3', 26),
(50, 'Espece 1', 27),
(51, 'magicarpe', 28),
(52, 'espece 2', 28),
(53, 'Espèce 1', 31),
(54, 'Espece 2', 31),
(55, 'Espece 3', 31);

-- --------------------------------------------------------

--
-- Structure de la table `login`
--

DROP TABLE IF EXISTS `login`;
CREATE TABLE IF NOT EXISTS `login` (
  `mdp` tinytext NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `login`
--

INSERT INTO `login` (`mdp`) VALUES
('pppppp');

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
  `Clore` tinyint(1) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `plage`
--

INSERT INTO `plage` (`ID`, `Nom`, `Ville`, `Superficie`, `Datepreleve`, `Clore`) VALUES
(22, 'Je suis vide', 'Pornic', 0, '2016-07-22', 0),
(23, 'Je suis en cours', 'Nantes', 0, '2016-07-25', 0),
(24, 'Je suis plein', 'Lorient', 0, '2017-01-01', 0),
(25, 'Guidel-plage', 'Guidel', 0, '2016-05-20', 2),
(26, 'Guidel-plage 2018', 'Guidel', 0, '2018-01-01', 0),
(27, 'Une plage perdue', 'quelque part', 0, '2016-07-25', 0);

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
-- Contenu de la table `prelevement`
--

INSERT INTO `prelevement` (`IDzone`, `IDespece`, `quantite`) VALUES
(24, 41, 12),
(24, 42, 1),
(24, 43, 17),
(25, 44, 14),
(25, 45, 87),
(25, 46, 99),
(26, 47, 12),
(26, 48, 14),
(26, 49, 95),
(27, 50, 99),
(28, 51, 1),
(28, 52, 2),
(31, 53, 14),
(31, 54, 4),
(31, 55, 78);

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
  `Clore` tinyint(1) NOT NULL,
  `deciXA` float NOT NULL DEFAULT '0',
  `deciYA` float NOT NULL DEFAULT '0',
  `deciXB` float NOT NULL DEFAULT '0',
  `deciYB` float NOT NULL DEFAULT '0',
  `deciXC` float NOT NULL DEFAULT '0',
  `deciYC` float NOT NULL DEFAULT '0',
  `deciXD` float NOT NULL DEFAULT '0',
  `deciYD` float NOT NULL DEFAULT '0',
  PRIMARY KEY (`ID`,`IDplage`),
  KEY `IDplage` (`IDplage`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `zones`
--

INSERT INTO `zones` (`ID`, `IDplage`, `latA`, `longA`, `latB`, `longB`, `latC`, `longC`, `latD`, `longD`, `Nom`, `Superficie`, `Clore`, `deciXA`, `deciYA`, `deciXB`, `deciYB`, `deciXC`, `deciYC`, `deciXD`, `deciYD`) VALUES
(24, 23, '1°1''1"', '1°1''1"', '1°1''1"', '1°1''1"', '1°1''1"', '1°1''1"', '1°1''1"', '1°1''1"', 'Groupe 1', 0, 0, 1.01694, 1.01694, 1.01694, 1.01694, 1.01694, 1.01694, 1.01694, 1.01694),
(25, 23, '2°2''2"', '2°2''2"', '2°2''2"', '2°2''2"', '2°2''2"', '2°2''2"', '2°2''2"', '2°2''2"', 'Groupe 2', 0, 0, 2.03389, 2.03389, 2.03389, 2.03389, 2.03389, 2.03389, 2.03389, 2.03389),
(26, 23, '3°3''3"', '3°3''3"', '3°3''3"', '3°3''3"', '3°3''3"', '3°3''3"', '3°3''3"', '3°3''3"', 'Groupe 3', 0, 0, 3.05083, 3.05083, 3.05083, 3.05083, 3.05083, 3.05083, 3.05083, 3.05083),
(27, 24, '5°5''5"', '5°5''5"', '5°5''5"', '5°5''5"', '5°5''5"', '5°5''5"', '5°5''5"', '5°5''5"', 'Equipe 1', 0, 1, 5.08472, 5.08472, 5.08472, 5.08472, 5.08472, 5.08472, 5.08472, 5.08472),
(28, 27, '46°40''6.5"', '-1°55''11.5"', '46°40''6.6"', '-1°55''9.8"', '46°40''5.9"', '-1°55''11.1"', '46°40''6.1"', '-1°55''9.2"', 'Un groupe avec de vrais coordonnées', 1596.81, 0, 46.6685, -0.0801389, 46.6685, -0.0806111, 46.6683, -0.08025, 46.6684, -0.0807778),
(29, 27, '46°40''6.5"', '-1°55''11.5"', '46°40''6.6"', '-1°55''9.8"', '46°40''5.9"', '-1°55''11.1"', '46°40''6.1"', '-1°55''9.2"', 'un autre groupe', 1596.81, 0, 46.6685, -0.0801389, 46.6685, -0.0806111, 46.6683, -0.08025, 46.6684, -0.0807778),
(30, 27, '46°40''6.5"', '1°55''11.5"', '46°40''6.6"', '1°55''9.8"', '46°40''5.9"', '1°55''11.1"', '46°40''6.1"', '1°55''9.2"', 'Le vrai groupe', 1595.92, 0, 46.6685, 1.91986, 46.6685, 1.91939, 46.6683, 1.91975, 46.6684, 1.91922),
(31, 22, '1°1''1"', '1°1''1.1"', '1°1''1.2"', '1°1''1.3"', '1°1''1.4"', '1°1''1.5"', '1°1''1.6"', '1°1''1.7"', 'Equipe 2', 0.00000436008, 0, 1.01694, 1.01697, 1.017, 1.01703, 1.01706, 1.01708, 1.01711, 1.01714),
(32, 24, '1°1''1"', '1°1''1"', '1°1''1"', '1°1''1"', '1°1''1"', '1°1''1"', '1°1''1"', '1°1''1"', 'Equipe Alpha', 0, 1, 1.01694, 1.01694, 1.01694, 1.01694, 1.01694, 1.01694, 1.01694, 1.01694);

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
