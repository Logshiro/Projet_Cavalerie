-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : jeu. 17 avr. 2025 à 16:48
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.2.12

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(994, 148, '2025-01-29', 1),
(1004, 148, '2025-01-29', 1),
(1005, 149, '2025-01-07', 1),
(1006, 150, '2025-01-08', 1),
(1009, 149, '2025-01-16', 1),
(1010, 150, '2025-01-08', 1),
(1011, 149, '2025-01-08', 0),
(1012, 150, '2025-01-09', 0),
(1013, 149, '2025-01-15', 1),
(1015, 149, '2025-01-09', 0),
(1017, 149, '2025-01-14', 1),
(1018, 150, '2025-01-04', 0),
(1019, 148, '2025-01-07', 0),
(1020, 150, '2025-01-06', 0),
(1021, 150, '2025-01-06', 0),
(1023, 176, '2025-04-15', 0),
(1024, 176, '2025-04-22', 0),
(1025, 177, '2025-04-10', 0),
(1026, 177, '2025-04-17', 0),
(1029, 179, '2025-04-14', 0),
(1030, 176, '2025-04-20', 0),
(1031, 176, '2025-04-23', 0),
(1032, 176, '2025-05-06', 1);

--
-- Déclencheurs `calendrier`
--
DELIMITER $$
CREATE TRIGGER `BU_cavalier` BEFORE UPDATE ON `calendrier` FOR EACH ROW update cours
set LibCours = "Oui"
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `cavalerie`
--

