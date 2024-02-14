-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : ven. 17 fév. 2023 à 10:18
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
  PRIMARY KEY (`id`),
  KEY `IDX_C35F0816F6203804` (`statut_id`),
  KEY `IDX_C35F0816E7A1254A` (`contact_id`),
  KEY `IDX_C35F0816F347EFB` (`produit_id`),
  KEY `IDX_C35F0816A4AEAFEA` (`entreprise_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `adresse`
--

INSERT INTO `adresse` (`id`, `statut_id`, `contact_id`, `produit_id`, `entreprise_id`, `rue`, `code_postal`, `ville`, `departement`, `region`, `pays`) VALUES
(1, 2, 2, NULL, NULL, '11 place des coquelicots', '31330', 'Larra', 'Haute garrone', 'Occcitanie', 'France');

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
  `cout` decimal(10,2) DEFAULT NULL,
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
  `statut_id` int(11) NOT NULL,
  `tache_id` int(11) DEFAULT NULL,
  `date` datetime DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)',
  `lieu` longtext COLLATE utf8mb4_unicode_ci,
  `cout` decimal(5,2) DEFAULT NULL,
  `observation` longtext COLLATE utf8mb4_unicode_ci,
  `cout_peage` decimal(5,2) DEFAULT NULL,
  `cout_carburant` decimal(5,2) DEFAULT NULL,
  `duree` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_1296FAC2F6203804` (`statut_id`),
  KEY `IDX_1296FAC2D2235D39` (`tache_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `deplacement`
--

INSERT INTO `deplacement` (`id`, `statut_id`, `tache_id`, `date`, `lieu`, `cout`, `observation`, `cout_peage`, `cout_carburant`, `duree`) VALUES
(1, 1, 4, '2023-02-10 10:40:11', 'paris', '100.00', NULL, NULL, NULL, '2 jours');

-- --------------------------------------------------------

--
-- Structure de la table `devis`
--

DROP TABLE IF EXISTS `devis`;
CREATE TABLE IF NOT EXISTS `devis` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mission_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_8B27C52BBE6CAE90` (`mission_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `devis`
--

INSERT INTO `devis` (`id`, `mission_id`, `name`) VALUES
(2, 3, 'Devis biberon'),
(4, 3, 'hjgj');

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
('DoctrineMigrations\\Version20230120081940', '2023-01-20 08:19:48', 204),
('DoctrineMigrations\\Version20230130131806', '2023-01-30 13:18:17', 1109),
('DoctrineMigrations\\Version20230131162416', '2023-01-31 16:24:25', 259),
('DoctrineMigrations\\Version20230131163601', '2023-01-31 16:36:25', 84),
('DoctrineMigrations\\Version20230203083352', '2023-02-03 08:34:00', 276),
('DoctrineMigrations\\Version20230203083554', '2023-02-03 08:36:02', 64),
('DoctrineMigrations\\Version20230203094547', '2023-02-03 09:45:55', 94),
('DoctrineMigrations\\Version20230217100722', '2023-02-17 10:07:31', 524),
('DoctrineMigrations\\Version20230217101345', '2023-02-17 10:13:53', 111);

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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `document`
--

INSERT INTO `document` (`id`, `tache_id`, `name`, `cout_achat_document`, `cout_document_commande`, `cout_document_produit`) VALUES
(1, 3, 'marvin-trouver les bornes-63ef463970550.jpg', NULL, NULL, NULL);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `forfait`
--

INSERT INTO `forfait` (`id`, `tache_id`, `description`, `prix`) VALUES
(1, 4, 'total', '500.00'),
(3, 3, NULL, '255.00');

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

--
-- Déchargement des données de la table `hebergement`
--

INSERT INTO `hebergement` (`id`, `tache_id`, `nuit`, `cout_nuit_unitaire`, `lieu`, `date`) VALUES
(1, 3, 2, '55.00', 'Paris', '2023-03-03'),
(2, 3, 2, '61.23', 'Marseille', '2023-02-10'),
(3, 4, 2, '45.00', NULL, '2023-02-10');

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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `historique`
--

INSERT INTO `historique` (`id`, `contact_id`, `entreprise_id`, `produit_id`, `historique`, `title`, `created_at`) VALUES
(5, NULL, NULL, 3, 'Famille compliquée , contacter le père', 'Historique 1', '2022-12-15 14:12:12'),
(6, NULL, NULL, 4, 'Hello le monde', 'Historique 123', '2022-12-15 15:05:19');

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
  `statut_id` int(11) DEFAULT NULL,
  `entreprise_id` int(11) DEFAULT NULL,
  `contact_id` int(11) DEFAULT NULL,
  `observation` longtext COLLATE utf8mb4_unicode_ci,
  `cout` decimal(10,0) DEFAULT NULL,
  `duree` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `realisations` longtext COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`id`),
  KEY `IDX_73D0145CF347EFB` (`produit_id`),
  KEY `IDX_73D0145CD2235D39` (`tache_id`),
  KEY `IDX_73D0145CF6203804` (`statut_id`),
  KEY `IDX_73D0145CA4AEAFEA` (`entreprise_id`),
  KEY `IDX_73D0145CE7A1254A` (`contact_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `intervenant`
--

INSERT INTO `intervenant` (`id`, `produit_id`, `tache_id`, `statut_id`, `entreprise_id`, `contact_id`, `observation`, `cout`, `duree`, `date`, `realisations`) VALUES
(1, 3, NULL, 3, NULL, 2, NULL, NULL, NULL, NULL, NULL),
(2, 3, NULL, 1, NULL, 1, NULL, NULL, NULL, NULL, NULL),
(6, 3, NULL, 3, NULL, 3, NULL, NULL, NULL, NULL, NULL),
(7, 4, NULL, 1, NULL, 2, NULL, NULL, NULL, NULL, NULL),
(8, 5, NULL, NULL, NULL, 3, NULL, NULL, NULL, NULL, NULL),
(10, NULL, 3, NULL, NULL, 4, NULL, '350', '2 heures', '2023-02-03 10:38:00', 'Bornage du terrrain'),
(11, NULL, 3, NULL, NULL, 2, NULL, '10', '5 heures', '2023-02-10 10:37:00', NULL),
(12, NULL, 4, NULL, NULL, 2, 'long trajet', NULL, NULL, '2023-02-10 11:40:00', 'Obtention de documents');

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
(3, 'Biberon', 'bibi', 'bordeaux', 'en bon état');

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
(3, 3),
(3, 5);

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
  `devis_id` int(11) NOT NULL,
  `statut_id` int(11) NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_7AB2D71441DEFADA` (`devis_id`),
  KEY `IDX_7AB2D714F6203804` (`statut_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `probleme`
--

INSERT INTO `probleme` (`id`, `devis_id`, `statut_id`, `description`) VALUES
(2, 2, 1, 'bornes'),
(3, 2, 1, 'indivision'),
(4, 2, 1, 'hgfgh');

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
(3, 1, 1, 'Larra Maison 1', 'larra*1', 'bornes', 'Terrain dans l\'indivision', 'vendu 1 fois gjfgtfhg', 'Terrain encombré de déchets', NULL),
(4, 2, 1, 'Lyon 1', 'Lyon en périphérique', NULL, NULL, NULL, NULL, NULL),
(5, 3, 3, 'Le domaine de séverain', NULL, NULL, 'indivision', 'uhyjksifhzsdjhfds', NULL, 'ezfrazefrez');

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
  `durée` time DEFAULT NULL,
  `forfait` decimal(10,2) DEFAULT NULL,
  `date` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_898B1EF1D2235D39` (`tache_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
  PRIMARY KEY (`id`),
  KEY `IDX_5B00A482D2235D39` (`tache_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `tache`
--

INSERT INTO `tache` (`id`, `probleme_id`, `description`) VALUES
(3, 2, 'trouver les bornes'),
(4, 3, 'rendez vous chez le notaire');

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
  ADD CONSTRAINT `FK_7AB2D71441DEFADA` FOREIGN KEY (`devis_id`) REFERENCES `devis` (`id`),
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
