<?php
/**
 * get_rol.php — Endpoint de verificación de sesión.
 *
 * Devuelve un JSON con el rol y datos del usuario logueado.
 * Consultado por tablas.js en la función verificarSesion() desde cada página.
 *
 * Respuestas posibles:
 *   { "estado": "ok", "rol": "...", "nombre": "...", "id_referencia": ... }
 *   { "estado": "sin_sesion" }
 */
session_start();
header('Content-Type: application/json');

// Si no hay sesión activa, indicarle al JS que redirija al login
if (!isset($_SESSION['rol'])) {
    echo json_encode(['estado' => 'sin_sesion']);
    exit();
}

echo json_encode([
    'estado'        => 'ok',
    'rol'           => $_SESSION['rol'],
    'nombre'        => $_SESSION['nombre'],
    'id_referencia' => $_SESSION['id_referencia'] ?? null
]);
