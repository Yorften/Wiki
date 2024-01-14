-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 14, 2024 at 04:42 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `wiki`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `categoryId` int(11) NOT NULL,
  `categoryName` varchar(255) DEFAULT NULL,
  `isVisible` smallint(1) DEFAULT 1,
  `categoryDate` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`categoryId`, `categoryName`, `isVisible`, `categoryDate`) VALUES
(1, 'Uncategorized', 0, '2024-01-06 00:00:00'),
(8, 'Gaming', 1, '2024-01-11 22:25:43'),
(9, 'History', 1, '2024-01-11 22:21:14'),
(10, 'Science', 1, '2024-01-11 22:21:16'),
(11, 'Technology', 1, '2024-01-11 22:21:20'),
(12, 'Arts and Entertainment', 1, '2024-01-11 22:25:05'),
(13, 'Sports', 1, '2024-01-11 22:25:17');

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE `tags` (
  `tagId` int(11) NOT NULL,
  `tagName` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tags`
--

INSERT INTO `tags` (`tagId`, `tagName`) VALUES
(16, 'Video games'),
(17, 'Software development'),
(18, 'Path Of Exile'),
(19, 'POE'),
(20, 'Ancient history'),
(21, 'Medieval'),
(22, 'Software'),
(23, 'Hardware'),
(24, 'Programming languages'),
(25, 'Gadgets and devices'),
(26, 'Gadgets'),
(27, 'Physics'),
(28, 'Chemistry'),
(29, 'Biology'),
(30, 'Music'),
(31, 'Film'),
(32, 'Action'),
(33, 'Literature'),
(34, 'Adventure'),
(35, 'Horror'),
(36, 'Online'),
(37, 'MMORPG'),
(38, 'Roleplaying');

-- --------------------------------------------------------

--
-- Table structure for table `tags_wikis`
--

CREATE TABLE `tags_wikis` (
  `tags_wikisId` int(11) NOT NULL,
  `tagId` int(11) DEFAULT NULL,
  `wikiId` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tags_wikis`
--

INSERT INTO `tags_wikis` (`tags_wikisId`, `tagId`, `wikiId`) VALUES
(91, 16, 21),
(92, 18, 21),
(93, 19, 21),
(94, 21, 21),
(95, 32, 21),
(96, 36, 21);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userId` int(11) NOT NULL,
  `userName` varchar(255) DEFAULT NULL,
  `userEmail` varchar(255) DEFAULT NULL,
  `userPassword` varchar(255) DEFAULT NULL,
  `userDate` date DEFAULT '2024-01-11',
  `userRole` enum('admin','author') NOT NULL DEFAULT 'author'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userId`, `userName`, `userEmail`, `userPassword`, `userDate`, `userRole`) VALUES
(1, 'admin', 'admin@youcode.ma', '$2y$10$UM/Nn9MAWzrGgXH1TpSscumHQEoTeKHuh8QaqJ22ijvoWXtRzTj0e', '2024-01-11', 'admin'),
(2, 'digylu', 'camec@mailinator.com', '$2y$10$CrG9kOECY9g65yUbIswSOulnaqEhIQQ/BqoXdSDnUQkxXSMWmRerq', '2024-01-11', 'author'),
(3, 'xodez', 'dadozyx@mailinator.com', '$2y$10$dqRKxeuKEvwWLTvbTANES.eXg.wUHyit8Ucpu3Cg2/7Wx0YBZs3wW', '2024-01-11', 'author'),
(4, 'zazusuje', 'zoruxa@mailinator.com', '$2y$10$.3sQPeWyyD9UuLgkF7jVkuAeJSJ0WsHCfv8q/s9w1vIF/xQzQsp/e', '2024-01-11', 'author'),
(5, 'penadi', 'vydobafak@mailinator.com', '$2y$10$hXgdc9e93Q9WCmEwJvcC6uVlP1TQIu7OckjydPf61sg.tiMt0f6AW', '2024-01-11', 'author');

-- --------------------------------------------------------

--
-- Table structure for table `wikis`
--

