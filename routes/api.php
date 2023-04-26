<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FlightController;
use App\Http\Controllers\StripeController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\UserController;

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


Route::middleware(['auth:sanctum'])->group(function () {
    Route::middleware(['auth', 'role:admin'])->group(function () {
        Route::post('flights', [FlightController::class, 'store']);
        Route::put('flights/{id}', [FlightController::class, "update"]);
        Route::delete('flights/{id}', [FlightController::class, "destroy"]);
        Route::resource('users', UserController::class)->except([
            'store'
        ]);
        Route::get("users/search/{name}", [UserController::class, "searchForUser"]);
        Route::get("getUserTickets/{id}", [TicketController::class, 'getUserTickets']);
        Route::get("tickets", [TicketController::class, 'index']);
        Route::delete("tickets/{id}", [TicketController::class, 'destroy']);
    });

    Route::middleware(['auth', 'role:passenger'])->group(function () {
        Route::post("tickets", [TicketController::class, 'store']);
        Route::post("/charge", [StripeController::class, "createCharge"]);
        Route::post("/charge/store", [StripeController::class, "store"]);
    });
});


// Flights public routes ;
Route::get('/flights', [FlightController::class, 'index']);
Route::get('flights/{id}', [FlightController::class, 'show']);
Route::get('/flights/{from}/{to}/{date}', [FlightController::class, 'searchByFromToDate']);
Route::get('/flights/date/{date}', [FlightController::class, 'searchByDate']);
Route::post('/sendImage', [TicketController::class, 'sendImageToEmail']);

// Registration Routes : 
Route::post('/register', [AuthController::class, 'register']);
// Authentication endpoints
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

Route::post('/removeSeat', [FlightController::class, 'removeSeat']) ;

