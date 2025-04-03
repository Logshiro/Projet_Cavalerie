-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : jeu. 05 déc. 2024 à 11:48
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
  `DateCours` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `calendrier`
--

INSERT INTO `calendrier` (`idCourSeance`, `idCoursCours`, `DateCours`) VALUES
(239, 43, '2024-12-02'),
(240, 43, '2024-12-09'),
(241, 43, '2024-12-16'),
(242, 43, '2024-12-23'),
(243, 43, '2024-12-30'),
(244, 43, '2025-01-06'),
(245, 43, '2025-01-13'),
(246, 43, '2025-01-20'),
(247, 43, '2025-01-27'),
(248, 43, '2025-02-03'),
(249, 43, '2025-02-10'),
(250, 43, '2025-02-17'),
(251, 43, '2025-02-24'),
(252, 43, '2025-03-03'),
(253, 43, '2025-03-10'),
(254, 43, '2025-03-17'),
(255, 43, '2025-03-24'),
(256, 43, '2025-03-31'),
(257, 43, '2025-04-07'),
(258, 43, '2025-04-14'),
(259, 43, '2025-04-21'),
(260, 43, '2025-04-28'),
(261, 43, '2025-05-05'),
(262, 43, '2025-05-12'),
(263, 43, '2025-05-19'),
(264, 43, '2025-05-26'),
(265, 43, '2025-06-02'),
(266, 43, '2025-06-09'),
(267, 43, '2025-06-16'),
(268, 43, '2025-06-23'),
(269, 43, '2025-06-30'),
(270, 43, '2025-07-07'),
(271, 43, '2025-07-14'),
(272, 43, '2025-07-21'),
(273, 43, '2025-07-28'),
(274, 43, '2025-08-04'),
(275, 43, '2025-08-11'),
(276, 43, '2025-08-18'),
(277, 43, '2025-08-25'),
(278, 43, '2025-09-01'),
(279, 43, '2025-09-08'),
(280, 43, '2025-09-15'),
(281, 43, '2025-09-22'),
(282, 43, '2025-09-29'),
(283, 43, '2025-10-06'),
(284, 43, '2025-10-13'),
(285, 43, '2025-10-20'),
(286, 43, '2025-10-27'),
(287, 43, '2025-11-03'),
(288, 43, '2025-11-10'),
(289, 43, '2025-11-17'),
(290, 43, '2025-11-24'),
(291, 44, '2024-12-05'),
(292, 44, '2024-12-12'),
(293, 44, '2024-12-19'),
(294, 44, '2024-12-26'),
(295, 44, '2025-01-02'),
(296, 44, '2025-01-09'),
(297, 44, '2025-01-16'),
(298, 44, '2025-01-23'),
(299, 44, '2025-01-30'),
(300, 44, '2025-02-06'),
(301, 44, '2025-02-13'),
(302, 44, '2025-02-20'),
(303, 44, '2025-02-27'),
(304, 44, '2025-03-06'),
(305, 44, '2025-03-13'),
(306, 44, '2025-03-20'),
(307, 44, '2025-03-27'),
(308, 44, '2025-04-03'),
(309, 44, '2025-04-10'),
(310, 44, '2025-04-17'),
(311, 44, '2025-04-24'),
(312, 44, '2025-05-01'),
(313, 44, '2025-05-08'),
(314, 44, '2025-05-15'),
(315, 44, '2025-05-22'),
(316, 44, '2025-05-29'),
(317, 44, '2025-06-05'),
(318, 44, '2025-06-12'),
(319, 44, '2025-06-19'),
(320, 44, '2025-06-26'),
(321, 44, '2025-07-03'),
(322, 44, '2025-07-10'),
(323, 44, '2025-07-17'),
(324, 44, '2025-07-24'),
(325, 44, '2025-07-31'),
(326, 44, '2025-08-07'),
(327, 44, '2025-08-14'),
(328, 44, '2025-08-21'),
(329, 44, '2025-08-28'),
(330, 44, '2025-09-04'),
(331, 44, '2025-09-11'),
(332, 44, '2025-09-18'),
(333, 44, '2025-09-25'),
(334, 44, '2025-10-02'),
(335, 44, '2025-10-09'),
(336, 44, '2025-10-16'),
(337, 44, '2025-10-23'),
(338, 44, '2025-10-30'),
(339, 44, '2025-11-06'),
(340, 44, '2025-11-13'),
(341, 44, '2025-11-20'),
(342, 44, '2025-11-27'),
(343, 45, '2024-12-05'),
(344, 45, '2024-12-12'),
(345, 45, '2024-12-19'),
(346, 45, '2024-12-26'),
(347, 45, '2025-01-02'),
(348, 45, '2025-01-09'),
(349, 45, '2025-01-16'),
(350, 45, '2025-01-23'),
(351, 45, '2025-01-30'),
(352, 45, '2025-02-06'),
(353, 45, '2025-02-13'),
(354, 45, '2025-02-20'),
(355, 45, '2025-02-27'),
(356, 45, '2025-03-06'),
(357, 45, '2025-03-13'),
(358, 45, '2025-03-20'),
(359, 45, '2025-03-27'),
(360, 45, '2025-04-03'),
(361, 45, '2025-04-10'),
(362, 45, '2025-04-17'),
(363, 45, '2025-04-24'),
(364, 45, '2025-05-01'),
(365, 45, '2025-05-08'),
(366, 45, '2025-05-15'),
(367, 45, '2025-05-22'),
(368, 45, '2025-05-29'),
(369, 45, '2025-06-05'),
(370, 45, '2025-06-12'),
(371, 45, '2025-06-19'),
(372, 45, '2025-06-26'),
(373, 45, '2025-07-03'),
(374, 45, '2025-07-10'),
(375, 45, '2025-07-17'),
(376, 45, '2025-07-24'),
(377, 45, '2025-07-31'),
(378, 45, '2025-08-07'),
(379, 45, '2025-08-14'),
(380, 45, '2025-08-21'),
(381, 45, '2025-08-28'),
(382, 45, '2025-09-04'),
(383, 45, '2025-09-11'),
(384, 45, '2025-09-18'),
(385, 45, '2025-09-25'),
(386, 45, '2025-10-02'),
(387, 45, '2025-10-09'),
(388, 45, '2025-10-16'),
(389, 45, '2025-10-23'),
(390, 45, '2025-10-30'),
(391, 45, '2025-11-06'),
(392, 45, '2025-11-13'),
(393, 45, '2025-11-20'),
(394, 45, '2025-11-27'),
(395, 46, '2024-12-05'),
(396, 46, '2024-12-12'),
(397, 46, '2024-12-19'),
(398, 46, '2024-12-26'),
(399, 46, '2025-01-02'),
(400, 46, '2025-01-09'),
(401, 46, '2025-01-16'),
(402, 46, '2025-01-23'),
(403, 46, '2025-01-30'),
(404, 46, '2025-02-06'),
(405, 46, '2025-02-13'),
(406, 46, '2025-02-20'),
(407, 46, '2025-02-27'),
(408, 46, '2025-03-06'),
(409, 46, '2025-03-13'),
(410, 46, '2025-03-20'),
(411, 46, '2025-03-27'),
(412, 46, '2025-04-03'),
(413, 46, '2025-04-10'),
(414, 46, '2025-04-17'),
(415, 46, '2025-04-24'),
(416, 46, '2025-05-01'),
(417, 46, '2025-05-08'),
(418, 46, '2025-05-15'),
(419, 46, '2025-05-22'),
(420, 46, '2025-05-29'),
(421, 46, '2025-06-05'),
(422, 46, '2025-06-12'),
(423, 46, '2025-06-19'),
(424, 46, '2025-06-26'),
(425, 46, '2025-07-03'),
(426, 46, '2025-07-10'),
(427, 46, '2025-07-17'),
(428, 46, '2025-07-24'),
(429, 46, '2025-07-31'),
(430, 46, '2025-08-07'),
(431, 46, '2025-08-14'),
(432, 46, '2025-08-21'),
(433, 46, '2025-08-28'),
(434, 46, '2025-09-04'),
(435, 46, '2025-09-11'),
(436, 46, '2025-09-18'),
(437, 46, '2025-09-25'),
(438, 46, '2025-10-02'),
(439, 46, '2025-10-09'),
(440, 46, '2025-10-16'),
(441, 46, '2025-10-23'),
(442, 46, '2025-10-30'),
(443, 46, '2025-11-06'),
(444, 46, '2025-11-13'),
(445, 46, '2025-11-20'),
(446, 46, '2025-11-27'),
(447, 47, '2024-12-03'),
(448, 47, '2024-12-10'),
(449, 47, '2024-12-17'),
(450, 47, '2024-12-24'),
(451, 47, '2024-12-31'),
(452, 47, '2025-01-07'),
(453, 47, '2025-01-14'),
(454, 47, '2025-01-21'),
(455, 47, '2025-01-28'),
(456, 47, '2025-02-04'),
(457, 47, '2025-02-11'),
(458, 47, '2025-02-18'),
(459, 47, '2025-02-25'),
(460, 47, '2025-03-04'),
(461, 47, '2025-03-11'),
(462, 47, '2025-03-18'),
(463, 47, '2025-03-25'),
(464, 47, '2025-04-01'),
(465, 47, '2025-04-08'),
(466, 47, '2025-04-15'),
(467, 47, '2025-04-22'),
(468, 47, '2025-04-29'),
(469, 47, '2025-05-06'),
(470, 47, '2025-05-13'),
(471, 47, '2025-05-20'),
(472, 47, '2025-05-27'),
(473, 47, '2025-06-03'),
(474, 47, '2025-06-10'),
(475, 47, '2025-06-17'),
(476, 47, '2025-06-24'),
(477, 47, '2025-07-01'),
(478, 47, '2025-07-08'),
(479, 47, '2025-07-15'),
(480, 47, '2025-07-22'),
(481, 47, '2025-07-29'),
(482, 47, '2025-08-05'),
(483, 47, '2025-08-12'),
(484, 47, '2025-08-19'),
(485, 47, '2025-08-26'),
(486, 47, '2025-09-02'),
(487, 47, '2025-09-09'),
(488, 47, '2025-09-16'),
(489, 47, '2025-09-23'),
(490, 47, '2025-09-30'),
(491, 47, '2025-10-07'),
(492, 47, '2025-10-14'),
(493, 47, '2025-10-21'),
(494, 47, '2025-10-28'),
(495, 47, '2025-11-04'),
(496, 47, '2025-11-11'),
(497, 47, '2025-11-18'),
(498, 47, '2025-11-25');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `cavalerie`
--

