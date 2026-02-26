<?php

namespace App\Repositorys;

use App\DTOs\CreateExpenseDTO;
use App\Models\Expense;

class ExpenseRepository
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    
    }

    public function createExpense(CreateExpenseDTO $dto) 
    {
        $expenses = Expense::create(
            [
                'colocation_id' => $dto->colocationId,
                'payer_id' => $dto->payerId,
                'category_id' => $dto->categoryId,
                'title' => $dto->title,
                'amount' => $dto->amount,
            ]
        ) ;

        return $expenses ;

    }

    public function attachParticipants(array $participants , Expense $expense) 
    {
        $expense->participants()->attach($participants) ;

        return $expense->load('participants') ;
    }


}

