<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\MessageController;
use App\Http\Controllers\Api\TopicController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\RegisterController;
use App\Models\User;

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


Route::post('register', [RegisterController::class, 'register']);
Route::post('login', [LoginController::class, 'login']);

Route::get('topic', [TopicController::class, 'index']);
Route::get('category', [CategoryController::class, 'index']);
Route::get('topic/{topic}', [TopicController::class, 'show']);



Route::middleware('auth:sanctum')->group(function() {

    Route::post('logout', [LoginController::class, 'logout']);

    //Message
    Route::controller(MessageController::class)->group(function() {
        Route::post('topic/{id}/message', 'store');
        Route::put('topic/{id}/message/{comm}', 'update');
        Route::delete('topic/{id}/message/{comm}', 'destroy');
    });

});


Route::middleware('auth:sanctum', 'isAdmin')->prefix('/admin')->group(function() {
    
    Route::controller(TopicController::class)->group(function() {
        Route::post('topic', 'store');
        Route::put('topic/{topic}', 'update');
        Route::delete('topic/{topic}', 'destroy');
    });

    //category
    Route::controller(CategoryController::class)->group(function() {
        Route::post('category', 'store');
        Route::put('category/{category}', 'update');
        Route::delete('category/{category}', 'destroy');
    });

    
});








