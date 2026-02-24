<?php

namespace App\Mappers;

use App\DTOs\UserDTO;
use App\Models\User;

class UserMapper
{

    public static function toDTO(User $user): UserDTO
    {
        return new UserDTO(
            id: $user->id,
            name: $user->name,
            email: $user->email,
            reputation: $user->reputation,
            isBanned: $user->is_banned
        );
    }

    public static function toModel(UserDTO $dto, ?User $existingModel = null): User
    {
        $model = $existingModel ?? new User();

        $model->name = $dto->name;
        $model->email = $dto->email;
        $model->reputation = $dto->reputation;
        $model->is_banned = $dto->isBanned;

        return $model ; 
    }

}
