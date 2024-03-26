-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 11, 2023 at 10:11 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fotbal`
--

-- --------------------------------------------------------

--
-- Table structure for table `antrenori`
--

CREATE TABLE `antrenori` (
  `Id` int(11) NOT NULL,
  `Nume` varchar(30) NOT NULL,
  `Prenume` varchar(30) NOT NULL,
  `Club` varchar(40) NOT NULL,
  `Certificare` varchar(10) NOT NULL,
  `Varsta` int(11) NOT NULL,
  `Poza` varchar(255) NOT NULL,
  `DataCrearii` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `antrenori`
--

INSERT INTO `antrenori` (`Id`, `Nume`, `Prenume`, `Club`, `Certificare`, `Varsta`, `Poza`, `DataCrearii`) VALUES
(1, 'Carlo', 'Ancelotti', 'Real_Madrid', 'A+', 64, 'images/anceloti.jpg', '2023-10-24 09:47:38'),
(2, 'Tuchel', 'Thomas', 'Bayern_Munchen', 'B++', 49, 'images/tuchel.jpg', '2023-10-24 09:47:38'),
(3, 'Mourinho', 'Jose', 'Roma', 'A+', 56, 'images/jose.jpg', '2023-11-09 07:38:21');

-- --------------------------------------------------------

--
-- Table structure for table `club`
--

CREATE TABLE `club` (
  `Id` int(11) NOT NULL,
  `Nume` varchar(40) NOT NULL,
  `Jucatori` int(11) NOT NULL,
  `Antrenor` varchar(40) NOT NULL,
  `Pret` double NOT NULL,
  `Logo` varchar(255) NOT NULL,
  `DataCrearii` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `club`
--

INSERT INTO `club` (`Id`, `Nume`, `Jucatori`, `Antrenor`, `Pret`, `Logo`, `DataCrearii`) VALUES
(1, 'Newcastle', 30, 'Nick Pope', 884, 'images/newcastle.png', '2023-10-31 08:14:56'),
(2, 'PSG', 28, 'Luis Enrique', 985, 'images/psgold.png', '2023-10-31 08:18:04'),
(3, 'Nice', 25, 'Andre Boash', 341, 'images/nice.png', '2023-10-31 08:18:31'),
(4, 'Milan', 28, 'Stefano Pioli', 810, 'images/milan.png', '2023-11-07 09:31:50'),
(5, 'BayernMunich', 32, 'Thomas Tuchel', 998, 'images/bayern.png', '2023-11-30 10:29:45'),
(6, 'RealMadrid', 30, 'Carlo Anceloti', 1024, 'images/real.png', '2023-11-30 10:31:23'),
(7, 'Barcelona', 29, 'Xavi', 940, 'images/barcelona.png', '2023-11-30 10:47:54'),
(8, 'Liverpool', 28, 'Jurken Kloop', 877, 'images/liverpool.png', '2023-12-08 10:21:22');

-- --------------------------------------------------------

--
-- Table structure for table `jucatori`
--

CREATE TABLE `jucatori` (
  `Id` int(11) NOT NULL,
  `Nume` varchar(30) NOT NULL,
  `Prenume` varchar(30) NOT NULL,
  `Club` varchar(40) NOT NULL,
  `Pozitia` varchar(20) NOT NULL,
  `Varsta` int(11) NOT NULL,
  `Poza` varchar(255) NOT NULL,
  `DataCrearii` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jucatori`
--

