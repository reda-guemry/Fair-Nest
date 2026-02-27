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
}
