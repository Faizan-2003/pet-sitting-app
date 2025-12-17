<?php

namespace PetSittingApp\Api\Models;

class Appointment
{
    public function __construct(
        public int $pet_id,
        public string $pet_sitter_name,
        public string $date,
        public string $time,
        public int $duration
    ) {}
}
