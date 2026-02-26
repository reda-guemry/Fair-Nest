<?php

namespace App\Http\Controllers;

use App\Http\Requests\ExpenseRequest;
use App\Services\ExpenseService;
use Illuminate\Http\Request;

class ExpenseController extends Controller
{
    
    public function __construct(
        private ExpenseService $expenseService , 
    ) {}


    public function store(ExpenseRequest $request) 
    {
        dd($request->validated()) ;

        return redirect()->back()->with('success' , 'Dépense créée avec succès') ;

    }

}
