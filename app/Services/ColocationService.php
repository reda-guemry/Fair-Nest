<?php

namespace App\Services;

use App\DTOs\ColocationDTO;
use App\DTOs\ColocationUserDTO;
use App\Mappers\ColocationMapper;
use App\Mappers\ColocationUserMapper;
use App\Mappers\UserMapper;
use App\Repositorys\ColocationRepository;
use App\Repositorys\ColocationUserRepository;
use App\Repositorys\UserRepository;
use Auth;
use DB;
use Illuminate\Validation\ValidationException;


class ColocationService
{
    /**
     * Create a new class instance.
     */
    public function __construct(
        private ColocationRepository $colocationRepository,
        private ColocationUserRepository $colocationUserRepository,
        private UserRepository $userRepository,
    ) {
    }

    public function createColocation($data)
    {
        $this->CheckUserIsFree();

        return DB::transaction(function () use ($data) {
            $coloDto = new ColocationDTO(
                id: null,
                name: $data['name'],
                description: $data['description'] ?? null,
                status: null,
            );


            $model = ColocationMapper::toModel($coloDto);

            $saveModel = $this->colocationRepository->save($model);

            $coloUserDto = new ColocationUserDTO(
                userId: Auth::id(),
                colocationId: $model->id,
                role: 'owner',
                status: 'active',
                joinedAt: now()->toDateString(),
            );

            $coloUserModel = ColocationUserMapper::toModel($coloUserDto);

            $this->colocationUserRepository->save($coloUserModel);

            return ColocationMapper::toDTO($saveModel);

        });


    }

    public function CheckUserIsFree()
    {
        if (!Auth::user()->is_global_admin) {
            if (!Auth::user()->isFree()) {
                throw ValidationException::withMessages([
                    'colocation' => ['Vous avez déjà une colocation active. Un utilisateur standard ne peut en gérer qu\'une seule.']
                ]);
            }
        }
    }

    public function getColocationDetails($colocationId)
    {
        $colocation = $this->colocationRepository->getColocationWithMembers($colocationId);

        // dd($colocation) ;

        return ColocationMapper::toDTO($colocation);
    }

    public function getColocationsForUser($userId)
    {
        $userCol = $this->userRepository->getUserWithColocations($userId);

        // dd($userCol);

        return UserMapper::toDTO($userCol);
    }


}
