-- Gép: localhost
-- Létrehozás ideje: 2020. Jan 21.

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

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
