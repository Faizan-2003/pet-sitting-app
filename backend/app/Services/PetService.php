<?php

namespace PetSittingApp\Api\Services;

use PetSittingApp\Api\Models\Pet;
use PetSittingApp\Api\Repositories\PetRepository;

class PetService
{
    public function __construct(private PetRepository $repository) {}

    public function getAllPets(): array
    {
        return $this->repository->findAll();
    }

    public function getPet(int $id): ?array
    {
        return $this->repository->findById($id);
    }
    private const ALLOWED_SIZES = ['small', 'medium', 'large'];

    private function validatePet(array $data): void
    {
        if (
            empty($data['name']) ||
            empty($data['breed']) ||
            empty($data['birthdate'])
        ) {
            throw new \InvalidArgumentException("All fields are required.");
        }

        if (!in_array($data['size'], self::ALLOWED_SIZES, true)) {
            throw new \InvalidArgumentException("Invalid size value.");
        }
    }

    public function createPet(array $data): void
    {
        $this->validatePet($data);
        $pet = new Pet(
            null,
            $data['name'],
            $data['breed'],
            $data['size'],
            $data['birthdate']
        );

        $this->repository->create($pet);
    }

    public function updatePet(int $id, array $data): void
    {
        $this->validatePet($data);

        $pet = new Pet(
            $id,
            $data['name'],
            $data['breed'],
            $data['size'],
            $data['birthdate']
        );

        $this->repository->update($id, $pet);
    }

    public function deletePet(int $id): void
    {
        $this->repository->delete($id);
    }
}
