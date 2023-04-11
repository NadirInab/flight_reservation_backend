<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FlightController;
// use App\Http\Controllers\FlightController;

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
// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::group(['middleware' => 'auth:sanctum'], function () {
    // protected routes here
});

// Registration Routes : 
Route::post('/register', [AuthController::class, 'register']);
// Authentication endpoints
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');



// Flights CRUD ;
Route::get('/flights', [FlightController::class, 'index']);
Route::get('flights/{id}', [FlightController::class, 'show']);
Route::post('flights', [FlightController::class, 'store']);
Route::put('flights/{id}', [FlightController::class, "update"] ) ;
Route::delete('flights/{id}', [FlightController::class, "destroy"] ) ;

Route::get('/flights/{from}/{to}/{date}', [FlightController::class, 'searchByFromToDate']);
Route::get('/flights/date/{date}', [FlightController::class, 'searchByDate']);

Route::get('/flights/price/{price}', [FlightController::class, 'searchByPrice']);
Route::get('/flights/price/cheapest', [FlightController::class, 'cheapestFlights']);

Route::get('/flights/city', [FlightController::class, 'getCity']);

