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
        $tipo_art_rep   = $_POST['tipo_art_rep'];
        $fallas         = $_POST['fallas'];
        $sql = "INSERT INTO articulo_reparar (nombre_art_rep, tipo_art_rep, fallas) VALUES ('$nombre_art_rep', '$tipo_art_rep', '$fallas')";
        $resultado = $BD->query($sql);
        if (!$resultado) throw new Exception("Error al insertar artículo: " . $BD->error);
        echo json_encode(['estado' => 'ok', 'mensaje' => 'Artículo insertado correctamente']);

    } elseif ($accion == 'insert_pago') {
        $nombre_banco  = $_POST['nombre_banco'];
        $numero_cuenta = $_POST['numero_cuenta'];
        $comprobante   = $_POST['comprobante'];
        $sql = "INSERT INTO pago (nombre_banco, numero_cuenta, comprobante) VALUES ('$nombre_banco', '$numero_cuenta', '$comprobante')";
        $resultado = $BD->query($sql);
        if (!$resultado) throw new Exception("Error al insertar pago: " . $BD->error);
        echo json_encode(['estado' => 'ok', 'mensaje' => 'Pago insertado correctamente']);

    } elseif ($accion == 'insert_localidad') {
        $pais      = $_POST['pais'];
        $provincia = $_POST['provincia'];
        $ciudad    = $_POST['ciudad'];
        $barrio    = $_POST['barrio'];
        $sql = "INSERT INTO localidad (pais, provincia, ciudad, barrio) VALUES ('$pais', '$provincia', '$ciudad', '$barrio')";
        $resultado = $BD->query($sql);
        if (!$resultado) throw new Exception("Error al insertar localidad: " . $BD->error);
        echo json_encode(['estado' => 'ok', 'mensaje' => 'Localidad insertada correctamente']);

    } elseif ($accion == 'insert_garantia_servicio') {
        $tiempo_garantia = $_POST['tiempo_garantia'];
        $tipo_garantia   = $_POST['tipo_garantia'];
        $sql = "INSERT INTO garantia_servicio (tiempo_garantia, tipo_garantia) VALUES ('$tiempo_garantia', '$tipo_garantia')";
        $resultado = $BD->query($sql);
        if (!$resultado) throw new Exception("Error al insertar garantía: " . $BD->error);
        echo json_encode(['estado' => 'ok', 'mensaje' => 'Garantía insertada correctamente']);

    } elseif ($accion == 'insert_sueldo') {
        $sueldo_hora     = $_POST['sueldo_hora'];
        $sueldo_hora_ext = $_POST['sueldo_hora_ext'];
        $forma_pago      = $_POST['forma_pago'];
        $sql = "INSERT INTO sueldo (sueldo_hora, sueldo_hora_ext, forma_pago) VALUES ('$sueldo_hora', '$sueldo_hora_ext', '$forma_pago')";
        $resultado = $BD->query($sql);
        if (!$resultado) throw new Exception("Error al insertar sueldo: " . $BD->error);
        echo json_encode(['estado' => 'ok', 'mensaje' => 'Sueldo insertado correctamente']);

    } elseif ($accion == 'insert_impuestos') {
        $tipo_imp  = $_POST['tipo_imp'];
        $monto_imp = $_POST['monto_imp'];
        $sql = "INSERT INTO impuestos (tipo_imp, monto_imp) VALUES ('$tipo_imp', '$monto_imp')";
        $resultado = $BD->query($sql);
        if (!$resultado) throw new Exception("Error al insertar impuesto: " . $BD->error);
        echo json_encode(['estado' => 'ok', 'mensaje' => 'Impuesto insertado correctamente']);

    } elseif ($accion == 'insert_seguro') {
        $tipo_seg    = $_POST['tipo_seg'];
        $nombre_aseg = $_POST['nombre_aseg'];
        $monto_aseg  = $_POST['monto_aseg'];
        $sql = "INSERT INTO seguro (tipo_seg, nombre_aseg, monto_aseg) VALUES ('$tipo_seg', '$nombre_aseg', '$monto_aseg')";
        $resultado = $BD->query($sql);
        if (!$resultado) throw new Exception("Error al insertar seguro: " . $BD->error);
        echo json_encode(['estado' => 'ok', 'mensaje' => 'Seguro insertado correctamente']);

    } elseif ($accion == 'insert_direccion_empleado') {
        $calle_emp      = $_POST['calle_emp'];
        $altura_emp     = $_POST['altura_emp'];
        $cod_postal_emp = $_POST['cod_postal_emp'];
        $id_localidad   = $_POST['id_localidad'];
        $sql = "INSERT INTO direccion_empleado (calle_emp, altura_emp, cod_postal_emp, id_localidad) VALUES ('$calle_emp', '$altura_emp', '$cod_postal_emp', '$id_localidad')";
        $resultado = $BD->query($sql);
        if (!$resultado) throw new Exception("Error al insertar dirección empleado: " . $BD->error);
        echo json_encode(['estado' => 'ok', 'mensaje' => 'Dirección empleado insertada correctamente']);

    } elseif ($accion == 'insert_direccion_cliente') {
        $calle_cli      = $_POST['calle_cli'];
        $altura_cli     = $_POST['altura_cli'];
        $cod_postal_cli = $_POST['cod_postal_cli'];
        $id_localidad   = $_POST['id_localidad'];
        $sql = "INSERT INTO direccion_cliente (calle_cli, altura_cli, cod_postal_cli, id_localidad) VALUES ('$calle_cli', '$altura_cli', '$cod_postal_cli', '$id_localidad')";
        $resultado = $BD->query($sql);
        if (!$resultado) throw new Exception("Error al insertar dirección cliente: " . $BD->error);
        echo json_encode(['estado' => 'ok', 'mensaje' => 'Dirección cliente insertada correctamente']);

    } elseif ($accion == 'insert_direccion_sucursal') {
        $calle_suc      = $_POST['calle_suc'];
        $altura_suc     = $_POST['altura_suc'];
        $cod_postal_suc = $_POST['cod_postal_suc'];
        $id_localidad   = $_POST['id_localidad'];
        $sql = "INSERT INTO direccion_sucursal (calle_suc, altura_suc, cod_postal_suc, id_localidad) VALUES ('$calle_suc', '$altura_suc', '$cod_postal_suc', '$id_localidad')";
        $resultado = $BD->query($sql);
        if (!$resultado) throw new Exception("Error al insertar dirección sucursal: " . $BD->error);
        echo json_encode(['estado' => 'ok', 'mensaje' => 'Dirección sucursal insertada correctamente']);

    } elseif ($accion == 'insert_direccion_proveedor') {
        $calle_prov      = $_POST['calle_prov'];
        $altura_prov     = $_POST['altura_prov'];
        $cod_postal_prov = $_POST['cod_postal_prov'];
        $id_localidad    = $_POST['id_localidad'];
        $sql = "INSERT INTO direccion_proveedor (calle_prov, altura_prov, cod_postal_prov, id_localidad) VALUES ('$calle_prov', '$altura_prov', '$cod_postal_prov', '$id_localidad')";
        $resultado = $BD->query($sql);
        if (!$resultado) throw new Exception("Error al insertar dirección proveedor: " . $BD->error);
        echo json_encode(['estado' => 'ok', 'mensaje' => 'Dirección proveedor insertada correctamente']);

    } elseif ($accion == 'insert_inventario_productos') {
        $cantidad_prod       = $_POST['cantidad_prod'];
        $id_articulo_reparar = $_POST['id_articulo_reparar'];
        $BD->begin_transaction();
        $BD->query("INSERT INTO inventario_productos (cantidad_prod) VALUES ('$cantidad_prod')");
        if ($BD->error) { $BD->rollback(); throw new Exception("Error al insertar inventario productos: " . $BD->error); }
        $id_inv_productos = $BD->insert_id;
        $BD->query("INSERT INTO intermedia_inv_prod (id_inv_productos, id_articulo_reparar) VALUES ('$id_inv_productos', '$id_articulo_reparar')");
        if ($BD->error) { $BD->rollback(); throw new Exception("Error al insertar relación inventario-producto: " . $BD->error); }
        $BD->commit();
        echo json_encode(['estado' => 'ok', 'mensaje' => 'Inventario productos insertado correctamente']);

    } elseif ($accion == 'insert_inventario_repuestos') {
        $cantidad_rep = $_POST['cantidad_rep'];
        $id_repuesto  = $_POST['id_repuesto'];
        $BD->begin_transaction();
        $BD->query("INSERT INTO inventario_repuestos (cantidad_rep) VALUES ('$cantidad_rep')");
        if ($BD->error) { $BD->rollback(); throw new Exception("Error al insertar inventario repuestos: " . $BD->error); }
        $id_inv_repuestos = $BD->insert_id;
        $BD->query("INSERT INTO intermedia_inv_rep (id_inv_repuestos, id_repuesto) VALUES ('$id_inv_repuestos', '$id_repuesto')");
        if ($BD->error) { $BD->rollback(); throw new Exception("Error al insertar relación inventario-repuesto: " . $BD->error); }
        $BD->commit();
        echo json_encode(['estado' => 'ok', 'mensaje' => 'Inventario repuestos insertado correctamente']);

    } elseif ($accion == 'insert_sucursales') {
        $cant_empleados      = $_POST['cant_empleados'];
        $reparaciones_hechas = $_POST['reparaciones_hechas'];
        $id_dire_sucursal    = $_POST['id_dire_sucursal'];
        $id_inv_repuestos    = $_POST['id_inv_repuestos'];
        $id_inv_productos    = $_POST['id_inv_productos'];
        $id_impuestos        = $_POST['id_impuestos'];
        $sql = "INSERT INTO sucursales (cant_empleados, reparaciones_hechas, id_dire_sucursal, id_inv_repuestos, id_inv_productos, id_impuestos)
        VALUES ('$cant_empleados', '$reparaciones_hechas', '$id_dire_sucursal', '$id_inv_repuestos', '$id_inv_productos', '$id_impuestos')";
        $resultado = $BD->query($sql);
        if (!$resultado) throw new Exception("Error al insertar sucursal: " . $BD->error);
        echo json_encode(['estado' => 'ok', 'mensaje' => 'Sucursal insertada correctamente']);

    } elseif ($accion == 'insert_empleado') {
        $nombre_emple     = $_POST['nombre_emple'];
        $apellido_emple   = $_POST['apellido_emple'];
        $dni_emple        = $_POST['dni_emple'];
        $telefono_emple   = $_POST['telefono_emple'];
        $horas_trabajdas  = $_POST['horas_trabajdas'];
        $horas_extra      = $_POST['horas_extra'];
        $jefe_sucursal    = $_POST['jefe_sucursal'];
        $jefe_general     = $_POST['jefe_general'];
        $id_dire_empleado  = $_POST['id_dire_empleado'];
        $id_contrato_emple = $_POST['id_contrato_emple'];
        $id_sucursal      = $_POST['id_sucursal'];
        $id_seguro        = $_POST['id_seguro'];
        $sql = "INSERT INTO empleado (nombre_emple, apellido_emple, dni_emple, telefono_emple, horas_trabajdas, horas_extra, jefe_sucursal, jefe_general, id_dire_empleado, id_contrato_emple, id_sucursal, id_seguro)
        VALUES ('$nombre_emple', '$apellido_emple', '$dni_emple', '$telefono_emple', '$horas_trabajdas', '$horas_extra', '$jefe_sucursal', '$jefe_general', '$id_dire_empleado', '$id_contrato_emple', '$id_sucursal', '$id_seguro')";
        $resultado = $BD->query($sql);
        if (!$resultado) throw new Exception("Error al insertar empleado: " . $BD->error);
        echo json_encode(['estado' => 'ok', 'mensaje' => 'Empleado insertado correctamente']);

    } elseif ($accion == 'insert_sucursales_proveedor') {
        $id_proveedor = $_POST['id_proveedor'];
        $id_sucursal  = $_POST['id_sucursal'];
        $sql = "INSERT INTO sucursales_proveedor (id_proveedor, id_sucursal) VALUES ('$id_proveedor', '$id_sucursal')";
        $resultado = $BD->query($sql);
        if (!$resultado) throw new Exception("Error al insertar sucursal_proveedor: " . $BD->error);
        echo json_encode(['estado' => 'ok', 'mensaje' => 'Sucursal-Proveedor insertado correctamente']);

    } elseif ($accion == 'insert_orden_servicio') {
        $fecha_orden         = $_POST['fecha_orden'];
        $fecha_est_fin       = $_POST['fecha_est_fin'];
        $id_sucursal         = $_POST['id_sucursal'];
        $id_articulo_reparar = $_POST['id_articulo_reparar'];
        $id_presupuesto      = $_POST['id_presupuesto'];
        $id_cliente          = $_POST['id_cliente'];
        $sql = "INSERT INTO orden_servicio (fecha_orden, fecha_est_fin, id_sucursal, id_articulo_reparar, id_presupuesto, id_cliente)
        VALUES ('$fecha_orden', '$fecha_est_fin', '$id_sucursal', '$id_articulo_reparar', '$id_presupuesto', '$id_cliente')";
        $resultado = $BD->query($sql);
        if (!$resultado) throw new Exception("Error al insertar orden de servicio: " . $BD->error);
        echo json_encode(['estado' => 'ok', 'mensaje' => 'Orden de servicio insertada correctamente']);

    } elseif ($accion == 'crear_orden_completa') {

        $nombre_art_rep   = $BD->real_escape_string($_POST['nombre_art_rep']  ?? '');
        $tipo_art_rep     = $BD->real_escape_string($_POST['tipo_art_rep']    ?? '');
        $fallas           = $BD->real_escape_string($_POST['fallas']          ?? '');
        $precio_mano_obra = intval($_POST['precio_mano_obra'] ?? 0);
        $id_repuesto_1    = intval($_POST['id_repuesto_1']    ?? 0);
        $id_repuesto_2    = intval($_POST['id_repuesto_2']    ?? 0);
        $id_repuesto_3    = intval($_POST['id_repuesto_3']    ?? 0);
        $id_sucursal      = intval($_POST['id_sucursal']      ?? 0);
        $id_cliente       = intval($_POST['id_cliente']       ?? 0);

        if (!$nombre_art_rep || !$tipo_art_rep || !$id_repuesto_1 || !$id_sucursal || !$id_cliente) {
            throw new Exception("Faltan campos requeridos: nombre_art_rep, tipo_art_rep, id_repuesto_1, id_sucursal, id_cliente");
        }

        // Armar lista de repuestos válidos (sin duplicados ni ceros)
        $ids_repuestos = array_unique(array_filter([$id_repuesto_1, $id_repuesto_2, $id_repuesto_3]));
        $ids_str = implode(',', $ids_repuestos);

        // Calcular total de precios de repuestos en PHP
        $res_precios = $BD->query("SELECT SUM(p.precio_rep) AS total_rep
        FROM repuestos r
        JOIN precio p ON r.id_precio = p.id_precio
        WHERE r.id_repuesto IN ($ids_str)");
        if (!$res_precios) throw new Exception("Error al calcular precios: " . $BD->error);
        $fila_precio = $res_precios->fetch_assoc();
        $precio_reparacion_tot = $precio_mano_obra + intval($fila_precio['total_rep']);

        $BD->begin_transaction();

        // 1. Insertar artículo a reparar
        $BD->query("INSERT INTO articulo_reparar (nombre_art_rep, tipo_art_rep, fallas)
        VALUES ('$nombre_art_rep', '$tipo_art_rep', '$fallas')");
        if ($BD->error) { $BD->rollback(); throw new Exception("Error al insertar artículo: " . $BD->error); }
        $id_articulo_reparar = $BD->insert_id;

        // 2. Insertar presupuesto con el total calculado
        $BD->query("INSERT INTO presupuestos (precio_reparacion_tot) VALUES ($precio_reparacion_tot)");
        if ($BD->error) { $BD->rollback(); throw new Exception("Error al insertar presupuesto: " . $BD->error); }
        $id_presupuesto = $BD->insert_id;

        // 3. Relacionar presupuesto con cada repuesto (tabla intermedia)
        foreach ($ids_repuestos as $id_rep) {
            $BD->query("INSERT INTO intermedia_rep_pres (id_presupuesto, id_repuesto) VALUES ($id_presupuesto, $id_rep)");
            if ($BD->error) { $BD->rollback(); throw new Exception("Error al relacionar presupuesto-repuesto: " . $BD->error); }
        }

        // 4. Insertar orden de servicio: fecha actual y estimado +3 días
        $BD->query("INSERT INTO orden_servicio (fecha_orden, fecha_est_fin, id_sucursal, id_articulo_reparar, id_presupuesto, id_cliente)
        VALUES (CURDATE(), DATE_ADD(CURDATE(), INTERVAL 3 DAY), $id_sucursal, $id_articulo_reparar, $id_presupuesto, $id_cliente)");
        if ($BD->error) { $BD->rollback(); throw new Exception("Error al insertar orden de servicio: " . $BD->error); }
        $id_orden_servicio = $BD->insert_id;

        $BD->commit();
        echo json_encode([
            'estado'                => 'ok',
            'mensaje'               => 'Orden creada correctamente',
            'id_orden_servicio'     => $id_orden_servicio,
            'id_articulo_reparar'   => $id_articulo_reparar,
            'id_presupuesto'        => $id_presupuesto,
            'precio_reparacion_tot' => $precio_reparacion_tot,
            'fecha_orden'           => date('Y-m-d'),
                         'fecha_est_fin'         => date('Y-m-d', strtotime('+3 days'))
        ]);

    } elseif ($accion == 'insert_cliente') {
        $nombre_cli      = $_POST['nombre_cli'];
        $apellido_cli    = $_POST['apellido_cli'];
        $dni_cli         = $_POST['dni_cli'];
        $telefono_cli    = $_POST['telefono_cli'];
        $id_dire_cliente = $_POST['id_dire_cliente'];
        $sql = "INSERT INTO cliente (nombre_cli, apellido_cli, dni_cli, telefono_cli, id_dire_cliente)
        VALUES ('$nombre_cli', '$apellido_cli', '$dni_cli', '$telefono_cli', '$id_dire_cliente')";
        $resultado = $BD->query($sql);
        if (!$resultado) throw new Exception("Error al insertar cliente: " . $BD->error);
        echo json_encode(['estado' => 'ok', 'mensaje' => 'Cliente insertado correctamente']);

    } elseif ($accion == 'insert_intermedia_inv_rep') {
        $id_inv_repuestos = $_POST['id_inv_repuestos'];
        $id_repuesto      = $_POST['id_repuesto'];
        $sql = "INSERT INTO intermedia_inv_rep (id_inv_repuestos, id_repuesto) VALUES ('$id_inv_repuestos', '$id_repuesto')";
        $resultado = $BD->query($sql);
        if (!$resultado) throw new Exception("Error al insertar intermedia_inv_rep: " . $BD->error);
        echo json_encode(['estado' => 'ok', 'mensaje' => 'Relación inventario-repuesto insertada correctamente']);

    } elseif ($accion == 'insert_intermedia_rep_pres') {
        $id_presupuesto = $_POST['id_presupuesto'];
        $id_repuesto    = $_POST['id_repuesto'];
        $sql = "INSERT INTO intermedia_rep_pres (id_presupuesto, id_repuesto) VALUES ('$id_presupuesto', '$id_repuesto')";
        $resultado = $BD->query($sql);
        if (!$resultado) throw new Exception("Error al insertar intermedia_rep_pres: " . $BD->error);
        echo json_encode(['estado' => 'ok', 'mensaje' => 'Relación presupuesto-repuesto insertada correctamente']);



    } elseif ($accion == 'crear_sucursal_nueva') {

        $cant_empleados      = intval($_POST['cant_empleados']      ?? 0);
        $reparaciones_hechas = intval($_POST['reparaciones_hechas'] ?? 0);
        $tipo_imp            = $BD->real_escape_string($_POST['tipo_imp']    ?? '');
        $calle_suc           = $BD->real_escape_string($_POST['calle_suc']   ?? '');
        $altura_suc          = intval($_POST['altura_suc']          ?? 0);
        $cod_postal_suc      = intval($_POST['cod_postal_suc']      ?? 0);
        $pais                = $BD->real_escape_string($_POST['pais']        ?? '');
        $provincia           = $BD->real_escape_string($_POST['provincia']   ?? '');
        $ciudad              = $BD->real_escape_string($_POST['ciudad']      ?? '');
        $barrio              = $BD->real_escape_string($_POST['barrio']      ?? '');

        if (!$tipo_imp || !$calle_suc || !$pais || !$provincia || !$ciudad || !$barrio) {
            throw new Exception("Faltan campos requeridos: tipo_imp, calle_suc, pais, provincia, ciudad, barrio");
        }

        // Buscar id_impuestos por nombre de tipo
        $res_imp = $BD->query("SELECT id_impuestos FROM impuestos WHERE tipo_imp = '$tipo_imp' LIMIT 1");
        if (!$res_imp || $res_imp->num_rows === 0) {
            throw new Exception("No se encontró un impuesto con tipo: $tipo_imp");
        }
        $id_impuestos = $res_imp->fetch_assoc()['id_impuestos'];

        $BD->begin_transaction();

        // Buscar localidad existente; crearla si no existe
        $res_loc = $BD->query("SELECT id_localidad FROM localidad
        WHERE pais='$pais' AND provincia='$provincia' AND ciudad='$ciudad' AND barrio='$barrio' LIMIT 1");
        if (!$res_loc) { $BD->rollback(); throw new Exception("Error al buscar localidad: " . $BD->error); }
        if ($res_loc->num_rows > 0) {
            $id_localidad = $res_loc->fetch_assoc()['id_localidad'];
        } else {
            $BD->query("INSERT INTO localidad (pais, provincia, ciudad, barrio)
            VALUES ('$pais', '$provincia', '$ciudad', '$barrio')");
            if ($BD->error) { $BD->rollback(); throw new Exception("Error al insertar localidad: " . $BD->error); }
            $id_localidad = $BD->insert_id;
        }

        // Insertar dirección de sucursal
        $BD->query("INSERT INTO direccion_sucursal (calle_suc, altura_suc, cod_postal_suc, id_localidad)
        VALUES ('$calle_suc', $altura_suc, $cod_postal_suc, $id_localidad)");
        if ($BD->error) { $BD->rollback(); throw new Exception("Error al insertar dirección sucursal: " . $BD->error); }
        $id_dire_sucursal = $BD->insert_id;

        // Crear inventario de repuestos en 0
        $BD->query("INSERT INTO inventario_repuestos (cantidad_rep) VALUES (0)");
        if ($BD->error) { $BD->rollback(); throw new Exception("Error al crear inventario repuestos: " . $BD->error); }
        $id_inv_repuestos = $BD->insert_id;

        // Crear inventario de productos en 0
        $BD->query("INSERT INTO inventario_productos (cantidad_prod) VALUES (0)");
        if ($BD->error) { $BD->rollback(); throw new Exception("Error al crear inventario productos: " . $BD->error); }
        $id_inv_productos = $BD->insert_id;

        // Insertar sucursal vinculando todos los recursos creados
        $BD->query("INSERT INTO sucursales (cant_empleados, reparaciones_hechas, id_dire_sucursal, id_inv_repuestos, id_inv_productos, id_impuestos)
        VALUES ($cant_empleados, $reparaciones_hechas, $id_dire_sucursal, $id_inv_repuestos, $id_inv_productos, $id_impuestos)");
        if ($BD->error) { $BD->rollback(); throw new Exception("Error al insertar sucursal: " . $BD->error); }
        $id_sucursal = $BD->insert_id;

        $BD->commit();
        echo json_encode([
            'estado'           => 'ok',
            'mensaje'          => 'Sucursal creada correctamente',
            'id_sucursal'      => $id_sucursal,
            'id_inv_repuestos' => $id_inv_repuestos,
            'id_inv_productos' => $id_inv_productos,
            'id_dire_sucursal' => $id_dire_sucursal,
            'id_localidad'     => $id_localidad,
            'id_impuestos'     => $id_impuestos
        ]);

    } elseif ($accion == 'insert_articulo_con_presupuesto') {

        $nombre_art_rep  = $BD->real_escape_string($_POST['nombre_art_rep'] ?? '');
        $tipo_art_rep    = $BD->real_escape_string($_POST['tipo_art_rep']   ?? '');
        $fallas          = $BD->real_escape_string($_POST['fallas']         ?? '');
        $precio_mano_obra = intval($_POST['precio_mano_obra'] ?? 0);
        $id_repuesto_1   = intval($_POST['id_repuesto_1']  ?? 0);
        $id_repuesto_2   = intval($_POST['id_repuesto_2']  ?? 0);
        $id_repuesto_3   = intval($_POST['id_repuesto_3']  ?? 0);

        if (!$nombre_art_rep || !$tipo_art_rep || !$id_repuesto_1) {
            throw new Exception("Faltan campos requeridos: nombre_art_rep, tipo_art_rep, id_repuesto_1");
        }

        // Armar lista de repuestos válidos (sin duplicados ni ceros)
        $ids_repuestos = array_unique(array_filter([$id_repuesto_1, $id_repuesto_2, $id_repuesto_3]));

        // Calcular total: precio_mano_obra + suma de precio_rep de cada repuesto
        $ids_str = implode(',', $ids_repuestos);
        $res_precios = $BD->query("SELECT SUM(p.precio_rep) AS total_rep
        FROM repuestos r
        JOIN precio p ON r.id_precio = p.id_precio
        WHERE r.id_repuesto IN ($ids_str)");
        if (!$res_precios) throw new Exception("Error al calcular precios: " . $BD->error);
        $fila_precio = $res_precios->fetch_assoc();
        $precio_reparacion_tot = $precio_mano_obra + intval($fila_precio['total_rep']);

        $BD->begin_transaction();

        // Insertar artículo
        $BD->query("INSERT INTO articulo_reparar (nombre_art_rep, tipo_art_rep, fallas)
        VALUES ('$nombre_art_rep', '$tipo_art_rep', '$fallas')");
        if ($BD->error) { $BD->rollback(); throw new Exception("Error al insertar artículo: " . $BD->error); }
        $id_articulo_reparar = $BD->insert_id;

        // Insertar presupuesto
        $BD->query("INSERT INTO presupuestos (precio_reparacion_tot)
        VALUES ($precio_reparacion_tot)");
        if ($BD->error) { $BD->rollback(); throw new Exception("Error al insertar presupuesto: " . $BD->error); }
        $id_presupuesto = $BD->insert_id;

        // Relacionar presupuesto con cada repuesto (tabla intermedia)
        foreach ($ids_repuestos as $id_rep) {
            $BD->query("INSERT INTO intermedia_rep_pres (id_presupuesto, id_repuesto)
            VALUES ($id_presupuesto, $id_rep)");
            if ($BD->error) { $BD->rollback(); throw new Exception("Error al relacionar presupuesto-repuesto: " . $BD->error); }
        }

        $BD->commit();
        echo json_encode([
            'estado'              => 'ok',
            'mensaje'             => 'Artículo y presupuesto insertados correctamente',
            'id_articulo_reparar' => $id_articulo_reparar,
            'id_presupuesto'      => $id_presupuesto,
            'precio_reparacion_tot' => $precio_reparacion_tot
        ]);



    } elseif ($accion == 'insert_sucursal_completa') {

        $cant_empleados      = intval($_POST['cant_empleados']      ?? 0);
        $reparaciones_hechas = intval($_POST['reparaciones_hechas'] ?? 0);
        $id_inv_repuestos    = intval($_POST['id_inv_repuestos']    ?? 0);
        $id_inv_productos    = intval($_POST['id_inv_productos']    ?? 0);
        $id_impuestos        = intval($_POST['id_impuestos']        ?? 0);
        $calle_suc           = $BD->real_escape_string($_POST['calle_suc']      ?? '');
        $altura_suc          = intval($_POST['altura_suc']          ?? 0);
        $cod_postal_suc      = intval($_POST['cod_postal_suc']      ?? 0);
        $pais                = $BD->real_escape_string($_POST['pais']       ?? '');
        $provincia           = $BD->real_escape_string($_POST['provincia']  ?? '');
        $ciudad              = $BD->real_escape_string($_POST['ciudad']     ?? '');
        $barrio              = $BD->real_escape_string($_POST['barrio']     ?? '');

        if (!$calle_suc || !$pais || !$provincia || !$ciudad || !$barrio) {
            throw new Exception("Faltan campos de dirección o localidad");
        }

        $BD->begin_transaction();

        // Buscar localidad existente; crearla si no existe
        $res_loc = $BD->query("SELECT id_localidad FROM localidad
        WHERE pais='$pais' AND provincia='$provincia'
        AND ciudad='$ciudad' AND barrio='$barrio'
        LIMIT 1");
        if (!$res_loc) { $BD->rollback(); throw new Exception("Error al buscar localidad: " . $BD->error); }

        if ($res_loc->num_rows > 0) {
            $id_localidad = $res_loc->fetch_assoc()['id_localidad'];
        } else {
            $BD->query("INSERT INTO localidad (pais, provincia, ciudad, barrio)
            VALUES ('$pais', '$provincia', '$ciudad', '$barrio')");
            if ($BD->error) { $BD->rollback(); throw new Exception("Error al insertar localidad: " . $BD->error); }
            $id_localidad = $BD->insert_id;
        }

        // Insertar dirección de sucursal
        $BD->query("INSERT INTO direccion_sucursal (calle_suc, altura_suc, cod_postal_suc, id_localidad)
        VALUES ('$calle_suc', $altura_suc, $cod_postal_suc, $id_localidad)");
        if ($BD->error) { $BD->rollback(); throw new Exception("Error al insertar dirección sucursal: " . $BD->error); }
        $id_dire_sucursal = $BD->insert_id;

        // Insertar sucursal
        $BD->query("INSERT INTO sucursales (cant_empleados, reparaciones_hechas, id_dire_sucursal, id_inv_repuestos, id_inv_productos, id_impuestos)
        VALUES ($cant_empleados, $reparaciones_hechas, $id_dire_sucursal, $id_inv_repuestos, $id_inv_productos, $id_impuestos)");
        if ($BD->error) { $BD->rollback(); throw new Exception("Error al insertar sucursal: " . $BD->error); }
        $id_sucursal = $BD->insert_id;

        $BD->commit();
        echo json_encode([
            'estado'           => 'ok',
            'mensaje'          => 'Sucursal creada correctamente',
            'id_sucursal'      => $id_sucursal,
            'id_dire_sucursal' => $id_dire_sucursal,
            'id_localidad'     => $id_localidad
        ]);



    } elseif ($accion == 'insert_repuesto_completo') {

        $nombre_rep       = $BD->real_escape_string($_POST['nombre_rep']      ?? '');
        $tipo_rep         = $BD->real_escape_string($_POST['tipo_rep']        ?? '');
        $precio_mano_obra = intval($_POST['precio_mano_obra'] ?? 0);
        $precio_rep_val   = intval($_POST['precio_rep']       ?? 0);

        if (!$nombre_rep || !$tipo_rep) {
            throw new Exception("Faltan campos requeridos: nombre_rep, tipo_rep");
        }

        $BD->begin_transaction();

        // Buscar precio existente con los mismos valores; crearlo si no existe
        $res_precio = $BD->query("SELECT id_precio FROM precio
        WHERE precio_mano_obra = $precio_mano_obra
        AND precio_rep = $precio_rep_val
        LIMIT 1");
        if (!$res_precio) { $BD->rollback(); throw new Exception("Error al buscar precio: " . $BD->error); }

        if ($res_precio->num_rows > 0) {
            $id_precio = $res_precio->fetch_assoc()['id_precio'];
        } else {
            $BD->query("INSERT INTO precio (precio_mano_obra, precio_rep)
            VALUES ($precio_mano_obra, $precio_rep_val)");
            if ($BD->error) { $BD->rollback(); throw new Exception("Error al insertar precio: " . $BD->error); }
            $id_precio = $BD->insert_id;
        }

        // Insertar repuesto vinculado al precio
        $BD->query("INSERT INTO repuestos (nombre_rep, tipo_rep, id_precio)
        VALUES ('$nombre_rep', '$tipo_rep', $id_precio)");
        if ($BD->error) { $BD->rollback(); throw new Exception("Error al insertar repuesto: " . $BD->error); }
        $id_repuesto = $BD->insert_id;

        $BD->commit();
        echo json_encode([
            'estado'      => 'ok',
            'mensaje'     => 'Repuesto insertado correctamente',
            'id_repuesto' => $id_repuesto,
            'id_precio'   => $id_precio
        ]);



    } elseif ($accion == 'insert_proveedor_completo') {

        $nombre_prov     = $BD->real_escape_string($_POST['nombre_prov']  ?? '');
        $id_repuesto     = intval($_POST['id_repuesto']     ?? 0);
        $calle_prov      = $BD->real_escape_string($_POST['calle_prov']   ?? '');
        $altura_prov     = intval($_POST['altura_prov']     ?? 0);
        $cod_postal_prov = intval($_POST['cod_postal_prov'] ?? 0);
        $pais            = $BD->real_escape_string($_POST['pais']       ?? '');
        $provincia       = $BD->real_escape_string($_POST['provincia']  ?? '');
        $ciudad          = $BD->real_escape_string($_POST['ciudad']     ?? '');
        $barrio          = $BD->real_escape_string($_POST['barrio']     ?? '');

        if (!$nombre_prov || !$id_repuesto || !$calle_prov || !$pais || !$provincia || !$ciudad || !$barrio) {
            throw new Exception("Faltan campos requeridos para el proveedor o su dirección");
        }

        $BD->begin_transaction();

        // Buscar localidad existente; crearla si no existe
        $res_loc = $BD->query("SELECT id_localidad FROM localidad
        WHERE pais='$pais' AND provincia='$provincia'
        AND ciudad='$ciudad' AND barrio='$barrio'
        LIMIT 1");
        if (!$res_loc) { $BD->rollback(); throw new Exception("Error al buscar localidad: " . $BD->error); }

        if ($res_loc->num_rows > 0) {
            $id_localidad = $res_loc->fetch_assoc()['id_localidad'];
        } else {
            $BD->query("INSERT INTO localidad (pais, provincia, ciudad, barrio)
            VALUES ('$pais', '$provincia', '$ciudad', '$barrio')");
            if ($BD->error) { $BD->rollback(); throw new Exception("Error al insertar localidad: " . $BD->error); }
            $id_localidad = $BD->insert_id;
        }

        // Insertar dirección del proveedor
        $BD->query("INSERT INTO direccion_proveedor (calle_prov, altura_prov, cod_postal_prov, id_localidad)
        VALUES ('$calle_prov', $altura_prov, $cod_postal_prov, $id_localidad)");
        if ($BD->error) { $BD->rollback(); throw new Exception("Error al insertar dirección proveedor: " . $BD->error); }
        $id_dire_proveedor = $BD->insert_id;

        // Insertar proveedor
        $BD->query("INSERT INTO proveedor (nombre_prov, id_dire_proveedor, id_repuesto)
        VALUES ('$nombre_prov', $id_dire_proveedor, $id_repuesto)");
        if ($BD->error) { $BD->rollback(); throw new Exception("Error al insertar proveedor: " . $BD->error); }
        $id_proveedor = $BD->insert_id;

        $BD->commit();
        echo json_encode([
            'estado'            => 'ok',
            'mensaje'           => 'Proveedor creado correctamente',
            'id_proveedor'      => $id_proveedor,
            'id_dire_proveedor' => $id_dire_proveedor,
            'id_localidad'      => $id_localidad
        ]);



    } elseif ($accion == 'insert_contrato_completo') {

        $fecha_cont      = $BD->real_escape_string($_POST['fecha_cont']      ?? '');
        $turno           = $BD->real_escape_string($_POST['turno']           ?? '');
        $sueldo_hora     = intval($_POST['sueldo_hora']     ?? 0);
        $sueldo_hora_ext = intval($_POST['sueldo_hora_ext'] ?? 0);
        $forma_pago      = $BD->real_escape_string($_POST['forma_pago']      ?? '');

        if (!$fecha_cont || !$turno || !$forma_pago) {
            throw new Exception("Faltan campos requeridos: fecha_cont, turno, forma_pago");
        }

        $BD->begin_transaction();

        // Buscar sueldo existente con los mismos valores; crearlo si no existe
        $res_sueldo = $BD->query("SELECT id_sueldo FROM sueldo
        WHERE sueldo_hora = $sueldo_hora
        AND sueldo_hora_ext = $sueldo_hora_ext
        AND forma_pago = '$forma_pago'
        LIMIT 1");
        if (!$res_sueldo) { $BD->rollback(); throw new Exception("Error al buscar sueldo: " . $BD->error); }

        if ($res_sueldo->num_rows > 0) {
            $id_sueldo = $res_sueldo->fetch_assoc()['id_sueldo'];
        } else {
            $BD->query("INSERT INTO sueldo (sueldo_hora, sueldo_hora_ext, forma_pago)
            VALUES ($sueldo_hora, $sueldo_hora_ext, '$forma_pago')");
            if ($BD->error) { $BD->rollback(); throw new Exception("Error al insertar sueldo: " . $BD->error); }
            $id_sueldo = $BD->insert_id;
        }

        // Insertar contrato vinculado al sueldo
        $BD->query("INSERT INTO contrato_empleado (fecha_cont, turno, id_sueldo)
        VALUES ('$fecha_cont', '$turno', $id_sueldo)");
        if ($BD->error) { $BD->rollback(); throw new Exception("Error al insertar contrato: " . $BD->error); }
        $id_contrato_emple = $BD->insert_id;

        $BD->commit();
        echo json_encode([
            'estado'           => 'ok',
            'mensaje'          => 'Contrato creado correctamente',
            'id_contrato_emple'=> $id_contrato_emple,
            'id_sueldo'        => $id_sueldo
        ]);



    } elseif ($accion == 'insert_pago_y_factura') {

        $id_orden_servicio    = intval($_POST['id_orden_servicio']    ?? 0);
        $id_garantia_servicio = intval($_POST['id_garantia_servicio'] ?? 0);
        $nombre_banco         = $BD->real_escape_string($_POST['nombre_banco']  ?? '');
        $numero_cuenta        = intval($_POST['numero_cuenta'] ?? 0);
        $comprobante          = $BD->real_escape_string($_POST['comprobante']   ?? '');

        if (!$id_orden_servicio || !$id_garantia_servicio || !$nombre_banco || !$comprobante) {
            throw new Exception("Faltan campos requeridos: id_orden_servicio, id_garantia_servicio, nombre_banco, comprobante");
        }

        // Obtener el presupuesto asociado a la orden de servicio
        $res_os = $BD->query("SELECT os.id_presupuesto, p.precio_reparacion_tot
        FROM orden_servicio os
        JOIN presupuestos p ON os.id_presupuesto = p.id_presupuesto
        WHERE os.id_orden_servicio = $id_orden_servicio
        LIMIT 1");
        if (!$res_os || $res_os->num_rows === 0) {
            throw new Exception("No se encontró la orden de servicio con id: $id_orden_servicio");
        }
        $datos_os   = $res_os->fetch_assoc();
        $id_presupuesto = $datos_os['id_presupuesto'];

        // Verificar que no exista ya una factura para este presupuesto
        $res_fac_exist = $BD->query("SELECT id_factura_servicio FROM factura_servicio
        WHERE id_presupuesto = $id_presupuesto LIMIT 1");
        if ($res_fac_exist && $res_fac_exist->num_rows > 0) {
            throw new Exception("Ya existe una factura para esta orden de servicio");
        }

        $BD->begin_transaction();

        // Insertar pago
        $BD->query("INSERT INTO pago (nombre_banco, numero_cuenta, comprobante)
        VALUES ('$nombre_banco', $numero_cuenta, '$comprobante')");
        if ($BD->error) { $BD->rollback(); throw new Exception("Error al insertar pago: " . $BD->error); }
        $id_pago = $BD->insert_id;

        // Insertar factura con fecha actual
        $BD->query("INSERT INTO factura_servicio (fecha_factura, id_pago, id_garantia_servicio, id_presupuesto)
        VALUES (CURDATE(), $id_pago, $id_garantia_servicio, $id_presupuesto)");
        if ($BD->error) { $BD->rollback(); throw new Exception("Error al insertar factura: " . $BD->error); }
        $id_factura_servicio = $BD->insert_id;

        $BD->commit();
        echo json_encode([
            'estado'              => 'ok',
            'mensaje'             => 'Pago y factura de servicio registrados correctamente',
            'id_pago'             => $id_pago,
            'id_factura_servicio' => $id_factura_servicio,
            'id_presupuesto'      => $id_presupuesto
        ]);



    } elseif ($accion == 'insert_orden_entrega') {

        $id_orden_servicio = intval($_POST['id_orden_servicio'] ?? 0);

        if (!$id_orden_servicio) {
            throw new Exception("Falta el campo requerido: id_orden_servicio");
        }

        // Verificar que exista una factura vinculada al presupuesto de esta orden
        $res = $BD->query("SELECT fs.id_factura_servicio
        FROM orden_servicio os
        JOIN factura_servicio fs ON os.id_presupuesto = fs.id_presupuesto
        WHERE os.id_orden_servicio = $id_orden_servicio
        LIMIT 1");
        if (!$res || $res->num_rows === 0) {
            throw new Exception("No existe una factura de servicio asociada a la orden $id_orden_servicio. Registre el pago primero.");
        }
        $id_factura_servicio = $res->fetch_assoc()['id_factura_servicio'];

        // Verificar que no exista ya una orden de entrega para esta orden
        $res_oe = $BD->query("SELECT id_orden_entrega FROM orden_entrega
        WHERE id_orden_servicio = $id_orden_servicio LIMIT 1");
        if ($res_oe && $res_oe->num_rows > 0) {
            throw new Exception("Ya existe una orden de entrega para la orden de servicio $id_orden_servicio");
        }

        // Insertar orden de entrega con fecha actual
        $BD->query("INSERT INTO orden_entrega (fecha_entrega, id_orden_servicio, id_factura_servicio)
        VALUES (CURDATE(), $id_orden_servicio, $id_factura_servicio)");
        if ($BD->error) throw new Exception("Error al insertar orden de entrega: " . $BD->error);
        $id_orden_entrega = $BD->insert_id;

        echo json_encode([
            'estado'              => 'ok',
            'mensaje'             => 'Orden de entrega registrada correctamente',
            'id_orden_entrega'    => $id_orden_entrega,
            'id_factura_servicio' => $id_factura_servicio,
            'fecha_entrega'       => date('Y-m-d')
        ]);

    } else {
        throw new Exception("Acción no reconocida: $accion");
    }

} catch (Exception $e) {
    echo json_encode(['estado' => 'error', 'mensaje' => $e->getMessage()]);
}
?>
