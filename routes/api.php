<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserInfoController;
use App\Http\Controllers\Api\DashboardController;
use App\Http\Controllers\Api\DeviceTokenController;
use App\Http\Controllers\Api\MoreServiceController;
use App\Http\Controllers\Api\HelpRequestsController;
use App\Http\Controllers\Api\NotificationController;
use App\Http\Controllers\Api\RegistrationController;
use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\UserRequestFlagReportController;

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
    Route::controller(LoginController::class)->group(function () {
        Route::post('/login', 'login');
        Route::post('/logout', 'logout')->middleware('auth:sanctum');
    });

    Route::middleware('auth:sanctum')->group(function () {
        Route::controller(UserInfoController::class)->group(function () {
            Route::get('/profile', 'profile');
            Route::put('/profile', 'updateProfile');
            Route::put('/update-password', 'updatePassword');
            Route::post('/verify-profile', 'verifyProfile');
        });
        // User dashboard route
        Route::get('/dashboard', DashboardController::class);

        // Additional authenticated routes can be added here
        Route::apiResource('help-requests', HelpRequestsController::class)->except(['create', 'edit']);
        Route::post('help-requests/{help_request}/respond', [HelpRequestsController::class, 'responds']);

        // Flag report routes
        Route::post('flag-reports', [UserRequestFlagReportController::class, 'store']);

        // Device token management routes
        Route::apiResource('device-tokens', DeviceTokenController::class)->except(['create', 'edit']);
        Route::post('device-tokens/deactivate', [DeviceTokenController::class, 'deactivate']);

        // Notification routes
        Route::get('notifications', [NotificationController::class, 'index']);
        Route::get('notifications/unread-count', [NotificationController::class, 'unreadCount']);
        Route::post('notifications/mark-all-read', [NotificationController::class, 'markAllAsRead']);
        Route::delete('notifications/delete-all', [NotificationController::class, 'destroyAll']);
        Route::get('notifications/{id}', [NotificationController::class, 'show']);
        Route::post('notifications/{id}/mark-read', [NotificationController::class, 'markAsRead']);
        Route::delete('notifications/{id}', [NotificationController::class, 'destroy']);

        // More Service routes
        Route::controller(MoreServiceController::class)->prefix('more-service')->group(function () {
            Route::get('/emergency-contacts', 'emergencyContacts');
            Route::post('/emergency-contacts', 'addEmergencyContact');
            Route::delete('/emergency-contacts/{id}', 'deleteEmergencyContact');
            Route::get('/nearby-volunteers', 'nearByVolunteers');
        });
    });
});
