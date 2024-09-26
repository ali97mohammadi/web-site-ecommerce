-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : jeu. 19 sep. 2024 à 17:30
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
-- Base de données : `e-commerce`
--

-- --------------------------------------------------------

--
-- Structure de la table `admins`
--

DROP TABLE IF EXISTS `admins`;
CREATE TABLE IF NOT EXISTS `admins` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(100) DEFAULT NULL,
  `prenom` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `admins`
--

INSERT INTO `admins` (`id`, `nom`, `prenom`, `email`, `password`, `created_at`) VALUES
(1, 'mohammad', 'ali', 'ali@gmail.com', '$2y$10$9Wspzl1fV/S.CIL1iBtWp.KONNnj0z5xNmER7qJW.C9RPswF5IXjS', '2024-09-05 15:46:17');

-- --------------------------------------------------------

--
-- Structure de la table `clients`
--

DROP TABLE IF EXISTS `clients`;
CREATE TABLE IF NOT EXISTS `clients` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(100) DEFAULT NULL,
  `prenom` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `age` int DEFAULT NULL,
  `sexe` enum('H','F') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `tel` varchar(15) DEFAULT NULL,
  `adresse` text,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `clients`
--

INSERT INTO `clients` (`id`, `nom`, `prenom`, `email`, `password`, `age`, `sexe`, `tel`, `adresse`, `created_at`) VALUES
(1, 'mohammad', 'ali', 'ali@gmail.com', '$2y$10$kYgOuvmCFYz4n5qrPlMVQ.tkVk6CAjrEYksaYM4zxY09BUwB6T/h2', 27, 'H', '12345678', 'casa', '2024-09-05 20:13:53'),
(3, 'mohammad', 'med', 'med@gmail.com', '$2y$10$MmeoeTq6TJdRjVgmYzudQurdH485TEsAhYWW9yWuZRo3t0WdywHhy', 25, 'H', '0123456799', 'rabat', '2024-09-19 12:56:43');

-- --------------------------------------------------------

--
-- Structure de la table `commandes`
--

