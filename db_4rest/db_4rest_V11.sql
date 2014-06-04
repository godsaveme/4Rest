-- phpMyAdmin SQL Dump
-- version 3.5.8.2
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 15-03-2014 a las 00:09:20
-- Versión del servidor: 5.5.35-MariaDB
-- Versión de PHP: 5.5.9

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
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
-- Estructura de tabla para la tabla `AreadeProduccion`
--

CREATE TABLE IF NOT EXISTS `AreadeProduccion` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `descripcion` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `id_tipo` int(11) NOT NULL,
  `id_restaurante` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Caja`
--

CREATE TABLE IF NOT EXISTS `Caja` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `montoInicial` decimal(10,2) DEFAULT NULL,
  `deberiaHaber` decimal(10,2) DEFAULT NULL COMMENT 'si en el dia se compra a un proveedor con plata sacada de caja',
  `montoFinal` decimal(10,2) DEFAULT NULL,
  `diferencia` decimal(10,2) DEFAULT NULL COMMENT 'Monto final - deberia haber',
  `montoDejado` decimal(10,2) DEFAULT NULL,
  `estado` varchar(1) DEFAULT NULL COMMENT 'abierto (a)\n cerrado (c) \neliminado (e)',
  `fechaInicio` timestamp NULL DEFAULT NULL,
  `fechaCierre` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `CatNotas`
--

CREATE TABLE IF NOT EXISTS `CatNotas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) DEFAULT NULL,
  `descripcion` text,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Combinacion`
--

CREATE TABLE IF NOT EXISTS `Combinacion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(300) DEFAULT NULL,
  `descripcion` text,
  `HoraInicio` time DEFAULT NULL,
  `HoraTermino` time DEFAULT NULL,
  `FechaInicio` timestamp NULL DEFAULT NULL,
  `FechaTermino` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `TipoComb_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_Combinacion_TipoComb1_idx` (`TipoComb_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Volcado de datos para la tabla `Combinacion`
--

INSERT INTO `Combinacion` (`id`, `nombre`, `descripcion`, `HoraInicio`, `HoraTermino`, `FechaInicio`, `FechaTermino`, `created_at`, `updated_at`, `TipoComb_id`) VALUES
(1, 'Normal', 'Precios Normale', '00:00:00', '23:59:59', '2014-02-21 05:00:00', '2015-02-21 05:00:00', '2014-02-22 01:08:05', '2014-02-22 01:08:05', 3),
(2, 'Menu Lunes', 'Menu del dia', '01:00:00', '03:00:00', '2014-02-25 05:00:00', '2014-02-25 05:00:00', '2014-02-24 22:37:27', '2014-02-24 22:37:27', 1),
(3, 'Normal', 'asdasd', '01:39:27', '01:41:29', '2014-02-25 05:00:00', '2014-02-25 05:00:00', '2014-02-24 22:41:45', '2014-02-24 22:41:45', 1),
(4, 'menu martes', 'Menu del dia', '01:42:31', '03:42:33', '2014-02-25 05:00:00', '2014-02-25 05:00:00', '2014-02-24 22:50:43', '2014-02-24 22:50:43', 1),
(5, 'menu martes', 'Menu del dia', '01:42:31', '03:42:33', '2014-02-25 05:00:00', '2014-02-25 05:00:00', '2014-02-24 22:51:20', '2014-02-24 22:51:20', 1),
(6, 'menu miercoles', 'menu', '01:00:00', '03:00:00', '2014-02-26 05:00:00', '2014-02-26 05:00:00', '2014-02-25 16:45:09', '2014-02-25 16:45:09', 1),
(7, 'Memu martes', 'Mueno del martes', '01:00:00', '03:00:00', '2014-02-27 05:00:00', '2014-02-28 05:00:00', '2014-02-26 19:38:29', '2014-02-26 19:38:29', 1),
(8, 'Memu 05/03/2014', 'kjasdkjashd', '12:00:00', '15:00:00', '2014-03-05 05:00:00', '2014-03-05 05:00:00', '2014-03-05 00:27:51', '2014-03-05 00:27:51', 1),
(9, 'Memu 05/03/2014', 'kjasdkjashd', '12:00:00', '15:00:00', '2014-03-05 05:00:00', '2014-03-05 05:00:00', '2014-03-05 00:27:51', '2014-03-05 00:27:51', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `DetalleIngresoInsumo`
--

CREATE TABLE IF NOT EXISTS `DetalleIngresoInsumo` (
  `ingreso_id` int(11) NOT NULL,
  `insumo_id` int(11) NOT NULL,
  `cantidad` decimal(10,2) DEFAULT NULL,
  `costo` decimal(10,2) DEFAULT NULL COMMENT 'costo del insumo en ese instante\n',
  `importe_final` decimal(10,2) DEFAULT NULL,
  `descuento_final` decimal(10,2) NOT NULL DEFAULT '0.00',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`ingreso_id`,`insumo_id`),
  KEY `fk_DetalleIngresoInsumo_Ingreso1_idx` (`ingreso_id`),
  KEY `fk_DetalleIngresoInsumo_Insumo1_idx` (`insumo_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `DetalleIngresoInsumo`
--

INSERT INTO `DetalleIngresoInsumo` (`ingreso_id`, `insumo_id`, `cantidad`, `costo`, `importe_final`, `descuento_final`, `created_at`, `updated_at`) VALUES
(1, 1, '3.00', '10.00', '10.00', '0.00', '2014-03-13 00:10:18', '2014-03-13 00:10:18'),
(1, 2, '6.00', '2.17', '13.00', '5.00', '2014-03-13 00:10:18', '2014-03-13 00:10:18'),
(2, 2, '11.00', '2.73', '30.00', '3.00', '2014-03-13 00:16:19', '2014-03-13 00:16:19'),
(2, 5, '1.00', '10.00', '10.00', '0.00', '2014-03-13 00:16:19', '2014-03-13 00:16:19'),
(3, 1, '1.00', '10.00', '10.00', '0.00', '2014-03-13 00:22:09', '2014-03-13 00:22:09'),
(3, 2, '1.00', '3.00', '3.00', '0.00', '2014-03-13 00:22:09', '2014-03-13 00:22:09');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalleNotas`
--

CREATE TABLE IF NOT EXISTS `detalleNotas` (
  `notas_id` int(11) NOT NULL,
  `detallePedido_id` int(11) NOT NULL COMMENT 'Solo se requiere el id del detalle Pedido.',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`notas_id`,`detallePedido_id`),
  KEY `fk_detalleNotas_detallePedido1_idx` (`detallePedido_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detallePedido`
--

CREATE TABLE IF NOT EXISTS `detallePedido` (
  `id` int(11) NOT NULL,
  `pedido_id` int(11) NOT NULL,
  `producto_id` int(11) NOT NULL,
  `precioUnidadFinal` decimal(10,2) DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL COMMENT 'siempre serán unidades',
  `importeFinal` decimal(10,2) DEFAULT NULL,
  `descuento` double DEFAULT NULL COMMENT 'es en porcentaje.. 0 a 1.. Si se sabe cuanto bajarle.. se pondrá el monto y se calculará el % q refleja.',
  `estado` char(1) DEFAULT NULL COMMENT 'Iniciado (i), En proceso (p), Para despachar (p), Despachado (d).',
  `fechaInicio` timestamp NULL DEFAULT NULL,
  `fechaProceso` timestamp NULL DEFAULT NULL,
  `fechaDespacho` timestamp NULL DEFAULT NULL,
  `fechaDespachado` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `detalle_id` int(11) DEFAULT NULL COMMENT 'en los productos adicionales, los detalles_id se llena con el id_DETALLE PEDIDO al cual el producto es adicional',
  PRIMARY KEY (`id`,`pedido_id`,`producto_id`),
  KEY `fk_detallePedido_Producto1_idx` (`producto_id`),
  KEY `fk_detallePedido_Pedido1` (`pedido_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detInfNutr`
--

CREATE TABLE IF NOT EXISTS `detInfNutr` (
  `infNut_id` int(11) NOT NULL,
  `producto_id` int(11) NOT NULL,
  `cantidad` decimal(10,4) DEFAULT NULL,
  `UnidadMedida` varchar(45) DEFAULT NULL COMMENT 'litros kilos unidades',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`infNut_id`,`producto_id`),
  KEY `fk_detInfNutr_Producto1_idx` (`producto_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detMesa`
--

CREATE TABLE IF NOT EXISTS `detMesa` (
  `Pedido_idPedido` int(11) NOT NULL,
  `Mesa_idMesa` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`Pedido_idPedido`,`Mesa_idMesa`),
  KEY `fk_detMesa_Mesa1_idx` (`Mesa_idMesa`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detProd`
--

CREATE TABLE IF NOT EXISTS `detProd` (
  `parent_id` int(11) NOT NULL,
  `child_id` int(11) NOT NULL,
  `cantidad` decimal(10,2) DEFAULT NULL,
  `seleccionador` int(11) DEFAULT NULL COMMENT 'para seleccionar el frutimix escogido en el desayuno x example',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`parent_id`,`child_id`),
  KEY `fk_detProd_Producto2_idx` (`child_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `detProd`
--

INSERT INTO `detProd` (`parent_id`, `child_id`, `cantidad`, `seleccionador`, `created_at`, `updated_at`) VALUES
(13, 2, '1.00', NULL, '2014-03-05 00:22:38', '2014-03-05 00:22:38'),
(13, 12, '1.00', NULL, '2014-03-05 00:22:38', '2014-03-05 00:22:38');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Documentos`
--

CREATE TABLE IF NOT EXISTS `Documentos` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_tipodedocumento` int(11) NOT NULL,
  `ndocumento` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Familia`
--

CREATE TABLE IF NOT EXISTS `Familia` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) DEFAULT NULL,
  `descripcion` text,
  `imagen` text COMMENT '''ruta''',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `Familia`
--

INSERT INTO `Familia` (`id`, `nombre`, `descripcion`, `imagen`, `created_at`, `updated_at`) VALUES
(1, 'Adicionales', 'Adicionales', '/tmp/phpTDxuao', '2014-02-22 19:59:17', '2014-02-22 20:00:04'),
(3, 'Desayunos', 'Desayunos', '3_Captura de pantalla de 2014-02-21 15:57:27.png', '2014-02-22 20:02:09', '2014-02-22 20:02:09');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `InfNut`
--

CREATE TABLE IF NOT EXISTS `InfNut` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) DEFAULT NULL,
  `descripcion` text,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Insumo`
--

CREATE TABLE IF NOT EXISTS `Insumo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(300) DEFAULT NULL,
  `descripcion` text,
  `stock` decimal(10,2) DEFAULT NULL,
  `stockMin` decimal(10,2) DEFAULT NULL,
  `stockMax` decimal(10,2) DEFAULT NULL,
  `unidadMedida` varchar(45) DEFAULT NULL COMMENT '''unidades, litros kilos''',
  `costo` decimal(10,2) DEFAULT NULL COMMENT 'costo del insumo promedio.',
  `selector` int(11) NOT NULL COMMENT 'Selector para saber si es insumo de provedor o de area de producción',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `tipoins_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_Insumo_tipoins1_idx` (`tipoins_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Volcado de datos para la tabla `Insumo`
--

INSERT INTO `Insumo` (`id`, `nombre`, `descripcion`, `stock`, `stockMin`, `stockMax`, `unidadMedida`, `costo`, `selector`, `created_at`, `updated_at`, `tipoins_id`) VALUES
(1, 'insumo1', 'asasd', '20.00', NULL, NULL, 'Kilogramos', '10.00', 0, '2014-02-22 01:11:47', '2014-02-22 01:11:47', NULL),
(2, 'insumo2', 'asdñasd', '30.00', NULL, NULL, 'Kilogramos', '3.00', 0, '2014-02-22 01:12:05', '2014-02-22 01:12:05', NULL),
(3, 'helado de chocolate', 'helados', '10.00', NULL, NULL, 'Litros', '1.50', 0, '2014-02-26 19:40:06', '2014-02-26 19:40:06', NULL),
(4, 'leche', 'lacteo', '15.00', NULL, NULL, 'Litros', '1.20', 0, '2014-02-26 19:41:01', '2014-02-26 19:41:01', NULL),
(5, 'insumo4', 'insumo', '10.00', NULL, NULL, 'Unidades', '10.00', 0, '2014-03-05 00:14:52', '2014-03-05 00:14:52', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Mesa`
--

CREATE TABLE IF NOT EXISTS `Mesa` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) DEFAULT NULL,
  `descripcion` text,
  `salon_id` int(11) NOT NULL,
  `estado` tinyint(1) DEFAULT NULL COMMENT '0 --> deshabilitado\n1 --> habilitado.',
  `habilitado` tinyint(1) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_Mesa_Salon1_idx` (`salon_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
