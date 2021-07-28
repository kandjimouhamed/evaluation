-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mer. 28 juil. 2021 à 16:23
-- Version du serveur :  10.4.17-MariaDB
-- Version de PHP : 8.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `evaluation`
--

-- --------------------------------------------------------

--
-- Structure de la table `diplom`
--

CREATE TABLE `diplom` (
  `idDiplom` int(11) NOT NULL,
  `libelle` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `diplom`
--

INSERT INTO `diplom` (`idDiplom`, `libelle`) VALUES
(1, 'BTS');

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
(1, 'SAV', 'sav@ccbm.sn', 2),
(2, 'test', 'test@gmail.com', 2);

-- --------------------------------------------------------

--
-- Structure de la table `entretient`
--

CREATE TABLE `entretient` (
  `idEntretient` int(11) NOT NULL,
  `libelle` varchar(300) NOT NULL,
  `idSalarie` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
(2, 'CCBMAUTO', 'CCBM AUTOMOBILE', '', '', '');

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
(1, 'CISSOKHO', 'AIDA', 'RESPONSABLE SR', 'aida.cissokho@ccbm.sn', 'aida', '2991a6ba1f1420168809c49ed39dba8b', 2, 1),
(10, 'Service', 'Customer', '', 'sav@ccbm.sn', 'customer', '91ec1f9324753048c0096d036a694f86', 2, 2),
(11, 'Atelier VW', 'Service', '', 'sav@ccbm.sn', 'atelier vw', 'bc3596198e49c49eccd7abe633c19c48', 2, 2),
(12, 'Magasin', 'Service', '', 'sav@ccbm.sn', 'magasin', '2f45fc781cd1f28ee732d78b1d1d3b72', 2, 2),
(13, 'Achat', 'Service', '', 'sav@ccbm.sn', 'achat', 'b82d04823d936ca1edb92994b8cabeff', 2, 2),
(14, 'Service', 'Qualite', '', 'sav@ccbm.sn', 'qualite', 'c64e5ff6a2f316310b8d607420a96db6', 2, 2),
(15, 'Atelier ASIAN', 'Service', '', 'sav@ccbm.sn', 'atelier asian', 'bc3596198e49c49eccd7abe633c19c48', 2, 2),
(16, 'DIENG', 'Modou', 'DT', 'modoudieng@ccbm.sn', 'dt', '3017d911efceb27d1de6a92b70979795', 2, 2);

-- --------------------------------------------------------

--
-- Structure de la table `langue`
--

CREATE TABLE `langue` (
  `idLangue` int(11) NOT NULL,
  `libelle` varchar(50) NOT NULL,
  `description` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `langue`
--

INSERT INTO `langue` (`idLangue`, `libelle`, `description`) VALUES
(1, 'francais', 'lire,ecrire,parler'),
(3, 'wolof', 'parler'),
(4, 'almend', 'lire');

-- --------------------------------------------------------

--
-- Structure de la table `languesalarie`
--

CREATE TABLE `languesalarie` (
  `idLS` int(11) NOT NULL,
  `idLangue` int(11) NOT NULL,
  `idSalarie` int(11) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `parentel`
--

CREATE TABLE `parentel` (
  `idParentel` int(11) NOT NULL,
  `libelle` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `parentel`
--

INSERT INTO `parentel` (`idParentel`, `libelle`) VALUES
(1, 'pere'),
(2, 'mere');

-- --------------------------------------------------------

--
-- Structure de la table `posteocupee`
--

CREATE TABLE `posteocupee` (
  `idPO` int(11) NOT NULL,
  `libelle` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `posteocupee`
--

INSERT INTO `posteocupee` (`idPO`, `libelle`) VALUES
(1, 'informaticienne'),
(2, 'financier');

-- --------------------------------------------------------

--
-- Structure de la table `recrutement`
--

CREATE TABLE `recrutement` (
  `idRecrutement` int(11) NOT NULL,
  `libelle` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `recrutement`
--

INSERT INTO `recrutement` (`idRecrutement`, `libelle`) VALUES
(4, 'Recommandation'),
(5, 'Recrutement direct'),
(6, 'Debouchange'),
(7, 'Autre');

-- --------------------------------------------------------

--
-- Structure de la table `salarie`
--

CREATE TABLE `salarie` (
  `idSalarie` int(11) NOT NULL,
  `prenom` varchar(100) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `fonctionActuelle` varchar(100) NOT NULL,
  `ancieneteFonc` varchar(100) NOT NULL,
  `situationFam` varchar(100) NOT NULL,
  `dateNaiss` date NOT NULL,
  `telephone` tinyint(1) NOT NULL,
  `carburant` tinyint(1) NOT NULL,
  `commussion` tinyint(1) NOT NULL,
  `vehicule` tinyint(1) NOT NULL,
  `autres` varchar(100) NOT NULL,
  `idDiplom` int(11) NOT NULL,
  `idPO` int(11) NOT NULL,
  `idParentel` int(11) NOT NULL,
  `idRecrutement` int(11) NOT NULL,
  `idservice` int(11) NOT NULL,
  `idlangue` int(11) NOT NULL,
  `contrat` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `salarie`
--

INSERT INTO `salarie` (`idSalarie`, `prenom`, `nom`, `fonctionActuelle`, `ancieneteFonc`, `situationFam`, `dateNaiss`, `telephone`, `carburant`, `commussion`, `vehicule`, `autres`, `idDiplom`, `idPO`, `idParentel`, `idRecrutement`, `idservice`, `idlangue`, `contrat`) VALUES
(1, 'fallou ', 'diop ', 'hhhh', '4ans', 'marie', '2021-07-28', 1, 1, 1, 0, '8', 1, 1, 1, 4, 5, 3, 'cdd'),
(2, 'baye dame     ', 'diop ', 'informatique', '3ans', 'marie', '2021-07-07', 1, 1, 1, 0, 'non', 1, 1, 2, 4, 3, 1, 'cdd'),
(3, 'mouhamed', 'kandji', 'inforaticien', '1an', 'selibataire', '1994-11-17', 0, 0, 0, 0, 'moto', 1, 2, 2, 3, 4, 4, ''),
(4, ' alioune badara', 'diagne', 'inforaticien', '9mois', 'marie', '2021-07-02', 1, 0, 0, 0, 'non', 1, 1, 2, 3, 3, 1, 'cdd'),
(5, ' hhhh', 'hhhh', 'inforaticien', '9mois', 'marie', '2021-07-28', 1, 1, 1, 0, 'nnn', 1, 1, 1, 4, 1, 3, 'cdd');

-- --------------------------------------------------------

--
-- Structure de la table `salariestageseminaire`
--

CREATE TABLE `salariestageseminaire` (
  `idSSS` int(11) NOT NULL,
  `date` date NOT NULL,
  `idSalarie` int(11) NOT NULL,
  `idss` int(11) NOT NULL
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
(1, 'Customer Service', 1),
(2, 'Atelier VW', 1),
(3, 'Magasin', 1),
(4, 'Achat', 2),
(5, 'Service Qualite', 1),
(6, 'Atelier ASIAN', 1);

-- --------------------------------------------------------

--
-- Structure de la table `stageseminaire`
--

CREATE TABLE `stageseminaire` (
  `idss` int(11) NOT NULL,
  `libelle` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `diplom`
--
ALTER TABLE `diplom`
  ADD PRIMARY KEY (`idDiplom`);

--
-- Index pour la table `direction`
--
ALTER TABLE `direction`
  ADD PRIMARY KEY (`directioncode`),
  ADD KEY `filialecode` (`filialecode`);

--
-- Index pour la table `entretient`
--
ALTER TABLE `entretient`
  ADD PRIMARY KEY (`idEntretient`),
  ADD KEY `idSalarie` (`idSalarie`);

--
-- Index pour la table `filiale`
--
ALTER TABLE `filiale`
  ADD PRIMARY KEY (`filialecode`);

--
-- Index pour la table `langue`
--
ALTER TABLE `langue`
  ADD PRIMARY KEY (`idLangue`);

--
-- Index pour la table `languesalarie`
--
ALTER TABLE `languesalarie`
  ADD PRIMARY KEY (`idLS`),
  ADD UNIQUE KEY `idLS` (`idLS`,`idLangue`),
  ADD UNIQUE KEY `idLS_2` (`idLS`,`idLangue`),
  ADD KEY `idLangue` (`idLangue`),
  ADD KEY `idSalarie` (`idSalarie`);

--
-- Index pour la table `parentel`
--
ALTER TABLE `parentel`
  ADD PRIMARY KEY (`idParentel`);

--
-- Index pour la table `posteocupee`
--
ALTER TABLE `posteocupee`
  ADD PRIMARY KEY (`idPO`);

--
-- Index pour la table `recrutement`
--
ALTER TABLE `recrutement`
  ADD PRIMARY KEY (`idRecrutement`);

--
-- Index pour la table `salarie`
--
ALTER TABLE `salarie`
  ADD PRIMARY KEY (`idSalarie`),
  ADD KEY `idDiplom` (`idDiplom`),
  ADD KEY `idPO` (`idPO`),
  ADD KEY `idParentel` (`idParentel`),
  ADD KEY `idRecrutement` (`idRecrutement`),
  ADD KEY `ID` (`idservice`),
  ADD KEY `idlangue` (`idlangue`);

--
-- Index pour la table `salariestageseminaire`
--
ALTER TABLE `salariestageseminaire`
  ADD PRIMARY KEY (`idSSS`),
  ADD KEY `idSalarie` (`idSalarie`),
  ADD KEY `idss` (`idss`);

--
-- Index pour la table `service`
--
ALTER TABLE `service`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `directioncode` (`directioncode`);

--
-- Index pour la table `stageseminaire`
--
ALTER TABLE `stageseminaire`
  ADD PRIMARY KEY (`idss`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `diplom`
--
ALTER TABLE `diplom`
  MODIFY `idDiplom` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `direction`
--
ALTER TABLE `direction`
  MODIFY `directioncode` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `filiale`
--
ALTER TABLE `filiale`
  MODIFY `filialecode` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `langue`
--
ALTER TABLE `langue`
  MODIFY `idLangue` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `languesalarie`
--
ALTER TABLE `languesalarie`
  MODIFY `idLS` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `parentel`
--
ALTER TABLE `parentel`
  MODIFY `idParentel` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `posteocupee`
--
ALTER TABLE `posteocupee`
  MODIFY `idPO` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `recrutement`
--
ALTER TABLE `recrutement`
  MODIFY `idRecrutement` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `salarie`
--
ALTER TABLE `salarie`
  MODIFY `idSalarie` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `salariestageseminaire`
--
ALTER TABLE `salariestageseminaire`
  MODIFY `idSSS` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `service`
--
ALTER TABLE `service`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `stageseminaire`
--
ALTER TABLE `stageseminaire`
  MODIFY `idss` int(11) NOT NULL AUTO_INCREMENT;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `entretient`
--
ALTER TABLE `entretient`
  ADD CONSTRAINT `entretient_ibfk_1` FOREIGN KEY (`idSalarie`) REFERENCES `salarie` (`idSalarie`) ON DELETE CASCADE;

--
-- Contraintes pour la table `languesalarie`
--
ALTER TABLE `languesalarie`
  ADD CONSTRAINT `languesalarie_ibfk_1` FOREIGN KEY (`idSalarie`) REFERENCES `salarie` (`idSalarie`) ON DELETE CASCADE,
  ADD CONSTRAINT `languesalarie_ibfk_2` FOREIGN KEY (`idLangue`) REFERENCES `langue` (`idLangue`) ON DELETE CASCADE;

--
-- Contraintes pour la table `salarie`
--
ALTER TABLE `salarie`
  ADD CONSTRAINT `idDiplom` FOREIGN KEY (`idDiplom`) REFERENCES `diplom` (`idDiplom`) ON DELETE CASCADE,
  ADD CONSTRAINT `salarie_ibfk_1` FOREIGN KEY (`idPO`) REFERENCES `posteocupee` (`idPO`) ON DELETE CASCADE,
  ADD CONSTRAINT `salarie_ibfk_2` FOREIGN KEY (`idParentel`) REFERENCES `parentel` (`idParentel`) ON DELETE CASCADE,
  ADD CONSTRAINT `salarie_ibfk_3` FOREIGN KEY (`idRecrutement`) REFERENCES `recrutement` (`idRecrutement`) ON DELETE CASCADE,
  ADD CONSTRAINT `salarie_ibfk_4` FOREIGN KEY (`idservice`) REFERENCES `service` (`ID`),
  ADD CONSTRAINT `salarie_ibfk_5` FOREIGN KEY (`idlangue`) REFERENCES `langue` (`idLangue`) ON DELETE CASCADE;

--
-- Contraintes pour la table `salariestageseminaire`
--
ALTER TABLE `salariestageseminaire`
  ADD CONSTRAINT `salariestageseminaire_ibfk_1` FOREIGN KEY (`idSalarie`) REFERENCES `salarie` (`idSalarie`) ON DELETE CASCADE,
  ADD CONSTRAINT `salariestageseminaire_ibfk_2` FOREIGN KEY (`idss`) REFERENCES `stageseminaire` (`idss`) ON DELETE CASCADE;

--
-- Contraintes pour la table `service`
--
ALTER TABLE `service`
  ADD CONSTRAINT `service_ibfk_1` FOREIGN KEY (`directioncode`) REFERENCES `direction` (`directioncode`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
