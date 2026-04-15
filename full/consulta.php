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

echo json_encode(['error' => "Acción desconocida: $accion"]);
?>