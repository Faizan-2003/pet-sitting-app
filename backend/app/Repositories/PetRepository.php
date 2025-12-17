<?php

namespace PetSittingApp\Api\Repositories;

use PDO;
use PetSittingApp\Api\Models\Pet;

class PetRepository
{
    public function __construct(private PDO $db) {}

    public function findAll(): array
    {
        $stmt = $this->db->query("SELECT * FROM pets ORDER BY created_at DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function findById(int $id): ?array
    {
        $stmt = $this->db->prepare("SELECT * FROM pets WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
    }

    public function create(Pet $pet): void
    {
        $stmt = $this->db->prepare("
        INSERT INTO pets (name, breed, size, birthdate)
        VALUES (:name, :breed, :size, :birthdate)
    ");

        $stmt->execute([
            'name' => $pet->getName(),
            'breed' => $pet->getBreed(),
            'size' => $pet->getSize(),
            'birthdate' => $pet->getBirthdate()
        ]);
    }

    public function update(int $id, Pet $pet): void
    {
        $stmt = $this->db->prepare("
        UPDATE pets
        SET name = :name,
            breed = :breed,
            size = :size,
            birthdate = :birthdate
        WHERE id = :id
    ");

        $stmt->execute([
            'name' => $pet->getName(),
            'breed' => $pet->getBreed(),
            'size' => $pet->getSize(),
            'birthdate' => $pet->getBirthdate(),
            'id' => $id
        ]);
    }


    public function delete(int $id): void
    {
        $stmt = $this->db->prepare("DELETE FROM pets WHERE id = :id");
        $stmt->execute(['id' => $id]);
    }
}
