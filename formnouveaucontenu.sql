-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mer. 03 mars 2021 à 20:09
-- Version du serveur :  8.0.21
-- Version de PHP : 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `netflix_projet`
--

-- --------------------------------------------------------

--
-- Structure de la table `formnouveaucontenu`
--

DROP TABLE IF EXISTS `formnouveaucontenu`;
CREATE TABLE IF NOT EXISTS `formnouveaucontenu` (
  `idNouveauContenu` int NOT NULL AUTO_INCREMENT,
  `Titre` varchar(250) NOT NULL,
  `Platform` varchar(100) NOT NULL,
  `TypeVideo` varchar(100) NOT NULL,
  `LienDirect` varchar(200) NOT NULL,
  `DateSoumis` date NOT NULL,
  `Status` text NOT NULL,
  PRIMARY KEY (`idNouveauContenu`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `formnouveaucontenu`
--

INSERT INTO `formnouveaucontenu` (`idNouveauContenu`, `Titre`, `Platform`, `TypeVideo`, `LienDirect`, `DateSoumis`, `Status`) VALUES
(1, 'TItreasd', 'youtube', 'video', 'sdfsdfsdf.com', '2021-02-10', 'Approuve'),
(4, 'asdasdtitre', 'youtube', 'video', 'www.lienutile.com', '2021-03-02', 'Approuve'),
(6, 'asdasd', 'youtube', 'film', 'www.test.net', '2021-03-02', 'Approuve'),
(9, 'asdasdtitre', 'Netflix', 'film', 'www.lienutile.cer', '2021-03-02', 'Approuve'),
(10, 'asdasd', 'Netflix', 'video', 'www.lien.net', '2021-03-02', 'Approuve'),
(11, 'Louis et balein', 'youtuekids', 'video', 'www.fiable100sure.net', '2021-03-02', 'Approuve'),
(13, 'test', 'asdasd', 'video', 'qweqweqwe', '2021-03-02', 'Approuve'),
(14, 'asdasd', 'asdasd', 'video', 'asdasdasd', '2021-03-02', 'Approuve'),
(15, 'asdasd', 'asdasd', 'video', 'qweqwe', '2021-03-02', 'Approuve'),
(16, 'asd', 'youtube', 'video', 'gjkgjhgj', '2021-03-02', ''),
(17, 'test', '', 'video', '', '2021-03-02', ''),
(18, '', '', 'video', '', '2021-03-02', ''),
(19, 'asdasd', 'youtube', 'video', 'qweqweqwe', '2021-03-02', '');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
