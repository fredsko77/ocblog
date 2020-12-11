-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  mer. 09 déc. 2020 à 17:24
-- Version du serveur :  10.3.16-MariaDB
-- Version de PHP :  7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `ocblog`
--

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `category` varchar(100) NOT NULL,
  `slug` varchar(100) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `categories`
--

INSERT INTO `categories` (`id`, `category`, `slug`, `description`) VALUES
(1, 'Divers', 'divers', 'Catégorie par défaut'),
(2, 'Développement', 'developpemnt', 'Développement'),
(3, 'Actus', 'actus', 'Actualités'),
(4, 'Trucs et astuces', 'trucs-et-astuces', 'Trucs et astuces');

-- --------------------------------------------------------

--
-- Structure de la table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `author` varchar(60) DEFAULT NULL,
  `comment` varchar(255) NOT NULL,
  `status` varchar(60) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `post_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `contacts`
--

CREATE TABLE `contacts` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `subject` text NOT NULL,
  `message` text NOT NULL,
  `status` varchar(20) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `writer` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `content` longtext DEFAULT NULL,
  `image` varchar(11) DEFAULT NULL,
  `slug` varchar(80) DEFAULT NULL,
  `chapo` text DEFAULT NULL,
  `status` varchar(60) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `posts`
--

INSERT INTO `posts` (`id`, `category_id`, `writer`, `title`, `content`, `image`, `slug`, `chapo`, `status`, `updated_at`, `created_at`) VALUES
(1, 1, '1', 'My second post', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptates assumenda, neque quam excepturi eum sequi perspiciatis ipsum at fugit modi atque eius quidem provident. Consequuntur consectetur cum eaque in rem iure ipsam repudiandae reiciendis quasi omnis eveniet obcaecati nostrum itaque eius error assumenda dolorem officia ipsa, quaerat exercitationem aspernatur saepe recusandae commodi. Eligendi doloremque similique tempora magnam cumque incidunt id hic, enim vel maiores consectetur earum in soluta vitae voluptas dolores. Ipsam doloribus ad nostrum officiis eaque itaque ab soluta ut cumque consequuntur natus provident est illum expedita accusamus exercitationem cum, temporibus excepturi deserunt atque. Consectetur corporis beatae recusandae modi.\r\nLorem ipsum dolor sit amet consectetur adipisicing elit. Vel ex voluptate, saepe neque totam, dolor, dolorem minima sit esse qui asperiores consequatur eos. Beatae, sapiente architecto esse nulla quia explicabo omnis ullam quam enim commodi accusantium facere aspernatur nam voluptates veniam officiis eum odio dolorem inventore libero? Quidem, commodi sequi cupiditate neque nisi asperiores qui fugit molestias? Dignissimos minima debitis dolore aut qui laboriosam repellat quas enim, nesciunt illum veritatis, architecto dolorem obcaecati possimus ipsum reiciendis illo ducimus ut, aliquam culpa. Eius asperiores totam quis delectus dolore tempora distinctio neque consequatur nam ullam aliquid explicabo recusandae optio, animi ipsam unde?\r\nLorem ipsum dolor sit amet consectetur adipisicing elit. Vitae laboriosam perspiciatis porro ullam. Impedit maxime quas, eaque provident tempore est odit dicta culpa quia facere sunt nihil perspiciatis vero placeat ut dolor autem incidunt facilis cupiditate repudiandae voluptatibus officiis? Commodi, maiores ipsam. Libero facere quaerat assumenda commodi ea nemo accusamus quos atque asperiores eum illo modi, exercitationem eius distinctio quidem placeat. Libero dolorem provident cumque pariatur est? Quas, minima animi doloribus laudantium labore vitae reiciendis illo fuga nesciunt corrupti vel necessitatibus adipisci praesentium blanditiis tempore consequuntur voluptatem facilis ab magni tempora cumque. Aliquam harum fugit, maiores at obcaecati autem hic!', '', 'my-second-post', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cum dicta iusto doloremque magni est officiis adipisci sunt nostrum ipsum voluptates?', 'published', '2020-11-12 15:11:29', '2020-10-31 11:13:31'),
(2, 1, '1', 'le cheval c\'est trop génial', '<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Veniam ratione molestias eligendi amet aspernatur, nihil numquam quisquam autem similique tempore odit alias et illo dolorum tempora laudantium facilis! Facere, deleniti unde voluptatum praesentium illum cupiditate? Lorem ipsum dolor sit amet consectetur adipisicing elit. Veniam ratione molestias eligendi amet aspernatur, nihil numquam quisquam autem similique tempore odit alias et illo dolorum tempora laudantium facilis! Facere, deleniti unde voluptatum praesentium illum cupiditate? &nbsp;</p>', '', 'le-cheval-c-est-trop-genial', '', 'draft', '2020-12-09 11:12:12', '2020-12-09 11:12:12'),
(3, 1, '1', 'le cheval c\'est trop génial', '<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Veniam ratione molestias eligendi amet aspernatur, nihil numquam quisquam autem similique tempore odit alias et illo dolorum tempora laudantium facilis! Facere, deleniti unde voluptatum praesentium illum cupiditate? Lorem ipsum dolor sit amet consectetur adipisicing elit. Veniam ratione molestias eligendi amet aspernatur, nihil numquam quisquam autem similique tempore odit alias et illo dolorum tempora laudantium facilis! Facere, deleniti unde voluptatum praesentium illum cupiditate? &nbsp;</p>', '', 'le-cheval-c-est-trop-genial', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Veniam ratione molestias eligendi amet aspernatur, nihil numquam quisquam autem similique tempore odit alias et illo dolorum tempora laudantium facilis! Facere, deleniti unde voluptatum praesentium illum cupiditate? ', 'published', '2020-12-09 17:12:14', '2020-12-09 11:12:49');

-- --------------------------------------------------------

--
-- Structure de la table `uploads`
--

CREATE TABLE `uploads` (
  `id` int(11) NOT NULL,
  `path` varchar(100) DEFAULT NULL,
  `type` varchar(60) DEFAULT NULL,
  `created_at` varchar(60) DEFAULT NULL,
  `users_id` int(11) NOT NULL,
  `posts_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `pseudo` varchar(60) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `chapo` text DEFAULT NULL,
  `position` varchar(255) DEFAULT NULL,
  `image` int(11) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `confirm` varchar(20) DEFAULT NULL,
  `token` varchar(255) DEFAULT NULL,
  `role` varchar(60) NOT NULL,
  `last_connection` datetime DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `gender`, `firstname`, `lastname`, `pseudo`, `email`, `chapo`, `position`, `image`, `password`, `slug`, `confirm`, `token`, `role`, `last_connection`, `created_at`) VALUES
(1, 'mr', 'Admin', 'User', 'admin123', 'admin@mail.com', '', 'Développeur d&apos;application Web PHP/Symfony', 26, '$argon2i$v=19$m=1024,t=2,p=2$dWlTVEJnTTRzU0F4Ukxuaw$knW2MKa8Xe2haRjawX861ZllJ6ghSEvL5Go/Me60m68', 'admin-user', '1', 'GJglKLRrL3UzHVIjN5089TisXqp4DxOdcy7fZaePbwohvBFC1u62MWYntQASkE202012107150544725723', 'admin', '2020-12-07 15:44:05', '2020-12-02 17:25:01');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Index pour la table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `post_id` (`post_id`);

--
-- Index pour la table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `uploads`
--
ALTER TABLE `uploads`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT pour la table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT pour la table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT pour la table `uploads`
--
ALTER TABLE `uploads`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;