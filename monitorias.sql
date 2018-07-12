-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 12-07-2018 a las 15:27:35
-- Versión del servidor: 10.1.10-MariaDB
-- Versión de PHP: 5.6.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `monitorias`
--
CREATE DATABASE IF NOT EXISTS `monitorias` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `monitorias`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `listado_monitorias`
--

CREATE TABLE IF NOT EXISTS `listado_monitorias` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `materia` varchar(50) NOT NULL,
  `monitor_id` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `salon` int(5) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `monitor_id` (`monitor_id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

--
-- Estructura de tabla para la tabla `monitores`
--

CREATE TABLE IF NOT EXISTS `monitores` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cedula` int(11) NOT NULL,
  `nombres` varchar(30) NOT NULL,
  `apellidos` varchar(30) NOT NULL,
  `programa_academico` varchar(50) NOT NULL,
  `semestre` int(2) NOT NULL,
  `email` varchar(70) NOT NULL,
  `telefono` int(12) NOT NULL,
  `direccion` varchar(70) NOT NULL,
  `celular` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `monitores`
--


/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
