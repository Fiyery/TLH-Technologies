-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Jeu 22 Mai 2014 à 21:51
-- Version du serveur :  5.6.17
-- Version de PHP :  5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `tlh_technologies`
--
USE `tlh_technologies`;

-- --------------------------------------------------------

--
-- Structure de la table `administrator`
--

CREATE TABLE IF NOT EXISTS `administrator` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pseudo` varchar(20) CHARACTER SET utf16 NOT NULL,
  `pass` varchar(40) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `administrator`
--

INSERT INTO `administrator` (`id`, `pseudo`, `pass`) VALUES
(1, 'root', '83353d597cbad458989f2b1a5c1fa1f9f665c858');

-- --------------------------------------------------------

--
-- Structure de la table `menu`
--

CREATE TABLE IF NOT EXISTS `menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `enable` tinyint(1) NOT NULL,
  `date_creation` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_modification` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `order` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Contenu de la table `menu`
--

INSERT INTO `menu` (`id`, `name`, `enable`, `date_creation`, `date_modification`, `order`) VALUES
(1, 'Entreprise', 1, '2014-05-13 07:08:59', '2014-05-13 07:08:59', 1),
(2, 'Projets', 1, '2014-05-13 07:08:59', '2014-05-22 19:45:42', 2);

-- --------------------------------------------------------

--
-- Structure de la table `sous_menu`
--

CREATE TABLE IF NOT EXISTS `sous_menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `enable` tinyint(1) NOT NULL,
  `date_creation` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_modification` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `order` int(11) NOT NULL,
  `id_menu` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_menu` (`id_menu`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Contenu de la table `sous_menu`
--

INSERT INTO `sous_menu` (`id`, `name`, `enable`, `date_creation`, `date_modification`, `order`, `id_menu`) VALUES
(1, 'Historique', 1, '2014-05-13 09:17:36', '2014-05-13 09:17:36', 1, 1),
(2, 'Expertise', 1, '2014-05-13 09:17:36', '2014-05-13 09:17:36', 2, 1),
(3, 'Equipe', 1, '2014-05-13 09:17:36', '2014-05-13 09:17:36', 3, 1),
(4, 'LaPromoDuCoin', 1, '2014-05-13 09:17:36', '2014-05-22 21:45:06', 1, 2);

-- --------------------------------------------------------

--
-- Structure de la table `static_menu`
--

CREATE TABLE IF NOT EXISTS `static_menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `date_creation` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_modification` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Contenu de la table `static_menu`
--

INSERT INTO `static_menu` (`id`, `name`, `date_creation`, `date_modification`) VALUES
(1, 'Accueil', '2014-05-21 16:04:51', '2014-05-22 19:46:21'),
(2, 'Aide', '2014-05-21 16:04:51', '2014-05-22 19:46:21'),
(3, 'En savoir plus', '2014-05-21 16:04:51', '2014-05-22 19:46:21');

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `sous_menu`
--
ALTER TABLE `sous_menu`
  ADD CONSTRAINT `sous_menu_ibfk_1` FOREIGN KEY (`id_menu`) REFERENCES `menu` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
