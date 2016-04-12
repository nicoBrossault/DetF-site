-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Mar 12 Avril 2016 à 16:28
-- Version du serveur :  10.1.9-MariaDB
-- Version de PHP :  5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `dfdatabase`
--

-- --------------------------------------------------------

--
-- Structure de la table `abonne`
--

CREATE TABLE `abonne` (
  `idAbonne` int(6) NOT NULL,
  `nom` text NOT NULL,
  `prenom` text NOT NULL,
  `mail` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `articlerubrique`
--

CREATE TABLE `articlerubrique` (
  `idArticleRubrique` int(3) NOT NULL,
  `idRubrique` int(3) DEFAULT NULL,
  `titre` varchar(256) DEFAULT NULL,
  `textRubrique` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `articlerubrique`
--

INSERT INTO `articlerubrique` (`idArticleRubrique`, `idRubrique`, `titre`, `textRubrique`) VALUES
(1, 1, 'Un nouveau type de laine', '<p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.</p> \r\n<p>Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem.</p>');

-- --------------------------------------------------------

--
-- Structure de la table `images`
--

CREATE TABLE `images` (
  `idImages` int(3) NOT NULL,
  `idRubrique` int(3) DEFAULT NULL,
  `idArticleRubrique` int(3) DEFAULT NULL,
  `idTextSite` int(3) DEFAULT NULL,
  `titre` text NOT NULL,
  `description` text,
  `url` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `images`
--

INSERT INTO `images` (`idImages`, `idRubrique`, `idArticleRubrique`, `idTextSite`, `titre`, `description`, `url`) VALUES
(1, NULL, NULL, 4, 'philadar', 'logo phildar', 'images/marques/phildar.png'),
(2, NULL, NULL, 4, 'katia', 'logo de katia', 'images/marques/katia.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `newsletter`
--

CREATE TABLE `newsletter` (
  `idNewsletter` int(6) NOT NULL,
  `idUser` int(3) DEFAULT NULL,
  `titre` text NOT NULL,
  `texte` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `recevoir`
--

CREATE TABLE `recevoir` (
  `idNewsletter` int(6) NOT NULL,
  `idAbonne` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `rubrique`
--

CREATE TABLE `rubrique` (
  `idRubrique` int(3) NOT NULL,
  `idUser` int(3) DEFAULT NULL,
  `nomRubrique` text NOT NULL,
  `descriptionRubrique` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `rubrique`
--

INSERT INTO `rubrique` (`idRubrique`, `idUser`, `nomRubrique`, `descriptionRubrique`) VALUES
(1, 1, 'Laine', '<p>"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum."</p>');

-- --------------------------------------------------------

--
-- Structure de la table `textsite`
--

CREATE TABLE `textsite` (
  `idTextSite` int(3) NOT NULL,
  `idUser` int(3) DEFAULT NULL,
  `titreTextSite` text NOT NULL,
  `textSite` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `textsite`
--

INSERT INTO `textsite` (`idTextSite`, `idUser`, `titreTextSite`, `textSite`) VALUES
(1, 1, 'Accueil', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.'),
(2, 1, 'Horaire', '<p>Pour la saison estivale, nos horaires d''ouverture sont :</p>\r\n<p>Du lundi au vendredi : </p>\r\n<p>8h00 - 12h00</p>\r\n<p>14h00 - 18h30</p>\r\n<p>Le samedi : </p>\r\n<p>8h00 - 12h00</p>'),
(3, 1, 'Inscription à la newletter', '<p>Vous voulez avoir les dernière nouvelles, les promotions ou encore des informations sur nos arrivages en premier ?</p>\r\n<p>Alors n''attenez plus, inscrivez vous à notre newletter !</p>'),
(4, 1, 'footerAccueil', '<p>Toutes les images ormis celle citant des marques bien définies, appartiennent à la boutique <i> Douceur & Fantaisie</i>.</p>\r\n<p> Aucune reproduction complète ou partielle du site n''est envisageable</p>\r\n<p> Site développée par Nicolas Brossault à l''aide du framework <a href="https://www.codeigniter.com/" target="_blank"><i>CodeIgniter</i></a> et le framework <a href="http://materializecss.com/" target="_blank"><i>Materialize</i></a></p>\r\n');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `idUser` int(3) NOT NULL,
  `nom` text NOT NULL,
  `prenom` text NOT NULL,
  `mail` text NOT NULL,
  `mdp` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `user`
--

INSERT INTO `user` (`idUser`, `nom`, `prenom`, `mail`, `mdp`) VALUES
(1, 'admin', 'admin', 'ni.brossault@laposte.net', 'admin123!!');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `abonne`
--
ALTER TABLE `abonne`
  ADD PRIMARY KEY (`idAbonne`);

--
-- Index pour la table `articlerubrique`
--
ALTER TABLE `articlerubrique`
  ADD PRIMARY KEY (`idArticleRubrique`),
  ADD KEY `fk_associer` (`idRubrique`);

--
-- Index pour la table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`idImages`),
  ADD KEY `fk_afficher` (`idArticleRubrique`),
  ADD KEY `fk_decorer` (`idTextSite`),
  ADD KEY `fk_illustrer` (`idRubrique`);

--
-- Index pour la table `newsletter`
--
ALTER TABLE `newsletter`
  ADD PRIMARY KEY (`idNewsletter`),
  ADD KEY `fk_envoyer` (`idUser`);

--
-- Index pour la table `recevoir`
--
ALTER TABLE `recevoir`
  ADD PRIMARY KEY (`idNewsletter`,`idAbonne`),
  ADD KEY `fk_recevoir2` (`idAbonne`);

--
-- Index pour la table `rubrique`
--
ALTER TABLE `rubrique`
  ADD PRIMARY KEY (`idRubrique`),
  ADD KEY `fk_posseder` (`idUser`);

--
-- Index pour la table `textsite`
--
ALTER TABLE `textsite`
  ADD PRIMARY KEY (`idTextSite`),
  ADD KEY `fk_ecrire` (`idUser`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`idUser`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `abonne`
--
ALTER TABLE `abonne`
  MODIFY `idAbonne` int(6) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `articlerubrique`
--
ALTER TABLE `articlerubrique`
  MODIFY `idArticleRubrique` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `images`
--
ALTER TABLE `images`
  MODIFY `idImages` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `newsletter`
--
ALTER TABLE `newsletter`
  MODIFY `idNewsletter` int(6) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `rubrique`
--
ALTER TABLE `rubrique`
  MODIFY `idRubrique` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `textsite`
--
ALTER TABLE `textsite`
  MODIFY `idTextSite` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `idUser` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `articlerubrique`
--
ALTER TABLE `articlerubrique`
  ADD CONSTRAINT `fk_associer` FOREIGN KEY (`idRubrique`) REFERENCES `rubrique` (`idRubrique`);

--
-- Contraintes pour la table `images`
--
ALTER TABLE `images`
  ADD CONSTRAINT `fk_afficher` FOREIGN KEY (`idArticleRubrique`) REFERENCES `articlerubrique` (`idArticleRubrique`),
  ADD CONSTRAINT `fk_decorer` FOREIGN KEY (`idTextSite`) REFERENCES `textsite` (`idTextSite`),
  ADD CONSTRAINT `fk_illustrer` FOREIGN KEY (`idRubrique`) REFERENCES `rubrique` (`idRubrique`);

--
-- Contraintes pour la table `newsletter`
--
ALTER TABLE `newsletter`
  ADD CONSTRAINT `fk_envoyer` FOREIGN KEY (`idUser`) REFERENCES `user` (`idUser`);

--
-- Contraintes pour la table `recevoir`
--
ALTER TABLE `recevoir`
  ADD CONSTRAINT `fk_recevoir` FOREIGN KEY (`idNewsletter`) REFERENCES `newsletter` (`idNewsletter`),
  ADD CONSTRAINT `fk_recevoir2` FOREIGN KEY (`idAbonne`) REFERENCES `abonne` (`idAbonne`);

--
-- Contraintes pour la table `rubrique`
--
ALTER TABLE `rubrique`
  ADD CONSTRAINT `fk_posseder` FOREIGN KEY (`idUser`) REFERENCES `user` (`idUser`);

--
-- Contraintes pour la table `textsite`
--
ALTER TABLE `textsite`
  ADD CONSTRAINT `fk_ecrire` FOREIGN KEY (`idUser`) REFERENCES `user` (`idUser`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
