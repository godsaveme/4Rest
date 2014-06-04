SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';


-- -----------------------------------------------------
-- Table `db_4rest`.`Perfil`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_4rest`.`Perfil` (
  `idPerfil` INT NOT NULL,
  `nombre` VARCHAR(100) NULL,
  `descripcion` TEXT NULL,
  `created_at` TIMESTAMP NULL,
  `updated_at` TIMESTAMP NULL,
  PRIMARY KEY (`idPerfil`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `db_4rest`.`Persona`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_4rest`.`Persona` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nombres` VARCHAR(100) NULL,
  `razonSocial` VARCHAR(100) NULL,
  `apPaterno` VARCHAR(100) NULL,
  `apMaterno` VARCHAR(100) NULL,
  `dni` VARCHAR(8) NULL,
  `ruc` VARCHAR(11) NULL,
  `direccion` VARCHAR(200) NULL,
  `pais` VARCHAR(50) NULL,
  `provincia` VARCHAR(50) NULL,
  `distrito` VARCHAR(50) NULL,
  `tel` VARCHAR(100) NULL,
  `cel` VARCHAR(100) NULL,
  `email` VARCHAR(100) NULL,
  `habilitado` TINYINT(1) NULL,
  `created_at` TIMESTAMP NULL,
  `updated_at` TIMESTAMP NULL,
  `Perfil_idPerfil` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_Persona_Perfil1_idx` (`Perfil_idPerfil` ASC),
  CONSTRAINT `fk_Persona_Perfil1`
    FOREIGN KEY (`Perfil_idPerfil`)
    REFERENCES `db_4rest`.`Perfil` (`idPerfil`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `db_4rest`.`Pedido`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_4rest`.`Pedido` (
  `idPedido` INT NOT NULL AUTO_INCREMENT,
  `fechaInicio` TIMESTAMP NULL,
  `fechaCancelacion` TIMESTAMP NULL,
  `estado` CHAR(1) NULL,
  `importe` DECIMAL(10,2) NULL,
  `Persona_idPersona` INT NULL COMMENT 'id de persona mozo x ejemplo\n',
  `Persona_idPersona1` INT NULL COMMENT 'id de cliente',
  `created_at` TIMESTAMP NULL,
  `updated_at` TIMESTAMP NULL,
  PRIMARY KEY (`idPedido`),
  INDEX `fk_Pedido_Persona1_idx` (`Persona_idPersona` ASC),
  INDEX `fk_Pedido_Persona2_idx` (`Persona_idPersona1` ASC),
  CONSTRAINT `fk_Pedido_Persona1`
    FOREIGN KEY (`Persona_idPersona`)
    REFERENCES `db_4rest`.`Persona` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Pedido_Persona2`
    FOREIGN KEY (`Persona_idPersona1`)
    REFERENCES `db_4rest`.`Persona` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `db_4rest`.`Familia`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_4rest`.`Familia` (
  `id` INT NOT NULL,
  `nombre` VARCHAR(100) NULL,
  `descripcion` TEXT NULL,
  `imagen` TEXT NULL COMMENT '\'ruta\'',
  `created_at` TIMESTAMP NULL,
  `updated_at` TIMESTAMP NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `db_4rest`.`Producto`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_4rest`.`Producto` (
  `idProducto` INT NOT NULL,
  `nombre` VARCHAR(300) NULL,
  `Familia_idFamilia` INT NOT NULL,
  `descripcion` TEXT NULL,
  `estado` TINYINT(1) NULL COMMENT '0 --> des-habilitado\n1 --> habilitado',
  `unidadMedida` VARCHAR(45) NULL,
  `stock` DECIMAL(10,2) NULL,
  `stockMin` DECIMAL(10,2) NULL,
  `stockMax` DECIMAL(10,2) NULL,
  `created_at` TIMESTAMP NULL,
  `updated_at` TIMESTAMP NULL,
  `selector_adicional` INT NULL COMMENT 'para ver si un producto tiene adicionales o no.',
  `lista_prod` TEXT NULL COMMENT 'guarda lista de prod adicionales',
  PRIMARY KEY (`idProducto`),
  INDEX `fk_Producto_Familia1_idx` (`Familia_idFamilia` ASC),
  CONSTRAINT `fk_Producto_Familia1`
    FOREIGN KEY (`Familia_idFamilia`)
    REFERENCES `db_4rest`.`Familia` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `db_4rest`.`detallePedido`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_4rest`.`detallePedido` (
  `id` INT NOT NULL,
  `Pedido_idPedido` INT NOT NULL,
  `Producto_idProducto` INT NOT NULL,
  `precioUnidadFinal` DECIMAL(10,2) NULL,
  `cantidad` INT NULL,
  `importeFinal` DECIMAL(10,2) NULL,
  `descuento` DOUBLE NULL COMMENT 'es en porcentaje.. 0 a 1.. Si se sabe cuanto bajarle.. se pondrá el monto y se calculará el % q refleja.',
  `estado` CHAR(1) NULL COMMENT 'Iniciado (i), En proceso (p), Para despachar (p), Despachado (d).',
  `fechaInicio` TIMESTAMP NULL,
  `fechaProceso` TIMESTAMP NULL,
  `fechaDespacho` TIMESTAMP NULL,
  `fechaDespachado` TIMESTAMP NULL,
  `created_at` TIMESTAMP NULL,
  `updated_at` TIMESTAMP NULL,
  `detalle_id` INT NULL COMMENT 'en los productos adicionales, los detalles_id se llena con el id_DETALLE PEDIDO al cual el producto es adicional',
  PRIMARY KEY (`id`, `Pedido_idPedido`, `Producto_idProducto`),
  INDEX `fk_detallePedido_Producto1_idx` (`Producto_idProducto` ASC),
  CONSTRAINT `fk_detallePedido_Pedido1`
    FOREIGN KEY (`Pedido_idPedido`)
    REFERENCES `db_4rest`.`Pedido` (`idPedido`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_detallePedido_Producto1`
    FOREIGN KEY (`Producto_idProducto`)
    REFERENCES `db_4rest`.`Producto` (`idProducto`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `db_4rest`.`CategoriaNotas`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_4rest`.`CategoriaNotas` (
  `id` INT NOT NULL,
  `nombre` VARCHAR(100) NULL,
  `descripcion` TEXT NULL,
  `created_at` TIMESTAMP NULL,
  `updated_at` TIMESTAMP NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `db_4rest`.`Notas`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_4rest`.`Notas` (
  `id` INT NOT NULL,
  `nombre` VARCHAR(100) NULL,
  `descripcion` TEXT NULL,
  `CategoriaNotas_idCategoriaNotas` INT NOT NULL,
  `created_at` TIMESTAMP NULL,
  `updated_at` TIMESTAMP NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_Notas_CategoriaNotas1_idx` (`CategoriaNotas_idCategoriaNotas` ASC),
  CONSTRAINT `fk_Notas_CategoriaNotas1`
    FOREIGN KEY (`CategoriaNotas_idCategoriaNotas`)
    REFERENCES `db_4rest`.`CategoriaNotas` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `db_4rest`.`detalleNotas`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_4rest`.`detalleNotas` (
  `Notas_idNotas` INT NOT NULL,
  `detallePedido_id` INT NOT NULL,
  `detallePedido_Pedido_idPedido` INT NOT NULL,
  `detallePedido_Producto_idProducto` INT NOT NULL,
  `created_at` TIMESTAMP NULL,
  `updated_at` TIMESTAMP NULL,
  PRIMARY KEY (`Notas_idNotas`, `detallePedido_id`, `detallePedido_Pedido_idPedido`, `detallePedido_Producto_idProducto`),
  INDEX `fk_detalleNotas_detallePedido1_idx` (`detallePedido_id` ASC, `detallePedido_Pedido_idPedido` ASC, `detallePedido_Producto_idProducto` ASC),
  CONSTRAINT `fk_detalleNotas_Notas1`
    FOREIGN KEY (`Notas_idNotas`)
    REFERENCES `db_4rest`.`Notas` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_detalleNotas_detallePedido1`
    FOREIGN KEY (`detallePedido_id` , `detallePedido_Pedido_idPedido` , `detallePedido_Producto_idProducto`)
    REFERENCES `db_4rest`.`detallePedido` (`id` , `Pedido_idPedido` , `Producto_idProducto`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `db_4rest`.`Combinacion`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_4rest`.`Combinacion` (
  `idCombinacion` INT NOT NULL,
  `nombre` VARCHAR(300) NULL,
  `descripcion` TEXT NULL,
  `HoraInicio` TIME NULL,
  `HoraTermino` TIME NULL,
  `FechaInicio` TIMESTAMP NULL,
  `FechaTermino` TIMESTAMP NULL,
  `created_at` TIMESTAMP NULL,
  `updated_at` TIMESTAMP NULL,
  PRIMARY KEY (`idCombinacion`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `db_4rest`.`Precio`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_4rest`.`Precio` (
  `Producto_idProducto` INT NOT NULL,
  `Combinacion_idCombinacion` INT NOT NULL,
  `precio` DECIMAL(10,2) NULL,
  `seleccionador` INT NULL,
  `created_at` TIMESTAMP NULL,
  `updated_at` TIMESTAMP NULL,
  PRIMARY KEY (`Producto_idProducto`, `Combinacion_idCombinacion`),
  INDEX `fk_Precio_Combinacion1_idx` (`Combinacion_idCombinacion` ASC),
  CONSTRAINT `fk_Precio_Producto1`
    FOREIGN KEY (`Producto_idProducto`)
    REFERENCES `db_4rest`.`Producto` (`idProducto`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Precio_Combinacion1`
    FOREIGN KEY (`Combinacion_idCombinacion`)
    REFERENCES `db_4rest`.`Combinacion` (`idCombinacion`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `db_4rest`.`Insumo`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_4rest`.`Insumo` (
  `idInsumo` INT NOT NULL,
  `nombre` VARCHAR(300) NULL,
  `descripcion` TEXT NULL,
  `stock` DECIMAL(10,2) NULL,
  `stockMin` DECIMAL(10,2) NULL,
  `stockMax` DECIMAL(10,2) NULL,
  `unidadMedida` VARCHAR(45) NULL COMMENT '\'unidades, litros kilos\'',
  `costo` DECIMAL(10,2) NULL,
  `created_at` TIMESTAMP NULL,
  `updated_at` TIMESTAMP NULL,
  PRIMARY KEY (`idInsumo`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `db_4rest`.`detProducto`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_4rest`.`detProducto` (
  `Producto_idProducto` INT NOT NULL,
  `Insumo_idInsumo` INT NOT NULL,
  `Producto_idProducto1` INT NOT NULL,
  `cantidad` DECIMAL(10,2) NULL,
  `created_at` TIMESTAMP NULL,
  `updated_at` TIMESTAMP NULL,
  PRIMARY KEY (`Producto_idProducto`, `Insumo_idInsumo`, `Producto_idProducto1`),
  INDEX `fk_detProducto_Insumo1_idx` (`Insumo_idInsumo` ASC),
  INDEX `fk_detProducto_Producto2_idx` (`Producto_idProducto1` ASC),
  CONSTRAINT `fk_detProducto_Producto1`
    FOREIGN KEY (`Producto_idProducto`)
    REFERENCES `db_4rest`.`Producto` (`idProducto`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_detProducto_Insumo1`
    FOREIGN KEY (`Insumo_idInsumo`)
    REFERENCES `db_4rest`.`Insumo` (`idInsumo`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_detProducto_Producto2`
    FOREIGN KEY (`Producto_idProducto1`)
    REFERENCES `db_4rest`.`Producto` (`idProducto`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `db_4rest`.`InfNut`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_4rest`.`InfNut` (
  `idInfNut` INT NOT NULL,
  `nombre` VARCHAR(100) NULL,
  `descripcion` TEXT NULL,
  `created_at` TIMESTAMP NULL,
  `updated_at` TIMESTAMP NULL,
  PRIMARY KEY (`idInfNut`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `db_4rest`.`detInfNutr`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_4rest`.`detInfNutr` (
  `InfNut_idInfNut` INT NOT NULL,
  `Producto_idProducto` INT NOT NULL,
  `cantidad` DECIMAL(10,4) NULL,
  `UnidadMedida` VARCHAR(45) NULL COMMENT 'litros kilos unidades',
  `created_at` TIMESTAMP NULL,
  `updated_at` TIMESTAMP NULL,
  PRIMARY KEY (`InfNut_idInfNut`, `Producto_idProducto`),
  INDEX `fk_detInfNutr_Producto1_idx` (`Producto_idProducto` ASC),
  CONSTRAINT `fk_detInfNutr_InfNut1`
    FOREIGN KEY (`InfNut_idInfNut`)
    REFERENCES `db_4rest`.`InfNut` (`idInfNut`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_detInfNutr_Producto1`
    FOREIGN KEY (`Producto_idProducto`)
    REFERENCES `db_4rest`.`Producto` (`idProducto`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `db_4rest`.`Restaurante`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_4rest`.`Restaurante` (
  `id` INT NOT NULL,
  `nombre` VARCHAR(100) NULL,
  `descripcion` TEXT NULL,
  `created_at` TIMESTAMP NULL,
  `updated_at` TIMESTAMP NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `db_4rest`.`Salon`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_4rest`.`Salon` (
  `id` INT NOT NULL,
  `nombre` VARCHAR(100) NULL,
  `descripcion` TEXT NULL,
  `Restaurante_idRestaurante` INT NOT NULL,
  `habilitado` TINYINT(1) NULL,
  `created_at` TIMESTAMP NULL,
  `updated_at` TIMESTAMP NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_Salon_Restaurante1_idx` (`Restaurante_idRestaurante` ASC),
  CONSTRAINT `fk_Salon_Restaurante1`
    FOREIGN KEY (`Restaurante_idRestaurante`)
    REFERENCES `db_4rest`.`Restaurante` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `db_4rest`.`Mesa`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_4rest`.`Mesa` (
  `idMesa` INT NOT NULL,
  `nombre` VARCHAR(100) NULL,
  `descripcion` TEXT NULL,
  `Salon_idSalon` INT NOT NULL,
  `estado` TINYINT(1) NULL COMMENT '0 --> deshabilitado\n1 --> habilitado.',
  `habilitado` TINYINT(1) NULL,
  `created_at` TIMESTAMP NULL,
  `updated_at` TIMESTAMP NULL,
  PRIMARY KEY (`idMesa`),
  INDEX `fk_Mesa_Salon1_idx` (`Salon_idSalon` ASC),
  CONSTRAINT `fk_Mesa_Salon1`
    FOREIGN KEY (`Salon_idSalon`)
    REFERENCES `db_4rest`.`Salon` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `db_4rest`.`detMesa`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_4rest`.`detMesa` (
  `Pedido_idPedido` INT NOT NULL,
  `Mesa_idMesa` INT NOT NULL,
  `created_at` TIMESTAMP NULL,
  `updated_at` TIMESTAMP NULL,
  PRIMARY KEY (`Pedido_idPedido`, `Mesa_idMesa`),
  INDEX `fk_detMesa_Mesa1_idx` (`Mesa_idMesa` ASC),
  CONSTRAINT `fk_detMesa_Pedido1`
    FOREIGN KEY (`Pedido_idPedido`)
    REFERENCES `db_4rest`.`Pedido` (`idPedido`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_detMesa_Mesa1`
    FOREIGN KEY (`Mesa_idMesa`)
    REFERENCES `db_4rest`.`Mesa` (`idMesa`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `db_4rest`.`Usuario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_4rest`.`Usuario` (
  `idUsuario` INT NOT NULL,
  `login` VARCHAR(45) NULL,
  `password` VARCHAR(45) NULL,
  `Persona_idPersona` INT NULL,
  `created_at` TIMESTAMP NULL,
  `updated_at` TIMESTAMP NULL,
  `habilitado` TINYINT(1) NULL,
  PRIMARY KEY (`idUsuario`),
  INDEX `fk_Usuario_Persona1_idx` (`Persona_idPersona` ASC),
  CONSTRAINT `fk_Usuario_Persona1`
    FOREIGN KEY (`Persona_idPersona`)
    REFERENCES `db_4rest`.`Persona` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `db_4rest`.`Caja`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_4rest`.`Caja` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `montoInicial` DECIMAL(10,2) NULL,
  `deberiaHaber` DECIMAL(10,2) NULL,
  `montoFinal` DECIMAL(10,2) NULL,
  `diferencia` DECIMAL(10,2) NULL COMMENT 'Monto final - deberia haber',
  `montoDejado` DECIMAL(10,2) NULL,
  `estado` VARCHAR(1) NULL COMMENT 'abierto (a)\n cerrado (c) \neliminado (e)',
  `fechaInicio` TIMESTAMP NULL,
  `fechaCierre` TIMESTAMP NULL,
  `created_at` TIMESTAMP NULL,
  `updated_at` TIMESTAMP NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `db_4rest`.`PedidoCompra`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_4rest`.`PedidoCompra` (
  `id` INT NOT NULL COMMENT 'si se compra un producto final se va al insumo tb\nsi se compra un insumo se queda ahi',
  `fecha` TIMESTAMP NULL,
  `Persona_id` INT NULL COMMENT 'de tal proveedor',
  `importeFinal` DECIMAL(10,2) NULL,
  `Persona_id1` INT NULL COMMENT 'creado por tal usuario',
  `estado` TINYINT(1) NULL COMMENT '0 --> anulado\n1 --> habilitado',
  `created_at` TIMESTAMP NULL,
  `updated_at` TIMESTAMP NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_Ingreso_Persona1_idx` (`Persona_id` ASC),
  INDEX `fk_Ingreso_Persona2_idx` (`Persona_id1` ASC),
  CONSTRAINT `fk_Ingreso_Persona1`
    FOREIGN KEY (`Persona_id`)
    REFERENCES `db_4rest`.`Persona` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Ingreso_Persona2`
    FOREIGN KEY (`Persona_id1`)
    REFERENCES `db_4rest`.`Persona` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `db_4rest`.`DetalleIngresoInsumo`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_4rest`.`DetalleIngresoInsumo` (
  `Ingreso_id` INT NOT NULL,
  `Insumo_idInsumo` INT NOT NULL,
  `cantidad` DECIMAL(10,2) NULL,
  `created_at` TIMESTAMP NULL,
  `updated_at` TIMESTAMP NULL,
  INDEX `fk_DetalleIngresoInsumo_Ingreso1_idx` (`Ingreso_id` ASC),
  INDEX `fk_DetalleIngresoInsumo_Insumo1_idx` (`Insumo_idInsumo` ASC),
  CONSTRAINT `fk_DetalleIngresoInsumo_Ingreso1`
    FOREIGN KEY (`Ingreso_id`)
    REFERENCES `db_4rest`.`PedidoCompra` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_DetalleIngresoInsumo_Insumo1`
    FOREIGN KEY (`Insumo_idInsumo`)
    REFERENCES `db_4rest`.`Insumo` (`idInsumo`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
