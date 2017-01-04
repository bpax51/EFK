-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Client :  127.0.0.1
-- Généré le :  Jeu 22 Décembre 2016 à 03:03
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
(1, 'pota', '0005', '10.00'),
(2, 'pota', '0006', '180.00'),
(4, 'pota', '0987', '30.00');

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
  `stock_supplier_name` varchar(200) DEFAULT NULL,
  `quantity` decimal(10,2) UNSIGNED DEFAULT NULL,
  `date` date DEFAULT NULL,
  `numLot` varchar(30) DEFAULT NULL,
  `dateEcheance` date DEFAULT NULL,
  `username` varchar(120) DEFAULT NULL,
  `type` varchar(50) DEFAULT NULL,
  `description` varchar(500) DEFAULT NULL,
  `count1` int(11) DEFAULT NULL,
  `date_added` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `stock_entries`
--

INSERT INTO `stock_entries` (`id`, `stock_id`, `stock_name`, `stock_supplier_name`, `quantity`, `date`, `numLot`, `dateEcheance`, `username`, `type`, `description`, `count1`, `date_added`) VALUES
(1, 'PR1', 'calamar', 'Flan', '500.00', '2016-12-13', '0002', '2018-12-19', 'admin', 'entry', '', 1, '0000-00-00 00:00:00'),
(2, 'PR1', 'poulpe', 'Flan', '1000.00', '2016-12-13', '0003', '2018-12-19', 'admin', 'entry', '', 2, '0000-00-00 00:00:00'),
(3, 'PR1', 'pota', 'Flan', '1000.00', '2016-12-13', '0001', '2017-12-21', 'admin', 'entry', '', 3, '0000-00-00 00:00:00'),
(4, 'PR2', 'pota', 'Ayoub', '34.00', '2016-12-18', '1', '2016-12-18', 'admin', 'entry', '', 1, '0000-00-00 00:00:00'),
(5, 'PR2', 'pota', 'Ayoub', '30.00', '2016-12-18', '2', '2016-12-18', 'admin', 'entry', '', 2, '0000-00-00 00:00:00'),
(6, 'PR2', 'calamar', 'Ayoub', '1000.00', '2016-12-18', '1', '2016-12-18', 'admin', 'entry', '', 3, '0000-00-00 00:00:00'),
(7, 'PR3', 'pota', 'Ayoub', '34.00', '2016-12-18', '2345', '2016-12-02', 'admin', 'entry', '', 1, '0000-00-00 00:00:00'),
(8, 'PR4', 'calamar', 'Flan', '66.00', '2016-12-18', '4567', '2016-12-03', 'admin', 'entry', '', 1, '0000-00-00 00:00:00'),
(9, 'PR5', 'pota', 'Flan', '1111.00', '2016-12-30', '3456', '2016-12-02', 'admin', 'entry', '', 1, '2016-12-18 18:44:27'),
(10, 'PR6', 'pota', 'Ayoub', '34.00', '2016-12-21', '0005', '2016-12-31', 'admin', 'entry', '', 1, '2016-12-21 00:11:43'),
(11, 'PR6', 'pota', 'Ayoub', '1234.00', '2016-12-21', '0006', '2016-12-31', 'admin', 'entry', '', 2, '2016-12-21 00:11:43'),
(12, 'PR7', 'poulpe', 'Ayoub', '234.00', '2016-12-21', '0009', '2016-12-31', 'admin', 'entry', '', 1, '2016-12-21 02:30:22'),
(13, 'PR7', 'pota', 'Ayoub', '30.00', '2016-12-21', '0987', '2016-12-31', 'admin', 'entry', '', 2, '2016-12-21 02:30:22');

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
  `username` varchar(120) DEFAULT NULL,
  `customer_id` varchar(120) DEFAULT NULL,
  `description` varchar(500) DEFAULT NULL,
  `count1` int(11) DEFAULT NULL,
  `date_added` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `stock_sales`
--

INSERT INTO `stock_sales` (`id`, `transactionid`, `stock_name`, `numLot`, `quantity`, `date`, `username`, `customer_id`, `description`, `count1`, `date_added`) VALUES
(1, 'SL1', 'pota', '00987', '1000.00', '2016-12-21', 'admin', 'Mohammed', '', 1, '2016-12-21 03:46:25'),
(2, 'SL1', 'pota', '0986', '10.00', '2016-12-21', 'admin', 'Mohammed', '', 2, '2016-12-21 03:46:25'),
(3, 'SL2', 'pota', '098776', '4.00', '2016-12-21', 'admin', 'Mohammed', '', 1, '2016-12-21 03:50:53'),
(4, 'SL3', 'pota', '345', '10.00', '2016-12-21', 'admin', 'Mohammed', '', 1, '2016-12-21 03:57:39'),
(5, 'SL4', 'pota', '234456', '34.00', '2016-12-21', 'admin', 'Mohammed', '', 1, '2016-12-21 03:59:47'),
(6, 'SL5', 'pota', '123', '10.00', '2016-12-21', 'admin', 'Mohammed', '', 1, '2016-12-21 04:08:47'),
(7, 'SL6', 'pota', '0006', '10.00', '2016-12-21', 'admin', 'Mohammed', '', 1, '2016-12-21 04:24:56');

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT pour la table `stock_sales`
--
ALTER TABLE `stock_sales`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
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
