-- phpMyAdmin SQL Dump
-- version 4.4.10
-- http://www.phpmyadmin.net
--
-- Servidor: localhost:8889
-- Tiempo de generación: 26-07-2017 a las 18:35:53
-- Versión del servidor: 5.5.42
-- Versión de PHP: 5.5.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `garetto`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compra`
--

CREATE TABLE `compra` (
  `id_compra` int(11) NOT NULL,
  `tipo_pago` varchar(50) NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `f_compra` date NOT NULL,
  `h_compra` time NOT NULL,
  `validador` int(11) NOT NULL,
  `f_validacion` date NOT NULL,
  `h_validacion` time NOT NULL,
  `despacho` varchar(50) NOT NULL,
  `direccion` varchar(255) NOT NULL,
  `total` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `compra`
--

INSERT INTO `compra` (`id_compra`, `tipo_pago`, `usuario`, `f_compra`, `h_compra`, `validador`, `f_validacion`, `h_validacion`, `despacho`, `direccion`, `total`) VALUES
(1, 'transferencia', 'pablo', '2017-07-13', '16:30:29', 0, '0000-00-00', '00:00:00', 'personal', 'central uno, 8659, La Florida', 2800);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contacto`
--

CREATE TABLE `contacto` (
  `id_contacto` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `asunto` varchar(255) NOT NULL,
  `mensaje` text NOT NULL,
  `fecha` date NOT NULL,
  `hora` time NOT NULL,
  `user` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `contacto`
--

INSERT INTO `contacto` (`id_contacto`, `nombre`, `email`, `asunto`, `mensaje`, `fecha`, `hora`, `user`) VALUES
(1, 'Pablo', 'pfigueroap.plaza@gmail.com', 'consulta', 'como esta todo ?', '2017-07-21', '18:32:37', 'pablo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empresa`
--

CREATE TABLE `empresa` (
  `id_empresa` int(11) NOT NULL,
  `empresa` varchar(255) NOT NULL,
  `direccion` varchar(255) NOT NULL,
  `rut` varchar(50) NOT NULL,
  `giro` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `empresa`
--

INSERT INTO `empresa` (`id_empresa`, `empresa`, `direccion`, `rut`, `giro`) VALUES
(1, 'Bprog Informática', 'Av. Providencia, 1945, Providencia', '77.199.300-1', 'Servicios Profesionales');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `moneda`
--

CREATE TABLE `moneda` (
  `id_moneda` int(11) NOT NULL,
  `moneda` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `moneda`
--

INSERT INTO `moneda` (`id_moneda`, `moneda`) VALUES
(1, 'CLP'),
(2, 'USD');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `nacion`
--

CREATE TABLE `nacion` (
  `id_nacion` int(11) NOT NULL,
  `nacion` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `nacion`
--

INSERT INTO `nacion` (`id_nacion`, `nacion`) VALUES
(1, 'Chile'),
(2, 'Argentina');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `page`
--

CREATE TABLE `page` (
  `id_page` int(11) NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `valor` varchar(50) NOT NULL,
  `rotar` varchar(255) NOT NULL,
  `sec1_tit` varchar(255) NOT NULL,
  `sec1_desc` varchar(500) NOT NULL,
  `sec1_stit` varchar(255) NOT NULL,
  `sec1_det` text NOT NULL,
  `sec2_tit` varchar(255) NOT NULL,
  `sec2_desc` varchar(500) NOT NULL,
  `sec2_1_tit` varchar(255) NOT NULL,
  `sec2_1_desc` varchar(500) NOT NULL,
  `sec2_2_tit` varchar(255) NOT NULL,
  `sec2_2_desc` varchar(500) NOT NULL,
  `sec2_3_tit` varchar(255) NOT NULL,
  `sec2_3_desc` varchar(500) NOT NULL,
  `sec3_tit` varchar(255) NOT NULL,
  `sec3_desc` varchar(500) NOT NULL,
  `sec4_tit` varchar(255) NOT NULL,
  `sec4_desc` varchar(500) NOT NULL,
  `sec4_direc` varchar(255) NOT NULL,
  `sec4_comuna` varchar(50) NOT NULL,
  `sec4_email` varchar(100) NOT NULL,
  `sec4_tel` varchar(50) NOT NULL,
  `user` varchar(50) NOT NULL,
  `fecha` date NOT NULL,
  `hora` time NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `page`
--

INSERT INTO `page` (`id_page`, `titulo`, `valor`, `rotar`, `sec1_tit`, `sec1_desc`, `sec1_stit`, `sec1_det`, `sec2_tit`, `sec2_desc`, `sec2_1_tit`, `sec2_1_desc`, `sec2_2_tit`, `sec2_2_desc`, `sec2_3_tit`, `sec2_3_desc`, `sec3_tit`, `sec3_desc`, `sec4_tit`, `sec4_desc`, `sec4_direc`, `sec4_comuna`, `sec4_email`, `sec4_tel`, `user`, `fecha`, `hora`) VALUES
(1, '125 años de experiencia', 'Creamos', 'sellos personales, autenticidad, confianza', 'Sobre Nosotros', 'Ser los primeros, también nos hizo ser los mejores', 'Ofrecemos grandes servicios e ideas', 'Somos una empresa especializada en todo tipo de timbres, los cuales se adaptan al uso de cada persona, dependiendo de sus necesidades.\n\nAdemás de ofrecer una amplia gama de equipos financieros y maquinas para el manejo de efectivo.\n\nContamos con un sin fin de productos para su oficina, negocio o empresa.\n\nPoseémos 125 años de expriencia fabricando timbres de goma, timbres de metal, microporosos y le damos toda la dedicacion a nuestros productos.\n\nGracias a todos nuestros años y esfuerzos, hemos logrado liderar el negocio de las personalizaciones y autentificaciones para las pequeñas y grandes empresas.\n                            ', 'Nuestros Servicios', 'Gracias a Garetto, es que Chile es el único país que llama "Timbres" a los sellos de goma. Somos una empresa especializada en todo tipo de timbres, los cuales se adaptan al uso de cada persona, dependiendo de sus necesidades. Recuerde que cada timbre es su sello personal, único, y un reflejo de lo que desea autentificar. Revise nuestro amplio catálogo, que cuenta con todo tipo de timbres.\n                            ', 'Hardwares', 'Contamos con diversos tipos de hardwares, ven a verlos!\n                            ', 'Software', 'Nuestros softwares proporcionaran exito y ganancias a sus empresa\n                            ', 'Packs', 'Tanto software como hardware en esta seccion, ven a ver nuestras ofertas!\n                            ', 'Productos', 'Disponemos de los siguientes productos. Sientase libre de visualizarlos', 'Contáctanos!', 'Valoramos la opinion y el contacto con nuestros clientes', 'Calle Nueva York 47', 'Santiago Centro - Chile', 'televenta@garetto.cl', '(56-2) 2820 59 00', 'pablo', '2017-07-20', '20:48:47'),
(2, '125 años de experiencia', 'Creamos', 'sellos personales, autenticidad, confianza', 'Nosotros', 'Ser los primeros, también nos hizo ser los mejores', 'Ofrecemos grandes servicios e ideas', 'Somos una empresa especializada en todo tipo de timbres, los cuales se adaptan al uso de cada persona, dependiendo de sus necesidades.\n\nAdemás de ofrecer una amplia gama de equipos financieros y maquinas para el manejo de efectivo.\n\nContamos con un sin fin de productos para su oficina, negocio o empresa.\n\nPoseémos 125 años de expriencia fabricando timbres de goma, timbres de metal, microporosos y le damos toda la dedicacion a nuestros productos.\n\nGracias a todos nuestros años y esfuerzos, hemos logrado liderar el negocio de las personalizaciones y autentificaciones para las pequeñas y grandes empresas.\n                            ', 'Nuestros Servicios', 'Gracias a Garetto, es que Chile es el único país que llama "Timbres" a los sellos de goma. Somos una empresa especializada en todo tipo de timbres, los cuales se adaptan al uso de cada persona, dependiendo de sus necesidades. Recuerde que cada timbre es su sello personal, único, y un reflejo de lo que desea autentificar. Revise nuestro amplio catálogo, que cuenta con todo tipo de timbres.\n                            ', 'Hardwares', 'Contamos con diversos tipos de hardwares, ven a verlos!\n                            ', 'Software', 'Nuestros softwares proporcionaran exito y ganancias a sus empresa\n                            ', 'Packs', 'Tanto software como hardware en esta seccion, ven a ver nuestras ofertas!\n                            ', 'Productos', 'Disponemos de los siguientes productos. Sientase libre de visualizarlos', 'Contáctanos!', 'Valoramos la opinion y el contacto con nuestros clientes', 'Calle Nueva York 47', 'Santiago Centro - Chile', 'contacto@garetto.cl', '(56-2) 2820 59 00', 'pablo', '2017-07-21', '15:47:20'),
(3, '120 años de experiencia', 'Creamos', 'sellos personales, autenticidad, confianza', 'Nosotros', 'Ser los primeros, también nos hizo ser los mejores', 'Ofrecemos grandes servicios e ideas', 'Somos una empresa especializada en todo tipo de timbres, los cuales se adaptan al uso de cada persona, dependiendo de sus necesidades.\n\nAdemás de ofrecer una amplia gama de equipos financieros y maquinas para el manejo de efectivo.\n\nContamos con un sin fin de productos para su oficina, negocio o empresa.\n\nPoseémos 125 años de expriencia fabricando timbres de goma, timbres de metal, microporosos y le damos toda la dedicacion a nuestros productos.\n\nGracias a todos nuestros años y esfuerzos, hemos logrado liderar el negocio de las personalizaciones y autentificaciones para las pequeñas y grandes empresas.\n                            ', 'Nuestros Servicios', 'Gracias a Garetto, es que Chile es el único país que llama "Timbres" a los sellos de goma. Somos una empresa especializada en todo tipo de timbres, los cuales se adaptan al uso de cada persona, dependiendo de sus necesidades. Recuerde que cada timbre es su sello personal, único, y un reflejo de lo que desea autentificar. Revise nuestro amplio catálogo, que cuenta con todo tipo de timbres.\n                            ', 'Hardwares', 'Contamos con diversos tipos de hardwares, ven a verlos!\n                            ', 'Software', 'Nuestros softwares proporcionaran exito y ganancias a sus empresa\n                            ', 'Packs', 'Tanto software como hardware en esta seccion, ven a ver nuestras ofertas!\n                            ', 'Productos', 'Disponemos de los siguientes productos. Sientase libre de visualizarlos', 'Contáctanos!', 'Valoramos la opinion y el contacto con nuestros clientes', 'Calle Nueva York 47', 'Santiago Centro - Chile', 'contacto@garetto.cl', '(56-2) 2820 59 00', 'pablo', '2017-07-21', '18:02:28'),
(4, '120 años de experiencia', 'Creamos', 'sellos personales, autenticidad, confianza, gay', 'Nosotros', 'Ser los primeros, también nos hizo ser los mejores', 'Ofrecemos grandes servicios e ideas', 'Somos una empresa especializada en todo tipo de timbres, los cuales se adaptan al uso de cada persona, dependiendo de sus necesidades.\n\nAdemás de ofrecer una amplia gama de equipos financieros y maquinas para el manejo de efectivo.\n\nContamos con un sin fin de productos para su oficina, negocio o empresa.\n\nPoseémos 125 años de expriencia fabricando timbres de goma, timbres de metal, microporosos y le damos toda la dedicacion a nuestros productos.\n\nGracias a todos nuestros años y esfuerzos, hemos logrado liderar el negocio de las personalizaciones y autentificaciones para las pequeñas y grandes empresas.\n                            ', 'Nuestros Servicios', 'Gracias a Garetto, es que Chile es el único país que llama "Timbres" a los sellos de goma. Somos una empresa especializada en todo tipo de timbres, los cuales se adaptan al uso de cada persona, dependiendo de sus necesidades. Recuerde que cada timbre es su sello personal, único, y un reflejo de lo que desea autentificar. Revise nuestro amplio catálogo, que cuenta con todo tipo de timbres.\n                            ', 'Hardwares', 'Contamos con diversos tipos de hardwares, ven a verlos!\n                            ', 'Software', 'Nuestros softwares proporcionaran exito y ganancias a sus empresa\n                            ', 'Packs', 'Tanto software como hardware en esta seccion, ven a ver nuestras ofertas!\n                            ', 'Productos', 'Disponemos de los siguientes productos. Sientase libre de visualizarlos', 'Contáctanos!', 'Valoramos la opinion y el contacto con nuestros clientes', 'Calle Nueva York 47', 'Santiago Centro - Chile', 'contacto@garetto.cl', '(56-2) 2820 59 00', 'pablo', '2017-07-21', '18:04:04'),
(5, '125 años de experiencia', 'Creamos', 'sellos personales, autenticidad, confianza', 'Nosotros', 'Ser los primeros, también nos hizo ser los mejores', 'Ofrecemos grandes servicios e ideas', 'Somos una empresa especializada en todo tipo de timbres, los cuales se adaptan al uso de cada persona, dependiendo de sus necesidades.\n\nAdemás de ofrecer una amplia gama de equipos financieros y maquinas para el manejo de efectivo.\n\nContamos con un sin fin de productos para su oficina, negocio o empresa.\n\nPoseémos 125 años de expriencia fabricando timbres de goma, timbres de metal, microporosos y le damos toda la dedicacion a nuestros productos.\n\nGracias a todos nuestros años y esfuerzos, hemos logrado liderar el negocio de las personalizaciones y autentificaciones para las pequeñas y grandes empresas.\n                            ', 'Nuestros Servicios', 'Gracias a Garetto, es que Chile es el único país que llama "Timbres" a los sellos de goma. Somos una empresa especializada en todo tipo de timbres, los cuales se adaptan al uso de cada persona, dependiendo de sus necesidades. Recuerde que cada timbre es su sello personal, único, y un reflejo de lo que desea autentificar. Revise nuestro amplio catálogo, que cuenta con todo tipo de timbres.\n                            ', 'Hardwares', 'Contamos con diversos tipos de hardwares, ven a verlos!\n                            ', 'Software', 'Nuestros softwares proporcionaran exito y ganancias a sus empresa\n                            ', 'Packs', 'Tanto software como hardware en esta seccion, ven a ver nuestras ofertas!\n                            ', 'Productos', 'Disponemos de los siguientes productos. Sientase libre de visualizarlos', 'Contáctanos!', 'Valoramos la opinion y el contacto con nuestros clientes', 'Calle Nueva York 47', 'Santiago Centro - Chile', 'contacto@garetto.cl', '(56-2) 2820 59 00', 'pablo', '2017-07-21', '18:04:33'),
(6, '125 años de experiencia', 'Creamos', 'sellos personales, autenticidad, confianza', 'Ellos', 'Ser los primeros, también nos hizo ser los mejores', 'Ofrecemos grandes servicios e ideas', 'Somos una empresa especializada en todo tipo de timbres, los cuales se adaptan al uso de cada persona, dependiendo de sus necesidades.\n\nAdemás de ofrecer una amplia gama de equipos financieros y maquinas para el manejo de efectivo.\n\nContamos con un sin fin de productos para su oficina, negocio o empresa.\n\nPoseémos 125 años de expriencia fabricando timbres de goma, timbres de metal, microporosos y le damos toda la dedicacion a nuestros productos.\n\nGracias a todos nuestros años y esfuerzos, hemos logrado liderar el negocio de las personalizaciones y autentificaciones para las pequeñas y grandes empresas.\n                            ', 'Nuestros Servicios', 'Gracias a Garetto, es que Chile es el único país que llama "Timbres" a los sellos de goma. Somos una empresa especializada en todo tipo de timbres, los cuales se adaptan al uso de cada persona, dependiendo de sus necesidades. Recuerde que cada timbre es su sello personal, único, y un reflejo de lo que desea autentificar. Revise nuestro amplio catálogo, que cuenta con todo tipo de timbres.\n                            ', 'Hardwares', 'Contamos con diversos tipos de hardwares, ven a verlos!\n                            ', 'Software', 'Nuestros softwares proporcionaran exito y ganancias a sus empresa\n                            ', 'Packs', 'Tanto software como hardware en esta seccion, ven a ver nuestras ofertas!\n                            ', 'Productos', 'Disponemos de los siguientes productos. Sientase libre de visualizarlos', 'Contáctanos!', 'Valoramos la opinion y el contacto con nuestros clientes', 'Calle Nueva York 47', 'Santiago Centro - Chile', 'contacto@garetto.cl', '(56-2) 2820 59 00', 'pablo', '2017-07-21', '18:12:03'),
(7, '125 años de experiencia', 'Creamos', 'sellos personales, autenticidad, confianza', 'Nosotros', 'Ser los primeros, también nos hizo ser los mejores', 'Ofrecemos grandes servicios e ideas', 'Somos una empresa especializada en todo tipo de timbres, los cuales se adaptan al uso de cada persona, dependiendo de sus necesidades.\n\nAdemás de ofrecer una amplia gama de equipos financieros y maquinas para el manejo de efectivo.\n\nContamos con un sin fin de productos para su oficina, negocio o empresa.\n\nPoseémos 125 años de expriencia fabricando timbres de goma, timbres de metal, microporosos y le damos toda la dedicacion a nuestros productos.\n\nGracias a todos nuestros años y esfuerzos, hemos logrado liderar el negocio de las personalizaciones y autentificaciones para las pequeñas y grandes empresas.\n                            ', 'Nuestros Servicios', 'Gracias a Garetto, es que Chile es el único país que llama "Timbres" a los sellos de goma. Somos una empresa especializada en todo tipo de timbres, los cuales se adaptan al uso de cada persona, dependiendo de sus necesidades. Recuerde que cada timbre es su sello personal, único, y un reflejo de lo que desea autentificar. Revise nuestro amplio catálogo, que cuenta con todo tipo de timbres.\n                            ', 'Hardwares', 'Contamos con diversos tipos de hardwares, ven a verlos!\n                            ', 'Software', 'Nuestros softwares proporcionaran exito y ganancias a sus empresa\n                            ', 'Packs', 'Tanto software como hardware en esta seccion, ven a ver nuestras ofertas!\n                            ', 'Productos', 'Disponemos de los siguientes productos. Sientase libre de visualizarlos', 'Contáctanos!', 'Valoramos la opinion y el contacto con nuestros clientes', 'Calle Nueva York 47', 'Santiago Centro - Chile', 'contacto@garetto.cl', '(56-2) 2820 59 00', 'pablo', '2017-07-21', '18:12:31');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `id_producto` int(11) NOT NULL,
  `cod_prod` int(11) NOT NULL,
  `producto` varchar(50) NOT NULL,
  `descripcion` varchar(500) NOT NULL,
  `cod_bar` int(11) NOT NULL,
  `prc_vta` float NOT NULL,
  `mnd_vta` int(11) NOT NULL,
  `prc_cpr` float NOT NULL,
  `mnd_cpr` int(11) NOT NULL,
  `modelo` varchar(50) NOT NULL,
  `marca` varchar(40) NOT NULL,
  `f_compra` date NOT NULL,
  `cantidad` int(11) NOT NULL,
  `f_creacion` date NOT NULL,
  `f_modificacion` date NOT NULL,
  `estado` int(11) NOT NULL,
  `usuario` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`id_producto`, `cod_prod`, `producto`, `descripcion`, `cod_bar`, `prc_vta`, `mnd_vta`, `prc_cpr`, `mnd_cpr`, `modelo`, `marca`, `f_compra`, `cantidad`, `f_creacion`, `f_modificacion`, `estado`, `usuario`) VALUES
(1, 6678, 'Reloj Control', 'Sire para cosas', 99999999, 0, 2, 600, 2, 'FGT44', 'ZKT', '2017-06-08', 100, '0000-00-00', '2017-07-11', 1, 'pablo'),
(2, 11223, 'Reloj Control', 'Este producto nos permite controlar la asistencia horaria.', 2147483647, 400000, 1, 200, 2, 'FGT45', 'ZKT', '2017-06-04', 200, '2017-07-11', '2017-07-12', 0, 'pablo'),
(3, 77894, 'Totem de autoatención', 'Facilita la interacción del cliente con la facturación', 99998887, 1000000, 1, 600, 2, 'S400KT', 'Samsung', '2017-06-02', 500, '2017-07-13', '0000-00-00', 0, 'pablo'),
(4, 777777, 'Producto 1', 'Descripcion del producto', 666666666, 800000, 1, 750, 2, 'HJTY', 'ZKT', '2017-07-04', 300, '2017-07-18', '0000-00-00', 0, 'pablo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tmp_compra`
--

CREATE TABLE `tmp_compra` (
  `id_tmp_compra` int(11) NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `f_ingreso` date NOT NULL,
  `h_ingreso` time NOT NULL,
  `estado` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `direccion` varchar(255) NOT NULL,
  `f_pago` varchar(50) NOT NULL,
  `t_despacho` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tmp_compra`
--

INSERT INTO `tmp_compra` (`id_tmp_compra`, `usuario`, `f_ingreso`, `h_ingreso`, `estado`, `id_cliente`, `direccion`, `f_pago`, `t_despacho`) VALUES
(1, 'pablo', '2017-07-12', '23:43:56', 0, 0, '', '', ''),
(2, 'pablo', '2017-07-13', '14:51:25', 0, 0, '', '', ''),
(3, 'pablo', '2017-07-13', '14:51:41', 0, 0, '', '', ''),
(4, 'pablo', '2017-07-13', '16:57:12', 0, 0, '', '', ''),
(5, 'pablo', '2017-07-13', '18:16:13', 0, 0, '', '', ''),
(6, 'pablo', '2017-07-13', '18:18:12', 0, 0, '', '', ''),
(7, 'pablo', '2017-07-13', '21:29:26', 0, 0, '', '', ''),
(8, 'pablo', '2017-07-13', '22:07:30', 0, 0, '', '', ''),
(9, 'pablo', '2017-07-13', '22:08:23', 0, 0, '', '', ''),
(10, 'pablo', '2017-07-13', '22:12:25', 0, 0, '', '', ''),
(11, 'pablo', '2017-07-13', '22:14:25', 0, 0, '', '', ''),
(12, 'pablo', '2017-07-13', '23:50:06', 0, 0, '', '', ''),
(13, 'pablo', '2017-07-14', '17:06:28', 0, 0, '', '', ''),
(14, '', '0000-00-00', '00:00:00', 0, 0, '', '', ''),
(15, 'pablo', '2017-07-17', '16:15:50', 0, 0, '', '', ''),
(16, 'pablo', '2017-07-17', '16:17:56', 3, 2, 'Av. General Fontilla, 948, Las Condes', 'webpay', 'otro'),
(17, 'pablo', '2017-07-17', '22:19:41', 3, 2, '', '', ''),
(18, 'pablo', '2017-07-17', '22:20:56', 0, 0, '', '', ''),
(19, 'pablo', '2017-07-17', '22:21:12', 3, 2, '', 'webpay', 'laboral'),
(20, 'pablo', '2017-07-17', '23:18:44', 5, 2, '', '', ''),
(21, 'pablo', '2017-07-17', '23:21:49', 4, 2, '', '', ''),
(22, 'pablo', '2017-07-18', '17:41:19', 0, 0, '', '', ''),
(23, 'pablo', '2017-07-18', '17:41:38', 0, 0, '', '', ''),
(24, 'pablo', '2017-07-18', '17:41:51', 0, 0, '', '', ''),
(25, 'pablo', '2017-07-18', '17:43:07', 3, 14, 'Av Manuel mont, 1955, Providencia', 'transferencia', 'otro'),
(26, 'pablo', '2017-07-19', '17:40:39', 0, 0, '', '', ''),
(27, 'pablo', '2017-07-19', '17:40:52', 0, 0, '', '', ''),
(28, 'pablo', '2017-07-19', '17:48:36', 5, 3, '', '', ''),
(29, 'pablo', '2017-07-19', '17:48:58', 3, 14, '', '', ''),
(30, 'pablo', '2017-07-21', '18:01:17', 0, 0, '', '', ''),
(31, 'pablo', '2017-07-21', '18:01:50', 4, 15, '', 'webpay', 'personal');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tmp_det_compra`
--

CREATE TABLE `tmp_det_compra` (
  `id_tmp_detalle` int(11) NOT NULL,
  `id_tmp_compra` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `prc_vta` int(11) NOT NULL,
  `mnd_vta` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `f_ingreso` date NOT NULL,
  `h_ingreso` time NOT NULL,
  `estado` int(11) NOT NULL,
  `id_compra` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tmp_det_compra`
--

INSERT INTO `tmp_det_compra` (`id_tmp_detalle`, `id_tmp_compra`, `id_producto`, `prc_vta`, `mnd_vta`, `cantidad`, `total`, `usuario`, `f_ingreso`, `h_ingreso`, `estado`, `id_compra`) VALUES
(34, 26, 2, 400000, 1, 4, 1600000, 'pablo', '2017-07-19', '17:40:39', 0, 0),
(35, 27, 3, 1000000, 1, 3, 3000000, 'pablo', '2017-07-19', '17:40:52', 0, 0),
(36, 28, 2, 400000, 1, 2, 800000, 'pablo', '2017-07-19', '17:48:36', 5, 0),
(37, 29, 3, 1000000, 1, 3, 3000000, 'pablo', '2017-07-19', '17:48:58', 3, 0),
(38, 30, 2, 400000, 1, 3, 1200000, 'pablo', '2017-07-21', '18:01:17', 0, 0),
(39, 31, 3, 1000000, 1, 2, 2000000, 'pablo', '2017-07-21', '18:01:50', 4, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `nombre_1` varchar(50) NOT NULL,
  `nombre_2` varchar(50) NOT NULL,
  `apellido_1` varchar(50) NOT NULL,
  `apellido_2` varchar(50) NOT NULL,
  `correo` varchar(100) NOT NULL,
  `celular` int(20) NOT NULL,
  `direccion` varchar(255) NOT NULL,
  `rut` varchar(50) NOT NULL,
  `tipo` int(11) NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `clave` varchar(500) NOT NULL,
  `id_empresa` int(11) NOT NULL,
  `id_nacion` int(11) NOT NULL,
  `genero` varchar(50) NOT NULL,
  `estado` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `nombre_1`, `nombre_2`, `apellido_1`, `apellido_2`, `correo`, `celular`, `direccion`, `rut`, `tipo`, `usuario`, `clave`, `id_empresa`, `id_nacion`, `genero`, `estado`) VALUES
(1, 'Pablo', 'Andrés', 'Figueroa', 'Plaza', 'pfigueroap.plaza@gmail.com', 965690990, 'central uno, 8659, La Florida', '16.016.083-7', 1, 'pablo', '707d14912bb250caf67dfe0ea4035681fbfc4f56', 1, 1, 'Masculino', 0),
(2, 'Nestor', '', 'Apolo', '', 'nestor.jose@jose.cl', 1111111111, 'Mariluan, 2279, PAC', '15.445.556-k', 2, 'nmora', '', 1, 1, 'Masculino', 0),
(3, 'Roy', '', 'Tapia', '', 'roy.tapia@bprog.cl', 88888888, '', '77777777-7', 2, '', '', 1, 1, 'Masculino', 0),
(4, 'Jose', 'Juan', 'Morales', '', 'jesteban@bprog.cl', 66666666, '', '16.016.083-8', 1, '', '', 1, 1, 'Masculino', 1),
(5, 'Jason', '', 'Tapia', '', 'jtapia@bprog.cl', 4444444, '', '15.695.556-4', 2, '', '', 1, 1, 'Masculino', 0),
(6, 'Javier', '', 'Blanco', 'Freire', 'mblanco@bprog.cl', 33333333, '', '77.199.300-1', 1, '', '', 1, 1, 'Masculino', 0),
(7, 'Estrella', 'Marina', 'Mora', 'Menares', 'emora@bprog.cl', 962369967, '', '16.695.556-4', 1, '', '', 1, 1, 'Femenino', 0),
(12, '', '', '', '', 'jose@jose.cl', 0, '', '', 1, 'jose', '4a3487e57d90e2084654b6d23937e75af5c8ee55', 0, 0, '', 0),
(13, 'Pedro', '', 'Figueroa', '', 'pedro@pedro.cl', 962369967, '', '12.233.445-6', 2, 'pedro', '4410d99cefe57ec2c2cdbd3f1d5cf862bb4fb6f8', 1, 1, 'Masculino', 0),
(14, 'Marco', '', 'Blanco', '', 'marco@marco.cl', 7777777, '', '77.199.300-1', 2, 'marco', '3829486b93ec44395f0b980424bae9b6fb07b7bc', 1, 1, 'Masculino', 0),
(15, 'Claudio', '', 'Muñoz', '', 'claudio@claudio.cl', 77777777, '', '13.076.770-2', 2, 'claudio', 'c3923186c4c9da9c766af46f22a325cd4677020a', 1, 1, 'Masculino', 0);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `compra`
--
ALTER TABLE `compra`
  ADD PRIMARY KEY (`id_compra`);

--
-- Indices de la tabla `contacto`
--
ALTER TABLE `contacto`
  ADD PRIMARY KEY (`id_contacto`);

--
-- Indices de la tabla `empresa`
--
ALTER TABLE `empresa`
  ADD PRIMARY KEY (`id_empresa`);

--
-- Indices de la tabla `moneda`
--
ALTER TABLE `moneda`
  ADD PRIMARY KEY (`id_moneda`);

--
-- Indices de la tabla `nacion`
--
ALTER TABLE `nacion`
  ADD PRIMARY KEY (`id_nacion`);

--
-- Indices de la tabla `page`
--
ALTER TABLE `page`
  ADD PRIMARY KEY (`id_page`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`id_producto`);

--
-- Indices de la tabla `tmp_compra`
--
ALTER TABLE `tmp_compra`
  ADD PRIMARY KEY (`id_tmp_compra`);

--
-- Indices de la tabla `tmp_det_compra`
--
ALTER TABLE `tmp_det_compra`
  ADD PRIMARY KEY (`id_tmp_detalle`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `compra`
--
ALTER TABLE `compra`
  MODIFY `id_compra` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `contacto`
--
ALTER TABLE `contacto`
  MODIFY `id_contacto` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `empresa`
--
ALTER TABLE `empresa`
  MODIFY `id_empresa` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `moneda`
--
ALTER TABLE `moneda`
  MODIFY `id_moneda` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `nacion`
--
ALTER TABLE `nacion`
  MODIFY `id_nacion` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `page`
--
ALTER TABLE `page`
  MODIFY `id_page` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `id_producto` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `tmp_compra`
--
ALTER TABLE `tmp_compra`
  MODIFY `id_tmp_compra` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=32;
--
-- AUTO_INCREMENT de la tabla `tmp_det_compra`
--
ALTER TABLE `tmp_det_compra`
  MODIFY `id_tmp_detalle` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=40;
--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=16;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
