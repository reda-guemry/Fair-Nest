<?php

namespace App\DTOs;

class UserDTO
{
    /**
     * Create a new class instance.
     */
    public function __construct(
        public int $id,
        public string $name,
        public string $email,
        public int $reputation,
        public bool $isBanned,
        public ?array $colocations = null , 
        public ?array $debts = null , 
        public ?array $credits = null ,
    ) {}
}
