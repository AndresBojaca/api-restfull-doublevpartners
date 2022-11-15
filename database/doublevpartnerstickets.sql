-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 15-11-2022 a las 00:59:55
-- Versión del servidor: 5.7.36
-- Versión de PHP: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `doublevpartnerstickets`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tickets`
--

DROP TABLE IF EXISTS `tickets`;
CREATE TABLE IF NOT EXISTS `tickets` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` varchar(256) NOT NULL,
  `create_date` date NOT NULL,
  `update_date` date NOT NULL,
  `status` enum('Abierto','Cerrado') DEFAULT 'Abierto',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=28 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tickets`
--

INSERT INTO `tickets` (`id`, `user`, `create_date`, `update_date`, `status`) VALUES
(1, '@AndresBojaca', '2022-11-12', '2022-11-12', 'Cerrado'),
(2, '@JhonDoe', '2022-11-11', '2022-11-12', 'Abierto'),
(3, '@JeffBezos', '2022-11-12', '2022-11-12', 'Abierto'),
(4, '@MarkZuckerberg', '2022-11-07', '2022-11-12', 'Abierto'),
(5, '@JulioDev', '2022-11-12', '2022-11-12', 'Abierto'),
(6, '@AndresTest', '2022-11-12', '2022-11-12', 'Abierto'),
(7, '@JeffBezosTest', '2022-11-12', '2022-11-12', 'Abierto'),
(8, '@NickFella', '2022-11-12', '2022-11-12', 'Abierto'),
(9, '@TimCook', '2022-11-12', '2022-11-12', 'Abierto'),
(10, '@SebPanessoEdit2', '2022-11-12', '2022-12-10', 'Abierto'),
(20, 'BojacaDEV', '2022-11-14', '2022-11-14', 'Abierto'),
(22, 'LorenaHoyos', '2022-11-14', '2022-11-14', 'Abierto'),
(21, 'BojacaAndresEdit', '2022-11-14', '2022-12-10', 'Abierto'),
(23, 'LorenaBarrientos', '2022-11-14', '2022-11-14', 'Abierto'),
(24, 'LorenaBarrientos', '2022-11-14', '2022-11-14', 'Abierto'),
(25, 'AndresBS', '2022-11-14', '2022-11-14', 'Abierto'),
(26, 'JorgeDev', '2022-11-14', '2022-11-14', 'Abierto'),
(27, 'JorgeDev', '2022-11-14', '2022-11-14', 'Abierto');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
