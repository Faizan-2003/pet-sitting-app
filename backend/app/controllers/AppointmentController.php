<?php

namespace PetSittingApp\Api\Controllers;

use PetSittingApp\Api\Core\Database;
use PetSittingApp\Api\Repositories\AppointmentRepository;
use PetSittingApp\Api\Services\AppointmentService;

class AppointmentController
{
    private AppointmentService $service;

    public function __construct()
    {
        $db = Database::connect();
        $repository = new AppointmentRepository($db);
        $this->service = new AppointmentService($repository);
    }

    public function index(): void
    {
        try {
            echo json_encode($this->service->getAll());
        } catch (\Exception $e) {
            http_response_code(500);
            echo json_encode(['error' => 'Failed to fetch appointments']);
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
            $this->service->create($data);

            http_response_code(201);
            echo json_encode(['message' => 'Appointment created']);
        } catch (\InvalidArgumentException $e) {
            http_response_code(422);
            echo json_encode(['error' => $e->getMessage()]);
        } catch (\Exception $e) {
            http_response_code(500);
            echo json_encode(['error' => 'Internal server error']);
        }
    }

    public function delete(int $id): void
    {
        try {
            $this->service->delete($id);
            echo json_encode(['message' => 'Appointment deleted']);
        } catch (\RuntimeException $e) {
            http_response_code(404);
            echo json_encode(['error' => $e->getMessage()]);
        } catch (\Exception $e) {
            http_response_code(500);
            echo json_encode(['error' => 'Internal server error']);
        }
    }
}
