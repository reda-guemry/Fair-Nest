<?php

namespace App\Http\Controllers;

use App\Services\InvitationService;
use Illuminate\Http\Request;

class InvitationController extends Controller
{

    public function __construct(
        private InvitationService $invitationService
    ){}


    public function store() 
    {
        


    }


}
