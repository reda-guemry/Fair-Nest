<?php

namespace App\Services;

use App\Mappers\UserMapper;
use App\Repositorys\UserRepository;

class UserService
{
    /**
     * Create a new class instance.
     */
    public function __construct(
        private UserRepository $userRepository
    ){}

    public function getFilteredUsers($query)
    {
        return $this -> userRepository -> search($query) -> map(fn($user) => UserMapper::toDTO($user)) ; 
    }

    public function FindById($id)
    {
        return UserMapper::toDTO($this->userRepository->findById($id)) ;
    }

    public function AllUsersPagenated()
    {
        $users =  $this->userRepository->paginated() ;

        // dd($users) ;

        $users->getCollection()->transform(fn($user) => UserMapper::toDTO($user)) ;
        
        return $users ;
    }

    public function banUser($userId , $reason = null)
    {
        $userColocation = $this -> userRepository -> getUserWithColocationUser($userId) ;

        // dd($userColocation) ;

        foreach($userColocation->colocations as $colocation)
        {
            if($colocation->pivot->role == 'owner')
            {
                return ['status' => false , 'message' => 'Vous ne pouvez pas bannir un propriétaire' , 'colocationId' => $colocation->id] ;
            }
        }

        $this -> userRepository -> banUser($userId , $reason) ;

        return ['status' => true , 'message' => 'Utilisateur banni avec succès'] ;
        
    }

    public function unbanUser($userId)
    {
        $this->userRepository->unbanUser($userId);
    }

}
