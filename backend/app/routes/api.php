<?php

use PetSittingApp\Api\Controllers\PetController;
use PetSittingApp\Api\Controllers\AppointmentController;

if (!isset($pdo)) {
    throw new Exception("PDO connection not available in routes.");
}

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$method = $_SERVER['REQUEST_METHOD'];

$petController = new PetController();
$appointmentController = new AppointmentController($pdo);

if ($uri === '/api/pets' && $method === 'GET') {
    $petController->index();
}

if ($uri === '/api/pets' && $method === 'POST') {
    $petController->create();
}

if (preg_match('#^/api/pets/(\d+)$#', $uri, $matches)) {
    $id = (int) $matches[1];

    if ($method === 'GET') {
        $petController->show($id);
    }

    if ($method === 'DELETE') {
        $petController->delete($id);
    }
    if ($method === 'PUT') {
        $petController->update($id);
    }
}
if ($uri === "/api/appointments" && $method === "POST") {
    $appointmentController->create();
    return;
}
if ($uri === "/api/appointments" && $method === "GET") {
    (new AppointmentController($pdo))->index();
    return;
}
if (
    preg_match("#^/api/appointments/(\d+)$#", $uri, $matches)
    && $method === "DELETE"
) {
    $appointmentController->delete((int) $matches[1]);
    return;
}
