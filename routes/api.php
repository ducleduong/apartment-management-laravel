<?php

use App\Http\Controllers\ApartmentController;
use App\Http\Controllers\ApartmentAreasController;
use App\Http\Controllers\AuthController;
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


Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::prefix('apartment')->group(function() {
        Route::get('/', [ApartmentController::class, 'index']);
    
        Route::get('/{id}', [ApartmentController::class, 'detail']);
    
        Route::post('/create', [ApartmentController::class, 'create'])->middleware('role:admin|manager');
    
        Route::put('/{id}/update', [ApartmentController::class, 'update']);
    
        Route::delete('/{id}/delete', [ApartmentController::class, 'delete'])->middleware('role:admin|manager');
    });
});


Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::prefix('apartment-areas')->group(function() {
        Route::get('/', [ApartmentAreasController::class, 'index']);
    
        Route::get('/{id}', [ApartmentAreasController::class, 'detail']);
    
        Route::post('/create', [ApartmentAreasController::class, 'create'])->middleware('role:admin,manager');
    
        Route::put('/{id}/update', [ApartmentAreasController::class, 'update']);
    
        Route::delete('/{id}/delete', [ApartmentAreasController::class, 'delete'])->middleware('role:admin,manager');
    
    });
});


Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::prefix('resident')->group(function() {
        Route::get('/', [ResidentController::class, 'index']);
    
        Route::get('/{id}', [ResidentController::class, 'detail']);
    
        Route::post('/create', [ResidentController::class, 'create']);
    
        Route::put('/{id}/update', [ResidentController::class, 'update']);
    
        Route::delete('/{id}/delete', [ResidentController::class, 'delete']);
    });
});


Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::prefix('contract')->group(function() {
        Route::get('/', [ContractController::class, 'index']);
    
        Route::post('/create', [ContractController::class, 'create']);
    
        Route::put('/{id}/update', [ContractController::class, 'update']);
    
        Route::delete('/{id}/delete', [ContractController::class, 'delete']);
    });
});


Route::prefix('auth')->group(function() {
    Route::post('/register', [AuthController::class, 'register'])->middleware('role:admin');

    Route::post('/login', [AuthController::class, 'login']);
});