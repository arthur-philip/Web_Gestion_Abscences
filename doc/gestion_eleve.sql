-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  Dim 30 déc. 2018 à 14:18
-- Version du serveur :  5.7.23
-- Version de PHP :  7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `gestion_eleve`
--

-- --------------------------------------------------------

--
-- Structure de la table `abscence`
--

DROP TABLE IF EXISTS `abscence`;
CREATE TABLE IF NOT EXISTS `abscence` (
  `id_abscence` int(10) NOT NULL AUTO_INCREMENT,
  `id_cours` int(10) NOT NULL,
  `ine_etudiant` varchar(11) NOT NULL,
  PRIMARY KEY (`id_abscence`),
  KEY `abscence_cours_fk` (`id_cours`),
  KEY `abscence_etudiant_fk` (`ine_etudiant`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `anime`
--

DROP TABLE IF EXISTS `anime`;
CREATE TABLE IF NOT EXISTS `anime` (
  `id_cours` int(10) NOT NULL,
  `id_personnel` int(10) NOT NULL,
  PRIMARY KEY (`id_cours`,`id_personnel`),
  KEY `anime_cours_fk` (`id_cours`),
  KEY `anime_personnel_fk` (`id_personnel`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `cours`
--

DROP TABLE IF EXISTS `cours`;
CREATE TABLE IF NOT EXISTS `cours` (
  `id_cours` int(10) NOT NULL AUTO_INCREMENT,
  `id_matiere` int(10) NOT NULL,
  `id_groupe` int(10) NOT NULL,
  `id_salle` int(10) NOT NULL,
  `horaire_debut` date NOT NULL,
  `horaire_fin` date NOT NULL,
  PRIMARY KEY (`id_cours`),
  KEY `cours_matiere_fk` (`id_matiere`),
  KEY `cours_groupe_etudiant_fk` (`id_groupe`),
  KEY `cours_salle_fk` (`id_salle`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `departement`
--

DROP TABLE IF EXISTS `departement`;
CREATE TABLE IF NOT EXISTS `departement` (
  `id_departement` int(10) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(25) NOT NULL,
  PRIMARY KEY (`id_departement`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `etudiant`
--

DROP TABLE IF EXISTS `etudiant`;
CREATE TABLE IF NOT EXISTS `etudiant` (
  `ine_etudiant` varchar(11) NOT NULL,
  `id_groupe` int(10) NOT NULL,
  `nom` int(25) NOT NULL,
  `prenom` int(25) NOT NULL,
  PRIMARY KEY (`ine_etudiant`),
  KEY `etudiant_groupe_fk` (`id_groupe`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `filiere`
--

DROP TABLE IF EXISTS `filiere`;
CREATE TABLE IF NOT EXISTS `filiere` (
  `id_filiere` int(10) NOT NULL AUTO_INCREMENT,
  `id_departement` int(10) NOT NULL,
  `libelle` varchar(25) NOT NULL,
  PRIMARY KEY (`id_filiere`),
  KEY `filiere_departement_fk` (`id_departement`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `groupe_etudiant`
--

DROP TABLE IF EXISTS `groupe_etudiant`;
CREATE TABLE IF NOT EXISTS `groupe_etudiant` (
  `id_groupe` int(10) NOT NULL AUTO_INCREMENT,
  `id_filiere` int(10) NOT NULL,
  `libelle` varchar(25) NOT NULL,
  PRIMARY KEY (`id_groupe`),
  KEY `groupe_etudiant_filiere_fk` (`id_filiere`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `matiere`
--

DROP TABLE IF EXISTS `matiere`;
CREATE TABLE IF NOT EXISTS `matiere` (
  `id_matiere` int(10) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(50) NOT NULL,
  PRIMARY KEY (`id_matiere`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `personnel`
--

DROP TABLE IF EXISTS `personnel`;
CREATE TABLE IF NOT EXISTS `personnel` (
  `id_personnel` int(10) NOT NULL AUTO_INCREMENT,
  `login` varchar(25) NOT NULL,
  `mdp` varchar(25) NOT NULL,
  `nom` varchar(25) NOT NULL,
  `prenom` varchar(25) NOT NULL,
  `email` varchar(50) NOT NULL,
  `id_responsabilite` int(10) NOT NULL,
  PRIMARY KEY (`id_personnel`),
  UNIQUE KEY `uniq_login` (`login`) USING BTREE,
  KEY `personnel_responsabilite_fk` (`id_responsabilite`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `responsabilite`
--

DROP TABLE IF EXISTS `responsabilite`;
CREATE TABLE IF NOT EXISTS `responsabilite` (
  `id_responsabilite` int(10) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(25) NOT NULL,
  PRIMARY KEY (`id_responsabilite`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `salle`
--

DROP TABLE IF EXISTS `salle`;
CREATE TABLE IF NOT EXISTS `salle` (
  `id_salle` int(10) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(10) NOT NULL,
  PRIMARY KEY (`id_salle`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `abscence`
--
ALTER TABLE `abscence`
  ADD CONSTRAINT `abscence_cours_fk` FOREIGN KEY (`id_cours`) REFERENCES `cours` (`id_cours`),
  ADD CONSTRAINT `abscence_etudiant_fk` FOREIGN KEY (`ine_etudiant`) REFERENCES `etudiant` (`ine_etudiant`);

--
-- Contraintes pour la table `cours`
--
ALTER TABLE `cours`
  ADD CONSTRAINT `cours_groupe_etudiant_fk` FOREIGN KEY (`id_groupe`) REFERENCES `groupe_etudiant` (`id_groupe`),
  ADD CONSTRAINT `cours_matiere_fk` FOREIGN KEY (`id_matiere`) REFERENCES `matiere` (`id_matiere`),
  ADD CONSTRAINT `cours_salle_fk	` FOREIGN KEY (`id_salle`) REFERENCES `salle` (`id_salle`);

--
-- Contraintes pour la table `etudiant`
--
ALTER TABLE `etudiant`
  ADD CONSTRAINT `etudiant_groupe_fk` FOREIGN KEY (`id_groupe`) REFERENCES `cours` (`id_cours`);

--
-- Contraintes pour la table `filiere`
--
ALTER TABLE `filiere`
  ADD CONSTRAINT `filiere_departement_fk` FOREIGN KEY (`id_departement`) REFERENCES `departement` (`id_departement`);

--
-- Contraintes pour la table `groupe_etudiant`
--
ALTER TABLE `groupe_etudiant`
  ADD CONSTRAINT `groupe_etudiant_filiere_fk` FOREIGN KEY (`id_filiere`) REFERENCES `filiere` (`id_filiere`);

--
-- Contraintes pour la table `personnel`
--
ALTER TABLE `personnel`
  ADD CONSTRAINT `personnel_responsabilite_fk` FOREIGN KEY (`id_responsabilite`) REFERENCES `responsabilite` (`id_responsabilite`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
