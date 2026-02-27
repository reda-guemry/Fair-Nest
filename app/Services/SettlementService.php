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
        private SettlementRepository $settlementRepository ,
        private UserService $userService
    ) {
    }

    public function createSettlement(SettlementDTO $dto )
    {
        $this->settlementRepository->createSettlement(SettlementMapper::toModel($dto)) ;
        
    }

    public function PayBettwenUserAndMemnbers($debtor , $members) 
    {
        $results = [] ; 

        foreach ($members as $creditor) {
            if ($debtor->userId !== $creditor->userId) {
                $totalAmount = $this->NetBalanceBetweenUsers($debtor->userId, $creditor->userId);
                if ($totalAmount > 0 ) {
                    $results[] = new TotalSettlementBettwenTwoUserDTO(
                        userA_Id: $debtor->userId,
                        userB_Id: $creditor->userId ,
                        userA_name: $debtor->name ,
                        userB_name: $creditor->name ,
                        amount: $totalAmount , 
                    );
                }
            }
        }

        return $results ; 
        
    }

    public function PaysUsers($members) 
    {
        $results = [] ; 

        foreach ($members as $debtor) {
            $results = array_merge($results , $this->PayBettwenUserAndMemnbers($debtor , $members)) ;
        }

        // dd($results) ; 

        return $results ; 
        
    }


    public function NetBalanceBetweenUsers($debtorId , $creditorId) 
    {
        $userDeptor = $this -> settlementRepository->getTotalAmountBetweenTwoUsers($debtorId , $creditorId) ;

        $usercrediotr = $this -> settlementRepository-> getTotalAmountBetweenTwoUsers($creditorId , $debtorId) ;

        return $userDeptor - $usercrediotr ; 
    }

    public function MonSoldeOncolocation($userId , $members) 
    {
        $user = $this -> userService->FindById($userId) ;

        // dd($user) ; 

        $pays = $this -> PayBettwenUserAndMemnbers($user , $members) ;
    
        $solde = $pays ? array_reduce($pays ,fn($carry , $item)=>  $carry + $item->amount ,0 ) : 0  ;

        // dd($solde) ; 


        return $solde ;


    }



}
