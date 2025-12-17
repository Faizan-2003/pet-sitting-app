<?php

return function (PDO $db): void {
    $db->exec("
        CREATE TABLE IF NOT EXISTS pets (
            id INT AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(100) NOT NULL,
            breed VARCHAR(100) NOT NULL,
            size ENUM('small', 'medium', 'large') NOT NULL,
            birthdate DATE NOT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
                ON UPDATE CURRENT_TIMESTAMP
        )
    ");
};
