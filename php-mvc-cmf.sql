-- phpMyAdmin SQL Dump
-- version 4.4.14
-- http://www.phpmyadmin.net
--
-- Vært: localhost
-- Genereringstid: 18. 09 2015 kl. 22:03:05
-- Serverversion: 5.6.26
-- PHP-version: 5.6.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `php-mvc-cmf`
--

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `Menus`
--

CREATE TABLE IF NOT EXISTS `Menus` (
  `ID` int(11) NOT NULL,
  `Label` varchar(254) NOT NULL,
  `Name` varchar(254) NOT NULL,
  `Sort` int(11) NOT NULL,
  `Parent_ID` int(11) NOT NULL,
  `Type` varchar(20) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Data dump for tabellen `Menus`
--

INSERT INTO `Menus` (`ID`, `Label`, `Name`, `Sort`, `Parent_ID`, `Type`) VALUES
(1, 'Ejendomme', 'ejendomme', 1, 0, 'header'),
(2, 'Kontakt', '#kontakt', 2, 0, 'header'),
(3, 'Om os', 'om-os', 1, 0, 'footer'),
(4, 'Ejendomme', 'ejendomme', 2, 0, 'footer'),
(5, 'Partnere', '#partnere', 3, 0, 'footer'),
(6, 'Kontakt', '#kontakt', 4, 0, 'footer'),
(7, 'Login', 'login', 5, 0, 'footer');

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `Messages`
--

CREATE TABLE IF NOT EXISTS `Messages` (
  `ID` int(11) NOT NULL,
  `Created` int(11) NOT NULL,
  `Name` varchar(32) NOT NULL,
  `Email` varchar(32) NOT NULL,
  `Content` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `Meta_items`
--

CREATE TABLE IF NOT EXISTS `Meta_items` (
  `ID` int(11) NOT NULL,
  `Meta_ID` int(11) NOT NULL,
  `Item_ID` int(11) NOT NULL,
  `User_ID` int(11) NOT NULL,
  `Type` varchar(20) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=86 DEFAULT CHARSET=latin1;

--
-- Data dump for tabellen `Meta_items`
--

INSERT INTO `Meta_items` (`ID`, `Meta_ID`, `Item_ID`, `User_ID`, `Type`) VALUES
(63, 13, 10, 10, 'favorite'),
(68, 14, 7, 7, 'favorite'),
(78, 20, 7, 7, 'favorite');

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `Options`
--

CREATE TABLE IF NOT EXISTS `Options` (
  `ID` int(11) NOT NULL,
  `Label` varchar(254) NOT NULL,
  `Name` varchar(32) NOT NULL,
  `Value` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=latin1;

--
-- Data dump for tabellen `Options`
--

INSERT INTO `Options` (`ID`, `Label`, `Name`, `Value`) VALUES
(4, 'Titel', 'App', 'Happy House'),
(5, 'Telefonnummer', 'Telefonnummer', '+45 99 23 45 98'),
(6, 'Afdelinger overskrift', 'Afdelinger_overskrift', 'Danmarks største boligportal\r\nmed afdelinger i hele landet'),
(7, 'Afdelinger indhold', 'Afdelinger_indhold', ' Lorem ipsum dolor sit amet, consectetur                     adipiscing elit. Etiam pharetra laoreet tellus at                     hendrerit. Etiam sit amet nunc nec risus lobortis                     efficitur eu eu libero. Aenean eget vestibulum ante.                     Integer vulputate nisl dictum lectus molestie euismod                     in in nisi. Etiam non sem in velit porttitor porta.'),
(8, 'Email', 'Email', 'hello@happyhouse.dk'),
(9, 'Adresse', 'Adresse', 'Boligvej 67\r\n'),
(10, 'Postnummer', 'Postnummer', '5000\r\n'),
(11, 'By', 'By', 'Odense C\r\n'),
(12, 'CVR', 'CVR', '99 34 45 67\r\n'),
(13, 'Land', 'Land', 'Danmark'),
(14, 'Åbningstider Hverdage', 'Åbningstider_hverdage', 'Mandag - Fredag 09-17.00 '),
(15, 'Åbningstider Weekend', 'Åbningstider_weekend', 'Lørdag - Søndag 09-13.00 '),
(16, 'Åbningstider Helligdage', 'Åbningstider_helligdage', 'Helligdage - Lukket'),
(17, 'Udpluk af boliger - overskrift', 'Udpluk_af_boliger_overskrift', 'Her er et udpluk af vores seneste drømmeboliger'),
(18, 'Kontaktformular - overskrift', 'Kontaktformular_overskrift', 'Hvad kan vi hjælpe dig med?'),
(19, 'Kontaktformular - undertekst', 'Kontaktformular_undertekst', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.'),
(20, 'Forside overskrift', 'Forside_overskrift', '    Søg i Danmarks største <b>Boligportal</b>\r\n            <br>og find din drømmebolig nu!'),
(21, 'Forside link', 'Forside_link', 'ejendomme'),
(22, 'Forside link tekst', 'Forside_link_tekst', 'FIND DIN BOLIG HER!'),
(23, 'Dato format', 'Date_format', 'd/m/Y H:i\r\n'),
(24, 'Footer knap tekst', 'Footer_button_text', 'SE EJENDOMME'),
(25, 'Footer kontakt tekst', 'Footer_contact_text', 'Kontakt os og lad os hjælpe'),
(26, 'Footer kontakt link', 'Footer_contact_link', '#kontakt'),
(27, 'Footer knap link', 'Footer_button_link', 'ejendomme');

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `Posts`
--

CREATE TABLE IF NOT EXISTS `Posts` (
  `ID` int(11) NOT NULL,
  `Created` int(11) NOT NULL,
  `Updated` int(11) NOT NULL,
  `City` varchar(32) NOT NULL,
  `M2` int(11) NOT NULL,
  `Rooms` int(11) NOT NULL,
  `Bath_rooms` int(11) NOT NULL,
  `Country` varchar(32) NOT NULL,
  `Price` decimal(10,2) NOT NULL,
  `Type` varchar(32) NOT NULL,
  `Title` varchar(254) NOT NULL,
  `Slug` varchar(254) NOT NULL,
  `Content` text NOT NULL,
  `Thumbnail` varchar(254) NOT NULL,
  `Excerpt` varchar(254) NOT NULL,
  `Status_ID` int(11) NOT NULL,
  `User_ID` int(11) NOT NULL,
  `Post_type` varchar(20) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;

--
-- Data dump for tabellen `Posts`
--

INSERT INTO `Posts` (`ID`, `Created`, `Updated`, `City`, `M2`, `Rooms`, `Bath_rooms`, `Country`, `Price`, `Type`, `Title`, `Slug`, `Content`, `Thumbnail`, `Excerpt`, `Status_ID`, `User_ID`, `Post_type`) VALUES
(13, 1442491617, 0, 'Samos', 90, 3, 2, 'Grækenland', '1250000.00', 'Hus', '', '', 'Feriehus på solrige Samos lige midt på havnen i det\r\ngamle fisker kvarter. Passer perfekt til dig som mangler et fristed under varmere himmelstrøg.', '1442491398_bolig-4-min.jpg', 'Feriehus på solrige Samos.', 0, 7, 'house'),
(14, 1442491725, 1442597392, 'Aarhus', 150, 5, 1, 'Danmark', '3200000.00', 'Hus', '', '', 'Moderne byhus beliggende i et børnevenligt \r\nkvarter nær centrum. Til jer som har stiftet familie eller overvejer det. Passer perfekt til børnfamilier med lejepladser og gode indkøbsmuligheder.', '1442491398_bolig-3-min.jpg', 'Moderne byhus beliggende i et børnevenligt \r\nkvarter.', 0, 7, 'house'),
(20, 1442603590, 1442603708, 'Odense', 89, 2, 3, 'Danmark', '500000.00', 'Hus', '', '', 'Smuk lejlighed midt i Odense', '1442491398_bolig-2-min.jpg', 'Smuk lejlighed.', 0, 7, 'house'),
(21, 1442605432, 1442606230, 'Assens', 800, 90, 5, 'Danmark', '8000000.00', 'Hus', '', '', 'Assens Kommune udbyder ejendommen Odensevej 29A-C, 5610 Assens (del nr. 1 og 4 af matr. nr. 23 B Assens Markjorder og del nr. 8 af matr. nr. 25 BC Assens Markjorder) i offentligt udbud. \r\n\r\nTilbudsfristen er 9. juni 2015, kl. 12.00. Tilbuddet skal afleveres i lukket kuvert mrk. ”Tilbud – Odense-vej 29A, B og C, 5610 Assens” til Colliers International Danmark A/S, Tagtækkervej 8, 1. sal, 5230 Odense M.\r\n\r\nEjendommen er beliggende Odensevej 29 A-C, 5610 Assens. Ejendommen er fuldt udlejet. Lejerne er primært relateret til sundhedssektoren.\r\n\r\nSalgsmateriale\r\nTilbudsblanket\r\n\r\nYderligere oplysninger \r\n\r\nYderligere oplysninger kan fås ved henvendelse til Søren Gørup Christiansen, Erhvervsmægler, cand. Jur., Colliers International Danmark A/S, mobil: 2046 7002, e-mail: sgc@colliers.dk', '1442606216_Sundhedscentret.jpg', 'Assens Kommune udbyder ejendommen Odensevej 29A-C, 5610 Assens (del nr. 1 og 4 af matr. nr. 23 B Assens Markjorder og del nr. 8 af matr. nr. 25 BC Assens Markjorder) i offentligt udbud.', 0, 7, 'house');

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `Roles`
--

CREATE TABLE IF NOT EXISTS `Roles` (
  `ID` int(11) NOT NULL,
  `Name` varchar(20) NOT NULL,
  `Role` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Data dump for tabellen `Roles`
--

INSERT INTO `Roles` (`ID`, `Name`, `Role`) VALUES
(1, 'admin', '{"admin": 1,"broker": 1,"user": 1}'),
(2, 'broker', '{"admin": 0,"broker": 1,"user": 1}'),
(3, 'user', '{"admin": 0,"broker": 0,"user": 1}');

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `Sessions`
--

CREATE TABLE IF NOT EXISTS `Sessions` (
  `ID` int(11) NOT NULL,
  `Token` varchar(64) NOT NULL,
  `User_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Data dump for tabellen `Sessions`
--

INSERT INTO `Sessions` (`ID`, `Token`, `User_ID`) VALUES
(10, 'vRM7F3/q8zRek75kYvXfn8F/WiyakcxfdbSKBSGIWlDb4UBVSqForNCMN3o06g==', 1);

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `Status`
--

CREATE TABLE IF NOT EXISTS `Status` (
  `ID` int(11) NOT NULL,
  `Label` varchar(20) NOT NULL,
  `Status` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Data dump for tabellen `Status`
--

INSERT INTO `Status` (`ID`, `Label`, `Status`) VALUES
(1, 'Deaktiveret', 'blocked'),
(2, 'Aktiv', 'activ'),
(3, 'Solgt', 'sold'),
(4, 'Nyhed', 'new'),
(5, 'Inaktiv', 'inactive'),
(6, 'Fremhævet', 'promoted');

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `Uploads`
--

CREATE TABLE IF NOT EXISTS `Uploads` (
  `ID` int(11) NOT NULL,
  `Timestamp` int(11) NOT NULL,
  `Slug` varchar(254) NOT NULL,
  `User_ID` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=127 DEFAULT CHARSET=latin1;

--
-- Data dump for tabellen `Uploads`
--

INSERT INTO `Uploads` (`ID`, `Timestamp`, `Slug`, `User_ID`) VALUES
(107, 1442491379, '1442491379_bolig-1-min.jpg', 7),
(108, 1442491398, '1442491398_bolig-2-min.jpg', 7),
(109, 1442491400, '1442491398_bolig-3-min.jpg', 7),
(110, 1442491401, '1442491398_bolig-4-min.jpg', 7),
(111, 1442491401, '1442491398_bolig-5-min.jpg', 7),
(112, 1442491402, '1442491398_bolig-6-min.jpg', 7),
(113, 1442491403, '1442491398_bolig-7-min.jpg', 7),
(114, 1442491404, '1442491398_thumb-1-1-min.jpg', 7),
(115, 1442491404, '1442491398_thumb-1-2-min.jpg', 7),
(116, 1442491405, '1442491398_thumb-2-1-min.jpg', 7),
(117, 1442491406, '1442491398_thumb-2-2-min.jpg', 7),
(118, 1442491406, '1442491398_thumb-3-min.jpg', 7),
(119, 1442491408, '1442491398_thumb-4-min.jpg', 7),
(120, 1442491410, '1442491398_thumb-5-1-min.jpg', 7),
(121, 1442491411, '1442491398_thumb-5-2-min.jpg', 7),
(122, 1442491413, '1442491398_thumb-6-min.jpg', 7),
(123, 1442491413, '1442491398_thumb-7-min.jpg', 7),
(124, 1442580827, '1442580827_thumb-6-min.jpg', 14),
(126, 1442606216, '1442606216_Sundhedscentret.jpg', 7);

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `Users`
--

CREATE TABLE IF NOT EXISTS `Users` (
  `ID` int(11) NOT NULL,
  `Created` int(11) NOT NULL,
  `Updated` int(11) DEFAULT NULL,
  `Name` varchar(50) NOT NULL,
  `Username` varchar(20) NOT NULL,
  `Email` varchar(20) NOT NULL,
  `Password` varchar(60) NOT NULL,
  `Org` varchar(32) NOT NULL,
  `Role_ID` int(11) NOT NULL,
  `Status_ID` int(11) NOT NULL,
  `Auth_token` varchar(64) NOT NULL,
  `Reset_token` varchar(64) NOT NULL,
  `Last_login` int(11) DEFAULT NULL,
  `Timeout` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

--
-- Data dump for tabellen `Users`
--

INSERT INTO `Users` (`ID`, `Created`, `Updated`, `Name`, `Username`, `Email`, `Password`, `Org`, `Role_ID`, `Status_ID`, `Auth_token`, `Reset_token`, `Last_login`, `Timeout`) VALUES
(7, 1442557595, NULL, 'Kaj Madsen', 'maegler', 'kaj@bolighaj.dk', '$2y$07$p2euKk6ZIDxLiwNK8y2siu3jTls6uoVYXbXx3i0s6e74Wn0bZHBn6', 'Kaj Bolighaj', 2, 2, 'tezJAwekOeGUvZHzib+uq6TIdzvqspnJz85UOPbd7sVyc3K36rZqYPhRvkzuuQ==', '', 1442602929, 1442604707),
(10, 1442558299, 1442580522, 'Administrator', 'admin', 'admin@happyhouse.dk', '$2y$07$XJoQlG0I5CauAoFLjU6eeej72CRUD/3FlXK7kLUqq.efVkVvyzxVS', 'Happy House', 1, 2, 'PqfQJzZeIKAQHvWjxcMKBP4zVYn5D9Z7/juO/AUSoQlGPQ4l5qZS/+NeHO8VpQ==', '', 1442606446, 1442606505),
(11, 1442564664, NULL, 'Randi Pedersen', 'bruger', 'randi@pedersen.dk', '$2y$07$VTEuy5YCXISGagA667RqTuX6IThqRdY.9esLjrqfwVSjk3fFrecde', '', 3, 2, 'IDIyFN7fb3iuEG9yhSajRaVl7UNHggZ/yoN2MieiFLH3O6APgunduIxl3A7/kg==', '', 1442564669, 1442565013);

--
-- Begrænsninger for dumpede tabeller
--

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
-- Indeks for tabel `Status`
--
ALTER TABLE `Status`
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
-- Tilføj AUTO_INCREMENT i tabel `Menus`
--
ALTER TABLE `Menus`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- Tilføj AUTO_INCREMENT i tabel `Messages`
--
ALTER TABLE `Messages`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- Tilføj AUTO_INCREMENT i tabel `Meta_items`
--
ALTER TABLE `Meta_items`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=86;
--
-- Tilføj AUTO_INCREMENT i tabel `Options`
--
ALTER TABLE `Options`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=28;
--
-- Tilføj AUTO_INCREMENT i tabel `Posts`
--
ALTER TABLE `Posts`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=22;
--
-- Tilføj AUTO_INCREMENT i tabel `Roles`
--
ALTER TABLE `Roles`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- Tilføj AUTO_INCREMENT i tabel `Status`
--
ALTER TABLE `Status`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- Tilføj AUTO_INCREMENT i tabel `Uploads`
--
ALTER TABLE `Uploads`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=127;
--
-- Tilføj AUTO_INCREMENT i tabel `Users`
--
ALTER TABLE `Users`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=15;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
