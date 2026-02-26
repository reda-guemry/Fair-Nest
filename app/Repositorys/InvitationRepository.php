<?php

namespace App\Repositorys;

use App\Models\Colocation;
use App\Models\Invitation;

class InvitationRepository
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {}

    public function save(Invitation $invitation)
    {
        // dd($invitation) ;
        $invitation->save() ; 
        return $invitation ;
    }

    public function findByToken($token ) 
    {
        return Invitation::where('token' , $token )->first() ;
    }

}
