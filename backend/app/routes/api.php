<?php

use PetSittingApp\Api\Controllers\PetController;

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$method = $_SERVER['REQUEST_METHOD'];

$controller = new PetController();

if ($uri === '/api/pets' && $method === 'GET') {
    $controller->index();
}

if ($uri === '/api/pets' && $method === 'POST') {
    $controller->store();
}

if (preg_match('#^/api/pets/(\d+)$#', $uri, $matches)) {
    $id = (int) $matches[1];

    if ($method === 'GET') {
        $controller->show($id);
    }

    if ($method === 'DELETE') {
        $controller->destroy($id);
    }
    if ($method === 'PUT') {
        $controller->update($id);
    }
}
