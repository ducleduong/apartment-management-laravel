<?php

namespace App\Http\Controllers;

use App\Models\ApartmentAreas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ApartmentAreasController extends Controller
{
    public function index() {
        $apartment_areas = ApartmentAreas::all();
        
        return response()->json($apartment_areas);
    }

    public function detail($id) {
        $apartment_area = ApartmentAreas::withCount('apartments')->with('apartments')->where('id',$id)->first();

        if(!$apartment_area) return response()->json(['Not found'], 404);
        else return  response()->json($apartment_area);
    }

    public function create(Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'floors' => 'required',
            'address' => 'required',
        ]);

        if($validator->fails()) {
            return response()->json(['error' => $validator->getMessageBag()], 422);
        }

        $apartment_area = ApartmentAreas::create($request->all());

        return response()->json(['message'=> 'Create success', 'data'=>$apartment_area],200);
    }

    public function update($id, Request $request) {
        $apartment_area = ApartmentAreas::where('id',$id)->first();

        if($apartment_area){
            $apartment_area->update($request->all());

            return response()->json(['message'=> 'success', 'data'=>$apartment_area],200);
        } else {
            return response()->json(['Not found'], 404);
        }
    }

    public function delete($id) {
        $apartment_area = ApartmentAreas::where('id',$id)->first();

        if($apartment_area) {
            $apartment_area->delete();
            return response()->json(["Delete success"]);
        } else {
            return response()->json(["Not found"],404);
        } 
    }
}

/**
 * @OA\Get(
 *     summary="Get all apartment areas",
 *     tags={"ApartmentAreas"},
 *     path="/api/apartment-areas",
 *     @OA\Response(response="200", description="Display a listing of apartment areas.")
 * )
 */

 /**
 * @OA\Get(
 *     summary="Get a detail apartment-areas",
 *     tags={"ApartmentAreas"},
 *     path="/api/apartment-areas/{id}",
 *     @OA\Response(response="200", description="Display a apartment areas."),
 *     @OA\Parameter(in="path",name="id")
 * )
 */

/**
 * @OA\Post(
 *     summary="Add a new apartment areas",
 *     tags={"ApartmentAreas"},
 *     path="/api/apartment-areas/create",
 *     @OA\RequestBody(
 *          @OA\MediaType(
 *              mediaType="multipart/form-data",
 *              @OA\Schema(
 *                  @OA\Property(
 *                      property="name",
 *                      type="string"
 *                  ),
 *                   @OA\Property(
 *                      property="floors",
 *                      type="integer"
 *                  ),
 *                   @OA\Property(
 *                      property="address",
 *                      type="string"
 *                  ),
 *              ),
 *          )
 *     ),
 * 
 *     @OA\Response(response="200", description="Add a new apartment areas"),
 * )
 */

/**
 * @OA\Put(
 *     summary="Update a apartment-areas",
 *     tags={"ApartmentAreas"},
 *     path="/api/apartment-areas/{id}/update",
 *     @OA\RequestBody(
 *          @OA\MediaType(
 *              mediaType="application/json",
 *              @OA\Schema(
 *                   @OA\Property(
 *                      property="name",
 *                      type="string"
 *                  ),
 *                   @OA\Property(
 *                      property="floors",
 *                      type="integer"
 *                  ),
 *                   @OA\Property(
 *                      property="address",
 *                      type="string"
 *                  ), 
 *              ),
 *          )
 *     ),
 * 
 *     @OA\Parameter(in="path", name="id"),
 * 
 *     @OA\Response(response="200", description="Update a apartment areas"),
 * )
 */
/**
 * @OA\Delete(
 *     summary="Delete a apartment-areas",
 *     tags={"ApartmentAreas"},
 *     path="/api/apartment-areas/{id}/delete",
 *     @OA\Response(response="200", description="Delete a apartment areas."),
 *     @OA\Parameter(in="path",name="id")
 * )
 */


