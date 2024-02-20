-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mar. 20 fév. 2024 à 10:51
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
-- Base de données : `savourer_la_sante_alpha`
--

-- --------------------------------------------------------

--
-- Structure de la table `carousel`
--

DROP TABLE IF EXISTS `carousel`;
CREATE TABLE IF NOT EXISTS `carousel` (
  `id` int NOT NULL AUTO_INCREMENT,
  `state` int NOT NULL DEFAULT '1',
  `name` tinytext,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `carousel`
--

INSERT INTO `carousel` (`id`, `state`, `name`) VALUES
(1, 0, 'img_1.jpg'),
(2, 1, 'img_2.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `comments`
--

DROP TABLE IF EXISTS `comments`;
CREATE TABLE IF NOT EXISTS `comments` (
  `comment_id` int NOT NULL AUTO_INCREMENT,
  `user_id` int DEFAULT NULL,
  `recette_id` int DEFAULT NULL,
  `comment` longtext,
  PRIMARY KEY (`comment_id`),
  KEY `recettes_comments` (`recette_id`),
  KEY `users_comments` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `comments`
--

INSERT INTO `comments` (`comment_id`, `user_id`, `recette_id`, `comment`) VALUES
(1, NULL, 15, 'c\'est bon ou pas qui a tester ?');

-- --------------------------------------------------------

--
-- Structure de la table `ingredients`
--

DROP TABLE IF EXISTS `ingredients`;
CREATE TABLE IF NOT EXISTS `ingredients` (
  `ingredients_id` int NOT NULL AUTO_INCREMENT,
  `name` tinytext,
  `ig` varchar(4) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL COMMENT 'Indice glycémique pour 100g',
  PRIMARY KEY (`ingredients_id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `ingredients`
--

INSERT INTO `ingredients` (`ingredients_id`, `name`, `ig`) VALUES
(1, 'Asperge', '15'),
(2, 'Aubergine', '15'),
(3, 'Avocat', '10'),
(4, 'Brocoli', '10'),
(5, 'Carotte', '35'),
(6, 'Céleri', '15'),
(7, 'Champignon', '15'),
(8, 'Chou-fleur', '10'),
(9, 'Concombre', '15'),
(10, 'Épinard', '15'),
(11, 'Haricot vert', '15'),
(12, 'Laitue', '10'),
(13, 'Oignon', '10'),
(14, 'Poivron', '15'),
(15, 'Radis', '15'),
(16, 'Tomate', '15');

-- --------------------------------------------------------

--
-- Structure de la table `recettes`
--

DROP TABLE IF EXISTS `recettes`;
CREATE TABLE IF NOT EXISTS `recettes` (
  `recette_id` int NOT NULL AUTO_INCREMENT,
  `saison_id` int DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `description` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `img` varchar(255) DEFAULT NULL,
  `date_create` date DEFAULT NULL,
  `date_update` date DEFAULT NULL,
  `number_views` varchar(5) DEFAULT NULL,
  `online` tinyint(1) DEFAULT '0' COMMENT '0=off / 1=on',
  PRIMARY KEY (`recette_id`)
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `recettes`
--

INSERT INTO `recettes` (`recette_id`, `saison_id`, `name`, `description`, `img`, `date_create`, `date_update`, `number_views`, `online`) VALUES
(15, NULL, 'choucroute', '', 'recette_7.jpeg', '2024-02-06', NULL, NULL, 1),
(18, NULL, 'choucroute', '', 'recette_7.jpeg', '2024-02-06', NULL, NULL, 0),
(19, NULL, 'choucroute', '', 'recette_7.jpeg', '2024-02-06', NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Structure de la table `recette_ingredients_asso`
--

DROP TABLE IF EXISTS `recette_ingredients_asso`;
CREATE TABLE IF NOT EXISTS `recette_ingredients_asso` (
  `recette_ingredients_id` int NOT NULL AUTO_INCREMENT,
  `recette_id` int DEFAULT NULL,
  `ingredient_id` int DEFAULT NULL,
  PRIMARY KEY (`recette_ingredients_id`),
  KEY `recette_rectte_ingredients_asso` (`recette_id`),
  KEY `ingredients_rectte_ingredients_asso` (`ingredient_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `recette_ingredients_asso`
--

INSERT INTO `recette_ingredients_asso` (`recette_ingredients_id`, `recette_id`, `ingredient_id`) VALUES
(1, 15, 1);

-- --------------------------------------------------------

--
-- Structure de la table `recherches`
--

DROP TABLE IF EXISTS `recherches`;
CREATE TABLE IF NOT EXISTS `recherches` (
  `recherche_id` int NOT NULL AUTO_INCREMENT,
  `recette_id` int DEFAULT NULL,
  `user_id` int DEFAULT NULL,
  `ingredient_id` int DEFAULT NULL,
  `date_create` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`recherche_id`),
  KEY `ingredient_recherche` (`ingredient_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `roles`
--

DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `role_id` int NOT NULL AUTO_INCREMENT,
  `role` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`role_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `roles`
--

INSERT INTO `roles` (`role_id`, `role`) VALUES
(1, 'admin'),
(2, 'user'),
(3, 'bebe_admin');

-- --------------------------------------------------------

--
-- Structure de la table `saisons`
--

DROP TABLE IF EXISTS `saisons`;
CREATE TABLE IF NOT EXISTS `saisons` (
  `saison_id` int NOT NULL AUTO_INCREMENT,
  `saison` varchar(50) NOT NULL,
  `mois_debut` int NOT NULL,
  `jour_debut` int NOT NULL,
  `mois_fin` int NOT NULL,
  `jour_fin` int NOT NULL,
  PRIMARY KEY (`saison_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `saisons`
--

INSERT INTO `saisons` (`saison_id`, `saison`, `mois_debut`, `jour_debut`, `mois_fin`, `jour_fin`) VALUES
(1, 'Hiver', 12, 21, 3, 20),
(2, 'Printemps', 3, 21, 6, 20),
(3, 'Eté', 6, 21, 9, 20),
(4, 'Automne', 9, 21, 12, 20);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `mail` varchar(100) DEFAULT NULL,
  `pass` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `img` varchar(100) DEFAULT NULL,
  `role_id` int DEFAULT NULL,
  `date_connect` datetime DEFAULT NULL,
  `random_key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `date_creation` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`user_id`, `name`, `first_name`, `mail`, `pass`, `img`, `role_id`, `date_connect`, `random_key`, `date_creation`) VALUES
(3, 'damien', 'vimard', 'damien@mail.fr', '123456', 'yurts-4956344_1920.jpg', NULL, '2024-02-12 13:39:58', 'f0c4adc75c6585b69a14f2ca3ad32999', '2024-02-13 15:06:04'),
(4, 'roberto', 'le créput', 'roberto@mail.fr', '123456', 'bow-topped-wagon-5315000_1920.jpg', NULL, NULL, NULL, NULL),
(7, 'dede', 'le cochon', 'dede@mail.fr', '123', 'B9723937725Z.1_20200706154017_000+GJKG9MMEQ.1-0.png-3719557911.jpg', NULL, '2024-02-14 15:02:56', NULL, '2024-02-14 10:56:35'),
(8, 'riri', 'le filou', 'riri@mail.fr', '123456', 'sky-2628441_1920.jpg', NULL, NULL, NULL, NULL),
(15, 'test2', 'test2', 'test2', '', NULL, NULL, NULL, NULL, NULL),
(17, 'test3', 'test3', 'test3', '', NULL, NULL, NULL, NULL, NULL);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `recettes_comments` FOREIGN KEY (`recette_id`) REFERENCES `recettes` (`recette_id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  ADD CONSTRAINT `users_comments` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE RESTRICT;

--
-- Contraintes pour la table `recette_ingredients_asso`
--
ALTER TABLE `recette_ingredients_asso`
  ADD CONSTRAINT `ingredients_rectte_ingredients_asso` FOREIGN KEY (`ingredient_id`) REFERENCES `ingredients` (`ingredients_id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  ADD CONSTRAINT `recette_rectte_ingredients_asso` FOREIGN KEY (`recette_id`) REFERENCES `recettes` (`recette_id`) ON DELETE CASCADE ON UPDATE RESTRICT;

--
-- Contraintes pour la table `recherches`
--
ALTER TABLE `recherches`
  ADD CONSTRAINT `ingredient_recherche` FOREIGN KEY (`ingredient_id`) REFERENCES `ingredients` (`ingredients_id`) ON DELETE CASCADE ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
