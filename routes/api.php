<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {
    Route::get('/test', function (Request $request) {
        return $request->user();
    })->middleware('auth:sanctum');

    Route::middleware('web')->group(function () {
        Route::post('/login', [AuthController::class, 'login'])
            ->name('login');
    });

    Route::middleware('auth:sanctum')->group(function () {
        Route::post('/logout', [AuthController::class, 'logout']);
        Route::get('/user', [AuthController::class, 'user']);
    });
});
