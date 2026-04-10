<?php include ("conexion.php");?>

<?php
$accion = $_GET['accion']; // Leemos el parámetro de la URL

if ($accion == 'consulta_seguro') {
    $resultado = $BD->query("SELECT tipo_seg, nombre_aseg, monto_aseg FROM seguro ORDER BY nombre_aseg ASC");
    $datos = [];
    while ($fila = $resultado->fetch_assoc()) {
        $datos[] = $fila;
    }
    echo json_encode($datos);
    exit();
}

if ($accion == 'consulta_sueldo') {
    $resultado = $BD->query("SELECT sueldo_hora, sueldo_hora_ext, forma_pago FROM sueldo ORDER BY forma_pago ASC");
    $datos = [];
    while ($fila = $resultado->fetch_assoc()) {
        $datos[] = $fila;
    }
    echo json_encode($datos);
    exit();
}

if ($accion == 'consulta_impuesto') {
    $resultado = $BD->query("SELECT tipo_imp, monto_imp FROM impuestos ORDER BY tipo_imp ASC");
    $datos = [];
    while ($fila = $resultado->fetch_assoc()) {
        $datos[] = $fila;
    }
    echo json_encode($datos);
    exit();
}

if ($accion == 'consulta_garantia') {
    $resultado = $BD->query("SELECT tipo_garantia, tiempo_garantia FROM garantia_servicio ORDER BY tipo_garantia ASC");
    $datos = [];
    while ($fila = $resultado->fetch_assoc()) {
        $datos[] = $fila;
    }
    echo json_encode($datos);
    exit();
}


?>



