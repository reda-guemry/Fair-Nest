<?php

namespace App\Repositorys;

use App\Models\ColocationUser;

class ColocationUserRepository
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    

    public function save(ColocationUser $colocationUser) 
    {
        $colocationUser->save() ; 
        return $colocationUser ; 
    }
    
}
