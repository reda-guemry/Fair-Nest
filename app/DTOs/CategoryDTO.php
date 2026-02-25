<?php

namespace App\DTOs;

class CategoryDTO
{
    public function __construct(
        public int $colocationId,
        public string $name,
        public ?int $id, 
    ) {}


}
