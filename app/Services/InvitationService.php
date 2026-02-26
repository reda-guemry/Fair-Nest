<?php

namespace App\Services;

use App\DTOs\InvitationDTO;
use App\Mail\ColocationInvitation;
use App\Mappers\InvitationMapper;
use App\Repositorys\InvitationRepository;
use App\Repositorys\UserRepository;
use Mail;
use Nette\Utils\Random;
use Str;

class InvitationService
{
    /**
     * Create a new class instance.
     */
    public function __construct(
        private UserRepository $userRepository , 
        private InvitationRepository $invitationRepository , 

    ){}



    public function sendInvitation($data) 
    {
        $userReceive = $this -> userRepository -> findByID($data['user_id']) ; 

        $token = Str::random(64) ;

        $expiresAt = now()->addDay() ;

        $dto = new InvitationDTO(
            colocationId: $data['colocation_id'] , 
            email: $userReceive->email , 
            token: $token ,
            status: 'pending' ,
            expiresAt: $expiresAt->toDateTimeString()
        ) ;

        $model = InvitationMapper::toModel($dto) ; 
        
        $this->invitationRepository->save($model) ; 

        Mail::to($userReceive->email)->send(new ColocationInvitation($dto)) ; 

    }

    public function processInvitation($token) 
    {
        $invitation = $this -> invitationRepository -> findByToken($token) ; 

        if(!$invitation)
        {
            return false ; 
        }

        return InvitationMapper::toDTO($invitation) ;

    }


}
