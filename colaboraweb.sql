-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Jeu 09 Avril 2015 à 18:04
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
  `color` smallint(6) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `category`
--

INSERT INTO `category` (`id`, `name`, `previous`, `color`) VALUES
(1, 'Autre', 0, 0);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=213 ;

--
-- Contenu de la table `comment`
--

INSERT INTO `comment` (`id`, `url`, `comment`, `author`, `date`) VALUES
(1, 1, 'Je confirme !!', 1, '2015-04-05 00:00:00'),
(5, 1, 'ouééééééé trooooop', 1, '2015-04-08 00:00:00'),
(6, 7, 'coucou', 1, '2015-04-08 00:00:00'),
(7, 7, 'coucou', 1, '2015-04-08 00:00:00'),
(8, 7, 'coucou', 1, '2015-04-08 00:00:00'),
(9, 7, 'coucou', 1, '2015-04-08 00:00:00'),
(10, 7, 'coucou', 1, '2015-04-08 00:00:00'),
(11, 7, 'coucou', 1, '2015-04-08 00:00:00'),
(12, 7, 'coucou', 1, '2015-04-08 00:00:00'),
(13, 7, 'coucou', 1, '2015-04-08 00:00:00'),
(14, 7, 'coucou', 1, '2015-04-08 00:00:00'),
(15, 7, 'coucou', 1, '2015-04-08 00:00:00'),
(16, 7, 'coucou', 1, '2015-04-08 00:00:00'),
(17, 7, 'coucou', 1, '2015-04-08 00:00:00'),
(18, 7, 'coucou', 1, '2015-04-08 00:00:00'),
(19, 7, 'coucou', 1, '2015-04-08 00:00:00'),
(20, 7, 'coucou', 1, '2015-04-08 00:00:00'),
(21, 7, 'coucou', 1, '2015-04-08 00:00:00'),
(22, 7, 'coucou', 1, '2015-04-08 00:00:00'),
(23, 7, 'coucou', 1, '2015-04-08 00:00:00'),
(24, 7, 'coucou', 1, '2015-04-08 00:00:00'),
(25, 7, 'coucou', 1, '2015-04-08 00:00:00'),
(26, 7, 'coucou', 1, '2015-04-08 00:00:00'),
(27, 7, 'coucou', 1, '2015-04-08 00:00:00'),
(28, 7, 'coucou', 1, '2015-04-08 00:00:00'),
(29, 7, 'coucou', 1, '2015-04-08 00:00:00'),
(30, 7, 'coucou', 1, '2015-04-08 00:00:00'),
(31, 7, 'coucou', 1, '2015-04-08 00:00:00'),
(32, 7, 'coucou', 1, '2015-04-08 00:00:00'),
(33, 7, 'coucou', 1, '2015-04-08 00:00:00'),
(34, 7, 'coucou', 1, '2015-04-08 00:00:00'),
(35, 7, 'coucou', 1, '2015-04-08 00:00:00'),
(36, 7, 'coucou', 1, '2015-04-08 00:00:00'),
(37, 7, 'coucou', 1, '2015-04-08 00:00:00'),
(38, 7, 'coucou', 1, '2015-04-08 00:00:00'),
(39, 7, 'coucou', 1, '2015-04-08 00:00:00'),
(40, 7, 'coucou', 1, '2015-04-08 00:00:00'),
(41, 7, 'coucou', 1, '2015-04-08 00:00:00'),
(42, 7, 'coucou', 1, '2015-04-08 00:00:00'),
(43, 7, 'coucou', 1, '2015-04-08 00:00:00'),
(44, 7, 'coucou', 1, '2015-04-08 00:00:00'),
(45, 7, 'coucou', 1, '2015-04-08 00:00:00'),
(46, 7, 'coucou', 1, '2015-04-08 00:00:00'),
(47, 7, 'coucou', 1, '2015-04-08 00:00:00'),
(48, 7, 'coucou', 1, '2015-04-08 00:00:00'),
(49, 7, 'coucou', 1, '2015-04-08 00:00:00'),
(50, 7, 'coucou', 1, '2015-04-08 00:00:00'),
(51, 7, 'coucou', 1, '2015-04-08 00:00:00'),
(52, 7, 'coucou', 1, '2015-04-08 00:00:00'),
(53, 7, 'coucou', 1, '2015-04-08 00:00:00'),
(54, 7, 'coucou', 1, '2015-04-08 00:00:00'),
(55, 7, 'coucou', 1, '2015-04-08 00:00:00'),
(56, 7, 'coucou', 1, '2015-04-08 00:00:00'),
(57, 7, 'coucou', 1, '2015-04-08 00:00:00'),
(58, 7, 'coucou', 1, '2015-04-08 00:00:00'),
(59, 7, 'coucou', 1, '2015-04-08 00:00:00'),
(60, 7, 'coucou', 1, '2015-04-08 00:00:00'),
(61, 7, 'coucou', 1, '2015-04-08 00:00:00'),
(62, 7, 'coucou', 1, '2015-04-08 00:00:00'),
(63, 7, 'coucou', 1, '2015-04-08 00:00:00'),
(64, 7, 'coucou', 1, '2015-04-08 00:00:00'),
(65, 7, 'coucou', 1, '2015-04-08 00:00:00'),
(66, 7, 'coucou', 1, '2015-04-08 00:00:00'),
(67, 7, 'coucou', 1, '2015-04-08 00:00:00'),
(68, 7, 'coucou', 1, '2015-04-08 00:00:00'),
(69, 7, 'coucou', 1, '2015-04-08 00:00:00'),
(70, 7, 'coucou', 1, '2015-04-08 00:00:00'),
(71, 7, 'coucou', 1, '2015-04-08 00:00:00'),
(72, 7, 'coucou', 1, '2015-04-08 00:00:00'),
(73, 7, 'coucou', 1, '2015-04-08 00:00:00'),
(74, 7, 'coucou', 1, '2015-04-08 00:00:00'),
(75, 7, 'coucou', 1, '2015-04-08 00:00:00'),
(76, 7, 'coucou', 1, '2015-04-08 00:00:00'),
(77, 7, 'coucou', 1, '2015-04-08 00:00:00'),
(78, 7, 'coucou', 1, '2015-04-08 00:00:00'),
(79, 7, 'coucou', 1, '2015-04-08 00:00:00'),
(80, 7, 'coucou', 1, '2015-04-08 00:00:00'),
(81, 7, 'coucou', 1, '2015-04-08 00:00:00'),
(82, 7, 'coucou', 1, '2015-04-08 00:00:00'),
(83, 7, 'coucou', 1, '2015-04-08 00:00:00'),
(84, 7, 'coucou', 1, '2015-04-08 00:00:00'),
(85, 7, 'coucou', 1, '2015-04-08 00:00:00'),
(86, 7, 'coucou', 1, '2015-04-08 00:00:00'),
(87, 7, 'coucou', 1, '2015-04-08 00:00:00'),
(88, 7, 'coucou', 1, '2015-04-08 00:00:00'),
(89, 7, 'coucou', 1, '2015-04-08 00:00:00'),
(90, 7, 'coucou', 1, '2015-04-08 00:00:00'),
(91, 7, 'coucou', 1, '2015-04-08 00:00:00'),
(92, 7, 'coucou', 1, '2015-04-08 00:00:00'),
(93, 7, 'coucou', 1, '2015-04-08 00:00:00'),
(94, 7, 'coucou', 1, '2015-04-08 00:00:00'),
(95, 7, 'coucou', 1, '2015-04-08 00:00:00'),
(96, 7, 'coucou', 1, '2015-04-08 00:00:00'),
(97, 7, 'coucou', 1, '2015-04-08 00:00:00'),
(98, 7, 'coucou', 1, '2015-04-08 00:00:00'),
(99, 7, 'coucou', 1, '2015-04-08 00:00:00'),
(100, 7, 'coucou', 1, '2015-04-08 00:00:00'),
(101, 7, 'coucou', 1, '2015-04-08 00:00:00'),
(102, 7, 'coucou', 1, '2015-04-08 00:00:00'),
(103, 7, 'coucou', 1, '2015-04-08 00:00:00'),
(104, 7, 'coucou', 1, '2015-04-08 00:00:00'),
(105, 7, 'coucou', 1, '2015-04-08 00:00:00'),
(106, 7, 'coucou', 1, '2015-04-08 00:00:00'),
(107, 7, 'coucou', 1, '2015-04-08 00:00:00'),
(108, 7, 'coucou', 1, '2015-04-08 00:00:00'),
(109, 7, 'coucou', 1, '2015-04-08 00:00:00'),
(110, 7, 'coucou', 1, '2015-04-08 00:00:00'),
(111, 7, 'coucou', 1, '2015-04-08 00:00:00'),
(112, 7, 'coucou', 1, '2015-04-08 00:00:00'),
(113, 7, 'coucou', 1, '2015-04-08 00:00:00'),
(114, 7, 'coucou', 1, '2015-04-08 00:00:00'),
(115, 7, 'coucou', 1, '2015-04-08 00:00:00'),
(116, 7, 'coucou', 1, '2015-04-08 00:00:00'),
(117, 7, 'coucou', 1, '2015-04-08 00:00:00'),
(118, 7, 'coucou', 1, '2015-04-08 00:00:00'),
(119, 7, 'coucou', 1, '2015-04-08 00:00:00'),
(120, 7, 'coucou', 1, '2015-04-08 00:00:00'),
(121, 7, 'coucou', 1, '2015-04-08 00:00:00'),
(122, 7, 'coucou', 1, '2015-04-08 00:00:00'),
(123, 7, 'coucou', 1, '2015-04-08 00:00:00'),
(124, 7, 'coucou', 1, '2015-04-08 00:00:00'),
(125, 7, 'coucou', 1, '2015-04-08 00:00:00'),
(126, 7, 'coucou', 1, '2015-04-08 00:00:00'),
(127, 7, 'coucou', 1, '2015-04-08 00:00:00'),
(128, 7, 'coucou', 1, '2015-04-08 00:00:00'),
(129, 7, 'coucou', 1, '2015-04-08 00:00:00'),
(130, 7, 'coucou', 1, '2015-04-08 00:00:00'),
(131, 7, 'coucou', 1, '2015-04-08 00:00:00'),
(132, 7, 'coucou', 1, '2015-04-08 00:00:00'),
(133, 7, 'coucou', 1, '2015-04-08 00:00:00'),
(134, 7, 'coucou', 1, '2015-04-08 00:00:00'),
(135, 7, 'coucou', 1, '2015-04-08 00:00:00'),
(136, 7, 'coucou', 1, '2015-04-08 00:00:00'),
(137, 7, 'coucou', 1, '2015-04-08 00:00:00'),
(138, 7, 'coucou', 1, '2015-04-08 00:00:00'),
(139, 7, 'coucou', 1, '2015-04-08 00:00:00'),
(140, 7, 'coucou', 1, '2015-04-08 00:00:00'),
(141, 7, 'coucou', 1, '2015-04-08 00:00:00'),
(142, 7, 'coucou', 1, '2015-04-08 00:00:00'),
(143, 7, 'coucou', 1, '2015-04-08 00:00:00'),
(144, 7, 'coucou', 1, '2015-04-08 00:00:00'),
(145, 7, 'coucou', 1, '2015-04-08 00:00:00'),
(146, 7, 'coucou', 1, '2015-04-08 00:00:00'),
(147, 7, 'coucou', 1, '2015-04-08 00:00:00'),
(148, 7, 'coucou', 1, '2015-04-08 00:00:00'),
(149, 7, 'coucou', 1, '2015-04-08 00:00:00'),
(150, 7, 'coucou', 1, '2015-04-08 00:00:00'),
(151, 7, 'coucou', 1, '2015-04-08 00:00:00'),
(152, 7, 'coucou', 1, '2015-04-08 00:00:00'),
(153, 7, 'coucou', 1, '2015-04-08 00:00:00'),
(154, 7, 'coucou', 1, '2015-04-08 00:00:00'),
(155, 7, 'coucou', 1, '2015-04-08 00:00:00'),
(156, 7, 'coucou', 1, '2015-04-08 00:00:00'),
(157, 7, 'coucou', 1, '2015-04-08 00:00:00'),
(158, 7, 'coucou', 1, '2015-04-08 00:00:00'),
(159, 7, 'coucou', 1, '2015-04-08 00:00:00'),
(160, 7, 'coucou', 1, '2015-04-08 00:00:00'),
(161, 7, 'coucou', 1, '2015-04-08 00:00:00'),
(162, 7, 'coucou', 1, '2015-04-08 00:00:00'),
(163, 7, 'coucou', 1, '2015-04-08 00:00:00'),
(164, 7, 'coucou', 1, '2015-04-08 00:00:00'),
(165, 7, 'coucou', 1, '2015-04-08 00:00:00'),
(166, 7, 'coucou', 1, '2015-04-08 00:00:00'),
(167, 7, 'coucou', 1, '2015-04-08 00:00:00'),
(168, 7, 'coucou', 1, '2015-04-08 00:00:00'),
(169, 7, 'coucou', 1, '2015-04-08 00:00:00'),
(170, 7, 'coucou', 1, '2015-04-08 00:00:00'),
(171, 7, 'coucou', 1, '2015-04-08 00:00:00'),
(172, 7, 'coucou', 1, '2015-04-08 00:00:00'),
(173, 7, 'coucou', 1, '2015-04-08 00:00:00'),
(174, 7, 'coucou', 1, '2015-04-08 00:00:00'),
(175, 7, 'coucou', 1, '2015-04-08 00:00:00'),
(176, 7, 'coucou', 1, '2015-04-08 00:00:00'),
(177, 7, 'coucou', 1, '2015-04-08 00:00:00'),
(178, 7, 'coucou', 1, '2015-04-08 00:00:00'),
(179, 7, 'coucou', 1, '2015-04-08 00:00:00'),
(180, 7, 'coucou', 1, '2015-04-08 00:00:00'),
(181, 7, 'coucou', 1, '2015-04-08 00:00:00'),
(182, 7, 'coucou', 1, '2015-04-08 00:00:00'),
(183, 7, 'coucou', 1, '2015-04-08 00:00:00'),
(184, 7, 'coucou', 1, '2015-04-08 00:00:00'),
(185, 7, 'coucou', 1, '2015-04-08 00:00:00'),
(186, 7, 'coucou', 1, '2015-04-08 00:00:00'),
(187, 7, 'coucou', 1, '2015-04-08 00:00:00'),
(188, 7, 'coucou', 1, '2015-04-08 00:00:00'),
(189, 7, 'coucou', 1, '2015-04-08 00:00:00'),
(190, 7, 'coucou', 1, '2015-04-08 00:00:00'),
(191, 7, 'coucou', 1, '2015-04-08 00:00:00'),
(192, 7, 'coucou', 1, '2015-04-08 00:00:00'),
(193, 7, 'coucou', 1, '2015-04-08 00:00:00'),
(194, 7, 'coucou', 1, '2015-04-08 00:00:00'),
(195, 7, 'coucou', 1, '2015-04-08 00:00:00'),
(196, 7, 'coucou', 1, '2015-04-08 00:00:00'),
(197, 7, 'coucou', 1, '2015-04-08 00:00:00'),
(198, 7, 'coucou', 1, '2015-04-08 00:00:00'),
(199, 7, 'coucou', 1, '2015-04-08 00:00:00'),
(200, 7, 'coucou', 1, '2015-04-08 00:00:00'),
(201, 7, 'coucou', 1, '2015-04-08 00:00:00'),
(202, 7, 'coucou', 1, '2015-04-08 00:00:00'),
(203, 7, 'coucou', 1, '2015-04-08 00:00:00'),
(204, 7, 'coucou', 1, '2015-04-08 00:00:00'),
(205, 7, 'coucou', 1, '2015-04-08 00:00:00'),
(206, 7, 'coucou', 1, '2015-04-08 00:00:00'),
(207, 7, 'coucou', 1, '2015-04-08 00:00:00'),
(208, 7, 'coucou', 1, '2015-04-08 00:00:00'),
(209, 7, 'coucou', 1, '2015-04-08 00:00:00'),
(210, 7, 'coucou', 1, '2015-04-08 00:00:00'),
(211, 7, 'coucou', 1, '2015-04-08 00:00:00'),
(212, 7, 'coucou', 1, '2015-04-08 00:00:00');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `note`
--

INSERT INTO `note` (`id`, `url`, `note`, `author`) VALUES
(1, 1, 7, 1);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `profil`
--

INSERT INTO `profil` (`id`, `user`, `date_inscription`, `avatar`, `description`, `sign`) VALUES
(1, 1, '2015-04-04', 'http://img15.hostingpics.net/thumbs/mini_631494Eresia.png', 'Co-fondateur du site', 'Blabla\r<br />\r<br />grande\r<br />\r<br />signature'),
(2, 2, '2015-04-04', '', 'Co-fondateur du site', '');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Contenu de la table `url`
--

INSERT INTO `url` (`id`, `url`, `category`, `description`, `author`, `date`) VALUES
(1, 'http://colaboraweb.wc.lt/index.php', 1, 'Site de partage d''URL (Il est génial)', 1, '2015-04-05 00:00:00'),
(7, 'https://real-debrid.com/', 1, 'Plutot un bon site', 1, '2015-04-08 00:00:00');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
