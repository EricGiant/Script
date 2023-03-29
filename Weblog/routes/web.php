<?php

use App\Http\Controllers\ArticalController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Models\Artical;
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

Route::redirect("/", "articalIndex");

Route::get("/articalIndex", [ArticalController::class ,"index"]);
Route::get("/articalCreate", [ArticalController::class, "create"]);
Route::get("/articalStore", [ArticalController::class, "store"]);
Route::get("/articalShow/{artical}", [ArticalController::class, "show"]) -> whereNumber("artical");
Route::get("/articalEdit/{artical}", [ArticalController::class, "edit"]) -> whereNumber("artical");
Route::get("/articalUpdate", [ArticalController::class, "update"]);
Route::get("/articalDestory", [ArticalController::class, "destroy"]);
Route::get("/articalStoreCategory", [ArticalController::class, "storeCategory"]);

Route::get("/userIndex", [UserController::class, "index"]);
Route::get("/userCreate", [UserController::class, "create"]);
Route::post("/userStore", [UserController::class, "store"]);
Route::post("/userShow", [UserController::class, "show"]);
Route::get("/userDestroy", [UserController::class, "destroy"]);

Route::get("/profileIndex", [ProfileController::class, "index"]);
Route::get("/profileEdit", [ProfileController::class, "edit"]);



//TODO
//rework the controller structure aka make a controller for AUTH that does the loging in/loging out so it's not in the user controller
//make controller for categories so it's not in the artical controller