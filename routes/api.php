<?php

use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\PostController;
use Illuminate\Http\Request;
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

Route::post('/login', [LoginController::class, 'postLogin']);
Route::middleware('auth:sanctum')->group(function() {
    Route::get('/get_posts', [PostController::class, 'index']);
    Route::get('/get_post/{post}', [PostController::class, 'getPost']);
    Route::get('/get_posts/{user}', [PostController::class, 'getPostsByUser']);
});

