
DROP TABLE IF EXISTS `categorias`;
CREATE TABLE IF NOT EXISTS `categorias` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(80) COLLATE latin1_spanish_ci NOT NULL DEFAULT '',
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `orden` int(3) NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id`, `nombre`, `fecha`, `orden`, `status`) VALUES
(1, 'Proteina', '2019-04-06 00:27:20', 1, 1),
(2, 'Vegetales', '2019-04-06 00:27:20', 2, 1),
(3, 'Carbohidratos', '2019-04-06 00:27:20', 3, 1),
(4, 'Crudités', '2019-04-06 00:27:20', 4, 1),
(5, 'Fruta', '2019-04-06 00:27:20', 5, 1),
(6, 'Grasas', '2019-04-06 00:27:20', 6, 1),
(7, 'Salsas', '2019-04-06 00:27:20', 7, 1),
(8, 'Bebidas', '2019-04-06 00:27:20', 8, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `imagen`
--

DROP TABLE IF EXISTS `imagen`;
CREATE TABLE IF NOT EXISTS `imagen` (
  `idimagen` int(11) NOT NULL AUTO_INCREMENT,
  `idusuario` int(11) NOT NULL DEFAULT '0',
  `archivo` varchar(150) COLLATE latin1_spanish_ci NOT NULL DEFAULT '',
  `ruta` varchar(255) COLLATE latin1_spanish_ci NOT NULL DEFAULT '',
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` int(1) NOT NULL DEFAULT '1',
  `web` varchar(255) COLLATE latin1_spanish_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`idimagen`),
  KEY `idusuario` (`idusuario`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos`
--

DROP TABLE IF EXISTS `pedidos`;
CREATE TABLE IF NOT EXISTS `pedidos` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `fecha_pedido` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `fecha_entrega` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `importe` float(18,2) NOT NULL DEFAULT '0.00',
  `id_usuario` int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `id_usuario` (`id_usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos_productos`
--

DROP TABLE IF EXISTS `pedidos_productos`;
CREATE TABLE IF NOT EXISTS `pedidos_productos` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `id_pedido` int(10) NOT NULL DEFAULT '0',
  `id_producto` int(10) NOT NULL DEFAULT '0',
  `cantidad` int(3) NOT NULL DEFAULT '0',
  `importe` float(18,2) NOT NULL DEFAULT '0.00',
  PRIMARY KEY (`id`),
  KEY `id_pedido` (`id_pedido`),
  KEY `id_producto` (`id_producto`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

DROP TABLE IF EXISTS `productos`;
CREATE TABLE IF NOT EXISTS `productos` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `idcategoria` int(10) NOT NULL DEFAULT '0',
  `producto` varchar(120) COLLATE latin1_spanish_ci NOT NULL DEFAULT '',
  `caloria` varchar(60) COLLATE latin1_spanish_ci NOT NULL DEFAULT '',
  `precio` float(15,2) NOT NULL DEFAULT '0.00',
  `idimagen` int(10) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `orden` int(10) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `idcategoria` (`idcategoria`)
) ENGINE=InnoDB AUTO_INCREMENT=76 DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `idcategoria`, `producto`, `caloria`, `precio`, `idimagen`, `fecha`, `status`, `orden`) VALUES
(1, 1, 'Arrachera', '50 grms', 30.00, 0, '2019-04-06 00:37:44', 1, 1),
(2, 1, 'Pechuga de Pollo', '50 grms', 15.00, 0, '2019-04-06 00:37:44', 1, 1),
(3, 1, 'Molida de Cerdo', '50 grms', 25.00, 0, '2019-04-06 00:37:44', 1, 1),
(4, 1, 'Medallón Atún', '50 grms', 50.00, 0, '2019-04-06 00:37:44', 1, 1),
(5, 1, 'Atún en Agua', '50 grms', 15.00, 0, '2019-04-06 00:37:44', 1, 1),
(6, 1, 'Salmón', '50 grms', 60.00, 0, '2019-04-06 00:37:44', 1, 1),
(7, 1, 'Molida de Pavo', '50 grms', 25.00, 0, '2019-04-06 00:37:44', 1, 1),
(8, 1, 'Pavo Horneado', '50 grms', 20.00, 0, '2019-04-06 00:37:44', 1, 1),
(9, 1, 'Huevo Cocido', '1', 10.00, 0, '2019-04-06 00:37:44', 1, 1),
(10, 1, 'Tofu', '100 grms', 25.00, 0, '2019-04-06 00:37:44', 1, 1),
(11, 1, 'Requeson', '30 grms', 6.00, 0, '2019-04-06 00:37:44', 1, 1),
(12, 1, 'Queso Cabra', '30 grms', 15.00, 0, '2019-04-06 00:37:44', 1, 1),
(13, 1, 'Queso Feta', '30 grms', 15.00, 0, '2019-04-06 00:37:44', 1, 1),
(14, 1, 'Monterrey Jack', '30 grms', 9.00, 0, '2019-04-06 00:37:44', 1, 1),
(15, 1, 'Mozarella', '30 grms', 9.00, 0, '2019-04-06 00:37:44', 1, 1),
(16, 2, 'Sopa de Verduras', '1 tz', 15.00, 0, '2019-04-06 00:37:44', 1, 1),
(17, 2, 'Crema de Verduras', '1 tz', 15.00, 0, '2019-04-06 00:37:44', 1, 1),
(18, 2, 'Vegetales Verdes al Vapor', '1 tz', 15.00, 0, '2019-04-06 00:37:44', 1, 1),
(19, 2, 'Vegetales Verdes Rostizados', '1 tz', 15.00, 0, '2019-04-06 00:37:44', 1, 1),
(20, 2, 'Vegetales Mixtos al Vapor', '1 tz', 15.00, 0, '2019-04-06 00:37:44', 1, 1),
(21, 2, 'Vegetales Mixtos Rostizados', '1 tz', 15.00, 0, '2019-04-06 00:37:44', 1, 1),
(22, 3, 'Arroz', '1/3 Tz', 5.00, 0, '2019-04-06 00:37:44', 1, 1),
(23, 3, 'Quinoa', '1/3 Tz', 10.00, 0, '2019-04-06 00:37:44', 1, 1),
(24, 3, 'Frijoles', '1/4 tz', 5.00, 0, '2019-04-06 00:37:44', 1, 1),
(25, 3, 'Lentejas', '1/4 tz', 5.00, 0, '2019-04-06 00:37:44', 1, 1),
(26, 3, 'Elote', '1/2 tz', 5.00, 0, '2019-04-06 00:37:44', 1, 1),
(27, 3, 'Fusilli', '1/4 tz', 5.00, 0, '2019-04-06 00:37:44', 1, 1),
(28, 3, 'Camote', '1/2 Tz', 8.00, 0, '2019-04-06 00:37:44', 1, 1),
(29, 3, 'Papa Mediana', '1/3 pz', 5.00, 0, '2019-04-06 00:37:44', 1, 1),
(30, 3, 'Chicharo', '1/2 tz', 5.00, 0, '2019-04-06 00:37:44', 1, 1),
(31, 3, 'Pan de Pita', '1/4 pz', 3.00, 0, '2019-04-06 00:37:44', 1, 1),
(32, 3, 'Salmas', '1 Paquete', 5.00, 0, '2019-04-06 00:37:44', 1, 1),
(33, 3, 'Veguicheez', '1', 15.00, 0, '2019-04-06 00:37:44', 1, 1),
(34, 3, 'Kipes Vegetarianos', '2 pz', 50.00, 0, '2019-04-06 00:37:44', 1, 1),
(35, 4, 'Lechuga', '2.5 tz', 10.00, 0, '2019-04-06 00:37:44', 1, 1),
(36, 4, 'Espinaca', '2.5', 10.00, 0, '2019-04-06 00:37:44', 1, 1),
(37, 4, 'Pepino', '1 tz', 10.00, 0, '2019-04-06 00:37:44', 1, 1),
(38, 4, 'Apio', '1/2 tz', 10.00, 0, '2019-04-06 00:37:44', 1, 1),
(39, 4, 'Pimiento', '1/2 tz', 10.00, 0, '2019-04-06 00:37:44', 1, 1),
(40, 4, 'Jitomate Uva', '1/2 tz', 10.00, 0, '2019-04-06 00:37:44', 1, 1),
(41, 4, 'Champiñones', '1 tz', 10.00, 0, '2019-04-06 00:37:44', 1, 1),
(42, 4, 'Zanahoria Rallada', '1/4 tz', 10.00, 0, '2019-04-06 00:37:44', 1, 1),
(43, 5, 'Arandanos Deshidratados', '1/4 tz', 10.00, 0, '2019-04-06 00:37:44', 1, 1),
(44, 5, 'Manzana Pequeña', '1', 10.00, 0, '2019-04-06 00:37:44', 1, 1),
(45, 5, 'Fresa', '1 tz', 20.00, 0, '2019-04-06 00:37:44', 1, 1),
(46, 5, 'Melon', '1/4 pz', 10.00, 0, '2019-04-06 00:37:44', 1, 1),
(47, 5, 'Papaya', '1 tz', 10.00, 0, '2019-04-06 00:37:44', 1, 1),
(48, 5, 'Toronja', '1/2', 10.00, 0, '2019-04-06 00:37:44', 1, 1),
(49, 5, 'Zarzamoras', '3/4 tz', 20.00, 0, '2019-04-06 00:37:44', 1, 1),
(50, 5, 'Papaya', '1 tz', 10.00, 0, '2019-04-06 00:37:44', 1, 1),
(51, 6, 'Salsa tzatziki', '30 gmrs', 10.00, 0, '2019-04-06 00:37:44', 1, 1),
(52, 6, 'Humus', '30 grms', 10.00, 0, '2019-04-06 00:37:44', 1, 1),
(53, 6, 'Aceitunas Negras', '10', 10.00, 0, '2019-04-06 00:37:44', 1, 1),
(54, 6, 'Aceitunas Verdes', '8', 10.00, 0, '2019-04-06 00:37:44', 1, 1),
(55, 6, 'Aguacate', '1/4 pz', 5.00, 0, '2019-04-06 00:37:44', 1, 1),
(56, 6, 'Vinagreta Fresa', '1/4 tz', 5.00, 0, '2019-04-06 00:37:44', 1, 1),
(57, 6, 'Mostaza Miel', '1/4 tz', 5.00, 0, '2019-04-06 00:37:44', 1, 1),
(58, 6, 'Balsámico Miel', '1/4 tz', 5.00, 0, '2019-04-06 00:37:44', 1, 1),
(59, 6, 'Soya - Crema Cacahuate', '1/4 tz', 5.00, 0, '2019-04-06 00:37:44', 1, 1),
(60, 6, 'Aceite Oliva + Vinagre Manzana', '1/4 tz', 5.00, 0, '2019-04-06 00:37:44', 1, 1),
(61, 6, 'Almendras', '1/4 tz', 5.00, 0, '2019-04-06 00:37:44', 1, 1),
(62, 6, 'Ajonjolí', '1/4 tz', 5.00, 0, '2019-04-06 00:37:44', 1, 1),
(63, 6, 'Semillas de Girasol', '1/4 tz', 5.00, 0, '2019-04-06 00:37:44', 1, 1),
(64, 6, 'Pepitas de Calabaza', '1/4 tz', 5.00, 0, '2019-04-06 00:37:44', 1, 1),
(65, 7, 'Salsa Verde', '1/4 tz', 5.00, 0, '2019-04-06 00:37:44', 1, 1),
(66, 7, 'Salsa Chipotle', '1/4 tz', 5.00, 0, '2019-04-06 00:37:44', 1, 1),
(67, 7, 'Salsa Mexicana', '1/4 tz', 5.00, 0, '2019-04-06 00:37:44', 1, 1),
(68, 8, 'Agua', '1/2 lt', 5.00, 0, '2019-04-06 00:37:44', 1, 1),
(69, 8, 'Agua', '1 lt', 10.00, 0, '2019-04-06 00:37:44', 1, 1),
(70, 8, 'Agua Tamarindo', '1/2 lt', 10.00, 0, '2019-04-06 00:37:44', 1, 1),
(71, 8, 'Agua Tamarindo', '1 lt', 15.00, 0, '2019-04-06 00:37:44', 1, 1),
(72, 8, 'Agua Jamaica', '1/2 lt', 10.00, 0, '2019-04-06 00:37:44', 1, 1),
(73, 8, 'gua Jamaica', '1 lt', 15.00, 0, '2019-04-06 00:37:44', 1, 1),
(74, 8, 'Agua de Coco', '1', 20.00, 0, '2019-04-06 00:37:44', 1, 1),
(75, 8, 'Electrolit', '1', 25.00, 0, '2019-04-06 00:37:44', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `slide`
--

DROP TABLE IF EXISTS `slide`;
CREATE TABLE IF NOT EXISTS `slide` (
  `idslide` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(150) COLLATE latin1_spanish_ci NOT NULL DEFAULT '',
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` int(1) NOT NULL DEFAULT '1',
  `orden` int(10) NOT NULL DEFAULT '0',
  `texto_corto` varchar(255) COLLATE latin1_spanish_ci NOT NULL DEFAULT '''''',
  `texto_grande` varchar(255) COLLATE latin1_spanish_ci NOT NULL DEFAULT '',
  `texto_boton` varchar(64) COLLATE latin1_spanish_ci NOT NULL DEFAULT '',
  `url` text COLLATE latin1_spanish_ci NOT NULL,
  `idimagen` int(10) NOT NULL DEFAULT '0',
  `idimagenMovil` int(10) NOT NULL,
  PRIMARY KEY (`idslide`),
  KEY `idimagen` (`idimagen`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `testimoniales`
--

DROP TABLE IF EXISTS `testimoniales`;
CREATE TABLE IF NOT EXISTS `testimoniales` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(80) COLLATE latin1_spanish_ci NOT NULL DEFAULT '',
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `testimonial` text COLLATE latin1_spanish_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `testimoniales`
--

INSERT INTO `testimoniales` (`id`, `nombre`, `fecha`, `status`, `testimonial`) VALUES
(1, 'Luis Hernandez', '2019-04-06 01:00:00', 1, 'Test de testimonial');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE latin1_spanish_ci NOT NULL DEFAULT '',
  `email` varchar(255) COLLATE latin1_spanish_ci NOT NULL DEFAULT '',
  `password` varchar(255) COLLATE latin1_spanish_ci NOT NULL DEFAULT '',
  `passwordS` varchar(100) COLLATE latin1_spanish_ci NOT NULL DEFAULT '',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `activo` tinyint(1) NOT NULL DEFAULT '1',
  `dummy` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci COMMENT='Tabla que contiene la informacion de los usuarios del sistema';

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `passwordS`, `created_at`, `updated_at`, `activo`, `dummy`) VALUES
(1, 'Administrador', 'lciencias@gmail.com', '*84AAC12F54AB666ECFC2A83C676908C8BBC381B1', '12345678', '2018-04-27 23:08:12', '2018-04-27 23:08:12', 1, 0),
(2, 'Fernanda', 'fernanda@gmail.com', '*84AAC12F54AB666ECFC2A83C676908C8BBC381B1', '12345678', '0000-00-00 00:00:00', '2019-04-06 00:47:26', 1, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) COLLATE latin1_spanish_ci NOT NULL,
  `apellidos` varchar(100) COLLATE latin1_spanish_ci NOT NULL DEFAULT '',
  `email` varchar(60) COLLATE latin1_spanish_ci NOT NULL DEFAULT '',
  `contrasena` varchar(255) COLLATE latin1_spanish_ci NOT NULL DEFAULT '',
  `contrasenaS` varchar(30) COLLATE latin1_spanish_ci NOT NULL DEFAULT '',
  `celular` varchar(10) COLLATE latin1_spanish_ci NOT NULL DEFAULT '',
  `fecha_alta` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `fecha_ult_acceso` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `activo` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `index_email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `apellidos`, `email`, `contrasena`, `contrasenaS`, `celular`, `fecha_alta`, `fecha_ult_acceso`, `activo`) VALUES
(1, 'Luis Antonio', 'Hernandez Nieto', 'lciencias@gmail.com', '*84AAC12F54AB666ECFC2A83C676908C8BBC381B1', '12345678', '5537270124', '2019-04-06 00:14:33', '2019-04-06 00:14:33', 1);

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