INSERT INTO `cavalerie` (`NumSir`, `NomCheval`, `Garot`, `RefRace`, `RefRobe`, `Supprime`, `DateNC`) VALUES
(8, 'POPOOOO', 152, 2, 4, 1, ''),
(9, 'Poppy', 152, 3, 2, 1, ''),
(10, 'Poppy', 152, 2, 1, 1, ''),
(11, 'BOB', 3500, 3, 4, 1, ''),
(12, 'Dori', 250, 3, 2, 1, ''),
(41, 'Dori', 250, 2, 4, 1, ''),
(42, 'Dori', 3500, 2, 2, 1, ''),
(43, 'Dori', 152, 2, 2, 1, ''),
(44, 'Dori', 3500, 2, 2, 1, ''),
(45, 'oimjl', 3500, 2, 4, 1, ''),
(46, 'Bobo', 250, 2, 4, 1, ''),
(47, 'Dodo', 250, 2, 1, 1, ''),
(48, 'Dori', 152, 3, 4, 1, ''),
(49, 'BOB', 3500, 2, 4, 1, ''),
(50, 'Barot', 250, 2, 2, 1, ''),
(51, 'BOB', 250, 2, 4, 1, ''),
(52, 'Poppy', 152, 2, 1, 1, ''),
(53, 'Dori', 250, 2, 4, 1, ''),
(54, 'Poppy', 250, 2, 1, 1, ''),
(55, 'BOB', 250, 2, 2, 1, ''),
(56, 'BOB', 3500, 2, 1, 1, ''),
(57, 'BOB', 250, 2, 1, 1, ''),
(58, 'Barot', 250, 3, 4, 1, ''),
(59, 'BOB', 3500, 2, 1, 1, ''),
(60, 'BOB', 150, 2, 1, 1, ''),
(61, 'Dori', 250, 2, 1, 1, ''),
(62, 'Dori', 250, 2, 1, 1, '19-12-2024'),
(63, 'POPOOOO', 152, 2, 4, 0, '21-12-2024'),
(64, 'Dori', 250, 2, 2, 0, '05-12-2024'),
(65, 'Dori', 250, 2, 2, 0, '18-12-2024'),
(66, 'POPOOOO', 250, 2, 2, 0, '09-12-2024');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `cavalier`
--

