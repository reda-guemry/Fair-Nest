<?php

namespace App\Http\Controllers;

use App\Http\Requests\SettlemetPayeRequest;
use App\Services\SettlementService;
use Illuminate\Http\Request;

class SettlementController extends Controller
{
    public function __construct(
        private SettlementService $settlementService,
    ){}

    public function paye(SettlemetPayeRequest $request)
    {
        $this->settlementService->paye(
            userA_Id: $request->validated()['user_a'],
            userB_Id: $request->validated()['user_b'],
            colocationId: $request->validated()['colocation_id']
        ) ;

        return back() -> with('success' , 'Paiement effectué avec succès') ;

        
    }
}
