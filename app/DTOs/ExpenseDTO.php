<?php

namespace App\DTOs;

class ExpenseDTO
{
    public function __construct(
        public int $colocationId,
        public int $payerId,
        public int $categoryId,
        public string $title, 
        public int $amount,
        public ?int $id,
        public ?array $settlements = null,
        public ?array $participants = null,
        public ?string $payername = null,
        public ?string $categoryName = null,
        public ?string $createdAt = null,
        
    ) {}
}
