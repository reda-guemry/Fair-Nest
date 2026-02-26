<?php

namespace App\Repositorys;

use App\Models\Category;

class CategorieRepository
{
    /**
     * Create a new class instance.
     */
    public function __construct(

    ){}

    public function all() 
    {
        return Category::all();
    }

}
