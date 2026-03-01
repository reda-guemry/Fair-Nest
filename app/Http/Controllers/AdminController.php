<?php

namespace App\Http\Controllers;

use App\Http\Requests\BanRequest;
use App\Http\Requests\UnBanRequest;
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

    public function banUser(BanRequest $request)
    {
        $this -> userService -> banUser($request->input('user_id') , $request->input('ban_reason')) ;

        return redirect()->route('dashboard.admin')->with('success', 'Utilisateur banni avec succès');
    }

    public function unbanUser(UnBanRequest $request)
    {
        $this -> userService -> unbanUser($request->input('user_id')) ;

        return redirect()->route('dashboard.admin')->with('success', 'Utilisateur débanni avec succès');
    }

}
