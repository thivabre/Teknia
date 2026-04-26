<?php
ini_set('display_errors', 0);
error_reporting(0);

header('Content-Type: application/json');

include("conexion.php");

if (!isset($BD) || $BD->connect_error) {
    echo json_encode(['error' => 'Error de conexión: ' . ($BD->connect_error ?? 'variable $BD no definida')]);
    exit();
}

if (!isset($_GET['accion'])) {
    echo json_encode(['error' => 'Parámetro accion no recibido']);
    exit();
}

$accion = $_GET['accion'];

function consultarYResponder($BD, $sql) {
    $resultado = $BD->query($sql);
    if (!$resultado) {
        echo json_encode(['error' => 'Error en query: ' . $BD->error]);
        exit();
    }
    $datos = [];
    while ($fila = $resultado->fetch_assoc()) {
        $datos[] = $fila;
    }
    echo json_encode($datos);
    exit();
}

if ($accion == 'consulta_seguro') {
    consultarYResponder($BD, "SELECT id_seguro, tipo_seg, nombre_aseg, monto_aseg FROM seguro ORDER BY nombre_aseg ASC");
}

if ($accion == 'consulta_sueldo') {
    consultarYResponder($BD, "SELECT id_sueldo, sueldo_hora, sueldo_hora_ext, forma_pago FROM sueldo ORDER BY forma_pago ASC");
}

if ($accion == 'consulta_impuesto') {
    consultarYResponder($BD, "SELECT id_impuestos, tipo_imp, monto_imp FROM impuestos ORDER BY tipo_imp ASC");
}

if ($accion == 'consulta_garantia_servicio') {
    consultarYResponder($BD, "SELECT id_garantia_servicio, tipo_garantia, tiempo_garantia FROM garantia_servicio ORDER BY tipo_garantia ASC");
}

if ($accion == 'consulta_precio') {
    consultarYResponder($BD, "SELECT id_precio, precio_mano_obra, precio_rep FROM precio ORDER BY precio_mano_obra ASC");
}

if ($accion == 'consulta_articulo_reparar') {
    consultarYResponder($BD, "SELECT id_articulo_reparar, nombre_art_rep, tipo_art_rep, fallas FROM articulo_reparar ORDER BY nombre_art_rep ASC");
}

if ($accion == 'consulta_pago') {
    consultarYResponder($BD, "SELECT id_pago, nombre_banco, numero_cuenta, comprobante FROM pago ORDER BY nombre_banco ASC");
}

if ($accion == 'consulta_localidad') {
    consultarYResponder($BD, "SELECT id_localidad, pais, provincia, ciudad, barrio FROM localidad ORDER BY pais ASC");
}

if ($accion == 'consulta_direccion_empleado') {
    consultarYResponder($BD, "SELECT id_dire_empleado, calle_emp, altura_emp, cod_postal_emp, id_localidad FROM direccion_empleado ORDER BY calle_emp ASC");
}

if ($accion == 'consulta_direccion_cliente') {
    consultarYResponder($BD, "SELECT id_dire_cliente, calle_cli, altura_cli, cod_postal_cli, id_localidad FROM direccion_cliente ORDER BY calle_cli ASC");
}

if ($accion == 'consulta_direccion_sucursal') {
    consultarYResponder($BD, "SELECT id_dire_sucursal, calle_suc, altura_suc, cod_postal_suc, id_localidad FROM direccion_sucursal ORDER BY calle_suc ASC");
}

if ($accion == 'consulta_direccion_proveedor') {
    consultarYResponder($BD, "SELECT id_dire_proveedor, calle_prov, altura_prov, cod_postal_prov, id_localidad FROM direccion_proveedor ORDER BY calle_prov ASC");
}

if ($accion == 'consulta_inventario_productos') {
    consultarYResponder($BD, "SELECT id_inv_productos, cantidad_prod, id_articulo_reparar FROM inventario_productos ORDER BY id_inv_productos ASC");
}

if ($accion == 'consulta_inventario_repuestos') {
    consultarYResponder($BD, "SELECT ir.id_inv_repuestos, ir.cantidad_rep, iir.id_repuesto FROM inventario_repuestos ir LEFT JOIN intermedia_inv_rep iir ON ir.id_inv_repuestos = iir.id_inv_repuestos ORDER BY ir.id_inv_repuestos ASC");
}

