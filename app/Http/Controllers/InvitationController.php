<?php

namespace App\Http\Controllers;

use App\Http\Requests\InvitationRequest;
use App\Services\InvitationService;
use Illuminate\Http\Request;

class InvitationController extends Controller
{

    public function __construct(
        private InvitationService $invitationService
    ){}


    public function store(InvitationRequest $request) 
    {
        
        $this -> invitationService -> sendInvitation($request->validated()) ; 

        // dd('Invitation envoyée !') ;

        return redirect()->back()->with('success' , 'Invitation envoyée avec succès') ;
    }


}
