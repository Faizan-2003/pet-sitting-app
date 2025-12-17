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
        try {
            echo json_encode($this->service->getAllPets());
        } catch (\Exception $e) {
            http_response_code(500);
            echo json_encode(['error' => 'Failed to fetch pets']);
        }
    }

    public function show(int $id): void
    {
        try {
            $pet = $this->service->getPet($id);

            if (!$pet) {
                http_response_code(404);
                echo json_encode(['error' => 'Pet not found']);
                return;
            }

            echo json_encode($pet);
        } catch (\Exception $e) {
            http_response_code(500);
            echo json_encode(['error' => 'Failed to fetch pet']);
        }
    }

    public function create(): void
    {
        $data = json_decode(file_get_contents('php://input'), true);

        if (!$data) {
            http_response_code(400);
            echo json_encode(['error' => 'Invalid JSON payload']);
            return;
        }

        try {
            $this->service->createPet($data);

            http_response_code(201);
            echo json_encode(['message' => 'Pet created']);
        } catch (\InvalidArgumentException $e) {
            http_response_code(422);
            echo json_encode(['error' => $e->getMessage()]);
        } catch (\Exception $e) {
            http_response_code(500);
            echo json_encode(['error' => 'Internal server error']);
        }
    }

    public function update(int $id): void
    {
        $data = json_decode(file_get_contents('php://input'), true);

        if (!$data) {
            http_response_code(400);
            echo json_encode(['error' => 'Invalid JSON payload']);
            return;
        }

        try {
            $this->service->updatePet($id, $data);
            echo json_encode(['message' => 'Pet updated']);
        } catch (\InvalidArgumentException $e) {
            http_response_code(422);
            echo json_encode(['error' => $e->getMessage()]);
        } catch (\RuntimeException $e) {
            http_response_code(404);
            echo json_encode(['error' => $e->getMessage()]);
        } catch (\Exception $e) {
            http_response_code(500);
            echo json_encode(['error' => 'Internal server error']);
        }
    }

    public function delete(int $id): void
    {
        try {
            $this->service->deletePet($id);
            echo json_encode(['message' => 'Pet deleted']);
        } catch (\RuntimeException $e) {
            http_response_code(404);
            echo json_encode(['error' => $e->getMessage()]);
        } catch (\Exception $e) {
            http_response_code(500);
            echo json_encode(['error' => 'Internal server error']);
        }
    }
}
