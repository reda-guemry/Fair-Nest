<?php

namespace App\DTOs;

class ExpenseDTO
{
    public function __construct(
        public ?int $id,
        public int $colocationId,
        public int $payerId,
        public int $categoryId,
        public string $title, 
        public float $amount,
    ) {}
}
