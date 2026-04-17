<?php include("conexion.php"); ?>
<?php

header('Content-Type: application/json');

try {
    if (!isset($_POST['accion'])) {
        throw new Exception("No se recibió ninguna acción");
    }

    $accion = $_POST['accion'];

    if ($accion == 'update_precio') {
        $id_precio         = $_POST['id_precio'];
        $precio_mano_obra  = $_POST['precio_mano_obra'];
        $precio_rep        = $_POST['precio_rep'];
        $sql = "UPDATE precio SET precio_mano_obra = '$precio_mano_obra', precio_rep = '$precio_rep' WHERE id_precio = '$id_precio'";
        $resultado = $BD->query($sql);
        if (!$resultado) throw new Exception("Error al actualizar precio: " . $BD->error);
        echo json_encode(['estado' => 'ok', 'mensaje' => 'Precio actualizado correctamente']);

    } elseif ($accion == 'update_articulo_reparar') {
        $id_articulo_reparar = $_POST['id_articulo_reparar'];
        $nombre_art_rep      = $_POST['nombre_art_rep'];
        $tipo_art_rep        = $_POST['tipo_art_rep'];
        $fallas              = $_POST['fallas'];
        $sql = "UPDATE articulo_reparar SET nombre_art_rep = '$nombre_art_rep', tipo_art_rep = '$tipo_art_rep', fallas = '$fallas' WHERE id_articulo_reparar = '$id_articulo_reparar'";
        $resultado = $BD->query($sql);
        if (!$resultado) throw new Exception("Error al actualizar artículo: " . $BD->error);
        echo json_encode(['estado' => 'ok', 'mensaje' => 'Artículo actualizado correctamente']);

    } elseif ($accion == 'update_pago') {
        $id_pago       = $_POST['id_pago'];
        $nombre_banco  = $_POST['nombre_banco'];
        $numero_cuenta = $_POST['numero_cuenta'];
        $comprobante   = $_POST['comprobante'];
        $sql = "UPDATE pago SET nombre_banco = '$nombre_banco', numero_cuenta = '$numero_cuenta', comprobante = '$comprobante' WHERE id_pago = '$id_pago'";
        $resultado = $BD->query($sql);
        if (!$resultado) throw new Exception("Error al actualizar pago: " . $BD->error);
        echo json_encode(['estado' => 'ok', 'mensaje' => 'Pago actualizado correctamente']);

    } elseif ($accion == 'update_localidad') {
        $id_localidad = $_POST['id_localidad'];
        $pais         = $_POST['pais'];
        $provincia    = $_POST['provincia'];
        $ciudad       = $_POST['ciudad'];
        $barrio       = $_POST['barrio'];
        $sql = "UPDATE localidad SET pais = '$pais', provincia = '$provincia', ciudad = '$ciudad', barrio = '$barrio' WHERE id_localidad = '$id_localidad'";
        $resultado = $BD->query($sql);
        if (!$resultado) throw new Exception("Error al actualizar localidad: " . $BD->error);
        echo json_encode(['estado' => 'ok', 'mensaje' => 'Localidad actualizada correctamente']);

    } elseif ($accion == 'update_seguro') {
        $id_seguro    = $_POST['id_seguro'];
        $tipo_seg     = $_POST['tipo_seg'];
        $nombre_aseg  = $_POST['nombre_aseg'];
        $monto_aseg   = $_POST['monto_aseg'];
        $sql = "UPDATE seguro SET tipo_seg = '$tipo_seg', nombre_aseg = '$nombre_aseg', monto_aseg = '$monto_aseg' WHERE id_seguro = '$id_seguro'";
        $resultado = $BD->query($sql);
        if (!$resultado) throw new Exception("Error al actualizar seguro: " . $BD->error);
        echo json_encode(['estado' => 'ok', 'mensaje' => 'Seguro actualizado correctamente']);

    } elseif ($accion == 'update_sueldo') {
        $id_sueldo       = $_POST['id_sueldo'];
        $sueldo_hora     = $_POST['sueldo_hora'];
        $sueldo_hora_ext = $_POST['sueldo_hora_ext'];
        $forma_pago      = $_POST['forma_pago'];
        $sql = "UPDATE sueldo SET sueldo_hora = '$sueldo_hora', sueldo_hora_ext = '$sueldo_hora_ext', forma_pago = '$forma_pago' WHERE id_sueldo = '$id_sueldo'";
        $resultado = $BD->query($sql);
        if (!$resultado) throw new Exception("Error al actualizar sueldo: " . $BD->error);
        echo json_encode(['estado' => 'ok', 'mensaje' => 'Sueldo actualizado correctamente']);

    } elseif ($accion == 'update_impuestos') {
        $id_impuestos = $_POST['id_impuestos'];
        $tipo_imp     = $_POST['tipo_imp'];
        $monto_imp    = $_POST['monto_imp'];
        $sql = "UPDATE impuestos SET tipo_imp = '$tipo_imp', monto_imp = '$monto_imp' WHERE id_impuestos = '$id_impuestos'";
        $resultado = $BD->query($sql);
        if (!$resultado) throw new Exception("Error al actualizar impuestos: " . $BD->error);
        echo json_encode(['estado' => 'ok', 'mensaje' => 'Impuestos actualizados correctamente']);

    } elseif ($accion == 'update_garantia_servicio') {
        $id_garantia_servicio = $_POST['id_garantia_servicio'];
        $tiempo_garantia      = $_POST['tiempo_garantia'];
        $tipo_garantia        = $_POST['tipo_garantia'];
        $sql = "UPDATE garantia_servicio SET tiempo_garantia = '$tiempo_garantia', tipo_garantia = '$tipo_garantia' WHERE id_garantia_servicio = '$id_garantia_servicio'";
        $resultado = $BD->query($sql);
        if (!$resultado) throw new Exception("Error al actualizar garantía: " . $BD->error);
        echo json_encode(['estado' => 'ok', 'mensaje' => 'Garantía actualizada correctamente']);

    } elseif ($accion == 'update_direccion_empleado') {
        $id_dire_empleado = $_POST['id_dire_empleado'];
        $calle_emp        = $_POST['calle_emp'];
        $altura_emp       = $_POST['altura_emp'];
        $cod_postal_emp   = $_POST['cod_postal_emp'];
        $id_localidad     = $_POST['id_localidad'];
        $sql = "UPDATE direccion_empleado SET calle_emp = '$calle_emp', altura_emp = '$altura_emp', cod_postal_emp = '$cod_postal_emp', id_localidad = '$id_localidad' WHERE id_dire_empleado = '$id_dire_empleado'";
        $resultado = $BD->query($sql);
        if (!$resultado) throw new Exception("Error al actualizar dirección empleado: " . $BD->error);
        echo json_encode(['estado' => 'ok', 'mensaje' => 'Dirección empleado actualizada correctamente']);

    } elseif ($accion == 'update_direccion_cliente') {
        $id_dire_cliente  = $_POST['id_dire_cliente'];
        $calle_cli        = $_POST['calle_cli'];
        $altura_cli       = $_POST['altura_cli'];
        $cod_postal_cli   = $_POST['cod_postal_cli'];
        $id_localidad     = $_POST['id_localidad'];
        $sql = "UPDATE direccion_cliente SET calle_cli = '$calle_cli', altura_cli = '$altura_cli', cod_postal_cli = '$cod_postal_cli', id_localidad = '$id_localidad' WHERE id_dire_cliente = '$id_dire_cliente'";
        $resultado = $BD->query($sql);
        if (!$resultado) throw new Exception("Error al actualizar dirección cliente: " . $BD->error);
        echo json_encode(['estado' => 'ok', 'mensaje' => 'Dirección cliente actualizada correctamente']);

    } elseif ($accion == 'update_direccion_sucursal') {
        $id_dire_sucursal = $_POST['id_dire_sucursal'];
        $calle_suc        = $_POST['calle_suc'];
        $altura_suc       = $_POST['altura_suc'];
        $cod_postal_suc   = $_POST['cod_postal_suc'];
        $id_localidad     = $_POST['id_localidad'];
        $sql = "UPDATE direccion_sucursal SET calle_suc = '$calle_suc', altura_suc = '$altura_suc', cod_postal_suc = '$cod_postal_suc', id_localidad = '$id_localidad' WHERE id_dire_sucursal = '$id_dire_sucursal'";
        $resultado = $BD->query($sql);
        if (!$resultado) throw new Exception("Error al actualizar dirección sucursal: " . $BD->error);
        echo json_encode(['estado' => 'ok', 'mensaje' => 'Dirección sucursal actualizada correctamente']);

    } elseif ($accion == 'update_direccion_proveedor') {
        $id_dire_proveedor = $_POST['id_dire_proveedor'];
        $calle_prov        = $_POST['calle_prov'];
        $altura_prov       = $_POST['altura_prov'];
        $cod_postal_prov   = $_POST['cod_postal_prov'];
        $id_localidad      = $_POST['id_localidad'];
        $sql = "UPDATE direccion_proveedor SET calle_prov = '$calle_prov', altura_prov = '$altura_prov', cod_postal_prov = '$cod_postal_prov', id_localidad = '$id_localidad' WHERE id_dire_proveedor = '$id_dire_proveedor'";
        $resultado = $BD->query($sql);
        if (!$resultado) throw new Exception("Error al actualizar dirección proveedor: " . $BD->error);
        echo json_encode(['estado' => 'ok', 'mensaje' => 'Dirección proveedor actualizada correctamente']);

    } elseif ($accion == 'update_inventario_repuestos') {
        $id_inv_repuestos = $_POST['id_inv_repuestos'];
        $cantidad_rep     = $_POST['cantidad_rep'];
        $id_repuesto      = $_POST['id_repuesto'];
        $sql = "UPDATE inventario_repuestos SET cantidad_rep = '$cantidad_rep', id_repuesto = '$id_repuesto' WHERE id_inv_repuestos = '$id_inv_repuestos'";
        $resultado = $BD->query($sql);
        if (!$resultado) throw new Exception("Error al actualizar inventario repuestos: " . $BD->error);
        echo json_encode(['estado' => 'ok', 'mensaje' => 'Inventario repuestos actualizado correctamente']);

    } elseif ($accion == 'update_contrato_empleado') {
        $id_contrato_emple = $_POST['id_contrato_emple'];
        $fecha_cont        = $_POST['fecha_cont'];
        $turno             = $_POST['turno'];
        $id_sueldo         = $_POST['id_sueldo'];
        $sql = "UPDATE contrato_empleado SET fecha_cont = '$fecha_cont', turno = '$turno', id_sueldo = '$id_sueldo' WHERE id_contrato_emple = '$id_contrato_emple'";
        $resultado = $BD->query($sql);
        if (!$resultado) throw new Exception("Error al actualizar contrato empleado: " . $BD->error);
        echo json_encode(['estado' => 'ok', 'mensaje' => 'Contrato empleado actualizado correctamente']);

    } elseif ($accion == 'update_repuestos') {
        $id_repuesto = $_POST['id_repuesto'];
        $nombre_rep  = $_POST['nombre_rep'];
        $tipo_rep    = $_POST['tipo_rep'];
        $id_precio   = $_POST['id_precio'];
        $sql = "UPDATE repuestos SET nombre_rep = '$nombre_rep', tipo_rep = '$tipo_rep', id_precio = '$id_precio' WHERE id_repuesto = '$id_repuesto'";
        $resultado = $BD->query($sql);
        if (!$resultado) throw new Exception("Error al actualizar repuesto: " . $BD->error);
        echo json_encode(['estado' => 'ok', 'mensaje' => 'Repuesto actualizado correctamente']);

    } elseif ($accion == 'update_factura_servicio') {
        $id_factura_servicio  = $_POST['id_factura_servicio'];
        $fecha_factura        = $_POST['fecha_factura'];
        $id_pago              = $_POST['id_pago'];
        $id_garantia_servicio = $_POST['id_garantia_servicio'];
        $sql = "UPDATE factura_servicio SET fecha_factura = '$fecha_factura', id_pago = '$id_pago', id_garantia_servicio = '$id_garantia_servicio' WHERE id_factura_servicio = '$id_factura_servicio'";
        $resultado = $BD->query($sql);
        if (!$resultado) throw new Exception("Error al actualizar factura: " . $BD->error);
        echo json_encode(['estado' => 'ok', 'mensaje' => 'Factura actualizada correctamente']);

    } elseif ($accion == 'update_proveedor') {
        $id_proveedor      = $_POST['id_proveedor'];
        $nombre_prov       = $_POST['nombre_prov'];
        $id_dire_proveedor = $_POST['id_dire_proveedor'];
        $id_repuesto       = $_POST['id_repuesto'];
        $sql = "UPDATE proveedor SET nombre_prov = '$nombre_prov', id_dire_proveedor = '$id_dire_proveedor', id_repuesto = '$id_repuesto' WHERE id_proveedor = '$id_proveedor'";
        $resultado = $BD->query($sql);
        if (!$resultado) throw new Exception("Error al actualizar proveedor: " . $BD->error);
        echo json_encode(['estado' => 'ok', 'mensaje' => 'Proveedor actualizado correctamente']);

    } elseif ($accion == 'update_presupuestos') {
        $id_presupuesto       = $_POST['id_presupuesto'];
        $precio_reparacion_tot = $_POST['precio_reparacion_tot'];
        $id_repuesto          = $_POST['id_repuesto'];
        $sql = "UPDATE presupuestos SET precio_reparacion_tot = '$precio_reparacion_tot', id_repuesto = '$id_repuesto' WHERE id_presupuesto = '$id_presupuesto'";
        $resultado = $BD->query($sql);
        if (!$resultado) throw new Exception("Error al actualizar presupuesto: " . $BD->error);
        echo json_encode(['estado' => 'ok', 'mensaje' => 'Presupuesto actualizado correctamente']);

    } elseif ($accion == 'update_sucursales') {
        $id_sucursal         = $_POST['id_sucursal'];
        $cant_empleados      = $_POST['cant_empleados'];
        $reparaciones_hechas = $_POST['reparaciones_hechas'];
        $id_dire_sucursal    = $_POST['id_dire_sucursal'];
        $id_inv_repuestos    = $_POST['id_inv_repuestos'];
        $id_inv_productos    = $_POST['id_inv_productos'];
        $id_impuestos        = $_POST['id_impuestos'];
        $sql = "UPDATE sucursales SET cant_empleados = '$cant_empleados', reparaciones_hechas = '$reparaciones_hechas', id_dire_sucursal = '$id_dire_sucursal', id_inv_repuestos = '$id_inv_repuestos', id_inv_productos = '$id_inv_productos', id_impuestos = '$id_impuestos' WHERE id_sucursal = '$id_sucursal'";
        $resultado = $BD->query($sql);
        if (!$resultado) throw new Exception("Error al actualizar sucursal: " . $BD->error);
        echo json_encode(['estado' => 'ok', 'mensaje' => 'Sucursal actualizada correctamente']);

    } elseif ($accion == 'update_empleado') {
        $id_empleado        = $_POST['id_empleado'];
        $nombre_emple       = $_POST['nombre_emple'];
        $apellido_emple     = $_POST['apellido_emple'];
        $dni_emple          = $_POST['dni_emple'];
        $telefono_emple     = $_POST['telefono_emple'];
        $horas_trabajdas    = $_POST['horas_trabajdas'];
        $horas_extra        = $_POST['horas_extra'];
        $id_dire_empleado   = $_POST['id_dire_empleado'];
        $id_contrato_emple  = $_POST['id_contrato_emple'];
        $id_sucursal        = $_POST['id_sucursal'];
        $id_seguro          = $_POST['id_seguro'];
        $sql = "UPDATE empleado SET nombre_emple = '$nombre_emple', apellido_emple = '$apellido_emple', dni_emple = '$dni_emple', telefono_emple = '$telefono_emple', horas_trabajdas = '$horas_trabajdas', horas_extra = '$horas_extra', id_dire_empleado = '$id_dire_empleado', id_contrato_emple = '$id_contrato_emple', id_sucursal = '$id_sucursal', id_seguro = '$id_seguro' WHERE id_empleado = '$id_empleado'";
        $resultado = $BD->query($sql);
        if (!$resultado) throw new Exception("Error al actualizar empleado: " . $BD->error);
        echo json_encode(['estado' => 'ok', 'mensaje' => 'Empleado actualizado correctamente']);

    } elseif ($accion == 'update_orden_servicio') {
        $id_orden_servicio   = $_POST['id_orden_servicio'];
        $fecha_orden         = $_POST['fecha_orden'];
        $fecha_est_fin       = $_POST['fecha_est_fin'];
        $id_sucursal         = $_POST['id_sucursal'];
        $id_articulo_reparar = $_POST['id_articulo_reparar'];
        $id_presupuesto      = $_POST['id_presupuesto'];
        $sql = "UPDATE orden_servicio SET fecha_orden = '$fecha_orden', fecha_est_fin = '$fecha_est_fin', id_sucursal = '$id_sucursal', id_articulo_reparar = '$id_articulo_reparar', id_presupuesto = '$id_presupuesto' WHERE id_orden_servicio = '$id_orden_servicio'";
        $resultado = $BD->query($sql);
        if (!$resultado) throw new Exception("Error al actualizar orden de servicio: " . $BD->error);
        echo json_encode(['estado' => 'ok', 'mensaje' => 'Orden de servicio actualizada correctamente']);

    } elseif ($accion == 'update_cliente') {
        $id_cliente        = $_POST['id_cliente'];
        $nombre_cli        = $_POST['nombre_cli'];
        $apellido_cli      = $_POST['apellido_cli'];
        $dni_cli           = $_POST['dni_cli'];
        $telefono_cli      = $_POST['telefono_cli'];
        $id_dire_cliente   = $_POST['id_dire_cliente'];
        $id_orden_servicio = $_POST['id_orden_servicio'];
        $sql = "UPDATE cliente SET nombre_cli = '$nombre_cli', apellido_cli = '$apellido_cli', dni_cli = '$dni_cli', telefono_cli = '$telefono_cli', id_dire_cliente = '$id_dire_cliente', id_orden_servicio = '$id_orden_servicio' WHERE id_cliente = '$id_cliente'";
        $resultado = $BD->query($sql);
        if (!$resultado) throw new Exception("Error al actualizar cliente: " . $BD->error);
        echo json_encode(['estado' => 'ok', 'mensaje' => 'Cliente actualizado correctamente']);

    } elseif ($accion == 'update_orden_entrega') {
        $id_orden_entrega    = $_POST['id_orden_entrega'];
        $fecha_entrega       = $_POST['fecha_entrega'];
        $id_orden_servicio   = $_POST['id_orden_servicio'];
        $id_factura_servicio = $_POST['id_factura_servicio'];
        $sql = "UPDATE orden_entrega SET fecha_entrega = '$fecha_entrega', id_orden_servicio = '$id_orden_servicio', id_factura_servicio = '$id_factura_servicio' WHERE id_orden_entrega = '$id_orden_entrega'";
        $resultado = $BD->query($sql);
        if (!$resultado) throw new Exception("Error al actualizar orden de entrega: " . $BD->error);
        echo json_encode(['estado' => 'ok', 'mensaje' => 'Orden de entrega actualizada correctamente']);

    } else {
        throw new Exception("Acción no reconocida: $accion");
    }

} catch (Exception $e) {
    echo json_encode(['estado' => 'error', 'mensaje' => $e->getMessage()]);
}
?>s