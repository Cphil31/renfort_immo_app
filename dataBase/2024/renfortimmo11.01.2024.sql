-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : jeu. 11 jan. 2024 à 13:13
-- Version du serveur : 8.2.0
-- Version de PHP : 8.2.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `renfortimmo`
--

-- --------------------------------------------------------

--
-- Structure de la table `accompte`
--

DROP TABLE IF EXISTS `accompte`;
CREATE TABLE IF NOT EXISTS `accompte` (
  `id` int NOT NULL AUTO_INCREMENT,
  `devis_id` int NOT NULL,
  `prix` decimal(10,0) NOT NULL,
  `date` date NOT NULL,
  `payer` tinyint(1) NOT NULL,
  `observation` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`id`),
  KEY `IDX_BD09DAF741DEFADA` (`devis_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `adresse`
--

DROP TABLE IF EXISTS `adresse`;
CREATE TABLE IF NOT EXISTS `adresse` (
  `id` int NOT NULL AUTO_INCREMENT,
  `statut_id` int NOT NULL,
  `contact_id` int DEFAULT NULL,
  `produit_id` int DEFAULT NULL,
  `entreprise_id` int DEFAULT NULL,
  `rue` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `code_postal` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ville` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `departement` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `region` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pays` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `facturation` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_C35F0816F6203804` (`statut_id`),
  KEY `IDX_C35F0816E7A1254A` (`contact_id`),
  KEY `IDX_C35F0816F347EFB` (`produit_id`),
  KEY `IDX_C35F0816A4AEAFEA` (`entreprise_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `analyse`
--

DROP TABLE IF EXISTS `analyse`;
CREATE TABLE IF NOT EXISTS `analyse` (
  `id` int NOT NULL AUTO_INCREMENT,
  `produit_id` int NOT NULL,
  `titre` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `observations` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_351B0C7EF347EFB` (`produit_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `appels_recus`
--

DROP TABLE IF EXISTS `appels_recus`;
CREATE TABLE IF NOT EXISTS `appels_recus` (
  `id` int NOT NULL AUTO_INCREMENT,
  `contact_id` int DEFAULT NULL,
  `mission_id` int DEFAULT NULL,
  `date` datetime NOT NULL,
  `objet` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `appeller` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_2F9E5C3AE7A1254A` (`contact_id`),
  KEY `IDX_2F9E5C3ABE6CAE90` (`mission_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `classe`
--

DROP TABLE IF EXISTS `classe`;
CREATE TABLE IF NOT EXISTS `classe` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `classe`
--

INSERT INTO `classe` (`id`, `name`) VALUES
(1, 'Titre de propriété'),
(2, 'Indivision'),
(3, 'autre'),
(4, 'accès'),
(5, 'Limite'),
(6, 'Assiette'),
(7, 'Bornage'),
(8, 'Servitude de passage'),
(9, 'Servitude réseaux'),
(10, 'Négociation'),
(11, 'Offre');

-- --------------------------------------------------------

--
-- Structure de la table `communication`
--

DROP TABLE IF EXISTS `communication`;
CREATE TABLE IF NOT EXISTS `communication` (
  `id` int NOT NULL AUTO_INCREMENT,
  `tache_id` int NOT NULL,
  `statut_id` int NOT NULL,
  `description` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `forfait` decimal(10,2) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `payer` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_F9AFB5EBD2235D39` (`tache_id`),
  KEY `IDX_F9AFB5EBF6203804` (`statut_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `contact`
--

DROP TABLE IF EXISTS `contact`;
CREATE TABLE IF NOT EXISTS `contact` (
  `id` int NOT NULL AUTO_INCREMENT,
  `statut_id` int DEFAULT NULL,
  `nom` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `prenom` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `entreprise` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `poste` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_4C62E638F6203804` (`statut_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `contact`
--

INSERT INTO `contact` (`id`, `statut_id`, `nom`, `prenom`, `entreprise`, `poste`) VALUES
(1, 4, 'Cecile', 'Philippe', NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `deplacement`
--

DROP TABLE IF EXISTS `deplacement`;
CREATE TABLE IF NOT EXISTS `deplacement` (
  `id` int NOT NULL AUTO_INCREMENT,
  `tache_id` int DEFAULT NULL,
  `statut_id` int DEFAULT NULL,
  `lieu` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `date` datetime DEFAULT NULL,
  `duree` time DEFAULT NULL,
  `cout` decimal(10,2) DEFAULT NULL,
  `cout_peage` decimal(10,2) DEFAULT NULL,
  `cout_carburant` decimal(10,2) DEFAULT NULL,
  `observation` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `payer` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_1296FAC2D2235D39` (`tache_id`),
  KEY `IDX_1296FAC2F6203804` (`statut_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `devis`
--

DROP TABLE IF EXISTS `devis`;
CREATE TABLE IF NOT EXISTS `devis` (
  `id` int NOT NULL AUTO_INCREMENT,
  `mission_id` int NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_8B27C52BBE6CAE90` (`mission_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `devis_deplacement`
--

DROP TABLE IF EXISTS `devis_deplacement`;
CREATE TABLE IF NOT EXISTS `devis_deplacement` (
  `id` int NOT NULL AUTO_INCREMENT,
  `devis_id` int NOT NULL,
  `quantite` int NOT NULL,
  `prix` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_BCF731C341DEFADA` (`devis_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `devis_hebergement`
--

DROP TABLE IF EXISTS `devis_hebergement`;
CREATE TABLE IF NOT EXISTS `devis_hebergement` (
  `id` int NOT NULL AUTO_INCREMENT,
  `devis_id` int NOT NULL,
  `quantite` int NOT NULL,
  `prix_unitaire` decimal(5,2) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_E633169D41DEFADA` (`devis_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `devis_prestation`
--

DROP TABLE IF EXISTS `devis_prestation`;
CREATE TABLE IF NOT EXISTS `devis_prestation` (
  `id` int NOT NULL AUTO_INCREMENT,
  `devis_id` int NOT NULL,
  `quantite` int NOT NULL,
  `prix` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_E169C44541DEFADA` (`devis_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `devis_restauration`
--

DROP TABLE IF EXISTS `devis_restauration`;
CREATE TABLE IF NOT EXISTS `devis_restauration` (
  `id` int NOT NULL AUTO_INCREMENT,
  `devis_id` int NOT NULL,
  `quantite` int NOT NULL,
  `prix` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_FE224FAC41DEFADA` (`devis_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `devis_reunion`
--

DROP TABLE IF EXISTS `devis_reunion`;
CREATE TABLE IF NOT EXISTS `devis_reunion` (
  `id` int NOT NULL AUTO_INCREMENT,
  `devis_id` int NOT NULL,
  `quantite` int NOT NULL,
  `prix` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_C9EE3FDE41DEFADA` (`devis_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `doctrine_migration_versions`
--

DROP TABLE IF EXISTS `doctrine_migration_versions`;
CREATE TABLE IF NOT EXISTS `doctrine_migration_versions` (
  `version` varchar(191) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Déchargement des données de la table `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20231116163913', '2023-11-16 16:42:14', 2529),
('DoctrineMigrations\\Version20231117093825', '2023-11-17 09:38:35', 6765),
('DoctrineMigrations\\Version20231117094902', '2023-11-17 09:49:12', 44);

-- --------------------------------------------------------

--
-- Structure de la table `document`
--

DROP TABLE IF EXISTS `document`;
CREATE TABLE IF NOT EXISTS `document` (
  `id` int NOT NULL AUTO_INCREMENT,
  `tache_id` int DEFAULT NULL,
  `name` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `cout_achat_document` decimal(10,2) DEFAULT NULL,
  `cout_document_commande` decimal(10,2) DEFAULT NULL,
  `cout_document_produit` decimal(10,2) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `payer` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_D8698A76D2235D39` (`tache_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `entreprise`
--

DROP TABLE IF EXISTS `entreprise`;
CREATE TABLE IF NOT EXISTS `entreprise` (
  `id` int NOT NULL AUTO_INCREMENT,
  `statut_id` int NOT NULL,
  `raison_sociale` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `siret` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `naf` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_D19FA60F6203804` (`statut_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `etat`
--

DROP TABLE IF EXISTS `etat`;
CREATE TABLE IF NOT EXISTS `etat` (
  `id` int NOT NULL AUTO_INCREMENT,
  `etat` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `etat_des_lieux`
--

DROP TABLE IF EXISTS `etat_des_lieux`;
CREATE TABLE IF NOT EXISTS `etat_des_lieux` (
  `id` int NOT NULL AUTO_INCREMENT,
  `statut_id` int NOT NULL,
  `produit_id` int NOT NULL,
  `created_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `observation` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`id`),
  KEY `IDX_F7210312F6203804` (`statut_id`),
  KEY `IDX_F7210312F347EFB` (`produit_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `forfait`
--

DROP TABLE IF EXISTS `forfait`;
CREATE TABLE IF NOT EXISTS `forfait` (
  `id` int NOT NULL AUTO_INCREMENT,
  `tache_id` int NOT NULL,
  `description` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `prix` decimal(10,2) NOT NULL,
  `date` datetime NOT NULL,
  `payer` tinyint(1) NOT NULL,
  `date_reglement` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_BBB5C482D2235D39` (`tache_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `hebergement`
--

DROP TABLE IF EXISTS `hebergement`;
CREATE TABLE IF NOT EXISTS `hebergement` (
  `id` int NOT NULL AUTO_INCREMENT,
  `tache_id` int DEFAULT NULL,
  `nuit` int NOT NULL,
  `cout_nuit_unitaire` decimal(5,2) NOT NULL,
  `lieu` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `date` date NOT NULL,
  `payer` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_4852DD9CD2235D39` (`tache_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `historique`
--

DROP TABLE IF EXISTS `historique`;
CREATE TABLE IF NOT EXISTS `historique` (
  `id` int NOT NULL AUTO_INCREMENT,
  `contact_id` int DEFAULT NULL,
  `entreprise_id` int DEFAULT NULL,
  `produit_id` int DEFAULT NULL,
  `historique` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `title` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  PRIMARY KEY (`id`),
  KEY `IDX_EDBFD5ECE7A1254A` (`contact_id`),
  KEY `IDX_EDBFD5ECA4AEAFEA` (`entreprise_id`),
  KEY `IDX_EDBFD5ECF347EFB` (`produit_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `identification`
--

DROP TABLE IF EXISTS `identification`;
CREATE TABLE IF NOT EXISTS `identification` (
  `id` int NOT NULL AUTO_INCREMENT,
  `identification` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `identification`
--

INSERT INTO `identification` (`id`, `identification`) VALUES
(1, 'Foncier'),
(2, 'Immeuble'),
(3, 'Foncier + Immeuble'),
(4, 'Infrastructure'),
(5, 'Autre');

-- --------------------------------------------------------

--
-- Structure de la table `intervenant`
--

DROP TABLE IF EXISTS `intervenant`;
CREATE TABLE IF NOT EXISTS `intervenant` (
  `id` int NOT NULL AUTO_INCREMENT,
  `tache_id` int DEFAULT NULL,
  `statut_id` int NOT NULL,
  `entreprise_id` int DEFAULT NULL,
  `contact_id` int DEFAULT NULL,
  `produit_id` int DEFAULT NULL,
  `observation` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `cout` decimal(10,2) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `realisations` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `duree` time DEFAULT NULL,
  `payer` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_73D0145CD2235D39` (`tache_id`),
  KEY `IDX_73D0145CF6203804` (`statut_id`),
  KEY `IDX_73D0145CA4AEAFEA` (`entreprise_id`),
  KEY `IDX_73D0145CE7A1254A` (`contact_id`),
  KEY `IDX_73D0145CF347EFB` (`produit_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `mail`
--

DROP TABLE IF EXISTS `mail`;
CREATE TABLE IF NOT EXISTS `mail` (
  `id` int NOT NULL AUTO_INCREMENT,
  `statut_id` int NOT NULL,
  `contact_id` int NOT NULL,
  `entreprise_id` int DEFAULT NULL,
  `mission_id` int DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `objet` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
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
  `id` bigint NOT NULL AUTO_INCREMENT,
  `body` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `headers` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue_name` varchar(190) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
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
  `id` int NOT NULL AUTO_INCREMENT,
  `contact_id` int DEFAULT NULL,
  `entreprise_id` int DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `reference` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `localisation` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `stade` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_9067F23CE7A1254A` (`contact_id`),
  KEY `IDX_9067F23CA4AEAFEA` (`entreprise_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `mission`
--

INSERT INTO `mission` (`id`, `contact_id`, `entreprise_id`, `name`, `reference`, `localisation`, `stade`) VALUES
(1, 1, NULL, 'Larra-1', 'Lara1', 'Larra', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `mission_produit`
--

DROP TABLE IF EXISTS `mission_produit`;
CREATE TABLE IF NOT EXISTS `mission_produit` (
  `mission_id` int NOT NULL,
  `produit_id` int NOT NULL,
  PRIMARY KEY (`mission_id`,`produit_id`),
  KEY `IDX_B899786ABE6CAE90` (`mission_id`),
  KEY `IDX_B899786AF347EFB` (`produit_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `moyen`
--

DROP TABLE IF EXISTS `moyen`;
CREATE TABLE IF NOT EXISTS `moyen` (
  `id` int NOT NULL AUTO_INCREMENT,
  `tache_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_2D6523D6D2235D39` (`tache_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `note`
--

DROP TABLE IF EXISTS `note`;
CREATE TABLE IF NOT EXISTS `note` (
  `id` int NOT NULL AUTO_INCREMENT,
  `contact_id` int DEFAULT NULL,
  `entreprise_id` int DEFAULT NULL,
  `note` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`id`),
  KEY `IDX_CFBDFA14E7A1254A` (`contact_id`),
  KEY `IDX_CFBDFA14A4AEAFEA` (`entreprise_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `ouverture_dossier`
--

DROP TABLE IF EXISTS `ouverture_dossier`;
CREATE TABLE IF NOT EXISTS `ouverture_dossier` (
  `id` int NOT NULL AUTO_INCREMENT,
  `devis_id` int NOT NULL,
  `quantite` int NOT NULL,
  `prix` decimal(10,2) NOT NULL,
  `payer` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_4F94D6EB41DEFADA` (`devis_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `probleme`
--

DROP TABLE IF EXISTS `probleme`;
CREATE TABLE IF NOT EXISTS `probleme` (
  `id` int NOT NULL AUTO_INCREMENT,
  `statut_id` int NOT NULL,
  `mission_id` int NOT NULL,
  `classe_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_7AB2D714F6203804` (`statut_id`),
  KEY `IDX_7AB2D714BE6CAE90` (`mission_id`),
  KEY `IDX_7AB2D7148F5EA509` (`classe_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `probleme`
--

INSERT INTO `probleme` (`id`, `statut_id`, `mission_id`, `classe_id`) VALUES
(1, 1, 1, 2);

-- --------------------------------------------------------

--
-- Structure de la table `produit`
--

DROP TABLE IF EXISTS `produit`;
CREATE TABLE IF NOT EXISTS `produit` (
  `id` int NOT NULL AUTO_INCREMENT,
  `etat_id` int DEFAULT NULL,
  `identification_id` int DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `localisation` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `car_techniques` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `car_juridiques` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `car_commerciales` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `environement` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `observation` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`id`),
  KEY `IDX_29A5EC27D5E86FF` (`etat_id`),
  KEY `IDX_29A5EC274DFE3A85` (`identification_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `profession`
--

DROP TABLE IF EXISTS `profession`;
CREATE TABLE IF NOT EXISTS `profession` (
  `id` int NOT NULL AUTO_INCREMENT,
  `entreprise_id` int DEFAULT NULL,
  `contact_id` int DEFAULT NULL,
  `profession` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `poste` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
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
  `id` int NOT NULL AUTO_INCREMENT,
  `tache_id` int DEFAULT NULL,
  `cout_repas_personnel` decimal(10,0) DEFAULT NULL,
  `cout_repas_clients` decimal(10,2) DEFAULT NULL,
  `duree` time DEFAULT NULL,
  `forfait` decimal(10,2) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `etablissement` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payer` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_898B1EF1D2235D39` (`tache_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `reunion`
--

DROP TABLE IF EXISTS `reunion`;
CREATE TABLE IF NOT EXISTS `reunion` (
  `id` int NOT NULL AUTO_INCREMENT,
  `tache_id` int NOT NULL,
  `objet` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date` date DEFAULT NULL,
  `content` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cout_location_salle` decimal(10,2) DEFAULT NULL,
  `cout_location_materiel` decimal(10,2) DEFAULT NULL,
  `cout_restauration` decimal(10,2) DEFAULT NULL,
  `cout_collation` decimal(10,2) DEFAULT NULL,
  `duree` time DEFAULT NULL,
  `forfait_horaire` decimal(10,2) DEFAULT NULL,
  `payer` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_5B00A482D2235D39` (`tache_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `statut_adresse`
--

DROP TABLE IF EXISTS `statut_adresse`;
CREATE TABLE IF NOT EXISTS `statut_adresse` (
  `id` int NOT NULL AUTO_INCREMENT,
  `statut` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `statut_adresse`
--

INSERT INTO `statut_adresse` (`id`, `statut`) VALUES
(1, 'Bureau'),
(2, 'Domicile'),
(3, 'Autre');

-- --------------------------------------------------------

--
-- Structure de la table `statut_communication`
--

DROP TABLE IF EXISTS `statut_communication`;
CREATE TABLE IF NOT EXISTS `statut_communication` (
  `id` int NOT NULL AUTO_INCREMENT,
  `statut` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `statut_communication`
--

INSERT INTO `statut_communication` (`id`, `statut`) VALUES
(1, 'Téléphone'),
(2, 'Mail'),
(3, 'Courrier');

-- --------------------------------------------------------

--
-- Structure de la table `statut_contact`
--

DROP TABLE IF EXISTS `statut_contact`;
CREATE TABLE IF NOT EXISTS `statut_contact` (
  `id` int NOT NULL AUTO_INCREMENT,
  `statut` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `statut_contact`
--

INSERT INTO `statut_contact` (`id`, `statut`) VALUES
(1, 'Mandant'),
(2, 'Intervenant'),
(3, 'Prescripteur'),
(4, 'Contact'),
(5, 'Prospect'),
(6, '...');

-- --------------------------------------------------------

--
-- Structure de la table `statut_deplacement`
--

DROP TABLE IF EXISTS `statut_deplacement`;
CREATE TABLE IF NOT EXISTS `statut_deplacement` (
  `id` int NOT NULL AUTO_INCREMENT,
  `statut` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `statut_deplacement`
--

INSERT INTO `statut_deplacement` (`id`, `statut`) VALUES
(1, 'Voiture perso'),
(2, 'Taxi'),
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
  `id` int NOT NULL AUTO_INCREMENT,
  `statut` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `statut_etat_des_lieux`
--

DROP TABLE IF EXISTS `statut_etat_des_lieux`;
CREATE TABLE IF NOT EXISTS `statut_etat_des_lieux` (
  `id` int NOT NULL AUTO_INCREMENT,
  `statut` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `statut_etat_des_lieux`
--

INSERT INTO `statut_etat_des_lieux` (`id`, `statut`) VALUES
(1, 'Borne'),
(2, 'Electricité'),
(3, 'Eau potable'),
(4, 'Servitudes de passage'),
(5, 'Servitudes de reseaux'),
(6, 'Nuissances sonores'),
(7, 'Nuissances olfactives'),
(8, 'Clôtures'),
(9, 'composition et état des bâtiments'),
(10, 'composition et état des bâtiments'),
(11, 'accès et praticabilité'),
(12, 'Inondations'),
(13, 'problèmes de voisinage'),
(14, 'couloir aérien'),
(15, 'emplacement réservé'),
(16, 'projet à proximité'),
(17, 'risque incendie'),
(18, 'abf'),
(19, 'diagnostic archéologique'),
(20, 'contact des voisins'),
(21, 'contacts adm'),
(22, 'stationnement et parking nb'),
(23, 'Histoire du secteur et du site'),
(24, 'indices de valorisation du site'),
(25, 'autres');

-- --------------------------------------------------------

--
-- Structure de la table `statut_intervenant`
--

DROP TABLE IF EXISTS `statut_intervenant`;
CREATE TABLE IF NOT EXISTS `statut_intervenant` (
  `id` int NOT NULL AUTO_INCREMENT,
  `statut` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `statut_intervenant`
--

INSERT INTO `statut_intervenant` (`id`, `statut`) VALUES
(1, 'Client'),
(2, 'Mandant'),
(3, 'Intervenant'),
(4, 'Prescripteur'),
(5, 'Contact'),
(6, 'Prospect'),
(7, 'Autre');

-- --------------------------------------------------------

--
-- Structure de la table `statut_mail`
--

DROP TABLE IF EXISTS `statut_mail`;
CREATE TABLE IF NOT EXISTS `statut_mail` (
  `id` int NOT NULL AUTO_INCREMENT,
  `statut` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `statut_mail`
--

INSERT INTO `statut_mail` (`id`, `statut`) VALUES
(1, 'Personnel'),
(2, 'Personnel'),
(3, 'Autre');

-- --------------------------------------------------------

--
-- Structure de la table `statut_probleme`
--

DROP TABLE IF EXISTS `statut_probleme`;
CREATE TABLE IF NOT EXISTS `statut_probleme` (
  `id` int NOT NULL AUTO_INCREMENT,
  `statut` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `statut_probleme`
--

INSERT INTO `statut_probleme` (`id`, `statut`) VALUES
(1, 'Juridique'),
(2, 'Technique'),
(3, 'Commercial');

-- --------------------------------------------------------

--
-- Structure de la table `statut_tache`
--

DROP TABLE IF EXISTS `statut_tache`;
CREATE TABLE IF NOT EXISTS `statut_tache` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `statut_tache`
--

INSERT INTO `statut_tache` (`id`, `name`) VALUES
(1, 'A faire'),
(2, 'En cours'),
(3, 'ok');

-- --------------------------------------------------------

--
-- Structure de la table `statut_telephone`
--

DROP TABLE IF EXISTS `statut_telephone`;
CREATE TABLE IF NOT EXISTS `statut_telephone` (
  `id` int NOT NULL AUTO_INCREMENT,
  `statut` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `statut_telephone`
--

INSERT INTO `statut_telephone` (`id`, `statut`) VALUES
(1, 'Bureau'),
(2, 'Domicile'),
(3, 'Portable');

-- --------------------------------------------------------

--
-- Structure de la table `tache`
--

DROP TABLE IF EXISTS `tache`;
CREATE TABLE IF NOT EXISTS `tache` (
  `id` int NOT NULL AUTO_INCREMENT,
  `probleme_id` int NOT NULL,
  `statut_id` int NOT NULL,
  `description` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `date` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_9387207596784F9E` (`probleme_id`),
  KEY `IDX_93872075F6203804` (`statut_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `tache`
--

INSERT INTO `tache` (`id`, `probleme_id`, `statut_id`, `description`, `date`) VALUES
(1, 1, 1, 'Contacter le notaire', '2023-11-17 11:43:00'),
(2, 1, 2, 'courir cet aprem midi', '2023-11-17 11:59:00');

-- --------------------------------------------------------

--
-- Structure de la table `telephone`
--

DROP TABLE IF EXISTS `telephone`;
CREATE TABLE IF NOT EXISTS `telephone` (
  `id` int NOT NULL AUTO_INCREMENT,
  `statut_id` int NOT NULL,
  `entreprise_id` int DEFAULT NULL,
  `contact_id` int DEFAULT NULL,
  `number` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `observation` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`id`),
  KEY `IDX_450FF010F6203804` (`statut_id`),
  KEY `IDX_450FF010A4AEAFEA` (`entreprise_id`),
  KEY `IDX_450FF010E7A1254A` (`contact_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(180) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` json NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `nom` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `prenom` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reset_token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_8D93D649E7927C74` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `email`, `roles`, `password`, `nom`, `prenom`, `reset_token`) VALUES
(1, 'tom@tom.fr', '[\"ROLE_USER\"]', '$2y$13$rFXpDaf6Ke/jvJ9dgReEjugh1CFArVjRSe/VnWI2Dzs/nKz1U9LFW', 'tom', 'tom', NULL);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `accompte`
--
ALTER TABLE `accompte`
  ADD CONSTRAINT `FK_BD09DAF741DEFADA` FOREIGN KEY (`devis_id`) REFERENCES `devis` (`id`);

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
-- Contraintes pour la table `contact`
--
ALTER TABLE `contact`
  ADD CONSTRAINT `FK_4C62E638F6203804` FOREIGN KEY (`statut_id`) REFERENCES `statut_contact` (`id`);

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
  ADD CONSTRAINT `FK_8B27C52BBE6CAE90` FOREIGN KEY (`mission_id`) REFERENCES `mission` (`id`);

--
-- Contraintes pour la table `devis_deplacement`
--
ALTER TABLE `devis_deplacement`
  ADD CONSTRAINT `FK_BCF731C341DEFADA` FOREIGN KEY (`devis_id`) REFERENCES `devis` (`id`);

--
-- Contraintes pour la table `devis_hebergement`
--
ALTER TABLE `devis_hebergement`
  ADD CONSTRAINT `FK_E633169D41DEFADA` FOREIGN KEY (`devis_id`) REFERENCES `devis` (`id`);

--
-- Contraintes pour la table `devis_prestation`
--
ALTER TABLE `devis_prestation`
  ADD CONSTRAINT `FK_E169C44541DEFADA` FOREIGN KEY (`devis_id`) REFERENCES `devis` (`id`);

--
-- Contraintes pour la table `devis_restauration`
--
ALTER TABLE `devis_restauration`
  ADD CONSTRAINT `FK_FE224FAC41DEFADA` FOREIGN KEY (`devis_id`) REFERENCES `devis` (`id`);

--
-- Contraintes pour la table `devis_reunion`
--
ALTER TABLE `devis_reunion`
  ADD CONSTRAINT `FK_C9EE3FDE41DEFADA` FOREIGN KEY (`devis_id`) REFERENCES `devis` (`id`);

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
-- Contraintes pour la table `mission`
--
ALTER TABLE `mission`
  ADD CONSTRAINT `FK_9067F23CA4AEAFEA` FOREIGN KEY (`entreprise_id`) REFERENCES `entreprise` (`id`),
  ADD CONSTRAINT `FK_9067F23CE7A1254A` FOREIGN KEY (`contact_id`) REFERENCES `contact` (`id`);

--
-- Contraintes pour la table `mission_produit`
--
ALTER TABLE `mission_produit`
  ADD CONSTRAINT `FK_B899786ABE6CAE90` FOREIGN KEY (`mission_id`) REFERENCES `mission` (`id`) ON DELETE CASCADE,
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
-- Contraintes pour la table `ouverture_dossier`
--
ALTER TABLE `ouverture_dossier`
  ADD CONSTRAINT `FK_4F94D6EB41DEFADA` FOREIGN KEY (`devis_id`) REFERENCES `devis` (`id`);

--
-- Contraintes pour la table `probleme`
--
ALTER TABLE `probleme`
  ADD CONSTRAINT `FK_7AB2D7148F5EA509` FOREIGN KEY (`classe_id`) REFERENCES `classe` (`id`),
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
  ADD CONSTRAINT `FK_9387207596784F9E` FOREIGN KEY (`probleme_id`) REFERENCES `probleme` (`id`),
  ADD CONSTRAINT `FK_93872075F6203804` FOREIGN KEY (`statut_id`) REFERENCES `statut_tache` (`id`);

--
-- Contraintes pour la table `telephone`
--
ALTER TABLE `telephone`
  ADD CONSTRAINT `FK_450FF010A4AEAFEA` FOREIGN KEY (`entreprise_id`) REFERENCES `entreprise` (`id`),
  ADD CONSTRAINT `FK_450FF010E7A1254A` FOREIGN KEY (`contact_id`) REFERENCES `contact` (`id`),
  ADD CONSTRAINT `FK_450FF010F6203804` FOREIGN KEY (`statut_id`) REFERENCES `statut_telephone` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
