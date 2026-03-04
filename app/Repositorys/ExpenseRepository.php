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
        );

        $dto->id = $expenses->id;

        return $expenses;

    }

    public function attachParticipants(array $participants, Expense $expense)
    {
        $expense->participants()->attach($participants);

        return $expense->load('participants');
    }

    public function getTotalExpenses($colocationId)
    {
        return Expense::where('colocation_id', $colocationId)->sum('amount');
    }

    public function getTotalExpensesForUserParticiper($colocationId, $userId)
    {
        // dd(Expense::where('colocation_id', $colocationId)
        // ->whereHas('participants' , function ($query) use ($userId) {
        //     $query -> where('user_id' , $userId) ;
        // })
        // ->get()) ;

        return Expense::with('participants')
            ->where('colocation_id', $colocationId)
            ->where(function ($query) use ($userId) {
                $query->where('payer_id', $userId)
                    ->orWhereHas('participants', fn ($q) => $q->where('user_id', $userId));
            })
            ->get()
            ->sum(function ($expense) {
                return $expense->amount / ($expense->participants->count() + 1);
            });
    }
}
