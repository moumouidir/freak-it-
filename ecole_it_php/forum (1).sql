-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mar. 06 fév. 2024 à 17:28
-- Version du serveur : 8.2.0
-- Version de PHP : 8.2.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `forum`
--

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `ID_CATEGORY` int NOT NULL AUTO_INCREMENT,
  `NAME_CATEGORY` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`ID_CATEGORY`)
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `categories`
--

INSERT INTO `categories` (`ID_CATEGORY`, `NAME_CATEGORY`) VALUES
(35, 'les robes soires'),
(36, 'costumes pour halowen'),
(40, 'foot'),
(41, 'tenue de sport');

-- --------------------------------------------------------

--
-- Structure de la table `inscription`
--

DROP TABLE IF EXISTS `inscription`;
CREATE TABLE IF NOT EXISTS `inscription` (
  `ID_USER` int NOT NULL AUTO_INCREMENT,
  `PSEUDO` varchar(33) NOT NULL,
  `FNAME` varchar(33) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `FIRSTNAME` varchar(33) NOT NULL,
  `EMAIL` varchar(50) NOT NULL,
  `PWD` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `FDATE` date NOT NULL,
  `FROLE` varchar(6) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT 'user',
  `TOKEN_USER` varchar(100) NOT NULL,
  `PHOTO` blob,
  `FDESCRIPTION` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `COMPTE_VALIDATE` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`ID_USER`)
) ENGINE=InnoDB AUTO_INCREMENT=110 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `inscription`
--

INSERT INTO `inscription` (`ID_USER`, `PSEUDO`, `FNAME`, `FIRSTNAME`, `EMAIL`, `PWD`, `FDATE`, `FROLE`, `TOKEN_USER`, `PHOTO`, `FDESCRIPTION`, `COMPTE_VALIDATE`) VALUES
(9, 'idir129', '', '', 'moumouidir2018@gmail.com', '$2y$10$6PnCZ4Wqk0DVyud.k1PewueywkwRcREdiRNt.RxJmXWKzS1f6YSdO', '2024-01-07', 'user', 'NoLdXAU8tzY3wTSznY4HXQJDc', 0x706578656c732d70686f746f2d36353736372e6a706567, 'tout le monde parent un jour ou un notre', 1),
(98, 'Roben', 'gdh', 'bdnbn', 'robenfaha92@gmail.com', '$2y$10$qIwwYtOHCrlbFdZEP01lquIAW3ktEKk4sEw0p766SKDcOqYzc8iz.', '2004-03-12', 'admin', 'tVXco56KLZhGkBsYkb9P7Zssn', 0x6176617461725f6465666175742e706e67, 'baner', 0),
(109, 'idir123', 'moumou', 'idir', 'moumoidir@gmail.com', '$2y$10$DrPW2gz6LJIOlxfyl7BH0uKIksZW0U3FfmQf0NGzarLm6ox.ZkoXK', '2024-02-05', 'admin', 'compte active', 0x696d675f70726f66696c2f64376430363436386365393532313136646166616166646132316135623435622e206a7067, 'shgsgjhsshiuksdde', 1);

-- --------------------------------------------------------

--
-- Structure de la table `messages`
--

DROP TABLE IF EXISTS `messages`;
CREATE TABLE IF NOT EXISTS `messages` (
  `ID_M` int NOT NULL AUTO_INCREMENT,
  `ID_TOPIC` int NOT NULL,
  `ID_USER` int NOT NULL,
  `PSEUDO_USER` varchar(33) NOT NULL,
  `CONTENU` text NOT NULL,
  `DATE_CREATE` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`ID_M`),
  KEY `ID_USER` (`ID_USER`),
  KEY `ID_TOPIC` (`ID_TOPIC`)
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `messages`
--

INSERT INTO `messages` (`ID_M`, `ID_TOPIC`, `ID_USER`, `PSEUDO_USER`, `CONTENU`, `DATE_CREATE`) VALUES
(33, 26, 109, 'idir123', 'fhjhg uhkk,kl,lmlm;ll', '2024-02-04 07:02:51'),
(36, 28, 109, 'idir123', 'yghjklkùmnbijkn ', '2024-02-05 05:02:15'),
(39, 29, 109, 'idir123', 'dsqxqxqdcqqsxq', '2024-02-05 07:02:23'),
(40, 30, 9, 'idir', 'qssfdzqsfcqsdcqs', '2024-02-05 07:02:21'),
(41, 31, 109, 'idir123', 'cest quand', '2024-02-06 01:02:17');

-- --------------------------------------------------------

--
-- Structure de la table `sujets`
--

DROP TABLE IF EXISTS `sujets`;
CREATE TABLE IF NOT EXISTS `sujets` (
  `ID_TOPIC` int NOT NULL AUTO_INCREMENT,
  `ID_CATEGORY` int NOT NULL,
  `TITLE` varchar(33) NOT NULL,
  `ID_USER` int NOT NULL,
  `PSEUDO_USER` varchar(33) NOT NULL,
  `DATE_CREATE` timestamp NOT NULL,
  `TOPIC_CLOSE` tinyint NOT NULL DEFAULT '0',
  PRIMARY KEY (`ID_TOPIC`),
  KEY `ID_USER` (`ID_USER`),
  KEY `ID_CATEGOTY` (`ID_CATEGORY`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `sujets`
--

INSERT INTO `sujets` (`ID_TOPIC`, `ID_CATEGORY`, `TITLE`, `ID_USER`, `PSEUDO_USER`, `DATE_CREATE`, `TOPIC_CLOSE`) VALUES
(26, 35, 'sport', 109, 'idir123', '2024-02-04 07:02:51', 0),
(28, 35, 'danger', 109, 'idir123', '2024-02-05 05:02:15', 0),
(29, 40, 'foot', 109, 'idir123', '2024-02-05 07:02:23', 0),
(30, 35, 'qdqqdkqd', 9, 'idir', '2024-02-05 07:02:21', 0),
(31, 35, 'fete de 8 mars', 109, 'idir123', '2024-02-06 01:02:17', 0);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages_ibfk_1` FOREIGN KEY (`ID_USER`) REFERENCES `inscription` (`ID_USER`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `messages_ibfk_2` FOREIGN KEY (`ID_TOPIC`) REFERENCES `sujets` (`ID_TOPIC`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `sujets`
--
ALTER TABLE `sujets`
  ADD CONSTRAINT `sujets_ibfk_1` FOREIGN KEY (`ID_USER`) REFERENCES `inscription` (`ID_USER`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `sujets_ibfk_2` FOREIGN KEY (`ID_CATEGORY`) REFERENCES `categories` (`ID_CATEGORY`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
