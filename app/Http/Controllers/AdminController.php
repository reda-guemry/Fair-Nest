<?php

namespace App\Http\Controllers;

use App\Services\CategorieService;
use App\Services\UserService;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function __construct(
        private CategorieService $categorieService , 
        private UserService $userService
    ) {}

    public function index() 
    {

        $users = $this -> userService -> AllUsersPagenated() ;

        // dd($users) ;

        return view('admin.dashboard', compact('users')) ;
    }

    public function banUser($userId)
    {
        $this->userService->banUser($userId);

        return redirect()->route('dashboard.admin')->with('success', 'Utilisateur banni avec succès');
    }

}
