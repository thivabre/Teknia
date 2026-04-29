-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3307
-- Tiempo de generación: 30-04-2026 a las 01:17:06
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `servicio_tecnico_db`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `articulo_reparar`
--

CREATE TABLE `articulo_reparar` (
  `id_articulo_reparar` int(11) NOT NULL,
  `nombre_art_rep` varchar(30) NOT NULL,
  `tipo_art_rep` varchar(30) NOT NULL,
  `fallas` varchar(70) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `id_cliente` int(11) NOT NULL,
  `nombre_cli` varchar(30) NOT NULL,
  `apellido_cli` varchar(30) NOT NULL,
  `dni_cli` int(8) NOT NULL,
  `telefono_cli` varchar(11) NOT NULL,
  `id_dire_cliente` int(11) NOT NULL,
  `migrado_a_empleado` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contrato_empleado`
--

CREATE TABLE `contrato_empleado` (
  `id_contrato_emple` int(11) NOT NULL,
  `fecha_cont` date NOT NULL,
  `turno` varchar(15) NOT NULL,
  `id_sueldo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `direccion_cliente`
--

CREATE TABLE `direccion_cliente` (
  `id_dire_cliente` int(11) NOT NULL,
  `calle_cli` varchar(30) NOT NULL,
  `altura_cli` int(4) NOT NULL,
  `cod_postal_cli` int(4) NOT NULL,
  `id_localidad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `direccion_empleado`
--

CREATE TABLE `direccion_empleado` (
  `id_dire_empleado` int(11) NOT NULL,
  `calle_emp` varchar(30) NOT NULL,
  `altura_emp` int(4) NOT NULL,
  `cod_postal_emp` int(4) NOT NULL,
  `id_localidad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `direccion_proveedor`
--

CREATE TABLE `direccion_proveedor` (
  `id_dire_proveedor` int(11) NOT NULL,
  `calle_prov` varchar(30) NOT NULL,
  `altura_prov` int(4) NOT NULL,
  `cod_postal_prov` int(4) NOT NULL,
  `id_localidad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `direccion_sucursal`
--

CREATE TABLE `direccion_sucursal` (
  `id_dire_sucursal` int(11) NOT NULL,
  `calle_suc` varchar(30) NOT NULL,
  `altura_suc` int(4) NOT NULL,
  `cod_postal_suc` int(4) NOT NULL,
  `id_localidad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleado`
--

CREATE TABLE `empleado` (
  `id_empleado` int(11) NOT NULL,
  `nombre_emple` varchar(30) NOT NULL,
  `apellido_emple` varchar(30) NOT NULL,
  `dni_emple` int(8) NOT NULL,
  `telefono_emple` varchar(11) NOT NULL,
  `horas_trabajdas` int(11) NOT NULL,
  `horas_extra` int(11) NOT NULL,
  `jefe_sucursal` tinyint(1) NOT NULL,
  `jefe_general` tinyint(1) NOT NULL,
  `id_dire_empleado` int(11) NOT NULL,
  `id_contrato_emple` int(11) NOT NULL,
  `id_sucursal` int(11) NOT NULL,
  `id_seguro` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `factura_servicio`
--

CREATE TABLE `factura_servicio` (
  `id_factura_servicio` int(11) NOT NULL,
  `fecha_factura` date NOT NULL,
  `id_pago` int(11) DEFAULT NULL,
  `id_garantia_servicio` int(11) NOT NULL,
  `id_presupuesto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `garantia_servicio`
--

CREATE TABLE `garantia_servicio` (
  `id_garantia_servicio` int(11) NOT NULL,
  `tiempo_garantia` varchar(30) NOT NULL,
  `tipo_garantia` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `impuestos`
--

CREATE TABLE `impuestos` (
  `id_impuestos` int(11) NOT NULL,
  `tipo_imp` varchar(30) NOT NULL,
  `monto_imp` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `intermedia_inv_prod`
--

CREATE TABLE `intermedia_inv_prod` (
  `id_inv_productos` int(11) NOT NULL,
  `id_articulo_reparar` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `intermedia_inv_rep`
--

CREATE TABLE `intermedia_inv_rep` (
  `id_inv_repuestos` int(11) NOT NULL,
  `id_repuesto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `intermedia_rep_pres`
--

CREATE TABLE `intermedia_rep_pres` (
  `id_presupuesto` int(11) NOT NULL,
  `id_repuesto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inventario_productos`
--

CREATE TABLE `inventario_productos` (
  `id_inv_productos` int(11) NOT NULL,
  `cantidad_prod` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inventario_repuestos`
--

CREATE TABLE `inventario_repuestos` (
  `id_inv_repuestos` int(11) NOT NULL,
  `cantidad_rep` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `localidad`
--

CREATE TABLE `localidad` (
  `id_localidad` int(11) NOT NULL,
  `pais` varchar(30) NOT NULL,
  `provincia` varchar(30) NOT NULL,
  `ciudad` varchar(30) NOT NULL,
  `barrio` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `orden_entrega`
--

CREATE TABLE `orden_entrega` (
  `id_orden_entrega` int(11) NOT NULL,
  `fecha_entrega` date NOT NULL,
  `id_orden_servicio` int(11) NOT NULL,
  `id_factura_servicio` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `orden_servicio`
--

CREATE TABLE `orden_servicio` (
  `id_orden_servicio` int(11) NOT NULL,
  `fecha_orden` date NOT NULL,
  `fecha_est_fin` date NOT NULL,
  `id_sucursal` int(11) NOT NULL,
  `id_articulo_reparar` int(11) NOT NULL,
  `id_presupuesto` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pago`
--

CREATE TABLE `pago` (
  `id_pago` int(11) NOT NULL,
  `nombre_banco` varchar(30) NOT NULL,
  `numero_cuenta` int(11) NOT NULL,
  `comprobante` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `precio`
--

CREATE TABLE `precio` (
  `id_precio` int(11) NOT NULL,
  `precio_mano_obra` int(11) NOT NULL,
  `precio_rep` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `presupuestos`
--

CREATE TABLE `presupuestos` (
  `id_presupuesto` int(11) NOT NULL,
  `precio_reparacion_tot` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedor`
--

CREATE TABLE `proveedor` (
  `id_proveedor` int(11) NOT NULL,
  `nombre_prov` varchar(30) NOT NULL,
  `id_dire_proveedor` int(11) NOT NULL,
  `id_repuesto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `repuestos`
--

CREATE TABLE `repuestos` (
  `id_repuesto` int(11) NOT NULL,
  `nombre_rep` varchar(30) NOT NULL,
  `tipo_rep` varchar(30) NOT NULL,
  `id_precio` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `seguro`
--

CREATE TABLE `seguro` (
  `id_seguro` int(11) NOT NULL,
  `tipo_seg` varchar(30) NOT NULL,
  `nombre_aseg` varchar(30) NOT NULL,
  `monto_aseg` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sucursales`
--

CREATE TABLE `sucursales` (
  `id_sucursal` int(11) NOT NULL,
  `cant_empleados` int(11) NOT NULL,
  `reparaciones_hechas` int(11) NOT NULL,
  `id_dire_sucursal` int(11) NOT NULL,
  `id_inv_repuestos` int(11) NOT NULL,
  `id_inv_productos` int(11) NOT NULL,
  `id_impuestos` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sucursales_proveedor`
--

CREATE TABLE `sucursales_proveedor` (
  `id_proveedor` int(11) NOT NULL,
  `id_sucursal` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sueldo`
--

CREATE TABLE `sueldo` (
  `id_sueldo` int(11) NOT NULL,
  `sueldo_hora` int(11) NOT NULL,
  `sueldo_hora_ext` int(11) NOT NULL,
  `forma_pago` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `articulo_reparar`
--
ALTER TABLE `articulo_reparar`
  ADD PRIMARY KEY (`id_articulo_reparar`);

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`id_cliente`),
  ADD KEY `id_dire_cliente` (`id_dire_cliente`);

--
-- Indices de la tabla `contrato_empleado`
--
ALTER TABLE `contrato_empleado`
  ADD PRIMARY KEY (`id_contrato_emple`),
  ADD UNIQUE KEY `id_sueldo` (`id_sueldo`);

--
-- Indices de la tabla `direccion_cliente`
--
ALTER TABLE `direccion_cliente`
  ADD PRIMARY KEY (`id_dire_cliente`),
  ADD UNIQUE KEY `id_localidad` (`id_localidad`);

--
-- Indices de la tabla `direccion_empleado`
--
ALTER TABLE `direccion_empleado`
  ADD PRIMARY KEY (`id_dire_empleado`),
  ADD UNIQUE KEY `id_localidad` (`id_localidad`);

--
-- Indices de la tabla `direccion_proveedor`
--
ALTER TABLE `direccion_proveedor`
  ADD PRIMARY KEY (`id_dire_proveedor`),
  ADD UNIQUE KEY `id_localidad` (`id_localidad`);

--
-- Indices de la tabla `direccion_sucursal`
--
ALTER TABLE `direccion_sucursal`
  ADD PRIMARY KEY (`id_dire_sucursal`),
  ADD UNIQUE KEY `id_localidad` (`id_localidad`);

--
-- Indices de la tabla `empleado`
--
ALTER TABLE `empleado`
  ADD PRIMARY KEY (`id_empleado`),
  ADD UNIQUE KEY `id_contrato_emple` (`id_contrato_emple`),
  ADD KEY `id_dire_empleado` (`id_dire_empleado`),
  ADD KEY `id_sucursal` (`id_sucursal`),
  ADD KEY `fk_empleado_seguro` (`id_seguro`);

--
-- Indices de la tabla `factura_servicio`
--
ALTER TABLE `factura_servicio`
  ADD PRIMARY KEY (`id_factura_servicio`),
  ADD UNIQUE KEY `id_presupuesto` (`id_presupuesto`),
  ADD UNIQUE KEY `id_pago` (`id_pago`),
  ADD KEY `fk_factura_garantia` (`id_garantia_servicio`);

--
-- Indices de la tabla `garantia_servicio`
--
ALTER TABLE `garantia_servicio`
  ADD PRIMARY KEY (`id_garantia_servicio`);

--
-- Indices de la tabla `impuestos`
--
ALTER TABLE `impuestos`
  ADD PRIMARY KEY (`id_impuestos`);

--
-- Indices de la tabla `intermedia_inv_prod`
--
ALTER TABLE `intermedia_inv_prod`
  ADD PRIMARY KEY (`id_inv_productos`,`id_articulo_reparar`),
  ADD KEY `id_articulo_reparar` (`id_articulo_reparar`);

--
-- Indices de la tabla `intermedia_inv_rep`
--
ALTER TABLE `intermedia_inv_rep`
  ADD PRIMARY KEY (`id_inv_repuestos`,`id_repuesto`),
  ADD KEY `id_repuesto` (`id_repuesto`);

--
-- Indices de la tabla `intermedia_rep_pres`
--
ALTER TABLE `intermedia_rep_pres`
  ADD PRIMARY KEY (`id_presupuesto`,`id_repuesto`),
  ADD KEY `id_repuesto` (`id_repuesto`);

--
-- Indices de la tabla `inventario_productos`
--
ALTER TABLE `inventario_productos`
  ADD PRIMARY KEY (`id_inv_productos`);

--
-- Indices de la tabla `inventario_repuestos`
--
ALTER TABLE `inventario_repuestos`
  ADD PRIMARY KEY (`id_inv_repuestos`);

--
-- Indices de la tabla `localidad`
--
ALTER TABLE `localidad`
  ADD PRIMARY KEY (`id_localidad`);

--
-- Indices de la tabla `orden_entrega`
--
ALTER TABLE `orden_entrega`
  ADD PRIMARY KEY (`id_orden_entrega`),
  ADD UNIQUE KEY `id_orden_servicio` (`id_orden_servicio`),
  ADD UNIQUE KEY `id_factura_servicio` (`id_factura_servicio`);

--
-- Indices de la tabla `orden_servicio`
--
ALTER TABLE `orden_servicio`
  ADD PRIMARY KEY (`id_orden_servicio`),
  ADD UNIQUE KEY `id_articulo_reparar` (`id_articulo_reparar`),
  ADD UNIQUE KEY `id_presupuesto` (`id_presupuesto`),
  ADD KEY `id_sucursal` (`id_sucursal`),
  ADD KEY `id_cliente` (`id_cliente`);

--
-- Indices de la tabla `pago`
--
ALTER TABLE `pago`
  ADD PRIMARY KEY (`id_pago`);

--
-- Indices de la tabla `precio`
--
ALTER TABLE `precio`
  ADD PRIMARY KEY (`id_precio`);

--
-- Indices de la tabla `presupuestos`
--
ALTER TABLE `presupuestos`
  ADD PRIMARY KEY (`id_presupuesto`);

--
-- Indices de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  ADD PRIMARY KEY (`id_proveedor`),
  ADD UNIQUE KEY `id_repuesto` (`id_repuesto`),
  ADD KEY `id_dire_proveedor` (`id_dire_proveedor`);

--
-- Indices de la tabla `repuestos`
--
ALTER TABLE `repuestos`
  ADD PRIMARY KEY (`id_repuesto`),
  ADD UNIQUE KEY `id_precio` (`id_precio`);

--
-- Indices de la tabla `seguro`
--
ALTER TABLE `seguro`
  ADD PRIMARY KEY (`id_seguro`);

--
-- Indices de la tabla `sucursales`
--
ALTER TABLE `sucursales`
  ADD PRIMARY KEY (`id_sucursal`),
  ADD UNIQUE KEY `id_inv_repuestos` (`id_inv_repuestos`),
  ADD UNIQUE KEY `id_inv_productos` (`id_inv_productos`),
  ADD KEY `id_dire_sucursal` (`id_dire_sucursal`),
  ADD KEY `id_impuestos` (`id_impuestos`);

--
-- Indices de la tabla `sucursales_proveedor`
--
ALTER TABLE `sucursales_proveedor`
  ADD PRIMARY KEY (`id_proveedor`,`id_sucursal`),
  ADD KEY `id_sucursal` (`id_sucursal`);

--
-- Indices de la tabla `sueldo`
--
ALTER TABLE `sueldo`
  ADD PRIMARY KEY (`id_sueldo`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `articulo_reparar`
--
ALTER TABLE `articulo_reparar`
  MODIFY `id_articulo_reparar` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `cliente`
--
ALTER TABLE `cliente`
  MODIFY `id_cliente` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `contrato_empleado`
--
ALTER TABLE `contrato_empleado`
  MODIFY `id_contrato_emple` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `direccion_cliente`
--
ALTER TABLE `direccion_cliente`
  MODIFY `id_dire_cliente` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `direccion_empleado`
--
ALTER TABLE `direccion_empleado`
  MODIFY `id_dire_empleado` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `direccion_proveedor`
--
ALTER TABLE `direccion_proveedor`
  MODIFY `id_dire_proveedor` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `direccion_sucursal`
--
ALTER TABLE `direccion_sucursal`
  MODIFY `id_dire_sucursal` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `empleado`
--
ALTER TABLE `empleado`
  MODIFY `id_empleado` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `factura_servicio`
--
ALTER TABLE `factura_servicio`
  MODIFY `id_factura_servicio` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `garantia_servicio`
--
ALTER TABLE `garantia_servicio`
  MODIFY `id_garantia_servicio` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `impuestos`
--
ALTER TABLE `impuestos`
  MODIFY `id_impuestos` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `inventario_productos`
--
ALTER TABLE `inventario_productos`
  MODIFY `id_inv_productos` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `inventario_repuestos`
--
ALTER TABLE `inventario_repuestos`
  MODIFY `id_inv_repuestos` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `localidad`
--
ALTER TABLE `localidad`
  MODIFY `id_localidad` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `orden_entrega`
--
ALTER TABLE `orden_entrega`
  MODIFY `id_orden_entrega` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `orden_servicio`
--
ALTER TABLE `orden_servicio`
  MODIFY `id_orden_servicio` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `pago`
--
ALTER TABLE `pago`
  MODIFY `id_pago` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `precio`
--
ALTER TABLE `precio`
  MODIFY `id_precio` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `presupuestos`
--
ALTER TABLE `presupuestos`
  MODIFY `id_presupuesto` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  MODIFY `id_proveedor` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `repuestos`
--
ALTER TABLE `repuestos`
  MODIFY `id_repuesto` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `seguro`
--
ALTER TABLE `seguro`
  MODIFY `id_seguro` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `sucursales`
--
ALTER TABLE `sucursales`
  MODIFY `id_sucursal` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `sueldo`
--
ALTER TABLE `sueldo`
  MODIFY `id_sueldo` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD CONSTRAINT `cliente_ibfk_1` FOREIGN KEY (`id_dire_cliente`) REFERENCES `direccion_cliente` (`id_dire_cliente`);

--
-- Filtros para la tabla `contrato_empleado`
--
ALTER TABLE `contrato_empleado`
  ADD CONSTRAINT `contrato_empleado_ibfk_1` FOREIGN KEY (`id_sueldo`) REFERENCES `sueldo` (`id_sueldo`);

--
-- Filtros para la tabla `direccion_cliente`
--
ALTER TABLE `direccion_cliente`
  ADD CONSTRAINT `direccion_cliente_ibfk_1` FOREIGN KEY (`id_localidad`) REFERENCES `localidad` (`id_localidad`);

--
-- Filtros para la tabla `direccion_empleado`
--
ALTER TABLE `direccion_empleado`
  ADD CONSTRAINT `direccion_empleado_ibfk_1` FOREIGN KEY (`id_localidad`) REFERENCES `localidad` (`id_localidad`);

--
-- Filtros para la tabla `direccion_proveedor`
--
ALTER TABLE `direccion_proveedor`
  ADD CONSTRAINT `direccion_proveedor_ibfk_1` FOREIGN KEY (`id_localidad`) REFERENCES `localidad` (`id_localidad`);

--
-- Filtros para la tabla `direccion_sucursal`
--
ALTER TABLE `direccion_sucursal`
  ADD CONSTRAINT `direccion_sucursal_ibfk_1` FOREIGN KEY (`id_localidad`) REFERENCES `localidad` (`id_localidad`);

--
-- Filtros para la tabla `empleado`
--
ALTER TABLE `empleado`
  ADD CONSTRAINT `empleado_ibfk_1` FOREIGN KEY (`id_dire_empleado`) REFERENCES `direccion_empleado` (`id_dire_empleado`),
  ADD CONSTRAINT `empleado_ibfk_2` FOREIGN KEY (`id_contrato_emple`) REFERENCES `contrato_empleado` (`id_contrato_emple`),
  ADD CONSTRAINT `empleado_ibfk_3` FOREIGN KEY (`id_sucursal`) REFERENCES `sucursales` (`id_sucursal`),
  ADD CONSTRAINT `fk_empleado_seguro` FOREIGN KEY (`id_seguro`) REFERENCES `seguro` (`id_seguro`);

--
-- Filtros para la tabla `factura_servicio`
--
ALTER TABLE `factura_servicio`
  ADD CONSTRAINT `factura_servicio_ibfk_1` FOREIGN KEY (`id_pago`) REFERENCES `pago` (`id_pago`),
  ADD CONSTRAINT `factura_servicio_ibfk_3` FOREIGN KEY (`id_presupuesto`) REFERENCES `presupuestos` (`id_presupuesto`),
  ADD CONSTRAINT `fk_factura_garantia` FOREIGN KEY (`id_garantia_servicio`) REFERENCES `garantia_servicio` (`id_garantia_servicio`);

--
-- Filtros para la tabla `intermedia_inv_prod`
--
ALTER TABLE `intermedia_inv_prod`
  ADD CONSTRAINT `intermedia_inv_prod_ibfk_1` FOREIGN KEY (`id_inv_productos`) REFERENCES `inventario_productos` (`id_inv_productos`),
  ADD CONSTRAINT `intermedia_inv_prod_ibfk_2` FOREIGN KEY (`id_articulo_reparar`) REFERENCES `articulo_reparar` (`id_articulo_reparar`);

--
-- Filtros para la tabla `intermedia_inv_rep`
--
ALTER TABLE `intermedia_inv_rep`
  ADD CONSTRAINT `intermedia_inv_rep_ibfk_1` FOREIGN KEY (`id_inv_repuestos`) REFERENCES `inventario_repuestos` (`id_inv_repuestos`),
  ADD CONSTRAINT `intermedia_inv_rep_ibfk_2` FOREIGN KEY (`id_repuesto`) REFERENCES `repuestos` (`id_repuesto`);

--
-- Filtros para la tabla `intermedia_rep_pres`
--
ALTER TABLE `intermedia_rep_pres`
  ADD CONSTRAINT `intermedia_rep_pres_ibfk_1` FOREIGN KEY (`id_presupuesto`) REFERENCES `presupuestos` (`id_presupuesto`),
  ADD CONSTRAINT `intermedia_rep_pres_ibfk_2` FOREIGN KEY (`id_repuesto`) REFERENCES `repuestos` (`id_repuesto`);

--
-- Filtros para la tabla `orden_entrega`
--
ALTER TABLE `orden_entrega`
  ADD CONSTRAINT `orden_entrega_ibfk_1` FOREIGN KEY (`id_orden_servicio`) REFERENCES `orden_servicio` (`id_orden_servicio`),
  ADD CONSTRAINT `orden_entrega_ibfk_2` FOREIGN KEY (`id_factura_servicio`) REFERENCES `factura_servicio` (`id_factura_servicio`);

--
-- Filtros para la tabla `orden_servicio`
--
ALTER TABLE `orden_servicio`
  ADD CONSTRAINT `orden_servicio_ibfk_1` FOREIGN KEY (`id_sucursal`) REFERENCES `sucursales` (`id_sucursal`),
  ADD CONSTRAINT `orden_servicio_ibfk_2` FOREIGN KEY (`id_articulo_reparar`) REFERENCES `articulo_reparar` (`id_articulo_reparar`),
  ADD CONSTRAINT `orden_servicio_ibfk_3` FOREIGN KEY (`id_presupuesto`) REFERENCES `presupuestos` (`id_presupuesto`),
  ADD CONSTRAINT `orden_servicio_ibfk_4` FOREIGN KEY (`id_cliente`) REFERENCES `cliente` (`id_cliente`);

--
-- Filtros para la tabla `proveedor`
--
ALTER TABLE `proveedor`
  ADD CONSTRAINT `proveedor_ibfk_1` FOREIGN KEY (`id_dire_proveedor`) REFERENCES `direccion_proveedor` (`id_dire_proveedor`),
  ADD CONSTRAINT `proveedor_ibfk_2` FOREIGN KEY (`id_repuesto`) REFERENCES `repuestos` (`id_repuesto`);

--
-- Filtros para la tabla `repuestos`
--
ALTER TABLE `repuestos`
  ADD CONSTRAINT `repuestos_ibfk_1` FOREIGN KEY (`id_precio`) REFERENCES `precio` (`id_precio`);

--
-- Filtros para la tabla `sucursales`
--
ALTER TABLE `sucursales`
  ADD CONSTRAINT `sucursales_ibfk_1` FOREIGN KEY (`id_dire_sucursal`) REFERENCES `direccion_sucursal` (`id_dire_sucursal`),
  ADD CONSTRAINT `sucursales_ibfk_2` FOREIGN KEY (`id_inv_repuestos`) REFERENCES `inventario_repuestos` (`id_inv_repuestos`),
  ADD CONSTRAINT `sucursales_ibfk_3` FOREIGN KEY (`id_inv_productos`) REFERENCES `inventario_productos` (`id_inv_productos`),
  ADD CONSTRAINT `sucursales_ibfk_4` FOREIGN KEY (`id_impuestos`) REFERENCES `impuestos` (`id_impuestos`);

--
-- Filtros para la tabla `sucursales_proveedor`
--
ALTER TABLE `sucursales_proveedor`
  ADD CONSTRAINT `sucursales_proveedor_ibfk_1` FOREIGN KEY (`id_proveedor`) REFERENCES `proveedor` (`id_proveedor`),
  ADD CONSTRAINT `sucursales_proveedor_ibfk_2` FOREIGN KEY (`id_sucursal`) REFERENCES `sucursales` (`id_sucursal`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
