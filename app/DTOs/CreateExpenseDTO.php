<?php 


namespace App\DTOs;

class CreateExpenseDTO
{
    public function __construct(
        public int $colocationId,
        public int $payerId,
        public int $categoryId,
        public string $title, 
        public int $amount,
        public array $participants, 
        public ?array $settlements = null,
        public ?int $id = null,
    ) {}
}