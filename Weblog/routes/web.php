<?php

use App\Http\Controllers\ArticalController;
use App\Http\Controllers\CategoryController;
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

// TODO: pas route::resource toe voor compactere code met consistende namen / url's: /articalIndex moet "/articles" worden. Dit gaat automatisch goed als je route:resource gebruikt.
Route::get("/articalIndex", [ArticalController::class ,"index"]);
Route::get("/articalCreate", [ArticalController::class, "create"]);
Route::post("/articalStore", [ArticalController::class, "store"]);
Route::get("/articalShow/{artical}", [ArticalController::class, "show"]) -> whereNumber("artical");
Route::get("/articalEdit/{artical}", [ArticalController::class, "edit"]) -> whereNumber("artical");
Route::post("/articalUpdate/{artical}", [ArticalController::class, "update"]) -> whereNumber("artical");
Route::get("/articalDestroy", [ArticalController::class, "destroy"]);

Route::get("/categoryStore", [CategoryController::class, "store"]);

Route::get("/userIndex", [UserController::class, "index"]);
Route::get("/userCreate", [UserController::class, "create"]);
Route::post("/userStore", [UserController::class, "store"]);
Route::post("/userShow", [UserController::class, "show"]);
Route::get("/userDestroy", [UserController::class, "destroy"]);

Route::get("/profileIndex", [ProfileController::class, "index"]);
Route::get("/profileEdit", [ProfileController::class, "edit"]);
Route::get("/profileUpdate", [ProfileController::class, "update"]);