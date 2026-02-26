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


}
