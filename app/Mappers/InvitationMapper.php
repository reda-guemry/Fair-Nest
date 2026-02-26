<?php

namespace App\Mappers;

use App\DTOs\InvitationDTO;
use App\Models\Invitation;

class InvitationMapper
{
   
    public static function toDTO(Invitation $invitation): InvitationDTO
    {
        return new InvitationDTO(
            id: $invitation->id,
            colocationId: $invitation->colocation_id,
            email: $invitation->email,
            token: $invitation->token,
            status: $invitation->status,
            expiresAt: $invitation->expires_at,
        );
    }

    public static function toModel(InvitationDTO $dto, ?Invitation $existingModel = null): Invitation
    {
        $model = $existingModel ?? ($dto->id ? Invitation::find($dto->id) : null) ?? new Invitation() ;

        $model->colocation_id = $dto->colocationId;
        $model->email = $dto->email;
        $model->token = $dto->token;
        $model->status = $dto->status;
        $model->expires_at = $dto->expiresAt;

        return $model;
    }
}
