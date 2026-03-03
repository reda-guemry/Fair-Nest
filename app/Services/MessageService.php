<?php

namespace App\Services;
use App\DTOs\MessageDTO;
use App\Mappers\MessageMapper;
use App\Models\Message;
use App\Repositorys\MessageRepository;

class MessageService
{
    /**
     * Create a new class instance.
     */
    public function __construct(
        private MessageRepository $messageRepository
    ){}

    public function sendMessage($message  , $colocation_id , $user_id , $attachment = null)
    {
        // dd($colocation_id);

        $dto = new MessageDTO (
            content : $message,
            colocationId : $colocation_id,
            userId : $user_id,
            type: 'message' ,
        );

        if ($attachment) {
            $path = $attachment->store('attachments', 'public');

            $dto->filePath = basename($path);


            $mime = $attachment->getMimeType();

            if (str_starts_with($mime, 'image/')) {
                $dto->type = 'image';
            } else if (str_starts_with($mime, 'video/')) {
                $dto->type = 'video';
            } else {
                $dto->type = 'file';
            }
        }

        // dd($dto);

        $this->messageRepository->store(MessageMapper::toModel($dto)) ;
        
    }

}
