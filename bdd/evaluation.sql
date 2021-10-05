-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : lun. 04 oct. 2021 à 19:07
-- Version du serveur : 10.4.20-MariaDB
-- Version de PHP : 8.0.9

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
-- Structure de la table `coefs`
--

CREATE TABLE `coefs` (
  `id` int(11) NOT NULL,
  `libelle` varchar(255) NOT NULL,
  `coef` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `coefs`
--

INSERT INTO `coefs` (`id`, `libelle`, `coef`) VALUES
(1, 'Atteinte des objectifs', '8'),
(2, 'Réactivité et Sens de l\'organisation', '2'),
(3, 'Qualité de travail et Professionnalisme', '2'),
(4, 'Ponctualité et Assiduité', '1'),
(5, 'Discipline et Respect de la hiérarchie', '1'),
(6, 'Esprit d\'équipe et Attachement aux valeurs du Groupe', '2'),
(7, 'Motivation et Disponibilité', '2'),
(8, 'Respect des procédures', '2');

-- --------------------------------------------------------

--
-- Structure de la table `descriptionlangue`
--

CREATE TABLE `descriptionlangue` (
  `id` int(11) NOT NULL,
  `libelle` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `descriptionlangue`
--

INSERT INTO `descriptionlangue` (`id`, `libelle`) VALUES
(1, 'lire'),
(2, 'ecrire'),
(3, 'parler');

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
(1, 'BTS'),
(3, 'bac +2'),
(4, 'bac +3'),
(5, 'bac +4'),
(6, 'bac +5'),
(7, 'bac +6'),
(8, 'bac +7'),
(9, 'bac +8'),
(10, 'bac +9'),
(12, 'l1');

-- --------------------------------------------------------

--
-- Structure de la table `diplomsalarie`
--

CREATE TABLE `diplomsalarie` (
  `id` int(11) NOT NULL,
  `idSalarie` int(11) NOT NULL,
  `idDiplom` int(11) NOT NULL,
  `libelleLigne` varchar(255) NOT NULL,
  `ecole` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `diplomsalarie`
--

INSERT INTO `diplomsalarie` (`id`, `idSalarie`, `idDiplom`, `libelleLigne`, `ecole`) VALUES
(1, 29, 2, 'Qualité de travail et Professionnalisme', ' isi'),
(2, 29, 2, 'Qualité de travail et Professionnalisme', ' isi'),
(3, 30, 4, 'bac +6', ' isi'),
(4, 30, 4, 'bac +6', ' isib'),
(5, 30, 2, 'n,', ' kj'),
(6, 0, 1, 'bac +5', ' '),
(8, 8, 1, 'informatig', ' isi'),
(9, 8, 7, 'edhjbjeaehzz', ' isib'),
(12, 8, 1, 'directe', ' isi'),
(13, 11, 3, 'Qualité de travail et Professionnalisme', ' isi'),
(14, 11, 3, 'Qualité de travail et Professionnalisme', ' isi'),
(15, 11, 3, 'Qualité de travail et Professionnalisme', ' isi'),
(16, 6, 6, 'Qualité de travail et Professionnalisme', ' isi'),
(23, 11, 10, 'directe', ' SENEGAL JAPON'),
(40, 0, 1, 'test1', 'test1'),
(45, 0, 3, 'dtyzuyzditzdèyi', 'ty'),
(49, 0, 3, 'jk', ' l'),
(52, 6, 6, 'rtijogtoiitego', 'joni'),
(53, 6, 6, 'fdshfdisYGUIHU', ' SENEGAL JAPON');

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
-- Structure de la table `evaluer`
--

CREATE TABLE `evaluer` (
  `idEvaluer` int(11) NOT NULL,
  `idSalarie` int(11) NOT NULL,
  `idCoef` int(11) NOT NULL,
  `note` int(11) DEFAULT NULL,
  `noteE` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `evaluer`
--

INSERT INTO `evaluer` (`idEvaluer`, `idSalarie`, `idCoef`, `note`, `noteE`) VALUES
(6, 5, 1, 1, NULL),
(7, 5, 3, 2, NULL),
(9, 5, 7, 4, NULL),
(10, 6, 7, 1, '1'),
(11, 6, 6, 3, '2'),
(12, 6, 7, 5, '3'),
(13, 6, 8, 2, '4'),
(15, 8, 1, 2, NULL),
(16, 8, 3, 3, NULL),
(17, 8, 5, 4, NULL),
(18, 8, 6, 3, NULL),
(19, 8, 7, 3, NULL),
(22, 8, 4, 0, NULL);

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
(1, 'CCBMAUTO', 'CCBM AUTOMOBILE', '', '', ''),
(2, 'HT', 'HIGHT TECH', 'hjfezopiguifHV', 'LOUGA', '6877'),
(3, 'CV', 'CCBM VOYAGE', 'hv', 'UHHOJO', 'IJO'),
(4, 'AT', 'AFRICA TRANSIT', 'yguhi', 'yiu', 'uoij'),
(5, 'CI', 'CCBM INDUSTRUIE', 'yiuiu', 'uhjoij', 'dd');

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
  `profil` int(11) NOT NULL,
  `idSalarie` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `intervenant`
--

INSERT INTO `intervenant` (`codeintervenant`, `nom`, `prenom`, `poste`, `email`, `utilisateur`, `pwd`, `filialecode`, `profil`, `idSalarie`) VALUES
(1, 'CISSOKHO', 'AIDA', 'RESPONSABLE SR', 'aida.cissokho@ccbm.sn', 'aida', '2991a6ba1f1420168809c49ed39dba8b', 2, 1, 15),
(10, 'Service', 'Customer', '', 'sav@ccbm.sn', 'customer', '91ec1f9324753048c0096d036a694f86', 2, 2, 8),
(12, 'Magasin', 'Service', '', 'sav@ccbm.sn', 'magasin', '2f45fc781cd1f28ee732d78b1d1d3b72', 2, 2, 11),
(13, 'Achat', 'Service', '', 'sav@ccbm.sn', 'achat', 'b82d04823d936ca1edb92994b8cabeff', 2, 2, 13),
(14, 'Service', 'Qualite', '', 'sav@ccbm.sn', 'qualite', 'c64e5ff6a2f316310b8d607420a96db6', 2, 2, 11),
(15, 'Atelier ASIAN', 'Service', '', 'sav@ccbm.sn', 'atelier asian', 'bc3596198e49c49eccd7abe633c19c48', 2, 2, 14),
(16, 'DIENG', 'Modou', 'DT', 'modoudieng@ccbm.sn', 'dt', '3017d911efceb27d1de6a92b70979795', 2, 2, 7),
(17, 'kandji', 'Mouhamed', 'informatique', 'mouhamed@gmail.com', 'kandji', '827ccb0eea8a706c4c34a16891f84e7b', 2, 3, 3),
(26, 'diop', 'baye dame', 'informatique', 'bayedame1823@gmail.com', 'diopkoki', '827ccb0eea8a706c4c34a16891f84e7b', 2, 3, 1),
(28, NULL, NULL, '', NULL, '', '', 0, 0, 4);

-- --------------------------------------------------------

--
-- Structure de la table `langue`
--

CREATE TABLE `langue` (
  `idLangue` int(11) NOT NULL,
  `libelle` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `langue`
--

INSERT INTO `langue` (`idLangue`, `libelle`) VALUES
(1, 'anglais'),
(3, 'francais'),
(4, 'arabe'),
(5, 'tes');

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

--
-- Déchargement des données de la table `languesalarie`
--

INSERT INTO `languesalarie` (`idLS`, `idLangue`, `idSalarie`, `description`) VALUES
(1, 3, 8, 'lire'),
(4, 4, 8, 'parler,ecrire'),
(5, 3, 7, 'parler,ecrire'),
(6, 4, 6, 'parler,ecrire');

-- --------------------------------------------------------

--
-- Structure de la table `objectifs`
--

CREATE TABLE `objectifs` (
  `id` int(11) NOT NULL,
  `idSalarie` int(11) NOT NULL,
  `libelle` varchar(255) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `objectifs`
--

INSERT INTO `objectifs` (`id`, `idSalarie`, `libelle`, `date`) VALUES
(2, 4, 'gvhhjvjg', '2021-09-02'),
(3, 1, 'n', '2021-09-13'),
(4, 6, 'bac +5', '2021-09-09'),
(5, 8, 'developper une application de gestion', '2021-09-20'),
(6, 8, 'developper une application de pointage', '2021-09-20'),
(7, 8, 'aaa', '2021-09-13'),
(8, 8, 'bac +2', '2021-09-06'),
(9, 8, 'asaad', '2021-09-24'),
(11, 8, 'TEST3', '2020-09-01'),
(12, 8, 'TEST1', '2020-09-02'),
(13, 8, 'TEST2', '2020-09-02'),
(14, 8, 'Qualité de travail et Professionnalisme', '2021-09-30'),
(15, 8, 'direct', '2021-09-30'),
(16, 6, 'objective 1', '2021-10-04'),
(17, 6, 'Qualité de travail et Professionnalisme', '2021-10-04'),
(19, 6, 'dhbvjjbkd', '2021-10-04');

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
(2, 'financier'),
(4, 'customer');

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
  `telephone` varchar(255) NOT NULL,
  `carburant` varchar(255) NOT NULL,
  `commussion` varchar(255) NOT NULL,
  `vehicule` varchar(255) NOT NULL,
  `autres` varchar(100) DEFAULT NULL,
  `idDiplom` int(11) DEFAULT NULL,
  `idPO` int(11) DEFAULT NULL,
  `idParentel` int(11) DEFAULT NULL,
  `idRecrutement` int(11) DEFAULT NULL,
  `idservice` int(11) DEFAULT NULL,
  `contrat` varchar(50) NOT NULL,
  `pwd` varchar(255) NOT NULL,
  `profil` varchar(10) NOT NULL,
  `montant` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `salarie`
--

INSERT INTO `salarie` (`idSalarie`, `prenom`, `nom`, `fonctionActuelle`, `ancieneteFonc`, `situationFam`, `dateNaiss`, `telephone`, `carburant`, `commussion`, `vehicule`, `autres`, `idDiplom`, `idPO`, `idParentel`, `idRecrutement`, `idservice`, `contrat`, `pwd`, `profil`, `montant`) VALUES
(1, 'aida', 'sissakho', 'info', '9', 'marie', '1985-09-16', '1', '1', '1', '0', 'A', NULL, NULL, 2, 5, 3, 'cdi', '2991a6ba1f1420168809c49ed39dba8b', '1', ''),
(4, 'diopkoki ', 'diop', 'info', '1', 'marie', '2021-09-17', '1', '1', '1', '0', 'A', NULL, 2, 1, 5, 1, 'cdd', '37af1914a777f6161166795396225177', '2', '1000000'),
(5, ' jeanpull ', 'jean', 'customer', '1', 'marie', '1994-09-18', '1', '0', '1', '0', '1', NULL, 2, 1, 4, 1, 'cdd', 'b71985397688d6f1820685dde534981b', '3', '50000'),
(6, ' marieme', 'seck', 'customer', '2', 'calibataire', '2021-09-09', '1', '1', '1', '0', 'a', NULL, NULL, 1, 4, 1, 'cdd', '81964cbcbb07bee4e8e07787e1f66c36', '3', ''),
(7, ' madame', 'ndire', 'cheff service', '3', 'calibataire', '2021-09-24', '1', '1', '1', '0', '2', NULL, NULL, 2, 6, 1, 'cdi', 'f69fa9677923cf86f8b9eadf1602f793', '2', ''),
(8, ' lamine', 'fall', 'contable', '2 ans', 'calibataire', '1999-09-20', '1', '1', '0', '0', 'A', NULL, NULL, 2, 4, 4, 'cdd', '96f223040672ea79c655dceda08e0830', '3', ''),
(10, ' chef filiale', 'filiale', ' chef filiale', '10', 'marie', '1993-06-01', 'samdung', '10 litre par mois', '10000', '', 'A', NULL, NULL, 1, 4, 3, 'cdd', 'cbb4581ba3ada1ddef9b431eef2660ce', '4', '1000000'),
(11, ' HIGHT TECH', 'ht', 'ht', '12', 'marie', '2021-09-28', '7863829', '10 litre par mois', '10000', '', 'si', NULL, NULL, 1, 6, 4, 'cdd', 'eb5e48e74123cacc52761302ea4a7d22', '4', '1223333');

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
  `idFiliale` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `service`
--

INSERT INTO `service` (`ID`, `NOM_SERVICE`, `idFiliale`) VALUES
(1, 'Customer Service', 1),
(2, 'Atelier VW', 1),
(3, 'Magasin', 1),
(4, 'Achat', 2),
(5, 'Service Qualite', 1),
(6, 'Atelier ASIAN', 1),
(7, 'Voage', 3);

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
-- Index pour la table `coefs`
--
ALTER TABLE `coefs`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `descriptionlangue`
--
ALTER TABLE `descriptionlangue`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `diplom`
--
ALTER TABLE `diplom`
  ADD PRIMARY KEY (`idDiplom`);

--
-- Index pour la table `diplomsalarie`
--
ALTER TABLE `diplomsalarie`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idSalarie` (`idSalarie`),
  ADD KEY `idDiplom` (`idDiplom`);

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
-- Index pour la table `evaluer`
--
ALTER TABLE `evaluer`
  ADD PRIMARY KEY (`idEvaluer`),
  ADD KEY `idCoe` (`idCoef`),
  ADD KEY `idSalarie` (`idSalarie`);

--
-- Index pour la table `filiale`
--
ALTER TABLE `filiale`
  ADD PRIMARY KEY (`filialecode`);

--
-- Index pour la table `intervenant`
--
ALTER TABLE `intervenant`
  ADD PRIMARY KEY (`codeintervenant`),
  ADD KEY `idSalarie` (`idSalarie`);

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
-- Index pour la table `objectifs`
--
ALTER TABLE `objectifs`
  ADD PRIMARY KEY (`id`),
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
  ADD KEY `ID` (`idservice`);

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
  ADD KEY `directioncode` (`idFiliale`);

--
-- Index pour la table `stageseminaire`
--
ALTER TABLE `stageseminaire`
  ADD PRIMARY KEY (`idss`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `coefs`
--
ALTER TABLE `coefs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `descriptionlangue`
--
ALTER TABLE `descriptionlangue`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `diplom`
--
ALTER TABLE `diplom`
  MODIFY `idDiplom` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT pour la table `diplomsalarie`
--
ALTER TABLE `diplomsalarie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT pour la table `direction`
--
ALTER TABLE `direction`
  MODIFY `directioncode` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `evaluer`
--
ALTER TABLE `evaluer`
  MODIFY `idEvaluer` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT pour la table `filiale`
--
ALTER TABLE `filiale`
  MODIFY `filialecode` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `intervenant`
--
ALTER TABLE `intervenant`
  MODIFY `codeintervenant` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT pour la table `langue`
--
ALTER TABLE `langue`
  MODIFY `idLangue` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `languesalarie`
--
ALTER TABLE `languesalarie`
  MODIFY `idLS` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `objectifs`
--
ALTER TABLE `objectifs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT pour la table `parentel`
--
ALTER TABLE `parentel`
  MODIFY `idParentel` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `posteocupee`
--
ALTER TABLE `posteocupee`
  MODIFY `idPO` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `recrutement`
--
ALTER TABLE `recrutement`
  MODIFY `idRecrutement` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `salarie`
--
ALTER TABLE `salarie`
  MODIFY `idSalarie` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT pour la table `salariestageseminaire`
--
ALTER TABLE `salariestageseminaire`
  MODIFY `idSSS` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `service`
--
ALTER TABLE `service`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

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
-- Contraintes pour la table `evaluer`
--
ALTER TABLE `evaluer`
  ADD CONSTRAINT `evaluer_ibfk_6` FOREIGN KEY (`idCoef`) REFERENCES `coefs` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `evaluer_ibfk_7` FOREIGN KEY (`idSalarie`) REFERENCES `salarie` (`idSalarie`) ON DELETE CASCADE;

--
-- Contraintes pour la table `intervenant`
--
ALTER TABLE `intervenant`
  ADD CONSTRAINT `intervenant_ibfk_1` FOREIGN KEY (`idSalarie`) REFERENCES `salarie` (`idSalarie`) ON DELETE CASCADE;

--
-- Contraintes pour la table `languesalarie`
--
ALTER TABLE `languesalarie`
  ADD CONSTRAINT `languesalarie_ibfk_1` FOREIGN KEY (`idSalarie`) REFERENCES `salarie` (`idSalarie`) ON DELETE CASCADE,
  ADD CONSTRAINT `languesalarie_ibfk_2` FOREIGN KEY (`idLangue`) REFERENCES `langue` (`idLangue`) ON DELETE CASCADE;

--
-- Contraintes pour la table `objectifs`
--
ALTER TABLE `objectifs`
  ADD CONSTRAINT `objectifs_ibfk_1` FOREIGN KEY (`idSalarie`) REFERENCES `salarie` (`idSalarie`) ON DELETE CASCADE;

--
-- Contraintes pour la table `salarie`
--
ALTER TABLE `salarie`
  ADD CONSTRAINT `salarie_ibfk_1` FOREIGN KEY (`idservice`) REFERENCES `service` (`ID`) ON DELETE CASCADE;

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
  ADD CONSTRAINT `service_ibfk_1` FOREIGN KEY (`idFiliale`) REFERENCES `filiale` (`filialecode`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
