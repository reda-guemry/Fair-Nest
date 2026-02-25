<?php

namespace App\Http\Controllers;

use App\Services\ColocationService;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function __construct(
        private ColocationService $colocationService
    ) {
    }


    public function index()
    {
        $userColocation = $this->colocationService->getColocationsForUser(auth()->id());

        // dd($userColocation );

        return view('dashboard', compact('userColocation'));
    }
}
