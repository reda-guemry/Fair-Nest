<?php

namespace App\DTOs;

class ColocationDTO
{
    
    public function __construct(
        public ?int $id,
        public string $name,
        public ?string $description , 
        public ?string $status = null ,
        public ?array $membership = null
    ) {}



}
