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

    } elseif ($accion == 'insert_direccion_empleado') {
        $calle_emp = $_POST['calle_emp'];
        $altura_emp = $_POST['altura_emp'];
        $cod_postal_emp = $_POST['cod_postal_emp'];
        $id_localidad = $_POST['id_localidad'];
        $sql = "INSERT INTO direccion_empleado (calle_emp, altura_emp, cod_postal_emp, id_localidad) VALUES ('$calle_emp', '$altura_emp', '$cod_postal_emp', '$id_localidad')";
        $resultado = $BD->query($sql);
        if (!$resultado) throw new Exception("Error al insertar dirección empleado: " . $BD->error);
        echo json_encode(['estado' => 'ok', 'mensaje' => 'Dirección empleado insertada correctamente']);

    } elseif ($accion == 'insert_direccion_cliente') {
        $calle_cli = $_POST['calle_cli'];
        $altura_cli = $_POST['altura_cli'];
        $cod_postal_cli = $_POST['cod_postal_cli'];
        $id_localidad = $_POST['id_localidad'];
        $sql = "INSERT INTO direccion_cliente (calle_cli, altura_cli, cod_postal_cli, id_localidad) VALUES ('$calle_cli', '$altura_cli', '$cod_postal_cli', '$id_localidad')";
        $resultado = $BD->query($sql);
        if (!$resultado) throw new Exception("Error al insertar dirección cliente: " . $BD->error);
        echo json_encode(['estado' => 'ok', 'mensaje' => 'Dirección cliente insertada correctamente']);

    } elseif ($accion == 'insert_direccion_sucursal') {
        $calle_suc = $_POST['calle_suc'];
        $altura_suc = $_POST['altura_suc'];
        $cod_postal_suc = $_POST['cod_postal_suc'];
        $id_localidad = $_POST['id_localidad'];
        $sql = "INSERT INTO direccion_sucursal (calle_suc, altura_suc, cod_postal_suc, id_localidad) VALUES ('$calle_suc', '$altura_suc', '$cod_postal_suc', '$id_localidad')";
        $resultado = $BD->query($sql);
        if (!$resultado) throw new Exception("Error al insertar dirección sucursal: " . $BD->error);
        echo json_encode(['estado' => 'ok', 'mensaje' => 'Dirección sucursal insertada correctamente']);

    } elseif ($accion == 'insert_direccion_proveedor') {
        $calle_prov = $_POST['calle_prov'];
        $altura_prov = $_POST['altura_prov'];
        $cod_postal_prov = $_POST['cod_postal_prov'];
        $id_localidad = $_POST['id_localidad'];
        $sql = "INSERT INTO direccion_proveedor (calle_prov, altura_prov, cod_postal_prov, id_localidad) VALUES ('$calle_prov', '$altura_prov', '$cod_postal_prov', '$id_localidad')";
        $resultado = $BD->query($sql);
        if (!$resultado) throw new Exception("Error al insertar dirección proveedor: " . $BD->error);
        echo json_encode(['estado' => 'ok', 'mensaje' => 'Dirección proveedor insertada correctamente']);

    } elseif ($accion == 'insert_inventario_productos') {
        $cantidad_prod = $_POST['cantidad_prod'];
        $id_articulo_reparar = $_POST['id_articulo_reparar'];
        $sql = "INSERT INTO inventario_productos (cantidad_prod, id_articulo_reparar) VALUES ('$cantidad_prod', '$id_articulo_reparar')";
        $resultado = $BD->query($sql);
        if (!$resultado) throw new Exception("Error al insertar inventario productos: " . $BD->error);
        echo json_encode(['estado' => 'ok', 'mensaje' => 'Inventario productos insertado correctamente']);

    } elseif ($accion == 'insert_inventario_repuestos') {
        $cantidad_rep = $_POST['cantidad_rep'];
        $id_repuesto = $_POST['id_repuesto'];
        $sql = "INSERT INTO inventario_repuestos (cantidad_rep, id_repuesto) VALUES ('$cantidad_rep', '$id_repuesto')";
        $resultado = $BD->query($sql);
        if (!$resultado) throw new Exception("Error al insertar inventario repuestos: " . $BD->error);
        echo json_encode(['estado' => 'ok', 'mensaje' => 'Inventario repuestos insertado correctamente']);

    } elseif ($accion == 'insert_contrato_empleado') {
        $fecha_cont = $_POST['fecha_cont'];
        $turno = $_POST['turno'];
        $id_sueldo = $_POST['id_sueldo'];
        $sql = "INSERT INTO contrato_empleado (fecha_cont, turno, id_sueldo) VALUES ('$fecha_cont', '$turno', '$id_sueldo')";
        $resultado = $BD->query($sql);
        if (!$resultado) throw new Exception("Error al insertar contrato empleado: " . $BD->error);
        echo json_encode(['estado' => 'ok', 'mensaje' => 'Contrato empleado insertado correctamente']);

    } elseif ($accion == 'insert_repuestos') {
        $nombre_rep = $_POST['nombre_rep'];
        $tipo_rep = $_POST['tipo_rep'];
        $id_precio = $_POST['id_precio'];
        $sql = "INSERT INTO repuestos (nombre_rep, tipo_rep, id_precio) VALUES ('$nombre_rep', '$tipo_rep', '$id_precio')";
        $resultado = $BD->query($sql);
        if (!$resultado) throw new Exception("Error al insertar repuesto: " . $BD->error);
        echo json_encode(['estado' => 'ok', 'mensaje' => 'Repuesto insertado correctamente']);

    } elseif ($accion == 'insert_factura_servicio') {
        $fecha_factura = $_POST['fecha_factura'];
        $id_pago = $_POST['id_pago'];
        $id_garantia_servicio = $_POST['id_garantia_servicio'];
        $sql = "INSERT INTO factura_servicio (fecha_factura, id_pago, id_garantia_servicio) VALUES ('$fecha_factura', '$id_pago', '$id_garantia_servicio')";
        $resultado = $BD->query($sql);
        if (!$resultado) throw new Exception("Error al insertar factura: " . $BD->error);
        echo json_encode(['estado' => 'ok', 'mensaje' => 'Factura insertada correctamente']);

    } elseif ($accion == 'insert_proveedor') {
        $nombre_prov = $_POST['nombre_prov'];
        $id_dire_proveedor = $_POST['id_dire_proveedor'];
        $id_repuesto = $_POST['id_repuesto'];
        $sql = "INSERT INTO proveedor (nombre_prov, id_dire_proveedor, id_repuesto) VALUES ('$nombre_prov', '$id_dire_proveedor', '$id_repuesto')";
        $resultado = $BD->query($sql);
        if (!$resultado) throw new Exception("Error al insertar proveedor: " . $BD->error);
        echo json_encode(['estado' => 'ok', 'mensaje' => 'Proveedor insertado correctamente']);

    } elseif ($accion == 'insert_presupuestos') {
        $precio_reparacion_tot = $_POST['precio_reparacion_tot'];
        $id_repuesto = $_POST['id_repuesto'];
        $sql = "INSERT INTO presupuestos (precio_reparacion_tot, id_repuesto) VALUES ('$precio_reparacion_tot', '$id_repuesto')";
        $resultado = $BD->query($sql);
        if (!$resultado) throw new Exception("Error al insertar presupuesto: " . $BD->error);
        echo json_encode(['estado' => 'ok', 'mensaje' => 'Presupuesto insertado correctamente']);

    } elseif ($accion == 'insert_sucursales') {
        $cant_empleados = $_POST['cant_empleados'];
        $reparaciones_hechas = $_POST['reparaciones_hechas'];
        $id_dire_sucursal = $_POST['id_dire_sucursal'];
        $id_inv_repuestos = $_POST['id_inv_repuestos'];
        $id_inv_productos = $_POST['id_inv_productos'];
        $id_impuestos = $_POST['id_impuestos'];
        $sql = "INSERT INTO sucursales (cant_empleados, reparaciones_hechas, id_dire_sucursal, id_inv_repuestos, id_inv_productos, id_impuestos) VALUES ('$cant_empleados', '$reparaciones_hechas', '$id_dire_sucursal', '$id_inv_repuestos', '$id_inv_productos', '$id_impuestos')";
        $resultado = $BD->query($sql);
        if (!$resultado) throw new Exception("Error al insertar sucursal: " . $BD->error);
        echo json_encode(['estado' => 'ok', 'mensaje' => 'Sucursal insertada correctamente']);

    } elseif ($accion == 'insert_empleado') {
        $nombre_emple = $_POST['nombre_emple'];
        $apellido_emple = $_POST['apellido_emple'];
        $dni_emple = $_POST['dni_emple'];
        $telefono_emple = $_POST['telefono_emple'];
        $horas_trabajdas = $_POST['horas_trabajdas'];
        $horas_extra = $_POST['horas_extra'];
        $id_dire_empleado = $_POST['id_dire_empleado'];
        $id_contrato_emple = $_POST['id_contrato_emple'];
        $id_sucursal = $_POST['id_sucursal'];
        $id_seguro = $_POST['id_seguro'];
        $sql = "INSERT INTO empleado (nombre_emple, apellido_emple, dni_emple, telefono_emple, horas_trabajdas, horas_extra, id_dire_empleado, id_contrato_emple, id_sucursal, id_seguro) VALUES ('$nombre_emple', '$apellido_emple', '$dni_emple', '$telefono_emple', '$horas_trabajdas', '$horas_extra', '$id_dire_empleado', '$id_contrato_emple', '$id_sucursal', '$id_seguro')";
        $resultado = $BD->query($sql);
        if (!$resultado) throw new Exception("Error al insertar empleado: " . $BD->error);
        echo json_encode(['estado' => 'ok', 'mensaje' => 'Empleado insertado correctamente']);

    } elseif ($accion == 'insert_sucursales_proveedor') {
        $id_proveedor = $_POST['id_proveedor'];
        $id_sucursal = $_POST['id_sucursal'];
        $sql = "INSERT INTO sucursales_proveedor (id_proveedor, id_sucursal) VALUES ('$id_proveedor', '$id_sucursal')";
        $resultado = $BD->query($sql);
        if (!$resultado) throw new Exception("Error al insertar sucursal_proveedor: " . $BD->error);
        echo json_encode(['estado' => 'ok', 'mensaje' => 'Sucursal-Proveedor insertado correctamente']);

    } elseif ($accion == 'insert_orden_servicio') {
        $fecha_orden = $_POST['fecha_orden'];
        $fecha_est_fin = $_POST['fecha_est_fin'];
        $id_sucursal = $_POST['id_sucursal'];
        $id_articulo_reparar = $_POST['id_articulo_reparar'];
        $id_presupuesto = $_POST['id_presupuesto'];
        $sql = "INSERT INTO orden_servicio (fecha_orden, fecha_est_fin, id_sucursal, id_articulo_reparar, id_presupuesto) VALUES ('$fecha_orden', '$fecha_est_fin', '$id_sucursal', '$id_articulo_reparar', '$id_presupuesto')";
        $resultado = $BD->query($sql);
        if (!$resultado) throw new Exception("Error al insertar orden de servicio: " . $BD->error);
        echo json_encode(['estado' => 'ok', 'mensaje' => 'Orden de servicio insertada correctamente']);

    } elseif ($accion == 'insert_cliente') {
        $nombre_cli = $_POST['nombre_cli'];
        $apellido_cli = $_POST['apellido_cli'];
        $dni_cli = $_POST['dni_cli'];
        $telefono_cli = $_POST['telefono_cli'];
        $id_dire_cliente = $_POST['id_dire_cliente'];
        $id_orden_servicio = $_POST['id_orden_servicio'];
        $sql = "INSERT INTO cliente (nombre_cli, apellido_cli, dni_cli, telefono_cli, id_dire_cliente, id_orden_servicio) VALUES ('$nombre_cli', '$apellido_cli', '$dni_cli', '$telefono_cli', '$id_dire_cliente', '$id_orden_servicio')";
        $resultado = $BD->query($sql);
        if (!$resultado) throw new Exception("Error al insertar cliente: " . $BD->error);
        echo json_encode(['estado' => 'ok', 'mensaje' => 'Cliente insertado correctamente']);

    } elseif ($accion == 'insert_orden_entrega') {
        $fecha_entrega = $_POST['fecha_entrega'];
        $id_orden_servicio = $_POST['id_orden_servicio'];
        $id_factura_servicio = $_POST['id_factura_servicio'];
        $sql = "INSERT INTO orden_entrega (fecha_entrega, id_orden_servicio, id_factura_servicio) VALUES ('$fecha_entrega', '$id_orden_servicio', '$id_factura_servicio')";
        $resultado = $BD->query($sql);
        if (!$resultado) throw new Exception("Error al insertar orden de entrega: " . $BD->error);
        echo json_encode(['estado' => 'ok', 'mensaje' => 'Orden de entrega insertada correctamente']);

    } else {
        throw new Exception("Acción no reconocida: $accion");
    }

} catch (Exception $e) {
    echo json_encode(['estado' => 'error', 'mensaje' => $e->getMessage()]);
}
?>