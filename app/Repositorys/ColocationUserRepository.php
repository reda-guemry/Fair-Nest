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
        // dd($colocationUser) ; 
        return $colocationUser ; 
    }

    

    public function findByColocationAndUser($colocationId , $userId)
    {
        return ColocationUser::where('colocation_id' , $colocationId)
        ->where('user_id' , $userId)
        ->where('status' , 'active')
        ->first() ;
    }


    
}
