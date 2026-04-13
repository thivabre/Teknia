// precio, articulo reparar, pago, localidad

<?php include ("conexion.php");?>

<?php

$accion = $_POST['accion'];

if ($accion == 'update_precio') {
    $precio_mano_obra = $_POST['precio_mano_obra'];
    $precio_rep = $_POST['precio_rep'];

    $resultado_anterior = $BD->query("SELECT precio_mano_obra, precio_rep FROM precio");
    $fila = $resultado_anterior->fetch_assoc();
    $precio_mano_obra_anterior = $fila['precio_mano_obra'];
    $precio_rep_anterior = $fila['precio_rep'];

    if ($precio_mano_obra_anterior != $precio_mano_obra || $precio_rep_anterior != $precio_rep) {
        $sql = "UPDATE precio SET precio_mano_obra = '$precio_mano_obra', precio_rep = '$precio_rep' WHERE precio_mano_obra = '$precio_mano_obra_anterior'";
        $resultado = $BD->query($sql);

        if ($resultado) {
            echo json_encode(['estado' => 'ok', 'mensaje' => 'Registro actualizado correctamente']);
        } else {
            echo json_encode(['estado' => 'error', 'mensaje' => 'Error al actualizar']);
        }
    } else {
        echo json_encode(['estado' => 'ok', 'mensaje' => 'No hubo cambios']);
    }
}

if ($accion == 'update_articulo_reparar') {
    $nombre_art_rep = $_POST['nombre_art_rep'];
    $tipo_art_rep = $_POST['tipo_art_rep'];
    $fallas = $_POST['fallas'];
    
    $resultado_anterior = $BD->query("SELECT nombre_art_rep, tipo_art_rep, fallas FROM articulo_reparar");
    $fila = $resultado_anterior->fetch_assoc();
    $nombre_art_rep_anterior = $fila['nombre_art_rep'];
    $tipo_art_rep_anterior = $fila['tipo_art_rep'];
    $fallas_anterior = $fila['fallas'];

    if ($nombre_art_rep_anterior != $nombre_art_rep || $tipo_art_rep_anterior != $tipo_art_rep || $fallas_anterior != $fallas) {
        $sql = "UPDATE articulo_reparar SET nombre_art_rep = '$nombre_art_rep', tipo_art_rep = '$tipo_art_rep', fallas = '$fallas' WHERE nombre_art_rep = '$nombre_art_rep_anterior'";
        $resultado = $BD->query($sql);

        if ($resultado) {
            echo json_encode(['estado' => 'ok', 'mensaje' => 'Registro actualizado correctamente']);
        } else {
            echo json_encode(['estado' => 'error', 'mensaje' => 'Error al actualizar']);
        }
    } else {
        echo json_encode(['estado' => 'ok', 'mensaje' => 'No hubo cambios']);
    }
}

if ($accion == 'update_pago') {
    $nombre_banco = $_POST['nombre_banco'];
    $numero_cuenta = $_POST['numero_cuenta'];
    $comprobante = $_POST['comprobante'];


    $resultado_anterior = $BD->query("SELECT nombre_banco, numero_cuenta, comprobante FROM pago");
    $fila = $resultado_anterior->fetch_assoc();
    $nombre_banco_anterior = $fila['nombre_banco'];
    $numero_cuenta_anterior = $fila['numero_cuenta'];
    $comprobante_anterior = $fila['comprobante'];


    if ($nombre_banco_anterior != $nombre_banco || $numero_cuenta_anterior != $numero_cuenta || $comprobante_anterior != $comprobante) {
        $sql = "UPDATE pago SET nombre_banco = '$nombre_banco', numero_cuenta = '$numero_cuenta', comprobante = '$comprobante' WHERE nombre_banco = '$nombre_banco_anterior'";
        $resultado = $BD->query($sql);

        if ($resultado) {
            echo json_encode(['estado' => 'ok', 'mensaje' => 'Registro actualizado correctamente']);
        } else {
            echo json_encode(['estado' => 'error', 'mensaje' => 'Error al actualizar']);
        }
    } else {
        echo json_encode(['estado' => 'ok', 'mensaje' => 'No hubo cambios']);
    }
}


if ($accion == 'update_localidad') {
    $pais = $_POST['pais'];
    $provincia = $_POST['provincia'];
    $ciudad = $_POST['ciudad'];
    $barrio = $_POST['barrio'];


    $resultado_anterior = $BD->query("SELECT pais, provincia, ciudad, barrio FROM localidad");
    $fila = $resultado_anterior->fetch_assoc();
    $pais_anterior = $fila['pais'];
    $provincia_anterior = $fila['provincia'];
    $ciudad_anterior = $fila['ciudad'];
    $barrio_anterior = $fila['barrio'];

    
    if ($pais_anterior != $pais || $provincia_anterior != $provincia || $ciudad_anterior != $ciudad || $barrio_anterior != $barrio) {
        $sql = "UPDATE localidad SET pais = '$pais', provincia = '$provincia', ciudad = '$ciudad', barrio = '$barrio' WHERE pais = '$pais_anterior'";
        $resultado = $BD->query($sql);

        if ($resultado) {
            echo json_encode(['estado' => 'ok', 'mensaje' => 'Registro actualizado correctamente']);
        } else {
            echo json_encode(['estado' => 'error', 'mensaje' => 'Error al actualizar']);
        }
    } else {
        echo json_encode(['estado' => 'ok', 'mensaje' => 'No hubo cambios']);
    }
}

?>