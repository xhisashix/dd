<?php

use App\Http\Controllers\RegisterController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

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


Route::group(['middleware' => 'api'], function () {
    Route::get('test', [AuthController::class, 'index']);
    Route::get('register', [AuthController::class, 'register']);
    // 認証が必要ないメソッド
    Route::group(['middleware' => ['jwt.auth']], function () {
        // 認証が必要なメソッド
    });
});