if ($accion == 'consulta_contrato_empleado') {
    consultarYResponder($BD, "SELECT id_contrato_emple, fecha_cont, turno, id_sueldo FROM contrato_empleado ORDER BY fecha_cont ASC");
}

if ($accion == 'consulta_repuestos') {
    consultarYResponder($BD, "SELECT id_repuesto, nombre_rep, tipo_rep, id_precio FROM repuestos ORDER BY nombre_rep ASC");
}

if ($accion == 'consulta_factura_servicio') {
    consultarYResponder($BD, "SELECT id_factura_servicio, fecha_factura, id_pago, id_garantia_servicio FROM factura_servicio ORDER BY fecha_factura ASC");
}

if ($accion == 'consulta_proveedor') {
    consultarYResponder($BD, "SELECT id_proveedor, nombre_prov, id_dire_proveedor, id_repuesto FROM proveedor ORDER BY nombre_prov ASC");
}

if ($accion == 'consulta_presupuestos') {
    consultarYResponder($BD, "SELECT p.id_presupuesto, p.precio_reparacion_tot, irp.id_repuesto FROM presupuestos p LEFT JOIN intermedia_rep_pres irp ON p.id_presupuesto = irp.id_presupuesto ORDER BY p.id_presupuesto ASC");
}

if ($accion == 'consulta_sucursales') {
    consultarYResponder($BD, "SELECT id_sucursal, cant_empleados, reparaciones_hechas, id_dire_sucursal, id_inv_repuestos, id_inv_productos, id_impuestos FROM sucursales ORDER BY id_sucursal ASC");
}

if ($accion == 'consulta_empleado') {
    consultarYResponder($BD, "SELECT id_empleado, nombre_emple, apellido_emple, dni_emple, telefono_emple, horas_trabajdas, horas_extra, jefe_sucursal, jefe_general, id_dire_empleado, id_contrato_emple, id_sucursal, id_seguro FROM empleado ORDER BY apellido_emple ASC");
}

if ($accion == 'consulta_sucursales_proveedor') {
    consultarYResponder($BD, "SELECT id_proveedor, id_sucursal FROM sucursales_proveedor ORDER BY id_sucursal ASC");
}

if ($accion == 'consulta_orden_servicio') {
    consultarYResponder($BD, "SELECT id_orden_servicio, fecha_orden, fecha_est_fin, id_sucursal, id_articulo_reparar, id_presupuesto, id_cliente FROM orden_servicio ORDER BY fecha_orden ASC");
}

if ($accion == 'consulta_cliente') {
    consultarYResponder($BD, "SELECT id_cliente, nombre_cli, apellido_cli, dni_cli, telefono_cli, id_dire_cliente, id_orden_servicio FROM cliente ORDER BY apellido_cli ASC");
}

if ($accion == 'consulta_orden_entrega') {
    consultarYResponder($BD, "SELECT id_orden_entrega, fecha_entrega, id_orden_servicio, id_factura_servicio FROM orden_entrega ORDER BY fecha_entrega ASC");
}

if ($accion == 'consulta_intermedia_inv_rep') {
    consultarYResponder($BD, "SELECT id_inv_repuestos, id_repuesto FROM intermedia_inv_rep ORDER BY id_inv_repuestos ASC");
}

if ($accion == 'consulta_repuestos_nombre') {
    consultarYResponder($BD, "SELECT nombre_rep FROM repuestos");
}

if ($accion == 'consulta_sucursales_id') {
    consultarYResponder($BD, "SELECT id_sucursal FROM sucursales");
}

if ($accion == 'consulta_tipo_impuesto') {
    consultarYResponder($BD, "SELECT tipo_imp FROM impuestos");
}

if ($accion == 'consulta_intermedia_rep_pres') {
    consultarYResponder($BD, "SELECT id_presupuesto, id_repuesto FROM intermedia_rep_pres ORDER BY id_presupuesto ASC");
}

if ($accion == 'consulta_ordenes_activas') {
    $sql = "SELECT os.id_orden_servicio, ar.nombre_art_rep, ar.tipo_art_rep, ar.fallas,
    os.fecha_orden, os.fecha_est_fin, os.id_sucursal
    FROM orden_servicio os
    JOIN articulo_reparar ar ON os.id_articulo_reparar = ar.id_articulo_reparar
    LEFT JOIN orden_entrega oe ON os.id_orden_servicio = oe.id_orden_servicio
    WHERE oe.id_orden_entrega IS NULL
    ORDER BY os.fecha_orden ASC";
    consultarYResponder($BD, $sql);
}

