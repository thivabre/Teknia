<?php
ini_set('display_errors', 0);
error_reporting(0);

header('Content-Type: application/json');

include("conexion.php");

if (!isset($BD) || $BD->connect_error) {
    echo json_encode(['error' => 'Error de conexión: ' . ($BD->connect_error ?? 'variable $BD no definida')]);
    exit();
}

if (!isset($_POST['accion'])) {
    echo json_encode(['error' => 'Parámetro accion no recibido']);
    exit();
}

$accion = $_POST['accion'];

if ($accion == 'login_empleado'){
    $nombre_emple = $_POST['nombre_emple'];
    $id_empleado = $_POST['id_empleado'];
    $sql = "SELECT id_empleado, nombre_emple FROM empleado";
    $resultado = $BD->query($sql);
    if ($resultado){
        echo json_encode(["estado"=> "ok", "nombre" => "$nombre_emple"]);
        exit();
    }
    else{
        echo json_encode(['estado' => 'Error en query: ' . $BD->error]);
        exit();
    }

}

if ($accion == 'login_cliente'){
    $nombre_cli = $_POST['nombre_cli'];
    $id_cliente = $_POST['id_cliente'];
    $sql = "SELECT id_cliente, nombre_cli FROM cliente";
    $resultado = $BD->query($sql);
    if ($resultado){
        echo json_encode(["estado"=> "ok", "nombre" => "$nombre_cli"]);
        exit();
    }
    else{
        echo json_encode(['estado' => 'Error en query: ' . $BD->error]);
        exit();
    }

}