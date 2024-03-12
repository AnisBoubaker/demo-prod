-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: db
-- Generation Time: Feb 02, 2024 at 03:27 PM
-- Server version: 11.2.2-MariaDB-1:11.2.2+maria~ubu2204
-- PHP Version: 8.2.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mydatabase`
--

--
-- Dumping data for table `postits`
--

INSERT INTO `postits` (`id`, `user_id`, `title`, `content`, `created_at`) VALUES
(1, 1, 'Réunion d\'équipe', 'N\'oubliez pas la réunion demain à 10h dans la salle de conférence.', '2024-02-01 20:42:20'),
(2, 1, 'Rappel de projet', 'La date limite pour le projet X est le 15 mars.', '2024-02-01 20:45:17'),
(3, 1, 'Anniversaire de Laura', 'C\'est l\'anniversaire de Laura le 22 mars. Penser à acheter un cadeau.', '2024-02-01 20:45:50'),
(4, 1, 'Dentiste', 'Rendez-vous le 20 mars à 14h30.', '2024-02-01 20:46:15'),
(5, 1, 'Réunion avec le client', 'Réunion avec le client XYZ le 25 mars à 11h.', '2024-02-01 20:48:36'),
(6, 1, 'Rapport', 'Préparer le rapport mensuel pour la réunion du 30 mars.', '2024-02-01 20:48:59');

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `created_at`) VALUES
(1, 'toto', '$2y$10$.X7tkWZey.k1WV/4hIHGn.EeYLCFs.3w073eMNiFuarhm8kbwLofe', 'toto@tata.com', '2024-02-01 20:24:10');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
