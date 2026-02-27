<?php

namespace App\Mappers;

use App\DTOs\UserDTO;
use App\Models\User;

class UserMapper
{

    public static function toDTO(User $user): UserDTO
    {
        return new UserDTO(
            userId: $user->id,
            name: $user->first_name . ' ' . $user->last_name ,
            email: $user->email,
            reputation: $user->reputation,
            isBanned: $user->is_banned , 
            colocations: $user->colocations ? $user->colocations->map(function($colocation) {
                return ColocationMapper::toDTOFromUser($colocation);
            })->toArray() : null
        );
    }

    public static function toModel(UserDTO $dto, ?User $existingModel = null): User
    {
        $model = $existingModel ?? ($dto->userId ? User::find($dto->userId) : null) ?? new User();

        $model->name = $dto->name;
        $model->email = $dto->email;
        $model->reputation = $dto->reputation;
        $model->is_banned = $dto->isBanned;

        return $model ; 
    }

}
