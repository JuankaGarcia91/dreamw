-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 22-06-2016 a las 23:17:56
-- Versión del servidor: 10.1.13-MariaDB
-- Versión de PHP: 5.5.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `personeria`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `login`
--

CREATE TABLE `login` (
  `cod` int(50) NOT NULL,
  `usuario` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `contrasena` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `tipo` varchar(10) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `login`
--

INSERT INTO `login` (`cod`, `usuario`, `contrasena`, `tipo`) VALUES
(1, 'mono', 'mono', 'admin'),
(8, 'dani', 'dani', 'consul'),
(10, 'roca', 'roca', 'consul');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `persona`
--

CREATE TABLE `persona` (
  `cedula` int(15) NOT NULL,
  `fecha` date NOT NULL,
  `asunto` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  `primer_nombre` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `segundo_nombre` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `primer_apellido` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `segundo_apellido` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `fijo` int(10) DEFAULT NULL,
  `celular` varchar(14) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `direccion` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `barrio` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `descripcion` text CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `persona`
--

INSERT INTO `persona` (`cedula`, `fecha`, `asunto`, `primer_nombre`, `segundo_nombre`, `primer_apellido`, `segundo_apellido`, `fijo`, `celular`, `direccion`, `barrio`, `descripcion`) VALUES
(966, '2015-09-12', 'salud', 'manuela', 'estefania', 'cardona', 'lopez', 9876658, '658978068', 'carrera 5 11 41', 'Jorge Eliecer Gaitan', 'Jorge Eliecer Gaitan'),
(698554, '2015-10-15', 'ruralidad', 'geral', 'daniela', 'penagos', 'rendon', 4708069, '906956765437', 'carrera 17a 6b 21', 'parque', 'parque'),
(869324, '2015-09-05', 'd. comercial', 'jorge', 'fenibal', 'arias', 'ramires', 9876897, '987698', 'calle 7 5- 24', 'parque', 'comentario'),
(1234325, '2015-09-10', 'dcomercial', 'maria', 'fernanda', 'cortez', 'marin', 43635, '54326', 'carrera 4 9 36', 'parque', 'parque'),
(10534764, '2011-07-14', 'adulto mayor', 'cristian ', 'david', 'villa', 'gomez', 8856584, '3145728976', 'carrera 9 a 1 32', 'gaitan', 'no tengo nadie quien me cuide'),
(30288816, '1998-04-18', 'ruralidad', 'Maria', 'Eugenia', 'Cortes', 'marin', 8910281, '3137507196', 'calle 6 3 56', 'parque', 'no tengo los recursos necesarios para salir de lo rural'),
(78932649, '2015-09-10', 'predial', 'luisa', 'maria', 'tabares', 'lince', 890695, '9876897', 'celle', '', 'lince'),
(309874756, '2012-10-18', 'd. comercial', 'Roberto', 'Carlos', 'Suarez', 'Rodriguez', 8776908, '3109874565', 'calle 14 n 70-60', '', 'no tengo buenos contactos y tengo un negocio'),
(1053467832, '2008-11-19', 'pension', 'Daniela', '', 'Caro', 'Garcia', 8876523, '3129987635', 'cra 17 n 70-60', '', 'no me llega la pension hace tres meses '),
(1053467876, '2006-07-11', 'd. comercial', 'Geraldine', '', 'Penagos', 'Rodriguez', 8876537, '3156782343', 'cra 16 n 70-50', '', 'no me venden productos de buena calidad'),
(1053478654, '2011-07-14', 'adulto mayor', 'cristian ', 'david', 'villa', 'gomez', 8856584, '3145728976', 'calle 16 n 56-26', '', 'no tengo nadie quien me cuide'),
(1053487654, '2013-11-10', 'predial', 'Daniel', 'Leandro', 'Diaz', 'Toro', 8976534, '312987456', 'cra 20 n67-40', '', 'no me llegan las facturas '),
(1053579813, '2010-05-21', 'vivienda', 'julian', 'Andres', 'Garcia', 'Garcia', 8897654, '3142564327', 'cra 17 n-15-50', '', 'no tengo como pagar el arrendo \r\n'),
(1053812949, '2006-02-27', 'salud', 'luisa', 'fernanda', 'Morales', 'Zuluaga', 8796543, '3186376542', 'cra 16 n 38-70', '', 'no tengo una buena eps'),
(1053844842, '1998-01-23', 'd. laboral', 'Daniel', 'Felipe', 'Gutierrez', 'Agudelo', 8862593, '3206820950', 'calle 48 n 16-10', '', 'no tengo como conseguir trabajo '),
(1053859271, '2014-10-23', 'd. familiar', 'Maria', 'Geraldin', 'Roncasio', 'Marin', 8776543, '3214577822', 'cra 17 n 48-60', '', 'peleo mucho con mi familia'),
(1060651901, '2015-09-18', 'dfamiliar', 'daniel', 'alejandro', 'uribe', 'londoÃ±o', 8907008, '2147483647', 'carrera 8', '', 'yo'),
(1060651902, '2015-10-06', 'vic. conflicto armado', 'daniel', 'uribe', 'londoÃ±o', 'Garcia', 8907008, '3127236564', 'carrera 8c #1-21', '', 'esta es la descripcion'),
(1076234567, '1995-10-04', 'educacion', 'Maria', 'Camila', 'Piedrahita', 'Linares', 8773391, '3105998146', 'calle 48 n 18-39', '', 'realmente no resibo una educaciÃ³n buena'),
(2147483647, '2015-09-08', 'salud', 'lucero', 'maria', 'londoÃ±o', 'giraldo', 3208478, '3127236564', 'dafajsk', '', 'ldsfÃ±');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`cod`);

--
-- Indices de la tabla `persona`
--
ALTER TABLE `persona`
  ADD PRIMARY KEY (`cedula`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `login`
--
ALTER TABLE `login`
  MODIFY `cod` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
