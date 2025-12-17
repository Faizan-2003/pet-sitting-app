<?php

require_once __DIR__ . '/../vendor/autoload.php';

use PetSittingApp\Api\Core\Database;

header("Content-Type: application/json");
header("Access-Control-Allow-Origin: http://localhost:5173");
header("Access-Control-Allow-Headers: Content-Type, Authorization");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

$pdo = Database::connect();

require_once __DIR__ . '/../app/routes/api.php';
