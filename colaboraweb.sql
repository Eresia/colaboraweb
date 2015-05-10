-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Dim 10 Mai 2015 à 22:25
-- Version du serveur :  5.6.17
-- Version de PHP :  5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `colaboraweb`
--

-- --------------------------------------------------------

--
-- Structure de la table `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) CHARACTER SET utf8 NOT NULL,
  `previous` int(11) NOT NULL,
  `color` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=40 ;

--
-- Contenu de la table `category`
--

INSERT INTO `category` (`id`, `name`, `previous`, `color`) VALUES
(1, 'Autre', 19, 13224393),
(2, 'SQL', 0, 11493458),
(11, 'CSS', 2, 0),
(19, 'HTML', 11, 6422366);

-- --------------------------------------------------------

--
-- Structure de la table `comment`
--

CREATE TABLE IF NOT EXISTS `comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `url` int(11) NOT NULL,
  `comment` varchar(255) CHARACTER SET utf8 NOT NULL,
  `author` int(11) NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=224 ;

--
-- Contenu de la table `comment`
--

INSERT INTO `comment` (`id`, `url`, `comment`, `author`, `date`) VALUES
(221, 14, 'Je suis d&apos;accord !', 1, '2015-05-10 21:31:32'),
(223, 17, 'Super !', 5, '2015-05-10 22:25:08');

-- --------------------------------------------------------

--
-- Structure de la table `note`
--

CREATE TABLE IF NOT EXISTS `note` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `url` int(11) NOT NULL,
  `note` int(11) NOT NULL,
  `author` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Contenu de la table `note`
--

INSERT INTO `note` (`id`, `url`, `note`, `author`) VALUES
(10, 14, 10, 1),
(12, 16, 6, 5),
(13, 17, 9, 6),
(14, 17, 8, 5);

-- --------------------------------------------------------

--
-- Structure de la table `profil`
--

CREATE TABLE IF NOT EXISTS `profil` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` int(11) NOT NULL,
  `date_inscription` date NOT NULL,
  `avatar` varchar(255) CHARACTER SET utf8 NOT NULL,
  `description` text CHARACTER SET utf8 NOT NULL,
  `sign` text CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Contenu de la table `profil`
--

INSERT INTO `profil` (`id`, `user`, `date_inscription`, `avatar`, `description`, `sign`) VALUES
(1, 1, '2015-04-04', 'http://img15.hostingpics.net/thumbs/mini_631494Eresia.png', 'Co-fondateur du site', 'Ceci est une signature'),
(2, 2, '2015-04-04', '', 'Co-fondateur du site', ''),
(3, 3, '2015-04-14', '', '', ''),
(10, 4, '2015-05-10', '', '', ''),
(11, 5, '2015-05-10', '', '', ''),
(12, 6, '2015-05-10', '', '', '');

-- --------------------------------------------------------

--
-- Structure de la table `url`
--

CREATE TABLE IF NOT EXISTS `url` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `url` varchar(255) CHARACTER SET utf8 NOT NULL,
  `category` int(11) NOT NULL,
  `description` text CHARACTER SET utf8 NOT NULL,
  `author` int(11) NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

--
-- Contenu de la table `url`
--

INSERT INTO `url` (`id`, `url`, `category`, `description`, `author`, `date`) VALUES
(14, 'http://colaboraweb.wc.lt/index.php', 1, 'Best of the site', 1, '2015-05-10 21:31:23'),
(16, 'http://validator.w3.org', 19, 'Un bon site pour valide le HTML', 5, '2015-05-10 22:22:18'),
(17, 'https://jigsaw.w3.org/css-validator/', 11, 'Site pour valide le Css', 6, '2015-05-10 22:24:01'),
(18, 'http://fr.wikipedia.org/wiki/Hypertext_Markup_Language', 19, 'Définition du HTML', 5, '2015-05-10 22:24:47');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
