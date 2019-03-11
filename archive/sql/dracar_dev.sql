-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 19, 2018 at 11:23 PM
-- Server version: 5.7.21-0ubuntu0.17.10.1
-- PHP Version: 7.1.15-0ubuntu0.17.10.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dracar`
--

--
-- Dumping data for table `AGENT`
--

INSERT INTO `AGENT` (`ID_USER`, `ID_LIEU`, `ID_UNITE`, `ID_FONCTION`) VALUES
(1, 2, 1, 1);

--
-- Dumping data for table `COULEUR`
--

INSERT INTO `COULEUR` (`ID_COULEUR`, `NOM_COULEUR`) VALUES
(1, 'Blanc');

--
-- Dumping data for table `ETAPE`
--

INSERT INTO `ETAPE` (`ID_TRAJET`, `ID_LIEU`, `HEURE`) VALUES
(1, 1, '2018-04-19 11:11:00'),
(1, 2, '2018-04-20 22:22:00');

--
-- Dumping data for table `ETUDIANT`
--

INSERT INTO `ETUDIANT` (`ID_USER`, `ID_PROMOTION`) VALUES
(2, 1);

--
-- Dumping data for table `FONCTION`
--

INSERT INTO `FONCTION` (`ID_FONCTION`, `NOM_FONCTION`) VALUES
(1, 'Directeur Général');

--
-- Dumping data for table `GROUPE`
--

INSERT INTO `GROUPE` (`ID_GROUPE`, `NOM_GROUPE`) VALUES
(1, 'ISIC');

--
-- Dumping data for table `GROUPE_USER`
--

INSERT INTO `GROUPE_USER` (`ID_GROUPE`, `ID_USER`) VALUES
(1, 2);

--
-- Dumping data for table `IP`
--

INSERT INTO `IP` (`ID_IP`, `IP`, `IP_BANNI`) VALUES
(1, '127.0.0.1', 0);

--
-- Dumping data for table `LIEU`
--

INSERT INTO `LIEU` (`ID_LIEU`, `LAT`, `LON`, `ADRESSE`, `NOM_LIEU`) VALUES
(1, '50.375550', '3.067584', '941 Rue Charles Bourseul, 59500 Douai', 'Bourseul'),
(2, '50.386877', '3.084000', '764 Boulevard Lahure, 59500 Douai', 'Lahure');

--
-- Dumping data for table `LOG_CONNECTION`
--

INSERT INTO `LOG_CONNECTION` (`ID_LOG_CONNECTION`, `ID_IP`, `DATE`) VALUES
(1, 1, '2018-04-19 22:42:23'),
(2, 1, '2018-04-19 22:47:37'),
(3, 1, '2018-04-19 23:00:33');

--
-- Dumping data for table `MARQUE`
--

INSERT INTO `MARQUE` (`ID_MARQUE`, `NOM_MARQUE`) VALUES
(1, 'Fab\'Lab');

--
-- Dumping data for table `MODELE`
--

INSERT INTO `MODELE` (`ID_MODELE`, `ID_MARQUE`, `ANNEE`, `NOM_MODELE`) VALUES
(1, 1, 2020, 'Carroboros');

--
-- Dumping data for table `PARTICIPANTS`
--

INSERT INTO `PARTICIPANTS` (`ID_USER`, `ID_TRAJET`) VALUES
(1, 1);

--
-- Dumping data for table `PROMOTION`
--

INSERT INTO `PROMOTION` (`ID_PROMOTION`, `NOM_PROMOTION`, `TYPE_PROMOTION`) VALUES
(1, '2019', 'FI');

--
-- Dumping data for table `TRAJET`
--

INSERT INTO `TRAJET` (`ID_TRAJET`, `ID_TYPE_TRAJET`, `ID_USER`, `PLACE`, `BLOQUER`) VALUES
(1, 1, 2, 3, 0);

--
-- Dumping data for table `TRAJET_MODERATOR`
--

INSERT INTO `TRAJET_MODERATOR` (`ID_TRAJET`, `ID_USER`) VALUES
(1, 3);

--
-- Dumping data for table `TYPE_TRAJET`
--

INSERT INTO `TYPE_TRAJET` (`ID_TYPE_TRAJET`, `NOM_TYPE`) VALUES
(1, 'Inter-Sites');

--
-- Dumping data for table `UNITE`
--

INSERT INTO `UNITE` (`ID_UNITE`, `NOM_UNITE`) VALUES
(1, 'Conseil d\'Administration');

--
-- Dumping data for table `USER`
--

INSERT INTO `USER` (`ID_USER`, `ID_LOG_CONNECTION`, `NOM`, `PRENOM`, `EMAIL`, `TELEPHONE`, `PASSWORD`, `ADMIN`, `PSEUDO`, `BANNI`) VALUES
(1, 1, 'Admin', 'Admin', 'admin@example.com', '0612345678', '8c6976e5b5410415bde908bd4dee15dfb167a9c873fc4bb8a81f6f2ab448a918', 1, 'admin', 0),
(2, 2, 'User', 'User', 'user@example.com', '0623456789', '04f8996da763b7a969b1028ee3007569eaf3a635486ddab211d512c85b9df8fb', 0, 'user', 0),
(3, 3, 'Moderator', 'Moderator', 'moderator@example.com', '0634567890', 'cfde2ca5188afb7bdd0691c7bef887baba78b709aadde8e8c535329d5751e6fe', 0, 'moderator', 0);

--
-- Dumping data for table `VEHICULE`
--

INSERT INTO `VEHICULE` (`ID_VEHICULE`, `ID_COULEUR`, `ID_MODELE`, `ID_USER`) VALUES
(1, 1, 1, 2);

--
-- Dumping data for table `VEHICULE_TRAJET`
--

INSERT INTO `VEHICULE_TRAJET` (`ID_VEHICULE`, `ID_TRAJET`) VALUES
(1, 1);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
