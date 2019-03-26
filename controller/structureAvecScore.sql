-- phpMyAdmin SQL Dump
-- version 4.6.6deb4
-- https://www.phpmyadmin.net/
--
-- Client :  localhost:3306
-- Généré le :  Mar 26 Mars 2019 à 11:35
-- Version du serveur :  10.1.26-MariaDB-0+deb9u1
-- Version de PHP :  7.0.33-0+deb9u3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `alejandra_acevedo`
--

-- --------------------------------------------------------

--
-- Structure de la table `AJOUTER`
--

CREATE TABLE `AJOUTER` (
  `IDQ` bigint(20) NOT NULL,
  `ID_QUEST` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Contenu de la table `AJOUTER`
--

INSERT INTO `AJOUTER` (`IDQ`, `ID_QUEST`) VALUES
(1, 5),
(2, 1),
(2, 2),
(3, 3),
(4, 6),
(5, 4),
(7, 7),
(7, 8);

-- --------------------------------------------------------

--
-- Structure de la table `APPARIER`
--

CREATE TABLE `APPARIER` (
  `REP_ID_REPONSE` bigint(20) NOT NULL,
  `ID_REPONSE` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `APPARTENIR`
--

CREATE TABLE `APPARTENIR` (
  `IDRC` bigint(20) NOT NULL,
  `ID_REPONSE` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Contenu de la table `APPARTENIR`
--

INSERT INTO `APPARTENIR` (`IDRC`, `ID_REPONSE`) VALUES
(1, 2),
(2, 3),
(3, 6),
(4, 8),
(5, 10);

-- --------------------------------------------------------

--
-- Structure de la table `PARTICIPER`
--

CREATE TABLE `PARTICIPER` (
  `ID` bigint(20) NOT NULL,
  `IDQ` bigint(20) NOT NULL,
  `DATE_PARTICIPATION` date NOT NULL,
  `CLASSEMENT` int(11) NOT NULL,
  `SCORE` int(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Contenu de la table `PARTICIPER`
--

INSERT INTO `PARTICIPER` (`ID`, `IDQ`, `DATE_PARTICIPATION`, `CLASSEMENT`, `SCORE`) VALUES
(1, 1, '1903-01-01', 1, NULL),
(1, 5, '2019-01-30', 1, NULL),
(2, 2, '2019-04-01', 1, NULL),
(3, 3, '2019-02-15', 1, NULL),
(4, 4, '2019-04-01', 1, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `QUESTION`
--

CREATE TABLE `QUESTION` (
  `INTITULE` varchar(200) NOT NULL,
  `ID_QUEST` bigint(20) NOT NULL,
  `TYPEQ` varchar(20) NOT NULL,
  `TEMPS_MAXIMAL` smallint(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Contenu de la table `QUESTION`
--

INSERT INTO `QUESTION` (`INTITULE`, `ID_QUEST`, `TYPEQ`, `TEMPS_MAXIMAL`) VALUES
('Le HTML est un langage de...', 1, 'QCU', 20),
('Qu\'est-ce qui est vrai sur le PHP ?', 2, 'QCM', 30),
('IHM signifie Interface Homme...', 3, 'QRL', 30),
('Pharo est une implémentation du langage ?', 4, 'QRL', NULL),
('La réponse à la grande question est...', 5, 'QCU', NULL),
('Vérités sur le SQL ?', 6, 'QCM', 60),
('Qu\'est-ce qu\'un pointeur', 7, 'QCM', 120),
('En programmation en langage C, quel signe utilise-t-on pour le test d\'égalité ?', 8, 'QCM', 20);

-- --------------------------------------------------------

--
-- Structure de la table `QUESTIONNAIRE`
--

CREATE TABLE `QUESTIONNAIRE` (
  `IDQ` bigint(20) NOT NULL,
  `ID` bigint(20) NOT NULL,
  `TITRE` varchar(200) NOT NULL,
  `ID_REGLES_QUEST` bigint(20) NOT NULL,
  `DESCRIPTION` char(255) DEFAULT NULL,
  `ETAT` char(255) NOT NULL,
  `DATE_OUVERTURE` date NOT NULL,
  `DATE_FERMETURE` date NOT NULL,
  `MODE_ACCES` char(200) DEFAULT NULL,
  `LIEN_HTTP` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Contenu de la table `QUESTIONNAIRE`
--

INSERT INTO `QUESTIONNAIRE` (`IDQ`, `ID`, `TITRE`, `ID_REGLES_QUEST`, `DESCRIPTION`, `ETAT`, `DATE_OUVERTURE`, `DATE_FERMETURE`, `MODE_ACCES`, `LIEN_HTTP`) VALUES
(1, 8, 'Questionnaire numéro 42 sur la vie', 5, 'Redécouvrez toute la profondeur de 42', 'Fermé', '1902-09-04', '1903-09-04', 'Public', 'Lien1'),
(2, 6, 'Un peu de Web', 4, 'Apprenons à faire du web', 'Ouvert', '2019-03-04', '2019-05-19', 'Connecté', 'Lien2'),
(3, 7, 'IHM', 3, 'Interfacer l\'homme et la machine', 'Fermé', '2019-02-01', '2019-03-01', 'Lien', 'Lien3'),
(4, 5, 'Vive la SGBD', 2, NULL, 'Ouvert', '2019-02-28', '2019-05-30', 'Connecté', 'Lien4'),
(5, 6, 'Pharo c\'est la vie', 1, NULL, 'Fermé', '2019-01-28', '2019-01-31', 'Public', 'Lien5'),
(7, 6, 'langage C', 5, 'Ici on testera vos connaissances sur ce langage', 'OUVERT', '2019-04-10', '2019-04-20', 'Public', 'lien6');

-- --------------------------------------------------------

--
-- Structure de la table `REGLES_GENERATION`
--

CREATE TABLE `REGLES_GENERATION` (
  `REGLE` varchar(200) NOT NULL,
  `ID_REGLE` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Contenu de la table `REGLES_GENERATION`
--

INSERT INTO `REGLES_GENERATION` (`REGLE`, `ID_REGLE`) VALUES
('Regle1', 1),
('Regle2', 2),
('Regle3', 3),
('Regle4', 4),
('Regle5', 5);

-- --------------------------------------------------------

--
-- Structure de la table `REGLES_QUESTIONNAIRE`
--

CREATE TABLE `REGLES_QUESTIONNAIRE` (
  `TEMPS_TOTALE` smallint(6) DEFAULT NULL,
  `REVENIR_ARRIERE` tinyint(1) NOT NULL,
  `ID_REGLES_QUEST` bigint(20) NOT NULL,
  `PLUS` int(11) NOT NULL,
  `MOINS` int(11) DEFAULT NULL,
  `NEUTRE` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Contenu de la table `REGLES_QUESTIONNAIRE`
--

INSERT INTO `REGLES_QUESTIONNAIRE` (`TEMPS_TOTALE`, `REVENIR_ARRIERE`, `ID_REGLES_QUEST`, `PLUS`, `MOINS`, `NEUTRE`) VALUES
(NULL, 0, 1, 1, NULL, NULL),
(600, 0, 2, 3, 1, NULL),
(300, 1, 3, 2, 1, NULL),
(NULL, 1, 4, 1, 2, NULL),
(100, 1, 5, 5, 3, 1);

-- --------------------------------------------------------

--
-- Structure de la table `REPONSES_POSSIBLES`
--

CREATE TABLE `REPONSES_POSSIBLES` (
  `ID_REPONSE` bigint(20) NOT NULL,
  `ID_QUEST` bigint(20) NOT NULL,
  `ENONCE` varchar(200) NOT NULL,
  `CORRECT` tinyint(1) NOT NULL,
  `COLONNE1OU2` smallint(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Contenu de la table `REPONSES_POSSIBLES`
--

INSERT INTO `REPONSES_POSSIBLES` (`ID_REPONSE`, `ID_QUEST`, `ENONCE`, `CORRECT`, `COLONNE1OU2`) VALUES
(1, 1, 'Programmation', 0, NULL),
(2, 1, 'Description', 1, NULL),
(3, 2, 'Langage Objet', 1, NULL),
(4, 2, 'Pet à Haut Potentiel', 0, NULL),
(5, 2, 'Côté serveur', 1, NULL),
(6, 3, 'Machine', 1, NULL),
(7, 5, '42', 1, NULL),
(8, 4, 'Smalltalk', 1, NULL),
(9, 5, 'Nord Nord Ouest', 0, NULL),
(10, 6, 'C\'est trop dur', 1, NULL),
(11, 7, 'une variable qui stocke une adresse', 1, NULL),
(12, 7, 'une variable qui contient l\'adresse mémoire d\'une autre variable', 0, NULL),
(13, 8, '=', 1, NULL),
(14, 8, ':=', 0, NULL),
(15, 8, '==', 0, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `REPONSE_CHOISIE`
--

CREATE TABLE `REPONSE_CHOISIE` (
  `ID_QUEST` bigint(20) NOT NULL,
  `IDRC` bigint(20) NOT NULL,
  `ID` bigint(20) NOT NULL,
  `OKPASOK` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Contenu de la table `REPONSE_CHOISIE`
--

INSERT INTO `REPONSE_CHOISIE` (`ID_QUEST`, `IDRC`, `ID`, `OKPASOK`) VALUES
(1, 1, 2, 1),
(2, 2, 2, 1),
(3, 3, 3, 1),
(4, 4, 1, 1),
(6, 5, 4, 0);

-- --------------------------------------------------------

--
-- Structure de la table `SPECIFIER`
--

CREATE TABLE `SPECIFIER` (
  `IDQ` bigint(20) NOT NULL,
  `ID_REGLE` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Contenu de la table `SPECIFIER`
--

INSERT INTO `SPECIFIER` (`IDQ`, `ID_REGLE`) VALUES
(1, 1),
(2, 2),
(3, 3),
(4, 4),
(5, 5);

-- --------------------------------------------------------

--
-- Structure de la table `TAG`
--

CREATE TABLE `TAG` (
  `TAG` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Contenu de la table `TAG`
--

INSERT INTO `TAG` (`TAG`) VALUES
('HTML'),
('IHM'),
('Langage-C'),
('Pharo'),
('PHP'),
('SQL');

-- --------------------------------------------------------

--
-- Structure de la table `TAGGER`
--

CREATE TABLE `TAGGER` (
  `ID_QUEST` bigint(20) NOT NULL,
  `TAG` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Contenu de la table `TAGGER`
--

INSERT INTO `TAGGER` (`ID_QUEST`, `TAG`) VALUES
(1, 'HTML'),
(2, 'PHP'),
(3, 'PHP'),
(4, 'Pharo'),
(6, 'SQL'),
(7, 'Langage-C'),
(8, 'Langage-C');

-- --------------------------------------------------------

--
-- Structure de la table `TYPE`
--

CREATE TABLE `TYPE` (
  `TYPEQ` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Contenu de la table `TYPE`
--

INSERT INTO `TYPE` (`TYPEQ`) VALUES
('Appariement'),
('QCM'),
('QCU'),
('QRL');

-- --------------------------------------------------------

--
-- Structure de la table `UTILISATEUR`
--

CREATE TABLE `UTILISATEUR` (
  `NOM` char(100) NOT NULL,
  `PRENOM` char(100) NOT NULL,
  `TYPE_UTILISATEUR` char(100) NOT NULL,
  `ID` bigint(20) NOT NULL,
  `MATRICULE` char(255) DEFAULT NULL,
  `STATUT` varchar(200) DEFAULT NULL,
  `MAIL_ENSEIGNANT` char(200) DEFAULT NULL,
  `PROMO` char(100) DEFAULT NULL,
  `ANNEE_DE_SORTIE` smallint(6) DEFAULT NULL,
  `MAIL_ETUDIANT` char(200) DEFAULT NULL,
  `MDP` varchar(200) DEFAULT NULL,
  `LOGIN` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Contenu de la table `UTILISATEUR`
--

INSERT INTO `UTILISATEUR` (`NOM`, `PRENOM`, `TYPE_UTILISATEUR`, `ID`, `MATRICULE`, `STATUT`, `MAIL_ENSEIGNANT`, `PROMO`, `ANNEE_DE_SORTIE`, `MAIL_ETUDIANT`, `MDP`, `LOGIN`) VALUES
('Godefert', 'Maxence', 'Etudiant', 1, NULL, NULL, NULL, 'FI 2020', 2020, 'maxence.godefert@etu.imt-lille-douai.fr', 'a', 'max'),
('Acevedo', 'Alejandra', 'Etudiant', 2, NULL, NULL, NULL, 'FI 2020', 2020, 'alejandra.acevedo@etu.imt-lille-douai.fr', 'b', 'aleja'),
('Kepseu', 'Dorine', 'Etudiant', 3, NULL, NULL, NULL, 'FCD 2020', 2020, 'dorine.kepseu@etu.imt-lille-douai.fr', 'c', 'dory'),
('Le participant non inscrit', 'Lorem IPSUM', 'Etudiant Non Connecte', 4, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL),
('Pinot', 'Rémy', 'Enseignant', 5, 'IMT001', 'Interne', 'remy.pinot@imt-lille-douai.fr', NULL, NULL, NULL, 'd', 'rem'),
('Fabresse', 'Luc', 'Enseignant', 6, 'IMT002', 'Interne', 'luc.fabresse@imt-lille-douai.fr', NULL, NULL, NULL, 'e', 'pharluc'),
('Vermeulen', 'Mathieu', 'Enseignant', 7, 'IMT003', 'Interne', 'mathieu.vermeulen@imt-lille-douai.fr', NULL, NULL, NULL, 'f', 'matt'),
('Le prof pas engagé', 'Inconnu', 'Enseignant', 8, 'EX001', 'Externe', 'inconnu@domaine.ext', NULL, NULL, NULL, 'g', '42'),
('nuevo1', 'n', 'Etudiant', 9, NULL, NULL, NULL, NULL, NULL, 'nuevo@fr.com', 'n', 'nuevo'),
('a', 'a', 'Etudiant', 10, NULL, NULL, NULL, NULL, NULL, 'a@a', 'a', 'a'),
('in', 'live', 'Etudiant', 11, NULL, NULL, NULL, NULL, NULL, 'in@live', 'live', 'in'),
('test1', 'test', 'Etudiant', 12, NULL, NULL, NULL, NULL, NULL, 'test@test', 'test', 'test1');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `AJOUTER`
--
ALTER TABLE `AJOUTER`
  ADD PRIMARY KEY (`IDQ`,`ID_QUEST`),
  ADD KEY `FK_AJOUTER2` (`ID_QUEST`);

--
-- Index pour la table `APPARIER`
--
ALTER TABLE `APPARIER`
  ADD PRIMARY KEY (`REP_ID_REPONSE`,`ID_REPONSE`),
  ADD KEY `FK_APPARIER2` (`ID_REPONSE`);

--
-- Index pour la table `APPARTENIR`
--
ALTER TABLE `APPARTENIR`
  ADD PRIMARY KEY (`IDRC`,`ID_REPONSE`),
  ADD KEY `FK_APPARTENIR2` (`ID_REPONSE`);

--
-- Index pour la table `PARTICIPER`
--
ALTER TABLE `PARTICIPER`
  ADD PRIMARY KEY (`ID`,`IDQ`),
  ADD KEY `FK_PARTICIPER2` (`IDQ`);

--
-- Index pour la table `QUESTION`
--
ALTER TABLE `QUESTION`
  ADD PRIMARY KEY (`ID_QUEST`),
  ADD KEY `FK_TYPER` (`TYPEQ`);

--
-- Index pour la table `QUESTIONNAIRE`
--
ALTER TABLE `QUESTIONNAIRE`
  ADD PRIMARY KEY (`IDQ`),
  ADD KEY `FK_CREER_GERER` (`ID`),
  ADD KEY `FK_REGLER_Q` (`ID_REGLES_QUEST`);

--
-- Index pour la table `REGLES_GENERATION`
--
ALTER TABLE `REGLES_GENERATION`
  ADD PRIMARY KEY (`ID_REGLE`);

--
-- Index pour la table `REGLES_QUESTIONNAIRE`
--
ALTER TABLE `REGLES_QUESTIONNAIRE`
  ADD PRIMARY KEY (`ID_REGLES_QUEST`);

--
-- Index pour la table `REPONSES_POSSIBLES`
--
ALTER TABLE `REPONSES_POSSIBLES`
  ADD PRIMARY KEY (`ID_REPONSE`),
  ADD KEY `FK_ASSOCIER` (`ID_QUEST`);

--
-- Index pour la table `REPONSE_CHOISIE`
--
ALTER TABLE `REPONSE_CHOISIE`
  ADD PRIMARY KEY (`IDRC`),
  ADD KEY `FK_CHOISIR` (`ID`),
  ADD KEY `FK_PAR` (`ID_QUEST`);

--
-- Index pour la table `SPECIFIER`
--
ALTER TABLE `SPECIFIER`
  ADD PRIMARY KEY (`IDQ`,`ID_REGLE`),
  ADD KEY `FK_SPECIFIER2` (`ID_REGLE`);

--
-- Index pour la table `TAG`
--
ALTER TABLE `TAG`
  ADD PRIMARY KEY (`TAG`);

--
-- Index pour la table `TAGGER`
--
ALTER TABLE `TAGGER`
  ADD PRIMARY KEY (`ID_QUEST`,`TAG`),
  ADD KEY `FK_TAGGER2` (`TAG`);

--
-- Index pour la table `TYPE`
--
ALTER TABLE `TYPE`
  ADD PRIMARY KEY (`TYPEQ`);

--
-- Index pour la table `UTILISATEUR`
--
ALTER TABLE `UTILISATEUR`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `NOM_PRENOM` (`NOM`,`PRENOM`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `QUESTION`
--
ALTER TABLE `QUESTION`
  MODIFY `ID_QUEST` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT pour la table `QUESTIONNAIRE`
--
ALTER TABLE `QUESTIONNAIRE`
  MODIFY `IDQ` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT pour la table `REGLES_GENERATION`
--
ALTER TABLE `REGLES_GENERATION`
  MODIFY `ID_REGLE` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT pour la table `REGLES_QUESTIONNAIRE`
--
ALTER TABLE `REGLES_QUESTIONNAIRE`
  MODIFY `ID_REGLES_QUEST` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT pour la table `REPONSES_POSSIBLES`
--
ALTER TABLE `REPONSES_POSSIBLES`
  MODIFY `ID_REPONSE` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT pour la table `REPONSE_CHOISIE`
--
ALTER TABLE `REPONSE_CHOISIE`
  MODIFY `IDRC` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT pour la table `UTILISATEUR`
--
ALTER TABLE `UTILISATEUR`
  MODIFY `ID` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `AJOUTER`
--
ALTER TABLE `AJOUTER`
  ADD CONSTRAINT `FK_AJOUTER` FOREIGN KEY (`IDQ`) REFERENCES `QUESTIONNAIRE` (`IDQ`) ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_AJOUTER2` FOREIGN KEY (`ID_QUEST`) REFERENCES `QUESTION` (`ID_QUEST`) ON UPDATE CASCADE;

--
-- Contraintes pour la table `APPARIER`
--
ALTER TABLE `APPARIER`
  ADD CONSTRAINT `FK_APPARIER` FOREIGN KEY (`REP_ID_REPONSE`) REFERENCES `REPONSES_POSSIBLES` (`ID_REPONSE`) ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_APPARIER2` FOREIGN KEY (`ID_REPONSE`) REFERENCES `REPONSES_POSSIBLES` (`ID_REPONSE`) ON UPDATE CASCADE;

--
-- Contraintes pour la table `APPARTENIR`
--
ALTER TABLE `APPARTENIR`
  ADD CONSTRAINT `FK_APPARTENIR` FOREIGN KEY (`IDRC`) REFERENCES `REPONSE_CHOISIE` (`IDRC`) ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_APPARTENIR2` FOREIGN KEY (`ID_REPONSE`) REFERENCES `REPONSES_POSSIBLES` (`ID_REPONSE`) ON UPDATE CASCADE;

--
-- Contraintes pour la table `PARTICIPER`
--
ALTER TABLE `PARTICIPER`
  ADD CONSTRAINT `FK_PARTICIPER` FOREIGN KEY (`ID`) REFERENCES `UTILISATEUR` (`ID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_PARTICIPER2` FOREIGN KEY (`IDQ`) REFERENCES `QUESTIONNAIRE` (`IDQ`) ON UPDATE CASCADE;

--
-- Contraintes pour la table `QUESTION`
--
ALTER TABLE `QUESTION`
  ADD CONSTRAINT `FK_TYPER` FOREIGN KEY (`TYPEQ`) REFERENCES `TYPE` (`TYPEQ`) ON UPDATE CASCADE;

--
-- Contraintes pour la table `QUESTIONNAIRE`
--
ALTER TABLE `QUESTIONNAIRE`
  ADD CONSTRAINT `FK_CREER_GERER` FOREIGN KEY (`ID`) REFERENCES `UTILISATEUR` (`ID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_REGLER_Q` FOREIGN KEY (`ID_REGLES_QUEST`) REFERENCES `REGLES_QUESTIONNAIRE` (`ID_REGLES_QUEST`) ON UPDATE CASCADE;

--
-- Contraintes pour la table `REPONSES_POSSIBLES`
--
ALTER TABLE `REPONSES_POSSIBLES`
  ADD CONSTRAINT `FK_ASSOCIER` FOREIGN KEY (`ID_QUEST`) REFERENCES `QUESTION` (`ID_QUEST`) ON UPDATE CASCADE;

--
-- Contraintes pour la table `REPONSE_CHOISIE`
--
ALTER TABLE `REPONSE_CHOISIE`
  ADD CONSTRAINT `FK_CHOISIR` FOREIGN KEY (`ID`) REFERENCES `UTILISATEUR` (`ID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_PAR` FOREIGN KEY (`ID_QUEST`) REFERENCES `QUESTION` (`ID_QUEST`) ON UPDATE CASCADE;

--
-- Contraintes pour la table `SPECIFIER`
--
ALTER TABLE `SPECIFIER`
  ADD CONSTRAINT `FK_SPECIFIER` FOREIGN KEY (`IDQ`) REFERENCES `QUESTIONNAIRE` (`IDQ`) ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_SPECIFIER2` FOREIGN KEY (`ID_REGLE`) REFERENCES `REGLES_GENERATION` (`ID_REGLE`) ON UPDATE CASCADE;

--
-- Contraintes pour la table `TAGGER`
--
ALTER TABLE `TAGGER`
  ADD CONSTRAINT `FK_TAGGER` FOREIGN KEY (`ID_QUEST`) REFERENCES `QUESTION` (`ID_QUEST`) ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_TAGGER2` FOREIGN KEY (`TAG`) REFERENCES `TAG` (`TAG`) ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
