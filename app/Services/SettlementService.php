<?php

namespace App\Services;

use App\DTOs\SettlementDTO;
use App\DTOs\TotalSettlementBettwenTwoUserDTO;
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

    public function getPaysUsers($members) 
    {
        $results = [] ; 

        foreach ($members as $debtor) {
            foreach ($members as $creditor) {
                if ($debtor->userId !== $creditor->userId) {
                    $totalAmount = $this->getNetBalanceBetweenUsers($debtor->userId, $creditor->userId);
                    
                    if ($totalAmount > 0 ) {
                        $results[] = new TotalSettlementBettwenTwoUserDTO(
                            userA_Id: $debtor->userId,
                            userB_Id: $creditor->userId,
                            userA_name: $debtor->name,
                            userB_name: $creditor->name,
                            amount: $totalAmount , 
                        );
                    }
                }
            }
        }

        // dd($results) ; 

        return $results ; 
        
    }


    public function getNetBalanceBetweenUsers($debtorId , $creditorId) 
    {
        $userDeptor = $this -> settlementRepository->getTotalAmountBetweenTwoUsers($debtorId , $creditorId) ;

        $usercrediotr = $this -> settlementRepository-> getTotalAmountBetweenTwoUsers($creditorId , $debtorId) ;

        return $userDeptor - $usercrediotr ; 
    }




}
