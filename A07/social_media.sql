-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 24, 2024 at 04:40 PM
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
-- Database: `social_media`
--

-- --------------------------------------------------------

--
-- Table structure for table `addresses`
--

CREATE TABLE `addresses` (
  `addressID` int(10) NOT NULL,
  `cityID` int(10) NOT NULL,
  `provinceID` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `addresses`
--

INSERT INTO `addresses` (`addressID`, `cityID`, `provinceID`) VALUES
(1, 1, 1),
(2, 2, 1),
(3, 3, 2),
(4, 4, 2),
(5, 5, 3),
(6, 6, 3);

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

CREATE TABLE `cities` (
  `cityID` int(10) NOT NULL,
  `name` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cities`
--

INSERT INTO `cities` (`cityID`, `name`) VALUES
(1, 'Tanauan'),
(2, 'Sto. Tomas'),
(3, 'Calamba'),
(4, 'Cabuyao'),
(5, 'Bacoor'),
(6, 'Dasmariñas');

-- --------------------------------------------------------

--
-- Table structure for table `closefriends`
--

CREATE TABLE `closefriends` (
  `closeFriendID` int(10) NOT NULL,
  `ownerID` int(10) NOT NULL,
  `userID` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `commentID` int(10) NOT NULL,
  `dateTime` varchar(25) NOT NULL,
  `content` varchar(1000) NOT NULL,
  `userID` int(10) NOT NULL,
  `postID` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `friends`
--

CREATE TABLE `friends` (
  `friendID` int(10) NOT NULL,
  `requesterID` int(10) NOT NULL,
  `requesteeID` int(10) NOT NULL,
  `status` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `gcmembers`
--

CREATE TABLE `gcmembers` (
  `gcMemberID` int(10) NOT NULL,
  `groupChatID` int(10) NOT NULL,
  `userID` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `groupchats`
--

CREATE TABLE `groupchats` (
  `groupChatID` int(10) NOT NULL,
  `name` varchar(50) NOT NULL,
  `picture` varchar(255) DEFAULT NULL,
  `theme` varchar(30) NOT NULL,
  `adminID` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `messageID` int(10) NOT NULL,
  `message` varchar(1000) NOT NULL,
  `senderID` int(10) NOT NULL,
  `receiverID` int(10) NOT NULL,
  `dateTime` varchar(25) NOT NULL,
  `isRead` varchar(5) NOT NULL,
  `status` varchar(10) NOT NULL,
  `attachment` varchar(255) DEFAULT NULL,
  `groupChatID` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `postID` int(10) NOT NULL,
  `userID` int(10) NOT NULL,
  `content` varchar(2000) NOT NULL,
  `dateTime` varchar(30) NOT NULL DEFAULT current_timestamp(),
  `privacy` varchar(15) NOT NULL,
  `isDeleted` varchar(5) NOT NULL DEFAULT 'no',
  `attachment` varchar(255) DEFAULT NULL,
  `addressID` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`postID`, `userID`, `content`, `dateTime`, `privacy`, `isDeleted`, `attachment`, `addressID`) VALUES
(1, 1, 'Hello World!', '2024-11-14 17:54:26', 'Public', 'no', NULL, NULL),
(2, 1, 'sup friends!!!!', '2024-11-14 17:55:12', 'Friends', 'no', NULL, 0),
(3, 1, 'test', '2024-11-14 17:56:30', 'Only Me', 'yes', NULL, NULL),
(4, 2, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', '2024-11-14 23:30:41', 'Public', 'no', NULL, NULL),
(5, 2, 'Hello po!', '2024-11-14 23:32:08', 'Friends', 'no', NULL, 0),
(6, 1, 'hehehehehe', '2024-11-14 23:39:23', 'Only Me', 'yes', NULL, NULL),
(7, 2, 'Ang gwapo ni John!', '2024-11-15 21:11:50', 'Public', 'yes', NULL, NULL),
(8, 2, 'Wala kayong nakita', '2024-11-15 21:12:50', 'Public', 'no', NULL, NULL),
(9, 2, 'Hulaan niyo kung nasaan ako :P', '2024-11-15 22:51:18', 'Friends', 'no', NULL, 2),
(10, 2, 'HAHAHAHAHA', '2024-11-15 23:05:26', 'Public', 'yes', NULL, 1),
(11, 1, 'Bored.', '2024-11-16 00:43:27', 'Friends', 'yes', NULL, 0),
(12, 1, 'test', '2024-11-23 19:48:53', 'Only Me', 'yes', NULL, 0),
(13, 2, 'Ano @ niya', '2024-11-23 22:14:07', 'Friends', 'yes', NULL, 0),
(14, 2, 'eme', '2024-11-23 22:32:51', 'Friends', 'yes', NULL, 0),
(15, 1, 'UGH!', '2024-11-23 22:49:24', 'Only Me', 'no', NULL, 0),
(16, 1, '@ Tanauan', '2024-11-24 00:01:46', 'Friends', 'no', NULL, 1),
(17, 2, '🥺🥺🥺🙏', '2024-11-24 22:47:52', 'Only Me', 'no', NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `provinces`
--

CREATE TABLE `provinces` (
  `provinceID` int(10) NOT NULL,
  `name` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `provinces`
--

INSERT INTO `provinces` (`provinceID`, `name`) VALUES
(1, 'Batangas'),
(2, 'Laguna'),
(3, 'Cavite');

-- --------------------------------------------------------

--
-- Table structure for table `reactions`
--

CREATE TABLE `reactions` (
  `reactionID` int(10) NOT NULL,
  `userID` int(10) NOT NULL,
  `postID` int(10) NOT NULL,
  `kind` varchar(15) NOT NULL,
  `commentID` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `userinfo`
--

CREATE TABLE `userinfo` (
  `userInfoID` int(10) NOT NULL,
  `userID` int(10) NOT NULL,
  `firstName` varchar(50) NOT NULL,
  `lastName` varchar(50) NOT NULL,
  `birthDay` varchar(15) NOT NULL,
  `addressID` int(10) NOT NULL,
  `profilePicture` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `userinfo`
--

INSERT INTO `userinfo` (`userInfoID`, `userID`, `firstName`, `lastName`, `birthDay`, `addressID`, `profilePicture`) VALUES
(1, 1, 'John', 'Doe', '1990-01-01', 6, 'https://avatar.iran.liara.run/public/47'),
(2, 2, 'Jane', 'Air', '1999-09-17', 4, 'https://avatar.iran.liara.run/public/67');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userID` int(10) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phoneNumber` varchar(20) DEFAULT NULL,
  `willRemember` varchar(5) NOT NULL DEFAULT 'yes',
  `isOnline` varchar(5) NOT NULL DEFAULT 'yes'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userID`, `username`, `password`, `email`, `phoneNumber`, `willRemember`, `isOnline`) VALUES
(1, 'johndoe', 'password1234', 'johndoe@email.com', '0999991234', 'yes', ''),
(2, 'janeair143', 'janeganda', 'janeair143@gmail.com', '09123456777', 'yes', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `addresses`
--
ALTER TABLE `addresses`
  ADD PRIMARY KEY (`addressID`),
  ADD KEY `cityID` (`cityID`),
  ADD KEY `provinceID` (`provinceID`);

--
-- Indexes for table `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`cityID`);

--
-- Indexes for table `closefriends`
--
ALTER TABLE `closefriends`
  ADD PRIMARY KEY (`closeFriendID`),
  ADD KEY `ownerID` (`ownerID`),
  ADD KEY `userID` (`userID`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`commentID`),
  ADD KEY `postID` (`postID`),
  ADD KEY `userID` (`userID`);

--
-- Indexes for table `friends`
--
ALTER TABLE `friends`
  ADD PRIMARY KEY (`friendID`),
  ADD KEY `requesteeID` (`requesteeID`),
  ADD KEY `requesterID` (`requesterID`);

--
-- Indexes for table `gcmembers`
--
ALTER TABLE `gcmembers`
  ADD KEY `userID` (`userID`),
  ADD KEY `groupChatID` (`groupChatID`);

--
-- Indexes for table `groupchats`
--
ALTER TABLE `groupchats`
  ADD PRIMARY KEY (`groupChatID`),
  ADD KEY `adminID` (`adminID`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`messageID`),
  ADD KEY `groupChatID` (`groupChatID`),
  ADD KEY `receiverID` (`receiverID`),
  ADD KEY `senderID` (`senderID`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`postID`),
  ADD KEY `posts_ibfk_2` (`addressID`),
  ADD KEY `posts_ibfk_1` (`userID`);

--
-- Indexes for table `provinces`
--
ALTER TABLE `provinces`
  ADD PRIMARY KEY (`provinceID`);

--
-- Indexes for table `reactions`
--
ALTER TABLE `reactions`
  ADD PRIMARY KEY (`reactionID`),
  ADD KEY `userID` (`userID`),
  ADD KEY `postID` (`postID`),
  ADD KEY `commentID` (`commentID`);

--
-- Indexes for table `userinfo`
--
ALTER TABLE `userinfo`
  ADD PRIMARY KEY (`userInfoID`),
  ADD KEY `addressID` (`addressID`),
  ADD KEY `userinfo_ibfk_1` (`userID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userID`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `addresses`
--
ALTER TABLE `addresses`
  MODIFY `addressID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `cities`
--
ALTER TABLE `cities`
  MODIFY `cityID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `closefriends`
--
ALTER TABLE `closefriends`
  MODIFY `closeFriendID` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `commentID` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `friends`
--
ALTER TABLE `friends`
  MODIFY `friendID` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `groupchats`
--
ALTER TABLE `groupchats`
  MODIFY `groupChatID` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `messageID` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `postID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `provinces`
--
ALTER TABLE `provinces`
  MODIFY `provinceID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `reactions`
--
ALTER TABLE `reactions`
  MODIFY `reactionID` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `userinfo`
--
ALTER TABLE `userinfo`
  MODIFY `userInfoID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `addresses`
--
ALTER TABLE `addresses`
  ADD CONSTRAINT `addresses_ibfk_1` FOREIGN KEY (`cityID`) REFERENCES `cities` (`cityID`),
  ADD CONSTRAINT `addresses_ibfk_2` FOREIGN KEY (`provinceID`) REFERENCES `provinces` (`provinceID`);

--
-- Constraints for table `closefriends`
--
ALTER TABLE `closefriends`
  ADD CONSTRAINT `closefriends_ibfk_1` FOREIGN KEY (`ownerID`) REFERENCES `users` (`userID`),
  ADD CONSTRAINT `closefriends_ibfk_2` FOREIGN KEY (`userID`) REFERENCES `users` (`userID`);

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`postID`) REFERENCES `posts` (`postID`),
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`userID`) REFERENCES `users` (`userID`);

