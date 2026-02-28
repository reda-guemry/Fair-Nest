<?php

namespace App\Services;

use App\DTOs\SettlementDTO;
use App\DTOs\TotalPaysBettwenTwoUserDTO;
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

    public function PayBettwenUserAndMemnbers($creditor , $members) 
    {
        $results = [] ; 

        foreach ($members as $debtor) {
            if ($creditor->userId !== $debtor->userId) {
                $totalAmount = $this->NetBalanceBetweenUsers($creditor->userId, $debtor->userId);
                    $results[] = new TotalPaysBettwenTwoUserDTO(
                        userA_Id: $creditor->userId,
                        userB_Id: $debtor->userId ,
                        userA_name: $creditor->name ,
                        userB_name: $debtor->name ,
                        amount: $totalAmount , 
                    );
            }
        }

        return $results ; 
        
    }

    public function PaysUsers($members) 
    {
        $results = [] ; 

        foreach ($members as $creditor) {
            $results = array_merge($results , $this->PayBettwenUserAndMemnbers($creditor , $members)) ;
        }

        $results = array_filter($results , fn($item) => $item->amount > 0 ) ;

        // dd($results) ; 

        return $results ; 
        
    }


    public function NetBalanceBetweenUsers($creditorId , $debtorId) 
    {
        $userDeptor = $this -> settlementRepository->getTotalAmountBetweenTwoUsers($creditorId , $debtorId) ;

        $userCreditor = $this -> settlementRepository-> getTotalAmountBetweenTwoUsers($debtorId , $creditorId) ;

        return $userDeptor - $userCreditor ; 
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

    public function paye($userA_Id , $userB_Id , $colocationId) 
    {
        return $this -> settlementRepository->paye($userA_Id , $userB_Id , $colocationId) ;
        
    }



}
