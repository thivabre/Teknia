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

if ($accion == 'registrar_cliente') {

    $campos = ['nombre_cli', 'apellido_cli', 'dni_cli', 'telefono_cli', 'calle_cli', 'altura_cli', 'cod_postal_cli', 'pais', 'provincia', 'ciudad', 'barrio'];
    foreach ($campos as $campo) {
        if (!isset($_POST[$campo]) || $_POST[$campo] === '') {
            echo json_encode(['estado' => 'error', 'mensaje' => "Campo requerido faltante: $campo"]);
            exit();
        }
    }

    $nombre_cli     = $BD->real_escape_string($_POST['nombre_cli']);
    $apellido_cli   = $BD->real_escape_string($_POST['apellido_cli']);
    $dni_cli        = intval($_POST['dni_cli']);
    $telefono_cli   = $BD->real_escape_string($_POST['telefono_cli']);
    $calle_cli      = $BD->real_escape_string($_POST['calle_cli']);
    $altura_cli     = intval($_POST['altura_cli']);
    $cod_postal_cli = intval($_POST['cod_postal_cli']);
    $pais           = $BD->real_escape_string($_POST['pais']);
    $provincia      = $BD->real_escape_string($_POST['provincia']);
    $ciudad         = $BD->real_escape_string($_POST['ciudad']);
    $barrio         = $BD->real_escape_string($_POST['barrio']);

    $BD->begin_transaction();

    $BD->query("INSERT INTO localidad (pais, provincia, ciudad, barrio) VALUES ('$pais', '$provincia', '$ciudad', '$barrio')");
    if ($BD->error) { $BD->rollback(); echo json_encode(['estado' => 'error', 'mensaje' => 'Error al insertar localidad: ' . $BD->error]); exit(); }
    $id_localidad = $BD->insert_id;

    $BD->query("INSERT INTO direccion_cliente (calle_cli, altura_cli, cod_postal_cli, id_localidad) VALUES ('$calle_cli', $altura_cli, $cod_postal_cli, $id_localidad)");
    if ($BD->error) { $BD->rollback(); echo json_encode(['estado' => 'error', 'mensaje' => 'Error al insertar dirección: ' . $BD->error]); exit(); }
    $id_dire_cliente = $BD->insert_id;

    $BD->query("INSERT INTO cliente (nombre_cli, apellido_cli, dni_cli, telefono_cli, id_dire_cliente, id_orden_servicio) VALUES ('$nombre_cli', '$apellido_cli', $dni_cli, '$telefono_cli', $id_dire_cliente, 0)");
    if ($BD->error) { $BD->rollback(); echo json_encode(['estado' => 'error', 'mensaje' => 'Error al insertar cliente: ' . $BD->error]); exit(); }
    $id_cliente = $BD->insert_id;

    $BD->commit();

    echo json_encode([
        'estado'          => 'ok',
        'mensaje'         => 'Cliente registrado correctamente',
        'id_cliente'      => $id_cliente,
        'id_dire_cliente' => $id_dire_cliente,
        'id_localidad'    => $id_localidad
    ]);
    exit();
}

echo json_encode(['estado' => 'error', 'mensaje' => "Acción desconocida: $accion"]);
?>
