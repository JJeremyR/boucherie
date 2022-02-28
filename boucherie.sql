-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : lun. 28 fév. 2022 à 07:54
-- Version du serveur : 5.7.36
-- Version de PHP : 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `boucherie`
--
CREATE DATABASE IF NOT EXISTS `boucherie` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `boucherie`;

-- --------------------------------------------------------

--
-- Structure de la table `adress`
--

DROP TABLE IF EXISTS `adress`;
CREATE TABLE IF NOT EXISTS `adress` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `firstname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `company` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `adress` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `postal` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cell` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_5CECC7BEA76ED395` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `carrier`
--

DROP TABLE IF EXISTS `carrier`;
CREATE TABLE IF NOT EXISTS `carrier` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` double NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `carrier`
--

INSERT INTO `carrier` (`id`, `name`, `description`, `price`) VALUES
(1, 'Colissimo', 'livraison a domicile en 72 heures.', 990);

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(1, 'Mises En Bouches'),
(2, 'Entrées'),
(3, 'Plats Cuisinés'),
(4, 'Galantines'),
(5, 'Accompagnements'),
(6, 'Volailles'),
(7, 'Farces');

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
('DoctrineMigrations\\Version20220203140920', '2022-02-03 14:10:52', 137),
('DoctrineMigrations\\Version20220203154728', '2022-02-03 15:47:56', 48),
('DoctrineMigrations\\Version20220207075826', '2022-02-07 07:58:48', 97),
('DoctrineMigrations\\Version20220207081345', '2022-02-07 08:14:02', 138),
('DoctrineMigrations\\Version20220212155809', '2022-02-12 15:58:35', 207),
('DoctrineMigrations\\Version20220212173334', '2022-02-12 17:33:54', 80),
('DoctrineMigrations\\Version20220213163131', '2022-02-13 16:31:55', 60),
('DoctrineMigrations\\Version20220213165002', '2022-02-13 16:50:19', 158),
('DoctrineMigrations\\Version20220215084432', '2022-02-15 08:44:48', 104),
('DoctrineMigrations\\Version20220216152620', '2022-02-16 15:26:47', 121),
('DoctrineMigrations\\Version20220216171010', '2022-02-16 17:10:53', 80),
('DoctrineMigrations\\Version20220220161722', '2022-02-20 16:21:07', 207),
('DoctrineMigrations\\Version20220220162002', '2022-02-20 16:23:42', 122),
('DoctrineMigrations\\Version20220220162158', '2022-02-20 18:30:32', 104),
('DoctrineMigrations\\Version20220220182859', '2022-02-20 18:30:32', 90),
('DoctrineMigrations\\Version20220220193246', '2022-02-20 19:33:01', 37),
('DoctrineMigrations\\Version20220221111516', '2022-02-21 11:15:55', 62);

-- --------------------------------------------------------

--
-- Structure de la table `header`
--

