<?php

namespace App\Mappers;

use App\DTOs\ColocationDTO;
use App\Models\Colocation;

class ColocationMapper
{
    
    public static function toDTO(Colocation $colocation): ColocationDTO
    {
        return new ColocationDTO(
            id: $colocation->id,
            name: $colocation->name,
            ownerId: $colocation->owner_id,
            status: (bool) $colocation->status, 
        );
    }                               

    public static function toModel(ColocationDTO $dto, ?Colocation $existingModel = null): Colocation
    {
        $model = $existingModel ?? new Colocation();

        $model->name = $dto->name;
        $model->owner_id = $dto->ownerId;
        
        $model->status = $dto->status ?? true;

        return $model;
    }

}
