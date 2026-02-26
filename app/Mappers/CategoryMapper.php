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
            name: $category->name,
        );
    }

    public static function toModel(CategoryDTO $dto, ?Category $existingModel = null): Category
    {
        $model = $existingModel ??  ($dto->id ? Category::find($dto->id) : null) ?? new Category();

        $model->name = $dto->name;

        return $model;
    }
    
}
