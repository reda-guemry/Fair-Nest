<?php

namespace App\Repositorys;

use App\Models\User;

class UserRepository
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public function findByID($userId) 
    {
        return User::find($userId) ;
    }

    public function getUserWithColocations($userId)
    {
            return User::with('colocations')->find($userId);
    }

    public function search($query)
    {
        return User::whereRaw("CONCAT(first_name, ' ', last_name) LIKE ?", ["%{$query}%"]) 
                    ->orWhere('email' , 'LIKE' , "%$query%")
                    ->limit(5)
                    ->get();
    }



}
