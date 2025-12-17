<?php

namespace PetSittingApp\Api\Repositories;

use PDO;
use PetSittingApp\Api\Models\Appointment;

class AppointmentRepository
{
    public function __construct(private PDO $pdo) {}

    public function create(Appointment $appointment): void
    {
        $stmt = $this->pdo->prepare("
            INSERT INTO appointments (pet_id, pet_sitter_name, date, time, duration)
            VALUES (:pet_id, :name, :date, :time, :duration)
        ");

        $stmt->execute([
            "pet_id" => $appointment->pet_id,
            "name" => $appointment->pet_sitter_name,
            "date" => $appointment->date,
            "time" => $appointment->time,
            "duration" => $appointment->duration,
        ]);
    }
public function getAll(): array
{
    $stmt = $this->pdo->query("
        SELECT 
            id,
            pet_id,
            pet_sitter_name,
            date,
            time,
            duration,
            created_at
        FROM appointments
        ORDER BY date, time
    ");

    return $stmt->fetchAll();
}

    public function delete(int $id): void
    {
        $stmt = $this->pdo->prepare("DELETE FROM appointments WHERE id = :id");
        $stmt->execute(["id" => $id]);
    }
}
