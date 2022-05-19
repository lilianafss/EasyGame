-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : jeu. 19 mai 2022 à 14:13
-- Version du serveur :  10.3.32-MariaDB-0ubuntu0.20.04.1
-- Version de PHP : 8.0.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `easygame`
--
CREATE DATABASE IF NOT EXISTS `easygame` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `easygame`;

-- --------------------------------------------------------

--
-- Structure de la table `ajouter_panier`
--

CREATE TABLE `ajouter_panier` (
  `idPanier` int(11) NOT NULL,
  `idJeux` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `ajouter_wishlist`
--

CREATE TABLE `ajouter_wishlist` (
  `idWishlist` int(11) NOT NULL,
  `idJeux` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `commentaires`
--

CREATE TABLE `commentaires` (
  `idComentaire` int(11) NOT NULL,
  `commentaire` text NOT NULL,
  `idUser` int(11) NOT NULL,
  `idJeux` int(11) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `filtre_jeux`
--

CREATE TABLE `filtre_jeux` (
  `idJeux` int(11) NOT NULL,
  `idGenre` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `genre`
--

CREATE TABLE `genre` (
  `idGenre` int(11) NOT NULL,
  `genre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `genre`
--

INSERT INTO `genre` (`idGenre`, `genre`) VALUES
(1, 'Action'),
(2, 'Arcade'),
(3, 'Autre'),
(4, 'Aventure'),
(5, 'Beat em all'),
(6, 'Co-op en ligne'),
(7, 'Coaching'),
(8, 'Combat'),
(9, 'Coopération'),
(10, 'Course'),
(11, 'Early Access'),
(12, 'FPS'),
(13, 'Free to play'),
(14, 'Gestion'),
(15, 'Indies'),
(16, 'Jeux solo'),
(17, 'Local co-op'),
(18, 'MMO'),
(19, 'Multijoueur'),
(20, 'Multijoueur multiplateforme'),
(21, 'Plates-formes'),
(22, 'PvP en ligne'),
(23, 'RPG'),
(24, 'Remote Play Together'),
(25, 'Shoot em up'),
(26, 'Simulation'),
(27, 'Sport'),
(28, 'Stratégie'),
(29, 'VR'),
(30, 'Wargame '),
(31, 'Open World\r\n');

-- --------------------------------------------------------

--
-- Structure de la table `historique`
--

CREATE TABLE `historique` (
  `idHistorique` int(11) NOT NULL,
  `idUser` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `jeux`
--

CREATE TABLE `jeux` (
  `idJeux` int(11) NOT NULL,
  `nom` varchar(80) NOT NULL,
  `description` text NOT NULL,
  `prix` float NOT NULL,
  `idPegi` int(11) NOT NULL,
  `image` longblob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `notes`
--

CREATE TABLE `notes` (
  `note` int(11) NOT NULL,
  `idUser` int(11) NOT NULL,
  `idJeux` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `ou_jouer`
--

CREATE TABLE `ou_jouer` (
  `idPlateforme` int(11) NOT NULL,
  `idJeux` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `panier`
--

CREATE TABLE `panier` (
  `idPanier` int(11) NOT NULL,
  `idUser` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `pegis`
--

CREATE TABLE `pegis` (
  `idPegi` int(11) NOT NULL,
  `pegi` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `pegis`
--

INSERT INTO `pegis` (`idPegi`, `pegi`) VALUES
(1, 3),
(2, 7),
(3, 12),
(4, 16),
(5, 18);

-- --------------------------------------------------------

--
-- Structure de la table `plateforme`
--

CREATE TABLE `plateforme` (
  `idPlateforme` int(11) NOT NULL,
  `plateforme` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `plateforme`
--

INSERT INTO `plateforme` (`idPlateforme`, `plateforme`) VALUES
(1, 'PC'),
(2, 'Playstation'),
(3, 'Xbox'),
(4, 'Switch');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `idUser` int(11) NOT NULL,
  `pseudo` varchar(16) NOT NULL,
  `nom` varchar(40) NOT NULL,
  `prenom` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `admin` tinyint(1) NOT NULL,
  `user_status` enum('Actif','Disabled','En Attente','') NOT NULL,
  `dateCreation` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`idUser`, `pseudo`, `nom`, `prenom`, `email`, `password`, `admin`, `user_status`, `dateCreation`) VALUES
(1, 'Admin', 'Admin', 'Admin', 'admin@gmail.com', '$2y$10$XXyWWS2qsPgV98Gfwas5eOj.bAw3ShzvsdSFQ7lzuGQvlrjExdd3O', 1, 'Actif', '0000-00-00');

-- --------------------------------------------------------

--
-- Structure de la table `voir_historique`
--

CREATE TABLE `voir_historique` (
  `idHistorique` int(11) NOT NULL,
  `idJeux` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `wishlist`
--

CREATE TABLE `wishlist` (
  `idWishlist` int(11) NOT NULL,
  `idUser` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `ajouter_panier`
--
ALTER TABLE `ajouter_panier`
  ADD PRIMARY KEY (`idPanier`,`idJeux`) USING BTREE,
  ADD KEY `idPanier` (`idPanier`),
  ADD KEY `idJeux` (`idJeux`);

--
-- Index pour la table `ajouter_wishlist`
--
ALTER TABLE `ajouter_wishlist`
  ADD PRIMARY KEY (`idWishlist`,`idJeux`),
  ADD KEY `idWishlist` (`idWishlist`),
  ADD KEY `idJeux` (`idJeux`);

--
-- Index pour la table `commentaires`
--
ALTER TABLE `commentaires`
  ADD PRIMARY KEY (`idComentaire`),
  ADD KEY `idUser` (`idUser`),
  ADD KEY `idJeux` (`idJeux`);

--
-- Index pour la table `filtre_jeux`
--
ALTER TABLE `filtre_jeux`
  ADD PRIMARY KEY (`idJeux`,`idGenre`),
  ADD KEY `idGenre` (`idGenre`),
  ADD KEY `idJeux` (`idJeux`);

--
-- Index pour la table `genre`
--
ALTER TABLE `genre`
  ADD PRIMARY KEY (`idGenre`);

--
-- Index pour la table `historique`
--
ALTER TABLE `historique`
  ADD PRIMARY KEY (`idHistorique`),
  ADD KEY `idUser` (`idUser`);

--
-- Index pour la table `jeux`
--
ALTER TABLE `jeux`
  ADD PRIMARY KEY (`idJeux`),
  ADD KEY `idPegi` (`idPegi`);

--
-- Index pour la table `notes`
--
ALTER TABLE `notes`
  ADD PRIMARY KEY (`idUser`,`idJeux`),
  ADD KEY `idJeux` (`idJeux`),
  ADD KEY `idUser` (`idUser`);

--
-- Index pour la table `ou_jouer`
--
ALTER TABLE `ou_jouer`
  ADD KEY `idJeux` (`idJeux`),
  ADD KEY `idPlateforme` (`idPlateforme`);

--
-- Index pour la table `panier`
--
ALTER TABLE `panier`
  ADD PRIMARY KEY (`idPanier`),
  ADD KEY `idUser` (`idUser`);

--
-- Index pour la table `pegis`
--
ALTER TABLE `pegis`
  ADD PRIMARY KEY (`idPegi`);

--
-- Index pour la table `plateforme`
--
ALTER TABLE `plateforme`
  ADD PRIMARY KEY (`idPlateforme`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`idUser`),
  ADD UNIQUE KEY `pseudo` (`pseudo`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Index pour la table `voir_historique`
--
ALTER TABLE `voir_historique`
  ADD PRIMARY KEY (`idHistorique`,`idJeux`),
  ADD KEY `idHistorique` (`idHistorique`),
  ADD KEY `idJeux` (`idJeux`);

--
-- Index pour la table `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`idWishlist`),
  ADD KEY `idUser` (`idUser`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `commentaires`
--
ALTER TABLE `commentaires`
  MODIFY `idComentaire` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=369;

--
-- AUTO_INCREMENT pour la table `genre`
--
ALTER TABLE `genre`
  MODIFY `idGenre` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT pour la table `historique`
--
ALTER TABLE `historique`
  MODIFY `idHistorique` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=639;

--
-- AUTO_INCREMENT pour la table `jeux`
--
ALTER TABLE `jeux`
  MODIFY `idJeux` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT pour la table `pegis`
--
ALTER TABLE `pegis`
  MODIFY `idPegi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `plateforme`
--
ALTER TABLE `plateforme`
  MODIFY `idPlateforme` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `idUser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=639;

--
-- AUTO_INCREMENT pour la table `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `idWishlist` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=639;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `ajouter_panier`
--
ALTER TABLE `ajouter_panier`
  ADD CONSTRAINT `ajouter_panier_ibfk_1` FOREIGN KEY (`idJeux`) REFERENCES `jeux` (`idJeux`),
  ADD CONSTRAINT `ajouter_panier_ibfk_2` FOREIGN KEY (`idPanier`) REFERENCES `panier` (`idPanier`);

--
-- Contraintes pour la table `ajouter_wishlist`
--
ALTER TABLE `ajouter_wishlist`
  ADD CONSTRAINT `ajouter_wishlist_ibfk_1` FOREIGN KEY (`idJeux`) REFERENCES `jeux` (`idJeux`),
  ADD CONSTRAINT `ajouter_wishlist_ibfk_2` FOREIGN KEY (`idWishlist`) REFERENCES `wishlist` (`idWishlist`);

--
-- Contraintes pour la table `commentaires`
--
ALTER TABLE `commentaires`
  ADD CONSTRAINT `commentaires_ibfk_1` FOREIGN KEY (`idUser`) REFERENCES `user` (`idUser`),
  ADD CONSTRAINT `commentaires_ibfk_2` FOREIGN KEY (`idJeux`) REFERENCES `jeux` (`idJeux`);

--
-- Contraintes pour la table `filtre_jeux`
--
ALTER TABLE `filtre_jeux`
  ADD CONSTRAINT `filtre_jeux_ibfk_1` FOREIGN KEY (`idGenre`) REFERENCES `genre` (`idGenre`),
  ADD CONSTRAINT `filtre_jeux_ibfk_2` FOREIGN KEY (`idJeux`) REFERENCES `jeux` (`idJeux`);

--
-- Contraintes pour la table `historique`
--
ALTER TABLE `historique`
  ADD CONSTRAINT `historique_ibfk_1` FOREIGN KEY (`idUser`) REFERENCES `user` (`idUser`);

--
-- Contraintes pour la table `jeux`
--
ALTER TABLE `jeux`
  ADD CONSTRAINT `jeux_ibfk_1` FOREIGN KEY (`idPegi`) REFERENCES `pegis` (`idPegi`);

--
-- Contraintes pour la table `notes`
--
ALTER TABLE `notes`
  ADD CONSTRAINT `notes_ibfk_1` FOREIGN KEY (`idJeux`) REFERENCES `jeux` (`idJeux`),
  ADD CONSTRAINT `notes_ibfk_2` FOREIGN KEY (`idUser`) REFERENCES `user` (`idUser`);

--
-- Contraintes pour la table `ou_jouer`
--
ALTER TABLE `ou_jouer`
  ADD CONSTRAINT `ou_jouer_ibfk_1` FOREIGN KEY (`idPlateforme`) REFERENCES `plateforme` (`idPlateforme`),
  ADD CONSTRAINT `ou_jouer_ibfk_2` FOREIGN KEY (`idJeux`) REFERENCES `jeux` (`idJeux`);

--
-- Contraintes pour la table `panier`
--
ALTER TABLE `panier`
  ADD CONSTRAINT `panier_ibfk_1` FOREIGN KEY (`idUser`) REFERENCES `user` (`idUser`);

--
-- Contraintes pour la table `voir_historique`
--
ALTER TABLE `voir_historique`
  ADD CONSTRAINT `voir_historique_ibfk_1` FOREIGN KEY (`idHistorique`) REFERENCES `historique` (`idHistorique`),
  ADD CONSTRAINT `voir_historique_ibfk_2` FOREIGN KEY (`idJeux`) REFERENCES `jeux` (`idJeux`);

--
-- Contraintes pour la table `wishlist`
--
ALTER TABLE `wishlist`
  ADD CONSTRAINT `wishlist_ibfk_2` FOREIGN KEY (`idUser`) REFERENCES `user` (`idUser`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
