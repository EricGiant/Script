<?php

use App\Http\Controllers\AuthenticateController;
use App\Http\Controllers\TicketController;
use Illuminate\Support\Facades\Route;

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

//normal route
Route::get('/', function () {
    return view('app');
});

//API
Route::post("/api/authenticateUser", [AuthenticateController::class, "authenticateUser"]);
Route::post("/api/logout", [AuthenticateController::class, "logout"]);
Route::get("/api/getTickets", [TicketController::class, "getTickets"]);

//capture route
Route::get('{any}', function () {
    return view('app');
})->where('any','.*');