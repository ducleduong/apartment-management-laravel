<?php

namespace App\Http\Controllers;

use App\Models\Contract;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ContractController extends Controller
{
    public function index(Request $request){
        $contracts_query = Contract::all();
        

        if($request->apartment_id) {
            $contracts_query->where('apartment_id',$request->apartment_id);
        }

        if($request->resident_id) {
            $contracts_query->where('resident_id',$request->resident_id);
        }

        
        return response()->json($contracts_query);
    }

    public function create(Request $request){
        $validator = Validator::make($request->all(), [
            'resident_id' => 'required',
            'apartment_id' => 'required',
            'expired_at' => 'required'
        ]);

        if($validator->fails()) {
            return response()->json(['error' => $validator->getMessageBag()], 422);
        }

        $apartment = Contract::create($request->all());

        return response()->json(['Message'=> 'Create success', 'data'=>$apartment],200);
    }

    public function update($id, Request $request){
        $contract = Contract::where('id',$id)->first();

        $validator = Validator::make($request->all(), [
            'resident_id' => 'required',
            'apartment_id' => 'required',
            'expired_at' => 'required'
        ]);

        if($validator->fails()) {
            return response()->json(['error' => $validator->getMessageBag()], 422);
        }

        if($contract){
            $contract->update([
               'resident_id' => $request->resident_id,
               'apartment_id' => $request->apartment_id,
               'expired_at' => $request->expired_at
            ]);

            return response()->json(['message'=> 'Update success', 'data'=>$contract],200);
        } else {
            return response()->json(['Not found'], 404);
        }
    }

    public function delete($id) {
        $contract = Contract::where('id',$id)->first();

        if($contract) {
            $contract->delete();
            return response()->json(["Delete success"]);
        } else {
            return response()->json(["Not found"],404);
        } 
    }

}

/**
 * @OA\Get(
 *     summary="Get all contracts",
 *     tags={"Contract"},
 *     path="/api/contract",
 *     @OA\Response(response="200", description="Display a listing of contract.")
 * )
 */

/**
 * @OA\Post(
 *     summary="Add a new contract",
 *     tags={"Contract"},
 *     path="/api/contract/create",
 *     @OA\RequestBody(
 *          @OA\MediaType(
 *              mediaType="multipart/form-data",
 *              @OA\Schema(
 *                  @OA\Property(
 *                      property="resident_id",
 *                      type="integer"
 *                  ),
 *                   @OA\Property(
 *                      property="apartment_id",
 *                      type="integer"
 *                  ),
 *                   @OA\Property(
 *                      property="expired_at",
 *                      type="date"
 *                  ),
 *              ),
 *          )
 *     ),
 * 
 *     @OA\Response(response="200", description="Add a new contract"),
 * )
 */

/**
 * @OA\Put(
 *     summary="Update a contract",
 *     tags={"Contract"},
 *     path="/api/contract/{id}/update",
 *     @OA\RequestBody(
 *          @OA\MediaType(
 *              mediaType="multipart/form-data",
 *              @OA\Schema(
 *                   @OA\Property(
 *                      property="resident_id",
 *                      type="integer"
 *                  ),
 *                   @OA\Property(
 *                      property="apartment_id",
 *                      type="integer"
 *                  ),
 *                   @OA\Property(
 *                      property="expired_at",
 *                      type="date"
 *                  ),
 *              ),
 *          )
 *     ),
 * 
 *     @OA\Parameter(in="path", name="id"),
 * 
 *     @OA\Response(response="200", description="Update a contract"),
 * )
 */
/**
 * @OA\Delete(
 *     summary="Delete a contract",
 *     tags={"Contract"},
 *     path="/api/contract/{id}/delete",
 *     @OA\Response(response="200", description="Delete a contract."),
 *     @OA\Parameter(in="path",name="id")
 * )
 */

