<?php

namespace PetSittingApp\Api\Controllers;

use PetSittingApp\Api\Core\Database;
use PetSittingApp\Api\Repositories\PetRepository;
use PetSittingApp\Api\Services\PetService;

class PetController
{
    private PetService $service;

    public function __construct()
    {
        $db = Database::connect();
        $repository = new PetRepository($db);
        $this->service = new PetService($repository);
    }

    public function index(): void
    {
        echo json_encode($this->service->getAllPets());
    }

    public function show(int $id): void
    {
        $pet = $this->service->getPet($id);

        if (!$pet) {
            http_response_code(404);
            echo json_encode(['error' => 'Pet not found']);
            return;
        }

        echo json_encode($pet);
    }

    public function store(): void
    {
        $data = json_decode(file_get_contents('php://input'), true);
        $this->service->createPet($data);

        http_response_code(201);
        echo json_encode(['message' => 'Pet created']);
    }

    public function update(int $id): void
    {
        $data = json_decode(file_get_contents('php://input'), true);
        $this->service->updatePet($id, $data);

        echo json_encode(['message' => 'Pet updated']);
    }

    public function destroy(int $id): void
    {
        $this->service->deletePet($id);
        echo json_encode(['message' => 'Pet deleted']);
    }
}
