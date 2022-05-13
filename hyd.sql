-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 20.04.2022 klo 11:39
-- Palvelimen versio: 10.4.22-MariaDB
-- PHP Version: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hyd`
--

-- --------------------------------------------------------

--
-- Rakenne taululle `bmi`
--

CREATE TABLE `bmi` (
  `aika` varchar(16) NOT NULL,
  `bmi` text NOT NULL,
  `hlon_ID` int(11) NOT NULL,
  `pituus` varchar(4) NOT NULL,
  `paino` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Vedos taulusta `bmi`
--

INSERT INTO `bmi` (`aika`, `bmi`, `hlon_ID`, `pituus`, `paino`) VALUES
('24.02.2022 08:01', '26', 637524, '1.75', 80);

-- --------------------------------------------------------

--
-- Rakenne taululle `käyttäjät`
--

CREATE TABLE `käyttäjät` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(100) COLLATE utf8_swedish_ci NOT NULL,
  `password` varchar(100) COLLATE utf8_swedish_ci NOT NULL,
  `päivä` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `email` text COLLATE utf8_swedish_ci NOT NULL,
  `oikeus` text COLLATE utf8_swedish_ci NOT NULL,
  `aktivoitu` text COLLATE utf8_swedish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci;

--
-- Vedos taulusta `käyttäjät`
--

INSERT INTO `käyttäjät` (`user_id`, `user_name`, `password`, `päivä`, `email`, `oikeus`, `aktivoitu`) VALUES
(123, 'aktiivitesti', 'kOk31lua', '2022-04-20 07:43:43', 'kokeilu@mail.com', 'user', 'ei'),
(2398, 'omena', '7410', '2022-04-20 06:19:44', '', 'user', 'on'),
(637524, 'antilooppi', '147', '2022-04-20 06:22:28', 'maili@email.com', 'admin', 'on'),
(3403836, 'kakkailuu', 'K4kkailuu', '2022-04-20 09:27:27', 'kakkailuu@email.com', 'user', 'ei'),
(25031127, 'test', '852', '2022-04-20 06:44:14', '', 'admin', 'on'),
(30761342, 'testi', '123', '2022-04-20 06:22:45', '', 'user', 'on'),
(67480188, 'esitelmöinti', '123', '2022-04-20 07:10:29', '', 'user', 'on'),
(213124132, 'kikkailuu', 'K1kkailuu', '2022-04-20 09:25:21', 'kikkailuu@email.com', 'user', 'ei'),
(2131234132, 'Kokkeiluu', 'salasana', '2022-04-20 09:02:01', 'kokkeiluu@email.com', 'user', 'ei'),
(2147483647, 'nina', '456', '2022-04-20 06:59:52', '', 'user', 'on');

-- --------------------------------------------------------

--
-- Rakenne taululle `sokeriarvot`
--

CREATE TABLE `sokeriarvot` (
  `hlon_ID` int(11) NOT NULL COMMENT 'henkilon id',
  `arvio` int(11) NOT NULL COMMENT 'arvio-/palautenro',
  `aika` varchar(16) NOT NULL,
  `s_arvo` varchar(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Vedos taulusta `sokeriarvot`
--

INSERT INTO `sokeriarvot` (`hlon_ID`, `arvio`, `aika`, `s_arvo`) VALUES
(637524, 2, '07.03.2022 12:30', '6.2'),
(637524, 2, '08.03.2022 13:52', '5.3'),
(637524, 2, '08.03.2022 10:55', '7.3'),
(637524, 2, '08.03.2022 11:07', '7.3'),
(637524, 2, '08.03.2022 11:08', '7.3'),
(637524, 3, '11.03.2022 13:21', '5.4'),
(637524, 3, '11.03.2022 13:21', '5.4'),
(637524, 1, '11.03.2022 13:37', '10'),
(637524, 1, '11.03.2022 13:38', '10.'),
(637524, 3, '14.03.2022 13:17', '5.4'),
(637524, 3, '14.03.2022 13:21', '5.4'),
(637524, 1, '15.03.2022 10:22', '10.6'),
(637524, 3, '07.02.2022.12:30', '5,6'),
(637524, 3, '17.03.2022 11:25', '5.4'),
(637524, 3, '07.04.2022 08:35', '5.6');

-- --------------------------------------------------------

--
-- Rakenne taululle `ssanavaihto`
--

CREATE TABLE `ssanavaihto` (
  `kayttajaID` int(11) NOT NULL,
  `koodi` text NOT NULL,
  `status` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Vedos taulusta `ssanavaihto`
--

INSERT INTO `ssanavaihto` (`kayttajaID`, `koodi`, `status`) VALUES
(637524, '8d9ag47ja', 'used'),
(637524, '84i7tad8d', 'used');

-- --------------------------------------------------------

--
-- Rakenne taululle `verenpaine`
--

CREATE TABLE `verenpaine` (
  `hlon_ID` int(11) NOT NULL COMMENT 'henkilon id',
  `arvio` int(11) NOT NULL COMMENT 'arvio-/palautenro',
  `aika` varchar(16) NOT NULL,
  `p_arvo` varchar(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Vedos taulusta `verenpaine`
--

INSERT INTO `verenpaine` (`hlon_ID`, `arvio`, `aika`, `p_arvo`) VALUES
(637524, 4, '22.03.2022 16:07', '10,6/54'),
(637524, 3, '22.03.2022 16:08', '125/85'),
(637524, 4, '15.03.2022 16:07', '10,6/54'),
(637524, 5, '23.03.2022 08:53', '120/100'),
(637524, 3, '07.04.2022 08:41', '120/15');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bmi`
--
ALTER TABLE `bmi`
  ADD KEY `hlon_ID` (`hlon_ID`);

--
-- Indexes for table `käyttäjät`
--
ALTER TABLE `käyttäjät`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `user_name` (`user_name`),
  ADD KEY `user_name_2` (`user_name`);

--
-- Indexes for table `sokeriarvot`
--
ALTER TABLE `sokeriarvot`
  ADD KEY `FK_id_kokeilu` (`hlon_ID`);

--
-- Indexes for table `ssanavaihto`
--
ALTER TABLE `ssanavaihto`
  ADD KEY `kayttajaID` (`kayttajaID`);

--
-- Indexes for table `verenpaine`
--
ALTER TABLE `verenpaine`
  ADD KEY `hlon_ID` (`hlon_ID`);

--
-- Rajoitteet vedostauluille
--

--
-- Rajoitteet taululle `bmi`
--
ALTER TABLE `bmi`
  ADD CONSTRAINT `bmi_ibfk_1` FOREIGN KEY (`hlon_ID`) REFERENCES `käyttäjät` (`user_id`);

--
-- Rajoitteet taululle `sokeriarvot`
--
ALTER TABLE `sokeriarvot`
  ADD CONSTRAINT `FK_id_kokeilu` FOREIGN KEY (`hlon_ID`) REFERENCES `käyttäjät` (`user_id`);

--
-- Rajoitteet taululle `ssanavaihto`
--
ALTER TABLE `ssanavaihto`
  ADD CONSTRAINT `ssanavaihto_ibfk_1` FOREIGN KEY (`kayttajaID`) REFERENCES `käyttäjät` (`user_id`);

--
-- Rajoitteet taululle `verenpaine`
--
ALTER TABLE `verenpaine`
  ADD CONSTRAINT `verenpaine_ibfk_1` FOREIGN KEY (`hlon_ID`) REFERENCES `käyttäjät` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
