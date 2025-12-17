<?php

namespace PetSittingApp\Api\Controllers;

use PetSittingApp\Api\Repositories\AppointmentRepository;
use PetSittingApp\Api\Services\AppointmentService;

class AppointmentController
{
    private AppointmentService $service;

    public function __construct($pdo)
    {
        $repository = new AppointmentRepository($pdo);
        $this->service = new AppointmentService($repository);
    }

    public function store(): void
    {
        $data = json_decode(file_get_contents("php://input"), true);

        try {
            $this->service->create($data);
            echo json_encode(["message" => "Appointment created"]);
        } catch (\Exception $e) {
            http_response_code(400);
            echo json_encode(["error" => $e->getMessage()]);
        }
    }
    
public function index(): void
{
    echo json_encode(
        $this->service->getAll()
    );
}

    public function destroy(int $id): void
    {
        $this->service->delete($id);
        echo json_encode(["message" => "Appointment deleted"]);
    }
}