INSERT INTO `jucatori` (`Id`, `Nume`, `Prenume`, `Club`, `Pozitia`, `Varsta`, `Poza`, `DataCrearii`) VALUES
(1, 'Modric', 'Luka', 'RealMadrid', 'Mijlocas', 39, 'images/modric.png', '2023-10-24 09:44:21'),
(2, 'Kane', 'Harry', 'BayernMunich', 'Atacant', 30, 'images/kane.png', '2023-10-24 09:44:21'),
(3, 'Becker', 'Alisson', 'Liverpool', 'Portar', 29, 'images/alisson.png', '2023-10-31 09:06:56'),
(4, 'Lewandowski', 'Robert', 'Barcelona', 'Atacant', 34, 'images/lewaaa.png', '2023-11-14 08:40:39'),
(5, 'Muller', 'Thomas', 'BayernMunich', 'Mijlocas', 32, 'images/muller.png', '2023-11-30 10:33:52'),
(6, 'Neuer', 'Manuel', 'BayernMunich', 'Portar', 35, 'images/neuer.png', '2023-11-30 10:34:40'),
(7, 'Kylian', 'Mbappe', 'PSG', 'Atacant', 23, 'images/mbappe.png', '2023-11-30 10:36:06'),
(8, 'Kiran', 'Tripier', 'Newcastle', 'Fundas', 28, 'images/tripierrr.png', '2023-11-30 10:37:14'),
(9, 'David', 'Alaba', 'RealMadrid', 'Fundas', 30, 'images/davidalaba.png', '2023-11-30 10:40:05'),
(10, 'Leao', 'Rafael', 'Milan', 'Atacant', 26, 'images/leao.png', '2023-11-30 10:40:45'),
(11, 'Goes', 'Rodrygo', 'RealMadrid', 'Atacant', 22, 'images/rodrugo.png', '2023-11-30 10:42:21'),
(12, 'Salah', 'Mohamed', 'Liverpool', 'Atacant', 33, 'images/salah.png', '2023-11-30 10:43:55'),
(13, 'Hernandez', 'Theo', 'Milan', 'Fundas', 24, 'images/hernandez.png', '2023-11-30 10:44:30'),
(14, 'Khephren', 'Thuram', 'Nice', 'Fundas', 23, 'images/thuram.png', '2023-11-30 10:45:40'),
(15, 'deJong', 'Frenkie', 'Barcelona', 'Mijlocas', 27, 'images/dejong.png', '2023-11-30 10:47:26'),
(17, 'Isak', 'Alexander', 'Newcastle', 'Atacant', 27, 'images/isak.png', '2023-12-11 06:26:02'),
(18, 'Musiala', 'Jamal', 'BayernMunich', 'Atacant', 23, 'images/musiala.png', '2023-12-11 06:26:56'),
(19, 'Dembele', 'Ousman', 'PSG', 'Atacant', 27, 'images/dembele.png', '2023-12-11 06:27:19'),
(20, 'Gavi', 'Pablo', 'Barcelona', 'Mijlocas', 22, 'images/gavi.png', '2023-12-11 06:28:02'),
(21, 'Ramsey', 'Aaron', 'Nice', 'Mijlocas', 35, 'images/ramsey.png', '2023-12-11 06:28:34'),
(22, 'Joelinton', 'Mark', 'Newcastle', 'Mijlocas', 27, 'images/joelinton.png', '2023-12-11 06:29:41'),
(23, 'Marquinios', 'Aos', 'PSG', 'Fundas', 31, 'images/marquinios.png', '2023-12-11 06:30:22'),
(24, 'Giroud', 'Olivier', 'Milan', 'Atacant', 34, 'images/giroud.png', '2023-12-11 06:32:04'),
(25, 'Moffi', 'Terem', 'Nice', 'Atacant', 28, 'images/moffi.png', '2023-12-11 06:34:28'),
(26, 'Courtois', 'Thibaut', 'RealMadrid', 'Portar', 31, 'images/courtois.png', '2023-12-11 06:36:16'),
(27, 'Pepe', 'Nicolas', 'Nice', 'Atacant', 30, 'images/pepe.png', '2023-12-11 06:36:50'),
(28, 'Diaz', 'Luis', 'Liverpool', 'Atacant', 26, 'images/diaz.png', '2023-12-11 06:39:57'),
(29, 'MacAlister', 'Alexis', 'Liverpool', 'Mijlocas', 27, 'images/macalister.png', '2023-12-11 06:40:29'),
(30, 'Junior', 'Vinicius', 'RealMadrid', 'Atacant', 24, 'images/vini.png', '2023-12-11 06:42:30'),
(31, 'Araujo', 'Ronald', 'Barcelona', 'Fundas', 25, 'images/arauho.png', '2023-12-11 06:48:59'),
(32, 'Robertson', 'Andrew', 'Liverpool', 'Fundas', 27, 'images/robertsosn.png', '2023-12-11 06:50:34'),
(33, 'Varrati', 'Marco', 'PSG', 'Mijlocas', 30, 'images/verati.png', '2023-12-11 06:51:51'),
(34, 'Loftus', 'Ruben', 'Milan', 'Mijlocas', 27, 'images/loftus.png', '2023-12-11 06:53:35'),
(35, 'Pope', 'Nick', 'Newcastle', 'Portar', 26, 'images/pope.png', '2023-12-11 06:54:48'),
(36, 'Gordon', 'Anthony', 'Newcastle', 'Atacant', 21, 'images/gordon.png', '2023-12-11 06:57:51');

-- --------------------------------------------------------

--
-- Table structure for table `liga`
--

