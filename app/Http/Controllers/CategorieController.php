<?php

namespace App\Http\Controllers;

use App\Services\ColocationService;
use Illuminate\Http\Request;

class CategorieController extends Controller
{
    public function __construct(
        private ColocationService $colocationService ,
    ){}


    public function store(Request $request , $colocationId)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $this->colocationService->addCategoryToColocation($colocationId, $request->name);

        return redirect()->route('colocation.settings', ['colocation' => $colocationId])->with('success', 'Catégorie ajoutée avec succès');
    }

}
