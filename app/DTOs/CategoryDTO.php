<?php

namespace App\DTOs;

class CategoryDTO
{
    public function __construct(
        public ?int $id, 
        public int $colocationId,
        public string $name,
    ) {}


}