if ($accion == 'consulta_ordenes_activas_por_cliente') {
    $id_cliente = intval($_GET['id_cliente']);
    $sql = "SELECT os.id_orden_servicio, ar.nombre_art_rep, ar.tipo_art_rep, ar.fallas,
    os.fecha_orden, os.fecha_est_fin, os.id_sucursal
    FROM orden_servicio os
    JOIN articulo_reparar ar ON os.id_articulo_reparar = ar.id_articulo_reparar
    LEFT JOIN orden_entrega oe ON os.id_orden_servicio = oe.id_orden_servicio
    WHERE oe.id_orden_entrega IS NULL
    AND os.id_cliente = $id_cliente
    ORDER BY os.fecha_orden ASC";
    consultarYResponder($BD, $sql);
}

if ($accion == 'consulta_historial_ordenes') {
    $sql = "SELECT os.id_orden_servicio, ar.nombre_art_rep, ar.tipo_art_rep, ar.fallas,
    os.fecha_orden, oe.fecha_entrega, os.id_sucursal, fs.fecha_factura
    FROM orden_servicio os
    JOIN articulo_reparar ar ON os.id_articulo_reparar = ar.id_articulo_reparar
    JOIN orden_entrega oe ON os.id_orden_servicio = oe.id_orden_servicio
    JOIN factura_servicio fs ON oe.id_factura_servicio = fs.id_factura_servicio
    ORDER BY oe.fecha_entrega DESC";
    consultarYResponder($BD, $sql);
}

if ($accion == 'consulta_historial_ordenes_por_cliente') {
    $id_cliente = intval($_GET['id_cliente']);
    $sql = "SELECT os.id_orden_servicio, ar.nombre_art_rep, ar.tipo_art_rep, ar.fallas,
    os.fecha_orden, oe.fecha_entrega, os.id_sucursal, fs.fecha_factura
    FROM orden_servicio os
    JOIN articulo_reparar ar ON os.id_articulo_reparar = ar.id_articulo_reparar
    JOIN orden_entrega oe ON os.id_orden_servicio = oe.id_orden_servicio
    JOIN factura_servicio fs ON oe.id_factura_servicio = fs.id_factura_servicio
    WHERE os.id_cliente = $id_cliente
    ORDER BY oe.fecha_entrega DESC";
    consultarYResponder($BD, $sql);
}

if ($accion == 'consulta_pagos_detalle') {
    $sql = "SELECT p.id_pago, p.nombre_banco, p.numero_cuenta, p.comprobante,
    pr.precio_reparacion_tot AS monto, fs.fecha_factura
    FROM pago p
    JOIN factura_servicio fs ON p.id_pago = fs.id_pago
    JOIN orden_entrega oe ON fs.id_factura_servicio = oe.id_factura_servicio
    JOIN orden_servicio os ON oe.id_orden_servicio = os.id_orden_servicio
    JOIN presupuestos pr ON os.id_presupuesto = pr.id_presupuesto
    ORDER BY fs.fecha_factura DESC";
    consultarYResponder($BD, $sql);
}

if ($accion == 'consulta_pagos_por_cliente') {
    $id_cliente = intval($_GET['id_cliente']);
    $sql = "SELECT p.id_pago, p.nombre_banco, p.numero_cuenta, p.comprobante,
    pr.precio_reparacion_tot AS monto, fs.fecha_factura
    FROM pago p
    JOIN factura_servicio fs ON p.id_pago = fs.id_pago
    JOIN orden_entrega oe ON fs.id_factura_servicio = oe.id_factura_servicio
    JOIN orden_servicio os ON oe.id_orden_servicio = os.id_orden_servicio
    JOIN presupuestos pr ON os.id_presupuesto = pr.id_presupuesto
    WHERE os.id_cliente = $id_cliente
    ORDER BY fs.fecha_factura DESC";
    consultarYResponder($BD, $sql);
}

