// precio, articulo reparar, pago, localidad, seguro, sueldo, impuestos, garantia_servicio


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

    } elseif ($accion == 'update_seguro') {
        $tipo_seg = $_POST['tipo_seg'];
        $nombre_seg = $_POST['nombre_seg'];
        $monto_seg = $_POST['monto_seg'];

        $resultado_anterior = $BD->query("SELECT tipo_seg, nombre_seg, monto_seg FROM seguro");
        if (!$resultado_anterior) throw new Exception("Error al consultar seguro: " . $BD->error);

        $fila = $resultado_anterior->fetch_assoc();
        if (!$fila) throw new Exception("No se encontró ningún registro en seguro");

        if ($fila['tipo_seg'] != $tipo_seg || $fila['nombre_seg'] != $nombre_seg || $fila['monto_seg'] != $monto_seg) {
            $sql = "UPDATE seguro SET tipo_seg = '$tipo_seg', nombre_seg = '$nombre_seg', monto_seg = '$monto_seg' WHERE nombre_seg = '{$fila['nombre_seg']}'";
            $resultado = $BD->query($sql);
            if (!$resultado) throw new Exception("Error al actualizar seguro: " . $BD->error);
            echo json_encode(['estado' => 'ok', 'mensaje' => 'Seguro actualizado correctamente']);
        } else {
            echo json_encode(['estado' => 'ok', 'mensaje' => 'No hubo cambios']);
        }

    } elseif ($accion == 'update_sueldo') {
        $sueldo_hora = $_POST['sueldo_hora'];
        $sueldo_hora_extra = $_POST['sueldo_hora_extra'];
        $forma_pag = $_POST['forma_pag'];

        $resultado_anterior = $BD->query("SELECT sueldo_hora, sueldo_hora_extra, forma_pag FROM sueldo");
        if (!$resultado_anterior) throw new Exception("Error al consultar sueldo: " . $BD->error);

        $fila = $resultado_anterior->fetch_assoc();
        if (!$fila) throw new Exception("No se encontró ningún registro en sueldo");

        if ($fila['sueldo_hora'] != $sueldo_hora || $fila['sueldo_hora_extra'] != $sueldo_hora_extra || $fila['forma_pag'] != $forma_pag) {
            $sql = "UPDATE sueldo SET sueldo_hora = '$sueldo_hora', sueldo_hora_extra = '$sueldo_hora_extra', forma_pag = '$forma_pag' WHERE sueldo_hora = '{$fila['sueldo_hora']}'";
            $resultado = $BD->query($sql);
            if (!$resultado) throw new Exception("Error al actualizar sueldo: " . $BD->error);
            echo json_encode(['estado' => 'ok', 'mensaje' => 'Sueldo actualizado correctamente']);
        } else {
            echo json_encode(['estado' => 'ok', 'mensaje' => 'No hubo cambios']);
        }

    } elseif ($accion == 'update_impuestos') {
        $tipo_imp = $_POST['tipo_imp'];
        $monto_imp = $_POST['monto_imp'];

        $resultado_anterior = $BD->query("SELECT tipo_imp, monto_imp FROM impuestos");
        if (!$resultado_anterior) throw new Exception("Error al consultar impuestos: " . $BD->error);

        $fila = $resultado_anterior->fetch_assoc();
        if (!$fila) throw new Exception("No se encontró ningún registro en impuestos");

        if ($fila['tipo_imp'] != $tipo_imp || $fila['monto_imp'] != $monto_imp) {
            $sql = "UPDATE impuestos SET tipo_imp = '$tipo_imp', monto_imp = '$monto_imp' WHERE tipo_imp = '{$fila['tipo_imp']}'";
            $resultado = $BD->query($sql);
            if (!$resultado) throw new Exception("Error al actualizar impuestos: " . $BD->error);
            echo json_encode(['estado' => 'ok', 'mensaje' => 'Impuestos actualizados correctamente']);
        } else {
            echo json_encode(['estado' => 'ok', 'mensaje' => 'No hubo cambios']);
        }

    } elseif ($accion == 'update_garantia_servicio') {
        $tiempo_garantia = $_POST['tiempo_garantia'];
        $tipo_garantia = $_POST['tipo_garantia'];

        $resultado_anterior = $BD->query("SELECT tiempo_garantia, tipo_garantia FROM garantia_servicio");
        if (!$resultado_anterior) throw new Exception("Error al consultar garantía: " . $BD->error);

        $fila = $resultado_anterior->fetch_assoc();
        if (!$fila) throw new Exception("No se encontró ningún registro en garantia_servicio");

        if ($fila['tiempo_garantia'] != $tiempo_garantia || $fila['tipo_garantia'] != $tipo_garantia) {
            $sql = "UPDATE garantia_servicio SET tiempo_garantia = '$tiempo_garantia', tipo_garantia = '$tipo_garantia' WHERE tiempo_garantia = '{$fila['tiempo_garantia']}'";
            $resultado = $BD->query($sql);
            if (!$resultado) throw new Exception("Error al actualizar garantía: " . $BD->error);
            echo json_encode(['estado' => 'ok', 'mensaje' => 'Garantía actualizada correctamente']);
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