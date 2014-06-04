CREATE DATABASE  IF NOT EXISTS `db_4rest` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `db_4rest`;
-- MySQL dump 10.13  Distrib 5.6.13, for linux-glibc2.5 (x86_64)
--
-- Host: 127.0.0.1    Database: db_4rest
-- ------------------------------------------------------
-- Server version	5.5.35-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `Caja`
--

DROP TABLE IF EXISTS `Caja`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Caja` (
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Caja`
--

LOCK TABLES `Caja` WRITE;
/*!40000 ALTER TABLE `Caja` DISABLE KEYS */;
/*!40000 ALTER TABLE `Caja` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `CatNotas`
--

DROP TABLE IF EXISTS `CatNotas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `CatNotas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) DEFAULT NULL,
  `descripcion` text,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `CatNotas`
--

LOCK TABLES `CatNotas` WRITE;
/*!40000 ALTER TABLE `CatNotas` DISABLE KEYS */;
/*!40000 ALTER TABLE `CatNotas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Combinacion`
--

DROP TABLE IF EXISTS `Combinacion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Combinacion` (
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
  KEY `fk_Combinacion_TipoComb1_idx` (`TipoComb_id`),
  CONSTRAINT `fk_Combinacion_TipoComb1` FOREIGN KEY (`TipoComb_id`) REFERENCES `TipoComb` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Combinacion`
--

LOCK TABLES `Combinacion` WRITE;
/*!40000 ALTER TABLE `Combinacion` DISABLE KEYS */;
/*!40000 ALTER TABLE `Combinacion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `DetalleIngresoInsumo`
--

DROP TABLE IF EXISTS `DetalleIngresoInsumo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `DetalleIngresoInsumo` (
  `ingreso_id` int(11) NOT NULL,
  `insumo_id` int(11) NOT NULL,
  `cantidad` decimal(10,2) DEFAULT NULL,
  `costo` decimal(10,2) DEFAULT NULL COMMENT 'costo del insumo en ese instante\n',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`ingreso_id`,`insumo_id`),
  KEY `fk_DetalleIngresoInsumo_Ingreso1_idx` (`ingreso_id`),
  KEY `fk_DetalleIngresoInsumo_Insumo1_idx` (`insumo_id`),
  CONSTRAINT `fk_DetalleIngresoInsumo_Ingreso1` FOREIGN KEY (`ingreso_id`) REFERENCES `PedidoCompra` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_DetalleIngresoInsumo_Insumo1` FOREIGN KEY (`insumo_id`) REFERENCES `Insumo` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `DetalleIngresoInsumo`
--

LOCK TABLES `DetalleIngresoInsumo` WRITE;
/*!40000 ALTER TABLE `DetalleIngresoInsumo` DISABLE KEYS */;
/*!40000 ALTER TABLE `DetalleIngresoInsumo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Familia`
--

DROP TABLE IF EXISTS `Familia`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Familia` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) DEFAULT NULL,
  `descripcion` text,
  `imagen` text COMMENT '''ruta''',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Familia`
--

LOCK TABLES `Familia` WRITE;
/*!40000 ALTER TABLE `Familia` DISABLE KEYS */;
INSERT INTO `Familia` VALUES (1,'Familia1','familia1',NULL,'2014-02-20 01:34:53','2014-02-20 01:34:53'),(2,'','',NULL,'2014-02-20 02:19:03','2014-02-20 02:19:03'),(3,'3','3','0','2014-02-20 02:22:44','2014-02-20 02:22:44'),(4,'4','4','4_IMG_0426.jpg','2014-02-20 02:25:46','2014-02-20 02:25:46');
/*!40000 ALTER TABLE `Familia` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `InfNut`
--

DROP TABLE IF EXISTS `InfNut`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `InfNut` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) DEFAULT NULL,
  `descripcion` text,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `InfNut`
--

LOCK TABLES `InfNut` WRITE;
/*!40000 ALTER TABLE `InfNut` DISABLE KEYS */;
/*!40000 ALTER TABLE `InfNut` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Insumo`
--

DROP TABLE IF EXISTS `Insumo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Insumo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(300) DEFAULT NULL,
  `descripcion` text,
  `stock` decimal(10,2) DEFAULT NULL,
  `stockMin` decimal(10,2) DEFAULT NULL,
  `stockMax` decimal(10,2) DEFAULT NULL,
  `unidadMedida` varchar(45) DEFAULT NULL COMMENT '''unidades, litros kilos''',
  `costo` decimal(10,2) DEFAULT NULL COMMENT 'costo del insumo promedio.',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `tipoins_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_Insumo_tipoins1_idx` (`tipoins_id`),
  CONSTRAINT `fk_Insumo_tipoins1` FOREIGN KEY (`tipoins_id`) REFERENCES `tipoins` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Insumo`
--

LOCK TABLES `Insumo` WRITE;
/*!40000 ALTER TABLE `Insumo` DISABLE KEYS */;
INSERT INTO `Insumo` VALUES (1,'234','234',43.00,NULL,NULL,'Litros',43.00,'2014-02-19 23:35:36','2014-02-19 23:35:36',NULL),(2,'insumo1','asdasd',10.00,NULL,NULL,'Unidades',10.00,'2014-02-20 02:38:22','2014-02-20 02:38:22',NULL),(3,'insumo2','asdasd',70.00,NULL,NULL,'Kilogramos',10.00,'2014-02-20 02:38:38','2014-02-20 02:38:38',NULL),(4,'muzarrrella','asdasdas',40.00,NULL,NULL,'Unidades',10.00,'2014-02-20 02:38:54','2014-02-20 02:38:54',NULL),(5,'rrwerwer','werwerwer',23.00,NULL,NULL,'Litros',23.00,'2014-02-19 22:09:21','2014-02-19 22:09:21',NULL);
/*!40000 ALTER TABLE `Insumo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Mesa`
--

DROP TABLE IF EXISTS `Mesa`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Mesa` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) DEFAULT NULL,
  `descripcion` text,
  `salon_id` int(11) NOT NULL,
  `estado` tinyint(1) DEFAULT NULL COMMENT '0 --> deshabilitado\n1 --> habilitado.',
  `habilitado` tinyint(1) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_Mesa_Salon1_idx` (`salon_id`),
  CONSTRAINT `fk_Mesa_Salon1` FOREIGN KEY (`salon_id`) REFERENCES `Salon` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Mesa`
--

LOCK TABLES `Mesa` WRITE;
/*!40000 ALTER TABLE `Mesa` DISABLE KEYS */;
/*!40000 ALTER TABLE `Mesa` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Notas`
--

DROP TABLE IF EXISTS `Notas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Notas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) DEFAULT NULL,
  `descripcion` text,
  `catNot_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_Notas_CategoriaNotas1_idx` (`catNot_id`),
  CONSTRAINT `fk_Notas_CategoriaNotas1` FOREIGN KEY (`catNot_id`) REFERENCES `CatNotas` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Notas`
--

LOCK TABLES `Notas` WRITE;
/*!40000 ALTER TABLE `Notas` DISABLE KEYS */;
/*!40000 ALTER TABLE `Notas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Pedido`
--

DROP TABLE IF EXISTS `Pedido`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Pedido` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fechaInicio` timestamp NULL DEFAULT NULL,
  `fechaCancelacion` timestamp NULL DEFAULT NULL,
  `estado` char(1) DEFAULT NULL,
  `importeFinal` decimal(10,2) DEFAULT NULL COMMENT 'el total de cuento se pago con todo y descuento incluido.',
  `descuento` double DEFAULT NULL COMMENT 'es en porcentaje.. 0 a 1.. Si se sabe cuanto bajarle.. se pondrá el monto y se calculará el % q refleja.\n\nEste descuento es aplicado al importe total de venta.',
  `usuario_id` int(11) DEFAULT NULL COMMENT 'id de persona mozo x ejemplo\n',
  `cliente_id` int(11) DEFAULT NULL COMMENT 'id de cliente',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_Pedido_Persona1_idx` (`usuario_id`),
  KEY `fk_Pedido_Persona2_idx` (`cliente_id`),
  CONSTRAINT `fk_Pedido_Persona1` FOREIGN KEY (`usuario_id`) REFERENCES `Persona` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_Pedido_Persona2` FOREIGN KEY (`cliente_id`) REFERENCES `Persona` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Pedido`
--

LOCK TABLES `Pedido` WRITE;
/*!40000 ALTER TABLE `Pedido` DISABLE KEYS */;
/*!40000 ALTER TABLE `Pedido` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `PedidoCompra`
--

DROP TABLE IF EXISTS `PedidoCompra`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `PedidoCompra` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'si se compra un producto final se va al insumo tb\nsi se compra un insumo se queda ahi',
  `fecha` timestamp NULL DEFAULT NULL,
  `proveedor_id` int(11) DEFAULT NULL COMMENT 'de tal proveedor',
  `importeFinal` decimal(10,2) DEFAULT NULL,
  `usuario_id` int(11) NOT NULL COMMENT 'creado por tal usuario',
  `estado` tinyint(1) DEFAULT NULL COMMENT '0 --> anulado\n1 --> habilitado',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_Ingreso_Persona1_idx` (`proveedor_id`),
  KEY `fk_Ingreso_Persona2_idx` (`usuario_id`),
  CONSTRAINT `fk_Ingreso_Persona1` FOREIGN KEY (`proveedor_id`) REFERENCES `Persona` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_Ingreso_Persona2` FOREIGN KEY (`usuario_id`) REFERENCES `Persona` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `PedidoCompra`
--

LOCK TABLES `PedidoCompra` WRITE;
/*!40000 ALTER TABLE `PedidoCompra` DISABLE KEYS */;
/*!40000 ALTER TABLE `PedidoCompra` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Perfil`
--

DROP TABLE IF EXISTS `Perfil`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Perfil` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) DEFAULT NULL,
  `descripcion` text,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Perfil`
--

LOCK TABLES `Perfil` WRITE;
/*!40000 ALTER TABLE `Perfil` DISABLE KEYS */;
/*!40000 ALTER TABLE `Perfil` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Persona`
--

DROP TABLE IF EXISTS `Persona`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Persona` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombres` varchar(100) DEFAULT NULL,
  `razonSocial` varchar(100) DEFAULT NULL,
  `apPaterno` varchar(100) DEFAULT NULL,
  `apMaterno` varchar(100) DEFAULT NULL,
  `dni` varchar(8) DEFAULT NULL,
  `ruc` varchar(11) DEFAULT NULL,
  `direccion` varchar(200) DEFAULT NULL,
  `pais` varchar(50) DEFAULT NULL,
  `provincia` varchar(50) DEFAULT NULL,
  `distrito` varchar(50) DEFAULT NULL,
  `tel` varchar(100) DEFAULT NULL,
  `cel` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `habilitado` tinyint(1) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `perfil_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_Persona_Perfil1_idx` (`perfil_id`),
  CONSTRAINT `fk_Persona_Perfil1` FOREIGN KEY (`perfil_id`) REFERENCES `Perfil` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Persona`
--

LOCK TABLES `Persona` WRITE;
/*!40000 ALTER TABLE `Persona` DISABLE KEYS */;
/*!40000 ALTER TABLE `Persona` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Precio`
--

DROP TABLE IF EXISTS `Precio`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Precio` (
  `producto_id` int(11) NOT NULL,
  `combinacion_id` int(11) NOT NULL,
  `precio` decimal(10,2) DEFAULT NULL,
  `seleccionador` int(11) DEFAULT NULL COMMENT '11,22,33,44... solo se selecciona 4 prod d los 8 disp',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`producto_id`,`combinacion_id`),
  KEY `fk_Precio_Combinacion1_idx` (`combinacion_id`),
  CONSTRAINT `fk_Precio_Producto1` FOREIGN KEY (`producto_id`) REFERENCES `Producto` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_Precio_Combinacion1` FOREIGN KEY (`combinacion_id`) REFERENCES `Combinacion` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Precio`
--

LOCK TABLES `Precio` WRITE;
/*!40000 ALTER TABLE `Precio` DISABLE KEYS */;
/*!40000 ALTER TABLE `Precio` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Producto`
--

DROP TABLE IF EXISTS `Producto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Producto` (
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
  `selector_eleccion` int(11) DEFAULT NULL COMMENT 'helado doble.. selector_eleccion-->2',
  PRIMARY KEY (`id`),
  KEY `fk_Producto_Familia1_idx` (`familia_id`),
  CONSTRAINT `fk_Producto_Familia1` FOREIGN KEY (`familia_id`) REFERENCES `Familia` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Producto`
--

LOCK TABLES `Producto` WRITE;
/*!40000 ALTER TABLE `Producto` DISABLE KEYS */;
INSERT INTO `Producto` VALUES (1,'muzarelon',NULL,'muzarelon nn',NULL,NULL,'Kilogramos',NULL,20.00,NULL,NULL,'2014-02-20 03:05:06','2014-02-20 03:05:06',NULL,NULL,NULL);
/*!40000 ALTER TABLE `Producto` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Receta`
--

DROP TABLE IF EXISTS `Receta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Receta` (
  `producto_id` int(11) NOT NULL,
  `insumo_id` int(11) NOT NULL,
  `cantidad` decimal(10,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`producto_id`,`insumo_id`),
  KEY `fk_detProducto_Insumo1_idx` (`insumo_id`),
  CONSTRAINT `fk_detProducto_Producto1` FOREIGN KEY (`producto_id`) REFERENCES `Producto` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_detProducto_Insumo1` FOREIGN KEY (`insumo_id`) REFERENCES `Insumo` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Receta`
--

LOCK TABLES `Receta` WRITE;
/*!40000 ALTER TABLE `Receta` DISABLE KEYS */;
INSERT INTO `Receta` VALUES (1,4,20.00,'2014-02-20 03:05:06','2014-02-20 03:05:06');
/*!40000 ALTER TABLE `Receta` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Restaurante`
--

DROP TABLE IF EXISTS `Restaurante`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Restaurante` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) DEFAULT NULL,
  `descripcion` text,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Restaurante`
--

LOCK TABLES `Restaurante` WRITE;
/*!40000 ALTER TABLE `Restaurante` DISABLE KEYS */;
/*!40000 ALTER TABLE `Restaurante` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Salon`
--

DROP TABLE IF EXISTS `Salon`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Salon` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) DEFAULT NULL,
  `descripcion` text,
  `restaurante_id` int(11) NOT NULL,
  `habilitado` tinyint(1) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_Salon_Restaurante1_idx` (`restaurante_id`),
  CONSTRAINT `fk_Salon_Restaurante1` FOREIGN KEY (`restaurante_id`) REFERENCES `Restaurante` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Salon`
--

LOCK TABLES `Salon` WRITE;
/*!40000 ALTER TABLE `Salon` DISABLE KEYS */;
/*!40000 ALTER TABLE `Salon` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `TipoComb`
--

DROP TABLE IF EXISTS `TipoComb`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `TipoComb` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `descripcion` text,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL COMMENT 'Para cubrir los distintos Menúes diarios de Kango',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `TipoComb`
--

LOCK TABLES `TipoComb` WRITE;
/*!40000 ALTER TABLE `TipoComb` DISABLE KEYS */;
/*!40000 ALTER TABLE `TipoComb` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Usuario`
--

DROP TABLE IF EXISTS `Usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Usuario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(45) DEFAULT NULL,
  `password` varchar(45) DEFAULT NULL,
  `persona_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `estado` tinyint(1) DEFAULT NULL COMMENT '0 --> des-habilitado\n1 --> habilitado.\n',
  PRIMARY KEY (`id`),
  KEY `fk_Usuario_Persona1_idx` (`persona_id`),
  CONSTRAINT `fk_Usuario_Persona1` FOREIGN KEY (`persona_id`) REFERENCES `Persona` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Usuario`
--

LOCK TABLES `Usuario` WRITE;
/*!40000 ALTER TABLE `Usuario` DISABLE KEYS */;
/*!40000 ALTER TABLE `Usuario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `detInfNutr`
--

DROP TABLE IF EXISTS `detInfNutr`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `detInfNutr` (
  `infNut_id` int(11) NOT NULL,
  `producto_id` int(11) NOT NULL,
  `cantidad` decimal(10,4) DEFAULT NULL,
  `UnidadMedida` varchar(45) DEFAULT NULL COMMENT 'litros kilos unidades',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`infNut_id`,`producto_id`),
  KEY `fk_detInfNutr_Producto1_idx` (`producto_id`),
  CONSTRAINT `fk_detInfNutr_InfNut1` FOREIGN KEY (`infNut_id`) REFERENCES `InfNut` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_detInfNutr_Producto1` FOREIGN KEY (`producto_id`) REFERENCES `Producto` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `detInfNutr`
--

LOCK TABLES `detInfNutr` WRITE;
/*!40000 ALTER TABLE `detInfNutr` DISABLE KEYS */;
/*!40000 ALTER TABLE `detInfNutr` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `detMesa`
--

DROP TABLE IF EXISTS `detMesa`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `detMesa` (
  `Pedido_idPedido` int(11) NOT NULL,
  `Mesa_idMesa` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`Pedido_idPedido`,`Mesa_idMesa`),
  KEY `fk_detMesa_Mesa1_idx` (`Mesa_idMesa`),
  CONSTRAINT `fk_detMesa_Pedido1` FOREIGN KEY (`Pedido_idPedido`) REFERENCES `Pedido` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_detMesa_Mesa1` FOREIGN KEY (`Mesa_idMesa`) REFERENCES `Mesa` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `detMesa`
--

LOCK TABLES `detMesa` WRITE;
/*!40000 ALTER TABLE `detMesa` DISABLE KEYS */;
/*!40000 ALTER TABLE `detMesa` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `detProd`
--

DROP TABLE IF EXISTS `detProd`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `detProd` (
  `parent_id` int(11) NOT NULL,
  `child_id` int(11) NOT NULL,
  `cantidad` decimal(10,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`parent_id`,`child_id`),
  KEY `fk_detProd_Producto2_idx` (`child_id`),
  CONSTRAINT `fk_detProd_Producto1` FOREIGN KEY (`parent_id`) REFERENCES `Producto` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_detProd_Producto2` FOREIGN KEY (`child_id`) REFERENCES `Producto` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `detProd`
--

LOCK TABLES `detProd` WRITE;
/*!40000 ALTER TABLE `detProd` DISABLE KEYS */;
/*!40000 ALTER TABLE `detProd` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `detalleNotas`
--

DROP TABLE IF EXISTS `detalleNotas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `detalleNotas` (
  `notas_id` int(11) NOT NULL,
  `detallePedido_id` int(11) NOT NULL COMMENT 'Solo se requiere el id del detalle Pedido.',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`notas_id`,`detallePedido_id`),
  KEY `fk_detalleNotas_detallePedido1_idx` (`detallePedido_id`),
  CONSTRAINT `fk_detalleNotas_Notas1` FOREIGN KEY (`notas_id`) REFERENCES `Notas` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_detalleNotas_detallePedido1` FOREIGN KEY (`detallePedido_id`) REFERENCES `detallePedido` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `detalleNotas`
--

LOCK TABLES `detalleNotas` WRITE;
/*!40000 ALTER TABLE `detalleNotas` DISABLE KEYS */;
/*!40000 ALTER TABLE `detalleNotas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `detallePedido`
--

DROP TABLE IF EXISTS `detallePedido`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `detallePedido` (
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
  KEY `fk_detallePedido_Pedido1` (`pedido_id`),
  CONSTRAINT `fk_detallePedido_Pedido1` FOREIGN KEY (`pedido_id`) REFERENCES `Pedido` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_detallePedido_Producto1` FOREIGN KEY (`producto_id`) REFERENCES `Producto` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `detallePedido`
--

LOCK TABLES `detallePedido` WRITE;
/*!40000 ALTER TABLE `detallePedido` DISABLE KEYS */;
/*!40000 ALTER TABLE `detallePedido` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipoins`
--

DROP TABLE IF EXISTS `tipoins`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tipoins` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) DEFAULT NULL,
  `descripcion` text,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipoins`
--

LOCK TABLES `tipoins` WRITE;
/*!40000 ALTER TABLE `tipoins` DISABLE KEYS */;
/*!40000 ALTER TABLE `tipoins` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2014-02-19 17:25:36
