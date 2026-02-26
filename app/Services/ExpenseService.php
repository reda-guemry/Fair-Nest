<?php

namespace App\Services;

use App\DTOs\CreateExpenseDTO;
use App\Repositorys\ExpenseRepository;
use DB;

class ExpenseService
{
    /**
     * Create a new class instance.
     */
    public function __construct(
        private ExpenseRepository $expenseRepository , 
        public SettlementService $settlementService
    )
    {}


    public function createExpense(CreateExpenseDTO $dto)
    {

        DB::transaction(function () use($dto) {
            $ExpensesModel = $this -> expenseRepository -> createExpense($dto) ;

            $participants = array_filter($dto->participants , fn($id) => $id != $dto->payerId) ;

            // dd($participants , $dto) ; 

            $ExpensesModel = $this -> expenseRepository -> attachParticipants($participants , $ExpensesModel) ;

            // dd($ExpensesModel) ;

            $this -> processSplits($dto) ;


        }) ; 

    }

    public function processSplits(CreateExpenseDTO $dto) 
    {
        $cont = count($dto->participants)  ;
        
        // dd($cont) ;

        $shareAmount = round($dto->amount / $cont , 2) ;

        foreach ($dto->participants as $participantId) {
            if ($participantId != $dto->payerId) {
                $this -> settlementService -> createSettlement(
                    colocationId: $dto->colocationId,
                    debtorId: $participantId,
                    creditorId: $dto->payerId,
                    amount: $shareAmount
                ) ;
            }
        }
        
    }



}