INSERT INTO `cavalier` (`idCavalier`, `Numlicence`, `NomCavalier`, `PrenomCavalier`, `NomResponsable`, `PreNomResponsable`, `TelResponsable`, `MailResponsable`, `PasswordResponsable`, `COPResponsable`, `Nomcommune`, `Assurance`, `RefG`, `Supprime`, `DateNaissanceCavalier`) VALUES
(5, 15230, 'Rigodi', 'Tom', 'David', 'Pierre', '0777047048', 'DavP@gmail.com', '561516165aqsdvvQSFQVS^{#~{', 24460, 'Le_pieux', 'La Maf', 3, 1, ''),
(10, 2147483647, 'Mitou', 'Romain', 'Mitou', 'Lucas', '0777047048', 'mitouquentin@gmail.com', 'qgegeqgzGRN D', 24460, 'Château l\'Évêque', 'LePieux', 1, 1, ''),
(11, 2147483647, 'Pierre', 'Quentin', 'Pierre', 'Quentin', '0777047048', 'mitouquentin@gmail.com', 'uygtkug', 24460, 'Château l\'Évêque', 'La Pepite', 1, 1, ''),
(12, 2147483647, 'Mitou', 'GOGO', 'Mitou', 'Quentin', '0777047048', 'mitouquentin@gmail.com', 'qsvdsqv', 49468, 'Château l\'Évêque', 'La Pepite', 2, 1, ''),
(13, 13113513, 'Mitou', 'Quentin', 'Mitou', 'Quentin', '0777047048', 'mitouquentin@gmail.com', 'bjkkjjnkj', 151315, 'Château l\'Évêque', 'LePieux', 2, 1, ''),
(14, 4161415, 'Mitou', 'Quentin', 'Mitou', 'Quentin', '0777047048', 'mitouquentin@gmail.com', 'qvqdv', 49468, 'Château l\'Évêque', 'LePieux', 3, 1, ''),
(15, 2147483647, 'Mitou', 'Quentin', 'Mitou', 'Quentin', '0777047048', 'Gg@gmail.com', 'rqeger', 24460, 'Château l\'Évêque', 'LePieux', 3, 1, ''),
(16, 2147483647, 'Mitou', 'Quentin', 'Mitou', 'Quentin', '0777047048', 'mitouquentin@gmail.com', 'dhethet', 24580, 'Château l\'Évêque', 'La Pepite', 6, 1, '2024-12-18'),
(17, 2147483647, 'Mitou', 'Quentin', 'Mitou', 'Quentin', '0777047048', 'Gg@gmail.com', 'fgjgd,d', 24460, 'Château l\'Évêque', 'LePieux', 2, 1, '12/12/2024'),
(18, 13113513, 'Mitou', 'Quentin', 'Mitou', 'Quentin', '0777047048', 'sdfqdsfdq@gmail.com', 'qvregeatbrz', 151315, 'Château l\'Évêque', 'LePieux', 2, 0, '05-12-2024'),
(19, 4161415, 'Mitou', 'Quentin', 'Mitou', 'Quentin', '0777047048', 'Gg@gmail.com', 'zvfdqdfv', 4946, 'Château l\'Évêque', 'LePieux', 3, 0, '19-12-2024'),
(20, 4161415, 'Mitou', 'Quentin', 'Mitou', 'Quentin', '0777047048', 'Gg@gmail.com', 'tdjutry', 49468, 'Château l\'Évêque', 'La Pepite', 2, 0, '26-12-2024'),
(21, 416556156, 'Mitou', 'Quentin', 'Mitou', 'Quentin', '0777047048', 'mitouquentin@gmail.com', 'zefvzfv', 24460, 'Château l\'Évêque', 'LePieux', 6, 0, '14-12-2024'),
(22, 0, 'RoRo', 'Hero', 'Mitou', 'Quentin', '0777047048', 'mitouquentin@gmail.com', 'zgzgrzgr', 24460, 'Château l\'Évêque', 'LePieux', 6, 0, '06-12-2024');

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
  `Supprime` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `cours`
--

INSERT INTO `cours` (`idCours`, `Libcours`, `jour`, `HD`, `HF`, `RefGalop`, `Supprime`) VALUES
(27, 'GP3', '21', '18', '17', 3, 0),
(41, 'Anglais', '05', '17:55', '17:55', 3, 0),
(42, 'Math', '15', '16:58', '19:58', 2, 0),
(43, 'Anglais', 'Lundi', '17:05', '19:05', 1, 0),
(44, 'GP2', 'Jeudi', '19:06', '18:06', 2, 0),
(45, 'GP2', 'Jeudi', '19:06', '18:06', 2, 0),
(46, 'GP2', 'Jeudi', '19:06', '18:06', 2, 0),
(47, 'Math', 'Mardi', '12:42', '13:42', 1, 0);

