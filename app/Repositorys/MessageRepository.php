<?php

namespace App\Repositorys;

use App\Models\Message;

class MessageRepository
{
    /**
     * Create a new class instance.
     */
    public function __construct(
    ){}

    
    public function store(Message $message)
    {
        $message->save();
    }

}
