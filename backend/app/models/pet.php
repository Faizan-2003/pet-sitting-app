<?php

namespace PetSittingApp\Api\Models;

class Pet
{
    private ?int $id;
    private string $name;
    private string $breed;
    private string $size;
    private string $birthdate;

    public function __construct(
        ?int $id,
        string $name,
        string $breed,
        string $size,
        string $birthdate
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->breed = $breed;
        $this->size = $size;
        $this->birthdate = $birthdate;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getBreed(): string
    {
        return $this->breed;
    }

    public function getSize(): string
    {
        return $this->size;
    }

    public function getBirthdate(): string
    {
        return $this->birthdate;
    }
}
