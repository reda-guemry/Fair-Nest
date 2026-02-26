<?php

namespace App\Http\Controllers;

use App\Http\Requests\ColocationRequest;
use App\Services\CategorieService;
use App\Services\ColocationService;
use Illuminate\Http\Request;

class ColocationController extends Controller
{

    public function __construct(
        private ColocationService $colocationService , 
        private CategorieService $categorieService 
    )
    {}

    public function show($colocationId)
    {
        $colocation = $this->colocationService->getColocationDetails($colocationId);

        $categories = $this->categorieService->getAllCategories();
        // dd($categories) ;

        return view('colocation.colocation', compact('colocation', 'categories'));
    }
    
    public function store(ColocationRequest $request)
    {

        $this -> colocationService -> createColocation($request->validated()) ;

        return redirect()->route('dashboard')->with('success' , 'Colocation créée avec succès') ;
        
    }


}
