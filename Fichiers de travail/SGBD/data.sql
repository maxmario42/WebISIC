-- phpMyAdmin SQL Dump
-- version 4.6.6deb4
-- https://www.phpmyadmin.net/
--
-- Client :  localhost:3306
-- Généré le :  Lun 18 Mars 2019 à 20:19
-- Version du serveur :  10.1.26-MariaDB-0+deb9u1
-- Version de PHP :  7.0.33-0+deb9u3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `maxence_godefert`
--

--
-- Contenu de la table `AJOUTER`
--

INSERT INTO `AJOUTER` (`IDQ`, `ID_QUEST`) VALUES
(1, 5),
(2, 1),
(2, 2),
(3, 3),
(4, 6),
(5, 4);

--
-- Contenu de la table `APPARTENIR`
--

INSERT INTO `APPARTENIR` (`IDRC`, `ID_REPONSE`) VALUES
(1, 2),
(2, 3),
(3, 6),
(4, 8),
(5, 10);

--
-- Contenu de la table `PARTICIPER`
--

INSERT INTO `PARTICIPER` (`ID`, `IDQ`, `DATE_PARTICIPATION`, `CLASSEMENT`) VALUES
(1, 1, '1903-01-01', 1),
(1, 5, '2019-01-30', 1),
(2, 2, '2019-04-01', 1),
(3, 3, '2019-02-15', 1),
(4, 4, '2019-04-01', 1);

--
-- Contenu de la table `QUESTION`
--

INSERT INTO `QUESTION` (`INTITULE`, `ID_QUEST`, `TYPEQ`, `TEMPS_MAXIMAL`) VALUES
('Le HTML est un langage de...', 1, 'QCU', 20),
('Qu\'est-ce qui est vrai sur le PHP ?', 2, 'QCM', 30),
('IHM signifie Interface Homme...', 3, 'QRL', 30),
('Pharo est une implémentation du langage ?', 4, 'QRL', NULL),
('La réponse à la grande question est...', 5, 'QCU', NULL),
('Vérités sur le SQL ?', 6, 'QCM', 60);

--
-- Contenu de la table `QUESTIONNAIRE`
--

INSERT INTO `QUESTIONNAIRE` (`IDQ`, `ID`, `TITRE`, `ID_REGLES_QUEST`, `DESCRIPTION`, `ETAT`, `DATE_OUVERTURE`, `DATE_FERMETURE`, `MODE_ACCES`, `LIEN_HTTP`) VALUES
(1, 8, 'Questionnaire numéro 42 sur la vie', 5, 'Redécouvrez toute la profondeur de 42', 'Fermé', '1902-09-04', '1903-09-04', 'Public', 'Lien1'),
(2, 6, 'Un peu de Web', 4, 'Apprenons à faire du web', 'Ouvert', '2019-03-04', '2019-05-19', 'Connecté', 'Lien2'),
(3, 7, 'IHM', 3, 'Interfacer l\'homme et la machine', 'Fermé', '2019-02-01', '2019-03-01', 'Lien', 'Lien3'),
(4, 5, 'Vive la SGBD', 2, NULL, 'Ouvert', '2019-02-28', '2019-05-30', 'Connecté', 'Lien4'),
(5, 6, 'Pharo c\'est la vie', 1, NULL, 'Fermé', '2019-01-28', '2019-01-31', 'Public', 'Lien5');

--
-- Contenu de la table `REGLES_GENERATION`
--

INSERT INTO `REGLES_GENERATION` (`REGLE`, `ID_REGLE`) VALUES
('Regle1', 1),
('Regle2', 2),
('Regle3', 3),
('Regle4', 4),
('Regle5', 5);

--
-- Contenu de la table `REGLES_QUESTIONNAIRE`
--

INSERT INTO `REGLES_QUESTIONNAIRE` (`TEMPS_TOTALE`, `REVENIR_ARRIERE`, `ID_REGLES_QUEST`, `PLUS`, `MOINS`, `NEUTRE`) VALUES
(NULL, 0, 1, 1, NULL, NULL),
(600, 0, 2, 3, 1, NULL),
(300, 1, 3, 2, 1, NULL),
(NULL, 1, 4, 1, 2, NULL),
(100, 1, 5, 5, 3, 1);

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
(10, 6, 'C\'est trop dur', 1, NULL);

--
-- Contenu de la table `REPONSE_CHOISIE`
--

INSERT INTO `REPONSE_CHOISIE` (`ID_QUEST`, `IDRC`, `ID`, `OKPASOK`) VALUES
(1, 1, 2, 1),
(2, 2, 2, 1),
(3, 3, 3, 1),
(4, 4, 1, 1),
(6, 5, 4, 0);

--
-- Contenu de la table `SPECIFIER`
--

INSERT INTO `SPECIFIER` (`IDQ`, `ID_REGLE`) VALUES
(1, 1),
(2, 2),
(3, 3),
(4, 4),
(5, 5);

--
-- Contenu de la table `TAG`
--

INSERT INTO `TAG` (`TAG`) VALUES
('HTML'),
('IHM'),
('Pharo'),
('PHP'),
('SQL');

--
-- Contenu de la table `TAGGER`
--

INSERT INTO `TAGGER` (`ID_QUEST`, `TAG`) VALUES
(1, 'HTML'),
(2, 'PHP'),
(3, 'PHP'),
(4, 'Pharo'),
(6, 'SQL');

--
-- Contenu de la table `TYPE`
--

INSERT INTO `TYPE` (`TYPEQ`) VALUES
('Appariement'),
('QCM'),
('QCU'),
('QRL');

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
('Le prof pas engagé', 'Inconnu', 'Enseignant', 8, 'EX001', 'Externe', 'inconnu@domaine.ext', NULL, NULL, NULL, 'g', '42');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
