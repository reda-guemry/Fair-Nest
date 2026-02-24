<?php

namespace App\DTOs;

class InvitationDTO
{
    
    public function __construct(
        public ?int $id, 
        public int $colocationId,
        public string $email,
        public string $token,
        public string $status, 
        public ?string $expiresAt = null,
    ) {}

}
