-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mar. 24 juin 2025 à 09:34
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
-- Base de données : `pfe`
--
CREATE DATABASE IF NOT EXISTS `pfe` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `pfe`;

-- --------------------------------------------------------

--
-- Structure de la table `depenses`
--

CREATE TABLE `depenses` (
  `id_depense` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `categorie` varchar(50) NOT NULL,
  `montant` decimal(10,2) NOT NULL,
  `date_transaction` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `depenses`
--

INSERT INTO `depenses` (`id_depense`, `id_user`, `categorie`, `montant`, `date_transaction`) VALUES
(1, 0, 'Taxes', 0.00, '0000-00-00'),
(2, 0, 'Factures', 0.00, '0000-00-00'),
(3, 0, 'Voyages', 0.00, '0000-00-00'),
(4, 0, 'Alimentation', 0.00, '0000-00-00'),
(5, 0, 'Transport', 0.00, '0000-00-00'),
(6, 0, 'Shopping', 0.00, '0000-00-00'),
(7, 0, 'Santé', 0.00, '0000-00-00'),
(8, 0, 'Loisirs', 0.00, '0000-00-00'),
(14, 5, 'voyage', 300.00, '2025-05-16'),
(15, 8, 'voyage', 300.00, '2025-05-20'),
(16, 8, 'transport', 500.00, '2025-05-23'),
(17, 8, 'transport', 250.00, '2025-05-29'),
(18, 1, 'factures', 1000.00, '2025-06-02'),
(19, 9, 'factures', 1000.00, '2025-06-02'),
(20, 9, 'taxes', 200.00, '2025-06-04'),
(21, 10, 'alimentation', 1400.00, '2025-06-21'),
(22, 10, 'santé', 500.00, '2025-06-21'),
(23, 10, 'voyage', 1000.00, '2025-06-21'),
(24, 10, 'alimentation', 200.00, '2025-06-21'),
(25, 1, 'shopping', 1500.00, '2025-06-22');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `nom_user` varchar(200) NOT NULL,
  `prenom_user` varchar(200) NOT NULL,
  `username_user` varchar(200) NOT NULL,
  `email_user` varchar(200) NOT NULL,
  `password_user` varchar(200) NOT NULL,
  `city_user` varchar(200) NOT NULL,
  `bank_user` varchar(200) NOT NULL,
  `salaire_user` decimal(10,2) NOT NULL DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id_user`, `nom_user`, `prenom_user`, `username_user`, `email_user`, `password_user`, `city_user`, `bank_user`, `salaire_user`) VALUES
(1, 'hello', 'gh', 'hello', 'test@gmail.com', '$2y$10$jn3s2rjYk9kLju.M.hCAiOq9xjNS/BdbDZFZXKKHE.ytUOA6rswha', 'casa', 'Banque Populaire', 5000.00),
(2, 'gh', 'ak', 'akgh', 'akgh@gmail.com', '$2y$10$w6jDGdscponMIWV4/CdXFOWHnJyytCwcoHJKGXIkthcEoo3paWkxy', 'casa', 'Banque Populaire', 8000.00),
(8, 'baghd', 'amine', 'amine405', 'amine405@gmail.com', '$2y$10$IEfcSbjiq9ctPWHYhW//Eu2r/npLBjnrAv9F4kDkTB.UKvo4B7dGK', 'rabat', 'CIH', 6000.00),
(9, 'azouz', 'yahya', 'yahya02', 'yahya02@gmail.com', '$2y$10$RznTnBiohuz6JwNcCJIyAOO3FBAArad.sWii9f9d7V1S4XjZpSypy', 'casa', 'AttijariWafa Bank', 5000.00),
(10, 'ELOUAFI', 'Abderrahmen', 'ELOUAFI', '123@gmail.com', '$2y$10$cgFw9bzdQkQLzbvT9pDt/..cPILRDYSgaNdMlRP8jD.Yi9J1gCnvi', 'CAsablanca', 'CIH', 5000.00);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `depenses`
--
ALTER TABLE `depenses`
  ADD PRIMARY KEY (`id_depense`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `depenses`
--
ALTER TABLE `depenses`
  MODIFY `id_depense` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
