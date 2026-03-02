<?php

namespace App\Http\Controllers;

use App\Http\Requests\ColocationRequest;
use App\Http\Requests\KickRequest;
use App\Http\Requests\LeaveRequest;
use App\Services\CategorieService;
use App\Services\ColocationService;
use App\Services\SettlementService;
use Auth;
use Illuminate\Http\Request;

class ColocationController extends Controller
{

    public function __construct(
        private ColocationService $colocationService , 
        private CategorieService $categorieService  , 
        private SettlementService $settlementService , 
    )
    {}

    public function show($colocationId)
    {
        $colocation = $this->colocationService->getColocationDetails($colocationId);


        $WhoPaysWhos = $this-> settlementService->PaysUsers($colocation->membership) ;

        $monSold = $this->settlementService->MonSoldeOncolocation(auth()->id() , $colocation->membership) ;

        dd($colocation) ;

        return view('colocation.colocation', compact('colocation', 'WhoPaysWhos' , 'monSold'));
    }
    
    public function store(ColocationRequest $request)
    {

        $this -> colocationService -> createColocation($request->validated()) ;

        return redirect()->route('dashboard')->with('success' , 'Colocation créée avec succès') ;
        
    }


    public function setting($colocationId)
    {

        $colocation = $this->colocationService->colocationSettings($colocationId) ;


        return view('colocation.colocation-owner-settings', compact('colocation')   ) ;
    }

    public function kick(KickRequest $request)
    {

        $return = $this -> colocationService -> kickMember($request->validated()['colocation_id'] , $request->validated()['member_id'] , Auth::user()) ;

        return redirect() -> back() -> with($return['status'] ? 'success' : 'error' , $return['message'] ) ;
        
    }

    public function leaveColocation(LeaveRequest $request)
    {  
        $ownerId = $this -> colocationService ->findColocationOwner($request->validated()['colocation_id']) ;

        $return = $this -> colocationService -> quitColocation($request->validated()['colocation_id'] , $request->validated()['user_id'] , $ownerId) ;

        if($return['status']) {
            return redirect()->route('dashboard') -> with('succes' , $return['message'] ) ;
        }else {
            return redirect()->back()->with('error' , $return['message'] );
        }

    } 

    public function delete($colocation) 
    {
        $result = $this -> colocationService -> deletColocation($colocation) ;

        if($result['status']) {
            return redirect()->route('dashboard') -> with('succes' , $result['message'] ) ;
        }else {
            return redirect()->back()->with('error' , $result['message'] );
        }

    }

}
