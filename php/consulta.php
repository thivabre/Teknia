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

if ($accion == 'consulta_precio') {
    $resultado = $BD->query("SELECT precio_mano_obra, precio_rep FROM precio ORDER BY precio_mano_obra ASC");
    $datos = [];

    while ($fila = $resultado->fetch_assoc()) {
        $datos[] = $fila;
    }

    echo json_encode($datos);
    exit();
}

if ($accion == 'consulta_articulo_reparar') {
    $resultado = $BD->query("SELECT nombre_art_rep, tipo_art_rep, fallas FROM articulo_reparar ORDER BY nombre_art_rep ASC");
    $datos = [];

    while ($fila = $resultado->fetch_assoc()) {
        $datos[] = $fila;
    }

    echo json_encode($datos);
    exit();
}

if ($accion == 'consulta_pago') {
    $resultado = $BD->query("SELECT nombre_banco, numero_cuenta, comprobante FROM pago ORDER BY nombre_banco ASC");
    $datos = [];

    while ($fila = $resultado->fetch_assoc()) {
        $datos[] = $fila;
    }

    echo json_encode($datos);
    exit();
}

if ($accion == 'consulta_localidad') {
    $resultado = $BD->query("SELECT pais, provincia, ciudad, barrio FROM localidad ORDER BY pais ASC");
    $datos = [];

    while ($fila = $resultado->fetch_assoc()) {
        $datos[] = $fila;
    }

    echo json_encode($datos);
    exit();
}

?>