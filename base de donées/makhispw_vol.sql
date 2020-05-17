CREATE DATABASE makhispw_vol;
-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : Dim 17 mai 2020 à 18:20
-- Version du serveur :  10.4.11-MariaDB
-- Version de PHP : 7.2.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `makhispw_vol`
--

-- --------------------------------------------------------

--
-- Structure de la table `client`
--

CREATE TABLE `client` (
  `idClient` int(11) NOT NULL,
  `Nom` varchar(254) DEFAULT NULL,
  `Email` varchar(254) DEFAULT NULL,
  `PhoneNumber` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `client`
--

INSERT INTO `client` (`idClient`, `Nom`, `Email`, `PhoneNumber`) VALUES
(67, 'mohamed', 'oubouhiam@gmail.com', 2147483647),
(68, 'hdddddd', 'kjhkj@jhguj.bh', 2147483647),
(69, 'jhdc', 'oubouhiam@gmail.com', 4444444),
(70, 'hhhhhhh', 'oubouhiam@gmail.com', 55555555),
(71, 'youness', 'gjhjvh@jhgvhj.jhh', 2147483647);

-- --------------------------------------------------------

--
-- Structure de la table `reservation`
--

CREATE TABLE `reservation` (
  `IdReservation` int(11) NOT NULL,
  `IdClient` int(11) DEFAULT NULL,
  `IdVol` int(11) DEFAULT NULL,
  `IdPlace` int(11) DEFAULT NULL,
  `DateReservation` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `reservation`
--

INSERT INTO `reservation` (`IdReservation`, `IdClient`, `IdVol`, `IdPlace`, `DateReservation`) VALUES
(46, 69, 1, 0, '2020-05-17 00:00:00'),
(47, 70, 1, 0, '2020-05-17 00:00:00'),
(48, 71, 1, 0, '2020-05-17 00:00:00');

-- --------------------------------------------------------

--
-- Structure de la table `vols`
--

CREATE TABLE `vols` (
  `IdVol` int(11) NOT NULL,
  `Depart` text NOT NULL,
  `Destination` text NOT NULL,
  `Date` date NOT NULL,
  `NombrePlace` int(11) DEFAULT NULL,
  `Prix` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `vols`
--

INSERT INTO `vols` (`IdVol`, `Depart`, `Destination`, `Date`, `NombrePlace`, `Prix`) VALUES
(1, 'casa', 'agadir', '2020-05-13', 191, 14.05),
(2, 'agadir', 'casa', '2020-05-14', 250, 40.05),
(3, 'casa', 'safi', '2020-05-13', 242, 14.05),
(4, 'safi', 'casa', '2020-05-17', 130, 10.05),
(5, 'bengrir', 'tanger', '2020-05-13', 310, 14.05),
(6, 'tanger', 'bengrir', '2020-05-13', 340, 19.05),
(7, 'safi', 'azilal', '2020-05-13', 140, 20.05);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`idClient`);

--
-- Index pour la table `reservation`
--
ALTER TABLE `reservation`
  ADD PRIMARY KEY (`IdReservation`),
  ADD KEY `IdClient` (`IdClient`),
  ADD KEY `IdVol` (`IdVol`);

--
-- Index pour la table `vols`
--
ALTER TABLE `vols`
  ADD PRIMARY KEY (`IdVol`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `client`
--
ALTER TABLE `client`
  MODIFY `idClient` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT pour la table `reservation`
--
ALTER TABLE `reservation`
  MODIFY `IdReservation` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT pour la table `vols`
--
ALTER TABLE `vols`
  MODIFY `IdVol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `reservation`
--
ALTER TABLE `reservation`
  ADD CONSTRAINT `reservation_ibfk_1` FOREIGN KEY (`IdClient`) REFERENCES `client` (`idClient`),
  ADD CONSTRAINT `reservation_ibfk_2` FOREIGN KEY (`IdVol`) REFERENCES `vols` (`IdVol`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
