-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Ven 16 Décembre 2016 à 17:00
-- Version du serveur :  10.1.13-MariaDB
-- Version de PHP :  5.6.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `osecours`
--

-- --------------------------------------------------------

--
-- Structure de la table `expertises`
--

CREATE TABLE `expertises` (
  `id` int(2) NOT NULL,
  `id_teacher` int(11) NOT NULL,
  `id_subject` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `lessons`
--

CREATE TABLE `lessons` (
  `id_student` int(11) NOT NULL,
  `id_teacher` int(11) NOT NULL,
  `date` date NOT NULL,
  `hstart` int(2) NOT NULL,
  `hend` int(2) NOT NULL,
  `id_subjects` int(2) NOT NULL,
  `mobile` int(1) NOT NULL,
  `token` varchar(255) CHARACTER SET latin1 NOT NULL,
  `comment` longtext CHARACTER SET latin1 NOT NULL,
  `rating` int(1) NOT NULL,
  `statut` char(1) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Contenu de la table `lessons`
--

INSERT INTO `lessons` (`id_student`, `id_teacher`, `date`, `hstart`, `hend`, `id_subjects`, `mobile`, `token`, `comment`, `rating`, `statut`) VALUES
(1, 1, '2016-12-16', 21, 21, 2, 0, '', '', 0, '');

-- --------------------------------------------------------

--
-- Structure de la table `levels`
--

CREATE TABLE `levels` (
  `id` int(2) NOT NULL,
  `level` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `levels`
--

INSERT INTO `levels` (`id`, `level`) VALUES
(1, 'Collège'),
(2, 'Lycée'),
(3, 'Etudes supérieures');

-- --------------------------------------------------------

--
-- Structure de la table `subjects`
--

CREATE TABLE `subjects` (
  `id` int(2) NOT NULL,
  `name` varchar(30) CHARACTER SET latin1 NOT NULL,
  `img` varchar(50) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32;

--
-- Contenu de la table `subjects`
--

INSERT INTO `subjects` (`id`, `name`, `img`) VALUES
(1, 'MATHEMATIQUE', 'img/calculator.svg'),
(2, 'FRANCAIS', 'img/france.svg'),
(3, 'ANGLAIS', 'img/united-kingdom.svg'),
(4, 'PHYSIQUE', 'img/atom.svg'),
(5, 'CHIMIE', 'img/chemistry.svg'),
(6, 'ALLEMAND', 'img/germany.svg'),
(7, 'ESPAGNOL', 'img/spain.svg'),
(8, 'SVT', 'img/biology.svg'),
(9, 'HISTOIRE', 'img/history.svg'),
(10, 'GEOGRAPHIE', 'img/planet-earth.svg'),
(11, 'SOLFEGE', 'img/music.svg');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `is_teacher` tinyint(1) NOT NULL,
  `is_student` tinyint(1) NOT NULL,
  `lastname` varchar(50) CHARACTER SET latin1 NOT NULL,
  `firstname` varchar(50) CHARACTER SET latin1 NOT NULL,
  `streetnumber` int(3) NOT NULL,
  `address` varchar(250) CHARACTER SET latin1 NOT NULL,
  `city` varchar(50) CHARACTER SET latin1 NOT NULL,
  `postcode` char(5) CHARACTER SET latin1 NOT NULL,
  `lng` decimal(33,30) NOT NULL,
  `lat` decimal(33,30) NOT NULL,
  `phone` varchar(12) CHARACTER SET latin1 NOT NULL,
  `email` varchar(50) CHARACTER SET latin1 NOT NULL,
  `password` varchar(62) CHARACTER SET latin1 NOT NULL,
  `token_psw` varchar(255) CHARACTER SET latin1 NOT NULL,
  `id_level` int(2) NOT NULL,
  `mobility` varchar(30) NOT NULL,
  `price` int(2) NOT NULL,
  `description` longtext CHARACTER SET latin1 NOT NULL,
  `avatar` varchar(255) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Index pour les tables exportées
--

--
-- Index pour la table `expertises`
--
ALTER TABLE `expertises`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `lessons`
--
ALTER TABLE `lessons`
  ADD PRIMARY KEY (`id_student`,`id_teacher`,`date`,`hstart`,`hend`);

--
-- Index pour la table `levels`
--
ALTER TABLE `levels`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `expertises`
--
ALTER TABLE `expertises`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `levels`
--
ALTER TABLE `levels`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pour la table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
