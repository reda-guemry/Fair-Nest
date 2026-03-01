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
        $this -> userRepository -> banUser($userId , $reason) ;
        
    }

    public function unbanUser($userId)
    {
        $this->userRepository->unbanUser($userId);
    }

}
