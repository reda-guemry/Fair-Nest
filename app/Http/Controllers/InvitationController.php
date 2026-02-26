<?php

namespace App\Http\Controllers;

use App\Http\Requests\InvitationRequest;
use App\Services\InvitationService;
use Illuminate\Http\Request;
use View;

class InvitationController extends Controller
{

    public function __construct(
        private InvitationService $invitationService
    ){}

    public function process(Request $request)
    {
        $token = $request->query('token');

        if (!$token) {
            return redirect()->route('dashboard')->with('error', 'Token d\'invitation manquant.');
        }

        $invitation = $this->invitationService->processInvitation($token);

        if (!$invitation) {
            return redirect()->route('dashboard')->with('error', "Invitations dont exist");
        } 

        // dd($invitation) ; 

        return View('invitation.decide' , compact('invitation')) ;
    }


    public function store(InvitationRequest $request) 
    {
        
        $this -> invitationService -> sendInvitation($request->validated()) ; 

        // dd('Invitation envoyée !') ;

        return redirect()->back()->with('success' , 'Invitation envoyée avec succès') ;
    }


}
