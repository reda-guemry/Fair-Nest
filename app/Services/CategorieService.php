<?php

namespace App\Services;

use App\Mappers\CategoryMapper;
use App\Repositorys\CategorieRepository;

class CategorieService
{
    /**
     * Create a new class instance.
     */
    public function __construct(
        private CategorieRepository $categorieRepository
    ){}

    public function getAllCategories() 
    {
        return $this->categorieRepository->all() -> map(fn($cat) => CategoryMapper::toDTO($cat) );
    }

    public function updateCategory($colocationId, $categoryId, $name)
    {
        $category = $this->categorieRepository->findById($categoryId);
        if ($category && $category->colocation_id == $colocationId) {
            $this->categorieRepository->update($categoryId, $name);
            return [
                'success' => true,
                'message' => 'Catégorie mise à jour avec succès',
            ];
        }
        return [
            'success' => false,
            'message' => 'Catégorie non trouvée ou ne correspondant pas à la colocation',
        ];
    }
}
