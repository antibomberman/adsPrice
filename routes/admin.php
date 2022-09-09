<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\BalanceOperationController;
use App\Http\Controllers\Admin\BloggerPlatformController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\PlatformController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;

Route::post('login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('logout', [AuthController::class, 'logout']);

    Route::prefix('category')->group(function () {
        Route::get('/', [CategoryController::class, 'index']);
        Route::post('/', [CategoryController::class, 'store']);
        Route::post('update/{category}', [CategoryController::class, 'update']);
        Route::delete('/{category}', [CategoryController::class, 'delete']);
    });
    Route::prefix('platform')->group(function () {
        Route::get('/', [PlatformController::class, 'index']);
        Route::post('/', [PlatformController::class, 'store']);
        Route::post('update/{platform}', [PlatformController::class, 'update']);
        Route::delete('/{platform}', [PlatformController::class, 'delete']);
    });
    Route::prefix('order')->group(function () {
        Route::get('/', [OrderController::class, 'index']);
        Route::get('show/{order}', [OrderController::class, 'show']);
        Route::post('/', [OrderController::class, 'store']);
        Route::post('update/{category}', [OrderController::class, 'update']);
        Route::delete('/{category}', [OrderController::class, 'delete']);
    });
    Route::prefix('user')->group(function () {
        Route::get('/', [UserController::class, 'index']);
        Route::get('show/{user}', [UserController::class, 'show']);
        Route::post('/', [UserController::class, 'store']);
        Route::post('update/{user}', [UserController::class, 'update']);
        Route::delete('/{user}', [UserController::class, 'delete']);
    });
    Route::prefix('blogger-platform')->group(function () {
        Route::get('/', [BloggerPlatformController::class, 'index']);
        Route::get('show/{bloggerPlatform}', [BloggerPlatformController::class, 'show']);
        Route::post('/', [BloggerPlatformController::class, 'store']);
        Route::post('update/{bloggerPlatform}', [BloggerPlatformController::class, 'update']);
        Route::delete('/{bloggerPlatform}', [BloggerPlatformController::class, 'delete']);
    });
    Route::prefix('balance-operation')->group(function () {
        Route::get('/', [BalanceOperationController::class, 'index']);
        Route::post('plus', [BalanceOperationController::class, 'plus']);
        Route::post('minus', [BalanceOperationController::class, 'minus']);
    });

    Route::prefix('setting')->group(function () {
        Route::get('/', [SettingController::class, 'index']);
        Route::post('/', [SettingController::class, 'update']);
    });
});
