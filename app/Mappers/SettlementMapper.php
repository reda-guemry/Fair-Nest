<?php

namespace App\Mappers;

use App\DTOs\SettlementDTO;
use App\Models\Settlement;

class SettlementMapper
{

    public static function toDTO(Settlement $settlement): SettlementDTO
    {
        return new SettlementDTO(
            id: $settlement->id,
            colocationId: $settlement->colocation_id,
            debtorId: $settlement->debtor_id,
            creditorId: $settlement->creditor_id,
            amount: (float) $settlement->amount, 
            status: $settlement->status,
            expenseId: $settlement->expense_id, 
        );
    }

    public static function toModel(SettlementDTO $dto, ?Settlement $existingModel = null): Settlement
    {
        $model = $existingModel ?? ($dto->id ? Settlement::find($dto->id) : null) ?? new Settlement();

        $model->colocation_id = $dto->colocationId;
        $model->debtor_id = $dto->debtorId;
        $model->creditor_id = $dto->creditorId;
        $model->amount = $dto->amount;
        $model->status = $dto->status;
        $model->expense_id = $dto->expenseId;

        return $model;
    }
}
