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
        $invitation->save() ; 
        return $invitation ;
    }

}
