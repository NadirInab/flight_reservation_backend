<?php

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


// Flights CRUD ;
Route::get('flights', [FlightController::class, 'index']);
Route::get('flights/{id}', [FlightController::class, 'show']);
Route::post('flights', [FlightController::class, 'store']);
Route::put('flights/{id}', [FlightController::class, "update"] ) ;
Route::delete('flights/{id}', [FlightController::class, "destroy"] ) ;


Route::get('/flights/from/{from}/to/{to}', [FlightController::class, 'searchByFromTo']);

Route::get('/flights/date/{date}', [FlightController::class, 'searchByDate']);

Route::get('/flights/price/cheapest', [FlightController::class, 'cheapestFlights']);

Route::get('/flights/airport/{airport}', [FlightController::class, 'getByAirport']);