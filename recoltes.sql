-- phpMyAdmin SQL Dump
-- version 3.4.10.1deb1
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le : Jeu 29 Novembre 2012 à 17:38
-- Version du serveur: 5.5.28
-- Version de PHP: 5.3.10-1ubuntu3.4

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `lesjardinsdecocagnech1`
--

-- --------------------------------------------------------

--
-- Structure de la table `articles`
--

CREATE TABLE IF NOT EXISTS `articles` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL DEFAULT '',
  `text` mediumtext NOT NULL,
  `state` tinyint(3) NOT NULL DEFAULT '0',
  `created` datetime NOT NULL,
  `created_by` int(11) unsigned NOT NULL DEFAULT '0',
  `modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idx_state` (`state`),
  KEY `idx_createdby` (`created_by`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `caisses`
--

CREATE TABLE IF NOT EXISTS `caisses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `lib` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `poids` float(3,2) NOT NULL,
  `img` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `date_mod` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `rem` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `lib` (`lib`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Types de caisses' AUTO_INCREMENT=9 ;

--
-- Contenu de la table `caisses`
--

INSERT INTO `caisses` (`id`, `code`, `lib`, `poids`, `img`, `date_mod`, `rem`) VALUES
(1, 'G1', 'Grande verte', 2.50, '', '2011-05-29 14:19:06', ''),
(2, 'G2', 'Moyenne verte', 1.50, '', '2011-05-29 14:19:13', ''),
(3, 'G3', 'Petite verte', 1.50, '', '2011-05-29 14:19:59', ''),
(4, '', 'Harasse bois', 4.00, '', '2011-05-29 14:19:59', ''),
(5, '', 'Harasse noire', 2.20, '', '2011-05-29 14:20:54', ''),
(6, '', 'Grande grise', 2.20, '', '2011-05-29 14:20:54', ''),
(7, '', 'Plateau plantons', 1.65, '', '2011-05-29 14:21:21', ''),
(8, '', 'Petite grise', 1.70, '', '2011-05-29 14:21:21', '');

-- --------------------------------------------------------

--
-- Structure de la table `classifications`
--

CREATE TABLE IF NOT EXISTS `classifications` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lib` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `rank` int(3) NOT NULL,
  `date_mod` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `rem` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `lib` (`lib`),
  UNIQUE KEY `lib_2` (`lib`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='légumes' AUTO_INCREMENT=14 ;

--
-- Contenu de la table `classifications`
--

INSERT INTO `classifications` (`id`, `lib`, `rank`, `date_mod`, `rem`) VALUES
(1, 'Autres', 0, '2030-12-31 23:00:00', 'tous les inclassables'),
(2, 'Bulbes', 0, '0000-00-00 00:00:00', ''),
(3, 'Fines herbes', 0, '0000-00-00 00:00:00', ''),
(4, 'Légumes-feuilles', 2, '2011-05-29 15:50:57', ''),
(5, 'Légumes-fleurs', 0, '0000-00-00 00:00:00', ''),
(6, 'Légumes-racines', 3, '2011-05-29 15:51:25', ''),
(7, 'Légumes-sauvages', 0, '0000-00-00 00:00:00', ''),
(8, 'Légumes-tiges', 0, '0000-00-00 00:00:00', ''),
(9, 'Salades', 1, '2011-05-29 15:50:53', ''),
(10, 'Tubercules', 0, '0000-00-00 00:00:00', ''),
(11, 'Légumes-légumineuses', 4, '2011-05-29 15:51:29', ''),
(12, 'Fruits', 5, '2011-05-29 15:51:33', ''),
(13, 'Epices', 6, '2011-05-29 15:52:28', '');

-- --------------------------------------------------------

--
-- Structure de la table `legumes`
--

CREATE TABLE IF NOT EXISTS `legumes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lib` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `unite_id` int(12) NOT NULL,
  `classification_id` int(12) NOT NULL,
  `img` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `date_mod` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `rem` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `lib` (`lib`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='légumes' AUTO_INCREMENT=97 ;

--
-- Contenu de la table `legumes`
--

INSERT INTO `legumes` (`id`, `lib`, `unite_id`, `classification_id`, `img`, `date_mod`, `rem`) VALUES
(1, 'Ail d''ours', 1, 3, '', '0000-00-00 00:00:00', ''),
(2, 'Basilic', 2, 3, '', '0000-00-00 00:00:00', ''),
(3, 'Betteraves', 1, 6, '', '0000-00-00 00:00:00', ''),
(4, 'Bruxelles', 1, 4, '', '0000-00-00 00:00:00', ''),
(5, 'Cabus,batavia,feuille chêne', 2, 9, '', '0000-00-00 00:00:00', ''),
(6, 'Carottes', 1, 6, '', '0000-00-00 00:00:00', ''),
(7, 'Carottes botte', 1, 6, '', '0000-00-00 00:00:00', ''),
(8, 'Céleri', 1, 6, '', '0000-00-00 00:00:00', ''),
(96, 'Chicorée pain de sucre', 1, 1, '', '2011-12-06 15:47:00', ''),
(10, 'Chicorée frisée serrée', 1, 9, '', '0000-00-00 00:00:00', ''),
(11, 'Chicorée rouge trévise', 1, 9, '', '0000-00-00 00:00:00', ''),
(12, 'Chou chinois', 1, 4, '', '0000-00-00 00:00:00', ''),
(13, 'Chou fleur', 1, 5, '', '0000-00-00 00:00:00', ''),
(14, 'Chou Mizuna', 1, 4, '', '0000-00-00 00:00:00', ''),
(15, 'Choux pommé', 1, 4, '', '0000-00-00 00:00:00', ''),
(16, 'Choux rouge', 1, 4, '', '0000-00-00 00:00:00', ''),
(17, 'Cima di rapa', 1, 4, '', '0000-00-00 00:00:00', ''),
(18, 'Colrave', 2, 6, '', '0000-00-00 00:00:00', ''),
(19, 'Coriandre', 2, 3, '', '0000-00-00 00:00:00', ''),
(20, 'Côte à tondre', 1, 4, '', '0000-00-00 00:00:00', ''),
(21, 'Côte de bette', 1, 4, '', '0000-00-00 00:00:00', ''),
(22, 'Dent de lion', 1, 9, '', '0000-00-00 00:00:00', ''),
(23, 'Epices bouquet', 2, 3, '', '0000-00-00 00:00:00', ''),
(24, 'Épinard', 1, 4, '', '0000-00-00 00:00:00', ''),
(25, 'Fenouil', 1, 4, '', '0000-00-00 00:00:00', ''),
(26, 'Graines germées', 1, 1, '', '0000-00-00 00:00:00', ''),
(27, 'Laitue romaine', 1, 9, '', '0000-00-00 00:00:00', ''),
(28, 'Laurier', 2, 3, '', '0000-00-00 00:00:00', ''),
(29, 'Mizuna', 1, 4, '', '0000-00-00 00:00:00', ''),
(30, 'Navet', 1, 6, '', '0000-00-00 00:00:00', ''),
(31, 'Navet botte', 2, 6, '', '0000-00-00 00:00:00', ''),
(32, 'Oignons botte', 2, 2, '', '0000-00-00 00:00:00', ''),
(33, 'Orties', 1, 7, '', '0000-00-00 00:00:00', ''),
(34, 'Pak choi', 1, 4, '', '0000-00-00 00:00:00', ''),
(36, 'Persil  bouquet', 2, 3, '', '0000-00-00 00:00:00', ''),
(37, 'Poireaux', 1, 4, '', '0000-00-00 00:00:00', ''),
(38, 'Pourpier', 1, 9, '', '0000-00-00 00:00:00', ''),
(39, 'Radis noir', 2, 6, '', '0000-00-00 00:00:00', ''),
(40, 'Radis rouge botte', 2, 6, '', '0000-00-00 00:00:00', ''),
(41, 'Rampon / mâche', 1, 9, '', '0000-00-00 00:00:00', ''),
(42, 'Rave', 1, 6, '', '0000-00-00 00:00:00', ''),
(43, 'Roquette', 1, 9, '', '0000-00-00 00:00:00', ''),
(44, 'Roquette / pourpier', 1, 9, '', '0000-00-00 00:00:00', ''),
(45, 'Roquette / pourpier / cresson', 1, 9, '', '0000-00-00 00:00:00', ''),
(46, 'Saladine/roquette', 1, 9, '', '0000-00-00 00:00:00', ''),
(47, 'Sauge', 2, 3, '', '0000-00-00 00:00:00', ''),
(48, 'Ta-Tsoï', 1, 4, '', '0000-00-00 00:00:00', ''),
(49, 'Thym', 2, 3, '', '0000-00-00 00:00:00', ''),
(50, 'Topinambour', 1, 10, '', '0000-00-00 00:00:00', ''),
(51, 'Vérone, Gromulo', 1, 9, '', '0000-00-00 00:00:00', ''),
(52, 'Chou blanc', 1, 4, '', '2011-06-05 05:37:00', ''),
(53, 'Saladine', 1, 9, '', '2011-06-06 04:47:00', ''),
(55, 'Petit pois', 1, 11, '', '2011-08-22 14:32:00', ''),
(56, 'Chou Pack Choï', 1, 1, '', '2011-08-22 14:39:00', ''),
(57, 'Menthe', 1, 3, '', '2011-08-22 14:48:00', ''),
(58, 'Petite épeautre', 1, 1, '', '2011-10-05 10:48:00', 'produits contractuel Reto'),
(59, 'Tournesol', 1, 1, '', '2011-10-05 10:49:00', 'Produit  contractuel Reto'),
(60, 'Lentilles', 1, 1, '', '2011-10-06 09:09:00', ''),
(64, 'Fèves', 1, 1, '', '2011-10-06 10:28:00', ''),
(62, 'Boulghour d''épeautre', 1, 1, '', '2011-10-06 09:10:00', 'Produit contractuel Reto'),
(63, 'Polenta', 1, 1, '', '2011-10-06 09:11:00', 'Polenta contractuel Reto'),
(65, 'Sariette bouquet', 2, 1, '', '2011-10-06 10:28:00', ''),
(66, 'Cassis', 1, 1, '', '2011-10-06 11:08:00', ''),
(67, 'Raisinets', 1, 1, '', '2011-10-06 11:08:00', ''),
(68, 'Courgettes', 1, 1, '', '2011-10-06 11:21:00', ''),
(71, 'Pomme de terre', 1, 1, '', '2011-10-07 07:38:00', ''),
(72, 'Pommes de terre nouv,', 1, 1, '', '2011-10-07 07:38:00', ''),
(75, 'Aubergines', 1, 1, '', '2011-10-07 07:46:00', ''),
(74, 'Concombre nostrani', 1, 1, '', '2011-10-07 07:43:00', ''),
(76, 'Poivrons', 1, 1, '', '2011-10-07 07:46:00', ''),
(77, 'Haricots rames', 1, 1, '', '2011-10-07 10:46:00', ''),
(78, 'Hariots nains', 1, 1, '', '2011-10-07 10:46:00', ''),
(79, 'Tomates "normales"', 1, 1, '', '2011-10-07 10:59:00', ''),
(80, 'Tomates "spéciales"', 1, 1, '', '2011-10-07 10:59:00', ''),
(81, 'Tomates "mélanges"', 1, 1, '', '2011-10-07 11:00:00', ''),
(82, 'Ciboulette bouquet', 2, 1, '', '2011-10-07 11:16:00', ''),
(83, 'Piments', 1, 1, '', '2011-10-07 13:45:00', ''),
(84, 'Oignons', 1, 1, '', '2011-10-07 14:47:00', ''),
(85, 'Pommes', 1, 1, '', '2011-10-07 15:06:00', ''),
(86, 'Persil racine', 1, 1, '', '2011-12-05 13:19:00', ''),
(87, 'Panais', 1, 1, '', '2011-12-05 13:20:00', ''),
(88, 'Raisin', 1, 1, '', '2011-12-05 16:10:00', ''),
(89, 'Mais', 2, 1, '', '2011-12-05 16:10:00', ''),
(90, 'Chicorée pallarossa', 1, 1, '', '2011-12-06 09:58:00', ''),
(91, 'Courge spaghetti', 1, 1, '', '2011-12-06 10:46:00', ''),
(92, 'Courge spéciale', 1, 1, '', '2011-12-06 10:46:00', ''),
(93, 'Chicorée catalogne', 1, 1, '', '2011-12-06 11:18:00', ''),
(94, 'Radis Daikon', 2, 1, '', '2011-12-06 11:19:00', ''),
(95, 'Courge', 1, 1, '', '2011-12-06 13:24:00', '');

-- --------------------------------------------------------

--
-- Structure de la table `recoltes`
--

CREATE TABLE IF NOT EXISTS `recoltes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `lib` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `nb_GP` int(3) NOT NULL,
  `nb_PP` int(3) NOT NULL,
  `date_mod` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `rem` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `lib` (`lib`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Feuille de récolte' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `recolteslegumes`
--

CREATE TABLE IF NOT EXISTS `recolteslegumes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `recolte_id` int(12) NOT NULL,
  `terrain_id` int(12) NOT NULL,
  `legume_id` int(12) NOT NULL,
  `unite_id` int(12) NOT NULL,
  `nb_caisse` int(6) NOT NULL DEFAULT '0',
  `par_caisse_kg_pce` int(6) NOT NULL,
  `par_caisse_reste` float NOT NULL,
  `kg_pce_total_par_lieu` int(6) NOT NULL,
  `recolte_kg_piece_total` int(6) NOT NULL,
  `nb_caisses_GP` int(6) NOT NULL,
  `nb_caisses_PP` int(6) NOT NULL,
  `cornets_par_caisse_GP` int(6) NOT NULL,
  `cornets_par_caisse_PP` int(6) NOT NULL,
  `kg_pce_par_cornet_GP` int(6) NOT NULL,
  `kg_pce_par_cornet_PP` int(6) NOT NULL,
  `prixminPER` float NOT NULL,
  `prixmaxPER` float NOT NULL,
  `prixminBIO` float NOT NULL,
  `prixmaxBIO` float NOT NULL,
  `remarques` text COLLATE utf8_unicode_ci NOT NULL,
  `date_mod` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Feuille de récolte' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `terrains`
--

CREATE TABLE IF NOT EXISTS `terrains` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lib` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `date_mod` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `rem` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Les terrains des Jardins de Cocagne' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `unites`
--

CREATE TABLE IF NOT EXISTS `unites` (
  `id` int(12) NOT NULL AUTO_INCREMENT,
  `lib` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `rem` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `lib` (`lib`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='unités pour les légumes' AUTO_INCREMENT=6 ;

--
-- Contenu de la table `unites`
--

INSERT INTO `unites` (`id`, `lib`, `rem`) VALUES
(1, 'kg', ''),
(2, 'pièce', '');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
