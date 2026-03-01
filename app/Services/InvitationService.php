<?php

namespace App\Services;

use App\DTOs\InvitationDTO;
use App\Mail\ColocationInvitation;
use App\Mappers\InvitationMapper;
use App\Repositorys\InvitationRepository;
use App\Repositorys\UserRepository;
use Auth;
use Carbon\Carbon;
use DB;
use Mail;
use Nette\Utils\Random;
use Str;

class InvitationService
{
    /**
     * Create a new class instance.
     */
    public function __construct(
        private UserRepository $userRepository,
        private InvitationRepository $invitationRepository,
        private ColocationService $colocationService
    ) {
    }



    public function sendInvitation($data)
    {
        $userReceive = $this->userRepository->findByID($data['user_id']);

        $token = Str::random(64);

        $expiresAt = now()->addDay();

        $dto = new InvitationDTO(
            colocationId: $data['colocation_id'],
            email: $userReceive->email,
            token: $token,
            status: 'pending',
            expiresAt: $expiresAt->toDateTimeString()
        );

        $model = InvitationMapper::toModel($dto);

        $this->invitationRepository->save($model);

        Mail::to($userReceive->email)->send(new ColocationInvitation($dto));

    }

    public function processInvitation($token)
    {
        $invitation = $this->invitationRepository->findByToken($token);

        // dd($invitation);


        $user = Auth::user();

        if (!$invitation) 
        {
            return ['status' => false, 'message' => 'Invitation not found'];
        }

        $invitation = InvitationMapper::toDTO($invitation) ;

        if ($invitation->status === 'refuse') {
            return ['status' => false, 'message' => 'Invitation is refused'];
        }

        if (Carbon::parse($invitation->expiresAt)->isPast()) {
            // dd('slm');

            return ['status' => false, 'message' => 'Invitation is expired'];
        }


        if (!$invitation->email === $user->email) {
            // dd('slm') ;

            return ['status' => false, 'message' => 'Invitation is not for you'];
        }

        if (!$user->is_global_admin) {
            if (!$user->isFree()) {
                // dd('slm') ;
                return ['status' => false, 'message' => 'You have an active Colocation'];
            }
        }

        return ['status' => true, 'message' => 'Invitation is valid', 'data' => $invitation];

    }


    public function checkInvi($invitation, $data)
    {
        if (!$invitation) {
            return false;
        }

        if (!$invitation->email === $data['email']) {
            return false;
        }

    }

    public function decideInvitation($data)
    {
        $invitationdto = InvitationMapper::toDTO($this->invitationRepository->findByToken($data['token']));

        $this->checkInvi($invitationdto, $data);

        $invitationdto->status = $data['action'];


        $invitationModel = InvitationMapper::toModel($invitationdto);


        DB::transaction(function () use ($invitationModel) {
            if ($invitationModel->status === 'accept') {
                $this->colocationService->addMemberToColocation($invitationModel->colocation_id, Auth::id());
            }

            $this->invitationRepository->save($invitationModel);
        });

        if($invitationdto->status === 'refuse')
        {
            return false ; 
        }

        return $invitationdto;

    }


}
