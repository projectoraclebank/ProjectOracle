-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 12, 2018 at 02:42 PM
-- Server version: 10.1.19-MariaDB
-- PHP Version: 7.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project_oracle_FINAL`
--

-- --------------------------------------------------------

--
-- Table structure for table `adresse`
--

CREATE TABLE `adresse` (
  `idadresse` int(11) NOT NULL,
  `id_type_adresse` int(11) NOT NULL,
  `description_adresse` varchar(255) NOT NULL,
  `nom_proprietaire_id` int(11) DEFAULT NULL,
  `date_creation` datetime NOT NULL,
  `date_mise_a_jour` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `adresse`
--

INSERT INTO `adresse` (`idadresse`, `id_type_adresse`, `description_adresse`, `nom_proprietaire_id`, `date_creation`, `date_mise_a_jour`) VALUES
(13, 1, '43, marinai 12', 29, '2018-03-08 11:33:36', '2018-03-08 11:33:36'),
(14, 1, '43, mariani 12', 30, '2018-03-08 11:58:36', '2018-03-08 11:58:36'),
(15, 1, '43, Mariani 12', 31, '2018-03-08 12:01:31', '2018-03-08 12:01:31'),
(31, 1, '32, mariani', 53, '2018-03-12 03:10:03', '2018-03-12 03:10:03');

-- --------------------------------------------------------

--
-- Table structure for table `agence`
--

CREATE TABLE `agence` (
  `idagence` int(11) NOT NULL,
  `type_agence` varchar(45) NOT NULL DEFAULT 'SUCCURSALE',
  `nom_agence` varchar(500) NOT NULL,
  `tel_agence` int(11) NOT NULL,
  `adresse_agence` varchar(255) NOT NULL,
  `actif_agence` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `agence`
--

INSERT INTO `agence` (`idagence`, `type_agence`, `nom_agence`, `tel_agence`, `adresse_agence`, `actif_agence`) VALUES
(1, 'SUCCURSALE', 'CARREFOUR', 34221904, '43, Mariani 12', 1),
(2, 'SUCCURSALE', 'PETION-VILLE', 31321210, 'Rue Goulard', 0);

-- --------------------------------------------------------

--
-- Table structure for table `carte`
--

CREATE TABLE `carte` (
  `idcarte` bigint(11) NOT NULL,
  `id_compte` int(11) NOT NULL,
  `code_secret` varchar(2000) NOT NULL,
  `type_carte` int(11) NOT NULL,
  `date_fabrication` date NOT NULL,
  `date_mise_circulation` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `carte`
--

INSERT INTO `carte` (`idcarte`, `id_compte`, `code_secret`, `type_carte`, `date_fabrication`, `date_mise_circulation`) VALUES
(54460000011, 15, '1884', 1, '2018-03-12', '2018-03-21'),
(54460000012, 19, '8379', 1, '2018-03-12', '2018-03-21'),
(54460000013, 21, '7263', 1, '2018-03-12', '2018-03-21'),
(54460000014, 22, '4981', 1, '2018-03-12', '2018-03-21'),
(54460000015, 100000001, '9668', 1, '2018-03-12', '2018-03-21'),
(54460000016, 100000002, '1435', 1, '2018-03-12', '2018-03-21'),
(54460000017, 100000003, '6796', 1, '2018-03-12', '2018-03-21');

-- --------------------------------------------------------

--
-- Table structure for table `client`
--

CREATE TABLE `client` (
  `idclient` int(11) NOT NULL,
  `nom_client` varchar(45) NOT NULL,
  `prenom_client` varchar(45) NOT NULL,
  `naissance_client` date NOT NULL,
  `nif_client` int(10) NOT NULL,
  `cin_client` int(17) NOT NULL,
  `sexe_client` varchar(7) NOT NULL,
  `civilite_client` varchar(11) NOT NULL,
  `userClientID` int(11) NOT NULL,
  `date_creation` datetime NOT NULL,
  `date_mise_a_jour` datetime NOT NULL,
  `id_succursale` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `client`
--

INSERT INTO `client` (`idclient`, `nom_client`, `prenom_client`, `naissance_client`, `nif_client`, `cin_client`, `sexe_client`, `civilite_client`, `userClientID`, `date_creation`, `date_mise_a_jour`, `id_succursale`) VALUES
(17, 'SYLVAINCE', 'Djason Irvinton ', '0000-00-00', 22748123, 2147483647, 'Homme', 'Mr.', 53, '2018-03-12 03:10:03', '2018-03-12 03:10:03', 2);

-- --------------------------------------------------------

--
-- Table structure for table `compte`
--

CREATE TABLE `compte` (
  `idcompte` int(9) NOT NULL,
  `iban` varchar(34) NOT NULL,
  `bic` varchar(11) NOT NULL,
  `type_compte_id` int(11) NOT NULL,
  `id_proprietaire` int(11) NOT NULL,
  `solde_compte` double NOT NULL,
  `date_creation_ct` datetime NOT NULL,
  `id_employe` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `compte`
--

INSERT INTO `compte` (`idcompte`, `iban`, `bic`, `type_compte_id`, `id_proprietaire`, `solde_compte`, `date_creation_ct`, `id_employe`) VALUES
(15, 'HT-00-BIC', 'BASH-HT-PP-', 1, 17, 2341, '2018-03-12 03:10:03', 17),
(19, 'HT-00-BIC53', 'BASH-HT-PP-', 1, 17, 234, '2018-03-12 03:17:51', 17),
(21, 'HT-00-BIC8', 'BASH-HT-PP-', 1, 17, 234, '2018-03-12 03:20:45', 17),
(22, 'HT-00-BIC6', 'BASH-HT-PP-', 1, 17, 234, '2018-03-12 03:21:08', 17),
(100000001, 'HT-00-BIC4', 'BASH-HT-PP-', 1, 17, 258, '2018-03-12 03:21:33', 17),
(100000002, 'HT-00-BIC3', 'BASH-HT-PP-', 1, 17, 234, '2018-03-12 03:21:36', 17),
(100000003, 'HT-00-BIC9', 'BASH-HT-PP-', 1, 17, 253, '2018-03-12 03:22:34', 17);

-- --------------------------------------------------------

--
-- Table structure for table `credit`
--

CREATE TABLE `credit` (
  `idcredit` int(11) NOT NULL,
  `compte_id` int(11) NOT NULL,
  `remboursement_id` int(11) NOT NULL,
  `type_credit_id` int(11) NOT NULL,
  `montant_emprunt` double NOT NULL,
  `interet` double NOT NULL,
  `date_creation` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `email`
--

CREATE TABLE `email` (
  `idemail` int(11) NOT NULL,
  `id_type_mail` int(11) NOT NULL,
  `nom_proprietaire_id` int(11) DEFAULT NULL,
  `email_emp` varchar(500) NOT NULL,
  `date_creation` datetime DEFAULT NULL,
  `date_mise_a_jour` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `email`
--

INSERT INTO `email` (`idemail`, `id_type_mail`, `nom_proprietaire_id`, `email_emp`, `date_creation`, `date_mise_a_jour`) VALUES
(14, 29, 1, 'benoit@gmail.com', '2018-03-08 11:33:36', '2018-03-08 11:33:36'),
(15, 30, 1, 'djason@gmail.com', '2018-03-08 11:58:36', '2018-03-08 11:58:36'),
(16, 31, 1, 'jacqueline@gmail.com', '2018-03-08 12:01:31', '2018-03-08 12:01:31'),
(32, 1, 53, 'dj@mail.com', '2018-03-12 03:10:03', '2018-03-12 03:10:03');

-- --------------------------------------------------------

--
-- Table structure for table `employe`
--

CREATE TABLE `employe` (
  `idemploye` int(11) NOT NULL,
  `code_emp` varchar(100) NOT NULL,
  `nom_emp` varchar(45) NOT NULL,
  `prenom_emp` varchar(45) NOT NULL,
  `sexe_emp` varchar(7) NOT NULL,
  `naissance_emp` date NOT NULL,
  `civilite_emp` varchar(6) NOT NULL,
  `nif_emp` varchar(50) NOT NULL,
  `cin_emp` varchar(50) NOT NULL,
  `user_emp_id` int(11) NOT NULL,
  `type_user_id` int(11) NOT NULL,
  `date_creation` datetime NOT NULL,
  `date_mise_a_jour` datetime DEFAULT NULL,
  `id_succursale` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employe`
