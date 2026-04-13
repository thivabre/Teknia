<?php include ("conexion.php");?>

<?php
$accion = $_POST['accion'];

if ($accion == 'insert_precio') {
    $precio_mano_obra = $_POST['precio_mano_obra'];
    $precio_rep = $_POST['precio_rep'];

    $sql = "INSERT INTO precio (precio_mano_obra, precio_rep) VALUES ('$precio_mano_hora', '$precio_rep')";
    $resultado = $BD->query($sql);

    if ($resultado) {
        echo json_encode(['estado' => 'ok', 'mensaje' => 'Registro insertado correctamente']);
    } else {
        echo json_encode(['estado' => 'error', 'mensaje' => 'Error al insertar']);
    }
}

if ($accion == 'insert_articulo_reparar') {
    $nombre_art_rep = $_POST['nombre_art_rep'];
    $tipo_art_rep = $_POST['tipo_art_rep'];
    $fallas = $_POST['fallas'];

    $sql = "INSERT INTO articulo_reparar (nombre_art_rep, tipo_art_rep, fallas) VALUES ('$nombre_art_rep', '$tipo_art_rep', '$fallas')";
    $resultado = $BD->query($sql);

    if ($resultado) {
        echo json_encode(['estado' => 'ok', 'mensaje' => 'Registro insertado correctamente']);
    } else {
        echo json_encode(['estado' => 'error', 'mensaje' => 'Error al insertar']);
    }
}


if ($accion == 'insert_pago') {
    $nombre_banco = $_POST['nombre_banco'];
    $numero_cuenta = $_POST['numero_cuenta'];
    $comprobante = $_POST['comprobante'];

    $sql = "INSERT INTO pago (nombre_banco, numero_cuenta, comprobante) VALUES ('$nombre_banco', '$numero_cuenta', '$comprobante')";
    $resultado = $BD->query($sql);

    if ($resultado) {
        echo json_encode(['estado' => 'ok', 'mensaje' => 'Registro insertado correctamente']);
    } else {
        echo json_encode(['estado' => 'error', 'mensaje' => 'Error al insertar']);
    }
}


if ($accion == 'insert_localidad') {
    $pais = $_POST['pais'];
    $provincia = $_POST['provincia'];
    $ciudad = $_POST['ciudad'];
    $barrio = $_POST['barrio'];

    $sql = "INSERT INTO localidad (pais, provincia, ciudad, barrio) VALUES ('$pais', '$provincia', '$ciudad', '$barrio')";
    $resultado = $BD->query($sql);

    if ($resultado) {
        echo json_encode(['estado' => 'ok', 'mensaje' => 'Registro insertado correctamente']);
    } else {
        echo json_encode(['estado' => 'error', 'mensaje' => 'Error al insertar']);
    }
}

?>