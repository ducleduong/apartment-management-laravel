<?php

use App\Http\Controllers\ApartmentController;
use App\Http\Controllers\ApartmentAreasController;
use App\Http\Controllers\ResidentController;
use App\Http\Controllers\ContractController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::prefix('apartment')->group(function() {
    Route::get('/', [ApartmentController::class, 'index']);

    Route::get('/{id}', [ApartmentController::class, 'detail']);

    Route::post('/create', [ApartmentController::class, 'create']);

    Route::put('/{id}/update', [ApartmentController::class, 'update']);

    Route::patch('/{id}/change-resident', [ApartmentController::class, 'changeResident']);
});


Route::prefix('apartment-areas')->group(function() {
    Route::get('/', [ApartmentAreasController::class, 'index']);
});


Route::prefix('resident')->group(function() {
    Route::get('/', [ResidentController::class, 'index']);

    Route::get('/{id}', [ResidentController::class, 'detail']);

    Route::post('/create', [ResidentController::class, 'create']);

    Route::put('/{id}/update', [ResidentController::class, 'update']);
});


Route::prefix('contract')->group(function() {
    Route::get('/', [ContractController::class, 'list']);
});