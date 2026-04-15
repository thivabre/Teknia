<?php include ("conexion.php");

header('Content-Type: application/json');

$accion = $_POST['accion'];

if ($accion == 'delete_localidad') {
    $id_localidad = $_POST['id_localidad'];
    $sql = "DELETE FROM localidad WHERE id_localidad = '$id_localidad'";
    $resultado = $BD->query($sql);
    if ($resultado) {
        echo json_encode(['estado' => 'ok', 'mensaje' => 'Registro eliminado correctamente']);
    } else {
        echo json_encode(['estado' => 'error', 'mensaje' => 'Error al eliminar']);
    }
}

if ($accion == 'delete_precio') {
    $id_precio = $_POST['id_precio'];
    $sql = "DELETE FROM precio WHERE id_precio = '$id_precio'";
    $resultado = $BD->query($sql);
    if ($resultado) {
        echo json_encode(['estado' => 'ok', 'mensaje' => 'Registro eliminado correctamente']);
    } else {
        echo json_encode(['estado' => 'error', 'mensaje' => 'Error al eliminar']);
    }
}

if ($accion == 'delete_articulo_reparar') {
    $id_articulo_reparar = $_POST['id_articulo_reparar'];
    $sql = "DELETE FROM articulo_reparar WHERE id_articulo_reparar = '$id_articulo_reparar'";
    $resultado = $BD->query($sql);
    if ($resultado) {
        echo json_encode(['estado' => 'ok', 'mensaje' => 'Registro eliminado correctamente']);
    } else {
        echo json_encode(['estado' => 'error', 'mensaje' => 'Error al eliminar']);
    }
}

if ($accion == 'delete_pago') {
    $id_pago = $_POST['id_pago'];
    $sql = "DELETE FROM pago WHERE id_pago = '$id_pago'";
    $resultado = $BD->query($sql);
    if ($resultado) {
        echo json_encode(['estado' => 'ok', 'mensaje' => 'Registro eliminado correctamente']);
    } else {
        echo json_encode(['estado' => 'error', 'mensaje' => 'Error al eliminar']);
    }
}

if ($accion == 'delete_seguro'){
    $id_seguro = $_POST['id_seguro'];
    $sql = "DELETE FROM seguro WHERE id_seguro = '$id_seguro'";
    $resultado = $BD->query($sql);
    if ($resultado) {
        echo json_encode(['estado' => 'ok', 'mensaje' => 'Registro eliminado correctamente']);
    } else {
        echo json_encode(['estado' => 'error', 'mensaje' => 'Error al eliminar']);
    }

}

if ($accion == 'delete_impuesto'){
    $id_impuestos = $_POST['id_impuestos'];
    $sql = "DELETE FROM impuesto WHERE id_impuestos = '$id_impuestos'";
    $resultado = $BD->query($sql);
    if ($resultado) {
        echo json_encode(['estado' => 'ok', 'mensaje' => 'Registro eliminado correctamente']);
    } else {
        echo json_encode(['estado' => 'error', 'mensaje' => 'Error al eliminar']);
    }

}

if ($accion == 'delete_sueldo'){
    $id_sueldo = $_POST['id_sueldo'];
    $sql = "DELETE FROM sueldo WHERE id_sueldo = '$id_sueldo'";
    $resultado = $BD->query($sql);
    if ($resultado) {
        echo json_encode(['estado' => 'ok', 'mensaje' => 'Registro eliminado correctamente']);
    } else {
        echo json_encode(['estado' => 'error', 'mensaje' => 'Error al eliminar']);
    }

}

if ($accion == 'delete_garantia_servicio'){
    $id_garantia_servicio = $_POST['id_garantia_servicio'];
    $sql = "DELETE FROM garantia_servicio WHERE id_garantia_servicio = '$id_garantia_servicio'";
    $resultado = $BD->query($sql);
    if ($resultado) {
        echo json_encode(['estado' => 'ok', 'mensaje' => 'Registro eliminado correctamente']);
    } else {
        echo json_encode(['estado' => 'error', 'mensaje' => 'Error al eliminar']);
    }

}

?>