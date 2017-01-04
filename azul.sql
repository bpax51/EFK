-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Client :  127.0.0.1
-- Généré le :  Ven 23 Décembre 2016 à 01:50
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
(1, 'Mohammed', '', '0643833697', '', 0);

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
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `entries`
--

INSERT INTO `entries` (`id`, `id_entrie`, `supplier_name`, `date`, `description`, `username`, `date_added`) VALUES
(1, 'PR8', NULL, NULL, 'TRRRRRRRRRRRRRRRRRRRRRRTRESTREST', NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `returns_descriptions`
--

CREATE TABLE `returns_descriptions` (
  `id` int(11) NOT NULL,
  `id_return` varchar(100) DEFAULT NULL,
  `description` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `sales`
--

CREATE TABLE `sales` (
  `id` int(11) NOT NULL,
  `id_sortie` varchar(100) DEFAULT NULL,
  `commercial` varchar(50) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `date_retour` date DEFAULT NULL,
  `date_added` datetime DEFAULT NULL,
  `username` varchar(30) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

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
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

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
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `sorties`
--

INSERT INTO `sorties` (`id`, `id_sortie`, `commercial`, `date`, `date_added`, `description`, `username`) VALUES
(1, 'SL1', 'Mohammed', '2016-12-23', '2016-12-23 02:14:54', 'RRRRRRRRRRRRRRRRRRRR', 'admin'),
(2, 'SL2', 'Mohammed', '2016-12-23', '2016-12-23 02:15:54', 'zzez', 'admin');

-- --------------------------------------------------------

--
-- Structure de la table `stock_avail`
--

CREATE TABLE `stock_avail` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(120) DEFAULT NULL,
  `numLot` varchar(30) DEFAULT NULL,
  `quantity` decimal(10,2) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `stock_avail`
--

INSERT INTO `stock_avail` (`id`, `name`, `numLot`, `quantity`) VALUES
(1, 'pota', '0005', '2.00'),
(2, 'pota', '0006', '180.00'),
(4, 'pota', '0987', '30.00'),
(5, 'pota', '1111', '250.00');

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
  `dateEcheance` date DEFAULT NULL,
  `type` varchar(50) DEFAULT NULL,
  `count1` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `stock_entries`
--

INSERT INTO `stock_entries` (`id`, `stock_id`, `stock_name`, `quantity`, `date`, `numLot`, `dateEcheance`, `type`, `count1`) VALUES
(1, 'PR1', 'calamar', '500.00', '2016-12-13', '0002', '2018-12-19', 'entry', 1),
(2, 'PR1', 'poulpe', '1000.00', '2016-12-13', '0003', '2018-12-19', 'entry', 2),
(3, 'PR1', 'pota', '1000.00', '2016-12-13', '0001', '2017-12-21', 'entry', 3),
(4, 'PR2', 'pota', '34.00', '2016-12-18', '1', '2016-12-18', 'entry', 1),
(5, 'PR2', 'pota', '30.00', '2016-12-18', '2', '2016-12-18', 'entry', 2),
(6, 'PR2', 'calamar', '1000.00', '2016-12-18', '1', '2016-12-18', 'entry', 3),
(7, 'PR3', 'pota', '34.00', '2016-12-18', '2345', '2016-12-02', 'entry', 1),
(8, 'PR4', 'calamar', '66.00', '2016-12-18', '4567', '2016-12-03', 'entry', 1),
(9, 'PR5', 'pota', '1111.00', '2016-12-30', '3456', '2016-12-02', 'entry', 1),
(10, 'PR6', 'pota', '34.00', '2016-12-21', '0005', '2016-12-31', 'entry', 1),
(11, 'PR6', 'pota', '1234.00', '2016-12-21', '0006', '2016-12-31', 'entry', 2),
(12, 'PR7', 'poulpe', '234.00', '2016-12-21', '0009', '2016-12-31', 'entry', 1),
(13, 'PR7', 'pota', '30.00', '2016-12-21', '0987', '2016-12-31', 'entry', 2),
(14, 'PR8', 'pota', '450.00', '2016-12-22', '1111', '2016-12-31', 'entry', 1);

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
(1, 'SL1', 'pota', '1111', '5.00', '2016-12-23', 1),
(2, 'SL1', 'pota', '0005', '2.00', '2016-12-23', 2),
(3, 'SL2', 'pota', '1111', '100.00', '2016-12-23', 1);

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
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `entries`
--
ALTER TABLE `entries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `returns_descriptions`
--
ALTER TABLE `returns_descriptions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `sales`
--
ALTER TABLE `sales`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `sales_details`
--
ALTER TABLE `sales_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `sorties`
--
ALTER TABLE `sorties`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `stock_avail`
--
ALTER TABLE `stock_avail`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT pour la table `stock_details`
--
ALTER TABLE `stock_details`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pour la table `stock_entries`
--
ALTER TABLE `stock_entries`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT pour la table `stock_sales`
--
ALTER TABLE `stock_sales`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
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
