// precio, articulo reparar, pago, localidad

<?php include ("conexion.php");?>

<?php

if ($accion == 'delete_localidad') {
    $pais = $_POST['pais'];
    $provincia = $_POST['provincia'];
    $ciudad = $_POST['ciudad'];
    $barrio = $_POST['barrio'];

    $sql = "DELETE FROM localidad WHERE pais = '$pais' AND provincia = '$provincia' AND ciudad = '$ciudad' AND barrio = '$barrio'";
    $resultado = $BD->query($sql);

    if ($resultado) {
        echo json_encode(['estado' => 'ok', 'mensaje' => 'Registro eliminado correctamente']);
    } else {
        echo json_encode(['estado' => 'error', 'mensaje' => 'Error al eliminar']);
    }
}

if ($accion == 'delete_precio') {
    $precio_mano_obra = $_POST['precio_mano_obra'];
    $precio_rep = $_POST['precio_rep'];

    $sql = "DELETE FROM precio WHERE precio_mano_obra = '$precio_mano_obra' AND precio_rep = '$precio_rep'";
    $resultado = $BD->query($sql);

    if ($resultado) {
        echo json_encode(['estado' => 'ok', 'mensaje' => 'Registro eliminado correctamente']);
    } else {
        echo json_encode(['estado' => 'error', 'mensaje' => 'Error al eliminar']);
    }
}

if ($accion == 'delete_articulo_reparar') {
    $nombre_art_rep = $_POST['nombre_art_rep'];
    $tipo_art_rep = $_POST['tipo_art_rep'];
    $fallas = $_POST['fallas'];

    $sql = "DELETE FROM articulo_reparar WHERE nombre_art_rep = '$nombre_art_rep' AND tipo_art_rep = '$tipo_art_rep' AND fallas = '$fallas'";
    $resultado = $BD->query($sql);

    if ($resultado) {
        echo json_encode(['estado' => 'ok', 'mensaje' => 'Registro eliminado correctamente']);
    } else {
        echo json_encode(['estado' => 'error', 'mensaje' => 'Error al eliminar']);
    }
}

if ($accion == 'delete_pago') {
    $nombre_banco = $_POST['nombre_banco'];
    $numero_cuenta = $_POST['numero_cuenta'];
    $comprobante = $_POST['comprobante'];

    $sql = "DELETE FROM pago WHERE nombre_banco = '$nombre_banco' AND numero_cuenta = '$numero_cuenta' AND comprobante = '$comprobante'";
    $resultado = $BD->query($sql);

    if ($resultado) {
        echo json_encode(['estado' => 'ok', 'mensaje' => 'Registro eliminado correctamente']);
    } else {
        echo json_encode(['estado' => 'error', 'mensaje' => 'Error al eliminar']);
    }
}

?>