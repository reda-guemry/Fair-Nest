<?php

namespace App\DTOs;

class InvitationDTO
{
    
    public function __construct(
        public int $colocationId,
        public string $email,
        public string $token,
        public ?int $id = null , 
        public ?string $status = null, 
        public ?string $expiresAt = null,
    ) {}

}