CREATE TABLE `liga` (
  `Id` int(11) NOT NULL,
  `Nume` varchar(40) NOT NULL,
  `Tara` varchar(255) NOT NULL,
  `Nr_Echipe` int(11) NOT NULL,
  `Lider` varchar(30) NOT NULL,
  `Logo` varchar(255) NOT NULL,
  `DataCrearii` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `liga`
--

INSERT INTO `liga` (`Id`, `Nume`, `Tara`, `Nr_Echipe`, `Lider`, `Logo`, `DataCrearii`) VALUES
(1, 'La_Liga', 'Spania', 19, 'RealMadrid', 'images/laliga.png', '2023-10-24 09:43:22'),
(2, 'Premier_League', 'Anglia', 20, 'Arsenal', 'images/premier.png', '2023-10-24 09:43:22'),
(3, 'Bundesliga', 'Germania', 18, 'BayerLeverkusen', 'images/bundes.png', '2023-11-09 07:14:38'),
(4, 'Ligue1', 'Franta', 18, 'PSG', 'images/lihue1.png', '2023-11-30 10:52:19'),
(5, 'Serie A', 'Italia', 20, 'Inter', 'images/seriea.png', '2023-11-30 10:53:32');

-- --------------------------------------------------------

--
-- Table structure for table `stadion`
--

CREATE TABLE `stadion` (
  `Id` int(11) NOT NULL,
  `Nume` varchar(40) NOT NULL,
  `Adresa` varchar(40) NOT NULL,
  `Capacitate` double NOT NULL,
  `Echipa` varchar(50) NOT NULL,
  `Poza` varchar(255) NOT NULL,
  `DataCrearii` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `stadion`
--

INSERT INTO `stadion` (`Id`, `Nume`, `Adresa`, `Capacitate`, `Echipa`, `Poza`, `DataCrearii`) VALUES
(1, 'Stamford Bridge', 'str Greenwood 1', 75000, 'Chelsea', 'images/stamford.jpg', '2023-10-24 09:39:18'),
(2, 'Old Trafford', 'str Kingdom 7', 67000, 'Manchester United', 'images/trafford.jpg', '2023-10-24 09:41:58'),
(3, 'Camp', 'str Spain 9', 85000, 'Barcelona', 'images/camp.jpg', '2023-10-24 09:41:58'),
(4, 'Alianz Arena', 'bd', 85000, 'Bayern', 'images/alianzarena.png', '2023-11-09 06:39:22');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `Poza` varchar(255) NOT NULL,
  `Data_crearii` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `Poza`, `Data_crearii`) VALUES
(1, 'admin', 'dragoshisca@gmail.com', 'admin\r\n', '', '2023-12-09 15:14:41'),
(2, 'Dragos1', 'dragoschisca@gmail.com', '12345', '', '2023-12-09 15:25:05');

-- --------------------------------------------------------

--
-- Table structure for table `users_jucatori`
--

CREATE TABLE `users_jucatori` (
  `Id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `jucator_id` int(11) NOT NULL,
  `pozitia` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users_jucatori`
--

INSERT INTO `users_jucatori` (`Id`, `user_id`, `jucator_id`, `pozitia`) VALUES
(10, 1, 11, '10'),
(11, 1, 2, '9'),
(12, 1, 1, '7'),
(13, 1, 5, '6'),
(14, 1, 15, '8'),
(15, 1, 13, '2'),
(16, 1, 8, '3'),
(17, 1, 3, '1'),
(18, 1, 7, '11'),
(19, 1, 14, '5'),
(20, 1, 9, '4'),
(22, 2, 1, '7'),
(23, 2, 2, '10'),
(24, 2, 11, '11'),
(25, 2, 7, '10'),
(26, 2, 4, '10'),
(27, 2, 15, '7'),
(28, 2, 10, '9'),
(29, 2, 2, '10'),
(30, 2, 13, '3'),
(31, 2, 6, '1'),
(32, 2, 24, '10'),
(33, 2, 20, '8');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `antrenori`
--
ALTER TABLE `antrenori`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `club`
--
ALTER TABLE `club`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `jucatori`
--
ALTER TABLE `jucatori`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `liga`
--
ALTER TABLE `liga`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `stadion`
--
ALTER TABLE `stadion`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_jucatori`
--
ALTER TABLE `users_jucatori`
  ADD PRIMARY KEY (`Id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `antrenori`
--
ALTER TABLE `antrenori`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `club`
--
ALTER TABLE `club`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `jucatori`
--
ALTER TABLE `jucatori`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `liga`
--
ALTER TABLE `liga`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `stadion`
--
ALTER TABLE `stadion`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users_jucatori`
--
ALTER TABLE `users_jucatori`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