-- --------------------------------------------------------

--
-- Structure de la table `evenement`
--

CREATE TABLE `evenement` (
  `idEvenement` int(11) NOT NULL,
  `TitreE` varchar(30) NOT NULL,
  `CommentaireE` varchar(30) NOT NULL,
  `Supprime` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `evenement`
--

INSERT INTO `evenement` (`idEvenement`, `TitreE`, `CommentaireE`, `Supprime`) VALUES
(2, 'Le jeu', 'beaucoup trop chaud', 0),
(3, 'La Porte', 'bof', 0),
(4, 'La Game', 'Pas ouf', 0),
(5, 'La Game', 'bof', 0),
(6, 'La carte', 'trop chaud', 0),
(7, 'La carte', 'bof', 0),
(8, 'La carte', 'trop chaud', 0),
(9, 'La Game', 'trop chaud', 0),
(10, 'La carte', 'trop chaud', 0),
(11, 'La carte', 'trop chaud', 0);

-- --------------------------------------------------------

--
-- Structure de la table `galop`
--

CREATE TABLE `galop` (
  `idGalop` int(11) NOT NULL,
  `LibGalop` varchar(30) NOT NULL,
  `Supprime` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `galop`
--

INSERT INTO `galop` (`idGalop`, `LibGalop`, `Supprime`) VALUES
(1, 'Galop1', 1),
(2, 'Galop2', 0),
(3, 'Galop5', 0),
(6, 'Galop10', 0),
(7, 'Galop9', 0),
(10, 'Galop15', 0);

-- --------------------------------------------------------

--
-- Structure de la table `inscrit`
--

CREATE TABLE `inscrit` (
  `RefCavalier` int(11) NOT NULL,
  `RefCours` int(11) NOT NULL,
  `Supprime` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `inscrit`
--

INSERT INTO `inscrit` (`RefCavalier`, `RefCours`, `Supprime`) VALUES
(5, 41, 0);

-- --------------------------------------------------------

--
-- Structure de la table `journal_modification`
--

CREATE TABLE `journal_modification` (
  `table_name` varchar(30) NOT NULL,
  `row_id` int(11) NOT NULL,
  `modification_date` date NOT NULL,
  `modification_reason` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `liste`
--

CREATE TABLE `liste` (
  `id` int(11) NOT NULL,
  `produit` varchar(20) NOT NULL,
  `prix` int(11) NOT NULL,
  `nombre` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `liste`
--

INSERT INTO `liste` (`id`, `produit`, `prix`, `nombre`) VALUES
(12, 'Coffret', 29, 2),
(13, 'Manga', 7, 2),
(14, 'display', 80, 10);

-- --------------------------------------------------------

--
-- Structure de la table `participe`
--

CREATE TABLE `participe` (
  `idCoursB` int(11) NOT NULL,
  `idCoursAss` int(11) NOT NULL,
  `RefCavalier` int(11) NOT NULL,
  `present` tinyint(1) NOT NULL DEFAULT 1,
  `Supprime` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `pension`
--

INSERT INTO `pension` (`idPension`, `Tarifs`, `LibPension`, `DateDebutP`, `DateFinP`, `RefNumSir`, `Supprime`, `RefCavalier`) VALUES
(21, 200, 'Normal', '25-12-2024', '18-12-2024', 43, 1, 0),
(22, 200, 'Normal', '26-12-2024', '26-12-2024', 10, 0, 19),
(23, 150, 'Normal', '20-12-2024', '17-12-2024', 8, 0, 18),
(24, 150, 'Normal', '20-12-2024', '13-12-2024', 50, 0, 22),
(25, 150, 'Normal', '20-12-2024', '13-12-2024', 50, 0, 18),
(26, 150, 'Normal', '14-12-2024', '18-12-2024', 9, 0, 19),
(27, 150, 'Normal', '14-12-2024', '18-12-2024', 9, 0, 22),
(28, 150, 'Normal', '24-12-2024', '11-12-2024', 63, 0, 22),
(29, 150, 'Normal', '24-12-2024', '11-12-2024', 63, 0, 19),
(30, 150, 'Normal', '13-12-2024', '12-12-2024', 10, 0, 22),
(31, 150, 'Complet', '12-12-2024', '18-12-2024', 10, 0, 22),
(32, 200, 'Complet', '14-12-2024', '20-12-2024', 63, 0, 22),
(33, 150, 'Complet', '20-12-2024', '18-12-2024', 63, 0, 22),
(34, 150, 'Complet', '20-12-2024', '18-12-2024', 63, 0, 18),
(35, 150, 'Normal', '21-12-2024', '16-12-2024', 50, 0, 22),
(36, 150, 'Normal', '21-12-2024', '16-12-2024', 50, 0, 18),
(37, 150, 'Normal', '21-12-2024', '19-12-2024', 8, 1, 22),
(38, 150, 'Normal', '21-12-2024', '19-12-2024', 8, 1, 18),
(39, 150, 'Normal', '11-12-2024', '27-12-2024', 8, 0, 22),
(40, 150, 'Normal', '11-12-2024', '27-12-2024', 8, 1, 18);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `photo`
--

INSERT INTO `photo` (`idPhoto`, `LibPhoto`, `RefNumsir`, `Supprime`, `RefEvenement`) VALUES
(38, 'C:\\xampp\\htdocs\\Crud\\Class/../Controleur/Cavalerie/PHP_CRUD_Cavalerie/Uploads/CavaleriePH/674ddf8e1fa40_535936df90da14870d4b9f47e77df1fb63ac3facc2bbdb4397139bdd979a1cd4.jpeg', 43, 0, 0),
(39, 'Uploads/CavaleriePH/674ddff507617_24ae78a4efb85d028ef0052035a6195bdf00ce25669978be1e6ac098feb1a477.png', 44, 0, 0),
(40, 'Uploads/CavaleriePH/674de216d2625_35f0ff06ab865662e530d151c393706eb908c2cbc2854832377949bc7259a5a6.png', 45, 0, 0),
(41, '/Crud/Controleur/Cavalerie/PHP_CRUD_Cavalerie/Uploads/CavaleriePH/674de39ca5c86_a98de058dcc96be966c65a92b06031ed2e3f4e7c08c5820adce9bf2fd6b97743.png', 46, 0, 0),
(42, '/Crud/Controleur/Cavalerie/PHP_CRUD_Cavalerie/Uploads/CavaleriePH/674de467827c4_43a46bfaac3bc98316626b57ab11f5d23cef188c955eaf00d581d9911d8e0a50.png', 47, 0, 0),
(43, '/Crud/Controleur/Cavalerie/PHP_CRUD_Cavalerie/Uploads/CavaleriePH/674de46783ac1_f2e45b6a273988d015476395790baf9638797e9a812562a2337a1de4d7ea364e.png', 47, 0, 0),
(44, '/Crud/Controleur/Cavalerie/PHP_CRUD_Cavalerie/Uploads/CavaleriePH/674eb11473393_f7c841e64ef1a2ecd91fedf0371609e9e2c62ee7274c0f5f24767ced32b33d02.png', 48, 1, 0),
(45, '/Crud/Controleur/Cavalerie/PHP_CRUD_Cavalerie/Uploads/CavaleriePH/674eb11474ddb_54c93023a89f3b456543c380275dfb813c8fba6f1e93c347a00c32313dd813f3.png', 48, 1, 0),
(46, '/Controleur/Cavalerie/PHP_CRUD_Cavalerie/Uploads/CavaleriePH/674eb4364d6a0_ed9ef6bc726a879ff02f13201e572f1870ea76ef3e22db16fbc4cb95e2da6d0e.png', 49, 1, 0),
(47, '/Controleur/Cavalerie/PHP_CRUD_Cavalerie/Uploads/CavaleriePH/674eb4364ffca_2f94429c99f7a381f47bc615f658936aad445ec7cc15ba25be7b80b8bbd90232.png', 49, 1, 0),
(48, '/Controleur/Cavalerie/PHP_CRUD_Cavalerie/Uploads/CavaleriePH/674eb9f6ea3ad_5c18e5c187ab606058120aa88999ad8a426504235b062c83b0b9d5fab5d26201.png', 49, 1, 0),
(49, '/Controleur/Cavalerie/PHP_CRUD_Cavalerie/Uploads/CavaleriePH/674ec3e57c949_fd02802aa08f2a1472b7050c0cd030f09a46827de5bc02a2ec5bf2aad6cc6df5.png', 50, 1, 0),
(50, '/Controleur/Cavalerie/PHP_CRUD_Cavalerie/Uploads/CavaleriePH/674ec3e580a69_3b2581bc585b84fa0bdb9c31113d867e130f9ca19dfcdbdc93ae003fc72e7f40.png', 50, 1, 0),
(51, '/Controleur/Cavalerie/PHP_CRUD_Cavalerie/Uploads/CavaleriePH/674ee2d0d801b_5c18e5c187ab606058120aa88999ad8a426504235b062c83b0b9d5fab5d26201.png', 50, 1, 0),
(54, '/Controleur/Cavalerie/PHP_CRUD_Cavalerie/Uploads/CavaleriePH/674f4c75b8dcd_3b2581bc585b84fa0bdb9c31113d867e130f9ca19dfcdbdc93ae003fc72e7f40.png', 51, 0, 0),
(55, '/Controleur/Cavalerie/PHP_CRUD_Cavalerie/Uploads/CavaleriePH/674f4c7b0210d_fcb53cec70d80ec733d1bf5a1b4f4944061c77486b362e026da11415d3604849.png', 51, 1, 0),
(56, '/Controleur/Cavalerie/PHP_CRUD_Cavalerie/Uploads/CavaleriePH/674f4ed21cdb1_5c18e5c187ab606058120aa88999ad8a426504235b062c83b0b9d5fab5d26201.png', 51, 0, 0),
(57, '/Controleur/Cavalerie/PHP_CRUD_Cavalerie/Uploads/CavaleriePH/674f58d8280c3_5c18e5c187ab606058120aa88999ad8a426504235b062c83b0b9d5fab5d26201.png', 50, 1, 0),
(58, '/Controleur/Cavalerie/PHP_CRUD_Cavalerie/Uploads/CavaleriePH/674f5a1dac34c_ed9ef6bc726a879ff02f13201e572f1870ea76ef3e22db16fbc4cb95e2da6d0e.png', 49, 1, 0),
(59, '/Controleur/Cavalerie/PHP_CRUD_Cavalerie/Uploads/CavaleriePH/674f5acaa1b11_04a397fc31aa3e06381fd28ab609fe7716167f396b2fc4740e2fe21916ecdcdf.png', 50, 1, 0),
(60, '/Controleur/Cavalerie/PHP_CRUD_Cavalerie/Uploads/CavaleriePH/674f5afb53393_8b9df72b957c2fae66364bb36361d523177942e5b85bbc53f94c65e7c054d553.png', 50, 1, 0),
(61, '/Controleur/Cavalerie/PHP_CRUD_Cavalerie/Uploads/CavaleriePH/674f5ba85fbc1_15352adee214611b9d6f2bb8ec8013e9af342fd9530931f4908af4fbf3148588.png', 50, 1, 0),
(62, '/Controleur/Cavalerie/PHP_CRUD_Cavalerie/Uploads/CavaleriePH/674f5bf9f2d5e_5c18e5c187ab606058120aa88999ad8a426504235b062c83b0b9d5fab5d26201.png', 50, 1, 0),
(63, '/Controleur/Cavalerie/PHP_CRUD_Cavalerie/Uploads/CavaleriePH/674f5e4908f08_04a397fc31aa3e06381fd28ab609fe7716167f396b2fc4740e2fe21916ecdcdf.png', 50, 0, 0),
(64, '/Controleur/Cavalerie/PHP_CRUD_Cavalerie/Uploads/CavaleriePH/674f643b73171_eebbc5914c862f75c362676fc5e81b385395672d5677d54f49457654c2af86cf.png', 50, 1, 0),
(65, '/Controleur/Cavalerie/PHP_CRUD_Cavalerie/Uploads/CavaleriePH/674f69488ac55_54c93023a89f3b456543c380275dfb813c8fba6f1e93c347a00c32313dd813f3.png', 50, 0, 0),
(66, '/Controleur/Cavalerie/PHP_CRUD_Cavalerie/Uploads/CavaleriePH/674f6c6c5516c_74fb3d2bf1a408fbfe426fd29cc79d51db5a6d5c54b3ff97432a5eacdb43e7b5.png', 52, 0, 0),
(67, '/Controleur/Cavalerie/PHP_CRUD_Cavalerie/Uploads/CavaleriePH/674f6c6c561ac_3b2581bc585b84fa0bdb9c31113d867e130f9ca19dfcdbdc93ae003fc72e7f40.png', 52, 1, 0),
(68, '/Controleur/Cavalerie/PHP_CRUD_Cavalerie/Uploads/CavaleriePH/674f7e1e2e102_5c18e5c187ab606058120aa88999ad8a426504235b062c83b0b9d5fab5d26201.png', 48, 0, 0),
(69, 'dsfsdfs/Fsdvdv/', 0, 0, 0),
(70, 'dqsdqsdqs/dqsdsqd', 0, 1, 9),
(71, '/Controleur/Evenement/PHP_CRUD_Evenement/Uploads/EvenementPH/67501f8423e28_3b2581bc585b84fa0bdb9c31113d867e130f9ca19dfcdbdc93ae003fc72e7f40.png', 0, 1, 8),
(72, '/Controleur/Evenement/PHP_CRUD_Evenement/Uploads/EvenementPH/675022901ac75_f7c841e64ef1a2ecd91fedf0371609e9e2c62ee7274c0f5f24767ced32b33d02.png', 0, 1, 8),
(73, '/Controleur/Evenement/PHP_CRUD_Evenement/Uploads/EvenementPH/6750264176433_04a397fc31aa3e06381fd28ab609fe7716167f396b2fc4740e2fe21916ecdcdf.png', 0, 0, 2),
(74, '/Controleur/Evenement/PHP_CRUD_Evenement/Uploads/EvenementPH/67503e44443b9_ab447c01a9bc313c6884e1d7cc6e957b54d97f2a90b5d82de232b030b728a868.png', 0, 0, 2),
(75, '/Controleur/Evenement/PHP_CRUD_Evenement/Uploads/EvenementPH/675044a7cd743_f7c841e64ef1a2ecd91fedf0371609e9e2c62ee7274c0f5f24767ced32b33d02.png', 0, 1, 2),
(76, '/Controleur/Cavalerie/PHP_CRUD_Cavalerie/Uploads/CavaleriePH/6750487f76325_ab447c01a9bc313c6884e1d7cc6e957b54d97f2a90b5d82de232b030b728a868.png', 53, 0, 0),
(77, '/Controleur/Cavalerie/PHP_CRUD_Cavalerie/Uploads/CavaleriePH/675048ab65bd2_ab447c01a9bc313c6884e1d7cc6e957b54d97f2a90b5d82de232b030b728a868.png', 54, 0, 0),
(78, '/Controleur/Cavalerie/PHP_CRUD_Cavalerie/Uploads/CavaleriePH/675048fa82bb0_c86ef7ce93f94df09eaceb847d5038de40ac077f5b7fabfc53676c1e9a0d123d.png', 55, 0, 0),
(79, '/Controleur/Cavalerie/PHP_CRUD_Cavalerie/Uploads/CavaleriePH/67504d5d0169c_8b2a868a8aab3dc8110c80c247304010d4a084609d568db145dd42299cb051b1.png', 56, 0, 0),
(80, '/Controleur/Cavalerie/PHP_CRUD_Cavalerie/Uploads/CavaleriePH/67504d924e41b_8b2a868a8aab3dc8110c80c247304010d4a084609d568db145dd42299cb051b1.png', 57, 0, 0),
(81, '/Controleur/Cavalerie/PHP_CRUD_Cavalerie/Uploads/CavaleriePH/67504dc503830_b1fbf51103721eba02ac889976d2e72ae1a1eef495115fadd4737e70e59604d9.png', 58, 0, 0),
(82, '/Controleur/Cavalerie/PHP_CRUD_Cavalerie/Uploads/CavaleriePH/675052fe1ed24_04a397fc31aa3e06381fd28ab609fe7716167f396b2fc4740e2fe21916ecdcdf.png', 59, 0, 0),
(83, '/Controleur/Cavalerie/PHP_CRUD_Cavalerie/Uploads/CavaleriePH/6750535552f50_f7c841e64ef1a2ecd91fedf0371609e9e2c62ee7274c0f5f24767ced32b33d02.png', 60, 0, 0),
(84, '/Controleur/Cavalerie/PHP_CRUD_Cavalerie/Uploads/CavaleriePH/67505d4e0ef74_04a397fc31aa3e06381fd28ab609fe7716167f396b2fc4740e2fe21916ecdcdf.png', 61, 0, 0),
(85, '/Controleur/Cavalerie/PHP_CRUD_Cavalerie/Uploads/CavaleriePH/67506d6232068_04a397fc31aa3e06381fd28ab609fe7716167f396b2fc4740e2fe21916ecdcdf.png', 62, 0, 0),
(86, '/Controleur/Cavalerie/PHP_CRUD_Cavalerie/Uploads/CavaleriePH/67506ddc5a388_35f0ff06ab865662e530d151c393706eb908c2cbc2854832377949bc7259a5a6.png', 63, 0, 0),
(87, '/Controleur/Cavalerie/PHP_CRUD_Cavalerie/Uploads/CavaleriePH/675070e652b31_43a46bfaac3bc98316626b57ab11f5d23cef188c955eaf00d581d9911d8e0a50.png', 64, 0, 0),
(88, '/Controleur/Cavalerie/PHP_CRUD_Cavalerie/Uploads/CavaleriePH/675072431c44d_24ae78a4efb85d028ef0052035a6195bdf00ce25669978be1e6ac098feb1a477.png', 65, 0, 0),
(89, '/Controleur/Cavalerie/PHP_CRUD_Cavalerie/Uploads/CavaleriePH/675072431dca3_24ae78a4efb85d028ef0052035a6195bdf00ce25669978be1e6ac098feb1a477.png', 65, 0, 0),
(90, '/Controleur/Cavalerie/PHP_CRUD_Cavalerie/Uploads/CavaleriePH/675072431f483_054f431b25d35faf6e28fc7517d71a1a9ef0ce574a426ff156b38673f0a8eaf8.png', 65, 0, 0),
(91, '/Controleur/Cavalerie/PHP_CRUD_Cavalerie/Uploads/CavaleriePH/675072854d1d5_24ae78a4efb85d028ef0052035a6195bdf00ce25669978be1e6ac098feb1a477.png', 64, 1, 0),
(92, '/Controleur/Cavalerie/PHP_CRUD_Cavalerie/Uploads/CavaleriePH/6750729fc5f09_24ae78a4efb85d028ef0052035a6195bdf00ce25669978be1e6ac098feb1a477.png', 64, 1, 0),
(93, '/Controleur/Evenement/PHP_CRUD_Evenement/Uploads/EvenementPH/6750730fd4b62_be704d426b4bd0203e6289af9547d71b921e029aaf73adab17731226b633813f.png', 0, 0, 9),
(94, '/Controleur/Evenement/PHP_CRUD_Evenement/Uploads/EvenementPH/6750730fd5c3d_4b265942383b8a8d60fc5e5050decfc29bedb215ce42a0b74f0f20deda5d0b86.png', 0, 0, 9),
(95, '/Controleur/Evenement/PHP_CRUD_Evenement/Uploads/EvenementPH/6750730fdb69b_388e8c49d9104aa2f4cca9d87c7840cb492c1658eb00ba6b0257c897f16fcb44.png', 0, 0, 9),
(96, '/Controleur/Evenement/PHP_CRUD_Evenement/Uploads/EvenementPH/675073a5a0c12_35f0ff06ab865662e530d151c393706eb908c2cbc2854832377949bc7259a5a6.png', 0, 0, 2),
(97, '/Controleur/Evenement/PHP_CRUD_Evenement/Uploads/EvenementPH/675073b5409af_388e8c49d9104aa2f4cca9d87c7840cb492c1658eb00ba6b0257c897f16fcb44.png', 0, 0, 4),
(98, '/Controleur/Evenement/PHP_CRUD_Evenement/Uploads/EvenementPH/675073c48a547_35f0ff06ab865662e530d151c393706eb908c2cbc2854832377949bc7259a5a6.png', 0, 0, 6),
(99, '/Controleur/Evenement/PHP_CRUD_Evenement/Uploads/EvenementPH/675074d0cdce3_98b95ace6f8764cade26a4762396c38d2cc0f2e1f9174c4a5b16d6233fcdadc1.png', 0, 1, 3),
(100, '/Controleur/Cavalerie/PHP_CRUD_Cavalerie/Uploads/CavaleriePH/6750751ba3d2d_24a3aa12d4321c9140ddfe3de05266475e383dba88cb1e83a4838fa9f063e7db.png', 66, 1, 0),
(101, '/Controleur/Cavalerie/PHP_CRUD_Cavalerie/Uploads/CavaleriePH/6750751ba4ae3_f2e45b6a273988d015476395790baf9638797e9a812562a2337a1de4d7ea364e.png', 66, 0, 0),
(102, '/Controleur/Cavalerie/PHP_CRUD_Cavalerie/Uploads/CavaleriePH/675075390090b_24a3aa12d4321c9140ddfe3de05266475e383dba88cb1e83a4838fa9f063e7db.png', 66, 1, 0),
(103, '/Controleur/Evenement/PHP_CRUD_Evenement/Uploads/EvenementPH/675075987b457_43a46bfaac3bc98316626b57ab11f5d23cef188c955eaf00d581d9911d8e0a50.png', 0, 0, 6),
(104, '/Controleur/Cavalerie/PHP_CRUD_Cavalerie/Uploads/CavaleriePH/6750765639d27_be704d426b4bd0203e6289af9547d71b921e029aaf73adab17731226b633813f.png', 66, 1, 0),
(105, '/Controleur/Cavalerie/PHP_CRUD_Cavalerie/Uploads/CavaleriePH/6750786fefada_42cf7e195bb35cbfcb5a5643c8cee16f4d032c8de2a58c50a31d311bb0816c17.png', 66, 1, 0),
(106, '/Controleur/Cavalerie/PHP_CRUD_Cavalerie/Uploads/CavaleriePH/675078ce83ce7_43a46bfaac3bc98316626b57ab11f5d23cef188c955eaf00d581d9911d8e0a50.png', 64, 0, 0),
(107, '/Controleur/Cavalerie/PHP_CRUD_Cavalerie/Uploads/CavaleriePH/6750795aeb5b2_24a3aa12d4321c9140ddfe3de05266475e383dba88cb1e83a4838fa9f063e7db.png', 63, 0, 0),
(108, '/Controleur/Cavalerie/PHP_CRUD_Cavalerie/Uploads/CavaleriePH/675079f785749_4b265942383b8a8d60fc5e5050decfc29bedb215ce42a0b74f0f20deda5d0b86.png', 63, 0, 0),
(109, '/Controleur/Cavalerie/PHP_CRUD_Cavalerie/Uploads/CavaleriePH/67507a15ed2a9_24ae78a4efb85d028ef0052035a6195bdf00ce25669978be1e6ac098feb1a477.png', 64, 0, 0),
(110, '/Controleur/Cavalerie/PHP_CRUD_Cavalerie/Uploads/CavaleriePH/67507a43f3a72_43a46bfaac3bc98316626b57ab11f5d23cef188c955eaf00d581d9911d8e0a50.png', 63, 0, 0),
(111, '/Controleur/Cavalerie/PHP_CRUD_Cavalerie/Uploads/CavaleriePH/67507a5b914cc_a98de058dcc96be966c65a92b06031ed2e3f4e7c08c5820adce9bf2fd6b97743.png', 63, 0, 0),
(112, '/Controleur/Cavalerie/PHP_CRUD_Cavalerie/Uploads/CavaleriePH/67507ad4f0d53_35f0ff06ab865662e530d151c393706eb908c2cbc2854832377949bc7259a5a6.png', 64, 0, 0),
(113, '/Controleur/Cavalerie/PHP_CRUD_Cavalerie/Uploads/CavaleriePH/67507b4d40ea5_43a46bfaac3bc98316626b57ab11f5d23cef188c955eaf00d581d9911d8e0a50.png', 65, 0, 0),
(114, '/Controleur/Evenement/PHP_CRUD_Evenement/Uploads/EvenementPH/67507c1382c43_24ae78a4efb85d028ef0052035a6195bdf00ce25669978be1e6ac098feb1a477.png', 0, 0, 6),
(115, '/Controleur/Evenement/PHP_CRUD_Evenement/Uploads/EvenementPH/67518299a491f_24ae78a4efb85d028ef0052035a6195bdf00ce25669978be1e6ac098feb1a477.png', 0, 0, 11),
(116, '/Controleur/Evenement/PHP_CRUD_Evenement/Uploads/EvenementPH/67518299a5d0f_24ae78a4efb85d028ef0052035a6195bdf00ce25669978be1e6ac098feb1a477.png', 0, 1, 11),
(117, '/Controleur/Evenement/PHP_CRUD_Evenement/Uploads/EvenementPH/67518299abed4_24ae78a4efb85d028ef0052035a6195bdf00ce25669978be1e6ac098feb1a477.png', 0, 0, 11);

-- --------------------------------------------------------

--
-- Structure de la table `prend`
--

CREATE TABLE `prend` (
  `refidcava` int(11) NOT NULL,
  `refidpen` int(11) NOT NULL,
  `supprime` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `prend`
--

INSERT INTO `prend` (`refidcava`, `refidpen`, `supprime`) VALUES
(18, 32, 1),
(18, 34, 1),
(18, 36, 1),
(18, 38, 1),
(18, 40, 1),
(22, 33, 1),
(22, 35, 1),
(22, 37, 1),
(22, 39, 0);

-- --------------------------------------------------------

--
-- Structure de la table `race`
--

CREATE TABLE `race` (
  `idRace` int(11) NOT NULL,
  `LibRace` varchar(30) NOT NULL,
  `Supprime` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `race`
--

INSERT INTO `race` (`idRace`, `LibRace`, `Supprime`) VALUES
(2, 'Texan', 0),
(3, 'Anglais', 0);

-- --------------------------------------------------------

--
-- Structure de la table `robe`
--

CREATE TABLE `robe` (
  `idRobe` int(11) NOT NULL,
  `LibRobe` varchar(30) NOT NULL,
  `Supprime` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `robe`
--

INSERT INTO `robe` (`idRobe`, `LibRobe`, `Supprime`) VALUES
(1, 'Blanc', 1),
(2, 'Bleu', 0),
(4, 'violet', 0);

-- --------------------------------------------------------

--
-- Structure de la table `role`
--

CREATE TABLE `role` (
  `idU` int(11) NOT NULL,
  `LibRole` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `role`
--

INSERT INTO `role` (`idU`, `LibRole`) VALUES
(1, 'Admin'),
(2, 'Utilisateur');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `calendrier`
--
ALTER TABLE `calendrier`
  ADD PRIMARY KEY (`idCourSeance`,`idCoursCours`);

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
-- Index pour la table `participe`
--
ALTER TABLE `participe`
  ADD PRIMARY KEY (`idCoursB`,`idCoursAss`),
  ADD KEY `Fk_CavalierPart` (`RefCavalier`);

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
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `calendrier`
--
ALTER TABLE `calendrier`
  MODIFY `idCourSeance` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=499;

--
-- AUTO_INCREMENT pour la table `cavalerie`
--
ALTER TABLE `cavalerie`
  MODIFY `NumSir` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT pour la table `cavalier`
--
ALTER TABLE `cavalier`
  MODIFY `idCavalier` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT pour la table `cours`
--
ALTER TABLE `cours`
  MODIFY `idCours` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT pour la table `evenement`
--
ALTER TABLE `evenement`
  MODIFY `idEvenement` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT pour la table `galop`
--
ALTER TABLE `galop`
  MODIFY `idGalop` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `liste`
--
ALTER TABLE `liste`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT pour la table `pension`
--
ALTER TABLE `pension`
  MODIFY `idPension` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT pour la table `photo`
--
ALTER TABLE `photo`
  MODIFY `idPhoto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=118;

--
-- AUTO_INCREMENT pour la table `race`
--
ALTER TABLE `race`
  MODIFY `idRace` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `robe`
--
ALTER TABLE `robe`
  MODIFY `idRobe` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `role`
--
ALTER TABLE `role`
  MODIFY `idU` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Contraintes pour les tables déchargées
--

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
-- Contraintes pour la table `participe`
--
ALTER TABLE `participe`
  ADD CONSTRAINT `Fk_CavalierPart` FOREIGN KEY (`RefCavalier`) REFERENCES `cavalier` (`idCavalier`),
  ADD CONSTRAINT `Fk_CoursP` FOREIGN KEY (`idCoursB`) REFERENCES `cours` (`idCours`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
