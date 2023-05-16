<?php

use App\Http\Controllers\ArticalController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\Premium;
use App\Models\Artical;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MailController;

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

Route::redirect("/", "artical");

//ARTICAL ROUTES
Route::get("/artical", [ArticalController::class, "index"]);
Route::get("/artical/create", [ArticalController::class, "create"]) -> middleware("isLoggedIn");
Route::post("/artical", [ArticalController::class, "store"]);
Route::get("artical/{artical}", [ArticalController::class, "show"]) -> middleware("premium");
Route::get("/artical/edit/{artical}", [ArticalController::class, "edit"]);
Route::post("/artical/update/{artical}", [ArticalController::class, "update"]);
Route::post("/artical/destroy/{artical}", [ArticalController::class, "destroy"]);
    

//CATEGORY ROUTES
Route::post("/category", [CategoryController::class, "store"]);

//COMMENT ROUTES
Route::post("/comment", [CommentController::class, "store"]) -> middleware("isLoggedIn");
Route::post("/comment/update/{comment}", [CommentController::class, "update"]);
Route::post("/comment/destroy/{comment}", [CommentController::class, "destroy"]);

//PROFILE ROUTES
Route::get("/profile", [ProfileController::class, "index"]);
Route::get("/profile/edit", [ProfileController::class, "edit"]);
Route::get("/profile/update", [ProfileController::class, "update"]);

//USER ROUTES
Route::get("/user", [UserController::class, "index"]);
Route::get("/user/create", [UserController::class, "create"]);
Route::post("/user", [UserController::class, "store"]);
Route::post("/user/show", [UserController::class, "show"]);
Route::get("/user/destroy", [UserController::class, "destroy"]);