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

    } else {
        throw new Exception("Acción no reconocida: $accion");
    }

} catch (Exception $e) {
    echo json_encode(['estado' => 'error', 'mensaje' => $e->getMessage()]);
}
?>