CREATE TABLE `cavalerie` (
  `NumSir` int(11) NOT NULL,
  `NomCheval` varchar(30) NOT NULL,
  `Garot` int(11) NOT NULL,
  `RefRace` int(11) NOT NULL,
  `RefRobe` int(11) NOT NULL,
  `Supprime` int(11) NOT NULL DEFAULT 0,
  `DateNC` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `cavalerie`
--

INSERT INTO `cavalerie` (`NumSir`, `NomCheval`, `Garot`, `RefRace`, `RefRobe`, `Supprime`, `DateNC`) VALUES
(67, 'Poppy', 250, 2, 2, 1, '27-11-2024'),
(68, 'Poppy', 152, 2, 2, 0, '21-12-2024'),
(69, 'Vovo', 15, 2, 5, 0, '10-04-2025'),
(70, 'Babi', 155, 3, 8, 1, '04-06-2002'),
(71, 'Theil', 125, 3, 7, 0, '10-04-2025');

-- --------------------------------------------------------

--
-- Structure de la table `cavalier`
--

CREATE TABLE `cavalier` (
  `idCavalier` int(11) NOT NULL,
  `Numlicence` int(11) NOT NULL,
  `NomCavalier` varchar(30) NOT NULL,
  `PrenomCavalier` varchar(30) NOT NULL,
  `NomResponsable` varchar(30) NOT NULL,
  `PreNomResponsable` varchar(30) NOT NULL,
  `TelResponsable` varchar(30) NOT NULL,
  `MailResponsable` varchar(30) NOT NULL,
  `PasswordResponsable` varchar(30) NOT NULL,
  `COPResponsable` int(11) NOT NULL,
  `Nomcommune` varchar(30) NOT NULL,
  `Assurance` varchar(30) NOT NULL,
  `RefG` int(11) NOT NULL,
  `Supprime` int(11) NOT NULL DEFAULT 0,
  `DateNaissanceCavalier` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `cavalier`
--

INSERT INTO `cavalier` (`idCavalier`, `Numlicence`, `NomCavalier`, `PrenomCavalier`, `NomResponsable`, `PreNomResponsable`, `TelResponsable`, `MailResponsable`, `PasswordResponsable`, `COPResponsable`, `Nomcommune`, `Assurance`, `RefG`, `Supprime`, `DateNaissanceCavalier`) VALUES
(5, 15230, 'Rigodi', 'Tom', 'David', 'Pierre', '0777047048', 'DavP@gmail.com', '561516165aqsdvvQSFQVS^{#~{', 24460, 'Le_pieux', 'La Maf', 3, 1, ''),
(15, 2147483647, 'Mitou', 'Quentin', 'Mitou', 'Quentin', '0777047048', 'Gg@gmail.com', 'rqeger', 24460, 'Château l\'Évêque', 'LePieux', 3, 1, ''),
(17, 2147483647, 'Mitou', 'Quentin', 'Mitou', 'Quentin', '0777047048', 'Gg@gmail.com', 'fgjgd,d', 24460, 'Château l\'Évêque', 'LePieux', 2, 1, '12/12/2024'),
(18, 13113513, 'Mitou', 'Quentin', 'Mitou', 'Quentin', '0777047048', 'sdfqdsfdq@gmail.com', 'qvregeatbrz', 151315, 'Château l\'Évêque', 'LePieux', 2, 0, '08-12-2024'),
(20, 4161415, 'Mitou', 'Quentin', 'Mitou', 'Quentin', '0777047048', 'Gg@gmail.com', 'tdjutry', 49468, 'Château l\'Évêque', 'La Pepite', 2, 0, '26-12-2024'),
(22, 0, 'RoRo', 'Hero', 'Mitou', 'Quentin', '0777047048', 'RSOP@gmail.com', 'zgzgrzgr', 24460, 'Château l\'Évêque', 'LePieux', 6, 0, '06-12-2024'),
(23, 2147483647, 'Olivier', 'Pierre', 'Mitou', 'Quentin', '0777047048', 'RSO@gmail.com', 'zqefqdfqdsf', 24460, 'Château l\'Évêque', 'LePieux', 6, 0, '16-12-2024'),
(24, 15, 'Mitou', 'Quentin', 'Mitou', 'Quentin', '0777047048', 'mitouquentin@gmail.com', '123', 24460, 'Château l\'Évêque', '13353', 6, 0, '06-11-2024'),
(26, 152, 'Mitou', 'Quentin', 'Pipo', 'Quentin', '0777047048', 'Pipo@gmail.com', '123', 24460, 'Château l\'Évêque', '25163', 1, 0, '03-12-2024'),
(27, 154123, 'Mitou', 'Quentin', 'Mitou', 'Quentin', '0777047048', 'v@gmail.com', '123', 8496496, 'Château l\'Évêque', '544554', 1, 0, '01-12-2024'),
(28, 154123, 'Mitou', 'Quentin', 'Mitou', 'Quentin', '0777047048', 'v@gmail.com', '123', 8496496, 'Château l\'Évêque', '544554', 1, 0, '01-12-2024'),
(29, 2131, 'Mitou', 'Quentin', 'Mitou', 'Quentin', '0777047048', 'P@gmail.com', '123', 24460, 'Château l\'Évêque', '56156', 2, 0, '13-12-2024'),
(30, 51163, 'Mitou', 'Quentin', 'Mitou', 'Quentin', '0777047048', 'Z@gmail.com', '123', 49468, 'Château l\'Évêque', '123544', 2, 0, '12-12-2024'),
(31, 125536, 'Richard', 'Mitou', 'Richard', 'Mitou', '0777047048', 'Rich@gmail.com', '123', 24460, 'Château l\'Évêque', '13353', 2, 0, '28-01-2004'),
(32, 2147483647, 'Dorian', 'Dumon', 'Patrique', 'Vicier', '0777047325', 'PatriqueV@gmail.com', '123', 24460, 'Château-De-Bier', '25163', 3, 0, '15-02-2001'),
(33, 6383833, 'Mitou', 'Quentin', 'Mitou', 'Quentin', '0777047048', 'mitouquentin@gmail.com', '123', 24460, 'Château l\'Évêque', '5278367', 2, 0, '05-03-2003'),
(34, 2147483647, 'Mitou', 'Quentin', 'Mitou', 'Quentin', '0777047048', 'mitouquentin@gmail.com', '123', 24460, 'Château l\'Évêque', '25163', 2, 0, '05-03-2003'),
(35, 2147483647, 'Robi', 'Lory', 'Robi', 'Piero', '0777043584', 'RobiL@gmail.com', '123', 123, 'Château l\'Évêque', 'LePieux', 2, 1, '17-04-2025');

-- --------------------------------------------------------

--
-- Structure de la table `concours`
--

CREATE TABLE `concours` (
  `idConcours` int(11) NOT NULL,
  `LibConcours` varchar(30) NOT NULL,
  `DateConcours` date NOT NULL,
  `Supprime` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `concours`
--

INSERT INTO `concours` (`idConcours`, `LibConcours`, `DateConcours`, `Supprime`) VALUES
(0, 'Bastion', '2025-01-15', 0);

-- --------------------------------------------------------

--
-- Structure de la table `cours`
--

CREATE TABLE `cours` (
  `idCours` int(11) NOT NULL,
  `Libcours` varchar(30) NOT NULL,
  `jour` varchar(30) NOT NULL,
  `HD` varchar(30) NOT NULL,
  `HF` varchar(30) NOT NULL,
  `RefGalop` int(11) NOT NULL,
  `Supprime` int(11) NOT NULL DEFAULT 0,
  `RefCavalier` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `cours`
--

INSERT INTO `cours` (`idCours`, `Libcours`, `jour`, `HD`, `HF`, `RefGalop`, `Supprime`, `RefCavalier`) VALUES
(144, 'Oui', 'Jeudi', '16:02', '18:02', 6, 1, 0),
(145, 'Oui', 'Jeudi', '16:02', '18:02', 6, 1, 0),
(146, 'Oui', 'Jeudi', '16:02', '18:02', 6, 1, 0),
(147, 'Oui', 'Jeudi', '16:02', '18:02', 6, 1, 0),
(148, 'Oui', 'Jeudi', '16:02', '18:02', 6, 1, 0),
(149, 'Oui', 'Mardi', '18:23', '19:23', 3, 1, 0),
(150, 'Oui', 'Jeudi', '19:27', '19:33', 2, 1, 0),
(151, 'Oui', 'Jeudi', '15:26', '17:26', 1, 1, 0),
(152, 'Oui', 'Jeudi', '14:07', '14:07', 1, 1, 0),
(153, 'Oui', 'Jeudi', '18:40', '20:40', 6, 1, 0),
(156, 'Oui', 'Jeudi', '15:30', '17:30', 10, 1, 0),
(157, 'Oui', 'vendredi', '8:00', '9:00', 7, 1, 0),
(158, 'Oui', 'Vendredi', '8:00', '9:00', 7, 1, 0),
(161, 'Oui', 'Mardi', '18:18', '19:18', 3, 1, 0),
(162, 'Oui', 'Mardi', '18:18', '19:18', 3, 1, 0),
(164, 'Oui', 'Mardi', '18:18', '19:18', 7, 1, 0),
(165, 'Oui', 'Mardi', '18:18', '19:18', 7, 1, 0),
(172, 'Oui', 'Vendredi', '8:00', '9:00', 6, 1, 0),
(176, 'Premier Pas', 'mardi', '20:08', '23:11', 3, 0, 0),
(177, 'Saut D\'obstacle', 'Jeudi', '20:13', '22:15', 2, 0, 0),
(178, 'Oui', 'Jeudi', '20:13', '22:15', 2, 1, 0),
(179, 'Oui', 'Jeudi', '21:46', '23:46', 3, 1, 0);

-- --------------------------------------------------------

--
-- Structure de la table `eppreuve`
--

CREATE TABLE `eppreuve` (
  `idEppreuve` int(11) NOT NULL,
  `LibEppreuve` varchar(30) NOT NULL,
  `Supprime` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `eppreuve`
--

INSERT INTO `eppreuve` (`idEppreuve`, `LibEppreuve`, `Supprime`) VALUES
(1, '0', 1),
(2, 'Col', 0),
(3, 'Poney 2', 0);

-- --------------------------------------------------------

--
-- Structure de la table `evenement`
--

CREATE TABLE `evenement` (
  `idEvenement` int(11) NOT NULL,
  `TitreE` varchar(30) NOT NULL,
  `CommentaireE` varchar(30) NOT NULL,
  `Supprime` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `evenement`
--

INSERT INTO `evenement` (`idEvenement`, `TitreE`, `CommentaireE`, `Supprime`) VALUES
(13, 'Course de poney', 'petit poney', 0),
(14, 'Promenade sur la rive', 'Promenade le long de la rive', 1),
(15, 'Promenade sur la rive', 'Promenade le long de la Dordog', 0);

-- --------------------------------------------------------

--
-- Structure de la table `galop`
--

CREATE TABLE `galop` (
  `idGalop` int(11) NOT NULL,
  `LibGalop` varchar(30) NOT NULL,
  `Supprime` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `galop`
--

INSERT INTO `galop` (`idGalop`, `LibGalop`, `Supprime`) VALUES
(1, 'Galop1', 1),
(2, 'Galop2', 0),
(3, 'Galop5', 0),
(6, 'Galop10', 1),
(7, 'Galop9', 1),
(10, 'Galop15', 1),
(11, 'Galop7', 1);

-- --------------------------------------------------------

--
-- Structure de la table `inscrit`
--

CREATE TABLE `inscrit` (
  `RefCavalier` int(11) NOT NULL,
  `RefCours` int(11) NOT NULL,
  `Supprime` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `inscrit`
--

INSERT INTO `inscrit` (`RefCavalier`, `RefCours`, `Supprime`) VALUES
(18, 149, 1),
(22, 144, 1),
(22, 145, 1),
(22, 146, 1),
(22, 147, 1),
(22, 148, 1),
(22, 149, 1),
(22, 150, 1),
(22, 151, 1),
(22, 152, 1),
(22, 153, 1),
(22, 156, 1),
(22, 176, 0),
(22, 179, 0),
(23, 149, 1),
(23, 152, 1),
(23, 156, 1),
(23, 179, 0),
(30, 151, 1),
(30, 152, 1),
(30, 153, 1),
(30, 156, 1),
(30, 158, 1),
(30, 172, 1),
(30, 176, 1),
(30, 177, 1);

-- --------------------------------------------------------

--
-- Structure de la table `journal_modification`
--

CREATE TABLE `journal_modification` (
  `table_name` varchar(30) NOT NULL,
  `row_id` int(11) NOT NULL,
  `modification_date` date NOT NULL,
  `modification_reason` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `liste`
--

CREATE TABLE `liste` (
  `id` int(11) NOT NULL,
  `produit` varchar(20) NOT NULL,
  `prix` int(11) NOT NULL,
  `nombre` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `liste`
--

INSERT INTO `liste` (`id`, `produit`, `prix`, `nombre`) VALUES
(12, 'Coffret', 29, 2),
(13, 'Manga', 7, 2),
(14, 'display', 80, 10);

-- --------------------------------------------------------

--
-- Structure de la table `obstacle`
--

CREATE TABLE `obstacle` (
  `idObstacle` int(11) NOT NULL,
  `LibObstacle` varchar(30) NOT NULL,
  `HObstacle` int(11) NOT NULL,
  `LObstacle` int(11) NOT NULL,
  `RefEppreuve` int(11) NOT NULL,
  `Supprime` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `obstacle`
--

INSERT INTO `obstacle` (`idObstacle`, `LibObstacle`, `HObstacle`, `LObstacle`, `RefEppreuve`, `Supprime`) VALUES
(1, 'ga', 15, 25, 2, 0),
(2, 'lol', 25, 15, 2, 0),
(3, 'oxer1', 25, 15, 3, 0);

-- --------------------------------------------------------

--
-- Structure de la table `participe`
--

CREATE TABLE `participe` (
  `idCourSeance` int(11) NOT NULL,
  `idCoursCours` int(11) NOT NULL,
  `RefCavalier` int(11) NOT NULL,
  `present` tinyint(1) NOT NULL,
  `Supprime` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `participe`
--

INSERT INTO `participe` (`idCourSeance`, `idCoursCours`, `RefCavalier`, `present`, `Supprime`) VALUES
(1023, 176, 30, 0, 0),
(1024, 176, 30, 0, 0),
(1025, 177, 30, 0, 0),
(1026, 177, 30, 1, 0),
(1029, 179, 22, 1, 0),
(1029, 179, 23, 1, 0),
(1030, 179, 22, 1, 0),
(1030, 179, 23, 1, 0);

-- --------------------------------------------------------

--
-- Structure de la table `pension`
--

CREATE TABLE `pension` (
  `idPension` int(11) NOT NULL,
  `Tarifs` int(11) NOT NULL,
  `LibPension` varchar(30) NOT NULL,
  `DateDebutP` varchar(30) NOT NULL,
  `DateFinP` varchar(30) NOT NULL,
  `RefNumSir` int(11) NOT NULL,
  `Supprime` int(11) NOT NULL DEFAULT 0,
  `RefCavalier` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `pension`
--

INSERT INTO `pension` (`idPension`, `Tarifs`, `LibPension`, `DateDebutP`, `DateFinP`, `RefNumSir`, `Supprime`, `RefCavalier`) VALUES
(30, 150, 'Normal', '21-12-2024', '17-12-2024', 68, 0, 30),
(43, 150, 'Normal', '10-04-2025', '27-04-2025', 68, 1, 23),
(44, 150, 'Normal', '10-04-2025', '27-04-2025', 69, 1, 23),
(45, 150, 'Normal', '26-04-2025', '04-05-2025', 67, 1, 20),
(46, 150, 'Normal', '26-04-2025', '04-05-2025', 67, 1, 22);

-- --------------------------------------------------------

--
-- Structure de la table `photo`
--

CREATE TABLE `photo` (
  `idPhoto` int(11) NOT NULL,
  `LibPhoto` varchar(500) NOT NULL,
  `RefNumsir` int(11) NOT NULL,
  `Supprime` int(11) NOT NULL DEFAULT 0,
  `RefEvenement` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `photo`
--

INSERT INTO `photo` (`idPhoto`, `LibPhoto`, `RefNumsir`, `Supprime`, `RefEvenement`) VALUES
(141, '/Controleur/Evenement/PHP_CRUD_Evenement/Uploads/EvenementPH/6758bedc0be97_24a3aa12d4321c9140ddfe3de05266475e383dba88cb1e83a4838fa9f063e7db.png', 0, 1, 13),
(142, '/Controleur/Cavalerie/PHP_CRUD_Cavalerie/Uploads/CavaleriePH/6758c31232c1a_f2e45b6a273988d015476395790baf9638797e9a812562a2337a1de4d7ea364e.png', 67, 0, 0),
(143, '/Controleur/Cavalerie/PHP_CRUD_Cavalerie/Uploads/CavaleriePH/675a95c594964_388e8c49d9104aa2f4cca9d87c7840cb492c1658eb00ba6b0257c897f16fcb44.png', 68, 1, 0),
(144, '/Controleur/Evenement/PHP_CRUD_Evenement/Uploads/EvenementPH/675ac15bc840b_24ae78a4efb85d028ef0052035a6195bdf00ce25669978be1e6ac098feb1a477.png', 0, 1, 13),
(145, '/Controleur/Evenement/PHP_CRUD_Evenement/Uploads/EvenementPH/677e42538ceb5_890eb69bdc56070e39155e2736a5e98642a80b56345cc4660a2fcb92b96c9eef.png', 0, 1, 13),
(146, '/Controleur/Cavalerie/PHP_CRUD_Cavalerie/Uploads/CavaleriePH/67f7dae588f74_3684345ca05c33cd18bffad6462b5a51372fec6242a0deb10a5f2fb7641d1b23.jpg', 69, 1, 0),
(147, '/Controleur/Evenement/PHP_CRUD_Evenement/Uploads/EvenementPH/67f7db3f30711_4a90f371d000ea46901dfb2633ddd3fb066fb4621134f1486c192f432361efdb.jpg', 0, 0, 13),
(148, '/Controleur/Evenement/PHP_CRUD_Evenement/Uploads/EvenementPH/67fd20a7624d2_32a73a4ce4abc2413702e1a90ca31af105ff33ed1b880f2eee3d61ebdca205d2.jpg', 0, 1, 14),
(149, '/Controleur/Evenement/PHP_CRUD_Evenement/Uploads/EvenementPH/67fd2145b3398_311df3c5ce4ce3c8365321462ed074b35bf17184c66f19dd597e8e1d916d2444.png', 0, 1, 14),
(150, '/Controleur/Evenement/PHP_CRUD_Evenement/Uploads/EvenementPH/67fd227ace762_32a73a4ce4abc2413702e1a90ca31af105ff33ed1b880f2eee3d61ebdca205d2.jpg', 0, 0, 15),
(151, '/Controleur/Cavalerie/PHP_CRUD_Cavalerie/Uploads/CavaleriePH/67fd23548d6ee_311df3c5ce4ce3c8365321462ed074b35bf17184c66f19dd597e8e1d916d2444.png', 70, 1, 0),
(152, '/Controleur/Cavalerie/PHP_CRUD_Cavalerie/Uploads/CavaleriePH/67fd23d9b9efb_32a73a4ce4abc2413702e1a90ca31af105ff33ed1b880f2eee3d61ebdca205d2.jpg', 70, 1, 0),
(153, '/Controleur/Cavalerie/PHP_CRUD_Cavalerie/Uploads/CavaleriePH/67fe0406b1aa2_311df3c5ce4ce3c8365321462ed074b35bf17184c66f19dd597e8e1d916d2444.png', 69, 0, 0),
(154, '/Controleur/Cavalerie/PHP_CRUD_Cavalerie/Uploads/CavaleriePH/67fe042176df6_32a73a4ce4abc2413702e1a90ca31af105ff33ed1b880f2eee3d61ebdca205d2.jpg', 68, 0, 0),
(155, '/Controleur/Cavalerie/PHP_CRUD_Cavalerie/Uploads/CavaleriePH/67fe23e877891_311df3c5ce4ce3c8365321462ed074b35bf17184c66f19dd597e8e1d916d2444.png', 71, 0, 0);

-- --------------------------------------------------------

--
-- Structure de la table `prend`
--

CREATE TABLE `prend` (
  `refidcava` int(11) NOT NULL,
  `refidpen` int(11) NOT NULL,
  `supprime` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `prend`
--

INSERT INTO `prend` (`refidcava`, `refidpen`, `supprime`) VALUES
(18, 43, 1),
(20, 45, 1),
(22, 42, 0),
(23, 44, 1),
(23, 46, 1);

-- --------------------------------------------------------

--
-- Structure de la table `race`
--

CREATE TABLE `race` (
  `idRace` int(11) NOT NULL,
  `LibRace` varchar(30) NOT NULL,
  `Supprime` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `race`
--

INSERT INTO `race` (`idRace`, `LibRace`, `Supprime`) VALUES
(2, 'Texan', 0),
(3, 'Anglais', 0),
(4, 'italien', 1);

-- --------------------------------------------------------

--
-- Structure de la table `robe`
--

CREATE TABLE `robe` (
  `idRobe` int(11) NOT NULL,
  `LibRobe` varchar(30) NOT NULL,
  `Supprime` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `robe`
--

INSERT INTO `robe` (`idRobe`, `LibRobe`, `Supprime`) VALUES
(1, 'Blanc', 1),
(2, 'Bleu', 0),
(4, 'violet', 0),
(5, 'Vert', 0),
(6, 'Noir', 1),
(7, 'Maron', 1),
(8, 'Maron', 0);

-- --------------------------------------------------------

--
-- Structure de la table `role`
--

CREATE TABLE `role` (
  `idU` int(11) NOT NULL,
  `LibRole` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `role`
--

INSERT INTO `role` (`idU`, `LibRole`) VALUES
(1, 'Admin'),
(2, 'Utilisateur');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

CREATE TABLE `utilisateurs` (
  `mail` varchar(30) NOT NULL,
  `passwordA` varchar(300) NOT NULL,
  `RefRole` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `utilisateurs`
--

INSERT INTO `utilisateurs` (`mail`, `passwordA`, `RefRole`) VALUES
('mitouquentin@gmail.com', '$2y$10$ULtaiUgE0c8Yt7cu8jjy5O8ZgWIRhgNo5.uGw77TF.N9rrcbGVy4G', 2),
('mitou@gmail.com', '$2y$10$akJHydR1wxoMz.S9Ig49suP7DKEHHcqxfHfPzhsrquoiM5pJdyIsO', 2),
('quentin@gmail.com', '$2y$10$PnGbUvLsEikdGJRXi6p9k.ocTF04L.hhq/3CdyVHOQX7c/YJTkWhW', 1),
('m@gmail.com', '$2y$10$6nDFRpSDVv0wA4xBBvIKVuIDsjSL3hMTaxwp/0gtlCEq0iPwesWwy', 1),
('P@gmail.com', '$2y$10$bKsIruG/ONlAwA6epqWtJeUSj7qQQEsCVsWKJzY4D0LOSlX6XML3q', 1),
('Q@gmail.com', '$2y$10$J1rLWZEhXP1PFqfyeUEDcOoLG/t1Bdsl1Y7c4WsTpG3JRJELatdXO', 2),
('tin@gmail.com', '$2y$10$Ybrs.lArKzj7FPjORyAVeOjLMj7ZmvrfVoeQ8bBL02hXn4VhxoFiK', 2),
('v@gmail.com', '$2y$10$gjdZnaVkuoQJAZokghjaturjRbH2N3z4WkuyhwguYwuD3F2gz/IOG', 2),
('Z@gmail.com', '$2y$10$vcU0JNuqt9v7LslNTlqMt.fxMrKKcGwml9DEETks.5hNo2D98VeN2', 2),
('Rich@gmail.com', '$2y$10$t/7ZgIZUO95A697SjAtQzedqsh/HKkhfKtL0m/WPJeOPEMyOETj92', 2),
('RV@gmail.com', '$2y$10$kS7m0CDsOi4hVXXIWGCLueKOlbRCWPQO18zTM9lP7pyCDszaH2yIi', 2),
('PIO@gmail.com', '$2y$10$EEptCsFc4VqF0AtrmBTt1.v0FIe63RIKFDiooxQLjHYZ9JpRLB0/.', 2),
('PatriqueV@gmail.com', '$2y$10$rK7HXLlAkEd5iHOCSqe8ceMhCBLgYkOpRrIgNujHt8iV8VLlKHJ32', 2);

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
-- Index pour la table `cavalerie`
--
ALTER TABLE `cavalerie`
  ADD PRIMARY KEY (`NumSir`),
  ADD KEY `Fk_RobeCav` (`RefRobe`),
  ADD KEY `Fk_RaceCav` (`RefRace`);

--
-- Index pour la table `cavalier`
--
ALTER TABLE `cavalier`
  ADD PRIMARY KEY (`idCavalier`),
  ADD KEY `Fk_galopC` (`RefG`);

--
-- Index pour la table `cours`
--
ALTER TABLE `cours`
  ADD PRIMARY KEY (`idCours`),
  ADD KEY `Fk_GalopCours` (`RefGalop`);

--
-- Index pour la table `eppreuve`
--
ALTER TABLE `eppreuve`
  ADD PRIMARY KEY (`idEppreuve`);

--
-- Index pour la table `evenement`
--
ALTER TABLE `evenement`
  ADD PRIMARY KEY (`idEvenement`);

--
-- Index pour la table `galop`
--
ALTER TABLE `galop`
  ADD PRIMARY KEY (`idGalop`);

--
-- Index pour la table `inscrit`
--
ALTER TABLE `inscrit`
  ADD PRIMARY KEY (`RefCavalier`,`RefCours`),
  ADD KEY `Fk_CoursInsc` (`RefCours`);

--
-- Index pour la table `liste`
--
ALTER TABLE `liste`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `obstacle`
--
ALTER TABLE `obstacle`
  ADD PRIMARY KEY (`idObstacle`),
  ADD KEY `Fk_Eppreuve` (`RefEppreuve`);

--
-- Index pour la table `participe`
--
ALTER TABLE `participe`
  ADD PRIMARY KEY (`idCourSeance`,`idCoursCours`,`RefCavalier`),
  ADD KEY `Fk_Cours_participe` (`idCoursCours`),
  ADD KEY `Fk_Cavalier_participe` (`RefCavalier`);

--
-- Index pour la table `pension`
--
ALTER TABLE `pension`
  ADD PRIMARY KEY (`idPension`),
  ADD KEY `Fk_CavalerieP` (`RefNumSir`);

--
-- Index pour la table `photo`
--
ALTER TABLE `photo`
  ADD PRIMARY KEY (`idPhoto`);

--
-- Index pour la table `prend`
--
ALTER TABLE `prend`
  ADD PRIMARY KEY (`refidcava`,`refidpen`),
  ADD KEY `fk_prend_pension` (`refidpen`);

--
-- Index pour la table `race`
--
ALTER TABLE `race`
  ADD PRIMARY KEY (`idRace`);

--
-- Index pour la table `robe`
--
ALTER TABLE `robe`
  ADD PRIMARY KEY (`idRobe`);

--
-- Index pour la table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`idU`);

--
-- Index pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  ADD KEY `Fk_RoleU` (`RefRole`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `calendrier`
--
ALTER TABLE `calendrier`
  MODIFY `idCourSeance` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1033;

--
-- AUTO_INCREMENT pour la table `cavalerie`
--
ALTER TABLE `cavalerie`
  MODIFY `NumSir` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT pour la table `cavalier`
--
ALTER TABLE `cavalier`
  MODIFY `idCavalier` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT pour la table `cours`
--
ALTER TABLE `cours`
  MODIFY `idCours` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=180;

--
-- AUTO_INCREMENT pour la table `eppreuve`
--
ALTER TABLE `eppreuve`
  MODIFY `idEppreuve` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `evenement`
--
ALTER TABLE `evenement`
  MODIFY `idEvenement` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT pour la table `galop`
--
ALTER TABLE `galop`
  MODIFY `idGalop` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT pour la table `liste`
--
ALTER TABLE `liste`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT pour la table `obstacle`
--
ALTER TABLE `obstacle`
  MODIFY `idObstacle` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `pension`
--
ALTER TABLE `pension`
  MODIFY `idPension` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT pour la table `photo`
--
ALTER TABLE `photo`
  MODIFY `idPhoto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=156;

--
-- AUTO_INCREMENT pour la table `race`
--
ALTER TABLE `race`
  MODIFY `idRace` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `robe`
--
ALTER TABLE `robe`
  MODIFY `idRobe` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `role`
--
ALTER TABLE `role`
  MODIFY `idU` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `calendrier`
--
ALTER TABLE `calendrier`
  ADD CONSTRAINT `Fk_Cours_Calandrier` FOREIGN KEY (`idCoursCours`) REFERENCES `cours` (`idCours`);

--
-- Contraintes pour la table `cavalerie`
--
ALTER TABLE `cavalerie`
  ADD CONSTRAINT `Fk_CRase` FOREIGN KEY (`RefRace`) REFERENCES `race` (`idRace`),
  ADD CONSTRAINT `Fk_CRobe` FOREIGN KEY (`RefRobe`) REFERENCES `robe` (`idRobe`);

--
-- Contraintes pour la table `cavalier`
--
ALTER TABLE `cavalier`
  ADD CONSTRAINT `Fk_GalopC` FOREIGN KEY (`RefG`) REFERENCES `galop` (`idGalop`);

--
-- Contraintes pour la table `cours`
--
ALTER TABLE `cours`
  ADD CONSTRAINT `Fk_GalopCours` FOREIGN KEY (`RefGalop`) REFERENCES `galop` (`idGalop`);

--
-- Contraintes pour la table `inscrit`
--
ALTER TABLE `inscrit`
  ADD CONSTRAINT `Fk_CavalierInsc` FOREIGN KEY (`RefCavalier`) REFERENCES `cavalier` (`idCavalier`),
  ADD CONSTRAINT `Fk_CoursInsc` FOREIGN KEY (`RefCours`) REFERENCES `cours` (`idCours`);

--
-- Contraintes pour la table `obstacle`
--
ALTER TABLE `obstacle`
  ADD CONSTRAINT `Fk_Eppreuve` FOREIGN KEY (`RefEppreuve`) REFERENCES `eppreuve` (`idEppreuve`);

--
-- Contraintes pour la table `participe`
--
ALTER TABLE `participe`
  ADD CONSTRAINT `Fk_Calandrier_participe` FOREIGN KEY (`idCourSeance`) REFERENCES `calendrier` (`idCourSeance`),
  ADD CONSTRAINT `Fk_Cavalier_participe` FOREIGN KEY (`RefCavalier`) REFERENCES `cavalier` (`idCavalier`),
  ADD CONSTRAINT `Fk_Cours_participe` FOREIGN KEY (`idCoursCours`) REFERENCES `cours` (`idCours`);

--
-- Contraintes pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  ADD CONSTRAINT `Fk_RoleU` FOREIGN KEY (`RefRole`) REFERENCES `role` (`idU`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
