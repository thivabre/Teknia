<?php include ("conexion.php");?>

<?php
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
?>