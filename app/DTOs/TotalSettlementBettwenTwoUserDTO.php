<?php

namespace App\DTOs;

class TotalSettlementBettwenTwoUserDTO
{
    public function __construct(
        public int $userA_Id,
        public int $userB_Id,
        public string $userA_name,        
        public string $userB_name,        
        public int $amount , 
    ) {}

    
}
