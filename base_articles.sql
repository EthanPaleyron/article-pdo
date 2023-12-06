-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mer. 06 déc. 2023 à 21:27
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
) ENGINE=InnoDB AUTO_INCREMENT=62 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `articles`
--

INSERT INTO `articles` (`ID_ARTICLE`, `LABEL_UTILISATEUR_ARTICLE`, `NOM_ARTICLE`, `DATE_HEURE_ARTICLE`, `IMAGE_ARTICLE`, `DESCRIPTION_ARTICLE`) VALUES
(60, 1, 'Ethann', '2023-12-06 18:32:58', '618262038691469.jpg', 'vgrezgrtntr'),
(61, 1, 'Jade toute nue', '2023-12-06 21:10:38', '98800591535Capture d’écran 2023-11-26 210822.png', 'hmmmmmmmm miam');

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
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `commentaires`
--

INSERT INTO `commentaires` (`ID_COMMENTAIRE`, `LABEL_ARTICLE`, `COMMENTAIRE_ARTICLE`, `DATE_HEURS_COMMENTAIRE`, `LABEL_COMMENTAIRE_UTILISATEUR`) VALUES
(46, 60, 'testt', '2023-12-05 21:21:57', 1),
(47, 60, 'suce', '2023-12-06 20:13:22', 1),
(48, 61, 'il est PD ce mec', '2023-12-06 21:09:55', 1);

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
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `sou-commentaires`
--

INSERT INTO `sou-commentaires` (`ID_SOU_COMMENTAIRE`, `LABEL_COMMENTAIRE`, `SOU_COMMENTAIRE`, `DATE_HEURE_SOU_COMMENTAIRE`, `LABEL_SOU_COMMENTAIRE_UTILISATEUR`) VALUES
(4, 46, 'sou', '2023-12-05 21:22:00', 1),
(5, 46, 'test', '2023-12-05 21:22:04', 1),
(6, 47, 'ho ouiiii', '2023-12-06 20:13:28', 1),
(7, 47, 'j\'addore', '2023-12-06 20:13:33', 1),
(8, 48, 'tout a fait daccord', '2023-12-06 21:10:02', 1),
(9, 48, 'ouais ta vue', '2023-12-06 21:10:09', 1),
(10, 48, 'mdr oui', '2023-12-06 21:10:16', 1),
(11, 48, 'hahahahahhahahahahahha', '2023-12-06 21:10:22', 1);

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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `utilisateurs`
--

INSERT INTO `utilisateurs` (`ID_UTILISATEUR`, `NOM_UTILISATEUR`, `MDP_UTILISATEUR`) VALUES
(1, 'ethan', '$2y$10$AhT6EKWhJMD88BtuFfiE3.YvWAnKPnbHAOw9UP3iQ.IwwJjx9lq6m'),
(2, 'lilian', '$2y$10$Xki3EEZdhb7Oqg9fO5kys.ccsiw8DnkEJH13rNJL.Uig7izrleSkW'),
(5, 'toto', '$2y$10$ZQeVO4Ulhq8KFgwAvQZ.j.VsEj.hEpx95h86Vqre.TXDpHKVFVWiq');

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
