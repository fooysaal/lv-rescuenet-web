<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserInfoController;
use App\Http\Controllers\Api\DashboardController;
use App\Http\Controllers\Api\RegistrationController;
use App\Http\Controllers\Api\AuthenticationController;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::get('/test', function () {
    return response()->json(['message' => 'API is working']);
});

Route::prefix('v1')->group(function () {
    // Multi-step registration routes (public)
    Route::controller(RegistrationController::class)->prefix('register')->group(function () {
        Route::post('/step1', 'step1');
        Route::post('/step2', 'step2');
        Route::post('/step3', 'step3');
        Route::post('/skip-step2', 'skipStep2');
        Route::get('/status', 'getRegistrationStatus');
    });

    // Legacy authentication routes
    Route::controller(AuthenticationController::class)->group(function () {
        Route::post('/login', 'login');
        // Route::post('/register', 'register');
        Route::post('/logout', 'logout')->middleware('auth:sanctum');
    });

    Route::middleware('auth:sanctum')->group(function () {
        Route::controller(UserInfoController::class)->group(function () {
            Route::get('/profile', 'profile');
            Route::put('/profile', 'updateProfile');
            Route::put('/update-password', 'updatePassword');
        });
        // User dashboard route
        Route::get('/dashboard', DashboardController::class);
    });

});
