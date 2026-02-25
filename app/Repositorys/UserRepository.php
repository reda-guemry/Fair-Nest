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

    public function getUserWithColocations($userId)
    {
            return User::with('colocations')->find($userId);
    }



}
