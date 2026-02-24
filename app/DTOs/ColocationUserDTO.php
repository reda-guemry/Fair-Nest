<?php

namespace App\DTOs;

class ColocationUserDTO
{
    public function __construct(
        public int $userId,
        public int $colocationId,
        public string $role,
        public string $status,
        public ?string $joinedAt = null, 
        public ?string $leftAt = null,   
    ) {}

    
}
