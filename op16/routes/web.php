<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GroceriesController;
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

Route::get("/index", [GroceriesController::class, "index"]);

Route::get("/create", [GroceriesController::class, "create"]);

Route::get("/store", [GroceriesController::class, "store"]);

Route::get("/edit", [GroceriesController::class, "edit"]);

Route::get("/update", [GroceriesController::class, "update"]);

Route::get("/destroy", [GroceriesController::class, "destroy"]);

Route::redirect('/', '/index');