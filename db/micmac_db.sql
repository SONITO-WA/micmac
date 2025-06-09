-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 23, 2025 at 12:28 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `micmac_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`) VALUES
(1, 'admin', '240be518fabd2724ddb6f04eeb1da5967448d7e831c08c8fa822809f74c720a9');

-- --------------------------------------------------------

--
-- Table structure for table `commandes`
--

CREATE TABLE `commandes` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `prix` decimal(10,2) NOT NULL,
  `quantite` int(11) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `date_commande` datetime NOT NULL,
  `pdf` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `commandes`
--

INSERT INTO `commandes` (`id`, `nom`, `prix`, `quantite`, `image`, `date_commande`, `pdf`) VALUES
(1, 'Asus 16', 42197.00, 1, '1747767550_Screenshot 2025-05-20 195806.png', '2025-05-20 20:01:55', NULL),
(2, 'Dahua Camera de surveillance', 179.00, 2, '1747764864_Screenshot 2025-05-20 191319.png', '2025-05-20 19:53:04', NULL),
(3, 'Dahua Camera de surveillance', 179.00, 1, '1747764864_Screenshot 2025-05-20 191319.png', '2025-05-21 17:13:14', 'commande_1747843994.pdf'),
(4, 'Dahua Camera de surveillance', 179.00, 1, '1747764864_Screenshot 2025-05-20 191319.png', '2025-05-21 19:12:02', 'commande_1747851122.pdf'),
(5, 'Dahua Camera de surveillance', 179.00, 1, '1747764864_Screenshot 2025-05-20 191319.png', '2025-05-21 19:26:55', 'commande_1747852014.pdf'),
(6, 'Dahua Camera de surveillance', 179.00, 1, '1747764864_Screenshot 2025-05-20 191319.png', '2025-05-21 19:33:29', 'commande_1747852409.pdf'),
(7, 'Dahua Camera de surveillance', 179.00, 1, '1747764864_Screenshot 2025-05-20 191319.png', '2025-05-21 19:36:00', 'commande_1747852560.pdf'),
(8, 'Dahua Camera de surveillance', 179.00, 1, '1747764864_Screenshot 2025-05-20 191319.png', '2025-05-21 19:40:05', 'commande_1747852805.pdf'),
(9, 'Asus 16', 42197.00, 1, '1747767550_Screenshot 2025-05-20 195806.png', '2025-05-23 09:39:44', 'commande_1747989584.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `messages_contact`
--

CREATE TABLE `messages_contact` (
  `id` int(11) NOT NULL,
  `nom_prenom` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `telephone` varchar(20) NOT NULL,
  `sujet` varchar(150) NOT NULL,
  `message` text NOT NULL,
  `date_envoi` timestamp NOT NULL DEFAULT current_timestamp(),
  `statut` enum('traité','non traité') NOT NULL DEFAULT 'non traité'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `messages_contact`
--

INSERT INTO `messages_contact` (`id`, `nom_prenom`, `email`, `telephone`, `sujet`, `message`, `date_envoi`, `statut`) VALUES
(1, 'lina abdellaoui', 'linaa@gmail.com', '098765', 'jsp', 'test', '2025-05-09 22:52:30', 'non traité'),
(2, 'mokhtar', 'mokhtar@gmail.com', 'zsdfyui', 'dfghj', 'qsdfghj', '2025-05-09 23:43:42', 'traité'),
(3, 'oualid', 'azertyuiop@azertyuiop', '1234567', 'tezst eawd ', 'salam', '2025-05-23 08:38:57', 'non traité');

-- --------------------------------------------------------

--
-- Table structure for table `produits`
--

CREATE TABLE `produits` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `prix` decimal(10,2) NOT NULL,
  `garantie` varchar(100) DEFAULT NULL,
  `categorie` varchar(100) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `date_ajout` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `produits`
--

INSERT INTO `produits` (`id`, `nom`, `description`, `prix`, `garantie`, `categorie`, `image`, `date_ajout`) VALUES
(1, 'Dahua Camera de surveillance', 'Bullet 2MP HDCVI 2.8mm', 179.00, NULL, 'Cameras', '1747764864_Screenshot 2025-05-20 191319.png', '2025-05-20 19:14:24'),
(2, 'Asus 16', '- rog g614jir i9-14900hx - 1 To - RAM 32GB - Windows 11 - Noir', 42197.00, NULL, 'Ordinateurs', '1747767550_Screenshot 2025-05-20 195806.png', '2025-05-20 19:59:10'),
(3, 'Nia Originale Casque bluetooth', ' Q1 Appel-lecteur Micro SD / TF-radio FM', 86.00, NULL, 'Accessoires', '1747989759_Screenshot 2025-05-23 094226.png', '2025-05-23 09:42:39');

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `id` int(11) NOT NULL,
  `niveau` enum('facile','moyen','expert') NOT NULL,
  `question` text NOT NULL,
  `reponse1` varchar(255) DEFAULT NULL,
  `reponse2` varchar(255) DEFAULT NULL,
  `reponse3` varchar(255) DEFAULT NULL,
  `reponse4` varchar(255) DEFAULT NULL,
  `bonne_reponse` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id`, `niveau`, `question`, `reponse1`, `reponse2`, `reponse3`, `reponse4`, `bonne_reponse`) VALUES
(1, 'facile', 'Quel composant est le cerveau de l’ordinateur ?', 'Disque dur', 'RAM', 'Processeur', 'Carte graphique', 3),
(2, 'facile', 'Quel périphérique sert à saisir du texte ?', 'Souris', 'Clavier', 'Écran', 'Micro', 2),
(3, 'facile', 'Quel système d’exploitation est développé par Microsoft ?', 'Linux', 'macOS', 'Windows', 'Ubuntu', 3),
(4, 'moyen', 'Qu’est-ce qu’un routeur ?', 'Un périphérique d’impression', 'Un commutateur réseau', 'Un appareil réseau qui dirige le trafic', 'Un outil de design', 3),
(5, 'moyen', 'Quel protocole est utilisé pour sécuriser les sites web ?', 'FTP', 'SSH', 'HTTP', 'HTTPS', 4),
(6, 'expert', 'Quel port utilise HTTPS ?', '21', '443', '80', '22', 2),
(7, 'expert', 'Quel langage est principalement utilisé côté serveur ?', 'HTML', 'CSS', 'PHP', 'SQL', 3),
(8, 'expert', 'Qu’est-ce qu’un pare-feu ?', 'Un antivirus', 'Une barrière physique', 'Un outil réseau de filtrage', 'Une app de messagerie', 3),
(9, 'expert', 'Quelle commande Linux permet de voir les fichiers ?', 'ls', 'cd', 'rm', 'ping', 1),
(10, 'facile', 'Question 1 niveau facile ?', 'Réponse A1', 'Réponse B1', 'Réponse C1', 'Réponse D1', 1),
(11, 'facile', 'Question 2 niveau facile ?', 'Réponse A2', 'Réponse B2', 'Réponse C2', 'Réponse D2', 2),
(12, 'facile', 'Question 3 niveau facile ?', 'Réponse A3', 'Réponse B3', 'Réponse C3', 'Réponse D3', 3),
(13, 'facile', 'Question 4 niveau facile ?', 'Réponse A4', 'Réponse B4', 'Réponse C4', 'Réponse D4', 4),
(14, 'facile', 'Question 5 niveau facile ?', 'Réponse A5', 'Réponse B5', 'Réponse C5', 'Réponse D5', 1),
(15, 'facile', 'Question 6 niveau facile ?', 'Réponse A6', 'Réponse B6', 'Réponse C6', 'Réponse D6', 2),
(16, 'facile', 'Question 7 niveau facile ?', 'Réponse A7', 'Réponse B7', 'Réponse C7', 'Réponse D7', 3),
(17, 'facile', 'Question 8 niveau facile ?', 'Réponse A8', 'Réponse B8', 'Réponse C8', 'Réponse D8', 4),
(18, 'facile', 'Question 9 niveau facile ?', 'Réponse A9', 'Réponse B9', 'Réponse C9', 'Réponse D9', 1),
(19, 'facile', 'Question 10 niveau facile ?', 'Réponse A10', 'Réponse B10', 'Réponse C10', 'Réponse D10', 2),
(20, 'facile', 'Question 11 niveau facile ?', 'Réponse A11', 'Réponse B11', 'Réponse C11', 'Réponse D11', 3),
(21, 'facile', 'Question 12 niveau facile ?', 'Réponse A12', 'Réponse B12', 'Réponse C12', 'Réponse D12', 4),
(22, 'facile', 'Question 13 niveau facile ?', 'Réponse A13', 'Réponse B13', 'Réponse C13', 'Réponse D13', 1),
(23, 'facile', 'Question 14 niveau facile ?', 'Réponse A14', 'Réponse B14', 'Réponse C14', 'Réponse D14', 2),
(24, 'facile', 'Question 15 niveau facile ?', 'Réponse A15', 'Réponse B15', 'Réponse C15', 'Réponse D15', 3),
(25, 'facile', 'Question 16 niveau facile ?', 'Réponse A16', 'Réponse B16', 'Réponse C16', 'Réponse D16', 4),
(26, 'facile', 'Question 17 niveau facile ?', 'Réponse A17', 'Réponse B17', 'Réponse C17', 'Réponse D17', 1),
(27, 'facile', 'Question 18 niveau facile ?', 'Réponse A18', 'Réponse B18', 'Réponse C18', 'Réponse D18', 2),
(28, 'facile', 'Question 19 niveau facile ?', 'Réponse A19', 'Réponse B19', 'Réponse C19', 'Réponse D19', 3),
(29, 'facile', 'Question 20 niveau facile ?', 'Réponse A20', 'Réponse B20', 'Réponse C20', 'Réponse D20', 4),
(30, 'facile', 'Question 21 niveau facile ?', 'Réponse A21', 'Réponse B21', 'Réponse C21', 'Réponse D21', 1),
(31, 'facile', 'Question 22 niveau facile ?', 'Réponse A22', 'Réponse B22', 'Réponse C22', 'Réponse D22', 2),
(32, 'facile', 'Question 23 niveau facile ?', 'Réponse A23', 'Réponse B23', 'Réponse C23', 'Réponse D23', 3),
(33, 'facile', 'Question 24 niveau facile ?', 'Réponse A24', 'Réponse B24', 'Réponse C24', 'Réponse D24', 4),
(34, 'facile', 'Question 25 niveau facile ?', 'Réponse A25', 'Réponse B25', 'Réponse C25', 'Réponse D25', 1),
(35, 'moyen', 'Question 26 niveau moyen ?', 'Réponse A26', 'Réponse B26', 'Réponse C26', 'Réponse D26', 2),
(36, 'moyen', 'Question 27 niveau moyen ?', 'Réponse A27', 'Réponse B27', 'Réponse C27', 'Réponse D27', 3),
(37, 'moyen', 'Question 28 niveau moyen ?', 'Réponse A28', 'Réponse B28', 'Réponse C28', 'Réponse D28', 4),
(38, 'moyen', 'Question 29 niveau moyen ?', 'Réponse A29', 'Réponse B29', 'Réponse C29', 'Réponse D29', 1),
(39, 'moyen', 'Question 30 niveau moyen ?', 'Réponse A30', 'Réponse B30', 'Réponse C30', 'Réponse D30', 2),
(40, 'moyen', 'Question 31 niveau moyen ?', 'Réponse A31', 'Réponse B31', 'Réponse C31', 'Réponse D31', 3),
(41, 'moyen', 'Question 32 niveau moyen ?', 'Réponse A32', 'Réponse B32', 'Réponse C32', 'Réponse D32', 4),
(42, 'moyen', 'Question 33 niveau moyen ?', 'Réponse A33', 'Réponse B33', 'Réponse C33', 'Réponse D33', 1),
(43, 'moyen', 'Question 34 niveau moyen ?', 'Réponse A34', 'Réponse B34', 'Réponse C34', 'Réponse D34', 2),
(44, 'moyen', 'Question 35 niveau moyen ?', 'Réponse A35', 'Réponse B35', 'Réponse C35', 'Réponse D35', 3),
(45, 'moyen', 'Question 36 niveau moyen ?', 'Réponse A36', 'Réponse B36', 'Réponse C36', 'Réponse D36', 4),
(46, 'moyen', 'Question 37 niveau moyen ?', 'Réponse A37', 'Réponse B37', 'Réponse C37', 'Réponse D37', 1),
(47, 'moyen', 'Question 38 niveau moyen ?', 'Réponse A38', 'Réponse B38', 'Réponse C38', 'Réponse D38', 2),
(48, 'moyen', 'Question 39 niveau moyen ?', 'Réponse A39', 'Réponse B39', 'Réponse C39', 'Réponse D39', 3),
(49, 'moyen', 'Question 40 niveau moyen ?', 'Réponse A40', 'Réponse B40', 'Réponse C40', 'Réponse D40', 4),
(50, 'moyen', 'Question 41 niveau moyen ?', 'Réponse A41', 'Réponse B41', 'Réponse C41', 'Réponse D41', 1),
(51, 'moyen', 'Question 42 niveau moyen ?', 'Réponse A42', 'Réponse B42', 'Réponse C42', 'Réponse D42', 2),
(52, 'moyen', 'Question 43 niveau moyen ?', 'Réponse A43', 'Réponse B43', 'Réponse C43', 'Réponse D43', 3),
(53, 'moyen', 'Question 44 niveau moyen ?', 'Réponse A44', 'Réponse B44', 'Réponse C44', 'Réponse D44', 4),
(54, 'moyen', 'Question 45 niveau moyen ?', 'Réponse A45', 'Réponse B45', 'Réponse C45', 'Réponse D45', 1),
(55, 'moyen', 'Question 46 niveau moyen ?', 'Réponse A46', 'Réponse B46', 'Réponse C46', 'Réponse D46', 2),
(56, 'moyen', 'Question 47 niveau moyen ?', 'Réponse A47', 'Réponse B47', 'Réponse C47', 'Réponse D47', 3),
(57, 'moyen', 'Question 48 niveau moyen ?', 'Réponse A48', 'Réponse B48', 'Réponse C48', 'Réponse D48', 4),
(58, 'moyen', 'Question 49 niveau moyen ?', 'Réponse A49', 'Réponse B49', 'Réponse C49', 'Réponse D49', 1),
(59, 'moyen', 'Question 50 niveau moyen ?', 'Réponse A50', 'Réponse B50', 'Réponse C50', 'Réponse D50', 2),
(60, 'expert', 'Question 51 niveau expert ?', 'Réponse A51', 'Réponse B51', 'Réponse C51', 'Réponse D51', 3),
(61, 'expert', 'Question 52 niveau expert ?', 'Réponse A52', 'Réponse B52', 'Réponse C52', 'Réponse D52', 4),
(62, 'expert', 'Question 53 niveau expert ?', 'Réponse A53', 'Réponse B53', 'Réponse C53', 'Réponse D53', 1),
(63, 'expert', 'Question 54 niveau expert ?', 'Réponse A54', 'Réponse B54', 'Réponse C54', 'Réponse D54', 2),
(64, 'expert', 'Question 55 niveau expert ?', 'Réponse A55', 'Réponse B55', 'Réponse C55', 'Réponse D55', 3),
(65, 'expert', 'Question 56 niveau expert ?', 'Réponse A56', 'Réponse B56', 'Réponse C56', 'Réponse D56', 4),
(66, 'expert', 'Question 57 niveau expert ?', 'Réponse A57', 'Réponse B57', 'Réponse C57', 'Réponse D57', 1),
(67, 'expert', 'Question 58 niveau expert ?', 'Réponse A58', 'Réponse B58', 'Réponse C58', 'Réponse D58', 2),
(68, 'expert', 'Question 59 niveau expert ?', 'Réponse A59', 'Réponse B59', 'Réponse C59', 'Réponse D59', 3),
(69, 'expert', 'Question 60 niveau expert ?', 'Réponse A60', 'Réponse B60', 'Réponse C60', 'Réponse D60', 4),
(70, 'expert', 'Question 61 niveau expert ?', 'Réponse A61', 'Réponse B61', 'Réponse C61', 'Réponse D61', 1),
(71, 'expert', 'Question 62 niveau expert ?', 'Réponse A62', 'Réponse B62', 'Réponse C62', 'Réponse D62', 2),
(72, 'expert', 'Question 63 niveau expert ?', 'Réponse A63', 'Réponse B63', 'Réponse C63', 'Réponse D63', 3),
(73, 'expert', 'Question 64 niveau expert ?', 'Réponse A64', 'Réponse B64', 'Réponse C64', 'Réponse D64', 4),
(74, 'expert', 'Question 65 niveau expert ?', 'Réponse A65', 'Réponse B65', 'Réponse C65', 'Réponse D65', 1),
(75, 'expert', 'Question 66 niveau expert ?', 'Réponse A66', 'Réponse B66', 'Réponse C66', 'Réponse D66', 2),
(76, 'expert', 'Question 67 niveau expert ?', 'Réponse A67', 'Réponse B67', 'Réponse C67', 'Réponse D67', 3),
(77, 'expert', 'Question 68 niveau expert ?', 'Réponse A68', 'Réponse B68', 'Réponse C68', 'Réponse D68', 4),
(78, 'expert', 'Question 69 niveau expert ?', 'Réponse A69', 'Réponse B69', 'Réponse C69', 'Réponse D69', 1),
(79, 'expert', 'Question 70 niveau expert ?', 'Réponse A70', 'Réponse B70', 'Réponse C70', 'Réponse D70', 2),
(80, 'expert', 'Question 71 niveau expert ?', 'Réponse A71', 'Réponse B71', 'Réponse C71', 'Réponse D71', 3),
(81, 'expert', 'Question 72 niveau expert ?', 'Réponse A72', 'Réponse B72', 'Réponse C72', 'Réponse D72', 4),
(82, 'expert', 'Question 73 niveau expert ?', 'Réponse A73', 'Réponse B73', 'Réponse C73', 'Réponse D73', 1),
(83, 'expert', 'Question 74 niveau expert ?', 'Réponse A74', 'Réponse B74', 'Réponse C74', 'Réponse D74', 2),
(84, 'expert', 'Question 75 niveau expert ?', 'Réponse A75', 'Réponse B75', 'Réponse C75', 'Réponse D75', 3);

-- --------------------------------------------------------

--
-- Table structure for table `scores`
--

CREATE TABLE `scores` (
  `id` int(11) NOT NULL,
  `pseudo` varchar(100) NOT NULL,
  `score` int(11) NOT NULL,
  `niveau` enum('facile','moyen','expert') DEFAULT NULL,
  `date_joue` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `scores`
--

INSERT INTO `scores` (`id`, `pseudo`, `score`, `niveau`, `date_joue`) VALUES
(1, 'MicMacUser', 0, 'moyen', '2025-05-16 01:30:08'),
(2, 'MicMacUser', 0, 'moyen', '2025-05-16 01:39:11'),
(3, 'MicMacUser', 0, 'moyen', '2025-05-16 01:39:13'),
(4, 'amighaatun', 0, 'facile', '2025-05-17 17:34:29'),
(5, 'Linaa abdellaoui', 1, 'facile', '2025-05-17 18:24:15'),
(6, 'Linaa abdellaoui', 0, 'facile', '2025-05-23 09:44:04');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `sexe` varchar(10) DEFAULT NULL,
  `date_naissance` date DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `role` enum('admin','client') DEFAULT 'client'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `created_at`, `sexe`, `date_naissance`, `photo`, `role`) VALUES
(1, 'Linaa abdellaoui', 'linaa@gmail.com', '$2y$10$kptdq.C42EmFjVcMOyPa9u0K9m8DVueA258CME9NumbDIGSiWIYUO', '2025-05-09 19:13:45', NULL, NULL, NULL, 'admin'),
(2, 'amighaatun', 'amighaaaa@gmail.com', '$2y$10$oGq1ngrUJU26/zankSorf.O8HsiGaeT8.VIqSbihlvR2gqcHQgjFq', '2025-05-09 19:41:35', 'Femme', '2005-10-10', '682615fa4ff3c_Be a pirate or die.jpg', 'client'),
(3, 'jayhana', 'jihanee@gmail.com', '$2y$10$An7BZWvMUrzQq4Yk4eBJTuUqagvmJkQtAwB/oZ.qf8QXkhTgudbnC', '2025-05-09 22:33:48', 'Femme', '2006-04-09', '681e83255e68c_jayhana.jpg', 'client'),
(4, 'mokhtar abdellaoui', 'mokhtar@gmail.com', '$2y$10$rYyJxxu.6s0huVtEvaYdgur1oT4T5wsroSwfbURknpZaOUD1f9u7W', '2025-05-09 23:42:28', 'Homme', '2025-06-24', '681e930ba8408_Be a pirate or die.jpg', 'client'),
(5, 'WWWassim', 'wassim@gmail.com', '$2y$10$evUtT0FGl0Z63MD/TUM6.uWyNS6cv7i7ope.FLgpAa9U0cn1EqlYW', '2025-05-10 00:03:56', 'Homme', '2006-04-20', '681e9902a1cbb_Mercedes-AMG GT63___.jpg', 'client');

-- --------------------------------------------------------

--
-- Table structure for table `videos`
--

CREATE TABLE `videos` (
  `id` int(11) NOT NULL,
  `titre` varchar(255) NOT NULL,
  `fichier` varchar(255) NOT NULL,
  `theme` varchar(100) NOT NULL,
  `tags` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `date_ajout` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `videos`
--

INSERT INTO `videos` (`id`, `titre`, `fichier`, `theme`, `tags`, `description`, `date_ajout`) VALUES
(1, 'TP-Link Router Setup and Full Configuration', 'reseau/TP-Link Router Setup and Full Configuration.mp4', 'Réseau', 'tp-link,reseau,configuration', 'Configuration complète d’un routeur TP-Link', '2025-05-17 17:16:30'),
(2, 'Setup TP-Link Wireless Router', 'reseau/How to Setup Your TP-Link Wireless Router _ Step-by-Step Guide.mp4', 'Réseau', 'tp-link,setup,reseau', 'Guide étape par étape pour configurer le routeur Wi-Fi', '2025-05-17 17:16:30'),
(3, 'Setup TP-Link AX1500 WiFi 6', 'reseau/Setup Video _ TP-Link AX1500 WiFi 6 Router Archer AX10.mp4', 'Réseau', 'ax1500,tp-link,ax10', 'Configuration du routeur AX1500 Archer AX10', '2025-05-17 17:16:30'),
(4, 'TP-Link Archer C80', 'reseau/Tutoriel Installation routeur WiFi TP-Link Archer C80.mp4', 'Réseau', 'archer c80,tp-link', 'Installation routeur TP-Link Archer C80', '2025-05-17 17:16:30'),
(5, 'Imprimante sur réseau domestique', 'peripheriques/comment mettre son imprimante sur le réseau domestique.mp4', 'Périphériques', 'imprimante,reseau,domestique', 'Connexion imprimante au réseau domestique', '2025-05-17 17:16:45'),
(6, 'Ajouter imprimante dans réseau', 'peripheriques/Ajouter une imprimante dans le réseau.mp4', 'Périphériques', 'ajouter,imprimante,reseau', 'Ajout manuel d’une imprimante', '2025-05-17 17:16:45'),
(7, 'Configurer HP+ avec Smart', 'peripheriques/Configurer imprimante HP+ sur réseau sans fil avec HP Smart sous Windows.mp4', 'Périphériques', 'hp,smart,wifi', 'Configuration imprimante HP en Wi-Fi', '2025-05-17 17:16:45'),
(8, 'Canon en Wi-Fi', 'peripheriques/Comment connecter une imprimante Canon en WIFI.mp4', 'Périphériques', 'canon,wifi,reseau', 'Connexion Canon sans câble', '2025-05-17 17:16:45'),
(9, 'VPN iOS iPhone 15', 'securite/Tutoriel VPN iOS 2023 _ Comment utiliser un VPN sur iPhone 15 _.mp4', 'Sécurité', 'vpn,iphone,ios', 'Configurer VPN sur iPhone 15', '2025-05-17 17:16:59'),
(10, 'VPN sur routeur TP-Link', 'securite/How to Install a VPN on TP-Link Router.mp4', 'Sécurité', 'vpn,routeur,tp-link', 'Configurer un VPN sur routeur TP-Link', '2025-05-17 17:16:59'),
(11, 'VPN sur Windows 10 et 11', 'securite/Comment installer un VPN sur Windows 10 et 11 _ Le guide détaillé.mp4', 'Sécurité', 'vpn,windows,securite', 'Installation VPN sur PC Windows', '2025-05-17 17:16:59'),
(12, 'Installer Windows 11', 'logiciels/TUTO _ Comment installer Windows 11 (La meilleure manière).mp4', 'Logiciels', 'windows11,installation,os', 'Installer Windows 11 facilement', '2025-05-17 17:17:11'),
(13, 'Installer macOS sur PC', 'logiciels/Comment installer MacOS sur un PC sous Windows [Tuto] [2024].mp4', 'Logiciels', 'macos,pc,windows', 'Hackintosh étape par étape', '2025-05-17 17:17:11'),
(14, 'Installer Ubuntu 24.04', 'logiciels/How to Install Ubuntu 24.04 LTS.mp4', 'Logiciels', 'ubuntu,linux,installation', 'Installation Ubuntu LTS 2024', '2025-05-17 17:17:11'),
(15, 'Installer Windows 10', 'logiciels/Comment Installer Windows 10 Facilement _!_ - Tutoriel de A à Z.mp4', 'Logiciels', 'windows10,formatage', 'Réinstallation complète de Windows 10', '2025-05-17 17:17:11'),
(16, 'Installer Word Excel PowerPoint', 'logiciels/Comment installer word, Excel et PowerPoint en 5 minutes.mp4', 'Logiciels', 'office,word,excel,powerpoint', 'Installation rapide de Microsoft Office', '2025-05-17 17:17:11'),
(17, 'Réparer imprimante Windows 10', 'maintenance/Comment réparer les problèmes d\'imprimante dans Windows 10.mp4', 'Maintenance', 'imprimante,bug,windows10', 'Correction des erreurs d’imprimante', '2025-05-17 17:17:24'),
(18, 'Mettre à jour firmware TP-Link', 'maintenance/How to Update TP-Link Router Firmware Easily _ Complete Guide.mp4', 'Maintenance', 'firmware,tp-link,maj', 'Mise à jour du firmware d’un routeur TP-Link', '2025-05-17 17:17:24'),
(19, 'Reset TP-Link', 'maintenance/How to Reset any TP Link wifi router within 2 minutes _ Factory reset.mp4', 'Maintenance', 'reset,tp-link,routeur', 'Réinitialiser un routeur TP-Link', '2025-05-17 17:17:24'),
(20, 'Conflit IP réseau', 'maintenance/Réseaux informatiques - Adressage IP - Conflits d\'adresses IP.mp4', 'Maintenance', 'ip,reseau,conflit', 'Résoudre les conflits d’adresses IP', '2025-05-17 17:17:24');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `commandes`
--
ALTER TABLE `commandes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages_contact`
--
ALTER TABLE `messages_contact`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `produits`
--
ALTER TABLE `produits`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `scores`
--
ALTER TABLE `scores`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `videos`
--
ALTER TABLE `videos`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `commandes`
--
ALTER TABLE `commandes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `messages_contact`
--
ALTER TABLE `messages_contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `produits`
--
ALTER TABLE `produits`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;

--
-- AUTO_INCREMENT for table `scores`
--
ALTER TABLE `scores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `videos`
--
ALTER TABLE `videos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
