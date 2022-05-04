<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\CategoryController;

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
        Route::get('/published/{status}', [PostsController::class, 'getPostDataByStatus'])->name('posts_published');
        Route::get('/user_id/{user_id}', [PostsController::class, 'getPostDataByUserId'])->name('posts_user_id');
        Route::post('/create', [PostsController::class, 'addPostData'])->name('posts_create');
        Route::post('/delete', [PostsController::class, 'deletePostDataById'])->name('posts_delete');
        Route::post('/edit', [PostsController::class, 'updatePostDataById'])->name('posts_edit');
    }
);
Route::group(
    [
        'middleware' => 'api',
        'prefix' => 'categories',
    ],
    function ($router) {
        Route::get('/', [CategoryController::class, 'getCategoryData'])->name('categories');
        Route::get('/{id}', [CategoryController::class, 'getCategory'])->name('category_id');
        Route::get('/user_id/{user_id}', [CategoryController::class, 'getUserCategory'])->name('categories_user_id');
        Route::post('/create', [CategoryController::class, 'addCategoryData'])->name('categories_create');
        Route::post('/delete', [CategoryController::class, 'deleteCategoryDataById'])->name('categories_delete');
        Route::post('/edit', [CategoryController::class, 'edit'])->name('categories_edit');
    }
);