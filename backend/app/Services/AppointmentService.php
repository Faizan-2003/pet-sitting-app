<?php

namespace PetSittingApp\Api\Services;

use PetSittingApp\Api\Models\Appointment;
use PetSittingApp\Api\Repositories\AppointmentRepository;

class AppointmentService
{
    public function __construct(
        private AppointmentRepository $repository
    ) {}

    public function create(array $data): void
    {
        foreach (["pet_id", "pet_sitter_name", "date", "time", "duration"] as $field) {
            if (empty($data[$field])) {
                throw new \Exception("Missing field: $field");
            }
        }

        $appointment = new Appointment(
            $data["pet_id"],
            $data["pet_sitter_name"],
            $data["date"],
            $data["time"],
            (int) $data["duration"]
        );

        $this->repository->create($appointment);
    }
    public function getAll(): array
    {
        return $this->repository->getAll();
    }

    public function delete(int $id): void
    {
        $this->repository->delete($id);
    }
}
