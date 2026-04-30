<?php

$ubicacion = "127.0.0.1:3307";
$usuario   = "root";
$clave     = "";
$base      = "servicio_tecnico_db";

try {
    $BD = new mysqli($ubicacion, $usuario, $clave, $base);

    if ($BD->connect_error) {
        throw new Exception("Error de conexión: " . $BD->connect_error);
    }

} catch (Exception $e) {
    $BD = null;
}
?>
