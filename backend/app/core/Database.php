<?php

namespace PetSittingApp\Api\Core;

use PDO;
use PDOException;
class Database
{
    public static function connect(): PDO
    {
        try {
            return new PDO(
                "mysql:host=localhost;dbname=pet_sitting_app",
                "root",
                "",
                [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
                ]
            );
        } catch (PDOException $e) {
            http_response_code(500);
            echo json_encode([
                "error" => "Database connection failed"
            ]);
            exit;
        }
    }
}
