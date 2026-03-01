<?php

namespace App\Repositorys;

use App\Models\Settlement;
use phpDocumentor\Reflection\PseudoTypes\True_;

class SettlementRepository
{
    /**
     * Create a new class instance.
     */
    public function __construct(

    ) {
    }

    public function createSettlement(Settlement $settlement)
    {
        // dd($settlement) ; 
        $settlement->save();
        return $settlement;

    }


    public function getTotalAmountBetweenTwoUsers($creditorId, $debtorId)
    {
        return Settlement::where('debtor_id', $debtorId)
            ->where('creditor_id', $creditorId)
            ->where('status' , false) 
            ->sum('amount');

    }


    public function paye($userA_Id, $userB_Id, $colocationId)
    {
        return Settlement::where(function ($query) use ($userA_Id, $userB_Id) {
            $query->where(function ($q) use($userA_Id , $userB_Id) {
                $q->where('debtor_id' , $userA_Id) 
                ->where('creditor_id' , $userB_Id) ; 
            })->orwhere(function ($q) use($userA_Id , $userB_Id) {
                $q->where('debtor_id' , $userB_Id) 
                ->where('creditor_id' , $userA_Id) ; 
            }) ;
        })->where('colocation_id' ,  $colocationId) 
        ->update(['status' => true]);
    }

    public function transferDebts($userId , $userTranferId )
    {
        return Settlement::where('debtor_id' , $userId)
                        -> update(['debtor_id' => $userTranferId]) ;
    }

    public function transferCreditors($userId , $userTransferId)
    {
        return Settlement::where('creditor_id' , $userId)
        ->update(['creditor_id' => $userTransferId]);
    }



}
