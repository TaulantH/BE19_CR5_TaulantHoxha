-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jul 29, 2023 at 01:35 PM
-- Server version: 8.0.31
-- PHP Version: 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `be19_cr5_animal_adoption_taulanthoxha`
--
CREATE DATABASE IF NOT EXISTS `be19_cr5_animal_adoption_taulanthoxha` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;
USE `be19_cr5_animal_adoption_taulanthoxha`;

-- --------------------------------------------------------

--
-- Table structure for table `animals`
--

DROP TABLE IF EXISTS `animals`;
CREATE TABLE IF NOT EXISTS `animals` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `location` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `picture` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `size` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `age` int NOT NULL,
  `vaccinated` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `breed` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'available',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `animals`
--

INSERT INTO `animals` (`id`, `name`, `location`, `picture`, `description`, `size`, `age`, `vaccinated`, `breed`, `status`) VALUES
(19, 'Max', 'Animal Shelter A', 'max.jpg', 'Friendly and playful dog', 'Medium', 3, '1', 'Labrador Retriever', 'unavailable'),
(20, 'Bella', 'Animal Shelter B', '64c504846020c.jpg', 'Calm and affectionate cat', 'Small', 8, '1', 'Siamese', 'available'),
(21, 'Rocky', 'Animal Shelter C', 'rocky.jpg', 'Energetic and loyal dog', 'Large', 9, '1', 'German Shepherd', 'available'),
(22, 'Luna', 'Animal Shelter A', 'luna.jpg', 'Gentle and loving cat', 'Small', 4, '1', 'Maine Coon', 'available'),
(23, 'Charlie', 'Animal Shelter B', 'charlie.jpg', 'Playful and friendly dog', 'Medium', 1, '1', 'Golden Retriever', 'available'),
(24, 'Lucy', 'Animal Shelter C', 'lucy.jpg', 'Sweet and sociable cat', 'Small', 11, '1', 'Persian', 'unavailable'),
(25, 'Duke', 'Animal Shelter A', 'duke.jpg', 'Energetic and adventurous dog', 'Large', 2, '1', 'Boxer', 'available'),
(26, 'Milo', 'Animal Shelter B', 'milo.jpg', 'Affectionate and curious cat', 'Small', 10, '1', 'Bengal', 'available'),
(27, 'Sadie', 'Animal Shelter C', 'sadie.jpg', 'Friendly and playful dog', 'Medium', 4, '1', 'Beagle', 'available'),
(28, 'Chloe', 'Animal Shelter A', 'chloe.jpg', 'Gentle and graceful cat', 'Small', 1, '1', 'Scottish Fold', 'available'),
(29, 'Parrot', 'Aviary', 'parrot.jpg', 'A colorful parrot', 'Small', 3, '1', 'Parrot Breed 1', 'unavailable'),
(30, 'Goldfish', 'Aquarium', 'goldfish.jpg', 'A shiny goldfish', 'Tiny', 1, '0', 'Goldfish Breed 1', 'available'),
(31, 'Canary', 'Aviary', 'canary.jpg', 'A singing canary', 'Small', 2, '1', 'Canary Breed 1', 'unavailable'),
(32, 'Toucan', 'Aviary', 'toucan.jpg', 'A colorful toucan', 'Medium', 4, '0', 'Toucan Breed 1', 'available'),
(33, 'Guppy', 'Aquarium', 'guppy.jpg', 'A small guppy fish', 'Tiny', 1, '0', 'Guppy Breed 1', 'available');

-- --------------------------------------------------------

--
-- Table structure for table `pet_adoption`
--

DROP TABLE IF EXISTS `pet_adoption`;
CREATE TABLE IF NOT EXISTS `pet_adoption` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `pet_id` int NOT NULL,
  `adoption_date` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `pet_id` (`pet_id`)
) ENGINE=MyISAM AUTO_INCREMENT=39 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `pet_adoption`
--

INSERT INTO `pet_adoption` (`id`, `user_id`, `pet_id`, `adoption_date`) VALUES
(38, 9, 31, '2023-07-29'),
(37, 9, 29, '2023-07-29'),
(36, 9, 24, '2023-07-29'),
(35, 9, 19, '2023-07-29');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `first_name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `date_of_birth` date NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `gender` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `phone_number` int NOT NULL,
  `picture` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `status` varchar(4) COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'user',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `password`, `date_of_birth`, `email`, `gender`, `phone_number`, `picture`, `status`) VALUES
(1, 'Taulant', 'Hoxha', '91685f5e8d515356648932f85bf5505e583266b38d48e92d37706286e4857cd9', '2023-07-07', 'taul@gmail.com', 'male', 0, 'avatar.png', 'adm'),
(9, 'Taulant', 'Hoxha', '96cae35ce8a9b0244178bf28e4966c2ce1b8385723a96a6b838858cdd6ca0a1e', '1111-10-22', 'taulant@gmail.com', 'male', 5454666, 'avatar.png', 'user');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
