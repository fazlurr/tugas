-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 24, 2013 at 07:02 AM
-- Server version: 5.5.27
-- PHP Version: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `artis`
--

-- --------------------------------------------------------

--
-- Table structure for table `biodata`
--

CREATE TABLE IF NOT EXISTS `biodata2` (
  `id_artis` int(5) NOT NULL AUTO_INCREMENT,
  `nama` char(35) NOT NULL,
  `foto` longblob NOT NULL,
  `dob` date NOT NULL,
  `tl` varchar(30) NOT NULL,
  `jk` char(1) NOT NULL,
  `tinggi` float NOT NULL,
  PRIMARY KEY (`id_artis`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `biodata`
--

INSERT INTO `biodata` (`id_artis`, `nama`, `foto`, `dob`, `tl`, `jk`, `tinggi`) VALUES
(1, 'Joseph Gordon-Levitt', '', '1981-02-17', 'Los Angeles, California, U.S.', 'l', 1.78),
(2, 'Tom Hardy', '', '1977-09-15', 'Hammersmith, England', 'l', 1.75),
(3, 'Christian Bale', '', '1974-01-30', 'Haverfordwest, Wales', 'l', 1.83),
(4, 'Anne Hathaway', '', '1982-11-12', 'Brooklyn, U.S.', 'p', 1.73),
(5, 'Gary Oldman', '', '1958-03-21', 'New Cross, London, England', 'l', 1.78),
(6, 'Marion Cotillard', '', '1975-09-30', 'Paris, France', 'p', 1.69);
INSERT INTO `biodata` (`id_artis`, `nama`, `foto`, `dob`, `tl`, `jk`, `tinggi`) VALUES
(7, 'Michael Caine', '', '1933-03-14', 'Rotherhithe, London, England', 'l', 1.88),
(8, 'Morgan Freeman', '', '1937-06-01', 'Memphis, U.S.', 'l', 1.88),
(9, 'Liam Neeson', '', '1952-06-07', 'Ballymena, Northern Ireland', 'l', 1.93),
(10, 'Heath Ledger', '', '1979-04-04', 'Perth, Australia', 'l', 1.85);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
