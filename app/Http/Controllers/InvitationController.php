<?php

namespace App\Http\Controllers;

use App\Http\Requests\InvitationRequest;
use App\Http\Requests\TokenRequest;
use App\Services\InvitationService;
use Illuminate\Http\Request;
use View;

class InvitationController extends Controller
{

    public function __construct(
        private InvitationService $invitationService
        )
    {
    }

    public function process(Request $request)
    {
        $token = $request->query('token');

        if (!$token) {
            return redirect()->route('dashboard')->with('error', 'Token d\'invitation manquant.');
        }

        $invitation = $this->invitationService->processInvitation($token);


        if (!$invitation['status']) {
            return redirect()->route('dashboard')->with('error', $invitation['message']);
        }

        $invitation = $invitation['invitation'];

        return View('invitation.decide', compact('invitation'));

    }


    public function store(InvitationRequest $request)
    {

        $this->invitationService->sendInvitation($request->validated());

        // dd('Invitation envoyée !') ;

        return redirect()->back()->with('success', 'Invitation envoyée avec succès');
    }

    public function decide(TokenRequest $request)
    {
        $invitationDto = $this->invitationService->decideInvitation($request->validated());

        if (!$invitationDto) {
            return redirect()->route('dashboard')->with('error', 'Failed to enter Colocation');
        }

        return redirect()->route('colocation.show', $invitationDto->colocationId);
    }


}