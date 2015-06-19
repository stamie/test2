-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Hoszt: 127.0.0.1
-- Létrehozás ideje: 2015. Jún 19. 12:00
-- Szerver verzió: 5.6.21
-- PHP verzió: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Adatbázis: `test`
--

--
-- A tábla adatainak kiíratása `client`
--

INSERT INTO `client` (`id`, `name`, `gender`) VALUES
(1, 'Sara O''Conor', 0),
(2, 'Sara Valaki', 0),
(3, 'Jamie Oliver', 1),
(4, 'J.K. Rowling', 0),
(5, 'Emese Stampel', 0),
(6, 'Sylvian Liege', 1),
(7, 'Jimmy Trukkos', 1),
(8, 'Dorota Valaki', 0),
(9, 'Sandra Bullock', 0);

--
-- A tábla adatainak kiíratása `transaction`
--

INSERT INTO `transaction` (`id`, `name`, `succes`, `sclient`, `tclient`, `amount`, `currency`, `date`, `comment`) VALUES
(1, 'Jewellery added', 1, 1, 4, 301, 'EUR', '2015-06-03 09:09:07', 'Thank you....'),
(2, 'computer bought', 0, 4, 3, 400, 'USD', '2015-06-16 13:25:42', 'Thats cool!');

--
-- A tábla adatainak kiíratása `user`
--

INSERT INTO `user` (`id`, `uname`, `name`, `password`) VALUES
(1, 'estampel', 'Emese Stampel', 'cb0c6087e4ea15223bb6265f79da5f7d'),
(2, 'liege', 'Sylvian Liege', 'f47dedf0d007bd6a3989a05706677c12');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
