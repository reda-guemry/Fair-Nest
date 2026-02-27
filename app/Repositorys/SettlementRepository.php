<?php

namespace App\Repositorys;

use App\Models\Settlement;

class SettlementRepository
{
    /**
     * Create a new class instance.
     */
    public function __construct(

    ){}

    public function createSettlement(Settlement $settlement) 
    {
        // dd($settlement) ; 
        $settlement->save() ; 
        return $settlement ; 

    }


    public function getTotalAmountBetweenTwoUsers($debtorId , $creditorId) 
    {
        return Settlement::where('debtor_id' , $debtorId)
            ->where('creditor_id' , $creditorId)
            ->sum('amount') ;

    }





}
