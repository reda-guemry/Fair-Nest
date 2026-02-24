<?php

namespace App\Mappers;

use App\DTOs\CategoryDTO;
use App\Models\Category;

class CategoryMapper
{
    public static function toDTO(Category $category): CategoryDTO
    {
        return new CategoryDTO(
            id: $category->id,
            colocationId: $category->colocation_id,
            name: $category->name,
        );
    }

    public static function toModel(CategoryDTO $dto, ?Category $existingModel = null): Category
    {
        $model = $existingModel ?? new Category();

        $model->colocation_id = $dto->colocationId;
        $model->name = $dto->name;

        return $model;
    }
    
}
