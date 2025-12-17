<?php

require_once __DIR__ . '/../vendor/autoload.php';

use PetSittingApp\Api\Core\Database;

$db = Database::connect();

$migrationFiles = glob(__DIR__ . '/migrations/*.php');
sort($migrationFiles);

foreach ($migrationFiles as $file) {
    $migration = require $file;

    if (!is_callable($migration)) {
        throw new RuntimeException(
            basename($file) . ' did not return a callable migration.'
        );
    }

    $migration($db);
    echo "Ran migration: " . basename($file) . PHP_EOL;
}
