<?php

namespace App\DTOs;

class MessageDTO
{
    
    public function __construct(
        public int $id,
        public int $colocationId,
        public int $userId,
        public string $content,
        public ?string $filePath = null,
        public string $type,
        public string $createdAt,
        public string $updatedAt,
    ) {}

}