if ($accion == 'consulta_presupuestos_detalle') {
    $sql = "SELECT p.id_presupuesto, p.precio_reparacion_tot,
    GROUP_CONCAT(r.nombre_rep ORDER BY r.nombre_rep SEPARATOR ', ') AS nombres_repuestos,
    GROUP_CONCAT(r.tipo_rep   ORDER BY r.nombre_rep SEPARATOR ', ') AS tipos_repuestos
    FROM presupuestos p
    LEFT JOIN intermedia_rep_pres irp ON p.id_presupuesto = irp.id_presupuesto
    LEFT JOIN repuestos r ON irp.id_repuesto = r.id_repuesto
    GROUP BY p.id_presupuesto
    ORDER BY p.id_presupuesto ASC";
    consultarYResponder($BD, $sql);
}

if ($accion == 'consulta_presupuestos_por_cliente') {
    $id_cliente = intval($_GET['id_cliente']);
    $sql = "SELECT p.id_presupuesto, p.precio_reparacion_tot,
    GROUP_CONCAT(r.nombre_rep ORDER BY r.nombre_rep SEPARATOR ', ') AS nombres_repuestos,
    GROUP_CONCAT(r.tipo_rep   ORDER BY r.nombre_rep SEPARATOR ', ') AS tipos_repuestos
    FROM presupuestos p
    LEFT JOIN intermedia_rep_pres irp ON p.id_presupuesto = irp.id_presupuesto
    LEFT JOIN repuestos r ON irp.id_repuesto = r.id_repuesto
    JOIN orden_servicio os ON p.id_presupuesto = os.id_presupuesto
    WHERE os.id_cliente = $id_cliente
    GROUP BY p.id_presupuesto
    ORDER BY p.id_presupuesto ASC";
    consultarYResponder($BD, $sql);
}

if ($accion == 'consulta_ubicacion_sucursales') {
    $sql = "SELECT s.id_sucursal, l.pais, l.provincia, l.ciudad, l.barrio,
    ds.cod_postal_suc,
    CONCAT(ds.calle_suc, ' ', ds.altura_suc) AS direccion
    FROM sucursales s
    JOIN direccion_sucursal ds ON s.id_dire_sucursal = ds.id_dire_sucursal
    JOIN localidad l ON ds.id_localidad = l.id_localidad
    ORDER BY s.id_sucursal ASC";
    consultarYResponder($BD, $sql);
}

if ($accion == 'consulta_info_sucursales') {
    $sql = "SELECT s.id_sucursal, s.cant_empleados, s.reparaciones_hechas,
    s.id_inv_repuestos, s.id_inv_productos,
    i.tipo_imp, i.monto_imp
    FROM sucursales s
    JOIN impuestos i ON s.id_impuestos = i.id_impuestos
    ORDER BY s.id_sucursal ASC";
    consultarYResponder($BD, $sql);
}

if ($accion == 'consulta_inv_repuestos_detalle') {
    $sql = "SELECT ir.id_inv_repuestos,
    GROUP_CONCAT(r.nombre_rep ORDER BY r.nombre_rep SEPARATOR ', ') AS nombres_repuestos,
    GROUP_CONCAT(r.tipo_rep   ORDER BY r.nombre_rep SEPARATOR ', ') AS tipos_repuestos,
    ir.cantidad_rep
    FROM inventario_repuestos ir
    LEFT JOIN intermedia_inv_rep iir ON ir.id_inv_repuestos = iir.id_inv_repuestos
    LEFT JOIN repuestos r ON iir.id_repuesto = r.id_repuesto
    GROUP BY ir.id_inv_repuestos
    ORDER BY ir.id_inv_repuestos ASC";
    consultarYResponder($BD, $sql);
}

if ($accion == 'consulta_inv_productos_detalle') {
    $sql = "SELECT ip.id_inv_productos,
    ar.nombre_art_rep AS nombre_producto,
    ar.tipo_art_rep   AS tipo_producto,
    ar.fallas,
    ip.cantidad_prod
    FROM inventario_productos ip
    JOIN articulo_reparar ar ON ip.id_articulo_reparar = ar.id_articulo_reparar
    ORDER BY ar.nombre_art_rep ASC";
    consultarYResponder($BD, $sql);
}

