-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 04, 2018 at 04:12 PM
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
  `idcarte` int(11) NOT NULL,
  `id_compte` int(11) NOT NULL,
  `code_secret` int(4) NOT NULL,
  `date_fabrication` date NOT NULL,
  `date_mise_en_circulation` date NOT NULL,
  `type_carte` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `client`
--

CREATE TABLE `client` (
  `idclient` int(11) NOT NULL,
  `nom_client` varchar(45) NOT NULL,
  `prenom_client` varchar(45) NOT NULL,
  `naissance_client` int(11) NOT NULL,
  `nif_client` int(10) NOT NULL,
  `cin_client` int(10) NOT NULL,
  `sexe_client` varchar(7) NOT NULL,
  `civilite_client` varchar(11) NOT NULL,
  `date_creation` datetime NOT NULL,
  `date_mise_a_jour` datetime NOT NULL,
  `id_user_client` int(11) NOT NULL,
  `type_user_client_id` int(11) NOT NULL,
  `id_succursale` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  `date_creation` datetime NOT NULL,
  `id_employe` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `credit`
--

CREATE TABLE `credit` (
  `idcredit` int(10) UNSIGNED NOT NULL,
  `idcompte` int(11) DEFAULT NULL,
  `idremboursement` int(11) DEFAULT NULL,
  `id_type_credit` int(11) DEFAULT NULL,
  `montant_emprunt` double DEFAULT NULL,
  `interet` double DEFAULT NULL,
  `date_creation` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `email`
--

CREATE TABLE `email` (
  `idemail` int(11) NOT NULL,
  `nom_proprietaire_id` int(11) DEFAULT NULL,
  `date_creation` datetime DEFAULT NULL,
  `date_mise_a_jour` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `employe`
--

CREATE TABLE `employe` (
  `idemploye` int(11) NOT NULL,
  `nom_emp` varchar(45) NOT NULL,
  `prenom_emp` varchar(45) NOT NULL,
  `sexe_emp` varchar(7) NOT NULL,
  `civilite_emp` varchar(6) NOT NULL,
  `nif_emp` int(10) NOT NULL,
  `cin_emp` int(15) DEFAULT NULL,
  `user_emp_id` int(11) NOT NULL,
  `type_user_id` int(11) NOT NULL,
  `date_creation` datetime NOT NULL,
  `date_mise_a_jour` datetime DEFAULT NULL,
  `id_succursale` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `employe_fonction`
--

CREATE TABLE `employe_fonction` (
  `idemploye_fonction` int(11) NOT NULL,
  `emp_fonc_id` int(11) DEFAULT NULL,
  `fonction_id` int(11) DEFAULT NULL,
  `date_creation` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
(3, 'SECRETAIRE GENERAL', 'SECRETAIRE GENERAL', 57500);

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
(7, 1, '192.168.1.12', '2018-03-04 15:10:13');

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
-- Table structure for table `resiliation`
--

CREATE TABLE `resiliation` (
  `idresiliation` int(11) NOT NULL,
  `compte_id` int(11) NOT NULL,
  `proprietaire_id` int(11) NOT NULL,
  `type_proprietaire_id` int(11) NOT NULL,
  `date_creation` datetime NOT NULL
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

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE `transaction` (
  `idtransaction` int(11) NOT NULL,
  `type_transaction_id` int(11) DEFAULT NULL,
  `montant_transaction` double NOT NULL,
  `compte_donneur_id` int(9) DEFAULT NULL,
  `compte_beneficiaire_id` int(9) DEFAULT NULL,
  `information_textuelle` varchar(255) DEFAULT NULL,
  `message_communication` longtext,
  `date_creation` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `types_informations`
--

CREATE TABLE `types_informations` (
  `idtypes_informations` int(11) NOT NULL,
  `description_type_infos` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `type_carte`
--

CREATE TABLE `type_carte` (
  `description_type_carte` varchar(45) DEFAULT NULL,
  `id_type_carte` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
(1, 1, 'admin', '8cb2237d0679ca88db6464eac60da96345513964', 1, '2018-03-03 04:49:00', '2018-03-03 04:49:00');

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
  ADD UNIQUE KEY `idcarte_UNIQUE` (`idcarte`),
  ADD KEY `fk_carte_compte_idx` (`id_compte`),
  ADD KEY `fk_carte_type_carte_idx` (`type_carte`);

--
-- Indexes for table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`idclient`),
  ADD UNIQUE KEY `id_user_client_UNIQUE` (`id_user_client`),
  ADD UNIQUE KEY `type_user_client_id_UNIQUE` (`type_user_client_id`),
  ADD KEY `fk_client_agence_idx` (`id_succursale`);

--
-- Indexes for table `compte`
--
ALTER TABLE `compte`
  ADD PRIMARY KEY (`idcompte`,`type_compte_id`),
  ADD UNIQUE KEY `idcompte_UNIQUE` (`idcompte`),
  ADD UNIQUE KEY `iban_UNIQUE` (`iban`),
  ADD KEY `fk_compte_employe_idx` (`id_employe`),
  ADD KEY `fk_compte_type_compte_idx` (`type_compte_id`);

--
-- Indexes for table `credit`
--
ALTER TABLE `credit`
  ADD PRIMARY KEY (`idcredit`),
  ADD KEY `fk_credit_compte_idx` (`idcompte`),
  ADD KEY `fk_credit_type_credit_idx` (`id_type_credit`),
  ADD KEY `fk_credit_remboursement_idx` (`idremboursement`);

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
  ADD UNIQUE KEY `type_user_id_UNIQUE` (`type_user_id`),
  ADD UNIQUE KEY `user_emp_id_UNIQUE` (`user_emp_id`),
  ADD KEY `fk_employe_info_agence_info_idx` (`id_succursale`);

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
-- Indexes for table `resiliation`
--
ALTER TABLE `resiliation`
  ADD PRIMARY KEY (`idresiliation`),
  ADD UNIQUE KEY `idresiliation_UNIQUE` (`idresiliation`),
  ADD KEY `fk_resiliation_proprietaire_idx` (`proprietaire_id`),
  ADD KEY `fk_resiliation_compte_idx` (`compte_id`);

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
  ADD UNIQUE KEY `idtransaction_UNIQUE` (`idtransaction`),
  ADD KEY `fk_transaction_type_transaction_idx` (`type_transaction_id`),
  ADD KEY `fk_transaction_compte_idx` (`compte_donneur_id`),
  ADD KEY `fk_transaction_beneficiare_compte_idx` (`compte_beneficiaire_id`);

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
  MODIFY `idadresse` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `agence`
--
ALTER TABLE `agence`
  MODIFY `idagence` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `carte`
--
ALTER TABLE `carte`
  MODIFY `idcarte` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `client`
--
ALTER TABLE `client`
  MODIFY `idclient` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `credit`
--
ALTER TABLE `credit`
  MODIFY `idcredit` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `email`
--
ALTER TABLE `email`
  MODIFY `idemail` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `employe`
--
ALTER TABLE `employe`
  MODIFY `idemploye` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `employe_fonction`
--
ALTER TABLE `employe_fonction`
  MODIFY `idemploye_fonction` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `fonction`
--
ALTER TABLE `fonction`
  MODIFY `idfonction` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `login_hystoric`
--
ALTER TABLE `login_hystoric`
  MODIFY `id_login` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `remboursement`
--
ALTER TABLE `remboursement`
  MODIFY `idremboursement` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `resiliation`
--
ALTER TABLE `resiliation`
  MODIFY `idresiliation` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tarif`
--
ALTER TABLE `tarif`
  MODIFY `idtarif` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `telephone`
--
ALTER TABLE `telephone`
  MODIFY `idtelephone` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `idtransaction` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `types_informations`
--
ALTER TABLE `types_informations`
  MODIFY `idtypes_informations` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `type_carte`
--
ALTER TABLE `type_carte`
  MODIFY `id_type_carte` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `type_compte`
--
ALTER TABLE `type_compte`
  MODIFY `idtype_compte` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `type_credit`
--
ALTER TABLE `type_credit`
  MODIFY `idtype_credit` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `type_transcation`
--
ALTER TABLE `type_transcation`
  MODIFY `idtype_transcation` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `type_user`
--
ALTER TABLE `type_user`
  MODIFY `idtype_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `iduser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
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
  ADD CONSTRAINT `fk_carte_compte` FOREIGN KEY (`id_compte`) REFERENCES `compte` (`idcompte`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_carte_type_carte` FOREIGN KEY (`type_carte`) REFERENCES `type_carte` (`id_type_carte`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `client`
--
ALTER TABLE `client`
  ADD CONSTRAINT `fk_client_agence` FOREIGN KEY (`id_succursale`) REFERENCES `agence` (`idagence`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_client_type_user` FOREIGN KEY (`id_user_client`) REFERENCES `type_user` (`idtype_user`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `compte`
--
ALTER TABLE `compte`
  ADD CONSTRAINT `fk_compte_employe` FOREIGN KEY (`id_employe`) REFERENCES `employe` (`idemploye`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_compte_type_compte` FOREIGN KEY (`type_compte_id`) REFERENCES `type_compte` (`idtype_compte`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `credit`
--
ALTER TABLE `credit`
  ADD CONSTRAINT `fk_credit_compte` FOREIGN KEY (`idcompte`) REFERENCES `compte` (`idcompte`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_credit_remboursement` FOREIGN KEY (`idremboursement`) REFERENCES `remboursement` (`idremboursement`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_credit_type_credit` FOREIGN KEY (`id_type_credit`) REFERENCES `type_credit` (`idtype_credit`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `email`
--
ALTER TABLE `email`
  ADD CONSTRAINT `fk_email_user` FOREIGN KEY (`nom_proprietaire_id`) REFERENCES `user` (`iduser`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `employe`
--
ALTER TABLE `employe`
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
-- Constraints for table `resiliation`
--
ALTER TABLE `resiliation`
  ADD CONSTRAINT `fk_resiliation_client` FOREIGN KEY (`proprietaire_id`) REFERENCES `client` (`idclient`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_resiliation_compte` FOREIGN KEY (`compte_id`) REFERENCES `compte` (`idcompte`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_resiliation_employe` FOREIGN KEY (`proprietaire_id`) REFERENCES `employe` (`idemploye`) ON DELETE NO ACTION ON UPDATE NO ACTION;

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
  ADD CONSTRAINT `fk_transaction_beneficiare_compte` FOREIGN KEY (`compte_beneficiaire_id`) REFERENCES `compte` (`idcompte`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_transaction_donneur_compte` FOREIGN KEY (`compte_donneur_id`) REFERENCES `compte` (`idcompte`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_transaction_type_transaction` FOREIGN KEY (`type_transaction_id`) REFERENCES `type_transcation` (`idtype_transcation`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `fk_user_type_user` FOREIGN KEY (`id_type_user`) REFERENCES `type_user` (`idtype_user`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
