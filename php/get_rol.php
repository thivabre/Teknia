<?php

session_start();
header('Content-Type: application/json');

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
