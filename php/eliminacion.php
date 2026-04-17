<?php include("conexion.php");

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

if ($accion == 'delete_seguro') {
    $id_seguro = $_POST['id_seguro'];
    $sql = "DELETE FROM seguro WHERE id_seguro = '$id_seguro'";
    $resultado = $BD->query($sql);
    if ($resultado) {
        echo json_encode(['estado' => 'ok', 'mensaje' => 'Registro eliminado correctamente']);
    } else {
        echo json_encode(['estado' => 'error', 'mensaje' => 'Error al eliminar']);
    }
}

if ($accion == 'delete_impuestos') {
    $id_impuestos = $_POST['id_impuestos'];
    $sql = "DELETE FROM impuestos WHERE id_impuestos = '$id_impuestos'";
    $resultado = $BD->query($sql);
    if ($resultado) {
        echo json_encode(['estado' => 'ok', 'mensaje' => 'Registro eliminado correctamente']);
    } else {
        echo json_encode(['estado' => 'error', 'mensaje' => 'Error al eliminar']);
    }
}

if ($accion == 'delete_sueldo') {
    $id_sueldo = $_POST['id_sueldo'];
    $sql = "DELETE FROM sueldo WHERE id_sueldo = '$id_sueldo'";
    $resultado = $BD->query($sql);
    if ($resultado) {
        echo json_encode(['estado' => 'ok', 'mensaje' => 'Registro eliminado correctamente']);
    } else {
        echo json_encode(['estado' => 'error', 'mensaje' => 'Error al eliminar']);
    }
}

if ($accion == 'delete_garantia_servicio') {
    $id_garantia_servicio = $_POST['id_garantia_servicio'];
    $sql = "DELETE FROM garantia_servicio WHERE id_garantia_servicio = '$id_garantia_servicio'";
    $resultado = $BD->query($sql);
    if ($resultado) {
        echo json_encode(['estado' => 'ok', 'mensaje' => 'Registro eliminado correctamente']);
    } else {
        echo json_encode(['estado' => 'error', 'mensaje' => 'Error al eliminar']);
    }
}

if ($accion == 'delete_direccion_empleado') {
    $id_dire_empleado = $_POST['id_dire_empleado'];
    $sql = "DELETE FROM direccion_empleado WHERE id_dire_empleado = '$id_dire_empleado'";
    $resultado = $BD->query($sql);
    if ($resultado) {
        echo json_encode(['estado' => 'ok', 'mensaje' => 'Registro eliminado correctamente']);
    } else {
        echo json_encode(['estado' => 'error', 'mensaje' => 'Error al eliminar']);
    }
}

if ($accion == 'delete_direccion_cliente') {
    $id_dire_cliente = $_POST['id_dire_cliente'];
    $sql = "DELETE FROM direccion_cliente WHERE id_dire_cliente = '$id_dire_cliente'";
    $resultado = $BD->query($sql);
    if ($resultado) {
        echo json_encode(['estado' => 'ok', 'mensaje' => 'Registro eliminado correctamente']);
    } else {
        echo json_encode(['estado' => 'error', 'mensaje' => 'Error al eliminar']);
    }
}

if ($accion == 'delete_direccion_sucursal') {
    $id_dire_sucursal = $_POST['id_dire_sucursal'];
    $sql = "DELETE FROM direccion_sucursal WHERE id_dire_sucursal = '$id_dire_sucursal'";
    $resultado = $BD->query($sql);
    if ($resultado) {
        echo json_encode(['estado' => 'ok', 'mensaje' => 'Registro eliminado correctamente']);
    } else {
        echo json_encode(['estado' => 'error', 'mensaje' => 'Error al eliminar']);
    }
}

if ($accion == 'delete_direccion_proveedor') {
    $id_dire_proveedor = $_POST['id_dire_proveedor'];
    $sql = "DELETE FROM direccion_proveedor WHERE id_dire_proveedor = '$id_dire_proveedor'";
    $resultado = $BD->query($sql);
    if ($resultado) {
        echo json_encode(['estado' => 'ok', 'mensaje' => 'Registro eliminado correctamente']);
    } else {
        echo json_encode(['estado' => 'error', 'mensaje' => 'Error al eliminar']);
    }
}

if ($accion == 'delete_inventario_productos') {
    $id_inv_productos = $_POST['id_inv_productos'];
    $sql = "DELETE FROM inventario_productos WHERE id_inv_productos = '$id_inv_productos'";
    $resultado = $BD->query($sql);
    if ($resultado) {
        echo json_encode(['estado' => 'ok', 'mensaje' => 'Registro eliminado correctamente']);
    } else {
        echo json_encode(['estado' => 'error', 'mensaje' => 'Error al eliminar']);
    }
}

if ($accion == 'delete_inventario_repuestos') {
    $id_inv_repuestos = $_POST['id_inv_repuestos'];
    $sql = "DELETE FROM inventario_repuestos WHERE id_inv_repuestos = '$id_inv_repuestos'";
    $resultado = $BD->query($sql);
    if ($resultado) {
        echo json_encode(['estado' => 'ok', 'mensaje' => 'Registro eliminado correctamente']);
    } else {
        echo json_encode(['estado' => 'error', 'mensaje' => 'Error al eliminar']);
    }
}

