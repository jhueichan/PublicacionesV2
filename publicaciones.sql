-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 10-05-2016 a las 11:30:51
-- Versión del servidor: 5.5.32
-- Versión de PHP: 5.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `publicaciones`
--
CREATE DATABASE IF NOT EXISTS `publicaciones` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `publicaciones`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `publicacion`
--

CREATE TABLE IF NOT EXISTS `publicacion` (
  `id_publicacion` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_publicacion` varchar(45) NOT NULL,
  `extension` varchar(3) NOT NULL,
  `fecha_mod` date DEFAULT NULL,
  PRIMARY KEY (`id_publicacion`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `publicacion`
--

INSERT INTO `publicacion` (`id_publicacion`, `nombre_publicacion`, `extension`, `fecha_mod`) VALUES
(1, 'libro go', 'pdf', '2015-12-14');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reparticion`
--

CREATE TABLE IF NOT EXISTS `reparticion` (
  `id_reparticion` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_rep` varchar(25) NOT NULL,
  PRIMARY KEY (`id_reparticion`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `reparticion`
--

INSERT INTO `reparticion` (`id_reparticion`, `nombre_rep`) VALUES
(1, 'cja');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE IF NOT EXISTS `rol` (
  `id_rol` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_rol` varchar(35) NOT NULL,
  PRIMARY KEY (`id_rol`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`id_rol`, `nombre_rol`) VALUES
(1, 'administrador'),
(2, 'mantenedor');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol_publicacion`
--

CREATE TABLE IF NOT EXISTS `rol_publicacion` (
  `id` int(10) NOT NULL,
  `publicacion_id_publicacion` int(11) NOT NULL,
  `rol_id_rol` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_publicacion_has_rol_rol1_idx` (`rol_id_rol`),
  KEY `fk_publicacion_has_rol_publicacion1_idx` (`publicacion_id_publicacion`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `rol_publicacion`
--

INSERT INTO `rol_publicacion` (`id`, `publicacion_id_publicacion`, `rol_id_rol`) VALUES
(1, 1, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE IF NOT EXISTS `usuario` (
  `id` int(11) NOT NULL,
  `rut` int(8) unsigned NOT NULL,
  `primer_nombre` varchar(15) NOT NULL,
  `segundo_nombre` varchar(15) DEFAULT NULL,
  `primer_apellido` varchar(15) NOT NULL,
  `segundo_apelllido` varchar(15) NOT NULL,
  `grado` varchar(15) DEFAULT NULL,
  `habilitado` tinyint(1) NOT NULL,
  `rol` int(11) NOT NULL,
  `reparticion` int(11) NOT NULL,
  `password` varchar(60) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_usuario_rol_idx` (`rol`),
  KEY `fk_usuario_reparticion1_idx` (`reparticion`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id`, `rut`, `primer_nombre`, `segundo_nombre`, `primer_apellido`, `segundo_apelllido`, `grado`, `habilitado`, `rol`, `reparticion`, `password`) VALUES
(1, 15296724, 'jorge', 'andres', 'hueichan', 'rumian', 'c1', 1, 1, 1, '1234');

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `rol_publicacion`
--
ALTER TABLE `rol_publicacion`
  ADD CONSTRAINT `fk_publicacion_has_rol_publicacion1` FOREIGN KEY (`publicacion_id_publicacion`) REFERENCES `publicacion` (`id_publicacion`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_publicacion_has_rol_rol1` FOREIGN KEY (`rol_id_rol`) REFERENCES `rol` (`id_rol`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `fk_usuario_reparticion1` FOREIGN KEY (`reparticion`) REFERENCES `reparticion` (`id_reparticion`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_usuario_rol` FOREIGN KEY (`rol`) REFERENCES `rol` (`id_rol`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
