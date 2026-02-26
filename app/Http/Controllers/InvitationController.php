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

    public function process(Request $request)
    {
        $token = $request->query('token');

        if (!$token) {
            return redirect()->route('dashboard')->with('error', 'Token d\'invitation manquant.');
        }

        $result = $this->invitationService->processInvitation($token);

        if ($result['success']) {
            return redirect()->route('dashboard')->with('success', $result['message']);
        } else {
            return redirect()->route('dashboard')->with('error', $result['message']);
        }
    }


    public function store(InvitationRequest $request) 
    {
        
        $this -> invitationService -> sendInvitation($request->validated()) ; 

        // dd('Invitation envoyée !') ;

        return redirect()->back()->with('success' , 'Invitation envoyée avec succès') ;
    }


}
