SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

CREATE SCHEMA IF NOT EXISTS `db_4rest` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
USE `db_4rest` ;

-- -----------------------------------------------------
-- Table `db_4rest`.`Perfil`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_4rest`.`Perfil` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(100) NULL,
  `descripcion` TEXT NULL,
  `created_at` TIMESTAMP NULL,
  `updated_at` TIMESTAMP NULL,
  PRIMARY KEY (`id`))
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
  `perfil_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_Persona_Perfil1_idx` (`perfil_id` ASC),
  CONSTRAINT `fk_Persona_Perfil1`
    FOREIGN KEY (`perfil_id`)
    REFERENCES `db_4rest`.`Perfil` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `db_4rest`.`Pedido`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_4rest`.`Pedido` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `fechaInicio` TIMESTAMP NULL,
  `fechaCancelacion` TIMESTAMP NULL,
  `estado` CHAR(1) NULL,
  `importeFinal` DECIMAL(10,2) NULL COMMENT 'el total de cuento se pago con todo y descuento incluido.',
  `descuento` DOUBLE NULL COMMENT 'es en porcentaje.. 0 a 1.. Si se sabe cuanto bajarle.. se pondrá el monto y se calculará el % q refleja.\n\nEste descuento es aplicado al importe total de venta.',
  `usuario_id` INT NULL COMMENT 'id de persona mozo x ejemplo\n',
  `cliente_id` INT NULL COMMENT 'id de cliente',
  `created_at` TIMESTAMP NULL,
  `updated_at` TIMESTAMP NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_Pedido_Persona1_idx` (`usuario_id` ASC),
  INDEX `fk_Pedido_Persona2_idx` (`cliente_id` ASC),
  CONSTRAINT `fk_Pedido_Persona1`
    FOREIGN KEY (`usuario_id`)
    REFERENCES `db_4rest`.`Persona` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Pedido_Persona2`
    FOREIGN KEY (`cliente_id`)
    REFERENCES `db_4rest`.`Persona` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `db_4rest`.`Familia`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_4rest`.`Familia` (
  `id` INT NOT NULL AUTO_INCREMENT,
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
  `id` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(300) NULL,
  `familia_id` INT NULL,
  `descripcion` TEXT NULL,
  `estado` TINYINT(1) NULL COMMENT '0 --> des-habilitado\n1 --> habilitado',
  `favorito` TINYINT(1) NULL COMMENT '0 --> No\n1 --> Si',
  `unidadMedida` VARCHAR(45) NULL COMMENT 'unidades..\n',
  `stock` DECIMAL(10,2) NULL,
  `stockMin` DECIMAL(10,2) NULL,
  `stockMax` DECIMAL(10,2) NULL,
  `created_at` TIMESTAMP NULL,
  `updated_at` TIMESTAMP NULL,
  `selector_adicional` INT NULL COMMENT 'para ver si un producto tiene adicionales o no.',
  `lista_prod` TEXT NULL COMMENT 'guarda lista de prod adicionales',
  `selector_eleccion` INT NULL COMMENT 'helado doble.. selector_eleccion-->2',
  PRIMARY KEY (`id`),
  INDEX `fk_Producto_Familia1_idx` (`familia_id` ASC),
  CONSTRAINT `fk_Producto_Familia1`
    FOREIGN KEY (`familia_id`)
    REFERENCES `db_4rest`.`Familia` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `db_4rest`.`detallePedido`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_4rest`.`detallePedido` (
  `id` INT NOT NULL,
  `pedido_id` INT NOT NULL,
  `producto_id` INT NOT NULL,
  `precioUnidadFinal` DECIMAL(10,2) NULL,
  `cantidad` INT NULL COMMENT 'siempre serán unidades',
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
  PRIMARY KEY (`id`, `pedido_id`, `producto_id`),
  INDEX `fk_detallePedido_Producto1_idx` (`producto_id` ASC),
  CONSTRAINT `fk_detallePedido_Pedido1`
    FOREIGN KEY (`pedido_id`)
    REFERENCES `db_4rest`.`Pedido` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_detallePedido_Producto1`
    FOREIGN KEY (`producto_id`)
    REFERENCES `db_4rest`.`Producto` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `db_4rest`.`CatNotas`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_4rest`.`CatNotas` (
  `id` INT NOT NULL AUTO_INCREMENT,
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
  `id` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(100) NULL,
  `descripcion` TEXT NULL,
  `catNot_id` INT NOT NULL,
  `created_at` TIMESTAMP NULL,
  `updated_at` TIMESTAMP NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_Notas_CategoriaNotas1_idx` (`catNot_id` ASC),
  CONSTRAINT `fk_Notas_CategoriaNotas1`
    FOREIGN KEY (`catNot_id`)
    REFERENCES `db_4rest`.`CatNotas` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `db_4rest`.`detalleNotas`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_4rest`.`detalleNotas` (
  `notas_id` INT NOT NULL,
  `detallePedido_id` INT NOT NULL COMMENT 'Solo se requiere el id del detalle Pedido.',
  `created_at` TIMESTAMP NULL,
  `updated_at` TIMESTAMP NULL,
  PRIMARY KEY (`notas_id`, `detallePedido_id`),
  INDEX `fk_detalleNotas_detallePedido1_idx` (`detallePedido_id` ASC),
  CONSTRAINT `fk_detalleNotas_Notas1`
    FOREIGN KEY (`notas_id`)
    REFERENCES `db_4rest`.`Notas` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_detalleNotas_detallePedido1`
    FOREIGN KEY (`detallePedido_id`)
    REFERENCES `db_4rest`.`detallePedido` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `db_4rest`.`TipoComb`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_4rest`.`TipoComb` (
  `id` INT NOT NULL,
  `nombre` VARCHAR(100) NULL,
  `descripcion` TEXT NULL,
  `created_at` TIMESTAMP NULL,
  `updated_at` TIMESTAMP NULL COMMENT 'Para cubrir los distintos Menúes diarios de Kango',
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `db_4rest`.`Combinacion`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_4rest`.`Combinacion` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(300) NULL,
  `descripcion` TEXT NULL,
  `HoraInicio` TIME NULL,
  `HoraTermino` TIME NULL,
  `FechaInicio` TIMESTAMP NULL,
  `FechaTermino` TIMESTAMP NULL,
  `created_at` TIMESTAMP NULL,
  `updated_at` TIMESTAMP NULL,
  `TipoComb_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_Combinacion_TipoComb1_idx` (`TipoComb_id` ASC),
  CONSTRAINT `fk_Combinacion_TipoComb1`
    FOREIGN KEY (`TipoComb_id`)
    REFERENCES `db_4rest`.`TipoComb` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `db_4rest`.`Precio`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_4rest`.`Precio` (
  `producto_id` INT NOT NULL,
  `combinacion_id` INT NOT NULL,
  `precio` DECIMAL(10,2) NULL,
  `seleccionador` INT NULL COMMENT '11,22,33,44... solo se selecciona 4 prod d los 8 disp',
  `created_at` TIMESTAMP NULL,
  `updated_at` TIMESTAMP NULL,
  PRIMARY KEY (`producto_id`, `combinacion_id`),
  INDEX `fk_Precio_Combinacion1_idx` (`combinacion_id` ASC),
  CONSTRAINT `fk_Precio_Producto1`
    FOREIGN KEY (`producto_id`)
    REFERENCES `db_4rest`.`Producto` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Precio_Combinacion1`
    FOREIGN KEY (`combinacion_id`)
    REFERENCES `db_4rest`.`Combinacion` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `db_4rest`.`Insumo`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_4rest`.`Insumo` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(300) NULL,
  `descripcion` TEXT NULL,
  `stock` DECIMAL(10,2) NULL,
  `stockMin` DECIMAL(10,2) NULL,
  `stockMax` DECIMAL(10,2) NULL,
  `unidadMedida` VARCHAR(45) NULL COMMENT '\'unidades, litros kilos\'',
  `costo` DECIMAL(10,2) NULL COMMENT 'costo del insumo promedio.',
  `created_at` TIMESTAMP NULL,
  `updated_at` TIMESTAMP NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `db_4rest`.`Receta`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_4rest`.`Receta` (
  `producto_id` INT NOT NULL,
  `insumo_id` INT NOT NULL,
  `cantidad` DECIMAL(10,2) NULL,
  `created_at` TIMESTAMP NULL,
  `updated_at` TIMESTAMP NULL,
  PRIMARY KEY (`producto_id`, `insumo_id`),
  INDEX `fk_detProducto_Insumo1_idx` (`insumo_id` ASC),
  CONSTRAINT `fk_detProducto_Producto1`
    FOREIGN KEY (`producto_id`)
    REFERENCES `db_4rest`.`Producto` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_detProducto_Insumo1`
    FOREIGN KEY (`insumo_id`)
    REFERENCES `db_4rest`.`Insumo` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `db_4rest`.`InfNut`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_4rest`.`InfNut` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(100) NULL,
  `descripcion` TEXT NULL,
  `created_at` TIMESTAMP NULL,
  `updated_at` TIMESTAMP NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `db_4rest`.`detInfNutr`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_4rest`.`detInfNutr` (
  `infNut_id` INT NOT NULL,
  `producto_id` INT NOT NULL,
  `cantidad` DECIMAL(10,4) NULL,
  `UnidadMedida` VARCHAR(45) NULL COMMENT 'litros kilos unidades',
  `created_at` TIMESTAMP NULL,
  `updated_at` TIMESTAMP NULL,
  PRIMARY KEY (`infNut_id`, `producto_id`),
  INDEX `fk_detInfNutr_Producto1_idx` (`producto_id` ASC),
  CONSTRAINT `fk_detInfNutr_InfNut1`
    FOREIGN KEY (`infNut_id`)
    REFERENCES `db_4rest`.`InfNut` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_detInfNutr_Producto1`
    FOREIGN KEY (`producto_id`)
    REFERENCES `db_4rest`.`Producto` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `db_4rest`.`Restaurante`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_4rest`.`Restaurante` (
  `id` INT NOT NULL AUTO_INCREMENT,
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
  `id` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(100) NULL,
  `descripcion` TEXT NULL,
  `restaurante_id` INT NOT NULL,
  `habilitado` TINYINT(1) NULL,
  `created_at` TIMESTAMP NULL,
  `updated_at` TIMESTAMP NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_Salon_Restaurante1_idx` (`restaurante_id` ASC),
  CONSTRAINT `fk_Salon_Restaurante1`
    FOREIGN KEY (`restaurante_id`)
    REFERENCES `db_4rest`.`Restaurante` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `db_4rest`.`Mesa`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_4rest`.`Mesa` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(100) NULL,
  `descripcion` TEXT NULL,
  `salon_id` INT NOT NULL,
  `estado` TINYINT(1) NULL COMMENT '0 --> deshabilitado\n1 --> habilitado.',
  `habilitado` TINYINT(1) NULL,
  `created_at` TIMESTAMP NULL,
  `updated_at` TIMESTAMP NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_Mesa_Salon1_idx` (`salon_id` ASC),
  CONSTRAINT `fk_Mesa_Salon1`
    FOREIGN KEY (`salon_id`)
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
    REFERENCES `db_4rest`.`Pedido` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_detMesa_Mesa1`
    FOREIGN KEY (`Mesa_idMesa`)
    REFERENCES `db_4rest`.`Mesa` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `db_4rest`.`Usuario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_4rest`.`Usuario` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `login` VARCHAR(45) NULL,
  `password` VARCHAR(45) NULL,
  `persona_id` INT NULL,
  `created_at` TIMESTAMP NULL,
  `updated_at` TIMESTAMP NULL,
  `estado` TINYINT(1) NULL COMMENT '0 --> des-habilitado\n1 --> habilitado.\n',
  PRIMARY KEY (`id`),
  INDEX `fk_Usuario_Persona1_idx` (`persona_id` ASC),
  CONSTRAINT `fk_Usuario_Persona1`
    FOREIGN KEY (`persona_id`)
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
  `deberiaHaber` DECIMAL(10,2) NULL COMMENT 'si en el dia se compra a un proveedor con plata sacada de caja',
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
  `id` INT NOT NULL AUTO_INCREMENT COMMENT 'si se compra un producto final se va al insumo tb\nsi se compra un insumo se queda ahi',
  `fecha` TIMESTAMP NULL,
  `proveedor_id` INT NULL COMMENT 'de tal proveedor',
  `importeFinal` DECIMAL(10,2) NULL,
  `usuario_id` INT NOT NULL COMMENT 'creado por tal usuario',
  `estado` TINYINT(1) NULL COMMENT '0 --> anulado\n1 --> habilitado',
  `created_at` TIMESTAMP NULL,
  `updated_at` TIMESTAMP NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_Ingreso_Persona1_idx` (`proveedor_id` ASC),
  INDEX `fk_Ingreso_Persona2_idx` (`usuario_id` ASC),
  CONSTRAINT `fk_Ingreso_Persona1`
    FOREIGN KEY (`proveedor_id`)
    REFERENCES `db_4rest`.`Persona` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Ingreso_Persona2`
    FOREIGN KEY (`usuario_id`)
    REFERENCES `db_4rest`.`Persona` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `db_4rest`.`DetalleIngresoInsumo`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_4rest`.`DetalleIngresoInsumo` (
  `ingreso_id` INT NOT NULL,
  `insumo_id` INT NOT NULL,
  `cantidad` DECIMAL(10,2) NULL,
  `costo` DECIMAL(10,2) NULL COMMENT 'costo del insumo en ese instante\n',
  `created_at` TIMESTAMP NULL,
  `updated_at` TIMESTAMP NULL,
  INDEX `fk_DetalleIngresoInsumo_Ingreso1_idx` (`ingreso_id` ASC),
  INDEX `fk_DetalleIngresoInsumo_Insumo1_idx` (`insumo_id` ASC),
  PRIMARY KEY (`ingreso_id`, `insumo_id`),
  CONSTRAINT `fk_DetalleIngresoInsumo_Ingreso1`
    FOREIGN KEY (`ingreso_id`)
    REFERENCES `db_4rest`.`PedidoCompra` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_DetalleIngresoInsumo_Insumo1`
    FOREIGN KEY (`insumo_id`)
    REFERENCES `db_4rest`.`Insumo` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `db_4rest`.`detProd`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_4rest`.`detProd` (
  `parent_id` INT NOT NULL,
  `child_id` INT NOT NULL,
  PRIMARY KEY (`parent_id`, `child_id`),
  INDEX `fk_detProd_Producto2_idx` (`child_id` ASC),
  CONSTRAINT `fk_detProd_Producto1`
    FOREIGN KEY (`parent_id`)
    REFERENCES `db_4rest`.`Producto` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_detProd_Producto2`
    FOREIGN KEY (`child_id`)
    REFERENCES `db_4rest`.`Producto` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
