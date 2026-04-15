<?php include("conexion.php"); ?>
<?php

header('Content-Type: application/json');

try {
    if (!isset($_POST['accion'])) {
        throw new Exception("No se recibió ninguna acción");
    }

    $accion = $_POST['accion'];

    if ($accion == 'insert_precio') {
        $precio_mano_obra = $_POST['precio_mano_obra'];
        $precio_rep = $_POST['precio_rep'];

        $sql = "INSERT INTO precio (precio_mano_obra, precio_rep) VALUES ('$precio_mano_obra', '$precio_rep')";
        $resultado = $BD->query($sql);

        if (!$resultado) throw new Exception("Error al insertar precio: " . $BD->error);
        echo json_encode(['estado' => 'ok', 'mensaje' => 'Precio insertado correctamente']);

    } elseif ($accion == 'insert_articulo_reparar') {
        $nombre_art_rep = $_POST['nombre_art_rep'];
        $tipo_art_rep = $_POST['tipo_art_rep'];
        $fallas = $_POST['fallas'];

        $sql = "INSERT INTO articulo_reparar (nombre_art_rep, tipo_art_rep, fallas) VALUES ('$nombre_art_rep', '$tipo_art_rep', '$fallas')";
        $resultado = $BD->query($sql);

        if (!$resultado) throw new Exception("Error al insertar artículo: " . $BD->error);
        echo json_encode(['estado' => 'ok', 'mensaje' => 'Artículo insertado correctamente']);

    } elseif ($accion == 'insert_pago') {
        $nombre_banco = $_POST['nombre_banco'];
        $numero_cuenta = $_POST['numero_cuenta'];
        $comprobante = $_POST['comprobante'];

        $sql = "INSERT INTO pago (nombre_banco, numero_cuenta, comprobante) VALUES ('$nombre_banco', '$numero_cuenta', '$comprobante')";
        $resultado = $BD->query($sql);

        if (!$resultado) throw new Exception("Error al insertar pago: " . $BD->error);
        echo json_encode(['estado' => 'ok', 'mensaje' => 'Pago insertado correctamente']);

    } elseif ($accion == 'insert_localidad') {
        $pais = $_POST['pais'];
        $provincia = $_POST['provincia'];
        $ciudad = $_POST['ciudad'];
        $barrio = $_POST['barrio'];

        $sql = "INSERT INTO localidad (pais, provincia, ciudad, barrio) VALUES ('$pais', '$provincia', '$ciudad', '$barrio')";
        $resultado = $BD->query($sql);

        if (!$resultado) throw new Exception("Error al insertar localidad: " . $BD->error);
        echo json_encode(['estado' => 'ok', 'mensaje' => 'Localidad insertada correctamente']);

    } elseif ($accion == 'insert_garantia_servicio') {
        $tiempo_garantia = $_POST['tiempo_garantia'];
        $tipo_garantia = $_POST['tipo_garantia'];

        $sql = "INSERT INTO garantia_servicio (tiempo_garantia, tipo_garantia) VALUES ('$tiempo_garantia', '$tipo_garantia')";
        $resultado = $BD->query($sql);

        if (!$resultado) throw new Exception("Error al insertar garantía: " . $BD->error);
        echo json_encode(['estado' => 'ok', 'mensaje' => 'Garantía insertada correctamente']);

    } elseif ($accion == 'insert_sueldo') {
        $sueldo_hora = $_POST['sueldo_hora'];
        $sueldo_hora_ext = $_POST['sueldo_hora_ext'];
        $forma_pago = $_POST['forma_pago'];

        $sql = "INSERT INTO sueldo (sueldo_hora, sueldo_hora_ext, forma_pago) VALUES ('$sueldo_hora', '$sueldo_hora_ext', '$forma_pago')";
        $resultado = $BD->query($sql);

        if (!$resultado) throw new Exception("Error al insertar sueldo: " . $BD->error);
        echo json_encode(['estado' => 'ok', 'mensaje' => 'Sueldo insertado correctamente']);

    } elseif ($accion == 'insert_impuestos') {
        $tipo_imp = $_POST['tipo_imp'];
        $monto_imp = $_POST['monto_imp'];

        $sql = "INSERT INTO impuestos (tipo_imp, monto_imp) VALUES ('$tipo_imp', '$monto_imp')";
        $resultado = $BD->query($sql);

        if (!$resultado) throw new Exception("Error al insertar impuesto: " . $BD->error);
        echo json_encode(['estado' => 'ok', 'mensaje' => 'Impuesto insertado correctamente']);

    } elseif ($accion == 'insert_seguro') {
        $tipo_seg = $_POST['tipo_seg'];
        $nombre_aseg = $_POST['nombre_aseg'];
        $monto_aseg = $_POST['monto_aseg'];

        $sql = "INSERT INTO seguro (tipo_seg, nombre_aseg, monto_aseg) VALUES ('$tipo_seg', '$nombre_aseg', '$monto_aseg')";
        $resultado = $BD->query($sql);

        if (!$resultado) throw new Exception("Error al insertar seguro: " . $BD->error);
        echo json_encode(['estado' => 'ok', 'mensaje' => 'Seguro insertado correctamente']);

    } else {
        throw new Exception("Acción no reconocida: $accion");
    }

} catch (Exception $e) {
    echo json_encode(['estado' => 'error', 'mensaje' => $e->getMessage()]);
}
?>
