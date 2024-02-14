-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mar. 18 juil. 2023 à 08:35
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
-- Base de données : `renfortimmo`
--

-- --------------------------------------------------------

--
-- Structure de la table `accompte`
--

DROP TABLE IF EXISTS `accompte`;
CREATE TABLE IF NOT EXISTS `accompte` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `devis_id` int(11) NOT NULL,
  `prix` decimal(10,0) NOT NULL,
  `date` date NOT NULL,
  `payer` tinyint(1) NOT NULL,
  `observation` longtext COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`id`),
  KEY `IDX_BD09DAF741DEFADA` (`devis_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `adresse`
--

INSERT INTO `adresse` (`id`, `statut_id`, `contact_id`, `produit_id`, `entreprise_id`, `rue`, `code_postal`, `ville`, `departement`, `region`, `pays`, `facturation`) VALUES
(1, 2, 1, NULL, NULL, '11 place des coquelicots', '31330', 'Larra', NULL, NULL, NULL, 1);

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
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `contact_id` int(11) DEFAULT NULL,
  `mission_id` int(11) DEFAULT NULL,
  `date` datetime NOT NULL,
  `objet` longtext COLLATE utf8mb4_unicode_ci,
  `appeller` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_2F9E5C3AE7A1254A` (`contact_id`),
  KEY `IDX_2F9E5C3ABE6CAE90` (`mission_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
  `payer` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_F9AFB5EBD2235D39` (`tache_id`),
  KEY `IDX_F9AFB5EBF6203804` (`statut_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `communication`
--

INSERT INTO `communication` (`id`, `tache_id`, `statut_id`, `description`, `forfait`, `date`, `payer`) VALUES
(1, 1, 1, NULL, '10.00', '2023-07-05 13:26:00', 0);

-- --------------------------------------------------------

--
-- Structure de la table `contact`
--

DROP TABLE IF EXISTS `contact`;
CREATE TABLE IF NOT EXISTS `contact` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `prenom` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `statut_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_4C62E638F6203804` (`statut_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `contact`
--

INSERT INTO `contact` (`id`, `nom`, `prenom`, `statut_id`) VALUES
(1, 'Cecile', 'Philippe', 1);

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
  `payer` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_1296FAC2D2235D39` (`tache_id`),
  KEY `IDX_1296FAC2F6203804` (`statut_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `deplacement`
--

INSERT INTO `deplacement` (`id`, `tache_id`, `statut_id`, `lieu`, `date`, `duree`, `cout`, `cout_peage`, `cout_carburant`, `observation`, `payer`) VALUES
(1, 1, 1, 'toulouse', '2023-07-05 06:50:21', '00:50:00', '10.00', NULL, '10.00', NULL, 0);

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
  PRIMARY KEY (`id`),
  KEY `IDX_8B27C52BBE6CAE90` (`mission_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `devis_deplacement`
--

DROP TABLE IF EXISTS `devis_deplacement`;
CREATE TABLE IF NOT EXISTS `devis_deplacement` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `devis_id` int(11) NOT NULL,
  `quantite` int(11) NOT NULL,
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
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `devis_id` int(11) NOT NULL,
  `quantite` int(11) NOT NULL,
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
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `devis_id` int(11) NOT NULL,
  `quantite` int(11) NOT NULL,
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
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `devis_id` int(11) NOT NULL,
  `quantite` int(11) NOT NULL,
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
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `devis_id` int(11) NOT NULL,
  `quantite` int(11) NOT NULL,
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
  `version` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20230701113020', '2023-07-01 11:30:30', 3722),
('DoctrineMigrations\\Version20230703093615', '2023-07-03 09:36:22', 211),
('DoctrineMigrations\\Version20230703121230', '2023-07-03 12:12:37', 208),
('DoctrineMigrations\\Version20230717143009', '2023-07-17 14:30:38', 88);

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
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `statut_id` int(11) NOT NULL,
  `raison_sociale` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `siret` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `naf` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_D19FA60F6203804` (`statut_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(2, 'à rénover'),
(3, 'à détruire'),
(4, 'à trouver'),
(5, 'à acheter'),
(6, 'à vendre');

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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `etat_des_lieux`
--

INSERT INTO `etat_des_lieux` (`id`, `statut_id`, `produit_id`, `created_at`, `observation`) VALUES
(1, 1, 2, '2023-07-18 00:00:00', 'reperer les bornes');

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
  `date` datetime NOT NULL,
  `payer` tinyint(1) NOT NULL,
  `date_reglement` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_BBB5C482D2235D39` (`tache_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `forfait`
--

INSERT INTO `forfait` (`id`, `tache_id`, `description`, `prix`, `date`, `payer`, `date_reglement`) VALUES
(1, 1, 'au secours', '12.00', '2023-07-05 13:25:00', 1, NULL);

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
  `payer` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_4852DD9CD2235D39` (`tache_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `hebergement`
--

INSERT INTO `hebergement` (`id`, `tache_id`, `nuit`, `cout_nuit_unitaire`, `lieu`, `date`, `payer`) VALUES
(1, 1, 1, '15.00', 'bordeaux', '2023-07-05', 0);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
  `tache_id` int(11) DEFAULT NULL,
  `statut_id` int(11) NOT NULL,
  `entreprise_id` int(11) DEFAULT NULL,
  `contact_id` int(11) DEFAULT NULL,
  `observation` longtext COLLATE utf8mb4_unicode_ci,
  `cout` decimal(10,2) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `realisations` longtext COLLATE utf8mb4_unicode_ci,
  `duree` time DEFAULT NULL,
  `payer` tinyint(1) NOT NULL,
  `produit_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_73D0145CD2235D39` (`tache_id`),
  KEY `IDX_73D0145CF6203804` (`statut_id`),
  KEY `IDX_73D0145CA4AEAFEA` (`entreprise_id`),
  KEY `IDX_73D0145CE7A1254A` (`contact_id`),
  KEY `IDX_73D0145CF347EFB` (`produit_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `intervenant`
--

INSERT INTO `intervenant` (`id`, `tache_id`, `statut_id`, `entreprise_id`, `contact_id`, `observation`, `cout`, `date`, `realisations`, `duree`, `payer`, `produit_id`) VALUES
(3, 1, 1, NULL, 1, 'int', '10.00', '2023-07-05 10:18:00', NULL, '00:30:00', 0, NULL),
(4, 1, 1, NULL, 1, 'hello', '10.00', '2023-07-05 14:51:00', NULL, '00:10:00', 0, NULL),
(5, 2, 5, NULL, 1, NULL, '10.00', '2023-07-13 15:19:00', 'pose des bornes', '00:50:00', 1, NULL);

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
  `contact_id` int(11) DEFAULT NULL,
  `entreprise_id` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `reference` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `localisation` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `stade` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_9067F23CE7A1254A` (`contact_id`),
  KEY `IDX_9067F23CA4AEAFEA` (`entreprise_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `mission`
--

INSERT INTO `mission` (`id`, `contact_id`, `entreprise_id`, `name`, `reference`, `localisation`, `stade`) VALUES
(1, 1, NULL, 'Larra - 1', 'Larra1', 'Larra', 'LMD'),
(2, 1, NULL, 'Toulouse', 'toulouse1', 'toulouse', 'a vendre');

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
(1, 2);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `ouverture_dossier`
--

DROP TABLE IF EXISTS `ouverture_dossier`;
CREATE TABLE IF NOT EXISTS `ouverture_dossier` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `devis_id` int(11) NOT NULL,
  `quantite` int(11) NOT NULL,
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
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `statut_id` int(11) NOT NULL,
  `mission_id` int(11) NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_7AB2D714F6203804` (`statut_id`),
  KEY `IDX_7AB2D714BE6CAE90` (`mission_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `probleme`
--

INSERT INTO `probleme` (`id`, `statut_id`, `mission_id`, `description`) VALUES
(1, 1, 1, 'borne'),
(2, 1, 2, 'borne');

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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `produit`
--

INSERT INTO `produit` (`id`, `etat_id`, `identification_id`, `name`, `localisation`, `car_techniques`, `car_juridiques`, `car_commerciales`, `environement`, `observation`) VALUES
(2, 2, 3, 'Chateau Larra', NULL, NULL, NULL, NULL, NULL, NULL);

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
  `payer` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_898B1EF1D2235D39` (`tache_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `restauration`
--

INSERT INTO `restauration` (`id`, `tache_id`, `cout_repas_personnel`, `cout_repas_clients`, `duree`, `forfait`, `date`, `etablissement`, `payer`) VALUES
(1, 1, '10', NULL, '01:00:00', NULL, '2023-07-05', 'Mc do', 0);

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
  `payer` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_5B00A482D2235D39` (`tache_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `reunion`
--

INSERT INTO `reunion` (`id`, `tache_id`, `objet`, `date`, `content`, `cout_location_salle`, `cout_location_materiel`, `cout_restauration`, `cout_collation`, `duree`, `forfait_horaire`, `payer`) VALUES
(1, 1, NULL, '2023-07-05', NULL, '10.00', NULL, NULL, NULL, '01:00:00', NULL, 0);

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
(1, 'Bureau'),
(2, 'Domicile'),
(3, 'Autre');

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
(1, 'Telephone'),
(2, 'Mail'),
(3, 'courrier');

-- --------------------------------------------------------

--
-- Structure de la table `statut_contact`
--

DROP TABLE IF EXISTS `statut_contact`;
CREATE TABLE IF NOT EXISTS `statut_contact` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `statut` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `statut_contact`
--

INSERT INTO `statut_contact` (`id`, `statut`) VALUES
(1, 'Client'),
(2, 'Mandant'),
(3, 'Prescripteur'),
(4, 'Contact'),
(5, 'prospect');

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
(1, 'Voiture'),
(2, 'Taxi'),
(3, 'Train'),
(4, 'Tram'),
(5, 'Metro'),
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(1, 'Bornes'),
(2, 'Electricité'),
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
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `statut` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(1, 'Juridique'),
(2, 'Technique'),
(3, 'Commercial');

-- --------------------------------------------------------

--
-- Structure de la table `statut_telephone`
--

DROP TABLE IF EXISTS `statut_telephone`;
CREATE TABLE IF NOT EXISTS `statut_telephone` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `statut` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `tache`
--

INSERT INTO `tache` (`id`, `probleme_id`, `description`) VALUES
(1, 1, 'Voir le Géomètre'),
(2, 2, 'ajuster les bornes');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Contraintes pour la table `ouverture_dossier`
--
ALTER TABLE `ouverture_dossier`
  ADD CONSTRAINT `FK_4F94D6EB41DEFADA` FOREIGN KEY (`devis_id`) REFERENCES `devis` (`id`);

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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
