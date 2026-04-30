<?php
/**
 * conexion.php — Configuración de conexión a la base de datos.
 *
 * Crea la variable $BD (objeto mysqli) con la conexión activa.
 * Todos los archivos PHP que necesiten acceder a la DB incluyen este archivo.
 *
 * Si la conexión falla, $BD queda como null.
 * Los scripts que incluyen este archivo deben verificar si $BD !== null
 * antes de ejecutar queries, y devolver un error en JSON si falló.
 *
 * NOTA: No modificar este archivo para lógica de negocio.
 *       Solo contiene la configuración de la conexión.
 */
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
    // Silenciar el error aquí — cada script verifica si $BD es null
    // y devuelve su propio mensaje de error en JSON
    $BD = null;
}
?>
