<?php

namespace App\Services;

use App\DTOs\CreateExpenseDTO;

class ExpenseService
{
    /**
     * Create a new class instance.
     */
    public function __construct(
        
    )
    {}


    public function createExpense(CreateExpenseDTO $dto)
    {

        DB::transaction(function use($dto) {

        })

    }



}
