<?php

use App\Http\Controllers\AuthenticateController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\ResponseController;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\UserController;
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
Route::post("/api/authenticate/authenticateUser", [AuthenticateController::class, "authenticateUser"]);
Route::post("/api/authenticate/logout", [AuthenticateController::class, "logout"]);
Route::get("/api/authenticate/getLoggedInUser", [AuthenticateController::class, "getLoggedInUser"]);
Route::post("/api/authenticate/sendResetPasswordEmail", [AuthenticateController::class, "sendResetPasswordEmail"]);
Route::patch("/api/authenticate/updatePassword", [AuthenticateController::class, "updatePassword"]);
Route::get("/api/tickets/index", [TicketController::class, "index"]);
Route::post("/api/tickets/store", [TicketController::class, "store"]);
Route::patch("/api/tickets/update/{ticket}", [TicketController::class, "update"]);
Route::patch("/api/tickets/updateAppointedTo/{ticket}", [TicketController::class, "updateAppointedTo"]);
Route::patch("/api/tickets/updateStatus/{ticket}", [TicketController::class, "updateStatus"]);
Route::get("/api/categories/index", [CategoryController::class, "index"]);
Route::post("/api/categories/store",[CategoryController::class, "store"]);
Route::patch("/api/categories/update/{category}", [CategoryController::class, "update"]);
Route::delete("/api/categories/delete/{category}", [CategoryController::class, "delete"]);
Route::get("/api/users/index", [UserController::class, "index"]);
Route::patch("/api/users/update/{user}", [UserController::class, "update"]);
Route::delete("/api/users/delete/{user}", [UserController::class, "delete"]);
Route::post("/api/users/create", [UserController::class, "store"]);
// Route::get("/api/responses/index", [ResponseController::class, "index"]);
Route::get("/api/responses/index/{tickets}", [ResponseController::class, "index"]);
Route::post("/api/responses/store/{ticket}", [ResponseController::class, "store"]);
Route::patch("/api/responses/update/{response}", [ResponseController::class, "update"]);
Route::get("/api/statuses/index", [StatusController::class, "index"]);
Route::get("/api/notes/index", [NoteController::class, "index"]);
Route::post("/api/notes/store", [NoteController::class, "store"]);