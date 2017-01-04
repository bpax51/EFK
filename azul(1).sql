-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Client :  127.0.0.1
-- Généré le :  Lun 26 Décembre 2016 à 17:46
-- Version du serveur :  5.7.14
-- Version de PHP :  5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `azul`
--

-- --------------------------------------------------------

--
-- Structure de la table `category_details`
--

CREATE TABLE `category_details` (
  `id` int(10) UNSIGNED NOT NULL,
  `category_name` varchar(120) DEFAULT NULL,
  `category_description` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `category_details`
--

INSERT INTO `category_details` (`id`, `category_name`, `category_description`) VALUES
(1, 'Fruits de mer', ''),
(2, 'cephalopode', '');

-- --------------------------------------------------------

--
-- Structure de la table `customer_details`
--

CREATE TABLE `customer_details` (
  `id` int(10) UNSIGNED NOT NULL,
  `customer_name` varchar(200) DEFAULT NULL,
  `customer_address` varchar(500) DEFAULT NULL,
  `customer_contact1` varchar(100) DEFAULT NULL,
  `customer_contact2` varchar(100) DEFAULT NULL,
  `balance` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `customer_details`
--

INSERT INTO `customer_details` (`id`, `customer_name`, `customer_address`, `customer_contact1`, `customer_contact2`, `balance`) VALUES
(1, 'Mohammed', '', '0643833697', '', 0),
(2, 'Mostafa', '', '0643833697', '', 0),
(3, 'Vente Magasin', 'Sidi Ghanem', '0000000000', '', 0),
(4, 'Transfert de Dépot', '', '0000000000', '', 0);

-- --------------------------------------------------------

--
-- Structure de la table `entries`
--

CREATE TABLE `entries` (
  `id` int(11) NOT NULL,
  `id_entrie` varchar(100) DEFAULT NULL,
  `supplier_name` varchar(50) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `description` text,
  `username` varchar(50) DEFAULT NULL,
  `date_added` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `entries`
--

INSERT INTO `entries` (`id`, `id_entrie`, `supplier_name`, `date`, `description`, `username`, `date_added`) VALUES
(1, 'PR1', 'Flan', '2016-12-24', 'entre de la part de FLAN le 24/12/2016', 'admin', '2016-12-24 14:52:45'),
(2, 'PR2', 'Ayoub', '2016-12-24', 'entree de la part de ayoub', 'admin', '2016-12-24 14:53:29');

-- --------------------------------------------------------

--
-- Structure de la table `returns_descriptions`
--

CREATE TABLE `returns_descriptions` (
  `id` int(11) NOT NULL,
  `id_return` varchar(100) DEFAULT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `sales`
--

CREATE TABLE `sales` (
  `id` int(11) NOT NULL,
  `id_sortie` varchar(100) DEFAULT NULL,
  `commercial` varchar(50) DEFAULT NULL,
  `description` text,
  `date` date DEFAULT NULL,
  `date_retour` date DEFAULT NULL,
  `date_added` datetime DEFAULT NULL,
  `username` varchar(30) DEFAULT NULL,
  `AUTO` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `sales`
--

INSERT INTO `sales` (`id`, `id_sortie`, `commercial`, `description`, `date`, `date_retour`, `date_added`, `username`, `AUTO`) VALUES
(2, 'SL1', 'Mohammed', 'Retour de sl1', '2016-12-24', '2016-12-24', '2016-12-24 15:02:33', 'admin', 0),
(3, 'SL2', 'Mohammed', 'retour sortie 2', '2016-12-24', '2016-12-24', '2016-12-24 15:32:29', 'admin', 0),
(4, 'SL3', 'Mostafa', 'Retour sl3', '2016-12-24', '2016-12-24', '2016-12-24 17:26:23', 'admin', 0),
(5, 'SL4', 'Vente Magasin', NULL, '2016-12-24', '2016-12-24', '2016-12-24 19:54:23', 'admin', 1),
(6, 'SL5', 'Transfert de Dépot', NULL, '2016-12-24', '2016-12-24', '2016-12-24 19:55:09', 'admin', 1),
(7, 'SL6', 'Transfert de Dépot', NULL, '2016-12-24', '2016-12-24', '2016-12-24 20:09:38', 'admin', 1),
(8, 'SL7', 'Mostafa', 'com retour sl7', '2016-12-24', '2016-12-24', '2016-12-24 20:18:23', 'admin', 0);

-- --------------------------------------------------------

--
-- Structure de la table `sales_details`
--

CREATE TABLE `sales_details` (
  `id` int(11) NOT NULL,
  `id_sortie` varchar(30) DEFAULT NULL,
  `stock_name` varchar(120) DEFAULT NULL,
  `numLot` varchar(30) DEFAULT NULL,
  `quantity` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `sales_details`
--

INSERT INTO `sales_details` (`id`, `id_sortie`, `stock_name`, `numLot`, `quantity`) VALUES
(1, 'SL1', 'calamar', '0002', '300.00'),
(2, 'SL2', 'pota', '0001', '300.00'),
(3, 'SL2', 'poulpe', '0003', '500.00'),
(4, 'SL3', 'calamar', '0002', '200.00'),
(5, 'SL3', 'poulpe', '0003', '500.00'),
(6, 'SL4', 'pota', '0001', '700.00'),
(7, 'SL5', 'calamar', '0002', '500.00'),
(8, 'SL6', 'pota', '0001', '1000.00'),
(9, 'SL7', 'poulpe', '0003', '500.00'),
(12, 'SL9', 'pota', '0001', '900.00');

-- --------------------------------------------------------

--
-- Structure de la table `sorties`
--

CREATE TABLE `sorties` (
  `id` int(11) NOT NULL,
  `id_sortie` varchar(100) DEFAULT NULL,
  `commercial` varchar(50) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `date_added` datetime DEFAULT NULL,
  `description` text,
  `username` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `sorties`
--

INSERT INTO `sorties` (`id`, `id_sortie`, `commercial`, `date`, `date_added`, `description`, `username`) VALUES
(1, 'SL1', 'Mohammed', '2016-12-24', '2016-12-24 14:58:08', 'Sortie pour mohamed calamar 24', 'admin'),
(2, 'SL2', 'Mohammed', '2016-12-24', '2016-12-24 15:26:05', 'Sortie Mohammed 2 pota poule', 'admin'),
(3, 'SL3', 'Mostafa', '2016-12-24', '2016-12-24 17:20:10', 'Sortie Poulpe', 'admin'),
(4, 'SL4', 'Vente Magasin', '2016-12-24', '2016-12-24 19:54:23', 'sl4 Com', 'admin'),
(5, 'SL5', 'Transfert de Dépot', '2016-12-24', '2016-12-24 19:55:09', 'sl5 com', 'admin'),
(6, 'SL6', 'Transfert de Dépot', '2016-12-24', '2016-12-24 20:09:38', 'sl6 com', 'admin'),
(7, 'SL7', 'Mostafa', '2016-12-24', '2016-12-24 20:10:15', 'sl7 com', 'admin'),
(8, 'SL8', 'Mostafa', '2016-12-24', '2016-12-24 20:21:18', 'col sl8', 'admin'),
(9, 'SL9', 'Mohammed', '2016-12-24', '2016-12-24 20:35:44', '', 'admin');

-- --------------------------------------------------------

--
-- Structure de la table `stock_avail`
--

CREATE TABLE `stock_avail` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(120) DEFAULT NULL,
  `numLot` varchar(30) DEFAULT NULL,
  `quantity` decimal(10,2) UNSIGNED DEFAULT NULL,
  `date_premption` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `stock_avail`
--

INSERT INTO `stock_avail` (`id`, `name`, `numLot`, `quantity`, `date_premption`) VALUES
(1, 'pota', '0001', '1000.00', '2016-12-31'),
(2, 'calamar', '0002', '3500.00', '2016-12-30'),
(3, 'poulpe', '0003', '2500.00', '2016-12-31'),
(4, 'calamar', '0004', '1000.00', '2016-12-31');

-- --------------------------------------------------------

--
-- Structure de la table `stock_details`
--

CREATE TABLE `stock_details` (
  `id` int(10) UNSIGNED NOT NULL,
  `stock_id` varchar(120) DEFAULT NULL,
  `stock_name` varchar(120) DEFAULT NULL,
  `stock_quatity` int(11) DEFAULT NULL,
  `supplier_id` varchar(250) DEFAULT NULL,
  `company_price` decimal(10,2) DEFAULT NULL,
  `selling_price` decimal(10,2) DEFAULT NULL,
  `category` varchar(120) DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `expire_date` datetime DEFAULT NULL,
  `uom` varchar(120) DEFAULT NULL,
  `kgParUnite` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `stock_details`
--

INSERT INTO `stock_details` (`id`, `stock_id`, `stock_name`, `stock_quatity`, `supplier_id`, `company_price`, `selling_price`, `category`, `date`, `expire_date`, `uom`, `kgParUnite`) VALUES
(1, 'ST1', 'pota', 0, NULL, NULL, NULL, 'cephalopode', '2016-12-13 19:45:03', NULL, NULL, 10),
(2, 'ST2', 'calamar', 0, NULL, NULL, NULL, 'cephalopode', '2016-12-13 19:45:19', NULL, NULL, 8),
(3, 'ST3', 'poulpe', 0, NULL, NULL, NULL, 'cephalopode', '2016-12-13 19:45:34', NULL, NULL, 10);

-- --------------------------------------------------------

--
-- Structure de la table `stock_entries`
--

CREATE TABLE `stock_entries` (
  `id` int(10) UNSIGNED NOT NULL,
  `stock_id` varchar(120) DEFAULT NULL,
  `stock_name` varchar(260) DEFAULT NULL,
  `quantity` decimal(10,2) UNSIGNED DEFAULT NULL,
  `date` date DEFAULT NULL,
  `numLot` varchar(30) DEFAULT NULL,
  `type` varchar(50) DEFAULT NULL,
  `count1` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `stock_entries`
--

INSERT INTO `stock_entries` (`id`, `stock_id`, `stock_name`, `quantity`, `date`, `numLot`, `type`, `count1`) VALUES
(1, 'PR1', 'pota', '8000.00', '2016-12-24', '0001', 'entry', 1),
(2, 'PR1', 'calamar', '5000.00', '2016-12-24', '0002', 'entry', 2),
(3, 'PR1', 'poulpe', '6000.00', '2016-12-24', '0003', 'entry', 3),
(4, 'PR2', 'calamar', '1000.00', '2016-12-24', '0004', 'entry', 1),
(6, 'SL1', 'calamar', '700.00', '2016-12-24', '0002', 'return', 1),
(7, 'SL2', 'pota', '700.00', '2016-12-24', '0001', 'return', 1),
(8, 'SL3', 'calamar', '500.00', '2016-12-24', '0002', 'return', 1),
(9, 'SL7', 'poulpe', '500.00', '2016-12-24', '0003', 'return', 1);

-- --------------------------------------------------------

--
-- Structure de la table `stock_sales`
--

CREATE TABLE `stock_sales` (
  `id` int(10) UNSIGNED NOT NULL,
  `transactionid` varchar(250) DEFAULT NULL,
  `stock_name` varchar(200) DEFAULT NULL,
  `numLot` varchar(30) DEFAULT NULL,
  `quantity` decimal(10,2) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `count1` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `stock_sales`
--

INSERT INTO `stock_sales` (`id`, `transactionid`, `stock_name`, `numLot`, `quantity`, `date`, `count1`) VALUES
(1, 'SL1', 'calamar', '0002', '1000.00', '2016-12-24', 1),
(2, 'SL2', 'pota', '0001', '1000.00', '2016-12-24', 1),
(3, 'SL2', 'poulpe', '0003', '500.00', '2016-12-24', 2),
(4, 'SL3', 'calamar', '0002', '700.00', '2016-12-24', 1),
(5, 'SL3', 'poulpe', '0003', '500.00', '2016-12-24', 2),
(6, 'SL4', 'pota', '0001', '700.00', '2016-12-24', 1),
(7, 'SL5', 'calamar', '0002', '500.00', '2016-12-24', 1),
(8, 'SL6', 'pota', '0001', '1000.00', '2016-12-24', 1),
(9, 'SL7', 'poulpe', '0003', '1000.00', '2016-12-24', 1),
(10, 'SL8', 'pota', '0001', '4000.00', '2016-12-24', 1),
(11, 'SL8', 'poulpe', '0003', '2000.00', '2016-12-24', 2),
(12, 'SL9', 'pota', '0001', '1000.00', '2016-12-24', 1),
(13, 'SL9', 'calamar', '0002', '500.00', '2016-12-24', 2);

-- --------------------------------------------------------

--
-- Structure de la table `stock_user`
--

CREATE TABLE `stock_user` (
  `id` int(10) UNSIGNED NOT NULL,
  `username` varchar(120) DEFAULT NULL,
  `password` varchar(120) DEFAULT NULL,
  `user_type` varchar(20) DEFAULT NULL,
  `answer` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `stock_user`
--

INSERT INTO `stock_user` (`id`, `username`, `password`, `user_type`, `answer`) VALUES
(1, 'admin', 'admin', 'admin', 'inception');

-- --------------------------------------------------------

--
-- Structure de la table `store_details`
--

CREATE TABLE `store_details` (
  `name` varchar(100) DEFAULT NULL,
  `log` varchar(100) DEFAULT NULL,
  `type` varchar(100) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `place` varchar(100) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `phone` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `web` varchar(100) DEFAULT NULL,
  `pin` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `store_details`
--

INSERT INTO `store_details` (`name`, `log`, `type`, `address`, `place`, `city`, `phone`, `email`, `web`, `pin`) VALUES
('AZUL', 'AZUllogo.png', 'image/png', '133', 'HSR layout', 'bangalore', '7779897878', 'azul@gmail.com', 'azul.com', '60080');

-- --------------------------------------------------------

--
-- Structure de la table `supplier_details`
--

CREATE TABLE `supplier_details` (
  `id` int(10) UNSIGNED NOT NULL,
  `supplier_name` varchar(200) DEFAULT NULL,
  `supplier_address` varchar(500) DEFAULT NULL,
  `supplier_contact1` varchar(100) DEFAULT NULL,
  `supplier_contact2` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `supplier_details`
--

INSERT INTO `supplier_details` (`id`, `supplier_name`, `supplier_address`, `supplier_contact1`, `supplier_contact2`) VALUES
(1, 'Ayoub', 'agadir', '0643833697', ''),
(2, 'Flan', '', '0643833697', '');

-- --------------------------------------------------------

--
-- Structure de la table `transactions`
--

CREATE TABLE `transactions` (
  `id` int(10) UNSIGNED NOT NULL,
  `type` varchar(50) DEFAULT NULL,
  `customer` varchar(250) DEFAULT NULL,
  `supplier` varchar(250) DEFAULT NULL,
  `subtotal` decimal(10,2) DEFAULT NULL,
  `payment` decimal(10,2) DEFAULT NULL,
  `balance` decimal(10,2) DEFAULT NULL,
  `due` datetime DEFAULT NULL,
  `date` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `rid` varchar(120) DEFAULT NULL,
  `receiptid` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `uom_details`
--

CREATE TABLE `uom_details` (
  `id` int(10) UNSIGNED ZEROFILL NOT NULL,
  `name` varchar(120) DEFAULT NULL,
  `spec` varchar(120) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `uom_details`
--

INSERT INTO `uom_details` (`id`, `name`, `spec`) VALUES
(0000000006, 'UOM1', 'UOM1 Specification'),
(0000000007, 'UOM2', 'UOM2 Specification'),
(0000000008, 'UOM3', 'UOM3 Specification'),
(0000000009, 'UOM4', 'UOM4 Specification');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `category_details`
--
ALTER TABLE `category_details`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `customer_details`
--
ALTER TABLE `customer_details`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `entries`
--
ALTER TABLE `entries`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `returns_descriptions`
--
ALTER TABLE `returns_descriptions`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `sales_details`
--
ALTER TABLE `sales_details`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `sorties`
--
ALTER TABLE `sorties`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `stock_avail`
--
ALTER TABLE `stock_avail`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `stock_details`
--
ALTER TABLE `stock_details`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `stock_entries`
--
ALTER TABLE `stock_entries`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `stock_sales`
--
ALTER TABLE `stock_sales`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `stock_user`
--
ALTER TABLE `stock_user`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `supplier_details`
--
ALTER TABLE `supplier_details`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `uom_details`
--
ALTER TABLE `uom_details`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `category_details`
--
ALTER TABLE `category_details`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `customer_details`
--
ALTER TABLE `customer_details`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT pour la table `entries`
--
ALTER TABLE `entries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `returns_descriptions`
--
ALTER TABLE `returns_descriptions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `sales`
--
ALTER TABLE `sales`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT pour la table `sales_details`
--
ALTER TABLE `sales_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT pour la table `sorties`
--
ALTER TABLE `sorties`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT pour la table `stock_avail`
--
ALTER TABLE `stock_avail`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT pour la table `stock_details`
--
ALTER TABLE `stock_details`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pour la table `stock_entries`
--
ALTER TABLE `stock_entries`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT pour la table `stock_sales`
--
ALTER TABLE `stock_sales`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT pour la table `stock_user`
--
ALTER TABLE `stock_user`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `supplier_details`
--
ALTER TABLE `supplier_details`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `uom_details`
--
ALTER TABLE `uom_details`
  MODIFY `id` int(10) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
