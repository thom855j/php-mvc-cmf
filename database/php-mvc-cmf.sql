
-- phpMyAdmin SQL Dump
-- version 4.4.10
-- http://www.phpmyadmin.net
--
-- Vært: localhost:3306
-- Genereringstid: 13. 10 2015 kl. 20:46:12
-- Serverversion: 5.5.42
-- PHP-version: 5.6.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `php-mvc-cms`
--

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `Comments`
--

CREATE TABLE `Comments` (
  `ID` int(10) unsigned NOT NULL,
  `Name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Email` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Post_ID` int(11) NOT NULL,
  `User_ID` int(11) NOT NULL,
  `Content` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `Menus`
--

CREATE TABLE `Menus` (
  `ID` int(10) unsigned NOT NULL,
  `Label` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Sort` int(11) NOT NULL,
  `Type` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Role_ID` int(11) NOT NULL,
  `Parent_ID` int(11) NOT NULL,
  `Lang` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `Messages`
--

CREATE TABLE `Messages` (
  `ID` int(10) unsigned NOT NULL,
  `Name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Email` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Content` text COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `Meta_items`
--

CREATE TABLE `Meta_items` (
  `ID` int(10) unsigned NOT NULL,
  `Timestamp` int(11) NOT NULL,
  `Meta_ID` int(11) NOT NULL,
  `Item_ID` int(11) NOT NULL,
  `User_ID` int(11) NOT NULL,
  `Type` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `Options`
--

CREATE TABLE `Options` (
  `ID` int(10) unsigned NOT NULL,
  `Name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Value` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `Plugins`
--

CREATE TABLE `Plugins` (
  `ID` int(11) NOT NULL,
  `Timestamp` int(11) NOT NULL,
  `Name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Active` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `Posts`
--

CREATE TABLE `Posts` (
  `ID` int(11) unsigned NOT NULL,
  `Title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Created` int(11) NOT NULL,
  `Updated` int(11) DEFAULT NULL,
  `Start` int(11) NOT NULL,
  `End` int(11) NOT NULL,
  `Content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `Excerpt` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `Type` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'page',
  `Status_ID` int(11) NOT NULL,
  `User_ID` int(11) NOT NULL,
  `Lang` varchar(5) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Data dump for tabellen `Posts`
--

INSERT INTO `Posts` (`ID`, `Title`, `Name`, `Created`, `Updated`, `Start`, `End`, `Content`, `Excerpt`, `Type`, `Status_ID`, `User_ID`, `Lang`) VALUES
(1, 'Welcome', 'home', 0, 0, 0, 0, 'Welcome to my site', '', 'page', 0, 0, ''),
(2, 'Hallo world!', 'hello-world', 0, 0, 0, 0, 'Hello awesome world!', '', 'page', 0, 0, ''),
(3, 'My Account', 'auth/login', 0, 0, 0, 0, 'My account', '', 'page', 0, 0, ''),
(4, 'Contact', 'contact', 0, 0, 0, 0, 'contact', '', 'page', 0, 0, ''),
(5, 'test', 'Test', 0, NULL, 0, 0, '', '', 'task', 0, 0, NULL);

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `Roles`
--

CREATE TABLE `Roles` (
  `ID` int(10) unsigned NOT NULL,
  `Name` int(25) NOT NULL,
  `Role` text COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `Sessions`
--

CREATE TABLE `Sessions` (
  `ID` int(10) unsigned NOT NULL,
  `Token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `User_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `Status`
--

CREATE TABLE `Status` (
  `ID` int(10) unsigned NOT NULL,
  `Name` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Label` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Parent_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `Themes`
--

CREATE TABLE `Themes` (
  `ID` int(10) unsigned NOT NULL,
  `Timestamp` int(11) NOT NULL,
  `Name` int(255) NOT NULL,
  `Active` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `Uploads`
--

CREATE TABLE `Uploads` (
  `ID` int(10) unsigned NOT NULL,
  `Timestamp` int(11) NOT NULL,
  `Name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `User_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `Users`
--

CREATE TABLE `Users` (
  `ID` int(11) NOT NULL,
  `Username` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Firstname` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Lastname` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Data dump for tabellen `Users`
--

INSERT INTO `Users` (`ID`, `Username`, `Firstname`, `Lastname`) VALUES
(1, 'Root', 'Root', 'Admin'),
(2, 'Demo', 'Demo', 'Man'),
(3, 'Test', 'User', 'test'),
(4, 'Hello', 'Hello', 'World');

--
-- Begrænsninger for dumpede tabeller
--

--
-- Indeks for tabel `Comments`
--
ALTER TABLE `Comments`
  ADD PRIMARY KEY (`ID`);

--
-- Indeks for tabel `Menus`
--
ALTER TABLE `Menus`
  ADD PRIMARY KEY (`ID`);

--
-- Indeks for tabel `Messages`
--
ALTER TABLE `Messages`
  ADD PRIMARY KEY (`ID`);

--
-- Indeks for tabel `Meta_items`
--
ALTER TABLE `Meta_items`
  ADD PRIMARY KEY (`ID`);

--
-- Indeks for tabel `Options`
--
ALTER TABLE `Options`
  ADD PRIMARY KEY (`ID`);

--
-- Indeks for tabel `Plugins`
--
ALTER TABLE `Plugins`
  ADD PRIMARY KEY (`ID`);

--
-- Indeks for tabel `Posts`
--
ALTER TABLE `Posts`
  ADD PRIMARY KEY (`ID`);

--
-- Indeks for tabel `Roles`
--
ALTER TABLE `Roles`
  ADD PRIMARY KEY (`ID`);

--
-- Indeks for tabel `Sessions`
--
ALTER TABLE `Sessions`
  ADD PRIMARY KEY (`ID`);

--
-- Indeks for tabel `Status`
--
ALTER TABLE `Status`
  ADD PRIMARY KEY (`ID`);

--
-- Indeks for tabel `Themes`
--
ALTER TABLE `Themes`
  ADD PRIMARY KEY (`ID`);

--
-- Indeks for tabel `Uploads`
--
ALTER TABLE `Uploads`
  ADD PRIMARY KEY (`ID`);

--
-- Indeks for tabel `Users`
--
ALTER TABLE `Users`
  ADD PRIMARY KEY (`ID`);

--
-- Brug ikke AUTO_INCREMENT for slettede tabeller
--

--
-- Tilføj AUTO_INCREMENT i tabel `Comments`
--
ALTER TABLE `Comments`
  MODIFY `ID` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- Tilføj AUTO_INCREMENT i tabel `Menus`
--
ALTER TABLE `Menus`
  MODIFY `ID` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- Tilføj AUTO_INCREMENT i tabel `Messages`
--
ALTER TABLE `Messages`
  MODIFY `ID` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- Tilføj AUTO_INCREMENT i tabel `Meta_items`
--
ALTER TABLE `Meta_items`
  MODIFY `ID` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- Tilføj AUTO_INCREMENT i tabel `Options`
--
ALTER TABLE `Options`
  MODIFY `ID` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- Tilføj AUTO_INCREMENT i tabel `Plugins`
--
ALTER TABLE `Plugins`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- Tilføj AUTO_INCREMENT i tabel `Posts`
--
ALTER TABLE `Posts`
  MODIFY `ID` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- Tilføj AUTO_INCREMENT i tabel `Roles`
--
ALTER TABLE `Roles`
  MODIFY `ID` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- Tilføj AUTO_INCREMENT i tabel `Sessions`
--
ALTER TABLE `Sessions`
  MODIFY `ID` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- Tilføj AUTO_INCREMENT i tabel `Status`
--
ALTER TABLE `Status`
  MODIFY `ID` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- Tilføj AUTO_INCREMENT i tabel `Themes`
--
ALTER TABLE `Themes`
  MODIFY `ID` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- Tilføj AUTO_INCREMENT i tabel `Uploads`
--
ALTER TABLE `Uploads`
  MODIFY `ID` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- Tilføj AUTO_INCREMENT i tabel `Users`
--
ALTER TABLE `Users`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;