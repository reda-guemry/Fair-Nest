<?php

namespace App\Services;

use App\DTOs\SettlementDTO;
use App\Mappers\SettlementMapper;
use App\Repositorys\SettlementRepository;

class SettlementService
{
    /**
     * Create a new class instance.
     */
    public function __construct(
        private SettlementRepository $settlementRepository
    ) {
    }

    public function createSettlement(SettlementDTO $dto )
    {
        $this->settlementRepository->createSettlement(SettlementMapper::toModel($dto)) ;
        
    }

}
