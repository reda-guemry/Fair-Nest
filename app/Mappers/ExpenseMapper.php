<?php

namespace App\Mappers;

use App\DTOs\ExpenseDTO;
use App\Models\Expense;


class ExpenseMapper
{
    /**
     * Create a new class instance.
     */
    public static function toDTO(Expense $expense) 
    {
        return new ExpenseDTO(
            id: $expense->id,
            colocationId: $expense->colocation_id,
            payerId: $expense->payer_id,
            categoryId: $expense->category_id,
            title: $expense->title, 
            amount: (float) $expense->amount, 
        );
    }

    public static function toModel(ExpenseDTO $dto, ?Expense $existingModel = null): Expense
    {
        $model = $existingModel ?? new Expense();

        $model->colocation_id = $dto->colocationId;
        $model->payer_id = $dto->payerId;
        $model->category_id = $dto->categoryId;
        $model->title = $dto->title; 
        $model->amount = $dto->amount;

        return $model;
    }

}
