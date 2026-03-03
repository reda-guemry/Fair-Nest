<?php

namespace App\Http\Controllers;

use App\Services\ColocationService;
use Illuminate\Http\Request;

class MessageController extends Controller
{

    public function __construct(
        private ColocationService $colocationService
    ){}

    public function index($colocation) 
    {
        $colocation = $this->colocationService->getColocationChat($colocation);
        

        return view('colocation.colocation-chat' , compact('colocation'));

    }

    public function sendMessage(Request $request, $colocationId)
    {
        
    }
}
