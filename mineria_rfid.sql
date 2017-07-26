-- phpMyAdmin SQL Dump
-- version 4.4.10
-- http://www.phpmyadmin.net
--
-- Servidor: localhost:8889
-- Tiempo de generación: 11-05-2017 a las 17:11:24
-- Versión del servidor: 5.5.42
-- Versión de PHP: 5.5.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `mineria_rfid`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id_rol` int(11) NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `clave` varchar(50) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellido` varchar(50) NOT NULL,
  `correo` varchar(50) NOT NULL,
  `rut` varchar(50) NOT NULL,
  `url_foto` varchar(50) NOT NULL,
  `id_perfil` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id_rol`, `usuario`, `clave`, `nombre`, `apellido`, `correo`, `rut`, `url_foto`, `id_perfil`) VALUES
(1, 'pablo', '707d14912bb250caf67dfe0ea4035681fbfc4f56', 'Pablo', 'Figueroa', 'pfigueroap.plaza@gmail.com', '16.016.083-7', '', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id_user` int(11) NOT NULL,
  `name_1` varchar(50) NOT NULL,
  `name_2` varchar(50) NOT NULL,
  `apellido_1` varchar(50) NOT NULL,
  `apellido_2` varchar(50) NOT NULL,
  `correo` varchar(50) NOT NULL,
  `rut` varchar(50) NOT NULL,
  `id_camara_fac` int(11) NOT NULL,
  `id_user_camara` int(11) NOT NULL,
  `genero` int(11) NOT NULL,
  `f_enrol` date NOT NULL,
  `f_ingsist` date NOT NULL,
  `id_nacion` int(11) NOT NULL,
  `cod_trab` int(11) NOT NULL,
  `id_cargo` int(11) NOT NULL,
  `id_ubica` int(11) NOT NULL,
  `id_empresa` int(11) NOT NULL,
  `celular` varchar(50) NOT NULL,
  `id_perfil` int(11) NOT NULL,
  `url_foto` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id_user`, `name_1`, `name_2`, `apellido_1`, `apellido_2`, `correo`, `rut`, `id_camara_fac`, `id_user_camara`, `genero`, `f_enrol`, `f_ingsist`, `id_nacion`, `cod_trab`, `id_cargo`, `id_ubica`, `id_empresa`, `celular`, `id_perfil`, `url_foto`) VALUES
(1, 'Pablo', 'Andrés', 'Figueroa', 'Plaza', 'pfigueroap.plaza@gmail.com', '16.016.083-7', 1, 1, 1, '2017-04-04', '2017-04-01', 1, 1111, 1, 1, 1, '+56965690990', 1, '');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id_rol`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id_rol` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
