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
        if (!$fila) throw new Exception("No se encontró ningún registro en articulo_reparar");
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
        $nombre_aseg = $_POST['nombre_aseg'];
        $monto_aseg = $_POST['monto_aseg'];
        $resultado_anterior = $BD->query("SELECT tipo_seg, nombre_aseg, monto_aseg FROM seguro");
        if (!$resultado_anterior) throw new Exception("Error al consultar seguro: " . $BD->error);
        $fila = $resultado_anterior->fetch_assoc();
        if (!$fila) throw new Exception("No se encontró ningún registro en seguro");
        if ($fila['tipo_seg'] != $tipo_seg || $fila['nombre_aseg'] != $nombre_aseg || $fila['monto_aseg'] != $monto_aseg) {
            $sql = "UPDATE seguro SET tipo_seg = '$tipo_seg', nombre_aseg = '$nombre_aseg', monto_aseg = '$monto_aseg' WHERE nombre_aseg = '{$fila['nombre_aseg']}'";
            $resultado = $BD->query($sql);
            if (!$resultado) throw new Exception("Error al actualizar seguro: " . $BD->error);
            echo json_encode(['estado' => 'ok', 'mensaje' => 'Seguro actualizado correctamente']);
        } else {
            echo json_encode(['estado' => 'ok', 'mensaje' => 'No hubo cambios']);
        }

    } elseif ($accion == 'update_sueldo') {
        $sueldo_hora = $_POST['sueldo_hora'];
        $sueldo_hora_ext = $_POST['sueldo_hora_ext'];
        $forma_pago = $_POST['forma_pago'];
        $resultado_anterior = $BD->query("SELECT sueldo_hora, sueldo_hora_ext, forma_pago FROM sueldo");
        if (!$resultado_anterior) throw new Exception("Error al consultar sueldo: " . $BD->error);
        $fila = $resultado_anterior->fetch_assoc();
        if (!$fila) throw new Exception("No se encontró ningún registro en sueldo");
        if ($fila['sueldo_hora'] != $sueldo_hora || $fila['sueldo_hora_ext'] != $sueldo_hora_ext || $fila['forma_pago'] != $forma_pago) {
            $sql = "UPDATE sueldo SET sueldo_hora = '$sueldo_hora', sueldo_hora_ext = '$sueldo_hora_ext', forma_pago = '$forma_pago' WHERE sueldo_hora = '{$fila['sueldo_hora']}'";
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

    } elseif ($accion == 'update_direccion_empleado') {
        $calle_emp = $_POST['calle_emp'];
        $altura_emp = $_POST['altura_emp'];
        $cod_postal_emp = $_POST['cod_postal_emp'];
        $id_localidad = $_POST['id_localidad'];
        $resultado_anterior = $BD->query("SELECT calle_emp, altura_emp, cod_postal_emp, id_localidad FROM direccion_empleado");
        if (!$resultado_anterior) throw new Exception("Error al consultar dirección empleado: " . $BD->error);
        $fila = $resultado_anterior->fetch_assoc();
        if (!$fila) throw new Exception("No se encontró ningún registro en direccion_empleado");
        if ($fila['calle_emp'] != $calle_emp || $fila['altura_emp'] != $altura_emp || $fila['cod_postal_emp'] != $cod_postal_emp || $fila['id_localidad'] != $id_localidad) {
            $sql = "UPDATE direccion_empleado SET calle_emp = '$calle_emp', altura_emp = '$altura_emp', cod_postal_emp = '$cod_postal_emp', id_localidad = '$id_localidad' WHERE calle_emp = '{$fila['calle_emp']}'";
            $resultado = $BD->query($sql);
            if (!$resultado) throw new Exception("Error al actualizar dirección empleado: " . $BD->error);
            echo json_encode(['estado' => 'ok', 'mensaje' => 'Dirección empleado actualizada correctamente']);
        } else {
            echo json_encode(['estado' => 'ok', 'mensaje' => 'No hubo cambios']);
        }

    } elseif ($accion == 'update_direccion_cliente') {
        $calle_cli = $_POST['calle_cli'];
        $altura_cli = $_POST['altura_cli'];
        $cod_postal_cli = $_POST['cod_postal_cli'];
        $id_localidad = $_POST['id_localidad'];
        $resultado_anterior = $BD->query("SELECT calle_cli, altura_cli, cod_postal_cli, id_localidad FROM direccion_cliente");
        if (!$resultado_anterior) throw new Exception("Error al consultar dirección cliente: " . $BD->error);
        $fila = $resultado_anterior->fetch_assoc();
        if (!$fila) throw new Exception("No se encontró ningún registro en direccion_cliente");
        if ($fila['calle_cli'] != $calle_cli || $fila['altura_cli'] != $altura_cli || $fila['cod_postal_cli'] != $cod_postal_cli || $fila['id_localidad'] != $id_localidad) {
            $sql = "UPDATE direccion_cliente SET calle_cli = '$calle_cli', altura_cli = '$altura_cli', cod_postal_cli = '$cod_postal_cli', id_localidad = '$id_localidad' WHERE calle_cli = '{$fila['calle_cli']}'";
            $resultado = $BD->query($sql);
            if (!$resultado) throw new Exception("Error al actualizar dirección cliente: " . $BD->error);
            echo json_encode(['estado' => 'ok', 'mensaje' => 'Dirección cliente actualizada correctamente']);
        } else {
            echo json_encode(['estado' => 'ok', 'mensaje' => 'No hubo cambios']);
        }

    } elseif ($accion == 'update_direccion_sucursal') {
        $calle_suc = $_POST['calle_suc'];
        $altura_suc = $_POST['altura_suc'];
        $cod_postal_suc = $_POST['cod_postal_suc'];
        $id_localidad = $_POST['id_localidad'];
        $resultado_anterior = $BD->query("SELECT calle_suc, altura_suc, cod_postal_suc, id_localidad FROM direccion_sucursal");
        if (!$resultado_anterior) throw new Exception("Error al consultar dirección sucursal: " . $BD->error);
        $fila = $resultado_anterior->fetch_assoc();
        if (!$fila) throw new Exception("No se encontró ningún registro en direccion_sucursal");
        if ($fila['calle_suc'] != $calle_suc || $fila['altura_suc'] != $altura_suc || $fila['cod_postal_suc'] != $cod_postal_suc || $fila['id_localidad'] != $id_localidad) {
            $sql = "UPDATE direccion_sucursal SET calle_suc = '$calle_suc', altura_suc = '$altura_suc', cod_postal_suc = '$cod_postal_suc', id_localidad = '$id_localidad' WHERE calle_suc = '{$fila['calle_suc']}'";
            $resultado = $BD->query($sql);
            if (!$resultado) throw new Exception("Error al actualizar dirección sucursal: " . $BD->error);
            echo json_encode(['estado' => 'ok', 'mensaje' => 'Dirección sucursal actualizada correctamente']);
        } else {
            echo json_encode(['estado' => 'ok', 'mensaje' => 'No hubo cambios']);
        }

    } elseif ($accion == 'update_direccion_proveedor') {
        $calle_prov = $_POST['calle_prov'];
        $altura_prov = $_POST['altura_prov'];
        $cod_postal_prov = $_POST['cod_postal_prov'];
        $id_localidad = $_POST['id_localidad'];
        $resultado_anterior = $BD->query("SELECT calle_prov, altura_prov, cod_postal_prov, id_localidad FROM direccion_proveedor");
        if (!$resultado_anterior) throw new Exception("Error al consultar dirección proveedor: " . $BD->error);
        $fila = $resultado_anterior->fetch_assoc();
        if (!$fila) throw new Exception("No se encontró ningún registro en direccion_proveedor");
        if ($fila['calle_prov'] != $calle_prov || $fila['altura_prov'] != $altura_prov || $fila['cod_postal_prov'] != $cod_postal_prov || $fila['id_localidad'] != $id_localidad) {
            $sql = "UPDATE direccion_proveedor SET calle_prov = '$calle_prov', altura_prov = '$altura_prov', cod_postal_prov = '$cod_postal_prov', id_localidad = '$id_localidad' WHERE calle_prov = '{$fila['calle_prov']}'";
            $resultado = $BD->query($sql);
            if (!$resultado) throw new Exception("Error al actualizar dirección proveedor: " . $BD->error);
            echo json_encode(['estado' => 'ok', 'mensaje' => 'Dirección proveedor actualizada correctamente']);
        } else {
            echo json_encode(['estado' => 'ok', 'mensaje' => 'No hubo cambios']);
        }

    } elseif ($accion == 'update_inventario_productos') {
        $cantidad_prod = $_POST['cantidad_prod'];
        $id_articulo_reparar = $_POST['id_articulo_reparar'];
        $resultado_anterior = $BD->query("SELECT cantidad_prod, id_articulo_reparar FROM inventario_productos");
        if (!$resultado_anterior) throw new Exception("Error al consultar inventario productos: " . $BD->error);
        $fila = $resultado_anterior->fetch_assoc();
        if (!$fila) throw new Exception("No se encontró ningún registro en inventario_productos");
        if ($fila['cantidad_prod'] != $cantidad_prod || $fila['id_articulo_reparar'] != $id_articulo_reparar) {
            $sql = "UPDATE inventario_productos SET cantidad_prod = '$cantidad_prod', id_articulo_reparar = '$id_articulo_reparar' WHERE id_articulo_reparar = '{$fila['id_articulo_reparar']}'";
            $resultado = $BD->query($sql);
            if (!$resultado) throw new Exception("Error al actualizar inventario productos: " . $BD->error);
            echo json_encode(['estado' => 'ok', 'mensaje' => 'Inventario productos actualizado correctamente']);
        } else {
            echo json_encode(['estado' => 'ok', 'mensaje' => 'No hubo cambios']);
        }

    } elseif ($accion == 'update_inventario_repuestos') {
        $cantidad_rep = $_POST['cantidad_rep'];
        $id_repuesto = $_POST['id_repuesto'];
        $resultado_anterior = $BD->query("SELECT cantidad_rep, id_repuesto FROM inventario_repuestos");
        if (!$resultado_anterior) throw new Exception("Error al consultar inventario repuestos: " . $BD->error);
        $fila = $resultado_anterior->fetch_assoc();
        if (!$fila) throw new Exception("No se encontró ningún registro en inventario_repuestos");
        if ($fila['cantidad_rep'] != $cantidad_rep || $fila['id_repuesto'] != $id_repuesto) {
            $sql = "UPDATE inventario_repuestos SET cantidad_rep = '$cantidad_rep', id_repuesto = '$id_repuesto' WHERE id_repuesto = '{$fila['id_repuesto']}'";
            $resultado = $BD->query($sql);
            if (!$resultado) throw new Exception("Error al actualizar inventario repuestos: " . $BD->error);
            echo json_encode(['estado' => 'ok', 'mensaje' => 'Inventario repuestos actualizado correctamente']);
        } else {
            echo json_encode(['estado' => 'ok', 'mensaje' => 'No hubo cambios']);
        }

    } elseif ($accion == 'update_contrato_empleado') {
        $fecha_cont = $_POST['fecha_cont'];
        $turno = $_POST['turno'];
        $id_sueldo = $_POST['id_sueldo'];
        $resultado_anterior = $BD->query("SELECT fecha_cont, turno, id_sueldo FROM contrato_empleado");
        if (!$resultado_anterior) throw new Exception("Error al consultar contrato empleado: " . $BD->error);
        $fila = $resultado_anterior->fetch_assoc();
        if (!$fila) throw new Exception("No se encontró ningún registro en contrato_empleado");
        if ($fila['fecha_cont'] != $fecha_cont || $fila['turno'] != $turno || $fila['id_sueldo'] != $id_sueldo) {
            $sql = "UPDATE contrato_empleado SET fecha_cont = '$fecha_cont', turno = '$turno', id_sueldo = '$id_sueldo' WHERE id_sueldo = '{$fila['id_sueldo']}'";
            $resultado = $BD->query($sql);
            if (!$resultado) throw new Exception("Error al actualizar contrato empleado: " . $BD->error);
            echo json_encode(['estado' => 'ok', 'mensaje' => 'Contrato empleado actualizado correctamente']);
        } else {
            echo json_encode(['estado' => 'ok', 'mensaje' => 'No hubo cambios']);
        }

    } elseif ($accion == 'update_repuestos') {
        $nombre_rep = $_POST['nombre_rep'];
        $tipo_rep = $_POST['tipo_rep'];
        $id_precio = $_POST['id_precio'];
        $resultado_anterior = $BD->query("SELECT nombre_rep, tipo_rep, id_precio FROM repuestos");
        if (!$resultado_anterior) throw new Exception("Error al consultar repuestos: " . $BD->error);
        $fila = $resultado_anterior->fetch_assoc();
        if (!$fila) throw new Exception("No se encontró ningún registro en repuestos");
        if ($fila['nombre_rep'] != $nombre_rep || $fila['tipo_rep'] != $tipo_rep || $fila['id_precio'] != $id_precio) {
            $sql = "UPDATE repuestos SET nombre_rep = '$nombre_rep', tipo_rep = '$tipo_rep', id_precio = '$id_precio' WHERE nombre_rep = '{$fila['nombre_rep']}'";
            $resultado = $BD->query($sql);
            if (!$resultado) throw new Exception("Error al actualizar repuesto: " . $BD->error);
            echo json_encode(['estado' => 'ok', 'mensaje' => 'Repuesto actualizado correctamente']);
        } else {
            echo json_encode(['estado' => 'ok', 'mensaje' => 'No hubo cambios']);
        }

    } elseif ($accion == 'update_factura_servicio') {
        $fecha_factura = $_POST['fecha_factura'];
        $id_pago = $_POST['id_pago'];
        $id_garantia_servicio = $_POST['id_garantia_servicio'];
        $resultado_anterior = $BD->query("SELECT fecha_factura, id_pago, id_garantia_servicio FROM factura_servicio");
        if (!$resultado_anterior) throw new Exception("Error al consultar factura: " . $BD->error);
        $fila = $resultado_anterior->fetch_assoc();
        if (!$fila) throw new Exception("No se encontró ningún registro en factura_servicio");
        if ($fila['fecha_factura'] != $fecha_factura || $fila['id_pago'] != $id_pago || $fila['id_garantia_servicio'] != $id_garantia_servicio) {
            $sql = "UPDATE factura_servicio SET fecha_factura = '$fecha_factura', id_pago = '$id_pago', id_garantia_servicio = '$id_garantia_servicio' WHERE id_garantia_servicio = '{$fila['id_garantia_servicio']}'";
            $resultado = $BD->query($sql);
            if (!$resultado) throw new Exception("Error al actualizar factura: " . $BD->error);
            echo json_encode(['estado' => 'ok', 'mensaje' => 'Factura actualizada correctamente']);
        } else {
            echo json_encode(['estado' => 'ok', 'mensaje' => 'No hubo cambios']);
        }

    } elseif ($accion == 'update_proveedor') {
        $nombre_prov = $_POST['nombre_prov'];
        $id_dire_proveedor = $_POST['id_dire_proveedor'];
        $id_repuesto = $_POST['id_repuesto'];
        $resultado_anterior = $BD->query("SELECT nombre_prov, id_dire_proveedor, id_repuesto FROM proveedor");
        if (!$resultado_anterior) throw new Exception("Error al consultar proveedor: " . $BD->error);
        $fila = $resultado_anterior->fetch_assoc();
        if (!$fila) throw new Exception("No se encontró ningún registro en proveedor");
        if ($fila['nombre_prov'] != $nombre_prov || $fila['id_dire_proveedor'] != $id_dire_proveedor || $fila['id_repuesto'] != $id_repuesto) {
            $sql = "UPDATE proveedor SET nombre_prov = '$nombre_prov', id_dire_proveedor = '$id_dire_proveedor', id_repuesto = '$id_repuesto' WHERE nombre_prov = '{$fila['nombre_prov']}'";
            $resultado = $BD->query($sql);
            if (!$resultado) throw new Exception("Error al actualizar proveedor: " . $BD->error);
            echo json_encode(['estado' => 'ok', 'mensaje' => 'Proveedor actualizado correctamente']);
        } else {
            echo json_encode(['estado' => 'ok', 'mensaje' => 'No hubo cambios']);
        }

    } elseif ($accion == 'update_presupuestos') {
        $precio_reparacion_tot = $_POST['precio_reparacion_tot'];
        $id_repuesto = $_POST['id_repuesto'];
        $resultado_anterior = $BD->query("SELECT precio_reparacion_tot, id_repuesto FROM presupuestos");
        if (!$resultado_anterior) throw new Exception("Error al consultar presupuesto: " . $BD->error);
        $fila = $resultado_anterior->fetch_assoc();
        if (!$fila) throw new Exception("No se encontró ningún registro en presupuestos");
        if ($fila['precio_reparacion_tot'] != $precio_reparacion_tot || $fila['id_repuesto'] != $id_repuesto) {
            $sql = "UPDATE presupuestos SET precio_reparacion_tot = '$precio_reparacion_tot', id_repuesto = '$id_repuesto' WHERE id_repuesto = '{$fila['id_repuesto']}'";
            $resultado = $BD->query($sql);
            if (!$resultado) throw new Exception("Error al actualizar presupuesto: " . $BD->error);
            echo json_encode(['estado' => 'ok', 'mensaje' => 'Presupuesto actualizado correctamente']);
        } else {
            echo json_encode(['estado' => 'ok', 'mensaje' => 'No hubo cambios']);
        }

    } elseif ($accion == 'update_sucursales') {
        $cant_empleados = $_POST['cant_empleados'];
        $reparaciones_hechas = $_POST['reparaciones_hechas'];
        $id_dire_sucursal = $_POST['id_dire_sucursal'];
        $id_inv_repuestos = $_POST['id_inv_repuestos'];
        $id_inv_productos = $_POST['id_inv_productos'];
        $id_impuestos = $_POST['id_impuestos'];
        $resultado_anterior = $BD->query("SELECT cant_empleados, reparaciones_hechas, id_dire_sucursal, id_inv_repuestos, id_inv_productos, id_impuestos FROM sucursales");
        if (!$resultado_anterior) throw new Exception("Error al consultar sucursal: " . $BD->error);
        $fila = $resultado_anterior->fetch_assoc();
        if (!$fila) throw new Exception("No se encontró ningún registro en sucursales");
        if ($fila['cant_empleados'] != $cant_empleados || $fila['reparaciones_hechas'] != $reparaciones_hechas || $fila['id_dire_sucursal'] != $id_dire_sucursal || $fila['id_inv_repuestos'] != $id_inv_repuestos || $fila['id_inv_productos'] != $id_inv_productos || $fila['id_impuestos'] != $id_impuestos) {
            $sql = "UPDATE sucursales SET cant_empleados = '$cant_empleados', reparaciones_hechas = '$reparaciones_hechas', id_dire_sucursal = '$id_dire_sucursal', id_inv_repuestos = '$id_inv_repuestos', id_inv_productos = '$id_inv_productos', id_impuestos = '$id_impuestos' WHERE id_dire_sucursal = '{$fila['id_dire_sucursal']}'";
            $resultado = $BD->query($sql);
            if (!$resultado) throw new Exception("Error al actualizar sucursal: " . $BD->error);
            echo json_encode(['estado' => 'ok', 'mensaje' => 'Sucursal actualizada correctamente']);
        } else {
            echo json_encode(['estado' => 'ok', 'mensaje' => 'No hubo cambios']);
        }

    } elseif ($accion == 'update_empleado') {
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
        $resultado_anterior = $BD->query("SELECT nombre_emple, apellido_emple, dni_emple, telefono_emple, horas_trabajdas, horas_extra, id_dire_empleado, id_contrato_emple, id_sucursal, id_seguro FROM empleado");
        if (!$resultado_anterior) throw new Exception("Error al consultar empleado: " . $BD->error);
        $fila = $resultado_anterior->fetch_assoc();
        if (!$fila) throw new Exception("No se encontró ningún registro en empleado");
        if ($fila['nombre_emple'] != $nombre_emple || $fila['apellido_emple'] != $apellido_emple || $fila['dni_emple'] != $dni_emple || $fila['telefono_emple'] != $telefono_emple || $fila['horas_trabajdas'] != $horas_trabajdas || $fila['horas_extra'] != $horas_extra || $fila['id_dire_empleado'] != $id_dire_empleado || $fila['id_contrato_emple'] != $id_contrato_emple || $fila['id_sucursal'] != $id_sucursal || $fila['id_seguro'] != $id_seguro) {
            $sql = "UPDATE empleado SET nombre_emple = '$nombre_emple', apellido_emple = '$apellido_emple', dni_emple = '$dni_emple', telefono_emple = '$telefono_emple', horas_trabajdas = '$horas_trabajdas', horas_extra = '$horas_extra', id_dire_empleado = '$id_dire_empleado', id_contrato_emple = '$id_contrato_emple', id_sucursal = '$id_sucursal', id_seguro = '$id_seguro' WHERE dni_emple = '{$fila['dni_emple']}'";
            $resultado = $BD->query($sql);
            if (!$resultado) throw new Exception("Error al actualizar empleado: " . $BD->error);
            echo json_encode(['estado' => 'ok', 'mensaje' => 'Empleado actualizado correctamente']);
        } else {
            echo json_encode(['estado' => 'ok', 'mensaje' => 'No hubo cambios']);
        }

    } elseif ($accion == 'update_orden_servicio') {
        $fecha_orden = $_POST['fecha_orden'];
        $fecha_est_fin = $_POST['fecha_est_fin'];
        $id_sucursal = $_POST['id_sucursal'];
        $id_articulo_reparar = $_POST['id_articulo_reparar'];
        $id_presupuesto = $_POST['id_presupuesto'];
        $resultado_anterior = $BD->query("SELECT fecha_orden, fecha_est_fin, id_sucursal, id_articulo_reparar, id_presupuesto FROM orden_servicio");
        if (!$resultado_anterior) throw new Exception("Error al consultar orden de servicio: " . $BD->error);
        $fila = $resultado_anterior->fetch_assoc();
        if (!$fila) throw new Exception("No se encontró ningún registro en orden_servicio");
        if ($fila['fecha_orden'] != $fecha_orden || $fila['fecha_est_fin'] != $fecha_est_fin || $fila['id_sucursal'] != $id_sucursal || $fila['id_articulo_reparar'] != $id_articulo_reparar || $fila['id_presupuesto'] != $id_presupuesto) {
            $sql = "UPDATE orden_servicio SET fecha_orden = '$fecha_orden', fecha_est_fin = '$fecha_est_fin', id_sucursal = '$id_sucursal', id_articulo_reparar = '$id_articulo_reparar', id_presupuesto = '$id_presupuesto' WHERE id_articulo_reparar = '{$fila['id_articulo_reparar']}'";
            $resultado = $BD->query($sql);
            if (!$resultado) throw new Exception("Error al actualizar orden de servicio: " . $BD->error);
            echo json_encode(['estado' => 'ok', 'mensaje' => 'Orden de servicio actualizada correctamente']);
        } else {
            echo json_encode(['estado' => 'ok', 'mensaje' => 'No hubo cambios']);
        }

    } elseif ($accion == 'update_cliente') {
        $nombre_cli = $_POST['nombre_cli'];
        $apellido_cli = $_POST['apellido_cli'];
        $dni_cli = $_POST['dni_cli'];
        $telefono_cli = $_POST['telefono_cli'];
        $id_dire_cliente = $_POST['id_dire_cliente'];
        $id_orden_servicio = $_POST['id_orden_servicio'];
        $resultado_anterior = $BD->query("SELECT nombre_cli, apellido_cli, dni_cli, telefono_cli, id_dire_cliente, id_orden_servicio FROM cliente");
        if (!$resultado_anterior) throw new Exception("Error al consultar cliente: " . $BD->error);
        $fila = $resultado_anterior->fetch_assoc();
        if (!$fila) throw new Exception("No se encontró ningún registro en cliente");
        if ($fila['nombre_cli'] != $nombre_cli || $fila['apellido_cli'] != $apellido_cli || $fila['dni_cli'] != $dni_cli || $fila['telefono_cli'] != $telefono_cli || $fila['id_dire_cliente'] != $id_dire_cliente || $fila['id_orden_servicio'] != $id_orden_servicio) {
            $sql = "UPDATE cliente SET nombre_cli = '$nombre_cli', apellido_cli = '$apellido_cli', dni_cli = '$dni_cli', telefono_cli = '$telefono_cli', id_dire_cliente = '$id_dire_cliente', id_orden_servicio = '$id_orden_servicio' WHERE dni_cli = '{$fila['dni_cli']}'";
            $resultado = $BD->query($sql);
            if (!$resultado) throw new Exception("Error al actualizar cliente: " . $BD->error);
            echo json_encode(['estado' => 'ok', 'mensaje' => 'Cliente actualizado correctamente']);
        } else {
            echo json_encode(['estado' => 'ok', 'mensaje' => 'No hubo cambios']);
        }

    } elseif ($accion == 'update_orden_entrega') {
        $fecha_entrega = $_POST['fecha_entrega'];
        $id_orden_servicio = $_POST['id_orden_servicio'];
        $id_factura_servicio = $_POST['id_factura_servicio'];
        $resultado_anterior = $BD->query("SELECT fecha_entrega, id_orden_servicio, id_factura_servicio FROM orden_entrega");
        if (!$resultado_anterior) throw new Exception("Error al consultar orden de entrega: " . $BD->error);
        $fila = $resultado_anterior->fetch_assoc();
        if (!$fila) throw new Exception("No se encontró ningún registro en orden_entrega");
        if ($fila['fecha_entrega'] != $fecha_entrega || $fila['id_orden_servicio'] != $id_orden_servicio || $fila['id_factura_servicio'] != $id_factura_servicio) {
            $sql = "UPDATE orden_entrega SET fecha_entrega = '$fecha_entrega', id_orden_servicio = '$id_orden_servicio', id_factura_servicio = '$id_factura_servicio' WHERE id_orden_servicio = '{$fila['id_orden_servicio']}'";
            $resultado = $BD->query($sql);
            if (!$resultado) throw new Exception("Error al actualizar orden de entrega: " . $BD->error);
            echo json_encode(['estado' => 'ok', 'mensaje' => 'Orden de entrega actualizada correctamente']);
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