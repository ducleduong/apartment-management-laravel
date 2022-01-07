<?php

namespace App\Http\Controllers;

use App\Models\Contract;
use Illuminate\Http\Request;

class ContractController extends Controller
{
    public function list(Request $request){
        $contracts_query = Contract::all();

        if($request->apartment_id) {
            $contracts_query->when('apartment_id',$request->apartment_id);
        }

        if($request->resident_id) {
            $contracts_query->when('resident_id',$request->resident_id);
        }
        
        return response()->json($contracts_query);
    }

}
