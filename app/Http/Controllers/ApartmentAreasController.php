<?php

namespace App\Http\Controllers;

use App\Models\ApartmentAreas;
use Illuminate\Http\Request;

class ApartmentAreasController extends Controller
{
    public function index() {
        $data = (object) array('count' => ApartmentAreas::count(), 'data' => ApartmentAreas::all());
        return response()->json($data);
    }
}
