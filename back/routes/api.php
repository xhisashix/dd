<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostsController;

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

Route::group(
    [
        'middleware' => 'api',
        'prefix' => 'auth',
    ],
    function ($router) {
        Route::post('/login', [AuthController::class, 'login'])->name('login');
        Route::post('/register', [AuthController::class, 'register']);
        Route::post('/logout', [AuthController::class, 'logout']);
        Route::post('/refresh', [AuthController::class, 'refresh']);
        Route::post('/edit', [AuthController::class, 'profileEdit'])->name('edit');
        Route::get('/me', [AuthController::class, 'me']);
    }
);
Route::group(
    [
        'middleware' => 'api',
        'prefix' => 'posts',
    ],
    function ($router) {
        Route::get('/', [PostsController::class, 'getPostData'])->name('posts');
        Route::get('/{id}', [PostsController::class, 'getPostDataById'])->name('post_id');
        Route::post('/create', [PostsController::class, 'addPostData'])->name('posts_create');
        Route::post('/delete', [PostsController::class, 'deletePostDataById'])->name('posts_delete');
        Route::post('/edit', [PostsController::class, 'updatePostDataById'])->name('posts_edit');
    }
);