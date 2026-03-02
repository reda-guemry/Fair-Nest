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
        private SettlementService $settlementService,
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

    public function findColocationOwner($colocationId)
    {
        return $this->colocationRepository->findOwnerByColocationId($colocationId);
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

    public function colocationSettings($colocationId)
    {
        $colocation = $this->colocationRepository->getColocationSetting($colocationId);

        // dd($colocation) ;

        return ColocationMapper::toDTO($colocation);
    }

    public function getColocationDetails($colocationId)
    {
        $colocation = $this->colocationRepository->getColocationWithMembers($colocationId);

        // dd($colocation) ; 

        $colocation->members = $colocation->members->filter(fn($member) => $member->pivot->status == 'active');

        return ColocationMapper::toDTO($colocation);
    }

    public function getColocationsForUser($userId)
    {
        $userCol = $this->userRepository->getUserWithColocations($userId);

        // dd($userCol);

        return UserMapper::toDTO($userCol);
    }

    public function getUserFromColocationUser($colocationUserId)
    {
        return $this->userRepository->findByID($colocationUserId);

    }

    public function addMemberToColocation($colocationId, $userId)
    {
        // dd($colocationId , $userId) ;

        $colcoationUser = new ColocationUserDTO(
            colocationId: $colocationId,
            userId: $userId,
            role: 'member',
            status: 'active',
            joinedAt: now()->toDateString()
        );

        $model = ColocationUserMapper::toModel($colcoationUser);

        $this->colocationUserRepository->save($model);


    }

    public function addCategoryToColocation($colocationId, $categoryName)
    {
        $colocation = $this->colocationRepository->findById($colocationId);

        return $this->colocationRepository->saveCategory($colocation, $categoryName);

    }

    public function kickMember($colocationId, $memberId, $owner)
    {
        if (!$owner->isOwner($colocationId)) {
            return ['status' => false, 'message' => 'only owner can kick'];
        }

        $colocationUser = ColocationUserMapper::toDTO($this->colocationUserRepository->findByColocationAndUser($colocationId, $memberId));

        if (!$colocationUser) {
            return ['status' => false, 'message' => 'Membre non trouvé dans cette colocation'];
        }

        $this->processLeaving($colocationUser, $owner->id, 'kicked');

        return ['status' => true, 'message' => 'Membre expulsé avec succès'];

    }



    public function processLeaving($colocationUser, $actorId , $status)
    {

        $user = $this->getUserFromColocationUser($colocationUser->userId);

        DB::transaction(function () use ($colocationUser, $actorId, $user, $status) {

            $this->settlementService->transferDebts($colocationUser, $actorId);

            $colocationUser->status = $status;
            $colocationUser->leftAt = now()->toDateString();

            $user->reputation += 1;

            // dd($colocationUser) ; 

            $this->userRepository->save($user);

            $this->colocationUserRepository->save(ColocationUserMapper::toModel($colocationUser));

        });


    }

    public function quitColocation($colocationId, $userId , $ownerId)
    {

        if (Auth::user()->isOwner($colocationId)) {
            return ['status' => false, 'message' => 'Owner cannot quit directly'];
        }

        $colocationUser = ColocationUserMapper::toDTO($this->colocationUserRepository->findByColocationAndUser($colocationId, $userId));

        if (!$colocationUser) {
            return ['status' => false, 'message' => 'Member not found'];
        }

        $this->processLeaving($colocationUser, $ownerId , 'left');

        return ['status' => true, 'message' => 'quitter avec succes'];

    }

    public function deletColocation($colocationId)
    {
        if(!Auth::user()->isOwner($colocationId))
        {
            return ['status' => false, 'message' => 'only owner can delete'];
        }
        $this ->colocationRepository->delete($colocationId);
        return ['status' => true, 'message' => 'colocation deleted'];
    }

}
