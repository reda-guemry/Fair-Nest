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

    public function findById($id)
    {
        return Category::find($id);
    }

    public function update($id, $data)
    {
        return Category::where('id', $id)->update(['name' => $data]);
    }

}