if ($accion == 'consulta_repuestos_detalle') {
    $sql = "SELECT r.id_repuesto, r.nombre_rep, r.tipo_rep,
    p.precio_rep AS precio_unidad, p.precio_mano_obra
    FROM repuestos r
    JOIN precio p ON r.id_precio = p.id_precio
    ORDER BY r.nombre_rep ASC";
    consultarYResponder($BD, $sql);
}

if ($accion == 'consulta_clientes_detalle') {
    $sql = "SELECT c.id_cliente, c.nombre_cli, c.apellido_cli, c.dni_cli, c.telefono_cli,
    CONCAT(dc.calle_cli, ' ', dc.altura_cli) AS direccion,
    dc.cod_postal_cli
    FROM cliente c
    JOIN direccion_cliente dc ON c.id_dire_cliente = dc.id_dire_cliente
    ORDER BY c.apellido_cli ASC";
    consultarYResponder($BD, $sql);
}

if ($accion == 'consulta_empleados_regulares') {
    $sql = "SELECT e.id_empleado, e.nombre_emple, e.apellido_emple, e.dni_emple,
    e.telefono_emple, e.horas_trabajdas, e.horas_extra,
    CONCAT(de.calle_emp, ' ', de.altura_emp) AS direccion,
    e.id_contrato_emple, e.id_sucursal, e.id_seguro
    FROM empleado e
    JOIN direccion_empleado de ON e.id_dire_empleado = de.id_dire_empleado
    WHERE e.jefe_sucursal = 0 AND e.jefe_general = 0
    ORDER BY e.apellido_emple ASC";
    consultarYResponder($BD, $sql);
}

if ($accion == 'consulta_jefes_sucursal') {
    $sql = "SELECT e.id_empleado, e.nombre_emple, e.apellido_emple, e.dni_emple,
    e.telefono_emple, e.horas_trabajdas, e.horas_extra,
    CONCAT(de.calle_emp, ' ', de.altura_emp) AS direccion,
    e.id_contrato_emple, e.id_sucursal, e.id_seguro
    FROM empleado e
    JOIN direccion_empleado de ON e.id_dire_empleado = de.id_dire_empleado
    WHERE e.jefe_sucursal = 1
    ORDER BY e.apellido_emple ASC";
    consultarYResponder($BD, $sql);
}

if ($accion == 'consulta_jefes_generales') {
    $sql = "SELECT e.id_empleado, e.nombre_emple, e.apellido_emple, e.dni_emple,
    e.telefono_emple, e.horas_trabajdas, e.horas_extra,
    CONCAT(de.calle_emp, ' ', de.altura_emp) AS direccion,
    e.id_contrato_emple, e.id_sucursal, e.id_seguro
    FROM empleado e
    JOIN direccion_empleado de ON e.id_dire_empleado = de.id_dire_empleado
    WHERE e.jefe_sucursal = 1 AND e.jefe_general = 1
    ORDER BY e.apellido_emple ASC";
    consultarYResponder($BD, $sql);
}

if ($accion == 'consulta_contratos_detalle') {
    $sql = "SELECT ce.id_contrato_emple, ce.fecha_cont, ce.turno,
    s.sueldo_hora, s.sueldo_hora_ext
    FROM contrato_empleado ce
    JOIN sueldo s ON ce.id_sueldo = s.id_sueldo
    ORDER BY ce.fecha_cont ASC";
    consultarYResponder($BD, $sql);
}

if ($accion == 'consulta_proveedores_detalle') {
    $sql = "SELECT prov.id_proveedor, prov.nombre_prov,
    CONCAT(dp.calle_prov, ' ', dp.altura_prov) AS direccion,
    dp.cod_postal_prov,
    GROUP_CONCAT(DISTINCT sp.id_sucursal ORDER BY sp.id_sucursal SEPARATOR ', ') AS sucursales,
    r.nombre_rep, r.tipo_rep
    FROM proveedor prov
    JOIN direccion_proveedor dp ON prov.id_dire_proveedor = dp.id_dire_proveedor
    JOIN repuestos r ON prov.id_repuesto = r.id_repuesto
    LEFT JOIN sucursales_proveedor sp ON prov.id_proveedor = sp.id_proveedor
    GROUP BY prov.id_proveedor
    ORDER BY prov.nombre_prov ASC";
    consultarYResponder($BD, $sql);
}

echo json_encode(['error' => "Acción desconocida: $accion"]);
?>
