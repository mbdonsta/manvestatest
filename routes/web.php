<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;
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
Route::middleware('auth')->group(function() {
    Route::get('/', [PostController::class, 'index'])->name('posts');

    Route::prefix('post')->group(function() {
        Route::get('/add', [PostController::class, 'add'])->name('post.add');
        Route::post('/store', [PostController::class, 'store'])->name('post.store');
        Route::get('/{post}/edit', [PostController::class, 'edit'])->name('post.edit');
        Route::patch('/{post}/update', [PostController::class, 'update'])->name('post.update');
        Route::get('/{post}/view', [PostController::class, 'view'])->name('post.view');
    });

    Route::post('comment/{post}/store', [CommentController::class, 'store'])->name('comment.store');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
