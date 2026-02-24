<?php

namespace App\DTOs;

class SettlementDTO
{
    public function __construct(
        public ?int $id, 
        public int $colocationId,
        public int $debtorId,  
        public int $creditorId, 
        public float $amount,   
        public string $status,  
    ) {}
    
}