if ($accion == 'delete_contrato_empleado') {
    $id_contrato_emple = $_POST['id_contrato_emple'];
    $sql = "DELETE FROM contrato_empleado WHERE id_contrato_emple = '$id_contrato_emple'";
    $resultado = $BD->query($sql);
    if ($resultado) {
        echo json_encode(['estado' => 'ok', 'mensaje' => 'Registro eliminado correctamente']);
    } else {
        echo json_encode(['estado' => 'error', 'mensaje' => 'Error al eliminar']);
    }
}

if ($accion == 'delete_repuestos') {
    $id_repuesto = $_POST['id_repuesto'];
    $sql = "DELETE FROM repuestos WHERE id_repuesto = '$id_repuesto'";
    $resultado = $BD->query($sql);
    if ($resultado) {
        echo json_encode(['estado' => 'ok', 'mensaje' => 'Registro eliminado correctamente']);
    } else {
        echo json_encode(['estado' => 'error', 'mensaje' => 'Error al eliminar']);
    }
}

if ($accion == 'delete_factura_servicio') {
    $id_factura_servicio = $_POST['id_factura_servicio'];
    $sql = "DELETE FROM factura_servicio WHERE id_factura_servicio = '$id_factura_servicio'";
    $resultado = $BD->query($sql);
    if ($resultado) {
        echo json_encode(['estado' => 'ok', 'mensaje' => 'Registro eliminado correctamente']);
    } else {
        echo json_encode(['estado' => 'error', 'mensaje' => 'Error al eliminar']);
    }
}

if ($accion == 'delete_proveedor') {
    $id_proveedor = $_POST['id_proveedor'];
    $sql = "DELETE FROM proveedor WHERE id_proveedor = '$id_proveedor'";
    $resultado = $BD->query($sql);
    if ($resultado) {
        echo json_encode(['estado' => 'ok', 'mensaje' => 'Registro eliminado correctamente']);
    } else {
        echo json_encode(['estado' => 'error', 'mensaje' => 'Error al eliminar']);
    }
}

if ($accion == 'delete_presupuestos') {
    $id_presupuesto = $_POST['id_presupuesto'];
    $sql = "DELETE FROM presupuestos WHERE id_presupuesto = '$id_presupuesto'";
    $resultado = $BD->query($sql);
    if ($resultado) {
        echo json_encode(['estado' => 'ok', 'mensaje' => 'Registro eliminado correctamente']);
    } else {
        echo json_encode(['estado' => 'error', 'mensaje' => 'Error al eliminar']);
    }
}

if ($accion == 'delete_sucursales') {
    $id_sucursal = $_POST['id_sucursal'];
    $sql = "DELETE FROM sucursales WHERE id_sucursal = '$id_sucursal'";
    $resultado = $BD->query($sql);
    if ($resultado) {
        echo json_encode(['estado' => 'ok', 'mensaje' => 'Registro eliminado correctamente']);
    } else {
        echo json_encode(['estado' => 'error', 'mensaje' => 'Error al eliminar']);
    }
}

if ($accion == 'delete_empleado') {
    $id_empleado = $_POST['id_empleado'];
    $sql = "DELETE FROM empleado WHERE id_empleado = '$id_empleado'";
    $resultado = $BD->query($sql);
    if ($resultado) {
        echo json_encode(['estado' => 'ok', 'mensaje' => 'Registro eliminado correctamente']);
    } else {
        echo json_encode(['estado' => 'error', 'mensaje' => 'Error al eliminar']);
    }
}

if ($accion == 'delete_sucursales_proveedor') {
    $id_proveedor = $_POST['id_proveedor'];
    $id_sucursal = $_POST['id_sucursal'];
    $sql = "DELETE FROM sucursales_proveedor WHERE id_proveedor = '$id_proveedor' AND id_sucursal = '$id_sucursal'";
    $resultado = $BD->query($sql);
    if ($resultado) {
        echo json_encode(['estado' => 'ok', 'mensaje' => 'Registro eliminado correctamente']);
    } else {
        echo json_encode(['estado' => 'error', 'mensaje' => 'Error al eliminar']);
    }
}

if ($accion == 'delete_orden_servicio') {
    $id_orden_servicio = $_POST['id_orden_servicio'];
    $sql = "DELETE FROM orden_servicio WHERE id_orden_servicio = '$id_orden_servicio'";
    $resultado = $BD->query($sql);
    if ($resultado) {
        echo json_encode(['estado' => 'ok', 'mensaje' => 'Registro eliminado correctamente']);
    } else {
        echo json_encode(['estado' => 'error', 'mensaje' => 'Error al eliminar']);
    }
}

if ($accion == 'delete_cliente') {
    $id_cliente = $_POST['id_cliente'];
    $sql = "DELETE FROM cliente WHERE id_cliente = '$id_cliente'";
    $resultado = $BD->query($sql);
    if ($resultado) {
        echo json_encode(['estado' => 'ok', 'mensaje' => 'Registro eliminado correctamente']);
    } else {
        echo json_encode(['estado' => 'error', 'mensaje' => 'Error al eliminar']);
    }
}

if ($accion == 'delete_orden_entrega') {
    $id_orden_entrega = $_POST['id_orden_entrega'];
    $sql = "DELETE FROM orden_entrega WHERE id_orden_entrega = '$id_orden_entrega'";
    $resultado = $BD->query($sql);
    if ($resultado) {
        echo json_encode(['estado' => 'ok', 'mensaje' => 'Registro eliminado correctamente']);
    } else {
        echo json_encode(['estado' => 'error', 'mensaje' => 'Error al eliminar']);
    }
}

?>