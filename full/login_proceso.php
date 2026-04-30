<?php
session_start();
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

if ($accion == 'login_empleado') {
    $id_empleado  = intval($_POST['id_empleado'] ?? 0);
    $nombre_emple = $BD->real_escape_string($_POST['nombre_emple'] ?? '');

    if (!$id_empleado || !$nombre_emple) {
        echo json_encode(['estado' => 'error', 'mensaje' => 'Datos incompletos']);
        exit();
    }

    $sql = "SELECT id_empleado, nombre_emple, apellido_emple,
                   jefe_sucursal, jefe_general
            FROM empleado
            WHERE id_empleado = $id_empleado
              AND nombre_emple = '$nombre_emple'
            LIMIT 1";

    $resultado = $BD->query($sql);

    if (!$resultado || $resultado->num_rows === 0) {
        echo json_encode(['estado' => 'error', 'mensaje' => 'Nombre o ID incorrecto']);
        exit();
    }

    $fila = $resultado->fetch_assoc();

    if ($fila['jefe_general'])        $rol = 'jefe_general';
    elseif ($fila['jefe_sucursal'])   $rol = 'jefe_sucursal';
    else                               $rol = 'empleado';

    $_SESSION['id_referencia'] = $fila['id_empleado'];
    $_SESSION['rol']           = $rol;
    $_SESSION['nombre']        = $fila['nombre_emple'] . ' ' . $fila['apellido_emple'];

    echo json_encode([
        'estado' => 'ok',
        'rol'    => $rol,
        'nombre' => $_SESSION['nombre']
    ]);
    exit();
}

if ($accion == 'login_cliente') {
    $id_cliente = intval($_POST['id_cliente'] ?? 0);
    $nombre_cli = $BD->real_escape_string($_POST['nombre_cli'] ?? '');

    if (!$id_cliente || !$nombre_cli) {
        echo json_encode(['estado' => 'error', 'mensaje' => 'Datos incompletos']);
        exit();
    }

    $sql = "SELECT id_cliente, nombre_cli, apellido_cli
            FROM cliente
            WHERE id_cliente = $id_cliente
              AND nombre_cli = '$nombre_cli'
              AND (migrado_a_empleado IS NULL OR migrado_a_empleado = 0)
            LIMIT 1";

    $resultado = $BD->query($sql);

    if (!$resultado || $resultado->num_rows === 0) {
        echo json_encode(['estado' => 'error', 'mensaje' => 'Nombre o ID incorrecto']);
        exit();
    }

    $fila = $resultado->fetch_assoc();

    $_SESSION['id_referencia'] = $fila['id_cliente'];
    $_SESSION['rol']           = 'cliente';
    $_SESSION['nombre']        = $fila['nombre_cli'] . ' ' . $fila['apellido_cli'];

    echo json_encode([
        'estado' => 'ok',
        'rol'    => 'cliente',
        'nombre' => $_SESSION['nombre']
    ]);
    exit();
}

if ($accion == 'logout') {
    session_destroy();
    echo json_encode(['estado' => 'ok']);
    exit();
}

echo json_encode(['estado' => 'error', 'mensaje' => 'Acción desconocida']);
