<?php

namespace App\Services;

use App\DTOs\ColocationDTO;
use App\Mappers\ColocationMapper;
use App\Repositorys\ColocationRepository;
use Auth;
use DB;
use Illuminate\Validation\ValidationException;


class ColocationService
{
    /**
     * Create a new class instance.
     */
    public function __construct(
        private ColocationRepository $colocationRepository
    ) {
    }

    public function createColocation($data)
    {
        $this->CheckUserIsFree();

        return DB::transaction(function () use ($data) {
            $dto = new ColocationDTO(
                id: null,
                name: $data['name'],
                description: $data['description'] ?? null,
                status: null,
            );


            $model = ColocationMapper::toModel($dto);

            $saveModel = $this->colocationRepository->save($model);

            return ColocationMapper::toDTO($saveModel);
            
        });


    }

    public function CheckUserIsFree()
    {
        if (!Auth::user()->is_global_admin) {
            if (Auth::user()->isFree()) {
                throw ValidationException::withMessages([
                    'colocation' => ['Vous avez déjà une colocation active. Un utilisateur standard ne peut en gérer qu\'une seule.']
                ]);
            }
        }
    }



}
