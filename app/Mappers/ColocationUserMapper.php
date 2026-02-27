<?php

namespace App\Mappers;

use App\DTOs\ColocationUserDTO;
use App\Models\Colocation;
use App\Models\ColocationUser;
use App\Models\User;

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

    public static function toDtoFromUser(User $user): ColocationUserDTO 
    {
        // dd($user) ;
        return new ColocationUserDTO(
            userId: $user->id,
            colocationId: $user->pivot->colocation_id,
            name: $user->first_name . ' ' . $user->last_name,
            email: $user->email,
            role: $user->pivot->role,
            joinedAt: $user->pivot->joined_at,
            leftAt: $user->pivot->left_at,
            status: $user->pivot->status 
        );
    }

    // public static function toDtoFromColocation(Colocation $colocation)
    // {
    //     return new ColocationUserDTO(
    //         userId: $colocation->pivot->user_id,
    //         colocationId: $colocation->pivot->colocation_id,
    //         role: $colocation->pivot->role,
    //         firstName: $colocation->user->first_name,
    //         lastName: $colocation->user->last_name,
    //         email: $colocation->user->email,
    //         status: $colocation->pivot->status,
    //         joinedAt: $colocation->pivot->joined_at ? (string) $colocation->pivot->joined_at : null,
    //         leftAt: $colocation->pivot->left_at ? (string) $colocation->pivot->left_at : null,
    //     );

    // }

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
