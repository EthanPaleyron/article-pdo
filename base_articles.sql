-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mer. 06 déc. 2023 à 22:09
-- Version du serveur : 8.0.31
-- Version de PHP : 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `base_articles`
--

-- --------------------------------------------------------

--
-- Structure de la table `articles`
--

DROP TABLE IF EXISTS `articles`;
CREATE TABLE IF NOT EXISTS `articles` (
  `ID_ARTICLE` int NOT NULL AUTO_INCREMENT,
  `LABEL_UTILISATEUR_ARTICLE` int NOT NULL,
  `NOM_ARTICLE` varchar(60) NOT NULL,
  `DATE_HEURE_ARTICLE` datetime NOT NULL,
  `IMAGE_ARTICLE` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `DESCRIPTION_ARTICLE` varchar(500) NOT NULL,
  PRIMARY KEY (`ID_ARTICLE`),
  KEY `LABEL_UTILISATEUR_ARTICLE` (`LABEL_UTILISATEUR_ARTICLE`)
) ENGINE=InnoDB AUTO_INCREMENT=68 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `commentaires`
--

DROP TABLE IF EXISTS `commentaires`;
CREATE TABLE IF NOT EXISTS `commentaires` (
  `ID_COMMENTAIRE` int NOT NULL AUTO_INCREMENT,
  `LABEL_ARTICLE` int NOT NULL,
  `COMMENTAIRE_ARTICLE` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `DATE_HEURS_COMMENTAIRE` datetime NOT NULL,
  `LABEL_COMMENTAIRE_UTILISATEUR` int NOT NULL,
  PRIMARY KEY (`ID_COMMENTAIRE`),
  KEY `LABEL_ARTICLE` (`LABEL_ARTICLE`),
  KEY `LABEL_ARTICLE_2` (`LABEL_ARTICLE`)
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `sou-commentaires`
--

DROP TABLE IF EXISTS `sou-commentaires`;
CREATE TABLE IF NOT EXISTS `sou-commentaires` (
  `ID_SOU_COMMENTAIRE` int NOT NULL AUTO_INCREMENT,
  `LABEL_COMMENTAIRE` int NOT NULL,
  `SOU_COMMENTAIRE` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `DATE_HEURE_SOU_COMMENTAIRE` datetime NOT NULL,
  `LABEL_SOU_COMMENTAIRE_UTILISATEUR` int NOT NULL,
  PRIMARY KEY (`ID_SOU_COMMENTAIRE`),
  KEY `LABEL_COMMENTAIRE` (`LABEL_COMMENTAIRE`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

DROP TABLE IF EXISTS `utilisateurs`;
CREATE TABLE IF NOT EXISTS `utilisateurs` (
  `ID_UTILISATEUR` int NOT NULL AUTO_INCREMENT,
  `NOM_UTILISATEUR` varchar(60) NOT NULL,
  `MDP_UTILISATEUR` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`ID_UTILISATEUR`),
  UNIQUE KEY `NOM_UTILISATEUR` (`NOM_UTILISATEUR`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `articles`
--
ALTER TABLE `articles`
  ADD CONSTRAINT `articles_ibfk_1` FOREIGN KEY (`LABEL_UTILISATEUR_ARTICLE`) REFERENCES `utilisateurs` (`ID_UTILISATEUR`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Contraintes pour la table `commentaires`
--
ALTER TABLE `commentaires`
  ADD CONSTRAINT `commentaires_ibfk_1` FOREIGN KEY (`LABEL_ARTICLE`) REFERENCES `articles` (`ID_ARTICLE`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Contraintes pour la table `sou-commentaires`
--
ALTER TABLE `sou-commentaires`
  ADD CONSTRAINT `sou-commentaires_ibfk_1` FOREIGN KEY (`LABEL_COMMENTAIRE`) REFERENCES `commentaires` (`ID_COMMENTAIRE`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
