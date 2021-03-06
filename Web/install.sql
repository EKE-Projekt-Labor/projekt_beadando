-- Gép: localhost
-- Létrehozás ideje: 2020. Jan 21.

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Adatbázis: `rft_elearning`
--

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `curriculum`
--

CREATE TABLE `curriculum` (
  `ID` int(11) NOT NULL,
  `CategoryID` int(11) NOT NULL,
  `CreatorID` int(11) NOT NULL,
  `Name` varchar(200) NOT NULL,
  `Content` varchar(20000) NOT NULL,
  `ClassID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `curriculum_category`
--

CREATE TABLE `curriculum_category` (
  `ID` int(11) NOT NULL,
  `Name` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `curriculum_read`
--

CREATE TABLE `curriculum_read` (
  `ID` int(11) NOT NULL,
  `CurriculumID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `Last` int(11) NOT NULL,
  `Max` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `test`
--

CREATE TABLE `test` (
  `ID` int(11) NOT NULL,
  `CurriculumID` int(11) NOT NULL,
  `Name` varchar(200) NOT NULL,
  `Content` varchar(20000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `test_solved`
--

CREATE TABLE `test_solved` (
  `ID` int(11) NOT NULL,
  `TestID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `Answers` varchar(20000) NOT NULL,
  `Date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


--
-- Tábla szerkezet ehhez a táblához `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(50) CHARACTER SET latin1 NOT NULL,
  `password` varchar(255) CHARACTER SET latin1 NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `permission` tinyint(1) NOT NULL DEFAULT '0',
  `ClassID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `user` (`id`, `username`, `password`, `created_at`, `permission`, `ClassID`) VALUES
(1, 'admin', '$2y$10$rxSk3dfo6Y/QIGkPrOn6E.bReUxTW6ZqzlhSIFFI3/tuuru.I0Lra', '2020-01-21 12:42:00', 9, 0);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `user_class`
--

CREATE TABLE `user_class` (
  `ID` int(11) NOT NULL,
  `Name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- -------------------------------------------------------

--
-- Indexek a kiírt táblákhoz
--

--
-- A tábla indexei `curriculum`
--
ALTER TABLE `curriculum`
  ADD PRIMARY KEY (`ID`);

--
-- A tábla indexei `curriculum_category`
--
ALTER TABLE `curriculum_category`
  ADD PRIMARY KEY (`ID`);

--
-- A tábla indexei `curriculum_read`
--
ALTER TABLE `curriculum_read`
  ADD PRIMARY KEY (`ID`);

--
-- A tábla indexei `test`
--
ALTER TABLE `test`
  ADD PRIMARY KEY (`ID`);

--
-- A tábla indexei `test_solved`
--
ALTER TABLE `test_solved`
  ADD PRIMARY KEY (`ID`);

--
-- A tábla indexei `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- A tábla indexei `user_class`
--
ALTER TABLE `user_class`
  ADD PRIMARY KEY (`ID`);
  
-- -------------------------------------------------------

--
-- A kiírt táblák AUTO_INCREMENT értéke
--

--
-- AUTO_INCREMENT a táblához `curriculum`
--
ALTER TABLE `curriculum`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT a táblához `curriculum_category`
--
ALTER TABLE `curriculum_category`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT a táblához `curriculum_read`
--
ALTER TABLE `curriculum_read`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT a táblához `test`
--
ALTER TABLE `test`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT a táblához `test_solved`
--
ALTER TABLE `test_solved`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT a táblához `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT a táblához `user_class`
--
ALTER TABLE `user_class`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;