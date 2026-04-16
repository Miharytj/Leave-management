-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : jeu. 10 oct. 2024 à 07:35
-- Version du serveur : 8.0.27
-- Version de PHP : 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `gconge`
--

-- --------------------------------------------------------

--
-- Structure de la table `tconge`
--

DROP TABLE IF EXISTS `tconge`;
CREATE TABLE IF NOT EXISTS `tconge` (
  `idconge` int(10) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT,
  `datedebut` date DEFAULT NULL,
  `datefin` date DEFAULT NULL,
  `qtt` int DEFAULT NULL,
  `soldeutilise` int DEFAULT NULL,
  `solderestant` int DEFAULT NULL,
  `matre` int(5) UNSIGNED ZEROFILL DEFAULT NULL,
  `idtypec` int(5) UNSIGNED ZEROFILL DEFAULT NULL,
  PRIMARY KEY (`idconge`),
  KEY `fk_matre` (`matre`),
  KEY `fk_idtypec` (`idtypec`)
) ENGINE=InnoDB AUTO_INCREMENT=100 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `temploye`
--

DROP TABLE IF EXISTS `temploye`;
CREATE TABLE IF NOT EXISTS `temploye` (
  `matre` int(5) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT,
  `matricule` varchar(10) DEFAULT NULL,
  `nome` varchar(50) NOT NULL,
  `prenome` varchar(255) NOT NULL,
  `adre` varchar(50) NOT NULL,
  `tel` varchar(13) NOT NULL,
  `mail` varchar(255) NOT NULL,
  `datedebut` date DEFAULT NULL,
  `soldeconge` int DEFAULT NULL,
  `dateentresolde` date DEFAULT NULL,
  `idservice` int(5) UNSIGNED ZEROFILL DEFAULT NULL,
  PRIMARY KEY (`matre`),
  KEY `fk_service` (`idservice`)
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `temploye`
--

INSERT INTO `temploye` (`matre`, `matricule`, `nome`, `prenome`, `adre`, `tel`, `mail`, `datedebut`, `soldeconge`, `dateentresolde`, `idservice`) VALUES
(00041, 'A001', 'Randria', 'Rogers', 'ambatobe', '0340526662', 'randria@gmail.com', '2023-06-09', 30, '2024-06-09', 00004),
(00042, 'A002', 'rakoto', 'paul', 'analamahitsy', '0346525565', 'paul@gmail.com', '2023-07-16', 30, '2024-07-16', 00002),
(00043, 'A003', 'jean', 'solo', 'analakely', '0340526662', 'solo@gmail.com', '2024-06-14', 0, '2025-06-14', 00006),
(00044, 'A004', 'rasoa', 'perline', 'ambatobe', '0340526662', 'rasoa@gmail.com', '2023-02-10', 30, '2024-02-10', 00002),
(00045, 'A005', 'rova', 'sitraka', 'analakely', '0340526662', 'rova@gmail.com', '2023-05-18', 30, '2024-05-18', 00006),
(00046, 'A006', 'rasoazanany', 'perle', 'analakely', '0340526662', 'perle@gmail.com', '2023-10-10', 0, '2024-10-10', 00004),
(00047, 'A007', 'randrianasolo', 'beravina', 'ambalavao', '0346525565', 'bera@gmail.com', '2022-05-11', 30, '2023-05-11', 00002),
(00048, 'A008', 'Andrianomena', 'lova', 'analakely', '0340526662', 'lova@gmail.com', '2023-06-09', 30, '2024-06-09', 00006);

-- --------------------------------------------------------

--
-- Structure de la table `tjourf`
--

DROP TABLE IF EXISTS `tjourf`;
CREATE TABLE IF NOT EXISTS `tjourf` (
  `idjourf` int(5) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT,
  `datejourf` date DEFAULT NULL,
  `nomjourf` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`idjourf`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `tjourf`
--

INSERT INTO `tjourf` (`idjourf`, `datejourf`, `nomjourf`) VALUES
(00005, '2024-10-16', 'Sortie'),
(00006, '2024-10-10', 'jiuiygh');

-- --------------------------------------------------------

--
-- Structure de la table `tservice`
--

DROP TABLE IF EXISTS `tservice`;
CREATE TABLE IF NOT EXISTS `tservice` (
  `idservice` int(5) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT,
  `nomservice` varchar(50) NOT NULL,
  PRIMARY KEY (`idservice`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `tservice`
--

INSERT INTO `tservice` (`idservice`, `nomservice`) VALUES
(00002, 'caissier(e)'),
(00004, 'Comptable'),
(00005, 'Directeur'),
(00006, 'Receptioniste');

-- --------------------------------------------------------

--
-- Structure de la table `ttypec`
--

DROP TABLE IF EXISTS `ttypec`;
CREATE TABLE IF NOT EXISTS `ttypec` (
  `idtypec` int(5) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT,
  `nomtype` varchar(50) NOT NULL,
  PRIMARY KEY (`idtypec`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `ttypec`
--

INSERT INTO `ttypec` (`idtypec`, `nomtype`) VALUES
(00001, 'Congé de matérnité');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT,
  `username` varchar(155) DEFAULT NULL,
  `password` varchar(155) DEFAULT NULL,
  `email` varchar(155) DEFAULT NULL,
  `reset_token` varchar(155) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `email` (`email`),
  KEY `username` (`username`),
  KEY `email_2` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `reset_token`) VALUES
(0000000001, 'tendry', '$2y$10$CF/OYykntmR3NlkNjAP.nuMr1EPJ2NF9OmqUzgNZ4XEoITmfokfJ6', 'tendry@gmail.com', 'd597829019ad7d14d024a2c5968d60f61465dae706cf2330a7fcf21ec1f301f249ea16b6cb8e5221ef93d333c60b9a90ffd7'),
(0000000002, 'admin', '$2y$10$ddTIxGttP3BdOLusBBlOcut3ffyRfDfykoFNNSfwfpNcZgUS/.JfW', 'admin@gmail.com', NULL);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
