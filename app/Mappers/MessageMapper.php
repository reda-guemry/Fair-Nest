<?php

namespace App\Mappers;

use App\DTOs\MessageDTO;
use App\Models\Message;


class MessageMapper
{
    /**
     * Create a new class instance.
     */
    public static function toDTO(Message $message, $userDTO = null): MessageDTO
    {
        return new MessageDTO(
            id: $message->id,
            colocationId: $message->colocation_id,
            userId: $message->user_id,
            content: $message->content,
            filePath: $message->file_path,
            type: $message->type,
            createdAt: $message->created_at ? $message->created_at->toDateTimeString() : null,
            updatedAt: $message->updated_at ? $message->updated_at->toDateTimeString() : null,
            userDTO: $userDTO ,

        );
    }

    public static function toModel(MessageDTO $dto, ?Message $existingModel = null): Message
    {
        $model = $existingModel ?? ($dto->id ? Message::find($dto->id) : new Message());

        $model->colocation_id = $dto->colocationId;
        $model->user_id = $dto->userId;
        $model->content = $dto->content;
        $model->file_path = $dto->filePath;
        $model->type = $dto->type;

        return $model;
    }

}
