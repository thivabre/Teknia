<?php
ini_set('display_errors', 0);
error_reporting(0);

header('Content-Type: application/json');

include("conexion.php");

if (!isset($BD) || $BD->connect_error) {
    echo json_encode(['estado' => 'error', 'mensaje' => 'Error de conexión']);
    exit();
}

if (!isset($_POST['accion'])) {
    echo json_encode(['estado' => 'error', 'mensaje' => 'Parámetro accion no recibido']);
    exit();
}

$accion = $_POST['accion'];

if ($accion == 'insert_cliente') {

    $requeridos = ['nombre_cli', 'apellido_cli', 'dni_cli', 'telefono_cli',
                   'pais', 'provincia', 'ciudad', 'barrio',
                   'calle_cli', 'altura_cli', 'cod_postal_cli'];

    foreach ($requeridos as $campo) {
        if (!isset($_POST[$campo]) || trim($_POST[$campo]) === '') {
            echo json_encode(['estado' => 'error', 'mensaje' => "Campo requerido faltante: $campo"]);
            exit();
        }
    }

    $nombre_cli = $BD->real_escape_string(trim($_POST['nombre_cli']));
    $apellido_cli = $BD->real_escape_string(trim($_POST['apellido_cli']));
    $dni_cli = intval($_POST['dni_cli']);
    $telefono_cli = $BD->real_escape_string(trim($_POST['telefono_cli']));
    $pais = $BD->real_escape_string(trim($_POST['pais']));
    $provincia = $BD->real_escape_string(trim($_POST['provincia']));
    $ciudad = $BD->real_escape_string(trim($_POST['ciudad']));
    $barrio = $BD->real_escape_string(trim($_POST['barrio']));
    $calle_cli = $BD->real_escape_string(trim($_POST['calle_cli']));
    $altura_cli = intval($_POST['altura_cli']);
    $cod_postal = intval($_POST['cod_postal_cli']);

    $BD->begin_transaction();

    $BD->query("INSERT INTO localidad (pais, provincia, ciudad, barrio)
                VALUES ('$pais', '$provincia', '$ciudad', '$barrio')");
    if ($BD->error) {
        $BD->rollback();
        echo json_encode(['estado' => 'error', 'mensaje' => 'Error al guardar localidad: ' . $BD->error]);
        exit();
    }
    $id_localidad = $BD->insert_id;

    $BD->query("INSERT INTO direccion_cliente (calle_cli, altura_cli, cod_postal_cli, id_localidad)
                VALUES ('$calle_cli', $altura_cli, $cod_postal, $id_localidad)");
    if ($BD->error) {
        $BD->rollback();
        echo json_encode(['estado' => 'error', 'mensaje' => 'Error al guardar dirección: ' . $BD->error]);
        exit();
    }
    $id_dire_cliente = $BD->insert_id;

    $BD->query("INSERT INTO cliente (nombre_cli, apellido_cli, dni_cli, telefono_cli, id_dire_cliente)
                VALUES ('$nombre_cli', '$apellido_cli', $dni_cli, '$telefono_cli', $id_dire_cliente)");
    if ($BD->error) {
        $BD->rollback();
        echo json_encode(['estado' => 'error', 'mensaje' => 'Error al guardar cliente: ' . $BD->error]);
        exit();
    }
    $id_cliente = $BD->insert_id;

    $BD->commit();

    echo json_encode([
        'estado'     => 'ok',
        'mensaje'    => 'Cliente registrado correctamente',
        'id_cliente' => $id_cliente
    ]);
    exit();
}

echo json_encode(['estado' => 'error', 'mensaje' => "Acción desconocida: $accion"]);
