<?php

use App\Http\Controllers\Api\NotificationController;
use App\Http\Controllers\Api\TaskController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\BloggerOrderController;
use App\Http\Controllers\Api\BloggerPlatformController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\PlatformController;
use App\Http\Controllers\Api\UserController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('register', [AuthController::class, 'register']);
Route::post('register/verify', [AuthController::class, 'registerVerify']);
Route::post('login', [AuthController::class, 'login']);

Route::get('category', [UserController::class, 'category']);
Route::get('setting', [UserController::class, 'setting']);
Route::get('platform', [PlatformController::class, 'index']);
Route::get('referral/{token}', [BloggerOrderController::class, 'referral'])->name('referral');

Route::middleware('auth:sanctum')->group(function () {
    Route::get('logout', [AuthController::class, 'logout']);
    Route::get('profile', [UserController::class, 'profile']);
    Route::post('update', [UserController::class, 'update']);

    Route::prefix('notification')->group(function (){
        Route::get('/',[NotificationController::class,'index']);
        Route::post('/',[NotificationController::class,'store']);
        Route::post('read',[NotificationController::class,'read']);
        Route::delete('{notification}',[NotificationController::class,'delete']);
    });
    Route::prefix('order')->group(function () {
        Route::get('/', [OrderController::class, 'index']);
        Route::get('history', [OrderController::class, 'history']);
        Route::get('show/{order}', [OrderController::class, 'show']);
        Route::post('/', [OrderController::class, 'store']);
        Route::post('update/{order}', [OrderController::class, 'update']);
        Route::delete('/{order}', [OrderController::class, 'delete']);
    });
    Route::prefix('task')->group(function () {
        Route::get('/', [TaskController::class, 'index'])->withoutMiddleware('auth:sanctum');
        Route::get('show/{task}', [TaskController::class, 'show'])->withoutMiddleware('auth:sanctum');
        Route::post('perform', [TaskController::class, 'perform']);
    });

    Route::prefix('blogger-platform')->group(function () {
        Route::get('/', [BloggerPlatformController::class, 'index']);
        Route::post('/', [BloggerPlatformController::class, 'store']);
        Route::post('update/{bloggerPlatform}', [BloggerPlatformController::class, 'update']);
        Route::delete('/{bloggerPlatform}', [BloggerPlatformController::class, 'delete']);
    });

    Route::prefix('blogger-order')->group(function () {
        Route::get('/', [BloggerOrderController::class, 'index']);
        Route::get('show/{bloggerOrder}', [BloggerOrderController::class, 'show']);
        Route::post('/', [BloggerOrderController::class, 'store']);
        Route::post('update/{bloggerOrder}', [BloggerOrderController::class, 'update']);
        Route::delete('/', [BloggerOrderController::class, 'delete']);
    });
});
