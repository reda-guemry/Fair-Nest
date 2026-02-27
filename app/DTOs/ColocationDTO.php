<?php

namespace App\DTOs;

class ColocationDTO
{
    
    public function __construct(
        public string $name,
        public ?int $id,
        public ?string $description , 
        public ?string $status = null ,
        public ?array $membership = [] , 
        public ?array $expenses = [] , 
        public ?array $settlements = [] ,
        public ?array $categories = [] , 
    ) {}



}
