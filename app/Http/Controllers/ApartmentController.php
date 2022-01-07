<?php

namespace App\Http\Controllers;

use App\Models\Apartment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class ApartmentController extends Controller
{
    public function index(Request $request) {
        $apartment_query = Apartment::with(['apartment_areas']);
        
        if($request->apartment_areas) {
            $apartment_query->WhereHas('apartment_areas', function($query) use($request){
                $query->where('name',$request->apartment_areas);
            });
        }


        if($request->id) {
            $apartment_query->where('id', $request->id);
        }

        if($request->sortBy && in_array($request->sortBy, ['area','price','rooms'])){
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
        
        $apartments = $apartment_query->orderBy($sortBy,$sortOrder)->paginate($limit);
        $apartments->load('apartment_areas:id,name');


        return response()->json($apartments);
    }


    public function detail($id) {
        $apartment = Apartment::with('apartment_areas')->where('id',$id)->first();

        if($apartment == []) return response()->json(['Not found'], 404);
        else return  response()->json($apartment);
    }


    public function create(Request $request){
        $validator = Validator::make($request->all(), [
            'id' => 'required',
            'area' => 'required',
            'rooms' => 'required',
            'apartment_areas_id' => 'required',
        ]);

        if($validator->fails()) {
            return response()->json(['error' => $validator->getMessageBag()], 422);
        }

        $apartment = Apartment::create($request->all());

        return response()->json(['message'=> 'success', 'data'=>$apartment],200);
    }

    
    public function update($id, Request $request){
        $apartment = Apartment::with(['apartment_areas'])->where('id',$id)->first();

        if($apartment){
            $validator = Validator::make($request->all(), [
                'area' => 'required',
                'rooms' => 'required',
                'price' => 'required',
            ]);
    
            if($validator->fails()) {
                return response()->json(['error' => $validator->getMessageBag(), 'req'=>$request->all()], 422);
            }

            $apartment->update([
                'price' => $request->price,
                'rooms' => $request->rooms,
                'area' => $request->area,
            ]);

            return response()->json(['message'=> 'success', 'data'=>$apartment],200);
        } else {
            return response()->json(['Not found'], 404);
        }
    }

    public function delete($id) {
        $apartment = Apartment::where('id',$id)->first();

        if($apartment) {
            $apartment->delete();
            return response()->json(["Delete success"]);
        } else {
            return response()->json(["Not found"],404);
        }

    }
}


/**
 * @OA\Get(
 *     summary="Get all apartments",
 *     tags={"Apartment"},
 *     path="/api/apartment",
 *     @OA\Parameter(in="path",name="apartment_areas"),
 *     @OA\Parameter(in="path",name="sortBy"),
 *     @OA\Parameter(in="path",name="sortOrder"),
 *     @OA\Response(response="200", description="Display a listing of apartment.")
 * )
 */

 /**
 * @OA\Get(
 *     summary="Get a detail apartment",
 *     tags={"Apartment"},
 *     path="/api/apartment/{id}",
 *     @OA\Response(response="200", description="Display a apartment."),
 *     @OA\Parameter(in="path",name="id")
 * )
 */

/**
 * @OA\Post(
 *     summary="Add a new apartment",
 *     tags={"Apartment"},
 *     path="/api/apartment/create",
 *     @OA\RequestBody(
 *          @OA\MediaType(
 *              mediaType="multipart/form-data",
 *              @OA\Schema(
 *                  @OA\Property(
 *                      property="id",
 *                      type="integer"
 *                  ),
 *                   @OA\Property(
 *                      property="area",
 *                      type="float"
 *                  ),
 *                   @OA\Property(
 *                      property="price",
 *                      type="float"
 *                  ),
 *                   @OA\Property(
 *                      property="rooms",
 *                      type="integer"
 *                  ),
 *                   @OA\Property(
 *                      property="apartment_areas_id",
 *                      type="integer"
 *                  ),
 *              ),
 *          )
 *     ),
 * 
 *     @OA\Response(response="200", description="Add a new apartment"),
 * )
 */

/**
 * @OA\Put(
 *     summary="Update a apartment",
 *     tags={"Apartment"},
 *     path="/api/apartment/{id}/update",
 *     @OA\RequestBody(
 *          @OA\MediaType(
 *              mediaType="multipart/form-data",
 *              @OA\Schema(
 *                   @OA\Property(
 *                      property="area",
 *                      type="float"
 *                  ),
 *                   @OA\Property(
 *                      property="price",
 *                      type="float"
 *                  ),
 *                   @OA\Property(
 *                      property="rooms",
 *                      type="integer"
 *                  ),
 *              ),
 *          )
 *     ),
 * 
 *     @OA\Parameter(in="path", name="id"),
 * 
 *     @OA\Response(response="200", description="Update a apartment"),
 * )
 */
/**
 * @OA\Delete(
 *     summary="Delete a apartment",
 *     tags={"Apartment"},
 *     path="/api/apartment/{id}/delete",
 *     @OA\Response(response="200", description="Display a apartment."),
 *     @OA\Parameter(in="path",name="id")
 * )
 */
