-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 14-11-2023 a las 00:48:24
-- Versión del servidor: 10.4.24-MariaDB
-- Versión de PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `db_tpe`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `periferico`
--

CREATE TABLE `periferico` (
  `id` int(11) NOT NULL,
  `marca` varchar(45) NOT NULL,
  `precio` int(11) NOT NULL,
  `color` varchar(45) NOT NULL,
  `id_periferico` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `periferico`
--

INSERT INTO `periferico` (`id`, `marca`, `precio`, `color`, `id_periferico`) VALUES
(14, 'Logitech', 123123, 'azul', 'Pad'),
(15, 'Razer Deathadder', 60000, 'Negro', 'Mouse'),
(16, 'Genius', 10000, 'Negro', 'Mouse'),
(17, 'Glorious Model O', 55000, 'Blanco', 'Mouse'),
(18, 'Razer Gigantus V2', 13000, 'Negro', 'Pad'),
(19, 'Razer Barracuda X', 80000, 'Blanco', 'Auricular'),
(20, 'HyperX Alloy', 54300, 'Negro', 'Teclado'),
(21, 'Logitech G Wireless', 120000, 'Blanco', 'Auricular');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_periferico`
--

CREATE TABLE `tipo_periferico` (
  `id` int(11) NOT NULL,
  `id_periferico` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tipo_periferico`
--

INSERT INTO `tipo_periferico` (`id`, `id_periferico`) VALUES
(4, 'Auricular'),
(2, 'Mouse'),
(7, 'Pad'),
(6, 'Teclado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `username`, `password`) VALUES
(1, 'webadmin', '$2y$10$BDJ57thWjoNmCgsgCr6R7.AIcWLU59C7HkOyUn9W0bbP4l2pDKgBW');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `periferico`
--
ALTER TABLE `periferico`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_periferico` (`id_periferico`);

--
-- Indices de la tabla `tipo_periferico`
--
ALTER TABLE `tipo_periferico`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_periferico` (`id_periferico`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `periferico`
--
ALTER TABLE `periferico`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de la tabla `tipo_periferico`
--
ALTER TABLE `tipo_periferico`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `periferico`
--
ALTER TABLE `periferico`
  ADD CONSTRAINT `periferico_ibfk_1` FOREIGN KEY (`id_periferico`) REFERENCES `tipo_periferico` (`id_periferico`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
