<?php

namespace App\DTOs;

class InvitationDTO
{
    
    public function __construct(
        public int $colocationId,
        public string $email,
        public string $token,
        public string $status, 
        public ?int $id, 
        public ?string $expiresAt = null,
    ) {}

}
