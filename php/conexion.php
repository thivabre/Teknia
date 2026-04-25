<?php
$ubicacion = "172.16.15.203";
$usuario = "root";
$clave = "";
$base = "servicio_tecnico_db";

try {
    $BD = new mysqli($ubicacion, $usuario, $clave, $base);

    if ($BD->connect_error) {
        throw new Exception("Error de conexión: " . $BD->connect_error);
    }

} catch (Exception $e) {
    echo "Excepción capturada: " . $e->getMessage();
}
?>