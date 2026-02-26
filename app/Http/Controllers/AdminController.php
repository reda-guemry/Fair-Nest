<?php

namespace App\Http\Controllers;

use App\Services\CategorieService;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function __construct(
        private CategorieService $categorieService
    ) {}

    public function index() 
    {


        return view('admin.dashboard') ;
    }


    public function categoriesShow() 
    {
        $categories = $this->categorieService->getAllCategories() ;

        return view('admin.categorie', compact('categories')) ;
    }

}
