<?php

use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\IngredientController;
use App\Http\Controllers\RecipeController;
use App\Http\Controllers\StockListController;
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

Route::get('/getIngredients', [IngredientController::class, 'index']);
Route::post('/storeIngredient', [IngredientController::class, 'store']);

Route::get('/getCategories', [CategoryController::class, 'index']);

Route::get('/getRecipes', [RecipeController::class, 'index']);
Route::post('/storeRecipe', [RecipeController::class, 'store']);

Route::get('/getStockList', [StockListController::class, 'index']);

Route::post('/addUserIngredients', [UserController::class, 'addIngredients']);
Route::patch('/updateUserIngredient', [UserController::class, 'updateIngredient']);
Route::delete('/deleteUserIngredient', [UserController::class, 'deleteIngredient']);

Route::get('/getAuthenticatedUser', [AuthenticationController::class, 'getAuthenticatedUser']);
Route::post('/authenticateUser', [AuthenticationController::class, 'authenticateUser']);
Route::delete('/logUserOut', [AuthenticationController::class, 'logUserOut']);