--

INSERT INTO `employe` (`idemploye`, `code_emp`, `nom_emp`, `prenom_emp`, `sexe_emp`, `naissance_emp`, `civilite_emp`, `nif_emp`, `cin_emp`, `user_emp_id`, `type_user_id`, `date_creation`, `date_mise_a_jour`, `id_succursale`) VALUES
(16, 'EMP-BEN-SCH-29', 'BENOIT', 'Schneider', 'Homme', '1993-12-01', 'Mr.', '8389-09-09', '01-90-99-0998', 29, 2, '2018-03-08 11:33:36', '2018-03-08 11:33:36', 1),
(17, 'EMP-SYL-DJA-30', 'SYLVAINCE', 'Djason Irvinton', 'Homme', '1994-05-16', 'Mr.', '009-12-234', '009-02-00I', 30, 2, '2018-03-08 11:58:36', '2018-03-08 11:58:36', 2),
(18, 'EMP-SYL-JAC-31', 'SYLVAINCE', 'Jacqueline', 'Femme', '1970-12-14', 'Me.', '12-09-0007', '009-34-008', 31, 2, '2018-03-08 12:01:31', '2018-03-08 12:01:31', 1);

-- --------------------------------------------------------

--
-- Table structure for table `employe_fonction`
--

CREATE TABLE `employe_fonction` (
  `idemploye_fonction` int(11) NOT NULL,
  `emp_fonc_id` int(11) DEFAULT NULL,
  `fonction_id` int(11) DEFAULT NULL,
  `actif_emp` tinyint(1) NOT NULL,
  `date_creation` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employe_fonction`
--

INSERT INTO `employe_fonction` (`idemploye_fonction`, `emp_fonc_id`, `fonction_id`, `actif_emp`, `date_creation`) VALUES
(13, 16, 1, 1, '2018-03-08 11:33:36'),
(14, 17, 2, 1, '2018-03-08 11:58:36'),
(15, 18, 3, 1, '2018-03-08 12:01:31');

-- --------------------------------------------------------

--
-- Table structure for table `fonction`
--

CREATE TABLE `fonction` (
  `idfonction` int(11) NOT NULL,
  `titre_fonction` varchar(300) NOT NULL,
  `desc_fonction` varchar(45) NOT NULL,
  `salaire_fonction` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `fonction`
--

INSERT INTO `fonction` (`idfonction`, `titre_fonction`, `desc_fonction`, `salaire_fonction`) VALUES
(1, 'DIRECTEUR ', 'Directeur General', 63000),
(2, 'SECRETAIRE ADJOINT', 'SECRETAIRE ADJOINT', 50500),
(3, 'SECRETAIRE GENERAL', 'SECRETAIRE GENERAL', 57500),
(4, 'SERVICE CLIENTÃƒÂ¨LE', 'service client', 7500);

-- --------------------------------------------------------

--
-- Table structure for table `login_hystoric`
--

CREATE TABLE `login_hystoric` (
  `id_login` int(11) NOT NULL,
  `user_login` int(11) NOT NULL,
  `ip_login` varchar(200) NOT NULL,
  `date_login` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `login_hystoric`
--

INSERT INTO `login_hystoric` (`id_login`, `user_login`, `ip_login`, `date_login`) VALUES
(5, 1, '127.0.0.1', '2018-03-05 00:00:00'),
(6, 1, '127.0.0.1', '2018-03-04 04:13:56'),
(7, 1, '192.168.1.12', '2018-03-04 15:10:13'),
(8, 1, '127.0.0.1', '2018-03-06 07:27:17'),
(9, 1, '127.0.0.1', '2018-03-07 07:22:37'),
(10, 1, '127.0.0.1', '2018-03-07 14:22:10'),
(11, 1, '127.0.0.1', '2018-03-08 04:06:22'),
(12, 1, '127.0.0.1', '2018-03-08 21:28:57'),
(13, 1, '127.0.0.1', '2018-03-08 23:20:26'),
(14, 1, '127.0.0.1', '2018-03-08 23:28:56'),
(15, 1, '127.0.0.1', '2018-03-09 13:20:53'),
(16, 1, '127.0.0.1', '2018-03-11 13:54:34'),
(17, 1, '127.0.0.1', '2018-03-11 15:54:26');

-- --------------------------------------------------------

--
-- Table structure for table `remboursement`
--

CREATE TABLE `remboursement` (
  `idremboursement` int(11) NOT NULL,
  `type_remboursement` varchar(45) DEFAULT NULL,
  `duree_remboursement` int(5) DEFAULT NULL,
  `remboursementcol` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tarif`
--

CREATE TABLE `tarif` (
  `idtarif` int(11) NOT NULL,
  `idremboursement` int(11) NOT NULL,
  `taux_reel_annuel` int(9) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `telephone`
--

CREATE TABLE `telephone` (
  `idtelephone` int(11) NOT NULL,
  `id_type_telephone` int(11) NOT NULL,
  `id_proprietaire` int(11) DEFAULT NULL,
  `numero_telephone` int(11) NOT NULL,
  `date_creation` datetime NOT NULL,
  `date_mise_a_jour` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `telephone`
--

INSERT INTO `telephone` (`idtelephone`, `id_type_telephone`, `id_proprietaire`, `numero_telephone`, `date_creation`, `date_mise_a_jour`) VALUES
(13, 1, 29, 37562575, '2018-03-08 11:33:36', '2018-03-08 11:33:36'),
(14, 1, 30, 31281904, '2018-03-08 11:58:36', '2018-03-08 11:58:36'),
(15, 1, 31, 34221964, '2018-03-08 12:01:31', '2018-03-08 12:01:31'),
(31, 1, 53, 31282801, '2018-03-12 03:10:03', '2018-03-12 03:10:03');

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE `transaction` (
  `idtransaction` int(11) NOT NULL,
  `compte_donneur_id` int(11) NOT NULL,
  `compte_beneficiare_id` int(11) NOT NULL,
  `typeTransID` int(11) NOT NULL,
  `information_textuel` varchar(2000) NOT NULL,
  `message_communication` varchar(2000) NOT NULL,
  `date_creation` datetime NOT NULL,
  `employer_id` int(11) NOT NULL,
  `montant_transaction` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `transaction`
--

INSERT INTO `transaction` (`idtransaction`, `compte_donneur_id`, `compte_beneficiare_id`, `typeTransID`, `information_textuel`, `message_communication`, `date_creation`, `employer_id`, `montant_transaction`) VALUES
(12, 15, 15, 0, 'Transaction douverture du compte.', 'Transaction douverture du compte.', '2018-03-12 03:10:03', 17, 234),
(13, 19, 19, 0, 'Transaction douverture du compte.', 'Transaction douverture du compte.', '2018-03-12 03:17:52', 17, 234),
(14, 21, 21, 0, 'Transaction douverture du compte.', 'Transaction douverture du compte.', '2018-03-12 03:20:45', 17, 234),
(15, 22, 22, 0, 'Transaction douverture du compte.', 'Transaction douverture du compte.', '2018-03-12 03:21:08', 17, 234),
(16, 100000001, 100000001, 0, 'Transaction douverture du compte.', 'Transaction douverture du compte.', '2018-03-12 03:21:33', 17, 234),
(17, 100000002, 100000002, 0, 'Transaction douverture du compte.', 'Transaction douverture du compte.', '2018-03-12 03:21:36', 17, 234),
(18, 100000003, 100000003, 0, 'Transaction douverture du compte.', 'Transaction douverture du compte.', '2018-03-12 03:22:34', 17, 234),
(27, 100000003, 100000003, 1, 'Aucun', 'Aucun', '2018-03-12 09:48:18', 17, 3),
(28, 100000003, 100000003, 1, 'Retrait', 'Retrait', '2018-03-12 10:14:21', 17, 100),
(29, 100000003, 100000003, 1, 'retrait', 'retrait', '2018-03-12 10:16:28', 17, 1),
(30, 100000003, 100000003, 1, 'retrait', 'Vous avez fait un retrait de 1 sur 133 . Solde actuel: 132', '2018-03-12 10:17:23', 17, 1),
(31, 100000003, 100000003, 1, 'transaction effectuer', 'Un depot a Ã©tÃ© effectuÃ© sur votre compte. Montant :145 . Solde Avant:132 . Solde apres: 277', '2018-03-12 10:28:59', 17, 145),
(35, 100000003, 100000003, 3, 'aucun m', 'Vous avez fait un virement de 12 sur 277vers100000001 . Solde actuel: 265', '2018-03-12 10:52:18', 17, 12),
(36, 100000003, 100000001, 3, 'aucun m', 'Vous avez fait un virement de 12 sur 265vers100000001 . Solde actuel: 253', '2018-03-12 10:53:17', 17, 12);

-- --------------------------------------------------------

--
-- Table structure for table `types_informations`
--

CREATE TABLE `types_informations` (
  `idtypes_informations` int(11) NOT NULL,
  `description_type_infos` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `types_informations`
--

INSERT INTO `types_informations` (`idtypes_informations`, `description_type_infos`) VALUES
(1, 'PRINCIPALE'),
(2, 'SECONDAIRE');

-- --------------------------------------------------------

--
-- Table structure for table `type_carte`
--

CREATE TABLE `type_carte` (
  `description_type_carte` varchar(45) DEFAULT NULL,
  `id_type_carte` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `type_carte`
--

INSERT INTO `type_carte` (`description_type_carte`, `id_type_carte`) VALUES
('VISA', 1),
('MASTERCARD', 2);

-- --------------------------------------------------------

--
-- Table structure for table `type_compte`
--

CREATE TABLE `type_compte` (
  `idtype_compte` int(11) NOT NULL,
  `desc_type_compte` varchar(50) NOT NULL,
  `plafond_semaine` decimal(50,0) NOT NULL,
  `date_creation` datetime NOT NULL,
  `date_mise_a_jour` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `type_compte`
--

INSERT INTO `type_compte` (`idtype_compte`, `desc_type_compte`, `plafond_semaine`, `date_creation`, `date_mise_a_jour`) VALUES
(1, 'COURANT GDES', '50000', '2018-03-09 00:00:00', '2018-03-09 00:00:00'),
(2, 'EPARGNE GDES', '50000', '2018-03-09 00:00:00', '2018-03-09 00:00:00'),
(3, 'COURANT DOLLARS', '10000', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 'EPARGNE', '10000', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `type_credit`
--

CREATE TABLE `type_credit` (
  `idtype_credit` int(11) NOT NULL,
  `description_type_credit` varchar(45) NOT NULL,
  `valeur_minimum_montant` double NOT NULL,
  `duree_minimum_remboursement` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `type_transcation`
--

CREATE TABLE `type_transcation` (
  `idtype_transcation` int(11) NOT NULL,
  `description_type_transaction` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `type_transcation`
--

INSERT INTO `type_transcation` (`idtype_transcation`, `description_type_transaction`) VALUES
(1, 'DEPOT'),
(2, 'RETRAIT'),
(3, 'VIREMENT');

-- --------------------------------------------------------

--
-- Table structure for table `type_user`
--

CREATE TABLE `type_user` (
  `idtype_user` int(11) NOT NULL,
  `description_type_user` varchar(45) NOT NULL,
  `date_creation` datetime NOT NULL,
  `date_mise_a_jour` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `type_user`
--

INSERT INTO `type_user` (`idtype_user`, `description_type_user`, `date_creation`, `date_mise_a_jour`) VALUES
(1, 'ADMINISTRATEUR', '2018-03-03 00:00:00', '2018-03-03 00:00:00'),
(2, 'EMPLOYER', '2018-03-03 04:41:53', '2018-03-03 04:41:53'),
(3, 'CLIENT', '2018-03-03 04:44:32', '2018-03-03 04:44:32');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `iduser` int(11) NOT NULL,
  `id_type_user` int(11) DEFAULT NULL,
  `pseudo` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  `actif_user` tinyint(1) NOT NULL DEFAULT '0',
  `date_creation` datetime NOT NULL,
  `date_mise_a_jour` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`iduser`, `id_type_user`, `pseudo`, `password`, `actif_user`, `date_creation`, `date_mise_a_jour`) VALUES
(1, 1, 'admin', '8cb2237d0679ca88db6464eac60da96345513964', 1, '2018-03-03 04:49:00', '2018-03-03 04:49:00'),
(29, 2, 'ingbenoit', '8cb2237d0679ca88db6464eac60da96345513964', 1, '2018-03-08 11:33:36', '2018-03-08 11:33:36'),
(30, 2, 'ingdjason', '8cb2237d0679ca88db6464eac60da96345513964', 1, '2018-03-08 11:58:36', '2018-03-08 11:58:36'),
(31, 2, 'jacqueline', '8cb2237d0679ca88db6464eac60da96345513964', 1, '2018-03-08 12:01:31', '2018-03-08 12:01:31'),
(53, 3, 'clingdjason', '12345', 1, '2018-03-12 03:10:03', '2018-03-12 03:10:03');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `adresse`
--
ALTER TABLE `adresse`
  ADD PRIMARY KEY (`idadresse`),
  ADD UNIQUE KEY `nom_proprietaire_id_UNIQUE` (`nom_proprietaire_id`),
  ADD KEY `fk_adresse_type_information_idx` (`id_type_adresse`);

--
-- Indexes for table `agence`
--
ALTER TABLE `agence`
  ADD PRIMARY KEY (`idagence`),
  ADD UNIQUE KEY `nom_agence` (`nom_agence`);

--
-- Indexes for table `carte`
--
ALTER TABLE `carte`
  ADD PRIMARY KEY (`idcarte`),
  ADD KEY `id_compte` (`id_compte`),
  ADD KEY `type_carte` (`type_carte`);

--
-- Indexes for table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`idclient`),
  ADD UNIQUE KEY `userClientID` (`userClientID`),
  ADD KEY `id_succursale` (`id_succursale`);

--
-- Indexes for table `compte`
--
ALTER TABLE `compte`
  ADD PRIMARY KEY (`idcompte`,`type_compte_id`),
  ADD UNIQUE KEY `idcompte_UNIQUE` (`idcompte`),
  ADD UNIQUE KEY `iban_UNIQUE` (`iban`),
  ADD KEY `fk_compte_employe_idx` (`id_employe`),
  ADD KEY `fk_compte_type_compte_idx` (`type_compte_id`),
  ADD KEY `id_proprietaire` (`id_proprietaire`);

--
-- Indexes for table `credit`
--
ALTER TABLE `credit`
  ADD PRIMARY KEY (`idcredit`),
  ADD KEY `compte_id` (`compte_id`),
  ADD KEY `type_credit_id` (`type_credit_id`),
  ADD KEY `remboursement_id` (`remboursement_id`);

--
-- Indexes for table `email`
--
ALTER TABLE `email`
  ADD PRIMARY KEY (`idemail`),
  ADD UNIQUE KEY `idemail_UNIQUE` (`idemail`),
  ADD KEY `fk_email_user_idx` (`nom_proprietaire_id`);

--
-- Indexes for table `employe`
--
ALTER TABLE `employe`
  ADD PRIMARY KEY (`idemploye`),
  ADD UNIQUE KEY `user_emp_id_UNIQUE` (`user_emp_id`),
  ADD UNIQUE KEY `code_emp` (`code_emp`),
  ADD KEY `fk_employe_info_agence_info_idx` (`id_succursale`),
  ADD KEY `type_user_id_UNIQUE` (`type_user_id`) USING BTREE;

--
-- Indexes for table `employe_fonction`
--
ALTER TABLE `employe_fonction`
  ADD PRIMARY KEY (`idemploye_fonction`),
  ADD KEY `emp_fonc_id_idx` (`emp_fonc_id`),
  ADD KEY `fk_employe_fonction_fonction_idx` (`fonction_id`);

--
-- Indexes for table `fonction`
--
ALTER TABLE `fonction`
  ADD PRIMARY KEY (`idfonction`);

--
-- Indexes for table `login_hystoric`
--
ALTER TABLE `login_hystoric`
  ADD PRIMARY KEY (`id_login`),
  ADD KEY `user_login` (`user_login`);

--
-- Indexes for table `remboursement`
--
ALTER TABLE `remboursement`
  ADD PRIMARY KEY (`idremboursement`),
  ADD UNIQUE KEY `idremboursement_UNIQUE` (`idremboursement`);

--
-- Indexes for table `tarif`
--
ALTER TABLE `tarif`
  ADD PRIMARY KEY (`idtarif`),
  ADD KEY `fk_tarif_remboursement_idx` (`idremboursement`);

--
-- Indexes for table `telephone`
--
ALTER TABLE `telephone`
  ADD PRIMARY KEY (`idtelephone`),
  ADD UNIQUE KEY `id_proprietaire_UNIQUE` (`id_proprietaire`),
  ADD KEY `fk_telephone_types_informations_idx` (`id_type_telephone`);

--
-- Indexes for table `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`idtransaction`),
  ADD KEY `compte_donneur_id` (`compte_donneur_id`),
  ADD KEY `compte_beneficiare_id` (`compte_beneficiare_id`),
  ADD KEY `employer_id` (`employer_id`);

--
-- Indexes for table `types_informations`
--
ALTER TABLE `types_informations`
  ADD PRIMARY KEY (`idtypes_informations`);

--
-- Indexes for table `type_carte`
--
ALTER TABLE `type_carte`
  ADD PRIMARY KEY (`id_type_carte`),
  ADD UNIQUE KEY `type_cartecol_UNIQUE` (`id_type_carte`);

--
-- Indexes for table `type_compte`
--
ALTER TABLE `type_compte`
  ADD PRIMARY KEY (`idtype_compte`),
  ADD UNIQUE KEY `idtype_compte_UNIQUE` (`idtype_compte`);

--
-- Indexes for table `type_credit`
--
ALTER TABLE `type_credit`
  ADD PRIMARY KEY (`idtype_credit`),
  ADD UNIQUE KEY `idtype_credit_UNIQUE` (`idtype_credit`);

--
-- Indexes for table `type_transcation`
--
ALTER TABLE `type_transcation`
  ADD PRIMARY KEY (`idtype_transcation`),
  ADD UNIQUE KEY `idtype_transcation_UNIQUE` (`idtype_transcation`);

--
-- Indexes for table `type_user`
--
ALTER TABLE `type_user`
  ADD PRIMARY KEY (`idtype_user`),
  ADD UNIQUE KEY `idtype_user_UNIQUE` (`idtype_user`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`iduser`),
  ADD UNIQUE KEY `iduser_UNIQUE` (`iduser`),
  ADD KEY `fk_user_type_user_idx` (`id_type_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `adresse`
--
ALTER TABLE `adresse`
  MODIFY `idadresse` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
--
-- AUTO_INCREMENT for table `agence`
--
ALTER TABLE `agence`
  MODIFY `idagence` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `carte`
--
ALTER TABLE `carte`
  MODIFY `idcarte` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54460000018;
--
-- AUTO_INCREMENT for table `client`
--
ALTER TABLE `client`
  MODIFY `idclient` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `compte`
--
ALTER TABLE `compte`
  MODIFY `idcompte` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100000004;
--
-- AUTO_INCREMENT for table `credit`
--
ALTER TABLE `credit`
  MODIFY `idcredit` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `email`
--
ALTER TABLE `email`
  MODIFY `idemail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
--
-- AUTO_INCREMENT for table `employe`
--
ALTER TABLE `employe`
  MODIFY `idemploye` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `employe_fonction`
--
ALTER TABLE `employe_fonction`
  MODIFY `idemploye_fonction` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `fonction`
--
ALTER TABLE `fonction`
  MODIFY `idfonction` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `login_hystoric`
--
ALTER TABLE `login_hystoric`
  MODIFY `id_login` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `remboursement`
--
ALTER TABLE `remboursement`
  MODIFY `idremboursement` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tarif`
--
ALTER TABLE `tarif`
  MODIFY `idtarif` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `telephone`
--
ALTER TABLE `telephone`
  MODIFY `idtelephone` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
--
-- AUTO_INCREMENT for table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `idtransaction` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;
--
-- AUTO_INCREMENT for table `types_informations`
--
ALTER TABLE `types_informations`
  MODIFY `idtypes_informations` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `type_carte`
--
ALTER TABLE `type_carte`
  MODIFY `id_type_carte` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `type_compte`
--
ALTER TABLE `type_compte`
  MODIFY `idtype_compte` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `type_credit`
--
ALTER TABLE `type_credit`
  MODIFY `idtype_credit` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `type_transcation`
--
ALTER TABLE `type_transcation`
  MODIFY `idtype_transcation` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `type_user`
--
ALTER TABLE `type_user`
  MODIFY `idtype_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `iduser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `adresse`
--
ALTER TABLE `adresse`
  ADD CONSTRAINT `fk_adresse_type_information` FOREIGN KEY (`id_type_adresse`) REFERENCES `types_informations` (`idtypes_informations`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_adresse_user` FOREIGN KEY (`nom_proprietaire_id`) REFERENCES `user` (`iduser`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `carte`
--
ALTER TABLE `carte`
  ADD CONSTRAINT `carte_ibfk_1` FOREIGN KEY (`id_compte`) REFERENCES `compte` (`idcompte`),
  ADD CONSTRAINT `carte_ibfk_2` FOREIGN KEY (`type_carte`) REFERENCES `type_carte` (`id_type_carte`);

--
-- Constraints for table `client`
--
ALTER TABLE `client`
  ADD CONSTRAINT `client_ibfk_1` FOREIGN KEY (`userClientID`) REFERENCES `user` (`iduser`),
  ADD CONSTRAINT `client_ibfk_2` FOREIGN KEY (`id_succursale`) REFERENCES `agence` (`idagence`);

--
-- Constraints for table `compte`
--
ALTER TABLE `compte`
  ADD CONSTRAINT `compte_ibfk_1` FOREIGN KEY (`id_proprietaire`) REFERENCES `client` (`idclient`),
  ADD CONSTRAINT `fk_compte_employe` FOREIGN KEY (`id_employe`) REFERENCES `employe` (`idemploye`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_compte_type_compte` FOREIGN KEY (`type_compte_id`) REFERENCES `type_compte` (`idtype_compte`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `credit`
--
ALTER TABLE `credit`
  ADD CONSTRAINT `credit_ibfk_1` FOREIGN KEY (`compte_id`) REFERENCES `compte` (`idcompte`),
  ADD CONSTRAINT `credit_ibfk_2` FOREIGN KEY (`type_credit_id`) REFERENCES `type_credit` (`idtype_credit`),
  ADD CONSTRAINT `credit_ibfk_3` FOREIGN KEY (`remboursement_id`) REFERENCES `remboursement` (`idremboursement`);

--
-- Constraints for table `email`
--
ALTER TABLE `email`
  ADD CONSTRAINT `fk_email_user` FOREIGN KEY (`nom_proprietaire_id`) REFERENCES `user` (`iduser`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `employe`
--
ALTER TABLE `employe`
  ADD CONSTRAINT `employe_ibfk_1` FOREIGN KEY (`user_emp_id`) REFERENCES `user` (`iduser`),
  ADD CONSTRAINT `fk_employe_agence` FOREIGN KEY (`id_succursale`) REFERENCES `agence` (`idagence`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_employe_type_user` FOREIGN KEY (`type_user_id`) REFERENCES `type_user` (`idtype_user`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `employe_fonction`
--
ALTER TABLE `employe_fonction`
  ADD CONSTRAINT `fk_employe_fonction_employe_info` FOREIGN KEY (`emp_fonc_id`) REFERENCES `employe` (`idemploye`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_employe_fonction_fonction` FOREIGN KEY (`fonction_id`) REFERENCES `fonction` (`idfonction`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `login_hystoric`
--
ALTER TABLE `login_hystoric`
  ADD CONSTRAINT `login_hystoric_ibfk_1` FOREIGN KEY (`user_login`) REFERENCES `user` (`iduser`);

--
-- Constraints for table `tarif`
--
ALTER TABLE `tarif`
  ADD CONSTRAINT `fk_tarif_remboursement` FOREIGN KEY (`idremboursement`) REFERENCES `remboursement` (`idremboursement`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `telephone`
--
ALTER TABLE `telephone`
  ADD CONSTRAINT `fk_telephone_types_informations` FOREIGN KEY (`id_type_telephone`) REFERENCES `types_informations` (`idtypes_informations`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_telephone_user` FOREIGN KEY (`id_proprietaire`) REFERENCES `user` (`iduser`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `transaction`
--
ALTER TABLE `transaction`
  ADD CONSTRAINT `transaction_ibfk_2` FOREIGN KEY (`compte_donneur_id`) REFERENCES `compte` (`idcompte`),
  ADD CONSTRAINT `transaction_ibfk_3` FOREIGN KEY (`compte_beneficiare_id`) REFERENCES `compte` (`idcompte`),
  ADD CONSTRAINT `transaction_ibfk_4` FOREIGN KEY (`employer_id`) REFERENCES `employe` (`idemploye`);

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `fk_user_type_user` FOREIGN KEY (`id_type_user`) REFERENCES `type_user` (`idtype_user`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
