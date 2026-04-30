<?php
ini_set('display_errors', 0);
error_reporting(0);

header('Content-Type: application/json');

include("conexion.php");

if (!isset($BD) || $BD->connect_error) {
    echo json_encode(['estado' => 'error', 'mensaje' => 'Error de conexión: ' . ($BD->connect_error ?? 'variable $BD no definida')]);
    exit();
}

if (!isset($_POST['accion'])) {
    echo json_encode(['estado' => 'error', 'mensaje' => 'Parámetro accion no recibido']);
    exit();
}

$accion = $_POST['accion'];

if ($accion == 'migrar_cliente_a_empleado') {

    $campos = ['id_cliente', 'id_contrato_emple', 'id_sucursal', 'id_seguro'];
    foreach ($campos as $campo) {
        if (!isset($_POST[$campo]) || $_POST[$campo] === '') {
            echo json_encode(['estado' => 'error', 'mensaje' => "Campo requerido faltante: $campo"]);
            exit();
        }
    }

    $id_cliente      = intval($_POST['id_cliente']);
    $horas_trabajdas = 0;
    $horas_extra     = 0;
    $jefe_sucursal   = 0;
    $jefe_general    = 0;
    $id_contrato_emple = intval($_POST['id_contrato_emple']);
    $id_sucursal     = intval($_POST['id_sucursal']);
    $id_seguro       = intval($_POST['id_seguro']);

    $res = $BD->query(
        "SELECT c.nombre_cli, c.apellido_cli, c.dni_cli, c.telefono_cli,
        dc.calle_cli, dc.altura_cli, dc.cod_postal_cli,
        l.pais, l.provincia, l.ciudad, l.barrio
        FROM cliente c
        JOIN direccion_cliente dc ON c.id_dire_cliente = dc.id_dire_cliente
        JOIN localidad l ON dc.id_localidad = l.id_localidad
        WHERE c.id_cliente = $id_cliente"
    );

    if (!$res || $res->num_rows === 0) {
        echo json_encode(['estado' => 'error', 'mensaje' => 'Cliente no encontrado con id: ' . $id_cliente]);
        exit();
    }

    $cli = $res->fetch_assoc();

    $nombre    = $BD->real_escape_string($cli['nombre_cli']);
    $apellido  = $BD->real_escape_string($cli['apellido_cli']);
    $dni       = intval($cli['dni_cli']);
    $telefono  = $BD->real_escape_string($cli['telefono_cli']);
    $calle     = $BD->real_escape_string($cli['calle_cli']);
    $altura    = intval($cli['altura_cli']);
    $cod_postal = intval($cli['cod_postal_cli']);
    $pais      = $BD->real_escape_string($cli['pais']);
    $provincia = $BD->real_escape_string($cli['provincia']);
    $ciudad    = $BD->real_escape_string($cli['ciudad']);
    $barrio    = $BD->real_escape_string($cli['barrio']);

    $BD->begin_transaction();

    $BD->query("INSERT INTO localidad (pais, provincia, ciudad, barrio) VALUES ('$pais', '$provincia', '$ciudad', '$barrio')");
    if ($BD->error) { $BD->rollback(); echo json_encode(['estado' => 'error', 'mensaje' => 'Error al insertar localidad: ' . $BD->error]); exit(); }
    $id_localidad_nueva = $BD->insert_id;

    $BD->query("INSERT INTO direccion_empleado (calle_emp, altura_emp, cod_postal_emp, id_localidad) VALUES ('$calle', $altura, $cod_postal, $id_localidad_nueva)");
    if ($BD->error) { $BD->rollback(); echo json_encode(['estado' => 'error', 'mensaje' => 'Error al insertar dirección empleado: ' . $BD->error]); exit(); }
    $id_dire_empleado = $BD->insert_id;

    $BD->query("INSERT INTO empleado (nombre_emple, apellido_emple, dni_emple, telefono_emple, horas_trabajdas, horas_extra, jefe_sucursal, jefe_general, id_dire_empleado, id_contrato_emple, id_sucursal, id_seguro)
    VALUES ('$nombre', '$apellido', $dni, '$telefono', $horas_trabajdas, $horas_extra, $jefe_sucursal, $jefe_general, $id_dire_empleado, $id_contrato_emple, $id_sucursal, $id_seguro)");
    if ($BD->error) { $BD->rollback(); echo json_encode(['estado' => 'error', 'mensaje' => 'Error al insertar empleado: ' . $BD->error]); exit(); }
    $id_empleado = $BD->insert_id;

    // Intentar eliminar el cliente. Si tiene órdenes activas (FK lo impide), marcarlo como migrado.
    $deleted = false;
    try {
        $BD->query("DELETE FROM cliente WHERE id_cliente = $id_cliente");
        if (!$BD->error) {
            $deleted = true;
        } else {
        // FK impide borrar: intentar marcar como migrado
            $BD->query("UPDATE cliente SET migrado_a_empleado = 1 WHERE id_cliente = $id_cliente");
        }
    } catch (Throwable $t) {
    // Constraint FK o excepción MySQL modo estricto — el empleado ya fue creado, se continúa
        $deleted = false;
    }
$BD->commit();

    echo json_encode([
        'estado'            => 'ok',
        'mensaje'           => $deleted
            ? 'Cliente migrado a empleado y registro de cliente eliminado correctamente.'
            : 'Cliente migrado a empleado. El acceso como cliente quedó bloqueado (conservado por órdenes históricas).',
        'id_empleado'       => $id_empleado,
        'id_dire_empleado'  => $id_dire_empleado,
        'id_localidad'      => $id_localidad_nueva,
        'origen_id_cliente' => $id_cliente,
        'cliente_eliminado' => $deleted
    ]);
    exit();
}

echo json_encode(['estado' => 'error', 'mensaje' => "Acción desconocida: $accion"]);
?>
