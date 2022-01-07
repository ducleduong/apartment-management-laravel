<?php

namespace App\Http\Controllers;

use App\Models\Resident;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ResidentController extends Controller
{
    public function index(Request $request){
        $resident_query = Resident::with([]);

        if($request->last_name) {
            $resident_query->where('last_name', $request->last_name);
        }

        if($request->country) {
            $resident_query->where('country', $request->country);
        }

        if($request->sortBy && in_array($request->sortBy, ['last_name','country','gender'])){
            $sortBy = $request->sortBy;
        } else {
            $sortBy = 'id';
        }

        if($request->sortOrder && in_array($request->sortOrder, ['asc','desc'])){
            $sortOrder = $request->sortOrder;
        } else {
            $sortOrder = 'asc';
        }

        if($request->limit) {
            $limit = $request->limit;
        } else {
            $limit = 10;
        }
        
        $residents = $resident_query->orderBy($sortBy,$sortOrder)->paginate($limit);


        return response()->json($residents);
    }

    public function detail($id) {
        $resident = Resident::withCount('contracts')->with('contracts')->where('id',$id)->first();

        if($resident) {
            return response()->json($resident);
        }
        else {
            return response()->json(['Not found'], 404);
        }
    }

    public function create(Request $request){
        $validator = Validator::make($request->all(), [
            'first_name' => 'required',
            'last_name' => 'required',
            'birthday' => 'required',
            'gender' => 'required',
            'phone_number' => 'required',
            'identity_card_number' => 'required',
            'country' => 'required'
        ]);

        if($validator->fails()) {
            return response()->json(['error' => $validator->getMessageBag()], 422);
        }

        $resident = resident::create($request->all());

        return response()->json(['message'=> 'success', 'data'=>$resident],200);
    }

    public function update($id, Request $request){
        $resident = Resident::where('id',$id)->first();

        if($resident){
            $resident->update($request->all());

            return response()->json(['message'=> 'Create success', 'data'=>$resident],200);
        } else {
            return response()->json(['Not found'], 404);
        }
    }

    public function delete($id) {
        $resident = Resident::where('id',$id)->first();

        if($resident) {
            $resident->delete();
            return response()->json(["Delete success"]);
        } else {
            return response()->json(["Not found"],404);
        } 
    }
}


/**
 * @OA\Get(
 *     summary="Get all residents",
 *     tags={"Resident"},
 *     path="/api/resident",
 *     @OA\Response(response="200", description="Display a listing of resident.")
 * )
 */

 /**
 * @OA\Get(
 *     summary="Get a detail resident",
 *     tags={"Resident"},
 *     path="/api/resident/{id}",
 *     @OA\Response(response="200", description="Display a resident."),
 *     @OA\Parameter(in="path",name="id")
 * )
 */

/**
 * @OA\Post(
 *     summary="Add a new resident",
 *     tags={"Resident"},
 *     path="/api/resident/create",
 *     @OA\RequestBody(
 *          @OA\MediaType(
 *              mediaType="multipart/form-data",
 *              @OA\Schema(
 *                  @OA\Property(
 *                      property="first_name",
 *                      type="string"
 *                  ),
 *                   @OA\Property(
 *                      property="last_name",
 *                      type="string"
 *                  ),
 *                   @OA\Property(
 *                      property="birthday",
 *                      type="date"
 *                  ),
 *                   @OA\Property(
 *                      property="phone_number",
 *                      type="string"
 *                  ),
 *                  @OA\Property(
 *                      property="identity_card_number",
 *                      type="string"
 *                  ),
 *                  @OA\Property(
 *                      property="country",
 *                      type="string"
 *                  ),
 *                  @OA\Property(
 *                      property="gender",
 *                      type="string"
 *                  ),
 *              ),
 *          )
 *     ),
 * 
 *     @OA\Response(response="200", description="Add a new resident"),
 * )
 */

/**
 * @OA\Put(
 *     summary="Update a resident",
 *     tags={"Resident"},
 *     path="/api/resident/{id}/update",
 *     @OA\RequestBody(
 *          @OA\MediaType(
 *              mediaType="application/json",
 *              @OA\Schema(
 *                   @OA\Property(
 *                      property="first_name",
 *                      type="string"
 *                  ),
 *                   @OA\Property(
 *                      property="last_name",
 *                      type="string"
 *                  ),
 *                   @OA\Property(
 *                      property="birthday",
 *                      type="date"
 *                  ),
 *                   @OA\Property(
 *                      property="phone_number",
 *                      type="string"
 *                  ),
 *                  @OA\Property(
 *                      property="identity_card_number",
 *                      type="string"
 *                  ),
 *                  @OA\Property(
 *                      property="country",
 *                      type="string"
 *                  ),
 *                  @OA\Property(
 *                      property="gender",
 *                      type="string"
 *                  ),
 *              ),
 *          )
 *     ),
 * 
 *     @OA\Parameter(in="path", name="id"),
 * 
 *     @OA\Response(response="200", description="Update a resident"),
 * )
 */
/**
 * @OA\Delete(
 *     summary="Delete a resident",
 *     tags={"Resident"},
 *     path="/api/resident/{id}/delete",
 *     @OA\Response(response="200", description="Delete a resident."),
 *     @OA\Parameter(in="path",name="id")
 * )
 */
