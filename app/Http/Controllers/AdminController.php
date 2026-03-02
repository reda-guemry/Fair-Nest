<?php

namespace App\Http\Controllers;

use App\Http\Requests\BanRequest;
use App\Http\Requests\TransferOwnerShipRequest;
use App\Http\Requests\UnBanRequest;
use App\Repositorys\ColocationRepository;
use App\Services\CategorieService;
use App\Services\ColocationService;
use App\Services\UserService;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function __construct(
        private UserService $userService,
        private ColocationService $colocationService , 

        )
    {
    }

    public function index()
    {

        $users = $this->userService->AllUsersPagenated();

        // dd($users) ;

        return view('admin.dashboard', compact('users'));
    }

    public function banUser(BanRequest $request)
    {
        $return = $this->userService->banUser($request->input('user_id'), $request->input('ban_reason'));

        if ($return['status']) {
            return redirect()->route('dashboard.admin')->with('success', $return['message']);
        }

        return redirect()->route('transfer.ownership', $return['colocationId'])->with('error', $return['message']);

    }

    public function unbanUser(UnBanRequest $request)
    {
        $this->userService->unbanUser($request->input('user_id'));

        return redirect()->route('dashboard.admin')->with('success', 'Utilisateur débanni avec succès');
    }

    public function colocationUsers($colocationId)
    {
        $colocation = $this->colocationService->getColocationMembers($colocationId);

        // dd($colocation) ;

        return view('admin.dhasboard-transfer-ownership', compact('colocation'));
    }

    public function transferOwnership(TransferOwnerShipRequest $request)
    {
        $result = $this->colocationService->transferOwnership($request->input('colocation_id'), $request->input('new_owner_id'), $request->input('old_owner_id'));

        if ($result) {
            $this->userService->banUser($request->input('old_owner_id'));
        }

        return redirect()->route('dashboard.admin')->with('success', 'Propriété transférée avec succès');
    }

}