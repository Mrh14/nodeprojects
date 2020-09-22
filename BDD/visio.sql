-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  mar. 22 sep. 2020 à 16:22
-- Version du serveur :  10.4.8-MariaDB
-- Version de PHP :  7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `visio`
--

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

CREATE TABLE `categories` (
  `id_cat` int(11) NOT NULL,
  `categorie` varchar(512) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `slug` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf32;

--
-- Déchargement des données de la table `categories`
--

INSERT INTO `categories` (`id_cat`, `categorie`, `created_date`, `slug`) VALUES
(1, 'interets', '2020-06-28 23:35:06', 'interets'),
(2, 'diet', '2020-06-28 23:35:06', NULL),
(4, 'loisirs', '2020-08-22 00:29:20', 'loisirs');

-- --------------------------------------------------------

--
-- Structure de la table `choix`
--

CREATE TABLE `choix` (
  `idchoix` int(11) NOT NULL,
  `choix` varchar(256) NOT NULL,
  `dateCreation` timestamp NOT NULL DEFAULT current_timestamp(),
  `idquestion` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf32;

--
-- Déchargement des données de la table `choix`
--

INSERT INTO `choix` (`idchoix`, `choix`, `dateCreation`, `idquestion`) VALUES
(1, 'natation', '2020-06-28 23:38:49', 1),
(2, 'la course', '2020-06-28 23:38:49', 1),
(3, 'cyclisme', '2020-06-28 23:38:49', 1),
(4, 'couscous', '2020-06-29 13:40:25', 2),
(5, 'tacos', '2020-06-29 13:40:25', 2),
(6, 'poissons', '2020-06-29 13:40:25', 2),
(7, 'oui', '2020-06-29 13:50:06', 3),
(8, 'non', '2020-06-29 13:50:06', 3),
(9, 'rarement', '2020-06-29 13:50:06', 3),
(10, 'js', '2020-07-02 14:09:21', 4),
(11, 'java', '2020-07-02 14:09:21', 4),
(12, 'php', '2020-07-02 14:09:21', 4),
(13, 'pomme', '2020-07-02 14:10:29', 5),
(14, 'orange', '2020-07-02 14:10:29', 5),
(15, 'cerise', '2020-07-02 14:10:29', 5),
(16, 'choix11', '2020-08-19 09:57:00', 6),
(17, 'choix22', '2020-08-19 09:57:00', 6),
(18, 'choix33', '2020-08-19 09:57:00', 6),
(19, 'rouge', '2020-08-21 20:55:29', 7),
(20, 'vert', '2020-08-21 20:55:29', 7),
(21, 'bleue', '2020-08-21 20:55:29', 7);

-- --------------------------------------------------------

--
-- Structure de la table `client`
--

CREATE TABLE `client` (
  `idCompte` int(11) NOT NULL,
  `nom` varchar(50) DEFAULT NULL,
  `prenom` varchar(50) DEFAULT NULL,
  `sexe` varchar(50) DEFAULT NULL,
  `taille` int(11) DEFAULT NULL,
  `poids` int(11) DEFAULT NULL,
  `tel` varchar(18) DEFAULT NULL,
  `naissance` varchar(50) DEFAULT NULL,
  `type_co` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `pass` varchar(50) DEFAULT NULL,
  `url` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `client`
--

INSERT INTO `client` (`idCompte`, `nom`, `prenom`, `sexe`, `taille`, `poids`, `tel`, `naissance`, `type_co`, `email`, `pass`, `url`) VALUES
(1, 'aaaaaa', 'kaaa', 'f', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2, 'Abderrahmane', 'ELfannir', 'f', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(3, 'Mrah', 'Amine', 'f', 179, 53, '+33690922699', '01012000', 'court', 'aelfannir@gmail.com', '123456', NULL),
(4, 'Abd', 'ELfannir', 'Array', 123, 53, '+33690922699', '01012000', 'court', 'aelfannir@gmail.com', '123456', NULL),
(6, 'Abderrahmane', 'ELfannir', 'Homme', 123, 53, '+33690922699', '01012000', 'court', 'aelfannir@gmail.com', '11111', NULL),
(7, 'fati', 'ELfannir', 'femme', 179, 53, '+33690922699', '01012000', 'court', 'aelfannir@gmail.com', '111111', NULL),
(8, 'Mrah', 'Amine', 'Homme', 123, 53, '+33690922699', '01012000', 'court', 'aelfannir@gmail.com', '123456', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `contact`
--

CREATE TABLE `contact` (
  `idcontact` int(11) NOT NULL,
  `cnom` varchar(50) DEFAULT NULL,
  `cobjet` varchar(255) DEFAULT NULL,
  `cmessage` text NOT NULL,
  `ctel` varchar(20) NOT NULL,
  `datecontact` timestamp NOT NULL DEFAULT current_timestamp(),
  `cemail` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf32;

-- --------------------------------------------------------

--
-- Structure de la table `messages`
--

CREATE TABLE `messages` (
  `idm` int(5) NOT NULL,
  `idr` int(5) NOT NULL,
  `idrec` int(5) NOT NULL,
  `msg` text DEFAULT NULL,
  `filePath` text DEFAULT NULL,
  `tMsg` int(1) DEFAULT NULL,
  `dateMsg` timestamp NOT NULL DEFAULT current_timestamp(),
  `idem` int(5) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf32;

--
-- Déchargement des données de la table `messages`
--

INSERT INTO `messages` (`idm`, `idr`, `idrec`, `msg`, `filePath`, `tMsg`, `dateMsg`, `idem`) VALUES
(41, 82, 4, 'bonjour', '', 0, '2020-08-25 14:30:50', 2),
(39, 82, 4, 'hi', '', 0, '2020-08-25 14:08:42', 2),
(40, 82, 2, 'hi', '', 0, '2020-08-25 14:08:47', 4),
(38, 20, 2, 'hi', '', 0, '2020-07-05 18:43:28', 1),
(36, 20, 2, 'ok', '', 0, '2020-07-05 18:41:49', 1),
(37, 20, 2, 'ohh', '', 0, '2020-07-05 18:42:08', 1),
(33, 20, 2, 'hi', '', 0, '2020-07-05 18:30:29', 1),
(34, 20, 2, 'yes', '', 0, '2020-07-05 18:41:38', 1),
(35, 20, 1, 'thx', '', 0, '2020-07-05 18:41:44', 2);

-- --------------------------------------------------------

--
-- Structure de la table `packs`
--

CREATE TABLE `packs` (
  `idpack` int(11) NOT NULL,
  `packname` varchar(512) NOT NULL,
  `nbvisio` int(5) NOT NULL,
  `nbpublic` int(5) NOT NULL,
  `nbdomicile` int(5) NOT NULL,
  `hrvisio` float NOT NULL,
  `hrpublic` float NOT NULL,
  `hrdomicile` float NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `pnom` varchar(15) DEFAULT NULL,
  `Emetteur` int(11) DEFAULT NULL,
  `nbJours` int(11) DEFAULT NULL,
  `nbMois` int(11) DEFAULT NULL,
  `premierRdv` float DEFAULT NULL,
  `deuxiemeRdv` float DEFAULT NULL,
  `amount` float DEFAULT NULL,
  `prvisio` float DEFAULT NULL,
  `prpublic` float DEFAULT NULL,
  `prdomicile` float DEFAULT NULL,
  `picture` varchar(512) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf32;

--
-- Déchargement des données de la table `packs`
--

INSERT INTO `packs` (`idpack`, `packname`, `nbvisio`, `nbpublic`, `nbdomicile`, `hrvisio`, `hrpublic`, `hrdomicile`, `created_at`, `pnom`, `Emetteur`, `nbJours`, `nbMois`, `premierRdv`, `deuxiemeRdv`, `amount`, `prvisio`, `prpublic`, `prdomicile`, `picture`) VALUES
(1, '1 mois', 3, 0, 0, 1.5, 0, 0, '2020-06-25 22:18:33', 'p1', 2, 0, 1, 1, 0.5, 99, 10, 10, 0, '1598233144diet.jpg'),
(2, '3 mois', 3, 2, 1, 3, 1, 1, '2020-06-25 22:22:13', 'p2', 2, 0, 3, 1, 0.5, 189, 10, 10, 10, '1598233041diet.jpg'),
(3, '6 mois', 7, 3, 1, 4, 3, 1, '2020-06-25 22:24:45', 'p3', 2, 0, 6, 1, 0.5, 319, 10, 10, 10, '1598232997diet.jpg'),
(4, 'Bilan Unique', 1, 0, 0, 1, 0, 0, '2020-06-25 22:25:54', 'p4', 2, 7, 0, 1, 0.5, 59, 10, 10, 10, '15983470591598233041diet.jpg'),
(5, 'Allons Faire les Courses', 2, 1, 0, 2, 1, 0, '2020-06-25 22:28:35', 'p5', 2, 7, 0, 1, 1, 70, 10, 10, 10, '15983470691598232997diet.jpg'),
(6, 'Allons faire les Courses et Cuisinons', 1, 1, 0, 1, 1, 0, '2020-06-25 22:29:47', 'p6', 2, 7, 0, 1, 0.5, 160, 10, 10, 10, '15983470501598233041diet.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `pack_extras`
--

CREATE TABLE `pack_extras` (
  `idextra` int(11) NOT NULL,
  `extra` varchar(255) NOT NULL,
  `pack_id` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=utf32;

--
-- Déchargement des données de la table `pack_extras`
--

INSERT INTO `pack_extras` (`idextra`, `extra`, `pack_id`, `created_at`) VALUES
(13, 'Allons Faire les Courses', '1', '2020-09-18 09:04:53'),
(14, 'Allons Faire les Courses et sport', '1', '2020-09-18 09:04:53');

-- --------------------------------------------------------

--
-- Structure de la table `paidpack`
--

CREATE TABLE `paidpack` (
  `id` int(5) NOT NULL,
  `pname` varchar(255) DEFAULT NULL,
  `id_user` int(5) DEFAULT NULL,
  `amount` float(10,2) DEFAULT NULL,
  `paid_at` timestamp NULL DEFAULT current_timestamp(),
  `typeCoach` varchar(255) DEFAULT NULL,
  `payMethod` varchar(171) DEFAULT NULL,
  `payment_id` varchar(255) DEFAULT NULL,
  `payer_id` varchar(255) DEFAULT NULL,
  `payer_email` varchar(512) DEFAULT NULL,
  `payment_status` varchar(255) DEFAULT NULL,
  `currency` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf32;

--
-- Déchargement des données de la table `paidpack`
--

INSERT INTO `paidpack` (`id`, `pname`, `id_user`, `amount`, `paid_at`, `typeCoach`, `payMethod`, `payment_id`, `payer_id`, `payer_email`, `payment_status`, `currency`) VALUES
(43, '4', 55, 59.00, '2020-08-26 14:58:24', NULL, '', '', '', '', '', ''),
(38, '2', 4, 189.00, '2020-08-22 10:35:33', NULL, 'paypal', 'PAYID-L5APJVY8KE7935320427054M', 'B9UVV8PP6DNDY', 'kora4yo@gmail.com', 'approved', 'USD'),
(39, '2', 51, 189.00, '2020-08-26 11:33:32', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(40, '2', 52, 189.00, '2020-08-26 11:39:37', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(41, '2', 53, 189.00, '2020-08-26 11:53:18', NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `paidrdv`
--

CREATE TABLE `paidrdv` (
  `idp` int(11) NOT NULL,
  `idres` int(11) NOT NULL,
  `iduser` int(11) NOT NULL,
  `amount` float NOT NULL,
  `paid_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `payMethod` varchar(128) NOT NULL,
  `payment_id` varchar(128) NOT NULL,
  `payer_id` varchar(128) NOT NULL,
  `payment_status` varchar(128) NOT NULL,
  `currency` varchar(128) NOT NULL,
  `payer_email` varchar(512) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf32;

--
-- Déchargement des données de la table `paidrdv`
--

INSERT INTO `paidrdv` (`idp`, `idres`, `iduser`, `amount`, `paid_at`, `payMethod`, `payment_id`, `payer_id`, `payment_status`, `currency`, `payer_email`) VALUES
(1, 24, 1, 45, '2020-06-28 04:57:01', 'paypal', 'PAYID-L34CF5Y24S54746945040333', 'B9UVV8PP6DNDY', 'approved', 'USD', 'kora4yo@gmail.com'),
(2, 81, 34, 10, '2020-08-22 08:21:29', 'paypal', 'PAYID-L5ANKWA7Y4908751X267445H', 'B9UVV8PP6DNDY', 'approved', 'USD', 'kora4yo@gmail.com');

-- --------------------------------------------------------

--
-- Structure de la table `questions`
--

CREATE TABLE `questions` (
  `idq` int(11) NOT NULL,
  `question` varchar(512) NOT NULL,
  `packid` int(11) NOT NULL,
  `datecreation` timestamp NOT NULL DEFAULT current_timestamp(),
  `id_Emetteur` int(11) NOT NULL,
  `idCategorie` int(11) NOT NULL,
  `typeq` varchar(128) NOT NULL DEFAULT 'radio'
) ENGINE=MyISAM DEFAULT CHARSET=utf32;

--
-- Déchargement des données de la table `questions`
--

INSERT INTO `questions` (`idq`, `question`, `packid`, `datecreation`, `id_Emetteur`, `idCategorie`, `typeq`) VALUES
(1, 'quelle est votre sport prefÃ©rÃ©?', 2, '2020-06-28 23:31:01', 2, 1, 'radio'),
(2, 'quelle votre plat prefÃ©rÃ©?', 2, '2020-06-29 13:40:25', 2, 2, 'radio'),
(4, 'Votre language de programmation prefÃ©rÃ©', 2, '2020-07-02 14:09:21', 2, 1, 'checkbox'),
(5, 'Votre fruit prefÃ©rÃ©', 2, '2020-07-02 14:10:29', 2, 1, 'radio'),
(6, 'question 1', 2, '2020-08-19 09:57:00', 2, 1, 'radio');

-- --------------------------------------------------------

--
-- Structure de la table `rendezvous`
--

CREATE TABLE `rendezvous` (
  `idr` int(5) NOT NULL,
  `idClient` int(5) DEFAULT NULL,
  `idEmetteur` int(5) DEFAULT NULL,
  `dateStart` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `dateEnd` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `completed` int(1) NOT NULL DEFAULT 0,
  `paid` int(1) NOT NULL DEFAULT 0,
  `titre` varchar(255) DEFAULT NULL,
  `methodPaiement` varchar(50) DEFAULT NULL,
  `prix` float DEFAULT NULL,
  `datePaiment` timestamp NULL DEFAULT NULL,
  `emailPaiment` varchar(500) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf32;

--
-- Déchargement des données de la table `rendezvous`
--

INSERT INTO `rendezvous` (`idr`, `idClient`, `idEmetteur`, `dateStart`, `dateEnd`, `completed`, `paid`, `titre`, `methodPaiement`, `prix`, `datePaiment`, `emailPaiment`) VALUES
(60, NULL, 2, '2020-09-30 13:00:00', '2020-09-30 17:00:00', 0, 0, 'note b', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `reponses`
--

CREATE TABLE `reponses` (
  `idreponse` int(11) NOT NULL,
  `idchoix` int(11) NOT NULL,
  `creation_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `client_id` int(11) NOT NULL,
  `id_res` int(11) NOT NULL,
  `idq` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf32;

--
-- Déchargement des données de la table `reponses`
--

INSERT INTO `reponses` (`idreponse`, `idchoix`, `creation_at`, `client_id`, `id_res`, `idq`) VALUES
(11, 1, '2020-07-04 08:38:05', 1, 20, 1),
(17, 13, '2020-07-10 12:56:59', 1, 20, 5),
(13, 10, '2020-07-04 08:38:11', 1, 20, 4),
(14, 11, '2020-07-04 08:38:11', 1, 20, 4);

-- --------------------------------------------------------

--
-- Structure de la table `reservations`
--

CREATE TABLE `reservations` (
  `idreservation` int(11) NOT NULL,
  `idconference` int(11) DEFAULT NULL,
  `dateReservation` timestamp NOT NULL DEFAULT current_timestamp(),
  `idc` int(5) DEFAULT NULL,
  `paid` int(11) NOT NULL DEFAULT 0,
  `startrdv` timestamp NULL DEFAULT '0000-00-00 00:00:00',
  `endrdv` timestamp NULL DEFAULT '0000-00-00 00:00:00',
  `typerdv` varchar(128) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf32;

--
-- Déchargement des données de la table `reservations`
--

INSERT INTO `reservations` (`idreservation`, `idconference`, `dateReservation`, `idc`, `paid`, `startrdv`, `endrdv`, `typerdv`) VALUES
(82, 54, '2020-08-22 10:35:55', 4, 1, '2020-08-27 08:00:00', '2020-08-27 09:00:00', 'visio');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `idCompte` int(11) NOT NULL,
  `pass` varchar(45) DEFAULT NULL,
  `nomprenom` varchar(255) DEFAULT NULL,
  `adresse` varchar(250) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `role` varchar(45) DEFAULT 'client',
  `tel` varchar(55) DEFAULT NULL,
  `prenom` varchar(255) DEFAULT NULL,
  `sexe` varchar(255) DEFAULT NULL,
  `poid` double DEFAULT NULL,
  `taille` double DEFAULT NULL,
  `naissance` date DEFAULT NULL,
  `objectifs` text DEFAULT NULL,
  `niveauCoach` int(3) DEFAULT NULL,
  `profil` varchar(512) DEFAULT NULL,
  `hisadmin` int(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`idCompte`, `pass`, `nomprenom`, `adresse`, `email`, `role`, `tel`, `prenom`, `sexe`, `poid`, `taille`, `naissance`, `objectifs`, `niveauCoach`, `profil`, `hisadmin`) VALUES
(1, 'e10adc3949ba59abbe56e057f20f883e', 'med', NULL, 'medrezzouq9@gmail.com', 'client', '546786786', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2, '83a8d8877f866c18eb88e558cf965cf3', 'soufiane', NULL, 's.boukhriss@gmail.com', 'admin', '456987564', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(4, 'e10adc3949ba59abbe56e057f20f883e', 'med', NULL, 'med.rezzouq@gmail.com', 'client', '7026987456', 'rezz', 'Homme', 175, 175, '1984-10-24', '/enceinte', 4, NULL, NULL),
(50, 'e10adc3949ba59abbe56e057f20f883e', 'najia', NULL, 'najia@najia.ma', 'user', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2),
(54, 'e10adc3949ba59abbe56e057f20f883e', 'mohammad', NULL, 'rezzouq7@gmail.com', 'client', '0687953654', 'rezz', 'Homme', 75, 175, '1984-10-24', '/prisepoid/sportifs/alergie', 3, '1598403880logo.png', NULL),
(55, 'e10adc3949ba59abbe56e057f20f883e', 'med', NULL, 'rezzouq77@gmail.com', 'client', '7500268652', 'rezz', 'Homme', 70, 177, '1984-10-24', '/prisepoid/sportifs/alergie', 3, '1598410191logo.png', NULL),
(56, 'e10adc3949ba59abbe56e057f20f883e', 'teste', NULL, 'aelfannir@gmail.com', 'user', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2);

-- --------------------------------------------------------

--
-- Structure de la table `user_acl`
--

CREATE TABLE `user_acl` (
  `id` int(7) NOT NULL,
  `iduser` int(5) NOT NULL,
  `idadmin` int(5) NOT NULL,
  `permission` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=utf32;

--
-- Déchargement des données de la table `user_acl`
--

INSERT INTO `user_acl` (`id`, `iduser`, `idadmin`, `permission`, `created_at`) VALUES
(51, 50, 2, 'disponibilites', '2020-08-24 15:34:56'),
(50, 50, 2, 'reservations', '2020-08-24 15:34:56'),
(49, 50, 2, 'questions', '2020-08-24 15:34:56'),
(48, 50, 2, 'abonnes', '2020-08-24 15:34:56'),
(52, 56, 2, 'abonnes', '2020-09-19 08:54:23'),
(53, 56, 2, 'disponibilites', '2020-09-19 08:54:23'),
(54, 56, 2, 'reservations', '2020-09-19 08:54:23');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id_cat`);

--
-- Index pour la table `choix`
--
ALTER TABLE `choix`
  ADD PRIMARY KEY (`idchoix`);

--
-- Index pour la table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`idCompte`);

--
-- Index pour la table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`idcontact`);

--
-- Index pour la table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`idm`);

--
-- Index pour la table `packs`
--
ALTER TABLE `packs`
  ADD PRIMARY KEY (`idpack`);

--
-- Index pour la table `pack_extras`
--
ALTER TABLE `pack_extras`
  ADD PRIMARY KEY (`idextra`);

--
-- Index pour la table `paidpack`
--
ALTER TABLE `paidpack`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `paidrdv`
--
ALTER TABLE `paidrdv`
  ADD PRIMARY KEY (`idp`);

--
-- Index pour la table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`idq`);

--
-- Index pour la table `rendezvous`
--
ALTER TABLE `rendezvous`
  ADD PRIMARY KEY (`idr`);

--
-- Index pour la table `reponses`
--
ALTER TABLE `reponses`
  ADD PRIMARY KEY (`idreponse`);

--
-- Index pour la table `reservations`
--
ALTER TABLE `reservations`
  ADD PRIMARY KEY (`idreservation`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`idCompte`);

--
-- Index pour la table `user_acl`
--
ALTER TABLE `user_acl`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `categories`
--
ALTER TABLE `categories`
  MODIFY `id_cat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `choix`
--
ALTER TABLE `choix`
  MODIFY `idchoix` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT pour la table `client`
--
ALTER TABLE `client`
  MODIFY `idCompte` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `contact`
--
ALTER TABLE `contact`
  MODIFY `idcontact` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT pour la table `messages`
--
ALTER TABLE `messages`
  MODIFY `idm` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT pour la table `packs`
--
ALTER TABLE `packs`
  MODIFY `idpack` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT pour la table `pack_extras`
--
ALTER TABLE `pack_extras`
  MODIFY `idextra` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT pour la table `paidpack`
--
ALTER TABLE `paidpack`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT pour la table `paidrdv`
--
ALTER TABLE `paidrdv`
  MODIFY `idp` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `questions`
--
ALTER TABLE `questions`
  MODIFY `idq` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `rendezvous`
--
ALTER TABLE `rendezvous`
  MODIFY `idr` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT pour la table `reponses`
--
ALTER TABLE `reponses`
  MODIFY `idreponse` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT pour la table `reservations`
--
ALTER TABLE `reservations`
  MODIFY `idreservation` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `idCompte` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT pour la table `user_acl`
--
ALTER TABLE `user_acl`
  MODIFY `id` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