CREATE TABLE `wikis` (
  `wikiId` int(11) NOT NULL,
  `wikiName` varchar(255) DEFAULT NULL,
  `wikiDesc` varchar(500) NOT NULL,
  `wikiContent` mediumtext DEFAULT NULL,
  `wikiImage` varchar(255) DEFAULT NULL,
  `wikiDate` date DEFAULT NULL,
  `isArchived` smallint(1) DEFAULT 0,
  `userId` int(11) DEFAULT NULL,
  `categoryId` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `wikis`
--

INSERT INTO `wikis` (`wikiId`, `wikiName`, `wikiDesc`, `wikiContent`, `wikiImage`, `wikiDate`, `isArchived`, `userId`, `categoryId`) VALUES
(21, 'Path Of Exile', 'The Path of Exile Wiki. This is the official Path of Exile wiki', 'Overview&#10;Title: Path of Exile&#10;Developer: Grinding Gear Games&#10;Publisher: Grinding Gear Games&#10;Release Date: October 23, 2013&#10;Platform: Microsoft Windows, Xbox One, PlayStation 4&#10;&#10;Gameplay&#10;Action RPG Mechanics:&#10;Path of Exile follows the traditional action role-playing game (ARPG) mechanics, emphasizing real-time combat, exploration, and character progression. Players navigate through large, interconnected areas filled with monsters and loot.&#10;&#10;Skill Gem System:&#10;One of the defining features of PoE is its skill gem system. Skills are not tied to character classes but are instead granted by gems socketed into equipment. These gems level up and can be modified by support gems, allowing for an unprecedented level of customization.&#10;&#10;Passive Skill Tree:&#10;The game features a vast passive skill tree with hundreds of nodes, allowing players to tailor their characters with a high degree of precision. Character classes provide a starting point on the tree, but players are free to choose any path as they level up.&#10;&#10;Currency System:&#10;Path of Exile replaces traditional gold or money systems with a barter-based currency system. Currency items have practical uses in crafting and modifying gear, contributing to the game\'s economy.&#10;&#10;Loot and Itemization:&#10;PoE offers a wide variety of items, each with its own unique properties. The game\'s economy is player-driven, and valuable items can be traded with other players.&#10;&#10;Setting&#10;Dark and Atmospheric World:&#10;Path of Exile is set in the dark fantasy world of Wraeclast, a forsaken continent filled with dangerous creatures and corrupted beings. The game\'s atmosphere is grim and oppressive, contributing to its unique aesthetic.&#10;&#10;Story and Lore:&#10;Players follow the story of their exiled character seeking redemption on Wraeclast. The narrative is unveiled through in-game dialogue, lore items, and environmental storytelling.&#10;&#10;Expansions and Updates&#10;Regular Content Releases:&#10;Grinding Gear Games is known for its commitment to releasing regular expansions and updates, introducing new content, features, and challenges to keep the player base engaged.&#10;&#10;Challenge Leagues:&#10;Challenge Leagues are time-limited events with unique modifiers and mechanics. These leagues introduce fresh gameplay experiences and often come with exclusive rewards.&#10;&#10;Community and Multiplayer&#10;Trading and Player Interaction:&#10;Path of Exile encourages player interaction through trading and grouping. The game features a bustling online community where players can buy, sell, and trade items.&#10;&#10;Competitive Scene:&#10;The game has a competitive scene with events and leagues that attract top players and streamers. Races, PvP tournaments, and other competitive events contribute to the vibrant community.', 'IMG-65a0ca23cebde9.64318940.jpg', '2024-01-12', 0, 2, 8);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`categoryId`);

--
-- Indexes for table `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`tagId`);

--
-- Indexes for table `tags_wikis`
--
ALTER TABLE `tags_wikis`
  ADD PRIMARY KEY (`tags_wikisId`),
  ADD KEY `fk_tagswikis_tag` (`tagId`),
  ADD KEY `fk_tagswikis_wiki` (`wikiId`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userId`);

--
-- Indexes for table `wikis`
--
ALTER TABLE `wikis`
  ADD PRIMARY KEY (`wikiId`),
  ADD KEY `fk_wiki_user` (`userId`),
  ADD KEY `fk_wiki_category` (`categoryId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `categoryId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tags`
--
ALTER TABLE `tags`
  MODIFY `tagId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `tags_wikis`
--
ALTER TABLE `tags_wikis`
  MODIFY `tags_wikisId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=110;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `wikis`
--
ALTER TABLE `wikis`
  MODIFY `wikiId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tags_wikis`
--
ALTER TABLE `tags_wikis`
  ADD CONSTRAINT `fk_tagswikis_tag` FOREIGN KEY (`tagId`) REFERENCES `tags` (`tagId`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_tagswikis_wiki` FOREIGN KEY (`wikiId`) REFERENCES `wikis` (`wikiId`) ON DELETE CASCADE;

--
-- Constraints for table `wikis`
--
ALTER TABLE `wikis`
  ADD CONSTRAINT `fk_wiki_category` FOREIGN KEY (`categoryId`) REFERENCES `categories` (`categoryId`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_wiki_user` FOREIGN KEY (`userId`) REFERENCES `users` (`userId`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
