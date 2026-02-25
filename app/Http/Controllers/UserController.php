<?php

namespace App\Http\Controllers;

use App\Services\ColocationService;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function __construct(
        private ColocationService  $colocationService
    )
    {}


    public function index()
    {
        $colocations = $this->colocationService->getColocationsForUser(auth()->id());


        return view('dashboard');
    }
}
