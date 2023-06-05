<?php

use App\Http\Controllers\BidController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\PasswordController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Redirect;
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
Route::redirect("/", "/post");

//LOGIN ROUTES
Route::get("/login", [LoginController::class, "index"]);
Route::post("/login/show", [LoginController::class, "show"]);
Route::get("/login/create", [LoginController::class, "create"]);
Route::get("/login/edit", [LoginController::class, "edit"]);
Route::post("/login/update", [LoginController::class, "update"]);
Route::post("/login/store", [LoginController::class, "store"]);
Route::get("/login/destroy", [LoginController::class, "destroy"]);

//PASSWORD ROUTES
Route::get("/password/edit/{token}", [PasswordController::class, "edit"]);
Route::post('/password/update', [PasswordController::class, "update"]);

//POST ROUTES
Route::get("/post", [PostController::class, "index"]);
Route::get("/post/create", [PostController::class, "create"]) -> middleware("isLoggedIn");
Route::get("/post/editPage", [PostController::class, "editPage"]) -> middleware("isLoggedIn");
Route::post("/post/destroy/{post}", [PostController::class, "destroy"]);
Route::get("/post/edit/{post}", [PostController::class, "edit"]);
Route::post("/post/update/{post}", [PostController::class, "update"]);
Route::post("/post/store", [PostController::class, "store"]);
Route::get("/post/{post}", [PostController::class, "show"]);

//BID ROUTES
Route::post("/bid/store", [BidController::class, "store"]);
Route::get("/bid/edit", [BidController::class, "edit"]);
Route::post("/bid/update/{bid}", [BidController::class, "update"]);
Route::post("/bid/destroy/{bid}", [BidController::class, "destroy"]);

//CHAT ROUTES
Route::get("/chat", [ChatController::class, "index"]) -> middleware("isLoggedIn");
Route::post("/chat/store", [ChatController::class, "store"]);
Route::get("/chat/{chat}", [ChatController::class, "show"]);
Route::post("/chat/{chat}", [ChatController::class, "show"]);

//MESSAGE ROUTES
Route::post("/message/store", [MessageController::class, "store"]);

//BUG: if the poster of a post checks there own page they can bid on there own post


// zoek naar: "laravel paginator" en bestudeer de uitleg en voorbeelden op de officiele laravel documentatie website