<?php

namespace App\Http\Controllers;

use App\Services\CategorieService;
use App\Services\UserService;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function __construct(
        private CategorieService $categorieService , 
        private UserService $adminService
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
