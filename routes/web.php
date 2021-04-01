<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DonorController;
use App\Http\Controllers\InventoryController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return Inertia::render('Welcome', [
//         'canLogin' => Route::has('login'),
//         'canRegister' => Route::has('register'),
//         'laravelVersion' => Application::VERSION,
//         'phpVersion' => PHP_VERSION,
//     ]);
// });

Route::get('/',[LoginController::class,'showLoginForm']);
Route::post('login',[LoginController::class,'login']);

// Route::group(['middleware' => 'role:Admin'], function(){

	Route::get('home',[FrontendController::class,'index'])->name('home');
	Route::get('ongoingdonors',[InventoryController::class,'ongoingdonors'])->name('ongoingdonors');
	Route::get('/getOngoingdonations',[InventoryController::class, 'getOngoingdonations'])->name('getOngoingdonations');
	Route::post('/ongoingdonors/donatenow/{id}',[InventoryController::class, 'donatenow'])->name('ongoingdonors.donatenow');


	Route::resource('/donors', DonorController::class);
	Route::get('/getlistABDonors',[DonorController::class, 'getlistABData'])->name('getlistABDonors');
	Route::get('/getlistODonors',[DonorController::class, 'getlistOData'])->name('getlistODonors');
	Route::get('/getlistADonors',[DonorController::class, 'getlistAData'])->name('getlistADonors');
	Route::get('/getlistBDonors',[DonorController::class, 'getlistBData'])->name('getlistBDonors');

	Route::resource('/donations', InventoryController::class);
	Route::post('/getDonations_bydate',[InventoryController::class, 'getDonations_bydate'])->name('getDonations_bydate');

	Route::get('/getDonors',[DonorController::class, 'getlistData'])->name('getDonors');



	Route::post('/donors/update/{id}',[DonorController::class, 'update'])->name('donors.update');
// }s);

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->name('dashboard');
