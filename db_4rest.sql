-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 06-05-2014 a las 21:46:25
-- Versión del servidor: 5.5.37-MariaDB-1~saucy-log
-- Versión de PHP: 5.5.99-hiphop

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `db_4rest`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `areadeproduccion`
--

CREATE TABLE IF NOT EXISTS `areadeproduccion` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `descripcion` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `id_tipo` int(11) unsigned DEFAULT NULL,
  `id_restaurante` int(11) DEFAULT NULL,
  `habiitado` int(11) NOT NULL,
  `ordennumber` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `fk_AreadeProduccion_1_idx` (`id_tipo`) USING BTREE,
  KEY `fk_AreadeProduccion_2_idx` (`id_restaurante`) USING BTREE
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `areadeproduccion`
--

INSERT INTO `areadeproduccion` (`id`, `nombre`, `descripcion`, `id_tipo`, `id_restaurante`, `habiitado`, `ordennumber`, `created_at`, `updated_at`) VALUES
(1, 'Cocina', '', 1, 2, 1, 304, '0000-00-00 00:00:00', '2014-05-05 08:21:06'),
(2, 'Barra', '', 3, 2, 1, 245, '0000-00-00 00:00:00', '2014-05-05 08:21:06'),
(3, 'Salon', '', 2, 2, 1, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `caja`
--

CREATE TABLE IF NOT EXISTS `caja` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `estado` tinyint(1) NOT NULL,
  `restaurante_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `caja_restaurante_id_foreign` (`restaurante_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `caja`
--

INSERT INTO `caja` (`id`, `descripcion`, `estado`, `restaurante_id`, `created_at`, `updated_at`) VALUES
(4, 'Caja Primer Piso', 1, 2, '0000-00-00 00:00:00', '2014-04-28 15:41:59');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `colaborador`
--

CREATE TABLE IF NOT EXISTS `colaborador` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `colaborador`
--

INSERT INTO `colaborador` (`id`, `nombre`, `created_at`, `updated_at`) VALUES
(1, 'Administrador', '2014-04-09 18:27:21', '0000-00-00 00:00:00'),
(2, 'Mozo', '2014-04-09 18:28:22', '0000-00-00 00:00:00'),
(3, 'Cajero', '2014-04-09 18:28:33', '0000-00-00 00:00:00'),
(4, 'Cocinero', '2014-04-09 18:29:37', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `combinacion`
--

CREATE TABLE IF NOT EXISTS `combinacion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(300) DEFAULT NULL,
  `descripcion` text,
  `HoraInicio` time DEFAULT NULL,
  `HoraTermino` time DEFAULT NULL,
  `FechaInicio` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `FechaTermino` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `TipoComb_id` int(11) DEFAULT NULL,
  `precio` decimal(5,2) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_Combinacion_TipoComb1_idx` (`TipoComb_id`) USING BTREE
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `combinacion`
--

INSERT INTO `combinacion` (`id`, `nombre`, `descripcion`, `HoraInicio`, `HoraTermino`, `FechaInicio`, `FechaTermino`, `created_at`, `updated_at`, `TipoComb_id`, `precio`) VALUES
(1, 'Normal', 'Normal', '00:00:00', '23:59:59', '2014-01-01 05:00:00', '2014-12-31 05:00:00', '2014-03-31 21:41:53', '2014-03-31 21:41:53', 1, 0.00),
(2, 'Menu', NULL, '00:00:00', '23:59:59', '2014-04-02 05:00:00', '2014-05-30 05:00:00', NULL, NULL, 2, 9.90),
(3, 'Desayuno Continental', 'desayunos', '00:00:00', '23:59:59', '2014-04-02 05:00:00', '2014-05-30 05:00:00', NULL, NULL, 3, 8.90);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detallecaja`
--

CREATE TABLE IF NOT EXISTS `detallecaja` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `montoInicial` decimal(10,2) DEFAULT NULL,
  `ventastotales` decimal(10,2) DEFAULT NULL COMMENT 'si en el dia se compra a un proveedor con plata sacada de caja',
  `arqueo` decimal(10,2) DEFAULT NULL,
  `diferencia` decimal(10,2) DEFAULT NULL COMMENT 'Monto final - deberia haber',
  `importetotal` decimal(10,2) DEFAULT NULL,
  `estado` varchar(1) DEFAULT NULL COMMENT 'abierto (a)\n cerrado (c) \neliminado (e)',
  `fechaInicio` timestamp NULL DEFAULT NULL,
  `fechaCierre` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `usuario_id` int(10) unsigned DEFAULT NULL,
  `caja_id` int(10) unsigned DEFAULT NULL,
  `gastos` decimal(5,2) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_caja_1_idx` (`usuario_id`),
  KEY `fk_detallecaja_1_idx` (`caja_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Volcado de datos para la tabla `detallecaja`
--

INSERT INTO `detallecaja` (`id`, `montoInicial`, `ventastotales`, `arqueo`, `diferencia`, `importetotal`, `estado`, `fechaInicio`, `fechaCierre`, `created_at`, `updated_at`, `usuario_id`, `caja_id`, `gastos`) VALUES
(6, 100.00, 51.30, NULL, 1.30, 31.30, 'C', '2014-04-28 03:41:45', NULL, '2014-04-28 03:41:45', '2014-04-28 15:33:58', 1, 4, 120.00),
(7, 200.00, 12.30, NULL, 2.30, 202.30, 'C', '2014-04-28 15:35:06', NULL, '2014-04-28 15:35:06', '2014-04-28 15:39:46', 1, 4, 10.00),
(8, 200.00, NULL, NULL, NULL, NULL, 'A', '2014-04-28 15:41:59', NULL, '2014-04-28 15:41:59', '2014-04-28 15:41:59', 1, 4, 0.00);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalleingresoinsumo`
--

CREATE TABLE IF NOT EXISTS `detalleingresoinsumo` (
  `ingreso_id` int(11) NOT NULL,
  `insumo_id` int(11) NOT NULL,
  `cantidad` decimal(10,2) DEFAULT NULL,
  `costo` decimal(10,2) DEFAULT NULL COMMENT 'costo del insumo en ese instante\n',
  `importe_final` decimal(10,2) DEFAULT NULL,
  `descuento_final` decimal(10,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`ingreso_id`,`insumo_id`),
  KEY `fk_DetalleIngresoInsumo_Ingreso1_idx` (`ingreso_id`) USING BTREE,
  KEY `fk_DetalleIngresoInsumo_Insumo1_idx` (`insumo_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detallenotas`
--

CREATE TABLE IF NOT EXISTS `detallenotas` (
  `detallePedido_id` int(11) NOT NULL,
  `notas_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  KEY `detallenotas_detallepedido_id_foreign` (`detallePedido_id`),
  KEY `detallenotas_notas_id_foreign` (`notas_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `detallenotas`
--

INSERT INTO `detallenotas` (`detallePedido_id`, `notas_id`, `created_at`, `updated_at`) VALUES
(86, 2, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(335, 2, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(335, 3, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(336, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(350, 2, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(350, 3, '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detallepedido`
--

CREATE TABLE IF NOT EXISTS `detallepedido` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pedido_id` int(11) NOT NULL,
  `producto_id` int(11) NOT NULL,
  `precioUnidadFinal` decimal(10,2) DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL COMMENT 'siempre serán unidades',
  `importeFinal` decimal(10,2) DEFAULT NULL,
  `descuento` double(22,0) DEFAULT NULL COMMENT 'es en porcentaje.. 0 a 1.. Si se sabe cuanto bajarle.. se pondrá el monto y se calculará el % q refleja.',
  `estado` char(1) DEFAULT NULL COMMENT 'Iniciado (i), En proceso (p), Para despachar (p), Despachado (d).',
  `fechaInicio` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `fechaProceso` timestamp NULL DEFAULT NULL,
  `fechaDespacho` timestamp NULL DEFAULT NULL,
  `fechaDespachado` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `detalle_id` int(11) DEFAULT NULL COMMENT 'en los productos adicionales, los detalles_id se llena con el id_DETALLE PEDIDO al cual el producto es adicional',
  `combinacion_id` int(11) DEFAULT NULL,
  `combinacion_c` int(11) DEFAULT NULL,
  `combinacion_cant` int(11) DEFAULT NULL,
  `ordenCocina` int(11) DEFAULT NULL COMMENT 'Orden de Cocina. Numero con que llega a la cocina.',
  `idarea` int(11) NOT NULL,
  `estado_t` int(10) unsigned DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `fk_detallePedido_Pedido1` (`pedido_id`) USING BTREE,
  KEY `fk_detallePedido_Producto1_idx` (`producto_id`) USING BTREE,
  KEY `fk_detallepedido_1_idx` (`estado_t`),
  KEY `fk_detallepedido_2_idx` (`combinacion_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=408 ;

--
-- Volcado de datos para la tabla `detallepedido`
--

INSERT INTO `detallepedido` (`id`, `pedido_id`, `producto_id`, `precioUnidadFinal`, `cantidad`, `importeFinal`, `descuento`, `estado`, `fechaInicio`, `fechaProceso`, `fechaDespacho`, `fechaDespachado`, `created_at`, `updated_at`, `detalle_id`, `combinacion_id`, `combinacion_c`, `combinacion_cant`, `ordenCocina`, `idarea`, `estado_t`) VALUES
(1, 1, 112, NULL, 1, 3.90, 0, 'I', '2014-04-26 23:48:03', NULL, NULL, NULL, '2014-04-26 23:48:03', '2014-04-26 23:48:03', NULL, NULL, NULL, NULL, 202, 2, 1),
(2, 1, 113, NULL, 1, 4.90, 0, 'I', '2014-04-26 23:48:03', NULL, NULL, NULL, '2014-04-26 23:48:03', '2014-04-26 23:48:03', NULL, NULL, NULL, NULL, 202, 2, 1),
(3, 1, 1, NULL, 1, 2.90, 0, 'I', '2014-04-26 23:48:03', NULL, NULL, NULL, '2014-04-26 23:48:03', '2014-04-26 23:48:03', NULL, 2, 1, 1, 202, 2, 1),
(4, 1, 198, NULL, 1, 1.40, 0, 'I', '2014-04-26 23:48:03', NULL, NULL, NULL, '2014-04-26 23:48:03', '2014-04-26 23:48:03', NULL, 2, 1, 1, 202, 2, 1),
(5, 1, 200, NULL, 1, 1.40, 0, 'E', '2014-04-26 23:48:03', '2014-04-30 06:46:08', NULL, NULL, '2014-04-26 23:48:03', '2014-04-30 06:46:08', NULL, 2, 1, 1, 232, 1, 1),
(6, 1, 197, NULL, 1, 1.40, 0, 'E', '2014-04-26 23:48:03', '2014-04-30 06:46:08', NULL, NULL, '2014-04-26 23:48:03', '2014-04-30 06:46:08', NULL, 2, 1, 1, 232, 1, 1),
(7, 1, 1, NULL, 1, 2.90, 0, 'I', '2014-04-26 23:48:03', NULL, NULL, NULL, '2014-04-26 23:48:03', '2014-04-26 23:48:03', NULL, 2, 2, 1, 202, 2, 1),
(8, 1, 198, NULL, 1, 1.40, 0, 'I', '2014-04-26 23:48:03', NULL, NULL, NULL, '2014-04-26 23:48:03', '2014-04-26 23:48:03', NULL, 2, 2, 1, 202, 2, 1),
(9, 1, 199, NULL, 1, 1.40, 0, 'E', '2014-04-26 23:48:03', '2014-04-30 06:46:08', NULL, NULL, '2014-04-26 23:48:03', '2014-04-30 06:46:08', NULL, 2, 2, 1, 232, 1, 1),
(10, 1, 196, NULL, 1, 1.40, 0, 'E', '2014-04-26 23:48:03', '2014-04-30 06:46:08', NULL, NULL, '2014-04-26 23:48:03', '2014-04-30 06:46:08', NULL, 2, 2, 1, 232, 1, 1),
(11, 1, 90, NULL, 1, 7.90, 0, 'E', '2014-04-27 04:19:22', '2014-04-30 06:46:09', NULL, NULL, '2014-04-27 04:19:22', '2014-04-30 06:46:09', NULL, NULL, NULL, NULL, 233, 1, 1),
(12, 1, 112, NULL, 1, 3.90, 0, 'I', '2014-04-28 14:36:32', NULL, NULL, NULL, '2014-04-28 14:36:32', '2014-04-28 14:36:32', NULL, NULL, NULL, NULL, 204, 2, 1),
(13, 1, 107, NULL, 1, 10.90, 0, 'I', '2014-04-28 14:39:09', NULL, NULL, NULL, '2014-04-28 14:39:09', '2014-04-28 14:39:09', NULL, NULL, NULL, NULL, 205, 2, 1),
(14, 1, 1, NULL, 1, 2.90, 0, 'I', '2014-04-28 14:40:07', NULL, NULL, NULL, '2014-04-28 14:40:07', '2014-04-28 14:40:07', NULL, NULL, NULL, NULL, 206, 2, 1),
(15, 1, 2, NULL, 1, 5.90, 0, 'I', '2014-04-28 14:40:08', NULL, NULL, NULL, '2014-04-28 14:40:08', '2014-04-28 14:40:08', NULL, NULL, NULL, NULL, 206, 2, 1),
(16, 2, 1, NULL, 1, 2.90, 0, 'I', '2014-04-28 15:37:17', NULL, NULL, NULL, '2014-04-28 15:37:17', '2014-04-28 15:37:17', NULL, NULL, NULL, NULL, 207, 2, 1),
(17, 2, 2, NULL, 1, 5.90, 0, 'I', '2014-04-28 15:37:17', NULL, NULL, NULL, '2014-04-28 15:37:17', '2014-04-28 15:37:17', NULL, NULL, NULL, NULL, 207, 2, 1),
(18, 2, 3, NULL, 1, 3.50, 0, 'I', '2014-04-28 15:37:17', NULL, NULL, NULL, '2014-04-28 15:37:17', '2014-04-28 15:37:17', NULL, NULL, NULL, NULL, 207, 2, 1),
(19, 3, 112, NULL, 1, 3.90, 0, 'I', '2014-04-28 17:15:48', NULL, NULL, NULL, '2014-04-28 17:15:48', '2014-04-28 17:15:48', NULL, NULL, NULL, NULL, 208, 2, 1),
(20, 3, 108, NULL, 1, 10.90, 0, 'I', '2014-04-28 17:15:48', NULL, NULL, NULL, '2014-04-28 17:15:48', '2014-04-28 17:15:48', NULL, NULL, NULL, NULL, 208, 2, 1),
(21, 3, 88, NULL, 1, 10.90, 0, 'I', '2014-04-28 17:15:48', NULL, NULL, NULL, '2014-04-28 17:15:48', '2014-04-28 17:15:48', NULL, NULL, NULL, NULL, 208, 2, 1),
(22, 3, 3, NULL, 1, 3.50, 0, 'I', '2014-04-28 17:22:24', NULL, NULL, NULL, '2014-04-28 17:22:24', '2014-04-28 17:22:24', NULL, NULL, NULL, NULL, 209, 2, 1),
(23, 3, 4, NULL, 1, 3.50, 0, 'I', '2014-04-28 17:22:24', NULL, NULL, NULL, '2014-04-28 17:22:24', '2014-04-28 17:22:24', NULL, NULL, NULL, NULL, 209, 2, 1),
(24, 3, 5, NULL, 1, 2.50, 0, 'I', '2014-04-28 17:22:24', NULL, NULL, NULL, '2014-04-28 17:22:24', '2014-04-28 17:22:24', NULL, NULL, NULL, NULL, 209, 2, 1),
(25, 2, 95, NULL, 1, 5.90, 0, 'I', '2014-04-28 17:38:26', NULL, NULL, NULL, '2014-04-28 17:38:26', '2014-04-28 17:38:26', NULL, NULL, NULL, NULL, 210, 2, 1),
(26, 2, 96, NULL, 1, 5.90, 0, 'I', '2014-04-28 17:38:26', NULL, NULL, NULL, '2014-04-28 17:38:26', '2014-04-28 17:38:26', NULL, NULL, NULL, NULL, 210, 2, 1),
(27, 2, 97, NULL, 1, 5.90, 0, 'I', '2014-04-28 17:38:26', NULL, NULL, NULL, '2014-04-28 17:38:26', '2014-04-28 17:38:26', NULL, NULL, NULL, NULL, 210, 2, 1),
(28, 2, 98, NULL, 1, 5.90, 0, 'I', '2014-04-28 17:38:26', NULL, NULL, NULL, '2014-04-28 17:38:26', '2014-04-28 17:38:26', NULL, NULL, NULL, NULL, 210, 2, 1),
(29, 2, 99, NULL, 1, 5.90, 0, 'I', '2014-04-28 17:38:26', NULL, NULL, NULL, '2014-04-28 17:38:26', '2014-04-28 17:38:26', NULL, NULL, NULL, NULL, 210, 2, 1),
(30, 2, 100, NULL, 1, 5.90, 0, 'I', '2014-04-28 17:38:26', NULL, NULL, NULL, '2014-04-28 17:38:26', '2014-04-28 17:38:26', NULL, NULL, NULL, NULL, 210, 2, 1),
(31, 2, 130, NULL, 1, 1.00, 0, 'E', '2014-04-29 23:10:34', '2014-04-30 06:46:10', NULL, NULL, '2014-04-29 23:10:34', '2014-04-30 06:46:10', NULL, NULL, NULL, NULL, 237, 1, 1),
(32, 1, 134, NULL, 1, 1.00, 0, 'E', '2014-04-29 23:12:13', '2014-04-30 06:46:11', NULL, NULL, '2014-04-29 23:12:13', '2014-04-30 06:46:11', NULL, NULL, NULL, NULL, 238, 1, 1),
(33, 4, 1, NULL, 1, 2.90, 0, 'I', '2014-04-29 23:13:16', NULL, NULL, NULL, '2014-04-29 23:13:16', '2014-04-29 23:13:16', NULL, NULL, NULL, NULL, 213, 2, 1),
(34, 2, 1, NULL, 1, 1.40, 0, 'I', '2014-04-29 23:14:52', NULL, NULL, NULL, '2014-04-29 23:14:52', '2014-04-29 23:14:52', NULL, 2, 1, 1, 214, 2, 1),
(35, 2, 198, NULL, 1, 1.40, 0, 'I', '2014-04-29 23:14:52', NULL, NULL, NULL, '2014-04-29 23:14:52', '2014-04-29 23:14:52', NULL, 2, 1, 1, 214, 2, 1),
(36, 2, 199, NULL, 1, 1.40, 0, 'E', '2014-04-29 23:14:52', '2014-04-30 06:46:12', NULL, NULL, '2014-04-29 23:14:52', '2014-04-30 06:46:12', NULL, 2, 1, 1, 239, 1, 1),
(37, 2, 196, NULL, 1, 1.40, 0, 'E', '2014-04-29 23:14:52', '2014-04-30 06:46:12', NULL, NULL, '2014-04-29 23:14:52', '2014-04-30 06:46:12', NULL, 2, 1, 1, 239, 1, 1),
(38, 2, 200, NULL, 1, 2.00, 0, 'E', '2014-04-29 23:24:00', '2014-04-30 06:46:13', NULL, NULL, '2014-04-29 23:24:00', '2014-04-30 06:46:13', NULL, 3, 1, 1, 240, 1, 1),
(39, 2, 200, NULL, 1, 2.00, 0, 'E', '2014-04-29 23:24:00', '2014-04-30 06:46:13', NULL, NULL, '2014-04-29 23:24:00', '2014-04-30 06:46:13', NULL, 3, 1, 1, 240, 1, 1),
(40, 2, 196, NULL, 1, 2.00, 0, 'E', '2014-04-29 23:24:00', '2014-04-30 06:46:13', NULL, NULL, '2014-04-29 23:24:00', '2014-04-30 06:46:13', NULL, 3, 1, 1, 240, 1, 1),
(41, 2, 113, NULL, 1, 4.90, 0, 'I', '2014-04-29 23:29:07', NULL, NULL, NULL, '2014-04-29 23:29:07', '2014-04-29 23:29:07', NULL, NULL, NULL, NULL, 216, 2, 1),
(42, 2, 112, NULL, 1, 3.90, 0, 'I', '2014-04-29 23:29:07', NULL, NULL, NULL, '2014-04-29 23:29:07', '2014-04-29 23:29:07', NULL, NULL, NULL, NULL, 216, 2, 1),
(43, 2, 114, NULL, 1, 6.90, 0, 'I', '2014-04-29 23:29:07', NULL, NULL, NULL, '2014-04-29 23:29:07', '2014-04-29 23:29:07', NULL, NULL, NULL, NULL, 216, 2, 1),
(44, 2, 49, NULL, 1, 12.90, 0, 'E', '2014-04-29 23:31:36', '2014-04-30 06:46:13', NULL, NULL, '2014-04-29 23:31:36', '2014-04-30 06:46:13', NULL, NULL, NULL, NULL, 242, 1, 1),
(45, 2, 48, NULL, 1, 12.90, 0, 'E', '2014-04-29 23:31:37', '2014-04-30 06:46:13', NULL, NULL, '2014-04-29 23:31:37', '2014-04-30 06:46:13', NULL, NULL, NULL, NULL, 242, 1, 1),
(46, 4, 90, NULL, 1, 7.90, 0, 'E', '2014-04-29 23:43:29', '2014-04-30 06:46:14', NULL, NULL, '2014-04-29 23:43:29', '2014-04-30 06:46:14', NULL, NULL, NULL, NULL, 243, 1, 1),
(47, 4, 91, NULL, 1, 7.90, 0, 'E', '2014-04-29 23:43:29', '2014-04-30 06:46:14', NULL, NULL, '2014-04-29 23:43:29', '2014-04-30 06:46:14', NULL, NULL, NULL, NULL, 243, 1, 1),
(48, 4, 92, NULL, 1, 7.90, 0, 'E', '2014-04-29 23:43:29', '2014-04-30 06:46:14', NULL, NULL, '2014-04-29 23:43:29', '2014-04-30 06:46:14', NULL, NULL, NULL, NULL, 243, 1, 1),
(49, 4, 93, NULL, 1, 7.90, 0, 'E', '2014-04-29 23:43:29', '2014-04-30 06:46:14', NULL, NULL, '2014-04-29 23:43:29', '2014-04-30 06:46:14', NULL, NULL, NULL, NULL, 243, 1, 1),
(50, 4, 94, NULL, 1, 3.90, 0, 'E', '2014-04-29 23:43:29', '2014-04-30 06:46:14', NULL, NULL, '2014-04-29 23:43:29', '2014-04-30 06:46:14', NULL, NULL, NULL, NULL, 243, 1, 1),
(51, 4, 1, NULL, 1, 1.40, 0, 'I', '2014-04-29 23:43:29', NULL, NULL, NULL, '2014-04-29 23:43:29', '2014-04-29 23:43:29', NULL, 2, 1, 1, 218, 2, 1),
(52, 4, 198, NULL, 1, 1.40, 0, 'I', '2014-04-29 23:43:29', NULL, NULL, NULL, '2014-04-29 23:43:29', '2014-04-29 23:43:29', NULL, 2, 1, 1, 218, 2, 1),
(53, 4, 200, NULL, 1, 1.40, 0, 'E', '2014-04-29 23:43:29', '2014-04-30 06:46:14', NULL, NULL, '2014-04-29 23:43:29', '2014-04-30 06:46:14', NULL, 2, 1, 1, 243, 1, 1),
(54, 4, 197, NULL, 1, 1.40, 0, 'E', '2014-04-29 23:43:29', '2014-04-30 06:46:14', NULL, NULL, '2014-04-29 23:43:29', '2014-04-30 06:46:14', NULL, 2, 1, 1, 243, 1, 1),
(55, 4, 1, NULL, 1, 1.40, 0, 'I', '2014-04-29 23:43:29', NULL, NULL, NULL, '2014-04-29 23:43:29', '2014-04-29 23:43:29', NULL, 2, 2, 1, 218, 2, 1),
(56, 4, 198, NULL, 1, 1.40, 0, 'I', '2014-04-29 23:43:29', NULL, NULL, NULL, '2014-04-29 23:43:29', '2014-04-29 23:43:29', NULL, 2, 2, 1, 218, 2, 1),
(57, 4, 199, NULL, 1, 1.40, 0, 'E', '2014-04-29 23:43:29', '2014-04-30 06:46:14', NULL, NULL, '2014-04-29 23:43:29', '2014-04-30 06:46:14', NULL, 2, 2, 1, 243, 1, 1),
(58, 4, 196, NULL, 1, 1.40, 0, 'E', '2014-04-29 23:43:29', '2014-04-30 06:46:14', NULL, NULL, '2014-04-29 23:43:29', '2014-04-30 06:46:14', NULL, 2, 2, 1, 243, 1, 1),
(59, 4, 200, NULL, 1, 2.00, 0, 'E', '2014-04-29 23:43:29', '2014-04-30 06:46:14', NULL, NULL, '2014-04-29 23:43:29', '2014-04-30 06:46:14', NULL, 3, 1, 1, 243, 1, 1),
(60, 4, 200, NULL, 1, 2.00, 0, 'E', '2014-04-29 23:43:29', '2014-04-30 06:46:14', NULL, NULL, '2014-04-29 23:43:29', '2014-04-30 06:46:14', NULL, 3, 1, 1, 243, 1, 1),
(61, 4, 196, NULL, 1, 2.00, 0, 'E', '2014-04-29 23:43:29', '2014-04-30 06:46:14', NULL, NULL, '2014-04-29 23:43:29', '2014-04-30 06:46:14', NULL, 3, 1, 1, 243, 1, 1),
(62, 4, 200, NULL, 1, 2.00, 0, 'E', '2014-04-29 23:43:29', '2014-04-30 06:46:14', NULL, NULL, '2014-04-29 23:43:29', '2014-04-30 06:46:14', NULL, 3, 2, 1, 243, 1, 1),
(63, 4, 200, NULL, 1, 2.00, 0, 'E', '2014-04-29 23:43:29', '2014-04-30 06:46:14', NULL, NULL, '2014-04-29 23:43:29', '2014-04-30 06:46:14', NULL, 3, 2, 1, 243, 1, 1),
(64, 4, 196, NULL, 1, 2.00, 0, 'E', '2014-04-29 23:43:29', '2014-04-30 06:46:14', NULL, NULL, '2014-04-29 23:43:29', '2014-04-30 06:46:14', NULL, 3, 2, 1, 243, 1, 1),
(65, 5, 123, NULL, 1, 10.90, 0, 'E', '2014-04-30 05:32:47', '2014-04-30 06:46:15', NULL, NULL, '2014-04-30 05:32:47', '2014-04-30 06:46:15', NULL, NULL, NULL, NULL, 244, 1, 1),
(66, 5, 130, NULL, 2, 2.00, 0, 'E', '2014-04-30 05:32:47', '2014-04-30 06:46:15', NULL, NULL, '2014-04-30 05:32:47', '2014-04-30 06:46:15', 65, NULL, NULL, NULL, 244, 1, 1),
(67, 5, 131, NULL, 1, 1.00, 0, 'E', '2014-04-30 05:32:47', '2014-04-30 06:46:15', NULL, NULL, '2014-04-30 05:32:47', '2014-04-30 06:46:15', 65, NULL, NULL, NULL, 244, 1, 1),
(68, 5, 62, NULL, 1, 4.90, 0, 'I', '2014-04-30 05:43:10', NULL, NULL, NULL, '2014-04-30 05:43:10', '2014-04-30 05:43:10', NULL, NULL, NULL, NULL, 219, 2, 1),
(69, 5, 63, NULL, 1, 6.90, 0, 'I', '2014-04-30 05:43:10', NULL, NULL, NULL, '2014-04-30 05:43:10', '2014-04-30 05:43:10', NULL, NULL, NULL, NULL, 219, 2, 1),
(70, 5, 90, NULL, 1, 7.90, 0, 'E', '2014-04-30 06:48:24', '2014-04-30 06:53:27', NULL, NULL, '2014-04-30 06:48:24', '2014-04-30 06:53:27', NULL, NULL, NULL, NULL, 246, 1, 1),
(71, 5, 91, NULL, 1, 7.90, 0, 'E', '2014-04-30 06:48:36', '2014-04-30 06:53:28', NULL, NULL, '2014-04-30 06:48:36', '2014-04-30 06:53:28', NULL, NULL, NULL, NULL, 247, 1, 1),
(72, 5, 186, NULL, 1, 10.90, 0, 'E', '2014-04-30 06:51:07', '2014-04-30 06:53:30', NULL, NULL, '2014-04-30 06:51:07', '2014-04-30 06:53:30', NULL, NULL, NULL, NULL, 248, 1, 1),
(73, 5, 187, NULL, 1, 11.90, 0, 'E', '2014-04-30 06:51:51', '2014-04-30 06:53:31', NULL, NULL, '2014-04-30 06:51:51', '2014-04-30 06:53:31', NULL, NULL, NULL, NULL, 249, 1, 1),
(74, 5, 47, NULL, 1, 3.50, 0, 'P', '2014-04-30 06:53:47', '2014-04-30 07:06:15', NULL, NULL, '2014-04-30 06:53:47', '2014-04-30 07:06:15', NULL, NULL, NULL, NULL, 250, 1, 1),
(75, 5, 48, NULL, 1, 12.90, 0, 'P', '2014-04-30 06:55:53', '2014-04-30 07:06:28', NULL, NULL, '2014-04-30 06:55:53', '2014-04-30 07:06:28', NULL, NULL, NULL, NULL, 251, 1, 1),
(76, 4, 49, NULL, 1, 12.90, 0, 'I', '2014-04-30 06:58:45', NULL, NULL, NULL, '2014-04-30 06:58:45', '2014-04-30 06:58:45', NULL, NULL, NULL, NULL, 252, 1, 1),
(77, 5, 62, NULL, 1, 4.90, 0, 'I', '2014-04-30 16:02:47', NULL, NULL, NULL, '2014-04-30 16:02:47', '2014-04-30 16:02:47', NULL, NULL, NULL, NULL, 227, 2, 1),
(78, 5, 63, NULL, 1, 6.90, 0, 'I', '2014-04-30 16:02:47', NULL, NULL, NULL, '2014-04-30 16:02:47', '2014-04-30 16:02:47', NULL, NULL, NULL, NULL, 227, 2, 1),
(79, 5, 123, NULL, 1, 10.90, 0, 'I', '2014-04-30 16:02:48', NULL, NULL, NULL, '2014-04-30 16:02:48', '2014-04-30 16:02:48', NULL, NULL, NULL, NULL, 253, 1, 1),
(80, 5, 130, NULL, 2, 2.00, 0, 'I', '2014-04-30 16:02:48', NULL, NULL, NULL, '2014-04-30 16:02:48', '2014-04-30 16:02:48', 79, NULL, NULL, NULL, 253, 1, 1),
(81, 5, 131, NULL, 1, 1.00, 0, 'I', '2014-04-30 16:02:48', NULL, NULL, NULL, '2014-04-30 16:02:48', '2014-04-30 16:02:48', 79, NULL, NULL, NULL, 253, 1, 1),
(82, 5, 1, NULL, 1, 1.40, 0, 'I', '2014-04-30 16:02:48', NULL, NULL, NULL, '2014-04-30 16:02:48', '2014-04-30 16:02:48', NULL, 2, 1, 1, 227, 2, 1),
(83, 5, 198, NULL, 1, 1.40, 0, 'I', '2014-04-30 16:02:48', NULL, NULL, NULL, '2014-04-30 16:02:48', '2014-04-30 16:02:48', NULL, 2, 1, 1, 227, 2, 1),
(84, 5, 200, NULL, 1, 1.40, 0, 'I', '2014-04-30 16:02:48', NULL, NULL, NULL, '2014-04-30 16:02:48', '2014-04-30 16:02:48', NULL, 2, 1, 1, 253, 1, 1),
(85, 5, 196, NULL, 1, 1.40, 0, 'I', '2014-04-30 16:02:48', NULL, NULL, NULL, '2014-04-30 16:02:48', '2014-04-30 16:02:48', NULL, 2, 1, 1, 253, 1, 1),
(86, 5, 1, NULL, 1, 1.40, 0, 'I', '2014-04-30 16:02:48', NULL, NULL, NULL, '2014-04-30 16:02:48', '2014-04-30 16:02:48', NULL, 2, 2, 1, 227, 2, 1),
(87, 5, 198, NULL, 1, 1.40, 0, 'I', '2014-04-30 16:02:48', NULL, NULL, NULL, '2014-04-30 16:02:48', '2014-04-30 16:02:48', NULL, 2, 2, 1, 227, 2, 1),
(88, 5, 199, NULL, 1, 1.40, 0, 'I', '2014-04-30 16:02:48', NULL, NULL, NULL, '2014-04-30 16:02:48', '2014-04-30 16:02:48', NULL, 2, 2, 1, 253, 1, 1),
(89, 5, 197, NULL, 1, 1.40, 0, 'I', '2014-04-30 16:02:48', NULL, NULL, NULL, '2014-04-30 16:02:48', '2014-04-30 16:02:48', NULL, 2, 2, 1, 253, 1, 1),
(90, 6, 46, NULL, 1, 4.90, 0, 'I', '2014-05-02 04:03:51', NULL, NULL, NULL, '2014-05-02 04:03:51', '2014-05-02 04:03:51', NULL, NULL, NULL, NULL, 254, 1, 1),
(91, 6, 47, NULL, 1, 3.50, 0, 'I', '2014-05-02 04:03:51', NULL, NULL, NULL, '2014-05-02 04:03:51', '2014-05-02 04:03:51', NULL, NULL, NULL, NULL, 254, 1, 1),
(92, 6, 48, NULL, 1, 12.90, 0, 'I', '2014-05-02 04:03:51', NULL, NULL, NULL, '2014-05-02 04:03:51', '2014-05-02 04:03:51', NULL, NULL, NULL, NULL, 254, 1, 1),
(93, 6, 49, NULL, 1, 12.90, 0, 'I', '2014-05-02 04:03:51', NULL, NULL, NULL, '2014-05-02 04:03:51', '2014-05-02 04:03:51', NULL, NULL, NULL, NULL, 254, 1, 1),
(94, 6, 50, NULL, 1, 12.90, 0, 'I', '2014-05-02 04:03:52', NULL, NULL, NULL, '2014-05-02 04:03:52', '2014-05-02 04:03:52', NULL, NULL, NULL, NULL, 254, 1, 1),
(95, 7, 46, NULL, 1, 4.90, 0, 'I', '2014-05-02 04:06:32', NULL, NULL, NULL, '2014-05-02 04:06:32', '2014-05-02 04:06:32', NULL, NULL, NULL, NULL, 255, 1, 1),
(96, 7, 47, NULL, 1, 3.50, 0, 'I', '2014-05-02 04:06:32', NULL, NULL, NULL, '2014-05-02 04:06:32', '2014-05-02 04:06:32', NULL, NULL, NULL, NULL, 255, 1, 1),
(97, 7, 48, NULL, 1, 12.90, 0, 'I', '2014-05-02 04:06:32', NULL, NULL, NULL, '2014-05-02 04:06:32', '2014-05-02 04:06:32', NULL, NULL, NULL, NULL, 255, 1, 1),
(98, 7, 49, NULL, 1, 12.90, 0, 'I', '2014-05-02 04:06:32', NULL, NULL, NULL, '2014-05-02 04:06:32', '2014-05-02 04:06:32', NULL, NULL, NULL, NULL, 255, 1, 1),
(99, 7, 50, NULL, 1, 12.90, 0, 'I', '2014-05-02 04:06:32', NULL, NULL, NULL, '2014-05-02 04:06:32', '2014-05-02 04:06:32', NULL, NULL, NULL, NULL, 255, 1, 1),
(100, 8, 46, NULL, 1, 4.90, 0, 'I', '2014-05-02 04:08:42', NULL, NULL, NULL, '2014-05-02 04:08:42', '2014-05-02 04:08:42', NULL, NULL, NULL, NULL, 256, 1, 1),
(101, 8, 47, NULL, 1, 3.50, 0, 'I', '2014-05-02 04:08:42', NULL, NULL, NULL, '2014-05-02 04:08:42', '2014-05-02 04:08:42', NULL, NULL, NULL, NULL, 256, 1, 1),
(102, 8, 48, NULL, 1, 12.90, 0, 'I', '2014-05-02 04:08:42', NULL, NULL, NULL, '2014-05-02 04:08:42', '2014-05-02 04:08:42', NULL, NULL, NULL, NULL, 256, 1, 1),
(103, 8, 49, NULL, 1, 12.90, 0, 'I', '2014-05-02 04:08:42', NULL, NULL, NULL, '2014-05-02 04:08:42', '2014-05-02 04:08:42', NULL, NULL, NULL, NULL, 256, 1, 1),
(104, 8, 50, NULL, 1, 12.90, 0, 'I', '2014-05-02 04:08:42', NULL, NULL, NULL, '2014-05-02 04:08:42', '2014-05-02 04:08:42', NULL, NULL, NULL, NULL, 256, 1, 1),
(105, 9, 90, NULL, 1, 7.90, 0, 'I', '2014-05-02 04:14:02', NULL, NULL, NULL, '2014-05-02 04:14:02', '2014-05-02 04:14:02', NULL, NULL, NULL, NULL, 257, 1, 1),
(106, 9, 91, NULL, 1, 7.90, 0, 'I', '2014-05-02 04:14:02', NULL, NULL, NULL, '2014-05-02 04:14:02', '2014-05-02 04:14:02', NULL, NULL, NULL, NULL, 257, 1, 1),
(107, 9, 92, NULL, 1, 7.90, 0, 'I', '2014-05-02 04:14:02', NULL, NULL, NULL, '2014-05-02 04:14:02', '2014-05-02 04:14:02', NULL, NULL, NULL, NULL, 257, 1, 1),
(108, 9, 93, NULL, 1, 7.90, 0, 'I', '2014-05-02 04:14:02', NULL, NULL, NULL, '2014-05-02 04:14:02', '2014-05-02 04:14:02', NULL, NULL, NULL, NULL, 257, 1, 1),
(109, 9, 94, NULL, 1, 3.90, 0, 'I', '2014-05-02 04:14:02', NULL, NULL, NULL, '2014-05-02 04:14:02', '2014-05-02 04:14:02', NULL, NULL, NULL, NULL, 257, 1, 1),
(110, 10, 90, NULL, 1, 7.90, 0, 'I', '2014-05-02 04:15:34', NULL, NULL, NULL, '2014-05-02 04:15:34', '2014-05-02 04:15:34', NULL, NULL, NULL, NULL, 258, 1, 1),
(111, 10, 91, NULL, 1, 7.90, 0, 'I', '2014-05-02 04:15:34', NULL, NULL, NULL, '2014-05-02 04:15:34', '2014-05-02 04:15:34', NULL, NULL, NULL, NULL, 258, 1, 1),
(112, 10, 92, NULL, 1, 7.90, 0, 'I', '2014-05-02 04:15:34', NULL, NULL, NULL, '2014-05-02 04:15:34', '2014-05-02 04:15:34', NULL, NULL, NULL, NULL, 258, 1, 1),
(113, 10, 93, NULL, 1, 7.90, 0, 'I', '2014-05-02 04:15:35', NULL, NULL, NULL, '2014-05-02 04:15:35', '2014-05-02 04:15:35', NULL, NULL, NULL, NULL, 258, 1, 1),
(114, 10, 94, NULL, 1, 3.90, 0, 'I', '2014-05-02 04:15:35', NULL, NULL, NULL, '2014-05-02 04:15:35', '2014-05-02 04:15:35', NULL, NULL, NULL, NULL, 258, 1, 1),
(115, 11, 90, NULL, 1, 7.90, 0, 'I', '2014-05-02 04:19:49', NULL, NULL, NULL, '2014-05-02 04:19:49', '2014-05-02 04:19:49', NULL, NULL, NULL, NULL, 259, 1, 1),
(116, 11, 91, NULL, 1, 7.90, 0, 'I', '2014-05-02 04:19:50', NULL, NULL, NULL, '2014-05-02 04:19:50', '2014-05-02 04:19:50', NULL, NULL, NULL, NULL, 259, 1, 1),
(117, 11, 92, NULL, 1, 7.90, 0, 'I', '2014-05-02 04:19:50', NULL, NULL, NULL, '2014-05-02 04:19:50', '2014-05-02 04:19:50', NULL, NULL, NULL, NULL, 259, 1, 1),
(118, 11, 93, NULL, 1, 7.90, 0, 'I', '2014-05-02 04:19:50', NULL, NULL, NULL, '2014-05-02 04:19:50', '2014-05-02 04:19:50', NULL, NULL, NULL, NULL, 259, 1, 1),
(119, 11, 94, NULL, 1, 3.90, 0, 'I', '2014-05-02 04:19:50', NULL, NULL, NULL, '2014-05-02 04:19:50', '2014-05-02 04:19:50', NULL, NULL, NULL, NULL, 259, 1, 1),
(120, 12, 90, NULL, 1, 7.90, 0, 'I', '2014-05-02 04:30:16', NULL, NULL, NULL, '2014-05-02 04:30:16', '2014-05-02 04:30:16', NULL, NULL, NULL, NULL, 260, 1, 1),
(121, 12, 91, NULL, 1, 7.90, 0, 'I', '2014-05-02 04:30:16', NULL, NULL, NULL, '2014-05-02 04:30:16', '2014-05-02 04:30:16', NULL, NULL, NULL, NULL, 260, 1, 1),
(122, 12, 92, NULL, 1, 7.90, 0, 'I', '2014-05-02 04:30:16', NULL, NULL, NULL, '2014-05-02 04:30:16', '2014-05-02 04:30:16', NULL, NULL, NULL, NULL, 260, 1, 1),
(123, 12, 93, NULL, 1, 7.90, 0, 'I', '2014-05-02 04:30:16', NULL, NULL, NULL, '2014-05-02 04:30:16', '2014-05-02 04:30:16', NULL, NULL, NULL, NULL, 260, 1, 1),
(124, 12, 94, NULL, 1, 3.90, 0, 'I', '2014-05-02 04:30:16', NULL, NULL, NULL, '2014-05-02 04:30:16', '2014-05-02 04:30:16', NULL, NULL, NULL, NULL, 260, 1, 1),
(125, 13, 90, NULL, 1, 7.90, 0, 'I', '2014-05-02 04:31:00', NULL, NULL, NULL, '2014-05-02 04:31:00', '2014-05-02 04:31:00', NULL, NULL, NULL, NULL, 261, 1, 1),
(126, 13, 91, NULL, 1, 7.90, 0, 'I', '2014-05-02 04:31:00', NULL, NULL, NULL, '2014-05-02 04:31:00', '2014-05-02 04:31:00', NULL, NULL, NULL, NULL, 261, 1, 1),
(127, 13, 92, NULL, 1, 7.90, 0, 'I', '2014-05-02 04:31:00', NULL, NULL, NULL, '2014-05-02 04:31:00', '2014-05-02 04:31:00', NULL, NULL, NULL, NULL, 261, 1, 1),
(128, 13, 93, NULL, 1, 7.90, 0, 'I', '2014-05-02 04:31:00', NULL, NULL, NULL, '2014-05-02 04:31:00', '2014-05-02 04:31:00', NULL, NULL, NULL, NULL, 261, 1, 1),
(129, 13, 94, NULL, 1, 3.90, 0, 'I', '2014-05-02 04:31:01', NULL, NULL, NULL, '2014-05-02 04:31:01', '2014-05-02 04:31:01', NULL, NULL, NULL, NULL, 261, 1, 1),
(130, 14, 90, NULL, 1, 7.90, 0, 'I', '2014-05-02 04:51:48', NULL, NULL, NULL, '2014-05-02 04:51:48', '2014-05-02 04:51:48', NULL, NULL, NULL, NULL, 262, 1, 1),
(131, 14, 91, NULL, 1, 7.90, 0, 'I', '2014-05-02 04:51:48', NULL, NULL, NULL, '2014-05-02 04:51:48', '2014-05-02 04:51:48', NULL, NULL, NULL, NULL, 262, 1, 1),
(132, 14, 92, NULL, 1, 7.90, 0, 'I', '2014-05-02 04:51:48', NULL, NULL, NULL, '2014-05-02 04:51:48', '2014-05-02 04:51:48', NULL, NULL, NULL, NULL, 262, 1, 1),
(133, 14, 93, NULL, 1, 7.90, 0, 'I', '2014-05-02 04:51:48', NULL, NULL, NULL, '2014-05-02 04:51:48', '2014-05-02 04:51:48', NULL, NULL, NULL, NULL, 262, 1, 1),
(134, 14, 94, NULL, 1, 3.90, 0, 'I', '2014-05-02 04:51:48', NULL, NULL, NULL, '2014-05-02 04:51:48', '2014-05-02 04:51:48', NULL, NULL, NULL, NULL, 262, 1, 1),
(135, 15, 90, NULL, 1, 7.90, 0, 'I', '2014-05-02 04:53:06', NULL, NULL, NULL, '2014-05-02 04:53:06', '2014-05-02 04:53:06', NULL, NULL, NULL, NULL, 263, 1, 1),
(136, 15, 91, NULL, 1, 7.90, 0, 'I', '2014-05-02 04:53:06', NULL, NULL, NULL, '2014-05-02 04:53:06', '2014-05-02 04:53:06', NULL, NULL, NULL, NULL, 263, 1, 1),
(137, 15, 92, NULL, 1, 7.90, 0, 'I', '2014-05-02 04:53:06', NULL, NULL, NULL, '2014-05-02 04:53:06', '2014-05-02 04:53:06', NULL, NULL, NULL, NULL, 263, 1, 1),
(138, 15, 93, NULL, 1, 7.90, 0, 'I', '2014-05-02 04:53:06', NULL, NULL, NULL, '2014-05-02 04:53:06', '2014-05-02 04:53:06', NULL, NULL, NULL, NULL, 263, 1, 1),
(139, 15, 94, NULL, 1, 3.90, 0, 'I', '2014-05-02 04:53:06', NULL, NULL, NULL, '2014-05-02 04:53:06', '2014-05-02 04:53:06', NULL, NULL, NULL, NULL, 263, 1, 1),
(140, 15, 90, NULL, 1, 7.90, 0, 'I', '2014-05-02 04:53:42', NULL, NULL, NULL, '2014-05-02 04:53:42', '2014-05-02 04:53:42', NULL, NULL, NULL, NULL, 264, 1, 1),
(141, 15, 91, NULL, 1, 7.90, 0, 'I', '2014-05-02 04:53:42', NULL, NULL, NULL, '2014-05-02 04:53:42', '2014-05-02 04:53:42', NULL, NULL, NULL, NULL, 264, 1, 1),
(142, 16, 90, NULL, 1, 7.90, 0, 'I', '2014-05-02 04:56:43', NULL, NULL, NULL, '2014-05-02 04:56:43', '2014-05-02 04:56:43', NULL, NULL, NULL, NULL, 265, 1, 1),
(143, 16, 91, NULL, 1, 7.90, 0, 'I', '2014-05-02 04:56:43', NULL, NULL, NULL, '2014-05-02 04:56:43', '2014-05-02 04:56:43', NULL, NULL, NULL, NULL, 265, 1, 1),
(144, 16, 92, NULL, 1, 7.90, 0, 'I', '2014-05-02 04:56:43', NULL, NULL, NULL, '2014-05-02 04:56:43', '2014-05-02 04:56:43', NULL, NULL, NULL, NULL, 265, 1, 1),
(145, 16, 93, NULL, 1, 7.90, 0, 'I', '2014-05-02 04:56:43', NULL, NULL, NULL, '2014-05-02 04:56:43', '2014-05-02 04:56:43', NULL, NULL, NULL, NULL, 265, 1, 1),
(146, 16, 94, NULL, 1, 3.90, 0, 'I', '2014-05-02 04:56:43', NULL, NULL, NULL, '2014-05-02 04:56:43', '2014-05-02 04:56:43', NULL, NULL, NULL, NULL, 265, 1, 1),
(147, 17, 90, NULL, 1, 7.90, 0, 'I', '2014-05-02 06:07:06', NULL, NULL, NULL, '2014-05-02 06:07:06', '2014-05-02 06:07:06', NULL, NULL, NULL, NULL, 266, 1, 1),
(148, 17, 91, NULL, 1, 7.90, 0, 'I', '2014-05-02 06:07:06', NULL, NULL, NULL, '2014-05-02 06:07:06', '2014-05-02 06:07:06', NULL, NULL, NULL, NULL, 266, 1, 1),
(149, 17, 92, NULL, 1, 7.90, 0, 'I', '2014-05-02 06:07:06', NULL, NULL, NULL, '2014-05-02 06:07:06', '2014-05-02 06:07:06', NULL, NULL, NULL, NULL, 266, 1, 1),
(150, 17, 93, NULL, 1, 7.90, 0, 'I', '2014-05-02 06:07:06', NULL, NULL, NULL, '2014-05-02 06:07:06', '2014-05-02 06:07:06', NULL, NULL, NULL, NULL, 266, 1, 1),
(151, 17, 94, NULL, 1, 3.90, 0, 'I', '2014-05-02 06:07:06', NULL, NULL, NULL, '2014-05-02 06:07:06', '2014-05-02 06:07:06', NULL, NULL, NULL, NULL, 266, 1, 1),
(152, 17, 90, NULL, 1, 7.90, 0, 'I', '2014-05-02 06:07:48', NULL, NULL, NULL, '2014-05-02 06:07:48', '2014-05-02 06:07:48', NULL, NULL, NULL, NULL, 267, 1, 1),
(153, 17, 91, NULL, 1, 7.90, 0, 'I', '2014-05-02 06:07:48', NULL, NULL, NULL, '2014-05-02 06:07:48', '2014-05-02 06:07:48', NULL, NULL, NULL, NULL, 267, 1, 1),
(154, 17, 92, NULL, 1, 7.90, 0, 'I', '2014-05-02 06:07:48', NULL, NULL, NULL, '2014-05-02 06:07:48', '2014-05-02 06:07:48', NULL, NULL, NULL, NULL, 267, 1, 1),
(155, 17, 93, NULL, 1, 7.90, 0, 'I', '2014-05-02 06:07:48', NULL, NULL, NULL, '2014-05-02 06:07:48', '2014-05-02 06:07:48', NULL, NULL, NULL, NULL, 267, 1, 1),
(156, 17, 94, NULL, 1, 3.90, 0, 'I', '2014-05-02 06:07:48', NULL, NULL, NULL, '2014-05-02 06:07:48', '2014-05-02 06:07:48', NULL, NULL, NULL, NULL, 267, 1, 1),
(157, 17, 90, NULL, 1, 7.90, 0, 'I', '2014-05-02 06:08:42', NULL, NULL, NULL, '2014-05-02 06:08:42', '2014-05-02 06:08:42', NULL, NULL, NULL, NULL, 268, 1, 1),
(158, 18, 46, NULL, 1, 4.90, 0, 'I', '2014-05-02 06:09:51', NULL, NULL, NULL, '2014-05-02 06:09:51', '2014-05-02 06:09:51', NULL, NULL, NULL, NULL, 269, 1, 1),
(159, 18, 47, NULL, 1, 3.50, 0, 'I', '2014-05-02 06:09:51', NULL, NULL, NULL, '2014-05-02 06:09:51', '2014-05-02 06:09:51', NULL, NULL, NULL, NULL, 269, 1, 1),
(160, 18, 48, NULL, 1, 12.90, 0, 'I', '2014-05-02 06:09:51', NULL, NULL, NULL, '2014-05-02 06:09:51', '2014-05-02 06:09:51', NULL, NULL, NULL, NULL, 269, 1, 1),
(161, 18, 49, NULL, 1, 12.90, 0, 'I', '2014-05-02 06:09:51', NULL, NULL, NULL, '2014-05-02 06:09:51', '2014-05-02 06:09:51', NULL, NULL, NULL, NULL, 269, 1, 1),
(162, 18, 50, NULL, 1, 12.90, 0, 'I', '2014-05-02 06:09:51', NULL, NULL, NULL, '2014-05-02 06:09:51', '2014-05-02 06:09:51', NULL, NULL, NULL, NULL, 269, 1, 1),
(163, 19, 90, NULL, 1, 7.90, 0, 'I', '2014-05-02 06:15:02', NULL, NULL, NULL, '2014-05-02 06:15:02', '2014-05-02 06:15:02', NULL, NULL, NULL, NULL, 270, 1, 1),
(164, 19, 91, NULL, 1, 7.90, 0, 'I', '2014-05-02 06:15:02', NULL, NULL, NULL, '2014-05-02 06:15:02', '2014-05-02 06:15:02', NULL, NULL, NULL, NULL, 270, 1, 1),
(165, 19, 92, NULL, 1, 7.90, 0, 'I', '2014-05-02 06:15:02', NULL, NULL, NULL, '2014-05-02 06:15:02', '2014-05-02 06:15:02', NULL, NULL, NULL, NULL, 270, 1, 1),
(166, 19, 93, NULL, 1, 7.90, 0, 'I', '2014-05-02 06:15:02', NULL, NULL, NULL, '2014-05-02 06:15:02', '2014-05-02 06:15:02', NULL, NULL, NULL, NULL, 270, 1, 1),
(167, 19, 94, NULL, 1, 3.90, 0, 'I', '2014-05-02 06:15:02', NULL, NULL, NULL, '2014-05-02 06:15:02', '2014-05-02 06:15:02', NULL, NULL, NULL, NULL, 270, 1, 1),
(168, 20, 90, NULL, 1, 7.90, 0, 'I', '2014-05-02 06:17:44', NULL, NULL, NULL, '2014-05-02 06:17:44', '2014-05-02 06:17:44', NULL, NULL, NULL, NULL, 271, 1, 1),
(169, 20, 91, NULL, 1, 7.90, 0, 'I', '2014-05-02 06:17:44', NULL, NULL, NULL, '2014-05-02 06:17:44', '2014-05-02 06:17:44', NULL, NULL, NULL, NULL, 271, 1, 1),
(170, 20, 92, NULL, 1, 7.90, 0, 'I', '2014-05-02 06:17:44', NULL, NULL, NULL, '2014-05-02 06:17:44', '2014-05-02 06:17:44', NULL, NULL, NULL, NULL, 271, 1, 1),
(171, 20, 93, NULL, 1, 7.90, 0, 'I', '2014-05-02 06:17:44', NULL, NULL, NULL, '2014-05-02 06:17:44', '2014-05-02 06:17:44', NULL, NULL, NULL, NULL, 271, 1, 1),
(172, 20, 94, NULL, 1, 3.90, 0, 'I', '2014-05-02 06:17:44', NULL, NULL, NULL, '2014-05-02 06:17:44', '2014-05-02 06:17:44', NULL, NULL, NULL, NULL, 271, 1, 1),
(173, 21, 90, NULL, 1, 7.90, 0, 'I', '2014-05-02 06:23:24', NULL, NULL, NULL, '2014-05-02 06:23:24', '2014-05-02 06:23:24', NULL, NULL, NULL, NULL, 272, 1, 1),
(174, 21, 91, NULL, 1, 7.90, 0, 'I', '2014-05-02 06:23:24', NULL, NULL, NULL, '2014-05-02 06:23:24', '2014-05-02 06:23:24', NULL, NULL, NULL, NULL, 272, 1, 1),
(175, 21, 92, NULL, 1, 7.90, 0, 'I', '2014-05-02 06:23:24', NULL, NULL, NULL, '2014-05-02 06:23:24', '2014-05-02 06:23:24', NULL, NULL, NULL, NULL, 272, 1, 1),
(176, 21, 93, NULL, 1, 7.90, 0, 'I', '2014-05-02 06:23:24', NULL, NULL, NULL, '2014-05-02 06:23:24', '2014-05-02 06:23:24', NULL, NULL, NULL, NULL, 272, 1, 1),
(177, 21, 94, NULL, 1, 3.90, 0, 'I', '2014-05-02 06:23:24', NULL, NULL, NULL, '2014-05-02 06:23:24', '2014-05-02 06:23:24', NULL, NULL, NULL, NULL, 272, 1, 1),
(178, 22, 90, NULL, 1, 7.90, 0, 'I', '2014-05-02 06:24:35', NULL, NULL, NULL, '2014-05-02 06:24:35', '2014-05-02 06:24:35', NULL, NULL, NULL, NULL, 273, 1, 1),
(179, 22, 91, NULL, 1, 7.90, 0, 'I', '2014-05-02 06:24:36', NULL, NULL, NULL, '2014-05-02 06:24:35', '2014-05-02 06:24:35', NULL, NULL, NULL, NULL, 273, 1, 1),
(180, 22, 92, NULL, 1, 7.90, 0, 'I', '2014-05-02 06:24:36', NULL, NULL, NULL, '2014-05-02 06:24:36', '2014-05-02 06:24:36', NULL, NULL, NULL, NULL, 273, 1, 1),
(181, 22, 93, NULL, 1, 7.90, 0, 'I', '2014-05-02 06:24:36', NULL, NULL, NULL, '2014-05-02 06:24:36', '2014-05-02 06:24:36', NULL, NULL, NULL, NULL, 273, 1, 1),
(182, 22, 94, NULL, 1, 3.90, 0, 'I', '2014-05-02 06:24:36', NULL, NULL, NULL, '2014-05-02 06:24:36', '2014-05-02 06:24:36', NULL, NULL, NULL, NULL, 273, 1, 1),
(183, 23, 90, NULL, 1, 7.90, 0, 'I', '2014-05-02 06:26:20', NULL, NULL, NULL, '2014-05-02 06:26:20', '2014-05-02 06:26:20', NULL, NULL, NULL, NULL, 274, 1, 1),
(184, 23, 91, NULL, 1, 7.90, 0, 'I', '2014-05-02 06:26:20', NULL, NULL, NULL, '2014-05-02 06:26:20', '2014-05-02 06:26:20', NULL, NULL, NULL, NULL, 274, 1, 1),
(185, 23, 92, NULL, 1, 7.90, 0, 'I', '2014-05-02 06:26:20', NULL, NULL, NULL, '2014-05-02 06:26:20', '2014-05-02 06:26:20', NULL, NULL, NULL, NULL, 274, 1, 1),
(186, 23, 93, NULL, 1, 7.90, 0, 'I', '2014-05-02 06:26:20', NULL, NULL, NULL, '2014-05-02 06:26:20', '2014-05-02 06:26:20', NULL, NULL, NULL, NULL, 274, 1, 1),
(187, 23, 94, NULL, 1, 3.90, 0, 'I', '2014-05-02 06:26:20', NULL, NULL, NULL, '2014-05-02 06:26:20', '2014-05-02 06:26:20', NULL, NULL, NULL, NULL, 274, 1, 1),
(188, 24, 90, NULL, 1, 7.90, 0, 'I', '2014-05-02 06:27:28', NULL, NULL, NULL, '2014-05-02 06:27:28', '2014-05-02 06:27:28', NULL, NULL, NULL, NULL, 275, 1, 1),
(189, 24, 91, NULL, 1, 7.90, 0, 'I', '2014-05-02 06:27:28', NULL, NULL, NULL, '2014-05-02 06:27:28', '2014-05-02 06:27:28', NULL, NULL, NULL, NULL, 275, 1, 1),
(190, 24, 92, NULL, 1, 7.90, 0, 'I', '2014-05-02 06:27:28', NULL, NULL, NULL, '2014-05-02 06:27:28', '2014-05-02 06:27:28', NULL, NULL, NULL, NULL, 275, 1, 1),
(191, 24, 93, NULL, 1, 7.90, 0, 'I', '2014-05-02 06:27:28', NULL, NULL, NULL, '2014-05-02 06:27:28', '2014-05-02 06:27:28', NULL, NULL, NULL, NULL, 275, 1, 1),
(192, 24, 94, NULL, 1, 3.90, 0, 'I', '2014-05-02 06:27:28', NULL, NULL, NULL, '2014-05-02 06:27:28', '2014-05-02 06:27:28', NULL, NULL, NULL, NULL, 275, 1, 1),
(193, 25, 90, NULL, 1, 7.90, 0, 'I', '2014-05-02 06:29:03', NULL, NULL, NULL, '2014-05-02 06:29:03', '2014-05-02 06:29:03', NULL, NULL, NULL, NULL, 276, 1, 1),
(194, 25, 91, NULL, 1, 7.90, 0, 'I', '2014-05-02 06:29:03', NULL, NULL, NULL, '2014-05-02 06:29:03', '2014-05-02 06:29:03', NULL, NULL, NULL, NULL, 276, 1, 1),
(195, 25, 92, NULL, 1, 7.90, 0, 'I', '2014-05-02 06:29:03', NULL, NULL, NULL, '2014-05-02 06:29:03', '2014-05-02 06:29:03', NULL, NULL, NULL, NULL, 276, 1, 1),
(196, 25, 93, NULL, 1, 7.90, 0, 'I', '2014-05-02 06:29:03', NULL, NULL, NULL, '2014-05-02 06:29:03', '2014-05-02 06:29:03', NULL, NULL, NULL, NULL, 276, 1, 1),
(197, 25, 94, NULL, 1, 3.90, 0, 'I', '2014-05-02 06:29:03', NULL, NULL, NULL, '2014-05-02 06:29:03', '2014-05-02 06:29:03', NULL, NULL, NULL, NULL, 276, 1, 1),
(198, 26, 90, NULL, 1, 7.90, 0, 'I', '2014-05-02 06:30:47', NULL, NULL, NULL, '2014-05-02 06:30:47', '2014-05-02 06:30:47', NULL, NULL, NULL, NULL, 277, 1, 1),
(199, 26, 91, NULL, 1, 7.90, 0, 'I', '2014-05-02 06:30:47', NULL, NULL, NULL, '2014-05-02 06:30:47', '2014-05-02 06:30:47', NULL, NULL, NULL, NULL, 277, 1, 1),
(200, 26, 92, NULL, 1, 7.90, 0, 'I', '2014-05-02 06:30:47', NULL, NULL, NULL, '2014-05-02 06:30:47', '2014-05-02 06:30:47', NULL, NULL, NULL, NULL, 277, 1, 1),
(201, 26, 93, NULL, 1, 7.90, 0, 'I', '2014-05-02 06:30:47', NULL, NULL, NULL, '2014-05-02 06:30:47', '2014-05-02 06:30:47', NULL, NULL, NULL, NULL, 277, 1, 1),
(202, 26, 94, NULL, 1, 3.90, 0, 'I', '2014-05-02 06:30:47', NULL, NULL, NULL, '2014-05-02 06:30:47', '2014-05-02 06:30:47', NULL, NULL, NULL, NULL, 277, 1, 1),
(203, 27, 90, NULL, 1, 7.90, 0, 'I', '2014-05-02 06:33:51', NULL, NULL, NULL, '2014-05-02 06:33:51', '2014-05-02 06:33:51', NULL, NULL, NULL, NULL, 278, 1, 0),
(204, 27, 91, NULL, 1, 7.90, 0, 'I', '2014-05-02 06:33:51', NULL, NULL, NULL, '2014-05-02 06:33:51', '2014-05-02 06:33:51', NULL, NULL, NULL, NULL, 278, 1, 0),
(205, 27, 92, NULL, 1, 7.90, 0, 'I', '2014-05-02 06:33:51', NULL, NULL, NULL, '2014-05-02 06:33:51', '2014-05-02 06:33:51', NULL, NULL, NULL, NULL, 278, 1, 0),
(206, 27, 93, NULL, 1, 7.90, 0, 'I', '2014-05-02 06:33:51', NULL, NULL, NULL, '2014-05-02 06:33:51', '2014-05-02 06:33:51', NULL, NULL, NULL, NULL, 278, 1, 0),
(207, 27, 94, NULL, 1, 3.90, 0, 'I', '2014-05-02 06:33:51', NULL, NULL, NULL, '2014-05-02 06:33:51', '2014-05-02 06:33:51', NULL, NULL, NULL, NULL, 278, 1, 0),
(208, 27, 90, NULL, 1, 7.90, 0, 'I', '2014-05-02 06:34:16', NULL, NULL, NULL, '2014-05-02 06:34:16', '2014-05-02 06:34:16', NULL, NULL, NULL, NULL, 280, 1, 0),
(209, 27, 91, NULL, 1, 7.90, 0, 'I', '2014-05-02 06:34:16', NULL, NULL, NULL, '2014-05-02 06:34:16', '2014-05-02 06:34:16', NULL, NULL, NULL, NULL, 280, 1, 0),
(210, 27, 92, NULL, 1, 7.90, 0, 'I', '2014-05-02 06:34:16', NULL, NULL, NULL, '2014-05-02 06:34:16', '2014-05-02 06:34:16', NULL, NULL, NULL, NULL, 280, 1, 0),
(211, 27, 93, NULL, 1, 7.90, 0, 'I', '2014-05-02 06:34:16', NULL, NULL, NULL, '2014-05-02 06:34:16', '2014-05-02 06:34:16', NULL, NULL, NULL, NULL, 280, 1, 0),
(212, 27, 94, NULL, 1, 3.90, 0, 'I', '2014-05-02 06:34:16', NULL, NULL, NULL, '2014-05-02 06:34:16', '2014-05-02 06:34:16', NULL, NULL, NULL, NULL, 280, 1, 0),
(213, 27, 90, NULL, 1, 7.90, 0, 'I', '2014-05-02 06:35:08', NULL, NULL, NULL, '2014-05-02 06:35:08', '2014-05-02 06:35:08', NULL, NULL, NULL, NULL, 281, 1, 0),
(214, 27, 91, NULL, 1, 7.90, 0, 'I', '2014-05-02 06:35:08', NULL, NULL, NULL, '2014-05-02 06:35:08', '2014-05-02 06:35:08', NULL, NULL, NULL, NULL, 281, 1, 0),
(215, 27, 92, NULL, 1, 7.90, 0, 'I', '2014-05-02 06:35:08', NULL, NULL, NULL, '2014-05-02 06:35:08', '2014-05-02 06:35:08', NULL, NULL, NULL, NULL, 281, 1, 0),
(216, 27, 93, NULL, 1, 7.90, 0, 'I', '2014-05-02 06:35:08', NULL, NULL, NULL, '2014-05-02 06:35:08', '2014-05-02 06:35:08', NULL, NULL, NULL, NULL, 281, 1, 0),
(217, 27, 94, NULL, 1, 3.90, 0, 'I', '2014-05-02 06:35:08', NULL, NULL, NULL, '2014-05-02 06:35:08', '2014-05-02 06:35:08', NULL, NULL, NULL, NULL, 281, 1, 0),
(218, 27, 107, NULL, 1, 10.90, 0, 'I', '2014-05-02 06:35:08', NULL, NULL, NULL, '2014-05-02 06:35:08', '2014-05-02 06:35:08', NULL, NULL, NULL, NULL, 228, 2, 0),
(219, 27, 108, NULL, 1, 10.90, 0, 'I', '2014-05-02 06:35:08', NULL, NULL, NULL, '2014-05-02 06:35:08', '2014-05-02 06:35:08', NULL, NULL, NULL, NULL, 228, 2, 0),
(220, 27, 109, NULL, 1, 8.90, 0, 'I', '2014-05-02 06:35:08', NULL, NULL, NULL, '2014-05-02 06:35:08', '2014-05-02 06:35:08', NULL, NULL, NULL, NULL, 228, 2, 0),
(221, 27, 110, NULL, 1, 12.90, 0, 'I', '2014-05-02 06:35:08', NULL, NULL, NULL, '2014-05-02 06:35:08', '2014-05-02 06:35:08', NULL, NULL, NULL, NULL, 228, 2, 0),
(222, 27, 111, NULL, 1, 4.90, 0, 'I', '2014-05-02 06:35:08', NULL, NULL, NULL, '2014-05-02 06:35:08', '2014-05-02 06:35:08', NULL, NULL, NULL, NULL, 228, 2, 0),
(223, 27, 90, NULL, 1, 7.90, 0, 'I', '2014-05-02 06:36:36', NULL, NULL, NULL, '2014-05-02 06:36:36', '2014-05-02 06:36:36', NULL, NULL, NULL, NULL, 282, 1, 0),
(224, 27, 91, NULL, 1, 7.90, 0, 'I', '2014-05-02 06:36:36', NULL, NULL, NULL, '2014-05-02 06:36:36', '2014-05-02 06:36:36', NULL, NULL, NULL, NULL, 282, 1, 0),
(225, 27, 92, NULL, 1, 7.90, 0, 'I', '2014-05-02 06:36:36', NULL, NULL, NULL, '2014-05-02 06:36:36', '2014-05-02 06:36:36', NULL, NULL, NULL, NULL, 282, 1, 0),
(226, 27, 93, NULL, 1, 7.90, 0, 'I', '2014-05-02 06:36:36', NULL, NULL, NULL, '2014-05-02 06:36:36', '2014-05-02 06:36:36', NULL, NULL, NULL, NULL, 282, 1, 0),
(227, 27, 94, NULL, 1, 3.90, 0, 'I', '2014-05-02 06:36:36', NULL, NULL, NULL, '2014-05-02 06:36:36', '2014-05-02 06:36:36', NULL, NULL, NULL, NULL, 282, 1, 0),
(228, 27, 107, NULL, 1, 10.90, 0, 'I', '2014-05-02 06:36:36', NULL, NULL, NULL, '2014-05-02 06:36:36', '2014-05-02 06:36:36', NULL, NULL, NULL, NULL, 229, 2, 0),
(229, 27, 108, NULL, 1, 10.90, 0, 'I', '2014-05-02 06:36:36', NULL, NULL, NULL, '2014-05-02 06:36:36', '2014-05-02 06:36:36', NULL, NULL, NULL, NULL, 229, 2, 0),
(230, 27, 109, NULL, 1, 8.90, 0, 'I', '2014-05-02 06:36:36', NULL, NULL, NULL, '2014-05-02 06:36:36', '2014-05-02 06:36:36', NULL, NULL, NULL, NULL, 229, 2, 0),
(231, 27, 110, NULL, 1, 12.90, 0, 'I', '2014-05-02 06:36:36', NULL, NULL, NULL, '2014-05-02 06:36:36', '2014-05-02 06:36:36', NULL, NULL, NULL, NULL, 229, 2, 0),
(232, 27, 111, NULL, 1, 4.90, 0, 'I', '2014-05-02 06:36:36', NULL, NULL, NULL, '2014-05-02 06:36:36', '2014-05-02 06:36:36', NULL, NULL, NULL, NULL, 229, 2, 0),
(233, 28, 46, NULL, 1, 4.90, 0, 'I', '2014-05-02 06:37:31', NULL, NULL, NULL, '2014-05-02 06:37:31', '2014-05-02 06:37:31', NULL, NULL, NULL, NULL, 283, 1, 0),
(234, 28, 47, NULL, 1, 3.50, 0, 'I', '2014-05-02 06:37:31', NULL, NULL, NULL, '2014-05-02 06:37:31', '2014-05-02 06:37:31', NULL, NULL, NULL, NULL, 283, 1, 0),
(235, 28, 48, NULL, 1, 12.90, 0, 'I', '2014-05-02 06:37:31', NULL, NULL, NULL, '2014-05-02 06:37:31', '2014-05-02 06:37:31', NULL, NULL, NULL, NULL, 283, 1, 0),
(236, 28, 50, NULL, 1, 12.90, 0, 'I', '2014-05-02 06:37:31', NULL, NULL, NULL, '2014-05-02 06:37:31', '2014-05-02 06:37:31', NULL, NULL, NULL, NULL, 283, 1, 0),
(237, 28, 49, NULL, 1, 12.90, 0, 'I', '2014-05-02 06:37:31', NULL, NULL, NULL, '2014-05-02 06:37:31', '2014-05-02 06:37:31', NULL, NULL, NULL, NULL, 283, 1, 0),
(238, 28, 51, NULL, 1, 6.90, 0, 'I', '2014-05-02 06:37:31', NULL, NULL, NULL, '2014-05-02 06:37:31', '2014-05-02 06:37:31', NULL, NULL, NULL, NULL, 283, 1, 0),
(239, 28, 52, NULL, 1, 15.90, 0, 'I', '2014-05-02 06:37:31', NULL, NULL, NULL, '2014-05-02 06:37:31', '2014-05-02 06:37:31', NULL, NULL, NULL, NULL, 283, 1, 0),
(240, 28, 53, NULL, 1, 2.50, 0, 'I', '2014-05-02 06:37:31', NULL, NULL, NULL, '2014-05-02 06:37:31', '2014-05-02 06:37:31', NULL, NULL, NULL, NULL, 283, 1, 0),
(241, 28, 54, NULL, 1, 18.90, 0, 'I', '2014-05-02 06:37:31', NULL, NULL, NULL, '2014-05-02 06:37:31', '2014-05-02 06:37:31', NULL, NULL, NULL, NULL, 283, 1, 0),
(242, 28, 1, NULL, 1, 2.90, 0, 'I', '2014-05-02 06:37:31', NULL, NULL, NULL, '2014-05-02 06:37:31', '2014-05-02 06:37:31', NULL, NULL, NULL, NULL, 230, 2, 0),
(243, 28, 1, NULL, 1, 2.90, 0, 'I', '2014-05-02 06:37:31', NULL, NULL, NULL, '2014-05-02 06:37:31', '2014-05-02 06:37:31', NULL, NULL, NULL, NULL, 230, 2, 0),
(244, 28, 2, NULL, 1, 5.90, 0, 'I', '2014-05-02 06:37:31', NULL, NULL, NULL, '2014-05-02 06:37:31', '2014-05-02 06:37:31', NULL, NULL, NULL, NULL, 230, 2, 0),
(245, 28, 3, NULL, 1, 3.50, 0, 'I', '2014-05-02 06:37:31', NULL, NULL, NULL, '2014-05-02 06:37:31', '2014-05-02 06:37:31', NULL, NULL, NULL, NULL, 230, 2, 0),
(246, 28, 4, NULL, 1, 3.50, 0, 'I', '2014-05-02 06:37:31', NULL, NULL, NULL, '2014-05-02 06:37:31', '2014-05-02 06:37:31', NULL, NULL, NULL, NULL, 230, 2, 0),
(247, 28, 5, NULL, 1, 2.50, 0, 'I', '2014-05-02 06:37:31', NULL, NULL, NULL, '2014-05-02 06:37:31', '2014-05-02 06:37:31', NULL, NULL, NULL, NULL, 230, 2, 0),
(248, 28, 6, NULL, 1, 2.50, 0, 'I', '2014-05-02 06:37:31', NULL, NULL, NULL, '2014-05-02 06:37:31', '2014-05-02 06:37:31', NULL, NULL, NULL, NULL, 230, 2, 0),
(249, 28, 8, NULL, 1, 4.90, 0, 'I', '2014-05-02 06:37:31', NULL, NULL, NULL, '2014-05-02 06:37:31', '2014-05-02 06:37:31', NULL, NULL, NULL, NULL, 230, 2, 0),
(250, 28, 7, NULL, 1, 12.90, 0, 'I', '2014-05-02 06:37:31', NULL, NULL, NULL, '2014-05-02 06:37:31', '2014-05-02 06:37:31', NULL, NULL, NULL, NULL, 230, 2, 0),
(251, 28, 90, NULL, 1, 7.90, 0, 'I', '2014-05-02 06:38:27', NULL, NULL, NULL, '2014-05-02 06:38:27', '2014-05-02 06:38:27', NULL, NULL, NULL, NULL, 284, 1, 0),
(252, 28, 91, NULL, 1, 7.90, 0, 'I', '2014-05-02 06:38:27', NULL, NULL, NULL, '2014-05-02 06:38:27', '2014-05-02 06:38:27', NULL, NULL, NULL, NULL, 284, 1, 0),
(253, 28, 92, NULL, 1, 7.90, 0, 'I', '2014-05-02 06:38:27', NULL, NULL, NULL, '2014-05-02 06:38:27', '2014-05-02 06:38:27', NULL, NULL, NULL, NULL, 284, 1, 0),
(254, 28, 93, NULL, 1, 7.90, 0, 'I', '2014-05-02 06:38:27', NULL, NULL, NULL, '2014-05-02 06:38:27', '2014-05-02 06:38:27', NULL, NULL, NULL, NULL, 284, 1, 0),
(255, 28, 94, NULL, 1, 3.90, 0, 'I', '2014-05-02 06:38:27', NULL, NULL, NULL, '2014-05-02 06:38:27', '2014-05-02 06:38:27', NULL, NULL, NULL, NULL, 284, 1, 0),
(256, 28, 107, NULL, 1, 10.90, 0, 'I', '2014-05-02 06:38:27', NULL, NULL, NULL, '2014-05-02 06:38:27', '2014-05-02 06:38:27', NULL, NULL, NULL, NULL, 231, 2, 0),
(257, 28, 108, NULL, 1, 10.90, 0, 'I', '2014-05-02 06:38:27', NULL, NULL, NULL, '2014-05-02 06:38:27', '2014-05-02 06:38:27', NULL, NULL, NULL, NULL, 231, 2, 0),
(258, 28, 109, NULL, 1, 8.90, 0, 'I', '2014-05-02 06:38:27', NULL, NULL, NULL, '2014-05-02 06:38:27', '2014-05-02 06:38:27', NULL, NULL, NULL, NULL, 231, 2, 0),
(259, 28, 110, NULL, 1, 12.90, 0, 'I', '2014-05-02 06:38:27', NULL, NULL, NULL, '2014-05-02 06:38:27', '2014-05-02 06:38:27', NULL, NULL, NULL, NULL, 231, 2, 0),
(260, 28, 111, NULL, 1, 4.90, 0, 'I', '2014-05-02 06:38:27', NULL, NULL, NULL, '2014-05-02 06:38:27', '2014-05-02 06:38:27', NULL, NULL, NULL, NULL, 231, 2, 0),
(261, 17, 15, NULL, 1, 6.90, 0, 'I', '2014-05-02 06:39:54', NULL, NULL, NULL, '2014-05-02 06:39:54', '2014-05-02 06:39:54', NULL, NULL, NULL, NULL, 232, 2, 0),
(262, 17, 16, NULL, 1, 7.00, 0, 'I', '2014-05-02 06:39:54', NULL, NULL, NULL, '2014-05-02 06:39:54', '2014-05-02 06:39:54', NULL, NULL, NULL, NULL, 232, 2, 0),
(263, 17, 14, NULL, 1, 5.90, 0, 'I', '2014-05-02 06:39:54', NULL, NULL, NULL, '2014-05-02 06:39:54', '2014-05-02 06:39:54', NULL, NULL, NULL, NULL, 232, 2, 0),
(264, 28, 5, NULL, 1, 2.50, 0, 'I', '2014-05-02 06:42:28', NULL, NULL, NULL, '2014-05-02 06:42:28', '2014-05-02 06:42:28', NULL, NULL, NULL, NULL, 233, 2, 0),
(265, 28, 4, NULL, 1, 3.50, 0, 'I', '2014-05-02 06:42:28', NULL, NULL, NULL, '2014-05-02 06:42:28', '2014-05-02 06:42:28', NULL, NULL, NULL, NULL, 233, 2, 0),
(266, 28, 3, NULL, 1, 3.50, 0, 'I', '2014-05-02 06:42:28', NULL, NULL, NULL, '2014-05-02 06:42:28', '2014-05-02 06:42:28', NULL, NULL, NULL, NULL, 233, 2, 0),
(267, 28, 2, NULL, 1, 5.90, 0, 'I', '2014-05-02 06:42:28', NULL, NULL, NULL, '2014-05-02 06:42:28', '2014-05-02 06:42:28', NULL, NULL, NULL, NULL, 233, 2, 0),
(268, 28, 1, NULL, 1, 2.90, 0, 'I', '2014-05-02 06:42:28', NULL, NULL, NULL, '2014-05-02 06:42:28', '2014-05-02 06:42:28', NULL, NULL, NULL, NULL, 233, 2, 0),
(269, 28, 13, NULL, 1, 14.90, 0, 'I', '2014-05-02 06:42:28', NULL, NULL, NULL, '2014-05-02 06:42:28', '2014-05-02 06:42:28', NULL, NULL, NULL, NULL, 233, 2, 0),
(270, 29, 95, NULL, 1, 5.90, 0, 'I', '2014-05-02 06:48:02', NULL, NULL, NULL, '2014-05-02 06:48:02', '2014-05-02 06:48:02', NULL, NULL, NULL, NULL, 234, 2, 0),
(271, 29, 96, NULL, 1, 5.90, 0, 'I', '2014-05-02 06:48:02', NULL, NULL, NULL, '2014-05-02 06:48:02', '2014-05-02 06:48:02', NULL, NULL, NULL, NULL, 234, 2, 0),
(272, 29, 97, NULL, 1, 5.90, 0, 'I', '2014-05-02 06:48:02', NULL, NULL, NULL, '2014-05-02 06:48:02', '2014-05-02 06:48:02', NULL, NULL, NULL, NULL, 234, 2, 0),
(273, 29, 98, NULL, 1, 5.90, 0, 'I', '2014-05-02 06:48:02', NULL, NULL, NULL, '2014-05-02 06:48:02', '2014-05-02 06:48:02', NULL, NULL, NULL, NULL, 234, 2, 0),
(274, 29, 99, NULL, 1, 5.90, 0, 'I', '2014-05-02 06:48:02', NULL, NULL, NULL, '2014-05-02 06:48:02', '2014-05-02 06:48:02', NULL, NULL, NULL, NULL, 234, 2, 0),
(275, 29, 100, NULL, 1, 5.90, 0, 'I', '2014-05-02 06:48:02', NULL, NULL, NULL, '2014-05-02 06:48:02', '2014-05-02 06:48:02', NULL, NULL, NULL, NULL, 234, 2, 0),
(276, 29, 101, NULL, 1, 5.90, 0, 'I', '2014-05-02 06:48:02', NULL, NULL, NULL, '2014-05-02 06:48:02', '2014-05-02 06:48:02', NULL, NULL, NULL, NULL, 234, 2, 0),
(277, 29, 99, NULL, 1, 5.90, 0, 'I', '2014-05-02 06:48:13', NULL, NULL, NULL, '2014-05-02 06:48:13', '2014-05-02 06:48:13', NULL, NULL, NULL, NULL, 235, 2, 0),
(278, 29, 100, NULL, 1, 5.90, 0, 'I', '2014-05-02 06:48:13', NULL, NULL, NULL, '2014-05-02 06:48:13', '2014-05-02 06:48:13', NULL, NULL, NULL, NULL, 235, 2, 0),
(279, 29, 101, NULL, 1, 5.90, 0, 'I', '2014-05-02 06:48:13', NULL, NULL, NULL, '2014-05-02 06:48:13', '2014-05-02 06:48:13', NULL, NULL, NULL, NULL, 235, 2, 0),
(280, 29, 102, NULL, 1, 8.90, 0, 'I', '2014-05-02 06:48:13', NULL, NULL, NULL, '2014-05-02 06:48:13', '2014-05-02 06:48:13', NULL, NULL, NULL, NULL, 235, 2, 0),
(281, 29, 103, NULL, 1, 15.90, 0, 'I', '2014-05-02 06:48:13', NULL, NULL, NULL, '2014-05-02 06:48:13', '2014-05-02 06:48:13', NULL, NULL, NULL, NULL, 235, 2, 0),
(282, 29, 104, NULL, 1, 8.90, 0, 'I', '2014-05-02 06:48:13', NULL, NULL, NULL, '2014-05-02 06:48:13', '2014-05-02 06:48:13', NULL, NULL, NULL, NULL, 235, 2, 0),
(283, 29, 105, NULL, 1, 5.90, 0, 'I', '2014-05-02 06:48:13', NULL, NULL, NULL, '2014-05-02 06:48:13', '2014-05-02 06:48:13', NULL, NULL, NULL, NULL, 235, 2, 0),
(284, 30, 87, NULL, 1, 10.90, 0, 'I', '2014-05-02 06:54:12', NULL, NULL, NULL, '2014-05-02 06:54:12', '2014-05-02 06:54:12', NULL, NULL, NULL, NULL, 236, 2, 1),
(285, 30, 88, NULL, 1, 10.90, 0, 'I', '2014-05-02 06:54:12', NULL, NULL, NULL, '2014-05-02 06:54:12', '2014-05-02 06:54:12', NULL, NULL, NULL, NULL, 236, 2, 1),
(286, 30, 89, NULL, 1, 10.90, 0, 'I', '2014-05-02 06:54:12', NULL, NULL, NULL, '2014-05-02 06:54:12', '2014-05-02 06:54:12', NULL, NULL, NULL, NULL, 236, 2, 1),
(287, 31, 89, NULL, 1, 10.90, 0, 'I', '2014-05-02 06:54:40', NULL, NULL, NULL, '2014-05-02 06:54:40', '2014-05-02 06:54:40', NULL, NULL, NULL, NULL, 237, 2, 0),
(288, 32, 90, NULL, 1, 7.90, 0, 'I', '2014-05-02 17:30:20', NULL, NULL, NULL, '2014-05-02 17:30:20', '2014-05-02 17:30:20', NULL, NULL, NULL, NULL, 287, 1, 1),
(289, 32, 91, NULL, 1, 7.90, 0, 'I', '2014-05-02 17:30:20', NULL, NULL, NULL, '2014-05-02 17:30:20', '2014-05-02 17:30:20', NULL, NULL, NULL, NULL, 287, 1, 1),
(290, 32, 92, NULL, 1, 7.90, 0, 'I', '2014-05-02 17:30:20', NULL, NULL, NULL, '2014-05-02 17:30:20', '2014-05-02 17:30:20', NULL, NULL, NULL, NULL, 287, 1, 1),
(291, 32, 93, NULL, 1, 7.90, 0, 'I', '2014-05-02 17:30:20', NULL, NULL, NULL, '2014-05-02 17:30:20', '2014-05-02 17:30:20', NULL, NULL, NULL, NULL, 287, 1, 1),
(292, 32, 94, NULL, 1, 3.90, 0, 'I', '2014-05-02 17:30:20', NULL, NULL, NULL, '2014-05-02 17:30:20', '2014-05-02 17:30:20', NULL, NULL, NULL, NULL, 287, 1, 1),
(293, 33, 90, NULL, 1, 7.90, 0, 'I', '2014-05-02 17:55:40', NULL, NULL, NULL, '2014-05-02 17:55:40', '2014-05-02 17:55:40', NULL, NULL, NULL, NULL, 288, 1, 1),
(294, 33, 91, NULL, 1, 7.90, 0, 'I', '2014-05-02 17:55:40', NULL, NULL, NULL, '2014-05-02 17:55:40', '2014-05-02 17:55:40', NULL, NULL, NULL, NULL, 288, 1, 1),
(295, 33, 92, NULL, 1, 7.90, 0, 'I', '2014-05-02 17:55:40', NULL, NULL, NULL, '2014-05-02 17:55:40', '2014-05-02 17:55:40', NULL, NULL, NULL, NULL, 288, 1, 1),
(296, 33, 93, NULL, 1, 7.90, 0, 'I', '2014-05-02 17:55:40', NULL, NULL, NULL, '2014-05-02 17:55:40', '2014-05-02 17:55:40', NULL, NULL, NULL, NULL, 288, 1, 1),
(297, 33, 94, NULL, 1, 3.90, 0, 'I', '2014-05-02 17:55:40', NULL, NULL, NULL, '2014-05-02 17:55:40', '2014-05-02 17:55:40', NULL, NULL, NULL, NULL, 288, 1, 1),
(298, 34, 90, NULL, 1, 7.90, 0, 'I', '2014-05-02 18:00:50', NULL, NULL, NULL, '2014-05-02 18:00:50', '2014-05-02 18:00:50', NULL, NULL, NULL, NULL, 289, 1, 1),
(299, 34, 91, NULL, 1, 7.90, 0, 'I', '2014-05-02 18:00:50', NULL, NULL, NULL, '2014-05-02 18:00:50', '2014-05-02 18:00:50', NULL, NULL, NULL, NULL, 289, 1, 1),
(300, 34, 92, NULL, 1, 7.90, 0, 'I', '2014-05-02 18:00:50', NULL, NULL, NULL, '2014-05-02 18:00:50', '2014-05-02 18:00:50', NULL, NULL, NULL, NULL, 289, 1, 1),
(301, 34, 93, NULL, 1, 7.90, 0, 'I', '2014-05-02 18:00:50', NULL, NULL, NULL, '2014-05-02 18:00:50', '2014-05-02 18:00:50', NULL, NULL, NULL, NULL, 289, 1, 1),
(302, 34, 94, NULL, 1, 3.90, 0, 'I', '2014-05-02 18:00:50', NULL, NULL, NULL, '2014-05-02 18:00:50', '2014-05-02 18:00:50', NULL, NULL, NULL, NULL, 289, 1, 1),
(303, 35, 90, NULL, 1, 7.90, 0, 'I', '2014-05-02 18:02:23', NULL, NULL, NULL, '2014-05-02 18:02:23', '2014-05-02 18:02:23', NULL, NULL, NULL, NULL, 290, 1, 1),
(304, 35, 91, NULL, 1, 7.90, 0, 'I', '2014-05-02 18:02:23', NULL, NULL, NULL, '2014-05-02 18:02:23', '2014-05-02 18:02:23', NULL, NULL, NULL, NULL, 290, 1, 1),
(305, 35, 92, NULL, 1, 7.90, 0, 'I', '2014-05-02 18:02:23', NULL, NULL, NULL, '2014-05-02 18:02:23', '2014-05-02 18:02:23', NULL, NULL, NULL, NULL, 290, 1, 1),
(306, 35, 93, NULL, 1, 7.90, 0, 'I', '2014-05-02 18:02:23', NULL, NULL, NULL, '2014-05-02 18:02:23', '2014-05-02 18:02:23', NULL, NULL, NULL, NULL, 290, 1, 1),
(307, 35, 94, NULL, 1, 3.90, 0, 'I', '2014-05-02 18:02:23', NULL, NULL, NULL, '2014-05-02 18:02:23', '2014-05-02 18:02:23', NULL, NULL, NULL, NULL, 290, 1, 1),
(308, 36, 90, NULL, 1, 7.90, 0, 'I', '2014-05-02 18:02:46', NULL, NULL, NULL, '2014-05-02 18:02:46', '2014-05-02 18:02:46', NULL, NULL, NULL, NULL, 291, 1, 1),
(309, 36, 91, NULL, 1, 7.90, 0, 'I', '2014-05-02 18:02:46', NULL, NULL, NULL, '2014-05-02 18:02:46', '2014-05-02 18:02:46', NULL, NULL, NULL, NULL, 291, 1, 1),
(310, 36, 92, NULL, 1, 7.90, 0, 'I', '2014-05-02 18:02:46', NULL, NULL, NULL, '2014-05-02 18:02:46', '2014-05-02 18:02:46', NULL, NULL, NULL, NULL, 291, 1, 1),
(311, 36, 93, NULL, 1, 7.90, 0, 'I', '2014-05-02 18:02:46', NULL, NULL, NULL, '2014-05-02 18:02:46', '2014-05-02 18:02:46', NULL, NULL, NULL, NULL, 291, 1, 1),
(312, 36, 94, NULL, 1, 3.90, 0, 'I', '2014-05-02 18:02:46', NULL, NULL, NULL, '2014-05-02 18:02:46', '2014-05-02 18:02:46', NULL, NULL, NULL, NULL, 291, 1, 1),
(313, 37, 90, NULL, 1, 7.90, 0, 'I', '2014-05-02 18:03:39', NULL, NULL, NULL, '2014-05-02 18:03:39', '2014-05-02 18:03:39', NULL, NULL, NULL, NULL, 292, 1, 0);
INSERT INTO `detallepedido` (`id`, `pedido_id`, `producto_id`, `precioUnidadFinal`, `cantidad`, `importeFinal`, `descuento`, `estado`, `fechaInicio`, `fechaProceso`, `fechaDespacho`, `fechaDespachado`, `created_at`, `updated_at`, `detalle_id`, `combinacion_id`, `combinacion_c`, `combinacion_cant`, `ordenCocina`, `idarea`, `estado_t`) VALUES
(314, 37, 91, NULL, 1, 7.90, 0, 'I', '2014-05-02 18:03:39', NULL, NULL, NULL, '2014-05-02 18:03:39', '2014-05-02 18:03:39', NULL, NULL, NULL, NULL, 292, 1, 0),
(315, 37, 92, NULL, 1, 7.90, 0, 'I', '2014-05-02 18:03:39', NULL, NULL, NULL, '2014-05-02 18:03:39', '2014-05-02 18:03:39', NULL, NULL, NULL, NULL, 292, 1, 0),
(316, 37, 93, NULL, 1, 7.90, 0, 'I', '2014-05-02 18:03:39', NULL, NULL, NULL, '2014-05-02 18:03:39', '2014-05-02 18:03:39', NULL, NULL, NULL, NULL, 292, 1, 0),
(317, 37, 94, NULL, 1, 3.90, 0, 'I', '2014-05-02 18:03:39', NULL, NULL, NULL, '2014-05-02 18:03:39', '2014-05-02 18:03:39', NULL, NULL, NULL, NULL, 292, 1, 0),
(318, 38, 90, NULL, 1, 7.90, 0, 'I', '2014-05-02 18:03:53', NULL, NULL, NULL, '2014-05-02 18:03:53', '2014-05-02 18:03:53', NULL, NULL, NULL, NULL, 293, 1, 0),
(319, 38, 91, NULL, 1, 7.90, 0, 'I', '2014-05-02 18:03:53', NULL, NULL, NULL, '2014-05-02 18:03:53', '2014-05-02 18:03:53', NULL, NULL, NULL, NULL, 293, 1, 0),
(320, 38, 92, NULL, 1, 7.90, 0, 'I', '2014-05-02 18:03:53', NULL, NULL, NULL, '2014-05-02 18:03:53', '2014-05-02 18:03:53', NULL, NULL, NULL, NULL, 293, 1, 0),
(321, 38, 93, NULL, 1, 7.90, 0, 'I', '2014-05-02 18:03:53', NULL, NULL, NULL, '2014-05-02 18:03:53', '2014-05-02 18:03:53', NULL, NULL, NULL, NULL, 293, 1, 0),
(322, 38, 94, NULL, 1, 3.90, 0, 'I', '2014-05-02 18:03:53', NULL, NULL, NULL, '2014-05-02 18:03:53', '2014-05-02 18:03:53', NULL, NULL, NULL, NULL, 293, 1, 0),
(323, 39, 90, NULL, 1, 7.90, 0, 'I', '2014-05-02 18:05:28', NULL, NULL, NULL, '2014-05-02 18:05:28', '2014-05-02 18:05:28', NULL, NULL, NULL, NULL, 294, 1, 0),
(324, 39, 91, NULL, 1, 7.90, 0, 'I', '2014-05-02 18:05:28', NULL, NULL, NULL, '2014-05-02 18:05:28', '2014-05-02 18:05:28', NULL, NULL, NULL, NULL, 294, 1, 0),
(325, 39, 92, NULL, 1, 7.90, 0, 'I', '2014-05-02 18:05:28', NULL, NULL, NULL, '2014-05-02 18:05:28', '2014-05-02 18:05:28', NULL, NULL, NULL, NULL, 294, 1, 0),
(326, 39, 93, NULL, 1, 7.90, 0, 'I', '2014-05-02 18:05:28', NULL, NULL, NULL, '2014-05-02 18:05:28', '2014-05-02 18:05:28', NULL, NULL, NULL, NULL, 294, 1, 0),
(327, 39, 94, NULL, 1, 3.90, 0, 'I', '2014-05-02 18:05:28', NULL, NULL, NULL, '2014-05-02 18:05:28', '2014-05-02 18:05:28', NULL, NULL, NULL, NULL, 294, 1, 0),
(328, 40, 90, NULL, 1, 7.90, 0, 'I', '2014-05-02 19:02:20', NULL, NULL, NULL, '2014-05-02 19:02:20', '2014-05-02 19:02:20', NULL, NULL, NULL, NULL, 295, 1, 1),
(329, 40, 91, NULL, 1, 7.90, 0, 'I', '2014-05-02 19:02:20', NULL, NULL, NULL, '2014-05-02 19:02:20', '2014-05-02 19:02:20', NULL, NULL, NULL, NULL, 295, 1, 1),
(330, 40, 92, NULL, 1, 7.90, 0, 'I', '2014-05-02 19:02:20', NULL, NULL, NULL, '2014-05-02 19:02:20', '2014-05-02 19:02:20', NULL, NULL, NULL, NULL, 295, 1, 1),
(331, 40, 93, NULL, 1, 7.90, 0, 'I', '2014-05-02 19:02:20', NULL, NULL, NULL, '2014-05-02 19:02:20', '2014-05-02 19:02:20', NULL, NULL, NULL, NULL, 295, 1, 1),
(332, 40, 94, NULL, 1, 3.90, 0, 'I', '2014-05-02 19:02:20', NULL, NULL, NULL, '2014-05-02 19:02:20', '2014-05-02 19:02:20', NULL, NULL, NULL, NULL, 295, 1, 1),
(333, 41, 1, NULL, 1, 2.90, 0, 'I', '2014-05-03 00:45:32', NULL, NULL, NULL, '2014-05-03 00:45:32', '2014-05-03 00:45:32', NULL, NULL, NULL, NULL, 238, 2, 1),
(334, 41, 2, NULL, 1, 5.90, 0, 'I', '2014-05-03 00:45:32', NULL, NULL, NULL, '2014-05-03 00:45:32', '2014-05-03 00:45:32', NULL, NULL, NULL, NULL, 238, 2, 1),
(335, 41, 3, NULL, 1, 3.50, 0, 'I', '2014-05-03 00:45:32', NULL, NULL, NULL, '2014-05-03 00:45:32', '2014-05-03 00:45:32', NULL, NULL, NULL, NULL, 238, 2, 1),
(336, 41, 123, NULL, 1, 10.90, 0, 'I', '2014-05-03 00:45:32', NULL, NULL, NULL, '2014-05-03 00:45:32', '2014-05-03 00:45:32', NULL, NULL, NULL, NULL, 296, 1, 1),
(337, 41, 130, NULL, 1, 1.00, 0, 'I', '2014-05-03 00:45:32', NULL, NULL, NULL, '2014-05-03 00:45:32', '2014-05-03 00:45:32', 336, NULL, NULL, NULL, 296, 1, 1),
(338, 41, 131, NULL, 1, 1.00, 0, 'I', '2014-05-03 00:45:32', NULL, NULL, NULL, '2014-05-03 00:45:32', '2014-05-03 00:45:32', 336, NULL, NULL, NULL, 296, 1, 1),
(339, 33, 112, NULL, 1, 3.90, 0, 'I', '2014-05-03 00:55:47', NULL, NULL, NULL, '2014-05-03 00:55:47', '2014-05-03 00:55:47', NULL, NULL, NULL, NULL, 239, 2, 1),
(340, 33, 113, NULL, 1, 4.90, 0, 'I', '2014-05-03 00:55:48', NULL, NULL, NULL, '2014-05-03 00:55:48', '2014-05-03 00:55:48', NULL, NULL, NULL, NULL, 239, 2, 1),
(341, 33, 114, NULL, 1, 6.90, 0, 'I', '2014-05-03 00:55:48', NULL, NULL, NULL, '2014-05-03 00:55:48', '2014-05-03 00:55:48', NULL, NULL, NULL, NULL, 239, 2, 1),
(342, 33, 115, NULL, 1, 5.90, 0, 'I', '2014-05-03 00:55:48', NULL, NULL, NULL, '2014-05-03 00:55:48', '2014-05-03 00:55:48', NULL, NULL, NULL, NULL, 239, 2, 1),
(343, 41, 200, NULL, 1, 2.00, 0, 'I', '2014-05-03 00:59:48', NULL, NULL, NULL, '2014-05-03 00:59:48', '2014-05-03 00:59:48', NULL, 3, 1, 1, 298, 1, 0),
(344, 41, 200, NULL, 1, 2.00, 0, 'I', '2014-05-03 00:59:48', NULL, NULL, NULL, '2014-05-03 00:59:48', '2014-05-03 00:59:48', NULL, 3, 1, 1, 298, 1, 0),
(345, 41, 196, NULL, 1, 4.90, 0, 'I', '2014-05-03 00:59:48', NULL, NULL, NULL, '2014-05-03 00:59:48', '2014-05-03 00:59:48', NULL, 3, 1, 1, 298, 1, 0),
(346, 41, 200, NULL, 3, 2.00, 0, 'I', '2014-05-03 00:59:48', NULL, NULL, NULL, '2014-05-03 00:59:48', '2014-05-03 00:59:48', NULL, 3, 2, 3, 298, 1, 0),
(347, 41, 200, NULL, 3, 2.00, 0, 'I', '2014-05-03 00:59:48', NULL, NULL, NULL, '2014-05-03 00:59:48', '2014-05-03 00:59:48', NULL, 3, 2, 3, 298, 1, 0),
(348, 41, 196, NULL, 3, 4.90, 0, 'I', '2014-05-03 00:59:48', NULL, NULL, NULL, '2014-05-03 00:59:48', '2014-05-03 00:59:48', NULL, 3, 2, 3, 298, 1, 0),
(349, 42, 1, NULL, 1, 2.90, 0, 'I', '2014-05-03 18:42:44', NULL, NULL, NULL, '2014-05-03 18:42:44', '2014-05-03 18:42:44', NULL, NULL, NULL, NULL, 241, 2, 1),
(350, 42, 2, NULL, 2, 11.80, 0, 'I', '2014-05-03 18:42:44', NULL, NULL, NULL, '2014-05-03 18:42:44', '2014-05-03 18:42:44', NULL, NULL, NULL, NULL, 241, 2, 1),
(351, 42, 123, NULL, 1, 10.90, 0, 'I', '2014-05-03 18:42:44', NULL, NULL, NULL, '2014-05-03 18:42:44', '2014-05-03 18:42:44', NULL, NULL, NULL, NULL, 299, 1, 1),
(352, 42, 130, NULL, 2, 2.00, 0, 'I', '2014-05-03 18:42:44', NULL, NULL, NULL, '2014-05-03 18:42:44', '2014-05-03 18:42:44', 351, NULL, NULL, NULL, 299, 1, 1),
(353, 42, 131, NULL, 1, 1.00, 0, 'I', '2014-05-03 18:42:44', NULL, NULL, NULL, '2014-05-03 18:42:44', '2014-05-03 18:42:44', 351, NULL, NULL, NULL, 299, 1, 1),
(354, 42, 1, NULL, 1, 1.40, 0, 'I', '2014-05-03 18:45:18', NULL, NULL, NULL, '2014-05-03 18:45:18', '2014-05-03 18:45:18', NULL, 2, 1, 1, 242, 2, 0),
(355, 42, 198, NULL, 1, 1.60, 0, 'I', '2014-05-03 18:45:18', NULL, NULL, NULL, '2014-05-03 18:45:18', '2014-05-03 18:45:18', NULL, 2, 1, 1, 242, 2, 0),
(356, 42, 199, NULL, 1, 2.00, 0, 'I', '2014-05-03 18:45:18', NULL, NULL, NULL, '2014-05-03 18:45:18', '2014-05-03 18:45:18', NULL, 2, 1, 1, 300, 1, 0),
(357, 42, 196, NULL, 1, 4.90, 0, 'I', '2014-05-03 18:45:18', NULL, NULL, NULL, '2014-05-03 18:45:18', '2014-05-03 18:45:18', NULL, 2, 1, 1, 300, 1, 0),
(358, 42, 1, NULL, 1, 1.40, 0, 'I', '2014-05-03 18:45:18', NULL, NULL, NULL, '2014-05-03 18:45:18', '2014-05-03 18:45:18', NULL, 2, 2, 1, 242, 2, 0),
(359, 42, 198, NULL, 1, 1.60, 0, 'I', '2014-05-03 18:45:18', NULL, NULL, NULL, '2014-05-03 18:45:18', '2014-05-03 18:45:18', NULL, 2, 2, 1, 242, 2, 0),
(360, 42, 199, NULL, 1, 2.00, 0, 'I', '2014-05-03 18:45:18', NULL, NULL, NULL, '2014-05-03 18:45:18', '2014-05-03 18:45:18', NULL, 2, 2, 1, 300, 1, 0),
(361, 42, 196, NULL, 1, 4.90, 0, 'I', '2014-05-03 18:45:18', NULL, NULL, NULL, '2014-05-03 18:45:18', '2014-05-03 18:45:18', NULL, 2, 2, 1, 300, 1, 0),
(362, 33, 107, NULL, 1, 10.90, 0, 'I', '2014-05-04 17:35:35', NULL, NULL, NULL, '2014-05-04 17:35:35', '2014-05-04 17:35:35', NULL, NULL, NULL, NULL, 243, 2, 1),
(363, 33, 108, NULL, 1, 10.90, 0, 'I', '2014-05-04 17:35:36', NULL, NULL, NULL, '2014-05-04 17:35:36', '2014-05-04 17:35:36', NULL, NULL, NULL, NULL, 243, 2, 1),
(364, 33, 109, NULL, 1, 8.90, 0, 'I', '2014-05-04 17:35:36', NULL, NULL, NULL, '2014-05-04 17:35:36', '2014-05-04 17:35:36', NULL, NULL, NULL, NULL, 243, 2, 1),
(365, 33, 110, NULL, 1, 12.90, 0, 'I', '2014-05-04 17:35:36', NULL, NULL, NULL, '2014-05-04 17:35:36', '2014-05-04 17:35:36', NULL, NULL, NULL, NULL, 243, 2, 1),
(366, 33, 111, NULL, 1, 4.90, 0, 'I', '2014-05-04 17:35:36', NULL, NULL, NULL, '2014-05-04 17:35:36', '2014-05-04 17:35:36', NULL, NULL, NULL, NULL, 243, 2, 1),
(367, 33, 112, NULL, 1, 3.90, 0, 'I', '2014-05-05 04:49:09', NULL, NULL, NULL, '2014-05-05 04:49:09', '2014-05-05 04:49:09', NULL, NULL, NULL, NULL, 244, 2, 1),
(368, 33, 113, NULL, 1, 4.90, 0, 'I', '2014-05-05 04:49:09', NULL, NULL, NULL, '2014-05-05 04:49:09', '2014-05-05 04:49:09', NULL, NULL, NULL, NULL, 244, 2, 1),
(369, 33, 114, NULL, 1, 6.90, 0, 'I', '2014-05-05 04:49:09', NULL, NULL, NULL, '2014-05-05 04:49:09', '2014-05-05 04:49:09', NULL, NULL, NULL, NULL, 244, 2, 1),
(370, 33, 115, NULL, 1, 5.90, 0, 'I', '2014-05-05 04:49:09', NULL, NULL, NULL, '2014-05-05 04:49:09', '2014-05-05 04:49:09', NULL, NULL, NULL, NULL, 244, 2, 1),
(371, 33, 116, NULL, 1, 3.90, 0, 'I', '2014-05-05 04:49:09', NULL, NULL, NULL, '2014-05-05 04:49:09', '2014-05-05 04:49:09', NULL, NULL, NULL, NULL, 244, 2, 1),
(372, 33, 117, NULL, 1, 5.90, 0, 'I', '2014-05-05 04:49:09', NULL, NULL, NULL, '2014-05-05 04:49:09', '2014-05-05 04:49:09', NULL, NULL, NULL, NULL, 244, 2, 1),
(373, 33, 118, NULL, 1, 3.50, 0, 'I', '2014-05-05 04:49:09', NULL, NULL, NULL, '2014-05-05 04:49:09', '2014-05-05 04:49:09', NULL, NULL, NULL, NULL, 244, 2, 1),
(374, 33, 119, NULL, 1, 3.50, 0, 'I', '2014-05-05 04:49:09', NULL, NULL, NULL, '2014-05-05 04:49:09', '2014-05-05 04:49:09', NULL, NULL, NULL, NULL, 244, 2, 1),
(375, 33, 120, NULL, 1, 5.90, 0, 'I', '2014-05-05 04:49:09', NULL, NULL, NULL, '2014-05-05 04:49:09', '2014-05-05 04:49:09', NULL, NULL, NULL, NULL, 244, 2, 1),
(376, 33, 121, NULL, 1, 3.50, 0, 'I', '2014-05-05 04:49:09', NULL, NULL, NULL, '2014-05-05 04:49:09', '2014-05-05 04:49:09', NULL, NULL, NULL, NULL, 244, 2, 1),
(377, 33, 122, NULL, 1, 4.90, 0, 'I', '2014-05-05 04:49:09', NULL, NULL, NULL, '2014-05-05 04:49:09', '2014-05-05 04:49:09', NULL, NULL, NULL, NULL, 244, 2, 1),
(378, 35, 123, NULL, 1, 10.90, 0, 'I', '2014-05-05 05:09:10', NULL, NULL, NULL, '2014-05-05 05:09:10', '2014-05-05 05:09:10', NULL, NULL, NULL, NULL, 303, 1, 1),
(379, 35, 130, NULL, 1, 1.00, 0, 'I', '2014-05-05 05:09:10', NULL, NULL, NULL, '2014-05-05 05:09:10', '2014-05-05 05:09:10', 378, NULL, NULL, NULL, 303, 1, 1),
(380, 35, 131, NULL, 1, 1.00, 0, 'I', '2014-05-05 05:09:10', NULL, NULL, NULL, '2014-05-05 05:09:10', '2014-05-05 05:09:10', 378, NULL, NULL, NULL, 303, 1, 1),
(381, 43, 90, NULL, 1, 7.90, 0, 'I', '2014-05-05 08:21:05', NULL, NULL, NULL, '2014-05-05 08:21:05', '2014-05-05 08:21:05', NULL, NULL, NULL, NULL, 304, 1, 1),
(382, 43, 91, NULL, 1, 7.90, 0, 'I', '2014-05-05 08:21:05', NULL, NULL, NULL, '2014-05-05 08:21:05', '2014-05-05 08:21:05', NULL, NULL, NULL, NULL, 304, 1, 1),
(383, 43, 93, NULL, 1, 7.90, 0, 'I', '2014-05-05 08:21:05', NULL, NULL, NULL, '2014-05-05 08:21:05', '2014-05-05 08:21:05', NULL, NULL, NULL, NULL, 304, 1, 1),
(384, 43, 94, NULL, 1, 3.90, 0, 'I', '2014-05-05 08:21:05', NULL, NULL, NULL, '2014-05-05 08:21:05', '2014-05-05 08:21:05', NULL, NULL, NULL, NULL, 304, 1, 1),
(385, 43, 107, NULL, 1, 10.90, 0, 'I', '2014-05-05 08:21:05', NULL, NULL, NULL, '2014-05-05 08:21:05', '2014-05-05 08:21:05', NULL, NULL, NULL, NULL, 245, 2, 1),
(386, 43, 108, NULL, 1, 10.90, 0, 'I', '2014-05-05 08:21:05', NULL, NULL, NULL, '2014-05-05 08:21:05', '2014-05-05 08:21:05', NULL, NULL, NULL, NULL, 245, 2, 1),
(387, 43, 109, NULL, 1, 8.90, 0, 'I', '2014-05-05 08:21:05', NULL, NULL, NULL, '2014-05-05 08:21:05', '2014-05-05 08:21:05', NULL, NULL, NULL, NULL, 245, 2, 1),
(388, 43, 110, NULL, 1, 12.90, 0, 'I', '2014-05-05 08:21:05', NULL, NULL, NULL, '2014-05-05 08:21:05', '2014-05-05 08:21:05', NULL, NULL, NULL, NULL, 245, 2, 1),
(389, 43, 111, NULL, 1, 4.90, 0, 'I', '2014-05-05 08:21:05', NULL, NULL, NULL, '2014-05-05 08:21:05', '2014-05-05 08:21:05', NULL, NULL, NULL, NULL, 245, 2, 1),
(390, 43, 87, NULL, 1, 10.90, 0, 'I', '2014-05-05 08:21:05', NULL, NULL, NULL, '2014-05-05 08:21:05', '2014-05-05 08:21:05', NULL, NULL, NULL, NULL, 245, 2, 1),
(391, 43, 88, NULL, 1, 10.90, 0, 'I', '2014-05-05 08:21:05', NULL, NULL, NULL, '2014-05-05 08:21:05', '2014-05-05 08:21:05', NULL, NULL, NULL, NULL, 245, 2, 1),
(392, 43, 89, NULL, 1, 10.90, 0, 'I', '2014-05-05 08:21:05', NULL, NULL, NULL, '2014-05-05 08:21:05', '2014-05-05 08:21:05', NULL, NULL, NULL, NULL, 245, 2, 1),
(393, 43, 95, NULL, 1, 5.90, 0, 'I', '2014-05-05 08:21:05', NULL, NULL, NULL, '2014-05-05 08:21:05', '2014-05-05 08:21:05', NULL, NULL, NULL, NULL, 245, 2, 1),
(394, 43, 96, NULL, 1, 5.90, 0, 'I', '2014-05-05 08:21:05', NULL, NULL, NULL, '2014-05-05 08:21:05', '2014-05-05 08:21:05', NULL, NULL, NULL, NULL, 245, 2, 1),
(395, 43, 97, NULL, 1, 5.90, 0, 'I', '2014-05-05 08:21:06', NULL, NULL, NULL, '2014-05-05 08:21:06', '2014-05-05 08:21:06', NULL, NULL, NULL, NULL, 245, 2, 1),
(396, 43, 98, NULL, 1, 5.90, 0, 'I', '2014-05-05 08:21:06', NULL, NULL, NULL, '2014-05-05 08:21:06', '2014-05-05 08:21:06', NULL, NULL, NULL, NULL, 245, 2, 1),
(397, 43, 99, NULL, 1, 5.90, 0, 'I', '2014-05-05 08:21:06', NULL, NULL, NULL, '2014-05-05 08:21:06', '2014-05-05 08:21:06', NULL, NULL, NULL, NULL, 245, 2, 1),
(398, 43, 104, NULL, 1, 8.90, 0, 'I', '2014-05-05 08:21:06', NULL, NULL, NULL, '2014-05-05 08:21:06', '2014-05-05 08:21:06', NULL, NULL, NULL, NULL, 245, 2, 1),
(399, 43, 103, NULL, 1, 15.90, 0, 'I', '2014-05-05 08:21:06', NULL, NULL, NULL, '2014-05-05 08:21:06', '2014-05-05 08:21:06', NULL, NULL, NULL, NULL, 245, 2, 1),
(400, 43, 102, NULL, 1, 8.90, 0, 'I', '2014-05-05 08:21:06', NULL, NULL, NULL, '2014-05-05 08:21:06', '2014-05-05 08:21:06', NULL, NULL, NULL, NULL, 245, 2, 1),
(401, 43, 101, NULL, 1, 5.90, 0, 'I', '2014-05-05 08:21:06', NULL, NULL, NULL, '2014-05-05 08:21:06', '2014-05-05 08:21:06', NULL, NULL, NULL, NULL, 245, 2, 1),
(402, 43, 100, NULL, 1, 5.90, 0, 'I', '2014-05-05 08:21:06', NULL, NULL, NULL, '2014-05-05 08:21:06', '2014-05-05 08:21:06', NULL, NULL, NULL, NULL, 245, 2, 1),
(403, 43, 186, NULL, 1, 10.90, 0, 'I', '2014-05-05 08:21:06', NULL, NULL, NULL, '2014-05-05 08:21:06', '2014-05-05 08:21:06', NULL, NULL, NULL, NULL, 304, 1, 1),
(404, 43, 187, NULL, 1, 11.90, 0, 'I', '2014-05-05 08:21:06', NULL, NULL, NULL, '2014-05-05 08:21:06', '2014-05-05 08:21:06', NULL, NULL, NULL, NULL, 304, 1, 1),
(405, 43, 188, NULL, 1, 12.90, 0, 'I', '2014-05-05 08:21:06', NULL, NULL, NULL, '2014-05-05 08:21:06', '2014-05-05 08:21:06', NULL, NULL, NULL, NULL, 304, 1, 1),
(406, 43, 189, NULL, 1, 12.90, 0, 'I', '2014-05-05 08:21:06', NULL, NULL, NULL, '2014-05-05 08:21:06', '2014-05-05 08:21:06', NULL, NULL, NULL, NULL, 304, 1, 1),
(407, 43, 190, NULL, 1, 1.50, 0, 'I', '2014-05-05 08:21:06', NULL, NULL, NULL, '2014-05-05 08:21:06', '2014-05-05 08:21:06', NULL, NULL, NULL, NULL, 304, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Detformadepago`
--

CREATE TABLE IF NOT EXISTS `Detformadepago` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `formadepago_id` int(10) unsigned DEFAULT NULL,
  `ticket_id` int(10) unsigned DEFAULT NULL,
  `importe` decimal(5,2) NOT NULL,
  `codigotarjeta` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `codigovale` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `detformadepago_formadepago_id_foreign` (`formadepago_id`),
  KEY `detformadepago_ticket_id_foreign` (`ticket_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=37 ;

--
-- Volcado de datos para la tabla `Detformadepago`
--

INSERT INTO `Detformadepago` (`id`, `formadepago_id`, `ticket_id`, `importe`, `codigotarjeta`, `codigovale`, `created_at`, `updated_at`) VALUES
(1, 1, 4, 28.00, '', '', '2014-04-28 04:54:28', '2014-04-28 04:54:28'),
(2, 1, 5, 15.00, '', '', '2014-04-28 14:39:41', '2014-04-28 14:39:41'),
(3, 1, 6, 10.00, '', '', '2014-04-28 14:41:35', '2014-04-28 14:41:35'),
(4, 2, 7, 13.00, '1234', '', '2014-04-28 15:38:08', '2014-04-28 15:38:08'),
(5, 1, 8, 26.00, '', '', '2014-04-28 17:16:00', '2014-04-28 17:16:00'),
(6, 1, 9, 10.00, '', '', '2014-04-28 17:22:33', '2014-04-28 17:22:33'),
(7, 1, 10, 120.00, '', '', '2014-04-30 05:11:49', '2014-04-30 05:11:49'),
(8, 1, 11, 2.00, '', '', '2014-04-30 05:12:03', '2014-04-30 05:12:03'),
(9, 1, 12, 90.00, '', '', '2014-05-02 04:00:57', '2014-05-02 04:00:57'),
(10, 1, 13, 126.00, '', '', '2014-05-02 04:02:38', '2014-05-02 04:02:38'),
(11, 1, 14, 48.00, '', '', '2014-05-02 04:04:12', '2014-05-02 04:04:12'),
(12, 1, 15, 48.00, '', '', '2014-05-02 04:07:24', '2014-05-02 04:07:24'),
(13, 1, 16, 48.00, '', '', '2014-05-02 04:10:01', '2014-05-02 04:10:01'),
(14, 1, 17, 40.00, '', '', '2014-05-02 04:14:19', '2014-05-02 04:14:19'),
(15, 1, 18, 40.00, '', '', '2014-05-02 04:15:46', '2014-05-02 04:15:46'),
(16, 1, 19, 40.00, '', '', '2014-05-02 04:30:32', '2014-05-02 04:30:32'),
(17, 1, 20, 40.00, '', '', '2014-05-02 04:31:14', '2014-05-02 04:31:14'),
(18, 1, 21, 40.00, '', '', '2014-05-02 04:52:41', '2014-05-02 04:52:41'),
(19, 1, 22, 40.00, '', '', '2014-05-02 04:53:30', '2014-05-02 04:53:30'),
(20, 1, 23, 20.00, '', '', '2014-05-02 04:56:18', '2014-05-02 04:56:18'),
(21, 1, 24, 40.00, '', '', '2014-05-02 04:56:57', '2014-05-02 04:56:57'),
(22, 1, 25, 40.00, '', '', '2014-05-02 06:07:20', '2014-05-02 06:07:20'),
(23, 1, 26, 50.00, '', '', '2014-05-02 06:10:07', '2014-05-02 06:10:07'),
(24, 1, 27, 40.00, '', '', '2014-05-02 06:15:33', '2014-05-02 06:15:33'),
(25, 1, 28, 40.00, '', '', '2014-05-02 06:24:49', '2014-05-02 06:24:49'),
(26, 1, 29, 50.00, '', '', '2014-05-02 06:26:39', '2014-05-02 06:26:39'),
(27, 1, 30, 50.00, '', '', '2014-05-02 06:27:49', '2014-05-02 06:27:49'),
(28, 1, 31, 50.00, '', '', '2014-05-02 06:29:21', '2014-05-02 06:29:21'),
(29, 1, 32, 40.00, '', '', '2014-05-02 06:31:03', '2014-05-02 06:31:03'),
(30, 1, 33, 50.00, '', '', '2014-05-02 07:58:08', '2014-05-02 07:58:08'),
(31, 1, 34, 40.00, '', '', '2014-05-02 17:30:54', '2014-05-02 17:30:54'),
(32, 1, 35, 7.00, '', '', '2014-05-03 00:48:20', '2014-05-03 00:48:20'),
(33, 1, 36, 20.00, '', '', '2014-05-03 00:49:35', '2014-05-03 00:49:35'),
(34, 1, 37, 14.00, '', '', '2014-05-03 18:43:41', '2014-05-03 18:43:41'),
(35, 1, 38, 200.00, '', '', '2014-05-05 08:18:57', '2014-05-05 08:18:57'),
(36, 1, 39, 250.00, '', '', '2014-05-05 08:23:57', '2014-05-05 08:23:57');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detinfnutr`
--

CREATE TABLE IF NOT EXISTS `detinfnutr` (
  `infNut_id` int(11) NOT NULL,
  `producto_id` int(11) NOT NULL,
  `cantidad` decimal(10,4) DEFAULT NULL,
  `UnidadMedida` varchar(45) DEFAULT NULL COMMENT 'litros kilos unidades',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`infNut_id`,`producto_id`),
  KEY `fk_detInfNutr_Producto1_idx` (`producto_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detmesa`
--

CREATE TABLE IF NOT EXISTS `detmesa` (
  `pedido_id` int(11) DEFAULT NULL,
  `mesa_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `estado` int(255) NOT NULL DEFAULT '0',
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`),
  KEY `fk_detMesa_Mesa1_idx` (`mesa_id`) USING BTREE,
  KEY `fk_detMesa_Pedido1` (`pedido_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=44 ;

--
-- Volcado de datos para la tabla `detmesa`
--

INSERT INTO `detmesa` (`pedido_id`, `mesa_id`, `created_at`, `updated_at`, `estado`, `id`) VALUES
(1, 2, '2014-04-26 23:48:03', '2014-04-30 05:12:06', 1, 1),
(2, 1, '2014-04-28 15:37:17', '2014-04-30 05:11:52', 1, 2),
(3, 3, '2014-04-28 17:15:48', '2014-04-30 05:12:25', 1, 3),
(4, 4, '2014-04-29 23:13:16', '2014-05-02 04:01:04', 1, 4),
(5, 1, '2014-04-30 05:32:47', '2014-05-02 04:03:28', 1, 5),
(6, 1, '2014-05-02 04:03:51', '2014-05-02 04:04:40', 1, 6),
(7, 1, '2014-05-02 04:06:32', '2014-05-02 07:57:27', 1, 7),
(8, 2, '2014-05-02 04:08:42', '2014-05-02 07:57:31', 1, 8),
(9, 3, '2014-05-02 04:14:01', '2014-05-02 07:57:34', 1, 9),
(10, 4, '2014-05-02 04:15:34', '2014-05-02 07:57:37', 1, 10),
(11, 5, '2014-05-02 04:19:49', '2014-05-02 07:58:15', 1, 11),
(12, 6, '2014-05-02 04:30:16', '2014-05-02 07:58:22', 1, 12),
(13, 7, '2014-05-02 04:31:00', '2014-05-02 07:58:30', 1, 13),
(14, 8, '2014-05-02 04:51:48', '2014-05-02 07:58:35', 1, 14),
(15, 9, '2014-05-02 04:53:06', '2014-05-02 07:58:39', 1, 15),
(16, 10, '2014-05-02 04:56:43', '2014-05-02 07:58:43', 1, 16),
(17, 11, '2014-05-02 06:07:06', '2014-05-02 06:07:06', 0, 17),
(18, 12, '2014-05-02 06:09:51', '2014-05-02 06:09:51', 0, 18),
(19, 13, '2014-05-02 06:15:02', '2014-05-02 06:15:02', 0, 19),
(20, 14, '2014-05-02 06:17:44', '2014-05-02 06:17:44', 0, 20),
(21, 15, '2014-05-02 06:23:24', '2014-05-02 06:23:24', 0, 21),
(22, 16, '2014-05-02 06:24:35', '2014-05-02 06:24:35', 0, 22),
(23, 17, '2014-05-02 06:26:20', '2014-05-02 06:26:20', 0, 23),
(24, 18, '2014-05-02 06:27:28', '2014-05-02 06:27:28', 0, 24),
(25, 19, '2014-05-02 06:29:03', '2014-05-02 06:29:03', 0, 25),
(26, 20, '2014-05-02 06:30:47', '2014-05-02 06:30:47', 0, 26),
(27, 24, '2014-05-02 06:33:51', '2014-05-02 06:33:51', 0, 27),
(28, 25, '2014-05-02 06:37:31', '2014-05-02 06:37:31', 0, 28),
(29, 21, '2014-05-02 06:48:02', '2014-05-02 06:48:02', 0, 29),
(30, 22, '2014-05-02 06:54:12', '2014-05-02 06:54:12', 0, 30),
(31, 23, '2014-05-02 06:54:40', '2014-05-02 06:54:40', 0, 31),
(32, 26, '2014-05-02 17:30:20', '2014-05-02 17:30:20', 0, 32),
(33, 1, '2014-05-02 17:55:40', '2014-05-05 08:20:19', 1, 33),
(34, 2, '2014-05-02 18:00:50', '2014-05-02 18:00:50', 0, 34),
(35, 3, '2014-05-02 18:02:23', '2014-05-02 18:02:23', 0, 35),
(36, 4, '2014-05-02 18:02:46', '2014-05-02 18:02:46', 0, 36),
(37, 7, '2014-05-02 18:03:39', '2014-05-02 18:03:39', 0, 37),
(38, 8, '2014-05-02 18:03:53', '2014-05-02 18:03:53', 0, 38),
(39, 9, '2014-05-02 18:05:28', '2014-05-02 18:05:28', 0, 39),
(40, 5, '2014-05-02 19:02:20', '2014-05-02 19:02:20', 0, 40),
(41, 6, '2014-05-03 00:45:32', '2014-05-03 00:45:32', 0, 41),
(42, 10, '2014-05-03 18:42:44', '2014-05-03 18:42:44', 0, 42),
(43, 1, '2014-05-05 08:21:05', '2014-05-05 08:21:05', 0, 43);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detpedidosabores`
--

CREATE TABLE IF NOT EXISTS `detpedidosabores` (
  `detpedido_id` int(11) NOT NULL,
  `sabor_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  KEY `detpedidosabores_detpedido_id_foreign` (`detpedido_id`),
  KEY `detpedidosabores_sabor_id_foreign` (`sabor_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `detpedidosabores`
--

INSERT INTO `detpedidosabores` (`detpedido_id`, `sabor_id`, `created_at`, `updated_at`) VALUES
(68, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(69, 3, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(69, 2, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(77, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(78, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(78, 2, '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detprecio`
--

CREATE TABLE IF NOT EXISTS `detprecio` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `restaurante_id` int(11) NOT NULL,
  `precio_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `detprecio_restaurante_id_foreign` (`restaurante_id`),
  KEY `detprecio_precio_id_foreign` (`precio_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detproadicional`
--

CREATE TABLE IF NOT EXISTS `detproadicional` (
  `producto_id` int(11) NOT NULL,
  `proadi_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  KEY `detproadicional_producto_id_foreign` (`producto_id`),
  KEY `detproadicional_proadi_id_foreign` (`proadi_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `detproadicional`
--

INSERT INTO `detproadicional` (`producto_id`, `proadi_id`, `created_at`, `updated_at`) VALUES
(123, 130, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(123, 131, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(123, 132, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(124, 130, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(124, 131, '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detsabores`
--

CREATE TABLE IF NOT EXISTS `detsabores` (
  `producto_id` int(11) NOT NULL,
  `sabor_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  KEY `detsabores_producto_id_foreign` (`producto_id`),
  KEY `detsabores_sabor_id_foreign` (`sabor_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `detsabores`
--

INSERT INTO `detsabores` (`producto_id`, `sabor_id`, `created_at`, `updated_at`) VALUES
(62, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(62, 2, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(62, 3, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(62, 4, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(63, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(63, 2, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(63, 3, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(64, 4, '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dettiketpedido`
--

CREATE TABLE IF NOT EXISTS `dettiketpedido` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `pedido_id` int(11) NOT NULL,
  `ticket_id` int(10) unsigned DEFAULT NULL,
  `nombre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `precio` decimal(5,2) NOT NULL,
  `preciou` decimal(5,2) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `combinacion_id` int(11) DEFAULT NULL,
  `descuento` decimal(5,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `dettiketpedido_combinacion_id_foreign` (`combinacion_id`),
  KEY `dettiketpedido_ticket_id_foreign` (`ticket_id`),
  KEY `dettiketpedido_pedido_id_foreign` (`pedido_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=254 ;

--
-- Volcado de datos para la tabla `dettiketpedido`
--

INSERT INTO `dettiketpedido` (`id`, `pedido_id`, `ticket_id`, `nombre`, `precio`, `preciou`, `cantidad`, `combinacion_id`, `descuento`, `created_at`, `updated_at`) VALUES
(1, 1, 4, 'Menu', 19.80, 9.90, 2, 2, 0.00, '2014-04-27 04:18:33', '2014-04-28 04:54:28'),
(2, 1, 4, 'Emp. Aji De Gallina', 7.90, 7.90, 1, NULL, 0.00, '2014-04-27 04:19:23', '2014-04-28 04:54:28'),
(3, 1, 5, 'Cafe Pasado', 3.90, 3.90, 1, NULL, 0.00, '2014-04-28 14:37:26', '2014-04-28 14:39:41'),
(4, 1, 5, 'Macedonia', 10.90, 10.90, 1, NULL, 0.00, '2014-04-28 14:39:13', '2014-04-28 14:39:41'),
(5, 1, 6, 'Chicha Morada', 2.90, 2.90, 1, NULL, 0.00, '2014-04-28 14:40:12', '2014-04-28 14:41:35'),
(6, 1, 6, 'Limonada Frozen', 5.90, 5.90, 1, NULL, 0.00, '2014-04-28 14:40:12', '2014-04-28 14:41:35'),
(7, 2, 7, 'Chicha Morada', 2.90, 2.90, 1, NULL, 0.00, '2014-04-28 15:37:20', '2014-04-28 15:38:08'),
(8, 2, 7, 'Limonada Frozen', 5.90, 5.90, 1, NULL, 0.00, '2014-04-28 15:37:20', '2014-04-28 15:38:08'),
(9, 2, 7, 'Coca Cola', 3.50, 3.50, 1, NULL, 0.00, '2014-04-28 15:37:20', '2014-04-28 15:38:08'),
(10, 3, 8, 'Frappe Maniako', 10.90, 10.90, 1, NULL, 0.00, '2014-04-28 17:15:56', '2014-04-28 17:16:00'),
(11, 3, 8, 'Chocomix Frutal', 10.90, 10.90, 1, NULL, 0.00, '2014-04-28 17:15:56', '2014-04-28 17:16:00'),
(12, 3, 8, 'Cafe Pasado', 3.90, 3.90, 1, NULL, 0.00, '2014-04-28 17:15:56', '2014-04-28 17:16:00'),
(13, 3, 9, 'Coca Cola', 3.50, 3.50, 1, NULL, 0.00, '2014-04-28 17:22:25', '2014-04-28 17:22:33'),
(14, 3, 9, 'Inca Kola', 3.50, 3.50, 1, NULL, 0.00, '2014-04-28 17:22:25', '2014-04-28 17:22:33'),
(15, 3, 9, 'Agua S/Gas', 2.50, 2.50, 1, NULL, 0.00, '2014-04-28 17:22:25', '2014-04-28 17:22:33'),
(16, 2, 10, 'Nativo', 5.90, 5.90, 1, NULL, 0.00, '2014-04-28 18:25:43', '2014-04-30 05:11:49'),
(17, 2, 10, 'Tropical', 5.90, 5.90, 1, NULL, 0.00, '2014-04-28 18:25:43', '2014-04-30 05:11:49'),
(18, 2, 10, 'Pasion Frutal', 5.90, 5.90, 1, NULL, 0.00, '2014-04-28 18:25:43', '2014-04-30 05:11:49'),
(19, 2, 10, 'Citrus', 5.90, 5.90, 1, NULL, 0.00, '2014-04-28 18:25:43', '2014-04-30 05:11:49'),
(20, 2, 10, 'Mambo', 5.90, 5.90, 1, NULL, 0.00, '2014-04-28 18:25:43', '2014-04-30 05:11:49'),
(21, 2, 10, 'Andino', 5.90, 5.90, 1, NULL, 0.00, '2014-04-28 18:25:43', '2014-04-30 05:11:49'),
(22, 2, 10, 'Boliyucas', 12.90, 12.90, 1, NULL, 0.00, '2014-04-29 23:46:14', '2014-04-30 05:11:49'),
(23, 2, 10, 'Tequeños Lomito', 12.90, 12.90, 1, NULL, 0.00, '2014-04-29 23:46:14', '2014-04-30 05:11:49'),
(24, 2, 10, 'Cafe Pasado', 3.90, 3.90, 1, NULL, 0.00, '2014-04-29 23:46:14', '2014-04-30 05:11:49'),
(25, 2, 10, 'Cortado', 4.90, 4.90, 1, NULL, 0.00, '2014-04-29 23:46:14', '2014-04-30 05:11:49'),
(26, 2, 10, 'Chocolate Kango', 6.90, 6.90, 1, NULL, 0.00, '2014-04-29 23:46:14', '2014-04-30 05:11:49'),
(27, 2, 10, 'Huevo Frito', 1.00, 1.00, 1, NULL, 0.00, '2014-04-29 23:46:14', '2014-04-30 05:11:49'),
(28, 2, 10, 'Menu', 19.80, 9.90, 2, 2, 0.00, '2014-04-29 23:46:14', '2014-04-30 05:11:49'),
(29, 2, 10, 'Desayuno Continental', 17.80, 8.90, 2, 3, 0.00, '2014-04-29 23:46:14', '2014-04-30 05:11:49'),
(30, 1, 11, 'Pan', 1.00, 1.00, 1, NULL, 0.00, '2014-04-30 05:11:57', '2014-04-30 05:12:03'),
(31, 4, 12, 'Chicha Morada', 2.90, 2.90, 1, NULL, 0.00, '2014-04-30 05:13:09', '2014-05-02 04:00:57'),
(32, 4, 12, 'Emp. Aji De Gallina', 7.90, 7.90, 1, NULL, 0.00, '2014-04-30 05:13:09', '2014-05-02 04:00:57'),
(33, 4, 12, 'Emp. Pollo Bechamel', 7.90, 7.90, 1, NULL, 0.00, '2014-04-30 05:13:09', '2014-05-02 04:00:57'),
(34, 4, 12, 'Emp. Pizzera', 7.90, 7.90, 1, NULL, 0.00, '2014-04-30 05:13:09', '2014-05-02 04:00:57'),
(35, 4, 12, 'Emp. Lomo Saltado', 7.90, 7.90, 1, NULL, 0.00, '2014-04-30 05:13:09', '2014-05-02 04:00:57'),
(36, 4, 12, 'Empanada De Manzana', 3.90, 3.90, 1, NULL, 0.00, '2014-04-30 05:13:09', '2014-05-02 04:00:57'),
(37, 4, 12, 'Menu', 19.80, 9.90, 2, 2, 0.00, '2014-04-30 05:13:09', '2014-05-02 04:00:57'),
(38, 4, 12, 'Desayuno Continental', 17.80, 8.90, 2, 3, 0.00, '2014-04-30 05:13:09', '2014-05-02 04:00:57'),
(39, 5, 13, 'Humita', 3.50, 3.50, 1, NULL, 0.00, '2014-05-01 22:17:49', '2014-05-02 04:02:38'),
(40, 5, 13, 'Boliyucas', 12.90, 12.90, 1, NULL, 0.00, '2014-05-01 22:17:49', '2014-05-02 04:02:38'),
(41, 5, 13, 'Helado Simple', 9.80, 4.90, 2, NULL, 0.00, '2014-05-01 22:17:49', '2014-05-02 04:02:38'),
(42, 5, 13, 'Helado Doble', 13.80, 6.90, 2, NULL, 0.00, '2014-05-01 22:17:49', '2014-05-02 04:02:38'),
(43, 5, 13, 'Emp. Aji De Gallina', 7.90, 7.90, 1, NULL, 0.00, '2014-05-01 22:17:49', '2014-05-02 04:02:38'),
(44, 5, 13, 'Emp. Pollo Bechamel', 7.90, 7.90, 1, NULL, 0.00, '2014-05-01 22:17:49', '2014-05-02 04:02:38'),
(45, 5, 13, 'Sdw. Chanchito Oriental', 21.80, 10.90, 2, NULL, 0.00, '2014-05-01 22:17:50', '2014-05-02 04:02:38'),
(46, 5, 13, 'Huevo Frito', 3.00, 1.00, 3, NULL, 0.00, '2014-05-01 22:17:50', '2014-05-02 04:02:38'),
(47, 5, 13, 'Queso', 2.00, 1.00, 2, NULL, 0.00, '2014-05-01 22:17:50', '2014-05-02 04:02:38'),
(48, 5, 13, 'Bgr. Clasica', 10.90, 10.90, 1, NULL, 0.00, '2014-05-01 22:17:50', '2014-05-02 04:02:38'),
(49, 5, 13, 'Bgr. Bacon', 11.90, 11.90, 1, NULL, 0.00, '2014-05-01 22:17:50', '2014-05-02 04:02:38'),
(50, 5, 13, 'Menu', 19.80, 9.90, 2, 2, 0.00, '2014-05-01 22:17:50', '2014-05-02 04:02:38'),
(51, 4, 12, 'Tequeños Lomito', 12.90, 12.90, 1, NULL, 0.00, '2014-05-02 04:00:30', '2014-05-02 04:00:57'),
(52, 6, 14, 'Pan Al Ajo Especial', 4.90, 4.90, 1, NULL, 0.00, '2014-05-02 04:03:54', '2014-05-02 04:04:12'),
(53, 6, 14, 'Humita', 3.50, 3.50, 1, NULL, 0.00, '2014-05-02 04:03:54', '2014-05-02 04:04:12'),
(54, 6, 14, 'Boliyucas', 12.90, 12.90, 1, NULL, 0.00, '2014-05-02 04:03:54', '2014-05-02 04:04:12'),
(55, 6, 14, 'Tequeños Lomito', 12.90, 12.90, 1, NULL, 0.00, '2014-05-02 04:03:54', '2014-05-02 04:04:12'),
(56, 6, 14, 'Salchipapas Especial', 12.90, 12.90, 1, NULL, 0.00, '2014-05-02 04:03:55', '2014-05-02 04:04:12'),
(57, 7, 15, 'Pan Al Ajo Especial', 4.90, 4.90, 1, NULL, 0.00, '2014-05-02 04:06:37', '2014-05-02 04:07:24'),
(58, 7, 15, 'Humita', 3.50, 3.50, 1, NULL, 0.00, '2014-05-02 04:06:37', '2014-05-02 04:07:24'),
(59, 7, 15, 'Boliyucas', 12.90, 12.90, 1, NULL, 0.00, '2014-05-02 04:06:37', '2014-05-02 04:07:24'),
(60, 7, 15, 'Tequeños Lomito', 12.90, 12.90, 1, NULL, 0.00, '2014-05-02 04:06:37', '2014-05-02 04:07:24'),
(61, 7, 15, 'Salchipapas Especial', 12.90, 12.90, 1, NULL, 0.00, '2014-05-02 04:06:37', '2014-05-02 04:07:24'),
(62, 8, 16, 'Pan Al Ajo Especial', 4.90, 4.90, 1, NULL, 0.00, '2014-05-02 04:09:26', '2014-05-02 04:10:01'),
(63, 8, 16, 'Humita', 3.50, 3.50, 1, NULL, 0.00, '2014-05-02 04:09:26', '2014-05-02 04:10:01'),
(64, 8, 16, 'Boliyucas', 12.90, 12.90, 1, NULL, 0.00, '2014-05-02 04:09:26', '2014-05-02 04:10:01'),
(65, 8, 16, 'Tequeños Lomito', 12.90, 12.90, 1, NULL, 0.00, '2014-05-02 04:09:26', '2014-05-02 04:10:01'),
(66, 8, 16, 'Salchipapas Especial', 12.90, 12.90, 1, NULL, 0.00, '2014-05-02 04:09:26', '2014-05-02 04:10:01'),
(67, 9, 17, 'Emp. Aji De Gallina', 7.90, 7.90, 1, NULL, 0.00, '2014-05-02 04:14:06', '2014-05-02 04:14:20'),
(68, 9, 17, 'Emp. Pollo Bechamel', 7.90, 7.90, 1, NULL, 0.00, '2014-05-02 04:14:07', '2014-05-02 04:14:20'),
(69, 9, 17, 'Emp. Pizzera', 7.90, 7.90, 1, NULL, 0.00, '2014-05-02 04:14:07', '2014-05-02 04:14:20'),
(70, 9, 17, 'Emp. Lomo Saltado', 7.90, 7.90, 1, NULL, 0.00, '2014-05-02 04:14:07', '2014-05-02 04:14:20'),
(71, 9, 17, 'Empanada De Manzana', 3.90, 3.90, 1, NULL, 0.00, '2014-05-02 04:14:07', '2014-05-02 04:14:20'),
(72, 10, 18, 'Emp. Aji De Gallina', 7.90, 7.90, 1, NULL, 0.00, '2014-05-02 04:15:37', '2014-05-02 04:15:46'),
(73, 10, 18, 'Emp. Pollo Bechamel', 7.90, 7.90, 1, NULL, 0.00, '2014-05-02 04:15:37', '2014-05-02 04:15:46'),
(74, 10, 18, 'Emp. Pizzera', 7.90, 7.90, 1, NULL, 0.00, '2014-05-02 04:15:37', '2014-05-02 04:15:46'),
(75, 10, 18, 'Emp. Lomo Saltado', 7.90, 7.90, 1, NULL, 0.00, '2014-05-02 04:15:37', '2014-05-02 04:15:46'),
(76, 10, 18, 'Empanada De Manzana', 3.90, 3.90, 1, NULL, 0.00, '2014-05-02 04:15:37', '2014-05-02 04:15:46'),
(77, 11, 33, 'Emp. Aji De Gallina', 7.90, 7.90, 1, NULL, 0.00, '2014-05-02 04:19:53', '2014-05-02 07:58:08'),
(78, 11, 33, 'Emp. Pollo Bechamel', 7.90, 7.90, 1, NULL, 0.00, '2014-05-02 04:19:53', '2014-05-02 07:58:08'),
(79, 11, 33, 'Emp. Pizzera', 7.90, 7.90, 1, NULL, 0.00, '2014-05-02 04:19:53', '2014-05-02 07:58:08'),
(80, 11, 33, 'Emp. Lomo Saltado', 7.90, 7.90, 1, NULL, 0.00, '2014-05-02 04:19:53', '2014-05-02 07:58:08'),
(81, 11, 33, 'Empanada De Manzana', 3.90, 3.90, 1, NULL, 0.00, '2014-05-02 04:19:53', '2014-05-02 07:58:08'),
(82, 12, 19, 'Emp. Aji De Gallina', 7.90, 7.90, 1, NULL, 0.00, '2014-05-02 04:30:21', '2014-05-02 04:30:32'),
(83, 12, 19, 'Emp. Pollo Bechamel', 7.90, 7.90, 1, NULL, 0.00, '2014-05-02 04:30:21', '2014-05-02 04:30:32'),
(84, 12, 19, 'Emp. Pizzera', 7.90, 7.90, 1, NULL, 0.00, '2014-05-02 04:30:21', '2014-05-02 04:30:32'),
(85, 12, 19, 'Emp. Lomo Saltado', 7.90, 7.90, 1, NULL, 0.00, '2014-05-02 04:30:21', '2014-05-02 04:30:32'),
(86, 12, 19, 'Empanada De Manzana', 3.90, 3.90, 1, NULL, 0.00, '2014-05-02 04:30:21', '2014-05-02 04:30:32'),
(87, 13, 20, 'Emp. Aji De Gallina', 7.90, 7.90, 1, NULL, 0.00, '2014-05-02 04:31:03', '2014-05-02 04:31:14'),
(88, 13, 20, 'Emp. Pollo Bechamel', 7.90, 7.90, 1, NULL, 0.00, '2014-05-02 04:31:03', '2014-05-02 04:31:14'),
(89, 13, 20, 'Emp. Pizzera', 7.90, 7.90, 1, NULL, 0.00, '2014-05-02 04:31:03', '2014-05-02 04:31:14'),
(90, 13, 20, 'Emp. Lomo Saltado', 7.90, 7.90, 1, NULL, 0.00, '2014-05-02 04:31:03', '2014-05-02 04:31:14'),
(91, 13, 20, 'Empanada De Manzana', 3.90, 3.90, 1, NULL, 0.00, '2014-05-02 04:31:04', '2014-05-02 04:31:14'),
(92, 14, 21, 'Emp. Aji De Gallina', 7.90, 7.90, 1, NULL, 0.00, '2014-05-02 04:51:51', '2014-05-02 04:52:41'),
(93, 14, 21, 'Emp. Pollo Bechamel', 7.90, 7.90, 1, NULL, 0.00, '2014-05-02 04:51:51', '2014-05-02 04:52:41'),
(94, 14, 21, 'Emp. Pizzera', 7.90, 7.90, 1, NULL, 0.00, '2014-05-02 04:51:51', '2014-05-02 04:52:41'),
(95, 14, 21, 'Emp. Lomo Saltado', 7.90, 7.90, 1, NULL, 0.00, '2014-05-02 04:51:52', '2014-05-02 04:52:41'),
(96, 14, 21, 'Empanada De Manzana', 3.90, 3.90, 1, NULL, 0.00, '2014-05-02 04:51:52', '2014-05-02 04:52:41'),
(97, 15, 22, 'Emp. Aji De Gallina', 7.90, 7.90, 1, NULL, 0.00, '2014-05-02 04:53:09', '2014-05-02 04:53:30'),
(98, 15, 22, 'Emp. Pollo Bechamel', 7.90, 7.90, 1, NULL, 0.00, '2014-05-02 04:53:09', '2014-05-02 04:53:30'),
(99, 15, 22, 'Emp. Pizzera', 7.90, 7.90, 1, NULL, 0.00, '2014-05-02 04:53:09', '2014-05-02 04:53:30'),
(100, 15, 22, 'Emp. Lomo Saltado', 7.90, 7.90, 1, NULL, 0.00, '2014-05-02 04:53:09', '2014-05-02 04:53:30'),
(101, 15, 22, 'Empanada De Manzana', 3.90, 3.90, 1, NULL, 0.00, '2014-05-02 04:53:09', '2014-05-02 04:53:30'),
(102, 15, 23, 'Emp. Aji De Gallina', 7.90, 7.90, 1, NULL, 0.00, '2014-05-02 04:53:43', '2014-05-02 04:56:18'),
(103, 15, 23, 'Emp. Pollo Bechamel', 7.90, 7.90, 1, NULL, 0.00, '2014-05-02 04:53:43', '2014-05-02 04:56:18'),
(104, 16, 24, 'Emp. Aji De Gallina', 7.90, 7.90, 1, NULL, 0.00, '2014-05-02 04:56:46', '2014-05-02 04:56:57'),
(105, 16, 24, 'Emp. Pollo Bechamel', 7.90, 7.90, 1, NULL, 0.00, '2014-05-02 04:56:46', '2014-05-02 04:56:57'),
(106, 16, 24, 'Emp. Pizzera', 7.90, 7.90, 1, NULL, 0.00, '2014-05-02 04:56:46', '2014-05-02 04:56:57'),
(107, 16, 24, 'Emp. Lomo Saltado', 7.90, 7.90, 1, NULL, 0.00, '2014-05-02 04:56:46', '2014-05-02 04:56:57'),
(108, 16, 24, 'Empanada De Manzana', 3.90, 3.90, 1, NULL, 0.00, '2014-05-02 04:56:46', '2014-05-02 04:56:57'),
(109, 17, 25, 'Emp. Aji De Gallina', 7.90, 7.90, 1, NULL, 0.00, '2014-05-02 06:07:10', '2014-05-02 06:07:20'),
(110, 17, 25, 'Emp. Pollo Bechamel', 7.90, 7.90, 1, NULL, 0.00, '2014-05-02 06:07:10', '2014-05-02 06:07:20'),
(111, 17, 25, 'Emp. Pizzera', 7.90, 7.90, 1, NULL, 0.00, '2014-05-02 06:07:10', '2014-05-02 06:07:20'),
(112, 17, 25, 'Emp. Lomo Saltado', 7.90, 7.90, 1, NULL, 0.00, '2014-05-02 06:07:10', '2014-05-02 06:07:20'),
(113, 17, 25, 'Empanada De Manzana', 3.90, 3.90, 1, NULL, 0.00, '2014-05-02 06:07:10', '2014-05-02 06:07:20'),
(114, 17, NULL, 'Emp. Aji De Gallina', 15.80, 7.90, 2, NULL, 0.00, '2014-05-02 06:07:49', '2014-05-02 06:08:44'),
(115, 17, NULL, 'Emp. Pollo Bechamel', 7.90, 7.90, 1, NULL, 0.00, '2014-05-02 06:07:49', '2014-05-02 06:07:49'),
(116, 17, NULL, 'Emp. Pizzera', 7.90, 7.90, 1, NULL, 0.00, '2014-05-02 06:07:49', '2014-05-02 06:07:49'),
(117, 17, NULL, 'Emp. Lomo Saltado', 7.90, 7.90, 1, NULL, 0.00, '2014-05-02 06:07:49', '2014-05-02 06:07:49'),
(118, 17, NULL, 'Empanada De Manzana', 3.90, 3.90, 1, NULL, 0.00, '2014-05-02 06:07:49', '2014-05-02 06:07:49'),
(119, 18, 26, 'Pan Al Ajo Especial', 4.90, 4.90, 1, NULL, 0.00, '2014-05-02 06:09:54', '2014-05-02 06:10:07'),
(120, 18, 26, 'Humita', 3.50, 3.50, 1, NULL, 0.00, '2014-05-02 06:09:54', '2014-05-02 06:10:07'),
(121, 18, 26, 'Boliyucas', 12.90, 12.90, 1, NULL, 0.00, '2014-05-02 06:09:54', '2014-05-02 06:10:07'),
(122, 18, 26, 'Tequeños Lomito', 12.90, 12.90, 1, NULL, 0.00, '2014-05-02 06:09:54', '2014-05-02 06:10:07'),
(123, 18, 26, 'Salchipapas Especial', 12.90, 12.90, 1, NULL, 0.00, '2014-05-02 06:09:54', '2014-05-02 06:10:07'),
(124, 19, 27, 'Emp. Aji De Gallina', 7.90, 7.90, 1, NULL, 0.00, '2014-05-02 06:15:12', '2014-05-02 06:15:33'),
(125, 19, 27, 'Emp. Pollo Bechamel', 7.90, 7.90, 1, NULL, 0.00, '2014-05-02 06:15:12', '2014-05-02 06:15:33'),
(126, 19, 27, 'Emp. Pizzera', 7.90, 7.90, 1, NULL, 0.00, '2014-05-02 06:15:12', '2014-05-02 06:15:33'),
(127, 19, 27, 'Emp. Lomo Saltado', 7.90, 7.90, 1, NULL, 0.00, '2014-05-02 06:15:12', '2014-05-02 06:15:33'),
(128, 19, 27, 'Empanada De Manzana', 3.90, 3.90, 1, NULL, 0.00, '2014-05-02 06:15:12', '2014-05-02 06:15:33'),
(129, 20, NULL, 'Emp. Aji De Gallina', 7.90, 7.90, 1, NULL, 0.00, '2014-05-02 06:17:47', '2014-05-02 06:17:47'),
(130, 20, NULL, 'Emp. Pollo Bechamel', 7.90, 7.90, 1, NULL, 0.00, '2014-05-02 06:17:47', '2014-05-02 06:17:47'),
(131, 20, NULL, 'Emp. Pizzera', 7.90, 7.90, 1, NULL, 0.00, '2014-05-02 06:17:47', '2014-05-02 06:17:47'),
(132, 20, NULL, 'Emp. Lomo Saltado', 7.90, 7.90, 1, NULL, 0.00, '2014-05-02 06:17:47', '2014-05-02 06:17:47'),
(133, 20, NULL, 'Empanada De Manzana', 3.90, 3.90, 1, NULL, 0.00, '2014-05-02 06:17:47', '2014-05-02 06:17:47'),
(134, 21, NULL, 'Emp. Aji De Gallina', 7.90, 7.90, 1, NULL, 0.00, '2014-05-02 06:23:26', '2014-05-02 06:23:26'),
(135, 21, NULL, 'Emp. Pollo Bechamel', 7.90, 7.90, 1, NULL, 0.00, '2014-05-02 06:23:26', '2014-05-02 06:23:26'),
(136, 21, NULL, 'Emp. Pizzera', 7.90, 7.90, 1, NULL, 0.00, '2014-05-02 06:23:26', '2014-05-02 06:23:26'),
(137, 21, NULL, 'Emp. Lomo Saltado', 7.90, 7.90, 1, NULL, 0.00, '2014-05-02 06:23:26', '2014-05-02 06:23:26'),
(138, 21, NULL, 'Empanada De Manzana', 3.90, 3.90, 1, NULL, 0.00, '2014-05-02 06:23:26', '2014-05-02 06:23:26'),
(139, 22, 28, 'Emp. Aji De Gallina', 7.90, 7.90, 1, NULL, 0.00, '2014-05-02 06:24:38', '2014-05-02 06:24:49'),
(140, 22, 28, 'Emp. Pollo Bechamel', 7.90, 7.90, 1, NULL, 0.00, '2014-05-02 06:24:38', '2014-05-02 06:24:49'),
(141, 22, 28, 'Emp. Pizzera', 7.90, 7.90, 1, NULL, 0.00, '2014-05-02 06:24:38', '2014-05-02 06:24:49'),
(142, 22, 28, 'Emp. Lomo Saltado', 7.90, 7.90, 1, NULL, 0.00, '2014-05-02 06:24:38', '2014-05-02 06:24:49'),
(143, 22, 28, 'Empanada De Manzana', 3.90, 3.90, 1, NULL, 0.00, '2014-05-02 06:24:38', '2014-05-02 06:24:49'),
(144, 23, 29, 'Emp. Aji De Gallina', 7.90, 7.90, 1, NULL, 0.00, '2014-05-02 06:26:25', '2014-05-02 06:26:39'),
(145, 23, 29, 'Emp. Pollo Bechamel', 7.90, 7.90, 1, NULL, 0.00, '2014-05-02 06:26:25', '2014-05-02 06:26:39'),
(146, 23, 29, 'Emp. Pizzera', 7.90, 7.90, 1, NULL, 0.00, '2014-05-02 06:26:25', '2014-05-02 06:26:39'),
(147, 23, 29, 'Emp. Lomo Saltado', 7.90, 7.90, 1, NULL, 0.00, '2014-05-02 06:26:25', '2014-05-02 06:26:39'),
(148, 23, 29, 'Empanada De Manzana', 3.90, 3.90, 1, NULL, 0.00, '2014-05-02 06:26:25', '2014-05-02 06:26:39'),
(149, 24, 30, 'Emp. Aji De Gallina', 7.90, 7.90, 1, NULL, 0.00, '2014-05-02 06:27:30', '2014-05-02 06:27:49'),
(150, 24, 30, 'Emp. Pollo Bechamel', 7.90, 7.90, 1, NULL, 0.00, '2014-05-02 06:27:30', '2014-05-02 06:27:49'),
(151, 24, 30, 'Emp. Pizzera', 7.90, 7.90, 1, NULL, 0.00, '2014-05-02 06:27:30', '2014-05-02 06:27:49'),
(152, 24, 30, 'Emp. Lomo Saltado', 7.90, 7.90, 1, NULL, 0.00, '2014-05-02 06:27:31', '2014-05-02 06:27:49'),
(153, 24, 30, 'Empanada De Manzana', 3.90, 3.90, 1, NULL, 0.00, '2014-05-02 06:27:31', '2014-05-02 06:27:49'),
(154, 25, 31, 'Emp. Aji De Gallina', 7.90, 7.90, 1, NULL, 0.00, '2014-05-02 06:29:05', '2014-05-02 06:29:21'),
(155, 25, 31, 'Emp. Pollo Bechamel', 7.90, 7.90, 1, NULL, 0.00, '2014-05-02 06:29:05', '2014-05-02 06:29:21'),
(156, 25, 31, 'Emp. Pizzera', 7.90, 7.90, 1, NULL, 0.00, '2014-05-02 06:29:05', '2014-05-02 06:29:21'),
(157, 25, 31, 'Emp. Lomo Saltado', 7.90, 7.90, 1, NULL, 0.00, '2014-05-02 06:29:05', '2014-05-02 06:29:21'),
(158, 25, 31, 'Empanada De Manzana', 3.90, 3.90, 1, NULL, 0.00, '2014-05-02 06:29:05', '2014-05-02 06:29:21'),
(159, 26, 32, 'Emp. Aji De Gallina', 7.90, 7.90, 1, NULL, 0.00, '2014-05-02 06:30:49', '2014-05-02 06:31:03'),
(160, 26, 32, 'Emp. Pollo Bechamel', 7.90, 7.90, 1, NULL, 0.00, '2014-05-02 06:30:49', '2014-05-02 06:31:03'),
(161, 26, 32, 'Emp. Pizzera', 7.90, 7.90, 1, NULL, 0.00, '2014-05-02 06:30:49', '2014-05-02 06:31:03'),
(162, 26, 32, 'Emp. Lomo Saltado', 7.90, 7.90, 1, NULL, 0.00, '2014-05-02 06:30:49', '2014-05-02 06:31:03'),
(163, 26, 32, 'Empanada De Manzana', 3.90, 3.90, 1, NULL, 0.00, '2014-05-02 06:30:49', '2014-05-02 06:31:03'),
(164, 32, 34, 'Emp. Aji De Gallina', 7.90, 7.90, 1, NULL, 0.00, '2014-05-02 17:30:40', '2014-05-02 17:30:54'),
(165, 32, 34, 'Emp. Pollo Bechamel', 7.90, 7.90, 1, NULL, 0.00, '2014-05-02 17:30:40', '2014-05-02 17:30:54'),
(166, 32, 34, 'Emp. Pizzera', 7.90, 7.90, 1, NULL, 0.00, '2014-05-02 17:30:40', '2014-05-02 17:30:54'),
(167, 32, 34, 'Emp. Lomo Saltado', 7.90, 7.90, 1, NULL, 0.00, '2014-05-02 17:30:40', '2014-05-02 17:30:54'),
(168, 32, 34, 'Empanada De Manzana', 3.90, 3.90, 1, NULL, 0.00, '2014-05-02 17:30:40', '2014-05-02 17:30:54'),
(169, 41, 35, 'Chicha Morada', 2.90, 2.90, 1, NULL, 0.00, '2014-05-03 00:45:36', '2014-05-03 00:48:20'),
(170, 41, 36, 'Limonada Frozen', 5.90, 5.90, 1, NULL, 0.00, '2014-05-03 00:45:36', '2014-05-03 00:49:35'),
(171, 41, 35, 'Coca Cola', 3.50, 3.50, 1, NULL, 0.00, '2014-05-03 00:45:36', '2014-05-03 00:48:20'),
(172, 41, 36, 'Sdw. Chanchito Oriental', 10.90, 10.90, 1, NULL, 0.00, '2014-05-03 00:45:36', '2014-05-03 00:49:35'),
(173, 41, 36, 'Huevo Frito', 1.00, 1.00, 1, NULL, 0.00, '2014-05-03 00:45:36', '2014-05-03 00:49:35'),
(174, 41, 36, 'Queso', 1.00, 1.00, 1, NULL, 0.00, '2014-05-03 00:45:36', '2014-05-03 00:49:35'),
(175, 42, 37, 'Chicha Morada', 2.90, 2.90, 1, NULL, 0.00, '2014-05-03 18:42:48', '2014-05-03 18:43:41'),
(176, 42, NULL, 'Limonada Frozen', 11.80, 5.90, 2, NULL, 0.00, '2014-05-03 18:42:48', '2014-05-03 18:42:48'),
(177, 42, 37, 'Sdw. Chanchito Oriental', 10.90, 10.90, 1, NULL, 0.00, '2014-05-03 18:42:48', '2014-05-03 18:43:41'),
(178, 42, NULL, 'Huevo Frito', 2.00, 1.00, 2, NULL, 0.00, '2014-05-03 18:42:48', '2014-05-03 18:42:48'),
(179, 42, NULL, 'Queso', 1.00, 1.00, 1, NULL, 0.00, '2014-05-03 18:42:48', '2014-05-03 18:42:48'),
(180, 33, 38, 'Emp. Aji De Gallina', 7.90, 7.90, 1, NULL, 0.00, '2014-05-05 04:46:51', '2014-05-05 08:18:57'),
(181, 33, 38, 'Emp. Pollo Bechamel', 7.90, 7.90, 1, NULL, 0.00, '2014-05-05 04:46:51', '2014-05-05 08:18:57'),
(182, 33, 38, 'Emp. Pizzera', 7.90, 7.90, 1, NULL, 0.00, '2014-05-05 04:46:51', '2014-05-05 08:18:57'),
(183, 33, 38, 'Emp. Lomo Saltado', 7.90, 7.90, 1, NULL, 0.00, '2014-05-05 04:46:51', '2014-05-05 08:18:57'),
(184, 33, 38, 'Empanada De Manzana', 3.90, 3.90, 1, NULL, 0.00, '2014-05-05 04:46:51', '2014-05-05 08:18:57'),
(185, 33, 38, 'Macedonia', 10.90, 10.90, 1, NULL, 0.00, '2014-05-05 04:46:51', '2014-05-05 08:18:57'),
(186, 33, 38, 'Chocomix Frutal', 10.90, 10.90, 1, NULL, 0.00, '2014-05-05 04:46:51', '2014-05-05 08:18:57'),
(187, 33, 38, 'Yogurt Frutado', 8.90, 8.90, 1, NULL, 0.00, '2014-05-05 04:46:51', '2014-05-05 08:18:57'),
(188, 33, 38, 'Macedonia Helado', 12.90, 12.90, 1, NULL, 0.00, '2014-05-05 04:46:51', '2014-05-05 08:18:57'),
(189, 33, 38, 'Vaso Yogurt', 4.90, 4.90, 1, NULL, 0.00, '2014-05-05 04:46:51', '2014-05-05 08:18:57'),
(190, 33, 38, 'Cafe Pasado', 7.80, 3.90, 2, NULL, 0.00, '2014-05-05 04:46:51', '2014-05-05 08:18:57'),
(191, 33, 38, 'Cortado', 9.80, 4.90, 2, NULL, 0.00, '2014-05-05 04:46:51', '2014-05-05 08:18:57'),
(192, 33, 38, 'Chocolate Kango', 13.80, 6.90, 2, NULL, 0.00, '2014-05-05 04:46:51', '2014-05-05 08:18:57'),
(193, 33, 38, 'Cafe Capuccino', 17.70, 5.90, 3, NULL, 0.00, '2014-05-05 04:46:51', '2014-05-05 08:18:57'),
(194, 33, 38, 'Te Frutado c/Limon', 3.90, 3.90, 1, NULL, 0.00, '2014-05-05 04:49:17', '2014-05-05 08:18:57'),
(195, 33, 38, 'Mokaccino', 5.90, 5.90, 1, NULL, 0.00, '2014-05-05 04:49:17', '2014-05-05 08:18:57'),
(196, 33, 38, 'Anis', 3.50, 3.50, 1, NULL, 0.00, '2014-05-05 04:49:17', '2014-05-05 08:18:57'),
(197, 33, 38, 'Manzanilla', 3.50, 3.50, 1, NULL, 0.00, '2014-05-05 04:49:17', '2014-05-05 08:18:57'),
(198, 33, 38, 'Cafe Expreso', 5.90, 5.90, 1, NULL, 0.00, '2014-05-05 04:49:17', '2014-05-05 08:18:57'),
(199, 33, 38, 'Tasa De Leche', 3.50, 3.50, 1, NULL, 0.00, '2014-05-05 04:49:17', '2014-05-05 08:18:57'),
(200, 33, 38, 'Cafe Con Leche', 4.90, 4.90, 1, NULL, 0.00, '2014-05-05 04:49:17', '2014-05-05 08:18:57'),
(201, 34, NULL, 'Emp. Aji De Gallina', 7.90, 7.90, 1, NULL, 0.00, '2014-05-05 07:42:40', '2014-05-05 07:42:40'),
(202, 34, NULL, 'Emp. Pollo Bechamel', 7.90, 7.90, 1, NULL, 0.00, '2014-05-05 07:42:40', '2014-05-05 07:42:40'),
(203, 34, NULL, 'Emp. Pizzera', 7.90, 7.90, 1, NULL, 0.00, '2014-05-05 07:42:40', '2014-05-05 07:42:40'),
(204, 34, NULL, 'Emp. Lomo Saltado', 7.90, 7.90, 1, NULL, 0.00, '2014-05-05 07:42:40', '2014-05-05 07:42:40'),
(205, 34, NULL, 'Empanada De Manzana', 3.90, 3.90, 1, NULL, 0.00, '2014-05-05 07:42:40', '2014-05-05 07:42:40'),
(206, 43, 39, 'Frappe Norteño', 10.90, 10.90, 1, NULL, 0.00, '2014-05-05 08:21:08', '2014-05-05 08:23:57'),
(207, 43, 39, 'Frappe Maniako', 10.90, 10.90, 1, NULL, 0.00, '2014-05-05 08:21:08', '2014-05-05 08:23:57'),
(208, 43, 39, 'Frappe Mokachips', 10.90, 10.90, 1, NULL, 0.00, '2014-05-05 08:21:08', '2014-05-05 08:23:57'),
(209, 43, 39, 'Emp. Aji De Gallina', 7.90, 7.90, 1, NULL, 0.00, '2014-05-05 08:21:08', '2014-05-05 08:23:57'),
(210, 43, 39, 'Emp. Pollo Bechamel', 7.90, 7.90, 1, NULL, 0.00, '2014-05-05 08:21:08', '2014-05-05 08:23:57'),
(211, 43, 39, 'Emp. Lomo Saltado', 7.90, 7.90, 1, NULL, 0.00, '2014-05-05 08:21:08', '2014-05-05 08:23:57'),
(212, 43, 39, 'Empanada De Manzana', 3.90, 3.90, 1, NULL, 0.00, '2014-05-05 08:21:08', '2014-05-05 08:23:57'),
(213, 43, 39, 'Nativo', 5.90, 5.90, 1, NULL, 0.00, '2014-05-05 08:21:08', '2014-05-05 08:23:57'),
(214, 43, 39, 'Tropical', 5.90, 5.90, 1, NULL, 0.00, '2014-05-05 08:21:08', '2014-05-05 08:23:57'),
(215, 43, 39, 'Pasion Frutal', 5.90, 5.90, 1, NULL, 0.00, '2014-05-05 08:21:08', '2014-05-05 08:23:57'),
(216, 43, 39, 'Citrus', 5.90, 5.90, 1, NULL, 0.00, '2014-05-05 08:21:08', '2014-05-05 08:23:57'),
(217, 43, 39, 'Mambo', 5.90, 5.90, 1, NULL, 0.00, '2014-05-05 08:21:08', '2014-05-05 08:23:57'),
(218, 43, 39, 'Andino', 5.90, 5.90, 1, NULL, 0.00, '2014-05-05 08:21:08', '2014-05-05 08:23:57'),
(219, 43, 39, 'Fresh', 5.90, 5.90, 1, NULL, 0.00, '2014-05-05 08:21:08', '2014-05-05 08:23:57'),
(220, 43, 39, 'Lactico', 8.90, 8.90, 1, NULL, 0.00, '2014-05-05 08:21:08', '2014-05-05 08:23:57'),
(221, 43, 39, 'Jarra Frutimix', 15.90, 15.90, 1, NULL, 0.00, '2014-05-05 08:21:08', '2014-05-05 08:23:57'),
(222, 43, 39, 'Delicia', 8.90, 8.90, 1, NULL, 0.00, '2014-05-05 08:21:08', '2014-05-05 08:23:57'),
(223, 43, 39, 'Macedonia', 10.90, 10.90, 1, NULL, 0.00, '2014-05-05 08:21:08', '2014-05-05 08:23:57'),
(224, 43, 39, 'Chocomix Frutal', 10.90, 10.90, 1, NULL, 0.00, '2014-05-05 08:21:08', '2014-05-05 08:23:57'),
(225, 43, 39, 'Yogurt Frutado', 8.90, 8.90, 1, NULL, 0.00, '2014-05-05 08:21:08', '2014-05-05 08:23:57'),
(226, 43, 39, 'Macedonia Helado', 12.90, 12.90, 1, NULL, 0.00, '2014-05-05 08:21:08', '2014-05-05 08:23:57'),
(227, 43, 39, 'Vaso Yogurt', 4.90, 4.90, 1, NULL, 0.00, '2014-05-05 08:21:08', '2014-05-05 08:23:57'),
(228, 43, 39, 'Bgr. Clasica', 10.90, 10.90, 1, NULL, 0.00, '2014-05-05 08:21:08', '2014-05-05 08:23:57'),
(229, 43, 39, 'Bgr. Bacon', 11.90, 11.90, 1, NULL, 0.00, '2014-05-05 08:21:08', '2014-05-05 08:23:57'),
(230, 43, 39, 'Brg. Parrillera', 12.90, 12.90, 1, NULL, 0.00, '2014-05-05 08:21:08', '2014-05-05 08:23:57'),
(231, 43, 39, 'Bgr. Frenchi', 12.90, 12.90, 1, NULL, 0.00, '2014-05-05 08:21:08', '2014-05-05 08:23:57'),
(232, 43, 39, 'Adicionales', 1.50, 1.50, 1, NULL, 0.00, '2014-05-05 08:21:08', '2014-05-05 08:23:57'),
(233, 36, NULL, 'Emp. Aji De Gallina', 7.90, 7.90, 1, NULL, 0.00, '2014-05-06 23:43:21', '2014-05-06 23:43:21'),
(234, 36, NULL, 'Emp. Pollo Bechamel', 7.90, 7.90, 1, NULL, 0.00, '2014-05-06 23:43:21', '2014-05-06 23:43:21'),
(235, 36, NULL, 'Emp. Pizzera', 7.90, 7.90, 1, NULL, 0.00, '2014-05-06 23:43:21', '2014-05-06 23:43:21'),
(236, 36, NULL, 'Emp. Lomo Saltado', 7.90, 7.90, 1, NULL, 0.00, '2014-05-06 23:43:21', '2014-05-06 23:43:21'),
(237, 36, NULL, 'Empanada De Manzana', 3.90, 3.90, 1, NULL, 0.00, '2014-05-06 23:43:21', '2014-05-06 23:43:21'),
(238, 35, NULL, 'Emp. Aji De Gallina', 7.90, 7.90, 1, NULL, 0.00, '2014-05-06 23:45:24', '2014-05-06 23:45:24'),
(239, 35, NULL, 'Emp. Pollo Bechamel', 7.90, 7.90, 1, NULL, 0.00, '2014-05-06 23:45:24', '2014-05-06 23:45:24'),
(240, 35, NULL, 'Emp. Pizzera', 7.90, 7.90, 1, NULL, 0.00, '2014-05-06 23:45:24', '2014-05-06 23:45:24'),
(241, 35, NULL, 'Emp. Lomo Saltado', 7.90, 7.90, 1, NULL, 0.00, '2014-05-06 23:45:24', '2014-05-06 23:45:24'),
(242, 35, NULL, 'Empanada De Manzana', 3.90, 3.90, 1, NULL, 0.00, '2014-05-06 23:45:24', '2014-05-06 23:45:24'),
(243, 35, NULL, 'Sdw. Chanchito Oriental', 10.90, 10.90, 1, NULL, 0.00, '2014-05-06 23:45:24', '2014-05-06 23:45:24'),
(244, 35, NULL, 'Huevo Frito', 1.00, 1.00, 1, NULL, 0.00, '2014-05-06 23:45:24', '2014-05-06 23:45:24'),
(245, 35, NULL, 'Queso', 1.00, 1.00, 1, NULL, 0.00, '2014-05-06 23:45:24', '2014-05-06 23:45:24'),
(246, 40, NULL, 'Emp. Aji De Gallina', 7.90, 7.90, 1, NULL, 0.00, '2014-05-06 23:53:22', '2014-05-06 23:53:22'),
(247, 40, NULL, 'Emp. Pollo Bechamel', 7.90, 7.90, 1, NULL, 0.00, '2014-05-06 23:53:22', '2014-05-06 23:53:22'),
(248, 40, NULL, 'Emp. Pizzera', 7.90, 7.90, 1, NULL, 0.00, '2014-05-06 23:53:22', '2014-05-06 23:53:22'),
(249, 40, NULL, 'Emp. Lomo Saltado', 7.90, 7.90, 1, NULL, 0.00, '2014-05-06 23:53:22', '2014-05-06 23:53:22'),
(250, 40, NULL, 'Empanada De Manzana', 3.90, 3.90, 1, NULL, 0.00, '2014-05-06 23:53:22', '2014-05-06 23:53:22'),
(251, 30, NULL, 'Frappe Norteño', 10.90, 10.90, 1, NULL, 0.00, '2014-05-07 00:11:11', '2014-05-07 00:11:11'),
(252, 30, NULL, 'Frappe Maniako', 10.90, 10.90, 1, NULL, 0.00, '2014-05-07 00:11:11', '2014-05-07 00:11:11'),
(253, 30, NULL, 'Frappe Mokachips', 10.90, 10.90, 1, NULL, 0.00, '2014-05-07 00:11:11', '2014-05-07 00:11:11');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `documentos`
--

CREATE TABLE IF NOT EXISTS `documentos` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_tipodedocumento` int(11) NOT NULL,
  `ndocumento` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `serie` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `familia`
--

CREATE TABLE IF NOT EXISTS `familia` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) DEFAULT NULL,
  `descripcion` text,
  `imagen` text COMMENT '''ruta''',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=25 ;

--
-- Volcado de datos para la tabla `familia`
--

INSERT INTO `familia` (`id`, `nombre`, `descripcion`, `imagen`, `created_at`, `updated_at`) VALUES
(1, 'Bebidas Frias', NULL, NULL, NULL, NULL),
(2, 'Postres', NULL, NULL, NULL, NULL),
(3, 'Tragos', NULL, NULL, NULL, NULL),
(4, 'Delicias Saladas', NULL, NULL, NULL, NULL),
(5, 'Platos a la Carta', NULL, NULL, NULL, NULL),
(6, 'Helados Kango', NULL, NULL, NULL, NULL),
(7, 'Sorbetes', NULL, NULL, NULL, NULL),
(8, 'Krasher', NULL, NULL, NULL, NULL),
(9, 'Empanadas', NULL, NULL, NULL, NULL),
(10, 'Frutimix', NULL, NULL, NULL, NULL),
(11, 'Ensalada de Frutas', NULL, NULL, NULL, NULL),
(12, 'Bebidas Calientes', NULL, NULL, NULL, NULL),
(13, 'Sandwich', NULL, NULL, NULL, NULL),
(14, 'Adicionales', NULL, NULL, NULL, NULL),
(15, 'Pizzas', NULL, NULL, NULL, NULL),
(16, 'Triples', NULL, NULL, NULL, NULL),
(17, 'Otros', NULL, NULL, NULL, NULL),
(18, 'Frappes', NULL, NULL, NULL, NULL),
(19, 'Tortas Enteras', NULL, NULL, NULL, NULL),
(20, 'Platos Peña', NULL, NULL, NULL, NULL),
(21, 'Hamburguesa', NULL, NULL, NULL, NULL),
(22, 'Rolls', NULL, NULL, NULL, NULL),
(23, 'Entradas (Menu)', 'aqui se guardaran todas las entradas para todos los menues', NULL, NULL, NULL),
(24, 'Platos de Fondo (Menu)', 'todos los platos de fondo para el menu', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `formadepago`
--

CREATE TABLE IF NOT EXISTS `formadepago` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `formadepago`
--

INSERT INTO `formadepago` (`id`, `nombre`, `created_at`, `updated_at`) VALUES
(1, 'Efectivo', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 'Tarjeta', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 'Vale', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `infnut`
--

CREATE TABLE IF NOT EXISTS `infnut` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) DEFAULT NULL,
  `descripcion` text,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `insumo`
--

CREATE TABLE IF NOT EXISTS `insumo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(300) DEFAULT NULL,
  `descripcion` text,
  `stock` decimal(10,2) DEFAULT NULL,
  `stockMin` decimal(10,2) DEFAULT NULL,
  `stockMax` decimal(10,2) DEFAULT NULL,
  `unidadMedida` varchar(45) DEFAULT NULL COMMENT '''unidades, litros kilos''',
  `costo` decimal(10,2) DEFAULT NULL COMMENT 'costo del insumo promedio.',
  `selector` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `tipoins_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_Insumo_tipoins1_idx` (`tipoins_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mesa`
--

CREATE TABLE IF NOT EXISTS `mesa` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) DEFAULT NULL,
  `descripcion` text,
  `salon_id` int(11) NOT NULL,
  `estado` char(1) DEFAULT NULL COMMENT '0 --> deshabilitado1 --> habilitado.',
  `habilitado` tinyint(1) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `actividad` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_Mesa_Salon1_idx` (`salon_id`) USING BTREE,
  KEY `fk_mesa_1_idx` (`actividad`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=27 ;

--
-- Volcado de datos para la tabla `mesa`
--

INSERT INTO `mesa` (`id`, `nombre`, `descripcion`, `salon_id`, `estado`, `habilitado`, `created_at`, `updated_at`, `actividad`) VALUES
(1, 'Mesa 01', NULL, 3, 'O', 1, '2014-04-01 00:15:05', '2014-05-05 08:20:23', 5),
(2, 'Mesa 02', NULL, 3, 'O', 1, '2014-04-01 00:15:05', '2014-05-02 18:00:35', NULL),
(3, 'Mesa 03', NULL, 3, 'O', 1, '2014-04-01 00:15:05', '2014-05-02 18:02:07', NULL),
(4, 'Mesa 04', NULL, 3, 'O', 1, '2014-04-01 00:15:05', '2014-05-02 18:02:31', NULL),
(5, 'Mesa 05', NULL, 3, 'O', 1, '2014-04-01 00:15:05', '2014-05-02 19:02:13', 8),
(6, 'Mesa 06', NULL, 3, 'O', 1, '2014-04-01 00:15:05', '2014-05-03 00:43:50', 8),
(7, 'Mesa 07', NULL, 3, 'O', 1, '2014-04-01 00:15:05', '2014-05-02 18:03:20', NULL),
(8, 'Mesa 08', NULL, 3, 'O', 1, '2014-04-01 00:15:05', '2014-05-02 18:03:45', NULL),
(9, 'Mesa 09', NULL, 3, 'O', 1, '2014-04-01 00:15:05', '2014-05-02 18:05:16', NULL),
(10, 'Mesa 10', NULL, 3, 'O', 1, '2014-04-01 00:15:05', '2014-05-03 18:41:42', 7),
(11, 'Mesa 11', NULL, 3, 'O', 1, '2014-04-01 00:15:05', '2014-05-02 06:06:52', 8),
(12, 'Mesa 12', NULL, 3, 'O', 1, '2014-04-01 00:15:05', '2014-05-02 06:09:36', 8),
(13, 'Mesa 13', NULL, 3, 'O', 1, '2014-04-01 00:15:05', '2014-05-02 06:14:41', 8),
(14, 'Mesa 14', NULL, 3, 'O', 1, '2014-04-01 00:15:05', '2014-05-02 06:17:35', 8),
(15, 'Mesa 15', NULL, 3, 'O', 1, '2014-04-01 00:15:05', '2014-05-02 06:18:10', 8),
(16, 'Mesa 16', NULL, 3, 'O', 1, '2014-04-01 00:15:05', '2014-05-02 06:24:28', 8),
(17, 'Mesa 17', NULL, 3, 'O', 1, '2014-04-01 00:15:05', '2014-05-02 06:26:10', 7),
(18, 'Mesa 18', NULL, 3, 'O', 1, '2014-04-01 00:15:05', '2014-05-02 06:27:21', 6),
(19, 'Mesa 19', NULL, 3, 'O', 1, '2014-04-01 00:15:05', '2014-05-02 06:28:42', 4),
(20, 'Mesa 20', NULL, 3, 'O', 1, '2014-04-01 00:15:05', '2014-05-02 06:30:35', 6),
(21, 'Mesa 21', NULL, 3, 'O', 1, '2014-04-01 00:15:05', '2014-05-02 06:47:52', NULL),
(22, 'Mesa 22', NULL, 3, 'O', 1, '2014-04-01 00:15:05', '2014-05-02 06:53:51', NULL),
(23, 'Mesa 23', NULL, 3, 'O', 1, '2014-04-01 00:15:05', '2014-05-02 06:54:27', NULL),
(24, 'Mesa 24', NULL, 3, 'O', 1, '2014-04-01 00:15:05', '2014-05-02 06:35:39', NULL),
(25, 'Mesa 25', NULL, 3, 'O', 1, '2014-04-01 00:15:05', '2014-05-02 06:37:11', NULL),
(26, 'Mesa 26', NULL, 3, 'O', 1, '2014-04-01 00:15:05', '2014-05-02 17:30:02', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE IF NOT EXISTS `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`migration`, `batch`) VALUES
('2014_04_15_153330_sabor', 1),
('2014_04_15_154914_detsabores', 2),
('2014_04_15_155406_detpedidosabores', 3),
('2014_04_15_155543_detproadiconal', 4),
('2014_04_15_182640_detallenotas', 5),
('2014_04_22_010329_formadepagotable', 6),
('2014_04_25_193231_detprecio_table', 7),
('2014_04_16_144514_ticketsTable', 8),
('2014_04_16_150537_dettiketpedidotable', 8),
('2014_04_22_010605_detformadepago_table', 8),
('2014_04_27_154743_caja_table', 9),
('2014_04_28_010736_TipodeGasto_table', 10),
('2014_04_28_011404_registrogastostable', 11);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `modulos`
--

CREATE TABLE IF NOT EXISTS `modulos` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id producto',
  `controlador` varchar(255) NOT NULL COMMENT 'nombre de controlador',
  `proceso` varchar(50) NOT NULL COMMENT 'nombre de metodo',
  `activo` tinyint(1) NOT NULL COMMENT 'si esta activo el proceso o no',
  `nombre` varchar(255) NOT NULL COMMENT 'Nombre dek proceso personalizado',
  `nmodulo` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Tabla para asignar permisos a los usarios se enlaza con perf /* comment truncated */ /*iles*/' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notas`
--

CREATE TABLE IF NOT EXISTS `notas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` text,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `notas`
--

INSERT INTO `notas` (`id`, `descripcion`, `created_at`, `updated_at`) VALUES
(1, 'Sin Sal', '2014-04-01 21:55:58', '2014-04-01 21:55:58'),
(2, 'Con Hielo', '2014-04-01 21:56:10', '2014-04-01 21:56:10'),
(3, 'Sin Azúcar', '2014-04-01 21:56:16', '2014-04-01 21:56:16');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notaxproducto`
--

CREATE TABLE IF NOT EXISTS `notaxproducto` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nota_id` int(11) DEFAULT NULL,
  `producto_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_notaxproducto_1_idx` (`nota_id`) USING BTREE,
  KEY `fk_notaxproducto_2_idx` (`producto_id`) USING BTREE
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=261 ;

--
-- Volcado de datos para la tabla `notaxproducto`
--

INSERT INTO `notaxproducto` (`id`, `nota_id`, `producto_id`, `created_at`, `updated_at`) VALUES
(1, 1, 30, NULL, NULL),
(2, 1, 31, NULL, NULL),
(3, 1, 32, NULL, NULL),
(4, 1, 33, NULL, NULL),
(5, 1, 34, NULL, NULL),
(6, 1, 35, NULL, NULL),
(7, 1, 36, NULL, NULL),
(8, 1, 37, NULL, NULL),
(9, 1, 38, NULL, NULL),
(10, 1, 39, NULL, NULL),
(11, 1, 40, NULL, NULL),
(12, 1, 41, NULL, NULL),
(13, 1, 42, NULL, NULL),
(14, 1, 43, NULL, NULL),
(15, 1, 44, NULL, NULL),
(16, 1, 45, NULL, NULL),
(17, 1, 46, NULL, NULL),
(18, 1, 47, NULL, NULL),
(19, 1, 48, NULL, NULL),
(20, 1, 49, NULL, NULL),
(21, 1, 50, NULL, NULL),
(22, 1, 51, NULL, NULL),
(23, 1, 52, NULL, NULL),
(24, 1, 53, NULL, NULL),
(25, 1, 54, NULL, NULL),
(26, 1, 55, NULL, NULL),
(27, 1, 56, NULL, NULL),
(28, 1, 57, NULL, NULL),
(29, 1, 58, NULL, NULL),
(30, 1, 59, NULL, NULL),
(31, 1, 60, NULL, NULL),
(32, 1, 61, NULL, NULL),
(33, 1, 90, NULL, NULL),
(34, 1, 91, NULL, NULL),
(35, 1, 92, NULL, NULL),
(36, 1, 93, NULL, NULL),
(37, 1, 94, NULL, NULL),
(38, 1, 123, NULL, NULL),
(39, 1, 124, NULL, NULL),
(40, 1, 125, NULL, NULL),
(41, 1, 126, NULL, NULL),
(42, 1, 127, NULL, NULL),
(43, 1, 128, NULL, NULL),
(44, 1, 129, NULL, NULL),
(45, 1, 130, NULL, NULL),
(46, 1, 131, NULL, NULL),
(47, 1, 132, NULL, NULL),
(48, 1, 133, NULL, NULL),
(49, 1, 134, NULL, NULL),
(50, 1, 135, NULL, NULL),
(51, 1, 136, NULL, NULL),
(52, 1, 137, NULL, NULL),
(53, 1, 138, NULL, NULL),
(54, 1, 139, NULL, NULL),
(55, 1, 140, NULL, NULL),
(56, 1, 141, NULL, NULL),
(57, 1, 142, NULL, NULL),
(58, 1, 143, NULL, NULL),
(59, 1, 144, NULL, NULL),
(60, 1, 145, NULL, NULL),
(61, 1, 146, NULL, NULL),
(62, 1, 147, NULL, NULL),
(63, 1, 148, NULL, NULL),
(64, 1, 149, NULL, NULL),
(65, 1, 150, NULL, NULL),
(66, 1, 151, NULL, NULL),
(67, 1, 152, NULL, NULL),
(68, 1, 153, NULL, NULL),
(69, 1, 154, NULL, NULL),
(70, 1, 155, NULL, NULL),
(71, 1, 156, NULL, NULL),
(72, 1, 157, NULL, NULL),
(73, 1, 158, NULL, NULL),
(74, 1, 159, NULL, NULL),
(75, 1, 160, NULL, NULL),
(76, 1, 161, NULL, NULL),
(77, 1, 162, NULL, NULL),
(78, 1, 163, NULL, NULL),
(79, 1, 173, NULL, NULL),
(80, 1, 174, NULL, NULL),
(81, 1, 175, NULL, NULL),
(82, 1, 176, NULL, NULL),
(83, 1, 177, NULL, NULL),
(84, 1, 178, NULL, NULL),
(85, 1, 179, NULL, NULL),
(86, 1, 180, NULL, NULL),
(87, 1, 181, NULL, NULL),
(88, 1, 182, NULL, NULL),
(89, 1, 183, NULL, NULL),
(90, 1, 184, NULL, NULL),
(91, 1, 185, NULL, NULL),
(92, 1, 186, NULL, NULL),
(93, 1, 187, NULL, NULL),
(94, 1, 188, NULL, NULL),
(95, 1, 189, NULL, NULL),
(96, 1, 190, NULL, NULL),
(97, 1, 191, NULL, NULL),
(98, 1, 192, NULL, NULL),
(99, 1, 193, NULL, NULL),
(100, 1, 194, NULL, NULL),
(101, 1, 195, NULL, NULL),
(102, 2, 1, NULL, NULL),
(103, 2, 2, NULL, NULL),
(104, 2, 3, NULL, NULL),
(105, 2, 4, NULL, NULL),
(106, 2, 5, NULL, NULL),
(107, 2, 6, NULL, NULL),
(108, 2, 7, NULL, NULL),
(109, 2, 8, NULL, NULL),
(110, 2, 9, NULL, NULL),
(111, 2, 10, NULL, NULL),
(112, 2, 11, NULL, NULL),
(113, 2, 12, NULL, NULL),
(114, 2, 13, NULL, NULL),
(115, 2, 14, NULL, NULL),
(116, 2, 15, NULL, NULL),
(117, 2, 16, NULL, NULL),
(118, 2, 30, NULL, NULL),
(119, 2, 31, NULL, NULL),
(120, 2, 32, NULL, NULL),
(121, 2, 33, NULL, NULL),
(122, 2, 34, NULL, NULL),
(123, 2, 35, NULL, NULL),
(124, 2, 36, NULL, NULL),
(125, 2, 37, NULL, NULL),
(126, 2, 38, NULL, NULL),
(127, 2, 39, NULL, NULL),
(128, 2, 40, NULL, NULL),
(129, 2, 41, NULL, NULL),
(130, 2, 42, NULL, NULL),
(131, 2, 43, NULL, NULL),
(132, 2, 44, NULL, NULL),
(133, 2, 45, NULL, NULL),
(134, 2, 77, NULL, NULL),
(135, 2, 78, NULL, NULL),
(136, 2, 79, NULL, NULL),
(137, 2, 80, NULL, NULL),
(138, 2, 81, NULL, NULL),
(139, 2, 82, NULL, NULL),
(140, 2, 83, NULL, NULL),
(141, 2, 84, NULL, NULL),
(142, 2, 85, NULL, NULL),
(143, 2, 86, NULL, NULL),
(144, 2, 95, NULL, NULL),
(145, 2, 96, NULL, NULL),
(146, 2, 97, NULL, NULL),
(147, 2, 98, NULL, NULL),
(148, 2, 99, NULL, NULL),
(149, 2, 100, NULL, NULL),
(150, 2, 101, NULL, NULL),
(151, 2, 102, NULL, NULL),
(152, 2, 103, NULL, NULL),
(153, 2, 104, NULL, NULL),
(154, 2, 105, NULL, NULL),
(155, 2, 106, NULL, NULL),
(156, 2, 87, NULL, NULL),
(157, 2, 88, NULL, NULL),
(158, 2, 89, NULL, NULL),
(159, 3, 1, NULL, NULL),
(160, 3, 2, NULL, NULL),
(161, 3, 3, NULL, NULL),
(162, 3, 4, NULL, NULL),
(163, 3, 5, NULL, NULL),
(164, 3, 6, NULL, NULL),
(165, 3, 7, NULL, NULL),
(166, 3, 8, NULL, NULL),
(167, 3, 9, NULL, NULL),
(168, 3, 10, NULL, NULL),
(169, 3, 11, NULL, NULL),
(170, 3, 12, NULL, NULL),
(171, 3, 13, NULL, NULL),
(172, 3, 14, NULL, NULL),
(173, 3, 15, NULL, NULL),
(174, 3, 16, NULL, NULL),
(175, 3, 17, NULL, NULL),
(176, 3, 18, NULL, NULL),
(177, 3, 19, NULL, NULL),
(178, 3, 20, NULL, NULL),
(179, 3, 21, NULL, NULL),
(180, 3, 22, NULL, NULL),
(181, 3, 23, NULL, NULL),
(182, 3, 24, NULL, NULL),
(183, 3, 25, NULL, NULL),
(184, 3, 26, NULL, NULL),
(185, 3, 27, NULL, NULL),
(186, 3, 28, NULL, NULL),
(187, 3, 29, NULL, NULL),
(188, 3, 30, NULL, NULL),
(189, 3, 31, NULL, NULL),
(190, 3, 32, NULL, NULL),
(191, 3, 33, NULL, NULL),
(192, 3, 34, NULL, NULL),
(193, 3, 35, NULL, NULL),
(194, 3, 36, NULL, NULL),
(195, 3, 37, NULL, NULL),
(196, 3, 38, NULL, NULL),
(197, 3, 39, NULL, NULL),
(198, 3, 40, NULL, NULL),
(199, 3, 41, NULL, NULL),
(200, 3, 42, NULL, NULL),
(201, 3, 43, NULL, NULL),
(202, 3, 44, NULL, NULL),
(203, 3, 45, NULL, NULL),
(204, 3, 62, NULL, NULL),
(205, 3, 63, NULL, NULL),
(206, 3, 64, NULL, NULL),
(207, 3, 65, NULL, NULL),
(208, 3, 66, NULL, NULL),
(209, 3, 67, NULL, NULL),
(210, 3, 68, NULL, NULL),
(211, 3, 69, NULL, NULL),
(212, 3, 70, NULL, NULL),
(213, 3, 71, NULL, NULL),
(214, 3, 72, NULL, NULL),
(215, 3, 73, NULL, NULL),
(216, 3, 74, NULL, NULL),
(217, 3, 75, NULL, NULL),
(218, 3, 76, NULL, NULL),
(219, 3, 77, NULL, NULL),
(220, 3, 78, NULL, NULL),
(221, 3, 79, NULL, NULL),
(222, 3, 80, NULL, NULL),
(223, 3, 81, NULL, NULL),
(224, 3, 82, NULL, NULL),
(225, 3, 83, NULL, NULL),
(226, 3, 84, NULL, NULL),
(227, 3, 85, NULL, NULL),
(228, 3, 86, NULL, NULL),
(229, 3, 95, NULL, NULL),
(230, 3, 96, NULL, NULL),
(231, 3, 97, NULL, NULL),
(232, 3, 98, NULL, NULL),
(233, 3, 99, NULL, NULL),
(234, 3, 100, NULL, NULL),
(235, 3, 101, NULL, NULL),
(236, 3, 102, NULL, NULL),
(237, 3, 103, NULL, NULL),
(238, 3, 104, NULL, NULL),
(239, 3, 105, NULL, NULL),
(240, 3, 106, NULL, NULL),
(241, 3, 107, NULL, NULL),
(242, 3, 108, NULL, NULL),
(243, 3, 109, NULL, NULL),
(244, 3, 110, NULL, NULL),
(245, 3, 111, NULL, NULL),
(246, 3, 112, NULL, NULL),
(247, 3, 113, NULL, NULL),
(248, 3, 114, NULL, NULL),
(249, 3, 115, NULL, NULL),
(250, 3, 116, NULL, NULL),
(251, 3, 117, NULL, NULL),
(252, 3, 118, NULL, NULL),
(253, 3, 119, NULL, NULL),
(254, 3, 120, NULL, NULL),
(255, 3, 121, NULL, NULL),
(256, 3, 122, NULL, NULL),
(257, 1, 199, NULL, NULL),
(258, 1, 200, NULL, NULL),
(259, 1, 196, NULL, NULL),
(260, 1, 197, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedido`
--

CREATE TABLE IF NOT EXISTS `pedido` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fechaInicio` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `fechaCancelacion` timestamp NULL DEFAULT NULL,
  `numeroComensales` int(11) DEFAULT NULL,
  `estado` char(1) DEFAULT NULL,
  `importeFinal` decimal(10,2) DEFAULT NULL COMMENT 'el total de cuento se pago con todo y descuento incluido.',
  `descuento` double(22,0) DEFAULT NULL COMMENT 'es en porcentaje.. 0 a 1.. Si se sabe cuanto bajarle.. se pondrá el monto y se calculará el % q refleja.\n\nEste descuento es aplicado al importe total de venta.',
  `usuario_id` int(10) unsigned DEFAULT NULL COMMENT 'id de persona mozo x ejemplo',
  `cliente_id` int(11) DEFAULT NULL COMMENT 'id de cliente',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_Pedido_Persona1_idx` (`usuario_id`) USING BTREE,
  KEY `fk_Pedido_Persona2_idx` (`cliente_id`) USING BTREE
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=44 ;

--
-- Volcado de datos para la tabla `pedido`
--

INSERT INTO `pedido` (`id`, `fechaInicio`, `fechaCancelacion`, `numeroComensales`, `estado`, `importeFinal`, `descuento`, `usuario_id`, `cliente_id`, `created_at`, `updated_at`) VALUES
(1, '2014-04-26 23:48:03', NULL, NULL, 'T', 52.30, 0, 7, NULL, '2014-04-26 23:48:03', '2014-04-30 05:12:06'),
(2, '2014-04-28 15:37:17', NULL, NULL, 'T', 127.80, 0, 7, NULL, '2014-04-28 15:37:17', '2014-04-30 05:11:52'),
(3, '2014-04-28 17:15:48', NULL, NULL, 'T', 35.20, 0, 1, NULL, '2014-04-28 17:15:48', '2014-04-30 05:12:25'),
(4, '2014-04-29 23:13:16', NULL, NULL, 'T', 88.90, 0, 1, NULL, '2014-04-29 23:13:16', '2014-05-02 04:01:04'),
(5, '2014-04-30 05:32:47', NULL, NULL, 'T', 125.20, 0, 1, NULL, '2014-04-30 05:32:47', '2014-05-02 04:03:29'),
(6, '2014-05-02 04:03:51', NULL, NULL, 'T', 47.10, 0, 8, NULL, '2014-05-02 04:03:51', '2014-05-02 04:04:41'),
(7, '2014-05-02 04:06:32', NULL, NULL, 'T', 47.10, 0, 7, NULL, '2014-05-02 04:06:32', '2014-05-02 07:57:27'),
(8, '2014-05-02 04:08:42', NULL, NULL, 'T', 47.10, 0, 8, NULL, '2014-05-02 04:08:42', '2014-05-02 07:57:31'),
(9, '2014-05-02 04:14:01', NULL, NULL, 'T', 35.50, 0, 8, NULL, '2014-05-02 04:14:01', '2014-05-02 07:57:34'),
(10, '2014-05-02 04:15:34', NULL, NULL, 'T', 35.50, 0, 8, NULL, '2014-05-02 04:15:34', '2014-05-02 07:57:37'),
(11, '2014-05-02 04:19:49', NULL, NULL, 'T', 35.50, 0, 8, NULL, '2014-05-02 04:19:49', '2014-05-02 07:58:15'),
(12, '2014-05-02 04:30:16', NULL, NULL, 'T', 35.50, 0, 8, NULL, '2014-05-02 04:30:16', '2014-05-02 07:58:22'),
(13, '2014-05-02 04:31:00', NULL, NULL, 'T', 35.50, 0, 7, NULL, '2014-05-02 04:31:00', '2014-05-02 07:58:30'),
(14, '2014-05-02 04:51:48', NULL, NULL, 'T', 35.50, 0, 7, NULL, '2014-05-02 04:51:48', '2014-05-02 07:58:35'),
(15, '2014-05-02 04:53:06', NULL, NULL, 'T', 51.30, 0, 7, NULL, '2014-05-02 04:53:06', '2014-05-02 07:58:39'),
(16, '2014-05-02 04:56:43', NULL, NULL, 'T', 35.50, 0, 8, NULL, '2014-05-02 04:56:43', '2014-05-02 07:58:43'),
(17, '2014-05-02 06:07:06', NULL, NULL, 'I', NULL, NULL, 8, NULL, '2014-05-02 06:07:06', '2014-05-02 06:07:06'),
(18, '2014-05-02 06:09:51', NULL, NULL, 'I', NULL, NULL, 8, NULL, '2014-05-02 06:09:51', '2014-05-02 06:09:51'),
(19, '2014-05-02 06:15:02', NULL, NULL, 'I', NULL, NULL, 8, NULL, '2014-05-02 06:15:02', '2014-05-02 06:15:02'),
(20, '2014-05-02 06:17:44', NULL, NULL, 'I', NULL, NULL, 8, NULL, '2014-05-02 06:17:44', '2014-05-02 06:17:44'),
(21, '2014-05-02 06:23:24', NULL, NULL, 'I', NULL, NULL, 8, NULL, '2014-05-02 06:23:24', '2014-05-02 06:23:24'),
(22, '2014-05-02 06:24:35', NULL, NULL, 'I', NULL, NULL, 8, NULL, '2014-05-02 06:24:35', '2014-05-02 06:24:35'),
(23, '2014-05-02 06:26:20', NULL, NULL, 'I', NULL, NULL, 7, NULL, '2014-05-02 06:26:20', '2014-05-02 06:26:20'),
(24, '2014-05-02 06:27:28', NULL, NULL, 'I', NULL, NULL, 6, NULL, '2014-05-02 06:27:28', '2014-05-02 06:27:28'),
(25, '2014-05-02 06:29:03', NULL, NULL, 'I', NULL, NULL, 4, NULL, '2014-05-02 06:29:03', '2014-05-02 06:29:03'),
(26, '2014-05-02 06:30:47', NULL, NULL, 'I', NULL, NULL, 6, NULL, '2014-05-02 06:30:47', '2014-05-02 06:30:47'),
(27, '2014-05-02 06:33:51', NULL, NULL, 'I', NULL, NULL, 5, NULL, '2014-05-02 06:33:51', '2014-05-02 06:33:51'),
(28, '2014-05-02 06:37:31', NULL, NULL, 'I', NULL, NULL, 1, NULL, '2014-05-02 06:37:31', '2014-05-02 06:37:31'),
(29, '2014-05-02 06:48:02', NULL, NULL, 'I', NULL, NULL, 1, NULL, '2014-05-02 06:48:01', '2014-05-02 06:48:01'),
(30, '2014-05-02 06:54:12', NULL, NULL, 'I', NULL, NULL, 8, NULL, '2014-05-02 06:54:12', '2014-05-02 06:54:12'),
(31, '2014-05-02 06:54:40', NULL, NULL, 'I', NULL, NULL, 8, NULL, '2014-05-02 06:54:40', '2014-05-02 06:54:40'),
(32, '2014-05-02 17:30:20', NULL, NULL, 'I', NULL, NULL, 5, NULL, '2014-05-02 17:30:20', '2014-05-02 17:30:20'),
(33, '2014-05-02 17:55:40', NULL, NULL, 'T', 164.20, 0, 5, NULL, '2014-05-02 17:55:40', '2014-05-05 08:20:19'),
(34, '2014-05-02 18:00:50', NULL, NULL, 'I', NULL, NULL, 1, NULL, '2014-05-02 18:00:50', '2014-05-02 18:00:50'),
(35, '2014-05-02 18:02:23', NULL, NULL, 'I', NULL, NULL, 1, NULL, '2014-05-02 18:02:23', '2014-05-02 18:02:23'),
(36, '2014-05-02 18:02:46', NULL, NULL, 'I', NULL, NULL, 1, NULL, '2014-05-02 18:02:46', '2014-05-02 18:02:46'),
(37, '2014-05-02 18:03:39', NULL, NULL, 'I', NULL, NULL, 1, NULL, '2014-05-02 18:03:39', '2014-05-02 18:03:39'),
(38, '2014-05-02 18:03:53', NULL, NULL, 'I', NULL, NULL, 1, NULL, '2014-05-02 18:03:53', '2014-05-02 18:03:53'),
(39, '2014-05-02 18:05:28', NULL, NULL, 'I', NULL, NULL, 1, NULL, '2014-05-02 18:05:28', '2014-05-02 18:05:28'),
(40, '2014-05-02 19:02:20', NULL, NULL, 'I', NULL, NULL, 8, NULL, '2014-05-02 19:02:20', '2014-05-02 19:02:20'),
(41, '2014-05-03 00:45:32', NULL, NULL, 'I', NULL, NULL, 8, NULL, '2014-05-03 00:45:32', '2014-05-03 00:45:32'),
(42, '2014-05-03 18:42:44', NULL, NULL, 'I', NULL, NULL, 7, NULL, '2014-05-03 18:42:44', '2014-05-03 18:42:44'),
(43, '2014-05-05 08:21:05', NULL, NULL, 'I', NULL, NULL, 5, NULL, '2014-05-05 08:21:05', '2014-05-05 08:21:05');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidocompra`
--

CREATE TABLE IF NOT EXISTS `pedidocompra` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'si se compra un producto final se va al insumo tb\nsi se compra un insumo se queda ahi',
  `fecha` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `proveedor_id` int(11) DEFAULT NULL COMMENT 'de tal proveedor',
  `importeFinal` decimal(10,2) DEFAULT NULL,
  `descuentofinal` decimal(10,2) NOT NULL,
  `usuario_id` int(11) DEFAULT NULL COMMENT 'creado por tal usuario',
  `estado` tinyint(1) DEFAULT NULL COMMENT '0 --> anulado\n1 --> habilitado',
  `id_documento` int(11) NOT NULL,
  `tipo_orden` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_Ingreso_Persona1_idx` (`proveedor_id`) USING BTREE,
  KEY `fk_Ingreso_Persona2_idx` (`usuario_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `perfil`
--

CREATE TABLE IF NOT EXISTS `perfil` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) DEFAULT NULL,
  `descripcion` text,
  `selector` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Volcado de datos para la tabla `perfil`
--

INSERT INTO `perfil` (`id`, `nombre`, `descripcion`, `selector`, `created_at`, `updated_at`) VALUES
(1, 'Administrador', 'Administrador', 1, '2014-04-01 00:19:18', '2014-04-01 00:19:18'),
(2, 'Mozo', 'Mozo', 1, '2014-04-01 00:19:27', '2014-04-01 00:19:27'),
(3, 'Cocina', 'Cocina', 1, '2014-04-01 00:19:56', '2014-04-01 00:19:56'),
(4, 'Caja', 'Caja', 1, '2014-04-01 00:20:05', '2014-04-01 00:20:05'),
(5, 'Empresa Cliente', 'Empresa Cliente', 2, '2014-04-24 22:34:12', '2014-04-24 22:34:12');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permisos`
--

CREATE TABLE IF NOT EXISTS `permisos` (
  `id_perfil` int(11) DEFAULT NULL,
  `id_modulo` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  KEY `fk_id_modulo_idx` (`id_modulo`) USING BTREE,
  KEY `fk_id_perfil_idx` (`id_perfil`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `persona`
--

CREATE TABLE IF NOT EXISTS `persona` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombres` varchar(100) DEFAULT NULL,
  `razonSocial` varchar(200) DEFAULT NULL,
  `apPaterno` varchar(100) DEFAULT NULL,
  `apMaterno` varchar(100) DEFAULT NULL,
  `dni` varchar(8) DEFAULT NULL,
  `ruc` varchar(11) DEFAULT NULL,
  `direccion` varchar(200) DEFAULT NULL,
  `pais` varchar(50) DEFAULT NULL,
  `departamento` varchar(255) DEFAULT NULL,
  `provincia` varchar(50) DEFAULT NULL,
  `distrito` varchar(50) DEFAULT NULL,
  `tel` varchar(100) DEFAULT NULL,
  `cel` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `comentarios` text,
  `habilitado` tinyint(1) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `perfil_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_Persona_Perfil1_idx` (`perfil_id`) USING BTREE
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=25 ;

--
-- Volcado de datos para la tabla `persona`
--

INSERT INTO `persona` (`id`, `nombres`, `razonSocial`, `apPaterno`, `apMaterno`, `dni`, `ruc`, `direccion`, `pais`, `departamento`, `provincia`, `distrito`, `tel`, `cel`, `email`, `comentarios`, `habilitado`, `created_at`, `updated_at`, `perfil_id`) VALUES
(2, 'Mozo', NULL, 'Mozo', 'Mozo', '12345678', NULL, 'elias aguirre', 'Perú', '', '', '', '252711', '9826048940', 'ivancalvay@hotmail.com', NULL, 1, '2014-04-01 00:21:35', '2014-04-01 00:21:41', 2),
(3, 'Cocina', NULL, 'Cocina', 'Cocina', '12345678', NULL, 'elias aguirre', 'Perú', '', '', '', '252711', '9826048940', 'ivancalvay@hotmail.com', NULL, 1, '2014-04-01 00:22:22', '2014-04-01 00:22:22', 3),
(4, 'Barra', NULL, 'Barra', 'Barra', '12345678', NULL, 'elias aguirre', 'Perú', '', '', '', '252711', '', '', NULL, 1, '2014-04-01 00:22:45', '2014-04-01 00:22:45', 3),
(5, 'Mozo2', NULL, 'Mozo2', 'Mozo2', '12345678', NULL, 'elias aguirre', 'Perú', '', '', '', '252711', '9826048940', 'ivancalvay@hotmail.com', NULL, 1, '2014-04-01 01:14:21', '2014-04-01 01:14:21', 2),
(6, 'Mozo1', NULL, 'Mozo1', 'Mozo1', '', NULL, '', '', '', '', '', '', '', '', NULL, 1, '2014-04-02 16:03:49', '2014-04-02 16:03:49', 2),
(7, 'Mozo3', NULL, 'Mozo3', 'Mozo3', '', NULL, '', '', '', '', '', '', '', '', NULL, 1, '2014-04-02 16:04:15', '2014-04-02 16:04:15', 2),
(9, 'Mozo4', NULL, 'Mozo4', 'Mozo4', '', NULL, '', '', '', '', '', '', '', '', NULL, 1, '2014-04-02 16:04:54', '2014-04-02 16:04:54', 2),
(10, 'Mozo5', NULL, 'Mozo5', 'Mozo5', '', '', '', '', '', '', '', '', '', '', NULL, 1, '2014-04-02 16:05:23', '2014-04-02 16:05:23', 2),
(13, NULL, 'Empresa de Prueba', NULL, NULL, NULL, '20507803173', '', 'Perú', '', '', '', '', '', '', NULL, 1, '2014-04-24 22:35:21', '2014-04-24 22:35:21', 5),
(14, 'Ivan', NULL, 'Calvay', 'Requejo', '45934821', NULL, 'los rosales 181', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2014-04-25 06:54:29', '2014-04-25 06:54:29', NULL),
(15, NULL, 'Nueva Empresa', NULL, NULL, NULL, '20500678901', 'Elias aguire - chiclayo', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2014-04-25 06:56:12', '2014-04-25 06:56:12', NULL),
(16, 'Javier', NULL, 'Alvarez', 'Montenegro', '45934822', NULL, 'Bancarios', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2014-04-25 06:57:18', '2014-04-25 06:57:18', NULL),
(17, NULL, 'Empresa de Prueba', NULL, NULL, NULL, '23467890123', 'Elias Aguirre 4567', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2014-04-25 07:23:42', '2014-04-25 07:23:42', NULL),
(18, NULL, 'Eprueba 2', NULL, NULL, NULL, '23456789012', 'Balta 053 - chiclayo', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2014-04-25 07:29:35', '2014-04-25 07:29:35', NULL),
(19, 'Luis', NULL, 'Valencia', 'Sebastiani', '49678923', NULL, '7 de enero 123 - Chiclayo', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2014-04-25 07:32:01', '2014-04-25 07:32:01', NULL),
(20, 'Cliente', NULL, 'prueba', 'prueba', '34567821', NULL, 'balta 456 - chiclayo', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2014-04-25 07:34:49', '2014-04-25 07:34:49', NULL),
(21, NULL, 'Company prueba', NULL, NULL, NULL, '09876543219', 'Sanjo 567 - Chiclayo', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2014-04-25 07:40:42', '2014-04-25 07:40:42', NULL),
(22, NULL, 'L&N prueba', NULL, NULL, NULL, '98765432190', 'Izaga 980 - Chiclayo', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2014-04-25 07:42:11', '2014-04-25 07:42:11', NULL),
(23, NULL, 'Proabando Empresa', NULL, NULL, NULL, '78965431237', 'Elias aguiree  - chiclayo', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2014-04-28 14:41:17', '2014-04-28 14:41:17', NULL),
(24, NULL, 'Carloz Perez', NULL, NULL, NULL, '45678912345', 'Balta 1456 Chiclayo', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2014-05-03 00:49:26', '2014-05-03 00:49:26', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `precio`
--

CREATE TABLE IF NOT EXISTS `precio` (
  `producto_id` int(11) DEFAULT NULL,
  `combinacion_id` int(11) DEFAULT NULL,
  `precio` decimal(10,2) DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `seleccionador` int(11) DEFAULT NULL COMMENT '11,22,33,44... solo se selecciona 4 prod d los 8 disp donde no se repita un mismo valor',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`),
  KEY `fk_Precio_Combinacion1_idx` (`combinacion_id`) USING BTREE,
  KEY `fk_Precio_Producto1` (`producto_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=204 ;

--
-- Volcado de datos para la tabla `precio`
--

INSERT INTO `precio` (`producto_id`, `combinacion_id`, `precio`, `cantidad`, `seleccionador`, `created_at`, `updated_at`, `id`) VALUES
(1, 1, 2.90, NULL, NULL, NULL, NULL, 1),
(1, 2, 1.40, 1, NULL, '2014-04-02 05:00:00', '2014-04-02 05:00:00', 2),
(2, 1, 5.90, NULL, NULL, NULL, NULL, 3),
(3, 1, 3.50, NULL, NULL, NULL, NULL, 4),
(4, 1, 3.50, NULL, NULL, NULL, NULL, 5),
(5, 1, 2.50, NULL, NULL, NULL, NULL, 6),
(6, 1, 2.50, NULL, NULL, NULL, NULL, 7),
(7, 1, 12.90, NULL, NULL, NULL, NULL, 8),
(8, 1, 4.90, NULL, NULL, NULL, NULL, 9),
(9, 1, 10.00, NULL, NULL, NULL, NULL, 10),
(10, 1, 10.00, NULL, NULL, NULL, NULL, 11),
(11, 1, 12.90, NULL, NULL, NULL, NULL, 12),
(12, 1, 20.00, NULL, NULL, NULL, NULL, 13),
(13, 1, 14.90, NULL, NULL, NULL, NULL, 14),
(14, 1, 5.90, NULL, NULL, NULL, NULL, 15),
(15, 1, 6.90, NULL, NULL, NULL, NULL, 16),
(16, 1, 7.00, NULL, NULL, NULL, NULL, 17),
(17, 1, 6.90, NULL, NULL, NULL, NULL, 18),
(18, 1, 7.90, NULL, NULL, NULL, NULL, 19),
(19, 1, 6.90, NULL, NULL, NULL, NULL, 20),
(20, 1, 8.90, NULL, NULL, NULL, NULL, 21),
(21, 1, 3.90, NULL, NULL, NULL, NULL, 22),
(22, 1, 1.00, NULL, NULL, NULL, NULL, 23),
(23, 1, 6.90, NULL, NULL, NULL, NULL, 24),
(24, 1, 7.90, NULL, NULL, NULL, NULL, 25),
(25, 1, 4.90, NULL, NULL, NULL, NULL, 26),
(26, 1, 6.90, NULL, NULL, NULL, NULL, 27),
(27, 1, 7.90, NULL, NULL, NULL, NULL, 28),
(28, 1, 4.90, NULL, NULL, NULL, NULL, 29),
(29, 1, 7.90, NULL, NULL, NULL, NULL, 30),
(30, 1, 45.00, NULL, NULL, NULL, NULL, 31),
(31, 1, 45.00, NULL, NULL, NULL, NULL, 32),
(32, 1, 55.00, NULL, NULL, NULL, NULL, 33),
(33, 1, 55.00, NULL, NULL, NULL, NULL, 34),
(34, 1, 60.00, NULL, NULL, NULL, NULL, 35),
(35, 1, 55.00, NULL, NULL, NULL, NULL, 36),
(36, 1, 60.00, NULL, NULL, NULL, NULL, 37),
(37, 1, 25.00, NULL, NULL, NULL, NULL, 38),
(38, 1, 40.00, NULL, NULL, NULL, NULL, 39),
(39, 1, 55.00, NULL, NULL, NULL, NULL, 40),
(40, 1, 55.00, NULL, NULL, NULL, NULL, 41),
(41, 1, 80.00, NULL, NULL, NULL, NULL, 42),
(42, 1, 65.00, NULL, NULL, NULL, NULL, 43),
(43, 1, 60.00, NULL, NULL, NULL, NULL, 44),
(44, 1, 12.90, NULL, NULL, NULL, NULL, 45),
(45, 1, 7.00, NULL, NULL, NULL, NULL, 46),
(46, 1, 4.90, NULL, NULL, NULL, NULL, 47),
(47, 1, 3.50, NULL, NULL, NULL, NULL, 48),
(48, 1, 12.90, NULL, NULL, NULL, NULL, 49),
(49, 1, 12.90, NULL, NULL, NULL, NULL, 50),
(50, 1, 12.90, NULL, NULL, NULL, NULL, 51),
(51, 1, 6.90, NULL, NULL, NULL, NULL, 52),
(52, 1, 15.90, NULL, NULL, NULL, NULL, 53),
(53, 1, 2.50, NULL, NULL, NULL, NULL, 54),
(54, 1, 18.90, NULL, NULL, NULL, NULL, 55),
(55, 1, 16.90, NULL, NULL, NULL, NULL, 56),
(56, 1, 16.90, NULL, NULL, NULL, NULL, 57),
(57, 1, 16.90, NULL, NULL, NULL, NULL, 58),
(58, 1, 18.90, NULL, NULL, NULL, NULL, 59),
(59, 1, 18.90, NULL, NULL, NULL, NULL, 60),
(60, 1, 19.90, NULL, NULL, NULL, NULL, 61),
(61, 1, 19.90, NULL, NULL, NULL, NULL, 62),
(62, 1, 4.90, NULL, NULL, NULL, NULL, 63),
(63, 1, 6.90, NULL, NULL, NULL, NULL, 64),
(64, 1, 12.90, NULL, NULL, NULL, NULL, 65),
(65, 1, 12.90, NULL, NULL, NULL, NULL, 66),
(66, 1, 19.90, NULL, NULL, NULL, NULL, 67),
(67, 1, 12.90, NULL, NULL, NULL, NULL, 68),
(68, 1, 12.90, NULL, NULL, NULL, NULL, 69),
(69, 1, 7.90, NULL, NULL, NULL, NULL, 70),
(70, 1, 8.90, NULL, NULL, NULL, NULL, 71),
(71, 1, 8.90, NULL, NULL, NULL, NULL, 72),
(72, 1, 8.90, NULL, NULL, NULL, NULL, 73),
(73, 1, 12.90, NULL, NULL, NULL, NULL, 74),
(74, 1, 8.90, NULL, NULL, NULL, NULL, 75),
(75, 1, 13.90, NULL, NULL, NULL, NULL, 76),
(76, 1, 9.90, NULL, NULL, NULL, NULL, 77),
(77, 1, 7.90, NULL, NULL, NULL, NULL, 78),
(78, 1, 7.90, NULL, NULL, NULL, NULL, 79),
(79, 1, 7.90, NULL, NULL, NULL, NULL, 80),
(80, 1, 10.90, NULL, NULL, NULL, NULL, 81),
(81, 1, 10.90, NULL, NULL, NULL, NULL, 82),
(82, 1, 10.90, NULL, NULL, NULL, NULL, 83),
(83, 1, 10.90, NULL, NULL, NULL, NULL, 84),
(84, 1, 10.90, NULL, NULL, NULL, NULL, 85),
(85, 1, 10.90, NULL, NULL, NULL, NULL, 86),
(86, 1, 10.90, NULL, NULL, NULL, NULL, 87),
(87, 1, 10.90, NULL, NULL, NULL, NULL, 88),
(88, 1, 10.90, NULL, NULL, NULL, NULL, 89),
(89, 1, 10.90, NULL, NULL, NULL, NULL, 90),
(90, 1, 7.90, NULL, NULL, NULL, NULL, 91),
(91, 1, 7.90, NULL, NULL, NULL, NULL, 92),
(92, 1, 7.90, NULL, NULL, NULL, NULL, 93),
(93, 1, 7.90, NULL, NULL, NULL, NULL, 94),
(94, 1, 3.90, NULL, NULL, NULL, NULL, 95),
(95, 1, 5.90, NULL, NULL, NULL, NULL, 96),
(96, 1, 5.90, NULL, NULL, NULL, NULL, 97),
(97, 1, 5.90, NULL, NULL, NULL, NULL, 98),
(98, 1, 5.90, NULL, NULL, NULL, NULL, 99),
(99, 1, 5.90, NULL, NULL, NULL, NULL, 100),
(100, 1, 5.90, NULL, NULL, NULL, NULL, 101),
(101, 1, 5.90, NULL, NULL, NULL, NULL, 102),
(102, 1, 8.90, NULL, NULL, NULL, NULL, 103),
(103, 1, 15.90, NULL, NULL, NULL, NULL, 104),
(104, 1, 8.90, NULL, NULL, NULL, NULL, 105),
(105, 1, 5.90, NULL, NULL, NULL, NULL, 106),
(106, 1, 5.90, NULL, NULL, NULL, NULL, 107),
(107, 1, 10.90, NULL, NULL, NULL, NULL, 108),
(108, 1, 10.90, NULL, NULL, NULL, NULL, 109),
(109, 1, 8.90, NULL, NULL, NULL, NULL, 110),
(110, 1, 12.90, NULL, NULL, NULL, NULL, 111),
(111, 1, 4.90, NULL, NULL, NULL, NULL, 112),
(112, 1, 3.90, NULL, NULL, NULL, NULL, 113),
(113, 1, 4.90, NULL, NULL, NULL, NULL, 114),
(114, 1, 6.90, NULL, NULL, NULL, NULL, 115),
(115, 1, 5.90, NULL, NULL, NULL, NULL, 116),
(116, 1, 3.90, NULL, NULL, NULL, NULL, 117),
(117, 1, 5.90, NULL, NULL, NULL, NULL, 118),
(118, 1, 3.50, NULL, NULL, NULL, NULL, 119),
(119, 1, 3.50, NULL, NULL, NULL, NULL, 120),
(120, 1, 5.90, NULL, NULL, NULL, NULL, 121),
(121, 1, 3.50, NULL, NULL, NULL, NULL, 122),
(122, 1, 4.90, NULL, NULL, NULL, NULL, 123),
(123, 1, 10.90, NULL, NULL, NULL, NULL, 124),
(124, 1, 10.90, NULL, NULL, NULL, NULL, 125),
(125, 1, 10.90, NULL, NULL, NULL, NULL, 126),
(126, 1, 10.90, NULL, NULL, NULL, NULL, 127),
(127, 1, 12.90, NULL, NULL, NULL, NULL, 128),
(128, 1, 10.90, NULL, NULL, NULL, NULL, 129),
(129, 1, 10.90, NULL, NULL, NULL, NULL, 130),
(130, 1, 1.00, NULL, NULL, NULL, NULL, 131),
(131, 1, 1.00, NULL, NULL, NULL, NULL, 132),
(132, 1, 2.00, NULL, NULL, NULL, NULL, 133),
(133, 1, 3.90, NULL, NULL, NULL, NULL, 134),
(134, 1, 1.00, NULL, NULL, NULL, NULL, 135),
(135, 1, 2.00, NULL, NULL, NULL, NULL, 136),
(136, 1, 2.00, NULL, NULL, NULL, NULL, 137),
(137, 1, 2.00, NULL, NULL, NULL, NULL, 138),
(138, 1, 1.00, NULL, NULL, NULL, NULL, 139),
(139, 1, 6.90, NULL, NULL, NULL, NULL, 140),
(140, 1, 2.00, NULL, NULL, NULL, NULL, 141),
(141, 1, 3.50, NULL, NULL, NULL, NULL, 142),
(142, 1, 10.90, NULL, NULL, NULL, NULL, 143),
(143, 1, 11.90, NULL, NULL, NULL, NULL, 144),
(144, 1, 12.90, NULL, NULL, NULL, NULL, 145),
(145, 1, 12.90, NULL, NULL, NULL, NULL, 146),
(146, 1, 12.90, NULL, NULL, NULL, NULL, 147),
(147, 1, 15.90, NULL, NULL, NULL, NULL, 148),
(148, 1, 12.90, NULL, NULL, NULL, NULL, 149),
(149, 1, 13.90, NULL, NULL, NULL, NULL, 150),
(150, 1, 39.90, NULL, NULL, NULL, NULL, 151),
(151, 1, 42.90, NULL, NULL, NULL, NULL, 152),
(152, 1, 44.90, NULL, NULL, NULL, NULL, 153),
(153, 1, 44.90, NULL, NULL, NULL, NULL, 154),
(154, 1, 44.90, NULL, NULL, NULL, NULL, 155),
(155, 1, 44.90, NULL, NULL, NULL, NULL, 156),
(156, 1, 46.90, NULL, NULL, NULL, NULL, 157),
(157, 1, 7.90, NULL, NULL, NULL, NULL, 158),
(158, 1, 7.90, NULL, NULL, NULL, NULL, 159),
(159, 1, 8.90, NULL, NULL, NULL, NULL, 160),
(160, 1, 9.90, NULL, NULL, NULL, NULL, 161),
(161, 1, 6.90, NULL, NULL, NULL, NULL, 162),
(162, 1, 16.90, NULL, NULL, NULL, NULL, 163),
(163, 1, 8.90, NULL, NULL, NULL, NULL, 164),
(164, 1, 60.00, NULL, NULL, NULL, NULL, 165),
(165, 1, 60.00, NULL, NULL, NULL, NULL, 166),
(166, 1, 55.00, NULL, NULL, NULL, NULL, 167),
(167, 1, 65.00, NULL, NULL, NULL, NULL, 168),
(168, 1, 60.00, NULL, NULL, NULL, NULL, 169),
(169, 1, 60.00, NULL, NULL, NULL, NULL, 170),
(170, 1, 60.00, NULL, NULL, NULL, NULL, 171),
(171, 1, 60.00, NULL, NULL, NULL, NULL, 172),
(172, 1, 60.00, NULL, NULL, NULL, NULL, 173),
(173, 1, 35.00, NULL, NULL, NULL, NULL, 174),
(174, 1, 13.00, NULL, NULL, NULL, NULL, 175),
(175, 1, 16.00, NULL, NULL, NULL, NULL, 176),
(176, 1, 19.00, NULL, NULL, NULL, NULL, 177),
(177, 1, 20.00, NULL, NULL, NULL, NULL, 178),
(178, 1, 28.00, NULL, NULL, NULL, NULL, 179),
(179, 1, 10.00, NULL, NULL, NULL, NULL, 180),
(180, 1, 15.00, NULL, NULL, NULL, NULL, 181),
(181, 1, 13.00, NULL, NULL, NULL, NULL, 182),
(182, 1, 30.00, NULL, NULL, NULL, NULL, 183),
(183, 1, 15.00, NULL, NULL, NULL, NULL, 184),
(184, 1, 4.00, NULL, NULL, NULL, NULL, 185),
(185, 1, 17.00, NULL, NULL, NULL, NULL, 186),
(186, 1, 10.90, NULL, NULL, NULL, NULL, 187),
(187, 1, 11.90, NULL, NULL, NULL, NULL, 188),
(188, 1, 12.90, NULL, NULL, NULL, NULL, 189),
(189, 1, 12.90, NULL, NULL, NULL, NULL, 190),
(190, 1, 1.50, NULL, NULL, NULL, NULL, 191),
(191, 1, 11.90, NULL, NULL, NULL, NULL, 192),
(192, 1, 11.90, NULL, NULL, NULL, NULL, 193),
(193, 1, 11.90, NULL, NULL, NULL, NULL, 194),
(194, 1, 11.90, NULL, NULL, NULL, NULL, 195),
(195, 1, 11.90, NULL, NULL, NULL, NULL, 196),
(196, 2, 4.90, 1, NULL, '2014-04-02 05:00:00', '2014-04-02 05:00:00', 197),
(196, 3, 4.90, 1, NULL, NULL, NULL, 198),
(197, 2, 4.90, 1, NULL, '2014-04-02 05:00:00', '2014-04-02 05:00:00', 199),
(198, 2, 1.60, 1, NULL, '2014-04-02 05:00:00', '2014-04-02 05:00:00', 200),
(199, 2, 2.00, 1, NULL, '2014-04-02 05:00:00', '2014-04-02 05:00:00', 201),
(200, 2, 2.00, 1, NULL, '2014-04-02 05:00:00', '2014-04-02 05:00:00', 202),
(200, 3, 2.00, 2, NULL, NULL, NULL, 203);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE IF NOT EXISTS `producto` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(300) DEFAULT NULL,
  `familia_id` int(11) DEFAULT NULL,
  `descripcion` text,
  `estado` tinyint(1) DEFAULT NULL COMMENT '0 --> des-habilitado\n1 --> habilitado',
  `favorito` tinyint(1) DEFAULT NULL COMMENT '0 --> No\n1 --> Si',
  `unidadMedida` varchar(45) DEFAULT NULL COMMENT 'unidades..\n',
  `imagen` text,
  `stock` decimal(10,2) DEFAULT NULL,
  `stockMin` decimal(10,2) DEFAULT NULL,
  `stockMax` decimal(10,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `selector_adicional` int(11) DEFAULT NULL COMMENT 'para ver si un producto tiene adicionales o no.',
  `lista_prod` text COMMENT 'guarda lista de prod adicionales',
  `cantidadsabores` int(11) DEFAULT NULL COMMENT 'helado doble.. selector_eleccion-->2',
  `id_tipoarepro` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_Producto_1` (`id_tipoarepro`) USING BTREE,
  KEY `fk_Producto_Familia1_idx` (`familia_id`) USING BTREE
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=201 ;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`id`, `nombre`, `familia_id`, `descripcion`, `estado`, `favorito`, `unidadMedida`, `imagen`, `stock`, `stockMin`, `stockMax`, `created_at`, `updated_at`, `selector_adicional`, `lista_prod`, `cantidadsabores`, `id_tipoarepro`) VALUES
(1, 'Chicha Morada', 1, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, '2014-03-31 21:39:08', '2014-03-31 21:39:08', NULL, NULL, NULL, 3),
(2, 'Limonada Frozen', 1, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, '2014-03-31 21:39:08', '2014-03-31 21:39:08', NULL, NULL, NULL, 3),
(3, 'Coca Cola', 1, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, '2014-03-31 21:39:08', '2014-03-31 21:39:08', NULL, NULL, NULL, 3),
(4, 'Inca Kola', 1, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, '2014-03-31 21:39:08', '2014-03-31 21:39:08', NULL, NULL, NULL, 3),
(5, 'Agua S/Gas', 1, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, '2014-03-31 21:39:08', '2014-03-31 21:39:08', NULL, NULL, NULL, 3),
(6, 'Agua C/Gas', 1, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, '2014-03-31 21:39:09', '2014-03-31 21:39:09', NULL, NULL, NULL, 3),
(7, 'Pisco Sour', 1, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, '2014-03-31 21:39:09', '2014-03-31 21:39:09', NULL, NULL, NULL, 3),
(8, 'Cafe Con Leche', 1, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, '2014-03-31 21:39:09', '2014-03-31 21:39:09', NULL, NULL, NULL, 3),
(9, 'Jarra De Chicha', 1, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, '2014-03-31 21:39:09', '2014-03-31 21:39:09', NULL, NULL, NULL, 3),
(10, 'Jarra De Limonada', 1, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, '2014-03-31 21:39:09', '2014-03-31 21:39:09', NULL, NULL, NULL, 3),
(11, 'Jarra Limo Frozen', 1, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, '2014-03-31 21:39:09', '2014-03-31 21:39:09', NULL, NULL, NULL, 3),
(12, 'Jarra De Sangria', 1, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, '2014-03-31 21:39:09', '2014-03-31 21:39:09', NULL, NULL, NULL, 3),
(13, 'Jarra Chicha Frozen', 1, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, '2014-03-31 21:39:09', '2014-03-31 21:39:09', NULL, NULL, NULL, 3),
(14, 'Te Helado Con Limon', 1, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, '2014-03-31 21:39:09', '2014-03-31 21:39:09', NULL, NULL, NULL, 3),
(15, 'Cremoladas', 1, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, '2014-03-31 21:39:09', '2014-03-31 21:39:09', NULL, NULL, NULL, 3),
(16, 'Cerveza Personal', 1, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, '2014-03-31 21:39:09', '2014-03-31 21:39:09', NULL, NULL, NULL, 3),
(17, '3 Leches', 2, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, '2014-03-31 21:46:48', '2014-03-31 21:46:48', NULL, NULL, NULL, 3),
(18, 'Cheesecake', 2, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, '2014-03-31 21:46:48', '2014-03-31 21:46:48', NULL, NULL, NULL, 3),
(19, 'Sacher', 2, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, '2014-03-31 21:46:49', '2014-03-31 21:46:49', NULL, NULL, NULL, 3),
(20, 'Brownie c/Helado', 2, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, '2014-03-31 21:46:49', '2014-03-31 21:46:49', NULL, NULL, NULL, 3),
(21, 'Muffins', 2, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, '2014-03-31 21:46:49', '2014-03-31 21:46:49', NULL, NULL, NULL, 3),
(22, 'Muffin Krasher', 2, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, '2014-03-31 21:46:49', '2014-03-31 21:46:49', NULL, NULL, NULL, 3),
(23, 'Torta De Chocolate', 2, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, '2014-03-31 21:46:49', '2014-03-31 21:46:49', NULL, NULL, NULL, 3),
(24, 'Turron De Chocolate', 2, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, '2014-03-31 21:46:49', '2014-03-31 21:46:49', NULL, NULL, NULL, 3),
(25, 'Tartaleta', 2, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, '2014-03-31 21:46:49', '2014-03-31 21:46:49', NULL, NULL, NULL, 3),
(26, 'Torta Hindù', 2, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, '2014-03-31 21:46:49', '2014-03-31 21:46:49', NULL, NULL, NULL, 3),
(27, 'Soufle De Fresa', 2, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, '2014-03-31 21:46:49', '2014-03-31 21:46:49', NULL, NULL, NULL, 3),
(28, 'Crocante De Manzana', 2, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, '2014-03-31 21:46:49', '2014-03-31 21:46:49', NULL, NULL, NULL, 3),
(29, 'Tiramisu', 2, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, '2014-03-31 21:46:49', '2014-03-31 21:46:49', NULL, NULL, NULL, 3),
(30, 'Selva Negra', 3, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, '2014-03-31 21:51:37', '2014-03-31 21:51:37', NULL, NULL, NULL, 3),
(31, 'Souffle Entero', 3, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, '2014-03-31 21:51:37', '2014-03-31 21:51:37', NULL, NULL, NULL, 3),
(32, 'Cheesecake Entero', 3, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, '2014-03-31 21:51:37', '2014-03-31 21:51:37', NULL, NULL, NULL, 3),
(33, 'Mousse De Chocolate Entero', 3, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, '2014-03-31 21:51:37', '2014-03-31 21:51:37', NULL, NULL, NULL, 3),
(34, 'Torta Chocolate', 3, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, '2014-03-31 21:51:37', '2014-03-31 21:51:37', NULL, NULL, NULL, 3),
(35, 'Tentaciòn De Avellanas', 3, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, '2014-03-31 21:51:37', '2014-03-31 21:51:37', NULL, NULL, NULL, 3),
(36, 'Torta 3 Leches Vainilla', 3, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, '2014-03-31 21:51:37', '2014-03-31 21:51:37', NULL, NULL, NULL, 3),
(37, 'Keke Navd. Grande', 3, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, '2014-03-31 21:51:37', '2014-03-31 21:51:37', NULL, NULL, NULL, 3),
(38, 'Tortas Heladas', 3, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, '2014-03-31 21:51:37', '2014-03-31 21:51:37', NULL, NULL, NULL, 3),
(39, 'Cheesecake Grande', 3, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, '2014-03-31 21:51:37', '2014-03-31 21:51:37', NULL, NULL, NULL, 3),
(40, 'Torta Selva Negra', 3, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, '2014-03-31 21:51:37', '2014-03-31 21:51:37', NULL, NULL, NULL, 3),
(41, 'Torta Nutella', 3, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, '2014-03-31 21:51:37', '2014-03-31 21:51:37', NULL, NULL, NULL, 3),
(42, 'Torta Hindú', 3, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, '2014-03-31 21:51:37', '2014-03-31 21:51:37', NULL, NULL, NULL, 3),
(43, 'Tiramisú', 3, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, '2014-03-31 21:51:37', '2014-03-31 21:51:37', NULL, NULL, NULL, 3),
(44, 'Chilcano', 3, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, '2014-03-31 21:51:37', '2014-03-31 21:51:37', NULL, NULL, NULL, 3),
(45, 'Pilsen', 3, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, '2014-03-31 21:51:37', '2014-03-31 21:51:37', NULL, NULL, NULL, 3),
(46, 'Pan Al Ajo Especial', 4, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, '2014-03-31 21:54:01', '2014-03-31 21:54:01', NULL, NULL, NULL, 1),
(47, 'Humita', 4, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, '2014-03-31 21:54:01', '2014-03-31 21:54:01', NULL, NULL, NULL, 1),
(48, 'Boliyucas', 4, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, '2014-03-31 21:54:01', '2014-03-31 21:54:01', NULL, NULL, NULL, 1),
(49, 'Tequeños Lomito', 4, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, '2014-03-31 21:54:01', '2014-03-31 21:54:01', NULL, NULL, NULL, 1),
(50, 'Salchipapas Especial', 4, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, '2014-03-31 21:54:02', '2014-03-31 21:54:02', NULL, NULL, NULL, 1),
(51, 'Papas Fritas', 4, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, '2014-03-31 21:54:02', '2014-03-31 21:54:02', NULL, NULL, NULL, 1),
(52, 'Chicharron De Pollo', 4, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, '2014-03-31 21:54:02', '2014-03-31 21:54:02', NULL, NULL, NULL, 1),
(53, 'Tostadas', 4, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, '2014-03-31 21:54:02', '2014-03-31 21:54:02', NULL, NULL, NULL, 1),
(54, 'Alitas Picantes', 4, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, '2014-03-31 21:54:02', '2014-03-31 21:54:02', NULL, NULL, NULL, 1),
(55, 'Pollo A La Plancha', 5, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, '2014-03-31 21:55:30', '2014-03-31 21:55:30', NULL, NULL, NULL, 1),
(56, 'Suprema De Pollo', 5, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, '2014-03-31 21:55:30', '2014-03-31 21:55:30', NULL, NULL, NULL, 1),
(57, 'Chicharron Humita', 5, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, '2014-03-31 21:55:30', '2014-03-31 21:55:30', NULL, NULL, NULL, 1),
(58, 'Lomo Saltado', 5, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, '2014-03-31 21:55:30', '2014-03-31 21:55:30', NULL, NULL, NULL, 1),
(59, 'Brochetas De Lomo', 5, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, '2014-03-31 21:55:30', '2014-03-31 21:55:30', NULL, NULL, NULL, 1),
(60, 'Fetuccinis Huancaina', 5, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, '2014-03-31 21:55:30', '2014-03-31 21:55:30', NULL, NULL, NULL, 1),
(61, 'Fetuccinis Al Pesto', 5, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, '2014-03-31 21:55:30', '2014-03-31 21:55:30', NULL, NULL, NULL, 1),
(62, 'Helado Simple', 6, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, '2014-03-31 22:04:00', '2014-03-31 22:04:00', NULL, NULL, 1, 3),
(63, 'Helado Doble', 6, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, '2014-03-31 22:04:00', '2014-03-31 22:04:00', NULL, NULL, 2, 3),
(64, 'Copa Tartufo', 6, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, '2014-03-31 22:04:00', '2014-03-31 22:04:00', NULL, NULL, NULL, 3),
(65, 'Copa Chocofresas', 6, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, '2014-03-31 22:04:00', '2014-03-31 22:04:00', NULL, NULL, NULL, 3),
(66, 'Helado Por Litro', 6, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, '2014-03-31 22:04:00', '2014-03-31 22:04:00', NULL, NULL, NULL, 3),
(67, 'Helado 1/2 Litro', 6, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, '2014-03-31 22:04:00', '2014-03-31 22:04:00', NULL, NULL, NULL, 3),
(68, 'Copa Caribeño', 6, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, '2014-03-31 22:04:00', '2014-03-31 22:04:00', NULL, NULL, NULL, 3),
(69, 'Fruticream', 6, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, '2014-03-31 22:04:00', '2014-03-31 22:04:00', NULL, NULL, NULL, 3),
(70, 'Helado Triple', 6, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, '2014-03-31 22:04:00', '2014-03-31 22:04:00', NULL, NULL, NULL, 3),
(71, 'Sundae Fantasia', 6, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, '2014-03-31 22:04:00', '2014-03-31 22:04:00', NULL, NULL, NULL, 3),
(72, 'Sundae Cuacua', 6, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, '2014-03-31 22:04:00', '2014-03-31 22:04:00', NULL, NULL, NULL, 3),
(73, 'Copa Peach', 6, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, '2014-03-31 22:04:00', '2014-03-31 22:04:00', NULL, NULL, NULL, 3),
(74, 'Sundae Oreo', 6, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, '2014-03-31 22:04:00', '2014-03-31 22:04:00', NULL, NULL, NULL, 3),
(75, 'Waffle C/Helado', 6, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, '2014-03-31 22:04:00', '2014-03-31 22:04:00', NULL, NULL, NULL, 3),
(76, 'Copa Peach Melba', 6, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, '2014-03-31 22:04:00', '2014-03-31 22:04:00', NULL, NULL, NULL, 3),
(77, 'Sorbete De Mango', 7, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, '2014-03-31 22:08:08', '2014-03-31 22:08:08', NULL, NULL, NULL, 3),
(78, 'Sorbete Fresa', 7, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, '2014-03-31 22:08:08', '2014-03-31 22:08:08', NULL, NULL, NULL, 3),
(79, 'Sorbete Guanabana', 7, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, '2014-03-31 22:08:08', '2014-03-31 22:08:08', NULL, NULL, NULL, 3),
(80, 'Sublime Krasher', 8, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, '2014-03-31 22:10:12', '2014-03-31 22:10:12', NULL, NULL, NULL, 3),
(81, 'Mokaccino Krasher', 8, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, '2014-03-31 22:10:12', '2014-03-31 22:10:12', NULL, NULL, NULL, 3),
(82, 'Muchik Krasher', 8, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, '2014-03-31 22:10:12', '2014-03-31 22:10:12', NULL, NULL, NULL, 3),
(83, 'Tentacion Krasher', 8, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, '2014-03-31 22:10:12', '2014-03-31 22:10:12', NULL, NULL, NULL, 3),
(84, 'Tornado Krasher', 8, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, '2014-03-31 22:10:12', '2014-03-31 22:10:12', NULL, NULL, NULL, 3),
(85, 'Frutos Silvestres Krasher', 8, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, '2014-03-31 22:10:12', '2014-03-31 22:10:12', NULL, NULL, NULL, 3),
(86, 'Oreo Krasher', 8, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, '2014-03-31 22:10:12', '2014-03-31 22:10:12', NULL, NULL, NULL, 3),
(87, 'Frappe Norteño', 18, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, '2014-03-31 22:12:31', '2014-03-31 22:12:31', NULL, NULL, NULL, 3),
(88, 'Frappe Maniako', 18, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, '2014-03-31 22:12:31', '2014-03-31 22:12:31', NULL, NULL, NULL, 3),
(89, 'Frappe Mokachips', 18, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, '2014-03-31 22:12:31', '2014-03-31 22:12:31', NULL, NULL, NULL, 3),
(90, 'Emp. Aji De Gallina', 9, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, '2014-03-31 22:17:30', '2014-03-31 22:17:30', NULL, NULL, NULL, 1),
(91, 'Emp. Pollo Bechamel', 9, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, '2014-03-31 22:17:30', '2014-03-31 22:17:30', NULL, NULL, NULL, 1),
(92, 'Emp. Pizzera', 9, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, '2014-03-31 22:17:30', '2014-03-31 22:17:30', NULL, NULL, NULL, 1),
(93, 'Emp. Lomo Saltado', 9, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, '2014-03-31 22:17:30', '2014-03-31 22:17:30', NULL, NULL, NULL, 1),
(94, 'Empanada De Manzana', 9, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, '2014-03-31 22:17:30', '2014-03-31 22:17:30', NULL, NULL, NULL, 1),
(95, 'Nativo', 10, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, '2014-03-31 22:21:55', '2014-03-31 22:21:55', NULL, NULL, NULL, 3),
(96, 'Tropical', 10, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, '2014-03-31 22:21:56', '2014-03-31 22:21:56', NULL, NULL, NULL, 3),
(97, 'Pasion Frutal', 10, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, '2014-03-31 22:21:56', '2014-03-31 22:21:56', NULL, NULL, NULL, 3),
(98, 'Citrus', 10, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, '2014-03-31 22:21:56', '2014-03-31 22:21:56', NULL, NULL, NULL, 3),
(99, 'Mambo', 10, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, '2014-03-31 22:21:56', '2014-03-31 22:21:56', NULL, NULL, NULL, 3),
(100, 'Andino', 10, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, '2014-03-31 22:21:56', '2014-03-31 22:21:56', NULL, NULL, NULL, 3),
(101, 'Fresh', 10, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, '2014-03-31 22:21:56', '2014-03-31 22:21:56', NULL, NULL, NULL, 3),
(102, 'Lactico', 10, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, '2014-03-31 22:21:56', '2014-03-31 22:21:56', NULL, NULL, NULL, 3),
(103, 'Jarra Frutimix', 10, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, '2014-03-31 22:21:56', '2014-03-31 22:21:56', NULL, NULL, NULL, 3),
(104, 'Delicia', 10, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, '2014-03-31 22:21:56', '2014-03-31 22:21:56', NULL, NULL, NULL, 3),
(105, 'Jugo De Papaya', 10, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, '2014-03-31 22:21:56', '2014-03-31 22:21:56', NULL, NULL, NULL, 3),
(106, 'Surtido', 10, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, '2014-03-31 22:21:56', '2014-03-31 22:21:56', NULL, NULL, NULL, 3),
(107, 'Macedonia', 11, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, '2014-03-31 22:24:29', '2014-03-31 22:24:29', NULL, NULL, NULL, 3),
(108, 'Chocomix Frutal', 11, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, '2014-03-31 22:24:29', '2014-03-31 22:24:29', NULL, NULL, NULL, 3),
(109, 'Yogurt Frutado', 11, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, '2014-03-31 22:24:29', '2014-03-31 22:24:29', NULL, NULL, NULL, 3),
(110, 'Macedonia Helado', 11, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, '2014-03-31 22:24:29', '2014-03-31 22:24:29', NULL, NULL, NULL, 3),
(111, 'Vaso Yogurt', 11, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, '2014-03-31 22:24:29', '2014-03-31 22:24:29', NULL, NULL, NULL, 3),
(112, 'Cafe Pasado', 12, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, '2014-03-31 22:28:14', '2014-03-31 22:28:14', NULL, NULL, NULL, 3),
(113, 'Cortado', 12, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, '2014-03-31 22:28:14', '2014-03-31 22:28:14', NULL, NULL, NULL, 3),
(114, 'Chocolate Kango', 12, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, '2014-03-31 22:28:14', '2014-03-31 22:28:14', NULL, NULL, NULL, 3),
(115, 'Cafe Capuccino', 12, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, '2014-03-31 22:28:14', '2014-03-31 22:28:14', NULL, NULL, NULL, 3),
(116, 'Te Frutado c/Limon', 12, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, '2014-03-31 22:28:14', '2014-03-31 22:28:14', NULL, NULL, NULL, 3),
(117, 'Mokaccino', 12, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, '2014-03-31 22:28:14', '2014-03-31 22:28:14', NULL, NULL, NULL, 3),
(118, 'Anis', 12, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, '2014-03-31 22:28:14', '2014-03-31 22:28:14', NULL, NULL, NULL, 3),
(119, 'Manzanilla', 12, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, '2014-03-31 22:28:14', '2014-03-31 22:28:14', NULL, NULL, NULL, 3),
(120, 'Cafe Expreso', 12, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, '2014-03-31 22:28:15', '2014-03-31 22:28:15', NULL, NULL, NULL, 3),
(121, 'Tasa De Leche', 12, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, '2014-03-31 22:28:15', '2014-03-31 22:28:15', NULL, NULL, NULL, 3),
(122, 'Cafe Con Leche', 12, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, '2014-03-31 22:28:15', '2014-03-31 22:28:15', NULL, NULL, NULL, 3),
(123, 'Sdw. Chanchito Oriental', 13, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, '2014-03-31 22:31:05', '2014-03-31 22:31:05', NULL, NULL, NULL, 1),
(124, 'Sdw. Pollo A La Brasa', 13, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, '2014-03-31 22:31:05', '2014-03-31 22:31:05', NULL, NULL, NULL, 1),
(125, 'Sdw. Chicharron Tradc.', 13, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, '2014-03-31 22:31:05', '2014-03-31 22:31:05', NULL, NULL, NULL, 1),
(126, 'Sdw. Pavo Tradicional', 13, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, '2014-03-31 22:31:05', '2014-03-31 22:31:05', NULL, NULL, NULL, 1),
(127, 'Sdw. Lomo Saltado', 13, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, '2014-03-31 22:31:05', '2014-03-31 22:31:05', NULL, NULL, NULL, 1),
(128, 'El Apanado', 13, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, '2014-03-31 22:31:05', '2014-03-31 22:31:05', NULL, NULL, NULL, 1),
(129, 'Butifarra', 13, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, '2014-03-31 22:31:05', '2014-03-31 22:31:05', NULL, NULL, NULL, 1),
(130, 'Huevo Frito', 14, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, '2014-03-31 22:37:57', '2014-03-31 22:37:57', NULL, NULL, NULL, 1),
(131, 'Queso', 14, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, '2014-03-31 22:37:57', '2014-03-31 22:37:57', NULL, NULL, NULL, 1),
(132, 'Bombones', 14, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, '2014-03-31 22:37:57', '2014-03-31 22:37:57', NULL, NULL, NULL, 1),
(133, 'Yogurt Con Granola', 14, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, '2014-03-31 22:37:57', '2014-03-31 22:37:57', NULL, NULL, NULL, 1),
(134, 'Pan', 14, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, '2014-03-31 22:37:57', '2014-03-31 22:37:57', NULL, NULL, NULL, 1),
(135, 'Tostadas', 14, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, '2014-03-31 22:37:57', '2014-03-31 22:37:57', NULL, NULL, NULL, 1),
(136, 'Bola De Helado', 14, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, '2014-03-31 22:37:57', '2014-03-31 22:37:57', NULL, NULL, NULL, 1),
(137, 'Gomitas Y Oreo', 14, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, '2014-03-31 22:37:57', '2014-03-31 22:37:57', NULL, NULL, NULL, 1),
(138, 'Mant/Merme', 14, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, '2014-03-31 22:37:57', '2014-03-31 22:37:57', NULL, NULL, NULL, 1),
(139, 'Papas Fritas', 14, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, '2014-03-31 22:37:57', '2014-03-31 22:37:57', NULL, NULL, NULL, 1),
(140, 'Profiteroles', 14, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, '2014-03-31 22:37:57', '2014-03-31 22:37:57', NULL, NULL, NULL, 1),
(141, 'Croissant', 14, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, '2014-03-31 22:37:57', '2014-03-31 22:37:57', NULL, NULL, NULL, 1),
(142, 'Pizza Americana', 15, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, '2014-03-31 22:40:59', '2014-03-31 22:40:59', NULL, NULL, NULL, 1),
(143, 'Pizza Hawaiana', 15, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, '2014-03-31 22:40:59', '2014-03-31 22:40:59', NULL, NULL, NULL, 1),
(144, 'Pizza Carnivora', 15, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, '2014-03-31 22:40:59', '2014-03-31 22:40:59', NULL, NULL, NULL, 1),
(145, 'Vegetariana', 15, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, '2014-03-31 22:40:59', '2014-03-31 22:40:59', NULL, NULL, NULL, 1),
(146, 'Continental', 15, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, '2014-03-31 22:40:59', '2014-03-31 22:40:59', NULL, NULL, NULL, 1),
(147, 'Combo Pizero', 15, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, '2014-03-31 22:40:59', '2014-03-31 22:40:59', NULL, NULL, NULL, 1),
(148, 'Pizza Lomo Saltado', 15, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, '2014-03-31 22:40:59', '2014-03-31 22:40:59', NULL, NULL, NULL, 1),
(149, 'Extrema', 15, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, '2014-03-31 22:40:59', '2014-03-31 22:40:59', NULL, NULL, NULL, 1),
(150, 'Pizza Fam Americana', 15, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, '2014-03-31 22:40:59', '2014-03-31 22:40:59', NULL, NULL, NULL, 1),
(151, 'Pizza Fam Hawa', 15, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, '2014-03-31 22:40:59', '2014-03-31 22:40:59', NULL, NULL, NULL, 1),
(152, 'Pizza Fam Cont', 15, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, '2014-03-31 22:40:59', '2014-03-31 22:40:59', NULL, NULL, NULL, 1),
(153, 'Pizza Vegetariana', 15, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, '2014-03-31 22:40:59', '2014-03-31 22:40:59', NULL, NULL, NULL, 1),
(154, 'Pizza Fam Lomo', 15, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, '2014-03-31 22:40:59', '2014-03-31 22:40:59', NULL, NULL, NULL, 1),
(155, 'Pizza Fam Carnivora', 15, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, '2014-03-31 22:40:59', '2014-03-31 22:40:59', NULL, NULL, NULL, 1),
(156, 'Pizza Fam Extrema', 15, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, '2014-03-31 22:40:59', '2014-03-31 22:40:59', NULL, NULL, NULL, 1),
(157, 'Triple Clasico', 16, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, '2014-03-31 22:51:15', '2014-03-31 22:51:15', NULL, NULL, NULL, 1),
(158, 'Triple Hawaiano', 16, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, '2014-03-31 22:51:15', '2014-03-31 22:51:15', NULL, NULL, NULL, 1),
(159, 'Triple Marino', 16, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, '2014-03-31 22:51:15', '2014-03-31 22:51:15', NULL, NULL, NULL, 1),
(160, 'Triple Caliente', 16, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, '2014-03-31 22:51:15', '2014-03-31 22:51:15', NULL, NULL, NULL, 1),
(161, 'Mixto', 16, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, '2014-03-31 22:51:15', '2014-03-31 22:51:15', NULL, NULL, NULL, 1),
(162, 'Club Sandwich', 16, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, '2014-03-31 22:51:15', '2014-03-31 22:51:15', NULL, NULL, NULL, 1),
(163, 'Vegetariano', 16, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, '2014-03-31 22:51:15', '2014-03-31 22:51:15', NULL, NULL, NULL, 1),
(164, 'Torta 3 Leches', 19, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, '2014-03-31 22:54:35', '2014-03-31 22:54:35', NULL, NULL, NULL, 3),
(165, 'Torta De Chocolate', 19, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, '2014-03-31 22:54:35', '2014-03-31 22:54:35', NULL, NULL, NULL, 3),
(166, 'Selva Negra', 19, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, '2014-03-31 22:54:35', '2014-03-31 22:54:35', NULL, NULL, NULL, 3),
(167, 'Cheesecake Entero', 19, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, '2014-03-31 22:54:35', '2014-03-31 22:54:35', NULL, NULL, NULL, 3),
(168, 'Torta Hindú', 19, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, '2014-03-31 22:54:35', '2014-03-31 22:54:35', NULL, NULL, NULL, 3),
(169, 'Soufle De Fresa', 19, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, '2014-03-31 22:54:35', '2014-03-31 22:54:35', NULL, NULL, NULL, 3),
(170, 'Tiramisu', 19, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, '2014-03-31 22:54:35', '2014-03-31 22:54:35', NULL, NULL, NULL, 3),
(171, 'Turrón De Chocolate', 19, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, '2014-03-31 22:54:35', '2014-03-31 22:54:35', NULL, NULL, NULL, 3),
(172, 'Souffle De Toffee', 19, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, '2014-03-31 22:54:35', '2014-03-31 22:54:35', NULL, NULL, NULL, 3),
(173, 'Fuente Cebiche', 20, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, '2014-03-31 22:58:59', '2014-03-31 22:58:59', NULL, NULL, NULL, 1),
(174, 'Tequeños', 20, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, '2014-03-31 22:58:59', '2014-03-31 22:58:59', NULL, NULL, NULL, 1),
(175, 'Chicharron Pollo', 20, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, '2014-03-31 22:58:59', '2014-03-31 22:58:59', NULL, NULL, NULL, 1),
(176, 'Lomo Saltado', 20, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, '2014-03-31 22:58:59', '2014-03-31 22:58:59', NULL, NULL, NULL, 1),
(177, 'Brochetas De Lomo', 20, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, '2014-03-31 22:58:59', '2014-03-31 22:58:59', NULL, NULL, NULL, 1),
(178, 'Chicharron De Pescado', 20, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, '2014-03-31 22:58:59', '2014-03-31 22:58:59', NULL, NULL, NULL, 1),
(179, 'Jarra Chicha', 20, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, '2014-03-31 22:58:59', '2014-03-31 22:58:59', NULL, NULL, NULL, 3),
(180, 'Jarra Limonada', 20, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, '2014-03-31 22:58:59', '2014-03-31 22:58:59', NULL, NULL, NULL, 3),
(181, 'Copas De Helado', 20, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, '2014-03-31 22:58:59', '2014-03-31 22:58:59', NULL, NULL, NULL, 3),
(182, 'Pack Peña', 20, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, '2014-03-31 22:58:59', '2014-03-31 22:58:59', NULL, NULL, NULL, 1),
(183, 'Pack Criollo Niño', 20, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, '2014-03-31 22:58:59', '2014-03-31 22:58:59', NULL, NULL, NULL, 1),
(184, 'Papa Huancaina', 20, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, '2014-03-31 22:58:59', '2014-03-31 22:58:59', NULL, NULL, NULL, 1),
(185, 'Jarra Cerveza', 20, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, '2014-03-31 22:58:59', '2014-03-31 22:58:59', NULL, NULL, NULL, 3),
(186, 'Bgr. Clasica', 21, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, '2014-03-31 23:03:21', '2014-03-31 23:03:21', NULL, NULL, NULL, 1),
(187, 'Bgr. Bacon', 21, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, '2014-03-31 23:03:21', '2014-03-31 23:03:21', NULL, NULL, NULL, 1),
(188, 'Brg. Parrillera', 21, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, '2014-03-31 23:03:21', '2014-03-31 23:03:21', NULL, NULL, NULL, 1),
(189, 'Bgr. Frenchi', 21, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, '2014-03-31 23:03:21', '2014-03-31 23:03:21', NULL, NULL, NULL, 1),
(190, 'Adicionales', 21, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, '2014-03-31 23:03:21', '2014-03-31 23:03:21', NULL, NULL, NULL, 1),
(191, 'Roll Hawaiano', 22, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, '2014-03-31 23:05:14', '2014-03-31 23:05:14', NULL, NULL, NULL, 1),
(192, 'Roll Crispy', 22, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, '2014-03-31 23:05:14', '2014-03-31 23:05:14', NULL, NULL, NULL, 1),
(193, 'Roll Campesino', 22, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, '2014-03-31 23:05:14', '2014-03-31 23:05:14', NULL, NULL, NULL, 1),
(194, 'Roll Mexicano', 22, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, '2014-03-31 23:05:14', '2014-03-31 23:05:14', NULL, NULL, NULL, 1),
(195, 'Roll California', 22, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, '2014-03-31 23:05:14', '2014-03-31 23:05:14', NULL, NULL, NULL, 1),
(196, 'Pollo a la Mostaza', 24, NULL, 1, 0, 'Unidades', NULL, 50.00, 5.00, 70.00, '2014-04-02 05:00:00', '2014-04-02 05:00:00', NULL, NULL, NULL, 1),
(197, 'Bisteck Apan c/Pallares', 24, NULL, 1, 0, 'Unidades', NULL, 50.00, 5.00, 70.00, '2014-04-02 05:00:00', '2014-04-02 05:00:00', NULL, NULL, NULL, 1),
(198, 'Hledo (Menu)', 6, NULL, 1, 0, 'Unidades', NULL, 50.00, 5.00, 70.00, '2014-04-02 05:00:00', '2014-04-02 05:00:00', NULL, NULL, NULL, 3),
(199, 'Teq mix (x2) c/Tartara', 23, NULL, 1, 0, 'Unidades', NULL, 50.00, 5.00, 70.00, '2014-04-02 05:00:00', '2014-04-02 05:00:00', NULL, NULL, NULL, 1),
(200, 'Humita c/ salsa criolla', 23, NULL, 1, 0, 'Unidades', NULL, 50.00, 5.00, 70.00, '2014-04-02 05:00:00', '2014-04-02 05:00:00', NULL, NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `receta`
--

CREATE TABLE IF NOT EXISTS `receta` (
  `producto_id` int(11) NOT NULL,
  `insumo_id` int(11) NOT NULL,
  `cantidad` decimal(10,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`producto_id`,`insumo_id`),
  KEY `fk_detProducto_Insumo1_idx` (`insumo_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `registrogastoscaja`
--

CREATE TABLE IF NOT EXISTS `registrogastoscaja` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `tipogasto_id` int(10) unsigned NOT NULL,
  `importetotal` decimal(5,2) DEFAULT NULL,
  `subtotal` decimal(5,2) DEFAULT NULL,
  `igv` decimal(5,2) DEFAULT NULL,
  `seriecomprobante` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `numerocomprobante` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `numerocargo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `detallecaja_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `descripcion` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `registrogastoscaja_tipogasto_id_foreign` (`tipogasto_id`),
  KEY `registrogastoscaja_detallecaja_id_foreign` (`detallecaja_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `registrogastoscaja`
--

INSERT INTO `registrogastoscaja` (`id`, `tipogasto_id`, `importetotal`, `subtotal`, `igv`, `seriecomprobante`, `numerocomprobante`, `numerocargo`, `detallecaja_id`, `created_at`, `updated_at`, `descripcion`) VALUES
(1, 1, 100.00, 0.00, 0.00, '', '', '10', 6, '2014-04-28 07:27:55', '2014-04-28 07:27:55', 'Compra'),
(2, 2, 20.00, 0.00, 0.00, '1123', '123123123', '', 6, '2014-04-28 14:33:11', '2014-04-28 14:33:11', 'Compra '),
(3, 1, 10.00, 0.00, 0.00, '', '', '15', 7, '2014-04-28 15:39:21', '2014-04-28 15:39:21', 'pasajes para mi de mi'),
(4, 1, 20.00, 0.00, 0.00, '', '', '12', 8, '2014-04-28 16:35:06', '2014-04-28 16:35:06', 'asdasdasd');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `restaurante`
--

CREATE TABLE IF NOT EXISTS `restaurante` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombreComercial` varchar(200) DEFAULT NULL,
  `razonSocial` varchar(200) DEFAULT NULL,
  `ruc` varchar(11) DEFAULT NULL,
  `direccion` varchar(200) DEFAULT NULL,
  `comentarios` text,
  `imagen` text,
  `pais` varchar(50) DEFAULT NULL,
  `departamento` varchar(50) DEFAULT NULL,
  `provincia` varchar(50) DEFAULT NULL,
  `tel` varchar(100) DEFAULT NULL,
  `fax` varchar(100) DEFAULT NULL,
  `cel` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `serie` varchar(255) NOT NULL,
  `numerodeticket` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `restaurante`
--

INSERT INTO `restaurante` (`id`, `nombreComercial`, `razonSocial`, `ruc`, `direccion`, `comentarios`, `imagen`, `pais`, `departamento`, `provincia`, `tel`, `fax`, `cel`, `created_at`, `updated_at`, `serie`, `numerodeticket`) VALUES
(2, 'Kango Café', 'K & C International SAC', '20507803173', 'elias aguirre', 'ADASD', NULL, 'Peru', 'Lambayeque', 'Chiclayo', '252711', '', '982604940', '2014-04-01 00:03:03', '2014-05-05 08:23:57', '001', '156');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sabor`
--

CREATE TABLE IF NOT EXISTS `sabor` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `insumo_id` int(11) DEFAULT NULL,
  `porcion` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `sabor_insumo_id_foreign` (`insumo_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `sabor`
--

INSERT INTO `sabor` (`id`, `nombre`, `insumo_id`, `porcion`, `created_at`, `updated_at`) VALUES
(1, 'Fresa', NULL, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 'Lucuma', NULL, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 'Vainilla', NULL, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 'Chocolate', NULL, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `salon`
--

CREATE TABLE IF NOT EXISTS `salon` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) DEFAULT NULL,
  `descripcion` text,
  `restaurante_id` int(11) DEFAULT NULL,
  `habilitado` tinyint(1) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_Salon_Restaurante1_idx` (`restaurante_id`) USING BTREE
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `salon`
--

INSERT INTO `salon` (`id`, `nombre`, `descripcion`, `restaurante_id`, `habilitado`, `created_at`, `updated_at`) VALUES
(3, 'Salon 1', 'Salon', 2, 1, '2014-04-01 00:03:26', '2014-04-01 00:03:26');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ticketventa`
--

CREATE TABLE IF NOT EXISTS `ticketventa` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `serie` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `numero` int(11) NOT NULL,
  `importe` decimal(5,2) NOT NULL,
  `descuento` varchar(0) COLLATE utf8_unicode_ci NOT NULL,
  `caja_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `idescuento` decimal(5,2) NOT NULL,
  `vuelto` decimal(5,2) NOT NULL,
  `IGV` decimal(5,2) NOT NULL,
  `subtotal` decimal(5,2) NOT NULL,
  `ipagado` decimal(5,2) NOT NULL,
  `pedido_id` int(11) NOT NULL,
  `detcaja_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `ticketventa_caja_id_foreign` (`caja_id`),
  KEY `fk_ticketventa_1_idx` (`pedido_id`,`ipagado`),
  KEY `fk_ticketventa_3_idx` (`detcaja_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=40 ;

--
-- Volcado de datos para la tabla `ticketventa`
--

INSERT INTO `ticketventa` (`id`, `serie`, `numero`, `importe`, `descuento`, `caja_id`, `created_at`, `updated_at`, `idescuento`, `vuelto`, `IGV`, `subtotal`, `ipagado`, `pedido_id`, `detcaja_id`) VALUES
(4, '001', 127, 27.70, '', 4, '2014-04-28 04:54:28', '2014-04-28 04:54:28', 0.00, 0.30, 4.99, 22.71, 28.00, 1, 6),
(5, '001', 128, 14.80, '', 4, '2014-04-28 14:39:41', '2014-04-28 14:39:41', 0.00, 0.20, 2.66, 12.14, 15.00, 1, 6),
(6, '001', 129, 8.80, '', 4, '2014-04-28 14:41:35', '2014-04-28 14:41:35', 0.00, 1.20, 1.58, 7.22, 10.00, 1, 6),
(7, '001', 130, 12.30, '', 4, '2014-04-28 15:38:08', '2014-04-28 15:38:08', 0.00, 0.70, 2.21, 10.09, 13.00, 2, 7),
(8, '001', 131, 25.70, '', 4, '2014-04-28 17:16:00', '2014-04-28 17:16:00', 0.00, 0.30, 4.63, 21.07, 26.00, 3, 8),
(9, '001', 132, 9.50, '', 4, '2014-04-28 17:22:33', '2014-04-28 17:22:33', 0.00, 0.50, 1.71, 7.79, 10.00, 3, 8),
(10, '001', 133, 115.50, '', 4, '2014-04-30 05:11:49', '2014-04-30 05:11:49', 0.00, 4.50, 20.79, 94.71, 120.00, 2, 8),
(11, '001', 134, 1.00, '', 4, '2014-04-30 05:12:03', '2014-04-30 05:12:03', 0.00, 1.00, 0.18, 0.82, 2.00, 1, 8),
(12, '001', 135, 88.90, '', 4, '2014-05-02 04:00:57', '2014-05-02 04:00:57', 0.00, 1.10, 16.00, 72.90, 90.00, 4, 8),
(13, '001', 136, 125.20, '', 4, '2014-05-02 04:02:38', '2014-05-02 04:02:38', 0.00, 0.80, 22.54, 102.66, 126.00, 5, 8),
(14, '001', 137, 47.10, '', 4, '2014-05-02 04:04:12', '2014-05-02 04:04:12', 0.00, 0.90, 8.48, 38.62, 48.00, 6, 8),
(15, '001', 138, 47.10, '', 4, '2014-05-02 04:07:24', '2014-05-02 04:07:24', 0.00, 0.90, 8.48, 38.62, 48.00, 7, 8),
(16, '001', 139, 47.10, '', 4, '2014-05-02 04:10:01', '2014-05-02 04:10:01', 0.00, 0.90, 8.48, 38.62, 48.00, 8, 8),
(17, '001', 140, 35.50, '', 4, '2014-05-02 04:14:19', '2014-05-02 04:14:19', 0.00, 4.50, 6.39, 29.11, 40.00, 9, 8),
(18, '001', 140, 35.50, '', 4, '2014-05-02 04:15:46', '2014-05-02 04:15:46', 0.00, 4.50, 6.39, 29.11, 40.00, 10, 8),
(19, '001', 140, 35.50, '', 4, '2014-05-02 04:30:32', '2014-05-02 04:30:32', 0.00, 4.50, 6.39, 29.11, 40.00, 12, 8),
(20, '001', 140, 35.50, '', 4, '2014-05-02 04:31:14', '2014-05-02 04:31:14', 0.00, 4.50, 6.39, 29.11, 40.00, 13, 8),
(21, '001', 140, 35.50, '', 4, '2014-05-02 04:52:41', '2014-05-02 04:52:41', 0.00, 4.50, 6.39, 29.11, 40.00, 14, 8),
(22, '001', 140, 35.50, '', 4, '2014-05-02 04:53:30', '2014-05-02 04:53:30', 0.00, 4.50, 6.39, 29.11, 40.00, 15, 8),
(23, '001', 140, 15.80, '', 4, '2014-05-02 04:56:18', '2014-05-02 04:56:18', 0.00, 4.20, 2.84, 12.96, 20.00, 15, 8),
(24, '001', 141, 35.50, '', 4, '2014-05-02 04:56:57', '2014-05-02 04:56:57', 0.00, 4.50, 6.39, 29.11, 40.00, 16, 8),
(25, '001', 142, 35.50, '', 4, '2014-05-02 06:07:20', '2014-05-02 06:07:20', 0.00, 4.50, 6.39, 29.11, 40.00, 17, 8),
(26, '001', 143, 47.10, '', 4, '2014-05-02 06:10:07', '2014-05-02 06:10:07', 0.00, 2.90, 8.48, 38.62, 50.00, 18, 8),
(27, '001', 144, 35.50, '', 4, '2014-05-02 06:15:33', '2014-05-02 06:15:33', 0.00, 4.50, 6.39, 29.11, 40.00, 19, 8),
(28, '001', 145, 35.50, '', 4, '2014-05-02 06:24:49', '2014-05-02 06:24:49', 0.00, 4.50, 6.39, 29.11, 40.00, 22, 8),
(29, '001', 146, 35.50, '', 4, '2014-05-02 06:26:39', '2014-05-02 06:26:39', 0.00, 14.50, 6.39, 29.11, 50.00, 23, 8),
(30, '001', 147, 35.50, '', 4, '2014-05-02 06:27:49', '2014-05-02 06:27:49', 0.00, 14.50, 6.39, 29.11, 50.00, 24, 8),
(31, '001', 148, 35.50, '', 4, '2014-05-02 06:29:21', '2014-05-02 06:29:21', 0.00, 14.50, 6.39, 29.11, 50.00, 25, 8),
(32, '001', 149, 35.50, '', 4, '2014-05-02 06:31:03', '2014-05-02 06:31:03', 0.00, 4.50, 6.39, 29.11, 40.00, 26, 8),
(33, '001', 150, 35.50, '', 4, '2014-05-02 07:58:08', '2014-05-02 07:58:08', 0.00, 14.50, 6.39, 29.11, 50.00, 11, 8),
(34, '001', 151, 35.50, '', 4, '2014-05-02 17:30:54', '2014-05-02 17:30:54', 0.00, 4.50, 6.39, 29.11, 40.00, 32, 8),
(35, '001', 152, 6.40, '', 4, '2014-05-03 00:48:20', '2014-05-03 00:48:20', 0.00, 0.60, 1.15, 5.25, 7.00, 41, 8),
(36, '001', 153, 18.80, '', 4, '2014-05-03 00:49:35', '2014-05-03 00:49:35', 0.00, 1.20, 3.38, 15.42, 20.00, 41, 8),
(37, '001', 154, 13.80, '', 4, '2014-05-03 18:43:41', '2014-05-03 18:43:41', 0.00, 0.20, 2.48, 11.32, 14.00, 42, 8),
(38, '001', 155, 164.20, '', 4, '2014-05-05 08:18:57', '2014-05-05 08:18:57', 0.00, 35.80, 29.56, 134.64, 200.00, 33, 8),
(39, '001', 156, 233.90, '', 4, '2014-05-05 08:23:57', '2014-05-05 08:23:57', 0.00, 16.10, 42.10, 191.80, 250.00, 43, 8);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipoareadeproduccion`
--

CREATE TABLE IF NOT EXISTS `tipoareadeproduccion` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `descripcion` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `tipoareadeproduccion`
--

INSERT INTO `tipoareadeproduccion` (`id`, `nombre`, `descripcion`, `created_at`, `updated_at`) VALUES
(1, 'Cocina', 'Cocina', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 'Salon', 'Salon', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 'Barra', 'Barra', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipocomb`
--

CREATE TABLE IF NOT EXISTS `tipocomb` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) DEFAULT NULL,
  `descripcion` text,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL COMMENT 'Para cubrir los distintos Menúes diarios de Kango',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `tipocomb`
--

INSERT INTO `tipocomb` (`id`, `nombre`, `descripcion`, `created_at`, `updated_at`) VALUES
(1, 'Normal', 'Normal', '2014-03-31 21:13:52', '2014-03-31 21:13:52'),
(2, 'Menu', NULL, NULL, NULL),
(3, 'Desayunos', 'Desayuno', '2014-03-31 21:13:52', '2014-03-31 21:13:52');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipodegasto`
--

CREATE TABLE IF NOT EXISTS `tipodegasto` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `tipodegasto`
--

INSERT INTO `tipodegasto` (`id`, `descripcion`, `created_at`, `updated_at`) VALUES
(1, 'Sin Comprobante', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 'Compra', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipodocumento`
--

CREATE TABLE IF NOT EXISTS `tipodocumento` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipoins`
--

CREATE TABLE IF NOT EXISTS `tipoins` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) DEFAULT NULL,
  `descripcion` text,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ubigeo`
--

CREATE TABLE IF NOT EXISTS `ubigeo` (
  `id_ubigeo` int(11) NOT NULL,
  `departamento` varchar(70) COLLATE utf8_unicode_ci DEFAULT NULL,
  `provincia` varchar(70) COLLATE utf8_unicode_ci DEFAULT NULL,
  `distrito` varchar(70) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id_ubigeo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE IF NOT EXISTS `usuario` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `login` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `persona_id` int(11) DEFAULT NULL,
  `colaborador` int(11) NOT NULL,
  `id_restaurante` int(11) DEFAULT NULL,
  `id_tipoareapro` int(11) unsigned DEFAULT NULL,
  `estado` tinyint(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `fk_Usuario_1_idx` (`persona_id`) USING BTREE,
  KEY `fk_Usuario_2_idx` (`id_restaurante`) USING BTREE,
  KEY `fk_Usuario_3_idx` (`id_tipoareapro`) USING BTREE,
  KEY `fk_usuario_4_idx` (`colaborador`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=9 ;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id`, `login`, `password`, `persona_id`, `colaborador`, `id_restaurante`, `id_tipoareapro`, `estado`, `created_at`, `updated_at`) VALUES
(1, 'mozo', '$2y$10$tSJpz4AdQLqbZWuVbT1cYeouDTfPBwYfv0fvD9LnmdNtQC2eRxT02', 2, 2, 2, 3, 1, '2014-04-01 00:25:48', '2014-04-01 00:25:48'),
(2, 'cocina', '$2y$10$sQGB1xPJlMXOH40NS0WAVe.3UqqrTXL5KcDxUtIE3nWRrBV9cxIWy', 3, 4, 2, 1, 1, '2014-04-01 00:26:09', '2014-04-01 00:26:09'),
(3, 'barra', '$2y$10$J4YHzdOpsrhMA.XNAOnlnesLc6uRETixsXjBMXC4WMRVajkyUp0mG', 4, 4, 2, 2, 1, '2014-04-01 00:26:27', '2014-04-02 05:12:47'),
(4, 'mozo2', '$2y$10$6OwXB4BcwnCH.ywT5YCXJOqT7tbR1hspmUGcjwqazyiezaB6eThe.', 5, 2, 2, 3, 1, '2014-04-01 01:14:59', '2014-04-01 01:14:59'),
(5, 'mozo1', '$2y$10$2FPPkkMDSsQKrDpx4KHStuO5WympZhGJFguPqgfsU4KW.7/GOWKlO', 6, 2, 2, 3, 1, '2014-04-02 16:06:16', '2014-04-02 16:06:16'),
(6, 'mozo3', '$2y$10$xjhcgNRm84UXd6ngYOVO5ueK2f3j3JMJWxR2F4wmvGUKDEKRS5DIC', 7, 2, 2, 3, 1, '2014-04-02 16:06:47', '2014-04-02 16:06:47'),
(7, 'mozo4', '$2y$10$SyT4V4Mr.ve569l5BrCWQuxU8vtb5fOXRGpKPwsv1R8I6lmuoquXi', 9, 2, 2, 3, 1, '2014-04-02 16:07:14', '2014-04-02 16:07:14'),
(8, 'mozo5', '$2y$10$f8Rbf.nWcE1swsJiUab1TOS4O/JL.VbGah2zJ2LbYtPJaKafa2m9i', 10, 2, 2, 3, 1, '2014-04-02 16:07:48', '2014-04-02 16:07:48');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vs_database_diagrams`
--

CREATE TABLE IF NOT EXISTS `vs_database_diagrams` (
  `name` char(80) DEFAULT NULL,
  `diadata` text,
  `comment` varchar(1022) DEFAULT NULL,
  `preview` text,
  `lockinfo` char(80) DEFAULT NULL,
  `locktime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `version` char(80) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `vs_database_diagrams`
--

INSERT INTO `vs_database_diagrams` (`name`, `diadata`, `comment`, `preview`, `lockinfo`, `locktime`, `version`) VALUES
('db4rest', 'PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0idXRmLTgiPz4KPHByb3BlcnRpZXM+Cgk8Q29udHJvbHM+CgkJPFRhYmxlPgoJCQk8UGFyZW50IHZhbHVlPSIjVE9QIi8+CgkJCTxQcm9wZXJ0aWVzPgoJCQkJPF5jaGVja3MgdmFsdWU9IjAiLz4KCQkJCTxeZ3JvdXAgdmFsdWU9Ii0xIi8+CgkJCQk8XmhlaWdodCB2YWx1ZT0iLTEiLz4KCQkJCTxeaW5kZXhlcyB2YWx1ZT0iMCIvPgoJCQkJPF5sZXZlbCB2YWx1ZT0iNSIvPgoJCQkJPF5saW5rcyB2YWx1ZT0iMCIvPgoJCQkJPF5sb2NrIHZhbHVlPSIwIi8+CgkJCQk8Xm1ldGhvZHMgdmFsdWU9IjAiLz4KCQkJCTxebWluaW1pemVkIHZhbHVlPSIwIi8+CgkJCQk8XnByb3BlcnRpZXMgdmFsdWU9IjAiLz4KCQkJCTxedHJpZ2dlcnMgdmFsdWU9IjAiLz4KCQkJCTxedW5pcXVlcyB2YWx1ZT0iMCIvPgoJCQkJPGJhY2tfY29sb3IgdmFsdWU9IkI0RDY0NzAwIi8+CgkJCQk8bmFtZSB2YWx1ZT0iVGFibGUiLz4KCQkJCTxwb3NpdGlvbiB2YWx1ZT0iMTg7MTAiLz4KCQkJCTxzaXplIHZhbHVlPSIyMzU7Mzc0Ii8+CgkJCTwvUHJvcGVydGllcz4KCQkJPFR5cGUgdmFsdWU9IlRhYmxlIi8+CgkJPC9UYWJsZT4KCQk8VGFibGUxPgoJCQk8UGFyZW50IHZhbHVlPSIjVE9QIi8+CgkJCTxQcm9wZXJ0aWVzPgoJCQkJPF5jaGVja3MgdmFsdWU9IjAiLz4KCQkJCTxeZ3JvdXAgdmFsdWU9Ii0xIi8+CgkJCQk8XmhlaWdodCB2YWx1ZT0iLTEiLz4KCQkJCTxeaW5kZXhlcyB2YWx1ZT0iMCIvPgoJCQkJPF5sZXZlbCB2YWx1ZT0iNCIvPgoJCQkJPF5saW5rcyB2YWx1ZT0iMCIvPgoJCQkJPF5sb2NrIHZhbHVlPSIwIi8+CgkJCQk8Xm1ldGhvZHMgdmFsdWU9IjAiLz4KCQkJCTxebWluaW1pemVkIHZhbHVlPSIwIi8+CgkJCQk8XnByb3BlcnRpZXMgdmFsdWU9IjAiLz4KCQkJCTxedHJpZ2dlcnMgdmFsdWU9IjAiLz4KCQkJCTxedW5pcXVlcyB2YWx1ZT0iMCIvPgoJCQkJPGJhY2tfY29sb3IgdmFsdWU9IkI0RDY0NzAwIi8+CgkJCQk8bmFtZSB2YWx1ZT0iVGFibGUxIi8+CgkJCQk8cG9zaXRpb24gdmFsdWU9IjM1NzsxMzciLz4KCQkJCTxzaXplIHZhbHVlPSIxNzM7MTU4Ii8+CgkJCTwvUHJvcGVydGllcz4KCQkJPFR5cGUgdmFsdWU9IlRhYmxlIi8+CgkJPC9UYWJsZTE+CgkJPFRhYmxlMj4KCQkJPFBhcmVudCB2YWx1ZT0iI1RPUCIvPgoJCQk8UHJvcGVydGllcz4KCQkJCTxeY2hlY2tzIHZhbHVlPSIwIi8+CgkJCQk8Xmdyb3VwIHZhbHVlPSItMSIvPgoJCQkJPF5oZWlnaHQgdmFsdWU9Ii0xIi8+CgkJCQk8XmluZGV4ZXMgdmFsdWU9IjAiLz4KCQkJCTxebGV2ZWwgdmFsdWU9IjMiLz4KCQkJCTxebGlua3MgdmFsdWU9IjAiLz4KCQkJCTxebG9jayB2YWx1ZT0iMCIvPgoJCQkJPF5tZXRob2RzIHZhbHVlPSIwIi8+CgkJCQk8Xm1pbmltaXplZCB2YWx1ZT0iMCIvPgoJCQkJPF5wcm9wZXJ0aWVzIHZhbHVlPSIwIi8+CgkJCQk8XnRyaWdnZXJzIHZhbHVlPSIwIi8+CgkJCQk8XnVuaXF1ZXMgdmFsdWU9IjAiLz4KCQkJCTxiYWNrX2NvbG9yIHZhbHVlPSJCNEQ2NDcwMCIvPgoJCQkJPG5hbWUgdmFsdWU9IlRhYmxlMiIvPgoJCQkJPHBvc2l0aW9uIHZhbHVlPSI2MzE7MjIzIi8+CgkJCQk8c2l6ZSB2YWx1ZT0iMTg3OzIxMiIvPgoJCQk8L1Byb3BlcnRpZXM+CgkJCTxUeXBlIHZhbHVlPSJUYWJsZSIvPgoJCTwvVGFibGUyPgoJCTxUYWJsZTM+CgkJCTxQYXJlbnQgdmFsdWU9IiNUT1AiLz4KCQkJPFByb3BlcnRpZXM+CgkJCQk8XmNoZWNrcyB2YWx1ZT0iMCIvPgoJCQkJPF5ncm91cCB2YWx1ZT0iLTEiLz4KCQkJCTxeaGVpZ2h0IHZhbHVlPSItMSIvPgoJCQkJPF5pbmRleGVzIHZhbHVlPSIwIi8+CgkJCQk8XmxldmVsIHZhbHVlPSIyIi8+CgkJCQk8XmxpbmtzIHZhbHVlPSIwIi8+CgkJCQk8XmxvY2sgdmFsdWU9IjAiLz4KCQkJCTxebWV0aG9kcyB2YWx1ZT0iMCIvPgoJCQkJPF5taW5pbWl6ZWQgdmFsdWU9IjAiLz4KCQkJCTxecHJvcGVydGllcyB2YWx1ZT0iMCIvPgoJCQkJPF50cmlnZ2VycyB2YWx1ZT0iMCIvPgoJCQkJPF51bmlxdWVzIHZhbHVlPSIwIi8+CgkJCQk8YmFja19jb2xvciB2YWx1ZT0iQjRENjQ3MDAiLz4KCQkJCTxuYW1lIHZhbHVlPSJUYWJsZTMiLz4KCQkJCTxwb3NpdGlvbiB2YWx1ZT0iNDE2OzM5MCIvPgoJCQkJPHNpemUgdmFsdWU9IjE4NTsxNzYiLz4KCQkJPC9Qcm9wZXJ0aWVzPgoJCQk8VHlwZSB2YWx1ZT0iVGFibGUiLz4KCQk8L1RhYmxlMz4KCQk8VGFibGU0PgoJCQk8UGFyZW50IHZhbHVlPSIjVE9QIi8+CgkJCTxQcm9wZXJ0aWVzPgoJCQkJPF5jaGVja3MgdmFsdWU9IjAiLz4KCQkJCTxeZ3JvdXAgdmFsdWU9Ii0xIi8+CgkJCQk8XmhlaWdodCB2YWx1ZT0iLTEiLz4KCQkJCTxeaW5kZXhlcyB2YWx1ZT0iMCIvPgoJCQkJPF5sZXZlbCB2YWx1ZT0iMSIvPgoJCQkJPF5saW5rcyB2YWx1ZT0iMCIvPgoJCQkJPF5sb2NrIHZhbHVlPSIwIi8+CgkJCQk8Xm1ldGhvZHMgdmFsdWU9IjAiLz4KCQkJCTxebWluaW1pemVkIHZhbHVlPSIwIi8+CgkJCQk8XnByb3BlcnRpZXMgdmFsdWU9IjAiLz4KCQkJCTxedHJpZ2dlcnMgdmFsdWU9IjAiLz4KCQkJCTxedW5pcXVlcyB2YWx1ZT0iMCIvPgoJCQkJPGJhY2tfY29sb3IgdmFsdWU9IkI0RDY0NzAwIi8+CgkJCQk8bmFtZSB2YWx1ZT0iVGFibGU0Ii8+CgkJCQk8cG9zaXRpb24gdmFsdWU9IjgwOzQyNSIvPgoJCQkJPHNpemUgdmFsdWU9IjE4NTsxNTgiLz4KCQkJPC9Qcm9wZXJ0aWVzPgoJCQk8VHlwZSB2YWx1ZT0iVGFibGUiLz4KCQk8L1RhYmxlND4KCQk8ZGI0cmVzdD4KCQkJPFByb3BlcnRpZXM+CgkJCQk8XmxvY2sgdmFsdWU9IjAiLz4KCQkJCTxiYWNrX2NvbG9yIHZhbHVlPSJGRkZGRkYiLz4KCQkJCTxnYW1tYSB2YWx1ZT0iMCIvPgoJCQkJPG5hbWUgdmFsdWU9ImRiNHJlc3QiLz4KCQkJCTxzaXplIHZhbHVlPSIyMDQ4OzIwNDgiLz4KCQkJCTxzdHlsZSB2YWx1ZT0iNCIvPgoJCQkJPHN0eWxlX2xpbmtzIHZhbHVlPSIwIi8+CgkJCQk8dW5pdHMgdmFsdWU9IjUiLz4KCQkJPC9Qcm9wZXJ0aWVzPgoJCQk8VHlwZSB2YWx1ZT0iRGlhZ3JhbSIvPgoJCTwvZGI0cmVzdD4KCTwvQ29udHJvbHM+Cgk8R1VJPgoJCTxGdWxsVG9vbGJhckxlZnQgdmFsdWU9IjEiLz4KCQk8RnVsbFRvb2xiYXJSaWdodCB2YWx1ZT0iMSIvPgoJCTxQYWdlRWRpdG9yIHZhbHVlPSItMSIvPgoJCTxQYWdlRWRpdG9ySCB2YWx1ZT0iMCIvPgoJCTxQYWdlVG9vbGJhckxlZnQgdmFsdWU9IjAiLz4KCQk8UGFnZVRvb2xiYXJSQiB2YWx1ZT0iMCIvPgoJCTxQYWdlVG9vbGJhclJpZ2h0IHZhbHVlPSIwIi8+CgkJPFBhbmVDbGlwYm9hcmQgdmFsdWU9IjAiLz4KCQk8UGFuZUxheW91dCB2YWx1ZT0iMCIvPgoJCTxQYW5lVmlldyB2YWx1ZT0iMCIvPgoJCTxTY3JvbGxYIHZhbHVlPSIwIi8+CgkJPFNjcm9sbFkgdmFsdWU9IjAiLz4KCQk8U2VsZWN0aW9uIHZhbHVlPSJWR0ZpYkdVMCIvPgoJCTxTaG93QWxsIHZhbHVlPSIxIi8+CgkJPFNob3dDaGFuZ2VzIHZhbHVlPSIxIi8+CgkJPFNob3dHTCB2YWx1ZT0iMSIvPgoJCTxTaG93R3JpZCB2YWx1ZT0iMSIvPgoJCTxVc2VHcmlkIHZhbHVlPSIwIi8+Cgk8L0dVST4KCTxNb2RlbD4KCQk8ZGJfNHJlc3Q+CgkJCTxsaW5rPgoJCQkJPG8wPgoJCQkJCTxDaGFuZ2VzIHZhbHVlPSIiLz4KCQkJCQk8UHJvcGVydGllcz4KCQkJCQkJPENhcmRpbmFsaXR5IHZhbHVlPSJPTkUgdG8gTUFOWSIvPgoJCQkJCQk8Q2hpbGRfVGFibGUgdmFsdWU9ImRldHByZWNpbyIvPgoJCQkJCQk8Rm9yZWlnbl9LZXkgdmFsdWU9ImNtVnpkR0YxY21GdWRHVmZhV1E9Ii8+CgkJCQkJCTxOYW1lIHZhbHVlPSJkZXRwcmVjaW9fcmVzdGF1cmFudGVfaWRfZm9yZWlnbiIvPgoJCQkJCQk8T25fRGVsZXRlIHZhbHVlPSJSZXN0cmljdCIvPgoJCQkJCQk8T25fVXBkYXRlIHZhbHVlPSJSZXN0cmljdCIvPgoJCQkJCQk8UGFyZW50X1RhYmxlIHZhbHVlPSJyZXN0YXVyYW50ZSIvPgoJCQkJCQk8UHJpbWFyeV9LZXkgdmFsdWU9ImFXUT0iLz4KCQkJCQk8L1Byb3BlcnRpZXM+CgkJCQkJPGNvbnRyb2wgdmFsdWU9IiIvPgoJCQkJCTxkZWxldGUgdmFsdWU9IjAiLz4KCQkJCQk8bmFtZSB2YWx1ZT0iZGV0cHJlY2lvX3Jlc3RhdXJhbnRlX2lkX2ZvcmVpZ24iLz4KCQkJCTwvbzA+CgkJCQk8bzE+CgkJCQkJPENoYW5nZXMgdmFsdWU9IiIvPgoJCQkJCTxQcm9wZXJ0aWVzPgoJCQkJCQk8Q2FyZGluYWxpdHkgdmFsdWU9Ik9ORSB0byBNQU5ZIi8+CgkJCQkJCTxDaGlsZF9UYWJsZSB2YWx1ZT0iZGV0cHJlY2lvIi8+CgkJCQkJCTxGb3JlaWduX0tleSB2YWx1ZT0iY0hKbFkybHZYMmxrIi8+CgkJCQkJCTxOYW1lIHZhbHVlPSJkZXRwcmVjaW9fcHJlY2lvX2lkX2ZvcmVpZ24iLz4KCQkJCQkJPE9uX0RlbGV0ZSB2YWx1ZT0iUmVzdHJpY3QiLz4KCQkJCQkJPE9uX1VwZGF0ZSB2YWx1ZT0iUmVzdHJpY3QiLz4KCQkJCQkJPFBhcmVudF9UYWJsZSB2YWx1ZT0icHJlY2lvIi8+CgkJCQkJCTxQcmltYXJ5X0tleSB2YWx1ZT0iYVdRPSIvPgoJCQkJCTwvUHJvcGVydGllcz4KCQkJCQk8Y29udHJvbCB2YWx1ZT0iIi8+CgkJCQkJPGRlbGV0ZSB2YWx1ZT0iMCIvPgoJCQkJCTxuYW1lIHZhbHVlPSJkZXRwcmVjaW9fcHJlY2lvX2lkX2ZvcmVpZ24iLz4KCQkJCTwvbzE+CgkJCTwvbGluaz4KCQkJPHRhYmxlPgoJCQkJPG8wPgoJCQkJCTxDaGFuZ2VzIHZhbHVlPSIiLz4KCQkJCQk8UHJvcGVydGllcz4KCQkJCQkJPEF1dG9pbmNyZW1lbnQgdmFsdWU9IjMiLz4KCQkJCQkJPEF2ZXJhZ2VfUm93X1NpemUgdmFsdWU9IjE2Mzg0Ii8+CgkJCQkJCTxDaGFyc2V0IHZhbHVlPSJsYXRpbjEiLz4KCQkJCQkJPENvbGxhdGlvbiB2YWx1ZT0ibGF0aW4xX3N3ZWRpc2hfY2kiLz4KCQkJCQkJPENvbW1lbnQgdmFsdWU9IiIvPgoJCQkJCQk8Q3JlYXRlX1RpbWUgdmFsdWU9IjIwMTQtMDUtMDIgMDA6MjU6MjYiLz4KCQkJCQkJPEVuZ2luZSB2YWx1ZT0iSW5ub0RCIi8+CgkJCQkJCTxGaWVsZF9Db3VudCB2YWx1ZT0iMTciLz4KCQkJCQkJPEluZGV4X0NvdW50IHZhbHVlPSIxIi8+CgkJCQkJCTxMaW5rX0NvdW50IHZhbHVlPSI1Ii8+CgkJCQkJCTxOYW1lIHZhbHVlPSJyZXN0YXVyYW50ZSIvPgoJCQkJCQk8UHJpbWFyeV9LZXkgdmFsdWU9ImFXUT0iLz4KCQkJCQkJPFJlY29yZF9Db3VudCB2YWx1ZT0iMSIvPgoJCQkJCQk8U2l6ZSB2YWx1ZT0iMTYuMDAgS2IiLz4KCQkJCQkJPFRyaWdnZXJfQ291bnQgdmFsdWU9IjAiLz4KCQkJCQkJPFVuaXF1ZV9Db3VudCB2YWx1ZT0iMSIvPgoJCQkJCQk8VXBkYXRlX1RpbWUgdmFsdWU9IiIvPgoJCQkJCTwvUHJvcGVydGllcz4KCQkJCQk8Y29udHJvbCB2YWx1ZT0iVGFibGUiLz4KCQkJCQk8ZGVsZXRlIHZhbHVlPSIwIi8+CgkJCQkJPGZpZWxkPgoJCQkJCQk8bzA+CgkJCQkJCQk8Q2hhbmdlcyB2YWx1ZT0iIi8+CgkJCQkJCQk8UHJvcGVydGllcz4KCQkJCQkJCQk8QXV0b2luY3JlbWVudCB2YWx1ZT0iMCIvPgoJCQkJCQkJCTxDaGFyc2V0IHZhbHVlPSJsYXRpbjEiLz4KCQkJCQkJCQk8Q29sbGF0aW9uIHZhbHVlPSJsYXRpbjFfc3dlZGlzaF9jaSIvPgoJCQkJCQkJCTxDb21tZW50IHZhbHVlPSIiLz4KCQkJCQkJCQk8RGVmYXVsdF9WYWx1ZSB2YWx1ZT0iIi8+CgkJCQkJCQkJPEZpZWxkX1Bvc2l0aW9uIHZhbHVlPSIxMyIvPgoJCQkJCQkJCTxJbmRleGVkIHZhbHVlPSIwIi8+CgkJCQkJCQkJPExlbmd0aCB2YWx1ZT0iMTAwIi8+CgkJCQkJCQkJPE5hbWUgdmFsdWU9ImNlbCIvPgoJCQkJCQkJCTxOdWxsYWJsZSB2YWx1ZT0iMSIvPgoJCQkJCQkJCTxPbl9VcGRhdGVfU2V0X0N1cnJlbnQgdmFsdWU9IjAiLz4KCQkJCQkJCQk8UHJlY2lzaW9uIHZhbHVlPSIwIi8+CgkJCQkJCQkJPFNjYWxlIHZhbHVlPSIwIi8+CgkJCQkJCQkJPFR5cGUgdmFsdWU9IlZhckNoYXIiLz4KCQkJCQkJCQk8VW5pcXVlIHZhbHVlPSIwIi8+CgkJCQkJCQkJPFVuc2lnbmVkIHZhbHVlPSIwIi8+CgkJCQkJCQkJPFplcm9maWxsIHZhbHVlPSIwIi8+CgkJCQkJCQk8L1Byb3BlcnRpZXM+CgkJCQkJCQk8Y29udHJvbCB2YWx1ZT0iIi8+CgkJCQkJCQk8ZGVsZXRlIHZhbHVlPSIwIi8+CgkJCQkJCQk8bmFtZSB2YWx1ZT0iY2VsIi8+CgkJCQkJCTwvbzA+CgkJCQkJCTxvMT4KCQkJCQkJCTxDaGFuZ2VzIHZhbHVlPSIiLz4KCQkJCQkJCTxQcm9wZXJ0aWVzPgoJCQkJCQkJCTxBdXRvaW5jcmVtZW50IHZhbHVlPSIwIi8+CgkJCQkJCQkJPENoYXJzZXQgdmFsdWU9ImxhdGluMSIvPgoJCQkJCQkJCTxDb2xsYXRpb24gdmFsdWU9ImxhdGluMV9zd2VkaXNoX2NpIi8+CgkJCQkJCQkJPENvbW1lbnQgdmFsdWU9IiIvPgoJCQkJCQkJCTxEZWZhdWx0X1ZhbHVlIHZhbHVlPSIiLz4KCQkJCQkJCQk8RmllbGRfUG9zaXRpb24gdmFsdWU9IjYiLz4KCQkJCQkJCQk8SW5kZXhlZCB2YWx1ZT0iMCIvPgoJCQkJCQkJCTxMZW5ndGggdmFsdWU9Ii0xIi8+CgkJCQkJCQkJPE5hbWUgdmFsdWU9ImNvbWVudGFyaW9zIi8+CgkJCQkJCQkJPE51bGxhYmxlIHZhbHVlPSIxIi8+CgkJCQkJCQkJPE9uX1VwZGF0ZV9TZXRfQ3VycmVudCB2YWx1ZT0iMCIvPgoJCQkJCQkJCTxQcmVjaXNpb24gdmFsdWU9IjAiLz4KCQkJCQkJCQk8U2NhbGUgdmFsdWU9IjAiLz4KCQkJCQkJCQk8VHlwZSB2YWx1ZT0iVGV4dCIvPgoJCQkJCQkJCTxVbmlxdWUgdmFsdWU9IjAiLz4KCQkJCQkJCQk8VW5zaWduZWQgdmFsdWU9IjAiLz4KCQkJCQkJCQk8WmVyb2ZpbGwgdmFsdWU9IjAiLz4KCQkJCQkJCTwvUHJvcGVydGllcz4KCQkJCQkJCTxjb250cm9sIHZhbHVlPSIiLz4KCQkJCQkJCTxkZWxldGUgdmFsdWU9IjAiLz4KCQkJCQkJCTxuYW1lIHZhbHVlPSJjb21lbnRhcmlvcyIvPgoJCQkJCQk8L28xPgoJCQkJCQk8bzEwPgoJCQkJCQkJPENoYW5nZXMgdmFsdWU9IiIvPgoJCQkJCQkJPFByb3BlcnRpZXM+CgkJCQkJCQkJPEF1dG9pbmNyZW1lbnQgdmFsdWU9IjAiLz4KCQkJCQkJCQk8Q2hhcnNldCB2YWx1ZT0ibGF0aW4xIi8+CgkJCQkJCQkJPENvbGxhdGlvbiB2YWx1ZT0ibGF0aW4xX3N3ZWRpc2hfY2kiLz4KCQkJCQkJCQk8Q29tbWVudCB2YWx1ZT0iIi8+CgkJCQkJCQkJPERlZmF1bHRfVmFsdWUgdmFsdWU9IiIvPgoJCQkJCQkJCTxGaWVsZF9Qb3NpdGlvbiB2YWx1ZT0iOCIvPgoJCQkJCQkJCTxJbmRleGVkIHZhbHVlPSIwIi8+CgkJCQkJCQkJPExlbmd0aCB2YWx1ZT0iNTAiLz4KCQkJCQkJCQk8TmFtZSB2YWx1ZT0icGFpcyIvPgoJCQkJCQkJCTxOdWxsYWJsZSB2YWx1ZT0iMSIvPgoJCQkJCQkJCTxPbl9VcGRhdGVfU2V0X0N1cnJlbnQgdmFsdWU9IjAiLz4KCQkJCQkJCQk8UHJlY2lzaW9uIHZhbHVlPSIwIi8+CgkJCQkJCQkJPFNjYWxlIHZhbHVlPSIwIi8+CgkJCQkJCQkJPFR5cGUgdmFsdWU9IlZhckNoYXIiLz4KCQkJCQkJCQk8VW5pcXVlIHZhbHVlPSIwIi8+CgkJCQkJCQkJPFVuc2lnbmVkIHZhbHVlPSIwIi8+CgkJCQkJCQkJPFplcm9maWxsIHZhbHVlPSIwIi8+CgkJCQkJCQk8L1Byb3BlcnRpZXM+CgkJCQkJCQk8Y29udHJvbCB2YWx1ZT0iIi8+CgkJCQkJCQk8ZGVsZXRlIHZhbHVlPSIwIi8+CgkJCQkJCQk8bmFtZSB2YWx1ZT0icGFpcyIvPgoJCQkJCQk8L28xMD4KCQkJCQkJPG8xMT4KCQkJCQkJCTxDaGFuZ2VzIHZhbHVlPSIiLz4KCQkJCQkJCTxQcm9wZXJ0aWVzPgoJCQkJCQkJCTxBdXRvaW5jcmVtZW50IHZhbHVlPSIwIi8+CgkJCQkJCQkJPENoYXJzZXQgdmFsdWU9ImxhdGluMSIvPgoJCQkJCQkJCTxDb2xsYXRpb24gdmFsdWU9ImxhdGluMV9zd2VkaXNoX2NpIi8+CgkJCQkJCQkJPENvbW1lbnQgdmFsdWU9IiIvPgoJCQkJCQkJCTxEZWZhdWx0X1ZhbHVlIHZhbHVlPSIiLz4KCQkJCQkJCQk8RmllbGRfUG9zaXRpb24gdmFsdWU9IjEwIi8+CgkJCQkJCQkJPEluZGV4ZWQgdmFsdWU9IjAiLz4KCQkJCQkJCQk8TGVuZ3RoIHZhbHVlPSI1MCIvPgoJCQkJCQkJCTxOYW1lIHZhbHVlPSJwcm92aW5jaWEiLz4KCQkJCQkJCQk8TnVsbGFibGUgdmFsdWU9IjEiLz4KCQkJCQkJCQk8T25fVXBkYXRlX1NldF9DdXJyZW50IHZhbHVlPSIwIi8+CgkJCQkJCQkJPFByZWNpc2lvbiB2YWx1ZT0iMCIvPgoJCQkJCQkJCTxTY2FsZSB2YWx1ZT0iMCIvPgoJCQkJCQkJCTxUeXBlIHZhbHVlPSJWYXJDaGFyIi8+CgkJCQkJCQkJPFVuaXF1ZSB2YWx1ZT0iMCIvPgoJCQkJCQkJCTxVbnNpZ25lZCB2YWx1ZT0iMCIvPgoJCQkJCQkJCTxaZXJvZmlsbCB2YWx1ZT0iMCIvPgoJCQkJCQkJPC9Qcm9wZXJ0aWVzPgoJCQkJCQkJPGNvbnRyb2wgdmFsdWU9IiIvPgoJCQkJCQkJPGRlbGV0ZSB2YWx1ZT0iMCIvPgoJCQkJCQkJPG5hbWUgdmFsdWU9InByb3ZpbmNpYSIvPgoJCQkJCQk8L28xMT4KCQkJCQkJPG8xMj4KCQkJCQkJCTxDaGFuZ2VzIHZhbHVlPSIiLz4KCQkJCQkJCTxQcm9wZXJ0aWVzPgoJCQkJCQkJCTxBdXRvaW5jcmVtZW50IHZhbHVlPSIwIi8+CgkJCQkJCQkJPENoYXJzZXQgdmFsdWU9ImxhdGluMSIvPgoJCQkJCQkJCTxDb2xsYXRpb24gdmFsdWU9ImxhdGluMV9zd2VkaXNoX2NpIi8+CgkJCQkJCQkJPENvbW1lbnQgdmFsdWU9IiIvPgoJCQkJCQkJCTxEZWZhdWx0X1ZhbHVlIHZhbHVlPSIiLz4KCQkJCQkJCQk8RmllbGRfUG9zaXRpb24gdmFsdWU9IjMiLz4KCQkJCQkJCQk8SW5kZXhlZCB2YWx1ZT0iMCIvPgoJCQkJCQkJCTxMZW5ndGggdmFsdWU9IjIwMCIvPgoJCQkJCQkJCTxOYW1lIHZhbHVlPSJyYXpvblNvY2lhbCIvPgoJCQkJCQkJCTxOdWxsYWJsZSB2YWx1ZT0iMSIvPgoJCQkJCQkJCTxPbl9VcGRhdGVfU2V0X0N1cnJlbnQgdmFsdWU9IjAiLz4KCQkJCQkJCQk8UHJlY2lzaW9uIHZhbHVlPSIwIi8+CgkJCQkJCQkJPFNjYWxlIHZhbHVlPSIwIi8+CgkJCQkJCQkJPFR5cGUgdmFsdWU9IlZhckNoYXIiLz4KCQkJCQkJCQk8VW5pcXVlIHZhbHVlPSIwIi8+CgkJCQkJCQkJPFVuc2lnbmVkIHZhbHVlPSIwIi8+CgkJCQkJCQkJPFplcm9maWxsIHZhbHVlPSIwIi8+CgkJCQkJCQk8L1Byb3BlcnRpZXM+CgkJCQkJCQk8Y29udHJvbCB2YWx1ZT0iIi8+CgkJCQkJCQk8ZGVsZXRlIHZhbHVlPSIwIi8+CgkJCQkJCQk8bmFtZSB2YWx1ZT0icmF6b25Tb2NpYWwiLz4KCQkJCQkJPC9vMTI+CgkJCQkJCTxvMTM+CgkJCQkJCQk8Q2hhbmdlcyB2YWx1ZT0iIi8+CgkJCQkJCQk8UHJvcGVydGllcz4KCQkJCQkJCQk8QXV0b2luY3JlbWVudCB2YWx1ZT0iMCIvPgoJCQkJCQkJCTxDaGFyc2V0IHZhbHVlPSJsYXRpbjEiLz4KCQkJCQkJCQk8Q29sbGF0aW9uIHZhbHVlPSJsYXRpbjFfc3dlZGlzaF9jaSIvPgoJCQkJCQkJCTxDb21tZW50IHZhbHVlPSIiLz4KCQkJCQkJCQk8RGVmYXVsdF9WYWx1ZSB2YWx1ZT0iIi8+CgkJCQkJCQkJPEZpZWxkX1Bvc2l0aW9uIHZhbHVlPSI0Ii8+CgkJCQkJCQkJPEluZGV4ZWQgdmFsdWU9IjAiLz4KCQkJCQkJCQk8TGVuZ3RoIHZhbHVlPSIxMSIvPgoJCQkJCQkJCTxOYW1lIHZhbHVlPSJydWMiLz4KCQkJCQkJCQk8TnVsbGFibGUgdmFsdWU9IjEiLz4KCQkJCQkJCQk8T25fVXBkYXRlX1NldF9DdXJyZW50IHZhbHVlPSIwIi8+CgkJCQkJCQkJPFByZWNpc2lvbiB2YWx1ZT0iMCIvPgoJCQkJCQkJCTxTY2FsZSB2YWx1ZT0iMCIvPgoJCQkJCQkJCTxUeXBlIHZhbHVlPSJWYXJDaGFyIi8+CgkJCQkJCQkJPFVuaXF1ZSB2YWx1ZT0iMCIvPgoJCQkJCQkJCTxVbnNpZ25lZCB2YWx1ZT0iMCIvPgoJCQkJCQkJCTxaZXJvZmlsbCB2YWx1ZT0iMCIvPgoJCQkJCQkJPC9Qcm9wZXJ0aWVzPgoJCQkJCQkJPGNvbnRyb2wgdmFsdWU9IiIvPgoJCQkJCQkJPGRlbGV0ZSB2YWx1ZT0iMCIvPgoJCQkJCQkJPG5hbWUgdmFsdWU9InJ1YyIvPgoJCQkJCQk8L28xMz4KCQkJCQkJPG8xND4KCQkJCQkJCTxDaGFuZ2VzIHZhbHVlPSIiLz4KCQkJCQkJCTxQcm9wZXJ0aWVzPgoJCQkJCQkJCTxBdXRvaW5jcmVtZW50IHZhbHVlPSIwIi8+CgkJCQkJCQkJPENoYXJzZXQgdmFsdWU9ImxhdGluMSIvPgoJCQkJCQkJCTxDb2xsYXRpb24gdmFsdWU9ImxhdGluMV9zd2VkaXNoX2NpIi8+CgkJCQkJCQkJPENvbW1lbnQgdmFsdWU9IiIvPgoJCQkJCQkJCTxEZWZhdWx0X1ZhbHVlIHZhbHVlPSIiLz4KCQkJCQkJCQk8RmllbGRfUG9zaXRpb24gdmFsdWU9IjE2Ii8+CgkJCQkJCQkJPEluZGV4ZWQgdmFsdWU9IjAiLz4KCQkJCQkJCQk8TGVuZ3RoIHZhbHVlPSIyNTUiLz4KCQkJCQkJCQk8TmFtZSB2YWx1ZT0ic2VyaWUiLz4KCQkJCQkJCQk8TnVsbGFibGUgdmFsdWU9IjAiLz4KCQkJCQkJCQk8T25fVXBkYXRlX1NldF9DdXJyZW50IHZhbHVlPSIwIi8+CgkJCQkJCQkJPFByZWNpc2lvbiB2YWx1ZT0iMCIvPgoJCQkJCQkJCTxTY2FsZSB2YWx1ZT0iMCIvPgoJCQkJCQkJCTxUeXBlIHZhbHVlPSJWYXJDaGFyIi8+CgkJCQkJCQkJPFVuaXF1ZSB2YWx1ZT0iMCIvPgoJCQkJCQkJCTxVbnNpZ25lZCB2YWx1ZT0iMCIvPgoJCQkJCQkJCTxaZXJvZmlsbCB2YWx1ZT0iMCIvPgoJCQkJCQkJPC9Qcm9wZXJ0aWVzPgoJCQkJCQkJPGNvbnRyb2wgdmFsdWU9IiIvPgoJCQkJCQkJPGRlbGV0ZSB2YWx1ZT0iMCIvPgoJCQkJCQkJPG5hbWUgdmFsdWU9InNlcmllIi8+CgkJCQkJCTwvbzE0PgoJCQkJCQk8bzE1PgoJCQkJCQkJPENoYW5nZXMgdmFsdWU9IiIvPgoJCQkJCQkJPFByb3BlcnRpZXM+CgkJCQkJCQkJPEF1dG9pbmNyZW1lbnQgdmFsdWU9IjAiLz4KCQkJCQkJCQk8Q2hhcnNldCB2YWx1ZT0ibGF0aW4xIi8+CgkJCQkJCQkJPENvbGxhdGlvbiB2YWx1ZT0ibGF0aW4xX3N3ZWRpc2hfY2kiLz4KCQkJCQkJCQk8Q29tbWVudCB2YWx1ZT0iIi8+CgkJCQkJCQkJPERlZmF1bHRfVmFsdWUgdmFsdWU9IiIvPgoJCQkJCQkJCTxGaWVsZF9Qb3NpdGlvbiB2YWx1ZT0iMTEiLz4KCQkJCQkJCQk8SW5kZXhlZCB2YWx1ZT0iMCIvPgoJCQkJCQkJCTxMZW5ndGggdmFsdWU9IjEwMCIvPgoJCQkJCQkJCTxOYW1lIHZhbHVlPSJ0ZWwiLz4KCQkJCQkJCQk8TnVsbGFibGUgdmFsdWU9IjEiLz4KCQkJCQkJCQk8T25fVXBkYXRlX1NldF9DdXJyZW50IHZhbHVlPSIwIi8+CgkJCQkJCQkJPFByZWNpc2lvbiB2YWx1ZT0iMCIvPgoJCQkJCQkJCTxTY2FsZSB2YWx1ZT0iMCIvPgoJCQkJCQkJCTxUeXBlIHZhbHVlPSJWYXJDaGFyIi8+CgkJCQkJCQkJPFVuaXF1ZSB2YWx1ZT0iMCIvPgoJCQkJCQkJCTxVbnNpZ25lZCB2YWx1ZT0iMCIvPgoJCQkJCQkJCTxaZXJvZmlsbCB2YWx1ZT0iMCIvPgoJCQkJCQkJPC9Qcm9wZXJ0aWVzPgoJCQkJCQkJPGNvbnRyb2wgdmFsdWU9IiIvPgoJCQkJCQkJPGRlbGV0ZSB2YWx1ZT0iMCIvPgoJCQkJCQkJPG5hbWUgdmFsdWU9InRlbCIvPgoJCQkJCQk8L28xNT4KCQkJCQkJPG8xNj4KCQkJCQkJCTxDaGFuZ2VzIHZhbHVlPSIiLz4KCQkJCQkJCTxQcm9wZXJ0aWVzPgoJCQkJCQkJCTxBdXRvaW5jcmVtZW50IHZhbHVlPSIwIi8+CgkJCQkJCQkJPENoYXJzZXQgdmFsdWU9IiIvPgoJCQkJCQkJCTxDb2xsYXRpb24gdmFsdWU9IiIvPgoJCQkJCQkJCTxDb21tZW50IHZhbHVlPSIiLz4KCQkJCQkJCQk8RGVmYXVsdF9WYWx1ZSB2YWx1ZT0iIi8+CgkJCQkJCQkJPEZpZWxkX1Bvc2l0aW9uIHZhbHVlPSIxNSIvPgoJCQkJCQkJCTxJbmRleGVkIHZhbHVlPSIwIi8+CgkJCQkJCQkJPExlbmd0aCB2YWx1ZT0iLTEiLz4KCQkJCQkJCQk8TmFtZSB2YWx1ZT0idXBkYXRlZF9hdCIvPgoJCQkJCQkJCTxOdWxsYWJsZSB2YWx1ZT0iMSIvPgoJCQkJCQkJCTxPbl9VcGRhdGVfU2V0X0N1cnJlbnQgdmFsdWU9IjAiLz4KCQkJCQkJCQk8UHJlY2lzaW9uIHZhbHVlPSIwIi8+CgkJCQkJCQkJPFNjYWxlIHZhbHVlPSIwIi8+CgkJCQkJCQkJPFR5cGUgdmFsdWU9IlRpbWVzdGFtcCIvPgoJCQkJCQkJCTxVbmlxdWUgdmFsdWU9IjAiLz4KCQkJCQkJCQk8VW5zaWduZWQgdmFsdWU9IjAiLz4KCQkJCQkJCQk8WmVyb2ZpbGwgdmFsdWU9IjAiLz4KCQkJCQkJCTwvUHJvcGVydGllcz4KCQkJCQkJCTxjb250cm9sIHZhbHVlPSIiLz4KCQkJCQkJCTxkZWxldGUgdmFsdWU9IjAiLz4KCQkJCQkJCTxuYW1lIHZhbHVlPSJ1cGRhdGVkX2F0Ii8+CgkJCQkJCTwvbzE2PgoJCQkJCQk8bzI+CgkJCQkJCQk8Q2hhbmdlcyB2YWx1ZT0iIi8+CgkJCQkJCQk8UHJvcGVydGllcz4KCQkJCQkJCQk8QXV0b2luY3JlbWVudCB2YWx1ZT0iMCIvPgoJCQkJCQkJCTxDaGFyc2V0IHZhbHVlPSIiLz4KCQkJCQkJCQk8Q29sbGF0aW9uIHZhbHVlPSIiLz4KCQkJCQkJCQk8Q29tbWVudCB2YWx1ZT0iIi8+CgkJCQkJCQkJPERlZmF1bHRfVmFsdWUgdmFsdWU9IiIvPgoJCQkJCQkJCTxGaWVsZF9Qb3NpdGlvbiB2YWx1ZT0iMTQiLz4KCQkJCQkJCQk8SW5kZXhlZCB2YWx1ZT0iMCIvPgoJCQkJCQkJCTxMZW5ndGggdmFsdWU9Ii0xIi8+CgkJCQkJCQkJPE5hbWUgdmFsdWU9ImNyZWF0ZWRfYXQiLz4KCQkJCQkJCQk8TnVsbGFibGUgdmFsdWU9IjEiLz4KCQkJCQkJCQk8T25fVXBkYXRlX1NldF9DdXJyZW50IHZhbHVlPSIwIi8+CgkJCQkJCQkJPFByZWNpc2lvbiB2YWx1ZT0iMCIvPgoJCQkJCQkJCTxTY2FsZSB2YWx1ZT0iMCIvPgoJCQkJCQkJCTxUeXBlIHZhbHVlPSJUaW1lc3RhbXAiLz4KCQkJCQkJCQk8VW5pcXVlIHZhbHVlPSIwIi8+CgkJCQkJCQkJPFVuc2lnbmVkIHZhbHVlPSIwIi8+CgkJCQkJCQkJPFplcm9maWxsIHZhbHVlPSIwIi8+CgkJCQkJCQk8L1Byb3BlcnRpZXM+CgkJCQkJCQk8Y29udHJvbCB2YWx1ZT0iIi8+CgkJCQkJCQk8ZGVsZXRlIHZhbHVlPSIwIi8+CgkJCQkJCQk8bmFtZSB2YWx1ZT0iY3JlYXRlZF9hdCIvPgoJCQkJCQk8L28yPgoJCQkJCQk8bzM+CgkJCQkJCQk8Q2hhbmdlcyB2YWx1ZT0iIi8+CgkJCQkJCQk8UHJvcGVydGllcz4KCQkJCQkJCQk8QXV0b2luY3JlbWVudCB2YWx1ZT0iMCIvPgoJCQkJCQkJCTxDaGFyc2V0IHZhbHVlPSJsYXRpbjEiLz4KCQkJCQkJCQk8Q29sbGF0aW9uIHZhbHVlPSJsYXRpbjFfc3dlZGlzaF9jaSIvPgoJCQkJCQkJCTxDb21tZW50IHZhbHVlPSIiLz4KCQkJCQkJCQk8RGVmYXVsdF9WYWx1ZSB2YWx1ZT0iIi8+CgkJCQkJCQkJPEZpZWxkX1Bvc2l0aW9uIHZhbHVlPSI5Ii8+CgkJCQkJCQkJPEluZGV4ZWQgdmFsdWU9IjAiLz4KCQkJCQkJCQk8TGVuZ3RoIHZhbHVlPSI1MCIvPgoJCQkJCQkJCTxOYW1lIHZhbHVlPSJkZXBhcnRhbWVudG8iLz4KCQkJCQkJCQk8TnVsbGFibGUgdmFsdWU9IjEiLz4KCQkJCQkJCQk8T25fVXBkYXRlX1NldF9DdXJyZW50IHZhbHVlPSIwIi8+CgkJCQkJCQkJPFByZWNpc2lvbiB2YWx1ZT0iMCIvPgoJCQkJCQkJCTxTY2FsZSB2YWx1ZT0iMCIvPgoJCQkJCQkJCTxUeXBlIHZhbHVlPSJWYXJDaGFyIi8+CgkJCQkJCQkJPFVuaXF1ZSB2YWx1ZT0iMCIvPgoJCQkJCQkJCTxVbnNpZ25lZCB2YWx1ZT0iMCIvPgoJCQkJCQkJCTxaZXJvZmlsbCB2YWx1ZT0iMCIvPgoJCQkJCQkJPC9Qcm9wZXJ0aWVzPgoJCQkJCQkJPGNvbnRyb2wgdmFsdWU9IiIvPgoJCQkJCQkJPGRlbGV0ZSB2YWx1ZT0iMCIvPgoJCQkJCQkJPG5hbWUgdmFsdWU9ImRlcGFydGFtZW50byIvPgoJCQkJCQk8L28zPgoJCQkJCQk8bzQ+CgkJCQkJCQk8Q2hhbmdlcyB2YWx1ZT0iIi8+CgkJCQkJCQk8UHJvcGVydGllcz4KCQkJCQkJCQk8QXV0b2luY3JlbWVudCB2YWx1ZT0iMCIvPgoJCQkJCQkJCTxDaGFyc2V0IHZhbHVlPSJsYXRpbjEiLz4KCQkJCQkJCQk8Q29sbGF0aW9uIHZhbHVlPSJsYXRpbjFfc3dlZGlzaF9jaSIvPgoJCQkJCQkJCTxDb21tZW50IHZhbHVlPSIiLz4KCQkJCQkJCQk8RGVmYXVsdF9WYWx1ZSB2YWx1ZT0iIi8+CgkJCQkJCQkJPEZpZWxkX1Bvc2l0aW9uIHZhbHVlPSI1Ii8+CgkJCQkJCQkJPEluZGV4ZWQgdmFsdWU9IjAiLz4KCQkJCQkJCQk8TGVuZ3RoIHZhbHVlPSIyMDAiLz4KCQkJCQkJCQk8TmFtZSB2YWx1ZT0iZGlyZWNjaW9uIi8+CgkJCQkJCQkJPE51bGxhYmxlIHZhbHVlPSIxIi8+CgkJCQkJCQkJPE9uX1VwZGF0ZV9TZXRfQ3VycmVudCB2YWx1ZT0iMCIvPgoJCQkJCQkJCTxQcmVjaXNpb24gdmFsdWU9IjAiLz4KCQkJCQkJCQk8U2NhbGUgdmFsdWU9IjAiLz4KCQkJCQkJCQk8VHlwZSB2YWx1ZT0iVmFyQ2hhciIvPgoJCQkJCQkJCTxVbmlxdWUgdmFsdWU9IjAiLz4KCQkJCQkJCQk8VW5zaWduZWQgdmFsdWU9IjAiLz4KCQkJCQkJCQk8WmVyb2ZpbGwgdmFsdWU9IjAiLz4KCQkJCQkJCTwvUHJvcGVydGllcz4KCQkJCQkJCTxjb250cm9sIHZhbHVlPSIiLz4KCQkJCQkJCTxkZWxldGUgdmFsdWU9IjAiLz4KCQkJCQkJCTxuYW1lIHZhbHVlPSJkaXJlY2Npb24iLz4KCQkJCQkJPC9vND4KCQkJCQkJPG81PgoJCQkJCQkJPENoYW5nZXMgdmFsdWU9IiIvPgoJCQkJCQkJPFByb3BlcnRpZXM+CgkJCQkJCQkJPEF1dG9pbmNyZW1lbnQgdmFsdWU9IjAiLz4KCQkJCQkJCQk8Q2hhcnNldCB2YWx1ZT0ibGF0aW4xIi8+CgkJCQkJCQkJPENvbGxhdGlvbiB2YWx1ZT0ibGF0aW4xX3N3ZWRpc2hfY2kiLz4KCQkJCQkJCQk8Q29tbWVudCB2YWx1ZT0iIi8+CgkJCQkJCQkJPERlZmF1bHRfVmFsdWUgdmFsdWU9IiIvPgoJCQkJCQkJCTxGaWVsZF9Qb3NpdGlvbiB2YWx1ZT0iMTIiLz4KCQkJCQkJCQk8SW5kZXhlZCB2YWx1ZT0iMCIvPgoJCQkJCQkJCTxMZW5ndGggdmFsdWU9IjEwMCIvPgoJCQkJCQkJCTxOYW1lIHZhbHVlPSJmYXgiLz4KCQkJCQkJCQk8TnVsbGFibGUgdmFsdWU9IjEiLz4KCQkJCQkJCQk8T25fVXBkYXRlX1NldF9DdXJyZW50IHZhbHVlPSIwIi8+CgkJCQkJCQkJPFByZWNpc2lvbiB2YWx1ZT0iMCIvPgoJCQkJCQkJCTxTY2FsZSB2YWx1ZT0iMCIvPgoJCQkJCQkJCTxUeXBlIHZhbHVlPSJWYXJDaGFyIi8+CgkJCQkJCQkJPFVuaXF1ZSB2YWx1ZT0iMCIvPgoJCQkJCQkJCTxVbnNpZ25lZCB2YWx1ZT0iMCIvPgoJCQkJCQkJCTxaZXJvZmlsbCB2YWx1ZT0iMCIvPgoJCQkJCQkJPC9Qcm9wZXJ0aWVzPgoJCQkJCQkJPGNvbnRyb2wgdmFsdWU9IiIvPgoJCQkJCQkJPGRlbGV0ZSB2YWx1ZT0iMCIvPgoJCQkJCQkJPG5hbWUgdmFsdWU9ImZheCIvPgoJCQkJCQk8L281PgoJCQkJCQk8bzY+CgkJCQkJCQk8Q2hhbmdlcyB2YWx1ZT0iIi8+CgkJCQkJCQk8UHJvcGVydGllcz4KCQkJCQkJCQk8QXV0b2luY3JlbWVudCB2YWx1ZT0iMSIvPgoJCQkJCQkJCTxDaGFyc2V0IHZhbHVlPSIiLz4KCQkJCQkJCQk8Q29sbGF0aW9uIHZhbHVlPSIiLz4KCQkJCQkJCQk8Q29tbWVudCB2YWx1ZT0iIi8+CgkJCQkJCQkJPERlZmF1bHRfVmFsdWUgdmFsdWU9IiIvPgoJCQkJCQkJCTxGaWVsZF9Qb3NpdGlvbiB2YWx1ZT0iMSIvPgoJCQkJCQkJCTxJbmRleGVkIHZhbHVlPSIxIi8+CgkJCQkJCQkJPExlbmd0aCB2YWx1ZT0iMTEiLz4KCQkJCQkJCQk8TmFtZSB2YWx1ZT0iaWQiLz4KCQkJCQkJCQk8TnVsbGFibGUgdmFsdWU9IjAiLz4KCQkJCQkJCQk8T25fVXBkYXRlX1NldF9DdXJyZW50IHZhbHVlPSIwIi8+CgkJCQkJCQkJPFByZWNpc2lvbiB2YWx1ZT0iMTAiLz4KCQkJCQkJCQk8U2NhbGUgdmFsdWU9IjAiLz4KCQkJCQkJCQk8VHlwZSB2YWx1ZT0iSW50Ii8+CgkJCQkJCQkJPFVuaXF1ZSB2YWx1ZT0iMSIvPgoJCQkJCQkJCTxVbnNpZ25lZCB2YWx1ZT0iMCIvPgoJCQkJCQkJCTxaZXJvZmlsbCB2YWx1ZT0iMCIvPgoJCQkJCQkJPC9Qcm9wZXJ0aWVzPgoJCQkJCQkJPGNvbnRyb2wgdmFsdWU9IiIvPgoJCQkJCQkJPGRlbGV0ZSB2YWx1ZT0iMCIvPgoJCQkJCQkJPG5hbWUgdmFsdWU9ImlkIi8+CgkJCQkJCTwvbzY+CgkJCQkJCTxvNz4KCQkJCQkJCTxDaGFuZ2VzIHZhbHVlPSIiLz4KCQkJCQkJCTxQcm9wZXJ0aWVzPgoJCQkJCQkJCTxBdXRvaW5jcmVtZW50IHZhbHVlPSIwIi8+CgkJCQkJCQkJPENoYXJzZXQgdmFsdWU9ImxhdGluMSIvPgoJCQkJCQkJCTxDb2xsYXRpb24gdmFsdWU9ImxhdGluMV9zd2VkaXNoX2NpIi8+CgkJCQkJCQkJPENvbW1lbnQgdmFsdWU9IiIvPgoJCQkJCQkJCTxEZWZhdWx0X1ZhbHVlIHZhbHVlPSIiLz4KCQkJCQkJCQk8RmllbGRfUG9zaXRpb24gdmFsdWU9IjciLz4KCQkJCQkJCQk8SW5kZXhlZCB2YWx1ZT0iMCIvPgoJCQkJCQkJCTxMZW5ndGggdmFsdWU9Ii0xIi8+CgkJCQkJCQkJPE5hbWUgdmFsdWU9ImltYWdlbiIvPgoJCQkJCQkJCTxOdWxsYWJsZSB2YWx1ZT0iMSIvPgoJCQkJCQkJCTxPbl9VcGRhdGVfU2V0X0N1cnJlbnQgdmFsdWU9IjAiLz4KCQkJCQkJCQk8UHJlY2lzaW9uIHZhbHVlPSIwIi8+CgkJCQkJCQkJPFNjYWxlIHZhbHVlPSIwIi8+CgkJCQkJCQkJPFR5cGUgdmFsdWU9IlRleHQiLz4KCQkJCQkJCQk8VW5pcXVlIHZhbHVlPSIwIi8+CgkJCQkJCQkJPFVuc2lnbmVkIHZhbHVlPSIwIi8+CgkJCQkJCQkJPFplcm9maWxsIHZhbHVlPSIwIi8+CgkJCQkJCQk8L1Byb3BlcnRpZXM+CgkJCQkJCQk8Y29udHJvbCB2YWx1ZT0iIi8+CgkJCQkJCQk8ZGVsZXRlIHZhbHVlPSIwIi8+CgkJCQkJCQk8bmFtZSB2YWx1ZT0iaW1hZ2VuIi8+CgkJCQkJCTwvbzc+CgkJCQkJCTxvOD4KCQkJCQkJCTxDaGFuZ2VzIHZhbHVlPSIiLz4KCQkJCQkJCTxQcm9wZXJ0aWVzPgoJCQkJCQkJCTxBdXRvaW5jcmVtZW50IHZhbHVlPSIwIi8+CgkJCQkJCQkJPENoYXJzZXQgdmFsdWU9ImxhdGluMSIvPgoJCQkJCQkJCTxDb2xsYXRpb24gdmFsdWU9ImxhdGluMV9zd2VkaXNoX2NpIi8+CgkJCQkJCQkJPENvbW1lbnQgdmFsdWU9IiIvPgoJCQkJCQkJCTxEZWZhdWx0X1ZhbHVlIHZhbHVlPSIiLz4KCQkJCQkJCQk8RmllbGRfUG9zaXRpb24gdmFsdWU9IjIiLz4KCQkJCQkJCQk8SW5kZXhlZCB2YWx1ZT0iMCIvPgoJCQkJCQkJCTxMZW5ndGggdmFsdWU9IjIwMCIvPgoJCQkJCQkJCTxOYW1lIHZhbHVlPSJub21icmVDb21lcmNpYWwiLz4KCQkJCQkJCQk8TnVsbGFibGUgdmFsdWU9IjEiLz4KCQkJCQkJCQk8T25fVXBkYXRlX1NldF9DdXJyZW50IHZhbHVlPSIwIi8+CgkJCQkJCQkJPFByZWNpc2lvbiB2YWx1ZT0iMCIvPgoJCQkJCQkJCTxTY2FsZSB2YWx1ZT0iMCIvPgoJCQkJCQkJCTxUeXBlIHZhbHVlPSJWYXJDaGFyIi8+CgkJCQkJCQkJPFVuaXF1ZSB2YWx1ZT0iMCIvPgoJCQkJCQkJCTxVbnNpZ25lZCB2YWx1ZT0iMCIvPgoJCQkJCQkJCTxaZXJvZmlsbCB2YWx1ZT0iMCIvPgoJCQkJCQkJPC9Qcm9wZXJ0aWVzPgoJCQkJCQkJPGNvbnRyb2wgdmFsdWU9IiIvPgoJCQkJCQkJPGRlbGV0ZSB2YWx1ZT0iMCIvPgoJCQkJCQkJPG5hbWUgdmFsdWU9Im5vbWJyZUNvbWVyY2lhbCIvPgoJCQkJCQk8L284PgoJCQkJCQk8bzk+CgkJCQkJCQk8Q2hhbmdlcyB2YWx1ZT0iIi8+CgkJCQkJCQk8UHJvcGVydGllcz4KCQkJCQkJCQk8QXV0b2luY3JlbWVudCB2YWx1ZT0iMCIvPgoJCQkJCQkJCTxDaGFyc2V0IHZhbHVlPSJsYXRpbjEiLz4KCQkJCQkJCQk8Q29sbGF0aW9uIHZhbHVlPSJsYXRpbjFfc3dlZGlzaF9jaSIvPgoJCQkJCQkJCTxDb21tZW50IHZhbHVlPSIiLz4KCQkJCQkJCQk8RGVmYXVsdF9WYWx1ZSB2YWx1ZT0iIi8+CgkJCQkJCQkJPEZpZWxkX1Bvc2l0aW9uIHZhbHVlPSIxNyIvPgoJCQkJCQkJCTxJbmRleGVkIHZhbHVlPSIwIi8+CgkJCQkJCQkJPExlbmd0aCB2YWx1ZT0iMjU1Ii8+CgkJCQkJCQkJPE5hbWUgdmFsdWU9Im51bWVyb2RldGlja2V0Ii8+CgkJCQkJCQkJPE51bGxhYmxlIHZhbHVlPSIwIi8+CgkJCQkJCQkJPE9uX1VwZGF0ZV9TZXRfQ3VycmVudCB2YWx1ZT0iMCIvPgoJCQkJCQkJCTxQcmVjaXNpb24gdmFsdWU9IjAiLz4KCQkJCQkJCQk8U2NhbGUgdmFsdWU9IjAiLz4KCQkJCQkJCQk8VHlwZSB2YWx1ZT0iVmFyQ2hhciIvPgoJCQkJCQkJCTxVbmlxdWUgdmFsdWU9IjAiLz4KCQkJCQkJCQk8VW5zaWduZWQgdmFsdWU9IjAiLz4KCQkJCQkJCQk8WmVyb2ZpbGwgdmFsdWU9IjAiLz4KCQkJCQkJCTwvUHJvcGVydGllcz4KCQkJCQkJCTxjb250cm9sIHZhbHVlPSIiLz4KCQkJCQkJCTxkZWxldGUgdmFsdWU9IjAiLz4KCQkJCQkJCTxuYW1lIHZhbHVlPSJudW1lcm9kZXRpY2tldCIvPgoJCQkJCQk8L285PgoJCQkJCTwvZmllbGQ+CgkJCQkJPGluZGV4PgoJCQkJCQk8bzA+CgkJCQkJCQk8Q2hhbmdlcyB2YWx1ZT0iIi8+CgkJCQkJCQk8UHJvcGVydGllcz4KCQkJCQkJCQk8Q29tbWVudCB2YWx1ZT0iIi8+CgkJCQkJCQkJPEZpZWxkcyB2YWx1ZT0iYVdRPSIvPgoJCQkJCQkJCTxOYW1lIHZhbHVlPSJQUklNQVJZIi8+CgkJCQkJCQkJPFR5cGUgdmFsdWU9IkJUUkVFIi8+CgkJCQkJCQkJPFVuaXF1ZSB2YWx1ZT0iMSIvPgoJCQkJCQkJPC9Qcm9wZXJ0aWVzPgoJCQkJCQkJPGNvbnRyb2wgdmFsdWU9IiIvPgoJCQkJCQkJPGRlbGV0ZSB2YWx1ZT0iMCIvPgoJCQkJCQkJPG5hbWUgdmFsdWU9IlBSSU1BUlkiLz4KCQkJCQkJPC9vMD4KCQkJCQk8L2luZGV4PgoJCQkJCTxuYW1lIHZhbHVlPSJyZXN0YXVyYW50ZSIvPgoJCQkJCTx1bmlxdWU+CgkJCQkJCTxvMD4KCQkJCQkJCTxDaGFuZ2VzIHZhbHVlPSIiLz4KCQkJCQkJCTxQcm9wZXJ0aWVzPgoJCQkJCQkJCTxGaWVsZHMgdmFsdWU9ImFXUT0iLz4KCQkJCQkJCQk8TmFtZSB2YWx1ZT0iUFJJTUFSWSIvPgoJCQkJCQkJPC9Qcm9wZXJ0aWVzPgoJCQkJCQkJPGNvbnRyb2wgdmFsdWU9IiIvPgoJCQkJCQkJPGRlbGV0ZSB2YWx1ZT0iMCIvPgoJCQkJCQkJPG5hbWUgdmFsdWU9IlBSSU1BUlkiLz4KCQkJCQkJPC9vMD4KCQkJCQk8L3VuaXF1ZT4KCQkJCTwvbzA+CgkJCQk8bzE+CgkJCQkJPENoYW5nZXMgdmFsdWU9IiIvPgoJCQkJCTxQcm9wZXJ0aWVzPgoJCQkJCQk8QXV0b2luY3JlbWVudCB2YWx1ZT0iMSIvPgoJCQkJCQk8QXZlcmFnZV9Sb3dfU2l6ZSB2YWx1ZT0iMCIvPgoJCQkJCQk8Q2hhcnNldCB2YWx1ZT0idXRmOCIvPgoJCQkJCQk8Q29sbGF0aW9uIHZhbHVlPSJ1dGY4X3VuaWNvZGVfY2kiLz4KCQkJCQkJPENvbW1lbnQgdmFsdWU9IiIvPgoJCQkJCQk8Q3JlYXRlX1RpbWUgdmFsdWU9IjIwMTQtMDUtMDIgMDA6MjU6MjYiLz4KCQkJCQkJPEVuZ2luZSB2YWx1ZT0iSW5ub0RCIi8+CgkJCQkJCTxGaWVsZF9Db3VudCB2YWx1ZT0iNSIvPgoJCQkJCQk8SW5kZXhfQ291bnQgdmFsdWU9IjMiLz4KCQkJCQkJPExpbmtfQ291bnQgdmFsdWU9IjIiLz4KCQkJCQkJPE5hbWUgdmFsdWU9ImRldHByZWNpbyIvPgoJCQkJCQk8UHJpbWFyeV9LZXkgdmFsdWU9ImFXUT0iLz4KCQkJCQkJPFJlY29yZF9Db3VudCB2YWx1ZT0iMCIvPgoJCQkJCQk8U2l6ZSB2YWx1ZT0iNDguMDAgS2IiLz4KCQkJCQkJPFRyaWdnZXJfQ291bnQgdmFsdWU9IjAiLz4KCQkJCQkJPFVuaXF1ZV9Db3VudCB2YWx1ZT0iMSIvPgoJCQkJCQk8VXBkYXRlX1RpbWUgdmFsdWU9IiIvPgoJCQkJCTwvUHJvcGVydGllcz4KCQkJCQk8Y29udHJvbCB2YWx1ZT0iVGFibGUxIi8+CgkJCQkJPGRlbGV0ZSB2YWx1ZT0iMCIvPgoJCQkJCTxmaWVsZD4KCQkJCQkJPG8wPgoJCQkJCQkJPENoYW5nZXMgdmFsdWU9IiIvPgoJCQkJCQkJPFByb3BlcnRpZXM+CgkJCQkJCQkJPEF1dG9pbmNyZW1lbnQgdmFsdWU9IjAiLz4KCQkJCQkJCQk8Q2hhcnNldCB2YWx1ZT0iIi8+CgkJCQkJCQkJPENvbGxhdGlvbiB2YWx1ZT0iIi8+CgkJCQkJCQkJPENvbW1lbnQgdmFsdWU9IiIvPgoJCQkJCQkJCTxEZWZhdWx0X1ZhbHVlIHZhbHVlPSIwMDAwLTAwLTAwIDAwOjAwOjAwIi8+CgkJCQkJCQkJPEZpZWxkX1Bvc2l0aW9uIHZhbHVlPSI0Ii8+CgkJCQkJCQkJPEluZGV4ZWQgdmFsdWU9IjAiLz4KCQkJCQkJCQk8TGVuZ3RoIHZhbHVlPSItMSIvPgoJCQkJCQkJCTxOYW1lIHZhbHVlPSJjcmVhdGVkX2F0Ii8+CgkJCQkJCQkJPE51bGxhYmxlIHZhbHVlPSIwIi8+CgkJCQkJCQkJPE9uX1VwZGF0ZV9TZXRfQ3VycmVudCB2YWx1ZT0iMCIvPgoJCQkJCQkJCTxQcmVjaXNpb24gdmFsdWU9IjAiLz4KCQkJCQkJCQk8U2NhbGUgdmFsdWU9IjAiLz4KCQkJCQkJCQk8VHlwZSB2YWx1ZT0iVGltZXN0YW1wIi8+CgkJCQkJCQkJPFVuaXF1ZSB2YWx1ZT0iMCIvPgoJCQkJCQkJCTxVbnNpZ25lZCB2YWx1ZT0iMCIvPgoJCQkJCQkJCTxaZXJvZmlsbCB2YWx1ZT0iMCIvPgoJCQkJCQkJPC9Qcm9wZXJ0aWVzPgoJCQkJCQkJPGNvbnRyb2wgdmFsdWU9IiIvPgoJCQkJCQkJPGRlbGV0ZSB2YWx1ZT0iMCIvPgoJCQkJCQkJPG5hbWUgdmFsdWU9ImNyZWF0ZWRfYXQiLz4KCQkJCQkJPC9vMD4KCQkJCQkJPG8xPgoJCQkJCQkJPENoYW5nZXMgdmFsdWU9IiIvPgoJCQkJCQkJPFByb3BlcnRpZXM+CgkJCQkJCQkJPEF1dG9pbmNyZW1lbnQgdmFsdWU9IjEiLz4KCQkJCQkJCQk8Q2hhcnNldCB2YWx1ZT0iIi8+CgkJCQkJCQkJPENvbGxhdGlvbiB2YWx1ZT0iIi8+CgkJCQkJCQkJPENvbW1lbnQgdmFsdWU9IiIvPgoJCQkJCQkJCTxEZWZhdWx0X1ZhbHVlIHZhbHVlPSIiLz4KCQkJCQkJCQk8RmllbGRfUG9zaXRpb24gdmFsdWU9IjEiLz4KCQkJCQkJCQk8SW5kZXhlZCB2YWx1ZT0iMSIvPgoJCQkJCQkJCTxMZW5ndGggdmFsdWU9IjEwIi8+CgkJCQkJCQkJPE5hbWUgdmFsdWU9ImlkIi8+CgkJCQkJCQkJPE51bGxhYmxlIHZhbHVlPSIwIi8+CgkJCQkJCQkJPE9uX1VwZGF0ZV9TZXRfQ3VycmVudCB2YWx1ZT0iMCIvPgoJCQkJCQkJCTxQcmVjaXNpb24gdmFsdWU9IjEwIi8+CgkJCQkJCQkJPFNjYWxlIHZhbHVlPSIwIi8+CgkJCQkJCQkJPFR5cGUgdmFsdWU9IkludCIvPgoJCQkJCQkJCTxVbmlxdWUgdmFsdWU9IjEiLz4KCQkJCQkJCQk8VW5zaWduZWQgdmFsdWU9IjEiLz4KCQkJCQkJCQk8WmVyb2ZpbGwgdmFsdWU9IjAiLz4KCQkJCQkJCTwvUHJvcGVydGllcz4KCQkJCQkJCTxjb250cm9sIHZhbHVlPSIiLz4KCQkJCQkJCTxkZWxldGUgdmFsdWU9IjAiLz4KCQkJCQkJCTxuYW1lIHZhbHVlPSJpZCIvPgoJCQkJCQk8L28xPgoJCQkJCQk8bzI+CgkJCQkJCQk8Q2hhbmdlcyB2YWx1ZT0iIi8+CgkJCQkJCQk8UHJvcGVydGllcz4KCQkJCQkJCQk8QXV0b2luY3JlbWVudCB2YWx1ZT0iMCIvPgoJCQkJCQkJCTxDaGFyc2V0IHZhbHVlPSIiLz4KCQkJCQkJCQk8Q29sbGF0aW9uIHZhbHVlPSIiLz4KCQkJCQkJCQk8Q29tbWVudCB2YWx1ZT0iIi8+CgkJCQkJCQkJPERlZmF1bHRfVmFsdWUgdmFsdWU9IiIvPgoJCQkJCQkJCTxGaWVsZF9Qb3NpdGlvbiB2YWx1ZT0iMyIvPgoJCQkJCQkJCTxJbmRleGVkIHZhbHVlPSIxIi8+CgkJCQkJCQkJPExlbmd0aCB2YWx1ZT0iMTEiLz4KCQkJCQkJCQk8TmFtZSB2YWx1ZT0icHJlY2lvX2lkIi8+CgkJCQkJCQkJPE51bGxhYmxlIHZhbHVlPSIwIi8+CgkJCQkJCQkJPE9uX1VwZGF0ZV9TZXRfQ3VycmVudCB2YWx1ZT0iMCIvPgoJCQkJCQkJCTxQcmVjaXNpb24gdmFsdWU9IjEwIi8+CgkJCQkJCQkJPFNjYWxlIHZhbHVlPSIwIi8+CgkJCQkJCQkJPFR5cGUgdmFsdWU9IkludCIvPgoJCQkJCQkJCTxVbmlxdWUgdmFsdWU9IjAiLz4KCQkJCQkJCQk8VW5zaWduZWQgdmFsdWU9IjAiLz4KCQkJCQkJCQk8WmVyb2ZpbGwgdmFsdWU9IjAiLz4KCQkJCQkJCTwvUHJvcGVydGllcz4KCQkJCQkJCTxjb250cm9sIHZhbHVlPSIiLz4KCQkJCQkJCTxkZWxldGUgdmFsdWU9IjAiLz4KCQkJCQkJCTxuYW1lIHZhbHVlPSJwcmVjaW9faWQiLz4KCQkJCQkJPC9vMj4KCQkJCQkJPG8zPgoJCQkJCQkJPENoYW5nZXMgdmFsdWU9IiIvPgoJCQkJCQkJPFByb3BlcnRpZXM+CgkJCQkJCQkJPEF1dG9pbmNyZW1lbnQgdmFsdWU9IjAiLz4KCQkJCQkJCQk8Q2hhcnNldCB2YWx1ZT0iIi8+CgkJCQkJCQkJPENvbGxhdGlvbiB2YWx1ZT0iIi8+CgkJCQkJCQkJPENvbW1lbnQgdmFsdWU9IiIvPgoJCQkJCQkJCTxEZWZhdWx0X1ZhbHVlIHZhbHVlPSIiLz4KCQkJCQkJCQk8RmllbGRfUG9zaXRpb24gdmFsdWU9IjIiLz4KCQkJCQkJCQk8SW5kZXhlZCB2YWx1ZT0iMSIvPgoJCQkJCQkJCTxMZW5ndGggdmFsdWU9IjExIi8+CgkJCQkJCQkJPE5hbWUgdmFsdWU9InJlc3RhdXJhbnRlX2lkIi8+CgkJCQkJCQkJPE51bGxhYmxlIHZhbHVlPSIwIi8+CgkJCQkJCQkJPE9uX1VwZGF0ZV9TZXRfQ3VycmVudCB2YWx1ZT0iMCIvPgoJCQkJCQkJCTxQcmVjaXNpb24gdmFsdWU9IjEwIi8+CgkJCQkJCQkJPFNjYWxlIHZhbHVlPSIwIi8+CgkJCQkJCQkJPFR5cGUgdmFsdWU9IkludCIvPgoJCQkJCQkJCTxVbmlxdWUgdmFsdWU9IjAiLz4KCQkJCQkJCQk8VW5zaWduZWQgdmFsdWU9IjAiLz4KCQkJCQkJCQk8WmVyb2ZpbGwgdmFsdWU9IjAiLz4KCQkJCQkJCTwvUHJvcGVydGllcz4KCQkJCQkJCTxjb250cm9sIHZhbHVlPSIiLz4KCQkJCQkJCTxkZWxldGUgdmFsdWU9IjAiLz4KCQkJCQkJCTxuYW1lIHZhbHVlPSJyZXN0YXVyYW50ZV9pZCIvPgoJCQkJCQk8L28zPgoJCQkJCQk8bzQ+CgkJCQkJCQk8Q2hhbmdlcyB2YWx1ZT0iIi8+CgkJCQkJCQk8UHJvcGVydGllcz4KCQkJCQkJCQk8QXV0b2luY3JlbWVudCB2YWx1ZT0iMCIvPgoJCQkJCQkJCTxDaGFyc2V0IHZhbHVlPSIiLz4KCQkJCQkJCQk8Q29sbGF0aW9uIHZhbHVlPSIiLz4KCQkJCQkJCQk8Q29tbWVudCB2YWx1ZT0iIi8+CgkJCQkJCQkJPERlZmF1bHRfVmFsdWUgdmFsdWU9IjAwMDAtMDAtMDAgMDA6MDA6MDAiLz4KCQkJCQkJCQk8RmllbGRfUG9zaXRpb24gdmFsdWU9IjUiLz4KCQkJCQkJCQk8SW5kZXhlZCB2YWx1ZT0iMCIvPgoJCQkJCQkJCTxMZW5ndGggdmFsdWU9Ii0xIi8+CgkJCQkJCQkJPE5hbWUgdmFsdWU9InVwZGF0ZWRfYXQiLz4KCQkJCQkJCQk8TnVsbGFibGUgdmFsdWU9IjAiLz4KCQkJCQkJCQk8T25fVXBkYXRlX1NldF9DdXJyZW50IHZhbHVlPSIwIi8+CgkJCQkJCQkJPFByZWNpc2lvbiB2YWx1ZT0iMCIvPgoJCQkJCQkJCTxTY2FsZSB2YWx1ZT0iMCIvPgoJCQkJCQkJCTxUeXBlIHZhbHVlPSJUaW1lc3RhbXAiLz4KCQkJCQkJCQk8VW5pcXVlIHZhbHVlPSIwIi8+CgkJCQkJCQkJPFVuc2lnbmVkIHZhbHVlPSIwIi8+CgkJCQkJCQkJPFplcm9maWxsIHZhbHVlPSIwIi8+CgkJCQkJCQk8L1Byb3BlcnRpZXM+CgkJCQkJCQk8Y29udHJvbCB2YWx1ZT0iIi8+CgkJCQkJCQk8ZGVsZXRlIHZhbHVlPSIwIi8+CgkJCQkJCQk8bmFtZSB2YWx1ZT0idXBkYXRlZF9hdCIvPgoJCQkJCQk8L280PgoJCQkJCTwvZmllbGQ+CgkJCQkJPGluZGV4PgoJCQkJCQk8bzA+CgkJCQkJCQk8Q2hhbmdlcyB2YWx1ZT0iIi8+CgkJCQkJCQk8UHJvcGVydGllcz4KCQkJCQkJCQk8Q29tbWVudCB2YWx1ZT0iIi8+CgkJCQkJCQkJPEZpZWxkcyB2YWx1ZT0iY0hKbFkybHZYMmxrIi8+CgkJCQkJCQkJPE5hbWUgdmFsdWU9ImRldHByZWNpb19wcmVjaW9faWRfZm9yZWlnbiIvPgoJCQkJCQkJCTxUeXBlIHZhbHVlPSJCVFJFRSIvPgoJCQkJCQkJCTxVbmlxdWUgdmFsdWU9IjAiLz4KCQkJCQkJCTwvUHJvcGVydGllcz4KCQkJCQkJCTxjb250cm9sIHZhbHVlPSIiLz4KCQkJCQkJCTxkZWxldGUgdmFsdWU9IjAiLz4KCQkJCQkJCTxuYW1lIHZhbHVlPSJkZXRwcmVjaW9fcHJlY2lvX2lkX2ZvcmVpZ24iLz4KCQkJCQkJPC9vMD4KCQkJCQkJPG8xPgoJCQkJCQkJPENoYW5nZXMgdmFsdWU9IiIvPgoJCQkJCQkJPFByb3BlcnRpZXM+CgkJCQkJCQkJPENvbW1lbnQgdmFsdWU9IiIvPgoJCQkJCQkJCTxGaWVsZHMgdmFsdWU9ImNtVnpkR0YxY21GdWRHVmZhV1E9Ii8+CgkJCQkJCQkJPE5hbWUgdmFsdWU9ImRldHByZWNpb19yZXN0YXVyYW50ZV9pZF9mb3JlaWduIi8+CgkJCQkJCQkJPFR5cGUgdmFsdWU9IkJUUkVFIi8+CgkJCQkJCQkJPFVuaXF1ZSB2YWx1ZT0iMCIvPgoJCQkJCQkJPC9Qcm9wZXJ0aWVzPgoJCQkJCQkJPGNvbnRyb2wgdmFsdWU9IiIvPgoJCQkJCQkJPGRlbGV0ZSB2YWx1ZT0iMCIvPgoJCQkJCQkJPG5hbWUgdmFsdWU9ImRldHByZWNpb19yZXN0YXVyYW50ZV9pZF9mb3JlaWduIi8+CgkJCQkJCTwvbzE+CgkJCQkJCTxvMj4KCQkJCQkJCTxDaGFuZ2VzIHZhbHVlPSIiLz4KCQkJCQkJCTxQcm9wZXJ0aWVzPgoJCQkJCQkJCTxDb21tZW50IHZhbHVlPSIiLz4KCQkJCQkJCQk8RmllbGRzIHZhbHVlPSJhV1E9Ii8+CgkJCQkJCQkJPE5hbWUgdmFsdWU9IlBSSU1BUlkiLz4KCQkJCQkJCQk8VHlwZSB2YWx1ZT0iQlRSRUUiLz4KCQkJCQkJCQk8VW5pcXVlIHZhbHVlPSIxIi8+CgkJCQkJCQk8L1Byb3BlcnRpZXM+CgkJCQkJCQk8Y29udHJvbCB2YWx1ZT0iIi8+CgkJCQkJCQk8ZGVsZXRlIHZhbHVlPSIwIi8+CgkJCQkJCQk8bmFtZSB2YWx1ZT0iUFJJTUFSWSIvPgoJCQkJCQk8L28yPgoJCQkJCTwvaW5kZXg+CgkJCQkJPG5hbWUgdmFsdWU9ImRldHByZWNpbyIvPgoJCQkJCTx1bmlxdWU+CgkJCQkJCTxvMD4KCQkJCQkJCTxDaGFuZ2VzIHZhbHVlPSIiLz4KCQkJCQkJCTxQcm9wZXJ0aWVzPgoJCQkJCQkJCTxGaWVsZHMgdmFsdWU9ImFXUT0iLz4KCQkJCQkJCQk8TmFtZSB2YWx1ZT0iUFJJTUFSWSIvPgoJCQkJCQkJPC9Qcm9wZXJ0aWVzPgoJCQkJCQkJPGNvbnRyb2wgdmFsdWU9IiIvPgoJCQkJCQkJPGRlbGV0ZSB2YWx1ZT0iMCIvPgoJCQkJCQkJPG5hbWUgdmFsdWU9IlBSSU1BUlkiLz4KCQkJCQkJPC9vMD4KCQkJCQk8L3VuaXF1ZT4KCQkJCTwvbzE+CgkJCQk8bzI+CgkJCQkJPENoYW5nZXMgdmFsdWU9IiIvPgoJCQkJCTxQcm9wZXJ0aWVzPgoJCQkJCQk8QXV0b2luY3JlbWVudCB2YWx1ZT0iMjA0Ii8+CgkJCQkJCTxBdmVyYWdlX1Jvd19TaXplIHZhbHVlPSI4MCIvPgoJCQkJCQk8Q2hhcnNldCB2YWx1ZT0ibGF0aW4xIi8+CgkJCQkJCTxDb2xsYXRpb24gdmFsdWU9ImxhdGluMV9zd2VkaXNoX2NpIi8+CgkJCQkJCTxDb21tZW50IHZhbHVlPSIiLz4KCQkJCQkJPENyZWF0ZV9UaW1lIHZhbHVlPSIyMDE0LTA1LTAyIDAwOjI1OjI2Ii8+CgkJCQkJCTxFbmdpbmUgdmFsdWU9Iklubm9EQiIvPgoJCQkJCQk8RmllbGRfQ291bnQgdmFsdWU9IjgiLz4KCQkJCQkJPEluZGV4X0NvdW50IHZhbHVlPSIzIi8+CgkJCQkJCTxMaW5rX0NvdW50IHZhbHVlPSIzIi8+CgkJCQkJCTxOYW1lIHZhbHVlPSJwcmVjaW8iLz4KCQkJCQkJPFByaW1hcnlfS2V5IHZhbHVlPSJhV1E9Ii8+CgkJCQkJCTxSZWNvcmRfQ291bnQgdmFsdWU9IjIwMyIvPgoJCQkJCQk8U2l6ZSB2YWx1ZT0iNDguMDAgS2IiLz4KCQkJCQkJPFRyaWdnZXJfQ291bnQgdmFsdWU9IjAiLz4KCQkJCQkJPFVuaXF1ZV9Db3VudCB2YWx1ZT0iMSIvPgoJCQkJCQk8VXBkYXRlX1RpbWUgdmFsdWU9IiIvPgoJCQkJCTwvUHJvcGVydGllcz4KCQkJCQk8Y29udHJvbCB2YWx1ZT0iVGFibGUyIi8+CgkJCQkJPGRlbGV0ZSB2YWx1ZT0iMCIvPgoJCQkJCTxmaWVsZD4KCQkJCQkJPG8wPgoJCQkJCQkJPENoYW5nZXMgdmFsdWU9IiIvPgoJCQkJCQkJPFByb3BlcnRpZXM+CgkJCQkJCQkJPEF1dG9pbmNyZW1lbnQgdmFsdWU9IjAiLz4KCQkJCQkJCQk8Q2hhcnNldCB2YWx1ZT0iIi8+CgkJCQkJCQkJPENvbGxhdGlvbiB2YWx1ZT0iIi8+CgkJCQkJCQkJPENvbW1lbnQgdmFsdWU9IiIvPgoJCQkJCQkJCTxEZWZhdWx0X1ZhbHVlIHZhbHVlPSIiLz4KCQkJCQkJCQk8RmllbGRfUG9zaXRpb24gdmFsdWU9IjQiLz4KCQkJCQkJCQk8SW5kZXhlZCB2YWx1ZT0iMCIvPgoJCQkJCQkJCTxMZW5ndGggdmFsdWU9IjExIi8+CgkJCQkJCQkJPE5hbWUgdmFsdWU9ImNhbnRpZGFkIi8+CgkJCQkJCQkJPE51bGxhYmxlIHZhbHVlPSIxIi8+CgkJCQkJCQkJPE9uX1VwZGF0ZV9TZXRfQ3VycmVudCB2YWx1ZT0iMCIvPgoJCQkJCQkJCTxQcmVjaXNpb24gdmFsdWU9IjEwIi8+CgkJCQkJCQkJPFNjYWxlIHZhbHVlPSIwIi8+CgkJCQkJCQkJPFR5cGUgdmFsdWU9IkludCIvPgoJCQkJCQkJCTxVbmlxdWUgdmFsdWU9IjAiLz4KCQkJCQkJCQk8VW5zaWduZWQgdmFsdWU9IjAiLz4KCQkJCQkJCQk8WmVyb2ZpbGwgdmFsdWU9IjAiLz4KCQkJCQkJCTwvUHJvcGVydGllcz4KCQkJCQkJCTxjb250cm9sIHZhbHVlPSIiLz4KCQkJCQkJCTxkZWxldGUgdmFsdWU9IjAiLz4KCQkJCQkJCTxuYW1lIHZhbHVlPSJjYW50aWRhZCIvPgoJCQkJCQk8L28wPgoJCQkJCQk8bzE+CgkJCQkJCQk8Q2hhbmdlcyB2YWx1ZT0iIi8+CgkJCQkJCQk8UHJvcGVydGllcz4KCQkJCQkJCQk8QXV0b2luY3JlbWVudCB2YWx1ZT0iMCIvPgoJCQkJCQkJCTxDaGFyc2V0IHZhbHVlPSIiLz4KCQkJCQkJCQk8Q29sbGF0aW9uIHZhbHVlPSIiLz4KCQkJCQkJCQk8Q29tbWVudCB2YWx1ZT0iIi8+CgkJCQkJCQkJPERlZmF1bHRfVmFsdWUgdmFsdWU9IiIvPgoJCQkJCQkJCTxGaWVsZF9Qb3NpdGlvbiB2YWx1ZT0iMiIvPgoJCQkJCQkJCTxJbmRleGVkIHZhbHVlPSIxIi8+CgkJCQkJCQkJPExlbmd0aCB2YWx1ZT0iMTEiLz4KCQkJCQkJCQk8TmFtZSB2YWx1ZT0iY29tYmluYWNpb25faWQiLz4KCQkJCQkJCQk8TnVsbGFibGUgdmFsdWU9IjEiLz4KCQkJCQkJCQk8T25fVXBkYXRlX1NldF9DdXJyZW50IHZhbHVlPSIwIi8+CgkJCQkJCQkJPFByZWNpc2lvbiB2YWx1ZT0iMTAiLz4KCQkJCQkJCQk8U2NhbGUgdmFsdWU9IjAiLz4KCQkJCQkJCQk8VHlwZSB2YWx1ZT0iSW50Ii8+CgkJCQkJCQkJPFVuaXF1ZSB2YWx1ZT0iMCIvPgoJCQkJCQkJCTxVbnNpZ25lZCB2YWx1ZT0iMCIvPgoJCQkJCQkJCTxaZXJvZmlsbCB2YWx1ZT0iMCIvPgoJCQkJCQkJPC9Qcm9wZXJ0aWVzPgoJCQkJCQkJPGNvbnRyb2wgdmFsdWU9IiIvPgoJCQkJCQkJPGRlbGV0ZSB2YWx1ZT0iMCIvPgoJCQkJCQkJPG5hbWUgdmFsdWU9ImNvbWJpbmFjaW9uX2lkIi8+CgkJCQkJCTwvbzE+CgkJCQkJCTxvMj4KCQkJCQkJCTxDaGFuZ2VzIHZhbHVlPSIiLz4KCQkJCQkJCTxQcm9wZXJ0aWVzPgoJCQkJCQkJCTxBdXRvaW5jcmVtZW50IHZhbHVlPSIwIi8+CgkJCQkJCQkJPENoYXJzZXQgdmFsdWU9IiIvPgoJCQkJCQkJCTxDb2xsYXRpb24gdmFsdWU9IiIvPgoJCQkJCQkJCTxDb21tZW50IHZhbHVlPSIiLz4KCQkJCQkJCQk8RGVmYXVsdF9WYWx1ZSB2YWx1ZT0iIi8+CgkJCQkJCQkJPEZpZWxkX1Bvc2l0aW9uIHZhbHVlPSI2Ii8+CgkJCQkJCQkJPEluZGV4ZWQgdmFsdWU9IjAiLz4KCQkJCQkJCQk8TGVuZ3RoIHZhbHVlPSItMSIvPgoJCQkJCQkJCTxOYW1lIHZhbHVlPSJjcmVhdGVkX2F0Ii8+CgkJCQkJCQkJPE51bGxhYmxlIHZhbHVlPSIxIi8+CgkJCQkJCQkJPE9uX1VwZGF0ZV9TZXRfQ3VycmVudCB2YWx1ZT0iMCIvPgoJCQkJCQkJCTxQcmVjaXNpb24gdmFsdWU9IjAiLz4KCQkJCQkJCQk8U2NhbGUgdmFsdWU9IjAiLz4KCQkJCQkJCQk8VHlwZSB2YWx1ZT0iVGltZXN0YW1wIi8+CgkJCQkJCQkJPFVuaXF1ZSB2YWx1ZT0iMCIvPgoJCQkJCQkJCTxVbnNpZ25lZCB2YWx1ZT0iMCIvPgoJCQkJCQkJCTxaZXJvZmlsbCB2YWx1ZT0iMCIvPgoJCQkJCQkJPC9Qcm9wZXJ0aWVzPgoJCQkJCQkJPGNvbnRyb2wgdmFsdWU9IiIvPgoJCQkJCQkJPGRlbGV0ZSB2YWx1ZT0iMCIvPgoJCQkJCQkJPG5hbWUgdmFsdWU9ImNyZWF0ZWRfYXQiLz4KCQkJCQkJPC9vMj4KCQkJCQkJPG8zPgoJCQkJCQkJPENoYW5nZXMgdmFsdWU9IiIvPgoJCQkJCQkJPFByb3BlcnRpZXM+CgkJCQkJCQkJPEF1dG9pbmNyZW1lbnQgdmFsdWU9IjEiLz4KCQkJCQkJCQk8Q2hhcnNldCB2YWx1ZT0iIi8+CgkJCQkJCQkJPENvbGxhdGlvbiB2YWx1ZT0iIi8+CgkJCQkJCQkJPENvbW1lbnQgdmFsdWU9IiIvPgoJCQkJCQkJCTxEZWZhdWx0X1ZhbHVlIHZhbHVlPSIiLz4KCQkJCQkJCQk8RmllbGRfUG9zaXRpb24gdmFsdWU9IjgiLz4KCQkJCQkJCQk8SW5kZXhlZCB2YWx1ZT0iMSIvPgoJCQkJCQkJCTxMZW5ndGggdmFsdWU9IjExIi8+CgkJCQkJCQkJPE5hbWUgdmFsdWU9ImlkIi8+CgkJCQkJCQkJPE51bGxhYmxlIHZhbHVlPSIwIi8+CgkJCQkJCQkJPE9uX1VwZGF0ZV9TZXRfQ3VycmVudCB2YWx1ZT0iMCIvPgoJCQkJCQkJCTxQcmVjaXNpb24gdmFsdWU9IjEwIi8+CgkJCQkJCQkJPFNjYWxlIHZhbHVlPSIwIi8+CgkJCQkJCQkJPFR5cGUgdmFsdWU9IkludCIvPgoJCQkJCQkJCTxVbmlxdWUgdmFsdWU9IjEiLz4KCQkJCQkJCQk8VW5zaWduZWQgdmFsdWU9IjAiLz4KCQkJCQkJCQk8WmVyb2ZpbGwgdmFsdWU9IjAiLz4KCQkJCQkJCTwvUHJvcGVydGllcz4KCQkJCQkJCTxjb250cm9sIHZhbHVlPSIiLz4KCQkJCQkJCTxkZWxldGUgdmFsdWU9IjAiLz4KCQkJCQkJCTxuYW1lIHZhbHVlPSJpZCIvPgoJCQkJCQk8L28zPgoJCQkJCQk8bzQ+CgkJCQkJCQk8Q2hhbmdlcyB2YWx1ZT0iIi8+CgkJCQkJCQk8UHJvcGVydGllcz4KCQkJCQkJCQk8QXV0b2luY3JlbWVudCB2YWx1ZT0iMCIvPgoJCQkJCQkJCTxDaGFyc2V0IHZhbHVlPSIiLz4KCQkJCQkJCQk8Q29sbGF0aW9uIHZhbHVlPSIiLz4KCQkJCQkJCQk8Q29tbWVudCB2YWx1ZT0iIi8+CgkJCQkJCQkJPERlZmF1bHRfVmFsdWUgdmFsdWU9IiIvPgoJCQkJCQkJCTxGaWVsZF9Qb3NpdGlvbiB2YWx1ZT0iMyIvPgoJCQkJCQkJCTxJbmRleGVkIHZhbHVlPSIwIi8+CgkJCQkJCQkJPExlbmd0aCB2YWx1ZT0iMCIvPgoJCQkJCQkJCTxOYW1lIHZhbHVlPSJwcmVjaW8iLz4KCQkJCQkJCQk8TnVsbGFibGUgdmFsdWU9IjEiLz4KCQkJCQkJCQk8T25fVXBkYXRlX1NldF9DdXJyZW50IHZhbHVlPSIwIi8+CgkJCQkJCQkJPFByZWNpc2lvbiB2YWx1ZT0iMTAiLz4KCQkJCQkJCQk8U2NhbGUgdmFsdWU9IjIiLz4KCQkJCQkJCQk8VHlwZSB2YWx1ZT0iRGVjaW1hbCIvPgoJCQkJCQkJCTxVbmlxdWUgdmFsdWU9IjAiLz4KCQkJCQkJCQk8VW5zaWduZWQgdmFsdWU9IjAiLz4KCQkJCQkJCQk8WmVyb2ZpbGwgdmFsdWU9IjAiLz4KCQkJCQkJCTwvUHJvcGVydGllcz4KCQkJCQkJCTxjb250cm9sIHZhbHVlPSIiLz4KCQkJCQkJCTxkZWxldGUgdmFsdWU9IjAiLz4KCQkJCQkJCTxuYW1lIHZhbHVlPSJwcmVjaW8iLz4KCQkJCQkJPC9vND4KCQkJCQkJPG81PgoJCQkJCQkJPENoYW5nZXMgdmFsdWU9IiIvPgoJCQkJCQkJPFByb3BlcnRpZXM+CgkJCQkJCQkJPEF1dG9pbmNyZW1lbnQgdmFsdWU9IjAiLz4KCQkJCQkJCQk8Q2hhcnNldCB2YWx1ZT0iIi8+CgkJCQkJCQkJPENvbGxhdGlvbiB2YWx1ZT0iIi8+CgkJCQkJCQkJPENvbW1lbnQgdmFsdWU9IiIvPgoJCQkJCQkJCTxEZWZhdWx0X1ZhbHVlIHZhbHVlPSIiLz4KCQkJCQkJCQk8RmllbGRfUG9zaXRpb24gdmFsdWU9IjEiLz4KCQkJCQkJCQk8SW5kZXhlZCB2YWx1ZT0iMSIvPgoJCQkJCQkJCTxMZW5ndGggdmFsdWU9IjExIi8+CgkJCQkJCQkJPE5hbWUgdmFsdWU9InByb2R1Y3RvX2lkIi8+CgkJCQkJCQkJPE51bGxhYmxlIHZhbHVlPSIxIi8+CgkJCQkJCQkJPE9uX1VwZGF0ZV9TZXRfQ3VycmVudCB2YWx1ZT0iMCIvPgoJCQkJCQkJCTxQcmVjaXNpb24gdmFsdWU9IjEwIi8+CgkJCQkJCQkJPFNjYWxlIHZhbHVlPSIwIi8+CgkJCQkJCQkJPFR5cGUgdmFsdWU9IkludCIvPgoJCQkJCQkJCTxVbmlxdWUgdmFsdWU9IjAiLz4KCQkJCQkJCQk8VW5zaWduZWQgdmFsdWU9IjAiLz4KCQkJCQkJCQk8WmVyb2ZpbGwgdmFsdWU9IjAiLz4KCQkJCQkJCTwvUHJvcGVydGllcz4KCQkJCQkJCTxjb250cm9sIHZhbHVlPSIiLz4KCQkJCQkJCTxkZWxldGUgdmFsdWU9IjAiLz4KCQkJCQkJCTxuYW1lIHZhbHVlPSJwcm9kdWN0b19pZCIvPgoJCQkJCQk8L281PgoJCQkJCQk8bzY+CgkJCQkJCQk8Q2hhbmdlcyB2YWx1ZT0iIi8+CgkJCQkJCQk8UHJvcGVydGllcz4KCQkJCQkJCQk8QXV0b2luY3JlbWVudCB2YWx1ZT0iMCIvPgoJCQkJCQkJCTxDaGFyc2V0IHZhbHVlPSIiLz4KCQkJCQkJCQk8Q29sbGF0aW9uIHZhbHVlPSIiLz4KCQkJCQkJCQk8Q29tbWVudCB2YWx1ZT0iMTEsMjIsMzMsNDQuLi4gc29sbyBzZSBzZWxlY2Npb25hIDQgcHJvZCBkIGxvcyA4IGRpc3AgZG9uZGUgbm8gc2UgcmVwaXRhIHVuIG1pc21vIHZhbG9yIi8+CgkJCQkJCQkJPERlZmF1bHRfVmFsdWUgdmFsdWU9IiIvPgoJCQkJCQkJCTxGaWVsZF9Qb3NpdGlvbiB2YWx1ZT0iNSIvPgoJCQkJCQkJCTxJbmRleGVkIHZhbHVlPSIwIi8+CgkJCQkJCQkJPExlbmd0aCB2YWx1ZT0iMTEiLz4KCQkJCQkJCQk8TmFtZSB2YWx1ZT0ic2VsZWNjaW9uYWRvciIvPgoJCQkJCQkJCTxOdWxsYWJsZSB2YWx1ZT0iMSIvPgoJCQkJCQkJCTxPbl9VcGRhdGVfU2V0X0N1cnJlbnQgdmFsdWU9IjAiLz4KCQkJCQkJCQk8UHJlY2lzaW9uIHZhbHVlPSIxMCIvPgoJCQkJCQkJCTxTY2FsZSB2YWx1ZT0iMCIvPgoJCQkJCQkJCTxUeXBlIHZhbHVlPSJJbnQiLz4KCQkJCQkJCQk8VW5pcXVlIHZhbHVlPSIwIi8+CgkJCQkJCQkJPFVuc2lnbmVkIHZhbHVlPSIwIi8+CgkJCQkJCQkJPFplcm9maWxsIHZhbHVlPSIwIi8+CgkJCQkJCQk8L1Byb3BlcnRpZXM+CgkJCQkJCQk8Y29udHJvbCB2YWx1ZT0iIi8+CgkJCQkJCQk8ZGVsZXRlIHZhbHVlPSIwIi8+CgkJCQkJCQk8bmFtZSB2YWx1ZT0ic2VsZWNjaW9uYWRvciIvPgoJCQkJCQk8L282PgoJCQkJCQk8bzc+CgkJCQkJCQk8Q2hhbmdlcyB2YWx1ZT0iIi8+CgkJCQkJCQk8UHJvcGVydGllcz4KCQkJCQkJCQk8QXV0b2luY3JlbWVudCB2YWx1ZT0iMCIvPgoJCQkJCQkJCTxDaGFyc2V0IHZhbHVlPSIiLz4KCQkJCQkJCQk8Q29sbGF0aW9uIHZhbHVlPSIiLz4KCQkJCQkJCQk8Q29tbWVudCB2YWx1ZT0iIi8+CgkJCQkJCQkJPERlZmF1bHRfVmFsdWUgdmFsdWU9IiIvPgoJCQkJCQkJCTxGaWVsZF9Qb3NpdGlvbiB2YWx1ZT0iNyIvPgoJCQkJCQkJCTxJbmRleGVkIHZhbHVlPSIwIi8+CgkJCQkJCQkJPExlbmd0aCB2YWx1ZT0iLTEiLz4KCQkJCQkJCQk8TmFtZSB2YWx1ZT0idXBkYXRlZF9hdCIvPgoJCQkJCQkJCTxOdWxsYWJsZSB2YWx1ZT0iMSIvPgoJCQkJCQkJCTxPbl9VcGRhdGVfU2V0X0N1cnJlbnQgdmFsdWU9IjAiLz4KCQkJCQkJCQk8UHJlY2lzaW9uIHZhbHVlPSIwIi8+CgkJCQkJCQkJPFNjYWxlIHZhbHVlPSIwIi8+CgkJCQkJCQkJPFR5cGUgdmFsdWU9IlRpbWVzdGFtcCIvPgoJCQkJCQkJCTxVbmlxdWUgdmFsdWU9IjAiLz4KCQkJCQkJCQk8VW5zaWduZWQgdmFsdWU9IjAiLz4KCQkJCQkJCQk8WmVyb2ZpbGwgdmFsdWU9IjAiLz4KCQkJCQkJCTwvUHJvcGVydGllcz4KCQkJCQkJCTxjb250cm9sIHZhbHVlPSIiLz4KCQkJCQkJCTxkZWxldGUgdmFsdWU9IjAiLz4KCQkJCQkJCTxuYW1lIHZhbHVlPSJ1cGRhdGVkX2F0Ii8+CgkJCQkJCTwvbzc+CgkJCQkJPC9maWVsZD4KCQkJCQk8aW5kZXg+CgkJCQkJCTxvMD4KCQkJCQkJCTxDaGFuZ2VzIHZhbHVlPSIiLz4KCQkJCQkJCTxQcm9wZXJ0aWVzPgoJCQkJCQkJCTxDb21tZW50IHZhbHVlPSIiLz4KCQkJCQkJCQk8RmllbGRzIHZhbHVlPSJZMjl0WW1sdVlXTnBiMjVmYVdRPSIvPgoJCQkJCQkJCTxOYW1lIHZhbHVlPSJma19QcmVjaW9fQ29tYmluYWNpb24xX2lkeCIvPgoJCQkJCQkJCTxUeXBlIHZhbHVlPSJCVFJFRSIvPgoJCQkJCQkJCTxVbmlxdWUgdmFsdWU9IjAiLz4KCQkJCQkJCTwvUHJvcGVydGllcz4KCQkJCQkJCTxjb250cm9sIHZhbHVlPSIiLz4KCQkJCQkJCTxkZWxldGUgdmFsdWU9IjAiLz4KCQkJCQkJCTxuYW1lIHZhbHVlPSJma19QcmVjaW9fQ29tYmluYWNpb24xX2lkeCIvPgoJCQkJCQk8L28wPgoJCQkJCQk8bzE+CgkJCQkJCQk8Q2hhbmdlcyB2YWx1ZT0iIi8+CgkJCQkJCQk8UHJvcGVydGllcz4KCQkJCQkJCQk8Q29tbWVudCB2YWx1ZT0iIi8+CgkJCQkJCQkJPEZpZWxkcyB2YWx1ZT0iY0hKdlpIVmpkRzlmYVdRPSIvPgoJCQkJCQkJCTxOYW1lIHZhbHVlPSJma19QcmVjaW9fUHJvZHVjdG8xIi8+CgkJCQkJCQkJPFR5cGUgdmFsdWU9IkJUUkVFIi8+CgkJCQkJCQkJPFVuaXF1ZSB2YWx1ZT0iMCIvPgoJCQkJCQkJPC9Qcm9wZXJ0aWVzPgoJCQkJCQkJPGNvbnRyb2wgdmFsdWU9IiIvPgoJCQkJCQkJPGRlbGV0ZSB2YWx1ZT0iMCIvPgoJCQkJCQkJPG5hbWUgdmFsdWU9ImZrX1ByZWNpb19Qcm9kdWN0bzEiLz4KCQkJCQkJPC9vMT4KCQkJCQkJPG8yPgoJCQkJCQkJPENoYW5nZXMgdmFsdWU9IiIvPgoJCQkJCQkJPFByb3BlcnRpZXM+CgkJCQkJCQkJPENvbW1lbnQgdmFsdWU9IiIvPgoJCQkJCQkJCTxGaWVsZHMgdmFsdWU9ImFXUT0iLz4KCQkJCQkJCQk8TmFtZSB2YWx1ZT0iUFJJTUFSWSIvPgoJCQkJCQkJCTxUeXBlIHZhbHVlPSJCVFJFRSIvPgoJCQkJCQkJCTxVbmlxdWUgdmFsdWU9IjEiLz4KCQkJCQkJCTwvUHJvcGVydGllcz4KCQkJCQkJCTxjb250cm9sIHZhbHVlPSIiLz4KCQkJCQkJCTxkZWxldGUgdmFsdWU9IjAiLz4KCQkJCQkJCTxuYW1lIHZhbHVlPSJQUklNQVJZIi8+CgkJCQkJCTwvbzI+CgkJCQkJPC9pbmRleD4KCQkJCQk8bmFtZSB2YWx1ZT0icHJlY2lvIi8+CgkJCQkJPHVuaXF1ZT4KCQkJCQkJPG8wPgoJCQkJCQkJPENoYW5nZXMgdmFsdWU9IiIvPgoJCQkJCQkJPFByb3BlcnRpZXM+CgkJCQkJCQkJPEZpZWxkcyB2YWx1ZT0iYVdRPSIvPgoJCQkJCQkJCTxOYW1lIHZhbHVlPSJQUklNQVJZIi8+CgkJCQkJCQk8L1Byb3BlcnRpZXM+CgkJCQkJCQk8Y29udHJvbCB2YWx1ZT0iIi8+CgkJCQkJCQk8ZGVsZXRlIHZhbHVlPSIwIi8+CgkJCQkJCQk8bmFtZSB2YWx1ZT0iUFJJTUFSWSIvPgoJCQkJCQk8L28wPgoJCQkJCTwvdW5pcXVlPgoJCQkJPC9vMj4KCQkJCTxvMz4KCQkJCQk8Q2hhbmdlcyB2YWx1ZT0iIi8+CgkJCQkJPFByb3BlcnRpZXM+CgkJCQkJCTxBdXRvaW5jcmVtZW50IHZhbHVlPSIyNSIvPgoJCQkJCQk8QXZlcmFnZV9Sb3dfU2l6ZSB2YWx1ZT0iNjgyIi8+CgkJCQkJCTxDaGFyc2V0IHZhbHVlPSJsYXRpbjEiLz4KCQkJCQkJPENvbGxhdGlvbiB2YWx1ZT0ibGF0aW4xX3N3ZWRpc2hfY2kiLz4KCQkJCQkJPENvbW1lbnQgdmFsdWU9IiIvPgoJCQkJCQk8Q3JlYXRlX1RpbWUgdmFsdWU9IjIwMTQtMDUtMDIgMDA6MjU6MjYiLz4KCQkJCQkJPEVuZ2luZSB2YWx1ZT0iSW5ub0RCIi8+CgkJCQkJCTxGaWVsZF9Db3VudCB2YWx1ZT0iNiIvPgoJCQkJCQk8SW5kZXhfQ291bnQgdmFsdWU9IjEiLz4KCQkJCQkJPExpbmtfQ291bnQgdmFsdWU9IjEiLz4KCQkJCQkJPE5hbWUgdmFsdWU9ImZhbWlsaWEiLz4KCQkJCQkJPFByaW1hcnlfS2V5IHZhbHVlPSJhV1E9Ii8+CgkJCQkJCTxSZWNvcmRfQ291bnQgdmFsdWU9IjI0Ii8+CgkJCQkJCTxTaXplIHZhbHVlPSIxNi4wMCBLYiIvPgoJCQkJCQk8VHJpZ2dlcl9Db3VudCB2YWx1ZT0iMCIvPgoJCQkJCQk8VW5pcXVlX0NvdW50IHZhbHVlPSIxIi8+CgkJCQkJCTxVcGRhdGVfVGltZSB2YWx1ZT0iIi8+CgkJCQkJPC9Qcm9wZXJ0aWVzPgoJCQkJCTxjb250cm9sIHZhbHVlPSJUYWJsZTMiLz4KCQkJCQk8ZGVsZXRlIHZhbHVlPSIwIi8+CgkJCQkJPGZpZWxkPgoJCQkJCQk8bzA+CgkJCQkJCQk8Q2hhbmdlcyB2YWx1ZT0iIi8+CgkJCQkJCQk8UHJvcGVydGllcz4KCQkJCQkJCQk8QXV0b2luY3JlbWVudCB2YWx1ZT0iMCIvPgoJCQkJCQkJCTxDaGFyc2V0IHZhbHVlPSIiLz4KCQkJCQkJCQk8Q29sbGF0aW9uIHZhbHVlPSIiLz4KCQkJCQkJCQk8Q29tbWVudCB2YWx1ZT0iIi8+CgkJCQkJCQkJPERlZmF1bHRfVmFsdWUgdmFsdWU9IiIvPgoJCQkJCQkJCTxGaWVsZF9Qb3NpdGlvbiB2YWx1ZT0iNSIvPgoJCQkJCQkJCTxJbmRleGVkIHZhbHVlPSIwIi8+CgkJCQkJCQkJPExlbmd0aCB2YWx1ZT0iLTEiLz4KCQkJCQkJCQk8TmFtZSB2YWx1ZT0iY3JlYXRlZF9hdCIvPgoJCQkJCQkJCTxOdWxsYWJsZSB2YWx1ZT0iMSIvPgoJCQkJCQkJCTxPbl9VcGRhdGVfU2V0X0N1cnJlbnQgdmFsdWU9IjAiLz4KCQkJCQkJCQk8UHJlY2lzaW9uIHZhbHVlPSIwIi8+CgkJCQkJCQkJPFNjYWxlIHZhbHVlPSIwIi8+CgkJCQkJCQkJPFR5cGUgdmFsdWU9IlRpbWVzdGFtcCIvPgoJCQkJCQkJCTxVbmlxdWUgdmFsdWU9IjAiLz4KCQkJCQkJCQk8VW5zaWduZWQgdmFsdWU9IjAiLz4KCQkJCQkJCQk8WmVyb2ZpbGwgdmFsdWU9IjAiLz4KCQkJCQkJCTwvUHJvcGVydGllcz4KCQkJCQkJCTxjb250cm9sIHZhbHVlPSIiLz4KCQkJCQkJCTxkZWxldGUgdmFsdWU9IjAiLz4KCQkJCQkJCTxuYW1lIHZhbHVlPSJjcmVhdGVkX2F0Ii8+CgkJCQkJCTwvbzA+CgkJCQkJCTxvMT4KCQkJCQkJCTxDaGFuZ2VzIHZhbHVlPSIiLz4KCQkJCQkJCTxQcm9wZXJ0aWVzPgoJCQkJCQkJCTxBdXRvaW5jcmVtZW50IHZhbHVlPSIwIi8+CgkJCQkJCQkJPENoYXJzZXQgdmFsdWU9ImxhdGluMSIvPgoJCQkJCQkJCTxDb2xsYXRpb24gdmFsdWU9ImxhdGluMV9zd2VkaXNoX2NpIi8+CgkJCQkJCQkJPENvbW1lbnQgdmFsdWU9IiIvPgoJCQkJCQkJCTxEZWZhdWx0X1ZhbHVlIHZhbHVlPSIiLz4KCQkJCQkJCQk8RmllbGRfUG9zaXRpb24gdmFsdWU9IjMiLz4KCQkJCQkJCQk8SW5kZXhlZCB2YWx1ZT0iMCIvPgoJCQkJCQkJCTxMZW5ndGggdmFsdWU9Ii0xIi8+CgkJCQkJCQkJPE5hbWUgdmFsdWU9ImRlc2NyaXBjaW9uIi8+CgkJCQkJCQkJPE51bGxhYmxlIHZhbHVlPSIxIi8+CgkJCQkJCQkJPE9uX1VwZGF0ZV9TZXRfQ3VycmVudCB2YWx1ZT0iMCIvPgoJCQkJCQkJCTxQcmVjaXNpb24gdmFsdWU9IjAiLz4KCQkJCQkJCQk8U2NhbGUgdmFsdWU9IjAiLz4KCQkJCQkJCQk8VHlwZSB2YWx1ZT0iVGV4dCIvPgoJCQkJCQkJCTxVbmlxdWUgdmFsdWU9IjAiLz4KCQkJCQkJCQk8VW5zaWduZWQgdmFsdWU9IjAiLz4KCQkJCQkJCQk8WmVyb2ZpbGwgdmFsdWU9IjAiLz4KCQkJCQkJCTwvUHJvcGVydGllcz4KCQkJCQkJCTxjb250cm9sIHZhbHVlPSIiLz4KCQkJCQkJCTxkZWxldGUgdmFsdWU9IjAiLz4KCQkJCQkJCTxuYW1lIHZhbHVlPSJkZXNjcmlwY2lvbiIvPgoJCQkJCQk8L28xPgoJCQkJCQk8bzI+CgkJCQkJCQk8Q2hhbmdlcyB2YWx1ZT0iIi8+CgkJCQkJCQk8UHJvcGVydGllcz4KCQkJCQkJCQk8QXV0b2luY3JlbWVudCB2YWx1ZT0iMSIvPgoJCQkJCQkJCTxDaGFyc2V0IHZhbHVlPSIiLz4KCQkJCQkJCQk8Q29sbGF0aW9uIHZhbHVlPSIiLz4KCQkJCQkJCQk8Q29tbWVudCB2YWx1ZT0iIi8+CgkJCQkJCQkJPERlZmF1bHRfVmFsdWUgdmFsdWU9IiIvPgoJCQkJCQkJCTxGaWVsZF9Qb3NpdGlvbiB2YWx1ZT0iMSIvPgoJCQkJCQkJCTxJbmRleGVkIHZhbHVlPSIxIi8+CgkJCQkJCQkJPExlbmd0aCB2YWx1ZT0iMTEiLz4KCQkJCQkJCQk8TmFtZSB2YWx1ZT0iaWQiLz4KCQkJCQkJCQk8TnVsbGFibGUgdmFsdWU9IjAiLz4KCQkJCQkJCQk8T25fVXBkYXRlX1NldF9DdXJyZW50IHZhbHVlPSIwIi8+CgkJCQkJCQkJPFByZWNpc2lvbiB2YWx1ZT0iMTAiLz4KCQkJCQkJCQk8U2NhbGUgdmFsdWU9IjAiLz4KCQkJCQkJCQk8VHlwZSB2YWx1ZT0iSW50Ii8+CgkJCQkJCQkJPFVuaXF1ZSB2YWx1ZT0iMSIvPgoJCQkJCQkJCTxVbnNpZ25lZCB2YWx1ZT0iMCIvPgoJCQkJCQkJCTxaZXJvZmlsbCB2YWx1ZT0iMCIvPgoJCQkJCQkJPC9Qcm9wZXJ0aWVzPgoJCQkJCQkJPGNvbnRyb2wgdmFsdWU9IiIvPgoJCQkJCQkJPGRlbGV0ZSB2YWx1ZT0iMCIvPgoJCQkJCQkJPG5hbWUgdmFsdWU9ImlkIi8+CgkJCQkJCTwvbzI+CgkJCQkJCTxvMz4KCQkJCQkJCTxDaGFuZ2VzIHZhbHVlPSIiLz4KCQkJCQkJCTxQcm9wZXJ0aWVzPgoJCQkJCQkJCTxBdXRvaW5jcmVtZW50IHZhbHVlPSIwIi8+CgkJCQkJCQkJPENoYXJzZXQgdmFsdWU9ImxhdGluMSIvPgoJCQkJCQkJCTxDb2xsYXRpb24gdmFsdWU9ImxhdGluMV9zd2VkaXNoX2NpIi8+CgkJCQkJCQkJPENvbW1lbnQgdmFsdWU9IidydXRhJyIvPgoJCQkJCQkJCTxEZWZhdWx0X1ZhbHVlIHZhbHVlPSIiLz4KCQkJCQkJCQk8RmllbGRfUG9zaXRpb24gdmFsdWU9IjQiLz4KCQkJCQkJCQk8SW5kZXhlZCB2YWx1ZT0iMCIvPgoJCQkJCQkJCTxMZW5ndGggdmFsdWU9Ii0xIi8+CgkJCQkJCQkJPE5hbWUgdmFsdWU9ImltYWdlbiIvPgoJCQkJCQkJCTxOdWxsYWJsZSB2YWx1ZT0iMSIvPgoJCQkJCQkJCTxPbl9VcGRhdGVfU2V0X0N1cnJlbnQgdmFsdWU9IjAiLz4KCQkJCQkJCQk8UHJlY2lzaW9uIHZhbHVlPSIwIi8+CgkJCQkJCQkJPFNjYWxlIHZhbHVlPSIwIi8+CgkJCQkJCQkJPFR5cGUgdmFsdWU9IlRleHQiLz4KCQkJCQkJCQk8VW5pcXVlIHZhbHVlPSIwIi8+CgkJCQkJCQkJPFVuc2lnbmVkIHZhbHVlPSIwIi8+CgkJCQkJCQkJPFplcm9maWxsIHZhbHVlPSIwIi8+CgkJCQkJCQk8L1Byb3BlcnRpZXM+CgkJCQkJCQk8Y29udHJvbCB2YWx1ZT0iIi8+CgkJCQkJCQk8ZGVsZXRlIHZhbHVlPSIwIi8+CgkJCQkJCQk8bmFtZSB2YWx1ZT0iaW1hZ2VuIi8+CgkJCQkJCTwvbzM+CgkJCQkJCTxvND4KCQkJCQkJCTxDaGFuZ2VzIHZhbHVlPSIiLz4KCQkJCQkJCTxQcm9wZXJ0aWVzPgoJCQkJCQkJCTxBdXRvaW5jcmVtZW50IHZhbHVlPSIwIi8+CgkJCQkJCQkJPENoYXJzZXQgdmFsdWU9ImxhdGluMSIvPgoJCQkJCQkJCTxDb2xsYXRpb24gdmFsdWU9ImxhdGluMV9zd2VkaXNoX2NpIi8+CgkJCQkJCQkJPENvbW1lbnQgdmFsdWU9IiIvPgoJCQkJCQkJCTxEZWZhdWx0X1ZhbHVlIHZhbHVlPSIiLz4KCQkJCQkJCQk8RmllbGRfUG9zaXRpb24gdmFsdWU9IjIiLz4KCQkJCQkJCQk8SW5kZXhlZCB2YWx1ZT0iMCIvPgoJCQkJCQkJCTxMZW5ndGggdmFsdWU9IjEwMCIvPgoJCQkJCQkJCTxOYW1lIHZhbHVlPSJub21icmUiLz4KCQkJCQkJCQk8TnVsbGFibGUgdmFsdWU9IjEiLz4KCQkJCQkJCQk8T25fVXBkYXRlX1NldF9DdXJyZW50IHZhbHVlPSIwIi8+CgkJCQkJCQkJPFByZWNpc2lvbiB2YWx1ZT0iMCIvPgoJCQkJCQkJCTxTY2FsZSB2YWx1ZT0iMCIvPgoJCQkJCQkJCTxUeXBlIHZhbHVlPSJWYXJDaGFyIi8+CgkJCQkJCQkJPFVuaXF1ZSB2YWx1ZT0iMCIvPgoJCQkJCQkJCTxVbnNpZ25lZCB2YWx1ZT0iMCIvPgoJCQkJCQkJCTxaZXJvZmlsbCB2YWx1ZT0iMCIvPgoJCQkJCQkJPC9Qcm9wZXJ0aWVzPgoJCQkJCQkJPGNvbnRyb2wgdmFsdWU9IiIvPgoJCQkJCQkJPGRlbGV0ZSB2YWx1ZT0iMCIvPgoJCQkJCQkJPG5hbWUgdmFsdWU9Im5vbWJyZSIvPgoJCQkJCQk8L280PgoJCQkJCQk8bzU+CgkJCQkJCQk8Q2hhbmdlcyB2YWx1ZT0iIi8+CgkJCQkJCQk8UHJvcGVydGllcz4KCQkJCQkJCQk8QXV0b2luY3JlbWVudCB2YWx1ZT0iMCIvPgoJCQkJCQkJCTxDaGFyc2V0IHZhbHVlPSIiLz4KCQkJCQkJCQk8Q29sbGF0aW9uIHZhbHVlPSIiLz4KCQkJCQkJCQk8Q29tbWVudCB2YWx1ZT0iIi8+CgkJCQkJCQkJPERlZmF1bHRfVmFsdWUgdmFsdWU9IiIvPgoJCQkJCQkJCTxGaWVsZF9Qb3NpdGlvbiB2YWx1ZT0iNiIvPgoJCQkJCQkJCTxJbmRleGVkIHZhbHVlPSIwIi8+CgkJCQkJCQkJPExlbmd0aCB2YWx1ZT0iLTEiLz4KCQkJCQkJCQk8TmFtZSB2YWx1ZT0idXBkYXRlZF9hdCIvPgoJCQkJCQkJCTxOdWxsYWJsZSB2YWx1ZT0iMSIvPgoJCQkJCQkJCTxPbl9VcGRhdGVfU2V0X0N1cnJlbnQgdmFsdWU9IjAiLz4KCQkJCQkJCQk8UHJlY2lzaW9uIHZhbHVlPSIwIi8+CgkJCQkJCQkJPFNjYWxlIHZhbHVlPSIwIi8+CgkJCQkJCQkJPFR5cGUgdmFsdWU9IlRpbWVzdGFtcCIvPgoJCQkJCQkJCTxVbmlxdWUgdmFsdWU9IjAiLz4KCQkJCQkJCQk8VW5zaWduZWQgdmFsdWU9IjAiLz4KCQkJCQkJCQk8WmVyb2ZpbGwgdmFsdWU9IjAiLz4KCQkJCQkJCTwvUHJvcGVydGllcz4KCQkJCQkJCTxjb250cm9sIHZhbHVlPSIiLz4KCQkJCQkJCTxkZWxldGUgdmFsdWU9IjAiLz4KCQkJCQkJCTxuYW1lIHZhbHVlPSJ1cGRhdGVkX2F0Ii8+CgkJCQkJCTwvbzU+CgkJCQkJPC9maWVsZD4KCQkJCQk8aW5kZXg+CgkJCQkJCTxvMD4KCQkJCQkJCTxDaGFuZ2VzIHZhbHVlPSIiLz4KCQkJCQkJCTxQcm9wZXJ0aWVzPgoJCQkJCQkJCTxDb21tZW50IHZhbHVlPSIiLz4KCQkJCQkJCQk8RmllbGRzIHZhbHVlPSJhV1E9Ii8+CgkJCQkJCQkJPE5hbWUgdmFsdWU9IlBSSU1BUlkiLz4KCQkJCQkJCQk8VHlwZSB2YWx1ZT0iQlRSRUUiLz4KCQkJCQkJCQk8VW5pcXVlIHZhbHVlPSIxIi8+CgkJCQkJCQk8L1Byb3BlcnRpZXM+CgkJCQkJCQk8Y29udHJvbCB2YWx1ZT0iIi8+CgkJCQkJCQk8ZGVsZXRlIHZhbHVlPSIwIi8+CgkJCQkJCQk8bmFtZSB2YWx1ZT0iUFJJTUFSWSIvPgoJCQkJCQk8L28wPgoJCQkJCTwvaW5kZXg+CgkJCQkJPG5hbWUgdmFsdWU9ImZhbWlsaWEiLz4KCQkJCQk8dW5pcXVlPgoJCQkJCQk8bzA+CgkJCQkJCQk8Q2hhbmdlcyB2YWx1ZT0iIi8+CgkJCQkJCQk8UHJvcGVydGllcz4KCQkJCQkJCQk8RmllbGRzIHZhbHVlPSJhV1E9Ii8+CgkJCQkJCQkJPE5hbWUgdmFsdWU9IlBSSU1BUlkiLz4KCQkJCQkJCTwvUHJvcGVydGllcz4KCQkJCQkJCTxjb250cm9sIHZhbHVlPSIiLz4KCQkJCQkJCTxkZWxldGUgdmFsdWU9IjAiLz4KCQkJCQkJCTxuYW1lIHZhbHVlPSJQUklNQVJZIi8+CgkJCQkJCTwvbzA+CgkJCQkJPC91bmlxdWU+CgkJCQk8L28zPgoJCQkJPG80PgoJCQkJCTxDaGFuZ2VzIHZhbHVlPSIiLz4KCQkJCQk8UHJvcGVydGllcz4KCQkJCQkJPEF1dG9pbmNyZW1lbnQgdmFsdWU9IjQiLz4KCQkJCQkJPEF2ZXJhZ2VfUm93X1NpemUgdmFsdWU9IjU0NjEiLz4KCQkJCQkJPENoYXJzZXQgdmFsdWU9ImxhdGluMSIvPgoJCQkJCQk8Q29sbGF0aW9uIHZhbHVlPSJsYXRpbjFfc3dlZGlzaF9jaSIvPgoJCQkJCQk8Q29tbWVudCB2YWx1ZT0iIi8+CgkJCQkJCTxDcmVhdGVfVGltZSB2YWx1ZT0iMjAxNC0wNS0wMiAwMDoyNToyNiIvPgoJCQkJCQk8RW5naW5lIHZhbHVlPSJJbm5vREIiLz4KCQkJCQkJPEZpZWxkX0NvdW50IHZhbHVlPSI1Ii8+CgkJCQkJCTxJbmRleF9Db3VudCB2YWx1ZT0iMSIvPgoJCQkJCQk8TGlua19Db3VudCB2YWx1ZT0iMSIvPgoJCQkJCQk8TmFtZSB2YWx1ZT0idGlwb2NvbWIiLz4KCQkJCQkJPFByaW1hcnlfS2V5IHZhbHVlPSJhV1E9Ii8+CgkJCQkJCTxSZWNvcmRfQ291bnQgdmFsdWU9IjMiLz4KCQkJCQkJPFNpemUgdmFsdWU9IjE2LjAwIEtiIi8+CgkJCQkJCTxUcmlnZ2VyX0NvdW50IHZhbHVlPSIwIi8+CgkJCQkJCTxVbmlxdWVfQ291bnQgdmFsdWU9IjEiLz4KCQkJCQkJPFVwZGF0ZV9UaW1lIHZhbHVlPSIiLz4KCQkJCQk8L1Byb3BlcnRpZXM+CgkJCQkJPGNvbnRyb2wgdmFsdWU9IlRhYmxlNCIvPgoJCQkJCTxkZWxldGUgdmFsdWU9IjAiLz4KCQkJCQk8ZmllbGQ+CgkJCQkJCTxvMD4KCQkJCQkJCTxDaGFuZ2VzIHZhbHVlPSIiLz4KCQkJCQkJCTxQcm9wZXJ0aWVzPgoJCQkJCQkJCTxBdXRvaW5jcmVtZW50IHZhbHVlPSIwIi8+CgkJCQkJCQkJPENoYXJzZXQgdmFsdWU9IiIvPgoJCQkJCQkJCTxDb2xsYXRpb24gdmFsdWU9IiIvPgoJCQkJCQkJCTxDb21tZW50IHZhbHVlPSIiLz4KCQkJCQkJCQk8RGVmYXVsdF9WYWx1ZSB2YWx1ZT0iIi8+CgkJCQkJCQkJPEZpZWxkX1Bvc2l0aW9uIHZhbHVlPSI0Ii8+CgkJCQkJCQkJPEluZGV4ZWQgdmFsdWU9IjAiLz4KCQkJCQkJCQk8TGVuZ3RoIHZhbHVlPSItMSIvPgoJCQkJCQkJCTxOYW1lIHZhbHVlPSJjcmVhdGVkX2F0Ii8+CgkJCQkJCQkJPE51bGxhYmxlIHZhbHVlPSIxIi8+CgkJCQkJCQkJPE9uX1VwZGF0ZV9TZXRfQ3VycmVudCB2YWx1ZT0iMCIvPgoJCQkJCQkJCTxQcmVjaXNpb24gdmFsdWU9IjAiLz4KCQkJCQkJCQk8U2NhbGUgdmFsdWU9IjAiLz4KCQkJCQkJCQk8VHlwZSB2YWx1ZT0iVGltZXN0YW1wIi8+CgkJCQkJCQkJPFVuaXF1ZSB2YWx1ZT0iMCIvPgoJCQkJCQkJCTxVbnNpZ25lZCB2YWx1ZT0iMCIvPgoJCQkJCQkJCTxaZXJvZmlsbCB2YWx1ZT0iMCIvPgoJCQkJCQkJPC9Qcm9wZXJ0aWVzPgoJCQkJCQkJPGNvbnRyb2wgdmFsdWU9IiIvPgoJCQkJCQkJPGRlbGV0ZSB2YWx1ZT0iMCIvPgoJCQkJCQkJPG5hbWUgdmFsdWU9ImNyZWF0ZWRfYXQiLz4KCQkJCQkJPC9vMD4KCQkJCQkJPG8xPgoJCQkJCQkJPENoYW5nZXMgdmFsdWU9IiIvPgoJCQkJCQkJPFByb3BlcnRpZXM+CgkJCQkJCQkJPEF1dG9pbmNyZW1lbnQgdmFsdWU9IjAiLz4KCQkJCQkJCQk8Q2hhcnNldCB2YWx1ZT0ibGF0aW4xIi8+CgkJCQkJCQkJPENvbGxhdGlvbiB2YWx1ZT0ibGF0aW4xX3N3ZWRpc2hfY2kiLz4KCQkJCQkJCQk8Q29tbWVudCB2YWx1ZT0iIi8+CgkJCQkJCQkJPERlZmF1bHRfVmFsdWUgdmFsdWU9IiIvPgoJCQkJCQkJCTxGaWVsZF9Qb3NpdGlvbiB2YWx1ZT0iMyIvPgoJCQkJCQkJCTxJbmRleGVkIHZhbHVlPSIwIi8+CgkJCQkJCQkJPExlbmd0aCB2YWx1ZT0iLTEiLz4KCQkJCQkJCQk8TmFtZSB2YWx1ZT0iZGVzY3JpcGNpb24iLz4KCQkJCQkJCQk8TnVsbGFibGUgdmFsdWU9IjEiLz4KCQkJCQkJCQk8T25fVXBkYXRlX1NldF9DdXJyZW50IHZhbHVlPSIwIi8+CgkJCQkJCQkJPFByZWNpc2lvbiB2YWx1ZT0iMCIvPgoJCQkJCQkJCTxTY2FsZSB2YWx1ZT0iMCIvPgoJCQkJCQkJCTxUeXBlIHZhbHVlPSJUZXh0Ii8+CgkJCQkJCQkJPFVuaXF1ZSB2YWx1ZT0iMCIvPgoJCQkJCQkJCTxVbnNpZ25lZCB2YWx1ZT0iMCIvPgoJCQkJCQkJCTxaZXJvZmlsbCB2YWx1ZT0iMCIvPgoJCQkJCQkJPC9Qcm9wZXJ0aWVzPgoJCQkJCQkJPGNvbnRyb2wgdmFsdWU9IiIvPgoJCQkJCQkJPGRlbGV0ZSB2YWx1ZT0iMCIvPgoJCQkJCQkJPG5hbWUgdmFsdWU9ImRlc2NyaXBjaW9uIi8+CgkJCQkJCTwvbzE+CgkJCQkJCTxvMj4KCQkJCQkJCTxDaGFuZ2VzIHZhbHVlPSIiLz4KCQkJCQkJCTxQcm9wZXJ0aWVzPgoJCQkJCQkJCTxBdXRvaW5jcmVtZW50IHZhbHVlPSIxIi8+CgkJCQkJCQkJPENoYXJzZXQgdmFsdWU9IiIvPgoJCQkJCQkJCTxDb2xsYXRpb24gdmFsdWU9IiIvPgoJCQkJCQkJCTxDb21tZW50IHZhbHVlPSIiLz4KCQkJCQkJCQk8RGVmYXVsdF9WYWx1ZSB2YWx1ZT0iIi8+CgkJCQkJCQkJPEZpZWxkX1Bvc2l0aW9uIHZhbHVlPSIxIi8+CgkJCQkJCQkJPEluZGV4ZWQgdmFsdWU9IjEiLz4KCQkJCQkJCQk8TGVuZ3RoIHZhbHVlPSIxMSIvPgoJCQkJCQkJCTxOYW1lIHZhbHVlPSJpZCIvPgoJCQkJCQkJCTxOdWxsYWJsZSB2YWx1ZT0iMCIvPgoJCQkJCQkJCTxPbl9VcGRhdGVfU2V0X0N1cnJlbnQgdmFsdWU9IjAiLz4KCQkJCQkJCQk8UHJlY2lzaW9uIHZhbHVlPSIxMCIvPgoJCQkJCQkJCTxTY2FsZSB2YWx1ZT0iMCIvPgoJCQkJCQkJCTxUeXBlIHZhbHVlPSJJbnQiLz4KCQkJCQkJCQk8VW5pcXVlIHZhbHVlPSIxIi8+CgkJCQkJCQkJPFVuc2lnbmVkIHZhbHVlPSIwIi8+CgkJCQkJCQkJPFplcm9maWxsIHZhbHVlPSIwIi8+CgkJCQkJCQk8L1Byb3BlcnRpZXM+CgkJCQkJCQk8Y29udHJvbCB2YWx1ZT0iIi8+CgkJCQkJCQk8ZGVsZXRlIHZhbHVlPSIwIi8+CgkJCQkJCQk8bmFtZSB2YWx1ZT0iaWQiLz4KCQkJCQkJPC9vMj4KCQkJCQkJPG8zPgoJCQkJCQkJPENoYW5nZXMgdmFsdWU9IiIvPgoJCQkJCQkJPFByb3BlcnRpZXM+CgkJCQkJCQkJPEF1dG9pbmNyZW1lbnQgdmFsdWU9IjAiLz4KCQkJCQkJCQk8Q2hhcnNldCB2YWx1ZT0ibGF0aW4xIi8+CgkJCQkJCQkJPENvbGxhdGlvbiB2YWx1ZT0ibGF0aW4xX3N3ZWRpc2hfY2kiLz4KCQkJCQkJCQk8Q29tbWVudCB2YWx1ZT0iIi8+CgkJCQkJCQkJPERlZmF1bHRfVmFsdWUgdmFsdWU9IiIvPgoJCQkJCQkJCTxGaWVsZF9Qb3NpdGlvbiB2YWx1ZT0iMiIvPgoJCQkJCQkJCTxJbmRleGVkIHZhbHVlPSIwIi8+CgkJCQkJCQkJPExlbmd0aCB2YWx1ZT0iMTAwIi8+CgkJCQkJCQkJPE5hbWUgdmFsdWU9Im5vbWJyZSIvPgoJCQkJCQkJCTxOdWxsYWJsZSB2YWx1ZT0iMSIvPgoJCQkJCQkJCTxPbl9VcGRhdGVfU2V0X0N1cnJlbnQgdmFsdWU9IjAiLz4KCQkJCQkJCQk8UHJlY2lzaW9uIHZhbHVlPSIwIi8+CgkJCQkJCQkJPFNjYWxlIHZhbHVlPSIwIi8+CgkJCQkJCQkJPFR5cGUgdmFsdWU9IlZhckNoYXIiLz4KCQkJCQkJCQk8VW5pcXVlIHZhbHVlPSIwIi8+CgkJCQkJCQkJPFVuc2lnbmVkIHZhbHVlPSIwIi8+CgkJCQkJCQkJPFplcm9maWxsIHZhbHVlPSIwIi8+CgkJCQkJCQk8L1Byb3BlcnRpZXM+CgkJCQkJCQk8Y29udHJvbCB2YWx1ZT0iIi8+CgkJCQkJCQk8ZGVsZXRlIHZhbHVlPSIwIi8+CgkJCQkJCQk8bmFtZSB2YWx1ZT0ibm9tYnJlIi8+CgkJCQkJCTwvbzM+CgkJCQkJCTxvND4KCQkJCQkJCTxDaGFuZ2VzIHZhbHVlPSIiLz4KCQkJCQkJCTxQcm9wZXJ0aWVzPgoJCQkJCQkJCTxBdXRvaW5jcmVtZW50IHZhbHVlPSIwIi8+CgkJCQkJCQkJPENoYXJzZXQgdmFsdWU9IiIvPgoJCQkJCQkJCTxDb2xsYXRpb24gdmFsdWU9IiIvPgoJCQkJCQkJCTxDb21tZW50IHZhbHVlPSJQYXJhIGN1YnJpciBsb3MgZGlzdGludG9zIE1lbsO6ZXMgZGlhcmlvcyBkZSBLYW5nbyIvPgoJCQkJCQkJCTxEZWZhdWx0X1ZhbHVlIHZhbHVlPSIiLz4KCQkJCQkJCQk8RmllbGRfUG9zaXRpb24gdmFsdWU9IjUiLz4KCQkJCQkJCQk8SW5kZXhlZCB2YWx1ZT0iMCIvPgoJCQkJCQkJCTxMZW5ndGggdmFsdWU9Ii0xIi8+CgkJCQkJCQkJPE5hbWUgdmFsdWU9InVwZGF0ZWRfYXQiLz4KCQkJCQkJCQk8TnVsbGFibGUgdmFsdWU9IjEiLz4KCQkJCQkJCQk8T25fVXBkYXRlX1NldF9DdXJyZW50IHZhbHVlPSIwIi8+CgkJCQkJCQkJPFByZWNpc2lvbiB2YWx1ZT0iMCIvPgoJCQkJCQkJCTxTY2FsZSB2YWx1ZT0iMCIvPgoJCQkJCQkJCTxUeXBlIHZhbHVlPSJUaW1lc3RhbXAiLz4KCQkJCQkJCQk8VW5pcXVlIHZhbHVlPSIwIi8+CgkJCQkJCQkJPFVuc2lnbmVkIHZhbHVlPSIwIi8+CgkJCQkJCQkJPFplcm9maWxsIHZhbHVlPSIwIi8+CgkJCQkJCQk8L1Byb3BlcnRpZXM+CgkJCQkJCQk8Y29udHJvbCB2YWx1ZT0iIi8+CgkJCQkJCQk8ZGVsZXRlIHZhbHVlPSIwIi8+CgkJCQkJCQk8bmFtZSB2YWx1ZT0idXBkYXRlZF9hdCIvPgoJCQkJCQk8L280PgoJCQkJCTwvZmllbGQ+CgkJCQkJPGluZGV4PgoJCQkJCQk8bzA+CgkJCQkJCQk8Q2hhbmdlcyB2YWx1ZT0iIi8+CgkJCQkJCQk8UHJvcGVydGllcz4KCQkJCQkJCQk8Q29tbWVudCB2YWx1ZT0iIi8+CgkJCQkJCQkJPEZpZWxkcyB2YWx1ZT0iYVdRPSIvPgoJCQkJCQkJCTxOYW1lIHZhbHVlPSJQUklNQVJZIi8+CgkJCQkJCQkJPFR5cGUgdmFsdWU9IkJUUkVFIi8+CgkJCQkJCQkJPFVuaXF1ZSB2YWx1ZT0iMSIvPgoJCQkJCQkJPC9Qcm9wZXJ0aWVzPgoJCQkJCQkJPGNvbnRyb2wgdmFsdWU9IiIvPgoJCQkJCQkJPGRlbGV0ZSB2YWx1ZT0iMCIvPgoJCQkJCQkJPG5hbWUgdmFsdWU9IlBSSU1BUlkiLz4KCQkJCQkJPC9vMD4KCQkJCQk8L2luZGV4PgoJCQkJCTxuYW1lIHZhbHVlPSJ0aXBvY29tYiIvPgoJCQkJCTx1bmlxdWU+CgkJCQkJCTxvMD4KCQkJCQkJCTxDaGFuZ2VzIHZhbHVlPSIiLz4KCQkJCQkJCTxQcm9wZXJ0aWVzPgoJCQkJCQkJCTxGaWVsZHMgdmFsdWU9ImFXUT0iLz4KCQkJCQkJCQk8TmFtZSB2YWx1ZT0iUFJJTUFSWSIvPgoJCQkJCQkJPC9Qcm9wZXJ0aWVzPgoJCQkJCQkJPGNvbnRyb2wgdmFsdWU9IiIvPgoJCQkJCQkJPGRlbGV0ZSB2YWx1ZT0iMCIvPgoJCQkJCQkJPG5hbWUgdmFsdWU9IlBSSU1BUlkiLz4KCQkJCQkJPC9vMD4KCQkJCQk8L3VuaXF1ZT4KCQkJCTwvbzQ+CgkJCTwvdGFibGU+CgkJPC9kYl80cmVzdD4KCTwvTW9kZWw+CjwvcHJvcGVydGllcz4KCg==', NULL, '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', NULL, '2014-05-05 08:24:59', '36');

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `areadeproduccion`
--
ALTER TABLE `areadeproduccion`
  ADD CONSTRAINT `fk_AreadeProduccion_1` FOREIGN KEY (`id_tipo`) REFERENCES `tipoareadeproduccion` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_AreadeProduccion_2` FOREIGN KEY (`id_restaurante`) REFERENCES `restaurante` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `caja`
--
ALTER TABLE `caja`
  ADD CONSTRAINT `caja_restaurante_id_foreign` FOREIGN KEY (`restaurante_id`) REFERENCES `restaurante` (`id`);

--
-- Filtros para la tabla `combinacion`
--
ALTER TABLE `combinacion`
  ADD CONSTRAINT `fk_Combinacion_TipoComb1` FOREIGN KEY (`TipoComb_id`) REFERENCES `tipocomb` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `detallecaja`
--
ALTER TABLE `detallecaja`
  ADD CONSTRAINT `fk_caja_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_detallecaja_1` FOREIGN KEY (`caja_id`) REFERENCES `caja` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `detalleingresoinsumo`
--
ALTER TABLE `detalleingresoinsumo`
  ADD CONSTRAINT `fk_DetalleIngresoInsumo_Ingreso1` FOREIGN KEY (`ingreso_id`) REFERENCES `pedidocompra` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_DetalleIngresoInsumo_Insumo1` FOREIGN KEY (`insumo_id`) REFERENCES `insumo` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `detallenotas`
--
ALTER TABLE `detallenotas`
  ADD CONSTRAINT `detallenotas_detallepedido_id_foreign` FOREIGN KEY (`detallePedido_id`) REFERENCES `detallepedido` (`id`),
  ADD CONSTRAINT `detallenotas_notas_id_foreign` FOREIGN KEY (`notas_id`) REFERENCES `notas` (`id`);

--
-- Filtros para la tabla `detallepedido`
--
ALTER TABLE `detallepedido`
  ADD CONSTRAINT `fk_detallepedido_2` FOREIGN KEY (`combinacion_id`) REFERENCES `combinacion` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_detallePedido_Pedido1` FOREIGN KEY (`pedido_id`) REFERENCES `pedido` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_detallePedido_Producto1` FOREIGN KEY (`producto_id`) REFERENCES `producto` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `Detformadepago`
--
ALTER TABLE `Detformadepago`
  ADD CONSTRAINT `detformadepago_formadepago_id_foreign` FOREIGN KEY (`formadepago_id`) REFERENCES `formadepago` (`id`),
  ADD CONSTRAINT `detformadepago_ticket_id_foreign` FOREIGN KEY (`ticket_id`) REFERENCES `ticketventa` (`id`);

--
-- Filtros para la tabla `detinfnutr`
--
ALTER TABLE `detinfnutr`
  ADD CONSTRAINT `fk_detInfNutr_InfNut1` FOREIGN KEY (`infNut_id`) REFERENCES `infnut` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_detInfNutr_Producto1` FOREIGN KEY (`producto_id`) REFERENCES `producto` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `detmesa`
--
ALTER TABLE `detmesa`
  ADD CONSTRAINT `fk_detMesa_Mesa1` FOREIGN KEY (`mesa_id`) REFERENCES `mesa` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_detMesa_Pedido1` FOREIGN KEY (`pedido_id`) REFERENCES `pedido` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `detpedidosabores`
--
ALTER TABLE `detpedidosabores`
  ADD CONSTRAINT `detpedidosabores_detpedido_id_foreign` FOREIGN KEY (`detpedido_id`) REFERENCES `detallepedido` (`id`),
  ADD CONSTRAINT `detpedidosabores_sabor_id_foreign` FOREIGN KEY (`sabor_id`) REFERENCES `sabor` (`id`);

--
-- Filtros para la tabla `detprecio`
--
ALTER TABLE `detprecio`
  ADD CONSTRAINT `detprecio_precio_id_foreign` FOREIGN KEY (`precio_id`) REFERENCES `precio` (`id`),
  ADD CONSTRAINT `detprecio_restaurante_id_foreign` FOREIGN KEY (`restaurante_id`) REFERENCES `restaurante` (`id`);

--
-- Filtros para la tabla `detproadicional`
--
ALTER TABLE `detproadicional`
  ADD CONSTRAINT `detproadicional_proadi_id_foreign` FOREIGN KEY (`proadi_id`) REFERENCES `producto` (`id`),
  ADD CONSTRAINT `detproadicional_producto_id_foreign` FOREIGN KEY (`producto_id`) REFERENCES `producto` (`id`);

--
-- Filtros para la tabla `detsabores`
--
ALTER TABLE `detsabores`
  ADD CONSTRAINT `detsabores_producto_id_foreign` FOREIGN KEY (`producto_id`) REFERENCES `producto` (`id`),
  ADD CONSTRAINT `detsabores_sabor_id_foreign` FOREIGN KEY (`sabor_id`) REFERENCES `sabor` (`id`);

--
-- Filtros para la tabla `dettiketpedido`
--
ALTER TABLE `dettiketpedido`
  ADD CONSTRAINT `dettiketpedido_combinacion_id_foreign` FOREIGN KEY (`combinacion_id`) REFERENCES `combinacion` (`id`),
  ADD CONSTRAINT `dettiketpedido_pedido_id_foreign` FOREIGN KEY (`pedido_id`) REFERENCES `pedido` (`id`),
  ADD CONSTRAINT `dettiketpedido_ticket_id_foreign` FOREIGN KEY (`ticket_id`) REFERENCES `ticketventa` (`id`);

--
-- Filtros para la tabla `insumo`
--
ALTER TABLE `insumo`
  ADD CONSTRAINT `fk_Insumo_tipoins1` FOREIGN KEY (`tipoins_id`) REFERENCES `tipoins` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `mesa`
--
ALTER TABLE `mesa`
  ADD CONSTRAINT `fk_mesa_1` FOREIGN KEY (`actividad`) REFERENCES `usuario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Mesa_Salon1` FOREIGN KEY (`salon_id`) REFERENCES `salon` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `notaxproducto`
--
ALTER TABLE `notaxproducto`
  ADD CONSTRAINT `fk_notaxproducto_1` FOREIGN KEY (`nota_id`) REFERENCES `notas` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_notaxproducto_2` FOREIGN KEY (`producto_id`) REFERENCES `producto` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `pedido`
--
ALTER TABLE `pedido`
  ADD CONSTRAINT `fk_pedido_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Pedido_Persona2` FOREIGN KEY (`cliente_id`) REFERENCES `persona` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `pedidocompra`
--
ALTER TABLE `pedidocompra`
  ADD CONSTRAINT `fk_Ingreso_Persona1` FOREIGN KEY (`proveedor_id`) REFERENCES `persona` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Ingreso_Persona2` FOREIGN KEY (`usuario_id`) REFERENCES `persona` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `permisos`
--
ALTER TABLE `permisos`
  ADD CONSTRAINT `fk_id_modulo` FOREIGN KEY (`id_modulo`) REFERENCES `modulos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_id_perfil` FOREIGN KEY (`id_perfil`) REFERENCES `perfil` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `persona`
--
ALTER TABLE `persona`
  ADD CONSTRAINT `fk_Persona_Perfil1` FOREIGN KEY (`perfil_id`) REFERENCES `perfil` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `precio`
--
ALTER TABLE `precio`
  ADD CONSTRAINT `fk_Precio_Combinacion1` FOREIGN KEY (`combinacion_id`) REFERENCES `combinacion` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Precio_Producto1` FOREIGN KEY (`producto_id`) REFERENCES `producto` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `producto`
--
ALTER TABLE `producto`
  ADD CONSTRAINT `fk_Producto_1` FOREIGN KEY (`id_tipoarepro`) REFERENCES `tipoareadeproduccion` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_Producto_Familia1` FOREIGN KEY (`familia_id`) REFERENCES `familia` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `receta`
--
ALTER TABLE `receta`
  ADD CONSTRAINT `fk_detProducto_Insumo1` FOREIGN KEY (`insumo_id`) REFERENCES `insumo` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_detProducto_Producto1` FOREIGN KEY (`producto_id`) REFERENCES `producto` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `registrogastoscaja`
--
ALTER TABLE `registrogastoscaja`
  ADD CONSTRAINT `registrogastoscaja_detallecaja_id_foreign` FOREIGN KEY (`detallecaja_id`) REFERENCES `detallecaja` (`id`),
  ADD CONSTRAINT `registrogastoscaja_tipogasto_id_foreign` FOREIGN KEY (`tipogasto_id`) REFERENCES `tipodegasto` (`id`);

--
-- Filtros para la tabla `sabor`
--
ALTER TABLE `sabor`
  ADD CONSTRAINT `sabor_insumo_id_foreign` FOREIGN KEY (`insumo_id`) REFERENCES `insumo` (`id`);

--
-- Filtros para la tabla `salon`
--
ALTER TABLE `salon`
  ADD CONSTRAINT `fk_Salon_Restaurante1` FOREIGN KEY (`restaurante_id`) REFERENCES `restaurante` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `ticketventa`
--
ALTER TABLE `ticketventa`
  ADD CONSTRAINT `fk_ticketventa_1` FOREIGN KEY (`pedido_id`) REFERENCES `pedido` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_ticketventa_2` FOREIGN KEY (`caja_id`) REFERENCES `caja` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_ticketventa_3` FOREIGN KEY (`detcaja_id`) REFERENCES `detallecaja` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `fk_Usuario_1` FOREIGN KEY (`persona_id`) REFERENCES `persona` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Usuario_2` FOREIGN KEY (`id_restaurante`) REFERENCES `restaurante` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Usuario_3` FOREIGN KEY (`id_tipoareapro`) REFERENCES `areadeproduccion` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Usuario_4` FOREIGN KEY (`colaborador`) REFERENCES `colaborador` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
