<?php

namespace App\Services;

use App\DTOs\InvitationDTO;
use App\Mappers\InvitationMapper;
use App\Repositorys\InvitationRepository;
use App\Repositorys\UserRepository;
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
        ) ;

        $model = InvitationMapper::toModel($dto) ; 

        return $this->invitationRepository->save($model) ; 

    }


}
