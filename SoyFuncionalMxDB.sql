-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generaci�n: 15-04-2019 a las 22:36:15
-- Versi�n del servidor: 10.1.38-MariaDB
-- Versi�n de PHP: 7.3.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;

--
-- Base de datos: `soyfuncionalmx`
--
CREATE DATABASE IF NOT EXISTS `soyfuncionalmx` DEFAULT CHARACTER SET latin1 COLLATE latin1_spanish_ci;
USE `soyfuncionalmx`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `acceso`
--

DROP TABLE IF EXISTS `acceso`;
CREATE TABLE `acceso` (
  `idacceso` int(11) NOT NULL,
  `usuario` varchar(150) COLLATE latin1_spanish_ci NOT NULL DEFAULT '',
  `fecha` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `status` int(1) NOT NULL DEFAULT '1',
  `ip` varchar(15) CHARACTER SET latin1 NOT NULL DEFAULT '0.0.0.0',
  `explorador` varchar(30) CHARACTER SET latin1 NOT NULL DEFAULT '',
  `so` varchar(30) CHARACTER SET latin1 NOT NULL DEFAULT '',
  `idusuario` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `acceso`
--

INSERT INTO `acceso` (`idacceso`, `usuario`, `fecha`, `status`, `ip`, `explorador`, `so`, `idusuario`) VALUES
(1, 'lciencias@gmail.com', '2019-04-08 13:49:57', 1, '::1', 'CHROME', 'WIN', 1),
(2, 'lciencias@gmail.com', '2019-04-08 16:01:10', 1, '::1', 'CHROME', 'WIN', 1),
(3, 'lciencias@gmail.com', '2019-04-08 16:16:21', 2, '::1', 'CHROME', 'WIN', 1),
(4, 'lciencias@gmail.com', '2019-04-08 16:16:34', 1, '::1', 'CHROME', 'WIN', 1),
(5, 'lciencias@gmail.com', '2019-04-08 16:38:15', 2, '::1', 'CHROME', 'WIN', 1),
(6, 'lciencias@gmail.com', '2019-04-08 16:38:19', 1, '::1', 'CHROME', 'WIN', 1),
(7, 'lciencias@gmail.com', '2019-04-08 16:38:48', 2, '::1', 'CHROME', 'WIN', 1),
(8, 'lciencias@gmail.com', '2019-04-08 16:39:00', 1, '::1', 'CHROME', 'WIN', 1),
(9, 'lciencias@gmail.com', '2019-04-09 16:20:27', 1, '::1', 'CHROME', 'WIN', 1),
(10, 'lciencias@gmail.com', '2019-04-10 08:59:12', 1, '::1', 'CHROME', 'WIN', 1),
(11, 'lciencias@gmail.com', '2019-04-10 09:14:27', 2, '::1', 'CHROME', 'WIN', 1),
(12, 'lciencias@gmail.com', '2019-04-10 10:55:11', 1, '::1', 'CHROME', 'WIN', 1),
(13, 'lciencias@gmail.com', '2019-04-10 10:55:25', 2, '::1', 'CHROME', 'WIN', 1),
(14, 'lciencias@gmail.com', '2019-04-11 16:06:32', 1, '::1', 'CHROME', 'WIN', 1),
(15, 'lciencias@gmail.com', '2019-04-11 16:27:02', 2, '::1', 'CHROME', 'WIN', 1),
(16, 'lciencias@gmail.com', '2019-04-12 09:37:14', 1, '::1', 'CHROME', 'WIN', 1),
(17, 'lciencias@gmail.com', '2019-04-12 09:57:01', 2, '::1', 'CHROME', 'WIN', 1),
(18, 'lciencias@gmail.com', '2019-04-12 20:20:13', 1, '::1', 'CHROME', 'WIN', 1),
(19, 'lciencias@gmail.com', '2019-04-12 20:55:58', 2, '::1', 'CHROME', 'WIN', 1),
(20, 'lciencias@gmail.com', '2019-04-12 20:57:18', 1, '::1', 'CHROME', 'WIN', 1),
(21, 'lciencias@gmail.com', '2019-04-12 21:27:18', 2, '::1', 'CHROME', 'WIN', 1),
(22, 'lciencias@gmail.com', '2019-04-12 21:31:35', 1, '::1', 'CHROME', 'WIN', 1),
(23, 'lciencias@gmail.com', '2019-04-12 22:15:21', 2, '::1', 'CHROME', 'WIN', 1),
(24, 'lciencias@gmail.com', '2019-04-12 22:15:34', 1, '::1', 'CHROME', 'WIN', 1),
(25, 'lciencias@gmail.com', '2019-04-14 09:23:28', 1, '::1', 'CHROME', 'WIN', 1),
(26, 'lciencias@gmail.com', '2019-04-14 09:38:30', 2, '::1', 'CHROME', 'WIN', 1),
(27, 'lciencias@gmail.com', '2019-04-15 07:11:26', 1, '::1', 'CHROME', 'WIN', 1),
(28, 'lciencias@gmail.com', '2019-04-15 09:22:15', 2, '::1', 'CHROME', 'WIN', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bitacora`
--

DROP TABLE IF EXISTS `bitacora`;
CREATE TABLE `bitacora` (
  `id` int(11) NOT NULL,
  `idusuario` int(10) NOT NULL DEFAULT '0',
  `idmodulo` int(10) NOT NULL DEFAULT '0',
  `nombre_modulo` varchar(64) CHARACTER SET latin1 NOT NULL DEFAULT '',
  `fecha` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `idregistro` int(10) DEFAULT '0',
  `nombre_registro` varchar(150) CHARACTER SET latin1 NOT NULL DEFAULT '',
  `tipo_movimiento` int(1) NOT NULL DEFAULT '0',
  `estado_anterior` text CHARACTER SET latin1,
  `estado_despues` text CHARACTER SET latin1,
  `ip` varchar(16) CHARACTER SET latin1 NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

DROP TABLE IF EXISTS `categorias`;
CREATE TABLE `categorias` (
  `id` int(10) NOT NULL,
  `nombre` varchar(80) COLLATE latin1_spanish_ci NOT NULL DEFAULT '',
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `orden` int(3) NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id`, `nombre`, `fecha`, `orden`, `status`) VALUES
(1, 'Proteina', '2019-04-06 00:27:20', 1, 1),
(2, 'Vegetales', '2019-04-06 00:27:20', 2, 1),
(3, 'Carbohidratos', '2019-04-06 00:27:20', 3, 1),
(4, 'Crudit�s', '2019-04-06 00:27:20', 4, 1),
(5, 'Fruta', '2019-04-06 00:27:20', 5, 1),
(6, 'Grasas', '2019-04-06 00:27:20', 6, 1),
(7, 'Salsas', '2019-04-06 00:27:20', 7, 1),
(8, 'Bebidas', '2019-04-12 23:50:55', 8, 1),
(9, 'Test Prueba', '2019-04-08 17:08:01', 1, 0),
(10, 'Test Tres', '2019-04-08 17:08:17', 1, 0),
(11, 'Test Diario', '2019-04-08 17:08:35', 1, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado`
--

DROP TABLE IF EXISTS `estado`;
CREATE TABLE `estado` (
  `idestado` int(2) NOT NULL,
  `estado` varchar(40) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `imagen`
--

DROP TABLE IF EXISTS `imagen`;
CREATE TABLE `imagen` (
  `idimagen` int(11) NOT NULL,
  `idusuario` int(11) NOT NULL DEFAULT '0',
  `archivo` varchar(150) COLLATE latin1_spanish_ci NOT NULL DEFAULT '',
  `ruta` varchar(255) COLLATE latin1_spanish_ci NOT NULL DEFAULT '',
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` int(1) NOT NULL DEFAULT '1',
  `web` varchar(255) COLLATE latin1_spanish_ci NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `imagen`
--

INSERT INTO `imagen` (`idimagen`, `idusuario`, `archivo`, `ruta`, `fecha`, `status`, `web`) VALUES
(1, 1, 'logoCiencias.png', 'c:/xampp/htdocs/soyfuncionalmxv2/panel/img/banners/logoCiencias.png', '2019-04-12 12:31:42', 1, 'http://localhost/soyfuncionalmxv2/panel/img/banners/logoCiencias.png'),
(3, 1, 'slide-3.jpg', 'c:/xampp/htdocs/soyfuncionalmxv2/panel/img/banners/slide-3.jpg', '2019-04-12 09:40:45', 1, 'http://localhost/soyfuncionalmxv2/panel/img/banners/slide-3.jpg'),
(4, 1, 'slide-3.jpg', 'c:/xampp/htdocs/soyfuncionalmxv2/panel/img/banners/slide-3.jpg', '2019-04-12 09:40:45', 1, 'http://localhost/soyfuncionalmxv2/panel/img/banners/slide-3.jpg'),
(5, 1, 'slide-2.jpg', 'c:/xampp/htdocs/soyfuncionalmxv2/panel/img/banners/slide-2.jpg', '2019-04-12 09:41:24', 1, 'http://localhost/soyfuncionalmxv2/panel/img/banners/slide-2.jpg'),
(6, 1, 'slide-2.jpg', 'c:/xampp/htdocs/soyfuncionalmxv2/panel/img/banners/slide-2.jpg', '2019-04-12 09:41:24', 1, 'http://localhost/soyfuncionalmxv2/panel/img/banners/slide-2.jpg'),
(7, 1, 'breadcrumbs-bg.jpg', 'c:/xampp/htdocs/soyfuncionalmxv2/panel/img/banners/breadcrumbs-bg.jpg', '2019-04-12 21:32:24', 1, 'http://localhost/soyfuncionalmxv2/panel/img/banners/breadcrumbs-bg.jpg'),
(8, 1, 'breadcrumbs-bg.jpg', 'c:/xampp/htdocs/soyfuncionalmxv2/panel/img/banners/breadcrumbs-bg.jpg', '2019-04-12 21:32:25', 1, 'http://localhost/soyfuncionalmxv2/panel/img/banners/breadcrumbs-bg.jpg'),
(9, 1, 'breadcrumbs-bg.jpg', 'c:/xampp/htdocs/soyfuncionalmxv2/panel/img/banners/breadcrumbs-bg.jpg', '2019-04-12 21:38:34', 1, 'http://localhost/soyfuncionalmxv2/panel/img/banners/breadcrumbs-bg.jpg'),
(10, 1, 'breadcrumbs-bg.jpg', 'c:/xampp/htdocs/soyfuncionalmxv2/panel/img/banners/breadcrumbs-bg.jpg', '2019-04-12 21:38:35', 1, 'http://localhost/soyfuncionalmxv2/panel/img/banners/breadcrumbs-bg.jpg'),
(11, 1, 'slide-1.jpg', 'c:/xampp/htdocs/soyfuncionalmxv2/panel/img/banners/slide-1.jpg', '2019-04-12 21:45:35', 1, 'http://localhost/soyfuncionalmxv2/panel/img/banners/slide-1.jpg'),
(12, 1, 'slide-1.jpg', 'c:/xampp/htdocs/soyfuncionalmxv2/panel/img/banners/slide-1.jpg', '2019-04-12 21:45:35', 1, 'http://localhost/soyfuncionalmxv2/panel/img/banners/slide-1.jpg'),
(13, 1, 'slide-2.jpg', 'c:/xampp/htdocs/soyfuncionalmxv2/panel/img/banners/slide-2.jpg', '2019-04-12 23:28:09', 1, 'http://localhost/soyfuncionalmxv2/panel/img/banners/slide-2.jpg'),
(14, 1, 'slide-2.jpg', 'c:/xampp/htdocs/soyfuncionalmxv2/panel/img/banners/slide-2.jpg', '2019-04-12 23:28:09', 1, 'http://localhost/soyfuncionalmxv2/panel/img/banners/slide-2.jpg'),
(15, 1, 'slide-3.jpg', 'c:/xampp/htdocs/soyfuncionalmxv2/panel/img/banners/slide-3.jpg', '2019-04-12 23:31:11', 1, 'http://localhost/soyfuncionalmxv2/panel/img/banners/slide-3.jpg'),
(16, 1, 'slide-3.jpg', 'c:/xampp/htdocs/soyfuncionalmxv2/panel/img/banners/slide-3.jpg', '2019-04-12 23:31:11', 1, 'http://localhost/soyfuncionalmxv2/panel/img/banners/slide-3.jpg'),
(17, 1, 'slide-3.jpg', 'c:/xampp/htdocs/soyfuncionalmxv2/panel/img/banners/slide-3.jpg', '2019-04-12 23:32:55', 1, 'http://localhost/soyfuncionalmxv2/panel/img/banners/slide-3.jpg'),
(18, 1, 'slide-3.jpg', 'c:/xampp/htdocs/soyfuncionalmxv2/panel/img/banners/slide-3.jpg', '2019-04-12 23:32:55', 1, 'http://localhost/soyfuncionalmxv2/panel/img/banners/slide-3.jpg'),
(19, 1, 'slide-3.jpg', 'c:/xampp/htdocs/soyfuncionalmxv2/panel/img/banners/slide-3.jpg', '2019-04-12 23:32:56', 1, 'http://localhost/soyfuncionalmxv2/panel/img/banners/slide-3.jpg'),
(20, 1, 'slide-3.jpg', 'c:/xampp/htdocs/soyfuncionalmxv2/panel/img/banners/slide-3.jpg', '2019-04-12 23:32:56', 1, 'http://localhost/soyfuncionalmxv2/panel/img/banners/slide-3.jpg'),
(21, 1, 'slide-3.jpg', 'c:/xampp/htdocs/soyfuncionalmxv2/panel/img/banners/slide-3.jpg', '2019-04-12 23:32:57', 1, 'http://localhost/soyfuncionalmxv2/panel/img/banners/slide-3.jpg'),
(22, 1, 'slide-3.jpg', 'c:/xampp/htdocs/soyfuncionalmxv2/panel/img/banners/slide-3.jpg', '2019-04-12 23:32:57', 1, 'http://localhost/soyfuncionalmxv2/panel/img/banners/slide-3.jpg'),
(23, 1, 'slide-3.jpg', 'c:/xampp/htdocs/soyfuncionalmxv2/panel/img/banners/slide-3.jpg', '2019-04-12 23:32:58', 1, 'http://localhost/soyfuncionalmxv2/panel/img/banners/slide-3.jpg'),
(24, 1, 'slide-3.jpg', 'c:/xampp/htdocs/soyfuncionalmxv2/panel/img/banners/slide-3.jpg', '2019-04-12 23:32:58', 1, 'http://localhost/soyfuncionalmxv2/panel/img/banners/slide-3.jpg'),
(25, 1, 'slide-3.jpg', 'c:/xampp/htdocs/soyfuncionalmxv2/panel/img/banners/slide-3.jpg', '2019-04-12 23:32:58', 1, 'http://localhost/soyfuncionalmxv2/panel/img/banners/slide-3.jpg'),
(26, 1, 'slide-3.jpg', 'c:/xampp/htdocs/soyfuncionalmxv2/panel/img/banners/slide-3.jpg', '2019-04-12 23:32:58', 1, 'http://localhost/soyfuncionalmxv2/panel/img/banners/slide-3.jpg'),
(27, 1, 'slide-3.jpg', 'c:/xampp/htdocs/soyfuncionalmxv2/panel/img/banners/slide-3.jpg', '2019-04-12 23:32:58', 1, 'http://localhost/soyfuncionalmxv2/panel/img/banners/slide-3.jpg'),
(28, 1, 'slide-3.jpg', 'c:/xampp/htdocs/soyfuncionalmxv2/panel/img/banners/slide-3.jpg', '2019-04-12 23:32:58', 1, 'http://localhost/soyfuncionalmxv2/panel/img/banners/slide-3.jpg'),
(29, 1, 'slide-3.jpg', 'c:/xampp/htdocs/soyfuncionalmxv2/panel/img/banners/slide-3.jpg', '2019-04-12 23:32:58', 1, 'http://localhost/soyfuncionalmxv2/panel/img/banners/slide-3.jpg'),
(30, 1, 'slide-3.jpg', 'c:/xampp/htdocs/soyfuncionalmxv2/panel/img/banners/slide-3.jpg', '2019-04-12 23:32:58', 1, 'http://localhost/soyfuncionalmxv2/panel/img/banners/slide-3.jpg'),
(31, 1, 'slide-3.jpg', 'c:/xampp/htdocs/soyfuncionalmxv2/panel/img/banners/slide-3.jpg', '2019-04-12 23:32:58', 1, 'http://localhost/soyfuncionalmxv2/panel/img/banners/slide-3.jpg'),
(32, 1, 'slide-3.jpg', 'c:/xampp/htdocs/soyfuncionalmxv2/panel/img/banners/slide-3.jpg', '2019-04-12 23:32:58', 1, 'http://localhost/soyfuncionalmxv2/panel/img/banners/slide-3.jpg'),
(33, 1, 'slide-3.jpg', 'c:/xampp/htdocs/soyfuncionalmxv2/panel/img/banners/slide-3.jpg', '2019-04-12 23:32:59', 1, 'http://localhost/soyfuncionalmxv2/panel/img/banners/slide-3.jpg'),
(34, 1, 'slide-3.jpg', 'c:/xampp/htdocs/soyfuncionalmxv2/panel/img/banners/slide-3.jpg', '2019-04-12 23:32:59', 1, 'http://localhost/soyfuncionalmxv2/panel/img/banners/slide-3.jpg'),
(35, 1, 'slide-3.jpg', 'c:/xampp/htdocs/soyfuncionalmxv2/panel/img/banners/slide-3.jpg', '2019-04-12 23:32:59', 1, 'http://localhost/soyfuncionalmxv2/panel/img/banners/slide-3.jpg'),
(36, 1, 'slide-3.jpg', 'c:/xampp/htdocs/soyfuncionalmxv2/panel/img/banners/slide-3.jpg', '2019-04-12 23:32:59', 1, 'http://localhost/soyfuncionalmxv2/panel/img/banners/slide-3.jpg'),
(37, 1, 'slide-3.jpg', 'c:/xampp/htdocs/soyfuncionalmxv2/panel/img/banners/slide-3.jpg', '2019-04-12 23:32:59', 1, 'http://localhost/soyfuncionalmxv2/panel/img/banners/slide-3.jpg'),
(38, 1, 'slide-3.jpg', 'c:/xampp/htdocs/soyfuncionalmxv2/panel/img/banners/slide-3.jpg', '2019-04-12 23:32:59', 1, 'http://localhost/soyfuncionalmxv2/panel/img/banners/slide-3.jpg'),
(39, 1, 'slide-3.jpg', 'c:/xampp/htdocs/soyfuncionalmxv2/panel/img/banners/slide-3.jpg', '2019-04-12 23:32:59', 1, 'http://localhost/soyfuncionalmxv2/panel/img/banners/slide-3.jpg'),
(40, 1, 'slide-3.jpg', 'c:/xampp/htdocs/soyfuncionalmxv2/panel/img/banners/slide-3.jpg', '2019-04-12 23:32:59', 1, 'http://localhost/soyfuncionalmxv2/panel/img/banners/slide-3.jpg'),
(41, 1, 'slide-3.jpg', 'c:/xampp/htdocs/soyfuncionalmxv2/panel/img/banners/slide-3.jpg', '2019-04-12 23:32:59', 1, 'http://localhost/soyfuncionalmxv2/panel/img/banners/slide-3.jpg'),
(42, 1, 'slide-3.jpg', 'c:/xampp/htdocs/soyfuncionalmxv2/panel/img/banners/slide-3.jpg', '2019-04-12 23:33:00', 1, 'http://localhost/soyfuncionalmxv2/panel/img/banners/slide-3.jpg'),
(43, 1, 'slide-3.jpg', 'c:/xampp/htdocs/soyfuncionalmxv2/panel/img/banners/slide-3.jpg', '2019-04-12 23:33:00', 1, 'http://localhost/soyfuncionalmxv2/panel/img/banners/slide-3.jpg'),
(44, 1, 'slide-3.jpg', 'c:/xampp/htdocs/soyfuncionalmxv2/panel/img/banners/slide-3.jpg', '2019-04-12 23:33:00', 1, 'http://localhost/soyfuncionalmxv2/panel/img/banners/slide-3.jpg'),
(45, 1, 'slide-3.jpg', 'c:/xampp/htdocs/soyfuncionalmxv2/panel/img/banners/slide-3.jpg', '2019-04-12 23:33:00', 1, 'http://localhost/soyfuncionalmxv2/panel/img/banners/slide-3.jpg'),
(46, 1, 'slide-3.jpg', 'c:/xampp/htdocs/soyfuncionalmxv2/panel/img/banners/slide-3.jpg', '2019-04-12 23:33:00', 1, 'http://localhost/soyfuncionalmxv2/panel/img/banners/slide-3.jpg'),
(47, 1, 'slide-3.jpg', 'c:/xampp/htdocs/soyfuncionalmxv2/panel/img/banners/slide-3.jpg', '2019-04-12 23:33:00', 1, 'http://localhost/soyfuncionalmxv2/panel/img/banners/slide-3.jpg'),
(48, 1, 'slide-3.jpg', 'c:/xampp/htdocs/soyfuncionalmxv2/panel/img/banners/slide-3.jpg', '2019-04-12 23:33:00', 1, 'http://localhost/soyfuncionalmxv2/panel/img/banners/slide-3.jpg'),
(49, 1, 'slide-3.jpg', 'c:/xampp/htdocs/soyfuncionalmxv2/panel/img/banners/slide-3.jpg', '2019-04-12 23:33:00', 1, 'http://localhost/soyfuncionalmxv2/panel/img/banners/slide-3.jpg'),
(50, 1, 'slide-3.jpg', 'c:/xampp/htdocs/soyfuncionalmxv2/panel/img/banners/slide-3.jpg', '2019-04-12 23:33:01', 1, 'http://localhost/soyfuncionalmxv2/panel/img/banners/slide-3.jpg'),
(51, 1, 'slide-3.jpg', 'c:/xampp/htdocs/soyfuncionalmxv2/panel/img/banners/slide-3.jpg', '2019-04-12 23:33:01', 1, 'http://localhost/soyfuncionalmxv2/panel/img/banners/slide-3.jpg'),
(52, 1, 'slide-3.jpg', 'c:/xampp/htdocs/soyfuncionalmxv2/panel/img/banners/slide-3.jpg', '2019-04-12 23:33:01', 1, 'http://localhost/soyfuncionalmxv2/panel/img/banners/slide-3.jpg'),
(53, 1, 'slide-3.jpg', 'c:/xampp/htdocs/soyfuncionalmxv2/panel/img/banners/slide-3.jpg', '2019-04-12 23:33:01', 1, 'http://localhost/soyfuncionalmxv2/panel/img/banners/slide-3.jpg'),
(54, 1, 'slide-3.jpg', 'c:/xampp/htdocs/soyfuncionalmxv2/panel/img/banners/slide-3.jpg', '2019-04-12 23:33:01', 1, 'http://localhost/soyfuncionalmxv2/panel/img/banners/slide-3.jpg'),
(55, 1, 'slide-3.jpg', 'c:/xampp/htdocs/soyfuncionalmxv2/panel/img/banners/slide-3.jpg', '2019-04-12 23:33:02', 1, 'http://localhost/soyfuncionalmxv2/panel/img/banners/slide-3.jpg'),
(56, 1, 'slide-3.jpg', 'c:/xampp/htdocs/soyfuncionalmxv2/panel/img/banners/slide-3.jpg', '2019-04-12 23:33:02', 1, 'http://localhost/soyfuncionalmxv2/panel/img/banners/slide-3.jpg'),
(57, 1, 'slide-3.jpg', 'c:/xampp/htdocs/soyfuncionalmxv2/panel/img/banners/slide-3.jpg', '2019-04-12 23:33:02', 1, 'http://localhost/soyfuncionalmxv2/panel/img/banners/slide-3.jpg'),
(58, 1, 'slide-3.jpg', 'c:/xampp/htdocs/soyfuncionalmxv2/panel/img/banners/slide-3.jpg', '2019-04-12 23:33:02', 1, 'http://localhost/soyfuncionalmxv2/panel/img/banners/slide-3.jpg'),
(59, 1, 'slide-3.jpg', 'c:/xampp/htdocs/soyfuncionalmxv2/panel/img/banners/slide-3.jpg', '2019-04-12 23:33:02', 1, 'http://localhost/soyfuncionalmxv2/panel/img/banners/slide-3.jpg'),
(60, 1, 'slide-3.jpg', 'c:/xampp/htdocs/soyfuncionalmxv2/panel/img/banners/slide-3.jpg', '2019-04-12 23:33:02', 1, 'http://localhost/soyfuncionalmxv2/panel/img/banners/slide-3.jpg'),
(61, 1, 'slide-3.jpg', 'c:/xampp/htdocs/soyfuncionalmxv2/panel/img/banners/slide-3.jpg', '2019-04-12 23:33:02', 1, 'http://localhost/soyfuncionalmxv2/panel/img/banners/slide-3.jpg'),
(62, 1, 'slide-3.jpg', 'c:/xampp/htdocs/soyfuncionalmxv2/panel/img/banners/slide-3.jpg', '2019-04-12 23:33:03', 1, 'http://localhost/soyfuncionalmxv2/panel/img/banners/slide-3.jpg'),
(63, 1, 'slide-3.jpg', 'c:/xampp/htdocs/soyfuncionalmxv2/panel/img/banners/slide-3.jpg', '2019-04-12 23:33:03', 1, 'http://localhost/soyfuncionalmxv2/panel/img/banners/slide-3.jpg'),
(64, 1, 'slide-3.jpg', 'c:/xampp/htdocs/soyfuncionalmxv2/panel/img/banners/slide-3.jpg', '2019-04-12 23:33:03', 1, 'http://localhost/soyfuncionalmxv2/panel/img/banners/slide-3.jpg'),
(65, 1, 'slide-3.jpg', 'c:/xampp/htdocs/soyfuncionalmxv2/panel/img/banners/slide-3.jpg', '2019-04-12 23:33:03', 1, 'http://localhost/soyfuncionalmxv2/panel/img/banners/slide-3.jpg'),
(66, 1, 'slide-3.jpg', 'c:/xampp/htdocs/soyfuncionalmxv2/panel/img/banners/slide-3.jpg', '2019-04-12 23:33:03', 1, 'http://localhost/soyfuncionalmxv2/panel/img/banners/slide-3.jpg'),
(67, 1, 'slide-3.jpg', 'c:/xampp/htdocs/soyfuncionalmxv2/panel/img/banners/slide-3.jpg', '2019-04-12 23:33:03', 1, 'http://localhost/soyfuncionalmxv2/panel/img/banners/slide-3.jpg'),
(68, 1, 'slide-3.jpg', 'c:/xampp/htdocs/soyfuncionalmxv2/panel/img/banners/slide-3.jpg', '2019-04-12 23:33:03', 1, 'http://localhost/soyfuncionalmxv2/panel/img/banners/slide-3.jpg'),
(69, 1, 'slide-3.jpg', 'c:/xampp/htdocs/soyfuncionalmxv2/panel/img/banners/slide-3.jpg', '2019-04-12 23:33:03', 1, 'http://localhost/soyfuncionalmxv2/panel/img/banners/slide-3.jpg'),
(70, 1, 'slide-3.jpg', 'c:/xampp/htdocs/soyfuncionalmxv2/panel/img/banners/slide-3.jpg', '2019-04-12 23:33:03', 1, 'http://localhost/soyfuncionalmxv2/panel/img/banners/slide-3.jpg'),
(71, 1, 'slide-3.jpg', 'c:/xampp/htdocs/soyfuncionalmxv2/panel/img/banners/slide-3.jpg', '2019-04-12 23:33:04', 1, 'http://localhost/soyfuncionalmxv2/panel/img/banners/slide-3.jpg'),
(72, 1, 'slide-3.jpg', 'c:/xampp/htdocs/soyfuncionalmxv2/panel/img/banners/slide-3.jpg', '2019-04-12 23:33:04', 1, 'http://localhost/soyfuncionalmxv2/panel/img/banners/slide-3.jpg'),
(73, 1, 'slide-3.jpg', 'c:/xampp/htdocs/soyfuncionalmxv2/panel/img/banners/slide-3.jpg', '2019-04-12 23:33:04', 1, 'http://localhost/soyfuncionalmxv2/panel/img/banners/slide-3.jpg'),
(74, 1, 'slide-3.jpg', 'c:/xampp/htdocs/soyfuncionalmxv2/panel/img/banners/slide-3.jpg', '2019-04-12 23:33:04', 1, 'http://localhost/soyfuncionalmxv2/panel/img/banners/slide-3.jpg'),
(75, 1, 'slide-3.jpg', 'c:/xampp/htdocs/soyfuncionalmxv2/panel/img/banners/slide-3.jpg', '2019-04-12 23:33:04', 1, 'http://localhost/soyfuncionalmxv2/panel/img/banners/slide-3.jpg'),
(76, 1, 'slide-3.jpg', 'c:/xampp/htdocs/soyfuncionalmxv2/panel/img/banners/slide-3.jpg', '2019-04-12 23:33:04', 1, 'http://localhost/soyfuncionalmxv2/panel/img/banners/slide-3.jpg'),
(77, 1, 'slide-3.jpg', 'c:/xampp/htdocs/soyfuncionalmxv2/panel/img/banners/slide-3.jpg', '2019-04-12 23:33:04', 1, 'http://localhost/soyfuncionalmxv2/panel/img/banners/slide-3.jpg'),
(78, 1, 'slide-3.jpg', 'c:/xampp/htdocs/soyfuncionalmxv2/panel/img/banners/slide-3.jpg', '2019-04-12 23:33:04', 1, 'http://localhost/soyfuncionalmxv2/panel/img/banners/slide-3.jpg'),
(79, 1, 'slide-2.jpg', 'c:/xampp/htdocs/soyfuncionalmxv2/panel/img/banners/slide-2.jpg', '2019-04-12 23:38:55', 1, 'http://localhost/soyfuncionalmxv2/panel/img/banners/slide-2.jpg'),
(80, 1, 'slide-2.jpg', 'c:/xampp/htdocs/soyfuncionalmxv2/panel/img/banners/slide-2.jpg', '2019-04-12 23:38:55', 1, 'http://localhost/soyfuncionalmxv2/panel/img/banners/slide-2.jpg'),
(81, 1, 'slide-2.jpg', 'c:/xampp/htdocs/soyfuncionalmxv2/panel/img/banners/slide-2.jpg', '2019-04-12 23:38:57', 1, 'http://localhost/soyfuncionalmxv2/panel/img/banners/slide-2.jpg'),
(82, 1, 'slide-2.jpg', 'c:/xampp/htdocs/soyfuncionalmxv2/panel/img/banners/slide-2.jpg', '2019-04-12 23:38:57', 1, 'http://localhost/soyfuncionalmxv2/panel/img/banners/slide-2.jpg'),
(83, 1, 'slide-2.jpg', 'c:/xampp/htdocs/soyfuncionalmxv2/panel/img/banners/slide-2.jpg', '2019-04-12 23:38:57', 1, 'http://localhost/soyfuncionalmxv2/panel/img/banners/slide-2.jpg'),
(84, 1, 'slide-2.jpg', 'c:/xampp/htdocs/soyfuncionalmxv2/panel/img/banners/slide-2.jpg', '2019-04-12 23:38:57', 1, 'http://localhost/soyfuncionalmxv2/panel/img/banners/slide-2.jpg'),
(85, 1, 'slide-2.jpg', 'c:/xampp/htdocs/soyfuncionalmxv2/panel/img/banners/slide-2.jpg', '2019-04-12 23:38:58', 1, 'http://localhost/soyfuncionalmxv2/panel/img/banners/slide-2.jpg'),
(86, 1, 'slide-2.jpg', 'c:/xampp/htdocs/soyfuncionalmxv2/panel/img/banners/slide-2.jpg', '2019-04-12 23:38:58', 1, 'http://localhost/soyfuncionalmxv2/panel/img/banners/slide-2.jpg'),
(87, 1, 'slide-2.jpg', 'c:/xampp/htdocs/soyfuncionalmxv2/panel/img/banners/slide-2.jpg', '2019-04-12 23:38:58', 1, 'http://localhost/soyfuncionalmxv2/panel/img/banners/slide-2.jpg'),
(88, 1, 'slide-2.jpg', 'c:/xampp/htdocs/soyfuncionalmxv2/panel/img/banners/slide-2.jpg', '2019-04-12 23:38:58', 1, 'http://localhost/soyfuncionalmxv2/panel/img/banners/slide-2.jpg'),
(89, 1, 'slide-2.jpg', 'c:/xampp/htdocs/soyfuncionalmxv2/panel/img/banners/slide-2.jpg', '2019-04-12 23:38:58', 1, 'http://localhost/soyfuncionalmxv2/panel/img/banners/slide-2.jpg'),
(90, 1, 'slide-2.jpg', 'c:/xampp/htdocs/soyfuncionalmxv2/panel/img/banners/slide-2.jpg', '2019-04-12 23:38:58', 1, 'http://localhost/soyfuncionalmxv2/panel/img/banners/slide-2.jpg'),
(91, 1, 'slide-2.jpg', 'c:/xampp/htdocs/soyfuncionalmxv2/panel/img/banners/slide-2.jpg', '2019-04-12 23:38:59', 1, 'http://localhost/soyfuncionalmxv2/panel/img/banners/slide-2.jpg'),
(92, 1, 'slide-2.jpg', 'c:/xampp/htdocs/soyfuncionalmxv2/panel/img/banners/slide-2.jpg', '2019-04-12 23:38:59', 1, 'http://localhost/soyfuncionalmxv2/panel/img/banners/slide-2.jpg'),
(93, 1, 'slide-2.jpg', 'c:/xampp/htdocs/soyfuncionalmxv2/panel/img/banners/slide-2.jpg', '2019-04-12 23:38:59', 1, 'http://localhost/soyfuncionalmxv2/panel/img/banners/slide-2.jpg'),
(94, 1, 'slide-2.jpg', 'c:/xampp/htdocs/soyfuncionalmxv2/panel/img/banners/slide-2.jpg', '2019-04-12 23:38:59', 1, 'http://localhost/soyfuncionalmxv2/panel/img/banners/slide-2.jpg'),
(95, 1, 'slide-2.jpg', 'c:/xampp/htdocs/soyfuncionalmxv2/panel/img/banners/slide-2.jpg', '2019-04-12 23:38:59', 1, 'http://localhost/soyfuncionalmxv2/panel/img/banners/slide-2.jpg'),
(96, 1, 'slide-2.jpg', 'c:/xampp/htdocs/soyfuncionalmxv2/panel/img/banners/slide-2.jpg', '2019-04-12 23:38:59', 1, 'http://localhost/soyfuncionalmxv2/panel/img/banners/slide-2.jpg'),
(97, 1, 'slide-2.jpg', 'c:/xampp/htdocs/soyfuncionalmxv2/panel/img/banners/slide-2.jpg', '2019-04-12 23:38:59', 1, 'http://localhost/soyfuncionalmxv2/panel/img/banners/slide-2.jpg'),
(98, 1, 'slide-2.jpg', 'c:/xampp/htdocs/soyfuncionalmxv2/panel/img/banners/slide-2.jpg', '2019-04-12 23:38:59', 1, 'http://localhost/soyfuncionalmxv2/panel/img/banners/slide-2.jpg'),
(99, 1, 'slide-2.jpg', 'c:/xampp/htdocs/soyfuncionalmxv2/panel/img/banners/slide-2.jpg', '2019-04-12 23:38:59', 1, 'http://localhost/soyfuncionalmxv2/panel/img/banners/slide-2.jpg'),
(100, 1, 'slide-2.jpg', 'c:/xampp/htdocs/soyfuncionalmxv2/panel/img/banners/slide-2.jpg', '2019-04-12 23:38:59', 1, 'http://localhost/soyfuncionalmxv2/panel/img/banners/slide-2.jpg'),
(101, 1, 'slide-2.jpg', 'c:/xampp/htdocs/soyfuncionalmxv2/panel/img/banners/slide-2.jpg', '2019-04-12 23:39:00', 1, 'http://localhost/soyfuncionalmxv2/panel/img/banners/slide-2.jpg'),
(102, 1, 'slide-2.jpg', 'c:/xampp/htdocs/soyfuncionalmxv2/panel/img/banners/slide-2.jpg', '2019-04-12 23:39:00', 1, 'http://localhost/soyfuncionalmxv2/panel/img/banners/slide-2.jpg'),
(103, 1, 'slide-2.jpg', 'c:/xampp/htdocs/soyfuncionalmxv2/panel/img/banners/slide-2.jpg', '2019-04-12 23:39:00', 1, 'http://localhost/soyfuncionalmxv2/panel/img/banners/slide-2.jpg'),
(104, 1, 'slide-2.jpg', 'c:/xampp/htdocs/soyfuncionalmxv2/panel/img/banners/slide-2.jpg', '2019-04-12 23:39:00', 1, 'http://localhost/soyfuncionalmxv2/panel/img/banners/slide-2.jpg'),
(105, 1, 'slide-2.jpg', 'c:/xampp/htdocs/soyfuncionalmxv2/panel/img/banners/slide-2.jpg', '2019-04-12 23:39:00', 1, 'http://localhost/soyfuncionalmxv2/panel/img/banners/slide-2.jpg'),
(106, 1, 'slide-2.jpg', 'c:/xampp/htdocs/soyfuncionalmxv2/panel/img/banners/slide-2.jpg', '2019-04-12 23:39:00', 1, 'http://localhost/soyfuncionalmxv2/panel/img/banners/slide-2.jpg'),
(107, 1, 'slide-2.jpg', 'c:/xampp/htdocs/soyfuncionalmxv2/panel/img/banners/slide-2.jpg', '2019-04-12 23:39:00', 1, 'http://localhost/soyfuncionalmxv2/panel/img/banners/slide-2.jpg'),
(108, 1, 'slide-2.jpg', 'c:/xampp/htdocs/soyfuncionalmxv2/panel/img/banners/slide-2.jpg', '2019-04-12 23:39:00', 1, 'http://localhost/soyfuncionalmxv2/panel/img/banners/slide-2.jpg'),
(109, 1, 'slide-2.jpg', 'c:/xampp/htdocs/soyfuncionalmxv2/panel/img/banners/slide-2.jpg', '2019-04-12 23:39:01', 1, 'http://localhost/soyfuncionalmxv2/panel/img/banners/slide-2.jpg'),
(110, 1, 'slide-2.jpg', 'c:/xampp/htdocs/soyfuncionalmxv2/panel/img/banners/slide-2.jpg', '2019-04-12 23:39:01', 1, 'http://localhost/soyfuncionalmxv2/panel/img/banners/slide-2.jpg'),
(111, 1, 'slide-2.jpg', 'c:/xampp/htdocs/soyfuncionalmxv2/panel/img/banners/slide-2.jpg', '2019-04-12 23:39:01', 1, 'http://localhost/soyfuncionalmxv2/panel/img/banners/slide-2.jpg'),
(112, 1, 'slide-2.jpg', 'c:/xampp/htdocs/soyfuncionalmxv2/panel/img/banners/slide-2.jpg', '2019-04-12 23:39:01', 1, 'http://localhost/soyfuncionalmxv2/panel/img/banners/slide-2.jpg'),
(113, 1, 'slide-2.jpg', 'c:/xampp/htdocs/soyfuncionalmxv2/panel/img/banners/slide-2.jpg', '2019-04-12 23:39:01', 1, 'http://localhost/soyfuncionalmxv2/panel/img/banners/slide-2.jpg'),
(114, 1, 'slide-2.jpg', 'c:/xampp/htdocs/soyfuncionalmxv2/panel/img/banners/slide-2.jpg', '2019-04-12 23:39:01', 1, 'http://localhost/soyfuncionalmxv2/panel/img/banners/slide-2.jpg'),
(115, 1, 'slide-2.jpg', 'c:/xampp/htdocs/soyfuncionalmxv2/panel/img/banners/slide-2.jpg', '2019-04-12 23:39:01', 1, 'http://localhost/soyfuncionalmxv2/panel/img/banners/slide-2.jpg'),
(116, 1, 'slide-2.jpg', 'c:/xampp/htdocs/soyfuncionalmxv2/panel/img/banners/slide-2.jpg', '2019-04-12 23:39:01', 1, 'http://localhost/soyfuncionalmxv2/panel/img/banners/slide-2.jpg'),
(117, 1, 'slide-2.jpg', 'c:/xampp/htdocs/soyfuncionalmxv2/panel/img/banners/slide-2.jpg', '2019-04-12 23:39:01', 1, 'http://localhost/soyfuncionalmxv2/panel/img/banners/slide-2.jpg'),
(118, 1, 'slide-2.jpg', 'c:/xampp/htdocs/soyfuncionalmxv2/panel/img/banners/slide-2.jpg', '2019-04-12 23:39:01', 1, 'http://localhost/soyfuncionalmxv2/panel/img/banners/slide-2.jpg'),
(119, 1, 'slide-2.jpg', 'c:/xampp/htdocs/soyfuncionalmxv2/panel/img/banners/slide-2.jpg', '2019-04-12 23:39:10', 1, 'http://localhost/soyfuncionalmxv2/panel/img/banners/slide-2.jpg'),
(120, 1, 'slide-2.jpg', 'c:/xampp/htdocs/soyfuncionalmxv2/panel/img/banners/slide-2.jpg', '2019-04-12 23:39:10', 1, 'http://localhost/soyfuncionalmxv2/panel/img/banners/slide-2.jpg'),
(121, 1, 'slide-2.jpg', 'c:/xampp/htdocs/soyfuncionalmxv2/panel/img/banners/slide-2.jpg', '2019-04-12 23:40:08', 1, 'http://localhost/soyfuncionalmxv2/panel/img/banners/slide-2.jpg'),
(122, 1, 'slide-2.jpg', 'c:/xampp/htdocs/soyfuncionalmxv2/panel/img/banners/slide-2.jpg', '2019-04-12 23:40:08', 1, 'http://localhost/soyfuncionalmxv2/panel/img/banners/slide-2.jpg'),
(123, 1, 'slide-2.jpg', 'c:/xampp/htdocs/soyfuncionalmxv2/panel/img/banners/slide-2.jpg', '2019-04-12 23:40:25', 1, 'http://localhost/soyfuncionalmxv2/panel/img/banners/slide-2.jpg'),
(124, 1, 'slide-2.jpg', 'c:/xampp/htdocs/soyfuncionalmxv2/panel/img/banners/slide-2.jpg', '2019-04-12 23:40:25', 1, 'http://localhost/soyfuncionalmxv2/panel/img/banners/slide-2.jpg'),
(125, 1, 'AAArhqS.jpg', 'c:/xampp/htdocs/soyfuncionalmxv2/panel/img/banners/AAArhqS.jpg', '2019-04-13 00:06:24', 1, 'http://localhost/soyfuncionalmxv2/panel/img/banners/AAArhqS.jpg'),
(126, 1, 'AAArhqS.jpg', 'c:/xampp/htdocs/soyfuncionalmxv2/panel/img/banners/AAArhqS.jpg', '2019-04-13 00:06:48', 1, 'http://localhost/soyfuncionalmxv2/panel/img/banners/AAArhqS.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos`
--

DROP TABLE IF EXISTS `pedidos`;
CREATE TABLE `pedidos` (
  `id` int(10) NOT NULL,
  `fecha_pedido` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `fecha_entrega` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `importe` float(18,2) NOT NULL DEFAULT '0.00',
  `id_usuario` int(10) NOT NULL DEFAULT '0',
  `status` int(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `pedidos`
--

INSERT INTO `pedidos` (`id`, `fecha_pedido`, `fecha_entrega`, `importe`, `id_usuario`, `status`) VALUES
(1, '2019-04-08 17:48:37', '2019-04-08 17:48:37', 150.00, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos_productos`
--

DROP TABLE IF EXISTS `pedidos_productos`;
CREATE TABLE `pedidos_productos` (
  `id` int(10) NOT NULL,
  `id_pedido` int(10) NOT NULL DEFAULT '0',
  `id_producto` int(10) NOT NULL DEFAULT '0',
  `cantidad` int(3) NOT NULL DEFAULT '0',
  `importe` float(18,2) NOT NULL DEFAULT '0.00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `pedidos_productos`
--

INSERT INTO `pedidos_productos` (`id`, `id_pedido`, `id_producto`, `cantidad`, `importe`) VALUES
(1, 1, 60, 1, 30.00),
(2, 1, 22, 1, 30.00),
(3, 1, 4, 1, 60.00),
(4, 1, 36, 1, 30.00);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `preguntas`
--

DROP TABLE IF EXISTS `preguntas`;
CREATE TABLE `preguntas` (
  `id` int(10) NOT NULL,
  `pregunta` varchar(180) COLLATE latin1_spanish_ci NOT NULL DEFAULT '',
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `respuesta` text COLLATE latin1_spanish_ci
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `preguntas`
--

INSERT INTO `preguntas` (`id`, `pregunta`, `fecha`, `status`, `respuesta`) VALUES
(1, 'Que servicios de entrega trabaja', '2019-04-13 00:30:50', 0, 'En las delegaciones Alvaro Obregon y  Miguel Hidalgo el servicio es gratuito en otras delagaciones la entrega se realiza en sucursal'),
(2, 'Pregunta Dos', '2019-04-12 12:52:32', 1, 'Respuesta 2'),
(3, 'Pregunta Tres', '2019-04-12 17:33:57', 1, 'Respuesta de la pregunta tres'),
(4, 'Pregunta Cuatro', '2019-04-12 21:03:32', 0, 'Esta es la respuesta de la pregunta cuatro');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

DROP TABLE IF EXISTS `productos`;
CREATE TABLE `productos` (
  `id` int(10) NOT NULL,
  `idcategoria` int(10) NOT NULL DEFAULT '0',
  `producto` varchar(120) COLLATE latin1_spanish_ci NOT NULL DEFAULT '',
  `caloria` varchar(60) COLLATE latin1_spanish_ci NOT NULL DEFAULT '',
  `precio` float(15,2) NOT NULL DEFAULT '0.00',
  `idimagen` int(10) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `orden` int(10) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `idcategoria`, `producto`, `caloria`, `precio`, `idimagen`, `fecha`, `status`, `orden`) VALUES
(1, 1, 'Arrachera', '50 grms', 30.00, 1, '2019-04-06 00:37:44', 1, 1),
(2, 1, 'Pechuga de Pollo', '50 grms', 15.00, 1, '2019-04-06 00:37:44', 1, 1),
(3, 1, 'Molida de Cerdo', '50 grms', 25.00, 1, '2019-04-06 00:37:44', 1, 1),
(4, 1, 'Medall�n At�n', '50 grms', 50.00, 1, '2019-04-06 00:37:44', 1, 1),
(5, 1, 'At�n en Agua', '50 grms', 15.00, 1, '2019-04-06 00:37:44', 1, 2),
(6, 1, 'Salm�n', '50 grms', 60.00, 1, '2019-04-06 00:37:44', 1, 1),
(7, 1, 'Molida de Pavo', '50 grms', 25.00, 1, '2019-04-06 00:37:44', 1, 1),
(8, 1, 'Pavo Horneado', '50 grms', 20.00, 1, '2019-04-06 00:37:44', 1, 1),
(9, 1, 'Huevo Cocido', '1', 10.00, 1, '2019-04-06 00:37:44', 1, 1),
(10, 1, 'Tofu', '100 grms', 25.00, 1, '2019-04-06 00:37:44', 1, 1),
(11, 1, 'Requeson', '30 grms', 6.00, 1, '2019-04-06 00:37:44', 1, 1),
(12, 1, 'Queso Cabra', '30 grms', 15.00, 1, '2019-04-06 00:37:44', 1, 1),
(13, 1, 'Queso Feta', '30 grms', 15.00, 1, '2019-04-06 00:37:44', 1, 1),
(14, 1, 'Monterrey Jack', '30 grms', 9.00, 1, '2019-04-06 00:37:44', 1, 1),
(15, 1, 'Mozarella', '30 grms', 9.00, 1, '2019-04-06 00:37:44', 1, 1),
(16, 2, 'Sopa de Verduras', '1 tz', 15.00, 1, '2019-04-06 00:37:44', 1, 1),
(17, 2, 'Crema de Verduras', '1 tz', 15.00, 1, '2019-04-06 00:37:44', 1, 1),
(18, 2, 'Vegetales Verdes al Vapor', '1 tz', 15.00, 1, '2019-04-06 00:37:44', 1, 1),
(19, 2, 'Vegetales Verdes Rostizados', '1 tz', 15.00, 1, '2019-04-06 00:37:44', 1, 1),
(20, 2, 'Vegetales Mixtos al Vapor', '1 tz', 15.00, 1, '2019-04-06 00:37:44', 1, 1),
(21, 2, 'Vegetales Mixtos Rostizados', '1 tz', 15.00, 1, '2019-04-06 00:37:44', 1, 1),
(22, 3, 'Arroz', '1/3 Tz', 5.00, 1, '2019-04-06 00:37:44', 1, 1),
(23, 3, 'Quinoa', '1/3 Tz', 10.00, 1, '2019-04-06 00:37:44', 1, 2),
(24, 3, 'Frijoles', '1/4 tz', 5.00, 1, '2019-04-06 00:37:44', 1, 3),
(25, 3, 'Lentejas', '1/4 tz', 5.00, 1, '2019-04-06 00:37:44', 1, 4),
(26, 3, 'Elote', '1/2 tz', 5.00, 1, '2019-04-06 00:37:44', 1, 5),
(27, 3, 'Fusilli', '1/4 tz', 5.00, 1, '2019-04-06 00:37:44', 1, 6),
(28, 3, 'Camote', '1/2 Tz', 8.00, 1, '2019-04-06 00:37:44', 1, 7),
(29, 3, 'Papa Mediana', '1/3 pz', 5.00, 1, '2019-04-06 00:37:44', 1, 8),
(30, 3, 'Chicharo', '1/2 tz', 5.00, 1, '2019-04-06 00:37:44', 1, 9),
(31, 3, 'Pan de Pita', '1/4 pz', 3.00, 1, '2019-04-06 00:37:44', 1, 10),
(32, 3, 'Salmas', '1 Paquete', 5.00, 1, '2019-04-06 00:37:44', 1, 11),
(33, 3, 'Veguicheez', '1', 15.00, 1, '2019-04-06 00:37:44', 1, 12),
(34, 3, 'Kipes Vegetarianos', '2 pz', 50.00, 1, '2019-04-06 00:37:44', 1, 13),
(35, 4, 'Lechuga', '2.5 tz', 10.00, 1, '2019-04-06 00:37:44', 1, 1),
(36, 4, 'Espinaca', '2.5', 10.00, 1, '2019-04-06 00:37:44', 1, 2),
(37, 4, 'Pepino', '1 tz', 10.00, 1, '2019-04-06 00:37:44', 1, 3),
(38, 4, 'Apio', '1/2 tz', 10.00, 1, '2019-04-06 00:37:44', 1, 4),
(39, 4, 'Pimiento', '1/2 tz', 10.00, 1, '2019-04-06 00:37:44', 1, 5),
(40, 4, 'Jitomate Uva', '1/2 tz', 10.00, 1, '2019-04-06 00:37:44', 1, 6),
(41, 4, 'Champi�ones', '1 tz', 10.00, 1, '2019-04-06 00:37:44', 1, 7),
(42, 4, 'Zanahoria Rallada', '1/4 tz', 10.00, 1, '2019-04-06 00:37:44', 1, 8),
(43, 5, 'Arandanos Deshidratados', '1/4 tz', 10.00, 1, '2019-04-06 00:37:44', 1, 1),
(44, 5, 'Manzana Peque�a', '1', 10.00, 1, '2019-04-06 00:37:44', 1, 5),
(45, 5, 'Fresa', '1 tz', 20.00, 1, '2019-04-06 00:37:44', 1, 3),
(46, 5, 'Melon', '1/4 pz', 10.00, 1, '2019-04-06 00:37:44', 1, 4),
(47, 5, 'Papaya', '1 tz', 10.00, 1, '2019-04-06 00:37:44', 1, 5),
(48, 5, 'Toronja', '1/2', 10.00, 1, '2019-04-06 00:37:44', 1, 6),
(49, 5, 'Zarzamoras', '3/4 tz', 20.00, 1, '2019-04-06 00:37:44', 1, 7),
(50, 5, 'Papaya', '1 tz', 10.00, 1, '2019-04-06 00:37:44', 1, 19),
(51, 6, 'Salsa tzatziki', '30 gmrs', 10.00, 1, '2019-04-06 00:37:44', 1, 1),
(52, 6, 'Humus', '30 grms', 10.00, 1, '2019-04-06 00:37:44', 1, 2),
(53, 6, 'Aceitunas Negras', '10', 10.00, 1, '2019-04-06 00:37:44', 1, 3),
(54, 6, 'Aceitunas Verdes', '8', 10.00, 1, '2019-04-06 00:37:44', 1, 4),
(55, 6, 'Aguacate', '1/4 pz', 5.00, 1, '2019-04-06 00:37:44', 1, 6),
(56, 6, 'Vinagreta Fresa', '1/4 tz', 5.00, 1, '2019-04-06 00:37:44', 1, 7),
(57, 6, 'Mostaza Miel', '1/4 tz', 5.00, 1, '2019-04-06 00:37:44', 1, 8),
(58, 6, 'Bals�mico Miel', '1/4 tz', 5.00, 1, '2019-04-06 00:37:44', 1, 9),
(59, 6, 'Soya - Crema Cacahuate', '1/4 tz', 5.00, 1, '2019-04-06 00:37:44', 1, 10),
(60, 6, 'Aceite Oliva + Vinagre Manzana', '1/4 tz', 5.00, 1, '2019-04-06 00:37:44', 1, 11),
(61, 6, 'Almendras', '1/4 tz', 5.00, 1, '2019-04-06 00:37:44', 1, 13),
(62, 6, 'Ajonjol�', '1/4 tz', 5.00, 1, '2019-04-06 00:37:44', 1, 14),
(63, 6, 'Semillas de Girasol', '1/4 tz', 5.00, 1, '2019-04-06 00:37:44', 1, 15),
(64, 6, 'Pepitas de Calabaza', '1/4 tz', 5.00, 1, '2019-04-06 00:37:44', 1, 16),
(65, 7, 'Salsa Verde', '1/4 tz', 5.00, 1, '2019-04-06 00:37:44', 1, 1),
(66, 7, 'Salsa Chipotle', '1/4 tz', 5.00, 1, '2019-04-06 00:37:44', 1, 1),
(67, 7, 'Salsa Mexicana', '1/4 tz', 5.00, 1, '2019-04-06 00:37:44', 1, 1),
(68, 8, 'Agua', '1/2 lt', 5.00, 1, '2019-04-06 00:37:44', 1, 1),
(69, 8, 'Agua', '1 lt', 10.00, 1, '2019-04-06 00:37:44', 1, 2),
(70, 8, 'Agua Tamarindo', '1/2 lt', 10.00, 1, '2019-04-06 00:37:44', 1, 3),
(71, 8, 'Agua Tamarindo', '1 lt', 15.00, 1, '2019-04-06 00:37:44', 1, 4),
(72, 8, 'Agua Jamaica', '1/2 lt', 10.00, 1, '2019-04-06 00:37:44', 1, 5),
(73, 8, 'Agua Jamaica', '1 lt', 15.00, 126, '2019-04-13 00:06:48', 1, 6),
(74, 8, 'Agua de Coco', '1', 20.00, 1, '2019-04-06 00:37:44', 1, 7),
(75, 8, 'Electrolit', '1', 25.00, 1, '2019-04-06 00:37:44', 1, 8);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sessiones`
--

DROP TABLE IF EXISTS `sessiones`;
CREATE TABLE `sessiones` (
  `id` int(20) NOT NULL,
  `session_user` int(10) NOT NULL DEFAULT '0',
  `session` varchar(64) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL DEFAULT '',
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `session_ip` varchar(15) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL DEFAULT '0.0.0.0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `sessiones`
--

INSERT INTO `sessiones` (`id`, `session_user`, `session`, `timestamp`, `session_ip`) VALUES
(0, 1, '6208be104627a0b864a4901b2640b2c1', '2019-04-08 13:49:57', '::1'),
(0, 1, '3b198063619d17588148dfa6f0f2d472', '2019-04-08 16:01:10', '::1'),
(0, 1, '64855f6bbe49f827b9014ee301dd0cb0', '2019-04-08 16:16:34', '::1'),
(0, 1, '2816cc0002d3999c229ea4b3b4955602', '2019-04-08 16:38:19', '::1'),
(0, 1, 'fb35fd26576a2fa2951727ebe041f7d8', '2019-04-08 16:39:00', '::1'),
(0, 1, 'be284f3a8b0f0370c45ad7ce73dfdf51', '2019-04-09 16:20:28', '::1'),
(0, 1, '2cfe01b04bf5a6060e0e813ef3d00397', '2019-04-10 08:59:12', '::1'),
(0, 1, '38c24bc19f87136ddee069c5c4b680ac', '2019-04-10 10:55:11', '::1'),
(0, 1, 'e83e79a06380fee7788ce2e431530245', '2019-04-11 16:06:33', '::1'),
(0, 1, '59258a106bed0f8c51d0fdce35dbbafd', '2019-04-12 09:37:14', '::1'),
(0, 1, 'cd96cf3abd0395161e4438180bddc95e', '2019-04-12 20:20:13', '::1'),
(0, 1, '85f535d52d330e344c5c622b8f199ef8', '2019-04-12 20:57:18', '::1'),
(0, 1, 'c74238cf5d5260ad36409b121b0db05f', '2019-04-12 21:31:35', '::1'),
(0, 1, '2b60dfb7f8dfe502ed539d37aa931442', '2019-04-12 22:15:34', '::1'),
(0, 1, '03d5ac219c80a61f9959e00324fa1f21', '2019-04-14 09:23:29', '::1'),
(0, 1, '63054e28afdaf313c240390ced27fa03', '2019-04-15 07:11:26', '::1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `slide`
--

DROP TABLE IF EXISTS `slide`;
CREATE TABLE `slide` (
  `idslide` int(11) NOT NULL,
  `nombre` varchar(150) COLLATE latin1_spanish_ci NOT NULL DEFAULT '',
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` int(1) NOT NULL DEFAULT '1',
  `orden` int(10) NOT NULL DEFAULT '0',
  `texto_corto` varchar(255) COLLATE latin1_spanish_ci NOT NULL DEFAULT '''''',
  `texto_grande` varchar(255) COLLATE latin1_spanish_ci NOT NULL DEFAULT '',
  `texto_boton` varchar(64) COLLATE latin1_spanish_ci NOT NULL DEFAULT '',
  `url` text COLLATE latin1_spanish_ci NOT NULL,
  `idimagen` int(10) NOT NULL DEFAULT '0',
  `idimagenMovil` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `slide`
--

INSERT INTO `slide` (`idslide`, `nombre`, `fecha`, `status`, `orden`, `texto_corto`, `texto_grande`, `texto_boton`, `url`, `idimagen`, `idimagenMovil`) VALUES
(2, 'Banner Uno', '2019-04-12 21:39:10', 1, 4, 'Texto 1', 'Texo 2', 'texto boton', 'Texto 3', 3, 4),
(3, 'Banner Dos', '2019-04-12 21:39:07', 1, 3, 'Texto B 1', 'Texto B 2', 'Texto Boton 2', 'Texto B 3', 5, 6),
(4, 'Banner Tres', '2019-04-12 21:39:03', 1, 2, '', '', '', '', 7, 8),
(5, 'Banner Cuatro', '2019-04-12 23:26:43', 1, 5, 'Texto Peque&ntilde;o', 'Texto Grande', 'Texto Boton', 'guardaDatos.php', 9, 10),
(6, 'Banner Cinco Cambios', '2019-04-12 23:40:25', 1, 2, 'Texto Pequeno Banner 5 Cambios', 'Texto Grande Banner 5 Cambios', 'Texto Boton Banner 5 cambios', 'texto Mediano Banner 5 Cambios', 123, 124),
(7, 'Banner Cuatro', '2019-04-12 23:28:09', 1, 5, 'Texto Peque�o', 'Texto Grande', 'Texto Boton', 'Texto Mediano', 13, 14);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `testimoniales`
--

DROP TABLE IF EXISTS `testimoniales`;
CREATE TABLE `testimoniales` (
  `id` int(10) NOT NULL,
  `nombre` varchar(80) COLLATE latin1_spanish_ci NOT NULL DEFAULT '',
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `testimonial` text COLLATE latin1_spanish_ci
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `testimoniales`
--

INSERT INTO `testimoniales` (`id`, `nombre`, `fecha`, `status`, `testimonial`) VALUES
(1, 'Luis Antonio Hernandez', '2019-04-13 00:20:48', 1, 'Es mi primer pedido y todo estuvo sensacional, la atenci�n es muy cordial y de mucha calidad'),
(2, 'Laura Villegas', '2019-04-13 00:20:11', 1, 'Muy buen servicio, los alimentos muy ricos nutritivos y econ�micos');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE latin1_spanish_ci NOT NULL DEFAULT '',
  `email` varchar(255) COLLATE latin1_spanish_ci NOT NULL DEFAULT '',
  `password` varchar(255) COLLATE latin1_spanish_ci NOT NULL DEFAULT '',
  `passwordS` varchar(100) COLLATE latin1_spanish_ci NOT NULL DEFAULT '',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `activo` tinyint(1) NOT NULL DEFAULT '1',
  `dummy` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci COMMENT='Tabla que contiene la informacion de los usuarios del sistema';

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `passwordS`, `created_at`, `updated_at`, `activo`, `dummy`) VALUES
(1, 'Administrador', 'lciencias@gmail.com', '*84AAC12F54AB666ECFC2A83C676908C8BBC381B1', '12345678', '2018-04-27 23:08:12', '2018-04-27 23:08:12', 1, 0),
(2, 'Fernanda', 'fernanda@gmail.com', '*84AAC12F54AB666ECFC2A83C676908C8BBC381B1', '12345678', '0000-00-00 00:00:00', '2019-04-06 00:47:26', 1, 0),
(3, 'Adrian Perez', 'adrian.perez@gmail.com', '*84AAC12F54AB666ECFC2A83C676908C8BBC381B1', '12345678', '2019-04-08 13:52:44', '2019-04-08 13:52:44', 1, 0),
(4, 'Leslie Andrea', 'lciencias@gmail.com', '*84AAC12F54AB666ECFC2A83C676908C8BBC381B1', '12345678', '2019-04-08 14:05:14', '2019-04-08 14:05:14', 2, 0),
(5, 'aaaaaaaaaa', 'lciencias@gmail.com', '*84AAC12F54AB666ECFC2A83C676908C8BBC381B1', '12345678', '2019-04-08 14:06:25', '2019-04-08 14:06:25', 2, 0),
(6, 'dsadsadsad', 'lciencias@gmail.com', '*84AAC12F54AB666ECFC2A83C676908C8BBC381B1', '12345678', '2019-04-08 16:16:09', '2019-04-08 16:16:09', 2, 0),
(7, 'Juan Nieto', 'manunieto@gmail.com', '*348B2E74CDAC5EEF8E3548D4AE4A967DB79A00F4', '11223344', '2019-04-08 16:43:43', '2019-04-12 22:58:02', 1, 0),
(8, 'Sonia Vargas', 'soniavargas@anzen.com', '*6B5EDDE567F4F29018862811195DBD14B8ADDD2A', '1234567890', '2019-04-08 16:44:33', '2019-04-08 16:44:33', 2, 0),
(9, 'Hannia Hernandez', 'hanniavhp@gmail.com', '*5D24C4D94238E65A6407DFAB95AA4EA97CA2B199', '87654321', '2019-04-08 16:45:19', '2019-04-12 22:57:34', 1, 0),
(10, 'Leslie Hernandez', 'leslieandreahp@gmail.com', '*7FEDA9727673E340DE7F3DB6F981F1B441768110', '3456789012', '2019-04-08 16:45:34', '2019-04-12 22:58:18', 1, 0),
(11, 'Lorena Portilla', 'loreportilla78@gmail.com', '*84AAC12F54AB666ECFC2A83C676908C8BBC381B1', '12345678', '2019-04-08 16:45:52', '2019-04-08 16:45:52', 1, 0),
(12, 'Diego Ayala', 'diegoaah@yahoo.com', '*84AAC12F54AB666ECFC2A83C676908C8BBC381B1', '12345678', '2019-04-08 16:46:16', '2019-04-08 16:46:16', 1, 0),
(13, 'Ejemplo', 'lcienciase@gmail.com', '*84AAC12F54AB666ECFC2A83C676908C8BBC381B1', '12345678', '2019-04-09 16:20:58', '2019-04-09 16:20:58', 2, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE `usuarios` (
  `id` int(10) NOT NULL,
  `nombre` varchar(100) COLLATE latin1_spanish_ci NOT NULL,
  `apellidos` varchar(100) COLLATE latin1_spanish_ci NOT NULL DEFAULT '',
  `email` varchar(60) COLLATE latin1_spanish_ci NOT NULL DEFAULT '',
  `contrasena` varchar(255) COLLATE latin1_spanish_ci NOT NULL DEFAULT '',
  `contrasenaS` varchar(30) COLLATE latin1_spanish_ci NOT NULL DEFAULT '',
  `celular` varchar(10) COLLATE latin1_spanish_ci NOT NULL DEFAULT '',
  `fecha_alta` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `fecha_ult_acceso` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `activo` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `apellidos`, `email`, `contrasena`, `contrasenaS`, `celular`, `fecha_alta`, `fecha_ult_acceso`, `activo`) VALUES
(1, 'Luis Antonio', 'Hernandez Nieto', 'lciencias@gmail.com', '*84AAC12F54AB666ECFC2A83C676908C8BBC381B1', '12345678', '5537270124', '2019-04-06 00:14:33', '2019-04-06 00:14:33', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `visita`
--

DROP TABLE IF EXISTS `visita`;
CREATE TABLE `visita` (
  `contador` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `visitantes`
--

DROP TABLE IF EXISTS `visitantes`;
CREATE TABLE `visitantes` (
  `idvisitante` int(11) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `ip` varchar(15) CHARACTER SET latin1 NOT NULL DEFAULT '0.0.0.0',
  `explorador` varchar(30) CHARACTER SET latin1 NOT NULL DEFAULT '',
  `so` varchar(30) CHARACTER SET latin1 NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `visitantes`
--

INSERT INTO `visitantes` (`idvisitante`, `fecha`, `ip`, `explorador`, `so`) VALUES
(1, '2019-04-08 13:49:48', '::1', 'CHROME', 'WIN'),
(2, '2019-04-09 16:20:17', '::1', 'CHROME', 'WIN'),
(3, '2019-04-09 17:34:40', '::1', 'SAFARI', 'MAC'),
(4, '2019-04-10 08:59:08', '::1', 'CHROME', 'WIN'),
(5, '2019-04-11 16:06:28', '::1', 'CHROME', 'WIN'),
(6, '2019-04-12 09:37:11', '::1', 'CHROME', 'WIN'),
(7, '2019-04-13 00:00:15', '::1', 'CHROME', 'WIN'),
(8, '2019-04-14 09:23:25', '::1', 'CHROME', 'WIN'),
(9, '2019-04-15 07:11:25', '::1', 'CHROME', 'WIN');

--
-- �ndices para tablas volcadas
--

--
-- Indices de la tabla `acceso`
--
ALTER TABLE `acceso`
  ADD PRIMARY KEY (`idacceso`);

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `estado`
--
ALTER TABLE `estado`
  ADD PRIMARY KEY (`idestado`);

--
-- Indices de la tabla `imagen`
--
ALTER TABLE `imagen`
  ADD PRIMARY KEY (`idimagen`),
  ADD KEY `fk_iduser` (`idusuario`),
  ADD KEY `idusuario` (`idusuario`);

--
-- Indices de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `pedidos_productos`
--
ALTER TABLE `pedidos_productos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_pedido` (`id_pedido`),
  ADD KEY `id_producto` (`id_producto`);

--
-- Indices de la tabla `preguntas`
--
ALTER TABLE `preguntas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idcategoria` (`idcategoria`);

--
-- Indices de la tabla `slide`
--
ALTER TABLE `slide`
  ADD PRIMARY KEY (`idslide`),
  ADD KEY `idimagen` (`idimagen`);

--
-- Indices de la tabla `testimoniales`
--
ALTER TABLE `testimoniales`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `index_email` (`email`);

--
-- Indices de la tabla `visitantes`
--
ALTER TABLE `visitantes`
  ADD PRIMARY KEY (`idvisitante`),
  ADD KEY `ip` (`ip`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `acceso`
--
ALTER TABLE `acceso`
  MODIFY `idacceso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `estado`
--
ALTER TABLE `estado`
  MODIFY `idestado` int(2) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `imagen`
--
ALTER TABLE `imagen`
  MODIFY `idimagen` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=127;

--
-- AUTO_INCREMENT de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `pedidos_productos`
--
ALTER TABLE `pedidos_productos`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `preguntas`
--
ALTER TABLE `preguntas`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- AUTO_INCREMENT de la tabla `slide`
--
ALTER TABLE `slide`
  MODIFY `idslide` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `testimoniales`
--
ALTER TABLE `testimoniales`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `visitantes`
--
ALTER TABLE `visitantes`
  MODIFY `idvisitante` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD CONSTRAINT `pedidos_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`);

--
-- Filtros para la tabla `pedidos_productos`
--
ALTER TABLE `pedidos_productos`
  ADD CONSTRAINT `pedidos_productos_ibfk_1` FOREIGN KEY (`id_pedido`) REFERENCES `pedidos` (`id`),
  ADD CONSTRAINT `pedidos_productos_ibfk_2` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id`);

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `productos_ibfk_1` FOREIGN KEY (`idcategoria`) REFERENCES `categorias` (`id`);
