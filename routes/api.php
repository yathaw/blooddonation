<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\DonorController;
use App\Http\Controllers\Api\InventoryController;
use App\Http\Controllers\Api\LoginController;


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



Route::post('login',[LoginController::class,'login']);

Route::group(['middleware' => 'check:api'], function() {

	Route::apiResource('donors', DonorController::class);
	Route::apiResource('donations', InventoryController::class);

	Route::get('ongoingdonors',[InventoryController::class,'ongoingdonors']);

	Route::get('logout',[LoginController::class,'logout']);

	Route::get('user',[LoginController::class,'authuser']);


});


