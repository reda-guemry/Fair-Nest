<?php

namespace App\Repositorys;

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

    public function getColocationWithMembers($colocationId)
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

}
