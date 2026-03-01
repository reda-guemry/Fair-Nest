<?php

namespace App\Repositorys;

use App\Models\User;

class UserRepository
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public function save(User $user) 
    {
        return $user->save() ;
    }

    public function findByID($userId)
    {
        return User::find($userId);
    }

    public function getUserWithColocations($userId)
    {
        return User::with(['colocations' => fn($query) => $query->wherePivot('status' , 'active')  ])->find($userId);
    }

    public function search($query)
    {
        return User::whereRaw("CONCAT(first_name, ' ', last_name) LIKE ?", ["%{$query}%"])
            ->orWhere('email', 'LIKE', "%$query%")
            ->limit(5)
            ->get();
    }

    public function paginated()
    {
        return User::paginate(10);
    }

    public function banUser($userId, $reason = null)
    {
        return User::where('id', $userId)->update(['is_banned' => true,'reason' => $reason]);
    }

    public function unbanUser($userId)
    {
        return User::where('id', $userId)->update(['is_banned' => false,'reason' => null]);
    }

}
