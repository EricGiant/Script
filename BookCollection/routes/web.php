<?php

use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\ReviewController;
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
Route::get("/api/getBooks", [BookController::class, "getBooks"]);
Route::post("/api/addBook", [BookController::class, "addBook"]);
Route::patch("/api/updateBook/{book}", [BookController::class, "updateBook"]);
Route::delete("/api/deleteBook/{book}", [BookController::class, "deleteBook"]);
Route::get("/api/getAuthors", [AuthorController::class, "getAuthors"]);
Route::post("/api/addAuthor", [AuthorController::class, "addAuthor"]);
Route::patch("/api/updateAuthor/{author}", [AuthorController::class, "updateAuthor"]);
Route::delete("/api/deleteAuthor/{author}", [AuthorController::class, "deleteAuthor"]);
Route::get("/api/getReviews", [ReviewController::class, "getReviews"]);
Route::post("/api/addReview", [ReviewController::class, "addReview"]);
Route::patch("/api/updateReview/{review}", [ReviewController::class, "updateReview"]);
Route::delete("/api/deleteReview/{review}", [ReviewController::class, "deleteReview"]);

//capture route
Route::get('{any}', function () {
    return view('app');
})->where('any','.*');