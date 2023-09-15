-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : mer. 17 nov. 2021 à 00:13
-- Version du serveur :  10.4.18-MariaDB
-- Version de PHP : 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `chat`
--

-- --------------------------------------------------------

--
-- Structure de la table `chatmessage`
--

CREATE TABLE `chatmessage` (
  `id` int(11) NOT NULL,
  `chatmsg` longtext NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_receive` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `files` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `chatmessage`
--

INSERT INTO `chatmessage` (`id`, `chatmsg`, `id_user`, `id_receive`, `date`, `files`) VALUES
(14, 'Salam', 157, 158, '2021-11-16 19:19:01', ''),
(15, 'malek bantili m3asseb', 157, 158, '2021-11-16 19:23:56', ''),
(16, 'coucou', 157, 156, '2021-11-16 19:59:50', ''),
(17, 'Malek', 158, 157, '2021-11-16 20:15:54', '');

-- --------------------------------------------------------

--
-- Structure de la table `following`
--

CREATE TABLE `following` (
  `id` int(11) NOT NULL,
  `follower` int(11) NOT NULL,
  `isfollowing` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `following`
--

INSERT INTO `following` (`id`, `follower`, `isfollowing`) VALUES
(264, 157, 158);

-- --------------------------------------------------------

--
-- Structure de la table `images`
--

CREATE TABLE `images` (
  `id` int(11) NOT NULL,
  `images` varchar(500) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `images`
--

INSERT INTO `images` (`id`, `images`, `id_user`) VALUES
(5, 'images/DSC_27762.jpg', 156),
(6, 'images/IMG_20191229_020502_262.jpg', 157),
(7, 'images/IMG_20200227_181010_968.jpg', 158);

-- --------------------------------------------------------

--
-- Structure de la table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `message` text NOT NULL,
  `id_user` int(11) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `messages`
--

INSERT INTO `messages` (`id`, `message`, `id_user`, `date`) VALUES
(1, 'Welcome to our platforme', 157, '2021-11-09 14:20:25'),
(17, 'Kifach ??', 157, '2021-11-16 18:18:50'),
(18, 'Mabqach ', 156, '2021-11-16 18:19:20');

-- --------------------------------------------------------

--
-- Structure de la table `register`
--

CREATE TABLE `register` (
  `id` int(11) NOT NULL,
  `email` varchar(200) NOT NULL,
  `firstname` varchar(200) NOT NULL,
  `lastname` varchar(200) NOT NULL,
  `telephone` varchar(50) NOT NULL,
  `password` varchar(200) NOT NULL,
  `sex` varchar(200) NOT NULL,
  `status` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `register`
--

INSERT INTO `register` (`id`, `email`, `firstname`, `lastname`, `telephone`, `password`, `sex`, `status`) VALUES
(156, 'aymane.chnaif@gmail.com', 'Aymane', 'Chnaif', '+212644776612', '25f9e794323b453885f5181f1b624d0b', 'ï†ƒ Man', 1637107067),
(157, 'a.chnaif2010@gmail.com', 'Aimane', 'Chnaif', '+212644776612', '25f9e794323b453885f5181f1b624d0b', 'ï†ƒ Man', 1637108044),
(158, 'aymane@gmail.com', 'Houssine', 'Hahowa', '+212644776612', '25f9e794323b453885f5181f1b624d0b', 'ï†ƒ Man', 1637096610);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `chatmessage`
--
ALTER TABLE `chatmessage`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `following`
--
ALTER TABLE `following`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `images` (`id_user`);

--
-- Index pour la table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `register`
--
ALTER TABLE `register`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `chatmessage`
--
ALTER TABLE `chatmessage`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT pour la table `following`
--
ALTER TABLE `following`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=265;

--
-- AUTO_INCREMENT pour la table `images`
--
ALTER TABLE `images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT pour la table `register`
--
ALTER TABLE `register`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=159;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `images`
--
ALTER TABLE `images`
  ADD CONSTRAINT `images` FOREIGN KEY (`id_user`) REFERENCES `register` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
