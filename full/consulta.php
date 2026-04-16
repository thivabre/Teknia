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
    consultarYResponder($BD, "SELECT id_inv_repuestos, cantidad_rep, id_repuesto FROM inventario_repuestos ORDER BY id_inv_repuestos ASC");
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
    consultarYResponder($BD, "SELECT id_presupuesto, precio_reparacion_tot, id_repuesto FROM presupuestos ORDER BY id_presupuesto ASC");
}

if ($accion == 'consulta_sucursales') {
    consultarYResponder($BD, "SELECT id_sucursal, cant_empleados, reparaciones_hechas, id_dire_sucursal, id_inv_repuestos, id_inv_productos, id_impuestos FROM sucursales ORDER BY id_sucursal ASC");
}

if ($accion == 'consulta_empleado') {
    consultarYResponder($BD, "SELECT id_empleado, nombre_emple, apellido_emple, dni_emple, telefono_emple, horas_trabajdas, horas_extra, id_dire_empleado, id_contrato_emple, id_sucursal, id_seguro FROM empleado ORDER BY apellido_emple ASC");
}

if ($accion == 'consulta_sucursales_proveedor') {
    consultarYResponder($BD, "SELECT id_proveedor, id_sucursal FROM sucursales_proveedor ORDER BY id_sucursal ASC");
}

if ($accion == 'consulta_orden_servicio') {
    consultarYResponder($BD, "SELECT id_orden_servicio, fecha_orden, fecha_est_fin, id_sucursal, id_articulo_reparar, id_presupuesto FROM orden_servicio ORDER BY fecha_orden ASC");
}

if ($accion == 'consulta_cliente') {
    consultarYResponder($BD, "SELECT id_cliente, nombre_cli, apellido_cli, dni_cli, telefono_cli, id_dire_cliente, id_orden_servicio FROM cliente ORDER BY apellido_cli ASC");
}

if ($accion == 'consulta_orden_entrega') {
    consultarYResponder($BD, "SELECT id_orden_entrega, fecha_entrega, id_orden_servicio, id_factura_servicio FROM orden_entrega ORDER BY fecha_entrega ASC");
}

echo json_encode(['error' => "Acción desconocida: $accion"]);
?>