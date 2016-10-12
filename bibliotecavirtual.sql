-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 02-06-2016 a las 23:29:46
-- Versión del servidor: 10.1.9-MariaDB
-- Versión de PHP: 5.5.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `bibliotecavirtual`
--
CREATE DATABASE IF NOT EXISTS `bibliotecavirtual` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `bibliotecavirtual`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compra`
--

CREATE TABLE `compra` (
  `id` int(11) NOT NULL,
  `idcliente` int(11) NOT NULL,
  `fecha` text NOT NULL,
  `valorcompra` double NOT NULL,
  `estado` text NOT NULL,
  `nombretc` text NOT NULL,
  `numerotc` text NOT NULL,
  `bancotc` text NOT NULL,
  `tipotc` text NOT NULL,
  `mestc` text NOT NULL,
  `aniotc` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `compra`
--

INSERT INTO `compra` (`id`, `idcliente`, `fecha`, `valorcompra`, `estado`, `nombretc`, `numerotc`, `bancotc`, `tipotc`, `mestc`, `aniotc`) VALUES
(2, 1, '2016-05-29 10:45:54', 80, '0', 'Abraham Garcia', '4242424242424242', 'Azteca', 'visa', '12', '2016');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contactos`
--

CREATE TABLE `contactos` (
  `Id` int(11) NOT NULL,
  `Nombre` text NOT NULL,
  `Email` text NOT NULL,
  `Telefono` text NOT NULL,
  `Mensaje` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `contactos`
--

INSERT INTO `contactos` (`Id`, `Nombre`, `Email`, `Telefono`, `Mensaje`) VALUES
(1, 'Abraham Garcia', 'abraheom@yahoo.es', '2890-9000', 'Edicion de contacto'),
(3, 'Abraham', 'joajoaaoa@gmail.com', '2222-2222', 'Este es un mensaje de prueba');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detallecompra`
--

CREATE TABLE `detallecompra` (
  `id` int(11) NOT NULL,
  `idcompra` int(11) NOT NULL,
  `producto` text NOT NULL,
  `precio` double NOT NULL,
  `cantidad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `detallecompra`
--

INSERT INTO `detallecompra` (`id`, `idcompra`, `producto`, `precio`, `cantidad`) VALUES
(1, 1, 'El Principito', 10, 8),
(2, 1, 'La seduccion de las palabras', 10, 3),
(3, 2, 'Productos', 10, 8);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `Id` int(11) NOT NULL,
  `Titulo` text NOT NULL,
  `Editorial` text NOT NULL,
  `Idioma` text NOT NULL,
  `FechaPublicacion` text NOT NULL,
  `Descripcion` text NOT NULL,
  `Precio` double NOT NULL,
  `Autor` text NOT NULL,
  `ImgPortada` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`Id`, `Titulo`, `Editorial`, `Idioma`, `FechaPublicacion`, `Descripcion`, `Precio`, `Autor`, `ImgPortada`) VALUES
(1, 'La vida del Koala ', 'EditorialSV', 'EspaÃ±ol', '10-05-2002', 'En este libro se narra la historia del koala', 10, 'Juan Perez', '163j8kd99m6105570375.jpg'),
(2, 'Productos...', 'Hoal', 'Espnish', '2005-2-3', 'doiefdof dfoidf dofid ', 10, 'Aoho', '53v770eukd3ph3c9dmfo.jpg'),
(3, 'odj', 'oahd', 'EspaÃ±ol', '2007-9-9', 'wwie wwioew woeiw', 25.5, 'sosdi', 'r2kfs4k6x7051az7z809.jpg'),
(4, 'Los Doce Hilos de Oro', 'Ediciones B., Barcelona (1999)', 'EspaÃ±ol', '1998-5-4', 'Literatura inglesa. Novela. Siglo XX. (821.111(71)-31"19") Folio. Barcelona. 2000. 21 cm. 221 p. il.', 20.1, 'Jose Mendez', 'jew095in49d3rx913gst.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `IdUsuario` int(11) NOT NULL,
  `tipoUsuario` text NOT NULL,
  `Nombres` text NOT NULL,
  `Apellidos` text NOT NULL,
  `Email` text NOT NULL,
  `Password` text NOT NULL,
  `Telefono` text NOT NULL,
  `FechaNacimiento` text NOT NULL,
  `Direccion` text NOT NULL,
  `ImgPerfil` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`IdUsuario`, `tipoUsuario`, `Nombres`, `Apellidos`, `Email`, `Password`, `Telefono`, `FechaNacimiento`, `Direccion`, `ImgPerfil`) VALUES
(1, 'Administrador', 'Julio Abraham...', 'Garcia Hernandez', 'abraheom@gmail.com', '123456', '7777-1111', '14-06-1995', 'Col Las Palmeras, Pol 10, Lot 10 Sacacoyo, ', 'd75co2p56o16ak815p6w.jpg'),
(2, 'Cliente', 'Juan Antonio', 'Perez Mendoza', 'juanperez@gmail.com', '123456', '2222-2222', '2012-2-13', 'San Salvador, San Salvador', 'profile_default.png');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `compra`
--
ALTER TABLE `compra`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `contactos`
--
ALTER TABLE `contactos`
  ADD PRIMARY KEY (`Id`);

--
-- Indices de la tabla `detallecompra`
--
ALTER TABLE `detallecompra`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`Id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`IdUsuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `compra`
--
ALTER TABLE `compra`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `contactos`
--
ALTER TABLE `contactos`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `detallecompra`
--
ALTER TABLE `detallecompra`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `IdUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
