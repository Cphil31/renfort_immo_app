-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mar. 04 avr. 2023 à 15:04
-- Version du serveur : 5.7.40
-- Version de PHP : 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `commerce`
--
CREATE DATABASE IF NOT EXISTS `commerce` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `commerce`;

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

DROP TABLE IF EXISTS `categorie`;
CREATE TABLE IF NOT EXISTS `categorie` (
  `id_categorie` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id_categorie`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `categorie`
--

INSERT INTO `categorie` (`id_categorie`, `nom`) VALUES
(1, 'Alpinisme'),
(2, 'Randonnée'),
(3, 'Escalade');

-- --------------------------------------------------------

--
-- Structure de la table `produit`
--

DROP TABLE IF EXISTS `produit`;
CREATE TABLE IF NOT EXISTS `produit` (
  `id_produit` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_categorie` int(10) UNSIGNED DEFAULT NULL,
  `nom` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ref` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `prix` decimal(8,2) DEFAULT NULL,
  PRIMARY KEY (`id_produit`),
  KEY `id_categorie` (`id_categorie`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `produit`
--

INSERT INTO `produit` (`id_produit`, `id_categorie`, `nom`, `ref`, `prix`) VALUES
(1, 1, 'Weisshorn', '210317 729', '399.95'),
(2, 1, 'Cevedale Pro', '210050 609', '240.95'),
(3, 1, 'Mountain Expert Evo', '210029 309', '297.41'),
(4, 2, 'Renegade', '310945 426', '132.90'),
(5, 2, 'Siesto', '310551 974', '119.96'),
(6, 2, 'Bormio', '310914 967', '127.46'),
(7, 2, 'Renegade Lo', '320960 034', '105.00'),
(8, 3, 'Falco VCR', '430100 972', '116.96'),
(9, 3, 'Rocket', '430117 990', '125.96'),
(10, 3, 'X Boulder', '430112 303', '180.00');

-- --------------------------------------------------------

--
-- Structure de la table `session`
--

DROP TABLE IF EXISTS `session`;
CREATE TABLE IF NOT EXISTS `session` (
  `sid` char(32) COLLATE utf8mb4_unicode_ci NOT NULL,
  `data` mediumtext COLLATE utf8mb4_unicode_ci,
  `date_maj` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`sid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `session`
--

INSERT INTO `session` (`sid`, `data`, `date_maj`) VALUES
('gnfksr431fcj0260lagg9qp1eus5hohi', '', '2019-06-03 15:36:39'),
('lvkvdtmv0ahthnjuv29n0o8fa1', '', '2023-01-25 16:03:36');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id_user` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `log` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `mdp` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `nom` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `prenom` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id_user`, `log`, `mdp`, `nom`, `prenom`) VALUES
(1, 'max', '$2y$10$3Rlaisb.kmS.7A2qQsvNmeu9CQAYVBE.uN/NftKXd.1s.WrQOkn1q', 'LEFORT', 'Max'),
(2, 'tom', '$2y$10$FTArW9RUQgHXUYPFllNEYe8QZr5IJ45YROyklQs5tN7GuCRZ.hF2y', 'LEGRAND', 'Tom');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `produit`
--
ALTER TABLE `produit`
  ADD CONSTRAINT `produit_ibfk_1` FOREIGN KEY (`id_categorie`) REFERENCES `categorie` (`id_categorie`);
--
-- Base de données : `renfortimmo`
--
CREATE DATABASE IF NOT EXISTS `renfortimmo` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `renfortimmo`;

-- --------------------------------------------------------

--
-- Structure de la table `adresse`
--

DROP TABLE IF EXISTS `adresse`;
CREATE TABLE IF NOT EXISTS `adresse` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `statut_id` int(11) NOT NULL,
  `contact_id` int(11) DEFAULT NULL,
  `produit_id` int(11) DEFAULT NULL,
  `entreprise_id` int(11) DEFAULT NULL,
  `rue` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `code_postal` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ville` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `departement` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `region` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pays` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `facturation` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_C35F0816F6203804` (`statut_id`),
  KEY `IDX_C35F0816E7A1254A` (`contact_id`),
  KEY `IDX_C35F0816F347EFB` (`produit_id`),
  KEY `IDX_C35F0816A4AEAFEA` (`entreprise_id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `adresse`
--

