<?php

namespace App\Http\Controllers;

use App\Http\Requests\MessageRequest;
use App\Services\ColocationService;
use App\Services\MessageService;
use Illuminate\Http\Request;

class MessageController extends Controller
{

    public function __construct(
        private ColocationService $colocationService , 
        private MessageService $messageService
    ){}

    public function index($colocation) 
    {
        $colocation = $this->colocationService->getColocationChat($colocation);
        
        // dd($colocation);

        return view('colocation.colocation-chat' , compact('colocation'));

    }

    public function store(MessageRequest $request )
    {
        // dd($request->validated());

        $this->messageService->sendMessage($request->validated()['message']  , $request->validated()['colocation_id'] , $request->validated()['user_id'] , $request->validated()['attachment'] ?? null);
        
        return redirect()->route('colocation.chat', $request->validated()['colocation_id']);
    }
}
