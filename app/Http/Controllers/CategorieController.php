<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategorieRequest;
use App\Services\CategorieService;
use App\Services\ColocationService;
use Illuminate\Http\Request;

class CategorieController extends Controller
{
    public function __construct(
        private ColocationService $colocationService ,
        private CategorieService $categorieService
    ){}


    public function store(Request $request , $colocationId)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $this->colocationService->addCategoryToColocation($colocationId, $request->name);

        return redirect()->route('colocation.settings', ['colocation' => $colocationId])->with('success', 'Catégorie ajoutée avec succès');
    }

    public function modifier(CategorieRequest $request , $colocationId)
    {

        $result = $this->categorieService->updateCategory($colocationId, $request->category_id , $request->name);

        if ($result['success']) {
            return redirect()->back()->with('success', $result['message']);
        } else {
            return redirect()->back()->with('error', $result['message']);
        }
    }

}
