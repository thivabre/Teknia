// precio, articulo reparar, pago, localidad


<?php include("conexion.php"); ?>
<?php

header('Content-Type: application/json');

try {
    if (!isset($_POST['accion'])) {
        throw new Exception("No se recibió ninguna acción");
    }

    $accion = $_POST['accion'];

    if ($accion == 'update_precio') {
        $precio_mano_obra = $_POST['precio_mano_obra'];
        $precio_rep = $_POST['precio_rep'];

        $resultado_anterior = $BD->query("SELECT precio_mano_obra, precio_rep FROM precio");
        if (!$resultado_anterior) throw new Exception("Error al consultar precio: " . $BD->error);

        $fila = $resultado_anterior->fetch_assoc();
        if (!$fila) throw new Exception("No se encontró ningún registro en precio");

        if ($fila['precio_mano_obra'] != $precio_mano_obra || $fila['precio_rep'] != $precio_rep) {
            $sql = "UPDATE precio SET precio_mano_obra = '$precio_mano_obra', precio_rep = '$precio_rep' WHERE precio_mano_obra = '{$fila['precio_mano_obra']}'";
            $resultado = $BD->query($sql);
            if (!$resultado) throw new Exception("Error al actualizar precio: " . $BD->error);
            echo json_encode(['estado' => 'ok', 'mensaje' => 'Precio actualizado correctamente']);
        } else {
            echo json_encode(['estado' => 'ok', 'mensaje' => 'No hubo cambios']);
        }

    } elseif ($accion == 'update_articulo_reparar') {
        $nombre_art_rep = $_POST['nombre_art_rep'];
        $tipo_art_rep = $_POST['tipo_art_rep'];
        $fallas = $_POST['fallas'];

        $resultado_anterior = $BD->query("SELECT nombre_art_rep, tipo_art_rep, fallas FROM articulo_reparar");
        if (!$resultado_anterior) throw new Exception("Error al consultar artículo: " . $BD->error);

        $fila = $resultado_anterior->fetch_assoc();
        if (!$fila) throw new Exception("No se encontró ningún registro en artículo_reparar");

        if ($fila['nombre_art_rep'] != $nombre_art_rep || $fila['tipo_art_rep'] != $tipo_art_rep || $fila['fallas'] != $fallas) {
            $sql = "UPDATE articulo_reparar SET nombre_art_rep = '$nombre_art_rep', tipo_art_rep = '$tipo_art_rep', fallas = '$fallas' WHERE nombre_art_rep = '{$fila['nombre_art_rep']}'";
            $resultado = $BD->query($sql);
            if (!$resultado) throw new Exception("Error al actualizar artículo: " . $BD->error);
            echo json_encode(['estado' => 'ok', 'mensaje' => 'Artículo actualizado correctamente']);
        } else {
            echo json_encode(['estado' => 'ok', 'mensaje' => 'No hubo cambios']);
        }

    } elseif ($accion == 'update_pago') {
        $nombre_banco = $_POST['nombre_banco'];
        $numero_cuenta = $_POST['numero_cuenta'];
        $comprobante = $_POST['comprobante'];

        $resultado_anterior = $BD->query("SELECT nombre_banco, numero_cuenta, comprobante FROM pago");
        if (!$resultado_anterior) throw new Exception("Error al consultar pago: " . $BD->error);

        $fila = $resultado_anterior->fetch_assoc();
        if (!$fila) throw new Exception("No se encontró ningún registro en pago");

        if ($fila['nombre_banco'] != $nombre_banco || $fila['numero_cuenta'] != $numero_cuenta || $fila['comprobante'] != $comprobante) {
            $sql = "UPDATE pago SET nombre_banco = '$nombre_banco', numero_cuenta = '$numero_cuenta', comprobante = '$comprobante' WHERE nombre_banco = '{$fila['nombre_banco']}'";
            $resultado = $BD->query($sql);
            if (!$resultado) throw new Exception("Error al actualizar pago: " . $BD->error);
            echo json_encode(['estado' => 'ok', 'mensaje' => 'Pago actualizado correctamente']);
        } else {
            echo json_encode(['estado' => 'ok', 'mensaje' => 'No hubo cambios']);
        }

    } elseif ($accion == 'update_localidad') {
        $pais = $_POST['pais'];
        $provincia = $_POST['provincia'];
        $ciudad = $_POST['ciudad'];
        $barrio = $_POST['barrio'];

        $resultado_anterior = $BD->query("SELECT pais, provincia, ciudad, barrio FROM localidad");
        if (!$resultado_anterior) throw new Exception("Error al consultar localidad: " . $BD->error);

        $fila = $resultado_anterior->fetch_assoc();
        if (!$fila) throw new Exception("No se encontró ningún registro en localidad");

        if ($fila['pais'] != $pais || $fila['provincia'] != $provincia || $fila['ciudad'] != $ciudad || $fila['barrio'] != $barrio) {
            $sql = "UPDATE localidad SET pais = '$pais', provincia = '$provincia', ciudad = '$ciudad', barrio = '$barrio' WHERE pais = '{$fila['pais']}'";
            $resultado = $BD->query($sql);
            if (!$resultado) throw new Exception("Error al actualizar localidad: " . $BD->error);
            echo json_encode(['estado' => 'ok', 'mensaje' => 'Localidad actualizada correctamente']);
        } else {
            echo json_encode(['estado' => 'ok', 'mensaje' => 'No hubo cambios']);
        }

    } else {
        throw new Exception("Acción no reconocida: $accion");
    }

} catch (Exception $e) {
    echo json_encode(['estado' => 'error', 'mensaje' => $e->getMessage()]);
}
?>