('2014_03_06_121411_tipodocumento', 1),
('2014_03_06_122015_documentos', 2),
('2014_03_14_174555_tipoareadeproduccion', 3),
('2014_03_14_174745_areadeproduccion', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Modulos`
--

CREATE TABLE IF NOT EXISTS `Modulos` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id producto',
  `controlador` varchar(255) NOT NULL COMMENT 'nombre de controlador',
  `proceso` varchar(50) NOT NULL COMMENT 'nombre de metodo',
  `activo` tinyint(1) NOT NULL COMMENT 'si esta activo el proceso o no',
  `nombre` varchar(255) NOT NULL COMMENT 'Nombre dek proceso personalizado',
  `nmodulo` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='Tabla para asignar permisos a los usarios se enlaza con perfiles' AUTO_INCREMENT=16 ;

--
-- Volcado de datos para la tabla `Modulos`
--

INSERT INTO `Modulos` (`id`, `controlador`, `proceso`, `activo`, `nombre`, `nmodulo`, `created_at`, `updated_at`) VALUES
(1, 'PerfilesController', 'index', 1, 'Listar', 'Perfiles', '2014-03-05 00:12:50', '2014-03-05 00:12:50'),
(2, 'PerfilesController', 'Create', 1, 'Crear', 'Perfiles', '2014-03-04 16:48:35', '2014-03-03 22:18:58'),
(3, 'PerfilesController', 'edit', 1, 'Editar', 'Perfiles', '2014-03-04 16:48:45', '2014-03-03 22:21:07'),
(4, 'PerfilesController', 'destroy', 1, 'Eliminar', 'Perfiles', '2014-03-04 16:48:53', '2014-03-03 22:22:15'),
(5, 'PersonasController', 'index', 1, 'Listar', 'Personas', '2014-03-04 21:57:10', '2014-03-04 21:57:10'),
(6, 'PersonasController', 'create', 1, 'Crear', 'Personas', '2014-03-04 21:57:29', '2014-03-04 21:57:29'),
(8, 'PersonasController', 'edit', 1, 'Editar', 'Personas', '2014-03-04 21:58:42', '2014-03-04 21:58:42'),
(9, 'PersonasController', 'destroy', 1, 'Eliminar', 'Personas', '2014-03-04 21:59:34', '2014-03-04 21:59:34'),
(10, 'ProductosController', 'index', 1, 'Listar', 'Productos', '2014-03-04 22:02:03', '2014-03-04 22:02:03'),
(11, 'ProductosController', 'create', 1, 'Crear', 'Productos', '2014-03-04 22:02:40', '2014-03-04 22:02:40'),
(12, 'ProductosController', 'edit', 1, 'Editar', 'Productos', '2014-03-04 22:03:07', '2014-03-04 22:03:07'),
(13, 'ProductosController', 'destroy', 1, 'Eliminar', 'Productos', '2014-03-04 22:03:20', '2014-03-04 22:03:20'),
(14, 'CombinacionsController', 'create', 1, 'Crear', 'Combinaciones', '2014-03-05 21:11:20', '2014-03-05 21:11:20'),
(15, 'CombinacionsController', 'edit', 1, 'Editar', 'Combinaciones', '2014-03-05 21:11:39', '2014-03-05 21:11:39');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Notas`
--

CREATE TABLE IF NOT EXISTS `Notas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) DEFAULT NULL,
  `descripcion` text,
  `catNot_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_Notas_CategoriaNotas1_idx` (`catNot_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Pedido`
--

CREATE TABLE IF NOT EXISTS `Pedido` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fechaInicio` timestamp NULL DEFAULT NULL,
  `fechaCancelacion` timestamp NULL DEFAULT NULL,
  `numeroComensales` int(11) DEFAULT NULL,
  `estado` char(1) DEFAULT NULL,
  `importeFinal` decimal(10,2) DEFAULT NULL COMMENT 'el total de cuento se pago con todo y descuento incluido.',
  `descuento` double DEFAULT NULL COMMENT 'es en porcentaje.. 0 a 1.. Si se sabe cuanto bajarle.. se pondrá el monto y se calculará el % q refleja.\n\nEste descuento es aplicado al importe total de venta.',
  `usuario_id` int(11) DEFAULT NULL COMMENT 'id de persona mozo x ejemplo\n',
  `cliente_id` int(11) DEFAULT NULL COMMENT 'id de cliente',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_Pedido_Persona1_idx` (`usuario_id`),
  KEY `fk_Pedido_Persona2_idx` (`cliente_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `PedidoCompra`
--

CREATE TABLE IF NOT EXISTS `PedidoCompra` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'si se compra un producto final se va al insumo tb\nsi se compra un insumo se queda ahi',
  `fecha` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `proveedor_id` int(11) DEFAULT NULL COMMENT 'de tal proveedor',
  `importeFinal` decimal(10,2) DEFAULT NULL,
  `descuentofinal` decimal(10,2) NOT NULL DEFAULT '0.00',
  `usuario_id` int(11) DEFAULT NULL COMMENT 'creado por tal usuario',
  `estado` tinyint(1) DEFAULT '0' COMMENT '0 --> anulado1 --> habilitado',
  `id_documento` int(11) NOT NULL,
  `tipo_orden` tinyint(4) NOT NULL COMMENT '1 si es a provedor, 2 si es al área de producción',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_Ingreso_Persona1_idx` (`proveedor_id`),
  KEY `fk_Ingreso_Persona2_idx` (`usuario_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `PedidoCompra`
--

INSERT INTO `PedidoCompra` (`id`, `fecha`, `proveedor_id`, `importeFinal`, `descuentofinal`, `usuario_id`, `estado`, `id_documento`, `tipo_orden`, `created_at`, `updated_at`) VALUES
(1, '2014-03-13 00:10:18', 5, '28.00', '0.00', NULL, 0, 0, 0, '2014-03-13 00:10:18', '2014-03-13 00:10:18'),
(2, '2014-03-13 00:16:19', 5, '43.00', '3.00', NULL, 0, 0, 1, '2014-03-13 00:16:19', '2014-03-13 00:16:19'),
(3, '2014-03-13 00:22:09', 5, '13.00', '0.00', 2, 0, 0, 1, '2014-03-13 00:22:09', '2014-03-13 00:22:09');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Perfil`
--

CREATE TABLE IF NOT EXISTS `Perfil` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) DEFAULT NULL,
  `descripcion` text,
  `selector` tinyint(4) NOT NULL COMMENT 'Para saber si es perfil para empresa o persona',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Volcado de datos para la tabla `Perfil`
--

INSERT INTO `Perfil` (`id`, `nombre`, `descripcion`, `selector`, `created_at`, `updated_at`) VALUES
(1, 'Administrador', 'Administrador del sistema todos los privilegio', 1, '2014-02-25 21:38:24', '2014-02-26 21:41:04'),
(2, 'Mozo', 'Mozo', 1, '2014-02-26 18:09:08', '2014-02-26 21:41:09'),
(3, 'Cliente', 'Cliente', 1, '2014-02-26 18:09:18', '2014-02-26 21:41:55'),
(4, 'Provedor', 'Provedor', 2, '2014-02-26 18:09:26', '2014-02-26 21:42:02'),
(5, 'Cliente Empresa', 'Cliente coorporativo', 2, '2014-02-26 18:09:48', '2014-02-26 21:49:44'),
(6, 'perfildeprueba', 'asdasdasd', 1, '2014-03-05 16:02:17', '2014-03-05 16:02:17');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Permisos`
--

CREATE TABLE IF NOT EXISTS `Permisos` (
  `id_perfil` int(11) DEFAULT NULL,
  `id_modulo` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  KEY `fk_id_perfil_idx` (`id_perfil`),
  KEY `fk_id_modulo_idx` (`id_modulo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `Permisos`
--

INSERT INTO `Permisos` (`id_perfil`, `id_modulo`, `created_at`, `updated_at`) VALUES
(6, 1, '2014-03-05 16:02:17', '2014-03-05 16:02:17'),
(6, 2, '2014-03-05 16:02:17', '2014-03-05 16:02:17'),
(6, 3, '2014-03-05 16:02:17', '2014-03-05 16:02:17'),
(6, 4, '2014-03-05 16:02:17', '2014-03-05 16:02:17');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Persona`
--

CREATE TABLE IF NOT EXISTS `Persona` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombres` varchar(100) DEFAULT NULL,
  `razonSocial` varchar(200) DEFAULT NULL,
  `apPaterno` varchar(100) DEFAULT NULL,
  `apMaterno` varchar(100) DEFAULT NULL,
  `dni` varchar(8) DEFAULT NULL,
  `ruc` varchar(11) DEFAULT NULL,
  `direccion` varchar(200) DEFAULT NULL,
  `pais` varchar(50) DEFAULT NULL,
  `departamento` varchar(50) NOT NULL,
  `provincia` varchar(50) DEFAULT NULL,
  `distrito` varchar(50) DEFAULT NULL,
  `tel` varchar(100) DEFAULT NULL,
  `cel` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `comentarios` text,
  `habilitado` tinyint(1) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `perfil_id` int(11) NOT NULL,
  `id_restaurante` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_Persona_Perfil1_idx` (`perfil_id`),
  KEY `fk_Persona_restaurante_idx` (`id_restaurante`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Volcado de datos para la tabla `Persona`
--

INSERT INTO `Persona` (`id`, `nombres`, `razonSocial`, `apPaterno`, `apMaterno`, `dni`, `ruc`, `direccion`, `pais`, `departamento`, `provincia`, `distrito`, `tel`, `cel`, `email`, `comentarios`, `habilitado`, `created_at`, `updated_at`, `perfil_id`, `id_restaurante`) VALUES
(1, 'Javier', NULL, 'Alvarez', 'Montenegro', '12345678', NULL, 'los alamos 123', 'Perú', 'lambayeque', 'chiclayo', 'chiclayo', '252711', '982604940', 'ivancalvay@hotmail.com', NULL, 1, '2014-02-26 18:17:43', '2014-02-27 20:24:29', 1, NULL),
(2, 'Ivan', NULL, 'Calvay', 'Requejo', '45934821', NULL, 'Los rosales 181', 'Perú', 'lambayeque', 'chiclayo', 'jose leonardo ortiz', '252711', '982604940', 'ivancalvay@hotmail.com', NULL, 1, '2014-02-26 18:25:28', '2014-02-28 21:23:30', 1, NULL),
(3, 'A', NULL, 'B', 'c', '12345678', NULL, 'Elias aguirres 123', 'Perú', 'lambayeque', 'chiclayo', 'la victoria', '223576', '983456729', 'kango@hotmail.com', NULL, 1, '2014-03-01 17:15:25', '2014-03-01 17:15:25', 3, NULL),
(4, 'Luis', NULL, 'valencia', 'sebastiani', '12345678', NULL, 'elias aguirre', 'Perú', 'lambayeque', 'chiclayo', 'la victoria', '123456', '123456789', 'kango@hotmail.com', NULL, 1, '2014-03-05 00:31:36', '2014-03-05 00:56:13', 2, NULL),
(5, NULL, 'kango', NULL, NULL, NULL, '12345678912', 'alkdjlasdj', 'Perú', 'lambayeque', 'chiclayo', 'patapo', '123456', '123456789', 'kango@hotmail.com', NULL, 1, '2014-03-05 00:47:12', '2014-03-05 00:47:12', 4, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Precio`
--

CREATE TABLE IF NOT EXISTS `Precio` (
  `producto_id` int(11) NOT NULL,
  `combinacion_id` int(11) NOT NULL,
  `precio` decimal(10,2) DEFAULT NULL,
  `seleccionador` int(11) DEFAULT NULL COMMENT '11,22,33,44... solo se selecciona 4 prod d los 8 disp donde no se repita un mismo valor',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`producto_id`,`combinacion_id`),
  KEY `fk_Precio_Combinacion1_idx` (`combinacion_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `Precio`
--

INSERT INTO `Precio` (`producto_id`, `combinacion_id`, `precio`, `seleccionador`, `created_at`, `updated_at`) VALUES
(1, 1, '10.00', 0, '2014-02-22 01:12:55', '2014-02-22 01:12:55'),
(1, 5, '5.00', 1, '2014-02-24 22:51:21', '2014-02-24 22:51:21'),
(1, 6, '2.00', 1, '2014-02-25 16:45:09', '2014-02-25 16:45:09'),
(2, 1, '10.00', 0, '2014-02-22 17:22:05', '2014-02-22 17:22:05'),
(2, 5, '2.00', 1, '2014-02-24 22:51:21', '2014-02-24 22:51:21'),
(2, 6, '8.00', 1, '2014-02-25 16:45:09', '2014-02-25 16:45:09'),
(2, 7, '2.00', 1, '2014-02-26 19:38:29', '2014-02-26 19:38:29'),
(2, 8, '0.00', 1, '2014-03-05 00:27:51', '2014-03-05 00:27:51'),
(2, 9, '0.00', 1, '2014-03-05 00:27:51', '2014-03-05 00:27:51'),
(3, 1, '10.00', 0, '2014-02-22 21:00:16', '2014-02-22 21:00:16'),
(4, 1, '10.00', 0, '2014-02-22 21:05:38', '2014-02-22 21:05:38'),
(5, 1, '10.00', 0, '2014-02-24 19:10:23', '2014-02-24 19:10:23'),
(6, 1, '10.00', 0, '2014-02-24 19:11:04', '2014-02-24 19:11:04'),
(7, 1, '10.00', 0, '2014-02-25 16:43:23', '2014-02-25 16:43:23'),
(8, 1, '2.00', 0, '2014-02-25 16:47:19', '2014-02-25 16:47:19'),
(8, 7, '3.00', 1, '2014-02-26 19:38:29', '2014-02-26 19:38:29'),
(9, 1, '15.00', 0, '2014-02-25 16:49:22', '2014-02-25 16:49:22'),
(10, 1, '10.00', 0, '2014-02-25 16:52:22', '2014-02-25 16:52:22'),
(10, 7, '5.00', 1, '2014-02-26 19:38:29', '2014-02-26 19:38:29'),
(10, 8, '0.00', 1, '2014-03-05 00:27:51', '2014-03-05 00:27:51'),
(10, 9, '0.00', 1, '2014-03-05 00:27:51', '2014-03-05 00:27:51'),
(11, 1, '10.00', 0, '2014-02-26 19:48:31', '2014-02-26 19:48:31'),
(12, 1, '10.00', 0, '2014-03-05 00:21:34', '2014-03-05 00:21:34'),
(13, 1, '10.00', 0, '2014-03-05 00:22:38', '2014-03-05 00:22:38');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Producto`
--

CREATE TABLE IF NOT EXISTS `Producto` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(300) DEFAULT NULL,
  `familia_id` int(11) DEFAULT NULL,
  `descripcion` text,
  `estado` tinyint(1) DEFAULT NULL COMMENT '0 --> des-habilitado1 --> habilitado',
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
  `selector_eleccion` int(11) DEFAULT NULL COMMENT 'helado doble.. selector_eleccion-->2',
  `id_tipoarepro` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_Producto_Familia1_idx` (`familia_id`),
  KEY `fk_Producto_1` (`id_tipoarepro`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Volcado de datos para la tabla `Producto`
--

INSERT INTO `Producto` (`id`, `nombre`, `familia_id`, `descripcion`, `estado`, `favorito`, `unidadMedida`, `imagen`, `stock`, `stockMin`, `stockMax`, `created_at`, `updated_at`, `selector_adicional`, `lista_prod`, `selector_eleccion`, `id_tipoarepro`) VALUES
(1, 'productoconprecio', NULL, 'asdasd', NULL, NULL, 'Unidades', NULL, '10.00', NULL, NULL, '2014-02-22 01:12:55', '2014-02-22 01:12:55', NULL, NULL, NULL, NULL),
(2, 'producto2', NULL, 'asasdsd', NULL, NULL, 'Unidades', NULL, '1.00', NULL, NULL, '2014-02-22 17:22:05', '2014-02-22 17:22:05', NULL, NULL, NULL, NULL),
(3, 'adiconal1', 1, 'adiconal1', 1, NULL, 'Unidades', NULL, '10.00', '5.00', '20.00', '2014-02-22 21:00:16', '2014-02-22 21:00:16', 0, NULL, NULL, NULL),
(4, '2adicional', 1, 'asdasdasd', 1, NULL, 'Unidades', NULL, '10.00', '5.00', '20.00', '2014-02-22 21:05:38', '2014-02-22 21:05:38', 0, NULL, NULL, NULL),
(5, 'hambuguesa', 3, 'hanburguesa', 1, NULL, 'Unidades', NULL, '10.00', '2.00', '20.00', '2014-02-24 19:10:23', '2014-02-24 19:10:23', 1, NULL, NULL, NULL),
(6, 'hambuguesa', 3, 'hanburguesa', 1, NULL, 'Unidades', NULL, '10.00', '2.00', '20.00', '2014-02-24 19:11:04', '2014-02-24 19:11:04', 1, '3', NULL, NULL),
(7, 'javier', 3, 'asdljasdlkj', 1, NULL, 'Unidades', NULL, '10.00', '5.00', '10.00', '2014-02-25 16:43:23', '2014-02-25 16:43:23', 0, NULL, NULL, NULL),
(8, 'produc4', 1, 'pro', 1, NULL, 'Unidades', NULL, '20.00', '5.00', '20.00', '2014-02-25 16:47:19', '2014-02-25 16:47:19', 0, NULL, NULL, NULL),
(9, 'produc5', 3, 'sdasd', 1, NULL, 'Unidades', NULL, '10.00', '5.00', '15.00', '2014-02-25 16:49:22', '2014-02-25 16:49:22', 1, '8', NULL, NULL),
(10, 'Produc7', 3, 'adasd', 1, NULL, 'Unidades', NULL, '10.00', '2.00', '10.00', '2014-02-25 16:52:22', '2014-02-25 16:52:22', 1, '8', NULL, NULL),
(11, 'kasher', 3, 'kasher', 1, NULL, 'Unidades', NULL, '10.00', '5.00', '10.00', '2014-02-26 19:48:31', '2014-02-26 19:48:31', 0, NULL, NULL, NULL),
(12, 'Producto 10', 3, 'assdsjahkd', 1, NULL, 'Unidades', NULL, '10.00', '5.00', '10.00', '2014-03-05 00:21:34', '2014-03-05 00:21:34', 1, '3', NULL, NULL),
(13, 'Producto 11', 3, 'asdkjhasd', 1, NULL, 'Unidades', NULL, '12.00', '2.00', '5.00', '2014-03-05 00:22:38', '2014-03-05 00:22:38', 0, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Receta`
--

CREATE TABLE IF NOT EXISTS `Receta` (
  `producto_id` int(11) NOT NULL,
  `insumo_id` int(11) NOT NULL,
  `cantidad` decimal(10,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`producto_id`,`insumo_id`),
  KEY `fk_detProducto_Insumo1_idx` (`insumo_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `Receta`
--

INSERT INTO `Receta` (`producto_id`, `insumo_id`, `cantidad`, `created_at`, `updated_at`) VALUES
(1, 1, '1.00', '2014-02-22 01:12:55', '2014-02-22 01:12:55'),
(1, 2, '1.00', '2014-02-22 01:12:55', '2014-02-22 01:12:55'),
(2, 1, '1.00', '2014-02-22 17:22:05', '2014-02-22 17:22:05'),
(3, 1, '1.00', '2014-02-22 21:00:16', '2014-02-22 21:00:16'),
(4, 1, '1.00', '2014-02-22 21:05:38', '2014-02-22 21:05:38'),
(4, 2, '1.00', '2014-02-22 21:05:38', '2014-02-22 21:05:38'),
(6, 1, '1.00', '2014-02-24 19:11:04', '2014-02-24 19:11:04'),
(6, 2, '1.00', '2014-02-24 19:11:04', '2014-02-24 19:11:04'),
(7, 1, '1.00', '2014-02-25 16:43:23', '2014-02-25 16:43:23'),
(7, 2, '1.00', '2014-02-25 16:43:23', '2014-02-25 16:43:23'),
(8, 1, '1.00', '2014-02-25 16:47:19', '2014-02-25 16:47:19'),
(9, 1, '1.00', '2014-02-25 16:49:22', '2014-02-25 16:49:22'),
(9, 2, '1.00', '2014-02-25 16:49:22', '2014-02-25 16:49:22'),
(10, 1, '1.00', '2014-02-25 16:52:22', '2014-02-25 16:52:22'),
(10, 2, '1.00', '2014-02-25 16:52:22', '2014-02-25 16:52:22'),
(11, 3, '0.20', '2014-02-26 19:48:31', '2014-02-26 19:48:31'),
(11, 4, '0.30', '2014-02-26 19:48:31', '2014-02-26 19:48:31'),
(12, 1, '1.00', '2014-03-05 00:21:34', '2014-03-05 00:21:34'),
(12, 2, '2.00', '2014-03-05 00:21:34', '2014-03-05 00:21:34'),
(12, 5, '1.00', '2014-03-05 00:21:34', '2014-03-05 00:21:34');

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
  `provincia` varchar(50) DEFAULT NULL,
  `distrito` varchar(50) DEFAULT NULL,
  `tel` varchar(100) DEFAULT NULL,
  `fax` varchar(100) DEFAULT NULL,
  `cel` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Salon`
--

CREATE TABLE IF NOT EXISTS `Salon` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) DEFAULT NULL,
  `descripcion` text,
  `restaurante_id` int(11) NOT NULL,
  `habilitado` tinyint(1) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_Salon_Restaurante1_idx` (`restaurante_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `TipoAreadeProduccion`
--

CREATE TABLE IF NOT EXISTS `TipoAreadeProduccion` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `descripcion` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `TipoComb`
--

CREATE TABLE IF NOT EXISTS `TipoComb` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) DEFAULT NULL,
  `descripcion` text,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL COMMENT 'Para cubrir los distintos Menúes diarios de Kango',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `TipoComb`
--

INSERT INTO `TipoComb` (`id`, `nombre`, `descripcion`, `created_at`, `updated_at`) VALUES
(1, 'Menu', 'Menu del dia', '2014-02-21 19:02:25', '2014-02-21 19:02:25'),
(2, 'Coffe Time', 'Coffe Time', '2014-02-21 19:05:24', '2014-02-21 19:05:24'),
(3, 'Normal', 'Precios sin descuento', '2014-02-22 00:53:00', '2014-02-22 00:53:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `TipoDocumento`
--

CREATE TABLE IF NOT EXISTS `TipoDocumento` (
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

--
-- Volcado de datos para la tabla `ubigeo`
--

INSERT INTO `ubigeo` (`id_ubigeo`, `departamento`, `provincia`, `distrito`) VALUES
(1111, 'amazonas', 'chachapoyas', 'chachapoyas'),
(2112, 'amazonas', 'chachapoyas', 'asuncion'),
(3113, 'amazonas', 'chachapoyas', 'balsas'),
(4114, 'amazonas', 'chachapoyas', 'cheto'),
(5115, 'amazonas', 'chachapoyas', 'chiliquin'),
(6116, 'amazonas', 'chachapoyas', 'chuquibamba'),
(7117, 'amazonas', 'chachapoyas', 'granada'),
(8118, 'amazonas', 'chachapoyas', 'huancas'),
(9119, 'amazonas', 'chachapoyas', 'la jalca'),
(22121, 'amazonas', 'bagua', 'la peca'),
(23122, 'amazonas', 'bagua', 'aramango'),
(24123, 'amazonas', 'bagua', 'copallin'),
(25124, 'amazonas', 'bagua', 'el parco'),
(26126, 'amazonas', 'bagua', 'imaza'),
(27131, 'amazonas', 'bongara', 'jumbilla'),
(28132, 'amazonas', 'bongara', 'corosha'),
(29133, 'amazonas', 'bongara', 'cuispes'),
(30134, 'amazonas', 'bongara', 'chisquilla'),
(31135, 'amazonas', 'bongara', 'churuja'),
(32136, 'amazonas', 'bongara', 'florida'),
(33137, 'amazonas', 'bongara', 'recta'),
(34138, 'amazonas', 'bongara', 'san carlos'),
(35139, 'amazonas', 'bongara', 'shipasbamba'),
(39141, 'amazonas', 'luya', 'lamud'),
(40142, 'amazonas', 'luya', 'camporredondo'),
(41143, 'amazonas', 'luya', 'cocabamba'),
(42144, 'amazonas', 'luya', 'colcamar'),
(43145, 'amazonas', 'luya', 'conila'),
(44146, 'amazonas', 'luya', 'inguilpata'),
(45147, 'amazonas', 'luya', 'longuita'),
(46148, 'amazonas', 'luya', 'lonya chico'),
(47149, 'amazonas', 'luya', 'luya'),
(62151, 'amazonas', 'rodriguez de mendoza', 'san nicolas'),
(63152, 'amazonas', 'rodriguez de mendoza', 'cochamal'),
(64153, 'amazonas', 'rodriguez de mendoza', 'chirimoto'),
(65154, 'amazonas', 'rodriguez de mendoza', 'huambo'),
(66155, 'amazonas', 'rodriguez de mendoza', 'limabamba'),
(67156, 'amazonas', 'rodriguez de mendoza', 'longar'),
(68157, 'amazonas', 'rodriguez de mendoza', 'milpuc'),
(69158, 'amazonas', 'rodriguez de mendoza', 'mcal benavides'),
(70159, 'amazonas', 'rodriguez de mendoza', 'omia'),
(74161, 'amazonas', 'condorcanqui', 'nieva'),
(75162, 'amazonas', 'condorcanqui', 'rio santiago'),
(76163, 'amazonas', 'condorcanqui', 'el cenepa'),
(77171, 'amazonas', 'utcubamba', 'bagua grande'),
(78172, 'amazonas', 'utcubamba', 'cajaruro'),
(79173, 'amazonas', 'utcubamba', 'cumba'),
(80174, 'amazonas', 'utcubamba', 'el milagro'),
(81175, 'amazonas', 'utcubamba', 'jamalca'),
(82176, 'amazonas', 'utcubamba', 'lonya grande'),
(83177, 'amazonas', 'utcubamba', 'yamon'),
(84211, 'ancash', 'huaraz', 'huaraz'),
(85212, 'ancash', 'huaraz', 'independencia'),
(86213, 'ancash', 'huaraz', 'cochabamba'),
(87214, 'ancash', 'huaraz', 'colcabamba'),
(88215, 'ancash', 'huaraz', 'huanchay'),
(89216, 'ancash', 'huaraz', 'jangas'),
(90217, 'ancash', 'huaraz', 'la libertad'),
(91218, 'ancash', 'huaraz', 'olleros'),
(92219, 'ancash', 'huaraz', 'pampas'),
(96221, 'ancash', 'aija', 'aija'),
(97223, 'ancash', 'aija', 'coris'),
(98225, 'ancash', 'aija', 'huacllan'),
(99226, 'ancash', 'aija', 'la merced'),
(100228, 'ancash', 'aija', 'succha'),
(101110, 'amazonas', 'chachapoyas', 'leimebamba'),
(101231, 'ancash', 'bolognesi', 'chiquian'),
(102232, 'ancash', 'bolognesi', 'a pardo lezameta'),
(103234, 'ancash', 'bolognesi', 'aquia'),
(104235, 'ancash', 'bolognesi', 'cajacay'),
(111111, 'amazonas', 'chachapoyas', 'levanto'),
(116241, 'ancash', 'carhuaz', 'carhuaz'),
(117242, 'ancash', 'carhuaz', 'acopampa'),
(118243, 'ancash', 'carhuaz', 'amashca'),
(119244, 'ancash', 'carhuaz', 'anta'),
(120245, 'ancash', 'carhuaz', 'ataquero'),
(121112, 'amazonas', 'chachapoyas', 'magdalena'),
(121246, 'ancash', 'carhuaz', 'marcara'),
(122247, 'ancash', 'carhuaz', 'pariahuanca'),
(123248, 'ancash', 'carhuaz', 'san miguel de aco'),
(124249, 'ancash', 'carhuaz', 'shilla'),
(127251, 'ancash', 'casma', 'casma'),
(128252, 'ancash', 'casma', 'buena vista alta'),
(129253, 'ancash', 'casma', 'comandante noel'),
(130255, 'ancash', 'casma', 'yautan'),
(131113, 'amazonas', 'chachapoyas', 'mariscal castilla'),
(131261, 'ancash', 'corongo', 'corongo'),
(132262, 'ancash', 'corongo', 'aco'),
(133263, 'ancash', 'corongo', 'bambas'),
(134264, 'ancash', 'corongo', 'cusca'),
(135265, 'ancash', 'corongo', 'la pampa'),
(136266, 'ancash', 'corongo', 'yanac'),
(137267, 'ancash', 'corongo', 'yupan'),
(138271, 'ancash', 'huaylas', 'caraz'),
(139272, 'ancash', 'huaylas', 'huallanca'),
(140273, 'ancash', 'huaylas', 'huata'),
(141114, 'amazonas', 'chachapoyas', 'molinopampa'),
(141274, 'ancash', 'huaylas', 'huaylas'),
(142275, 'ancash', 'huaylas', 'mato'),
(143276, 'ancash', 'huaylas', 'pamparomas'),
(144277, 'ancash', 'huaylas', 'pueblo libre'),
(145278, 'ancash', 'huaylas', 'santa cruz'),
(146279, 'ancash', 'huaylas', 'yuracmarca'),
(148281, 'ancash', 'huari', 'huari'),
(149282, 'ancash', 'huari', 'cajay'),
(150283, 'ancash', 'huari', 'chavin de huantar'),
(151115, 'amazonas', 'chachapoyas', 'montevideo'),
(151284, 'ancash', 'huari', 'huacachi'),
(152285, 'ancash', 'huari', 'huachis'),
(153286, 'ancash', 'huari', 'huacchis'),
(154287, 'ancash', 'huari', 'huantar'),
(155288, 'ancash', 'huari', 'masin'),
(156289, 'ancash', 'huari', 'paucas'),
(161116, 'amazonas', 'chachapoyas', 'olleros'),
(164291, 'ancash', 'mariscal luzuriaga', 'piscobamba'),
(165292, 'ancash', 'mariscal luzuriaga', 'casca'),
(166293, 'ancash', 'mariscal luzuriaga', 'lucma'),
(167294, 'ancash', 'mariscal luzuriaga', 'fidel olivas escudero'),
(168295, 'ancash', 'mariscal luzuriaga', 'llama'),
(169296, 'ancash', 'mariscal luzuriaga', 'llumpa'),
(170297, 'ancash', 'mariscal luzuriaga', 'musga'),
(171117, 'amazonas', 'chachapoyas', 'quinjalca'),
(171298, 'ancash', 'mariscal luzuriaga', 'eleazar guzman barron'),
(181118, 'amazonas', 'chachapoyas', 'san fco de daguas'),
(191119, 'amazonas', 'chachapoyas', 'san isidro de maino'),
(201120, 'amazonas', 'chachapoyas', 'soloco'),
(211121, 'amazonas', 'chachapoyas', 'sonche'),
(250311, 'apurimac', 'abancay', 'abancay'),
(251312, 'apurimac', 'abancay', 'circa'),
(252313, 'apurimac', 'abancay', 'curahuasi'),
(253314, 'apurimac', 'abancay', 'chacoche'),
(254315, 'apurimac', 'abancay', 'huanipaca'),
(255316, 'apurimac', 'abancay', 'lambrama'),
(256317, 'apurimac', 'abancay', 'pichirhua'),
(257318, 'apurimac', 'abancay', 'san pedro de cachora'),
(258319, 'apurimac', 'abancay', 'tamburco'),
(259321, 'apurimac', 'aymaraes', 'chalhuanca'),
(260322, 'apurimac', 'aymaraes', 'capaya'),
(261323, 'apurimac', 'aymaraes', 'caraybamba'),
(262324, 'apurimac', 'aymaraes', 'colcabamba'),
(263325, 'apurimac', 'aymaraes', 'cotaruse'),
(264326, 'apurimac', 'aymaraes', 'chapimarca'),
(265327, 'apurimac', 'aymaraes', 'ihuayllo'),
(266328, 'apurimac', 'aymaraes', 'lucre'),
(267329, 'apurimac', 'aymaraes', 'pocohuanca'),
(276331, 'apurimac', 'andahuaylas', 'andahuaylas'),
(277332, 'apurimac', 'andahuaylas', 'andarapa'),
(278333, 'apurimac', 'andahuaylas', 'chiara'),
(279334, 'apurimac', 'andahuaylas', 'huancarama'),
(280335, 'apurimac', 'andahuaylas', 'huancaray'),
(281336, 'apurimac', 'andahuaylas', 'kishuara'),
(282337, 'apurimac', 'andahuaylas', 'pacobamba'),
(283338, 'apurimac', 'andahuaylas', 'pampachiri'),
(284339, 'apurimac', 'andahuaylas', 'san antonio de cachi'),
(295341, 'apurimac', 'antabamba', 'antabamba'),
(296342, 'apurimac', 'antabamba', 'el oro'),
(297343, 'apurimac', 'antabamba', 'huaquirca'),
(298344, 'apurimac', 'antabamba', 'juan espinoza medrano'),
(299345, 'apurimac', 'antabamba', 'oropesa'),
(300346, 'apurimac', 'antabamba', 'pachaconas'),
(301347, 'apurimac', 'antabamba', 'sabaino'),
(302351, 'apurimac', 'cotabambas', 'tambobamba'),
(303352, 'apurimac', 'cotabambas', 'coyllurqui'),
(304353, 'apurimac', 'cotabambas', 'cotabambas'),
(305354, 'apurimac', 'cotabambas', 'haquira'),
(306355, 'apurimac', 'cotabambas', 'mara'),
(307356, 'apurimac', 'cotabambas', 'challhuahuacho'),
(308361, 'apurimac', 'grau', 'chuquibambilla'),
(309362, 'apurimac', 'grau', 'curpahuasi'),
(310363, 'apurimac', 'grau', 'huaillati'),
(311364, 'apurimac', 'grau', 'mamara'),
(312365, 'apurimac', 'grau', 'mariscal gamarra'),
(313366, 'apurimac', 'grau', 'micaela bastidas'),
(314367, 'apurimac', 'grau', 'progreso'),
(315368, 'apurimac', 'grau', 'pataypampa'),
(316369, 'apurimac', 'grau', 'san antonio'),
(322371, 'apurimac', 'chincheros', 'chincheros'),
(323372, 'apurimac', 'chincheros', 'ongoy'),
(324373, 'apurimac', 'chincheros', 'ocobamba'),
(325374, 'apurimac', 'chincheros', 'cocharcas'),
(326375, 'apurimac', 'chincheros', 'anco huallo'),
(327376, 'apurimac', 'chincheros', 'huaccana'),
(328377, 'apurimac', 'chincheros', 'uranmarca'),
(329378, 'apurimac', 'chincheros', 'ranracancha'),
(330411, 'arequipa', 'arequipa', 'arequipa'),
(331412, 'arequipa', 'arequipa', 'cayma'),
(332413, 'arequipa', 'arequipa', 'cerro colorado'),
(333414, 'arequipa', 'arequipa', 'characato'),
(334415, 'arequipa', 'arequipa', 'chiguata'),
(335416, 'arequipa', 'arequipa', 'la joya'),
(336417, 'arequipa', 'arequipa', 'miraflores'),
(337418, 'arequipa', 'arequipa', 'mollebaya'),
(338419, 'arequipa', 'arequipa', 'paucarpata'),
(359421, 'arequipa', 'caylloma', 'chivay'),
(360422, 'arequipa', 'caylloma', 'achoma'),
(361310, 'amazonas', 'bongara', 'valera'),
(361423, 'arequipa', 'caylloma', 'cabanaconde'),
(362424, 'arequipa', 'caylloma', 'caylloma'),
(363425, 'arequipa', 'caylloma', 'callalli'),
(364426, 'arequipa', 'caylloma', 'coporaque'),
(365427, 'arequipa', 'caylloma', 'huambo'),
(366428, 'arequipa', 'caylloma', 'huanca'),
(367429, 'arequipa', 'caylloma', 'ichupampa'),
(371311, 'amazonas', 'bongara', 'yambrasbamba'),
(379431, 'arequipa', 'camana', 'camana'),
(380432, 'arequipa', 'camana', 'jose maria quimper'),
(381312, 'amazonas', 'bongara', 'jazan'),
(381433, 'arequipa', 'camana', 'mariano n valcarcel'),
(382434, 'arequipa', 'camana', 'mariscal caceres'),
(383435, 'arequipa', 'camana', 'nicolas de pierola'),
(384436, 'arequipa', 'camana', 'ocoña'),
(385437, 'arequipa', 'camana', 'quilca'),
(386438, 'arequipa', 'camana', 'samuel pastor'),
(387441, 'arequipa', 'caraveli', 'caraveli'),
(388442, 'arequipa', 'caraveli', 'acari'),
(389443, 'arequipa', 'caraveli', 'atico'),
(390444, 'arequipa', 'caraveli', 'atiquipa'),
(391445, 'arequipa', 'caraveli', 'bella union'),
(392446, 'arequipa', 'caraveli', 'cahuacho'),
(393447, 'arequipa', 'caraveli', 'chala'),
(394448, 'arequipa', 'caraveli', 'chaparra'),
(395449, 'arequipa', 'caraveli', 'huanuhuanu'),
(400451, 'arequipa', 'castilla', 'aplao'),
(401452, 'arequipa', 'castilla', 'andagua'),
(402453, 'arequipa', 'castilla', 'ayo'),
(403454, 'arequipa', 'castilla', 'chachas'),
(404455, 'arequipa', 'castilla', 'chilcaymarca'),
(405456, 'arequipa', 'castilla', 'choco'),
(406457, 'arequipa', 'castilla', 'huancarqui'),
(407458, 'arequipa', 'castilla', 'machaguay'),
(408459, 'arequipa', 'castilla', 'orcopampa'),
(414461, 'arequipa', 'condesuyos', 'chuquibamba'),
(415462, 'arequipa', 'condesuyos', 'andaray'),
(416463, 'arequipa', 'condesuyos', 'cayarani'),
(417464, 'arequipa', 'condesuyos', 'chichas'),
(418465, 'arequipa', 'condesuyos', 'iray'),
(419466, 'arequipa', 'condesuyos', 'salamanca'),
(420467, 'arequipa', 'condesuyos', 'yanaquihua'),
(421468, 'arequipa', 'condesuyos', 'rio grande'),
(422471, 'arequipa', 'islay', 'mollendo'),
(423472, 'arequipa', 'islay', 'cocachacra'),
(424473, 'arequipa', 'islay', 'dean valdivia'),
(425474, 'arequipa', 'islay', 'islay'),
(426475, 'arequipa', 'islay', 'mejia'),
(427476, 'arequipa', 'islay', 'punta de bombon'),
(428481, 'arequipa', 'la union', 'cotahuasi'),
(429482, 'arequipa', 'la union', 'alca'),
(430483, 'arequipa', 'la union', 'charcana'),
(431484, 'arequipa', 'la union', 'huaynacotas'),
(432485, 'arequipa', 'la union', 'pampamarca'),
(433486, 'arequipa', 'la union', 'puyca'),
(434487, 'arequipa', 'la union', 'quechualla'),
(435488, 'arequipa', 'la union', 'sayla'),
(436489, 'arequipa', 'la union', 'tauria'),
(439511, 'ayacucho', 'huamanga', 'ayacucho'),
(440512, 'ayacucho', 'huamanga', 'acos vinchos'),
(441513, 'ayacucho', 'huamanga', 'carmen alto'),
(442514, 'ayacucho', 'huamanga', 'chiara'),
(443515, 'ayacucho', 'huamanga', 'quinua'),
(444516, 'ayacucho', 'huamanga', 'san jose de ticllas'),
(445517, 'ayacucho', 'huamanga', 'san juan bautista'),
(446518, 'ayacucho', 'huamanga', 'santiago de pischa'),
(447519, 'ayacucho', 'huamanga', 'vinchos'),
(454521, 'ayacucho', 'cangallo', 'cangallo'),
(455524, 'ayacucho', 'cangallo', 'chuschi'),
(456526, 'ayacucho', 'cangallo', 'los morochucos'),
(457527, 'ayacucho', 'cangallo', 'paras'),
(458528, 'ayacucho', 'cangallo', 'totos'),
(460531, 'ayacucho', 'huanta', 'huanta'),
(461532, 'ayacucho', 'huanta', 'ayahuanco'),
(462533, 'ayacucho', 'huanta', 'huamanguilla'),
(463534, 'ayacucho', 'huanta', 'iguain'),
(464535, 'ayacucho', 'huanta', 'luricocha'),
(465537, 'ayacucho', 'huanta', 'santillana'),
(466538, 'ayacucho', 'huanta', 'sivia'),
(467539, 'ayacucho', 'huanta', 'llochegua'),
(468541, 'ayacucho', 'la mar', 'san miguel'),
(469542, 'ayacucho', 'la mar', 'anco'),
(470543, 'ayacucho', 'la mar', 'ayna'),
(471544, 'ayacucho', 'la mar', 'chilcas'),
(472545, 'ayacucho', 'la mar', 'chungui'),
(473546, 'ayacucho', 'la mar', 'tambo'),
(474547, 'ayacucho', 'la mar', 'luis carranza'),
(475548, 'ayacucho', 'la mar', 'santa rosa'),
(476551, 'ayacucho', 'lucanas', 'puquio'),
(477552, 'ayacucho', 'lucanas', 'aucara'),
(478553, 'ayacucho', 'lucanas', 'cabana'),
(479554, 'ayacucho', 'lucanas', 'carmen salcedo'),
(480556, 'ayacucho', 'lucanas', 'chaviña'),
(481410, 'amazonas', 'luya', 'luya viejo'),
(481558, 'ayacucho', 'lucanas', 'chipao'),
(491411, 'amazonas', 'luya', 'maria'),
(497561, 'ayacucho', 'parinacochas', 'coracora'),
(498564, 'ayacucho', 'parinacochas', 'coronel castañeda'),
(499565, 'ayacucho', 'parinacochas', 'chumpi'),
(500568, 'ayacucho', 'parinacochas', 'pacapausa'),
(501412, 'amazonas', 'luya', 'ocalli'),
(505571, 'ayacucho', 'victor fajardo', 'huancapi'),
(506572, 'ayacucho', 'victor fajardo', 'alcamenca'),
(507573, 'ayacucho', 'victor fajardo', 'apongo'),
(508574, 'ayacucho', 'victor fajardo', 'canaria'),
(509576, 'ayacucho', 'victor fajardo', 'cayara'),
(510577, 'ayacucho', 'victor fajardo', 'colca'),
(511413, 'amazonas', 'luya', 'ocumal'),
(511578, 'ayacucho', 'victor fajardo', 'huaya'),
(512579, 'ayacucho', 'victor fajardo', 'huamanquiquia'),
(517581, 'ayacucho', 'huanca sancos', 'sancos'),
(518582, 'ayacucho', 'huanca sancos', 'sacsamarca'),
(519583, 'ayacucho', 'huanca sancos', 'santiago de lucanamarca'),
(520584, 'ayacucho', 'huanca sancos', 'carapo'),
(521414, 'amazonas', 'luya', 'pisuquia'),
(521591, 'ayacucho', 'vilcas huaman', 'vilcas huaman'),
(522592, 'ayacucho', 'vilcas huaman', 'vischongo'),
(523593, 'ayacucho', 'vilcas huaman', 'accomarca'),
(524594, 'ayacucho', 'vilcas huaman', 'carhuanca'),
(525595, 'ayacucho', 'vilcas huaman', 'concepcion'),
(526596, 'ayacucho', 'vilcas huaman', 'huambalpa'),
(527597, 'ayacucho', 'vilcas huaman', 'saurama'),
(528598, 'ayacucho', 'vilcas huaman', 'independencia'),
(531415, 'amazonas', 'luya', 'san cristobal'),
(541416, 'amazonas', 'luya', 'san francisco de yeso'),
(550611, 'cajamarca', 'cajamarca', 'cajamarca'),
(551417, 'amazonas', 'luya', 'san jeronimo'),
(551612, 'cajamarca', 'cajamarca', 'asuncion'),
(552613, 'cajamarca', 'cajamarca', 'cospan'),
(553614, 'cajamarca', 'cajamarca', 'chetilla'),
(554615, 'cajamarca', 'cajamarca', 'encañada'),
(555616, 'cajamarca', 'cajamarca', 'jesus'),
(556617, 'cajamarca', 'cajamarca', 'los baños del inca'),
(557618, 'cajamarca', 'cajamarca', 'llacanora'),
(558619, 'cajamarca', 'cajamarca', 'magdalena'),
(561418, 'amazonas', 'luya', 'san juan de lopecancha'),
(562621, 'cajamarca', 'cajabamba', 'cajabamba'),
(563622, 'cajamarca', 'cajabamba', 'cachachi'),
(564623, 'cajamarca', 'cajabamba', 'condebamba'),
(565625, 'cajamarca', 'cajabamba', 'sitacocha'),
(566631, 'cajamarca', 'celendin', 'celendin'),
(567632, 'cajamarca', 'celendin', 'cortegana'),
(568633, 'cajamarca', 'celendin', 'chumuch'),
(569634, 'cajamarca', 'celendin', 'huasmin'),
(570635, 'cajamarca', 'celendin', 'jorge chavez'),
(571419, 'amazonas', 'luya', 'santa catalina'),
(571636, 'cajamarca', 'celendin', 'jose galvez'),
(572637, 'cajamarca', 'celendin', 'miguel iglesias'),
(573638, 'cajamarca', 'celendin', 'oxamarca'),
(574639, 'cajamarca', 'celendin', 'sorochuco'),
(578641, 'cajamarca', 'contumaza', 'contumaza'),
(579643, 'cajamarca', 'contumaza', 'chilete'),
(580644, 'cajamarca', 'contumaza', 'guzmango'),
(581420, 'amazonas', 'luya', 'santo tomas'),
(581645, 'cajamarca', 'contumaza', 'san benito'),
(582646, 'cajamarca', 'contumaza', 'cupisnique'),
(583647, 'cajamarca', 'contumaza', 'tantarica'),
(584648, 'cajamarca', 'contumaza', 'yonan'),
(585649, 'cajamarca', 'contumaza', 'sta cruz de toledo'),
(586651, 'cajamarca', 'cutervo', 'cutervo'),
(587652, 'cajamarca', 'cutervo', 'callayuc'),
(588653, 'cajamarca', 'cutervo', 'cujillo'),
(589654, 'cajamarca', 'cutervo', 'choros'),
(590655, 'cajamarca', 'cutervo', 'la ramada'),
(591421, 'amazonas', 'luya', 'tingo'),
(591656, 'cajamarca', 'cutervo', 'pimpingos'),
(592657, 'cajamarca', 'cutervo', 'querocotillo'),
(593658, 'cajamarca', 'cutervo', 'san andres de cutervo'),
(594659, 'cajamarca', 'cutervo', 'san juan de cutervo'),
(601422, 'amazonas', 'luya', 'trita'),
(601661, 'cajamarca', 'chota', 'chota'),
(602662, 'cajamarca', 'chota', 'anguia'),
(603663, 'cajamarca', 'chota', 'cochabamba'),
(604664, 'cajamarca', 'chota', 'conchan'),
(605665, 'cajamarca', 'chota', 'chadin'),
(606666, 'cajamarca', 'chota', 'chiguirip'),
(607667, 'cajamarca', 'chota', 'chimban'),
(608668, 'cajamarca', 'chota', 'huambos'),
(609669, 'cajamarca', 'chota', 'lajas'),
(611423, 'amazonas', 'luya', 'providencia'),
(620671, 'cajamarca', 'hualgayoc', 'bambamarca'),
(621672, 'cajamarca', 'hualgayoc', 'chugur'),
(622673, 'cajamarca', 'hualgayoc', 'hualgayoc'),
(623681, 'cajamarca', 'jaen', 'jaen'),
(624682, 'cajamarca', 'jaen', 'bellavista'),
(625683, 'cajamarca', 'jaen', 'colasay'),
(626684, 'cajamarca', 'jaen', 'chontali'),
(627685, 'cajamarca', 'jaen', 'pomahuaca'),
(628686, 'cajamarca', 'jaen', 'pucara'),
(629687, 'cajamarca', 'jaen', 'sallique'),
(630688, 'cajamarca', 'jaen', 'san felipe'),
(631689, 'cajamarca', 'jaen', 'san jose del alto'),
(635691, 'cajamarca', 'santa cruz', 'santa cruz'),
(636692, 'cajamarca', 'santa cruz', 'catache'),
(637693, 'cajamarca', 'santa cruz', 'chancaibaños'),
(638694, 'cajamarca', 'santa cruz', 'la esperanza'),
(639695, 'cajamarca', 'santa cruz', 'ninabamba'),
(640696, 'cajamarca', 'santa cruz', 'pulan'),
(641697, 'cajamarca', 'santa cruz', 'sexi'),
(642698, 'cajamarca', 'santa cruz', 'uticyacu'),
(643699, 'cajamarca', 'santa cruz', 'yauyucan'),
(677711, 'cusco', 'cusco', 'cusco'),
(678712, 'cusco', 'cusco', 'ccorca'),
(679713, 'cusco', 'cusco', 'poroy'),
(680714, 'cusco', 'cusco', 'san jeronimo'),
(681715, 'cusco', 'cusco', 'san sebastian'),
(682716, 'cusco', 'cusco', 'santiago'),
(683717, 'cusco', 'cusco', 'saylla'),
(684718, 'cusco', 'cusco', 'wanchaq'),
(685721, 'cusco', 'acomayo', 'acomayo'),
(686722, 'cusco', 'acomayo', 'acopia'),
(687723, 'cusco', 'acomayo', 'acos'),
(688724, 'cusco', 'acomayo', 'pomacanchi'),
(689725, 'cusco', 'acomayo', 'rondocan'),
(690726, 'cusco', 'acomayo', 'sangarara'),
(691727, 'cusco', 'acomayo', 'mosoc llacta'),
(692731, 'cusco', 'anta', 'anta'),
(693732, 'cusco', 'anta', 'chinchaypujio'),
(694733, 'cusco', 'anta', 'huarocondo'),
(695734, 'cusco', 'anta', 'limatambo'),
(696735, 'cusco', 'anta', 'mollepata'),
(697736, 'cusco', 'anta', 'pucyura'),
(698737, 'cusco', 'anta', 'zurite'),
(699738, 'cusco', 'anta', 'cachimayo'),
(700739, 'cusco', 'anta', 'ancahuasi'),
(701741, 'cusco', 'calca', 'calca'),
(702742, 'cusco', 'calca', 'coya'),
(703743, 'cusco', 'calca', 'lamay'),
(704744, 'cusco', 'calca', 'lares'),
(705745, 'cusco', 'calca', 'pisac'),
(706746, 'cusco', 'calca', 'san salvador'),
(707747, 'cusco', 'calca', 'taray'),
(708748, 'cusco', 'calca', 'yanatile'),
(709751, 'cusco', 'canas', 'yanaoca'),
(710752, 'cusco', 'canas', 'checca'),
(711510, 'amazonas', 'rodriguez de mendoza', 'santa rosa'),
(711753, 'cusco', 'canas', 'kunturkanki'),
(712754, 'cusco', 'canas', 'langui'),
(713755, 'cusco', 'canas', 'layo'),
(714756, 'cusco', 'canas', 'pampamarca'),
(715757, 'cusco', 'canas', 'quehue'),
(716758, 'cusco', 'canas', 'tupac amaru'),
(717761, 'cusco', 'canchis', 'sicuani'),
(718762, 'cusco', 'canchis', 'combapata'),
(719763, 'cusco', 'canchis', 'checacupe'),
(720764, 'cusco', 'canchis', 'marangani'),
(721511, 'amazonas', 'rodriguez de mendoza', 'totora'),
(721765, 'cusco', 'canchis', 'pitumarca'),
(722766, 'cusco', 'canchis', 'san pablo'),
(723767, 'cusco', 'canchis', 'san pedro'),
(724768, 'cusco', 'canchis', 'tinta'),
(725771, 'cusco', 'chumbivilcas', 'santo tomas'),
(726772, 'cusco', 'chumbivilcas', 'capacmarca'),
(727773, 'cusco', 'chumbivilcas', 'colquemarca'),
(728774, 'cusco', 'chumbivilcas', 'chamaca'),
(729775, 'cusco', 'chumbivilcas', 'livitaca'),
(730776, 'cusco', 'chumbivilcas', 'llusco'),
(731512, 'amazonas', 'rodriguez de mendoza', 'vista alegre'),
(731777, 'cusco', 'chumbivilcas', 'quiñota'),
(732778, 'cusco', 'chumbivilcas', 'velille'),
(733781, 'cusco', 'espinar', 'espinar'),
(734782, 'cusco', 'espinar', 'condoroma'),
(735783, 'cusco', 'espinar', 'coporaque'),
(736784, 'cusco', 'espinar', 'ocoruro'),
(737785, 'cusco', 'espinar', 'pallpata'),
(738786, 'cusco', 'espinar', 'pichigua'),
(739787, 'cusco', 'espinar', 'suykutambo'),
(740788, 'cusco', 'espinar', 'alto pichigua'),
(741791, 'cusco', 'la convencion', 'santa ana'),
(742792, 'cusco', 'la convencion', 'echarate'),
(743793, 'cusco', 'la convencion', 'huayopata'),
(744794, 'cusco', 'la convencion', 'maranura'),
(745795, 'cusco', 'la convencion', 'ocobamba'),
(746796, 'cusco', 'la convencion', 'santa teresa'),
(747797, 'cusco', 'la convencion', 'vilcabamba'),
(748798, 'cusco', 'la convencion', 'quellouno'),
(749799, 'cusco', 'la convencion', 'kimbiri'),
(785811, 'huancavelica', 'huancavelica', 'huancavelica'),
(786812, 'huancavelica', 'huancavelica', 'acobambilla'),
(787813, 'huancavelica', 'huancavelica', 'acoria'),
(788814, 'huancavelica', 'huancavelica', 'conayca'),
(789815, 'huancavelica', 'huancavelica', 'cuenca'),
(790816, 'huancavelica', 'huancavelica', 'huachocolpa'),
(791818, 'huancavelica', 'huancavelica', 'huayllahuara'),
(792819, 'huancavelica', 'huancavelica', 'izcuchaca'),
(804821, 'huancavelica', 'acobamba', 'acobamba'),
(805822, 'huancavelica', 'acobamba', 'anta'),
(806823, 'huancavelica', 'acobamba', 'andabamba'),
(807824, 'huancavelica', 'acobamba', 'caja'),
(808825, 'huancavelica', 'acobamba', 'marcas'),
(809826, 'huancavelica', 'acobamba', 'paucara'),
(810827, 'huancavelica', 'acobamba', 'pomacocha'),
(811828, 'huancavelica', 'acobamba', 'rosario'),
(812831, 'huancavelica', 'angaraes', 'lircay'),
(813832, 'huancavelica', 'angaraes', 'anchonga'),
(814833, 'huancavelica', 'angaraes', 'callanmarca'),
(815834, 'huancavelica', 'angaraes', 'congalla'),
(816835, 'huancavelica', 'angaraes', 'chincho'),
(817836, 'huancavelica', 'angaraes', 'huayllay grande'),
(818837, 'huancavelica', 'angaraes', 'huanca huanca'),
(819838, 'huancavelica', 'angaraes', 'julcamarca'),
(820839, 'huancavelica', 'angaraes', 'san antonio de antaparco'),
(824841, 'huancavelica', 'castrovirreyna', 'castrovirreyna'),
(825842, 'huancavelica', 'castrovirreyna', 'arma'),
(826843, 'huancavelica', 'castrovirreyna', 'aurahua'),
(827845, 'huancavelica', 'castrovirreyna', 'capillas'),
(828846, 'huancavelica', 'castrovirreyna', 'cocas'),
(829848, 'huancavelica', 'castrovirreyna', 'chupamarca'),
(830849, 'huancavelica', 'castrovirreyna', 'huachos'),
(837851, 'huancavelica', 'tayacaja', 'pampas'),
(838852, 'huancavelica', 'tayacaja', 'acostambo'),
(839853, 'huancavelica', 'tayacaja', 'acraquia'),
(840854, 'huancavelica', 'tayacaja', 'ahuaycha'),
(841856, 'huancavelica', 'tayacaja', 'colcabamba'),
(842859, 'huancavelica', 'tayacaja', 'daniel hernandez'),
(853861, 'huancavelica', 'huaytara', 'ayavi'),
(854862, 'huancavelica', 'huaytara', 'cordova'),
(855863, 'huancavelica', 'huaytara', 'huayacundo arma'),
(856864, 'huancavelica', 'huaytara', 'huaytara'),
(857865, 'huancavelica', 'huaytara', 'laramarca'),
(858866, 'huancavelica', 'huaytara', 'ocoyo'),
(859867, 'huancavelica', 'huaytara', 'pilpichaca'),
(860868, 'huancavelica', 'huaytara', 'querco'),
(861869, 'huancavelica', 'huaytara', 'quito arma'),
(869871, 'huancavelica', 'churcampa', 'churcampa'),
(870872, 'huancavelica', 'churcampa', 'anco'),
(871873, 'huancavelica', 'churcampa', 'chinchihuasi'),
(872874, 'huancavelica', 'churcampa', 'el carmen'),
(873875, 'huancavelica', 'churcampa', 'la merced'),
(874876, 'huancavelica', 'churcampa', 'locroja'),
(875877, 'huancavelica', 'churcampa', 'paucarbamba'),
(876878, 'huancavelica', 'churcampa', 'san miguel de mayoc'),
(877879, 'huancavelica', 'churcampa', 'san pedro de coris'),
(879911, 'huanuco', 'huanuco', 'huanuco'),
(880912, 'huanuco', 'huanuco', 'chinchao'),
(881913, 'huanuco', 'huanuco', 'churubamba'),
(882914, 'huanuco', 'huanuco', 'margos'),
(883915, 'huanuco', 'huanuco', 'quisqui'),
(884916, 'huanuco', 'huanuco', 'san fco de cayran'),
(885917, 'huanuco', 'huanuco', 'san pedro de chaulan'),
(886918, 'huanuco', 'huanuco', 'sta maria del valle'),
(887919, 'huanuco', 'huanuco', 'yarumayo'),
(890921, 'huanuco', 'ambo', 'ambo'),
(891922, 'huanuco', 'ambo', 'cayna'),
(892923, 'huanuco', 'ambo', 'colpas'),
(893924, 'huanuco', 'ambo', 'conchamarca'),
(894925, 'huanuco', 'ambo', 'huacar'),
(895926, 'huanuco', 'ambo', 'san francisco'),
(896927, 'huanuco', 'ambo', 'san rafael'),
(897928, 'huanuco', 'ambo', 'tomay kichwa'),
(898931, 'huanuco', 'dos de mayo', 'la union'),
(899937, 'huanuco', 'dos de mayo', 'chuquis'),
(907941, 'huanuco', 'huamalies', 'llata'),
(908942, 'huanuco', 'huamalies', 'arancay'),
(909943, 'huanuco', 'huamalies', 'chavin de pariarca'),
(910944, 'huanuco', 'huamalies', 'jacas grande'),
(911945, 'huanuco', 'huamalies', 'jircan'),
(912946, 'huanuco', 'huamalies', 'miraflores'),
(913947, 'huanuco', 'huamalies', 'monzon'),
(914948, 'huanuco', 'huamalies', 'punchao'),
(915949, 'huanuco', 'huamalies', 'puños'),
(918951, 'huanuco', 'marañon', 'huacrachuco'),
(919952, 'huanuco', 'marañon', 'cholon'),
(920955, 'huanuco', 'marañon', 'san buenaventura'),
(921961, 'huanuco', 'leoncio prado', 'rupa rupa'),
(922962, 'huanuco', 'leoncio prado', 'daniel alomia robles'),
(923963, 'huanuco', 'leoncio prado', 'hermilio valdizan'),
(924964, 'huanuco', 'leoncio prado', 'luyando'),
(925965, 'huanuco', 'leoncio prado', 'mariano damaso beraun'),
(926966, 'huanuco', 'leoncio prado', 'jose crespo y castillo'),
(927971, 'huanuco', 'pachitea', 'panao'),
(928972, 'huanuco', 'pachitea', 'chaglla'),
(929974, 'huanuco', 'pachitea', 'molino'),
(930976, 'huanuco', 'pachitea', 'umari'),
(931981, 'huanuco', 'puerto inca', 'honoria'),
(932110, 'ancash', 'huaraz', 'pariacoto'),
(932982, 'huanuco', 'puerto inca', 'puerto inca'),
(933983, 'huanuco', 'puerto inca', 'codo del pozuzo'),
(934984, 'huanuco', 'puerto inca', 'tournavista'),
(935985, 'huanuco', 'puerto inca', 'yuyapichis'),
(936991, 'huanuco', 'huacaybamba', 'huacaybamba'),
(937992, 'huanuco', 'huacaybamba', 'pinra'),
(938993, 'huanuco', 'huacaybamba', 'canchabamba'),
(939994, 'huanuco', 'huacaybamba', 'cochabamba'),
(942111, 'ancash', 'huaraz', 'pira'),
(952112, 'ancash', 'huaraz', 'tarica'),
(1052310, 'ancash', 'bolognesi', 'huayllacayan'),
(1062311, 'ancash', 'bolognesi', 'huasta'),
(1072313, 'ancash', 'bolognesi', 'mangas'),
(1082315, 'ancash', 'bolognesi', 'pacllon'),
(1092317, 'ancash', 'bolognesi', 'san miguel de corpanqui'),
(1102320, 'ancash', 'bolognesi', 'ticllos'),
(1112321, 'ancash', 'bolognesi', 'antonio raimondi'),
(1122322, 'ancash', 'bolognesi', 'canis'),
(1132323, 'ancash', 'bolognesi', 'colquioc'),
(1142324, 'ancash', 'bolognesi', 'la primavera'),
(1152325, 'ancash', 'bolognesi', 'huallanca'),
(1252410, 'ancash', 'carhuaz', 'tinco'),
(1262411, 'ancash', 'carhuaz', 'yungar'),
(1472710, 'ancash', 'huaylas', 'santo toribio'),
(1572810, 'ancash', 'huari', 'ponto'),
(1582811, 'ancash', 'huari', 'rahuapampa'),
(1592812, 'ancash', 'huari', 'rapayan'),
(1602813, 'ancash', 'huari', 'san marcos'),
(1612814, 'ancash', 'huari', 'san pedro de chana'),
(1622815, 'ancash', 'huari', 'uco'),
(1632816, 'ancash', 'huari', 'anra'),
(1722101, 'ancash', 'pallasca', 'cabana'),
(1732102, 'ancash', 'pallasca', 'bolognesi'),
(1742103, 'ancash', 'pallasca', 'conchucos'),
(1752104, 'ancash', 'pallasca', 'huacaschuque'),
(1762105, 'ancash', 'pallasca', 'huandoval'),
(1772106, 'ancash', 'pallasca', 'lacabamba'),
(1782107, 'ancash', 'pallasca', 'llapo'),
(1792108, 'ancash', 'pallasca', 'pallasca'),
(1802109, 'ancash', 'pallasca', 'pampas'),
(1832111, 'ancash', 'pomabamba', 'pomabamba'),
(1834125, 'amazonas', 'bagua', 'bagua'),
(1842112, 'ancash', 'pomabamba', 'huayllan'),
(1852113, 'ancash', 'pomabamba', 'parobamba'),
(1862114, 'ancash', 'pomabamba', 'quinuabamba'),
(1872121, 'ancash', 'recuay', 'recuay'),
(1882122, 'ancash', 'recuay', 'cotaparaco'),
(1892123, 'ancash', 'recuay', 'huayllapampa'),
(1902124, 'ancash', 'recuay', 'marca'),
(1912125, 'ancash', 'recuay', 'pampas chico'),
(1922126, 'ancash', 'recuay', 'pararin'),
(1932127, 'ancash', 'recuay', 'tapacocha'),
(1942128, 'ancash', 'recuay', 'ticapampa'),
(1952129, 'ancash', 'recuay', 'llacllin'),
(1972131, 'ancash', 'santa', 'chimbote'),
(1982132, 'ancash', 'santa', 'caceres del peru'),
(1992133, 'ancash', 'santa', 'macate'),
(2002134, 'ancash', 'santa', 'moro'),
(2012135, 'ancash', 'santa', 'nepeña'),
(2022136, 'ancash', 'santa', 'samanco'),
(2032137, 'ancash', 'santa', 'santa'),
(2042138, 'ancash', 'santa', 'coishco'),
(2052139, 'ancash', 'santa', 'nuevo chimbote'),
(2062141, 'ancash', 'sihuas', 'sihuas'),
(2072142, 'ancash', 'sihuas', 'alfonso ugarte'),
(2082143, 'ancash', 'sihuas', 'chingalpo'),
(2092144, 'ancash', 'sihuas', 'huayllabamba'),
(2102145, 'ancash', 'sihuas', 'quiches'),
(2112146, 'ancash', 'sihuas', 'sicsibamba'),
(2122147, 'ancash', 'sihuas', 'acobamba'),
(2132148, 'ancash', 'sihuas', 'cashapampa'),
(2142149, 'ancash', 'sihuas', 'ragash'),
(2162151, 'ancash', 'yungay', 'yungay'),
(2172152, 'ancash', 'yungay', 'cascapara'),
(2182153, 'ancash', 'yungay', 'mancos'),
(2192154, 'ancash', 'yungay', 'matacoto'),
(2202155, 'ancash', 'yungay', 'quillo'),
(2212156, 'ancash', 'yungay', 'ranrahirca'),
(2222157, 'ancash', 'yungay', 'shupluy'),
(2232158, 'ancash', 'yungay', 'yanama'),
(2242161, 'ancash', 'antonio raimondi', 'llamellin'),
(2252162, 'ancash', 'antonio raimondi', 'aczo'),
(2262163, 'ancash', 'antonio raimondi', 'chaccho'),
(2272164, 'ancash', 'antonio raimondi', 'chingas'),
(2282165, 'ancash', 'antonio raimondi', 'mirgas'),
(2292166, 'ancash', 'antonio raimondi', 'san juan de rontoy'),
(2302171, 'ancash', 'carlos fermin fitzcarrald', 'san luis'),
(2312172, 'ancash', 'carlos fermin fitzcarrald', 'yauya'),
(2322173, 'ancash', 'carlos fermin fitzcarrald', 'san nicolas'),
(2332181, 'ancash', 'asuncion', 'chacas'),
(2342182, 'ancash', 'asuncion', 'acochaca'),
(2352191, 'ancash', 'huarmey', 'huarmey'),
(2362192, 'ancash', 'huarmey', 'cochapeti'),
(2372193, 'ancash', 'huarmey', 'huayan'),
(2382194, 'ancash', 'huarmey', 'malvas'),
(2392195, 'ancash', 'huarmey', 'culebras'),
(2402201, 'ancash', 'ocros', 'acas'),
(2412202, 'ancash', 'ocros', 'cajamarquilla'),
(2422203, 'ancash', 'ocros', 'carhuapampa'),
(2432204, 'ancash', 'ocros', 'cochas'),
(2442205, 'ancash', 'ocros', 'congas'),
(2452206, 'ancash', 'ocros', 'llipa'),
(2462207, 'ancash', 'ocros', 'ocros'),
(2472208, 'ancash', 'ocros', 'san cristobal de rajan'),
(2482209, 'ancash', 'ocros', 'san pedro'),
(2683210, 'apurimac', 'aymaraes', 'sañaica'),
(2693211, 'apurimac', 'aymaraes', 'soraya'),
(2703212, 'apurimac', 'aymaraes', 'tapairihua'),
(2713213, 'apurimac', 'aymaraes', 'tintay'),
(2723214, 'apurimac', 'aymaraes', 'toraya'),
(2733215, 'apurimac', 'aymaraes', 'yanaca'),
(2743216, 'apurimac', 'aymaraes', 'san juan de chacña'),
(2753217, 'apurimac', 'aymaraes', 'justo apu sahuaraura'),
(2853310, 'apurimac', 'andahuaylas', 'san jeronimo'),
(2863311, 'apurimac', 'andahuaylas', 'talavera'),
(2873312, 'apurimac', 'andahuaylas', 'turpo'),
(2883313, 'apurimac', 'andahuaylas', 'pacucha'),
(2893314, 'apurimac', 'andahuaylas', 'pomacocha'),
(2903315, 'apurimac', 'andahuaylas', 'sta maria de chicmo'),
(2913316, 'apurimac', 'andahuaylas', 'tumay huaraca'),
(2923317, 'apurimac', 'andahuaylas', 'huayana'),
(2933318, 'apurimac', 'andahuaylas', 'san miguel de chaccrampa'),
(2943319, 'apurimac', 'andahuaylas', 'kaquiabamba'),
(3173610, 'apurimac', 'grau', 'turpay'),
(3183611, 'apurimac', 'grau', 'vilcabamba'),
(3193612, 'apurimac', 'grau', 'virundo'),
(3203613, 'apurimac', 'grau', 'santa rosa'),
(3213614, 'apurimac', 'grau', 'curasco'),
(3394110, 'arequipa', 'arequipa', 'pocsi'),
(3404111, 'arequipa', 'arequipa', 'polobaya'),
(3414112, 'arequipa', 'arequipa', 'quequeña'),
(3424113, 'arequipa', 'arequipa', 'sabandia'),
(3434114, 'arequipa', 'arequipa', 'sachaca'),
(3444115, 'arequipa', 'arequipa', 'san juan de siguas'),
(3454116, 'arequipa', 'arequipa', 'san juan de tarucani'),
(3464117, 'arequipa', 'arequipa', 'santa isabel de siguas'),
(3474118, 'arequipa', 'arequipa', 'sta rita de siguas'),
(3484119, 'arequipa', 'arequipa', 'socabaya'),
(3494120, 'arequipa', 'arequipa', 'tiabaya'),
(3504121, 'arequipa', 'arequipa', 'uchumayo'),
(3514122, 'arequipa', 'arequipa', 'vitor'),
(3524123, 'arequipa', 'arequipa', 'yanahuara'),
(3534124, 'arequipa', 'arequipa', 'yarabamba'),
(3544125, 'arequipa', 'arequipa', 'yura'),
(3554126, 'arequipa', 'arequipa', 'mariano melgar'),
(3564127, 'arequipa', 'arequipa', 'jacobo hunter'),
(3574128, 'arequipa', 'arequipa', 'alto selva alegre'),
(3584129, 'arequipa', 'arequipa', 'jose luis bustamante y rivero'),
(3684210, 'arequipa', 'caylloma', 'lari'),
(3694211, 'arequipa', 'caylloma', 'lluta'),
(3704212, 'arequipa', 'caylloma', 'maca'),
(3714213, 'arequipa', 'caylloma', 'madrigal'),
(3724214, 'arequipa', 'caylloma', 'san antonio de chuca'),
(3734215, 'arequipa', 'caylloma', 'sibayo'),
(3744216, 'arequipa', 'caylloma', 'tapay'),
(3754217, 'arequipa', 'caylloma', 'tisco'),
(3764218, 'arequipa', 'caylloma', 'tuti'),
(3774219, 'arequipa', 'caylloma', 'yanque'),
(3784220, 'arequipa', 'caylloma', 'majes'),
(3964410, 'arequipa', 'caraveli', 'jaqui'),
(3974411, 'arequipa', 'caraveli', 'lomas'),
(3984412, 'arequipa', 'caraveli', 'quicacha'),
(3994413, 'arequipa', 'caraveli', 'yauca'),
(4094510, 'arequipa', 'castilla', 'pampacolca'),
(4104511, 'arequipa', 'castilla', 'tipan'),
(4114512, 'arequipa', 'castilla', 'uraca'),
(4124513, 'arequipa', 'castilla', 'uñon'),
(4134514, 'arequipa', 'castilla', 'viraco'),
(4374810, 'arequipa', 'la union', 'tomepampa'),
(4384811, 'arequipa', 'la union', 'toro'),
(4485110, 'ayacucho', 'huamanga', 'tambillo'),
(4495111, 'ayacucho', 'huamanga', 'acocro'),
(4505112, 'ayacucho', 'huamanga', 'socos'),
(4515113, 'ayacucho', 'huamanga', 'ocros'),
(4525114, 'ayacucho', 'huamanga', 'pacaycasa'),
(4535115, 'ayacucho', 'huamanga', 'jesus nazareno'),
(4595211, 'ayacucho', 'cangallo', 'maria parado de bellido'),
(4825510, 'ayacucho', 'lucanas', 'huac-huas'),
(4835511, 'ayacucho', 'lucanas', 'laramate'),
(4845512, 'ayacucho', 'lucanas', 'leoncio prado'),
(4855513, 'ayacucho', 'lucanas', 'lucanas'),
(4865514, 'ayacucho', 'lucanas', 'llauta'),
(4875516, 'ayacucho', 'lucanas', 'ocaña'),
(4885517, 'ayacucho', 'lucanas', 'otoca'),
(4895520, 'ayacucho', 'lucanas', 'sancos'),
(4905521, 'ayacucho', 'lucanas', 'san juan'),
(4915522, 'ayacucho', 'lucanas', 'san pedro'),
(4925524, 'ayacucho', 'lucanas', 'sta ana de huaycahuacho'),
(4935525, 'ayacucho', 'lucanas', 'santa lucia'),
(4945529, 'ayacucho', 'lucanas', 'saisa'),
(4955531, 'ayacucho', 'lucanas', 'san pedro de palco'),
(4965532, 'ayacucho', 'lucanas', 'san cristobal'),
(5015611, 'ayacucho', 'parinacochas', 'pullo'),
(5025612, 'ayacucho', 'parinacochas', 'puyusca'),
(5035615, 'ayacucho', 'parinacochas', 'san fco de ravacayco'),
(5045616, 'ayacucho', 'parinacochas', 'upahuacho'),
(5135710, 'ayacucho', 'victor fajardo', 'huancaraylla'),
(5145713, 'ayacucho', 'victor fajardo', 'sarhua'),
(5155714, 'ayacucho', 'victor fajardo', 'vilcanchos'),
(5165715, 'ayacucho', 'victor fajardo', 'asquipata'),
(5295101, 'ayacucho', 'paucar del sara sara', 'pausa'),
(5305102, 'ayacucho', 'paucar del sara sara', 'colta'),
(5315103, 'ayacucho', 'paucar del sara sara', 'corculla'),
(5325104, 'ayacucho', 'paucar del sara sara', 'lampa'),
(5335105, 'ayacucho', 'paucar del sara sara', 'marcabamba'),
(5345106, 'ayacucho', 'paucar del sara sara', 'oyolo'),
(5355107, 'ayacucho', 'paucar del sara sara', 'pararca'),
(5365108, 'ayacucho', 'paucar del sara sara', 'san javier de alpabamba'),
(5375109, 'ayacucho', 'paucar del sara sara', 'san jose de ushua'),
(5395111, 'ayacucho', 'sucre', 'querobamba'),
(5405112, 'ayacucho', 'sucre', 'belen'),
(5415113, 'ayacucho', 'sucre', 'chalcos'),
(5425114, 'ayacucho', 'sucre', 'san salvador de quije'),
(5435115, 'ayacucho', 'sucre', 'paico'),
(5445116, 'ayacucho', 'sucre', 'santiago de paucaray'),
(5455117, 'ayacucho', 'sucre', 'san pedro de larcay'),
(5465118, 'ayacucho', 'sucre', 'soras'),
(5475119, 'ayacucho', 'sucre', 'huacaña'),
(5596110, 'cajamarca', 'cajamarca', 'matara'),
(5606111, 'cajamarca', 'cajamarca', 'namora'),
(5616112, 'cajamarca', 'cajamarca', 'san juan'),
(5756310, 'cajamarca', 'celendin', 'sucre'),
(5766311, 'cajamarca', 'celendin', 'utco'),
(5776312, 'cajamarca', 'celendin', 'la libertad de pallan'),
(5956510, 'cajamarca', 'cutervo', 'san luis de lucma'),
(5966511, 'cajamarca', 'cutervo', 'santa cruz'),
(5976512, 'cajamarca', 'cutervo', 'santo domingo de la capilla'),
(5986513, 'cajamarca', 'cutervo', 'santo tomas'),
(5996514, 'cajamarca', 'cutervo', 'socota'),
(6006515, 'cajamarca', 'cutervo', 'toribio casanova'),
(6106610, 'cajamarca', 'chota', 'llama'),
(6116611, 'cajamarca', 'chota', 'miracosta'),
(6126612, 'cajamarca', 'chota', 'paccha'),
(6136613, 'cajamarca', 'chota', 'pion'),
(6146614, 'cajamarca', 'chota', 'querocoto'),
(6156615, 'cajamarca', 'chota', 'tacabamba'),
(6166616, 'cajamarca', 'chota', 'tocmoche'),
(6176617, 'cajamarca', 'chota', 'san juan de licupis'),
(6186618, 'cajamarca', 'chota', 'choropampa'),
(6196619, 'cajamarca', 'chota', 'chalamarca'),
(6326810, 'cajamarca', 'jaen', 'santa rosa'),
(6336811, 'cajamarca', 'jaen', 'las pirias'),
(6346812, 'cajamarca', 'jaen', 'huabal'),
(6446910, 'cajamarca', 'santa cruz', 'andabamba'),
(6456911, 'cajamarca', 'santa cruz', 'saucepampa'),
(6466101, 'cajamarca', 'san miguel', 'san miguel'),
(6476102, 'cajamarca', 'san miguel', 'calquis'),
(6486103, 'cajamarca', 'san miguel', 'la florida'),
(6496104, 'cajamarca', 'san miguel', 'llapa'),
(6506105, 'cajamarca', 'san miguel', 'nanchoc'),
(6516106, 'cajamarca', 'san miguel', 'niepos'),
(6526107, 'cajamarca', 'san miguel', 'san gregorio'),
(6536108, 'cajamarca', 'san miguel', 'san silvestre de cochan'),
(6546109, 'cajamarca', 'san miguel', 'el prado'),
(6596111, 'cajamarca', 'san ignacio', 'san ignacio'),
(6606112, 'cajamarca', 'san ignacio', 'chirinos'),
(6616113, 'cajamarca', 'san ignacio', 'huarango'),
(6626114, 'cajamarca', 'san ignacio', 'namballe'),
(6636115, 'cajamarca', 'san ignacio', 'la coipa'),
(6646116, 'cajamarca', 'san ignacio', 'san jose de lourdes'),
(6656117, 'cajamarca', 'san ignacio', 'tabaconas'),
(6666121, 'cajamarca', 'san marcos', 'pedro galvez'),
(6676122, 'cajamarca', 'san marcos', 'ichocan'),
(6686123, 'cajamarca', 'san marcos', 'gregorio pita'),
(6696124, 'cajamarca', 'san marcos', 'jose manuel quiroz'),
(6706125, 'cajamarca', 'san marcos', 'eduardo villanueva'),
(6716126, 'cajamarca', 'san marcos', 'jose sabogal'),
(6726127, 'cajamarca', 'san marcos', 'chancay'),
(6736131, 'cajamarca', 'san pablo', 'san pablo'),
(6746132, 'cajamarca', 'san pablo', 'san bernardino'),
(6756133, 'cajamarca', 'san pablo', 'san luis'),
(6766134, 'cajamarca', 'san pablo', 'tumbaden'),
(7507910, 'cusco', 'la convencion', 'pichari'),
(7517101, 'cusco', 'paruro', 'paruro'),
(7527102, 'cusco', 'paruro', 'accha'),
(7537103, 'cusco', 'paruro', 'ccapi'),
(7547104, 'cusco', 'paruro', 'colcha'),
(7557105, 'cusco', 'paruro', 'huanoquite'),
(7567106, 'cusco', 'paruro', 'omacha'),
(7577107, 'cusco', 'paruro', 'yaurisque'),
(7587108, 'cusco', 'paruro', 'paccaritambo'),
(7597109, 'cusco', 'paruro', 'pillpinto'),
(7607111, 'cusco', 'paucartambo', 'paucartambo'),
(7617112, 'cusco', 'paucartambo', 'caicay'),
(7627113, 'cusco', 'paucartambo', 'colquepata'),
(7637114, 'cusco', 'paucartambo', 'challabamba'),
(7647115, 'cusco', 'paucartambo', 'cosñipata'),
(7657116, 'cusco', 'paucartambo', 'huancarani'),
(7667121, 'cusco', 'quispicanchi', 'urcos'),
(7677122, 'cusco', 'quispicanchi', 'andahuaylillas'),
(7687123, 'cusco', 'quispicanchi', 'camanti'),
(7697124, 'cusco', 'quispicanchi', 'ccarhuayo'),
(7707125, 'cusco', 'quispicanchi', 'ccatca'),
(7717126, 'cusco', 'quispicanchi', 'cusipata'),
(7727127, 'cusco', 'quispicanchi', 'huaro'),
(7737128, 'cusco', 'quispicanchi', 'lucre'),
(7747129, 'cusco', 'quispicanchi', 'marcapata'),
(7787131, 'cusco', 'urubamba', 'urubamba'),
(7797132, 'cusco', 'urubamba', 'chinchero'),
(7807133, 'cusco', 'urubamba', 'huayllabamba'),
(7817134, 'cusco', 'urubamba', 'machupicchu'),
(7827135, 'cusco', 'urubamba', 'maras'),
(7837136, 'cusco', 'urubamba', 'ollantaytambo'),
(7847137, 'cusco', 'urubamba', 'yucay'),
(7938110, 'huancavelica', 'huancavelica', 'laria'),
(7948111, 'huancavelica', 'huancavelica', 'manta'),
(7958112, 'huancavelica', 'huancavelica', 'mariscal caceres'),
(7968113, 'huancavelica', 'huancavelica', 'moya'),
(7978114, 'huancavelica', 'huancavelica', 'nuevo occoro'),
(7988115, 'huancavelica', 'huancavelica', 'palca'),
(7998116, 'huancavelica', 'huancavelica', 'pilchaca'),
(8008117, 'huancavelica', 'huancavelica', 'vilca'),
(8018118, 'huancavelica', 'huancavelica', 'yauli'),
(8028119, 'huancavelica', 'huancavelica', 'ascension'),
(8038120, 'huancavelica', 'huancavelica', 'huando'),
(8218310, 'huancavelica', 'angaraes', 'sto tomas de pata'),
(8228311, 'huancavelica', 'angaraes', 'secclla'),
(8238312, 'huancavelica', 'angaraes', 'ccochaccasa'),
(8318410, 'huancavelica', 'castrovirreyna', 'huamatambo'),
(8328414, 'huancavelica', 'castrovirreyna', 'mollepampa'),
(8338422, 'huancavelica', 'castrovirreyna', 'san juan'),
(8348427, 'huancavelica', 'castrovirreyna', 'tantara'),
(8358428, 'huancavelica', 'castrovirreyna', 'ticrapo'),
(8368429, 'huancavelica', 'castrovirreyna', 'santa ana'),
(8438511, 'huancavelica', 'tayacaja', 'huachocolpa'),
(8448512, 'huancavelica', 'tayacaja', 'huaribamba'),
(8458515, 'huancavelica', 'tayacaja', 'ñahuimpuquio'),
(8468517, 'huancavelica', 'tayacaja', 'pazos'),
(8478518, 'huancavelica', 'tayacaja', 'quishuar'),
(8488519, 'huancavelica', 'tayacaja', 'salcabamba'),
(8498520, 'huancavelica', 'tayacaja', 'san marcos de rocchac'),
(8508523, 'huancavelica', 'tayacaja', 'surcubamba'),
(8518525, 'huancavelica', 'tayacaja', 'tintay puncu'),
(8528526, 'huancavelica', 'tayacaja', 'salcahuasi'),
(8628610, 'huancavelica', 'huaytara', 'san antonio de cusicancha'),
(8638611, 'huancavelica', 'huaytara', 'san francisco de sangayaico'),
(8648612, 'huancavelica', 'huaytara', 'san isidro'),
(8658613, 'huancavelica', 'huaytara', 'santiago de chocorvos'),
(8668614, 'huancavelica', 'huaytara', 'santiago de quirahuara'),
(8678615, 'huancavelica', 'huaytara', 'santo domingo de capillas'),
(8688616, 'huancavelica', 'huaytara', 'tambo'),
(8788710, 'huancavelica', 'churcampa', 'pachamarca'),
(8889110, 'huanuco', 'huanuco', 'amarilis'),
(8899111, 'huanuco', 'huanuco', 'pillco marca'),
(9009312, 'huanuco', 'dos de mayo', 'marias'),
(9019314, 'huanuco', 'dos de mayo', 'pachas'),
(9029316, 'huanuco', 'dos de mayo', 'quivilla'),
(9039317, 'huanuco', 'dos de mayo', 'ripan'),
(9049321, 'huanuco', 'dos de mayo', 'shunqui'),
(9059322, 'huanuco', 'dos de mayo', 'sillapata'),
(9069323, 'huanuco', 'dos de mayo', 'yanas'),
(9169410, 'huanuco', 'huamalies', 'singa'),
(9179411, 'huanuco', 'huamalies', 'tantamayo'),
(9409101, 'huanuco', 'lauricocha', 'jesus'),
(9419102, 'huanuco', 'lauricocha', 'baños'),
(9429103, 'huanuco', 'lauricocha', 'san francisco de asis'),
(9439104, 'huanuco', 'lauricocha', 'queropalca'),
(9449105, 'huanuco', 'lauricocha', 'san miguel de cauri'),
(9459106, 'huanuco', 'lauricocha', 'rondos'),
(9469107, 'huanuco', 'lauricocha', 'jivia'),
(9479111, 'huanuco', 'yarowilca', 'chavinillo'),
(9489112, 'huanuco', 'yarowilca', 'aparicio pomares (chupan);'),
(9499113, 'huanuco', 'yarowilca', 'cahuac'),
(9509114, 'huanuco', 'yarowilca', 'chacabamba'),
(9519115, 'huanuco', 'yarowilca', 'jacas chico'),
(9529116, 'huanuco', 'yarowilca', 'obas'),
(9539117, 'huanuco', 'yarowilca', 'pampamarca'),
(9549118, 'huanuco', 'yarowilca', 'choras'),
(9551011, 'ica', 'ica', 'ica'),
(9561012, 'ica', 'ica', 'la tinguiña'),
(9571013, 'ica', 'ica', 'los aquijes'),
(9581014, 'ica', 'ica', 'parcona'),
(9591015, 'ica', 'ica', 'pueblo nuevo'),
(9601016, 'ica', 'ica', 'salas'),
(9611017, 'ica', 'ica', 'san jose de los molinos'),
(9621018, 'ica', 'ica', 'san juan bautista'),
(9631019, 'ica', 'ica', 'santiago'),
(9691021, 'ica', 'chincha', 'chincha alta'),
(9701022, 'ica', 'chincha', 'chavin'),
(9711023, 'ica', 'chincha', 'chincha baja'),
(9721024, 'ica', 'chincha', 'el carmen'),
(9731025, 'ica', 'chincha', 'grocio prado'),
(9741026, 'ica', 'chincha', 'san pedro de huacarpana'),
(9751027, 'ica', 'chincha', 'sunampe'),
(9761028, 'ica', 'chincha', 'tambo de mora'),
(9771029, 'ica', 'chincha', 'alto laran'),
(9801031, 'ica', 'nazca', 'nazca'),
(9811032, 'ica', 'nazca', 'changuillo'),
(9821033, 'ica', 'nazca', 'el ingenio'),
(9831034, 'ica', 'nazca', 'marcona'),
(9841035, 'ica', 'nazca', 'vista alegre'),
(9851041, 'ica', 'pisco', 'pisco'),
(9861042, 'ica', 'pisco', 'huancano'),
(9871043, 'ica', 'pisco', 'humay'),
(9881044, 'ica', 'pisco', 'independencia'),
(9891045, 'ica', 'pisco', 'paracas'),
(9901046, 'ica', 'pisco', 'san andres'),
(9911047, 'ica', 'pisco', 'san clemente'),
(9921048, 'ica', 'pisco', 'tupac amaru inca'),
(9931051, 'ica', 'palpa', 'palpa'),
(9941052, 'ica', 'palpa', 'llipata'),
(9951053, 'ica', 'palpa', 'rio grande'),
(9961054, 'ica', 'palpa', 'santa cruz'),
(9971055, 'ica', 'palpa', 'tibillo'),
(9981111, 'junin', 'huancayo', 'huancayo'),
(9991113, 'junin', 'huancayo', 'carhuacallanga'),
(10001114, 'junin', 'huancayo', 'colca'),
(10011115, 'junin', 'huancayo', 'cullhuas'),
(10021116, 'junin', 'huancayo', 'chacapampa'),
(10031117, 'junin', 'huancayo', 'chicche'),
(10041118, 'junin', 'huancayo', 'chilca'),
(10051119, 'junin', 'huancayo', 'chongos alto'),
(10261121, 'junin', 'concepcion', 'concepcion'),
(10271122, 'junin', 'concepcion', 'aco'),
(10281123, 'junin', 'concepcion', 'andamarca'),
(10291124, 'junin', 'concepcion', 'comas'),
(10301125, 'junin', 'concepcion', 'cochas'),
(10311126, 'junin', 'concepcion', 'chambara'),
(10321127, 'junin', 'concepcion', 'heroinas toledo'),
(10331128, 'junin', 'concepcion', 'manzanares'),
(10341129, 'junin', 'concepcion', 'mcal castilla'),
(10411131, 'junin', 'jauja', 'jauja'),
(10421132, 'junin', 'jauja', 'acolla'),
(10431133, 'junin', 'jauja', 'apata'),
(10441134, 'junin', 'jauja', 'ataura'),
(10451135, 'junin', 'jauja', 'canchaillo'),
(10461136, 'junin', 'jauja', 'el mantaro'),
(10471137, 'junin', 'jauja', 'huamali'),
(10481138, 'junin', 'jauja', 'huaripampa'),
(10491139, 'junin', 'jauja', 'huertas'),
(10751141, 'junin', 'junin', 'junin'),
(10761142, 'junin', 'junin', 'carhuamayo'),
(10771143, 'junin', 'junin', 'ondores'),
(10781144, 'junin', 'junin', 'ulcumayo'),
(10791151, 'junin', 'tarma', 'tarma'),
(10801152, 'junin', 'tarma', 'acobamba'),
(10811153, 'junin', 'tarma', 'huaricolca'),
(10821154, 'junin', 'tarma', 'huasahuasi'),
(10831155, 'junin', 'tarma', 'la union'),
(10841156, 'junin', 'tarma', 'palca'),
(10851157, 'junin', 'tarma', 'palcamayo'),
(10861158, 'junin', 'tarma', 'san pedro de cajas'),
(10871159, 'junin', 'tarma', 'tapo'),
(10881161, 'junin', 'yauli', 'la oroya'),
(10891162, 'junin', 'yauli', 'chacapalpa'),
(10901163, 'junin', 'yauli', 'huay huay'),
(10911164, 'junin', 'yauli', 'marcapomacocha'),
(10921165, 'junin', 'yauli', 'morococha'),
(10931166, 'junin', 'yauli', 'paccha'),
(10941167, 'junin', 'yauli', 'sta barbara de carhuacayan'),
(10951168, 'junin', 'yauli', 'suitucancha'),
(10961169, 'junin', 'yauli', 'yauli'),
(10981171, 'junin', 'satipo', 'satipo'),
(10991172, 'junin', 'satipo', 'coviriali'),
(11001173, 'junin', 'satipo', 'llaylla'),
(11011174, 'junin', 'satipo', 'mazamari'),
(11021175, 'junin', 'satipo', 'pampa hermosa'),
(11031176, 'junin', 'satipo', 'pangoa'),
(11041177, 'junin', 'satipo', 'rio negro'),
(11051178, 'junin', 'satipo', 'rio tambo'),
(11061181, 'junin', 'chanchamayo', 'chanchamayo'),
(11071182, 'junin', 'chanchamayo', 'san ramon'),
(11081183, 'junin', 'chanchamayo', 'vitoc'),
(11091184, 'junin', 'chanchamayo', 'san luis de shuaro'),
(11101185, 'junin', 'chanchamayo', 'pichanaqui'),
(11111186, 'junin', 'chanchamayo', 'perene'),
(11121191, 'junin', 'chupaca', 'chupaca'),
(11131192, 'junin', 'chupaca', 'ahuac'),
(11141193, 'junin', 'chupaca', 'chongos bajo'),
(11151194, 'junin', 'chupaca', 'huachac'),
(11161195, 'junin', 'chupaca', 'huamancaca chico'),
(11171196, 'junin', 'chupaca', 'san juan de iscos'),
(11181197, 'junin', 'chupaca', 'san juan de jarpa'),
(11191198, 'junin', 'chupaca', 'tres de diciembre'),
(11201199, 'junin', 'chupaca', 'yanacancha'),
(11211211, 'la libertad', 'trujillo', 'trujillo'),
(11221212, 'la libertad', 'trujillo', 'huanchaco'),
(11231213, 'la libertad', 'trujillo', 'laredo'),
(11241214, 'la libertad', 'trujillo', 'moche'),
(11251215, 'la libertad', 'trujillo', 'salaverry'),
(11261216, 'la libertad', 'trujillo', 'simbal'),
(11271217, 'la libertad', 'trujillo', 'victor larco herrera'),
(11281219, 'la libertad', 'trujillo', 'poroto'),
(11321221, 'la libertad', 'bolivar', 'bolivar'),
(11331222, 'la libertad', 'bolivar', 'bambamarca'),
(11341223, 'la libertad', 'bolivar', 'condormarca'),
(11351224, 'la libertad', 'bolivar', 'longotea'),
(11361225, 'la libertad', 'bolivar', 'ucuncha'),
(11371226, 'la libertad', 'bolivar', 'uchumarca'),
(11381231, 'la libertad', 'sanchez carrion', 'huamachuco'),
(11391232, 'la libertad', 'sanchez carrion', 'cochorco'),
(11401233, 'la libertad', 'sanchez carrion', 'curgos'),
(11411234, 'la libertad', 'sanchez carrion', 'chugay'),
(11421235, 'la libertad', 'sanchez carrion', 'marcabal'),
(11431236, 'la libertad', 'sanchez carrion', 'sanagoran'),
(11441237, 'la libertad', 'sanchez carrion', 'sarin'),
(11451238, 'la libertad', 'sanchez carrion', 'sartimbamba'),
(11461241, 'la libertad', 'otuzco', 'otuzco'),
(11471242, 'la libertad', 'otuzco', 'agallpampa'),
(11481243, 'la libertad', 'otuzco', 'charat'),
(11491244, 'la libertad', 'otuzco', 'huaranchal'),
(11501245, 'la libertad', 'otuzco', 'la cuesta'),
(11511248, 'la libertad', 'otuzco', 'paranday'),
(11521249, 'la libertad', 'otuzco', 'salpo'),
(11561251, 'la libertad', 'pacasmayo', 'san pedro de lloc'),
(11571253, 'la libertad', 'pacasmayo', 'guadalupe'),
(11581254, 'la libertad', 'pacasmayo', 'jequetepeque'),
(11591256, 'la libertad', 'pacasmayo', 'pacasmayo'),
(11601258, 'la libertad', 'pacasmayo', 'san jose'),
(11611261, 'la libertad', 'pataz', 'tayabamba'),
(11621262, 'la libertad', 'pataz', 'buldibuyo'),
(11631263, 'la libertad', 'pataz', 'chillia'),
(11641264, 'la libertad', 'pataz', 'huaylillas'),
(11651265, 'la libertad', 'pataz', 'huancaspata'),
(11661266, 'la libertad', 'pataz', 'huayo'),
(11671267, 'la libertad', 'pataz', 'ongon'),
(11681268, 'la libertad', 'pataz', 'parcoy'),
(11691269, 'la libertad', 'pataz', 'pataz'),
(11741271, 'la libertad', 'santiago de chuco', 'santiago de chuco'),
(11751272, 'la libertad', 'santiago de chuco', 'cachicadan'),
(11761273, 'la libertad', 'santiago de chuco', 'mollebamba'),
(11771274, 'la libertad', 'santiago de chuco', 'mollepata'),
(11781275, 'la libertad', 'santiago de chuco', 'quiruvilca'),
(11791276, 'la libertad', 'santiago de chuco', 'santa cruz de chuca');
INSERT INTO `ubigeo` (`id_ubigeo`, `departamento`, `provincia`, `distrito`) VALUES
(11801277, 'la libertad', 'santiago de chuco', 'sitabamba'),
(11811278, 'la libertad', 'santiago de chuco', 'angasmarca'),
(11821281, 'la libertad', 'ascope', 'ascope'),
(11831282, 'la libertad', 'ascope', 'chicama'),
(11841283, 'la libertad', 'ascope', 'chocope'),
(11851284, 'la libertad', 'ascope', 'santiago de cao'),
(11861285, 'la libertad', 'ascope', 'magdalena de cao'),
(11871286, 'la libertad', 'ascope', 'paijan'),
(11881287, 'la libertad', 'ascope', 'razuri'),
(11891288, 'la libertad', 'ascope', 'casa grande'),
(11901291, 'la libertad', 'chepen', 'chepen'),
(11911292, 'la libertad', 'chepen', 'pacanga'),
(11921293, 'la libertad', 'chepen', 'pueblo nuevo'),
(12041311, 'lambayeque', 'chiclayo', 'chiclayo'),
(12051312, 'lambayeque', 'chiclayo', 'chongoyape'),
(12061313, 'lambayeque', 'chiclayo', 'eten'),
(12071314, 'lambayeque', 'chiclayo', 'eten puerto'),
(12081315, 'lambayeque', 'chiclayo', 'lagunas'),
(12091316, 'lambayeque', 'chiclayo', 'monsefu'),
(12101317, 'lambayeque', 'chiclayo', 'nueva arica'),
(12111318, 'lambayeque', 'chiclayo', 'oyotun'),
(12121319, 'lambayeque', 'chiclayo', 'picsi'),
(12241321, 'lambayeque', 'ferreñafe', 'ferreñafe'),
(12251322, 'lambayeque', 'ferreñafe', 'incahuasi'),
(12261323, 'lambayeque', 'ferreñafe', 'cañaris'),
(12271324, 'lambayeque', 'ferreñafe', 'pitipo'),
(12281325, 'lambayeque', 'ferreñafe', 'pueblo nuevo'),
(12291326, 'lambayeque', 'ferreñafe', 'manuel antonio mesones muro'),
(12301331, 'lambayeque', 'lambayeque', 'lambayeque'),
(12311332, 'lambayeque', 'lambayeque', 'chochope'),
(12321333, 'lambayeque', 'lambayeque', 'illimo'),
(12331334, 'lambayeque', 'lambayeque', 'jayanca'),
(12341335, 'lambayeque', 'lambayeque', 'mochumi'),
(12351336, 'lambayeque', 'lambayeque', 'morrope'),
(12361337, 'lambayeque', 'lambayeque', 'motupe'),
(12371338, 'lambayeque', 'lambayeque', 'olmos'),
(12381339, 'lambayeque', 'lambayeque', 'pacora'),
(12421411, 'lima', 'lima', 'lima'),
(12431412, 'lima', 'lima', 'ancon'),
(12441413, 'lima', 'lima', 'ate'),
(12451414, 'lima', 'lima', 'breña'),
(12461415, 'lima', 'lima', 'carabayllo'),
(12471416, 'lima', 'lima', 'comas'),
(12481417, 'lima', 'lima', 'chaclacayo'),
(12491418, 'lima', 'lima', 'chorrillos'),
(12501419, 'lima', 'lima', 'la victoria'),
(12851421, 'lima', 'cajatambo', 'cajatambo'),
(12861425, 'lima', 'cajatambo', 'copa'),
(12871426, 'lima', 'cajatambo', 'gorgor'),
(12881427, 'lima', 'cajatambo', 'huancapon'),
(12891428, 'lima', 'cajatambo', 'manas'),
(12901431, 'lima', 'canta', 'canta'),
(12911432, 'lima', 'canta', 'arahuay'),
(12921433, 'lima', 'canta', 'huamantanga'),
(12931434, 'lima', 'canta', 'huaros'),
(12941435, 'lima', 'canta', 'lachaqui'),
(12951436, 'lima', 'canta', 'san buenaventura'),
(12961437, 'lima', 'canta', 'santa rosa de quives'),
(12971441, 'lima', 'cañete', 'san vicente de cañete'),
(12981442, 'lima', 'cañete', 'calango'),
(12991443, 'lima', 'cañete', 'cerro azul'),
(13001444, 'lima', 'cañete', 'coayllo'),
(13011445, 'lima', 'cañete', 'chilca'),
(13021446, 'lima', 'cañete', 'imperial'),
(13031447, 'lima', 'cañete', 'lunahuana'),
(13041448, 'lima', 'cañete', 'mala'),
(13051449, 'lima', 'cañete', 'nuevo imperial'),
(13131451, 'lima', 'huaura', 'huacho'),
(13141452, 'lima', 'huaura', 'ambar'),
(13151454, 'lima', 'huaura', 'caleta de carquin'),
(13161455, 'lima', 'huaura', 'checras'),
(13171456, 'lima', 'huaura', 'hualmay'),
(13181457, 'lima', 'huaura', 'huaura'),
(13191458, 'lima', 'huaura', 'leoncio prado'),
(13201459, 'lima', 'huaura', 'paccho'),
(13251461, 'lima', 'huarochiri', 'matucana'),
(13261462, 'lima', 'huarochiri', 'antioquia'),
(13271463, 'lima', 'huarochiri', 'callahuanca'),
(13281464, 'lima', 'huarochiri', 'carampoma'),
(13291465, 'lima', 'huarochiri', 'casta'),
(13301466, 'lima', 'huarochiri', 'san jose de los chorrillos'),
(13311467, 'lima', 'huarochiri', 'chicla'),
(13321468, 'lima', 'huarochiri', 'huanza'),
(13331469, 'lima', 'huarochiri', 'huarochiri'),
(13571471, 'lima', 'yauyos', 'yauyos'),
(13581472, 'lima', 'yauyos', 'alis'),
(13591473, 'lima', 'yauyos', 'ayauca'),
(13601474, 'lima', 'yauyos', 'ayaviri'),
(13611475, 'lima', 'yauyos', 'azangaro'),
(13621476, 'lima', 'yauyos', 'cacra'),
(13631477, 'lima', 'yauyos', 'carania'),
(13641478, 'lima', 'yauyos', 'cochas'),
(13651479, 'lima', 'yauyos', 'colonia'),
(13901481, 'lima', 'huaral', 'huaral'),
(13911482, 'lima', 'huaral', 'atavillos alto'),
(13921483, 'lima', 'huaral', 'atavillos bajo'),
(13931484, 'lima', 'huaral', 'aucallama'),
(13941485, 'lima', 'huaral', 'chancay'),
(13951486, 'lima', 'huaral', 'ihuari'),
(13961487, 'lima', 'huaral', 'lampian'),
(13971488, 'lima', 'huaral', 'pacaraos'),
(13981489, 'lima', 'huaral', 'san miguel de acos'),
(14021491, 'lima', 'barranca', 'barranca'),
(14031492, 'lima', 'barranca', 'paramonga'),
(14041493, 'lima', 'barranca', 'pativilca'),
(14051494, 'lima', 'barranca', 'supe'),
(14061495, 'lima', 'barranca', 'supe puerto'),
(14131511, 'loreto', 'maynas', 'iquitos'),
(14141512, 'loreto', 'maynas', 'alto nanay'),
(14151513, 'loreto', 'maynas', 'fernando lores'),
(14161514, 'loreto', 'maynas', 'las amazonas'),
(14171515, 'loreto', 'maynas', 'mazan'),
(14181516, 'loreto', 'maynas', 'napo'),
(14191517, 'loreto', 'maynas', 'putumayo'),
(14201518, 'loreto', 'maynas', 'torres causana'),
(14261521, 'loreto', 'alto amazonas', 'yurimaguas'),
(14271522, 'loreto', 'alto amazonas', 'balsapuerto'),
(14281525, 'loreto', 'alto amazonas', 'jeberos'),
(14291526, 'loreto', 'alto amazonas', 'lagunas'),
(14321531, 'loreto', 'loreto', 'nauta'),
(14331532, 'loreto', 'loreto', 'parinari'),
(14341533, 'loreto', 'loreto', 'tigre'),
(14351534, 'loreto', 'loreto', 'urarinas'),
(14361535, 'loreto', 'loreto', 'trompeteros'),
(14371541, 'loreto', 'requena', 'requena'),
(14381542, 'loreto', 'requena', 'alto tapiche'),
(14391543, 'loreto', 'requena', 'capelo'),
(14401544, 'loreto', 'requena', 'emilio san martin'),
(14411545, 'loreto', 'requena', 'maquia'),
(14421546, 'loreto', 'requena', 'puinahua'),
(14431547, 'loreto', 'requena', 'sapuena'),
(14441548, 'loreto', 'requena', 'soplin'),
(14451549, 'loreto', 'requena', 'tapiche'),
(14481551, 'loreto', 'ucayali', 'contamana'),
(14491552, 'loreto', 'ucayali', 'vargas guerra'),
(14501553, 'loreto', 'ucayali', 'padre marquez'),
(14511554, 'loreto', 'ucayali', 'pampa hermoza'),
(14521555, 'loreto', 'ucayali', 'sarayacu'),
(14531556, 'loreto', 'ucayali', 'inahuaya'),
(14541561, 'loreto', 'mariscal ramon castilla', 'mariscal ramon castilla'),
(14551562, 'loreto', 'mariscal ramon castilla', 'pebas'),
(14561563, 'loreto', 'mariscal ramon castilla', 'yavari'),
(14571564, 'loreto', 'mariscal ramon castilla', 'san pablo'),
(14581571, 'loreto', 'datem del marañon', 'barranca'),
(14591572, 'loreto', 'datem del marañon', 'andoas'),
(14601573, 'loreto', 'datem del marañon', 'cahuapanas'),
(14611574, 'loreto', 'datem del marañon', 'manseriche'),
(14621575, 'loreto', 'datem del marañon', 'morona'),
(14631576, 'loreto', 'datem del marañon', 'pastaza'),
(14641611, 'madre de dios', 'tambopata', 'tambopata'),
(14651612, 'madre de dios', 'tambopata', 'inambari'),
(14661613, 'madre de dios', 'tambopata', 'las piedras'),
(14671614, 'madre de dios', 'tambopata', 'laberinto'),
(14681621, 'madre de dios', 'manu', 'manu'),
(14691622, 'madre de dios', 'manu', 'fitzcarrald'),
(14701623, 'madre de dios', 'manu', 'madre de dios'),
(14711624, 'madre de dios', 'manu', 'huepetuhe'),
(14721631, 'madre de dios', 'tahuamanu', 'iñapari'),
(14731632, 'madre de dios', 'tahuamanu', 'iberia'),
(14741633, 'madre de dios', 'tahuamanu', 'tahuamanu'),
(14751711, 'moquegua', 'mariscal nieto', 'moquegua'),
(14761712, 'moquegua', 'mariscal nieto', 'carumas'),
(14771713, 'moquegua', 'mariscal nieto', 'cuchumbaya'),
(14781714, 'moquegua', 'mariscal nieto', 'san cristobal'),
(14791715, 'moquegua', 'mariscal nieto', 'torata'),
(14801716, 'moquegua', 'mariscal nieto', 'samegua'),
(14811721, 'moquegua', 'general sanchez cerro', 'omate'),
(14821722, 'moquegua', 'general sanchez cerro', 'coalaque'),
(14831723, 'moquegua', 'general sanchez cerro', 'chojata'),
(14841724, 'moquegua', 'general sanchez cerro', 'ichuña'),
(14851725, 'moquegua', 'general sanchez cerro', 'la capilla'),
(14861726, 'moquegua', 'general sanchez cerro', 'lloque'),
(14871727, 'moquegua', 'general sanchez cerro', 'matalaque'),
(14881728, 'moquegua', 'general sanchez cerro', 'puquina'),
(14891729, 'moquegua', 'general sanchez cerro', 'quinistaquillas'),
(14921731, 'moquegua', 'ilo', 'ilo'),
(14931732, 'moquegua', 'ilo', 'el algarrobal'),
(14941733, 'moquegua', 'ilo', 'pacocha'),
(14951811, 'pasco', 'pasco', 'chaupimarca'),
(14961813, 'pasco', 'pasco', 'huachon'),
(14971814, 'pasco', 'pasco', 'huariaca'),
(14981815, 'pasco', 'pasco', 'huayllay'),
(14991816, 'pasco', 'pasco', 'ninacaca'),
(15001817, 'pasco', 'pasco', 'pallanchacra'),
(15011818, 'pasco', 'pasco', 'paucartambo'),
(15021819, 'pasco', 'pasco', 'san fco de asis de yarusyacan'),
(15081821, 'pasco', 'daniel alcides carrion', 'yanahuanca'),
(15091822, 'pasco', 'daniel alcides carrion', 'chacayan'),
(15101823, 'pasco', 'daniel alcides carrion', 'goyllarisquizga'),
(15111824, 'pasco', 'daniel alcides carrion', 'paucar'),
(15121825, 'pasco', 'daniel alcides carrion', 'san pedro de pillao'),
(15131826, 'pasco', 'daniel alcides carrion', 'santa ana de tusi'),
(15141827, 'pasco', 'daniel alcides carrion', 'tapuc'),
(15151828, 'pasco', 'daniel alcides carrion', 'vilcabamba'),
(15161831, 'pasco', 'oxapampa', 'oxapampa'),
(15171832, 'pasco', 'oxapampa', 'chontabamba'),
(15181833, 'pasco', 'oxapampa', 'huancabamba'),
(15191834, 'pasco', 'oxapampa', 'puerto bermudez'),
(15201835, 'pasco', 'oxapampa', 'villa rica'),
(15211836, 'pasco', 'oxapampa', 'pozuzo'),
(15221837, 'pasco', 'oxapampa', 'palcazu'),
(15231911, 'piura', 'piura', 'piura'),
(15241913, 'piura', 'piura', 'castilla'),
(15251914, 'piura', 'piura', 'catacaos'),
(15261915, 'piura', 'piura', 'la arena'),
(15271916, 'piura', 'piura', 'la union'),
(15281917, 'piura', 'piura', 'las lomas'),
(15291919, 'piura', 'piura', 'tambo grande'),
(15321921, 'piura', 'ayabaca', 'ayabaca'),
(15331922, 'piura', 'ayabaca', 'frias'),
(15341923, 'piura', 'ayabaca', 'lagunas'),
(15351924, 'piura', 'ayabaca', 'montero'),
(15361925, 'piura', 'ayabaca', 'pacaipampa'),
(15371926, 'piura', 'ayabaca', 'sapillica'),
(15381927, 'piura', 'ayabaca', 'sicchez'),
(15391928, 'piura', 'ayabaca', 'suyo'),
(15401929, 'piura', 'ayabaca', 'jilili'),
(15421931, 'piura', 'huancabamba', 'huancabamba'),
(15431932, 'piura', 'huancabamba', 'canchaque'),
(15441933, 'piura', 'huancabamba', 'huarmaca'),
(15451934, 'piura', 'huancabamba', 'sondor'),
(15461935, 'piura', 'huancabamba', 'sondorillo'),
(15471936, 'piura', 'huancabamba', 'el carmen de la frontera'),
(15481937, 'piura', 'huancabamba', 'san miguel de el faique'),
(15491938, 'piura', 'huancabamba', 'lalaquiz'),
(15501941, 'piura', 'morropon', 'chulucanas'),
(15511942, 'piura', 'morropon', 'buenos aires'),
(15521943, 'piura', 'morropon', 'chalaco'),
(15531944, 'piura', 'morropon', 'morropon'),
(15541945, 'piura', 'morropon', 'salitral'),
(15551946, 'piura', 'morropon', 'santa catalina de mossa'),
(15561947, 'piura', 'morropon', 'santo domingo'),
(15571948, 'piura', 'morropon', 'la matanza'),
(15581949, 'piura', 'morropon', 'yamango'),
(15601951, 'piura', 'paita', 'paita'),
(15611952, 'piura', 'paita', 'amotape'),
(15621953, 'piura', 'paita', 'arenal'),
(15631954, 'piura', 'paita', 'la huaca'),
(15641955, 'piura', 'paita', 'pueblo nuevo de colan'),
(15651956, 'piura', 'paita', 'tamarindo'),
(15661957, 'piura', 'paita', 'vichayal'),
(15671961, 'piura', 'sullana', 'sullana'),
(15681962, 'piura', 'sullana', 'bellavista'),
(15691963, 'piura', 'sullana', 'lancones'),
(15701964, 'piura', 'sullana', 'marcavelica'),
(15711965, 'piura', 'sullana', 'miguel checa'),
(15721966, 'piura', 'sullana', 'querecotillo'),
(15731967, 'piura', 'sullana', 'salitral'),
(15741968, 'piura', 'sullana', 'ignacio escudero'),
(15751971, 'piura', 'talara', 'pariñas'),
(15761972, 'piura', 'talara', 'el alto'),
(15771973, 'piura', 'talara', 'la brea'),
(15781974, 'piura', 'talara', 'lobitos'),
(15791975, 'piura', 'talara', 'mancora'),
(15801976, 'piura', 'talara', 'los organos'),
(15811981, 'piura', 'sechura', 'sechura'),
(15821982, 'piura', 'sechura', 'vice'),
(15831983, 'piura', 'sechura', 'bernal'),
(15841984, 'piura', 'sechura', 'bellavista de la union'),
(15851985, 'piura', 'sechura', 'cristo nos valga'),
(15861986, 'piura', 'sechura', 'rinconada llicuar'),
(15872011, 'puno', 'puno', 'puno'),
(15882012, 'puno', 'puno', 'acora'),
(15892013, 'puno', 'puno', 'atuncolla'),
(15902014, 'puno', 'puno', 'capachica'),
(15912015, 'puno', 'puno', 'coata'),
(15922016, 'puno', 'puno', 'chucuito'),
(15932017, 'puno', 'puno', 'huata'),
(15942018, 'puno', 'puno', 'mañazo'),
(15952019, 'puno', 'puno', 'paucarcolla'),
(16022021, 'puno', 'azangaro', 'azangaro'),
(16032022, 'puno', 'azangaro', 'achaya'),
(16042023, 'puno', 'azangaro', 'arapa'),
(16052024, 'puno', 'azangaro', 'asillo'),
(16062025, 'puno', 'azangaro', 'caminaca'),
(16072026, 'puno', 'azangaro', 'chupa'),
(16082027, 'puno', 'azangaro', 'jose domingo choquehuanca'),
(16092028, 'puno', 'azangaro', 'muñani'),
(16172031, 'puno', 'carabaya', 'macusani'),
(16182032, 'puno', 'carabaya', 'ajoyani'),
(16192033, 'puno', 'carabaya', 'ayapata'),
(16202034, 'puno', 'carabaya', 'coasa'),
(16212035, 'puno', 'carabaya', 'corani'),
(16222036, 'puno', 'carabaya', 'crucero'),
(16232037, 'puno', 'carabaya', 'ituata'),
(16242038, 'puno', 'carabaya', 'ollachea'),
(16252039, 'puno', 'carabaya', 'san gaban'),
(16272041, 'puno', 'chucuito', 'juli'),
(16282042, 'puno', 'chucuito', 'desaguadero'),
(16292043, 'puno', 'chucuito', 'huacullani'),
(16302046, 'puno', 'chucuito', 'pisacoma'),
(16312047, 'puno', 'chucuito', 'pomata'),
(16342051, 'puno', 'huancane', 'huancane'),
(16352052, 'puno', 'huancane', 'cojata'),
(16362054, 'puno', 'huancane', 'inchupalla'),
(16372056, 'puno', 'huancane', 'pusi'),
(16382057, 'puno', 'huancane', 'rosaspata'),
(16392058, 'puno', 'huancane', 'taraco'),
(16402059, 'puno', 'huancane', 'vilque chico'),
(16422061, 'puno', 'lampa', 'lampa'),
(16432062, 'puno', 'lampa', 'cabanilla'),
(16442063, 'puno', 'lampa', 'calapuja'),
(16452064, 'puno', 'lampa', 'nicasio'),
(16462065, 'puno', 'lampa', 'ocuviri'),
(16472066, 'puno', 'lampa', 'palca'),
(16482067, 'puno', 'lampa', 'paratia'),
(16492068, 'puno', 'lampa', 'pucara'),
(16502069, 'puno', 'lampa', 'santa lucia'),
(16522071, 'puno', 'melgar', 'ayaviri'),
(16532072, 'puno', 'melgar', 'antauta'),
(16542073, 'puno', 'melgar', 'cupi'),
(16552074, 'puno', 'melgar', 'llalli'),
(16562075, 'puno', 'melgar', 'macari'),
(16572076, 'puno', 'melgar', 'nuñoa'),
(16582077, 'puno', 'melgar', 'orurillo'),
(16592078, 'puno', 'melgar', 'santa rosa'),
(16602079, 'puno', 'melgar', 'umachiri'),
(16612081, 'puno', 'sandia', 'sandia'),
(16622083, 'puno', 'sandia', 'cuyocuyo'),
(16632084, 'puno', 'sandia', 'limbani'),
(16642085, 'puno', 'sandia', 'phara'),
(16652086, 'puno', 'sandia', 'patambuco'),
(16662087, 'puno', 'sandia', 'quiaca'),
(16672088, 'puno', 'sandia', 'san juan del oro'),
(16712091, 'puno', 'san roman', 'juliaca'),
(16722092, 'puno', 'san roman', 'cabana'),
(16732093, 'puno', 'san roman', 'cabanillas'),
(16742094, 'puno', 'san roman', 'caracoto'),
(16962111, 'san martin', 'moyobamba', 'moyobamba'),
(16972112, 'san martin', 'moyobamba', 'calzada'),
(16982113, 'san martin', 'moyobamba', 'habana'),
(16992114, 'san martin', 'moyobamba', 'jepelacio'),
(17002115, 'san martin', 'moyobamba', 'soritor'),
(17012116, 'san martin', 'moyobamba', 'yantalo'),
(17022121, 'san martin', 'huallaga', 'saposoa'),
(17032122, 'san martin', 'huallaga', 'piscoyacu'),
(17042123, 'san martin', 'huallaga', 'sacanche'),
(17052124, 'san martin', 'huallaga', 'tingo de saposoa'),
(17062125, 'san martin', 'huallaga', 'alto saposoa'),
(17072126, 'san martin', 'huallaga', 'el eslabon'),
(17082131, 'san martin', 'lamas', 'lamas'),
(17092133, 'san martin', 'lamas', 'barranquita'),
(17102134, 'san martin', 'lamas', 'caynarachi'),
(17112135, 'san martin', 'lamas', 'cuñumbuqui'),
(17122136, 'san martin', 'lamas', 'pinto recodo'),
(17132137, 'san martin', 'lamas', 'rumisapa'),
(17192141, 'san martin', 'mariscal caceres', 'juanjui'),
(17202142, 'san martin', 'mariscal caceres', 'campanilla'),
(17212143, 'san martin', 'mariscal caceres', 'huicungo'),
(17222144, 'san martin', 'mariscal caceres', 'pachiza'),
(17232145, 'san martin', 'mariscal caceres', 'pajarillo'),
(17242151, 'san martin', 'rioja', 'rioja'),
(17252152, 'san martin', 'rioja', 'posic'),
(17262153, 'san martin', 'rioja', 'yorongos'),
(17272154, 'san martin', 'rioja', 'yuracyacu'),
(17282155, 'san martin', 'rioja', 'nueva cajamarca'),
(17292156, 'san martin', 'rioja', 'elias soplin'),
(17302157, 'san martin', 'rioja', 'san fernando'),
(17312158, 'san martin', 'rioja', 'pardo miguel'),
(17322159, 'san martin', 'rioja', 'awajun'),
(17332161, 'san martin', 'san martin', 'tarapoto'),
(17342162, 'san martin', 'san martin', 'alberto leveau'),
(17352164, 'san martin', 'san martin', 'cacatachi'),
(17362166, 'san martin', 'san martin', 'chazuta'),
(17372167, 'san martin', 'san martin', 'chipurana'),
(17382168, 'san martin', 'san martin', 'el porvenir'),
(17392169, 'san martin', 'san martin', 'huimbayoc'),
(17472171, 'san martin', 'bellavista', 'bellavista'),
(17482172, 'san martin', 'bellavista', 'san rafael'),
(17492173, 'san martin', 'bellavista', 'san pablo'),
(17502174, 'san martin', 'bellavista', 'alto biavo'),
(17512175, 'san martin', 'bellavista', 'huallaga'),
(17522176, 'san martin', 'bellavista', 'bajo biavo'),
(17532181, 'san martin', 'tocache', 'tocache'),
(17542182, 'san martin', 'tocache', 'nuevo progreso'),
(17552183, 'san martin', 'tocache', 'polvora'),
(17562184, 'san martin', 'tocache', 'shunte'),
(17572185, 'san martin', 'tocache', 'uchiza'),
(17582191, 'san martin', 'picota', 'picota'),
(17592192, 'san martin', 'picota', 'buenos aires'),
(17602193, 'san martin', 'picota', 'caspizapa'),
(17612194, 'san martin', 'picota', 'pilluana'),
(17622195, 'san martin', 'picota', 'pucacaca'),
(17632196, 'san martin', 'picota', 'san cristobal'),
(17642197, 'san martin', 'picota', 'san hilarion'),
(17652198, 'san martin', 'picota', 'tingo de ponasa'),
(17662199, 'san martin', 'picota', 'tres unidos'),
(17732211, 'tacna', 'tacna', 'tacna'),
(17742212, 'tacna', 'tacna', 'calana'),
(17752214, 'tacna', 'tacna', 'inclan'),
(17762217, 'tacna', 'tacna', 'pachia'),
(17772218, 'tacna', 'tacna', 'palca'),
(17782219, 'tacna', 'tacna', 'pocollay'),
(17832221, 'tacna', 'tarata', 'tarata'),
(17842225, 'tacna', 'tarata', 'heroes albarracin'),
(17852226, 'tacna', 'tarata', 'estique'),
(17862227, 'tacna', 'tarata', 'estique pampa'),
(17912231, 'tacna', 'jorge basadre', 'locumba'),
(17922232, 'tacna', 'jorge basadre', 'ite'),
(17932233, 'tacna', 'jorge basadre', 'ilabaya'),
(17942241, 'tacna', 'candarave', 'candarave'),
(17952242, 'tacna', 'candarave', 'cairani'),
(17962243, 'tacna', 'candarave', 'curibaya'),
(17972244, 'tacna', 'candarave', 'huanuara'),
(17982245, 'tacna', 'candarave', 'quilahuani'),
(17992246, 'tacna', 'candarave', 'camilaca'),
(18002311, 'tumbes', 'tumbes', 'tumbes'),
(18012312, 'tumbes', 'tumbes', 'corrales'),
(18022313, 'tumbes', 'tumbes', 'la cruz'),
(18032314, 'tumbes', 'tumbes', 'pampas de hospital'),
(18042315, 'tumbes', 'tumbes', 'san jacinto'),
(18052316, 'tumbes', 'tumbes', 'san juan de la virgen'),
(18062321, 'tumbes', 'contralmirante villar', 'zorritos'),
(18072322, 'tumbes', 'contralmirante villar', 'casitas'),
(18082323, 'tumbes', 'contralmirante villar', 'canoas de punta sal'),
(18092331, 'tumbes', 'zarumilla', 'zarumilla'),
(18102332, 'tumbes', 'zarumilla', 'matapalo'),
(18112333, 'tumbes', 'zarumilla', 'papayal'),
(18121010, 'ancash', 'pallasca', 'santa rosa'),
(18122334, 'tumbes', 'zarumilla', 'aguas verdes'),
(18132411, 'region callao', 'callao', 'callao'),
(18142412, 'region callao', 'callao', 'bellavista'),
(18152413, 'region callao', 'callao', 'la punta'),
(18162414, 'region callao', 'callao', 'carmen de la legua-reynoso'),
(18172415, 'region callao', 'callao', 'la perla'),
(18182416, 'region callao', 'callao', 'ventanilla'),
(18192511, 'ucayali', 'coronel portillo', 'calleria'),
(18202512, 'ucayali', 'coronel portillo', 'yarinacocha'),
(18212513, 'ucayali', 'coronel portillo', 'masisea'),
(18221011, 'ancash', 'pallasca', 'tauca'),
(18222514, 'ucayali', 'coronel portillo', 'campoverde'),
(18232515, 'ucayali', 'coronel portillo', 'iparia'),
(18242516, 'ucayali', 'coronel portillo', 'nueva requena'),
(18252517, 'ucayali', 'coronel portillo', 'manantay'),
(18262521, 'ucayali', 'padre abad', 'padre abad'),
(18272522, 'ucayali', 'padre abad', 'yrazola'),
(18282523, 'ucayali', 'padre abad', 'curimana'),
(18292531, 'ucayali', 'atalaya', 'raimondi'),
(18302532, 'ucayali', 'atalaya', 'tahuania'),
(18312533, 'ucayali', 'atalaya', 'yurua'),
(18322534, 'ucayali', 'atalaya', 'sepahua'),
(18332541, 'ucayali', 'purus', 'purus'),
(19621210, 'ancash', 'recuay', 'catac'),
(21521410, 'ancash', 'sihuas', 'san juan'),
(24922010, 'ancash', 'ocros', 'santiago de chilcas'),
(53851010, 'ayacucho', 'paucar del sara sara', 'sara sara'),
(54851110, 'ayacucho', 'sucre', 'chilcayoc'),
(54951111, 'ayacucho', 'sucre', 'morcolla'),
(65561010, 'cajamarca', 'san miguel', 'union agua blanca'),
(65661011, 'cajamarca', 'san miguel', 'tongod'),
(65761012, 'cajamarca', 'san miguel', 'catilluc'),
(65861013, 'cajamarca', 'san miguel', 'bolivar'),
(77571210, 'cusco', 'quispicanchi', 'ocongate'),
(77671211, 'cusco', 'quispicanchi', 'oropesa'),
(77771212, 'cusco', 'quispicanchi', 'quiquijana'),
(96410110, 'ica', 'ica', 'subtanjalla'),
(96510111, 'ica', 'ica', 'yauca del rosario'),
(96610112, 'ica', 'ica', 'tate'),
(96710113, 'ica', 'ica', 'pachacutec'),
(96810114, 'ica', 'ica', 'ocucaje'),
(97810210, 'ica', 'chincha', 'pueblo nuevo'),
(97910211, 'ica', 'chincha', 'san juan de yanac'),
(100611112, 'junin', 'huancayo', 'chupuro'),
(100711113, 'junin', 'huancayo', 'el tambo'),
(100811114, 'junin', 'huancayo', 'huacrapuquio'),
(100911116, 'junin', 'huancayo', 'hualhuas'),
(101011118, 'junin', 'huancayo', 'huancan'),
(101111119, 'junin', 'huancayo', 'huasicancha'),
(101211120, 'junin', 'huancayo', 'huayucachi'),
(101311121, 'junin', 'huancayo', 'ingenio'),
(101411122, 'junin', 'huancayo', 'pariahuanca'),
(101511123, 'junin', 'huancayo', 'pilcomayo'),
(101611124, 'junin', 'huancayo', 'pucara'),
(101711125, 'junin', 'huancayo', 'quichuay'),
(101811126, 'junin', 'huancayo', 'quilcas'),
(101911127, 'junin', 'huancayo', 'san agustin'),
(102011128, 'junin', 'huancayo', 'san jeronimo de tunan'),
(102111131, 'junin', 'huancayo', 'sto domingo de acobamba'),
(102211132, 'junin', 'huancayo', 'saño'),
(102311133, 'junin', 'huancayo', 'sapallanga'),
(102411134, 'junin', 'huancayo', 'sicaya'),
(102511136, 'junin', 'huancayo', 'viques'),
(103511210, 'junin', 'concepcion', 'matahuasi'),
(103611211, 'junin', 'concepcion', 'mito'),
(103711212, 'junin', 'concepcion', 'nueve de julio'),
(103811213, 'junin', 'concepcion', 'orcotuna'),
(103911214, 'junin', 'concepcion', 'sta rosa de ocopa'),
(104011215, 'junin', 'concepcion', 'san jose de quero'),
(105011310, 'junin', 'jauja', 'janjaillo'),
(105111311, 'junin', 'jauja', 'julcan'),
(105211312, 'junin', 'jauja', 'leonor ordoñez'),
(105311313, 'junin', 'jauja', 'llocllapampa'),
(105411314, 'junin', 'jauja', 'marco'),
(105511315, 'junin', 'jauja', 'masma'),
(105611316, 'junin', 'jauja', 'molinos'),
(105711317, 'junin', 'jauja', 'monobamba'),
(105811318, 'junin', 'jauja', 'muqui'),
(105911319, 'junin', 'jauja', 'muquiyauyo'),
(106011320, 'junin', 'jauja', 'paca'),
(106111321, 'junin', 'jauja', 'paccha'),
(106211322, 'junin', 'jauja', 'pancan'),
(106311323, 'junin', 'jauja', 'parco'),
(106411324, 'junin', 'jauja', 'pomacancha'),
(106511325, 'junin', 'jauja', 'ricran'),
(106611326, 'junin', 'jauja', 'san lorenzo'),
(106711327, 'junin', 'jauja', 'san pedro de chunan'),
(106811328, 'junin', 'jauja', 'sincos'),
(106911329, 'junin', 'jauja', 'tunan marca'),
(107011330, 'junin', 'jauja', 'yauli'),
(107111331, 'junin', 'jauja', 'curicaca'),
(107211332, 'junin', 'jauja', 'masma chicche'),
(107311333, 'junin', 'jauja', 'sausa'),
(107411334, 'junin', 'jauja', 'yauyos'),
(109711610, 'junin', 'yauli', 'sta rosa de sacco'),
(112912110, 'la libertad', 'trujillo', 'el porvenir'),
(113012111, 'la libertad', 'trujillo', 'la esperanza'),
(113112112, 'la libertad', 'trujillo', 'florencia de mora'),
(115312410, 'la libertad', 'otuzco', 'sinsicap'),
(115412411, 'la libertad', 'otuzco', 'usquil'),
(115512413, 'la libertad', 'otuzco', 'mache'),
(117012610, 'la libertad', 'pataz', 'pias'),
(117112611, 'la libertad', 'pataz', 'taurija'),
(117212612, 'la libertad', 'pataz', 'urpay'),
(117312613, 'la libertad', 'pataz', 'santiago de challas'),
(119312101, 'la libertad', 'julcan', 'julcan'),
(119412102, 'la libertad', 'julcan', 'carabamba'),
(119512103, 'la libertad', 'julcan', 'calamarca'),
(119612104, 'la libertad', 'julcan', 'huaso'),
(119712111, 'la libertad', 'gran chimu', 'cascas'),
(119812112, 'la libertad', 'gran chimu', 'lucma'),
(119912113, 'la libertad', 'gran chimu', 'marmot'),
(120012114, 'la libertad', 'gran chimu', 'sayapullo'),
(120112121, 'la libertad', 'viru', 'viru'),
(120212122, 'la libertad', 'viru', 'chao'),
(120312123, 'la libertad', 'viru', 'guadalupito'),
(121313110, 'lambayeque', 'chiclayo', 'pimentel'),
(121413111, 'lambayeque', 'chiclayo', 'reque'),
(121513112, 'lambayeque', 'chiclayo', 'jose leonardo ortiz'),
(121613113, 'lambayeque', 'chiclayo', 'santa rosa'),
(121713114, 'lambayeque', 'chiclayo', 'saña'),
(121813115, 'lambayeque', 'chiclayo', 'la victoria'),
(121913116, 'lambayeque', 'chiclayo', 'cayalti'),
(122013117, 'lambayeque', 'chiclayo', 'patapo'),
(122113118, 'lambayeque', 'chiclayo', 'pomalca'),
(122213119, 'lambayeque', 'chiclayo', 'pucala'),
(122313120, 'lambayeque', 'chiclayo', 'tuman'),
(123913310, 'lambayeque', 'lambayeque', 'salas'),
(124013311, 'lambayeque', 'lambayeque', 'san jose'),
(124113312, 'lambayeque', 'lambayeque', 'tucume'),
(125114110, 'lima', 'lima', 'la molina'),
(125214111, 'lima', 'lima', 'lince'),
(125314112, 'lima', 'lima', 'lurigancho'),
(125414113, 'lima', 'lima', 'lurin'),
(125514114, 'lima', 'lima', 'magdalena del mar'),
(125614115, 'lima', 'lima', 'miraflores'),
(125714116, 'lima', 'lima', 'pachacamac'),
(125814117, 'lima', 'lima', 'pueblo libre'),
(125914118, 'lima', 'lima', 'pucusana'),
(126014119, 'lima', 'lima', 'puente piedra'),
(126114120, 'lima', 'lima', 'punta hermosa'),
(126214121, 'lima', 'lima', 'punta negra'),
(126314122, 'lima', 'lima', 'rimac'),
(126414123, 'lima', 'lima', 'san bartolo'),
(126514124, 'lima', 'lima', 'san isidro'),
(126614125, 'lima', 'lima', 'barranco'),
(126714126, 'lima', 'lima', 'san martin de porres'),
(126814127, 'lima', 'lima', 'san miguel'),
(126914128, 'lima', 'lima', 'sta maria del mar'),
(127014129, 'lima', 'lima', 'santa rosa'),
(127114130, 'lima', 'lima', 'santiago de surco'),
(127214131, 'lima', 'lima', 'surquillo'),
(127314132, 'lima', 'lima', 'villa maria del triunfo'),
(127414133, 'lima', 'lima', 'jesus maria'),
(127514134, 'lima', 'lima', 'independencia'),
(127614135, 'lima', 'lima', 'el agustino'),
(127714136, 'lima', 'lima', 'san juan de miraflores'),
(127814137, 'lima', 'lima', 'san juan de lurigancho'),
(127914138, 'lima', 'lima', 'san luis'),
(128014139, 'lima', 'lima', 'cieneguilla'),
(128114140, 'lima', 'lima', 'san borja'),
(128214141, 'lima', 'lima', 'villa el salvador'),
(128314142, 'lima', 'lima', 'los olivos'),
(128414143, 'lima', 'lima', 'santa anita'),
(130614410, 'lima', 'cañete', 'pacaran'),
(130714411, 'lima', 'cañete', 'quilmana'),
(130814412, 'lima', 'cañete', 'san antonio'),
(130914413, 'lima', 'cañete', 'san luis'),
(131014414, 'lima', 'cañete', 'santa cruz de flores'),
(131114415, 'lima', 'cañete', 'zuñiga'),
(131214416, 'lima', 'cañete', 'asia'),
(132114511, 'lima', 'huaura', 'santa leonor'),
(132214512, 'lima', 'huaura', 'santa maria'),
(132314513, 'lima', 'huaura', 'sayan'),
(132414516, 'lima', 'huaura', 'vegueta'),
(133414610, 'lima', 'huarochiri', 'lahuaytambo'),
(133514611, 'lima', 'huarochiri', 'langa'),
(133614612, 'lima', 'huarochiri', 'mariatana'),
(133714613, 'lima', 'huarochiri', 'ricardo palma'),
(133814614, 'lima', 'huarochiri', 'san andres de tupicocha'),
(133914615, 'lima', 'huarochiri', 'san antonio'),
(134014616, 'lima', 'huarochiri', 'san bartolome'),
(134114617, 'lima', 'huarochiri', 'san damian'),
(134214618, 'lima', 'huarochiri', 'sangallaya'),
(134314619, 'lima', 'huarochiri', 'san juan de tantaranche'),
(134414620, 'lima', 'huarochiri', 'san lorenzo de quinti'),
(134514621, 'lima', 'huarochiri', 'san mateo'),
(134614622, 'lima', 'huarochiri', 'san mateo de otao'),
(134714623, 'lima', 'huarochiri', 'san pedro de huancayre'),
(134814624, 'lima', 'huarochiri', 'santa cruz de cocachacra'),
(134914625, 'lima', 'huarochiri', 'santa eulalia'),
(135014626, 'lima', 'huarochiri', 'santiago de anchucaya'),
(135114627, 'lima', 'huarochiri', 'santiago de tuna'),
(135214628, 'lima', 'huarochiri', 'santo domingo de los olleros'),
(135314629, 'lima', 'huarochiri', 'surco'),
(135414630, 'lima', 'huarochiri', 'huachupampa'),
(135514631, 'lima', 'huarochiri', 'laraos'),
(135614632, 'lima', 'huarochiri', 'san juan de iris'),
(136614710, 'lima', 'yauyos', 'chocos'),
(136714711, 'lima', 'yauyos', 'huampara'),
(136814712, 'lima', 'yauyos', 'huancaya'),
(136914713, 'lima', 'yauyos', 'huangascar'),
(137014714, 'lima', 'yauyos', 'huantan'),
(137114715, 'lima', 'yauyos', 'huañec'),
(137214716, 'lima', 'yauyos', 'laraos'),
(137314717, 'lima', 'yauyos', 'lincha'),
(137414718, 'lima', 'yauyos', 'miraflores'),
(137514719, 'lima', 'yauyos', 'omas'),
(137614720, 'lima', 'yauyos', 'quinches'),
(137714721, 'lima', 'yauyos', 'quinocay'),
(137814722, 'lima', 'yauyos', 'san joaquin'),
(137914723, 'lima', 'yauyos', 'san pedro de pilas'),
(138014724, 'lima', 'yauyos', 'tanta'),
(138114725, 'lima', 'yauyos', 'tauripampa'),
(138214726, 'lima', 'yauyos', 'tupe'),
(138314727, 'lima', 'yauyos', 'tomas'),
(138414728, 'lima', 'yauyos', 'viñac'),
(138514729, 'lima', 'yauyos', 'vitis'),
(138614730, 'lima', 'yauyos', 'hongos'),
(138714731, 'lima', 'yauyos', 'madean'),
(138814732, 'lima', 'yauyos', 'putinza'),
(138914733, 'lima', 'yauyos', 'catahuasi'),
(139914810, 'lima', 'huaral', 'veintisiete de noviembre'),
(140014811, 'lima', 'huaral', 'sta cruz de andamarca'),
(140114812, 'lima', 'huaral', 'sumbilca'),
(140714101, 'lima', 'oyon', 'oyon'),
(140814102, 'lima', 'oyon', 'navan'),
(140914103, 'lima', 'oyon', 'caujul'),
(141014104, 'lima', 'oyon', 'andajes'),
(141114105, 'lima', 'oyon', 'pachangara'),
(141214106, 'lima', 'oyon', 'cochamarca'),
(142115110, 'loreto', 'maynas', 'indiana'),
(142215111, 'loreto', 'maynas', 'punchana'),
(142315112, 'loreto', 'maynas', 'belen'),
(142415113, 'loreto', 'maynas', 'san juan bautista'),
(142515114, 'loreto', 'maynas', 'tnte manuel clavero'),
(143015210, 'loreto', 'alto amazonas', 'santa cruz'),
(143115211, 'loreto', 'alto amazonas', 'tnte cesar lopez rojas'),
(144615410, 'loreto', 'requena', 'jenaro herrera'),
(144715411, 'loreto', 'requena', 'yaquerana'),
(149017210, 'moquegua', 'general sanchez cerro', 'ubinas'),
(149117211, 'moquegua', 'general sanchez cerro', 'yunga'),
(150318110, 'pasco', 'pasco', 'simon bolivar'),
(150418111, 'pasco', 'pasco', 'ticlacayan'),
(150518112, 'pasco', 'pasco', 'tinyahuarco'),
(150618113, 'pasco', 'pasco', 'vicco'),
(150718114, 'pasco', 'pasco', 'yanacancha'),
(153019113, 'piura', 'piura', 'cura mori'),
(153119114, 'piura', 'piura', 'el tallan'),
(154119210, 'piura', 'ayabaca', 'paimas'),
(155919410, 'piura', 'morropon', 'san juan de bigote'),
(159620110, 'puno', 'puno', 'pichacani'),
(159720111, 'puno', 'puno', 'san antonio'),
(159820112, 'puno', 'puno', 'tiquillaca'),
(159920113, 'puno', 'puno', 'vilque'),
(160020114, 'puno', 'puno', 'plateria'),
(160120115, 'puno', 'puno', 'amantani'),
(161020210, 'puno', 'azangaro', 'potoni'),
(161120212, 'puno', 'azangaro', 'saman'),
(161220213, 'puno', 'azangaro', 'san anton'),
(161320214, 'puno', 'azangaro', 'san jose'),
(161420215, 'puno', 'azangaro', 'san juan de salinas'),
(161520216, 'puno', 'azangaro', 'stgo de pupuja'),
(161620217, 'puno', 'azangaro', 'tirapata'),
(162620310, 'puno', 'carabaya', 'usicayos'),
(163220410, 'puno', 'chucuito', 'zepita'),
(163320412, 'puno', 'chucuito', 'kelluyo'),
(164120511, 'puno', 'huancane', 'huatasani'),
(165120610, 'puno', 'lampa', 'vilavila'),
(166820810, 'puno', 'sandia', 'yanahuaya'),
(166920811, 'puno', 'sandia', 'alto inambari'),
(167020812, 'puno', 'sandia', 'san pedro de putina punco'),
(167520101, 'puno', 'yunguyo', 'yunguyo'),
(167620102, 'puno', 'yunguyo', 'unicachi'),
(167720103, 'puno', 'yunguyo', 'anapia'),
(167820104, 'puno', 'yunguyo', 'copani'),
(167920105, 'puno', 'yunguyo', 'cuturapi'),
(168020106, 'puno', 'yunguyo', 'ollaraya'),
(168120107, 'puno', 'yunguyo', 'tinicachi'),
(168220111, 'puno', 'san antonio de putina', 'putina'),
(168320112, 'puno', 'san antonio de putina', 'pedro vilca apaza'),
(168420113, 'puno', 'san antonio de putina', 'quilca puncu'),
(168520114, 'puno', 'san antonio de putina', 'ananea'),
(168620115, 'puno', 'san antonio de putina', 'sina'),
(168720121, 'puno', 'el collao', 'ilave'),
(168820122, 'puno', 'el collao', 'pilcuyo'),
(168920123, 'puno', 'el collao', 'santa rosa'),
(169020124, 'puno', 'el collao', 'capaso'),
(169120125, 'puno', 'el collao', 'conduriri'),
(169220131, 'puno', 'moho', 'moho'),
(169320132, 'puno', 'moho', 'conima'),
(169420133, 'puno', 'moho', 'tilali'),
(169520134, 'puno', 'moho', 'huayrapata'),
(171421311, 'san martin', 'lamas', 'shanao'),
(171521313, 'san martin', 'lamas', 'tabalosos'),
(171621314, 'san martin', 'lamas', 'zapatero'),
(171721315, 'san martin', 'lamas', 'alonso de alvarado'),
(171821316, 'san martin', 'lamas', 'san roque de cumbaza'),
(174021610, 'san martin', 'san martin', 'juan guerra'),
(174121611, 'san martin', 'san martin', 'morales'),
(174221612, 'san martin', 'san martin', 'papaplaya'),
(174321616, 'san martin', 'san martin', 'san antonio'),
(174421619, 'san martin', 'san martin', 'sauce'),
(174521620, 'san martin', 'san martin', 'shapaja'),
(174621621, 'san martin', 'san martin', 'la banda de shilcayo'),
(176721910, 'san martin', 'picota', 'shamboyacu'),
(176821101, 'san martin', 'el dorado', 'san jose de sisa'),
(176921102, 'san martin', 'el dorado', 'agua blanca'),
(177021103, 'san martin', 'el dorado', 'shatoja'),
(177121104, 'san martin', 'el dorado', 'san martin'),
(177221105, 'san martin', 'el dorado', 'santa rosa'),
(177922110, 'tacna', 'tacna', 'sama'),
(178022111, 'tacna', 'tacna', 'alto de la alianza'),
(178122112, 'tacna', 'tacna', 'ciudad nueva'),
(178222113, 'tacna', 'tacna', 'coronel gregorio albarracin l.'),
(178722210, 'tacna', 'tarata', 'sitajara'),
(178822211, 'tacna', 'tarata', 'susapaya'),
(178922212, 'tacna', 'tarata', 'tarucachi'),
(179022213, 'tacna', 'tarata', 'ticaco');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Usuario`
--

CREATE TABLE IF NOT EXISTS `Usuario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(45) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `persona_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `estado` tinyint(1) DEFAULT NULL COMMENT '0 --> des-habilitado\n1 --> habilitado.\n',
  PRIMARY KEY (`id`),
  KEY `fk_Usuario_Persona1_idx` (`persona_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Volcado de datos para la tabla `Usuario`
--

INSERT INTO `Usuario` (`id`, `login`, `password`, `persona_id`, `created_at`, `updated_at`, `estado`) VALUES
(4, 'icalvay', '$2y$10$y8ng/1nXoYAlm8U6N2TGv.swUuLtGZphLD5rjtQCpT1eREZRSCBIq', 2, '2014-03-01 21:04:30', '2014-03-01 21:04:30', 1),
(5, 'lvalencia', '$2y$10$kvsU3AFMCtlhl4DBFwA.Su7sIx5je/Z6HM.H.AD/ulikI9wuaKs.W', 4, '2014-03-05 00:58:05', '2014-03-05 00:58:05', 1);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `Combinacion`
--
ALTER TABLE `Combinacion`
  ADD CONSTRAINT `fk_Combinacion_TipoComb1` FOREIGN KEY (`TipoComb_id`) REFERENCES `TipoComb` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `DetalleIngresoInsumo`
--
ALTER TABLE `DetalleIngresoInsumo`
  ADD CONSTRAINT `fk_DetalleIngresoInsumo_Ingreso1` FOREIGN KEY (`ingreso_id`) REFERENCES `PedidoCompra` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_DetalleIngresoInsumo_Insumo1` FOREIGN KEY (`insumo_id`) REFERENCES `Insumo` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `detalleNotas`
--
ALTER TABLE `detalleNotas`
  ADD CONSTRAINT `fk_detalleNotas_detallePedido1` FOREIGN KEY (`detallePedido_id`) REFERENCES `detallePedido` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_detalleNotas_Notas1` FOREIGN KEY (`notas_id`) REFERENCES `Notas` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `detallePedido`
--
ALTER TABLE `detallePedido`
  ADD CONSTRAINT `fk_detallePedido_Pedido1` FOREIGN KEY (`pedido_id`) REFERENCES `Pedido` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_detallePedido_Producto1` FOREIGN KEY (`producto_id`) REFERENCES `Producto` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `detInfNutr`
--
ALTER TABLE `detInfNutr`
  ADD CONSTRAINT `fk_detInfNutr_InfNut1` FOREIGN KEY (`infNut_id`) REFERENCES `InfNut` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_detInfNutr_Producto1` FOREIGN KEY (`producto_id`) REFERENCES `Producto` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `detMesa`
--
ALTER TABLE `detMesa`
  ADD CONSTRAINT `fk_detMesa_Mesa1` FOREIGN KEY (`Mesa_idMesa`) REFERENCES `Mesa` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_detMesa_Pedido1` FOREIGN KEY (`Pedido_idPedido`) REFERENCES `Pedido` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `detProd`
--
ALTER TABLE `detProd`
  ADD CONSTRAINT `fk_detProd_Producto1` FOREIGN KEY (`parent_id`) REFERENCES `Producto` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_detProd_Producto2` FOREIGN KEY (`child_id`) REFERENCES `Producto` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `Insumo`
--
ALTER TABLE `Insumo`
  ADD CONSTRAINT `fk_Insumo_tipoins1` FOREIGN KEY (`tipoins_id`) REFERENCES `tipoins` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `Mesa`
--
ALTER TABLE `Mesa`
  ADD CONSTRAINT `fk_Mesa_Salon1` FOREIGN KEY (`salon_id`) REFERENCES `Salon` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `Notas`
--
ALTER TABLE `Notas`
  ADD CONSTRAINT `fk_Notas_CategoriaNotas1` FOREIGN KEY (`catNot_id`) REFERENCES `CatNotas` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `Pedido`
--
ALTER TABLE `Pedido`
  ADD CONSTRAINT `fk_Pedido_Persona1` FOREIGN KEY (`usuario_id`) REFERENCES `Persona` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Pedido_Persona2` FOREIGN KEY (`cliente_id`) REFERENCES `Persona` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `PedidoCompra`
--
ALTER TABLE `PedidoCompra`
  ADD CONSTRAINT `fk_Ingreso_Persona1` FOREIGN KEY (`proveedor_id`) REFERENCES `Persona` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Ingreso_Persona2` FOREIGN KEY (`usuario_id`) REFERENCES `Persona` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `Permisos`
--
ALTER TABLE `Permisos`
  ADD CONSTRAINT `fk_id_modulo` FOREIGN KEY (`id_modulo`) REFERENCES `Modulos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_id_perfil` FOREIGN KEY (`id_perfil`) REFERENCES `Perfil` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `Persona`
--
ALTER TABLE `Persona`
  ADD CONSTRAINT `fk_Persona_restaurante` FOREIGN KEY (`id_restaurante`) REFERENCES `restaurante` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Persona_Perfil1` FOREIGN KEY (`perfil_id`) REFERENCES `Perfil` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `Precio`
--
ALTER TABLE `Precio`
  ADD CONSTRAINT `fk_Precio_Combinacion1` FOREIGN KEY (`combinacion_id`) REFERENCES `Combinacion` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Precio_Producto1` FOREIGN KEY (`producto_id`) REFERENCES `Producto` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `Producto`
--
ALTER TABLE `Producto`
  ADD CONSTRAINT `fk_Producto_1` FOREIGN KEY (`id_tipoarepro`) REFERENCES `TipoAreadeProduccion` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_Producto_Familia1` FOREIGN KEY (`familia_id`) REFERENCES `Familia` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `Receta`
--
ALTER TABLE `Receta`
  ADD CONSTRAINT `fk_detProducto_Insumo1` FOREIGN KEY (`insumo_id`) REFERENCES `Insumo` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_detProducto_Producto1` FOREIGN KEY (`producto_id`) REFERENCES `Producto` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `Salon`
--
ALTER TABLE `Salon`
  ADD CONSTRAINT `fk_Salon_Restaurante1` FOREIGN KEY (`restaurante_id`) REFERENCES `restaurante` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `Usuario`
--
ALTER TABLE `Usuario`
  ADD CONSTRAINT `fk_Usuario_Persona1` FOREIGN KEY (`persona_id`) REFERENCES `Persona` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;