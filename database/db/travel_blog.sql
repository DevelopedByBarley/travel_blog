-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Gép: 127.0.0.1
-- Létrehozás ideje: 2023. Feb 20. 15:26
-- Kiszolgáló verziója: 10.4.27-MariaDB
-- PHP verzió: 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Adatbázis: `travel_blog`
--

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `admin`
--

CREATE TABLE `admin` (
  `adminId` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- A tábla adatainak kiíratása `admin`
--

INSERT INTO `admin` (`adminId`, `email`, `password`) VALUES
(4, 'Barley@gmail.com', '$2y$10$wjHdZ8YrO1vU2etz73dY5OMPPBRdPkzCN2SAqjZJlmYA1M2rDKVr.');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `profile`
--

CREATE TABLE `profile` (
  `profileId` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `age` int(11) NOT NULL,
  `profileImage` varchar(255) NOT NULL,
  `editedAt` int(11) NOT NULL,
  `adminId` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- A tábla adatainak kiíratása `profile`
--

INSERT INTO `profile` (`profileId`, `name`, `email`, `age`, `profileImage`, `editedAt`, `adminId`) VALUES
(0, 'Szaniszló Árpád', 'Barley@gmail.com', 22, '159196372163f379fa12ea16.36798346.jpg', 1676900858, 4);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `trips`
--

CREATE TABLE `trips` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `content` mediumtext NOT NULL,
  `images` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `ratings` int(11) NOT NULL,
  `summary` varchar(1000) NOT NULL,
  `templateId` int(11) NOT NULL,
  `adminId` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexek a kiírt táblákhoz
--

--
-- A tábla indexei `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`adminId`);

--
-- A tábla indexei `profile`
--
ALTER TABLE `profile`
  ADD PRIMARY KEY (`profileId`),
  ADD KEY `adminId` (`adminId`);

--
-- A tábla indexei `trips`
--
ALTER TABLE `trips`
  ADD PRIMARY KEY (`id`),
  ADD KEY `adminId` (`adminId`);

--
-- A kiírt táblák AUTO_INCREMENT értéke
--

--
-- AUTO_INCREMENT a táblához `admin`
--
ALTER TABLE `admin`
  MODIFY `adminId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT a táblához `profile`
--
ALTER TABLE `profile`
  MODIFY `profileId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT a táblához `trips`
--
ALTER TABLE `trips`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=150;

--
-- Megkötések a kiírt táblákhoz
--

--
-- Megkötések a táblához `profile`
--
ALTER TABLE `profile`
  ADD CONSTRAINT `fk4` FOREIGN KEY (`adminId`) REFERENCES `admin` (`adminId`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Megkötések a táblához `trips`
--
ALTER TABLE `trips`
  ADD CONSTRAINT `fk1` FOREIGN KEY (`adminId`) REFERENCES `admin` (`adminId`) ON DELETE SET NULL ON UPDATE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
