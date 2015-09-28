-- phpMyAdmin SQL Dump
-- version 4.4.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Czas generowania: 28 Wrz 2015, 22:33
-- Wersja serwera: 5.6.26
-- Wersja PHP: 5.6.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `nowabaza`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `ekwipunek`
--

CREATE TABLE IF NOT EXISTS `ekwipunek` (
  `nazwa` varchar(255) NOT NULL,
  `param1` int(11) NOT NULL,
  `param2` int(11) NOT NULL,
  `cena` int(11) NOT NULL,
  `id_postaci` int(11) NOT NULL,
  `aktywne` int(11) NOT NULL,
  `typ` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Zrzut danych tabeli `ekwipunek`
--

INSERT INTO `ekwipunek` (`nazwa`, `param1`, `param2`, `cena`, `id_postaci`, `aktywne`, `typ`) VALUES
('produkt1', 1, 2, 30, 13, 0, 'bron'),
('produkt2', 2, 3, 35, 13, 0, 'zbroja');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `nowypoziom`
--

CREATE TABLE IF NOT EXISTS `nowypoziom` (
  `id` int(11) NOT NULL,
  `poziom` int(11) NOT NULL,
  `punkty` int(11) NOT NULL,
  `id_postaci` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Zrzut danych tabeli `nowypoziom`
--

INSERT INTO `nowypoziom` (`id`, `poziom`, `punkty`, `id_postaci`) VALUES
(1, 1, 0, 13);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `postac`
--

CREATE TABLE IF NOT EXISTS `postac` (
  `id` int(11) NOT NULL,
  `imie` varchar(255) NOT NULL,
  `sila` int(11) NOT NULL,
  `zrecznosc` int(11) NOT NULL,
  `szybkosc` int(11) NOT NULL,
  `zycie` int(11) NOT NULL,
  `zloto` int(11) NOT NULL,
  `dosw` int(11) NOT NULL,
  `wygrane` int(11) NOT NULL,
  `przegrane` int(11) NOT NULL,
  `id_uzytkownika` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

--
-- Zrzut danych tabeli `postac`
--

INSERT INTO `postac` (`id`, `imie`, `sila`, `zrecznosc`, `szybkosc`, `zycie`, `zloto`, `dosw`, `wygrane`, `przegrane`, `id_uzytkownika`) VALUES
(13, 'bbb', 1, 1, 1, 5, 10, 16, 0, 0, 2);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `przeciwnik`
--

CREATE TABLE IF NOT EXISTS `przeciwnik` (
  `id` int(11) NOT NULL,
  `imie` varchar(255) NOT NULL,
  `sila` int(11) NOT NULL,
  `szybkosc` int(11) NOT NULL,
  `zrecznosc` int(11) NOT NULL,
  `zycie` int(11) NOT NULL,
  `zloto` int(11) NOT NULL,
  `dosw` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Zrzut danych tabeli `przeciwnik`
--

INSERT INTO `przeciwnik` (`id`, `imie`, `sila`, `szybkosc`, `zrecznosc`, `zycie`, `zloto`, `dosw`) VALUES
(1, 'przeciwnik1', 1, 1, 1, 5, 20, 5),
(2, 'przeciwnik2', 1, 2, 2, 6, 30, 6),
(3, 'przeciwnik3', 3, 1, 2, 8, 50, 8),
(4, 'przeciwnik4', 2, 3, 4, 8, 60, 10),
(5, 'przeciwnik5', 4, 5, 6, 10, 100, 12);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `sklep`
--

CREATE TABLE IF NOT EXISTS `sklep` (
  `nazwa` varchar(255) NOT NULL,
  `param1` int(11) NOT NULL,
  `param2` int(11) NOT NULL,
  `cena` int(11) NOT NULL,
  `typ` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Zrzut danych tabeli `sklep`
--

INSERT INTO `sklep` (`nazwa`, `param1`, `param2`, `cena`, `typ`) VALUES
('produkt1', 1, 2, 30, 'bron'),
('produkt2', 2, 3, 35, 'zbroja'),
('produkt3', 3, 4, 50, 'bron'),
('produkt4', 5, 3, 150, 'zbroja'),
('produkt5', 5, 6, 200, 'bron');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `uzytkownik`
--

CREATE TABLE IF NOT EXISTS `uzytkownik` (
  `id` int(11) NOT NULL,
  `login` varchar(255) NOT NULL,
  `haslo` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Zrzut danych tabeli `uzytkownik`
--

INSERT INTO `uzytkownik` (`id`, `login`, `haslo`) VALUES
(2, 'aaa', 'aaa'),
(3, 'ccc', 'ccc'),
(5, 'ddd', 'ddd');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indexes for table `ekwipunek`
--
ALTER TABLE `ekwipunek`
  ADD PRIMARY KEY (`nazwa`),
  ADD KEY `id_postaci` (`id_postaci`);

--
-- Indexes for table `nowypoziom`
--
ALTER TABLE `nowypoziom`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_postaci` (`id_postaci`);

--
-- Indexes for table `postac`
--
ALTER TABLE `postac`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_uzytkownika` (`id_uzytkownika`),
  ADD KEY `id_uzytkownika_2` (`id_uzytkownika`),
  ADD KEY `id_uzytkownika_3` (`id_uzytkownika`);

--
-- Indexes for table `przeciwnik`
--
ALTER TABLE `przeciwnik`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sklep`
--
ALTER TABLE `sklep`
  ADD PRIMARY KEY (`nazwa`);

--
-- Indexes for table `uzytkownik`
--
ALTER TABLE `uzytkownik`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `nowypoziom`
--
ALTER TABLE `nowypoziom`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT dla tabeli `postac`
--
ALTER TABLE `postac`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT dla tabeli `przeciwnik`
--
ALTER TABLE `przeciwnik`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT dla tabeli `uzytkownik`
--
ALTER TABLE `uzytkownik`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
