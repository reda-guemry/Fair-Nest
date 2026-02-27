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
            description : $colocation->description , 
            status: $colocation->status, 
            membership: $colocation->members ? $colocation->members->map(fn($member) => ColocationUserMapper::toDtoFromUser($member))->toArray() : null , 
            expenses: $colocation->expenses ? $colocation->expenses->map(fn($expense) => ExpenseMapper::toDTO($expense))->toArray() : null ,
            settlements: $colocation->settlements ? $colocation->settlements->map(fn($settlement) => SettlementMapper::toDTO($settlement))->toArray() : null , 
        );  
    }

    public static function toDTOFromUser(Colocation $colocation): ColocationDTO
    {
        return new ColocationDTO(
            id: $colocation->id,
            name: $colocation->name,
            description : $colocation->description , 
            status: $colocation->status, 
            membership: $colocation->pivot ? [ColocationUserMapper::toDTO($colocation->pivot)] : null
        );
    }

    public static function toModel(ColocationDTO $dto, ?Colocation $existingModel = null): Colocation
    {
        $model = $existingModel ?? new Colocation();

        $model->name = $dto->name;
        $model->description = $dto->description ; 
        
        $model->status = $dto->status ?? 'active' ;

        return $model;
    }

}
