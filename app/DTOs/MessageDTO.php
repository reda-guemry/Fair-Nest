<?php

namespace App\DTOs;

class MessageDTO
{
    
    public function __construct(
        public int $colocationId,
        public int $userId,
        public string $content,
        public ?int $id = null,
        public ?string $filePath = null,
        public ?string $type = null,
        public ?string $createdAt = null ,
        public ?string $updatedAt = null,
        public ?UserDTO $userDTO = null , 
    ) {}

}
