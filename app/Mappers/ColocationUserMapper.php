<?php

namespace App\Mappers;

use App\DTOs\ColocationUserDTO;
use App\Models\ColocationUser;

class ColocationUserMapper
{
    
    public static function toDTO(ColocationUser $pivot): ColocationUserDTO
    {
        return new ColocationUserDTO(
            userId: $pivot->user_id,
            colocationId: $pivot->colocation_id,
            role: $pivot->role,
            status: $pivot->status,
            joinedAt: $pivot->joined_at ? (string) $pivot->joined_at : null,
            leftAt: $pivot->left_at ? (string) $pivot->left_at : null,
        );
    }

    public static function toModel(ColocationUserDTO $dto, ?ColocationUser $existingPivot = null): ColocationUser
    {
        $pivot = $existingPivot ?? new ColocationUser();

        $pivot->user_id = $dto->userId;
        $pivot->colocation_id = $dto->colocationId;
        $pivot->role = $dto->role;
        $pivot->status = $dto->status;
        $pivot->joined_at = $dto->joinedAt;
        $pivot->left_at = $dto->leftAt;

        return $pivot;
    }

}