INSERT INTO `adresse` (`id`, `statut_id`, `contact_id`, `produit_id`, `entreprise_id`, `rue`, `code_postal`, `ville`, `departement`, `region`, `pays`, `facturation`) VALUES
(1, 2, 2, NULL, NULL, '11 , place des coquelicots', '31330', 'Larra', 'Haute garonne', NULL, 'France', 1),
(5, 2, 1, NULL, NULL, '11 place des coquelicots', '31330', 'Larra', 'Occitanie', NULL, NULL, 1),
(6, 1, 1, NULL, NULL, '2 rue des fleurs', '31000', 'toulouse', NULL, NULL, NULL, 0),
(17, 1, 2, NULL, NULL, '453 rue des sols', '31000', 'Toulouse', NULL, NULL, NULL, 0),
(19, 1, 1, NULL, NULL, '32 rue de la pagaille', '31330', 'Toulouse', NULL, NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Structure de la table `analyse`
--

DROP TABLE IF EXISTS `analyse`;
CREATE TABLE IF NOT EXISTS `analyse` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `produit_id` int(11) NOT NULL,
  `titre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `observations` longtext COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`id`),
  KEY `IDX_351B0C7EF347EFB` (`produit_id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `analyse`
--

INSERT INTO `analyse` (`id`, `produit_id`, `titre`, `description`, `observations`) VALUES
(12, 4, 'Analyse 1', 'djzehyeuozrihy', 'dsofhieziorfhezdk'),
(13, 3, 'Analyse 1', '-Prévoir un 2e accès pour entrée sortie', NULL),
(14, 3, '2', '-vérifier limites avec le voisin', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `appels_recus`
--

DROP TABLE IF EXISTS `appels_recus`;
CREATE TABLE IF NOT EXISTS `appels_recus` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `contact_id` int(11) DEFAULT NULL,
  `mission_id` int(11) DEFAULT NULL,
  `date` datetime NOT NULL,
  `objet` longtext COLLATE utf8mb4_unicode_ci,
  `appeller` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_2F9E5C3AE7A1254A` (`contact_id`),
  KEY `IDX_2F9E5C3ABE6CAE90` (`mission_id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `appels_recus`
--

INSERT INTO `appels_recus` (`id`, `contact_id`, `mission_id`, `date`, `objet`, `appeller`) VALUES
(3, 3, 3, '2023-01-03 12:04:40', 'appelk', NULL),
(4, 2, 3, '2023-01-01 12:04:40', 'appel', NULL),
(8, 1, 3, '2023-01-03 18:38:00', 'sdfsfsd', 0),
(9, 3, 3, '2023-01-03 18:03:00', 'rappeler le notaire', 0),
(10, 3, 3, '2023-01-03 20:03:00', 'SDQs', 0),
(11, 3, 3, '2023-02-10 14:57:00', 'Aucun', 1),
(13, 3, 3, '2023-02-10 14:57:00', 'Aucun', 1);

-- --------------------------------------------------------

--
-- Structure de la table `communication`
--

DROP TABLE IF EXISTS `communication`;
CREATE TABLE IF NOT EXISTS `communication` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tache_id` int(11) NOT NULL,
  `statut_id` int(11) NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `forfait` decimal(10,2) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_F9AFB5EBD2235D39` (`tache_id`),
  KEY `IDX_F9AFB5EBF6203804` (`statut_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `contact`
--

DROP TABLE IF EXISTS `contact`;
CREATE TABLE IF NOT EXISTS `contact` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `prenom` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `contact`
--

INSERT INTO `contact` (`id`, `nom`, `prenom`) VALUES
(1, 'Sanachy', 'Patrice'),
(2, 'CECILE', 'Philippe'),
(3, 'Bali', 'Balo'),
(4, 'Borne', 'Jean');

-- --------------------------------------------------------

--
-- Structure de la table `deplacement`
--

DROP TABLE IF EXISTS `deplacement`;
CREATE TABLE IF NOT EXISTS `deplacement` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tache_id` int(11) DEFAULT NULL,
  `statut_id` int(11) DEFAULT NULL,
  `lieu` longtext COLLATE utf8mb4_unicode_ci,
  `date` datetime DEFAULT NULL,
  `duree` time DEFAULT NULL,
  `cout` decimal(10,2) DEFAULT NULL,
  `cout_peage` decimal(10,2) DEFAULT NULL,
  `cout_carburant` decimal(10,2) DEFAULT NULL,
  `observation` longtext COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`id`),
  KEY `IDX_1296FAC2D2235D39` (`tache_id`),
  KEY `IDX_1296FAC2F6203804` (`statut_id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `devis`
--

DROP TABLE IF EXISTS `devis`;
CREATE TABLE IF NOT EXISTS `devis` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mission_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date DEFAULT NULL,
  `client_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_8B27C52BBE6CAE90` (`mission_id`),
  KEY `IDX_8B27C52B19EB6921` (`client_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `devis`
--

INSERT INTO `devis` (`id`, `mission_id`, `name`, `date`, `client_id`) VALUES
(2, 3, 'Larra 1', '2023-03-31', 2),
(3, 3, 'Alea', '2023-03-17', 4);

-- --------------------------------------------------------

--
-- Structure de la table `doctrine_migration_versions`
--

DROP TABLE IF EXISTS `doctrine_migration_versions`;
CREATE TABLE IF NOT EXISTS `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20230404124912', '2023-04-04 12:49:20', 67);

-- --------------------------------------------------------

--
-- Structure de la table `document`
--

DROP TABLE IF EXISTS `document`;
CREATE TABLE IF NOT EXISTS `document` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tache_id` int(11) DEFAULT NULL,
  `name` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cout_achat_document` decimal(10,2) DEFAULT NULL,
  `cout_document_commande` decimal(10,2) DEFAULT NULL,
  `cout_document_produit` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_D8698A76D2235D39` (`tache_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `entreprise`
--

DROP TABLE IF EXISTS `entreprise`;
CREATE TABLE IF NOT EXISTS `entreprise` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `statut_id` int(11) NOT NULL,
  `raison_sociale` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `siret` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `naf` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_D19FA60F6203804` (`statut_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `entreprise`
--

INSERT INTO `entreprise` (`id`, `statut_id`, `raison_sociale`, `siret`, `naf`) VALUES
(1, 2, 'Focus', '123-1325-123', NULL),
(2, 2, 'ISC', NULL, NULL),
(3, 1, 'sdsdfsd', 'sdfsd', 'sdfsdf');

-- --------------------------------------------------------

--
-- Structure de la table `etat`
--

DROP TABLE IF EXISTS `etat`;
CREATE TABLE IF NOT EXISTS `etat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `etat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `etat`
--

INSERT INTO `etat` (`id`, `etat`) VALUES
(1, 'à construire'),
(2, 'Vétuste'),
(3, 'à rénover'),
(4, 'à détruire'),
(5, 'à trouver'),
(6, 'à acheter');

-- --------------------------------------------------------

--
-- Structure de la table `etat_des_lieux`
--

DROP TABLE IF EXISTS `etat_des_lieux`;
CREATE TABLE IF NOT EXISTS `etat_des_lieux` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `statut_id` int(11) NOT NULL,
  `produit_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `observation` longtext COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`id`),
  KEY `IDX_F7210312F6203804` (`statut_id`),
  KEY `IDX_F7210312F347EFB` (`produit_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `etat_des_lieux`
--

INSERT INTO `etat_des_lieux` (`id`, `statut_id`, `produit_id`, `created_at`, `observation`) VALUES
(1, 1, 3, '2023-03-06 00:00:00', 'mettre en place les bornes'),
(4, 22, 5, '2018-01-01 00:00:00', 'Hello dous'),
(5, 13, 3, '2018-01-01 00:00:00', 'Aucun couloir');

-- --------------------------------------------------------

--
-- Structure de la table `forfait`
--

DROP TABLE IF EXISTS `forfait`;
CREATE TABLE IF NOT EXISTS `forfait` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tache_id` int(11) NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `prix` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_BBB5C482D2235D39` (`tache_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `hebergement`
--

DROP TABLE IF EXISTS `hebergement`;
CREATE TABLE IF NOT EXISTS `hebergement` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tache_id` int(11) DEFAULT NULL,
  `nuit` int(11) NOT NULL,
  `cout_nuit_unitaire` decimal(5,2) NOT NULL,
  `lieu` longtext COLLATE utf8mb4_unicode_ci,
  `date` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_4852DD9CD2235D39` (`tache_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `historique`
--

DROP TABLE IF EXISTS `historique`;
CREATE TABLE IF NOT EXISTS `historique` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `contact_id` int(11) DEFAULT NULL,
  `entreprise_id` int(11) DEFAULT NULL,
  `produit_id` int(11) DEFAULT NULL,
  `historique` longtext COLLATE utf8mb4_unicode_ci,
  `title` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  PRIMARY KEY (`id`),
  KEY `IDX_EDBFD5ECE7A1254A` (`contact_id`),
  KEY `IDX_EDBFD5ECA4AEAFEA` (`entreprise_id`),
  KEY `IDX_EDBFD5ECF347EFB` (`produit_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `historique`
--

INSERT INTO `historique` (`id`, `contact_id`, `entreprise_id`, `produit_id`, `historique`, `title`, `created_at`) VALUES
(5, NULL, NULL, 3, 'Famille compliquée , contacter le père', 'Historique 1', '2022-12-15 14:12:12'),
(6, NULL, NULL, 4, 'Hello le monde', 'Historique 123', '2022-12-15 15:05:19'),
(10, NULL, NULL, 5, 'Tout cela n\'est pas en bon etat', 'h1', '2023-03-06 10:01:55'),
(11, NULL, NULL, 5, 'eta', 'h2', '2023-03-06 10:07:56');

-- --------------------------------------------------------

--
-- Structure de la table `identification`
--

DROP TABLE IF EXISTS `identification`;
CREATE TABLE IF NOT EXISTS `identification` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `identification` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `identification`
--

INSERT INTO `identification` (`id`, `identification`) VALUES
(1, 'Foncier'),
(2, 'Immeuble'),
(3, 'Foncier+Immeuble'),
(4, 'Infrastructure'),
(5, 'autre');

-- --------------------------------------------------------

--
-- Structure de la table `intervenant`
--

DROP TABLE IF EXISTS `intervenant`;
CREATE TABLE IF NOT EXISTS `intervenant` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `produit_id` int(11) DEFAULT NULL,
  `tache_id` int(11) DEFAULT NULL,
  `statut_id` int(11) NOT NULL,
  `entreprise_id` int(11) DEFAULT NULL,
  `contact_id` int(11) DEFAULT NULL,
  `observation` longtext COLLATE utf8mb4_unicode_ci,
  `cout` decimal(10,2) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `realisations` longtext COLLATE utf8mb4_unicode_ci,
  `duree` time DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_73D0145CF347EFB` (`produit_id`),
  KEY `IDX_73D0145CD2235D39` (`tache_id`),
  KEY `IDX_73D0145CF6203804` (`statut_id`),
  KEY `IDX_73D0145CA4AEAFEA` (`entreprise_id`),
  KEY `IDX_73D0145CE7A1254A` (`contact_id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `intervenant`
--

INSERT INTO `intervenant` (`id`, `produit_id`, `tache_id`, `statut_id`, `entreprise_id`, `contact_id`, `observation`, `cout`, `date`, `realisations`, `duree`) VALUES
(10, 3, NULL, 2, NULL, 3, NULL, NULL, NULL, NULL, NULL),
(11, 3, NULL, 1, NULL, 2, NULL, NULL, NULL, NULL, NULL),
(12, 5, NULL, 1, NULL, 3, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `mail`
--

DROP TABLE IF EXISTS `mail`;
CREATE TABLE IF NOT EXISTS `mail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `statut_id` int(11) NOT NULL,
  `contact_id` int(11) NOT NULL,
  `entreprise_id` int(11) DEFAULT NULL,
  `mission_id` int(11) DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `objet` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci,
  `created_at` datetime DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)',
  PRIMARY KEY (`id`),
  KEY `IDX_5126AC48F6203804` (`statut_id`),
  KEY `IDX_5126AC48E7A1254A` (`contact_id`),
  KEY `IDX_5126AC48A4AEAFEA` (`entreprise_id`),
  KEY `IDX_5126AC48BE6CAE90` (`mission_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `messenger_messages`
--

DROP TABLE IF EXISTS `messenger_messages`;
CREATE TABLE IF NOT EXISTS `messenger_messages` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `body` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `headers` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue_name` varchar(190) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `available_at` datetime NOT NULL,
  `delivered_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_75EA56E0FB7336F0` (`queue_name`),
  KEY `IDX_75EA56E0E3BD61CE` (`available_at`),
  KEY `IDX_75EA56E016BA31DB` (`delivered_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `mission`
--

DROP TABLE IF EXISTS `mission`;
CREATE TABLE IF NOT EXISTS `mission` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `reference` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `localisation` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `stade` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `mission`
--

INSERT INTO `mission` (`id`, `name`, `reference`, `localisation`, `stade`) VALUES
(3, 'Larra - 1', 'bibi', 'Larra', 'En bon état');

-- --------------------------------------------------------

--
-- Structure de la table `mission_produit`
--

DROP TABLE IF EXISTS `mission_produit`;
CREATE TABLE IF NOT EXISTS `mission_produit` (
  `mission_id` int(11) NOT NULL,
  `produit_id` int(11) NOT NULL,
  PRIMARY KEY (`mission_id`,`produit_id`),
  KEY `IDX_B899786ABE6CAE90` (`mission_id`),
  KEY `IDX_B899786AF347EFB` (`produit_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `mission_produit`
--

INSERT INTO `mission_produit` (`mission_id`, `produit_id`) VALUES
(3, 3);

-- --------------------------------------------------------

--
-- Structure de la table `moyen`
--

DROP TABLE IF EXISTS `moyen`;
CREATE TABLE IF NOT EXISTS `moyen` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tache_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_2D6523D6D2235D39` (`tache_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `note`
--

DROP TABLE IF EXISTS `note`;
CREATE TABLE IF NOT EXISTS `note` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `contact_id` int(11) DEFAULT NULL,
  `entreprise_id` int(11) DEFAULT NULL,
  `note` longtext COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`id`),
  KEY `IDX_CFBDFA14E7A1254A` (`contact_id`),
  KEY `IDX_CFBDFA14A4AEAFEA` (`entreprise_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `note`
--

INSERT INTO `note` (`id`, `contact_id`, `entreprise_id`, `note`) VALUES
(1, 4, NULL, 'géomètre 23');

-- --------------------------------------------------------

--
-- Structure de la table `probleme`
--

DROP TABLE IF EXISTS `probleme`;
CREATE TABLE IF NOT EXISTS `probleme` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mission_id` int(11) NOT NULL,
  `statut_id` int(11) NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_7AB2D714F6203804` (`statut_id`),
  KEY `IDX_7AB2D714BE6CAE90` (`mission_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `probleme`
--

INSERT INTO `probleme` (`id`, `mission_id`, `statut_id`, `description`) VALUES
(9, 3, 1, 'Borne');

-- --------------------------------------------------------

--
-- Structure de la table `produit`
--

DROP TABLE IF EXISTS `produit`;
CREATE TABLE IF NOT EXISTS `produit` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `etat_id` int(11) DEFAULT NULL,
  `identification_id` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `localisation` longtext COLLATE utf8mb4_unicode_ci,
  `car_techniques` longtext COLLATE utf8mb4_unicode_ci,
  `car_juridiques` longtext COLLATE utf8mb4_unicode_ci,
  `car_commerciales` longtext COLLATE utf8mb4_unicode_ci,
  `environement` longtext COLLATE utf8mb4_unicode_ci,
  `observation` longtext COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`id`),
  KEY `IDX_29A5EC27D5E86FF` (`etat_id`),
  KEY `IDX_29A5EC274DFE3A85` (`identification_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `produit`
--

INSERT INTO `produit` (`id`, `etat_id`, `identification_id`, `name`, `localisation`, `car_techniques`, `car_juridiques`, `car_commerciales`, `environement`, `observation`) VALUES
(3, 1, 1, 'Larra Maison 1', 'larra*1', 'Bornes à retracer', 'Terrain dans l\'indivision', 'vendu 1 fois gjfgtfhg', 'Terrain encombré de déchets', 'bulbul'),
(4, 2, 1, 'Lyon 1', 'Lyon en périphérique', NULL, NULL, NULL, NULL, NULL),
(5, 3, 3, 'Le domaine de séverain', NULL, 'Hello doudou', 'indivision', 'A un fort potentiel de vente', NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `profession`
--

DROP TABLE IF EXISTS `profession`;
CREATE TABLE IF NOT EXISTS `profession` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `entreprise_id` int(11) DEFAULT NULL,
  `contact_id` int(11) DEFAULT NULL,
  `profession` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `poste` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_BA930D69A4AEAFEA` (`entreprise_id`),
  KEY `IDX_BA930D69E7A1254A` (`contact_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `restauration`
--

DROP TABLE IF EXISTS `restauration`;
CREATE TABLE IF NOT EXISTS `restauration` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tache_id` int(11) DEFAULT NULL,
  `cout_repas_personnel` decimal(10,0) DEFAULT NULL,
  `cout_repas_clients` decimal(10,2) DEFAULT NULL,
  `duree` time DEFAULT NULL,
  `forfait` decimal(10,2) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `etablissement` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_898B1EF1D2235D39` (`tache_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `reunion`
--

DROP TABLE IF EXISTS `reunion`;
CREATE TABLE IF NOT EXISTS `reunion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tache_id` int(11) NOT NULL,
  `objet` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date` date DEFAULT NULL,
  `content` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cout_location_salle` decimal(10,2) DEFAULT NULL,
  `cout_location_materiel` decimal(10,2) DEFAULT NULL,
  `cout_restauration` decimal(10,2) DEFAULT NULL,
  `cout_collation` decimal(10,2) DEFAULT NULL,
  `duree` time DEFAULT NULL,
  `forfait_horaire` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_5B00A482D2235D39` (`tache_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `statut_adresse`
--

DROP TABLE IF EXISTS `statut_adresse`;
CREATE TABLE IF NOT EXISTS `statut_adresse` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `statut` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `statut_adresse`
--

INSERT INTO `statut_adresse` (`id`, `statut`) VALUES
(1, 'bureau'),
(2, 'domicile'),
(3, 'portable');

-- --------------------------------------------------------

--
-- Structure de la table `statut_communication`
--

DROP TABLE IF EXISTS `statut_communication`;
CREATE TABLE IF NOT EXISTS `statut_communication` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `statut` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `statut_communication`
--

INSERT INTO `statut_communication` (`id`, `statut`) VALUES
(1, 'Appel'),
(2, 'Mail'),
(3, 'Courrier');

-- --------------------------------------------------------

--
-- Structure de la table `statut_contact`
--

DROP TABLE IF EXISTS `statut_contact`;
CREATE TABLE IF NOT EXISTS `statut_contact` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `statut` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `statut_deplacement`
--

DROP TABLE IF EXISTS `statut_deplacement`;
CREATE TABLE IF NOT EXISTS `statut_deplacement` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `statut` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `statut_deplacement`
--

INSERT INTO `statut_deplacement` (`id`, `statut`) VALUES
(1, 'Voiture '),
(2, 'Taxi '),
(3, 'Train'),
(4, 'Tram'),
(5, 'Métro'),
(6, 'Avion');

-- --------------------------------------------------------

--
-- Structure de la table `statut_entreprise`
--

DROP TABLE IF EXISTS `statut_entreprise`;
CREATE TABLE IF NOT EXISTS `statut_entreprise` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `statut` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `statut_entreprise`
--

INSERT INTO `statut_entreprise` (`id`, `statut`) VALUES
(1, 'Sarl'),
(2, 'Eurl'),
(3, 'SAS');

-- --------------------------------------------------------

--
-- Structure de la table `statut_etat_des_lieux`
--

DROP TABLE IF EXISTS `statut_etat_des_lieux`;
CREATE TABLE IF NOT EXISTS `statut_etat_des_lieux` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `statut` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `statut_etat_des_lieux`
--

INSERT INTO `statut_etat_des_lieux` (`id`, `statut`) VALUES
(1, 'les bornes'),
(2, 'électricité'),
(3, 'eau potable'),
(4, 'servitudes de passage'),
(5, 'servitudes de réseaux'),
(6, 'nuisances sonores'),
(7, 'nuisances olfactives'),
(8, 'clôtures'),
(9, 'composition et état des bâtiments'),
(10, 'accès et praticabilité'),
(11, 'Inondations'),
(12, 'problèmes de voisinage'),
(13, 'couloir aérien'),
(14, 'emplacement réservé'),
(15, 'projet à proximité'),
(16, 'risque incendie'),
(17, 'abf'),
(18, 'diagnostic archéologique'),
(19, 'contact des voisins'),
(20, 'contacts adm'),
(21, 'stationnement et parking nb'),
(22, 'Histoire du secteur et du site'),
(23, 'indices de valorisation du site'),
(24, 'autres');

-- --------------------------------------------------------

--
-- Structure de la table `statut_intervenant`
--

DROP TABLE IF EXISTS `statut_intervenant`;
CREATE TABLE IF NOT EXISTS `statut_intervenant` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `statut` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `statut_intervenant`
--

INSERT INTO `statut_intervenant` (`id`, `statut`) VALUES
(1, 'Contact'),
(2, 'Mandant'),
(3, 'Proprio');

-- --------------------------------------------------------

--
-- Structure de la table `statut_mail`
--

DROP TABLE IF EXISTS `statut_mail`;
CREATE TABLE IF NOT EXISTS `statut_mail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `statut` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `statut_mail`
--

INSERT INTO `statut_mail` (`id`, `statut`) VALUES
(1, 'Personnel'),
(2, 'Professionnel\r\n');

-- --------------------------------------------------------

--
-- Structure de la table `statut_probleme`
--

DROP TABLE IF EXISTS `statut_probleme`;
CREATE TABLE IF NOT EXISTS `statut_probleme` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `statut` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `statut_probleme`
--

INSERT INTO `statut_probleme` (`id`, `statut`) VALUES
(1, 'Juridique\r\n'),
(2, 'Technique'),
(3, 'Commerciale\r\n');

-- --------------------------------------------------------

--
-- Structure de la table `statut_telephone`
--

DROP TABLE IF EXISTS `statut_telephone`;
CREATE TABLE IF NOT EXISTS `statut_telephone` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `statut` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `statut_telephone`
--

INSERT INTO `statut_telephone` (`id`, `statut`) VALUES
(1, 'Domicile'),
(2, 'Portable'),
(3, 'Bureau');

-- --------------------------------------------------------

--
-- Structure de la table `tache`
--

DROP TABLE IF EXISTS `tache`;
CREATE TABLE IF NOT EXISTS `tache` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `probleme_id` int(11) NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`id`),
  KEY `IDX_9387207596784F9E` (`probleme_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `telephone`
--

DROP TABLE IF EXISTS `telephone`;
CREATE TABLE IF NOT EXISTS `telephone` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `statut_id` int(11) NOT NULL,
  `entreprise_id` int(11) DEFAULT NULL,
  `contact_id` int(11) DEFAULT NULL,
  `number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `observation` longtext COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`id`),
  KEY `IDX_450FF010F6203804` (`statut_id`),
  KEY `IDX_450FF010A4AEAFEA` (`entreprise_id`),
  KEY `IDX_450FF010E7A1254A` (`contact_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `telephone`
--

INSERT INTO `telephone` (`id`, `statut_id`, `entreprise_id`, `contact_id`, `number`, `observation`) VALUES
(1, 2, NULL, 2, '07 89 54 86 28', NULL);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `adresse`
--
ALTER TABLE `adresse`
  ADD CONSTRAINT `FK_C35F0816A4AEAFEA` FOREIGN KEY (`entreprise_id`) REFERENCES `entreprise` (`id`),
  ADD CONSTRAINT `FK_C35F0816E7A1254A` FOREIGN KEY (`contact_id`) REFERENCES `contact` (`id`),
  ADD CONSTRAINT `FK_C35F0816F347EFB` FOREIGN KEY (`produit_id`) REFERENCES `produit` (`id`),
  ADD CONSTRAINT `FK_C35F0816F6203804` FOREIGN KEY (`statut_id`) REFERENCES `statut_adresse` (`id`);

--
-- Contraintes pour la table `analyse`
--
ALTER TABLE `analyse`
  ADD CONSTRAINT `FK_351B0C7EF347EFB` FOREIGN KEY (`produit_id`) REFERENCES `produit` (`id`);

--
-- Contraintes pour la table `appels_recus`
--
ALTER TABLE `appels_recus`
  ADD CONSTRAINT `FK_2F9E5C3ABE6CAE90` FOREIGN KEY (`mission_id`) REFERENCES `mission` (`id`),
  ADD CONSTRAINT `FK_2F9E5C3AE7A1254A` FOREIGN KEY (`contact_id`) REFERENCES `contact` (`id`);

--
-- Contraintes pour la table `communication`
--
ALTER TABLE `communication`
  ADD CONSTRAINT `FK_F9AFB5EBD2235D39` FOREIGN KEY (`tache_id`) REFERENCES `tache` (`id`),
  ADD CONSTRAINT `FK_F9AFB5EBF6203804` FOREIGN KEY (`statut_id`) REFERENCES `statut_communication` (`id`);

--
-- Contraintes pour la table `deplacement`
--
ALTER TABLE `deplacement`
  ADD CONSTRAINT `FK_1296FAC2D2235D39` FOREIGN KEY (`tache_id`) REFERENCES `tache` (`id`),
  ADD CONSTRAINT `FK_1296FAC2F6203804` FOREIGN KEY (`statut_id`) REFERENCES `statut_deplacement` (`id`);

--
-- Contraintes pour la table `devis`
--
ALTER TABLE `devis`
  ADD CONSTRAINT `FK_8B27C52B19EB6921` FOREIGN KEY (`client_id`) REFERENCES `contact` (`id`),
  ADD CONSTRAINT `FK_8B27C52BBE6CAE90` FOREIGN KEY (`mission_id`) REFERENCES `mission` (`id`);

--
-- Contraintes pour la table `document`
--
ALTER TABLE `document`
  ADD CONSTRAINT `FK_D8698A76D2235D39` FOREIGN KEY (`tache_id`) REFERENCES `tache` (`id`);

--
-- Contraintes pour la table `entreprise`
--
ALTER TABLE `entreprise`
  ADD CONSTRAINT `FK_D19FA60F6203804` FOREIGN KEY (`statut_id`) REFERENCES `statut_entreprise` (`id`);

--
-- Contraintes pour la table `etat_des_lieux`
--
ALTER TABLE `etat_des_lieux`
  ADD CONSTRAINT `FK_F7210312F347EFB` FOREIGN KEY (`produit_id`) REFERENCES `produit` (`id`),
  ADD CONSTRAINT `FK_F7210312F6203804` FOREIGN KEY (`statut_id`) REFERENCES `statut_etat_des_lieux` (`id`);

--
-- Contraintes pour la table `forfait`
--
ALTER TABLE `forfait`
  ADD CONSTRAINT `FK_BBB5C482D2235D39` FOREIGN KEY (`tache_id`) REFERENCES `tache` (`id`);

--
-- Contraintes pour la table `hebergement`
--
ALTER TABLE `hebergement`
  ADD CONSTRAINT `FK_4852DD9CD2235D39` FOREIGN KEY (`tache_id`) REFERENCES `tache` (`id`);

--
-- Contraintes pour la table `historique`
--
ALTER TABLE `historique`
  ADD CONSTRAINT `FK_EDBFD5ECA4AEAFEA` FOREIGN KEY (`entreprise_id`) REFERENCES `entreprise` (`id`),
  ADD CONSTRAINT `FK_EDBFD5ECE7A1254A` FOREIGN KEY (`contact_id`) REFERENCES `contact` (`id`),
  ADD CONSTRAINT `FK_EDBFD5ECF347EFB` FOREIGN KEY (`produit_id`) REFERENCES `produit` (`id`);

--
-- Contraintes pour la table `intervenant`
--
ALTER TABLE `intervenant`
  ADD CONSTRAINT `FK_73D0145CA4AEAFEA` FOREIGN KEY (`entreprise_id`) REFERENCES `entreprise` (`id`),
  ADD CONSTRAINT `FK_73D0145CD2235D39` FOREIGN KEY (`tache_id`) REFERENCES `tache` (`id`),
  ADD CONSTRAINT `FK_73D0145CE7A1254A` FOREIGN KEY (`contact_id`) REFERENCES `contact` (`id`),
  ADD CONSTRAINT `FK_73D0145CF347EFB` FOREIGN KEY (`produit_id`) REFERENCES `produit` (`id`),
  ADD CONSTRAINT `FK_73D0145CF6203804` FOREIGN KEY (`statut_id`) REFERENCES `statut_intervenant` (`id`);

--
-- Contraintes pour la table `mail`
--
ALTER TABLE `mail`
  ADD CONSTRAINT `FK_5126AC48A4AEAFEA` FOREIGN KEY (`entreprise_id`) REFERENCES `entreprise` (`id`),
  ADD CONSTRAINT `FK_5126AC48BE6CAE90` FOREIGN KEY (`mission_id`) REFERENCES `mission` (`id`),
  ADD CONSTRAINT `FK_5126AC48E7A1254A` FOREIGN KEY (`contact_id`) REFERENCES `contact` (`id`),
  ADD CONSTRAINT `FK_5126AC48F6203804` FOREIGN KEY (`statut_id`) REFERENCES `statut_mail` (`id`);

--
-- Contraintes pour la table `mission_produit`
--
ALTER TABLE `mission_produit`
  ADD CONSTRAINT `FK_B899786ABE6CAE90` FOREIGN KEY (`mission_id`) REFERENCES `mission` (`id`),
  ADD CONSTRAINT `FK_B899786AF347EFB` FOREIGN KEY (`produit_id`) REFERENCES `produit` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `moyen`
--
ALTER TABLE `moyen`
  ADD CONSTRAINT `FK_2D6523D6D2235D39` FOREIGN KEY (`tache_id`) REFERENCES `tache` (`id`);

--
-- Contraintes pour la table `note`
--
ALTER TABLE `note`
  ADD CONSTRAINT `FK_CFBDFA14A4AEAFEA` FOREIGN KEY (`entreprise_id`) REFERENCES `entreprise` (`id`),
  ADD CONSTRAINT `FK_CFBDFA14E7A1254A` FOREIGN KEY (`contact_id`) REFERENCES `contact` (`id`);

--
-- Contraintes pour la table `probleme`
--
ALTER TABLE `probleme`
  ADD CONSTRAINT `FK_7AB2D714BE6CAE90` FOREIGN KEY (`mission_id`) REFERENCES `mission` (`id`),
  ADD CONSTRAINT `FK_7AB2D714F6203804` FOREIGN KEY (`statut_id`) REFERENCES `statut_probleme` (`id`);

--
-- Contraintes pour la table `produit`
--
ALTER TABLE `produit`
  ADD CONSTRAINT `FK_29A5EC274DFE3A85` FOREIGN KEY (`identification_id`) REFERENCES `identification` (`id`),
  ADD CONSTRAINT `FK_29A5EC27D5E86FF` FOREIGN KEY (`etat_id`) REFERENCES `etat` (`id`);

--
-- Contraintes pour la table `profession`
--
ALTER TABLE `profession`
  ADD CONSTRAINT `FK_BA930D69A4AEAFEA` FOREIGN KEY (`entreprise_id`) REFERENCES `entreprise` (`id`),
  ADD CONSTRAINT `FK_BA930D69E7A1254A` FOREIGN KEY (`contact_id`) REFERENCES `contact` (`id`);

--
-- Contraintes pour la table `restauration`
--
ALTER TABLE `restauration`
  ADD CONSTRAINT `FK_898B1EF1D2235D39` FOREIGN KEY (`tache_id`) REFERENCES `tache` (`id`);

--
-- Contraintes pour la table `reunion`
--
ALTER TABLE `reunion`
  ADD CONSTRAINT `FK_5B00A482D2235D39` FOREIGN KEY (`tache_id`) REFERENCES `tache` (`id`);

--
-- Contraintes pour la table `tache`
--
ALTER TABLE `tache`
  ADD CONSTRAINT `FK_9387207596784F9E` FOREIGN KEY (`probleme_id`) REFERENCES `probleme` (`id`);

--
-- Contraintes pour la table `telephone`
--
ALTER TABLE `telephone`
  ADD CONSTRAINT `FK_450FF010A4AEAFEA` FOREIGN KEY (`entreprise_id`) REFERENCES `entreprise` (`id`),
  ADD CONSTRAINT `FK_450FF010E7A1254A` FOREIGN KEY (`contact_id`) REFERENCES `contact` (`id`),
  ADD CONSTRAINT `FK_450FF010F6203804` FOREIGN KEY (`statut_id`) REFERENCES `statut_telephone` (`id`);
--
-- Base de données : `tutocontact`
--
CREATE DATABASE IF NOT EXISTS `tutocontact` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `tutocontact`;

-- --------------------------------------------------------

--
-- Structure de la table `contact`
--

DROP TABLE IF EXISTS `contact`;
CREATE TABLE IF NOT EXISTS `contact` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `prenom` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `entreprise` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_4C62E638979B1AD6` (`company_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `contact`
--

INSERT INTO `contact` (`id`, `nom`, `prenom`, `entreprise`, `company_id`) VALUES
(1, NULL, NULL, 'FOCUS', NULL),
(2, 'cecile', 'philippe\r\n', NULL, 4),
(3, 'Sanachy', 'patrice', NULL, 1),
(4, NULL, NULL, 'ISC', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `doctrine_migration_versions`
--

DROP TABLE IF EXISTS `doctrine_migration_versions`;
CREATE TABLE IF NOT EXISTS `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20230105143323', '2023-01-05 14:33:30', 70),
('DoctrineMigrations\\Version20230105143917', '2023-01-05 14:39:24', 175);

-- --------------------------------------------------------

--
-- Structure de la table `messenger_messages`
--

DROP TABLE IF EXISTS `messenger_messages`;
CREATE TABLE IF NOT EXISTS `messenger_messages` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `body` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `headers` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue_name` varchar(190) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `available_at` datetime NOT NULL,
  `delivered_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_75EA56E0FB7336F0` (`queue_name`),
  KEY `IDX_75EA56E0E3BD61CE` (`available_at`),
  KEY `IDX_75EA56E016BA31DB` (`delivered_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `contact`
--
ALTER TABLE `contact`
  ADD CONSTRAINT `FK_4C62E638979B1AD6` FOREIGN KEY (`company_id`) REFERENCES `contact` (`id`);
--
-- Base de données : `unificia`
--
CREATE DATABASE IF NOT EXISTS `unificia` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `unificia`;

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

DROP TABLE IF EXISTS `categorie`;
CREATE TABLE IF NOT EXISTS `categorie` (
  `id_categorie` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id_categorie`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `categorie`
--

INSERT INTO `categorie` (`id_categorie`, `nom`) VALUES
(1, 'Télécom Matériel'),
(2, 'Télécom Services'),
(3, 'UCCU'),
(4, 'Sécurité alarme'),
(5, 'Vidéo surveillance'),
(6, 'Energies *'),
(7, 'Autres accessoires');

-- --------------------------------------------------------

--
-- Structure de la table `client`
--

DROP TABLE IF EXISTS `client`;
CREATE TABLE IF NOT EXISTS `client` (
  `id_client` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_user` int(11) UNSIGNED DEFAULT NULL,
  `entreprise` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `siret` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `adresse` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ville` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `code_postal` int(5) UNSIGNED DEFAULT NULL,
  `departement` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `region` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tel_bureau` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tel_mobile` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mail` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `responsable` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `qualite` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id_client`),
  KEY `id_user` (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `client`
--

INSERT INTO `client` (`id_client`, `id_user`, `entreprise`, `siret`, `adresse`, `ville`, `code_postal`, `departement`, `region`, `tel_bureau`, `tel_mobile`, `mail`, `responsable`, `qualite`) VALUES
(32, 44, 'sport 2000', '123-456-789', '5 rue des fleurs ', 'Sallèles-d\'Aude', 11590, 'Aude', 'Occitanie', '0690555555', '056445544', 'jeanbon@mail.fr', 'JEAN Bonheur', 'Directeur'),
(33, 44, 'Peugeot', '123-131-231-234', '2 avenue du Général Degaulle', 'Bolazec', 29640, 'Finistère', 'Bretagne', '0590 557987', '0690 324365', 'jeanMoulin@gmail.com', 'Jean Moulin', 'Directeur'),
(34, 44, 'mobalpa', '123-1233-12323-123', '2 bis rue des fleurs', 'Baie-Mahault', 97122, 'Guadeloupe', 'Guadeloupe', '12321321', '12321321', 'Jules23@mobalpa.fr', 'Jean Jules ', 'Directeur '),
(35, 44, 'FleuryMichon', '545-123-123-123', '32 centre commercial labège', 'Floirac', 33270, 'Gironde', 'Nouvelle-Aquitaine', '0690 78 34 35 ', '0690 78 34 35 ', 'jeantoad@gmail.com', 'JEAN Toad', 'Directeur'),
(36, 43, 'Bred Guadeloupe ', '123-123-123-123-123', '11 rue des fleurs ', 'Baie-Mahault', 97122, 'Guadeloupe', 'Guadeloupe', '098878', '98989898989', 'raybarre@msn.fr', 'Raymond barre ', 'Directeur '),
(37, 46, 'COOPERATIVE DE CARMAUX', '657-888-999-00010', '11 Rue Lamartine', 'Carmaux', 81400, 'Tarn', 'Occitanie', '0987876565', '0756564433', 'pognon@carmaux.com', 'POGNON', 'Président');

-- --------------------------------------------------------

--
-- Structure de la table `etat`
--

DROP TABLE IF EXISTS `etat`;
CREATE TABLE IF NOT EXISTS `etat` (
  `id_etat` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_site` int(10) UNSIGNED DEFAULT NULL,
  `id_categorie` int(10) UNSIGNED DEFAULT NULL,
  `resultat` decimal(8,2) NOT NULL,
  PRIMARY KEY (`id_etat`),
  KEY `id_categorie` (`id_categorie`),
  KEY `id_site` (`id_site`)
) ENGINE=InnoDB AUTO_INCREMENT=365 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `etat`
--

INSERT INTO `etat` (`id_etat`, `id_site`, `id_categorie`, `resultat`) VALUES
(103, 94, 1, '300.00'),
(104, 94, 2, '100.00'),
(105, 94, 3, '100.00'),
(106, 94, 4, '120.00'),
(107, 94, 5, '100.00'),
(108, 94, 6, '0.00'),
(109, 94, 7, '200.00'),
(160, 107, 1, '100.00'),
(161, 107, 2, '300.00'),
(162, 107, 3, '0.00'),
(163, 107, 4, '0.00'),
(164, 107, 5, '200.00'),
(165, 107, 6, '0.00'),
(166, 107, 7, '0.00'),
(196, 94, 1, '0.00'),
(197, 94, 2, '0.00'),
(198, 94, 3, '0.00'),
(199, 94, 4, '0.00'),
(200, 94, 5, '0.00'),
(201, 94, 6, '0.00'),
(202, 94, 7, '0.00'),
(224, 94, 1, '0.00'),
(225, 94, 2, '0.00'),
(226, 94, 3, '0.00'),
(227, 94, 4, '0.00'),
(228, 94, 5, '0.00'),
(229, 94, 6, '0.00'),
(230, 94, 7, '0.00'),
(231, 94, 1, '0.00'),
(232, 94, 2, '0.00'),
(233, 94, 3, '0.00'),
(234, 94, 4, '0.00'),
(235, 94, 5, '0.00'),
(236, 94, 6, '0.00'),
(237, 94, 7, '0.00'),
(238, 94, 1, '0.00'),
(239, 94, 2, '0.00'),
(240, 94, 3, '0.00'),
(241, 94, 4, '0.00'),
(242, 94, 5, '0.00'),
(243, 94, 6, '0.00'),
(244, 94, 7, '0.00'),
(330, 145, 1, '100.00'),
(331, 145, 2, '200.00'),
(332, 145, 3, '0.00'),
(333, 145, 4, '0.00'),
(334, 145, 5, '0.00'),
(335, 145, 6, '0.00'),
(336, 145, 7, '0.00'),
(344, 149, 1, '200.00'),
(345, 149, 2, '200.00'),
(346, 149, 3, '10.00'),
(347, 149, 4, '200.00'),
(348, 149, 5, '200.00'),
(349, 149, 6, '300.00'),
(350, 149, 7, '0.00'),
(351, 150, 1, '120.00'),
(352, 150, 2, '350.00'),
(353, 150, 3, '0.00'),
(354, 150, 4, '0.00'),
(355, 150, 5, '0.00'),
(356, 150, 6, '600.00'),
(357, 150, 7, '0.00'),
(358, 151, 1, '100.00'),
(359, 151, 2, '20.00'),
(360, 151, 3, '0.00'),
(361, 151, 4, '0.00'),
(362, 151, 5, '0.00'),
(363, 151, 6, '0.00'),
(364, 151, 7, '0.00');

-- --------------------------------------------------------

--
-- Structure de la table `ligne`
--

DROP TABLE IF EXISTS `ligne`;
CREATE TABLE IF NOT EXISTS `ligne` (
  `id_ligne` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_proposition` int(10) UNSIGNED DEFAULT NULL,
  `id_produit` int(10) UNSIGNED DEFAULT NULL,
  `id_categorie` int(10) UNSIGNED DEFAULT NULL,
  `quantite` mediumint(8) UNSIGNED DEFAULT NULL,
  PRIMARY KEY (`id_ligne`),
  KEY `id_proposition` (`id_proposition`),
  KEY `id_produit` (`id_produit`),
  KEY `id_categorie` (`id_categorie`)
) ENGINE=InnoDB AUTO_INCREMENT=177 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `ligne`
--

INSERT INTO `ligne` (`id_ligne`, `id_proposition`, `id_produit`, `id_categorie`, `quantite`) VALUES
(120, 69, 15, 1, 1),
(121, 69, 25, 1, 2),
(122, 69, 11, 3, 1),
(140, 75, 15, 1, 1),
(149, 75, 103, 2, 1),
(150, 75, 5, 3, 1),
(151, 75, 32, 1, 1),
(153, 75, 80, 5, 1),
(154, 75, 81, 5, 2),
(155, 75, 105, 2, 1),
(159, 69, 103, 2, 1),
(160, 85, 15, 1, 1),
(161, 85, 103, 2, 1),
(162, 86, 15, 1, 1),
(163, 88, 15, 1, 1),
(164, 88, 25, 1, 2),
(165, 88, 93, 1, 6),
(166, 88, 40, 1, 1),
(167, 88, 103, 2, 2),
(168, 88, 108, 2, 4),
(169, 88, 11, 3, 1),
(170, 88, 10, 3, 1),
(171, 88, 80, 5, 5),
(172, 88, 58, 7, 10),
(173, 87, 15, 1, 2),
(174, 87, 32, 1, 2),
(175, 87, 103, 2, 1),
(176, 87, 80, 5, 3);

-- --------------------------------------------------------

--
-- Structure de la table `produit`
--

DROP TABLE IF EXISTS `produit`;
CREATE TABLE IF NOT EXISTS `produit` (
  `id_produit` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_categorie` int(10) UNSIGNED DEFAULT NULL,
  `id_type` int(10) UNSIGNED DEFAULT NULL,
  `designation` longtext COLLATE utf8mb4_unicode_ci,
  `detail` varchar(1000) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `prix` decimal(8,2) DEFAULT NULL,
  PRIMARY KEY (`id_produit`),
  KEY `id_categorie` (`id_categorie`),
  KEY `id_type` (`id_type`)
) ENGINE=InnoDB AUTO_INCREMENT=116 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `produit`
--

INSERT INTO `produit` (`id_produit`, `id_categorie`, `id_type`, `designation`, `detail`, `prix`) VALUES
(1, 3, 1, 'UCCU Home', '                                                                                                                                  ', '72.50'),
(2, 3, 1, 'UCCU One Pro Carte Upgrade CPM UCCU interdite          ', '                                                            ', '48.50'),
(3, 3, 1, 'UCCU EntryMulti-protocole ', 'radioBase: 2 Télécommandes. 1 sirène intérieure. 1 Micromodules.1 détecteurs volumétriqueCarte Upgrade CPM UCCU interdite', '73.43'),
(4, 3, 1, 'UCCU Advance(Filaire et Radio)', 'Alimentation secourue. secours GSM. multiprotocoles. buset réseauxBase: 1 Clavier filaire. 1 Micromodules. 1 détecteurs volumétrique filaire                            ', '129.08'),
(5, 3, 1, 'BLOOM Ultimate(Filaire et Radio)', 'Alimentation secourue. secours GSM. multiprotocoles. buset réseauxBase: 1 Clavier filaire. 1 sirène/buzzer3 Micromodules. 4 détecteurs volumétrique filaire. 1 module B8R pour 8+1 équipements filaires                                                                                                                        ', '259.63'),
(6, 3, 1, 'Passerelle de compatibilité REC', '                                                            ', '0.00'),
(7, 3, 1, 'Module de sécurisation', '                                                            ', '0.00'),
(8, 3, 1, 'Carte Upgrade CPM UCCU', '                                                            ', '0.00'),
(9, 3, 1, 'Module Passerelle Télécom', '                                                            ', '4.68'),
(10, 3, 1, 'Secours GSM 3/4Gpour Entry', '                                                            ', '5.40'),
(11, 3, 1, 'UCCU Advance    (Filaire et Radio) ', 'Alimentation secourue, secours GSM, multiprotocoles, bus  et réseaux                                                                            Base: 1 Clavier filaire, 1 Micromodules, 1 détecteurs volumétrique filaire', '3.08'),
(12, 3, 1, 'Module UD4 Extension pour Ultimate - montage sur rail DIN (8 modules)', '                                                            ', '16.58'),
(13, 3, 1, 'Module 8 relais contact pour Ultimate - montage sur rail DIN (8 modules)', '                                                            ', '7.32'),
(14, 3, 1, 'Coffret d\'extention double rail dinpour Extention', '                                                            ', '2.24'),
(15, 1, 1, 'Boitier ATA Cisco SPA 122', '                                                                                                                                                                                                                                                                          \r\n                                                                                                                                                                                                                                                                                  ', '5.00'),
(16, 1, NULL, 'Terminal SIP YEALINK T41S 6 comptesPoE NB\"', '', '4.63'),
(17, 1, NULL, 'Terminal SIP YEALINK T42S 12 comptes Giga PoE NB', '', '5.86'),
(18, 1, NULL, 'Terminal SIP YEALINK T46S 16 comptes Giga PoE couleur 4\"', '', '9.41'),
(19, 1, NULL, 'Terminal SIP YEALINKT48S 16 comptes Giga PoE couleur 7', '', '12.72'),
(20, 1, 1, 'LCD Expansion Module pour terminal SIP T46 et T48 40 touches', '                                                                                                                        ', '4.86'),
(21, 1, NULL, 'Terminal SIP YEALINKT56A 16 cpt PoE Wifi 7', '', '14.57'),
(22, 1, NULL, 'Terminal SIP YEALINK 16 SIP T58V PoE Wifi 7', '', '19.97'),
(23, 1, 1, 'Module d\'extension LCD EXP50 pour T5x 60 touches', '                                                            ', '5.32'),
(24, 1, 1, 'Combiné et Base DECT Pro Gigaset C530 IP', '', '5.97'),
(25, 1, 1, 'Borne DECT IP Gigaset N510 IP ', 'proappels multi-lignes avec jusqu’à 6 combinés et 4 appels simultanés                            ', '5.80'),
(26, 1, 1, 'Contrôleur DECT Manager N720 DM Pro ', '(borne Maître)Jusqu’à 20 bornes N720 IP PRO  Jusqu’à 100 utilisateurs / comptes SIP / combinés Jusqu’à 30 appels simultanés au total\r\n                            ', '32.92'),
(27, 1, 1, 'Combiné DECT Pro Gigaset R650H IP65borne obligatoire', '                                                            ', '7.49'),
(28, 1, 1, 'Combiné DECT Pro Gigaset S650Hborne obligatoire', '                                                            ', '4.81'),
(29, 1, 1, 'Combiné DECT Pro Gigaset SL750H Proborne obligatoire', '                                                            ', '7.77'),
(30, 1, NULL, 'Système audioconférence SIP CP920 Wifi Bluetooth', '', '20.43'),
(31, 1, NULL, 'Système audioconférence SIP CP960 Wifi Bluetooth', '', '29.99'),
(32, 1, 1, 'Casque JABRA BIZ 2300 Mono QD Version', '                                                            ', '5.88'),
(33, 1, 1, 'Casque sans fil JABRA PRO 9450 Duo', '                                                            ', '18.76'),
(34, 1, 1, 'Création RJ 45 Catégorie 5 (par terminal)', '                                                            ', '2.31'),
(35, 1, NULL, 'Switch DLINKDesktop 8 Ports Giga dont 4 PoE at (68W)', '', '4.66'),
(36, 1, NULL, 'Switch DLINKDesktop 8 Ports Giga PoE at (140W)', '', '7.60'),
(37, 1, NULL, 'Switch DLINKDesktop 12 Ports Giga PoE at (150W)', '', '9.25'),
(38, 1, NULL, 'Switch DLINKDesktop 16 Ports Giga PoE at (180W)', '', '13.88'),
(39, 1, 1, 'Switch DLINK 24 Ports Giga PoE at (370W) + 2 Combo SFP', '                                                            ', '22.18'),
(40, 1, 1, 'Coffret de brassage 10\'\'/19\'\' Hybride ( montage vertical ou horizontal )', '                                                            ', '7.83'),
(41, 1, NULL, 'HOTSPOT 4G LTE- Mobile WiFi jusqu\' a 8 heures d\'autonomie', '', '7.56'),
(42, 1, NULL, 'Routeur avec modem 4G LTE Wifi n 3', '00Mbits/ QOS/DHCP/1 WAN/4 RJ45\r\n', '7.26'),
(43, 7, 1, 'Détecteur intérieur volumétrique', '                                                            ', '3.70'),
(44, 7, NULL, 'Détecteur extérieur volumétrique', '', '9.17'),
(45, 7, NULL, 'Détecteur extérieur rideau', '', '4.63'),
(46, 7, NULL, 'Barrière avec rayons actifs IR. 1m / 4 rayons.\n avec: Filtre anti-commutation intégré. Synchronisme optique intelligent. Double optique pour chaque rayon.(existejusqu’à 2 mètres de hauteur et jusqu’à 8 rayons)', '', '15.42'),
(47, 7, 1, 'Détecteurde température', '', '2.87'),
(48, 7, NULL, 'Détecteurdétecteur de luminosité', '#REF!', '2.87'),
(49, 7, 1, 'Détecteur d\'ouverture', '', '1.89'),
(50, 7, NULL, 'Détecteur d\'ouverture pour portes de garages', '', '3.16'),
(51, 7, 1, 'Détecteur d\'ouverture pour volets roulants', '', '4.55'),
(52, 7, NULL, 'Détecteur de bris de vitres', '', '3.08'),
(53, 7, NULL, 'Détecteur de gaz- Gaz de ville. propane. butane et GPL \n - Puissance sonore 94 dB', '', '6.32'),
(54, 7, NULL, 'Détecteur d\'inondation', '', '3.08'),
(55, 7, NULL, 'Détecteur de panne congélateur', '', '2.54'),
(56, 7, NULL, 'Capteur de pluie et de neige', '', '6.63'),
(57, 7, 1, 'Détecteur de gel', '', '2.54'),
(58, 7, 1, 'Capteur de consommation électrique', '                                                            ', '3.08'),
(59, 7, 1, 'Micromodule commutateur simple', '', '2.70'),
(60, 7, 1, 'Micromodule commutateur double', '', '3.16'),
(61, 7, 1, 'Sirène intérieur- Puissance sonore : 103dBa - Accéléramètre : pour détecter toute tentative de sabotage', '                                                            ', '4.86'),
(62, 7, 1, 'Sirène extérieur- Puissance sonore : 103dBa - Accéléramètre : pour détecter toute tentative de sabotage', '                                                            ', '4.78'),
(63, 7, 1, 'Prise 220 V', '                                                            ', '2.70'),
(64, 7, NULL, 'Module de commande pour chaudière (enocean seulement)- Avec remontée de consommation', '', '2.62'),
(65, 7, NULL, 'Tête thermostatique pour contrôle de radiateur de chauffage.', '', '2.70'),
(66, 7, 1, 'Passerellevers IR pour climatiseur (AC)', '', '10.56'),
(67, 7, NULL, 'Télécommande', '#REF!', '1.93'),
(68, 7, 1, 'Bracelet/médaillon d\'appel d\'urgence (toutes actions)', '                                                            ', '2.12'),
(69, 7, NULL, 'Clavier int./ext. Rétro-éclairé', '', '7.32'),
(70, 7, 1, 'Lecteur de badge EM/HID (125kHz) ou Mifare (13 MHz) métal int./ext.', '                                                            ', '5.78'),
(71, 7, 1, 'Badge de proximité EM (125kHz) porte clefs en ABS', '                                                                                                                                                                                    ', '0.19'),
(72, 7, 1, 'Carte de proximité programmable', '                                                            ', '0.27'),
(73, 7, 1, 'Lecteur d\'empreinte à défilement int.ext. Rétroéclairé', '                                                            ', '19.24'),
(74, 7, 1, 'KIT ferme porte intérieure légère à bras ou à ressort et ventouse électromagnétique', '                                                            ', '5.78'),
(75, 7, 1, 'KIT ferme porte lourde à bras et ventouse électromagnétique', '                                                            ', '9.25'),
(76, 7, 1, 'Portier vidéo WiFi ou Ethernet 720P avec lecteur RFID', '                                #REF!                            ', '11.57'),
(77, 7, 1, 'Portier vidéo WiFi ou Ethernet 720P avec lecteur RFID', '', '11.57'),
(78, 7, NULL, 'Tablette dédiée Multimédia-Center', '', '0.00'),
(80, 5, NULL, 'Caméra dômeIP antivandale IP67 1080P ONVIF IP 3MP. 30m. POE. Varifocale motorisee 2.8-12mm 1080P ONVIF IP67', '', '10.26'),
(81, 5, NULL, 'Caméra IP motorisée antivandale DomeIP 2MP. IR 30 m. POE+. Zoom optique x4. 2.7-12mm 1080P ONVIF IP67', '', '17.99'),
(82, 5, NULL, 'Caméra IP motorisée antivandale DomeIP Starlight 2MP. IR 100m. POE+. Zoom optique motorisé x25. 4.7-94mm1080P ONVIFIP67', '', '26.99'),
(83, 5, NULL, 'Ecran 24 pouces/ Résolution de l\'écran: 1920 x 1080', '', '9.25'),
(84, 5, NULL, 'NVR 4 caméras max. 2x HDD 2\"1/2 POE Enr.200 Mbps\n - Prévoir disque dur', '', '8.97'),
(85, 5, NULL, 'NVR 8 caméras max. 2x HDD 2\"1/2 POE Enr.200 Mbps\n - Prévoir disque dur', '', '17.30'),
(86, 5, NULL, 'NVR 16 caméras max. 2x HDD 2\"1/2 POE Enr.200 Mbps\n - Prévoir disque dur', '', '18.63'),
(87, 5, 1, 'Disque dur1 To Spécial Vidéo', '                                                            ', '4.55'),
(88, 5, 1, 'Disque dur2 To Spécial Vidéo', '                                                            ', '6.86'),
(89, 5, 1, 'Disque dur 4 To Spécial Vidéo', '                                                            ', '13.03'),
(90, 5, 1, 'Disque dur 6 To Spécial Vidéo', '                                                            ', '21.51'),
(91, 5, NULL, 'Télésurveillance ', '', '25.00'),
(92, 1, 1, 'Centrex PRO \"au compteur\"', 'Numérotation courte, Messagerie vocale, 1 terminal, Groupes, Supervision BLF, mise en attente, transferts et renvois, conférence à 3, myIstra (application compagnon web ou PC), Pré décroché et Files d’attente, Assignation de SDA, génération de CDRs, Capacité d’appel SIP par utilisateur inclus (20% en moyenne)', '6.85'),
(93, 1, 1, 'Centrex PRO', '\"illimité vers les fixes nationaux + 40 pays\"               ', '14.25'),
(94, 1, 1, 'Centrex PRO ', '\"illimité vers les fixes et les mobiles nationaux + 40 pays\"', '19.80'),
(95, 1, NULL, 'Remise Promotion 8 jours Centrex PRO', '', '-18.80'),
(96, 1, NULL, 'SIP Trunk pour IPBX \"au compteur\"', '', '5.00'),
(97, 1, NULL, 'SIP Trunk pour IPBX \"illimité vers les fixes et les mobiles nationaux + 100 destinations\"', '', '23.50'),
(98, 1, 1, 'Numéros SDA', '                                                            ', '0.56'),
(99, 1, NULL, 'Option myCollabPermet à un utilisateur de créer et d’inviter des collaborateurs dans un espace de collaboration (appel de vidéophonie. partage d’écran)', '', '5.74'),
(100, 1, 1, 'Option myCollab VIPCollaboration VIP ', 'salle personnelle permanente)Permet à un utilisateur de créer et d’inviter des collaborateurs dans un espace de collaboration (appel de vidéophonie. partage d’écran                        ', '15.73'),
(101, 2, NULL, 'Fax2Mail - Mai2Fax Mono-emetteur', '', '5.55'),
(102, 2, NULL, 'Mail2Fax 50 emetteurs', '', '9.25'),
(103, 2, 1, 'ADSL/VDSL/FIBREILIAD', 'En débit descendant jusqu’à 1 Gbit/s et en débit montant jusqu’à 400 Mbit/sen cas de fibre et selon éligibilité                                                                                                                                                                        ', '29.16'),
(104, 2, NULL, 'FIBRE ORANGElive box ', '100 Mbit/s Jusqu\'à 300 Mbits/s (débit descendant) et jusqu\'à 300 Mbits/s (débit montant)(soit 19.15€ HT/mois pendant 12 mois puis 34.98€/mois)                                          ', '34.99'),
(105, 2, NULL, 'FIBRE SFR STARTER200 ', 'Mbit/s minimum en débit descendant et 20 Mbit/s minimum en montantjusqu’à 1 Gbit/s (soit 11.67€ HT/mois pendant 12 mois puis 32.50 €/mois)\r\n', '0.00'),
(106, 2, NULL, 'SDSL selon étude sur 1.2.3.4 paires et selon débit et qualité du réseau', '', '0.00'),
(107, 2, NULL, 'FIBRE PRIVE selon étude', '', '0.00'),
(108, 2, NULL, 'ForfaitILIADAppels. SMS. MMS illimités/  Appels illimités vers fixes 100 destinations ', 'Internet100 Go/mois. 4G+ illimitée Appels. SMS. MMS illimités + 25Go depuis Europe. DOM. USA', '13.33'),
(109, 2, NULL, 'Forfait ORANGES', 'Appels / SMS / MMS : illimités en France et depuis l\'Europe** + SMS illimités depuis la France vers l’Europe*** Internet mobile : 20 Go/mois d\'internet mobile en France sur le réseau Orange (3G. 4G/4G+) et en Europe***** depuis les zones Europe. Suisse/Andorre et DOM vers ces mêmes zones et la France métropolitaine *** zones Europe. Suisse/Andorre et DOM', '16.66'),
(110, 2, NULL, 'Forfait ORANGES', 'Appels / SMS / MMS : illimités en France et depuis l\'Europe** + SMS illimités depuis la France vers l’Europe*** + Appels illimités depuis la France métropolitaine vers les fixes d\'Europe*** et vers les fixes et mobiles des USA et du Canada Internet mobile : 50 Go/mois d\'internet mobile en France sur le réseau Orange (3G. 4G/4G+) et en Europe***** depuis les zones Europe. Suisse/Andorre et DOM vers ces mêmes zones et la France métropolitaine *** zones Europe. Suisse/Andorre et DOM', '20.82'),
(112, 3, 1, 'UCCU One Pro Carte Upgrade CPM UCCU interdite          ', '                                                                                                                        ', '48.50'),
(113, 5, 1, 'Dome IP 2MP. 30m. POE. Anti-vandale. Varifocale motorisee 2.8-12mm 1080P ONVIF IP67', '                                                                                                                                                                                                                                                ', '5.72'),
(114, 6, 1, 'aB', '                                                                                                    a                                                                                                ', '3.00'),
(115, 6, 1, 'Tiers', '                                                                            ', '12.00');

-- --------------------------------------------------------

--
-- Structure de la table `proposition`
--

DROP TABLE IF EXISTS `proposition`;
CREATE TABLE IF NOT EXISTS `proposition` (
  `id_proposition` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_site` int(10) UNSIGNED DEFAULT NULL,
  `nom` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id_proposition`),
  KEY `id_site` (`id_site`)
) ENGINE=InnoDB AUTO_INCREMENT=91 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `proposition`
--

INSERT INTO `proposition` (`id_proposition`, `id_site`, `nom`) VALUES
(69, 94, 'Proposition 12'),
(75, 107, 'Proposition 1 '),
(84, 94, 'Poires'),
(85, 145, 'pro'),
(86, 145, 'proposition 2'),
(87, 149, 'Proposition 1'),
(88, 150, 'Proposition initiale'),
(89, 107, 'Proposition 2 '),
(90, 151, 'Proposition 1 ');

-- --------------------------------------------------------

--
-- Structure de la table `session`
--

DROP TABLE IF EXISTS `session`;
CREATE TABLE IF NOT EXISTS `session` (
  `sid` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL,
  `data` mediumtext COLLATE utf8mb4_unicode_ci,
  `date_maj` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`sid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `session`
--

INSERT INTO `session` (`sid`, `data`, `date_maj`) VALUES
('0smk82mb66dth4hsnd6n49dp5b', 'id_user|s:2:\"46\";', '2019-11-23 18:45:25'),
('4ua8jrbgep9ljvpdf5mmtimis8', 'id_user|s:2:\"44\";', '2019-11-22 15:12:39'),
('71rg301tagm5140hq338fcs65r', 'id_user|s:2:\"44\";', '2019-11-29 09:40:47'),
('8t5frp45dnhv81qvdorm1b4j0h', 'id_user|s:2:\"46\";', '2019-11-29 11:55:47'),
('9a6alp94s3g2bh4m49hoptlp2k', 'id_user|s:2:\"44\";', '2019-11-17 00:26:42'),
('9d7htcdugiq9ppah7eoigqhg0m', 'id_user|s:2:\"44\";', '2019-11-19 12:13:01'),
('9l1e3v9lbm5gj271blh3ev0c0k', 'id_user|s:2:\"44\";', '2019-11-29 18:05:21'),
('fbohu4um9lsf2j6g26n0cvk0fe', 'id_user|s:2:\"43\";', '2019-11-14 16:45:21'),
('lp9lf7s02ttirtebhm3606spcb', 'id_user|s:2:\"43\";', '2019-11-30 11:47:27'),
('mgb13bd32nf2if4nqveshe1f0c', 'id_user|i:43;', '2023-01-13 11:02:30'),
('nt91oe394jfm9nrkd5emktsgau', '', '2019-11-19 16:18:05'),
('pechuh6eohbfmnoeg283p4tibh', 'id_user|s:2:\"44\";', '2019-11-24 17:06:49'),
('tm1f1ujeinudfhj7uiul9hv8av', 'id_user|s:2:\"44\";', '2019-11-14 21:43:57'),
('trc9apk8ijn24jjfsmtb30h06q', 'id_user|s:2:\"44\";', '2019-11-21 16:45:31'),
('upn4k7crqoechv5avt51ep504t', 'id_user|s:2:\"44\";', '2019-11-27 21:04:07');

-- --------------------------------------------------------

--
-- Structure de la table `site`
--

DROP TABLE IF EXISTS `site`;
CREATE TABLE IF NOT EXISTS `site` (
  `id_site` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_client` int(10) UNSIGNED DEFAULT NULL,
  `nom` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `adresse` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ville` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `departement` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `region` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code_postal` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `commentaire` longtext COLLATE utf8mb4_unicode_ci,
  `loyer_mensuel` decimal(8,2) DEFAULT NULL,
  `nbre_mensualite_restant` decimal(8,2) DEFAULT NULL,
  `montant_total_restant` decimal(8,2) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `remise` decimal(8,2) UNSIGNED DEFAULT NULL,
  PRIMARY KEY (`id_site`),
  KEY `id_client` (`id_client`)
) ENGINE=InnoDB AUTO_INCREMENT=152 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `site`
--

INSERT INTO `site` (`id_site`, `id_client`, `nom`, `adresse`, `ville`, `departement`, `region`, `code_postal`, `commentaire`, `loyer_mensuel`, `nbre_mensualite_restant`, `montant_total_restant`, `date`, `remise`) VALUES
(94, 35, 'Renault Site 12', '11 rue des fleurs ', 'Le Gosier', 'Guadeloupe', 'Guadeloupe', '97190', 'Aucune visite a ce jour', '1.00', '1.00', '1.00', '2019-10-10', NULL),
(107, 34, 'Molbapa Fleurs', '2 rue des fleurs ', 'Baie-Mahault', 'Guadeloupe', 'Guadeloupe', '97122', 'Aucune visite a ce jour', '1.00', '1.00', '1.00', '2019-10-25', '10.00'),
(145, 33, 'Site 1 ', 'zaezae', 'Brélidy', 'Côtes-d\'Armor', 'Bretagne', '22140', 'Aucune visite a ce jour ', '1.00', '1.00', '1.00', '2019-11-23', '12.00'),
(149, 32, 'Adidas 23', '2 rue des fleurs ', 'Augignac', 'Dordogne', 'Nouvelle-Aquitaine', '24300', 'Aucune visite a ce jour ', '400.00', '3000.00', '111.00', '2019-11-23', '5.00'),
(150, 37, 'PUECH', 'PAOUEC', 'Puéchoursi', 'Tarn', 'Occitanie', '81470', 'Aucune visite', '100.00', '1.00', '100.00', '2019-11-23', '0.00'),
(151, 36, 'Bred 1 ', '2 rue houelbourg , Jarry ', 'Baie-Mahault', 'Guadeloupe', 'Guadeloupe', '97122', 'Aucune visite a ce jour ', '200.00', '200.00', '200.00', '2019-11-30', '200.00');

-- --------------------------------------------------------

--
-- Structure de la table `type`
--

DROP TABLE IF EXISTS `type`;
CREATE TABLE IF NOT EXISTS `type` (
  `id_type` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nom` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id_type`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `type`
--

INSERT INTO `type` (`id_type`, `nom`) VALUES
(1, 'uccs'),
(2, 'tiers');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id_user` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `log` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mdp` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nom` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `prenom` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `poste` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tel_bureau` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tel_mobile` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mail` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `agence` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `admin` tinyint(3) UNSIGNED DEFAULT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id_user`, `log`, `mdp`, `nom`, `prenom`, `poste`, `tel_bureau`, `tel_mobile`, `mail`, `agence`, `admin`) VALUES
(42, 'ici', '$2y$10$KcuuQYyAO7FUBR9IT3N4IOZQnrZLPVrx4N6ZdiA80KNr3UsQXswM6', 'Boule', 'Jean', 'azeaz', '06559', '06505', 'ici@mail.com', 'azeza', 0),
(43, 'tom', '$2y$10$HjXIusnf/F8W5NtJLesMGeMJrQaD1vnUY0X6x/6Iz3F8QFeLv5opa', 'Thomas', 'tom', 'Commercial', '0590858585', '0690557989', 'nathanDupont@gmail.com', 'Bordeaux', 0),
(44, 'Alfred', '$2y$10$L5dynkd6avDMEMT0mQ9viuTCg7KaLb2AGusRAkwdjfMtoeoH6ZOom', 'Platon', 'Alfred', 'Directeur', '08 78 78 45 34 ', '06 90 87 76 94', 'platonalfred@mail.com', 'Toulouse', 1),
(45, 'Guillaume', '$2y$10$W33gtl2NYX.S/UrDYxWnAO5y7oVKMK5MSUT26Md6lQXHbNsjH4YE2', 'Legrand', 'Guillaume', 'DRH', '07756666', '06479399', 'guillaumelegrand@gmail.com', 'Borbeaux', 1),
(46, 'Mimosa', '$2y$10$pXRXI5nBpgsBwcUQ9ZG9VOA4fksh.OCzX5qE18fKZXXFUzjOTV5/e', 'SANACHY', 'Patrice', 'DGD', '0976453412', '0632111518', 'psanachy@unificia.com', 'Bordeaux', 1);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `client`
--
ALTER TABLE `client`
  ADD CONSTRAINT `client_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`);

--
-- Contraintes pour la table `etat`
--
ALTER TABLE `etat`
  ADD CONSTRAINT `etat_ibfk_1` FOREIGN KEY (`id_categorie`) REFERENCES `categorie` (`id_categorie`),
  ADD CONSTRAINT `etat_ibfk_2` FOREIGN KEY (`id_site`) REFERENCES `site` (`id_site`);

--
-- Contraintes pour la table `ligne`
--
ALTER TABLE `ligne`
  ADD CONSTRAINT `ligne_ibfk_2` FOREIGN KEY (`id_proposition`) REFERENCES `proposition` (`id_proposition`),
  ADD CONSTRAINT `ligne_ibfk_3` FOREIGN KEY (`id_produit`) REFERENCES `produit` (`id_produit`),
  ADD CONSTRAINT `ligne_ibfk_4` FOREIGN KEY (`id_categorie`) REFERENCES `categorie` (`id_categorie`);

--
-- Contraintes pour la table `produit`
--
ALTER TABLE `produit`
  ADD CONSTRAINT `produit_ibfk_1` FOREIGN KEY (`id_categorie`) REFERENCES `categorie` (`id_categorie`),
  ADD CONSTRAINT `produit_ibfk_2` FOREIGN KEY (`id_type`) REFERENCES `type` (`id_type`);

--
-- Contraintes pour la table `proposition`
--
ALTER TABLE `proposition`
  ADD CONSTRAINT `proposition_ibfk_1` FOREIGN KEY (`id_site`) REFERENCES `site` (`id_site`);

--
-- Contraintes pour la table `site`
--
ALTER TABLE `site`
  ADD CONSTRAINT `fk_site_client1` FOREIGN KEY (`id_client`) REFERENCES `client` (`id_client`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