DROP TABLE IF EXISTS `header`;
CREATE TABLE IF NOT EXISTS `header` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `btn_title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `btn_url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `illustration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `header`
--

INSERT INTO `header` (`id`, `title`, `content`, `btn_title`, `btn_url`, `illustration`) VALUES
(1, 'Header Test 1', 'Ceci Est Un Test De La Fonctionnalité De Gestion Des Headers Par Le Dashboard Admin!', 'Test Bouton 1', '/inscription', '720db05e6f3ca57640e90033514fb4170a6234b8.jpg'),
(2, 'Header Test 2', 'Ceci Est Un Test De La Fonctionnalité De Gestion Des Headers Par Le Dashboard Admin!', 'Test Bouton 2', '/nos-produits', '978ed9cd98051a95d066844226dad10552d4ec98.jpg'),
(3, 'Header Test 3', 'Ceci Est Un Test De La Fonctionnalité De Gestion Des Headers Par Le Dashboard Admin!', 'Test Bouton 3', '/', '8ed98cfc03def8ba46d9e8949b5f9d21ede39dc2.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `order`
--

DROP TABLE IF EXISTS `order`;
CREATE TABLE IF NOT EXISTS `order` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `carrier_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `carrier_price` double NOT NULL,
  `delivery` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `reference` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stripe_session_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `state` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_F5299398A76ED395` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `order_details`
--

DROP TABLE IF EXISTS `order_details`;
CREATE TABLE IF NOT EXISTS `order_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `my_order_id` int(11) NOT NULL,
  `product` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` double NOT NULL,
  `total` double NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_845CA2C1BFCDF877` (`my_order_id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `product`
--

DROP TABLE IF EXISTS `product`;
CREATE TABLE IF NOT EXISTS `product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `categorie_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `illustration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subtitle` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` double NOT NULL,
  `is_best` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_D34A04ADBCF5E72D` (`categorie_id`)
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `product`
--

INSERT INTO `product` (`id`, `categorie_id`, `name`, `slug`, `illustration`, `subtitle`, `description`, `price`, `is_best`) VALUES
(1, 2, 'Boudin Blanc', 'boudin-blanc', '150dadbfe2f2403f9d1155b421b899568d61c2f5.jpg', 'tiens voila du boudin, voila du boudin', 'prix au kg', 1490, 0),
(2, 2, 'Vol Au Vent', 'vol-au-vent', 'ac254c3d4a4d3e3491fb53fa5ea982ba1406f8dc.jpg', 'vol au vent non fourré', 'Vol Au Vent Sans Fourrage\r\nprix à la pièce', 250, 0),
(3, 2, 'Escargots', 'escargots', 'ee5c29a68333d853e99a08dfe5ee50b1d106a190.jpg', 'escargots', 'prix a la douzaine', 695, 0),
(4, 2, 'Boudin Blanc Truffés', 'boudin-blanc-truffes', 'a841ff223233180321436470d41cc626dd1a1b21.png', 'boudins blancs truffés', 'prix au kg', 2190, 0),
(5, 2, 'Saumon Fumé', 'saumon-fume', '15e28046872047b4106b0486a92978d067638e29.jpg', 'saumon fumé', 'prix au 100 g', 790, 0),
(6, 7, 'Farce Nature', 'farce-nature', '045c04c16b72ccae934774f844e6707e8d2e924f.jpg', 'farce nature', 'Prix au kg', 950, 0),
(7, 7, 'Farce Forestière', 'farce-forestiere', '1b98271eeb06634049569e310d1b36a1351908b9.jpg', 'farce forestière', 'Prix au kg', 1290, 0),
(8, 7, 'Farce Figues Abricots', 'farce-figues-abricots', '970eb9e912e89d7afa3dc0b09fd46fc023023f8d.jpg', 'Farce Aux Figues et Abricots', 'Prix au kg', 1390, 0),
(9, 4, 'Galantine Chevreuil', 'galantine-chevreuil', 'c63d912925c419592c5854b9ffe1fa8e5c930f96.jpg', 'galantine chevreuil', 'prix au kg', 2950, 0),
(10, 4, 'Galantine Faisan', 'galantine-faisan', '9f0fc53ede3a7315afe68793dfb6117d60292086.jpg', 'galantine faisan', 'prix au kg', 2950, 0),
(11, 4, 'Galantine Poularde', 'galantine-poularde', '3a38b59a8d2d9fc8ef97b4b5bc4e8380b63c0dae.jpg', 'galantine poularde', 'prix au kg', 2950, 0),
(12, 4, 'Galantine Canard', 'galantine-canard', '1cb4fb53617293c9ad3bc5c5f809688d9fea0854.jpg', 'galantine canard', 'prix au kg', 2950, 0),
(13, 6, 'Poulet', 'poulet', 'f70c41182f82d95c19356518bd07301f0a9405c4.jpg', 'poulet', 'prix au kg', 920, 0),
(14, 6, 'chapon', 'chapon', '3042771507463d4260ec40fa65296b44e751e3c2.jpg', 'chapon', 'prix au kg', 1595, 0),
(15, 6, 'Pintade', 'pintade', '773fa10edad62b2f44e38b389263d649a15d6419.jpg', 'pintade', 'prix au kg', 1190, 0),
(16, 6, 'Magret de Canard', 'magret-de-canard', 'd0a2ae560f391ea357943fbdc6de37ed24ddc271.jpg', 'magret de canard', 'prix au kg', 1990, 0),
(17, 6, 'Dinde Blanche', 'dinde-blanche', '95c5eae509f1226cee9b41b5195d983c0cf37ef1.jpg', 'dinde blanche', 'prix au kg', 1049, 0),
(18, 6, 'Dinde Labelisée', 'dinde-labelisee', 'a0ea79b003fb5d71f595644afd2e7915cb05bc2a.jpg', 'Dinde labelisée', 'prix au kg', 1550, 0),
(19, 6, 'Roti de chapon farci figues foie gras', 'roti-de-chapon-farci-figues-foie-gras', 'c151c398b29ef09aca6e24c0b39a5a0650c06b38.jpg', 'roti de chapon farci figues foie gras', 'prix a la pièce', 1590, 0),
(20, 6, 'Roti de chapon farci morilles et armagnac', 'roti-de-chapon-farci-morilles-et-armagnac', 'c93b668d55838706b761429aed0442ff4ceece82.jpg', 'roti de chapon farci morilles et armagnac', 'prix a la pièce', 1590, 0),
(21, 1, 'Terrine de canard girolles', 'terrine-de-canard-girolles', '38b5081af23a8cb2216333445996072c3ab5c9c0.jpg', 'terrine de canard girolles', 'prix au kg', 2295, 0),
(22, 2, 'Foie Gras', 'foie-gras', 'a6496e6cbb8f8a4dbbc33353f15f99bb4baafd32.jpg', 'foie gras', 'prix au 100 g', 1050, 0),
(23, 3, 'Jambon sauce champagne', 'jambon-sauce-champagne', '08d18a2cdc16a408775b0ebd770062dbdc2f52da.jpg', 'jambon sauce champagne', 'prix a la part', 720, 0),
(24, 3, 'Medaillon de volaille farci sauce forestiere', 'medaillon-de-volaille-farci-sauce-forestiere', '32af329c7ec307dfd95679fa79d19463d6e84488.jpg', 'medaillon de volailles farci sauce forestiere', 'prix a la part', 650, 0),
(25, 3, 'filet mignon orloff sauce moutarde', 'filet-mignon-orloff-sauce-moutarde', 'e12b8390d6f7ecbc391fda62905f01e14781a17e.jpg', 'filet mignon orloff sauce moutarde', 'prix a la part', 695, 0),
(26, 3, 'supreme pintade farcie sauce morille', 'supreme-pintade-farcie-sauce-morille', 'e8be7409c44d56ba983eaf4dc31fff85ff5fd887.jpg', 'supreme pintade farcie sauce morille', 'prix a la part', 790, 0),
(27, 3, 'magret farci sauce foie gras', 'magret-farci-sauce-foie-gras', '7ec825724ad25acaf994a5a2c21b6de2dfee83ff.jpg', 'magret farci sauce foie gras', 'prix a la part', 920, 0),
(28, 5, 'Moelleux Carotte', 'moelleux-carotte', 'e7d9ed96215c77b5c4410a6f62ff9c48ad09ce5b.jpg', 'Moelleux Carotte', 'prix a la pièce', 190, 0),
(29, 5, 'moelleux choux fleur', 'moelleux-choux-fleur', '1fb31bba7e6c27715c3c6789eeb81135d2782b27.jpg', 'moelleux choux fleur', 'prix a la pièce', 190, 0),
(30, 5, 'fagot haricot vert lardé', 'fagot-haricot-vert-larde', '03294265229d62b507df97b5785fe35491d068e5.jpg', 'fagot haricot vert lardé', 'prix a la pièce', 180, 0),
(31, 5, 'endive braisé lardé', 'endive-braise-larde', '20bb2fbc93983f2ac69119c9a97b0312f5a3a4db.jpg', 'endive braisé lardé', 'prix a la pièce', 190, 0),
(32, 5, 'Poire au vin', 'poire-au-vin', '7abff3ea798acd010b1ab7ff8d52fc787b7d7036.jpg', 'poire au vin', 'prix a la pièce', 190, 0),
(33, 5, 'pomme de terre duchesse', 'pomme-de-terre-duchesse', '423452b3cba550c2d55992605ed6a80b9c845484.jpg', 'pomme de terre duchesse', 'prix a la pièce', 200, 0),
(34, 5, 'gratin dauphinois', 'gratin-dauphinois', '9f353bad7ad681fef6c16a8a0c1fd8a5806b2bbc.jpg', 'gratin dauphinois', 'prix a la pièce', 200, 0),
(35, 5, 'pomme de terre surprise cœur foie gras', 'pomme-de-terre-surprise-coeur-foie-gras', '16c049fca02af71070f7713b12e01bdb1a1ecb51.jpg', 'pomme de terre surprise cœur foie gras', 'prix a la pièce', 200, 0),
(36, 1, 'Rillette d\'oie', 'rillette-doie', '840b4015a88cdd172e304c9c3a3f2fe2fe59a697.jpg', 'rillette d\'oie', 'prix au kg', 2200, 0),
(37, 1, 'Pâté en croute', 'pate-en-croute', '0aa216335240c3a30f46bc40e0e9c3cd11490504.jpg', 'paté en croute', 'prix au kg', 2250, 0),
(38, 1, 'Gambas a l\'ail', 'gambas-a-lail', 'e0fd2bf0f69ed609867acda160f11f0e1f77f022.jpg', 'gambas a l\'ail', 'prix au 100 g', 395, 1),
(39, 1, 'Gambas Méditerranéenne', 'gambas-mediterraneenne', 'cfc5f37b5749432b35ae646c2cf6d1ded189dfed.jpg', 'gambas méditerrannéenne', 'prix au 100 g', 395, 1),
(40, 1, 'mini feuilletés', 'mini-feuillettes', '309246b834b79e6da803f6c01ecad12c82d1fb81.jpg', 'mini feuilletés', 'prix a la dizaine', 895, 0),
(41, 1, 'mini feuilletés d\'escargot', 'mini-feuilletes-descargot', 'ef90db8091d355a678028acf4a876ea13da1f71e.jpg', 'mini feuilletés d\'escargot', 'prix a la dizaine', 640, 0),
(42, 1, 'mini boudins blanc', 'mini-boudins-blanc', '892b2f4898bbd1be038b70362fa8281c1338765d.jpg', 'mini boudins blanc', 'prix au kg', 1590, 0),
(43, 1, 'mini boudins blanc truffés', 'mini-boudins-blanc-truffes', 'edf5a7f908f1ed5e422ca8eb4759fceaa76d9846.jpg', 'mini boudins blanc truffés', 'prix au kg', 2290, 0),
(44, 2, 'Bouchée ris de veau', 'bouchee-ris-de-veau', '23c7ca8f963a120cb18996e254f20e78b66dc48c.jpg', 'bouchée ris de veau', 'prix a la pièce', 550, 0),
(45, 2, 'crêpe', 'crepe', '9995466da2b37ff4f0c8a22c41e8ded851c53819.jpg', 'crêpe', 'prix a la pièce', 250, 0),
(46, 2, 'crêpe fruits de mer', 'crepe-fruits-de-mer', '88eed71c50dfd9fe813ceaa24eab536ce1f21e89.jpg', 'crêpe fruits de mer', 'prix a la pièce', 350, 0),
(47, 2, 'coquille saint-jacques', 'coquille-saint-jacques', '55055446c185b2487cc784facfbf5753eb87764a.jpg', 'coquille saint-jacques', 'prix a la pièce', 495, 1),
(48, 2, 'Gratin Crabe', 'gratin-crabe', 'c40006b9f1765b94fbc98ddbc4836ab89823451f.jpg', 'gratin crabe', 'prix a la pièce', 350, 0),
(49, 2, 'saumon bellevue', 'saumon-bellevue', '8508af3d66bd6a95dc32e9bd6320840aa699b74c.jpg', 'saumon bellevue', 'prix au 100 g', 360, 0),
(50, 2, 'saumon sauce homardine', 'saumon-sauce-homardine', 'ed67b0c50f1e7f487868114f6eb4c91a5ac0a7c4.jpg', 'saumon sauce homardine', 'prix au 100 g', 595, 0),
(51, 6, 'Poulet Ultra Braisé', 'poulet-ultra-braise', '1ebe77c8cab8515d902dbffd24001130e091e942.jpg', 'poulet ultra braisé ++', 'prix au kg ( cendres comprises ! )', 790, 1);

-- --------------------------------------------------------

--
-- Structure de la table `reset_password`
--

DROP TABLE IF EXISTS `reset_password`;
CREATE TABLE IF NOT EXISTS `reset_password` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_B9983CE5A76ED395` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` json NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `firstname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_8D93D649E7927C74` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `adress`
--
ALTER TABLE `adress`
  ADD CONSTRAINT `FK_5CECC7BEA76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `order`
--
ALTER TABLE `order`
  ADD CONSTRAINT `FK_F5299398A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `FK_845CA2C1BFCDF877` FOREIGN KEY (`my_order_id`) REFERENCES `order` (`id`);

--
-- Contraintes pour la table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `FK_D34A04ADBCF5E72D` FOREIGN KEY (`categorie_id`) REFERENCES `categories` (`id`);

--
-- Contraintes pour la table `reset_password`
--
ALTER TABLE `reset_password`
  ADD CONSTRAINT `FK_B9983CE5A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