--
-- Constraints for table `friends`
--
ALTER TABLE `friends`
  ADD CONSTRAINT `friends_ibfk_1` FOREIGN KEY (`requesteeID`) REFERENCES `users` (`userID`),
  ADD CONSTRAINT `friends_ibfk_2` FOREIGN KEY (`requesterID`) REFERENCES `users` (`userID`);

--
-- Constraints for table `gcmembers`
--
ALTER TABLE `gcmembers`
  ADD CONSTRAINT `gcmembers_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `users` (`userID`),
  ADD CONSTRAINT `gcmembers_ibfk_2` FOREIGN KEY (`groupChatID`) REFERENCES `groupchats` (`groupChatID`);

--
-- Constraints for table `groupchats`
--
ALTER TABLE `groupchats`
  ADD CONSTRAINT `groupchats_ibfk_1` FOREIGN KEY (`adminID`) REFERENCES `users` (`userID`);

--
-- Constraints for table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages_ibfk_1` FOREIGN KEY (`groupChatID`) REFERENCES `groupchats` (`groupChatID`),
  ADD CONSTRAINT `messages_ibfk_2` FOREIGN KEY (`receiverID`) REFERENCES `users` (`userID`),
  ADD CONSTRAINT `messages_ibfk_3` FOREIGN KEY (`senderID`) REFERENCES `users` (`userID`);

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `users` (`userID`) ON UPDATE CASCADE;

--
-- Constraints for table `reactions`
--
ALTER TABLE `reactions`
  ADD CONSTRAINT `reactions_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `users` (`userID`),
  ADD CONSTRAINT `reactions_ibfk_2` FOREIGN KEY (`postID`) REFERENCES `posts` (`postID`),
  ADD CONSTRAINT `reactions_ibfk_3` FOREIGN KEY (`commentID`) REFERENCES `comments` (`commentID`);

--
-- Constraints for table `userinfo`
--
ALTER TABLE `userinfo`
  ADD CONSTRAINT `userinfo_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `users` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `userinfo_ibfk_2` FOREIGN KEY (`addressID`) REFERENCES `addresses` (`addressID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
