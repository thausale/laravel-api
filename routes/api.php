<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get(
    "/blog-posts",
    [BlogController::class, 'index']
);

Route::post('/blog-posts', [BlogController::class, 'postBlog']);


Route::get("/blog-posts/{id}", function () {
    return "hello world";
});
Route::delete("/blog-posts/{id}", [BlogController::class, 'removePost']);

Route::patch("/blog-posts/{id}", [BlogController::class, 'publishPost']);
