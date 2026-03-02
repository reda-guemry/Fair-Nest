<?php

namespace App\Repositorys;

use App\Mappers\ColocationMapper;
use App\Models\Colocation ;

class ColocationRepository
{
    /**
     * Create a new class instance.
     */
    public function __construct(
    )
    {}

    // public function create($data)
    // {
    //     return Colocation::create($data);
    // }

    public function getColocationWithDeatils($colocationId)
    {
        return Colocation::with('members' , 'expenses.payer' , 'expenses.category' , 'expenses.participants' ,  'settlements' , 'categories')->find($colocationId);
    }

    public function getColocationMembers($colocationId)
    {
        return Colocation::with('members')->find($colocationId);
    }

    public function findById($id)
    {
        return Colocation::find($id);
    }

    public function save(Colocation $colocation) 
    {
        $colocation->save() ; 
        return $colocation ; 
    }

    public function getColocationSetting($colocationId)
    {
        return Colocation::with('categories')->find($colocationId);
    }

    public function saveCategory(Colocation $colocation , $categoryName)
    {
        $category = $colocation->categories()->create(['name' => $categoryName]) ;

        return $category ;
    }

    public function findOwnerByColocationId($colocationId)
    {
        return Colocation::find($colocationId)->owner()->first()->id ; 
    }

    public function delete($colocationId)
    {
        return Colocation::find($colocationId)->delete();
    }

    

}
