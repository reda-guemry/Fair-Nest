<?php

namespace App\Http\Controllers;

use App\DTOs\CreateExpenseDTO;
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
        // dd($request->validated()) ;

        $dto = new CreateExpenseDTO(
            colocationId: $request->validated()['colocation_id'],
            payerId: $request->validated()['payer_id'],
            categoryId: $request->validated()['category_id'],
            title: $request->validated()['title'],
            amount: $request->validated()['amount'],
            participants: $request->validated()['split_with'] , 
        ) ;

        $this->expenseService->createExpense($dto) ; 


        return redirect()->back()->with('success' , 'Dépense créée avec succès') ;

    }

}
