-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : ven. 24 jan. 2025 à 16:29
-- Version du serveur : 10.4.24-MariaDB
-- Version de PHP : 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `crud`
--

-- --------------------------------------------------------

--
-- Structure de la table `calendrier`
--

CREATE TABLE `calendrier` (
  `idCourSeance` int(11) NOT NULL,
  `idCoursCours` int(11) NOT NULL,
  `DateCours` date NOT NULL,
  `Supprime` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `calendrier`
--

INSERT INTO `calendrier` (`idCourSeance`, `idCoursCours`, `DateCours`, `Supprime`) VALUES
(985, 148, '2024-12-12', 1),
(986, 148, '2024-12-19', 1),
(987, 149, '2024-12-10', 1),
(988, 149, '2024-12-17', 1),
(989, 150, '2024-12-19', 1),
(990, 150, '2024-12-26', 1),
(991, 149, '2025-01-03', 0),
(992, 151, '2025-01-16', 1),
(993, 152, '2025-01-23', 1),
(994, 148, '2025-01-29', 1),
(1003, 152, '2025-01-17', 1),
(1004, 148, '2025-01-29', 1),
(1005, 149, '2025-01-07', 0),
(1006, 150, '2025-01-08', 0),
(1009, 149, '2025-01-16', 1),
(1010, 150, '2025-01-08', 1),
(1011, 149, '2025-01-08', 0),
(1012, 150, '2025-01-09', 0),
(1013, 149, '2025-01-15', 1),
(1014, 151, '2025-01-08', 0),
(1015, 149, '2025-01-09', 0);

--
-- Déclencheurs `calendrier`
--
DELIMITER $$
CREATE TRIGGER `BU_cavalier` BEFORE UPDATE ON `calendrier` FOR EACH ROW update cours
set LibCours = "Oui"
$$
DELIMITER ;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `calendrier`
--
ALTER TABLE `calendrier`
  ADD PRIMARY KEY (`idCourSeance`,`idCoursCours`),
  ADD KEY `Fk_Cours_Calandrier` (`idCoursCours`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `calendrier`
--
ALTER TABLE `calendrier`
  MODIFY `idCourSeance` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1016;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `calendrier`
--
ALTER TABLE `calendrier`
  ADD CONSTRAINT `Fk_Cours_Calandrier` FOREIGN KEY (`idCoursCours`) REFERENCES `cours` (`idCours`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