DROP TABLE IF EXISTS `commandes`;
CREATE TABLE IF NOT EXISTS `commandes` (
  `id` int NOT NULL AUTO_INCREMENT,
  `client_id` int DEFAULT NULL,
  `produit_id` int NOT NULL,
  `quantite` int NOT NULL,
  `date_commande` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `total` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `client_id` (`client_id`),
  KEY `produit_id` (`produit_id`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `commandes`
--

INSERT INTO `commandes` (`id`, `client_id`, `produit_id`, `quantite`, `date_commande`, `total`) VALUES
(1, 1, 0, 0, '2024-09-05 20:14:27', '0.00'),
(3, 1, 0, 0, '2024-09-05 21:34:19', '0.00'),
(4, 1, 0, 0, '2024-09-06 10:35:14', '0.00'),
(5, 1, 0, 0, '2024-09-06 12:10:24', '0.00'),
(6, 1, 0, 0, '2024-09-06 12:10:53', '0.00'),
(7, 1, 0, 0, '2024-09-07 12:06:16', '0.00'),
(8, 1, 0, 0, '2024-09-07 12:10:10', '0.00'),
(9, 1, 0, 0, '2024-09-07 12:11:55', '0.00'),
(10, 1, 0, 0, '2024-09-07 12:12:23', '0.00'),
(11, 1, 0, 0, '2024-09-07 12:28:40', '0.00'),
(12, 1, 0, 0, '2024-09-09 16:32:53', '0.00'),
(13, 1, 3, 1, '2024-09-09 21:34:03', '0.00'),
(14, 1, 3, 1, '2024-09-09 21:36:39', '0.00'),
(15, 1, 0, 0, '2024-09-10 00:02:25', '145.00'),
(16, 1, 0, 0, '2024-09-10 00:03:38', '600.00'),
(17, 1, 0, 0, '2024-09-10 01:06:19', '300.00'),
(18, NULL, 0, 0, '2024-09-11 12:40:52', '125.00'),
(19, 1, 0, 0, '2024-09-18 00:46:36', '250.00');

-- --------------------------------------------------------

--
-- Structure de la table `commandes_produits`
--

DROP TABLE IF EXISTS `commandes_produits`;
CREATE TABLE IF NOT EXISTS `commandes_produits` (
  `id` int NOT NULL AUTO_INCREMENT,
  `commande_id` int DEFAULT NULL,
  `produit_id` int DEFAULT NULL,
  `quantite` int DEFAULT NULL,
  `prix` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `commande_id` (`commande_id`),
  KEY `produit_id` (`produit_id`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `commandes_produits`
--

INSERT INTO `commandes_produits` (`id`, `commande_id`, `produit_id`, `quantite`, `prix`) VALUES
(1, 2, 1, 1, '300.00'),
(2, 3, 1, 1, '300.00'),
(3, 4, 1, 2, '300.00'),
(4, 5, 1, 3, '300.00'),
(5, 6, 1, 3, '300.00'),
(6, 7, 1, 3, '300.00'),
(7, 8, 1, 3, '300.00'),
(8, 9, 1, 1, '300.00'),
(9, 10, 1, 1, '300.00'),
(10, 11, 1, 1, '300.00'),
(11, 12, 2, 1, '125.00'),
(12, 15, 4, 1, '145.00'),
(13, 16, 3, 2, '300.00'),
(14, 17, 7, 1, '300.00'),
(15, 18, 2, 1, '125.00'),
(16, 19, 2, 2, '125.00');

-- --------------------------------------------------------

--
-- Structure de la table `details_commande`
--

DROP TABLE IF EXISTS `details_commande`;
CREATE TABLE IF NOT EXISTS `details_commande` (
  `id` int NOT NULL AUTO_INCREMENT,
  `commande_id` int NOT NULL,
  `produit_id` int NOT NULL,
  `quantite` int NOT NULL,
  `prix` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `commande_id` (`commande_id`),
  KEY `produit_id` (`produit_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `messages`
--

DROP TABLE IF EXISTS `messages`;
CREATE TABLE IF NOT EXISTS `messages` (
  `id` int NOT NULL AUTO_INCREMENT,
  `client_id` int DEFAULT NULL,
  `message` text,
  `date_envoi` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `client_id` (`client_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `messages`
--

INSERT INTO `messages` (`id`, `client_id`, `message`, `date_envoi`) VALUES
(1, 1, 'ali', '2024-09-16 00:42:33'),
(2, 1, 'ali', '2024-09-16 11:54:55'),
(3, 1, 'ali', '2024-09-16 11:59:06');

-- --------------------------------------------------------

--
-- Structure de la table `produits`
--

DROP TABLE IF EXISTS `produits`;
CREATE TABLE IF NOT EXISTS `produits` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) DEFAULT NULL,
  `description` text,
  `prix` decimal(10,2) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `stock` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `produits`
--

INSERT INTO `produits` (`id`, `nom`, `description`, `prix`, `image`, `created_at`, `stock`) VALUES
(1, 'Smartwatch Green', 'green', '300.00', 'w2.png', '2024-09-05 15:54:49', 46),
(2, 'Smartwatch Blue', 'bleu', '125.00', 'w4.png', '2024-09-07 16:27:17', 16),
(3, 'Smartwatch black', 'black', '300.00', 'w1.png', '2024-09-09 15:52:36', 26),
(4, 'Smartwatch pink', 'pink', '145.00', 'w3.png', '2024-09-09 15:53:36', 49),
(5, 'Smartwatch Yellow', 'yellow', '200.00', 'w6.png', '2024-09-09 15:54:41', 40),
(7, 'Smartwatch white', 'white', '300.00', 'w5.png', '2024-09-09 15:57:07', 39);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
