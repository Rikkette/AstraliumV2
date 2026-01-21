-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mer. 21 jan. 2026 à 16:13
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
-- Base de données : `astraliumv2`
--

-- --------------------------------------------------------

--
-- Structure de la table `aura_des`
--

CREATE TABLE `aura_des` (
  `blog_id` int(11) NOT NULL,
  `media_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `blog`
--

CREATE TABLE `blog` (
  `blog_id` int(11) NOT NULL,
  `blog_titre` varchar(50) NOT NULL,
  `blog_contenu` text NOT NULL,
  `blog_date_publi` date NOT NULL,
  `blog_description` varchar(50) DEFAULT NULL,
  `users_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

CREATE TABLE `categories` (
  `categorie_id` int(11) NOT NULL,
  `categorie_nom` varchar(50) NOT NULL,
  `categorie_description` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `clients`
--

CREATE TABLE `clients` (
  `clients_id` int(11) NOT NULL,
  `clients_prenom` varchar(50) NOT NULL,
  `clients_nom` varchar(50) NOT NULL,
  `clients_anniverssaire` date DEFAULT NULL,
  `adresse_adresse` varchar(50) NOT NULL,
  `adresse_ville` varchar(50) NOT NULL,
  `adresse_code_postale` int(11) NOT NULL,
  `adresse_pays` varchar(50) NOT NULL,
  `users_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `commande`
--

CREATE TABLE `commande` (
  `commande_id` int(11) NOT NULL,
  `commande_date` datetime NOT NULL,
  `commande_prix_ht_tva` decimal(19,4) NOT NULL,
  `commande_ttc` decimal(19,4) NOT NULL,
  `commande_quantite` decimal(19,4) DEFAULT NULL,
  `status_nom` varchar(50) DEFAULT NULL,
  `commande_num` varchar(10) NOT NULL,
  `clients_id` int(11) DEFAULT NULL,
  `coupon_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `commentaires`
--

CREATE TABLE `commentaires` (
  `commentaires_id` int(11) NOT NULL,
  `commentaire_libelle` text NOT NULL,
  `produits_id` int(11) NOT NULL,
  `clients_id` int(11) NOT NULL,
  `blog_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `coupon`
--

CREATE TABLE `coupon` (
  `coupon_id` int(11) NOT NULL,
  `coupon_code` varchar(50) NOT NULL,
  `coupon_date_fin` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `ligne_commande`
--

CREATE TABLE `ligne_commande` (
  `commande_id` int(11) NOT NULL,
  `promotions_id` int(11) NOT NULL,
  `produits_id` int(11) NOT NULL,
  `quantite` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `livraison`
--

CREATE TABLE `livraison` (
  `livraison_id` int(11) NOT NULL,
  `livraison_option` varchar(50) NOT NULL,
  `livraison_status` varchar(50) NOT NULL,
  `livraison_numero_suivis` varchar(50) NOT NULL,
  `livraison_transporteur` varchar(50) DEFAULT NULL,
  `commande_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `media`
--

CREATE TABLE `media` (
  `media_id` int(11) NOT NULL,
  `media_libelle` tinyint(1) NOT NULL,
  `produits_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `paiement`
--

CREATE TABLE `paiement` (
  `paiement_id` int(11) NOT NULL,
  `paiement_montant` decimal(19,4) NOT NULL,
  `paiement_status` varchar(50) NOT NULL,
  `paiement_date` datetime NOT NULL,
  `type_paiement_id` int(11) NOT NULL,
  `commande_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `produits`
--

CREATE TABLE `produits` (
  `produits_id` int(11) NOT NULL,
  `produits_nom` varchar(50) NOT NULL,
  `produits_description` varchar(50) DEFAULT NULL,
  `produits_prix` decimal(19,4) NOT NULL,
  `produits_promotions` varchar(50) DEFAULT NULL,
  `produits_quantitees` int(11) NOT NULL,
  `categorie_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `promotions`
--

CREATE TABLE `promotions` (
  `promotions_id` int(11) NOT NULL,
  `promotions_pourcentage` int(11) DEFAULT NULL,
  `promotions_date_debut` date NOT NULL,
  `promotions_date_fin` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `type_paiement`
--

CREATE TABLE `type_paiement` (
  `type_paiement_id` int(11) NOT NULL,
  `type_paiement_libelle` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `type_role`
--

CREATE TABLE `type_role` (
  `type_role_id` int(11) NOT NULL,
  `type_libelle` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `users_id` int(11) NOT NULL,
  `users_email` varchar(50) NOT NULL,
  `users_password` varchar(50) NOT NULL,
  `type_role_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `aura_des`
--
ALTER TABLE `aura_des`
  ADD PRIMARY KEY (`blog_id`,`media_id`),
  ADD KEY `media_id` (`media_id`);

--
-- Index pour la table `blog`
--
ALTER TABLE `blog`
  ADD PRIMARY KEY (`blog_id`),
  ADD KEY `users_id` (`users_id`);

--
-- Index pour la table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`categorie_id`);

--
-- Index pour la table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`clients_id`),
  ADD UNIQUE KEY `users_id` (`users_id`);

--
-- Index pour la table `commande`
--
ALTER TABLE `commande`
  ADD PRIMARY KEY (`commande_id`),
  ADD KEY `clients_id` (`clients_id`),
  ADD KEY `coupon_id` (`coupon_id`);

--
-- Index pour la table `commentaires`
--
ALTER TABLE `commentaires`
  ADD PRIMARY KEY (`commentaires_id`),
  ADD KEY `produits_id` (`produits_id`),
  ADD KEY `clients_id` (`clients_id`),
  ADD KEY `blog_id` (`blog_id`);

--
-- Index pour la table `coupon`
--
ALTER TABLE `coupon`
  ADD PRIMARY KEY (`coupon_id`);

--
-- Index pour la table `ligne_commande`
--
ALTER TABLE `ligne_commande`
  ADD PRIMARY KEY (`commande_id`,`promotions_id`,`produits_id`),
  ADD KEY `promotions_id` (`promotions_id`),
  ADD KEY `produits_id` (`produits_id`);

--
-- Index pour la table `livraison`
--
ALTER TABLE `livraison`
  ADD PRIMARY KEY (`livraison_id`),
  ADD KEY `commande_id` (`commande_id`);

--
-- Index pour la table `media`
--
ALTER TABLE `media`
  ADD PRIMARY KEY (`media_id`),
  ADD KEY `produits_id` (`produits_id`);

--
-- Index pour la table `paiement`
--
ALTER TABLE `paiement`
  ADD PRIMARY KEY (`paiement_id`),
  ADD KEY `type_paiement_id` (`type_paiement_id`),
  ADD KEY `commande_id` (`commande_id`);

--
-- Index pour la table `produits`
--
ALTER TABLE `produits`
  ADD PRIMARY KEY (`produits_id`),
  ADD KEY `categorie_id` (`categorie_id`);

--
-- Index pour la table `promotions`
--
ALTER TABLE `promotions`
  ADD PRIMARY KEY (`promotions_id`);

--
-- Index pour la table `type_paiement`
--
ALTER TABLE `type_paiement`
  ADD PRIMARY KEY (`type_paiement_id`);

--
-- Index pour la table `type_role`
--
ALTER TABLE `type_role`
  ADD PRIMARY KEY (`type_role_id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`users_id`),
  ADD KEY `type_role_id` (`type_role_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `blog`
--
ALTER TABLE `blog`
  MODIFY `blog_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `categories`
--
ALTER TABLE `categories`
  MODIFY `categorie_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `clients`
--
ALTER TABLE `clients`
  MODIFY `clients_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `commande`
--
ALTER TABLE `commande`
  MODIFY `commande_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `commentaires`
--
ALTER TABLE `commentaires`
  MODIFY `commentaires_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `coupon`
--
ALTER TABLE `coupon`
  MODIFY `coupon_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `livraison`
--
ALTER TABLE `livraison`
  MODIFY `livraison_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `media`
--
ALTER TABLE `media`
  MODIFY `media_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `paiement`
--
ALTER TABLE `paiement`
  MODIFY `paiement_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `produits`
--
ALTER TABLE `produits`
  MODIFY `produits_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `promotions`
--
ALTER TABLE `promotions`
  MODIFY `promotions_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `type_paiement`
--
ALTER TABLE `type_paiement`
  MODIFY `type_paiement_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `type_role`
--
ALTER TABLE `type_role`
  MODIFY `type_role_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `users_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `aura_des`
--
ALTER TABLE `aura_des`
  ADD CONSTRAINT `aura_des_ibfk_1` FOREIGN KEY (`blog_id`) REFERENCES `blog` (`blog_id`),
  ADD CONSTRAINT `aura_des_ibfk_2` FOREIGN KEY (`media_id`) REFERENCES `media` (`media_id`);

--
-- Contraintes pour la table `blog`
--
ALTER TABLE `blog`
  ADD CONSTRAINT `blog_ibfk_1` FOREIGN KEY (`users_id`) REFERENCES `users` (`users_id`);

--
-- Contraintes pour la table `clients`
--
ALTER TABLE `clients`
  ADD CONSTRAINT `clients_ibfk_1` FOREIGN KEY (`users_id`) REFERENCES `users` (`users_id`);

--
-- Contraintes pour la table `commande`
--
ALTER TABLE `commande`
  ADD CONSTRAINT `commande_ibfk_1` FOREIGN KEY (`clients_id`) REFERENCES `clients` (`clients_id`),
  ADD CONSTRAINT `commande_ibfk_2` FOREIGN KEY (`coupon_id`) REFERENCES `coupon` (`coupon_id`);

--
-- Contraintes pour la table `commentaires`
--
ALTER TABLE `commentaires`
  ADD CONSTRAINT `commentaires_ibfk_1` FOREIGN KEY (`produits_id`) REFERENCES `produits` (`produits_id`),
  ADD CONSTRAINT `commentaires_ibfk_2` FOREIGN KEY (`clients_id`) REFERENCES `clients` (`clients_id`),
  ADD CONSTRAINT `commentaires_ibfk_3` FOREIGN KEY (`blog_id`) REFERENCES `blog` (`blog_id`);

--
-- Contraintes pour la table `ligne_commande`
--
ALTER TABLE `ligne_commande`
  ADD CONSTRAINT `ligne_commande_ibfk_1` FOREIGN KEY (`commande_id`) REFERENCES `commande` (`commande_id`),
  ADD CONSTRAINT `ligne_commande_ibfk_2` FOREIGN KEY (`promotions_id`) REFERENCES `promotions` (`promotions_id`),
  ADD CONSTRAINT `ligne_commande_ibfk_3` FOREIGN KEY (`produits_id`) REFERENCES `produits` (`produits_id`);

--
-- Contraintes pour la table `livraison`
--
ALTER TABLE `livraison`
  ADD CONSTRAINT `livraison_ibfk_1` FOREIGN KEY (`commande_id`) REFERENCES `commande` (`commande_id`);

--
-- Contraintes pour la table `media`
--
ALTER TABLE `media`
  ADD CONSTRAINT `media_ibfk_1` FOREIGN KEY (`produits_id`) REFERENCES `produits` (`produits_id`);

--
-- Contraintes pour la table `paiement`
--
ALTER TABLE `paiement`
  ADD CONSTRAINT `paiement_ibfk_1` FOREIGN KEY (`type_paiement_id`) REFERENCES `type_paiement` (`type_paiement_id`),
  ADD CONSTRAINT `paiement_ibfk_2` FOREIGN KEY (`commande_id`) REFERENCES `commande` (`commande_id`);

--
-- Contraintes pour la table `produits`
--
ALTER TABLE `produits`
  ADD CONSTRAINT `produits_ibfk_1` FOREIGN KEY (`categorie_id`) REFERENCES `categories` (`categorie_id`);

--
-- Contraintes pour la table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`type_role_id`) REFERENCES `type_role` (`type_role_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
