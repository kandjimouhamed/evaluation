-- phpMyAdmin SQL Dump
-- version 4.8.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  ven. 10 jan. 2020 à 17:59
-- Version du serveur :  10.1.31-MariaDB
-- Version de PHP :  5.6.35

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `gestionor`
--

-- --------------------------------------------------------

--
-- Structure de la table `actionintervenant`
--

CREATE TABLE `actionintervenant` (
  `actioncode` int(11) NOT NULL,
  `codeintervenant` int(11) NOT NULL,
  `typeintervation` varchar(254) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `actionintervenant`
--

INSERT INTO `actionintervenant` (`actioncode`, `codeintervenant`, `typeintervation`) VALUES
(1, 2, 'MEP'),
(1, 8, 'MES'),
(2, 2, 'MEP'),
(2, 9, 'MES'),
(2, 11, 'MES');

-- --------------------------------------------------------

--
-- Structure de la table `actions`
--

CREATE TABLE `actions` (
  `actioncode` int(11) NOT NULL,
  `libelleaction` varchar(254) DEFAULT NULL,
  `resumer` text,
  `idetat` int(11) DEFAULT NULL,
  `datedebut` date DEFAULT NULL,
  `datefin` date DEFAULT NULL,
  `dossiercode` int(11) NOT NULL,
  `delai` int(11) NOT NULL,
  `IDINTERVENANT` int(11) NOT NULL,
  `IDETAPE` int(11) NOT NULL,
  `position` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `actions`
--

INSERT INTO `actions` (`actioncode`, `libelleaction`, `resumer`, `idetat`, `datedebut`, `datefin`, `dossiercode`, `delai`, `IDINTERVENANT`, `IDETAPE`, `position`) VALUES
(17, 'TEST ACTION', 'TEST', 2, '2020-01-10', '2020-01-10', 22, 0, 4, 11, 1),
(18, '', '', 2, '2020-01-10', '2020-01-10', 22, 0, 5, 12, 2),
(19, NULL, NULL, 1, '2020-01-10', NULL, 22, 0, 6, 13, 3),
(20, 'TEST ACTION', 'TEST', 2, '2020-01-10', '2020-01-10', 23, 0, 4, 11, 1),
(21, 'TEST', 'TEST', 2, '2020-01-10', '2020-01-10', 24, 0, 4, 11, 1),
(22, '', '', 1, '2020-01-10', '2020-01-10', 25, 0, 4, 14, 1),
(23, NULL, NULL, 1, '2020-01-10', NULL, 25, 0, 5, 15, 2),
(24, NULL, NULL, 1, '2020-01-10', NULL, 25, 0, 5, 15, 2),
(25, NULL, NULL, 1, '2020-01-10', NULL, 24, 0, 5, 12, 2),
(26, NULL, NULL, 1, '2020-01-10', NULL, 23, 0, 5, 12, 2),
(27, '', '', 1, '2020-01-10', '2020-01-10', 26, 0, 4, 14, 1),
(28, NULL, NULL, 1, '2020-01-10', NULL, 26, 0, 5, 15, 2);

-- --------------------------------------------------------

--
-- Structure de la table `circuit`
--

CREATE TABLE `circuit` (
  `ID` int(11) NOT NULL,
  `NOM_CIRCUIT` varchar(255) NOT NULL,
  `directioncode` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `circuit`
--

INSERT INTO `circuit` (`ID`, `NOM_CIRCUIT`, `directioncode`) VALUES
(1, 'CIRCUIT2', 26),
(2, 'CIRCUIT1', 26),
(3, 'CIRCUIT3', 26),
(4, 'TEST CIRCUIT', 27),
(5, 'CCBMTECH', 27);

-- --------------------------------------------------------

--
-- Structure de la table `clients`
--

CREATE TABLE `clients` (
  `IDCLIENT` int(11) NOT NULL,
  `type` varchar(255) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(100) DEFAULT NULL,
  `email` varchar(50) NOT NULL,
  `telephone` varchar(9) NOT NULL,
  `adresse` varchar(255) DEFAULT NULL,
  `personneacontacter` varchar(100) DEFAULT NULL,
  `telephonepersacontacter` varchar(9) DEFAULT NULL,
  `filialecode` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `clients`
--

INSERT INTO `clients` (`IDCLIENT`, `type`, `nom`, `prenom`, `email`, `telephone`, `adresse`, `personneacontacter`, `telephonepersacontacter`, `filialecode`) VALUES
(21, 'particulier', 'CISSOKHOMODIF', '', 'admin3@black.com', 'TEL', '', 'CONTACT', 'TEL CONTA', 0),
(23, 'particulier', 'CISSOKHO', 'AIDA', 'admin1@black.com', 'TEL3', 'test', 'CONTACT', 'TEL CONTA', 0),
(24, 'entreprise', 'SOCIETE1', '', 'aida.cissokho@ccbm.sn', '775254286', 'DAKAR RUE MARCHAND', 'AIDA', '775254286', 0);

-- --------------------------------------------------------

--
-- Structure de la table `clientvehicule`
--

CREATE TABLE `clientvehicule` (
  `IDCLIENT` int(11) NOT NULL,
  `IDVEHICULE` int(11) NOT NULL,
  `debut_acquis` date DEFAULT NULL,
  `fin_acquis` date DEFAULT NULL,
  `proprietaire` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `clientvehicule`
--

INSERT INTO `clientvehicule` (`IDCLIENT`, `IDVEHICULE`, `debut_acquis`, `fin_acquis`, `proprietaire`) VALUES
(21, 3, '2019-12-11', '2019-12-11', ''),
(21, 4, '2019-12-11', NULL, ''),
(23, 3, '2019-12-11', '2019-12-11', ''),
(24, 3, '2019-12-11', NULL, '');

-- --------------------------------------------------------

--
-- Structure de la table `commande_dossier`
--

CREATE TABLE `commande_dossier` (
  `ID` int(11) NOT NULL,
  `REFERENCE_MPR` varchar(255) DEFAULT NULL,
  `DESIGNATION_MPR` varchar(255) DEFAULT NULL,
  `QUANTITE_MPR` int(11) NOT NULL,
  `PU_MPR` double NOT NULL,
  `DATE_CMD_MPR` date DEFAULT NULL,
  `DATE_RECEPT_MPR` date DEFAULT NULL,
  `STATUT_CMD` varchar(255) NOT NULL DEFAULT 'Commande',
  `DATE_EMBARQUEMENT` date DEFAULT NULL,
  `MODE_EXPEDITION` varchar(255) NOT NULL DEFAULT 'AERIEN',
  `DATE_APPROX` date DEFAULT NULL,
  `DATE_EFFECT` date DEFAULT NULL,
  `OBSERVATION` text,
  `ID_DOSSIER` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `commande_dossier`
--

INSERT INTO `commande_dossier` (`ID`, `REFERENCE_MPR`, `DESIGNATION_MPR`, `QUANTITE_MPR`, `PU_MPR`, `DATE_CMD_MPR`, `DATE_RECEPT_MPR`, `STATUT_CMD`, `DATE_EMBARQUEMENT`, `MODE_EXPEDITION`, `DATE_APPROX`, `DATE_EFFECT`, `OBSERVATION`, `ID_DOSSIER`) VALUES
(1, 'ref1', 'design1', 10, 100, '2019-01-10', NULL, 'Commande', '2019-01-10', 'AERIEN', '2019-01-10', '2019-01-10', NULL, 10718),
(2, 'ref2', 'des2', 10, 3000, '2019-01-11', NULL, 'Commande', NULL, 'AERIEN', NULL, NULL, NULL, 10718),
(3, 'ref1', 'dqdqdq', 1, 0, '2019-02-25', NULL, 'Commande', NULL, 'AERIEN', NULL, NULL, NULL, 10731),
(4, 'Refp1', 'test', 1, 0, '2019-02-28', NULL, 'Commande', '2019-02-28', 'AERIEN', '2019-02-28', NULL, NULL, 10737),
(5, 'radiateur', 'radiateur', 20, 3000, '2019-04-03', NULL, 'Commande', '2019-04-03', 'AERIEN', '2019-04-26', '2019-04-30', NULL, 10718);

-- --------------------------------------------------------

--
-- Structure de la table `compte`
--

CREATE TABLE `compte` (
  `idcompte` int(11) NOT NULL,
  `login` varchar(254) DEFAULT NULL,
  `password` varchar(254) DEFAULT NULL,
  `profil` varchar(254) DEFAULT NULL,
  `codeintervenant` int(11) NOT NULL,
  `directioncode` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `conditionetape`
--

CREATE TABLE `conditionetape` (
  `ID` int(11) NOT NULL,
  `type` varchar(255) NOT NULL,
  `action` varchar(255) NOT NULL,
  `ressource` int(11) NOT NULL,
  `operateur` varchar(255) NOT NULL,
  `position` int(11) NOT NULL,
  `IDSERVICE` int(11) NOT NULL,
  `IDETAPE` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `conditionetape`
--

INSERT INTO `conditionetape` (`ID`, `type`, `action`, `ressource`, `operateur`, `position`, `IDSERVICE`, `IDETAPE`) VALUES
(1, 'Ressource', '', 70000, '<', 1, 4, 7),
(2, 'Action', '2', 0, '=', 1, 4, 7);

-- --------------------------------------------------------

--
-- Structure de la table `direction`
--

CREATE TABLE `direction` (
  `directioncode` int(11) NOT NULL,
  `directionnom` varchar(254) DEFAULT NULL,
  `emailnotification` text NOT NULL,
  `filialecode` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `direction`
--

INSERT INTO `direction` (`directioncode`, `directionnom`, `emailnotification`, `filialecode`) VALUES
(1, 'DIRECTION ALIMENTAIRE 1', '', 2),
(18, 'DIRECTION MARKETING', '', 3),
(19, 'DIRECTION ALIMENTAIRE 2', '', 2),
(20, 'Direction Finance', '', 3),
(21, 'Direction Espace Auto', '', 3),
(22, 'Direction Electronique', '', 5),
(26, 'DIRECTION HOLDING 1', '', 3),
(27, 'TEST DIRECTION', 'aida.cissokho@ccbm.sn', 9);

-- --------------------------------------------------------

--
-- Structure de la table `dossier`
--

CREATE TABLE `dossier` (
  `dossiercode` int(11) NOT NULL,
  `nom` varchar(254) DEFAULT NULL,
  `idetat` int(11) DEFAULT NULL,
  `datedebut` datetime DEFAULT CURRENT_TIMESTAMP,
  `datefin` date DEFAULT NULL,
  `directioncode` int(11) NOT NULL DEFAULT '1',
  `delai` int(11) DEFAULT '0',
  `NUM_DEVIS` varchar(255) DEFAULT NULL,
  `TRAVAUX_DEMANDE` text,
  `SOUCHE` varchar(255) DEFAULT NULL,
  `IDCIRCUIT` int(11) NOT NULL,
  `IDVEHICULE` int(11) NOT NULL,
  `IDCLIENT` int(11) NOT NULL,
  `IDUTILISATEUR` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `dossier`
--

INSERT INTO `dossier` (`dossiercode`, `nom`, `idetat`, `datedebut`, `datefin`, `directioncode`, `delai`, `NUM_DEVIS`, `TRAVAUX_DEMANDE`, `SOUCHE`, `IDCIRCUIT`, `IDVEHICULE`, `IDCLIENT`, `IDUTILISATEUR`) VALUES
(1, 'CISSOKHOMODIF', 1, '2020-01-03 00:00:00', NULL, 26, 0, 'DEVIS', '\r\n\r\nEt quoniam mirari posse quosdam peregrinos existimo haec lecturos forsitan, si contigerit, quamobrem cum oratio ad ea monstranda deflexerit quae Romae gererentur, nihil praeter seditiones narratur et tabernas et vilitates harum similis alias, summatim causas perstringam nusquam a veritate sponte propria digressurus.\r\n', 'SOUCHE', 1, 3, 21, 0),
(2, 'CISSOKHOMODIF', 1, '2020-01-03 00:00:00', NULL, 26, 0, 'DEVIS', '\r\n\r\nEt quoniam mirari posse quosdam peregrinos existimo haec lecturos forsitan, si contigerit, quamobrem cum oratio ad ea monstranda deflexerit quae Romae gererentur, nihil praeter seditiones narratur et tabernas et vilitates harum similis alias, summatim causas perstringam nusquam a veritate sponte propria digressurus.\r\n', 'SOUCHE', 1, 3, 21, 0),
(3, 'CISSOKHOMODIF', 1, '2020-01-03 00:00:00', NULL, 26, 0, 'DEVIS', '\r\n\r\nEt quoniam mirari posse quosdam peregrinos existimo haec lecturos forsitan, si contigerit, quamobrem cum oratio ad ea monstranda deflexerit quae Romae gererentur, nihil praeter seditiones narratur et tabernas et vilitates harum similis alias, summatim causas perstringam nusquam a veritate sponte propria digressurus.\r\n', 'SOUCHE', 1, 3, 21, 0),
(4, 'CISSOKHOMODIF', 1, '2020-01-03 00:00:00', NULL, 26, 0, 'DEVIS', '\r\n\r\nEt quoniam mirari posse quosdam peregrinos existimo haec lecturos forsitan, si contigerit, quamobrem cum oratio ad ea monstranda deflexerit quae Romae gererentur, nihil praeter seditiones narratur et tabernas et vilitates harum similis alias, summatim causas perstringam nusquam a veritate sponte propria digressurus.\r\n', 'SOUCHE', 1, 3, 21, 0),
(5, 'CISSOKHOMODIF', 1, '2020-01-03 00:00:00', NULL, 26, 0, 'DEVIS', '\r\n\r\nEt quoniam mirari posse quosdam peregrinos existimo haec lecturos forsitan, si contigerit, quamobrem cum oratio ad ea monstranda deflexerit quae Romae gererentur, nihil praeter seditiones narratur et tabernas et vilitates harum similis alias, summatim causas perstringam nusquam a veritate sponte propria digressurus.\r\n', 'SOUCHE', 1, 3, 21, 0),
(6, 'CISSOKHOMODIF', 1, '2020-01-03 00:00:00', NULL, 26, 0, 'DEVIS', '\r\n\r\nEt quoniam mirari posse quosdam peregrinos existimo haec lecturos forsitan, si contigerit, quamobrem cum oratio ad ea monstranda deflexerit quae Romae gererentur, nihil praeter seditiones narratur et tabernas et vilitates harum similis alias, summatim causas perstringam nusquam a veritate sponte propria digressurus.\r\n', 'SOUCHE', 1, 3, 21, 0),
(7, 'CISSOKHOMODIF', 1, '2020-01-03 00:00:00', NULL, 26, 0, 'DEVIS', '\r\n\r\nEt quoniam mirari posse quosdam peregrinos existimo haec lecturos forsitan, si contigerit, quamobrem cum oratio ad ea monstranda deflexerit quae Romae gererentur, nihil praeter seditiones narratur et tabernas et vilitates harum similis alias, summatim causas perstringam nusquam a veritate sponte propria digressurus.\r\n', 'SOUCHE', 1, 3, 21, 0),
(8, 'CISSOKHOMODIF', 1, '2020-01-03 00:00:00', NULL, 26, 0, 'DEVIS', '\r\n\r\nEt quoniam mirari posse quosdam peregrinos existimo haec lecturos forsitan, si contigerit, quamobrem cum oratio ad ea monstranda deflexerit quae Romae gererentur, nihil praeter seditiones narratur et tabernas et vilitates harum similis alias, summatim causas perstringam nusquam a veritate sponte propria digressurus.\r\n', 'SOUCHE', 1, 3, 21, 0),
(9, 'CISSOKHOMODIF', 1, '2020-01-03 00:00:00', NULL, 26, 0, 'DEVIS', '\r\n\r\nEt quoniam mirari posse quosdam peregrinos existimo haec lecturos forsitan, si contigerit, quamobrem cum oratio ad ea monstranda deflexerit quae Romae gererentur, nihil praeter seditiones narratur et tabernas et vilitates harum similis alias, summatim causas perstringam nusquam a veritate sponte propria digressurus.\r\n', 'SOUCHE', 1, 3, 21, 0),
(10, 'CISSOKHOMODIF', 1, '2020-01-03 00:00:00', NULL, 26, 0, 'DEVIS1', '', 'SOUCHE', 2, 3, 21, 0),
(11, 'CISSOKHOMODIF', 1, '2020-01-03 00:00:00', NULL, 26, 0, 'DEVIS1', '', 'SOUCHE', 2, 3, 21, 0),
(12, 'CISSOKHOMODIF', 1, '2020-01-03 00:00:00', NULL, 26, 0, 'DEVIS', '', 'SOUCHE', 2, 3, 21, 0),
(13, 'CISSOKHOMODIF', 1, '2020-01-03 00:00:00', NULL, 26, 0, '', '', '', 2, 3, 21, 0),
(14, 'CISSOKHOMODIF', 1, '2020-01-06 00:00:00', NULL, 26, 0, 'DEVIS', '', 'SOUCHE', 2, 3, 21, 0),
(15, 'CISSOKHO', 1, '2020-01-09 00:00:00', NULL, 27, 0, 'DEVIS1', 'TRAVEAU DEMANDE', 'SOUCHE', 4, 3, 23, 2),
(16, 'TEST CIRCUIT-2', 1, '2020-01-09 00:00:00', NULL, 27, 0, 'DEVIS1', '', 'SOUCHE', 4, 4, 24, 2),
(17, 'TEST CIRCUIT-2', 1, '2020-01-09 00:00:00', NULL, 27, 0, 'DEVIS1', '', 'SOUCHE', 4, 4, 24, 2),
(18, 'TEST CIRCUIT-2', 1, '2020-01-09 00:00:00', NULL, 27, 0, 'DEVIS1', '', 'SOUCHE', 4, 4, 24, 2),
(19, 'TEST CIRCUIT-2', 1, '2020-01-09 00:00:00', NULL, 27, 0, 'DEVIS1', '', 'SOUCHE', 4, 4, 24, 2),
(20, 'TEST CIRCUIT-6', 1, '2020-01-09 00:00:00', NULL, 27, 0, 'DEVIS1', '', 'SOUCHE', 4, 3, 24, 4),
(21, 'TEST CIRCUIT-7', 1, '2020-01-10 00:00:00', NULL, 27, 0, 'DEVIS1', '', 'SOUCHE', 4, 3, 21, 4),
(22, 'TEST CIRCUIT-8', 1, '2020-01-10 00:00:00', NULL, 27, 0, '', '', '', 4, 3, 24, 4),
(23, 'CIRCUIT10', 1, '2020-01-10 00:00:00', NULL, 27, 0, '', '', '', 4, 3, 21, 5),
(24, 'TEST CIRCUITTEST ', 1, '2020-01-10 00:00:00', NULL, 27, 0, 'DEVIS', '', 'SOUCHE', 4, 3, 21, 4),
(25, 'CCBMTECH-1', 1, '2020-01-10 00:00:00', NULL, 27, 0, '', '', '', 5, 3, 21, 4),
(26, 'CCBMTECH-2', 1, '2020-01-10 00:00:00', NULL, 27, 0, 'DEVIS1', 'ttttt', 'SOUCHE', 5, 3, 21, 4);

-- --------------------------------------------------------

--
-- Structure de la table `dossierintervenant`
--

CREATE TABLE `dossierintervenant` (
  `dossiercode` int(11) NOT NULL,
  `codeintervenant` int(11) NOT NULL,
  `typeintervation` varchar(254) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `etape`
--

CREATE TABLE `etape` (
  `ID` int(11) NOT NULL,
  `libelle` varchar(255) NOT NULL,
  `position` int(11) NOT NULL,
  `IDSERVICE` int(11) NOT NULL,
  `IDCIRCUIT` int(11) NOT NULL,
  `IDINTERVENANT` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `etape`
--

INSERT INTO `etape` (`ID`, `libelle`, `position`, `IDSERVICE`, `IDCIRCUIT`, `IDINTERVENANT`) VALUES
(1, 'ETAPE1', 1, 7, 1, 2),
(2, 'ETAPE2', 2, 7, 1, 2),
(3, 'ETAPE3', 3, 7, 1, 2),
(4, 'ETAPE4MODIF', 1, 7, 2, 2),
(5, 'ETAPE4MODIF', 2, 7, 2, 2),
(6, 'ETAPE4MODIF', 3, 7, 2, 2),
(7, 'ETAPE4MODIF', 1, 7, 3, 2),
(8, 'ETAPE4MODIF', 2, 7, 3, 2),
(9, 'ETAPE4MODIF', 3, 7, 3, 2),
(10, 'ETAPE4', 4, 7, 1, 2),
(11, 'TEST ETAPE1', 1, 3, 4, 4),
(12, 'TEST ETAPE2', 2, 4, 4, 5),
(13, 'TEST ETAPE3', 3, 5, 4, 6),
(14, 'ETAPE1', 1, 3, 5, 4),
(15, 'ETAPE2', 2, 4, 5, 5),
(16, 'ETAPE3', 3, 5, 5, 6);

-- --------------------------------------------------------

--
-- Structure de la table `etat`
--

CREATE TABLE `etat` (
  `ID` int(11) NOT NULL,
  `libelle` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `etat`
--

INSERT INTO `etat` (`ID`, `libelle`) VALUES
(1, 'En cours'),
(2, 'Terminee'),
(3, 'Annule'),
(4, 'Livre');

-- --------------------------------------------------------

--
-- Structure de la table `filiale`
--

CREATE TABLE `filiale` (
  `filialecode` int(11) NOT NULL,
  `filialesigle` varchar(254) DEFAULT NULL,
  `filialenom` varchar(254) DEFAULT NULL,
  `filialeresponsable` varchar(254) DEFAULT NULL,
  `filialeadresse` varchar(254) DEFAULT NULL,
  `filialetel` varchar(254) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `filiale`
--

INSERT INTO `filiale` (`filialecode`, `filialesigle`, `filialenom`, `filialeresponsable`, `filialeadresse`, `filialetel`) VALUES
(1, 'CCBM AUTO', 'CCBM AUTO', 'MBOUP', 'DAKAR', '338128123'),
(2, 'CCBMA', 'CCBM ALIMENTAIRE', 'ASSANE MBOUP', 'CENTRE VILLE', '338548585'),
(3, 'DD', 'CCBM HOLDING', 'SERIGNE MBOUP', 'DAKAR', '338797979'),
(5, 'DD', 'CCBM ELECTRONIQUE', 'Mr SARR', 'SANDAGA', '338767647'),
(6, 'CCBMH', 'CCBM MARKTING', 'Mr THIAM', 'CENTRE VILLE', '338747474'),
(7, 'CCBMT', 'ccbm technologies', 'Mr Mboup', 'RUFIQUE', '338545657'),
(9, 'NFCCBM MODIF2', 'TEST FILIALE', 'Responsable1', 'Dakar1', '7767767671'),
(10, 'CCBMI', 'CCBM INDUSTRIES', 'AIDA', '', ''),
(11, 'TEST', 'TEST', 'TEST', 'TEST', 'TEST');

-- --------------------------------------------------------

--
-- Structure de la table `intervenant`
--

CREATE TABLE `intervenant` (
  `codeintervenant` int(11) NOT NULL,
  `nom` varchar(254) DEFAULT NULL,
  `prenom` varchar(254) DEFAULT NULL,
  `poste` varchar(255) NOT NULL,
  `email` varchar(254) DEFAULT NULL,
  `utilisateur` varchar(255) NOT NULL,
  `pwd` varchar(255) NOT NULL,
  `filialecode` int(11) NOT NULL,
  `profil` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `intervenant`
--

INSERT INTO `intervenant` (`codeintervenant`, `nom`, `prenom`, `poste`, `email`, `utilisateur`, `pwd`, `filialecode`, `profil`) VALUES
(1, 'CISSOKHO', 'AIDA', 'RESPONSABLE SR', 'aida.cissokho@ccbm.sn', 'aida', '2991a6ba1f1420168809c49ed39dba8b', 7, 1),
(2, 'CISSOKHO', 'AIDA', 'RESPONSABLE SR', 'aida.cissokho@ccbm.sn', 'aida1', '2991a6ba1f1420168809c49ed39dba8b', 3, 2),
(3, 'CISSOKHO', 'AIDA', 'TEST', 'aida.cissokho@ccbm.sn', 'aida2', '56a4d11b58ad9e42ae13c08005bb2372', 3, 1),
(4, 'CISSOKHO', 'AIDA', 'POSTE', 'aida.cissokho@ccbm.sn', 'test1', '05a671c66aefea124cc08b76ea6d30bb', 9, 0),
(5, 'CISSOKHO', 'AIDA', 'POSTE', 'aida.cissokho@ccbm.sn', 'test2', '05a671c66aefea124cc08b76ea6d30bb', 1, 0),
(6, 'CISSOKHO', 'AIDA', 'POSTE', 'aida.cissokho@ccbm.sn', 'test3', '05a671c66aefea124cc08b76ea6d30bb', 9, 0);

-- --------------------------------------------------------

--
-- Structure de la table `localisation`
--

CREATE TABLE `localisation` (
  `id` int(11) NOT NULL,
  `libelle` varchar(255) NOT NULL,
  `message` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `localisation`
--

INSERT INTO `localisation` (`id`, `libelle`, `message`) VALUES
(2, 'A l essai', 'Votre véhicule  %matricule%  est à l’essai. '),
(3, 'Terminer', 'La réparation de votre vehicule   %matricule%  est terminée. Merci de passer la prendre '),
(6, 'Au garage', 'votre véhicule  %matricule% est au garage pour diagnostic.'),
(8, 'En reparation', 'votre véhicule  %matricule% est en cours de travaux'),
(9, 'Ouverture OR', 'L OR de votre véhicule %matricule% est crée. Les paramètres de connexion sont : serveur : %serveur%\r\nuser: %compte% pwd ccbmi'),
(10, 'Commande Piece', 'Les pieces de votre vehicule %matricule% sont commandes '),
(11, 'Reception Piece', ' Les pieces de votre vehicule %matricule% sont arrivees'),
(12, 'En cours', ' '),
(13, 'OR Valide', ' '),
(14, 'Demande dachat', ' ');

-- --------------------------------------------------------

--
-- Structure de la table `marques`
--

CREATE TABLE `marques` (
  `IDMARQUE` int(11) NOT NULL,
  `nom` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `marques`
--

INSERT INTO `marques` (`IDMARQUE`, `nom`) VALUES
(1, 'MARQUE1'),
(3, 'MARQUE2'),
(4, 'MARQUE3'),
(7, 'MARQUE5'),
(8, 'MARQUE6'),
(9, 'MARQUE7'),
(10, 'MARQUE8'),
(11, 'MARQUE9'),
(12, 'MARQUE10'),
(13, 'MARQUE11'),
(14, 'MARQUE12'),
(15, 'MARQUE1010');

-- --------------------------------------------------------

--
-- Structure de la table `modeles`
--

CREATE TABLE `modeles` (
  `IDMODELE` int(11) NOT NULL,
  `IDMARQUE` int(11) NOT NULL,
  `libelle` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `modeles`
--

INSERT INTO `modeles` (`IDMODELE`, `IDMARQUE`, `libelle`) VALUES
(1, 1, 'MODELE11'),
(2, 3, 'MODELE21'),
(3, 12, 'MODELE11MODIF'),
(4, 1, 'MODELE21'),
(5, 13, 'MODELE21'),
(6, 8, 'MODELE11MODIF'),
(7, 12, 'MODELE101010');

-- --------------------------------------------------------

--
-- Structure de la table `mode_expedition`
--

CREATE TABLE `mode_expedition` (
  `ID` int(11) NOT NULL,
  `LIBELLE` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `mode_expedition`
--

INSERT INTO `mode_expedition` (`ID`, `LIBELLE`) VALUES
(1, 'AERIEN'),
(2, 'DHL'),
(3, 'MARITIME');

-- --------------------------------------------------------

--
-- Structure de la table `parcautomobiles`
--

CREATE TABLE `parcautomobiles` (
  `IDPARCS` int(11) NOT NULL,
  `nom` varchar(100) NOT NULL,
  `adresse` varchar(255) NOT NULL,
  `telephone` varchar(9) NOT NULL,
  `superviseur` varchar(200) NOT NULL,
  `directioncode` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='parcautomobiles';

--
-- Déchargement des données de la table `parcautomobiles`
--

INSERT INTO `parcautomobiles` (`IDPARCS`, `nom`, `adresse`, `telephone`, `superviseur`, `directioncode`) VALUES
(1, 'LOCALISATION 1', '', '', '', 1);

-- --------------------------------------------------------

--
-- Structure de la table `parcvehicule`
--

CREATE TABLE `parcvehicule` (
  `IDPARC` int(11) NOT NULL,
  `IDVEHICULE` int(11) NOT NULL,
  `entree` date NOT NULL,
  `sortie` date DEFAULT NULL,
  `recupererpar` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `ressource`
--

CREATE TABLE `ressource` (
  `ressourcecode` int(11) NOT NULL,
  `nature` varchar(254) DEFAULT NULL,
  `libelle` varchar(254) NOT NULL,
  `resetat` varchar(254) DEFAULT NULL,
  `motif` varchar(254) DEFAULT NULL,
  `cout` int(11) DEFAULT NULL,
  `finance` varchar(254) DEFAULT NULL,
  `datedebut` date DEFAULT NULL,
  `datefin` date DEFAULT NULL,
  `dossiercode` int(11) NOT NULL,
  `observations` text,
  `IDETAPE` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `service`
--

CREATE TABLE `service` (
  `ID` int(11) NOT NULL,
  `NOM_SERVICE` varchar(255) NOT NULL,
  `directioncode` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `service`
--

INSERT INTO `service` (`ID`, `NOM_SERVICE`, `directioncode`) VALUES
(3, 'SERVICE1', 27),
(4, 'SERVICE2', 27),
(5, 'SERVICE3', 27),
(6, 'SERVICE4', 26),
(7, 'SERVICE5', 26),
(8, 'SERVICE6', 26);

-- --------------------------------------------------------

--
-- Structure de la table `service_intervenant`
--

CREATE TABLE `service_intervenant` (
  `ID_SERVICE` int(11) NOT NULL,
  `ID_INTERVENANT` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `sousaction`
--

CREATE TABLE `sousaction` (
  `code` int(11) NOT NULL,
  `libelleaction` varchar(254) DEFAULT NULL,
  `resumer` varchar(254) DEFAULT NULL,
  `etataction` varchar(254) DEFAULT NULL,
  `datedebut` date DEFAULT NULL,
  `datefin` date DEFAULT NULL,
  `actioncode` int(11) NOT NULL,
  `observations` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `sousetape`
--

CREATE TABLE `sousetape` (
  `ID` int(11) NOT NULL,
  `libelle` varchar(255) NOT NULL,
  `position` int(11) NOT NULL,
  `IDSERVICE` int(11) NOT NULL,
  `IDETAPE` int(11) NOT NULL,
  `IDINTERVENANT` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `statut_commande`
--

CREATE TABLE `statut_commande` (
  `ID` int(11) NOT NULL,
  `LIBELLE` varchar(255) NOT NULL DEFAULT 'En cours d''expédition'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `statut_commande`
--

INSERT INTO `statut_commande` (`ID`, `LIBELLE`) VALUES
(1, 'En cours dexpedition'),
(2, 'Commande'),
(3, 'En cours demballage'),
(4, 'Livre MPR'),
(5, 'Soucis financement');

-- --------------------------------------------------------

--
-- Structure de la table `uploads`
--

CREATE TABLE `uploads` (
  `ID` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `type` int(11) NOT NULL,
  `dossiercode` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `vehicules`
--

CREATE TABLE `vehicules` (
  `IDVEHICULE` int(11) NOT NULL,
  `IDMODELE` int(11) NOT NULL,
  `immatriculation` varchar(50) NOT NULL,
  `numchassis` varchar(100) NOT NULL,
  `kilometrage` int(11) NOT NULL,
  `nummoteur` varchar(30) NOT NULL,
  `numbc` varchar(30) NOT NULL,
  `dmc` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `vehicules`
--

INSERT INTO `vehicules` (`IDVEHICULE`, `IDMODELE`, `immatriculation`, `numchassis`, `kilometrage`, `nummoteur`, `numbc`, `dmc`) VALUES
(3, 1, 'TESTTESTMODIFXXX', 'CHASSIS', 10, 'MOT', 'TEST', 10),
(4, 4, 'IMMATRICULATION', 'TEST', 10, 'TEST', 'TEST', 10);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `actionintervenant`
--
ALTER TABLE `actionintervenant`
  ADD PRIMARY KEY (`actioncode`,`codeintervenant`),
  ADD KEY `FK_intervenants` (`codeintervenant`);

--
-- Index pour la table `actions`
--
ALTER TABLE `actions`
  ADD PRIMARY KEY (`actioncode`),
  ADD KEY `FK_actions` (`dossiercode`);

--
-- Index pour la table `circuit`
--
ALTER TABLE `circuit`
  ADD PRIMARY KEY (`ID`);

--
-- Index pour la table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`IDCLIENT`),
  ADD KEY `FK_RRRRRRRRRRR` (`type`);

--
-- Index pour la table `clientvehicule`
--
ALTER TABLE `clientvehicule`
  ADD PRIMARY KEY (`IDCLIENT`,`IDVEHICULE`);

--
-- Index pour la table `commande_dossier`
--
ALTER TABLE `commande_dossier`
  ADD PRIMARY KEY (`ID`);

--
-- Index pour la table `compte`
--
ALTER TABLE `compte`
  ADD PRIMARY KEY (`idcompte`),
  ADD KEY `FK_association6` (`codeintervenant`),
  ADD KEY `FK_association7` (`directioncode`);

--
-- Index pour la table `conditionetape`
--
ALTER TABLE `conditionetape`
  ADD PRIMARY KEY (`ID`);

--
-- Index pour la table `direction`
--
ALTER TABLE `direction`
  ADD PRIMARY KEY (`directioncode`),
  ADD KEY `FK_association1` (`filialecode`);

--
-- Index pour la table `dossier`
--
ALTER TABLE `dossier`
  ADD PRIMARY KEY (`dossiercode`),
  ADD KEY `FK_association3` (`directioncode`);

--
-- Index pour la table `dossierintervenant`
--
ALTER TABLE `dossierintervenant`
  ADD PRIMARY KEY (`dossiercode`,`codeintervenant`),
  ADD KEY `FK_association11` (`codeintervenant`);

--
-- Index pour la table `etape`
--
ALTER TABLE `etape`
  ADD PRIMARY KEY (`ID`);

--
-- Index pour la table `etat`
--
ALTER TABLE `etat`
  ADD PRIMARY KEY (`ID`);

--
-- Index pour la table `filiale`
--
ALTER TABLE `filiale`
  ADD PRIMARY KEY (`filialecode`);

--
-- Index pour la table `intervenant`
--
ALTER TABLE `intervenant`
  ADD PRIMARY KEY (`codeintervenant`);

--
-- Index pour la table `localisation`
--
ALTER TABLE `localisation`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `marques`
--
ALTER TABLE `marques`
  ADD PRIMARY KEY (`IDMARQUE`);

--
-- Index pour la table `modeles`
--
ALTER TABLE `modeles`
  ADD PRIMARY KEY (`IDMODELE`),
  ADD KEY `FK_CONTENIR2` (`IDMARQUE`);

--
-- Index pour la table `mode_expedition`
--
ALTER TABLE `mode_expedition`
  ADD PRIMARY KEY (`ID`);

--
-- Index pour la table `parcautomobiles`
--
ALTER TABLE `parcautomobiles`
  ADD PRIMARY KEY (`IDPARCS`);

--
-- Index pour la table `ressource`
--
ALTER TABLE `ressource`
  ADD PRIMARY KEY (`ressourcecode`),
  ADD KEY `FK_ressource` (`dossiercode`);

--
-- Index pour la table `service`
--
ALTER TABLE `service`
  ADD PRIMARY KEY (`ID`);

--
-- Index pour la table `sousaction`
--
ALTER TABLE `sousaction`
  ADD PRIMARY KEY (`code`),
  ADD KEY `FK_sousaction` (`actioncode`);

--
-- Index pour la table `sousetape`
--
ALTER TABLE `sousetape`
  ADD PRIMARY KEY (`ID`);

--
-- Index pour la table `statut_commande`
--
ALTER TABLE `statut_commande`
  ADD PRIMARY KEY (`ID`);

--
-- Index pour la table `uploads`
--
ALTER TABLE `uploads`
  ADD PRIMARY KEY (`ID`);

--
-- Index pour la table `vehicules`
--
ALTER TABLE `vehicules`
  ADD PRIMARY KEY (`IDVEHICULE`),
  ADD KEY `FK_APPARTENIR5` (`IDMODELE`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `actions`
--
ALTER TABLE `actions`
  MODIFY `actioncode` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT pour la table `circuit`
--
ALTER TABLE `circuit`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `clients`
--
ALTER TABLE `clients`
  MODIFY `IDCLIENT` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT pour la table `clientvehicule`
--
ALTER TABLE `clientvehicule`
  MODIFY `IDCLIENT` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT pour la table `commande_dossier`
--
ALTER TABLE `commande_dossier`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `compte`
--
ALTER TABLE `compte`
  MODIFY `idcompte` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `conditionetape`
--
ALTER TABLE `conditionetape`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `direction`
--
ALTER TABLE `direction`
  MODIFY `directioncode` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT pour la table `dossier`
--
ALTER TABLE `dossier`
  MODIFY `dossiercode` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT pour la table `etape`
--
ALTER TABLE `etape`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT pour la table `etat`
--
ALTER TABLE `etat`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `filiale`
--
ALTER TABLE `filiale`
  MODIFY `filialecode` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT pour la table `intervenant`
--
ALTER TABLE `intervenant`
  MODIFY `codeintervenant` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `localisation`
--
ALTER TABLE `localisation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT pour la table `marques`
--
ALTER TABLE `marques`
  MODIFY `IDMARQUE` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT pour la table `modeles`
--
ALTER TABLE `modeles`
  MODIFY `IDMODELE` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `mode_expedition`
--
ALTER TABLE `mode_expedition`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `parcautomobiles`
--
ALTER TABLE `parcautomobiles`
  MODIFY `IDPARCS` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `ressource`
--
ALTER TABLE `ressource`
  MODIFY `ressourcecode` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `service`
--
ALTER TABLE `service`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `sousaction`
--
ALTER TABLE `sousaction`
  MODIFY `code` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `sousetape`
--
ALTER TABLE `sousetape`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `statut_commande`
--
ALTER TABLE `statut_commande`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `uploads`
--
ALTER TABLE `uploads`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `vehicules`
--
ALTER TABLE `vehicules`
  MODIFY `IDVEHICULE` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `actions`
--
ALTER TABLE `actions`
  ADD CONSTRAINT `FK_actions` FOREIGN KEY (`dossiercode`) REFERENCES `dossier` (`dossiercode`) ON DELETE CASCADE;

--
-- Contraintes pour la table `compte`
--
ALTER TABLE `compte`
  ADD CONSTRAINT `FK_association6` FOREIGN KEY (`codeintervenant`) REFERENCES `intervenant` (`codeintervenant`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_association7` FOREIGN KEY (`directioncode`) REFERENCES `direction` (`directioncode`) ON DELETE CASCADE;

--
-- Contraintes pour la table `direction`
--
ALTER TABLE `direction`
  ADD CONSTRAINT `FK_association1` FOREIGN KEY (`filialecode`) REFERENCES `filiale` (`filialecode`) ON DELETE CASCADE;

--
-- Contraintes pour la table `dossier`
--
ALTER TABLE `dossier`
  ADD CONSTRAINT `FK_association3` FOREIGN KEY (`directioncode`) REFERENCES `direction` (`directioncode`);

--
-- Contraintes pour la table `dossierintervenant`
--
ALTER TABLE `dossierintervenant`
  ADD CONSTRAINT `FK_association10` FOREIGN KEY (`dossiercode`) REFERENCES `dossier` (`dossiercode`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_association11` FOREIGN KEY (`codeintervenant`) REFERENCES `intervenant` (`codeintervenant`) ON DELETE CASCADE;

--
-- Contraintes pour la table `ressource`
--
ALTER TABLE `ressource`
  ADD CONSTRAINT `FK_ressource` FOREIGN KEY (`dossiercode`) REFERENCES `dossier` (`dossiercode`) ON DELETE CASCADE;

--
-- Contraintes pour la table `sousaction`
--
ALTER TABLE `sousaction`
  ADD CONSTRAINT `FK_sousaction` FOREIGN KEY (`actioncode`) REFERENCES `actions` (`actioncode`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
