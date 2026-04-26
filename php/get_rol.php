<?php
session_start();
header('Content-Type: application/json');

// Si no hay sesión activa, informar al JS para que redirija al login
if (!isset($_SESSION['rol'])) {
    echo json_encode(['estado' => 'sin_sesion']);
    exit();
}

echo json_encode([
    'estado' => 'ok',
    'rol'    => $_SESSION['rol'],
    'nombre' => $_SESSION['nombre']
]);
